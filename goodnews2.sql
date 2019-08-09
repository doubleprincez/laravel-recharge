-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2019 at 07:06 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `goodnews2`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_details`
--

CREATE TABLE `account_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `bank` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `activations`
--

CREATE TABLE `activations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `installment` tinyint(1) NOT NULL DEFAULT 0,
  `amount` double(8,2) DEFAULT NULL,
  `balance` double(8,2) DEFAULT NULL,
  `customer_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activations`
--

INSERT INTO `activations` (`id`, `user_id`, `installment`, `amount`, `balance`, `customer_code`, `reference`, `transaction_id`, `status`, `paid_at`, `created_at`, `updated_at`) VALUES
(2, 1, 0, 10000.00, 0.00, 'CUS_phcsoxxtoqcb94m', 'eaNeMRWESB5PaGODT7u0suRLK', '230054851', 'success', '2003-08-19 11:08:34', '2019-08-03 10:44:23', '2019-08-03 10:44:23');

-- --------------------------------------------------------

--
-- Table structure for table `airvends`
--

CREATE TABLE `airvends` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hash_key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `airvends`
--

INSERT INTO `airvends` (`id`, `username`, `password`, `hash_key`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'AXUNEOk4ks24352$%#w2323', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cashouts`
--

CREATE TABLE `cashouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ref_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `account_detail_id` bigint(20) NOT NULL,
  `amount` double(8,2) DEFAULT NULL,
  `rejected` tinyint(1) NOT NULL DEFAULT 0,
  `completed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `network_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0.0',
  `validity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `downlines`
--

