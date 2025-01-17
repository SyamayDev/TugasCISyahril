$(document).ready(function () {
    let targets = ['jenis_biaya', 'harga_biaya', 'tahun_pelajaran', 'data_jurusan', 'data_kelas', 'jenis_seragam', 'stok_seragam'];
    targets.forEach(target => initTabel(target));

    $('.btnTambah').on('click', function () {
        let target = $(this).data('target');
        resetForm(target);
        $('#modal_' + target).modal('show');
    });

    $('.saveBtn').on('click', function () {
        let target = $(this).data('target');
        saveData(target);
    });

    $(document).on('click', '.btnHapus', function () {
        let target = $(this).data('target');
        let id = $(this).data('id');
        deleteData(id, target);
    });

    $(document).on('click', '.btnEdit', function () {
        let target = $(this).data('target');
        let id = $(this).data('id');
        editData(id, target);
    });
});

function resetForm(target) {
    $('#form_' + target)[0].reset();
    $('#form_' + target).find('.is-invalid').removeClass('is-invalid');
    $('#' + target + 'Id').val('');
}


function initTabel(target) {
    let tableBody = $('#tabel_' + target + ' tbody');
    $.ajax({
        url: base_url + target + '/get_' + target,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            tableBody.empty();
            if (response.status) {
                response.data.forEach(item => {
                    let row = `<tr>`;
                    Object.values(item).forEach(value => {
                        row += `<td>${value}</td>`;
                    });
                    row += `
                        <td>
                            <button class="btn btn-primary btnEdit" data-id="${item.id}" data-target="${target}">Edit</button>
                            <button class="btn btn-danger btnHapus" data-id="${item.id}" data-target="${target}">Hapus</button>
                        </td>
                    `;
                    row += `</tr>`;
                    tableBody.append(row);
                });
            } else {
                alert(response.message);
            }
        }
    });
}


function saveData(target) {
    let formData = new FormData($('#form_' + target)[0]);
    $.ajax({
        url: base_url + target + '/save_' + target,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (response) {
            if (response.status) {
                alert(response.message);
                $('#modal_' + target).modal('hide');
                initTabel(target);
            } else {
                alert(response.message);
                highlightFormErrors(response.errors, target);
            }
        }
    });
}

function editData(id, target) {
    $.ajax({
        url: base_url + target + '/get_' + target + '/' + id,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response.status) {
                let data = response.data;
                for (let key in data) {
                    $(`#${target}${key}`).val(data[key]);
                }
                $('#modal_' + target).modal('show');
            } else {
                alert(response.message);
            }
        }
    });
}

function deleteData(id, target) {
    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        $.ajax({
            url: base_url + target + '/delete_' + target + '/' + id,
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                if (response.status) {
                    alert(response.message);
                    initTabel(target);
                } else {
                    alert(response.message);
                }
            }
        });
    }
}

function highlightFormErrors(errors, target) {
    for (let field in errors) {
        let input = $(`#${target}${field}`);
        input.addClass('is-invalid');
        input.next('.invalid-feedback').text(errors[field]);
    }
}
