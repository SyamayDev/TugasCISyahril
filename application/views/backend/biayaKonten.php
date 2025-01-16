<div class="card card-primary card-tabs">
	<div class="card-header p-0 pt-1">
		<ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Jenis Biaya</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Harga Biaya</a>
			</li>

		</ul>
	</div>
	<div class="card-body">
		<div class="tab-content" id="custom-tabs-one-tabContent">
			<div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
				<div class="btn btn-primary btnTambahJenisBiaya mb-1">
					<i class="fas fa-plus"></i> Tambah
				</div>
				<div class="card">

					<table id="tableJenisBiaya" class="table table-striped table-bordered mt-2">
						<thead>
							<tr>
								<th style="text-align: center;">No</th>
								<th style="text-align: center;">Jenis Biaya</th>
								<th style="text-align: center;">Status</th>
								<th style="text-align: center;">Aksi</th>
							</tr>
						</thead>
						<tbody>
						</tbody>

					</table>
				</div>
			</div>
			<div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
				<div class="btn btn-primary btnTambahHargaBiaya mb-1">
					<i class="fas fa-plus"></i> Tambah
				</div>
				<div class="card">

					<table id="tableHargaBiaya" class="table table-striped table-bordered mt-2">
						<thead>
							<tr>
								<th style="text-align: center;">No</th>
								<th style="text-align: center;">Tahun Pelajaran</th>
								<th style="text-align: center;">Jenis Biaya</th>
								<th style="text-align: center;">Harga</th>
								<th style="text-align: center;">Aksi</th>
							</tr>
						</thead>
						<tbody>
						</tbody>

					</table>
				</div>
			</div>

		</div>
	</div>
	<!-- /.card -->
</div>

<div class="modal" id="modalJenisBiaya" tabindex=" -1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Jenis Biaya</h5>

				<button type="button" class="close " data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-user">
					<form id="formJenisBiaya" action="#" method="post" enctype="multipart/form-data">
						<input type="hidden" class="form-control" id="id" name="id" value="">

						<div class="mb-1">
							<label for="nama_jenis_biaya" class="form-label">Nama Jenis Biaya</label>
							<input type="text" class="form-control" id="nama_jenis_biaya" name="nama_jenis_biaya" value="">
							<div class="error-block"></div>
						</div>
						<div class="mb-1">
							<label for="status_jenis_biaya" class="form-label">Status</label>
							<select class="form-control" name="status_jenis_biaya" id="status_jenis_biaya">
								<option value="">- Pilih Status -</option>
								<option value="1">Aktif</option>
								<option value="0">Tidak Aktif</option>
							</select>
							<div class="error-block"></div>
						</div>


					</form>

					<div>

					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary saveBtn" id="saveJenisBiaya">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>


