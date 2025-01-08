-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2025 at 06:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `timestamp`) VALUES
(1, 'welcome is the power', 'fefgnfobnrf bmrf brfnbdvbsdbs', '2025-01-08 01:28:05'),
(4, 'appa first intern', 'welcome to the internship', '2025-01-08 01:40:27'),
(5, 'appa first intern', 'welcome to the internship', '2025-01-08 01:41:35'),
(7, 'welcome', 'testing document', '2025-01-08 05:01:17'),
(8, 'welcome', 'testing document', '2025-01-08 05:01:19'),
(9, 'welcome', 'testing document', '2025-01-08 05:01:20'),
(10, 'welcome', 'testing document', '2025-01-08 05:01:20'),
(11, 'welcome', 'testing document', '2025-01-08 05:01:20'),
(12, 'welcome', 'testing document', '2025-01-08 05:01:20'),
(13, 'welcome', 'testing document', '2025-01-08 05:01:21'),
(14, 'welcome', 'testing document', '2025-01-08 05:01:21'),
(15, 'welcome sampel input', 'testing input', '2025-01-08 05:03:55'),
(16, 'sample first', 'welcome this post 2024', '2025-01-08 05:13:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
