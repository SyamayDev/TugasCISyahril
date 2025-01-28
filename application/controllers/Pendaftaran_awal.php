<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftaran_awal extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		if (!$this->session->userdata('is_login')) {
            redirect('login', 'refresh'); 
        }

        $this->load->model('User_model');
        $this->load->model('Masterdata_model', 'md');
        $this->load->model('Pendaftaran_model');
        $this->load->library('form_validation');
    }

	public function index()
	{
		$data = array(
			'menu' => 'backend/menu',
			'content' => 'backend/pendaftaranAwalKonten',
			'title' => 'Admin'
		);
		$this->load->view('template', $data);
	}

    public function getOption_tahun_pelajaran()
    {
        $q = $this->Pendaftaran_model->getAllTahunPelajaranNotDeleted();
        $opt = '<option value="">Pilih Tahun Pelajaran</option>';
        if (!empty($q)) { // Memeriksa apakah data tidak kosong
            foreach ($q as $row) {
                $opt .= '<option value="' . $row['id'] . '">' . $row['nama_tahun_pelajaran'] . '</option>';
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
        $q = $this->Pendaftaran_model->getJurusanByTahunPelajaranID($id);
        $ret = '<option value="">Pilih Jurusan</option>';
        if (!empty($q)) { // Memeriksa apakah data tidak kosong
            foreach ($q as $row) {
                $ret .= '<option value="' . $row['id'] . '">' . $row['nama_jurusan'] . '</option>';
            }
        }
        
        echo $ret;
    }

    public function getOption_kelas()
    {
        $id = $this->input->post('id');
        $q = $this->Pendaftaran_model->getKelasByJurusanID($id);
        $ret = '<option value="">Pilih Kelas</option>';
        if (!empty($q)) { // Memeriksa apakah data tidak kosong
            foreach ($q as $row) {
                $ret .= '<option value="' . $row['id'] . '">' . $row['nama_kelas'] . '</option>';
            }
        }
        echo $ret;
    }

    public function table_pendaftaran_awal_kelas()
    {
        $this->db->select('
            pendaftaran_awal.id,
            pendaftaran_awal.id_tahun_pelajaran,
            tahun_pelajaran.nama_tahun_pelajaran,
            pendaftaran_awal.id_jurusan,
            jurusan.nama_jurusan,
            pendaftaran_awal.id_kelas,
            kelas.nama_kelas
        ');
        
        $this->db->from('pendaftaran_awal');
        $this->db->join('data_tahun_pelajaran as tahun_pelajaran', 'pendaftaran_awal.id_tahun_pelajaran = tahun_pelajaran.id');
        $this->db->join('data_jurusan as jurusan', 'pendaftaran_awal.id_jurusan = jurusan.id');
        $this->db->join('data_kelas as kelas', 'pendaftaran_awal.id_kelas = kelas.id');
        
        $this->db->where('pendaftaran_awal.deleted_at', 0);
    
        $q = $this->db->get();
        
        $dt = [];
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $dt[] = [
                    'id' => $row->id,
                    'id_tahun_pelajaran' => $row->id_tahun_pelajaran,
                    'nama_tahun_pelajaran' => $row->nama_tahun_pelajaran,
                    'id_jurusan' => $row->id_jurusan,
                    'nama_jurusan' => $row->nama_jurusan,
                    'id_kelas' => $row->id_kelas,
                    'nama_kelas' => $row->nama_kelas
                ];
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
    

    public function table_pendaftaran_awal_siswa()
    {
        $q = $this->Pendaftaran_model->getAllPendaftaranAwalNotDeleted();
        $dt = [];
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $dt[] = [
                    'id' => $row->id,
                    'nama_siswa' => $row->nama_siswa,
                    'nik' => $row->nik,
                    'agama' => $row->agama,
                    'nisn' => $row->nisn,
                    'jenis_kelamin' => $row->jenis_kelamin,
                    'tempat_lahir' => $row->tempat_lahir,
                    'tanggal_lahir' => $row->tanggal_lahir,
                    'alamat' => $row->alamat,
                    'no_telepon' => $row->no_telepon,
                    'email' => $row->email,
                    'asal_sekolah' => $row->asal_sekolah,
                ];
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

    public function table_pendaftaran_awal_orangtua()
    {
        $q = $this->Pendaftaran_model->getAllPendaftaranAwalNotDeleted();
        $dt = [];
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $dt[] = [
                    'id' => $row->id,
                    'nama_ayah' => $row->nama_ayah,
                    'nama_ibu' => $row->nama_ibu,
                    'no_telepon_ayah' => $row->no_telepon_ayah,
                    'no_telepon_ibu' => $row->no_telepon_ibu,
                    'pekerjaan_ayah' => $row->pekerjaan_ayah,
                    'pekerjaan_ibu' => $row->pekerjaan_ibu,
                    'nama_wali' => $row->nama_wali,
                    'no_telepon_wali' => $row->no_telepon_wali,
                    'pekerjaan_wali' => $row->pekerjaan_wali,
                    'alamat' => $row->alamat_wali,
                    'sumber_informasi' => $row->sumber_informasi,
                ];
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

    public function save_pendaftaran_awal()
    {
        $this->load->library('form_validation');
        
            // Validasi Data Siswa
        $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required|max_length[100]', [
            'required' => '{field} wajib diisi.',
            'max_length' => '{field} tidak boleh lebih dari 100 karakter.'
        ]);
        $this->form_validation->set_rules('nik', 'NIK', 'required|numeric|exact_length[16]', [
            'required' => '{field} wajib diisi.',
            'numeric' => '{field} harus berupa angka.',
            'exact_length' => '{field} harus berisi 16 angka.'
        ]);
        $this->form_validation->set_rules('agama', 'Agama', 'required', [
            'required' => '{field} wajib diisi.'
        ]);
        $this->form_validation->set_rules('nisn', 'NISN', 'required|numeric|exact_length[10]', [
            'required' => '{field} wajib diisi.',
            'numeric' => '{field} harus berupa angka.',
            'exact_length' => '{field} harus berisi 10 angka.'
        ]);
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|in_list[Laki-laki,Perempuan]', [
            'required' => '{field} wajib dipilih.',
            'in_list' => '{field} harus dipilih antara "Laki-laki" atau "Perempuan".'
        ]);
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required', [
            'required' => '{field} wajib diisi.'
        ]);
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required|callback_validate_date', [
            'required' => '{field} wajib diisi.'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|max_length[255]', [
            'required' => '{field} wajib diisi.',
            'max_length' => '{field} maksimal {param} karakter.'
            ]);
        
            // Validasi Data Orang Tua
        $this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'required', [
            'required' => '{field} wajib diisi.'
            ]);
        $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'required', [
            'required' => '{field} wajib diisi.'
            ]);
        $this->form_validation->set_rules('no_telepon_ayah', 'No Telepon Ayah', 'required|numeric|min_length[10]|max_length[13]', [
            'required' => '{field} wajib diisi.',
            'numeric' => '{field} harus berupa angka.',
            'min_length' => '{field} minimal {param} karakter.',
            'max_length' => '{field} maksimal {param} karakter.'
            ]);
        $this->form_validation->set_rules('no_telepon_ibu', 'No Telepon Ibu', 'required|numeric|min_length[10]|max_length[13]', [
            'required' => '{field} wajib diisi.',
            'numeric' => '{field} harus berupa angka.',
            'min_length' => '{field} minimal {param} karakter.',
            'max_length' => '{field} maksimal {param} karakter.'
            ]);
        $this->form_validation->set_rules('pekerjaan_ayah', 'Pekerjaan Ayah', 'required', [
            'required' => '{field} wajib diisi.'
            ]);
        $this->form_validation->set_rules('pekerjaan_ibu', 'Pekerjaan Ibu', 'required', [
            'required' => '{field} wajib diisi.'
            ]);
        $this->form_validation->set_rules('nama_wali', 'Nama Wali', 'required', [
            'required' => '{field} wajib diisi.'
            ]);
        $this->form_validation->set_rules('no_telepon_wali', 'No Telepon Wali', 'required|numeric|min_length[10]|max_length[13]', [
            'required' => '{field} wajib diisi.',
            'numeric' => '{field} harus berupa angka.',
            'min_length' => '{field} minimal {param} karakter.',
            'max_length' => '{field} maksimal {param} karakter.'
            ]);
        $this->form_validation->set_rules('pekerjaan_wali', 'Pekerjaan Wali', 'required', [
            'required' => '{field} wajib diisi.'
            ]);
        $this->form_validation->set_rules('alamat_wali', 'Alamat Wali', 'required|max_length[255]', [
            'required' => '{field} wajib diisi.',
            'max_length' => '{field} maksimal {param} karakter.'
            ]);
        $this->form_validation->set_rules('sumber_informasi', 'Sumber Informasi', 'required', [
            'required' => '{field} wajib dipilih.'
            ]);

