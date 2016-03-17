<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('print_mz')){	
	function print_mz($data)
	{
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		die();
	}
}

if(!function_exists('tanggalpenuh')){
	function tanggalpenuh($date){
		$month=substr($date,5,2);
		$year=substr($date,0,4);
		
	if($month=='01' || $month=='03' || $month=='05' || $month=='07' || $month=='08' || $month=='10' || $month=='12'){
		return  $year.'-'.$month.'-31';
			}
	elseif($month=='04' || $month=='06' || $month=='09' || $month=='11'){
		return  $year.'-'.$month.'-30';
			}	
	elseif($month=='02'){
			
			$cekkabisat=isTahunKabisat($year);
			if($cekkabisat==TRUE){
				return  $year.'-'.$month.'-29';
				}
			else{
				return  $year.'-'.$month.'-28';
			}
		
		}
			
	}
}

if(!function_exists('isTahunKabisat')){
	function isTahunKabisat($angkaTahun) {
	if($angkaTahun % 100 === 0) {
		if($angkaTahun % 400 === 0) return (bool)TRUE;
		else return (bool)FALSE;
	} else {
		if($angkaTahun % 4 === 0) return (bool)TRUE;
		else return (bool)FALSE;
	}
}
	
	}
if (!function_exists('lastq')){	
	function lastq()
	{
		$CI =& get_instance();
		die($CI->db->last_query());
	}
}

if (!function_exists('cekIpad')){
	function cekIpad()
	{
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		if(preg_match('/ipad/i',$user_agent)) return TRUE;
		else return FALSE;
	}
}
	
function cekAccessMenu($ref_menu)
{
	$CI =& get_instance();
	$CI->db->where("filez",$ref_menu);
	$query = $CI->db->get("menu");
	//die($this->db->last_query());
	return $query;
}

function cekLogin($username,$userpass)
{
	$CI =& get_instance();
	$CI->db->where("username",$username);
	$CI->db->where("password",$userpass);
	$CI->db->where("is_active",'Active');
	$query=$CI->db->get("sv_admin");
	return $query;
}

function cekLoginEmployee($username,$userpass)
{
	$CI =& get_instance();
	if(!preg_match("/-/", $username)) $username = substr($username,0,1)."-".substr($username,1,4)."-".substr($username,5,3);
	$CI->db->where("nik",$username);
	$CI->db->where("userpass",$userpass);
	$query=$CI->db->get("employee");
	return $query;
}
	
if (!function_exists('permission')){
	function permission()
	{
		$CI =& get_instance();
		if(!$CI->session->userdata("sendyuu_webmaster_id")){
			redirect("login");
		}
		
		$group = $CI->session->userdata('sendyuu_webmaster_grup');
		if($group != "8910")
		{
			$ref_menu = $CI->uri->segment(1);
			if($ref_menu == "personal" || $ref_menu == "trainingpi" || $ref_menu == "riwayatkerja") $ref_menu="datakaryawan";
			$q_path = cekAccessMenu($ref_menu);
			$jum = $q_path->num_rows();
			
			if($jum > 0)
			{
				$row = $q_path->row();
				$id_menu_admin = $row->id;
				$CI->db->where("id_admin_grup",$group);
				$CI->db->where("id_menu_admin",$id_menu_admin);
				$q_menu_admin = $CI->db->get("admin_auth");
				$jum_menu_admin = $q_menu_admin->num_rows();
				
				if($jum_menu_admin == 0)
				{
					redirect("forbiden");
				}
			}
			else redirect("forbiden");
		}
		
		return $CI->session->userdata("sendyuu_webmaster_id");
	}
}

if (!function_exists('permissionBiasa')){
	function permissionBiasa()
	{
		$CI =& get_instance();
		if(!$CI->session->userdata("webmaster_id")){
			redirect("login");
		}
		$group = $CI->session->userdata('webmaster_grup');
		if($group != "2706"){
			$ref_menu = $CI->uri->segment(1);
			$q_path = cekAccessMenu($ref_menu);
			$jum = $q_path->num_rows();
			if($jum > 0)
			{
				$row = $q_path->row();
				$id_menu_admin = $row->id;
				$CI->db->where("id_admin_grup",$group);
				$CI->db->where("id_menu_admin",$id_menu_admin);
				$q_menu_admin = $CI->db->get("menu_auth");
				$jum_menu_admin = $q_menu_admin->num_rows();
				
				if($jum_menu_admin == 0)
				{
					redirect("forbidden");	
				}
			}
			else
				{
					redirect("forbidden");	
				}
		}
	}
}

if (!function_exists('permissionFormUser')){
	function permissionFormUser($id)
	{
		$CI =& get_instance();
		if(!$CI->session->userdata("webmaster_id")){
			redirect("login");
		}
		$group = $CI->session->userdata('webmaster_grup');
		$webmaster_id=$CI->session->userdata('webmaster_id');
		//echo $id;
		if($group != "2706"){
				if($id != $webmaster_id){
				redirect("forbidden");	
				}
		}
	}
}


if (!function_exists('GetUserID')){
	function GetUserID()
	{
		$CI =& get_instance();
		return $CI->session->userdata("sendyuu_webmaster_id");
	}
}

if (!function_exists('CekAdminKeuangan')){
	function CekAdminKeuangan($val)
	{
		$admin_keuangan = GetValue("id_admin_wp","admin", array("id"=> "where/".$val));
		return $admin_keuangan;
	}
}

if (!function_exists('CekAksesKegiatan')){
	function CekAksesKegiatan($tabel, $id)
	{
		$CI =& get_instance();
		$grup = $CI->session->userdata('sendyuu_webmaster_grup');
		$cek = CekAdminKeuangan(GetUserID());
		if($cek == 1) $cek_akses = GetValue("id_administrasi", $tabel, array("id"=> "where/".$id));
		else if($cek == 2) $cek_akses = GetValue("id_keuangan", $tabel, array("id"=> "where/".$id));
		else $cek_akses=0;
		
		if(!$cek_akses) $cek_akses = GetValue("id_pic", $tabel, array("id"=> "where/".$id));
		
		$cek_akses = str_replace(" ","",$cek_akses);
		$cek_akses = str_replace("-+1-","",$cek_akses);
		
		if($cek_akses && !preg_match("/-".GetUserID()."-/", $cek_akses) && ($grup != 1 && $grup != 2 && $grup != 5)) return 0;
		else return 1;
	}
}

if (!function_exists('permissionkaryawan')){
	function permissionkaryawan($id, $path)
	{
		$CI =& get_instance();
		$grup = $CI->session->userdata("sendyuu_webmaster_grup");
		if($grup == 4){
			if($path == "jobdesc")
			redirect("jobdesc/main/".$id);
			else
			redirect("datakaryawan/dashboard/".$id);
		}
	}
}

if (!function_exists('permissionaction')){
	function permissionaction()
	{
		$CI =& get_instance();
		$grup = $CI->session->userdata("sendyuu_webmaster_grup");
		if($grup == 4) return 0;
		else return 1;
	}
}

