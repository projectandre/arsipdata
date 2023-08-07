<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bidang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }

        $this->load->model('M_Bidang');
        $data['side_bidang'] = $this->M_Bidang->tampil_data_bidang();
    }

    public function index()
    {
        $data = array(
            'judul' => 'Tabel Bidang',
            'page' => 'admin/tambahBidang/bidang',
            'jenis' => $this->M_Bidang->tampil_data_bidang(),
            'side_bidang' => $this->M_Bidang->tampil_data_bidang(),
        );
        $this->load->view('tempApp', $data, false);
    }

    public function tambah_bidang()
    {

        $bidang = $this->db->get_where('tabel_bidang', ['nama_bidang' => htmlspecialchars($this->input->post('nama_bidang', true))])->row_array();

        if ($bidang) {
            $this->session->set_flashdata('pesan',  '<div class="alert alert-danger alert-dismissible fade show" role="alert">Bidang tidak berhasil ditambah ! bidang yang telah ada tidak boleh ditambahkan kembali!   <button type="button" style="color : white;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('admin/Bidang');
        } else {

            $nama_bidang = htmlspecialchars($this->input->post('nama_bidang', true));

            $data = array(
                'nama_bidang' => $nama_bidang
            );

            $this->M_Bidang->tambah_data_bidang($data);
            $this->session->set_flashdata('pesan',  '<div class="alert alert-success alert-dismissible fade show" role="alert">Bidang Berhasil Ditambah !!   <button type="button" style="color : white;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');

            redirect('admin/Bidang');
        }
    }

    public function delete_bidang($id_bidang)
    {
        $bidang = $this->db->get_where('tabel_pegawai', ['id_bidang' => $id_bidang])->row_array();

        if ($bidang) {
            $this->session->set_flashdata('pesan',  '<div class="alert alert-danger alert-dismissible fade show" role="alert">Bidang gagal dihapus, data pegawai masih tersedia!!   <button type="button" style="color : white;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('admin/Bidang');
        } else {
            $data = array(
                'id_bidang' => $id_bidang,
            );
            $this->M_Bidang->hapus_data_bidang($data);
            $this->session->set_flashdata('pesan',  '<div class="alert alert-success alert-dismissible fade show" role="alert">Bidang Berhasil Dihapus !!   <button type="button" style="color : white;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('admin/Bidang');
        }
    }

    public function edit_bidang($id_bidang)
    {

        $data = array(
            'judul' => 'Edit Bidang',
            'page' => 'admin/tambahBidang/edit_bidang',
            'jenis' => $this->M_Bidang->detail_data_bidang($id_bidang),
            'side_bidang' => $this->M_Bidang->tampil_data_bidang(),

        );
        $this->load->view('tempApp', $data, false);
    }

    public function update_bidang($id_bidang)
    {

        $this->form_validation->set_rules('nama_bidang', 'Nama Bidang', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));

        if ($this->form_validation->run() == false) {
            $data = array(
                'judul' => 'Edit Bidang',
                'page' => 'admin/tambahBidang/edit_bidang',
                'jenis' => $this->M_Bidang->detail_data_bidang($id_bidang),
                'side_bidang' => $this->M_Bidang->tampil_data_bidang(),

            );
            $this->load->view('tempApp', $data, false);
        } else {
            $nama_bidang = htmlspecialchars($this->input->post('nama_bidang', true));

            $data = array(
                'id_bidang' => $id_bidang,
                'nama_bidang' => $nama_bidang
            );

            $this->M_Bidang->update_data_bidang($data);
            $this->session->set_flashdata('pesan',  '<div class="alert alert-success alert-dismissible fade show" role="alert">Bidang Berhasil Diubah !!   <button type="button" style="color : white;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('admin/Bidang');
        }
    }
}
