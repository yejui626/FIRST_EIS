-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2023 at 03:01 AM
-- Server version: 10.4.28-MariaDB-log
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paper`
--

-- --------------------------------------------------------

--
-- Table structure for table `cardtdetails`
--

CREATE TABLE `cardtdetails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updates_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_images` varchar(255) DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `product_quantity`, `created_at`, `updated_at`, `name`, `email`, `phone`, `address`, `product_name`, `product_images`, `price`) VALUES
(39, 2, 5, 1, '2023-05-26 20:07:58', '2023-05-26 20:07:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 4, 3, 1, '2023-06-16 09:09:28', '2023-06-16 09:09:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `u_id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone_number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`id`, `u_id`, `address`, `created_at`, `updated_at`, `phone_number`) VALUES
(2, 6, 'Jugle Books', '2023-07-10 14:12:36', '2023-07-10 14:12:36', '0192612066'),
(3, 7, 'Pantai Timur', '2023-07-10 14:22:46', '2023-07-10 14:22:46', '0173274877');

-- --------------------------------------------------------

--
-- Table structure for table `grn`
--

CREATE TABLE `grn` (
  `id` int(11) NOT NULL,
  `grn_number` varchar(255) NOT NULL,
  `po_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `received_date` date NOT NULL,
  `custdelivery_date` date NOT NULL,
  `to_grn` varchar(255) NOT NULL,
  `recipient_grn` varchar(255) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grn`
--

INSERT INTO `grn` (`id`, `grn_number`, `po_id`, `supplier_id`, `received_date`, `custdelivery_date`, `to_grn`, `recipient_grn`, `total_qty`, `created_at`, `updated_at`) VALUES
(28, 'GRN-20230619QRMSPAV803', 2, 3, '2023-06-08', '2023-06-15', 'TOY SHOP', 'DAFINA DOT COM', 5, '2023-06-19 16:38:18', '2023-06-19 16:38:18'),
(29, 'GRN-20230627I0DRCJWVRB', 1, 3, '2023-06-29', '2023-07-07', 'MEOW', 'DAFINA DOT COM', 4, '2023-06-27 05:40:20', '2023-06-27 05:40:20'),
(30, 'GRN-20230627HQHUSVRJL0', 11, 3, '2023-06-27', '2023-06-28', 'Anyone', 'Someone', 3, '2023-06-27 10:58:41', '2023-06-27 10:58:41');

-- --------------------------------------------------------

--
-- Table structure for table `grn_items`
--

CREATE TABLE `grn_items` (
  `id` int(11) NOT NULL,
  `grn_id` int(11) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `product_uom` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grn_items`
--

INSERT INTO `grn_items` (`id`, `grn_id`, `product_id`, `qty`, `product_uom`, `description`, `created_at`, `updated_at`) VALUES
(13, 28, 3, 5, 'BND', NULL, '2023-06-19 16:38:18', '2023-06-19 16:38:18'),
(14, 29, 4, 4, 'bag', 'aaaaaaa', '2023-06-27 05:40:20', '2023-06-27 05:40:20'),
(15, 30, 4, 3, 'unit', NULL, '2023-06-27 10:58:41', '2023-06-27 10:58:41');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `order_id`, `product_id`, `product_quantity`, `created_at`, `updated_at`) VALUES
(8, 17, 4, 1, '2023-05-26 05:26:37', '2023-05-26 05:26:37'),
(9, 17, 5, 1, '2023-05-26 05:26:37', '2023-05-26 05:26:37'),
(10, 18, 4, 1, '2023-05-26 05:27:39', '2023-05-26 05:27:39'),
(11, 19, 5, 1, '2023-05-26 05:29:20', '2023-05-26 05:29:20'),
(12, 20, 4, 1, '2023-05-26 05:30:11', '2023-05-26 05:30:11'),
(13, 21, 5, 1, '2023-05-26 05:32:06', '2023-05-26 05:32:06'),
(14, 22, 5, 1, '2023-05-26 05:35:37', '2023-05-26 05:35:37'),
(15, 22, 4, 1, '2023-05-26 05:35:37', '2023-05-26 05:35:37'),
(16, 23, 5, 2, '2023-05-26 11:29:02', '2023-05-26 11:29:02'),
(17, 23, 4, 10, '2023-05-26 11:29:02', '2023-05-26 11:29:02'),
(18, 23, 3, 4, '2023-05-26 11:29:02', '2023-05-26 11:29:02'),
(19, 24, 4, 1, '2023-05-26 15:45:30', '2023-05-26 15:45:30'),
(20, 24, 5, 1, '2023-05-26 15:45:30', '2023-05-26 15:45:30'),
(21, 24, 3, 1, '2023-05-26 15:45:30', '2023-05-26 15:45:30'),
(22, 25, 3, 1, '2023-05-26 15:52:39', '2023-05-26 15:52:39'),
(23, 25, 4, 1, '2023-05-26 15:52:39', '2023-05-26 15:52:39'),
(24, 26, 5, 1, '2023-05-26 19:50:08', '2023-05-26 19:50:08'),
(25, 27, 3, 1, '2023-05-26 20:04:29', '2023-05-26 20:04:29'),
(26, 27, 4, 2, '2023-05-26 20:04:29', '2023-05-26 20:04:29'),
(27, 27, 5, 1, '2023-05-26 20:04:29', '2023-05-26 20:04:29'),
(28, 27, 6, 1, '2023-05-26 20:04:29', '2023-05-26 20:04:29'),
(29, 28, 4, 1, '2023-07-10 14:13:00', '2023-07-10 14:13:00'),
(30, 28, 5, 1, '2023-07-10 14:13:00', '2023-07-10 14:13:00'),
(31, 29, 6, 1, '2023-07-10 14:23:25', '2023-07-10 14:23:25'),
(32, 30, 3, 1, '2023-07-10 15:20:21', '2023-07-10 15:20:21');

-- --------------------------------------------------------

--
-- Table structure for table `logistic`
--

CREATE TABLE `logistic` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parcel_number` varchar(255) DEFAULT NULL,
  `courier` varchar(255) DEFAULT NULL,
  `tracking_url` varchar(255) DEFAULT NULL,
  `awb_id_link` varchar(255) DEFAULT NULL,
  `tracking_number` varchar(255) DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `sender_name` varchar(255) NOT NULL,
  `recipient_name` varchar(255) NOT NULL,
  `recipient_address` varchar(255) DEFAULT NULL,
  `recipient_address_state` varchar(255) DEFAULT NULL,
  `recipient_address_city` varchar(255) DEFAULT NULL,
  `recipient_address_postcode` int(11) DEFAULT NULL,
  `recipient_phone` varchar(255) DEFAULT NULL,
  `shipment_date` datetime DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logistic`
--

INSERT INTO `logistic` (`id`, `parcel_number`, `courier`, `tracking_url`, `awb_id_link`, `tracking_number`, `order_id`, `sender_name`, `recipient_name`, `recipient_address`, `recipient_address_state`, `recipient_address_city`, `recipient_address_postcode`, `recipient_phone`, `shipment_date`, `status`, `description`, `created_at`, `updated_at`) VALUES
(7, 'EI-O94Q6', 'DHL eCommerce', 'https://app.easyparcel.com/my/en/track/details/?courier=DHLECOMMERCE&awb=MYAIAEPAB2TWS', 'https://connect.easyparcel.my/?ac=AWBLabel&id=RVAtZXVNWG51bWJCIzI1MDQzNTQzMA%3D%3D', 'MYAIAEPAB2TWS', 26, 'Min', 'CIMB', 'Kampung Parit Medan', 'Pulau Pinang', 'Bukit Mertajam', 14000, '0194703276', '2023-07-04 00:00:00', 'Cancel', 'UGREEN USB-C', '2023-06-24 06:48:03', '2023-06-24 11:35:20'),
(8, 'EI-O94RO', 'Pgeon', 'https://app.easyparcel.com/my/en/track/details/?courier=Pgeon-Delivery&awb=JW7WRV', 'https://connect.easyparcel.my/?ac=AWBLabel&id=RVAtZXVNWG51bWJCIzI1MDQzNTAwMA%3D%3D', 'JW7WRV', 26, 'Min', 'CIMB', 'Kampung Parit Medan', 'Pulau Pinang', 'Bukit Mertajam', 14000, '0194703276', '2023-06-26 00:00:00', 'Cancel', 'UGREEN USB-C', '2023-06-24 08:03:50', '2023-06-24 08:21:48'),
(9, 'EI-O94R7', 'Pgeon', 'https://app.easyparcel.com/my/en/track/details/?courier=Pgeon-Delivery&awb=NXNGWW', 'https://connect.easyparcel.my/?ac=AWBLabel&id=RVAtZXVNWG51bWJCIzI1MDQzNTA1NQ%3D%3D', 'NXNGWW', 27, 'Min', 'CIMB', 'Kampung Parit Medan', 'Pulau Pinang', 'Bukit Mertajam', 14000, '0194703276', '2023-06-26 00:00:00', 'Cancel', 'Asus Vivobook Pro 14', '2023-06-24 08:03:53', '2023-06-24 11:02:50');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2023_05_19_130353_create_suppliers_table', 1),
(5, '2023_05_19_163546_create_products_table', 1),
(6, '2023_05_23_051029_create_carts_table', 1),
(7, '2023_05_25_095619_create_payments_table', 1),
(8, '2023_05_25_211154_create_orders_table', 1),
(9, '2023_05_26_005141_create_items_table', 1),
(11, '2023_05_26_125845_create_items_table', 2),
(15, '2023_06_16_104454_create_logistic_table', 3),
(16, '2023_07_10_220350_create_customer_address_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `totalprice` decimal(8,2) NOT NULL,
  `delivery_status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `payment_id`, `totalprice`, `delivery_status`, `created_at`, `updated_at`) VALUES
(17, 2, 18, 3174.00, 'Transfer to logistic', '2023-05-26 05:26:37', '2023-06-18 22:56:43'),
(18, 2, 19, 3045.00, 'Transfer to logistic', '2023-05-26 05:27:39', '2023-06-16 10:21:54'),
(19, 2, 20, 129.00, 'pending', '2023-05-26 05:29:20', '2023-05-26 05:29:20'),
(20, 2, 21, 3045.00, 'pending', '2023-05-26 05:30:11', '2023-05-26 05:30:11'),
(21, 2, 22, 129.00, 'pending', '2023-05-26 05:32:06', '2023-05-26 05:32:06'),
(22, 2, 23, 3174.00, 'pending', '2023-05-26 05:35:37', '2023-05-26 05:35:37'),
(23, 2, 24, 45704.00, 'pending', '2023-05-26 11:29:02', '2023-05-26 11:29:02'),
(24, 2, 25, 6923.00, 'pending', '2023-05-26 15:45:30', '2023-05-26 15:45:30'),
(25, 2, 26, 6794.00, 'pending', '2023-05-26 15:52:39', '2023-05-26 15:52:39'),
(26, 4, 27, 129.00, 'Cancel', '2023-05-26 19:50:08', '2023-06-24 11:35:58'),
(27, 4, 28, 13468.00, 'Cancel', '2023-05-26 20:04:29', '2023-06-24 11:36:00'),
(28, 6, 29, 3174.00, 'pending', '2023-07-10 14:13:00', '2023-07-10 14:13:00'),
(29, 7, 30, 3500.00, 'pending', '2023-07-10 14:23:25', '2023-07-10 14:23:25'),
(30, 7, 31, 3749.00, 'pending', '2023-07-10 15:20:21', '2023-07-10 15:20:21');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_po_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_item_id` bigint(20) UNSIGNED NOT NULL,
  `order_unit` varchar(100) NOT NULL,
  `order_unitprice` float NOT NULL,
  `order_quantity` float NOT NULL,
  `delivery_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_po_id`, `order_item_id`, `order_unit`, `order_unitprice`, `order_quantity`, `delivery_date`) VALUES
(5, 3, 'unit', 1200, 3, '2023-06-10'),
(5, 6, 'unit', 1400, 4, '2023-06-10'),
(5, 5, 'pcs', 55, 3, '2023-06-10'),
(1, 4, 'unit', 4, 3, '2023-06-16'),
(1, 3, 'unit', 44, 5, '2023-06-10'),
(1, 5, 'pcs', 55, 4, '2023-06-10'),
(7, 3, 'unit', 1200, 3, '2023-06-10'),
(7, 6, 'unit', 1400, 4, '2023-06-10'),
(2, 4, 'unit', 4666, 3, '2023-06-16'),
(2, 7, 'pcs', 5, 1, NULL),
(2, 5, 'pcs', 55, 2, '2023-06-19'),
(10, 4, 'unit', 4, 3, '2023-06-16'),
(11, 4, 'unit', 4333, 3, '2023-06-16'),
(11, 3, 'unit', 500, 3, '2023-06-28'),
(11, 7, 'pcs', 5, 1, '2023-06-27'),
(11, 6, 'unit', 5000, 2, '2023-06-27'),
(3, 4, 'unit', 4, 3, '2023-06-16'),
(3, 3, 'unit', 3333, 3, '2023-06-10'),
(3, 7, 'pcs', 5, 1, '2023-06-27'),
(3, 5, 'pcs', 55, 3, '2023-06-19'),
(14, 3, 'unit', 1200, 3, '2023-06-10'),
(14, 6, 'unit', 1400, 4, '2023-06-10'),
(15, 5, 'EA', 55, 3, '2023-06-16'),
(15, 4, 'EA', 4200, 2, '2023-07-12');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cardname` varchar(255) DEFAULT NULL,
  `cardnumber` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address_state` varchar(255) DEFAULT NULL,
  `address_city` varchar(255) DEFAULT NULL,
  `address_postcode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `cardname`, `cardnumber`, `address`, `phone`, `created_at`, `updated_at`, `address_state`, `address_city`, `address_postcode`) VALUES
