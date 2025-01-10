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

    // Mengecek apakah username sudah ada, kecuali jika username adalah milik user yang sedang diedit
    public function isUsernameExist($username, $exclude_id = null) {
        $this->db->where('username', $username);
        if ($exclude_id) {
            $this->db->where('id !=', $exclude_id);
        }
        $query = $this->db->get($this->table);
        return $query->num_rows() > 0;
    }

    // Validasi user login dengan password yang di-hash
    public function validateUser($username, $password) {
    // Cek username yang ada di database
    $query = $this->db->where('username', $username)->get($this->table);
    $user = $query->row();

    // Jika user ditemukan dan passwordnya cocok
    if ($user && $user->password === $password) {
        return $user; // Login berhasil
    }
    return null; // Username atau password salah
}
 

    public function insertUser($data) {
        // Hapus bagian untuk melakukan hashing password
        // $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function updateUser($id, $data) {
        // Hapus bagian untuk melakukan hashing password
        // $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }
    
    

    // Menghapus user, memastikan user yang sedang login tidak bisa dihapus
    public function deleteUser($id) {
        $current_user = $this->session->userdata('user_id');
        if ($id == $current_user) {
            return false; // Mencegah penghapusan diri sendiri
        }
    
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }
}
