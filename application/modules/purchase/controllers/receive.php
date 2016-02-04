<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Receive extends MX_Controller {
    public $data;
    var $module = 'purchase';
    var $title = 'Terima Barang';
    var $file_name = 'receive';
    var $main_title = 'Terima Barang';
    var $table_name = 'receive';
    function __construct()
    {
        parent::__construct();
        $this->load->model($this->module.'/'.$this->file_name.'_model', 'main');
    }

    function index()
    {
        $this->data['title'] = $this->title;
        $this->data['main_title'] = $this->main_title;
        $this->data['file_name'] = $this->file_name;
        $this->data['module'] = $this->module;
        permissionUser();
        $this->_render_page($this->module.'/'.$this->file_name.'/index', $this->data);
    }

    function input()
    {
        $this->data['title'] = $this->title.' - Input';
        $this->data['main_title'] = $this->main_title;
        $this->data['file_name'] = $this->file_name;
        $this->data['module'] = $this->module;
        permissionUser();
        $num_rows = getAll($this->table_name)->num_rows();
        $last_id = ($num_rows>0) ? $this->db->select('id')->order_by('id', 'asc')->get($this->table_name)->last_row()->id : 0;
        $this->data['last_id'] = ($num_rows>0) ? $last_id+1 : 1;
        $this->data['barang'] = getAll('barang')->result_array();
        $this->data['satuan'] = getAll('satuan')->result_array();
        $this->data['kurensi'] = getAll('kurensi')->result();
        $this->data['metode'] = getAll('metode_pembayaran')->result();
        $this->data['gudang'] = getAll('gudang')->result();
        $this->data['options_supplier'] = options_row('main','get_supplier','id','title','-- Pilih Supplier --');
        $this->data['po'] = GetAllSelect('purchase_order', array('id','po'), array('id'=>'order/desc'))->result();
        $this->_render_page($this->module.'/'.$this->file_name.'/input', $this->data);
    }

    function detail($id)
    {
        $this->data['main_title'] = $this->main_title;
        $this->data['file_name'] = $this->file_name;
        $this->data['module'] = $this->module;
        $this->data['title'] = $this->title.' - Detail';
        permissionUser();
        $this->data['id'] = $id;
        $detail = $this->data[$this->file_name] = $this->main->get_detail($id);
        $this->data['kondisi_barang'] = explode(',', $detail->row()->kondisi_barang);
        $this->data['kondisi_packing']= explode(',', $detail->row()->kondisi_packing);
        $this->data['kondisi_jumlah'] = explode(',', $detail->row()->kondisi_jumlah);
        $this->data['qc'] = "";
        $this->data['inbound'] = "";
        $this->_render_page($this->module.'/'.$this->file_name.'/detail', $this->data);
    }

    function add()
    {
        permissionUser();
        $data = array(
                'no' => $this->input->post('no'),
                'po'=>$this->input->post('po'),
                'no_surat'=>$this->input->post('no_surat'),
                'tanggal_terima'=>date('Y-m-d',strtotime($this->input->post('tanggal_terima'))),
                'project'=>$this->input->post('project'),
                'kendaraan'=>$this->input->post('kendaraan'),
                'box'=>$this->input->post('box'),
                'volume'=>$this->input->post('volume'),
                'roll'=>$this->input->post('roll'),
                'kondisi_barang'=>implode(",",$this->input->post('kondisi-barang')),
                'kondisi_packing'=>implode(",",$this->input->post('kondisi-packing')),
                'kondisi_jumlah'=>implode(",",$this->input->post('kondisi-jumlah')),
                'keterangan' =>$this->input->post('keterangan'),
                'created_by' => sessId(),
                'created_on' => dateNow(),
            );

        $this->db->insert($this->table_name, $data);

        redirect($this->module.'/'.$this->file_name, 'refresh');
    }

    public function ajax_list()
    {
        $list = $this->main->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $detail = base_url().$this->module.'/'.$this->file_name.'/detail/'.$r->id;
            $print = base_url().$this->module.'/'.$this->file_name.'/print_pdf/'.$r->id;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = "<a href=$detail>#".$r->no.'</a>';
            $row[] = $r->no_surat;
            $row[] = $r->po;
            $row[] = $r->tanggal_terima;
            $row[] = $r->project;

            $row[] ="<a class='btn btn-sm btn-primary' href=$detail title='detail'><i class='fa fa-info'></i></a>
                    <a class='btn btn-sm btn-light-azure' href=$print target='_blank' title='detail'><i class='fa fa-print'></i></a>";
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

    function print_pdf($id)
    {
        permissionUser();
        $this->data['title'] = $this->title;
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