<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    protected $table = 'user';

    public function __construct()
    {
        parent::__construct();
    }

    // Mengambil semua data user
    public function getUserAll()
    {
        $q = $this->db->get($this->table);
        return $q->result_array(); // Mengembalikan hasil dalam bentuk array
    }

    // Mengambil user berdasarkan ID
    public function getUserByID($id)
    {
        $q = $this->db->where('id', $id)->get($this->table);
        return $q->row_array(); // Mengembalikan hasil sebagai array
    }

    // Mengambil user berdasarkan username
    public function getUserByUsername($username)
    {
        $q = $this->db->where('username', $username)->get($this->table);
        return $q->row_array(); // Mengembalikan hasil sebagai array
    }

    // Mengupdate data user
    public function updateUser($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    // Menyimpan data user baru
    public function insertUser($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    // Menghapus user berdasarkan ID
    public function deleteUser($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

	public function login($username, $password)
	{
		// Cek apakah username ada di database
		$q = $this->db->where('username', $username)->get($this->table);
	
		// Jika ada user dengan username tersebut
		if ($q->num_rows() > 0) {
			$user = $q->row_array();
	
			// Langsung membandingkan password dengan yang ada di database
			if ($password === $user['password']) {
				return $user; // Jika password cocok, kembalikan data user
			}
		}
	
		// Jika username atau password tidak cocok
		return null;
	}
	

    # code...
}

/* End of file: User_model.php */
