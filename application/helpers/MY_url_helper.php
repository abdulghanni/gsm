<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Assets URL
 *
 * @access	public
 * @param	string
 * @return	string
 */
if ( ! function_exists('assets_url'))
{
    function assets_url($uri = '')
    {
        return base_url().'assets/' . trim($uri, '/');
    }
}

/* End of file MY_url_helper.php */
/* Location: ./application/helpers/MY_url_helper.php */