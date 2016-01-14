<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MX_Controller {
    public $data;
    var $module = 'master';
    var $title = 'Customer';
    var $file_name = 'customer';

	function __construct()
	{
		parent::__construct();
        $this->load->database();
		$this->load->model($this->module.'/'.$this->file_name.'_model', $this->file_name);
        //$this->lang->load($this->module.'/'.$this->file_name);
	}

	// redirect if needed, otherwise display the user list
	function index()
	{
		$this->_render_page($this->module.'/'.$this->file_name, $this->data);
	}

    public function ajax_list()
    {
        $list = $this->customer->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->kode;
            $row[] = $r->title;
            $row[] = $r->tipe;
            $row[] = $r->up;
            $row[] = $r->jabatan;
            $row[] = $r->telp_1;
            $row[] = $r->telp_2;
            $row[] = $r->email;
            $row[] = $r->alamat;


            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0);" title="Edit" onclick="edit_user('."'".$r->id."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_user('."'".$r->id."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->customer->count_all(),
                        "recordsFiltered" => $this->customer->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $data = $this->customer->get_by_id($id); // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }

    public function ajax_add()
    {
        $data = array(
                'kode' => $this->input->post('kode'),
                'title' => $this->input->post('title'),
                'tipe' => $this->input->post('tipe'),
                'up' => $this->input->post('up'),
                'jabatan' => $this->input->post('jabatan'),
                'telp_1' => $this->input->post('telp_1'),
                'telp_2' => $this->input->post('telp_2'),
                'email' => $this->input->post('email'),
                'alamat' => $this->input->post('alamat'),
            );
        $insert = $this->customer->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update()
    {
        $data = array(
                'kode' => $this->input->post('kode'),
                'title' => $this->input->post('title'),
                'tipe' => $this->input->post('tipe'),
                'up' => $this->input->post('up'),
                'jabatan' => $this->input->post('jabatan'),
                'telp_1' => $this->input->post('telp_1'),
                'telp_2' => $this->input->post('telp_2'),
                'email' => $this->input->post('email'),
                'alamat' => $this->input->post('alamat'),
            );
        $this->customer->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->customer->delete_by_id($id);
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