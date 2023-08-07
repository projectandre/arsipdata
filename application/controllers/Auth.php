<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'valid_email' => 'Email anda salah!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required' => 'Password harus di isi!'
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('auth/login');
        } else {
            // success valid
            $this->_login();
        }
    }

    public function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('tabel_user', ['email' => $email])->row_array();

        if ($user) {

            if (password_verify($password, $user['password'])) {

                $data = [
                    'email' => $user['email'],
                    'nama' => $user['nama'],
                    'id_user' => $user['id_user'],
                    'role' => $user['role']
                ];
                $this->session->set_userdata($data);
                if ($user['role'] == 'admin') {
                    redirect('admin/admin');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Password anda salah!</div>');
                redirect('auth');
            }
        } else {
            //user tidak ada
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email tidak terdaftar!</div>');
            redirect('auth');
        }
    }


    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Anda telah logout!</div>');
        redirect('auth');
    }

    private function _sendEmail($token, $type)
    {

        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_user'] = 'wedia.id@gmail.com';
        $config['smtp_pass'] = 'nodtcrsnxiyzigum';
        $config['smtp_port'] = '465';
        $config['mailtype'] = 'html';
        $config['starttls'] = false;
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['smtp_timeout'] = '30';
        $config['newline'] = "\r\n";

        $this->email->initialize($config);
        // $this->email->set_newline("\r\n");

        $this->email->from('test@gmail.com', 'SI Arsip Data');

        $this->email->to($this->input->post('email'));

        if ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Click this link to reset your password : <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('tabel_user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong token.</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong email.</div>');
            redirect('auth');
        }
    }

    public function email_lupa_password()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'valid_email' => 'Email anda salah!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/email_lupa_password');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('tabel_user', ['email' => $email])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];
                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Cek Email Anda Sekarang!</div>');
                redirect('auth/email_lupa_password');
            } else {
                //user tidak ada
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Email tidak terdaftar!</div>');
                redirect('auth/email_lupa_password');
            }
        }
    }


    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[3]|matches[password]');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/lupa_password');
        } else {
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('tabel_user');

            $this->session->unset_userdata('reset_email');

            $this->db->delete('user_token', ['email' => $email]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password telah berhasil diubah! Silahkan login.</div>');
            redirect('auth');
        }
    }

    public function lupa_password()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'valid_email' => 'Email anda salah!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/lupa_password');
        } else {
            // success valid

        }
    }
}
