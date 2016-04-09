<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class retur_model extends CI_Model {

    var $table = 'sales_return';
    var $table_po = 'sales_order';
    var $table_list_po = 'sales_order_list';
    var $table_join1 = 'kontak';
    var $table_join2 = 'metode_pembayaran';
    var $table_join3 = 'kurensi';
    var $table_join4 = 'gudang';
    var $column = array('id', 'no', 'pengeluaran_id', 'so','kontak','tanggal_pengeluaran', 'tanggal_transaksi', 'gudang'); //set column field database for order and search
    var $order = array('id' => 'desc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        
        $this->db->select('sales_return.no,
                            sales_return.id as id,
                                pengeluaran_id,
                                stok_pengeluaran.tgl as tanggal_pengeluaran,
                                sales_order.so as so,
                                kontak.title as kontak,
                                gudang.title as gudang,
                                sales_return.tanggal_transaksi,
                                sales_return.catatan,
                                sales_return.created_on,
                                sales_return.created_by'
                                )
                 ->from($this->table)
                 ->join('stok_pengeluaran', 'stok_pengeluaran'.'.id ='.$this->table.'.pengeluaran_id', 'left')
                 ->join('gudang', 'stok_pengeluaran'.'.gudang_to ='.'gudang'.'.id', 'left')
                 ->join('sales_order', 'stok_pengeluaran'.'.ref ='.'sales_order'.'.so', 'left')
                 ->join('kontak', 'kontak'.'.id ='.'sales_order'.'.kontak_id', 'left');

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
                }elseif($item == 'kontak'){
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

    function get_detail($id)
    {
        $q = $this->db->select('sales_return.no,
                                pengeluaran_id,
                                stok_pengeluaran.tgl as tanggal_pengeluaran,
                                sales_order.so as so,
                                kontak.title as kontak,
                                gudang.title as gudang,
                                sales_return.tanggal_transaksi,
                                sales_return.catatan,
                                sales_return.created_on,
                                sales_return.created_by'
                                )
                 ->from($this->table)
                 ->join('stok_pengeluaran', 'stok_pengeluaran'.'.id ='.$this->table.'.pengeluaran_id', 'left')
                 ->join('gudang', 'stok_pengeluaran'.'.gudang_to ='.'gudang'.'.id', 'left')
                 ->join('sales_order', 'stok_pengeluaran'.'.ref ='.'sales_order'.'.so', 'left')
                 ->join('kontak', 'kontak'.'.id ='.'sales_order'.'.kontak_id', 'left')
                 ->where("$this->table.id", $id)
                 ->get();
        return $q;
    }

    function get_list_detail($id)
    {
        $q = $this->db->select('barang.kode as kode_barang,
                                barang.id as barang_id,
                                barang.title as nama_barang,
                                barang.photo,
                                order_list.deskripsi,
                                diretur,
                                diterima, 
                                satuan.title as satuan')
                  ->from($this->table."_list as order_list")
                  ->join('barang', 'barang.id = order_list.kode_barang', 'left')
                  ->join('satuan', 'satuan.id = order_list.satuan_id', 'left')
                  ->where('retur_id', $id)
                  ->get();
        return $q;
    }   

    function get_detail_po($id)
    {
        $q = $this->db->select('no, 
                                kontak.title as kontak,
                                kontak_id,
                                kontak.up, 
                                kontak.alamat,
                                metode_pembayaran_id, 
                                metode_pembayaran.title as metode_pembayaran, 
                                tanggal_transaksi, 
                                so, 
                                gudang_id,
                                gudang.title as gudang, 
                                jatuh_tempo_pembayaran, 
                                kurensi_id,
                                kurensi.title as kurensi, 
                                biaya_pengiriman, 
                                dibayar, 
                                lama_angsuran_2, 
                                lama_angsuran_1, 
                                bunga,
                                sales_order.catatan, 
                                sales_order.created_on,
                                
                                sales_order.created_by'
                                )
                 ->from($this->table_po)
                 ->join($this->table_join1, $this->table_join1.'.id ='.$this->table_po.'.kontak_id', 'left')
                 ->join($this->table_join2, $this->table_join2.'.id ='.$this->table_po.'.metode_pembayaran_id', 'left')
                 ->join($this->table_join3, $this->table_join3.'.id ='.$this->table_po.'.kurensi_id', 'left')
                 ->join($this->table_join4, $this->table_join4.'.id ='.$this->table_po.'.gudang_id', 'left')
                 ->where($this->table_po.'.id', $id)
                 ->get();
        return $q;
    }

    function get_list_detail_po($id)
    {
        $q = $this->db->select('barang.id as barang_id, barang.kode as kode_barang, sales_order_list.deskripsi, jumlah, sales_order_list.satuan_id, satuan.title as satuan, harga, disc, pajak')
                  ->from($this->table_list_po)
                  ->join('barang', 'barang.id ='.$this->table_list_po.'.kode_barang', 'left')
                  ->join('satuan', 'satuan.id ='.$this->table_list_po.'.satuan_id', 'left')
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

    public function get_kontak()
    {   
        $this->db->where($this->table_join1.'.is_deleted',0)
                 ->where($this->table_join1.'.jenis_id',1);
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
