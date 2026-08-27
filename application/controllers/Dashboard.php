<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Dashboard extends MY_Controller
{

    public function __construct()

    {

        parent::__construct();

        // Proteksi Halaman: Cek apakah session 'logged_in' ada

        if (!$this->session->userdata('email')) {

            redirect('admin');
        }

        $this->load->model('User_model');
    }
    public function index()

    {

        // Cek session agar tidak bisa diakses tanpa login
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
        $data['menu_header'] =  $this->Menu_model->fetch_data('user_menu')->result();
        $data['title'] = $domain['title'];
        $this->templates->load('adminlte/dashboard', $data);
    }

    public function meta()
    {
        $host = $_SERVER['HTTP_HOST'];
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
        $data['menu_header'] =   $this->Menu_model->fetch_data('user_menu')->result();
        $this->templates->load('adminlte/metadata', $data);
    }

    public function navigasi()
    {
        $host = $_SERVER['HTTP_HOST'];

        $domain = $this->db
            ->where('url_domain', $host)
            ->get('table_domain')
            ->row_array();

        if (!$domain) {
            show_404();
        }

        // pastikan menu_header adalah array
        $header =  $this->Menu_model->fetch_data('user_menu')->result();

        $this->db->select('
    m.*,
    p.nama_menu as parent_nama,
    p.slug as parent_slug
');
        $this->db->from('table_menu_navigasi m');
        $this->db->join('table_menu_navigasi p', 'p.id = m.parent_id', 'left');
        $this->db->order_by('m.urutan', 'ASC');

        $menu_detail = $this->db->get();

        $data['menu_detail'] = $menu_detail;

        $data['domain']      = $domain;
        $data['menu']        = $header;
        $data['title']       = "Navigasi"; // ← ini juga tadi salah
        $data['pages'] = $this->Menu_model->getPages($this->domain->id)->result();
        $this->templates->load('adminlte/navigasi', $data);
    }
    public function form_tambah_menu($action, $id = null)
    {
        $host = $_SERVER['HTTP_HOST'];
        $getHost = $this->Menu_model->fetch_data('table_domain', ['url_domain' => $host])->row_array();
        $id_domain = $getHost['id'];
        $data['id_domain'] = $id_domain;

        $data['domain'] = $getHost;

        $data['format'] = $this->Menu_model->format_action('format_tambah_navigasi', $action)->result();
        $where_parent = ['parent_id' => 0, 'url_id' => $id_domain];
        $data['action'] = $action;
        $where_menu = ['id_domain' => $id_domain];
        $data['pages'] = $this->Menu_model->fetch_data('table_pages', $where_menu)->result();
        $data['parent'] = $this->Menu_model->fetch_data('table_menu_navigasi', $where_parent)->result();
        if ($id) {
            $data['dtKolom'] = $this->Menu_model->fetch_data("table_menu_navigasi", ['id' => $id])->row();
        }
        $this->load->view('adminlte/form_tambah_menu', $data);
    }

    public function simpan_menu($action)
    {
        $format = $this->Menu_model
            ->format_action('format_tambah_navigasi', $action)
            ->result();

        $host = $_SERVER['HTTP_HOST'];
        $getHost = $this->Menu_model->fetch_data('table_domain', ['url_domain' => $host])->row_array();
        $id_domain = $getHost['id'];

        $data = [];

        foreach ($format as $kolom) {

            if ($kolom->code == "url_id") {

                $data[$kolom->code] = $id_domain;
            } else {

                $data[$kolom->code] = $this->input->post($kolom->code, true);
            }
        }
        $where = ['id' => $this->input->post('id')];

        if ($action == "insert") {

            $query = $this->Menu_model->insertData('table_menu_navigasi', $data);
        } elseif ($action == "update") {

            $query = $this->Menu_model->updateData('table_menu_navigasi', $data, $where);
        } else {

            $query = $this->Menu_model->deleteData('table_menu_navigasi', $where);
        }

        if ($query) {

            echo json_encode([
                'status'  => 'success',
                'message' => 'Menu berhasil ' . $action,
                'data'    => $data
            ]);
        } else {

            echo json_encode([
                'status'  => 'error',
                'message' => 'Gagal ' . $action . ' data'
            ]);
        }
    }

    public function blog()
    {
        $host = $_SERVER['HTTP_HOST'];

        $domain = $this->db
            ->where('url_domain', $host)
            ->get('table_domain')
            ->row_array();

        if (!$domain) {
            show_404();
        }

        // pastikan menu_header adalah array
        $header = $this->menu_header;

        $this->db->select('
    m.*,
    p.nama_menu as parent_nama,
    p.slug as parent_slug
');
        $this->db->from('table_menu_navigasi m');
        $this->db->join('table_menu_navigasi p', 'p.id = m.parent_id', 'left');
        $this->db->order_by('m.urutan', 'ASC');

        $menu_detail = $this->db->get();

        $data['menu_detail'] = $menu_detail;

        $data['menu_detail'] = $menu_detail;

        $data['domain']      = $domain;
        $data['menu']        = $header;
        $data['title']       = "Navigasi"; // ← ini juga tadi salah

        $this->templates->load('adminlte/navigasi', $data);
    }
    public function media()
    {
        $host = $_SERVER['HTTP_HOST'];

        $domain = $this->db
            ->where('url_domain', $host)
            ->get('table_domain')
            ->row_array();

        if (!$domain) {
            show_404();
        }


        $this->db->select('
    m.*,
    p.nama_menu as parent_nama,
    p.slug as parent_slug
');
        $this->db->from('table_menu_navigasi m');
        $this->db->join('table_menu_navigasi p', 'p.id = m.parent_id', 'left');
        $this->db->order_by('m.urutan', 'ASC');

        $menu_detail = $this->db->get();

        $data['menu_detail'] = $menu_detail;

        $data['domain']      = $domain;
        $data['title']       = "Foto"; // ← ini juga tadi salah

        $this->templates->load('adminlte/media', $data);
    }

    public function pages()
    {
        $host = $_SERVER['HTTP_HOST'];

        $domain = $this->db
            ->where('url_domain', $host)
            ->get('table_domain')
            ->row_array();

        if (!$domain) {
            show_404();
        }
        $data['domain']      = $domain;
        $data['title'] = "Menu_pages";

        $data['pages'] = $this->Menu_model->fetch_data('table_pages', ['id_domain' => $this->domain->id])->result();
        $this->templates->load('adminlte/pages', $data);
    }

    public function view_menu()
    {
        echo $this->Page_model->view_menu();
    }

    public function view_pages()
    {
        echo $this->Page_model->view_pages();
    }

    public function addTambahPages($action, $id = null)
    {
        $data['action'] = $action;
        $data['format'] = $this->Menu_model->format_action('format_tambah_pages', $action)->result();
        if ($id) {
            $data['dtKolom'] = $this->Menu_model->fetch_data('table_pages', ['id_page' => $id])->row();
        }
        $data['aktif'] = $this->Menu_model->fetch_data('tbl_aktif')->result();
        $data['select_category'] = $this->Menu_model->fetch_data('tbl_category')->result();
        $this->load->view('adminlte/addTambahPages', $data);
    }

    public function save_menu()
    {
        $menu = json_decode($this->input->post('menu'), true);

        $this->updateMenu($menu);

        echo json_encode(['status' => 'success']);
    }

    public function save_pages($action)
    {
        $format = $this->Menu_model->format_action('format_tambah_pages', $action)->result();
        $post = $this->input->post();

        $data = [];

        if ($action != "delete") {

            // ambil title untuk slug
            $title = $post['title'];
            $slug  = url_title($title, '-', TRUE);

            // generate slug unik
            $slug = $this->generate_unique_slug(
                $slug,
                'table_pages',
                'slug',
                $this->input->post('id_page')
            );
        }

        foreach ($format as $kolom) {

            if ($kolom->code == "id_domain") {

                $data[$kolom->code] = $this->domain->id;
            } elseif ($kolom->type == "FILE") {

                $config['upload_path']   = './assets/uploads/img/';
                $config['allowed_types'] = 'jpg|jpeg|png|jfif';
                $config['encrypt_name']  = true;

                $this->load->library('upload');
                $this->upload->initialize($config);

                $old_file = $this->input->post('old_' . $kolom->code);
                if (!empty($_FILES[$kolom->code]['name'])) {

                    if ($this->upload->do_upload($kolom->code)) {

                        $upload = $this->upload->data();
                        $data[$kolom->code] = $upload['file_name'];
                        if (!empty($old_file) && file_exists('./assets/uploads/img/' . $old_file)) {
                            unlink('./assets/uploads/img/' . $old_file);
                        }
                    } else {
                        echo json_encode([
                            "status" => "error",
                            "message" => $this->upload->display_errors()
                        ]);
                        return;
                    }
                } else {
                    // Jika tidak upload file baru → gunakan file lama
                    $data[$kolom->code] = $old_file;
                }
            } elseif ($kolom->code == "slug") {

                $data[$kolom->code] = $slug;
            } else if ($kolom->code == "created_at") {
                $data[$kolom->code] = date("Y-m-d H:i:s");
            } else {

                $data[$kolom->code] = $this->input->post($kolom->code);
            }
        }

        if ($action == "insert") {

            $query = $this->Menu_model->insertData('table_pages', $data);
        } elseif ($action == "update") {

            $id = $this->input->post('id_page');
            $where = ['id_page' => $id];

            $query = $this->Menu_model->updateData('table_pages', $data, $where);
        } elseif ($action == "delete") {

            $id = $this->input->post('id_page');
            $where = ['id_page' => $id];

            $query = $this->Menu_model->deleteData('table_pages', $where);
        }

        if ($query) {

            echo json_encode([
                "status" => "success",
                "message" => "Data berhasil di " . $action
            ]);
        } else {

            echo json_encode([
                "status" => "error",
                "message" => "Data tidak berhasil di " . $action
            ]);
        }
    }

    public function team_start_template_medinova()
    {
        $host = $_SERVER['HTTP_HOST'];

        $domain = $this->db
            ->where('url_domain', $host)
            ->get('table_domain')
            ->row_array();

        if (!$domain) {
            show_404();
        }
        $data['domain']      = $domain;
        $data['title'] = " Team Start Medinova";
        $this->templates->load('adminlte/team_start_template_medinova', $data);
    }
    public function view_contents_team_start()
    {
        echo $this->Page_model->view_contents_team_start();
    }
    public function carousel()
    {
        $host = $_SERVER['HTTP_HOST'];

        $domain = $this->db
            ->where('url_domain', $host)
            ->get('table_domain')
            ->row_array();

        if (!$domain) {
            show_404();
        }
        $data['domain']      = $domain;
        $data['id_domain']  = $domain['id'];
        $data['title'] = " Carousel Page";
        $this->templates->load('adminlte/carousel', $data);
    }

    public function view_carousel()
    {
        echo $this->Page_model->view_carousel();
    }
    public function contentPage()
    {
        $host = $_SERVER['HTTP_HOST'];

        $domain = $this->db
            ->where('url_domain', $host)
            ->get('table_domain')
            ->row_array();

        if (!$domain) {
            show_404();
        }
        $data['domain']      = $domain;
        $data['title'] = " Content Page";
        $data['list_page'] = $this->db->select('slug,id_page')
            ->where('id_domain', $domain['id'])
            ->get('table_pages')
            ->result();
        $this->templates->load('adminlte/ContentPage', $data);
    }
    public function view_contents()
    {
        $host = $_SERVER['HTTP_HOST'];
        $domain = $this->db->where('url_domain', $host)->get('table_domain')->row_array();
        $page_id = $this->input->post('page_id');

        $this->db->where('id_domain', $domain['id']);
        if (!empty($page_id)) {
            $this->db->where('page_id', $page_id);
        }
        $totalData = $this->db->count_all_results('table_contents_pages', FALSE);
        $limit  = $this->input->post('length');
        $start  = $this->input->post('start');
        $order_col = $this->input->post('order')[0]['column'] ?? 8;
        $order_dir = $this->input->post('order')[0]['dir'] ?? 'ASC';

        $columns = [
            0 => 'id',
            1 => 'page_id',
            2 => 'title',
            3 => 'title',
            4 => 'subtitle',
            5 => 'content',
            6 => 'media',
            7 => 'section',
            8 => 'urutan',
            9 => 'is_active'
        ];

        $this->db->order_by($columns[$order_col] ?? 'urutan', $order_dir);
        if ($limit != -1) {
            $this->db->limit($limit, $start);
        }

        $list = $this->db->get()->result();
        $data = [];

        foreach ($list as $row) {
            $aksi = '
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-warning btn-update" data-id="' . $row->id . '" title="Edit">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-delete" data-id="' . $row->id . '" title="Hapus">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            ';

            $imgPreview = !empty($row->image)
                ? '<img src="' . $row->image . '" class="img-thumbnail" width="50">'
                : '<span class="text-muted">-</span>';

            $data[] = [
                'id'           => $row->id,
                'page_id'      => '<code>' . $row->page_id . '</code>',
                'title'        => $row->title ?? '-',
                'span'         => '<span class="badge badge-info">' . $row->section_id_dom . '</span>',
                'subtitle'     => character_limiter($row->subtitle, 25),
                'content'      => character_limiter(strip_tags($row->content), 35),
                'image'        => $imgPreview,
                'section'      => '<span class="badge badge-primary font-weight-bold">' . $row->section . '</span>',
                'urutan'       => $row->urutan,
                'is_active'    => $row->is_active,
                'aksi'         => $aksi
            ];
        }
        echo json_encode([
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalData),
            "data"            => $data
        ]);
    }

    // 3. Modal Form Dispatcher (Insert, Update, Delete View)
    public function addTambahContent($action, $id = null)
    {
        $host = $_SERVER['HTTP_HOST'];
        $domain = $this->db->where('url_domain', $host)->get('table_domain')->row_array();
        $data['domain'] = $domain;

        if ($action == 'insert') {
            $data['row'] = null;
            $data['sections'] = $this->db->select('section')->get('table_sections')->result();

            $data['pages'] = $this->db->where('id_domain', $domain['id'])->get('table_pages')->result();
            $this->load->view('adminlte/modals/modal_content_form', $data);
        } elseif ($action == 'update') {
            $data['row'] = $this->db->where('id', $id)->where('id_domain', $domain['id'])->get('table_contents_pages')->row();
            $data['sections'] = $this->db->select('section')->get('table_sections')->result();
            $data['pages'] = $this->db->where('id_domain', $domain['id'])->get('table_pages')->result();
            $this->load->view('adminlte/modals/modal_content_form', $data);
        } elseif ($action == 'delete') {
            $data['row'] = $this->db->where('id', $id)->where('id_domain', $domain['id'])->get('table_contents_pages')->row();
            $this->load->view('adminlte/modals/modal_content_delete', $data);
        }
    }

    // 4. Proses Simpan / Update (AJAX Form Submit)
    public function save_content()
    {
        $id        = $this->input->post('id');
        $id_domain = $this->input->post('id_domain');

        $page = $this->Menu_model->fetch_data('table_pages', ['slug' => $this->input->post('page_slug'), 'id_domain' => $id_domain])->row();
        $data_save = [
            'id_domain'      => $id_domain,
            'page_slug'      => $this->input->post('page_slug'),
            'page_id'        => $page->id_page,
            'section'   => $this->input->post('section'),
            'section_id_dom' => $this->input->post('page_slug'),
            'title'          => $this->input->post('title'),
            'subtitle'       => $this->input->post('subtitle'),
            'content'        => $this->input->post('content'),
            'urutan'        => $this->input->post('urutan'),
            'btn_text'       => $this->input->post('btn_text'),
            'btn_url'        => $this->input->post('btn_url'),
            'data_payload'   => $this->input->post('data_payload'),
            'urutan' => $this->input->post('urutan') ?? 1,
            'is_active'      => $this->input->post('is_active') ?? 1
        ];

        // Handle Image Upload
        if (!empty($_FILES['image']['name'])) {
            $config['upload_path']   = './assets/uploads/img/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp|svg';
            $config['file_name']     = 'sec_' . time() . '_' . uniqid();
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();
                $data_save['image'] = $uploadData['file_name'];
            }
        }

        if (empty($id)) {
            $this->db->insert('table_contents_pages', $data_save);
            $msg = 'Content Section berhasil ditambahkan';
        } else {
            $this->db->where('id', $id)->where('id_domain', $id_domain)->update('table_contents_pages', $data_save);
            $msg = 'Content Section berhasil diperbarui';
        }

        echo json_encode(['status' => 'success', 'message' => $msg]);
    }

    // 5. Proses Delete Action
    public function execute_delete($id)
    {
        $host = $_SERVER['HTTP_HOST'];
        $domain = $this->db->where('url_domain', $host)->get('table_domain')->row_array();

        if ($domain && !empty($id)) {
            $this->db->where('id', $id)->where('id_domain', $domain['id'])->delete('table_contents_pages');
            echo json_encode(['status' => 'success', 'message' => 'Data section berhasil dihapus']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data']);
        }
    }

    public function get_image()
    {
        $keyword = $this->input->get('keyword');

        $this->db->like('alt_text', $keyword);
        $data = $this->db->get('table_media')->result();

        $result = [];

        foreach ($data as $row) {
            $result[] = [
                'label' => $row->alt_text,   // yang tampil
                'value' => $row->file_name,  // yang disimpan
            ];
        }

        echo json_encode($result);
    }

    public function addTambahCarousel($action, $id = null)
    {

        $data['action'] = $action;

        $data['format'] = $this->Menu_model->format_action('format_carousel', $action)->result();
        if ($id) {
            $data['dtKolom'] = $this->Menu_model->fetch_data('tbl_carousel', ['id' => $id])->row();
        }
        $where = ['id_domain' => $this->domain->id];
        $where_carousel = ['domain_id' => $this->domain->id];
        $data['get_page'] = $this->Menu_model->fetch_data('table_contents_pages', $where)->result();
        $data['get_image'] = $this->Menu_model->fetch_data('table_media', $where_carousel)->result();
        $data['aktif'] = $this->Menu_model->fetch_data('tbl_aktif')->result();
        $data['lebar'] = $this->Menu_model->fetch_data('table_lebar')->result();
        $data['sections'] = $this->Menu_model->fetch_data('table_contents_pages', ['id_domain' => $this->domain->id])->result();
        $data['get_menu'] = $this->Menu_model->fetch_data('table_pages', ['id_domain' => $this->domain->id])->result();
        $this->load->view('adminlte/addContentCarousel', $data);
    }
    public function addTambahContent3($action, $id = null)
    {
        $data['action'] = $action;
        $data['format'] = $this->Menu_model->format_action('format_content_pages', $action)->result();
        if ($id) {
            $data['dtKolom'] = $this->Menu_model->fetch_data('table_contents_pages', ['id' => $id])->row();
        }
        $where = ['id_domain' => $this->domain->id];
        $data['get_page'] = $this->Menu_model->fetch_data('table_pages', $where)->result();
        $data['aktif'] = $this->Menu_model->fetch_data('tbl_aktif')->result();
        $data['lebar'] = $this->Menu_model->fetch_data('table_lebar')->result();
        $data['sections'] = $this->Menu_model->fetch_data('table_sections')->result();
        $data['get_menu'] = $this->Menu_model->fetch_data('table_pages', ['id_domain' => $this->domain->id])->result();
        $this->load->view('adminlte/addContentPages', $data);
    }
    public function addTambahContentTeamStart($action, $id = null)
    {
        $data['action'] = $action;
        $data['format'] = $this->Menu_model->format_action('format_team_start_medinova', $action)->result();
        if ($id) {
            $data['dtKolom'] = $this->Menu_model->fetch_data('table_team_start_medinova', ['id' => $id])->row();
        }
        $where = ['id_domain' => $this->domain->id];
        $data['get_page'] = $this->Menu_model->fetch_data('table_pages', $where)->result();
        $data['aktif'] = $this->Menu_model->fetch_data('tbl_aktif')->result();
        $data['lebar'] = $this->Menu_model->fetch_data('table_lebar')->result();
        $data['sections'] = $this->Menu_model->fetch_data('table_sections')->result();
        $data['get_menu'] = $this->Menu_model->fetch_data('table_pages', ['id_domain' => $this->domain->id])->result();
        $this->load->view('adminlte/addContentTeamStartMedinova', $data);
    }

    public function save_contents($action)
    {
        $format = $this->Menu_model->format_action('format_content_pages', $action)->result();
        $data = [];

        foreach ($format as $kolom) {

            if ($kolom->type == "FILE") {

                $config['upload_path']   = './assets/uploads/img/';
                $config['allowed_types'] = 'jpg|jpeg|png|jfif|jfif';
                $config['encrypt_name']  = true;

                $this->load->library('upload');
                $this->upload->initialize($config);

                $old_file = $this->input->post('old_' . $kolom->code);
                if (!empty($_FILES[$kolom->code]['name'])) {

                    if ($this->upload->do_upload($kolom->code)) {

                        $upload = $this->upload->data();
                        $data[$kolom->code] = $upload['file_name'];
                        if (!empty($old_file) && file_exists('./assets/uploads/img/' . $old_file)) {
                            unlink('./assets/uploads/img/' . $old_file);
                        }
                    } else {
                        echo json_encode([
                            "status" => "error",
                            "message" => $this->upload->display_errors()
                        ]);
                        return;
                    }
                } else {
                    // Jika tidak upload file baru → gunakan file lama
                    $data[$kolom->code] = $old_file;
                }
            } else {

                $data[$kolom->code] = $this->input->post($kolom->code);
            }
        }

        if ($action == "insert") {

            $data['created_at'] = date('Y-m-d');
            $data['id_domain']  = $this->domain->id;
            $query = $this->Menu_model->insertData('table_contents_pages', $data);
        } else if ($action == "update") {

            $id = $this->input->post('id');
            $where = ['id' => $id];
            $query = $this->Menu_model->updateData('table_contents_pages', $data, $where);
        } else {

            // Jika delete → hapus juga file fisiknya
            $id = $this->input->post('id');
            $row = $this->Menu_model->fetch_data('table_contents_pages', ['id' => $id])->row();

            foreach ($format as $kolom) {
                if ($kolom->type == "FILE" && !empty($row->{$kolom->code})) {
                    $path = './assets/uploads/img/' . $row->{$kolom->code};
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
            }

            $query = $this->Menu_model->deleteData('table_contents_pages', ['id' => $id]);
        }

        if ($query) {
            echo json_encode([
                "status" => "success",
                "message" => "Data berhasil di " . $action,
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Data tidak berhasil di " . $action
            ]);
        }
    }
    public function add_page_menu()
    {
        $pages = $this->input->post('pages');

        if (!empty($pages)) {

            foreach ($pages as $id) {

                $page = $this->db
                    ->where('id_page', $id)
                    ->get('table_pages')
                    ->row();

                if ($page) {

                    $data = [
                        'nama_menu'     => $page->title,
                        'slug'      => $page->slug,
                        'page_id'   => $page->id_page,
                        'parent_id' => 0,
                        'created_at' => date('Y-m-d H:i:s'),
                        'url_id' => $this->domain->id,
                        'is_active' => $page->status,
                        'type' => 'page',
                    ];

                    $this->db->insert('table_menu_navigasi', $data);
                }
            }
        }

        echo json_encode([
            'status' => 'success'
        ]);
    }
    public function add_category_menu()
    {
        $category_id = $this->input->post('category_id');

        $cat = $this->db
            ->where('id', $category_id)
            ->get('categories')
            ->row();

        $data = [
            'id_domain' => $this->domain->id,
            'title' => $cat->name,
            'slug' => 'category/' . $cat->slug,
            'type' => 'category',
            'category_id' => $cat->id
        ];

        $this->db->insert('table_menus', $data);

        echo json_encode(['status' => 'success']);
    }
    public function add_custom_menu()
    {
        $data = [
            'url_id' => $this->domain->id,
            'nama_menu' => $this->input->post('title'),
            'slug' => $this->input->post('url'),
            'type' => 'custom'
        ];

        $this->db->insert('table_menu_navigasi', $data);

        echo json_encode(['status' => 'success']);
    }
    private function updateMenu($menus, $parent = 0)
    {
        $i = 0;

        foreach ($menus as $menu) {

            $data = [
                'parent_id' => $parent
            ];

            $this->db->where('id_page', $menu['id'])
                ->update('table_pages', $data);

            if (isset($menu['children'])) {

                $this->updateMenu($menu['children'], $menu['id']);
            }

            $i++;
        }
    }

    public function profile()
    {
        $host = $_SERVER['HTTP_HOST'];

        $domain = $this->db
            ->where('url_domain', $host)
            ->get('table_domain')
            ->row_array();

        if (!$domain) {
            show_404();
        }
        $data['domain']      = $domain;
        $data['title'] = " Profile";
        $data['action'] = "update";
        $data['theme'] = $this->Menu_model->fetch_data('table_theme', ['is_active' => 1])->result();
        $data['format'] = $this->Menu_model->format_action('format_domain', 'update')->result();
        $this->templates->load('template/profile', $data);
    }
    public function product()
    {
        $host = $_SERVER['HTTP_HOST'];

        $domain = $this->db
            ->where('url_domain', $host)
            ->get('table_domain')
            ->row_array();

        if (!$domain) {
            show_404();
        }
        $data['domain']      = $domain;
        $data['title'] = " Product";
        $this->templates->load('adminlte/product', $data);
    }

    public function update_profile()
    {
        $format = $this->Menu_model->format_action('format_domain', 'update')->result();
        $data = [];

        foreach ($format as $kolom) {

            if ($kolom->type == 'FILE') {

                if (!empty($_FILES[$kolom->code]['name'])) {

                    $config['upload_path'] = './assets/uploads/img/';
                    $config['allowed_types'] = 'jpg|jpeg|png|jfif|webp';
                    $config['encrypt_name'] = TRUE;

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload($kolom->code)) {

                        $upload = $this->upload->data();
                        $data[$kolom->code] = $upload['file_name'];
                    }
                } else {

                    $data[$kolom->code] = $this->input->post('old_' . $kolom->code);
                }
            } else {

                $data[$kolom->code] = $this->input->post($kolom->code);
            }
        }

        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $query = $this->db->update('table_domain', $data);

        if ($query) {

            echo json_encode([
                'status' => 'success',
                'message' => 'Profile berhasil diperbarui'
            ]);
        } else {

            echo json_encode([
                'status' => 'error',
                'message' => 'Gagal menyimpan data'
            ]);
        }
    }

    public function view_data_media()
    {
        echo $this->Page_model->view_data_media();
    }

    public function addTambahMedia($action, $id = null)
    {
        $data['action'] = $action;
        $data['format'] = $this->Menu_model->format_action('format_tambah_media', $action)->result();
        if ($id) {
            $data['dtKolom'] = $this->Menu_model->fetch_data('table_media', ['id' => $id])->row();
        }
        $data['aktif'] = $this->Menu_model->fetch_data('tbl_aktif')->result();
        $this->load->view('adminlte/addTambahMedia', $data);
    }
    public function save_Media($action)
    {
        $format = $this->Menu_model->format_action('format_tambah_media', $action)->result();
        $data = [];

        foreach ($format as $kolom) {

            // FILE UPLOAD
            if ($kolom->type == "FILE") {

                $config['upload_path']   = './assets/uploads/img/';
                $config['allowed_types'] = 'jpg|jpeg|png|jfif|webp';
                $config['encrypt_name']  = true;

                $this->load->library('upload');
                $this->upload->initialize($config);

                if (!empty($_FILES[$kolom->code]['name'])) {

                    if ($this->upload->do_upload($kolom->code)) {

                        $upload = $this->upload->data();
                        $data[$kolom->code] = $upload['file_name'];
                    } else {

                        echo json_encode([
                            "status" => "error",
                            "message" => $this->upload->display_errors()
                        ]);
                        return;
                    }
                } else {

                    $data[$kolom->code] = $this->input->post('old_' . $kolom->code);
                }
            } elseif ($kolom->type == "FILEMP4") {
                $field = $kolom->code;
                if (!empty($_FILES[$field]['name'])) {

                    $config = array(
                        'upload_path'      => './assets/uploads/img/',
                        'allowed_types'    => '*',
                        'max_size'         => 50000, // 50MB
                        'encrypt_name'     => TRUE,
                        'remove_spaces'    => TRUE,
                        'file_ext_tolower' => TRUE,
                        'detect_mime'      => FALSE // penting untuk shared hosting
                    );
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload($field)) {

                        $uploadData = $this->upload->data();
                        $data[$field] = $uploadData['file_name'];

                        // Hapus video lama
                        if (!empty($post['old_' . $field])) {
                            @unlink('./assets/uploads/img/' . $post['old_' . $field]);
                        }
                    }
                } else {
                    $data[$field] = $post['old_' . $field] ?? null;
                }
            }


            // DOMAIN AUTO
            else if ($kolom->code == "domain_id") {

                $data[$kolom->code] = $this->domain->id;
            }

            // INPUT NORMAL
            else {

                $data[$kolom->code] = $this->input->post($kolom->code);
            }
        }


        // ACTION
        if ($action == "insert") {

            $query = $this->Menu_model->insertData('table_media', $data);
        } else if ($action == "update") {

            $id = $this->input->post('id');
            $where = ['id' => $id];

            $query = $this->Menu_model->updateData('table_media', $data, $where);
        } else if ($action == "delete") {
            $id = $this->input->post('id');
            $where = ['id' => $id];
            $query = $this->Menu_model->deleteData('table_media', $where);
        }


        if ($query) {

            echo json_encode([
                "status" => "success",
                "message" => "Data berhasil di " . $action
            ]);
        } else {

            echo json_encode([
                "status" => "error",
                "message" => "Data gagal di " . $action
            ]);
        }
    }
    private function generate_unique_slug($slug, $table, $field = 'slug', $id = null)
    {
        $slug = url_title($slug, '-', true);
        $original_slug = $slug;
        $i = 1;

        // ambil id_domain aktif
        $id_domain = $this->domain->id;

        while (true) {

            $this->db->where($field, $slug);
            $this->db->where('id_domain', $id_domain);

            if ($id) {
                $this->db->where('id_page !=', $id);
            }

            $query = $this->db->get($table);

            if ($query->num_rows() == 0) {
                return $slug;
            }

            // format -01, -02, -03
            $slug = $original_slug . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
            $i++;
        }
    }

    public function save_carousel($action)
    {
        $format = $this->Menu_model->format_action('format_carousel', $action)->result();
        $data = [];

        foreach ($format as $kolom) {

            $data[$kolom->code] = $this->input->post($kolom->code);
        }
        if ($action == "insert") {

            $data['created_at'] = date('Y-m-d');
            $data['url_id']  = $this->domain->id;
            $query = $this->Menu_model->insertData('tbl_carousel', $data);
        } else if ($action == "update") {
            $data['url_id']  = $this->domain->id;

            $id = $this->input->post('id');
            $where = ['id' => $id];
            $query = $this->Menu_model->updateData('tbl_carousel', $data, $where);
        } else {
            $data['url_id']  = $this->domain->id;

            $id = $this->input->post('id');

            $query = $this->Menu_model->deleteData('tbl_carousel', ['id' => $id]);
        }

        if ($query) {
            echo json_encode([
                "status" => "success",
                "message" => "Data berhasil di " . $action,
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Data tidak berhasil di " . $action
            ]);
        }
    }

    public function post()
    {
        $host = $_SERVER['HTTP_HOST'];

        $domain = $this->db
            ->where('url_domain', $host)
            ->get('table_domain')
            ->row_array();

        if (!$domain) {
            show_404();
        }
        $data['domain']      = $domain;
        $data['id_domain']  = $domain['id'];
        $data['title'] = "Artikel & POSTs";
        $this->templates->load('adminlte/post', $data);
    }

    public function view_products()
    {
        echo $this->Page_model->view_products();
    }

    public function view_post()
    {
        echo $this->Page_model->view_post();
    }

    public function addTambahPost($action, $id = null)
    {
        $data['action'] = $action;
        $this->load->view('adminlte/addTambahPost', $data);
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

    public function website()
    {
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';

        $domain = $this->db
            ->where('url_domain', $host)
            ->get('table_domain')
            ->row_array();

        if (!$domain) {
            show_404();
        }

        $data['domain']    = $domain;
        $data['id_domain'] = $domain['id'];
        $data['title']     = "Data Website";

        // Filter berdasarkan id_domain milik domain yang aktif
        $data['websites']  = $this->db
            ->where('id_domain', $domain['id'])
            ->order_by('id', 'DESC')
            ->get('table_website')
            ->result_array();

        $this->templates->load('adminlte/website', $data);
    }

    // Simpan Data Baru
    public function website_store()
    {
        $id_domain = $this->input->post('id_domain', true);
        $slugname  = url_title($this->input->post('slugname', true), 'dash', true);
        $content   = $this->input->post('content');

        $this->db->insert('table_website', [
            'id_domain' => $id_domain,
            'slugname'  => $slugname,
            'content'   => $content
        ]);

        $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
        redirect($_SERVER['HTTP_REFERER'] ?? 'website');
    }

    // Update Dataid_domain
    public function website_update()
    {
        $id       = $this->input->post('id', true);
        $slugname = url_title($this->input->post('slugname', true), 'dash', true);
        $content  = $this->input->post('content');

        $this->db->where('id', $id)->update('table_website', [
            'slugname' => $slugname,
            'content'  => $content
        ]);

        $this->session->set_flashdata('success', 'Data berhasil diperbarui');
        redirect($_SERVER['HTTP_REFERER'] ?? 'website');
    }

    // Hapus Data
    public function website_delete($id)
    {
        $this->db->where('id', $id)->delete('table_website');
        $this->session->set_flashdata('success', 'Data berhasil dihapus');
        redirect($_SERVER['HTTP_REFERER'] ?? 'website');
    }
}
