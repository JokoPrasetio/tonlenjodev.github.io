-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Agu 2022 pada 05.07
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_parfum`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori2`
--

CREATE TABLE `kategori2` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori2`
--

INSERT INTO `kategori2` (`id_kategori`, `nama_kategori`) VALUES
(2, 'sepatu'),
(3, 'kemeja ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `nama_pulau` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nama_pulau`, `tarif`) VALUES
(1, 'Sumatera', 10000),
(2, 'Jawa', 14000),
(3, 'Kalimantan', 16000),
(4, 'Sulawesi', 18000),
(5, 'Papua', 24000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email_pelanggan` varchar(100) NOT NULL,
  `password_pelanggan` varchar(100) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `telepon_pelanggan` varchar(25) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `telepon_pelanggan`, `alamat`) VALUES
(1, 'rio@gmail.com', '1234', 'rio', '0390897490', ''),
(2, 'tio@gmail.com', '1234', 'tio', '12415423532', ''),
(5, 'joko12@gmail.com', '12345', 'joko', '235983284', 'jajfakgjal;k');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `bank` varchar(40) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti`) VALUES
(8, 24, 'rio', 'bri', 220000, '2022-08-07', '2022080704304761663796_490485351743094_4171362724246192128_n.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `nama_pulau` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `status_pembelian` varchar(100) NOT NULL DEFAULT 'pending',
  `resi_pengiriman` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `id_ongkir`, `tanggal_pembelian`, `total_pembelian`, `nama_pulau`, `tarif`, `alamat`, `status_pembelian`, `resi_pengiriman`) VALUES
(12, 1, 3, '2022-07-29', 246734, '', 0, '', 'pending', ''),
(13, 1, 3, '2022-07-29', 66000, '', 0, '', 'pending', ''),
(14, 1, 3, '2022-07-29', 66000, '', 0, '', 'pending', ''),
(15, 1, 1, '2022-08-03', 101601, '', 0, '', 'pending', ''),
(16, 1, 4, '2022-08-04', 188000, '', 0, '', 'pending', ''),
(17, 1, 1, '2022-08-04', 85000, '', 0, '', 'pending', ''),
(18, 1, 3, '2022-08-04', 186367, '', 0, '', 'pending', ''),
(19, 1, 1, '2022-08-04', 85000, '', 0, '', 'pending', ''),
(20, 1, 3, '2022-08-04', 106367, 'Kalimantan', 16000, '', 'pending', ''),
(21, 1, 1, '2022-08-05', 70000, 'Sumatera', 10000, 'lengkong', 'pending', ''),
(22, 1, 1, '2022-08-06', 199000, 'Sumatera', 10000, 'Jl. Kutilang RT 01/ RW 01\r\nkelurahan Margamulya\r\nKec. Lubuklinggau selatan 2', 'pending', ''),
(23, 1, 1, '2022-08-06', 10000, 'Sumatera', 10000, 'Jl. Kutilang RT 01/ RW 01\r\nkelurahan Margamulya\r\nKec. Lubuklinggau selatan 2', 'pending', ''),
(24, 1, 1, '2022-08-06', 110000, 'Sumatera', 10000, '', 'lunas', '12345'),
(25, 1, 5, '2022-08-07', 4024000, 'Papua', 24000, 'jakkjda', 'pending', ''),
(26, 2, 2, '2022-08-07', 1014000, 'Jawa', 14000, 'Jl. Kutilang RT 01/ RW 01\r\nkelurahan Margamulya', 'pending', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `subberat` int(11) NOT NULL,
  `subharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah`, `nama`, `harga`, `berat`, `subberat`, `subharga`) VALUES
