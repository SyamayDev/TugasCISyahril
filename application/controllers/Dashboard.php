<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('is_login')) {
            redirect('login', 'refresh'); 
        }

        $this->load->model('User_model');
    }


    public function index()
    {
        $data = [
            'menu' => 'backend/menu',
            'content' => 'view_dashboard',
            'title' => 'Admin'
        ];

        $users = $this->User_model->getUserAll();
        $data['users'] = $users; 

        $this->load->view('template', $data); 
    }


    public function tableUser()
    {
        $users = $this->User_model->getUserAll();
        $data = [];
        $current_user_id = $this->session->userdata('user_id'); 

        if (!empty($users)) {
            foreach ($users as $user) {
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

        echo json_encode($response);
    }

    public function save()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $id = $this->input->post('id');

        if (empty($username) || empty($password)) {
            $response = [
                'status' => false,
                'message' => 'Username atau Password tidak boleh kosong'
            ];
        } else {
            $existingUser = $this->User_model->getUserByUsername($username);

            if ($existingUser && !$id) {
                $response = [
                    'status' => false,
                    'message' => 'Username sudah digunakan'
                ];
            } else {
                $data = [
                    'username' => $username,
                    'password' => $password 
                ];

                if ($id) {
                    $update = $this->User_model->updateUser($id, $data);
                    $response = $update
                        ? ['status' => true, 'message' => 'Data berhasil diupdate']
                        : ['status' => false, 'message' => 'Data gagal diupdate'];
                } else {
                    $insert = $this->User_model->insertUser($data);
                    $response = $insert
                        ? ['status' => true, 'message' => 'Data berhasil disimpan']
                        : ['status' => false, 'message' => 'Data gagal disimpan'];
                }
            }
        }

        echo json_encode($response); 
    }

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

        echo json_encode($response); 
    }


    public function update()
    {
        $id = $this->input->post('id');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $data = [
            'username' => $username,
            'password' => $password 
        ];

        $update = $this->User_model->updateUser($id, $data);

        $response = $update
            ? ['status' => true, 'message' => 'Data berhasil diupdate']
            : ['status' => false, 'message' => 'Data gagal diupdate'];

        echo json_encode($response); 
    }


    public function delete()
    {
        $id = $this->input->post('id');
        $delete = $this->User_model->deleteUser($id);

        $response = $delete
            ? ['status' => true, 'message' => 'Data berhasil dihapus']
            : ['status' => false, 'message' => 'Data gagal dihapus'];

        echo json_encode($response); 
    }


    public function logout()
    {
        $this->session->sess_destroy(); 
        redirect('login', 'refresh'); 
    }
}

