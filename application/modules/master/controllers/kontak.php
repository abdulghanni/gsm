<?php defined('BASEPATH') OR exit('No direct script access allowed');

class kontak extends MX_Controller {
    public $data;
    var $module = 'master';
    var $title = 'Kontak';
    var $file_name = 'kontak';

	function __construct()
	{
		parent::__construct();
        $this->load->database();
		$this->load->model($this->module.'/'.$this->file_name.'_model', 'main');
	}

	function index()
	{
        permissionUser();
        $this->data['title'] = $this->title;
        $this->data['file_name'] = $this->file_name;
        $this->data['module'] = $this->module;
		$this->_render_page($this->module.'/'.$this->file_name, $this->data);
	}

    public function ajax_list()
    {
        permissionUser();
        $list = $this->main->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->kode;
            $row[] = $r->title;
            $row[] = $r->jenis;
            $row[] = $r->tipe;
            $row[] = $r->email;


            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0);" title="Detail" onclick="detail_user('."'".$r->id."'".')"><i class="fa fa-info"></i></a>
                      <a class="btn btn-sm btn-primary" href="javascript:void(0);" title="Edit" onclick="edit_user('."'".$r->id."'".')"><i class="fa fa-pencil"></i></a>
                      <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_user('."'".$r->id."'".')"><i class="fa fa-trash"></i></a>';
        
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

    function add()
    {
        $this->data['title'] = 'Tambah '.$this->title;
        $this->data['file_name'] = $this->file_name;
        $this->data['module'] = $this->module;
        permissionUser();
        $filter = array('is_deleted'=>0);
        $this->data['jenis'] = getAll('kontak_jenis', $filter);
        $this->data['tipe'] = getAll('kontak_tipe', $filter);
        $this->_render_page($this->module.'/'.$this->file_name.'/add', $this->data);
    }

    function edit($id)
    {
        $this->data['title'] = 'Edit '.$this->title;
        $this->data['file_name'] = $this->file_name;
        $this->data['module'] = $this->module;
        permissionUser();
        $filter = array('is_deleted'=>0);
        $this->data['jenis'] = getAll('kontak_jenis', $filter);
        $this->data['tipe'] = getAll('kontak_tipe', $filter);
        $this->data['r'] = $r = $this->main->get_detail($id);
        $this->data['up'] = explode(',', $r->up);
        $this->data['telepon'] = explode(',', $r->telepon);
        $this->data['alamat'] = explode(',', $r->alamat);
        $this->_render_page($this->module.'/'.$this->file_name.'/edit', $this->data);
    }

    public function ajax_edit($id)
    {
        $data = $this->main->get_by_id($id); // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }

    public function ajax_add()
    {
        permissionUser();
        $data = array(
                'kode' => $this->input->post('kode'),
                'title' => $this->input->post('title'),
                'jenis_id' => $this->input->post('jenis_id'),
                'tipe_id' => $this->input->post('tipe_id'),
                'up' => implode(',', $this->input->post('up')),
                'telepon' => implode(',', $this->input->post('telepon')),
                'alamat' => implode(',', $this->input->post('alamat')),
                'email' => $this->input->post('email'),
                'fax' => $this->input->post('fax'),
                'created_by' => sessId(),
                'created_on' => dateNow(),
            );
        $insert = $this->main->save($data);
        redirect(base_url().$this->module.'/'.$this->file_name, 'refresh');
        //echo json_encode(array("status" => TRUE));
    }

    public function ajax_update()
    {
        $data = array(
                'kode' => $this->input->post('kode'),
                'title' => $this->input->post('title'),
                'jenis_id' => $this->input->post('jenis_id'),
                'tipe_id' => $this->input->post('tipe_id'),
                'up' => implode(',', $this->input->post('up')),
                'telepon' => implode(',', $this->input->post('telepon')),
                'alamat' => implode(',', $this->input->post('alamat')),
                'email' => $this->input->post('email'),
                'fax' => $this->input->post('fax'),
                'edited_by' => sessId(),
                'edited_on' => dateNow(),
            );
        $this->main->update(array('id' => $this->input->post('id')), $data);
         redirect(base_url().$this->module.'/'.$this->file_name, 'refresh');
        //echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->main->delete_by_id($id);
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
                }elseif(in_array($view, array($this->module.'/'.$this->file_name.'/add',
                                              $this->module.'/'.$this->file_name.'/edit'
                    )))
                {
                    $this->template->set_layout('default');

                    $this->template->add_css('vendor/DataTables/css/DT_bootstrap.css');
                    $this->template->add_css('vendor/select2/select2.css');

                    $this->template->add_js('vendor/jquery-validation/jquery.validate.min.js');
                    $this->template->add_js('assets/js/form-validation.js');
                    $this->template->add_js('vendor/DataTables/js/jquery.dataTables.min.js');
                    $this->template->add_js('vendor/select2/select2.min.js');
                    $this->template->add_js('assets/js/'.$this->module.'/kontak/add.js');
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