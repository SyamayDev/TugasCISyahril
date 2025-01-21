<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftaran_model extends CI_Model
{

	protected $tableTahunPelajaran = 'data_tahun_pelajaran';
	protected $tableKelas = 'data_kelas';
	protected $tableJurusan = 'data_jurusan';
	protected $tableJenisBiaya = 'jenis_biaya';
	protected $tableHargaBiaya = 'harga_biaya';
	protected $tableJenisSeragam = 'jenis_seragam';
	protected $tableStokSeragam = 'stok_seragam';
    protected $tablePendaftaranAwal = 'pendaftaran_awal';

	public function __construct()
	{
		parent::__construct();
	}


    public function getAllTahunPelajaranNotDeleted()
    {
        $this->db->select('id, nama_tahun_pelajaran'); // Menambahkan kolom nama_tahun_pelajaran
        $this->db->where('deleted_at', 0);
        return $this->db->get($this->tableTahunPelajaran)->result_array();
    }
    
    public function getJurusanByTahunPelajaranID($id)
    {
        $this->db->select('data_jurusan.id, data_jurusan.nama_jurusan'); // Menambahkan kolom nama_jurusan
        $this->db->from('data_jurusan');
        $this->db->join('data_tahun_pelajaran', 'data_jurusan.id_tahun_pelajaran = data_tahun_pelajaran.id');
        $this->db->where('data_tahun_pelajaran.id', $id);
        return $this->db->get()->result_array();
    }
    
    public function getKelasByJurusanID($id)
    {
        $this->db->select('data_kelas.id, data_kelas.nama_kelas'); // Menambahkan kolom nama_kelas
        $this->db->from('data_kelas');
        $this->db->join('data_jurusan', 'data_kelas.id_jurusan = data_jurusan.id');
        $this->db->where('data_jurusan.id', $id);
        return $this->db->get()->result_array();
    }    
    

    public function getAllPendaftaranAwalNotDeleted()
    {
        $this->db->where('deleted_at', 0);
        return $this->db->get($this->tablePendaftaranAwal);
    }

    public function getPendaftaranAwalByID($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->tablePendaftaranAwal);
    }

    public function updatePendaftaranAwal($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->tablePendaftaranAwal, $data);
    }

    public function savePendaftaranAwal($data)
    {
        return $this->db->insert($this->tablePendaftaranAwal, $data);
    }

    public function deletePendaftaranAwal($id)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->tablePendaftaranAwal, ['deleted_at' => time()]);
    }

    public function generateNomorPendaftaran($tahun_pelajaran, $jurusan)
    {
        $count = $this->db->where('tahun_pelajaran', $tahun_pelajaran)
                          ->where('jurusan', $jurusan)
                          ->count_all_results('data_kelas_siswa') + 1;
        return sprintf('%s-%s-%04d', str_replace('/', '', $tahun_pelajaran), strtoupper($jurusan), $count);
    }
}
