-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.28-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for shopping-list
DROP DATABASE IF EXISTS `shopping-list`;
CREATE DATABASE IF NOT EXISTS `shopping-list` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `shopping-list`;

-- Dumping structure for table shopping-list.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table shopping-list.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping structure for table shopping-list.items
DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `quantity` int(11) NOT NULL,
  `measure` enum('kos','l','ml','g','kg') NOT NULL,
  `Items` varchar(255) NOT NULL,
  `insertDate` datetime DEFAULT NULL,
  `buyDate` datetime DEFAULT NULL,
  `nakupljeno` tinyint(4) NOT NULL DEFAULT 0,
  `deleteItem` tinyint(4) NOT NULL DEFAULT 0,
  `deleteDay` datetime DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `items_user_id_foreign` (`user_id`),
  CONSTRAINT `items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table shopping-list.items: ~22 rows (approximately)
DELETE FROM `items`;
INSERT INTO `items` (`id`, `quantity`, `measure`, `Items`, `insertDate`, `buyDate`, `nakupljeno`, `deleteItem`, `deleteDay`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 3, 'kos', 'jajca L - škatla 10kom', '2024-01-11 12:49:20', '2024-01-11 22:26:11', 0, 0, '2024-01-11 23:41:06', 1, '2024-01-11 11:49:20', '2024-01-11 22:41:06'),
	(2, 9, 'kos', 'jogurt sadni 200ml', '2024-01-11 12:49:37', '2024-01-11 23:09:21', 0, 0, '2024-01-11 23:41:08', 1, '2024-01-11 11:49:37', '2024-01-11 22:41:08'),
	(3, 10, 'kos', 'mleko alpsko 1l', '2024-01-11 12:49:49', '2024-01-11 23:09:23', 0, 0, '2024-01-11 23:23:24', 1, '2024-01-11 11:49:49', '2024-01-11 22:23:24'),
	(4, 2, 'kos', 'Maslo 250g', '2024-01-11 12:49:59', '2024-01-11 12:50:09', 0, 0, '2024-01-11 23:24:45', 1, '2024-01-11 11:49:59', '2024-01-11 22:24:45'),
	(5, 1, 'kos', 'mleko alpsko 1l', '2024-01-11 22:37:11', NULL, 0, 0, '2024-01-11 23:24:58', 1, '2024-01-11 21:37:11', '2024-01-11 22:24:58'),
	(6, 2, 'kos', 'jajca L - škatla 10kom', '2024-01-11 22:37:23', NULL, 0, 0, '2024-01-11 23:27:31', 1, '2024-01-11 21:37:23', '2024-01-11 22:27:31'),
	(7, 3, 'kos', 'jajca L - škatla 10kom', '2024-01-11 22:37:31', NULL, 0, 0, '2024-01-11 23:28:49', 1, '2024-01-11 21:37:31', '2024-01-11 22:28:49'),
	(8, 4, 'kos', 'jajca L - škatla 10kom', '2024-01-11 22:37:39', NULL, 0, 0, '2024-01-11 23:29:47', 1, '2024-01-11 21:37:39', '2024-01-11 22:29:47'),
	(9, 1, 'kos', 'mleko alpsko 1l', '2024-01-11 22:37:52', NULL, 0, 0, '2024-01-11 23:31:53', 1, '2024-01-11 21:37:52', '2024-01-11 22:31:53'),
	(10, 2, 'kos', 'mleko alpsko 1l', '2024-01-11 22:38:02', NULL, 0, 0, '2024-01-11 23:36:22', 1, '2024-01-11 21:38:02', '2024-01-11 22:36:22'),
	(11, 4, 'kos', 'mleko alpsko 1l', '2024-01-11 22:38:09', NULL, 0, 0, '2024-01-11 23:36:48', 1, '2024-01-11 21:38:09', '2024-01-11 22:36:48'),
	(12, 1, 'kos', 'jogurt 200ml', '2024-01-11 22:38:33', NULL, 0, 0, '2024-01-11 23:38:29', 1, '2024-01-11 21:38:33', '2024-01-11 22:38:29'),
	(13, 2, 'kos', 'jogurt sadni 200ml', '2024-01-11 22:38:43', NULL, 0, 0, '2024-01-11 23:38:32', 1, '2024-01-11 21:38:43', '2024-01-11 22:38:32'),
	(14, 3, 'kos', 'jogurt sadni 200ml', '2024-01-11 22:38:50', NULL, 0, 0, '2024-01-11 23:38:36', 1, '2024-01-11 21:38:50', '2024-01-11 22:38:36'),
	(15, 4, 'kos', 'jogurt sadni 200ml', '2024-01-11 22:38:56', NULL, 0, 0, NULL, 1, '2024-01-11 21:38:56', '2024-01-11 21:38:56'),
	(16, 5, 'kos', 'jogurt sadni 200ml', '2024-01-11 22:39:04', NULL, 0, 0, NULL, 1, '2024-01-11 21:39:04', '2024-01-11 21:39:04'),
	(17, 6, 'kos', 'jogurt sadni 200ml', '2024-01-11 22:39:11', NULL, 0, 0, NULL, 1, '2024-01-11 21:39:11', '2024-01-11 21:39:11'),
	(18, 1, 'kos', 'posebna salama 100g', '2024-01-11 22:39:30', NULL, 0, 0, NULL, 1, '2024-01-11 21:39:30', '2024-01-11 21:39:30'),
	(19, 2, 'kos', 'posebna salama 100g', '2024-01-11 22:39:37', NULL, 0, 0, NULL, 1, '2024-01-11 21:39:37', '2024-01-11 21:39:37'),
	(20, 3, 'kos', 'posebna salama 100g', '2024-01-11 22:39:45', NULL, 0, 0, NULL, 1, '2024-01-11 21:39:45', '2024-01-11 21:39:45'),
	(21, 4, 'kos', 'posebna salama 100g', '2024-01-11 22:39:51', NULL, 0, 1, '2024-01-12 00:01:15', 1, '2024-01-11 21:39:51', '2024-01-11 23:01:15'),
	(22, 5, 'kos', 'posebna salama 100g', '2024-01-11 22:40:04', NULL, 0, 1, '2024-01-12 00:28:37', 1, '2024-01-11 21:40:04', '2024-01-11 23:28:37');

-- Dumping structure for table shopping-list.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table shopping-list.migrations: ~6 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(6, '2024_01_09_133219_create_items_table', 2),
	(8, '2024_01_11_123556_create_shopping_logs_table', 3);

-- Dumping structure for table shopping-list.password_reset_tokens
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table shopping-list.password_reset_tokens: ~0 rows (approximately)
DELETE FROM `password_reset_tokens`;

-- Dumping structure for table shopping-list.personal_access_tokens
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table shopping-list.personal_access_tokens: ~0 rows (approximately)
DELETE FROM `personal_access_tokens`;

-- Dumping structure for table shopping-list.shopping_logs
DROP TABLE IF EXISTS `shopping_logs`;
CREATE TABLE IF NOT EXISTS `shopping_logs` (
  `LogId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` bigint(20) unsigned NOT NULL,
  `action` enum('create','edit','delete','buy') NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`LogId`),
  KEY `shopping_logs_item_id_foreign` (`item_id`),
  KEY `shopping_logs_user_id_foreign` (`user_id`),
  CONSTRAINT `shopping_logs_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `shopping_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table shopping-list.shopping_logs: ~62 rows (approximately)
DELETE FROM `shopping_logs`;
INSERT INTO `shopping_logs` (`LogId`, `item_id`, `action`, `user_id`, `date`) VALUES
	(1, 1, 'create', 2, '2024-01-11 12:49:20'),
	(2, 2, 'create', 2, '2024-01-11 12:49:37'),
	(3, 3, 'create', 2, '2024-01-11 12:49:49'),
	(4, 4, 'create', 2, '2024-01-11 12:49:59'),
	(5, 4, 'buy', 2, '2024-01-11 12:50:09'),
	(6, 4, 'delete', 1, '2024-01-11 12:50:44'),
	(7, 2, 'edit', 1, '2024-01-11 12:52:09'),
	(8, 2, 'edit', 1, '2024-01-11 12:53:59'),
	(9, 1, 'buy', 1, '2024-01-11 21:35:08'),
	(10, 2, 'buy', 1, '2024-01-11 21:52:57'),
	(11, 1, 'delete', 1, '2024-01-11 21:53:23'),
	(12, 1, 'delete', 1, '2024-01-11 21:53:31'),
	(13, 3, 'edit', 1, '2024-01-11 21:54:03'),
	(14, 2, 'delete', 1, '2024-01-11 21:54:13'),
	(15, 1, 'edit', 1, '2024-01-11 21:57:35'),
	(16, 1, 'buy', 1, '2024-01-11 22:26:11'),
	(17, 1, 'delete', 1, '2024-01-11 22:26:14'),
	(18, 2, 'edit', 1, '2024-01-11 22:34:53'),
	(19, 5, 'create', 1, '2024-01-11 22:37:11'),
	(20, 6, 'create', 1, '2024-01-11 22:37:23'),
	(21, 7, 'create', 1, '2024-01-11 22:37:31'),
	(22, 8, 'create', 1, '2024-01-11 22:37:39'),
	(23, 9, 'create', 1, '2024-01-11 22:37:52'),
	(24, 10, 'create', 1, '2024-01-11 22:38:02'),
	(25, 11, 'create', 1, '2024-01-11 22:38:09'),
	(26, 12, 'create', 1, '2024-01-11 22:38:33'),
	(27, 13, 'create', 1, '2024-01-11 22:38:43'),
	(28, 14, 'create', 1, '2024-01-11 22:38:50'),
	(29, 15, 'create', 1, '2024-01-11 22:38:56'),
	(30, 16, 'create', 1, '2024-01-11 22:39:04'),
	(31, 17, 'create', 1, '2024-01-11 22:39:11'),
	(32, 18, 'create', 1, '2024-01-11 22:39:30'),
	(33, 19, 'create', 1, '2024-01-11 22:39:37'),
	(34, 20, 'create', 1, '2024-01-11 22:39:45'),
	(35, 21, 'create', 1, '2024-01-11 22:39:51'),
	(36, 22, 'create', 1, '2024-01-11 22:40:04'),
	(37, 2, 'buy', 1, '2024-01-11 23:09:21'),
	(38, 3, 'buy', 1, '2024-01-11 23:09:23'),
	(39, 3, 'delete', 1, '2024-01-11 23:09:25'),
	(40, 2, 'delete', 1, '2024-01-11 23:09:28'),
	(41, 3, 'delete', 1, '2024-01-11 23:14:13'),
	(42, 2, 'delete', 1, '2024-01-11 23:14:16'),
	(43, 1, 'delete', 1, '2024-01-11 23:15:00'),
	(44, 2, 'delete', 1, '2024-01-11 23:18:14'),
	(45, 3, 'delete', 1, '2024-01-11 23:23:24'),
	(46, 4, 'delete', 1, '2024-01-11 23:24:46'),
	(47, 5, 'delete', 1, '2024-01-11 23:24:58'),
	(48, 6, 'delete', 1, '2024-01-11 23:27:12'),
	(49, 6, 'delete', 1, '2024-01-11 23:27:31'),
	(50, 7, 'delete', 1, '2024-01-11 23:28:49'),
	(51, 8, 'delete', 1, '2024-01-11 23:29:47'),
	(52, 9, 'delete', 1, '2024-01-11 23:31:53'),
	(53, 10, 'delete', 1, '2024-01-11 23:36:22'),
	(54, 11, 'edit', 1, '2024-01-11 23:36:45'),
	(55, 11, 'delete', 1, '2024-01-11 23:36:48'),
	(56, 12, 'delete', 1, '2024-01-11 23:38:29'),
	(57, 13, 'delete', 1, '2024-01-11 23:38:32'),
	(58, 14, 'delete', 1, '2024-01-11 23:38:36'),
	(59, 21, 'delete', 1, '2024-01-11 23:40:51'),
	(60, 22, 'delete', 1, '2024-01-11 23:40:53'),
	(61, 1, 'delete', 1, '2024-01-11 23:41:06'),
	(62, 2, 'delete', 1, '2024-01-11 23:41:08'),
	(63, 21, 'delete', 1, '2024-01-11 23:45:07'),
	(64, 22, 'delete', 1, '2024-01-11 23:45:09'),
	(65, 21, 'delete', 1, '2024-01-11 23:47:14'),
	(66, 22, 'delete', 1, '2024-01-11 23:47:17'),
	(67, 21, 'delete', 1, '2024-01-11 23:49:43'),
	(68, 22, 'delete', 1, '2024-01-11 23:49:44'),
	(69, 21, 'delete', 1, '2024-01-11 23:51:26'),
	(70, 22, 'delete', 1, '2024-01-11 23:51:28'),
	(71, 21, 'delete', 1, '2024-01-11 23:53:54'),
	(72, 22, 'delete', 1, '2024-01-11 23:53:56'),
	(73, 21, 'delete', 1, '2024-01-12 00:01:15'),
	(74, 22, 'delete', 1, '2024-01-12 00:01:17'),
	(75, 22, 'delete', 1, '2024-01-12 00:04:15'),
	(76, 22, 'delete', 1, '2024-01-12 00:07:05'),
	(77, 22, 'delete', 1, '2024-01-12 00:14:13'),
	(78, 22, 'delete', 1, '2024-01-12 00:16:38'),
	(79, 22, 'delete', 1, '2024-01-12 00:17:54'),
	(80, 22, 'delete', 1, '2024-01-12 00:19:19'),
	(81, 22, 'delete', 1, '2024-01-12 00:21:05'),
	(82, 22, 'delete', 1, '2024-01-12 00:25:03'),
	(83, 22, 'delete', 1, '2024-01-12 00:27:38'),
	(84, 22, 'delete', 1, '2024-01-12 00:28:37');

-- Dumping structure for table shopping-list.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table shopping-list.users: ~2 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'bostjan', 'bosty33@gmail.com', NULL, '$2y$12$bgZHIERb1.LZNMC54udAJeXqP1466MDkDtT8oAdlqrv6MHgwh2SOW', NULL, '2024-01-10 11:18:16', '2024-01-10 11:18:16'),
	(2, 'Bostjanko', 'bostjan.blueoceangaming@gmail.com', NULL, '$2y$12$RFVuOb0qRevVQGIiriwnM.nCNcUZbHLYPy8/9YEGAueutaWogmksa', NULL, '2024-01-10 11:31:05', '2024-01-10 11:31:05');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
