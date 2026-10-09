-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for dbyp
CREATE DATABASE IF NOT EXISTS `dbyp` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `dbyp`;

-- Dumping structure for table dbyp.dbyp_categories
CREATE TABLE IF NOT EXISTS `dbyp_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `parent_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dbyp_categories_slug_unique` (`slug`),
  KEY `dbyp_categories_parent_id_foreign` (`parent_id`),
  CONSTRAINT `dbyp_categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `dbyp_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dbyp.dbyp_categories: ~2 rows (approximately)
INSERT INTO `dbyp_categories` (`id`, `name`, `slug`, `description`, `parent_id`, `created_at`, `updated_at`) VALUES
	(1, 'Facilities & Infrastructure', 'facilities-infrastructure', NULL, NULL, '2026-09-03 04:14:42', '2026-09-03 04:14:42'),
	(2, 'Comments & Testimonials', 'comments-testimonials', NULL, NULL, '2026-09-03 04:22:08', '2026-09-03 04:22:08');

-- Dumping structure for table dbyp.dbyp_contact_form
CREATE TABLE IF NOT EXISTS `dbyp_contact_form` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dbyp.dbyp_contact_form: ~0 rows (approximately)
INSERT INTO `dbyp_contact_form` (`id`, `name`, `phone`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
	(1, 'Alex Suriya', NULL, 'alexsuriya@dbcyelagiri.edu.in', NULL, NULL, '2026-09-03 06:15:02', '2026-09-03 06:15:02');

-- Dumping structure for table dbyp.dbyp_curator
CREATE TABLE IF NOT EXISTS `dbyp_curator` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  `directory` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'media',
  `visibility` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `width` int unsigned DEFAULT NULL,
  `height` int unsigned DEFAULT NULL,
  `size` int unsigned DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'image',
  `ext` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `caption` text COLLATE utf8mb4_unicode_ci,
  `exif` text COLLATE utf8mb4_unicode_ci,
  `curations` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dbyp.dbyp_curator: ~4 rows (approximately)
INSERT INTO `dbyp_curator` (`id`, `disk`, `directory`, `visibility`, `name`, `path`, `width`, `height`, `size`, `type`, `ext`, `alt`, `title`, `description`, `caption`, `exif`, `curations`, `created_at`, `updated_at`) VALUES
	(1, 'public', 'file-manager/photo_gallery/2026/album', 'public', 'facility-campus', 'file-manager/photo_gallery/2026/album/facility-campus.jpg', 1264, 848, 1254152, 'image/jpeg', 'jpg', NULL, 'facility-campus', NULL, NULL, '{"FILE":{"FileName":"VGvMGyMtw3UuqHFGF6wZyZAqzj9Ig0uOer9AKnZI.jpg","FileDateTime":1788429559,"FileSize":1254152,"FileType":2,"MimeType":"image\\/jpeg","SectionsFound":""},"COMPUTED":{"html":"width=\\"1264\\" height=\\"848\\"","Height":848,"Width":1264,"IsColor":1}}', NULL, '2026-09-03 04:30:27', '2026-09-03 04:30:27'),
	(2, 'public', 'file-manager/photo_gallery/2026/album', 'public', 'facility-counsel', 'file-manager/photo_gallery/2026/album/facility-counsel.jpg', 1264, 848, 790684, 'image/jpeg', 'jpg', NULL, 'facility-counsel', NULL, NULL, '{"FILE":{"FileName":"If9DvvsqbYJb8hY9dKn5Owm3G10rF8cEO8VUntjI.jpg","FileDateTime":1788429560,"FileSize":790684,"FileType":2,"MimeType":"image\\/jpeg","SectionsFound":""},"COMPUTED":{"html":"width=\\"1264\\" height=\\"848\\"","Height":848,"Width":1264,"IsColor":1}}', NULL, '2026-09-03 04:30:27', '2026-09-03 04:30:27'),
	(3, 'public', 'file-manager/photo_gallery/2026/album', 'public', 'facility-recreation', 'file-manager/photo_gallery/2026/album/facility-recreation.jpg', 1264, 848, 1240524, 'image/jpeg', 'jpg', NULL, 'facility-recreation', NULL, NULL, '{"FILE":{"FileName":"VKK5qH7hBdA5vDoPNo4pOLuMl3XSy8ha5E14AHYQ.jpg","FileDateTime":1788429563,"FileSize":1240524,"FileType":2,"MimeType":"image\\/jpeg","SectionsFound":""},"COMPUTED":{"html":"width=\\"1264\\" height=\\"848\\"","Height":848,"Width":1264,"IsColor":1}}', NULL, '2026-09-03 04:30:27', '2026-09-03 04:30:27'),
	(4, 'public', 'file-manager/photo_gallery/2026/album', 'public', 'facility-library', 'file-manager/photo_gallery/2026/album/facility-library.jpg', 1264, 848, 923182, 'image/jpeg', 'jpg', NULL, 'facility-library', NULL, NULL, '{"FILE":{"FileName":"aNvFDWUvCvOnNuNEAZU0vpklmaWGpg0BUxZFm8Be.jpg","FileDateTime":1788429563,"FileSize":923182,"FileType":2,"MimeType":"image\\/jpeg","SectionsFound":""},"COMPUTED":{"html":"width=\\"1264\\" height=\\"848\\"","Height":848,"Width":1264,"IsColor":1}}', NULL, '2026-09-03 04:30:27', '2026-09-03 04:30:27');

-- Dumping structure for table dbyp.dbyp_failed_jobs
CREATE TABLE IF NOT EXISTS `dbyp_failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dbyp_failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dbyp.dbyp_failed_jobs: ~0 rows (approximately)

