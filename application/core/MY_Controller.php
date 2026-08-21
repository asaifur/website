<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{

    public $domain;

    function __construct()
    {
        parent::__construct();

        $host = $_SERVER['HTTP_HOST'];

        $this->load->model('Domain_model');

        $host = $_SERVER['HTTP_HOST'];
        $this->domain = $this->Domain_model->getDomain($host);

        if (!$this->domain) {
            show_404();
        }
    }
}
