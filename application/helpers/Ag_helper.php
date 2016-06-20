<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
function last_link()
{
$CI =& get_instance();
        return $CI->session->set_userdata('last_link', $CI->uri->uri_string());
}

if (!function_exists('lastq')){	
	function lastq()
	{
		$CI =& get_instance();
		die($CI->db->last_query());
	}
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

if(!function_exists('getName')){
	function getName($user_id){
		$CI =& get_instance();
		$name = getValue('username', 'users', array('id'=>'where/'.$user_id));
		return $name;
	}
}

if(!function_exists('getFullName')){
	function getFullName($user_id){
		$CI =& get_instance();
		$name = getValue('full_name', 'users', array('id'=>'where/'.$user_id));
		if(!empty($name))return $name;else '';
	}
}

if(!function_exists('getEmail')){
	function getEmail($user_id){
		$CI =& get_instance();
		$name = getValue('email', 'users', array('id'=>'where/'.$user_id));
		if(!empty($name))return $name;else '';
	}
}

if(!function_exists('getUserGroup')){
	function getUserGroup($id)
    {
        //$group = getAll('users_groups', array('user_id'=>'where/'.$id))->result();
        $group = getJoin('users_groups', 'groups', 'users_groups.group_id = groups.id', 'left', 'groups.name as group_name, users_groups.*', array('users_groups.user_id'=>'where/'.$id), array('!=groups.id'=>'2'));
        $groups = '';
        if(!empty($group))
        {
            foreach ($group->result() as $key) {
                $groups = ucwords($key->group_name);
            }

            return $groups;
        }
    }
}

if(!function_exists('dateNow')){
	function dateNow()
	{
		return date('Y-m-d H:i:s');
	}
}


if (!function_exists('print_ag')){	
	function print_ag($data)
	{
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		//die();
	}
}

if (!function_exists('GetAll')){
	function GetAll($tbl,$filter=array(),$filter_where_in=array())
	{
		$CI =& get_instance();
		foreach($filter as $key=> $value)
		{
			// Multiple Like
			if(is_array($value))
			{
				$key = str_replace(" =","",$key);
				$like="";
				$v=0;
				foreach($value as $r=> $s)
				{
					$v++;
					$exp = explode("/",$s);
					if(isset($exp[1]))
					{
						if($exp[0] == "like")
						{
							if($key == "tanggal" || $key == "tahun")
							{
								$key = "tanggal";
								if(strlen($exp[1]) == 4)
								{
									if($v == 1) $like .= $key." LIKE '%".$exp[1]."-%' ";
									else $like .= " OR ".$key." LIKE '%".$exp[1]."-%' ";
								}
								else 
								{
									if($v == 1) $like .= $key." LIKE '%-".$exp[1]."-%' ";
									else $like .= " OR ".$key." LIKE '%-".$exp[1]."-%' ";
								}
							}
							else
							{
								if($v == 1) $like .= $key." LIKE '%".$exp[1]."%' ";
								else $like .= " OR ".$key." LIKE '%".$exp[1]."%' ";
							}
						}
					}
				}
				if($like) $CI->db->where("id > 0 AND ($like)");
				$exp[0]=$exp[1]="";
			}
			else $exp = explode("/",$value);
			
			if(isset($exp[1]))
			{
				if($exp[0] == "where") $CI->db->where($key, $exp[1]);
				else if($exp[0] == "like") $CI->db->like($key, $exp[1]);
				else if($exp[0] == "or_like") $CI->db->or_like($key, $exp[1]);
				else if($exp[0] == "like_after") $CI->db->like($key, $exp[1], 'after');
				else if($exp[0] == "like_before") $CI->db->like($key, $exp[1], 'before');
				else if($exp[0] == "not_like") $CI->db->not_like($key, $exp[1]);
				else if($exp[0] == "not_like_after") $CI->db->not_like($key, $exp[1], 'after');
				else if($exp[0] == "not_like_before") $CI->db->not_like($key, $exp[1], 'before');
				else if($exp[0] == "wherebetween"){
					$xx=explode(',',$exp[1]);
				 $CI->db->where($key.' >=',$xx[0]);
				 $CI->db->where($key.' <=',$xx[1]);
				}
				else if($exp[0] == "order")
				{
					$key = str_replace("=","",$key);
					$CI->db->order_by($key, $exp[1]);
				}
				else if($key == "limit") $CI->db->limit($exp[1], $exp[0]);
			}
			else if($exp[0] == "where") $CI->db->where($key);
			
			if($exp[0] == "group") $CI->db->group_by($key);
		}
		
		foreach($filter_where_in as $key=> $value)
		{
			if(preg_match("/!=/", $key)) $CI->db->where_not_in(str_replace("!=","",$key), $value);
			else $CI->db->where_in($key, $value);
		}
		
		$q = $CI->db->get($tbl);
		//die($CI->db->last_query());
		
		return $q;
	}
}
if (!function_exists('GetAllSelect')){
	function GetAllSelect($tbl,$select,$filter=array(),$filter_where_in=array())
	{
		$CI =& get_instance();
		$CI->db->select($select);
		foreach($filter as $key=> $value)
		{
			// Multiple Like
			if(is_array($value))
			{
				$key = str_replace(" =","",$key);
				$like="";
				$v=0;
				foreach($value as $r=> $s)
				{
					$v++;
					$exp = explode("/",$s);
					if(isset($exp[1]))
					{
						if($exp[0] == "like")
						{
							if($key == "tanggal" || $key == "tahun")
							{
								$key = "tanggal";
								if(strlen($exp[1]) == 4)
								{
									if($v == 1) $like .= $key." LIKE '%".$exp[1]."-%' ";
									else $like .= " OR ".$key." LIKE '%".$exp[1]."-%' ";
								}
								else 
								{
									if($v == 1) $like .= $key." LIKE '%-".$exp[1]."-%' ";
									else $like .= " OR ".$key." LIKE '%-".$exp[1]."-%' ";
								}
							}
							else
							{
								if($v == 1) $like .= $key." LIKE '%".$exp[1]."%' ";
								else $like .= " OR ".$key." LIKE '%".$exp[1]."%' ";
							}
						}
					}
				}
				if($like) $CI->db->where("id > 0 AND ($like)");
				$exp[0]=$exp[1]="";
			}
			else $exp = explode("/",$value);
			
			if(isset($exp[1]))
			{
				if($exp[0] == "where") $CI->db->where($key, $exp[1]);
				else if($exp[0] == "like") $CI->db->like($key, $exp[1]);
				else if($exp[0] == "like_after") $CI->db->like($key, $exp[1], 'after');
				else if($exp[0] == "like_before") $CI->db->like($key, $exp[1], 'before');
				else if($exp[0] == "not_like") $CI->db->not_like($key, $exp[1]);
				else if($exp[0] == "not_like_after") $CI->db->not_like($key, $exp[1], 'after');
				else if($exp[0] == "not_like_before") $CI->db->not_like($key, $exp[1], 'before');
				else if($exp[0] == "order")
				{
					$key = str_replace("=","",$key);
					$CI->db->order_by($key, $exp[1]);
				}
				else if($key == "limit") $CI->db->limit($exp[1], $exp[0]);
			}
			else if($exp[0] == "where") $CI->db->where($key);
			
			if($exp[0] == "group") $CI->db->group_by($key);
		}
		
		foreach($filter_where_in as $key=> $value)
		{
			$CI->db->where_in($key, $value);
		}
		
		$q = $CI->db->get($tbl);
		//die($CI->db->last_query());
		
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

function getWhere($select, $table,$field, $value)
{
	$CI =& get_instance();
	$q = $CI->db->select($select)->where($field, $value)->get($table)->row();
	return $q->$select;
}

function monthRomawi($date)
{
	$month['01']  = 'I';
	$month['02']  = 'II';
	$month['03']  = 'III';
	$month['04']  = 'IV';
	$month['05']  = 'V';
	$month['06']  = 'VI';
	$month['07']  = 'VII';
	$month['08']  = 'VIII';
	$month['09']  = 'IX';
	$month['10'] = 'X';
	$month['11'] = 'XII';
	$month['12'] = 'XII';
	return $month[$date];
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

function timeago($date) {
    if (empty($date)) {
        return "No date provided";
    }
   // $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $periods = array("detik", "menit", "jam", "hari", "minggu", "bulan", "tahun", "dekade");
    $lengths = array("60","60","24","7","4.35","12","10");

    $now = time();
    $unix_date = strtotime($date);

    // check validity of date
    if (empty($unix_date)) {
        return "";
    }

    // is it future date or past date
    if ($now > $unix_date) {
        $difference = $now - $unix_date;
        $tense = "lalu";
    } else {
        $difference = $unix_date - $now;
        $tense = "dari sekarang";
    }

    for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }

    $difference = round($difference);

    if ($difference != 1) {
        $periods[$j].= "";
    }

    return "$difference $periods[$j] {$tense}";
}

if (!function_exists('getSum')){
	function getSum($field, $table, $condition_field = null, $condition_id = null)
	{
		$CI =& get_instance();
		$CI->db->select_sum($field);
		if($condition_id != null && $condition_field != null){
			$CI->db->where($condition_field, $condition_id);
		}
		return $CI->db->get($table)->row()->$field;
	}
}

function dollarToWords($numval){
	$moneystr = "";
	// handle the millions
	$milval = (integer)($numval / 1000000);
	if($milval > 0)  {
	  $moneystr = getwords($milval) . " Million";
	  }
	 
	// handle the thousands
	$workval = $numval - ($milval * 1000000); // get rid of millions
	$thouval = (integer)($workval / 1000);
	if($thouval > 0)  {
	  $workword = getwords($thouval);
	  if ($moneystr == "")    {
	    $moneystr = $workword . " Thousand";
	    }else{
	    $moneystr .= " " . $workword . " Thousand";
	    }
	  }
	 
	// handle all the rest of the dollars
	$workval = $workval - ($thouval * 1000); // get rid of thousands
	$tensval = (integer)($workval);
	if ($moneystr == ""){
	  if ($tensval > 0){
	    $moneystr = getwords($tensval);
	    }else{
	    $moneystr = "Zero";
	    }
	  }else // non zero values in hundreds and up
	  {
	  $workword = getwords($tensval);
	  $moneystr .= " " . $workword;
	  }
	 
	// plural or singular 'dollar'
	$workval = (integer)($numval);
	if ($workval == 1){
	  $moneystr .= " Dollar And ";
	  }else{
	  $moneystr .= " Dollars And ";
	  }
	 
	// do the cents - use printf so that we get the
	// same rounding as printf
	$workstr = sprintf("%3.2f",$numval); // convert to a string
	$intstr = substr($workstr, - 2, 2);
	$workint = (integer)($intstr);
	if ($workint == 0){
	  $moneystr .= "Zero";
	  }else{
	  $moneystr .= getwords($workint);
	  }
	if ($workint == 1){
	  $moneystr .= " Cent";
	  }else{
	  $moneystr .= " Cents";
	  }
	 
	// done 
	return $moneystr;
}
 
//*************************************************************
// this function creates word phrases in the range of 1 to 999.
// pass it an integer value
//*************************************************************
function getwords($workval)
{
	$numwords = array(
	  1 => "One",
	  2 => "Two",
	  3 => "Three",
	  4 => "Four",
	  5 => "Five",
	  6 => "Six",
	  7 => "Seven",
	  8 => "Eight",
	  9 => "Nine",
	  10 => "Ten",
	  11 => "Eleven",
	  12 => "Twelve",
	  13 => "Thirteen",
	  14 => "Fourteen",
	  15 => "Fifteen",
	  16 => "Sixteen",
	  17 => "Seventeen",
	  18 => "Eighteen",
	  19 => "Nineteen",
	  20 => "Twenty",
	  30 => "Thirty",
	  40 => "Forty",
	  50 => "Fifty",
	  60 => "Sixty",
	  70 => "Seventy",
	  80 => "Eighty",
	  90 => "Ninety");
	 
	// handle the 100's
	$retstr = "";
	$hundval = (integer)($workval / 100);
	if ($hundval > 0){
	  $retstr = $numwords[$hundval] . " Hundred";
	  }
	 
	// handle units and teens
	$workstr = "";
	$tensval = $workval - ($hundval * 100); // dump the 100's
	 
	// do the teens
	if (($tensval < 20) && ($tensval > 0)){
	  $workstr = $numwords[$tensval];
	   // got to break out the units and tens
	  }else{
		  $tempval = ((integer)($tensval / 10)) * 10; // dump the units
		  $workstr = $numwords[$tempval]; // get the tens
		  $unitval = $tensval - $tempval; // get the unit value
		  if ($unitval > 0){
		    $workstr .= " " . $numwords[$unitval];
		  }
	}
	 
	// join the parts together 
	if ($workstr != ""){
	  if ($retstr != ""){
	    $retstr .= " " . $workstr;
	    }else{
	    $retstr = $workstr;
	    }
	}

	return $retstr;
}