(18, 12, 9, 2, '', 0, 0, 0, 0),
(19, 12, 8, 1, '', 0, 0, 0, 0),
(20, 13, 8, 1, '', 0, 0, 0, 0),
(21, 14, 8, 1, '', 0, 0, 0, 0),
(22, 15, 9, 1, '', 0, 0, 0, 0),
(23, 15, 6, 1, '', 0, 0, 0, 0),
(24, 16, 10, 1, '', 0, 0, 0, 0),
(25, 16, 11, 1, '', 0, 0, 0, 0),
(26, 17, 8, 1, 'kemeja flanel hijau', 75000, 1, 1, 0),
(27, 18, 9, 1, 'gass', 90367, 34, 34, 90367),
(28, 18, 10, 1, 'kemeja flanel putih', 80000, 2, 2, 80000),
(29, 19, 8, 1, 'kemeja flanel hijau', 75000, 1, 1, 75000),
(30, 20, 9, 1, 'gass', 90367, 34, 34, 90367),
(31, 21, 8, 1, 'kemeja flanel hijau', 60000, 1, 1, 60000),
(32, 22, 10, 1, 'kemeja flanel putih', 100000, 2, 2, 100000),
(33, 22, 14, 1, 'kemeja garis garis kotak', 89000, 78, 78, 89000),
(34, 0, 15, 1, 'hijab', 9000, 89, 89, 9000),
(35, 24, 10, 1, 'kemeja flanel putih', 100000, 2, 2, 100000),
(36, 25, 9, 4, 'gass', 1000000, 34, 136, 4000000),
(37, 26, 9, 1, 'gass', 1000000, 34, 34, 1000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `berat_produk` int(11) NOT NULL,
  `foto_produk` varchar(100) NOT NULL,
  `deskripsi_produk` varchar(100) NOT NULL,
  `stok_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `harga_produk`, `berat_produk`, `foto_produk`, `deskripsi_produk`, `stok_produk`) VALUES
(8, 2, 'kemeja', 60000, 1, 'fotoproduk1659540219.jpeg', 'kemeja gokil ini ', 79),
(9, 1, 'gass', 1000000, 34, 'fotoproduk1659080279.jpg', 'jaklgjawlk', 23),
(10, 1, 'kemeja flanel putih', 100000, 2, 'fotoproduk1659540249.jpeg', 'kemeja terbaik abad ini', 5),
(11, 1, 'kemeja flanel kotak bulat', 90000, 2, 'fotoproduk1659540285.jpeg', 'kemeja terbaik abad ini no 2', 5),
(12, 1, 'kemeja kotak kotak tapi bukan jokowi', 80000, 39, 'fotoproduk1659540312.jpeg', 'hahahahaa', 5),
(13, 1, 'kemeja kotak kotak sesi 2', 190000, 78, 'fotoproduk1659540358.jpeg', 'beli ini produk di jamin bakal keren', 5),
(14, 1, 'kemeja', 89000, 78, 'fotoproduk1659540385.jpeg', 'hahaahahahahahah', 48),
(21, 2, 'baju putih', 50000, 12, 'fotoproduk1659842090.jpg', 'jkajak', 4),
(22, 2, 'akhda', 8325728, 932598, 'fotoproduk1660043442.jpeg', 'jsekflsl', 20),
(23, 3, 'joko', 134, 5, 'f', 'klfjges', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_foto`
--

CREATE TABLE `produk_foto` (
  `id_produk_foto` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk_foto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk_foto`
--

INSERT INTO `produk_foto` (`id_produk_foto`, `id_produk`, `nama_produk_foto`) VALUES
(1, 24, 'kemeja flanel (1).jpeg'),
(2, 24, 'kemeja flanel (2).jpeg'),
(23, 0, '20220810195530kemeja flanel (1).jpeg'),
(25, 23, '20220810200302kemeja flanel (2).jpeg'),
(26, 23, 'foto20220810200414');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `username`, `password`) VALUES
(1, 'joko', '12345'),
(2, 'admin', '12345');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori2`
--
ALTER TABLE `kategori2`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indeks untuk tabel `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `produk_foto`
--
ALTER TABLE `produk_foto`
  ADD PRIMARY KEY (`id_produk_foto`);

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori2`
--
ALTER TABLE `kategori2`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `produk_foto`
--
ALTER TABLE `produk_foto`
  MODIFY `id_produk_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
