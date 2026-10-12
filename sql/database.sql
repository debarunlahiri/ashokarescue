-- Ashoka Rescue Air Ambulance Services Database Schema
-- MySQL Database for Plain PHP Version

-- Create database
CREATE DATABASE IF NOT EXISTS ashoka_rescue CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ashoka_rescue;

-- =============================================
-- Table: users
-- Description: Admin users for authentication
-- =============================================
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default admin user (password: admin123)
INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@ashokarescue.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NOW(), NOW());

-- =============================================
-- Table: service_lists
-- Description: Service listings with images
-- =============================================
CREATE TABLE IF NOT EXISTS `service_lists` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `banner` text NOT NULL,
  `content` text NOT NULL,
  `img2` text DEFAULT NULL,
  `img3` text DEFAULT NULL,
  `img4` text DEFAULT NULL,
  `img5` text DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_lists_slug_unique` (`slug`),
  KEY `idx_is_active` (`is_active`),
  KEY `idx_priority` (`priority`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Sample service data
INSERT INTO `service_lists` (`id`, `title`, `slug`, `banner`, `content`, `img2`, `img3`, `img4`, `img5`, `priority`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Charter Air Ambulance', 'charter-air-ambulance', '/assets/images/services/charter-air.jpg', 'Professional air ambulance services with medical crew', NULL, NULL, NULL, NULL, 1, 1, NOW(), NOW()),
(2, 'Commercial Stretcher', 'commercial-stretcher', '/assets/images/services/commercial-stretcher.jpg', 'Medical stretcher services on commercial flights', NULL, NULL, NULL, NULL, 2, 1, NOW(), NOW()),
(3, 'Business Class Assistance', 'business-class-assistance', '/assets/images/services/business-class.jpg', 'Medical assistance in business class', NULL, NULL, NULL, NULL, 3, 1, NOW(), NOW()),
(4, 'Ambulance Service', 'ambulance-service', '/assets/images/services/ambulance.jpg', 'Ground ambulance services', NULL, NULL, NULL, NULL, 4, 1, NOW(), NOW()),
(5, 'Medical Tourism', 'medical-tourism', '/assets/images/services/medical-tourism.jpg', 'Medical tourism assistance', NULL, NULL, NULL, NULL, 5, 1, NOW(), NOW());

-- =============================================
-- Table: service_contents
-- Description: Dynamic content for service pages
-- =============================================
CREATE TABLE IF NOT EXISTS `service_contents` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `input_type` enum('input','image','textarea','editor') NOT NULL,
  `page_keyname_admin` varchar(255) NOT NULL,
  `page_key` varchar(255) NOT NULL,
  `page_value` text NOT NULL,
  `key_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_service_id` (`service_id`),
  KEY `idx_key_order` (`key_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- Table: testimonials
-- Description: Customer testimonials
-- =============================================
CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `rating` tinyint(4) NOT NULL DEFAULT 5,
  `author` varchar(255) NOT NULL,
  `designtion` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_is_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Sample testimonials
INSERT INTO `testimonials` (`id`, `content`, `rating`, `author`, `designtion`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Excellent service! The medical team was very professional and caring during our emergency transport.', 5, 'Rajesh Kumar', 'Patient Family', 1, NOW(), NOW()),
(2, 'Highly recommend Ashoka Rescue for air ambulance services. They handled everything smoothly.', 5, 'Priya Sharma', 'Patient', 1, NOW(), NOW()),
(3, 'Professional and timely service. The staff was very supportive throughout the journey.', 5, 'Dr. Amit Patel', 'Medical Professional', 1, NOW(), NOW());

-- =============================================
-- Table: our_stories
-- Description: Company stories and achievements
-- =============================================
CREATE TABLE IF NOT EXISTS `our_stories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `img1` text NOT NULL,
  `img2` text NOT NULL,
  `img3` text NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_is_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Sample story
INSERT INTO `our_stories` (`id`, `title`, `content`, `img1`, `img2`, `img3`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Our Commitment to Excellence', '<p>At Ashoka Rescue, we specialize in providing comprehensive assistance to patients both commercially and through charter services, ensuring their comfort, safety, and well-being throughout the entire journey.</p>', '/assets/images/story1.jpg', '/assets/images/story2.jpg', '/assets/images/story3.jpg', 1, NOW(), NOW());

-- =============================================
-- Table: home_quotes
-- Description: Quote requests from home page
-- =============================================
CREATE TABLE IF NOT EXISTS `home_quotes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `departing_from` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `services` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- Table: home_footer_quotes
-- Description: Quote requests from footer
-- =============================================
CREATE TABLE IF NOT EXISTS `home_footer_quotes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `home_contact` varchar(15) DEFAULT NULL,
  `services` varchar(100) NOT NULL,
  `details` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- Table: contact_quotes
-- Description: Contact form submissions
-- =============================================
CREATE TABLE IF NOT EXISTS `contact_quotes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `services` varchar(100) NOT NULL,
  `details` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- Create indexes for better performance
-- =============================================
ALTER TABLE `service_lists` ADD INDEX `idx_active_priority` (`is_active`, `priority`);
ALTER TABLE `testimonials` ADD INDEX `idx_active_rating` (`is_active`, `rating`);
ALTER TABLE `our_stories` ADD INDEX `idx_active_created` (`is_active`, `created_at`);

-- =============================================
-- End of database schema
-- =============================================
