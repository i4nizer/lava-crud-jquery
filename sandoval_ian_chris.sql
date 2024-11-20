-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 20, 2024 at 05:02 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sandoval_ian_chris`
--

-- --------------------------------------------------------

--
-- Table structure for table `icas_users`
--

CREATE TABLE `icas_users` (
  `id` int NOT NULL,
  `icas_last_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `icas_first_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `icas_email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `icas_gender` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `icas_address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `icas_users`
--

INSERT INTO `icas_users` (`id`, `icas_last_name`, `icas_first_name`, `icas_email`, `icas_gender`, `icas_address`) VALUES
(1, 'sandoval', 'ian', 'ian@gmail.com', 'male', 'Puerto Galera'),
(3, 'nilo', 'melvin', 'mn@gmail.com', 'male', 'Puerto Galera'),
(10, 'sandoval', 'ian', 'ian@gmail.com', 'male', 'Puerto Galera'),
(12, 'nilo', 'melvin', 'mn@gmail.com', 'male', 'Puerto Galera'),
(13, 'nilo', 'melvin', 'melvin@gmail.com', 'male', 'Puerto Princesa'),
(14, 'ugu', 'sdvy', 'dsh@sfd.com', 'fnfwi', 'fsiufbwe'),
(15, 'ugu', 'sdvy', 'dsh@sfd.com', 'fnfwi', 'fsiufbwe'),
(16, 'ugcsy', 'cysg', 'sj@gm.com', 'fbe', 'usbcd'),
(17, 'ugcsy', 'cysg', 'sj@gm.com', 'fbe', 'usb'),
(18, 'sandoval', 'ian', 'ian@gmail.com', 'male', 'Calapan'),
(19, 'Bautista', 'Jesus', 'jb@gmail.com', 'male', 'Calapan'),
(21, 'shdbfhsd', 'hjdbvsj', 'wjb@df.com', 'usadbf', 'hsdfbhs'),
(22, 'hsaf', 'Umaww', 'subfda@sdfds.com', 'dsha', 'shfdd'),
(23, 'asgbcu', 'Calamay', 'cs@s.com', 'viudsh', 'sduch'),
(24, 'nsjfbs', 'Hahah', 'fnsj@vds.com', 'jdnbdjc', 'vjdbd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `icas_users`
--
ALTER TABLE `icas_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `icas_users`
--
ALTER TABLE `icas_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
