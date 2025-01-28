$(document).ready(function () {
    // Load dropdown options
    $('.loadSelect').each(function () {
        let target = $(this).data('target');
        let url = baseClass + '/getOption_' + target;
        $(this).load(url);
    });

    // Initialize DataTables automatically
    $('.table').each(function () {
        const table = $(this);
        const target = table.data('target');
        const tableType = table.data('table-type') || 'manual';
        const url = `${baseClass}/table_${target}`;

        if (tableType === 'datatable') {
            // Automatically initialize DataTables
            const dataTableInstance = table.DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: url,
                    type: 'POST',
                    dataSrc: function (response) {
                        if (response.status) {
                            return response.data;
                        } else {
                            console.error('DataTables Error:', response.message);
                            return [];
                        }
                    },
                    error: function (xhr, error) {
                        console.error(`Error loading DataTables ${target}:`, error);
                    }
                },
                columns: getColumnsConfig(table), // Define columns dynamically
                responsive: true,
                autoWidth: false,
                lengthChange: true,
                pageLength: 10,
                dom: '<"row"<"col-md-6"l><"col-md-6"f>>rt<"row"<"col-md-6"i><"col-md-6"p>>',
                language: {
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    zeroRecords: "Tidak ada data ditemukan",
                    info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                    infoEmpty: "Data tidak tersedia",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    search: "Cari:",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: "Berikutnya",
                        previous: "Sebelumnya"
                    }
                }
            });

            // Save reference for refreshing later
            table.data('dataTableInstance', dataTableInstance);
        } else {
            // Manual table loading
            loadTabel(target);
        }
    });
});

// Function to refresh DataTable
function refreshDataTable(target) {
    const table = $(`#table_${target}`);
    const dataTableInstance = table.data('dataTableInstance');

    if (dataTableInstance) {
        dataTableInstance.ajax.reload(null, false); // Reload without resetting pagination
    } else {
        console.warn(`No DataTable instance found for target: ${target}`);
    }
}


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
    const table = $(`#table_${target}`)
    const url = `${baseClass}/table_${target}`;

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response.status) {
                generateTable(response.data, table);
            } else {
                const colSpan = table.find('thead th').length || 1; 
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
                
                row += `<td style="${style}">${index + 1}</td>`;
            } else if (key === "btn_aksi") {
                
                row += `
                <td style="${style}">
                    <button class="btn btn-primary btn-sm editBtn" data-target="${table.data('target')}" data-value="${item.id || ''}">Edit</button>
                    <button class="btn btn-danger btn-sm deleteBtn" data-target="${table.data('target')}" data-value="${item.id || ''}">Delete</button>
                </td>`; 
            

            } else {
                
                const value = item[key] || '-'; 
                row += `<td style="${style}">${value}</td>`;
            }
        });
        row += "</tr>";
        return row;
    }).join('');

    
    if (!rows) {
        const colSpan = $thead.length || 1;
        $tbody.html(`<tr><td colspan="${colSpan}" style="text-align:center;">Tidak ada data tersedia</td></tr>`);
    } else {
        $tbody.html(rows);
    }
}

$(document).on('click', '.editBtn', function () {
	let target = $(this).data('target');
	let id = $(this).data('value');
    console.log('Edit Target:', target, 'ID:', id); 
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
			}
		}
	});
});

$(document).on('click', '.deleteBtn', function () {
	let target = $(this).data('target');
	let id = $(this).data('value');
    console.log('Delete Target:', target, 'ID:', id); 
	console.log(target);
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

    
        
    $('.btnRefresh').on('click', function () {
        const target = $(this).data('target');
        const table = $(`#table_${target}`).DataTable();
        const url = `${baseClass}/table_${target}`;
        table.ajax.reload(null, false); 
    });
    
