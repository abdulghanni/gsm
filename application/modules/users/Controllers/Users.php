<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MX_Controller {
    public $data;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model','users');
    }

    public function index()
    {
        permissionAdmin();
        $groups=$this->ion_auth->groups()->result_array();
        $this->data['groups'] = $groups;

        $this->data['full_name'] = array(
            'name'  => 'full_name',
            'id'    => 'full_name',
            'type'  => 'text',
        );
        $this->data['username'] = array(
            'name'  => 'username',
            'id'    => 'username',
            'type'  => 'text',
        );
        $this->data['email'] = array(
            'name'  => 'email',
            'id'    => 'email',
            'type'  => 'text',
        );
        $this->data['phone'] = array(
            'name'  => 'phone',
            'id'    => 'phone',
            'type'  => 'text',
        );
        $this->data['password'] = array(
            'name' => 'password',
            'id'   => 'password',
            'type' => 'password'
        );
        $this->data['password_confirm'] = array(
            'name' => 'password_confirm',
            'id'   => 'password_confirm',
            'type' => 'password'
        );
        $this->data['options_user'] = options_row('users', 'get_users','id','full_name', '-- Pilih Pengguna --');

        $this->_render_page('users/index', $this->data);
    }

    //TAB USERS
    function edit_user($id)
    {
        //print_mz($this->input->post('photo'));
        $this->data['title'] = "Edit User";
        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id)))
        {
            redirect('auth', 'refresh');
        }

        $user = $this->ion_auth->user($id)->row();
        $groups=$this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();

        // validate form input
        $this->form_validation->set_rules('full_name', $this->lang->line('edit_user_validation_fullname_label'), 'required');
        $this->form_validation->set_rules('username', $this->lang->line('edit_user_validation_username_label'), 'required');
        $this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required');
        $this->form_validation->set_rules('email', $this->lang->line('edit_user_validation_company_label'), 'required');

        if (isset($_POST) && !empty($_POST))
        {
            // do we have a valid request?
            /*if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
            {
                show_error($this->lang->line('error_csrf'));
            }
            */
            // update the password if it was posted
            if ($this->input->post('password'))
            {
                $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
            }

            if ($this->form_validation->run() === TRUE)
            {
                $data = array(
                    'full_name' => $this->input->post('full_name'),
                    'username'  => $this->input->post('username'),
                    'email'    => $this->input->post('email'),
                    'phone'      => $this->input->post('phone'),
                );

                // update the password if it was posted
                if ($this->input->post('password'))
                {
                    $data['password'] = $this->input->post('password');
                }



                // Only allow updating groups if user is admin
                if ($this->ion_auth->is_admin())
                {
                    //Update the groups user belongs to
                    $groupData = $this->input->post('groups');

                    if (isset($groupData) && !empty($groupData)) {

                        $this->ion_auth->remove_from_group('', $id);

                        foreach ($groupData as $grp) {
                            $this->ion_auth->add_to_group($grp, $id);
                        }

                    }
                }

            // check to see if we are updating the user
               if($this->ion_auth->update($user->id, $data))
                {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->upload($id);
                    $this->session->set_flashdata('message', $this->ion_auth->messages() );
                    if ($this->ion_auth->is_admin())
                    {
                        redirect('users', 'refresh');
                    }
                    else
                    {
                        redirect('/', 'refresh');
                    }

                }
                else
                {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->errors() );
                    if ($this->ion_auth->is_admin())
                    {
                        redirect('users/edit_users/'.$id, 'refresh');
                    }
                    else
                    {
                        redirect('/', 'refresh');
                    }

                }

            }
        }

        // display the edit user form
        $this->data['csrf'] = $this->_get_csrf_nonce();

        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        // pass the user to the view
        $this->data['user'] = $user;
        $this->data['groups'] = $groups;
        $this->data['currentGroups'] = $currentGroups;

        $this->data['full_name'] = array(
            'name'  => 'full_name',
            'id'    => 'full_name',
            'type'  => 'text',
            'value' => $this->form_validation->set_value('full_name', $user->full_name),
        );
        $this->data['username'] = array(
            'name'  => 'username',
            'id'    => 'username',
            'type'  => 'text',
            'value' => $this->form_validation->set_value('username', $user->username),
        );
        $this->data['email'] = array(
            'name'  => 'email',
            'id'    => 'email',
            'type'  => 'text',
            'value' => $this->form_validation->set_value('email', $user->email),
        );
        $this->data['phone'] = array(
            'name'  => 'phone',
            'id'    => 'phone',
            'type'  => 'text',
            'value' => $this->form_validation->set_value('phone', $user->phone),
        );
        $this->data['password'] = array(
            'name' => 'password',
            'id'   => 'password',
            'type' => 'password'
        );
        $this->data['password_confirm'] = array(
            'name' => 'password_confirm',
            'id'   => 'password_confirm',
            'type' => 'password'
        );
        $photo_link = base_url().'uploads/'.$user->id.'/'.$user->photo;
        $file_headers = @get_headers($photo_link);
        $this->data['photo'] = ($file_headers[0] != 'HTTP/1.1 404 Not Found') ? $photo_link : assets_url('assets/images/no-image-mid.png');
        
        $this->_render_page('users/edit_user', $this->data);
    }

    function upload($id)
    {
        $user = $this->ion_auth->user($id)->row();
        $user_folder = $user->id;
        if(!is_dir('./'.'uploads')){
        mkdir('./'.'uploads', 0777);
        }
        if(!is_dir('./uploads/'.$user_folder)){
        mkdir('./uploads/'.$user_folder, 0777);
        }

         $this->load->library('image_lib');
         $config['upload_path'] = './uploads/'.$user_folder;
         $config['overwrite']=TRUE;
         $config['allowed_types'] = 'gif|jpg|png|jpeg';
         $config['max_size'] = '2048';
         $this->load->library('upload', $config);

        if (!$this->upload->do_upload('photo')){
            //print_r($this->upload->display_errors());
         }else{
            $upload_data = $this->upload->data();

            //resize:
            $resize1='80x80';
            if(!is_dir('./uploads/'.$user_folder.'/'.$resize1))
            {
                mkdir('./uploads/'.$user_folder.'/'.$resize1, 0777);
            }
            $config = array(
                            'source_image'      => $upload_data['full_path'], //path to the uploaded image
                            'new_image'         => './uploads/'.$user_folder.'/'.$resize1, //path to
                            'maintain_ratio'    => TRUE,
                            'width'             => 80,
                            'height'            => 80
                        );
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
 
            $resize2='100x100';
            if(!is_dir('./uploads/'.$user_folder.'/'.$resize2))
            {
                mkdir('./uploads/'.$user_folder.'/'.$resize2, 0777);
            }
            $config = array(
                            'source_image'      => $upload_data['full_path'], //path to the uploaded image
                            'new_image'         => './uploads/'.$user_folder.'/'.$resize2, //path to
                            'maintain_ratio'    => TRUE,
                            'width'             => 100,
                            'height'            => 100
                        );
            $this->image_lib->initialize($config);
            $this->image_lib->resize();

            $resize3='225x225';
            if(!is_dir('./uploads/'.$user_folder.'/'.$resize3))
            {
            mkdir('./uploads/'.$user_folder.'/'.$resize3, 0777);
            }
            $config = array(
                            'source_image'      => $upload_data['full_path'], //path to the uploaded image
                            'new_image'         => './uploads/'.$user_folder.'/'.$resize3,
                            'maintain_ratio'    => TRUE,
                            'width'             => 225,
                            'height'            => 225
                        );
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
        }
                                                      
        if(!$this->upload->do_upload('photo'))
        {
           //print_r($this->upload->display_errors());
        }else{
            $image_name = $upload_data['file_name'];
            $data = array('photo'=>$image_name);
            //$targetPath = base_url().'uploads/'.$user_folder.'/'.$image_name;
            //echo "<img src='$targetPath' width='100px' height='100px' />";
            $this->db->where('id', $id)->update('users', $data);
        }
    }

    public function ajax_list()
    {
        $list = $this->users->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $users) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $users->username;
            $row[] = $users->full_name;
            $row[] = $users->email;
            $row[] = $this->get_user_group($users->id);

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="'.base_url().'users/edit_user/'.$users->id.'" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_user('."'".$users->id."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->users->count_all(),
                        "recordsFiltered" => $this->users->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    function get_user_group($id)
    {
        //$group = getAll('users_groups', array('user_id'=>'where/'.$id))->result();
        $group = getJoin('users_groups', 'groups', 'users_groups.group_id = groups.id', 'left', 'groups.name as group_name, users_groups.*', array('users_groups.user_id'=>'where/'.$id), array('!=groups.id'=>'2'));
        $groups = '';
        if(!empty($group))
        {
            foreach ($group->result() as $key) {
                $groups .= ucwords($key->group_name).'<br/>';
            }

            return $groups;
        }
    }

    public function ajax_edit($id)
    {
        $data = $this->users->get_by_id($id); // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }

     public function ajax_add()
    {
        //$this->_validate();
        $data = array(
                    'full_name' => $this->input->post('full_name'),
                    'username'  => $this->input->post('username'),
                    'email'    => $this->input->post('email'),
                    'phone'      => $this->input->post('phone'),
                    'password' => $this->input->post('password'),
                    'active' => 1,
                    //'created_by' => sessId(),
                    //'created_on' => dateNow(),
            );
        $insert = $this->users->save($data);
        $id = $this->db->insert_id();

        // Only allow updating groups if user is admin
        if ($this->ion_auth->is_admin())
        {
            //Update the groups user belongs to
            $groupData = $this->input->post('groups');

            if (isset($groupData) && !empty($groupData)) {

                $this->ion_auth->remove_from_group('', $id);

                foreach ($groupData as $grp) {
                    $this->ion_auth->add_to_group($grp, $id);
                }

            }
        }
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->users->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    //TAB APPROVER
    public function approver_list()
    {
        $list = $this->users->get_datatables_approver();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->name;
            $row[] = $r->jabatan;
            $row[] = $r->level;

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0);" title="Edit" onclick="edit_approver('."'".$r->id."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_approver('."'".$r->id."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->users->count_all_approver(),
                        "recordsFiltered" => $this->users->count_filtered_approver(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function approver_edit($id)
    {
        $data = $this->users->get_approver_by_id($id); // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }

    public function approver_add()
    {
        //$this->_validate();
        $data = array(
                    'user_id' => $this->input->post('user_id'),
                    'jabatan'  => $this->input->post('jabatan'),
                    'level'  => $this->input->post('level'),
                    //'created_by' => sessId(),
                    //'created_on' => dateNow(),
            );
        $this->db->insert('approver',$data);

        echo json_encode(array("status" => TRUE));
    }

    public function approver_update()
    {
        //$this->_validate();
        $data = array(
                'user_id' => $this->input->post('user_id'),
                'jabatan'  => $this->input->post('jabatan'),
                'level'  => $this->input->post('level'),
            );
        $this->db->where('id',  $this->input->post('approver_id'))->update('approver', $data);
        echo json_encode(array("status" => TRUE));
    }

    public function approver_delete($id)
    {
        $this->db->where('id', $id)->delete('approver');
        echo json_encode(array("status" => TRUE));
    }

    //TAB GROUPS
    public function group_list()
    {
        $list = $this->users->get_datatables_group();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->name;
            $row[] = $r->description;

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0);" title="Edit" onclick="edit_group('."'".$r->id."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_group('."'".$r->id."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->users->count_all_group(),
                        "recordsFiltered" => $this->users->count_filtered_group(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function group_edit($id)
    {
        $data = $this->users->get_group_by_id($id); // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }

    public function group_add()
    {
        //$this->_validate();
        $data = array(
                    'name' => $this->input->post('name'),
                    'description'  => $this->input->post('description'),
                    //'created_by' => sessId(),
                    //'created_on' => dateNow(),
            );
        $this->db->insert('groups',$data);

        echo json_encode(array("status" => TRUE));
    }

    public function group_update()
    {
        //$this->_validate();
        $data = array(
                'name' => $this->input->post('name'),
                'description'  => $this->input->post('description'),
            );
        $this->db->where('id',  $this->input->post('group_id'))->update('groups', $data);
        echo json_encode(array("status" => TRUE));
    }

    public function group_delete($id)
    {
        $this->db->where('id', $id)->delete('groups');
        echo json_encode(array("status" => TRUE));
    }


    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('full_name') == '')
        {
            $data['inputerror'][] = 'full_name';
            $data['error_string'][] = 'First name is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('username') == '')
        {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'Last name is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key   = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    function _valid_csrf_nonce()
    {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
            $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }


    function _render_page($view, $data=null, $render=false)
    {
        // $this->viewdata = (empty($data)) ? $this->data: $data;
        // $view_html = $this->load->view($view, $this->viewdata, $render);
        // if (!$render) return $view_html;
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');
                if(in_array($view, array('users/index')))
                {
                    $this->template->set_layout('default');


                    $this->template->add_css('vendor/DataTables/css/DT_bootstrap.css');
                    $this->template->add_css('vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css');
                    $this->template->add_css('vendor/select2/select2.css');

                    $this->template->add_js('vendor/jquery-validation/jquery.validate.min.js');
                    $this->template->add_js('assets/js/form-validation.js');
                    $this->template->add_js('vendor/bootstrap-datepicker/bootstrap-datepicker.min.js');
                    $this->template->add_js('vendor/DataTables/js/jquery.dataTables.min.js');
                    $this->template->add_js('vendor/select2/select2.min.js');
                    $this->template->add_js('assets/js/users/index.js');

                }elseif(in_array($view, array('users/edit_user')))
                {
                    $this->template->set_layout('default');

                    $this->template->add_css('vendor/bootstrap-fileinput/jasny-bootstrap.min.css');
                    $this->template->add_js('vendor/bootstrap-fileinput/jasny-bootstrap.js');
                    $this->template->add_js('vendor/jquery-validation/jquery.validate.min.js');
                    $this->template->add_js('assets/js/form-validation.js');

                    $this->template->add_js('assets/js/users/edit_user.js');
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
