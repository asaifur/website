<?php
class Blog_model extends CI_Model
{
    public function get_by_slug($slug)
    {
        return $this->db
            ->where('slug', $slug)
            ->get('tbl_blog')
            ->row_array();
    }
}
