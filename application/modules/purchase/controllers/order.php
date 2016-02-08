<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MX_Controller {
    public $data;
    var $module = 'purchase';
    var $title = 'Order';
    var $file_name = 'order';
    
    function __construct()
    {
        parent::__construct();
        $this->load->model($this->module.'/'.$this->file_name.'_model', 'main');
    }

    function index()
    {
        $this->data['title'] = $this->title;
        $this->data['main_title'] = $this->module.' Order';
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
        $this->data['barang'] = getAll('barang')->result_array();
        $this->data['satuan'] = getAll('satuan')->result_array();
        $this->data['kurensi'] = getAll('kurensi')->result();
        $this->data['metode'] = getAll('metode_pembayaran')->result();
        $this->data['gudang'] = getAll('gudang')->result();
        $this->data['users'] = getAll('users');
        $this->data['options_supplier'] = options_row('main','get_supplier','id','title','-- Pilih Supplier --');
        
        $this->_render_page($this->module.'/'.$this->file_name.'/input', $this->data);
    }

    function detail($id)
    {
        $this->data['title'] = $this->title.' - Detail';
        permissionUser();
        $this->data['id'] = $id;
        $this->data[$this->file_name] = $this->main->get_detail($id);
        $this->data[$this->file_name.'_list'] = $this->main->get_list_detail($id);
        $this->data['user_app_lv1'] = getValue('user_id', 'approver', array('level'=>'where/1'));
        $this->data['user_app_lv2'] = getValue('user_id', 'approver', array('level'=>'where/2'));
        $this->data['user_app_lv3'] = getValue('user_id', 'approver', array('level'=>'where/3'));
        $this->data['jabatan_lv1'] = getValue('jabatan', 'approver', array('level'=>'where/1'));
        $this->data['jabatan_lv2'] = getValue('jabatan', 'approver', array('level'=>'where/2'));
        $this->data['jabatan_lv3'] = getValue('jabatan', 'approver', array('level'=>'where/3'));
        $this->_render_page($this->module.'/'.$this->file_name.'/detail', $this->data);
    }

    function add()
    {
        permissionUser();
        $list = array(
                        'kode_barang'=>$this->input->post('kode_barang'),
                        'deskripsi'=>$this->input->post('deskripsi'),
                        'jumlah'=>$this->input->post('jumlah'),
                        'satuan'=>$this->input->post('satuan'),
                        'harga'=>$this->input->post('harga'),
                        'disc'=>$this->input->post('disc'),
                        'pajak'=>$this->input->post('pajak'),
                        );
        //$approver = $this->input->post('approver');
        $data = array(
                'no' => $this->input->post('no'),
                'supplier_id'=>$this->input->post('supplier_id'),
                'up'=>$this->input->post('up'),
                'alamat'=>$this->input->post('alamat'),
                'metode_pembayaran_id'=>$this->input->post('metode_pembayaran_id'),
                'tanggal_transaksi'=>date('Y-m-d',strtotime($this->input->post('tanggal_transaksi'))),
                'po'=>$this->input->post('po'),
                'gudang_id'=>$this->input->post('gudang_id'),
                'jatuh_tempo_pembayaran'=>date('Y-m-d',strtotime($this->input->post('tanggal_transaksi'))),
                'kurensi_id'=>$this->input->post('kurensi_id'),
                'biaya_pengiriman'=>str_replace(',', '', $this->input->post('biaya_pengiriman')),
                'dibayar'=>str_replace(',', '', $this->input->post('dibayar')),
                'lama_angsuran_1' =>$this->input->post('lama_angsuran_1'),
                'lama_angsuran_2' =>$this->input->post('lama_angsuran_2'),
                'bunga' =>str_replace(',', '', $this->input->post('bunga')),
                'catatan' =>$this->input->post('catatan'),
                'created_by' => sessId(),
                'created_on' => dateNow(),
            );

        $this->db->insert($this->module.'_'.$this->file_name, $data);
        $insert_id = $this->db->insert_id();
        for($i=0;$i<sizeof($list['kode_barang']);$i++):
            $data2 = array(
                $this->file_name.'_id' => $insert_id,
                'kode_barang' => $list['kode_barang'][$i],
                'deskripsi' => $list['deskripsi'][$i],
                'jumlah' => str_replace(',', '', $list['jumlah'][$i]),
                'satuan_id' => $list['satuan'][$i],
                'harga' => str_replace(',', '', $list['harga'][$i]),
                'disc' => str_replace(',', '', $list['disc'][$i]),
                'pajak' => str_replace(',', '', $list['pajak'][$i]),
                );
        $this->db->insert($this->module.'_'.$this->file_name.'_list', $data2);
        endfor;
        
        $this->send_notification($insert_id);
        redirect($this->module.'/'.$this->file_name, 'refresh');
    }

    function send_notification($id)
    {
        permissionUser();
        $url = base_url().$this->module.'/'.$this->file_name.'/detail/'.$id;
        $isi = getName(sessId())." Mengajuan Purchase Order, Untuk melakukan approval silakan <a href=$url> KLIK DISINI </a>.";
        $approver = getAll('approver');
        foreach($approver->result() as $r):
            $data = array('sender_id' => sessId(),
                          'receiver_id' => $r->user_id,
                          'sent_on' => dateNow(),
                          'judul' => 'Pengajuan Purchase Order',
                          'isi' => $isi,
                          'url' => $url,
             );
        $this->db->insert('notifikasi', $data);
        endforeach;
        return TRUE;
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
            $row[] = "<a href=$detail>#".$r->po.'</a>';
            $row[] = $r->supplier;
            $row[] = $r->tanggal_transaksi;
            $row[] = $r->metode_pembayaran;
            $row[] = $r->gudang;

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

    //FOR JS

    function get_supplier_detail($id)
    {
        $up = getValue('up', 'supplier', array('id'=>'where/'.$id));
        $alamat = getValue('alamat', 'supplier', array('id'=>'where/'.$id));

        echo json_encode(array('up'=>$up, 'alamat'=>$alamat));

    }

    function get_nama_barang($id)
    {
        $q = getValue('title', 'barang', array('id'=>'where/'.$id));

        echo json_encode($q);

    }

    function approve()
    {
        $level = $this->input->post('level');//die($level);
        $id = $this->input->post('id');
        $data = array('is_app_lv'.$level => 1,
                      'app_status_id_lv'.$level => $this->input->post('app_status_id_lv'.$level),
                      'date_app_lv'.$level=>dateNow(),
                      'user_app_id_lv'.$level => sessId(),
                      'note_app_lv'.$level => $this->input->post('note_lv'.$level)
            );
        $this->db->where('id', $id)->update('purchase_order', $data);
        echo json_encode(array("status" => $id));
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
                    
                    $this->template->add_css('assets/css/custom.css');
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