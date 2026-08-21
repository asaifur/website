<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Errors extends MY_Controller
{
    public function page_missing()
    {
        // Meta Default
        $data['title'] = '404 - Halaman Tidak Ditemukan';
        $data['description'] = 'Halaman yang Anda cari tidak tersedia.';
        $data['keywords'] = '404, halaman tidak ditemukan';

        // Robots khusus 404
        $data['robots'] = 'noindex,follow';

        // Domain fallback supaya tidak error
        $data['domain'] = [
            'logo' => 'default.png',
            'favicon' => 'default.png',
            'meta_author' => 'Solusi Dapur Restoran',
            'meta_og_image' => 'default.png',
            'robots_index' => 'noindex,follow'
        ];

        // Menu global
        $data['menu_header'] = $this->menu_header ?? [];

        // Set header 404
        $this->output->set_status_header(404);

        // Load khusus view 404 (tanpa homepage layout)
        $this->load->view('medinova/404', $data);
    }
}
