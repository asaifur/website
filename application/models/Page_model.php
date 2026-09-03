<?php

use PhpParser\Node\Expr\FuncCall;

defined('BASEPATH') or exit('No direct script access allowed');

class Page_model extends CI_Model
{

    function getPage($slug, $id_domain)
    {

        return $this->db
            ->where('id_domain', $id_domain)
            ->where('slug', $slug)
            ->get('table_pages')
            ->row();
    }

    function getHome($id_domain)
    {

        return $this->db
            ->where('id_domain', $id_domain)
            ->where('slug', 'home')
            ->get('table_pages')
            ->row();
    }
    function pageslug($slug)
    {
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    }
    function getDomain($host)
    {
        return $this->db
            ->where('domain', $host)
            ->get('table_domain')
            ->row();
    }
    public function getMenuHeader($domain_id)
    {
        return $this->db
            ->where('url_id', $domain_id)
            ->where('parent_id', 0)
            ->where('posisi', 'header')
            ->where('is_active', 1)
            ->order_by('urutan', 'ASC')
            ->get('table_menu_navigasi');
    }

    public function getContents($page_id)
    {
        return $this->db
            ->where('page_id', $page_id)
            ->where('is_active', 1)
            ->order_by('urutan', 'ASC')
            ->get('table_contents_pages')
            ->result();
    }
    function getSections($page_id)
    {
        return $this->db
            ->select('table_contents_pages.*')
            ->from('table_contents_pages')
            // ->join('table_sections', 'table_sections.section = table_contents_pages.section', 'left')
            ->where('table_contents_pages.page_id', $page_id)
            ->where('table_contents_pages.is_active', 1)
            ->order_by('table_contents_pages.urutan', 'ASC')
            ->get()
            ->result();
    }

