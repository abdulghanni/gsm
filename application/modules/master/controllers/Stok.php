<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Stok extends MX_Controller {
    public $data;
    var $module = 'master';
    var $title = 'stok';
    var $file_name = 'stok';

	function __construct()
	{
		parent::__construct();
        $this->load->database();
		$this->load->model('master/Stok_model', 'main');
        $this->lang->load('master/stok');
	}

    var $model_name = 'main';

	// redirect if needed, otherwise display the user list
	function index()
	{
        permissionUser();
        $this->data['options_barang'] = options_row($this->model_name,'get_barang','id','title','-- Pilih Barang --', 'kode');
        $this->data['options_gudang'] = options_row($this->model_name,'get_gudang','id','title','-- Semua Gudang --');
        $this->data['options_kurensi'] = options_row($this->model_name,'get_kurensi','id','title','-- Pilih Kurensi --');
        $this->data['options_supplier'] = options_row('main','get_supplier','id','title','-- Pilih Supplier --');
		$this->_render_page($this->module.'/'.$this->file_name, $this->data);
	}

    public function ajax_list()
    {
		//error_reporting(E_ALL);
        permissionUser();
        $list = $this->main->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->kode;
            $row[] = $r->barang;
            $row[] = $r->dalam_stok;
            $row[] = $r->satuan;
            $row[] = $r->harga_beli;
            $row[] = $r->harga_jual;
            $row[] = $r->gudang;
            $row[] = $r->lokasi_detail;


            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0);" title="Edit" onclick="edit_user('."'".$r->id."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_user('."'".$r->id."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->main->count_all(),
                        "recordsFiltered" => $this->main->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $data = $this->main->get_by_id($id); // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }

    public function ajax_add()
    {
        //$this->_validate();
        $data = array(
                'barang_id' => $this->input->post('barang_id'),
                'gudang_id' => $this->input->post('gudang_id'),
                'supplier_id' => $this->input->post('supplier_id'),
                'dalam_stok' => $this->input->post('dalam_stok'),
                'minimum_stok' => $this->input->post('minimum_stok'),
                'harga_beli'=>$this->input->post('harga_beli'),
                'harga_jual'=>$this->input->post('harga_jual'),
                'lokasi_detail'=>$this->input->post('lokasi_detail'),
                'created_by' => sessId(),
                'created_on' => dateNow(),
            );
        $insert = $this->main->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update()
    {
        //$this->_validate();
        $data = array(
                'gudang_id' => $this->input->post('gudang_id'),
                'supplier_id' => $this->input->post('supplier_id'),
                'dalam_stok' => $this->input->post('dalam_stok'),
                'minimum_stok' => $this->input->post('minimum_stok'),
                'harga_beli'=>$this->input->post('harga_beli'),
		'harga_jual'=>$this->input->post('harga_jual'),
		'lokasi_detail'=>$this->input->post('lokasi_detail')
            );
        $this->main->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->main->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    //JS FUNCTION

    function get_satuan($id)
    {
        $satuan = getValue('satuan_id', 'barang', array('id'=>'where/'.$id));
        $satuan = getValue('title','satuan', array('id'=>'where/'.$satuan));

        echo json_encode($satuan);
    }
    
	function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

                if(in_array($view, array($this->module.'/'.$this->file_name)))
                {
                    $this->template->set_layout('default');

                    $this->template->add_css('vendor/DataTables/css/DT_bootstrap.css');
                    $this->template->add_css('vendor/select2/select2.css');

                    $this->template->add_js('vendor/jquery-validation/jquery.validate.min.js');
                    $this->template->add_js('assets/js/form-validation.js');
                    $this->template->add_js('vendor/DataTables/js/jquery.dataTables.min.js');
                    $this->template->add_js('vendor/select2/select2.min.js');
                    $this->template->add_js('assets/js/'.$this->module.'/'.$this->file_name.'.js');
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