-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql-server
-- Generation Time: Jan 12, 2022 at 05:56 AM
-- Server version: 8.0.1-dmr
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `eid` int(10) NOT NULL,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` text COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date DEFAULT NULL,
  `gender` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` text COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user.png',
  `level` int(1) NOT NULL DEFAULT '2',
  `activated` int(1) NOT NULL,
  `active_token` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_token` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `phongban` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`eid`, `username`, `password`, `fullname`, `birthday`, `gender`, `email`, `phone`, `address`, `avatar`, `level`, `activated`, `active_token`, `password_token`, `phongban`) VALUES
(1, 'admin', '$2y$10$9MUmzJ/AWBO/Wp15ndDK2eFJCd5XkTy.S5tlcb/hI4pZBr1G.T/Ja', 'Thanh Tùng', '1995-01-02', 'nam', '', '0', '', 'admin.png', 0, 1, '', '', NULL),
(3, 'tuanproak1', '$2y$10$CtNLtcj8Yc13rRc5lBCcBOcXUyI180o2lC/KRT0vXOjKbwDjI7A86', 'Tuấn Nguyễn', '2000-09-04', 'nam', 'tuanproza@gmail.com', '84317313', 'quận 1', 'user.png', 1, 1, '', '', 2),
(4, 'maisg02', '$2y$10$i533VVeWqVJ6FP/Hwy2wue0NkCgJ7Ju2aLN7yeLutVYbSYlPpjlW.', 'Mai Nguyễn', '2001-12-30', 'nữ', 'maisgd@gmail.com', '7123612360', 'Hà Nội, VN', 'user.png', 2, 0, 'f19009c490c3ae19938f2f944e1852bc', '', 1),
(6, 'johndubai', '$2y$10$.k8Zj2DCr4AlY6wsDvOmROifyjfaoJm7JlV.vVy1iicrc1W7tdv4y', 'John weed', '1995-09-12', 'nam', 'johnsocho@gmail.com', '861235615', 'Quận 8, HCM', 'user.png', 2, 0, 'aba28bc3fa54de569a7122ff21aebea4', '', 1),
(9, 'cena11', '$2y$10$nAAlESXN.IklfgOFYpKHNeumf03Qm7CZqxf8VfA.UivD2tEiiiWXi', 'John Cena', '1997-12-31', 'nam', 'cenalk@outlook.com', '2147483647', 'US, cali', 'user.png', 1, 0, '9be2209c25037017e5a683f3ab397932', '', 1),
(10, 'thanhtien', '$2y$10$HipY9QLjMXt8TPgXy/XzpO/i1CnMr4CpovrS3Tql0GUydWwI8D2.W', 'Vũ Thanh Tiến', '1998-02-01', 'nam', 'tienvu@outlook.com', '2147483647', 'Đà Nẵng VN', 'user.png', 2, 0, '945ae722e01afcc88b6c090c9dc3c515', '', 2),
(11, 'khavmb', '$2y$10$dLrrLJ3BRYyJV12v4hT61.rqKPaJf5SYH4Bt4hd93BZvY/XM6YWma', 'Trần Trung Tín', '1999-06-09', 'nam', 'tindz@gmail.com', '8417273561', 'Cầu Giấy, HN', 'user.png', 2, 0, '07273c8e013ad39064cb3a4e57e9a3cb', '', 4);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(3) NOT NULL,
  `ma_so` int(3) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `manager` int(3) DEFAULT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `ma_so`, `name`, `manager`, `description`) VALUES
(1, 2, 'phòng tài chính', 9, 'phòng tài chính akaa'),
(2, 5, 'Phòng nhân sự', 3, 'Phòng quản lí nhân sự trong công ty'),
(3, 6, 'Phòng Thống Kê', NULL, 'Thống kê trong công ty'),
(4, 10, 'Phòng CNTT', NULL, 'IT 96 BK '),
(5, 11, 'Phòng Nghiệp Vụ', NULL, 'Nghiệp vụ cty');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `attach` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` int(11) NOT NULL DEFAULT '0',
  `rate` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `expire` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `name`, `title`, `description`, `attach`, `state`, `rate`, `receiver`, `expire`) VALUES
(1, 'Thu Chi', 'Tính toán tổng thu chi', 'Tính tổng thu chi trong tháng và lập báo cáo nộp lại', '', 0, 0, 1, '0000-00-00 00:00:00'),
(2, 'Báo cáo', 'Thu Chi trong tháng', 'Tính toán tổng thu chi trong tháng và lập báo cáo', '', 0, 0, 5, '2022-01-11 15:11:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`eid`),
  ADD KEY `des` (`phongban`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manager` (`manager`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `eid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `des` FOREIGN KEY (`phongban`) REFERENCES `department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `manager` FOREIGN KEY (`manager`) REFERENCES `account` (`eid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
