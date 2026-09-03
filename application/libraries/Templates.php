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
        $admin = $userdata['is_admin'];
        $this->ci->load->model('User_model');
        $role_id = $userdata['role'];
        $data['modul'] = $this->ci->User_model->fetch_data_by_modul('user_menu', 'modul');
        $menus = $this->ci->User_model->getMenu($admin, $userdata['id']);
        $groupedMenus = [];

        foreach ($menus as $m) {
            $groupedMenus[$m->modul][] = $m;
        }
        $data['menus'] = $groupedMenus;
        $data['contents'] = $this->ci->load->view($view, $data, TRUE);
        return $this->ci->load->view('template/main', $data);
    }
}
