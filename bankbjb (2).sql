-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2020 at 02:48 PM
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
-- Table structure for table `gl`
--

CREATE TABLE `gl` (
  `KODE_GL` varchar(16) NOT NULL,
  `KATEGORI` varchar(64) NOT NULL,
  `SUB_KATEGORI` varchar(64) NOT NULL,
  `NAMA_GL` varchar(256) NOT NULL,
  `KELOMPOK` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gl`
--

INSERT INTO `gl` (`KODE_GL`, `KATEGORI`, `SUB_KATEGORI`, `NAMA_GL`, `KELOMPOK`) VALUES
('952020', 'Barang & Jasa', 'Kerugian Risiko Ops', 'Kerusakan Aset Tetap & Inventaris', 'Operating Expense'),
('801101', 'CAPEX', 'AT', 'Tanah Hak Milik (Singaparna)', 'Capital Expense'),
('952001', 'Pemeliharaan & Perbaikan', 'Perbaikan', 'Bangunan Kantor', 'Operating Expense');

-- --------------------------------------------------------

--
-- Table structure for table `j_project`
--

CREATE TABLE `j_project` (
  `KODE_JENISPROJECT` varchar(16) NOT NULL,
  `jenis` varchar(64) NOT NULL,
  `STATUS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `USER` varchar(24) NOT NULL,
  `TGL_LOG` datetime NOT NULL,
  `TABLE_NAME` varchar(16) NOT NULL,
  `KODE_DATA` varchar(16) NOT NULL,
  `ACTIVITY` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mutasi_pks`
--

CREATE TABLE `mutasi_pks` (
  `KODE_MUTASI` varchar(16) NOT NULL,
  `KODE_PKS` varchar(16) NOT NULL,
  `NOMINAL` int(11) NOT NULL,
  `TGL_MUTASI` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mutasi_rbb`
--

CREATE TABLE `mutasi_rbb` (
  `KODE_MUTASI` varchar(16) NOT NULL,
  `KODE_RBB` varchar(16) NOT NULL,
  `NOMINAL` int(11) NOT NULL,
  `KETERANGAN` varchar(32) NOT NULL,
  `TGL_MUTASI` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `INVOICE` varchar(16) NOT NULL,
  `KODE_TERMIN` varchar(16) NOT NULL,
  `TGL_INVOICE` date NOT NULL,
  `INPUT_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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
  `SISA_ANGGARAN` int(11) NOT NULL,
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
  `SISA_ANGGARAN` int(11) NOT NULL,
  `INPUT_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `termin_pks`
--

CREATE TABLE `termin_pks` (
  `NO_PKS` varchar(16) NOT NULL,
  `KODE_TERMIN` varchar(16) NOT NULL,
  `TERMIN` int(11) NOT NULL,
  `TGL_TERMIN` date NOT NULL,
  `NOMINAL` int(11) NOT NULL,
  `GL` varchar(16) NOT NULL,
  `KATEGORI` varchar(32) NOT NULL,
  `STATUS` varchar(16) NOT NULL DEFAULT 'UNPAID',
  `INPUT_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ROLE` varchar(16) NOT NULL,
  `NAMA` varchar(128) NOT NULL,
  `USERNAME` varchar(24) NOT NULL,
  `EMAIL` varchar(128) NOT NULL,
  `PASSWORD` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ROLE`, `NAMA`, `USERNAME`, `EMAIL`, `PASSWORD`) VALUES
('IT FINANCE', 'IT FINANCE', 'IT FINANCE', 'finance.bankbjb@gmail.com', '$2y$10$o4FpNujMyGL.DgfNPTAHIuN7pQ8GLmBvSeEUfdxDpLpbpYY1FY2MS');

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `KODE_VENDOR` varchar(16) NOT NULL,
  `nama_vendor` varchar(64) NOT NULL,
  `STATUS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `j_project`
--
ALTER TABLE `j_project`
  ADD PRIMARY KEY (`KODE_JENISPROJECT`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mutasi_pks`
--
ALTER TABLE `mutasi_pks`
  ADD PRIMARY KEY (`KODE_MUTASI`);

--
-- Indexes for table `mutasi_rbb`
--
ALTER TABLE `mutasi_rbb`
  ADD PRIMARY KEY (`KODE_MUTASI`);

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
-- Indexes for table `termin_pks`
--
ALTER TABLE `termin_pks`
  ADD PRIMARY KEY (`KODE_TERMIN`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`USERNAME`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`KODE_VENDOR`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=522;
--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