CREATE TABLE `downlines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_paid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(3, '2019_07_29_213409_create_data_table', 1),
(4, '2019_07_29_214833_create_wallets_table', 1),
(6, '2019_07_29_215103_create_downlines_table', 1),
(8, '2019_07_30_171306_create_networkbonuses_table', 1),
(9, '2019_07_30_181958_create_otherbonuses_table', 1),
(10, '2019_07_30_182300_create_websettings_table', 1),
(11, '2019_07_31_050845_create_databonuses_table', 2),
(12, '2019_07_31_183559_create_airvends_table', 2),
(14, '2019_08_01_024128_create_jobs_table', 3),
(15, '2019_07_29_214956_create_transactions_table', 4),
(17, '2019_08_01_013054_create_activations_table', 5),
(18, '2019_08_04_092931_create_cashouts_table', 6),
(19, '2019_08_04_093957_create_account_details_table', 6),
(20, '2019_07_29_224924_create_recharges_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `otherbonuses`
--

CREATE TABLE `otherbonuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `festival_bonus` double(65,2) NOT NULL,
  `travelling_bonus` double(65,2) NOT NULL,
  `monthly_bonus` double(65,2) NOT NULL,
  `card_bonus` double(65,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `otherbonuses`
--

INSERT INTO `otherbonuses` (`id`, `festival_bonus`, `travelling_bonus`, `monthly_bonus`, `card_bonus`, `created_at`, `updated_at`) VALUES
(1, 0.47, 0.98, 1.08, 0.07, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recharges`
--

CREATE TABLE `recharges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `network_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `validity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `subscriber_id` text NOT NULL,
  `type` text NOT NULL,
  `transaction_id` text NOT NULL,
  `reference` text NOT NULL,
  `service_id` text DEFAULT NULL,
  `service_code` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `service_name` text DEFAULT NULL,
  `amount` float(8,2) NOT NULL,
  `paid_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `subscriber_id`, `type`, `transaction_id`, `reference`, `service_id`, `service_code`, `status`, `service_name`, `amount`, `paid_at`, `updated_at`, `created_at`) VALUES
(12, '20', 'wallet', '98f13708210194c475687be6106a3b84', '1565273420', '14', NULL, 'success', NULL, 1000.00, NULL, '2019-08-08 13:10:20', '2019-08-08 14:10:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` char(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'users/default.png',
  `referral_level` int(191) DEFAULT 1,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `_lft` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `_rgt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(191) DEFAULT NULL,
  `can_withdraw` tinyint(1) DEFAULT 0,
  `verified` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`, `gender`, `wallet_id`, `referral_code`, `status`, `avatar`, `referral_level`, `email`, `email_verified_at`, `password`, `remember_token`, `_lft`, `_rgt`, `parent_id`, `can_withdraw`, `verified`, `created_at`, `updated_at`) VALUES
(1, 'Ademola Segun', '07053251478', 'M', 'sgaeqwh847', 'qw87yuhsjd', 1, 'users/default.png', 1, 'adewaledon49@gmail.com', NULL, '$2y$12$eDw9VRNdpKNh/LolMI6zq.XEdQILR0rQpUN0T3QVA9bMP1MmBCkHm', NULL, '1', '10', NULL, 1, 1, NULL, '2019-08-08 16:46:30'),
(2, 'Double Prince', '08123456789', NULL, '2a018ea0-b972-11e9-8372-a570d259285d', '1d355f26deb170ff2c40aa2cadfdf79c', 1, 'users/default.png', 2, 'myemail@email.com', NULL, '$2y$10$rMMTZb.JrW54pl0CBox5AOrgpXXFR/9twLphlAH0HfGNoaVDG0gLa', NULL, '2', '9', 1, 0, 0, '2019-08-07 23:19:19', '2019-08-08 15:08:31'),
(18, 'Test 1', '09812132437', NULL, '3c98bdb0-b9d4-11e9-b613-3f2be410fed6', 'fccdc91b17f44868a8c60e1107434c20', 1, 'users/default.png', 1, 'test1@test.com', NULL, '$2y$10$9SyfD7oqwVrB7QxtK6xuie7DL5fyKyBuQuAInz9zuRjE5QJD2YwaC', NULL, '3', '4', 2, 0, 0, '2019-08-08 11:01:21', '2019-08-08 15:08:30'),
(19, 'Test 2', '08012212345', NULL, 'cfaed380-b9e0-11e9-a30d-fbb7eea5185a', 'bab8146e8d7cacadadee65141b467512', 1, 'users/default.png', 1, 'test2@test.com', NULL, '$2y$10$6kgRTW4GRoqNQ29LfR4FMu0/3NwwokLeMhijNgc7mQfSnigEpiAWu', NULL, '5', '8', 2, 0, 0, '2019-08-08 12:31:22', '2019-08-08 15:08:31'),
(20, 'Test 3', '08099896898', NULL, '9eaa2e80-b9e2-11e9-9ed6-2d7b0feb2c7f', '4aa1fbacb351c1c4ae6f13197f541285', 1, 'users/default.png', 1, 'test3@test.com', NULL, '$2y$10$jeoChxQ4bYhuoBwPkVuFh.e.mrIfkbYX/wZ8JvdC6DLovCGLnwev6', NULL, '6', '7', 19, 0, 0, '2019-08-08 12:44:18', '2019-08-08 15:08:31'),
(23, 'Test 4', '08012313434', NULL, 'd50bdcd0-b9f8-11e9-a6f6-05987b8acb4c', '65007296338b46d239bccbe06836da62', 1, 'users/default.png', 2, 'test4@test.com', NULL, '$2y$10$PlPFtKb2VpaWaUUmAV7fUOcHq48v1zpEtNAu3iIHElxd1399N7pOe', NULL, '11', '16', NULL, 0, 0, '2019-08-08 15:23:18', '2019-08-08 16:46:30'),
(32, 'Test 5', '09089709860', NULL, '74ef16b0-ba01-11e9-af89-f94ed6f63bac', 'fd39556d8c2326608886ceafcb14fb26', 1, 'users/default.png', 3, 'test5@test.com', NULL, '$2y$10$rKcMAVSgL8C5mgZnRk7DVOj3yhVx4R9kt9vXKHYekEUc.r21yI8DG', NULL, '12', '15', 23, 0, 0, '2019-08-08 16:25:03', '2019-08-08 16:46:30'),
(33, 'Test 6', '97090986086', NULL, '73e0e960-ba04-11e9-80e4-0db44b62f00f', '2e38dac0fa5fb5b99bc235daa1e55272', 1, 'users/default.png', 1, 'test6@test.com', NULL, '$2y$10$Q.noDAeZsBWabGaX.FZd2.A4XIbudPmgd4UkBgnnagQ43SAFb.cHm', NULL, '13', '14', 32, 0, 0, '2019-08-08 16:46:29', '2019-08-08 16:46:30');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `owner_id` bigint(191) NOT NULL,
  `wallet_balance` float NOT NULL DEFAULT 0,
  `card_bonus` float NOT NULL DEFAULT 0,
  `travelling_bonus` float DEFAULT 0,
  `monthly_bonus` float NOT NULL DEFAULT 0,
  `festival_bonus` float NOT NULL DEFAULT 0,
  `special` tinyint(1) DEFAULT 0,
  `special_bonus` float DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `owner_id`, `wallet_balance`, `card_bonus`, `travelling_bonus`, `monthly_bonus`, `festival_bonus`, `special`, `special_bonus`, `created_at`, `updated_at`) VALUES
(1, 1, 16500, 0, 0, 0, 0, 1, 150, NULL, '2019-08-08 13:10:20'),
(13, 2, 0, 0.35, 4.9, 5.4, 2.35, 0, 0, '2019-08-07 23:19:19', '2019-08-08 13:10:20'),
(14, 18, 1000, 0, 0, 0, 0, 0, 0, '2019-08-08 11:01:21', '2019-08-08 13:10:20'),
(15, 19, 0, 0.35, 4.9, 5.4, 2.35, 0, 0, '2019-08-08 12:31:22', '2019-08-08 13:10:20'),
(16, 20, 48900, 0, 0, 0, 0, 0, 0, '2019-08-08 12:44:18', '2019-08-08 13:10:20'),
(19, 23, 0, 0, 0, 0, 0, 0, 0, '2019-08-08 15:23:19', '2019-08-08 15:23:19'),
(25, 32, 0, 0, 0, 0, 0, 0, 0, '2019-08-08 16:25:03', '2019-08-08 16:25:03'),
(26, 33, 0, 0, 0, 0, 0, 0, 0, '2019-08-08 16:46:30', '2019-08-08 16:46:30');

-- --------------------------------------------------------

--
-- Table structure for table `websettings`
--

CREATE TABLE `websettings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Site_Name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_seo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_details`
--
ALTER TABLE `account_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_details_user_id_unique` (`user_id`);

--
-- Indexes for table `activations`
--
ALTER TABLE `activations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `airvends`
--
ALTER TABLE `airvends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cashouts`
--
ALTER TABLE `cashouts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cashouts_ref_id_unique` (`ref_id`);

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `downlines`
--
ALTER TABLE `downlines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otherbonuses`
--
ALTER TABLE `otherbonuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `recharges`
--
ALTER TABLE `recharges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_wallet_id_unique` (`wallet_id`),
  ADD UNIQUE KEY `users_referral_code_unique` (`referral_code`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `websettings`
--
ALTER TABLE `websettings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_details`
--
ALTER TABLE `account_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `activations`
--
ALTER TABLE `activations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `airvends`
--
ALTER TABLE `airvends`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cashouts`
--
ALTER TABLE `cashouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `downlines`
--
ALTER TABLE `downlines`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `otherbonuses`
--
ALTER TABLE `otherbonuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `recharges`
--
ALTER TABLE `recharges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `websettings`
--
ALTER TABLE `websettings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
