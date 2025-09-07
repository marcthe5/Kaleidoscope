-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 07, 2025 at 07:42 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kaleidoscope`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `name`, `username`, `password`) VALUES
(1, 'Marc Casoco', 'marccasoco', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(255) DEFAULT NULL,
  `userID` int(11) NOT NULL,
  `productID` int(6) DEFAULT NULL,
  `productName` varchar(50) DEFAULT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `productImage` varchar(255) DEFAULT NULL,
  `productQuantity` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productID` int(6) UNSIGNED NOT NULL,
  `productName` varchar(50) DEFAULT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `productImage` varchar(255) DEFAULT NULL,
  `productQuantity` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `productName`, `price`, `productImage`, `productQuantity`) VALUES
(2, 'Royal Salute', 30000.00, '../uploaded_img/royalsalute.png', 100),
(4, 'Dom Perignon', 55000.00, '../uploaded_img/domperignon.png', 350),
(180194, 'Henessy XO', 45000.00, '../uploaded_img/180194_henessyxo.png', 250),
(417094, 'product1', 15000.00, '../uploaded_img/417094_ballantines30.png', 250);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_history`
--

CREATE TABLE `purchase_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `products` varchar(255) DEFAULT NULL,
  `productImage` varchar(255) DEFAULT NULL,
  `quantity` bigint(20) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `placed_on` varchar(255) DEFAULT NULL,
  `order_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_history`
--

INSERT INTO `purchase_history` (`id`, `user_id`, `firstname`, `email`, `username`, `address`, `products`, `productImage`, `quantity`, `total_price`, `payment_method`, `placed_on`, `order_status`) VALUES
(1, 1, 'Marc', 'test1@gmail.com', 'test1', 'Lapu-Lapu City', 'mac', '../uploaded_img/henessyxo.png', 10, 5000000.00, 'Cash on Delivery', '2024-01-25 14:20:49', 'Cancel'),
(2, 1, 'Marc', 'test1@gmail.com', 'test1', 'Lapu-Lapu City', 'mj', '../uploaded_img/ballantines30.png', 1, 25000.00, 'Cash on Delivery', '2024-01-25 14:44:29', 'Pending'),
(3, 1, 'Marc', 'test1@gmail.com', 'test1', 'Lapu-Lapu City', 'Dom Perignon', '../uploaded_img/domperignon.png', 15, 825000.00, 'BDO', '2024-01-26 09:04:23', 'Pending'),
(4, 10, 'Marc', 'marcmarc@gmail.com', 'user', 'Lapu-Lapu City', 'Royal Salute', '../uploaded_img/royalsalute.png', 5, 110000.00, 'BDO', '2024-01-26 09:38:14', 'Pending'),
(5, 10, 'Marc', 'marcmarc@gmail.com', 'user', 'Lapu-Lapu City', 'Henessy XO', '../uploaded_img/henessyxo.png', 251, 12550000.00, 'Cash on Delivery', '2024-01-26 09:47:51', 'Cancel'),
(6, 10, 'Marc', 'marcmarc@gmail.com', 'user', 'Lapu-Lapu City', 'Royal Salute', '../uploaded_img/royalsalute.png', 1, 30000.00, 'BDO', '2024-05-28 18:22:44', 'Delivered'),
(7, 10, 'Marc', 'marcmarc@gmail.com', 'user', 'Lapu-Lapu City', 'Royal Salute', '../uploaded_img/royalsalute.png', 20, 600000.00, 'Metrobank', '2024-05-28 18:23:39', 'Cancel'),
(8, 11, 'marc', 'marc_cf@yahoo.com', 'marc', 'Lapu-Lapu City', 'Royal Salute', '../uploaded_img/royalsalute.png', 1, 30000.00, 'BDO', '2024-06-12 20:02:47', 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `productID` int(11) NOT NULL,
  `productName` varchar(100) DEFAULT NULL,
  `productPrice` decimal(12,2) DEFAULT NULL,
  `productImage` varchar(255) DEFAULT NULL,
  `productQuantity` int(255) DEFAULT NULL,
  `removed_date` date DEFAULT NULL,
  `removed_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`productID`, `productName`, `productPrice`, `productImage`, `productQuantity`, `removed_date`, `removed_time`) VALUES
(1, 'test1', 21000.00, '../uploaded_img/jagermeister.png', 124, NULL, NULL),
(18, 'boyzone', 2555.00, '../uploaded_img/domperignon.png', 123, NULL, NULL),
(18, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 't', 12.00, '../uploaded_img/domperignon.png', 2, NULL, NULL),
(20, 'Jagermeister', 1234.00, '../uploaded_img/royalsalute.png', 123, NULL, NULL),
(11, 'Henessy XO', 35000.00, '../uploaded_img/henessyxo.png', 500, NULL, NULL),
(1, 'Henessy XO', 50000.00, '../uploaded_img/henessyxo.png', -1, NULL, NULL),
(44, 'Dom Perignon', 50000.00, '../uploaded_img/44a0ec_domperignon.png', 100, '2024-06-04', '14:31:31'),
(3, 'test34', 567.00, '../uploaded_img/chivas18.png', 300, '2024-06-11', '14:47:28'),
(22, 'a', 1.00, '../uploaded_img/chivas18.png', 2, '2024-06-11', '14:47:44'),
(5, 'Jagermeister', 21999.00, '../uploaded_img/jagermeister.png', 299, '2024-06-11', '15:02:35'),
(669876, 'Ballantines 30', 250000.00, '../uploaded_img/669876_table (1).pdf', 150, '2024-06-13', '12:45:10');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `age` int(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `firstname`, `email`, `username`, `password`, `age`) VALUES
(1, 'Marc', 'test1@gmail.com', 'test1', 'test1', NULL),
(9, 'Pat', 'patrick123@gmail.com', 'pat', 'pat', NULL),
(10, 'Marc', 'marcmarc@gmail.com', 'user', 'user123', NULL),
(11, 'marc', 'marc_cf@yahoo.com', 'marc', 'marc', NULL),
(17, 'Alpha', 'Alpha@gmail.com', 'alpha123', 'user123', 21);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `purchase_history`
--
ALTER TABLE `purchase_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase_history`
--
ALTER TABLE `purchase_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchase_history`
--
ALTER TABLE `purchase_history`
  ADD CONSTRAINT `purchase_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
