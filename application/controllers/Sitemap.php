<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sitemap extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Page_model');
        $this->load->model('Sitemap_model');
    }

    public function index()
    {
        header("Content-Type: application/xml; charset=UTF-8");

        $data['pages'] = $this->Page_model->get_active_pages();
        $data['links'] = $this->Sitemap_model->get_active_links();
        $this->load->view('sitemap_xml', $data);
    }
}
