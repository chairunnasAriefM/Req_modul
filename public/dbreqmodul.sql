-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 17 Jun 2024 pada 13.45
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbreqmodul`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `id_anggota_request` varchar(16) DEFAULT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `edisi_tahun` varchar(20) DEFAULT NULL,
  `penerbit` varchar(100) DEFAULT NULL,
  `pengarang` varchar(100) DEFAULT NULL,
  `jenis_buku` varchar(50) DEFAULT NULL,
  `link_beli` varchar(255) DEFAULT NULL,
  `perkiraan_harga` int(11) DEFAULT NULL,
  `tanggal_request` date DEFAULT NULL,
  `status` enum('diterima','ditolak','proses eksekusi','sudah dieksekusi') NOT NULL DEFAULT 'proses eksekusi',
  `staff_id_verifikasi` varchar(16) DEFAULT NULL,
  `tanggal_verifikasi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `id_anggota_request`, `judul_buku`, `edisi_tahun`, `penerbit`, `pengarang`, `jenis_buku`, `link_beli`, `perkiraan_harga`, `tanggal_request`, `status`, `staff_id_verifikasi`, `tanggal_verifikasi`) VALUES
(4, 'e1763d5bdaae4e1b', 'Bleach chapter 01', '2005', 'Shueisha', 'Tite Kubo', 'Hobi', 'https://www.gramedia.com/products/bleach-01-1', 35000, '2024-06-16', 'proses eksekusi', NULL, NULL),
(5, 'e1763d5bdaae4e1b', 'Basis damar daffa', '2077', 'Faddly', 'Damar dan Daffa', 'Refrensi', 'https://drive.google.com', 1000000000, '2024-06-16', 'proses eksekusi', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `civitas_akademik`
--

CREATE TABLE `civitas_akademik` (
  `id_anggota` varchar(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `civitas_akademik`
--

INSERT INTO `civitas_akademik` (`id_anggota`, `email`, `nama`, `password`, `role`) VALUES
('1083701898753437', 'chairunnas23ti@mahasiswa.pcr.ac.id', 'CHAIRUNNAS ARIEF MAULANA', '$2y$10$7m8fYC7n.c0QQrYJAp/AaeDTNcs6JcPmMTmlUl.as6GGaKtGxfUw2', 'mahasiswa'),
('e1763d5bdaae4e1b', 'iyunkmaulana05@gmail.com', 'iyunk', '$2y$10$JuwXa7RRZDjHucRHe5Ug0e7pprNai0lj6KhB9/JKfYIizTlZSrta2', 'dosen');

-- --------------------------------------------------------

--
-- Struktur dari tabel `modul`
--

CREATE TABLE `modul` (
  `modul_id` int(11) NOT NULL,
  `id_anggota_request` varchar(16) DEFAULT NULL,
  `judul_modul` varchar(255) NOT NULL,
  `soft_file` varchar(255) DEFAULT NULL,
  `jumlah_cetak` int(11) DEFAULT NULL,
  `status` enum('diterima','ditolak','proses eksekusi','sudah dieksekusi') NOT NULL DEFAULT 'proses eksekusi',
  `tanggal_request` date NOT NULL,
  `staff_id_verifikasi` varchar(16) DEFAULT NULL,
  `tanggal_verifikasi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `modul`
--

INSERT INTO `modul` (`modul_id`, `id_anggota_request`, `judul_modul`, `soft_file`, `jumlah_cetak`, `status`, `tanggal_request`, `staff_id_verifikasi`, `tanggal_verifikasi`) VALUES
(2, NULL, 'belajar bersama saya', '1.pdf', 12, 'proses eksekusi', '0000-00-00', NULL, NULL),
(3, 'e1763d5bdaae4e1b', 'anjay mantap', 'Certificate.pdf', 100000, 'proses eksekusi', '2024-06-16', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `staff_perpustakaan`
--

CREATE TABLE `staff_perpustakaan` (
  `staff_id` varchar(16) NOT NULL,
  `nama_staff` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `staff_perpustakaan`
--

INSERT INTO `staff_perpustakaan` (`staff_id`, `nama_staff`, `email`, `password`) VALUES
('12341', 'admin', 'admin@gmail.com', '$2y$10$qCEwKnrtWkZG5QpnXM/3B.hHzO2dnZ8DQmtAnC8bN5wK5WNb/rPPC');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_anggota_request` (`id_anggota_request`),
  ADD KEY `staff_id_verifikasi` (`staff_id_verifikasi`);

--
-- Indeks untuk tabel `civitas_akademik`
--
ALTER TABLE `civitas_akademik`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`modul_id`),
  ADD KEY `id_anggota_request` (`id_anggota_request`),
  ADD KEY `staff_id_verifikasi` (`staff_id_verifikasi`);

--
-- Indeks untuk tabel `staff_perpustakaan`
--
ALTER TABLE `staff_perpustakaan`
  ADD PRIMARY KEY (`staff_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `modul`
--
ALTER TABLE `modul`
  MODIFY `modul_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_anggota_request`) REFERENCES `civitas_akademik` (`id_anggota`),
  ADD CONSTRAINT `buku_ibfk_2` FOREIGN KEY (`staff_id_verifikasi`) REFERENCES `staff_perpustakaan` (`staff_id`);

--
-- Ketidakleluasaan untuk tabel `modul`
--
ALTER TABLE `modul`
  ADD CONSTRAINT `modul_ibfk_1` FOREIGN KEY (`id_anggota_request`) REFERENCES `civitas_akademik` (`id_anggota`),
  ADD CONSTRAINT `modul_ibfk_2` FOREIGN KEY (`staff_id_verifikasi`) REFERENCES `staff_perpustakaan` (`staff_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
