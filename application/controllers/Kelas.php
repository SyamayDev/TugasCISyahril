<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Masterdata_model', 'md');
    }

    public function index()
    {
        $data = [
            'menu' => 'backend/menu',
            'content' => 'backend/kelasKonten',
            'title' => 'Manajemen Kelas',
            'tahun_pelajaran' => $this->md->getAllTahunPelajaran()->result(),
            'jurusan' => $this->md->getAllJurusan()->result(),
        ];
        $this->load->view('template', $data);
    }

    public function table_kelas()
    {
        $result = $this->md->getAllKelas()->result();
        echo json_encode(['status' => true, 'data' => $result]);
    }

    public function save()
    {
        $data = [
            'id_tahun_pelajaran' => $this->input->post('id_tahun_pelajaran'),
            'id_jurusan' => $this->input->post('id_jurusan'),
            'nama_kelas' => $this->input->post('nama_kelas')
        ];

        $id = $this->input->post('kelas_id');
        if ($id) {
            $result = $this->md->updateKelas($id, $data);
        } else {
            $result = $this->md->insertKelas($data);
        }

        if ($result) {
            echo json_encode(['status' => true, 'message' => 'Data berhasil disimpan']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Gagal menyimpan data']);
        }
    }

    public function get_by_id($id)
    {
        $result = $this->md->getKelasById($id);
        if ($result) {
            echo json_encode(['status' => true, 'data' => $result]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Data tidak ditemukan']);
        }
    }

    public function delete($id)
    {
        $result = $this->md->deleteKelas($id);
        if ($result) {
            echo json_encode(['status' => true, 'message' => 'Data berhasil dihapus']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Gagal menghapus data']);
        }
    }
}
