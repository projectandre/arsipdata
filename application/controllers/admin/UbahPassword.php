<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UbahPassword extends CI_Controller
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
            'judul' => 'Ubah Password',
            'page' => 'umum/ubah_password',
            'side_bidang' => $this->M_Bidang->tampil_data_bidang(),

        );
        $this->load->view('tempApp', $data, false);
    }

    public function update_password()
    {
        $data['user'] = $this->db->get_where('tabel_user', ['id_user' =>
        $this->session->userdata('id_user')])->row_array();
        $this->form_validation->set_rules('password_lama', 'Password Lama', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password Baru', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password baru tidak sama dengan ulangi password, silahkan masukkan ulang!',
            'min_length' => 'password terlalu pendek!'
        ]);
        $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|trim|min_length[3]');


        if ($this->form_validation->run() == False) {
            $data = array(
                'judul' => 'Ubah Password',
                'page' => 'umum/ubah_password',
                'side_bidang' => $this->M_Bidang->tampil_data_bidang()
            );
            $this->load->view('tempApp', $data, false);
        } else {
            $password_lama = $this->input->post('password_lama');
            $password_baru = $this->input->post('password1');
            if (!password_verify($password_lama, $data['user']['password'])) {
                $this->session->set_flashdata('pesan',  '<div class="alert alert-danger alert-dismissible fade show" role="alert">Password Lama Salah !!   <button type="button" style="color : white;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
                redirect('admin/UbahPassword');
            } else {
                if ($password_lama == $password_baru) {
                    $this->session->set_flashdata('pesan',  '<div class="alert alert-danger alert-dismissible fade show" role="alert">Password baru tidak boleh sama dengan password lama!!   <button type="button" style="color : white;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
                    redirect('admin/UbahPassword');
                } else {
                    $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('id_user', $this->session->userdata('id_user'));
                    $this->db->update('tabel_user');

                    $this->session->set_flashdata('pesan',  '<div class="alert alert-success alert-dismissible fade show" role="alert">Password telah diubah <button type="button" style="color : white;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
                    redirect('admin/UbahPassword');
                }
            }
        }
    }
}
