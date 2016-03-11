<?php defined('BASEPATH') OR exit('No direct script access allowed');

class chat extends MX_Controller {
    public $data;
    var $module = 'chat';
    var $title = 'Notifikasi';
    var $file_name = 'chat';
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
        $this->_render_page('notification/index',$this->data);
    }

    function detail($id){
        $data['id'] = $id;
        $sess_id = sessId();    
        $data['sess_name'] = getName(sessId());
        $data['buddy_name'] = getName($id);
        $q = "SELECT *
            FROM chat
            WHERE (sender_id = '$sess_id' AND receiver_id = '$id')
            OR (sender_id = '$id' AND receiver_id = '$sess_id')
            order by sent_on desc
            limit 10
            ";
        $data['message'] = $this->db->query($q);//lastq();
        $data['photo'] = '';
        $data['photo_chat'] = '';
        $this->db->where('sender_id', $id)->update('chat', array('is_read'=>1));
        $this->load->view('chat/detail', $data);
    }

    function lists(){
        $data['users']=getAll('users', array('username'=>'order/asc'), array('!=id'=>sessId())); 
        $this->load->view('chat/list', $data);
    }

    function send(){
        $sess_id = sessId();    
        $data = array('sender_id' => sessId(),
                      'receiver_id'=> $this->input->post('receiver_id'),
                      'message'=>$this->input->post('msg'),
                      'sent_on'=>dateNow(),
            );
        $this->db->insert('chat', $data);
        $id = $this->input->post('receiver_id');
        $data['id'] = $id;
        $data['sess_name'] = getName(sessId());
        $data['buddy_name'] = getName($id);
       $q = "SELECT *
            FROM chat
            WHERE (sender_id = '$sess_id' AND receiver_id = '$id')
            OR (sender_id = '$id' AND receiver_id = '$sess_id')
            order by sent_on desc
            limit 10
            ";
        $data['message'] = $this->db->query($q);//lastq();
        $data['photo'] = '';
        $data['photo_chat'] = '';

        $this->load->view('chat/detail', $data);
    }
}