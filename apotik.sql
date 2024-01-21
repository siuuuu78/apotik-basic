-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2023 at 05:04 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apotik`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'daus', 'daus123');

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `id_transaksi` int(100) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `nohp` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `provinsi` varchar(100) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `kode_pos` varchar(10) NOT NULL,
  `pembayaran` varchar(40) NOT NULL,
  `harga` varchar(40) NOT NULL,
  `jumlah_produk` varchar(100) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `bukti_pembayaran` varchar(40) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`id_transaksi`, `nama`, `nohp`, `email`, `alamat`, `provinsi`, `kota`, `kode_pos`, `pembayaran`, `harga`, `jumlah_produk`, `tanggal`, `bukti_pembayaran`, `payment_status`) VALUES
(45, 'Agil Thunder', '2147483647', 'agil@gmail.com', 'Jl. Binje Utara', 'Jawa Utara', 'Medan', '20157', 'dana', '258000', 'Mylanta (1) , Stepsils (1) ', '2023-11-25', '863-contoh.jpg', 'completed'),
(52, 'Agil Thunder', '081234567890', 'agil@gmail.com', 'Jl. Binje Utara Barat', 'Jawa Utara', 'Medan', '20157', 'dana', '380000', 'Paracetamol (1) , Tolak Angin (1) ', '2023-11-26', '162-panadol.jpg', 'Completed'),
(55, 'RAYHAN ATRICHA RAMBE', '081234567890', 'riyanharun4@gmail.com', 'Jl. Binje Utara Barat', 'Jawa Utara', 'Medan', '20157', 'dana', '12500', 'Kalpanax Salep (1) ', '2023-11-26', '214-apotik1.jpg', 'verifikasi'),
(56, 'RAYHAN ATRICHA RAMBE', '081234567890', 'riyanharun4@gmail.com', 'Jl. Binje Utara Barat', 'Jawa Utara', 'Medan', '20157', 'dana', '20000', 'Stepsils (1) ', '2023-12-08', '180-214-apotik1.jpg', 'verifikasi'),
(57, 'RAYHAN ATRICHA RAMBE', '081234567890', 'riyanharun4@gmail.com', 'Jl. Binje Utara Barat', 'Jawa Utara', 'Medan', '20157', 'dana', '20000', 'Stepsils (1) ', '2023-12-08', '953-863-contoh.jpg', 'completed'),
(59, 'Agil Thunder', '08881231423413', 'asep@gmail.com', 'Jl. Binje', 'Jawa Utara', 'Medan', '20157', 'dana', '60000', 'Stepsils (3) ', '2023-12-09', '308-863-contoh.jpg', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(100) NOT NULL,
  `id_produk` int(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` varchar(100) NOT NULL,
  `gambar_produk` varchar(100) NOT NULL,
  `jumlah_produk` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id_kontak` int(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(40) NOT NULL,
  `pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kontak`
--

INSERT INTO `kontak` (`id_kontak`, `nama`, `email`, `pesan`) VALUES
(5, 'Daus ', 'dsgdsgfd@gnasg', 'Obat');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(100) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga` varchar(100) NOT NULL,
  `stok_produk` varchar(100) NOT NULL,
  `gambar_produk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga`, `stok_produk`, `gambar_produk`) VALUES
(1, 'Mylanta', '13000', '124', '674-mylanta.jpg'),
(3, 'Stepsils', '20000', '102', '998-strepsil.jpg'),
(6, 'Tolak Angin', '3500', '212', '311-tolak.jpg'),
(8, 'Kalpanax Salep', '12500', '100', '549-kalpanax.jpg'),
(9, 'Promag', '8000', '102', '685-promag.jpg'),
(10, 'Entrostop', '9600', '100', '746-entrostop.jpg'),
(11, 'Paramex', '3000', '100', '274-paramex.jpg'),
(12, 'Sanmol', '2200', '102', '357-sanmol.jpg'),
(14, 'Sanmol', '22000', '102', '301-sanmol.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(10) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `notelp` int(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `notelp`, `alamat`, `password`) VALUES
(1, 'Ucup darmawangsa', 'riyanharun4@gmail.com', 81321543, 'Jl. Karya ', '1234'),
(8, 'agil', 'agil@gmail.com', 2147483647, 'Jl. Binje Utara', '1234'),
(9, 'Asep Widodo Sugiono', 'asep@gmail.com', 2147483647, 'Jl. Binje Utara Barat', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id_kontak`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id_transaksi` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id_kontak` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
