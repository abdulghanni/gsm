<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MX_Controller {
    public $data;
    var $module = 'sales';
    var $title = 'Order';
    var $file_name = 'order';
    var $main_title = 'Sales Order';
	function __construct()
	{
		parent::__construct();
		$this->load->model($this->module.'/'.$this->file_name.'_model', 'order');
	}

    var $model_name = 'order';

	function index()
	{
        $this->data['title'] = $this->title;
        $this->data['module'] = $this->module;
        $this->data['file_name'] = $this->file_name;
        $this->data['main_title'] = $this->main_title;
        permissionUser();
		$this->_render_page($this->module.'/'.$this->file_name.'/index', $this->data);
	}

    function input()
    {
        $this->data['title'] = $this->title.' - Input';
        $this->data['module'] = $this->module;
        $this->data['file_name'] = $this->file_name;
        permissionUser();
        $num_rows = getAll($this->module.'_'.$this->file_name)->num_rows();
        $last_id = ($num_rows>0) ? $this->db->select('id')->order_by('id', 'asc')->get($this->module.'_'.$this->file_name)->last_row()->id : 0;
        $this->data['last_id'] = ($num_rows>0) ? $last_id+1 : 1;
        $this->data['barang'] = getAll('barang')->result_array();
        $this->data['satuan'] = getAll('satuan')->result_array();
        $this->data['kurensi'] = getAll('kurensi')->result();
        $this->data['metode'] = getAll('metode_pembayaran')->result();
        $this->data['gudang'] = getAll('gudang')->result();
        $this->data['options_customer'] = options_row($this->model_name,'get_customer','id','title','-- Pilih customer --');
        
        $this->_render_page($this->module.'/'.$this->file_name.'/input', $this->data);
    }

    function detail($id)
    {
        $this->data['title'] = $this->title.' - Detail';
        $this->data['module'] = $this->module;
        $this->data['file_name'] = $this->file_name;
        $this->data['main_title'] = $this->main_title;
        permissionUser();
        $this->data['id'] = $id;
        $this->data['order'] = $this->order->get_order_detail($id);
        $this->data['order_list'] = $this->order->get_order_list_detail($id);

        $this->_render_page($this->module.'/'.$this->file_name.'/detail', $this->data);
    }

    function add()
    {
        permissionUser();
        $order_list = array(
                        'kode_barang'=>$this->input->post('kode_barang'),
                        'jumlah'=>$this->input->post('jumlah'),
                        'satuan'=>$this->input->post('satuan'),
                        'harga'=>$this->input->post('harga'),
                        'disc'=>$this->input->post('disc'),
                        'pajak'=>$this->input->post('pajak'),
                        );

        $data = array(
                'no' => $this->input->post('no'),
                'customer_id'=>$this->input->post('customer_id'),
                'up'=>$this->input->post('up'),
                'alamat'=>$this->input->post('alamat'),
                'metode_pembayaran_id'=>$this->input->post('metode_pembayaran_id'),
                'tanggal_transaksi'=>date('Y-m-d',strtotime($this->input->post('tanggal_transaksi'))),
                'so'=>$this->input->post('so'),
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
        $order_id = $this->db->insert_id();
        for($i=0;$i<sizeof($order_list['kode_barang']);$i++):
            $data2 = array(
                'order_id' => $order_id,
                'kode_barang' => $order_list['kode_barang'][$i],
                'jumlah' => str_replace(',', '', $order_list['jumlah'][$i]),
                'satuan_id' => $order_list['satuan'][$i],
                'harga' => str_replace(',', '', $order_list['harga'][$i]),
                'disc' => str_replace(',', '', $order_list['disc'][$i]),
                'pajak' => str_replace(',', '', $order_list['pajak'][$i]),
                );
        $this->db->insert($this->module.'_'.$this->file_name.'_list', $data2);
        endfor;
        redirect($this->module.'/'.$this->file_name, 'refresh');
    }

    public function ajax_list()
    {
        $list = $this->order->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $order) {
            $detail = base_url().$this->module.'/'.$this->file_name.'/detail/'.$order->id;
            $print = base_url().$this->module.'/'.$this->file_name.'/print_pdf/'.$order->id;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = "<a href=$detail>#".$order->so.'</a>';
            $row[] = $order->customer;
            $row[] = $order->tanggal_transaksi;
            $row[] = $order->metode_pembayaran;
            $row[] = $order->gudang;

            $row[] ="<a class='btn btn-sm btn-primary' href=$detail title='detail'><i class='fa fa-info'></i></a>
                    <a class='btn btn-sm btn-light-azure' href=$print target='_blank' title='detail'><i class='fa fa-print'></i></a>";
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->order->count_all(),
                        "recordsFiltered" => $this->order->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    function print_pdf($id)
    {
        permissionUser();
        $this->data['id'] = $id;
        $this->data['order'] = $this->order->get_order_detail($id);
        $this->data['order_list'] = $this->order->get_order_list_detail($id);
        
        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view($this->module.'/'.$this->file_name.'/pdf', $this->data, true); 
        $mpdf = new mPDF();
        $mpdf = new mPDF('A4');
        $mpdf->WriteHTML($html);
        $mpdf->Output($id.'-'.$title.'.pdf', 'I');
    }

    //FOR JS

    function get_customer_detail($id)
    {
        $up = getValue('up', 'customer', array('id'=>'where/'.$id));
        $alamat = getValue('alamat', 'customer', array('id'=>'where/'.$id));

        echo json_encode(array('up'=>$up, 'alamat'=>$alamat));

    }

    function get_nama_barang($id)
    {
        $q = getValue('title', 'barang', array('id'=>'where/'.$id));

        echo json_encode($q);

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