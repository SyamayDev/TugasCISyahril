-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 16 Jan 2025 pada 03.07
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
(8, 1, 'DKV', '2025-01-14 13:50:49', '2025-01-14 13:50:49', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_kelas`
--

CREATE TABLE `data_kelas` (
  `id` int NOT NULL,
  `id_jurusan` int NOT NULL,
  `nama_kelas` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `data_kelas`
--

INSERT INTO `data_kelas` (`id`, `id_jurusan`, `nama_kelas`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, '10 RPL', '2025-01-14 14:10:17', '2025-01-14 14:10:17', 0),
(2, 4, '11 RPL', '2025-01-14 14:11:22', '2025-01-14 14:11:22', 0),
(3, 6, '10 RPL', '2025-01-14 14:11:53', '2025-01-14 14:11:53', 0),
(4, 7, '10 TKJ', '2025-01-14 14:31:28', '2025-01-14 14:31:28', 1736839958);

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
(8, '2026-2028', '0000-00-00', '0000-00-00', '1', '2025-01-14 13:37:36', '2025-01-14 13:37:36', 1736864511);

-- --------------------------------------------------------

--
-- Struktur dari tabel `harga_biaya`
--

CREATE TABLE `harga_biaya` (
  `id_harga_biaya` int NOT NULL,
  `id_tahun_ajaran` int NOT NULL,
  `id_jenis_biaya` int NOT NULL,
  `nominal_biaya` decimal(15,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `harga_biaya`
--

INSERT INTO `harga_biaya` (`id_harga_biaya`, `id_tahun_ajaran`, `id_jenis_biaya`, `nominal_biaya`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 1, 1, 3500000.00, '2025-01-15 20:35:45', '2025-01-15 20:35:45', 0),
(3, 0, 3, 200000.00, '2025-01-16 00:28:35', '2025-01-16 09:40:10', 127),
(4, 0, 0, 200000.00, '2025-01-16 02:13:15', '2025-01-16 09:13:20', 127);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_biaya`
--

CREATE TABLE `jenis_biaya` (
  `id_jenis_biaya` int NOT NULL,
  `nama_jenis_biaya` varchar(100) NOT NULL,
  `status_aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `jenis_biaya`
--

INSERT INTO `jenis_biaya` (`id_jenis_biaya`, `nama_jenis_biaya`, `status_aktif`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Pendaftaran', 1, '2025-01-14 23:48:15', '2025-01-14 23:48:15', 0),
(2, 'Buku', 0, '2025-01-15 00:09:03', '2025-01-15 00:09:03', 0),
(3, 'Pembangunan', 1, '2025-01-15 09:51:04', '2025-01-15 09:51:04', 0),
(4, 'Baju', 0, '2025-01-15 12:14:36', '2025-01-15 12:14:36', 0),
(5, 'Sepatu', 0, '2025-01-15 13:33:16', '2025-01-15 13:33:16', 0),
(6, 'Rumah', 1, '2025-01-15 14:34:09', '2025-01-15 14:34:09', 0),
(7, 'Meja', 0, '2025-01-15 14:43:45', '2025-01-15 14:43:45', 0),
(8, 'Kursi', 0, '2025-01-16 09:49:03', '2025-01-16 09:49:03', 0),
(9, 'Papan Tulis', 1, '2025-01-16 09:53:31', '2025-01-16 09:53:31', 0),
(10, 'Makanan', 1, '2025-01-16 09:58:07', '2025-01-16 09:58:07', 0),
(11, 'Minuman', 0, '2025-01-16 09:58:22', '2025-01-16 09:58:22', 0);

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
  ADD PRIMARY KEY (`id_harga_biaya`);

--
-- Indeks untuk tabel `jenis_biaya`
--
ALTER TABLE `jenis_biaya`
  ADD PRIMARY KEY (`id_jenis_biaya`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `data_kelas`
--
ALTER TABLE `data_kelas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `data_tahun_pelajaran`
--
ALTER TABLE `data_tahun_pelajaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `harga_biaya`
--
ALTER TABLE `harga_biaya`
  MODIFY `id_harga_biaya` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jenis_biaya`
--
ALTER TABLE `jenis_biaya`
  MODIFY `id_jenis_biaya` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
