-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2020 at 02:00 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_telkom`
--

-- --------------------------------------------------------

--
-- Table structure for table `integrasi`
--

CREATE TABLE `integrasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `path_audio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `script` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `konteks1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `konteks2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `konteks3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `konteks4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `integrasi`
--

INSERT INTO `integrasi` (`id`, `path_audio`, `script`, `model`, `konteks1`, `konteks2`, `konteks3`, `konteks4`, `created_at`, `updated_at`) VALUES
(10, 'record_2020_11_02_06_27_34.wav', ' internet saya buat akun berapa hari ini lampunya menyala merah terus gimana ya iya makasih ya mbak ya', '7', 'GANGGUAN INTERNET', 'INFO STATUS REGISTRASI', 'TIDAK BERMAKNA', 'INFO STATUS TIKET KOMPLAIN', '2020-11-20 09:31:57', NULL),
(12, NULL, 'internet saja jelek terus kenapa ya', '7', 'GANGGUAN INTERNET', 'GANGGUAN USEE TV', 'INFO STATUS TIKET KOMPLAIN', 'GANGGUAN TELEPON', '2020-11-23 03:08:36', '2020-11-22 20:00:30'),
(13, NULL, 'internet saya jelek banget ih', '13', 'GANGGUAN INTERNET', 'TIDAK BERMAKNA', 'INFO STATUS REGISTRASI', 'KOMPLAIN SLG', '2020-11-23 03:08:42', '2020-11-22 20:08:15'),
(14, NULL, 'internet saya jelek banget ih', '4', 'GANGGUAN INTERNET', 'INFO STATUS TIKET KOMPLAIN', 'TIDAK BERMAKNA', 'INFO STATUS REGISTRASI', '2020-11-23 03:52:53', '2020-11-22 20:48:24'),
(15, NULL, 'internet jelek', '6', 'GANGGUAN INTERNET', 'TIDAK BERMAKNA', 'GANGGUAN USEE TV', 'GANGGUAN TELEPON', '2020-11-30 10:05:01', '2020-11-22 20:58:08'),
(16, NULL, 'Internet jelek', '7', 'GANGGUAN INTERNET', 'GANGGUAN USEE TV', 'INFO PRODUK', 'INFO STATUS REGISTRASI', '2020-11-30 10:05:08', '2020-11-22 21:01:37'),
(17, NULL, 'internet saya jelek banget ih', '5', 'GANGGUAN INTERNET', 'GANGGUAN USEE TV', 'INFO STATUS REGISTRASI', 'LAMPU LOS MENYALA MERAH', '2020-11-30 10:08:00', '2020-11-22 21:03:57'),
(18, NULL, 'internet jelek bgt kenapa ya', '6', 'GANGGUAN INTERNET', 'GANGGUAN TELEPON', 'GANGGUAN USEE TV', 'TIDAK BERMAKNA', '2020-12-02 03:31:07', '2020-11-22 21:25:06'),
(19, NULL, 'internet saja jelek terus kenapa ya', NULL, 'GANGGUAN INTERNET', 'TIDAK BERMAKNA', 'INFO STATUS TIKET KOMPLAIN', 'INFO PRODUK', '2020-11-22 21:42:48', '2020-11-22 21:42:48'),
(20, NULL, 'lampu nyala merah terus internet lemot kenapa ya', NULL, 'LAMPU LOS MENYALA MERAH', 'GANGGUAN INTERNET', 'KOMPLAIN SLG', 'TIDAK BERMAKNA', '2020-11-22 22:03:35', '2020-11-22 22:03:35'),
(21, NULL, 'La', NULL, 'TIDAK BERMAKNA', 'INFO STATUS REGISTRASI', 'INFO PRODUK', 'GANGGUAN INTERNET', '2020-11-22 22:15:17', '2020-11-22 22:15:17'),
(22, NULL, 'lampu nyala merah terus internet lemot kenapa ya', NULL, 'LAMPU LOS MENYALA MERAH', 'GANGGUAN INTERNET', 'KOMPLAIN SLG', 'TIDAK BERMAKNA', '2020-11-22 22:20:21', '2020-11-22 22:20:21'),
(23, NULL, 'internet jelek bgt kenapa ya', NULL, 'GANGGUAN INTERNET', 'INFO STATUS TIKET KOMPLAIN', 'TIDAK BERMAKNA', 'INFO PRODUK', '2020-11-22 23:29:50', '2020-11-22 23:29:50'),
(24, NULL, 'internet saja jelek terus kenapa ya', NULL, 'GANGGUAN INTERNET', 'TIDAK BERMAKNA', 'INFO STATUS TIKET KOMPLAIN', 'INFO PRODUK', '2020-11-22 23:31:54', '2020-11-22 23:31:54'),
(25, NULL, 'wifi saya yang lama mau saya pindahkan ke rumah yang baru apakah bisa?', NULL, 'PERMINTAAN MUTASI (BALIK NAMA/GANTI NOMOR, DLL)', 'BUKA ISOLIR', 'INFO STATUS TIKET KOMPLAIN', 'INFO STATUS REGISTRASI', '2020-11-24 20:07:57', '2020-11-24 20:07:57'),
(26, NULL, 'wifi saya yang lama mau saya pindahkan ke rumah yang baru apakah bisa?', NULL, 'PERMINTAAN MUTASI (BALIK NAMA/GANTI NOMOR, DLL)', 'BUKA ISOLIR', 'INFO STATUS TIKET KOMPLAIN', 'INFO STATUS REGISTRASI', '2020-11-24 20:12:31', '2020-11-24 20:12:31'),
(27, NULL, 'wifi saya yang lama mau saya pindahkan ke rumah yang baru apakah bisa?', NULL, 'PERMINTAAN MUTASI (BALIK NAMA/GANTI NOMOR, DLL)', 'BUKA ISOLIR', 'INFO STATUS TIKET KOMPLAIN', 'INFO STATUS REGISTRASI', '2020-11-24 20:13:10', '2020-11-24 20:13:10'),
(28, NULL, 'wifi saya yang lama mau saya pindahkan ke rumah yang baru apakah bisa?', NULL, 'PERMINTAAN MUTASI (BALIK NAMA/GANTI NOMOR, DLL)', 'BUKA ISOLIR', 'INFO STATUS TIKET KOMPLAIN', 'INFO STATUS REGISTRASI', '2020-11-24 20:17:18', '2020-11-24 20:17:18'),
(29, NULL, 'wifi saya yang lama mau saya pindahkan ke rumah yang baru apakah bisa?', NULL, 'PERMINTAAN MUTASI (BALIK NAMA/GANTI NOMOR, DLL)', 'BUKA ISOLIR', 'INFO STATUS TIKET KOMPLAIN', 'INFO STATUS REGISTRASI', '2020-11-24 20:18:10', '2020-11-24 20:18:10'),
(30, NULL, 'wifi saya yang lama mau saya pindahkan ke rumah yang baru apakah bisa?', NULL, 'PERMINTAAN MUTASI (BALIK NAMA/GANTI NOMOR, DLL)', 'BUKA ISOLIR', 'INFO STATUS TIKET KOMPLAIN', 'INFO STATUS REGISTRASI', '2020-12-01 20:30:32', '2020-12-01 20:30:32'),
(31, NULL, 'wifi saya yang lama mau saya pindahkan ke rumah yang baru apakah bisa?', '4', 'PERMINTAAN MUTASI (BALIK NAMA/GANTI NOMOR, DLL)', 'BUKA ISOLIR', 'INFO STATUS TIKET KOMPLAIN', 'INFO STATUS REGISTRASI', '2020-12-01 20:32:12', '2020-12-01 20:32:12'),
(32, 'record_2020_12_02_10_32_53.wav', NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-02 03:33:00', NULL),
(33, NULL, 'wifi saya yang lama mau saya pindahkan ke rumah yang baru apakah bisa?', '4', 'PERMINTAAN MUTASI (BALIK NAMA/GANTI NOMOR, DLL)', 'BUKA ISOLIR', 'INFO STATUS TIKET KOMPLAIN', 'INFO STATUS REGISTRASI', '2020-12-01 23:58:32', '2020-12-01 23:58:32'),
(34, NULL, 'internet saya beberapa hari ini jelek terus, udah di restart masih jelek', '4', 'GANGGUAN INTERNET', 'BUKA ISOLIR', 'INFO STATUS TIKET KOMPLAIN', 'GANGGUAN USEE TV', '2020-12-02 00:42:23', '2020-12-02 00:42:23'),
(35, NULL, 'internet saya beberapa hari ini jelek terus, udah di restart masih jelek', '4', 'GANGGUAN INTERNET', 'BUKA ISOLIR', 'INFO STATUS TIKET KOMPLAIN', 'GANGGUAN USEE TV', '2020-12-02 00:45:33', '2020-12-02 00:45:33'),
(36, NULL, 'apakah ada promo terbaru?', '4', 'INFO PROMO', 'GANGGUAN INTERNET', 'INFO PRODUK', 'INFO STATUS REGISTRASI', '2020-12-02 00:48:54', '2020-12-02 00:48:54'),
(37, NULL, 'apakah ada promo terbaru?', '4', 'INFO PROMO', 'GANGGUAN INTERNET', 'INFO PRODUK', 'INFO STATUS REGISTRASI', '2020-12-02 00:52:41', '2020-12-02 00:52:41'),
(38, 'cek.wav', ' iya kembali namun apa namanya anak saya ya ya kak ada yang di belakang responnya gitu enggak enggak enggak enggak enggak  iya', NULL, NULL, NULL, NULL, NULL, '2020-12-07 04:02:55', NULL),
(39, NULL, 'wifi saya yang lama mau saya pindahkan ke rumah yang baru apakah bisa?', '4', 'PERMINTAAN MUTASI (BALIK NAMA/GANTI NOMOR, DLL)', 'BUKA ISOLIR', 'INFO STATUS TIKET KOMPLAIN', 'INFO STATUS REGISTRASI', '2020-12-03 23:14:59', '2020-12-03 23:14:59'),
(40, NULL, 'kabel saya putus kira kira bisa diganti kapan ya', '4', 'BUKA ISOLIR', 'GANGGUAN INTERNET', 'INFO STATUS REGISTRASI', 'INFO STATUS TIKET KOMPLAIN', '2020-12-06 20:57:19', '2020-12-06 20:57:19'),
(41, NULL, 'wifi saya yang lama mau saya pindahkan ke rumah yang baru apakah bisa?', '4', 'PERMINTAAN MUTASI (BALIK NAMA/GANTI NOMOR, DLL)', 'BUKA ISOLIR', 'INFO STATUS TIKET KOMPLAIN', 'INFO STATUS REGISTRASI', '2020-12-06 22:44:42', '2020-12-06 22:44:42'),
(42, 'record_2020_12_07_19_18_10.wav', ' ya <euh> <heueuh> <heueuh> <heueuh> <heueuh> <heueuh> <heueuh> <heueuh>', '6', 'TIDAK BERMAKNA', 'GANGGUAN INTERNET', 'INFO STATUS REGISTRASI', 'INFO STATUS TIKET KOMPLAIN', '2020-12-07 12:19:14', NULL),
(43, NULL, 'wifi saya yang lama mau saya pindahkan ke rumah yang baru apakah bisa?', '4', 'PERMINTAAN MUTASI (BALIK NAMA/GANTI NOMOR, DLL)', 'BUKA ISOLIR', 'INFO STATUS TIKET KOMPLAIN', 'INFO STATUS REGISTRASI', '2020-12-07 05:19:51', '2020-12-07 05:19:51');

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
(1, '2020_10_31_051111_create_integrasi_table', 1),
(2, '2014_10_12_000000_create_users_table', 2),
(3, '2014_10_12_100000_create_password_resets_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `integrasi`
--
ALTER TABLE `integrasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `integrasi`
--
ALTER TABLE `integrasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
