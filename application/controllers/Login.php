<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('view_login');
    }

    public function proses_login() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        if ($email === 'admin' && $password === '12345') {
            $ret = [
                'status' => true,
                'message' => 'Login Berhasil',
                'email' => $email,
                'password' => $password
            ];
        } else {
            $ret = [
                'status' => false,
                'message' => 'Login Gagal'
            ];
        }

        echo json_encode($ret);
    }
}
