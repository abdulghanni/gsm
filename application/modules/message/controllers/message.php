<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends MX_Controller {
    public $data;
    var $table_name = 'chat';
	function __construct()
	{
		parent::__construct();
	}

	// redirect if needed, otherwise display the user list
	function index()
	{
		$this->_render_page('message/index',$this->data);
	}



    public function message_clicked()
    {
        permissionUser();
        $id = $this->input->post('id');
        $f_name = getValue('sender_id', 'chat', array('id'=>'where/'.$id));
        $this->db->where('sender_id', $f_name)->update($this->table_name, array('is_read'=>1));
        echo base_url('message');
    }

    function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

                if(in_array($view, array('message/index')))
                {
                    $this->template->set_layout('default');

                $this->template->add_js('assets/js/pages-messages.js');
                $this->template->add_script('Messages.init();');
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