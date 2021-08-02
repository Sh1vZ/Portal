-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2021 at 11:14 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$YMfo5LqYJMN1HUbHP/NVzuZDh7xJo/HZ.pbIXckp8BpTKC4zx.ceu', '2021-08-02 02:02:11', '2021-08-02 02:02:11');

-- --------------------------------------------------------

--
-- Table structure for table `audits`
--

CREATE TABLE `audits` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id` int(10) UNSIGNED NOT NULL,
  `idRecord` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `nr1` int(11) NOT NULL,
  `percent` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '%',
  `nr2` int(11) NOT NULL,
  `expireDate` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`id`, `idRecord`, `code`, `startDate`, `endDate`, `nr1`, `percent`, `nr2`, `expireDate`, `created_at`, `updated_at`) VALUES
(8, 8504014, 'DQVG', '2018-06-01', '2018-06-30', 100, '%', 999, '2018-06-30', '2021-08-02 21:23:29', '2021-08-02 21:23:29'),
(9, 8504089, 'DQVG', '2018-06-01', '2018-06-30', 100, '%', 999, '2018-06-30', '2021-08-02 21:23:29', '2021-08-02 21:23:29'),
(10, 8504481, 'DQVG', '2018-06-01', '2018-06-30', 100, '%', 999, '2018-06-30', '2021-08-02 21:23:29', '2021-08-02 21:23:29'),
(11, 1412, 'EEEE', '2021-08-11', '2021-08-19', 1242, '%', 124, '2021-08-18', '2021-08-02 21:25:23', '2021-08-02 21:32:56'),
(12, 8500816, 'DQVG', '2018-06-01', '2018-06-30', 100, '%', 999, '2018-06-30', '2021-08-02 21:33:24', '2021-08-02 21:33:24'),
(13, 8500848, 'DQVG', '2018-06-01', '2018-06-30', 100, '%', 999, '2018-06-30', '2021-08-02 21:33:24', '2021-08-02 21:33:24'),
(14, 8501689, 'DQVG', '2018-06-01', '2018-06-30', 100, '%', 999, '2018-06-30', '2021-08-02 21:33:24', '2021-08-02 21:33:24'),
(15, 8501706, 'DQVG', '2018-06-01', '2018-06-30', 100, '%', 999, '2018-06-30', '2021-08-02 21:33:24', '2021-08-02 21:33:24'),
(16, 8501869, 'DQVG', '2018-06-01', '2018-06-30', 100, '%', 999, '2018-06-30', '2021-08-02 21:33:24', '2021-08-02 21:33:24'),
(17, 8503036, 'DQVG', '2018-06-01', '2018-06-30', 100, '%', 999, '2018-06-30', '2021-08-02 21:33:24', '2021-08-02 21:33:24'),
(18, 8503679, 'DQVG', '2018-06-01', '2018-06-30', 100, '%', 999, '2018-06-30', '2021-08-02 21:33:24', '2021-08-02 21:33:24'),
(19, 8504014, 'DQVG', '2018-06-01', '2018-06-30', 100, '%', 999, '2018-06-30', '2021-08-02 21:33:24', '2021-08-02 21:33:24'),
(20, 8504089, 'DQVG', '2018-06-01', '2018-06-30', 100, '%', 999, '2018-06-30', '2021-08-02 21:33:24', '2021-08-02 21:33:24');

-- --------------------------------------------------------

--
-- Table structure for table `userapis`
--

CREATE TABLE `userapis` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `adress` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(5, 'test', '$2y$10$eW/eo3JqiCouX1JuczBM4OYSLYXbalVmyZRNAPoRBVwyA5p1m.xW.', NULL, '2021-08-02 21:56:33'),
(7, 'testuser', '$2y$10$6.4oDO0gzNmkdbz9TVz9n..qJdA9jUmHO6NcFSuFhd/TjAzQM66Pe', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indexes for table `audits`
--
ALTER TABLE `audits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userapis`
--
ALTER TABLE `userapis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `audits`
--
ALTER TABLE `audits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `userapis`
--
ALTER TABLE `userapis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
