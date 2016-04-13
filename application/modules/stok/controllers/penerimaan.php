<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Penerimaan extends MX_Controller {
    public $data;
    var $module = 'stok';
    var $title = 'Penerimaan';
    var $file_name = 'penerimaan';
    
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
		$usergroup=GetValue('group_id','users_groups',array('user_id'=>'where/'.$this->session->userdata('user_id')));
		$colModel['idnya'] = array('ID',50,TRUE,'left',2,TRUE);
		$colModel['id'] = array('ID',100,TRUE,'left',2,TRUE);
		$colModel['ref'] = array('Ref',150,TRUE,'left',2);
		
		$colModel['gudang_to'] = array('Tujuan',110,TRUE,'left',2);
		$colModel['tgl'] = array('Tanggal',110,TRUE,'left',2);
		$colModel['bast'] = array('BAST',110,TRUE,'left',2);
		$colModel['created_by'] = array('Input Oleh',110,TRUE,'left',2);
		//if($usergroup=='1'||$usergroup=='4'||$usergroup=='6'){
                //$colModel['invoice'] = array('Invoice',110,TRUE,'left',2);}
        
		$gridParams = array(
		'rp' => 25,
		'rpOptions' => '[10,20,30,40]',
		'pagestat' => 'Displaying: {from} to {to} of {total} items.',
		'blockOpacity' => 0.5,
		'title' => '',
		'showTableToggleBtn' => TRUE
		);
        
		$buttons[] = array('separator');
		/* $buttons[] = array('select','check','btn');
		$buttons[] = array('deselect','uncheck','btn');
		$buttons[] = array('separator');
		$buttons[] = array('add','add','btn');
		$buttons[] = array('separator');
		$buttons[] = array('edit','edit','btn');
		$buttons[] = array('delete','delete','btn');
		$buttons[] = array('separator');
		 */
		return $grid_js = build_grid_js('flex1',site_url($this->module.'/'.$this->file_name."/get_record"),$colModel,'id','asc',$gridParams,$buttons);
	}
	
	function get_flexigrid()
	{
		
		//Build contents query
		$this->db->select("a.id as id,a.ref as ref,c.title as gudang_to,a.tgl as tgl,a.created_on, a.created_by")->from('stok_Penerimaan a');
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
			"<a class='btn btn-sm btn-light-azure' href='".base_url()."stok/penerimaan/detail/".$row->id."' target='_blank' title='detail'>".$row->ref."</i></a>",
			$row->gudang_to,
			date('d-m-Y',strtotime($row->tgl)),
			"<a class='btn btn-sm btn-light-azure' href='".base_url()."stok/penerimaan/bast/".$row->id."' target='_blank' title='bast'><i class='fa fa-file'></i></a>",
			GetValue('username','users',array('id'=>'where/'.$row->created_by))
			);
                        //"<a class='btn btn-sm btn-light-azure' href='".base_url()."stok/penerimaan/INV/".$row->id."' target='_blank' title='invoice'><i class='fa fa-file'></i></a>",
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
        $this->data['opt_po'] = GetOptAll('purchase_order','-Purchase Order-',array('app_status_id_lv4'=>'where/1','is_closed'=>'where/0','id'=>'order/desc'),'po');
       // $this->data['options_kontak'] = options_row('main','get_kontak','id','title','-- Pilih kontak --');
        
        $this->_render_page($this->module.'/'.$this->file_name.'/input', $this->data);
    }

   
    function detail($id)
    {
        $this->data['title'] = $this->title.' - Detail';
        permissionUser();
        $this->data['id'] = $id;
		$this->data['penerimaan']=GetAll('stok_penerimaan',array('id'=>'where/'.$id))->row();
		$this->data['list']=GetAll('stok_penerimaan_list',array('penerimaan_id'=>'where/'.$id));
		$this->data['refid']=GetAll($this->data['penerimaan']->ref_type,array('id'=>'where/'.$this->data['penerimaan']->ref_id))->row_array();
	// $this->data[$this->file_name] = $this->main->get_detail($id);
		// $this->data[$this->file_name.'_list'] = $this->main->get_list_detail($id);
		
        $this->_render_page($this->module.'/'.$this->file_name.'/detail', $this->data);
    }
	

    function add()
    {
        permissionUser();
		//print_mz($this->input->post());
        $list = array(
                        'list_id'=>$this->input->post('list'),
                        'jumlah'=>$this->input->post('jumlah'),
                        'satuan'=>$this->input->post('satuan'),
                        'jumlah_po'=>$this->input->post('jumlah_po'),
						'kode_barang'=>$this->input->post('brg')
                        );

        $data = array(
                'ref'=>  GetValue('po', 'purchase_order',array('id'=>'where/'.$this->input->post('ref'))),
                'ref_type'=>$this->input->post('ref_type'),
                'ref_id'=>$this->input->post('ref_id'),
                
                'tgl'=>date('Y-m-d',strtotime($this->input->post('tgl'))),
                
                'gudang_to'=>$this->input->post('gudang_id'),
               
                'keterangan' =>$this->input->post('keterangan'),
                'created_on' =>date("Y-m-d"),
                'created_by' =>sessId(),
            );

        $this->db->insert($this->module.'_'.$this->file_name, $data);
        $insert_id = $this->db->insert_id();
		$sisaan=0;
        for($i=1;$i<=sizeof($list['kode_barang']);$i++):
            $barang=$list['kode_barang'][$i];
            $qty=$list['jumlah'][$i];
            $satuan=$list['satuan'][$i];
            $hasil=konversi($barang,$qty,$satuan);
            
            
		$sisa=$list['jumlah_po'][$i]-$list['jumlah'][$i];
            $data2 = array(
                $this->file_name.'_id' => $insert_id,
                'order_id' => $this->input->post('ref_id'),
                'list_id' => $list['list_id'][$i],
                'barang_id' => $list['kode_barang'][$i],
                'jumlah' => str_replace(',', '', $list['jumlah'][$i]),
                'satuan_id' => $list['satuan'][$i],
                'sisa' => $sisa,
                );
        $this->db->insert($this->module.'_'.$this->file_name.'_list', $data2);
        $sisaan=+$sisa;
	masukstok($this->input->post('gudang_id'),$list['kode_barang'][$i],str_replace(',', '', $list['jumlah'][$i]),$data2['satuan_id'],$data['ref_type'],$data['ref_id'],$data['tgl'],$data['ref']);
        $this->send_notification($insert_id);
		endfor;
		//echo $sisaan;
		if($sisaan==0){$this->db->query("UPDATE purchase_order SET is_closed=1 WHERE id='".$this->input->post('ref_id')."'");}
        redirect($this->module.'/'.$this->file_name, 'refresh');
    }  
	function send_notification($id)
    {
        permissionUser();
        $url = base_url().'purchase/order/INV/'.$id;
        $isi = getName(sessId())." Melakukan Transaksi Penerimaan Barang <a href=$url> KLIK DISINI </a> ";
        $approver = getAll('approver');
        foreach($approver->result() as $r):
		$data = array('sender_id' => sessId(),
		'receiver_id' => $r->user_id,
		'sent_on' => dateNow(),
		'judul' => 'Penerimaan Order',
		'isi' => $isi,
		'url' => $url,
		);
        $this->db->insert('notifikasi', $data);
        endforeach;
        return TRUE;
    }
	function cariref(){
			$v=$_POST['v'];
			$cariref=$this->db->query("SELECT * FROM purchase_order WHERE (id='$v' OR po='$v') AND is_draft=0");
                        //echo $this->db->last_query();
			if($cariref->num_rows()>0){
					
					$data['refid']=$cariref->row_array();
				if($data['refid']['app_status_id_lv4']==1){
					if($data['refid']['is_closed']==0){
						$data['reftype']='purchase_order';
						$cekparsial=$this->db->query("SELECT * FROM stok_penerimaan WHERE ref_type='".$data['reftype']."' AND ref_id='".$data['refid']['id']."'");
						if($cekparsial->num_rows()>0){
							$data['part']=TRUE;	
							$data['partno']=$cekparsial->num_rows()+1;	
						}
						
						$this->load->view('stok/penerimaan/input_id',$data);
						
						}
					else{
							$data['message']="Transaksi sudah CLOSED";
							$this->load->view('stok/penerimaan/error',$data);
						}
				}
				else{
					$data['message']="P.O BELUM di APPROVE";
				$this->load->view('stok/penerimaan/error',$data);}
			}
			else{
				$data['message']="Transaksi TIDAK DITEMUKAN";
				$this->load->view('stok/penerimaan/error',$data);
			}
	}
	function carilist(){
			$v=$_POST['v'];
			$cariref=$this->db->query("SELECT * FROM purchase_order WHERE (id='$v' OR po='$v') AND is_draft=0");
			if($cariref->num_rows()>0){
				$data['refid']=$cariref->row_array();
				if($data['refid']['app_status_id_lv4']==1){
					if($data['refid']['is_closed']==0){
					
					$data['reftype']='purchase_order';
					$cekparsial=$this->db->query("SELECT * FROM stok_penerimaan WHERE ref_type='".$data['reftype']."' AND ref_id='".$data['refid']['id']."' ORDER BY id DESC LIMIT 1");
					if($cekparsial->num_rows()>0){
						$data['part']=TRUE;	
						$data['partno']=$cekparsial->num_rows()+1;
							$data['partdata']=$cekparsial->row_array();
						
					}
						
						$data['list']=GetAll('purchase_order_list',array('order_id'=>'where/'.$data['refid']['id']))->result_array();
						$this->load->view('stok/penerimaan/input_list',$data);
					}
				}
			}
	}
   function INV($id)
    {
        permissionUser();
        $this->data['id'] = $id;
        $this->data[$this->file_name] = GetAll('stok_penerimaan',array('id'=>'where/'.$id));
        $this->data[$this->file_name.'_list'] =  GetAll('stok_penerimaan_list',array('id'=>'where/'.$id));
        
        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view($this->module.'/'.$this->file_name.'/invoice', $this->data, true); 
        $mpdf = new mPDF();
        $mpdf = new mPDF('A4');
        $mpdf->WriteHTML($html);
        $mpdf->Output($id.'-'.$title.'.pdf', 'I');
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
    function bast($id=NULL)
    {
        permissionUser();
        $this->data['id'] = $id;
        $this->data[$this->file_name] = GetAll($this->module.'_'.$this->file_name,array('id'=>'where/'.$id))->row_array();
        $this->data[$this->file_name.'_list'] = GetAll($this->module.'_'.$this->file_name.'_list',array('id'=>'where/'.$id)); 
        
        $this->load->library('mpdf60/mpdf');
        
          $html = $this->load->view($this->module.'/'.$this->file_name.'/bast', $this->data, true); 
          to_doc($html,'BAST');
//        $mpdf = new mPDF();
//        $mpdf = new mPDF('A4');
//        $mpdf->WriteHTML($html);
//        $mpdf->Output($id.'_BAST-'.$title.'.pdf', 'I');
          
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