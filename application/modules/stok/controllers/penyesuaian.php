<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Penyesuaian extends MX_Controller {
    public $data;
    var $module = 'stok';
    var $title = 'Penyesuaian';
    var $file_name = 'Penyesuaian';
    
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
        $this->_render_page($this->module.'/'.$this->file_name.'/index', $this->data);
	}

    function input()
    {
        $this->data['title'] = $this->title.' - Input';
        permissionUser();
        $num_rows = getAll($this->module.'_'.$this->file_name)->num_rows();
        $last_id = ($num_rows>0) ? $this->db->select('id')->order_by('id', 'asc')->get($this->module.'_'.$this->file_name)->last_row()->id : 0;
        $this->data['last_id'] = ($num_rows>0) ? $last_id+1 : 1;
        $this->_render_page($this->module.'/'.$this->file_name.'/input', $this->data);
    }
	
	
    function detail($id)
    {
		$this->data['title'] = $this->title.' - Detail';
        permissionUser();
        $this->data['id'] = $id;
		$this->data['r']=GetAll('stok_penyesuaian',array('id'=>'where/'.$id))->row();
		$this->data['list']=$this->main->get_list($id)->result();
		
        $this->_render_page($this->module.'/'.$this->file_name.'/detail', $this->data);
    }

    function add()
    {
        permissionUser();
        $list = array(
                        'barang_id'=>$this->input->post('barang_id'),
                        'catatan_barang'=>$this->input->post('catatan_barang'),
                        'buku'=>$this->input->post('buku'),
                        'satuan_buku'=>$this->input->post('satuan_buku'),
                        'fisik'=>$this->input->post('fisik'),
                        'satuan_id'=>$this->input->post('satuan_id')
                    );
        $data = array(
                    'no'=>$this->input->post('no'),
                    'tgl'=>date('Y-m-d',strtotime($this->input->post('tgl'))),
                    'catatan' =>$this->input->post('catatan'),
                    'created_by' =>sessId(),
                    'created_on' =>dateNow(),
                );

        $this->db->insert($this->module.'_'.$this->file_name, $data);
        $insert_id = $this->db->insert_id();

        for($i=0;$i<sizeof($list['barang_id']);$i++):
            $data2 = array(
                $this->file_name.'_id' => $insert_id,
                'barang_id' => $list['barang_id'][$i],
                'catatan' => $list['catatan_barang'][$i],
                'buku' => str_replace(',', '', $list['buku'][$i]),
                'satuan_buku' => str_replace(',', '', $list['satuan_buku'][$i]),
                'fisik' => str_replace(',', '', $list['fisik'][$i]),
                'satuan_id' => $list['satuan_id'][$i]
                );
            $this->db->insert($this->module.'_'.$this->file_name.'_list', $data2);
    		$this->db->where(array('barang_id'=>$list['barang_id'][$i]));
    		$this->db->update('stok',array('dalam_stok'=>$list['fisik'][$i]));
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
            // $print = base_url().$this->module.'/'.$this->file_name.'/print_pdf/'.$r->id;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = "<a href=$detail>#".$r->no.'</a>';
            $row[] = dateIndo($r->tgl);
            $row[] = $r->catatan;

            $row[] ="<a class='btn btn-sm btn-primary' href=$detail title='detail'><i class='fa fa-info'></i></a>";
                    // <a class='btn btn-sm btn-light-azure' href=$print target='_blank' title='detail'><i class='fa fa-print'></i></a>";
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

    //FOR JS

    function add_row($id)
    {
        $data['id'] = $id;
        $data['barang'] = getAll('barang')->result_array();
        $data['satuan'] = getAll('satuan')->result_array();
        $this->load->view('penyesuaian/row', $data);
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

                    $this->template->add_css('vendor/DataTables/css/DT_bootstrap.css');
                    $this->template->add_js('vendor/DataTables/js/jquery.dataTables.min.js');
                    $this->template->add_js('assets/js/'.$this->module.'/'.$this->file_name.'/index.js');
                }elseif(in_array($view, array($this->module.'/'.$this->file_name.'/input')))
                {
                    $this->template->set_layout('default');

                    $this->template->add_css('vendor/select2/select2.css');
                    $this->template->add_css('vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css');

                    $this->template->add_js('vendor/jquery-validation/jquery.validate.min.js');
                    $this->template->add_js('assets/js/form-validation.js');
                    $this->template->add_js('vendor/select2/select2.min.js');
                    $this->template->add_js('vendor/bootstrap-datepicker/bootstrap-datepicker.min.js');
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