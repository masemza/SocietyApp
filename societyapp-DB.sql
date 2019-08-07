-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2019 at 07:56 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `society`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', '$2y$12$81096039005d2f785fe92uoqTDSm2nXDsBCL.d3veRSYdy6FD1s3u'),
(2, 'tiisetsojohnmasemola@yahoo.com', '$2y$12$58969717715d362b01748u9p9j.xlYTC.yfnyTIX2WgF16DIzTjQO'),
(3, 'mogano@gmail.com', '$2y$12$95278411665d484a1fbf1O/hzoAEQPUPMjhJw.ofwpSd9pYavgHWS');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expenses_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `expenses_captured` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `invoice_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `description`, `name`, `amount`, `invoice_date`) VALUES
(2, 'This money is for transport and food', 'John Masemola', 5800, '2019-07-30'),
(3, 'This money is for transport and food', 'John', 1500, '2019-07-31'),
(4, 'this money is for church building', 'Mathabo', 10000, '2019-08-03');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL,
  `society_id` int(11) NOT NULL,
  `society_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact_num` varchar(10) NOT NULL,
  `id_number` bigint(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `society_id`, `society_name`, `first_name`, `last_name`, `gender`, `contact_num`, `id_number`) VALUES
(8, 1, 'Trend', 'Mathabo', 'Thobejane', 'Female', '0715285963', 8596251478523),
(9, 2, 'Mosotho', 'Pholosho', 'Matabane', 'Male', '0', 9685326598741),
(14, 1, 'Trend', 'Arthur', 'Makofane', 'Male', '0', 9869695959896),
(15, 1, 'Trend', 'Kgotso', 'Mafane', 'Male', '0', 7485874857859),
(16, 1, 'Trend', 'Mathabo', 'Thobetjane', 'Female', '0', 1526152615666),
(19, 10, 'Moloto', 'Kwena', 'Moloto', 'Male', '0793359595', 1526352415222),
(20, 11, 'Selemo', 'Mathabo', 'Matabane', 'Female', '0725858585', 8263597456321),
(21, 12, 'Morudu', 'Thabang', 'Morudu', 'Male', '0765241526', 2514253695888),
(22, 13, 'Morule', 'Bokamoso', 'Masemola', 'Female', '0793359593', 9695896431250),
(23, 14, 'Mahlogonolo', 'Oupa', 'Mahlogonolo', 'Male', '0793359595', 125478963222),
(24, 14, 'Mahlogonolo', 'Enicca', 'Kgasago', 'Male', '0715824715', 9685748596555),
(25, 11, 'Selemo', 'Bokamoso', 'Moloko', 'Female', '0715896524', 7458745874587),
(26, 15, 'Johns Society', 'Tiisetso', 'Masemola', 'Male', '0793359595', 9706195397087);

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `package_id` int(11) NOT NULL,
  `society_id` int(11) NOT NULL,
  `flower` double NOT NULL,
  `coffin` double NOT NULL,
  `grave_marker` double NOT NULL,
  `transport` double NOT NULL,
  `funeral_service` double NOT NULL,
  `programmes` varchar(255) NOT NULL,
  `total` double NOT NULL,
  `package_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`package_id`, `society_id`, `flower`, `coffin`, `grave_marker`, `transport`, `funeral_service`, `programmes`, `total`, `package_created`) VALUES
(2, 8, 5000, 3500, 0, 500, 1500, '1500', 12000, '2019-07-30'),
(3, 9, 350, 18000, 650, 4500, 5000, '0', 28500, '2019-07-30'),
(4, 4, 1500, 5000, 1500, 0, 0, '75', 8000, '0000-00-00'),
(6, 11, 500, 500, 100, 1000, 900, '900', 3000, '2019-08-01'),
(7, 12, 750, 8500, 1500, 3500, 3500, '0', 17750, '2019-08-01'),
(8, 13, 5000, 500, 1000, 1000, 0, 'No Amount', 7500, '2019-08-01'),
(9, 14, 2500, 5000, 5000, 0, 2500, 'No Amount', 15000, '2019-08-01'),
(10, 14, 2500, 5000, 5000, 0, 2500, 'No Amount', 15000, '2019-08-01'),
(11, 14, 2500, 5000, 5000, 5000, 2500, 'No Amount', 20000, '2019-08-01'),
(12, 14, 2500, 0, 0, 5000, 2500, 'No Amount', 10000, '2019-08-01'),
(13, 1, 500, 100, 750, 5000, 750, 'No Amount', 7100, '2019-08-02'),
(14, 2, 0, 0, 0, 0, 0, 'No Amount', 0, '2019-08-02'),
(15, 15, 3500, 12000, 3000, 2500, 1200, 'No Amount', 22200, '2019-08-03');

-- --------------------------------------------------------

--
-- Table structure for table `society`
--

