<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends MY_Controller
{
    public function __construct()

    {

        parent::__construct();

        // Proteksi Halaman: Cek apakah session 'logged_in' ada

        if (!$this->session->userdata('email')) {

            redirect('admin');
        }

        $this->load->model('Project_model');
        $this->load->model('User_model');
    }

    function view($slug)
    {

        $this->load->model('Page_model');

        $page = $this->Page_model->getPage($this->domain->id_domain, $slug);

        if (!$page) {
            show_404();
        }

        $data['page'] = $page;

        $theme = $this->domain->theme;

        $this->load->view("themes/$theme/header", $data);
        $this->load->view("themes/$theme/page", $data);
        $this->load->view("themes/$theme/footer", $data);
    }
}
