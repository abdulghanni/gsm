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
		$satuanlain=$this->input->post('satuan_lain');
		$valuelain=$this->input->post('value_lain');
        $is_update = $this->input->post('is_update');
        $data = array(
                'kode' => $this->input->post('kode'),
                'title' => $this->input->post('title'),
                'alias' => $this->input->post('alias'),
                'jenis_barang_id' => $this->input->post('jenis_barang_id'),
                'satuan' => $this->input->post('satuan'),
                'catatan' => $this->input->post('catatan'),
                'created_by' => sessId(),
                'created_on' => dateNow(),
            );
        $id = $this->input->post('id');
        if($is_update == 1) {$this->barang->update(array('id' => $id), $data);
			
			$satuanlain_id=$this->input->post('satuan_lain_id');
			$a=0;
			foreach($satuanlain as $sl){
				$this->db->where('id',$satuanlain_id[$a]);
				$this->db->update('barang_satuan',array('value'=>$valuelain[$a],'satuan'=>$satuanlain[$a]));
				$a++;
			}
		
		}
        else{ $id = $this->barang->save($data);
			
			$a=0;
			foreach($satuanlain as $sl){
				$this->db->insert('barang_satuan',array('barang_id'=>$id,'value'=>$valuelain[$a],'satuan'=>$satuanlain[$a]));
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
}