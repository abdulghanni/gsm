<?php defined('BASEPATH') OR exit('No direct script access allowed');

class kontak extends MX_Controller {
    public $data;
    var $module = 'master';
    var $title = 'Kontak';
    var $file_name = 'kontak';

	function __construct()
	{
		parent::__construct();
        $this->load->database();
		$this->load->model($this->module.'/'.$this->file_name.'_model', 'main');
	}

	function index()
	{
        permissionUser();
        $this->data['title'] = $this->title;
        $this->data['file_name'] = $this->file_name;
        $this->data['module'] = $this->module;
		$this->_render_page($this->module.'/'.$this->file_name, $this->data);
	}

    public function ajax_list()
    {
        permissionUser();
        $list = $this->main->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->kode;
            $row[] = $r->title;
            $row[] = $r->jenis;
            $row[] = $r->tipe;
            $row[] = $r->telepon;


            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0);" title="Detail" onclick="detail_user('."'".$r->id."'".')"><i class="fa fa-info"></i></a>
                      <a class="btn btn-sm btn-primary" href="javascript:void(0);" title="Edit" onclick="edit_user('."'".$r->id."'".')"><i class="fa fa-pencil"></i></a>
                      <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_user('."'".$r->id."'".')"><i class="fa fa-trash"></i></a>';
        
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

    function add()
    {
        $this->data['title'] = 'Tambah '.$this->title;
        $this->data['file_name'] = $this->file_name;
        $this->data['module'] = $this->module;
        permissionUser();
        $filter = array('is_deleted'=>0);
        $this->data['jenis'] = getAll('kontak_jenis', $filter);
        $this->data['tipe'] = getAll('kontak_tipe', $filter);
        $this->_render_page($this->module.'/'.$this->file_name.'/add', $this->data);
    }

    function edit($id)
    {
        $this->data['title'] = 'Edit '.$this->title;
        $this->data['file_name'] = $this->file_name;
        $this->data['module'] = $this->module;
        permissionUser();
        $filter = array('is_deleted'=>0);
        $this->data['jenis'] = getAll('kontak_jenis', $filter);
        $this->data['tipe'] = getAll('kontak_tipe', $filter);
        $this->data['r'] = $r = $this->main->get_detail($id);
        $this->data['up'] = explode(',', $r->up);//print_mz($this->data['up']);
        $this->data['telepon'] = explode(',', $r->telepon);
        $this->data['alamat'] = explode(',', $r->alamat);
        $this->_render_page($this->module.'/'.$this->file_name.'/edit', $this->data);
    }

