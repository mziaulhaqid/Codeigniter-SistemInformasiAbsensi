-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Nov 2019 pada 04.17
-- Versi server: 10.1.32-MariaDB
-- Versi PHP: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `devisi`
--

CREATE TABLE `devisi` (
  `kode_devisi` varchar(10) NOT NULL,
  `nama_devisi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kehadiran`
--

CREATE TABLE `kehadiran` (
  `kode_kehadiran` varchar(20) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `tanggal_kehadiran` date NOT NULL,
  `jam_masuk` varchar(10) NOT NULL,
  `jam_keluar` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `kode_devisi` varchar(20) DEFAULT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `profile` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `kode_user` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`kode_user`, `nama`, `username`, `password`, `profile`) VALUES
('0001', 'Gibran Alvinda', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', '0001.png');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_kehadiran`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_kehadiran` (
`kode_kehadiran` varchar(20)
,`nip` varchar(20)
,`tanggal_kehadiran` date
,`jam_masuk` varchar(10)
,`jam_keluar` varchar(10)
,`status` varchar(20)
,`nama_pegawai` varchar(50)
,`profile` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_pegawai`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_pegawai` (
`nip` varchar(20)
,`kode_devisi` varchar(20)
,`nama_pegawai` varchar(50)
,`email` varchar(50)
,`profile` varchar(20)
,`nama_devisi` varchar(20)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `v_kehadiran`
--
DROP TABLE IF EXISTS `v_kehadiran`;

CREATE VIEW `v_kehadiran`  AS  select `kehadiran`.`kode_kehadiran` AS `kode_kehadiran`,`kehadiran`.`nip` AS `nip`,`kehadiran`.`tanggal_kehadiran` AS `tanggal_kehadiran`,`kehadiran`.`jam_masuk` AS `jam_masuk`,`kehadiran`.`jam_keluar` AS `jam_keluar`,`kehadiran`.`status` AS `status`,`pegawai`.`nama_pegawai` AS `nama_pegawai`,`pegawai`.`profile` AS `profile` from (`kehadiran` join `pegawai` on((`kehadiran`.`nip` = `kehadiran`.`nip`))) group by `kehadiran`.`kode_kehadiran` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_pegawai`
--
DROP TABLE IF EXISTS `v_pegawai`;

CREATE VIEW `v_pegawai`  AS  select `pegawai`.`nip` AS `nip`,`pegawai`.`kode_devisi` AS `kode_devisi`,`pegawai`.`nama_pegawai` AS `nama_pegawai`,`pegawai`.`email` AS `email`,`pegawai`.`profile` AS `profile`,`devisi`.`nama_devisi` AS `nama_devisi` from (`pegawai` join `devisi` on((`pegawai`.`kode_devisi` = `devisi`.`kode_devisi`))) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `devisi`
--
ALTER TABLE `devisi`
  ADD PRIMARY KEY (`kode_devisi`);

--
-- Indeks untuk tabel `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD KEY `nip` (`nip`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `kode_devisi` (`kode_devisi`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD CONSTRAINT `kehadiran_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`kode_devisi`) REFERENCES `devisi` (`kode_devisi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
