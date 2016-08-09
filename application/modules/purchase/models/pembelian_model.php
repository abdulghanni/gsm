<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pembelian_model extends CI_Model {

    var $table = 'pembelian';
    var $table_po = 'purchase_order';
    var $table_list_po = 'purchase_order_list';
    var $table_users = 'users';
    var $table_join1 = 'kontak';
    var $table_join2 = 'metode_pembayaran';
    var $table_join3 = 'kurensi';
    var $table_join4 = 'gudang';
    var $column = array('id', 'no','po', 'kontak', 'tanggal_pengiriman', 'tanggal_transaksi', 'gudang', 'creator'); //set column field database for order and search
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
            '.$this->table.'.po as po,
            '.$this->table.'.tanggal_transaksi as tanggal_transaksi,
            '.$this->table.'.tanggal_pengiriman as tanggal_pengiriman,
            '.$this->table_users.'.username as creator,
            '.$this->table_join1.'.title as kontak,
            '.$this->table_join4.'.title as gudang,
            ');
        $this->db->from($this->table);
        $this->db->join($this->table_po, $this->table.'.po = '.$this->table_po.'.po', 'inner');
        $this->db->join($this->table_users, $this->table.'.created_by = '.$this->table_users.'.id', 'inner');
        $this->db->join($this->table_join1, $this->table_join1.'.id = '.$this->table_po.'.kontak_id', 'left');
        $this->db->join($this->table_join4, $this->table_join4.'.id = '.$this->table_po.'.gudang_id', 'left');

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
        $q = $this->db->select('pembelian.*, 
                                kontak.title as kontak,
                                kontak.email as email,
                                kontak_id,
                                purchase_order.up, 
                                purchase_order.alamat,
                                metode_pembayaran_id, 
                                metode_pembayaran.title as metode_pembayaran, 
                                pembelian.tanggal_transaksi, 
                                pembelian.tanggal_pengiriman, 
                                pembelian.po, 
                                gudang.title as gudang, 
                                gudang_id,
                                pembelian.jatuh_tempo_pembayaran, 
                                kurensi.title as kurensi, 
                                kurensi_id,
                                biaya_pengiriman, 
                                dibayar, 
                                dibayar_nominal,
                                lama_angsuran_2, 
                                lama_angsuran_1, 
                                bunga,
                                proyek,
                                pembelian.catatan, 
                                purchase_order.pajak_komponen_id, 
                                purchase_order.total_ppn, 
                                purchase_order.total_pph22, 
                                purchase_order.total_pph23, 
                                purchase_order.diskon_tambahan_nominal, 
                                purchase_order.diskon_tambahan_persen, 
                                purchase_order.total_diskon, 
                                pembelian.created_on,
                                pembelian.created_by'
                                )
                 ->from($this->table)
                 ->join($this->table_po, $this->table.'.po ='.$this->table_po.'.po', 'inner')
                 ->join($this->table_join1, $this->table_join1.'.id ='.$this->table_po.'.kontak_id', 'left')
                 ->join($this->table_join2, $this->table_join2.'.id ='.$this->table_po.'.metode_pembayaran_id', 'left')
                 ->join($this->table_join3, $this->table_join3.'.id ='.$this->table_po.'.kurensi_id', 'left')
                 ->join($this->table_join4, $this->table_join4.'.id ='.$this->table_po.'.gudang_id', 'left')
                 ->where("$this->table.id", $id)
                 ->get();
        return $q;
    }

    function get_list_detail($id)
    {
        $q = $this->db->select('barang.id as barang_id,satuan_id, barang.photo, barang.kode as kode_barang,barang.title as nama_barang, order_list.deskripsi, jumlah, satuan.title as satuan, harga, disc, pajak, order_list.attachment, order_list.catatan')
                  ->from($this->table."_list as order_list")
                  ->join('barang', 'barang.id = order_list.kode_barang', 'left')
                  ->join('satuan', 'satuan.id = order_list.satuan_id', 'left')
                  ->where('pembelian_id', $id)
                  ->get();
        return $q;
    }   

    function get_detail_po($id)
    {
        $q = $this->db->select('no, kontak.title as kontak,
                                kontak.email as email,
                                kontak_id,
                                purchase_order.up, 
                                purchase_order.alamat,
                                metode_pembayaran_id, 
                                metode_pembayaran.title as metode_pembayaran, 
                                tanggal_transaksi, 
                                po, 
                                gudang.title as gudang, 
                                gudang_id,
                                jatuh_tempo_pembayaran, 
                                kurensi.title as kurensi, 
                                kurensi_id,
                                biaya_pengiriman, 
                                dibayar, 
                                dibayar_nominal,
                                lama_angsuran_2, 
                                lama_angsuran_1, 
                                bunga,
                                proyek,
                                purchase_order.catatan, 
                                purchase_order.pajak_komponen_id, 
                                purchase_order.total_ppn, 
                                purchase_order.total_pph22, 
                                purchase_order.total_pph23, 
                                purchase_order.diskon_tambahan_nominal, 
                                purchase_order.diskon_tambahan_persen, 
                                purchase_order.total_diskon, 
                                purchase_order.gtotal, 
                                purchase_order.created_on,
                                purchase_order.saldo,
                                is_app_lv1,
                                is_app_lv2,
                                is_app_lv3,
                                is_app_lv4,
                                user_app_lv1,
                                user_app_lv2,
                                user_app_lv3,
                                user_app_lv4,
                                date_app_lv1,
                                date_app_lv2,
                                date_app_lv3,
                                date_app_lv4,
                                app_status_id_lv1,
                                app_status_id_lv2,
                                app_status_id_lv3,
                                app_status_id_lv4,
                                note_app_lv1,
                                note_app_lv2,
                                note_app_lv3,
                                note_app_lv4,
                                purchase_order.created_by'
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
        $q = $this->db->select(
                                'barang.id as barang_id,
                                 barang.kode as kode_barang,
                                 barang.title as nama_barang,
                                 barang.photo,
                                 purchase_order_list.deskripsi,
                                 purchase_order_list.catatan,
                                 purchase_order_list.attachment,
                                 jumlah,
                                 purchase_order_list.satuan_id,
                                 satuan.title as satuan, 
                                 harga, 
                                 disc, 
                                 pajak')
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
