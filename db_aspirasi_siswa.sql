-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Mar 2026 pada 09.52
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_aspirasi_siswa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `password` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`password`, `username`) VALUES
('b0baee9d279d34fa1dfd71aadb908c3f', '21232f297a57a5a743894a0e4a801fc3'),
('b0baee9d279d34fa1dfd71aadb908c3f', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_aspirasi`
--

CREATE TABLE `tb_aspirasi` (
  `id_aspirasi` int(5) NOT NULL,
  `status` enum('menunggu','proses','selesai') NOT NULL,
  `id_pelaporan` int(5) NOT NULL,
  `feedback` text NOT NULL,
  `tgl_aspirasi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_aspirasi`
--

INSERT INTO `tb_aspirasi` (`id_aspirasi`, `status`, `id_pelaporan`, `feedback`, `tgl_aspirasi`) VALUES
(1, 'menunggu', 1, 'baik', '2026-03-30 05:00:32'),
(2, 'proses', 15, 'sdfsfefe', '2026-03-30 05:44:59'),
(3, 'selesai', 16, 'sudah ada bisa dipakai lagii', '2026-03-31 03:09:55'),
(4, 'menunggu', 17, '', '2026-03-31 04:10:55'),
(5, 'menunggu', 18, '', '2026-03-31 04:22:25'),
(6, 'menunggu', 41, '', '2026-03-31 06:35:51'),
(7, 'menunggu', 44, '', '2026-03-31 06:50:24'),
(8, 'menunggu', 45, '', '2026-03-31 06:51:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_input_aspirasi`
--

CREATE TABLE `tb_input_aspirasi` (
  `id_pelaporan` int(5) NOT NULL,
  `nis` int(10) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `ket` varchar(50) NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_input_aspirasi`
--

INSERT INTO `tb_input_aspirasi` (`id_pelaporan`, `nis`, `id_kategori`, `lokasi`, `ket`, `tgl_input`) VALUES
(1, 121212, 6, 'di kelas 12 rpl 2', 'aaaa', '2026-03-30 03:11:24'),
(15, 121212, 1, 'di kelas 12 rpl 3', 'banyak lebah', '2026-03-30 05:44:36'),
(16, 121212, 2, 'didalam kamar  mandi perpus', 'airnya nga mau hidup', '2026-03-31 03:01:11'),
(17, 121212, 4, 'wc', 'pintu rusak,lampu mati,wc jorok,air kecil,air terg', '2026-03-31 04:10:55'),
(18, 1212, 5, 'di lapangan smk penerbangan', 'dibombardir awak belanda', '2026-03-31 04:22:25'),
(41, 121212, 1, 'di kelas 12 rpl 3', 'fsdgxfxhdg', '2026-03-31 06:35:51'),
(44, 121212, 6, 'asd', 'asdasd', '2026-03-31 06:50:24'),
(45, 121212, 6, 'hgsadhasd', 'asdas', '2026-03-31 06:51:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(5) NOT NULL,
  `ket_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `ket_kategori`) VALUES
(1, 'Laboratium'),
(2, 'Ruang Kelas'),
(3, 'Perpustakaan'),
(4, 'Toilet'),
(5, 'Jaringan internet'),
(6, 'Fasilitas olahraga'),
(7, 'Kebersihan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `nis` int(10) NOT NULL,
  `kelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_siswa`
--

INSERT INTO `tb_siswa` (`nis`, `kelas`) VALUES
(121212, '12 rpl 2');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_aspirasi`
--
ALTER TABLE `tb_aspirasi`
  ADD PRIMARY KEY (`id_aspirasi`),
  ADD UNIQUE KEY `id_kategori` (`id_pelaporan`),
  ADD UNIQUE KEY `id_pelaporan` (`id_pelaporan`);

--
-- Indeks untuk tabel `tb_input_aspirasi`
--
ALTER TABLE `tb_input_aspirasi`
  ADD PRIMARY KEY (`id_pelaporan`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`nis`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_aspirasi`
--
ALTER TABLE `tb_aspirasi`
  MODIFY `id_aspirasi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_input_aspirasi`
--
ALTER TABLE `tb_input_aspirasi`
  MODIFY `id_pelaporan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
