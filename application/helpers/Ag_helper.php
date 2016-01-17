<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
function last_link()
{
$CI =& get_instance();
        return $CI->session->set_userdata('last_link', $CI->uri->uri_string());
}

if (!function_exists('permissionAdmin')){
	function permissionAdmin()
	{
		$CI =& get_instance();
		if (!$CI->ion_auth->logged_in())
    {
        //redirect them to the login page
        redirect('auth/login', 'refresh');
    }
    elseif (!$CI->ion_auth->is_admin()) //remove this elseif if you want to enable this for non-admins
    {
        //redirect them to the home page because they must be an administrator to view this
        //return show_error('You must be an administrator to view this page.');
        return show_error('You must be an administrator to view this page.');
    }
		return 1;
	}
}

if (!function_exists('permissionUser')){
	function permissionUser()
	{
		$CI =& get_instance();
		if(!$CI->ion_auth->get_user_id()){
			redirect('auth/login', 'refresh');
		}
		return $CI->ion_auth->get_user_id();
	}
}

if(!function_exists('sessId')){
	function sessId()
	{
		$CI =& get_instance();
		$sess_id = $CI->session->userdata('user_id');
		if(!empty($sess_id)){
			return $sess_id;
		}
	}
}


if (!function_exists('print_ag')){	
	function print_mz($data)
	{
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		die();
	}
}

if (!function_exists('GetAll')){
	function GetAll($tbl,$filter=array())
	{
		$CI =& get_instance();
		foreach($filter as $key=> $value)
		{
			$exp = explode("/",$value);
			if(isset($exp[1]))
			{
				if($exp[0] == "where") $CI->db->where($key, $exp[1]);
				else if($exp[0] == "like") $CI->db->like($key, $exp[1]);
				else if($exp[0] == "order") $CI->db->order_by($key, $exp[1]);
				else if($key == "limit") $CI->db->limit($exp[1], $exp[0]);
			}
			else if($exp[0] == "where") $CI->db->where($key);
			
			if($exp[0] == "group") $CI->db->group_by($key);
		}
		
		if($tbl == "kg_news_subcategory" || $tbl == "contents" || $tbl == "news" || $tbl=="news_category" || $tbl=="kg_view_news")
		$CI->db->where("id_lang", GetIdLang());
		
		$q = $CI->db->get($tbl);
		
		return $q;
	}
}

if (!function_exists('GetValue')){
	function GetValue($field,$table,$filter=array(),$order=NULL)
	{
		$CI =& get_instance();
		$CI->db->select($field);
		foreach($filter as $key=> $value)
		{
			$exp = explode("/",$value);
			if(isset($exp[1]))
			{
				if($exp[0] == "where") $CI->db->where($key, $exp[1]);
				else if($exp[0] == "like") $CI->db->like($key, $exp[1]);
				else if($exp[0] == "order") $CI->db->order_by($key, $exp[1]);
				else if($key == "limit") $CI->db->limit($exp[1], $exp[0]);
			}
			
			if($exp[0] == "group") $CI->db->group_by($key);
		}
		
		if($order) $CI->db->order_by($order);
		$q = $CI->db->get($table);
		foreach($q->result_array() as $r)
		{
			return $r[$field];
		}
		return 0;
	}
}



if ( ! function_exists('options_row'))
	{
		function options_row($model=NULL,$function=NULL,$id_field=NULL,$title_field=NULL,$default=NULL, $kode=NULL)
		{
			$CI =& get_instance();
			$query = get_query_view($model, $function, '' ,'','');
			if($default) $data['options_row'][0] = $default;
			
			foreach($query['result_array'] as $row)
			{
				if($kode!=null){$data['options_row'][$row[$id_field]] = $row[$kode].' - '.$row[$title_field];}else{$data['options_row'][$row[$id_field]] = $row[$title_field];} 
			}
			return $data['options_row'];
		}
	}


if ( ! function_exists('get_query_view'))
	{
		function get_query_view($model, $function, $function_count=NULL,$limit=NULL, $uri_segment=NULL)
		{
			$CI =& get_instance();
			if($uri_segment != NULL)
				$offset = $CI->uri->segment($uri_segment);
			else
				$offset = 0;
			
			$data['query'] = $q_ = $CI->$model->$function($limit,$offset);
			$data['result_array'] = $q_->result_array();
			if($function_count != '')
				$data['num_rows'] = $CI->$model->$function_count();
			else
				$data['num_rows'] = $q_->num_rows();
			return $data;
		}
	}

if ( ! function_exists('dateIndo'))
{
	function dateIndo($date,$format=null)
	{
		if($date!=0000-00-00){
			try {
				
				$newdate = date('d',strtotime($date)).' '.monthIndo(date('m',strtotime($date))).' '.date('Y',strtotime($date));
				return $newdate;

			} catch (Exception $e) {
				return array();
			}
		}else{
			return '';
		}

	}
}

function monthIndo($date)
	{
		try {
			
			$month['01']  = 'Januari';
			$month['02']  = 'Februari';
			$month['03']  = 'Maret';
			$month['04']  = 'April';
			$month['05']  = 'Mei';
			$month['06']  = 'Juni';
			$month['07']  = 'Juli';
			$month['08']  = 'Agustus';
			$month['09']  = 'September';
			$month['10'] = 'Oktober';
			$month['11'] = 'Nopember';
			$month['12'] = 'Desember';
			return $month[$date];

		} catch (Exception $e) {
			return array();
		}

	}

