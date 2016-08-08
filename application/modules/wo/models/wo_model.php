<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wo_model extends CI_Model {

    var $table = 'wo';
    var $table_list = 'wo_list';
    var $table_join1 = 'kontak';
    var $table_join4 = 'gudang';
    var $table_join6 = 'status';
    var $table_join7 = 'users';
    var $column = array('wo.id', 'no', 'project', 'kontak', 'tgl', 'creator', 'status'); //set column field database for wo and search
    var $wo = array('id' => 'desc'); // default wo 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $this->db->select(
            $this->table.'.id,
            '.$this->table.'.no,
            '.$this->table.'.project,
            '.$this->table.'.tgl,
            '.$this->table.'.created_by,
            '.$this->table.'.status_id,
            '.$this->table.'.is_deleted,
            '.$this->table_join1.'.title as kontak,
            '.$this->table_join6.'.title as status,
            '.$this->table_join7.'.username as creator,
            ');
        $this->db->from($this->table);
        $this->db->join($this->table_join1, $this->table_join1.'.id = '.$this->table.'.kontak_id', 'left');
        $this->db->join($this->table_join6, $this->table_join6.'.id = '.$this->table.'.status_id', 'left');
        $this->db->join($this->table_join7, $this->table_join7.'.id = '.$this->table.'.created_by', 'left');
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
                }elseif($item == 'creator'){
                    $item = $this->table_join7.'.username';
                }elseif($item == 'po'){
                    $item = $this->table.'.po';
                }elseif($item == 'kontak'){
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
        
        if(isset($_POST['wo'])) // here wo processing
        {
            $this->db->order_by($column[$_POST['wo']['0']['column']], $_POST['wo']['0']['dir']);
        } 
        else if(isset($this->wo))
        {
            $wo = $this->wo;
            $this->db->order_by(key($wo), $wo[key($wo)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $this->db->where($this->table.'.is_deleted', 0);
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
       return $this->db->select(
                $this->table.'.id,
                '.$this->table.'.no,
                '.$this->table.'.project,
                '.$this->table.'.tgl,
                '.$this->table.'.catatan,
                '.$this->table.'.created_by,
                '.$this->table.'.status_id,
                '.$this->table.'.is_deleted,
                '.$this->table_join1.'.title as kontak,
                '.$this->table_join6.'.title as status,
                '.$this->table_join7.'.username as creator,
                ')
           ->from($this->table)
           ->join($this->table_join1, $this->table_join1.'.id = '.$this->table.'.kontak_id', 'left')
           ->join($this->table_join6, $this->table_join6.'.id = '.$this->table.'.status_id', 'left')
           ->join($this->table_join7, $this->table_join7.'.id = '.$this->table.'.created_by', 'left')
           ->where($this->table.'.is_deleted', 0)
           ->where($this->table.'.id', $id)
           ->get();
    }

    function get_list_detail($id)
    {
        $q = $this->db->select(
                    'barang.id as barang_id,
                    satuan_id, 
                    barang.satuan as satuan_barang,
                    barang.photo, 
                    barang.kode as kode_barang,
                    barang.title as nama_barang,
                    wo_list.deskripsi,
                    qty, 
                    sisa_stok,
                    satuan.title as satuan, 
                    wo_list.catatan')
                  ->from($this->table_list)
                  ->join('barang', 'barang.id ='.$this->table_list.'.barang_id', 'left')
                  ->join('satuan', 'satuan.id ='.$this->table_list.'.satuan_id', 'left')
                  ->where('wo_id', $id)
                  ->get();
        return $q;
    }   

    function get_detail_pr($id)
    {
        $q = $this->db->select(
            $this->table_pr.'.id as id,
            '.$this->table_pr.'.no as no,
            '.$this->table_pr.'.diajukan_ke,
            '.$this->table_pr.'.gudang_id,
            '.$this->table_pr.'.tanggal_digunakan,
            '.$this->table_pr.'.keperluan,
            '.$this->table_pr.'.catatan,
            '.$this->table_pr.'.keperluan,
            '.$this->table_pr.'.created_by,
            '.$this->table_join4.'.title as gudang,
            '.$this->table_join5.'.title as jenis_barang,
            ')
                 ->from($this->table_pr)
                 ->join($this->table_join4, $this->table_join4.'.id ='.$this->table_pr.'.gudang_id', 'left')
                 ->join($this->table_join5, $this->table_join5.'.id ='.$this->table_pr.'.jenis_barang_id', 'left')
                 ->where($this->table_pr.'.id', $id)
                 ->get();
        return $q;
    }

    function get_list_detail_pr($id)
    {
        $id = explode(',', $id);
        $this->db->select('request_list.id as id, request_list.request_id, barang.id as barang_id,satuan_id,barang.title as nama_barang, barang.photo as photo,barang.kode as kode_barang, request_list.deskripsi, jumlah, satuan.title as satuan, harga, disc, pajak, request_list.attachment, request_list.catatan, request_list.created_by')
                  ->from($this->table_list_pr)
                  ->join('barang', 'barang.id ='.$this->table_list_pr.'.kode_barang', 'left')
                  ->join('satuan', 'satuan.id ='.$this->table_list_pr.'.satuan_id');
                  foreach ($id as $key => $value) {
                      $this->db->or_where('request_id', $value);
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
                 ->where($this->table_join1.'.jenis_id',1)
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
