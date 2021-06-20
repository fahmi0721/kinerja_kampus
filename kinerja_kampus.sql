-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2021 at 01:42 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kinerja_kampus`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fakultas`
--

CREATE TABLE `tbl_fakultas` (
  `Id` int(11) NOT NULL,
  `Nama` varchar(100) DEFAULT NULL,
  `Keterangan` text DEFAULT NULL,
  `TglCreate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_fakultas`
--

INSERT INTO `tbl_fakultas` (`Id`, `Nama`, `Keterangan`, `TglCreate`) VALUES
(1, 'XSSQQSQS', 'swwsswssws', '2021-06-20 18:07:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ip`
--

CREATE TABLE `tbl_ip` (
  `Id` int(11) NOT NULL,
  `Nama` varchar(100) DEFAULT NULL,
  `Bobot` double DEFAULT NULL,
  `Keterangan` text DEFAULT NULL,
  `TglCreate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ip`
--

INSERT INTO `tbl_ip` (`Id`, `Nama`, `Bobot`, `Keterangan`, `TglCreate`) VALUES
(1, 'SWWS', 100, 'wd', '2021-06-20 18:19:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `Id` int(11) NOT NULL,
  `Nama` varchar(100) DEFAULT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Level` enum('0','1','2') DEFAULT NULL,
  `TglCreate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`Id`, `Nama`, `Username`, `Password`, `Level`, `TglCreate`) VALUES
(1, 'FAHMI IDRUS', 'fahmi07', 'f0d0ccd4e2c631ae28d1c4d3cdb8950c', '0', '2021-06-20 11:53:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_fakultas`
--
ALTER TABLE `tbl_fakultas`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tbl_ip`
--
ALTER TABLE `tbl_ip`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_fakultas`
--
ALTER TABLE `tbl_fakultas`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_ip`
--
ALTER TABLE `tbl_ip`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
