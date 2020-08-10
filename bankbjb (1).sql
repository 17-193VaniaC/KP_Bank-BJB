-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Agu 2020 pada 05.38
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Struktur dari tabel `gl`
--

CREATE TABLE `gl` (
  `KODE_GL` varchar(16) NOT NULL,
  `NAMA_GL` varchar(256) NOT NULL,
  `KELOMPOK` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `j_project`
--

CREATE TABLE `j_project` (
  `jenis` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `j_project`
--

INSERT INTO `j_project` (`jenis`) VALUES
('jenis 1'),
('jenis 2'),
('jenis 3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `USER` varchar(24) NOT NULL,
  `TGL_LOG` datetime NOT NULL,
  `TABLE_NAME` varchar(16) NOT NULL,
  `KODE_DATA` varchar(16) NOT NULL,
  `ACTIVITY` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mutasi_pks`
--

CREATE TABLE `mutasi_pks` (
  `KODE_MUTASI` varchar(16) NOT NULL,
  `KODE_PKS` varchar(16) NOT NULL,
  `NOMINAL` int(11) NOT NULL,
  `TGL_MUTASI` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mutasi_rbb`
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
-- Struktur dari tabel `pembayaran`
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
-- Struktur dari tabel `pks`
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
  `INPUT_DATE` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pks`
--

INSERT INTO `pks` (`NO_PKS`, `KODE_RBB`, `JENIS`, `KODE_PROJECT`, `NAMA_PROJECT`, `TGL_PKS`, `NOMINAL_PKS`, `NAMA_VENDOR`, `INPUT_USER`, `INPUT_DATE`) VALUES
('1', '1', '11', '11', '1', '0000-00-00', 1, '1', '1', '2020-08-03 21:10:52'),
('2', 'R1', 'apa', '3', 'yaaa', '2020-08-03', 2000, 'Institut Teknologi Sepuluh Nopember', 'sih', '0000-00-00 00:00:00'),
('4', 'R2', 'jm', '13', 'a', '2020-08-06', 1000, 'ITS', 'ITS', '0000-00-00 00:00:00'),
('7', 'R2', 'sksksk', 'akadj', 'yaaa', '2020-09-03', 2000000, 'Sakinah Group', 'Sakinah Group', '2020-08-10 03:23:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rbb`
--

CREATE TABLE `rbb` (
  `KODE_RBB` varchar(16) NOT NULL,
  `PROGRAM_KERJA` varchar(128) NOT NULL,
  `ANGGARAN` int(11) NOT NULL,
  `GL` varchar(8) NOT NULL,
  `NAMA_REK` varchar(128) NOT NULL,
  `SISA_ANGGARAN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rbb`
--

INSERT INTO `rbb` (`KODE_RBB`, `PROGRAM_KERJA`, `ANGGARAN`, `GL`, `NAMA_REK`, `SISA_ANGGARAN`) VALUES
('R1', 'Proker 1', 2000000000, '1234', 'Nama rek 1', 100),
('R2', 'Proker 2', 1000000000, '456', 'Ini?', 2000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `termin_pks`
--

CREATE TABLE `termin_pks` (
  `NO_PKS` varchar(16) NOT NULL,
  `KODE_TERMIN` varchar(16) NOT NULL,
  `TERMIN` int(11) NOT NULL,
  `TGL_TERMIN` date NOT NULL,
  `NOMINAL` int(11) NOT NULL,
  `STATUS` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `ROLE` varchar(16) NOT NULL,
  `NAMA` varchar(128) NOT NULL,
  `USERNAME` varchar(24) NOT NULL,
  `PASSWORD` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`ROLE`, `NAMA`, `USERNAME`, `PASSWORD`) VALUES
('IT FINANCE', 'cika', 'cika', '$2y$10$7.prwehxqo2YPtgslKOnqewcXfo9Atj/7t5wV4iA8dHdtyhSNAkkW'),
('GROUP HEAD', 'Ingga', 'ingga', '$2y$10$gdUx9yx9Dg7nyLAHf0h8nuiBvMcGrjhLNQJsK6t8LkkgubY6A956O'),
('IT FINANCE', 'Nitama', 'nitama', '$2y$10$2.zjvCevnARLVyODADrsRedBiCTxVLCeUOFRAtUE4RQoe.lE5KX3m');

-- --------------------------------------------------------

--
-- Struktur dari tabel `vendor`
--

CREATE TABLE `vendor` (
  `nama_vendor` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `vendor`
--

INSERT INTO `vendor` (`nama_vendor`) VALUES
('Institut Teknologi Sepuluh Nopember'),
('ITS'),
('Sakinah Group');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `gl`
--
ALTER TABLE `gl`
  ADD PRIMARY KEY (`KODE_GL`);

--
-- Indeks untuk tabel `mutasi_pks`
--
ALTER TABLE `mutasi_pks`
  ADD PRIMARY KEY (`KODE_MUTASI`);

--
-- Indeks untuk tabel `mutasi_rbb`
--
ALTER TABLE `mutasi_rbb`
  ADD PRIMARY KEY (`KODE_MUTASI`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`INVOICE`),
  ADD UNIQUE KEY `INVOICE` (`INVOICE`);

--
-- Indeks untuk tabel `pks`
--
ALTER TABLE `pks`
  ADD PRIMARY KEY (`NO_PKS`);

--
-- Indeks untuk tabel `rbb`
--
ALTER TABLE `rbb`
  ADD PRIMARY KEY (`KODE_RBB`),
  ADD UNIQUE KEY `KODE_RBB` (`KODE_RBB`);

--
-- Indeks untuk tabel `termin_pks`
--
ALTER TABLE `termin_pks`
  ADD PRIMARY KEY (`KODE_TERMIN`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`USERNAME`);

--
-- Indeks untuk tabel `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`nama_vendor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
