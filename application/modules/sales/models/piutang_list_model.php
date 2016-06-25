<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class piutang_list_model extends CI_Model {

    var $table = 'sales_piutang_list';
    var $table_penjualan = 'penjualan';
    var $table_join1 = 'kontak';
    var $table_join2 = 'kurensi';
    var $table_join3 = 'hutang_status';
    var $column = array('id', 'no', 'kontak', 'jatuh_tempo_pembayaran', 'saldo', 'status');
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
            '.$this->table_penjualan.'.no,
            '.$this->table_penjualan.'.jatuh_tempo_pembayaran,
            '.$this->table.'.saldo,
            '.$this->table_join1.'.title as kontak,
            '.$this->table_join3.'.title as status,
            ');
        $this->db->from($this->table);
        $this->db->join($this->table_penjualan, $this->table.'.penjualan_id = '.$this->table_penjualan.'.id', 'inner');
        $this->db->join($this->table_join1, $this->table_join1.'.id = '.$this->table_penjualan.'.kontak_id', 'left');
        $this->db->join($this->table_join3, $this->table_join3.'.id = '.$this->table.'.status_piutang_id', 'left');
        $this->db->where($this->table.'.is_deleted', 0);

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
            '.$this->table_penjualan.'.no,
            '.$this->table_penjualan.'.jatuh_tempo_pembayaran,
            '.$this->table.'.saldo,
            '.$this->table.'.terbayar,
            '.$this->table.'.total,
            '.$this->table_join1.'.title as kontak,
            '.$this->table_join2.'.title as kurensi,
            '.$this->table_join3.'.title as status,
            ');
        $this->db->from($this->table);
        $this->db->join($this->table_penjualan, $this->table.'.penjualan_id = '.$this->table_penjualan.'.id', 'inner');
        $this->db->join($this->table_join1, $this->table_join1.'.id = '.$this->table_penjualan.'.kontak_id', 'left');
        $this->db->join($this->table_join2, $this->table_join2.'.id = '.$this->table_penjualan.'.kurensi_id', 'left');
        $this->db->join($this->table_join3, $this->table_join3.'.id = '.$this->table.'.status_piutang_id', 'left');
        $this->db->where($this->table.'.id', $id);
        $q = $this->db->get()->row();
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
}
