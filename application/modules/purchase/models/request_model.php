<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class request_model extends CI_Model {

    var $table = 'purchase_request';
    var $table_list = 'purchase_request_list';
    var $table_join1 = 'gudang';
    var $table_join2 = 'satuan';
    var $table_join3 = 'jenis_barang';
    var $table_join4 = 'kurensi';
    var $column = array('purchase_request.id', 'no', 'tanggal_digunakan', 'gudang', 'app_status_id_lv1', 'app_status_id_lv2','app_status_id_lv3', 'app_status_id_lv4', 'user_app_lv1', 'user_app_lv2', 'jenis_barang_id'); //set column field database for order and search
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
            '.$this->table.'.no as no,is_draft,
            '.$this->table.'.diajukan_ke,
            '.$this->table.'.tanggal_digunakan,
            '.$this->table.'.keperluan,
            '.$this->table.'.created_by,
            '.$this->table.'.app_status_id_lv1,
            '.$this->table.'.app_status_id_lv2,
            '.$this->table.'.app_status_id_lv3,
            '.$this->table.'.app_status_id_lv4,
            '.$this->table.'.jenis_barang_id,
            '.$this->table_join1.'.title as gudang,
            ');
        $this->db->from($this->table);
        $this->db->join($this->table_join1, $this->table_join1.'.id = '.$this->table.'.gudang_id', 'left');
        $this->db->where($this->table.'.is_deleted', 0);

        $i = 0;
    
        foreach ($this->column as $item) // loop column 
        {
            if($_POST['search']['value'])
            {
                if($item == 'no'){
                    $item = $this->table.'.no';
                }elseif($item == 'tanggal_digunakan'){
                    $item = $this->table.'.tanggal_digunakan';
                }elseif($item == 'diajukan_ke'){
                    $item = $this->table.'.diajukan_ke';
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

    function get_detail($id)
    {
        $q = $this->db->select(
            $this->table.'.id as id,
            '.$this->table.'.no as no,
            '.$this->table.'.diajukan_ke,
            '.$this->table.'.gudang_id,
            '.$this->table.'.tanggal_digunakan,
            '.$this->table.'.keperluan,
            '.$this->table.'.jenis_barang_id,
            '.$this->table_join3.'.title as jenis_barang,
            '.$this->table_join4.'.title as kurensi,
            '.$this->table.'.catatan,
            '.$this->table.'.created_by,
            '.$this->table.'.created_on,
            '.$this->table.'.is_app_lv1,
            '.$this->table.'.is_app_lv2,
            '.$this->table.'.is_app_lv3,
            '.$this->table.'.is_app_lv4,
            '.$this->table.'.user_app_lv1,
            '.$this->table.'.user_app_lv2,
            '.$this->table.'.user_app_lv3,
            '.$this->table.'.user_app_lv4,
            '.$this->table.'.date_app_lv1,
            '.$this->table.'.date_app_lv2,
            '.$this->table.'.date_app_lv3,
            '.$this->table.'.date_app_lv4,
            '.$this->table.'.app_status_id_lv1,
            '.$this->table.'.app_status_id_lv2,
            '.$this->table.'.app_status_id_lv3,
            '.$this->table.'.app_status_id_lv4,
            '.$this->table.'.note_app_lv1,
            '.$this->table.'.note_app_lv2,
            '.$this->table.'.note_app_lv3,
            '.$this->table.'.note_app_lv4,
            '.$this->table_join1.'.title as gudang,
            ')
                 ->from($this->table)
                 ->join($this->table_join1, $this->table_join1.'.id ='.$this->table.'.gudang_id', 'left')
                 ->join($this->table_join3, $this->table_join3.'.id ='.$this->table.'.jenis_barang_id', 'left')
                 ->join($this->table_join4, $this->table_join4.'.id ='.$this->table.'.kurensi_id', 'left')
                 ->where($this->table.'.id', $id)
                 ->get();
        return $q;
    }

    function get_list_detail($id)
    {
        $q = $this->db->select('purchase_request_list.id as id, barang.id as barang_id,satuan_id, barang.photo as photo,barang.kode as kode_barang,barang.title as nama_barang, purchase_request_list.deskripsi, jumlah, satuan.title as satuan, harga, disc, pajak, purchase_request_list.attachment, purchase_request_list.catatan, purchase_request_list.created_by')
                  ->from($this->table_list)
                  ->join('barang', 'barang.id ='.$this->table_list.'.kode_barang', 'left')
                  ->join('satuan', 'satuan.id ='.$this->table_list.'.satuan_id')
                  ->where('request_id', $id)
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

    public function get_satuan()
    {   
        $this->db->where($this->table_join2.'.is_deleted',0);
        $this->db->order_by($this->table_join2.'.title','asc');
        return $this->db->get($this->table_join2);
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
}
