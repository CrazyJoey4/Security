-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2021 at 10:43 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance_table`
--

CREATE TABLE `attendance_table` (
  `Att_ID` int(11) NOT NULL,
  `Staff_ID` varchar(6) NOT NULL,
  `LoginTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance_table`
--

INSERT INTO `attendance_table` (`Att_ID`, `Staff_ID`, `LoginTime`) VALUES
(1, 'EMP000', '2021-06-26 19:11:03'),
(2, 'EMP002', '2021-06-26 19:11:10'),
(3, 'EMP004', '2021-06-26 19:11:32'),
(4, 'EMP003', '2021-06-26 19:11:45'),
(5, 'EMP000', '2021-06-26 19:11:52'),
(6, 'EMP001', '2021-06-26 23:00:39'),
(7, 'EMP000', '2021-06-26 23:46:53'),
(8, 'EMP002', '2021-06-26 23:58:58'),
(9, 'EMP000', '2021-06-26 23:59:08'),
(10, 'EMP000', '2021-06-27 02:34:44'),
(11, 'EMP000', '2021-06-27 16:43:12'),
(12, 'EMP004', '2021-06-27 17:49:25'),
(13, 'EMP000', '2021-06-27 17:49:35'),
(14, 'EMP000', '2021-06-28 09:43:02'),
(15, 'EMP000', '2021-06-29 01:16:32'),
(16, 'EMP000', '2021-06-29 11:32:19'),
(17, 'EMP000', '2021-06-30 22:53:30'),
(18, 'EMP001', '2021-06-30 22:53:45'),
(19, 'EMP000', '2021-06-30 22:53:58'),
(20, 'EMP000', '2021-06-30 11:10:25'),
(21, 'EMP004', '2021-06-30 11:12:03'),
(22, 'EMP000', '2021-06-30 11:12:42'),
(23, 'EMP000', '2021-07-01 02:31:02'),
(24, 'EMP004', '2021-07-01 03:49:04'),
(25, 'EMP002', '2021-07-01 03:49:13'),
(26, 'EMP001', '2021-07-01 03:49:21'),
(27, 'EMP003', '2021-07-01 03:49:32'),
(28, 'EMP000', '2021-07-01 03:49:39'),
(29, 'EMP000', '2021-07-01 18:40:54'),
(30, 'EMP000', '2021-07-02 00:56:26'),
(31, 'EMP000', '2021-07-02 00:57:19'),
(32, 'EMP004', '2021-07-02 00:57:50'),
(33, 'EMP000', '2021-07-02 00:59:20'),
(34, 'EMP000', '2021-07-02 14:10:08'),
(35, 'EMP002', '2021-07-02 14:28:24'),
(36, 'EMP000', '2021-07-02 14:31:51'),
(37, 'EMP002', '2021-07-02 14:32:56'),
(38, 'EMP000', '2021-07-02 14:59:50'),
(39, 'EMP002', '2021-07-02 15:00:06'),
(40, 'EMP000', '2021-07-02 15:00:35'),
(41, 'EMP001', '2021-07-02 15:01:00'),
(42, 'EMP000', '2021-07-02 15:01:50'),
(43, 'EMP000', '2021-07-04 17:59:20'),
(44, 'EMP000', '2021-07-05 00:35:18'),
(45, 'EMP000', '2021-07-05 16:03:05'),
(46, 'EMP000', '2021-07-07 01:59:43'),
(47, 'EMP000', '2021-07-07 02:02:02'),
(48, 'EMP000', '2021-07-07 17:23:45'),
(49, 'EMP001', '2021-07-08 09:07:19'),
(50, 'EMP004', '2021-07-08 09:07:39'),
(51, 'EMP000', '2021-07-08 09:24:35'),
(52, 'EMP000', '2021-07-15 16:48:13'),
(53, 'EMP000', '2021-07-17 21:14:18'),
(54, 'EMP001', '2021-07-18 00:34:07'),
(55, 'EMP002', '2021-07-18 00:37:30'),
(56, 'EMP000', '2021-07-18 00:37:42'),
(57, 'EMP003', '2021-07-18 00:38:08'),
(58, 'EMP004', '2021-07-18 00:40:13'),
(59, 'EMP000', '2021-07-18 00:44:40');

-- --------------------------------------------------------

--
-- Table structure for table `category_table`
--

CREATE TABLE `category_table` (
  `ID` int(11) NOT NULL,
  `Category_name` varchar(255) NOT NULL,
  `Category_status` enum('Able','Disable') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_table`
--

INSERT INTO `category_table` (`ID`, `Category_name`, `Category_status`) VALUES
(4, 'Noodles', 'Able'),
(5, 'Rice', 'Able'),
(10, 'Desert', 'Able'),
(12, 'Side Dishes', 'Able'),
(13, 'Beverage', 'Disable');

-- --------------------------------------------------------

--
-- Table structure for table `menu_table`
--

