-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2020 at 07:00 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bankbjb`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis project`
--

CREATE TABLE `jenis project` (
  `jenis` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `INVOICE` varchar(16) NOT NULL,
  `NO_PKS` varchar(16) NOT NULL,
  `TGL_INVOICE` date NOT NULL,
  `TERMIN` int(11) NOT NULL,
  `NOMINAL_BAYAR` int(11) NOT NULL,
  `SISA_ANGGARAN_PKS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pks`
--

CREATE TABLE `pks` (
  `NO_PKS` varchar(16) NOT NULL,
  `KODE_RBB` varchar(16) NOT NULL,
  `JENIS` varchar(48) NOT NULL,
  `KODE_PROJECT` varchar(24) NOT NULL,
  `NAMA_PROJECT` varchar(128) NOT NULL,
  `TGL_PKS` date NOT NULL,
  `NOMINAL_PKS` int(11) NOT NULL,
  `NAMA_VENDOR` varchar(128) NOT NULL,
  `INPUT_USER` varchar(128) NOT NULL,
  `INPUT_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rbb`
--

CREATE TABLE `rbb` (
  `KODE_RBB` varchar(16) NOT NULL,
  `PROGRAM_KERJA` varchar(128) NOT NULL,
  `ANGGARAN` int(11) NOT NULL,
  `GL` varchar(8) NOT NULL,
  `NAMA_REK` varchar(128) NOT NULL,
  `SISA_ANGGARAN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ROLE` varchar(16) NOT NULL,
  `KODE_USER` varchar(8) NOT NULL,
  `USERNAME` varchar(24) NOT NULL,
  `PASSWORD` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `VENDOR` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`INVOICE`),
  ADD UNIQUE KEY `INVOICE` (`INVOICE`);

--
-- Indexes for table `pks`
--
ALTER TABLE `pks`
  ADD PRIMARY KEY (`NO_PKS`),
  ADD UNIQUE KEY `NO_PKS` (`NO_PKS`);

--
-- Indexes for table `rbb`
--
ALTER TABLE `rbb`
  ADD PRIMARY KEY (`KODE_RBB`),
  ADD UNIQUE KEY `KODE_RBB` (`KODE_RBB`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`KODE_USER`),
  ADD UNIQUE KEY `KODE_USER` (`KODE_USER`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
