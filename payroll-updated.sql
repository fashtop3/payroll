-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 10, 2016 at 11:11 AM
-- Server version: 5.7.15-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payroll`
--
CREATE DATABASE IF NOT EXISTS `payroll` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `payroll`;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `profile_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `work_rotation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_id` int(10) UNSIGNED DEFAULT NULL,
  `bank_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `bank_reference` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `routine_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hold_pay` tinyint(1) NOT NULL DEFAULT '0',
  `currency` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `taxable` tinyint(1) NOT NULL DEFAULT '0',
  `pfa` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pfa_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `base_amount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `profile_id`, `category_id`, `work_rotation`, `bank_id`, `bank_address`, `account_type`, `account_name`, `account_number`, `bank_reference`, `routine_number`, `hold_pay`, `currency`, `taxable`, `pfa`, `pfa_number`, `base_amount`, `created_at`, `updated_at`) VALUES
(5, 26, 1, '', 15, 'Sango', 'Savings', 'Fashola Ayodeji Festus', '980987877665', '', '', 0, 'NGN', 1, '', '', '50000.00', '2016-09-01 14:01:45', '2016-09-02 09:42:31'),
(6, 40, 1, '', 4, 'Sango', 'Savings', 'Fashola Ayodeji Festus', '980987877665', '', '', 0, 'NGN', 0, '', '', '2000.00', '2016-10-06 18:54:52', '2016-10-06 18:54:52');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, 'AB', 'Access Bank', '2016-09-01 12:54:55', '2016-09-01 12:54:55'),
(2, NULL, 'Citybank', '2016-09-01 12:54:55', '2016-09-01 12:54:55'),
(3, 'DBN', 'Diamond Bank', '2016-09-01 12:54:55', '2016-09-01 12:54:55'),
(4, NULL, 'Ecobank Nigeria', '2016-09-01 12:54:55', '2016-09-01 12:54:55'),
(5, 'FIBN', 'Fidelity Bank Nigeria', '2016-09-01 12:54:55', '2016-09-01 12:54:55'),
(6, 'FBN', 'First Bank of Nigeria', '2016-09-01 12:54:55', '2016-09-01 12:54:55'),
(7, NULL, 'First City Monument Bank', '2016-09-01 12:54:55', '2016-09-01 12:54:55'),
(8, 'GTB', 'Guaranty Trust Bank', '2016-09-01 12:54:55', '2016-09-01 12:54:55'),
(9, 'HBP', 'Heritage Bank Plc', '2016-09-01 12:54:55', '2016-09-01 12:54:55'),
(10, 'KBN', 'Keystone Bank Limited', '2016-09-01 12:54:55', '2016-09-01 12:54:55'),
(11, NULL, 'Providus Bank Plc', '2016-09-01 12:54:55', '2016-09-01 12:54:55'),
(12, 'SBP', 'Skye Bank', '2016-09-01 12:54:55', '2016-09-01 12:54:55'),
(13, NULL, 'Stanbic IBTC Bank Nigeria Limited', '2016-09-01 12:54:55', '2016-09-01 12:54:55'),
(14, NULL, 'Standard Chartered Bank', '2016-09-01 12:54:55', '2016-09-01 12:54:55'),
(15, 'STB', 'Sterling Bank', '2016-09-01 12:54:55', '2016-09-01 12:54:55'),
(16, NULL, 'Suntrust Bank Nigeria Limited', '2016-09-01 12:54:55', '2016-09-01 12:54:55'),
(17, 'UBN', 'Union Bank of Nigeria', '2016-09-01 12:54:55', '2016-09-01 12:54:55'),
(18, 'UBA', 'United Bank for Africa', '2016-09-01 12:54:55', '2016-09-01 12:54:55'),
(19, 'UPB', 'Unity Bank Plc.', '2016-09-01 12:54:55', '2016-09-01 12:54:55'),
(20, 'WEMA', 'Wema Bank', '2016-09-01 12:54:55', '2016-09-01 12:54:55'),
(21, 'ZBN', 'Zenith Bank', '2016-09-01 12:54:55', '2016-09-01 12:54:55');

-- --------------------------------------------------------

--
-- Table structure for table `basics`
--

CREATE TABLE `basics` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `basics`
--

