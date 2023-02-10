-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2023 at 09:09 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database apotek sehat selalu`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail transaksi`
--

CREATE TABLE `detail transaksi` (
  `Id Transaksi` int(10) NOT NULL,
  `Id Pasien` int(10) NOT NULL,
  `Id Obat` int(20) NOT NULL,
  `total transaksi` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail transaksi`
--

INSERT INTO `detail transaksi` (`Id Transaksi`, `Id Pasien`, `Id Obat`, `total transaksi`) VALUES
(34567, 34567, 1111, 200000),
(34568, 34568, 1111, 200000),
(34569, 34569, 1112, 50000),
(34570, 34570, 1112, 200000),
(34571, 34571, 1113, 450000),
(34572, 34572, 1113, 250000),
(34573, 34573, 1114, 250000),
(34574, 34574, 1115, 250000),
(34575, 34575, 1118, 2500000),
(34576, 34576, 1117, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `Id Obat` int(10) NOT NULL,
  `Nama Obat` varchar(30) NOT NULL,
  `Pembuat` varchar(30) NOT NULL,
  `Stok` int(10) NOT NULL,
  `Kadaluarsa` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`Id Obat`, `Nama Obat`, `Pembuat`, `Stok`, `Kadaluarsa`) VALUES
(34567, 'Paracetamol', 'kimia farma', 200, 2025),
(34568, 'amoccilin', 'kimia farma', 200, 2025),
(34569, 'bodrek', 'kimia farma', 200, 2025),
(34570, 'panadol', 'kimia farma', 200, 2025),
(34571, 'vitamin c', 'kimia farma', 200, 2025),
(34572, 'vitamoin a', 'kimia farma', 150, 2025),
(34573, 'vitamin b', 'kimia farma', 150, 2025),
(34574, 'vitamin d', 'kimia farma', 150, 2024),
(34575, 'mixagrip', 'kimia farma', 150, 2024),
(34576, 'konidin', 'kimia farma', 150, 2024);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `Id Pasien` int(10) NOT NULL,
  `Nama Pasien` varchar(20) NOT NULL,
  `Tanggal Lahir` varchar(20) NOT NULL,
  `Alamat` varchar(60) NOT NULL,
  `No Telephon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`Id Pasien`, `Nama Pasien`, `Tanggal Lahir`, `Alamat`, `No Telephon`) VALUES
(34567, 'zainudin', '17082000', 'jl bayangkara no 17 samarinda', 823456718),
(34568, 'fahrozy', '21122001', 'jl.lambung mangurat no69 samrinda', 822374593),
(34569, 'ilmy', '23101996', 'jl bayangkara no12 samarinda', 813246986),
(34570, 'dani', '20071990', 'jl. woltermongonsidi no 88 samarinda', 856789123),
(34571, 'hardy', '01012000', 'jl m said no 90 samairinda', 812345123),
(34572, 'dede', '12122002', 'jl bayangkara no 20 samarinda', 857234098),
(34573, 'akbar', '17082002', 'jl.lambung mangurat no 09 samrinda', 853876123),
(34574, 'holan', '13101995', 'jl woltermongonsidi no 28 samarinda', 822668638),
(34575, 'rama', '21022001', 'jl bayangkara no 10 samarinda', 823568457),
(34576, 'fikri', '17082004', 'jl m said no 30 samairinda', 857547664);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `Id Transaksi` int(10) NOT NULL,
  `Id Pasien` int(10) NOT NULL,
  `Tanggal Transaksi` int(10) NOT NULL,
  `Jumlah transaksi` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`Id Transaksi`, `Id Pasien`, `Tanggal Transaksi`, `Jumlah transaksi`) VALUES
(34567, 34567, 13102020, 200000),
(34568, 34568, 13102019, 200000),
(34569, 34569, 1812020, 50000),
(34570, 34570, 13102020, 200000),
(34571, 34571, 1012020, 450000),
(34572, 34572, 13102020, 250000),
(34573, 34573, 13102020, 250000),
(34574, 34574, 13102019, 250000),
(34575, 34575, 1012019, 2500000),
(34576, 34576, 1012019, 50000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail transaksi`
--
ALTER TABLE `detail transaksi`
  ADD PRIMARY KEY (`Id Transaksi`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`Id Obat`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`Id Pasien`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`Id Transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail transaksi`
--
ALTER TABLE `detail transaksi`
  MODIFY `Id Transaksi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34577;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `Id Pasien` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34577;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail transaksi`
--
ALTER TABLE `detail transaksi`
  ADD CONSTRAINT `detail transaksi_ibfk_1` FOREIGN KEY (`Id Transaksi`) REFERENCES `transaksi` (`Id Transaksi`);

--
-- Constraints for table `obat`
--
ALTER TABLE `obat`
  ADD CONSTRAINT `obat_ibfk_1` FOREIGN KEY (`Id Obat`) REFERENCES `detail transaksi` (`Id Transaksi`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`Id Transaksi`) REFERENCES `pasien` (`Id Pasien`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
