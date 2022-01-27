-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 09, 2021 at 05:25 AM
-- Server version: 5.7.24
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qurbanqu`
--

-- --------------------------------------------------------

--
-- Table structure for table `ap_admin`
--

CREATE TABLE `ap_admin` (
  `id` int(13) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ap_admin`
--

INSERT INTO `ap_admin` (`id`, `nama`, `email`, `username`, `password`, `level`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin', '$2y$10$s72hvDDbRk.b6J0pqp.O8uWeF3H2TLBaulnypOGhXqGAtZEh7U4Xu', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ap_funfact`
--

CREATE TABLE `ap_funfact` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `fotofunfact` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ap_funfact`
--

INSERT INTO `ap_funfact` (`id`, `judul`, `deskripsi`, `fotofunfact`) VALUES
(1, 'Sapi Simmental', 'Simmental atau Swiss Fleckvieh adalah salah satu ras sapi. Ras ini mengambil nama Simmental, nama sebuah lembah dari Sungai Simme di Bernese Oberland, Kanton Bern, Swiss. Simmental memiliki warna bulu kemerahan dengan corak warna putih, dan diternakkan untuk diambil susu dan dagingnya.', 'sapi-simmental.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ap_keranjang`
--

CREATE TABLE `ap_keranjang` (
  `id` int(13) NOT NULL,
  `id_pembeli` int(13) NOT NULL,
  `nama_pembeli` varchar(30) NOT NULL,
  `alamat_pembeli` text NOT NULL,
  `jumlah_beli` varchar(30) NOT NULL,
  `id_produk` int(13) NOT NULL,
  `nama_produk` varchar(30) NOT NULL,
  `jenis_produk` varchar(15) NOT NULL,
  `harga_produk` varchar(30) NOT NULL,
  `satuan_produk` varchar(10) NOT NULL,
  `foto_produk` varchar(30) NOT NULL,
  `status_pengiriman` enum('Belum Diproses','Sedang Diproses','Sudah Dikirim','Selesai') NOT NULL,
  `status_pembayaran` enum('Menunggu Pembayaran','Belum Diverifikasi','Lunas') NOT NULL,
  `tanggal_pembelian` varchar(30) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `potong` varchar(5) NOT NULL,
  `hargapotongkr` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ap_keranjang`
--

INSERT INTO `ap_keranjang` (`id`, `id_pembeli`, `nama_pembeli`, `alamat_pembeli`, `jumlah_beli`, `id_produk`, `nama_produk`, `jenis_produk`, `harga_produk`, `satuan_produk`, `foto_produk`, `status_pengiriman`, `status_pembayaran`, `tanggal_pembelian`, `tanggal`, `potong`, `hargapotongkr`) VALUES
(39, 14, 'rafli', 'tes', '1', 56, 'Sapi Presiden', 'Sapi', '10000000', '1004', '659741.jpg', 'Selesai', 'Lunas', 'Selasa, 02 Nopember 2021', '2021-11-03 04:01:58', 'Ya', 100000),
(40, 14, 'rafli', 'tes', '2', 57, 'Kambing Super', 'Kambing', '4500000', '25', '271933.png', 'Selesai', 'Lunas', 'Rabu, 03 Nopember 2021', '2021-11-03 02:08:00', 'Ya', 100000),
(41, 14, 'rafli', 'tes', '10', 57, 'Kambing Super', 'Kambing', '4500000', '25', '271933.png', 'Belum Diproses', 'Menunggu Pembayaran', 'Rabu, 03 Nopember 2021', '2021-11-03 02:44:30', 'Ya', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `ap_produk`
--

CREATE TABLE `ap_produk` (
  `id` int(13) NOT NULL,
  `nama_produk_pemilik` varchar(30) NOT NULL,
  `nama_produk` varchar(30) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `jenis_produk` varchar(30) NOT NULL,
  `harga_produk` varchar(10) NOT NULL,
  `satuan_produk` varchar(5) NOT NULL,
  `stok_produk` varchar(10) NOT NULL,
  `hargapotong` int(10) NOT NULL,
  `foto_produk` varchar(30) NOT NULL,
  `tanggal_buat` varchar(30) NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ap_produk`
--

INSERT INTO `ap_produk` (`id`, `nama_produk_pemilik`, `nama_produk`, `deskripsi_produk`, `jenis_produk`, `harga_produk`, `satuan_produk`, `stok_produk`, `hargapotong`, `foto_produk`, `tanggal_buat`, `tanggal_update`) VALUES
(56, 'Admin', 'Sapi Presiden', 'Presiden Joko Widodo (Jokowi) membeli sapi kurban di Rembang, Jawa Tengah seberat 1.004 kg. Sapi berjenis peranakan ongole ini dibeli dari Kepala Desa Sendangagung, Kecamatan Kaliori, Inayah. Inayah menuturkan sapi miliknya itu dibeli Jokowi melalui Dinas Peternakan seharga puluhan juta Rupiah.', 'Sapi', '10000000', '1004', '12', 100000, '659741.jpg', 'Selasa, 02 Nopember 2021', '2021-11-02 06:51:57'),
(57, 'Admin', 'Kambing Super', 'Kambing Etawa didatangkan ke Indonesia dari India.', 'Kambing', '4500000', '25', '10', 100000, '271933.png', 'Selasa, 02 Nopember 2021', '2021-11-02 06:51:36'),
(58, 'Admin', 'Sapi Presiden 2', 'Presiden Joko Widodo (Jokowi) membeli sapi kurban di Rembang, Jawa Tengah seberat 2500 kg. Sapi berjenis peranakan ongole ini dibeli dari Kepala Desa Sendangagung, Kecamatan Kaliori, Inayah. Inayah menuturkan sapi miliknya itu dibeli Jokowi melalui Dinas Peternakan seharga puluhan juta Rupiah.', 'Sapi', '50000000', '1500', '12', 600000, '532399.jpg', 'Selasa, 02 Nopember 2021', '2021-11-02 07:28:45');

-- --------------------------------------------------------

--
-- Table structure for table `ap_produk_jenis`
--

CREATE TABLE `ap_produk_jenis` (
  `id` int(13) NOT NULL,
  `jenis_produk` varchar(30) NOT NULL,
  `fotokategori_produk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ap_produk_jenis`
--

INSERT INTO `ap_produk_jenis` (`id`, `jenis_produk`, `fotokategori_produk`) VALUES
(56, 'Sapi', 'hewan_kurban.jpg'),
(57, 'Kambing', 'Domba-Qurban-atau-Kambing-Qurban-2480x1860.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ap_situs`
--

CREATE TABLE `ap_situs` (
  `id` int(1) NOT NULL,
  `nama_situs` varchar(20) NOT NULL,
  `alamat_situs` varchar(20) NOT NULL,
  `deskripsi_situs` text NOT NULL,
  `metatag_situs` text NOT NULL,
  `kontak_situs` varchar(13) NOT NULL,
  `author_situs` varchar(30) NOT NULL,
  `logo_situs` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ap_situs`
--

INSERT INTO `ap_situs` (`id`, `nama_situs`, `alamat_situs`, `deskripsi_situs`, `metatag_situs`, `kontak_situs`, `author_situs`, `logo_situs`) VALUES
(1, 'QurbanQu', 'http://qurbanqu.com', 'QurbanQu adalah Ecommerce qurban pertama di Indonesia yang ... (isi sendiri)', 'Jual beli ayam kampung pangandaran, telur ayam kampung pangandaran, jual ikan pangandaran, jual ayam hias, jual ikan, jual hasil pertanian', '123123', 'QurbanQu', 'logo_web.png');

-- --------------------------------------------------------

--
-- Table structure for table `ap_user`
--

CREATE TABLE `ap_user` (
  `id` int(13) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `alamat_lengkap` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ap_user`
--

INSERT INTO `ap_user` (`id`, `nama_lengkap`, `no_hp`, `alamat_lengkap`, `email`, `username`, `password`) VALUES
(14, 'rafli', '12312311211', 'tes', 'raflirr@student.com', 'raflyrdn', '$2y$10$7qGOL/AAy0KdsxLquGrV1upKC75uJVBUDGnB2k0LUR0BRow0oKjoq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ap_admin`
--
ALTER TABLE `ap_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `ap_funfact`
--
ALTER TABLE `ap_funfact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ap_keranjang`
--
ALTER TABLE `ap_keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ap_produk`
--
ALTER TABLE `ap_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ap_produk_jenis`
--
ALTER TABLE `ap_produk_jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ap_situs`
--
ALTER TABLE `ap_situs`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `ap_user`
--
ALTER TABLE `ap_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ap_admin`
--
ALTER TABLE `ap_admin`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ap_funfact`
--
ALTER TABLE `ap_funfact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ap_keranjang`
--
ALTER TABLE `ap_keranjang`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `ap_produk`
--
ALTER TABLE `ap_produk`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `ap_produk_jenis`
--
ALTER TABLE `ap_produk_jenis`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `ap_user`
--
ALTER TABLE `ap_user`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