INSERT INTO `basics` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'Basic', NULL, '2016-09-01 14:30:34', '2016-09-01 14:40:16'),
(2, 'Education', NULL, '2016-09-01 14:40:36', '2016-09-01 14:40:36'),
(3, 'Housing Allowance', NULL, '2016-10-06 08:34:23', '2016-10-06 08:34:23'),
(4, 'Transport Allowance', NULL, '2016-10-06 08:35:18', '2016-10-06 08:35:18'),
(5, 'Recharge Card', NULL, '2016-10-06 08:35:44', '2016-10-06 08:35:44');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'CONTRACT', '2016-09-01 12:42:02', '2016-09-01 12:42:02');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Quality Control', '2016-09-22 20:02:31', '2016-09-22 20:02:31'),
(2, 'Sales-West Office 1-7-430', '2016-09-22 20:06:00', '2016-09-22 20:06:00'),
(3, 'Finance 1-0-090', '2016-09-22 20:07:43', '2016-09-22 20:07:43'),
(4, 'Security 1-0-215', '2016-09-22 20:08:45', '2016-09-22 20:08:45'),
(5, 'Marketing 1-0-250', '2016-09-22 20:09:06', '2016-09-22 20:13:28'),
(6, 'Supply Chain 1-0-500', '2016-09-22 20:09:37', '2016-09-22 20:09:37'),
(7, 'Technical 1-0-540', '2016-09-22 20:10:30', '2016-09-22 20:10:30'),
(8, 'Flour Mill 1-0-580', '2016-09-22 20:10:58', '2016-09-22 20:10:58'),
(9, 'Medical 1-0-225', '2016-09-22 20:11:55', '2016-09-22 20:11:55'),
(10, 'Sales-North(Abuja) 1-1-315', '2016-09-22 20:12:32', '2016-09-22 20:12:32');

-- --------------------------------------------------------

--
-- Table structure for table `emp_dates`
--

