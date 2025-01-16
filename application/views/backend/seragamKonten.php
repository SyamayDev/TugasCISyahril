<div class="card card-primary card-tabs">
<div class="card-header p-0 pt-1">
		<ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Jenis Seragam</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Stok Seragam</a>
			</li>
		</ul>
	</div>
	<div class="card-body">
		<div class="tab-content" id="custom-tabs-one-tabContent">
      <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
          <div class="btn btn-primary btnTambahStokSeragam mb-1">
            <i class="fas fa-plus"></i> Tambah
          </div>
          <div class="card">

                    <!-- Tabel Stok Seragam -->
					<table id="tableStokSeragam" class="table table-striped table-bordered mt-2">
						<thead>
							<tr>
								<th style="text-align: center;">No</th>
								<th style="text-align: center;">Jenis Seragam</th>
								<th style="text-align: center;">Ukuran</th>
								<th style="text-align: center;">Stok</th>
								<th style="text-align: center;">Aksi</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>


			<div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
				<div class="btn btn-primary btnTambahJenisSeragam mb-1">
					<i class="fas fa-plus"></i> Tambah
				</div>
				<div class="card">


                    <!-- Tabel Jenis Seragam -->
                    <table id="tableJenisSeragam" class="table table-striped table-bordered mt-2">
              <thead>
                <tr>
                  <th style="text-align: center;">No</th>
                  <th style="text-align: center;">Jenis Seragam</th>
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
</div>

<!-- Modal Jenis Seragam -->
<div class="modal" id="modalJenisSeragam" tabindex=" -1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Jenis Seragam</h5>

				<button type="button" class="close " data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-user">
					<form id="formJenisSeragam" action="#" method="post" enctype="multipart/form-data">
						<input type="hidden" class="form-control" id="id" name="id" value="">

						<div class="mb-1">
							<label for="nama_jenis_seragam" class="form-label">Nama Jenis Seragam</label>
							<input type="text" class="form-control" id="nama_jenis_seragam" name="nama_jenis_seragam" value="">
							<div class="error-block"></div>
						</div>

					</form>

					<div>

					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary saveBtn" id="saveJenisSeragam">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>


