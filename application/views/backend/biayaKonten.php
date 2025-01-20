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
				<div class="btn btn-primary addBtn mb-1" data-target="jenis_biaya">
					<i class="fas fa-plus"></i> Tambah
				</div>
				<div class="card">

					<table id="table_jenis_biaya" data-target="jenis_biaya" class="table table-striped table-bordered mt-2">
						<thead>
							<tr>
								<th data-key="no" style="text-align: center;">No</th>
								<th data-key="nama_jenis_biaya" style="text-align: center;">Jenis Biaya</th>
								<th data-key="status_jenis_biaya" style="text-align: center;">Status</th>
								<th data-key="btn_aksi" style="text-align: center;">Aksi</th>
							</tr>
						</thead>
						<tbody>
						</tbody>

					</table>
				</div>
			</div>
			<div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
				<div class="btn btn-primary addBtn mb-1" data-target="harga_biaya">
					<i class="fas fa-plus"></i> Tambah
				</div>
				<div class="card">

					<table id="table_harga_biaya" data-target="harga_biaya" class="table table-striped table-bordered mt-2">
						<thead>
							<tr>
								<th data-key="no" style="text-align: center;">No</th>
								<th data-key="nama_tahun_pelajaran" style="text-align: center;">Tahun Pelajaran</th>
								<th data-key="nama_jenis_biaya" style="text-align: center;">Jenis Biaya</th>
								<th data-key="harga_biaya" style="text-align: center;">Harga</th>
								<th data-key="btn_aksi" style="text-align: center;">Aksi</th>
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

<div class="modal" id="modal_jenis_biaya" tabindex=" -1" role="dialog">
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
					<form id="form_jenis_biaya" action="#" method="post" enctype="multipart/form-data">
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
				<button type="button" class="btn btn-primary saveBtn" data-target="jenis_biaya">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>


<div class="modal" id="modal_harga_biaya" tabindex=" -1" role="dialog">
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
					<form id="form_harga_biaya" action="#" method="post" enctype="multipart/form-data">
						<input type="hidden" class="form-control" id="id" name="id" value="">
						<div class="mb-1">
							<label for="tahun_pelajaran_id" class="form-label">Tahun Pelajaran</label>
							<select class="form-control loadSelect" data-target="tahun_pelajaran" name="tahun_pelajaran_id" id="tahun_pelajaran_id">
								<option value="">- Pilih Tahun Pelajaran -</option>
							</select>
							<div class="error-block"></div>
						</div>
						<div class="mb-1">
							<label for="jenis_biaya_id" class="form-label">Nama Jenis Biaya</label>
							<select class="form-control loadSelect" data-target="jenis_biaya" name="jenis_biaya_id" id="jenis_biaya_id">
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
				<button type="button" class="btn btn-primary saveBtn" data-target="harga_biaya">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url(); ?>public/lib/crud.js"></script>