-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2024 at 08:14 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ferrari_member`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesslog`
--

CREATE TABLE `accesslog` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role` varchar(20) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `login_success` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `accesslog`
--

INSERT INTO `accesslog` (`id`, `user_id`, `role`, `ip_address`, `login_success`, `created_at`) VALUES
(1, 1, 'admin', '::1', 1, 1706683111),
(2, 1, 'admin', '::1', 1, 1706683127),
(3, 1, 'admin', '::1', 1, 1706683335),
(4, 1, 'admin', '::1', 1, 1706683457),
(5, 1, 'admin', '::1', 1, 1706684003),
(6, 1, 'admin', '::1', 1, 1706694179),
(7, 1, 'admin', '::1', 1, 1706694615),
(8, 1, 'admin', '::1', 1, 1707099297);

-- --------------------------------------------------------

--
-- Table structure for table `tblmember`
--

CREATE TABLE `tblmember` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `address` text NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblmember`
--

INSERT INTO `tblmember` (`id`, `first_name`, `last_name`, `contact`, `amount`, `address`, `created_at`) VALUES
(4, '', '', '', '0.00', '', 0),
(5, '', '', '', '0.00', '', 0),
(6, 'qwe', 'ads', '123123', '29.00', '', 0),
(7, 'Macon', 'Bright', 'Eaque et aut est ve', '0.00', 'Doloribus sunt repr', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `role` varchar(15) NOT NULL DEFAULT 'admin',
  `access` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `access`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'chaxiong@fullstacksys.com', NULL, '$2y$12$MMo7bYwrokAwXJVVNRxlZuNKZaviLQ.mUHQIkaR97E4LVSFYLFkx6', NULL, 'admin', 1, '2022-01-31 09:01:38', '2022-09-19 20:52:06'),
(4, 'CEO', 'admin@gmail.com', NULL, '$2y$12$1bs58uPpsahnErd9dXrzO.COdqqcPd0Uz5Z1zPlvOoLPKJnWHnV/a', NULL, 'admin', 1, '2022-02-09 00:05:31', '2022-11-06 17:54:30'),
(10, 'ສາຍຝົນ', '99403334', NULL, '$2y$12$yNoCVhT6df3yHSg0vq2.0O/aTslCW.j6x/WJN7xKUdAlDszf2balC', NULL, 'staff', 1, '2023-10-17 04:03:19', NULL),
(11, 'ສອງສາມ', '56421133', NULL, '$2y$12$TPjD39qEFeKuoJONyA1pnOOXR8vwXDNMmD4Sly8rsrSIxPSjqclBW', NULL, 'staff', 1, '2023-10-18 05:17:53', NULL),
(12, 'ka', 'ka@gmail.com', NULL, '$2y$12$s70NbWs3FiygTntsErz76Ob01U2OafDiyCd1xQaiC731BFBzZ.X6u', NULL, 'admin', 1, '2024-02-05 02:25:36', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesslog`
--
ALTER TABLE `accesslog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblmember`
--
ALTER TABLE `tblmember`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesslog`
--
ALTER TABLE `accesslog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblmember`
--
ALTER TABLE `tblmember`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
