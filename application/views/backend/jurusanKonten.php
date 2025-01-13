<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Manajemen Jurusan</h3>
            </div>
            <div class="card-body">
                <button class="btn btn-primary btnTambahJurusan mb-2">
                    <i class="fas fa-plus"></i> Tambah Jurusan
                </button>
                <table class="table table-striped" id="tabelJurusan">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Jurusan</th>
                            <th>Tahun Pelajaran</th>
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
<div class="modal" id="modalJurusan" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Jurusan</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="formJurusan">
                    <input type="hidden" id="jurusan_id" name="jurusan_id">
                    <div class="mb-1">
                        <label for="id_tahun_pelajaran" class="form-label">Tahun Pelajaran</label>
                        <select class="form-control" id="id_tahun_pelajaran" name="id_tahun_pelajaran" required>
                            <option value="">Pilih Tahun Pelajaran</option>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label for="nama_jurusan" class="form-label">Nama Jurusan</label>
                        <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveJurusanBtn">Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    loadTableData();
    loadTahunPelajaranOptions();

    $('.btnTambahJurusan').click(function () {
        $('#modalJurusan').modal('show');
        $('#modalJurusan .modal-title').text('Tambah Jurusan');
        $('#formJurusan')[0].reset();
        $('#jurusan_id').val('');
    });

    $('#saveJurusanBtn').off('click').on('click', function (event) {
    event.preventDefault();
    let formData = $('#formJurusan').serialize();
    $.ajax({
        url: '<?php echo base_url("jurusan/save"); ?>',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function (response) {
            if (response.status) {
                alert(response.message);
                $('#modalJurusan').modal('hide');
                loadTableData();
            } else {
                alert(response.message);
            }
        },
        error: function () {
            alert('Pilih Tahun Ajaran.');
        }
    });
});


    window.editJurusan = function (id) {
    $.ajax({
        url: '<?php echo base_url("jurusan/get_by_id/"); ?>' + id,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response.status) {
                $('#modalJurusan').modal('show');
                $('#modalJurusan .modal-title').text('Edit Jurusan');
                $('#jurusan_id').val(response.data.id);
                $('#id_tahun_pelajaran').val(response.data.id_tahun_pelajaran);
                $('#nama_jurusan').val(response.data.nama_jurusan);
            } else {
                alert(response.message);
            }
        }
    });
};


    window.deleteJurusan = function (id) {
        if (confirm('Yakin ingin menghapus data ini?')) {
            $.ajax({
                url: '<?php echo base_url("jurusan/delete/"); ?>' + id,
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
            url: '<?php echo base_url("jurusan/table_jurusan"); ?>',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                let tableBody = $('#tabelJurusan tbody');
                tableBody.html('');
                if (response.status) {
                    $.each(response.data, function (index, item) {
                        tableBody.append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.nama_jurusan}</td>
                                <td>${item.nama_tahun_pelajaran}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" onclick="editJurusan(${item.id})">Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteJurusan(${item.id})">Delete</button>
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
});
</script>
