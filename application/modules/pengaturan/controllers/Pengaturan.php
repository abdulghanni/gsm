<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends MX_Controller {
    public $data;
	function __construct()
	{
		parent::__construct();
		$this->load->database();
        $this->load->library('authentication', NULL, 'ion_auth');
	}

	// redirect if needed, otherwise display the user list
	function index()
	{
        permissionAdmin();
		redirect('pengaturan/satuan','refresh');
	}

    function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

                if(in_array($view, array('pengaturan/index')))
                {
                    $this->template->set_layout('default');
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