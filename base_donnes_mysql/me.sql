-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2024 at 02:44 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `me`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nom`, `prenom`, `photo`) VALUES
(1, 'talebmine62gmail.com', 'i19405', NULL, NULL, NULL),
(2, 'taleb@gmail.com', '12345', NULL, NULL, NULL),
(3, 'sidaty', '2525', 'Sidaty', 'mohamed mahmoud', 'uploads/1_1714444069.png\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_photo` varchar(255) DEFAULT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `category_code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_photo`, `category_name`, `category_code`) VALUES
(1, 'uploads/1_1714444069.png', 'laptop', '33dpp'),
(3, 'uploads/6.png', 'mobile', 'w2pp'),
(5, 'uploads/ftp.png', 'car', 'w22'),
(6, 'uploads/netstat.png', 'fruit', 'P123'),
(7, 'uploads/OIP.jpeg', 'voiture', 'l123');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `customer_photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `phone`, `address`, `customer_photo`) VALUES
(4, 'jelel', 'dd', 'ddd', 'uploads/tcpdump.png'),
(11, 'well ebnu', '23234544', 'rfd', 'uploads/iptables3.png'),
(12, 'mou56ar', '2222222', 'nktt', 'uploads/5.png'),
(13, 'sidaty med', '144444', 'l9aure', 'uploads/getmac.png'),
(14, '7med', '12345', 'ddd', 'uploads/6.png'),
(16, 'oussame', '222222', 'tigent', 'uploads/iptables.png'),
(17, 'rty', '3566667', 'rt', 'uploads/arp.png'),
(18, '9lahoum', '3456789', 'mktt', 'uploads/3.png'),
(19, '5aled', '1234', 'bou7didde', 'uploads/tx.jpg'),
(20, 'sisco', '27272727', 'mktt', 'uploads/Mohamed EL hassen .jpg');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id_invoice` int(11) NOT NULL,
  `invoice_date` date NOT NULL,
  `total` double NOT NULL,
  `customer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id_invoice`, `invoice_date`, `total`, `customer_id`) VALUES
(14, '2024-05-01', 3702, 4),
(16, '2024-05-01', 27370, 4),
(20, '2024-05-01', 59, 11),
(23, '2024-05-02', 11106, 4),
(26, '2024-05-02', 33318, 4),
(31, '2024-05-02', 300000, 13),
(35, '2024-05-11', 8788, 16),
(36, '2024-05-11', 62627, 11),
(37, '2024-06-05', 60059, 18),
(43, '2024-06-06', 7000109, 19),
(45, '2024-06-06', 540000, 11),
(48, '2024-06-06', 1100000, 12),
(49, '2024-07-08', 5510100, 19),
(50, '2024-09-03', 4047404, 20);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_products`
--

CREATE TABLE `invoice_products` (
  `id_product` int(11) NOT NULL,
  `id` varchar(50) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price_of_unit` double DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `qnt` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_products`
--

INSERT INTO `invoice_products` (`id_product`, `id`, `name`, `price_of_unit`, `total_price`, `qnt`) VALUES
(2, '10', 'tyota', 1234, 2468, 2),
(3, '10', 'del', 222, 222, 1),
(4, '11', 'tyota', 1234, 2468, 2),
(5, '11', 'del', 222, 444, 2),
(6, '12', 'del', 222, 2220, 10),
(7, '13', 'tyota', 1234, 2468, 2),
(8, '13', 'del', 222, 222, 1),
(9, '14', 'tyota', 1234, 3702, 3),
(10, '15', 'del', 222, 222, 1),
(11, '15', 'tyota', 1234, 27148, 22),
(12, '20', 'phhone2', 59, 59, 1),
(13, '23', 'tyota', 1234, 11106, 9),
(14, '26', 'tyota', 1234, 33318, 27),
(15, '27', 'banan', 100, 300, 3),
(16, '31', 'hp1', 60000, 300000, 5),
(17, '32', 'hp3', 50, 400, 8),
(18, '32', 'phhone2', 59, 59, 1),
(19, '32', 'hp1', 60000, 60000, 1),
(20, '32', 'tyota', 1234, 1234, 1),
(21, '34', 'tyota', 1234, 8638, 7),
(22, '34', 'phhone2', 59, 118, 2),
(23, '34', 'hp1', 60000, 60000, 1),
(24, '34', 'hp3', 50, 50, 1),
(25, '35', 'tyota', 1234, 8638, 7),
(26, '35', 'delos', 50, 150, 3),
(27, '36', 'tyota', 1234, 2468, 2),
(28, '36', 'phhone2', 59, 59, 1),
(29, '36', 'hp1', 60000, 60000, 1),
(30, '36', 'hp3', 50, 50, 1),
(31, '36', 'delos', 50, 50, 1),
(32, '37', 'hp1', 60000, 60000, 1),
(33, '37', 'phhone2', 59, 59, 1),
(34, '43', 'hp3', 50, 50, 1),
(35, '43', 'phhone2', 59, 59, 1),
(36, '43', 'iphone15', 500000, 1500000, 3),
(37, '43', 'range', 5500000, 5500000, 1),
(38, '46', 'tx', 10000, 10000, 1),
(39, '46', 'range', 5500000, 5500000, 1),
(40, '46', 'iphone15', 500000, 500000, 1),
(41, '46', 'A14', 40000, 40000, 1),
(42, '48', 'iphone15', 500000, 1000000, 2),
(43, '48', 'tx', 10000, 20000, 2),
(44, '48', 'A14', 40000, 80000, 2),
(45, '49', 'tx', 10000, 10000, 1),
(46, '49', 'banane', 100, 100, 1),
(47, '49', 'range', 5500000, 5500000, 1),
(48, '50', 'tyota', 1234, 7404, 6),
(49, '50', 'tx', 10000, 20000, 2),
(50, '50', 'iphone15', 500000, 1500000, 3),
(51, '50', 'tx', 10000, 20000, 2),
(52, '50', 'A15', 500000, 2500000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `photo`, `product_name`, `category_id`, `price`, `qty`) VALUES
(8, 'uploads/8_1717670189.jpg', 'tyota', 5, '1234.00', 23),
(17, 'uploads/tx.jpg', 'tx', 5, '10000.00', 0),
(18, 'uploads/range.jpg', 'range', 7, '5500000.00', 0),
(19, 'uploads/iphone.jpg', 'iphone15', 3, '500000.00', 1),
(20, 'uploads/v1.jpg', 'reno', 5, '4000000.00', 10),
(23, 'uploads/A14.jpg', 'A14', 3, '40000.00', 37),
(24, 'uploads/to.jpg', 'tx', 5, '10000.00', 96),
(25, 'uploads/Taleb El moukhtar.jpg', 'A15', 3, '500000.00', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id_invoice`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `invoice_products`
--
ALTER TABLE `invoice_products`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id_invoice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `invoice_products`
--
ALTER TABLE `invoice_products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
