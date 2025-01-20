<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seragam extends CI_Controller
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
			'content' => 'backend/seragamKonten',
			'title' => 'Admin'
		);
		$this->load->view('template', $data);
	}

	public function table_jenis_seragam()
	{
		$q = $this->md->getAllJenisSeragam();
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


	public function save_jenis_seragam()
	{
		$this->load->library('form_validation');
	
		$this->form_validation->set_rules('nama_jenis_seragam', 'Nama Jenis Seragam', 'required|trim', [
			'required' => 'Nama Jenis Seragam tidak boleh kosong.'
		]);
	
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => false,
				'error' => $this->form_validation->error_array()
			]);
		} else {
			$id = $this->input->post('id');
			$nama_jenis_seragam = $this->input->post('nama_jenis_seragam');
	
			$isDuplicate = $this->md->CekDuplicateJenisSeragam($nama_jenis_seragam, $id);
			if ($isDuplicate) {
				echo json_encode([
					'status' => false,
					'message' => 'Nama Jenis Seragam sudah ada.'
				]);
				return;
			}
	
			$data = [
				'nama_jenis_seragam' => $nama_jenis_seragam,
				'updated_at' => date('Y-m-d H:i:s'),
				'deleted_at' => 0
			];
	
			if ($id) {
				$q = $this->md->updateJenisSeragam($id, $data);
				$message = $q ? 'Data berhasil diupdate' : 'Data gagal diupdate';
			} else {
				$data['created_at'] = date('Y-m-d H:i:s');
				$q = $this->md->saveJenisSeragam($data);
				$message = $q ? 'Data berhasil disimpan' : 'Data gagal disimpan';
			}
	
			echo json_encode([
				'status' => $q,
				'message' => $message
			]);
		}
	}
	

	
	public function edit_jenis_seragam($id)
	{
		// $id = $this->input->post('id');
		$q = $this->md->getJenisSeragamByID($id);
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



	public function delete_jenis_seragam($id)
	{
		// $id = $this->input->post('id');
		$q = $this->md->deleteJenisSeragam($id);
		if ($q) {
			$ret['status'] = true;
			$ret['message'] = 'Data berhasil dihapus';
		} else {
			$ret['status'] = false;
			$ret['message'] = 'Data gagal dihapus';
		}
		echo json_encode($ret);
	}

	public function table_stok_seragam()
	{
		$q = $this->md->getAllStokSeragam();
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


	public function save_stok_seragam()
	{
		$this->load->library('form_validation');
	
		// Aturan validasi
		$this->form_validation->set_rules('jenis_seragam_id', 'Jenis Seragam', 'required|numeric', [
			'required' => 'Jenis Seragam tidak boleh kosong.',
			'numeric' => 'Jenis Seragam tidak valid.'
		]);
		$this->form_validation->set_rules('ukuran_seragam', 'Ukuran Seragam', 'required', [
			'required' => 'Ukuran Seragam tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('stok_seragam', 'Stok Seragam', 'required|integer', [
			'required' => 'Stok Seragam tidak boleh kosong.',
			'integer' => 'Stok Seragam harus berupa angka.'
		]);
	
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => false,
				'error' => $this->form_validation->error_array()
			]);
			return;
		}
	
		$id = $this->input->post('id');
		$id_jenis_seragam = $this->input->post('jenis_seragam_id');
		$ukuran_seragam = $this->input->post('ukuran_seragam');
		$stok_seragam = $this->input->post('stok_seragam');
	
		// Cek duplikasi
		$existing = $this->md->getStokSeragamByUnique($id_jenis_seragam, $ukuran_seragam);
		if ($existing && (!$id || $existing->id != $id)) {
			echo json_encode([
				'status' => false,
				'message' => 'Data stok seragam dengan jenis dan ukuran yang sama sudah ada.'
			]);
			return;
		}
	
		$data = [
			'jenis_seragam_id' => $id_jenis_seragam,
			'ukuran_seragam' => $ukuran_seragam,
			'stok_seragam' => $stok_seragam,
			'updated_at' => date('Y-m-d H:i:s'),
			'deleted_at' => 0
		];
	
		if ($id) {
			$q = $this->md->updateStokSeragam($id, $data);
			$message = $q ? 'Data berhasil diupdate' : 'Data gagal diupdate';
		} else {
			$data['created_at'] = date('Y-m-d H:i:s');
			$q = $this->md->saveStokSeragam($data);
			$message = $q ? 'Data berhasil disimpan' : 'Data gagal disimpan';
		}
	
		echo json_encode([
			'status' => $q,
			'message' => $message
		]);
	}
	
	
	public function edit_stok_seragam($id)
	{
		//$id = $this->input->post('id');
		$q = $this->md->getStokSeragamByID($id);
		if ($q->num_rows() > 0) {
			$ret['status'] = true;
			$ret['data'] = $q->row();
			$ret['message'] = '';
		} else {
			$ret['status'] = false;
			$ret['query'] = 	$this->db->last_query();
			$ret['message'] = 'Data tidak tersedia';

		}
		echo json_encode($ret);
	}
	
	public function delete_stok_seragam($id)
	{
		// $id = $this->input->post('id');
		$data['deleted_at'] = time();
		$q = $this->md->updateStokSeragam($id, $data);
		if ($q) {
			$ret['status'] = true;
			$ret['message'] = 'Data berhasil dihapus';
		} else {
			$ret['status'] = false;
			$ret['message'] = 'Data gagal dihapus';
		}
		echo json_encode($ret);
	}

	public function getOption_jenis_seragam()
	{
		$q = $this->md->getAllJenisSeragam();
		$opt = '<option value="">-- Pilih Jenis Biaya --</option>';
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$opt .= '<option value="' . $row->id . '">' . $row->nama_jenis_seragam . '</option>';
			}
		}
		echo $opt;
	}

}