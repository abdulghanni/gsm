<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends MX_Controller {
    public $data;
    var $module = 'sales';
    var $title = 'sales';
    var $file_name = 'sales';

	function __construct()
	{
		parent::__construct();
	}

	// redirect if needed, otherwise display the user list
	function index()
	{
        permissionUser();
		redirect($this->module.'/order','refresh');
	}

}