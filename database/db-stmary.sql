-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Oct 09, 2026 at 05:16 AM
-- Server version: 11.8.6-MariaDB-ubu2404-log
-- PHP Version: 8.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_form`
--

CREATE TABLE `contact_form` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `curator`
--

CREATE TABLE `curator` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `disk` varchar(255) NOT NULL DEFAULT 'public',
  `directory` varchar(255) NOT NULL DEFAULT 'media',
  `visibility` varchar(255) NOT NULL DEFAULT 'public',
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `width` int(10) UNSIGNED DEFAULT NULL,
  `height` int(10) UNSIGNED DEFAULT NULL,
  `size` int(10) UNSIGNED DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'image',
  `ext` varchar(255) NOT NULL,
  `alt` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `caption` text DEFAULT NULL,
  `exif` text DEFAULT NULL,
  `curations` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flash_news`
--

CREATE TABLE `flash_news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `open_in_new_tab` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `publish_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menuses`
--

CREATE TABLE `menuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `order_by` int(11) DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_url` tinyint(1) NOT NULL DEFAULT 0,
  `url` longtext DEFAULT NULL,
  `target` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(25, '2026_09_03_093656_add_feature_image_new_to_pages_table', 1),
(26, '2026_09_03_120000_fill_missing_menu_order_by_values', 1),
(27, '2026_09_04_120000_create_registration_submissions_table', 1),
(28, '2026_09_04_121000_drop_mobile_from_registration_submissions_table', 1),
(29, '2026_10_07_091437_create_permission_tables', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `excerpt` text DEFAULT NULL,
  `feature_image` varchar(255) DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`content`)),
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `order_by` int(11) DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` text DEFAULT NULL,
  `feature_image` varchar(255) DEFAULT NULL,
  `feature_image_new` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`content`)),
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `order_by` int(11) DEFAULT NULL,
  `publish_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'ViewAny:Role', 'web', '2026-10-07 03:44:49', '2026-10-07 03:44:49'),
(2, 'View:Role', 'web', '2026-10-07 03:44:49', '2026-10-07 03:44:49'),
(3, 'Create:Role', 'web', '2026-10-07 03:44:49', '2026-10-07 03:44:49'),
(4, 'Update:Role', 'web', '2026-10-07 03:44:49', '2026-10-07 03:44:49'),
(5, 'Delete:Role', 'web', '2026-10-07 03:44:49', '2026-10-07 03:44:49'),
(6, 'DeleteAny:Role', 'web', '2026-10-07 03:44:49', '2026-10-07 03:44:49'),
(7, 'Restore:Role', 'web', '2026-10-07 03:44:49', '2026-10-07 03:44:49'),
(8, 'ForceDelete:Role', 'web', '2026-10-07 03:44:49', '2026-10-07 03:44:49'),
(9, 'ForceDeleteAny:Role', 'web', '2026-10-07 03:44:49', '2026-10-07 03:44:49'),
(10, 'RestoreAny:Role', 'web', '2026-10-07 03:44:49', '2026-10-07 03:44:49'),
(11, 'Replicate:Role', 'web', '2026-10-07 03:44:49', '2026-10-07 03:44:49'),
(12, 'Reorder:Role', 'web', '2026-10-07 03:44:49', '2026-10-07 03:44:49'),
(13, 'ViewAny:Category', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(14, 'View:Category', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(15, 'Create:Category', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(16, 'Update:Category', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(17, 'Delete:Category', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(18, 'DeleteAny:Category', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(19, 'Restore:Category', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(20, 'ForceDelete:Category', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(21, 'ForceDeleteAny:Category', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(22, 'RestoreAny:Category', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(23, 'Replicate:Category', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(24, 'Reorder:Category', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(25, 'ViewAny:Contact', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(26, 'View:Contact', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(27, 'Create:Contact', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(28, 'Update:Contact', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(29, 'Delete:Contact', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(30, 'DeleteAny:Contact', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(31, 'Restore:Contact', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(32, 'ForceDelete:Contact', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(33, 'ForceDeleteAny:Contact', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(34, 'RestoreAny:Contact', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(35, 'Replicate:Contact', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(36, 'Reorder:Contact', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(37, 'ViewAny:FlashNews', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(38, 'View:FlashNews', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(39, 'Create:FlashNews', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(40, 'Update:FlashNews', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(41, 'Delete:FlashNews', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(42, 'DeleteAny:FlashNews', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(43, 'Restore:FlashNews', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(44, 'ForceDelete:FlashNews', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(45, 'ForceDeleteAny:FlashNews', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(46, 'RestoreAny:FlashNews', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(47, 'Replicate:FlashNews', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(48, 'Reorder:FlashNews', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(49, 'ViewAny:Media', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(50, 'View:Media', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(51, 'Create:Media', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(52, 'Update:Media', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(53, 'Delete:Media', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(54, 'DeleteAny:Media', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(55, 'Restore:Media', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(56, 'ForceDelete:Media', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(57, 'ForceDeleteAny:Media', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(58, 'RestoreAny:Media', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(59, 'Replicate:Media', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(60, 'Reorder:Media', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(61, 'ViewAny:Menus', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(62, 'View:Menus', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(63, 'Create:Menus', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(64, 'Update:Menus', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(65, 'Delete:Menus', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(66, 'DeleteAny:Menus', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(67, 'Restore:Menus', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(68, 'ForceDelete:Menus', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(69, 'ForceDeleteAny:Menus', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(70, 'RestoreAny:Menus', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(71, 'Replicate:Menus', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(72, 'Reorder:Menus', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(73, 'ViewAny:News', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(74, 'View:News', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(75, 'Create:News', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(76, 'Update:News', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(77, 'Delete:News', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(78, 'DeleteAny:News', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(79, 'Restore:News', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(80, 'ForceDelete:News', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(81, 'ForceDeleteAny:News', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(82, 'RestoreAny:News', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(83, 'Replicate:News', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(84, 'Reorder:News', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(85, 'ViewAny:Pages', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(86, 'View:Pages', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(87, 'Create:Pages', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(88, 'Update:Pages', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(89, 'Delete:Pages', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(90, 'DeleteAny:Pages', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(91, 'Restore:Pages', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(92, 'ForceDelete:Pages', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(93, 'ForceDeleteAny:Pages', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(94, 'RestoreAny:Pages', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(95, 'Replicate:Pages', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(96, 'Reorder:Pages', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(97, 'ViewAny:PhotoGallery', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(98, 'View:PhotoGallery', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(99, 'Create:PhotoGallery', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(100, 'Update:PhotoGallery', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(101, 'Delete:PhotoGallery', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(102, 'DeleteAny:PhotoGallery', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(103, 'Restore:PhotoGallery', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(104, 'ForceDelete:PhotoGallery', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(105, 'ForceDeleteAny:PhotoGallery', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(106, 'RestoreAny:PhotoGallery', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(107, 'Replicate:PhotoGallery', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(108, 'Reorder:PhotoGallery', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(109, 'ViewAny:Popup', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(110, 'View:Popup', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(111, 'Create:Popup', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(112, 'Update:Popup', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(113, 'Delete:Popup', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(114, 'DeleteAny:Popup', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(115, 'Restore:Popup', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(116, 'ForceDelete:Popup', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(117, 'ForceDeleteAny:Popup', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(118, 'RestoreAny:Popup', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(119, 'Replicate:Popup', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(120, 'Reorder:Popup', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(121, 'ViewAny:Posts', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(122, 'View:Posts', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(123, 'Create:Posts', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(124, 'Update:Posts', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(125, 'Delete:Posts', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(126, 'DeleteAny:Posts', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(127, 'Restore:Posts', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(128, 'ForceDelete:Posts', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(129, 'ForceDeleteAny:Posts', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(130, 'RestoreAny:Posts', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(131, 'Replicate:Posts', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(132, 'Reorder:Posts', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(133, 'ViewAny:Sliders', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(134, 'View:Sliders', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(135, 'Create:Sliders', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(136, 'Update:Sliders', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(137, 'Delete:Sliders', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(138, 'DeleteAny:Sliders', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(139, 'Restore:Sliders', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(140, 'ForceDelete:Sliders', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(141, 'ForceDeleteAny:Sliders', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(142, 'RestoreAny:Sliders', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(143, 'Replicate:Sliders', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(144, 'Reorder:Sliders', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(145, 'ViewAny:UpcomingEvents', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(146, 'View:UpcomingEvents', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(147, 'Create:UpcomingEvents', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(148, 'Update:UpcomingEvents', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(149, 'Delete:UpcomingEvents', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(150, 'DeleteAny:UpcomingEvents', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(151, 'Restore:UpcomingEvents', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(152, 'ForceDelete:UpcomingEvents', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(153, 'ForceDeleteAny:UpcomingEvents', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(154, 'RestoreAny:UpcomingEvents', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(155, 'Replicate:UpcomingEvents', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(156, 'Reorder:UpcomingEvents', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(157, 'ViewAny:User', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(158, 'View:User', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(159, 'Create:User', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(160, 'Update:User', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(161, 'Delete:User', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(162, 'DeleteAny:User', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(163, 'Restore:User', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(164, 'ForceDelete:User', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(165, 'ForceDeleteAny:User', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(166, 'RestoreAny:User', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(167, 'Replicate:User', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(168, 'Reorder:User', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(169, 'ViewAny:VideoGallery', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(170, 'View:VideoGallery', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(171, 'Create:VideoGallery', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(172, 'Update:VideoGallery', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(173, 'Delete:VideoGallery', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(174, 'DeleteAny:VideoGallery', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(175, 'Restore:VideoGallery', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(176, 'ForceDelete:VideoGallery', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(177, 'ForceDeleteAny:VideoGallery', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(178, 'RestoreAny:VideoGallery', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(179, 'Replicate:VideoGallery', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09'),
(180, 'Reorder:VideoGallery', 'web', '2026-10-07 03:45:09', '2026-10-07 03:45:09');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photo_galleries`
--

