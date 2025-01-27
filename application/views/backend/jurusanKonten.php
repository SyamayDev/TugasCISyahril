<div class="card card-primary card-tabs">
	<div class="card-header p-0 pt-1">
		<ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Jurusan</a>
			</li>
		</ul>
	</div>
	<div class="card-body">
		<div class="tab-content" id="custom-tabs-one-tabContent">
			<div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
				<div class="btn btn-primary addBtn mb-1" data-target="jurusan">
					<i class="fas fa-plus"></i> Tambah
				</div>
				<div class="btn btn-secondary btnRefresh mb-2" data-target="jurusan">
					<i class="fas fa-sync"></i> Refresh
				</div>
				<div class="card">
                <table class="table table-striped" id="table_jurusan" data-target="jurusan">
                        <thead>
                            <tr>
                                <th style="width: 5%"><input type="checkbox" id="check-all"></th>
                                <th data-key="no" style="text-align: center;">No</th>
                                <th data-key="nama_tahun_pelajaran" style="text-align: center;">Tahun Pelajaran</th>
                                <th data-key="nama_jurusan" style="text-align: center;">Nama Jurusan</th>
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

<div class="modal" id="modal_jurusan" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_jurusan" action="#" method="post" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" id="Jurusanid" name="id" value="">

                    <div class="mb-3">
                        <label for="id_tahun_pelajaran" class="form-label">Nama Tahun Pelajaran</label>
                        <select class="form-control loadSelect" data-target="tahun_pelajaran" name="id_tahun_pelajaran" id="id_tahun_pelajaran">
                            <option value="">- Pilih Tahun Pelajaran -</option>
                        </select>
                        <div class="error-block text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="nama_jurusan" class="form-label">Nama Jurusan</label>
                        <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" value="">
                        <div class="error-block text-danger"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary saveBtn" data-target="jurusan">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>public/lib/crud.js"></script>
