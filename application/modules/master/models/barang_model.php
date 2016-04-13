<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class barang_model extends CI_Model {

	var $table = 'barang';
	var $table_inv = 'barang_inventaris_detail';
	var $table_join1 = 'jenis_barang';
	var $table_join2 = 'satuan';
	var $column = array('barang.id', 'photo', 'kode', 'title', 'alias', 'jenis_barang', 'satuan'); //set column field database for order and search
	var $order = array('title' => 'asc'); // default order 

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
			'.$this->table.'.photo,
			'.$this->table.'.alias,
			'.$this->table_join1.'.title as jenis_barang,
			'.$this->table_join1.'.title as jenis_barang_id,
			'.$this->table_join2.'.title as satuan,
			'.$this->table_inv.'.harga,
			'.$this->table_inv.'.penyusutan,
			'.$this->table_inv.'.tgl,
			');
		$this->db->from($this->table);
		$this->db->join($this->table_join1, $this->table_join1.'.id = '.$this->table.'.jenis_barang_id', 'left');
		$this->db->join($this->table_join2, $this->table_join2.'.id = '.$this->table.'.satuan', 'left');
		$this->db->join('barang_inventaris_detail', 'barang_inventaris_detail'.'.barang_id = '.$this->table.'.id', 'left');
		$this->db->join('jenis_barang_inventaris', 'barang_inventaris_detail'.'.jenis_barang_inventaris_id = '.'barang_inventaris_detail'.'.id', 'left');

		$i = 0;
	
		foreach ($this->column as $item) // loop column 
		{
			if($_POST['search']['value'])
			{
				if($item == 'kode'){
					$item = $this->table.'.kode';
				}elseif($item == 'title'){
					$item = $this->table.'.title';
				}elseif($item == 'jenis_barang'){
					$item = $this->table_join1.'.title';
				}elseif($item == 'satuan'){
					$item = $this->table_join2.'.title';
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

	function get_datatables($inv = null)
	{
		$this->_get_datatables_query();
		if($inv != null){
			$this->db->where('jenis_barang_id', 3);
		}else{
			$this->db->where_in('jenis_barang_id', array('1', '2'));
		}
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


	public function get_by_inv_id($id)
	{
		$this->db->select(
			$this->table.'.id as id,
			'.$this->table.'.kode as kode,
			'.$this->table.'.title as title,
			'.$this->table.'.photo,
			'.$this->table.'.alias,
			'.$this->table.'.merk,
			'.$this->table.'.satuan,
			'.$this->table.'.satuan_laporan,
			'.$this->table.'.catatan,
			'.$this->table.'.attachment,
			'.'b.jenis_barang_inventaris_id,
			');
		$this->db->from($this->table);
		$this->db->join('barang_inventaris_detail as b', $this->table.'.id = b.barang_id', 'left');
		$this->db->where('barang.id',$id);
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

	public function get_satuan()
	{	
		$this->db->where($this->table_join2.'.is_deleted',0);
		$this->db->order_by($this->table_join2.'.title','asc');
		return $this->db->get($this->table_join2);
	}

	public function get_jenis_barang()
	{	
		$this->db->where($this->table_join1.'.is_deleted',0);
		$this->db->order_by($this->table_join1.'.title','asc');
		return $this->db->get($this->table_join1);
	}

	public function get_jenis_barang_inventaris()
	{	
		$this->db->order_by('jenis_barang_inventaris.title','asc');
		return $this->db->get('jenis_barang_inventaris');
	}

	public function get_barang()
	{
		
		$this->db->select(
			$this->table.'.id as id,
			'.$this->table.'.kode as kode,
			'.$this->table.'.title as title,
			'.$this->table.'.alias,
			'.$this->table_join1.'.title as jenis_barang,
			'.$this->table_join2.'.title as satuan,
			'.'b.title as satuan_laporan,
			');
		$this->db->from($this->table);
		$this->db->join($this->table_join1, $this->table_join1.'.id = '.$this->table.'.jenis_barang_id', 'left');
		$this->db->join($this->table_join2, $this->table_join2.'.id = '.$this->table.'.satuan', 'left');
		$this->db->join("$this->table_join2 as b", 'b.id = '.$this->table.'.satuan_laporan', 'left');
		//$this->db->limit(10);
		$q = $this->db->get();
		return $q->result_array();
	}
}
