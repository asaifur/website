<?php
class User_model extends CI_Model
{
    public function check_login($username)
    {
        return $this->db->get_where('users', ['email' => $username])->row_array();
    }
    public function register($data)
    {
        return $this->db->insert('users', $data);
    }

    public function fetch_data_by_modul($table, $modul)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->group_by($modul);
        $query = $this->db->get();
        return $query->result();
    }

    public function getMenuByRole($role_id)
    {
        $this->db->select('user_menu.*');
        $this->db->from('user_menu');
        $this->db->join('user_access_menu', 'user_menu.id = user_access_menu.menu_id');
        $this->db->where('user_access_menu.role_id', $role_id);
        $this->db->where('user_menu.is_active', 1);
        $this->db->order_by('urut', 'asc');
        $this->db->order_by('modul', 'ASC');
        return $this->db->get()->result();
    }
    public function getMenu($admin, $role_id)
    {
        if ($admin == 1) {

            $this->db->select('user_menu.*');
            $this->db->from('user_menu');
            $this->db->where('user_menu.is_active', 1);
            $this->db->order_by('urut', 'asc');
            $this->db->order_by('modul', 'ASC');
        } else {
            $this->db->select('user_menu.*');
            $this->db->from('user_menu');
            $this->db->join('user_access_menu', 'user_menu.id = user_access_menu.menu_id');
            $this->db->where('user_access_menu.role_id', $role_id);
            $this->db->where('user_menu.is_active', 1);
            $this->db->order_by('urut', 'asc');
            $this->db->order_by('modul', 'ASC');
        }
        return $this->db->get()->result();
    }
}
