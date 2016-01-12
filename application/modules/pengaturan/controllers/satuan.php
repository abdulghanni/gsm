<?php defined('BASEPATH') OR exit('No direct script access allowed');

class satuan extends MX_Controller {
    public $data;
	function __construct()
	{
		parent::__construct();
        $this->load->database();
		$this->load->model('pengaturan/satuan_model', 'satuan');
        //$this->lang->load('pengaturan/satuan');
	}

	// redirect if needed, otherwise display the user list
	function index()
	{
        permissionUser();
		$this->_render_page('pengaturan/satuan/index', $this->data);
	}

    public function ajax_list()
    {
        $list = $this->satuan->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $satuan) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $satuan->title;


            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0);" title="Edit" onclick="edit_user('."'".$satuan->id."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_user('."'".$satuan->id."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->satuan->count_all(),
                        "recordsFiltered" => $this->satuan->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $data = $this->satuan->get_by_id($id); // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }

    public function ajax_add()
    {
        ////$this->_validate();
        $data = array(
                'title' => $this->input->post('title'),
            );
        $insert = $this->satuan->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update()
    {
        //$this->_validate();
        $data = array(
                'title' => $this->input->post('title'),
            );
        $this->satuan->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->satuan->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
    
	function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

                if(in_array($view, array('pengaturan/satuan/index')))
                {
                    $this->template->set_layout('default');

                    $this->template->add_css('vendor/DataTables/css/DT_bootstrap.css');
                    $this->template->add_css('vendor/select2/select2.css');

                    $this->template->add_js('vendor/jquery-validation/jquery.validate.min.js');
                    $this->template->add_js('assets/js/form-validation.js');
                    $this->template->add_js('vendor/DataTables/js/jquery.dataTables.min.js');
                    $this->template->add_js('vendor/select2/select2.min.js');
                    $this->template->add_js('assets/js/pengaturan/satuan/index.js');
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