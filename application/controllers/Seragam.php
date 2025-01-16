<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seragam extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
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
		$id = $this->input->post('id');
		$nama_jenis_seragam = $this->input->post('nama_jenis_seragam');

		$data = array(
			'nama_jenis_seragam' => $nama_jenis_seragam,

			'updated_at' => date('Y-m-d H:i:s'),
			'deleted_at' => 0
		);

		if ($id) {
			$q = $this->md->updateJenisSeragam($id, $data);
			if ($q) {
				$ret['status'] = true;
				$ret['message'] = 'Data berhasil diupdate';
			} else {
				$ret['status'] = false;
				$ret['message'] = 'Data gagal diupdate';
			}
		} else {
			$data['created_at'] = date('Y-m-d H:i:s');
			$q = $this->md->saveJenisSeragam($data);

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


	public function edit_jenis_seragam()
	{
		$id = $this->input->post('id');
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


	public function delete_jenis_seragam()
	{
		$id = $this->input->post('id');
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
		$id = $this->input->post('id');
		$id_jenis_seragam = $this->input->post('jenis_seragam_id');
		$ukuran_seragam = $this->input->post('ukuran_seragam');
        $stok_seragam = $this->input->post('stok_seragam');

		$data = array(
			'jenis_biaya_id' => $id_jenis_seragam,
			'ukuran_seragam' => $ukuran_seragam,
            'stok_seragam' => $stok_seragam,

			'updated_at' => date('Y-m-d H:i:s'),
			'deleted_at' => 0
		);

		if ($id) {
			$q = $this->md->updateStokSeragam($id, $data);
			if ($q) {
				$ret['status'] = true;
				$ret['message'] = 'Data berhasil diupdate';
			} else {
				$ret['status'] = false;
				$ret['message'] = 'Data gagal diupdate';
			}
		} else {
			$data['created_at'] = date('Y-m-d H:i:s');
			$q = $this->md->saveStokSeragam($data);

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

	public function edit_stok_seragam()
	{
		$id = $this->input->post('id');
		$q = $this->md->getStokSeragamByID($id);
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
	public function delete_stok_seragam()
	{
		$id = $this->input->post('id');
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
	public function getOptionJenisSeragam()
	{
		$q = $this->md->getJenisSeragam();
		$opt = '<option value="">-- Pilih Jenis Biaya --</option>';
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$opt .= '<option value="' . $row->id . '">' . $row->nama_jenis_seragam . '</option>';
			}
		}
		echo $opt;
	}

}

/* End of file: Biaya.php */