<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class delivery_model extends CI_Model {

    var $table = 'delivery_order';
    var $table_so = 'sales_order';
    var $table_list_so = 'sales_order_list';
    var $table_join1 = 'customer';
    var $table_join2 = 'metode_pembayaran';
    var $table_join3 = 'kurensi';
    var $table_join4 = 'gudang';
    var $column = array('no', 'customer', 'tanggal_transaksi', 'metode_pembayaran', 'so', 'gudang'); //set column field database for order and search
    var $order = array('id' => 'desc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        
        $this->db->select(
            $this->table.'.id as id,
            '.$this->table.'.no as no,
            '.$this->table.'.so as so,
            '.$this->table.'.tanggal_transaksi as tanggal_transaksi,
            '.$this->table_join1.'.title as customer,
            '.$this->table_join2.'.title as metode_pembayaran,
            '.$this->table_join4.'.title as gudang,
            ');
        $this->db->from($this->table);
        $this->db->join($this->table_join1, $this->table_join1.'.id = '.$this->table.'.customer_id', 'left');
        $this->db->join($this->table_join2, $this->table_join2.'.id = '.$this->table.'.metode_pembayaran_id', 'left');
        $this->db->join($this->table_join4, $this->table_join4.'.id = '.$this->table.'.gudang_id', 'left');
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
                }elseif($item == 'so'){
                    $item = $this->table.'.so';
                }elseif($item == 'customer'){
                    $item = $this->table_join1.'.title';
                }elseif($item == 'metode_pembayaran'){
                    $item = $this->table_join2.'.title';
                }elseif($item == 'gudang'){
                    $item = $this->table_join4.'.title';
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

    function get_delivery_list_detail($id)
    {
        $q = $this->db->select('barang.kode as kode_barang, 
                                barang.title as barang, 
                                diorder, 
                                diterima,
                                satuan.title as satuan, 
                                harga, 
                                disc, 
                                pajak')
                  ->from('delivery_order_list as order_list')
                  ->join('barang', 'barang.id = order_list.kode_barang', 'left')
                  ->join('satuan', 'satuan.id = order_list.satuan_id')
                  ->where('delivery_id', $id)
                  ->get();
        return $q;
    }   

    function get_delivery_detail($id)
    {
        $q = $this->db->select('no,
                                customer.title as customer,
                                customer.up, 
                                customer.alamat,
                                metode_pembayaran_id, 
                                metode_pembayaran.title as metode_pembayaran, 
                                tanggal_transaksi, 
                                tanggal_pengantaran, 
                                so, 
                                gudang.title as gudang, 
                                jatuh_tempo_pembayaran, 
                                kurensi.title as kurensi, 
                                biaya_pengiriman, 
                                dibayar, 
                                lama_angsuran_2, 
                                lama_angsuran_1, 
                                bunga, 
                                delivery_order.created_on')
                 ->from($this->table)
                 ->join($this->table_join1, $this->table_join1.'.id ='.$this->table.'.customer_id', 'left')
                 ->join($this->table_join2, $this->table_join2.'.id ='.$this->table.'.metode_pembayaran_id', 'left')
                 ->join($this->table_join3, $this->table_join3.'.id ='.$this->table.'.kurensi_id', 'left')
                 ->join($this->table_join4, $this->table_join4.'.id ='.$this->table.'.gudang_id', 'left')
                 ->where($this->table.'.id', $id)
                 ->get();
        return $q;
    }

    function get_detail_so($id)
    {
        $q = $this->db->select('no, customer.title as customer,customer_id, customer.up,catatan, customer.alamat,metode_pembayaran_id, metode_pembayaran.title as metode_pembayaran,gudang_id, tanggal_transaksi, so, gudang.title as gudang, jatuh_tempo_pembayaran, kurensi_id,kurensi.title as kurensi, biaya_pengiriman, dibayar, lama_angsuran_2, lama_angsuran_1, bunga, sales_order.created_on')
                 ->from($this->table_so)
                 ->join($this->table_join1, $this->table_join1.'.id ='.$this->table_so.'.customer_id', 'left')
                 ->join($this->table_join2, $this->table_join2.'.id ='.$this->table_so.'.metode_pembayaran_id', 'left')
                 ->join($this->table_join3, $this->table_join3.'.id ='.$this->table_so.'.kurensi_id', 'left')
                 ->join($this->table_join4, $this->table_join4.'.id ='.$this->table_so.'.gudang_id', 'left')
                 ->where($this->table_so.'.id', $id)
                 ->get();
        return $q;
    }

    function get_list_detail_so($id)
    {
        $q = $this->db->select('barang.kode as kode_barang, deskripsi, jumlah,sales_order_list.satuan_id, satuan.title as satuan, harga, disc, pajak')
                  ->from($this->table_list_so)
                  ->join('barang', 'barang.id ='.$this->table_list_so.'.kode_barang', 'left')
                  ->join('satuan', 'satuan.id ='.$this->table_list_so.'.satuan_id')
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
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

    public function get_customer()
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