CREATE TABLE `photo_galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` tinytext NOT NULL,
  `images` longtext DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `order_by` int(11) DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photo_gallery_media`
--

CREATE TABLE `photo_gallery_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo_gallery_id` bigint(20) UNSIGNED NOT NULL,
  `media_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `popups`
--

CREATE TABLE `popups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `target` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `order_by` int(11) DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` text DEFAULT NULL,
  `feature_image` varchar(255) DEFAULT NULL,
  `category_id` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`content`)),
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `order_by` int(11) DEFAULT NULL,
  `publish_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_category`
--

CREATE TABLE `post_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registration_submissions`
--

CREATE TABLE `registration_submissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_title_dates` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_address` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `diocese_congregation` varchar(255) NOT NULL,
  `religious_theological_non_academic` varchar(255) NOT NULL,
  `religious_theological_academic` text NOT NULL,
  `secular` text DEFAULT NULL,
  `present_ministry` text NOT NULL,
  `interests` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', 'web', '2026-10-07 03:44:49', '2026-10-07 03:44:49'),
(2, 'panel_user', 'web', '2026-10-08 05:48:03', '2026-10-08 05:48:03');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
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
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
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
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
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
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
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
(145, 1),
(146, 1),
(147, 1),
(148, 1),
(149, 1),
(150, 1),
(151, 1),
(152, 1),
(153, 1),
(154, 1),
(155, 1),
(156, 1),
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
(168, 1),
(169, 1),
(170, 1),
(171, 1),
(172, 1),
(173, 1),
(174, 1),
(175, 1),
(176, 1),
(177, 1),
(178, 1),
(179, 1),
(180, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `link_title` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `image` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`image`)),
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `order_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `subtitle`, `description`, `link_title`, `link`, `slug`, `image`, `status`, `order_by`, `created_at`, `updated_at`) VALUES
(6, 'Slider first', NULL, NULL, NULL, NULL, 'slider-first', '[\"file-manager\\/sliders\\/slider3.jpg\",\"file-manager\\/sliders\\/slider4.jpg\",\"file-manager\\/sliders\\/slider5.jpg\",\"file-manager\\/sliders\\/management-bg.jpg\"]', 1, NULL, '2026-10-08 06:33:00', '2026-10-08 06:34:22');