-- Dumping structure for table dbyp.dbyp_flash_news
CREATE TABLE IF NOT EXISTS `dbyp_flash_news` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `open_in_new_tab` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `publish_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dbyp_flash_news_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dbyp.dbyp_flash_news: ~0 rows (approximately)

-- Dumping structure for table dbyp.dbyp_menuses
CREATE TABLE IF NOT EXISTS `dbyp_menuses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `order_by` int DEFAULT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `is_url` tinyint(1) NOT NULL DEFAULT '0',
  `url` longtext COLLATE utf8mb4_unicode_ci,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dbyp_menuses_parent_id_foreign` (`parent_id`),
  CONSTRAINT `dbyp_menuses_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `dbyp_menuses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dbyp.dbyp_menuses: ~11 rows (approximately)
INSERT INTO `dbyp_menuses` (`id`, `type`, `name`, `status`, `order_by`, `parent_id`, `is_url`, `url`, `target`, `created_at`, `updated_at`) VALUES
	(2, 'main_menu', 'About Us', 1, 1, NULL, 0, NULL, NULL, '2026-09-03 05:04:07', '2026-09-03 05:04:07'),
	(3, 'sub_menu', 'Our Centre', 1, 1, 2, 0, NULL, NULL, '2026-09-03 05:04:19', '2026-09-03 06:04:37'),
	(4, 'sub_menu', 'Director\'s Message', 1, 2, 2, 0, NULL, NULL, '2026-09-03 05:04:31', '2026-09-03 06:04:26'),
	(5, 'sub_menu', 'Vision & Mission', 1, 3, 2, 0, NULL, NULL, '2026-09-03 05:04:48', '2026-09-03 05:04:48'),
	(6, 'sub_menu', 'Management', 1, 4, 2, 0, NULL, NULL, '2026-09-03 05:04:57', '2026-09-03 05:04:57'),
	(7, 'main_menu', 'Faculty', 1, 2, NULL, 0, NULL, NULL, '2026-09-03 05:05:08', '2026-09-03 05:05:08'),
	(8, 'main_menu', 'Facilities', 1, 3, NULL, 0, NULL, NULL, '2026-09-03 05:05:15', '2026-09-03 05:05:15'),
	(9, 'main_menu', 'Registration', 1, 4, NULL, 0, NULL, NULL, '2026-09-03 05:05:22', '2026-09-03 05:05:22'),
	(10, 'main_menu', 'Courses', 1, 5, NULL, 0, NULL, NULL, '2026-09-03 05:05:30', '2026-09-03 05:05:30'),
	(11, 'main_menu', 'Alumni', 1, 6, NULL, 0, NULL, NULL, '2026-09-03 05:05:40', '2026-09-03 05:05:40'),
	(12, 'main_menu', 'Contact Us', 1, 7, NULL, 0, NULL, NULL, '2026-09-03 05:05:48', '2026-09-03 05:05:48');

-- Dumping structure for table dbyp.dbyp_migrations
CREATE TABLE IF NOT EXISTS `dbyp_migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dbyp.dbyp_migrations: ~27 rows (approximately)
INSERT INTO `dbyp_migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2024_08_06_082402_create_menus_table', 1),
	(6, '2024_08_06_082415_create_slider_table', 1),
	(7, '2024_08_06_082433_create_post_table', 1),
	(8, '2024_08_06_082445_create_page_table', 1),
	(9, '2024_08_06_082500_create_photo_gallery_table', 1),
	(10, '2024_08_09_145905_create_category_table', 1),
	(11, '2024_08_23_061203_create_contact_form_table', 1),
	(12, '2024_08_27_120235_create_media_table', 1),
	(13, '2024_08_28_154304_create_pivot_category_table', 1),
	(14, '2024_09_06_043854_create_video_gallery_table', 1),
	(15, '2024_11_21_054134_create_photo_gallery_media_table', 1),
	(16, '2025_03_24_070148_create_popups_table', 1),
	(17, '2026_03_13_104900_update_sliders_table', 1),
	(18, '2026_03_30_155620_create_newsletters_table', 1),
	(19, '2026_04_15_120000_create_flash_news_table', 1),
	(20, '2026_04_27_061119_add_open_in_new_tab_to_flash_news_table', 1),
	(21, '2026_05_12_093415_flatten_translations_data', 1),
	(22, '2026_05_13_085514_create_news_table', 1),
	(23, '2026_06_06_091500_add_link_fields_to_sliders_table', 1),
	(24, '2026_06_06_092000_create_upcoming_events_table', 1),
	(25, '2026_09_02_043100_create_permission_tables', 2),
	(26, '2026_09_03_093656_add_feature_image_new_to_pages_table', 3),
	(27, '2026_09_03_120000_fill_missing_menu_order_by_values', 4),
	(28, '2026_09_04_120000_create_registration_submissions_table', 5),
	(29, '2026_09_04_121000_drop_mobile_from_registration_submissions_table', 6);

-- Dumping structure for table dbyp.dbyp_model_has_permissions
CREATE TABLE IF NOT EXISTS `dbyp_model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `dbyp_model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `dbyp_permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dbyp.dbyp_model_has_permissions: ~0 rows (approximately)

