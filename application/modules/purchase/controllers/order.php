<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MX_Controller {
    public $data;
    var $module = 'purchase';
    var $title = 'Order';
    var $file_name = 'order';
    var $table_name = 'purchase_order';
    
    function __construct()
    {
        parent::__construct();
        $this->load->model($this->module.'/'.$this->file_name.'_model', 'main');
    }

    function index()
    {
        //print_mz(number_format(90.21, 2));
        $this->data['title'] = $this->title;
        $this->data['main_title'] = $this->module.' Order';
        permissionUser();
        $this->_render_page($this->module.'/'.$this->file_name.'/index', $this->data);
    }

    function draft($id){
        $this->data['title'] = $this->title.' - Input';
        permissionUser();
         $this->data['id'] = $id;
        $this->data[$this->file_name] = $this->main->get_detail($id);
        $this->data[$this->file_name.'_list'] = $this->main->get_list_detail($id);
        $this->data['barang'] = getAll('barang')->result_array();
        $this->data['satuan'] = getAll('satuan')->result_array();
        $this->data['kurensi'] = getAll('kurensi')->result();
        $this->data['metode'] = getAll('metode_pembayaran')->result();
        $this->data['gudang'] = getAll('gudang')->result();
        $this->data['users'] = getAll('users');
        $this->data['pajak_komponen'] = getAll('pajak_komponen')->result();
        $this->data['kontak'] = getAll('kontak', array('jenis_id'=>'where/1'));
        $this->_render_page($this->module.'/'.$this->file_name.'/draft', $this->data);
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
        $this->data['options_kontak'] = options_row('main','get_kontak','id','title','-- Pilih Supplier --');
        $this->data['pr'] = GetAllSelect('purchase_request', array('id','no'), array('id'=>'order/desc','app_status_id_lv4'=>'where/1', 'limit'=>'limit/100'))->result();
        $this->_render_page($this->module.'/'.$this->file_name.'/input', $this->data);
    }

    function detail($id)
    {
        $this->data['title'] = $this->title.' - Detail';
        permissionUser();
        $this->data['id'] = $id;
        $this->data[$this->file_name] = $this->main->get_detail($id);
        $this->data[$this->file_name.'_list'] = $this->main->get_list_detail($id);
        $no_pr = getValue('no', 'purchase_order', array('id'=>'where/'.$id));
        $this->data['user_app_lv1'] = getValue('created_by', 'purchase_request', array('id'=>'where/'.$no_pr));
        $this->data['user_app_lv2'] = getValue('user_id', 'approver', array('level'=>'where/1'));
        $this->data['user_app_lv3'] = getValue('user_id', 'approver', array('level'=>'where/2'));
        $this->data['user_app_lv4'] = getValue('user_id', 'approver', array('level'=>'where/3'));
        $this->data['jabatan_lv1'] = getUserGroup($this->data['user_app_lv1']);
        $this->data['jabatan_lv2'] = getValue('jabatan', 'approver', array('level'=>'where/1'));
        $this->data['jabatan_lv3'] = getValue('jabatan', 'approver', array('level'=>'where/2'));
        $this->data['jabatan_lv4'] = getValue('jabatan', 'approver', array('level'=>'where/3'));
        $this->_render_page($this->module.'/'.$this->file_name.'/detail', $this->data);
    }

    function add_draft()
    {
        permissionUser();
        //print_mz($this->input->post('attachment'));
        $po = $this->input->post('po');
        $list = array(
                        'kode_barang'=>$this->input->post('kode_barang'),
                        'deskripsi'=>$this->input->post('deskripsi'),
                        'jumlah'=>$this->input->post('jumlah'),
                        'satuan'=>$this->input->post('satuan'),
                        'harga'=>$this->input->post('harga'),
                        'disc'=>$this->input->post('disc'),
                        'pajak'=>$this->input->post('pajak'),
                        'catatan_barang'=>$this->input->post('catatan_barang'),
                        );
        $data = array(
                'no' => implode(',',$this->input->post('no')),
                'kontak_id'=>$this->input->post('kontak_id'),
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
                'dibayar_nominal'=>str_replace(',', '', $this->input->post('dibayar-nominal')),
                'lama_angsuran_1' =>$this->input->post('lama_angsuran_1'),
                'lama_angsuran_2' =>$this->input->post('lama_angsuran_2'),
                'bunga' =>str_replace(',', '', $this->input->post('bunga')),
                'gtotal' =>str_replace(',', '', $this->input->post('gtotal')),
                'catatan' =>$this->input->post('catatan'),
                'proyek' =>$this->input->post('proyek'),
                'pajak_komponen_id' =>(!empty($this->input->post('pajak_komponen_id'))) ? implode(',',$this->input->post('pajak_komponen_id')) : '',
                'total_ppn' => str_replace(',', '', $this->input->post('total-ppn')),
                'total_pph22' => str_replace(',', '', $this->input->post('total-pph22')),
                'total_pph23' => str_replace(',', '', $this->input->post('total-pph23')),
                'diskon_tambahan_nominal' => str_replace(',', '', $this->input->post('diskon_tambahan_nominal')),
                'diskon_tambahan_persen' => str_replace(',', '', $this->input->post('diskon_tambahan_persen')),
                'created_by' => sessId(),
                'created_on' => dateNow(),
                'is_draft' => 1
            );
        $num_rows = GetAllSelect($this->table_name, 'id', array('id'=>'where/'.$po))->num_rows();
        if($num_rows>0){
            $this->db->where('po', $po)->update($this->table_name, $data);
            $insert_id = getValue('id', $this->table_name, array('id'=>'where/'.$po));
        }else{
            $this->db->insert($this->table_name, $data);
            $insert_id = $this->db->insert_id();
        }
        $this->db->where($this->file_name.'_id', $insert_id)->delete($this->table_name.'_list');
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
                'catatan' => $list['catatan_barang'][$i],
                );
        $num_rows_list = getAll($this->table_name.'_list', array('kode_barang'=>'where/'.$list['kode_barang'][$i], $this->file_name.'_id'=>'where/'.$insert_id))->num_rows();
        if($num_rows_list>0){
            $this->db->where('kode_barang', $list['kode_barang'][$i])->where($this->file_name.'_id', $insert_id)->update($this->table_name.'_list', $data2);
        }else{
        $this->db->insert($this->table_name.'_list', $data2);
        }
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
        echo json_encode(array('status'=>true));
    }

    function add()
    {
        $po = $this->input->post('po');
        $btn = $this->input->post('btnDraft');
        //print_mz($btn);
        if($btn == "Submit"){
            $type = 0;
        }else{
            $type = 1;
        }
        permissionUser();
        $list = array(
                        'request_id'=>$this->input->post('request_id'),
                        'kode_barang'=>$this->input->post('kode_barang'),
                        'deskripsi'=>$this->input->post('deskripsi'),
                        'jumlah'=>$this->input->post('jumlah'),
                        'satuan'=>$this->input->post('satuan'),
                        'harga'=>$this->input->post('harga'),
                        'disc'=>$this->input->post('disc'),
                        'pajak'=>$this->input->post('pajak'),
                        'catatan_barang'=>$this->input->post('catatan_barang'),
                        );
        //$approver = $this->input->post('approver');
        $data = array(
                'no' => implode(',',$this->input->post('no')),
                'kontak_id'=>$this->input->post('kontak_id'),
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
                'dibayar_nominal'=>str_replace(',', '', $this->input->post('dibayar-nominal')),
                'lama_angsuran_1' =>$this->input->post('lama_angsuran_1'),
                'lama_angsuran_2' =>$this->input->post('lama_angsuran_2'),
                'bunga' =>str_replace(',', '', $this->input->post('bunga')),
                'gtotal' =>str_replace(',', '', $this->input->post('gtotal')),
                'saldo' =>str_replace(',', '', $this->input->post('saldo')),
                'catatan' =>$this->input->post('catatan'),
                'proyek' =>$this->input->post('proyek'),
                'pajak_komponen_id' =>(!empty($this->input->post('pajak_komponen_id'))) ? implode(',',$this->input->post('pajak_komponen_id')) : '',
                'total_ppn' => str_replace(',', '', $this->input->post('total-ppn')),
                'total_pph22' => str_replace(',', '', $this->input->post('total-pph22')),
                'total_pph23' => str_replace(',', '', $this->input->post('total-pph23')),
                'diskon_tambahan_nominal' => str_replace(',', '', $this->input->post('diskon_tambahan_nominal')),
                'diskon_tambahan_persen' => str_replace(',', '', $this->input->post('diskon_tambahan_persen')),
                'created_by' => sessId(),
                'created_on' => date('Y-m-d',strtotime($this->input->post('created_on'))),
                'is_draft' => $type
            );

        $num_rows = GetAllSelect($this->table_name, 'id', array('id'=>'where/'.$po))->num_rows();
        if($num_rows>0){
            $this->db->where('po', $po)->update($this->table_name, $data);
            $insert_id = getValue('id', $this->table_name, array('id'=>'where/'.$po));
        }else{
            $this->db->insert($this->table_name, $data);
            $insert_id = $this->db->insert_id();
        }
        $this->db->where($this->file_name.'_id', $insert_id)->delete($this->table_name.'_list');
        for($i=0;$i<sizeof($list['kode_barang']);$i++):
            $data2 = array(
                $this->file_name.'_id' => $insert_id,
                'kode_barang' => $list['kode_barang'][$i],
                'request_id' => $list['request_id'][$i],
                'deskripsi' => $list['deskripsi'][$i],
                'jumlah' => str_replace(',', '', $list['jumlah'][$i]),
                'satuan_id' => $list['satuan'][$i],
                'catatan' => $list['catatan_barang'][$i],
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
        if($this->input->post('metode_pembayaran_id') == 2)$this->insert_hutang($insert_id);
        if($type != 1)$this->send_notification($insert_id);
        redirect($this->module.'/'.$this->file_name, 'refresh');
    }

    private function set_upload_options()
    {   
        if(!is_dir('./'.'uploads')){
        mkdir('./'.'uploads/', 0777);
        }
        if(!is_dir('./uploads/po/')){
        mkdir('./uploads/po/', 0777);
        }
        if(!is_dir('./uploads/po/'.sessId())){
        mkdir('./uploads/po/'.sessId(), 0777);
        }

        $config =  array(
          'upload_path'     => './uploads/pr/',
          'allowed_types'   => '*',
          'overwrite'       => TRUE,
        );    

        return $config;
    }

    function insert_hutang($id){
        $po = getAll($this->table_name, array('id'=>'where/'.$id))->row();
        
        $data = array(
                'kontak_id' => $po->kontak_id,
                'kurensi_id' => $po->kurensi_id,
                'terbayar' => 0,
                'total'=> $po->saldo,
            );

        $this->db->insert('purchase_hutang_list', $data);
    }

    function send_notification($id)
    { 
        permissionUser();
        $url = base_url().$this->module.'/'.$this->file_name.'/detail/'.$id;
        $subject = 'Pengajuan Purchase Order';
        $isi = getName(sessId())." Mengajuan Purchase Order, Untuk melakukan approval silakan <a href=$url> KLIK DISINI </a>.";
        $approver = getAll('approver');
        $no_pr = getValue('no', 'purchase_order', array('id'=>'where/'.$id));
        $no = getValue('po', $this->table_name, array('id'=>'where/'.$id));
        $creator_pr = getValue('created_by', 'purchase_request', array('id'=>'where/'.$no_pr));
        $jenis = getValue('jenis_barang_id', 'purchase_request', array('id'=>'where/'.$no_pr));
        $gtotal = getValue('gtotal', 'purchase_order', array('id'=>'where/'.$id));
        $data = array('sender_id' => sessId(),
                          'receiver_id' => $creator_pr,
                          'sent_on' => dateNow(),
                          'judul' => $subject,
                          'no' => $no,
                          'isi' => $isi,
                          'url' => $url,
             );
        $this->db->insert('notifikasi', $data);
        $this->send_email(getEmail($creator_pr), $subject, $isi);
        if($jenis == 3):
            if($gtotal > 1000000){
            $level = array('level' => 'where/3',
                       'level' => 'where/2',
                       'level' => 'where/1'
                       );
            $list = array(1,2,3);
            $approver = $this->db->where_in('level', $list)->get('approver');
            }else{
                $level = array(
                       'level' => 'where/1'
                       );
                 $list = array(1);
            $approver = $this->db->where_in('level', $list)->get('approver');
            }
        else:
            $level = array('level' => 'where/3',
                       'level' => 'where/2',
                       );
         $list = array(2,3);
            $approver = $this->db->where_in('level', $list)->get('approver');
        endif;
        foreach($approver->result() as $r):
            $data = array('sender_id' => sessId(),
                          'receiver_id' => $r->user_id,
                          'sent_on' => dateNow(),
                          'judul' => $subject,
                          'no' => $no,
                          'isi' => $isi,
                          'url' => $url,
             );
        $this->db->insert('notifikasi', $data);
        $this->send_email(getEmail($r->user_id), $subject, $isi);
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
            //$print = base_url()."print/file/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_report_key=po.mrt&param1=".$r->id;
            $draft = base_url().$this->module.'/'.$this->file_name.'/draft/'.$r->id;
            $delete = ($r->created_by == sessId() || $this->ion_auth->is_admin() == true) ? '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_user('."'".$r->id."'".')"><i class="glyphicon glyphicon-trash"></i></a>' : '';
            $status1 = ($r->app_status_id_lv1==1) ? '<i title="Approved" class="fa fa-check" style="color:green"></i>' : (($r->app_status_id_lv1 == 2) ? '<i title="rejected" class="fa fa-remove" style="color:red"></i>' : (($r->app_status_id_lv1 == 3) ? '<i title="Pending" class="fa fa-info" style="color:orange"></i>'  : '<i class="fa fa-question"></i>'));
            $status2 = ($r->app_status_id_lv2==1) ? '<i title="Approved" class="fa fa-check" style="color:green"></i>' : (($r->app_status_id_lv2 == 2) ? '<i title="rejected" class="fa fa-remove" style="color:red"></i>' : (($r->app_status_id_lv2 == 3) ? '<i title="Pending" class="fa fa-info" style="color:orange"></i>'  : '<i class="fa fa-question"></i>'));
            $status3 = ($r->app_status_id_lv3==1) ? '<i title="Approved" class="fa fa-check" style="color:green"></i>' : (($r->app_status_id_lv3 == 2) ? '<i title="rejected" class="fa fa-remove" style="color:red"></i>' : (($r->app_status_id_lv3 == 3) ? '<i title="Pending" class="fa fa-info" style="color:orange"></i>'  : '<i title="No Respond" class="fa fa-question"></i>'));


        $no_pr = getValue('no', 'purchase_order', array('id'=>'where/'.$r->id));
        $creator_pr = getValue('created_by', 'purchase_request', array('id'=>'where/'.$no_pr));
        $jenis = getValue('jenis_barang_id', 'purchase_request', array('id'=>'where/'.$no_pr));
        $gtotal = getValue('gtotal', 'purchase_order', array('id'=>'where/'.$r->id));
        if($jenis == 3):
            if($gtotal > 1000000){
                $status2 = ($r->app_status_id_lv2==1) ? '<i title="Approved" class="fa fa-check" style="color:green"></i>' : (($r->app_status_id_lv2 == 2) ? '<i title="rejected" class="fa fa-remove" style="color:red"></i>' : (($r->app_status_id_lv2 == 3) ? '<i title="Pending" class="fa fa-info" style="color:orange"></i>'  : '<i class="fa fa-question"></i>'));
                $status3 = ($r->app_status_id_lv3==1) ? '<i title="Approved" class="fa fa-check" style="color:green"></i>' : (($r->app_status_id_lv3 == 2) ? '<i title="rejected" class="fa fa-remove" style="color:red"></i>' : (($r->app_status_id_lv3 == 3) ? '<i title="Pending" class="fa fa-info" style="color:orange"></i>'  : '<i title="No Respond" class="fa fa-question"></i>'));
                $status4 = ($r->app_status_id_lv4==1) ? '<i title="Approved" class="fa fa-check" style="color:green"></i>' : (($r->app_status_id_lv4 == 2) ? '<i title="rejected" class="fa fa-remove" style="color:red"></i>' : (($r->app_status_id_lv4 == 3) ? '<i title="Pending" class="fa fa-info" style="color:orange"></i>'  : '<i title="No Respond" class="fa fa-question"></i>'));
                $has_approve = 'direktur';
            }else{
                $status2 = ($r->app_status_id_lv2==1) ? '<i title="Approved" class="fa fa-check" style="color:green"></i>' : (($r->app_status_id_lv2 == 2) ? '<i title="rejected" class="fa fa-remove" style="color:red"></i>' : (($r->app_status_id_lv2 == 3) ? '<i title="Pending" class="fa fa-info" style="color:orange"></i>'  : '<i class="fa fa-question"></i>'));
                $status3 = '<i title="Tidak Butuh Approval" class="fa fa-minus" style="color:green"></i>';
                $status4 = '<i title="Tidak Butuh Approval" class="fa fa-minus" style="color:green"></i>';
                $has_approve = 'ga';
            }
        else:
            $status2 = '<i title="Tidak Butuh Approval" class="fa fa-minus" style="color:green"></i>';
            $status3 = ($r->app_status_id_lv3==1) ? '<i title="Approved" class="fa fa-check" style="color:green"></i>' : (($r->app_status_id_lv3 == 2) ? '<i title="rejected" class="fa fa-remove" style="color:red"></i>' : (($r->app_status_id_lv3 == 3) ? '<i title="Pending" class="fa fa-info" style="color:orange"></i>'  : '<i title="No Respond" class="fa fa-question"></i>'));
            $status4 = ($r->app_status_id_lv4==1) ? '<i title="Approved" class="fa fa-check" style="color:green"></i>' : (($r->app_status_id_lv4 == 2) ? '<i title="rejected" class="fa fa-remove" style="color:red"></i>' : (($r->app_status_id_lv4 == 3) ? '<i title="Pending" class="fa fa-info" style="color:orange"></i>'  : '<i title="No Respond" class="fa fa-question"></i>'));
            $has_approve = 'direktur';
        endif;

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = ($r->is_draft == 1)?"<a href=$draft>#".$r->po.'</a>' : "<a href=$detail>#".$r->po.'</a>';
            $row[] = $r->kontak;
            $row[] = dateIndo($r->tanggal_transaksi);
            $row[] = $r->gudang;
            $row[] = getName($r->created_by);
            if($r->is_draft == 1){
            $row[] = 'Draft';
            $row[] = 'Draft';
            $row[] = 'Draft';
            $row[] = 'Draft';
            }else{
                $row[] = $status1;
                $row[] = $status2;
                $row[] = $status3;
                $row[] = $status4;
            }
            if($r->is_draft == 1){
                if($r->created_by == sessId()):
                    $row[] = '<a class="btn btn-sm btn-primary" href='.$draft.' title="Edit Draft"><i class="fa fa-pencil"></i></a>
                      <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_user('."'".$r->id."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
                else:
                    $row[] = '';
                endif;
            }else{
                    if(($has_approve == 'direktur' && $r->app_status_id_lv4 != 1) || ($has_approve == 'ga' && $r->app_status_id_lv2 != 1)):
                        $row[] = "<a class='btn btn-sm btn-primary' href=$detail title='detail'><i class='fa fa-info'></i></a>
                                  <a class='btn btn-sm btn-light-azure' onclick='cantPrint()' title='Cetak'><i class='fa fa-print'></i></a>
                                  $delete
                                  ";
                    else:
                        $row[] = "<a class='btn btn-sm btn-primary' href=$detail title='detail'><i class='fa fa-info'></i></a>
                                  <a class='btn btn-sm btn-light-azure' href=$print target='_blank' title='cetak'><i class='fa fa-print'></i></a>
                                  $delete
                                  ";
                    endif;
            }
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
        $this->data[$this->file_name] = $this->main->get_detail($id);
        $this->data[$this->file_name.'_list'] = $this->main->get_list_detail($id);
        $kontak_id = getValue('kontak_id', 'purchase_order', array('id'=>'where/'.$id));
        $this->data['phone'] = getValue('telepon', 'kontak', array('id'=>'where/'.$kontak_id));
        $this->data['fax'] = getValue('fax', 'kontak', array('id'=>'where/'.$kontak_id));
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

    function export_word($id){
        $this->data['id'] = $id;
        $this->data[$this->file_name] = $this->main->get_detail($id);
        $this->data[$this->file_name.'_list'] = $this->main->get_list_detail($id);
        $kontak_id = getValue('kontak_id', 'purchase_order', array('id'=>'where/'.$id));
        $this->data['phone'] = getValue('telepon', 'kontak', array('id'=>'where/'.$kontak_id));
        $this->data['fax'] = getValue('fax', 'kontak', array('id'=>'where/'.$kontak_id));
        $this->load->view($this->module.'/'.$this->file_name.'/word', $this->data); 
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
        $p = getValue('photo', 'barang', array('id'=>'where/'.$id));
        $sl = getValue('satuan_laporan', 'barang', array('id'=>'where/'.$id));
        $s = getValue('satuan', 'barang', array('id'=>'where/'.$id));
        $satuan = (!empty($sl)) ? $sl : $s;
        $filter = array('kode_barang'=>'where/'.$id);
        $harga_terakhir_num = getAll('purchase_order_list', $filter)->num_rows();
        $harga_terakhir = ($harga_terakhir_num>0)?GetAllSelect('purchase_order_list', 'id,harga', $filter)->last_row()->harga:'';
        $harga_jual = getValue('harga_jual', 'stok', array('barang_id'=>'where/'.$id));
        $harga = (!empty($harga_terakhir)) ? $harga_terakhir : $harga_jual;
        echo json_encode(array('nama_barang'=>$q, 'photo'=>$p, 'harga'=>$harga, 'satuan' => $satuan));
    }

    function approve()
    {
        $level = $this->input->post('level');//die($level);
        $id = $this->input->post('id');
        if($level == 1)$this->notif_manager($id);
        $data = array('is_app_lv'.$level => 1,
                      'app_status_id_lv'.$level => $this->input->post('app_status_id_lv'.$level),
                      'date_app_lv'.$level=>dateNow(),
                      'user_app_lv'.$level => sessId(),
                      'note_app_lv'.$level => $this->input->post('note_lv'.$level)
            );
        $this->db->where('id', $id)->update($this->table_name, $data);
        echo json_encode(array("status" => $id));
    }

    function notif_manager($id)
    {
        permissionUser();
        $url = base_url().$this->module.'/'.$this->file_name.'/detail/'.$id;
        $isi = getName(sessId())." Mengajuan Purchase Order, Untuk melakukan approval silakan <a href=$url> KLIK DISINI </a>.";
        $approver = getAll('approver', array('level' => 'where/2'));
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

    //JS FUNCTION

    function get_dari_pr($id)
    {
        permissionUser();
        $this->load->model('purchase/request_model', 'pr');
        $filter = array('is_deleted'=>0);
        $this->data['jenis'] = getAll('kontak_jenis', $filter);
        $this->data['tipe'] = getAll('kontak_tipe', $filter);

        $this->data['order'] = $this->pr->get_detail($id);
        $this->data['order_list'] = $this->pr->get_list_detail($id);
        $num_rows = getAll($this->module.'_'.$this->file_name)->num_rows();
        $last_id = ($num_rows>0) ? $this->db->select('id')->order_by('id', 'asc')->get($this->module.'_'.$this->file_name)->last_row()->id : 0;
        $this->data['last_id'] = ($num_rows>0) ? $last_id+1 : 1;
        $this->data['barang'] = getAll('barang')->result_array();
        $this->data['satuan'] = getAll('satuan')->result_array();
        $this->data['kurensi'] = getAll('kurensi')->result();
        $this->data['metode'] = getAll('metode_pembayaran')->result();
        $this->data['gudang'] = getAll('gudang')->result();
        $this->data['users'] = getAll('users');
        $this->data['pajak_komponen'] = getAll('pajak_komponen')->result();
        $this->data['options_kontak'] = options_row('main','get_kontak','id','title','-- Pilih Supplier --');
        $this->load->view($this->module.'/'.$this->file_name.'/dari_pr', $this->data);
    }

    function get_dari_pr_lain($id)
    {
        permissionUser();
        $row_count = $this->input->post('row_count');
        $this->data['row_count'] = $row_count + 1;
        $this->data['order_list'] = $this->main->get_list_detail_pr($id);
        $this->load->view($this->module.'/'.$this->file_name.'/dari_pr_lain', $this->data);
    }

    function add_pr(){
        permissionUser();

        $this->data['pr'] = GetAllSelect('purchase_request', array('id','no'), array('id'=>'order/desc','app_status_id_lv4'=>'where/1', 'limit'=>'limit/100'))->result();
        $this->load->view('purchase/order/no_pr', $this->data);
    }

    function get_alamat($id){
        permissionUser();

        $alamat = getValue('alamat', 'kontak', array('id'=>'where/'.$id));
        $this->data['alamat'] = explode(',', $alamat);

        $this->_render_page('purchase/order/alamat', $this->data);
    }

    function get_up($id){
        permissionUser();

        $up = getValue('up', 'kontak', array('id'=>'where/'.$id));
        $this->data['up'] = explode(',', $up);

        $this->_render_page('purchase/order/up', $this->data);
    }

    function get_table_pr()
    {
        $this->load->model('purchase/request_model', 'pr');
        $id = $this->input->post('pr_id');
        $id = substr_replace($id, '', -1);
        $this->data['order_list'] = $this->main->get_list_detail_pr($id);//lastq();
        $this->load->view($this->module.'/'.$this->file_name.'/table', $this->data);
    }

    function load_kontak()
    {
        $this->data['options_kontak'] = options_row('main','get_kontak','id','title','-- Pilih Supplier --');

        $this->load->view('master/kontak/load_kontak', $this->data);
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