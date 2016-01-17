<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gudang_model extends CI_Model {

	var $table = 'gudang';
	var $table_join1 = 'lokasi_gudang';
	var $column = array('gudang.id', 'kode', 'title', 'lokasi_gudang'); //set column field database for order and search
	var $order = array('gudang.id' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		$this->db->select(
			$this->table.'.id as id,
			'.$this->table.'.kode as kode,
			'.$this->table.'.title as title,
			'.$this->table_join1.'.title as lokasi_gudang,
			');
		$this->db->from($this->table);
		$this->db->join($this->table_join1, $this->table_join1.'.id = '.$this->table.'.lokasi_gudang_id', 'left');

		$i = 0;
	
		foreach ($this->column as $item) // loop column 
		{
			if($_POST['search']['value'])
			{
				if($item == 'kode'){
					$item = $this->table.'.kode';
				}elseif($item == 'title'){
					$item = $this->table.'.title';
				}elseif($item == 'lokasi_gudang'){
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

	public function get_lokasi_gudang()
	{	
		$this->db->where($this->table_join1.'.is_deleted',0);
		$this->db->order_by($this->table_join1.'.title','asc');
		return $this->db->get($this->table_join1);
	}
}