-- Dumping structure for table dbyp.dbyp_model_has_roles
CREATE TABLE IF NOT EXISTS `dbyp_model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `dbyp_model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `dbyp_roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dbyp.dbyp_model_has_roles: ~0 rows (approximately)
INSERT INTO `dbyp_model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1);

-- Dumping structure for table dbyp.dbyp_news
CREATE TABLE IF NOT EXISTS `dbyp_news` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `feature_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` json DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `order_by` int DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dbyp_news_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dbyp.dbyp_news: ~0 rows (approximately)

-- Dumping structure for table dbyp.dbyp_newsletters
CREATE TABLE IF NOT EXISTS `dbyp_newsletters` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dbyp_newsletters_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dbyp.dbyp_newsletters: ~0 rows (approximately)

-- Dumping structure for table dbyp.dbyp_pages
CREATE TABLE IF NOT EXISTS `dbyp_pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `feature_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feature_image_new` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` json DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `order_by` int DEFAULT NULL,
  `publish_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dbyp_pages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dbyp.dbyp_pages: ~11 rows (approximately)
INSERT INTO `dbyp_pages` (`id`, `menu_id`, `title`, `slug`, `excerpt`, `feature_image`, `feature_image_new`, `author`, `content`, `status`, `order_by`, `publish_date`, `created_at`, `updated_at`) VALUES
	(1, 2, 'About Us', 'about-us', '<blockquote><p>Don Bosco Renewal Centre, Bangalore, (formerly known as Don Bosco Yuva Prachodini) is a <strong>Salesian National Training Centre</strong> that offers courses in ongoing formation for priests, religious and laity. This centre was realised as a dream for an institution to cater to the ever growing demand for on-going formation of Salesians (SDFs) of India and neighbouring countries.</p><p>However, soon after its inception, the Centre was opened out to all priests, religious and laity who wished to profit from the courses offered here.</p></blockquote>', 'file-manager/page/feature_image/about1.jpg', 'file-manager/page/feature_image_new/about2.jpg', NULL, '[]', 1, NULL, '2026-09-03', '2026-09-03 05:04:07', '2026-09-03 05:27:26'),
	(2, 3, 'Our Centre', 'about-us-our-centre', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2026-09-03', '2026-09-03 05:04:19', '2026-09-03 05:04:19'),
	(3, 4, 'Director\'s Message', 'about-us-directors-message', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2026-09-03', '2026-09-03 05:04:31', '2026-09-03 05:04:31'),
	(4, 5, 'Vision & Mission', 'about-us-vision-mission', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2026-09-03', '2026-09-03 05:04:48', '2026-09-03 05:04:48'),
	(5, 6, 'Management', 'about-us-management', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2026-09-03', '2026-09-03 05:04:57', '2026-09-03 05:04:57'),
	(6, 7, 'Faculty', 'faculty', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2026-09-03', '2026-09-03 05:05:08', '2026-09-03 05:05:08'),
	(7, 8, 'Facilities', 'facilities', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2026-09-03', '2026-09-03 05:05:15', '2026-09-03 05:05:15'),
	(8, 9, 'Registration', 'registration', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2026-09-03', '2026-09-03 05:05:22', '2026-09-03 05:05:22'),
	(9, 10, 'Courses', 'courses', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2026-09-03', '2026-09-03 05:05:30', '2026-09-03 05:05:30'),
	(10, 11, 'Alumni', 'alumni', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2026-09-03', '2026-09-03 05:05:40', '2026-09-03 05:05:40'),
	(11, 12, 'Contact Us', 'contact-us', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2026-09-03', '2026-09-03 05:05:48', '2026-09-03 05:05:48');

-- Dumping structure for table dbyp.dbyp_password_resets
CREATE TABLE IF NOT EXISTS `dbyp_password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `dbyp_password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dbyp.dbyp_password_resets: ~0 rows (approximately)

-- Dumping structure for table dbyp.dbyp_permissions
CREATE TABLE IF NOT EXISTS `dbyp_permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dbyp_permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dbyp.dbyp_permissions: ~180 rows (approximately)
INSERT INTO `dbyp_permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'ViewAny:Role', 'web', '2026-09-01 23:01:13', '2026-09-01 23:01:13'),
	(2, 'View:Role', 'web', '2026-09-01 23:01:13', '2026-09-01 23:01:13'),
	(3, 'Create:Role', 'web', '2026-09-01 23:01:13', '2026-09-01 23:01:13'),
	(4, 'Update:Role', 'web', '2026-09-01 23:01:13', '2026-09-01 23:01:13'),
	(5, 'Delete:Role', 'web', '2026-09-01 23:01:13', '2026-09-01 23:01:13'),
	(6, 'DeleteAny:Role', 'web', '2026-09-01 23:01:13', '2026-09-01 23:01:13'),
	(7, 'Restore:Role', 'web', '2026-09-01 23:01:13', '2026-09-01 23:01:13'),
	(8, 'ForceDelete:Role', 'web', '2026-09-01 23:01:13', '2026-09-01 23:01:13'),
	(9, 'ForceDeleteAny:Role', 'web', '2026-09-01 23:01:13', '2026-09-01 23:01:13'),
	(10, 'RestoreAny:Role', 'web', '2026-09-01 23:01:13', '2026-09-01 23:01:13'),
	(11, 'Replicate:Role', 'web', '2026-09-01 23:01:13', '2026-09-01 23:01:13'),
	(12, 'Reorder:Role', 'web', '2026-09-01 23:01:13', '2026-09-01 23:01:13'),
	(13, 'ViewAny:Category', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(14, 'View:Category', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(15, 'Create:Category', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(16, 'Update:Category', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(17, 'Delete:Category', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(18, 'DeleteAny:Category', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(19, 'Restore:Category', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(20, 'ForceDelete:Category', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(21, 'ForceDeleteAny:Category', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(22, 'RestoreAny:Category', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(23, 'Replicate:Category', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(24, 'Reorder:Category', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(25, 'ViewAny:Contact', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(26, 'View:Contact', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(27, 'Create:Contact', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(28, 'Update:Contact', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(29, 'Delete:Contact', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(30, 'DeleteAny:Contact', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(31, 'Restore:Contact', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(32, 'ForceDelete:Contact', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(33, 'ForceDeleteAny:Contact', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(34, 'RestoreAny:Contact', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(35, 'Replicate:Contact', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(36, 'Reorder:Contact', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(37, 'ViewAny:FlashNews', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(38, 'View:FlashNews', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(39, 'Create:FlashNews', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(40, 'Update:FlashNews', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(41, 'Delete:FlashNews', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(42, 'DeleteAny:FlashNews', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(43, 'Restore:FlashNews', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(44, 'ForceDelete:FlashNews', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(45, 'ForceDeleteAny:FlashNews', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(46, 'RestoreAny:FlashNews', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(47, 'Replicate:FlashNews', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(48, 'Reorder:FlashNews', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(49, 'ViewAny:Media', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(50, 'View:Media', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(51, 'Create:Media', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(52, 'Update:Media', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(53, 'Delete:Media', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(54, 'DeleteAny:Media', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(55, 'Restore:Media', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(56, 'ForceDelete:Media', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(57, 'ForceDeleteAny:Media', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(58, 'RestoreAny:Media', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(59, 'Replicate:Media', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(60, 'Reorder:Media', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(61, 'ViewAny:Menus', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(62, 'View:Menus', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(63, 'Create:Menus', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(64, 'Update:Menus', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(65, 'Delete:Menus', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(66, 'DeleteAny:Menus', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(67, 'Restore:Menus', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(68, 'ForceDelete:Menus', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(69, 'ForceDeleteAny:Menus', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(70, 'RestoreAny:Menus', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(71, 'Replicate:Menus', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(72, 'Reorder:Menus', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(73, 'ViewAny:News', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(74, 'View:News', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(75, 'Create:News', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(76, 'Update:News', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(77, 'Delete:News', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(78, 'DeleteAny:News', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(79, 'Restore:News', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(80, 'ForceDelete:News', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(81, 'ForceDeleteAny:News', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(82, 'RestoreAny:News', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(83, 'Replicate:News', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(84, 'Reorder:News', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(85, 'ViewAny:Pages', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(86, 'View:Pages', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(87, 'Create:Pages', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(88, 'Update:Pages', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(89, 'Delete:Pages', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(90, 'DeleteAny:Pages', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(91, 'Restore:Pages', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(92, 'ForceDelete:Pages', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(93, 'ForceDeleteAny:Pages', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(94, 'RestoreAny:Pages', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(95, 'Replicate:Pages', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(96, 'Reorder:Pages', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(97, 'ViewAny:PhotoGallery', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(98, 'View:PhotoGallery', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(99, 'Create:PhotoGallery', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(100, 'Update:PhotoGallery', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(101, 'Delete:PhotoGallery', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(102, 'DeleteAny:PhotoGallery', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(103, 'Restore:PhotoGallery', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(104, 'ForceDelete:PhotoGallery', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(105, 'ForceDeleteAny:PhotoGallery', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(106, 'RestoreAny:PhotoGallery', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(107, 'Replicate:PhotoGallery', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(108, 'Reorder:PhotoGallery', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(109, 'ViewAny:Popup', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(110, 'View:Popup', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(111, 'Create:Popup', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(112, 'Update:Popup', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(113, 'Delete:Popup', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(114, 'DeleteAny:Popup', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(115, 'Restore:Popup', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(116, 'ForceDelete:Popup', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(117, 'ForceDeleteAny:Popup', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(118, 'RestoreAny:Popup', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(119, 'Replicate:Popup', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(120, 'Reorder:Popup', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(121, 'ViewAny:Posts', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(122, 'View:Posts', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(123, 'Create:Posts', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(124, 'Update:Posts', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(125, 'Delete:Posts', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(126, 'DeleteAny:Posts', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(127, 'Restore:Posts', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(128, 'ForceDelete:Posts', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(129, 'ForceDeleteAny:Posts', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(130, 'RestoreAny:Posts', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(131, 'Replicate:Posts', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(132, 'Reorder:Posts', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(133, 'ViewAny:Sliders', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(134, 'View:Sliders', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(135, 'Create:Sliders', 'web', '2026-09-03 03:50:37', '2026-09-03 03:50:37'),
	(136, 'Update:Sliders', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(137, 'Delete:Sliders', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(138, 'DeleteAny:Sliders', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(139, 'Restore:Sliders', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(140, 'ForceDelete:Sliders', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(141, 'ForceDeleteAny:Sliders', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(142, 'RestoreAny:Sliders', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(143, 'Replicate:Sliders', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(144, 'Reorder:Sliders', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(145, 'ViewAny:UpcomingEvents', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(146, 'View:UpcomingEvents', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(147, 'Create:UpcomingEvents', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(148, 'Update:UpcomingEvents', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(149, 'Delete:UpcomingEvents', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(150, 'DeleteAny:UpcomingEvents', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(151, 'Restore:UpcomingEvents', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(152, 'ForceDelete:UpcomingEvents', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(153, 'ForceDeleteAny:UpcomingEvents', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(154, 'RestoreAny:UpcomingEvents', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(155, 'Replicate:UpcomingEvents', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(156, 'Reorder:UpcomingEvents', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(157, 'ViewAny:User', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(158, 'View:User', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(159, 'Create:User', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(160, 'Update:User', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(161, 'Delete:User', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(162, 'DeleteAny:User', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(163, 'Restore:User', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(164, 'ForceDelete:User', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(165, 'ForceDeleteAny:User', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(166, 'RestoreAny:User', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(167, 'Replicate:User', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(168, 'Reorder:User', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(169, 'ViewAny:VideoGallery', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(170, 'View:VideoGallery', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(171, 'Create:VideoGallery', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(172, 'Update:VideoGallery', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(173, 'Delete:VideoGallery', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(174, 'DeleteAny:VideoGallery', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(175, 'Restore:VideoGallery', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(176, 'ForceDelete:VideoGallery', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(177, 'ForceDeleteAny:VideoGallery', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(178, 'RestoreAny:VideoGallery', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(179, 'Replicate:VideoGallery', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38'),
	(180, 'Reorder:VideoGallery', 'web', '2026-09-03 03:50:38', '2026-09-03 03:50:38');

-- Dumping structure for table dbyp.dbyp_personal_access_tokens
CREATE TABLE IF NOT EXISTS `dbyp_personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dbyp_personal_access_tokens_token_unique` (`token`),
  KEY `dbyp_personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dbyp.dbyp_personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table dbyp.dbyp_photo_galleries
