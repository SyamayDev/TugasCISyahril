<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Masterdata_model extends CI_Model
{

	protected $tableTahunPelajaran = 'data_tahun_pelajaran';
	protected $tableTahunAjaran = 'data_tahun_pelajaran';
	protected $tableKelas = 'data_kelas';
	protected $tableJurusan = 'data_jurusan';
	protected $tableJenisBiaya = 'jenis_biaya';
	protected $tableHargaBiaya = 'harga_biaya';
	protected $tableJenisSeragam = 'jenis_seragam';
	protected $tableStokSeragam = 'stok_seragam';

	public function __construct()
	{
		parent::__construct();
	}

	// CRUD for Tahun Pelajaran

	public function getAllTahunPelajaran()
	{
		return  $this->db->get($this->tableTahunPelajaran);
	}

	public function getAllTahunPelajaranNotDeleted()
	{
		$this->db->where('deleted_at', 0);
		return  $this->db->get($this->tableTahunPelajaran);
	}
	public function getTahunPelajaranByName($nama_tahun_pelajaran)
	{
		$this->db->where('nama_tahun_pelajaran', $nama_tahun_pelajaran);
		return $this->db->get($this->tableTahunPelajaran);
	}

	public function getTahunPelajaranByID($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->tableTahunPelajaran);
	}

	public function cekTahunPelajaranDuplicate($nama_tahun_pelajaran, $id)
	{
		if ($id) {
			$this->db->where('id !=', $id);
		}
		$this->db->where('nama_tahun_pelajaran', $nama_tahun_pelajaran);
		return $this->db->get($this->tableTahunPelajaran);
	}

	public function saveTahunPelajaran($data)
	{
		$this->db->insert($this->tableTahunPelajaran, $data);
		return $this->db->insert_id();
	}
	public function updateTahunPelajaran($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->tableTahunPelajaran, $data);
		return $this->db->affected_rows();
	}

	public function deleteTahunPelajaran($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->tableTahunPelajaran);
		return $this->db->affected_rows();
	}


	// CRUD for Jurusan
	public function getAllJurusan()
	{
		return $this->db->get($this->tableJurusan);
	}
	public function getAllJurusanNotDeleted()
	{
		$this->db->select($this->tableJurusan . '.*, ' . $this->tableTahunPelajaran . '.nama_tahun_pelajaran');
		$this->db->join($this->tableTahunPelajaran, $this->tableTahunPelajaran . '.id = ' . $this->tableJurusan . '.id_tahun_pelajaran');
		$this->db->where($this->tableJurusan . '.deleted_at', 0);
		return $this->db->get($this->tableJurusan);
	}

	public function getJurusanByID($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->tableJurusan);
	}

	public function getJurusanByTahunPelajaranID($id)
	{
		$this->db->where('id_tahun_pelajaran', $id);
		return $this->db->get($this->tableJurusan);
	}

	public function cekJurusanDuplicate($nama_jurusan, $id_tahun_pelajaran, $id)
	{
		if ($id) {
			$this->db->where('id !=', $id);
		}
		$this->db->where('id_tahun_pelajaran =', $id_tahun_pelajaran);
		$this->db->where('nama_jurusan', $nama_jurusan);
		return $this->db->get($this->tableJurusan);
	}

	public function saveJurusan($data)
	{
		$this->db->insert($this->tableJurusan, $data);
		return $this->db->insert_id();
	}

	public function updateJurusan($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->tableJurusan, $data);
		return $this->db->affected_rows();
	}

	public function deleteJurusan($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->tableJurusan);
		return $this->db->affected_rows();
	}

	
	// CRUD for Kelas
	public function getAllKelas()
	{
		return $this->db->get($this->tableKelas);
	}
	public function getAllKelasNotDeleted()
	{
		$this->db->select($this->tableKelas . '.*, ' . $this->tableTahunPelajaran . '.nama_tahun_pelajaran, ' . $this->tableJurusan . '.nama_jurusan');
		$this->db->join($this->tableJurusan, $this->tableJurusan . '.id = ' . $this->tableKelas . '.id_jurusan');
		$this->db->join($this->tableTahunPelajaran, $this->tableTahunPelajaran . '.id = ' . $this->tableJurusan . '.id_tahun_pelajaran');
		$this->db->where($this->tableKelas . '.deleted_at', 0);
		return $this->db->get($this->tableKelas);
	}

	public function getKelasByID($id)
	{
		$this->db->select($this->tableKelas . '.*, ' . $this->tableTahunPelajaran . '.nama_tahun_pelajaran, ' . $this->tableJurusan . '.nama_jurusan, ' . $this->tableJurusan . '.id_tahun_pelajaran');
		$this->db->join($this->tableJurusan, $this->tableJurusan . '.id = ' . $this->tableKelas . '.id_jurusan', 'left');
		$this->db->join($this->tableTahunPelajaran, $this->tableTahunPelajaran . '.id = ' . $this->tableJurusan . '.id_tahun_pelajaran', 'left');
		$this->db->where($this->tableKelas . '.deleted_at', 0);
		$this->db->where($this->tableKelas . '.id', $id);
		return $this->db->get($this->tableKelas);
	}

	public function cekKelasDuplicate($nama_kelas,  $id_jurusan, $id)
	{
		if ($id) {
			$this->db->where('id !=', $id);
		}
		$this->db->where('id_jurusan', $id_jurusan);
		$this->db->where('nama_kelas', $nama_kelas);
		return $this->db->get($this->tableKelas);
	}

	public function saveKelas($data)
	{
		$this->db->insert($this->tableKelas, $data);
		return $this->db->insert_id();
	}

	public function updateKelas($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->tableKelas, $data);
		return $this->db->affected_rows();
	}

	public function deleteKelas($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->tableKelas);
		return $this->db->affected_rows();
	}

	public function saveJenisBiaya($data)
	{
		$this->db->insert($this->tableJenisBiaya, $data);
		return $this->db->insert_id();
	}
	public function updateJenisBiaya($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->tableJenisBiaya, $data);
		return $this->db->affected_rows();
	}

	public function deleteJenisBiaya($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->tableJenisBiaya);
		return $this->db->affected_rows();
	}
	public function getAllJenisBiaya()
	{
		return $this->db->get($this->tableJenisBiaya);
	}
	public function getJenisBiayaByID($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->tableJenisBiaya);
	}

	public function getJenisBiayaAktif()
	{
		$this->db->where('deleted_at', 0);
		$this->db->where('status_jenis_biaya', 1);
		return $this->db->get($this->tableJenisBiaya);
	}

	public function getAllHargaBiaya()
	{
		$this->db->select($this->tableHargaBiaya . '.*, ' . $this->tableJenisBiaya . '.nama_jenis_biaya ,' . $this->tableTahunPelajaran . '.nama_tahun_pelajaran');
		$this->db->join($this->tableJenisBiaya, $this->tableJenisBiaya . '.id = ' . $this->tableHargaBiaya . '.jenis_biaya_id', 'left');
		$this->db->join($this->tableTahunPelajaran, $this->tableTahunPelajaran . '.id = ' . $this->tableHargaBiaya . '.tahun_pelajaran_id', 'left');
		$this->db->where($this->tableHargaBiaya . '.deleted_at', 0);
		return $this->db->get($this->tableHargaBiaya);
	}

	public function getHargaBiayaByID($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->tableHargaBiaya);
	}

	public function saveHargaBiaya($data)
	{
		$this->db->insert($this->tableHargaBiaya, $data);
		return $this->db->insert_id();
	}

	public function updateHargaBiaya($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->tableHargaBiaya, $data);
		return $this->db->affected_rows();
	}

	public function deleteHargaBiaya($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->tableHargaBiaya);
		return $this->db->affected_rows();
	}



