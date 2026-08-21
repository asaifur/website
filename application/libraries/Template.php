<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Template
{

    protected $CI;

    function __construct()
    {
        $this->CI = &get_instance();
    }

    function load($theme, $view, $data = [])
    {
        $this->CI->load->view("$theme/header", $data);
        $this->CI->load->view("$theme/$view", $data);
        $this->CI->load->view("$theme/footer", $data);
    }
}
