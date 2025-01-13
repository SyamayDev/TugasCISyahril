<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Masterdata_model extends CI_Model
{
    protected $tableTahunPelajaran = 'data_tahun_pelajaran';
    protected $tableKelas = 'kelas';
    protected $tableJurusan = 'jurusan';

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllTahunPelajaran()
    {
        return $this->db->get($this->tableTahunPelajaran);
    }

    public function insertTahunPelajaran($data)
    {
        return $this->db->insert($this->tableTahunPelajaran, $data);
    }

    public function updateTahunPelajaran($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->tableTahunPelajaran, $data);
    }

    public function deleteTahunPelajaran($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->tableTahunPelajaran);
    }

    public function getTahunPelajaranById($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->tableTahunPelajaran)->row_array();  
    }

	public function getAllKelas()
	{
		return $this->db->select('k.*, j.nama_jurusan, t.nama_tahun_pelajaran')
						->from($this->tableKelas . ' k')
						->join($this->tableJurusan . ' j', 'k.id_jurusan = j.id', 'left')
						->join($this->tableTahunPelajaran . ' t', 'k.id_tahun_pelajaran = t.id', 'left')
						->get();
	}	

    public function insertKelas($data)
    {
        return $this->db->insert($this->tableKelas, $data);
    }

    public function updateKelas($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->tableKelas, $data);
    }

    public function deleteKelas($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->tableKelas);
    }

    public function getKelasById($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->tableKelas)->row_array();  
    }

    public function getAllJurusan()
    {
        return $this->db->get($this->tableJurusan);
    }

    public function insertJurusan($data)
    {
        return $this->db->insert($this->tableJurusan, $data);
    }

    public function updateJurusan($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->tableJurusan, $data);
    }

    public function deleteJurusan($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->tableJurusan);
    }

    public function getJurusanById($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->tableJurusan)->row_array();  
    }
}