// ----------------------------------------------------------------------



	// CRUD for Jenis Seragam

	public function saveJenisSeragam($data)
	{
		$this->db->insert($this->tableJenisSeragam, $data);
		return $this->db->insert_id();
	}
	public function updateJenisSeragam($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->tableJenisSeragam, $data);
		return $this->db->affected_rows();
	}

	public function deleteJenisSeragam($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->tableJenisSeragam);
		return $this->db->affected_rows();
	}
	public function getAllJenisSeragam()
	{
		return $this->db->get($this->tableJenisSeragam);
	}
	public function getJenisSeragamByID($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->tableJenisSeragam);
	}


	public function getAllStokSeragam()
	{
		$this->db->select($this->tableHargaBiaya . '.*, ' . $this->tableJenisBiaya . '.nama_jenis_biaya ,' . $this->tableTahunPelajaran . '.nama_tahun_pelajaran');
		$this->db->join($this->tableJenisBiaya, $this->tableJenisBiaya . '.id = ' . $this->tableHargaBiaya . '.jenis_biaya_id', 'left');
		$this->db->join($this->tableTahunPelajaran, $this->tableTahunPelajaran . '.id = ' . $this->tableHargaBiaya . '.tahun_pelajaran_id', 'left');
		$this->db->where($this->tableHargaBiaya . '.deleted_at', 0);
		return $this->db->get($this->tableStokSeragam);
	}

	public function getStokSeragamByID($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->tableStokSeragam);
	}

	public function saveStokSeragam($data)
	{
		$this->db->insert($this->tableStokSeragam, $data);
		return $this->db->insert_id();
	}

	public function updateStokSeragam($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->tableStokSeragam, $data);
		return $this->db->affected_rows();
	}

	public function deleteStokSeragam($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->tableStokSeragam);
		return $this->db->affected_rows();
	}


}






