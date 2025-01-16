<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    protected $table = 'user';

    public function __construct()
    {
        parent::__construct();
    }

    public function getUserAll()
    {
        $q = $this->db->get($this->table);
        return $q->result_array(); 
    }

    public function getUserByID($id)
    {
        $q = $this->db->where('id', $id)->get($this->table);
        return $q->row_array(); 
    }

    public function getUserByUsername($username)
    {
        $q = $this->db->where('username', $username)->get($this->table);
        return $q->row_array(); 
    }

    public function updateUser($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    public function insertUser($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function deleteUser($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

	public function login($username, $password)
	{

		$q = $this->db->where('username', $username)->get($this->table);

		if ($q->num_rows() > 0) {
			$user = $q->row_array();
	
			if ($password === $user['password']) {
				return $user; 
			}
		}
	
		return null;
	}
	

}

