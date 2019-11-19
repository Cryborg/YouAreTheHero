-- Adminer 4.7.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `admin_menu`;
CREATE TABLE `admin_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `order` int(11) NOT NULL DEFAULT 0,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `permission`, `created_at`, `updated_at`) VALUES
(1,	0,	1,	'Dashboard',	'fa-bar-chart',	'/',	NULL,	NULL,	NULL),
(2,	0,	2,	'Admin',	'fa-tasks',	'',	NULL,	NULL,	NULL),
(3,	2,	3,	'Users',	'fa-users',	'auth/users',	NULL,	NULL,	NULL),
(4,	2,	4,	'Roles',	'fa-user',	'auth/roles',	NULL,	NULL,	NULL),
(5,	2,	5,	'Permission',	'fa-ban',	'auth/permissions',	NULL,	NULL,	NULL),
(6,	2,	6,	'Menu',	'fa-bars',	'auth/menu',	NULL,	NULL,	NULL),
(7,	2,	7,	'Operation log',	'fa-history',	'auth/logs',	NULL,	NULL,	NULL),
(8,	0,	0,	'Pages',	'fa-align-justify',	'pages',	'dashboard',	'2019-11-18 15:07:09',	'2019-11-18 15:07:09'),
(9,	0,	0,	'Stories',	'fa-american-sign-language-interpreting',	'stories',	'dashboard',	'2019-11-18 15:07:43',	'2019-11-18 15:07:43');

DROP TABLE IF EXISTS `admin_operation_log`;
CREATE TABLE `admin_operation_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_operation_log_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admin_operation_log` (`id`, `user_id`, `path`, `method`, `ip`, `input`, `created_at`, `updated_at`) VALUES
(1,	1,	'admin/auth/login',	'GET',	'192.168.10.1',	'[]',	'2019-11-18 15:03:16',	'2019-11-18 15:03:16'),
(2,	1,	'admin',	'GET',	'192.168.10.1',	'[]',	'2019-11-18 15:03:17',	'2019-11-18 15:03:17'),
(3,	1,	'admin',	'GET',	'192.168.10.1',	'[]',	'2019-11-18 15:05:39',	'2019-11-18 15:05:39'),
(4,	1,	'admin/auth/menu',	'GET',	'192.168.10.1',	'{\"_pjax\":\"#pjax-container\"}',	'2019-11-18 15:05:56',	'2019-11-18 15:05:56'),
(5,	1,	'admin/auth/menu',	'POST',	'192.168.10.1',	'{\"parent_id\":\"0\",\"title\":\"Pages\",\"icon\":\"fa-align-justify\",\"uri\":\"pages\",\"roles\":[\"1\",null],\"permission\":\"dashboard\",\"_token\":\"gbom0fmqofxODmmiGx3CjVYo0zghKEEjis8Y83pY\"}',	'2019-11-18 15:07:09',	'2019-11-18 15:07:09'),
(6,	1,	'admin/auth/menu',	'GET',	'192.168.10.1',	'[]',	'2019-11-18 15:07:10',	'2019-11-18 15:07:10'),
(7,	1,	'admin/auth/menu',	'POST',	'192.168.10.1',	'{\"parent_id\":\"0\",\"title\":\"Stories\",\"icon\":\"fa-american-sign-language-interpreting\",\"uri\":\"stories\",\"roles\":[\"1\",null],\"permission\":\"dashboard\",\"_token\":\"gbom0fmqofxODmmiGx3CjVYo0zghKEEjis8Y83pY\"}',	'2019-11-18 15:07:43',	'2019-11-18 15:07:43'),
(8,	1,	'admin/auth/menu',	'GET',	'192.168.10.1',	'[]',	'2019-11-18 15:07:43',	'2019-11-18 15:07:43'),
(9,	1,	'admin',	'GET',	'192.168.10.1',	'{\"_pjax\":\"#pjax-container\"}',	'2019-11-18 15:07:46',	'2019-11-18 15:07:46'),
(10,	1,	'admin',	'GET',	'192.168.10.1',	'[]',	'2019-11-18 15:07:48',	'2019-11-18 15:07:48'),
(11,	1,	'admin/pages',	'GET',	'192.168.10.1',	'[]',	'2019-11-18 15:08:34',	'2019-11-18 15:08:34'),
(12,	1,	'admin/pages',	'GET',	'192.168.10.1',	'[]',	'2019-11-18 15:09:18',	'2019-11-18 15:09:18'),
(13,	1,	'admin/pages',	'GET',	'192.168.10.1',	'[]',	'2019-11-18 15:09:20',	'2019-11-18 15:09:20'),
(14,	1,	'admin/pages',	'GET',	'192.168.10.1',	'[]',	'2019-11-18 15:09:49',	'2019-11-18 15:09:49'),
(15,	1,	'admin/pages',	'GET',	'192.168.10.1',	'[]',	'2019-11-18 15:10:03',	'2019-11-18 15:10:03'),
(16,	1,	'admin/pages',	'GET',	'192.168.10.1',	'[]',	'2019-11-18 15:10:05',	'2019-11-18 15:10:05');

DROP TABLE IF EXISTS `admin_permissions`;
CREATE TABLE `admin_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `http_path` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_permissions_name_unique` (`name`),
  UNIQUE KEY `admin_permissions_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admin_permissions` (`id`, `name`, `slug`, `http_method`, `http_path`, `created_at`, `updated_at`) VALUES
(1,	'All permission',	'*',	'',	'*',	NULL,	NULL),
(2,	'Dashboard',	'dashboard',	'GET',	'/',	NULL,	NULL),
(3,	'Login',	'auth.login',	'',	'/auth/login\r\n/auth/logout',	NULL,	NULL),
(4,	'User setting',	'auth.setting',	'GET,PUT',	'/auth/setting',	NULL,	NULL),
(5,	'Auth management',	'auth.management',	'',	'/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs',	NULL,	NULL);

DROP TABLE IF EXISTS `admin_roles`;
CREATE TABLE `admin_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_roles_name_unique` (`name`),
  UNIQUE KEY `admin_roles_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admin_roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1,	'Administrator',	'administrator',	'2019-11-18 15:00:37',	'2019-11-18 15:00:37');

