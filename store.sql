-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Apr 2024 pada 15.51
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tyty`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `items`
--

INSERT INTO `items` (`id`, `name`, `price`, `image`) VALUES
(1, 'Tulip/pcs', 33000, 'tulip.jpeg'),
(2, 'Rose/pcs', 12000, 'rose.jpeg'),
(3, 'Lily/pcs', 15000, 'lily.jpeg'),
(4, 'Aster/pcs', 10000, 'aster.jpeg'),
(5, 'Cascade Bouquet', 162000, 'cascade.jpeg'),
(6, 'Round Bouquet', 190000, 'round.jpeg'),
(7, 'Hand-Tied Bouquet', 250000, 'handtied.jpeg'),
(8, 'Pageant Bouquet', 285000, 'pageant.jpeg'),
(9, 'Snickers/pcs', 14000, 'snickers.jpeg'),
(10, 'Mini Doll/pcs', 35000, 'doll.jpeg'),
(11, 'Candy/pcs', 25000, 'candy.jpeg'),
(12, 'Chocolate Ferrero Rocher/box', 110000, 'coklat.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `contact`, `city`, `address`, `is_admin`) VALUES
(7, 'aristy', 'aristy@gmail.com', '615900ded55a23bb9cfdcb00708602a1', '8314224940', 'Samarinda', 'Loa Janan', 2),
(10, 'novan', 'novan@gmail.com', '1f73402c644002a7ea3c9532e8ba4139', '0816392625', 'Balikpapan', 'jalannnnnnn', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_item`
--

CREATE TABLE `user_item` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` enum('Added to cart','Confirmed','','') NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user_item`
--

INSERT INTO `user_item` (`id`, `user_id`, `item_id`, `quantity`, `status`, `date_time`) VALUES
(7, 7, 3, 0, 'Confirmed', '2024-04-04 16:33:15'),
(11, 7, 1, 0, 'Confirmed', '2024-04-04 20:30:37'),
(12, 7, 6, 0, 'Confirmed', '2024-04-04 20:32:02'),
(13, 7, 2, 0, 'Confirmed', '2024-04-04 20:51:57'),
(15, 7, 7, 0, 'Confirmed', '2024-04-04 21:00:12'),
(16, 7, 8, 0, 'Confirmed', '2024-04-04 21:00:14'),
(17, 7, 5, 0, 'Confirmed', '2024-04-04 21:00:18'),
(18, 7, 1, 0, 'Confirmed', '2024-04-05 10:23:59'),
(19, 7, 2, 0, 'Confirmed', '2024-04-05 10:24:01'),
(20, 7, 7, 0, 'Confirmed', '2024-04-05 10:24:05'),
(21, 7, 1, 0, 'Confirmed', '2024-04-05 14:16:59'),
(22, 7, 2, 0, 'Confirmed', '2024-04-05 14:17:01'),
(30, 7, 2, 4, 'Confirmed', '2024-04-16 21:02:30'),
(31, 7, 3, 1, 'Confirmed', '2024-04-16 21:12:18'),
(32, 7, 1, 3, 'Confirmed', '2024-04-16 21:14:22'),
(33, 7, 3, 1, 'Confirmed', '2024-04-16 21:50:03');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_item`
--
ALTER TABLE `user_item`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `user_item`
--
ALTER TABLE `user_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