CREATE TABLE IF NOT EXISTS `dbyp_photo_galleries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` longtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `order_by` int DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dbyp_photo_galleries_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dbyp.dbyp_photo_galleries: ~0 rows (approximately)
INSERT INTO `dbyp_photo_galleries` (`id`, `title`, `slug`, `description`, `images`, `status`, `order_by`, `publish_date`, `created_at`, `updated_at`) VALUES
	(1, 'Album', 'album', 'Album', NULL, 1, NULL, '2026-09-03', '2026-09-03 04:30:44', '2026-09-03 04:30:44');

-- Dumping structure for table dbyp.dbyp_photo_gallery_media
CREATE TABLE IF NOT EXISTS `dbyp_photo_gallery_media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `photo_gallery_id` bigint unsigned NOT NULL,
  `media_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dbyp_photo_gallery_media_photo_gallery_id_foreign` (`photo_gallery_id`),
  KEY `dbyp_photo_gallery_media_media_id_foreign` (`media_id`),
  CONSTRAINT `dbyp_photo_gallery_media_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `dbyp_curator` (`id`) ON DELETE CASCADE,
  CONSTRAINT `dbyp_photo_gallery_media_photo_gallery_id_foreign` FOREIGN KEY (`photo_gallery_id`) REFERENCES `dbyp_photo_galleries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dbyp.dbyp_photo_gallery_media: ~4 rows (approximately)
INSERT INTO `dbyp_photo_gallery_media` (`id`, `photo_gallery_id`, `media_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '2026-09-03 04:30:44', '2026-09-03 04:30:44'),
	(2, 1, 2, '2026-09-03 04:30:44', '2026-09-03 04:30:44'),
	(3, 1, 3, '2026-09-03 04:30:44', '2026-09-03 04:30:44'),
	(4, 1, 4, '2026-09-03 04:30:44', '2026-09-03 04:30:44');

