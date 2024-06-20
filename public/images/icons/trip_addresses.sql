-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 10, 2024 at 08:23 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scooble`
--

-- --------------------------------------------------------

--
-- Table structure for table `trip_addresses`
--

CREATE TABLE `trip_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `trip_pic` varchar(255) NOT NULL,
  `trip_signature` varchar(255) NOT NULL,
  `trip_note` varchar(255) NOT NULL,
  `driv_trip_pic` text DEFAULT NULL,
  `driv_trip_signature` text DEFAULT NULL,
  `driv_trip_note` text DEFAULT NULL,
  `driv_trip_desc` text DEFAULT NULL,
  `skiped_address_desc` text DEFAULT NULL,
  `trip_id` int(11) NOT NULL,
  `order_no` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Invalid',
  `address_status` int(11) NOT NULL DEFAULT 2,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trip_addresses`
--

INSERT INTO `trip_addresses` (`id`, `title`, `desc`, `trip_pic`, `trip_signature`, `trip_note`, `driv_trip_pic`, `driv_trip_signature`, `driv_trip_note`, `driv_trip_desc`, `skiped_address_desc`, `trip_id`, `order_no`, `status`, `address_status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '92CM+9GR, St 1, Gulshan E Iqbal, Faisalabad, Punjab, Pakistan', 'sdfddf', '0', '1', '1', NULL, NULL, NULL, NULL, NULL, 1, 4, 'Valid', 2, 2, NULL, '2024-01-31 07:40:26', '2024-02-01 09:05:30'),
(2, 'Ghanta Ghar, Clock Tower Roundabout، Clock Tower, Faisalabad, Punjab 38000, Pakistan', 'dfdf', '0', '1', '1', NULL, NULL, NULL, NULL, NULL, 1, 5, 'Valid', 2, 2, NULL, '2024-01-31 07:41:07', '2024-02-01 09:05:30'),
(3, '925C+QF Faisalabad, Pakistan', 'gjh', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, 2, 1, 'Valid', 2, 2, NULL, '2024-02-01 06:42:17', '2024-02-01 06:42:17'),
(4, 'City Terminal, Rajbah Rd, Faisalabad, Punjab, Pakistan', 'hhjhj', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, 2, 2, 'Valid', 2, 2, NULL, '2024-02-01 06:42:17', '2024-02-01 06:42:17'),
(5, '94G3+F49, Outer Rd, Faisalabad, Punjab, Pakistan', 'yuyu', '0', '0', '1', NULL, NULL, NULL, NULL, NULL, 1, 1, 'Valid', 2, 2, NULL, '2024-02-01 06:43:45', '2024-02-01 09:34:12'),
(6, '92CM+9C Faisalabad, Pakistan', '321564879', '0', '1', '0', NULL, NULL, NULL, NULL, NULL, 1, 2, 'Valid', 2, 2, NULL, '2024-02-01 09:01:06', '2024-02-01 10:17:57'),
(7, '9XFH+7F Faisalabad, Pakistan', '132654', '1', '0', '0', NULL, NULL, NULL, NULL, NULL, 1, 6, 'Valid', 2, 2, NULL, '2024-02-01 09:01:07', '2024-02-01 09:05:30'),
(8, '92CH+2VC, Faisalabad, Punjab, Pakistan', '1234  123', '0', '1', '0', NULL, NULL, NULL, NULL, NULL, 1, 3, 'Valid', 2, 2, NULL, '2024-02-01 09:03:31', '2024-02-01 10:17:57'),
(9, '92CM+9C Faisalabad, Pakistan', 'driver_id', '1', '0', '0', NULL, NULL, NULL, NULL, NULL, 3, 4, 'Valid', 2, 2, NULL, '2024-02-02 07:21:36', '2024-02-03 11:11:30'),
(10, '93H2+F76, Muzaffar Colony, Faisalabad, Punjab, Pakistan', 'driver_id', '0', '1', '0', NULL, NULL, NULL, NULL, NULL, 3, 2, 'Valid', 2, 2, NULL, '2024-02-02 07:21:36', '2024-02-02 07:21:36'),
(11, 'technic centre main bazaar gattwala, F55Q+RWQ, Chak No 199 Rb, Faisalabad, Punjab, Pakistan', 'lorem  ispsium', '0', '1', '0', NULL, NULL, NULL, NULL, NULL, 3, 3, 'Valid', 2, 2, NULL, '2024-02-03 01:11:40', '2024-02-03 01:11:40'),
(12, 'C37G+J68, Factory Area, Faisalabad, Punjab, Pakistan', 'deleteUsers', '0', '1', '0', NULL, NULL, NULL, NULL, NULL, 4, 1, 'Valid', 2, 2, NULL, '2024-02-03 01:50:25', '2024-02-03 01:50:25'),
(13, 'Plot 791, Block A Wapda City, Faisalabad, Punjab, Pakistan', 'deleteUsers', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, 4, 2, 'Valid', 2, 2, NULL, '2024-02-03 01:50:25', '2024-02-03 01:50:25'),
(14, '96HQ+5P2, Jaranwala Rd, Faisalabad, Punjab 38000, Pakistan', 'deleteUsers', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, 4, 3, 'Valid', 2, 2, NULL, '2024-02-03 01:50:25', '2024-02-03 01:50:25'),
(15, '9W8H+C29, Sadhar City, city, Punjab, Pakistan', 'lorem ipsim', '1', '0', '0', 'addres_pics/uCHdXGIUNoX9owAOgerc2TLIJmv09xUsO8zBmtBo.png', NULL, NULL, NULL, NULL, 5, 3, 'Valid', 3, 2, 3, '2024-02-03 02:20:32', '2024-02-03 08:19:18'),
(17, '9W73+5Q Chak 70 JB Mansooran, Pakistan', 'ahmed', '1', '0', '0', NULL, NULL, NULL, NULL, 'LOREM IPSUM', 5, 2, 'Valid', 4, 2, 3, '2024-02-03 02:20:32', '2024-02-03 08:17:48'),
(18, 'Dining Hall, Plot 329 Main Blvd, D Ground Block B People\'s Colony No 1, Faisalabad, Punjab, Pakistan', 'macdoland', '1', '0', '0', 'addres_pics/EiRHlFQ1VQseYpyLiyahyJgBUHYyCrFfZOg4ToQm.png', NULL, NULL, NULL, NULL, 5, 4, 'Valid', 3, 2, 3, '2024-02-03 02:20:32', '2024-02-03 08:36:34'),
(19, '9XJ9+XWR, Faisalabad, Punjab, Pakistan', 'abcd', '1', '0', '0', NULL, NULL, NULL, NULL, NULL, 5, 5, 'Valid', 1, 2, NULL, '2024-02-03 02:20:32', '2024-02-03 08:36:39'),
(20, '92Q5+P7 Faisalabad, Pakistan', 'if you deleted this', '1', '0', '0', NULL, NULL, NULL, NULL, NULL, 5, 1, 'Valid', 1, 2, NULL, '2024-02-03 02:20:32', '2024-02-03 08:13:36'),
(30, '9W8P+Q2P, Sadhar City, Faisalabad, Punjab, Pakistan', 'lorem', '1', '0', '0', NULL, NULL, NULL, NULL, NULL, 6, 3, 'Valid', 2, 2, NULL, '2024-02-03 11:06:33', '2024-02-03 11:09:24'),
(31, '9XF7+88G, Faisalabad, Punjab, Pakistan', 'adress_id', '1', '0', '0', NULL, NULL, NULL, NULL, NULL, 6, 4, 'Valid', 2, 2, NULL, '2024-02-03 11:06:33', '2024-02-03 11:09:24'),
(32, '9V5M+58M, Chak 74 JB Thikriwala, Faisalabad, Punjab, Pakistan', 'adress_id', '0', '1', '0', NULL, NULL, NULL, NULL, NULL, 6, 1, 'Valid', 2, 2, NULL, '2024-02-03 11:06:33', '2024-02-03 11:09:10'),
(33, '92WJ+22W, Faisalabad, Punjab, Pakistan', 'adress_id', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, 6, 5, 'Valid', 2, 2, NULL, '2024-02-03 11:06:33', '2024-02-03 11:09:24'),
(34, '92R8+W9 Faisalabad, Pakistan', 'adress_id', '1', '0', '0', NULL, NULL, NULL, NULL, NULL, 6, 2, 'Valid', 2, 2, NULL, '2024-02-03 11:06:33', '2024-02-03 11:09:24'),
(35, 'Plot 690 D, Sir Syed Town, Faisalabad, Punjab, Pakistan', 'adress_id', '1', '0', '0', NULL, NULL, NULL, NULL, NULL, 6, 6, 'Valid', 2, 2, NULL, '2024-02-03 11:06:33', '2024-02-03 11:09:10'),
(36, 'C4C8+6WR, Susan Road, Block Z Madina Town, Faisalabad, Punjab, Pakistan', '132', '1', '0', '0', NULL, NULL, NULL, NULL, NULL, 7, 1, 'Valid', 2, 2, NULL, '2024-02-10 02:14:46', '2024-02-10 02:14:46'),
(37, '275 D Ground, Block B People\'s Colony No 1, Faisalabad, Punjab, Pakistan', 'macdoland', '1', '0', '0', NULL, NULL, NULL, NULL, NULL, 7, 2, 'Valid', 2, 2, NULL, '2024-02-10 02:14:46', '2024-02-10 02:14:46'),
(38, '130 Kohinoor City Rd, Kohinoor City Faisalabad, Punjab, Pakistan', 'ranchers', '1', '0', '0', NULL, NULL, NULL, NULL, NULL, 7, 3, 'Valid', 2, 2, NULL, '2024-02-10 02:14:46', '2024-02-10 02:14:46'),
(39, '9X7Q+743, Faislabad Airport, Faisalabad, Punjab, Pakistan', '132564', '1', '0', '0', NULL, NULL, NULL, NULL, NULL, 7, 4, 'Valid', 2, 2, NULL, '2024-02-10 02:14:46', '2024-02-10 02:14:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `trip_addresses`
--
ALTER TABLE `trip_addresses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `trip_addresses`
--
ALTER TABLE `trip_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