-- --------------------------------------------------------

--
-- Table structure for table `upcoming_events`
--

CREATE TABLE `upcoming_events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `excerpt` text DEFAULT NULL,
  `feature_image` varchar(255) DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`content`)),
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `order_by` int(11) DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin@admin.com', '2026-10-07 03:32:19', '$2y$12$rODSSiZvUf0y2XfI9b7aBevPAmJp4yzgJJKhncYX.x3gaoWqZFr76', 'nHRMy7UEhT', '2026-10-07 03:32:19', '2026-10-07 03:32:19'),
(2, 'Admin', 'admin@admin.com', '2026-10-07 03:32:20', '$2y$12$pzEMJyAFYewKTjBF7Hs0KuaZWU2E3X4jgmF8qGtRpjdJBwSNxzkdu', 'FAgJUqbxa8', '2026-10-07 03:32:20', '2026-10-07 03:32:20');

-- --------------------------------------------------------

--
-- Table structure for table `video_gallery`
--

CREATE TABLE `video_gallery` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `link` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`link`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `contact_form`
--
ALTER TABLE `contact_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `curator`
--
ALTER TABLE `curator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `flash_news`
--
ALTER TABLE `flash_news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `flash_news_slug_unique` (`slug`);

--
-- Indexes for table `menuses`
--
ALTER TABLE `menuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menuses_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `news_slug_unique` (`slug`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `newsletters_email_unique` (`email`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `photo_galleries`
--
ALTER TABLE `photo_galleries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `photo_galleries_slug_unique` (`slug`);

