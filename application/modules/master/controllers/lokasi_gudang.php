<?php defined('BASEPATH') OR exit('No direct script access allowed');

class lokasi_gudang extends MX_Controller {
    public $data;
    var $module = 'master';
    var $title = 'lokasi_gudang';
    var $file_name = 'lokasi_gudang';
	function __construct()
	{
		parent::__construct();
        $this->load->database();
		$this->load->model($this->module.'/'.$this->file_name.'_model', $this->file_name);
        //$this->lang->load('master/lokasi_gudang');
	}

	// redirect if needed, otherwise display the user list
	function index()
	{
        permissionUser();
		$this->_render_page($this->module.'/'.$this->file_name, $this->data);
	}

    public function ajax_list()
    {
        permissionUser();
        $list = $this->lokasi_gudang->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $lokasi_gudang) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $lokasi_gudang->kode;
            $row[] = $lokasi_gudang->title;


            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0);" title="Edit" onclick="edit_user('."'".$lokasi_gudang->id."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_user('."'".$lokasi_gudang->id."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->lokasi_gudang->count_all(),
                        "recordsFiltered" => $this->lokasi_gudang->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $data = $this->lokasi_gudang->get_by_id($id); // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }

    public function ajax_add()
    {
        ////$this->_validate();
        $data = array(
                'kode' => $this->input->post('kode'),
                'title' => $this->input->post('title'),
                'catatan' => $this->input->post('catatan'),
                'created_by' => sessId(),
                'created_on' => dateNow(),
            );
        $insert = $this->lokasi_gudang->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update()
    {
        //$this->_validate();
        $data = array(
                'kode' => $this->input->post('kode'),
                'title' => $this->input->post('title'),
                'catatan' => $this->input->post('catatan'),
                'edited_by' => sessId(),
                'edited_on' => dateNow(),
            );
        $this->lokasi_gudang->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->lokasi_gudang->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
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