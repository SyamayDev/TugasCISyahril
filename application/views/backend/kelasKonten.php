<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Manajemen Kelas</h3>
            </div>
            <div class="card-body">
                <button class="btn btn-primary btnTambahKelas mb-2">
                    <i class="fas fa-plus"></i> Tambah Kelas
                </button>
                <table class="table table-striped" id="tabelKelas">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kelas</th>
                            <th>Jurusan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal" id="modalKelas" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kelas</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="formKelas">
                    <input type="hidden" id="kelas_id" name="kelas_id">
                    <div class="mb-1">
                        <label for="id_tahun_pelajaran" class="form-label">Tahun Pelajaran</label>
                        <select class="form-control" id="id_tahun_pelajaran" name="id_tahun_pelajaran" required>
                            <option value="">Pilih Tahun Pelajaran</option>
                            <?php foreach ($tahun_pelajaran as $tahun): ?>
                                <option value="<?= $tahun->id ?>"><?= $tahun->nama_tahun_pelajaran ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label for="id_jurusan" class="form-label">Jurusan</label>
                        <select class="form-control" id="id_jurusan" name="id_jurusan" required>
                            <option value="">Pilih Jurusan</option>
                            <?php foreach ($jurusan as $jurusan): ?>
                                <option value="<?= $jurusan->id ?>"><?= $jurusan->nama_jurusan ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label for="nama_kelas" class="form-label">Nama Kelas</label>
                        <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveKelasBtn">Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    loadTableData();
    loadTahunPelajaranOptions();
    loadJurusanOptions();

    $('.btnTambahKelas').click(function () {
        $('#modalKelas').modal('show');
        $('#modalKelas .modal-title').text('Tambah Kelas');
        $('#formKelas')[0].reset();
        $('#kelas_id').val('');
    });

    $('#saveKelasBtn').off('click').on('click', function (event) {
    event.preventDefault();
    let formData = $('#formKelas').serialize();
    $.ajax({
        url: '<?php echo base_url("kelas/save"); ?>',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function (response) {
            if (response.status) {
                alert(response.message);
                $('#modalKelas').modal('hide');
                $('#formKelas')[0].reset();
                
                loadTableData();
            } else {
                alert(response.message);
            }
        },
        error: function () {
            alert('Terjadi kesalahan.');
        }
    });
});


    function loadTahunPelajaranOptions() {
        $.ajax({
            url: '<?php echo base_url("tahun_pelajaran/table_tahun_pelajaran"); ?>',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                let options = '<option value="">Pilih Tahun Pelajaran</option>';
                if (response.status) {
                    $.each(response.data, function (index, item) {
                        options += `<option value="${item.id}">${item.nama_tahun_pelajaran}</option>`;
                    });
                }
                $('#id_tahun_pelajaran').html(options);
            }
        });
    }

    function loadJurusanOptions() {
        $.ajax({
            url: '<?php echo base_url("jurusan/table_jurusan"); ?>',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                let options = '<option value="">Pilih Jurusan</option>';
                if (response.status) {
                    $.each(response.data, function (index, item) {
                        options += `<option value="${item.id}">${item.nama_jurusan}</option>`;
                    });
                }
                $('#id_jurusan').html(options);
            }
        });
    }

    window.editKelas = function (id) {
        $.ajax({
            url: '<?php echo base_url("kelas/get_by_id/"); ?>' + id,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.status) {
                    $('#modalKelas').modal('show');
                    $('#modalKelas .modal-title').text('Edit Kelas');
                    $('#kelas_id').val(response.data.id);
                    $('#id_tahun_pelajaran').val(response.data.id_tahun_pelajaran);
                    $('#id_jurusan').val(response.data.id_jurusan);
                    $('#nama_kelas').val(response.data.nama_kelas);
                } else {
                    alert(response.message);
                }
            }
        });
    };

    window.deleteKelas = function (id) {
        if (confirm('Yakin ingin menghapus data ini?')) {
            $.ajax({
                url: '<?php echo base_url("kelas/delete/"); ?>' + id,
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    if (response.status) {
                        alert(response.message);
                        loadTableData();
                    } else {
                        alert(response.message);
                    }
                }
            });
        }
    };

    function loadTableData() {
        $.ajax({
            url: '<?php echo base_url("kelas/table_kelas"); ?>',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                console.log(response);
                let tableBody = $('#tabelKelas tbody');
                tableBody.html('');
                if (response.status) {
                    $.each(response.data, function (index, item) {
                        tableBody.append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.nama_kelas}</td>
                                <td>${item.nama_jurusan}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" onclick="editKelas(${item.id})">Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteKelas(${item.id})">Delete</button>
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    tableBody.append('<tr><td colspan="4">Tidak ada data</td></tr>');
                }
            }
        });
    }
});
</script>

