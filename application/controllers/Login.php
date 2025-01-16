<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

// Halaman login
public function index()
{
	// Cek apakah pengguna sudah login
	if ($this->session->userdata('is_login')) {
		redirect('dashboard', 'refresh'); // Redirect ke dashboard jika sudah login
	}

	$this->load->view('view_login'); // Menampilkan halaman login
}

// Proses login
public function proses_login()
{
	$username = $this->input->post('username');
	$password = $this->input->post('password');

	$el = array();
	$err = array();

	// Validasi input
	if ($username == '') {
		array_push($err, "Username wajib diisi");
		array_push($el, "username");
	}
	if ($password == '') {
		array_push($err, "Password wajib diisi");
		array_push($el, "password");
	}

	// Jika ada error validasi
	if (count($el) > 0) {
		$ret = array(
			'element' => $el,
			'error' => $err,
			'status' => false,
			'message' => 'Login Gagal'
		);
	} else {
		// Cek login di database
		$user = $this->User_model->login($username, $password);

		if ($user) {
			// Set session jika login berhasil
			$sess = array(
				'is_login' => TRUE,
				'user_id' => $user['id'],
				'username' => $user['username']
			);
			$this->session->set_userdata($sess);
		
			// Kembalikan response jika login berhasil
			$ret = array(
				'username' => $username,
				'password' => $password,
				'status' => true,
				'message' => 'Login Berhasil',
				'redirect' => base_url('dashboard') // Tambahkan URL untuk diarahkan
			);
		} else {
			// Jika login gagal
			$ret = array(
				'element' => '',
				'error' => '',
				'status' => false,
				'message' => 'Username atau Password Salah'
			);
		}
		
	}

	// Mengirim response ke client dalam format JSON
	echo json_encode($ret);
}


    // Logout dan hancurkan session
    public function logout()
    {
        // Hancurkan session login
        $this->session->sess_destroy();
        redirect('login', 'refresh'); // Redirect ke halaman login
    }
}

/* End of file: Login.php */
