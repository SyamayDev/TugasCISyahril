-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 21 Jan 2025 pada 22.11
-- Versi server: 8.0.30
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `belajar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_jurusan`
--

CREATE TABLE `data_jurusan` (
  `id` int NOT NULL,
  `id_tahun_pelajaran` int NOT NULL,
  `nama_jurusan` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `data_jurusan`
--

INSERT INTO `data_jurusan` (`id`, `id_tahun_pelajaran`, `nama_jurusan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 1, 'RPL', '2025-01-14 13:20:31', '2025-01-14 13:20:31', 0),
(5, 1, 'TKJ', '2025-01-14 13:21:18', '2025-01-14 13:21:18', 0),
(6, 2, 'RPL', '2025-01-14 13:21:42', '2025-01-14 13:21:42', 0),
(7, 2, 'TKJ', '2025-01-14 13:38:24', '2025-01-14 13:38:24', 0),
(8, 1, 'DKV', '2025-01-14 13:50:49', '2025-01-14 13:50:49', 1737362834),
(9, 9, 'ELEKTRO', '2025-01-20 08:44:02', '2025-01-20 08:44:02', 1737362644);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_kelas`
--

CREATE TABLE `data_kelas` (
  `id` int NOT NULL,
  `id_jurusan` int NOT NULL,
  `nama_kelas` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `data_kelas`
--

INSERT INTO `data_kelas` (`id`, `id_jurusan`, `nama_kelas`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, '10 RPL', '2025-01-21 08:17:32', '2025-01-21 08:17:32', 0),
(2, 7, '10 TKJ', '2025-01-21 19:41:16', '2025-01-21 19:41:16', 0),
(3, 8, '11 DKV', '2025-01-21 20:39:43', '2025-01-21 20:39:43', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_tahun_pelajaran`
--

CREATE TABLE `data_tahun_pelajaran` (
  `id` int NOT NULL,
  `nama_tahun_pelajaran` varchar(50) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `status_tahun_pelajaran` varchar(50) NOT NULL COMMENT 'ppdb, berjalan',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `data_tahun_pelajaran`
--

INSERT INTO `data_tahun_pelajaran` (`id`, `nama_tahun_pelajaran`, `tanggal_mulai`, `tanggal_akhir`, `status_tahun_pelajaran`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2025-2026', '2025-01-01', '2026-01-01', '1', '2025-01-14 11:55:27', '2025-01-14 11:55:27', 0),
(2, '2026-2027', '2025-01-15', '2025-01-15', '1', '0000-00-00 00:00:00', '2025-01-14 08:14:46', 0),
(7, '2024-2025', '2025-01-14', '2025-01-14', '1', '2025-01-14 13:37:13', '2025-01-14 13:37:13', 0),
(8, '2026-2028', '0000-00-00', '0000-00-00', '1', '2025-01-14 13:37:36', '2025-01-14 13:37:36', 1736864511),
(9, '2050-2090', '2025-01-01', '2025-01-16', '1', '2025-01-20 08:44:17', '2025-01-20 08:44:17', 1737362660),
(10, '3000-8000', '2025-01-01', '2025-01-23', '1', '0000-00-00 00:00:00', '2025-01-20 17:19:31', 0),
(11, '2025-2026', '2025-01-01', '2026-01-01', '1', '0000-00-00 00:00:00', '2025-01-20 22:21:20', 1737386490);

-- --------------------------------------------------------

--
-- Struktur dari tabel `harga_biaya`
--

CREATE TABLE `harga_biaya` (
  `id` int NOT NULL,
  `tahun_pelajaran_id` int NOT NULL,
  `jenis_biaya_id` int NOT NULL,
  `harga_biaya` decimal(15,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `harga_biaya`
--

INSERT INTO `harga_biaya` (`id`, `tahun_pelajaran_id`, `jenis_biaya_id`, `harga_biaya`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, 2, 13, 4000000.00, '2025-01-16 16:38:56', '2025-01-20 15:30:11', 1737361811),
(11, 2, 12, 30000.00, '2025-01-20 08:39:57', '2025-01-20 08:39:57', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_biaya`
--

CREATE TABLE `jenis_biaya` (
  `id` int NOT NULL,
  `nama_jenis_biaya` varchar(100) NOT NULL,
  `status_jenis_biaya` int NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `jenis_biaya`
--

INSERT INTO `jenis_biaya` (`id`, `nama_jenis_biaya`, `status_jenis_biaya`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, 'SPP', 1, '2025-01-16 05:08:46', '2025-01-20 15:10:56', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_seragam`
--

CREATE TABLE `jenis_seragam` (
  `id` int NOT NULL,
  `nama_jenis_seragam` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `jenis_seragam`
--

INSERT INTO `jenis_seragam` (`id`, `nama_jenis_seragam`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Seragam Putih Abu-abu', '2025-01-16 08:52:12', '2025-01-16 13:17:15', 0),
(4, 'Seragam Batik', '2025-01-16 15:54:10', '2025-01-16 15:54:10', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran_awal`
--

CREATE TABLE `pendaftaran_awal` (
  `id` int NOT NULL,
  `id_jurusan` int NOT NULL,
  `id_tahun_pelajaran` int NOT NULL,
  `id_kelas` int NOT NULL,
  `nama_kelas` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` int DEFAULT '0',
  `nama_siswa` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nik` varchar(20) NOT NULL,
  `agama` varchar(50) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `asal_sekolah` varchar(100) NOT NULL,
  `nama_ayah` varchar(100) DEFAULT NULL,
  `nama_ibu` varchar(100) DEFAULT NULL,
  `no_telepon_ayah` varchar(15) DEFAULT NULL,
  `no_telepon_ibu` varchar(15) DEFAULT NULL,
  `pekerjaan_ayah` varchar(50) DEFAULT NULL,
  `pekerjaan_ibu` varchar(50) DEFAULT NULL,
  `nama_wali` varchar(100) DEFAULT NULL,
  `no_telepon_wali` varchar(15) DEFAULT NULL,
  `pekerjaan_wali` varchar(50) DEFAULT NULL,
  `alamat_wali` text NOT NULL,
  `sumber_informasi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pendaftaran_awal`
--

INSERT INTO `pendaftaran_awal` (`id`, `id_jurusan`, `id_tahun_pelajaran`, `id_kelas`, `nama_kelas`, `created_at`, `updated_at`, `deleted_at`, `nama_siswa`, `nik`, `agama`, `nisn`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `no_telepon`, `email`, `asal_sekolah`, `nama_ayah`, `nama_ibu`, `no_telepon_ayah`, `no_telepon_ibu`, `pekerjaan_ayah`, `pekerjaan_ibu`, `nama_wali`, `no_telepon_wali`, `pekerjaan_wali`, `alamat_wali`, `sumber_informasi`) VALUES
(20, 4, 1, 1, '', '2025-01-21 20:30:28', '2025-01-22 04:32:54', 1737495174, 'adaff', '1234567890123456', 'Islam', '1234567890', 'Laki-laki', 'Medan', '2222-02-22', 'tenajd', '082257401010', 'syahrilmaymubdi2505@gmail.com', 'jbsdsk', 'fsssds', 'sdsdsd', '008977778887', '008977778898', 'hjbjkbj', 'sdsds', 'sdsds', '008977778888', 'adsasas', 'adsdssd', 'kerabat'),
(21, 0, 1, 0, '', '2025-01-21 21:10:38', '2025-01-22 04:56:37', 1737496597, 'Syahril', '1234567890123456', 'Islam', '1234567890', 'Laki-laki', 'Medan', '2222-02-22', 'tenajd', '082257401010', 'syahrilmaymubdi2505@gmail.com', 'jbsdsk', 'fsssds', 'sdsdsd', '008977778887', '008977778898', 'hjbjkbj', 'sdsds', 'sdsds', '008977778888', 'adsasas', 'adsdssd', 'kerabat'),
(22, 0, 1, 0, '', '2025-01-21 21:12:18', '2025-01-22 04:56:39', 1737496599, 'Musang', '1234567890123456', 'Islam', '1234567890', 'Laki-laki', 'Medan', '2222-02-22', 'tenajd', '082257401010', 'syahrilmaymubdi2505@gmail.com', 'jbsdsk', 'fsssds', 'sdsdsd', '008977778887', '008977778898', 'hjbjkbj', 'sdsds', 'sdsds', '008977778888', 'adsasas', 'adsdssd', 'kerabat'),
(23, 0, 2, 0, '', '2025-01-21 21:21:22', '2025-01-22 04:56:44', 1737496604, 'orang', '1234567890123456', 'Islam', '1234567890', 'Laki-laki', 'Medan', '2222-02-22', 'tenajd', '082257401010', 'syahrilmaymubdi2505@gmail.com', 'jbsdsk', 'fsssds', 'sdsdsd', '008977778887', '008977778898', 'hjbjkbj', 'sdsds', 'sdsds', '008977778888', 'adsasas', 'adsdssd', 'kerabat'),
(24, 7, 2, 2, '', '2025-01-21 21:22:05', '2025-01-22 05:03:38', 1737497018, 'Mahmud', '1234567890123456', 'Islam', '1234567890', 'Laki-laki', 'Medan', '2222-02-22', 'Jl SetiaBudi', '082257401010', 'syahrilmaymubdi2505@gmail.com', 'Demak', 'fsssds', 'sdsdsd', '008977778887', '008977778898', 'hjbjkbj', 'sdsds', 'sdsds', '008977778888', 'adsasas', 'adsdssd', 'kerabat'),
(25, 4, 1, 1, '', '2025-01-21 21:43:49', '2025-01-21 21:43:49', 0, 'Syahril May Mubdi', '1234567890123456', 'Islam', '1234567890', 'Laki-laki', 'Medan', '2008-05-25', 'Jl. Besar Tembung No 13', '082267403010', 'syahrilmaymubdi2505@gmail.com', 'SMP NEGERI 6 MEDAN', 'Ganteng', 'Cantik', '082304364205', '082304364200', 'Wirausaha', 'Ibu Rumah Tangga', 'Amelia', '082304364000', 'Polwan', 'Jl.Besar Tembung No 13', 'kerabat'),
(26, 7, 2, 2, '', '2025-01-21 22:10:20', '2025-01-21 22:10:20', 0, 'WIdono', '1122334455123456', 'Islam', '1233567890', 'Laki-laki', 'Medan', '2010-02-22', 'Jl. Krakatau', '082278987865', 'widonowibowo22@gmail.com', 'SMP Al Washliyah Gedung Johor', 'malik', 'citra', '082278987845', '082278987812', 'Pilot', 'Pramugari', 'Ilham Kurniawan', '082278987669', 'Polisi', 'Jl. Balai Desa', 'sosmed');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_seragam`
--

CREATE TABLE `stok_seragam` (
  `id` int NOT NULL,
  `jenis_seragam_id` int NOT NULL,
  `ukuran_seragam` varchar(255) NOT NULL,
  `stok_seragam` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `stok_seragam`
--

INSERT INTO `stok_seragam` (`id`, `jenis_seragam_id`, `ukuran_seragam`, `stok_seragam`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 1, 'M', '120', '2025-01-16 13:16:22', '2025-01-20 08:12:43', 0),
(3, 1, 'L', '130', '2025-01-16 15:16:18', '2025-01-16 15:16:18', 1737360958);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `updated_at`) VALUES
(5, 'admin', '1', '2025-01-09 16:38:03'),
(15, 'user12', '1234', '2025-01-13 10:12:27'),
(20, 'aab', '11', '2025-01-13 10:29:05'),
(27, 'Nekoyama', '12345', '2025-01-14 15:20:25');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_jurusan`
--
ALTER TABLE `data_jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_kelas`
--
ALTER TABLE `data_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_tahun_pelajaran`
--
ALTER TABLE `data_tahun_pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `harga_biaya`
--
ALTER TABLE `harga_biaya`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis_biaya`
--
ALTER TABLE `jenis_biaya`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis_seragam`
--
ALTER TABLE `jenis_seragam`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pendaftaran_awal`
--
ALTER TABLE `pendaftaran_awal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stok_seragam`
--
ALTER TABLE `stok_seragam`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_jurusan`
--
ALTER TABLE `data_jurusan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `data_kelas`
--
ALTER TABLE `data_kelas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `data_tahun_pelajaran`
--
ALTER TABLE `data_tahun_pelajaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `harga_biaya`
--
ALTER TABLE `harga_biaya`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `jenis_biaya`
--
ALTER TABLE `jenis_biaya`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `jenis_seragam`
--
ALTER TABLE `jenis_seragam`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pendaftaran_awal`
--
ALTER TABLE `pendaftaran_awal`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `stok_seragam`
--
ALTER TABLE `stok_seragam`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
