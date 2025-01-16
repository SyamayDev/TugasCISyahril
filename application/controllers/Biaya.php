<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Biaya extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Masterdata_model', 'model');
    }

    public function index() {
        $data = array(
            'menu' => 'backend/menu',
            'content' => 'backend/biayaKonten',
            'title' => 'Admin',
        );
        $this->load->view('template', $data);
    }

    public function tableJenisBiaya() {
        $data = $this->model->getAllJenisBiayaNotDeleted()->result();
        $data = $this->model->getAllJenisBiayaNotDeleted()->result();
        log_message('debug', json_encode($data)); 
        echo json_encode(['status' => true, 'data' => $data]);
        
    }
    

    public function saveJenisBiaya() {
        $id = $this->input->post('idJenisBiaya'); 
        $nama_jenis_biaya = $this->input->post('namaJenisBiaya');
        $status_aktif = $this->input->post('statusJenisBiaya');
        

        $cek = $this->model->cekJenisBiayaDuplicate($nama_jenis_biaya, $id)->row();
        if ($cek) {
            echo json_encode(['status' => false, 'message' => 'Jenis biaya dengan nama yang sama sudah ada!']);
            return;
        }

        $data = [
            'nama_jenis_biaya' => $nama_jenis_biaya,
            'status_aktif' => $status_aktif,
        ];
    

        if (!empty($id)) { 
            $update = $this->model->updateJenisBiaya($id, $data);
            if ($update) {
                $message = 'Jenis biaya berhasil diperbarui';
            } else {
                echo json_encode(['status' => false, 'message' => 'Gagal memperbarui jenis biaya.']);
                return;
            }
        } else { 
            $insert = $this->model->saveJenisBiaya($data);
            if ($insert) {
                $message = 'Jenis biaya berhasil disimpan';
            } else {
                echo json_encode(['status' => false, 'message' => 'Gagal menyimpan jenis biaya.']);
                return;
            }
        }
    
        echo json_encode(['status' => true, 'message' => $message]);
    }
    
    
    public function editJenisBiaya() {
        $id = $this->input->post('id');
        $data = $this->model->getJenisBiayaByID($id)->row();

        if ($data) {
            echo json_encode(['status' => true, 'data' => $data]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Data tidak ditemukan!']);
        }
    }

    public function deleteJenisBiaya() {
        $id = $this->input->post('id');
        $this->model->deleteJenisBiaya($id);
        echo json_encode(['status' => true, 'message' => 'Jenis biaya berhasil dihapus']);
    }



// CRUD Harga Biaya
public function option_tahun_pelajaran()
{
    $q = $this->model->getAllTahunPelajaranNotDeleted();
    $ret = '<option value="">Pilih Tahun Pelajaran</option>';
    if ($q->num_rows() > 0) {
        foreach ($q->result() as $row) {
            $ret .= '<option value="' . $row->id_tahun_ajaran . '">' . $row->nama_tahun_pelajaran . '</option>';
        }
    }
    echo $ret;
}

public function option_jenis_biaya()
{

    $q = $this->model->getAllJenisBiayaAktif();
    $ret = '<option value="">Pilih Jenis Biaya</option>';
    

    if ($q->num_rows() > 0) {
        foreach ($q->result() as $row) {
            $ret .= '<option value="' . $row->id_jenis_biaya . '">' . $row->nama_jenis_biaya . '</option>';
        }
    }
    echo $ret;  
}


public function tabel_harga_biaya()
{
    $q = $this->model->getAllHargaBiayaNotDeleted();
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


public function saveHargaBiaya()
{
    $id = $this->input->post('id_harga_biaya');
    $data['id_tahun_ajaran'] = $this->input->post('id_tahun_ajaran');
    $data['id_jenis_biaya'] = $this->input->post('id_jenis_biaya');
    $data['nominal_biaya'] = $this->input->post('nominal_biaya');
    $data['created_at'] = date('Y-m-d H:i:s');
    $data['updated_at'] = date('Y-m-d H:i:s');

    if ($data['nominal_biaya']) {
        $cek = $this->model->cekHargaBiayaDuplicate(
            $data['id_tahun_ajaran'], 
            $data['id_jenis_biaya'], 
            $id
        );        
        if ($cek->num_rows() > 0) {
            $ret['status'] = false;
            $ret['message'] = 'Data sudah ada';
        } else {
            if ($id) {
                $this->model->updateHargaBiaya($id, $data);
                $ret['status'] = true;
                $ret['message'] = 'Data berhasil diupdate';
            } else {
                $this->model->saveHargaBiaya($data);
                $ret['status'] = true;
                $ret['message'] = 'Data berhasil disimpan';
            }
        }
    } else {
        $ret['status'] = false;
        $ret['message'] = 'Data tidak boleh kosong';
    }

    echo json_encode($ret);
}

public function editHargaBiaya()
{
    $id = $this->input->post('id_harga_biaya');
    $q = $this->model->getHargaBiayaByID($id);

    if ($q->num_rows() > 0) {
        $data = $q->row();
        echo json_encode([
            'status' => true,
            'data' => [
                'id_harga_biaya' => $data->id_harga_biaya,
                'id_tahun_ajaran' => $data->id_tahun_ajaran,
                'id_jenis_biaya' => $data->id_jenis_biaya,
                'nominal_biaya' => $data->nominal_biaya,
            ],
            'message' => 'Data ditemukan',
        ]);
    } else {
        echo json_encode([
            'status' => false,
            'data' => [],
            'message' => 'Data tidak tersedia',
        ]);
    }
}


public function deleteHargaBiaya()
{
    $id = $this->input->post('id_harga_biaya');
    $data['deleted_at'] = date('Y-m-d H:i:s');
    $q = $this->model->updateHargaBiaya($id, $data);
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