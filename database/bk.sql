-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jan 2024 pada 20.03
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','dokter','pasien') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id`, `email`, `password`, `role`) VALUES
(7, 'kampoengbola6@gmail.com', '$2y$10$FM.1ovaRdUQihqECbmPBkeExBhZaWuJmz44Y19nhaKP.4MNo.7yHm', 'pasien'),
(8, 'admin@email.com', '$2y$10$FM.1ovaRdUQihqECbmPBkeExBhZaWuJmz44Y19nhaKP.4MNo.7yHm', 'admin'),
(9, 'safiardemak@kalijaga.com', '$2y$10$.f0SAjUUGuKSvxn2yeiiHOKA5kNDzmcztk8kTzXPe2k7c8MKJZKZu', 'pasien');

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_poli`
--

CREATE TABLE `daftar_poli` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_pasien` int(11) UNSIGNED NOT NULL,
  `id_jadwal` int(11) UNSIGNED NOT NULL,
  `keluhan` text NOT NULL,
  `no_antrian` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `daftar_poli`
--

INSERT INTO `daftar_poli` (`id`, `id_pasien`, `id_jadwal`, `keluhan`, `no_antrian`) VALUES
(11, 5, 11, 'Gigi belakang sakit', 1),
(13, 5, 10, 'Kulit bintik-bintik', 1),
(14, 5, 10, 'Kulit melepuh', 2),
(15, 6, 11, 'Membersihkan karang gigi', 2),
(16, 9, 11, 'Menambal gigi bolong', 3),
(17, 5, 11, 'Kulit bintik-bintik', 4),
(18, 5, 11, 'sakit gigi kanan', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_periksa`
--

CREATE TABLE `detail_periksa` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_periksa` int(11) UNSIGNED NOT NULL,
  `id_obat` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_periksa`
--

INSERT INTO `detail_periksa` (`id`, `id_periksa`, `id_obat`) VALUES
(17, 11, 4),
(18, 11, 7),
(19, 12, 7),
(20, 12, 10),
(21, 12, 11),
(24, 14, 5),
(25, 14, 6),
(26, 14, 13),
(39, 19, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_akun` int(11) UNSIGNED NOT NULL,
  `id_poli` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id`, `id_akun`, `id_poli`, `nama`, `alamat`, `no_hp`) VALUES
(8, 21, 2, 'Dr. Aii', 'Semarang Tengah', '089659615266'),
(9, 22, 1, 'Dr. Iskan', 'Semarang Barat', '0877116181902'),
(10, 23, 4, 'Dr. Andri', 'Tembalang', '0899771161443');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_periksa`
--

CREATE TABLE `jadwal_periksa` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_dokter` int(11) UNSIGNED NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu') NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jadwal_periksa`
--

INSERT INTO `jadwal_periksa` (`id`, `id_dokter`, `hari`, `jam_mulai`, `jam_selesai`, `status`) VALUES
(10, 8, 'Senin', '10:00:00', '12:00:00', 'y'),
(11, 9, 'Senin', '08:00:00', '12:00:00', 'n'),
(12, 9, 'Senin', '10:00:00', '14:00:00', 'n'),
(13, 9, 'Rabu', '15:00:00', '17:00:00', 'n'),
(14, 9, 'Kamis', '18:00:00', '22:00:00', 'n'),
(15, 9, 'Senin', '22:00:00', '01:00:00', 'n'),
(16, 9, 'Jumat', '11:11:00', '12:22:00', 'y'),
(17, 9, 'Selasa', '05:00:00', '10:00:00', 'n'),
(18, 9, 'Sabtu', '07:00:00', '08:00:00', 'n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `kemasan` varchar(35) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `kemasan`, `harga`) VALUES
(4, 'ACT (Artesunate tablet 50 mg + Amodiaquine anhydri', '2 blister @ 12 tablet / kotak', 44000),
(5, 'ACT (Artesunate tablet 50 mg + Amodiaquine anhydri', '3 blister @ 8tablet / kotak', 44000),
(6, 'Albendasol suspensi 200 mg/5 ml', 'Ktk 10 btl @ 10ml', 6000),
(7, 'Alprazolam tablet 1 mg', 'ktk 5 x 6 tablet', 16000),
(8, 'Ambroxol sirup 15 mg/ml', 'ktk 10 x 10tablet', 16000),
(9, 'Ambroxol sirup 30 mg', 'ktk 10 x 10tablet', 33000),
(10, 'Amilorida tablet 5 mg', 'ktk 10 x 10tablet', 64000),
(11, 'Aminofilin injeksi 24 mg/ml', 'ktk 10 x 10tablet', 77000),
(12, 'Albendazol tablet/ tablet kunyah 400 mg', 'ktk 10 x 10tablet', 118000),
(13, 'Alopurinol tablet 100 mg', 'btl 60 ml', 5000),
(14, 'Alopurinol tablet 300 mg', 'ktk 10 x 10tablet', 21000),
(15, 'Alprazolam tablet 0,25 mg', 'ktk 10 x 10tablet', 12000),
(16, 'Alprazolam tablet 0,5 mg', 'ktk 30 ampul @10 ml', 118000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_akun` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_ktp` varchar(255) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `no_rm` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id`, `id_akun`, `nama`, `alamat`, `no_ktp`, `no_hp`, `no_rm`) VALUES
(5, 3, 'Dhiya', 'Ungaran', '32443221124412', '087666533212', '202312-001'),
(6, 18, 'Yudhis', 'Banyumanik', '321322211', '087655542112', '202312-002'),
(9, 24, 'Safiar', 'Demak', '3231122887', '08655478321', '202401-003'),
(10, 27, 'Wijaya', 'Banyumanik Kota', '326645321', '0866444221', '202401-004');

-- --------------------------------------------------------

--
-- Struktur dari tabel `periksa`
--

CREATE TABLE `periksa` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_daftar_poli` int(11) UNSIGNED NOT NULL,
  `tgl_periksa` datetime NOT NULL,
  `catatan` text NOT NULL,
  `biaya_periksa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `periksa`
--

INSERT INTO `periksa` (`id`, `id_daftar_poli`, `tgl_periksa`, `catatan`, `biaya_periksa`) VALUES
(11, 11, '2024-01-04 00:24:37', 'Gigi bolong harus ditambal next periksa', 60000),
(12, 16, '2024-01-04 00:25:22', 'Sudah ditambal', 157000),
(14, 15, '2024-01-04 23:10:34', 'Sudah dibersihkan, aman', 205000),
(19, 18, '2024-01-08 01:48:30', 'harus ditambal', 214000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `poli`
--

CREATE TABLE `poli` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_poli` varchar(25) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `poli`
--

INSERT INTO `poli` (`id`, `nama_poli`, `keterangan`) VALUES
(1, 'Poli Gigi', 'Poli yang mengurus keluhan gigi'),
(2, 'Poli Kulit & Kelamin', 'Poli yang mengurus keluhan kulit dan kelamin'),
(4, 'Poli Umum', 'Poli untuk mengurus keluhan umum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','dokter','pasien') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(3, 'Dhiya', 'dhiya@mail.com', '$2y$12$iuTW9r0XXkmVg1cUyKdF2.kpxWUTZVAlg7iaiMtZIEKZvY/lJdQN2', 'pasien', '2023-12-29 12:14:39', '2024-01-03 10:04:24'),
(4, 'Admin', 'admin@mail.com', '$2y$12$oR.PZoAChmVOj8VKEdf4wepT.x/v17d5xxTU4hKvxIzJ3z4el75tS', 'admin', '2023-12-30 02:19:10', '2023-12-30 02:19:10'),
(18, 'Yudhis', 'yudhis@mail.com', '$2y$12$iuTW9r0XXkmVg1cUyKdF2.kpxWUTZVAlg7iaiMtZIEKZvY/lJdQN2', 'pasien', '2023-12-30 07:16:30', '2024-01-03 09:51:17'),
(21, 'Dr. Aii', 'ai@mail.com', '$2y$12$E6GH3fQaI8NDV/i0NeR.IOh9JbjgxnJ5XGLO3SjY5NGk1n.WFEc1C', 'dokter', '2023-12-30 23:14:24', '2024-01-03 10:01:30'),
(22, 'Dr. Iskan', 'iskan@mail.com', '$2y$12$2PMGqXBAfSV7w13coKGQ3eJF7DONEq.EmNSPzD7uarlrUa/mUgCa.', 'dokter', '2024-01-03 09:46:36', '2024-01-03 10:02:13'),
(23, 'Dr. Andri', 'andri@mail.com', '$2y$12$FhE6aqnnLUzslJc6kkwnm.YcPWAWmB5WTeM1nSOENofO4goVjlzne', 'dokter', '2024-01-03 09:49:34', '2024-01-03 10:02:36'),
(24, 'Safiar', 'safiar@mail,com', '$2y$12$DGEJ/dFgzK/i2qApLikdNOrzPFgX/9QJ6C22JtIYZvjjwMUll8nxq', 'pasien', '2024-01-03 09:50:40', '2024-01-03 09:50:40'),
(27, 'Wijaya', 'wijaya@mail.com', '$2y$12$cAeIRQ0QaV2CmH4riVDeju1c3IJs39iDLVaMAAhIlFhWx87Zsx3P.', 'pasien', '2024-01-03 22:14:12', '2024-01-03 22:14:12');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `daftar_poli`
--
ALTER TABLE `daftar_poli`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indeks untuk tabel `detail_periksa`
--
ALTER TABLE `detail_periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_periksa` (`id_periksa`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_akun` (`id_akun`),
  ADD KEY `id_poli` (`id_poli`);

--
-- Indeks untuk tabel `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_dokter` (`id_dokter`) USING BTREE;

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_akun` (`id_akun`);

--
-- Indeks untuk tabel `periksa`
--
ALTER TABLE `periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_daftar_poli` (`id_daftar_poli`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `daftar_poli`
--
ALTER TABLE `daftar_poli`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `detail_periksa`
--
ALTER TABLE `detail_periksa`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `periksa`
--
ALTER TABLE `periksa`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `poli`
--
ALTER TABLE `poli`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `daftar_poli`
--
ALTER TABLE `daftar_poli`
  ADD CONSTRAINT `daftar_poli_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `daftar_poli_ibfk_2` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_periksa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_periksa`
--
ALTER TABLE `detail_periksa`
  ADD CONSTRAINT `detail_periksa_ibfk_1` FOREIGN KEY (`id_periksa`) REFERENCES `periksa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_periksa_ibfk_2` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD CONSTRAINT `dokter_ibfk_1` FOREIGN KEY (`id_poli`) REFERENCES `poli` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  ADD CONSTRAINT `jadwal_periksa_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `periksa`
--
ALTER TABLE `periksa`
  ADD CONSTRAINT `periksa_ibfk_1` FOREIGN KEY (`id_daftar_poli`) REFERENCES `daftar_poli` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
