<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class assembly_model extends CI_Model {

	var $table = 'assembly';
	var $table_list = 'assembly_list';
	var $table_join1 = 'barang';
	var $table_join2 = 'satuan';
	var $column = array('assembly.id', 'kode', 'title'); //set column field database for order and search
	var $order = array('barang.title' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		$this->db->select(
			$this->table.'.id as id,
			'.$this->table_join1.'.title as title,
			'.$this->table_join1.'.kode,
			');
		$this->db->from($this->table);
		$this->db->join($this->table_join1, $this->table_join1.'.id = '.$this->table.'.barang_id', 'left');

		$i = 0;
	
		foreach ($this->column as $item) // loop column 
		{
			if($_POST['search']['value'])
			{
				if($item == 'kode'){
					$item = $this->table_join1.'.kode';
				}elseif($item == 'title'){
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

	function get_detail($id){
		return $this->db->select(
			$this->table.'.id as id,
			'.$this->table.'.barang_id,
			'.$this->table_join1.'.title as title,
			'.$this->table_join1.'.kode,
			')
		->from($this->table)
		->join($this->table_join1, $this->table_join1.'.id = '.$this->table.'.barang_id', 'left')
		->where($this->table.'.id', $id)
		->get()->row();
	}

	function get_list_detail($id){
		return $this->db->select(
			$this->table_list.'.id as id,
			'.$this->table_list.'.jumlah,
			'.$this->table_join1.'.title as nama_barang,
			'.$this->table_join1.'.kode,
			'.$this->table_join2.'.title as satuan,
			')
		->from($this->table_list)
		->join($this->table_join1, $this->table_join1.'.id = '.$this->table_list.'.kode_barang', 'left')
		->join($this->table_join2, $this->table_join2.'.id = '.$this->table_list.'.satuan_id', 'left')
		->where($this->table_list.'.assembly_id', $id)
		->get()->result();
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

}
