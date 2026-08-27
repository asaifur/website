<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Load model yang dibutuhkan
        $this->load->model('Domain_model');
        $this->load->model('Menu_model');
        $this->load->model('Page_model'); // Asumsi model ini juga mengelola artikel
        $this->load->library('pagination');
    }

    /**
     * Menampilkan Daftar Artikel (Blog Index)
     */
    public function index()
    {
        // 1. Ambil domain dari host aktif
        $raw_host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $host     = parse_url('http://' . $raw_host, PHP_URL_HOST);
        $domain   = $this->Domain_model->getDomain($host);

        if (!$domain) {
            show_404('Domain tidak terdaftar atau nonaktif');
        }

        // 2. Pengaturan Pagination
        $config['base_url']   = base_url('blog/index');
        $config['total_rows'] = $this->db->where('id_domain', $domain->id)
            ->where('category', '3') // Asumsi ID kategori blog = 3
            ->count_all_results('table_pages');
        $config['per_page']   = 6;
        $config['uri_segment'] = 3;

        // Style Pagination Bootstrap (Opsional disesuaikan dengan template)
        $config['full_tag_open']   = '<ul class="pagination justify-content-center">';
        $config['full_tag_close']  = '</ul>';
        $config['num_tag_open']    = '<li class="page-item">';
        $config['num_tag_close']   = '</li>';
        $config['cur_tag_open']    = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close']   = '</a></li>';
        $config['attributes']      = ['class' => 'page-link'];

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        // 3. Ambil Data Artikel & Menu
        $articles = $this->db->where('id_domain', $domain->id)
            ->where('category', '3')
            ->order_by('created_at', 'DESC')
            ->limit($config['per_page'], $page)
            ->get('table_pages')
            ->result();

        $menus = $this->Menu_model->getMenuTree($domain->id);

        // 4. Mapping data untuk view
        $data = [
            'domain'         => $domain,
            'menus'          => $menus,
            'articles'       => $articles,
            'pagination'     => $this->pagination->create_links(),
            'iframe_content' => html_escape($domain->iframe ?? ''),

            // Meta Tags untuk halaman daftar Blog
            'title'          => 'Blog & Artikel | ' . ($domain->domain_name ?? ''),
            'description'    => 'Kumpulan artikel, tips, dan berita terbaru seputar fabrikasi dan instalasi dapur komersial.',
            'keywords'       => 'blog dapur komersial, tips instalasi exhaust, fabrikasi stainless, berita',
            'author'         => $domain->meta_author ?? 'Admin',
            'image'          => !empty($domain->image_domain) ? base_url($domain->image_domain) : base_url('assets/monoline/assets/images/og-default.jpg'),
            'url'            => current_url(),
            'type'           => 'website',

            // Kontak & Socials
            'contact'        => $this->_get_contact($domain),
            'socials'        => $this->_get_socials($domain)
        ];


        $data['sections'] = $this->db->order_by('urutan', 'ASC')->get_where('table_contents_pages', ['page_id' => $page_id, 'is_active' => 1])->result();

        // 2. KUSUS HALAMAN BLOG: Ambil daftar artikel dari table_pages
        if ($page_slug  === 'artikel-blog') {
            $this->db->where('category', 'blog');
            $this->db->order_by('created_at', 'DESC');
            $data['blog_posts'] = $this->db->get('table_pages')->result_array();
        }

        // 5. Load view index blog (Buat file view: application/views/weldork/blog_index.php)
        $this->template->load($domain->theme, 'blog_index', $data);
    }

    /**
     * Menampilkan Detail Artikel (Blog Detail)
     */
    public function read($slug = null)
    {
        if (empty($slug)) {
            redirect('blog');
        }

        // 1. Ambil domain
        $raw_host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $host     = parse_url('http://' . $raw_host, PHP_URL_HOST);
        $domain   = $this->Domain_model->getDomain($host);

        if (!$domain) {
            show_404('Domain tidak terdaftar atau nonaktif');
        }

        // 2. Ambil artikel berdasarkan slug
        $article = $this->db->where('id_domain', $domain->id)
            ->where('slug', strtolower(trim($slug)))
            ->where('category', '3')
            ->get('table_pages')
            ->row();

        if (!$article) {
            show_404('Artikel tidak ditemukan');
        }

        // 3. Ambil Menu & Artikel Populer/Terbaru (Untuk Sidebar)
        $menus = $this->Menu_model->getMenuTree($domain->id);
        $recent_posts = $this->db->where('id_domain', $domain->id)
            ->where('category', '3')
            ->where('id_page !=', $article->id_page)
            ->order_by('created_at', 'DESC')
            ->limit(5)
            ->get('table_pages')
            ->result();

        // 4. Mapping data untuk view
        $data = [
            'domain'         => $domain,
            'menus'          => $menus,
            'article'        => $article,
            'recent_posts'   => $recent_posts,
            'iframe_content' => html_escape($domain->iframe ?? ''),

            // Meta Tags Dinamis khusus Artikel ini
            'title'          => $article->title ?? 'Judul Artikel',
            'description'    => $article->meta_description ?? character_limiter(strip_tags($article->content ?? ''), 150),
            'keywords'       => $article->meta_keywords ?? '',
            'author'         => $article->meta_author ?? $domain->meta_author ?? 'Admin',
            'image'          => !empty($article->image_features) ? base_url('assets/uploads/img/' . $article->image_features) : (!empty($domain->image_domain) ? base_url($domain->image_domain) : base_url('assets/monoline/assets/images/og-default.jpg')),
            'url'            => current_url(),
            'type'           => 'article',

            // Kontak & Socials
            'contact'        => $this->_get_contact($domain),
            'socials'        => $this->_get_socials($domain)
        ];

        // 5. Load view detail blog (Buat file view: application/views/weldork/blog_detail.php)
        $this->template->load($domain->theme, 'blog_detail', $data);
    }

    public function detail($slug)
    {
        // Mengambil data artikel dari database berdasarkan slug URL
        $article = $this->Blog_model->get_by_slug($slug);

        // Jika data tidak ada, panggil fungsi 404 bawaan CI3
        if (!$article) {
            show_404();
        }

        $data['article'] = $article;
        $this->load->view('blog/detail', $data);
    }


    /**
     * Helper Private untuk mapping Data Kontak
     */
    private function _get_contact($domain)
    {
        return [
            'email'   => $domain->email ?? '',
            'phone'   => $domain->telepon ?? '',
            'address' => $domain->alamat ?? '',
            'wa'      => $domain->wa_link ?? ''
        ];
    }

    /**
     * Helper Private untuk mapping Data Sosial Media
     */
    private function _get_socials($domain)
    {
        return [
            'fb' => $domain->link_facebook ?? '',
            'tw' => $domain->link_twitter ?? '',
            'ig' => $domain->link_instagram ?? '',
            'yt' => $domain->link_youtube ?? ''
        ];
    }
}