if (!function_exists('GetHeaderFooter')){	
	function GetHeaderFooter($flag_sidebar=NULL)
	{
		$CI =& get_instance();
		
		if($CI->session->userdata('sendyuu_webmaster_id'))
		{
			$data['dis_login'] = "display:'';";
			$data['nama_user'] = $CI->session->userdata('sendyuu_admin');
		}
		else
		{
			$data['dis_login'] = "display:none;";
			$data['nama_user'] = "";
		}
		
		$data['header'] = 'header';
		$data['menu'] = 'menu';
		//$data['sidebar'] = 'sidebar';
		$data['footer'] = 'footer';
		$data['breadcrumb'] = Breadcrumb();
		
		$data['spic']=$data['sd']=$data['dv']=$data['bln']=$data['thn']=$data['tp']="";
		return $data;
	}
}

if (!function_exists('cek_akses')){
	function cek_akses($db, $id_menu, $webmaster_grup)
	{
		$CI =& get_instance();
		$CI->db->where("id_admin_grup", $webmaster_grup);
		$CI->db->where("id_menu_admin", $id_menu);
		$q = $CI->db->get("admin_auth");
		if($q->num_rows() > 0) return true;
		else return false;
	}
}

if (!function_exists('Breadcrumb')){
	function Breadcrumb()
	{
		$CI =& get_instance();
		$breadcrumb = "";//Home
		$flag=1;
		$id_menu = $id_menu_temp = GetValue("id","menu_admin", array("filez"=> "where/".$CI->uri->segment(1)));
		if($id_menu)
		{
			while($flag)
			{
				$CI->db->where("id", $id_menu);
				$q = $CI->db->get("menu_admin");
				foreach($q->result_array() as $r)
				{
					if($id_menu_temp == $id_menu) $breadcrumb = "<li>".$r['title']."</li>".$breadcrumb;
					else if($id_menu == 3) $breadcrumb = "<li><a href='".site_url($r['filez'].'/dashboard/'.$CI->uri->segment(3))."'><b>".$r['title']."</b></a></li>".$breadcrumb;
					else $breadcrumb = "<li><a href='".site_url($r['filez'])."'><b>".$r['title']."</b></a></li>".$breadcrumb;
					$id_menu=$r['id_parents'];
					if($r['id_parents'] == 0) $flag=0;
				}
			}
		}
		
		return "<li class='first'><a href='".site_url('home')."'>Home</a></li>".$breadcrumb;
		
		return $data['breadcrumb'];
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
		//lastq();
		foreach($q->result_array() as $r)
		{
			return $r[$field];
		}
		
		return 0;
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
			$CI->db->where_in($key, $value);
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

if (!function_exists('GetQuery')){
	function GetQuery($field,$table,$where='',$order='',$group='')
	{
		$CI =& get_instance();
		$where = !empty($where) ? "WHERE ".$where : "";
		$order = !empty($order) ? "ORDER BY ".$order : "";
		$group = !empty($group) ? "GROUP BY ".$group : "";		
		
		$q = $CI->db->query("SELECT $field FROM $table $where $order $group");
		
		return $q;
	}
}

if (!function_exists('GetJoin')){
	function GetJoin($tbl,$tbl_join,$condition,$type,$select,$filter=array(),$filter_where_in=array())
	{
		$CI =& get_instance();
		$CI->db->select($select);
		foreach($filter as $key=> $value)
		{
			// Multiple Like
			if(is_array($value))
			{
				if($key == "group") $CI->db->group_by($value);
				$exp[0]=$exp[1]="";
			}
			else $exp = explode("/",$value);
			if(isset($exp[1]))
			{
				if($exp[0] == "where") $CI->db->where($key, $exp[1]);
				else if($exp[0] == "like") $CI->db->like($key, $exp[1]);
				else if($exp[0] == "order") $CI->db->order_by($key, $exp[1]);
				else if($key == "limit") $CI->db->limit($exp[1], $exp[0]);
			}
			
			if($exp[0] == "group") $CI->db->group_by($key);
		}
		
		foreach($filter_where_in as $key=> $value)
		{
			$CI->db->where_in($key, $value);
		}
		
		$CI->db->join($tbl_join, $condition, $type);
		$q = $CI->db->get($tbl);
		//die($CI->db->last_query());
		
		return $q;
	}
}

if (!function_exists('GetSum')){
	function GetSum($table,$field,$filter=array(),$get="")
	{
		$CI =& get_instance();
		$CI->db->select("SUM($field) as total");
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
		
		$q = $CI->db->get($table);
		
		if($get == "value")
		{
			$val = 0;
			//die($CI->db->last_query());
			foreach($q->result_array() as $r) $val=$r['total'];
			return $val;
		}
		else return $q;
	}
}

if (!function_exists('GetCount')){
	function GetCount($table,$field,$filter=array(),$get="")
	{
		$CI =& get_instance();
		$CI->db->select("$field as label, COUNT($field) as total");
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
		$q = $CI->db->get($table);
		if($get == "value")
		{
			$val = 0;
			//die($CI->db->last_query());
			foreach($q->result_array() as $r) $val=$r['total'];
			return $val;
		}
		else return $q;
	}
}

if (!function_exists('GetColumns')){	
	function GetColumns($tbl)
	{
		$CI =& get_instance();
		//if(substr($tbl,0,3) != "kg_") $tbl = "kg_".$tbl;
		$query = $CI->db->query("SHOW COLUMNS FROM ".$tbl);
		return $query->result_array();
	}
}
	
if (!function_exists('GetUrlDate')){	
	function GetUrlDate($date)
	{
		$exp1 = explode(" ", $date);
		$exp = explode("-",$exp1[0]);
		return $exp[2]."/".$exp[1]."/".$exp[0];
	}
}

if (!function_exists('ExplodeNameFile')){
	function ExplodeNameFile($source)
	{
		$ext = strrchr($source, '.');
		$name = ($ext === FALSE) ? $source : substr($source, 0, -strlen($ext));

		return array('ext' => $ext, 'name' => $name);
	}
}

if (!function_exists('GetThumb')){	
	function GetThumb($image, $path="_thumb")
	{
		$exp = ExplodeNameFile($image);
		return $exp['name'].$path.$exp['ext'];
	}
}

if (!function_exists('ResizeImage')){	
	function ResizeImage($up_file,$w,$h)
	{
		//Resize
		$CI =& get_instance();
		$config['image_library'] = 'gd2';
		$config['source_image'] = $up_file;
		$config['dest_image'] = "./".$CI->config->item('path_upload')."/";
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE; //Width=Height
		$config['height'] = $h;
		$config['width'] = $w;
		
		$CI->load->library('image_lib', $config);
		if($CI->image_lib->resize()) return 1;
		else return 0; 
	}
}

if (!function_exists('InputFile')){
	function InputFile($filez,$filesize=500)
	{
		$CI =& get_instance();
		$file_up = $_FILES[$filez]['name'];
		$file_up = date("YmdHis").".".str_replace("-","_",url_title($file_up));
		$myfile_up	= $_FILES[$filez]['tmp_name'];
		$ukuranfile_up = $_FILES[$filez]['size'];
		if($filez == "foto")
		$up_file = "./".$CI->config->item('path_upload')."/foto/".$file_up;
		else
		$up_file = "./".$CI->config->item('path_upload')."/".$file_up;
		
		$ext_file = strrchr($file_up, '.');
		if($ukuranfile_up < ($filesize * 1024))
		{
			if(strtolower($ext_file) == ".jpg" || strtolower($ext_file) == ".JPG" ||strtolower($ext_file) == ".jpeg" || strtolower($ext_file) == ".png")
			{
				if(copy($myfile_up, $up_file))
				{
					ResizeImage($up_file, 250, 250);
					return $file_up;
				}
			}
			//else if(strtolower($ext_file) == ".doc" || strtolower($ext_file) == ".docx" || strtolower($ext_file) == ".pdf")
			else
			{
				if(copy($myfile_up, $up_file))
				{
					return $file_up;
				}
				else return 3;
			}
			
		}
		else return 2;
	}
}

if (!function_exists('Page')){
	function Page($jum_record,$lmt,$pg,$path,$uri_segment)
	{
		$link = "";
		$config['base_url'] = $path;
		$config['total_rows'] = $jum_record;
		$config['per_page'] = $lmt;
		$config['num_links'] = 3;
		$config['cur_tag_open'] = '<li><strong>';
		$config['cur_tag_close'] = '</strong></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['uri_segment'] = $uri_segment;
		
		$CI =& get_instance();
		$CI->pagination->initialize($config);
		$link = $CI->pagination->create_links();
		return $link;
	}
}

if (!function_exists('CaptchaSecurityImages')){	
	function CaptchaSecurityImages($width='120',$height='40',$characters='6') 
	{
		$CI =& get_instance();
		$font = './assets/font/monofont.ttf';
		$code = generateCode($characters);
		/* font size will be 75% of the image height */
		$font_size = $height * 0.75;
		$image = @imagecreate($width, $height) or die('Cannot initialize new GD image stream');
		/* set the colours */
		$background_color = imagecolorallocate($image, 255, 255, 255);
		$text_color = imagecolorallocate($image, 20, 40, 100);
		$noise_color = imagecolorallocate($image, 100, 120, 180);
		/* generate random dots in background */
		for( $i=0; $i<($width*$height)/3; $i++ ) {
			imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
		}
		/* generate random lines in background */
		for( $i=0; $i<($width*$height)/150; $i++ ) {
			imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
		}
		/* create textbox and add text */
		$textbox = imagettfbbox($font_size, 0, $font, $code) or die('Error in imagettfbbox function');
		$x = ($width - $textbox[4])/2;
		$y = ($height - $textbox[5])/2;
		imagettftext($image, $font_size, 0, $x, $y, $text_color, $font , $code) or die('Error in imagettftext function');
		 
		
		/* output captcha image to browser */
		header('Content-Type: image/jpeg');
		imagejpeg($image);
		imagedestroy($image);
		$CI->session->set_userdata("security_code", $code);
	}
}

if (!function_exists('GetTanggal')){	
	function GetTanggal($tgl)
	{
		if(strlen($tgl) == 1) $tgl = "0".$tgl;
		return $tgl;
	}
}
if (!function_exists('tglindo')){	
	function tglindo($tgl)
	{
		//$t=explode('-',$tgl);
		return substr($tgl,8,2).'-'.substr($tgl,5,2).'-'.substr($tgl,0,4);
	}
}

if (!function_exists('GetBulanIndo')){	
	function GetBulanIndo($Bulan)
	{
		if($Bulan == "January")
			$Bulan = "Januari";
		else if($Bulan == "February")
			$Bulan = "Februari";
		else if($Bulan == "March")
			$Bulan = "Maret";
		else if($Bulan == "May")
			$Bulan = "Mei";
		else if($Bulan == "June")
			$Bulan = "Juni";
		else if($Bulan == "July")
			$Bulan = "Juli";
		else if($Bulan == "August")
			$Bulan = "Agustus";
		else if($Bulan == "October")
			$Bulan = "Oktober";
		else if($Bulan == "December")
			$Bulan = "Desember";

		return $Bulan;
	}
}

if (!function_exists('GetMonthIndex')){	
	function GetMonthIndex($var)
	{
		$bln = array("Jan"=> "01","Feb"=> "02","Mar"=> "03","Apr"=> "04","May"=> "05","Jun"=> "06","Jul"=> "07","Aug"=> "08","Sep"=> "09","Oct"=> "10","Nov"=> "11","Dec"=> "12");
		return $bln[$var];
	}
}

if (!function_exists('GetMonth')){	
	function GetMonth($id)
	{
		$bln = array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
		//$bln = array("","Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Dec");
		return $bln[$id];
	}
}

if (!function_exists('GetMonthFull')){	
	function GetMonthFull($id)
	{
		$id=intval($id);
		//$bln = array("","January","February","March","April","May","June","July","August","September","October","November","December");
		$bln = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		return $bln[$id];
	}
}

if (!function_exists('GetMonthShort')){	
	function GetMonthShort($val)
	{
		$bln = array("Januari"=> "Jan","Februari"=>"Feb","Maret"=>"Mar","April"=>"Apr","Mei"=>"May","Juni"=>"Jun","Juli"=>"Jul","Agustus"=>"Aug","September"=>"Sep","Oktober"=>"Oct","November"=>"Nov","Desember"=>"Dec");
		return $bln[$val];
	}
}

if (!function_exists('GetOptDate')){	
	function GetOptDate()
	{
		$opt[''] = "- Tanggal -";
		for($i=1;$i<=31;$i++)
		{
			if(strlen($i) == 1) $j = "0".$i;
			else $j=$i;
			$opt[$j] = $j;
		}
		return $opt;
	}
}

if (!function_exists('GetOptMonth')){	
	function GetOptMonth()
	{
		$opt[''] = "- Bulan -";
		$bln = array("01"=> "Januari","02"=> "Februari","03"=> "Maret","04"=>"April","05"=>"Mei","06"=>"Juni",
		"07"=>"Juli","08"=>"Agustus","09"=>"September","10"=>"Oktober","11"=>"November","12"=>"Desember");
		//$bln = array("","Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Dec");
		foreach($bln as $r=> $val)
		{
			$opt[$r] = $val;
		}
		
		return $opt;
	}
}

if (!function_exists('GetOptMonthFull')){	
	function GetOptMonthFull()
	{
		$opt[''] = "- Bulan -";
		$bln = array("Januari"=> "Januari","Februari"=> "Februari","Maret"=> "Maret","April"=>"April","Mei"=>"Mei","Juni"=>"Juni",
		"Juli"=>"Juli","Agustus"=>"Agustus","September"=>"September","Oktober"=>"Oktober","November"=>"November","Desember"=>"Desember");
		//$bln = array("","Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Dec");
		foreach($bln as $r=> $val)
		{
			$opt[$r] = $val;
		}
		
		return $opt;
	}
}

if (!function_exists('GetOptYear')){	
	function GetOptYear()
	{
		if(date("m") == "10") $year = date("Y") + 1;
		else $year = date("Y");
		$opt[''] = "- Tahun -";
		for($i=$year;$i >=2011;$i--)
		{
			$opt[$i] = $i;
		}
		return $opt;
	}
}

if (!function_exists('GetOptYeari')){	
	function GetOptYeari()
	{
		$opt[''] = "- Tahun -";
		for($i=date("Y");$i >=2006;$i--)
		{
			$opt[$i] = $i;
		}
		return $opt;
	}
}

if (!function_exists('GetOptRencanaTanggal')){	
	function GetOptRencanaTanggal()
	{
		if(date("m") == "10") $year = date("Y") + 1;
		else $year = date("Y");
		$opt[''] = "- Rencana Tanggal -";
		for($i=date("Y");$i <=$year;$i++)
		{
			for($j=1;$j<=12;$j++)
			{
				$opt[GetMonthFull($j)." ".$i] = GetMonthFull($j)." ".$i;
			}
		}
		return $opt;
	}
}

/* OPTIONS DROPDOWN */
if (!function_exists('GetOptAll')){
	function GetOptAll($tabel,$judul=NULL,$filter=NULL,$field=NULL,$id=NULL,$field2=NULL,$filter_where_in=NULL)
	{
		if($filter==NULL)$filter = array();
		if($filter_where_in==NULL)$filter_where_in = array();
		if($field==NULL)$field='title';
		if($id==NULL)$id='id';
		$q = GetAll($tabel, $filter,$filter_where_in);
		if($judul) $opt[''] = $judul;
		foreach($q->result_array() as $r)
		{
				if($field2!=NULL){$fl=$r[$field]. ' - '.$r[$field2];}
				else{ $fl = $r[$field];}
			$opt[$r[$id]] = $fl;
		}
		
		return $opt;
	}
}

if (!function_exists('GetOptAllMenu')){
	function GetOptAllMenu($tabel,$judul=NULL)
	{
		if($tabel == "pendidikan") $filter = array("urut"=> "order/asc");
		else $filter = array('is_active'=>'where/Active','id_parents'=>'order/ASC');
		$q = GetAll($tabel, $filter);
		if($judul) $opt[''] = $judul;
		foreach($q->result_array() as $r)
		{
			$opt[$r['id']] =  GetValue('title','sv_menu',array('id'=>'where/'.$r['id_parents'])).' - '. $r['title'] ;
		}
		
		return $opt;
	}
}


if (!function_exists('GetOptPublish')){	
	function GetOptPublish()
	{
		$opt = array("Publish"=> "Publish", "NotPublish"=> "NotPublish");
		
		return $opt;
	}
}

if (!function_exists('GetOptKBK')){	
	function GetOptKBK()
	{
		$opt = array("K"=> "K", "L"=> "L");
		
		return $opt;
	}
}

if (!function_exists('GetOptAgama')){
	function GetOptAgama()
	{
		$q = array('Moslem', 'Christian', 'Hindu', 'Budha', 'Catholic');
		$opt[''] = "- Agama -";
		foreach($q as $r)
		{
			$opt[$r] = $r;
		}
		
		return $opt;
	}
}

if (!function_exists('GetOptBlood')){
	function GetOptBlood()
	{
		$q = array('A', 'B', 'AB', 'O');
		$opt[''] = "- Gol. Darah -";
		foreach($q as $r)
		{
			$opt[$r] = $r;
		}
		
		return $opt;
	}
}



if (!function_exists('GetOptPosition')){	
	function GetOptPosition()
	{
		$q = GetAll("position", array("title"=> "order/asc"));
		$opt[''] = "- Position-";
		foreach($q->result_array() as $r)
		{
			$opt[$r['id']] = $r['title'];
		}
		
		return $opt;
	}
}

if (!function_exists('GetOptDepartment')){	
	function GetOptDepartment()
	{
		$CI =& get_instance();
		$q = GetAll("department");
		$opt[''] = "- Department -";
		if($CI->uri->segment(1) == "wp") $opt[-1] = "-";
		foreach($q->result_array() as $r)
		{
			$opt[$r['id']] = $r['title'];
		}
		
		return $opt;
	}
}

if (!function_exists('GetOptKedeputianSub')){	
	function GetOptKedeputianSub($id_deputi=NULL)
	{
		$CI =& get_instance();
		$filter = array();
		if($id_deputi) $filter['id_kedeputian'] = "where/".$id_deputi;
		$q = GetAll("kedeputian_sub", $filter);
		$opt[''] = "- Sub Divisi -";
		if($CI->uri->segment(1) == "wp") $opt[-1] = "-";
		foreach($q->result_array() as $r)
		{
			$opt[$r['id']] = $r['title'];
		}
		
		return $opt;
	}
}

if (!function_exists('GetOptMenu')){	
	function GetOptMenu()
	{
		$q = GetAll("menu_admin", array("title"=> "order/asc"));
		$opt[''] = "- Parents Menu -";
		foreach($q->result_array() as $r)
		{
			$opt[$r['id']] = $r['title'];
		}
		
		return $opt;
	}
}

if (!function_exists('GetOptGrup')){	
	function GetOptGrup()
	{
		$q = GetAll("admin_grup");
		$opt[''] = "- Grup Admin -";
		foreach($q->result_array() as $r)
		{
			$opt[$r['id']] = $r['title'];
		}
		
		return $opt;
	}
}

if (!function_exists('GetOptJenisCuti')){	
	function GetOptJenisCuti()
	{
		$q = GetAll("jenis_cuti");
		$opt[''] = "- Jenis Cuti -";
		foreach($q->result_array() as $r)
		{
			$opt[$r['id']] = $r['title'];
		}
		
		return $opt;
	}
}

if (!function_exists('GetOptJenisPertemuan')){	
	function GetOptJenisPertemuan($not_int=NULL, $judul=NULL)
	{
		$CI =& get_instance();
		if(count($not_int) > 0) $CI->db->where_not_in("id",$not_int);
		$q = $CI->db->get("jenis_pertemuan");
		$opt = array();
		if(!$judul) $opt[''] = "- Jenis Pertemuan -";
		else $opt[''] = $judul;
		foreach($q->result_array() as $r)
		{
			$opt[$r['id']] = $r['title'];
		}
		
		return $opt;
	}
}

if (!function_exists('DelImage')){	
	function DelImage()
	{
		$CI =& get_instance();
		$webmaster_id = $this->auth();
		$mz_function = new mz_function();
		$id = $CI->input->post('del_id_img');
		$table = $CI->input->post('del_table');
		$field = $CI->input->post('del_field');
		
		$GetFile = GetValue($field,$table, array("id"=> "where/".$id));
		$GetThumb = GetThumb($GetFile);
		if(file_exists("./".$CI->config->item('path_upload')."/".$GetFile)) unlink("./".$CI->config->item('path_upload')."/".$GetFile);
		if(file_exists("./".$CI->config->item('path_upload')."/".$GetThumb)) unlink("./".$CI->config->item('path_upload')."/".$GetThumb);
		
		$data[$field] = "";
		$this->db->where("id", $id);
		$this->db->update($table, $data);
	}
}

if (!function_exists('FormatTanggal')){
	function FormatTanggal($tgl)
	{
		$exp = explode("-", $tgl);
		$tgl = $exp[2]." ".GetMonthFull(intval($exp[1]))." ".$exp[0];
		return $tgl;
	}
}

if (!function_exists('FormatTanggalShort')){
	function FormatTanggalShort($tgl)
	{
		$exp = explode("-", $tgl);
		$tgl = $exp[2]." ".GetMonth(intval($exp[1]))." ".$exp[0];
		return $tgl;
	}
}

if (!function_exists('Rupiah')){
	function Rupiah($rp)
	{
		if($rp) return "Rp ".number_format($rp,0,",",".").",-";
		else return 0;
	}
}

if (!function_exists('rupiahs')){
	function rupiahs($rp)
	{
		if($rp) return "idr ".number_format($rp,0,",",".").",-";
		else return 0;
	}
}

if (!function_exists('uang')){
	function uang($rp)
	{
		if($rp) return number_format($rp,0,",",".").",-";
		else return 0;
	}
}
if (!function_exists('Decimal')){
	function Decimal($rp,$koma=2)
	{
		if($rp) return number_format($rp,$koma);
		else return 0;
	}
}

if (!function_exists('Number')){
	function Number($rp)
	{
		if($rp) return number_format($rp,0,",",".");
		else return 0;
	}
}

if (!function_exists('numbers')){
	function numbers($rp)
	{
		if($rp) return number_format($rp,0,".",",");
		else return 0;
	}
}

if (!function_exists('GetFilename')){
	function GetFilename($val)
	{
		if($val) return substr($val,15);
		else return "";
	}
}

if (!function_exists('GetTanggalIndo')){
	function GetTanggalIndo($val, $time=NULL)
	{
		$dt = strtotime($val);
		$dt = date("d", $dt)." ".GetBulanIndo(date("F", $dt))." ".date("Y", $dt);
		if($time) $dt .= "&nbsp;&nbsp;".substr($val,11,8);
		return $dt;
	}
}


if (!function_exists('GetLamaKerja')){
	function GetLamaKerja($dt)
	{
		$hr = date("d") - substr($dt,8,2);
		$bln = date("m") - substr($dt,5,2);
		$thn = date("Y") - substr($dt,0,4);
		
		if($hr < 0)
		{
			$hr += 30;
			$bln -=1;
		}
		
		if($bln < 0)
		{
			$bln += 12;
			$thn -=1;
		}
		
		$tahun = $thn > 0 ? $thn." tahun " : "";		
		$bulan = $bln > 0 ? $bln." bulan " : "";
		$hari = $hr > 0 ? $hr." hari " : "";
		
		$lama_kerja = $tahun.$bulan.$hari;
		return $lama_kerja;
	}
}

if (!function_exists('to_excel')){
	function to_excel($query, $filename='xlsoutput')
	{
		$headers = '';
	  header("Content-type: application/x-msdownload");
	  header("Content-Disposition: attachment; filename=$filename.xls");
	  echo "$headers\n$query";
	}
}

if (!function_exists('to_doc')){
	function to_doc($query, $filename='docoutput')
	{
		header("Content-type: application/msword");
	  header("Content-Disposition: attachment; filename=$filename.doc");
	  echo "$query";
	}
}

if (!function_exists('GetKehadiranTahunan')){
	function GetKehadiranTahunan($thn)
	{
		$hadir = GetAll("kehadirandetil", array("jh"=> "where/1", "tahun"=> "where/".$thn))->num_rows();
		$absen = GetAll("kehadirandetil", array("jh"=> "where/0", "tahun"=> "where/".$thn))->num_rows();
		if(!$absen) $absen=1;
		$persen = Decimal(($hadir / ($hadir + $absen)) * 100,2)." %";
		return $persen;
	}
}

if (!function_exists('GetOptAtasan')){
	function GetOptAtasan()
	{
		$CI =& get_instance();
		$id_user = $CI->session->userdata("sendyuu_webmaster_id");
		$opt[''] = "- Atasan -";
		$atasan = GetValue("id_atasan","admin",array("id"=> "where/".$id_user));
		if(strlen($atasan) > 2)
		{
			if(is_array(unserialize($atasan)))
			{
				foreach(unserialize($atasan) as $s)
				{
					if($s > 0)
					{
						$nama = GetValue("name","admin", array("id"=> "where/".$s));
						$opt[$s] = $nama;
					}
				}
			}
		}
		else
		{
			$nama = GetValue("name","admin", array("id"=> "where/".$atasan));
			$opt[0] = $nama;
		}
		
		return $opt;
	}
}

if (!function_exists('GetHRDIntendent')){
	function GetHRDIntendent()
	{
		return GetValue('name','employee',array("id_department"=> "where/7", "id_position"=> "where/3"));		
	}
}

if (!function_exists('GetHRDCoordinator')){
	function GetHRDCoordinator()
	{
		return GetValue('name','employee',array("id_department"=> "where/7", "id_position"=> "where/2"));		
	}
}

if (!function_exists('Overtime')){
	function Overtime($tgl, $jam)
	{
		if($jam > 0)
		{
			$overtime = ($jam * 2) - 0.5;
		}
		else $overtime=0;
		return $overtime;
	}
}

if (!function_exists('GetOfficeHours')){
	function GetOfficeHours($param="weekly")
	{
		if($param=="monthly") return 172;
		else return 48;
	}
}
function getBrowserOS() { 

    $user_agent     =   $_SERVER['HTTP_USER_AGENT']; 
    $browser        =   "Unknown Browser";
    $os_platform    =   "Unknown OS Platform";

    // Get the Operating System Platform

        if (preg_match('/windows|win32/i', $user_agent)) {

            $os_platform    =   'Windows';

            if (preg_match('/windows nt 6.2/i', $user_agent)) {

                $os_platform    .=  " 8";

            } else if (preg_match('/windows nt 6.1/i', $user_agent)) {

                $os_platform    .=  " 7";

            } else if (preg_match('/windows nt 6.0/i', $user_agent)) {

                $os_platform    .=  " Vista";

            } else if (preg_match('/windows nt 5.2/i', $user_agent)) {

                $os_platform    .=  " Server 2003/XP x64";

            } else if (preg_match('/windows nt 5.1/i', $user_agent) || preg_match('/windows xp/i', $user_agent)) {

                $os_platform    .=  " XP";

            } else if (preg_match('/windows nt 5.0/i', $user_agent)) {

                $os_platform    .=  " 2000";

            } else if (preg_match('/windows me/i', $user_agent)) {

                $os_platform    .=  " ME";

            } else if (preg_match('/win98/i', $user_agent)) {

                $os_platform    .=  " 98";

            } else if (preg_match('/win95/i', $user_agent)) {

                $os_platform    .=  " 95";

            } else if (preg_match('/win16/i', $user_agent)) {

                $os_platform    .=  " 3.11";

            }

        } else if (preg_match('/macintosh|mac os x/i', $user_agent)) {

            $os_platform    =   'Mac';

            if (preg_match('/macintosh/i', $user_agent)) {

                $os_platform    .=  " OS X";

            } else if (preg_match('/mac_powerpc/i', $user_agent)) {

                $os_platform    .=  " OS 9";

            }

        } else if (preg_match('/linux/i', $user_agent)) {

            $os_platform    =   "Linux";

        }

        // Override if matched

            if (preg_match('/iphone/i', $user_agent)) {

                $os_platform    =   "iPhone";

            } else if (preg_match('/android/i', $user_agent)) {

                $os_platform    =   "Android";

            } else if (preg_match('/blackberry/i', $user_agent)) {

                $os_platform    =   "BlackBerry";

            } else if (preg_match('/webos/i', $user_agent)) {

                $os_platform    =   "Mobile";

            } else if (preg_match('/ipod/i', $user_agent)) {

                $os_platform    =   "iPod";

            } else if (preg_match('/ipad/i', $user_agent)) {

                $os_platform    =   "iPad";

            }

    // Get the Browser

        if (preg_match('/msie/i', $user_agent) && !preg_match('/opera/i', $user_agent)) { 

            $browser        =   "Internet Explorer"; 

        } else if (preg_match('/firefox/i', $user_agent)) { 

            $browser        =   "Firefox";

        } else if (preg_match('/chrome/i', $user_agent)) { 

            $browser        =   "Chrome";

        } else if (preg_match('/safari/i', $user_agent)) { 

            $browser        =   "Safari";

        } else if (preg_match('/opera/i', $user_agent)) { 

            $browser        =   "Opera";

        } else if (preg_match('/netscape/i', $user_agent)) { 

            $browser        =   "Netscape"; 

        } 

        // Override if matched

            if ($os_platform == "iPhone" || $os_platform == "Android" || $os_platform == "BlackBerry" || $os_platform == "Mobile" || $os_platform == "iPod" || $os_platform == "iPad") { 

                if (preg_match('/mobile/i', $user_agent)) {

                    $browser    =   "Handheld Browser";

                }

            }
			//Check Proxy
		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
                $ipproxy = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ipproxy = 'NULL';
            }
			date_default_timezone_set('Asia/Jakarta');
    // Create a Data Array

        return array(
			'proxy' => $ipproxy,
			'ip'	=> $_SERVER['REMOTE_ADDR'],
            'browser'       =>  $browser,
            'os'   =>  $os_platform,
			'logged'	=>  date("Y-m-d H:i:s")
        );


} 

function areacover($area){
				switch ($area){
					case "jakpus": 
						return "Jakarta Pusat";
						break;
					case "jaksel":
						return "Jakarta Selatan";
						break;
					case "jaktim":
						return "Jakarta Timur";
						break;
					case "jakut":
						return "Jakarta Utara";
						break;
					case "jakbar":
						return "Jakarta Barat";
						break;
					case "bekasi":
						return "Bekasi";
						break;
					case "bogor":
						return "Bogor";
						break;
					case "depok":
						return "Depok";
						break;
					case "serpong":
						return "Serpong";
						break;
					case "tanggerang":
						return "Tanggerang";
						break;
				}
} 


function generate_invoices(){
	$CI =& get_instance();
$rou=date("YmdHis");
$numb=rand(111,999);
$oy=$CI->db->query("SELECT * FROM rb_invoices WHERE unique_key='$numb' AND created_on BETWEEN '".date('Y-m-d',strtotime("-7 days"))." 00:00:00' AND  '".date('Y-m-d')." 23:59:59' ");
	if($oy->num_rows()>0){
		$numb=rand(111,999);		
		$oy=$CI->db->query("SELECT * FROM rb_invoices WHERE unique_key='$numb' AND created_on BETWEEN '".date('Y-m-d',strtotime("-7 days"))." 00:00:00' AND  '".date('Y-m-d')." 23:59:59' ");
		if($oy->num_rows()>0){
			$numb=rand(111,999);		
			$oy=$CI->db->query("SELECT * FROM rb_invoices WHERE unique_key='$numb' AND created_on BETWEEN '".date('Y-m-d',strtotime("-7 days"))." 00:00:00' AND  '".date('Y-m-d')." 23:59:59' ");
				if($oy->num_rows()>0){
					$numb=rand(111,999);		
					$oy=$CI->db->query("SELECT * FROM rb_invoices WHERE unique_key='$numb' AND created_on BETWEEN '".date('Y-m-d',strtotime("-7 days"))." 00:00:00' AND  '".date('Y-m-d')." 23:59:59' ");
					if($oy->num_rows()>0){
						$numb=rand(111,999);		
						$oy=$CI->db->query("SELECT * FROM rb_invoices WHERE unique_key='$numb' AND created_on BETWEEN '".date('Y-m-d',strtotime("-7 days"))." 00:00:00' AND  '".date('Y-m-d')." 23:59:59' ");
					}
				}
		}
	}
$data['keys']=$numb;
$data['invoices']=$rou.$numb;

return $data;	
}

function cart_display($id=NULL){
	$CI =& get_instance();
	if(!$CI->session->userdata('sendyuu_logged')){
	return $CI->cart->contents();}
	else{
	$q=$CI->db->select('*')->from('rb_cart_temp')->where('id_customer',$CI->session->userdata('sendyuu_id_customer'))->get();
	return $q->result_array();	

	//$this->db->lastq();
	}
}
function cart_total($id=NULL){
	$CI =& get_instance();
	if(!$CI->session->userdata('sendyuu_logged')){
	return $CI->cart->total();}
	else{
	$q="SELECT SUM(price) as totalharga FROM rb_cart_temp WHERE id_customer='".$CI->session->userdata('sendyuu_id_customer')."'";
		$qw=$CI->db->query($q)->row_array();
		return $qw['totalharga'];
	}
}
function destroy_cart($id=NULL){
	$CI=&get_instance();
	if(!$CI->session->userdata('sendyuu_logged')){
	return $CI->cart->destroy();}
	else{
	$CI->db->where('id_customer',$CI->session->userdata('sendyuu_id_customer'));
	return $CI->db->delete('rb_cart_temp');
	
	}
}
function total_items($id=NULL){
	$CI=&get_instance();
	if(!$CI->session->userdata('sendyuu_logged')){
	return $CI->cart->total_items();
}
	else{
	$q=$CI->db->select('*')->from('rb_cart_temp')->where('id_customer',$CI->session->userdata('sendyuu_id_customer'))->get();
	return $q->num_rows();
	}
} 
function insertochart($data){
	$CI=&get_instance();
	if(!$CI->session->userdata('sendyuu_logged')){
	$CI->cart->insert($data);
	}
	else{
		unset($data['options']);
		$data['added']=date("Y-m-d H:i:s");
		$data['id_customer']=$CI->session->userdata('sendyuu_id_customer');
				$CI->db->insert('rb_cart_temp',$data);
	}
}
// Load Language Files 
function bahasa(){
	$CI=&get_instance();
	//$CI->session->unset_userdata('bahasa');
if(!$CI->session->userdata('bahasa')) {
    $CI->session->set_userdata('bahasa','indonesia');
    //$lange = 'indonesia';
} /*else {
    $lange = 'inggris';
}*/
$lange=$CI->session->userdata('bahasa');
$CI->lang->load('main',$lange);
}
function send_activation(){
	$CI=&get_instance();
//$CI->load->library('email');
/**/
$CI->email->from('administrator@sendyuu.com', 'Sendyuu.com');
$CI->email->to('jhanojan@gmail.com'); 
$CI->email->cc('jhanojan@gmail.com'); 
/*$CI->email->bcc('them@their-example.com');*/
$CI->email->subject('Email Test');
$CI->email->message('Testing the email class.');	

$CI->email->send();	


//echo $this->email->print_debugger();	
}
function swal($title=NULL,$mess=NULL,$type=NULL,$button=NULL,$link=NULL){
	echo "
		<link rel='stylesheet' type='text/css' href='". base_url('assets')."/sweetalert/lib/sweet-alert.css'>
    	<script src='".base_url('assets')."/sweetalert/lib/sweet-alert.min.js'></script>
    	<script src='".base_url('assets')."/shophomes/js/jquery-1.11.0.js'></script>
		<script>$(document).ready(function () {
    	swal({
        title: '".$title."',   text: '".$mess."',   type: '".$type."',   confirmButtonText: '".$button."'
    },
    function(){
		".$link.";
    });
		});
		</script>";
	
}
function swaload($title=NULL,$mess=NULL,$type=NULL,$button=NULL,$link=NULL){
	echo "
		<link rel='stylesheet' type='text/css' href='". base_url('assets')."/sweetalert/lib/sweet-alert.css'>
    	<script src='".base_url('assets')."/sweetalert/lib/sweet-alert.min.js'></script>
    	<script src='".base_url('assets')."/shophomes/js/jquery-1.11.0.js'></script>
		<script>$(document).ready(function () {
    	swal({
        title: '".$title."',   text: '".$mess."',   imageUrl: 'https://d13yacurqjgara.cloudfront.net/users/8424/screenshots/1036999/dots_2.gif', closeOnConfirm: false,   confirmButtonText: '".$button."'
    }
    });
		});
		</script>";
	
}

