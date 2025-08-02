-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2025 at 03:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `odoo_hackathon`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
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
-- Table structure for table `flags`
--

CREATE TABLE `flags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `issue_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

CREATE TABLE `issues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Reported','In Progress','Resolved') NOT NULL DEFAULT 'Reported',
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `is_anonymous` tinyint(1) NOT NULL DEFAULT 0,
  `photos` longtext DEFAULT NULL,
  `address` text DEFAULT NULL,
  `is_hidden` tinyint(1) NOT NULL DEFAULT 0,
  `flag_count` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `issues`
--

INSERT INTO `issues` (`id`, `user_id`, `category`, `title`, `description`, `category_id`, `status`, `lat`, `lng`, `is_anonymous`, `photos`, `address`, `is_hidden`, `flag_count`, `created_at`, `updated_at`) VALUES
(17, 6, NULL, 'Hole on road', 'Damaged road', 1, 'Reported', 29.3246675, 76.29926499999999, 0, NULL, 'SH 12, Jind, Haryana, 126100, India', 0, 0, '2025-08-28 11:56:52', NULL),
(19, 6, NULL, 'Light Not Working', 'Light Not Working', 2, 'Reported', 29.33212827792384, 76.30410861929705, 0, NULL, 'SH 12, Jind, Haryana, 126100, India', 0, 0, '2025-08-02 06:57:11', NULL),
(20, 6, NULL, 'Damage Road', 'Potholes on the road', 1, 'Reported', 29.33219562265336, 76.30458068808367, 0, NULL, 'Jind, Haryana, 126100, India', 0, 0, '2025-08-02 07:01:06', NULL),
(21, 6, NULL, 'Breakage', 'Light not working and road is breaked', 2, 'Reported', 29.32620182785836, 76.29738056654789, 0, NULL, 'Setia Dental Clinic, post office, Jind, Haryana, 126102, India', 0, 0, '2025-08-02 07:31:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `issue_categories`
--

CREATE TABLE `issue_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `issue_categories`
--

