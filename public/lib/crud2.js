$(document).ready(function () {
	
	$('.loadSelect').each(function () {
		let target = $(this).data('target');
		let url = baseClass + '/getOption_' + target;
		$(this).load(url);
	})
	$('.table').each(function () {
		let target = $(this).data('target');
		loadTabel(target);
	});
});

$('.addBtn').on('click', function () {
	let target = $(this).data('target');
	let form = '#form_' + target;
	$(form + ' input[type = "hidden"]').val('');
	$(form)[0].reset();
	$('#modal_' + target).modal('show');
});

$('.saveBtn').on('click', function () {
    let target = $(this).data('target');
    let url = baseClass + '/save_' + target;
    let formData = new FormData($('#form_' + target)[0]);

    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (response) {
            if (response.status) {
                alert(response.message);
                $('#modal_' + target).modal('hide');
                loadTabel(target);
            } else {
                
                $('.error-block').text('');
                
                
                $.each(response.error, function (key, val) {
                    $(`#${key}`).siblings('.error-block').text(val);
                });
            }
        }
    });
});

function loadTabel(target) {
    const table = $(`#table_${target}`);
    const url = `${baseClass}/table_${target}`;

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response.status) {
                generateTable(response.data, table);
            } else {
                const colSpan = table.find('thead th').length || 1; // Default colSpan jika tidak ada <th>
                const messageRow = `<tr><td colspan="${colSpan}" style="text-align:center;"><h4>${response.message}</h4></td></tr>`;
                table.find('tbody').html(messageRow);
            }
        },
        error: function (xhr, status, error) {
            console.error(`Error loading table ${target}:`, error);
        }
    });
}

function generateTable(data, table) {
    const $thead = table.find('thead th');
    const $tbody = table.find('tbody');
    const rows = data.map((item, index) => {
        let row = "<tr>";
        $thead.each(function () {
            const key = $(this).data('key');
            const style = $(this).attr('style') || '';
            if (key === "no") {
                // Kolom nomor otomatis
                row += `<td style="${style}">${index + 1}</td>`;
            } else if (key === "btn_aksi") {
                // Kolom aksi
                row += `
                    <td style="${style}">
                        <button class="btn btn-primary btn-sm editBtn" data-value="${item.id || ''}">Edit</button>
                        <button class="btn btn-danger btn-sm deleteBtn" data-value="${item.id || ''}">Delete</button>
                    </td>`;

            } else {
                // Data lainnya
                const value = item[key] || '-'; // Nilai default jika tidak ada
                row += `<td style="${style}">${value}</td>`;
            }
        });
        row += "</tr>";
        return row;
    }).join('');

    // Jika data kosong, tambahkan baris informasi
    if (!rows) {
        const colSpan = $thead.length || 1;
        $tbody.html(`<tr><td colspan="${colSpan}" style="text-align:center;">Tidak ada data tersedia</td></tr>`);
    } else {
        $tbody.html(rows);
    }
}



$(document).on('click', '.editBtn', function () {
    let target = $('#table_pendaftaran_awal_kelas').data('aksi');
	let id = $(this).data('value');
	console.log(target);
    let url = baseClass + '/edit_' + target + '/' + id;
	let form = '#form_' + target;
	$.ajax({
		url: url,
		type: 'GET',
		dataType: 'json',
		success: function (response) {
			if (response.status) {
				$.each(response.data, function (i, item) {
					$(form + ' [name="' + i + '"]').val(item);
				});
				$('#modal_' + target).modal('show');
			} else {
				alert(response.message);
                loadTabel(target);
			}
		}
	});
});



$(document).on('click', '.deleteBtn', function () {
    let target = $('#table_pendaftaran_awal_kelas').data('aksi');
	let id = $(this).data('value');
	let url = baseClass + '/delete_' + target + '/' + id;
	let form = '#form_' + target;
	$.ajax({
		url: url,
		type: 'GET',
		dataType: 'json',
		success: function (response) {
			if (response.status) {
				alert(response.message);
				loadTabel(target);
			} else {
				alert(response.message);
                loadTabel(target);
			}
		}
	});
})

    
    $(document).on('hidden.bs.modal', '.modal', function () {
        const $form = $(this).find('form');
        if ($form.length) {
            $form[0].reset(); 
            $form.find('.error-block').text(''); 
        }
    });


