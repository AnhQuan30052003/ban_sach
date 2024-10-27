-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2024 at 07:01 AM
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
-- Database: `quanlybansach`
--

-- --------------------------------------------------------

--
-- Table structure for table `khach_hang`
--

CREATE TABLE `khach_hang` (
  `maKH` varchar(4) NOT NULL,
  `tenKH` varchar(100),
  `email` varchar(100),
  `matKhau` varchar(50)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `khach_hang`
--

INSERT INTO `khach_hang` (`maKH`, `tenKH`, `email`, `matKhau`) VALUES
('0000', 'admin', 'quan.na.63cntt@ntu.edu.vn', 'admin'),
('0001', 'Nguyễn Anh Quân', 'anhquan300503@gmail.com', 'nguyenanhquan');

-- --------------------------------------------------------

--
-- Table structure for table `loai_sach`
--

CREATE TABLE `loai_sach` (
  `maLS` varchar(4) NOT NULL,
  `tenLS` varchar(100)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `loai_sach`
--

INSERT INTO `loai_sach` (`maLS`, `tenLS`) VALUES
('0000', 'Sách giáo dục'),
('0001', 'Tiểu thuyết'),
('0002', 'Ngôn tình'  ),
('0003', 'Tra thám'   ),
('0004', 'Tham khảo'  ),
('0005', 'Khoa học'   ),
('0006', 'Tôn giáo'   ),
('0007', 'Lịch sử'    ),
('0008', 'Nấu ăn'     ),
('0009', 'Kỹ năng'    ),
('0010', 'Self - help');

-- --------------------------------------------------------

--
-- Table structure for table `sach`
--

CREATE TABLE `sach` (
  `maSach` varchar(4) NOT NULL,
  `tenSach` varchar(100),
  `maLS` varchar(4),
  `moTa` varchar(256),
  `giaTien` int(11),
  `soLuong` int(11),
  `tacGia` varchar(256),
  `hinhAnh` varchar(256)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sach`
--

-- INSERT INTO `sach` (`maSach`, `tenSach`, `maLS`, `moTa`, `giaTien`, `soLuong`, `tacGia`, `hinhAnh`) VALUES
-- ('0000', '', '', '', '', '', '', '',);

-- --------------------------------------------------------

--
-- Table structure for table `sach_yeu_thich`
--

CREATE TABLE `sach_yeu_thich` (
  `maSYT` varchar(4) NOT NULL,
  `maKH` varchar(4),
  `maSach` varchar(4)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD PRIMARY KEY (`maKH`);

--
-- Indexes for table `loai_sach`
--
ALTER TABLE `loai_sach`
  ADD PRIMARY KEY (`maLS`);

--
-- Indexes for table `sach`
--
ALTER TABLE `sach`
  ADD PRIMARY KEY (`maSach`),
  ADD KEY `maLS` (`maLS`);

--
-- Indexes for table `sach_yeu_thich`
--
ALTER TABLE `sach_yeu_thich`
  ADD PRIMARY KEY (`maSYT`),
  ADD KEY `maKH` (`maKH`),
  ADD KEY `maSach` (`maSach`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sach`
--
ALTER TABLE `sach`
  ADD CONSTRAINT `sach_ibfk_1` FOREIGN KEY (`maLS`) REFERENCES `loai_sach` (`maLS`);

--
-- Constraints for table `sach_yeu_thich`
--
ALTER TABLE `sach_yeu_thich`
  ADD CONSTRAINT `sach_yeu_thich_ibfk_2` FOREIGN KEY (`maSach`) REFERENCES `sach` (`maSach`),
  ADD CONSTRAINT `sach_yeu_thich_ibfk_3` FOREIGN KEY (`maKH`) REFERENCES `khach_hang` (`maKH`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
