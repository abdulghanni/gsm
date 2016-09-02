<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends MX_Controller {
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
	function index($id = "fn:")
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
		$this->data['opt_dok']=$this->GetOptDoc($id);
        $this->data['options_barang'] = options_row($this->model_name,'get_barang','kode','title','-- Pilih Barang --');
        $this->data['options_satuan'] = options_row($this->model_name,'get_satuan','id','title','-- Pilih Satuan --');
        $this->data['options_gudang'] = options_row($this->model_name,'get_gudang','id','title','-- Pilih Gudang --');
        $this->data['options_kurensi'] = options_row($this->model_name,'get_kurensi','id','title','-- Pilih Kurensi --');
		$this->_render_page('report/menu/menu', $this->data);
	}
    
    function lists($id = null)
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
        $this->data['opt_dok']=$this->GetOptDoc($id);
        $this->data['options_barang'] = options_row($this->model_name,'get_barang','kode','title','-- Pilih Barang --');
        $this->data['options_satuan'] = options_row($this->model_name,'get_satuan','id','title','-- Pilih Satuan --');
        $this->data['options_gudang'] = options_row($this->model_name,'get_gudang','id','title','-- Pilih Gudang --');
        $this->data['options_kurensi'] = options_row($this->model_name,'get_kurensi','id','title','-- Pilih Kurensi --');
        $this->_render_page('report/menu/menu', $this->data);
    }
    

    function GetOptDoc($group_id, $tabel='report',$judul='-Laporan-',$filter=NULL,$field=NULL,$id=NULL,$field2=NULL,$filter_where_in=NULL)
    {
        $CI =& get_instance();
        $user_id =$CI->session->userdata('user_id');
        if($filter==NULL)$filter = array();
        if($filter_where_in==NULL)$filter_where_in = array();
        if($field==NULL)$field='title';
        if($id==NULL)$id='id';
        $q = $CI->db->query("SELECT a.id id, a.title_document title_document FROM report a LEFT JOIN report_permission b ON b.menu_id=a.id AND b.user_id = '$user_id' WHERE b.view='1' AND a.statusisasi='1' ORDER BY  a.title_document ASC");
        if($judul) $opt[''] = $judul;
        foreach($q->result_array() as $r)
        {
            $in_group_id = getValue('group_id', 'report', array('id'=>'where/'.$r[$id]));
        // die($r['id']);
            $in_group_id = explode(',', $in_group_id);
            if(in_array($group_id, $in_group_id))
            $opt[$r[$id]] = $r['title_document'];
        }
        
        return $opt;
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

                    $this->template->add_css('vendor/select2/select2.css');
                     $this->template->add_css('vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css');
                    $this->template->add_js('vendor/jquery-validation/jquery.validate.min.js');
                    $this->template->add_js('assets/js/form-validation.js');
                    $this->template->add_js('vendor/select2/select2.min.js');
                    $this->template->add_js('vendor/bootstrap-datepicker/bootstrap-datepicker.min.js');
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