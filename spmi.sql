-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2022 at 02:34 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spmi`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_mutu`
--

CREATE TABLE `dokumen_mutu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_dokumen` enum('buku mutu','manual','standard','formulir','instruksi kerja') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` enum('kategori 1','kategori 2','kategori 3') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_file` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dokumen_mutu`
--

INSERT INTO `dokumen_mutu` (`id`, `user_id`, `jenis_dokumen`, `nama`, `keterangan`, `kategori`, `kode`, `nama_file`, `created_at`, `updated_at`) VALUES
(32, 24, 'standard', 'Standard Pelayanan', 'ini keteran staandard pelayan', 'kategori 1', 'asd', '1641299957.jpg', '2021-06-24 08:24:17', '2022-01-04 05:39:17'),
(33, 24, 'buku mutu', 'Buku Mutu Pelayanan', 'ajbkad akjdna dka da', NULL, NULL, '1624578973.jpeg', '2021-06-24 16:51:12', '2021-06-24 16:56:13'),
(37, 24, 'standard', 'Standard Kebersihan', 'dok standard kebersihan', 'kategori 1', 'sk01', '1641301002.png', '2022-01-04 05:55:34', '2022-01-04 05:56:42');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_kerja`
--

CREATE TABLE `hasil_kerja` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `dokumen_mutu_id` bigint(20) UNSIGNED NOT NULL,
  `nama_file` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hasil_kerja`
--

INSERT INTO `hasil_kerja` (`id`, `user_id`, `dokumen_mutu_id`, `nama_file`, `keterangan`, `created_at`, `updated_at`) VALUES
(21, 25, 32, '1624548641.png', 'ini hasil dari unit keuangann', '2021-06-24 08:29:55', '2021-06-24 08:30:41'),
(23, 28, 32, '1624578589.png', 'blb', '2021-06-24 16:49:49', '2021-06-24 16:49:49'),
(24, 25, 33, '1624594311.png', 'hasil kerja unit keuangan', '2021-06-24 21:11:51', '2021-06-24 21:11:51'),
(25, 29, 37, '1641302192.png', 'ini laporan hasil kerja dari unit kebersihan', '2022-01-04 06:16:32', '2022-01-04 06:16:32');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2021_06_18_160651_create_users_table', 1),
(6, '2021_06_18_163008_create_dokumen_mutu_table', 1),
(7, '2021_06_18_164944_create_hasil_kerja_table', 1),
(8, '2021_06_18_165156_create_penilaian_kinerja_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_kinerja`
--

CREATE TABLE `penilaian_kinerja` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `dokumen_mutu_id` bigint(20) UNSIGNED NOT NULL,
  `hasil_kerja_id` bigint(20) UNSIGNED NOT NULL,
  `nilai` int(11) NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penilaian_kinerja`
--

INSERT INTO `penilaian_kinerja` (`id`, `user_id`, `dokumen_mutu_id`, `hasil_kerja_id`, `nilai`, `keterangan`, `created_at`, `updated_at`) VALUES
(17, 25, 32, 21, 90, 'kinerja yang sangat baik', '2021-06-24 09:03:01', '2021-06-24 09:18:26'),
(24, 28, 32, 23, 80, 'toppp', '2021-06-24 16:50:37', '2021-06-24 16:50:37'),
(25, 25, 33, 24, 99, 'ok', '2021-06-24 21:12:50', '2021-06-24 21:12:50'),
(26, 29, 37, 25, 80, 'Baik', '2022-01-04 06:21:38', '2022-01-04 06:21:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('admin','upm','ami','unit') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `level`, `created_at`, `updated_at`) VALUES
(23, 'ADMIN', 'admin', 'admin123', 'admin', NULL, NULL),
(24, 'UPM', 'upm', 'upm123', 'upm', NULL, NULL),
(25, 'Unit Keuangan', 'uk001', 'uk001', 'unit', '2021-06-24 00:02:45', '2021-06-24 00:02:45'),
(26, 'Audit Keuangan', 'ak001', 'ak001', 'ami', '2021-06-24 00:03:11', '2021-06-24 00:03:11'),
(28, 'Unit Pelayanan', 'up001', 'up001', 'unit', '2021-06-24 09:22:39', '2021-06-24 09:22:39'),
(29, 'Unit Kebersihan', 'ukb001', 'ukb001', 'unit', '2022-01-04 05:37:21', '2022-01-04 05:37:21'),
(30, 'Audit Kebersihan', 'akb001', 'akb001', 'ami', '2022-01-04 06:20:07', '2022-01-04 06:20:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokumen_mutu`
--
ALTER TABLE `dokumen_mutu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `kode` (`kode`);

--
-- Indexes for table `hasil_kerja`
--
ALTER TABLE `hasil_kerja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `dokumen_mutu_id` (`dokumen_mutu_id`),
  ADD KEY `dokumen_mutu_id_2` (`dokumen_mutu_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penilaian_kinerja`
--
ALTER TABLE `penilaian_kinerja`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hasil_kerja_id_2` (`hasil_kerja_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `dokumen_mutu_id` (`dokumen_mutu_id`),
  ADD KEY `hasil_kerja_id` (`hasil_kerja_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokumen_mutu`
--
ALTER TABLE `dokumen_mutu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `hasil_kerja`
--
ALTER TABLE `hasil_kerja`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `penilaian_kinerja`
--
ALTER TABLE `penilaian_kinerja`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dokumen_mutu`
--
ALTER TABLE `dokumen_mutu`
  ADD CONSTRAINT `dokumen_mutu_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hasil_kerja`
--
ALTER TABLE `hasil_kerja`
  ADD CONSTRAINT `hasil_kerja_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hasil_kerja_ibfk_2` FOREIGN KEY (`dokumen_mutu_id`) REFERENCES `dokumen_mutu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penilaian_kinerja`
--
ALTER TABLE `penilaian_kinerja`
  ADD CONSTRAINT `penilaian_kinerja_ibfk_1` FOREIGN KEY (`hasil_kerja_id`) REFERENCES `hasil_kerja` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_kinerja_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_kinerja_ibfk_3` FOREIGN KEY (`dokumen_mutu_id`) REFERENCES `dokumen_mutu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
