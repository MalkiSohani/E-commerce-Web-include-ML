/*
 Navicat Premium Data Transfer

 Source Server         : WOW Hosting
 Source Server Type    : MySQL
 Source Server Version : 100519
 Source Host           : 109.70.148.33:3306
 Source Schema         : arieslk_shopping-cart-without-suggetions

 Target Server Type    : MySQL
 Target Server Version : 100519
 File Encoding         : 65001

 Date: 01/05/2023 12:42:43
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cart_products
-- ----------------------------
DROP TABLE IF EXISTS `cart_products`;
CREATE TABLE `cart_products`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `cart` bigint UNSIGNED NOT NULL,
  `product` bigint UNSIGNED NOT NULL,
  `qty` int NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cart_products
-- ----------------------------
INSERT INTO `cart_products` VALUES (2, 1, 3, 4, 1400, '2023-05-01 05:15:53', '2023-05-01 05:16:08');

-- ----------------------------
-- Table structure for carts
-- ----------------------------
DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user` bigint UNSIGNED NOT NULL,
  `total` double NOT NULL,
  `status` enum('1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of carts
-- ----------------------------
INSERT INTO `carts` VALUES (1, 3, 1400, '2', '2023-05-01 05:07:11', '2023-05-01 05:54:38');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO `migrations` VALUES (3, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (5, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (8, '2021_12_21_044250_create_routes_table', 2);
INSERT INTO `migrations` VALUES (9, '2021_12_21_045534_create_user_types_table', 2);
INSERT INTO `migrations` VALUES (10, '2021_12_21_060615_create_permissions_table', 2);
INSERT INTO `migrations` VALUES (11, '2023_04_06_162921_create_products_table', 3);
INSERT INTO `migrations` VALUES (12, '2023_04_07_070530_create_shops_table', 3);
INSERT INTO `migrations` VALUES (13, '2023_04_10_184835_create_carts_table', 4);
INSERT INTO `migrations` VALUES (14, '2023_04_10_185020_create_cart_products_table', 4);
INSERT INTO `migrations` VALUES (15, '2023_04_27_190230_create_ratings_table', 5);
INSERT INTO `migrations` VALUES (16, '2023_04_30_060746_add_comment_to_ratings', 6);

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `route` int NOT NULL,
  `usertype` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (1, 1, 1, '2023-04-07 09:41:05', '2023-04-07 09:41:05');
INSERT INTO `permissions` VALUES (2, 2, 1, '2023-04-07 09:41:07', '2023-04-07 09:41:07');
INSERT INTO `permissions` VALUES (3, 3, 1, '2023-04-07 09:41:07', '2023-04-07 09:41:07');
INSERT INTO `permissions` VALUES (5, 1, 2, '2023-04-07 11:51:44', '2023-04-07 11:51:44');
INSERT INTO `permissions` VALUES (6, 4, 1, '2023-04-07 12:43:28', '2023-04-07 12:43:28');
INSERT INTO `permissions` VALUES (7, 5, 1, '2023-04-07 12:43:29', '2023-04-07 12:43:29');

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop` bigint UNSIGNED NOT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default-product.jpg',
  `rfid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int NOT NULL,
  `price` double NOT NULL,
  `is_fridge_item` tinyint(1) NOT NULL,
  `status` enum('1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 1, '202304071340.jpeg', 'D77D6B62', 'MAGGI Papare Kottu', 'Your at-home solution when your heart craves for a delicious Kottu, MAGGI Papare Kottu Noodles offers the mouthwatering flavors of Sri Lanka\'s ultimate street food dish with quick convenience! Popular among consumers of all ages, MAGGI Papare Kottu allows you to skip the queues at the crowded eateries to experience the real flavors within 2 minutes. Simply mix your favorite vegetables and meat options and taste the pure goodness.', 24, 360, 2, '1', '2023-04-07 13:29:40', '2023-04-13 09:06:12');
INSERT INTO `products` VALUES (2, 1, '202304071359.png', '17D36362', 'Baby Cheramy Baby Shampoo - 100.00 ml', 'With its mild no-tears formula, Baby Cheramy Shampoo is gentle on your baby’s eyes and keeps your baby’s hair shiny, healthy and soft. *Images are illustration purpose only, product received may vary.', 50, 280, 2, '1', '2023-04-07 13:47:59', '2023-04-12 21:57:52');
INSERT INTO `products` VALUES (3, 2, '202304091139.jpg', '09E2EDC1', 'Eh Necto 1.5L', 'The most fun drink in Elephant House’s ‘sweets range’, Necto has been a favourite among kids and adults alike for generations.\r\n\r\nIts super-duper taste is based on a secret recipe that adds a dash of excitement and a spoonful of fun and mischief and its very unique colour, which leaves your tongue pink for hours and hours makes sure that the fun with Necto never stops, even after your final sip.\r\n\r\nBrings out the kid in you. Enjoy Necto available in a variety of pack sizes and related price points.', 44, 350, 1, '1', '2023-04-09 11:06:39', '2023-05-01 05:45:36');
INSERT INTO `products` VALUES (4, 1, '202304111741.jpg', '0003', 'Samahan', 'Link Natural is committed to provide innovative, safe and effective products for our consumers to enjoy a healthy life. We are a research based company, driven by the challenging and inspiring corporate philosophy of fusing the wisdom of Ayurveda and other traditional systems of medicine with modern science and technology.', 45, 100, 2, '1', '2023-04-11 17:12:43', '2023-04-11 18:59:31');
INSERT INTO `products` VALUES (5, 2, '202304300716.png', '0006', 'Engine Oil', 'Engine Oil', 5, 2500, 2, '1', '2023-04-11 18:49:13', '2023-04-30 07:13:16');

-- ----------------------------
-- Table structure for ratings
-- ----------------------------
DROP TABLE IF EXISTS `ratings`;
CREATE TABLE `ratings`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user` bigint UNSIGNED NOT NULL,
  `product` bigint UNSIGNED NOT NULL,
  `rating` double(8, 2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `comment` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ratings
-- ----------------------------
INSERT INTO `ratings` VALUES (1, 3, 3, 2.00, '2023-05-01 07:08:39', '2023-05-01 07:08:39', 'test comment');
INSERT INTO `ratings` VALUES (2, 3, 3, 2.00, '2023-05-01 07:09:22', '2023-05-01 07:09:22', 'test 123');

-- ----------------------------
-- Table structure for routes
-- ----------------------------
DROP TABLE IF EXISTS `routes`;
CREATE TABLE `routes`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of routes
-- ----------------------------
INSERT INTO `routes` VALUES (1, 'Dashboard', '/home', 1, '2023-04-07 09:39:46', '2023-04-07 09:39:46');
INSERT INTO `routes` VALUES (2, 'Permission Management', '/usertypes', 1, '2023-04-07 09:39:48', '2023-04-07 09:39:48');
INSERT INTO `routes` VALUES (3, 'User Management', '/users', 1, '2023-04-07 09:39:49', '2023-04-07 09:39:49');
INSERT INTO `routes` VALUES (4, 'Shop Management', '/shops', 0, NULL, NULL);
INSERT INTO `routes` VALUES (5, 'Products Management', '/products', 0, NULL, NULL);

-- ----------------------------
-- Table structure for shops
-- ----------------------------
DROP TABLE IF EXISTS `shops`;
CREATE TABLE `shops`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `owner` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ltd` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shops
-- ----------------------------
INSERT INTO `shops` VALUES (1, 2, 'Foodies', '0112815364', 'Main Street, Colombo 05', '79.86124300000006', '6.9270786', '1', '2023-04-07 12:53:23', '2023-04-07 12:59:32', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.');
INSERT INTO `shops` VALUES (2, 2, 'Keells', '0112815656', 'No:148, Vauxhall Street, Colombo 2, Sri Lanka.', '79.852539', '6.936786', '1', '2023-04-09 11:04:52', '2023-04-09 11:04:52', NULL);

-- ----------------------------
-- Table structure for user_types
-- ----------------------------
DROP TABLE IF EXISTS `user_types`;
CREATE TABLE `user_types`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `usertype` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','2','3','4') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_types
-- ----------------------------
INSERT INTO `user_types` VALUES (1, 'Administrator', '1', '2023-04-07 08:36:03', '2023-04-07 08:36:03');
INSERT INTO `user_types` VALUES (2, 'Shop Owner', '1', '2023-04-07 08:36:05', '2023-04-07 08:36:05');
INSERT INTO `user_types` VALUES (3, 'User', '3', '2023-04-07 08:36:06', '2023-04-07 11:51:24');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `usertype` enum('1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '3',
  `status` enum('1','2','3','4') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Administrator', 'admin@gmail.com', NULL, '$2y$10$KmgPvFltsd7uzv1noqe3B.8Y7P6JQFgIQT1kPAE/efxm6iLhosY82', '1', '1', NULL, '2023-04-07 08:35:33', '2023-04-07 08:35:33');
INSERT INTO `users` VALUES (2, 'Store Manager', 'store@gmail.com', NULL, '$2y$10$M78/utEuYrVc/JnO8TJoWOtx3vH.UxxTo837L57N1NkygR281pryG', '2', '1', NULL, '2023-04-07 08:35:35', '2023-04-07 11:15:57');
INSERT INTO `users` VALUES (3, 'User', 'user@gmail.com', NULL, '$2y$10$mmQ4UJavuN.b9amLbW8wwemekZP2DXF6xdNV7LMLsRoi29lJK/kz6', '3', '1', NULL, '2023-04-07 08:35:35', '2023-04-07 11:17:13');
INSERT INTO `users` VALUES (4, 'Pasindu Priyashan', 'pasindu@gmail.com', NULL, '$2y$10$17ozhtPNGdN0pSEFhWNRH.b7xJHtUGIZY2IiY8wp/ASChuyivZY7i', '3', '4', NULL, '2023-04-07 11:21:13', '2023-04-07 11:53:51');
INSERT INTO `users` VALUES (5, 'Pasindu', 'pasi1ndu@gmail.com', NULL, '$2y$10$xXvUsRpr/aRR9Y54cE/v1uhJ5cQQSHzYkL731YmxWhjT6rOq6gdYu', '3', '4', NULL, '2023-04-09 07:53:30', '2023-04-13 08:58:46');

SET FOREIGN_KEY_CHECKS = 1;
