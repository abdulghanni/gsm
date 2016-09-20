<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller {
    public $data;
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// redirect if needed, otherwise display the user list
	function index()
	{
        permissionUser();
        $this->data['num_data_po'] = getAll('purchase_order', array('created_on'=>'where/'.date('Y-m-d')))->num_rows();
        $this->data['num_data_pembelian'] = getAll('pembelian', array('created_on'=>'where/'.date('Y-m-d')))->num_rows();
        $this->data['num_data_so'] = getAll('sales_order', array('created_on'=>'where/'.date('Y-m-d')))->num_rows();
        $this->data['num_data_penjualan'] = getAll('penjualan', array('created_on'=>'where/'.date('Y-m-d')))->num_rows();
        $this->data['num_data_penerimaan'] = getAll('stok_penerimaan', array('created_on'=>'where/'.date('Y-m-d')))->num_rows();
        $this->data['num_data_pengeluaran'] = getAll('stok_pengeluaran', array('created_on'=>'where/'.date('Y-m-d')))->num_rows();
        $this->data['num_stok'] = getAll('barang')->num_rows();
        $this->data['num_barang'] = getAll('barang')->num_rows();
        $this->data['num_stok_tersedia'] = getAll('stok', array(), array('!=dalam_stok'=>'0'))->num_rows();
        $this->data['num_stok_minimum'] = $this->db->where('dalam_stok < minimum_stok')->get('stok')->num_rows();
        $this->data['num_stok_minimum'] = $this->db->where('dalam_stok < minimum_stok')->get('stok')->num_rows();
        $this->data['num_barang_jadi'] = getAll('barang', array('jenis_barang_id'=>'where/1'))->num_rows();
        $this->data['num_barang_mentah'] = getAll('barang', array('jenis_barang_id'=>'where/2'))->num_rows();
        $this->data['persen_barang_jadi'] = ($this->data['num_barang_jadi']/$this->data['num_barang'])*100;
        $this->data['persen_barang_mentah'] = ($this->data['num_barang_mentah']/$this->data['num_barang'])*100;
		$this->_render_page('dashboard/index', $this->data);
	}

    function get_chart(){
        $tanggal = array();
        $num_data = array();
        for($i=7;$i>0;$i--){
            $d = new dateTime("$i days ago");
            $tanggal[] = $d->format('d M');
            $num_data_po[] = getAll('purchase_order', array('created_on'=>'where/'.$d->format('Y-m-d')))->num_rows();
            $num_data_so[] = getAll('sales_order', array('created_on'=>'where/'.$d->format('Y-m-d')))->num_rows();
            $num_data_penerimaan[] = getAll('stok_penerimaan', array('created_on'=>'where/'.$d->format('Y-m-d')))->num_rows();
            $num_data_pengeluaran[] = getAll('stok_pengeluaran', array('created_on'=>'where/'.$d->format('Y-m-d')))->num_rows();
            $num_data_pembelian[] = getAll('pembelian', array('created_on'=>'where/'.$d->format('Y-m-d')))->num_rows();
            $num_data_penjualan[] = getAll('penjualan', array('created_on'=>'where/'.$d->format('Y-m-d')))->num_rows();
        }

        echo json_encode(array('tanggal'=>$tanggal,
                                'num_data_po'=>$num_data_po,
                                'num_data_pembelian'=>$num_data_pembelian,
                                'num_data_so'=>$num_data_so,
                                'num_data_penjualan'=>$num_data_penjualan,
                                'num_data_penerimaan'=>$num_data_penerimaan,
                                'num_data_pengeluaran'=>$num_data_pengeluaran,
                                ));
    }

    function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

                if(in_array($view, array('dashboard/index')))
                {
                    $this->template->set_layout('default');


                    $this->template->add_js('vendor/Chart.js/Chart.min.js');
                    $this->template->add_js('vendor/jquery.sparkline/jquery.sparkline.min.js');
                     $this->template->add_js('assets/js/dashboard/index.js');
                     $this->template->add_script('Index.init();');
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