(1, 'ara', '4242 4242 4242 4242', 'LOT 4410, JALAN MENTERI OFF, JALAN TUNKU BENDAHARA, 09000 KULIM KEDAH', '+60135335997', '2023-05-26 01:26:33', '2023-05-26 01:26:33', NULL, NULL, NULL),
(2, 'test', '4242 4242 4242 4242', 'Kampung Parit Medan', '123', '2023-05-26 03:13:15', '2023-05-26 03:13:15', NULL, NULL, NULL),
(3, 'test', '4242 4242 4242 4242', 'Kampung Parit Medan', '123', '2023-05-26 03:21:40', '2023-05-26 03:21:40', NULL, NULL, NULL),
(4, 'test', '4242 4242 4242 4242', 'Kampung Parit Medan', '123', '2023-05-26 03:25:58', '2023-05-26 03:25:58', NULL, NULL, NULL),
(5, 'test', '4242 4242 4242 4242', 'Kampung Parit Medan', '123', '2023-05-26 03:27:57', '2023-05-26 03:27:57', NULL, NULL, NULL),
(6, 'test', '4242 4242 4242 4242', 'Kampung Parit Medan', '123', '2023-05-26 03:29:51', '2023-05-26 03:29:51', NULL, NULL, NULL),
(7, 'test', '4242 4242 4242 4242', 'Kampung Parit Medan', '123', '2023-05-26 03:32:16', '2023-05-26 03:32:16', NULL, NULL, NULL),
(8, 'CIMB', '4242 4242 4242 4242', 'Kampung Parit Medan', '0194703276', '2023-05-26 03:44:06', '2023-05-26 03:44:06', NULL, NULL, NULL),
(9, 'test', '4242 4242 4242 4242', 'Kampung Parit Medan', '0194703276', '2023-05-26 05:01:26', '2023-05-26 05:01:26', NULL, NULL, NULL),
(10, 'test', '4242 4242 4242 4242', 'Kulim', '0194703276', '2023-05-26 05:20:27', '2023-05-26 05:20:27', NULL, NULL, NULL),
(11, 'test', '4242 4242 4242 4242', 'Kulim', '0194703276', '2023-05-26 05:20:29', '2023-05-26 05:20:29', NULL, NULL, NULL),
(12, 'test', '4242 4242 4242 4242', 'Kulim', '0194703276', '2023-05-26 05:20:30', '2023-05-26 05:20:30', NULL, NULL, NULL),
(13, 'test', '4242 4242 4242 4242', 'Kulim', '0194703276', '2023-05-26 05:20:32', '2023-05-26 05:20:32', NULL, NULL, NULL),
(14, 'test', '4242 4242 4242 4242', 'Kulim', '0194703276', '2023-05-26 05:20:34', '2023-05-26 05:20:34', NULL, NULL, NULL),
(15, 'test', '4242 4242 4242 4242', 'Kulim', '0194703276', '2023-05-26 05:20:35', '2023-05-26 05:20:35', NULL, NULL, NULL),
(16, 'test', '4242 4242 4242 4242', 'Kulim', '0194703276', '2023-05-26 05:20:37', '2023-05-26 05:20:37', NULL, NULL, NULL),
(17, 'test', '4242 4242 4242 4242', 'Kulim', '0194703276', '2023-05-26 05:20:38', '2023-05-26 05:20:38', NULL, NULL, NULL),
(18, 'CIMB', '4242 4242 4242 4242', 'Kampung Parit Medan', '0194703276', '2023-05-26 05:26:37', '2023-05-26 05:26:37', NULL, NULL, NULL),
(19, 'Test', '4242 4242 4242 4242', 'Kampung Parit Medan', '0194703276', '2023-05-26 05:27:39', '2023-05-26 05:27:39', NULL, NULL, NULL),
(20, 'CIMB', '4242 4242 4242 4242', 'Kampung Parit Medan', '0194703276', '2023-05-26 05:29:20', '2023-05-26 05:29:20', NULL, NULL, NULL),
(21, 'test', '4242 4242 4242 4242', 'Kampung Parit Medan', '0194703276', '2023-05-26 05:30:11', '2023-05-26 05:30:11', NULL, NULL, NULL),
(22, 'CIMB', '4242 4242 4242 4242', 'Kampung Parit Medan', '0194703276', '2023-05-26 05:32:06', '2023-05-26 05:32:06', NULL, NULL, NULL),
(23, 'CIMB', '4242 4242 4242 4242', 'Kampung Parit Medan', '0194703276', '2023-05-26 05:35:37', '2023-05-26 05:35:37', NULL, NULL, NULL),
(24, 'Test', '4242 4242 4242 4242', 'Kampung Parit Medan', '0194703276', '2023-05-26 11:29:02', '2023-05-26 11:29:02', NULL, NULL, NULL),
(25, 'CIMB', '4242 4242 4242 4242', 'Kulim', '0194703276', '2023-05-26 15:45:30', '2023-05-26 15:45:30', NULL, NULL, NULL),
(26, 'CIMB', '4242 4242 4242 4242', 'Kampung Parit Medan', '0194703276', '2023-05-26 15:52:39', '2023-05-26 15:52:39', NULL, NULL, NULL),
(27, 'CIMB', '4242 4242 4242 4242', 'Kampung Parit Medan', '0194703276', '2023-05-26 19:50:08', '2023-05-26 19:50:08', 'Pulau Pinang', 'Bukit Mertajam', '14000'),
(28, 'CIMB', '4242 4242 4242 4242', 'Kampung Parit Medan', '0194703276', '2023-05-26 20:04:29', '2023-05-26 20:04:29', 'Pulau Pinang', 'Bukit Mertajam', '14000'),
(29, 'adammmm', '4242 4242 4242 4242', 'Jugle Books', '0192612066', '2023-07-10 14:13:00', '2023-07-10 14:13:00', NULL, NULL, NULL),
(30, 'adammmm', '4242 4242 4242 4242', 'Pantai Timur', '0173274877', '2023-07-10 14:23:25', '2023-07-10 14:23:25', NULL, NULL, NULL),
(31, 'adammmm', '4242 4242 4242 4242', 'Pantai Timur', '0173274877', '2023-07-10 15:20:21', '2023-07-10 15:20:21', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_category` int(20) NOT NULL,
  `product_code` varchar(255) DEFAULT NULL,
  `product_details` text DEFAULT NULL,
  `product_sellingprice` decimal(8,2) NOT NULL,
  `product_supplierprice` decimal(8,2) NOT NULL,
  `product_quantity` int(11) DEFAULT NULL,
  `product_img1` varchar(255) DEFAULT NULL,
  `product_img2` varchar(255) DEFAULT NULL,
  `product_img3` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `specs1` varchar(255) DEFAULT NULL,
  `specs2` varchar(255) DEFAULT NULL,
  `specs3` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_category`, `product_code`, `product_details`, `product_sellingprice`, `product_supplierprice`, `product_quantity`, `product_img1`, `product_img2`, `product_img3`, `created_at`, `updated_at`, `specs1`, `specs2`, `specs3`) VALUES
