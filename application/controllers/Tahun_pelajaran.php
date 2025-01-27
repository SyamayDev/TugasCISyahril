
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tahun_pelajaran extends CI_Controller
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
			'content' => 'backend/tahunPelajaranKonten',
			'title' => 'Admin'
		);
		$this->load->view('template', $data);
	}

	public function table_tahun_pelajaran()
	{
		// Panggil data dari model
		$result = $this->md->dataTablesTahunPelajaran();
	
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
	


	public function save_tahun_pelajaran()
	{
		$this->load->library('form_validation');
	
		$this->form_validation->set_rules('nama_tahun_pelajaran', 'Nama Tahun Pelajaran', 'required|trim|max_length[100]', [
			'required' => 'Nama Tahun Pelajaran wajib diisi.',
			'max_length' => 'Nama Tahun Pelajaran tidak boleh lebih dari 100 karakter.'
		]);
		$this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'required|trim', [
			'required' => 'Tanggal Mulai wajib diisi.'
		]);
		$this->form_validation->set_rules('tanggal_akhir', 'Tanggal Akhir', 'required|trim|callback_check_date_range', [
			'required' => 'Tanggal Akhir wajib diisi.',
			'check_date_range' => 'Tanggal Akhir harus lebih besar dari Tanggal Mulai.'
		]);
		$this->form_validation->set_rules('status_tahun_pelajaran', 'Status Tahun Pelajaran', 'required|trim', [
			'required' => 'Status Tahun Pelajaran wajib diisi.'
		]);
	
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => false,
				'error' => $this->form_validation->error_array()
			]);
		} else {
			$id = $this->input->post('id'); // Ambil ID jika ada (untuk edit)
			$data = [
				'nama_tahun_pelajaran' => $this->input->post('nama_tahun_pelajaran'),
				'tanggal_mulai' => $this->input->post('tanggal_mulai'),
				'tanggal_akhir' => $this->input->post('tanggal_akhir'),
				'status_tahun_pelajaran' => $this->input->post('status_tahun_pelajaran')
			];
	
			if ($id) {
				// Jika ID ada, lakukan update
				$update = $this->md->updateTahunPelajaran($id, $data);
				echo json_encode([
					'status' => $update,
					'message' => $update ? 'Data berhasil diperbarui' : 'Data gagal diperbarui'
				]);
			} else {
				// Jika ID tidak ada, lakukan insert
				$save = $this->md->saveTahunPelajaran($data);
				echo json_encode([
					'status' => $save,
					'message' => $save ? 'Data berhasil disimpan' : 'Data gagal disimpan'
				]);
			}
		}
	}
	
	
	public function valid_date($date)
	{
		$d = DateTime::createFromFormat('Y-m-d', $date);
		return $d && $d->format('Y-m-d') === $date;
	}
	
	
	public function check_date_range($tanggal_akhir)
	{
		$tanggal_mulai = $this->input->post('tanggal_mulai');
		if (strtotime($tanggal_akhir) > strtotime($tanggal_mulai)) {
			return true;
		}
		return false;
	}	

	public function edit_tahun_pelajaran($id)
	{

		
		$q = $this->md->getTahunPelajaranByID($id);
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

	public function delete_tahun_pelajaran($id)
	{
		
		$data['deleted_at'] = time();
		$q = $this->md->updateTahunPelajaran($id, $data);
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