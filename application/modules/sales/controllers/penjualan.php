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
        $this->data['ppn_val'] = getValue('value', 'pajak_value', array('id'=>'where/1'));
        $this->data['pph22_val'] = getValue('value', 'pajak_value', array('id'=>'where/2'));
        $this->data['pph23_val'] = getValue('value', 'pajak_value', array('id'=>'where/3'));
        //$this->data['so'] = GetAllSelect('sales_order', array('id','so'), array('id'=>'order/desc'))->result();
        $this->data['so'] = GetAllSelect('stok_pengeluaran', array('id', 'created_on'), array('id'=>'order/desc'))->result();
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
                        'ref_id'=>$this->input->post('ref_id'),
                        'deskripsi'=>$this->input->post('deskripsi'),
                        'diterima'=>$this->input->post('jumlah'),
                        'diorder'=>$this->input->post('diorder'),
                        'satuan'=>$this->input->post('satuan'),
                        'harga'=>$this->input->post('harga'),
                        'disc'=>$this->input->post('disc'),
                        'pajak'=>$this->input->post('pajak'),
                        'catatan_barang'=>$this->input->post('catatan_barang'),
                        'inc_ppn'=>$this->input->post('pajak_checkbox1'),
                        );

        $data = array(
                'no' => $this->input->post('no'),
                'no_sj'=> $this->input->post('no_sj'),
                'kontak_id'=>$this->input->post('kontak_id'),
                'up'=>'',
                'alamat'=>'',
                'project'=>$this->input->post("project"),
                'no_faktur'=>$this->input->post("no_faktur"),
                'metode_pembayaran_id'=>$this->input->post('metode_pembayaran_id'),
                'tanggal_transaksi'=>date('Y-m-d',strtotime($this->input->post('tanggal_transaksi'))),
                'tanggal_pengantaran'=>date('Y-m-d',strtotime($this->input->post('tanggal_pengiriman'))),
                'so'=>$this->input->post('so'),
                'gudang_id'=>$this->input->post('gudang_id'),
                'jatuh_tempo_pembayaran'=>date('Y-m-d',strtotime($this->input->post('tanggal_transaksi'))),
                'kurensi_id'=>$this->input->post('kurensi_id'),
                'biaya_pengiriman'=>str_replace(',', '', $this->input->post('biaya_pengiriman')),
                'dibayar'=>str_replace(',', '', $this->input->post('dibayar')),
                'saldo'=>str_replace(',', '', $this->input->post('saldo')),
                'dibayar_nominal'=>str_replace(',', '', $this->input->post('dibayar-nominal')),
                'lama_angsuran_1' =>$this->input->post('lama_angsuran_1'),
                'lama_angsuran_2' =>$this->input->post('lama_angsuran_2'),
                'bunga' =>str_replace(',', '', $this->input->post('bunga')),
                'catatan' =>$this->input->post('catatan'),
                'pajak_komponen_id' =>(!empty($this->input->post('pajak_komponen_id'))) ? implode(',',$this->input->post('pajak_komponen_id')) : '',
                'total_ppn' => str_replace(',', '', $this->input->post('total-ppn')),
                'total_pph22' => str_replace(',', '', $this->input->post('total-pph22')),
                'total_pph23' => str_replace(',', '', $this->input->post('total-pph23')),
                'total_diskon' => str_replace(',', '', $this->input->post('total-diskon')),
                'created_by' => sessId(),
                'created_on' => dateNow(),
            );

        $this->db->insert($this->table_name, $data);
        $insert_id = $this->db->insert_id();
        for($i=0;$i<sizeof($list['kode_barang']);$i++):
            $data2 = array(
                $this->file_name.'_id' => $insert_id,
                'ref_id' => $list['ref_id'][$i],
                'kode_barang' => $list['kode_barang'][$i],
                'deskripsi' => $list['deskripsi'][$i],
                'diterima' => str_replace(',', '', $list['diterima'][$i]),
                'diorder' => str_replace(',', '', $list['diorder'][$i]),
                'satuan_id' => $list['satuan'][$i],
                'inc_ppn' => $list['inc_ppn'][$i],
                'harga' => str_replace(',', '', $list['harga'][$i]),
                'disc' => str_replace(',', '', $list['disc'][$i]),
                'pajak' => str_replace(',', '', $list['pajak'][$i]),
                'catatan' => str_replace(',', '', $list['catatan_barang'][$i]),
                );
        $this->db->insert($this->table_name.'_list', $data2);
        $this->load->library('upload');
        $this->upload->initialize($this->set_upload_options());
        if($this->upload->do_multi_upload("attachment")){
            $up = $this->upload->get_multi_upload_data();
            $att = array(
                    'attachment' => $up[$i]['file_name'],
                );
            $this->db->where('kode_barang', $list['kode_barang'][$i])->where($this->file_name.'_id', $insert_id)->update($this->table_name.'_list', $att);
        }else{
            $att = $this->input->post('attachment');
            $attx = (!empty($att[$i])) ? $att[$i] : '';
            $this->db->where('kode_barang', $list['kode_barang'][$i])->where($this->file_name.'_id', $insert_id)->update($this->table_name.'_list', array('attachment'=> $attx));
        }
        endfor;
        redirect($this->module.'/'.$this->file_name, 'refresh');
    }

    private function set_upload_options()
    {   
        if(!is_dir('./'.'uploads')){
        mkdir('./'.'uploads/', 0777);
        }
        if(!is_dir('./uploads/sale/')){
        mkdir('./uploads/sale/', 0777);
        }
        if(!is_dir('./uploads/sale/'.sessId())){
        mkdir('./uploads/sale/'.sessId(), 0777);
        }

        $config =  array(
          'upload_path'     => './uploads/sale/',
          'allowed_types'   => '*',
          'overwrite'       => TRUE,
        );    

        return $config;
    }

    public function ajax_list()
    {
        $list = $this->main->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $detail = base_url().$this->module.'/'.$this->file_name.'/detail/'.$r->id;
            $print = base_url().$this->module.'/'.$this->file_name.'/print_pdf/'.$r->id;
            $delete = ($r->created_by == sessId() || $this->ion_auth->is_admin() == true) ? '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_user('."'".$r->id."'".')"><i class="glyphicon glyphicon-trash"></i></a>' : '';
             //$print = base_url()."print/file/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=invoice.mrt&param1=".$r->id;
             $sj_date = getValue("created_on", "stok_pengeluaran", array('id'=>'where'.$r->id));
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = "<a href=$detail>#".$r->no.'</a>';
            $row[] = date('Ymd', strtotime($sj_date)).sprintf('%04d',$r->no_sj);
            $row[] = $r->kontak;
            $row[] = $r->tanggal_transaksi;
            $row[] = $r->tanggal_pengantaran;
            $row[] = $r->gudang;
            $row[] = getName($r->created_by);

            $row[] ="<a class='btn btn-sm btn-primary' href=$detail title='detail'><i class='fa fa-info'></i></a>
                    <a class='btn btn-sm btn-light-azure' href=$print target='_blank' title='detail'><i class='fa fa-print'></i></a>
                    $delete
                    ";
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

    public function ajax_delete($id)
    {
        $this->main->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
    
    function print_pdf($id)
    {
        permissionUser();
        $this->data['id'] = $id;
        $this->data['o'] = $this->main->get_detail($id)->row();
        $this->data['penjualan_list'] = $this->main->get_list_detail($id);

        //Variabel for total-field

        $total_harga = getSum('harga', 'penjualan_list', 'penjualan_id', $id);
        $total_barang = getSum('diterima', 'penjualan_list', 'penjualan_id', $id);

        $tot = GetAllSelect('penjualan_list', "diterima, harga", array('penjualan_id'=>'where/'.$id))->result();
        $total = 0;
        foreach($tot as $t):
            $total += $t->diterima * $t->harga;
        endforeach;

        $total = $total;
        $is_exc = GetAllSelect('penjualan_list', "inc_ppn, pajak", array('penjualan_id'=>'where/'.$id))->result();
        $exc = 0;
        foreach($is_exc as $i):
            if($i->inc_ppn == 0){
                $exc += $i->pajak;
            }
        endforeach;

        //print_mz($exc);
        $total_ppn = getSum('total_ppn', 'penjualan', 'id', $id);
        $total_pph22 = getSum('total_pph22', 'penjualan', 'id', $id);
        $total_pph23 = getSum('total_pph23', 'penjualan', 'id', $id);
        $biaya_pengiriman = getSum('biaya_pengiriman', 'penjualan', 'id', $id);
        $dibayar = getSum('dibayar', 'penjualan', 'id', $id);
        $dibayar_nominal = getSum('dibayar_nominal', 'penjualan', 'id', $id);

        //Total Field
        $this->data['total_diskon'] = $total_diskon = getValue('total_diskon', 'penjualan', array('id'=>'where/'.$id));
        $dp_nominal = getValue('dibayar_nominal', 'penjualan', array('id'=>'where/'.$id));
        $this->data['metode_pembayaran_id'] = getValue('metode_pembayaran_id', 'penjualan', array('id'=>'where/'.$id));
        $this->data['total_pajak'] = $total_pajak = $total_ppn + $total_pph22 + $total_pph23;//print_mz($total_pajak);
        $this->data['total'] = $sub_total = $total+$biaya_pengiriman-$total_pajak+$exc-$total_diskon;
        $this->data['totalpluspajak'] = $totalpluspajak = $sub_total + $total_pajak;
        $dp_persen = $totalpluspajak * ($dibayar/100);
        $this->data['dp'] = $dp = $dp_nominal + $dp_persen;
        $this->data['saldo'] = $totalpluspajak - $dp;

        $this->load->library('mpdf60/mpdf');
        $html = $this->load->view($this->module.'/'.$this->file_name.'/pdf', $this->data, true); 
        $footer = $this->load->view($this->module.'/'.$this->file_name.'/pdf_footer', $this->data, true); 
        $this->mpdf = new mPDF();
        $this->mpdf->setFooter($footer);
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
        $this->data['pengeluaran'] = GetAll('stok_pengeluaran',array('id'=>'where/'.$id))->row_array();
        $num_rows = getAll($this->table_name)->num_rows();
        $last_id = ($num_rows>0) ? $this->db->select('id')->order_by('id', 'asc')->get($this->table_name)->last_row()->id : 0;
        $this->data['last_id'] = ($num_rows>0) ? $last_id+1 : 1;
        $this->data['order'] = $this->main->get_detail_so($this->data['pengeluaran']['ref']);
        $this->data['order_list'] = $this->main->get_list_detail_so($id);
        $this->data['kurensi'] = getAll('kurensi')->result();
        $this->data['metode'] = getAll('metode_pembayaran')->result();
        $this->data['gudang'] = getAll('gudang')->result();
        $this->data['options_kontak'] = options_row('main','get_kontak','id','title','-- Pilih Customer --');
        $this->data['pajak_komponen'] = getAll('pajak_komponen',array(), array('!=id'=>'1'))->result();
        $this->data['ppn_val'] = getValue('value', 'pajak_value', array('id'=>'where/1'));
        $this->data['pph22_val'] = getValue('value', 'pajak_value', array('id'=>'where/2'));
        $this->data['pph23_val'] = getValue('value', 'pajak_value', array('id'=>'where/3'));
        if(!empty($this->data['order']->result())){
            $this->load->view($this->module.'/'.$this->file_name.'/dari_so', $this->data);
        }else{    
            $this->load->view($this->module.'/'.$this->file_name.'/so_kosong', $this->data);
        }
    }

    function get_dari_so_lain($id)
    {
        permissionUser();
        $row_count = $this->input->post('row_count');
        $this->data['row_count'] = $row_count + 1;
        $this->data['order_list'] = $this->main->get_list_detail_so($id);
        $this->load->view($this->module.'/'.$this->file_name.'/dari_so_lain', $this->data);
    }

    function add_so(){
        permissionUser();

        //$this->data['so'] = GetAllSelect('sales_order', array('id','so'), array('id'=>'order/desc'))->result();
        $this->data['so'] = GetAllSelect('stok_pengeluaran', array('id', 'created_on'), array('id'=>'order/desc'))->result();
        $this->load->view($this->module.'/'.$this->file_name.'/no_so', $this->data);
    }

    function get_table()
    {
        $id = $this->input->post('id');
        $id = substr_replace($id, '', -1);
        //$this->data['list'] = GetAll('stok_pengeluaran_list',array('pengeluaran_id'=>'where/'.$id));
        $this->data['list'] = $this->main->get_list_detail_so($id);
        $this->load->view($this->module.'/'.$this->file_name.'/table', $this->data);
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