<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MX_Controller {
    public $data;
    var $module = 'sales';
    var $title = 'Order';
    var $file_name = 'order';
    var $main_title = 'Sales Order';
    var $table_name = 'sales_order';
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
        $this->data['options_kontak'] = options_row('order','get_kontak','id','title','-- Pilih Customer --');
        $this->data['pajak_komponen'] = getAll('pajak_komponen')->result();
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
        $this->data['order'] = $this->order->get_detail($id);
        $this->data['order_list'] = $this->order->get_list_detail($id);

        $this->_render_page($this->module.'/'.$this->file_name.'/detail', $this->data);
    }

    function add_draft()
    {
        permissionUser();
        $po = $this->input->post('so');
        $list = array(
                        'kode_barang'=>$this->input->post('kode_barang'),
                        'deskripsi' => $this->input->post('deskripsi'),
                        'jumlah'=>$this->input->post('jumlah'),
                        'satuan'=>$this->input->post('satuan'),
                        'harga'=>$this->input->post('harga'),
                        'disc'=>$this->input->post('disc'),
                        'pajak'=>$this->input->post('pajak'),
                        );//print_mz($list);
        $data = array(
                'no' => $this->input->post('no'),
                'kontak_id'=>$this->input->post('kontak_id'),
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
                'dibayar_nominal'=>str_replace(',', '', $this->input->post('dibayar-nominal')),
                'lama_angsuran_1' =>$this->input->post('lama_angsuran_1'),
                'lama_angsuran_2' =>$this->input->post('lama_angsuran_2'),
                'bunga' =>str_replace(',', '', $this->input->post('bunga')),
                'catatan' =>$this->input->post('catatan'),
                'project' =>$this->input->post('project'),
                'pajak_komponen_id' =>(!empty($this->input->post('pajak_komponen_id'))) ? implode(',',$this->input->post('pajak_komponen_id')) : '',
                'total_ppn' => str_replace(',', '', $this->input->post('total-ppn')),
                'total_pph22' => str_replace(',', '', $this->input->post('total-pph22')),
                'total_pph23' => str_replace(',', '', $this->input->post('total-pph23')),
                'created_by' => sessId(),
                'created_on' => dateNow(),
                'is_draft' => 1
            );
        $num_rows = GetAllSelect($this->table_name, 'id', array('id'=>'where/'.$po))->num_rows();
        if($num_rows>0){
            $this->db->where('so', $po)->update($this->table_name, $data);
            $insert_id = getValue('id', $this->table_name, array('id'=>'where/'.$po));
        }else{
            $this->db->insert($this->table_name, $data);
            $insert_id = $this->db->insert_id();
        }
        $this->db->where($this->file_name.'_id', $insert_id)->delete($this->table_name.'_list');
        for($i=0;$i<sizeof($list['kode_barang']);$i++):
            $data2 = array(
                'order_id' => $insert_id,
                'kode_barang' => $list['kode_barang'][$i],
                'deskripsi' => $list['deskripsi'][$i],
                'jumlah' => str_replace(',', '', $list['jumlah'][$i]),
                'satuan_id' => $list['satuan'][$i],
                'harga' => str_replace(',', '', $list['harga'][$i]),
                'disc' => str_replace(',', '', $list['disc'][$i]),
                'pajak' => str_replace(',', '', $list['pajak'][$i]),
                );
        $num_rows_list = getAll($this->table_name.'_list', array('kode_barang'=>'where/'.$list['kode_barang'][$i], $this->file_name.'_id'=>'where/'.$insert_id))->num_rows();
        if($num_rows_list>0){
            $this->db->where('kode_barang', $list['kode_barang'][$i])->where($this->file_name.'_id', $insert_id)->update($this->table_name.'_list', $data2);
        }else{
        $this->db->insert($this->table_name.'_list', $data2);
        }
        endfor;
        echo json_encode(array('status'=>true));
    }

    function add()
    {
        $po = $this->input->post('so');
        permissionUser();
        $list = array(
                        'kode_barang'=>$this->input->post('kode_barang'),
                        'deskripsi' => $this->input->post('deskripsi'),
                        'jumlah'=>$this->input->post('jumlah'),
                        'satuan'=>$this->input->post('satuan'),
                        'harga'=>$this->input->post('harga'),
                        'disc'=>$this->input->post('disc'),
                        'pajak'=>$this->input->post('pajak'),
                        );

        $data = array(
                'no' => $this->input->post('no'),
                'kontak_id'=>$this->input->post('kontak_id'),
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
                'dibayar_nominal'=>str_replace(',', '', $this->input->post('dibayar-nominal')),
                'lama_angsuran_1' =>$this->input->post('lama_angsuran_1'),
                'lama_angsuran_2' =>$this->input->post('lama_angsuran_2'),
                'bunga' =>str_replace(',', '', $this->input->post('bunga')),
                'catatan' =>$this->input->post('catatan'),
                'project' =>$this->input->post('project'),
                'pajak_komponen_id' =>(!empty($this->input->post('pajak_komponen_id'))) ? implode(',',$this->input->post('pajak_komponen_id')) : '',
                'total_ppn' => str_replace(',', '', $this->input->post('total-ppn')),
                'total_pph22' => str_replace(',', '', $this->input->post('total-pph22')),
                'total_pph23' => str_replace(',', '', $this->input->post('total-pph23')),
                'created_by' => sessId(),
                'created_on' => dateNow(),
                'is_draft' => 0
            );

        $num_rows = GetAllSelect($this->table_name, 'id', array('id'=>'where/'.$po))->num_rows();
        if($num_rows>0){
            $this->db->where('so', $po)->update($this->table_name, $data);
            $insert_id = getValue('id', $this->table_name, array('id'=>'where/'.$po));
        }else{
            $this->db->insert($this->table_name, $data);
            $insert_id = $this->db->insert_id();
        }
        $this->db->where($this->file_name.'_id', $insert_id)->delete($this->table_name.'_list');
        for($i=0;$i<sizeof($list['kode_barang']);$i++):
            $data2 = array(
                'order_id' => $insert_id,
                'kode_barang' => $list['kode_barang'][$i],
                'deskripsi' => $list['deskripsi'][$i],
                'jumlah' => str_replace(',', '', $list['jumlah'][$i]),
                'satuan_id' => $list['satuan'][$i],
                'harga' => str_replace(',', '', $list['harga'][$i]),
                'disc' => str_replace(',', '', $list['disc'][$i]),
                'pajak' => str_replace(',', '', $list['pajak'][$i]),
                );
        $num_rows_list = getAll($this->table_name.'_list', array('kode_barang'=>'where/'.$list['kode_barang'][$i], $this->file_name.'_id'=>'where/'.$insert_id))->num_rows();
        if($num_rows_list>0){
            $this->db->where('kode_barang', $list['kode_barang'][$i])->where($this->file_name.'_id', $insert_id)->update($this->table_name.'_list', $data2);
        }else{
        $this->db->insert($this->table_name.'_list', $data2);
        }
        endfor;
        $this->send_notif($insert_id);
        redirect($this->module.'/'.$this->file_name, 'refresh');
    }

    function draft($id){
        $this->data['title'] = $this->title.' - Input';
        permissionUser();
         $this->data['id'] = $id;
        $this->data[$this->file_name] = $this->order->get_detail($id);
        $this->data[$this->file_name.'_list'] = $this->order->get_list_detail($id);
        $this->data['barang'] = getAll('barang')->result_array();
        $this->data['satuan'] = getAll('satuan')->result_array();
        $this->data['kurensi'] = getAll('kurensi')->result();
        $this->data['metode'] = getAll('metode_pembayaran')->result();
        $this->data['gudang'] = getAll('gudang')->result();
        $this->data['users'] = getAll('users');
        $this->data['pajak_komponen'] = getAll('pajak_komponen')->result();
        $this->data['kontak'] = getAll('kontak', array('jenis_id'=>'where/2'));
        $this->_render_page($this->module.'/'.$this->file_name.'/draft', $this->data);
    }

    public function ajax_list()
    {
        $list = $this->order->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $detail = base_url().$this->module.'/'.$this->file_name.'/detail/'.$r->id;
            $print = base_url().$this->module.'/'.$this->file_name.'/print_pdf/'.$r->id;
            $draft = base_url().$this->module.'/'.$this->file_name.'/draft/'.$r->id;
            $no++;
            $row = array();
            $row[] = $no;
           $row[] = ($r->is_draft == 1)?"<a href=$draft>#".$r->so.'</a>' : "<a href=$detail>#".$r->so.'</a>';
            $row[] = $r->kontak;
            $row[] = $r->tanggal_transaksi;
            //$row[] = $r->metode_pembayaran;
            $row[] = $r->gudang;
            $row[] = ($r->is_draft == 1) ? "Draft" : "Submitted";

            if($r->is_draft == 1){
                if($r->created_by == sessId()):
                    $row[] = '<a class="btn btn-sm btn-primary" href='.$draft.' title="Edit Draft"><i class="fa fa-pencil"></i></a>
                      <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_user('."'".$r->id."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
                else:
                    $row[] = '';
                endif;
            }else{
            $row[] ="<a class='btn btn-sm btn-primary' href=$detail title='detail'><i class='fa fa-info'></i></a>
                    <a class='btn btn-sm btn-light-azure' href=$print target='_blank' title='detail'><i class='fa fa-print'></i></a>";
            }
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

    public function ajax_delete($id)
    {
        $this->order->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    function print_pdf($id)
    {
        permissionUser();
        $this->data['id'] = $id;
        $this->data['order'] = $this->order->get_detail($id);
        $this->data['order_list'] = $this->order->get_list_detail($id);
        
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

    function send_notif($id)
    {
        $group_id = array('3','4','8','9','10');
        $user_id = $this->db->select('user_id')->where_in('group_id', $group_id)->get('users_groups')->result();
        $subject = 'Pembuatan Sales Order'; 
        $url = base_url().$this->module.'/'.$this->file_name.'/detail/'.$id;
        $isi = $isi = getName(sessId())." membuat sales Order, Untuk melihat detail silakan <a href=$url> KLIK DISINI </a>.";
        foreach($user_id as $u):
            $data = array('sender_id' => sessId(),
                          'receiver_id' => $u->user_id,
                          'sent_on' => dateNow(),
                          'judul' => $subject,
                          'isi' => $isi,
                          'url' => $url,
             );
            $this->db->insert('notifikasi', $data);
            //$this->send_email(getEmail($u->user_id), $subject, $isi);
        endforeach;
    }

    //FOR JS

    function add_row($id)
    {
        $data['id'] = $id;
        $data['barang'] = getAll('barang')->result_array();
        $data['satuan'] = getAll('satuan')->result_array();
        $this->load->view('order/row', $data);
    }

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
                }elseif(in_array($view, array($this->module.'/'.$this->file_name.'/input',
                                              $this->module.'/'.$this->file_name.'/draft'
                                                )))
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