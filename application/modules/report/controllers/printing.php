<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Printing extends MX_Controller {
    public $data;
    var $module = 'report';
    var $title = 'Custom Report';
    var $file_name = 'report';
    var $fonts='Comic Sans Ms';
    var $header='#8F9258';

	function __construct()
	{
		parent::__construct();
        $this->load->database();
		$this->load->model('report/Report_model', 'stok');
        $this->lang->load('master/stok');
	}

    var $model_name = 'stok';

	// redirect if needed, otherwise display the user list
	function index()
	{
        $this->data['title'] = $this->title;
        $this->data['main_title'] = $this->module.'';
		$q=$this->stok->get_judul();
		$this->data['tipedokumen']= $q->result();
		$filter['statusisasi']='where/1';
		if($this->session->userdata('webmaster_grup')==10){
			$filter['id']='where/2';
		}
		$this->data['opt_dok']=GetOptAll('report','-Document-',$filter,'title_document');
        $this->data['options_barang'] = options_row($this->model_name,'get_barang','kode','title','-- Pilih Barang --');
        $this->data['options_satuan'] = options_row($this->model_name,'get_satuan','id','title','-- Pilih Satuan --');
        $this->data['options_gudang'] = options_row($this->model_name,'get_gudang','id','title','-- Pilih Gudang --');
        $this->data['options_kurensi'] = options_row($this->model_name,'get_kurensi','id','title','-- Pilih Kurensi --');
		$this->_render_page('report/menu/menu', $this->data);
	}
	function response_cat($id=null){
		//error_reporting(0);
		if($id!=''){
			
			/* $qdep=$this->model_getdata->get_department();
			$data['listdep']=$qdep->result();
			$data['bulan']=$this->model_getdata->namabulan(); */
			$data['document']=GetAll('report',array('id'=>'where/'.$id));
			
			
			if($data['document']->num_rows()>0){
				$this->load->view('report/category/main',$data);
			}
			else{
				echo "Dokumen Tidak Ditemukan";
			}
		}
	}
        
	function stok_history(){
                        $data['autoprint']=FALSE;
			$sd=$this->input->post('start_date');
			$ed=$this->input->post('end_date');
                        
                        
                        $q="SELECT * FROM stok_log WHERE tgl >= '$sd' AND tgl <= '$ed' ";
                        
                        if($this->input->post('barang')){$q.=" AND barang='".$this->input->post('barang')."' ";}
                        if($this->input->post('gudang')){$q.=" AND gudang='".$this->input->post('gudang')."' ";}
                        //echo $this->db->last_query();
			$data['period']=$sd.' / '.$ed;
			$data['kolom']=$this->input->post('kolom');
			$data['q']=$this->db->query($q)->result_array();
                        $data['content']='stok/history';
			$this->load->view('layout/main',$data);

	}

	function inbound(){
			$sd=$this->input->post('start_date');
			$ed=$this->input->post('end_date');

			redirect(base_url()."print/file/index.php?stimulsoft_report_key=inbound.mrt&stimulsoft_client_key=ViewerFx&p1=$sd&p2=$ed",'refresh');
		}

		function outbound(){
			$sd=$this->input->post('start_date');
			$ed=$this->input->post('end_date');

			redirect(base_url()."print/file/index.php?stimulsoft_report_key=outbound.mrt&stimulsoft_client_key=ViewerFx&p1=$sd&p2=$ed",'refresh');
		}
	function purchase_order(){
			$sd=$this->input->post('start_date');
		$ed=$this->input->post('end_date');
		$k=$this->input->post('kontak');
		$b=$this->input->post('barang');
		$p=$this->input->post('ppn');
		if($p == ''){
			redirect(base_url()."print/file/index.php?stimulsoft_report_key=report_po.mrt&stimulsoft_client_key=ViewerFx&p1=$sd&p2=$ed&costumer=$k&barang=$b",'refresh');
		}elseif($p == 1){
			redirect(base_url()."print/file/index.php?stimulsoft_report_key=report_po_not_ppn.mrt&stimulsoft_client_key=ViewerFx&p1=$sd&p2=$ed&costumer=$k&barang=$b",'refresh');
		}else{
			redirect(base_url()."print/file/index.php?stimulsoft_report_key=report_po_ppn.mrt&stimulsoft_client_key=ViewerFx&p1=$sd&p2=$ed&costumer=$k&barang=$b",'refresh');
		}

	}
	function sales_order(){
        $sd=$this->input->post('start_date');
		$ed=$this->input->post('end_date');
		$k=$this->input->post('kontak');
		$b=$this->input->post('barang');
		$p=$this->input->post('ppn');

		redirect(base_url()."print/file/index.php?stimulsoft_report_key=report_so.mrt&stimulsoft_client_key=ViewerFx&p1=$sd&p2=$ed&costumer=$k&barang=$b&ppn=$p",'refresh');
	}
	function neraca(){
                        $data['autoprint']=FALSE;
			$sd=$this->input->post('start_date');
			$ed=$this->input->post('end_date');
                        
			$cr=$this->input->post('kurensi');
			$sp=$this->input->post('customer');
			$barang=$this->input->post('barang');
                        
                        $q="SELECT * FROM sales_order WHERE tanggal_transaksi >= '$sd' AND tanggal_transaksi <= '$ed' ";
                        if($cr){$q.="AND kurensi_id='$cr'";}
                        if($sp){$q.="AND kontak_id='$sp'";}
                        
                        $data['barang']=$barang;
                        
			$data['period']=date('d-m-Y',strtotime($sd)).' s/d '.date('d-m-Y',strtotime($ed));

			$data['kolom']=$this->input->post('kolom');
			$data['q']=$this->db->query($q)->result();
                        $data['content']='finance/neraca';
			$this->load->view('layout/main',$data);
                 // $this->load->view('layout/sales_order',$data);

	}
	function neraca_lajur(){
                        $data['autoprint']=FALSE;
			$sd=$this->input->post('start_date');
			$ed=$this->input->post('end_date');
                        
			$cr=$this->input->post('kurensi');
			$sp=$this->input->post('customer');
			$period=$this->input->post('period');	
                        $barang=$this->input->post('barang');

                        
                        $q="SELECT * FROM sales_order WHERE tanggal_transaksi >= '$sd' AND tanggal_transaksi <= '$ed' ";
                        if($cr){$q.="AND kurensi_id='$cr'";}
                        if($sp){$q.="AND kontak_id='$sp'";}
                        
                        $data['barang']=$barang;
                        
			$data['period']=date('d-m-Y',strtotime($sd)).' s/d '.date('d-m-Y',strtotime($ed));

			$data['kolom']=$this->input->post('kolom');
                        //query akun
                        $akun=GetAll('sv_setup_coa');
                        foreach($akun->result_array() as $akun){
                            $data['sum'][$akun['id']]['debit']=$this->db->query("SELECT SUM(amount) as debit FROM cash_petty WHERE coa='".$akun['id']."' AND SUBSTRING(dates,1,7)='$period' AND save_type='out' ")->row_array();
                            $data['sum'][$akun['id']]['kredit']=$this->db->query("SELECT SUM(amount) as kredit FROM cash_petty WHERE coa='".$akun['id']."' AND SUBSTRING(dates,1,7)='$period' AND save_type='in' ")->row_array();
                            //lastq();
                        }
                        
                        
                        
			$data['q']=$this->db->query($q)->result();
                        $data['content']='finance/neraca_lajur';
			$this->load->view('layout/main',$data);
                 // $this->load->view('layout/sales_order',$data);

	}
	function labarugi(){
                        $data['autoprint']=FALSE;
			$sd=$this->input->post('start_date');
			$ed=$this->input->post('end_date');
                        
			$cr=$this->input->post('kurensi');
			$sp=$this->input->post('customer');
			$barang=$this->input->post('barang');
                        
                        $q="SELECT * FROM sales_order WHERE tanggal_transaksi >= '$sd' AND tanggal_transaksi <= '$ed' ";
                        if($cr){$q.="AND kurensi_id='$cr'";}
                        if($sp){$q.="AND kontak_id='$sp'";}
                        
                        $data['barang']=$barang;
                        
			$data['period']=date('d-m-Y',strtotime($sd)).' s/d '.date('d-m-Y',strtotime($ed));

			$data['kolom']=$this->input->post('kolom');
			$data['q']=$this->db->query($q)->result();
                        $data['content']='finance/labarugi';
			$this->load->view('layout/main',$data);
                 // $this->load->view('layout/sales_order',$data);

	}
	function catatan(){
                        $data['autoprint']=FALSE;
			$sd=$this->input->post('start_date');
			$ed=$this->input->post('end_date');
                        
			$cr=$this->input->post('kurensi');
			$sp=$this->input->post('customer');
			$barang=$this->input->post('barang');
                        
                        $q="SELECT * FROM sales_order WHERE tanggal_transaksi >= '$sd' AND tanggal_transaksi <= '$ed' ";
                        if($cr){$q.="AND kurensi_id='$cr'";}
                        if($sp){$q.="AND kontak_id='$sp'";}
                        
                        $data['barang']=$barang;
                        
			$data['period']=date('d-m-Y',strtotime($sd)).' s/d '.date('d-m-Y',strtotime($ed));

			$data['kolom']=$this->input->post('kolom');
			$data['q']=$this->db->query($q)->result();
                        $data['content']='finance/catatan';
			$this->load->view('layout/main',$data);
                 // $this->load->view('layout/sales_order',$data);

	}
        
	function liststok(){
            error_reporting(E_ALL);
                        $data['autoprint']=FALSE;
			$sd=$this->input->post('start_date');
			$ed=$this->input->post('end_date');
			$data['period']=$sd.' / '.$ed;
			$data['kolom']=$this->input->post('kolom');
			$data['q']=$this->db->query("SELECT * FROM stok ")->result();
                        $data['content']='stok/list';
			$this->load->view('layout/main',$data);
                 // $this->load->view('layout/sales_order',$data);

	}
        
	function listcustomer(){
            /*error_reporting(E_ALL);
                        $data['autoprint']=FALSE;
			$sd=$this->input->post('start_date');
			$ed=$this->input->post('end_date');
			$data['period']=$sd.' / '.$ed;
			$data['kolom']=$this->input->post('kolom');
                            $data['q']=$this->db->query("SELECT * FROM kontak WHERE jenis_id='2'")->result_array();
                        $data['content']='list/customer';
			$this->load->view('layout/main',$data);
                 // $this->load->view('layout/sales_order',$data);*/
		redirect(base_url()."print/file/index.php?stimulsoft_report_key=costumer.mrt&stimulsoft_client_key=ViewerFx",'refresh');

	}
        
	function listsupplier(){
           /* error_reporting(E_ALL);
                        $data['autoprint']=FALSE;
			$sd=$this->input->post('start_date');
			$ed=$this->input->post('end_date');
			$data['period']=$sd.' / '.$ed;
			$data['kolom']=$this->input->post('kolom');
                            $data['q']=$this->db->query("SELECT * FROM kontak WHERE jenis_id='1'")->result_array();
                        $data['content']='list/customer';
			$this->load->view('layout/main',$data);
                 // $this->load->view('layout/sales_order',$data);*/
			redirect(base_url()."print/file/index.php?stimulsoft_report_key=supplier.mrt&stimulsoft_client_key=ViewerFx",'refresh');

	}
}