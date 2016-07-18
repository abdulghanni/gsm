<?php defined('BASEPATH') OR exit('No direct script access allowed');

class produksi extends MX_Controller {
    public $data;
    var $module = 'stok';
    var $title = 'produksi';
    var $file_name = 'produksi';

    function __construct()
    {
        parent::__construct();
        $this->load->model($this->module.'/'.$this->file_name.'_model', 'main');
    }

    function index()
    {
        $this->data['title'] = $this->title;
        $this->data['modul'] = $this->module;
        $this->data['filename'] = $this->file_name;
        $this->data['main_title'] = $this->module.'';
        permissionUser();
        $this->_render_page($this->module.'/'.$this->file_name.'/index', $this->data);
	}

	public function ajax_list()
    {
        $list = $this->main->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $detail = base_url().$this->module.'/'.$this->file_name.'/detail/'.$r->id;
            //$print = base_url().$this->file_name.'/print_pdf/'.$r->id;
            $delete = ($r->created_by == sessId() || $this->ion_auth->is_admin() == true) ? '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_user('."'".$r->id."'".')"><i class="glyphicon glyphicon-trash"></i></a>' : '';
            $ref_id = ($r->ref_type == 'wo') ? getValue('no', 'wo', array('id'=>'where/'.$r->ref_id)) : getValue('so', 'sales_order', array('id'=>'where/'.$r->ref_id));
            $kontak_id = ($r->ref_type == 'wo') ? getValue('kontak_id', 'wo', array('id'=>'where/'.$r->ref_id)) : getValue('kontak_id', 'sales_order', array('id'=>'where/'.$r->ref_id));
            $project = ($r->ref_type == 'wo') ? getValue('project', 'wo', array('id'=>'where/'.$r->ref_id)) : getValue('project', 'sales_order', array('id'=>'where/'.$r->ref_id));
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = "<a href=$detail>#".$r->no.'</a>';
            $row[] = $r->tgl;
            $row[] = $ref_id;
            $row[] = $r->ref_type;
            $row[] = getValue('title', 'kontak', array('id'=>'where/'.$kontak_id));
            $row[] = $project;
            $row[] = $r->creator;
            $row[] = $r->status;
            $row[] = "<a class='btn btn-sm btn-primary' href=$detail title='detail'><i class='fa fa-info'></i></a>
                      $delete";
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->main->count_all(),
                        "recordsFiltered" => $this->main->count_filtered(),
                        "data" => $data,
                );
        echo json_encode($output);
    }

    function input()
    {
        $this->data['title'] = $this->title.' - Input';
        permissionUser();
		$this->data['module']=$this->module;
		$this->data['file_name']=$this->file_name;
        $num_rows = getAll($this->file_name)->num_rows();
        $last_id = ($num_rows>0) ? $this->db->select('id')->order_by('id', 'asc')->get($this->file_name)->last_row()->id : 0;
        $this->data['last_id'] = ($num_rows>0) ? $last_id+1 : 1;

        $this->data['ref'] = getAll('produksi_ref', array('id'=>'order/desc'),array('!=status'=>'2'))->result();

        $this->_render_page($this->module.'/'.$this->file_name.'/input', $this->data);
    }


    function detail($id)
    {
        $this->data['title'] = $this->title.' - Detail';
        $this->data['file_name'] = $this->file_name;
        $this->data['main_title'] = 'Produksi Detail';
        $this->data['module'] = $this->module.'';
        permissionUser();
        $this->data['id'] = $id;
		    $this->data['d']=$this->main->get_detail($id)->row();
		    $this->data['l']=$this->main->get_list_detail($id)->result();

        $this->_render_page($this->module.'/'.$this->file_name.'/detail', $this->data);
    }


    function add()
    {
      // $this->insert_status(2,1, 5, 'wo_list', 'wo_id');lastq();
      permissionUser();
      $list = array(
			  'kode_barang'=>$this->input->post('kode_barang'),
        'jumlah'=>$this->input->post('jumlah'),
        'satuan_id'=>$this->input->post('satuan_id')
      );

      $data = array(
          'no'=>$this->input->post('no'),
          'tgl'=> date('Y-m-d', strtotime($this->input->post('tgl'))),
          'ref_id' => $this->input->post('ref_id'),
          'catatan' => $this->input->post('catatan'),
          'created_on' =>date("Y-m-d"),
          'created_by' =>sessId()
      );

      $this->db->insert($this->file_name, $data);
      $insert_id = $this->db->insert_id();
      for($i=0;$i<sizeof($list['kode_barang']);$i++):
          $data2 = array(
              'produksi_id' => $insert_id,
              'kode_barang' => $list['kode_barang'][$i],
              'jumlah' => str_replace(',', '.', $list['jumlah'][$i]),
              'satuan_id' => $list['satuan_id'][$i]
              );
          $this->db->insert($this->file_name.'_list', $data2);
          $list_id = $this->db->insert_id();

          if($this->input->post('is_have_komposisi') > 0){
            $assembly_id = getValue('id', 'assembly', array('barang_id'=>'where/'.$list['kode_barang'][$i]));
            $komposisi = getAll('assembly_list', array('assembly_id'=>'where/'.$assembly_id));
            foreach($komposisi->result() as $l):
              $sisa = getValue('dalam_stok', 'stok', array('barang_id'=>'where/'.$l->kode_barang));
              $sisa_stok = $sisa - ($l->jumlah * $list['jumlah'][$i]);
              $this->db->where('barang_id', $l->kode_barang)->update('stok', array('dalam_stok'=> $sisa_stok));
            endforeach;
          }
          $sisa2 = getValue('dalam_stok', 'stok', array('barang_id'=>'where/'.$list['kode_barang'][$i]));
          $sisa_stok2 = $sisa2 + $list['jumlah'][$i];
            $this->db->where('barang_id', $list['kode_barang'][$i])->update('stok', array('dalam_stok'=> $sisa_stok2));
          $ref_id = $this->input->post('ref_id');
          $produksi_ref = getValue('ref_id', 'produksi_ref', array('id'=>'where/'.$ref_id));
          $ref_type = getValue('ref_type', 'produksi_ref', array('id'=>'where/'.$ref_id));
          $ref = ($ref_type == 'wo') ? 'wo_list' : 'produksi_ref_list';
          $field = ($ref_type == 'wo') ? 'wo_id' : 'ref_id';
	      endfor;
        $this->insert_status($insert_id,$ref_id, $produksi_ref, $ref, $field);
        // lastq();
        $status_id = getValue('status_id', 'produksi', array('id'=>'where/'.$insert_id));
        if($status_id == 2)$this->send_notif($insert_id);
        redirect($this->module.'/'.$this->file_name, 'refresh');
    }

    function insert_status($produksi_id, $ref_id, $produksi_ref, $ref, $field){
        $num = GetAllSelect('produksi_list', 'produksi_id',  array('produksi_id'=>'where/'.$produksi_id))->num_rows();
        $num_in_ref = $this->db->select_sum('qty')->where($field, $produksi_ref)->get($ref)->row()->qty;
        $produksi_id_list = GetAllSelect('produksi', 'id', array('ref_id'=>'where/'.$ref_id))->result_array();//print_mz($produksi_id);
        $produksi_id = array();
        foreach ($produksi_id_list as $key => $value) {
          $produksi_id[] = $value['id'];
        }
        $num_in_list = $this->db->select_sum('jumlah')->where_in('produksi_id', $produksi_id)->get('produksi_list')->row()->jumlah;//lastq();
        //print_mz($num_in_ref.'-'.$num_in_list);
        if($num_in_list >= $num_in_ref){
            $this->db->where('ref_id', $ref_id)->update('produksi', array('status_id'=>2));
            $this->db->where('id', $ref_id)->update('produksi_ref', array('status'=>2));
        }elseif($num_in_list <= $num_in_ref && $num > 0){
            $this->db->where('id', $ref_id)->update('produksi', array('status_id'=>3));
            $this->db->where('id', $ref_id)->update('produksi_ref', array('status'=>3));
        }elseif($num < 1){
            $this->db->where('ref_id', $ref_id)->update('produksi', array('status_id'=>1));
            $this->db->where('id', $ref_id)->update('produksi_ref', array('status'=>1));
        }else{
            return true;
        }
    }

	function send_notif($id)
    {
        permissionUser();
        $group_id = array('5','9','10');
        $user_id = $this->db->select('user_id')->where_in('group_id', $group_id)->get('users_groups')->result();
        $r =[];
        $receiver =  $this->db->select('user_id')->where_in('group_id', $group_id)->get('users_groups')->result_array();
        foreach ($receiver as $key => $value) {
            $r[] = getEmail($value['user_id']);
            //$r[] = 'abdul.ghanni@yahoo.co.id';
        }
        $r = implode(',', $r);
        $subject = 'Produksi Barang';
        $no = getValue('no', 'produksi', array('id'=>'where/'.$id));
        $url = base_url().$this->module.'/'.$this->file_name.'/detail/'.$id;
        $isi = $isi = getName(sessId())." telah melakukan produksi barang yang direquest, untuk melihat detail <a href=$url> KLIK DISINI </a>.";
        foreach($user_id as $u):
            $data = array('sender_id' => sessId(),
                          'receiver_id' => $u->user_id,
                          'sent_on' => dateNow(),
                          'judul' => $subject,
                          'no'=>$no,
                          'isi' => $isi,
                          'url' => $url,
             );
            $this->db->insert('notifikasi', $data);
        endforeach;
        $this->send_email($r, $subject, $isi);
    }

    function isi(){
            $id=$_POST['v'];
            $ref = getAll('produksi_ref', array('id'=>'where/'.$id))->row();
            if($ref->ref_type == 'wo'){
                $data['ref'] = getAll('wo_list', array('wo_id'=>'where/'.$ref->ref_id))->result();
            }else{
                 $data['ref'] = getAll('produksi_ref_list', array('ref_id'=>'where/'.$ref->ref_id))->result();
            }
            $this->data['satuan'] = getAll('satuan')->result_array();
            $data['list']=GetAll('assembly_list',array('assembly_id'=>'where/'.$id));
            $data['barang']=GetAll('assembly',array('id'=>'where/'.$id))->row_array();
            $this->load->view('produksi/isi',$data);
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

                    $this->template->add_css('flexigrid/css/flexigrid.css');
                    $this->template->add_css('vendor/DataTables/css/DT_bootstrap.css');
                    $this->template->add_js('vendor/DataTables/js/jquery.dataTables.min.js');
                    $this->template->add_js('flexigrid/js/flexigrid.pack.js');
                    $this->template->add_js('assets/js/'.$this->module.'/'.$this->file_name.'/index.js');
                }elseif(in_array($view, array($this->module.'/'.$this->file_name.'/input')))
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
