-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2026 at 11:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pendataan_kk`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota_keluarga`
--

CREATE TABLE `anggota_keluarga` (
  `id_anggota` int(50) NOT NULL,
  `id_kk` int(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `hubungan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota_keluarga`
--

INSERT INTO `anggota_keluarga` (`id_anggota`, `id_kk`, `nama`, `nik`, `jenis_kelamin`, `hubungan`) VALUES
(1, 1, 'ahmad', '09876564322', 'Laki-laki', 'kepala keluarga'),
(2, 2, 'care', '987654321456', 'Perempuan', 'istri'),
(3, 3, 'rizky', '908765432145467', 'Laki-laki', 'kepala keluarga'),
(4, 3, 'care', '987654876754635', 'Perempuan', 'istri'),
(5, 3, 'shafa', '098978675643524', 'Perempuan', 'anak '),
(6, 3, 'dwi', '09876543256789', 'Laki-laki', 'pacar anak'),
(7, 4, 'ahmad', '09876564322', 'Laki-laki', 'kepala keluarga'),
(8, 4, 'shafa', '987654321456', 'Perempuan', 'istri'),
(9, 5, 'ahmad', '09876564322', 'Perempuan', 'kepala keluarga'),
(10, 5, 'shafa', '987654321456', 'Perempuan', 'istri');

-- --------------------------------------------------------

--
-- Table structure for table `kartu_keluarga`
--

CREATE TABLE `kartu_keluarga` (
  `id_kk` int(50) NOT NULL,
  `no_kk` varchar(50) NOT NULL,
  `nama_kepala_keluarga` varchar(100) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kartu_keluarga`
--

INSERT INTO `kartu_keluarga` (`id_kk`, `no_kk`, `nama_kepala_keluarga`, `alamat`) VALUES
(1, '098765498222', 'ahmad', 'babarsari'),
(2, '098765498222', 'ahmad', 'Babarsari'),
(3, '098765498222', 'rizky', 'babarsari'),
(4, '98765467890', 'ahmad', 'Babarsaru'),
(5, '09876543245678', 'fjgghjukj', 'gggffhfhg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`) VALUES
(1, 'admin', '124');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota_keluarga`
--
ALTER TABLE `anggota_keluarga`
  ADD PRIMARY KEY (`id_anggota`),
  ADD KEY `id_kk` (`id_kk`);

--
-- Indexes for table `kartu_keluarga`
--
ALTER TABLE `kartu_keluarga`
  ADD PRIMARY KEY (`id_kk`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota_keluarga`
--
ALTER TABLE `anggota_keluarga`
  MODIFY `id_anggota` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kartu_keluarga`
--
ALTER TABLE `kartu_keluarga`
  MODIFY `id_kk` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anggota_keluarga`
--
ALTER TABLE `anggota_keluarga`
  ADD CONSTRAINT `anggota_keluarga_ibfk_1` FOREIGN KEY (`id_kk`) REFERENCES `kartu_keluarga` (`id_kk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
