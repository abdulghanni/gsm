<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends MX_Controller {
    public $data;
    var $module = 'notification';
    var $title = 'Notifikasi';
    var $file_name = 'notification';
    var $main_title = 'Notifikasi';
    var $table_name = 'notifikasi';
	function __construct()
	{
		parent::__construct();
	}

	// redirect if needed, otherwise display the user list
	function index()
	{
        permissionUser();
        $num_rows = getAll($this->table_name, array('receiver_id'=>'where/'.sessId()))->num_rows();
        $this->data['last_id']=$last_id = ($num_rows>0) ? $this->db->select('id')->where('receiver_id', sessId())->order_by('id', 'asc')->get($this->table_name)->last_row()->id : 0;
        $this->data['last_notif'] = getAll($this->table_name, array('receiver_id'=>'where/'.sessId(), 'id'=>'where/'.$last_id))->row();
        $this->data['all_notification'] = GetAll('notifikasi', array('receiver_id'=>'where/'.sessId(), 'id'=>'order/desc'));
		$this->_render_page('message/index',$this->data);
	}

    function detail($id){
        permissionUser();
        $notif = $this->data['notif'] = getAll($this->table_name, array('receiver_id'=>'where/'.sessId(), 'id'=>'where/'.$id))->row();
        $photo_link = getValue('photo', 'users', array('id'=>'where/'.$notif->sender_id));
        $photo_link = base_url().'uploads/'.$notif->sender_id.'/'.$photo_link;
        $file_headers = @get_headers($photo_link);
        $this->data['sender_photo'] = ($file_headers[0] != 'HTTP/1.1 404 Not Found') ? $photo_link : assets_url('assets/images/no-image-mid.png');
        $this->load->view('notification/detail', $this->data);
    }

    public function list_clicked()
    {
        permissionUser();
        $id = $this->input->post('id');
        $url = getValue('url', $this->table_name, array('id'=>'where/'.$id));
        $this->db->where('id', $id)->update($this->table_name, array('is_read'=>1));
        echo $url;
    }

    public function item_clicked()
    {
        permissionUser();
        $id = $this->input->post('id');
        $this->db->where('id', $id)->update($this->table_name, array('is_read'=>1));
        return true;
    }

    public function load_badge()
    {
        $data['notification_num'] = GetAll('notifikasi', array('is_read'=>'where/0', 'receiver_id'=>'where/'.sessId()))->num_rows();
        $this->load->view('notification/badges', $data);
    }

    public function load_notif_header(){
        $data['notification'] = GetAll('notifikasi', array('is_read'=>'where/0', 'receiver_id'=>'where/'.sessId(), 'limit'=>'limit/3', 'id'=>'order/desc'));
        $data['notifications'] = GetAll('notifikasi', array('is_read'=>'where/0', 'receiver_id'=>'where/'.sessId(), 'id'=>'order/desc'));
        $data['notification_num'] = GetAll('notifikasi', array('is_read'=>'where/0', 'receiver_id'=>'where/'.sessId()))->num_rows();

        $this->load->view('notification/header', $data);
    }

    function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

                if(in_array($view, array('notification/index')))
                {
                    $this->template->set_layout('default');

                $this->template->add_js('assets/js/pages-messages.js');
                $this->template->add_js('assets/js/'.$this->module.'/index.js');
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