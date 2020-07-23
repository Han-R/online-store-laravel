-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2018 at 12:04 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chalk`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.admin', '$2y$10$gROn0SezUgyHzQdg/Dqr.uISeVr4qnE0yFccXT1/Dl0pg.6MgGqGm', 'OfFv2M8XSLYzIGDcyjP1pa76ndjlzqwR9GmbbQ7jh04wVi84gbAHQde3RaJO', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `image` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `createdBy` int(11) NOT NULL,
  `status` enum('active','not_active') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'not_active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `image`, `description`, `order_by`, `createdBy`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'uploads/images/img/img1.png', 'test 010101', 2, 1, 'active', '2018-04-20 05:20:19', '2018-04-24 05:32:33', '2018-04-24 05:32:33'),
(2, 'uploads/images/img/img2.jpg', 'test 020202', 1, 1, 'not_active', '2018-04-20 05:31:57', '2018-04-24 05:32:29', '2018-04-24 05:32:29'),
(3, 'uploads/images/img/lZJUoaWxRjJCqNCUNyrbEsXpnimDyRQBuR8IATYI.jpeg', 'test 33', 13, 1, 'active', '2018-04-20 05:34:00', '2018-04-24 05:32:44', '2018-04-24 05:32:44'),
(4, 'uploads/images/img/evqnY1G2kJrWTmzdw5KYQcrOu7mNJBgAmSefIn2j.jpeg', 'test 04', 3, 1, 'not_active', '2018-04-24 03:45:10', '2018-04-24 05:32:53', '2018-04-24 05:32:53'),
(12, 'uploads/images/img/OcXOEJwpXW8Q6yFhadimLJPpS9lJQMIaRReQ1bPL.jpeg', 'short description1', 1, 1, 'not_active', '2018-04-24 05:33:12', '2018-04-24 05:35:57', '2018-04-24 05:35:57'),
(13, 'uploads/images/img/nYa251768qRcqsvW4IEuCIIcSXCL9UuIV0tjZyvq.jpeg', 'description 01', 1, 1, 'active', '2018-04-24 05:39:34', '2018-05-03 07:03:10', NULL),
(14, 'uploads/images/img/FyCmCNju5FQOv1051s09zpTJwEVjw8519PHSN6Ty.jpeg', 'test 030303', 0, 1, 'not_active', '2018-04-26 04:48:12', '2018-04-26 04:48:25', '2018-04-26 04:48:25'),
(15, 'uploads/images/img/tbp88DK6zbq7DxOiorHlOPgyBwhdH4dd0AWf9V5w.png', 'ads 022', 0, 1, 'active', '2018-04-27 11:59:54', '2018-05-03 07:06:04', NULL),
(16, 'uploads/images/img/189ppLlURLi9FKJSFKqKEdiGtsfpHgCzrFWRTSWf.png', 'test 030303', 3, 1, 'active', '2018-04-30 03:43:22', '2018-05-03 07:02:34', NULL),
(17, 'uploads/images/img/tIRDprdsNL1x4pUn19L8EViDO6na5Nf5G9wiPwUP.jpeg', 'test 33', NULL, 1, 'not_active', '2018-05-03 07:07:22', '2018-05-03 07:07:30', '2018-05-03 07:07:30');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('active','not_active') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdBy` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `icon`, `status`, `created_at`, `createdBy`, `updated_at`, `deleted_at`) VALUES
(1, 'APPLE', 'uploads/images/brand/yWH8uOF67yxKLYzh3xpn7elw7CRTZxHP1DusM5yB.jpeg', 'not_active', '2018-01-25 14:32:55', 1, '2018-04-25 09:57:45', NULL),
(2, 'SAMSUNG', 'uploads/images/brand/N7CDbX142deSBitxWMEriTGhUIRD1qfNSdg7w277.png', 'active', '2018-02-14 08:24:34', 1, '2018-04-25 03:58:00', NULL),
(3, 'GOOGLE', 'uploads/images/brand/9gwmB26XIxlSvNeIxuMnq1sKvcZafCEpp00JLpke.png', 'active', '2018-04-24 08:37:53', 1, '2018-04-25 09:53:24', NULL),
(4, 'NOKIA', 'uploads/images/brand/0uZQL8fhwjO1AErwfMjZvxhBjkqEoqjcYmZiNElE.jpeg', 'active', '2018-04-25 03:57:33', 1, '2018-05-03 07:49:56', '2018-05-03 07:49:56'),
(5, 'momen', 'uploBrand/images/Blog/Mr9zez8ngSdN87BDkDPhY0AwYg2G4fQ7RSnoXukI.jpeg', 'active', '2018-05-02 06:50:44', 1, '2018-05-03 07:41:43', '2018-05-03 07:41:43');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `image` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `createdBy` int(11) NOT NULL,
  `status` enum('active','not_active') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `order_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `image`, `createdBy`, `status`, `order_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'uploads/images/category/6cMFKsvzkJcNz9Yysetuzr5eCu2NdOEXiNNDTIhe.jpeg', 1, 'active', 4, '2018-01-16 08:13:44', '2018-04-29 07:00:40', NULL),
(2, 'uploads/images/category/Yd5tkypwRkweVAHFETOYD6Y6Lg78yp6PbdD9XbXz.jpeg', 1, 'active', 3, '2018-01-24 08:13:44', '2018-04-29 06:59:46', NULL),
(3, 'uploads/images/category/4GEg7CgbPihLj5uDXAPchMEIDtREiMuJFnRYDhGw.jpeg', 1, 'active', 2, '2018-01-24 08:13:44', '2018-05-03 07:17:57', '2018-05-03 07:17:57'),
(4, 'uploads/images/category/vjHLwjobPCuMrAqpvrRCJyvadGWhCrOYsXcUScAJ.jpeg', 1, 'active', 1, '2018-04-25 03:40:55', '2018-04-29 06:56:14', NULL),
(5, 'uploads/images/category/XvIslUd9sU2fF5QOQyTgc0xA2LgyCcrkE5siD6oA.jpeg', 1, 'active', 5, '2018-04-29 07:01:44', '2018-05-03 07:16:57', '2018-05-03 07:16:57'),
(6, 'uploads/images/category/PsHldqbCoXziLykYezqIzWAwZBOJytyxM5Ml5ZO5.png', 1, 'active', 6, '2018-04-29 07:03:01', '2018-05-03 07:20:31', NULL),
(7, 'uploads/images/category/2rus843FtqWxSRfRZyhJL11lZahiCdUqFbFrAobY.jpeg', 1, 'active', 7, '2018-04-29 07:04:13', '2018-05-03 07:16:46', '2018-05-03 07:16:46');

-- --------------------------------------------------------

--
-- Table structure for table `category_translations`
--

