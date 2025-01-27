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

	public function getOptionJenisBiaya()
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


	public function table_jenis_biaya()
	{
		// Panggil data dari model
		$result = $this->md->dataTablesJenisBiaya();
	
		if (!empty($result['data'])) {
			$ret = [
				'status' => true,
				'data' => $result['data'],
				'message' => '',
			];
		} else {
			$ret = [
				'status' => false,
				'data' => [],
				'message' => 'Data tidak tersedia',
			];
		}
	
		// Output data sebagai JSON
		echo json_encode($ret);
	}

	public function save_jenis_biaya()
	{
		$this->load->library('form_validation');
	
		$this->form_validation->set_rules('nama_jenis_biaya', 'Nama Jenis Biaya', 'required|trim|max_length[100]', [
			'required' => 'Nama Jenis Biaya wajib diisi.',
			'max_length' => 'Nama Jenis Biaya tidak boleh lebih dari 100 karakter.'
		]);
		$this->form_validation->set_rules('status_jenis_biaya', 'Status', 'required|in_list[1,0]', [
			'required' => 'Status wajib dipilih.',
			'in_list' => 'Status tidak valid.'
		]);
	
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => false,
				'error' => $this->form_validation->error_array()
			]);
		} else {
			$id = $this->input->post('id');
			$nama_jenis_biaya = trim($this->input->post('nama_jenis_biaya'));
			$status_jenis_biaya = trim($this->input->post('status_jenis_biaya'));
	
			$existing = $this->md->getJenisBiayaByName($nama_jenis_biaya);
			if ($existing && (!$id || $existing->id != $id)) {
				echo json_encode([
					'status' => false,
					'message' => 'Nama jenis biaya sudah ada di database'
				]);
				return;
			}
	
			$data = [
				'nama_jenis_biaya' => $nama_jenis_biaya,
				'status_jenis_biaya' => $status_jenis_biaya,
				'updated_at' => date('Y-m-d H:i:s'),
				'deleted_at' => 0
			];
	
			if ($id) {
				$q = $this->md->updateJenisBiaya($id, $data);
				$message = $q ? 'Data berhasil diupdate' : 'Data gagal diupdate';
			} else {
				$data['created_at'] = date('Y-m-d H:i:s');
				$q = $this->md->saveJenisBiaya($data);
				$message = $q ? 'Data berhasil disimpan' : 'Data gagal disimpan';
			}
	
			echo json_encode([
				'status' => $q,
				'message' => $message
			]);
		}
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
		// Panggil data dari model
		$result = $this->md->dataTablesHargaBiaya();
	
		if (!empty($result['data'])) {
			$ret = [
				'status' => true,
				'data' => $result['data'],
				'message' => '',
			];
		} else {
			$ret = [
				'status' => false,
				'data' => [],
				'message' => 'Data tidak tersedia',
			];
		}
	
		// Output data sebagai JSON
		echo json_encode($ret);
	}



	public function save_harga_biaya()
	{
		$this->load->library('form_validation');
	
		$this->form_validation->set_rules('jenis_biaya_id', 'Jenis Biaya', 'required|integer', [
			'required' => 'Jenis Biaya wajib dipilih.',
			'integer' => 'Jenis Biaya tidak valid.'
		]);
		$this->form_validation->set_rules('tahun_pelajaran_id', 'Tahun Pelajaran', 'required|integer', [
			'required' => 'Tahun Pelajaran wajib dipilih.',
			'integer' => 'Tahun Pelajaran tidak valid.'
		]);
		$this->form_validation->set_rules('harga_biaya', 'Harga Biaya', 'required|numeric', [
			'required' => 'Harga Biaya wajib diisi.',
			'numeric' => 'Harga Biaya harus berupa angka.'
		]);
	
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => false,
				'error' => $this->form_validation->error_array()
			]);
		} else {
			$id = $this->input->post('id');
			$id_jenis_biaya = $this->input->post('jenis_biaya_id');
			$id_tahun_pelajaran = $this->input->post('tahun_pelajaran_id');
			$harga = $this->input->post('harga_biaya');
	
			if ($id) {
				$existingData = $this->md->cekDuplicateHargaBiaya($id_jenis_biaya, $id_tahun_pelajaran, $id);
			} else {
				$existingData = $this->md->cekDuplicateHargaBiaya($id_jenis_biaya, $id_tahun_pelajaran);
			}
	
			if ($existingData) {
				echo json_encode([
					'status' => false,
					'message' => 'Data sudah ada'
				]);
				return;
			}
	
			$data = [
				'jenis_biaya_id' => $id_jenis_biaya,
				'tahun_pelajaran_id' => $id_tahun_pelajaran,
				'harga_biaya' => $harga,
				'updated_at' => date('Y-m-d H:i:s'),
				'deleted_at' => 0
			];
	
			if ($id) {
				$q = $this->md->updateHargaBiaya($id, $data);
				$message = $q ? 'Data berhasil diupdate' : 'Data gagal diupdate';
			} else {
				$data['created_at'] = date('Y-m-d H:i:s');
				$q = $this->md->saveHargaBiaya($data);
				$message = $q ? 'Data berhasil disimpan' : 'Data gagal disimpan';
			}
	
			echo json_encode([
				'status' => $q,
				'message' => $message
			]);
		}
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
