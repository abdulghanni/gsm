<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

	var $table = 'users';
	var	$table_group = 'groups';
	var	$table_approver = 'approver';
	var $column = array('username','full_name', 'email'); //set column field database for order and search
	var $order = array('username' => 'asc'); // default order 
	var $order_group = array('name' => 'asc'); // default order 

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

	private function _get_datatables_query_group()
	{
		
		$this->db->from($this->table_group);

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
		else if(isset($this->order_group))
		{
			$order = $this->order_group;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	private function _get_datatables_query_approver()
	{
		$this->db->select($this->table.'.full_name as name, approver.jabatan as jabatan, approver.id as id, approver.level')
				 ->join($this->table, $this->table_approver.'.user_id = '.$this->table.'.id');
		$this->db->from($this->table_approver);

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
		else if(isset($this->order_approver))
		{
			$order = $this->order_approver;
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

	function get_datatables_group()
	{
		$this->_get_datatables_query_group();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function get_datatables_approver()
	{
		$this->_get_datatables_query_approver();
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

	function count_filtered_group()
	{
		$this->_get_datatables_query_group();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_group()
	{
		$this->db->from($this->table_group);
		return $this->db->count_all_results();
	}

	function count_filtered_approver()
	{
		$this->_get_datatables_query_approver();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_approver()
	{
		$this->db->from($this->table_approver);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_group_by_id($id)
	{
		$this->db->from($this->table_group);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_approver_by_id($id)
	{
		$this->db->from($this->table_approver);
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

	public function get_users()
	{	
		//$this->db->where($this->table_join1.'.is_deleted',0);
		$this->db->order_by($this->table.'.full_name','asc');
		return $this->db->get($this->table);
	}
}