if ($this->form_validation->run() == FALSE) {
    echo json_encode([
        'status' => false,
        'error' => $this->form_validation->error_array() // Mengembalikan error dalam format array
    ]);
} else {
    $id = $this->input->post('id');
    $email = $this->input->post('email');
    $nik = $this->input->post('nik');
    $nisn = $this->input->post('nisn');
    $nama_siswa = $this->input->post('nama_siswa');
    $data_siswa = array(    
        'id_tahun_pelajaran' => $this->input->post('id_tahun_pelajaran'),
        'id_jurusan' => $this->input->post('id_jurusan'),
        'id_kelas' => $this->input->post('id_kelas'),
        'nama_siswa' => $this->input->post('nama_siswa'),
        'nik' => $this->input->post('nik'),
        'agama' => $this->input->post('agama'),
        'nisn' => $this->input->post('nisn'),
        'jenis_kelamin' => $this->input->post('jenis_kelamin'),
        'tempat_lahir' => $this->input->post('tempat_lahir'),
        'tanggal_lahir' => $this->input->post('tanggal_lahir'),
        'alamat' => $this->input->post('alamat'),
        'no_telepon' => $this->input->post('no_telepon'),
        'email' => $this->input->post('email'),
        'asal_sekolah' => $this->input->post('asal_sekolah'),
        'updated_at' => date('Y-m-d H:i:s'),
        'deleted_at' => 0,
        'nama_ayah' => $this->input->post('nama_ayah'),
        'nama_ibu' => $this->input->post('nama_ibu'),
        'no_telepon_ayah' => $this->input->post('no_telepon_ayah'),
        'no_telepon_ibu' => $this->input->post('no_telepon_ibu'),
        'pekerjaan_ayah' => $this->input->post('pekerjaan_ayah'),
        'pekerjaan_ibu' => $this->input->post('pekerjaan_ibu'),
        'nama_wali' => $this->input->post('nama_wali'),
        'no_telepon_wali' => $this->input->post('no_telepon_wali'),
        'pekerjaan_wali' => $this->input->post('pekerjaan_wali'),
        'alamat_wali' => $this->input->post('alamat_wali'),
        'sumber_informasi' => $this->input->post('sumber_informasi')
    );
   
    // Cek duplikasi data
    if ($this->Pendaftaran_model->checkDuplicate('email', $email, $id)) {
        echo json_encode(['status' => false, 'message' => 'Email sudah terdaftar.']);
        return;
    }
    if ($this->Pendaftaran_model->checkDuplicate('nik', $nik, $id)) {
        echo json_encode(['status' => false, 'message' => 'NIK sudah terdaftar.']);
        return;
    }
    if ($this->Pendaftaran_model->checkDuplicate('nisn', $nisn, $id)) {
        echo json_encode(['status' => false, 'message' => 'NISN sudah terdaftar.']);
        return;
    }
    if ($this->Pendaftaran_model->checkDuplicate('nama_siswa', $nama_siswa, $id)) {
        echo json_encode(['status' => false, 'message' => 'Nama siswa sudah terdaftar.']);
        return;
    }

    
    if (!empty($id)) {
        // Jika ada ID, berarti ini adalah update
        $data_siswa['updated_at'] = date('Y-m-d H:i:s'); // Pastikan waktu update diperbarui
        $siswa_updated = $this->Pendaftaran_model->updatePendaftaranAwal($id, $data_siswa);
        if ($siswa_updated) {
            $ret['status'] = true;
            $ret['message'] = 'Data siswa berhasil diperbarui, silahkan refresh halaman';
        } else {
            $ret['status'] = false;
            $ret['message'] = 'Gagal memperbarui data siswa';
        }
    } else {
        // Jika tidak ada ID, berarti ini adalah insert
        $data_siswa['created_at'] = date('Y-m-d H:i:s'); // Menetapkan waktu pembuatan
        $id = $this->Pendaftaran_model->savePendaftaranAwal($data_siswa);
        if ($id) {
            $ret['status'] = true;
            $ret['message'] = 'Data siswa berhasil disimpan, silahkan refresh halaman';
        } else {
            $ret['status'] = false;
            $ret['message'] = 'Data siswa gagal disimpan';
        }
    }

    echo json_encode($ret);
}
    }

    public function validate_date($date)
    {
        $date = date_create_from_format('Y-m-d', $date);
        if ($date) {
            return true;
        } else {
            $this->form_validation->set_message('validate_date', 'Format tanggal tidak valid.');
            return false;
        }
    }

    public function edit_pendaftaran_awal($id)
    {
        $q = $this->Pendaftaran_model->getPendaftaranAwalByID($id);
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

    public function delete_pendaftaran_awal($id)
    {
        $data['deleted_at'] = time();
        $q = $this->Pendaftaran_model->deletePendaftaranAwal($id, $data);
        if ($q) {
            $ret['status'] = true;
            $ret['message'] = 'Data berhasil dihapus, silahkan refresh halaman';
        } else {
            $ret['status'] = false;
            $ret['message'] = 'Data gagal dihapus';
        }
        echo json_encode($ret);
    }
}