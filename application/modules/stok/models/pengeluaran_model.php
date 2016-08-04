<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pengeluaran_model extends CI_Model {

    var $table = 'stok_pengeluaran';
    var $table_join1 = 'gudang';
    var $table_join2 = 'users';
    var $table_join3 = 'status';
    var $column = array('no', 'ref', 'gudang', 'tgl', 'is_delivered', 'creator', 'created_on'); //set column field database for order and search
    var $order = array('id' => 'desc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $this->db->select(
            $this->table.'.*,
            '.$this->table_join1.'.title as gudang,
            '.$this->table_join2.'.username as creator,
            ');
        $this->db->from($this->table);
        $this->db->join($this->table_join1, $this->table_join1.'.id = '.$this->table.'.gudang_to', 'left');
        $this->db->join($this->table_join2, $this->table_join2.'.id = '.$this->table.'.created_by', 'left');
        $this->db->where($this->table.'.is_deleted', 0);

        $i = 0;
    
        foreach ($this->column as $item) // loop column 
        {
            if($_POST['search']['value'])
            {
                if($item == 'no'){
                    $item = $this->table.'.no';
                }elseif($item == 'ref'){
                    $item = $this->table.'.ref';
                }elseif($item == 'tgl'){
                    $item = $this->table.'.tgl';
                }elseif($item == 'is_delivered'){
                    $item = $this->table.'.is_delivered';
                }elseif($item == 'created_on'){
                    $item = $this->table.'.created_on';
                }elseif($item == 'creator'){
                    $item = $this->table_join2.'.username';
                }elseif($item == 'gudang'){
                    $item = $this->table_join1.'.title';
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
        $this->db->where($this->table.'.is_deleted', 0);
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $this->db->where($this->table.'.is_deleted', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->where($this->table.'.is_deleted', 0);
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
        $q = $this->db->select('no, ref_id, kontak.title as kontak,kontak.email as email,kontak_id,kurensi_id,opsi_desimal, gudang_id,project,pajak_komponen_id, total_ppn, total_pph22, total_pph23, stok_pengeluaran.up,stok_pengeluaran.catatan, kontak.alamat,metode_pembayaran_id, metode_pembayaran.title as metode_pembayaran, tanggal_transaksi, so, gudang.title as gudang, jatuh_tempo_pembayaran, kurensi.title as kurensi, biaya_pengiriman, dibayar,dibayar_nominal, lama_angsuran_2, lama_angsuran_1, stok_pengeluaran.created_by, stok_pengeluaran.created_on')
                 ->from($this->table)
                 ->join($this->table_join1, $this->table_join1.'.id ='.$this->table.'.kontak_id', 'left')
                 ->join($this->table_join2, $this->table_join2.'.id ='.$this->table.'.metode_pembayaran_id', 'left')
                 ->join($this->table_join3, $this->table_join3.'.id ='.$this->table.'.kurensi_id', 'left')
                 ->join($this->table_join4, $this->table_join4.'.id ='.$this->table.'.gudang_id', 'left')
                 ->where($this->table.'.id', $id)
                 ->get();
        return $q;
    }

    function get_list_detail($id)
    {
        $q = $this->db->select('barang.id as barang_id,satuan_id,order_list.attachment,order_list.catatan, barang.photo,barang.kode as kode_barang, order_list.deskripsi as deskripsi, jumlah, satuan.title as satuan, harga, disc, pajak, order_list.inc_ppn')
                  ->from('stok_pengeluaran_list as order_list')
                  ->join('barang', 'barang.id = order_list.kode_barang', 'left')
                  ->join('satuan', 'satuan.id = order_list.satuan_id')
                  ->where('order_id', $id)
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
         $data = array('is_deleted'=>1,
                        'catatan' => $this->input->post('catatan'),
                        'deleted_by' => sessId(),
                        'deleted_on' => dateNow()
            );
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        //$this->db->delete($this->table);
    }

    
    public function get_kontak()
    {   
        $this->db->where($this->table_join1.'.is_deleted',0)
                 ->where($this->table_join1.'.jenis_id',2)
                 ->or_where($this->table_join1.'.jenis_id',3);
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