function romawimonth($m){
		$format=array(
		'01'=>'I',
		'02'=>'II',
		'03'=>'III',
		'04'=>'IV',
		'05'=>'V',
		'06'=>'VI',
		'07'=>'VII',
		'08'=>'VIII',
		'09'=>'IX',
		'10'=>'X',
		'11'=>'XI',
		'12'=>'XII',
		);
		return $format[$m];
}

function generatenumbering($module=NULL,$parent=NULL,$type=NULL,$form=NULL,$div=NULL,$cln=NULL){
	
	$CI=&get_instance();
	$getsetting=$CI->db->query("SELECT * FROM sv_setup_auto_number WHERE name='$module'")->row();
	$y=date("Y");
	$m=date("m");
	$d=date("d");
	
	$code=array(
		'exportseaNORMAL'=>'1',
		'importseaNORMAL'=>'2',
		'exportairNORMAL'=>'3',
		'importairNORMAL'=>'4',
		'exportseaCC'=>'5',
		'importseaCC'=>'6',
		'exportairCC'=>'7',
		'importairCC'=>'8',
	);
	
	$numtype='';
	if($parent !=NULL && $type!=NULL && $form!=NULL){
			$keys=$parent.$type.$form;
			$numtype=$code[$keys];
	}
	
	
	$q="SELECT * FROM sv_counter_auto_number WHERE id_module='".$getsetting->id."'  ";
	if($getsetting->throw=="Y"){$q.="AND year='$y' ";}
	if($getsetting->throw=="M"){$q.="AND month='$m' ";}
	if($getsetting->throw=="D"){$q.="AND date='$d' ";}
	$query=$CI->db->query($q);
	if($query->num_rows()==0){
			$CI->db->insert('sv_counter_auto_number',array('id_module'=>$getsetting->id,'month'=>$m,'year'=>$y,'date'=>$d,'counter'=>0,'last_update'=>date("Y-m-d H:i:s")));
			$query=$CI->db->query($q);
	}
	$lastnum=$query->row();
	$num=$lastnum->counter+1;
	if(strlen($num)<=4){$num=substr('000'.$num,-4);} 
	
	$arrfor=array(
	0=>$getsetting->prefix1,
	1=>$getsetting->prefix_separator1,
	2=>$getsetting->prefix2,
	3=>$getsetting->prefix_separator2,
	4=>$getsetting->prefix3,
	5=>$getsetting->prefix_separator3,
	6=>$getsetting->prefix_suffix_separator,
	7=>$getsetting->suffix1,
	8=>$getsetting->suffix_separator1,
	9=>$getsetting->suffix2,
	10=>$getsetting->suffix_separator2,
	11=>$getsetting->suffix3,
	12=>$getsetting->suffix_separator3
	);
	
	if(in_array('NUMBERING',$arrfor)){
			$format=implode('',$arrfor);
	}
	else{
	$format=$getsetting->prefix1.$getsetting->prefix_separator1.$getsetting->prefix2.$getsetting->prefix_separator2.$getsetting->prefix3.$getsetting->prefix_separator3.$num.$getsetting->prefix_suffix_separator.$getsetting->suffix1.$getsetting->suffix_separator1.$getsetting->suffix2.$getsetting->suffix_separator2.$getsetting->suffix3.$getsetting->suffix_separator3;
	}
	$format=str_replace('YL',date('Y'),str_replace('TYPE',strtoupper(substr($parent,0,3)),str_replace('CLN',$cln,str_replace('MROM',romawimonth(date('m')),str_replace('DIV',$div,str_replace('FORM',$numtype,str_replace('NUMBERING',$num,str_replace('YEAR',date("y"),str_replace('MONTH',date('m'),$format)))))))));
	$format=str_replace('DAY',date('d'),$format);
	
	return $format;	
		
}

