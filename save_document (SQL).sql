-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2022 at 05:48 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `save_document`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_doc`
--

CREATE TABLE `access_doc` (
  `access_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `access` int(1) NOT NULL,
  `position_id` varchar(50) NOT NULL,
  `important` int(11) NOT NULL,
  `user_id` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `access_doc`
--

INSERT INTO `access_doc` (`access_id`, `document_id`, `access`, `position_id`, `important`, `user_id`) VALUES
(85, 90, 0, '0', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Category_id` int(11) NOT NULL,
  `Category_name` varchar(255) NOT NULL,
  `time_category` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_category` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category_id`, `Category_name`, `time_category`, `delete_category`) VALUES
(1, 'หนังสือภายนอก', '2021-12-12 09:59:08', 0),
(2, 'หนังสือภายใน', '2022-01-08 13:11:53', 0),
(3, 'หนังสือประทับตรา', '2021-12-08 11:10:22', 0),
(4, 'หนังสือสั่งการ', '2022-02-18 10:48:08', 0),
(5, 'หนังสือประชาสัมพันธ์', '2022-01-08 13:10:52', 0),
(6, 'อื่นๆ', '2021-09-11 23:51:44', 0);

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `document_id` int(11) NOT NULL,
  `number_doc` varchar(50) NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `doc_pdf` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `category_id` varchar(5) NOT NULL,
  `agency` varchar(50) NOT NULL,
  `delete_doc_data` int(1) NOT NULL,
  `time` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`document_id`, `number_doc`, `document_name`, `doc_pdf`, `document`, `category_id`, `agency`, `delete_doc_data`, `time`) VALUES
(90, '', 'คู่มือการใช้งานระบบบันทีกเอกสารเข้า', '78b1f09e3b1489213bf8e5ceb8e67193.pdf', '', '6', 'อื่นๆ', 0, '2021-12-10');

-- --------------------------------------------------------

--
-- Table structure for table `history_read`
--

CREATE TABLE `history_read` (
  `read_id` int(11) NOT NULL,
  `user_id_hr` int(11) NOT NULL,
  `document_id_hr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `position_id` int(11) NOT NULL,
  `position_name` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`position_id`, `position_name`, `time`) VALUES
(1, 'หัวหน้าสาขา', '2021-11-18 10:22:13'),
(2, 'หัวหน้าหลักสูตร', '2021-11-18 10:23:00'),
(3, 'อาจารย์', '2021-11-18 10:23:47'),
(4, 'เจ้าหน้าที่', '2021-11-18 10:24:14');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `position_id` varchar(11) NOT NULL,
  `role` int(1) NOT NULL,
  `user_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `img` varchar(255) NOT NULL,
  `delete_user_data` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fname`, `lname`, `email`, `phone`, `password`, `position_id`, `role`, `user_time`, `img`, `delete_user_data`) VALUES
(46, 'สำเนา', 'หัดนาวี', '615021000810@mail.rmutk.ac.th', '0809999', '$2y$12$K8wfRhuu9SYXW0hFcG9TLuwqOKgs./cQ.Cx5axx4DNtvHtYHqlcUS', '4,3', 0, '2021-10-16 12:27:39', '77fc727a1c4ab84de79afce0efd8299c.png', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_doc`
--
ALTER TABLE `access_doc`
  ADD PRIMARY KEY (`access_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Category_id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`document_id`);

--
-- Indexes for table `history_read`
--
ALTER TABLE `history_read`
  ADD PRIMARY KEY (`read_id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_doc`
--
ALTER TABLE `access_doc`
  MODIFY `access_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `history_read`
--
ALTER TABLE `history_read`
  MODIFY `read_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
