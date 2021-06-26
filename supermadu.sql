-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2021 at 08:05 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `supermadu`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `id` int(11) NOT NULL,
  `nama_bahan_baku` varchar(255) NOT NULL,
  `stok` decimal(65,0) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bahan_baku`
--

INSERT INTO `bahan_baku` (`id`, `nama_bahan_baku`, `stok`) VALUES
(1, 'Singkong', '1000'),
(2, 'Ketan', '3000');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `nomor_pesanan` varchar(255) NOT NULL,
  `total` decimal(65,0) NOT NULL,
  `bayar` decimal(65,0) NOT NULL,
  `kembali` decimal(65,0) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `nomor_pesanan`, `total`, `bayar`, `kembali`, `user_id`, `tanggal`) VALUES
(5, '0000000001', '100000', '100000', '0', 1, '2018-12-31 17:00:00'),
(6, '0000000002', '100000', '100000', '0', 1, '2019-01-31 17:00:00'),
(7, '0000000003', '100000', '100000', '0', 1, '2019-02-28 17:00:00'),
(8, '0000000004', '100000', '100000', '0', 1, '2019-03-31 17:00:00'),
(9, '0000000005', '100000', '100000', '0', 1, '2019-04-30 17:00:00'),
(10, '0000000006', '100000', '100000', '0', 1, '2019-05-31 17:00:00'),
(11, '0000000007', '100000', '100000', '0', 1, '2019-06-30 17:00:00'),
(12, '0000000008', '100000', '100000', '0', 1, '2019-07-31 17:00:00'),
(13, '0000000009', '100000', '100000', '0', 1, '2019-08-31 17:00:00'),
(14, '0000000010', '100000', '100000', '0', 1, '2019-09-30 17:00:00'),
(15, '0000000011', '100000', '100000', '0', 1, '2019-10-31 17:00:00'),
(16, '0000000012', '100000', '100000', '0', 1, '2019-11-30 17:00:00'),
(17, '0000000013', '100000', '100000', '0', 1, '2019-12-31 17:00:00'),
(18, '0000000014', '100000', '100000', '0', 1, '2020-01-31 17:00:00'),
(19, '0000000015', '100000', '100000', '0', 1, '2020-02-29 17:00:00'),
(20, '0000000016', '100000', '100000', '0', 1, '2020-03-31 17:00:00'),
(21, '0000000017', '100000', '100000', '0', 1, '2020-04-30 17:00:00'),
(22, '0000000018', '100000', '100000', '0', 1, '2020-05-31 17:00:00'),
(23, '0000000019', '100000', '100000', '0', 1, '2020-06-30 17:00:00'),
(24, '0000000020', '100000', '100000', '0', 1, '2020-07-31 17:00:00'),
(25, '0000000021', '100000', '100000', '0', 1, '2020-08-31 17:00:00'),
(26, '0000000022', '100000', '100000', '0', 1, '2020-09-30 17:00:00'),
(27, '0000000023', '100000', '100000', '0', 1, '2020-10-31 17:00:00'),
(28, '0000000024', '100000', '100000', '0', 1, '2020-11-30 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `id` int(11) NOT NULL,
  `penjualan_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `jumlah` decimal(65,2) NOT NULL,
  `harga` decimal(65,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan_detail`
--

INSERT INTO `penjualan_detail` (`id`, `penjualan_id`, `produk_id`, `jumlah`, `harga`) VALUES
(5, 5, 1, '6700.00', '18000.00'),
(6, 6, 1, '6750.00', '18000.00'),
(7, 7, 1, '6700.00', '18000.00'),
(8, 8, 1, '6900.00', '18000.00'),
(9, 9, 1, '6950.00', '18000.00'),
(10, 10, 1, '7050.00', '18000.00'),
(11, 11, 1, '7150.00', '18000.00'),
(12, 12, 1, '7100.00', '18000.00'),
(13, 13, 1, '7230.00', '18000.00'),
(14, 14, 1, '7250.00', '18000.00'),
(15, 15, 1, '7350.00', '18000.00'),
(16, 16, 1, '7500.00', '18000.00'),
(17, 17, 1, '7250.00', '18000.00'),
(18, 18, 1, '6925.00', '18000.00'),
(19, 19, 1, '7168.00', '18000.00'),
(20, 20, 1, '6000.00', '18000.00'),
(21, 21, 1, '4650.00', '18000.00'),
(22, 22, 1, '4850.00', '18000.00'),
(23, 23, 1, '6371.00', '18000.00'),
(24, 24, 1, '7034.00', '18000.00'),
(25, 25, 1, '7250.00', '18000.00'),
(26, 26, 1, '7200.00', '18000.00'),
(27, 27, 1, '7350.00', '18000.00'),
(28, 28, 1, '7550.00', '18000.00'),
(32, 5, 2, '4000.00', '18000.00'),
(33, 6, 2, '4100.00', '18000.00'),
(34, 7, 2, '4200.00', '18000.00'),
(35, 8, 2, '4150.00', '18000.00'),
(36, 9, 2, '4300.00', '18000.00'),
(37, 10, 2, '4375.00', '18000.00'),
(38, 11, 2, '4360.00', '18000.00'),
(39, 12, 2, '4390.00', '18000.00'),
(40, 13, 2, '4385.00', '18000.00'),
(41, 14, 2, '4400.00', '18000.00'),
(42, 15, 2, '4450.00', '18000.00'),
(43, 16, 2, '4500.00', '18000.00'),
(44, 17, 2, '4460.00', '18000.00'),
(45, 18, 2, '4277.00', '18000.00'),
(46, 19, 2, '4360.00', '18000.00'),
(47, 20, 2, '3340.00', '18000.00'),
(48, 21, 2, '3300.00', '18000.00'),
(49, 22, 2, '3100.00', '18000.00'),
(50, 23, 2, '3000.00', '18000.00'),
(51, 24, 2, '4170.00', '18000.00'),
(52, 25, 2, '4250.00', '18000.00'),
(53, 26, 2, '4225.00', '18000.00'),
(54, 27, 2, '4350.00', '18000.00'),
(55, 28, 2, '4500.00', '18000.00');

-- --------------------------------------------------------

--
-- Table structure for table `peramalan`
--

CREATE TABLE `peramalan` (
  `id` int(11) NOT NULL,
  `produk_id` int(11) DEFAULT NULL,
  `periode` varchar(255) DEFAULT NULL,
  `alpha` varchar(255) DEFAULT NULL,
  `hasil` decimal(65,6) DEFAULT NULL,
  `hasil_manual` decimal(65,6) DEFAULT NULL,
  `mape` decimal(65,6) DEFAULT NULL,
  `tanggal` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peramalan`
--

INSERT INTO `peramalan` (`id`, `produk_id`, `periode`, `alpha`, `hasil`, `hasil_manual`, `mape`, `tanggal`) VALUES
(3, 1, '2021-03', '0.4', '7941.524586', '7941.524586', '5.784728', '2021-05-09 12:32:52'),
(5, 2, '2021-03', '0.5', '4765.800873', '4765.800873', '4.474960', '2021-05-10 02:25:13');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `harga` decimal(65,0) DEFAULT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `bahan_baku_id` int(11) DEFAULT NULL,
  `takaran_resep` decimal(65,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `deskripsi`, `foto`, `harga`, `stok`, `bahan_baku_id`, `takaran_resep`) VALUES
(1, 'Tape Singkong', 'Ini tapi dari singkong', 'tape_singkong.jpg', '18000', 11, 1, '1000'),
(2, 'Tape Ketan', 'ini tape ketan', 'tape-ketan-putih-2_43.jpeg', '17000', 10, 2, '992');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `foto`, `role`) VALUES
(1, 'admin', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', 'Super Admin', 'avatar4.png', 'admin'),
(2, 'pemilik', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', 'Pemilik', 'avatar5.png', 'pemilik'),
(3, 'penjualan', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', 'Admin Penjualan', 'avatar2.png', 'penjualan'),
(4, 'produksi', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', 'Admin Produksi', 'avatar.png', 'produksi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`,`nomor_pesanan`) USING BTREE,
  ADD KEY `id` (`id`);

--
-- Indexes for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produk_id` (`produk_id`),
  ADD KEY `penjualan_id` (`penjualan_id`);

--
-- Indexes for table `peramalan`
--
ALTER TABLE `peramalan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `peramalan`
--
ALTER TABLE `peramalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD CONSTRAINT `penjualan_id` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produk_id` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
