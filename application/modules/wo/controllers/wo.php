<?php defined('BASEPATH') OR exit('No direct script access allowed');

class wo extends MX_Controller {
    public $data;
    var $title = 'Work Order';
    var $file_name = 'wo';
    var $table_name = 'wo';
    
    function __construct()
    {
        parent::__construct();
        $this->load->model($this->file_name.'_model', 'main');
    }

    function index()
    {
        //print_mz(number_format(90.21, 2));
        $this->data['title'] = $this->title;
        permissionUser();
        $this->_render_page($this->file_name.'/index', $this->data);
    }

    function input()
    {
        $this->data['title'] = $this->title.' - Input';
        $this->data['file_name'] = $this->file_name;
        permissionUser();
        $this->data['barang'] = getAll('barang')->result_array();
        $this->data['satuan'] = getAll('satuan')->result_array();
        $this->data['kontak'] = getAll('kontak', array('tipe_id'=>'where/2'))->result();
        $this->_render_page($this->file_name.'/input', $this->data);
    }

    function detail($id)
    {
        $this->data['title'] = $this->title.' - Detail';
        $this->data['file_name'] = $this->file_name;
        permissionUser();
        $this->data['id'] = $id;
        $this->data['det'] = $this->main->get_detail($id)->row();
        $this->data['list'] = $this->main->get_list_detail($id)->result();
        $this->_render_page($this->file_name.'/detail', $this->data);
    }

    function add()
    {
        $no = $this->input->post('no');
        permissionUser();
        $list = array(
                    'barang_id'=>$this->input->post('barang_id'),
                    'deskripsi'=>$this->input->post('deskripsi'),
                    'catatan_barang'=>$this->input->post('catatan_barang'),
                    'jumlah'=>$this->input->post('jumlah'),
                    'satuan'=>$this->input->post('satuan'),
                    'sisa_stok'=>$this->input->post('sisa_stok'),
                );
        $data = array(
                'no' => $no,
                'kontak_id'=>$this->input->post('kontak_id'),
                'tgl'=>date('Y-m-d',strtotime($this->input->post('tgl'))),
                'catatan' =>$this->input->post('catatan'),
                'project' =>$this->input->post('project'),
                'status_id' => 1,
                'created_by' => sessId(),
                'created_on' => dateNow(),
            );

        $num_rows = GetAllSelect($this->table_name, 'no', array('no'=>'where/'.$no))->num_rows();
        if($num_rows>0){
            $this->db->where('no', $no)->update($this->table_name, $data);
            $insert_id = getValue('id', $this->table_name, array('no'=>'where/'.$no));
        }else{
            $this->db->insert($this->table_name, $data);
            $insert_id = $this->db->insert_id();
        }
        $this->db->where($this->file_name.'_id', $insert_id)->delete($this->table_name.'_list');
        for($i=0;$i<sizeof($list['barang_id']);$i++):
            $data2 = array(
                $this->file_name.'_id' => $insert_id,
                'barang_id' => $list['barang_id'][$i],
                'deskripsi' => $list['deskripsi'][$i],
                'catatan' => $list['catatan_barang'][$i],
                'jumlah' => str_replace(',', '', $list['jumlah'][$i]),
                'satuan_id' => $list['satuan'][$i],
                'sisa_stok' => $list['sisa_stok'][$i],
            );

            $num_rows_list = getAll($this->table_name.'_list', array('barang_id'=>'where/'.$list['barang_id'][$i], $this->file_name.'_id'=>'where/'.$insert_id))->num_rows();
            if($num_rows_list>0){
                $this->db->where('barang_id', $list['barang_id'][$i])->where($this->file_name.'_id', $insert_id)->update($this->table_name.'_list', $data2);
            }else{
            $this->db->insert($this->table_name.'_list', $data2);
            }
        endfor;
        $produksi_ref = array(
            'ref_id' => $insert_id,
            'ref_type' => 'wo',
            'status' => 1,
            'created_by' => sessId(),
            'created_on' => dateNow(),
            );
        $this->db->insert('produksi_ref', $produksi_ref);
        $this->send_notification($insert_id);
        redirect($this->file_name, 'refresh');
    }

