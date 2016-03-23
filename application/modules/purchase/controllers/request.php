<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends MX_Controller {
    public $data;
    var $module = 'purchase';
    var $title = 'Purchase Request';
    var $file_name = 'request';
    var $main_title = 'Purchase Request';
    var $table_name = 'purchase_request';
    function __construct()
    {
        parent::__construct();
        $this->load->model($this->module.'/'.$this->file_name.'_model', 'main');
    }

    function index()
    {
        $this->data['title'] = $this->title;
        $this->data['main_title'] = $this->main_title;
        $this->data['file_name'] = $this->file_name;
        $this->data['module'] = $this->module;
        permissionUser();
        $this->_render_page($this->module.'/'.$this->file_name.'/index', $this->data);
    }

    function input()
    {
        $this->data['title'] = $this->title.' - Input';
        $this->data['main_title'] = $this->main_title;
        $this->data['file_name'] = $this->file_name;
        $this->data['module'] = $this->module;
        permissionUser();
        $num_rows = getAll($this->table_name)->num_rows();
        $last_id = ($num_rows>0) ? $this->db->select('id')->order_by('id', 'desc')->limit(1)->get($this->table_name)->last_row()->id : 0;
        $this->data['last_id'] = ($num_rows>0) ? $last_id+1 : 1;
        $this->data['barang'] = getAll('barang')->result_array();
        $this->data['satuan'] = getAll('satuan')->result_array();
        $this->data['options_satuan'] = options_row('main', 'get_satuan','id','title', '-- Pilih Satuan --');
        $this->data['users'] = getAll('users')->result();
        $this->data['gudang'] = getAll('gudang')->result();
        $this->data['jenis'] = getAll('jenis_barang');
        $this->data['kurensi'] = getAll('kurensi')->result();
        $this->_render_page($this->module.'/'.$this->file_name.'/input', $this->data);
    }

    function draft($id){
        $this->data['title'] = $this->title.' - Input';
        $this->data['main_title'] = $this->main_title;
        $this->data['file_name'] = $this->file_name;
        $this->data['module'] = $this->module;
        permissionUser();
        $this->data[$this->file_name] = $this->main->get_detail($id)->row();
        $this->data[$this->file_name.'_list'] = $this->main->get_list_detail($id);
        $this->data['user_app_lv1'] = getValue('diajukan_ke', 'purchase_request', array('id'=>'where/'.$id));
        $num_rows = getAll($this->table_name)->num_rows();
        $last_id = ($num_rows>0) ? $this->db->select('id')->order_by('id', 'desc')->limit(1)->get($this->table_name)->last_row()->id : 0;
        $this->data['last_id'] = ($num_rows>0) ? $last_id+1 : 1;
        $this->data['barang'] = getAll('barang')->result_array();
        $this->data['satuan'] = getAll('satuan')->result_array();
        $this->data['options_satuan'] = options_row('main', 'get_satuan','id','title', '-- Pilih Satuan --');
        $this->data['users'] = getAll('users')->result();
        $this->data['gudang'] = getAll('gudang')->result();
        $this->data['jenis'] = getAll('jenis_barang');
        $this->_render_page($this->module.'/'.$this->file_name.'/draft', $this->data);
    }

    function detail($id)
    {
        $this->data['main_title'] = $this->main_title;
        $this->data['file_name'] = $this->file_name;
        $this->data['module'] = $this->module;
        $this->data['title'] = $this->title.' - Detail';
        permissionUser();
        $this->data['id'] = $id;
        $this->data[$this->file_name] = $this->main->get_detail($id);
        $this->data[$this->file_name.'_list'] = $this->main->get_list_detail($id);
        $this->data['user_app_lv1'] = getValue('diajukan_ke', 'purchase_request', array('id'=>'where/'.$id));
        $this->data['user_app_lv2'] = getValue('user_id', 'approver', array('level'=>'where/1'));
        $this->data['user_app_lv3'] = getValue('user_id', 'approver', array('level'=>'where/2'));
        $this->data['user_app_lv4'] = getValue('user_id', 'approver', array('level'=>'where/3'));
        $this->data['jabatan_lv1'] = getUserGroup($this->data['user_app_lv1']);
        $this->data['jabatan_lv2'] = getValue('jabatan', 'approver', array('level'=>'where/1'));
        $this->data['jabatan_lv3'] = getValue('jabatan', 'approver', array('level'=>'where/2'));
        $this->data['jabatan_lv4'] = getValue('jabatan', 'approver', array('level'=>'where/3'));
        $this->_render_page($this->module.'/'.$this->file_name.'/detail', $this->data);
    }

    function add_draft()
    {
        permissionUser();
        $no = $this->input->post('no');
        $list = array(
                        'kode_barang'=>$this->input->post('kode_barang'),
                        'deskripsi'=>$this->input->post('deskripsi'),
                        'jumlah'=>$this->input->post('jumlah'),
                        'satuan'=>$this->input->post('satuan'),
                        'harga'=>$this->input->post('harga'),
                        );//print_mz($list);
        $data = array(
                'no' => $no,
                'diajukan_ke'=>$this->input->post('diajukan_ke'),
                'tanggal_digunakan'=>date('Y-m-d',strtotime($this->input->post('tanggal_digunakan'))),
                'gudang_id'=>$this->input->post('gudang_id'),
                'keperluan'=>$this->input->post('keperluan'),
                'jenis_barang_id'=>$this->input->post('jenis_barang_id'),
                'kurensi_id'=>$this->input->post('kurensi_id'),
                'catatan' =>$this->input->post('catatan'),
                'is_draft' => 1,
                'created_by' => sessId(),
                'created_on' => dateNow(),
            );
        $num_rows = GetAllSelect($this->table_name, 'id', array('id'=>'where/'.$no))->num_rows();
        if($num_rows>0){
            $this->db->where('no', $no)->update($this->table_name, $data);
            $insert_id = getValue('id', $this->table_name, array('id'=>'where/'.$no));
        }else{
            $this->db->insert($this->table_name, $data);
            $insert_id = $this->db->insert_id();
        }
        $this->db->where($this->file_name.'_id', $insert_id)->delete($this->table_name.'_list');
        for($i=0;$i<sizeof($list['kode_barang']);$i++):
            $data2 = array(
                $this->file_name.'_id' => $insert_id,
                'kode_barang' => $list['kode_barang'][$i],
                'deskripsi' => $list['deskripsi'][$i],
                'jumlah' => str_replace(',', '', $list['jumlah'][$i]),
                'satuan_id' => $list['satuan'][$i],
                'harga' => str_replace(',', '', $list['harga'][$i]),
                );
        $num_rows_list = getAll($this->table_name.'_list', array('kode_barang'=>'where/'.$list['kode_barang'][$i], $this->file_name.'_id'=>'where/'.$insert_id))->num_rows();
        if($num_rows_list>0){
            $this->db->where('kode_barang', $list['kode_barang'][$i])->where($this->file_name.'_id', $insert_id)->update($this->table_name.'_list', $data2);
        }else{
        $this->db->insert($this->table_name.'_list', $data2);
        }
        endfor;
        echo json_encode(array('status'=>true));
    }
    
    function add()
    {
        permissionUser();
        $no = $this->input->post('no');
        $list = array(
                        'kode_barang'=>$this->input->post('kode_barang'),
                        'deskripsi'=>$this->input->post('deskripsi'),
                        'jumlah'=>$this->input->post('jumlah'),
                        'satuan'=>$this->input->post('satuan'),
                        'harga'=>$this->input->post('harga'),
                        );
        $data = array(
                'no' => $this->input->post('no'),
                'diajukan_ke'=>$this->input->post('diajukan_ke'),
                'tanggal_digunakan'=>date('Y-m-d',strtotime($this->input->post('tanggal_digunakan'))),
                'gudang_id'=>$this->input->post('gudang_id'),
                'keperluan'=>$this->input->post('keperluan'),
                'jenis_barang_id'=>$this->input->post('jenis_barang_id'),
                'kurensi_id'=>$this->input->post('kurensi_id'),
                'catatan' =>$this->input->post('catatan'),
                'is_draft' => 0,
                'created_by' => sessId(),
                'created_on' => dateNow(),
            );
        $num_rows = GetAllSelect($this->table_name, 'id', array('id'=>'where/'.$no))->num_rows();
        if($num_rows>0){
            $this->db->where('no', $no)->update($this->table_name, $data);
            $insert_id = getValue('id', $this->table_name, array('id'=>'where/'.$no));
        }else{
            $this->db->insert($this->table_name, $data);
            $insert_id = $this->db->insert_id();
        }
        $this->db->where($this->file_name.'_id', $insert_id)->delete($this->table_name.'_list');
        for($i=0;$i<sizeof($list['kode_barang']);$i++):
            $data2 = array(
                $this->file_name.'_id' => $insert_id,
                'kode_barang' => $list['kode_barang'][$i],
                'deskripsi' => $list['deskripsi'][$i],
                'jumlah' => str_replace(',', '', $list['jumlah'][$i]),
                'satuan_id' => $list['satuan'][$i],
                'harga' => str_replace(',', '', $list['harga'][$i]),
                );
        $num_rows_list = getAll($this->table_name.'_list', array('kode_barang'=>'where/'.$list['kode_barang'][$i], $this->file_name.'_id'=>'where/'.$insert_id))->num_rows();
        if($num_rows_list>0){
            $this->db->where('kode_barang', $list['kode_barang'][$i])->where($this->file_name.'_id', $insert_id)->update($this->table_name.'_list', $data2);
        }else{
        $this->db->insert($this->table_name.'_list', $data2);
        }
        endfor;
        $this->send_notification($insert_id);
        redirect($this->module.'/'.$this->file_name, 'refresh');
    }
    function send_notification($id)
    {
        permissionUser();
        $url = base_url().$this->module.'/'.$this->file_name.'/detail/'.$id;
        $subject = 'Pengajuan Purchase Request';
        $isi = getName(sessId())." Mengajuan Purchase Request, Untuk melakukan approval silakan <a href=$url> KLIK DISINI </a>.";
        $approver = getValue('diajukan_ke', $this->table_name, array('id'=>'where/'.$id));
        $no = getValue('no', $this->table_name, array('id'=>'where/'.$id));
        $jenis = getValue('jenis_barang_id', 'purchase_request', array('id'=>'where/'.$id));
        if(!empty($approver)):
            $data = array('sender_id' => sessId(),
                          'receiver_id' => $approver,
                          'sent_on' => dateNow(),
                          'judul' => $subject,
                          'no' => $no,
                          'isi' => $isi,
                          'url' => $url,
             );
            $this->db->insert('notifikasi', $data);
            $this->send_email(getEmail($approver), $subject, $isi);
        endif;

        if($jenis == 3):
            $level = array('level' => 'where/3',
                           'level' => 'where/2',
                           'level' => 'where/1'
                           );
        $list = array(1,2,3);
            $approver = $this->db->where_in('level', $list)->get('approver');
        else:
                $level = array('level' => 'where/3',
                       'level' => 'where/2',
                       );
                $list = array(2,3);
            $approver = $this->db->where_in('level', $list)->get('approver');
        endif;
        foreach($approver->result() as $r):
            $data = array('sender_id' => sessId(),
                          'receiver_id' => $r->user_id,
                          'sent_on' => dateNow(),
                          'judul' => $subject,
                          'no' => $no,
                          'isi' => $isi,
                          'url' => $url,
             );
        $this->db->insert('notifikasi', $data);
        $this->send_email(getEmail($r->user_id), $subject, $isi);
        endforeach;
        return TRUE;
    }

    public function ajax_list()
    {
        $list = $this->main->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $detail = base_url().$this->module.'/'.$this->file_name.'/detail/'.$r->id;
            $print = base_url().$this->module.'/'.$this->file_name.'/print_pdf/'.$r->id;
            $draft = base_url().$this->module.'/'.$this->file_name.'/draft/'.$r->id;
            if(!empty($r->diajukan_ke)){
                $status1 = ($r->app_status_id_lv1==1) ? '<i title="Approved" class="fa fa-check" style="color:green"></i>' : (($r->app_status_id_lv1 == 2) ? '<i title="rejected" class="fa fa-remove" style="color:red"></i>' : (($r->app_status_id_lv1 == 3) ? '<i title="Pending" class="fa fa-info" style="color:orange"></i>'  : '<i class="fa fa-question"></i>'));
            }else{
                $status1 = '<i title="Tidak Butuh Approval" class="fa fa-minus" style="color:green"></i>';
            }
            if($r->jenis_barang_id == 3){
            $status2 = ($r->app_status_id_lv2==1) ? '<i title="Approved" class="fa fa-check" style="color:green"></i>' : (($r->app_status_id_lv2 == 2) ? '<i title="rejected" class="fa fa-remove" style="color:red"></i>' : (($r->app_status_id_lv2 == 3) ? '<i title="Pending" class="fa fa-info" style="color:orange"></i>'  : '<i class="fa fa-question"></i>'));
            }else{
                $status2 = '<i title="Tidak Butuh Approval" class="fa fa-minus" style="color:green"></i>';
            }
            $status3 = ($r->app_status_id_lv3==1) ? '<i title="Approved" class="fa fa-check" style="color:green"></i>' : (($r->app_status_id_lv3 == 2) ? '<i title="rejected" class="fa fa-remove" style="color:red"></i>' : (($r->app_status_id_lv3 == 3) ? '<i title="Pending" class="fa fa-info" style="color:orange"></i>'  : '<i title="No Respond" class="fa fa-question"></i>'));
            $status4 = ($r->app_status_id_lv4==1) ? '<i title="Approved" class="fa fa-check" style="color:green"></i>' : (($r->app_status_id_lv4 == 2) ? '<i title="rejected" class="fa fa-remove" style="color:red"></i>' : (($r->app_status_id_lv4 == 3) ? '<i title="Pending" class="fa fa-info" style="color:orange"></i>'  : '<i title="No Respond" class="fa fa-question"></i>'));
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = ($r->is_draft == 1)?"<a href=$draft>#".$r->no.'</a>' : "<a href=$detail>#".$r->no.'</a>';
            $row[] = $r->tanggal_digunakan;
            $row[] = $r->gudang;
            if($r->is_draft == 1){
            $row[] = 'Draft';
            $row[] = 'Draft';
            $row[] = 'Draft';
            $row[] = 'Draft';
            }else{
                $row[] = $status1;
                $row[] = $status2;
                $row[] = $status3;
                $row[] = $status4;
            }
            if($r->is_draft == 1){
                if($r->created_by == sessId()):
                    $row[] = '<a class="btn btn-sm btn-primary" href='.$draft.' title="Edit Draft"><i class="fa fa-pencil"></i></a>
                      <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_user('."'".$r->id."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
                else:
                    $row[] = '';
                endif;
            }else{
            $row[] ="<a class='btn btn-sm btn-primary' href=$detail title='detail'><i class='fa fa-info'></i></a>
                    <a class='btn btn-sm btn-light-azure' href=$print target='_blank' title='detail'><i class='fa fa-print'></i></a>";
            }
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

    public function ajax_delete($id)
    {
        $this->main->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    function approve()
    {
        $level = $this->input->post('level');//die($level);
        $id = $this->input->post('id');
        //if($level == 1)$this->notif_manager($id);
        $data = array('is_app_lv'.$level => 1,
                      'app_status_id_lv'.$level => $this->input->post('app_status_id_lv'.$level),
                      'date_app_lv'.$level=>dateNow(),
                      'user_app_lv'.$level => sessId(),
                      'note_app_lv'.$level => $this->input->post('note_lv'.$level)
            );
        $this->db->where('id', $id)->update($this->table_name, $data);
        echo json_encode(array("status" => $id));
    }

    function add_row($id)
    {
        $data['id'] = $id;
        $data['barang'] = getAll('barang')->result_array();
        $data['satuan'] = getAll('satuan')->result_array();
        $data['options_satuan'] = options_row('main', 'get_satuan','id','title', '-- Pilih Satuan --');
        $this->load->view('request/row', $data);
    }

    function show_modal($id)
    {
        $data['id'] = $id;
        $data['barang'] = getAll('barang')->result_array();
        $data['satuan'] = getAll('satuan')->result_array();
        $data['options_satuan'] = options_row('main', 'get_satuan','id','title', '-- Pilih Satuan --');
        $this->load->view('request/modal', $data);
    }

    function print_pdf($id)
    {
        $this->data['main_title'] = $this->main_title;
        $this->data['file_name'] = $this->file_name;
        $this->data['module'] = $this->module;
        $this->data['title'] = $this->title.' - Detail';
        permissionUser();
        $this->data['id'] = $id;
        $this->data[$this->file_name] = $this->main->get_detail($id);
        $this->data[$this->file_name.'_list'] = $this->main->get_list_detail($id);
        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view($this->module.'/'.$this->file_name.'/pdf', $this->data, true); 
        $this->mpdf = new mPDF();
        $this->mpdf->AddPage('p', // L - landscape, P - portrait
            '', '', '', '',
            5, // margin_left
            5, // margin right
            5, // margin top
            0, // margin bottom
            0, // margin header
            5); // margin footer
    $this->mpdf->WriteHTML($html);
    $this->mpdf->Output($id.'-'.'.pdf', 'I');
    }

    function get_satuan()
    {
        $id = $this->input->post('id');
        $tbl = 'barang_satuan';
        $tbl_join = 'satuan';
        $condition = 'barang_satuan.satuan = satuan.id';
        $type = 'left';
        $select = 'satuan.id as id, satuan.title as satuan';
        $filter = array('barang_id'=>'where/'.$id);
        $data['satuan'] = GetAll($tbl,$tbl_join,$condition,$type,$select,$filter)->result();
        $this->load->view('purchase/request/satuan', $data);
    }
    function get_satuan_num($id)
    {
        $is_dasar = getValue('is_dasar', 'satuan', array('id'=>'where/'.$id));
        $num = getValue('satuan_dasar_num', 'satuan', array('id'=>'where/'.$id));
        if($is_dasar == 1)$num = 1;
        echo json_encode($num);
    }

    function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

                if(in_array($view, array($this->module.'/'.$this->file_name.'/index')))
                {
                    $this->template->set_layout('default');

                    $this->template->add_css('vendor/DataTables/css/DT_bootstrap.css');
                    $this->template->add_js('vendor/DataTables/js/jquery.dataTables.min.js');
                    $this->template->add_js('assets/js/'.$this->module.'/'.$this->file_name.'/index.js');
                }elseif(in_array($view, array($this->module.'/'.$this->file_name.'/input',
                                              $this->module.'/'.$this->file_name.'/draft'  
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
                    $this->template->add_js('assets/js/'.$this->module.'/'.$this->file_name.'/input.js');
                }elseif(in_array($view, array($this->module.'/'.$this->file_name.'/detail')))
                {
                    $this->template->set_layout('default');

                    $this->template->add_js('vendor/jquery-mask-money/jquery.MaskMoney.js');
                    $this->template->add_js('assets/js/'.$this->module.'/'.$this->file_name.'/detail.js');
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