    public function ajax_edit($id)
    {
        $data = $this->main->get_by_id($id); // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }

    public function ajax_add()
    {
        permissionUser();
        $data = array(
                'kode' => $this->input->post('kode'),
                'title' => $this->input->post('title'),
                'jenis_id' => $this->input->post('jenis_id'),
                'tipe_id' => $this->input->post('tipe_id'),
                'up' => implode(',', $this->input->post('up')),
                'telepon' => implode(',', $this->input->post('telepon')),
                'alamat' => implode(',', $this->input->post('alamat')),
                'email' => $this->input->post('email'),
                'fax' => $this->input->post('fax'),
                'catatan' => $this->input->post('catatan'),
                'npwp'=>$this->input->post('npwp'),
                'no_rekening'=>$this->input->post('no_rekening'),
                'bank'=>$this->input->post('bank'),
                'a_n'=>$this->input->post('a_n'),
                'alamat_pajak'=>$this->input->post('alamat_pajak'),
                'acc'=>$this->input->post('acc'),
                'created_by' => sessId(),
                'created_on' => dateNow(),
            );
        $insert = $this->main->save($data);
        redirect(base_url().$this->module.'/'.$this->file_name, 'refresh');
        //echo json_encode(array("status" => TRUE));
    }

    public function ajax_update()
    {
        $data = array(
                'kode' => $this->input->post('kode'),
                'title' => $this->input->post('title'),
                'jenis_id' => $this->input->post('jenis_id'),
                'tipe_id' => $this->input->post('tipe_id'),
                'up' => implode(',', $this->input->post('up')),
                'telepon' => implode(',', $this->input->post('telepon')),
                'alamat' => implode(',', $this->input->post('alamat')),
                'email' => $this->input->post('email'),
                'fax' => $this->input->post('fax'),
                'catatan' => $this->input->post('catatan'),
                'npwp'=>$this->input->post('npwp'),
                'no_rekening'=>$this->input->post('no_rekening'),
                'bank'=>$this->input->post('bank'),
                'a_n'=>$this->input->post('a_n'),
                'alamat_pajak'=>$this->input->post('alamat_pajak'),
                'acc'=>$this->input->post('acc'),
                'edited_by' => sessId(),
                'edited_on' => dateNow(),
            );
        $this->main->update(array('id' => $this->input->post('id')), $data);
         redirect(base_url().$this->module.'/'.$this->file_name, 'refresh');
        //echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->main->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    function pdf(){
        permissionUser();
        $this->data['data'] = $this->main->get_kontak();//print_mz($this->data['data']);
        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view($this->module.'/'.$this->file_name.'/pdf', $this->data, true); 
        $this->mpdf = new mPDF();
        $this->mpdf->AddPage('l', // L - landscape, P - portrait
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

    function excel()
    {
    //load our new PHPExcel library
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Master Kontak');


        $this->excel->getActiveSheet()->mergeCells('A1:Q6');
        //$this->excel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('Logo');
        $objDrawing->setDescription('Logo');
        $objDrawing->setPath('D:/logo-po.jpg');
        $objDrawing->setCoordinates('D1');
        $objDrawing->setOffsetX(150);
        $objDrawing->setHeight(108);
        $objDrawing->setWidth(637);

        $objDrawing->setWorksheet($this->excel->getActiveSheet());

        //$this->excel->getActiveSheet()->setCellValue('C1', 'PT Gramaselindo');

         $this->excel->getActiveSheet()->setCellValue('A7', 'No');
         $this->excel->getActiveSheet()->setCellValue('B7', 'Kode');
         $this->excel->getActiveSheet()->setCellValue('C7', 'Nama');
         $this->excel->getActiveSheet()->setCellValue('D7', 'Tipe');
         $this->excel->getActiveSheet()->setCellValue('E7', 'Jenis');
         $this->excel->getActiveSheet()->setCellValue('F7', 'Up');
         $this->excel->getActiveSheet()->setCellValue('G7', 'Catatan');
         $this->excel->getActiveSheet()->setCellValue('H7', 'Email');
         $this->excel->getActiveSheet()->setCellValue('I7', 'Fax');
         $this->excel->getActiveSheet()->setCellValue('J7', 'Telepon');
         $this->excel->getActiveSheet()->setCellValue('K7', 'Alamat');
         $this->excel->getActiveSheet()->setCellValue('L7', 'NPWP');
         $this->excel->getActiveSheet()->setCellValue('M7', 'No. Rek');
         $this->excel->getActiveSheet()->setCellValue('N7', 'Nama Bank');
         $this->excel->getActiveSheet()->setCellValue('O7', 'Atas Nama');
         $this->excel->getActiveSheet()->setCellValue('P7', 'Alamat Pajak');
         $this->excel->getActiveSheet()->setCellValue('Q7', 'ACC');


        for($col = ord('A'); $col <= ord('Q'); $col++){
            //set column dimension
            $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(TRUE);
             //change the font size
            $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
        }

        $this->excel->getActiveSheet()->getStyle(chr(ord('A')))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle(chr(ord('B')))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $rs = $this->main->get_kontak();//print_//mz($rs);
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
        $filename='Master Kontak.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
                    
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }

    //FOR JS

    public function add_json()
    {
        permissionUser();
        $data = array(
                'kode' => $this->input->post('kode'),
                'title' => $this->input->post('title'),
                'jenis_id' => $this->input->post('jenis_id'),
                'tipe_id' => $this->input->post('tipe_id'),
                'up' => implode(',', $this->input->post('up')),
                'telepon' => implode(',', $this->input->post('telepon')),
                'alamat' => implode(',', $this->input->post('alamat')),
                'email' => $this->input->post('email'),
                'fax' => $this->input->post('fax'),
                'catatan' => $this->input->post('catatan'),
                'npwp'=>$this->input->post('npwp'),
                'no_rekening'=>$this->input->post('no_rekening'),
                'bank'=>$this->input->post('bank'),
                'a_n'=>$this->input->post('a_n'),
                'alamat_pajak'=>$this->input->post('alamat_pajak'),
                'acc'=>$this->input->post('acc'),
                'created_by' => sessId(),
                'created_on' => dateNow(),
            );
        $insert = $this->main->save($data);
        echo json_encode(array('status'=>true));
        //echo json_encode(array("status" => TRUE));
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

                    $this->template->add_js('vendor/jquery-validation/jquery.validate.min.js');
                    $this->template->add_js('assets/js/form-validation.js');
                    $this->template->add_js('vendor/DataTables/js/jquery.dataTables.min.js');
                    $this->template->add_js('vendor/select2/select2.min.js');
                    $this->template->add_js('assets/js/'.$this->module.'/'.$this->file_name.'.js');
                }elseif(in_array($view, array($this->module.'/'.$this->file_name.'/add',
                                              $this->module.'/'.$this->file_name.'/edit'
                    )))
                {
                    $this->template->set_layout('default');

                    $this->template->add_css('vendor/DataTables/css/DT_bootstrap.css');
                    $this->template->add_css('vendor/select2/select2.css');

                    $this->template->add_js('vendor/jquery-validation/jquery.validate.min.js');
                    $this->template->add_js('assets/js/form-validation.js');
                    $this->template->add_js('vendor/DataTables/js/jquery.dataTables.min.js');
                    $this->template->add_js('vendor/select2/select2.min.js');
                    $this->template->add_js('assets/js/'.$this->module.'/kontak/add.js');
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
    function upload_kontak(){
        $file = fopen('D:\customer.csv', "r");

        $count = 0;
        while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
        {
            $count++; 
            if($count>8){
                $data = array(
                    'kode'=>$emapData[0],
                    'title' => $emapData[2],
                    'alamat' => $emapData[5],
                    'telepon'=>$emapData[8],
                    'tipe_id'=>2,
                    'jenis_id'=>2,
                );

                $this->db->insert('kontak', $data);
                echo '<pre>';
                echo $this->db->last_query();
                echo '</pre>';
            }                           
        }
    }
}



