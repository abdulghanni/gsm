<?php defined('BASEPATH') OR exit('No direct script access allowed');

class delivery extends MX_Controller {
    public $data;
    var $module = 'sales';
    var $title = 'Delivery';
    var $file_name = 'delivery';
    var $main_title = 'Kirim Barang';
    var $table_name = 'delivery_order';
	function __construct()
	{
		parent::__construct();
		$this->load->model($this->module.'/'.$this->file_name.'_model', 'delivery');
	}

    var $model_name = 'delivery';

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
        $this->data['gudang'] = getAll('gudang')->result();
        $this->data['options_customer'] = options_row($this->model_name,'get_customer','id','title','-- Pilih customer --');
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
        $this->data['delivery'] = $this->delivery->get_detail($id);
        $this->data['delivery_list'] = $this->delivery->get_list_detail($id);

        $this->_render_page($this->module.'/'.$this->file_name.'/detail', $this->data);
    }

    function add()
    {
        permissionUser();
        $list = array(
                        'kode_barang'=>$this->input->post('kode_barang'),
                        'deskripsi'=>$this->input->post('deskripsi'),
                        'jumlah'=>$this->input->post('jumlah'),
                        'keterangan'=>$this->input->post('keterangan'),
                        );

        $data = array(
                'no' => $this->input->post('no'),
                'customer_id'=>$this->input->post('customer_id'),
                'tanggal_pengantaran'=>date('Y-m-d',strtotime($this->input->post('tanggal_pengantaran'))),
                'so'=>$this->input->post('so'),
                'gudang_id'=>$this->input->post('gudang_id'),
                'kendaraan' =>$this->input->post('kendaraan'),
                'catatan' =>$this->input->post('catatan'),
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
                'jumlah' => str_replace(',', '', $list['jumlah'][$i]),
                'keterangan' => str_replace(',', '', $list['keterangan'][$i]),
                );
        $this->db->insert($this->table_name.'_list', $data2);
        endfor;
        redirect($this->module.'/'.$this->file_name, 'refresh');
    }

    public function ajax_list()
    {
        $list = $this->delivery->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $delivery) {
            $detail = base_url().$this->module.'/'.$this->file_name.'/detail/'.$delivery->id;
            $print = base_url().$this->module.'/'.$this->file_name.'/print_pdf/'.$delivery->id;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = "<a href=$detail>#".$delivery->no.'</a>';
            $row[] = $delivery->customer;
            $row[] = $delivery->tanggal_pengantaran;
            $row[] = $delivery->so;
            $row[] = $delivery->gudang;

            $row[] ="<a class='btn btn-sm btn-primary' href=$detail title='detail'><i class='fa fa-info'></i></a>
                    <a class='btn btn-sm btn-light-azure' href=$print target='_blank' title='detail'><i class='fa fa-print'></i></a>";
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->delivery->count_all(),
                        "recordsFiltered" => $this->delivery->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    function print_pdf($id)
    {
         $this->data['title'] = $this->title.' - Detail';
        $this->data['module'] = $this->module;
        $this->data['file_name'] = $this->file_name;
        $this->data['main_title'] = $this->main_title;
        permissionUser();
        $this->data['id'] = $id;
        $this->data['delivery'] = $this->delivery->get_detail($id);
        $this->data['delivery_list'] = $this->delivery->get_list_detail($id);
        
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
    
    function get_dari_so($id)
    {
        permissionUser();
        $num_rows = getAll($this->table_name)->num_rows();
        $last_id = ($num_rows>0) ? $this->db->select('id')->order_by('id', 'asc')->get($this->table_name)->last_row()->id : 0;
        $this->data['last_id'] = ($num_rows>0) ? $last_id+1 : 1;
        
        $this->data['order'] = $this->delivery->get_detail_so($id);
        $this->data['order_list'] = $this->delivery->get_list_detail_so($id);
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