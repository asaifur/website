<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{

    public function index($slug = null)
    {
        // 1. Ambil domain terlebih dahulu
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $domain = $this->Domain_model->getDomain($host);

        if (!$domain) {
            show_404('Domain tidak terdaftar atau nonaktif');
        }

        // 2. Format slug
        $slug = empty($slug) ? "home" : strtolower($slug);

        // 3. Ambil data halaman berdasarkan slug dan ID domain
        $page = $this->Page_model->getPage($slug, $domain->id);

        // Tampilkan 404 jika halaman TIDAK ditemukan
        if (!$page) {
            show_404();
        }

        // 4. Ambil section dan menu
        $sections = $this->Page_model->getSections($page->id_page);
        $menus = $this->Menu_model->getMenuTree($domain->id);

        // 5. Mapping data untuk view
        $data = [
            'domain'         => $domain,
            'page'           => $page,
            'sections'       => $sections,
            'menus'          => $menus,
            'iframe_content' => html_escape($domain->iframe),

            // Meta Tags dinamis (mengutamakan meta page, fallback ke domain)
            'title'          => $page->title ?? $domain->domain_name ?? '',
            'description'    => $page->meta_description ?? $domain->meta_description ?? '',
            'keywords'       => $page->meta_keywords ?? $domain->meta_keywords ?? '',
            'author'         => $domain->meta_author ?? '',
            'image'          => !empty($domain->image_domain) ? base_url($domain->image_domain) : base_url('assets/monoline/assets/images/og-default.jpg'),
            'url'            => current_url(),
            'type'           => 'website',

            // Kontak
            'contact'        => [
                'email'   => $domain->email,
                'phone'   => $domain->telepon,
                'address' => $domain->alamat,
                'wa'      => $domain->wa_link
            ],

            // Media Sosial
            'socials'        => [
                'fb' => $domain->link_facebook,
                'tw' => $domain->link_twitter,
                'ig' => $domain->link_instagram,
                'yt' => $domain->link_youtube
            ]
        ];

        // 6. Load view
        $this->template->load($domain->theme, 'page', $data);
    }
    public function page($slug = null)
    {
        if (empty($slug)) {
            redirect(base_url());
        }

        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $domain = $this->Domain_model->getDomain($host);

        if (!$domain) {
            show_404();
        }

        $slug = strtolower(trim($slug));

        // Ambil data halaman berdasarkan slug dan id_domain
        $page = $this->Page_model->getPage($slug, $domain->id);

        if (!$page) {
            show_404();
        }

        $sections = $this->Page_model->getSections($page->id_page);
        $menus    = $this->Menu_model->getMenuTree($domain->id);

        $data = [
            'domain'         => $domain,
            'page'           => $page,
            'sections'       => $sections,
            'menus'          => $menus,
            'iframe_content' => html_escape($domain->iframe),

            // Meta Tags
            'title'          => !empty($page->title) ? $page->title : $domain->title,
            'description'    => !empty($page->meta_description) ? $page->meta_description : $domain->meta_description,
            'keywords'       => !empty($page->keywords) ? $page->keywords : $domain->meta_keywords,
            'author'         => !empty($page->meta_author) ? $page->meta_author : $domain->meta_author,
            'image'          => !empty($page->image_features)
                ? base_url('assets/uploads/img/' . $page->image_features)
                : base_url('assets/uploads/img/' . $domain->logo),
            'url'            => current_url(),
            'type'           => 'article'
        ];

        $this->template->load($domain->theme, 'page', $data);
    }


    public function ajax_list()
    {
        $page     = $this->input->get('page');
        $search   = $this->input->get('search');
        $limit = 6;
        $this->db->from('table_pages');
        $this->db->where('category', '2');

        if (!empty($search)) {
            $this->db->like('title', $search);
        }

        $total = $this->db->count_all_results('', false);

        $query = $this->db->get();
        $data['news'] = $query->result();
        // Render HTML
        $html = $this->load->view('news/_list', $data, TRUE);

        // Pagination manual
        $totalPages = ceil($total / $limit);
        $pagination = "";

        for ($i = 1; $i <= $totalPages; $i++) {
            $active = ($i == $page) ? "active" : "";
            $pagination .= "<a href='#' class='$active' data-page='$i'>$i</a>";
        }

        echo json_encode([
            "html" => $html,
            "pagination" => $pagination
        ]);
    }
}
