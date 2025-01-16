<div class="col-12 col-lg">
    <div class="card card-primary card-tabs">
        <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-jenis-biaya" data-toggle="pill" href="#content-jenis-biaya"
                        role="tab" aria-controls="content-jenis-biaya" aria-selected="true">Jenis Biaya</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-harga-biaya" data-toggle="pill" href="#content-harga-biaya" role="tab"
                        aria-controls="content-harga-biaya" aria-selected="false">Harga Biaya</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-one-tabContent">

                <!-- Tab Jenis Biaya -->
                <div class="tab-pane fade show active" id="content-jenis-biaya" role="tabpanel"
                    aria-labelledby="tab-jenis-biaya">
                    <div class="row">   
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Jenis Biaya</h3>
                                    <button class="btn btn-primary float-right" id="btnTambahJenisBiaya">Tambah</button>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped" id="jenisBiayaTable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Jenis Biaya</th>
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
                </div>

                <!-- Tab Harga Biaya -->
                <div class="tab-pane fade" id="content-harga-biaya" role="tabpanel" aria-labelledby="tab-harga-biaya">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Harga Biaya</h3>
                                    <button class="btn btn-primary float-right btnTambahHargaBiaya">Tambah</button>
                                </div>
                                <div class="card-body">
                                <table class="table table-striped" id="tabelHargaBiaya">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tahun Pelajaran</th>
                                            <th>Jenis Biaya</th>
                                            <th>Nominal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Jenis Biaya -->
<div class="modal fade" id="modalJenisBiaya" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Jenis Biaya</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formJenisBiaya">
                    <input type="hidden" id="idJenisBiaya">
                    <div class="form-group">
                        <label for="namaJenisBiaya">Nama Jenis Biaya</label>
                        <input type="text" class="form-control" id="namaJenisBiaya" name="namaJenisBiaya">
                    </div>
                    <div class="form-group">
                        <label for="statusJenisBiaya">Status</label>
                        <select class="form-control" id="statusJenisBiaya" name="statusJenisBiaya">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveJenisBiaya">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Harga Biaya -->
<div class="modal fade" id="modalHargaBiaya" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Harga Biaya</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formHargaBiaya">
                    <input type="hidden" id="idHargaBiaya">
                    <div class="form-group">
                        <label for="id_tahun_pelajaran">Tahun Pelajaran</label>
                        <select class="form-control" id="id_tahun_ajaran" name="id_tahun_ajaran"></select>
                    </div>
                    <div class="form-group">
                        <label for="jenisBiaya">Jenis Biaya</label>
                        <select class="form-control" id="id_jenis_biaya" name="jenisBiaya"></select>
                    </div>
                    <div class="form-group">
                        <label for="nominal_biaya">Nominal</label>
                        <input type="number" class="form-control" id="nominal_biaya" name="nominal_biaya">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary saveBtnHargaBiaya">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    loadJenisBiayaTable();

    $('#btnTambahJenisBiaya').click(function() {
        $('#idJenisBiaya').val('');
        $('#formJenisBiaya').trigger('reset');
        $('#modalJenisBiaya .modal-title').text('Tambah Jenis Biaya');
        $('#modalJenisBiaya').modal('show');
    });

    $('#saveJenisBiaya').click(function() {
        saveJenisBiaya();
    });
});

function loadJenisBiayaTable() {
    let table = $('#jenisBiayaTable tbody');
    let tr = '';
    $.ajax({
        url: '<?php echo base_url("biaya/tableJenisBiaya"); ?>',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            table.empty();
            if (response.status) {
                let no = 1;
                $.each(response.data, function(i, item) {
                    tr = $('<tr>');
                    tr.append('<td>' + no++ + '</td>');
                    tr.append('<td>' + item.nama_jenis_biaya + '</td>');
                    tr.append('<td>' + (item.status_aktif === '1' ? 'Aktif' : 'Tidak Aktif') + '</td>');
                    tr.append('<td> <button class="btn btn-warning" onclick="editJenisBiaya(' + item.id_jenis_biaya + ')">Edit</button> <button class="btn btn-danger" onclick="deleteJenisBiaya(' + item.id_jenis_biaya + ')" id="deleteJenisBiaya">Hapus</button></td>');
                    table.append(tr);
                });
            } else {
                tr = $('<tr>');
                tr.append('<td colspan="4">Tidak ada data</td>');
                table.append(tr);
            }
        }
    });
}

$('#saveJenisBiaya').click(function() {
    saveJenisBiaya();
});

function saveJenisBiaya() {
    $.ajax({
        url: '<?php echo base_url("biaya/saveJenisBiaya"); ?>',
        type: 'POST',
        data: $('#formJenisBiaya').serialize(),
        dataType: 'json',
        success: function(response) {
            if (response.status) {
                alert(response.message);
                $('#modalJenisBiaya').modal('hide');
                loadJenisBiayaTable();
            } else {
                alert(response.message);
            }
        }
    });
}


function editJenisBiaya(id) {
    $.ajax({
        url: '<?php echo base_url("biaya/editJenisBiaya"); ?>',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function(response) {
            if (response.status) {
                $('#idJenisBiaya').val(response.data.id_jenis_biaya);
                $('#namaJenisBiaya').val(response.data.nama_jenis_biaya);
                $('#statusJenisBiaya').val(response.data.status_aktif);
                $('#modalJenisBiaya .modal-title').text('Edit Jenis Biaya');
                $('#modalJenisBiaya').modal('show');
            } else {
                alert(response.message);
            }
        }
    });
}


