-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 03, 2019 at 06:13 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `president_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_bank` int(11) NOT NULL,
  `amount` double NOT NULL,
  `type` enum('d','c') NOT NULL COMMENT 'Debit, Credit',
  `note` text,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `id_user`, `id_bank`, `amount`, `type`, `note`, `created`) VALUES
(1, 3, 1, 1000000, 'c', '', '2019-03-19 18:45:16'),
(2, 3, 1, 2000000, 'c', 'Masuk', '2019-03-19 18:29:47'),
(3, 3, 1, 3000000, 'c', 'Masuk', '2019-03-19 18:29:47');

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `street` char(50) NOT NULL,
  `disctrict` char(50) NOT NULL,
  `region` char(50) NOT NULL,
  `province` char(50) NOT NULL,
  `country` char(50) NOT NULL,
  `zipCode` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `street`, `disctrict`, `region`, `province`, `country`, `zipCode`) VALUES
(1, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `id_address` int(11) NOT NULL DEFAULT '1',
  `zip_code` char(5) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `code`, `id_address`, `zip_code`, `created`, `updated`) VALUES
(1, '101', 1, '10000', '2019-03-14 20:14:01', '2019-03-18 06:16:27'),
(2, '102', 1, '11000', '2019-03-14 20:14:01', '2019-03-18 06:16:27'),
(3, '103', 1, '12000', '2019-03-14 20:14:01', '2019-03-18 06:16:27'),
(4, '104', 1, '13000', '2019-03-14 20:14:01', '2019-03-18 06:16:27'),
(5, '105', 1, '14000', '2019-03-14 20:14:01', '2019-03-18 06:16:27');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int(11) NOT NULL,
  `id_publisher` int(11) NOT NULL,
  `serial` char(10) NOT NULL,
  `amount` double NOT NULL,
  `due_date` date NOT NULL,
  `status` enum('Debt','Paid') NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `id_publisher`, `serial`, `amount`, `due_date`, `status`, `created`, `updated`) VALUES
(1, 8, '2099', 20000000, '2019-04-30', 'Debt', '2019-03-16 08:13:06', '2019-03-16 08:13:06');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` char(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `card_number` char(10) NOT NULL,
  `pin` char(255) NOT NULL,
  `id_address` int(11) DEFAULT '1',
  `type` tinyint(3) DEFAULT '100',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `id_user`, `name`, `date_of_birth`, `card_number`, `pin`, `id_address`, `type`, `created`, `updated`) VALUES
(1, 11, 'elsha pardosi', '2019-03-10', '9999999999', '123456', 1, 0, '2019-03-16 06:03:21', '2019-03-18 05:05:59'),
(2, 11, 'elsha pardosi', '2019-03-10', '123444444', '123445', 1, 0, '2019-03-16 06:12:03', '2019-03-18 05:06:04');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `id_account` int(11) NOT NULL,
  `id_receiver` int(11) NOT NULL,
  `code` int(3) NOT NULL COMMENT '(1xx: Deposit)(2xx: Withdraw)(3xx: Transfer)(4xx: Pay)(5xx: Receive)',
  `serial` char(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `id_account`, `id_receiver`, `code`, `serial`) VALUES
(1, 1, 3, 100, '1234567'),
(6, 2, 3, 100, '0000002'),
(7, 3, 3, 100, '0000003');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` char(100) NOT NULL,
  `password` char(255) NOT NULL,
  `token` char(255) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `token`, `created`, `updated`) VALUES
(1, 'admin@mail.com', 'admin@mail.com', 'admin@mail.com', '2019-03-14 20:06:27', '2019-03-14 20:06:27'),
(2, 'adam@mail.com', 'adam@mail.com', 'adam@mail.com', '2019-03-14 20:06:27', '2019-03-14 20:06:27'),
(3, 'bil@mail.com', 'bil@mail.com', 'bil@mail.com', '2019-03-14 20:06:27', '2019-03-14 20:06:27'),
(4, 'carlie@mail.com', 'carlie@mail.com', 'carlie@mail.com', '2019-03-14 20:06:27', '2019-03-14 20:06:27'),
(5, 'dessy@mail.com', 'dessy@mail.com', 'dessy@mail.com', '2019-03-14 20:06:27', '2019-03-14 20:06:27'),
(6, 'starbuck@merchant.com', 'starbuck@merchant.com', 'starbuck@merchant.com', '2019-03-14 20:09:18', '2019-03-14 20:09:18'),
(7, 'mcd@merchant.com', 'mcd@merchant.com', 'mcd@merchant.com', '2019-03-14 20:09:18', '2019-03-14 20:09:18'),
(8, 'm2m@merchant.com', 'm2m@merchant.com', 'm2m@merchant.com', '2019-03-14 20:09:18', '2019-03-14 20:09:18'),
(9, 'prestige@merchant', 'prestige@merchant', 'prestige@merchant', '2019-03-14 20:09:18', '2019-03-14 20:09:18'),
(10, 'laundry@merchant.com', 'laundry@merchant.com', 'laundry@merchant.com', '2019-03-14 20:09:18', '2019-03-14 20:09:18'),
(11, 'elshapardosi2@gmail.com', '1', '1', '2019-03-16 05:59:39', '2019-03-16 05:59:39'),
(12, 'jonathan@gmail.com', 'fc5e038d38a57032085441e7fe7010b0', '76b94be4664b5edcba48ff0f66f621f6', '2019-03-19 19:33:20', '2019-03-19 19:33:20'),
(13, 'icha@gmail.com', 'fc5e038d38a57032085441e7fe7010b0', 'efe55493cbb67eb52c09e0fb42612e0a', '2019-03-19 21:03:20', '2019-03-19 21:03:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bank` (`id_bank`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `id_address` (`id_address`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `serial` (`serial`),
  ADD KEY `id_publisher` (`id_publisher`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_address` (`id_address`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `serial` (`serial`),
  ADD KEY `id_user` (`id_account`),
  ADD KEY `id_reference` (`id_receiver`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`id_bank`) REFERENCES `banks` (`id`),
  ADD CONSTRAINT `accounts_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `banks`
--
ALTER TABLE `banks`
  ADD CONSTRAINT `banks_ibfk_1` FOREIGN KEY (`id_address`) REFERENCES `addresses` (`id`);

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`id_publisher`) REFERENCES `users` (`id`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `customers_ibfk_2` FOREIGN KEY (`id_address`) REFERENCES `addresses` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`id_account`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`id_receiver`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
