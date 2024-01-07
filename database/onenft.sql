-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 03, 2022 at 06:40 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onenft`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_banks`
--

DROP TABLE IF EXISTS `admin_banks`;
CREATE TABLE IF NOT EXISTS `admin_banks` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tab_selection` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tab_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `swift_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ifsc_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `routing` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `minimum_deposit` int(11) NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `affiliates`
--

DROP TABLE IF EXISTS `affiliates`;
CREATE TABLE IF NOT EXISTS `affiliates` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `affiliat_id` bigint(20) UNSIGNED NOT NULL COMMENT 'user id as affiliat_id, if user refer other user',
  `reference_id` bigint(20) UNSIGNED NOT NULL COMMENT 'user id as reference_id, if user references by other user',
  `token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'token from asset',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `affiliates_affiliat_id_index` (`affiliat_id`),
  KEY `affiliates_reference_id_index` (`reference_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_ratings`
--

DROP TABLE IF EXISTS `asset_ratings`;
CREATE TABLE IF NOT EXISTS `asset_ratings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `asset_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rate` int(11) NOT NULL DEFAULT '0',
  `rating_by` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'FK:users(id)',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_views`
--

DROP TABLE IF EXISTS `asset_views`;
CREATE TABLE IF NOT EXISTS `asset_views` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `viewed_by` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'FK:users(id)',
  `asset_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'FK:assets(id)',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `asset_views_viewed_by_index` (`viewed_by`),
  KEY `asset_views_asset_id_index` (`asset_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

DROP TABLE IF EXISTS `bank_accounts`;
CREATE TABLE IF NOT EXISTS `bank_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_ac_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_ac_number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_swift_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_iban` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_country` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` blob,
  `approve_status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'p' COMMENT 'p->panding, a->approved, d->declined',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0->deactive, 1->active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bank_accounts_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

DROP TABLE IF EXISTS `bids`;
CREATE TABLE IF NOT EXISTS `bids` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `asset_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bidder_id` bigint(20) UNSIGNED DEFAULT NULL,
  `offer_price` double NOT NULL DEFAULT '0',
  `status` tinyint(4) DEFAULT NULL COMMENT '0 for deactive, 1 for active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bids_asset_id_index` (`asset_id`),
  KEY `bids_bidder_id_index` (`bidder_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id`, `asset_id`, `bidder_id`, `offer_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 100, 1, '2022-10-01 12:23:54', '2022-10-01 12:23:54'),
(2, 3, 2, 50, 1, '2022-10-01 12:23:54', '2022-10-01 12:23:54');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Comment type like user, copy',
  `comment` blob,
  `commented_by` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'whose commented like as admin',
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'approved' COMMENT 'Aproved status',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_id_index` (`user_id`),
  KEY `comments_commented_by_index` (`commented_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_infos`
--

DROP TABLE IF EXISTS `company_infos`;
CREATE TABLE IF NOT EXISTS `company_infos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `com_name` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `com_license` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `com_email` json DEFAULT NULL,
  `com_phone` json DEFAULT NULL,
  `com_website` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `com_authority` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `com_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyright` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `support_email` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auto_email` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `com_social_info` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_infos`
--

INSERT INTO `company_infos` (`id`, `com_name`, `com_license`, `com_email`, `com_phone`, `com_website`, `com_authority`, `com_address`, `copyright`, `support_email`, `auto_email`, `com_social_info`, `created_at`, `updated_at`) VALUES
(1, 'OneNFT', NULL, NULL, NULL, NULL, NULL, NULL, 'itcorner 2022', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

DROP TABLE IF EXISTS `contact_us`;
CREATE TABLE IF NOT EXISTS `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `iso` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `iso`, `name`, `country_code`, `created_at`, `updated_at`) VALUES
(1, 'AD', 'Andorra', 376, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(2, 'AE', 'United Arab Emirates', 971, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(3, 'AF', 'Afghanistan', 93, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(4, 'AG', 'Antigua and Barbuda', 268, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(5, 'AL', 'Albania', 355, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(6, 'AO', 'Angola', 244, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(7, 'AQ', 'Antarctica', 672, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(8, 'AR', 'Argentina', 54, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(9, 'AT', 'Austria', 43, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(10, 'AU', 'Australia', 61, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(11, 'AZ', 'Azerbaijan', 994, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(12, 'BA', 'Bosnia and Herzegovina', 387, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(13, 'BB', 'Barbados', 246, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(14, 'BD', 'Bangladesh', 880, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(15, 'BE', 'Belgium', 32, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(16, 'BF', 'Burkina Faso', 226, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(17, 'BG', 'Bulgaria', 359, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(18, 'BH', 'Bahrain', 973, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(19, 'BJ', 'Benin', 229, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(20, 'BN', 'Brunei Darussalam', 673, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(21, 'BO', 'Bolivia', 591, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(22, 'BR', 'Brazil', 55, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(23, 'BS', 'Bahamas', 242, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(24, 'BT', 'Bhutan', 975, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(25, 'BW', 'Botswana', 267, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(26, 'BY', 'Belarus', 375, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(27, 'BZ', 'Belize', 501, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(28, 'CA', 'Canada', 1, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(29, 'CF', 'Central African Republic', 236, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(30, 'CG', 'Congo', 242, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(31, 'CH', 'Switzerland', 41, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(32, 'CI', 'Cote D\'Ivoire', 384, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(33, 'CL', 'Chile', 56, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(34, 'CM', 'Cameroon', 237, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(35, 'CN', 'China', 86, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(36, 'CO', 'Colombia', 57, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(37, 'CR', 'Costa Rica', 506, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(38, 'CU', 'Cuba', 53, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(39, 'CV', 'Cape Verde', 132, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(40, 'CY', 'Cyprus', 357, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(41, 'CZ', 'Czech Republic', 420, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(42, 'DE', 'Germany', 49, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(43, 'DJ', 'Djibouti', 253, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(44, 'DK', 'Denmark', 45, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(45, 'DM', 'Dominica', 767, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(46, 'DO', 'Dominican Republic', 839, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(47, 'DZ', 'Algeria', 213, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(48, 'EC', 'Ecuador', 593, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(49, 'EE', 'Estonia', 372, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(50, 'EG', 'Egypt', 20, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(51, 'ER', 'Eritrea', 291, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(52, 'ES', 'Spain', 34, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(53, 'ET', 'Ethiopia', 231, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(54, 'FI', 'Finland', 358, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(55, 'FJ', 'Fiji', 242, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(56, 'FK', 'Falkland Islands (Malvinas)', 500, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(57, 'FM', 'Micronesia, Federated States of', 691, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(58, 'FR', 'France', 33, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(59, 'GA', 'Gabon', 241, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(60, 'GD', 'Grenada', 473, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(61, 'GE', 'Georgia', 995, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(62, 'GH', 'Ghana', 233, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(63, 'GL', 'Greenland', 299, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(64, 'GM', 'Gambia', 220, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(65, 'GN', 'Guinea', 324, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(66, 'GQ', 'Equatorial Guinea', 240, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(67, 'GR', 'Greece', 30, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(68, 'GT', 'Guatemala', 502, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(69, 'GU', 'Guam', 670, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(70, 'GW', 'Guinea-Bissau', 245, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(71, 'GY', 'Guyana', 592, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(72, 'HK', 'Hong Kong', 852, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(73, 'HN', 'Honduras', 504, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(74, 'HR', 'Croatia', 385, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(75, 'HT', 'Haiti', 509, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(76, 'HU', 'Hungary', 36, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(77, 'ID', 'Indonesia', 62, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(78, 'IE', 'Ireland', 353, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(79, 'IL', 'Israel', 972, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(80, 'IN', 'India', 91, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(81, 'IQ', 'Iraq', 964, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(82, 'IR', 'Iran, Islamic Republic of', 98, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(83, 'IS', 'Iceland', 354, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(84, 'IT', 'Italy', 39, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(85, 'JM', 'Jamaica', 876, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(86, 'JO', 'Jordan', 962, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(87, 'JP', 'Japan', 81, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(88, 'KE', 'Kenya', 254, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(89, 'KG', 'Kyrgyzstan', 417, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(90, 'KH', 'Cambodia', 855, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(91, 'KI', 'Kiribati', 686, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(92, 'KM', 'Comoros', 269, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(93, 'KP', 'Korea, Democratic People\'s Republic of', 850, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(94, 'KR', 'Korea, Republic of', 82, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(95, 'KW', 'Kuwait', 965, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(96, 'KZ', 'Kazakhstan', 7, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(97, 'LA', 'Lao People\'s Democratic Republic', 418, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(98, 'LB', 'Lebanon', 961, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(99, 'LC', 'Saint Lucia', 662, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(100, 'LI', 'Liechtenstein', 41, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(101, 'LK', 'Sri Lanka', 94, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(102, 'LR', 'Liberia', 231, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(103, 'LS', 'Lesotho', 266, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(104, 'LT', 'Lithuania', 370, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(105, 'LU', 'Luxembourg', 352, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(106, 'LV', 'Latvia', 371, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(107, 'LY', 'Libyan Arab Jamahiriya', 218, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(108, 'MA', 'Morocco', 212, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(109, 'MD', 'Moldova, Republic of', 373, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(110, 'MG', 'Madagascar', 261, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(111, 'MH', 'Marshall Islands', 692, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(112, 'MK', 'Macedonia, the Former Yugoslav Republic of', 807, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(113, 'ML', 'Mali', 466, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(114, 'MN', 'Mongolia', 976, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(115, 'MR', 'Mauritania', 222, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(116, 'MT', 'Malta', 356, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(117, 'MU', 'Mauritius', 230, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(118, 'MV', 'Maldives', 960, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(119, 'MW', 'Malawi', 265, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(120, 'MX', 'Mexico', 52, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(121, 'MY', 'Malaysia', 60, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(122, 'MZ', 'Mozambique', 258, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(123, 'NA', 'Namibia', 264, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(124, 'NE', 'Niger', 227, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(125, 'NG', 'Nigeria', 234, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(126, 'NI', 'Nicaragua', 505, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(127, 'NL', 'Netherlands', 31, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(128, 'NO', 'Norway', 47, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(129, 'NP', 'Nepal', 977, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(130, 'NR', 'Nauru', 674, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(131, 'NZ', 'New Zealand', 64, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(132, 'OM', 'Oman', 968, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(133, 'PA', 'Panama', 507, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(134, 'PE', 'Peru', 51, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(135, 'PG', 'Papua New Guinea', 675, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(136, 'PH', 'Philippines', 63, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(137, 'PK', 'Pakistan', 92, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(138, 'PL', 'Poland', 48, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(139, 'PS', 'Palestinian Territory, Occupied', NULL, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(140, 'PT', 'Portugal', 351, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(141, 'PY', 'Paraguay', 595, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(142, 'QA', 'Qatar', 974, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(143, 'RO', 'Romania', 40, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(144, 'RU', 'Russian Federation', 7, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(145, 'RW', 'Rwanda', 250, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(146, 'SA', 'Saudi Arabia', 966, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(147, 'SB', 'Solomon Islands', 677, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(148, 'SC', 'Seychelles', 690, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(149, 'SD', 'Sudan', 249, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(150, 'SE', 'Sweden', 46, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(151, 'SG', 'Singapore', 65, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(152, 'SI', 'Slovenia', 386, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(153, 'SK', 'Slovakia', 703, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(154, 'SL', 'Sierra Leone', 232, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(155, 'SN', 'Senegal', 221, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(156, 'SO', 'Somalia', 252, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(157, 'SR', 'Suriname', 597, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(158, 'ST', 'Sao Tome and Principe', 678, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(159, 'SV', 'El Salvador', 503, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(160, 'SY', 'Syrian Arab Republic', 963, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(161, 'SZ', 'Swaziland', 268, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(162, 'TD', 'Chad', 235, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(163, 'TG', 'Togo', 228, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(164, 'TH', 'Thailand', 66, '2022-09-27 07:03:27', '2022-09-27 07:03:27'),
(165, 'TJ', 'Tajikistan', 7, '2022-09-27 07:03:28', '2022-09-27 07:03:28'),
(166, 'TM', 'Turkmenistan', 993, '2022-09-27 07:03:28', '2022-09-27 07:03:28'),
(167, 'TN', 'Tunisia', 216, '2022-09-27 07:03:28', '2022-09-27 07:03:28'),
(168, 'TO', 'Tonga', 776, '2022-09-27 07:03:28', '2022-09-27 07:03:28'),
(169, 'TR', 'Turkey', 90, '2022-09-27 07:03:28', '2022-09-27 07:03:28'),
(170, 'TT', 'Trinidad and Tobago', 780, '2022-09-27 07:03:28', '2022-09-27 07:03:28'),
(171, 'TV', 'Tuvalu', 688, '2022-09-27 07:03:28', '2022-09-27 07:03:28'),
(172, 'TW', 'Taiwan, Province of China', 886, '2022-09-27 07:03:28', '2022-09-27 07:03:28'),
(173, 'TZ', 'Tanzania, United Republic of', 255, '2022-09-27 07:03:28', '2022-09-27 07:03:28'),
(174, 'UA', 'Ukraine', 380, '2022-09-27 07:03:28', '2022-09-27 07:03:28'),
(175, 'UG', 'Uganda', 256, '2022-09-27 07:03:28', '2022-09-27 07:03:28'),
(176, 'UK', 'United Kingdom', 44, '2022-09-27 07:03:28', '2022-09-27 07:03:28'),
(177, 'US', 'United States', 1, '2022-09-27 07:03:28', '2022-09-27 07:03:28'),
(178, 'UY', 'Uruguay', 598, '2022-09-27 07:03:28', '2022-09-27 07:03:28'),
(179, 'UZ', 'Uzbekistan', 998, '2022-09-27 07:03:28', '2022-09-27 07:03:28'),
(180, 'VA', 'Holy See (Vatican City State)', 376, '2022-09-27 07:03:28', '2022-09-27 07:03:28'),
(181, 'VC', 'Saint Vincent and the Grenadines', 670, '2022-09-27 07:03:28', '2022-09-27 07:03:28'),
(182, 'VE', 'Venezuela', 58, '2022-09-27 07:03:28', '2022-09-27 07:03:28'),
(183, 'VN', 'Viet Nam', 84, '2022-09-27 07:03:28', '2022-09-27 07:03:28'),
(184, 'VU', 'Vanuatu', 678, '2022-09-27 07:03:28', '2022-09-27 07:03:28'),
(185, 'WS', 'Samoa', 685, '2022-09-27 07:03:28', '2022-09-27 07:03:28'),
(186, 'YE', 'Yemen', 967, '2022-09-27 07:03:28', '2022-09-27 07:03:28'),
(187, 'ZA', 'South Africa', 27, '2022-09-27 07:03:28', '2022-09-27 07:03:28'),
(188, 'ZM', 'Zambia', 260, '2022-09-27 07:03:28', '2022-09-27 07:03:28'),
(189, 'ZW', 'Zimbabwe', 263, '2022-09-27 07:03:28', '2022-09-27 07:03:28');

-- --------------------------------------------------------

--
-- Table structure for table `crypto_addresses`
--

DROP TABLE IF EXISTS `crypto_addresses`;
CREATE TABLE IF NOT EXISTS `crypto_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `block_chain` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'created by email',
  `created_ip` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'created IP',
  `browser` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verify_1` tinyint(4) NOT NULL DEFAULT '0',
  `verify_2` tinyint(4) NOT NULL DEFAULT '0',
  `verify_1_at` timestamp NULL DEFAULT NULL,
  `verify_2_at` timestamp NULL DEFAULT NULL,
  `c_count` int(11) NOT NULL DEFAULT '0',
  `c_update` int(11) NOT NULL DEFAULT '0',
  `verify_1_ip` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verify_2_ip` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `crypto_addresses_admin_id_index` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

DROP TABLE IF EXISTS `deposits`;
CREATE TABLE IF NOT EXISTS `deposits` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_type` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `incode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `block_chain` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crypto_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crypto_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double NOT NULL,
  `crypto_amount` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `charge` double NOT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `order_id` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'order_id from api',
  `bank_proof` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'like as document',
  `bank_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'admin bank id',
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'user ip address',
  `approved_status` enum('A','P','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'P' COMMENT 'A for approved, P for pending, D for Decline',
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `deposits_approved_by_index` (`approved_by`),
  KEY `deposits_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
CREATE TABLE IF NOT EXISTS `favorites` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `favorite_by` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'FK:users(id)',
  `asset_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'FK:assets(id)',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `favorites_favorite_by_index` (`favorite_by`),
  KEY `favorites_asset_id_index` (`asset_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `favorite_by`, `asset_id`, `created_at`, `updated_at`) VALUES
(27, 1, 5, '2022-09-27 23:39:40', '2022-09-27 23:39:40'),
(29, 1, 4, '2022-09-28 00:33:50', '2022-09-28 00:33:50');

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

DROP TABLE IF EXISTS `follows`;
CREATE TABLE IF NOT EXISTS `follows` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `follow_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `follows_user_id_foreign` (`user_id`),
  KEY `follows_follow_by_foreign` (`follow_by`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`id`, `user_id`, `follow_by`, `created_at`, `updated_at`) VALUES
(24, 1, 1, '2022-10-01 07:02:22', '2022-10-01 07:02:22');

-- --------------------------------------------------------

--
-- Table structure for table `kyc_id_type`
--

DROP TABLE IF EXISTS `kyc_id_type`;
CREATE TABLE IF NOT EXISTS `kyc_id_type` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'like as password, driveing license',
  `group` enum('id proof','address proof') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'id proof' COMMENT 'like as "id proof","address proof"',
  `created_by` bigint(20) UNSIGNED NOT NULL COMMENT 'account reference by users table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kyc_id_type_created_by_index` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kyc_verifications`
--

DROP TABLE IF EXISTS `kyc_verifications`;
CREATE TABLE IF NOT EXISTS `kyc_verifications` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `id_number` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'like as NID',
  `issue_date` timestamp NULL DEFAULT NULL,
  `exp_date` timestamp NULL DEFAULT NULL,
  `doc_type` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'like as password, NID',
  `perpose` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'like as "ID proof"',
  `document_name` json DEFAULT NULL COMMENT 'Front and/or back side of document',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Approve status 0 for pending, 1 for verified, 2 for declined',
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Whose admin approved kyc',
  `approved_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kyc_verifications_user_id_index` (`user_id`),
  KEY `kyc_verifications_approved_by_index` (`approved_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `password` varchar(257) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_password` varchar(257) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `logs_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_09_12_075921_create_system_configs', 1),
(6, '2022_09_14_062233_create_countries_table', 1),
(7, '2022_09_14_063703_create_kyc_verifications_table', 1),
(8, '2022_09_14_063905_create_kyc_id_types_table', 1),
(9, '2022_09_14_064053_create_user_security_table', 1),
(10, '2022_09_14_064615_create_user_descriptions_table', 1),
(11, '2022_09_14_070731_create_company_info_table', 1),
(12, '2022_09_14_070803_create_smtp_table', 1),
(13, '2022_09_14_071233_create_affiliates_table', 1),
(14, '2022_09_14_073043_create_nft_asset_categories_table', 1),
(15, '2022_09_14_084115_create_nft_assets_table', 1),
(16, '2022_09_14_091635_create_nft_collections_table', 1),
(17, '2022_09_14_092403_create_nft_accounts_table', 1),
(18, '2022_09_14_094551_create_nft_sales_table', 1),
(19, '2022_09_14_125146_create_nft_asset_details_table', 1),
(20, '2022_09_15_051127_create_solical_accounts_table', 1),
(21, '2022_09_15_063909_create_sessions_table', 1),
(22, '2022_09_15_081223_create_favorites_table', 1),
(23, '2022_09_15_081247_create_asset_views_table', 1),
(24, '2022_09_22_092909_create_nft_asset_images_table', 1),
(25, '2022_09_23_141057_create_logs_table', 1),
(26, '2022_09_24_095814_create_deposits_table', 1),
(27, '2022_09_24_102709_create_notification_settings_table', 1),
(28, '2022_09_24_104120_create_bank_accounts_table', 1),
(29, '2022_09_24_104508_bank_accounts', 1),
(30, '2022_09_24_104554_create_admin_banks_table', 1),
(31, '2022_09_24_104653_other_transactions', 1),
(32, '2022_09_24_104837_transaction_settings', 1),
(33, '2022_09_25_062549_create_crypto_addresses_table', 1),
(34, '2022_09_25_075125_create_asset_ratings_table', 1),
(35, '2022_09_25_080243_create_bids_table', 1),
(36, '2022_09_25_133220_create_follows_table', 1),
(37, '2022_09_26_045729_create_withdraws_table', 1),
(38, '2022_09_27_044735_create_notifications_table', 1),
(39, '2022_09_27_045528_create_notification_showns_table', 1),
(40, '2022_09_27_050033_create_comments_table', 1),
(41, '2022_09_27_114845_create_contact_us_table', 2),
(42, '2022_09_28_071750_create_nft_forums_table', 2),
(43, '2022_09_28_110504_create_subscriptions_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `nft_accounts`
--

DROP TABLE IF EXISTS `nft_accounts`;
CREATE TABLE IF NOT EXISTS `nft_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'FK:users(id)',
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'nft user name',
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Account address unique',
  `private_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Private key for gnerate seccret key(address)',
  `details` json DEFAULT NULL COMMENT 'Other extra data fields (JSONB)',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nft_accounts_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nft_assets`
--

DROP TABLE IF EXISTS `nft_assets`;
CREATE TABLE IF NOT EXISTS `nft_assets` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'ID of NFT asset Category FK:category(id)',
  `sale_type` int(11) NOT NULL DEFAULT '4' COMMENT '1= Fidex Price, 2= Timed Auction, 3= Not for Sale, 4 = Open for offer',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'name of the nft',
  `contract_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'creation date of the smart contract',
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'the nft url',
  `owner_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ID of the NFT owner account, FK: accounts(id)',
  `base_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'NFT base price',
  `bit_time` date DEFAULT NULL,
  `blockchain` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'like as Ethereum',
  `price_symbol` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Payment symbol (usually ETH, depends on the blockchain where the NFT is minted)',
  `sales_status` enum('pending','sold','process','approved') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nft_assets_category_id_foreign` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nft_assets`
--

INSERT INTO `nft_assets` (`id`, `category_id`, `sale_type`, `name`, `contract_date`, `url`, `owner_id`, `base_price`, `bit_time`, `blockchain`, `price_symbol`, `sales_status`, `created_at`, `updated_at`) VALUES
(2, 1, 4, 'Image NFT 1', NULL, 'https://demo_url.com', '1', '200', '2022-09-23', NULL, 'ETH', 'pending', '2022-09-23 06:56:14', '2022-09-23 06:56:14'),
(3, 2, 4, 'Video NFT 1', NULL, 'https://demo_url.com', '1', '200', '2022-09-23', NULL, 'ETH', 'pending', '2022-09-23 06:56:14', '2022-09-23 06:56:14'),
(4, 3, 4, 'Gif NFT 1', NULL, 'https://demo_url.com', '1', '200', '2022-09-23', NULL, 'ETH', 'pending', '2022-09-23 06:56:14', '2022-09-23 06:56:14'),
(5, 4, 4, '3d NFT 1', NULL, 'https://demo_url.com', '1', '200', '2022-09-23', NULL, 'ETH', 'pending', '2022-09-23 06:56:14', '2022-09-23 06:56:14');

-- --------------------------------------------------------

--
-- Table structure for table `nft_asset_categories`
--

DROP TABLE IF EXISTS `nft_asset_categories`;
CREATE TABLE IF NOT EXISTS `nft_asset_categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci COMMENT 'Category Description for NFT assets',
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'slug for url and seo',
  `meta_tags` json DEFAULT NULL COMMENT 'Category Tags for meta',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nft_asset_categories`
--

INSERT INTO `nft_asset_categories` (`id`, `category`, `description`, `slug`, `meta_tags`, `created_at`, `updated_at`) VALUES
(1, 'Image', 'The NFT categroy is Image ', '/image', NULL, '2022-09-23 06:54:04', '2022-09-23 06:54:04'),
(2, 'video', 'The NFT categroy is video ', '/video', NULL, '2022-09-23 06:54:04', '2022-09-23 06:54:04'),
(3, 'gif', 'The NFT categroy is gif ', '/gif', NULL, '2022-09-23 06:54:04', '2022-09-23 06:54:04'),
(4, '3d', 'The NFT categroy is 3d ', '/3d', NULL, '2022-09-23 06:54:04', '2022-09-23 06:54:04');

-- --------------------------------------------------------

--
-- Table structure for table `nft_asset_details`
--

DROP TABLE IF EXISTS `nft_asset_details`;
CREATE TABLE IF NOT EXISTS `nft_asset_details` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nft_asset_id` bigint(20) UNSIGNED NOT NULL COMMENT 'FK:nft_assets(id)',
  `levels` json DEFAULT NULL COMMENT 'data field name and value, Levels show up underneath your item, are clickable, and can be filtered in your collection''s sidebar.',
  `properties` json DEFAULT NULL COMMENT ' data fields type and name (JSONB), like as type and name. Properties show up underneath your item, are clickable, and can be filtered in your collection''s sidebar.',
  `states` json DEFAULT NULL COMMENT ' data fields name and value (JSONB), like as type and name. Stats show up underneath your item, are clickable, and can be filtered in your collection''s sidebar.',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'description of the nft',
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_tags` json DEFAULT NULL,
  `unblockable_content` json DEFAULT NULL COMMENT 'content (access key, code to redeem, link to a file, etc.)',
  `sensitive_content` tinyint(1) DEFAULT NULL COMMENT 'Set this item as explicit and sensitive content',
  `supply` int(11) DEFAULT NULL COMMENT 'The number of items that can be minted. No gas cost to user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nft_asset_details_nft_asset_id_foreign` (`nft_asset_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nft_asset_images`
--

DROP TABLE IF EXISTS `nft_asset_images`;
CREATE TABLE IF NOT EXISTS `nft_asset_images` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nft_asset_id` bigint(20) UNSIGNED NOT NULL COMMENT 'FK:nft_asset(id)',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nft_asset_images_nft_asset_id_foreign` (`nft_asset_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nft_asset_images`
--

INSERT INTO `nft_asset_images` (`id`, `nft_asset_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 2, 'nftimg1.jpg', '2022-09-23 07:14:33', '2022-09-23 07:14:33'),
(2, 3, 'nftvideo1.jpg', '2022-09-23 07:14:33', '2022-09-23 07:14:33'),
(3, 4, 'nftgif1.jpg', '2022-09-23 07:17:26', '2022-09-23 07:17:26'),
(4, 5, 'nft3d1.jpg', '2022-09-23 07:17:26', '2022-09-23 07:17:26');

-- --------------------------------------------------------

--
-- Table structure for table `nft_collections`
--

DROP TABLE IF EXISTS `nft_collections`;
CREATE TABLE IF NOT EXISTS `nft_collections` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'FK:users(id)',
  `slug` json DEFAULT NULL COMMENT 'Slug of the collections unique',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Name of the collection',
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Url of the collection',
  `profile_photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Profile Photo of collection',
  `cover_photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'cover Photo of collection',
  `details` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Other extra data ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `item` json NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nft_collections_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nft_collections`
--

INSERT INTO `nft_collections` (`id`, `user_id`, `slug`, `name`, `url`, `profile_photo`, `cover_photo`, `details`, `created_at`, `updated_at`, `item`) VALUES
(1, 1, NULL, 'test', NULL, '1664343878_cover_baby-wag-finger.gif', '1664343878_cover_neonflames.png', 'description', '2022-09-27 23:44:38', '2022-09-27 23:44:38', 'null');

-- --------------------------------------------------------

--
-- Table structure for table `nft_forums`
--

DROP TABLE IF EXISTS `nft_forums`;
CREATE TABLE IF NOT EXISTS `nft_forums` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nft_sales`
--

DROP TABLE IF EXISTS `nft_sales`;
CREATE TABLE IF NOT EXISTS `nft_sales` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `time` timestamp NULL DEFAULT NULL COMMENT 'time of the sale',
  `asset_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'ID of the NFT, FK: assets(id)',
  `collection_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'ID of the collection this NFT belongs to, FK: collections(id))',
  `auction_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Auction type (''dutch'', ''english'', ''min_price'')',
  `contract_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Address of the smart contract',
  `quantity` int(11) DEFAULT NULL COMMENT 'NFT quantity sold',
  `payment_symbol` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Payment symbol (usually ETH, depends on the blockchain where the NFT is minted)',
  `total_price` double(8,2) DEFAULT NULL COMMENT 'Total price paid for the NFT',
  `seller_account` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Seller''s account, FK: accounts(id)',
  `from_account` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Account used to transfer from, FK: accounts(id)',
  `to_account` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Account used to transfer to, FK: accounts(id)',
  `winner_account` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Buyer''s account, FK: accounts(id)',
  `order_status` enum('pending','process','done','cancel') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nft_sales_asset_id_index` (`asset_id`),
  KEY `nft_sales_collection_id_index` (`collection_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nft_sales`
--

INSERT INTO `nft_sales` (`id`, `time`, `asset_id`, `collection_id`, `auction_type`, `contract_address`, `quantity`, `payment_symbol`, `total_price`, `seller_account`, `from_account`, `to_account`, `winner_account`, `order_status`, `created_at`, `updated_at`) VALUES
(1, NULL, 2, NULL, NULL, NULL, NULL, NULL, 200.00, 1, 1, 1, 1, 'done', '2022-09-28 06:51:22', '2022-09-28 06:51:22'),
(2, NULL, 3, NULL, NULL, NULL, NULL, NULL, 200.00, 1, 1, 1, 1, 'done', '2022-09-28 06:51:22', '2022-09-28 06:51:22'),
(3, NULL, 4, NULL, NULL, NULL, NULL, NULL, 200.00, 1, 1, 1, 1, 'done', '2022-09-28 06:51:22', '2022-09-28 06:51:22'),
(4, NULL, 4, NULL, NULL, NULL, NULL, NULL, 200.00, 1, 1, 1, 1, 'done', '2022-09-28 06:51:22', '2022-09-28 06:51:22');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `notification_for` enum('order_confirm','new_item','new_bid','payment_card','ending_bid','approve_product') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'It''s define by notification settings',
  `from_table_model` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Which table this notification came from ',
  `table_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ID of Which table this notification came from ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `notification_for`, `from_table_model`, `table_id`, `created_at`, `updated_at`) VALUES
(1, 'order_confirm', 'NftAssets', '1', '2022-09-28 06:50:20', '2022-09-28 06:50:20');

-- --------------------------------------------------------

--
-- Table structure for table `notification_settings`
--

DROP TABLE IF EXISTS `notification_settings`;
CREATE TABLE IF NOT EXISTS `notification_settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'FK:users(id)',
  `order_confirm` tinyint(1) NOT NULL DEFAULT '1',
  `new_item` tinyint(1) NOT NULL DEFAULT '1',
  `new_bid` tinyint(1) NOT NULL DEFAULT '1',
  `payment_card` tinyint(1) NOT NULL DEFAULT '1',
  `ending_bid` tinyint(1) NOT NULL DEFAULT '1',
  `approve_product` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_settings`
--

INSERT INTO `notification_settings` (`id`, `user_id`, `order_confirm`, `new_item`, `new_bid`, `payment_card`, `ending_bid`, `approve_product`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 1, 1, 1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notification_showns`
--

DROP TABLE IF EXISTS `notification_showns`;
CREATE TABLE IF NOT EXISTS `notification_showns` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `notification_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notification_showns_notification_id_foreign` (`notification_id`),
  KEY `notification_showns_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_showns`
--

INSERT INTO `notification_showns` (`id`, `notification_id`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 1, 1, '2022-09-29 05:19:43', '2022-09-29 05:19:43');

-- --------------------------------------------------------

--
-- Table structure for table `other_transactions`
--

DROP TABLE IF EXISTS `other_transactions`;
CREATE TABLE IF NOT EXISTS `other_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `transaction_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Neteller, Skrill, Crypto',
  `crypto_type` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'BTC, ETH, LTC, USDT',
  `crypto_instrument` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'BTC, ETH, LTC, USDT',
  `crypto_address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crypto_amount` decimal(19,8) DEFAULT NULL,
  `account_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `smtp`
--

DROP TABLE IF EXISTS `smtp`;
CREATE TABLE IF NOT EXISTS `smtp` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mail_driver` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'smtp mail driver for email configuration',
  `host` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'smtp host name',
  `port` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'smtp port',
  `mail_user` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'smtp configuration user name',
  `mail_password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'smtp configuration password',
  `mail_encryption` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'smtp encryption type like tls, ssl',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social_accounts`
--

DROP TABLE IF EXISTS `social_accounts`;
CREATE TABLE IF NOT EXISTS `social_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `skype` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telegram` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `social_accounts_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subscriptions_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_configs`
--

DROP TABLE IF EXISTS `system_configs`;
CREATE TABLE IF NOT EXISTS `system_configs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `theme` json DEFAULT NULL,
  `logo` json DEFAULT NULL COMMENT 'multiple logos here, like as brand logo, brand logo for email',
  `fab_icon` json DEFAULT NULL COMMENT 'multiple fabicon here, like as apple fabicon, android fabicon, desktop fabicon',
  `privacy_statement` text COLLATE utf8mb4_unicode_ci,
  `crm_type` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_meta_acc` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 for manually, 1 for automatically',
  `platform_book` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc_limit` int(11) DEFAULT NULL COMMENT 'trading account limit',
  `acc_start_from` int(11) NOT NULL DEFAULT '0' COMMENT 'Trading account number start from',
  `brute_force_attack` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 for activate, 0 for deactivate',
  `social_account` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 for social account take from user, 0 for not take',
  `kyc_back_part` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=>only front, 1=>front and back part are required',
  `notification_tour` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'check admin info for notification',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_settings`
--

DROP TABLE IF EXISTS `transaction_settings`;
CREATE TABLE IF NOT EXISTS `transaction_settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `transaction_type` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_transaction` double(10,2) NOT NULL,
  `max_transaction` double(10,2) NOT NULL,
  `charge_type` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `limit_start` double(10,2) NOT NULL,
  `limit_end` double(10,2) NOT NULL,
  `kyc` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 for true, 0 for false',
  `amount` double(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `permission` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Panding',
  `active_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 for disable, 1 for active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL COMMENT '0 for user, 1 for staff, 2 for admin',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 for active status, 0 for disabled status',
  `login_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 for true, 0 for false',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `g_auth` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Google 2 step 1 for inable, 0 for disable',
  `email_auth` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Email auth 1 for inable, 0 for disable',
  `secret_key` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verification` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 for false, 1 for true',
  `withdraw_operation` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 for false, 1 for true',
  `tmp_pass` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 for false, 1 for true',
  `tmp_tran_pass` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 for false, 1 for true',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_photo` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `facebook_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_phone_unique` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `type`, `password`, `transaction_password`, `active_status`, `login_status`, `email_verified_at`, `g_auth`, `email_auth`, `secret_key`, `email_verification`, `withdraw_operation`, `tmp_pass`, `tmp_tran_pass`, `remember_token`, `current_team_id`, `profile_photo`, `cover_photo`, `created_at`, `updated_at`, `facebook_id`, `google_id`) VALUES
(1, 'Alifur  Rahman', 'alifurcoder@gmail.com', '01733061986', NULL, '$2y$10$/gfEtzDXkbny3YklqMU/uenHuNWurfjSCEQ0bRPjn4B58lasqZdVa', NULL, 1, 0, NULL, 0, 0, NULL, 0, 0, 0, 0, NULL, NULL, '1664288294_profile_baby-wag-finger.gif', '1664288300_cover_neonflames.png', '2022-09-27 07:05:34', '2022-09-27 08:18:20', NULL, NULL),
(2, 'Alifur  ', 'alifurdcoder@gmail.com', '01733071986', NULL, '$2y$10$/gfEtzDXkbny3YklqMU/uenHuNWurfjSCEQ0bRPjn4B58lasqZdVa', NULL, 1, 0, NULL, 0, 0, NULL, 0, 0, 0, 0, NULL, NULL, '1664288294_profile_baby-wag-finger.gif', '1664288300_cover_neonflames.png', '2022-09-27 07:05:34', '2022-09-27 08:18:20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_descriptions`
--

DROP TABLE IF EXISTS `user_descriptions`;
CREATE TABLE IF NOT EXISTS `user_descriptions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `state` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `about_user` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_descriptions_user_id_index` (`user_id`),
  KEY `user_descriptions_country_id_index` (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_security`
--

DROP TABLE IF EXISTS `user_security`;
CREATE TABLE IF NOT EXISTS `user_security` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `withdraw_otp` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'need otp when withdraw request 0 or 1',
  `password_otp` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'need otp when change password request 0 or 1',
  `transaction_pin_otp` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'need otp when change transaction pin request 0 or 1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_security_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdraws`
--

DROP TABLE IF EXISTS `withdraws`;
CREATE TABLE IF NOT EXISTS `withdraws` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transaction_id` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Bank, Other(Skrill, Neteller, Crypto)',
  `bank_account_id` bigint(20) UNSIGNED DEFAULT NULL,
  `other_transaction_id` bigint(20) UNSIGNED DEFAULT NULL,
  `block_chain` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crypto_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crypto_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `crypto_amount` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `charge` double DEFAULT NULL,
  `charge_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'references by transaction_settings table',
  `approved_status` enum('A','P','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'P' COMMENT 'A for approved, P for pending, D for Decline',
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'user ip address',
  `note` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `withdraws_user_id_index` (`user_id`),
  KEY `withdraws_charge_id_index` (`charge_id`),
  KEY `withdraws_approved_by_index` (`approved_by`),
  KEY `withdraws_bank_account_id_foreign` (`bank_account_id`),
  KEY `withdraws_other_transaction_id_foreign` (`other_transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `affiliates`
--
ALTER TABLE `affiliates`
  ADD CONSTRAINT `affiliates_affiliat_id_foreign` FOREIGN KEY (`affiliat_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `affiliates_reference_id_foreign` FOREIGN KEY (`reference_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `asset_views`
--
ALTER TABLE `asset_views`
  ADD CONSTRAINT `asset_views_asset_id_foreign` FOREIGN KEY (`asset_id`) REFERENCES `nft_assets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asset_views_viewed_by_foreign` FOREIGN KEY (`viewed_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD CONSTRAINT `bank_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_commented_by_foreign` FOREIGN KEY (`commented_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `crypto_addresses`
--
ALTER TABLE `crypto_addresses`
  ADD CONSTRAINT `crypto_addresses_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `deposits`
--
ALTER TABLE `deposits`
  ADD CONSTRAINT `deposits_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `deposits_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_asset_id_foreign` FOREIGN KEY (`asset_id`) REFERENCES `nft_assets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_favorite_by_foreign` FOREIGN KEY (`favorite_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_follow_by_foreign` FOREIGN KEY (`follow_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `follows_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kyc_id_type`
--
ALTER TABLE `kyc_id_type`
  ADD CONSTRAINT `kyc_id_type_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kyc_verifications`
--
ALTER TABLE `kyc_verifications`
  ADD CONSTRAINT `kyc_verifications_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kyc_verifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `nft_assets`
--
ALTER TABLE `nft_assets`
  ADD CONSTRAINT `nft_assets_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `nft_asset_categories` (`id`);

--
-- Constraints for table `nft_asset_details`
--
ALTER TABLE `nft_asset_details`
  ADD CONSTRAINT `nft_asset_details_nft_asset_id_foreign` FOREIGN KEY (`nft_asset_id`) REFERENCES `nft_assets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `nft_asset_images`
--
ALTER TABLE `nft_asset_images`
  ADD CONSTRAINT `nft_asset_images_nft_asset_id_foreign` FOREIGN KEY (`nft_asset_id`) REFERENCES `nft_assets` (`id`);

--
-- Constraints for table `nft_collections`
--
ALTER TABLE `nft_collections`
  ADD CONSTRAINT `nft_collections_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `notification_showns`
--
ALTER TABLE `notification_showns`
  ADD CONSTRAINT `notification_showns_notification_id_foreign` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notification_showns_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `social_accounts`
--
ALTER TABLE `social_accounts`
  ADD CONSTRAINT `social_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_descriptions`
--
ALTER TABLE `user_descriptions`
  ADD CONSTRAINT `user_descriptions_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_descriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_security`
--
ALTER TABLE `user_security`
  ADD CONSTRAINT `user_security_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `withdraws`
--
ALTER TABLE `withdraws`
  ADD CONSTRAINT `withdraws_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `withdraws_bank_account_id_foreign` FOREIGN KEY (`bank_account_id`) REFERENCES `bank_accounts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `withdraws_charge_id_foreign` FOREIGN KEY (`charge_id`) REFERENCES `transaction_settings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `withdraws_other_transaction_id_foreign` FOREIGN KEY (`other_transaction_id`) REFERENCES `other_transactions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `withdraws_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
