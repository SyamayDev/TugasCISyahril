<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
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
			'content' => 'backend/kelasKonten',
			'title' => 'Admin'
		);
		$this->load->view('template', $data);
	}


	public function getOption_tahun_pelajaran()
	{
		$q = $this->md->getAllTahunPelajaranNotDeleted();
		$opt = '<option value="">Pilih Tahun Pelajaran</option>';
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$opt .= '<option value="' . $row->id . '">' . $row->nama_tahun_pelajaran . '</option>';
			}
		}
		echo $opt;
	}

	public function getOption_jurusan()
	{
		$id = $this->input->post('id');
	
		// Log ID yang diterima untuk debugging
		log_message('info', 'ID yang diterima: ' . $id);
	
		// Ambil data jurusan berdasarkan ID tahun pelajaran
		$q = $this->md->getJurusanByTahunPelajaranID($id);
		$ret = '<option value="">Pilih Jurusan</option>';
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$ret .= '<option value="' . $row->id . '">' . $row->nama_jurusan . '</option>';
			}
		}
	
		echo $ret;
	}	
	
	public function table_kelas()
	{
		// Panggil data dari model
		$result = $this->md->dataTablesKelas();
	
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

	public function save_kelas()
	{
		$this->load->library('form_validation');
	
		$this->form_validation->set_rules('tahun_pelajaran', 'Nama Tahun Pelajaran', 'required', [
			'required' => 'Nama Tahun Pelajaran wajib dipilih.'
		]);

		$this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required|trim|max_length[100]', [
			'required' => 'Nama Kelas wajib diisi.',
			'max_length' => 'Nama Kelas tidak boleh lebih dari 100 karakter.'
		]);
	
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => false,
				'error' => $this->form_validation->error_array()
			]);
		} else {
			$id = $this->input->post('id');
			$data['nama_kelas'] = $this->input->post('nama_kelas');
			$data['id_jurusan'] = $this->input->post('id_jurusan');
			$data['created_at'] = date('Y-m-d H:i:s');
			$data['updated_at'] = date('Y-m-d H:i:s');
			$data['deleted_at'] = 0;
	
			$cek = $this->md->cekKelasDuplicate($data['nama_kelas'], $data['id_jurusan'], $id);
			if ($cek->num_rows() > 0) {
				echo json_encode([
					'status' => false,
					'message' => 'Kelas sudah ada'
				]);
			} else {
				if ($id) {
					$this->md->updateKelas($id, $data);
					echo json_encode([
						'status' => true,
						'message' => 'Data berhasil diupdate'
					]);
				} else {
					$this->md->saveKelas($data);
					echo json_encode([
						'status' => true,
						'message' => 'Data berhasil disimpan'
					]);
				}
			}
		}
	}
	

	public function edit_kelas($id)
	{
		// $id = $this->input->post('id');
		$q = $this->md->getKelasByID($id);
		if ($q->num_rows() > 0) {
			$ret['status'] = true;
			$ret['data'] = $q->row();
			$ret['message'] = '';
			$ret['query'] = $this->db->last_query();
		} else {
			$ret['status'] = false;
			$ret['data'] = [];
			$ret['message'] = 'Data tidak tersedia';
		}
		echo json_encode($ret);
	}

	public function delete_kelas($id)
	{
		// $id = $this->input->post('id');
		$data['deleted_at'] = time();
		$q = $this->md->updateKelas($id, $data);
		if ($q) {
			$ret['status'] = true;
			$ret['message'] = 'Data berhasil dihapus';
		} else {
			$ret['status'] = false;
			$ret['message'] = 'Data gagal dihapus';
		}
		echo json_encode($ret);
	}
}

