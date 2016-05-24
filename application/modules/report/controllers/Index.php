<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MX_Controller {
    public $data;
    var $module = 'report';
    var $title = 'Custom Report';
    var $file_name = 'report';
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
        permissionUser();
        $this->data['title'] = $this->title;
        $this->data['main_title'] = $this->module.'';
		$q=$this->stok->get_judul();
		$this->data['tipedokumen']= $q->result();
		$filter['statusisasi']='where/1';
		if($this->session->userdata('webmaster_grup')==10){
			$filter['id']='where/2';
		}
		$this->data['opt_dok']=GetOptDoc();
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

	function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

                if(in_array($view, array('report/menu/menu')))
                {
                    $this->template->set_layout('default');

                    $this->template->add_css('vendor/DataTables/css/DT_bootstrap.css');
                    $this->template->add_css('vendor/select2/select2.css');

                    $this->template->add_js('vendor/jquery-validation/jquery.validate.min.js');
                    $this->template->add_js('assets/js/form-validation.js');
                    $this->template->add_js('vendor/DataTables/js/jquery.dataTables.min.js');
                    $this->template->add_js('vendor/select2/select2.min.js');
                    //$this->template->add_js('assets/js/master/stok/index.js');
                }

            if ( ! empty($data['title']))
            {
                $this->template->set_title($data['title']);
            }

            $this->template->load_view($view, $data);
        }
        else
        {
            return $this->load->view($view, $data, TRUE);
        }
    }
}