CREATE TABLE `category_translations` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `locale` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category_translations`
--

INSERT INTO `category_translations` (`id`, `category_id`, `locale`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'en', 'Speakears', '2018-01-24 08:17:13', '2018-04-29 07:00:40', NULL),
(2, 1, 'ar', 'مكبرات صوت', '2018-01-24 08:17:13', '2018-04-29 07:00:40', NULL),
(3, 2, 'en', 'Batteries', '2018-01-24 08:17:13', '2018-04-29 06:59:46', NULL),
(4, 2, 'ar', 'بطاريات', '2018-01-24 08:17:13', '2018-04-29 06:59:46', NULL),
(5, 3, 'en', 'Covers', '2018-01-24 08:17:13', '2018-04-29 06:58:40', NULL),
(6, 3, 'ar', 'كفرات', '2018-01-24 08:17:13', '2018-04-29 06:58:40', NULL),
(7, 4, 'en', 'Mobiles', '2018-04-25 03:40:55', '2018-04-29 06:56:14', NULL),
(8, 4, 'ar', 'موبايلات', '2018-04-25 03:40:55', '2018-04-29 06:56:14', NULL),
(9, 5, 'en', 'Charges', '2018-04-29 07:01:44', '2018-04-29 07:01:44', NULL),
(10, 5, 'ar', 'شواحن', '2018-04-29 07:01:44', '2018-04-29 07:01:44', NULL),
(11, 6, 'en', 'Headphones', '2018-04-29 07:03:01', '2018-04-29 07:03:01', NULL),
(12, 6, 'ar', 'سماعات', '2018-04-29 07:03:01', '2018-04-29 07:03:01', NULL),
(13, 7, 'en', 'Screen Protection', '2018-04-29 07:04:13', '2018-04-29 07:04:13', NULL),
(14, 7, 'ar', 'حماية شاشة', '2018-04-29 07:04:13', '2018-04-29 07:04:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `fullname` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `fullname`, `email`, `mobile`, `comment`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'flayer App', 'flayer@hotail.com', '56895652', 'Contact With Us', '2018-01-24 13:08:13', '2018-04-24 11:04:10', NULL),
(2, 'jamal kamel', 'jamal@gmail.com', '48655526', 'Contact With Us', '2018-04-25 07:30:09', '0000-00-00 00:00:00', NULL),
(3, 'kamel', 'kamel@gmail.com', '0592887717', 'hello chalk store', '2018-04-29 03:41:01', '2018-04-29 03:43:33', '2018-04-29 03:43:33'),
(4, 'kamel', 'kamel@gmail.com', '0592887717', 'hello chalk store', '2018-04-29 03:42:46', '2018-04-29 03:43:29', '2018-04-29 03:43:29'),
(5, 'kamel', 'kamel@gmail.com', '0592887717', 'hello chalk store', '2018-04-29 03:43:16', '2018-04-29 03:43:26', '2018-04-29 03:43:26'),
(6, 'kamel', 'kamel@gmail.com', '0592887717', 'hello chalk store', '2018-04-29 03:47:25', '2018-04-29 03:47:25', NULL),
(7, 'kamel', 'kamel@gmail.com', '0592887717', 'hello chalk store', '2018-05-01 07:19:45', '2018-05-01 07:23:04', '2018-05-01 07:23:04'),
(8, 'kamel', 'kamel@gmail.com', '0592887717', 'hello chalk store', '2018-05-01 07:20:00', '2018-05-01 07:23:01', '2018-05-01 07:23:01'),
(9, 'jamal', 'jamal@gmail.com', '0592887707', 'hello chalk store - jamal', '2018-05-01 07:20:26', '2018-05-01 07:22:58', '2018-05-01 07:22:58'),
(10, 'jamal', 'jamal@gmail.com', '0592887707', 'hello chalk store - jamal', '2018-05-01 07:20:55', '2018-05-01 07:22:55', '2018-05-01 07:22:55'),
(11, 'jamal', 'jamal@gmail.com', '0592887707', 'hello chalk store - jamal', '2018-05-01 10:20:01', '2018-05-01 10:20:01', NULL),
(12, 'jamal', 'jamal@gmail.com', '0592887707', 'hello chalk store - jamal', '2018-05-01 10:27:51', '2018-05-02 08:52:45', '2018-05-02 08:52:45'),
(13, 'jamal', 'jamal@gmail.com', '0592887707', 'hello chalk store - jamal', '2018-05-01 10:30:33', '2018-05-02 08:52:37', '2018-05-02 08:52:37'),
(14, 'jamal', 'jamal@gmail.com', '0592887707', 'hello chalk store - jamal', '2018-05-01 10:30:50', '2018-05-02 08:52:41', '2018-05-02 08:52:41'),
(15, 'jamal', 'jamal@gmail.com', '0592887707', 'hello chalk store - jamal', '2018-05-01 13:43:50', '2018-05-02 08:52:33', '2018-05-02 08:52:33'),
(16, 'jamalqqq', 'jamal@gmail.comqq', '0592887707q', 'hello chalk store - jamal', '2018-05-02 08:33:03', '2018-05-02 08:52:30', '2018-05-02 08:52:30');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `percentage` int(11) NOT NULL,
  `code` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `expire_date` date NOT NULL,
  `status` enum('active','not_active') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `percentage`, `code`, `expire_date`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 15, 'GD4DS8G4FSDGSDF', '2018-05-10', 'active', '2018-04-28 19:18:59', '2018-04-28 16:22:44', NULL),
(2, 12, 'GHF845DSFG0001', '2018-05-12', 'not_active', '2018-04-28 16:31:33', '2018-04-29 10:10:59', NULL),
(3, 25, 'GFDSD543GFFDG069', '2018-05-17', 'active', '2018-04-28 16:57:31', '2018-04-28 16:58:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usd_value` double NOT NULL COMMENT 'amount of 1 usd in different currencies',
  `flag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `usd_value`, `flag`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'KWD', 0.299702, 'front_end_assets/image/kw.png', '2018-01-30 06:00:00', '2018-04-19 16:30:37', NULL),
(2, 'SAR', 3.750099, 'front_end_assets/image/saudiarabia.jpg', '2018-01-30 06:00:00', '2018-04-19 16:30:37', NULL),
(3, 'AED', 3.672598, 'front_end_assets/image/em.png', '2018-01-30 06:00:00', '2018-04-19 16:30:37', NULL),
(4, 'OMR', 0.384799, 'front_end_assets/image/oman.png', '2018-01-30 06:00:00', '2018-04-19 16:30:37', NULL),
(5, 'QAR', 3.639797, 'front_end_assets/image/qatar.png', '2018-01-30 06:00:00', '2018-04-19 16:30:37', NULL),
(6, 'USD', 1, 'front_end_assets/image/us.png', '2018-01-30 06:00:00', '2018-04-19 16:30:37', NULL),
(7, 'BHD', 0.377027, 'front_end_assets/image/bah.png', '2018-01-30 06:00:00', '2018-04-19 16:30:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `id` int(30) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `lang` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `lang`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'en', '2017-10-18 10:36:27', '0000-00-00 00:00:00', NULL),
(2, 'ar', '2017-10-18 10:36:38', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `language_translations`
--

CREATE TABLE `language_translations` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `locale` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `language_translations`
--

INSERT INTO `language_translations` (`id`, `language_id`, `locale`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'en', 'English', '2017-10-19 08:04:44', '0000-00-00 00:00:00', NULL),
(2, 1, 'ar', 'إنجليزي', '2017-10-19 08:04:44', '0000-00-00 00:00:00', NULL),
(3, 2, 'en', 'Arabic', '2017-10-19 08:05:27', '0000-00-00 00:00:00', NULL),
(4, 2, 'ar', 'عربي', '2017-10-19 08:05:27', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_04_19_160733_create_admins_table', 1),
(4, '2018_04_19_160734_create_admin_password_resets_table', 1),
(5, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(6, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(7, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(8, '2016_06_01_000004_create_oauth_clients_table', 2),
(9, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('0060417b78998ac173a7028397b71a893529e7d47481b615ab418ba6a34cd83bbce7a6a13c1da889', 1, 1, 'MyApp', '[]', 0, '2018-04-21 15:44:05', '2018-04-21 15:44:05', '2019-04-21 18:44:05'),
('04578ce202d717e6b81ca95d7c0f1374d0218f25ff8b6f4bc9968925c1b9f99c97da4a6ec79ec0c1', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:50:58', '2018-04-22 13:50:58', '2019-04-22 16:50:58'),
('099a585491114037131dd766875368f44a01708fb78ea09a7e28f0778ef018fd81ff2f9f8bd8d26a', 3, 1, 'access_token', '[]', 0, '2018-04-27 12:03:23', '2018-04-27 12:03:23', '2019-04-27 15:03:23'),
('09adf872c5acce0e13efdc4607d9a209609f1cc4d22b46ec5f4c7d8c2ad5709b9771f4fb157333db', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:11:19', '2018-04-22 13:11:19', '2019-04-22 16:11:19'),
('0a3cc80e7f314915ab0d711c5d82af2614cfdb6ae62ee8f8af165e6ee5ddc865e52fb718cf95c5b2', 3, 1, 'access_token', '[]', 0, '2018-04-25 04:48:49', '2018-04-25 04:48:49', '2019-04-25 07:48:49'),
('14483a60ca4db083ddfd712edf1b63f9df8d0a972dcba582c19ca1148ab5368f772af8631f83f155', 12, 1, 'access_token', '[]', 0, '2018-05-01 09:34:57', '2018-05-01 09:34:57', '2019-05-01 12:34:57'),
('14bbc46f7b6ae6fbf3274c63a117ec78eef274f382edca0a1d237cb5844d6e86f75ddbd60e6e9aeb', 3, 1, 'access_token', '[]', 0, '2018-04-23 02:38:33', '2018-04-23 02:38:33', '2019-04-23 05:38:33'),
('14c644386abcf4b733ed77c4426040f62cf3988f06856bedc19ccc072ab6756568bd1d25b9343488', 3, 1, 'access_token', '[]', 0, '2018-04-25 04:49:38', '2018-04-25 04:49:38', '2019-04-25 07:49:38'),
('182ba826a6e683841c828b3736080529bb2891eab16346bc2203ce117ba7a9b0c4ab08ea1f3f747f', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:08:37', '2018-04-22 13:08:37', '2019-04-22 16:08:37'),
('195db893b9fed5db09c29d4f5b0e1c4f229f445a808d97e1bd9f6e71b4c66fc3f6be9ff6934b9b16', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:19:22', '2018-04-22 13:19:22', '2019-04-22 16:19:22'),
('1f4b66a3233f1e701d6f45a10921215960b6fadf06c7bf4a66d55104d8d20955d53bfae2d5ea49fd', 3, 1, 'access_token', '[]', 0, '2018-04-23 02:38:40', '2018-04-23 02:38:40', '2019-04-23 05:38:40'),
('2160778c3d93f4394ce27421a070705b113f2fffb4cae37544903a0561302aefee233cbf85d8c54c', 3, 1, 'access_token', '[]', 0, '2018-04-25 04:48:22', '2018-04-25 04:48:22', '2019-04-25 07:48:22'),
('2297f83553f50264debd70b24aeb9e0641d78a2a561aa7a024f0d9099ba1fd25cde2150627468ecc', 8, 1, 'access_token', '[]', 0, '2018-05-01 09:04:11', '2018-05-01 09:04:11', '2019-05-01 12:04:11'),
('267ab725db4745b4e9905544cf1e3e6b7c047a1b213cad1d8241f7e95002d61ec60360053c6bf975', 3, 1, 'access_token', '[]', 0, '2018-04-29 04:49:46', '2018-04-29 04:49:46', '2019-04-29 07:49:46'),
('2743c0b146912ac1a7da4f068007446112532cb5c7c3fa1b0b2e08bc1a71b778a78b2a1f671c6878', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:39:43', '2018-04-22 13:39:43', '2019-04-22 16:39:43'),
('2b48fb0520f334d9a0680ced0d89bdc14f113aadcafe57053b66171ef62028e199dfc5f5b4a66ada', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:21:19', '2018-04-22 13:21:19', '2019-04-22 16:21:19'),
('2c19a7a6614660fcc0499b4f3f240ffd0e0853adf325ce1612efeb90381db5a1f20a7d77d775d583', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:18:56', '2018-04-22 13:18:56', '2019-04-22 16:18:56'),
('2d072664f9d188db0eb213bea694b8ef88954a7421a4deddf69e3b52fa91cfe26c90ec5d32deaa9f', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:16:52', '2018-04-22 13:16:52', '2019-04-22 16:16:52'),
('30aa5a03600ea47219eab23c362f29e57d0bd5ba138a75d29a3b9f2a9398d0c98934b725a90a6a3b', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:19:14', '2018-04-22 13:19:14', '2019-04-22 16:19:14'),
('31c3a59cee817d8525030522141fd15f44bd7751afde7a7803af9b388a6608ae9d768b8ea1dacb28', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:20:01', '2018-04-22 13:20:01', '2019-04-22 16:20:01'),
('359da565cc5aec1ccc3c4e0230fd4a56a1718d2be6e9e070b407b91bb305c8ec41e7ed3e81bd5fd4', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:21:06', '2018-04-22 13:21:06', '2019-04-22 16:21:06'),
('3870921c14b5f13ba8481a0f8a18b3a39d79d4ab9dddfb523f3fe218318fc3f7a9f62ca191862dc4', 3, 1, 'access_token', '[]', 0, '2018-04-27 12:02:38', '2018-04-27 12:02:38', '2019-04-27 15:02:38'),
('399551c9890dca0ea9f999ec3e9e541c608605dc99b231c61053902066751e015dc3114d55da1a80', 3, 1, 'access_token', '[]', 0, '2018-04-23 01:58:57', '2018-04-23 01:58:57', '2019-04-23 04:58:57'),
('3c40f5d5e299138ef50d21f4344df4e317e908bfe468955ee0a3c60bd400b23b2df6c854f7a81833', 3, 1, 'access_token', '[]', 0, '2018-04-25 05:05:04', '2018-04-25 05:05:04', '2019-04-25 08:05:04'),
('3d85ee7e9f0383ee186ebacbc37b477d7104d1111c6fb1c32453d452344176f8ad5cc65f065207a5', 3, 1, 'MyApp', '[]', 0, '2018-04-21 16:21:15', '2018-04-21 16:21:15', '2019-04-21 19:21:15'),
('40be5c40fad45e7544f81ef12b0fd710046710e1f09e98728d80904e0701a65e9748f479764bac0e', 3, 1, 'access_token', '[]', 0, '2018-04-22 02:22:01', '2018-04-22 02:22:01', '2019-04-22 05:22:01'),
('42f2c6203fa30fb3a00f28f3154f9c128fde2734e36fe1d25daf8d81436d9b1dd9741afe5c846151', 3, 1, 'access_token', '[]', 0, '2018-05-01 12:19:51', '2018-05-01 12:19:51', '2019-05-01 15:19:51'),
('43be97769498acf46a816edf56e57eb62d086a22a77f28d5012695289ce42afb47267876d31c0288', 3, 1, 'access_token', '[]', 0, '2018-05-02 04:59:15', '2018-05-02 04:59:15', '2019-05-02 07:59:15'),
('4be52769bf1498fa3f014d5179c629ae16739c9d9819fa4af5cb9dd9dca3a2c2480cc5ca236e53cd', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:25:52', '2018-04-22 13:25:52', '2019-04-22 16:25:52'),
('4d6cac7d80ef6d96474613e31d0236334e64cf3f063e2b9de83ad4e716652761e85ba210ea02789d', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:25:19', '2018-04-22 13:25:19', '2019-04-22 16:25:19'),
('501d5690e257e6742a3dd19145d8d2684e81aab024a74479a09302db5bd83636af6ba3f568b10bd5', 3, 1, 'access_token', '[]', 1, '2018-04-29 06:00:23', '2018-04-29 06:00:23', '2019-04-29 09:00:23'),
('5099fb9b69bb9456b87b9ba7cef8bf64e59a4201c7bd856affc6d40e427b60da9de46a7f8ecbfb32', 3, 1, 'access_token', '[]', 0, '2018-04-29 05:02:14', '2018-04-29 05:02:14', '2019-04-29 08:02:14'),
('52700778c06717fa6964c0b5e2c8b5d7971a9ef1a6b2c8f9dc1e38596d26f7f0581725fe8bb648aa', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:50:45', '2018-04-22 13:50:45', '2019-04-22 16:50:45'),
('52865c982d05c854edecf7eff992294c8c07c35361edf281c5ef54c46b0f2b07de14f081b9c6556c', 3, 1, 'access_token', '[]', 0, '2018-04-29 05:00:11', '2018-04-29 05:00:11', '2019-04-29 08:00:11'),
('544415353d21f7cd03e61261144504cfbd2928e4fea6278a18c772556f9a8f7c7eb052eb50c5c7a6', 3, 1, 'access_token', '[]', 0, '2018-04-29 05:02:06', '2018-04-29 05:02:06', '2019-04-29 08:02:06'),
('54b08007ed0da1b4ff81bea56f80783e32474044100bb041d58f41f6c2d63700282f99717f26d88b', 3, 1, 'access_token', '[]', 0, '2018-04-25 04:55:05', '2018-04-25 04:55:05', '2019-04-25 07:55:05'),
('5575cf418d448d60646ff98e0cf23dc2a6ab674ea7ab898e0f6ad431365824fb5a1649ecd03d604c', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:24:52', '2018-04-22 13:24:52', '2019-04-22 16:24:52'),
('55b97fb22af75c7d9869b4acf6da0e65ed22d647cdd6c618ee10d602ed092d38d5ee2247c8fa5e6c', 7, 1, 'access_token', '[]', 0, '2018-04-29 04:38:12', '2018-04-29 04:38:12', '2019-04-29 07:38:12'),
('566045dfc1c79d25323572164d30994c75510621f3df5cb193e79c6e51e9f0d9efbfd1b35c9adcc6', 3, 1, 'access_token', '[]', 0, '2018-04-25 04:37:36', '2018-04-25 04:37:36', '2019-04-25 07:37:36'),
('56fc195040a6a8441fd8287e5ff46c407a278be191f05419af95128a95b9424d10e37aa0cc262850', 2, 1, 'MyApp', '[]', 0, '2018-04-21 15:49:25', '2018-04-21 15:49:25', '2019-04-21 18:49:25'),
('57e7e66626d2f4bb801688ea75690e2ab86beff151c34c938fac956a0ddeb2a0efc23553af77eeba', 3, 1, 'access_token', '[]', 0, '2018-05-01 12:19:05', '2018-05-01 12:19:05', '2019-05-01 15:19:05'),
('59b591d882a80f80af0cc46459b19972ba74518b7a034015a2e56babe4675fce8df7cbd7946d38d2', 3, 1, 'access_token', '[]', 0, '2018-05-01 12:23:21', '2018-05-01 12:23:21', '2019-05-01 15:23:21'),
('62fc883d454569cb65f6f9a37ed2468a39b7c78667afb5245719a79b4de904de57663413bd0a0db2', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:42:40', '2018-04-22 13:42:40', '2019-04-22 16:42:40'),
('63fbcd066cac15b61b67f0119eb09a75f1dc3501a962f83d0e272234c0027f530b6a979f9563a9a8', 3, 1, 'access_token', '[]', 0, '2018-04-29 04:59:11', '2018-04-29 04:59:11', '2019-04-29 07:59:11'),
('6707efd6e9bf7f33fc85b2ac5a8f3eb60698c62e91de90d7b6a6548008c2985f041f2c4a75d9e6ca', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:41:04', '2018-04-22 13:41:04', '2019-04-22 16:41:04'),
('6bb4c59a4eda5544e23ed72a810320c6501c79d51daf2388402476883d7d3dd95b3470d1bac2eff7', 3, 1, 'access_token', '[]', 0, '2018-04-25 04:50:01', '2018-04-25 04:50:01', '2019-04-25 07:50:01'),
('6cc0b971f780cc4c7eed45f1c8d82b63ecfec3602afa0c01ed8effbf67af312251174b90bed2231e', 3, 1, 'access_token', '[]', 0, '2018-04-25 05:04:26', '2018-04-25 05:04:26', '2019-04-25 08:04:26'),
('6d1cb494d31c1732ecbae153c5a96926366f6ab2ff244ca9ab3e0d2874e25784d8ab16b4fd273dc3', 3, 1, 'access_token', '[]', 0, '2018-04-23 02:34:48', '2018-04-23 02:34:48', '2019-04-23 05:34:48'),
('6f65e7dbcb88f3076af7f27831640030b358efc1148955dae02fc57bf29c3d1b8050fdc6e15ba0aa', 3, 1, 'access_token', '[]', 0, '2018-04-23 02:39:48', '2018-04-23 02:39:48', '2019-04-23 05:39:48'),
('6f98d9548cb023f8f8a7760f86d4067d42e9cc0721507501526b5c663365cc3a84f06cfdd01371cc', 3, 1, 'MyApp', '[]', 0, '2018-04-22 02:19:35', '2018-04-22 02:19:35', '2019-04-22 05:19:35'),
('7575282be6e59bb392f1d45340c255996f4ac5b91fe1fad2925bd34c63d7e2be3b5e5bc257a20870', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:16:20', '2018-04-22 13:16:20', '2019-04-22 16:16:20'),
('772c4e603aea26a4dcc24e014320dc6444e7391f6af7f15445db48b1758a257c7bf8fa2ece6cafef', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:38:46', '2018-04-22 13:38:46', '2019-04-22 16:38:46'),
('7b4576fadf82135d8b1668947565ce3ef65450aee5b82fcbd56b1b4e8a5d2318d1f111e7e16aa291', 3, 1, 'access_token', '[]', 1, '2018-05-01 09:52:42', '2018-05-01 09:52:42', '2019-05-01 12:52:42'),
('7bdbeef33d61909d334e545c5d0644a9c9a2e05ab629f8aaf72efacf017ea861ffcaa0de6b93d8d8', 3, 1, 'access_token', '[]', 0, '2018-04-27 12:04:17', '2018-04-27 12:04:17', '2019-04-27 15:04:17'),
('7c67c10c7b331a92a132667cb0c6c4e582eff2479d9ba3999010ad25cd4bd95aebdc60375a86f4d3', 1, 1, 'MyApp', '[]', 0, '2018-04-22 02:16:46', '2018-04-22 02:16:46', '2019-04-22 05:16:46'),
('801e548b35e4fd30789b1973d8f78f68bb458b19037c209989ebab2d6f81261626131f30e59c09df', 3, 1, 'access_token', '[]', 0, '2018-05-01 12:30:32', '2018-05-01 12:30:32', '2019-05-01 15:30:32'),
('80992c0da54977fb84e22b01eaeb7fc39ba053d091e1f665d8fc15877d972719f225305c887f0c52', 3, 1, 'access_token', '[]', 0, '2018-04-25 04:48:47', '2018-04-25 04:48:47', '2019-04-25 07:48:47'),
('853412cb19fa52c5444fb4036b2fa1c5fc7815c2d6ca54af0818d7293ee360c3dec892f635f188a3', 3, 1, 'access_token', '[]', 0, '2018-04-29 04:51:21', '2018-04-29 04:51:21', '2019-04-29 07:51:21'),
('87b43f058168e7f380adddccbd34181062e5332cb10b8fbed3a45fab2cff163ec967ed9673119643', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:24:42', '2018-04-22 13:24:42', '2019-04-22 16:24:42'),
('898ef2b40f0130ff0618efa507171399d09def4f85a793d69543c716b0082f8dca1a018abeb7b586', 3, 1, 'access_token', '[]', 0, '2018-04-29 05:00:31', '2018-04-29 05:00:31', '2019-04-29 08:00:31'),
('89fb0647cd8c9322ba38b6fac13104a0a6da802166db59d6e18602e94543c0b2bde1e3f8f8429489', 11, 1, 'access_token', '[]', 1, '2018-05-01 09:08:33', '2018-05-01 09:08:33', '2019-05-01 12:08:33'),
('8a97141b9d5f10d8c58b34cb0d3fa7ebae30358a182f39f790d35a82b41b265d714615ce82a08809', 3, 1, 'access_token', '[]', 0, '2018-04-22 02:23:22', '2018-04-22 02:23:22', '2019-04-22 05:23:22'),
('8aef2d7374b2c8db77213af44a70bdaf9da15ba9ec2c9503c3db6e9581fefa0b4f31734bb7e68170', 1, 1, 'MyApp', '[]', 0, '2018-04-21 16:01:49', '2018-04-21 16:01:49', '2019-04-21 19:01:49'),
('8e88d4f97c3ec89c4e9fe4b5f20cc4035b67d16d65c8e87a4aeac753829b41c4196fc3c7ee5cec9b', 3, 1, 'MyApp', '[]', 0, '2018-04-22 02:17:34', '2018-04-22 02:17:34', '2019-04-22 05:17:34'),
('9377505be44b3968133202e9e585ecd28e959bcae245ff190d65525905c7e580cb7900e40e1cc4f4', 3, 1, 'access_token', '[]', 0, '2018-04-23 02:35:45', '2018-04-23 02:35:45', '2019-04-23 05:35:45'),
('9467e2a094c969a1ea0837af0a327539cc80e92d000840b1f644695dea8e7a0ac46def5335e3f603', 3, 1, 'access_token', '[]', 0, '2018-04-25 04:48:20', '2018-04-25 04:48:20', '2019-04-25 07:48:20'),
('99d20e298be5bd1ce20c149980368a3858b6a0664c12b1481591f361a6076aedc3ae2d4d5cc3160d', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:18:13', '2018-04-22 13:18:13', '2019-04-22 16:18:13'),
('9c8c38a62df11776a1f067205f269347101523a450225824fd20bd0c5bef401032ad280a197af31d', 3, 1, 'access_token', '[]', 0, '2018-04-25 04:46:56', '2018-04-25 04:46:56', '2019-04-25 07:46:56'),
('9d190d9aad2b28d185d2da71ac402b76ab21de8af7bf068852d9d65db32ee3cdcf39b5bb44acf91d', 3, 1, 'access_token', '[]', 0, '2018-04-29 04:51:05', '2018-04-29 04:51:05', '2019-04-29 07:51:05'),
('a2f5213bdbff297229801659b23e6955be0759ab97598c864423fb04983bc4a9e7b440775f671518', 3, 1, 'access_token', '[]', 0, '2018-04-29 04:50:08', '2018-04-29 04:50:08', '2019-04-29 07:50:08'),
('a31e731462c19916b32e7753cf5e82c86df3440bd37a266628e1c494c0e1ed19e704a2cd912f1170', 3, 1, 'access_token', '[]', 0, '2018-04-30 08:50:47', '2018-04-30 08:50:47', '2019-04-30 11:50:47'),
('a5e62791e6fbd8ceddfb614e518cb907315f6a7bf4e4eda6d2df37366890a9991f8ee82e658483a7', 3, 1, 'access_token', '[]', 0, '2018-04-29 05:35:17', '2018-04-29 05:35:17', '2019-04-29 08:35:17'),
('a6e917c2619433397ccbcb3442fede85afc839e76340e69093814c9d96cc30d456013560dee6d3eb', 3, 1, 'access_token', '[]', 0, '2018-04-25 04:49:20', '2018-04-25 04:49:20', '2019-04-25 07:49:20'),
('a811d13efbb90f73a917a1bb3c51eac17aa5c62a3f438d8ba4a255d0f077a23c7575a322566528f5', 3, 1, 'access_token', '[]', 0, '2018-05-01 09:13:55', '2018-05-01 09:13:55', '2019-05-01 12:13:55'),
('ab0b5dd943ec2267527c7d5d00adbcd532d58aa090529cefbb4876db1b226786d0af52e523dd8061', 3, 1, 'access_token', '[]', 0, '2018-05-01 12:18:47', '2018-05-01 12:18:47', '2019-05-01 15:18:47'),
('ad7f514c95b516d2ae30434239e22b2d375721e4f414fbc8aea1a0927d62181836c6aa949eda1f80', 3, 1, 'access_token', '[]', 0, '2018-05-01 12:18:26', '2018-05-01 12:18:26', '2019-05-01 15:18:26'),
('ae302543732ad4cd1efb07e702cd028caf52bf46ff40581f9e3a3403b97afdb5e0af6a2ac93d7662', 3, 1, 'access_token', '[]', 0, '2018-05-01 12:59:28', '2018-05-01 12:59:28', '2019-05-01 15:59:28'),
('aed414c847915f7595d76e0f43db42bdfea8c35f4a61c8aee172168a9e7b632a012d34289222204d', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:12:18', '2018-04-22 13:12:18', '2019-04-22 16:12:18'),
('af0c0c3ebbe8fdff463dd59e1f0bc72f3e8a07466a724edac01910f0c4d4951271c14d31c739e109', 3, 1, 'access_token', '[]', 0, '2018-04-25 04:55:37', '2018-04-25 04:55:37', '2019-04-25 07:55:37'),
('b457e5e09a453dd79a455cca686ae6806e383568c218e1144d9ebcd78d1918dd863097e44e38180e', 3, 1, 'access_token', '[]', 0, '2018-04-27 06:54:01', '2018-04-27 06:54:01', '2019-04-27 09:54:01'),
('b584f43ac2ab4aaf0666bf0faf62600e07e020a586f5c03508c563dddcb4ca840f49e2ec72bcf656', 3, 1, 'access_token', '[]', 1, '2018-05-01 10:09:03', '2018-05-01 10:09:03', '2019-05-01 13:09:03'),
('b6e81a2b3bbb3313a0bf5b66461cf6d21dd61fbff74e0edfe42e946464474ed2973c13dc8a5c7e9b', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:15:41', '2018-04-22 13:15:41', '2019-04-22 16:15:41'),
('b8986a2d095c8a721d2fd74c5cb95b2dd0f7eaf81136e70f6e41f2a2c236ba0ca941708c52a8b84e', 3, 1, 'access_token', '[]', 0, '2018-04-29 05:49:31', '2018-04-29 05:49:31', '2019-04-29 08:49:31'),
('b9aab757ddf5e7e1843724d8b571f2541301af9cd72827f6bfc761decdddd6c9cf14262a218ee6f6', 13, 1, 'access_token', '[]', 1, '2018-05-01 13:12:13', '2018-05-01 13:12:13', '2019-05-01 16:12:13'),
('ba0f3b26a632b5e1c060c6d9a03f5403c95804f22afa4b4e34a043f4aa609389a4925d12e8a7a953', 6, 1, 'access_token', '[]', 0, '2018-04-29 04:36:15', '2018-04-29 04:36:15', '2019-04-29 07:36:15'),
('ba567b1ab086d0120fab6ac9a79edd5600649d031410ebe7ea9106c255012af537e515419ec8c03d', 3, 1, 'MyApp', '[]', 0, '2018-04-22 02:19:17', '2018-04-22 02:19:17', '2019-04-22 05:19:17'),
('ba6b738f149dc91131f0b41aae52de68b228231513755ea4dc1a4c26f4227febb2bf65b5d4a4c440', 1, 1, 'MyApp', '[]', 0, '2018-04-21 15:39:17', '2018-04-21 15:39:17', '2019-04-21 18:39:17'),
('bc11ed88c436afc5c1c0b579637ff131d96801fed52170c69a0fc06e9b64af67f3a2d076b55ebc64', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:22:14', '2018-04-22 13:22:14', '2019-04-22 16:22:14'),
('bde7adc28f9bff6d432de6dd2d2819838ff2cee05cb9b36e3446afcfa66b91ac3078ccec76b7d7cb', 3, 1, 'access_token', '[]', 1, '2018-04-29 06:25:44', '2018-04-29 06:25:44', '2019-04-29 09:25:44'),
('bf8becf183d8d5479bb4beba66b3c0f39427d2a1bc5d6fab7333a9d407bce75dca65666829683d5c', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:22:36', '2018-04-22 13:22:36', '2019-04-22 16:22:36'),
('c09e7a802f8e03e635e01957c6048561029cf99d36e32698ca58eb317253213668dd428c9e1ab1bf', 10, 1, 'access_token', '[]', 0, '2018-05-01 09:07:10', '2018-05-01 09:07:10', '2019-05-01 12:07:10'),
('c2f366eacf58d5c27f8bc10c98ae1b72af81689e2f0879ec3843b5ac7c5bd63055c830884946d504', 3, 1, 'access_token', '[]', 0, '2018-04-25 04:36:20', '2018-04-25 04:36:20', '2019-04-25 07:36:20'),
('c46ff2e26f4a363820523370f2d3f077fe29d8cdb747df7770c19c5f0724bb6962d0cf279801cff1', 3, 1, 'access_token', '[]', 0, '2018-05-01 12:32:51', '2018-05-01 12:32:51', '2019-05-01 15:32:51'),
('c9a9039d257f28336028dc25ba1300882baade960811ffc5b9f1d108b18c3dd1e4b1987437deec06', 3, 1, 'access_token', '[]', 0, '2018-04-29 05:07:04', '2018-04-29 05:07:04', '2019-04-29 08:07:04'),
('ca11c4989f6a9282ab4e07fbafa0320af7d1174b17a33c7c2eccd61226c08abf937e0cefa872ff56', 3, 1, 'access_token', '[]', 0, '2018-05-01 12:26:53', '2018-05-01 12:26:53', '2019-05-01 15:26:53'),
('cb7c1f29b46e70cfd892b2c698752b73a379f37ad73a18175f49a529f6c344f775b773785ce82776', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:06:14', '2018-04-22 13:06:14', '2019-04-22 16:06:14'),
('cf1221aa823412b9adf75b66a279eab6e3b273aaf97fe7ac31c2d2a3289813e5c71a5651aef87024', 3, 1, 'access_token', '[]', 0, '2018-04-25 04:50:03', '2018-04-25 04:50:03', '2019-04-25 07:50:03'),
('d17b10d80e4040746c6d0a197bd93cf4d8fdc0c29d2fb9ddc1d3af4418212e79310c2a6f43d5467c', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:22:46', '2018-04-22 13:22:46', '2019-04-22 16:22:46'),
('d2b34aa448538a5395b0a61987ca8446ecde2f1ed14d391fec01cbb27f6c71fc9426a6d7e883e70b', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:39:21', '2018-04-22 13:39:21', '2019-04-22 16:39:21'),
('d48dc654ef437708110c18d552ecb62a003f91951567ce1c384d0ed9bb42ec1917f13f853dc8a6c5', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:20:14', '2018-04-22 13:20:14', '2019-04-22 16:20:14'),
('d5e0c73c7732ec4f8ab91de1e824e8386a7873fcc771eb93e5af9ebde78d44da3b314ab5e843bde1', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:25:27', '2018-04-22 13:25:27', '2019-04-22 16:25:27'),
('d7578eb67e100a108608755f7033a821fec2ed88939cbecab8ddf82981edfaf0eaafcc1597b21281', 3, 1, 'access_token', '[]', 0, '2018-05-01 12:25:10', '2018-05-01 12:25:10', '2019-05-01 15:25:10'),
('d792fbfa6c54bcfb7c8e9ba48c3c5d2ed8b6bc9c88bc92b20db94a7b8b085cffaf7c395400e5ea15', 4, 1, 'access_token', '[]', 0, '2018-04-27 07:06:41', '2018-04-27 07:06:41', '2019-04-27 10:06:41'),
('d8cb67b4191676ec94f07797b41e10157fe3fc0eea737bb5840843491634fa5e40a0ac5225b7a713', 3, 1, 'access_token', '[]', 0, '2018-05-01 12:24:07', '2018-05-01 12:24:07', '2019-05-01 15:24:07'),
('de4569c4e4433e0ed675b1f2de34ed62854d1d1f3988400327bca00b7daf056612f605aa2214505f', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:20:39', '2018-04-22 13:20:39', '2019-04-22 16:20:39'),
('e2aced6ee069cd6d18bb62a8d43e30c6a482a71a1648ca622d7cfed59f0a6e05278536ca68ca05cc', 3, 1, 'access_token', '[]', 0, '2018-04-25 04:32:04', '2018-04-25 04:32:04', '2019-04-25 07:32:04'),
('e75839a800a68cd50be986827dab25fef17e0d36b008c2b4e71b2d8710b3bda9f48f764f047eb48c', 3, 1, 'MyApp', '[]', 0, '2018-04-21 16:21:15', '2018-04-21 16:21:15', '2019-04-21 19:21:15'),
('e871a7f72a545860f02cea9ed6982794bbe68c2d50bf00b44f774bbe54961dc264db1211014e472c', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:25:01', '2018-04-22 13:25:01', '2019-04-22 16:25:01'),
('ee9ec6e2a13ec55e49d3dd3a9ed5bac4d2526d44e535a39b360fd9c09d6a5c1f91e45f70e11b2f4c', 3, 1, 'access_token', '[]', 0, '2018-05-01 13:23:29', '2018-05-01 13:23:29', '2019-05-01 16:23:29'),
('efce590c5a48de329c5c2e4d60a0eb62e054639a0468da5e4e873c9e60eff31cfe1669ba7c82c2c2', 3, 1, 'access_token', '[]', 0, '2018-04-29 05:40:42', '2018-04-29 05:40:42', '2019-04-29 08:40:42'),
('f147e255abd221dc48abccee290915f9671de930d49f83e589cf14c7ea8adc4f1e8981c4789a1483', 1, 1, 'MyApp', '[]', 0, '2018-04-22 02:17:07', '2018-04-22 02:17:07', '2019-04-22 05:17:07'),
('f4594da84226f4ffbc8c7ef1345215497855916e0396a9f9a31f770d9da29c741ba8468f03b5ba98', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:19:46', '2018-04-22 13:19:46', '2019-04-22 16:19:46'),
('f7e7ddff9fe61bf074ad750b9e5a447cd45d914c190bc65f382b8f14ba1e9b58281efb54755697b4', 3, 1, 'access_token', '[]', 0, '2018-04-27 06:54:46', '2018-04-27 06:54:46', '2019-04-27 09:54:46'),
('f904c567f44aabbdc9eb53eb72242082ec8c34bc23fbfe6d7bd3ae15ca579b5c3393cdb0478b47bf', 3, 1, 'access_token', '[]', 0, '2018-05-01 14:13:09', '2018-05-01 14:13:09', '2019-05-01 17:13:09'),
('fa95b3c70812405a550c9c12ad73b563d7a410b8f0f27c5b9259f677a83de09e80b2f1fa949cb645', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:27:14', '2018-04-22 13:27:14', '2019-04-22 16:27:14'),
('faaa058c4d6133ca1c544be074ff730e267066f13626e5dba89cad9e1c6fce93ed0707c07a1f2b43', 3, 1, 'access_token', '[]', 0, '2018-04-29 04:51:52', '2018-04-29 04:51:52', '2019-04-29 07:51:52'),
('fb4e95129c9f0b826ff079026d107b0ab47385d6338765f672a2f5eed042233ca1f50b7b5dbdad9a', 3, 1, 'access_token', '[]', 0, '2018-05-01 12:24:52', '2018-05-01 12:24:52', '2019-05-01 15:24:52'),
('ffd52c13ca7e26dd55d07d2294b4703bff7bc469d03d90b4484194f97bcc61948cb2b40c1482553b', 3, 1, 'access_token', '[]', 0, '2018-04-22 13:38:22', '2018-04-22 13:38:22', '2019-04-22 16:38:22');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'AXyHrDAqllxzRi40rLTvyByzYt8bwZzAfFWX9rAz', 'http://localhost', 1, 0, 0, '2018-04-21 11:16:56', '2018-04-21 11:16:56'),
(2, NULL, 'Laravel Password Grant Client', 'M05E5e9uPfl6SAmjjqEIefBLXXko2QWfqBiNObSr', 'http://localhost', 0, 1, 0, '2018-04-21 11:16:56', '2018-04-21 11:16:56');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2018-04-21 11:16:56', '2018-04-21 11:16:56');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('progress','complete') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'progress',
  `total_amount` int(11) NOT NULL DEFAULT '0',
  `payment_method` enum('cash','knet') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'cash',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `address`, `status`, `total_amount`, `payment_method`, `created_at`, `updated_at`, `deleted_at`) VALUES
(39, 3, 'kuwit', 'progress', 1800, 'knet', '2018-05-02 02:30:15', '2018-05-02 02:30:15', NULL),
(40, 3, 'kuwit', 'progress', 1800, 'knet', '2018-05-02 14:38:40', '2018-05-02 14:38:40', NULL),
(41, 3, 'kuwit', 'progress', 1500, 'knet', '2018-05-10 08:56:23', '2018-05-10 08:56:23', NULL),
(42, 3, 'kuwit', 'progress', 1500, 'knet', '2018-05-16 10:16:29', '2018-05-16 10:16:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `product_id`, `quantity`, `price`, `total`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 41, 6, 2, 500, 1000, '2018-05-10 08:56:23', '2018-05-10 08:56:23', NULL),
(2, 41, 7, 1, 500, 500, '2018-05-10 08:56:23', '2018-05-10 08:56:23', NULL),
(3, 42, 6, 2, 500, 1000, '2018-05-16 10:16:29', '2018-05-16 10:16:29', NULL),
(4, 42, 7, 1, 500, 500, '2018-05-16 10:16:29', '2018-05-16 10:16:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'about us', '2018-04-04 09:30:17', '2018-04-04 06:30:17'),
(2, 'Privacy policy', '2018-04-01 09:39:10', '0000-00-00 00:00:00'),
(3, 'Terms and Condition', '2018-04-01 09:39:25', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `page_translations`
--

CREATE TABLE `page_translations` (
  `id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `locale` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `page_translations`
