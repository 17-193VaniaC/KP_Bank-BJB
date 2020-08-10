-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Agu 2020 pada 05.14
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

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`USERNAME`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
