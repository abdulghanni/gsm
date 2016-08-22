<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class penyesuaian_model extends CI_Model {

    var $table = 'stok_penyesuaian';
    var $list = 'stok_penyesuaian_list';
    var $table_join1 = 'barang';
    var $table_join2 = 'satuan';
    var $column = array('id', 'no', 'tgl', 'catatan'); //set column field database for order and search
    var $order = array('id' => 'desc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $this->db->from($this->table);

        $i = 0;
    
        foreach ($this->column as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND. 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $column[$i] = $item; // set column array variable to order processing
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

    function get_list($id){
         $this->db->select(
              $this->list.'.catatan,
            '.$this->list.'.buku,
            '.$this->list.'.fisik,
            '.$this->table_join1.'.kode as kode_barang,
            '.$this->table_join1.'.title as nama_barang,
            '.$this->table_join2.'.title as satuan,
            '.'satuan_buku.title as satuan_buku,
            ');
        $this->db->from($this->list);
        $this->db->join($this->table_join1, $this->table_join1.'.id = '.$this->list.'.barang_id', 'left');
        $this->db->join($this->table_join2, $this->table_join2.'.id = '.$this->list.'.satuan_id', 'left');
        $this->db->join($this->table_join2.' as satuan_buku', 'satuan_buku.id = '.$this->list.'.satuan_buku', 'left');
        $this->db->where('penyesuaian_id', $id);
        return $this->db->get();
    }
}
