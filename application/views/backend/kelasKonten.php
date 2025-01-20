<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Data Kelas</h3>
			</div>
			<div class="card-body">
				<div class="btn btn-primary addBtn mb-2" data-target="kelas"> <i class="fas fa-plus"></i> Tambah</div>
				<div class="row">
					<table class="table table-striped" id="table_kelas" data-target="kelas">
						<thead>
							<tr>
								<th data-key="no" style="text-align: center;">No</th>
								<th data-key="nama_tahun_pelajaran" style="text-align: center;">Tahun Pelajaran</th>
								<th data-key="nama_jurusan" style="text-align: center;">Nama Jurusan</th>
								<th data-key="nama_kelas" style="text-align: center;">Nama Kelas</th>
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
</div>

<div class="modal" id="modal_kelas" tabindex=" -1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Kelas</h5>

				<button type="button" class="close " data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-user">
					<form id="form_kelas" action="#" method="post" enctype="multipart/form-data">
						<input type="hidden" class="form-control" id="id" name="id" value="">
						<div class="mb-1">
							<label for="nama_tahun_pelajaran" class="form-label">Nama Tahun Pelajaran</label>
							<select class="form-control loadSelect"  data-target="tahun_pelajaran" name="tahun_pelajaran" id="tahun_pelajaran">
								<option value="">- Pilih Tahun Pelajaran -</option>
							</select>
							<div class="error-block text-danger"></div>
						</div>
						<div class="mb-1">
							<label for="jurusan" class="form-label chainedSelect" data-target="jurusan" data-parent="tahun_pelajaran" data-url="<?= base_url('kelas/getOption_jurusan') ?>">Nama Jurusan</label>
							<select class="form-control" name="id_jurusan" id="jurusan">
								<option value="">- Pilih Jurusan -</option>
							</select>
							<div class="error-block text-danger"></div>
						</div>
						<div class="mb-1">
							<label for="nama_kelas" class="form-label">Nama Kelas</label>
							<input type="text" class="form-control" id="nama_kelas" name="nama_kelas" value="">
							<div class="error-block text-danger"></div>
						</div>
					</form>

					<div>

					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary saveBtn" data-target="kelas">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>



<script src="<?php echo base_url(); ?>public/lib/crud.js"></script>
<script src="<?php echo base_url(); ?>public/lib/chainedSelect.js"></script>