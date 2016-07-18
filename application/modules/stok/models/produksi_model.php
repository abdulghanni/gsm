<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class produksi_model extends CI_Model {

    var $table = 'produksi';
    var $table_list = 'produksi_list';
    var $table_ref = 'produksi_ref';
    var $table_wo = 'wo';
    var $table_so = 'sales_order';
    var $table_join1 = 'users';
    var $table_join2 = 'supplier';
    var $table_join6 = 'status';
    // var $column = array('produksi.id', 'no', 'ref_no', 'ref_type', 'tgl', 'customer', 'project', 'creator');
    var $column = array('produksi.id', 'no', 'tgl','ref_id', 'ref_type', 'creator');
    var $order = array('id' => 'desc');

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {

        $this->db->select(
            $this->table.'.id as id,
            '.$this->table.'.no,
            '.$this->table.'.ref_id,
            '.$this->table_ref.'.ref_type,
            '.$this->table.'.tgl,
            '.$this->table_join6.'.title as status,
            '.$this->table.'.created_by,
            '.$this->table_join1.'.username as creator,
            ');
        $this->db->from($this->table);
        $this->db->join($this->table_join1, $this->table_join1.'.id = '.$this->table.'.created_by', 'left');
        $this->db->join($this->table_ref, $this->table_ref.'.id = '.$this->table.'.ref_id', 'inner');
        $this->db->join($this->table_join6, $this->table_join6.'.id = '.$this->table.'.status_id', 'left');

        // $this->db->join($this->table_join1, $this->table_join1.'.id = '.$this->table.'.supplier_id', 'left');
        // $this->db->join($this->table_join2, $this->table_join2.'.id = '.$this->table.'.metode_pembayaran_id', 'left');
        // $this->db->join($this->table_join4, $this->table_join4.'.id = '.$this->table.'.gudang_id', 'left');
        //$this->db->join($this->table_join3, $this->table_join3.'.id = '.$this->table.'.kurensi_id', 'left');

        $i = 0;

        foreach ($this->column as $item) // loop column
        {
            if($_POST['search']['value'])
            {
                if($item == 'no'){
                    $item = $this->table.'.no';
                }elseif($item == 'tanggal_transaksi'){
                    $item = $this->table.'.tanggal_transaksi';
                }elseif($item == 'po'){
                    $item = $this->table.'.po';
                }elseif($item == 'supplier'){
                    $item = $this->table_join1.'.title';
                }elseif($item == 'metode_pembayaran'){
                    $item = $this->table_join2.'.title';
                }elseif($item == 'gudang'){
                    $item = $this->table_join4.'.title';
                }elseif($item == 'status'){
                    $item = $this->table_join6.'.title';
                }

                ($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
            }

            $column[$i] = $item;
            $i++;
        }

        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id',$id);
        $query = $this->db->get();

        return $query->row();
    }

    function get_detail($id)
    {
        $q = $this->db->select(
            $this->table.'.id as id,
            '.$this->table.'.no,
            '.$this->table.'.catatan,
            '.$this->table.'.ref_id,
            '.$this->table_ref.'.ref_type,
            '.$this->table.'.tgl,
            '.$this->table.'.created_by,
            '.$this->table_join1.'.username as creator,
            ')
        ->from($this->table)
        ->join($this->table_join1, $this->table_join1.'.id = '.$this->table.'.created_by', 'left')
        ->join($this->table_ref, $this->table_ref.'.id = '.$this->table.'.ref_id', 'inner')
        ->where($this->table.'.id', $id)
        ->get();
        return $q;
    }

    function get_list_detail($id)
    {
        $q = $this->db->select('produksi_list.id, barang.id as barang_id,barang.kode as kode_barang, barang.title as barang, jumlah, satuan.title as satuan')
                  ->from('produksi_list')
                  ->join('barang', 'barang.id = produksi_list.kode_barang', 'left')
                  ->join('satuan', 'satuan.id = produksi_list.satuan_id')
                  ->where('produksi_id', $id)
                  ->get();
        return $q;
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

    public function get_supplier()
    {
        $this->db->where($this->table_join1.'.is_deleted',0);
        $this->db->order_by($this->table_join1.'.title','asc');
        return $this->db->get($this->table_join1);
    }

    public function get_metode_pembayaran()
    {
        $this->db->where($this->table_join2.'.is_deleted',0);
        $this->db->order_by($this->table_join2.'.title','asc');
        return $this->db->get($this->table_join2);
    }
}
