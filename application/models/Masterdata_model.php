<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Masterdata_model extends MY_Model
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
	public function dataTablesTahunPelajaran()
	{
		$col_order = array(
			$this->tableTahunPelajaran . '.id',
			$this->tableTahunPelajaran . '.nama_tahun_pelajaran'
		);
		$col_search = array(
			$this->tableTahunPelajaran . '.id',
			$this->tableTahunPelajaran . '.nama_tahun_pelajaran',
			$this->tableTahunPelajaran . '.status_tahun_pelajaran'
		);
		$order = array($this->tableTahunPelajaran . '.id' => 'desc');
		$filter = array($this->tableTahunPelajaran . '.deleted_at' => 0);
		$group_by = null;
	
		$this->db->from($this->tableTahunPelajaran);
		$this->db->select($this->tableTahunPelajaran . '.*');
		$query = substr($this->db->get_compiled_select(), 6);
	
		$data = $this->get_datatables($query, $col_order, $col_search, $order, $filter, $group_by);
		$recordTotal = $this->countAllQueryFiltered($query, $filter);
		$recordFiltered = $this->count_filtered($query, $filter);
	
		// Format response sebagai JSON
		$result = array(
			"draw" => $_POST['draw'] ?? 1,
			"recordsTotal" => $recordTotal,
			"recordsFiltered" => $recordFiltered,
			"data" => $data
		);
	
		return $result; // Kembalikan sebagai array, bukan query object
	}
		
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
	public function dataTablesJurusan()
	{
		$col_order = array(
			$this->tableJurusan . '.id',
			$this->tableTahunPelajaran . '.nama_tahun_pelajaran',
			$this->tableJurusan . '.nama_jurusan'
		);
		$col_search = array(
			$this->tableJurusan . '.id',
			$this->tableTahunPelajaran . '.nama_tahun_pelajaran',
			$this->tableJurusan . '.nama_jurusan',
		);
		$order = array($this->tableJurusan . '.id' => 'desc');
		$filter = array($this->tableJurusan . '.deleted_at' => 0);
		$group_by = null;
	
		// Mulai query untuk Datatables
		$this->db->from($this->tableJurusan);
		$this->db->join(
			$this->tableTahunPelajaran,
			$this->tableTahunPelajaran . '.id = ' . $this->tableJurusan . '.id_tahun_pelajaran',
			'left'
		);
		$this->db->select(
			$this->tableJurusan . '.*, ' . $this->tableTahunPelajaran . '.nama_tahun_pelajaran'
		);
	
		// Buat query untuk datatables
		$query = substr($this->db->get_compiled_select(), 6);
	
		// Dapatkan data dari method get_datatables
		$data = $this->get_datatables($query, $col_order, $col_search, $order, $filter, $group_by);
		$recordTotal = $this->countAllQueryFiltered($query, $filter);
		$recordFiltered = $this->count_filtered($query, $filter);
	
		// Format response sebagai JSON
		$result = array(
			"draw" => $_POST['draw'] ?? 1,
			"recordsTotal" => $recordTotal,
			"recordsFiltered" => $recordFiltered,
			"data" => $data
		);
	
		return $result; // Kembalikan sebagai array, bukan query object
	}
	
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
	public function dataTablesKelas()
	{
		$col_order = array(
			$this->tableKelas . '.id',
			$this->tableTahunPelajaran . '.nama_tahun_pelajaran',
			$this->tableJurusan . '.nama_jurusan',
			$this->tableKelas . '.nama_kelas'
		);
		$col_search = array(
			$this->tableKelas . '.id',
			$this->tableTahunPelajaran . '.nama_tahun_pelajaran',
			$this->tableJurusan . '.nama_jurusan',
			$this->tableKelas . '.nama_kelas',
		);
		$order = array($this->tableKelas . '.id' => 'desc');
		$filter = array($this->tableKelas . '.deleted_at' => 0);
		$group_by = null;
	
		// Mulai query untuk Datatables
		$this->db->from($this->tableKelas);
		$this->db->join(
			$this->tableJurusan,
			$this->tableJurusan . '.id = ' . $this->tableKelas . '.id_jurusan',
			'left'
		);
		$this->db->join(
			$this->tableTahunPelajaran,
			$this->tableTahunPelajaran . '.id = ' . $this->tableJurusan . '.id_tahun_pelajaran',
			'left'
		);
		$this->db->select(
			$this->tableKelas . '.*, ' .
			$this->tableTahunPelajaran . '.nama_tahun_pelajaran, ' .
			$this->tableJurusan . '.nama_jurusan'
		);
	
		// Buat query untuk datatables
		$query = substr($this->db->get_compiled_select(), 6);
	
		// Dapatkan data dari method get_datatables
		$data = $this->get_datatables($query, $col_order, $col_search, $order, $filter, $group_by);
		$recordTotal = $this->countAllQueryFiltered($query, $filter);
		$recordFiltered = $this->count_filtered($query, $filter);
	
		// Format response sebagai JSON
		$result = array(
			"draw" => $_POST['draw'] ?? 1,
			"recordsTotal" => $recordTotal,
			"recordsFiltered" => $recordFiltered,
			"data" => $data
		);
	
		return $result; // Kembalikan sebagai array, bukan query object
	}
	
	
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

	// CRUD for Jenis Biaya
	public function dataTablesJenisBiaya()
	{
		$col_order = array(
			$this->tableJenisBiaya . '.id',
			$this->tableJenisBiaya . '.nama_jenis_biaya',
		);
		$col_search = array(
			$this->tableJenisBiaya . '.id',
			$this->tableJenisBiaya . '.nama_jenis_biaya',
			$this->tableJenisBiaya . '.status_jenis_biaya',
		);
		$order = array($this->tableJenisBiaya . '.id' => 'desc');
		$filter = array($this->tableJenisBiaya . '.deleted_at' => 0);
		$group_by = null;
	
		$this->db->from($this->tableJenisBiaya);
		$this->db->select($this->tableJenisBiaya . '.*');
		$query = substr($this->db->get_compiled_select(), 6);
	
		$data = $this->get_datatables($query, $col_order, $col_search, $order, $filter, $group_by);
		$recordTotal = $this->countAllQueryFiltered($query, $filter);
		$recordFiltered = $this->count_filtered($query, $filter);
	
		// Format response sebagai JSON
		$result = array(
			"draw" => $_POST['draw'] ?? 1,
			"recordsTotal" => $recordTotal,
			"recordsFiltered" => $recordFiltered,
			"data" => $data
		);
	
		return $result; // Kembalikan sebagai array, bukan query object
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

	// CRUD for Jenis Biaya
	public function getAllJenisBiaya()
	{
		return $this->db->get($this->tableJenisBiaya);
	}
	public function getJenisBiayaByID($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->tableJenisBiaya);
	}
	public function getJenisBiayaByName($nama)
	{
		return $this->db->get_where('jenis_biaya', ['nama_jenis_biaya' => $nama, 'deleted_at' => 0])->row();
	}


	public function getJenisBiayaAktif()
	{
		$this->db->where('deleted_at', 0);
		$this->db->where('status_jenis_biaya', 1);
		return $this->db->get($this->tableJenisBiaya);
	}


	// CRUD for Harga Biaya
	public function dataTablesHargaBiaya()
	{
		$col_order = array(
			$this->tableHargaBiaya . '.id',
			$this->tableTahunPelajaran . '.nama_tahun_pelajaran',
			$this->tableJenisBiaya . '.nama_jenis_biaya',
			$this->tableHargaBiaya . '.harga_biaya'
		);
		$col_search = array(
			$this->tableHargaBiaya . '.id',
			$this->tableTahunPelajaran . '.nama_tahun_pelajaran',
			$this->tableJenisBiaya . '.nama_jenis_biaya',
			$this->tableHargaBiaya . '.harga_biaya',
		);
		$order = array($this->tableHargaBiaya . '.id' => 'desc');
		$filter = array($this->tableHargaBiaya . '.deleted_at' => 0);
		$group_by = null;
	
		// Mulai query untuk Datatables
		$this->db->from($this->tableHargaBiaya);
		$this->db->join(
			$this->tableJenisBiaya,
			$this->tableJenisBiaya . '.id = ' . $this->tableHargaBiaya . '.jenis_biaya_id',
			'left'
		);
		$this->db->join(
			$this->tableTahunPelajaran,
			$this->tableTahunPelajaran . '.id = ' . $this->tableHargaBiaya . '.tahun_pelajaran_id',
			'left'
		);
		$this->db->select(
			$this->tableHargaBiaya . '.*, ' .
			$this->tableJenisBiaya . '.nama_jenis_biaya, ' .
			$this->tableTahunPelajaran . '.nama_tahun_pelajaran'
		);
	
		// Buat query untuk datatables
		$query = substr($this->db->get_compiled_select(), 6);
	
		// Dapatkan data dari method get_datatables
		$data = $this->get_datatables($query, $col_order, $col_search, $order, $filter, $group_by);
		$recordTotal = $this->countAllQueryFiltered($query, $filter);
		$recordFiltered = $this->count_filtered($query, $filter);
	
		// Format response sebagai JSON
		$result = array(
			"draw" => $_POST['draw'] ?? 1,
			"recordsTotal" => $recordTotal,
			"recordsFiltered" => $recordFiltered,
			"data" => $data
		);
	
		return $result; // Kembalikan sebagai array, bukan query object
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

	public function cekDuplicateHargaBiaya($id_jenis_biaya, $id_tahun_pelajaran, $id = null)
	{
		$this->db->where('jenis_biaya_id', $id_jenis_biaya);
		$this->db->where('tahun_pelajaran_id', $id_tahun_pelajaran);
		if ($id) {
			$this->db->where('id !=', $id); 
		}
		$query = $this->db->get('harga_biaya');
		return $query->num_rows() > 0;
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


	// CRUD for Jenis Seragam

	public function dataTablesJenisSeragam()
	{
		$col_order = array(
			$this->tableJenisSeragam . '.id',
			$this->tableJenisSeragam . '.nama_jenis_seragam',
		);
		$col_search = array(
			$this->tableJenisSeragam . '.id',
			$this->tableJenisSeragam . '.nama_jenis_seragam',
		);
		$order = array($this->tableJenisSeragam . '.id' => 'desc');
		$filter = array($this->tableJenisSeragam . '.deleted_at' => 0);
		$group_by = null;
	
		$this->db->from($this->tableJenisSeragam);
		$this->db->select($this->tableJenisSeragam . '.*');
		$query = substr($this->db->get_compiled_select(), 6);
	
		$data = $this->get_datatables($query, $col_order, $col_search, $order, $filter, $group_by);
		$recordTotal = $this->countAllQueryFiltered($query, $filter);
		$recordFiltered = $this->count_filtered($query, $filter);
	
		// Format response sebagai JSON
		$result = array(
			"draw" => $_POST['draw'] ?? 1,
			"recordsTotal" => $recordTotal,
			"recordsFiltered" => $recordFiltered,
			"data" => $data
		);
	
		return $result; // Kembalikan sebagai array, bukan query object
	}

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
		return $this->db->get_where('jenis_seragam', ['id' => $id, 'deleted_at' => 0]);
	}
	
	public function CekDuplicateJenisSeragam($nama_jenis_seragam, $id = null)
{
    $this->db->where('nama_jenis_seragam', $nama_jenis_seragam);
    $this->db->where('deleted_at', 0);
    if ($id) {
        $this->db->where('id !=', $id);
    }
    $query = $this->db->get('jenis_seragam');
    return $query->num_rows() > 0;
}


	// CRUD for Stok Seragam
		public function dataTablesStokSeragam()
		{
			$col_order = array(
				$this->tableStokSeragam . '.id',
				$this->tableJenisSeragam . '.nama_jenis_seragam',
				$this->tableStokSeragam . '.ukuran_seragam',
				$this->tableStokSeragam . '.stok_seragam'
			);
			$col_search = array(
				$this->tableStokSeragam . '.id',
				$this->tableJenisSeragam . '.nama_jenis_seragam',
				$this->tableStokSeragam . '.ukuran_seragam',
				$this->tableStokSeragam . '.stok_seragam'
			);
			$order = array($this->tableStokSeragam . '.id' => 'desc');
			$filter = array($this->tableStokSeragam . '.deleted_at' => 0);
			$group_by = null;
		
			// Mulai query untuk Datatables
			$this->db->from($this->tableStokSeragam);
			$this->db->join(
				$this->tableJenisSeragam,
				$this->tableJenisSeragam . '.id = ' . $this->tableStokSeragam . '.jenis_seragam_id',
				'left'
			);
			$this->db->select(
				$this->tableStokSeragam . '.*, ' . $this->tableJenisSeragam . '.nama_jenis_seragam'
			);
		
			// Buat query untuk datatables
			$query = substr($this->db->get_compiled_select(), 6);
		
			// Dapatkan data dari method get_datatables
			$data = $this->get_datatables($query, $col_order, $col_search, $order, $filter, $group_by);
			$recordTotal = $this->countAllQueryFiltered($query, $filter);
			$recordFiltered = $this->count_filtered($query, $filter);
		
			// Format response sebagai JSON
			$result = array(
				"draw" => $_POST['draw'] ?? 1,
				"recordsTotal" => $recordTotal,
				"recordsFiltered" => $recordFiltered,
				"data" => $data
			);
		
			return $result; // Kembalikan sebagai array, bukan query object
		}

	public function getAllStokSeragam()
	{
		$this->db->select('stok_seragam.*, jenis_seragam.nama_jenis_seragam, jenis_seragam_harga.nama_jenis_seragam AS nama_harga');
		$this->db->join('jenis_seragam', 'stok_seragam.jenis_seragam_id = jenis_seragam.id', 'left');
		$this->db->join('jenis_seragam AS jenis_seragam_harga', 'jenis_seragam_harga.id = stok_seragam.jenis_seragam_id', 'left');
		$this->db->where('stok_seragam.deleted_at', 0);
		return $this->db->get('stok_seragam');
	}
	
	public function getStokSeragamByID($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->tableStokSeragam);
	}

	public function getStokSeragamByUnique($jenis_seragam_id, $ukuran_seragam)
	{
		return $this->db->get_where('stok_seragam', [
			'jenis_seragam_id' => $jenis_seragam_id,
			'ukuran_seragam' => $ukuran_seragam,
			'deleted_at' => 0
		])->row();
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






