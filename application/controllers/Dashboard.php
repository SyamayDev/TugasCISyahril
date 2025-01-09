<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index() {
        $q = $this->User_model->getUserAll();
        $data['users'] = $q->result();

        $this->load->view('view_dashboard', $data);
    }


    public function add() {
        $this->load->view('view_add_user');
    }

    public function save() {
        $data['username'] = $this->input->post('username');
        $data['password'] = $this->input->post('password');

        $insert = $this->User_model->insertUser($data);

        if($insert) {
            redirect('dashboard', 'refresh');
        } else {
            $this->session->set_flashdata('insert_error', 'Data gagal Disimpan');
            $this->load->view('view_add_user', $data);
        }
    }


	public function edit($id = null)
	{
		$q = $this->User_model->getUserByID($id);
		$data['user'] = $q->row();

		$this->load->view('view_edit_user', $data);
	}

	public function update_user()
	{
		$id = $this->input->post('id');
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$data = array(
			'username' => $username,
			'password' => $password
		);

		$update = $this->User_model->updateUser($id, $data);

		if ($update) {
			redirect('dashboard', 'refresh');
		} else {
			$this->session->set_flashdata('update_error', 'Data gagal diupdate');
			redirect('dashboard/edit/' . $id, 'refresh');
		}
	}

    public function delete($id = null) {
        $this->User_model->deleteUser($id);
        redirect('dashboard', 'refresh');
    }



        // if($q->num_rows() > 0) {
        //     foreach ($q->result() as $row) 
        //     {
        //         echo 'nama = ' . $row->username . "<br>";
        //         echo 'password = ' . $row->password . "<br><br>";
        //     }
        // } else {
        //     echo "<h1>Kosong Banget</h1>";
        // }
    }
