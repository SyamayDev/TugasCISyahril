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
			<div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
				<div class="btn btn-primary addBtn mb-1" data-target="jenis_seragam">
					<i class="fas fa-plus"></i> Tambah
				</div>
				<div class="card">

					<table id="table_jenis_seragam" data-target="jenis_seragam" data-value="" class="table table-striped table-bordered mt-2">
						<thead>
							<tr>
								<th data-key="no" style="text-align: center;">No</th>
								<th data-key="nama_jenis_seragam" style="text-align: center;">Jenis Seragam</th>
								<th data-key="btn_aksi" style="text-align: center;">Aksi</th>
							</tr>
						</thead>
						<tbody>
						</tbody>

					</table>
				</div>
			</div>
			<div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
				<div class="btn btn-primary addBtn mb-1" data-target="stok_seragam">
					<i class="fas fa-plus"></i> Tambah
				</div>
				<div class="card">

					<table id="table_stok_seragam" data-target="stok_seragam" class="table table-striped table-bordered mt-2">
						<thead>
							<tr>
								<th data-key="no" style="text-align: center;">No</th>
								<th data-key="nama_jenis_seragam" style="text-align: center;">Jenis Seragam</th>
								<th data-key="ukuran_seragam" style="text-align: center;">Ukuran</th>
								<th data-key="stok_seragam" style="text-align: center;">Stok</th>
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

<div class="modal" id="modal_jenis_seragam" tabindex=" -1" role="dialog">
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
					<form id="form_jenis_seragam" action="#" method="post" enctype="multipart/form-data">
						<input type="hidden" class="form-control" id="id" name="id" value="">

						<div class="mb-1">
							<label for="nama_jenis_seragam" class="form-label">Nama Jenis seragam</label>
							<input type="text" class="form-control" id="nama_jenis_seragam" name="nama_jenis_seragam" value="">
							<div class="error-block text-danger"></div>
						</div>
					</form>

					<div>

					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary saveBtn" data-target="jenis_seragam">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>


<div class="modal" id="modal_stok_seragam" tabindex=" -1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Stok Jenis Seragam</h5>

				<button type="button" class="close " data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-user">
					<form id="form_stok_seragam" action="#" method="post" enctype="multipart/form-data">
						<input type="hidden" class="form-control" id="id" name="id" value="">
						<div class="mb-1">
							<label for="jenis_seragam_id" class="form-label">Jenis Seragam</label>
							<select class="form-control loadSelect" data-target="jenis_seragam" name="jenis_seragam_id" id="jenis_seragam_id">
								<option value="">- Pilih Jenis Seragam -</option>
							</select>
							<div class="error-block text-danger"></div>
						</div>

						<div class="mb-1">
							<label for="ukuran_seragam" class="form-label">Ukuran</label>
							<select class="form-control" id="ukuran_seragam" name="ukuran_seragam">
								<option value="">- Pilih Ukuran -</option>
								<option value="S">S</option>
								<option value="M">M</option>
								<option value="L">L</option>
								<option value="XL">XL</option>
							</select>
							<div class="error-block text-danger"></div>
						</div>
						<div class="mb-1">
							<label for="stok_seragam" class="form-label">Stok Seragam</label>
							<input type="text" class="form-control" name="stok_seragam" id="stok_seragam">

							<div class="error-block text-danger"></div>
						</div>
					</form>
					<div>
					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary saveBtn" data-target="stok_seragam">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url(); ?>public/lib/crud.js"></script>