(3, 'Asus Vivobook Pro 14', 2, 'M3401Q-CKM128WS', 'Quiet Blue\nAMD Ryzen™ 7 5800H Processor\n16GB DDR4 on board Ram\n512GB M.2 NVMe™ PCIe® 3.0 SSD\nNVIDIA GeForce® RTX™ 3050 4GB GDDR', 3749.00, 3600.00, 7, '/storage/images/1684750541laptop1.jpg', '/storage/images/1684750541laptop2.jpg', '/storage/images/1684753411laptop3.jpg', '2023-05-21 02:15:41', '2023-07-10 15:20:21', '8', '15', 'Ryzen'),
(4, 'Microsoft Surface', 2, '8QC-00017', '12.4” PixelSense touchscreen\n\nMemory\n\n4GB or 8GB LPDDR4x RAM\n\nProcessor\n\nQuad Core 11th Gen Intel® Core™ i5-1135G7 Processor', 3045.00, 2899.00, 2, '/storage/images/1684750662surface1.jpg', NULL, NULL, '2023-05-21 02:17:42', '2023-07-10 14:13:00', NULL, NULL, NULL),
(5, 'UGREEN USB-C', 3, '80133', '①Multi Port Type C Docking Station\n\nExpand your Laptop/Macbook with HDMI, VGA, Ethernet, 3 USB 3.0 ports, TF SD card reader and one type c PD 3.0 charging port', 129.00, 100.00, 4, '/storage/images/1684750918ugreen.png', NULL, NULL, '2023-05-21 02:21:58', '2023-07-10 14:13:00', NULL, NULL, NULL),
(6, 'Macbook Air M1', 2, '12345', 'LEsgoo', 3500.00, 3000.00, -1, '/storage/images/1685160170download.jpg', NULL, NULL, '2023-05-26 20:02:50', '2023-07-10 14:23:25', NULL, NULL, NULL),
(7, 'Shipping', 1, NULL, NULL, 0.00, 0.00, NULL, '/storage/images/168792242983w7nym3.png', NULL, NULL, '2023-06-09 22:00:40', '2023-06-27 19:20:30', NULL, NULL, NULL),
(11, 'Laptop', 2, NULL, NULL, 123.00, 123.00, NULL, NULL, NULL, NULL, '2023-07-10 11:39:50', '2023-07-10 11:39:50', 'ram', 'size', 'cpu'),
(12, 'Aksesori', 3, '1233213', NULL, 123.00, 123.00, NULL, NULL, NULL, NULL, '2023-07-10 11:44:09', '2023-07-10 12:37:07', '1000', 'Yes', 'Closed'),
(13, 'Fon Telinga', 3, '1233', NULL, 123.00, 123.00, NULL, NULL, NULL, NULL, '2023-07-10 12:39:20', '2023-07-10 12:43:48', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `category_id` int(20) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `specs1` varchar(255) DEFAULT NULL,
  `specs2` varchar(255) DEFAULT NULL,
  `specs3` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`category_id`, `category_name`, `specs1`, `specs2`, `specs3`) VALUES
