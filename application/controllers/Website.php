<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Website extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($slug = null)
    {
        // 1. Validasi: jika slug kosong (misal akses /website saja), tampilkan 404
        if (empty($slug)) {
            show_404();
        }

        // 2. Ambil host mentah dan ekstrak ke domain utama (abaikan subdomain & port)
        $raw_host    = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $root_domain = $this->extract_root_domain($raw_host);

        // 3. Query domain di database
        $domain = $this->db
            ->group_start()
            ->where('url_domain', $root_domain)
            ->or_like('url_domain', $root_domain)
            ->group_end()
            ->get('table_domain')
            ->row_array();

        if (!$domain) {
            show_404('Domain tidak terdaftar.');
        }

        // 4. Ambil konten website berdasarkan id_domain dan slugname
        $slug_clean = strtolower(trim($slug));
        $website_content = $this->db
            ->where('id_domain', $domain['id'])
            ->where('slugname', $slug_clean)
            ->get('table_website')
            ->row_array();

        if (!$website_content) {
            show_404('Halaman tidak ditemukan.');
        }

        // 5. Kirim data ke view
        $data = [
            'domain'  => $domain,
            'page'    => $website_content,
            'title'   => ucwords(str_replace('-', ' ', $website_content['slugname'])),
            'content' => $website_content['content'] ?? ''
        ];

        $this->load->view('adminlte/website_detail', $data);
    }

    private function extract_root_domain($host)
    {
        // Bersihkan port (misal localhost:8080 atau domain.com:443)
        $host = explode(':', $host)[0];
        $host = strtolower(trim($host));

        if ($host === 'localhost' || filter_var($host, FILTER_VALIDATE_IP)) {
            return $host;
        }

        $parts = explode('.', $host);
        $totalParts = count($parts);

        if ($totalParts < 2) {
            return $host;
        }

        $two_part_tlds = ['co.id', 'ac.id', 'sch.id', 'go.id', 'mil.id', 'or.id', 'web.id', 'biz.id', 'my.id', 'co.uk', 'com.au'];
        $last_two = $parts[$totalParts - 2] . '.' . $parts[$totalParts - 1];

        if (in_array($last_two, $two_part_tlds) && $totalParts >= 3) {
            return $parts[$totalParts - 3] . '.' . $last_two;
        }

        return $parts[$totalParts - 2] . '.' . $parts[$totalParts - 1];
    }
}
