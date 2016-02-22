<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Hak_akses extends MX_Controller {
    public $data;
    var $module = 'pengaturan';
    var $title = 'Hak Akses';
    var $file_name = 'hak_akses';
    
    function __construct()
    {
        parent::__construct();
		$this->load->library('flexigrid');
        $this->load->helper('flexigrid');
        //$this->load->model($this->module.'/'.$this->file_name.'_model', 'main');
    }

    function index()
    {
        $this->data['title'] = $this->title;
        $this->data['modul'] = $this->module;
        $this->data['filename'] = $this->file_name;
        $this->data['main_title'] = $this->module.'';
		$this->data['js_grid']=$this->get_column();
        permissionUser();
        $this->_render_page($this->module.'/'.$this->file_name.'/index', $this->data);
		}
	function get_column(){
		
		$colModel['idnya'] = array('ID',50,TRUE,'left',2,TRUE);
		$colModel['id'] = array('ID',100,TRUE,'left',2,TRUE);
		$colModel['username'] = array('Username',110,TRUE,'left',2);
		$colModel['full_name'] = array('Full Name',110,TRUE,'left',2);
		$colModel['name'] = array('User Group',110,TRUE,'left',2);
        
		$gridParams = array(
		'rp' => 25,
		'rpOptions' => '[10,20,30,40]',
		'pagestat' => 'Displaying: {from} to {to} of {total} items.',
		'blockOpacity' => 0.5,
		'title' => '',
		'showTableToggleBtn' => TRUE
		);
        
	
		$buttons[] = array('separator');
		
		return $grid_js = build_grid_js('flex1',site_url($this->module.'/'.$this->file_name."/get_record"),$colModel,'id','asc',$gridParams,$buttons);
	}
	
	function get_flexigrid()
	{
		
		//Build contents query
		/* $this->db->select("a.id as id,a.ref as ref,b.title as gudang_from,c.title as gudang_to,a.tgl as tgl,a.created_on")->from('stok_pemindahan a');
		$this->db->join('gudang b','b.id=a.gudang_from','left');
		$this->db->join('gudang c','c.id=a.gudang_to','left'); */
		$this->db->select('a.id as id,a.username as username,a.full_name as full_name,b.group_id as group_id,c.name as name');
		$this->db->from('users a');
		$this->db->join('users_groups b','b.user_id=a.id','left');
		$this->db->join('groups c','c.id=b.group_id','left');
		//$this->db->join('rb_customer', "$this->tabel.id_customer=rb_customer.id", 'left');
		$this->flexigrid->build_query();
		
		//Get contents
		$return['records'] = $this->db->get();
		/* 
		//Build count query
		$this->db->select("count(id) as record_count")->from($this->file_name);
		$this->flexigrid->build_query(FALSE);
		$record_count = $this->db->get();
		$row = $record_count->row();
		
		//Get Record Count
		$return['record_count'] = $row->record_count; */
		$return['record_count'] = $return['records']->num_rows();
		//Return all
		return $return;
	}
	
	function get_record(){
		
		$valid_fields = array('id','name','code','origin');
		
		$this->flexigrid->validate_post('id','DESC',$valid_fields);
		$records = $this->get_flexigrid();
		
		$this->output->set_header($this->config->item('json_header'));
		
		$record_items = array();
		
		foreach ($records['records']->result() as $row)
		{/*
			if($row->status=='y'){$status='Aktif';}
			elseif($row->status=='n'){$status='Tidak Aktif';}
			elseif($row->status=='s'){$status='Suspended';}*/
			
			$record_items[] = array(
			$row->id,
			$row->id,
			$row->id,
			"<a class='btn btn-sm btn-light-azure' href='".base_url()."pengaturan/hak_akses/input/".$row->id."' title='detail'>".$row->username."</i></a>",
			$row->full_name,
			$row->name
			);
		}
		
		return $this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));;
	}  
	
	function deletec()
	{		
		//return true;
		$countries_ids_post_array = explode(",",$this->input->post('items'));
		array_pop($countries_ids_post_array);
		foreach($countries_ids_post_array as $index => $country_id){
			/*if (is_numeric($country_id) && $country_id > 0) {
			$this->delete($country_id);}*/
			$this->db->delete($this->file_name,array('id'=>$country_id));				
		}
		//$error = "Selected countries (id's: ".$this->input->post('items').") deleted with success. Disabled for demo";
		//echo "Sukses!";
	}
	function liststok(){
			$gudang=$_POST['g'];
			$data['list']=GetAll('stok',array('gudang_id'=>'where/'.$gudang));
			$this->load->view('pemindahan/input_list',$data);
	}
    function input($id)
    {
        $this->data['title'] = $this->title.' - Input';
        permissionUser();
		$this->data['modul']=GetAll('menu',array('id_parents'=>'where/0'));
		$this->data['id_user']=$id;
		$this->data['id_grup']=GetValue('id','users_groups',array('user_id'=>'where/'.$id));
       /*  $num_rows = getAll($this->module.'_'.$this->file_name)->num_rows();
        $last_id = ($num_rows>0) ? $this->db->select('id')->order_by('id', 'asc')->get($this->module.'_'.$this->file_name)->last_row()->id : 0;
        $this->data['last_id'] = ($num_rows>0) ? $last_id+1 : 1;
		
        $this->data['barang'] = getAll('barang')->result_array();
        $this->data['satuan'] = getAll('satuan')->result_array();
        $this->data['kurensi'] = getAll('kurensi')->result();
        $this->data['metode'] = getAll('metode_pembayaran')->result();
        //$this->data['gudang'] = getAll('gudang')->result();
        $this->data['gudang'] = GetOptAll('gudang','-Pilih Gudang-'); */
        //$this->data['options_supplier'] = options_row('main','get_supplier','id','title','-- Pilih Supplier --');
        
        $this->_render_page($this->module.'/'.$this->file_name.'/input', $this->data);
    }
	
    function detail($id)
    {
        $this->data['title'] = $this->title.' - Detail';
        permissionUser();
        $this->data['id'] = $id;
		$this->data['pemindahan']=GetAll('stok_pemindahan',array('id'=>'where/'.$id))->row_array();
		$this->data['list']=GetAll('stok_pemindahan_list',array('pemindahan_id'=>'where/'.$id));
		
        $this->data['gudang'] = GetOptAll('gudang','-Pilih Gudang-');//$this->data['refid']=GetAll($this->data['pemindahan']->ref_type,array('id'=>'where/'.$this->data['pemindahan']->ref_id))->row_array();
		// $this->data[$this->file_name] = $this->main->get_detail($id);
		// $this->data[$this->file_name.'_list'] = $this->main->get_list_detail($id);
		
        $this->_render_page($this->module.'/'.$this->file_name.'/detail', $this->data);
    }

    function add()
    {
			error_reporting(0);
        permissionUser();
		//print_mz($this->input->post());
		$menu=$this->input->post('menu');
		
		$m_c=$this->input->post('m_c');
		$m_v=$this->input->post('m_v');
		$m_u=$this->input->post('m_u');
		$m_d=$this->input->post('m_d');
		
		$submenu=$this->input->post('submenu');
		$s_c=$this->input->post('s_c');
		$s_v=$this->input->post('s_v');
		$s_u=$this->input->post('s_u');
		$s_d=$this->input->post('s_d');
		
		$user=$this->input->post('user_id');
		foreach($menu as $m){
				$cek=GetAll('users_permission',array('user_id'=>'where/'.$user,'menu_id'=>'where/'.$m))->num_rows();
				$data['menu_id']=$m;
				$data['create']=($m_c[$m] ? '1':'0');
				$data['view']=($m_v[$m] ? '1':'0');
				$data['update']=($m_u[$m] ? '1':'0');
				$data['delete']=($m_d[$m] ? '1':'0');
				$data['user_id']=$user;
				$data['user_group']=GetValue('group_id','users_groups',array('user_id'=>'where/'.$user));
				
				if($cek==0){
						$this->db->insert('users_permission',$data);
				}
				else{
						$this->db->where(array('user_id'=>$user,'menu_id'=>$m));
						$this->db->update('users_permission',$data);
				}
		}
		foreach($submenu as $sm){
			$cek=GetAll('users_permission',array('user_id'=>'where/'.$user,'menu_id'=>'where/'.$sm))->num_rows();
			$data['menu_id']=$sm;
			$data['create']=($s_c[$sm] ? '1':'0');
			$data['view']=($s_v[$sm] ? '1':'0');
			$data['update']=($s_u[$sm] ? '1':'0');
			$data['delete']=($s_d[$sm] ? '1':'0');
			$data['user_id']=$user;
			$data['user_group']=GetValue('group_id','users_groups',array('user_id'=>'where/'.$user));	
			
			if($cek==0){
				$this->db->insert('users_permission',$data);
			}
			else{
				$this->db->where(array('user_id'=>$user,'menu_id'=>$sm));
				$this->db->update('users_permission',$data);
			}
		}
        redirect($this->module.'/'.$this->file_name, 'refresh');
    }

    public function ajax_list()
    {
        $list = $this->main->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $detail = base_url().$this->module.'/'.$this->file_name.'/detail/'.$r->id;
            $print = base_url().$this->module.'/'.$this->file_name.'/print_pdf/'.$r->id;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = "<a href=$detail>#".$r->no.'</a>';
            $row[] = $r->supplier;
            $row[] = $r->tanggal_transaksi;
            $row[] = $r->metode_pembayaran;
            $row[] = $r->po;
            $row[] = $r->gudang;

            $row[] ="<a class='btn btn-sm btn-primary' href=$detail title='detail'><i class='fa fa-info'></i></a>
                    <a class='btn btn-sm btn-light-azure' href=$print target='_blank' title='detail'><i class='fa fa-print'></i></a>";
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

    function print_pdf($id)
    {
        permissionUser();
        $this->data['id'] = $id;
        $this->data[$this->file_name] = $this->main->get_detail($id);
        $this->data[$this->file_name.'_list'] = $this->main->get_list_detail($id);
        
        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view($this->module.'/'.$this->file_name.'/pdf', $this->data, true); 
        $mpdf = new mPDF();
        $mpdf = new mPDF('A4');
        $mpdf->WriteHTML($html);
        $mpdf->Output($id.'-'.$title.'.pdf', 'I');
    }

    //FOR JS

    function get_supplier_detail($id)
    {
        $up = getValue('up', 'supplier', array('id'=>'where/'.$id));
        $alamat = getValue('alamat', 'supplier', array('id'=>'where/'.$id));

        echo json_encode(array('up'=>$up, 'alamat'=>$alamat));

    }

    function get_nama_barang($id)
    {
        $q = getValue('title', 'barang', array('id'=>'where/'.$id));

        echo json_encode($q);

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