CREATE TABLE `menu_table` (
  `Food_ID` varchar(6) NOT NULL,
  `Food_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Food_cost` decimal(10,2) NOT NULL,
  `Category_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Food_status` enum('Available','Sold Out') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_table`
--

INSERT INTO `menu_table` (`Food_ID`, `Food_name`, `Food_cost`, `Category_name`, `Food_status`) VALUES
('B001', 'Sprite', '3.00', 'Beverage', 'Available'),
('B002', 'Green Tea', '3.20', 'Beverage', 'Available'),
('N001', 'Miso Ramen', '15.00', 'Noodles', 'Available'),
('R001', 'Chicken Katsu Don', '15.00', 'Rice', 'Available'),
('R002', 'Curry Rice', '7.50', 'Rice', 'Available'),
('S001', 'Cawanmushi', '6.50', 'Side Dishes', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `ID` int(11) NOT NULL,
  `Table_ID` varchar(4) NOT NULL,
  `Food_name` varchar(255) NOT NULL,
  `Food_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`ID`, `Table_ID`, `Food_name`, `Food_quantity`) VALUES
(55, 'T007', 'Chicken Katsu Don', 4),
(56, 'T001', 'Miso Ramen', 5);

-- --------------------------------------------------------

--
-- Table structure for table `payment_table`
--

