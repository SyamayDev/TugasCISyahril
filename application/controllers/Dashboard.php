<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->model('User_model');
        
        if (!$this->session->userdata('user_id')) {
            $this->session->set_flashdata('alert', 'not_logged_in');
            redirect('login');
        }
    }
    
    public function index() {
            $data = [
                'menu' => 'backend/menu',
                'content' => 'view_dashboard',
                'title' => 'Admin'
            ];

        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
    
        $q = $this->User_model->getUserAll();
        $current_user = $this->session->userdata('user_id');
        
        $data['users'] = $q->result();
    
        $data['current_user'] = $this->session->userdata('username');

        $this->load->view('template', $data);
    }
    

    public function check_username() {
        $username = $this->input->post('username');
        $user_id = $this->input->post('id');
    
        $is_existing = $this->User_model->isUsernameExist($username, $user_id);
    
        if ($is_existing) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Username sudah digunakan.'
            ]);
        } else {
            echo json_encode([
                'status' => 'success',
                'message' => 'Username tersedia.'
            ]);
        }
    }

    public function save() {

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $data = [
            'username' => $username,
            'password' => $password
        ];

        $insert = $this->User_model->insertUser($data);

        if ($insert) {
            echo json_encode([
                'status' => 'success',
                'message' => 'User added successfully!'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to add user.'
            ]);
        }
    }

    public function edit($id = null) {

        $q = $this->User_model->getUserByID($id);
        $user = $q->row();
    
        if ($user) {

            if ($user->id == $this->session->userdata('user_id')) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Tidak dapat mengedit data diri sendiri.'
                ]);
                return;
            }

            echo json_encode([
                'status' => 'success',
                'data' => $user
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'User not found.'
            ]);
        }
    }

    public function update_user() {

        $id = $this->input->post('id');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if ($id == $this->session->userdata('user_id')) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Tidak dapat mengupdate data diri sendiri.'
            ]);
            return;
        }

        $data = [
            'username' => $username,
            'password' => $password
        ];

        $update = $this->User_model->updateUser($id, $data);

        if ($update) {
            echo json_encode([
                'status' => 'success',
                'message' => 'User updated successfully!'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to update user.'
            ]);
        }
    }

    public function delete($id = null) {

        if ($id == $this->session->userdata('user_id')) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Tidak dapat menghapus data diri sendiri.'
            ]);
            return;
        }

        $delete = $this->User_model->deleteUser($id);

        if ($delete) {
            echo json_encode([
                'status' => 'success',
                'message' => 'User deleted successfully!'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to delete user.'
            ]);
        }
    }
}