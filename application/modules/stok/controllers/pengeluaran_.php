<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends MX_Controller {
    public $data;
    var $module = 'stok';
    var $title = 'Pengeluaran';
    var $file_name = 'pengeluaran';
    
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
		$colModel['ref'] = array('Ref',110,TRUE,'left',2);
		
		$colModel['gudang_to'] = array('Tujuan',110,TRUE,'left',2);
		$colModel['tgl'] = array('Tanggal',110,TRUE,'left',2);
        
		$gridParams = array(
		'rp' => 25,
		'rpOptions' => '[10,20,30,40]',
		'pagestat' => 'Displaying: {from} to {to} of {total} items.',
		'blockOpacity' => 0.5,
		'title' => '',
		'showTableToggleBtn' => TRUE
		);
        
		$buttons[] = array('select','check','btn');
		$buttons[] = array('deselect','uncheck','btn');
		$buttons[] = array('separator');
		$buttons[] = array('add','add','btn');
		$buttons[] = array('separator');
		$buttons[] = array('edit','edit','btn');
		$buttons[] = array('delete','delete','btn');
		$buttons[] = array('separator');
		
		return $grid_js = build_grid_js('flex1',site_url($this->module.'/'.$this->file_name."/get_record"),$colModel,'id','asc',$gridParams,$buttons);
	}
	
	function get_flexigrid()
	{
		
		//Build contents query
		$this->db->select("a.id as id,a.ref as ref,c.title as gudang_to,a.tgl as tgl,a.created_on")->from('stok_Pengeluaran a');
		//$this->db->join('gudang b','b.id=a.gudang_from','left');
		$this->db->join('gudang c','c.id=a.gudang_to','left');
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
			$row->ref,
			$row->gudang_to,
			$row->tgl
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
			$this->db->delete($this->module.'_'.$this->file_name,array('id'=>$country_id));				
		}
		//$error = "Selected countries (id's: ".$this->input->post('items').") deleted with success. Disabled for demo";
		//echo "Sukses!";
	}

    function input()
    {
        $this->data['title'] = $this->title.' - Input';
        permissionUser();
        $num_rows = getAll($this->module.'_'.$this->file_name)->num_rows();
        $last_id = ($num_rows>0) ? $this->db->select('id')->order_by('id', 'asc')->get($this->module.'_'.$this->file_name)->last_row()->id : 0;
        $this->data['last_id'] = ($num_rows>0) ? $last_id+1 : 1;
		
        $this->data['barang'] = getAll('barang')->result_array();
        $this->data['satuan'] = getAll('satuan')->result_array();
        $this->data['kurensi'] = getAll('kurensi')->result();
        $this->data['metode'] = getAll('metode_pembayaran')->result();
        //$this->data['gudang'] = getAll('gudang')->result();
        $this->data['gudang'] = GetOptAll('gudang','-Pilih Gudang-');
       // $this->data['options_supplier'] = options_row('main','get_supplier','id','title','-- Pilih Supplier --');
        
        $this->_render_page($this->module.'/'.$this->file_name.'/input', $this->data);
    }

    function detail($id)
    {
        $this->data['title'] = $this->title.' - Detail';
        permissionUser();
        $this->data['id'] = $id;
        $this->data[$this->file_name] = $this->main->get_detail($id);
        $this->data[$this->file_name.'_list'] = $this->main->get_list_detail($id);

        $this->_render_page($this->module.'/'.$this->file_name.'/detail', $this->data);
    }

    function add()
    {
        permissionUser();
		//print_mz($this->input->post());
        $list = array(
                        'chkbox'=>$this->input->post('chkbox'),
                        'kode_barang'=>$this->input->post('kode_barang'),
                        'deskripsi'=>$this->input->post('deskripsi'),
                        'jumlah'=>$this->input->post('jumlah'),
                        'satuan'=>$this->input->post('satuan'),
                        'harga'=>$this->input->post('harga'),
                        'disc'=>$this->input->post('disc'),
                        'pajak'=>$this->input->post('pajak'),
                        );

        $data = array(
                'ref'=>$this->input->post('ref'),
                
                'tgl'=>date('Y-m-d',strtotime($this->input->post('tgl'))),
                
                'gudang_to'=>$this->input->post('gudang_to'),
               
                'keterangan' =>$this->input->post('keterangan'),
            );

        $this->db->insert($this->module.'_'.$this->file_name, $data);
        $insert_id = $this->db->insert_id();
        for($i=1;$i<=sizeof($list['kode_barang']);$i++):
		if(isset($list['chkbox'][$i])){
            $data2 = array(
                $this->file_name.'_id' => $insert_id,
                'kode_barang' => $list['kode_barang'][$i],
                'deskripsi' => $list['deskripsi'][$i],
                'jumlah' => str_replace(',', '', $list['jumlah'][$i]),
                'satuan_id' => $list['satuan'][$i],
                'harga' => str_replace(',', '', $list['harga'][$i]),
                'disc' => str_replace(',', '', $list['disc'][$i]),
                'pajak' => str_replace(',', '', $list['pajak'][$i]),
                );
        $this->db->insert($this->module.'_'.$this->file_name.'_list', $data2);}
        endfor;
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