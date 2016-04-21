<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Piutang_model extends CI_Model {

    var $table = 'sales_piutang';
    var $table_join1 = 'kontak';
    var $table_join2 = 'kurensi';
    var $table_join3 = 'sv_setup_coa';
    //var $column = array('id', 'so', 'kontak', 'kurensi', 'total', 'dibayar', 'terbayar', 'saldo', 'jatuh_tempo');
    var $column = array('sales_piutang.id', 'no', 'so', 'coa', 'tgl_dibayar', 'jatuh_tempo','kontak', 'saldo');
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
            '.$this->table.'.so,
            '.$this->table.'.tgl_dibayar,
            '.$this->table.'.jatuh_tempo,
            '.$this->table.'.saldo,
            '.$this->table_join3.'.name as coa,
            '.$this->table.'.kontak,
            ');
        $this->db->from($this->table);
        $this->db->join($this->table_join3, $this->table_join3.'.id = '.$this->table.'.coa_id', 'left');
        //$this->db->join($this->table_join1, $this->table_join1.'.id = '.$this->table.'.kontak', 'left');
        $this->db->where($this->table.'.is_deleted', 0);

        $i = 0;
    
        foreach ($this->column as $item) // loop column 
        {
            if($_POST['search']['value'])
            {
                if($item == 'no'){
                    $item = $this->table.'.no';
                }elseif($item == 'so'){
                    $item = $this->table.'.so';
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
        $q= $this->db->select('*')
             ->from($this->table)
             ->where($this->table.'.id', $id)
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


    public function get_kurensi()
    {   
        $this->db->where($this->table_join2.'.is_deleted',0);
        $this->db->order_by($this->table_join2.'.title','asc');
        return $this->db->get($this->table_join2);
    }

    public function get_so()
    {   
        return GetAllSelect('penjualan', 'no', array('metode_pembayaran_id'=>'where/2','id'=>'order/desc'));
    }
}
