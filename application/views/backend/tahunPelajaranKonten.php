<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tahun Pelajaran</h3>
            </div>
            <div class="card-body">
                <button class="btn btn-primary addBtn mb-2" data-target="tahun_pelajaran">
                    <i class="fas fa-plus"></i> Tambah
                </button>
                <div class="row">
                    <table class="table table-striped" id="table_tahun_pelajaran" data-target="tahun_pelajaran">
                        <thead>
                            <tr>
                                <th data-key="no" style="text-align: center;">No</th>
                                <th data-key="nama_tahun_pelajaran" style="text-align: center;">Tahun Pelajaran</th>
                                <th data-key="tanggal_mulai" style="text-align: center;">Mulai</th>
                                <th data-key="tanggal_akhir" style="text-align: center;">Akhir</th>
                                <th data-key="status_tahun_pelajaran" style="text-align: center;">Status</th>
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

<div class="modal" id="modal_tahun_pelajaran" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Tahun Pelajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_tahun_pelajaran" action="#" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="id" name="id" value="">

                    <div class="mb-3">
                        <label for="nama_tahun_pelajaran" class="form-label">Nama Tahun Pelajaran</label>
                        <input type="text" class="form-control" id="nama_tahun_pelajaran" name="nama_tahun_pelajaran" required>
                        <div class="error-block text-danger"></div>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
                        <div class="error-block text-danger"></div>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" required>
                        <div class="error-block text-danger"></div>
                    </div>

                    <div class="mb-3">
                        <label for="status_tahun_pelajaran" class="form-label">Status</label>
                        <select class="form-control" id="status_tahun_pelajaran" name="status_tahun_pelajaran" required>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                        <div class="error-block text-danger"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary saveBtn" data-target="tahun_pelajaran">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>public/lib/crud.js"></script>

