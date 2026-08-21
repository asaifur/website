<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Templates
{
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    public function load($view, $data = array())
    {
        if (!is_array($data)) {
            $data = array('title' => $data); // Jika $data string, masukkan ke index title
        }

        // Ambil role dari session
        $userdata = $this->ci->session->userdata();
        $this->ci->load->model('User_model');
        $role_id = $userdata['role'];
        $menus = $this->ci->User_model->getMenuByRole($role_id);
        $data['contents'] = $this->ci->load->view($view, $data, TRUE);
        $data['menus'] = $menus;
        return $this->ci->load->view('template/main', $data);
    }
}