DROP TABLE IF EXISTS `admin_role_menu`;
CREATE TABLE `admin_role_menu` (
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_menu_role_id_menu_id_index` (`role_id`,`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admin_role_menu` (`role_id`, `menu_id`, `created_at`, `updated_at`) VALUES
(1,	2,	NULL,	NULL),
(1,	8,	NULL,	NULL),
(1,	9,	NULL,	NULL);

DROP TABLE IF EXISTS `admin_role_permissions`;
CREATE TABLE `admin_role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_permissions_role_id_permission_id_index` (`role_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admin_role_permissions` (`role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1,	1,	NULL,	NULL);

DROP TABLE IF EXISTS `admin_role_users`;
CREATE TABLE `admin_role_users` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_users_role_id_user_id_index` (`role_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admin_role_users` (`role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1,	1,	NULL,	NULL);

DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_users_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admin_users` (`id`, `username`, `password`, `name`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'admin',	'$2y$10$442drpQnnu/fZPVltHZTBekB6ZihzH1pV752wvXXFGj6iNz6Sd/yK',	'Administrator',	NULL,	NULL,	'2019-11-18 15:00:36',	'2019-11-18 15:00:36');

DROP TABLE IF EXISTS `admin_user_permissions`;
CREATE TABLE `admin_user_permissions` (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_user_permissions_user_id_permission_id_index` (`user_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `characters`;
CREATE TABLE `characters` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `story_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `characters_user_id_foreign` (`user_id`),
  KEY `characters_story_id_foreign` (`story_id`),
  CONSTRAINT `characters_story_id_foreign` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`),
  CONSTRAINT `characters_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2016_01_04_173148_create_admin_tables',	1),
(2,	'2019_11_15_151227_create_users_table',	1),
(3,	'2019_11_15_151717_create_stories_table',	1),
(4,	'2019_11_15_151757_create_characters_table',	1),
(5,	'2019_11_15_152815_create_paragraphs_table',	1),
(6,	'2019_11_15_153732_create_paragraph_link_table',	1),
(7,	'2019_11_18_160748_create_pages',	1),
(8,	'2019_11_18_160947_create_pages_types',	1),
(9,	'2019_11_18_161430_create_prerequisites_types',	1),
(10,	'2019_11_18_161731_create_page_prerequisites',	1);

DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pages_types_id` int(10) unsigned NOT NULL,
  `story_id` int(10) unsigned NOT NULL,
  `prerequisites` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `pages_types`;
CREATE TABLE `pages_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `page_prerequisites`;
CREATE TABLE `page_prerequisites` (
  `page_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prerequisites_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `paragraphs`;
CREATE TABLE `paragraphs` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `story_id` bigint(20) unsigned NOT NULL,
  `is_first` tinyint(1) NOT NULL DEFAULT 0,
  `is_last` tinyint(1) NOT NULL DEFAULT 0,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `paragraphs_story_id_foreign` (`story_id`),
  CONSTRAINT `paragraphs_story_id_foreign` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `paragraph_link`;
CREATE TABLE `paragraph_link` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `paragraph_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paragraph_to` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `paragraph_link_paragraph_from_foreign` (`paragraph_from`),
  KEY `paragraph_link_paragraph_to_foreign` (`paragraph_to`),
  CONSTRAINT `paragraph_link_paragraph_from_foreign` FOREIGN KEY (`paragraph_from`) REFERENCES `paragraphs` (`id`),
  CONSTRAINT `paragraph_link_paragraph_to_foreign` FOREIGN KEY (`paragraph_to`) REFERENCES `paragraphs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `prerequisites_types`;
CREATE TABLE `prerequisites_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `stories`;
CREATE TABLE `stories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stories_user_id_foreign` (`user_id`),
  CONSTRAINT `stories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `stories` (`id`, `title`, `description`, `user_id`, `created_at`, `updated_at`) VALUES
(1,	'Ma guitare et moi',	'Comment je suis devenu un dieu de la guitare.',	1,	'2019-11-18 14:59:09',	'2019-11-18 14:59:09'),
(2,	'Les claquettes de nos jours',	'Mais pourquoi en suis-je venu à faire des claquettes ?<br>Récit d\'une vie.',	2,	'2019-11-18 14:59:09',	'2019-11-18 14:59:09');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fr_FR',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `first_name`, `last_name`, `password`, `locale`, `created_at`, `updated_at`) VALUES
(1,	'Marty',	'FRIEDMAN',	'86f7e437faa5a7fce15d1ddcb9eaeaea377667b8',	'fr_FR',	'2019-11-18 14:59:09',	'2019-11-18 14:59:09'),
(2,	'Fred',	'ASTAIR',	'86f7e437faa5a7fce15d1ddcb9eaeaea377667b8',	'fr_FR',	'2019-11-18 14:59:09',	'2019-11-18 14:59:09');

-- 2019-11-19 07:56:28