    function send_notification($id)
    { 
        permissionUser();
        $url = base_url().$this->file_name.'/detail/'.$id;
        $subject = 'Pengajuan Work Order';
        $isi = getName(sessId())." membuat Work Order, Untuk melihat detail silakan <a href=$url> KLIK DISINI </a>.";
        $no = getValue('no', $this->table_name, array('id'=>'where/'.$id));

        //SEND NOTIFICATION TO PRODUCTION
        $group_id = array('8');
        $user_id = $this->db->select('user_id')->where_in('group_id', $group_id)->get('users_groups')->result();
        foreach($user_id as $u):
            $data = array('sender_id' => sessId(),
                          'receiver_id' => $u->user_id,
                          'sent_on' => dateNow(),
                          'judul' => $subject,
                          'isi' => $isi,
                          'no' => $no,
                          'url' => $url,
             );
            $this->db->insert('notifikasi', $data);
            $this->send_email(getEmail($u->user_id), $subject, $isi);
        endforeach;
        return TRUE;
    }

    public function ajax_list()
    {
        $list = $this->main->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            if($r->is_deleted == 0):
                $detail = base_url().$this->file_name.'/detail/'.$r->id;
                //$print = base_url().$this->file_name.'/print_pdf/'.$r->id;
                $delete = ($r->created_by == sessId() || $this->ion_auth->is_admin() == true) ? '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_user('."'".$r->id."'".')"><i class="glyphicon glyphicon-trash"></i></a>' : '';
                
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = "<a href=$detail>#".$r->no.'</a>';
                $row[] = $r->project;
                $row[] = $r->kontak;
                $row[] = dateIndo($r->tgl);
                $row[] = $r->creator;
                $row[] = $r->status;
                $row[] = "<a class='btn btn-sm btn-primary' href=$detail title='detail'><i class='fa fa-info'></i></a>
                          $delete";
                $data[] = $row;
            endif;
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

    public function ajax_delete($id)
    {
        $this->main->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    //FOR JS
    function add_row($id)
    {
        $data['id'] = $id;
        $data['barang'] = getAll('barang')->result_array();
        $data['satuan'] = getAll('satuan')->result_array();
        $this->load->view('wo/row', $data);
    }

    function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

                if(in_array($view, array($this->file_name.'/index')))
                {
                    $this->template->set_layout('default');

                    $this->template->add_css('vendor/DataTables/css/DT_bootstrap.css');
                    $this->template->add_js('vendor/DataTables/js/jquery.dataTables.min.js');
                    $this->template->add_js('assets/js/'.$this->file_name.'/index.js');
                }elseif(in_array($view, array($this->file_name.'/input',
                                              $this->file_name.'/draft'
                                              )))
                {
                    $this->template->set_layout('default');

                    $this->template->add_css('vendor/select2/select2.css');
                    $this->template->add_css('vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css');

                    $this->template->add_js('vendor/jquery-validation/jquery.validate.min.js');
                    $this->template->add_js('vendor/jquery-mask-money/jquery.MaskMoney.js');
                    $this->template->add_js('assets/js/form-validation.js');
                    $this->template->add_js('vendor/DataTables/js/jquery.dataTables.min.js');
                    $this->template->add_js('vendor/select2/select2.min.js');
                    $this->template->add_js('vendor/bootstrap-datepicker/bootstrap-datepicker.min.js');
                    $this->template->add_js('assets/js/form-elements.js');
                    $this->template->add_js('assets/js/'.$this->file_name.'/input.js');
                }elseif(in_array($view, array($this->file_name.'/detail')))
                {
                    $this->template->set_layout('default');
                    
                    $this->template->add_css('assets/css/custom.css');
                    $this->template->add_js('vendor/jquery-mask-money/jquery.MaskMoney.js');
                    $this->template->add_js('assets/js/'.$this->file_name.'/detail.js');
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