function deleteJenisBiaya(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        $.ajax({
            url: '<?php echo base_url("biaya/deleteJenisBiaya"); ?>',
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    alert(response.message);
                    loadJenisBiayaTable();
                } else {
                    alert(response.message);
                }
            }
        });
    }
}


// Harga Biaya

$(document).ready(function() {
    tabelHargaBiaya();
    $('#id_tahun_ajaran').load('<?php echo base_url('biaya/option_tahun_pelajaran'); ?>');
    $('#id_tahun_ajaran').change(function() {
        let id = $(this).val(); 
        let url = '<?php echo base_url('biaya/option_jenis_biaya'); ?>';
        $('#id_jenis_biaya').load(url + '/' + id);
    });
});

function tabelHargaBiaya() {
    let tabelHargaBiaya = $('#tabelHargaBiaya tbody');
    console.log(tabelHargaBiaya);  
    $.ajax({
        url: '<?php echo base_url('biaya/tabel_harga_biaya'); ?>',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log('Respons dari server:', response); 
            if (response.status) {
                tabelHargaBiaya.empty();
                let no = 1;
                $.each(response.data, function(i, item) {
                    let tr = $('<tr>');
                    tr.append('<td>' + no++ + '</td>');
                    tr.append('<td>' + item.nama_tahun_pelajaran + '</td>');
                    tr.append('<td>' + item.nama_jenis_biaya + '</td>');
                    tr.append('<td>' + item.nominal_biaya + '</td>');
                    tr.append('<td> <button class="btn btn-primary" onclick="editHargaBiaya(' + item.id_harga_biaya + ')">Edit</button> <button class="btn btn-danger" onclick="deleteHargaBiaya(' + item.id_harga_biaya + ')">Delete</button></td>');
                    tabelHargaBiaya.append(tr);
                });
            } else {
                let tr = $('<tr>');
                tr.append('<td colspan="5">' + response.message + '</td>');
                tabelHargaBiaya.append(tr);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error AJAX:', error);
        }
    });
}


$('.btnTambahHargaBiaya').click(function() {
    $('#id_harga_biaya').val('');
    $('#formHargaBiaya').trigger('reset');


    $.ajax({
        url: '<?php echo base_url('biaya/option_tahun_pelajaran'); ?>', 
        type: 'GET',
        success: function(response) {
            $('#id_tahun_ajaran').html(response);  
        }
    });

    $.ajax({
        url: '<?php echo base_url('biaya/option_jenis_biaya'); ?>',  
        type: 'GET',
        success: function(response) {
            $('#id_jenis_biaya').html(response);  
        }
    });

    $('#modalHargaBiaya').modal('show');
});

$('.saveBtnHargaBiaya').click(function() {
    let id_tahun_ajaran = $('#id_tahun_ajaran').val();
    let id_jenis_biaya = $('#id_jenis_biaya').val();
    let nominal_biaya = $('#nominal_biaya').val();

    if (!id_tahun_ajaran || !id_jenis_biaya || !nominal_biaya) {
        alert('Semua kolom wajib diisi!');
        return;
    }


    $.ajax({
        url: '<?php echo base_url('biaya/saveHargaBiaya'); ?>',
        type: 'POST',
        data: {
            id_harga_biaya: $('#id_harga_biaya').val(),
            id_tahun_ajaran: id_tahun_ajaran,
            id_jenis_biaya: id_jenis_biaya,
            nominal_biaya: nominal_biaya,
        },
        dataType: 'json',
        success: function(response) {
            if (response.status) {
                alert(response.message);
                $('#modalHargaBiaya').modal('hide');
                tabelHargaBiaya();
            } else {
                alert(response.message);
            }
        }
    });
});


function editHargaBiaya(id_harga_biaya) {

    $.ajax({
        url: '<?php echo base_url('biaya/editHargaBiaya'); ?>',
        type: 'POST',
        data: {
            id_harga_biaya: id_harga_biaya,
        },
        dataType: 'json',
        success: function(response) {
            if (response.status) {

                $('#id_harga_biaya').val(response.data.id_harga_biaya);
                $('#nominal_biaya').val(response.data.nominal_biaya); 


                $.ajax({
                    url: '<?php echo base_url('biaya/option_tahun_pelajaran'); ?>',
                    type: 'GET',
                    success: function(responseDropdown) {
                        $('#id_tahun_ajaran').html(responseDropdown);
                        $('#id_tahun_ajaran').val(response.data.id_tahun_ajaran); 
                    complete: function() {

                        $.ajax({
                            url: '<?php echo base_url('biaya/option_jenis_biaya'); ?>',
                            type: 'GET',
                            success: function(responseDropdown) {
                                $('#id_jenis_biaya').html(responseDropdown); 
                                $('#id_jenis_biaya').val(response.data.id_jenis_biaya);
                            },
                            complete: function() {

                                $('#modalHargaBiaya').modal('show');
                            }
                        });
                    }
                });
            } else {
                alert(response.message);
            }
        }
    });
}



function deleteHargaBiaya(id_harga_biaya) {

    $.ajax({
        url: '<?php echo base_url('biaya/deleteHargaBiaya'); ?>',
        type: 'POST',
        data: {
            id_harga_biaya: id_harga_biaya,
        },
        dataType: 'json',
        success: function(response) {
            if (response.status) {
                alert(response.message);
                tabelHargaBiaya();
            } else {
                alert(response.message);
            }
        }
    });
}

function setJenisBiaya(id_tahun_ajaran, id_jenis_biaya) {
    let url = '<?php echo base_url('biaya/option_jenis_biaya'); ?>';
    $('#id_jenis_biaya').load(url + '/' + id_tahun_ajaran, function() {
        $('#id_jenis_biaya').val(id_jenis_biaya);
    });
}


</script>
