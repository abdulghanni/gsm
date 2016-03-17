<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lists extends MX_Controller {
    public $data;
    var $module = 'stok';
    var $title = 'List Stok';
    var $file_name = 'lists';
    
    function __construct()
    {
        parent::__construct();
		$this->load->library('flexigrid');
        $this->load->helper('flexigrid');
        $this->load->model($this->module.'/'.$this->file_name.'_model', 'main');
    }

    function index()
    {
			
		//print_r($this->input->post());
		$gdg=($this->input->post('gdg')?$this->input->post('gudang_id'):0);
		$brg=($this->input->post('item')?$this->input->post('barang_id'):0);
			
        $this->data['title'] = $this->title;
        $this->data['main_title'] = $this->module.'';
		$this->data['js_grid']=$this->get_column($gdg,$brg);
		$this->data['opt_gudang']=GetOptAll('gudang','-Gudang-');
		$this->data['opt_item']=GetOptAll('barang','-Barang-');
        permissionUser();
        $this->_render_page($this->module.'/'.$this->file_name.'/index', $this->data);
	
	}
	
	function get_column($gdg,$brg){
			
		
		/* $gdg=($this->input->post('gdg')?$this->input->post('gudang_id'):'');
		$brg=($this->input->post('item')?$this->input->post('barang_id'):''); */

		$colModel['idnya'] = array('ID',50,TRUE,'left',2,TRUE);
		$colModel['a.id'] = array('ID',100,TRUE,'left',2,TRUE);
		$colModel['b.title'] = array('Barang',110,TRUE,'left',2);
		$colModel['c.title'] = array('kontak',110,TRUE,'left',2);
		$colModel['d.title'] = array('Gudang',110,TRUE,'left',2);
		$colModel['a.stok_dalam'] = array('Stok',110,TRUE,'left',2);
		$colModel['a.minimum_stok'] = array('Stok Minimum',110,TRUE,'left',2);
		$colModel['a.harga_beli'] = array('Harga Beli',110,TRUE,'left',2);
		$colModel['a.harga_jual'] = array('Harga Jual',110,TRUE,'left',2);
        
		$gridParams = array(
		'rp' => 10,
		'rpOptions' => '[10,20,30,40]',
		'pagestat' => 'Displaying: {from} to {to} of {total} items.',
		'blockOpacity' => 0.5,
		'title' => '',
		'showTableToggleBtn' => TRUE
		);
        
		/* $buttons[] = array('select','check','btn');
		$buttons[] = array('deselect','uncheck','btn');
		$buttons[] = array('separator');
		$buttons[] = array('add','add','btn');
		$buttons[] = array('separator');
		$buttons[] = array('edit','edit','btn');
		$buttons[] = array('delete','delete','btn'); */
		$buttons[] = array('separator');
		
		
		
		return $grid_js = build_grid_js('flex1',site_url($this->module.'/'.$this->file_name."/get_record").'/'.$gdg.'/'.$brg,$colModel,'id','asc',$gridParams,$buttons);
	}
	
	function get_flexigrid($gdg,$brg)
	{
		//Build contents query
		$this->db->select("a.id as id, b.title as barang,c.title as kontak,d.title as gudang,a.dalam_stok as stok,a.minimum_stok as stok_min,a.harga_beli as harga_beli,a.harga_jual as harga_jual")->from('stok a');
		$this->db->join('barang b', "a.barang_id=b.id", 'left');
		$this->db->join('kontak c', "a.supplier_id=c.id", 'left');
		$this->db->join('gudang d', "a.gudang_id=d.id", 'left');
		if($gdg!=0) $this->db->where('a.gudang_id',$gdg);
		if($brg!=0) $this->db->where('a.barang_id',$brg);
		$this->flexigrid->build_query(TRUE);
		
		//Get contents
		$return['records'] = $this->db->get();
		//lastq();
		 /* */ 
		//Build count query
		$this->db->select("count(id) as record_count")->from('stok');
		if($gdg!=0) $this->db->where('a.gudang_id',$gdg);
		if($brg!=0) $this->db->where('a.barang_id',$brg);
		$this->flexigrid->build_query(FALSE);
		$record_count = $this->db->get();
		$row = $record_count->row();
		
		//Get Record Count
		$return['record_count'] = $row->record_count; 
		//$return['record_count'] =$return['records']->num_rows();
		
		//Return all
		return $return;
	}
	
	function get_record($gdg,$brg){
		
		//print_r($this->input->post());
		$valid_fields = array('a.id',
		'b.title',
		'c.title',
		'd.title',
		'a.stok_dalam',
		'a.minimum_stok',
		'a.harga_beli',
		'a.harga_jual'
		);
		
		$this->flexigrid->validate_post('id','DESC',$valid_fields);
		$records = $this->get_flexigrid($gdg,$brg);
		
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
			$row->barang,
			$row->kontak,
			$row->gudang,
			$row->stok,
			$row->stok_min,
			$row->harga_beli,
			$row->harga_jual
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
        $this->data['gudang'] = getAll('gudang')->result();
        $this->data['options_kontak'] = options_row('main','get_kontak','id','title','-- Pilih kontak --');
        
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
        $list = array(
                        'kode_barang'=>$this->input->post('kode_barang'),
                        'deskripsi'=>$this->input->post('deskripsi'),
                        'jumlah'=>$this->input->post('jumlah'),
                        'satuan'=>$this->input->post('satuan'),
                        'harga'=>$this->input->post('harga'),
                        'disc'=>$this->input->post('disc'),
                        'pajak'=>$this->input->post('pajak'),
                        );

        $data = array(
                'no' => $this->input->post('no'),
                'supplier_id'=>$this->input->post('supplier_id'),
                'up'=>$this->input->post('up'),
                'alamat'=>$this->input->post('alamat'),
                'metode_pembayaran_id'=>$this->input->post('metode_pembayaran_id'),
                'tanggal_transaksi'=>date('Y-m-d',strtotime($this->input->post('tanggal_transaksi'))),
                'po'=>$this->input->post('po'),
                'gudang_id'=>$this->input->post('gudang_id'),
                'jatuh_tempo_pembayaran'=>date('Y-m-d',strtotime($this->input->post('tanggal_transaksi'))),
                'kurensi_id'=>$this->input->post('kurensi_id'),
                'biaya_pengiriman'=>str_replace(',', '', $this->input->post('biaya_pengiriman')),
                'dibayar'=>str_replace(',', '', $this->input->post('dibayar')),
                'lama_angsuran_1' =>$this->input->post('lama_angsuran_1'),
                'lama_angsuran_2' =>$this->input->post('lama_angsuran_2'),
                'bunga' =>str_replace(',', '', $this->input->post('bunga')),
                'keterangan' =>$this->input->post('keterangan'),
            );

        $this->db->insert($this->module.'_'.$this->file_name, $data);
        $insert_id = $this->db->insert_id();
        for($i=0;$i<sizeof($list['kode_barang']);$i++):
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
        $this->db->insert($this->module.'_'.$this->file_name.'_list', $data2);
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
            $row[] = $r->kontak;
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

    function get_kontak_detail($id)
    {
        $up = getValue('up', 'kontak', array('id'=>'where/'.$id));
        $alamat = getValue('alamat', 'kontak', array('id'=>'where/'.$id));

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
                    $this->template->add_css('vendor/select2/select2.css');
                    $this->template->add_css('vendor/DataTables/css/DT_bootstrap.css');
                    $this->template->add_js('vendor/DataTables/js/jquery.dataTables.min.js');
                    $this->template->add_js('flexigrid/js/flexigrid.pack.js');
                    $this->template->add_js('vendor/select2/select2.min.js');
                   // $this->template->add_js('assets/js/'.$this->module.'/'.$this->file_name.'/index.js');
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
                   // $this->template->add_js('assets/js/'.$this->module.'/'.$this->file_name.'/input.js');
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