-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2025 at 02:02 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `user_id`, `username`, `created_at`, `updated_at`) VALUES
(1, 2, 'admin', '2025-05-13 06:10:55', '2025-05-13 06:10:55');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(16, '0001_01_01_000000_create_users_table', 1),
(17, '0001_01_01_000001_create_cache_table', 1),
(18, '0001_01_01_000002_create_jobs_table', 1),
(19, '2025_05_13_072642_create_products_table', 1),
(20, '2025_05_13_072649_create_admins_table', 1),
(21, '2025_05_13_102107_create_personal_access_tokens_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(2, 'App\\Models\\User', 2, 'auth_token', '7e46e71bbfc967977b9460ee62e34e5b16782c8cbf09dd4053db96688466d6e7', '[\"*\"]', '2025-05-13 08:31:28', NULL, '2025-05-13 08:04:51', '2025-05-13 08:31:28');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `category`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2, 'eos in esse', 52.83, 'Books', 'products/default-product.png', 'Active', '2025-04-19 22:33:36', '2025-04-01 17:20:37'),
(3, 'voluptas cum aut', 68.31, 'Electronics', 'products/default-product.png', 'Inactive', '2024-07-20 23:40:24', '2025-05-10 01:58:52'),
(4, 'a voluptatum non', 151.31, 'Beauty', 'products/default-product.png', 'Active', '2024-07-01 15:14:44', '2024-12-16 19:51:02'),
(5, 'quae et dolorem', 829.45, 'Home & Kitchen', 'products/default-product.png', 'Inactive', '2025-01-08 17:03:39', '2025-05-09 03:00:23'),
(6, 'sed necessitatibus illum', 1021.00, 'Toys', 'products/default-product.png', 'Active', '2025-05-07 00:39:08', '2025-05-13 08:24:46'),
(7, 'mollitia nulla et', 221.60, 'Home & Kitchen', 'products/default-product.png', 'Active', '2024-06-01 13:46:49', '2025-04-07 06:29:48'),
(8, 'maiores accusantium illo', 166.48, 'Home & Kitchen', 'products/default-product.png', 'Inactive', '2024-08-15 15:59:42', '2024-12-29 01:11:30'),
(9, 'qui porro quis', 122.59, 'Home & Kitchen', 'products/default-product.png', 'Inactive', '2024-10-14 20:08:36', '2024-11-16 07:12:42'),
(10, 'amet dolores incidunt', 410.03, 'Clothing', 'products/default-product.png', 'Active', '2024-09-29 06:07:09', '2025-05-07 14:46:07'),
(11, 'a molestiae aut', 578.57, 'Toys', 'products/default-product.png', 'Active', '2024-07-17 15:40:26', '2024-12-21 18:52:30'),
(12, 'aut quo quisquam', 102.47, 'Books', 'products/default-product.png', 'Inactive', '2025-04-20 09:38:09', '2025-01-22 14:29:01'),
(13, 'et voluptas non', 700.23, 'Sports', 'products/default-product.png', 'Inactive', '2025-01-01 18:12:42', '2025-01-28 16:56:26'),
(14, 'odit vero aperiam', 575.10, 'Automotive', 'products/default-product.png', 'Active', '2024-12-14 15:19:27', '2025-04-22 22:54:51'),
(15, 'nisi quos dolor', 633.41, 'Home & Kitchen', 'products/default-product.png', 'Active', '2024-12-23 13:26:06', '2025-04-22 16:28:04'),
(16, 'sequi non et', 329.61, 'Clothing', 'products/default-product.png', 'Active', '2024-07-22 18:50:21', '2025-05-03 11:22:04'),
(17, 'natus ut sunt', 496.96, 'Beauty', 'products/default-product.png', 'Active', '2024-07-30 00:40:16', '2025-03-04 07:26:49'),
(18, 'corporis animi harum', 847.65, 'Electronics', 'products/default-product.png', 'Inactive', '2025-01-10 23:37:07', '2024-12-03 15:07:05'),
(19, 'reprehenderit ut in', 975.64, 'Beauty', 'products/default-product.png', 'Inactive', '2024-10-03 08:57:24', '2025-04-06 07:25:53'),
(20, 'et iste beatae', 22.39, 'Electronics', 'products/default-product.png', 'Inactive', '2025-03-03 22:38:02', '2025-03-08 22:48:23'),
(21, 'ipsa rerum debitis', 848.24, 'Beauty', 'products/default-product.png', 'Inactive', '2025-02-14 15:13:09', '2024-12-14 20:42:34'),
(22, 'molestiae itaque asperiores', 212.35, 'Electronics', 'products/default-product.png', 'Inactive', '2025-02-23 12:10:09', '2024-11-19 14:34:59'),
(23, 'suscipit voluptas sit', 495.97, 'Electronics', 'products/default-product.png', 'Active', '2024-11-14 23:21:32', '2024-11-23 05:04:35'),
(24, 'unde fugiat saepe', 679.77, 'Sports', 'products/default-product.png', 'Active', '2024-11-08 17:08:10', '2025-03-05 05:05:29'),
(25, 'necessitatibus consequatur et', 422.30, 'Books', 'products/default-product.png', 'Inactive', '2024-09-23 09:48:35', '2025-04-02 11:37:50'),
(26, 'voluptas non sed', 107.01, 'Sports', 'products/default-product.png', 'Inactive', '2025-02-21 20:44:25', '2025-03-08 12:19:40'),
(27, 'dolorem ea voluptas', 761.21, 'Home & Kitchen', 'products/default-product.png', 'Inactive', '2024-11-15 14:10:02', '2024-12-05 00:34:35'),
(28, 'qui nam a', 101.57, 'Electronics', 'products/default-product.png', 'Active', '2024-09-23 17:11:53', '2025-03-02 14:07:48'),
(29, 'rem possimus aut', 163.61, 'Toys', 'products/default-product.png', 'Inactive', '2025-01-03 17:59:32', '2025-01-13 04:31:48'),
(30, 'sed enim nesciunt', 521.78, 'Electronics', 'products/default-product.png', 'Inactive', '2024-05-18 17:25:04', '2025-03-20 17:29:03'),
(31, 'odit aliquam recusandae', 263.45, 'Beauty', 'products/default-product.png', 'Active', '2024-07-14 22:20:13', '2025-04-18 12:50:54'),
(32, 'vero autem alias', 868.82, 'Home & Kitchen', 'products/default-product.png', 'Active', '2025-03-27 11:21:46', '2024-11-18 08:20:37'),
(33, 'ducimus labore ipsa', 139.27, 'Beauty', 'products/default-product.png', 'Inactive', '2025-01-03 10:51:40', '2024-12-26 22:32:15'),
(34, 'corrupti ipsa iusto', 397.28, 'Beauty', 'products/default-product.png', 'Inactive', '2024-12-18 22:14:19', '2025-03-10 05:23:23'),
(35, 'sint enim omnis', 767.46, 'Home & Kitchen', 'products/default-product.png', 'Active', '2025-02-01 18:00:02', '2025-05-03 12:18:47'),
(36, 'sequi magni ipsum', 806.95, 'Sports', 'products/default-product.png', 'Inactive', '2024-06-04 00:03:50', '2025-03-24 01:13:02'),
(37, 'illum quaerat dolorem', 861.86, 'Sports', 'products/default-product.png', 'Inactive', '2025-03-01 11:27:17', '2025-03-20 12:57:03'),
(38, 'et expedita non', 95.05, 'Books', 'products/default-product.png', 'Active', '2024-08-03 10:46:12', '2025-02-10 21:45:52'),
(39, 'sint adipisci voluptas', 373.89, 'Clothing', 'products/default-product.png', 'Active', '2024-11-08 16:48:28', '2024-12-20 07:29:05'),
(40, 'esse cum placeat', 992.95, 'Books', 'products/default-product.png', 'Active', '2025-04-16 00:37:12', '2025-01-13 03:39:33'),
(41, 'quas vel maiores', 931.28, 'Sports', 'products/default-product.png', 'Inactive', '2025-02-12 09:58:41', '2025-05-06 12:34:56'),
(42, 'ipsam qui alias', 418.35, 'Clothing', 'products/default-product.png', 'Active', '2025-01-13 00:44:12', '2024-11-27 23:45:46'),
(43, 'eum esse repellendus', 270.68, 'Home & Kitchen', 'products/default-product.png', 'Inactive', '2024-06-23 23:29:36', '2025-05-12 23:45:10'),
(44, 'illo deleniti dolores', 802.90, 'Home & Kitchen', 'products/default-product.png', 'Inactive', '2025-03-23 13:49:52', '2025-03-30 15:26:53'),
(45, 'optio natus et', 14.11, 'Sports', 'products/default-product.png', 'Active', '2025-01-16 22:00:03', '2025-03-04 00:40:41'),
(46, 'error unde ea', 709.63, 'Toys', 'products/default-product.png', 'Active', '2024-07-18 05:04:35', '2025-02-15 05:18:31'),
(47, 'rerum perferendis vel', 575.31, 'Clothing', 'products/default-product.png', 'Inactive', '2024-10-25 11:47:41', '2025-02-20 14:59:45'),
(48, 'molestias quae et', 466.01, 'Automotive', 'products/default-product.png', 'Active', '2024-11-27 22:39:18', '2025-03-12 08:56:37'),
(49, 'vel quos quisquam', 855.14, 'Electronics', 'products/default-product.png', 'Inactive', '2025-01-06 20:59:10', '2024-12-18 12:12:30'),
(50, 'cumque eum dolores', 98.21, 'Home & Kitchen', 'products/default-product.png', 'Active', '2025-04-13 06:01:05', '2025-02-03 21:50:25'),
(51, 'architecto fuga suscipit', 811.01, 'Electronics', 'products/default-product.png', 'Active', '2024-05-31 09:28:48', '2025-01-28 08:34:42'),
(52, 'amet vel perspiciatis', 849.32, 'Beauty', 'products/default-product.png', 'Active', '2025-01-06 18:04:11', '2025-04-22 02:06:26'),
(53, 'ut quaerat laudantium', 310.07, 'Electronics', 'products/default-product.png', 'Active', '2024-06-23 12:12:43', '2025-04-08 13:01:16'),
(54, 'earum unde perferendis', 660.97, 'Clothing', 'products/default-product.png', 'Active', '2024-09-12 09:14:27', '2025-01-17 16:46:45'),
(55, 'distinctio commodi rerum', 44.19, 'Home & Kitchen', 'products/default-product.png', 'Active', '2024-11-13 03:26:25', '2025-01-26 00:05:07'),
(56, 'doloribus eos sit', 461.31, 'Books', 'products/default-product.png', 'Active', '2024-11-22 12:03:26', '2025-04-08 01:17:07'),
(57, 'minus recusandae alias', 795.71, 'Electronics', 'products/default-product.png', 'Active', '2024-06-10 09:59:10', '2025-01-30 07:06:51'),
(58, 'est laudantium quia', 722.63, 'Beauty', 'products/default-product.png', 'Active', '2024-06-03 10:19:33', '2025-01-15 10:32:22'),
(59, 'quod inventore est', 729.65, 'Toys', 'products/default-product.png', 'Active', '2024-06-20 07:02:47', '2025-02-01 23:06:58'),
(60, 'ipsum qui et', 154.00, 'Electronics', 'products/default-product.png', 'Active', '2024-09-19 08:28:19', '2025-01-19 05:39:12'),
(61, 'rerum tenetur quaerat', 508.90, 'Electronics', 'products/default-product.png', 'Active', '2024-10-22 00:10:55', '2025-02-18 01:23:00'),
(62, 'ipsam sit eos', 904.58, 'Toys', 'products/default-product.png', 'Active', '2025-01-06 06:58:16', '2025-04-28 11:12:50'),
(63, 'animi aut ut', 908.12, 'Electronics', 'products/default-product.png', 'Active', '2024-09-16 17:06:55', '2025-03-11 15:09:42'),
(64, 'voluptatibus nihil totam', 696.05, 'Sports', 'products/default-product.png', 'Active', '2024-10-16 09:59:03', '2025-01-31 18:51:31'),
(65, 'et illum ad', 276.86, 'Toys', 'products/default-product.png', 'Active', '2024-07-25 21:42:53', '2025-01-17 09:54:12'),
(66, 'cupiditate repellat perspiciatis', 143.16, 'Electronics', 'products/default-product.png', 'Active', '2025-01-15 21:16:43', '2025-04-11 13:11:58'),
(67, 'saepe maxime magni', 362.27, 'Electronics', 'products/default-product.png', 'Active', '2024-08-25 07:54:41', '2025-01-23 22:04:59'),
(68, 'sunt dolores hic', 638.33, 'Toys', 'products/default-product.png', 'Active', '2025-03-22 02:47:21', '2024-12-25 15:16:06'),
(69, 'officiis facilis soluta', 999.03, 'Electronics', 'products/default-product.png', 'Active', '2025-04-20 05:45:24', '2025-05-13 03:57:29'),
(70, 'laudantium dicta quod', 274.15, 'Toys', 'products/default-product.png', 'Active', '2025-04-08 17:27:13', '2025-02-10 16:18:08'),
(71, 'ipsum et voluptatum', 746.79, 'Home & Kitchen', 'products/default-product.png', 'Active', '2024-09-28 06:23:33', '2025-03-28 15:26:23'),
(72, 'alias aut placeat', 614.69, 'Clothing', 'products/default-product.png', 'Active', '2024-08-30 21:16:05', '2024-12-31 13:29:02'),
(73, 'porro vel vel', 678.05, 'Home & Kitchen', 'products/default-product.png', 'Active', '2025-04-16 14:08:54', '2025-04-20 07:20:51'),
(74, 'quas dolorem veritatis', 698.21, 'Clothing', 'products/default-product.png', 'Active', '2024-05-23 10:03:38', '2025-02-05 00:59:21'),
(75, 'qui repellat est', 615.65, 'Beauty', 'products/default-product.png', 'Active', '2025-03-31 13:16:37', '2024-11-30 06:59:48'),
(76, 'laboriosam rerum alias', 480.51, 'Clothing', 'products/default-product.png', 'Active', '2024-09-23 04:59:08', '2025-04-22 18:09:24'),
(77, 'repudiandae quo blanditiis', 117.46, 'Toys', 'products/default-product.png', 'Active', '2024-10-29 01:31:25', '2024-12-17 14:09:39'),
(78, 'necessitatibus excepturi et', 398.81, 'Beauty', 'products/default-product.png', 'Active', '2025-02-17 21:42:10', '2025-03-27 20:14:03'),
(79, 'et voluptate quod', 134.52, 'Automotive', 'products/default-product.png', 'Active', '2025-03-12 14:08:30', '2025-02-12 07:17:47'),
(80, 'et doloribus fuga', 18.98, 'Electronics', 'products/default-product.png', 'Active', '2024-07-20 04:02:14', '2025-01-18 23:55:33'),
(81, 'reprehenderit maxime reiciendis', 809.22, 'Clothing', 'products/default-product.png', 'Inactive', '2025-02-24 20:46:49', '2025-04-30 14:28:40'),
(82, 'corporis nihil illo', 584.07, 'Electronics', 'products/default-product.png', 'Inactive', '2025-04-20 20:06:35', '2025-04-06 11:28:46'),
(83, 'pariatur similique molestiae', 967.11, 'Sports', 'products/default-product.png', 'Inactive', '2024-10-07 01:34:59', '2025-03-22 07:07:59'),
(84, 'fugit beatae quas', 538.61, 'Home & Kitchen', 'products/default-product.png', 'Inactive', '2025-02-21 08:26:57', '2024-12-20 13:19:55'),
(85, 'delectus debitis minima', 725.55, 'Sports', 'products/default-product.png', 'Inactive', '2024-07-22 05:51:33', '2025-04-06 03:49:42'),
(86, 'reprehenderit officia reprehenderit', 759.97, 'Toys', 'products/default-product.png', 'Inactive', '2025-04-09 20:50:15', '2025-03-20 02:32:10'),
(87, 'odio provident aut', 525.41, 'Electronics', 'products/default-product.png', 'Inactive', '2025-01-03 19:38:21', '2025-04-29 18:51:55'),
(88, 'itaque explicabo quia', 456.00, 'Books', 'products/default-product.png', 'Inactive', '2024-09-07 23:20:11', '2025-02-15 21:41:03'),
(89, 'velit impedit aperiam', 791.70, 'Home & Kitchen', 'products/default-product.png', 'Inactive', '2024-08-25 15:07:36', '2025-02-04 10:42:19'),
(90, 'voluptatem molestias necessitatibus', 428.31, 'Automotive', 'products/default-product.png', 'Inactive', '2024-11-29 13:02:49', '2025-04-07 12:36:46'),
(91, 'accusamus nihil minima', 838.69, 'Toys', 'products/default-product.png', 'Inactive', '2024-09-04 11:08:47', '2025-04-03 17:42:48'),
(92, 'reprehenderit aspernatur et', 898.21, 'Toys', 'products/default-product.png', 'Inactive', '2024-10-11 16:42:22', '2025-03-21 21:45:08'),
(93, 'deserunt sed error', 457.59, 'Clothing', 'products/default-product.png', 'Inactive', '2024-10-24 15:07:24', '2025-02-07 15:20:12'),
(94, 'unde deserunt quidem', 536.20, 'Books', 'products/default-product.png', 'Inactive', '2024-11-30 03:09:17', '2025-04-29 05:42:22'),
(95, 'non amet quasi', 817.49, 'Automotive', 'products/default-product.png', 'Inactive', '2024-12-26 00:21:47', '2025-01-01 06:56:34'),
(96, 'dolorem perspiciatis rem', 103.26, 'Toys', 'products/default-product.png', 'Inactive', '2024-07-16 23:18:32', '2024-12-16 12:25:19'),
(97, 'qui aspernatur animi', 957.73, 'Books', 'products/default-product.png', 'Inactive', '2025-03-16 04:09:47', '2024-12-11 06:27:23'),
(98, 'eos quo magni', 635.13, 'Electronics', 'products/default-product.png', 'Inactive', '2024-07-23 10:32:23', '2025-05-10 03:14:25'),
(99, 'minima quas ut', 639.75, 'Beauty', 'products/default-product.png', 'Inactive', '2024-06-22 00:26:39', '2025-02-10 07:32:18'),
(100, 'autem atque libero', 624.42, 'Sports', 'products/default-product.png', 'Inactive', '2024-06-20 15:47:36', '2024-12-26 17:02:00'),
(102, 'Test Product', 99.99, 'Test Category', 'products/1747134592_default-product.png', 'Active', '2025-05-13 08:09:52', '2025-05-13 08:09:52'),
(103, 'Test Product', 99.99, 'Test Category', 'products/1747134663_default-product.png', 'Active', '2025-05-13 08:11:03', '2025-05-13 08:11:03');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('b6Ut3PYbyO2OgZrmMpGbL4Eijxs7oiXat8Z3EDjx', NULL, '127.0.0.1', 'PostmanRuntime/7.36.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMkhyV2RyTnNTOXdna0VIUkdRSjBuZkFLc3RDbVB2bDBXZkxubEhaSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1747134635),
('WroH3lBytHtZvQqKuSCLLftQRUlf7slUHN3d32OT', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:138.0) Gecko/20100101 Firefox/138.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoialB3WFRGS2FUWDNwMUZ1VTVndWdmN240NkpaeFc1ZDhDRnoyTjk3NSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1747137699);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2025-05-13 06:10:55', '$2y$12$XrylXVyQa17p1JhsEietC.bXIY2p1mFWCmeD6xaZz5LGH3tDacEPK', 'xhRNHnWm6P', '2025-05-13 06:10:55', '2025-05-13 06:10:55'),
(2, 'Admin User', 'admin@example.com', NULL, '$2y$12$UR7LlDZapEtzmceodGz/l.wdeH3LEHxOfy1u3gOW.pIQU8gBsIoBK', NULL, '2025-05-13 06:10:55', '2025-05-13 06:10:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`username`),
  ADD KEY `admins_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
