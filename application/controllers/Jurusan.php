<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jurusan extends CI_Controller
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
			'content' => 'backend/jurusanKonten',
			'title' => 'Admin'
		);
		$this->load->view('template', $data);
	}

	public function table_jurusan()
	{
		$q = $this->md->getAllJurusanNotDeleted();
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

	public function save_jurusan()
	{
		$this->load->library('form_validation');
	
		// Aturan Validasi
		$this->form_validation->set_rules('id_tahun_pelajaran', 'Tahun Pelajaran', 'required', [
			'required' => 'Tahun Pelajaran wajib dipilih.'
		]);
		$this->form_validation->set_rules('nama_jurusan', 'Nama Jurusan', 'required|trim|max_length[100]', [
			'required' => 'Nama Jurusan wajib diisi.',
			'max_length' => 'Nama Jurusan tidak boleh lebih dari 100 karakter.'
		]);
	
		if ($this->form_validation->run() == FALSE) {
			// Jika validasi gagal
			echo json_encode([
				'status' => false,
				'error' => $this->form_validation->error_array()
			]);
		} else {
			// Data valid
			$id = $this->input->post('id');
			$id_tahun_pelajaran = $this->input->post('id_tahun_pelajaran');
			$data['nama_jurusan'] = $this->input->post('nama_jurusan');
			$data['id_tahun_pelajaran'] = $id_tahun_pelajaran;
			$data['created_at'] = date('Y-m-d H:i:s');
			$data['updated_at'] = date('Y-m-d H:i:s');
			$data['deleted_at'] = 0;
	
			// Cek Duplikasi
			$cek = $this->md->cekJurusanDuplicate($data['nama_jurusan'], $id_tahun_pelajaran, $id);
			if ($cek->num_rows() > 0) {
				echo json_encode([
					'status' => false,
					'message' => 'Jurusan sudah ada'
				]);
			} else {
				// Simpan atau Update Data
				if ($id) {
					$q = $this->md->updateJurusan($id, $data);
					$message = $q ? 'Data berhasil diupdate' : 'Data gagal diupdate';
				} else {
					$q = $this->md->saveJurusan($data);
					$message = $q ? 'Data berhasil disimpan' : 'Data gagal disimpan';
				}
	
				echo json_encode([
					'status' => $q,
					'message' => $message
				]);
			}
		}
	}
	

	public function delete_jurusan($id)
	{
		// $id = $this->input->post('id');
		$data['deleted_at'] = time();
		$q = $this->md->updateJurusan($id, $data);
		if ($q) {
			$ret['status'] = true;
			$ret['message'] = 'Data berhasil dihapus';
		} else {
			$ret['status'] = false;
			$ret['message'] = 'Data gagal dihapus';
		}
		echo json_encode($ret);
	}
	public function edit_jurusan($id)
	{
		// $id = $this->input->post('id');
		$q = $this->md->getJurusanByID($id);
		if ($q->num_rows() > 0) {
			$ret = array(
				'status' => true,
				'data' => $q->row(),
				'message' => ''
			);
		} else {
			$ret = array(
				'status' => false,
				'data' => [],
				'message' => 'Data tidak ditemukan',
				'query' => $this->db->last_query()
			);
		}

		echo json_encode($ret);
	}
}

