<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Pegawai extends CI_Model
{
    public function tampil_data_pegawai($id_bidang)
    {
        $sql = "    SELECT  *
                    FROM    tabel_pegawai tp
                    LEFT JOIN tabel_bidang tb ON tb.id_bidang = tp.id_bidang
                    WHERE tp.id_bidang = '$id_bidang'
                    -- ORDER BY tb.stok_barang ASC 
                    ";

        return $this->db->query($sql)->result_array();
    }

    public function tambah_pegawai($data)
    {
        $this->db->insert('tabel_pegawai', $data);
    }

    public function hapus_pegawai($data)
    {
        $this->db->where('id_pegawai', $data['id_pegawai']);
        $this->db->delete('tabel_pegawai', $data);
    }

    public function update_pegawai($data)
    {
        $this->db->where('id_pegawai', $data['id_pegawai']);
        $this->db->update('tabel_pegawai', $data);
    }

    public function detail_pegawai($id_pegawai)
    {
        $sql = " SELECT  *
        FROM    tabel_pegawai tp
        LEFT JOIN tabel_bidang tb ON tb.id_bidang = tp.id_bidang
        WHERE tp.id_pegawai = '$id_pegawai'
        -- ORDER BY tb.stok_barang ASC 
        ";
        return $this->db->query($sql)->row();
    }


    public function tambah_file_pegawai($data)
    {
        $this->db->insert('tabel_file_pegawai', $data);
    }

    public function tampil_file_pegawai($id_pegawai)
    {
        $sql = "    SELECT  *
                    FROM    tabel_file_pegawai tfp
                    WHERE tfp.id_pegawai = '$id_pegawai'
                    -- ORDER BY tb.stok_barang ASC 
                    ";

        return $this->db->query($sql)->result_array();
    }

    public function hapus_file_pegawai($data)
    {
        $this->db->where('id_file', $data['id_file']);
        $this->db->delete('tabel_file_pegawai', $data);
    }


    public function detail_file_pegawai($id_file)
    {
        $sql = " SELECT  *
        FROM    tabel_file_pegawai tfp
        WHERE tfp.id_file = '$id_file'
        -- ORDER BY tb.stok_barang ASC 
        ";
        return $this->db->query($sql)->row();
    }

    public function detail_xfile_pegawai($id_pegawai)
    {
        $sql = " SELECT  *
        FROM    tabel_file_pegawai tfp
        WHERE tfp.id_pegawai = '$id_pegawai'
        -- ORDER BY tb.stok_barang ASC 
        ";
        return $this->db->query($sql)->result();
    }

    public function update_file_pegawai($data)
    {
        $this->db->where('id_file', $data['id_file']);
        $this->db->update('tabel_file_pegawai', $data);
    }
}