    public function view_pages()
    {
        $id = $this->input->post('id_domain');
        $this->datatables->select('id_page,id_domain,slug,title,meta_title,meta_description,status,created_at,keywords,description');
        $this->datatables->from('table_pages');
        $this->db->where('id_domain', $id);
        // Perbaikan: Ganti #1 menjadi $1 agar ID terisi otomatis
        $this->datatables->add_column('aksi', '
        <button type="button" class="btn btn-sm btn-info btn-view" data-id="$1">
            <i class="fas fa-eye"></i> Detail
        </button>
        <button type="button" class="btn btn-sm btn-success btn-update" data-id="$1">
            <i class="fa fa-pencil-alt"></i> Update
        </button>
        <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="$1">
            <i class="fa fa-trash"></i> Delete
        </button>
    ', 'id_page');
        $this->db->order_by('id_page DESC');
        return $this->datatables->generate();
    }

    public function view_contents_team_start()
    {
        $id = $this->input->post('page_id');
        $host = $_SERVER['HTTP_HOST'];
        $domain = $this->db
            ->where('url_domain', $host)
            ->get('table_domain')
            ->row();


        $this->datatables->select('id,title,subtitle,id_domain,content_page_id,name_team,image_team,subtitle_name_team,content,created_date,created_by');
        $this->datatables->from('table_team_start_medinova');
        if ($id != "") {

            $this->db->where('content_page_id', $id);
        }
        // Perbaikan: Ganti #1 menjadi $1 agar ID terisi otomatis
        $this->datatables->add_column('aksi', '
        <button type="button" class="btn btn-sm btn-info btn-view" data-id="$1">
            <i class="fas fa-eye"></i> Detail
        </button>
        <button type="button" class="btn btn-sm btn-success btn-update" data-id="$1">
            <i class="fa fa-pencil-alt"></i> Update
        </button>
        <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="$1">
            <i class="fa fa-trash"></i> Delete Content
        </button>
    ', 'id');
        $this->db->where('id_domain', $domain->id);
        $this->db->order_by('id DESC');
        return $this->datatables->generate();
    }

    public function view_post()
    {
        $this->datatables->select('id_post,id_domain,title,slug,content,is_active,featured_image,created_at');
        $this->datatables->from('table_post');
        $this->datatables->add_column('aksi', '
        <button type="button" class="btn btn-sm btn-info btn-view" data-id="$1">
            <i class="fas fa-eye"></i> Detail
        </button>
        <button type="button" class="btn btn-sm btn-success btn-update" data-id="$1">
            <i class="fa fa-pencil-alt"></i> Update
        </button>
        <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="$1">
            <i class="fa fa-trash"></i> Delete Content
        </button>
    ', 'id_post');
        $this->db->where('id_domain', $this->domain->id);
        $this->db->order_by('id_post DESC');
        return $this->datatables->generate();
    }
    public function view_contents()
    {
        $id = $this->input->post('page_id');
        $host = $_SERVER['HTTP_HOST'];
        $domain = $this->db
            ->where('url_domain', $host)
            ->get('table_domain')
            ->row();


        $this->datatables->select('id,page_id,title,span,subtitle,content,image,section,urutan,is_active,created_at');
        $this->datatables->from('table_contents_pages');
        if ($id != "") {

            $this->db->where('page_id', $id);
        }
        // Perbaikan: Ganti #1 menjadi $1 agar ID terisi otomatis
        $this->datatables->add_column('aksi', '
        <button type="button" class="btn btn-sm btn-info btn-view" data-id="$1">
            <i class="fas fa-eye"></i> Detail
        </button>
        <button type="button" class="btn btn-sm btn-success btn-update" data-id="$1">
            <i class="fa fa-pencil-alt"></i> Update
        </button>
        <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="$1">
            <i class="fa fa-trash"></i> Delete Content
        </button>
    ', 'id');
        $this->db->where('id_domain', $domain->id);
        $this->db->order_by('id DESC');
        return $this->datatables->generate();
    }
    public function getPages($domain)
    {
        return $this->db
            ->where('id_domain', $domain)
            ->where('status', 1)
            ->order_by('parent_id', 'ASC')
            ->get('table_pages')
            ->result_array();
    }

    public function view_carousel()
    {
        $id = $this->input->post('id_domain');

        $this->datatables->select('id,url_id,section_id,image,title,subtitle,content,facebook_link,twitter_link,instagram_link,urutan,is_active');
        $this->datatables->from('tbl_carousel');
        if ($id != "") {

            $this->db->where('url_id', $id);
        }
        // Perbaikan: Ganti #1 menjadi $1 agar ID terisi otomatis
        $this->datatables->add_column('aksi', '
        <button type="button" class="btn btn-sm btn-info btn-view" data-id="$1">
            <i class="fas fa-eye"></i> Detail
        </button>
        <button type="button" class="btn btn-sm btn-success btn-update" data-id="$1">
            <i class="fa fa-pencil-alt"></i> Update
        </button>
        <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="$1">
            <i class="fa fa-trash"></i> Delete
        </button>
    ', 'id');
        $this->db->order_by('id DESC');
        return $this->datatables->generate();
    }
    public function view_menu()
    {
        $id = $this->input->post('id_domain');

        $this->datatables->select('id,parent_id,nama_menu,slug,url_id,urutan,is_active,created_at,type,page_id,category_id,target,icon,status');
        $this->datatables->from('table_menu_navigasi');
        if ($id != "") {

            $this->db->where('url_id', $id);
        }
        // Perbaikan: Ganti #1 menjadi $1 agar ID terisi otomatis
        $this->datatables->add_column('aksi', '
        <button type="button" class="btn btn-sm btn-info btn-view" data-id="$1">
            <i class="fas fa-eye"></i> Detail
        </button>
        <button type="button" class="btn btn-sm btn-success btn-update" data-id="$1">
            <i class="fa fa-pencil-alt"></i> Update
        </button>
        <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="$1">
            <i class="fa fa-trash"></i> Delete
        </button>
    ', 'id');
        $this->db->order_by('id DESC');
        return $this->datatables->generate();
    }
    public function view_data_media()
    {
        $id = $this->input->post('id_domain');

        $this->datatables->select('id,domain_id,file_name,file_name_video,file_original,file_path,file_type,file_size,alt_text,caption,media_category,is_active,created_at,created_by');
        $this->datatables->from('table_media');
        if ($id != "") {

            $this->db->where('domain_id', $id);
        }
        // Perbaikan: Ganti #1 menjadi $1 agar ID terisi otomatis
        $this->datatables->add_column('aksi', '
        <button type="button" class="btn btn-sm btn-info btn-view" data-id="$1">
            <i class="fas fa-eye"></i> Detail
        </button>
        <button type="button" class="btn btn-sm btn-success btn-update" data-id="$1">
            <i class="fa fa-pencil-alt"></i> Update
        </button>
        <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="$1">
            <i class="fa fa-trash"></i> Delete
        </button>
    ', 'id');
        $this->db->order_by('id DESC');
        return $this->datatables->generate();
    }
    public function get_active_pages()
    {
        return $this->db
            ->where('status', 1)
            ->get('table_pages')
            ->result();
    }
    public function view_jurnal()
    {
        // Mengambil parameter dari DataTables POST request (Server-Side)
        $id_domain = $this->input->post('id_domain', true);
        $draw      = $this->input->post('draw', true);
        $start     = $this->input->post('start', true);
        $length    = $this->input->post('length', true);
        $search    = $this->input->post('search', true);
        $order     = $this->input->post('order', true);

        // Tentukan nama tabel jurnal DOAJ
        $table = 'table_jurnal';

        $this->db->from($table);

        // Filter berdasarkan id_domain
        if ($id_domain) {
            $this->db->where('id_domain', $id_domain);
        }

        // Total data keseluruhan tanpa filter pencarian
        $totalRecords = $this->db->count_all_results('', false);

        // Logika Pencarian (Searching) DataTables untuk struktur DOAJ
        if (!empty($search['value'])) {
            $keyword = $search['value'];
            $this->db->group_start();
            $this->db->like('title', $keyword);
            $this->db->or_like('authors', $keyword);
            $this->db->or_like('issn', $keyword);
            $this->db->or_like('subject', $keyword);
            $this->db->or_like('publisher', $keyword);
            $this->db->or_like('doi', $keyword);
            $this->db->group_end();
        }

        // Hitung total data setelah filter pencarian
        $totalFiltered = $this->db->count_all_results('', false);

        // Logika Pengurutan (Ordering) DataTables disesuaikan dengan kolom DOAJ
        if (isset($order)) {
            $columns = ['id', 'title', 'authors', 'issn', 'subject', 'publication_date'];
            $colIdx = $order['0']['column'];
            $colDir = $order['0']['dir'];
            if (isset($columns[$colIdx])) {
                $this->db->order_by($columns[$colIdx], $colDir);
            }
        } else {
            $this->db->order_by('id', 'DESC');
        }

        // Batasi (Limit) untuk Pagination Server-Side
        if ($length != -1) {
            $this->db->limit($length, $start);
        }

        $query = $this->db->get();
        $result = $query->result();

        $data = [];
        $no = $start + 1;

        foreach ($result as $row) {
            $rowData = [];
            $rowData['no']               = $no++;
            $rowData['title']            = '<span class="font-weight-bold text-dark">' . $row->title . '</span><br><small class="text-muted">DOI: ' . $row->doi . '</small>';
            $rowData['authors']          = $row->authors;
            $rowData['issn']             = '<span class="badge badge-secondary">' . $row->issn . '</span>';
            $rowData['subject']          = '<span class="badge badge-info">' . $row->subject . '</span>';
            $rowData['publication_date'] = !empty($row->publication_date) ? date('d-m-Y', strtotime($row->publication_date)) : '-';

            // Tombol Aksi untuk setiap baris data
            $rowData['aksi'] = '
                <a href="' . $row->url_article . '" target="_blank" class="btn btn-primary btn-sm" title="Lihat Artikel"><i class="fas fa-external-link-alt"></i></a>
                <button class="btn btn-info btn-sm btn-view" data-id="' . $row->id . '" title="Detail"><i class="fas fa-eye"></i></button>
                <button class="btn btn-warning btn-sm btn-update text-white" data-id="' . $row->id . '" title="Edit"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger btn-sm btn-delete" data-id="' . $row->id . '" title="Hapus"><i class="fas fa-trash"></i></button>
            ';

            $data[] = $rowData;
        }

        $output = [
            "draw"            => intval($draw),
            "recordsTotal"    => intval($totalRecords),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        ];

        return json_encode($output);
    }

    public function view_seminar()
    {
        // Mengambil parameter dari DataTables POST request (Server-Side)
        $id_domain = $this->input->post('id_domain', true);
        $draw      = $this->input->post('draw', true);
        $start     = $this->input->post('start', true);
        $length    = $this->input->post('length', true);
        $search    = $this->input->post('search', true);
        $order     = $this->input->post('order', true);

        // Tentukan nama tabel seminar/event
        $table = 'table_events';

        $this->db->from($table);

        // Filter berdasarkan id_domain
        if ($id_domain) {
            $this->db->where('id_domain', $id_domain);
        }

        // Total data keseluruhan tanpa filter pencarian
        $totalRecords = $this->db->count_all_results('', false);

        // Logika Pencarian (Searching) DataTables untuk struktur seminar
        if (!empty($search['value'])) {
            $keyword = $search['value'];
            $this->db->group_start();
            $this->db->like('event_title', $keyword);
            $this->db->or_like('event_category', $keyword);
            $this->db->or_like('speaker_name', $keyword);
            $this->db->or_like('speaker_title', $keyword);
            $this->db->or_like('event_location', $keyword);
            $this->db->or_like('event_type', $keyword);
            $this->db->or_like('status', $keyword);
            $this->db->group_end();
        }

        // Hitung total data setelah filter pencarian
        $totalFiltered = $this->db->count_all_results('', false);

        // Logika Pengurutan (Ordering) DataTables disesuaikan dengan kolom seminar
        if (isset($order)) {
            $columns = ['id_event', 'event_title', 'event_category', 'speaker_name', 'event_date', 'event_location', 'status'];
            $colIdx = $order['0']['column'];
            $colDir = $order['0']['dir'];
            if (isset($columns[$colIdx])) {
                $this->db->order_by($columns[$colIdx], $colDir);
            }
        } else {
            $this->db->order_by('id_event', 'DESC');
        }

        // Batasi (Limit) untuk Pagination Server-Side
        if ($length != -1) {
            $this->db->limit($length, $start);
        }

        $query = $this->db->get();
        $result = $query->result();

        $data = [];
        $no = $start + 1;

        foreach ($result as $field) {
            $rowData = [];
            $rowData['no']             = $no++;
            $rowData['event_title']    = '<span class="font-weight-bold text-dark">' . $field->event_title . '</span>';
            $rowData['event_category'] = '<span class="badge badge-info">' . $field->event_category . '</span>';
            $rowData['speaker_name']   = $field->speaker_name . ($field->speaker_title ? '<br><small class="text-muted">' . $field->speaker_title . '</small>' : '');
            $rowData['event_date']     = !empty($field->event_date) ? date('d M Y H:i', strtotime($field->event_date)) : '-';
            $rowData['event_location'] = '<span class="badge badge-secondary">' . $field->event_type . '</span><br><small>' . $field->event_location . '</small>';

            $statusBadge = 'success';
            if ($field->status == 'Upcoming') $statusBadge = 'warning';
            elseif ($field->status == 'Completed') $statusBadge = 'secondary';
            elseif ($field->status == 'Cancelled') $statusBadge = 'danger';

            $rowData['status']         = '<span class="badge badge-' . $statusBadge . '">' . $field->status . '</span>';

            // Tombol Aksi untuk setiap baris data seminar
            $rowData['aksi'] = '
                <button type="button" class="btn btn-info btn-sm btn-update" data-id="' . $field->id_event . '" title="Edit"><i class="fas fa-edit"></i></button>
                <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="' . $field->id_event . '" title="Hapus"><i class="fas fa-trash"></i></button>
            ';

            $data[] = $rowData;
        }

        $output = [
            "draw"            => intval($draw),
            "recordsTotal"    => intval($totalRecords),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        ];

        return json_encode($output);
    }
}
