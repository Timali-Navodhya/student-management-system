-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2026 at 04:22 PM
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
-- Database: `student_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `full_name`, `email`, `phone`, `address`, `created_at`) VALUES
(1, 'Timali Navodhya', 'madubashini1232@gmail.com', '0775894452', 'Aluthgama', '2026-03-11 15:19:58'),
(5, 'Madu Bashini', 'madubashiniv1232@gmail.com', '0775894452', 'vidya mawatha,colombo 7', '2026-03-11 17:20:50'),
(6, 'Dilmi Ishara', 'madubashinnni1232@gmail.com', '0775894452', 'vidya mawatha,colombo 7', '2026-03-11 17:23:47'),
(24, 'Yuwani pramodya', 'yuwa232@gmail.com', '0155464640', 'Kandy', '2026-03-11 19:59:05'),
(42, 'Amal Perera', 'amal123@gmail.com', '0774752652', 'Panadura', '2026-03-11 20:09:27'),
(50, 'Anula Kumari', 'anula32@gmail.com', '0775741415', 'Kandy', '2026-03-11 20:13:29'),
(51, 'Amaya Chanduni', 'amaya12@gmail.com', '0775894555', 'vidya mawatha,colombo 7', '2026-03-11 21:24:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
