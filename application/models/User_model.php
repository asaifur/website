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
    public function getMenuByRole($role_id)
    {
        $this->db->select('user_menu.*');
        $this->db->from('user_menu');
        $this->db->join('user_access_menu', 'user_menu.id = user_access_menu.menu_id');
        $this->db->where('user_access_menu.role_id', $role_id);
        $this->db->where('user_menu.is_active', 1);
        $this->db->order_by('urut', 'asc');
        return $this->db->get()->result_array();
    }
}
