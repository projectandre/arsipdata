<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
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
        $ambilData = $this->db->get_where('tabel_user', array('id_user' => $this->session->userdata('id_user')))->row();
        $data = array(
            'judul' => 'Profile',
            'page' => 'umum/profile',
            'profile' => $ambilData,
            'side_bidang' => $this->M_Bidang->tampil_data_bidang(),

        );
        $this->load->view('tempApp', $data, false);
    }

    public function edit_profile()
    {
        $ambilData = $this->db->get_where('tabel_user', array('id_user' => $this->session->userdata('id_user')))->row();
        $data = array(
            'judul' => 'Edit My Profile',
            'page' => 'umum/edit_profile',
            'profile' => $ambilData,
            'side_bidang' => $this->M_Bidang->tampil_data_bidang(),

        );
        $this->load->view('tempApp', $data, false);
    }

    public function update_profile()
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));

        $this->form_validation->set_rules('email', 'Email', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));

        if ($this->form_validation->run() == False) {
            $ambilData = $this->db->get_where('tabel_user', array('id_user' => $this->session->userdata('id_user')))->row();
            $data = array(
                'judul' => 'Edit My Profile',
                'page' => 'umum/edit_profile',
                'profile' => $ambilData,
                'side_bidang' => $this->M_Bidang->tampil_data_bidang(),

            );
            $this->load->view('tempApp', $data, false);
        } else {
            $data = array(
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'id_user' => $this->session->userdata('id_user')
            );


            $berhasil = $this->db->update('tabel_user', $data, array('id_user' => $data['id_user']));
            if ($berhasil == true) {
                $data = [
                    'email' =>  htmlspecialchars($this->input->post('email', true)),
                    'nama' =>  htmlspecialchars($this->input->post('nama', true))
                ];
                $this->session->set_userdata($data);
            }
            $this->session->set_flashdata('pesan',  '<div class="alert alert-success alert-dismissible fade show" role="alert">Profile Berhasil Diubah !!   <button type="button" style="color : white;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('admin/Profile');
        }
    }
}
