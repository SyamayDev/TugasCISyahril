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

	public function __construct()
	{
		parent::__construct();
	}


	// CRUD for Jenis Biaya

    public function getAllJenisBiaya()
    {
        return $this->db->get($this->tableJenisBiaya);
    }

	public function getAllJenisBiayaNotDeleted() 
	{
		$this->db->where('deleted_at', 0);
		return $this->db->get($this->tableJenisBiaya);
	}
	

	public function getJenisBiayaByID($id)
	{
		$this->db->where('id_jenis_biaya', $id);
		$this->db->where('deleted_at', 0); 
		return $this->db->get($this->tableJenisBiaya, ['id' => $id]);
	}
	
	public function getAllJenisBiayaAktif()
	{
		$this->db->where('status_aktif', 1); 
		$this->db->where('deleted_at', 0);  
		return $this->db->get($this->tableJenisBiaya);  
	}


	public function cekJenisBiayaDuplicate($nama_jenis_biaya, $id = null) {
		if ($id) {
			$this->db->where('id_jenis_biaya !=', $id);
		}
		$this->db->where('nama_jenis_biaya', $nama_jenis_biaya);
		return $this->db->get($this->tableJenisBiaya);
	}
	

    public function saveJenisBiaya($data)
    {
        $this->db->insert($this->tableJenisBiaya, $data);
        return $this->db->insert_id();
    }

	public function updateJenisBiaya($id, $data) {
		$this->db->where('id_jenis_biaya', $id); 
		$this->db->update($this->tableJenisBiaya, $data);
		
		if($this->db->affected_rows() > 0) {
			return [
				'status' => true,
				'message' => 'Data jenis biaya berhasil diperbarui.'
			];
		} else {
			return [
				'status' => false,
				'message' => 'Data jenis biaya gagal diperbarui.'
				];
		}
	}
	

	public function deleteJenisBiaya($id)
	{
		$data = [
			'deleted_at' => time() 
		];
		$this->db->where('id_jenis_biaya', $id);
		$this->db->update($this->tableJenisBiaya, $data);
		return $this->db->affected_rows();
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

		// CRUD for Harga Biaya
		public function getAllHargaBiaya()
		{
			return $this->db->get($this->tableHargaBiaya);
		}
	
		public function getAllHargaBiayaNotDeleted() {
			$this->db->select("{$this->tableHargaBiaya}.*, 
							   {$this->tableTahunAjaran}.nama_tahun_pelajaran, 
							   {$this->tableJenisBiaya}.nama_jenis_biaya");
							   $this->db->join("{$this->tableTahunAjaran}", "{$this->tableTahunAjaran}.id = {$this->tableHargaBiaya}.id_tahun_ajaran", 'left');
			$this->db->join("{$this->tableJenisBiaya}", "{$this->tableJenisBiaya}.id_jenis_biaya = {$this->tableHargaBiaya}.id_jenis_biaya", 'left');
			return $this->db->get($this->tableHargaBiaya);
		}
		
		public function getHargaBiayaByID($id) {
			$this->db->select("harga_biaya.*, 
			tahun_ajaran.id AS id_tahun_ajaran, 
			tahun_ajaran.nama_tahun_pelajaran, 
			jenis_biaya.nama_jenis_biaya");
		$this->db->from('harga_biaya');
		$this->db->join('tahun_ajaran', 'tahun_ajaran.id = harga_biaya.id_tahun_ajaran', 'left');
		$this->db->join('jenis_biaya', 'jenis_biaya.id_jenis_biaya = harga_biaya.id_jenis_biaya', 'left');
		$this->db->where('harga_biaya.id_harga_biaya', $id_harga_biaya);
		$query = $this->db->get();
		return $query->row();
		}
	
		public function cekHargaBiayaDuplicate($id_tahun_ajaran, $id_jenis_biaya, $id = null)
		{
			$this->db->where('id_tahun_ajaran', $id_tahun_ajaran);
			$this->db->where('id_jenis_biaya', $id_jenis_biaya);
			if ($id) {
				$this->db->where('id_harga_biaya !=', $id);
			}
			return $this->db->get($this->tableHargaBiaya);
		}
	
		public function saveHargaBiaya($data)
		{
			$this->db->insert($this->tableHargaBiaya, $data);
			return $this->db->insert_id();
		}
	
		public function updateHargaBiaya($id, $data)
		{
			$this->db->where('id_harga_biaya', $id);
			$this->db->update($this->tableHargaBiaya, $data);
			return $this->db->affected_rows();
		}
	
		public function deleteHargaBiaya($id)
		{
			$this->db->where('id_harga_biaya', $id);
			$this->db->delete($this->tableHargaBiaya);
			return $this->db->affected_rows();
		}
	
}

/* End of file: Masterdata_model.php */