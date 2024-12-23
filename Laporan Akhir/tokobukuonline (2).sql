-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2024 at 06:08 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokobukuonline`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `KodeBuku` int(11) NOT NULL,
  `ISBN` varchar(20) NOT NULL,
  `Judul` varchar(255) NOT NULL,
  `Pengarang` varchar(100) NOT NULL,
  `Harga` decimal(10,2) NOT NULL,
  `Stok` int(11) NOT NULL,
  `Kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`KodeBuku`, `ISBN`, `Judul`, `Pengarang`, `Harga`, `Stok`, `Kategori`) VALUES
(1, '978-0-13-468599-1', 'Introduction to Algorithms', 'Thomas H. Cormen', 120000.00, 10, 'Sains'),
(2, '978-0-262-03384-8', 'Artificial Intelligence: A Modern Approach', 'Stuart Russell', 150000.00, 8, 'Sains'),
(3, '978-0-452-28423-4', 'The Great Gatsby', 'F. Scott Fitzgerald', 95000.00, 20, 'Fiksi'),
(4, '978-0-394-80001-9', '1984', 'George Orwell', 85000.00, 25, 'Fiksi'),
(5, '978-1-4028-9462-6', 'The Catcher in the Rye', 'J.D. Salinger', 90000.00, 15, 'Fiksi'),
(6, '978-1-56619-909-4', 'The Hobbit', 'J.R.R. Tolkien', 105000.00, 12, 'Fiksi'),
(7, '978-0-307-27702-7', 'The Lean Startup', 'Eric Ries', 120000.00, 18, 'Non-Fiksi'),
(8, '978-0-385-52709-9', 'Becoming', 'Michelle Obama', 130000.00, 30, 'Biografi'),
(9, '978-1-4767-9402-1', 'Educated', 'Tara Westover', 100000.00, 22, 'Biografi'),
(10, '978-1-4088-5655-2', 'The Girl on the Train', 'Paula Hawkins', 95000.00, 35, 'Fiksi'),
(11, '978-1-56619-609-3', 'Batman: The Killing Joke', 'Alan Moore', 75000.00, 18, 'Komik'),
(12, '978-0-307-26113-8', 'Watchmen', 'Alan Moore', 95000.00, 14, 'Komik'),
(13, '978-1-59240-757-9', 'Spider-Man: The Ultimate Guide', 'Tom DeFalco', 85000.00, 20, 'Komik'),
(14, '978-0-307-89170-2', 'The Subtle Art of Not Giving a F*ck', 'Mark Manson', 100000.00, 30, 'Non-Fiksi'),
(15, '978-0-14-312774-1', 'Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', 120000.00, 40, 'Non-Fiksi');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `IDTransaksi` int(11) NOT NULL,
  `Tanggal` datetime DEFAULT current_timestamp(),
  `IDUser` int(11) NOT NULL,
  `KodeBuku` int(11) NOT NULL,
  `Judul` varchar(255) NOT NULL,
  `Harga` decimal(10,2) NOT NULL,
  `Jumlah` int(11) NOT NULL,
  `Subtotal` decimal(10,2) NOT NULL,
  `Total` decimal(10,2) NOT NULL,
  `Status` enum('diproses','selesai','dibatalkan','') NOT NULL,
  `bukti_transfer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Role` enum('admin','customer') NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Username`, `Password`, `Nama`, `Role`) VALUES
(1, 'admin01', '$2y$10$SV0NJJ1G/PjBNfmPXFUiqu1dzhe1V/6eJ8Uz89.dEPXVajB6.Z09.', 'Admin One', 'admin'),
(2, 'admin02', 'password123', 'Admin Two', 'admin'),
(3, 'admin03', 'password123', 'Admin Three', 'admin'),
(4, 'customer01', 'password123', 'Customer One', 'customer'),
(5, 'customer02', 'password123', 'Customer Two', 'customer'),
(6, 'customer03', 'password123', 'Customer Three', 'customer'),
(7, 'customer04', 'password123', 'Customer Four', 'customer'),
(8, 'customer05', 'password123', 'Customer Five', 'customer'),
(9, 'customer06', 'password123', 'Customer Six', 'customer'),
(10, 'customer07', 'password123', 'Customer Seven', 'customer'),
(11, 'admin', '$2y$10$wBr0BvqbXDkNXTe63eFXR.lNdGrlq78vr7.ykCYlWFuppbWZJ9uKy', 'admin', 'admin'),
(12, 'akukamu', '$2y$10$P.UbUa19uAieOKmYVV1iGOLdVkrgEL5nVOZTyhvkPt6RG5COHR8bu', 'kamu siapa', 'admin'),
(13, 'Aaaa', '$2y$10$pzpxbgST.en8ip3yhKBlN.mWO1zRfe7S2uYI80IH7NW5.Tanqaj3.', 'cust', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`KodeBuku`),
  ADD UNIQUE KEY `ISBN` (`ISBN`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`IDTransaksi`,`KodeBuku`),
  ADD KEY `IDUser` (`IDUser`),
  ADD KEY `KodeBuku` (`KodeBuku`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `KodeBuku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `IDTransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`IDUser`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`KodeBuku`) REFERENCES `buku` (`KodeBuku`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
