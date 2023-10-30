-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2021 at 09:01 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reservasi_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kode_admin` varchar(16) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `jenis_kelamin` tinyint(1) NOT NULL DEFAULT 1,
  `jabatan` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `id_user`, `kode_admin`, `nama`, `jenis_kelamin`, `jabatan`) VALUES
(2, 22, 'ADM-00022', 'Admin A', 1, 'Kasir');

-- --------------------------------------------------------

--
-- Table structure for table `biling`
--

CREATE TABLE `biling` (
  `id_biling` int(11) NOT NULL,
  `id_reservasi` int(11) NOT NULL,
  `kode_biling` varchar(16) NOT NULL,
  `keluhan` text NOT NULL,
  `jumlah_hewan` int(11) NOT NULL,
  `diagnosa` text NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `biling`
--

INSERT INTO `biling` (`id_biling`, `id_reservasi`, `kode_biling`, `keluhan`, `jumlah_hewan`, `diagnosa`, `tanggal`, `created_by`, `date_created`) VALUES
(6, 2, 'BIL-001618641407', 'Keluhan', 3, 'Diagnosa Penyakit', '2020-12-01', 34, 1618641407),
(7, 2, 'BIL-001618641528', 'Keluhan', 3, 'Diagnosa kedua', '2021-04-14', 34, 1618641528),
(8, 2, 'BIL-001618671785', 'Keluhan', 3, 'Diagnosa Penyakit Root', '2021-04-17', 34, 1618671785),
(9, 2, 'BIL-001619071803', 'Keluhan', 3, '', '2021-04-22', 34, 1619071803);

-- --------------------------------------------------------

--
-- Table structure for table `biling_detail`
--

CREATE TABLE `biling_detail` (
  `id_detail` int(11) NOT NULL,
  `id_biling` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `biling_detail`
--

INSERT INTO `biling_detail` (`id_detail`, `id_biling`, `keterangan`, `qty`, `harga`) VALUES
(8, 6, 'Pemerikasaan Standar', 1, 50000),
(9, 6, 'Vitamin', 4, 20000),
(10, 7, 'Pemeriksaan', 2, 55000),
(11, 7, 'Vitamin', 5, 30000),
(71, 8, 'bbbb', 2, 50000),
(72, 8, 'baba', 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kode_dokter` varchar(16) NOT NULL,
  `nama_dokter` varchar(128) NOT NULL,
  `jenis_kelamin_dokter` tinyint(1) NOT NULL DEFAULT 1,
  `hari_praktek` text NOT NULL,
  `no_hp_dokter` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `id_user`, `kode_dokter`, `nama_dokter`, `jenis_kelamin_dokter`, `hari_praktek`, `no_hp_dokter`) VALUES
(1, 34, 'DOC-00034', 'Dokter Pertama', 1, '[\"1\",\"2\",\"3\"]', '6565656565'),
(2, 36, 'DOC-00036', 'ADSFAEd', 2, '[\"1\",\"2\"]', '6565656565');

-- --------------------------------------------------------

--
-- Table structure for table `hari_praktek`
--