INSERT INTO `issue_categories` (`id`, `name`, `slug`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Roads (Potholes, Obstructions)', 'roads-potholes-obstructions', NULL, '2025-08-01 22:45:56', '2025-08-01 22:45:56'),
(2, 'Lighting (Broken/Flickering Lights)', 'lighting-brokenflickering-lights', NULL, '2025-08-01 22:45:56', '2025-08-01 22:45:56'),
(3, 'Water Supply (Leaks, Low Pressure)', 'water-supply-leaks-low-pressure', NULL, '2025-08-01 22:45:56', '2025-08-01 22:45:56'),
(4, 'Cleanliness (Overflowing Bins, Garbage)', 'cleanliness-overflowing-bins-garbage', NULL, '2025-08-01 22:45:56', '2025-08-01 22:45:56'),
(5, 'Public Safety (Open Manholes, Exposed Wiring)', 'public-safety-open-manholes-exposed-wiring', NULL, '2025-08-01 22:45:56', '2025-08-01 22:45:56'),
(6, 'Obstructions (Fallen Trees, Debris)', 'obstructions-fallen-trees-debris', NULL, '2025-08-01 22:45:56', '2025-08-01 22:45:56');

-- --------------------------------------------------------

--
-- Table structure for table `issue_photos`
--

CREATE TABLE `issue_photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `issue_id` bigint(20) UNSIGNED NOT NULL,
  `photo_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `issue_photos`
--

INSERT INTO `issue_photos` (`id`, `issue_id`, `photo_path`, `created_at`, `updated_at`) VALUES
(2, 17, 'issues/photos/688dfbf57c3af.jpg', NULL, NULL),
(3, 19, 'issues/photos/688e041f00255.jpg', NULL, NULL),
(4, 20, 'issues/photos/688e050a52162.jpg', NULL, NULL),
(5, 21, 'issues/photos/688e0c0c8604f.jpg', NULL, NULL),
(6, 21, 'issues/photos/688e0c0c8aa45.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `issue_status_logs`
--

CREATE TABLE `issue_status_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `issue_id` bigint(20) UNSIGNED NOT NULL,
  `old_status` enum('Reported','In Progress','Resolved') DEFAULT NULL,
  `new_status` enum('Reported','In Progress','Resolved') NOT NULL,
  `changed_by_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_08_02_000001_create_users_table', 2),
(5, '2025_08_02_000002_create_issue_categories_table', 2),
(6, '2025_08_02_000003_create_issues_table', 2),
(7, '2025_08_02_000004_create_issue_photos_table', 2),
(8, '2025_08_02_000005_create_issue_status_logs_table', 2),
(9, '2025_08_02_000006_create_flags_table', 2),
(10, '2025_08_02_000007_create_settings_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('u3kgjg7WLop0LUdjGaet8Cubb0kpvdfQADBLAhga', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTXF3S0hsMlNKTnhERmJpUHFhZ2VEc1JMWlBUcU93bG5WbUlsVnAxSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3Qvb2Rvby9wdWJsaWMvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1754139741);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'max_visible_radius_km', '5', '2025-08-01 22:45:56', '2025-08-01 22:45:56'),
(2, 'auto_hide_flag_threshold', '3', '2025-08-01 22:45:56', '2025-08-01 22:45:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `is_banned` tinyint(1) NOT NULL DEFAULT 0,
  `location_lat` double DEFAULT NULL,
  `location_lng` double DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone`, `email_verified_at`, `password`, `is_banned`, `location_lat`, `location_lng`, `remember_token`, `created_at`, `updated_at`) VALUES
(6, 'keshavkhudania', 'keshavweb.dev@gmail.com', '7256347257', '2025-08-02 09:17:36', '$2y$12$U95zexqYDCurGCgmtR6MP./xZwIenVczQ9zYyNIfvDhVc.gG7J4em', 0, NULL, NULL, NULL, '2025-08-02 03:47:00', '2025-08-02 03:47:00'),
(7, 'ashmeet', 'ashmeetsingh@gmail.com', '9518844806', '2025-08-14 13:02:57', '$2y$12$8mdaFFjhsxhdOVHlU2wQY.Ei9NBDAqJ59c5wSPepBwMsIpZKYQV2m', 0, NULL, NULL, NULL, '2025-08-02 07:32:21', '2025-08-02 07:32:21');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `flags`
--
ALTER TABLE `flags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flags_issue_id_foreign` (`issue_id`),
  ADD KEY `flags_user_id_foreign` (`user_id`);

--
-- Indexes for table `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `issues_user_id_foreign` (`user_id`),
  ADD KEY `issues_category_id_foreign` (`category_id`);

--
-- Indexes for table `issue_categories`
--
ALTER TABLE `issue_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `issue_categories_slug_unique` (`slug`);

--
-- Indexes for table `issue_photos`
--
ALTER TABLE `issue_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `issue_photos_issue_id_foreign` (`issue_id`);

--
-- Indexes for table `issue_status_logs`
--
ALTER TABLE `issue_status_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `issue_status_logs_issue_id_foreign` (`issue_id`),
  ADD KEY `issue_status_logs_changed_by_user_id_foreign` (`changed_by_user_id`);

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flags`
--
ALTER TABLE `flags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issues`
--
ALTER TABLE `issues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `issue_categories`
--
ALTER TABLE `issue_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `issue_photos`
--
ALTER TABLE `issue_photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `issue_status_logs`
--
ALTER TABLE `issue_status_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `flags`
--
ALTER TABLE `flags`
  ADD CONSTRAINT `flags_issue_id_foreign` FOREIGN KEY (`issue_id`) REFERENCES `issues` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `flags_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `issues`
--
ALTER TABLE `issues`
  ADD CONSTRAINT `issues_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `issue_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `issues_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `issue_photos`
--
ALTER TABLE `issue_photos`
  ADD CONSTRAINT `issue_photos_issue_id_foreign` FOREIGN KEY (`issue_id`) REFERENCES `issues` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `issue_status_logs`
--
ALTER TABLE `issue_status_logs`
  ADD CONSTRAINT `issue_status_logs_changed_by_user_id_foreign` FOREIGN KEY (`changed_by_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `issue_status_logs_issue_id_foreign` FOREIGN KEY (`issue_id`) REFERENCES `issues` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
