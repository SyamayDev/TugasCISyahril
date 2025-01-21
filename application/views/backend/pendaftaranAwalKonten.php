<div class="card card-primary card-tabs">
	<div class="card-header p-0 pt-1">
		<ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Data Kelas</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Data Siswa</a>
			</li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-message-tab" data-toggle="pill" href="#custom-tabs-one-message" role="tab" aria-controls="custom-tabs-one-message" aria-selected="false">Data Orang Tua</a>
            </li>
		</ul>
	</div>
	<div class="card-body">
		<div class="tab-content" id="custom-tabs-one-tabContent">
			<div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
				<div class="btn btn-primary addBtn mb-1" data-target="pendaftaran_awal">
					<i class="fas fa-plus"></i> Tambah
				</div>
				<div class="card">
					<table id="table_pendaftaran_awal_kelas" data-aksi="pendaftaran_awal" data-target="pendaftaran_awal_kelas" data-value="" class="table table-striped table-bordered mt-2">
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
			<div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
            <div class="btn btn-primary addBtn mb-1" data-target="pendaftaran_awal">
					<i class="fas fa-plus"></i> Tambah
				</div>
                <div class="card">
                    <div style="overflow-x: auto;">
                    <table id="table_pendaftaran_awal_siswa" data-target="pendaftaran_awal_siswa" data-value="" class="table table-striped table-bordered mt-2" style="width: 100%; font-size: 13px;">
                            <thead>
                                <tr>
                                    <th data-key="no" style="width: 5%; text-align: center;">No</th>
                                    <th data-key="nama_siswa" style="width: 15%; text-align: center;">Nama</th>
                                    <th data-key="nik" style="width: 10%; text-align: center;">NIK</th>
                                    <th data-key="agama" style="width: 10%; text-align: center;">Agama</th>
                                    <th data-key="nisn" style="width: 10%; text-align: center;">NISN</th>
                                    <th data-key="jenis_kelamin" style="width: 10%; text-align: center;">Jenis Kelamin</th>
                                    <th data-key="tempat_lahir" style="width: 10%; text-align: center;">Tempat Lahir</th>
                                    <th data-key="tanggal_lahir" style="width: 10%; text-align: center;">Tanggal Lahir</th>
                                    <th data-key="alamat" style="width: 20%; text-align: center;">Alamat</th>
                                    <th data-key="no_telepon" style="width: 15%; text-align: center;">No Telepon</th>
                                    <th data-key="email" style="width: 15%; text-align: center;">Email</th>
                                    <th data-key="asal_sekolah" style="width: 15%; text-align: center;">Asal Sekolah</th>
                                    <th data-key="btn_aksi" style="width: 15%; text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
			</div>
            <div class="tab-pane fade" id="custom-tabs-one-message" role="tabpanel" aria-labelledby="custom-tabs-one-message-tab">
            <div class="btn btn-primary addBtn mb-1" data-target="pendaftaran_awal">
					<i class="fas fa-plus"></i> Tambah
				</div>
                <div class="card">
                    <div style="overflow-x: auto;">
                        <table id="table_pendaftaran_awal_orangtua" data-target="pendaftaran_awal_orangtua" class="table table-striped table-bordered mt-2" style="width: 100%; font-size: 14px;">
                            <thead>
                                <tr>
                                    <th data-key="no" style="width: 5%; text-align: center;">No</th>
                                    <th data-key="nama_ayah" style="width: 15%; text-align: center;">Nama Ayah</th>
                                    <th data-key="nama_ibu" style="width: 15%; text-align: center;">Nama Ibu</th>
                                    <th data-key="no_telepon_ayah" style="width: 15%; text-align: center;">No Telepon Ayah</th>
                                    <th data-key="no_telepon_ibu" style="width: 15%; text-align: center;">No Telepon Ibu</th>
                                    <th data-key="pekerjaan_ayah" style="width: 15%; text-align: center;">Pekerjaan Ayah</th>
                                    <th data-key="pekerjaan_ibu" style="width: 15%; text-align: center;">Pekerjaan Ibu</th>
                                    <th data-key="nama_wali" style="width: 15%; text-align: center;">Nama Wali</th>
                                    <th data-key="no_telepon_wali" style="width: 15%; text-align: center;">No Telepon Wali</th>
                                    <th data-key="pekerjaan_wali" style="width: 15%; text-align: center;">Pekerjaan Wali</th>
                                    <th data-key="alamat" style="width: 20%; text-align: center;">Alamat</th>
                                    <th data-key="sumber_informasi" style="width: 20%; text-align: center;">Sumber Informasi</th>
                                    <th data-key="btn_aksi" style="width: 10%; text-align: center;">Aksi</th>
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
	<!-- /.card -->
