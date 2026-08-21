<?php
class Sitemap_model extends CI_Model
{
    public function get_active_links()
    {
        return $this->db
            ->select('slug, created_at')
            ->from('table_pages') // pastikan ini benar
            ->where('status', 1)

            ->order_by('created_at', 'DESC')
            ->get()
            ->result();
    }
}
