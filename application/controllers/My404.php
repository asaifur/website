<?php
defined('BASEPATH') or exit('No direct script access allowed');

class My404 extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // 1. Set HTTP status response code ke 404 Not Found (Penting untuk SEO)
        $this->output->set_status_header('404');

        // 2. Ambil host & domain
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $domain = $this->Domain_model->getDomain($host);

        // Fallback jika domain tidak ditemukan
        if (!$domain) {
            show_404('Domain tidak terdaftar atau nonaktif');
            return;
        }

        // 3. Mapping data untuk view 404
        $data = [
            'domain'      => $domain,

            // Meta Tags Khusus Halaman 404
            'title'       => '404 - Halaman Tidak Ditemukan',
            'description' => $domain->meta_description ?? '',
            'keywords'    => $domain->meta_keywords ?? '',
            'author'      => $domain->meta_author ?? '',
            'image'       => !empty($domain->image_domain) ? base_url($domain->image_domain) : base_url('assets/monoline/assets/images/og-default.jpg'),
            'url'         => base_url(),
            'type'        => 'website',

            // Data kontak
            'contact'     => [
                'email'   => $domain->email,
                'phone'   => $domain->telepon,
                'address' => $domain->alamat,
                'wa'      => $domain->wa_link
            ],

            // Data media sosial
            'socials'     => [
                'fb' => $domain->link_facebook,
                'tw' => $domain->link_twitter,
                'ig' => $domain->link_instagram,
                'yt' => $domain->link_youtube
            ]
        ];

        // Data pendukung template
        $data['iframe_content'] = html_escape($domain->iframe);
        $data['menus']          = $this->Menu_model->getMenuTree($domain->id);

        // 4. Load view 404 menggunakan template theme dinamis
        $this->template->load($domain->theme, '404', $data);
    }
}
