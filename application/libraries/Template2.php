<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Template2
{
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    public function load($view, $data = array())
    {
        // PERBAIKAN: Pastikan $data adalah array
        if (!is_array($data)) {
            $data = array('title' => $data); // Jika $data string, masukkan ke index title
        }

        // Ambil role dari session
        $role_id = $this->ci->session->userdata('role');

        // Load model & ambil menu secara otomatis
        $this->ci->load->model('User_model');

        // Baris 22: Sekarang aman karena $data sudah pasti array
        $data['menus'] = $this->ci->User_model->getMenuByRole($role_id);

        // Load konten utama ke dalam variabel 'contents'
        $data['contents'] = $this->ci->load->view($view, $data, TRUE);

        // Load file wrapper utama (main.php)
        return $this->ci->load->view('medinova/main', $data);
    }
}
