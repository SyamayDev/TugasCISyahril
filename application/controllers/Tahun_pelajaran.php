<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tahun_pelajaran extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Masterdata_model', 'md');
    }

    public function index() {
        $data = [
            'menu' => 'backend/menu',
            'content' => 'backend/tahunPelajaranKonten',
            'title' => 'Admin'
        ];
        $this->load->view('template', $data);
    }

    public function table_tahun_pelajaran() {
        $q = $this->md->getAllTahunPelajaran();
        if ($q->num_rows() > 0) {
            echo json_encode(['status' => true, 'data' => $q->result()]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Data tidak tersedia']);
        }
    }
	public function save() {
		$data = [
			'nama_tahun_pelajaran' => $this->input->post('nama_tahun_pelajaran'),
			'tanggal_mulai' => $this->input->post('tanggal_mulai'),
			'tanggal_akhir' => $this->input->post('tanggal_akhir'),
			'status_tahun_pelajaran' => $this->input->post('status_tahun_pelajaran')
		];
	
		$id = $this->input->post('id');
		if ($id) {
			$this->db->where('id', $id);
			$update = $this->db->update('data_tahun_pelajaran', $data);
			echo json_encode(['status' => $update, 'message' => $update ? 'Data berhasil diperbarui.' : 'Data gagal diperbarui.']);
		} else {
			$exists = $this->db->get_where('data_tahun_pelajaran', ['nama_tahun_pelajaran' => $data['nama_tahun_pelajaran']])->num_rows();
			if ($exists > 0) {
				echo json_encode(['status' => false, 'message' => 'Data sudah ada.']);
			} else {
				$insert = $this->db->insert('data_tahun_pelajaran', $data);
				echo json_encode(['status' => $insert, 'message' => $insert ? 'Data berhasil ditambahkan.' : 'Data gagal ditambahkan.']);
			}
		}
	}
	
	

    public function get_by_id($id) {
        $data = $this->db->get_where('data_tahun_pelajaran', ['id' => $id])->row_array();
        echo json_encode(['status' => true, 'data' => $data]);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        $delete = $this->db->delete('data_tahun_pelajaran');
        echo json_encode(['status' => $delete, 'message' => $delete ? 'Data berhasil dihapus.' : 'Data gagal dihapus.']);
    }
}
