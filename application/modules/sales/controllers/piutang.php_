<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Piutang extends MX_Controller {
    public $data;
    var $module = 'sales';
    var $title = 'Pembayaran Piutang';
    var $file_name = 'piutang';
    var $table_name = 'sales_piutang';
    function __construct()
    {
        parent::__construct();
        $this->load->model($this->module.'/'.$this->file_name.'_model', 'main');
    }

    function index()
    {
        $this->data['title'] = $this->title;
        $this->data['main_title'] = $this->title;
        permissionUser();
        $this->data['options_so'] = options_row('main','get_so','no','no','-- Pilih No. Invoice --');//print_mz($this->data['options_po']);
        $this->data['coa'] = GetAllSelect('sv_setup_coa', 'id,name')->result();
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
        $this->data['det'] = $this->main->get_detail($id);

        $this->_render_page($this->module.'/'.$this->file_name.'/detail', $this->data);
    }

    public function ajax_add()
    {
        //$this->_validate();
        $data = array(
                'jatuh_tempo' => $this->input->post('jatuh_tempo'),
                'so'=>$this->input->post('so'),
                'no'=>$this->input->post('no'),
                'coa_id'=>$this->input->post('coa_id'),
                'tgl_dibayar'=> date('Y-m-d',strtotime($this->input->post('tgl_dibayar'))),
                'kontak'=>$this->input->post('kontak_id'),
                'kurensi'=>$this->input->post('kurensi'),
                'total'=>str_replace(",","",$this->input->post('total')),
                'dibayar'=>str_replace(",","",$this->input->post('dibayar')),
                'terbayar'=>str_replace(",","",$this->input->post('terbayar')),
                'saldo'=>str_replace(",","",$this->input->post('saldo')),
                'catatan'=>$this->input->post('catatan'),
                'created_by'=>sessId(),
                'created_on'=>dateNow(),
            );
        $insert = $this->main->save($data);
        rekening('sales_piutang', $insert, $data['coa_id'], 'in', $data['dibayar'], 0, $data['kurensi']);
        echo json_encode(array("status" => TRUE));
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
            $row[] = "<a href=$detail>#".$r->so.'</a>';
            $row[] = $r->coa;
            $row[] = $r->tgl_dibayar;
            $row[] = $r->jatuh_tempo;
            $row[] = $r->kontak;
            $row[] = number_format($r->saldo, 2);
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

    function get_no_detail()
    {
        $id = $this->input->post('id');
        $table = 'penjualan';
        $filter = array('no'=>'where/'.$id);

        $kontak = getWhere('kontak_id', $table, 'no', $id);//lastq();
        $kontak = getWhere('title', 'kontak', 'id', $kontak);

        $kurensi = getWhere('kurensi_id', $table, 'no', $id);
        $kurensi = getWhere('title', 'kurensi', 'id', $kurensi);;

        $total_hutang = getWhere('saldo', $table, 'no', $id);
        $saldo = $this->db->select('id, saldo')->where('so', $id)->order_by('id', 'desc')->get('sales_piutang')->row()->saldo;

        $jatuh_tempo = getWhere('tanggal_transaksi', $table, 'no', $id);
        $lama_angsuran_1 = getWhere('lama_angsuran_1', $table, 'no', $id);
        $lama_angsuran_2 = getWhere('lama_angsuran_2', $table, 'no', $id);
        if($lama_angsuran_2 == 'hari'){
            $jatuh_tempo = date( "Y-m-d", strtotime( "$jatuh_tempo +$lama_angsuran_1 day" ) );
        }elseif($lama_angsuran_2 == 'bulan'){
            $jatuh_tempo = date( "Y-m-d", strtotime( "$jatuh_tempo +$lama_angsuran_1 month" ) );
        }elseif($lama_angsuran_2 == 'tahun'){
            $jatuh_tempo = date( "Y-m-d", strtotime( "$jatuh_tempo +$lama_angsuran_1 year" ) );
        }

        $num_rows = getAll('sales_piutang')->num_rows();
        $last_id = ($num_rows>0) ? $this->db->select('id')->order_by('id', 'asc')->get('sales_piutang')->last_row()->id : 0;
        $last_id = ($num_rows>0) ? $last_id+1 : 1; 
        $no = $last_id.'/PTG-I/GSM/I/'.date('Y');
        $terbayar = $this->db->select_sum('dibayar')->where('so', $id)->get('sales_piutang')->row()->dibayar;


        echo json_encode(array('kontak'=>$kontak,
                                'kurensi'=>$kurensi,
                                'jatuh_tempo'=>$jatuh_tempo,
                                'total'=>number_format($total_hutang,2),
                                'terbayar'=>number_format($terbayar, 2),
                                'saldo'=>number_format($saldo, 2),
                                'no'=>$no
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