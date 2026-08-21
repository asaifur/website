<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    // 🔹 MENU PARENT (HEADER)
    public function get_parent($domain_id)
    {
        return $this->db
            ->where('url_id', $domain_id)
            ->where('is_active', 1)
            ->where('parent_id', 0)
            ->order_by('urutan', 'ASC')
            ->get('table_menu_navigasi');
    }

    // 🔹 MENU CHILD (DROPDOWN)
    public function get_child($parent_id, $domain_id)
    {
        return $this->db
            ->where('parent_id', $parent_id)
            ->where('domain_id', $domain_id)
            ->where('is_active', 1)
            ->order_by('urutan', 'ASC')
            ->get('table_menu_navigasi');
    }

    public function format_action($table, $action)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($action, '1');
        $this->db->order_by('urut ASC');
        $query = $this->db->get();
        return $query;
    }


    function getMenu($id_domain)
    {

        return $this->db
            ->where('id_domain', $id_domain)
            ->order_by('urutan', 'ASC')
            ->get('table_menu_navigasi')
            ->result();
    }
    public function  fetch_data($table, $where = null)
    {
        $this->db->select('*');
        $this->db->from($table);
        if ($where) {
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query;
    }
    public function  fetch_data_by_limit($table, $where = null)
    {
        $this->db->select('*');
        $this->db->from($table);
        if ($where) {
            $this->db->where($where);
        }
        $this->db->limit('6');
        $query = $this->db->get();
        return $query;
    }
    public function  fetch_data_by_limit_order($table, $where = null)
    {
        $this->db->select('*');
        $this->db->from($table);
        if ($where) {
            $this->db->where($where);
        }
        $this->db->limit('6');
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query;
    }
    public function  fetch_data_pages_by_limit_order($table, $where = null)
    {
        $this->db->select('*');
        $this->db->from($table);
        if ($where) {
            $this->db->where($where);
        }
        $this->db->limit('6');
        $this->db->order_by('id_page', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function getProvinsi()
    {
        return $this->db->get('provinsi')->result();
    }

    public function getKabupaten($provinsi_id)
    {
        return $this->db->get_where('kabupaten', [
            'provinsi_id' => $provinsi_id
        ])->result();
    }

    public function getKecamatan($kabupaten_id)
    {
        return $this->db->get_where('kecamatan', [
            'kabupaten_id' => $kabupaten_id
        ])->result();
    }

    public function getKelurahan($kecamatan_id)
    {
        return $this->db->get_where('kelurahan', [
            'kecamatan_id' => $kecamatan_id
        ])->result();
    }

    public function insertData($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    // =========================
    // UPDATE
    // =========================
    public function updateData($table, $data, $where)
    {
        $this->db->where($where);
        return $this->db->update($table, $data);
    }

    public function deleteData($table, $where)
    {
        $this->db->where($where);
        return $this->db->delete($table);
    }
    public function get_page_by_slug($slug, $domain_id)
    {
        return $this->db
            ->where('slug', $slug)
            ->where('domain_id', $domain_id)
            ->where('is_active', 1)
            ->get('table_pages')
            ->row();
    }


    public function getPages($domain)
    {
        return $this->db
            ->where('id_domain', $domain)
            ->where('status', 1)
            ->get('table_pages');
    }
    public function getMenuTree($domain)
    {
        $menus = $this->db
            ->where('url_id', $domain)
            ->where('is_active', '1')
            ->order_by('urutan', 'ASC')
            ->get('table_menu_navigasi')
            ->result_array();

        return $this->buildTree($menus);
    }
    private function buildTree($menus, $parent = 0)
    {
        $branch = [];

        foreach ($menus as $menu) {

            if ($menu['parent_id'] == $parent) {

                $children = $this->buildTree($menus, $menu['id']);

                if ($children) {
                    $menu['children'] = $children;
                }

                $branch[] = $menu;
            }
        }

        return $branch;
    }
}
