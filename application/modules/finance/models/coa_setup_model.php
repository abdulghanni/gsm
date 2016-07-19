<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class coa_setup_model extends CI_Model {

	var $table = 'sv_setup_coa';
	var $table_ref = 'sv_ref_coa';
	var $column = array('sv_setup_coa.id', 'sv_setup_coa.code', 'sv_setup_coa.name', 'ref', 'sv_setup_coa.type'); //set column field database for order and search
	var $order = array('code' => 'asc'); // default order

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		$this->db->select(
				$this->table.".*,
				r.name as ref"
		);
		$this->db->from($this->table);
		$this->db->join("$this->table_ref as r", $this->table.'.ref_id = r.id', 'left');
		$i = 0;

		foreach ($this->column as $item) // loop column
		{
				if($_POST['search']['value'])
				{
						if($item == 'code'){
								$item = $this->table.'.code';
						}elseif($item == 'name'){
								$item = $this->table.'.name';
						}elseif($item == 'ref'){
								$item = 'r.name';
						}elseif($item == 'type'){
								$item = $this->table.'.type';
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
}
