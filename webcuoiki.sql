-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 04, 2022 lúc 03:41 AM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `webcuoiki`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `eid` int(10) NOT NULL,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date DEFAULT NULL,
  `gender` text COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(1) NOT NULL,
  `activated` int(1) NOT NULL,
  `active_token` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_token` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` text COLLATE utf8_unicode_ci NOT NULL,
  `phongban` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`eid`, `username`, `password`, `birthday`, `gender`, `avatar`, `level`, `activated`, `active_token`, `password_token`, `fullname`, `phongban`) VALUES
(1, 'admin', '$2y$10$9MUmzJ/AWBO/Wp15ndDK2eFJCd5XkTy.S5tlcb/hI4pZBr1G.T/Ja', NULL, '', '', 0, 1, '', '', 'truong kha', 'kế toán'),
(35, 'longlates', '$2y$10$XbC//tXZiqdmUK9Zci8Lk.O0WnEXYosplqS7ZniVCcTQ3jqMv6iYG', '1999-01-01', 'nam', '', 1, 0, '7b55b52e8e9b9123d69a3a184a1466a8', '', 'Nguyễn Trường Khả', 'kế toán'),
(36, 'tungff123', '$2y$10$Z/gZhUUACLgdDZeZwkKuMOTWJjFct3yNgfsRgvVg8mNIL4B9nyKHS', '1993-11-21', 'nam', '', 2, 0, '2f5820a596f1806b688b992f4a577542', '', 'Nguyễn Thanh Tùng', 'kế toán'),
(37, 'tramst11', '$2y$10$3BA3nzPPghspBaTXPTTtueZaZsWiZpseKS7lPD22bLAw8e6770AGO', '2000-11-02', 'nữ', '', 1, 1, '', '', 'Thiều Trâm', 'kế toán'),
(38, 'vu2001', '$2y$10$aPT8c0s/03SbCY0RR3hG7.h.B3j8001xKTiZi1sjUPdpfoVbV1n1u', '2001-01-01', 'nam', '', 1, 0, 'cb10cffdbb62064d65f5763a19214985', '', 'Nguyễn Tuấn Vũ', 'it'),
(39, 'vu20012', '$2y$10$t1CmynJV/x7ko6IuaufEmu2za8zCf9ekkZEfMa6wLfoDPFgSV3myy', '2001-01-01', 'nam', '', 2, 0, '25b43bfb7598dfd3aa014ada571c710b', '', 'Nguyễn Tuấn Vũ 2', 'it'),
(41, 'tuanvupro', '$2y$10$fnm2XzpyPYH/DNkS2grh3uD9U3xQYSHB6iy7J2vsTVx/cF7Ec/HHe', '2000-11-11', 'nam', '', 2, 1, '', '', 'Nguyễn Tuấn vũ', 'marketing');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `department`
--

CREATE TABLE `department` (
  `id` int(3) NOT NULL,
  `ma_so` int(3) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `manager` text COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `department`
--

INSERT INTO `department` (`id`, `ma_so`, `name`, `manager`, `description`) VALUES
(1, 1, 'kế toán 1', 'thanh tung', 'ádasdasdasdadasd123'),
(2, 3, 'nhân sự', 'tuấn', 'Phòng quản lí các nhân sự trong công ty'),
(3, 5, 'IT', '', 'Phòng ban công nghệ thông tin'),
(4, 10, 'cthssv', '', 'phòng công tác học sinh sinh viên'),
(26, 30, 'Phòng tài vụ', '', 'lorem is pum'),
(27, 33, 'Phòng công nghệ thông tin', '', 'phòng công nghệ thông tin'),
(28, 34, 'kha sss', '', 'ssss'),
(29, 35, 'khả kjss', '', 'aaaaaaaaaaa'),
(30, 11, 'Phòng nghiệp vụ', '', 'Phòng nghiệp vụ  ádasdasdasda');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`eid`);

--
-- Chỉ mục cho bảng `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `eid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT cho bảng `department`
--
ALTER TABLE `department`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
