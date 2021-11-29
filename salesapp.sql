-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2021 at 01:32 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salesapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktivitas_sales`
--

CREATE TABLE `aktivitas_sales` (
  `id_aktivitas` int(255) NOT NULL,
  `id_sales` int(255) NOT NULL,
  `id_manager` int(255) NOT NULL,
  `id_customer` int(255) NOT NULL,
  `status_persetujuan` tinyint(1) NOT NULL,
  `jadwal_kunjungan` datetime NOT NULL,
  `status_kunjungan` tinyint(1) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `foto_kunjungan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aktivitas_sales`
--

INSERT INTO `aktivitas_sales` (`id_aktivitas`, `id_sales`, `id_manager`, `id_customer`, `status_persetujuan`, `jadwal_kunjungan`, `status_kunjungan`, `lokasi`, `foto_kunjungan`) VALUES
(7, 2, 1, 1, 2, '2021-11-25 20:12:28', 1, 'Jl.K.S.Tubun no 7, Makassar', 'uploads/Logo NutriYummy Putih.png'),
(8, 2, 1, 2, 2, '2021-10-31 20:41:08', 0, '', ''),
(9, 1, 4, 5, 2, '2021-10-31 20:41:54', 0, '', ''),
(10, 2, 1, 3, 2, '2021-11-25 20:14:00', 0, '', ''),
(11, 2, 1, 5, 2, '2021-11-25 20:16:00', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(100) NOT NULL,
  `id_sales` int(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `terakhir_dikunjungi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `id_sales`, `nama`, `alamat`, `no_telp`, `terakhir_dikunjungi`) VALUES