--

INSERT INTO `page_translations` (`id`, `page_id`, `locale`, `text`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', '<p>Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry. Lorem Ipsum Has Been The Industry&#39;s Standard Dummy Text Ever Since The 1500s, When An Unknown Printer Took A Galley Of Type And Scrambled It To Make A Type Specimen Book. It Has Survived Not Only Five Centuries, But Also The Leap Into Electronic Typesetting, Remaining Essentially Unchanged. It Was Popularised In The 1960s With The Release Of Letraset Sheets Containing Lorem Ipsum Passages, And More Recently With Desktop Publishing Software Like Aldus PageMaker Including Versions Of Lorem Ipsum</p>', '2018-04-29 09:47:11', '2018-04-29 06:47:11'),
(2, 1, 'ar', '<p>عن الشركة عن الشركة عن الشركة عن الشركة عن الشركة عن الشركة عن الشركة عن الشركة عن الشركة عن الشركة عن الشركة عن الشركة عن الشركة&nbsp;</p>', '2018-04-29 09:47:11', '2018-04-29 06:47:11'),
(3, 2, 'en', '<p><strong>Privacy Notice</strong></p>\r\n\r\n<p><strong>Effective Date:&nbsp; August 1, 2014</strong></p>\r\n\r\n<p>This Privacy Notice Discloses The Privacy Practices For&nbsp;<strong>[Your Company Name Here]&nbsp;</strong>and Our Website; Http://www.&nbsp;<strong>[Your Website URL Here].</strong>&nbsp;This Privacy Notice Applies Solely To Information Collected By This Website, Except Where Stated Otherwise. It Will Notify You Of The Following:</p>\r\n\r\n<p><strong>Information Collection, Use, And Sharing</strong>&nbsp;<br />\r\n<br />\r\nWe Are The Sole Owners Of The Information Collected On This Site. We Only Have Access To/collect Information That You Voluntarily Give Us Via Email Or Other Direct Contact From You. We Will Not Sell Or Rent This Information To Anyone.&nbsp;</p>\r\n\r\n<p>We Will Use Your Information To Respond To You, Regarding The Reason You Contacted Us. We Will Not Share Your Information With Any Third Party Outside Of Our Organization, Other Than As Necessary To Fulfill Your Request, E.g., To Ship An Order.</p>\r\n\r\n<p>Unless You Ask Us Not To, We May Contact You Via Email In The Future To Tell You About Specials, New Products Or Services, Or Changes To This Privacy Policy.&nbsp;</p>\r\n\r\n<p><strong>Your Access To And Control Over Information</strong>&nbsp;</p>', '2018-04-22 13:06:29', '2018-04-22 10:06:29'),
(4, 2, 'ar', '<p>سياسة الخصوصية&nbsp;سياسة الخصوصية&nbsp;سياسة الخصوصية&nbsp;سياسة الخصوصية&nbsp;سياسة الخصوصية&nbsp;سياسة الخصوصية&nbsp;سياسة الخصوصية&nbsp;سياسة الخصوصية&nbsp;سياسة الخصوصية&nbsp;سياسة الخصوصية&nbsp;سياسة الخصوصية&nbsp;سياسة الخصوصية&nbsp;سياسة الخصوصية&nbsp;سياسة الخصوصية&nbsp;سياسة الخصوصية&nbsp;سياسة الخصوصية&nbsp;سياسة الخصوصية&nbsp;سياسة الخصوصية&nbsp;سياسة الخصوصية&nbsp;سياسة الخصوصية&nbsp;سياسة الخصوصية&nbsp;سياسة الخصوصية&nbsp;سياسة الخصوصية&nbsp;سياسة الخصوصية&nbsp;سياسة الخصوصية&nbsp;سياسة الخصوصية&nbsp;سياسة الخصوصية&nbsp;سياسة الخصوصية&nbsp;سياسة الخصوصية&nbsp;سياسة الخصوصية&nbsp;</p>', '2018-04-22 13:06:29', '2018-04-22 10:06:29'),
(5, 3, 'en', '<p>Terms And Condition Terms And Condition Terms And Condition</p>', '2018-04-04 09:38:34', '2018-04-04 06:38:34'),
(6, 3, 'ar', '<p>الاحكام و الشروط الاحكام و الشروط الاحكام و الشروط الاحكام و الشروط الاحكام و الشروط الاحكام و الشروط الاحكام و الشروط الاحكام و الشروط الاحكام و الشروط الاحكام و الشروط الاحكام و الشروط الاحكام و الشروط</p>', '2018-04-04 09:38:34', '2018-04-04 06:38:34');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('momen@gmail.com', '$2y$10$GRlyC.Yl8VJTX5ml7VSMaedxpoiAhvThznTLSHv/MpZjKjUaU3BV2', '2018-05-02 07:13:57');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `cover_image` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `sub_category_id` int(11) NOT NULL DEFAULT '0',
  `product_type_id` int(11) NOT NULL DEFAULT '0',
  `brand_id` int(11) NOT NULL DEFAULT '0',
  `highlight` int(11) NOT NULL DEFAULT '0',
  `price` int(11) DEFAULT NULL,
  `old_price` int(11) DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `createdBy` int(11) NOT NULL DEFAULT '0',
  `status` enum('active','not_active') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `cover_image`, `category_id`, `sub_category_id`, `product_type_id`, `brand_id`, `highlight`, `price`, `old_price`, `views`, `createdBy`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'uploads/images/products/yCwTnFvuiGRe5r0WfkPeCAUNEdCDN17dHlh09Jmh.png', 2, 6, 5, 3, 0, 500, 650, 0, 0, 'active', '2018-05-03 08:23:51', '2018-05-03 08:43:24', NULL),
