-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2016 at 11:43 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 7.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gsm`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `title` varchar(254) NOT NULL,
  `jenis_barang_id` int(11) NOT NULL,
  `satuan_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode`, `title`, `jenis_barang_id`, `satuan_id`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 'B01', 'Konektor', 2, 3, 1, '2015-11-20', 0, '0000-00-00', 0, 0, '0000-00-00'),
(2, 'B03', 'Kabel UTP', 2, 0, 1, '2015-11-21', 0, '0000-00-00', 0, 0, '0000-00-00'),
(3, 'B05', 'Kabel LAN', 1, 0, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(4, 'A01', 'Kayu', 2, 0, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(5, 'A04', 'Besi', 2, 0, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(6, 'A05', 'Palu', 1, 0, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(7, 'C01', 'SC Fiber Optic Patchcord', 1, 0, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(8, 'C02', 'LC Fiber Optic Patchcord', 1, 0, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(9, 'C03', 'FC Fiber Optic Patchcord', 1, 0, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(10, 'I01', 'PC Desktop', 3, 0, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(12, 'D01', 'Antenna', 1, 1, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(13, 'F01', 'Rak Server', 1, 0, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(14, '001', 'Rak', 2, 2, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `title` varchar(254) NOT NULL,
  `tipe` varchar(15) NOT NULL,
  `up` varchar(25) NOT NULL,
  `jabatan` varchar(25) NOT NULL,
  `telp_1` varchar(15) NOT NULL,
  `telp_2` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `kode`, `title`, `tipe`, `up`, `jabatan`, `telp_1`, `telp_2`, `email`, `alamat`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(2, 'S02', 'Tridaya', '', '', '', '', '', '', '', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(3, 'S01', 'Kabel Supreme', 'Perusahaan', '', '', '', '', '', '', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(4, 'S03', 'Antop', 'Perusahaan', 'aer', 'rae', 'rea', 'ra', 'rea', 'raer', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(5, 'S03', 'Broadlink', 'Personal', 'Ari', 'Sales', '0909', '0808', 'aa@a.dl', 'rerer', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'user', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE `gudang` (
  `id` int(11) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `title` varchar(254) NOT NULL,
  `lokasi_gudang_id` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_on` date NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`id`, `kode`, `title`, `lokasi_gudang_id`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(5, 'G03', 'Gudang Kenari Lt.3', 1, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00', 0),
(7, 'G02', 'Gudang Kenari Lt.2', 1, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00', 0),
(8, 'G01', 'Gudang Utan Kayu', 1, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00', 0),
(9, 'G04', 'Gudang IIBC', 1, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00', 0),
(10, 'G05', 'Gudang Sentul', 3, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`id`, `title`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 'Barang Jadi', 1, '2015-12-12', 0, '0000-00-00', 0, 0, '0000-00-00'),
(2, 'Barang Mentah', 1, '2015-12-12', 0, '0000-00-00', 0, 0, '0000-00-00'),
(3, 'Barang Inventaris', 1, '2015-12-12', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `kurensi`
--

CREATE TABLE `kurensi` (
  `id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `simbol` varchar(5) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kurensi`
--

INSERT INTO `kurensi` (`id`, `title`, `simbol`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 'IDR', 'Rp', 1, '2015-12-13', 0, '0000-00-00', 0, 0, '0000-00-00'),
(2, 'USD', '$', 1, '2015-12-13', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lokasi_gudang`
--

CREATE TABLE `lokasi_gudang` (
  `id` int(11) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `title` varchar(254) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lokasi_gudang`
--

INSERT INTO `lokasi_gudang` (`id`, `kode`, `title`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 'L01', 'Jakarta', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(2, 'L02', 'Bandung', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi_toko`
--

CREATE TABLE `lokasi_toko` (
  `id` int(11) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `title` varchar(254) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lokasi_toko`
--

INSERT INTO `lokasi_toko` (`id`, `kode`, `title`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 'L01', 'Jakarta', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(2, 'L02', 'Bandung', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `metode_pembayaran`
--

CREATE TABLE `metode_pembayaran` (
  `id` int(11) NOT NULL,
  `title` varchar(254) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `metode_pembayaran`
--

INSERT INTO `metode_pembayaran` (`id`, `title`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 'Cash', 1, '2015-12-16', 0, '0000-00-00', 0, 0, '0000-00-00'),
(2, 'Kredit', 1, '2015-12-16', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `id` int(11) NOT NULL,
  `no` varchar(25) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `up` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `metode_pembayaran_id` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `po` varchar(10) NOT NULL,
  `gudang_id` int(11) NOT NULL,
  `jatuh_tempo_pembayaran` date NOT NULL,
  `kurensi_id` varchar(254) NOT NULL,
  `biaya_pengiriman` int(11) NOT NULL,
  `dibayar` int(11) NOT NULL,
  `lama_angsuran_1` int(11) NOT NULL,
  `lama_angsuran_2` varchar(10) NOT NULL,
  `bunga` int(11) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`id`, `no`, `supplier_id`, `up`, `alamat`, `metode_pembayaran_id`, `tanggal_transaksi`, `po`, `gudang_id`, `jatuh_tempo_pembayaran`, `kurensi_id`, `biaya_pengiriman`, `dibayar`, `lama_angsuran_1`, `lama_angsuran_2`, `bunga`, `keterangan`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, '201512171', 3, '', '', 1, '2016-01-01', '123', 7, '2016-01-01', '1', 0, 0, 0, '', 0, '', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(2, '201512172', 3, 'Mr.A', 'jl.abcd', 1, '2015-12-24', '1223', 7, '2015-12-24', '1', 0, 0, 0, '', 0, '', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(3, '201512183', 3, 'sad', 'dsa', 1, '2016-01-01', 'sdsa', 7, '2016-01-01', '1', 0, 0, 0, '', 0, '', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(4, '201512194', 3, 'qw', 'wq', 1, '2015-12-19', 'wq', 5, '2015-12-19', '2', 2, 10, 0, '', 0, '', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(5, '201512195', 3, 'ad', 'loo', 2, '2015-12-09', 'o', 5, '2015-12-09', '2', 0, 0, 0, '', 0, '', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(6, '201512206', 2, 'mr.x', 'jl. xxx', 2, '2015-12-28', '12345', 5, '2015-12-28', '1', 10000, 1111000, 12, 'bulan', 10, '', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(7, '201512207', 2, 'Tn. xxx', 'jl. xxx', 2, '2016-01-01', '12345', 5, '2016-01-01', '1', 250000, 550000, 10, 'bulan', 10, '', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(8, '201512208', 2, 'Tn. xxx', 'jl. xxx', 2, '2016-01-01', '54321', 7, '2016-01-01', '1', 5000, 10000, 10, 'bulan', 5, '', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(9, '201512219', 2, 'Mr.x ', 'jl. xxx', 2, '2016-01-01', '12345', 5, '2016-01-01', '1', 10000, 90000, 10, 'bulan', 10, '', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(10, '2015122110', 2, 'ferdi', 'bekasi', 1, '2015-12-24', '55566644', 8, '2015-12-24', '1', 0, 5000000, 0, '0', 0, '', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(11, '2015122111', 4, 'bernard', 'kupang', 1, '2015-12-18', '0101032', 10, '2015-12-18', '2', 0, 2000000, 0, '0', 0, '', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(12, '2015122212', 5, 'Tn. Abdul', 'Jakarta', 1, '2016-01-01', '1234', 8, '2016-01-01', '1', 100000, 2929000, 12, 'bulan', 10, '', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(13, '2016011713', 4, 'aer', 'raer', 1, '2016-02-01', '23232', 5, '2016-02-01', '1', 0, 11500, 0, '0', 0, 'tes', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(14, '2016011714', 5, 'Ari', 'rerer', 2, '2016-03-03', '34324', 5, '2016-03-03', '1', 0, 10000, 12, 'bulan', 10, '', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_list`
--

CREATE TABLE `purchase_order_list` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `kode_barang` int(11) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `disc` int(11) NOT NULL,
  `pajak` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_order_list`
--

INSERT INTO `purchase_order_list` (`id`, `order_id`, `kode_barang`, `deskripsi`, `jumlah`, `satuan_id`, `harga`, `disc`, `pajak`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 1, 0, '', 1, 1, 3, 5, 9, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(2, 1, 0, '', 2, 1, 4, 6, 10, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(3, 2, 1, '', 1, 1, 3, 5, 9, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(4, 2, 2, '', 2, 1, 4, 6, 0, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(5, 3, 1, '', 10, 1, 1, 10, 10, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(6, 4, 1, '', 10, 1, 1, 0, 10, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(7, 4, 2, '', 10, 1, 2, 0, 10, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(8, 5, 1, '', 1000, 2, 1, 10, 10, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(9, 5, 1, '', 0, 1, 0, 0, 0, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(10, 6, 1, '', 10, 1, 100000, 0, 10, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(11, 6, 2, '', 10, 1, 50000, 0, 10, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(12, 7, 2, '', 10, 1, 100000, 0, 10, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(13, 7, 3, '', 5, 1, 50000, 0, 10, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(14, 8, 1, '', 5, 1, 1000, 0, 10, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(15, 8, 1, '', 5, 1, 10000, 0, 10, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(16, 9, 2, '', 10, 1, 100000, 0, 10, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(17, 10, 1, '', 5000, 1, 1000, 0, 10, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(18, 11, 3, '', 10, 3, 200000, 0, 10, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(19, 11, 4, '', 10, 1, 1000, 0, 10, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(20, 12, 4, '', 10, 1, 1000000, 10, 10, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(21, 12, 2, '', 10, 1, 2000000, 0, 10, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(22, 12, 1, '', 10, 1, 0, 0, 10, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(23, 13, 2, '', 10, 4, 1000, 0, 10, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(24, 13, 4, '', 10, 3, 100, 0, 10, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(25, 13, 5, '', 10, 1, 50, 0, 10, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(26, 14, 2, 'Kabel tt', 10, 1, 100, 0, 10, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(27, 14, 6, 'Palu', 10, 1, 1000, 0, 10, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(254) NOT NULL,
  `telp_1` varchar(15) NOT NULL,
  `telp_2` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `komisi` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `kode`, `nama`, `telp_1`, `telp_2`, `email`, `alamat`, `komisi`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(2, 's34', 'df', '3443423423', '4234234234', '4423b423432', '4rsfsd fsdfe fsefe', 3, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `sales_order`
--

CREATE TABLE `sales_order` (
  `id` int(11) NOT NULL,
  `no` varchar(25) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `up` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `metode_pembayaran_id` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `so` varchar(10) NOT NULL,
  `gudang_id` int(11) NOT NULL,
  `jatuh_tempo_pembayaran` date NOT NULL,
  `kurensi_id` varchar(254) NOT NULL,
  `biaya_pengiriman` int(11) NOT NULL,
  `dibayar` int(11) NOT NULL,
  `lama_angsuran_1` int(11) NOT NULL,
  `lama_angsuran_2` varchar(10) NOT NULL,
  `bunga` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_order`
--

INSERT INTO `sales_order` (`id`, `no`, `customer_id`, `up`, `alamat`, `metode_pembayaran_id`, `tanggal_transaksi`, `so`, `gudang_id`, `jatuh_tempo_pembayaran`, `kurensi_id`, `biaya_pengiriman`, `dibayar`, `lama_angsuran_1`, `lama_angsuran_2`, `bunga`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, '201512171', 3, '', '', 1, '2016-01-01', '123', 7, '2016-01-01', '1', 0, 0, 0, '', 0, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(2, '201512172', 3, 'Mr.A', 'jl.abcd', 1, '2015-12-24', '1223', 7, '2015-12-24', '1', 0, 0, 0, '', 0, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(3, '201512183', 3, 'sad', 'dsa', 1, '2016-01-01', 'sdsa', 7, '2016-01-01', '1', 0, 0, 0, '', 0, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(4, '201512194', 3, 'qw', 'wq', 1, '2015-12-19', 'wq', 5, '2015-12-19', '2', 2, 10, 0, '', 0, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(5, '201512195', 3, 'ad', 'loo', 2, '2015-12-09', 'o', 5, '2015-12-09', '2', 0, 0, 0, '', 0, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(6, '201512206', 2, 'mr.x', 'jl. xxx', 2, '2015-12-28', '12345', 5, '2015-12-28', '1', 10000, 1111000, 12, 'bulan', 10, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(7, '201512207', 2, 'Tn. xxx', 'jl. xxx', 2, '2016-01-01', '12345', 5, '2016-01-01', '1', 250000, 550000, 10, 'bulan', 10, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(8, '201512208', 2, 'Tn. xxx', 'jl. xxx', 2, '2016-01-01', '54321', 7, '2016-01-01', '1', 5000, 10000, 10, 'bulan', 5, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(9, '201512219', 2, 'Mr.x ', 'jl. xxx', 2, '2016-01-01', '12345', 5, '2016-01-01', '1', 10000, 90000, 10, 'bulan', 10, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(10, '2015122110', 2, 'ferdi', 'bekasi', 1, '2015-12-24', '55566644', 8, '2015-12-24', '1', 0, 5000000, 0, '0', 0, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(11, '2015122111', 4, 'bernard', 'kupang', 1, '2015-12-18', '0101032', 10, '2015-12-18', '2', 0, 2000000, 0, '0', 0, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(12, '2015122212', 5, 'Tn. Abdul', 'Jakarta', 1, '2016-01-01', '1234', 8, '2016-01-01', '1', 100000, 2929000, 12, 'bulan', 10, 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id`, `title`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(1, 'Pcs', 1, '2015-11-20', 0, '0000-00-00', 0, 0, '0000-00-00'),
(2, 'Kg', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(3, 'Meter', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(4, 'Roll', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `gudang_id` int(11) NOT NULL,
  `dalam_stok` int(11) NOT NULL,
  `minimum_stok` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_on` date NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`id`, `barang_id`, `supplier_id`, `gudang_id`, `dalam_stok`, `minimum_stok`, `harga_beli`, `harga_jual`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES
(1, 12, 3, 8, 20, 30, 40, 50, 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0),
(2, 5, 3, 10, 23, 14, 2323232, 34343434, 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `title` varchar(254) NOT NULL,
  `tipe` varchar(15) NOT NULL,
  `up` varchar(25) NOT NULL,
  `jabatan` varchar(25) NOT NULL,
  `telp_1` varchar(15) NOT NULL,
  `telp_2` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_on` date NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `kode`, `title`, `tipe`, `up`, `jabatan`, `telp_1`, `telp_2`, `email`, `alamat`, `created_by`, `created_on`, `edited_by`, `edited_on`, `is_deleted`, `deleted_by`, `deleted_on`) VALUES
(2, 'S02', 'Tridaya', '', '', '', '', '', '', '', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(3, 'S01', 'Kabel Supreme', 'Perusahaan', '', '', '', '', '', '', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(4, 'S03', 'Antop', 'Perusahaan', 'aer', 'rae', 'rea', 'ra', 'rea', 'raer', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00'),
(5, 'S03', 'Broadlink', 'Personal', 'Ari', 'Sales', '0909', '0808', 'aa@a.dl', 'rerer', 0, '0000-00-00', 0, '0000-00-00', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `full_name`, `photo`, `phone`) VALUES
(1, '127.0.0.1', 'admin', '$2y$08$Dd7klvgEdT2kgdpOAQ5STOgz2XxJxdXdw1w38A7pbujoMoxQD1odG', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1453026380, 1, 'Administrator', 'sanpakugan-girls-cute-07-600x600.jpg', '085779458787'),
(7, '::1', 'user', '$2y$08$eIubMQdkSV8L6tHkxjEtiuiAGMO/V7LPQbw7FcEiH4ZvhglekP5Ua', NULL, 'user@user.com', NULL, NULL, NULL, NULL, 1447601978, 1450502325, 1, 'User', 'IMG_20151210_074329.jpg', '0819999999');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(74, 1, 1),
(72, 7, 1),
(73, 7, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode` (`kode`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode` (`kode`);

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kurensi`
--
ALTER TABLE `kurensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lokasi_gudang`
--
ALTER TABLE `lokasi_gudang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lokasi_toko`
--
ALTER TABLE `lokasi_toko`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order_list`
--
ALTER TABLE `purchase_order_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_order`
--
ALTER TABLE `sales_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kurensi`
--
ALTER TABLE `kurensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lokasi_gudang`
--
ALTER TABLE `lokasi_gudang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `lokasi_toko`
--
ALTER TABLE `lokasi_toko`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `purchase_order_list`
--
ALTER TABLE `purchase_order_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sales_order`
--
ALTER TABLE `sales_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