function addnumbering($module=NULL){
		$CI=&get_instance();
		$idmod=GetValue('id','sv_setup_auto_number',array('name'=>'where/'.$module));
		$CI->db->query("UPDATE sv_counter_auto_number SET counter=counter+1,last_update='".date("Y-m-d H:i:s")."' WHERE id_module='$idmod'");
}
function generateai($data){
	$CI=&get_instance();
		$hrg=0;
		$vals=GetAll('sv_master_exim',array('alias'=>'where/0'))->result_array();
		foreach($vals as $item){
			if($data['type']=='LCL'){$hrg=GetValue('charge_lcl','sv_quotation_exim_custom',array('prospek'=>'where/'.$data['prospek'],'item'=>'where/'.$item['id']),'id desc');}
				else{
						if($data['cont_20']>0){
								$hrg=GetValue('charge_20','sv_quotation_exim_custom',array('prospek'=>'where/'.$data['prospek'],'item'=>'where/'.$item['id']),'id desc');
						}
						if($data['cont_40']>0){
								$hrg=GetValue('charge_40','sv_quotation_exim_custom',array('prospek'=>'where/'.$data['prospek'],'item'=>'where/'.$item['id']),'id desc');
						}
						if($data['cont_45']>0){
								$hrg=GetValue('charge_45','sv_quotation_exim_custom',array('prospek'=>'where/'.$data['prospek'],'item'=>'where/'.$item['id']),'id desc');
						}
						
				}
				$ai['job_order']=$data['number'];
				$ai['b_acc']=$item['acno'];
				$ai['c_acc']=$item['acno2'];
				$ai['b_currency']='IDR';
				$ai['b_rc']=1;
				$ai['b_rv']=$hrg;
				$ai['b_amount']=$hrg;
				$ai['b_subtotal']=$hrg;
				$ai['b_item']=1;
				$ai['b_item_price']=$ai['b_item']*$hrg;
				$ai['acc']=$item['name'];
				$ai['b_desc']=$item['name'];
				$CI->db->insert('ai',$ai);
		}
	
	$vals=GetAll('sv_master_exim',array('alias'=>'where/hand_'.$data['line']))->result_array();
	foreach($vals as $item){
		if($data['type']=='LCL'){$hrg=GetValue('charge_lcl','sv_quotation_exim_custom',array('prospek'=>'where/'.$data['prospek'],'item'=>'where/'.$item['id']),'id desc');}
		else{
			if($data['cont_20']>0){
				$hrg=GetValue('charge_20','sv_quotation_exim_custom',array('prospek'=>'where/'.$data['prospek'],'item'=>'where/'.$item['id']),'id desc');
			}
			if($data['cont_40']>0){
				$hrg=GetValue('charge_40','sv_quotation_exim_custom',array('prospek'=>'where/'.$data['prospek'],'item'=>'where/'.$item['id']),'id desc');
			}
			if($data['cont_45']>0){
				$hrg=GetValue('charge_45','sv_quotation_exim_custom',array('prospek'=>'where/'.$data['prospek'],'item'=>'where/'.$item['id']),'id desc');
			}
			
		}
		$ai['job_order']=$data['number'];
		$ai['b_currency']='IDR';
		$ai['b_acc']=$item['acno'];
		$ai['c_acc']=$item['acno2'];
		$ai['b_item_price']=$ai['b_item']*$hrg;
		$ai['b_item']=1;
		$ai['b_amount']=$hrg;
		$ai['b_subtotal']=$hrg;
		$ai['acc']=$item['name'];
		$ai['b_desc']=$item['name'];
		$CI->db->insert('ai',$ai);
	}
		
}
function generateaitrucking($data){
	$CI=&get_instance();
		$hrg=0;
		$vals=GetAll('sv_marketing_form_prospect',array('id'=>'where/'.$data['prospek']))->result_array();
		foreach($vals as $item){
			$type=GetValue('code','sv_master_trucking',array('id'=>'where/'.$data['service']));
			$hrg=GetValue($type,'sv_quotation_trucking_custom',array('prospek'=>'where/'.$data['prospek']),'id desc');
				$ai['job_order']=$data['number'];
				$ai['b_subtotal']=$hrg;
		$ai['b_currency']='IDR';
		$ai['b_item']=1;
		$ai['b_amount']=$hrg;
				$ai['acc']='Trucking Charge';
				$ai['b_desc']='Trucking Charge';
				$CI->db->insert('ai',$ai);
		}
	
	
		$ai['b_acc']='11.10.000';
		$ai['c_acc']='11.10.000';
		$ai['job_order']=$data['number'];
		$ai['b_subtotal']='70000';
		$ai['b_currency']='IDR';
		$ai['b_item']=1;
		$ai['b_amount']='70000';
		$ai['acc']='Biaya Bongkar';
		$ai['b_desc']='Biaya Bongkar';
		$CI->db->insert('ai',$ai);
	
			$hrg=GetValue('tailyman','sv_quotation_trucking_custom',array('prospek'=>'where/'.$data['prospek']),'id desc');
		
		$ai['b_acc']='11.10.000';
		$ai['c_acc']='11.10.000';
		$ai['job_order']=$data['number'];
		$ai['b_subtotal']=$hrg;
		$ai['b_item']=1;
		$ai['b_amount']=$hrg;
		$ai['acc']='Kondektur';
		$ai['b_currency']='IDR';
		$ai['b_desc']='Kondektur';
		$CI->db->insert('ai',$ai);
	
		
}
function webmastergrup(){
	$CI=&get_instance();
	$group = $CI->session->userdata('webmaster_grup');
	return $group;
}
function getkurs($id){
	
	$CI=&get_instance();
	$today=date('Y-m-d');
	$q=$CI->db->query("SELECT * FROM sv_setup_currency WHERE currency='$id' AND effective<='$today' ORDER BY effective DESC LIMIT 1")->row_array();
	return $q['kurs'];
	
}
function keluarstok($gudang,$barang,$qty,$satuan=NULL){
	$CI=&get_instance();
	$satuanbarang=GetValue('satuan','barang',array('id'=>'where/'.$barang));
	if($satuan!=$satuanbarang){
		$multiply=GetValue('value','barang_satuan',array('barang_id'=>'where/'.$barang,'satuan'=>'where/'.$satuan));
		$qty=$qty*$multiply;
	}
		$dalam=GetValue('dalam_stok','stok',array('barang_id'=>'where/'.$barang,'gudang_id'=>'where/'.$gudang));
		if($dalam>=$qty){
		$q="UPDATE stok SET dalam_stok=dalam_stok-$qty WHERE gudang_id='$gudang' AND barang_id='$barang'";
		$ex=$CI->db->query($q);
		if($ex) return TRUE;
		else return FALSE;
		}
}
function masukstok($gudang,$barang,$qty,$satuan=NULL){
	$CI=&get_instance();
	$satuanbarang=GetValue('satuan','barang',array('id'=>'where/'.$barang));
	if($satuan!=$satuanbarang){
		$multiply=GetValue('value','barang_satuan',array('barang_id'=>'where/'.$barang,'satuan'=>'where/'.$satuan));
		$qty=$qty*$multiply;
	}
	
		$dalam=$CI->db->query("SELECT * FROM stok WHERE gudang_id='$gudang' AND barang_id='$barang'");
		if($dalam->num_rows()>0){
			$q="UPDATE stok SET dalam_stok=dalam_stok+$qty WHERE gudang_id='$gudang' AND barang_id='$barang'";
			$ex=$CI->db->query($q);
			if($ex) return TRUE;
			else return FALSE;
		}
		else{
			$q="INSERT INTO stok SET dalam_stok=$qty,gudang_id='$gudang',barang_id='$barang'";
			$ex=$CI->db->query($q);
			if($ex) return TRUE;
			else return FALSE;	
		}
}
function getoptsatuan($barang){
	$q = GetAll('barang_satuan', array('barang_id'=>'where/'.$barang));
	//if($judul) $opt[''] = $judul;
	$small=GetValue('satuan','barang',array('id'=>'where/'.$barang));
	$opt['']='-Satuan-';
	$opt[$small] = GetValue('title','satuan',array('id'=>'where/'.$small));
	//$opt[$small]=GetValue('title','satuan',array('id'=>'where/'.$small));
	foreach($q->result_array() as $r)
	{
			if(!in_array($r['id'],$opt)){
			$opt[$r['id']] = $r['title'];}
	}
	
	return $opt;
}
/* function generateinvoice($mod,$div,$data,$ids=NULL,$tbl=NULL){
		$client=isset($data['shipper']) ? $data['shipper'] : $data['messers'];
		
		$cln=GetValue('code','master_client',array('id'=>'where/'.$client));
		generatenumbering($mod,NULL,NULL,NULL,$div,cln);
		
} */

?>