(7, 'uploads/images/products/MeO2Ox4aLRgvifAfSDWSYuOeNAZxGj5KKHmeDxFH.jpeg', 1, 10, 1, 1, 0, 500, 350, 0, 0, 'active', '2018-05-03 08:44:15', '2018-05-03 08:50:15', NULL),
(8, 'uploads/images/products/lZqhaZJv02MthraJgv9bXWeQpw03Z1K2NFxkvtIz.jpeg', 1, 10, 1, 1, 0, 500, 650, 0, 0, 'active', '2018-05-03 08:51:22', '2018-05-03 08:51:40', NULL),
(9, 'uploads/images/products/EgN2KVT0c3BfwMxe3qyadLyUm8gP8o7W8Vy3CB6m.jpeg', 4, 9, 2, 2, 0, 800, 1000, 0, 0, 'active', '2018-05-06 04:45:09', '2018-05-06 04:45:09', NULL),
(10, 'uploads/images/products/PhthnGjqF6xADvR9kuuI5qvICP8lXaaML4CQUZRL.jpeg', 1, 10, 1, 1, 0, 600, NULL, 0, 0, 'active', '2018-05-08 03:51:56', '2018-05-08 03:51:56', NULL),
(11, 'uploads/images/products/dfvjdG5CYfllokMQQy3USVbAnmEZzBYGnmtGkhMb.jpeg', 1, 10, 1, 1, 0, 600, NULL, 0, 0, 'active', '2018-05-08 03:54:31', '2018-05-08 03:54:31', NULL),
(12, 'uploads/images/products/VFcDfcUmWD3mBfSrcuTwCvOCccSRbc7YZYdcl0gw.jpeg', 1, 10, 1, 1, 0, 600, NULL, 0, 0, 'active', '2018-05-08 03:54:53', '2018-05-08 03:54:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `image` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `image`, `product_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(32, 'uploads/images/products/images/mRgIun0SmU65bqMMBoAo3oBDpjK1rfnMuF2tOzur.jpeg', 6, '2018-05-03 11:23:51', '2018-05-03 08:31:25', '2018-05-03 08:31:25'),
(33, 'uploads/images/products/images/5PO71fkoq7VQI4TkNK5XRDr4h4O5ILHG8pQuLO1R.jpeg', 6, '2018-05-03 11:23:51', '2018-05-03 08:31:23', '2018-05-03 08:31:23'),
(34, 'uploads/images/products/images/X4PkW4ouBDgBGPvaM9HV3ooIPlpzDwkEXXJ8eAQL.jpeg', 6, '2018-05-03 11:23:51', '2018-05-03 08:32:03', '2018-05-03 08:32:03'),
(35, 'uploads/images/company/images/8UO4glMVBrDPaMlpfrZO2y6DoUwwOKg1KPnqRRza.jpeg', 6, '2018-05-03 11:26:35', '2018-05-03 08:31:18', '2018-05-03 08:31:18'),
(36, 'uploads/images/company/images/dtmax6M74Q8UloN3FNmRrCBPwmjXtpnwGetw6hBp.jpeg', 6, '2018-05-03 11:32:14', '2018-05-03 08:33:15', '2018-05-03 08:33:15'),
(37, 'uploads/images/company/images/czjum0K3mrNC4HBDbj4d0zLim6U4UeXZOUDsgQza.jpeg', 6, '2018-05-03 11:32:14', '2018-05-03 08:33:10', '2018-05-03 08:33:10'),
(38, 'uploads/images/company/images/HAMcVHsvbB9el5QquLNINsCsH3VWyTaZkBFNlb6B.jpeg', 6, '2018-05-03 11:32:14', '2018-05-03 08:33:13', '2018-05-03 08:33:13'),
(39, 'uploads/images/products/images/BkEpVkb8QdYbSIxgJaWtOg1YAl1QdovJuaEhiD5w.jpeg', 6, '2018-05-03 11:35:35', '2018-05-03 08:43:24', '2018-05-03 08:43:24'),
(40, 'uploads/images/products/images/Uk76PJS00BCHgKaA7JWUVBHmhZ7eBX5MAyHN7le2.jpeg', 6, '2018-05-03 11:35:35', '2018-05-03 08:35:50', '2018-05-03 08:35:50'),
(41, 'uploads/images/products/images/81XizJ6J6eAbR3X2lYWktwlexTqIAea400nNoJaS.jpeg', 6, '2018-05-03 11:35:35', '2018-05-03 08:43:24', '2018-05-03 08:43:24'),
(42, 'uploads/images/products/images/r41sFdQ79U3Xgufc64DaCqswhLrc0dJCoWlaJL0R.png', 7, '2018-05-03 11:44:15', '2018-05-03 08:50:15', '2018-05-03 08:50:15'),
(43, 'uploads/images/products/images/5ovx1V6gBaLmQ1h2XKw0DJ9Q19cdPZ9czDGPcbqP.png', 7, '2018-05-03 11:44:15', '2018-05-03 08:50:06', '2018-05-03 08:50:06'),
(44, 'uploads/images/products/images/Q1Tkv0KBz1KRAfZdMZ4hPEgJ9nXZpoZDkNyIqP4M.jpeg', 7, '2018-05-03 11:44:15', '2018-05-03 08:50:15', '2018-05-03 08:50:15'),
(45, 'uploads/images/products/images/Uh33CPEcHba4BsM6yvldZIRzQyV6xFkXHvb3SenB.png', 8, '2018-05-03 11:51:22', NULL, NULL),
(46, 'uploads/images/products/images/dlArYgicowKAf9a0jqwUIOLDF8ZV91QHITVo4cMK.png', 8, '2018-05-03 11:51:22', NULL, NULL),
(47, 'uploads/images/products/images/80CZlErm8e2CKZYXDTUXU4oCZaxGJKQOHXndxSJb.jpeg', 8, '2018-05-03 11:51:22', NULL, NULL),
(48, 'uploads/images/products/images/yoENrEC0y9gt4SGejmbcLiXwWCK8l3CvFr8EOL1y.png', 9, '2018-05-06 07:45:09', NULL, NULL),
(49, 'uploads/images/products/images/jtKlWBY7ujrWKYGb7RHtKAUYwAHgTQpAjKAExRSi.jpeg', 9, '2018-05-06 07:45:09', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_translations`
--

CREATE TABLE `product_translations` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `locale` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_translations`
--

INSERT INTO `product_translations` (`id`, `product_id`, `locale`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'en', 'Work 01', 'description 01', '2018-01-24 11:37:13', '2018-04-24 10:15:31', NULL),
(2, 1, 'ar', 'منتج 01', 'وصف 01', '2018-01-24 11:37:18', '0000-00-00 00:00:00', NULL),
(3, 2, 'en', 'Work 02', 'description 02', '2018-01-24 11:37:27', '2018-04-29 16:13:34', NULL),
(25, 2, 'ar', 'منتج 02', 'وصف 02', '2018-04-23 08:42:22', '0000-00-00 00:00:00', NULL),
(26, 3, 'en', 'Work 03', 'description 03', '2018-04-23 08:43:02', '2018-04-29 16:13:47', NULL),
(27, 3, 'ar', 'منتج 03', 'وصف 03', '2018-04-23 08:43:08', '0000-00-00 00:00:00', NULL),
(28, 28, 'en', 'Test', 'description', '2018-04-23 08:41:04', '2018-04-23 08:41:04', NULL),
(29, 28, 'ar', 'اختبار', 'الوصف', '2018-04-23 08:41:04', '2018-04-23 08:41:04', NULL),
(30, 29, 'en', 'Test', 'description', '2018-04-23 08:44:39', '2018-04-23 08:44:39', NULL),
(31, 29, 'ar', 'اختبار', 'الوصف', '2018-04-23 08:44:39', '2018-04-23 08:44:39', NULL),
(32, 30, 'en', 'Test', 'description', '2018-04-23 08:48:31', '2018-04-23 08:48:31', NULL),
(33, 30, 'ar', 'اختبار', 'الوصف', '2018-04-23 08:48:31', '2018-04-23 08:48:31', NULL),
(34, 31, 'en', 'Test', 'description', '2018-04-23 08:51:22', '2018-04-23 08:51:22', NULL),
(35, 31, 'ar', 'اختبار', 'الوصف', '2018-04-23 08:51:22', '2018-04-23 08:51:22', NULL),
(36, 32, 'en', 'Test', 'description', '2018-04-23 08:51:46', '2018-04-23 08:51:46', NULL),
(37, 32, 'ar', 'رسوم متحركة', 'الوصف', '2018-04-23 08:51:46', '2018-04-23 08:51:46', NULL),
(38, 33, 'en', 'Test', 'description', '2018-04-23 08:52:30', '2018-04-23 08:52:30', NULL),
(39, 33, 'ar', 'رسوم متحركة', 'الوصف', '2018-04-23 08:52:30', '2018-04-23 08:52:30', NULL),
(40, 34, 'en', 'Test1', 'description1', '2018-04-23 09:01:34', '2018-04-23 09:57:57', NULL),
(41, 34, 'ar', 'اختبار1', 'الوصف1', '2018-04-23 09:01:34', '2018-04-23 09:57:57', NULL),
(42, 35, 'en', 'Samsung - S8', 'description1 fryutiyoup', '2018-04-24 10:12:33', '2018-04-24 10:12:33', NULL),
(43, 35, 'ar', 'سامسونج - اس 8', 'وصف 01 عليعان', '2018-04-24 10:12:33', '2018-04-24 10:12:33', NULL),
(44, 36, 'en', 'Work 01', 'product 01  product 01', '2018-04-25 04:13:02', '2018-04-25 04:13:02', NULL),
(45, 36, 'ar', 'منتج 01', 'منتج 01  منتج 01', '2018-04-25 04:13:03', '2018-04-25 04:13:03', NULL),
(46, 37, 'en', 'Test', 'description', '2018-04-25 08:25:24', '2018-04-25 08:25:24', NULL),
(47, 37, 'ar', 'اختبار', 'الوصف', '2018-04-25 08:25:24', '2018-04-29 08:29:37', NULL),
(48, 38, 'en', 'Test', 'description', '2018-04-29 08:29:51', '2018-04-29 08:29:51', NULL),
(49, 38, 'ar', 'اختبار', 'الوصف', '2018-04-29 08:29:51', '2018-04-29 08:29:51', NULL),
(50, 39, 'en', 'Test', 'enen', '2018-04-29 08:32:35', '2018-04-29 08:32:35', NULL),
(51, 39, 'ar', 'اختبار', 'arar', '2018-04-29 08:32:35', '2018-04-29 08:32:35', NULL),
(52, 40, 'en', 'Test', 'description', '2018-04-29 08:36:53', '2018-04-29 08:36:53', NULL),
(53, 40, 'ar', 'رسوم متحركة', 'الوصف', '2018-04-29 08:36:53', '2018-04-29 08:36:53', NULL),
(54, 5, 'en', 'One SIM', 'description1', '2018-04-29 09:42:33', '2018-04-29 09:42:33', NULL),
(55, 5, 'ar', 'شريحة واحدة', 'الوصف1', '2018-04-29 09:42:33', '2018-04-29 09:42:33', NULL),
(56, 4, 'en', 'Tow SIM', 'description 02', '2018-04-29 09:43:22', '2018-04-29 09:43:22', NULL),
(57, 4, 'ar', 'شريحتين', 'وصف 02', '2018-04-29 09:43:22', '2018-04-29 09:43:22', NULL),
(58, 6, 'en', 'Test', 'description', '2018-05-03 08:23:51', '2018-05-03 08:23:51', NULL),
(59, 6, 'ar', 'اختبار', 'الوصف', '2018-05-03 08:23:51', '2018-05-03 08:23:51', NULL),
(60, 7, 'en', 'Test', 'description', '2018-05-03 08:44:15', '2018-05-03 08:44:15', NULL),
(61, 7, 'ar', 'اختبار', 'الوصف', '2018-05-03 08:44:15', '2018-05-03 08:44:15', NULL),
(62, 8, 'en', 'Test', 'description', '2018-05-03 08:51:22', '2018-05-03 08:51:22', NULL),
(63, 8, 'ar', 'اختبار', 'الوصف', '2018-05-03 08:51:22', '2018-05-03 08:51:22', NULL),
(64, 9, 'en', 'J7 2017', 'j7 2017  j7 2017 j7 2017', '2018-05-06 04:45:09', '2018-05-06 04:45:09', NULL),
(65, 9, 'ar', 'ج 7 2017', 'ج 7 2017 ج 7 2017 ج 7 2017', '2018-05-06 04:45:09', '2018-05-06 04:45:09', NULL),
(66, 10, 'en', 'Test', 'description', '2018-05-08 03:51:56', '2018-05-08 03:51:56', NULL),
(67, 10, 'ar', 'اختبار', 'وصف', '2018-05-08 03:51:56', '2018-05-08 03:51:56', NULL),
(68, 11, 'en', 'Test', 'description', '2018-05-08 03:54:31', '2018-05-08 03:54:31', NULL),
(69, 11, 'ar', 'اختبار', 'وصف', '2018-05-08 03:54:31', '2018-05-08 03:54:31', NULL),
(70, 12, 'en', 'Test', 'description', '2018-05-08 03:54:53', '2018-05-08 03:54:53', NULL),
(71, 12, 'ar', 'اختبار', 'وصف', '2018-05-08 03:54:53', '2018-05-08 03:54:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE `product_types` (
  `id` int(11) NOT NULL,
  `status` enum('active','not_active') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `createdBy` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`id`, `status`, `createdBy`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'active', 1, '2018-01-25 14:32:55', '2018-04-24 10:07:32', NULL),
(2, 'active', 1, '2018-02-14 08:24:34', '2018-04-29 14:28:09', NULL),
(3, 'active', 1, '2018-04-24 09:46:28', '2018-04-24 09:49:57', '2018-04-24 09:49:57'),
(4, 'active', 1, '2018-04-24 09:46:46', '2018-04-24 09:50:17', '2018-04-24 09:50:17'),
(5, 'active', 1, '2018-04-25 03:59:02', '2018-04-25 03:59:02', NULL),
(6, 'active', 1, '2018-04-25 04:02:16', '2018-04-25 04:02:16', NULL),
(7, 'active', 1, '2018-04-25 04:02:28', '2018-04-25 04:02:28', NULL),
(8, 'active', 1, '2018-04-25 04:03:28', '2018-04-25 04:03:28', NULL),
(9, 'active', 1, '2018-04-25 04:04:15', '2018-04-29 14:28:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_type_translations`
--

CREATE TABLE `product_type_translations` (
  `id` int(11) NOT NULL,
  `product_type_id` int(11) NOT NULL,
  `locale` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_type_translations`
--

INSERT INTO `product_type_translations` (`id`, `product_type_id`, `locale`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'en', 'One SIM', '2018-01-25 14:33:10', '2018-04-24 10:07:32', NULL),
(2, 1, 'ar', 'شريحة واحدة', '2018-01-25 14:33:13', '2018-04-24 10:07:32', NULL),
(3, 2, 'en', 'tow SIM', '2018-02-14 08:24:34', '2018-02-14 08:26:04', NULL),
(4, 2, 'ar', 'شريحتين', '2018-02-14 08:24:34', '2018-02-14 08:26:05', NULL),
(5, 3, 'en', 'Test', '2018-04-24 09:46:28', '2018-04-24 09:46:28', NULL),
(6, 3, 'ar', 'اختبار', '2018-04-24 09:46:28', '2018-04-24 09:46:28', NULL),
(7, 4, 'en', 'Test11', '2018-04-24 09:46:46', '2018-04-24 09:46:46', NULL),
(8, 4, 'ar', 'اختبار11', '2018-04-24 09:46:46', '2018-04-24 09:46:46', NULL),
(9, 5, 'en', 'Headphones Bluetooth', '2018-04-25 03:59:02', '2018-04-25 03:59:02', NULL),
(10, 5, 'ar', 'سماعات بلوتوث', '2018-04-25 03:59:02', '2018-04-25 03:59:02', NULL),
(11, 6, 'en', 'Battery', '2018-04-25 04:02:16', '2018-04-25 04:02:16', NULL),
(12, 6, 'ar', 'بطاريات خارجية', '2018-04-25 04:02:16', '2018-04-25 04:02:16', NULL),
(13, 7, 'en', 'Covers', '2018-04-25 04:02:28', '2018-04-25 04:02:28', NULL),
(14, 7, 'ar', 'كفرات', '2018-04-25 04:02:28', '2018-04-25 04:02:28', NULL),
(15, 8, 'en', 'Protect  Screen', '2018-04-25 04:03:28', '2018-04-25 04:03:28', NULL),
(16, 8, 'ar', 'حماية الشاشة', '2018-04-25 04:03:28', '2018-04-25 04:03:28', NULL),
(17, 9, 'en', 'Watches', '2018-04-25 04:04:15', '2018-04-29 14:27:34', NULL),
(18, 9, 'ar', 'ساعات', '2018-04-25 04:04:15', '2018-04-29 14:27:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `key` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`key`, `value`) VALUES
('longitude', '151.24849689999996'),
('latitude', '-33.8145575'),
('facebook', 'http://www.facebook.com'),
('twitter', 'http://www.twitter.com'),
('youtube', 'http://www.youtube.com'),
('mobile', '0592887717'),
('phone', '082806861'),
('email', 'kamel@gmail.com'),
('max_file_size', '2048'),
('files_extension', 'jpeg'),
('login_tries', '3'),
('Delivery_cost', '15'),
('ios', 'http://www.ios.com'),
('android', 'http://android.com');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `image` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `createdBy` int(11) NOT NULL,
  `status` enum('active','not_active') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `order_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `createdBy`, `status`, `order_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '/uploads/images/sliders/1.jpg', 1, 'active', 1, '2018-01-25 14:44:41', '2018-04-24 05:45:54', '2018-04-24 05:45:54'),
(2, 'uploads/images/sliders/LvzPjuqTFQawk2Z6Y9z2eWPUBSW5gMGiuGlfUgLA.jpeg', 1, 'not_active', 0, '2018-02-14 11:11:22', '2018-04-24 05:40:06', '2018-04-24 05:40:06'),
(3, 'uploads/images/sliders/XpHID3BaUc2GO0Q0CHa5kRvInLadgTjueEzp94T4.jpeg', 1, 'active', 0, '2018-02-14 11:12:57', '2018-04-24 05:40:06', '2018-04-24 05:40:06'),
(4, 'uploads/images/sliders/56FT5V89DT2izdvjVucJlR5d0dDhQIhb9PiI58ql.jpeg', 1, 'active', 2, '2018-02-14 11:13:41', '2018-04-24 05:40:06', '2018-04-24 05:40:06'),
(5, 'uploads/images/sliders/JWf6Ru9lpQU4XfRINBfWGumjrFobR8YyBqWzxcoV.jpeg', 2, 'active', 1, '2018-02-14 13:04:29', '2018-04-24 05:40:06', '2018-04-24 05:40:06'),
(6, 'uploads/images/sliders/9hAZLNVh9DHAemg7UXuNyuwc3SPitK5yajDMtzhX.jpeg', 2, 'active', 0, '2018-02-25 08:13:54', '2018-04-24 05:40:06', '2018-04-24 05:40:06'),
(7, 'uploads/images/sliders/HvzffKSF53UmeczEALnxYPiNbSoTM17dOy3iLgtM.jpeg', 1, 'active', 0, '2018-03-11 10:04:26', '2018-04-24 05:40:06', '2018-04-24 05:40:06'),
(8, 'uploads/images/sliders/ixVHjtklcjRAu4TmdgX7Cs4gZsevZNplhvDE6ekX.jpeg', 1, 'not_active', 3, '2018-04-20 18:09:20', '2018-04-26 04:51:18', '2018-04-26 04:51:18'),
(9, 'uploads/images/sliders/GghOKoylVfJukfx2G8AsBKEJODfcGHtqoMQWGrpM.jpeg', 1, 'active', 2, '2018-04-24 05:44:48', '2018-04-29 03:04:48', NULL),
(10, 'uploads/images/sliders/JVEcm6bpBZvZwq3sx5Da6L44gvmyJ9tacF9gbaYc.jpeg', 1, 'active', 0, '2018-04-24 05:49:07', '2018-05-03 07:13:10', NULL),
(11, 'uploads/images/sliders/pkEMGPprZZlVdr2LNjwNbZwD67pIbmfReIlyCS62.jpeg', 1, 'active', 5, '2018-05-03 07:13:39', '2018-05-03 07:13:47', '2018-05-03 07:13:47');

-- --------------------------------------------------------

--
-- Table structure for table `slider_translations`
--

CREATE TABLE `slider_translations` (
  `id` int(11) NOT NULL,
  `slider_id` int(11) NOT NULL,
  `locale` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slider_translations`
--

INSERT INTO `slider_translations` (`id`, `slider_id`, `locale`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'en', 'Slider #1', '2018-01-25 14:47:15', '0000-00-00 00:00:00', NULL),
(2, 1, 'ar', 'سلايدر #1', '2018-01-25 14:47:18', '0000-00-00 00:00:00', NULL),
(3, 2, 'en', 'A1', '2018-02-14 11:11:22', '2018-02-14 11:11:22', NULL),
(4, 2, 'ar', 'A2', '2018-02-14 11:11:22', '2018-02-14 11:11:22', NULL),
(5, 3, 'en', 'A1', '2018-02-14 11:12:57', '2018-02-14 11:12:57', NULL),
(6, 3, 'ar', 'A2', '2018-02-14 11:12:57', '2018-02-14 11:12:57', NULL),
(7, 4, 'en', 'A7a', '2018-02-14 11:13:41', '2018-02-14 11:13:41', NULL),
(8, 4, 'ar', 'A7a1', '2018-02-14 11:13:41', '2018-02-14 11:13:41', NULL),
(9, 5, 'en', '25', '2018-02-14 13:04:29', '2018-02-14 13:05:07', NULL),
(10, 5, 'ar', '35', '2018-02-14 13:04:29', '2018-02-14 13:05:07', NULL),
(11, 6, 'en', 'Pariatur Ad Soluta Quibusdam', '2018-02-25 08:13:54', '2018-02-25 08:13:54', NULL),
(12, 6, 'ar', '59595', '2018-02-25 08:13:54', '2018-02-25 08:13:54', NULL),
(13, 7, 'en', 'Sit Occaecat Reiciendis Repellendus', '2018-03-11 10:04:26', '2018-03-11 10:04:26', NULL),
(14, 7, 'ar', 'Excepturi Quo Non Quas Est Est Exerci', '2018-03-11 10:04:26', '2018-03-11 10:04:26', NULL),
(15, 8, 'en', 'Test1', '2018-04-20 18:09:20', '2018-04-20 18:13:27', NULL),
(16, 8, 'ar', 'اختبار1', '2018-04-20 18:09:20', '2018-04-20 18:13:27', NULL),
(17, 9, 'en', 'Test', '2018-04-24 05:44:48', '2018-04-24 05:44:48', NULL),
(18, 9, 'ar', 'اختبار', '2018-04-24 05:44:48', '2018-04-24 05:44:48', NULL),
(19, 10, 'en', 'Test1', '2018-04-24 05:49:07', '2018-04-24 05:49:07', NULL),
(20, 10, 'ar', 'اختبار11', '2018-04-24 05:49:07', '2018-04-24 05:49:07', NULL),
(21, 11, 'en', 'Test', '2018-05-03 07:13:39', '2018-05-03 07:13:39', NULL),
(22, 11, 'ar', 'اختبار', '2018-05-03 07:13:39', '2018-05-03 07:13:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `createdBy` int(11) NOT NULL,
  `status` enum('active','not_active') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `image`, `createdBy`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'uploads/images/SubCategory/s96FxEQ78jccRmvsM5TS7pLjtJp7qpYBU1v8B4Qj.png', 1, 'active', '2018-04-23 06:17:14', '2018-04-25 03:42:23', '2018-04-25 03:42:23'),
(2, 1, 'uploads/images/subcategory/cat2.png', 1, 'active', '2018-04-23 12:32:25', '2018-04-25 03:42:27', '2018-04-25 03:42:27'),
(3, 2, 'uploads/images/SubCategory/iJfKJ3qF4iu39bi0xZoCN9oAqFlOaS6arabnSANl.jpeg', 1, 'active', '2018-04-24 07:35:55', '2018-04-25 03:42:30', '2018-04-25 03:42:30'),
(4, 3, 'uploads/images/SubCategory/SyZD60hTIMxe77pHVHGwPGee9fDHi8F6ZZh8lExX.jpeg', 1, 'active', '2018-04-25 03:45:06', '2018-04-25 03:45:06', NULL),
(5, 3, 'uploads/images/SubCategory/6w52joHnPbgtLttIWTc6aHW5ABiNdtM5WAyHUiaC.jpeg', 1, 'active', '2018-04-25 03:48:04', '2018-04-25 03:48:04', NULL),
(6, 2, 'uploads/images/SubCategory/xUgXWkFAm8iY4nMcmbVlqg6evoWKoORsTFpvb2V9.jpeg', 1, 'active', '2018-04-25 03:49:19', '2018-04-25 03:49:19', NULL),
(7, 2, 'uploads/images/SubCategory/eNtvOjXVaHxQRhI6sZnKg4h0U43SMOFguKN0bSFo.jpeg', 1, 'active', '2018-04-25 03:50:42', '2018-04-25 03:50:42', NULL),
(8, 4, 'uploads/images/SubCategory/de0j7K3PmH8bz5UDaV0Sktu4u5lYJOi3icSWHF0t.jpeg', 1, 'active', '2018-04-25 03:51:57', '2018-04-25 03:51:57', NULL),
(9, 4, 'uploads/images/SubCategory/Sldp6uFMscMkWtemNLyjRGHL6uJjrHnoib8i8u1a.jpeg', 1, 'active', '2018-04-25 03:52:53', '2018-04-25 03:52:53', NULL),
(10, 1, 'uploads/images/SubCategory/PYTJ1Q1z6qHY7djRSnu7tyjS5FafuUCzLxCdfP5O.jpeg', 1, 'active', '2018-04-25 03:55:16', '2018-04-25 03:55:16', NULL),
(11, 1, 'uploads/images/SubCategory/WN7BIWld2zGu2CmIQNt1p9ONGOGrso0Frlw6gkBY.jpeg', 1, 'active', '2018-04-25 03:56:28', '2018-05-03 07:33:01', '2018-05-03 07:33:01');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category_translations`
--

CREATE TABLE `sub_category_translations` (
  `id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `locale` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sub_category_translations`
--

INSERT INTO `sub_category_translations` (`id`, `sub_category_id`, `locale`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'en', 'Sub Cat 01', '2018-04-23 06:18:28', '2018-04-24 07:50:01', NULL),
(2, 1, 'ar', 'تصنيف فرعي 11', '2018-04-23 06:18:28', '2018-04-24 07:50:01', NULL),
(3, 2, 'en', 'Sub Cat 02', '2018-04-23 12:32:47', '0000-00-00 00:00:00', NULL),
(4, 2, 'ar', 'تصنيف فرعي 02', '2018-04-23 12:32:54', '0000-00-00 00:00:00', NULL),
(5, 3, 'en', 'Sub Cat 03', '2018-04-24 07:35:55', '2018-04-24 07:35:55', NULL),
(6, 3, 'ar', 'تصنيف فرعي 03', '2018-04-24 07:35:55', '2018-04-24 07:35:55', NULL),
(7, 4, 'en', 'Iphone 5 S', '2018-04-25 03:45:06', '2018-04-25 03:45:06', NULL),
(8, 4, 'ar', 'ايفون 5 اس', '2018-04-25 03:45:06', '2018-04-25 03:45:06', NULL),
(9, 5, 'en', 'Iphone 8 Plus', '2018-04-25 03:48:04', '2018-04-25 03:48:04', NULL),
(10, 5, 'ar', 'ايفون 8 بلس', '2018-04-25 03:48:04', '2018-04-25 03:48:04', NULL),
(11, 6, 'en', 'Samsung Edge 8 Plus', '2018-04-25 03:49:19', '2018-04-25 03:49:19', NULL),
(12, 6, 'ar', 'سامسونج 8 ايدج بلس', '2018-04-25 03:49:19', '2018-04-25 03:49:19', NULL),
(13, 7, 'en', 'Samsung Note 5', '2018-04-25 03:50:42', '2018-04-25 03:50:42', NULL),
(14, 7, 'ar', 'سامسونج نوت 5', '2018-04-25 03:50:42', '2018-04-25 03:50:42', NULL),
(15, 8, 'en', 'Nokia N 95', '2018-04-25 03:51:57', '2018-04-25 03:51:57', NULL),
(16, 8, 'ar', 'نوكيا ان 95', '2018-04-25 03:51:57', '2018-04-25 03:51:57', NULL),
(17, 9, 'en', 'Nokia N 8', '2018-04-25 03:52:53', '2018-04-25 03:52:53', NULL),
(18, 9, 'ar', 'نوكيا ان 8', '2018-04-25 03:52:53', '2018-04-25 03:52:53', NULL),
(19, 10, 'en', 'Nexus 4', '2018-04-25 03:55:16', '2018-04-25 03:55:16', NULL),
(20, 10, 'ar', 'نكسوس 4', '2018-04-25 03:55:16', '2018-04-25 03:55:16', NULL),
(21, 11, 'en', 'Nexus 10', '2018-04-25 03:56:28', '2018-04-25 03:56:28', NULL),
(22, 11, 'ar', 'نكسوس 10', '2018-04-25 03:56:28', '2018-04-25 03:56:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `status` enum('active','not_active') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `createdBy`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'active', '2018-01-16 08:13:44', '2018-02-13 13:57:44', NULL),
(2, 1, 'not_active', '2018-01-24 08:13:44', '2018-02-13 14:08:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `type_translations`
--

CREATE TABLE `type_translations` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `locale` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `type_translations`
--

INSERT INTO `type_translations` (`id`, `type_id`, `locale`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'en', 'apple', '2018-01-24 08:17:13', '0000-00-00 00:00:00', NULL),
(2, 1, 'ar', 'أبل ', '2018-01-24 08:17:13', '0000-00-00 00:00:00', NULL),
(3, 2, 'en', 'Samsung', '2018-01-24 08:17:13', '2018-02-11 17:03:40', NULL),
(4, 2, 'ar', 'سامسونج ', '2018-01-24 08:17:13', '2018-02-11 17:03:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'male',
  `mobile` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','not_active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fcm_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `image`, `name`, `gender`, `mobile`, `email`, `password`, `status`, `latitude`, `longitude`, `remember_token`, `fcm_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'jamal', 'male', '592887707', 'jamal@gmail.com', '$2y$10$gROn0SezUgyHzQdg/Dqr.uISeVr4qnE0yFccXT1/Dl0pg.6MgGqGm', 'active', 29.33452878579018, 48.07181814066962, NULL, NULL, '2018-04-21 07:17:00', NULL),
(2, NULL, 'ramez', 'male', '592887701', 'test-t1@gmail.com', '$2y$10$CrXV.ynfmRyU3JptOvjRwOy16iXWbHQTKqRpI3FXFoEzsRhehJPGm', 'active', 31.396625213828532, 34.6236808723138, NULL, NULL, '2018-04-23 14:32:22', '2018-04-29 05:06:38'),
(3, 'uploads/images/users/BOyxmcIysgMN4Ff37CekEg2XDsx0pSTY0gEY7LLU.jpeg', 'momen', 'male', '0599946788', 'momen@gmail.com', '$2y$10$q51Xzc.Shv3eSmEJUF6Bv.jrRQfYTqt6yiAJDy8fLb2FEz1FB8BKi', 'active', 29.33452878579018, 48.07181814066962, NULL, NULL, '2018-04-21 16:21:15', '2018-05-16 10:16:57'),
(7, NULL, 'ahmed', 'male', '597797377', 'ahmed-test@gmail.com', '$2y$10$6QharC.B8YVuz8.pPOPAZu9rTOGalwDi5Q/FPzTaTfyJCU3pRMaau', 'active', 29.33452878579018, 48.07181814066962, NULL, NULL, '2018-04-29 04:38:11', '2018-04-29 04:38:11'),
(12, NULL, 'mahmoud', 'male', '0597876451591', 'm7mou4d@gmail.com', '$2y$10$yG60dRcThAVh2XcgdU9dmuMADqNr6T3SX7pu8CMnBI0BtxKkj/6kW', 'active', 29.33452878579018, 48.07181814066962, NULL, NULL, '2018-05-01 09:34:57', '2018-05-01 09:34:57'),
(13, NULL, 'mahmoud', 'male', '059787611', 'm7mou4wd@gmail.com', '$2y$10$2iMiu5M10QSkl7QnE.WAVencDckGM7MqGYvJ57fn621AwTd7ZVdO.', 'active', 29.33452878579018, 48.07181814066962, NULL, NULL, '2018-05-01 13:12:13', '2018-05-01 13:18:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD KEY `admin_password_resets_email_index` (`email`),
  ADD KEY `admin_password_resets_token_index` (`token`);

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_translations`
--
ALTER TABLE `category_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language_translations`
--
ALTER TABLE `language_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_translations`
--
ALTER TABLE `page_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_id` (`page_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_translations`
--
ALTER TABLE `product_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_type_translations`
--
ALTER TABLE `product_type_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider_translations`
--
ALTER TABLE `slider_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `sub_category_translations`
--
ALTER TABLE `sub_category_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_translations`
--
ALTER TABLE `type_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `mobile` (`mobile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `category_translations`
--
ALTER TABLE `category_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `language_translations`
--
ALTER TABLE `language_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `page_translations`
--
ALTER TABLE `page_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `product_translations`
--
ALTER TABLE `product_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_type_translations`
--
ALTER TABLE `product_type_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `slider_translations`
--
ALTER TABLE `slider_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sub_category_translations`
--
ALTER TABLE `sub_category_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `type_translations`
--
ALTER TABLE `type_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `favourites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favourites_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_products_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
