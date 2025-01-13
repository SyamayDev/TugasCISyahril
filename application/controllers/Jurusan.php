<?php
class Jurusan extends CI_Controller
{

    public function __construct() {
        parent::__construct();
        $this->load->model('Masterdata_model', 'md'); 
    }

    public function index() {

        $data = [
            'menu' => 'backend/menu',
            'content' => 'backend/jurusanKonten', 
            'title' => 'Manajemen Jurusan'
        ];

        $this->load->view('template', $data);
    }

    public function save()
    {
        $data = [
            'id_tahun_pelajaran' => $this->input->post('id_tahun_pelajaran'),
            'nama_jurusan' => $this->input->post('nama_jurusan')
        ];
    
        $id = $this->input->post('jurusan_id');

        $this->db->where('id_tahun_pelajaran', $data['id_tahun_pelajaran']);
        $this->db->where('nama_jurusan', $data['nama_jurusan']);
        if ($id) {
            $this->db->where('id !=', $id);
        }
        $exists = $this->db->get('jurusan')->num_rows();
    
        if ($exists > 0) {
            echo json_encode(['status' => false, 'message' => 'Jurusan sudah ada di tahun ajaran ini.']);
        } else {
            if ($id) {
                $this->db->where('id', $id);
                $update = $this->db->update('jurusan', $data);
                echo json_encode(['status' => $update, 'message' => $update ? 'Data berhasil diperbarui.' : 'Data gagal diperbarui.']);
            } else {
                $insert = $this->db->insert('jurusan', $data);
                echo json_encode(['status' => $insert, 'message' => $insert ? 'Data berhasil ditambahkan.' : 'Data gagal ditambahkan.']);
            }
        }
    }
    

    public function get_by_id($id)
    {
        $data = $this->db->get_where('jurusan', ['id' => $id])->row_array();
        echo json_encode(['status' => true, 'data' => $data]);
    }

    public function table_jurusan()
    {
        $this->db->select('jurusan.*, data_tahun_pelajaran.nama_tahun_pelajaran');
        $this->db->join('data_tahun_pelajaran', 'jurusan.id_tahun_pelajaran = data_tahun_pelajaran.id');
        $data = $this->db->get('jurusan')->result();
        echo json_encode(['status' => true, 'data' => $data]);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $delete = $this->db->delete('jurusan');
        echo json_encode(['status' => $delete, 'message' => $delete ? 'Data berhasil dihapus.' : 'Data gagal dihapus.']);
    }
}
