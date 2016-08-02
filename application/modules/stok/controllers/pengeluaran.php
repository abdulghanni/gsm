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
		$colModel['suratjalan'] = array('No surat jalan',140,TRUE,'left',2);
		$colModel['ref'] = array('Ref',140,TRUE,'left',2);
		
		$colModel['gudang_to'] = array('Tujuan',110,TRUE,'left',2);
		$colModel['tgl'] = array('Tanggal',110,TRUE,'left',2);
		$colModel['surat_jalan'] = array('Surat Jalan',110,TRUE,'left',2);
		$colModel['delivered'] = array('Is Delivered',110,TRUE,'left',2);
		$colModel['created_by'] = array('Input Oleh',110,TRUE,'left',2);
		$colModel['created_on'] = array('Input Tanggal',110,TRUE,'left',2);
        
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
		return $grid_js = build_grid_js('flex1',site_url($this->module.'/'.$this->file_name."/get_record"),$colModel,'id','desc',$gridParams,$buttons);
	}
	
	function get_flexigrid()
	{
		
		//Build contents query
		$this->db->select("a.id as id,a.ref_id,a.no,a.ref as ref,c.title as gudang_to,a.tgl as tgl,a.created_on,a.is_delivered as is_delivered, a.created_on, d.username as username")->from('stok_pengeluaran a');
		//$this->db->join('gudang b','b.id=a.gudang_from','left');
		$this->db->join('gudang c','c.id=a.gudang_to','left');
		$this->db->join('users d','d.id=a.created_by','left');
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
		
		$valid_fields = array('id','ref','gudang_to','tgl','is_delivered','username');
		
		$this->flexigrid->validate_post('id','DESC',$valid_fields);
		$records = $this->get_flexigrid();
		
		$this->output->set_header($this->config->item('json_header'));
		
		$record_items = array();
		
		foreach ($records['records']->result() as $row)
		{
            if(!empty($row->ref_id)){
            	$refid = explode(',', $row->ref_id);
            	$ref = '';
            	foreach($refid as $r=>$v):
            		$ref .="<a class='btn btn-sm btn-light-azure' href='".base_url()."stok/pengeluaran/detail/".$row->id."' target='_blank' title='detail'>".getValue('so','sales_order', array('id'=>'where/'.$v))."</i></a><br/>";
            	endforeach;
            }else{
            	$ref="<a class='btn btn-sm btn-light-azure' href='".base_url()."stok/pengeluaran/detail/".$row->id."' target='_blank' title='detail'>".$row->ref."</i></a>";
        	}

        	$dev="<a href='".base_url()."stok/pengeluaran/deliver/".$row->id."'>".$row->is_delivered."</a>";

			$no_sj = (!empty($row->no)) ? $row->no : date('Ymd', strtotime($row->created_on)).sprintf('%04d',$row->id);
			$record_items[] = array(
			$row->id,
			$row->id,
			$row->id,
           "<a class='btn btn-sm btn-light-azure' href='".base_url()."stok/pengeluaran/detail/".$row->id."' target='_blank' title='detail'>".$no_sj."</a>",
            $ref,
			$row->gudang_to,
			$row->tgl,
			"<a class='btn btn-sm btn-light-azure' href='".base_url()."stok/pengeluaran/surat_jalan/".$row->id."' target='_blank' title='detail'><i class='fa fa-file'></i></a>",
			$dev,
			$row->username,
                        $row->created_on,

			);
		}
		
		return $this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));;
	} 
        function deliver($id){
            $this->db->where('id',$id);
            $this->db->update("stok_pengeluaran",array('is_delivered'=>'Yes'));
            redirect('stok/pengeluaran');
        }
	
   function surat_jalan($id)
    {
        permissionUser();
        $no = getValue('no','stok_pengeluaran', array('id'=>'where/'.$id));
        $created_on = getValue('created_on','stok_pengeluaran', array('id'=>'where/'.$id));
        $this->data['nosurat']= (!empty($no)) ? $no : date('Ymd', strtotime($created_on)).sprintf('%04d',$id);
        $this->data['id'] = $id;
        $this->data[$this->file_name] = GetAll('stok_pengeluaran',array('id'=>'where/'.$id))->row_array();
        //$this->data['clients']=$this->db->query("SELECT kontak_id FROM sales_order WHERE so='".$this->data[$this->file_name]['ref']."' ")->row_array();//lastq();
        $this->data['clients']=$this->db->query("SELECT kontak_id FROM stok_pengeluaran WHERE id='".$id."' ")->row_array();//lastq();
        
        $this->data['client']=GetValue('title','kontak',array('id'=>'where/'.$this->data['clients']['kontak_id']));
       
        $this->data[$this->file_name.'_list'] =  GetAll('stok_pengeluaran_list',array('pengeluaran_id'=>'where/'.$id))->result_array();
        //$this->load->view($this->module.'/'.$this->file_name.'/surat_jalan', $this->data); 
//        $this->load->library('mpdf60/mpdf');
//        $html = $this->load->view($this->module.'/'.$this->file_name.'/surat_jalan', $this->data, true); 
//        $mpdf = new mPDF();
//        $mpdf = new mPDF('A4');
//        $mpdf->WriteHTML($html);
//        $mpdf->Output($id.'-'.$title.'.pdf', 'I');
        
  $this->load->library('pdf');
  $html = $this->load->view($this->module.'/'.$this->file_name.'/surat_jalan', $this->data, true); 
		$this->pdf->load_html($html);
  $this->pdf->render();
  $this->pdf->stream($id.'-'.$this->title.'.pdf');
        //$this->load->view($this->module.'/'.$this->file_name.'/surat_jalan', $this->data);
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
        $this->data['gudang'] = GetOptAll('gudang','-Pilih Gudang-');
        $this->data['opt_po'] = GetOptAll('sales_order','-Sales Order-',array('is_draft'=>'where/0','is_deleted'=>'where/0','id'=>'order/desc'),'so','','',array('!=status_id'=>'2'));
        $this->_render_page($this->module.'/'.$this->file_name.'/input', $this->data);
    }

    function detail($id)
    {
        $this->data['title'] = $this->title.' - Detail';
        permissionUser();
        $this->data['id'] = $id;
		$this->data['pengeluaran']=GetAll('stok_pengeluaran',array('id'=>'where/'.$id))->row();
		$this->data['list']=GetAll('stok_pengeluaran_list',array('pengeluaran_id'=>'where/'.$id));
		$this->data['refid']=GetAll($this->data['pengeluaran']->ref_type,array('id'=>'where/'.$this->data['pengeluaran']->ref_id))->row_array();
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
					'ref_id'=>$this->input->post('idtrx'),
	        		'kode_barang'=>$this->input->post('brg'),
					'deskripsi'=>$this->input->post('deskripsi'),
					'catatan'=>$this->input->post('catatan_barang'),
                );

        $data = array(
        		'no' => $this->input->post('no'),             
                'ref'=>'',              
               	'ref_type'=>'sales_order',
                'kontak_id'=>$this->input->post('kontak_id'),
                'alamat'=>$this->input->post('alamat'),
                'ref_id'=>implode(',',$this->input->post('ref_id')),
                'tgl'=>date('Y-m-d',strtotime($this->input->post('tgl'))),
                'gudang_to'=>$this->input->post('gudang_id'),
                'driver'=>$this->input->post('driver'),
                'plat'=>$this->input->post('plat'),
               
                'keterangan' =>$this->input->post('catatan'),
                'created_on' =>date("Y-m-d"),
                'created_by' =>sessId(),
            );

        $this->db->insert($this->module.'_'.$this->file_name, $data);
        $insert_id = $this->db->insert_id();
		$sisaan=0;
                $ref='';
        for($i=0;$i<sizeof($list['kode_barang']);$i++):
            
            $qtysisa=konversi($list['kode_barang'][$i],$list['jumlah'][$i],$list['satuan'][$i]);
            
            
		$sisa=$list['jumlah_po'][$i]-$qtysisa;
            
                if(!isset($ref[$list['ref_id'][$i]])){
                    $ref[$list['ref_id'][$i]]=0;
                }else{
                    $ref[$list['ref_id'][$i]]=+$sisa;
                }
            
            $data2 = array(
                $this->file_name.'_id' => $insert_id,
                'ref_type' => $data['ref_type'],
                'order_id' => $list['ref_id'][$i],
                'ref' => GetValue('so','sales_order',array('id'=>'where/'.$list['ref_id'][$i])) ,
                'list_id' => $list['list_id'][$i],
                'barang_id' => $list['kode_barang'][$i],
                'deskripsi' => $list['deskripsi'][$i],
                'catatan' => $list['catatan'][$i],
                'jumlah' => str_replace(',', '', $list['jumlah'][$i]),
                'satuan_id' => $list['satuan'][$i],
                'sisa' => $sisa,
                );
        $this->db->insert($this->module.'_'.$this->file_name.'_list', $data2);
        $sisaan=+$sisa;
        //if($sisaan==0){$this->db->query("UPDATE sales_order SET is_closed=1 WHERE id='".$this->input->post('ref_id')."'");}
		keluarstok($this->input->post('gudang_id'),$list['kode_barang'][$i],str_replace(',','',$list['jumlah'][$i]),$data2['satuan_id'],$data['ref_type'],$list['ref_id'][$i],$data['tgl'],$data['ref']);
		$this->insert_so_status($list['ref_id'][$i]);
		endfor;

		//echo $sisaan;
                //foreach($ref as $key=>$val){
         //if($val==0){$this->db->query("UPDATE sales_order SET is_closed=1 WHERE id='".$key."'");}
                //}

        $this->send_notification($insert_id);
        redirect($this->module.'/'.$this->file_name, 'refresh');
    }  

	function send_notification($id)
    {
        permissionUser();
        $url = base_url().'stok/pengeluaran/detail/'.$id;
        $isi = getName(sessId())." Melakukan Transaksi pengeluaran Barang <a href=$url> KLIK DISINI </a> ";
        $approver = getAll('approver');print_mz($approver->result());
        foreach($approver->result() as $r):
		$data = array('sender_id' => sessId(),
		'receiver_id' => $r->user_id,
		'sent_on' => dateNow(),
		'judul' => 'pengeluaran Order',
		'isi' => $isi,
		'url' => $url,
		);
        $this->db->insert('notifikasi', $data);
        endforeach;
        return TRUE;
    }
	function cariref(){
		$num_rows = getAll($this->module.'_'.$this->file_name)->num_rows();
        $last_id = ($num_rows>0) ? $this->db->select('id')->order_by('id', 'asc')->get($this->module.'_'.$this->file_name)->last_row()->id : 0;
        $data['last_id'] = ($num_rows>0) ? $last_id+1 : 1;
        $this->load->model('sales/order_model', 'main');
        $data['options_kontak'] = options_row('main','get_kontak','id','title','-- Pilih Supplier --');
			$v=$_POST['v'];
			$cariref=$this->db->query("SELECT * FROM sales_order WHERE (id='$v' OR so='$v') ");
			if($cariref->num_rows()>0){
					
					$data['refid']=$cariref->row_array();
				//if($data['refid']['is_app_lv1']==1){
					if($data['refid']['is_closed']==0){
						$data['reftype']='sales_order';
						$cekparsial=$this->db->query("SELECT * FROM stok_pengeluaran WHERE ref_type='".$data['reftype']."' AND ref_id='".$data['refid']['id']."'");
						if($cekparsial->num_rows()>0){
							$data['part']=TRUE;	
							$data['partno']=$cekparsial->num_rows()+1;	
						}
						
						$this->load->view('stok/pengeluaran/input_id',$data);
						
						}
					else{
							$data['message']="Transaksi sudah CLOSED";
							$this->load->view('stok/pengeluaran/error',$data);
						}
				/* }
				else{
					$data['message']="S.O BELUM di APPROVE";
				$this->load->view('stok/pengeluaran/error',$data);} */
			}
			else{
				$data['message']="Transaksi TIDAK DITEMUKAN";
				$this->load->view('stok/pengeluaran/error',$data);
			}
	}
	function carilist(){
			$v=$_POST['v'];
			$cariref=$this->db->query("SELECT * FROM sales_order WHERE (id='$v' OR so='$v') ");
			if($cariref->num_rows()>0){
				$data['refid']=$cariref->row_array();
				//if($data['refid']['is_app_lv1']==1){
					if($data['refid']['is_closed']==0){
					
					$data['reftype']='sales_order';
					$cekparsial=$this->db->query("SELECT * FROM stok_pengeluaran_list WHERE ref_type='".$data['reftype']."' AND order_id='".$data['refid']['id']."' GROUP BY pengeluaran_id ORDER BY id DESC ");
					$so = getValue('so', 'sales_order', array('id'=>'where/'.$v));
					$pengiriman_ke = getAll('stok_pengeluaran', array('ref'=>'where/'.$so));//print_mz($pengiriman_ke);
                                        // lastq();
					if($cekparsial->num_rows()>0){
						$data['part']=TRUE;	
						$data['partno']=$pengiriman_ke->num_rows()+1;
							$data['partdata']=$cekparsial->row_array();
						
					}
						
						$data['list']=GetAll('sales_order_list',array('order_id'=>'where/'.$data['refid']['id']))->result_array();
						$this->load->view('stok/pengeluaran/input_list',$data);
					}
				//}
			}
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
	function bast($id=NULL){
			$this->load->view('stok/pengeluaran/bast');
	}
	function addso($id=NULL){
        $data['idp']=$_POST['idp'];    
        $data['opt_po'] = GetOptAll('sales_order','-Sales Order-',array('is_draft'=>'where/0','is_deleted'=>'where/0','id'=>'order/desc'),'so','','',array('!=status_id'=>'2'));
			$this->load->view('stok/pengeluaran/sobaru',$data);
	}

	function insert_so_status($id){
        $po_in_stok = GetAllSelect('stok_pengeluaran_list', 'order_id', array('order_id'=>'where/'.$id))->num_rows();
        $num_in_po = $this->db->select_sum('jumlah')->where('order_id', $id)->get('sales_order_list')->row()->jumlah;
        $num_in_stok = $this->db->select_sum('jumlah')->where('order_id', $id)->get('stok_pengeluaran_list')->row()->jumlah;
        if($num_in_stok >= $num_in_po){
           $this->db->where('id', $id)->update('sales_order', array('status_id'=>2));
        }elseif($num_in_stok < $num_in_po && $po_in_stok > 0){
            $this->db->where('id', $id)->update('sales_order', array('status_id'=>3));
        }elseif($po_in_stok < 1){
            $this->db->where('id', $id)->update('sales_order', array('status_id'=>1));
        }else{
            return true;
        }
    }

    function insert_all_so_status(){
        $q = GetAllSelect('sales_order', 'id')->result();
        foreach ($q as $k) {
            $this->insert_so_status($k->id);
            print_r($this->db->last_query());
        }
    }
}