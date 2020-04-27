-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Apr 27, 2020 at 01:53 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bakman`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(10) DEFAULT NULL,
  `order_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `total` decimal(8,2) DEFAULT NULL,
  `status` enum('waiting','delivered','canceled') NOT NULL DEFAULT 'waiting',
  `paid` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `orderID` int(10) DEFAULT NULL,
  `productID` int(11) DEFAULT NULL,
  `qty` int(3) DEFAULT NULL,
  `sub_total` decimal(8,2) DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `image`, `price`) VALUES
(876, 'vanilla cream', 'vanilla cream.jpg', '5.00'),
(875, 'Puff', 'puff.jpg', '2.00'),
(877, 'cardamon', 'cardamon.jpg', '4.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `level` enum('admin','staff') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'staff',
  `email` varchar(255) NOT NULL,
  `password` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `level`, `email`, `password`, `created_at`) VALUES
(1, 'super admin', 'admin', 'admin@admin.com', '$2y$10$5HT0FrVY198Gzw.M7KC0Duqbq7I0Yn8OOy.FhepVnEa9WY4nTdLfm', '2020-04-25 21:55:48'),
(3, 'staff 1', 'staff', 'staff@mail.com', '$2y$10$bykUvjd5oiQyKFKEqWgCEenCqUQfs/QkkuyO0/8EPI4H2WMKrd3me', '2020-04-26 10:21:34');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
