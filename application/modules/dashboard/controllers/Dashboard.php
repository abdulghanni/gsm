<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller {
    public $data;
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// redirect if needed, otherwise display the user list
	function index()
	{
        permissionUser();
		$this->_render_page('dashboard/index', $this->data);
	}

    function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

                if(in_array($view, array('dashboard/index')))
                {
                    $this->template->set_layout('default');


                    $this->template->add_js('vendor/Chart.js/Chart.min.js');
                    $this->template->add_js('vendor/jquery.sparkline/jquery.sparkline.min.js');
                     $this->template->add_js('assets/js/dashboard/index.js');
                     $this->template->add_script('Index.init();');
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