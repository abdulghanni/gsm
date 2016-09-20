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
		$this->data['opt_dok']         = GetOptAll('report','-Document-',$filter,'title_document');
		$this->data['options_barang']  = options_row($this->model_name,'get_barang','kode','title','-- Pilih Barang --');
		$this->data['options_satuan']  = options_row($this->model_name,'get_satuan','id','title','-- Pilih Satuan --');
		$this->data['options_gudang']  = options_row($this->model_name,'get_gudang','id','title','-- Pilih Gudang --');
		$this->data['options_kurensi'] = options_row($this->model_name,'get_kurensi','id','title','-- Pilih Kurensi --');
		$this->_render_page('report/menu/menu', $this->data);
	}

	function response_cat($id=null){
		if($id!=''){
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
        $sd=$this->input->post('start_date');
		$ed=$this->input->post('end_date');
		$k=$this->input->post('kontak');
		$b=$this->input->post('barang');
		$g=$this->input->post('gudang');

		redirect(base_url()."print/file/index.php?stimulsoft_report_key=stok_log.mrt&stimulsoft_client_key=ViewerFx&p1=$sd&p2=$ed&supplier=$k&barang=$b&gudang=$g",'refresh');
	}

	function inbound(){
		$sd=$this->input->post('start_date');
		$ed=$this->input->post('end_date');
		$k=$this->input->post('kontak');
		$b=$this->input->post('barang');
		$st=$this->input->post('status');
		$g=$this->input->post('gudang');

		redirect(base_url()."print/file/index.php?stimulsoft_report_key=inbound.mrt&stimulsoft_client_key=ViewerFx&p1=$sd&p2=$ed&supplier=$k&barang=$b&status=$st&gudang=$g",'refresh');
	}

	function outbound(){
		$sd=$this->input->post('start_date');
		$ed=$this->input->post('end_date');
		$k=$this->input->post('kontak');
		$b=$this->input->post('barang');
		$st=$this->input->post('status');
		$g=$this->input->post('gudang');

		redirect(base_url()."print/file/index.php?stimulsoft_report_key=outbound.mrt&stimulsoft_client_key=ViewerFx&p1=$sd&p2=$ed&costumer=$k&barang=$b&status=$st&gudang=$g",'refresh');
	}

	function purchase_order(){
		$sd=$this->input->post('start_date');
		$ed=$this->input->post('end_date');
		$k=$this->input->post('kontak');
		$b=$this->input->post('barang');
		$p=$this->input->post('ppn');
		$kur=$this->input->post('kurensi');
		$g=$this->input->post('gudang');
		if($p == ''){
			redirect(base_url()."print/file/index.php?stimulsoft_report_key=report_po.mrt&stimulsoft_client_key=ViewerFx&p1=$sd&p2=$ed&supplier=$k&barang=$b&kurensi=$kur&gudang=$g",'refresh');
		}elseif($p == 1){
			redirect(base_url()."print/file/index.php?stimulsoft_report_key=report_po_not_ppn.mrt&stimulsoft_client_key=ViewerFx&p1=$sd&p2=$ed&supplier=$k&barang=$b&kurensi=$kur&gudang=$g",'refresh');
		}else{
			redirect(base_url()."print/file/index.php?stimulsoft_report_key=report_po_ppn.mrt&stimulsoft_client_key=ViewerFx&p1=$sd&p2=$ed&supplier=$k&barang=$b&kurensi=$kur&gudang=$g",'refresh');
		}

	}

	function sales_order(){
        $sd=$this->input->post('start_date');
		$ed=$this->input->post('end_date');
		$k=$this->input->post('kontak');
		$b=$this->input->post('barang');
		$p=$this->input->post('ppn');
		$kur=$this->input->post('kurensi');
		$st=$this->input->post('status');
		$g=$this->input->post('gudang');

		redirect(base_url()."print/file/index.php?stimulsoft_report_key=report_so.mrt&stimulsoft_client_key=ViewerFx&p1=$sd&p2=$ed&costumer=$k&barang=$b&ppn=$p&kurensi=$kur&status=$st&gudang=$g",'refresh');
	}

	function hutang_list(){
        $sd=$this->input->post('start_date');
		$ed=$this->input->post('end_date');
		$k=$this->input->post('kontak');
		$kur=$this->input->post('kurensi');
		$st=$this->input->post('status');

		redirect(base_url()."print/file/index.php?stimulsoft_report_key=hutang_list.mrt&stimulsoft_client_key=ViewerFx&p1=$sd&p2=$ed&kontak=$k&kurensi=$kur&status=$st",'refresh');
	}

	function piutang_list(){
        $sd=$this->input->post('start_date');
		$ed=$this->input->post('end_date');
		$k=$this->input->post('kontak');
		$kur=$this->input->post('kurensi');
		$st=$this->input->post('status');

		redirect(base_url()."print/file/index.php?stimulsoft_report_key=piutang_list.mrt&stimulsoft_client_key=ViewerFx&p1=$sd&p2=$ed&kontak=$k&kurensi=$kur&status=$st",'refresh');
	}

	function pembayaran_hutang(){
        $sd=$this->input->post('start_date');
		$ed=$this->input->post('end_date');
		$k=$this->input->post('kontak');
		$kur=$this->input->post('kurensi');
		$st=$this->input->post('coa');

		redirect(base_url()."print/file/index.php?stimulsoft_report_key=pembayaran_hutang.mrt&stimulsoft_client_key=ViewerFx&p1=$sd&p2=$ed&kontak=$k&kurensi=$kur&coa=$st",'refresh');
	}

	function pembayaran_piutang(){
        $sd=$this->input->post('start_date');
		$ed=$this->input->post('end_date');
		$k=$this->input->post('kontak');
		$kur=$this->input->post('kurensi');
		$st=$this->input->post('coa');

		redirect(base_url()."print/file/index.php?stimulsoft_report_key=pembayaran_piutang.mrt&stimulsoft_client_key=ViewerFx&p1=$sd&p2=$ed&kontak=$k&kurensi=$kur&coa=$st",'refresh');
	}


	function penjualan(){
        $sd=$this->input->post('start_date');
		$ed=$this->input->post('end_date');
		$k=$this->input->post('kontak');
		$kur=$this->input->post('kurensi');

		redirect(base_url()."print/file/index.php?stimulsoft_report_key=report_invoice.mrt&stimulsoft_client_key=ViewerFx&p1=$sd&p2=$ed&costumer=$k&kurensi=$kur",'refresh');
	}

	function penjualan_perbarang(){
        $sd=$this->input->post('start_date');
		$ed=$this->input->post('end_date');
		$k=$this->input->post('kontak');
		$kur=$this->input->post('kurensi');
		$b=$this->input->post('barang');

		redirect(base_url()."print/file/index.php?stimulsoft_report_key=report_invoice_perbarang.mrt&stimulsoft_client_key=ViewerFx&p1=$sd&p2=$ed&costumer=$k&kurensi=$kur&barang=$b",'refresh');
	}

	function produksi(){
        $sd=$this->input->post('start_date');
		$ed=$this->input->post('end_date');
		$k=$this->input->post('kontak');
		$s=$this->input->post('status');

		redirect(base_url()."print/file/index.php?stimulsoft_report_key=produksi.mrt&stimulsoft_client_key=ViewerFx&p1=$sd&p2=$ed&costumer=$k&status=$s",'refresh');
	}

	function displacement(){
        $sd=$this->input->post('start_date');
		$ed=$this->input->post('end_date');
		$g=$this->input->post('gudang');
		$b=$this->input->post('barang');

		redirect(base_url()."print/file/index.php?stimulsoft_report_key=displacement.mrt&stimulsoft_client_key=ViewerFx&p1=$sd&p2=$ed&gudang=$g&barang=$b",'refresh');
	}

	function pajak_masukan(){
         $sd=$this->input->post('start_date');
		$ed=$this->input->post('end_date');
		$k=$this->input->post('kontak');
		$kur=$this->input->post('kurensi');

		redirect(base_url()."print/file/index.php?stimulsoft_report_key=pajak_masukan.mrt&stimulsoft_client_key=ViewerFx&p1=$sd&p2=$ed&costumer=$k&kurensi=$kur",'refresh');
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

	}

	function neraca_lajur($type='neraca_lajur'){
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
                            //$data['sum'][$akun['id']]['debit']=$this->db->query("SELECT SUM(amount) as debit FROM cash_petty WHERE coa='".$akun['id']."' AND SUBSTRING(dates,1,7)='$period' AND save_type='out' ")->row_array();
                           //$data['sum'][$akun['id']]['debit']=$this->db->query("SELECT SUM(amount) as debit FROM cash_log WHERE coa='".$akun['id']."' AND dates>='$sd' AND dates<='$ed' AND save_type='out' ")->row_array();

                            //lastq();
                            //$data['sum'][$akun['id']]['kredit']=$this->db->query("SELECT SUM(amount) as kredit FROM cash_log WHERE coa='".$akun['id']."' AND dates>='$sd' AND dates<='$ed' AND save_type='in' ")->row_array();
                            //lastq();
                            $data['sum'][$akun['id']]=$this->db->query("SELECT SUM(kredit) as kredit, SUM(debit) as debit FROM cash_log WHERE coa='".$akun['id']."' AND created_on>='$sd' AND created_on<='$ed' ")->row_array();
                        }
            $data['ref_coa']=GetAll('sv_ref_coa')->result_array();            
             $data['type']=$type;
                        
             
			$data['q']=$this->db->query($q)->result();
                        $data['content']='finance/neraca_lajur';
                        
                        
                 $this->load->library('Excel');
			
			
			//GENERATE XLSX
  //echo getcwd();
						
                        $excel2 = PHPExcel_IOFactory::createReader('Excel2007');
						$excel2 = $excel2->load(getcwd().'\uploads\xls\neraca.xlsx'); // Empty Sheet
						$excel2->setActiveSheetIndex(0);
						
						
						$totaldebitneraca=$totalkreditneraca=$totalnsddebit=$totalnsdkredit=$totallrdebit=$totallrkredit=0;
							
						$a=3;
						 foreach($data['ref_coa'] as $ref){
								
						 $excel2->getActiveSheet()->setCellValue('A'.$a, $ref['code']);
						 $excel2->getActiveSheet()->setCellValue('B'.$a, $ref['name']);
						 $a++;
								$subklas=$this->db->query("SELECT * FROM sv_setup_coa WHERE SUBSTRING(code,1,1)='".$ref['id']."' ORDER BY code ASC")->result_array();
								foreach($subklas as $sk){
								if(substr($sk['code'],0,1)=='1'||substr($sk['code'],0,1)=='2'||substr($sk['code'],0,1)=='3'){
									$neracakredit=(isset($data['sum'][$sk['id']]['kredit']) ?$data['sum'][$sk['id']]['kredit']:'');
									$neracadebit=(isset($data['sum'][$sk['id']]['debit'])? $data['sum'][$sk['id']]['debit']:'');
									$lrkredit='';
									$lrdebit='';
								}else{
									$neracakredit='';
									$neracadebit='';
									$lrkredit=(isset($data['sum'][$sk['id']]['kredit']) ?$data['sum'][$sk['id']]['kredit']:'');
									$lrdebit=(isset($data['sum'][$sk['id']]['debit'])? $data['sum'][$sk['id']]['debit']:'');
								}
									$nsddebit=(isset($data['sum'][$sk['id']]['debit'])? $data['sum'][$sk['id']]['debit']:'');
									$nsdkredit=(isset($data['sum'][$sk['id']]['kredit']) ?$data['sum'][$sk['id']]['kredit']:'');
									
									
						 $excel2->getActiveSheet()->setCellValue('B'.$a, $sk['code']);
						 $excel2->getActiveSheet()->setCellValue('C'.$a, $sk['name']);
						 $excel2->getActiveSheet()->setCellValue('D'.$a, $sk['type']);
						 $excel2->getActiveSheet()->setCellValue('E'.$a, $nsddebit);
						 $excel2->getActiveSheet()->setCellValue('F'.$a, $nsdkredit);
						 $excel2->getActiveSheet()->setCellValue('G'.$a, $lrdebit);
						 $excel2->getActiveSheet()->setCellValue('H'.$a, $lrkredit);
						 $excel2->getActiveSheet()->setCellValue('I'.$a,  $neracadebit);
						 $excel2->getActiveSheet()->setCellValue('J'.$a, $neracakredit);
						 $a++;
								
										$totalnsddebit+=$nsddebit;
										$totalnsdkredit+=$nsdkredit;
	
										$totallrdebit+=$lrdebit;
										$totallrkredit+=$lrkredit;
			
										$totaldebitneraca+=$neracadebit;
										$totalkreditneraca+=$neracakredit;
								}
						 
						 }
									$selisihnsd=$totalnsddebit-$totalnsdkredit;
									$selisihlr=$totallrdebit-$totallrkredit;
									$selisihneraca=$totalkreditneraca-$totaldebitneraca;
									
						 $a++;
						 $excel2->getActiveSheet()->setCellValue('E'.$a, $totalnsddebit);
						 $excel2->getActiveSheet()->setCellValue('F'.$a, $totalnsdkredit);
						 $excel2->getActiveSheet()->setCellValue('G'.$a, $totallrdebit);
						 $excel2->getActiveSheet()->setCellValue('H'.$a, $totallrkredit);
						 $excel2->getActiveSheet()->setCellValue('I'.$a,  $totaldebitneraca);
						 $excel2->getActiveSheet()->setCellValue('J'.$a, $totaldebitneraca);
						 $a++;
						
						 $excel2->getActiveSheet()->setCellValue('F'.$a, $selisihnsd);
						 $excel2->getActiveSheet()->setCellValue('G'.$a, $selisihlr);
						 $excel2->getActiveSheet()->setCellValue('J'.$a, $selisihneraca);			
						 $a++;
						 
						 $excel2->getActiveSheet()->setCellValue('E'.$a, $totalnsddebit);
						 $excel2->getActiveSheet()->setCellValue('F'.$a, $totalnsdkredit-$selisihnsd);
						 $excel2->getActiveSheet()->setCellValue('G'.$a, $totallrdebit-$selisihlr);
						 $excel2->getActiveSheet()->setCellValue('H'.$a, $totallrkredit);
						 $excel2->getActiveSheet()->setCellValue('I'.$a,  $totaldebitneraca);
						 $excel2->getActiveSheet()->setCellValue('J'.$a, $totalkreditneraca-$selisihneraca);
						 $a++;
						 $a++;
						 $excel2->getActiveSheet()->setCellValue('E'.$a, 'BUNGA');
						 $excel2->getActiveSheet()->setCellValue('F'.$a, 'PAJAK');
						 $a++;
						 $excel2->getActiveSheet()->setCellValue('C'.$a, 'MANDIRI TAB');
						 $excel2->getActiveSheet()->setCellValue('E'.$a, 0);
						 $excel2->getActiveSheet()->setCellValue('F'.$a, 0);
						 $excel2->getActiveSheet()->setCellValue('G'.$a, 0); 
						 $a++;
						 $excel2->getActiveSheet()->setCellValue('C'.$a, 'MANDIRI GIRO');
						 $excel2->getActiveSheet()->setCellValue('E'.$a, 0);
						 $excel2->getActiveSheet()->setCellValue('F'.$a, 0);
						 $excel2->getActiveSheet()->setCellValue('G'.$a, 0); 
						 $a++;
						 $excel2->getActiveSheet()->setCellValue('C'.$a, 'CIMB USD');
						 $excel2->getActiveSheet()->setCellValue('E'.$a, 0);
						 $excel2->getActiveSheet()->setCellValue('F'.$a, 0);
						 $excel2->getActiveSheet()->setCellValue('G'.$a, 0); 
						 $a++;
						 $excel2->getActiveSheet()->setCellValue('E'.$a, 0);
						 $excel2->getActiveSheet()->setCellValue('F'.$a, 0);
						 $excel2->getActiveSheet()->setCellValue('G'.$a, 0); 
									/*
									
    <td align="right"><?php echo uang($totalnsddebit) ?><!--NSD debit--></td>
    <td align="right"><?php echo uang($totalnsdkredit-$selisihnsd) ?><!--NSD kredit - Selisih NSD--></td>
    <td align="right"><?php echo uang($totallrdebit-$selisihlr) ?><!-- Laba Rugi debit - Selisih LR --></td>
    <td align="right"><?php echo uang($totallrkredit) ?><!-- Laba Rugi kredit--></td>
    <td align="right"><?php echo uang($totaldebitneraca) ?><!--Neraca debit--></td>
    <td align="right"><?php echo uang($totalkreditneraca-$selisihneraca) ?><!-- Neraca Kredit - Selisih Neraca--></td>
									*/

						$objWriter = PHPExcel_IOFactory::createWriter($excel2, 'Excel2007');
						header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

// It will be called file.xls
						header('Content-Disposition: attachment; filename="neraca.xlsx"');

// Write file to the browser
						$objWriter->save('php://output'); 
//$objWriter->save('Nimit New.xlsx');
                        
                        
                        
                        
                        
                        
			//$this->load->view('layout/main',$data);
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
	}

	function aktiva(){
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
			$data['kantor']=$this->db->query("SELECT * FROM barang_inventaris WHERE jenis_inventaris_id='1'")->result_array();
			$data['kendaraan']=$this->db->query("SELECT * FROM barang_inventaris WHERE jenis_inventaris_id='3'")->result_array();
			$data['gedung']=$this->db->query("SELECT * FROM barang_inventaris WHERE jenis_inventaris_id='2'")->result_array();
                        $data['content']='finance/aktiva';
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
	}
        
	function liststok(){
		$b=$this->input->post('barang');
		$g=$this->input->post('gudang');
		$gt = $this->input->post('gt0');
		$jb = $this->input->post('jenis_barang');

		redirect(base_url()."print/file/index.php?stimulsoft_report_key=stok_full.mrt&stimulsoft_client_key=ViewerFx&barang=$b&gudang=$g&jenis_barang=$jb&gt0=$gt",'refresh');

	}

	function liststok_logistik(){
		$b=$this->input->post('barang');
		$g=$this->input->post('gudang');
		$gt = $this->input->post('gt0');
		redirect(base_url()."print/file/index.php?stimulsoft_report_key=stok_logistik.mrt&stimulsoft_client_key=ViewerFx&barang=$b&gudang=$g&gt0=$gt",'refresh');

	}
        
	function listcustomer(){
		redirect(base_url()."print/file/index.php?stimulsoft_report_key=costumer.mrt&stimulsoft_client_key=ViewerFx",'refresh');
	}
        
	function listsupplier(){
		redirect(base_url()."print/file/index.php?stimulsoft_report_key=supplier.mrt&stimulsoft_client_key=ViewerFx",'refresh');
	}
}