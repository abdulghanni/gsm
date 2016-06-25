<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class debt_payment_model extends CI_Model {

    var $table = 'purchase_hutang';
    var $table_list = 'purchase_hutang_list';
    var $table_pembelian = 'pembelian';
    var $table_po = 'purchase_order';
    var $table_join1 = 'kontak';
    var $table_join2 = 'kurensi';
    var $table_join3 = 'sv_setup_coa';
   // var $column = array('id', 'po', 'kontak', 'kurensi', 'total', 'dibayar', 'terbayar', 'saldo', 'jatuh_tempo');
    var $column = array('purchase_hutang.id', 'no', 'no_invoice', 'po', 'coa', 'tgl_dibayar', 'jatuh_tempo','kontak', 'dibayar');
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
            '.$this->table_pembelian.'.no as no_invoice,
            '.$this->table_po.'.po,
            '.$this->table.'.tgl_dibayar,
            '.$this->table.'.dibayar,
            '.$this->table_pembelian.'.jatuh_tempo_pembayaran as jatuh_tempo,
            '.$this->table_list.'.id as list_id ,
            '.$this->table_list.'.saldo,
            '.$this->table_join3.'.name as coa,
            '.$this->table_join1.'.title as kontak,
            ');
        $this->db->from($this->table);
        $this->db->join($this->table_list, $this->table_list.'.id = '.$this->table.'.list_id', 'inner');
        $this->db->join($this->table_pembelian, $this->table_pembelian.'.id = '.$this->table_list.'.pembelian_id', 'left');
        $this->db->join($this->table_po, $this->table_po.'.po = '.$this->table_pembelian.'.po', 'left');
        $this->db->join($this->table_join3, $this->table_join3.'.id = '.$this->table.'.coa_id', 'left');
        $this->db->join($this->table_join1, $this->table_join1.'.id = '.$this->table_po.'.kontak_id', 'left');
        $this->db->where($this->table.'.is_deleted', 0);

        $i = 0;
    
        foreach ($this->column as $item) // loop column 
        {
            if($_POST['search']['value'])
            {
                if($item == 'no'){
                    $item = $this->table.'.no';
                }elseif($item == 'po'){
                    $item = $this->table.'.po';
                }elseif($item == 'coa'){
                    $item = $this->table_join3.'.name';
                }elseif($item == 'kontak'){
                    $item = $this->table.'.kontak';
                }elseif($item == 'tgl_dibayar'){
                    $item = $this->table.'.tgl_dibayar';
                }elseif($item == 'jatuh_tempo'){
                    $item = $this->table.'.jatuh_tempo';
                }elseif($item == 'saldo'){
                    $item = $this->table.'.saldo';
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
        $this->db->select(
            $this->table.'.id as id,
            '.$this->table.'.no,
            '.$this->table_pembelian.'.no as no_invoice,
            '.$this->table_po.'.po,
            '.$this->table.'.tgl_dibayar,
            '.$this->table_pembelian.'.jatuh_tempo_pembayaran as jatuh_tempo,
            '.$this->table.'.dibayar,
            '.$this->table.'.created_by,
            '.$this->table_join3.'.name as coa,
            '.$this->table_join1.'.title as kontak,
            ');
        $this->db->from($this->table);
        $this->db->join($this->table_list, $this->table_list.'.id = '.$this->table.'.list_id', 'inner');
        $this->db->join($this->table_pembelian, $this->table_pembelian.'.id = '.$this->table_list.'.pembelian_id', 'left');
        $this->db->join($this->table_po, $this->table_po.'.po = '.$this->table_pembelian.'.po', 'left');
        $this->db->join($this->table_join3, $this->table_join3.'.id = '.$this->table.'.coa_id', 'left');
        $this->db->join($this->table_join1, $this->table_join1.'.id = '.$this->table_po.'.kontak_id', 'left');
        $this->db->where($this->table_list.'.id', $id);
        return $this->db->get();
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

    public function get_kontak()
    {   
        $this->db->where($this->table_join1.'.is_deleted',0)
                 ->where($this->table_join1.'.jenis_id',1);
        $this->db->order_by($this->table_join1.'.title','asc');
        return $this->db->get($this->table_join1);
    }


    public function get_kurensi()
    {   
        $this->db->where($this->table_join2.'.is_deleted',0);
        $this->db->order_by($this->table_join2.'.title','asc');
        return $this->db->get($this->table_join2);
    }

    public function get_po()
    {   
        //return GetAllSelect('purchase_order', 'po', array('metode_pembayaran_id'=>'where/2','id'=>'order/desc'));
        return $this->db->select('a.id, a.pembelian_id, b.no')
                 ->where('a.status_hutang_id !=', 3)
                 ->from('purchase_hutang_list a')
                 ->join('pembelian b', 'a.pembelian_id = b.id')
                 ->get();
    }
}
