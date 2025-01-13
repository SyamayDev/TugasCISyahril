<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index() {
        $this->load->view('view_login');
    }

    public function proses_login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $user = $this->User_model->validateUser($username, $password);
    
        if ($user) {
            $this->session->set_userdata('user_id', $user->id);
            $this->session->set_userdata('username', $user->username);
    
            echo json_encode([
                'status' => true,
                'message' => 'Login berhasil',
                'redirect_url' => base_url('admin')
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => 'Username atau password salah', 
                'redirect_url' => base_url('login') 
            ]);
        }
    }
    
    
    
    public function logout() {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->sess_destroy();
        redirect('login');
    }
}