-- Dumping structure for table dbyp.dbyp_popups
CREATE TABLE IF NOT EXISTS `dbyp_popups` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `order_by` int DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dbyp.dbyp_popups: ~0 rows (approximately)

-- Dumping structure for table dbyp.dbyp_posts
CREATE TABLE IF NOT EXISTS `dbyp_posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `feature_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` json DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `order_by` int DEFAULT NULL,
  `publish_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dbyp_posts_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dbyp.dbyp_posts: ~8 rows (approximately)
INSERT INTO `dbyp_posts` (`id`, `title`, `slug`, `excerpt`, `feature_image`, `category_id`, `author`, `content`, `status`, `order_by`, `publish_date`, `created_at`, `updated_at`) VALUES
	(1, 'Scenic Green Campus', 'scenic-green-campus', '<p>A quiet, beautiful setting with well-designed institutional buildings and gardens, offering the ideal context for reflection.</p>', 'file-manager/post/feature_image/facility-campus.jpg', NULL, NULL, '[]', 1, NULL, '2026-09-03', '2026-09-03 04:14:53', '2026-09-03 04:14:53'),
	(2, 'Counselling & Renewal', 'counselling-renewal', '<p>Comfortable, quiet counselling rooms dedicated to personal growth, healing, therapy sessions, and spiritual direction.</p>', 'file-manager/post/feature_image/facility-counsel.jpg', NULL, NULL, '[]', 1, NULL, '2026-09-01', '2026-09-03 04:15:19', '2026-09-03 04:15:19'),
	(3, 'Library & Study Areas', 'library-study-areas', '<p>A spacious library with specialized theological texts, quiet study tables, journals, and modern research resources.</p>', 'file-manager/post/feature_image/facility-library.jpg', NULL, NULL, '[]', 1, NULL, '2026-09-02', '2026-09-03 04:15:43', '2026-09-03 04:15:43'),
	(4, 'Recreation & Courtyards', 'recreation-courtyards', '<p>Excellent indoor and outdoor recreational facilities, green courtyards, and paths supporting a balanced community life.</p>', 'file-manager/post/feature_image/facility-recreation.jpg', NULL, NULL, '[]', 1, NULL, '2026-09-04', '2026-09-03 04:16:11', '2026-09-03 04:16:11'),
	(5, '"Through this course more clarity has come in me."', 'through-this-course-more-clarity-has-come-in-me', '<p>— A participant of Personal Growth Renewal, Feb 2023</p>', NULL, NULL, NULL, '[]', 1, NULL, '2026-09-03', '2026-09-03 04:24:05', '2026-09-03 04:24:05'),
	(6, '"The course can be extended for a whole month."', 'the-course-can-be-extended-for-a-whole-month', '<p>— A participant of Personal Growth  Renewal, Feb 2023</p>', NULL, NULL, NULL, '[]', 1, NULL, '2026-09-03', '2026-09-03 04:24:59', '2026-09-03 04:24:59'),
	(7, '"The one thing I remember most vividly about my experience here is: Each one is unique; we have to respect one another. I can make a difference in my own way."', 'the-one-thing-i-remember-most-vividly-about-my-experience-here-is-each-one-is-unique-we-have-to-respect-one-another-i-can-make-a-difference-in-my-own-way', '<p>— A participant of Personal Growth &amp; Renewal, Feb 2023</p>', NULL, NULL, NULL, '[]', 1, NULL, '2026-09-03', '2026-09-03 04:25:33', '2026-09-03 04:25:33'),
	(8, '"I am healed from my hurts and I am empowered and energized to go ahead in my life."', 'i-am-healed-from-my-hurts-and-i-am-empowered-and-energized-to-go-ahead-in-my-life', '<p>__The one thing I remember most vividly about my experience here</p>', NULL, NULL, NULL, '[]', 1, NULL, '2026-09-03', '2026-09-03 04:26:14', '2026-09-03 04:26:14');

