<?php
class Pendaftaran_model extends MY_Model
{
    private $tablePendaftaranAwal = 'pendaftaran_awal';
    private $tableTahunPelajaran = 'data_tahun_pelajaran';
    private $tableJurusan = 'data_jurusan';
    private $tableKelas = 'data_kelas';

    public function __construct()
    {
        parent::__construct();
    }

    private function generateQueryPendaftaranAwalKelas()
    {
        $this->db->from($this->tablePendaftaranAwal)
            ->join($this->tableTahunPelajaran, "{$this->tableTahunPelajaran}.id = {$this->tablePendaftaranAwal}.id_tahun_pelajaran", 'left')
            ->join($this->tableJurusan, "{$this->tableJurusan}.id = {$this->tablePendaftaranAwal}.id_jurusan", 'left')
            ->join($this->tableKelas, "{$this->tableKelas}.id = {$this->tablePendaftaranAwal}.id_kelas", 'left')
            ->select("{$this->tablePendaftaranAwal}.id, {$this->tableTahunPelajaran}.nama_tahun_pelajaran, {$this->tableJurusan}.nama_jurusan, {$this->tableKelas}.nama_kelas");

        return substr($this->db->get_compiled_select(), 6);
    }

    public function dataTablesPendaftaranAwalKelas()
    {
        $col_order = [
            "{$this->tablePendaftaranAwal}.id",
            "{$this->tableTahunPelajaran}.nama_tahun_pelajaran",
            "{$this->tableJurusan}.nama_jurusan",
            "{$this->tableKelas}.nama_kelas"
        ];
        $col_search = $col_order;
        $order = ["{$this->tablePendaftaranAwal}.id" => 'desc'];
        $filter = ["{$this->tablePendaftaranAwal}.deleted_at" => 0];

        $query = $this->generateQueryPendaftaranAwalKelas();
        return $this->buildDatatableResponse($query, $col_order, $col_search, $order, $filter);
    }

    private function generateQueryPendaftaranAwalSiswa()
    {
        $this->db->from($this->tablePendaftaranAwal)
            ->select('id, nama_siswa, nik, agama, nisn, jenis_kelamin, tempat_lahir, tanggal_lahir, alamat, no_telepon, email, asal_sekolah');

        return substr($this->db->get_compiled_select(), 6);
    }

    public function dataTablesPendaftaranAwalSiswa()
    {
        $col_order = [
            'id', 'nama_siswa', 'nik', 'agama', 'nisn', 'jenis_kelamin',
            'tempat_lahir', 'tanggal_lahir', 'alamat', 'no_telepon', 'email', 'asal_sekolah'
        ];
        $col_search = $col_order;
        $order = ['id' => 'desc'];
        $filter = ['deleted_at' => 0];

        $query = $this->generateQueryPendaftaranAwalSiswa();
        return $this->buildDatatableResponse($query, $col_order, $col_search, $order, $filter);
    }

    private function generateQueryPendaftaranAwalOrangtua()
    {
        $this->db->from($this->tablePendaftaranAwal)
            ->select('id, nama_ayah, nama_ibu, no_telepon_ayah, no_telepon_ibu, pekerjaan_ayah, pekerjaan_ibu, nama_wali, no_telepon_wali, pekerjaan_wali, alamat, sumber_informasi');

        return substr($this->db->get_compiled_select(), 6);
    }

    public function dataTablesPendaftaranAwalOrangtua()
    {
        $col_order = [
            'id', 'nama_ayah', 'nama_ibu', 'no_telepon_ayah', 'no_telepon_ibu',
            'pekerjaan_ayah', 'pekerjaan_ibu', 'nama_wali', 'no_telepon_wali',
            'pekerjaan_wali', 'alamat', 'sumber_informasi'
        ];
        $col_search = $col_order;
        $order = ['id' => 'desc'];
        $filter = ['deleted_at' => 0];

        $query = $this->generateQueryPendaftaranAwalOrangtua();
        return $this->buildDatatableResponse($query, $col_order, $col_search, $order, $filter);
    }

    // Menambahkan method buildDatatableResponse() untuk mengatasi error
    public function buildDatatableResponse($query, $col_order, $col_search, $order, $filter)
    {
        $list = $this->get_datatables($query, $col_order, $col_search, $order, $filter);

        $data = [];
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = [];
            foreach ($col_order as $col) {
                $row[] = $item->$col;
            }
            $data[] = $row;
        }

        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->countAllQueryFiltered($query, $filter),
            "recordsFiltered" => $this->count_filtered($query, $filter),
            "data" => $data,
        ];

        return $output;
    }

    public function getAllTahunPelajaranNotDeleted()
    {
        $this->db->select('id, nama_tahun_pelajaran')
            ->where('deleted_at', 0);
        return $this->db->get($this->tableTahunPelajaran)->result();
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

    public function checkDuplicate($field, $value, $exclude_id = null)
    {
        $query = $this->db
            ->where($field, $value)
            ->where('id !=', $exclude_id)
            ->get($this->tablePendaftaranAwal); // Menggunakan $this->tablePendaftaranAwal agar konsisten
    
        return $query->num_rows() > 0;
    }
    
}
