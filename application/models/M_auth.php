<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_auth extends CI_Model
{
    public function tambah_user($data)
    {
        $this->db->insert('tabel_user', $data);
    }
}
