-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th9 15, 2024 lúc 12:06 PM
-- Phiên bản máy phục vụ: 8.0.30
-- Phiên bản PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `test3`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attribute_type` tinyint UNSIGNED NOT NULL COMMENT '1: primary, 2: secondary',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `attribute_type`, `created_at`, `updated_at`) VALUES
(8, 'Kích Thước Quần Áo', 1, '2024-09-04 08:36:10', '2024-09-06 01:59:51'),
(9, 'Màu Sắc', 0, '2024-09-04 08:36:38', '2024-09-06 01:59:54'),
(10, 'Kích Thước giày dép', 1, '2024-09-04 08:37:07', '2024-09-06 09:23:12'),
(13, 'Kích Thước Các đò Phụ kiện như Mũ, túi,..', 1, '2024-09-04 08:38:18', '2024-09-04 08:38:18'),
(30, 'Dung Tích', 1, '2024-09-15 04:20:12', '2024-09-15 04:20:12'),
(31, 'Loại Nước Hoa', 0, '2024-09-15 04:20:26', '2024-09-15 04:20:26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attribute_groups`
--

CREATE TABLE `attribute_groups` (
  `id` bigint UNSIGNED NOT NULL,
  `group_id` bigint UNSIGNED NOT NULL,
  `attribute_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `attribute_groups`
--

INSERT INTO `attribute_groups` (`id`, `group_id`, `attribute_id`, `created_at`, `updated_at`) VALUES
(124, 55, 8, '2024-09-11 07:55:31', '2024-09-11 07:55:31'),
(125, 55, 9, '2024-09-11 07:55:31', '2024-09-11 07:55:31'),
(130, 58, 9, '2024-09-12 23:03:07', '2024-09-12 23:03:07'),
(131, 58, 10, '2024-09-12 23:03:07', '2024-09-12 23:03:07'),
(136, 61, 30, '2024-09-15 04:21:49', '2024-09-15 04:21:49'),
(137, 61, 31, '2024-09-15 04:21:49', '2024-09-15 04:21:49');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attribute_values`
--

CREATE TABLE `attribute_values` (
  `id` bigint UNSIGNED NOT NULL,
  `attribute_id` bigint UNSIGNED NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `attribute_values`
--

INSERT INTO `attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES
(27, 8, 'S', '2024-09-04 08:38:56', '2024-09-04 08:38:56'),
(28, 8, 'M', '2024-09-04 08:38:56', '2024-09-04 08:38:56'),
(29, 8, 'L', '2024-09-04 08:38:56', '2024-09-04 08:38:56'),
(30, 8, 'XL', '2024-09-04 08:38:56', '2024-09-04 08:38:56'),
(31, 8, 'XXL', '2024-09-04 08:38:56', '2024-09-04 08:38:56'),
(32, 9, 'Xanh lá cây', '2024-09-04 08:39:54', '2024-09-04 08:39:54'),
(33, 9, 'Xanh Nước biển', '2024-09-04 08:39:54', '2024-09-04 08:39:54'),
(34, 9, 'Đỏ', '2024-09-04 08:39:54', '2024-09-04 08:39:54'),
(35, 9, 'Vàng', '2024-09-04 08:39:54', '2024-09-04 08:39:54'),
(36, 9, 'Cam', '2024-09-04 08:39:54', '2024-09-04 08:39:54'),
(37, 9, 'Tím', '2024-09-04 08:39:54', '2024-09-04 08:39:54'),
(38, 10, '37.5', '2024-09-04 08:40:22', '2024-09-04 08:40:22'),
(39, 10, '38', '2024-09-04 08:40:22', '2024-09-04 08:40:22'),
(40, 10, '38.5', '2024-09-04 08:40:22', '2024-09-04 08:40:22'),
(41, 10, '39', '2024-09-04 08:40:22', '2024-09-04 08:40:22'),
(42, 10, '40', '2024-09-04 08:40:22', '2024-09-04 08:40:22'),
(43, 10, '41', '2024-09-04 08:40:22', '2024-09-04 08:40:22'),
(44, 10, '42', '2024-09-04 08:40:22', '2024-09-04 08:40:22'),
(61, 13, 'F', '2024-09-06 11:41:15', '2024-09-06 11:41:15'),
(90, 30, '10ml', '2024-09-15 04:20:58', '2024-09-15 04:20:58'),
(91, 30, '50ml', '2024-09-15 04:20:58', '2024-09-15 04:20:58'),
(92, 30, '100ml', '2024-09-15 04:20:58', '2024-09-15 04:20:58'),
(93, 30, '200ml', '2024-09-15 04:20:58', '2024-09-15 04:20:58'),
(94, 31, 'EDT', '2024-09-15 04:21:38', '2024-09-15 04:21:38'),
(95, 31, 'EDP', '2024-09-15 04:21:38', '2024-09-15 04:21:38'),
(96, 31, 'EDC', '2024-09-15 04:21:38', '2024-09-15 04:21:38');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
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
-- Cấu trúc bảng cho bảng `groups`
--

CREATE TABLE `groups` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `groups`
--

INSERT INTO `groups` (`id`, `name`, `created_at`, `updated_at`) VALUES
(55, 'Biến thể cho quần áo', '2024-09-11 07:55:31', '2024-09-11 07:55:31'),
(58, 'Biến thể cho giày dép', '2024-09-12 23:03:07', '2024-09-12 23:03:07'),
(61, 'Biến thể cho nước hoa', '2024-09-15 04:21:49', '2024-09-15 04:21:49');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_09_02_070539_create_attributes_table', 1),
(6, '2024_09_02_070557_create_attribute_values_table', 1),
(7, '2024_09_02_070612_create_attribute_groups_table', 1),
(8, '2024_09_02_070626_create_attribute_group_values_table', 1),
(9, '2024_09_02_070640_create_products_table', 1),
(10, '2024_09_02_070657_create_product_variations_table', 1),
(11, '2024_09_02_070717_create_product_variation_values_table', 1),
(12, '2024_09_02_071215_create_variation_images_table', 1),
(13, '2024_09_03_063218_add_price_to_products_table', 2),
(14, '2024_09_04_093054_drop_foreign_key_and_column_from_variation_images_table', 3),
(15, '2024_09_04_093621_create_product_variation_image_table', 4),
(23, '2024_09_04_143843_drop_product_variation_image_table', 5),
(24, '2024_09_04_144146_create_product_variation_groups_table', 5),
(25, '2024_09_04_144209_create_product_variation_group_images_table', 5),
(26, '2024_09_05_182422_create_attribute_types_table', 6),
(27, '2024_09_05_182702_add_attribute_type_id_to_attributes_table', 6),
(28, '2024_09_06_150626_modify_attributes_table', 7),
(29, '2024_09_08_120851_drop_product_variation_related_tables', 8),
(30, '2024_09_08_123003_drop_foreign_keys_from_product_variation_group_images', 9),
(31, '2024_09_08_171421_drop_product_variation_groups_tables', 10),
(32, '2024_09_08_171536_drop_product_variation_groups_tables', 11),
(34, '2024_09_08_171915_rename_variation_images_and_add_foreign_keys', 12),
(35, '2024_09_09_145048_update_product_variations_table', 12),
(36, '2024_09_09_145900_remove_sku_price_stock_from_product_variations', 13),
(37, '2024_09_09_151002_rename_product_variation_values_to_product_variation_sizes', 14),
(39, '2024_09_11_082022_rename_attribute_groups_to_groups', 15),
(40, '2024_09_11_083820_rename_attribute_group_id_to_group_id_in_attribute_groups', 16),
(41, '2024_09_11_084204_update_attribute_groups_table', 17),
(42, '2024_09_11_084827_add_foreign_key_to_attribute_groups_table', 18),
(43, '2024_09_11_090554_update_product_variation_images_table', 19),
(44, '2024_09_11_090802_rename_product_variation_sizes_to_product_variation_values', 20),
(45, '2024_09_12_043844_rename_attribute_group_id_to_group_id_in_product_variations_table', 21);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
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

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `price`, `created_at`, `updated_at`) VALUES
(52, 'MLB - Giày sneakers unisex cổ thấp Hopper V2', 'mlb-giay-sneakers-unisex-co-thap-hopper-v2-GqF03Op7', 2590000.00, '2024-09-15 04:04:38', '2024-09-15 04:04:38'),
(53, 'CHANEL Paris Venise', 'chanel-paris-venise-JAXWvJEN', 3590000.00, '2024-09-15 04:23:13', '2024-09-15 04:23:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_variations`
--

CREATE TABLE `product_variations` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `group_id` bigint UNSIGNED NOT NULL,
  `attribute_value_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_variations`
--

INSERT INTO `product_variations` (`id`, `product_id`, `group_id`, `attribute_value_id`, `created_at`, `updated_at`) VALUES
(81, 52, 58, 32, '2024-09-15 04:04:38', '2024-09-15 04:04:38'),
(82, 52, 58, 33, '2024-09-15 04:04:38', '2024-09-15 04:04:38'),
(83, 53, 61, 94, '2024-09-15 04:23:13', '2024-09-15 04:23:13'),
(84, 53, 61, 95, '2024-09-15 04:23:13', '2024-09-15 04:23:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_variation_images`
--

CREATE TABLE `product_variation_images` (
  `id` bigint UNSIGNED NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_type` enum('thumbnail','album') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'album',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_variation_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_variation_images`
--

INSERT INTO `product_variation_images` (`id`, `image_path`, `image_type`, `created_at`, `updated_at`, `product_variation_id`) VALUES
(366, 'uploads/avata/52/81/RRVsKu8eeBJyLmcpjTvcL3xnnhD9VTnqBbqAE8t7.webp', 'thumbnail', '2024-09-15 04:04:38', '2024-09-15 04:04:38', 81),
(367, 'uploads/album/52/81/KrcMdT6ZTonZ8mTBBvyHxULsedLPHicl2PJ8tB96.webp', 'album', '2024-09-15 04:04:38', '2024-09-15 04:04:38', 81),
(368, 'uploads/album/52/81/Bn2mkg2cGC2i8WUzjiWcbBzkYVZKEsP6iWQGHrPM.webp', 'album', '2024-09-15 04:04:38', '2024-09-15 04:04:38', 81),
(369, 'uploads/album/52/81/IcUu7Tsd0LYqeVZM71S0JWKsDqZQih8lABgEcKmQ.webp', 'album', '2024-09-15 04:04:38', '2024-09-15 04:04:38', 81),
(370, 'uploads/album/52/81/IL0KfjuCseEPp4CbSpDSUaLptNKSJRdCL8NseAiY.webp', 'album', '2024-09-15 04:04:38', '2024-09-15 04:04:38', 81),
(371, 'uploads/album/52/81/CtYWKROfpkAoYxutQnNLV32TL5N2u3YCx8BxlyY0.webp', 'album', '2024-09-15 04:04:38', '2024-09-15 04:04:38', 81),
(372, 'uploads/avata/52/82/iqTwHqi8zn6czVtL2ZeTczr4uFhDHrax303DAzEH.webp', 'thumbnail', '2024-09-15 04:04:38', '2024-09-15 04:04:38', 82),
(373, 'uploads/album/52/82/99UcO2uRk3WZAPztswrmaSLMHdoBDimQsRfgNAtK.webp', 'album', '2024-09-15 04:04:38', '2024-09-15 04:04:38', 82),
(374, 'uploads/album/52/82/tKyYykortHC3JAZX4IGfwsL1d80ZXPSBAwsijO0U.webp', 'album', '2024-09-15 04:04:38', '2024-09-15 04:04:38', 82),
(375, 'uploads/album/52/82/8l2oTRS6vXyHtvu9H69vG3ddNp1Z4TCWZOv1Dz4n.webp', 'album', '2024-09-15 04:04:38', '2024-09-15 04:04:38', 82),
(376, 'uploads/album/52/82/4WAXUSOJTqxXshbZ1C7IjhYv9LRSOdosHzEzAGqj.webp', 'album', '2024-09-15 04:04:38', '2024-09-15 04:04:38', 82),
(377, 'uploads/avata/53/83/f8Plsi0XJDhWoSpTM2QTyevihFBg0aPYmp6ZwyLv.jpg', 'thumbnail', '2024-09-15 04:23:13', '2024-09-15 04:23:13', 83),
(378, 'uploads/album/53/83/COQ3IykNeSIAaT5dA6HbzFIm9AMMElLCiB8APqqM.jpg', 'album', '2024-09-15 04:23:13', '2024-09-15 04:23:13', 83),
(379, 'uploads/album/53/83/x2WGk9d7mBqr5ItOrKvPwzrJdlqU6PeM6GonKLik.jpg', 'album', '2024-09-15 04:23:13', '2024-09-15 04:23:13', 83),
(380, 'uploads/album/53/83/W2TKu2gwIVOtROc321A2IpcOgeAiifN3IQslrSpB.jpg', 'album', '2024-09-15 04:23:13', '2024-09-15 04:23:13', 83),
(381, 'uploads/avata/53/84/6KGYhE5h8EIIxVvHeZ9pJUBxR2h1ZsTbSyjxdwe8.jpg', 'thumbnail', '2024-09-15 04:23:13', '2024-09-15 04:23:13', 84),
(382, 'uploads/album/53/84/edQlOL9RdouioIp1pWEwO5SO3mUxFSLfUB9FE5uP.jpg', 'album', '2024-09-15 04:23:13', '2024-09-15 04:23:13', 84),
(383, 'uploads/album/53/84/bgwA2VhLfaW266yknrtrpXkeCH0v41iRxbKOkrnZ.jpg', 'album', '2024-09-15 04:23:13', '2024-09-15 04:23:13', 84),
(384, 'uploads/album/53/84/hclDegs1tzKQBy4zxGhYaZs1aviQlM48VAbTnHVG.jpg', 'album', '2024-09-15 04:23:13', '2024-09-15 04:23:13', 84);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_variation_values`
--

CREATE TABLE `product_variation_values` (
  `id` bigint UNSIGNED NOT NULL,
  `product_variation_id` bigint UNSIGNED NOT NULL,
  `attribute_value_id` bigint UNSIGNED NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `price` decimal(10,2) DEFAULT NULL,
  `discount` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_variation_values`
--

INSERT INTO `product_variation_values` (`id`, `product_variation_id`, `attribute_value_id`, `sku`, `stock`, `price`, `discount`, `created_at`, `updated_at`) VALUES
(96, 81, 38, '331623501822_FSLN4VMI', 105, 2279200.00, 12, '2024-09-15 04:04:38', '2024-09-15 04:04:38'),
(97, 81, 39, '148288646828_POMKQ6OI', 108, 2201500.00, 15, '2024-09-15 04:04:38', '2024-09-15 04:04:38'),
(98, 81, 40, '217137162815_4RV6Z0AX', 110, 2331000.00, 10, '2024-09-15 04:04:38', '2024-09-15 04:04:38'),
(99, 82, 40, '347958407908_TI18YD5W', 200, 2072000.00, 20, '2024-09-15 04:04:38', '2024-09-15 04:04:38'),
(100, 82, 41, '709356832496_0XQQSU5K', 205, 2020200.00, 22, '2024-09-15 04:04:38', '2024-09-15 04:04:38'),
(101, 83, 91, '551329565563_ZR0Z1PUP', 100, 3159200.00, 12, '2024-09-15 04:23:13', '2024-09-15 04:23:13'),
(102, 83, 92, '986811491638_IEIXHGJL', 200, 3051500.00, 15, '2024-09-15 04:23:13', '2024-09-15 04:23:13'),
(103, 84, 90, '384727810633_BCEDZUJU', 500, 2872000.00, 20, '2024-09-15 04:23:13', '2024-09-15 04:23:13'),
(104, 84, 91, '307757700120_HKAPCC17', 105, 3015600.00, 16, '2024-09-15 04:23:13', '2024-09-15 04:23:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
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
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `attribute_groups`
--
ALTER TABLE `attribute_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_group_values_attribute_group_id_foreign` (`group_id`),
  ADD KEY `attribute_groups_attribute_id_foreign` (`attribute_id`);

--
-- Chỉ mục cho bảng `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_values_attribute_id_foreign` (`attribute_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `product_variations`
--
ALTER TABLE `product_variations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variations_product_id_foreign` (`product_id`),
  ADD KEY `product_variations_attribute_group_id_foreign` (`group_id`),
  ADD KEY `product_variations_attribute_value_id_foreign` (`attribute_value_id`);

--
-- Chỉ mục cho bảng `product_variation_images`
--
ALTER TABLE `product_variation_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variation_images_product_variation_id_foreign` (`product_variation_id`);

--
-- Chỉ mục cho bảng `product_variation_values`
--
ALTER TABLE `product_variation_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variation_values_product_variation_id_foreign` (`product_variation_id`),
  ADD KEY `product_variation_values_attribute_value_id_foreign` (`attribute_value_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `attribute_groups`
--
ALTER TABLE `attribute_groups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT cho bảng `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT cho bảng `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT cho bảng `product_variation_images`
--
ALTER TABLE `product_variation_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=385;

--
-- AUTO_INCREMENT cho bảng `product_variation_values`
--
ALTER TABLE `product_variation_values`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `attribute_groups`
--
ALTER TABLE `attribute_groups`
  ADD CONSTRAINT `attribute_group_values_attribute_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attribute_groups_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD CONSTRAINT `attribute_values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_variations`
--
ALTER TABLE `product_variations`
  ADD CONSTRAINT `product_variations_attribute_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_variations_attribute_value_id_foreign` FOREIGN KEY (`attribute_value_id`) REFERENCES `attribute_values` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_variations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_variation_images`
--
ALTER TABLE `product_variation_images`
  ADD CONSTRAINT `product_variation_images_product_variation_id_foreign` FOREIGN KEY (`product_variation_id`) REFERENCES `product_variations` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_variation_values`
--
ALTER TABLE `product_variation_values`
  ADD CONSTRAINT `product_variation_values_attribute_value_id_foreign` FOREIGN KEY (`attribute_value_id`) REFERENCES `attribute_values` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_variation_values_product_variation_id_foreign` FOREIGN KEY (`product_variation_id`) REFERENCES `product_variations` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
