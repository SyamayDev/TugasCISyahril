<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model'); // Memastikan model User_model terload
    }

    public function index() {
        // Menampilkan halaman login
        $this->load->view('view_login');
    }

    public function proses_login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        // Memastikan validasi username dan password
        $user = $this->User_model->validateUser($username, $password);
    
        if ($user) {
            // Set session data jika login berhasil
            $this->session->set_userdata('user_id', $user->id);
            $this->session->set_userdata('username', $user->username);
    
            echo json_encode([
                'status' => true,
                'message' => 'Login berhasil',
                'redirect_url' => base_url('dashboard') // Redirect ke dashboard
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => 'Username atau password salah', // Pesan kesalahan jika login gagal
                'redirect_url' => base_url('login') // Redirect kembali ke halaman login
            ]);
        }
    }
    
    
    public function logout() {
        // Menghapus session dan redirect ke login
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->sess_destroy();
        redirect('login');
    }
}