(1, 1, 'Reinhart', 'Jl gunung agung no 68', '081355473527', '2021-11-25'),
(2, 1, 'Jeremy', 'Jl. Andi Makassau no 16d', '647267326732', '0000-00-00'),
(3, 2, 'Reynaldo pd', 'Jl. Serigala no 53', '085242774632', '0000-00-00'),
(4, 2, 'Kevin', 'Jl.Tupai no 78', '081326364637', '0000-00-00'),
(5, 3, 'Mario', 'Jl. Veteran Selatan no 90', '0214578965', '0000-00-00'),
(6, 5, 'Luigi', 'Jl. Veteran Utara', '0231456982', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `detail_order`
--

CREATE TABLE `detail_order` (
  `id_detail_order` int(10) NOT NULL,
  `id_order` int(10) NOT NULL,
  `id_produk` int(10) NOT NULL,
  `kuantitas` int(255) NOT NULL,
  `mata_uang` varchar(100) NOT NULL,
  `diskon` int(100) NOT NULL,
  `pajak` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detail_order`
--

INSERT INTO `detail_order` (`id_detail_order`, `id_order`, `id_produk`, `kuantitas`, `mata_uang`, `diskon`, `pajak`) VALUES
(7, 1, 2, 5, 'Rupiah', 0, 10),
(8, 1, 7, 5, 'Rupiah', 0, 10),
(9, 1, 4, 3, 'Rupiah', 0, 10),
(10, 2, 9, 5, 'Rupiah', 0, 10),
(11, 2, 5, 10, 'Rupiah', 5, 10),
(12, 3, 6, 10, 'Rupiah', 10, 10),
(13, 3, 1, 10, 'Rupiah', 0, 10),
(14, 3, 8, 50, 'Rupiah', 5, 10),
(15, 4, 7, 3, 'Rupiah', 0, 10),
(16, 4, 2, 10, 'Rupiah', 10, 10),
(17, 5, 4, 50, 'Rupiah', 15, 10),
(18, 5, 6, 50, 'Rupiah', 15, 10),
(19, 5, 3, 10, 'Rupiah', 0, 10),
(20, 6, 9, 50, 'Rupiah', 0, 10),
(21, 6, 7, 10, 'Rupiah', 0, 10),
(22, 6, 3, 3, 'Rupiah', 0, 10),
(23, 6, 5, 10, 'Rupiah', 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `id_manager` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tanggal_mulai_kerja` date NOT NULL,
  `tanggal_berhenti_kerja` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`id_manager`, `nama`, `alamat`, `no_telp`, `username`, `email`, `password`, `tanggal_mulai_kerja`, `tanggal_berhenti_kerja`) VALUES
(1, 'Alvaro Tanujaya', 'Rappocini Raya no 115', '08213819381', 'roro', 'c14190181@john.petra.ac.id', 'mantabjiwa', '2021-09-30', '0000-00-00'),
(2, 'Catherine', 'Jl. Tupai no 78', '08321545487', '', 'catherine@gmail.com', '12345', '2021-02-01', '0000-00-00'),
(3, 'Claudia', 'Jl.Tanjung Bunga Kompleks rose', '0857474693', '', 'Claudia@gmail.com', '12345', '2021-02-01', '0000-00-00'),
(4, 'Revina', 'Jl. Rappocini Raya no 113', '85242665475', '', 'revina@gmail.com', '12345', '2021-02-01', '0000-00-00'),
(5, 'RICHARDO', 'aa', 'aa', 'kardoj', 'richardo.jason2001@gmail.com', '12345', '2021-11-26', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id_order` int(255) NOT NULL,
  `id_sales` int(255) NOT NULL,
  `id_customer` int(255) NOT NULL,
  `tanggal_order` date NOT NULL,
  `tanggal_jatuh_tempo` date NOT NULL,
  `total_harga` int(255) NOT NULL,
  `status_order` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id_order`, `id_sales`, `id_customer`, `tanggal_order`, `tanggal_jatuh_tempo`, `total_harga`, `status_order`) VALUES
(1, 1, 1, '2021-10-21', '2021-10-28', 600000, 1),
(2, 1, 2, '2021-10-20', '2021-10-31', 109250, 1),
(3, 2, 3, '2021-10-21', '2021-10-28', 1045000, 0),
(4, 2, 1, '2021-10-22', '2021-10-29', 913500, 1),
(5, 2, 4, '2021-10-21', '2021-10-29', 4550000, 1),
(6, 1, 2, '2021-10-30', '2021-11-06', 390000, 1),
(7, 1, 2, '2021-11-18', '2021-11-26', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(10) NOT NULL,
  `id_manager` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_manager`, `nama_produk`, `harga_produk`) VALUES
(1, 1, 'Gula', 45000),
(2, 1, 'Beras', 100000),
(3, 1, 'Garam', 30000),
(4, 1, 'Teh', 25000),
(5, 1, 'Merica Bubuk', 10000),
(6, 1, 'Kayu Manis', 60000),
(7, 1, 'Balon', 5000),
(8, 1, 'Permen', 1000),
(9, 1, 'Pensil', 3000),
(10, 1, 'Kentang', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id_sales` int(10) NOT NULL,
  `id_manager` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL DEFAULT 'sales',
  `tanggal_mulai_kerja` date NOT NULL,
  `tanggal_berhenti_kerja` date NOT NULL,
  `track_lng` decimal(11,7) NOT NULL,
  `track_lat` decimal(11,7) NOT NULL,
  `track_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id_sales`, `id_manager`, `nama`, `alamat`, `no_telp`, `username`, `email`, `password`, `tanggal_mulai_kerja`, `tanggal_berhenti_kerja`, `track_lng`, `track_lat`, `track_time`) VALUES
(1, 1, 'Michael Pinarto', 'Cendrawasih no 78', '081355472863', 'denilsenaxel1', 'blibli@gmail.com', 'mantabjiwa', '2021-10-01', '0000-00-00', '119.4524672', '-5.1511296', '2021-11-16 22:21:26'),
(2, 1, 'Denilsen Axel', 'Kompleks crhysant no.1a', '29398913981', 'denilsenaxel1', 'denil@gmail.com', '12345', '2021-10-01', '0000-00-00', '119.4524672', '-5.1478528', '2021-11-28 11:31:40'),
(3, 2, 'Chamber', 'Jalan Secret', '0878776394628', 'secretchamber', 'chams@gmail.com', '12345', '2021-10-20', '0000-00-00', '0.0000000', '0.0000000', '2021-11-16 22:21:26'),
(4, 3, 'Rowena', 'Jalan Revenclaw', '0878776394628', 'rewrev', 'rowrev@gmail.com', '12345', '2021-10-20', '0000-00-00', '0.0000000', '0.0000000', '2021-11-16 22:21:26'),
(5, 4, 'Newt', 'Jalan Salamander No.25', '087201639642', 'scamander', 'scamander@gmail.com', '12345', '2021-10-21', '0000-00-00', '0.0000000', '0.0000000', '2021-11-16 22:21:26'),
(10, 3, 'Ron', 'Jalan Weasley No.5 A', '083746293012', '', 'buttermellow@gmail.com', '', '2021-10-19', '0000-00-00', '0.0000000', '0.0000000', '2021-11-16 22:21:26'),
(11, 1, 'coba tambah', 'k.stubun', '025468752', '', 'coba@gmail.com', '', '2021-11-17', '0000-00-00', '0.0000000', '0.0000000', '2021-11-17 19:39:04'),
(12, 1, 'Gary', 'perumahan lily no 37', '23236465845', 'garymarvelim', 'gary@gmail.com', 'sales', '2021-11-25', '0000-00-00', '0.0000000', '0.0000000', '2021-11-25 20:10:02');

-- --------------------------------------------------------

--
-- Table structure for table `target_penjualan`
--

CREATE TABLE `target_penjualan` (
  `id_target` int(255) NOT NULL,
  `id_sales` int(255) NOT NULL,
  `id_manager` int(255) NOT NULL,
  `bulan` varchar(100) NOT NULL,
  `target` int(255) NOT NULL,
  `tahun` int(4) NOT NULL,
  `status` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `target_penjualan`
--

INSERT INTO `target_penjualan` (`id_target`, `id_sales`, `id_manager`, `bulan`, `target`, `tahun`, `status`) VALUES
(1, 1, 1, '10', 2000000, 2021, '0'),
(2, 2, 1, '10', 2000000, 2021, '0'),
(3, 3, 2, '10', 1000000, 2021, '0'),
(4, 4, 3, '10', 3000000, 2021, '0'),
(5, 5, 4, '11', 500000, 2021, '0'),
(6, 10, 3, '11', 400000, 2021, '0'),
(10, 1, 1, '11', 350000, 2021, '0'),
(12, 2, 1, '11', 1000000, 2021, '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktivitas_sales`
--
ALTER TABLE `aktivitas_sales`
  ADD PRIMARY KEY (`id_aktivitas`),
  ADD KEY `fk_id_sales2` (`id_sales`),
  ADD KEY `fk_id_manager2` (`id_manager`),
  ADD KEY `fk_id_customer2` (`id_customer`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`),
  ADD KEY `fk_id_sales` (`id_sales`);

--
-- Indexes for table `detail_order`
--
ALTER TABLE `detail_order`
  ADD PRIMARY KEY (`id_detail_order`),
  ADD KEY `fk_id_order` (`id_order`),
  ADD KEY `fk_id_produk` (`id_produk`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id_manager`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `fk_id_sales3` (`id_sales`),
  ADD KEY `fk_id_customer` (`id_customer`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `fk_id_manager3` (`id_manager`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id_sales`),
  ADD KEY `fk_id_manager` (`id_manager`);

--
-- Indexes for table `target_penjualan`
--
ALTER TABLE `target_penjualan`
  ADD PRIMARY KEY (`id_target`),
  ADD KEY `fk_id_sales4` (`id_sales`),
  ADD KEY `fk_id_manager4` (`id_manager`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktivitas_sales`
--
ALTER TABLE `aktivitas_sales`
  MODIFY `id_aktivitas` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `detail_order`
--
ALTER TABLE `detail_order`
  MODIFY `id_detail_order` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `id_manager` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id_order` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id_sales` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `target_penjualan`
--
ALTER TABLE `target_penjualan`
  MODIFY `id_target` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aktivitas_sales`
--
ALTER TABLE `aktivitas_sales`
  ADD CONSTRAINT `fk_id_customer2` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`),
  ADD CONSTRAINT `fk_id_manager2` FOREIGN KEY (`id_manager`) REFERENCES `manager` (`id_manager`),
  ADD CONSTRAINT `fk_id_sales2` FOREIGN KEY (`id_sales`) REFERENCES `sales` (`id_sales`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_id_sales` FOREIGN KEY (`id_sales`) REFERENCES `sales` (`id_sales`);

--
-- Constraints for table `detail_order`
--
ALTER TABLE `detail_order`
  ADD CONSTRAINT `fk_id_order` FOREIGN KEY (`id_order`) REFERENCES `order` (`id_order`),
  ADD CONSTRAINT `fk_id_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_id_customer` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`),
  ADD CONSTRAINT `fk_id_sales3` FOREIGN KEY (`id_sales`) REFERENCES `sales` (`id_sales`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `fk_id_manager3` FOREIGN KEY (`id_manager`) REFERENCES `manager` (`id_manager`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `fk_id_manager` FOREIGN KEY (`id_manager`) REFERENCES `manager` (`id_manager`);

--
-- Constraints for table `target_penjualan`
--
ALTER TABLE `target_penjualan`
  ADD CONSTRAINT `fk_id_manager4` FOREIGN KEY (`id_manager`) REFERENCES `manager` (`id_manager`),
  ADD CONSTRAINT `fk_id_sales4` FOREIGN KEY (`id_sales`) REFERENCES `sales` (`id_sales`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