<div class="modal" id="modalHargaBiaya" tabindex=" -1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Harga Jenis Biaya</h5>

				<button type="button" class="close " data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-user">
					<form id="formHargaBiaya" action="#" method="post" enctype="multipart/form-data">
						<input type="hidden" class="form-control" id="id" name="id" value="">
						<div class="mb-1">
							<label for="tahun_pelajaran_id" class="form-label">Tahun Pelajaran</label>
							<select class="form-control" name="tahun_pelajaran_id" id="tahun_pelajaran_id">
								<option value="">- Pilih Tahun Pelajaran -</option>

							</select>
							<div class="error-block"></div>
						</div>


						<div class="mb-1">
							<label for="jenis_biaya_id" class="form-label">Nama Jenis Biaya</label>
							<select class="form-control" id="jenis_biaya_id" name="jenis_biaya_id">
								<option value="">- Pilih Jenis Biaya -</option>
							</select>
							<div class="error-block"></div>
						</div>
						<div class="mb-1">
							<label for="harga_biaya" class="form-label">Harga</label>
							<input type="text" class="form-control" name="harga_biaya" id="harga_biaya">

							<div class="error-block"></div>
						</div>


					</form>

					<div>

					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary saveBtn" id="saveHargaBiaya">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		tabelJenisBiaya();
		tabelHargaBiaya();
		$('#tahun_pelajaran_id').load('<?php echo base_url('biaya/getOptionTahunPelajaran'); ?>');
		$('#jenis_biaya_id').load('<?php echo base_url('biaya/getOptionJenisBiayaAktif'); ?>');

	});

	$('.btnTambahJenisBiaya').on('click', function() {
		resetFormJenisBiaya();
		$('#modalJenisBiaya').modal('show');
	});

	function resetFormJenisBiaya() {
		$('#id').val('');
		$('#nama_jenis_biaya').val('');
		$('#status_jenis_biaya').val('');
	}

	function tabelJenisBiaya() {
		let tabel = $('#tableJenisBiaya');
		let tr = '';
		$.ajax({
			url: '<?php echo base_url('biaya/table_jenis_biaya'); ?>',
			type: 'GET',

			dataType: 'json',
			success: function(response) {
				if (response.status) {
					tabel.find('tbody').html('');
					let no = 1;
					$.each(response.data, function(i, item) {
						tr = $('<tr>');

						tr.append('<td>' + no++ + '</td>');
						tr.append('<td>' + item.nama_jenis_biaya + '</td>');
						tr.append('<td>' + item.status_jenis_biaya + '</td>');


						tr.append('<td>	<button class="btn btn-primary" onclick="editJenisBiaya(' + item.id + ')">Edit</button> <button class="btn btn-danger" onclick="deleteJenisBiaya(' + item.id + ')">Delete</button></td>');
						tabel.find('tbody').append(tr);
					});

				} else {
					tr = $('<tr>');
					tabel.find('tbody').html('');
					tr.append('<td colspan="4">' + response.message + '</td>');
				}
			}
		});
	}

	$('#saveJenisBiaya').on('click', function() {
		var id = $('#id').val();

		let url = '<?php echo base_url('biaya/save_jenis_biaya'); ?>';
		var formData = new FormData($('#formJenisBiaya')[0]);
		$.ajax({
			url: url,
			type: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			dataType: 'json',
			success: function(response) {
				if (response.status) {
					alert(response.message);
					$('#modalJenisBiaya').modal('hide');
					tabelJenisBiaya();
				} else {
					alert(response.message);
				}
			}
		})
	});

	function editJenisBiaya(id) {
		$.ajax({
			url: '<?php echo base_url('biaya/edit_jenis_biaya'); ?>',
			type: 'post',
			data: {
				id: id,
			},
			dataType: 'json',
			success: function(response) {
				if (response.status) {
					$('#id').val(response.data.id);
					$('#nama_jenis_biaya').val(response.data.nama_jenis_biaya);
					$('#status_jenis_biaya').val(response.data.status_jenis_biaya);
					$('#modalJenisBiaya').modal('show');
				} else {
					alert(response.message);
				}
			}
		});
	}

	function deleteJenisBiaya(id) {
		$.ajax({
			url: '<?php echo base_url('biaya/delete_jenis_biaya'); ?>',
			type: 'POST',
			data: {
				id: id,
			},
			dataType: 'json',
			success: function(response) {
				if (response.status) {
					alert(response.message);
					tabelJenisBiaya();
				} else {
					alert(response.message);
				}
			}
		})
	}


	$('.btnTambahHargaBiaya').on('click', function() {
		resetFormHargaBiaya();
		$('#modalHargaBiaya').modal('show');
	});

	function resetFormHargaBiaya() {
		$('#id').val('');
		$('#tahun_pelajaran_id').val('');
		$('#jenis_biaya_id').val('');
		$('#harga_biaya').val('');
	}

	function tabelHargaBiaya() {
		let tabel = $('#tableHargaBiaya');
		let tr = '';
		$.ajax({
			url: '<?php echo base_url('biaya/table_harga_biaya'); ?>',
			type: 'GET',

			dataType: 'json',
			success: function(response) {
				if (response.status) {
					tabel.find('tbody').html('');
					let no = 1;
					$.each(response.data, function(i, item) {
						tr = $('<tr>');

						tr.append('<td>' + no++ + '</td>');
						tr.append('<td>' + item.nama_tahun_pelajaran + '</td>');
						tr.append('<td>' + item.nama_jenis_biaya + '</td>');
						tr.append('<td>' + item.harga_biaya + '</td>');

						tr.append('<td>	<button class="btn btn-primary" onclick="editHargaBiaya(' + item.id + ')">Edit</button> <button class="btn btn-danger" onclick="deleteHargaBiaya(' + item.id + ')">Delete</button></td>');
						tabel.find('tbody').append(tr);
					});

				} else {
					tr = $('<tr>');
					tabel.find('tbody').html('');
					tr.append('<td colspan="4">' + response.message + '</td>');
				}
			}
		});
	}
	$('#saveHargaBiaya').on('click', function() {
		var id = $('#id').val();
		var tahun_pelajaran_id = $('#tahun_pelajaran_id').val();
		var jenis_biaya_id = $('#jenis_biaya_id').val();
		var harga_biaya = $('#harga_biaya').val();
		let url = '<?php echo base_url('biaya/save_harga_biaya'); ?>';

		$.ajax({
			url: url,
			type: 'POST',
			data: {
				id: id,
				tahun_pelajaran_id: tahun_pelajaran_id,
				jenis_biaya_id: jenis_biaya_id,
				harga_biaya: harga_biaya
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
		})
	});

	function editHargaBiaya(id) {
		$.ajax({
			url: '<?php echo base_url('biaya/edit_harga_biaya'); ?>',
			type: 'post',
			data: {
				id: id,
			},
			dataType: 'json',
			success: function(response) {
				if (response.status) {
					$('#id').val(response.data.id);
					$('#tahun_pelajaran_id').val(response.data.tahun_pelajaran_id);
					$('#jenis_biaya_id').val(response.data.jenis_biaya_id);
					$('#harga_biaya').val(response.data.harga_biaya);
					$('#modalHargaBiaya').modal('show');
				} else {
					alert(response.message);
				}
			}
		});
	}

	function deleteHargaBiaya(id) {
		$.ajax({
			url: '<?php echo base_url('biaya/delete_harga_biaya'); ?>',
			type: 'POST',
			data: {
				id: id,
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
		})
	}
</script>