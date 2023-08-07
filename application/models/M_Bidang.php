<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Bidang extends CI_Model
{
    public function tampil_data_bidang()
    {
        $this->db->select('*');
        $this->db->from('tabel_bidang');
        return $this->db->get()->result_array();
    }
    public function tambah_data_bidang($data)
    {
        $this->db->insert('tabel_bidang', $data);
    }

    public function hapus_data_bidang($data)
    {
        $this->db->where('id_bidang', $data['id_bidang']);
        $this->db->delete('tabel_bidang', $data);
    }

    public function update_data_bidang($data)
    {
        $this->db->where('id_bidang', $data['id_bidang']);
        $this->db->update('tabel_bidang', $data);
    }

    public function detail_data_bidang($data)
    {
        $this->db->select('*');
        $this->db->from('tabel_bidang');
        $this->db->where('id_bidang', $data);
        return $this->db->get()->row();
    }

    public function getJumlahPegawaiPerBidang()
    {
        $query = $this->db->select('tb.id_bidang, tb.nama_bidang, COUNT(tp.id_pegawai) as jumlah_pegawai')
            ->from('tabel_bidang tb')
            ->join('tabel_pegawai tp', 'tb.id_bidang = tp.id_bidang', 'left')
            ->group_by('tb.id_bidang')
            ->get();

        return $query->result_array();
    }
}
