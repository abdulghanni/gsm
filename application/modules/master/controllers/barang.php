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
        //$this->lang->load('master/barang');
	}

	// redirect if needed, otherwise display the user list
	function index()
	{
        permissionUser();
        $this->data['jenis_barang'] = getAll('jenis_barang');
        $this->data['options_jenis_barang'] = options_row('barang', 'get_jenis_barang','id','title', '-- Pilih Jenis Barang --');
        $this->data['options_satuan'] = options_row('barang', 'get_satuan','id','title', '-- Pilih Satuan --');
		$this->_render_page($this->module.'/'.$this->file_name, $this->data);
	}

    public function ajax_list()
    {
        permissionUser();
        $list = $this->barang->get_datatables();
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
            $row[] = $barang->alias;
            $row[] = $barang->jenis_barang;
            $row[] = $barang->satuan;
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
        $data = array(
                'kode' => $this->input->post('kode'),
                'title' => $this->input->post('title'),
                'alias' => $this->input->post('alias'),
                'jenis_barang_id' => $this->input->post('jenis_barang_id'),
                'satuan' => $this->input->post('satuan'),
                'satuan_laporan' => $this->input->post('satuan_laporan'),
                'catatan' => $this->input->post('catatan'),
                'created_by' => sessId(),
                'created_on' => dateNow(),
            );
        $id = $this->input->post('id');
        if($is_update == 1) {
			$this->barang->update(array('id' => $id), $data);
            
            /* $num_satuan_dasar = GetAllSelect('barang_satuan', 'id', array('barang_id'=>'where/'.$id, 'satuan'=>'where/'.$this->input->post('satuan')))->num_rows();
            if($num_satuan_dasar>0):
                $this->db->where('satuan',$this->input->post('satuan'))->where('barang_id', $id);
                $this->db->update('barang_satuan',array('value'=>1,'satuan'=>$this->input->post('satuan')));
            else:
                $this->db->insert('barang_satuan',array('barang_id'=>$id,'value'=>1,'satuan'=>$this->input->post('satuan')));
            endif; */
			$a=0;
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
        else{ $id = $this->barang->save($data);
			
			$a=0;
                $this->db->insert('barang_satuan',array('barang_id'=>$id,'value'=>1,'satuan'=>$this->input->post('satuan')));
			foreach($satuanlain as $sl){
				if(isset($sl[$a])){
				$this->db->insert('barang_satuan',array('barang_id'=>$id,'value'=>$valuelain[$a],'satuan'=>$satuanlain[$a]));
				}
				$a++;
			}
            
		}
        $this->upload($id);
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
    function upload($id)
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
            $this->db->where('id', $id)->update('barang', $data);
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
    function excel()
    {
    //load our new PHPExcel library
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Master Barang');


        $this->excel->getActiveSheet()->mergeCells('C1:E1');
        $this->excel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('Logo');
        $objDrawing->setDescription('Logo');
        $objDrawing->setPath(base_url('assets/images/logo-po.jpg'));
        $objDrawing->setHeight(36);

        $objDrawing->setWorksheet($this->excel->getActiveSheet());

        $this->excel->getActiveSheet()->setCellValue('C1', 'PT Gramaselindo');

         $this->excel->getActiveSheet()->setCellValue('A7', 'No');
         $this->excel->getActiveSheet()->setCellValue('B7', 'Kode');
         $this->excel->getActiveSheet()->setCellValue('C7', 'Deskripsi');
         $this->excel->getActiveSheet()->setCellValue('D7', 'Alias');
         $this->excel->getActiveSheet()->setCellValue('E7', 'Jenis Barang');
         $this->excel->getActiveSheet()->setCellValue('F7', 'Satuan');


        for($col = ord('A'); $col <= ord('F'); $col++){
            //set column dimension
            $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
             //change the font size
            $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
        }

        $this->excel->getActiveSheet()->getStyle(chr(ord('A')))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle(chr(ord('B')))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setSize(40);

        $rs = $this->barang->get_barang();
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
        $filename='just_some_random_name.xls'; //save our workbook as this file name
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

                    $this->template->add_js('vendor/jquery-validation/jquery.validate.min.js');
                    $this->template->add_js('assets/js/form-validation.js');
                    $this->template->add_css('vendor/bootstrap-fileinput/jasny-bootstrap.min.css');
                    $this->template->add_js('vendor/bootstrap-fileinput/jasny-bootstrap.js');
                    $this->template->add_js('vendor/DataTables/js/jquery.dataTables.min.js');
                    $this->template->add_js('vendor/select2/select2.min.js');
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
            if($count>10){

                switch ($emapData[5]) {
                    case 'Pcs':
                        $satuan = 1;
                        break;
                    case 'roll':
                        $satuan = 2;
                        break;
                    case 'roll=300m':
                        $satuan = 3;
                        break;
                    case 'm':
                        $satuan = 4;
                        break;
                    case 'pack':
                        $satuan = 5;
                        break;
                    case 'set':
                        $satuan = 6;
                        break;
                    
                    default:
                        $satuan = 1;
                        break;
                }
                $data = array(
                    'kode'=>$emapData[4],
                    'title' => $emapData[2],
                    'satuan' => $satuan,
                    'jenis_barang_id'=>1,
                    'created_by'=>1,
                    'created_on'=>dateNow(),
                );
                $cek = getAll('barang', array('kode'=>'where/'.$emapData[4]))->num_rows();

                if($cek<1)$this->db->insert('barang', $data);else $this->db->where('kode', $emapData[4])->update('barang', $data);
                echo '<pre>';
                echo $count.'-'.$this->db->last_query();
                echo '</pre>';
            }                           
        }
    }
}