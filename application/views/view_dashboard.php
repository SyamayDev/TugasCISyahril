<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<?php echo base_url('public/template/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<title>Dashboard</title>
</head>

<body>
	<div class="row justify-content-center">
		<div class="card col-md-8 mt-5">
			<div class="card-header">
				<h1>Halaman Dashboard</h1>
			</div>
			<div class="card-body">
				<div class="mb-3">
					<button type="button" class="btn btn-primary btnTambahUser">Tambah User</button>
					<a href="<?= base_url('dashboard/logout'); ?>" class="btn btn-danger">Logout</a>
				</div>
				<div class="table-responsive">
					<table class="table table-striped" id="tabelUser">
						<thead>
							<tr>
								<th>No</th>
								<th>Username</th>
								<th>Password</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<!-- Data akan dimuat menggunakan JavaScript -->
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="modal-user" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Tambah User</h5>
					<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="form-user">
						<input type="hidden" id="id" name="id" value="">
						<div class="mb-3">
							<label for="username" class="form-label">Username</label>
							<input type="text" class="form-control" id="username" name="username" value="">
						</div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control" id="password" name="password" value="">
                        </div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary saveBtn">Simpan</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>

	<script src="<?php echo base_url('public/template/js/bootstrap.bundle.min.js'); ?>"></script>
	<script src="<?php echo base_url('public/template/js/jquery-3.7.1.min.js'); ?>"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<script>
		$(document).ready(function () {
			tableUser();

			// Tombol Tambah User
			$('.btnTambahUser').on('click', function () {
				resetForm(); // Reset form saat membuka modal
				$('.modal-title').text('Tambah User'); // Set judul modal
				$('#modal-user').modal('show');
			});

			// Tombol Simpan Data
			$('.saveBtn').on('click', function () {
				let id = $('#id').val();
				let username = $('#username').val().trim();
				let password = $('#password').val().trim();

				// Validasi input
				if (!username || !password) {
					Swal.fire({
						icon: 'warning',
						title: 'Peringatan',
						text: 'Username dan Password tidak boleh kosong!'
					});
					return;
				}

				let url = id ? '<?php echo base_url("dashboard/update"); ?>' : '<?php echo base_url("dashboard/save"); ?>';

				$.ajax({
					url: url,
					type: 'POST',
					data: { id, username, password },
					dataType: 'json',
					success: function (response) {
						if (response.status) {
							Swal.fire({
								icon: 'success',
								title: 'Berhasil',
								text: response.message
							});
							$('#modal-user').modal('hide');
							tableUser();
						} else {
							Swal.fire({
								icon: 'error',
								title: 'Gagal',
								text: response.message
							});
						}
					}
				});
			});
		});

		function tableUser() {
			let tabelUser = $('#tabelUser');

			$.ajax({
				url: '<?php echo base_url("dashboard/tableUser"); ?>',
				type: 'GET',
				dataType: 'json',
				success: function (response) {
					tabelUser.find('tbody').html('');

					if (response.status) {
						let no = 1;
						$.each(response.data, function (i, item) {
							let tr = $('<tr>');
							tr.append('<td>' + no++ + '</td>');
							tr.append('<td>' + item.username + '</td>');
                            tr.append('<td>' + item.password + '</td>');

							let actionBtns = '';
							if (item.cannot_edit) {
								actionBtns = '<span class="text-danger">Tidak bisa diedit</span>';
							} else {
								actionBtns =
									'<button class="btn btn-primary" onclick="editUser(' + item.id + ')">Edit</button> ' +
									'<button class="btn btn-danger" onclick="confirmDelete(' + item.id + ')">Delete</button>';
							}

							tr.append('<td>' + actionBtns + '</td>');
							tabelUser.find('tbody').append(tr);
						});
					} else {
						tabelUser.find('tbody').append('<tr><td colspan="4" class="text-center">' + response.message + '</td></tr>');
					}
				}
			});
		}

		function editUser(id) {
			$.ajax({
				url: '<?php echo base_url("dashboard/edit"); ?>',
				type: 'POST',
				data: { id },
				dataType: 'json',
				success: function (response) {
					if (response.status) {
						resetForm();
						$('#id').val(response.data.id);
						$('#username').val(response.data.username);
						$('#password').val(''); // Kosongkan password untuk keamanan
						$('.modal-title').text('Edit User');
						$('#modal-user').modal('show');
					} else {
						Swal.fire({
							icon: 'error',
							title: 'Gagal',
							text: response.message
						});
					}
				}
			});
		}

		function confirmDelete(id) {
			Swal.fire({
				title: 'Apakah Anda yakin?',
				text: 'Data yang dihapus tidak dapat dikembalikan!',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#d33',
				cancelButtonColor: '#3085d6',
				confirmButtonText: 'Ya, hapus!'
			}).then((result) => {
				if (result.isConfirmed) {
					deleteUser(id);
				}
			});
		}

		function deleteUser(id) {
			$.ajax({
				url: '<?php echo base_url("dashboard/delete"); ?>',
				type: 'POST',
				data: { id },
				dataType: 'json',
				success: function (response) {
					if (response.status) {
						Swal.fire({
							icon: 'success',
							title: 'Berhasil',
							text: response.message
						});
						tableUser();
					} else {
						Swal.fire({
							icon: 'error',
							title: 'Gagal',
							text: response.message
						});
					}
				}
			});
		}

		function resetForm() {
			$('#id').val('');
			$('#username').val('');
			$('#password').val('');
		}

		
	</script>
</body>

</html>
