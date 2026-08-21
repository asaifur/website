<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends MY_Controller
{
	public function index()
	{
		// Detect domain
		$host = $_SERVER['HTTP_HOST'];
		// Ambil data domain
		$domain = $this->db
			->where('url_domain', $host)
			->get('table_domain')
			->row_array();
		// Jika domain tidak ada
		if (!$domain) {
			show_404();
		}
		// Meta otomatis dari domain	
		$data['domain'] = $domain;

		$data['menu_header_utama_website'] =  $this->menu_header;
		$domain_id = $this->domain_id;

		$page = $this->Menu_model->get_page_by_slug('home', $domain_id);
		$data['page'] = $page;

		$this->template->load('home', $data);
	}

	public function live_search()
	{
		$query = $this->input->post('query', TRUE);

		$this->db->like('title', $query);
		$this->db->where('id_domain', $this->domain->id);
		$this->db->limit(5);

		$result = $this->db->get('table_pages')->result();

		if (count($result) > 0) {
			echo '<ul class="live-search-list">';
			foreach ($result as $row) {
				echo '<li>
                    <a href="' . base_url('/' . $row->slug) . '">
                        ' . $row->title . '
                    </a>
                  </li>';
			}
			echo '</ul>';
		} else {
			echo '<div class="no-result">Artikel tidak ditemukan</div>';
		}
	}


	public function live_search_artikel()
	{
		$keyword = $this->input->post('keyword');

		$this->db->like('title', $keyword);
		$this->db->where('category', 2);
		$this->db->where('id_domain', $this->domain->id);
		$this->db->limit(6);

		$query = $this->db->get('table_pages')->result();

		foreach ($query as $art) {
			echo '
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="home_single_blog">
                <img src="' . base_url('assets/uploads/img/') . $art->image_features . '" class="img-fluid">
                <div class="home_blog_content">
                    <h2><a href="' . base_url($art->slug) . '">' . $art->title . '</a></h2>
                    <span>' . date('d F Y', strtotime($art->created_at)) . '</span>
                </div>
            </div>
        </div>';
		}
	}
}
