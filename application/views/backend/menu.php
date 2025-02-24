<li class="nav-item">
	<a href="<?php echo base_url('admin') ?>" class="nav-link">
		<i class="nav-icon fas fa-tachometer-alt"></i>
		<p>
			Dashboard
		</p>
	</a>
</li>
<li class="nav-item">
	<a href="#" class="nav-link">
		<i class="nav-icon fas fa-th"></i>
		<p>
			Master Data
			<i class="right fas fa-angle-left"></i>
		</p>
	</a>
	<ul class="nav nav-treeview ml-3">
		<li class="nav-item">
			<a href="<?php echo base_url('tahun_pelajaran') ?>" class="nav-link">
				<i class="fas fa-calendar-alt nav-icon"></i>
				<p>Data Tahun Pelajaran</p>
			</a>
		</li>
		<li class="nav-item">
			<a href="<?= base_url('jurusan') ?>" class="nav-link">
				<i class="fas fa-book nav-icon"></i>
				<p>Data Jurusan</p>
			</a>
		</li>
		<li class="nav-item">
			<a href="<?= base_url('kelas') ?>" class="nav-link">
				<i class="fas fa-chalkboard nav-icon"></i>
				<p>Data Kelas</p>
			</a>
		</li>
		<li class="nav-item">
			<a href="<?= base_url('biaya') ?>" class="nav-link">
				<i class="fas fa-dollar-sign nav-icon"></i>
				<p>Data Biaya</p>
			</a>
		</li>
		<li class="nav-item">
			<a href="<?= base_url('seragam') ?>" class="nav-link">
				<i class="fas fa-tshirt nav-icon"></i>
				<p>Data Seragam</p>
			</a>
		</li>
	</ul>
</li>

<li class="nav-item">
	<a href="#" class="nav-link">
		<i class="nav-icon fas fa-edit"></i>
		<p>
			Pendaftaran
			<i class="right fas fa-angle-left"></i>
		</p>
	</a>
	<ul class="nav nav-treeview ml-3">
		<li class="nav-item">
			<a href="<?php echo base_url('pendaftaran_awal') ?>" class="nav-link">
				<i class="fas fa-user-plus nav-icon"></i>
				<p>Pendaftaran Awal</p>
			</a>
		</li>
		<li class="nav-item">
			<a href="<?= base_url('pendaftaran_ulang') ?>" class="nav-link">
				<i class="fas fa-user-check nav-icon"></i>
				<p>Pendaftaran Ulang</p>
			</a>
		</li>
		<li class="nav-item">
			<a href="<?= base_url('pembatalan_pendaftaran') ?>" class="nav-link">
				<i class="fas fa-user-times nav-icon"></i>
				<p>Pembatalan Daftar</p>
			</a>
		</li>
	</ul>
</li>

<li class="nav-item">
	<a href="<?php echo base_url('dashboard') ?>" class="nav-link">
		<i class="nav-icon fas fa-users "></i>
		<p>
			Akun Pengguna
		</p>
	</a>
</li>

<li class="nav-item">
	<a href="<?php echo base_url('login/logout') ?>" class="nav-link">
		<i class="nav-icon fas fa-sign-out-alt"></i>
		<p>
			Keluar
		</p>
	</a>
</li>