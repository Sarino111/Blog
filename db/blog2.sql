-- Adminer 4.8.1 MySQL 5.7.24 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `blog2` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `blog2`;

DROP TABLE IF EXISTS `phpauth_attempts`;
CREATE TABLE `phpauth_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` char(39) NOT NULL,
  `expiredate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ip` (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `phpauth_config`;
CREATE TABLE `phpauth_config` (
  `setting` varchar(100) NOT NULL,
  `value` varchar(100) DEFAULT NULL,
  UNIQUE KEY `setting` (`setting`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `phpauth_config` (`setting`, `value`) VALUES
('allow_concurrent_sessions',	'0'),
('attack_mitigation_time',	'+30 minutes'),
('attempts_before_ban',	'30'),
('attempts_before_verify',	'5'),
('bcrypt_cost',	'10'),
('cookie_domain',	NULL),
('cookie_forget',	'+30 minutes'),
('cookie_http',	'1'),
('cookie_name',	'phpauth_session_cookie'),
('cookie_path',	'/'),
('cookie_remember',	'+1 month'),
('cookie_renew',	'+5 minutes'),
('cookie_samesite',	'Strict'),
('cookie_secure',	'1'),
('custom_datetime_format',	'Y-m-d H:i'),
('emailmessage_suppress_activation',	'0'),
('emailmessage_suppress_reset',	'0'),
('mail_charset',	'UTF-8'),
('password_min_score',	'3'),
('recaptcha_enabled',	'0'),
('recaptcha_secret_key',	''),
('recaptcha_site_key',	''),
('request_key_expiration',	'+10 minutes'),
('site_activation_page',	'activate'),
('site_activation_page_append_code',	'0'),
('site_email',	'no-reply@phpauth.cuonic.com'),
('site_key',	'fghuior.)/!/jdUkd8s2!7HVHG7777ghg'),
('site_language',	'en_GB'),
('site_name',	'PHPAuth'),
('site_password_reset_page',	'reset'),
('site_password_reset_page_append_code',	'0'),
('site_timezone',	'Europe/Paris'),
('site_url',	'https://github.com/PHPAuth/PHPAuth'),
('smtp',	'0'),
('smtp_auth',	'1'),
('smtp_debug',	'0'),
('smtp_host',	'smtp.example.com'),
('smtp_password',	'password'),
('smtp_port',	'25'),
('smtp_security',	NULL),
('smtp_username',	'email@example.com'),
('table_attempts',	'phpauth_attempts'),
('table_emails_banned',	'phpauth_emails_banned'),
('table_requests',	'phpauth_requests'),
('table_sessions',	'phpauth_sessions'),
('table_translations',	'phpauth_translation_dictionary'),
('table_users',	'phpauth_users'),
('translation_source',	'php'),
('verify_email_max_length',	'100'),
('verify_email_min_length',	'5'),
('verify_email_use_banlist',	'1'),
('verify_password_min_length',	'3');

DROP TABLE IF EXISTS `phpauth_emails_banned`;
CREATE TABLE `phpauth_emails_banned` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domain` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `phpauth_requests`;
CREATE TABLE `phpauth_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `token` char(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `expire` datetime NOT NULL,
  `type` enum('activation','reset') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `token` (`token`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `phpauth_sessions`;
CREATE TABLE `phpauth_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `hash` char(40) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `expiredate` datetime NOT NULL,
  `ip` varchar(39) NOT NULL,
  `device_id` varchar(36) DEFAULT NULL,
  `agent` varchar(200) NOT NULL,
  `cookie_crc` char(40) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `phpauth_sessions` (`id`, `uid`, `hash`, `expiredate`, `ip`, `device_id`, `agent`, `cookie_crc`) VALUES
(70,	2,	'19a4cdaf11ac582345a5190c39b9b53c21883561',	'2023-02-22 21:49:29',	'::1',	NULL,	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36',	'ded8c3eff8a5e61219fea0ee2dd2d93e2de4b20a');

DROP TABLE IF EXISTS `phpauth_users`;
CREATE TABLE `phpauth_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT '0',
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `phpauth_users` (`id`, `email`, `password`, `isactive`, `dt`) VALUES
(1,	'admin@admin.com',	'$2y$10$BFyXoo8LT6kDOvFtTsvAVOGrIwTsbCjqcCYNV6Uc3q6KKZ34cGcr.',	1,	'2023-06-07 13:42:46'),
(2,	'email@email.aa',	'$2y$10$iV3FAUyuaT0VcFs5k7947OS5UB7QSCOzBYPtZOneYynsHbBQLTXCS',	1,	'2023-01-18 18:30:32');

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(40) NOT NULL,
  `text` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `posts` (`id`, `user_id`, `title`, `text`, `image`, `slug`, `created_at`, `updated_at`) VALUES
(1,	2,	'I am new post',	'Gummi bears danish candy liquorice wafer toffee. Sweet roll caramels oat cake cheesecake tootsie roll muffin tiramisu fruitcake. Pie shortbread powder gummi bears muffin powder cheesecake chocolate cake. Gingerbread soufflé dessert cookie donut cheesecake marzipan ice cream cake.\r\n\r\nCarrot cake cupcake sesame snaps sweet roll chocolate cake cheesecake candy canes gummi bears. Ice cream chocolate bar cotton candy donut brownie biscuit. Jelly dragée biscuit dessert chocolate cake.',	'',	'Jujubes-cake',	'2022-12-18 18:01:22',	'2023-01-18 21:26:15'),
(2,	2,	'I am second post',	'Gummi bears danish candy liquorice wafer toffee. Sweet roll caramels oat cake cheesecake tootsie roll muffin tiramisu fruitcake. Pie shortbread powder gummi bears muffin powder cheesecake chocolate cake. Gingerbread soufflé dessert cookie donut cheesecake marzipan ice cream cake.\r\n\r\nCarrot cake cupcake sesame snaps sweet roll chocolate cake cheesecake candy canes gummi bears. Ice cream chocolate bar cotton candy donut brownie biscuit. Jelly dragée biscuit dessert chocolate cake.',	'',	'jgjgyj',	'2022-12-28 21:38:49',	'2023-06-07 15:48:37'),
(3,	1,	'Ja som tu novy',	'Carrot cake cupcake sesame snaps sweet roll chocolate cake cheesecake candy canes gummi bears. Ice cream chocolate bar cotton candy donut brownie biscuit. Jelly dragée biscuit dessert chocolate cake.',	'',	'ahoj-ja-som-tu-novy-add',	'2023-01-11 16:38:13',	'2023-06-07 15:49:12'),
(35,	1,	'This is post with image',	'This is a text with image',	'../_img/pexels-alexander-grey-1191710.jpg',	'this-is-post-with-image',	'2023-01-22 22:30:30',	'2023-06-07 15:49:50');

DELIMITER ;;

CREATE TRIGGER `posts_create` BEFORE INSERT ON `posts` FOR EACH ROW
SET NEW.created_at = NOW(),
NEW.updated_at = NOW();;

CREATE TRIGGER `posts_update` BEFORE UPDATE ON `posts` FOR EACH ROW
SET NEW.updated_at = NOW(),
NEW.created_at = OLD.created_at;;

DELIMITER ;

DROP TABLE IF EXISTS `post_tags`;
CREATE TABLE `post_tags` (
  `post_id` int(11) unsigned NOT NULL DEFAULT '0',
  `tag_id` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`tag_id`,`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `post_tags` (`post_id`, `tag_id`) VALUES
(1,	1),
(35,	2),
(1,	3);

DROP TABLE IF EXISTS `shirts`;
CREATE TABLE `shirts` (
  `name` varchar(40) DEFAULT NULL,
  `size` enum('x-small','small','medium','large','x-large') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tags` (`id`, `tag`) VALUES
(1,	'work'),
(2,	'nature'),
(3,	'it');

-- 2023-06-07 15:01:53