--
-- Indexes for table `photo_gallery_media`
--
ALTER TABLE `photo_gallery_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photo_gallery_media_photo_gallery_id_foreign` (`photo_gallery_id`),
  ADD KEY `photo_gallery_media_media_id_foreign` (`media_id`);

--
-- Indexes for table `popups`
--
ALTER TABLE `popups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`);

--
-- Indexes for table `post_category`
--
ALTER TABLE `post_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_category_category_id_foreign` (`category_id`),
  ADD KEY `post_category_post_id_foreign` (`post_id`);

--
-- Indexes for table `registration_submissions`
--
ALTER TABLE `registration_submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sliders_slug_unique` (`slug`);

--
-- Indexes for table `upcoming_events`
--
ALTER TABLE `upcoming_events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `upcoming_events_slug_unique` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `video_gallery`
--
ALTER TABLE `video_gallery`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_form`
--
ALTER TABLE `contact_form`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `curator`
--
ALTER TABLE `curator`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flash_news`
--
ALTER TABLE `flash_news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menuses`
--
ALTER TABLE `menuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photo_galleries`
--
ALTER TABLE `photo_galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photo_gallery_media`
--
ALTER TABLE `photo_gallery_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `popups`
--
ALTER TABLE `popups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_category`
--
ALTER TABLE `post_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registration_submissions`
--
ALTER TABLE `registration_submissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `upcoming_events`
--
ALTER TABLE `upcoming_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `video_gallery`
--
ALTER TABLE `video_gallery`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menuses`
--
ALTER TABLE `menuses`
  ADD CONSTRAINT `menuses_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menuses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `photo_gallery_media`
--
ALTER TABLE `photo_gallery_media`
  ADD CONSTRAINT `photo_gallery_media_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `curator` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `photo_gallery_media_photo_gallery_id_foreign` FOREIGN KEY (`photo_gallery_id`) REFERENCES `photo_galleries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_category`
--
ALTER TABLE `post_category`
  ADD CONSTRAINT `post_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_category_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
