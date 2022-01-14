-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jan 2022 pada 07.00
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_restaurant`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `account`
--

CREATE TABLE `account` (
  `id_pegawai` varchar(254) NOT NULL,
  `password` varchar(254) NOT NULL,
  `nama_pegawai` varchar(254) NOT NULL,
  `level` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `account`
--

INSERT INTO `account` (`id_pegawai`, `password`, `nama_pegawai`, `level`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'suprayatno', 'manager'),
('karyawan01', '9e014682c94e0f2cc834bf7348bda428', 'suyono maryono', 'karyawan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_beli`
--

CREATE TABLE `cache_beli` (
  `id_cache` int(11) NOT NULL,
  `food_id` varchar(254) NOT NULL,
  `nama` varchar(254) NOT NULL,
  `jumlah_beli` int(254) NOT NULL,
  `harga_total` int(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_order`
--

CREATE TABLE `detail_order` (
  `food_id` varchar(254) NOT NULL,
  `order_id` varchar(254) NOT NULL,
  `jumlah_pesan` int(254) NOT NULL,
  `total_harga` int(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_order`
--

INSERT INTO `detail_order` (`food_id`, `order_id`, `jumlah_pesan`, `total_harga`) VALUES
('Food-023', 'Order-001', 1, 34900),
('Food-023', 'Order-002', 1, 34900),
('Food-023', 'Order-003', 1, 34900),
('Food-023', 'Order-004', 1, 34900),
('Food-011', 'Order-006', 4, 124000),
('Food-003', 'Order-008', 1, 24500),
('Food-002', 'Order-011', 1, 22000),
('Food-005', 'Order-012', 1, 32500),
('Food-003', 'Order-013', 1, 24500),
('Food-004', 'Order-014', 1, 21500),
('Food-003', 'Order-015', 7, 171500),
('Food-003', 'Order-016', 7, 171500),
('Food-002', 'Order-018', 1, 22000),
('Food-003', 'Order-018', 1, 24500),
('Food-001', 'Order-019', 1, 27000),
('Food-002', 'Order-019', 1, 22000),
('Food-003', 'Order-019', 1, 24500),
('Food-004', 'Order-020', 1, 21500),
('Food-002', 'Order-020', 1, 22000),
('Food-017', 'Order-020', 1, 23000),
('Food-001', 'Order-021', 3, 81000),
('Food-009', 'Order-021', 5, 130000),
('Food-001', 'Order-022', 6, 168000),
('Food-002', 'Order-023', 1, 22000),
('Food-001', 'Order-024', 5, 140000),
('Food-007', 'Order-025', 4, 70000),
('Food-009', 'Order-025', 2, 52000);

--
-- Trigger `detail_order`
--
DELIMITER $$
CREATE TRIGGER `transaksi` AFTER INSERT ON `detail_order` FOR EACH ROW BEGIN
UPDATE food_item SET jumlah = jumlah - NEW.jumlah_pesan WHERE food_id = NEW.food_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `food_item`
--

CREATE TABLE `food_item` (
  `food_id` varchar(254) NOT NULL,
  `nama` varchar(254) NOT NULL,
  `jumlah` int(254) NOT NULL,
  `harga` int(254) NOT NULL,
  `id_kategori` varchar(254) NOT NULL,
  `foto` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `food_item`
--

INSERT INTO `food_item` (`food_id`, `nama`, `jumlah`, `harga`, `id_kategori`, `foto`) VALUES
('Food-001', 'Egg and Cheese Muffin', 55, 28000, 'K-001', '678113267_egg and cheese muffin.png'),
('Food-002', 'Chicken Muffin', 29, 22000, 'K-001', '1738705035_chicken muffin.png'),
('Food-003', 'Sausage McMuffin with Egg', 22, 24500, 'K-001', '504258521_sausage mcmuffin with egg.png'),
('Food-004', 'Egg McMuffin', 38, 21500, 'K-001', '782160324_edd mcMudffin.png'),
('Food-005', 'Sausage McMuffin', 39, 32500, 'K-001', '1959981613_Sausage McMuffin.png'),
('Food-006', 'Sausage Warp', 50, 41500, 'K-001', '330876493_sausage wrap.png'),
('Food-007', 'Hotcakes 3pcs.', 41, 17500, 'K-001', '179848440_hotcakes 3pcs.png'),
('Food-008', 'Breakfast Warp', 10, 30000, 'K-001', '1253308084_breakfast warp.png'),
('Food-009', 'Bubur Ayam McD', 33, 26000, 'K-001', '837789923_bubur ayam mcd.png'),
('Food-010', 'Nasi Uduk McD', 3, 21500, 'K-001', '2004657581_nasi uduk mcd.png'),
('Food-011', 'Big Breakfast', 30, 31000, 'K-001', '1465659429_big breakfast.png'),
('Food-012', 'Beef Alfredo Burger', 65, 45000, 'K-002', '736122012_Beef Alfredo Burger.png'),
('Food-013', 'Beef Burger Deluxe', 23, 43000, 'K-002', '1179981358_Beef Burger Deluxe.png'),
('Food-014', 'Big Mac', 42, 43000, 'K-002', '1937402124_Big Mac.png'),
('Food-015', 'Cheeseburger Deluxe', 42, 25000, 'K-002', '323092723_Cheeseburger Deluxe.png'),
('Food-016', 'Cheeseburger with Egg', 23, 34500, 'K-002', '1632153936_Cheeseburger with Egg.png'),
('Food-017', 'Cheeseburger', 44, 23000, 'K-002', '198015656_Cheeseburger.png'),
('Food-018', 'Double Chesseburger', 40, 36000, 'K-002', '2089639240_Double Chesseburger.png'),
('Food-019', 'Triple Burger with Cheese', 40, 49000, 'K-002', '1766639136_Triple Burger with Cheese.png'),
('Food-020', 'Chicken Burger Deluxe', 40, 32000, 'K-003', '886842132_Chicken Burger Deluxe.png'),
('Food-021', 'Chicken Burger', 40, 23000, 'K-003', '2099350926_Chicken Burger.png'),
('Food-022', 'Chicken Figers', 34, 12000, 'K-003', '245060184_Chicken Figers.png'),
('Food-023', 'Chicken Snack Wrap', 60, 34900, 'K-003', '603714420_Chicken Snack Wrao.png'),
('Food-024', 'McChicken', 0, 25000, 'K-003', '784663127_McChicken.png'),
('Food-025', 'McNuggets', 89, 17000, 'K-003', '1959361429_McNuggets.png'),
('Food-026', 'McSpicy Alfredo Burger', 23, 34500, 'K-003', '490429756_McSpicy Alfredo Burger.png'),
('Food-027', 'McSpicy', 42, 23000, 'K-003', '663651117_McSpicy.png'),
('Food-029', 'PaMer 5 Ayam Gulai McD', 12, 43000, 'K-003', '471484204_PaMer 5 Ayam Gulai McD.png'),
('Food-030', 'PaNas 2 Ayam Gulai McD', 34, 39000, 'K-003', '1795992447_PaNas 2 Ayam Gulai McD.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` varchar(254) NOT NULL,
  `kategori` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
('K-001', 'Sarapan Pagi'),
('K-002', 'Daging Sapi'),
('K-003', 'Ayam'),
('K-004', 'Ikan'),
('K-005', 'Minuman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_food`
--

CREATE TABLE `order_food` (
  `order_id` varchar(254) NOT NULL,
  `tanggal` date NOT NULL,
  `id_pegawai` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `order_food`
--

INSERT INTO `order_food` (`order_id`, `tanggal`, `id_pegawai`) VALUES
('Order-001', '2022-01-11', 'karyawan01'),
('Order-002', '2022-01-11', 'karyawan01'),
('Order-003', '2022-01-11', 'karyawan01'),
('Order-004', '2022-01-11', 'karyawan01'),
('Order-005', '2022-01-11', 'karyawan01'),
('Order-006', '2022-01-11', 'karyawan01'),
('Order-007', '2022-01-11', 'karyawan01'),
('Order-008', '2022-01-11', 'karyawan01'),
('Order-009', '2022-01-11', 'karyawan01'),
('Order-010', '2022-01-11', 'karyawan01'),
('Order-011', '2022-01-11', 'karyawan01'),
('Order-012', '2022-01-11', 'karyawan01'),
('Order-013', '2022-01-11', 'karyawan01'),
('Order-014', '2022-01-11', 'karyawan01'),
('Order-015', '2022-01-11', 'karyawan01'),
('Order-016', '2022-01-11', 'karyawan01'),
('Order-018', '2022-01-11', 'karyawan01'),
('Order-019', '2022-01-11', 'karyawan01'),
('Order-020', '2022-01-11', 'karyawan01'),
('Order-021', '2022-01-12', 'karyawan01'),
('Order-022', '2022-01-13', 'karyawan01'),
('Order-023', '2022-01-13', 'karyawan01'),
('Order-024', '2022-01-13', 'karyawan01'),
('Order-025', '2022-01-13', 'karyawan01');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `cache_beli`
--
ALTER TABLE `cache_beli`
  ADD PRIMARY KEY (`id_cache`);

--
-- Indeks untuk tabel `detail_order`
--
ALTER TABLE `detail_order`
  ADD KEY `food_id` (`food_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indeks untuk tabel `food_item`
--
ALTER TABLE `food_item`
  ADD PRIMARY KEY (`food_id`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `order_food`
--
ALTER TABLE `order_food`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cache_beli`
--
ALTER TABLE `cache_beli`
  MODIFY `id_cache` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_order`
--
ALTER TABLE `detail_order`
  ADD CONSTRAINT `detail_order_ibfk_1` FOREIGN KEY (`food_id`) REFERENCES `food_item` (`food_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_order_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `order_food` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `food_item`
--
ALTER TABLE `food_item`
  ADD CONSTRAINT `food_item_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order_food`
--
ALTER TABLE `order_food`
  ADD CONSTRAINT `order_food_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `account` (`ID_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
