<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tahun Pelajaran</h3>
            </div>
            <div class="card-body">
                <button class="btn btn-primary btnTambahTahunPelajaran mb-2"> <i class="fas fa-plus"></i> Tambah</button>
                <table class="table table-striped" id="tabelTahunPelajaran">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tahun Pelajaran</th>
                            <th>Mulai</th>
                            <th>Akhir</th>
                            <th>Status</th>
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
<div class="modal" id="modalTahunPelajaran" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Tahun Pelajaran</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="formTahunPelajaran">
                    <input type="hidden" id="id" name="id">
                    <div class="mb-1">
                        <label for="nama_tahun_pelajaran" class="form-label">Nama Tahun Pelajaran</label>
                        <input type="text" class="form-control" id="nama_tahun_pelajaran" name="nama_tahun_pelajaran">
                    </div>
                    <div class="mb-1">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai">
                    </div>
                    <div class="mb-1">
                        <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir">
                    </div>
                    <div class="mb-1">
                        <label for="status_tahun_pelajaran" class="form-label">Status</label>
                        <select class="form-control" id="status_tahun_pelajaran" name="status_tahun_pelajaran">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveBtn">Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    loadTableData();

    $('.btnTambahTahunPelajaran').click(function() {
        $('#modalTahunPelajaran').modal('show');
        $('#modalTahunPelajaran .modal-title').text('Tambah Tahun Pelajaran');
        $('#formTahunPelajaran')[0].reset();
        $('#id').val('');
    });

    $('#saveBtn').off('click').on('click', function(event) {
    event.preventDefault();
    let formData = $('#formTahunPelajaran').serialize();
    $.ajax({
        url: '<?php echo base_url("tahun_pelajaran/save"); ?>',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.status) {
                alert(response.message);
                $('#modalTahunPelajaran').modal('hide');
                loadTableData();
            } else {
                alert(response.message);
            }
        },
        error: function() {
            alert("Terjadi kesalahan.");
        }
    });
});


    window.editTahunPelajaran = function(id) {
        $.ajax({
            url: '<?php echo base_url("tahun_pelajaran/get_by_id/"); ?>' + id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $('#modalTahunPelajaran').modal('show');
                    $('#modalTahunPelajaran .modal-title').text('Edit Tahun Pelajaran');
                    $('#id').val(response.data.id);
                    $('#nama_tahun_pelajaran').val(response.data.nama_tahun_pelajaran);
                    $('#tanggal_mulai').val(response.data.tanggal_mulai);
                    $('#tanggal_akhir').val(response.data.tanggal_akhir);
                    $('#status_tahun_pelajaran').val(response.data.status_tahun_pelajaran);
                } else {
                    alert(response.message);
                }
            }
        });
    }

    window.deleteTahunPelajaran = function(id) {
        if (confirm('Yakin ingin menghapus data ini?')) {
            $.ajax({
                url: '<?php echo base_url("tahun_pelajaran/delete/"); ?>' + id,
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    if (response.status) {
                        alert(response.message);
                        loadTableData();
                    } else {
                        alert(response.message);
                    }
                }
            });
        }
    }

    function loadTableData() {
        $.ajax({
            url: '<?php echo base_url("tahun_pelajaran/table_tahun_pelajaran"); ?>',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                let tableBody = $('#tabelTahunPelajaran tbody');
                tableBody.html('');
                if (response.status) {
                    $.each(response.data, function(index, item) {
                        tableBody.append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.nama_tahun_pelajaran}</td>
                                <td>${item.tanggal_mulai}</td>
                                <td>${item.tanggal_akhir}</td>
                                <td>${item.status_tahun_pelajaran == 1 ? 'Aktif' : 'Tidak Aktif'}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" onclick="editTahunPelajaran(${item.id})">Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteTahunPelajaran(${item.id})">Delete</button>
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    tableBody.append('<tr><td colspan="6">Tidak ada data</td></tr>');
                }
            }
        });
    }
});
</script>