CREATE TABLE `hari_praktek` (
  `id` int(11) NOT NULL,
  `hari` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hari_praktek`
--

INSERT INTO `hari_praktek` (`id`, `hari`) VALUES
(1, 'Senin'),
(2, 'Selasa'),
(3, 'Rabu'),
(4, 'Kamis'),
(5, 'Jum\'at'),
(6, 'Sabtu'),
(7, 'Minggu');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id_history` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp(),
  `aktivitas` varchar(64) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id_history`, `id_user`, `waktu`, `aktivitas`, `keterangan`) VALUES
(1, 33, '2021-04-17 22:28:11', 'Login', 'Login ke sistem'),
(2, 1, '2021-04-17 22:28:39', 'Login', 'Login ke sistem'),
(3, 1, '2021-04-17 22:36:12', 'Login', 'Login ke sistem'),
(4, 1, '2021-04-17 22:37:57', 'Lihat Biling', 'Melihat Data List Biling'),
(5, 1, '2021-04-17 22:38:11', 'Lihat Detail Biling', 'Melihat Data Detail Biling'),
(6, 1, '2021-04-17 22:41:25', 'Lihat Biling', 'Melihat Data List Biling'),
(7, 1, '2021-04-17 22:41:40', 'Lihat Biling', 'Melihat Data List Biling'),
(8, 1, '2021-04-17 22:41:41', 'Lihat Detail Biling', 'Melihat Data Detail Biling dengan kode BIL-001618641528'),
(9, 1, '2021-04-17 22:59:26', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618641528'),
(10, 1, '2021-04-17 22:59:30', 'View', 'Melihat Data List User Admin'),
(11, 1, '2021-04-17 22:59:43', 'View Detail', 'Melihat Data Detail User Admin dengan kode ADM-00022'),
(12, 1, '2021-04-17 22:59:56', 'View', 'Melihat Data List User Admin'),
(13, 1, '2021-04-17 23:00:06', 'Reset Password', 'Mereset Password User Admin dengan kode ADM-00022'),
(14, 1, '2021-04-17 23:00:06', 'View', 'Melihat Data List User Admin'),
(15, 1, '2021-04-17 23:00:32', 'Deactivate', 'Nonaktigkan Data User Admin dengan kode ADM-00022'),
(16, 1, '2021-04-17 23:00:32', 'View', 'Melihat Data List User Admin'),
(17, 1, '2021-04-17 23:00:45', 'Activate', 'Mengaktifkan Data User Admin dengan kode ADM-00022'),
(18, 1, '2021-04-17 23:00:45', 'View', 'Melihat Data List User Admin'),
(19, 33, '2021-04-18 07:05:20', 'Login', 'Login ke sistem'),
(20, 33, '2021-04-18 07:05:21', 'View', 'Melihat Data List User Dokter'),
(21, 34, '2021-04-18 07:08:07', 'Login', 'Login ke sistem'),
(22, 34, '2021-04-18 07:08:10', 'View', 'Melihat Data List Biling'),
(23, 34, '2021-04-18 07:08:36', 'View', 'Melihat Data List Biling'),
(24, 34, '2021-04-18 07:09:04', 'Login', 'Login ke sistem'),
(25, 34, '2021-04-18 07:09:06', 'View', 'Melihat Data List Biling'),
(26, 34, '2021-04-18 07:14:33', 'View', 'Melihat Data List User Klien'),
(27, 1, '2021-04-18 07:19:16', 'Login', 'Login ke sistem'),
(28, 22, '2021-04-18 07:29:07', 'Login', 'Login ke sistem'),
(29, 22, '2021-04-18 07:31:45', 'View', 'Melihat Data List Biling'),
(30, 22, '2021-04-18 07:31:50', 'View', 'Melihat Data List Reservasi'),
(31, 34, '2021-04-18 07:34:14', 'Login', 'Login ke sistem'),
(32, 33, '2021-04-18 07:36:04', 'Login', 'Login ke sistem'),
(33, 1, '2021-04-18 07:37:01', 'Login', 'Login ke sistem'),
(34, 1, '2021-04-18 07:54:37', 'View', 'Melihat Data List Reservasi'),
(35, 1, '2021-04-18 07:54:39', 'View Detail', 'Melihat Data Detail Reservasi dengan kode RSV-1618'),
(36, 1, '2021-04-18 07:54:42', 'View', 'Melihat Data List Reservasi'),
(37, 1, '2021-04-18 08:24:29', 'View', 'Melihat Data List Reservasi'),
(38, 1, '2021-04-18 08:24:46', 'View', 'Melihat Data List Reservasi'),
(39, 1, '2021-04-18 08:24:54', 'View', 'Melihat Data List Reservasi'),
(40, 1, '2021-04-18 08:28:03', 'View', 'Melihat Data List Reservasi'),
(41, 22, '2021-04-18 08:33:28', 'Login', 'Login ke sistem'),
(42, 22, '2021-04-18 08:36:11', 'Login', 'Login ke sistem'),
(43, 22, '2021-04-18 08:36:42', 'View', 'Melihat Data List User Dokter'),
(44, 22, '2021-04-18 08:36:45', 'View', 'Melihat Data List User Klien'),
(45, 22, '2021-04-18 08:36:47', 'View', 'Melihat Data List User Dokter'),
(46, 22, '2021-04-18 08:36:49', 'View', 'Melihat Data List Reservasi'),
(47, 22, '2021-04-18 08:36:51', 'View', 'Melihat Data List Biling'),
(48, 22, '2021-04-18 08:36:59', 'View', 'Melihat Data List Reservasi'),
(49, 22, '2021-04-18 08:38:39', 'Login', 'Login ke sistem'),
(50, 1, '2021-04-18 08:39:28', 'Login', 'Login ke sistem'),
(51, 1, '2021-04-18 08:39:29', 'View', 'Melihat Data List User Klien'),
(52, 1, '2021-04-18 08:39:31', 'View', 'Melihat Data List User Dokter'),
(53, 1, '2021-04-18 08:39:33', 'View', 'Melihat Data List Reservasi'),
(54, 1, '2021-04-18 08:39:35', 'View', 'Melihat Data List Biling'),
(55, 22, '2021-04-18 08:39:48', 'Login', 'Login ke sistem'),
(56, 22, '2021-04-18 08:40:17', 'Login', 'Login ke sistem'),
(57, 34, '2021-04-18 08:41:16', 'Login', 'Login ke sistem'),
(58, 34, '2021-04-18 08:43:03', 'View', 'Melihat Data List User Klien'),
(59, 34, '2021-04-18 08:55:29', 'View', 'Melihat Data Profil Saya'),
(60, 34, '2021-04-18 08:55:46', 'Update', 'Mengubah Data Profil Saya'),
(61, 34, '2021-04-18 08:55:46', 'View', 'Melihat Data Profil Saya'),
(62, 34, '2021-04-18 09:00:34', 'View', 'Melihat Data List Reservasi'),
(63, 34, '2021-04-18 09:08:06', 'View', 'Melihat Data List User Klien'),
(64, 34, '2021-04-18 09:08:08', 'View', 'Melihat Data List Reservasi'),
(65, 34, '2021-04-18 09:08:12', 'View', 'Melihat Data List User Klien'),
(66, 34, '2021-04-18 09:08:25', 'View', 'Melihat Data List Reservasi'),
(67, 34, '2021-04-18 09:08:39', 'View', 'Melihat Data List User Klien'),
(68, 34, '2021-04-18 09:08:41', 'View', 'Melihat Data List Reservasi'),
(69, 34, '2021-04-18 09:09:29', 'View', 'Melihat Data List Biling'),
(70, 34, '2021-04-18 09:09:42', 'View', 'Melihat Data List Biling'),
(71, 34, '2021-04-18 09:13:18', 'View', 'Melihat Data List Reservasi'),
(72, 34, '2021-04-18 09:14:39', 'View', 'Melihat Data List Reservasi'),
(73, 34, '2021-04-18 09:15:38', 'View', 'Melihat Data List Reservasi'),
(74, 34, '2021-04-18 09:24:36', 'View', 'Melihat Data List Biling'),
(75, 33, '2021-04-18 09:24:58', 'Login', 'Login ke sistem'),
(76, 33, '2021-04-18 09:25:21', 'View', 'Melihat Data List Reservasi'),
(77, 33, '2021-04-18 09:25:26', 'View', 'Melihat Data List User Dokter'),
(78, 33, '2021-04-18 09:25:26', 'View', 'Melihat Data List Biling'),
(79, 33, '2021-04-18 09:25:29', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618671785'),
(80, 33, '2021-04-18 09:25:30', 'View', 'Melihat Data List Biling'),
(81, 33, '2021-04-18 09:32:25', 'View', 'Melihat Data List Reservasi'),
(82, 33, '2021-04-18 09:35:29', 'View', 'Melihat Data List Reservasi'),
(83, 1, '2021-04-18 10:05:11', 'Login', 'Login ke sistem'),
(84, 1, '2021-04-18 10:05:14', 'View', 'Melihat Data List User Admin'),
(85, 1, '2021-04-18 10:15:38', 'View', 'Melihat Data List User Admin'),
(86, 1, '2021-04-18 10:15:48', 'View', 'Melihat Data List User Admin'),
(87, 1, '2021-04-18 10:16:29', 'View', 'Melihat Data List User Admin'),
(88, 1, '2021-04-18 10:16:32', 'View', 'Melihat Data List Spesialis Dokter'),
(89, 1, '2021-04-18 10:16:50', 'View', 'Melihat Data List Spesialis Dokter'),
(90, 1, '2021-04-18 10:17:02', 'View', 'Melihat Data List Spesialis Dokter'),
(91, 1, '2021-04-18 10:17:14', 'View', 'Melihat Data List Spesialis Dokter'),
(92, 1, '2021-04-18 10:17:30', 'View', 'Melihat Data List Spesialis Dokter'),
(93, 1, '2021-04-18 10:17:52', 'View', 'Melihat Data List Spesialis Dokter'),
(94, 1, '2021-04-18 10:18:13', 'View', 'Melihat Data List Spesialis Dokter'),
(95, 1, '2021-04-18 10:19:39', 'View', 'Melihat Data List Spesialis Dokter'),
(96, 1, '2021-04-18 10:25:26', 'View', 'Melihat Data List Spesialis Dokter'),
(97, 1, '2021-04-18 10:25:31', 'Input', 'Menambahkan Data Spesialis Dokter'),
(98, 1, '2021-04-18 10:26:09', 'View', 'Melihat Data List Spesialis Dokter'),
(99, 1, '2021-04-18 10:32:48', 'View', 'Melihat Data List Spesialis Dokter'),
(100, 1, '2021-04-18 10:33:23', 'View', 'Melihat Data List Spesialis Dokter'),
(101, 1, '2021-04-18 10:33:47', 'Update', 'Mengubah Data Spesialis Dokter'),
(102, 1, '2021-04-18 10:34:41', 'View', 'Melihat Data List Spesialis Dokter'),
(103, 1, '2021-04-18 10:34:47', 'Update', 'Mengubah Data Spesialis Dokter'),
(104, 1, '2021-04-18 10:34:48', 'View', 'Melihat Data List Spesialis Dokter'),
(105, 1, '2021-04-18 10:35:39', 'View', 'Melihat Data List Spesialis Dokter'),
(106, 1, '2021-04-18 10:35:51', 'View', 'Melihat Data List Spesialis Dokter'),
(107, 1, '2021-04-18 10:35:54', 'View', 'Melihat Data List Spesialis Dokter'),
(108, 1, '2021-04-18 10:40:55', 'View', 'Melihat Data List Spesialis Dokter'),
(109, 1, '2021-04-18 10:40:58', 'View', 'Melihat Data List Jam Reservasi'),
(110, 1, '2021-04-18 10:42:49', 'Input', 'Menambahkan Data Jam Reservasi'),
(111, 1, '2021-04-18 10:42:52', 'View', 'Melihat Data List Jam Reservasi'),
(112, 1, '2021-04-18 10:44:03', 'View', 'Melihat Data List Jam Reservasi'),
(113, 1, '2021-04-18 10:44:45', 'View', 'Melihat Data List Jam Reservasi'),
(114, 1, '2021-04-18 10:45:16', 'View', 'Melihat Data List Jam Reservasi'),
(115, 1, '2021-04-18 10:45:20', 'Update', 'Mengubah Data Jam Reservasi'),
(116, 1, '2021-04-18 10:45:22', 'View', 'Melihat Data List Jam Reservasi'),
(117, 1, '2021-04-18 10:45:30', 'Update', 'Mengubah Data Jam Reservasi'),
(118, 1, '2021-04-18 10:45:55', 'View', 'Melihat Data List Jam Reservasi'),
(119, 1, '2021-04-18 10:46:11', 'View', 'Melihat Data List Jam Reservasi'),
(120, 1, '2021-04-18 10:46:16', 'View', 'Melihat Data List Jam Reservasi'),
(121, 1, '2021-04-18 10:46:19', 'View', 'Melihat Data List Spesialis Dokter'),
(122, 1, '2021-04-18 10:46:39', 'View', 'Melihat Data List User Dokter'),
(123, 22, '2021-04-18 10:52:41', 'Login', 'Login ke sistem'),
(124, 22, '2021-04-18 10:53:55', 'Login', 'Login ke sistem'),
(125, 22, '2021-04-18 10:54:43', 'Login', 'Login ke sistem'),
(126, 22, '2021-04-18 10:55:22', 'Login', 'Login ke sistem'),
(127, 22, '2021-04-18 10:55:25', 'View', 'Melihat Data List Spesialis Dokter'),
(128, 22, '2021-04-18 10:56:27', 'View', 'Melihat Data List Spesialis Dokter'),
(129, 22, '2021-04-18 10:56:36', 'View', 'Melihat Data List Jam Reservasi'),
(130, 22, '2021-04-18 10:56:41', 'Update', 'Mengubah Data Jam Reservasi'),
(131, 22, '2021-04-18 10:56:42', 'View', 'Melihat Data List Jam Reservasi'),
(132, 22, '2021-04-18 10:56:47', 'Update', 'Mengubah Data Jam Reservasi'),
(133, 22, '2021-04-18 10:56:49', 'View', 'Melihat Data List Spesialis Dokter'),
(134, 22, '2021-04-18 10:57:38', 'Update', 'Mengubah Data Spesialis Dokter'),
(135, 22, '2021-04-18 10:57:40', 'View', 'Melihat Data List Spesialis Dokter'),
(136, 22, '2021-04-18 10:58:04', 'View', 'Melihat Data List Spesialis Dokter'),
(137, 22, '2021-04-18 10:59:18', 'View', 'Melihat Data List Biling'),
(138, 1, '2021-04-18 11:01:08', 'Login', 'Login ke sistem'),
(139, 1, '2021-04-18 11:01:52', 'Login', 'Login ke sistem'),
(140, 1, '2021-04-20 22:23:39', 'Login', 'Login ke sistem'),
(141, 1, '2021-04-20 22:23:41', 'View', 'Melihat Data List Biling'),
(142, 1, '2021-04-20 22:23:44', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618641407'),
(143, 1, '2021-04-20 22:23:47', 'View', 'Melihat Data List Biling'),
(144, 1, '2021-04-20 22:24:26', 'View', 'Melihat Data List Biling'),
(145, 1, '2021-04-20 22:26:44', 'View', 'Melihat Data List Biling'),
(146, 1, '2021-04-20 22:27:03', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618671785'),
(147, 1, '2021-04-20 22:27:05', 'View', 'Melihat Data List Biling'),
(148, 1, '2021-04-20 22:27:06', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618641528'),
(149, 1, '2021-04-20 22:27:08', 'View', 'Melihat Data List Biling'),
(150, 1, '2021-04-20 22:27:09', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618641407'),
(151, 1, '2021-04-20 22:27:09', 'View', 'Melihat Data List Biling'),
(152, 1, '2021-04-20 22:27:17', 'View', 'Melihat Data List Biling'),
(153, 1, '2021-04-20 22:27:22', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618641407'),
(154, 1, '2021-04-20 22:27:25', 'View', 'Melihat Data List Biling'),
(155, 1, '2021-04-20 22:30:16', 'View', 'Melihat Data List Biling'),
(156, 1, '2021-04-20 22:31:02', 'View', 'Melihat Data List Biling'),
(157, 1, '2021-04-20 22:31:04', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618671785'),
(158, 1, '2021-04-20 22:31:17', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618671785'),
(159, 1, '2021-04-20 22:31:55', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618671785'),
(160, 1, '2021-04-20 22:32:06', 'View', 'Melihat Data List Biling'),
(161, 22, '2021-04-20 22:32:35', 'Login', 'Login ke sistem'),
(162, 22, '2021-04-20 22:32:37', 'View', 'Melihat Data List Biling'),
(163, 22, '2021-04-20 22:33:57', 'View', 'Melihat Data List Biling'),
(164, 22, '2021-04-20 22:34:14', 'View', 'Melihat Data List Biling'),
(165, 22, '2021-04-20 22:34:48', 'View', 'Melihat Data List Biling'),
(166, 22, '2021-04-20 22:34:50', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618671785'),
(167, 22, '2021-04-20 22:34:51', 'View', 'Melihat Data List Biling'),
(168, 22, '2021-04-20 22:34:53', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618641407'),
(169, 22, '2021-04-20 22:35:00', 'View', 'Melihat Data List Biling'),
(170, 34, '2021-04-20 22:35:10', 'Login', 'Login ke sistem'),
(171, 34, '2021-04-20 22:35:13', 'View', 'Melihat Data List Biling'),
(172, 34, '2021-04-20 22:37:03', 'View', 'Melihat Data List Biling'),
(173, 34, '2021-04-20 22:37:06', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618671785'),
(174, 34, '2021-04-20 22:37:30', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618671785'),
(175, 34, '2021-04-20 22:37:32', 'View', 'Melihat Data List Biling'),
(176, 34, '2021-04-20 22:37:33', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618641407'),
(177, 34, '2021-04-20 22:37:34', 'View', 'Melihat Data List Biling'),
(178, 1, '2021-04-20 22:37:58', 'Login', 'Login ke sistem'),
(179, 1, '2021-04-20 22:38:35', 'View', 'Melihat Data List User Dokter'),
(180, 1, '2021-04-20 22:40:59', 'View', 'Melihat Data List User Dokter'),
(181, 1, '2021-04-20 22:41:03', 'View', 'Melihat Data List User Dokter'),
(182, 1, '2021-04-20 22:41:50', 'View Detail', 'Melihat Data Detail User Dokter dengan kode DOC-00036'),
(183, 1, '2021-04-20 22:42:37', 'View Detail', 'Melihat Data Detail User Dokter dengan kode DOC-00036'),
(184, 1, '2021-04-20 22:42:41', 'View', 'Melihat Data List User Dokter'),
(185, 22, '2021-04-20 22:43:34', 'Login', 'Login ke sistem'),
(186, 22, '2021-04-20 22:43:38', 'View', 'Melihat Data List User Dokter'),
(187, 22, '2021-04-20 22:43:41', 'View', 'Melihat Data List User Dokter'),
(188, 22, '2021-04-20 22:43:42', 'View Detail', 'Melihat Data Detail User Dokter dengan kode DOC-00034'),
(189, 22, '2021-04-20 22:43:47', 'View', 'Melihat Data List User Dokter'),
(190, 22, '2021-04-20 22:43:50', 'View', 'Melihat Data List User Dokter'),
(191, 1, '2021-04-20 22:53:46', 'Login', 'Login ke sistem'),
(192, 1, '2021-04-20 22:54:12', 'View', 'Melihat Data List Biling'),
(193, 1, '2021-04-20 22:54:18', 'Export', 'Export Data Biling'),
(194, 1, '2021-04-20 22:56:26', 'View', 'Melihat Data List Biling'),
(195, 1, '2021-04-20 22:56:32', 'Export', 'Export Data Biling'),
(196, 1, '2021-04-20 22:57:35', 'View', 'Melihat Data List Biling'),
(197, 1, '2021-04-20 22:57:39', 'Export', 'Export Data Biling'),
(198, 22, '2021-04-20 22:59:04', 'Login', 'Login ke sistem'),
(199, 22, '2021-04-20 22:59:05', 'View', 'Melihat Data List Biling'),
(200, 22, '2021-04-20 22:59:07', 'Export', 'Export Data Biling'),
(201, 1, '2021-04-20 23:00:21', 'Login', 'Login ke sistem'),
(202, 1, '2021-04-20 23:00:24', 'View', 'Melihat Data List Biling'),
(203, 1, '2021-04-20 23:00:26', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618641407'),
(204, 34, '2021-04-20 23:02:15', 'Login', 'Login ke sistem'),
(205, 34, '2021-04-20 23:02:17', 'View', 'Melihat Data List Reservasi'),
(206, 34, '2021-04-20 23:02:27', 'Approve', 'Menyetujui Reservasi dengan kode RSV-16186445379'),
(207, 34, '2021-04-20 23:02:27', 'Approve', 'Menyetujui Reservasi dengan kode RSV-16186445829'),
(208, 34, '2021-04-20 23:02:27', 'View', 'Melihat Data List Reservasi'),
(209, 34, '2021-04-20 23:04:05', 'View', 'Melihat Data List Reservasi'),
(210, 34, '2021-04-20 23:04:23', 'View', 'Melihat Data List Reservasi'),
(211, 34, '2021-04-20 23:04:55', 'View', 'Melihat Data List Reservasi'),
(212, 34, '2021-04-20 23:05:09', 'Approve', 'Menyetujui Reservasi dengan kode RSV-16183664459'),
(213, 34, '2021-04-20 23:05:09', 'View', 'Melihat Data List Reservasi'),
(214, 1, '2021-04-21 10:13:19', 'Login', 'Login ke sistem'),
(215, 1, '2021-04-21 10:13:21', 'View', 'Melihat Data List Biling'),
(216, 1, '2021-04-21 10:14:03', 'View', 'Melihat Data List Biling'),
(217, 1, '2021-04-21 10:14:41', 'View', 'Melihat Data List Biling'),
(218, 1, '2021-04-21 10:15:49', 'View', 'Melihat Data List Biling'),
(219, 1, '2021-04-21 10:16:00', 'View', 'Melihat Data List Biling'),
(220, 1, '2021-04-21 10:36:09', 'View', 'Melihat Data List Biling'),
(221, 1, '2021-04-21 10:40:04', 'View', 'Melihat Data List Biling'),
(222, 1, '2021-04-21 10:40:17', 'View', 'Melihat Data List Biling'),
(223, 1, '2021-04-21 10:41:05', 'View', 'Melihat Data List Biling'),
(224, 1, '2021-04-21 10:41:18', 'View', 'Melihat Data List Biling'),
(225, 1, '2021-04-21 10:41:27', 'View', 'Melihat Data List Biling'),
(226, 1, '2021-04-21 10:43:12', 'View', 'Melihat Data List Biling'),
(227, 1, '2021-04-21 10:43:31', 'View', 'Melihat Data List Biling'),
(228, 1, '2021-04-21 10:43:32', 'View', 'Melihat Data List Biling'),
(229, 1, '2021-04-21 10:43:35', 'View', 'Melihat Data List Biling'),
(230, 1, '2021-04-21 10:43:37', 'View', 'Melihat Data List Biling'),
(231, 1, '2021-04-21 10:46:11', 'View', 'Melihat Data List Biling'),
(232, 1, '2021-04-21 10:46:17', 'View', 'Melihat Data List Biling'),
(233, 1, '2021-04-21 10:46:25', 'View', 'Melihat Data List Biling'),
(234, 1, '2021-04-21 10:46:29', 'View', 'Melihat Data List Biling'),
(235, 1, '2021-04-21 10:51:02', 'View', 'Melihat Data List Biling'),
(236, 1, '2021-04-21 10:51:03', 'View', 'Melihat Data List Biling'),
(237, 1, '2021-04-21 10:51:30', 'View', 'Melihat Data List Biling'),
(238, 1, '2021-04-21 10:51:30', 'View', 'Melihat Data List Biling'),
(239, 1, '2021-04-21 10:52:23', 'View', 'Melihat Data List Biling'),
(240, 1, '2021-04-21 10:57:51', 'View', 'Melihat Data List Biling'),
(241, 1, '2021-04-21 10:57:53', 'View', 'Melihat Data List Biling'),
(242, 1, '2021-04-21 11:02:11', 'View', 'Melihat Data List Biling'),
(243, 1, '2021-04-21 11:04:15', 'View', 'Melihat Data List Biling'),
(244, 1, '2021-04-21 11:06:00', 'View', 'Melihat Data List Biling'),
(245, 1, '2021-04-21 11:06:32', 'View', 'Melihat Data List Biling'),
(246, 1, '2021-04-21 11:07:35', 'View', 'Melihat Data List Biling'),
(247, 1, '2021-04-21 11:08:21', 'View', 'Melihat Data List Biling'),
(248, 1, '2021-04-21 11:09:06', 'View', 'Melihat Data List Biling'),
(249, 1, '2021-04-21 11:10:45', 'View', 'Melihat Data List Biling'),
(250, 1, '2021-04-21 11:12:44', 'View', 'Melihat Data List Biling'),
(251, 1, '2021-04-21 11:12:45', 'View', 'Melihat Data List Biling'),
(252, 1, '2021-04-21 11:14:22', 'View', 'Melihat Data List Biling'),
(253, 1, '2021-04-21 11:15:02', 'View', 'Melihat Data List Biling'),
(254, 1, '2021-04-21 11:15:51', 'View', 'Melihat Data List Biling'),
(255, 1, '2021-04-21 11:17:42', 'View', 'Melihat Data List Biling'),
(256, 1, '2021-04-21 11:19:18', 'View', 'Melihat Data List Biling'),
(257, 1, '2021-04-21 11:19:36', 'View', 'Melihat Data List Biling'),
(258, 1, '2021-04-21 11:19:36', 'View', 'Melihat Data List Biling'),
(259, 1, '2021-04-21 11:20:28', 'View', 'Melihat Data List Biling'),
(260, 1, '2021-04-21 11:21:52', 'View', 'Melihat Data List Biling'),
(261, 1, '2021-04-21 11:21:53', 'View', 'Melihat Data List Biling'),
(262, 1, '2021-04-21 11:23:41', 'View', 'Melihat Data List Biling'),
(263, 1, '2021-04-21 11:24:19', 'View', 'Melihat Data List Biling'),
(264, 1, '2021-04-21 11:24:58', 'View', 'Melihat Data List Biling'),
(265, 22, '2021-04-21 11:30:43', 'Login', 'Login ke sistem'),
(266, 22, '2021-04-21 11:30:48', 'View', 'Melihat Data List Biling'),
(267, 22, '2021-04-21 11:30:51', 'View', 'Melihat Data List Biling'),
(268, 22, '2021-04-21 11:31:36', 'View', 'Melihat Data List Biling'),
(269, 22, '2021-04-21 11:32:01', 'Export', 'Export PDF Data Biling'),
(270, 22, '2021-04-21 11:32:01', 'Export', 'Export PDF Data Biling'),
(271, 22, '2021-04-21 11:32:14', 'Export', 'Export PDF Data Biling'),
(272, 22, '2021-04-21 11:32:16', 'Export', 'Export PDF Data Biling'),
(273, 22, '2021-04-21 11:32:26', 'Export', 'Export Excel Data Biling'),
(274, 22, '2021-04-21 11:39:37', 'View', 'Melihat Data List Reservasi'),
(275, 22, '2021-04-21 11:39:38', 'View', 'Melihat Data List Reservasi'),
(276, 1, '2021-04-21 11:39:48', 'Login', 'Login ke sistem'),
(277, 1, '2021-04-21 11:41:29', 'View', 'Melihat Data List Reservasi'),
(278, 1, '2021-04-21 11:41:34', 'Export', 'Export PDF Data Biling'),
(279, 1, '2021-04-21 11:41:34', 'Export', 'Export PDF Data Biling'),
(280, 1, '2021-04-21 11:42:05', 'View', 'Melihat Data List Reservasi'),
(281, 1, '2021-04-21 11:42:07', 'Export', 'Export PDF Data Reservasi'),
(282, 1, '2021-04-21 11:42:36', 'View', 'Melihat Data List Reservasi'),
(283, 1, '2021-04-21 11:42:37', 'View', 'Melihat Data List Reservasi'),
(284, 1, '2021-04-21 11:42:39', 'Export', 'Export PDF Data Reservasi'),
(285, 1, '2021-04-21 11:42:40', 'Export', 'Export PDF Data Reservasi'),
(286, 1, '2021-04-21 11:43:52', 'View', 'Melihat Data List Reservasi'),
(287, 1, '2021-04-21 11:43:55', 'Export', 'Export PDF Data Reservasi'),
(288, 1, '2021-04-21 11:43:56', 'Export', 'Export PDF Data Reservasi'),
(289, 1, '2021-04-21 11:44:34', 'View', 'Melihat Data List Reservasi'),
(290, 1, '2021-04-21 11:44:37', 'Export', 'Export PDF Data Reservasi'),
(291, 1, '2021-04-21 11:44:39', 'Export', 'Export PDF Data Reservasi'),
(292, 1, '2021-04-21 11:45:02', 'View', 'Melihat Data List Reservasi'),
(293, 1, '2021-04-21 11:45:05', 'Export', 'Export PDF Data Reservasi'),
(294, 1, '2021-04-21 11:45:06', 'Export', 'Export PDF Data Reservasi'),
(295, 22, '2021-04-21 11:48:07', 'Login', 'Login ke sistem'),
(296, 22, '2021-04-21 11:48:13', 'View', 'Melihat Data List Reservasi'),
(297, 22, '2021-04-21 11:48:15', 'Export', 'Export PDF Data Reservasi'),
(298, 22, '2021-04-21 11:48:15', 'Export', 'Export PDF Data Reservasi'),
(299, 22, '2021-04-21 11:48:30', 'Export', 'Export PDF Data Reservasi'),
(300, 22, '2021-04-21 11:48:31', 'Export', 'Export PDF Data Reservasi'),
(301, 22, '2021-04-21 11:48:40', 'Export', 'Export Data Reservasi'),
(302, 22, '2021-04-21 11:49:09', 'View', 'Melihat Data List Biling'),
(303, 22, '2021-04-21 11:49:11', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618641407'),
(304, 34, '2021-04-22 13:05:52', 'Login', 'Login ke sistem'),
(305, 34, '2021-04-22 13:05:56', 'View', 'Melihat Data List User Klien'),
(306, 34, '2021-04-22 13:05:57', 'View Detail', 'Melihat Data Detail User Klien dengan kode CLI-00033'),
(307, 34, '2021-04-22 13:06:00', 'View', 'Melihat Data List User Klien'),
(308, 34, '2021-04-22 13:06:01', 'View Detail', 'Melihat Data Detail User Klien dengan kode CLI-00033'),
(309, 34, '2021-04-22 13:06:04', 'View', 'Melihat Data List User Klien'),
(310, 34, '2021-04-22 13:06:08', 'View Detail', 'Melihat Data Detail User Klien dengan kode CLI-00033'),
(311, 34, '2021-04-22 13:06:12', 'View', 'Melihat Data List User Klien'),
(312, 34, '2021-04-22 13:07:04', 'View Detail', 'Melihat Data Detail User Klien dengan kode CLI-00033'),
(313, 34, '2021-04-22 13:07:36', 'View Detail', 'Melihat Data Detail User Klien dengan kode CLI-00033'),
(314, 34, '2021-04-22 13:07:40', 'View Detail', 'Melihat Data Detail User Klien dengan kode CLI-00033'),
(315, 34, '2021-04-22 13:08:38', 'View Detail', 'Melihat Data Detail User Klien dengan kode CLI-00033'),
(316, 34, '2021-04-22 13:08:40', 'View', 'Melihat Data List User Klien'),
(317, 34, '2021-04-22 13:09:19', 'View', 'Melihat Data List Reservasi'),
(318, 34, '2021-04-22 13:09:24', 'View', 'Melihat Data List Biling'),
(319, 34, '2021-04-22 13:10:03', 'Input', 'Membuat Biling'),
(320, 34, '2021-04-22 13:10:03', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(321, 34, '2021-04-22 13:11:52', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(322, 34, '2021-04-22 13:11:54', 'View', 'Melihat Data List Biling'),
(323, 34, '2021-04-22 13:11:56', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(324, 34, '2021-04-22 13:12:25', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(325, 34, '2021-04-22 13:13:06', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(326, 34, '2021-04-22 13:13:34', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(327, 34, '2021-04-22 13:14:35', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(328, 34, '2021-04-22 13:14:52', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(329, 34, '2021-04-22 13:15:09', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(330, 34, '2021-04-22 13:16:43', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(331, 34, '2021-04-22 13:16:57', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(332, 34, '2021-04-22 13:17:12', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(333, 34, '2021-04-22 13:17:33', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(334, 34, '2021-04-22 13:18:00', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(335, 34, '2021-04-22 13:19:00', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(336, 34, '2021-04-22 13:19:08', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(337, 34, '2021-04-22 13:20:00', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(338, 34, '2021-04-22 13:20:35', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(339, 34, '2021-04-22 13:21:24', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(340, 34, '2021-04-22 13:21:37', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(341, 34, '2021-04-22 13:22:25', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(342, 34, '2021-04-22 13:22:52', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(343, 34, '2021-04-22 13:23:14', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(344, 34, '2021-04-22 13:23:44', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(345, 34, '2021-04-22 13:24:25', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(346, 34, '2021-04-22 13:24:29', 'View', 'Melihat Data List Biling'),
(347, 34, '2021-04-22 13:24:32', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(348, 34, '2021-04-22 13:24:33', 'View', 'Melihat Data List Biling'),
(349, 34, '2021-04-22 13:25:26', 'View', 'Melihat Data List Biling'),
(350, 34, '2021-04-22 13:25:38', 'View', 'Melihat Data List Biling'),
(351, 34, '2021-04-22 13:26:03', 'View', 'Melihat Data List User Klien'),
(352, 34, '2021-04-22 13:26:04', 'View', 'Melihat Data List Biling'),
(353, 34, '2021-04-22 13:26:36', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(354, 34, '2021-04-22 13:28:39', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(355, 34, '2021-04-22 13:28:57', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(356, 34, '2021-04-22 13:29:24', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(357, 1, '2021-04-22 13:29:50', 'Login', 'Login ke sistem'),
(358, 1, '2021-04-22 13:29:52', 'View', 'Melihat Data List Biling'),
(359, 1, '2021-04-22 13:29:53', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(360, 1, '2021-04-22 13:30:26', 'View', 'Melihat Data List Biling'),
(361, 1, '2021-04-22 13:31:45', 'Export', 'Export Excel Data Biling'),
(362, 1, '2021-04-22 13:31:56', 'Export', 'Export PDF Data Biling'),
(363, 1, '2021-04-22 13:31:57', 'Export', 'Export PDF Data Biling'),
(364, 22, '2021-04-22 13:32:24', 'Login', 'Login ke sistem'),
(365, 22, '2021-04-22 13:32:26', 'View', 'Melihat Data List Biling'),
(366, 22, '2021-04-22 13:32:27', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(367, 22, '2021-04-22 13:32:28', 'View', 'Melihat Data List Biling'),
(368, 22, '2021-04-22 13:32:45', 'View', 'Melihat Data List Biling'),
(369, 1, '2021-04-22 13:33:13', 'Login', 'Login ke sistem'),
(370, 1, '2021-04-22 13:33:16', 'View', 'Melihat Data List Biling'),
(371, 34, '2021-04-22 13:33:28', 'Login', 'Login ke sistem'),
(372, 34, '2021-04-22 13:33:29', 'View', 'Melihat Data List Biling'),
(373, 34, '2021-04-22 13:35:29', 'View', 'Melihat Data List Biling'),
(374, 34, '2021-04-22 13:35:31', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(375, 34, '2021-04-22 13:45:28', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(376, 34, '2021-04-22 13:45:30', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(377, 22, '2021-04-22 13:45:46', 'Login', 'Login ke sistem'),
(378, 22, '2021-04-22 13:45:47', 'View', 'Melihat Data List Biling'),
(379, 22, '2021-04-22 13:45:50', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(380, 1, '2021-04-22 13:48:12', 'Login', 'Login ke sistem'),
(381, 1, '2021-04-22 13:48:14', 'View', 'Melihat Data List Biling'),
(382, 1, '2021-04-22 13:48:15', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(383, 1, '2021-04-22 13:49:19', 'Login', 'Login ke sistem'),
(384, 1, '2021-04-22 13:49:21', 'View', 'Melihat Data List Biling'),
(385, 1, '2021-04-22 13:49:23', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618671785'),
(386, 1, '2021-04-22 13:49:34', 'View', 'Melihat Data List Biling'),
(387, 22, '2021-04-22 13:49:52', 'Login', 'Login ke sistem'),
(388, 22, '2021-04-22 13:49:54', 'View', 'Melihat Data List Biling'),
(389, 22, '2021-04-22 13:49:55', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618671785'),
(390, 34, '2021-04-22 13:50:07', 'Login', 'Login ke sistem'),
(391, 34, '2021-04-22 13:50:08', 'View', 'Melihat Data List Biling'),
(392, 34, '2021-04-22 13:50:10', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(393, 34, '2021-04-22 13:50:28', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(394, 34, '2021-04-22 13:50:35', 'View', 'Melihat Data List Biling'),
(395, 33, '2021-04-22 13:53:57', 'Login', 'Login ke sistem'),
(396, 33, '2021-04-23 13:18:27', 'Login', 'Login ke sistem'),
(397, 33, '2021-04-23 13:49:26', 'Input', 'Membuat Reservasi pada tanggal Kamis, 22 April 2021 '),
(398, 33, '2021-04-23 13:49:27', 'View Detail', 'Melihat Data Detail Reservasi dengan kode RSV-16191605589'),
(399, 33, '2021-04-23 13:53:24', 'View', 'Melihat Data List Reservasi'),
(400, 33, '2021-04-23 13:53:51', 'Input', 'Membuat Reservasi pada tanggal Jumat, 16 April 2021 '),
(401, 33, '2021-04-23 13:53:51', 'View Detail', 'Melihat Data Detail Reservasi dengan kode RSV-16191608229'),
(402, 33, '2021-04-23 13:56:56', 'View', 'Melihat Data List Reservasi'),
(403, 33, '2021-04-23 13:57:24', 'Input', 'Membuat Reservasi pada tanggal Sabtu, 10 April 2021 '),
(404, 33, '2021-04-23 13:57:24', 'View Detail', 'Melihat Data Detail Reservasi dengan kode RSV-16191610359'),
(405, 33, '2021-04-23 13:58:21', 'View', 'Melihat Data List Reservasi'),
(406, 33, '2021-04-23 13:59:24', 'Input', 'Membuat Reservasi pada tanggal Sabtu, 03 April 2021 '),
(407, 33, '2021-04-23 13:59:24', 'View Detail', 'Melihat Data Detail Reservasi dengan kode RSV-16191611559'),
(408, 33, '2021-04-23 14:00:58', 'View', 'Melihat Data List Reservasi'),
(409, 33, '2021-04-23 14:01:00', 'View', 'Melihat Data List Reservasi'),
(410, 33, '2021-04-23 14:10:22', 'View', 'Melihat Data List Reservasi'),
(411, 33, '2021-04-23 14:10:40', 'Reschedule', 'Mengubah Jadwal Reservasi dengan kode RSV-16191611559 menjadi tanggal Sabtu, 03 April 2021  dan jam 10.00 WIB'),
(412, 33, '2021-04-23 14:10:40', 'View Detail', 'Melihat Data Detail Reservasi dengan kode RSV-16191611559'),
(413, 33, '2021-04-23 14:14:29', 'View', 'Melihat Data List Reservasi'),
(414, 33, '2021-04-23 14:14:51', 'Reschedule', 'Mengubah Jadwal Reservasi dengan kode RSV-16183664459 menjadi tanggal Rabu, 19 Mei 2021  dan jam 10.00 WIB'),
(415, 33, '2021-04-23 14:14:51', 'View Detail', 'Melihat Data Detail Reservasi dengan kode RSV-16183664459'),
(416, 33, '2021-04-23 14:15:20', 'View', 'Melihat Data List Reservasi'),
(417, 33, '2021-04-23 14:15:32', 'View', 'Melihat Data List Reservasi'),
(418, 33, '2021-04-23 14:15:35', 'View', 'Melihat Data List Reservasi'),
(419, 33, '2021-04-23 14:15:37', 'View', 'Melihat Data List Reservasi'),
(420, 33, '2021-04-23 14:15:40', 'View', 'Melihat Data List Reservasi'),
(421, 33, '2021-04-23 14:18:21', 'View', 'Melihat Data List Reservasi'),
(422, 33, '2021-04-23 14:18:41', 'Reschedule', 'Mengubah Jadwal Reservasi dengan kode RSV-16191610359 menjadi tanggal Rabu, 28 April 2021  dan jam 10.00 WIB'),
(423, 33, '2021-04-23 14:18:41', 'View Detail', 'Melihat Data Detail Reservasi dengan kode RSV-16191610359'),
(424, 33, '2021-04-23 14:19:05', 'View', 'Melihat Data List User Dokter'),
(425, 33, '2021-04-23 14:19:07', 'View', 'Melihat Data List Reservasi'),
(426, 33, '2021-04-23 14:20:26', 'Reschedule', 'Mengubah Jadwal Reservasi dengan kode RSV-16191610359 menjadi tanggal Kamis, 29 April 2021  dan jam 10.00 WIB'),
(427, 33, '2021-04-23 14:20:26', 'View Detail', 'Melihat Data Detail Reservasi dengan kode RSV-16191610359'),
(428, 33, '2021-04-23 14:20:57', 'View', 'Melihat Data List Reservasi'),
(429, 33, '2021-04-23 14:21:15', 'Reschedule', 'Mengubah Jadwal Reservasi dengan kode RSV-16191610359 menjadi tanggal Kamis, 29 April 2021  dan jam 10.00 WIB'),
(430, 33, '2021-04-23 14:21:15', 'View Detail', 'Melihat Data Detail Reservasi dengan kode RSV-16191610359'),
(431, 34, '2021-04-23 14:22:56', 'Login', 'Login ke sistem'),
(432, 34, '2021-04-23 14:23:02', 'View', 'Melihat Data List Reservasi'),
(433, 34, '2021-04-23 14:33:53', 'View', 'Melihat Data List Reservasi'),
(434, 34, '2021-04-23 14:34:07', 'View', 'Melihat Data List Reservasi'),
(435, 34, '2021-04-23 14:34:25', 'Approve', 'Menyetujui Reservasi dengan kode RSV-16191611559'),
(436, 34, '2021-04-23 14:34:25', 'View', 'Melihat Data List Reservasi'),
(437, 34, '2021-04-23 14:35:23', 'Reject', 'Menolak Reservasi dengan kode RSV-16191605589'),
(438, 34, '2021-04-23 14:35:31', 'Reject', 'Menolak Reservasi dengan kode RSV-16191608229'),
(439, 34, '2021-04-23 14:35:31', 'View', 'Melihat Data List Reservasi'),
(440, 34, '2021-04-23 14:36:59', 'View', 'Melihat Data List Biling'),
(441, 34, '2021-04-23 14:37:01', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(442, 34, '2021-04-23 14:37:46', 'View', 'Melihat Data List Biling'),
(443, 34, '2021-04-23 14:40:11', 'View', 'Melihat Data List Biling'),
(444, 34, '2021-04-23 14:40:17', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(445, 34, '2021-04-23 14:40:21', 'View', 'Melihat Data List Biling'),
(446, 34, '2021-04-23 14:40:26', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(447, 34, '2021-04-23 14:40:27', 'View', 'Melihat Data List Biling'),
(448, 34, '2021-04-23 14:50:52', 'View', 'Melihat Data List Biling'),
(449, 34, '2021-04-23 14:50:55', 'View', 'Melihat Data List Biling'),
(450, 34, '2021-04-23 14:51:08', 'View', 'Melihat Data List Biling'),
(451, 34, '2021-04-23 14:51:15', 'View', 'Melihat Data List Biling'),
(452, 34, '2021-04-23 14:56:04', 'View', 'Melihat Data List Biling'),
(453, 34, '2021-04-23 16:13:46', 'View', 'Melihat Data List Biling'),
(454, 34, '2021-04-23 16:13:49', 'View', 'Melihat Data List Biling'),
(455, 34, '2021-04-23 16:13:56', 'View', 'Melihat Data List Biling'),
(456, 34, '2021-04-23 16:16:51', 'View', 'Melihat Data List Biling'),
(457, 34, '2021-04-23 16:17:18', 'View', 'Melihat Data List Biling'),
(458, 34, '2021-04-23 16:17:18', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(459, 34, '2021-04-23 16:17:21', 'View', 'Melihat Data List Biling'),
(460, 34, '2021-04-23 16:18:11', 'View', 'Melihat Data List Biling'),
(461, 34, '2021-04-23 16:27:07', 'View', 'Melihat Data List Biling'),
(462, 34, '2021-04-23 16:34:49', 'View', 'Melihat Data List Biling'),
(463, 34, '2021-04-23 16:35:41', 'View', 'Melihat Data List Biling'),
(464, 34, '2021-04-23 16:36:17', 'Input', 'Membuat Biling'),
(465, 34, '2021-04-23 16:36:17', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(466, 34, '2021-04-23 16:37:13', 'Login', 'Login ke sistem'),
(467, 34, '2021-04-23 16:37:15', 'View', 'Melihat Data List Biling'),
(468, 34, '2021-04-23 16:37:20', 'View', 'Melihat Data List Biling'),
(469, 34, '2021-04-23 16:37:22', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(470, 34, '2021-04-23 16:37:46', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(471, 34, '2021-04-23 16:37:48', 'View', 'Melihat Data List Biling'),
(472, 34, '2021-04-23 16:38:16', 'Input', 'Membuat Biling'),
(473, 34, '2021-04-23 16:38:16', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(474, 22, '2021-04-23 16:42:54', 'Login', 'Login ke sistem'),
(475, 22, '2021-04-23 16:42:55', 'View', 'Melihat Data List Biling'),
(476, 22, '2021-04-23 16:43:20', 'View', 'Melihat Data List Biling'),
(477, 22, '2021-04-23 16:43:45', 'Update', 'Mengubah Biling dengan kode BIL-001619071803'),
(478, 22, '2021-04-23 16:43:45', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(479, 22, '2021-04-23 16:44:11', 'View', 'Melihat Data List Biling'),
(480, 22, '2021-04-23 16:44:33', 'Update', 'Mengubah Biling dengan kode BIL-001619071803'),
(481, 22, '2021-04-23 16:44:33', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(482, 22, '2021-04-23 16:45:37', 'View', 'Melihat Data List Biling'),
(483, 22, '2021-04-23 16:45:48', 'Update', 'Mengubah Biling dengan kode BIL-001619071803'),
(484, 22, '2021-04-23 16:45:48', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(485, 22, '2021-04-23 16:46:01', 'View', 'Melihat Data List Biling'),
(486, 22, '2021-04-23 16:46:49', 'Update', 'Mengubah Biling dengan kode BIL-001619071803'),
(487, 22, '2021-04-23 16:46:49', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(488, 22, '2021-04-23 16:46:52', 'View', 'Melihat Data List Biling'),
(489, 22, '2021-04-23 16:47:11', 'Update', 'Mengubah Biling dengan kode BIL-001619071803'),
(490, 22, '2021-04-23 16:47:11', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(491, 22, '2021-04-23 16:47:46', 'View', 'Melihat Data List Biling'),
(492, 22, '2021-04-23 16:47:59', 'Update', 'Mengubah Biling dengan kode BIL-001619071803'),
(493, 22, '2021-04-23 16:47:59', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(494, 22, '2021-04-23 16:48:04', 'View', 'Melihat Data List Biling'),
(495, 22, '2021-04-23 16:48:15', 'Update', 'Mengubah Biling dengan kode BIL-001619071803'),
(496, 22, '2021-04-23 16:48:15', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(497, 22, '2021-04-23 16:49:28', 'View', 'Melihat Data List Biling'),
(498, 22, '2021-04-23 16:49:33', 'View', 'Melihat Data List Biling'),
(499, 22, '2021-04-23 16:49:41', 'Update', 'Mengubah Biling dengan kode BIL-001619071803'),
(500, 22, '2021-04-23 16:49:41', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(501, 22, '2021-04-23 16:50:50', 'View', 'Melihat Data List Biling'),
(502, 22, '2021-04-23 16:50:55', 'Update', 'Mengubah Biling dengan kode BIL-001619071803'),
(503, 22, '2021-04-23 16:50:55', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(504, 22, '2021-04-23 16:50:59', 'View', 'Melihat Data List Biling'),
(505, 34, '2021-04-23 16:51:09', 'Login', 'Login ke sistem'),
(506, 34, '2021-04-23 16:51:12', 'View', 'Melihat Data List User Klien'),
(507, 34, '2021-04-23 16:51:13', 'View', 'Melihat Data List Biling'),
(508, 34, '2021-04-23 16:51:22', 'Update', 'Mengubah Biling dengan kode BIL-001619071803'),
(509, 34, '2021-04-23 16:51:22', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(510, 34, '2021-04-23 16:52:15', 'View', 'Melihat Data List Biling'),
(511, 34, '2021-04-23 16:52:21', 'Update', 'Mengubah Biling dengan kode BIL-001619071803'),
(512, 34, '2021-04-23 16:52:21', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(513, 34, '2021-04-23 16:52:55', 'View', 'Melihat Data List Biling'),
(514, 34, '2021-04-23 16:53:04', 'Update', 'Mengubah Biling dengan kode BIL-001619071803'),
(515, 34, '2021-04-23 16:53:05', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(516, 34, '2021-04-23 16:53:09', 'View', 'Melihat Data List Biling'),
(517, 34, '2021-04-23 16:53:22', 'Update', 'Mengubah Biling dengan kode BIL-001619071803'),
(518, 34, '2021-04-23 16:53:22', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(519, 34, '2021-04-23 16:53:52', 'View', 'Melihat Data List Biling'),
(520, 34, '2021-04-23 16:54:02', 'Update', 'Mengubah Biling dengan kode BIL-001619071803'),
(521, 34, '2021-04-23 16:54:02', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(522, 34, '2021-04-23 16:55:05', 'View', 'Melihat Data List Biling'),
(523, 34, '2021-04-23 16:55:24', 'Update', 'Mengubah Biling dengan kode BIL-001619071803'),
(524, 34, '2021-04-23 16:55:24', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001619071803'),
(525, 34, '2021-04-23 16:55:28', 'View', 'Melihat Data List Biling'),
(526, 34, '2021-04-23 16:55:46', 'Update', 'Mengubah Biling dengan kode BIL-001618671785'),
(527, 34, '2021-04-23 16:55:46', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618671785'),
(528, 34, '2021-04-23 16:55:51', 'View', 'Melihat Data List Biling'),
(529, 34, '2021-04-23 16:57:19', 'Update', 'Mengubah Biling dengan kode BIL-001618671785'),
(530, 34, '2021-04-23 16:57:19', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618671785'),
(531, 34, '2021-04-23 16:57:53', 'View', 'Melihat Data List Biling'),
(532, 34, '2021-04-23 16:58:01', 'Update', 'Mengubah Biling dengan kode BIL-001618671785'),
(533, 34, '2021-04-23 16:58:01', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618671785'),
(534, 34, '2021-04-23 16:58:04', 'View', 'Melihat Data List Biling'),
(535, 34, '2021-04-23 17:00:24', 'Update', 'Mengubah Biling dengan kode BIL-001618671785'),
(536, 34, '2021-04-23 17:00:24', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618671785'),
(537, 34, '2021-04-23 17:00:26', 'View', 'Melihat Data List Biling'),
(538, 34, '2021-04-23 17:00:40', 'Update', 'Mengubah Biling dengan kode BIL-001618671785'),
(539, 34, '2021-04-23 17:00:40', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618671785'),
(540, 34, '2021-04-23 17:00:45', 'View', 'Melihat Data List Biling'),
(541, 34, '2021-04-23 17:01:16', 'View', 'Melihat Data List Biling'),
(542, 34, '2021-04-23 17:01:23', 'Update', 'Mengubah Biling dengan kode BIL-001618671785'),
(543, 34, '2021-04-23 17:01:23', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618671785'),
(544, 34, '2021-04-23 17:01:28', 'View', 'Melihat Data List Biling'),
(545, 34, '2021-04-23 17:01:37', 'Update', 'Mengubah Biling dengan kode BIL-001618671785'),
(546, 34, '2021-04-23 17:01:37', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618671785'),
(547, 34, '2021-04-23 17:01:39', 'View', 'Melihat Data List Biling'),
(548, 34, '2021-04-23 17:01:57', 'Update', 'Mengubah Biling dengan kode BIL-001618671785'),
(549, 34, '2021-04-23 17:01:57', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618671785'),
(550, 34, '2021-04-23 17:03:04', 'View', 'Melihat Data List Biling'),
(551, 34, '2021-04-23 17:03:11', 'Update', 'Mengubah Biling dengan kode BIL-001618671785'),
(552, 34, '2021-04-23 17:03:11', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618671785'),
(553, 22, '2021-04-23 17:11:35', 'Login', 'Login ke sistem'),
(554, 22, '2021-04-23 17:11:38', 'View', 'Melihat Data List Biling'),
(555, 22, '2021-04-23 17:12:06', 'Update', 'Mengubah Biling dengan kode BIL-001618671785'),
(556, 22, '2021-04-23 17:12:06', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618671785'),
(557, 22, '2021-04-23 17:12:10', 'View', 'Melihat Data List Biling'),
(558, 22, '2021-04-23 17:12:16', 'Update', 'Mengubah Biling dengan kode BIL-001618671785'),
(559, 22, '2021-04-23 17:12:16', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618671785'),
(560, 22, '2021-04-23 17:12:18', 'View', 'Melihat Data List Biling'),
(561, 22, '2021-04-23 17:12:23', 'Update', 'Mengubah Biling dengan kode BIL-001618671785'),
(562, 22, '2021-04-23 17:12:24', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618671785'),
(563, 22, '2021-04-23 17:15:30', 'View', 'Melihat Data List Biling'),
(564, 22, '2021-04-23 17:15:33', 'View', 'Melihat Data List Biling'),
(565, 22, '2021-04-23 17:15:38', 'View', 'Melihat Data List Biling'),
(566, 22, '2021-04-23 17:15:39', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618671785'),
(567, 22, '2021-04-23 17:15:40', 'View', 'Melihat Data List Biling'),
(568, 1, '2021-04-23 17:15:50', 'Login', 'Login ke sistem'),
(569, 1, '2021-04-23 17:15:52', 'View', 'Melihat Data List Biling'),
(570, 1, '2021-04-23 17:16:03', 'Update', 'Mengubah Biling dengan kode BIL-001618671785'),
(571, 1, '2021-04-23 17:16:03', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618671785'),
(572, 1, '2021-04-23 17:16:10', 'View', 'Melihat Data List Biling'),
(573, 1, '2021-04-23 17:16:27', 'Update', 'Mengubah Biling dengan kode BIL-001618671785'),
(574, 1, '2021-04-23 17:16:27', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618671785'),
(575, 1, '2021-04-23 17:16:34', 'View', 'Melihat Data List Biling'),
(576, 1, '2021-04-23 17:16:52', 'View', 'Melihat Data List Biling'),
(577, 1, '2021-04-23 17:16:57', 'View', 'Melihat Data List Biling'),
(578, 1, '2021-04-23 17:16:59', 'View', 'Melihat Data List Biling'),
(579, 1, '2021-04-23 17:17:01', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618671785'),
(580, 1, '2021-04-23 17:17:03', 'View', 'Melihat Data List Biling'),
(581, 1, '2021-04-23 19:05:28', 'Login', 'Login ke sistem'),
(582, 1, '2021-04-23 19:09:35', 'Login', 'Login ke sistem'),
(583, 1, '2021-04-25 18:03:36', 'Login', 'Login ke sistem'),
(584, 1, '2021-04-25 18:03:53', 'Login', 'Login ke sistem'),
(585, 1, '2021-04-25 18:06:30', 'Login', 'Login ke sistem'),
(586, 1, '2021-04-25 18:08:21', 'Login', 'Login ke sistem'),
(587, 22, '2021-04-26 10:22:29', 'Login', 'Login ke sistem'),
(588, 22, '2021-04-26 10:28:47', 'View', 'Melihat Data List User Klien'),
(589, 22, '2021-04-26 10:40:42', 'View', 'Melihat Data List User Klien'),
(590, 1, '2021-04-26 13:37:19', 'Login', 'Login ke sistem'),
(591, 1, '2021-04-26 13:37:23', 'View', 'Melihat Data List User Klien'),
(592, 1, '2021-04-26 13:39:07', 'View', 'Melihat Data List User Klien'),
(593, 1, '2021-04-26 13:39:37', 'Input', 'Menambahkan Data User Klien'),
(594, 1, '2021-04-26 13:39:42', 'View', 'Melihat Data List User Klien'),
(595, 1, '2021-04-26 13:39:46', 'View Detail', 'Melihat Data Detail User Klien dengan kode CLI-00037'),
(596, 1, '2021-04-26 13:40:12', 'View Detail', 'Melihat Data Detail User Klien dengan kode CLI-00037'),
(597, 1, '2021-04-26 13:40:15', 'View', 'Melihat Data List User Klien'),
(598, 1, '2021-04-26 13:40:18', 'View Detail', 'Melihat Data Detail User Klien dengan kode CLI-00037'),
(599, 1, '2021-04-26 13:40:19', 'View', 'Melihat Data List User Klien'),
(600, 1, '2021-04-26 13:40:35', 'Update', 'Mengubah Data User Klien dengan kode CLI-00037'),
(601, 1, '2021-04-26 13:40:40', 'View', 'Melihat Data List User Klien'),
(602, 1, '2021-04-26 13:40:47', 'Deactivate', 'Nonaktigkan Data User Klien dengan kode CLI-00037'),
(603, 1, '2021-04-26 13:40:47', 'View', 'Melihat Data List User Klien'),
(604, 1, '2021-04-26 13:40:51', 'Activate', 'Mengaktifkan Data User Klien dengan kode CLI-00037'),
(605, 1, '2021-04-26 13:40:51', 'View', 'Melihat Data List User Klien'),
(606, 1, '2021-04-26 13:40:59', 'Delete', 'Menghapus Data User Klien dengan kode '),
(607, 1, '2021-04-26 13:40:59', 'View', 'Melihat Data List User Klien'),
(608, 34, '2021-04-26 13:43:01', 'Login', 'Login ke sistem'),
(609, 34, '2021-04-26 13:43:03', 'View', 'Melihat Data List Biling'),
(610, 34, '2021-04-26 13:43:28', 'View', 'Melihat Data List Reservasi'),
(611, 33, '2021-04-26 13:43:46', 'Login', 'Login ke sistem'),
(612, 33, '2021-04-26 13:43:50', 'View', 'Melihat Data List Reservasi'),
(613, 33, '2021-04-26 13:44:26', 'Input', 'Membuat Reservasi pada tanggal Jumat, 30 April 2021 '),
(614, 33, '2021-04-26 13:44:26', 'View Detail', 'Melihat Data Detail Reservasi dengan kode RSV-16194194529'),
(615, 34, '2021-04-26 13:44:39', 'Login', 'Login ke sistem'),
(616, 34, '2021-04-26 13:46:18', 'View', 'Melihat Data List Reservasi'),
(617, 34, '2021-04-26 13:46:19', 'View', 'Melihat Data List Biling'),
(618, 34, '2021-04-26 13:46:27', 'View', 'Melihat Data List Reservasi'),
(619, 34, '2021-04-26 13:46:44', 'Approve', 'Menyetujui Reservasi dengan kode RSV-16194194529'),
(620, 34, '2021-04-26 13:46:44', 'View', 'Melihat Data List Reservasi'),
(621, 34, '2021-04-26 13:47:44', 'View', 'Melihat Data List Biling'),
(622, 34, '2021-04-26 13:47:56', 'View', 'Melihat Data List Biling'),
(623, 34, '2021-04-26 13:47:56', 'View', 'Melihat Data List Reservasi'),
(624, 34, '2021-04-26 13:48:08', 'View', 'Melihat Data List Reservasi'),
(625, 34, '2021-04-26 13:48:10', 'View', 'Melihat Data List Biling'),
(626, 34, '2021-04-26 13:48:11', 'View', 'Melihat Data List Biling'),
(627, 34, '2021-04-26 13:49:18', 'View', 'Melihat Data List Biling'),
(628, 34, '2021-04-26 13:49:28', 'View', 'Melihat Data List Reservasi'),
(629, 34, '2021-04-26 13:49:30', 'View', 'Melihat Data List Biling'),
(630, 34, '2021-04-26 13:57:05', 'View', 'Melihat Data List Reservasi'),
(631, 34, '2021-04-26 13:57:06', 'View', 'Melihat Data List User Klien'),
(632, 34, '2021-04-26 13:57:07', 'View', 'Melihat Data List Biling'),
(633, 1, '2021-04-26 13:57:22', 'Login', 'Login ke sistem'),
(634, 22, '2021-04-26 13:57:47', 'Login', 'Login ke sistem'),
(635, 22, '2021-04-26 13:59:39', 'View', 'Melihat Data List Biling'),
(636, 22, '2021-04-26 13:59:42', 'View Detail', 'Melihat Data Detail Biling dengan kode BIL-001618641407'),
(637, 22, '2021-04-26 13:59:44', 'View', 'Melihat Data List Biling'),
(638, 22, '2021-04-26 13:59:46', 'View', 'Melihat Data List Biling'),
(639, 34, '2021-04-26 13:59:57', 'Login', 'Login ke sistem'),
(640, 34, '2021-04-26 14:00:31', 'View', 'Melihat Data List Reservasi'),
(641, 34, '2021-04-26 14:00:31', 'View', 'Melihat Data List User Klien'),
(642, 34, '2021-04-26 14:00:32', 'View', 'Melihat Data List Biling');

-- --------------------------------------------------------

--
-- Table structure for table `jam_reservasi`
--

CREATE TABLE `jam_reservasi` (
  `id` int(11) NOT NULL,
  `jam` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jam_reservasi`
--

INSERT INTO `jam_reservasi` (`id`, `jam`) VALUES
(1, '08.00'),
(2, '10.00'),
(3, '13.00'),
(4, '15.00'),
(5, '17.00');

-- --------------------------------------------------------

--
-- Table structure for table `klien`
--

CREATE TABLE `klien` (
  `id_klien` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kode_klien` varchar(16) DEFAULT NULL,
  `nama_klien` varchar(128) DEFAULT NULL,
  `tgl_lahir_klien` date DEFAULT NULL,
  `jenis_kelamin_klien` tinyint(1) DEFAULT 1,
  `no_hp_klien` varchar(16) DEFAULT NULL,
  `alamat_klien` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `klien`
--

INSERT INTO `klien` (`id_klien`, `id_user`, `kode_klien`, `nama_klien`, `tgl_lahir_klien`, `jenis_kelamin_klien`, `no_hp_klien`, `alamat_klien`) VALUES
(9, 33, 'CLI-00033', 'Clien Pertama', '2021-04-08', 2, '6565656565', '987987987');

-- --------------------------------------------------------

--
-- Table structure for table `reservasi`
--

CREATE TABLE `reservasi` (
  `id_reservasi` int(11) NOT NULL,
  `id_klien` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `kode_reservasi` varchar(32) NOT NULL,
  `nama_klien` varchar(128) NOT NULL,
  `alamat_klien` text NOT NULL,
  `tgl_reservasi` date NOT NULL,
  `jam_reservasi` varchar(16) NOT NULL,
  `keluhan` text NOT NULL,
  `jumlah_hewan` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0: mengunggu, 1: setuju, 2: tolak, 3:batal',
  `created_by` tinyint(4) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservasi`
--

INSERT INTO `reservasi` (`id_reservasi`, `id_klien`, `id_dokter`, `kode_reservasi`, `nama_klien`, `alamat_klien`, `tgl_reservasi`, `jam_reservasi`, `keluhan`, `jumlah_hewan`, `status`, `created_by`, `date_created`) VALUES
(1, 9, 1, 'RSV-1618', 'Klien Satu', 'Jl. Alamat Klien Satu', '2020-04-09', '10.00 WIB', 'Mual', 2, 1, 33, 1618366373),
(2, 9, 1, 'RSV-16183664459', 'Klien Dua', 'Jl. Alamat Klien Dua', '2021-05-19', '10.00 WIB', 'Keluhan', 3, 1, 33, 1618366445),
(12, 9, 1, 'RSV-16194194529', 'Klien Add', 'ckuadm', '2021-04-30', '13.00 WIB', 'mnbvcxz', 2, 1, 33, 1619419452);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `role_id` int(1) NOT NULL,
  `image` text NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `role_id`, `image`, `is_active`, `created_by`, `date_created`) VALUES
(1, 'superuser', '$2y$10$MPK.gnIeAm1Y3Jk4xygiEOmrOWTecGmV06CNnYfbUIt7XDb.S8Vsu', 'superuser@admin.com', 1, 'default.png', 1, NULL, 0),
(22, 'admin', '$2y$10$QdRIIUY6sepSGV.mGVs3s.4CvozY1rJWq53l3JjYGLyuiknVYsCBW', 'arearasyid@gmail.com', 2, 'default.png', 1, 1, 1618330778),
(33, 'klien', '$2y$10$YBKkg8balKh.zFfJtn.k2uzScAIZip5bIjpfgvO8NrdnaYzbBa1cK', 'razyid72@gmail.com', 4, 'default.png', 1, 1, 1618364545),
(34, 'dokter', '$2y$10$GKF3sf3XRXOyaow79WblXuPUpQO2rrfz2ulKKfUTfQZmOwddHngU2', 'arearasyid@gmail.com', 3, 'adbc1.png', 1, 1, 1618365055),
(36, 'asfsdfadsfd', '$2y$10$mBT4iC9DZQndR1yuMaWGk.To7OceP7Rx40SohniKSzoURPFseI.dK', 'areardasyid@gmail.com', 3, 'default.png', 1, 22, 1618365816);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `biling`
--
ALTER TABLE `biling`
  ADD PRIMARY KEY (`id_biling`);

--
-- Indexes for table `biling_detail`
--
ALTER TABLE `biling_detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indexes for table `hari_praktek`
--
ALTER TABLE `hari_praktek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id_history`);

--
-- Indexes for table `jam_reservasi`
--
ALTER TABLE `jam_reservasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `klien`
--
ALTER TABLE `klien`
  ADD PRIMARY KEY (`id_klien`);

--
-- Indexes for table `reservasi`
--
ALTER TABLE `reservasi`
  ADD PRIMARY KEY (`id_reservasi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `biling`
--
ALTER TABLE `biling`
  MODIFY `id_biling` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `biling_detail`
--
ALTER TABLE `biling_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hari_praktek`
--
ALTER TABLE `hari_praktek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=643;

--
-- AUTO_INCREMENT for table `jam_reservasi`
--
ALTER TABLE `jam_reservasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `klien`
--
ALTER TABLE `klien`
  MODIFY `id_klien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reservasi`
--
ALTER TABLE `reservasi`
  MODIFY `id_reservasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
