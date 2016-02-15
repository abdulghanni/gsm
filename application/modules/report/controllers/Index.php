<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MX_Controller {
    public $data;
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

    public function ajax_list()
    {
        $list = $this->stok->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $stok) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $stok->kode;
            $row[] = $stok->barang;
            $row[] = $stok->jumlah;
            $row[] = $stok->satuan;
            $row[] = $stok->kurensi.'.'.$stok->harga;
            $row[] = $stok->gudang;
            $row[] = $stok->lokasi_gudang;


            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0);" title="Edit" onclick="edit_user('."'".$stok->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_user('."'".$stok->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->stok->count_all(),
                        "recordsFiltered" => $this->stok->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $data = $this->stok->get_by_id($id); // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }

    public function ajax_add()
    {
        //$this->_validate();
        $data = array(
                'kode' => $this->input->post('kode'),
                'jumlah' => $this->input->post('jumlah'),
                'unit_id' => $this->input->post('satuan'),
                'kurensi_id' => $this->input->post('kurensi_id'),
                'harga' => $this->input->post('harga'),
                'gudang_id' => $this->input->post('gudang_id'),
            );
        $insert = $this->stok->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update()
    {
        //$this->_validate();
        $data = array(
                'kode' => $this->input->post('kode'),
                'jumlah' => $this->input->post('jumlah'),
                'unit_id' => $this->input->post('satuan'),
                'kurensi_id' => $this->input->post('kurensi_id'),
                'harga' => $this->input->post('harga'),
                'gudang_id' => $this->input->post('gudang_id'),
            );
        $this->stok->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->stok->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
    
	function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

                if(in_array($view, array('master/stok/index')))
                {
                    $this->template->set_layout('default');

                    $this->template->add_css('vendor/DataTables/css/DT_bootstrap.css');
                    $this->template->add_css('vendor/select2/select2.css');

                    $this->template->add_js('vendor/jquery-validation/jquery.validate.min.js');
                    $this->template->add_js('assets/js/form-validation.js');
                    $this->template->add_js('vendor/DataTables/js/jquery.dataTables.min.js');
                    $this->template->add_js('vendor/select2/select2.min.js');
                    $this->template->add_js('assets/js/master/stok/index.js');
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