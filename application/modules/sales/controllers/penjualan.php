<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends MX_Controller {
    public $data;
    var $module = 'sales';
    var $title = 'Penjualan';
    var $file_name = 'penjualan';
    var $main_title = 'Penjualan';
    var $table_name = 'penjualan';
	function __construct()
	{
		parent::__construct();
		$this->load->model($this->module.'/'.$this->file_name.'_model', 'main');
	}

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
        $this->data['main_title'] = $this->main_title;
        permissionUser();
        $num_rows = getAll($this->table_name)->num_rows();
        $last_id = ($num_rows>0) ? $this->db->select('id')->order_by('id', 'asc')->get($this->table_name)->last_row()->id : 0;
        $this->data['last_id'] = ($num_rows>0) ? $last_id+1 : 1;
        $this->data['barang'] = getAll('barang')->result_array();
        $this->data['satuan'] = getAll('satuan')->result_array();
        $this->data['kurensi'] = getAll('kurensi')->result();
        $this->data['metode'] = getAll('metode_pembayaran')->result();
        $this->data['gudang'] = getAll('gudang')->result();
        $this->data['options_kontak'] = options_row('main','get_kontak','id','title','-- Pilih Customer --');
        $this->data['so'] = GetAllSelect('sales_order', array('id','so'), array('id'=>'order/desc'))->result();
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
        $this->data['penjualan'] = $this->main->get_detail($id);
        $this->data['penjualan_list'] = $this->main->get_list_detail($id);

        $this->_render_page($this->module.'/'.$this->file_name.'/detail', $this->data);
    }

    function add()
    {
        permissionUser();
        $list = array(
                        'kode_barang'=>$this->input->post('kode_barang'),
                        'deskripsi'=>$this->input->post('deskripsi'),
                        'diterima'=>$this->input->post('diterima'),
                        'diorder'=>$this->input->post('diorder'),
                        'satuan'=>$this->input->post('satuan'),
                        'harga'=>$this->input->post('harga'),
                        'disc'=>$this->input->post('disc'),
                        'pajak'=>$this->input->post('pajak'),
                        );

        $data = array(
                'no' => $this->input->post('no'),
                'kontak_id'=>$this->input->post('kontak_id'),
                'up'=>'',
                'alamat'=>'',
                'metode_pembayaran_id'=>$this->input->post('metode_pembayaran_id'),
                'tanggal_transaksi'=>date('Y-m-d',strtotime($this->input->post('tanggal_transaksi'))),
                'tanggal_pengantaran'=>date('Y-m-d',strtotime($this->input->post('tanggal_pengiriman'))),
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
                'pajak_komponen_id' =>implode(',',$this->input->post('pajak_komponen_id')),
                'total_ppn' => str_replace(',', '', $this->input->post('total-ppn')),
                'total_pph22' => str_replace(',', '', $this->input->post('total-pph22')),
                'total_pph23' => str_replace(',', '', $this->input->post('total-pph23')),
                'created_by' => sessId(),
                'created_on' => dateNow(),
            );

        $this->db->insert($this->table_name, $data);
        $insert_id = $this->db->insert_id();
        for($i=0;$i<sizeof($list['kode_barang']);$i++):
            $data2 = array(
                $this->file_name.'_id' => $insert_id,
                'kode_barang' => $list['kode_barang'][$i],
                'deskripsi' => $list['deskripsi'][$i],
                'diterima' => str_replace(',', '', $list['diterima'][$i]),
                'diorder' => str_replace(',', '', $list['diorder'][$i]),
                'satuan_id' => $list['satuan'][$i],
                'harga' => str_replace(',', '', $list['harga'][$i]),
                'disc' => str_replace(',', '', $list['disc'][$i]),
                'pajak' => str_replace(',', '', $list['pajak'][$i]),
                );
        $this->db->insert($this->table_name.'_list', $data2);
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
            $print = base_url().$this->module.'/'.$this->file_name.'/print_pdf/'.$r->id;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = "<a href=$detail>#".$r->no.'</a>';
            $row[] = $r->so;
            $row[] = $r->kontak;
            $row[] = $r->tanggal_transaksi;
            $row[] = $r->tanggal_pengantaran;
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
        $this->data['penjualan'] = $this->main->get_detail($id);
        $this->data['penjualan_list'] = $this->main->get_list_detail($id);
        
        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view($this->module.'/'.$this->file_name.'/pdf', $this->data, true); 
        $this->mpdf = new mPDF();
        $this->mpdf->AddPage('p', // L - landscape, P - portrait
            '', '', '', '',
            5, // margin_left
            5, // margin right
            5, // margin top
            0, // margin bottom
            0, // margin header
            5); // margin footer
    $this->mpdf->WriteHTML($html);
    $this->mpdf->Output($id.'-'.'.pdf', 'I');
    }

    //FOR JS

    function get_kontak_detail($id)
    {
        $up = getValue('up', 'kontak', array('id'=>'where/'.$id));
        $alamat = getValue('alamat', 'kontak', array('id'=>'where/'.$id));

        echo json_encode(array('up'=>$up, 'alamat'=>$alamat));

    }

    function get_nama_barang($id)
    {
        $q = getValue('title', 'barang', array('id'=>'where/'.$id));

        echo json_encode($q);

    }
    
    function get_dari_so($id)
    {
        permissionUser();

         $num_rows = getAll($this->table_name)->num_rows();
        $last_id = ($num_rows>0) ? $this->db->select('id')->order_by('id', 'asc')->get($this->table_name)->last_row()->id : 0;
        $this->data['last_id'] = ($num_rows>0) ? $last_id+1 : 1;
        $this->data['order'] = $this->main->get_detail_so($id);
        $this->data['order_list'] = $this->main->get_list_detail_so($id);
        $this->data['pajak_komponen'] = getAll('pajak_komponen')->result();
        $this->load->view($this->module.'/'.$this->file_name.'/dari_so', $this->data);
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