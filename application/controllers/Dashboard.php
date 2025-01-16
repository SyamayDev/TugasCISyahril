<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Cek session untuk memastikan pengguna sudah login
        if (!$this->session->userdata('is_login')) {
            redirect('login', 'refresh'); // Redirect ke halaman login jika belum login
        }

        $this->load->model('User_model');
    }

    /**
     * Halaman utama dashboard
     */
    public function index()
    {
        $data = [
            'menu' => 'backend/menu', // Bisa digunakan untuk menu samping
            'content' => 'view_dashboard', // Template untuk halaman dashboard
            'title' => 'Admin' // Judul halaman
        ];

        // Ambil semua data user
        $users = $this->User_model->getUserAll();
        $data['users'] = $users; // Simpan data users untuk ditampilkan di view

        $this->load->view('template', $data); // Load template yang sudah ada
    }

    /**
     * Mengambil data user untuk ditampilkan dalam tabel
     */
    public function tableUser()
    {
        $users = $this->User_model->getUserAll();
        $data = [];
        $current_user_id = $this->session->userdata('user_id'); // ID pengguna yang sedang login

        if (!empty($users)) {
            foreach ($users as $user) {
                // Tandai pengguna yang tidak bisa di-edit (yang sedang login)
                $user['cannot_edit'] = ($user['id'] == $current_user_id);
                $data[] = $user;
            }

            $response = [
                'status' => true,
                'data' => $data,
                'message' => ''
            ];
        } else {
            $response = [
                'status' => false,
                'data' => [],
                'message' => 'Data tidak tersedia'
            ];
        }

        echo json_encode($response); // Kirimkan data user ke client
    }

    /**
     * Menyimpan atau memperbarui data user
     */
    public function save()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $id = $this->input->post('id');

        // Validasi input
        if (empty($username) || empty($password)) {
            $response = [
                'status' => false,
                'message' => 'Username atau Password tidak boleh kosong'
            ];
        } else {
            $existingUser = $this->User_model->getUserByUsername($username);

            // Cek apakah username sudah digunakan
            if ($existingUser && !$id) {
                $response = [
                    'status' => false,
                    'message' => 'Username sudah digunakan'
                ];
            } else {
                $data = [
                    'username' => $username,
                    'password' => $password // Simpan password tanpa hashing
                ];

                if ($id) {
                    // Update user jika id sudah ada
                    $update = $this->User_model->updateUser($id, $data);
                    $response = $update
                        ? ['status' => true, 'message' => 'Data berhasil diupdate']
                        : ['status' => false, 'message' => 'Data gagal diupdate'];
                } else {
                    // Simpan user baru
                    $insert = $this->User_model->insertUser($data);
                    $response = $insert
                        ? ['status' => true, 'message' => 'Data berhasil disimpan']
                        : ['status' => false, 'message' => 'Data gagal disimpan'];
                }
            }
        }

        echo json_encode($response); // Kirimkan response ke client
    }

    /**
     * Mengambil data user berdasarkan ID
     */
    public function edit()
    {
        $id = $this->input->post('id');
        $user = $this->User_model->getUserByID($id);

        if ($user) {
            $response = [
                'status' => true,
                'data' => $user,
                'message' => ''
            ];
        } else {
            $response = [
                'status' => false,
                'data' => [],
                'message' => 'Data tidak ditemukan'
            ];
        }

        echo json_encode($response); // Kirimkan data user ke client
    }

    /**
     * Memperbarui data user
     */
    public function update()
    {
        $id = $this->input->post('id');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Data yang akan diupdate
        $data = [
            'username' => $username,
            'password' => $password // Simpan password tanpa hashing
        ];

        $update = $this->User_model->updateUser($id, $data);

        // Respons setelah update
        $response = $update
            ? ['status' => true, 'message' => 'Data berhasil diupdate']
            : ['status' => false, 'message' => 'Data gagal diupdate'];

        echo json_encode($response); // Kirimkan response ke client
    }

    /**
     * Menghapus data user berdasarkan ID
     */
    public function delete()
    {
        $id = $this->input->post('id');
        $delete = $this->User_model->deleteUser($id);

        $response = $delete
            ? ['status' => true, 'message' => 'Data berhasil dihapus']
            : ['status' => false, 'message' => 'Data gagal dihapus'];

        echo json_encode($response); // Kirimkan response ke client
    }

    /**
     * Logout dan menghancurkan session
     */
    public function logout()
    {
        $this->session->sess_destroy(); // Hancurkan session
        redirect('login', 'refresh'); // Redirect ke halaman login setelah logout
    }
}

/* End of file: Dashboard.php */