-- Dumping structure for table dbyp.dbyp_post_category
CREATE TABLE IF NOT EXISTS `dbyp_post_category` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `post_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dbyp_post_category_category_id_foreign` (`category_id`),
  KEY `dbyp_post_category_post_id_foreign` (`post_id`),
  CONSTRAINT `dbyp_post_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `dbyp_categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `dbyp_post_category_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `dbyp_posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dbyp.dbyp_post_category: ~8 rows (approximately)
INSERT INTO `dbyp_post_category` (`id`, `category_id`, `post_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, NULL, NULL),
	(2, 1, 2, NULL, NULL),
	(3, 1, 3, NULL, NULL),
	(4, 1, 4, NULL, NULL),
	(5, 2, 5, NULL, NULL),
	(6, 2, 6, NULL, NULL),
	(7, 2, 7, NULL, NULL),
	(8, 2, 8, NULL, NULL);

-- Dumping structure for table dbyp.dbyp_registration_submissions
CREATE TABLE IF NOT EXISTS `dbyp_registration_submissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_title_dates` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `diocese_congregation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `religious_theological_non_academic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `religious_theological_academic` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `secular` text COLLATE utf8mb4_unicode_ci,
  `present_ministry` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `interests` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dbyp.dbyp_registration_submissions: ~2 rows (approximately)
INSERT INTO `dbyp_registration_submissions` (`id`, `course_title_dates`, `name`, `email`, `contact_address`, `phone`, `country`, `date_of_birth`, `diocese_congregation`, `religious_theological_non_academic`, `religious_theological_academic`, `secular`, `present_ministry`, `interests`, `created_at`, `updated_at`) VALUES
	(1, 'Animation of Lay Mission Partners', 'Plato Sosa', 'qowutequka@mailinator.com', 'Voluptatem voluptat', '+1 657 796-9396', 'Ea omnis praesentium', '1979-05-07', 'Reprehenderit harum', 'Consequuntur neque a', 'Enim beatae eos qua', 'Architecto possimus', 'Fugit in pariatur', 'In vel eligendi aliq', '2026-09-04 00:32:15', '2026-09-04 00:32:15'),
	(2, 'Preparation for Final Vows', 'Dolan Cardenas', 'cihoredu@mailinator.com', 'Labore labore cum sa', '+1 354 486-5415', 'Iure incidunt culpa', '2024-02-09', 'In in provident sae', 'Sapiente beatae labo', 'Sint provident ius', 'Culpa odit Nam autem', 'Expedita laboriosam', 'Placeat itaque eaqu', '2026-09-04 00:36:52', '2026-09-04 00:36:52');

-- Dumping structure for table dbyp.dbyp_roles
CREATE TABLE IF NOT EXISTS `dbyp_roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dbyp_roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dbyp.dbyp_roles: ~0 rows (approximately)
INSERT INTO `dbyp_roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'super_admin', 'web', '2026-09-01 23:01:13', '2026-09-01 23:01:13'),
	(2, 'panel_user', 'web', '2026-09-03 03:50:20', '2026-09-03 03:50:20');

-- Dumping structure for table dbyp.dbyp_role_has_permissions
CREATE TABLE IF NOT EXISTS `dbyp_role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `dbyp_role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `dbyp_role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `dbyp_permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `dbyp_role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `dbyp_roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dbyp.dbyp_role_has_permissions: ~120 rows (approximately)
INSERT INTO `dbyp_role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(15, 1),
	(16, 1),
	(17, 1),
	(18, 1),
	(19, 1),
	(20, 1),
	(21, 1),
	(22, 1),
	(23, 1),
	(24, 1),
	(25, 1),
	(26, 1),
	(27, 1),
	(28, 1),
	(29, 1),
	(30, 1),
	(31, 1),
	(32, 1),
	(33, 1),
	(34, 1),
	(35, 1),
	(36, 1),
	(49, 1),
	(50, 1),
	(51, 1),
	(52, 1),
	(53, 1),
	(54, 1),
	(55, 1),
	(56, 1),
	(57, 1),
	(58, 1),
	(59, 1),
	(60, 1),
	(61, 1),
	(62, 1),
	(63, 1),
	(64, 1),
	(65, 1),
	(66, 1),
	(67, 1),
	(68, 1),
	(69, 1),
	(70, 1),
	(71, 1),
	(72, 1),
	(85, 1),
	(86, 1),
	(87, 1),
	(88, 1),
	(89, 1),
	(90, 1),
	(91, 1),
	(92, 1),
	(93, 1),
	(94, 1),
	(95, 1),
	(96, 1),
	(97, 1),
	(98, 1),
	(99, 1),
	(100, 1),
	(101, 1),
	(102, 1),
	(103, 1),
	(104, 1),
	(105, 1),
	(106, 1),
	(107, 1),
	(108, 1),
	(121, 1),
	(122, 1),
	(123, 1),
	(124, 1),
	(125, 1),
	(126, 1),
	(127, 1),
	(128, 1),
	(129, 1),
	(130, 1),
	(131, 1),
	(132, 1),
	(133, 1),
	(134, 1),
	(135, 1),
	(136, 1),
	(137, 1),
	(138, 1),
	(139, 1),
	(140, 1),
	(141, 1),
	(142, 1),
	(143, 1),
	(144, 1),
	(157, 1),
	(158, 1),
	(159, 1),
	(160, 1),
	(161, 1),
	(162, 1),
	(163, 1),
	(164, 1),
	(165, 1),
	(166, 1),
	(167, 1),
	(168, 1);

-- Dumping structure for table dbyp.dbyp_sliders
CREATE TABLE IF NOT EXISTS `dbyp_sliders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `link_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` json NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `order_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dbyp_sliders_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dbyp.dbyp_sliders: ~0 rows (approximately)
INSERT INTO `dbyp_sliders` (`id`, `title`, `subtitle`, `description`, `link_title`, `link`, `slug`, `image`, `status`, `order_by`, `created_at`, `updated_at`) VALUES
	(1, 'Home Page Slider', NULL, NULL, NULL, NULL, 'home-page-slider', '["file-manager/sliders/slider-2.jpg", "file-manager/sliders/slider-1.jpg", "file-manager/sliders/slider-3.jpg"]', 1, NULL, '2026-09-03 03:53:02', '2026-09-03 03:53:02');

-- Dumping structure for table dbyp.dbyp_upcoming_events
CREATE TABLE IF NOT EXISTS `dbyp_upcoming_events` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `feature_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` json DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `order_by` int DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dbyp_upcoming_events_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dbyp.dbyp_upcoming_events: ~0 rows (approximately)

-- Dumping structure for table dbyp.dbyp_users
CREATE TABLE IF NOT EXISTS `dbyp_users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dbyp_users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dbyp.dbyp_users: ~2 rows (approximately)
INSERT INTO `dbyp_users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Super Admin', 'superadmin@admin.com', '2026-09-01 23:00:51', '$2y$12$LMkHFNstt0L1cNtiXsBMQ.eorm6OAUhmHH0aKn1jPNVxz4joZYacy', 'DofjKConyL', '2026-09-01 23:00:51', '2026-09-01 23:00:51'),
	(2, 'Admin', 'admin@admin.com', '2026-09-01 23:00:51', '$2y$12$h4gnz2U1iocPw8CpNUT8ieP09TcVjktvy02qqGX2a7181hJCyCb/e', 'gUjzRdz2fK', '2026-09-01 23:00:51', '2026-09-01 23:00:51');

-- Dumping structure for table dbyp.dbyp_video_gallery
CREATE TABLE IF NOT EXISTS `dbyp_video_gallery` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dbyp.dbyp_video_gallery: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