<div class="modal" id="modalStokSeragam" tabindex=" -1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Stok Seragam</h5>

				<button type="button" class="close " data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-user">
					<form id="formStokSeragam" action="#" method="post" enctype="multipart/form-data">
						<input type="hidden" class="form-control" id="id" name="id" value="">

						<div class="mb-1">
							<label for="jenis_seragam_id" class="form-label">Nama Jenis Seragam</label>
							<select class="form-control" id="jenis_seragam_id" name="jenis_seragam_id">
								<option value="">- Pilih Jenis Seragam -</option>
							</select>
							<div class="error-block"></div>
						</div>
            				<div class="mb-1">
							<label for="ukuran_seragam" class="form-label">Ukuran</label>
							<select class="form-control" id="ukuran_seragam" name="ukuran_seragam">
								<option value="">- Pilih Ukuran -</option>
								<option value="S">S</option>
								<option value="M">M</option>
								<option value="L">L</option>
								<option value="XL">XL</option>
								<option value="XXL">XXL</option>
								<option value="XXXL">XXXL</option>
							</select>
							<div class="error-block"></div>
						</div>
            				<div class="mb-1">
							<label for="stok_seragam" class="form-label">Stok</label>
							<input type="text" class="form-control" name="stok_seragam" id="stok_seragam">
							<div class="error-block"></div>
						</div>
					</form>

					<div>

					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary saveBtn" id="saveStokSeragam">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		tabelJenisSeragam();
		tabelStokSeragam();
		$('#jenis_seragam_id').load('<?php echo base_url('seragam/getOptionJenisSeragam/'); ?>');

	});

	$('.btnTambahJenisSeragam').on('click', function() {
		$('#modalJenisSeragam').modal('show');
	});

	function tabelJenisSeragam() {
		let tabel = $('#tableJenisSeragam');
		let tr = '';
		$.ajax({
			url: '<?php echo base_url('seragam/table_jenis_seragam'); ?>',
			type: 'GET',

			dataType: 'json',
			success: function(response) {
				if (response.status) {
					tabel.find('tbody').html('');
					let no = 1;
					$.each(response.data, function(i, item) {
						tr = $('<tr>');

						tr.append('<td>' + no++ + '</td>');
						tr.append('<td>' + item.nama_jenis_seragam + '</td>');

						tr.append('<td>	<button class="btn btn-primary" onclick="editJenisSeragam(' + item.id + ')">Edit</button> <button class="btn btn-danger" onclick="deleteJenisSeragam(' + item.id + ')">Delete</button></td>');
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

	$('#saveJenisSeragam').on('click', function() {
		var id = $('#id').val();

		let url = '<?php echo base_url('seragam/save_jenis_seragam'); ?>';
		var formData = new FormData($('#formJenisSeragam')[0]);
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
					$('#modalJenisSeragam').modal('hide');
					tabelJenisSeragam();
				} else {
					alert(response.message);
				}
			}
		})
	});

	function editJenisSeragam(id) {
		$.ajax({
			url: '<?php echo base_url('seragam/edit_jenis_seragam'); ?>',
			type: 'post',
			data: {
				id: id,
			},
			dataType: 'json',
			success: function(response) {
				if (response.status) {
					$('#id').val(response.data.id);
					$('#nama_jenis_seragam').val(response.data.nama_jenis_seragam);
					$('#modalJenisSeragam').modal('show');
				} else {
					alert(response.message);
				}
			}
		});
	}

  function deleteJenisSeragam(id) {
		$.ajax({
			url: '<?php echo base_url('seragam/delete_jenis_seragam'); ?>',
			type: 'POST',
			data: {
				id: id,
			},
			dataType: 'json',
			success: function(response) {
				if (response.status) {
					alert(response.message);
					tabelJenisSeragam();
				} else {
					alert(response.message);
				}
			}
		})
	}



	$('.btnTambahStokSeragam').on('click', function() {
		$('#modalStokSeragam').modal('show');
	});

	function tabelStokSeragam() {
		let tabel = $('#tableStokSeragam');
		let tr = '';
		$.ajax({
			url: '<?php echo base_url('seragam/table_stok_seragam'); ?>',
			type: 'GET',

			dataType: 'json',
			success: function(response) {
				if (response.status) {
					tabel.find('tbody').html('');
					let no = 1;
					$.each(response.data, function(i, item) {
						tr = $('<tr>');

						tr.append('<td>' + no++ + '</td>');
						tr.append('<td>' + item.nama_jenis_seragam + '</td>');
						tr.append('<td>' + item.ukuran_seragam + '</td>');
						tr.append('<td>' + item.stok_seragam + '</td>');


						tr.append('<td>	<button class="btn btn-primary" onclick="editStokSeragam(' + item.id + ')">Edit</button> <button class="btn btn-danger" onclick="deleteStokSeragam(' + item.id + ')">Delete</button></td>');
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
	$('#saveStokSeragam').on('click', function() {
		var id = $('#id').val();
		var jenis_seragam_id = $('#jenis_seragam_id').val();
		var ukuran_seragam = $('#ukuran_seragam').val();
    var stok_seragam = $('#stok_seragam').val();
		let url = '<?php echo base_url('seragam/save_stok_seragam'); ?>';

		$.ajax({
			url: url,
			type: 'POST',
			data: {
				id: id,
				jenis_seragam_id: jenis_seragam_id,
        		ukuran_seragam: ukuran_seragam,
				stok_seragam: stok_seragam
			},
			dataType: 'json',
			success: function(response) {
				if (response.status) {
					alert(response.message);
					$('#modalStokSeragam').modal('hide');
					tabelStokSeragam();

				} else {
					alert(response.message);
				}
			}
		})
	});

	function editStokSeragam(id) {
		$.ajax({
			url: '<?php echo base_url('seragam/edit_stok_seragam'); ?>',
			type: 'post',
			data: {
				id: id,
			},
			dataType: 'json',
			success: function(response) {
				if (response.status) {
					$('#id').val(response.data.id);
					$('#jenis_seragam_id').val(response.data.jenis_seragam_id);
					$('#ukuran_seragam').val(response.data.ukuran_seragam);
          			$('#stok_seragam').val(response.data.stok_seragam);
					$('#modalStokSeragam').modal('show');
				} else {
					alert(response.message);
				}
			}
		});
	}

	function deleteStokSeragam(id) {
		$.ajax({
			url: '<?php echo base_url('seragam/delete_stok_seragam'); ?>',
			type: 'POST',
			data: {
				id: id,
			},
			dataType: 'json',
			success: function(response) {
				if (response.status) {
					alert(response.message);
					tabelStokSeragam();
				} else {
					alert(response.message);
				}
			}
		})
	}

</script>