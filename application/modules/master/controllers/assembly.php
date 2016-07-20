<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Assembly extends MX_Controller {
    public $data;
    var $module = 'master';
    var $title = 'Assembly';
    var $file_name = 'assembly';
    
    function __construct()
    {
        parent::__construct();
        $this->load->model($this->module.'/'.$this->file_name.'_model', 'main');
    }

    function index()
    {
        $this->data['title'] = $this->title;
        $this->data['modul'] = $this->module;
        $this->data['filename'] = $this->file_name;
        $this->data['main_title'] = $this->module.'';
       
        permissionUser();
        $this->_render_page($this->module.'/'.$this->file_name, $this->data);
	}
	
    public function ajax_list()
    {
        permissionUser();
        $list = $this->main->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $edit = base_url("master/assembly/input/".$r->id);
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $this->view_row($r->id);;


            //add html for action
            $row[] = '<a href="'.$edit.'" target="_blank" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_user('."'".$r->id."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
        
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

    function input($id=NULL)
    {
        $this->data['val']=$this->data['list']=array();
        if($id>0){
            $this->data['val']=GetAll($this->file_name,array('id'=>'where/'.$id))->row_array();
            $this->data['list']=GetAll($this->file_name.'_list',array($this->file_name.'_id'=>'where/'.$id))->result_array();

        }
        $this->data['title'] = $this->title.' - Input';
        permissionUser();
		$this->data['module']=$this->module;
		$this->data['file_name']=$this->file_name;
        $this->data['r'] = $this->main->get_detail($id);
        $this->data['opt_barang'] = GetAll('barang');
        $this->data['barang'] = getAll('barang')->result_array();
        $this->data['satuan'] = getAll('satuan')->result_array();
        $this->data['opt_satuan'] = GetOptAll('satuan');
        
        $this->_render_page($this->module.'/'.$this->file_name.'/input', $this->data);
    }

    function add()
    {
        permissionUser();
        $id=$this->input->post('id');
        $list = array(
                    'kode_barang'=>$this->input->post('kode_barang'),
                    'jumlah'=>$this->input->post('jumlah'),
                    'satuan'=>$this->input->post('satuan')
                );

        $data = array(
                'barang_id'=>$this->input->post('output'),
                'created_on' =>date("Y-m-d"),
                'created_by' =>sessId()
            );
        if($id>0){
         $this->db->where('id',$id);
         $this->db->update($this->file_name, $data);
         $insert_id = $id;
         $this->db->query("DELETE FROM assembly_list WHERE assembly_id='$id'");
        }
        else{
        $this->db->insert($this->file_name, $data);
        $insert_id = $this->db->insert_id();
        }
        for($i=0;$i<sizeof($list['kode_barang']);$i++):
            $data2 = array(
                'assembly_id' => $insert_id,
                'kode_barang' => $list['kode_barang'][$i],
                'jumlah' => str_replace(',', '.', $list['jumlah'][$i]),
                'satuan_id' => $list['satuan'][$i]
                );
        $this->db->insert($this->file_name.'_list', $data2);
	endfor;
        
        redirect($this->module.'/'.$this->file_name, 'refresh');
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
            }elseif(in_array($view, array($this->module.'/'.$this->file_name.'/input'))){
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

    function view_row($id){
        $r = $this->main->get_detail($id);
        $row = 
       '<div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#'.$id.'">
                            '.$r->kode.'-'.$r->title.'
                        </a>
                    </h4>
                </div>
                <div id="'.$id.'" class="panel-collapse collapse out">
                    <div class="panel-body">
                        <h4>Komposisi</h4>
                        <table class="table table-bordered table-hover" id="table_id">
                          <thead>
                              <tr>
                                  <th>Kode Barang</th>
                                  <th>Nama Barang</th>
                                  <th>Qty</th>
                                  <th>Satuan</th>
                              </tr>
                          </thead>
                          <tbody>
                            '.$this->get_row_list($id).'
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>';
        return $row;
    }

    function get_row_list($id){
        $lx ='';
        $list = $this->main->get_list_detail($id);
         foreach ($list as $l) {
             $lx .= '<tr>
                                  <td>'.$l->kode.'</td>
                                  <td>'.$l->nama_barang.'</td>
                                  <td>'.$l->jumlah.'</td>
                                  <td>'.$l->satuan.'</td>
                              </tr> ';
         }
         return $lx;
    }

    public function ajax_delete($id)
    {
        $this->main->delete_by_id($id);
        $this->db->where('assembly_id', $id);
        $this->db->delete('assembly_list');
        echo json_encode(array("status" => TRUE));
    }
}