</div>

<div class="modal fade" id="modal_pendaftaran_awal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pendaftaran Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Body -->
            <div class="modal-body">
                <form id="form_pendaftaran_awal">
                    <div class="card">
                        <div class="card-body">
                            <!-- Data Kelas -->
                            <div class="form-section active" id="section-kelas" style="display: block;">
                                <h5 class="text-center">Data Kelas</h5>
                                <input type="hidden" class="form-control" id="id" name="id" value="">
                                <div class="mb-1">
                                    <label for="nama_tahun_pelajaran" class="form-label">Nama Tahun Pelajaran</label>
                                    <select class="form-control loadSelect" data-target="tahun_pelajaran" name="id_tahun_pelajaran" id="tahun_pelajaran">
                                        <option value="">- Pilih Tahun Pelajaran -</option>
                                    </select>
                                    <div class="error-block text-danger"></div>
                                </div>

                                <div class="mb-1">
                                    <label for="jurusan" class="form-label chainedSelect" data-target="jurusan" data-parent="tahun_pelajaran" data-url="<?= base_url('Pendaftaran_awal/getOption_jurusan') ?>">Nama Jurusan</label>
                                    <select class="form-control" name="id_jurusan" id="jurusan">
                                        <option value="">- Pilih Jurusan -</option>
                                    </select>
                                    <div class="error-block text-danger"></div>
                                </div>

                                <div class="mb-1">
                                    <label for="kelas" class="form-label chainedSelect" data-target="kelas" data-parent="jurusan" data-url="<?= base_url('Pendaftaran_awal/getOption_kelas') ?>">Nama Kelas</label>
                                    <select class="form-control" name="id_kelas" id="kelas">
                                        <option value="">- Pilih Kelas -</option>
                                    </select>
                                    <div class="error-block text-danger"></div>
                                </div>
                            </div>

                            <!-- Data Siswa -->
                            <div class="form-section" id="section-siswa" style="display: none;">
                                <h5>Data Siswa</h5>
                                <div class="form-group">
                                    <label for="nama_siswa">Nama Siswa</label>
                                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" required>
                                    <div class="error-block text-danger"></div>
                                </div>
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="text" class="form-control" id="nik" name="nik" required>
                                    <div class="error-block text-danger"></div>
                                </div>
                                <div class="form-group">
                                    <label for="agama">Agama</label>
                                    <input type="text" class="form-control" id="agama" name="agama" required>
                                    <div class="error-block text-danger"></div>
                                </div>
                                <div class="form-group">
                                    <label for="nisn">NISN</label>
                                    <input type="text" class="form-control" id="nisn" name="nisn" required>
                                    <div class="error-block text-danger"></div>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    <div class="error-block text-danger"></div>
                                </div>
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                                    <div class="error-block text-danger"></div>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                                    <div class="error-block text-danger"></div>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" required>
                                    <div class="error-block text-danger"></div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                    <div class="error-block text-danger"></div>
                                </div>
                                <div class="form-group">
                                    <label for="no_telepon">No Telepon</label>
                                    <input type="text" class="form-control" id="no_telepon" name="no_telepon" required>
                                    <div class="error-block text-danger"></div>
                                </div>
                                <div class="form-group">
                                    <label for="asal_sekolah">Asal Sekolah</label>
                                    <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" required>
                                    <div class="error-block text-danger"></div>
                                </div>
                            </div>

                            <!-- Data Orangtua -->
                            <div class="form-section" id="section-orangtua" style="display: none;">
                                <h5>Data Orangtua</h5>
                                <div class="form-group">
                                    <label for="nama_ayah">Nama Ayah</label>
                                    <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" required>
                                    <div class="error-block text-danger"></div>
                                </div>
                                <div class="form-group">
                                    <label for="nama_ibu">Nama Ibu</label>
                                    <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" required>
                                    <div class="error-block text-danger"></div>
                                </div>
                                <div class="form-group">
                                    <label for="no_telepon_ayah">No Telepon Ayah</label>
                                    <input type="text" class="form-control" id="no_telepon_ayah" name="no_telepon_ayah" required>
                                    <div class="error-block text-danger"></div>
                                </div>
                                <div class="form-group">
                                    <label for="no_telepon_ibu">No Telepon Ibu</label>
                                    <input type="text" class="form-control" id="no_telepon_ibu" name="no_telepon_ibu" required>
                                    <div class="error-block text-danger"></div>
                                </div>
                                <div class="form-group">
                                    <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                                    <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" required>
                                    <div class="error-block text-danger"></div>
                                </div>
                                <div class="form-group">
                                    <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                                    <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" required>
                                    <div class="error-block text-danger"></div>
                                </div>
                                <div class="form-group">
                                    <label for="nama_wali">Nama Wali</label>
                                    <input type="text" class="form-control" id="nama_wali" name="nama_wali" required>
                                    <div class="error-block text-danger"></div>
                                </div>
                                <div class="form-group">
                                    <label for="no_telepon_wali">No Telepon Wali</label>
                                    <input type="text" class="form-control" id="no_telepon_wali" name="no_telepon_wali" required>
                                    <div class="error-block text-danger"></div>
                                </div>
                                <div class="form-group">
                                    <label for="pekerjaan_wali">Pekerjaan Wali</label>
                                    <input type="text" class="form-control" id="pekerjaan_wali" name="pekerjaan_wali" required>
                                    <div class="error-block text-danger"></div>
                                </div>
                                <div class="form-group">
                                    <label for="alamat_wali">Alamat Wali</label>
                                    <input type="text" class="form-control" id="alamat_wali" name="alamat_wali" required>
                                    <div class="error-block text-danger"></div>
                                </div>
                                <div class="form-group">
                                    <label for="sumber_informasi">Sumber Informasi</label>
                                    <select class="form-control" id="sumber_informasi" name="sumber_informasi" required>
                                        <option value="website">Website</option>
                                        <option value="sosmed">Sosial Media</option>
                                        <option value="kerabat">Kerabat</option>
                                        <option value="spanduk">Spanduk</option>
                                        <option value="flyer">Flyer</option>
                                        <option value="acara_sekolah">Acara Sekolah</option>
                                    </select>
                                    <div class="error-block text-danger"></div>
                                </div>
                            </div>

                            <!-- Navigation Buttons -->
                            <div class="form-navigation mt-3">
                                <button type="button" class="btn btn-secondary" id="prevBtn" disabled>Back</button>
                                <button type="button" class="btn btn-primary" id="nextBtn">Next</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary saveBtn" data-target="pendaftaran_awal">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    let currentSection = 0;
    const formSections = document.querySelectorAll('.form-section');

    function hideAllSections() {
        formSections.forEach(section => {
            section.style.display = 'none';
        });
    }

    function showSection(index) {
        hideAllSections();
        formSections[index].style.display = 'block';
    }

    function nextSection() {
        if (currentSection < formSections.length - 1) {
            currentSection++;
            showSection(currentSection);
        }
        updateButtonState();
    }

    function prevSection() {
        if (currentSection > 0) {
            currentSection--;
            showSection(currentSection);
        }
        updateButtonState();
    }

    function updateButtonState() {
        document.getElementById('prevBtn').disabled = currentSection === 0;
        document.getElementById('nextBtn').disabled = currentSection === formSections.length - 1;
    }

    document.getElementById('nextBtn').addEventListener('click', nextSection);
    document.getElementById('prevBtn').addEventListener('click', prevSection);

    showSection(currentSection); // Initialize the first section
</script>

<script src="<?php echo base_url(); ?>public/lib/crud2.js"></script>
<script src="<?php echo base_url(); ?>public/lib/chainedSelect.js"></script>