<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_model extends CI_Model {

	var $table = 'stok';
	var $table_join1 = 'barang';
	var $table_join2 = 'satuan';
	var $table_join3 = 'gudang';
	var $table_join4 = 'lokasi_gudang';
	var $table_join5 = 'kurensi';
	var $column = array('kode', 'barang', 'jumlah', 'kurensi', 'satuan', 'harga', 'gudang', 'lokasi_gudang'); //set column field database for order and search
	var $order = array('stok.id' => 'desc'); // default order 

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
			'.$this->table.'.jumlah as jumlah,
			'.$this->table.'.harga as harga,
			'.$this->table_join1.'.title as barang,
			'.$this->table_join2.'.title as satuan,
			'.$this->table_join3.'.title as gudang,
			'.$this->table_join4.'.title as lokasi_gudang,
			'.$this->table_join5.'.title as kurensi,
			');
		$this->db->from($this->table);
		$this->db->join($this->table_join1, $this->table_join1.'.kode = '.$this->table.'.kode', 'left');
		$this->db->join($this->table_join2, $this->table_join2.'.id = '.$this->table.'.unit_id', 'left');
		$this->db->join($this->table_join3, $this->table_join3.'.id = '.$this->table.'.gudang_id', 'left');
		$this->db->join($this->table_join4, $this->table_join4.'.id = '.$this->table_join3.'.lokasi_id', 'left');
		$this->db->join($this->table_join5, $this->table_join5.'.id = '.$this->table.'.kurensi_id', 'left');

		$i = 0;
	
		foreach ($this->column as $item) // loop column 
		{
			if($_POST['search']['value'])
			{
				if($item == 'kode'){
					$item = $this->table.'.kode';
				}elseif($item == 'jumlah'){
					$item = $this->table.'.jumlah';
				}elseif($item == 'harga'){
					$item = $this->table.'.harga';
				}elseif($item == 'barang'){
					$item = $this->table_join1.'.title';
				}elseif($item == 'satuan'){
					$item = $this->table_join2.'.title';
				}elseif($item == 'gudang'){
					$item = $this->table_join3.'.title';
				}elseif($item == 'lokasi_gudang'){
					$item = $this->table_join4.'.title';
				}elseif($item == 'kurensi'){
					$item = $this->table_join5.'.title';
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

	public function get_barang()
	{	
		$this->db->where($this->table_join1.'.is_deleted',0);
		$this->db->order_by($this->table_join1.'.title','asc');
		return $this->db->get($this->table_join1);
	}

	public function get_satuan()
	{	
		$this->db->where($this->table_join2.'.is_deleted',0);
		$this->db->order_by($this->table_join2.'.title','asc');
		return $this->db->get($this->table_join2);
	}

	public function get_gudang()
	{	
		$this->db->where($this->table_join3.'.is_deleted',0);
		$this->db->order_by($this->table_join3.'.title','asc');
		return $this->db->get($this->table_join3);
	}

	public function get_kurensi()
	{	
		$this->db->where($this->table_join5.'.is_deleted',0);
		$this->db->order_by($this->table_join5.'.title','asc');
		return $this->db->get($this->table_join5);
	}
}