CREATE TABLE `emp_dates` (
  `id` int(10) UNSIGNED NOT NULL,
  `profile_id` int(10) UNSIGNED NOT NULL,
  `dob` date DEFAULT NULL,
  `doe` date DEFAULT NULL,
  `doc` date DEFAULT NULL,
  `last_promotion` date DEFAULT NULL,
  `pension_scheme` date DEFAULT NULL,
  `last_salary` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `emp_dates`
--

INSERT INTO `emp_dates` (`id`, `profile_id`, `dob`, `doe`, `doc`, `last_promotion`, `pension_scheme`, `last_salary`, `created_at`, `updated_at`) VALUES
(3, 26, '2016-09-12', '2016-09-27', NULL, NULL, NULL, NULL, '2016-09-01 14:01:44', '2016-09-03 15:43:53'),
(15, 40, '2016-10-12', '2016-10-21', '2016-10-05', '2016-10-19', '2016-10-13', '2016-10-05', '2016-10-06 18:54:52', '2016-10-06 18:54:52');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(11) NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2015_01_15_105324_create_roles_table', 1),
(4, '2015_01_15_114412_create_role_user_table', 1),
(5, '2015_01_26_115212_create_permissions_table', 1),
(6, '2015_01_26_115523_create_permission_role_table', 1),
(7, '2015_02_09_132439_create_permission_user_table', 1),
(8, '2016_08_20_091444_create_pay_type_table', 1),
(9, '2016_08_20_091446_create_categories_table', 1),
(10, '2016_08_20_091450_create_basics_table', 1),
(11, '2016_08_20_091460_create_states_table', 1),
(12, '2016_08_26_094641_create_banks_table', 1),
(13, '2016_08_29_002527_create_profiles_table', 1),
(14, '2016_08_29_002850_create_personals_table', 1),
(15, '2016_08_29_002919_create_accounts_table', 1),
(16, '2016_08_29_002938_create_emp_dates_table', 1),
(24, '2016_08_29_003042_create_rateables_table', 2),
(25, '2016_09_22_194429_create_departments_table', 3),
(26, '2016_10_06_154139_add_hours_to_rateables_table', 4),
(28, '2016_10_09_201740_add_code_to_banks', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pay_types`
--

CREATE TABLE `pay_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pay_types`
--

INSERT INTO `pay_types` (`id`, `label`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'SHIFT', 'Day', '0.1', '2016-09-01 14:06:41', '2016-09-01 14:06:41'),
(2, 'SHIFT', 'Night', '0.15', '2016-09-01 14:07:09', '2016-09-01 14:07:09'),
(3, 'OVERTIME', 'Normal Day', '1.25', '2016-09-01 14:12:38', '2016-09-01 14:12:38'),
(4, 'OVERTIME', 'Saturday', '1.5', '2016-09-01 14:13:13', '2016-09-01 14:13:13'),
(5, 'OVERTIME', 'Sunday/Public holiday', '2', '2016-09-01 14:13:44', '2016-09-01 14:13:44');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personals`
--

CREATE TABLE `personals` (
  `id` int(10) UNSIGNED NOT NULL,
  `profile_id` int(10) UNSIGNED NOT NULL,
  `gender` enum('male','female') COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('married','single','divorced') COLLATE utf8_unicode_ci NOT NULL,
  `nationality` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state_of_origin` int(10) UNSIGNED DEFAULT NULL,
  `paye_state` int(10) UNSIGNED DEFAULT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cost_center` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `personals`
--

INSERT INTO `personals` (`id`, `profile_id`, `gender`, `status`, `nationality`, `state_of_origin`, `paye_state`, `language`, `location`, `cost_center`, `notes`, `created_at`, `updated_at`) VALUES
(25, 26, 'male', 'married', 'Nigeria', 3, 5, 'English', 'location', 'center', 'Notes', '2016-09-01 14:01:44', '2016-09-02 10:04:53'),
(37, 40, 'male', 'single', 'Nigeria', 10, 13, 'Nigeria', '', 'Nigeria', '', '2016-10-06 18:54:52', '2016-10-06 18:54:52');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `eid` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `middlename` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `address1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state_id` int(10) UNSIGNED DEFAULT NULL,
  `city` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `postal` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `home_phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `office_phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `department_id` int(10) UNSIGNED DEFAULT NULL,
  `department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `created_by`, `eid`, `title`, `lastname`, `firstname`, `middlename`, `active`, `address1`, `address2`, `state_id`, `city`, `postal`, `country`, `mobile_phone`, `home_phone`, `office_phone`, `email`, `category_id`, `department_id`, `department`, `designation`, `approved`, `deleted_at`, `created_at`, `updated_at`) VALUES
(26, 1, '0000000026', 'mr', 'Fashola', 'Ayodeji', 'Oladipupo', 1, 'fake street', 'fake street', 9, 'Ibadan', 'Postal', 'nigeria', '08035112889', '08035112889', '08035112889', 'admin@payroll.com', 1, 1, 'Department', 'Designation', 0, NULL, '2016-09-01 14:01:44', '2016-09-02 11:47:13'),
(40, 1, 'CON0000040', 'mr', 'Oladipupo', 'admin', 'Oladipupo', 0, 'Nigeria', '', 4, 'Nigeria', '', 'Nigeria', '08035112889', '', '', 'mayowas29@gmail.com', 1, 2, NULL, '', 1, NULL, '2016-10-06 18:54:52', '2016-10-06 18:54:52');

-- --------------------------------------------------------

--
-- Table structure for table `rateables`
--

CREATE TABLE `rateables` (
  `id` int(10) UNSIGNED NOT NULL,
  `profile_id` int(10) UNSIGNED NOT NULL,
  `paytype_id` int(10) UNSIGNED DEFAULT NULL,
  `basic_id` int(10) UNSIGNED DEFAULT NULL,
  `taxable` tinyint(1) NOT NULL DEFAULT '0',
  `total` decimal(20,2) NOT NULL DEFAULT '0.00',
  `approved_by` int(10) UNSIGNED DEFAULT NULL,
  `umonth` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `hours` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rateables`
--

INSERT INTO `rateables` (`id`, `profile_id`, `paytype_id`, `basic_id`, `taxable`, `total`, `approved_by`, `umonth`, `created_at`, `updated_at`, `hours`) VALUES
(52, 26, 1, 1, 1, '227.27', 1, '2016-09', '2016-09-03 17:34:23', '2016-09-03 17:34:23', ''),
(55, 26, 2, 1, 1, '340.91', 1, '2016-09', '2016-09-03 17:35:43', '2016-09-03 17:35:43', ''),
(60, 40, 3, 1, 1, '300.00', 1, '2016-09', '2016-10-06 19:27:20', '2016-10-06 19:27:20', '1');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2016-09-02 01:17:21', '2016-09-02 01:17:21'),
(2, 2, 1, '2016-09-02 01:17:33', '2016-09-02 01:17:33'),
(3, 3, 1, '2016-09-02 01:17:38', '2016-09-02 01:17:38'),
(4, 4, 1, '2016-09-02 01:17:43', '2016-09-02 01:17:43');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `level`, `created_at`, `updated_at`) VALUES
(1, 'Payroll Manager', 'payroll.manager', NULL, 1, '2016-09-02 00:28:09', '2016-09-02 00:28:09'),
(2, 'Staff Manager', 'staff.manager', NULL, 1, '2016-09-02 00:28:36', '2016-09-02 00:28:36'),
(3, 'HR Manager', 'hr.manager', NULL, 1, '2016-09-02 00:29:03', '2016-09-02 00:29:03'),
(4, 'developer', 'developer', NULL, 1, '2016-09-02 00:29:24', '2016-09-02 00:29:24');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Abia', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(2, 'Adamawa', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(3, 'Akwa', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(4, 'Anambra', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(5, 'Bauchi', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(6, 'Bayelsa', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(7, 'Benue', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(8, 'Borno', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(9, 'Cross River', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(10, 'Delta', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(11, 'Ebonyi', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(12, 'Edo', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(13, 'Ekiti', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(14, 'Enugu', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(15, 'Federal Capital Territory', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(16, 'Gombe', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(17, 'Imo', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(18, 'Jigawa', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(19, 'Kaduna', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(20, 'Kano', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(21, 'Katsina', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(22, 'Kebbi', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(23, 'Kogi', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(24, 'Kwara', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(25, 'Lagos', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(26, 'Nasarawa', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(27, 'Niger', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(28, 'Ogun', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(29, 'Ondo', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(30, 'Osun', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(31, 'Oyo', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(32, 'Plateau', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(33, 'Rivers', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(34, 'Sokoto', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(35, 'Taraba', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(36, 'Yobe', '2016-09-01 12:49:15', '2016-09-01 12:49:15'),
(37, 'Zamfara', '2016-09-01 12:49:15', '2016-09-01 12:49:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `lastname`, `firstname`, `mobile`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin@payroll.com', '$2y$10$M1vkIpS8uSMAC1JCOsVfOezRft2QNawpiPrxEzy/7MU35z9y0KeQG', 'admin', 'admin', '08035112897', 'Fake street', 'RlTkJvDNGJkfDN1HY0dBWJdFTCJTIG9zwrvMqFDdScvUZZATbVq6P6mesiRP', '2016-09-01 12:32:50', '2016-10-03 12:03:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accounts_profile_id_foreign` (`profile_id`),
  ADD KEY `accounts_category_id_foreign` (`category_id`),
  ADD KEY `accounts_bank_id_foreign` (`bank_id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `basics`
--
ALTER TABLE `basics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_dates`
--
ALTER TABLE `emp_dates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_dates_profile_id_foreign` (`profile_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `pay_types`
--
ALTER TABLE `pay_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_user_permission_id_index` (`permission_id`),
  ADD KEY `permission_user_user_id_index` (`user_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_slug_unique` (`slug`);

--
-- Indexes for table `personals`
--
ALTER TABLE `personals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personals_profile_id_foreign` (`profile_id`),
  ADD KEY `personals_state_of_origin_foreign` (`state_of_origin`),
  ADD KEY `personals_paye_state_foreign` (`paye_state`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `profiles_email_unique` (`email`),
  ADD KEY `profiles_created_by_foreign` (`created_by`),
  ADD KEY `profiles_state_id_foreign` (`state_id`),
  ADD KEY `profiles_category_id_foreign` (`category_id`),
  ADD KEY `profiles_department_id_index` (`department_id`);

--
-- Indexes for table `rateables`
--
ALTER TABLE `rateables`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rateables_profile_id_paytype_id_umonth_unique` (`profile_id`,`paytype_id`,`umonth`),
  ADD KEY `rateables_paytype_id_foreign` (`paytype_id`),
  ADD KEY `rateables_basic_id_foreign` (`basic_id`),
  ADD KEY `rateables_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_index` (`role_id`),
  ADD KEY `role_user_user_id_index` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
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
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `basics`
--
ALTER TABLE `basics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `emp_dates`
--
ALTER TABLE `emp_dates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `pay_types`
--
ALTER TABLE `pay_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permission_user`
--
ALTER TABLE `permission_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `personals`
--
ALTER TABLE `personals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `rateables`
--
ALTER TABLE `rateables`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `accounts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `accounts_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `emp_dates`
--
ALTER TABLE `emp_dates`
  ADD CONSTRAINT `emp_dates_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `personals`
--
ALTER TABLE `personals`
  ADD CONSTRAINT `personals_paye_state_foreign` FOREIGN KEY (`paye_state`) REFERENCES `states` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `personals_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `personals_state_of_origin_foreign` FOREIGN KEY (`state_of_origin`) REFERENCES `states` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `profiles_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `profiles_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `profiles_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `rateables`
--
ALTER TABLE `rateables`
  ADD CONSTRAINT `rateables_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `rateables_basic_id_foreign` FOREIGN KEY (`basic_id`) REFERENCES `basics` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `rateables_paytype_id_foreign` FOREIGN KEY (`paytype_id`) REFERENCES `pay_types` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `rateables_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
