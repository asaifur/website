<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Domain_model extends CI_Model
{


    public function getDomain($host)
    {
        // Normalisasi: hapus www, lowercase
        $host = strtolower(preg_replace('#^www\.(.+\.)#i', '$1', $host));

        return $this->db
            ->where('url_domain', $host)
            ->or_where('domain_name', $host)
            ->where('is_active', 1)
            ->get('table_domain')
            ->row();
    }
}
