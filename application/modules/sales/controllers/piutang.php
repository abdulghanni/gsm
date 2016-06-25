<?php defined('BASEPATH') OR exit('No direct script access allowed');

class piutang extends MX_Controller {
    public $data;
    var $module = 'sales';
    var $title = 'Pembayaran piutang';
    var $file_name = 'piutang';
    var $table_name = 'sales_piutang';
    function __construct()
    {
        parent::__construct();
        $this->load->model($this->module.'/'.$this->file_name.'_model', 'main');
        $this->load->model($this->module.'/'.'piutang_list_model', 'main2');
    }

    function index()
    {
        $this->data['title'] = $this->title;
        $this->data['main_title'] = $this->title;
        permissionUser();
        $this->data['coa'] = GetAllSelect('sv_setup_coa', 'id,name')->result();
        $this->data['options_po'] = options_row('main','get_po','id','no','-- Pilih No. Invoice --');
        $this->_render_page($this->module.'/'.$this->file_name.'/index', $this->data);
    }

    function input()
    {
        $this->data['title'] = $this->title.' - Input';
        permissionUser();
        $this->data['options_kontak'] = options_row($this->model_name,'get_kontak','id','title','-- Pilih Supplier --');
        $this->data['options_kurensi'] = options_row($this->model_name,'get_kurensi','id','title','-- Pilih Kurensi --');
        
        
        $this->_render_page($this->module.'/'.$this->file_name.'/input', $this->data);
    }

    function detail($id)
    {
        $this->data['title'] = $this->title.' - Detail';
        $this->data['main_title'] = $this->title;
        $this->data['module'] = $this->module;
        $this->data['file_name'] = $this->file_name;
        permissionUser();
        $this->data['id'] = $id;
        $this->data['det'] = $this->main2->get_detail($id);
        $this->data['list'] = $this->main->get_detail($id);

        $this->_render_page($this->module.'/'.$this->file_name.'/detail', $this->data);
    }

    public function ajax_add()
    {
        //$this->_validate();
        $dibayar = str_replace(',', '', $this->input->post('dibayar'));
        $kurensi = $this->input->post('kurensi');
        $list_id = $this->input->post('inv');
        $saldo = str_replace(',', '', $this->input->post('saldo'));
        $data = array(
                'list_id' => $list_id,
                'no'=>$this->input->post('no'),
                'coa_id'=>$this->input->post('coa_id'),
                'tgl_dibayar'=> date('Y-m-d',strtotime($this->input->post('tgl_dibayar'))),
                'dibayar'=> $dibayar,
                'catatan'=>$this->input->post('catatan'),
                'created_by'=>sessId(),
                'created_on'=>dateNow(),
            );
        $insert = $this->main->save($data);
        $terbayar = getValue('terbayar', 'sales_piutang_list', array('id'=>'where/'.$list_id));
        $terbayar = $terbayar + $dibayar;
        $status = ($saldo>0) ? 2 : 3;
        $data_list = array(
            'terbayar'=>$terbayar,
            'saldo' => $saldo,
            'status_piutang_id' => $status,
            'edited_by'=>sessId(),
            'edited_on'=>dateNow(),
            );
        $this->db->where('id', $list_id)->update('sales_piutang_list', $data_list);
        rekening('sales_piutang', $insert, $data['coa_id'], 'in', $data['dibayar'], 0, $kurensi);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_list()
    {
        $list = $this->main->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $detail = base_url().$this->module.'/'.$this->file_name.'/detail/'.$r->list_id;
            $print = base_url().$this->module.'/'.$this->file_name.'/print_pdf/'.$r->id;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = "<a href=$detail>#".$r->no.'</a>';
            $row[] = "<a href=$detail>#".$r->no_invoice.'</a>';
            $row[] = $r->coa;
            $row[] = $r->tgl_dibayar;
            $row[] = $r->jatuh_tempo;
            $row[] = $r->kontak;
            $row[] = number_format($r->dibayar, 2);
            $row[] ="<a class='btn btn-sm btn-primary' href=$detail title='detail'><i class='fa fa-info'></i></a>";
            //$row[] = $r->kurensi;
            //$row[] = $r->dibayar;
            //$row[] = $r->terbayar;
            //$row[] = $r->total;
            //$row[] = $r->saldo;

            //$row[] ="<a class='btn btn-sm btn-primary' href=$detail title='detail'><i class='fa fa-info'></i></a><a class='btn btn-sm btn-light-azure' href=$print target='_blank' title='detail'><i class='fa fa-print'></i></a>";
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

    public function piutang_list()
    {
        $list = $this->main2->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $detail = base_url().$this->module.'/'.$this->file_name.'/detail/'.$r->id;
            $print = base_url().$this->module.'/'.$this->file_name.'/print_pdf/'.$r->id;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = "<a href=$detail>#".$r->no.'</a>';
            $row[] = $r->kontak;
            $row[] = $r->jatuh_tempo_pembayaran;
            $row[] = number_format($r->saldo,2);
            $row[] = $r->status;
            $row[] ="<a class='btn btn-sm btn-primary' href=$detail title='detail'><i class='fa fa-info'></i></a>";
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->main2->count_all(),
                        "recordsFiltered" => $this->main2->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    function print_pdf($id)
    {
        permissionUser();
        $this->data['id'] = $id;
        $this->data[$this->file_name] = $this->main->get_detail($id);
        
        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view($this->module.'/'.$this->file_name.'/pdf', $this->data, true); 
        $mpdf = new mPDF();
        $mpdf = new mPDF('A4');
        $mpdf->WriteHTML($html);
        $mpdf->Output($id.'-'.$title.'.pdf', 'I');
    }

    //FOR JS

    function get_piutang_detail()
    {
        $id = $this->input->post('id');
        $q = $this->main2->get_detail($id);
        $pembayaran_ke = getAll('sales_piutang', array('list_id'=>'where/'.$id))->num_rows();
        echo json_encode(array(
            'kontak'=>$q->kontak,
            'kurensi'=>$q->kurensi,
            'jatuh_tempo'=>$q->jatuh_tempo_pembayaran,
            'total'=>number_format($q->total,2),
            'terbayar'=>number_format($q->terbayar, 2),
            'saldo'=>number_format($q->saldo, 2),
            'pembayaran_ke'=>$pembayaran_ke+1,
        ));
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

                    $this->template->add_css('vendor/select2/select2.css');
                    $this->template->add_css('vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css');
                    $this->template->add_css('vendor/DataTables/css/DT_bootstrap.css');
                    $this->template->add_js('vendor/select2/select2.min.js');
                    $this->template->add_js('vendor/DataTables/js/jquery.dataTables.min.js');
                    $this->template->add_js('vendor/bootstrap-datepicker/bootstrap-datepicker.min.js');
                    $this->template->add_js('vendor/jquery-mask-money/jquery.MaskMoney.js');
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