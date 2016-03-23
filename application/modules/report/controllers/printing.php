<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Printing extends MX_Controller {
    public $data;
    var $module = 'report';
    var $title = 'Custom Report';
    var $file_name = 'report';
    var $fonts='Comic Sans Ms';
    var $header='#8F9258';

	function __construct()
	{
		parent::__construct();
        $this->load->database();
		$this->load->model('report/Report_model', 'stok');
        $this->lang->load('master/stok');
	}

    var $model_name = 'stok';

	// redirect if needed, otherwise display the user list
	function index()
	{
        $this->data['title'] = $this->title;
        $this->data['main_title'] = $this->module.'';
		$q=$this->stok->get_judul();
		$this->data['tipedokumen']= $q->result();
		$filter['statusisasi']='where/1';
		if($this->session->userdata('webmaster_grup')==10){
			$filter['id']='where/2';
		}
		$this->data['opt_dok']=GetOptAll('report','-Document-',$filter,'title_document');
        $this->data['options_barang'] = options_row($this->model_name,'get_barang','kode','title','-- Pilih Barang --');
        $this->data['options_satuan'] = options_row($this->model_name,'get_satuan','id','title','-- Pilih Satuan --');
        $this->data['options_gudang'] = options_row($this->model_name,'get_gudang','id','title','-- Pilih Gudang --');
        $this->data['options_kurensi'] = options_row($this->model_name,'get_kurensi','id','title','-- Pilih Kurensi --');
		$this->_render_page('report/menu/menu', $this->data);
	}
	function response_cat($id=null){
		//error_reporting(0);
		if($id!=''){
			
			/* $qdep=$this->model_getdata->get_department();
			$data['listdep']=$qdep->result();
			$data['bulan']=$this->model_getdata->namabulan(); */
			$data['document']=GetAll('report',array('id'=>'where/'.$id));
			
			
			if($data['document']->num_rows()>0){
				$this->load->view('report/category/main',$data);
			}
			else{
				echo "Dokumen Tidak Ditemukan";
			}
		}
	}
        
	function sales_order(){
            error_reporting(E_ALL);
                        $data['autoprint']=FALSE;
			$sd=$this->input->post('start_date');
			$ed=$this->input->post('end_date');
			$data['period']=$sd.' / '.$ed;
			$data['kolom']=$this->input->post('kolom');
			$data['q']=$this->db->query("SELECT * FROM sales_order WHERE tanggal_transaksi >= '$sd' AND tanggal_transaksi <= '$ed' ")->result();
                        $data['content']='sales/sales_order';
			$this->load->view('layout/main',$data);
                 // $this->load->view('layout/sales_order',$data);

	}
        
	function stok_history(){
                        $data['autoprint']=FALSE;
			$sd=$this->input->post('start_date');
			$ed=$this->input->post('end_date');
                        
                        
                        $q="SELECT * FROM stok_log WHERE tgl >= '$sd' AND tgl <= '$ed' ";
                        
                        if($this->input->post('barang')){$q.=" AND barang='".$this->input->post('barang')."' ";}
                        if($this->input->post('gudang')){$q.=" AND gudang='".$this->input->post('gudang')."' ";}
                        //echo $this->db->last_query();
			$data['period']=$sd.' / '.$ed;
			$data['kolom']=$this->input->post('kolom');
			$data['q']=$this->db->query($q)->result_array();
                        $data['content']='stok/history';
			$this->load->view('layout/main',$data);
                 // $this->load->view('layout/sales_order',$data);

	}
	function purchase_order(){
                        $data['autoprint']=FALSE;
			$sd=$this->input->post('start_date');
			$ed=$this->input->post('end_date');
                        
                        
                        $q="SELECT * FROM purchase_order WHERE tanggal_transaksi >= '$sd' AND tanggal_transaksi <= '$ed' ";
			$data['period']=date('d-m-Y',strtotime($sd)).' s/d '.date('d-m-Y',strtotime($ed));
			$data['kolom']=$this->input->post('kolom');
			$data['q']=$this->db->query($q)->result_array();
                        $data['content']='purchase/order';
			$this->load->view('layout/main',$data);
                 // $this->load->view('layout/sales_order',$data);

	}
}