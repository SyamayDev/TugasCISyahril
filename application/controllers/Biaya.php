<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Biaya extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		
		if (!$this->session->userdata('is_login')) {
            redirect('login', 'refresh'); 
        }

		$this->load->model('User_model');
		$this->load->model('Masterdata_model', 'md');
	}

	public function index()
	{
		$data = array(
			'menu' => 'backend/menu',
			'content' => 'backend/biayaKonten',
			'title' => 'Admin'
		);
		$this->load->view('template', $data);
	}

	public function table_jenis_biaya()
	{
		$q = $this->md->getAllJenisBiaya();
		$dt = [];
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$dt[] = $row;
			}

			$ret['status'] = true;
			$ret['data'] = $dt;
			$ret['message'] = '';
		} else {
			$ret['status'] = false;
			$ret['data'] = [];
			$ret['message'] = 'Data tidak tersedia';
		}


		echo json_encode($ret);
	}

	public function save_jenis_biaya()
	{
		$id = $this->input->post('id');
		$nama_jenis_biaya = trim($this->input->post('nama_jenis_biaya'));
		$status_jenis_biaya = trim($this->input->post('status_jenis_biaya'));
	
		if (empty($nama_jenis_biaya)) {
			$ret['status'] = false;
			$ret['message'] = 'Nama jenis biaya dan status tidak boleh kosong';
			echo json_encode($ret);
			return;
		}
	
		$existing = $this->md->getJenisBiayaByName($nama_jenis_biaya);
		if ($existing && (!$id || $existing->id != $id)) {
			$ret['status'] = false;
			$ret['message'] = 'Nama jenis biaya sudah ada di database';
			echo json_encode($ret);
			return;
		}
	
		$data = array(
			'nama_jenis_biaya' => $nama_jenis_biaya,
			'status_jenis_biaya' => $status_jenis_biaya,
			'updated_at' => date('Y-m-d H:i:s'),
			'deleted_at' => 0
		);
	
		if ($id) {
			$q = $this->md->updateJenisBiaya($id, $data);
			if ($q) {
				$ret['status'] = true;
				$ret['message'] = 'Data berhasil diupdate';
			} else {
				$ret['status'] = false;
				$ret['message'] = 'Data gagal diupdate';
			}
		} else {
			$data['created_at'] = date('Y-m-d H:i:s');
			$q = $this->md->saveJenisBiaya($data);
	
			if ($q) {
				$ret['status'] = true;
				$ret['message'] = 'Data berhasil disimpan';
			} else {
				$ret['status'] = false;
				$ret['message'] = 'Data gagal disimpan';
			}
		}
	
		echo json_encode($ret);
	}
	
	public function edit_jenis_biaya($id)
	{
		// $id = $this->input->post('id');
		$q = $this->md->getJenisBiayaByID($id);
		if ($q->num_rows() > 0) {
			$ret['status'] = true;
			$ret['data'] = $q->row();
			$ret['message'] = '';
		} else {
			$ret['status'] = false;
			$ret['data'] = [];
			$ret['message'] = 'Data tidak tersedia';
		}
		echo json_encode($ret);
	}
	


	public function delete_jenis_biaya($id)
	{
		// $id = $this->input->post('id');
		$q = $this->md->deleteJenisBiaya($id);
		if ($q) {
			$ret['status'] = true;
			$ret['message'] = 'Data berhasil dihapus';
		} else {
			$ret['status'] = false;
			$ret['message'] = 'Data gagal dihapus';
		}
		echo json_encode($ret);
	}

	public function table_harga_biaya()
	{
		$q = $this->md->getAllHargaBiaya();
		$dt = [];
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$dt[] = $row;
			}

			$ret['status'] = true;
			$ret['data'] = $dt;
			$ret['message'] = '';
		} else {
			$ret['status'] = false;
			$ret['data'] = 	$this->db->last_query();
			$ret['message'] = 'Data tidak tersedia';
		}
		echo json_encode($ret);
	}


	public function save_harga_biaya()
	{
		$id = $this->input->post('id');
		$id_jenis_biaya = $this->input->post('jenis_biaya_id');
		$id_tahun_pelajaran = $this->input->post('tahun_pelajaran_id');
		$harga = $this->input->post('harga_biaya');
	
		if (empty($id_jenis_biaya) || empty($id_tahun_pelajaran) || empty($harga)) {
			$ret['status'] = false;
			$ret['message'] = 'Semua data harus diisi';
			echo json_encode($ret);
			return;
		}
	
		if ($id) {
			$existingData = $this->md->cekDuplicateHargaBiaya($id_jenis_biaya, $id_tahun_pelajaran, $id);
		} else {
			$existingData = $this->md->cekDuplicateHargaBiaya($id_jenis_biaya, $id_tahun_pelajaran);
		}
	
		if ($existingData) {
			$ret['status'] = false;
			$ret['message'] = 'Data sudah ada';
			echo json_encode($ret);
			return;
		}
	
		$data = array(
			'jenis_biaya_id' => $id_jenis_biaya,
			'tahun_pelajaran_id' => $id_tahun_pelajaran,
			'harga_biaya' => $harga,
			'updated_at' => date('Y-m-d H:i:s'),
			'deleted_at' => 0
		);
	
		if ($id) {
			$q = $this->md->updateHargaBiaya($id, $data);
			if ($q) {
				$ret['status'] = true;
				$ret['message'] = 'Data berhasil diupdate';
			} else {
				$ret['status'] = false;
				$ret['message'] = 'Data gagal diupdate';
			}
		} else {
			$data['created_at'] = date('Y-m-d H:i:s');
			$q = $this->md->saveHargaBiaya($data);
	
			if ($q) {
				$ret['status'] = true;
				$ret['message'] = 'Data berhasil disimpan';
			} else {
				$ret['status'] = false;
				$ret['message'] = 'Data gagal disimpan';
			}
		}
	
		echo json_encode($ret);
	}
	

	public function edit_harga_biaya($id)
	{
		// $id = $this->input->post('id');
		$q = $this->md->getHargaBiayaByID($id);
		if ($q->num_rows() > 0) {
			$ret['status'] = true;
			$ret['data'] = $q->row();
			$ret['message'] = '';
		} else {
			$ret['status'] = false;
			$ret['data'] = [];
			$ret['message'] = 'Data tidak tersedia';
		}
		echo json_encode($ret);
	}
	
	
	public function delete_harga_biaya($id)
	{
		// $id = $this->input->post('id');
		$data['deleted_at'] = time();
		$q = $this->md->updateHargaBiaya($id, $data);
		if ($q) {
			$ret['status'] = true;
			$ret['message'] = 'Data berhasil dihapus';
		} else {
			$ret['status'] = false;
			$ret['message'] = 'Data gagal dihapus';
		}
		echo json_encode($ret);
	}

	public function getOption_jenis_biaya()
	{
		$q = $this->md->getJenisBiayaAktif();
		$opt = '<option value="">-- Pilih Jenis Biaya --</option>';
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$opt .= '<option value="' . $row->id . '">' . $row->nama_jenis_biaya . '</option>';
			}
		}
		echo $opt;
	}

	public function getOption_tahun_pelajaran()
	{
		$q = $this->md->getAllTahunPelajaranNotDeleted();
		$opt = '<option value="">-- Pilih Tahun Pelajaran --</option>';
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$opt .= '<option value="' . $row->id . '">' . $row->nama_tahun_pelajaran . '</option>';
			}
		}
		echo $opt;
	}
}