CREATE TABLE `society` (
  `society_id` int(11) NOT NULL,
  `society_name` varchar(255) NOT NULL,
  `addr1` varchar(255) NOT NULL,
  `addr2` varchar(255) NOT NULL,
  `addr3` varchar(255) NOT NULL,
  `addr4` varchar(255) NOT NULL,
  `init_capital` int(11) NOT NULL,
  `date_inception` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `society`
--

INSERT INTO `society` (`society_id`, `society_name`, `addr1`, `addr2`, `addr3`, `addr4`, `init_capital`, `date_inception`) VALUES
(1, 'Trend', '80 Bok Street', 'Polokwane', 'Limpopo', '', 5000, '2019-06-30'),
(2, 'Mosotho', 'Flora Park', 'Polokwane', 'Limpopo', '', 45000, '2019-07-01'),
(10, 'Moloto', '135 Zone F', 'Lebowakgomo', 'Limpopo', '', 10000, '2019-06-30'),
(11, 'Selemo', '125 Zone R', 'Polokwane', 'Limpopo', '', 1500, '2019-07-31'),
(12, 'Morudu', 'House No 1737', 'Lephalale', 'Limpopo', '', 15000, '2010-06-19'),
(13, 'Morule', '125 Zone R', 'Lephalale', 'Limpopo', '', 10000, '2019-07-22'),
(14, 'Mahlogonolo', '82 Marshall Street', 'Ivy Park', 'Polokwane', 'Limpopo', 15000, '2019-08-01'),
(15, 'Johns Society', '75 Thabo Mbeki Street', 'Flora Park', 'Polokwane', 'Limpopo', 5000, '1997-06-19');

-- --------------------------------------------------------

--
-- Table structure for table `statement`
--

CREATE TABLE `statement` (
  `payment_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `deceased_name` varchar(255) NOT NULL,
  `society_id` int(255) NOT NULL,
  `society_name` varchar(255) NOT NULL,
  `date_transaction` date NOT NULL,
  `credit` int(11) NOT NULL,
  `debit` int(11) NOT NULL,
  `balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statement`
--

INSERT INTO `statement` (`payment_id`, `name`, `deceased_name`, `society_id`, `society_name`, `date_transaction`, `credit`, `debit`, `balance`) VALUES
(1, 'Initial Capital', '', 1, 'Trend', '2019-07-17', 5000, 0, 5000),
(2, 'Initial Capital', '', 2, 'Mosotho', '2019-07-17', 45000, 0, 45000),
(3, 'Oupa', '', 2, 'Mosotho', '2019-07-17', 4000, 0, 49000),
(4, 'John', '', 2, 'Mosotho', '2019-07-17', 0, 1200, 47800),
(5, 'John', '', 2, 'Mosotho', '2019-07-17', 300, 0, 48100),
(6, 'John', '', 2, 'Mosotho', '2019-07-17', 500, 0, 48600),
(7, 'Pabalelo', '', 2, 'Mosotho', '2019-07-17', 500, 0, 49100),
(8, 'John', '', 2, 'Mosotho', '2019-07-17', 0, 9100, 40000),
(9, 'John', '', 1, 'Trend', '2019-07-17', 2000, 0, 7000),
(10, 'John', '', 1, 'Trend', '2019-07-17', 0, 500, 6500),
(11, 'Initial Capital', '', 3, 'hlakanang', '2019-07-17', 2000, 0, 2000),
(12, 'John', '', 3, 'hlakanang', '2019-07-17', 1000, 0, 3000),
(13, 'John', '', 1, 'Trend', '2019-07-22', 1500, 0, 8000),
(14, 'Mathabo', '', 3, 'hlakanang', '2019-07-22', 0, 1500, 1500),
(15, 'Initial Capital', '', 4, 'Masemola', '2019-07-23', 3580, 0, 3580),
(16, 'Initial Capital', '', 5, 'Mashabela', '2019-07-23', 1500, 0, 1500),
(17, 'Initial Capital', '', 6, 'Maropeng', '2019-07-23', 10000, 0, 10000),
(18, 'John', '', 6, 'Maropeng', '2019-07-23', 500, 0, 10500),
(19, 'Oupa', '', 6, 'Maropeng', '2019-07-23', 0, 600, 9900),
(20, 'Initial Capital', '', 7, '', '2019-07-24', 251, 0, 251),
(21, 'Initial Capital', '', 8, 'Mathaboos', '2019-07-24', 0, 0, 0),
(22, 'Mathabo', '', 1, 'Trend', '2019-07-29', 0, 1000, 7000),
(23, 'Oupa', '', 1, 'Trend', '2019-07-29', 0, 1500, 5500),
(24, 'Oupa', '', 1, 'Trend', '2019-07-29', 3500, 0, 9000),
(25, 'John', '', 1, 'Trend', '2019-07-29', 0, 10000, -1000),
(26, 'Oupa', '', 1, 'Trend', '2019-07-29', 1500, 0, 500),
(27, 'John', '', 1, 'Trend', '2019-07-29', 0, 500, 0),
(28, 'Pabalelo', '', 1, 'Trend', '2019-07-29', 0, 500, -500),
(29, 'Pabalelo', '', 1, 'Trend', '2019-07-30', 0, 1500, -2000),
(30, 'Pabalelo', '', 1, 'Trend', '2019-07-30', 0, 1500, -3500),
(31, 'Oupa', '', 2, 'Mosotho', '2019-07-30', 0, 500, 39500),
(32, 'Oupa', '', 2, 'Mosotho', '2019-07-30', 0, 500, 39000),
(33, 'Makgotso', '', 6, 'Maropeng', '2019-07-30', 1500, 0, 11400),
(34, 'Pabalelo', '', 1, 'Trend', '2019-07-30', 750, 0, -2750),
(35, 'Oupa', '', 2, 'Mosotho', '2019-07-30', 0, 500, 38500),
(36, 'Pholosho', '', 2, 'Mosotho', '2019-07-30', 500, 0, 39000),
(37, 'John', '', 1, 'Trend', '2019-07-30', 0, 1500, -4250),
(38, 'Initial Capital', '', 7, 'Mphahlele', '2019-07-30', 1500, 0, 1500),
(39, 'Initial Capital', '', 8, 'Makofane', '2019-07-30', 5000, 0, 5000),
(40, 'Initial Capital', '', 9, 'Makgahlelas', '2019-07-30', 3500, 0, 3500),
(41, 'John', '', 1, 'Trend', '2019-07-30', 1500, 0, -2750),
(42, 'Initial Capital', '', 10, 'Moloto', '2019-07-31', 10000, 0, 10000),
(43, 'Initial Capital', '', 11, 'Selemo', '2019-08-01', 1500, 0, 1500),
(44, 'Bokamoso', '', 1, 'Trend', '2019-08-01', 3500, 0, 750),
(45, 'Pabalelo', '', 1, 'Trend', '2019-08-01', 0, 3500, -2750),
(46, 'Initial Capital', '', 12, 'Morudu', '2019-08-01', 15000, 0, 15000),
(47, 'Initial Capital', '', 13, 'Morule', '2019-08-01', 10000, 0, 10000),
(48, 'Opening Balance', '', 14, 'Mahlogonolo', '2019-08-01', 15000, 0, 15000),
(49, 'John', '', 14, 'Mahlogonolo', '2019-08-01', 500, 0, 15500),
(50, 'John', '', 14, 'Mahlogonolo', '2019-08-01', 600, 0, 16100),
(51, 'John', '', 12, 'Morudu', '2019-08-01', 0, 500, 14500),
(52, 'Thabang', 'Lebo Makgahlela', 1, 'Trend', '2019-08-02', 0, 5000, -7750),
(53, 'Opening Balance', '', 15, 'Johns Society', '2019-08-03', 5000, 0, 5000),
(54, 'John', 'Lebo Makgahlela', 15, 'Johns Society', '2019-08-03', 0, 25000, -20000),
(55, 'John', '', 15, 'Johns Society', '2019-08-03', 5000, 0, -15000);

-- --------------------------------------------------------

--
-- Table structure for table `updated_package`
--

CREATE TABLE `updated_package` (
  `updated_package_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `total` double NOT NULL,
  `date_of_updated_package` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `updated_package`
--

INSERT INTO `updated_package` (`updated_package_id`, `package_id`, `total`, `date_of_updated_package`) VALUES
(10, 8, 7500, '2019-08-01'),
(11, 6, 3000, '2019-08-01'),
(12, 5, 30000, '2019-08-01'),
(13, 8, 7500, '2019-08-01'),
(14, 9, 25000, '2019-08-01'),
(15, 9, 15000, '2019-08-01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ip` varchar(32) NOT NULL,
  `time` int(11) NOT NULL,
  `email_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `ip`, `time`, `email_code`) VALUES
(1, 'tiisetsojohnmasemola@yahoo.com', 'Tiisetso Masemola', '$2y$12$0738672585d374b40328cOM2ieF2rwgnc6vh6MbZeryZj8gzUXU3.', '0', 225959, '0'),
(4, 'johniemasemza@gmail.com', 'Masemza', '$2y$12$7767022485d39fa78d723upMhPDe9NAkep9dZJyjIQwZA8ftgkiia', '0', 0, '0'),
(5, 'mathabo@gmail.com', 'Mathabo', '$2y$12$13701517615d486c76678uEv/NvqoiTZGFhssKcgxe/zwn3E2jE3y', '::1', 1565027446, 'code_5d486c76678834.09254957');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expenses_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `society`
--
ALTER TABLE `society`
  ADD PRIMARY KEY (`society_id`);

--
-- Indexes for table `statement`
--
ALTER TABLE `statement`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `updated_package`
--
ALTER TABLE `updated_package`
  ADD PRIMARY KEY (`updated_package_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expenses_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `society`
--
ALTER TABLE `society`
  MODIFY `society_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `statement`
--
ALTER TABLE `statement`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `updated_package`
--
ALTER TABLE `updated_package`
  MODIFY `updated_package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
