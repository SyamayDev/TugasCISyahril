<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		
        $this->load->model('User_model');
    }


public function index()
{

	if ($this->session->userdata('is_login')) {
		redirect('dashboard', 'refresh'); 
	}

	$this->load->view('view_login'); 
}


public function proses_login()
{
	$username = $this->input->post('username');
	$password = $this->input->post('password');

	$el = array();
	$err = array();


	if ($username == '') {
		array_push($err, "Username wajib diisi");
		array_push($el, "username");
	}
	if ($password == '') {
		array_push($err, "Password wajib diisi");
		array_push($el, "password");
	}


	if (count($el) > 0) {
		$ret = array(
			'element' => $el,
			'error' => $err,
			'status' => false,
			'message' => 'Login Gagal'
		);
	} else {
		$user = $this->User_model->login($username, $password);

		if ($user) {
			$sess = array(
				'is_login' => TRUE,
				'user_id' => $user['id'],
				'username' => $user['username']
			);
			$this->session->set_userdata($sess);
		
			$ret = array(
				'username' => $username,
				'password' => $password,
				'status' => true,
				'message' => 'Login Berhasil',
				'redirect' => base_url('dashboard')
			);
		} else {
			$ret = array(
				'element' => '',
				'error' => '',
				'status' => false,
				'message' => 'Username atau Password Salah'
			);
		}
		
	}

	echo json_encode($ret);
}

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login', 'refresh');
    }
}