(1, 'Shipping', NULL, NULL, NULL),
(2, 'Laptop', 'RAM', 'Screen Size', 'CPU'),
(3, 'Accessories', 'Battery', 'Wired/Wireless', NULL),
(7, 'Headphone', 'Wired/Wireless', 'Battery', 'Closed/Open Back'),
(8, 'Phone', 'Memory', 'Resolution', 'CPU');

-- --------------------------------------------------------

--
-- Table structure for table `purchaserequest`
--

CREATE TABLE `purchaserequest` (
  `id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `requestor` varchar(255) DEFAULT NULL,
  `supplier_id` bigint(220) UNSIGNED NOT NULL,
  `discount_percentage` float DEFAULT NULL,
  `discount_amount` float DEFAULT NULL,
  `tax_percentage` float DEFAULT NULL,
  `tax_amount` float DEFAULT NULL,
  `total_amount` double(8,2) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchaserequest`
--

INSERT INTO `purchaserequest` (`id`, `status`, `requestor`, `supplier_id`, `discount_percentage`, `discount_amount`, `tax_percentage`, `tax_amount`, `total_amount`, `notes`, `created_at`, `updated_at`) VALUES
('PR-20230608BHUM5', 'Approved', 'TSK Wanie', 3, 5, 0.6, 6, 0.72, 12.00, NULL, '2023-06-08 09:11:34', '2023-06-08 18:39:58'),
('PR-20230608KCDZQ', 'Approved', 'TSK Wanie', 3, 5, 0.6, 6, 0.72, 12.00, NULL, '2023-06-08 09:13:24', '2023-06-08 20:24:20'),
('PR-20230609Q189X', 'Approved', 'TSK Rose', 3, 3, 1.26, 4, 1.68, 42.00, 'letak warning tag', '2023-06-09 01:47:03', '2023-06-09 22:35:59'),
('PR-20230609QXA9Q', 'Approved', 'TSK Wanie', 3, 5, 0.6, 6, 0.72, 12.00, NULL, '2023-06-08 19:54:42', '2023-06-08 20:24:25'),
('PR-20230609XRIEP', 'Approved', 'TSK Wanie', 3, 3, 2.16, 2, 1.44, 72.00, 'hantar ke plant 3', '2023-06-08 19:01:19', '2023-06-09 23:46:39'),
('PR-20230609Y2IKR', 'Approved', 'TSK Wanie', 3, 5, 0.6, 6, 0.72, 12.00, 'pppp', '2023-06-09 05:05:11', '2023-06-19 00:51:44'),
('PR-20230610D8UMX', 'Approved', 'Ahmad', 4, 33, 6819.12, NULL, 0, 20664.00, NULL, '2023-06-09 23:25:34', '2023-06-19 05:19:43'),
('PR-20230610YIX0I', 'Approved', 'TSK Aiman', 4, 2, 184, NULL, 0, 9200.00, NULL, '2023-06-10 00:11:36', '2023-06-10 00:12:29'),
('PR-20230619FCM3C', 'Approved', 'TSK Rose', 3, 70, 0, 3, 0, 0.00, NULL, '2023-06-19 08:32:34', '2023-06-27 03:17:14'),
('PR-20230619O21VF', 'Approved', 'TSK Leo', 3, 50, 42.12, 10, 28.08, 453.96, NULL, '2023-06-18 22:39:15', '2023-06-27 19:45:48'),
('PR-20230619PYZYY', 'Rejected', 'TSK JJ', 3, 15, 3.6, 3, 0.9, 0.00, NULL, '2023-06-19 09:13:56', '2023-07-10 12:54:33'),
('PR-20230627TAPMT', 'Approved', 'Ahmad', 3, 2, 104, 3, 156, 5200.00, NULL, '2023-06-27 03:13:54', '2023-06-27 03:14:16'),
('PR-20230710GKBBN', 'Pending', 'TSK Ammar', 5, 20, 2437.6, NULL, 0, 12188.00, NULL, '2023-07-10 13:37:43', '2023-07-10 13:37:43'),
('PR-20230710NM1VV', 'Pending', 'TSK Aiman', 3, 2, 200, NULL, 0, 10000.00, NULL, '2023-07-10 13:38:39', '2023-07-10 13:38:39');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `po_id` bigint(20) UNSIGNED NOT NULL,
  `po_no` varchar(100) NOT NULL,
  `po_prno` varchar(255) NOT NULL,
  `requestor` varchar(155) DEFAULT NULL,
  `buyer` varchar(155) DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `discount_percentage` float DEFAULT NULL,
  `discount_amount` float DEFAULT NULL,
  `tax_percentage` float DEFAULT NULL,
  `tax_amount` float DEFAULT NULL,
  `total_amount` float DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` datetime(6) DEFAULT NULL,
  `updated_at` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`po_id`, `po_no`, `po_prno`, `requestor`, `buyer`, `supplier_id`, `discount_percentage`, `discount_amount`, `tax_percentage`, `tax_amount`, `total_amount`, `notes`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PO-20230610LN2KAO20Z3', 'PR-20230608BHUM5', NULL, 'Ahmad', 3, 5, 22.6, 6, 27.12, NULL, NULL, 'Closed', '2023-06-10 06:22:18.000000', '2023-06-18 10:58:35.000000'),
(2, 'PO-202306108OKOUECCF0', 'PR-20230608BHUM5', NULL, 'RONALDO SUI', 3, 5, 705.65, 6, 846.78, NULL, NULL, 'Closed', '2023-06-10 07:57:35.000000', '2023-06-18 13:11:28.000000'),
(3, 'PO-202306109TVAY0QYFX', 'PR-20230608BHUM5', 'TSK Wanie', 'Sam', 3, 5, 509.05, 6, 610.86, NULL, NULL, 'Ordered', '2023-06-10 08:01:51.000000', '2023-06-27 11:01:51.000000'),
(5, 'PO-20230610JHUYKUOEN9', 'PR-20230610YIX0I', 'TSK Aiman', 'Ronaldo', 4, 2, 187.3, 0, 0, NULL, 'Please', 'Ordered', '2023-06-10 08:13:18.000000', '2023-06-10 08:18:36.000000'),
(7, 'PO-20230618YIYNKO8OJ2', 'PR-20230610YIX0I', 'TSK Aiman', 'Cristiano', 4, 2, 184, 0, 0, NULL, NULL, 'Closed', '2023-06-18 11:02:58.000000', '2023-06-27 11:04:19.000000'),
(10, 'PO-20230618JS4TXW25XD', 'PR-20230608BHUM5', 'TSK Wanie', 'mEOW', 3, 5, 0.6, 6, 0.72, NULL, NULL, 'Closed', '2023-06-18 15:05:12.000000', '2023-06-19 14:23:52.000000'),
(11, 'PO-20230627OIF49S1O2T', 'PR-20230608BHUM5', 'TSK Wanie', 'Bukhary', 3, 5, 1225.2, 6, 1470.24, NULL, NULL, 'Closed', '2023-06-27 10:39:33.000000', '2023-06-27 10:57:47.000000'),
(14, 'PO-202306289Y6XJQ6OC9', 'PR-20230610YIX0I', 'TSK Aiman', 'Bukhary', 4, 12, 1104, 0, 0, NULL, 'Test PO', 'Ordered', '2023-06-28 03:48:32.000000', '2023-06-28 03:49:18.000000'),
(15, 'PO-20230710H5ZYL0SZRH', 'PR-20230609QXA9Q', 'TSK Wanie', 'TSK Karim', 3, 5, 428.25, 6, 513.9, NULL, NULL, 'Ordered', '2023-07-10 21:40:44.000000', '2023-07-10 21:40:44.000000');

-- --------------------------------------------------------

--
-- Table structure for table `request_items`
--

CREATE TABLE `request_items` (
  `id` bigint(20) NOT NULL,
  `pr_id` varchar(255) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `delivery_date` date NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `uom` varchar(255) NOT NULL,
  `product_unitprice` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_items`
--

INSERT INTO `request_items` (`id`, `pr_id`, `product_id`, `delivery_date`, `product_quantity`, `uom`, `product_unitprice`, `created_at`, `updated_at`) VALUES
(2, 'PR-20230608BHUM5', 4, '2023-06-16', 3, 'unit', 4, '2023-06-08 09:11:34', '2023-06-08 09:11:34'),
(3, 'PR-20230608KCDZQ', 5, '2023-06-22', 3, 'BND', 4, '2023-06-08 09:13:24', '2023-06-08 09:13:24'),
(4, 'PR-20230609XRIEP', 6, '2023-06-16', 9, 'bag', 8, '2023-06-08 19:01:19', '2023-06-08 19:01:19'),
(7, 'PR-20230609QXA9Q', 5, '2023-06-16', 3, 'EA', 4, '2023-06-08 19:54:42', '2023-06-08 19:54:42'),
(8, 'PR-20230609Q189X', 3, '2023-06-10', 5, 'unit', 6, '2023-06-09 01:47:03', '2023-06-09 01:47:03'),
(9, 'PR-20230609Q189X', 4, '2023-06-11', 6, 'EA', 2, '2023-06-09 01:47:03', '2023-06-09 01:47:03'),
(10, 'PR-20230609Y2IKR', 3, '2023-06-16', 3, 'unit', 4, '2023-06-09 05:05:11', '2023-06-09 05:05:11'),
(12, 'PR-20230610D8UMX', 3, '2023-06-10', 3, 'unit', 3555, '2023-06-09 23:25:34', '2023-06-09 23:25:34'),
(13, 'PR-20230610D8UMX', 4, '2023-06-10', 3, 'EA', 3333, '2023-06-09 23:25:34', '2023-06-09 23:25:34'),
(14, 'PR-20230610YIX0I', 3, '2023-06-10', 3, 'unit', 1200, '2023-06-10 00:11:36', '2023-06-10 00:11:36'),
(15, 'PR-20230610YIX0I', 6, '2023-06-10', 4, 'unit', 1400, '2023-06-10 00:11:36', '2023-06-10 00:11:36'),
(23, 'PR-20230619O21VF', 3, '2023-06-19', 0, 'pcs', 0, '2023-06-19 08:29:58', '2023-06-19 08:29:58'),
(25, 'PR-20230619FCM3C', 3, '2023-06-20', 0, 'pcs', 0, '2023-06-19 08:45:06', '2023-06-19 08:45:06'),
(31, 'PR-20230619PYZYY', 3, '2023-06-20', 0, 'pcs', 0, '2023-06-19 09:14:17', '2023-06-19 09:14:17'),
(32, 'PR-20230627TAPMT', 4, '2023-06-28', 1, 'unit', 1200, '2023-06-27 03:13:54', '2023-06-27 03:13:54'),
(33, 'PR-20230627TAPMT', 6, '2023-06-27', 2, 'unite', 2000, '2023-06-27 03:13:54', '2023-06-27 03:13:54'),
(34, 'PR-20230710GKBBN', 4, '2023-07-12', 2, 'unit', 4200, '2023-07-10 13:37:43', '2023-07-10 13:37:43'),
(35, 'PR-20230710GKBBN', 3, '2023-07-11', 1, 'unit', 3788, '2023-07-10 13:37:43', '2023-07-10 13:37:43'),
(36, 'PR-20230710NM1VV', 4, '2023-07-13', 2, 'unit', 5000, '2023-07-10 13:38:39', '2023-07-10 13:38:39');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `supplier_phone` varchar(20) NOT NULL,
  `supplier_address` text NOT NULL,
  `supplier_address_state` varchar(255) DEFAULT NULL,
  `supplier_address_city` varchar(255) DEFAULT NULL,
  `supplier_address_postcode` int(11) DEFAULT NULL,
  `supplier_details` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_name`, `supplier_phone`, `supplier_address`, `supplier_address_state`, `supplier_address_city`, `supplier_address_postcode`, `supplier_details`, `created_at`, `updated_at`) VALUES
(3, 'Microsoft Malaysia', '03-5664356', '211, Jalan Tun Sambanthan', 'Kuala Lumpur', 'Brickfields', 50470, 'Authorized Dealer in Malaysia.', '2023-05-21 18:29:53', '2023-07-10 13:32:27'),
(4, 'IT.CEO (Shopee)', '0198887777', 'No.56, Jalan Aman', 'Kuala Lumpur', 'Brickfields', 50470, 'Shopee', '2023-06-09 05:06:44', '2023-07-10 13:36:16'),
(5, 'Nvidia Malaysia', '0123456789', 'No.48, Jalan Kemuning', 'Pulau Pinang', 'Gelugor', 11700, 'GPU Supplier', '2023-07-10 13:21:42', '2023-07-10 13:21:42'),
(6, '123', '1233', '1233', 'Johor', '123', 123, '123', '2023-07-10 13:23:11', '2023-07-10 13:30:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 5,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `role`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Imran Hakimi', 'imranhakimi24@gmail.com', NULL, 2, '$2y$10$hPE0xzcPKATufTFOru4Y7egLvUjCsa/ZKrS05/XDOiET8MHwDBcpS', NULL, '2023-05-21 01:21:31', '2023-06-27 03:03:35'),
(2, 'Min', 'ahmadmuhaimin135@gmail.com', NULL, 5, '$2y$10$qPU5IkSoDo8rRBbkzl6WneBxwN7D.YfNEn.HajioiFkKq9mfTdhWe', NULL, '2023-05-26 01:16:49', '2023-05-26 21:32:25'),
(3, 'kuki', 'kuki@gmail.com', NULL, 3, '$2y$10$VKFvuyZwDtI4VpIobrSDG.PeV6ahl7NVVPz.nj5e3IdipLPFKeKF2', NULL, '2023-06-08 07:12:24', '2023-06-08 07:12:24'),
(4, 'GOO', 'yjyejui626@gmail.com', NULL, 4, '$2y$10$NT857/qGCA9vQwSSyIJWpulVdWo0etNL2GkzF.2jvIegCUFv3b4bK', NULL, '2023-06-15 06:09:58', '2023-06-15 06:09:58'),
(6, 'wafii', 'wafyde@gmail.com', NULL, 5, '$2y$10$2rSab1Z9jno0PCtR2wfG.e5GSDIuCTL9PPnW5vnmsyMP8xFuOUiF.', NULL, '2023-07-10 14:09:13', '2023-07-10 14:09:13'),
(7, 'adam', 'adamydee@gmail.com', NULL, 5, '$2y$10$UIP6D/jXOcr44rLa2qgGtORZ/hh2DuIJIGXI.6eO2nj/CJVig7XyW', NULL, '2023-07-10 14:19:26', '2023-07-10 14:19:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cardtdetails`
--
ALTER TABLE `cardtdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_address_u_id_foreign` (`u_id`);

--
-- Indexes for table `grn`
--
ALTER TABLE `grn`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_grn_suppliers` (`supplier_id`),
  ADD KEY `po_id` (`po_id`);

--
-- Indexes for table `grn_items`
--
ALTER TABLE `grn_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grn_id` (`grn_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_order_id_foreign` (`order_id`),
  ADD KEY `items_product_id_foreign` (`product_id`);

--
-- Indexes for table `logistic`
--
ALTER TABLE `logistic`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `logistic_tracking_number_unique` (`tracking_number`),
  ADD KEY `logistic_order_id_foreign` (`order_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_payment_id_foreign` (`payment_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD KEY `order_po_id` (`order_po_id`),
  ADD KEY `order_item_id` (`order_item_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category` (`product_category`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `purchaserequest`
--
ALTER TABLE `purchaserequest`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`po_id`),
  ADD KEY `po_no` (`po_no`),
  ADD KEY `po_prno` (`po_prno`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `request_items`
--
ALTER TABLE `request_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pr_id` (`pr_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
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
-- AUTO_INCREMENT for table `cardtdetails`
--
ALTER TABLE `cardtdetails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `grn`
--
ALTER TABLE `grn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `grn_items`
--
ALTER TABLE `grn_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `logistic`
--
ALTER TABLE `logistic`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `category_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `po_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `request_items`
--
ALTER TABLE `request_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `customer_address_u_id_foreign` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `grn`
--
ALTER TABLE `grn`
  ADD CONSTRAINT `FK_grn_po_id` FOREIGN KEY (`po_id`) REFERENCES `purchase_order` (`po_id`),
  ADD CONSTRAINT `FK_grn_suppliers` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`);

--
-- Constraints for table `grn_items`
--
ALTER TABLE `grn_items`
  ADD CONSTRAINT `grn_items_ibfk_1` FOREIGN KEY (`grn_id`) REFERENCES `grn` (`id`),
  ADD CONSTRAINT `grn_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `logistic`
--
ALTER TABLE `logistic`
  ADD CONSTRAINT `logistic_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`order_item_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `order_items_ibfk_3` FOREIGN KEY (`order_po_id`) REFERENCES `purchase_order` (`po_id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`product_category`) REFERENCES `product_category` (`category_id`);

--
-- Constraints for table `purchaserequest`
--
ALTER TABLE `purchaserequest`
  ADD CONSTRAINT `purchaserequest_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`);

--
-- Constraints for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD CONSTRAINT `purchase_order_ibfk_1` FOREIGN KEY (`po_prno`) REFERENCES `purchaserequest` (`id`),
  ADD CONSTRAINT `purchase_order_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`);

--
-- Constraints for table `request_items`
--
ALTER TABLE `request_items`
  ADD CONSTRAINT `request_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `request_items_ibfk_3` FOREIGN KEY (`pr_id`) REFERENCES `purchaserequest` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
