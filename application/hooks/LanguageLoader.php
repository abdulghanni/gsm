<?php
class LanguageLoader
{
    function initialize() {
        $ci =& get_instance();
        $ci->load->helper('language');

        $site_lang = $ci->session->userdata('site_lang');
        if ($site_lang) {
            $ci->lang->load('auth',$ci->session->userdata('site_lang'));
            $ci->lang->load('general',$ci->session->userdata('site_lang'));
            $ci->lang->load('master/stok',$ci->session->userdata('site_lang'));
        } else {
            $ci->lang->load('general','indonesian');
            $ci->lang->load('auth','indonesian');
            $ci->lang->load('master/stok','indonesian');
        }
    }
}