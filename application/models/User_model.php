<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    protected $table = 'user';

    public function __construct() {
        parent::__construct();
    }

    public function getUserAll() {
        return $this->db->get($this->table);
    }

    public function getUserByID($id = null) {
        return $this->db->where('id', $id)->get($this->table);
    }

    public function isUsernameExist($username, $exclude_id = null) {
        $this->db->where('username', $username);
        if ($exclude_id) {
            $this->db->where('id !=', $exclude_id);
        }
        $query = $this->db->get($this->table);
        return $query->num_rows() > 0;
    }

    public function validateUser($username, $password) {
    $query = $this->db->where('username', $username)->get($this->table);
    $user = $query->row();

    if ($user && $user->password === $password) {
        return $user; 
    }
    return null; 
}
 

    public function insertUser($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function updateUser($id, $data) {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }
    
    
    public function deleteUser($id) {
        $current_user = $this->session->userdata('user_id');
        if ($id == $current_user) {
            return false;
        }
    
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }
}
