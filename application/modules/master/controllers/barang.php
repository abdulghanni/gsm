<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends MX_Controller {
    public $data;
    var $module = 'master';
    var $title = 'Barang';
    var $file_name = 'barang';
	function __construct()
	{
		parent::__construct();
        $this->load->database();
        $this->load->model('master/barang_model', 'barang');
		$this->load->model('master/barang_inv_model', 'inv');
        $this->load->library('excel');
        //$this->lang->load('master/barang');
	}

	// redirect if needed, otherwise display the user list
	function index()
	{
        permissionUser();
        $this->data['jenis_barang'] = getAll('jenis_barang');
        $this->data['options_jenis_barang'] = options_row('barang', 'get_jenis_barang','id','title', '-- Pilih Jenis Barang --');
        $this->data['options_jenis_barang_inventaris'] = options_row('barang', 'get_jenis_barang_inventaris','id','title', '-- Pilih Jenis Barang Inventaris--');
        $this->data['options_satuan'] = options_row('barang', 'get_satuan','id','title', '-- Pilih Satuan --');
		$this->_render_page($this->module.'/'.$this->file_name, $this->data);
	}

    public function ajax_list($inv = null)
    {
        permissionUser();
        $list = $this->barang->get_datatables($inv);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $barang) {
            $photo_link = base_url().'uploads/barang/'.$barang->id.'/'.$barang->photo;
            $file_headers = @get_headers($photo_link);
            $photo = $this->data['photo'] = ($file_headers[0] != 'HTTP/1.1 404 Not Found'&&!empty($barang->photo)) ? $photo_link : assets_url('assets/images/no-image-mid.png');
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = "<img height='75px' width='100px' src='$photo' />";
            $row[] = $barang->kode;
            $row[] = $barang->title;
            if(($inv != 0)){
                $row[] = $barang->tgl;
                $row[] = $barang->harga;
                $row[] = $barang->penyusutan;
            }else{
                $row[] = $barang->alias;
                $row[] = $barang->jenis_barang;
                $row[] = $barang->satuan;
            }
            //$row[] = $barang->lokasi_gudang;

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0);" title="Edit" onclick="edit_user('."'".$barang->id."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_user('."'".$barang->id."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->barang->count_all(),
                        "recordsFiltered" => $this->barang->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $data = $this->barang->get_by_id($id); // if 0000-00-00 set tu empty for datepicker compatibility
        $inv = getAll('barang_inventaris_detail', array('barang_id'=>'where/'.$id))->row(); 
		echo json_encode(array('data'=>$data, 'inv'=>$inv));
    }

    public function edit_inv($id)
    {
        $data = $this->inv->get_by_id($id); // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }

	public function loadsatuanexist($id){
		$data['ex']=GetAll('barang_satuan',array('barang_id'=>'where/'.$id))->result_array();
        $data['options_satuan'] = options_row('barang', 'get_satuan','id','title', '-- Pilih Satuan --');
		$this->load->view('barang/satuan_exist',$data);
	}

    public function ajax_add()
    {

        //$this->_validate();
		$satuanlain=$this->input->post('satuan_lain');//print_ag($satuanlain);
		$satuanlain_id=$this->input->post('satuan_lain_id');
		$valuelain=$this->input->post('value_lain');
        $is_update = $this->input->post('is_update');
        $jenis_barang = $this->input->post('jenis_barang_id');
        $data = array(
                'kode' => $this->input->post('kode'),
                'title' => $this->input->post('title'),
                'alias' => $this->input->post('alias'),
                'merk' => $this->input->post('merk'),
                'jenis_barang_id' => $this->input->post('jenis_barang_id'),
                'satuan' => $this->input->post('satuan'),
                'satuan_laporan' => $this->input->post('satuan_laporan'),
                'catatan' => $this->input->post('catatan'),
                'created_by' => sessId(),
                'created_on' => dateNow(),
            );
        $id = $this->input->post('id');

            $data_inv = array(
                        'barang_id' => $id,
                        'jenis_barang_inventaris_id' => $this->input->post('jenis_barang_inventaris_id'),
                        'tgl' => date('Y-m-d',strtotime($this->input->post('tgl'))),
                        'harga' => $this->input->post('harga'),
                        'penyusutan' => $this->input->post('penyusutan')
            );
        if($is_update == 1) {
			$this->barang->update(array('id' => $id), $data);
            
            if($jenis_barang == 3){
                $num = getAll('barang_inventaris_detail', array('barang_id'=>'where/'.$id))->num_rows();
                if($num > 0 )$this->db->where('barang_id', $id)->update('barang_inventaris_detail', $data_inv);else $this->db->insert('barang_inventaris_detail', $data_inv);
            }
            /* $num_satuan_dasar = GetAllSelect('barang_satuan', 'id', array('barang_id'=>'where/'.$id, 'satuan'=>'where/'.$this->input->post('satuan')))->num_rows();
            if($num_satuan_dasar>0):
                $this->db->where('satuan',$this->input->post('satuan'))->where('barang_id', $id);
                $this->db->update('barang_satuan',array('value'=>1,'satuan'=>$this->input->post('satuan')));
            else:
                $this->db->insert('barang_satuan',array('barang_id'=>$id,'value'=>1,'satuan'=>$this->input->post('satuan')));
            endif; */
			$a=0;
            if(!empty($satuanlain)){
    			foreach($satuanlain as $sl){
                    $num_satuan = GetAllSelect('barang_satuan', 'id', array('barang_id'=>'where/'.$id, 'satuan'=>'where/'.$satuanlain[$a]))->num_rows();
                    if(isset($satuanlain_id[$a])):
    				    $this->db->where('id',$satuanlain_id[$a]);
    				    $this->db->update('barang_satuan',array('value'=>$valuelain[$a],'satuan'=>$satuanlain[$a]));
                    else:
    					if(isset($satuanlain[$a])){
                        $this->db->insert('barang_satuan',array('barang_id'=>$id,'value'=>$valuelain[$a],'satuan'=>$satuanlain[$a]));
    					}
                    endif;
    				$a++;
    			}
            }
                
		}
        else{ $id = $this->barang->save($data);
            $data_inv = array(
                        'barang_id' => $id,
                        'jenis_barang_inventaris_id' => $this->input->post('jenis_barang_inventaris_id'),
                        'tgl' => date('Y-m-d',strtotime($this->input->post('tgl'))),
                        'harga' => $this->input->post('harga'),
                        'penyusutan' => $this->input->post('penyusutan')
            );
			$this->db->insert('barang_inventaris_detail', $data_inv);
			$a=0;
                $this->db->insert('barang_satuan',array('barang_id'=>$id,'value'=>1,'satuan'=>$this->input->post('satuan')));
			foreach($satuanlain as $sl){
				if(isset($sl[$a])){
				$this->db->insert('barang_satuan',array('barang_id'=>$id,'value'=>$valuelain[$a],'satuan'=>$satuanlain[$a]));
				}
				$a++;
			}
            
		}
        //$this->upload_attachment($id);
        $this->upload($id);
        $this->cek_stok($id);
		
        //echo json_encode(array("status" => TRUE));
        redirect(base_url('master/barang'), 'refresh');
    }


    public function add_inv()
    {

        //$this->_validate();
        $is_update = $this->input->post('is_update');
        $data = array(
                'kode' => $this->input->post('kode'),
                'title' => $this->input->post('title'),
                'alias' => $this->input->post('alias'),
                'brand' => $this->input->post('brand'),
                'catatan' => $this->input->post('catatan'),
                'jenis_inventaris_id' => $this->input->post('jenis_inventaris_id'),
                'tgl_beli' => date('Y-m-d',strtotime($this->input->post('tgl_beli'))),
                'harga_beli' => str_replace(',', '', $this->input->post('harga_beli')),
                'lokasi' => $this->input->post('lokasi'),
                'akumulasi' => str_replace(',', '', $this->input->post('akumulasi')),
                'beban_tahun_ini' => str_replace(',', '', $this->input->post('beban_tahun_ini')),
                'beban_perbulan' => str_replace(',', '', $this->input->post('beban_perbulan')),
                'nilai_buku' => str_replace(',', '', $this->input->post('nilai_buku')),
               // 'tarif_penyusutan' => str_replace(',', '', $this->input->post('tarif_penyusutan')),
                'umur_ekonomis' => str_replace(',', '', $this->input->post('umur_ekonomis')),
                'nilai_residu' => str_replace(',', '', $this->input->post('nilai_residu')),
                'terhitung_tanggal' => date('Y-m-d',strtotime('last day of last month')),
                'created_by' => sessId(),
                'created_on' => dateNow(),
            );
        $id = $this->input->post('id');

        if($is_update == 1) {
            $this->inv->update(array('id' => $id), $data);   
        }else{ 
            $id = $this->inv->save($data);
        }
        //$this->upload_attachment($id);
        $this->upload($id, 'inv');
        $this->cek_stok($id);
        
        //echo json_encode(array("status" => TRUE));
        redirect(base_url('master/barang'), 'refresh');
    }

    function cek_stok($id)
    {
        $num_rows = GetAllSelect('stok', 'barang_id', array('barang_id'=>'where/'.$id))->num_rows();
        $data = array('barang_id' => $id,
                        'created_by' => sessId(),
                        'created_on' => dateNow(),
                    );
        if($num_rows < 1)$this->db->insert('stok', $data);
        return true;
    }

    /*
    function upload_attachment($id){
        if(!is_dir('./'.'uploads')){
        mkdir('./'.'uploads', 0777);
        }
        if(!is_dir('./uploads/barang/')){
        mkdir('./uploads/barang/', 0777);
        }
        if(!is_dir('./uploads/barang/'.$id)){
        mkdir('./uploads/barang/'.$id, 0777);
        }
        if(!is_dir('./uploads/barang/'.$id.'/attachment')){
        mkdir('./uploads/barang/'.$id.'/attachment', 0777);
        }

        $config =  array(
          'upload_path'     => './uploads/barang/'.$id.'/attachment',
          'allowed_types'   => '*',
          'overwrite'       => TRUE,
        );    
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('attachment')){
            //print_r($this->upload->display_errors());
         }else{
            $upload_data = $this->upload->data();
            $image_name = $upload_data['file_name'];
            $data = array('attachment'=>$image_name);
            $this->db->where('id', $id)->update('barang', $data);
        }
        //print_r($this->db->last_query());
    }
    */
	function hitung_penyusutan(){
		$beli=$_POST['tanggal_beli'];
		$perhitungan=date('Y-m-d',strtotime('last day of last month'));
		$s=strtotime($perhitungan)-strtotime($beli);
		echo floor($s/(30*24*60*60));
	}
    
    function upload($id, $inv = null)
    {
        if(!is_dir('./'.'uploads')){
        mkdir('./'.'uploads', 0777);
        }
        if(!is_dir('./uploads/barang/')){
        mkdir('./uploads/barang/', 0777);
        }
        if(!is_dir('./uploads/barang/'.$id)){
        mkdir('./uploads/barang/'.$id, 0777);
        }

         $this->load->library('image_lib');
         $config['upload_path'] = './uploads/barang/'.$id;
         $config['overwrite']=TRUE;
         $config['allowed_types'] = 'gif|jpg|png|jpeg';
         $config['max_size'] = '2048';
         $this->load->library('upload', $config);

        if (!$this->upload->do_upload('photo')){
            //print_r($this->upload->display_errors());
         }else{
            $upload_data = $this->upload->data();

            //resize:
            $resize1='80x80';
            if(!is_dir('./uploads/barang/'.$id.'/'.$resize1))
            {
                mkdir('./uploads/barang/'.$id.'/'.$resize1, 0777);
            }
            $config = array(
                            'source_image'      => $upload_data['full_path'], //path to the uploaded image
                            'new_image'         => './uploads/barang/'.$id.'/'.$resize1, //path to
                            'maintain_ratio'    => TRUE,
                            'width'             => 80,
                            'height'            => 80
                        );
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
 
            $resize2='100x100';
            if(!is_dir('./uploads/barang/'.$id.'/'.$resize2))
            {
                mkdir('./uploads/barang/'.$id.'/'.$resize2, 0777);
            }
            $config = array(
                            'source_image'      => $upload_data['full_path'], //path to the uploaded image
                            'new_image'         => './uploads/barang/'.$id.'/'.$resize2, //path to
                            'maintain_ratio'    => TRUE,
                            'width'             => 100,
                            'height'            => 100
                        );
            $this->image_lib->initialize($config);
            $this->image_lib->resize();

            $resize3='225x225';
            if(!is_dir('./uploads/barang/'.$id.'/'.$resize3))
            {
            mkdir('./uploads/barang/'.$id.'/'.$resize3, 0777);
            }
            $config = array(
                            'source_image'      => $upload_data['full_path'], //path to the uploaded image
                            'new_image'         => './uploads/barang/'.$id.'/'.$resize3,
                            'maintain_ratio'    => TRUE,
                            'width'             => 225,
                            'height'            => 225
                        );
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
        }
                                                      
        if(!$this->upload->do_upload('photo'))
        {
           //print_r($this->upload->display_errors());
        }else{
            $image_name = $upload_data['file_name'];
            $data = array('photo'=>$image_name);
            //$targetPath = base_url().'uploads/'.$id.'/'.$image_name;
            //echo "<img src='$targetPath' width='100px' height='100px' />";
            if($inv == 'inv'){
                $this->db->where('id', $id)->update('barang_inventaris', $data);
            }else{
                $this->db->where('id', $id)->update('barang', $data);
            }
        }
    }

    public function ajax_update()
    {
		$satuanlain_id=$this->input->post('satuan_lain_id');
		$satuanlain=$this->input->post('satuan_lain');
		$valuelain=$this->input->post('value_lain');
        //$this->_validate();
        $data = array(
                'kode' => $this->input->post('kode'),
                'title' => $this->input->post('title'),
                'jenis_barang_id' => $this->input->post('jenis_barang_id'),
                'satuan' => $this->input->post('satuan'),
            );
        $this->barang->update(array('id' => $this->input->post('id')), $data);
		$a=0;
		foreach($satuanlain as $sl){
				$this->db->where('id',$satuanlain_id[$a]);
			$this->db->update('barang_satuan',array('value'=>$valuelain[$a],'satuan'=>$satuanlain[$a]));
			$a++;
		}
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->barang->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    public function delete_inv($id)
    {
        $this->inv->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }


    function pdf(){
        permissionUser();
        $this->data['data'] = $this->barang->get_barang();
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
    $this->mpdf->Output('Master Barang'.'.pdf', 'I');
    }

    public function upload_excel(){

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xlsx|xls';
       
        $this->load->library('upload', $config);
        
        if ( ! $this->upload->do_upload()){
            //$error = array('error' => $this->upload->display_errors());
            echo 'Terjadi Kesalahan, silakan kembali kehalaman sebelumnya';
        }
        else{
            $data = array('upload_data' => $this->upload->data());
            $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
            $filename = $upload_data['file_name'];
            $this->barang->upload_data($filename);
            unlink('./uploads/'.$filename);
            $this->session->set_flashdata('message', 'Upload Data Selesai');
            redirect('master/barang','refresh');
        }
    }

    function excel()
    {
    //load our new PHPExcel library
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Master Barang');


        $this->excel->getActiveSheet()->mergeCells('A1:G6');
        //$this->excel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('Logo');
        $objDrawing->setDescription('Logo');
        $objDrawing->setPath('D:/logo-po.jpg');
        $objDrawing->setCoordinates('C1');
        $objDrawing->setOffsetX(150);
        $objDrawing->setHeight(108);
        $objDrawing->setWidth(637);

        $objDrawing->setWorksheet($this->excel->getActiveSheet());

        //$this->excel->getActiveSheet()->setCellValue('C1', 'PT Gramaselindo');

         $this->excel->getActiveSheet()->setCellValue('A7', 'No');
         $this->excel->getActiveSheet()->setCellValue('B7', 'Kode');
         $this->excel->getActiveSheet()->setCellValue('C7', 'Deskripsi');
         $this->excel->getActiveSheet()->setCellValue('D7', 'Alias');
         $this->excel->getActiveSheet()->setCellValue('E7', 'Jenis Barang');
         $this->excel->getActiveSheet()->setCellValue('F7', 'Satuan Dasar');
         $this->excel->getActiveSheet()->setCellValue('G7', 'Satuan Laporan');


        for($col = ord('A'); $col <= ord('F'); $col++){
            //set column dimension
            $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(false);
             //change the font size
            $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
        }

        $this->excel->getActiveSheet()->getStyle(chr(ord('A')))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle(chr(ord('B')))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle(chr(ord('C')))->getAlignment()->setWrapText(true);;
        $this->excel->getActiveSheet()->getStyle(chr(ord('D')))->getAlignment()->setWrapText(true);;
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(75);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);

        $rs = $this->barang->get_barang();//print_//mz($rs);
                $exceldata="";
        foreach ($rs as $row){
                $exceldata[] = $row;
        }
                //Fill data 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A8');
                 
                $this->excel->getActiveSheet()->getStyle('A7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('B7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('C7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $filename='Master Barang.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
                    
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }

    //JS  FUNCTION

    function get_satuan()
    {
        $this->data['options_satuan'] = options_row('barang', 'get_satuan','id','title', '-- Pilih Satuan --');
        $this->load->view("master/barang/satuan", $this->data);
    }

    function get_satuan_title($id)
    {
        $t = getValue('title', 'satuan', array('id'=>'where/'.$id));
        echo json_encode(array("value"=>$t));
    }
    
	function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

                if(in_array($view, array($this->module.'/'.$this->file_name)))
                {
                    $this->template->set_layout('default');

                    $this->template->add_css('vendor/DataTables/css/DT_bootstrap.css');
                    $this->template->add_css('vendor/select2/select2.css');
                    $this->template->add_css('vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css');

                    $this->template->add_js('vendor/jquery-validation/jquery.validate.min.js');
                    $this->template->add_js('assets/js/form-validation.js');
                    $this->template->add_css('vendor/bootstrap-fileinput/jasny-bootstrap.min.css');
                    $this->template->add_js('vendor/bootstrap-fileinput/jasny-bootstrap.js');
                    $this->template->add_js('vendor/DataTables/js/jquery.dataTables.min.js');
                    $this->template->add_js('vendor/select2/select2.min.js');
                    $this->template->add_js('vendor/bootstrap-datepicker/bootstrap-datepicker.min.js');
                    $this->template->add_js('assets/js/'.$this->module.'/'.$this->file_name.'.js');
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

    function upload_barang(){
               $file = fopen('D:\barang.csv', "r");

        $count = 0;
        /*satuan :
        Pcs
        M
        roll=300m
        roll
        pack
        set
        */

        while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
        {
            $count++; 
            if($count>7){

                switch ($emapData[5]) {
                    case 'PCS':
                        $satuan = 1;
                        break;
                    case 'ROLL':
                        $satuan = 2;
                        break;
                    case 'roll=300m':
                        $satuan = 3;
                        break;
                    case 'METER':
                        $satuan = 4;
                        break;
                    case 'PACK':
                        $satuan = 5;
                        break;
                    case 'SET':
                        $satuan = 6;
                        break;
                    
                    default:
                        $satuan = 1;
                        break;
                }

                if($emapData[4] == 'BARANG INVENTARIS'){
                    $jenis = 3;
                }elseif($emapData[4] == 'BARANG MENTAH'){
                    $jenis = 2;
                }else{
                    $jenis = 1;
                }
                $data = array(
                    'kode'=>$emapData[1],
                    'title' => $emapData[2],
                    'satuan' => $satuan,
                    'jenis_barang_id'=>$jenis,
                    'created_by'=>1,
                    'created_on'=>dateNow(),
                );
                $cek = getAll('barang', array('kode'=>'where/'.$emapData[1]))->num_rows();

                if($cek<1)$this->db->insert('barang', $data);else $this->db->where('kode', $emapData[1])->update('barang', $data);
                echo '<pre>';
                echo $count.'-'.$this->db->last_query();
                echo '</pre>';
            }                           
        }
    }

    function upload_barang2(){
               $file = fopen('D:\barang.csv', "r");

        $count = 0;
        /*satuan :
        Pcs
        M
        roll=300m
        roll
        pack
        set
        */

        while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
        {
            $count++; 
            if($count>0){

                switch ($emapData[6]) {
                    case 'PCS':
                        $satuan = 1;
                        break;
                    case 'ROLL':
                        $satuan = 2;
                        break;
                    case 'roll=300m':
                        $satuan = 3;
                        break;
                    case 'METER':
                        $satuan = 4;
                        break;
                    case 'PACK':
                        $satuan = 5;
                        break;
                    case 'SET':
                        $satuan = 6;
                        break;
                    
                    default:
                        $satuan = 1;
                        break;
                }

                if($emapData[5] == 'Barang Inventaris'){
                    $jenis = 3;
                }elseif($emapData[5] == 'Barang Mentah'){
                    $jenis = 2;
                }else{
                    $jenis = 1;
                }
                $data = array(
                    'kode'=>$emapData[1],
                    'merk'=>$emapData[2],
                    'title' => $emapData[3],
                    'satuan' => 1,
                    'jenis_barang_id'=>$jenis,
                    'created_by'=>1,
                    'created_on'=>dateNow(),
                );
                $cek = getAll('barang', array('kode'=>'where/'.$emapData[1]))->num_rows();

                if($cek<1)$this->db->insert('barang', $data);else $this->db->where('kode', $emapData[1])->update('barang', $data);
                echo '<pre>';
                echo $count.'-'.$this->db->last_query();
                echo '</pre>';
                $barang_id= getValue('id', 'barang', array('kode'=>'where/'.$emapData[1]));
                $num = getAll('stok', array('barang_id'=>'where/'.$barang_id))->num_rows;
                if($num<1)$this->db->insert('stok', array('barang_id'=>$barang_id));
                echo '<pre>';
                echo $count.'-'.$this->db->last_query();
                echo '</pre>';
            }                           
        }
    }

    public function list_inv()
    {
        permissionUser();
        $list = $this->inv->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $photo_link = base_url().'uploads/barang/'.$r->id.'/'.$r->photo;
            $file_headers = @get_headers($photo_link);
            $photo = $this->data['photo'] = ($file_headers[0] != 'HTTP/1.1 404 Not Found'&&!empty($r->photo)) ? $photo_link : assets_url('assets/images/no-image-mid.png');
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = "<img height='75px' width='100px' src='$photo' />";
            $row[] = $r->kode;
            $row[] = $r->title;
            $row[] = $r->jenis_inventaris;
            $row[] = $r->harga_beli;
            $row[] = $r->umur_ekonomis;
            $row[] = $r->akumulasi;
            $row[] = $r->beban_perbulan;
            $row[] = $r->nilai_buku;

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0);" title="Edit" onclick="edit_inv('."'".$r->id."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_inv('."'".$r->id."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->inv->count_all(),
                        "recordsFiltered" => $this->inv->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
}