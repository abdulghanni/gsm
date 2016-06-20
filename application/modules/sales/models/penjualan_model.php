<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class penjualan_model extends CI_Model {

    var $table = 'penjualan';
    var $table_so = 'sales_order';
    var $table_list_so = 'sales_order_list';
    var $table_join1 = 'kontak';
    var $table_join2 = 'metode_pembayaran';
    var $table_join3 = 'kurensi';
    var $table_join4 = 'gudang';
    var $column = array('no', 'no_sj', 'kontak','tanggal_transaksi', 'tanggal_pengantaran', 'gudang'); //set column field database for order and search
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
            '.$this->table.'.no_sj,
            '.$this->table.'.tanggal_transaksi as tanggal_transaksi,
            '.$this->table.'.tanggal_pengantaran,
            '.$this->table.'.created_by,
            '.$this->table_join1.'.title as kontak,
            '.$this->table_join4.'.title as gudang,
            ');
        $this->db->from($this->table);
        $this->db->join($this->table_join1, $this->table_join1.'.id = '.$this->table.'.kontak_id', 'left');
        $this->db->join($this->table_join2, $this->table_join2.'.id = '.$this->table.'.metode_pembayaran_id', 'left');
        $this->db->join($this->table_join4, $this->table_join4.'.id = '.$this->table.'.gudang_id', 'left');
        //$this->db->join($this->table_join3, $this->table_join3.'.id = '.$this->table.'.kurensi_id', 'left');
        $this->db->where($this->table.'.is_deleted', 0);

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

    function get_list_detail($id)
    {
        $q = $this->db->select('barang.id as barang_id, barang.photo,barang.kode as kode_barang, 
            ref_id,
                                order_list.deskripsi, 
                                diorder, 
                                diterima,
                                satuan.title as satuan, 
                                harga, 
                                disc, 
                                pajak,
                                order_list.catatan,
                                order_list.attachment,
                                order_list.inc_ppn
                                '
                                )
                  ->from('penjualan_list as order_list')
                  ->join('barang', 'barang.id = order_list.kode_barang', 'left')
                  ->join('satuan', 'satuan.id = order_list.satuan_id')
                  ->where('penjualan_id', $id)
                  ->get();
        return $q;
    }   

    function get_detail($id)
    {
        $q = $this->db->select('no,
                                kontak.title as kontak,
                                kontak.email as email,
                                kontak.up, 
                                penjualan.alamat,
                                metode_pembayaran_id, 
                                metode_pembayaran.title as metode_pembayaran, 
                                tanggal_transaksi, 
                                tanggal_pengantaran, 
                                so, 
                                no_sj, 
                                no_faktur,
                                gudang.title as gudang, 
                                jatuh_tempo_pembayaran, 
                                kurensi.title as kurensi, 
                                biaya_pengiriman, 
                                dibayar,  
                                dibayar_nominal,  
                                lama_angsuran_2, 
                                lama_angsuran_1,
                                project,
                                no_faktur,
                                penjualan.catatan,
                                pajak_komponen_id,
                                total_ppn,
                                total_pph22,
                                total_pph23,
                                total,
                                saldo,
                                total_plus_pajak,
                                penjualan.created_on')
                 ->from($this->table)
                 ->join($this->table_join1, $this->table_join1.'.id ='.$this->table.'.kontak_id', 'left')
                 ->join($this->table_join2, $this->table_join2.'.id ='.$this->table.'.metode_pembayaran_id', 'left')
                 ->join($this->table_join3, $this->table_join3.'.id ='.$this->table.'.kurensi_id', 'left')
                 ->join($this->table_join4, $this->table_join4.'.id ='.$this->table.'.gudang_id', 'left')
                 ->where($this->table.'.id', $id)
                 ->get();
        return $q;
    }

    function get_detail_so($id)
    {
        $q = $this->db->select('no, kontak.title as kontak,project,kontak_id, kontak.up,sales_order.catatan, kontak.alamat,metode_pembayaran_id, metode_pembayaran.title as metode_pembayaran,gudang_id, tanggal_transaksi, so, gudang.title as gudang, jatuh_tempo_pembayaran, kurensi_id,kurensi.title as kurensi, biaya_pengiriman, dibayar, lama_angsuran_2, lama_angsuran_1, sales_order.created_on')
                 ->from($this->table_so)
                 ->join($this->table_join1, $this->table_join1.'.id ='.$this->table_so.'.kontak_id', 'left')
                 ->join($this->table_join2, $this->table_join2.'.id ='.$this->table_so.'.metode_pembayaran_id', 'left')
                 ->join($this->table_join3, $this->table_join3.'.id ='.$this->table_so.'.kurensi_id', 'left')
                 ->join($this->table_join4, $this->table_join4.'.id ='.$this->table_so.'.gudang_id', 'left')
                 ->where($this->table_so.'.id', $id)
                 ->get();
        return $q;
    }

    function get_list_detail_so($id)
    {
        $id = explode(',', $id);
        $q = $this->db->select('a.id as id, pengeluaran_id, barang.id as barang_id,barang.kode as kode_barang,barang.photo, b.deskripsi, b.catatan, a.jumlah,a.satuan_id, satuan.title as satuan, b.harga as harga, b.disc, b.pajak, b.attachment, b.created_by, b.inc_ppn, a.created_on')
                  ->from('stok_pengeluaran_list as a')
                  ->join('sales_order_list as b', 'b.id ='.'a'.'.list_id', 'left')
                  ->join('barang', 'barang.id ='.'a'.'.barang_id', 'left')
                  ->join('satuan', 'satuan.id ='.'a'.'.satuan_id');
                  foreach ($id as $key => $value) {
                      $this->db->or_where('pengeluaran_id', $value);
                  }
                  
        $q = $this->db->get();
        return $q;
    }   

    function get_sum($id){
        $id = explode(',', $id);
        $this->db->select('SUM(((harga*a.jumlah)-((harga*a.jumlah)*(disc/100))) * (10/100)) as ppn, SUM((harga*a.jumlah)-((harga*a.jumlah)*(disc/100))) as total')
                  ->from('stok_pengeluaran_list as a')
                  ->join('sales_order_list as b', 'b.id ='.'a'.'.list_id', 'left')
                  ->join('barang', 'barang.id ='.'a'.'.barang_id', 'left')
                  ->join('satuan', 'satuan.id ='.'a'.'.satuan_id');
                  foreach ($id as $key => $value) {
                      $this->db->or_where('pengeluaran_id', $value);
                  }
                  
        $q = $this->db->get();
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
                 ->where($this->table_join1.'.jenis_id',2);
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