CREATE TABLE `payment_table` (
  `Pay_ID` int(11) NOT NULL,
  `Order_ID` varchar(6) NOT NULL,
  `Gross_pay` decimal(12,2) NOT NULL,
  `Tax_pay` decimal(12,2) NOT NULL,
  `Net_pay` decimal(12,2) NOT NULL,
  `Pay_type` enum('Cash','Card') NOT NULL,
  `Pay_amount` decimal(12,2) NOT NULL,
  `Card_number` varchar(16) DEFAULT NULL,
  `Pay_date` date NOT NULL DEFAULT current_timestamp(),
  `Pay_time` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_table`
--

INSERT INTO `payment_table` (`Pay_ID`, `Order_ID`, `Gross_pay`, `Tax_pay`, `Net_pay`, `Pay_type`, `Pay_amount`, `Card_number`, `Pay_date`, `Pay_time`) VALUES
(1, 'P00001', '61.10', '9.78', '64.77', 'Card', '64.80', '2147483647', '2021-06-22', '21:20:52'),
(2, 'P00002', '49.30', '7.89', '52.26', 'Card', '52.30', '2147483647', '2021-06-23', '21:29:28'),
(3, 'P00003', '82.20', '13.15', '87.13', 'Cash', '87.10', '0', '2021-06-26', '22:43:08'),
(4, 'P00004', '47.00', '7.52', '49.82', 'Cash', '49.80', '0', '2021-06-26', '22:43:20'),
(5, 'P00005', '177.50', '28.40', '188.15', 'Card', '188.20', '2147483647', '2021-06-26', '22:43:52'),
(6, 'P00006', '82.50', '13.20', '87.45', 'Cash', '87.50', '0', '2021-06-27', '17:52:03'),
(7, 'P00007', '6.40', '1.02', '6.78', 'Card', '6.80', '2147483647', '2021-06-30', '23:03:06'),
(8, 'P00008', '90.00', '14.40', '95.40', 'Cash', '95.40', '0', '2021-06-30', '23:03:52'),
(9, 'P00009', '73.00', '11.68', '77.38', 'Cash', '77.40', '0', '2021-06-30', '23:07:22'),
(10, 'P00010', '32.50', '5.20', '34.45', 'Card', '34.50', '2147483647', '2021-07-01', '02:08:05'),
(11, 'P00011', '36.40', '5.82', '38.58', 'Card', '38.60', '2147483647', '2021-07-01', '02:11:16'),
(12, 'P00012', '39.00', '6.24', '41.34', 'Card', '41.30', '6546546546546546', '2021-07-01', '02:14:52'),
(13, 'P00013', '30.00', '4.80', '31.80', 'Card', '31.80', '2314231421341234', '2021-07-01', '02:22:08'),
(14, 'P00014', '10.70', '1.71', '11.34', 'Card', '11.30', '7987987987987987', '2021-07-01', '02:23:55'),
(15, 'P00015', '55.00', '8.80', '58.30', 'Cash', '58.30', '', '2021-07-02', '14:27:52'),
(16, 'P00016', '6.00', '0.96', '6.36', 'Cash', '6.40', '', '2021-07-08', '09:26:33');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_master`
--

CREATE TABLE `restaurant_master` (
  `res_ID` int(4) NOT NULL,
  `res_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `res_location` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `res_contact` int(11) NOT NULL,
  `res_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `res_currency` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `res_timezone` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restaurant_master`
--

INSERT INTO `restaurant_master` (`res_ID`, `res_name`, `res_location`, `res_contact`, `res_email`, `res_currency`, `res_timezone`) VALUES
(9, 'Chillax', 'Penang', 2147483647, 'crazyjoeyooi@gmail.com', 'MYR', 'Asia/Kuala_Lumpur');

-- --------------------------------------------------------

--
-- Table structure for table `table_data`
--

CREATE TABLE `table_data` (
  `Table_ID` varchar(4) NOT NULL,
  `Capacity` int(3) NOT NULL,
  `Table_status` enum('Able','Disable') NOT NULL,
  `Live_status` enum('Available','Seated') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `table_data`
--

INSERT INTO `table_data` (`Table_ID`, `Capacity`, `Table_status`, `Live_status`) VALUES
('T001', 2, 'Able', 'Seated'),
('T002', 4, 'Able', 'Available'),
('T003', 5, 'Able', 'Available'),
('T004', 8, 'Able', 'Available'),
('T005', 8, 'Able', 'Available'),
('T006', 10, 'Disable', 'Available'),
('T007', 12, 'Able', 'Seated'),
('T008', 14, 'Able', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `tax_table`
--

CREATE TABLE `tax_table` (
  `Tax_ID` int(11) NOT NULL,
  `Tax_name` varchar(255) NOT NULL,
  `Tax_percent` decimal(4,2) NOT NULL,
  `Tax_status` enum('Able','Disable') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tax_table`
--

INSERT INTO `tax_table` (`Tax_ID`, `Tax_name`, `Tax_percent`, `Tax_status`) VALUES
(5, 'SST', '0.10', 'Able'),
(6, 'GST', '0.06', 'Able');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `User_ID` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `User_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `User_email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `User_pwd` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `User_position` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `User_start` datetime NOT NULL DEFAULT current_timestamp(),
  `User_contact` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `User_birthday` date DEFAULT NULL,
  `User_gender` enum('Male','Female') COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`User_ID`, `User_name`, `User_email`, `User_pwd`, `User_position`, `User_start`, `User_contact`, `User_birthday`, `User_gender`) VALUES
('EMP000', 'Joey Ooi', 'crazyjoeyooi@gmail.com', '123456', 'Master', '2021-06-19 04:56:01', '0126149023', '2001-04-19', 'Female'),
('EMP001', 'Minatozaki Sana', 'sanachan@gmail.com', '123456', 'Waiter', '2021-06-16 21:54:56', '123456789', '1996-12-29', 'Female'),
('EMP002', 'Chou Tzuyu', 'tzutzu99@gmail.com', '123456', 'Waiter', '2021-06-24 18:25:58', '879564213', '1999-04-14', 'Female'),
('EMP003', 'Park Jihyo', 'jikyukyu@gmail.com', '123456', 'Cashier', '2021-06-25 04:14:00', '132456789', '1997-02-01', 'Female'),
('EMP004', 'John', 'john@email.com', '123456', 'Waiter', '2021-06-25 05:04:40', '654987321', '1994-02-11', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `waitlist_table`
--

CREATE TABLE `waitlist_table` (
  `Wait_ID` varchar(6) NOT NULL,
  `Cus_name` varchar(255) NOT NULL,
  `Cus_Pax` int(11) NOT NULL,
  `Cus_contact` varchar(11) NOT NULL,
  `Wait_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `waitlist_table`
--

INSERT INTO `waitlist_table` (`Wait_ID`, `Cus_name`, `Cus_Pax`, `Cus_contact`, `Wait_time`) VALUES
('C00002', 'Mr. K', 2, '11111111160', '2021-07-02 14:22:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance_table`
--
ALTER TABLE `attendance_table`
  ADD PRIMARY KEY (`Att_ID`);

--
-- Indexes for table `category_table`
--
ALTER TABLE `category_table`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `menu_table`
--
ALTER TABLE `menu_table`
  ADD PRIMARY KEY (`Food_ID`);

--
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `payment_table`
--
ALTER TABLE `payment_table`
  ADD PRIMARY KEY (`Pay_ID`);

--
-- Indexes for table `restaurant_master`
--
ALTER TABLE `restaurant_master`
  ADD PRIMARY KEY (`res_ID`);

--
-- Indexes for table `table_data`
--
ALTER TABLE `table_data`
  ADD PRIMARY KEY (`Table_ID`);

--
-- Indexes for table `tax_table`
--
ALTER TABLE `tax_table`
  ADD PRIMARY KEY (`Tax_ID`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`User_ID`);

--
-- Indexes for table `waitlist_table`
--
ALTER TABLE `waitlist_table`
  ADD PRIMARY KEY (`Wait_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance_table`
--
ALTER TABLE `attendance_table`
  MODIFY `Att_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `category_table`
--
ALTER TABLE `category_table`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `payment_table`
--
ALTER TABLE `payment_table`
  MODIFY `Pay_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `restaurant_master`
--
ALTER TABLE `restaurant_master`
  MODIFY `res_ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tax_table`
--
ALTER TABLE `tax_table`
  MODIFY `Tax_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
