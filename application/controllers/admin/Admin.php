<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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
            'judul' => 'Dashboard',
            'page' => 'admin/dashboard',
            'side_bidang' => $this->M_Bidang->tampil_data_bidang(),
            'data_bidang' => $this->M_Bidang->getJumlahPegawaiPerBidang()
        );
        $this->load->view('tempApp', $data, false);
    }
}
