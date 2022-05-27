-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2022 at 07:55 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `syrianmarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_super` tinyint(1) NOT NULL DEFAULT 0,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `username`, `email`, `password`, `is_super`, `image`, `phone`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', '$2y$10$KbPNjKMIYvyE4DwRnfhWPuHXHBu8tu3jM2rbeCQ6nNMIyax/Gtalm', 0, '5ff019935e1391609570707.jpg', '123456789', 'london', 'aSCDu7eqDwYcD4VNwaIDkooBeshvHTXjqQBdDToJM854yYqNyXDSNB0YhM0P', '2021-03-08 12:58:38', '2021-03-09 19:03:51');

-- --------------------------------------------------------

--
-- Table structure for table `api_providers`
--

CREATE TABLE `api_providers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `api_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `balance_coupons`
--

CREATE TABLE `balance_coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qr_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_sold` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `balance_coupons`
--

INSERT INTO `balance_coupons` (`id`, `qr_code`, `code`, `balance`, `status`, `created_at`, `updated_at`, `is_sold`) VALUES
(1, NULL, '6155e4', '50', 1, '2022-05-25 15:25:22', '2022-05-26 05:28:05', 1),
(2, NULL, 'a46aa703', '100', 1, '2022-05-25 15:28:02', '2022-05-26 05:23:30', 1),
(3, NULL, '4cdbbfcf', '453453', 1, '2022-05-25 15:28:06', '2022-05-25 15:28:06', 0),
(4, NULL, 'db784f90', '3453453', 1, '2022-05-25 15:28:10', '2022-05-25 15:28:10', 0),
(5, NULL, 'a26a8ee4', '4534', 1, '2022-05-25 15:31:15', '2022-05-25 15:31:15', 0),
(6, NULL, 'a796be16', '25', 0, '2022-05-25 15:32:03', '2022-05-26 05:34:48', 0),
(7, NULL, 'bdcf6c4e', '444', 1, '2022-05-26 04:08:00', '2022-05-26 04:08:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` enum('GAME','CODE','BALANCE','OTHER') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'GAME',
  `special_field` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_title`, `category_description`, `image`, `status`, `created_at`, `updated_at`, `type`, `special_field`) VALUES
(1, 'sdf', 'sdf', '6262d063225821650643043.png', '1', '2022-04-22 12:57:24', '2022-05-25 05:20:19', 'GAME', NULL),
(2, 'PUBG Mobile', 'PUBG', '6262d07573b781650643061.jpg', '1', '2022-04-22 12:57:41', '2022-05-26 06:44:10', 'GAME', NULL),
(3, 'PUBG Mobile', 'PUBG', '6262d07573b781650643061.jpg', '1', '2022-04-22 12:57:41', '2022-04-22 12:57:41', 'GAME', NULL),
(4, 'sdf', 'sdf', '6262d063225821650643043.png', '1', '2022-04-22 12:57:24', '2022-04-22 12:57:24', 'CODE', NULL),
(9, 'رصيد سيرياتل', 'شحن رصيد لسيرياتل', NULL, '1', '2022-05-23 08:25:51', '2022-05-25 05:20:35', 'BALANCE', 'رقم الهاتف');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `primaryColor` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Primary color',
  `subheading` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Subheading color',
  `bggrdleft` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Background left color',
  `bggrdright` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Background right color',
  `btngrdleft` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Button gradient left color',
  `bggrdleft2` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Button gradient 2 left color',
  `copyrights` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Copyrights Background color',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `primaryColor`, `subheading`, `bggrdleft`, `bggrdright`, `btngrdleft`, `bggrdleft2`, `copyrights`, `created_at`, `updated_at`) VALUES
(1, '#fd7e14', '#204dcc', '#7c35ff', '#5900ff', '#fd7e14', '#8340ff', '#1d43db', '2021-10-21 00:49:10', '2022-04-21 21:36:01');

-- --------------------------------------------------------

--
-- Table structure for table `configures`
--

CREATE TABLE `configures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_title` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_zone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_symbol` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fraction_number` int(11) DEFAULT NULL,
  `paginate` int(11) DEFAULT NULL,
  `email_verification` tinyint(1) NOT NULL DEFAULT 0,
  `email_notification` tinyint(1) NOT NULL DEFAULT 0,
  `sms_verification` tinyint(1) NOT NULL DEFAULT 0,
  `sms_notification` tinyint(1) NOT NULL DEFAULT 0,
  `sender_email` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_email_name` varchar(91) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_configuration` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `push_notification` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `configures`
--

INSERT INTO `configures` (`id`, `site_title`, `time_zone`, `currency`, `currency_symbol`, `theme`, `fraction_number`, `paginate`, `email_verification`, `email_notification`, `sms_verification`, `sms_notification`, `sender_email`, `sender_email_name`, `email_description`, `email_configuration`, `push_notification`, `created_at`, `updated_at`) VALUES
(1, 'Syria Market', 'UTC', 'USD', '$', 'minimal', 2, 20, 0, 0, 0, 0, 'support@mail.com', 'Bug Finder', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n<meta name=\"viewport\" content=\"width=device-width\">\r\n<style type=\"text/css\">\r\n    @media only screen and (min-width: 620px) {\r\n        * [lang=x-wrapper] h1 {\r\n        }\r\n\r\n        * [lang=x-wrapper] h1 {\r\n            font-size: 26px !important;\r\n            line-height: 34px !important\r\n        }\r\n\r\n        * [lang=x-wrapper] h2 {\r\n        }\r\n\r\n        * [lang=x-wrapper] h2 {\r\n            font-size: 20px !important;\r\n            line-height: 28px !important\r\n        }\r\n\r\n        * [lang=x-wrapper] h3 {\r\n        }\r\n\r\n        * [lang=x-layout__inner] p,\r\n        * [lang=x-layout__inner] ol,\r\n        * [lang=x-layout__inner] ul {\r\n        }\r\n\r\n        * div [lang=x-size-8] {\r\n            font-size: 8px !important;\r\n            line-height: 14px !important\r\n        }\r\n\r\n        * div [lang=x-size-9] {\r\n            font-size: 9px !important;\r\n            line-height: 16px !important\r\n        }\r\n\r\n        * div [lang=x-size-10] {\r\n            font-size: 10px !important;\r\n            line-height: 18px !important\r\n        }\r\n\r\n        * div [lang=x-size-11] {\r\n            font-size: 11px !important;\r\n            line-height: 19px !important\r\n        }\r\n\r\n        * div [lang=x-size-12] {\r\n            font-size: 12px !important;\r\n            line-height: 19px !important\r\n        }\r\n\r\n        * div [lang=x-size-13] {\r\n            font-size: 13px !important;\r\n            line-height: 21px !important\r\n        }\r\n\r\n        * div [lang=x-size-14] {\r\n            font-size: 14px !important;\r\n            line-height: 21px !important\r\n        }\r\n\r\n        * div [lang=x-size-15] {\r\n            font-size: 15px !important;\r\n            line-height: 23px !important\r\n        }\r\n\r\n        * div [lang=x-size-16] {\r\n            font-size: 16px !important;\r\n            line-height: 24px !important\r\n        }\r\n\r\n        * div [lang=x-size-17] {\r\n            font-size: 17px !important;\r\n            line-height: 26px !important\r\n        }\r\n\r\n        * div [lang=x-size-18] {\r\n            font-size: 18px !important;\r\n            line-height: 26px !important\r\n        }\r\n\r\n        * div [lang=x-size-18] {\r\n            font-size: 18px !important;\r\n            line-height: 26px !important\r\n        }\r\n\r\n        * div [lang=x-size-20] {\r\n            font-size: 20px !important;\r\n            line-height: 28px !important\r\n        }\r\n\r\n        * div [lang=x-size-22] {\r\n            font-size: 22px !important;\r\n            line-height: 31px !important\r\n        }\r\n\r\n        * div [lang=x-size-24] {\r\n            font-size: 24px !important;\r\n            line-height: 32px !important\r\n        }\r\n\r\n        * div [lang=x-size-26] {\r\n            font-size: 26px !important;\r\n            line-height: 34px !important\r\n        }\r\n\r\n        * div [lang=x-size-28] {\r\n            font-size: 28px !important;\r\n            line-height: 36px !important\r\n        }\r\n\r\n        * div [lang=x-size-30] {\r\n            font-size: 30px !important;\r\n            line-height: 38px !important\r\n        }\r\n\r\n        * div [lang=x-size-32] {\r\n            font-size: 32px !important;\r\n            line-height: 40px !important\r\n        }\r\n\r\n        * div [lang=x-size-34] {\r\n            font-size: 34px !important;\r\n            line-height: 43px !important\r\n        }\r\n\r\n        * div [lang=x-size-36] {\r\n            font-size: 36px !important;\r\n            line-height: 43px !important\r\n        }\r\n\r\n        * div [lang=x-size-40] {\r\n            font-size: 40px !important;\r\n            line-height: 47px !important\r\n        }\r\n\r\n        * div [lang=x-size-44] {\r\n            font-size: 44px !important;\r\n            line-height: 50px !important\r\n        }\r\n\r\n        * div [lang=x-size-48] {\r\n            font-size: 48px !important;\r\n            line-height: 54px !important\r\n        }\r\n\r\n        * div [lang=x-size-56] {\r\n            font-size: 56px !important;\r\n            line-height: 60px !important\r\n        }\r\n\r\n        * div [lang=x-size-64] {\r\n            font-size: 64px !important;\r\n            line-height: 63px !important\r\n        }\r\n    }\r\n</style>\r\n<style type=\"text/css\">\r\n    body {\r\n        margin: 0;\r\n        padding: 0;\r\n    }\r\n\r\n    table {\r\n        border-collapse: collapse;\r\n        table-layout: fixed;\r\n    }\r\n\r\n    * {\r\n        line-height: inherit;\r\n    }\r\n\r\n    [x-apple-data-detectors],\r\n    [href^=\"tel\"],\r\n    [href^=\"sms\"] {\r\n        color: inherit !important;\r\n        text-decoration: none !important;\r\n    }\r\n\r\n    .wrapper .footer__share-button a:hover,\r\n    .wrapper .footer__share-button a:focus {\r\n        color: #ffffff !important;\r\n    }\r\n\r\n    .btn a:hover,\r\n    .btn a:focus,\r\n    .footer__share-button a:hover,\r\n    .footer__share-button a:focus,\r\n    .email-footer__links a:hover,\r\n    .email-footer__links a:focus {\r\n        opacity: 0.8;\r\n    }\r\n\r\n    .preheader,\r\n    .header,\r\n    .layout,\r\n    .column {\r\n        transition: width 0.25s ease-in-out, max-width 0.25s ease-in-out;\r\n    }\r\n\r\n    .layout,\r\n    .header {\r\n        max-width: 400px !important;\r\n        -fallback-width: 95% !important;\r\n        width: calc(100% - 20px) !important;\r\n    }\r\n\r\n    div.preheader {\r\n        max-width: 360px !important;\r\n        -fallback-width: 90% !important;\r\n        width: calc(100% - 60px) !important;\r\n    }\r\n\r\n    .snippet,\r\n    .webversion {\r\n        Float: none !important;\r\n    }\r\n\r\n    .column {\r\n        max-width: 400px !important;\r\n        width: 100% !important;\r\n    }\r\n\r\n    .fixed-width.has-border {\r\n        max-width: 402px !important;\r\n    }\r\n\r\n    .fixed-width.has-border .layout__inner {\r\n        box-sizing: border-box;\r\n    }\r\n\r\n    .snippet,\r\n    .webversion {\r\n        width: 50% !important;\r\n    }\r\n\r\n    .ie .btn {\r\n        width: 100%;\r\n    }\r\n\r\n    .ie .column,\r\n    [owa] .column,\r\n    .ie .gutter,\r\n    [owa] .gutter {\r\n        display: table-cell;\r\n        float: none !important;\r\n        vertical-align: top;\r\n    }\r\n\r\n    .ie div.preheader,\r\n    [owa] div.preheader,\r\n    .ie .email-footer,\r\n    [owa] .email-footer {\r\n        max-width: 560px !important;\r\n        width: 560px !important;\r\n    }\r\n\r\n    .ie .snippet,\r\n    [owa] .snippet,\r\n    .ie .webversion,\r\n    [owa] .webversion {\r\n        width: 280px !important;\r\n    }\r\n\r\n    .ie .header,\r\n    [owa] .header,\r\n    .ie .layout,\r\n    [owa] .layout,\r\n    .ie .one-col .column,\r\n    [owa] .one-col .column {\r\n        max-width: 600px !important;\r\n        width: 600px !important;\r\n    }\r\n\r\n    .ie .fixed-width.has-border,\r\n    [owa] .fixed-width.has-border,\r\n    .ie .has-gutter.has-border,\r\n    [owa] .has-gutter.has-border {\r\n        max-width: 602px !important;\r\n        width: 602px !important;\r\n    }\r\n\r\n    .ie .two-col .column,\r\n    [owa] .two-col .column {\r\n        width: 300px !important;\r\n    }\r\n\r\n    .ie .three-col .column,\r\n    [owa] .three-col .column,\r\n    .ie .narrow,\r\n    [owa] .narrow {\r\n        width: 200px !important;\r\n    }\r\n\r\n    .ie .wide,\r\n    [owa] .wide {\r\n        width: 400px !important;\r\n    }\r\n\r\n    .ie .two-col.has-gutter .column,\r\n    [owa] .two-col.x_has-gutter .column {\r\n        width: 290px !important;\r\n    }\r\n\r\n    .ie .three-col.has-gutter .column,\r\n    [owa] .three-col.x_has-gutter .column,\r\n    .ie .has-gutter .narrow,\r\n    [owa] .has-gutter .narrow {\r\n        width: 188px !important;\r\n    }\r\n\r\n    .ie .has-gutter .wide,\r\n    [owa] .has-gutter .wide {\r\n        width: 394px !important;\r\n    }\r\n\r\n    .ie .two-col.has-gutter.has-border .column,\r\n    [owa] .two-col.x_has-gutter.x_has-border .column {\r\n        width: 292px !important;\r\n    }\r\n\r\n    .ie .three-col.has-gutter.has-border .column,\r\n    [owa] .three-col.x_has-gutter.x_has-border .column,\r\n    .ie .has-gutter.has-border .narrow,\r\n    [owa] .has-gutter.x_has-border .narrow {\r\n        width: 190px !important;\r\n    }\r\n\r\n    .ie .has-gutter.has-border .wide,\r\n    [owa] .has-gutter.x_has-border .wide {\r\n        width: 396px !important;\r\n    }\r\n\r\n    .ie .fixed-width .layout__inner {\r\n        border-left: 0 none white !important;\r\n        border-right: 0 none white !important;\r\n    }\r\n\r\n    .ie .layout__edges {\r\n        display: none;\r\n    }\r\n\r\n    .mso .layout__edges {\r\n        font-size: 0;\r\n    }\r\n\r\n    .layout-fixed-width,\r\n    .mso .layout-full-width {\r\n        background-color: #ffffff;\r\n    }\r\n\r\n    @media only screen and (min-width: 620px) {\r\n\r\n        .column,\r\n        .gutter {\r\n            display: table-cell;\r\n            Float: none !important;\r\n            vertical-align: top;\r\n        }\r\n\r\n        div.preheader,\r\n        .email-footer {\r\n            max-width: 560px !important;\r\n            width: 560px !important;\r\n        }\r\n\r\n        .snippet,\r\n        .webversion {\r\n            width: 280px !important;\r\n        }\r\n\r\n        .header,\r\n        .layout,\r\n        .one-col .column {\r\n            max-width: 600px !important;\r\n            width: 600px !important;\r\n        }\r\n\r\n        .fixed-width.has-border,\r\n        .fixed-width.ecxhas-border,\r\n        .has-gutter.has-border,\r\n        .has-gutter.ecxhas-border {\r\n            max-width: 602px !important;\r\n            width: 602px !important;\r\n        }\r\n\r\n        .two-col .column {\r\n            width: 300px !important;\r\n        }\r\n\r\n        .three-col .column,\r\n        .column.narrow {\r\n            width: 200px !important;\r\n        }\r\n\r\n        .column.wide {\r\n            width: 400px !important;\r\n        }\r\n\r\n        .two-col.has-gutter .column,\r\n        .two-col.ecxhas-gutter .column {\r\n            width: 290px !important;\r\n        }\r\n\r\n        .three-col.has-gutter .column,\r\n        .three-col.ecxhas-gutter .column,\r\n        .has-gutter .narrow {\r\n            width: 188px !important;\r\n        }\r\n\r\n        .has-gutter .wide {\r\n            width: 394px !important;\r\n        }\r\n\r\n        .two-col.has-gutter.has-border .column,\r\n        .two-col.ecxhas-gutter.ecxhas-border .column {\r\n            width: 292px !important;\r\n        }\r\n\r\n        .three-col.has-gutter.has-border .column,\r\n        .three-col.ecxhas-gutter.ecxhas-border .column,\r\n        .has-gutter.has-border .narrow,\r\n        .has-gutter.ecxhas-border .narrow {\r\n            width: 190px !important;\r\n        }\r\n\r\n        .has-gutter.has-border .wide,\r\n        .has-gutter.ecxhas-border .wide {\r\n            width: 396px !important;\r\n        }\r\n    }\r\n\r\n    @media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min--moz-device-pixel-ratio: 2), only screen and (-o-min-device-pixel-ratio: 2/1), only screen and (min-device-pixel-ratio: 2), only screen and (min-resolution: 192dpi), only screen and (min-resolution: 2dppx) {\r\n        .fblike {\r\n            background-image: url(https://i3.createsend1.com/static/eb/customise/13-the-blueprint-3/images/fblike@2x.png) !important;\r\n        }\r\n\r\n        .tweet {\r\n            background-image: url(https://i4.createsend1.com/static/eb/customise/13-the-blueprint-3/images/tweet@2x.png) !important;\r\n        }\r\n\r\n        .linkedinshare {\r\n            background-image: url(https://i6.createsend1.com/static/eb/customise/13-the-blueprint-3/images/lishare@2x.png) !important;\r\n        }\r\n\r\n        .forwardtoafriend {\r\n            background-image: url(https://i5.createsend1.com/static/eb/customise/13-the-blueprint-3/images/forward@2x.png) !important;\r\n        }\r\n    }\r\n\r\n    @media (max-width: 321px) {\r\n        .fixed-width.has-border .layout__inner {\r\n            border-width: 1px 0 !important;\r\n        }\r\n\r\n        .layout,\r\n        .column {\r\n            min-width: 320px !important;\r\n            width: 320px !important;\r\n        }\r\n\r\n        .border {\r\n            display: none;\r\n        }\r\n    }\r\n\r\n    .mso div {\r\n        border: 0 none white !important;\r\n    }\r\n\r\n    .mso .w560 .divider {\r\n        margin-left: 260px !important;\r\n        margin-right: 260px !important;\r\n    }\r\n\r\n    .mso .w360 .divider {\r\n        margin-left: 160px !important;\r\n        margin-right: 160px !important;\r\n    }\r\n\r\n    .mso .w260 .divider {\r\n        margin-left: 110px !important;\r\n        margin-right: 110px !important;\r\n    }\r\n\r\n    .mso .w160 .divider {\r\n        margin-left: 60px !important;\r\n        margin-right: 60px !important;\r\n    }\r\n\r\n    .mso .w354 .divider {\r\n        margin-left: 157px !important;\r\n        margin-right: 157px !important;\r\n    }\r\n\r\n    .mso .w250 .divider {\r\n        margin-left: 105px !important;\r\n        margin-right: 105px !important;\r\n    }\r\n\r\n    .mso .w148 .divider {\r\n        margin-left: 54px !important;\r\n        margin-right: 54px !important;\r\n    }\r\n\r\n    .mso .font-avenir,\r\n    .mso .font-cabin,\r\n    .mso .font-open-sans,\r\n    .mso .font-ubuntu {\r\n        font-family: sans-serif !important;\r\n    }\r\n\r\n    .mso .font-bitter,\r\n    .mso .font-merriweather,\r\n    .mso .font-pt-serif {\r\n        font-family: Georgia, serif !important;\r\n    }\r\n\r\n    .mso .font-lato,\r\n    .mso .font-roboto {\r\n        font-family: Tahoma, sans-serif !important;\r\n    }\r\n\r\n    .mso .font-pt-sans {\r\n        font-family: \"Trebuchet MS\", sans-serif !important;\r\n    }\r\n\r\n    .mso .footer__share-button p {\r\n        margin: 0;\r\n    }\r\n\r\n    @media only screen and (min-width: 620px) {\r\n        .wrapper .size-8 {\r\n            font-size: 8px !important;\r\n            line-height: 14px !important;\r\n        }\r\n\r\n        .wrapper .size-9 {\r\n            font-size: 9px !important;\r\n            line-height: 16px !important;\r\n        }\r\n\r\n        .wrapper .size-10 {\r\n            font-size: 10px !important;\r\n            line-height: 18px !important;\r\n        }\r\n\r\n        .wrapper .size-11 {\r\n            font-size: 11px !important;\r\n            line-height: 19px !important;\r\n        }\r\n\r\n        .wrapper .size-12 {\r\n            font-size: 12px !important;\r\n            line-height: 19px !important;\r\n        }\r\n\r\n        .wrapper .size-13 {\r\n            font-size: 13px !important;\r\n            line-height: 21px !important;\r\n        }\r\n\r\n        .wrapper .size-14 {\r\n            font-size: 14px !important;\r\n            line-height: 21px !important;\r\n        }\r\n\r\n        .wrapper .size-15 {\r\n            font-size: 15px !important;\r\n            line-height: 23px !important;\r\n        }\r\n\r\n        .wrapper .size-16 {\r\n            font-size: 16px !important;\r\n            line-height: 24px !important;\r\n        }\r\n\r\n        .wrapper .size-17 {\r\n            font-size: 17px !important;\r\n            line-height: 26px !important;\r\n        }\r\n\r\n        .wrapper .size-18 {\r\n            font-size: 18px !important;\r\n            line-height: 26px !important;\r\n        }\r\n\r\n        .wrapper .size-20 {\r\n            font-size: 20px !important;\r\n            line-height: 28px !important;\r\n        }\r\n\r\n        .wrapper .size-22 {\r\n            font-size: 22px !important;\r\n            line-height: 31px !important;\r\n        }\r\n\r\n        .wrapper .size-24 {\r\n            font-size: 24px !important;\r\n            line-height: 32px !important;\r\n        }\r\n\r\n        .wrapper .size-26 {\r\n            font-size: 26px !important;\r\n            line-height: 34px !important;\r\n        }\r\n\r\n        .wrapper .size-28 {\r\n            font-size: 28px !important;\r\n            line-height: 36px !important;\r\n        }\r\n\r\n        .wrapper .size-30 {\r\n            font-size: 30px !important;\r\n            line-height: 38px !important;\r\n        }\r\n\r\n        .wrapper .size-32 {\r\n            font-size: 32px !important;\r\n            line-height: 40px !important;\r\n        }\r\n\r\n        .wrapper .size-34 {\r\n            font-size: 34px !important;\r\n            line-height: 43px !important;\r\n        }\r\n\r\n        .wrapper .size-36 {\r\n            font-size: 36px !important;\r\n            line-height: 43px !important;\r\n        }\r\n\r\n        .wrapper .size-40 {\r\n            font-size: 40px !important;\r\n            line-height: 47px !important;\r\n        }\r\n\r\n        .wrapper .size-44 {\r\n            font-size: 44px !important;\r\n            line-height: 50px !important;\r\n        }\r\n\r\n        .wrapper .size-48 {\r\n            font-size: 48px !important;\r\n            line-height: 54px !important;\r\n        }\r\n\r\n        .wrapper .size-56 {\r\n            font-size: 56px !important;\r\n            line-height: 60px !important;\r\n        }\r\n\r\n        .wrapper .size-64 {\r\n            font-size: 64px !important;\r\n            line-height: 63px !important;\r\n        }\r\n    }\r\n\r\n    .mso .size-8,\r\n    .ie .size-8 {\r\n        font-size: 8px !important;\r\n        line-height: 14px !important;\r\n    }\r\n\r\n    .mso .size-9,\r\n    .ie .size-9 {\r\n        font-size: 9px !important;\r\n        line-height: 16px !important;\r\n    }\r\n\r\n    .mso .size-10,\r\n    .ie .size-10 {\r\n        font-size: 10px !important;\r\n        line-height: 18px !important;\r\n    }\r\n\r\n    .mso .size-11,\r\n    .ie .size-11 {\r\n        font-size: 11px !important;\r\n        line-height: 19px !important;\r\n    }\r\n\r\n    .mso .size-12,\r\n    .ie .size-12 {\r\n        font-size: 12px !important;\r\n        line-height: 19px !important;\r\n    }\r\n\r\n    .mso .size-13,\r\n    .ie .size-13 {\r\n        font-size: 13px !important;\r\n        line-height: 21px !important;\r\n    }\r\n\r\n    .mso .size-14,\r\n    .ie .size-14 {\r\n        font-size: 14px !important;\r\n        line-height: 21px !important;\r\n    }\r\n\r\n    .mso .size-15,\r\n    .ie .size-15 {\r\n        font-size: 15px !important;\r\n        line-height: 23px !important;\r\n    }\r\n\r\n    .mso .size-16,\r\n    .ie .size-16 {\r\n        font-size: 16px !important;\r\n        line-height: 24px !important;\r\n    }\r\n\r\n    .mso .size-17,\r\n    .ie .size-17 {\r\n        font-size: 17px !important;\r\n        line-height: 26px !important;\r\n    }\r\n\r\n    .mso .size-18,\r\n    .ie .size-18 {\r\n        font-size: 18px !important;\r\n        line-height: 26px !important;\r\n    }\r\n\r\n    .mso .size-20,\r\n    .ie .size-20 {\r\n        font-size: 20px !important;\r\n        line-height: 28px !important;\r\n    }\r\n\r\n    .mso .size-22,\r\n    .ie .size-22 {\r\n        font-size: 22px !important;\r\n        line-height: 31px !important;\r\n    }\r\n\r\n    .mso .size-24,\r\n    .ie .size-24 {\r\n        font-size: 24px !important;\r\n        line-height: 32px !important;\r\n    }\r\n\r\n    .mso .size-26,\r\n    .ie .size-26 {\r\n        font-size: 26px !important;\r\n        line-height: 34px !important;\r\n    }\r\n\r\n    .mso .size-28,\r\n    .ie .size-28 {\r\n        font-size: 28px !important;\r\n        line-height: 36px !important;\r\n    }\r\n\r\n    .mso .size-30,\r\n    .ie .size-30 {\r\n        font-size: 30px !important;\r\n        line-height: 38px !important;\r\n    }\r\n\r\n    .mso .size-32,\r\n    .ie .size-32 {\r\n        font-size: 32px !important;\r\n        line-height: 40px !important;\r\n    }\r\n\r\n    .mso .size-34,\r\n    .ie .size-34 {\r\n        font-size: 34px !important;\r\n        line-height: 43px !important;\r\n    }\r\n\r\n    .mso .size-36,\r\n    .ie .size-36 {\r\n        font-size: 36px !important;\r\n        line-height: 43px !important;\r\n    }\r\n\r\n    .mso .size-40,\r\n    .ie .size-40 {\r\n        font-size: 40px !important;\r\n        line-height: 47px !important;\r\n    }\r\n\r\n    .mso .size-44,\r\n    .ie .size-44 {\r\n        font-size: 44px !important;\r\n        line-height: 50px !important;\r\n    }\r\n\r\n    .mso .size-48,\r\n    .ie .size-48 {\r\n        font-size: 48px !important;\r\n        line-height: 54px !important;\r\n    }\r\n\r\n    .mso .size-56,\r\n    .ie .size-56 {\r\n        font-size: 56px !important;\r\n        line-height: 60px !important;\r\n    }\r\n\r\n    .mso .size-64,\r\n    .ie .size-64 {\r\n        font-size: 64px !important;\r\n        line-height: 63px !important;\r\n    }\r\n\r\n    .footer__share-button p {\r\n        margin: 0;\r\n    }\r\n</style>\r\n\r\n<title></title>\r\n<!--[if !mso]><!-->\r\n<style type=\"text/css\">\r\n    @import url(https://fonts.googleapis.com/css?family=Bitter:400,700,400italic|Cabin:400,700,400italic,700italic|Open+Sans:400italic,700italic,700,400);\r\n</style>\r\n<link href=\"https://fonts.googleapis.com/css?family=Bitter:400,700,400italic|Cabin:400,700,400italic,700italic|Open+Sans:400italic,700italic,700,400\" rel=\"stylesheet\" type=\"text/css\">\r\n<!--<![endif]-->\r\n<style type=\"text/css\">\r\n    body {\r\n        background-color: #f5f7fa\r\n    }\r\n\r\n    .mso h1 {\r\n    }\r\n\r\n    .mso h1 {\r\n        font-family: sans-serif !important\r\n    }\r\n\r\n    .mso h2 {\r\n    }\r\n\r\n    .mso h3 {\r\n    }\r\n\r\n    .mso .column,\r\n    .mso .column__background td {\r\n    }\r\n\r\n    .mso .column,\r\n    .mso .column__background td {\r\n        font-family: sans-serif !important\r\n    }\r\n\r\n    .mso .btn a {\r\n    }\r\n\r\n    .mso .btn a {\r\n        font-family: sans-serif !important\r\n    }\r\n\r\n    .mso .webversion,\r\n    .mso .snippet,\r\n    .mso .layout-email-footer td,\r\n    .mso .footer__share-button p {\r\n    }\r\n\r\n    .mso .webversion,\r\n    .mso .snippet,\r\n    .mso .layout-email-footer td,\r\n    .mso .footer__share-button p {\r\n        font-family: sans-serif !important\r\n    }\r\n\r\n    .mso .logo {\r\n    }\r\n\r\n    .mso .logo {\r\n        font-family: Tahoma, sans-serif !important\r\n    }\r\n\r\n    .logo a:hover,\r\n    .logo a:focus {\r\n        color: #859bb1 !important\r\n    }\r\n\r\n    .mso .layout-has-border {\r\n        border-top: 1px solid #b1c1d8;\r\n        border-bottom: 1px solid #b1c1d8\r\n    }\r\n\r\n    .mso .layout-has-bottom-border {\r\n        border-bottom: 1px solid #b1c1d8\r\n    }\r\n\r\n    .mso .border,\r\n    .ie .border {\r\n        background-color: #b1c1d8\r\n    }\r\n\r\n    @media only screen and (min-width: 620px) {\r\n        .wrapper h1 {\r\n        }\r\n\r\n        .wrapper h1 {\r\n            font-size: 26px !important;\r\n            line-height: 34px !important\r\n        }\r\n\r\n        .wrapper h2 {\r\n        }\r\n\r\n        .wrapper h2 {\r\n            font-size: 20px !important;\r\n            line-height: 28px !important\r\n        }\r\n\r\n        .wrapper h3 {\r\n        }\r\n\r\n        .column p,\r\n        .column ol,\r\n        .column ul {\r\n        }\r\n    }\r\n\r\n    .mso h1,\r\n    .ie h1 {\r\n    }\r\n\r\n    .mso h1,\r\n    .ie h1 {\r\n        font-size: 26px !important;\r\n        line-height: 34px !important\r\n    }\r\n\r\n    .mso h2,\r\n    .ie h2 {\r\n    }\r\n\r\n    .mso h2,\r\n    .ie h2 {\r\n        font-size: 20px !important;\r\n        line-height: 28px !important\r\n    }\r\n\r\n    .mso h3,\r\n    .ie h3 {\r\n    }\r\n\r\n    .mso .layout__inner p,\r\n    .ie .layout__inner p,\r\n    .mso .layout__inner ol,\r\n    .ie .layout__inner ol,\r\n    .mso .layout__inner ul,\r\n    .ie .layout__inner ul {\r\n    }\r\n</style>\r\n<meta name=\"robots\" content=\"noindex,nofollow\">\r\n\r\n<meta property=\"og:title\" content=\"Just One More Step\">\r\n\r\n<link href=\"https://css.createsend1.com/css/social.min.css?h=0ED47CE120160920\" media=\"screen,projection\" rel=\"stylesheet\" type=\"text/css\">\r\n\r\n\r\n<div class=\"wrapper\" style=\"min-width: 320px;background-color: #f5f7fa;\" lang=\"x-wrapper\">\r\n    <div class=\"preheader\" style=\"margin: 0 auto;max-width: 560px;min-width: 280px; width: 280px;\">\r\n        <div style=\"border-collapse: collapse;display: table;width: 100%;\">\r\n            <div class=\"snippet\" style=\"display: table-cell;Float: left;font-size: 12px;line-height: 19px;max-width: 280px;min-width: 140px; width: 140px;padding: 10px 0 5px 0;color: #b9b9b9;\">\r\n            </div>\r\n            <div class=\"webversion\" style=\"display: table-cell;Float: left;font-size: 12px;line-height: 19px;max-width: 280px;min-width: 139px; width: 139px;padding: 10px 0 5px 0;text-align: right;color: #b9b9b9;\">\r\n            </div>\r\n        </div>\r\n\r\n        <div class=\"layout one-col fixed-width\" style=\"margin: 0 auto;max-width: 600px;min-width: 320px; width: 320px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;\">\r\n            <div class=\"layout__inner\" style=\"border-collapse: collapse;display: table;width: 100%;background-color: #c4e5dc;\" lang=\"x-layout__inner\">\r\n                <div class=\"column\" style=\"text-align: left;color: #60666d;font-size: 14px;line-height: 21px;max-width:600px;min-width:320px;\">\r\n                    <div style=\"margin-left: 20px;margin-right: 20px;margin-top: 24px;margin-bottom: 24px;\">\r\n                        <h1 style=\"margin-top: 0;margin-bottom: 0;font-style: normal;font-weight: normal;color: #44a8c7;font-size: 36px;line-height: 43px;font-family: bitter,georgia,serif;text-align: center;\">\r\n                            </h1><h1 style=\"margin-top: 0;margin-bottom: 0;font-style: normal;font-weight: normal;color: #44a8c7;font-size: 36px;line-height: 43px;font-family: bitter,georgia,serif;text-align: center;\"></h1><p style=\"margin-top: 0px; margin-bottom: 0px; font-style: normal; font-weight: normal; color: rgb(68, 168, 199); font-size: 36px; line-height: 43px; font-family: bitter, georgia, serif; text-align: center;\"><img src=\"data:image/png;base64,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\" alt=\"\" style=\"width: 25%;\"> <br></p></div></div></div><div class=\"layout one-col fixed-width\" style=\"margin: 0 auto;max-width: 600px;min-width: 320px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;\"><div class=\"layout__inner\" style=\"border-collapse: collapse;display: table;width: 100%;background-color: #ffffff;\" lang=\"x-layout__inner\"><div class=\"column\" style=\"text-align: left;color: #60666d;background: #edf1eb;font-size: 14px;line-height: 21px;max-width:600px;min-width:320px;width:320px;\"><div style=\"margin-left: 20px;margin-right: 20px;margin-top: 24px;\">\r\n                        </div>\r\n\r\n                        <div style=\"margin-left: 20px;margin-right: 20px;\">\r\n\r\n                            <p style=\"margin-top: 16px;margin-bottom: 0;\"><strong>Hello [[name]],</strong></p>\r\n                            <p style=\"margin-top: 20px;margin-bottom: 20px;\"><strong>[[message]]</strong></p>\r\n                            <p style=\"margin-top: 20px;margin-bottom: 20px;\"><br></p>\r\n                        </div>\r\n\r\n                    </div>\r\n                </div>\r\n            </div>\r\n\r\n            <div class=\"layout__inner\" style=\"border-collapse: collapse;display: table;width: 100%;background-color: #2c3262; margin-bottom: 20px\" lang=\"x-layout__inner\">\r\n                <div class=\"column\" style=\"text-align: left;color: #60666d;font-size: 14px;line-height: 21px;max-width:600px;min-width:320px;\">\r\n                    <div style=\"margin-top: 5px;margin-bottom: 5px;\">\r\n                        <p style=\"margin-top: 0;margin-bottom: 0;font-style: normal;font-weight: normal;color: #ffffff;font-size: 16px;line-height: 35px;font-family: bitter,georgia,serif;text-align: center;\">\r\n                            2021 ©  All Right Reserved\r\n                        </p>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n\r\n        </div>\r\n\r\n\r\n        <div style=\"border-collapse: collapse;display: table;width: 100%;\">\r\n            <div class=\"snippet\" style=\"display: table-cell;Float: left;font-size: 12px;line-height: 19px;max-width: 280px;min-width: 140px; width: 140px;padding: 10px 0 5px 0;color: #b9b9b9;\">\r\n            </div>\r\n            <div class=\"webversion\" style=\"display: table-cell;Float: left;font-size: 12px;line-height: 19px;max-width: 280px;min-width: 139px; width: 139px;padding: 10px 0 5px 0;text-align: right;color: #b9b9b9;\">\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>', '{\"name\":\"smtp\",\"smtp_host\":\"smtp.mailtrap.io\",\"smtp_port\":\"2525\",\"smtp_encryption\":\"tls\",\"smtp_username\":\"28f259aad049a7\",\"smtp_password\":\"5c4ce9ee0f5d9c\"}', 0, NULL, '2022-04-24 19:55:25');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `name`, `created_at`, `updated_at`) VALUES
(7, 'counter', '2021-01-31 23:45:30', '2021-01-31 23:45:30'),
(8, 'counter', '2021-01-31 23:45:42', '2021-01-31 23:45:42'),
(9, 'counter', '2021-01-31 23:45:48', '2021-01-31 23:45:48'),
(10, 'counter', '2021-01-31 23:46:48', '2021-01-31 23:46:48'),
(12, 'feature', '2021-02-01 02:08:00', '2021-02-01 02:08:00'),
(13, 'feature', '2021-02-01 02:08:29', '2021-02-01 02:08:29'),
(14, 'feature', '2021-02-01 02:08:58', '2021-02-01 02:08:58'),
(15, 'service', '2021-02-01 02:11:04', '2021-02-01 02:11:04'),
(16, 'service', '2021-02-01 02:11:31', '2021-02-01 02:11:31'),
(17, 'service', '2021-02-01 02:11:44', '2021-02-01 02:11:44'),
(18, 'testimonial', '2021-02-01 02:21:07', '2021-02-01 02:21:07'),
(19, 'testimonial', '2021-02-01 02:29:12', '2021-02-01 02:29:12'),
(20, 'testimonial', '2021-02-01 02:29:43', '2021-02-01 02:29:43'),
(21, 'testimonial', '2021-02-01 02:30:43', '2021-02-01 02:30:43'),
(22, 'testimonial', '2021-02-01 02:31:28', '2021-02-01 02:31:28'),
(23, 'faq', '2021-02-01 03:31:45', '2021-02-01 03:31:45'),
(24, 'faq', '2021-02-01 03:32:00', '2021-02-01 03:32:00'),
(25, 'faq', '2021-02-01 03:32:14', '2021-02-01 03:32:14'),
(26, 'faq', '2021-02-01 03:32:43', '2021-02-01 03:32:43'),
(27, 'faq', '2021-02-01 03:33:24', '2021-02-01 03:33:24'),
(28, 'faq', '2021-02-01 03:33:58', '2021-02-01 03:33:58'),
(29, 'faq', '2021-02-01 03:34:25', '2021-02-01 03:34:25'),
(30, 'faq', '2021-02-01 03:34:41', '2021-02-01 03:34:41'),
(31, 'faq', '2021-02-01 03:35:36', '2021-02-01 03:35:36'),
(33, 'support', '2021-02-01 03:56:24', '2021-02-01 03:56:24'),
(34, 'support', '2021-02-01 04:00:38', '2021-02-01 04:00:38'),
(35, 'support', '2021-02-01 04:00:53', '2021-02-01 04:00:53'),
(36, 'support', '2021-02-01 04:01:25', '2021-02-01 04:01:25'),
(37, 'how-it-work', '2021-02-02 00:06:49', '2021-02-02 00:06:49'),
(38, 'how-it-work', '2021-02-02 00:07:47', '2021-02-02 00:07:47'),
(39, 'how-it-work', '2021-02-02 00:10:43', '2021-02-02 00:10:43'),
(40, 'how-it-work', '2021-02-02 00:11:49', '2021-02-02 00:11:49'),
(56, 'social', '2021-02-03 00:39:22', '2021-02-03 00:39:22'),
(58, 'social', '2021-02-03 00:44:24', '2021-02-03 00:44:24'),
(59, 'social', '2021-02-03 00:45:04', '2021-02-03 00:45:04'),
(60, 'social', '2021-02-03 00:46:09', '2021-02-03 00:46:09'),
(61, 'blog', '2021-02-03 06:53:50', '2021-02-03 06:53:50'),
(62, 'blog', '2021-02-03 06:56:25', '2021-02-03 06:56:25'),
(63, 'blog', '2021-02-03 06:57:34', '2021-02-03 06:57:34');

-- --------------------------------------------------------

--
-- Table structure for table `content_details`
--

CREATE TABLE `content_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content_id` bigint(20) UNSIGNED DEFAULT NULL,
  `language_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `content_details`
--

INSERT INTO `content_details` (`id`, `content_id`, `language_id`, `description`, `created_at`, `updated_at`) VALUES
(13, 7, 1, '{\"title\":\"ACTIVE CLIENTS\",\"number_of_data\":\"320\"}', '2021-01-31 23:45:30', '2021-01-31 23:45:30'),
(14, 8, 1, '{\"title\":\"PROJECTS DONE\",\"number_of_data\":\"850\"}', '2021-01-31 23:45:42', '2021-01-31 23:45:42'),
(15, 9, 1, '{\"title\":\"TEAM ADVISORS\",\"number_of_data\":\"28\"}', '2021-01-31 23:45:48', '2021-01-31 23:45:48'),
(16, 10, 1, '{\"title\":\"GLORIOUS YEARS\",\"number_of_data\":\"8\"}', '2021-01-31 23:46:48', '2021-01-31 23:46:48'),
(17, 7, 5, '{\"title\":\"CLIENTES ACTIVOS\",\"number_of_data\":\"320\"}', '2021-01-31 23:48:44', '2021-01-31 23:48:44'),
(18, 8, 5, '{\"title\":\"PROYECTOS REALIZADOS\",\"number_of_data\":\"850\"}', '2021-01-31 23:50:25', '2021-01-31 23:50:25'),
(19, 9, 5, '{\"title\":\"ASESORAS DE EQUIPO\",\"number_of_data\":\"28\"}', '2021-01-31 23:50:42', '2021-01-31 23:50:42'),
(20, 10, 5, '{\"title\":\"A\\u00d1OS GLORIOSOS\",\"number_of_data\":\"8\"}', '2021-01-31 23:51:05', '2021-01-31 23:51:05'),
(22, 12, 1, '{\"title\":\"Link Building\",\"short_description\":\"We are providing an Opportunity to make handsome amount of money by reselling our social media services on your own social media marketing or by selling them on Various Marketplace.\"}', '2021-02-01 02:08:00', '2021-10-20 11:52:53'),
(23, 13, 1, '{\"title\":\"Customer Support\",\"short_description\":\"SMM Matrix comes with a dedicated team to drive a world-class customer\\u2019s support. we will Add Daily new service,offer and improving support system for fast support\"}', '2021-02-01 02:08:29', '2021-10-20 11:54:08'),
(24, 14, 1, '{\"title\":\"Automatic Payments\",\"short_description\":\"<span>Most SMM Panels make you input payment information every time you make an order. Set up an automatic payment method with\\u00a0 SMM Matrix.<\\/span>\"}', '2021-02-01 02:08:58', '2021-10-20 11:54:41'),
(25, 12, 5, '{\"title\":\"Construcci\\u00f3n de enlaces\",\"short_description\":\"<p>Construya su enlace con todos los servicios SMM en Binary SMM.<br \\/><\\/p>\"}', '2021-02-01 02:09:31', '2021-03-09 11:15:15'),
(26, 13, 5, '{\"title\":\"Construcci\\u00f3n de enlaces\",\"short_description\":\"Binary SMM viene con un equipo dedicado para impulsar un soporte al cliente de clase mundial.\"}', '2021-02-01 02:09:48', '2021-03-09 11:18:37'),
(27, 14, 5, '{\"title\":\"Pagos autom\\u00e1ticos\",\"short_description\":\"La mayor\\u00eda de los paneles SMM le obligan a ingresar informaci\\u00f3n de pago cada vez que realiza un pedido. Configure un m\\u00e9todo de pago autom\\u00e1tico con Binary SMM.\"}', '2021-02-01 02:10:14', '2021-03-09 11:25:21'),
(28, 15, 1, '{\"title\":\"Best SMM Panel\",\"short_description\":\"Bug Finder provides the highest quality of promotions. We are one of the best SMM reseller panels including some special services out there online.\",\"button_name\":\"Read More\"}', '2021-02-01 02:11:04', '2021-10-20 12:00:49'),
(29, 16, 1, '{\"title\":\"Website Growth\",\"short_description\":\"<span>SMM Matrix is a modern and efficient wholesale panel. We try to provide you instant promotions on different social media platforms.<\\/span>\",\"button_name\":\"Read More\"}', '2021-02-01 02:11:31', '2021-10-20 12:01:55'),
(30, 17, 1, '{\"title\":\"Smm Ranking\",\"short_description\":\"<span>We provide guaranteed service on our website SMM server. All the service will be no drop service.<\\/span>\",\"button_name\":\"Read More\"}', '2021-02-01 02:11:44', '2021-03-09 14:40:43'),
(31, 15, 5, '{\"title\":\"An\\u00e1lisis de datos\",\"short_description\":\"Las operaciones binarias ofrecen promociones de la m\\u00e1s alta calidad. Somos uno de los mejores paneles de revendedores de SMM, incluidos algunos servicios especiales que existen en l\\u00ednea.\",\"button_name\":\"Lee mas\"}', '2021-02-01 02:12:43', '2021-03-09 11:33:16'),
(32, 17, 5, '{\"title\":\"Clasificaci\\u00f3n SMM\",\"short_description\":\"Brindamos un servicio garantizado en nuestro servidor SMM del sitio web. Todo el servicio ser\\u00e1 sin drop service.\",\"button_name\":\"Lee mas\"}', '2021-02-01 02:14:03', '2021-03-09 14:40:55'),
(33, 18, 1, '{\"name\":\"Maria Jacket\",\"designation\":\"Web Developer\",\"description\":\"<span>I like this panel, I actually face a problem with my first try but support was there, and they help me to fix that problem and then I tried YouTube views and I guess it\'s one of the best.<\\/span>\"}', '2021-02-01 02:21:07', '2021-03-09 15:08:40'),
(34, 19, 1, '{\"name\":\"Alica Fox\",\"designation\":\"Team Hunter\",\"description\":\"<span>I ordered Facebook page likes &amp; IG followers, I received good quality followers highly recommended, and I\'ll definitely order again Thank you.<\\/span>\"}', '2021-02-01 02:29:12', '2021-03-09 15:07:56'),
(35, 20, 1, '{\"name\":\"Donald Trump\",\"designation\":\"CEO\",\"description\":\"Well, I was testing the Instagram followers service and works really well! Takes about 5-10 minutes to start and complete the followers super fast! So, I like the service.\"}', '2021-02-01 02:29:43', '2021-03-09 15:05:22'),
(36, 21, 1, '{\"name\":\"Tom Moddy\",\"designation\":\"Business Executive\",\"description\":\"<span>I have been using Binary SMM for a week now and it is easily the best panel I have used. Great prices, easy to use and always updated. Great job!<\\/span>\"}', '2021-02-01 02:30:43', '2021-03-09 15:10:19'),
(37, 22, 1, '{\"name\":\"Oskaa\",\"designation\":\"Head of Ideas\",\"description\":\"<span>Used this service for a week and made about 15 orders of different services. Liked the quality. There was a pause in supplying likes, but eventually everything was delivered at full.<\\/span>\"}', '2021-02-01 02:31:28', '2021-03-09 15:12:10'),
(38, 18, 5, '{\"name\":\"Chaqueta Maria\",\"designation\":\"Desarrollador web\",\"description\":\"Me gusta este panel, en realidad tengo un problema con mi primer intento, pero el soporte estaba ah\\u00ed, y me ayudaron a solucionar ese problema y luego prob\\u00e9 las vistas de YouTube y supongo que es uno de los mejores.\"}', '2021-02-01 02:32:56', '2021-03-09 15:08:53'),
(39, 19, 5, '{\"name\":\"Alica Fox\",\"designation\":\"Cazador de equipo\",\"description\":\"Ped\\u00ed me gusta a la p\\u00e1gina de Facebook y seguidores de IG, recib\\u00ed seguidores de buena calidad altamente recomendados y definitivamente volver\\u00e9 a ordenar Gracias\"}', '2021-02-01 02:33:31', '2021-03-09 15:08:07'),
(40, 20, 5, '{\"name\":\"Donald Trump\",\"designation\":\"CEO\",\"description\":\"Bueno, estaba probando el servicio de seguidores de Instagram y \\u00a1funciona muy bien! \\u00a1Se necesitan entre 5 y 10 minutos para comenzar y completar los seguidores s\\u00faper r\\u00e1pido! Entonces, me gusta el servicio.\"}', '2021-02-01 02:34:14', '2021-03-09 15:05:34'),
(41, 21, 5, '{\"name\":\"Tom Moddy\",\"designation\":\"Ejecutiva de negocios\",\"description\":\"He estado usando SmmTube durante una semana y es f\\u00e1cilmente el mejor panel que he usado. Excelentes precios, f\\u00e1ciles de usar y siempre actualizados. \\u00a1Gran trabajo!\"}', '2021-02-01 02:34:39', '2021-03-09 15:10:46'),
(42, 22, 5, '{\"name\":\"Oskaa\",\"designation\":\"Jefa de ideas\",\"description\":\"Us\\u00e9 este servicio durante una semana y realic\\u00e9 alrededor de 15 pedidos de diferentes servicios. Me gust\\u00f3 la calidad. Hubo una pausa en el suministro de me gusta, pero finalmente todo se entreg\\u00f3 en su totalidad.\"}', '2021-02-01 02:35:06', '2021-03-09 15:12:44'),
(43, 23, 1, '{\"title\":\"What is Partial status?\",\"description\":\"<p><span>Partial Status is when we partially refund the remains of an order. Sometimes for some reasons we are unable to deliver a full order, so we refund you the remaining undelivered amount. Example: You bought an order with quantity 10 000 and charges 10$, let\'s say we delivered 9 000 and the remaining 1 000 we couldn\'t deliver, then we will \\\"Partial\\\" the order and refund you the remaining 1 000 (1$ in this example).<\\/span><br \\/><\\/p>\"}', '2021-02-01 03:31:45', '2021-02-04 06:51:25'),
(44, 24, 1, '{\"title\":\"What is Drip Feed?\",\"description\":\"<p><span>Drip Feed is a service that we are offering so you would be able to put the same order multiple times automatically. Example: let\'s say you want to get 1000 likes on your Instagram Post but you want to get 100 likes each 30 minutes, you will put Link: Your Post Link Quantity: 100 Runs: 10 (as you want to run this order 10 times, if you want to get 2000 likes, you will run it 20 times, etc\\u2026) Interval: 30 (because you want to get 100 likes on your post each 30 minutes, if you want each hour, you will put 60 because the time is in minutes) P.S: Never order more quantity than the maximum which is written on the service name (Quantity x Runs), Example if the service\'s max is 4000, you don\\u2019t put Quantity: 500 and Run: 10, because total quantity will be 500x10 = 5000 which is bigger than the service max (4000). Also never put the Interval below the actual start time (some services need 60 minutes to start, don\\u2019t put Interval less than the service start time or it will cause a fail in your order).<\\/span><br \\/><\\/p>\"}', '2021-02-01 03:32:00', '2021-02-04 07:08:35'),
(45, 25, 1, '{\"title\":\"How do I use mass order?\",\"description\":\"You put the service ID followed by | followed by the link followed by | followed by quantity on each line To get the service ID of a service please check here: https:\\/\\/justanotherpanel.com\\/services Let\\u2019s say you want to use the Mass Order to add Instagram Followers to your 3 accounts: abcd, asdf, qwer From the Services List @ https:\\/\\/justanotherpanel.com\\/services, the service ID for this service \\u201cInstagram Followers [15K] [REAL] \\u26a1\\ufe0f\\ud83d\\udca7\\u2b50\\u201d is 102 Let\\u2019s say you want to add 1000 followers for each account, the output will be like this: ID|Link|Quantity or in this example: 102|abcd|1000 102|asdf|1000 102|qwer|1000\"}', '2021-02-01 03:32:14', '2021-02-04 07:08:56'),
(46, 26, 1, '{\"title\":\"I want a panel like yours \\/ I want to resell your services how?\",\"description\":\"<p><span>To get a panel like ours, please check jap to rent a panel, and then you can connect to us via API easily!<\\/span><br \\/><\\/p>\"}', '2021-02-01 03:32:43', '2021-02-04 07:10:11'),
(47, 27, 1, '{\"title\":\"Can I get a discount?\",\"description\":\"<p><span>No, we don\\u2019t offer any discount, the price of our services is fixed!<\\/span><br \\/><\\/p>\"}', '2021-02-01 03:33:24', '2021-03-09 15:43:05'),
(48, 28, 1, '{\"title\":\"How to get youtube comment link?\",\"description\":\"<p><span>Find the timestamp that is located next to your username above your comment (for example: \\\"3 days ago\\\") and hover over it then right click and \\\"Copy Link Address\\\". The link will be something like this: https:\\/\\/www.youtube.com\\/watch?v=12345&amp;lc=a1b21etc instead of just https:\\/\\/www.youtube.com\\/watch?v=12345 To be sure that you got the correct link, paste it in your browser\'s address bar and you will see that the comment is now the first one below the video and it says \\\"Highlighted comment\\\".<\\/span><br \\/><\\/p>\"}', '2021-02-01 03:33:58', '2021-02-04 07:10:38'),
(49, 29, 1, '{\"title\":\"Which youtube view service can be used with monetizable video?\",\"description\":\"The one that has \\\"Monetized\\\" in its service\' name.\"}', '2021-02-01 03:34:25', '2021-02-04 07:11:07'),
(50, 30, 1, '{\"title\":\"What is \'Instagram Saves\', and what does it do?\",\"description\":\"Instagram Saves is when a user saves a post to his history on Instagram (by pressing the save button near the like button). A lot of saves for a post increase its impression.\"}', '2021-02-01 03:34:41', '2021-02-04 07:21:28'),
(51, 31, 1, '{\"title\":\"The link must be added before the user goes live or after?\",\"description\":\"After he goes live, or just 5 second before he goes!\"}', '2021-02-01 03:35:36', '2021-02-04 07:22:22'),
(53, 23, 5, '{\"title\":\"\\u00bfQu\\u00e9 es el estado parcial?\",\"description\":\"<p>El estado parcial es cuando reembolsamos parcialmente los restos de un pedido. A veces, por algunas razones, no podemos entregar un pedido completo, por lo que le reembolsaremos el monto restante no entregado. Ejemplo: Usted compr\\u00f3 un pedido con una cantidad de 10000 y cobra 10 $, digamos que entregamos 9000 y no pudimos entregar los 1000 restantes, luego \\\"Parcialmente\\\" el pedido y le reembolsaremos los 1000 restantes (1 $ en este ejemplo).<br \\/><\\/p>\"}', '2021-02-01 03:38:00', '2021-02-04 06:52:58'),
(54, 24, 5, '{\"title\":\"\\u00bfQu\\u00e9 es la alimentaci\\u00f3n por goteo?\",\"description\":\"<p>Drip Feed es un servicio que ofrecemos para que pueda realizar el mismo pedido varias veces de forma autom\\u00e1tica. Ejemplo: digamos que desea obtener 1000 me gusta en su publicaci\\u00f3n de Instagram pero desea obtener 100 me gusta cada 30 minutos, pondr\\u00e1 Enlace: Su publicaci\\u00f3n Cantidad de enlaces: 100 Ejecuciones: 10 (ya que desea ejecutar este pedido 10 veces, si quieres conseguir 2000 me gusta, lo ejecutar\\u00e1s 20 veces, etc\\u2026) Intervalo: 30 (porque quieres conseguir 100 me gusta en tu publicaci\\u00f3n cada 30 minutos, si quieres cada hora, pondr\\u00e1s 60 porque el tiempo es en minutos) PD: Nunca pida m\\u00e1s cantidad que el m\\u00e1ximo que est\\u00e1 escrito en el nombre del servicio (Cantidad x Ejecuciones), por ejemplo, si el m\\u00e1ximo del servicio es 4000, no ponga Cantidad: 500 y Ejecutar: 10, porque la cantidad total ser 500x10 = 5000, que es m\\u00e1s grande que el servicio m\\u00e1ximo (4000). Adem\\u00e1s, nunca coloque el intervalo por debajo de la hora de inicio real (algunos servicios necesitan 60 minutos para comenzar, no coloque el intervalo por debajo de la hora de inicio del servicio o provocar\\u00e1 una falla en su pedido).<br \\/><\\/p>\"}', '2021-02-01 03:38:57', '2021-03-09 15:36:42'),
(55, 25, 5, '{\"title\":\"\\u00bfC\\u00f3mo uso el pedido masivo?\",\"description\":\"<p>Pones el ID de servicio seguido de | seguido del enlace seguido de | seguido de la cantidad en cada l\\u00ednea Para obtener el ID de servicio de un servicio, marque aqu\\u00ed: https:\\/\\/justanotherpanel.com\\/services Supongamos que desea utilizar el pedido masivo para agregar seguidores de Instagram a sus 3 cuentas: abcd, asdf, qwer De la Lista de servicios @ https:\\/\\/justanotherpanel.com\\/services, el ID de servicio para este servicio \\u201cSeguidores de Instagram [15K] [REAL] \\u26a1\\ufe0f\\ud83d\\udca7\\u2b50\\u201d es 102 Digamos que desea agregar 1000 seguidores para cada cuenta, el resultado ser\\u00e1 as\\u00ed: ID | Enlace | Cantidad o en este ejemplo: 102 | abcd | 1000102 | asdf | 1000102 | qwer | 1000<br \\/><\\/p>\"}', '2021-02-01 03:39:32', '2021-03-09 15:37:04'),
(56, 26, 5, '{\"title\":\"Quiero un panel como el tuyo \\/ quiero vender tus servicios como?\",\"description\":\"<p><span>To get a panel like ours, please check jap to rent a panel, and then you can connect to us via API easily!<\\/span><br \\/><\\/p>\"}', '2021-02-01 03:40:05', '2021-02-04 07:10:16'),
(57, 27, 5, '{\"title\":\"\\u00bfPuedo obtener un descuento?\",\"description\":\"<p>No, no ofrecemos ning\\u00fan descuento, \\u00a1el precio de nuestros servicios es fijo!<br \\/><\\/p>\"}', '2021-02-01 03:40:27', '2021-03-09 15:44:10'),
(58, 28, 5, '{\"title\":\"\\u00bfC\\u00f3mo obtener el enlace de comentario de youtube?\",\"description\":\"<p>Busque la marca de tiempo que se encuentra junto a su nombre de usuario sobre su comentario (por ejemplo: \\\"hace 3 d\\u00edas\\\") y coloque el cursor sobre ella, luego haga clic con el bot\\u00f3n derecho y \\\"Copiar direcci\\u00f3n del enlace\\\". El enlace ser\\u00e1 algo como esto: https:\\/\\/www.youtube.com\\/watch?v=12345&amp;lc=a1b21etc en lugar de solo https:\\/\\/www.youtube.com\\/watch?v=12345 Para asegurarse de que obtuvo el enlace correcto, p\\u00e9guelo en la barra de direcciones de su navegador y ver\\u00e1 que el comentario es ahora el primero debajo del video y dice \\\"Comentario resaltado\\\".<br \\/><\\/p>\"}', '2021-02-01 03:40:56', '2021-03-09 15:38:30'),
(59, 29, 5, '{\"title\":\"\\u00bfQu\\u00e9 servicio de visualizaci\\u00f3n de youtube se puede usar con videos monetizables?\",\"description\":\"<p>El que tiene \\\"Monetizado\\\" en el nombre de su servicio.<br \\/><\\/p>\"}', '2021-02-01 03:41:29', '2021-03-09 15:39:17'),
(60, 30, 5, '{\"title\":\"\\u00bfQu\\u00e9 es \'Instagram Saves\' y qu\\u00e9 hace?\",\"description\":\"<p>Instagram Saves es cuando un usuario guarda una publicaci\\u00f3n en su historial en Instagram (presionando el bot\\u00f3n Guardar cerca del bot\\u00f3n Me gusta). Una gran cantidad de guardados para una publicaci\\u00f3n aumentan su impresi\\u00f3n.<br \\/><\\/p>\"}', '2021-02-01 03:41:53', '2021-03-09 15:39:40'),
(61, 31, 5, '{\"title\":\"El enlace debe agregarse antes de que el usuario se active o despu\\u00e9s.\",\"description\":\"<p>\\u00a1Despu\\u00e9s de que se active, o solo 5 segundos antes de que se active!<br \\/><\\/p>\"}', '2021-02-01 03:42:20', '2021-03-09 15:40:50'),
(63, 33, 1, '{\"title\":\"Terms &amp; Conditions\",\"description\":\"<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.<\\/p><p><br \\/><\\/p><p> The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\\/p>\"}', '2021-02-01 03:56:24', '2021-02-01 03:56:24'),
(64, 34, 1, '{\"title\":\"Privacy Policy\",\"description\":\"<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.<\\/p><p><br \\/><\\/p><p> The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\\/p>\"}', '2021-02-01 04:00:38', '2021-02-01 04:00:38'),
(65, 35, 1, '{\"title\":\"Refund Policy\",\"description\":\"<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.<\\/p><p><br \\/><\\/p><p> The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\\/p>\"}', '2021-02-01 04:00:53', '2021-02-01 04:00:53'),
(66, 36, 1, '{\"title\":\"General\",\"description\":\"By placing an order with SMM\\u00a0 Panel , you automatically accept all the below listed terms of service weather you read them or not.\\r\\n\\r\\nWe reserve the right to change these terms of service without notice. You are expected to read all terms of service before placing any order to insure you are up to date with any changes or any future changes.\\r\\n\\r\\nYou will only use the SMM Panel website in a manner which follows all agreements made with Instagram\\/Facebook\\/Twitter\\/Youtube\\/Other social media site on their individual Terms of Service page. SMM Panel rates are subject to change at any time without notice. The payment\\/refund policy stays in effect in the case of rate changes. SMM\\u00a0 Panel does not guarantee a delivery time for any services. We offer our best estimation for when the order will be delivered. This is only an estimation and SMM\\u00a0 Panel will not refund orders that are processing if you feel they are taking too long. SMM\\u00a0 Panel tries hard to deliver exactly what is expected from us by our re-sellers. In this case, we reserve the right to change a service type if we deem it necessary to complete an order.\"}', '2021-02-01 04:01:25', '2021-02-01 04:14:32'),
(67, 33, 5, '{\"title\":\"T\\u00e9rminos y condiciones\",\"description\":\"Es un hecho establecido desde hace mucho tiempo que un lector se distraer\\u00e1 con el contenido legible de una p\\u00e1gina cuando mire su dise\\u00f1o. El objetivo de usar Lorem Ipsum es que tiene una distribuci\\u00f3n de letras m\\u00e1s o menos normal, en lugar de usar \'Contenido aqu\\u00ed, contenido aqu\\u00ed\', lo que hace que parezca un ingl\\u00e9s legible. Muchos paquetes de autoedici\\u00f3n y editores de p\\u00e1ginas web ahora usan Lorem Ipsum como su modelo de texto predeterminado, y una b\\u00fasqueda de \'lorem ipsum\' revelar\\u00e1 muchos sitios web a\\u00fan en su infancia. Varias versiones han evolucionado a lo largo de los a\\u00f1os, a veces por accidente, a veces a prop\\u00f3sito (humor inyectado y cosas por el estilo). Es un hecho establecido desde hace mucho tiempo que un lector se distraer\\u00e1 con el contenido legible de una p\\u00e1gina cuando mire su dise\\u00f1o.\\r\\n\\r\\n\\r\\n\\r\\nEl objetivo de usar Lorem Ipsum es que tiene una distribuci\\u00f3n de letras m\\u00e1s o menos normal, en lugar de usar \'Contenido aqu\\u00ed, contenido aqu\\u00ed\', lo que hace que parezca un ingl\\u00e9s legible. Muchos paquetes de autoedici\\u00f3n y editores de p\\u00e1ginas web ahora usan Lorem Ipsum como su texto modelo predeterminado, y una b\\u00fasqueda de \'lorem ipsum\' revelar\\u00e1 muchos sitios web que a\\u00fan est\\u00e1n en su infancia. Varias versiones han evolucionado a lo largo de los a\\u00f1os, a veces por accidente, a veces a prop\\u00f3sito (humor inyectado y cosas por el estilo). Es un hecho establecido desde hace mucho tiempo que un lector se distraer\\u00e1 con el contenido legible de una p\\u00e1gina cuando observe su dise\\u00f1o. El objetivo de usar Lorem Ipsum es que tiene una distribuci\\u00f3n de letras m\\u00e1s o menos normal, en lugar de usar \'Contenido aqu\\u00ed, contenido aqu\\u00ed\', lo que hace que parezca un ingl\\u00e9s legible. Muchos paquetes de autoedici\\u00f3n y editores de p\\u00e1ginas web ahora usan Lorem Ipsum como su modelo de texto predeterminado, y una b\\u00fasqueda de \'lorem ipsum\' revelar\\u00e1 muchos sitios web a\\u00fan en su infancia. Varias versiones han evolucionado a lo largo de los a\\u00f1os, a veces por accidente, a veces a prop\\u00f3sito (humor inyectado y cosas por el estilo).\"}', '2021-02-01 04:12:12', '2021-02-01 04:12:12'),
(68, 34, 5, '{\"title\":\"Pol\\u00edtica de privacidad\",\"description\":\"Es un hecho establecido desde hace mucho tiempo que un lector se distraer\\u00e1 con el contenido legible de una p\\u00e1gina cuando mire su dise\\u00f1o. El punto de usar Lorem Ipsum es que tiene una distribuci\\u00f3n de letras m\\u00e1s o menos normal, en lugar de usar \'Contenido aqu\\u00ed, contenido aqu\\u00ed\', lo que hace que parezca un ingl\\u00e9s legible. Muchos paquetes de autoedici\\u00f3n y editores de p\\u00e1ginas web ahora usan Lorem Ipsum como su modelo de texto predeterminado, y una b\\u00fasqueda de \'lorem ipsum\' revelar\\u00e1 muchos sitios web a\\u00fan en su infancia. Varias versiones han evolucionado a lo largo de los a\\u00f1os, a veces por accidente, a veces a prop\\u00f3sito (humor inyectado y cosas por el estilo). Es un hecho establecido desde hace mucho tiempo que un lector se distraer\\u00e1 con el contenido legible de una p\\u00e1gina cuando mire su dise\\u00f1o.\"}', '2021-02-01 04:13:10', '2021-02-01 04:13:10'),
(69, 35, 5, '{\"title\":\"Politica de reembolso\",\"description\":\"Es un hecho establecido desde hace mucho tiempo que un lector se distraer\\u00e1 con el contenido legible de una p\\u00e1gina cuando mire su dise\\u00f1o. El punto de usar Lorem Ipsum es que tiene una distribuci\\u00f3n de letras m\\u00e1s o menos normal, en lugar de usar \'Contenido aqu\\u00ed, contenido aqu\\u00ed\', lo que hace que parezca un ingl\\u00e9s legible. Muchos paquetes de autoedici\\u00f3n y editores de p\\u00e1ginas web ahora usan Lorem Ipsum como su modelo de texto predeterminado, y una b\\u00fasqueda de \'lorem ipsum\' revelar\\u00e1 muchos sitios web a\\u00fan en su infancia. Varias versiones han evolucionado a lo largo de los a\\u00f1os, a veces por accidente, a veces a prop\\u00f3sito (humor inyectado y cosas por el estilo). Es un hecho establecido desde hace mucho tiempo que un lector se distraer\\u00e1 con el contenido legible de una p\\u00e1gina cuando mire su dise\\u00f1o.\"}', '2021-02-01 04:13:36', '2021-02-01 04:13:36'),
(70, 36, 5, '{\"title\":\"General\",\"description\":\"Al realizar un pedido con SMM &amp; nbsp; Panel, usted acepta autom\\u00e1ticamente todos los t\\u00e9rminos de servicio enumerados a continuaci\\u00f3n, ya sea que los lea o no.\\r\\n\\r\\nNos reservamos el derecho de cambiar estos t\\u00e9rminos de servicio sin previo aviso. Se espera que lea todos los t\\u00e9rminos de servicio antes de realizar cualquier pedido para asegurarse de que est\\u00e1 al d\\u00eda con los cambios o cambios futuros.\\r\\n\\r\\nSolo utilizar\\u00e1 el sitio web de SMM Panel de una manera que siga todos los acuerdos realizados con Instagram \\/ Facebook \\/ Twitter \\/ Youtube \\/ otro sitio de redes sociales en su p\\u00e1gina individual de T\\u00e9rminos de servicio. Las tarifas de SMM Panel est\\u00e1n sujetas a cambios en cualquier momento sin previo aviso. La pol\\u00edtica de pago \\/ reembolso permanece vigente en caso de cambios de tarifas. SMM &amp; nbsp; Panel no garantiza el tiempo de entrega de ning\\u00fan servicio. Ofrecemos nuestra mejor estimaci\\u00f3n de cu\\u00e1ndo se entregar\\u00e1 el pedido. Esto es solo una estimaci\\u00f3n y SMM &amp; nbsp; El panel no reembolsar\\u00e1 los pedidos que se est\\u00e9n procesando si cree que est\\u00e1n demorando demasiado. SMM &amp; nbsp; Panel se esfuerza por ofrecer exactamente lo que nuestros revendedores esperan de nosotros. En este caso, nos reservamos el derecho de cambiar un tipo de servicio si lo consideramos necesario para completar un pedido.\"}', '2021-02-01 04:15:02', '2021-02-01 04:15:02'),
(71, 37, 1, '{\"title\":\"Register &amp; Log in\",\"short_description\":\"<p>Creating an account is the first step. then you need to log in<\\/p>\"}', '2021-02-02 00:06:49', '2021-02-02 00:51:56'),
(72, 38, 1, '{\"title\":\"Add Fund\",\"short_description\":\"<p>Next, pick a payment method and add funds to your account<\\/p>\"}', '2021-02-02 00:07:47', '2021-02-02 00:22:08'),
(73, 39, 1, '{\"title\":\"Select a service\",\"short_description\":\"<p>Select the services you want and get ready to receive more publicity<\\/p>\"}', '2021-02-02 00:10:43', '2021-02-02 00:57:17'),
(74, 40, 1, '{\"title\":\"Enjoy Super Results\",\"short_description\":\"<p>You can enjoy incredible results when your order is complete<\\/p>\"}', '2021-02-02 00:11:49', '2021-02-02 00:58:40'),
(81, 37, 5, '{\"title\":\"Registro de inicio de sesi\\u00f3n\",\"short_description\":\"<p>Crear una cuenta es el primer paso. entonces necesitas iniciar sesi\\u00f3n<br \\/><\\/p>\"}', '2021-02-02 00:54:43', '2021-02-02 00:54:43'),
(82, 38, 5, '{\"title\":\"Agregar fondo\",\"short_description\":\"<p>A continuaci\\u00f3n, elija un m\\u00e9todo de pago y agregue fondos a su cuenta<br \\/><\\/p>\"}', '2021-02-02 00:55:57', '2021-02-02 00:55:57'),
(83, 39, 5, '{\"title\":\"Seleccione un servicio\",\"short_description\":\"<p>Seleccione los servicios que desee y prep\\u00e1rese para recibir m\\u00e1s publicidad<br \\/><\\/p>\"}', '2021-02-02 00:57:50', '2021-02-02 00:57:50'),
(84, 40, 5, '{\"title\":\"Disfruta de superresultados\",\"short_description\":\"<p>Puede disfrutar de resultados incre\\u00edbles cuando su pedido est\\u00e9 completo<br \\/><\\/p>\"}', '2021-02-02 00:59:01', '2021-02-02 00:59:01'),
(95, 56, 1, '{\"name\":\"Facebook\"}', '2021-02-03 00:39:22', '2021-02-03 00:42:19'),
(96, 56, 5, '{\"name\":\"Facebook\"}', '2021-02-03 00:42:28', '2021-02-03 00:42:28'),
(99, 58, 1, '{\"name\":\"Twitter\"}', '2021-02-03 00:44:24', '2021-02-03 00:44:24'),
(100, 58, 5, '{\"name\":\"Gorjeo\"}', '2021-02-03 00:44:30', '2021-02-03 00:44:30'),
(101, 59, 1, '{\"name\":\"Linkedin\"}', '2021-02-03 00:45:04', '2021-02-03 00:45:04'),
(102, 59, 5, '{\"name\":\"linkedin\"}', '2021-02-03 00:45:24', '2021-02-03 00:45:24'),
(103, 60, 1, '{\"name\":\"Instagram\"}', '2021-02-03 00:46:09', '2021-02-03 00:46:09'),
(104, 60, 5, '{\"name\":\"Instagram\"}', '2021-02-03 00:46:28', '2021-02-03 00:46:28'),
(105, 61, 1, '{\"title\":\"The Real Perks of SMM Panel\",\"description\":\"<h4><span><span>Social Media Marketing has been one of the most pivotal elements for businesses 3.0. If you have already dispatched your creative team for improving your business through social media, you will know what the challenges are. With such limited resources and time at your part, it is sensible to consider the\\u00a0<a href=\\\"https:\\/\\/binaryoperations.website\\/binary-smm\\\">smm panel<\\/a>\\u00a0as the real solution for Social Media Marketing. The smm panel India will help you to automate all of the processes.<\\/span><\\/span><\\/h4><h4><span><span>Chances are you might have used the specific social media marketing services before. It is easy to manage your ads campaigns because the actions are hands-off experience. All in all, Indian smm panel is a great solution to reach your target audience without wasting your time.<\\/span><\\/span><\\/h4><h4><span><\\/span><\\/h4><h4><span><span>You can actually leverage the results by using the best smm panel India. Through these reseller platforms, you will not only get the social media services you usually use, but also the possibility to resell the services. Here are the top perks that you can consider.<\\/span><\\/span><\\/h4><h4><span><b>All-in-one traffic solution<\\/b><\\/span><\\/h4><h4><span><\\/span><\\/h4><h4><span><span>Most of the SMM panels that you choose offer you the services of various social media platforms. As we know, the top social media networks are YouTube, Instagram, Facebook, Instagram, and so on. You will be able to attain the services revolving the variables such as comments, share, likes, views, subscription, and other social signals.<\\/span><\\/span><\\/h4><h4><span><\\/span><\\/h4><h4><span><span>The good thing here is that you can get them all through one cheap smm panel platform. The best smm panel staffs usually build the profiles manually so that all the traffic will come from organic sources. As we know, Google does not like bot traffic. But by using this SMM panel service, you must not worry about that.<\\/span><\\/span><\\/h4>\"}', '2021-02-03 06:53:50', '2021-03-09 15:20:53'),
(106, 61, 5, '{\"title\":\"Las ventajas reales del panel SMM\",\"description\":\"<p>El Social Media Marketing ha sido uno de los elementos m\\u00e1s fundamentales para las empresas 3.0. Si ya ha enviado a su equipo creativo para mejorar su negocio a trav\\u00e9s de las redes sociales, sabr\\u00e1 cu\\u00e1les son los desaf\\u00edos. Con recursos y tiempo tan limitados de su parte, es sensato considerar el panel smm como la soluci\\u00f3n real para Social Media Marketing. El panel smm India le ayudar\\u00e1 a automatizar todos los procesos.<\\/p><p>Lo m\\u00e1s probable es que haya utilizado los servicios espec\\u00edficos de marketing en redes sociales antes. Es f\\u00e1cil administrar sus campa\\u00f1as publicitarias porque las acciones son una experiencia de no intervenci\\u00f3n. Con todo, el panel Indian smm es una gran soluci\\u00f3n para llegar a su p\\u00fablico objetivo sin perder el tiempo.<\\/p><p>De hecho, puede aprovechar los resultados utilizando el mejor panel de smm de la India. A trav\\u00e9s de estas plataformas de revendedor, no solo obtendr\\u00e1 los servicios de redes sociales que usa habitualmente, sino tambi\\u00e9n la posibilidad de revender los servicios. Estos son los principales beneficios que puede considerar.<\\/p><p><b>Soluci\\u00f3n de tr\\u00e1fico todo en uno<\\/b><\\/p><p>La mayor\\u00eda de los paneles SMM que elija le ofrecen los servicios de varias plataformas de redes sociales. Como sabemos, las principales redes sociales son YouTube, Instagram, Facebook, Instagram, etc. Podr\\u00e1s acceder a los servicios girando las variables como comentarios, compartir, me gusta, visualizaciones, suscripci\\u00f3n y otras se\\u00f1ales sociales.<\\/p><p>Lo bueno aqu\\u00ed es que puede obtenerlos todos a trav\\u00e9s de una plataforma de panel smm barata. El mejor personal del panel smm generalmente construye los perfiles manualmente para que todo el tr\\u00e1fico provenga de fuentes org\\u00e1nicas. Como sabemos, a Google no le gusta el tr\\u00e1fico de bots. Pero al utilizar este servicio de panel SMM, no debe preocuparse por eso.<\\/p>\"}', '2021-02-03 06:55:14', '2021-03-09 15:21:20'),
(107, 62, 1, '{\"title\":\"Social Media Marketing Platforms to boost your sales\",\"description\":\"<h6>Support team\\u00a0posted 8 months ago<\\/h6><p style=\\\"color:rgb(51,51,51);font-family:poppins, sans-serif;font-size:14px;\\\"><\\/p><p style=\\\"color:rgb(51,51,51);font-family:poppins, sans-serif;font-size:14px;text-align:justify;\\\"><span>Social media marketing platforms are really very important and they play vital role in boosting your brand awareness, sales and conversion. Growth of a business all depends on the marketing efforts. Gone are the days when traditional marketing was enough. Nowadays, digital marketing has become so much important. Yes, it is necessary to boost your online presence. Your products should be promoted all across the globe and you can take your brand to the next level. It can only be possible by hiring the best marketing team. There are so many processes that are designed to promote your business and social media marketing is the best way to promote your business.<\\/span><\\/p><p><\\/p><p style=\\\"color:rgb(51,51,51);font-family:poppins, sans-serif;font-size:14px;text-align:justify;\\\"><\\/p><ul><li><span><span>Different social media marketing platforms:<\\/span><\\/span><\\/li><\\/ul><p style=\\\"color:rgb(51,51,51);font-family:poppins, sans-serif;font-size:14px;\\\"><\\/p><p style=\\\"color:rgb(51,51,51);font-family:poppins, sans-serif;font-size:14px;text-align:justify;\\\"><\\/p><ul><li><span><span>\\u00a0<\\/span><\\/span><span>YouTube\\u2019<\\/span><p><\\/p><\\/li><li><span><span>\\u00a0\\u00a0<\\/span><\\/span><span>Facebook<\\/span><p><\\/p><\\/li><li><span><span>\\u00a0\\u00a0<\\/span><\\/span><span>Twitter<\\/span><p><\\/p><\\/li><li><span><span>\\u00a0 \\u00a0<\\/span><\\/span><span>Instagram<\\/span><p><\\/p><\\/li><li><span><span>\\u00a0\\u00a0<\\/span><\\/span><span>LinkedIn<\\/span><p><\\/p><\\/li><li><span><span>\\u00a0\\u00a0<\\/span><\\/span><span>Pinterest<\\/span><\\/li><\\/ul>\"}', '2021-02-03 06:56:25', '2021-03-09 15:29:24'),
(108, 62, 5, '{\"title\":\"Plataformas de marketing en redes sociales para impulsar sus ventas\",\"description\":\"<p><b>Equipo de soporte publicado hace 8 meses<\\/b><\\/p><p>Las plataformas de marketing en redes sociales son realmente muy importantes y desempe\\u00f1an un papel vital para impulsar el conocimiento de su marca, las ventas y la conversi\\u00f3n. El crecimiento de una empresa depende de los esfuerzos de marketing. Atr\\u00e1s quedaron los d\\u00edas en que el marketing tradicional era suficiente. Hoy en d\\u00eda, el marketing digital se ha vuelto muy importante. S\\u00ed, es necesario potenciar tu presencia online. Sus productos deben promocionarse en todo el mundo y puede llevar su marca al siguiente nivel. Solo puede ser posible contratando al mejor equipo de marketing. Hay tantos procesos que est\\u00e1n dise\\u00f1ados para promover su negocio y el marketing en redes sociales es la mejor manera de promover su negocio.<\\/p><p><br \\/><\\/p><p>Diferentes plataformas de marketing en redes sociales:<\\/p><ul><li>\\u00a0 Youtube\'<\\/li><li>\\u00a0 \\u00a0Facebook<\\/li><li>\\u00a0 \\u00a0Gorjeo<\\/li><li>\\u00a0 \\u00a0 Instagram<\\/li><li>\\u00a0 \\u00a0LinkedIn<\\/li><li>\\u00a0 \\u00a0Pinterest<\\/li><\\/ul>\"}', '2021-02-03 06:56:54', '2021-03-09 15:31:01'),
(109, 63, 1, '{\"title\":\"Benefits Of Choosing The Best SMM Service Panel Providers\",\"description\":\"<h6>Support team\\u00a0posted 8 months ago<\\/h6><p style=\\\"color:rgb(51,51,51);font-family:poppins, sans-serif;font-size:14px;\\\"><\\/p><p style=\\\"color:rgb(51,51,51);font-family:poppins, sans-serif;font-size:14px;text-align:justify;\\\"><span><span>Do you own a business? Then, for making it a big success, you need to opt for techniques to promote it more effectively. Social Media Marketing (SMM) services refer to the latest and popular digital marketing technique that will help your business to become more visible to the customers. It is a remarkable option for business promotion.<\\/span><\\/span><\\/p><p><\\/p><p style=\\\"color:rgb(51,51,51);font-family:poppins, sans-serif;font-size:14px;text-align:justify;\\\"><span><span>You can get more customers and reach target audience via social media channels. Most of the people from all across the globe use these social networking sites to connect with people and get updated with many new things. They spend lots of time of their day using these sites and exploring Facebook, Instagram and many such social media platforms.<\\/span><\\/span><\\/p><p><\\/p><p style=\\\"color:rgb(51,51,51);font-family:poppins, sans-serif;font-size:14px;text-align:justify;\\\"><span><span>You can also make the most of these platforms by connecting with people and sharing your content in the form of video, image, text or more. When you choose a reliable and popular SMM service panel, it will help you attract more customers via social media platforms like Facebook, Twitter, Instagram, and others. Finding the best SMM service panel like Primesmm.com is essential to get the desired success.<\\/span><\\/span><\\/p>\"}', '2021-02-03 06:57:34', '2021-03-09 15:33:53'),
(110, 63, 5, '{\"title\":\"Beneficios de elegir los mejores proveedores de paneles de servicios SMM\",\"description\":\"<p>Equipo de soporte publicado hace 8 meses<\\/p><p>\\u00bfTienes un negocio? Luego, para que sea un gran \\u00e9xito, debe optar por t\\u00e9cnicas para promoverlo de manera m\\u00e1s efectiva. Los servicios de Social Media Marketing (SMM) se refieren a la \\u00faltima y popular t\\u00e9cnica de marketing digital que ayudar\\u00e1 a que su negocio sea m\\u00e1s visible para los clientes. Es una opci\\u00f3n destacable para la promoci\\u00f3n empresarial.<\\/p><p><br \\/><\\/p><p>Puede obtener m\\u00e1s clientes y llegar al p\\u00fablico objetivo a trav\\u00e9s de los canales de las redes sociales. La mayor\\u00eda de la gente de todo el mundo utiliza estos sitios de redes sociales para conectarse con la gente y actualizarse con muchas cosas nuevas. Pasan mucho tiempo de su d\\u00eda usando estos sitios y explorando Facebook, Instagram y muchas de esas plataformas de redes sociales.<\\/p><p><br \\/><\\/p><p>Tambi\\u00e9n puede aprovechar al m\\u00e1ximo estas plataformas conect\\u00e1ndose con personas y compartiendo su contenido en forma de video, imagen, texto o m\\u00e1s. Cuando elige un panel de servicio SMM confiable y popular, lo ayudar\\u00e1 a atraer m\\u00e1s clientes a trav\\u00e9s de plataformas de redes sociales como Facebook, Twitter, Instagram y otras. Encontrar el mejor panel de servicios de SMM como Primesmm.com es esencial para obtener el \\u00e9xito deseado.<\\/p>\"}', '2021-02-03 06:57:58', '2021-03-09 15:34:33'),
(111, 16, 5, '{\"title\":\"Crecimiento del sitio web\",\"short_description\":\"<p>SMM Matrix es un panel mayorista moderno y eficiente. Intentamos ofrecerle promociones instant\\u00e1neas en diferentes plataformas de redes sociales.<br \\/><\\/p>\",\"button_name\":\"Lee mas\"}', '2021-02-03 07:01:27', '2021-10-20 12:02:08'),
(143, 12, 9, '{\"title\":\"\\u0628\\u0646\\u0627\\u0621 \\u0648\\u0635\\u0644\\u0629\",\"short_description\":\"<p>\\u0642\\u0645 \\u0628\\u0628\\u0646\\u0627\\u0621 \\u0631\\u0627\\u0628\\u0637\\u0643 \\u0645\\u0639 \\u062c\\u0645\\u064a\\u0639 \\u062e\\u062f\\u0645\\u0627\\u062a SMM \\u0641\\u064a Binary SMM.<br \\/><\\/p>\"}', '2021-03-09 11:15:39', '2021-03-09 11:15:39'),
(144, 13, 9, '{\"title\":\"\\u062f\\u0639\\u0645 \\u0627\\u0644\\u0639\\u0645\\u0644\\u0627\\u0621\",\"short_description\":\"<p>\\u064a\\u0623\\u062a\\u064a Binary SMM \\u0645\\u0639 \\u0641\\u0631\\u064a\\u0642 \\u0645\\u062e\\u0635\\u0635 \\u0644\\u0642\\u064a\\u0627\\u062f\\u0629 \\u062f\\u0639\\u0645 \\u0627\\u0644\\u0639\\u0645\\u0644\\u0627\\u0621 \\u0639\\u0644\\u0649 \\u0645\\u0633\\u062a\\u0648\\u0649 \\u0639\\u0627\\u0644\\u0645\\u064a.<br \\/><\\/p>\"}', '2021-03-09 11:18:15', '2021-03-09 11:18:15'),
(145, 14, 9, '{\"title\":\"\\u0627\\u0644\\u0645\\u062f\\u0641\\u0648\\u0639\\u0627\\u062a \\u0627\\u0644\\u062a\\u0644\\u0642\\u0627\\u0626\\u064a\\u0629\",\"short_description\":\"<p>\\u062a\\u062c\\u0639\\u0644\\u0643 \\u0645\\u0639\\u0638\\u0645 \\u0644\\u0648\\u062d\\u0627\\u062a SMM \\u062a\\u062f\\u062e\\u0644 \\u0645\\u0639\\u0644\\u0648\\u0645\\u0627\\u062a \\u0627\\u0644\\u062f\\u0641\\u0639 \\u0641\\u064a \\u0643\\u0644 \\u0645\\u0631\\u0629 \\u062a\\u0642\\u0648\\u0645 \\u0641\\u064a\\u0647\\u0627 \\u0628\\u0625\\u062c\\u0631\\u0627\\u0621 \\u0637\\u0644\\u0628. \\u0642\\u0645 \\u0628\\u0625\\u0639\\u062f\\u0627\\u062f \\u0637\\u0631\\u064a\\u0642\\u0629 \\u062f\\u0641\\u0639 \\u062a\\u0644\\u0642\\u0627\\u0626\\u064a \\u0628\\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 Binary SMM.<br \\/><\\/p>\"}', '2021-03-09 11:26:43', '2021-03-09 11:26:43'),
(146, 15, 9, '{\"title\":\"\\u0623\\u0641\\u0636\\u0644 \\u0644\\u0648\\u062d\\u0629 \\u0645\\u0648\\u0632\\u0639 SMM\",\"short_description\":\"<p>\\u062a\\u0648\\u0641\\u0631 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0627\\u062a \\u0627\\u0644\\u062b\\u0646\\u0627\\u0626\\u064a\\u0629 \\u0623\\u0639\\u0644\\u0649 \\u0645\\u0633\\u062a\\u0648\\u064a\\u0627\\u062a \\u0627\\u0644\\u062c\\u0648\\u062f\\u0629 \\u0644\\u0644\\u062a\\u0631\\u0642\\u064a\\u0627\\u062a. \\u0646\\u062d\\u0646 \\u0648\\u0627\\u062d\\u062f\\u0629 \\u0645\\u0646 \\u0623\\u0641\\u0636\\u0644 \\u0644\\u0648\\u062d\\u0627\\u062a \\u0627\\u0644\\u0645\\u0648\\u0632\\u0639\\u064a\\u0646 SMM \\u0628\\u0645\\u0627 \\u0641\\u064a \\u0630\\u0644\\u0643 \\u0628\\u0639\\u0636 \\u0627\\u0644\\u062e\\u062f\\u0645\\u0627\\u062a \\u0627\\u0644\\u062e\\u0627\\u0635\\u0629 \\u0627\\u0644\\u0645\\u062a\\u0627\\u062d\\u0629 \\u0639\\u0628\\u0631 \\u0627\\u0644\\u0625\\u0646\\u062a\\u0631\\u0646\\u062a.<br \\/><\\/p>\",\"button_name\":\"\\u0627\\u0642\\u0631\\u0623 \\u0623\\u0643\\u062b\\u0631\"}', '2021-03-09 14:22:59', '2021-03-09 14:22:59'),
(147, 16, 9, '{\"title\":\"\\u0646\\u0645\\u0648 \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639\",\"short_description\":\"<p>SMM Matrix\\u00a0 \\u0647\\u064a \\u0644\\u0648\\u062d\\u0629 \\u0628\\u064a\\u0639 \\u0628\\u0627\\u0644\\u062c\\u0645\\u0644\\u0629 \\u062d\\u062f\\u064a\\u062b\\u0629 \\u0648\\u0641\\u0639\\u0627\\u0644\\u0629. \\u0646\\u062d\\u0627\\u0648\\u0644 \\u0623\\u0646 \\u0646\\u0642\\u062f\\u0645 \\u0644\\u0643 \\u0639\\u0631\\u0648\\u0636 \\u062a\\u0631\\u0648\\u064a\\u062c\\u064a\\u0629 \\u0641\\u0648\\u0631\\u064a\\u0629 \\u0639\\u0644\\u0649 \\u0645\\u0646\\u0635\\u0627\\u062a \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a \\u0627\\u0644\\u0645\\u062e\\u062a\\u0644\\u0641\\u0629.<br \\/><\\/p>\",\"button_name\":\"\\u0627\\u0642\\u0631\\u0623 \\u0623\\u0643\\u062b\\u0631\"}', '2021-03-09 14:32:35', '2021-10-20 12:02:19'),
(148, 17, 9, '{\"title\":\"\\u062a\\u0631\\u062a\\u064a\\u0628 SMM\",\"short_description\":\"<p>\\u0646\\u062d\\u0646 \\u0646\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u0645\\u0636\\u0645\\u0648\\u0646\\u0629 \\u0639\\u0644\\u0649 \\u062e\\u0627\\u062f\\u0645 SMM \\u0627\\u0644\\u062e\\u0627\\u0635 \\u0628\\u0645\\u0648\\u0642\\u0639\\u0646\\u0627. \\u062c\\u0645\\u064a\\u0639 \\u0627\\u0644\\u062e\\u062f\\u0645\\u0627\\u062a \\u0644\\u0646 \\u062a\\u0643\\u0648\\u0646 \\u062e\\u062f\\u0645\\u0629 \\u0625\\u0633\\u0642\\u0627\\u0637.<br \\/><\\/p>\",\"button_name\":\"\\u0627\\u0642\\u0631\\u0623 \\u0623\\u0643\\u062b\\u0631\"}', '2021-03-09 14:41:25', '2021-03-09 14:41:25'),
(149, 7, 9, '{\"title\":\"\\u0627\\u0644\\u0639\\u0645\\u0644\\u0627\\u0621 \\u0627\\u0644\\u0646\\u0634\\u0637\\u064a\\u0646\",\"number_of_data\":\"320\"}', '2021-03-09 14:42:47', '2021-03-09 14:42:47'),
(150, 8, 9, '{\"title\":\"\\u0627\\u0644\\u0645\\u0634\\u0627\\u0631\\u064a\\u0639 \\u0627\\u0644\\u0645\\u0646\\u062c\\u0632\\u0629\",\"number_of_data\":\"850\"}', '2021-03-09 14:43:06', '2021-03-09 14:43:06'),
(151, 9, 9, '{\"title\":\"\\u0645\\u0633\\u062a\\u0634\\u0627\\u0631\\u0648 \\u0627\\u0644\\u0641\\u0631\\u064a\\u0642\",\"number_of_data\":\"28\"}', '2021-03-09 14:43:24', '2021-03-09 14:43:24'),
(152, 10, 9, '{\"title\":\"\\u0633\\u0646\\u0648\\u0627\\u062a \\u0645\\u062c\\u064a\\u062f\\u0629\",\"number_of_data\":\"8\"}', '2021-03-09 14:43:48', '2021-03-09 14:43:48');
INSERT INTO `content_details` (`id`, `content_id`, `language_id`, `description`, `created_at`, `updated_at`) VALUES
(153, 19, 9, '{\"name\":\"\\u0623\\u0644\\u064a\\u0633\\u064a\\u0627 \\u0641\\u0648\\u0643\\u0633\",\"designation\":\"\\u0641\\u0631\\u064a\\u0642 \\u0647\\u0646\\u062a\\u0631\",\"description\":\"<p>\\u0644\\u0642\\u062f \\u0637\\u0644\\u0628\\u062a \\u0625\\u0639\\u062c\\u0627\\u0628\\u0627\\u062a \\u0635\\u0641\\u062d\\u0629 Facebook \\u0648\\u0645\\u062a\\u0627\\u0628\\u0639\\u064a IG \\u060c \\u0648\\u062a\\u0644\\u0642\\u064a\\u062a \\u0645\\u062a\\u0627\\u0628\\u0639\\u064a\\u0646 \\u0630\\u0648\\u064a \\u062c\\u0648\\u062f\\u0629 \\u0639\\u0627\\u0644\\u064a\\u0629 \\u0645\\u0648\\u0635\\u0649 \\u0628\\u0647\\u0645 \\u0644\\u0644\\u063a\\u0627\\u064a\\u0629 \\u060c \\u0648\\u0633\\u0623\\u0637\\u0644\\u0628 \\u0628\\u0627\\u0644\\u062a\\u0623\\u0643\\u064a\\u062f \\u0645\\u0631\\u0629 \\u0623\\u062e\\u0631\\u0649 \\u0634\\u0643\\u0631\\u064b\\u0627 \\u0644\\u0643<br \\/><\\/p>\"}', '2021-03-09 14:50:50', '2021-03-09 14:50:50'),
(154, 20, 9, '{\"name\":\"\\u062f\\u0648\\u0646\\u0627\\u0644\\u062f \\u062a\\u0631\\u0645\\u0628\",\"designation\":\"\\u0627\\u0644\\u0645\\u062f\\u064a\\u0631 \\u0627\\u0644\\u062a\\u0646\\u0641\\u064a\\u0630\\u064a\",\"description\":\"<p>\\u062d\\u0633\\u0646\\u064b\\u0627 \\u060c \\u0643\\u0646\\u062a \\u0623\\u062e\\u062a\\u0628\\u0631 \\u062e\\u062f\\u0645\\u0629 \\u0645\\u062a\\u0627\\u0628\\u0639\\u064a Instagram \\u0648\\u062a\\u0639\\u0645\\u0644 \\u0628\\u0634\\u0643\\u0644 \\u062c\\u064a\\u062f \\u062d\\u0642\\u064b\\u0627! \\u064a\\u0633\\u062a\\u063a\\u0631\\u0642 \\u062d\\u0648\\u0627\\u0644\\u064a 5-10 \\u062f\\u0642\\u0627\\u0626\\u0642 \\u0644\\u0628\\u062f\\u0621 \\u0648\\u0625\\u0643\\u0645\\u0627\\u0644 \\u0627\\u0644\\u0645\\u062a\\u0627\\u0628\\u0639\\u064a\\u0646 \\u0628\\u0633\\u0631\\u0639\\u0629 \\u0641\\u0627\\u0626\\u0642\\u0629! \\u0644\\u0630\\u0627 \\u062a\\u0639\\u062c\\u0628\\u0646\\u064a \\u0627\\u0644\\u062e\\u062f\\u0645\\u0629.<br \\/><\\/p>\"}', '2021-03-09 15:05:06', '2021-03-09 15:05:06'),
(155, 18, 9, '{\"name\":\"\\u0645\\u0627\\u0631\\u064a\\u0627 \\u062c\\u0627\\u0643\\u064a\\u062a\",\"designation\":\"\\u0645\\u0637\\u0648\\u0631 \\u0648\\u064a\\u0628\",\"description\":\"<p>\\u062a\\u0639\\u062c\\u0628\\u0646\\u064a \\u0647\\u0630\\u0647 \\u0627\\u0644\\u0644\\u0648\\u062d\\u0629 \\u060c \\u0641\\u0623\\u0646\\u0627 \\u0641\\u064a \\u0627\\u0644\\u0648\\u0627\\u0642\\u0639 \\u0623\\u0648\\u0627\\u062c\\u0647 \\u0645\\u0634\\u0643\\u0644\\u0629 \\u0641\\u064a \\u0645\\u062d\\u0627\\u0648\\u0644\\u062a\\u064a \\u0627\\u0644\\u0623\\u0648\\u0644\\u0649 \\u0648\\u0644\\u0643\\u0646 \\u0627\\u0644\\u062f\\u0639\\u0645 \\u0643\\u0627\\u0646 \\u0645\\u0648\\u062c\\u0648\\u062f\\u064b\\u0627 \\u060c \\u0648\\u0642\\u062f \\u0633\\u0627\\u0639\\u062f\\u0648\\u0646\\u064a \\u0641\\u064a \\u062d\\u0644 \\u0647\\u0630\\u0647 \\u0627\\u0644\\u0645\\u0634\\u0643\\u0644\\u0629 \\u062b\\u0645 \\u062c\\u0631\\u0628\\u062a \\u0645\\u0634\\u0627\\u0647\\u062f\\u0627\\u062a YouTube \\u0648\\u0623\\u0639\\u062a\\u0642\\u062f \\u0623\\u0646\\u0647\\u0627 \\u0648\\u0627\\u062d\\u062f\\u0629 \\u0645\\u0646 \\u0627\\u0644\\u0623\\u0641\\u0636\\u0644.<br \\/><\\/p>\"}', '2021-03-09 15:09:21', '2021-03-09 15:09:21'),
(156, 21, 9, '{\"name\":\"\\u062a\\u0648\\u0645 \\u0645\\u0648\\u062f\\u064a\",\"designation\":\"\\u0627\\u0644\\u0627\\u0639\\u0645\\u0627\\u0644 \\u0627\\u0644\\u062a\\u0646\\u0641\\u064a\\u0630\\u064a\\u0629\",\"description\":\"<p>\\u0644\\u0642\\u062f \\u0643\\u0646\\u062a \\u0623\\u0633\\u062a\\u062e\\u062f\\u0645 Binary SMM \\u0644\\u0645\\u062f\\u0629 \\u0623\\u0633\\u0628\\u0648\\u0639 \\u0627\\u0644\\u0622\\u0646 \\u0648\\u0647\\u064a \\u0623\\u0641\\u0636\\u0644 \\u0644\\u0648\\u062d\\u0629 \\u0627\\u0633\\u062a\\u062e\\u062f\\u0645\\u062a\\u0647\\u0627 \\u0628\\u0633\\u0647\\u0648\\u0644\\u0629. \\u0623\\u0633\\u0639\\u0627\\u0631 \\u0631\\u0627\\u0626\\u0639\\u0629 \\u0648\\u0633\\u0647\\u0644\\u0629 \\u0627\\u0644\\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\u0648\\u0645\\u062d\\u062f\\u062b\\u0629 \\u062f\\u0627\\u0626\\u0645\\u064b\\u0627. \\u0639\\u0645\\u0644 \\u0639\\u0638\\u064a\\u0645!<br \\/><\\/p>\"}', '2021-03-09 15:11:13', '2021-03-09 15:11:13'),
(157, 22, 9, '{\"name\":\"\\u0623\\u0633\\u0643\\u0627\",\"designation\":\"\\u0631\\u0626\\u064a\\u0633 \\u0642\\u0633\\u0645 \\u0627\\u0644\\u0623\\u0641\\u0643\\u0627\\u0631\",\"description\":\"<p>\\u0627\\u0633\\u062a\\u062e\\u062f\\u0645\\u062a \\u0647\\u0630\\u0647 \\u0627\\u0644\\u062e\\u062f\\u0645\\u0629 \\u0644\\u0645\\u062f\\u0629 \\u0623\\u0633\\u0628\\u0648\\u0639 \\u0648\\u0642\\u062f\\u0645\\u062a \\u062d\\u0648\\u0627\\u0644\\u064a 15 \\u0637\\u0644\\u0628\\u064b\\u0627 \\u0644\\u062e\\u062f\\u0645\\u0627\\u062a \\u0645\\u062e\\u062a\\u0644\\u0641\\u0629. \\u0623\\u062d\\u0628\\u0628\\u062a \\u0627\\u0644\\u062c\\u0648\\u062f\\u0629. \\u0643\\u0627\\u0646 \\u0647\\u0646\\u0627\\u0643 \\u062a\\u0648\\u0642\\u0641 \\u0645\\u0624\\u0642\\u062a \\u0641\\u064a \\u062a\\u0642\\u062f\\u064a\\u0645 \\u0627\\u0644\\u0625\\u0639\\u062c\\u0627\\u0628\\u0627\\u062a \\u060c \\u0648\\u0644\\u0643\\u0646 \\u0641\\u064a \\u0627\\u0644\\u0646\\u0647\\u0627\\u064a\\u0629 \\u062a\\u0645 \\u062a\\u0633\\u0644\\u064a\\u0645 \\u0643\\u0644 \\u0634\\u064a\\u0621 \\u0628\\u0627\\u0644\\u0643\\u0627\\u0645\\u0644.<br \\/><\\/p>\"}', '2021-03-09 15:13:23', '2021-03-09 15:13:23'),
(158, 61, 9, '{\"title\":\"\\u0627\\u0644\\u0627\\u0645\\u062a\\u064a\\u0627\\u0632\\u0627\\u062a \\u0627\\u0644\\u062d\\u0642\\u064a\\u0642\\u064a\\u0629 \\u0644\\u0640 SMM Panel\",\"description\":\"<p>\\u0644\\u0642\\u062f \\u0643\\u0627\\u0646 \\u0627\\u0644\\u062a\\u0633\\u0648\\u064a\\u0642 \\u0639\\u0628\\u0631 \\u0648\\u0633\\u0627\\u0626\\u0644 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a \\u0623\\u062d\\u062f \\u0623\\u0643\\u062b\\u0631 \\u0627\\u0644\\u0639\\u0646\\u0627\\u0635\\u0631 \\u0627\\u0644\\u0645\\u062d\\u0648\\u0631\\u064a\\u0629 \\u0644\\u0644\\u0623\\u0639\\u0645\\u0627\\u0644 3.0. \\u0625\\u0630\\u0627 \\u0643\\u0646\\u062a \\u0642\\u062f \\u0623\\u0631\\u0633\\u0644\\u062a \\u0628\\u0627\\u0644\\u0641\\u0639\\u0644 \\u0641\\u0631\\u064a\\u0642\\u0643 \\u0627\\u0644\\u0625\\u0628\\u062f\\u0627\\u0639\\u064a \\u0644\\u062a\\u062d\\u0633\\u064a\\u0646 \\u0639\\u0645\\u0644\\u0643 \\u0645\\u0646 \\u062e\\u0644\\u0627\\u0644 \\u0648\\u0633\\u0627\\u0626\\u0644 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a \\u060c \\u0641\\u0633\\u062a\\u0639\\u0631\\u0641 \\u0645\\u0627 \\u0647\\u064a \\u0627\\u0644\\u062a\\u062d\\u062f\\u064a\\u0627\\u062a. \\u0645\\u0639 \\u0647\\u0630\\u0647 \\u0627\\u0644\\u0645\\u0648\\u0627\\u0631\\u062f \\u0648\\u0627\\u0644\\u0648\\u0642\\u062a \\u0627\\u0644\\u0645\\u062d\\u062f\\u0648\\u062f \\u0645\\u0646 \\u062c\\u0627\\u0646\\u0628\\u0643 \\u060c \\u0641\\u0645\\u0646 \\u0627\\u0644\\u0645\\u0646\\u0637\\u0642\\u064a \\u0627\\u0639\\u062a\\u0628\\u0627\\u0631 \\u0644\\u0648\\u062d\\u0629 SMM \\u0647\\u064a \\u0627\\u0644\\u062d\\u0644 \\u0627\\u0644\\u062d\\u0642\\u064a\\u0642\\u064a \\u0644\\u0644\\u062a\\u0633\\u0648\\u064a\\u0642 \\u0639\\u0628\\u0631 \\u0648\\u0633\\u0627\\u0626\\u0644 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a. \\u0633\\u062a\\u0633\\u0627\\u0639\\u062f\\u0643 \\u0644\\u0648\\u062d\\u0629 smm India \\u0639\\u0644\\u0649 \\u0623\\u062a\\u0645\\u062a\\u0629 \\u062c\\u0645\\u064a\\u0639 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0627\\u062a.<\\/p><p>\\u0645\\u0646 \\u0627\\u0644\\u0645\\u062d\\u062a\\u0645\\u0644 \\u0623\\u0646\\u0643 \\u0642\\u062f \\u0627\\u0633\\u062a\\u062e\\u062f\\u0645\\u062a \\u062e\\u062f\\u0645\\u0627\\u062a \\u0627\\u0644\\u062a\\u0633\\u0648\\u064a\\u0642 \\u0639\\u0628\\u0631 \\u0648\\u0633\\u0627\\u0626\\u0644 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a \\u0627\\u0644\\u0645\\u062d\\u062f\\u062f\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644. \\u0645\\u0646 \\u0627\\u0644\\u0633\\u0647\\u0644 \\u0625\\u062f\\u0627\\u0631\\u0629 \\u062d\\u0645\\u0644\\u0627\\u062a\\u0643 \\u0627\\u0644\\u0625\\u0639\\u0644\\u0627\\u0646\\u064a\\u0629 \\u0644\\u0623\\u0646 \\u0627\\u0644\\u0625\\u062c\\u0631\\u0627\\u0621\\u0627\\u062a \\u0647\\u064a \\u062a\\u062c\\u0631\\u0628\\u0629 \\u0639\\u062f\\u0645 \\u0627\\u0644\\u062a\\u062f\\u062e\\u0644. \\u0628\\u0634\\u0643\\u0644 \\u0639\\u0627\\u0645 \\u060c \\u062a\\u0639\\u062f \\u0644\\u0648\\u062d\\u0629 SMM \\u0627\\u0644\\u0647\\u0646\\u062f\\u064a\\u0629 \\u062d\\u0644\\u0627\\u064b \\u0631\\u0627\\u0626\\u0639\\u064b\\u0627 \\u0644\\u0644\\u0648\\u0635\\u0648\\u0644 \\u0625\\u0644\\u0649 \\u062c\\u0645\\u0647\\u0648\\u0631\\u0643 \\u0627\\u0644\\u0645\\u0633\\u062a\\u0647\\u062f\\u0641 \\u062f\\u0648\\u0646 \\u0625\\u0636\\u0627\\u0639\\u0629 \\u0648\\u0642\\u062a\\u0643.<\\/p><p>\\u064a\\u0645\\u0643\\u0646\\u0643 \\u0628\\u0627\\u0644\\u0641\\u0639\\u0644 \\u0627\\u0644\\u0627\\u0633\\u062a\\u0641\\u0627\\u062f\\u0629 \\u0645\\u0646 \\u0627\\u0644\\u0646\\u062a\\u0627\\u0626\\u062c \\u0628\\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\u0623\\u0641\\u0636\\u0644 \\u0644\\u0648\\u062d\\u0629 SMM \\u0641\\u064a \\u0627\\u0644\\u0647\\u0646\\u062f. \\u0645\\u0646 \\u062e\\u0644\\u0627\\u0644 \\u0645\\u0646\\u0635\\u0627\\u062a \\u0627\\u0644\\u0645\\u0648\\u0632\\u0639\\u064a\\u0646 \\u0647\\u0630\\u0647 \\u060c \\u0644\\u0646 \\u062a\\u062d\\u0635\\u0644 \\u0641\\u0642\\u0637 \\u0639\\u0644\\u0649 \\u062e\\u062f\\u0645\\u0627\\u062a \\u0627\\u0644\\u0648\\u0633\\u0627\\u0626\\u0637 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a\\u0629 \\u0627\\u0644\\u062a\\u064a \\u062a\\u0633\\u062a\\u062e\\u062f\\u0645\\u0647\\u0627 \\u0639\\u0627\\u062f\\u0629\\u064b \\u060c \\u0628\\u0644 \\u0633\\u062a\\u062d\\u0635\\u0644 \\u0623\\u064a\\u0636\\u064b\\u0627 \\u0639\\u0644\\u0649 \\u0625\\u0645\\u0643\\u0627\\u0646\\u064a\\u0629 \\u0625\\u0639\\u0627\\u062f\\u0629 \\u0628\\u064a\\u0639 \\u0627\\u0644\\u062e\\u062f\\u0645\\u0627\\u062a. \\u0641\\u064a\\u0645\\u0627 \\u064a\\u0644\\u064a \\u0623\\u0647\\u0645 \\u0627\\u0644\\u0627\\u0645\\u062a\\u064a\\u0627\\u0632\\u0627\\u062a \\u0627\\u0644\\u062a\\u064a \\u064a\\u0645\\u0643\\u0646\\u0643 \\u0648\\u0636\\u0639\\u0647\\u0627 \\u0641\\u064a \\u0627\\u0644\\u0627\\u0639\\u062a\\u0628\\u0627\\u0631.<\\/p><p><b>\\u062d\\u0644 \\u062d\\u0631\\u0643\\u0629 \\u0627\\u0644\\u0645\\u0631\\u0648\\u0631 \\u0627\\u0644\\u0643\\u0644 \\u0641\\u064a \\u0648\\u0627\\u062d\\u062f<\\/b><\\/p><p>\\u062a\\u0642\\u062f\\u0645 \\u0644\\u0643 \\u0645\\u0639\\u0638\\u0645 \\u0644\\u0648\\u062d\\u0627\\u062a SMM \\u0627\\u0644\\u062a\\u064a \\u062a\\u062e\\u062a\\u0627\\u0631\\u0647\\u0627 \\u062e\\u062f\\u0645\\u0627\\u062a \\u0645\\u0646\\u0635\\u0627\\u062a \\u0627\\u0644\\u0648\\u0633\\u0627\\u0626\\u0637 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a\\u0629 \\u0627\\u0644\\u0645\\u062e\\u062a\\u0644\\u0641\\u0629. \\u0643\\u0645\\u0627 \\u0646\\u0639\\u0644\\u0645 \\u060c \\u0641\\u0625\\u0646 \\u0623\\u0647\\u0645 \\u0634\\u0628\\u0643\\u0627\\u062a \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a \\u0647\\u064a YouTube \\u0648 Instagram \\u0648 Facebook \\u0648 Instagram \\u0648\\u0645\\u0627 \\u0625\\u0644\\u0649 \\u0630\\u0644\\u0643. \\u0633\\u062a\\u062a\\u0645\\u0643\\u0646 \\u0645\\u0646 \\u0627\\u0644\\u062d\\u0635\\u0648\\u0644 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u062e\\u062f\\u0645\\u0627\\u062a \\u0627\\u0644\\u062a\\u064a \\u062a\\u062f\\u0648\\u0631 \\u062d\\u0648\\u0644 \\u0627\\u0644\\u0645\\u062a\\u063a\\u064a\\u0631\\u0627\\u062a \\u0645\\u062b\\u0644 \\u0627\\u0644\\u062a\\u0639\\u0644\\u064a\\u0642\\u0627\\u062a \\u0648\\u0627\\u0644\\u0645\\u0634\\u0627\\u0631\\u0643\\u0629 \\u0648\\u0627\\u0644\\u0625\\u0639\\u062c\\u0627\\u0628\\u0627\\u062a \\u0648\\u0627\\u0644\\u0622\\u0631\\u0627\\u0621 \\u0648\\u0627\\u0644\\u0627\\u0634\\u062a\\u0631\\u0627\\u0643 \\u0648\\u0627\\u0644\\u0625\\u0634\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a\\u0629 \\u0627\\u0644\\u0623\\u062e\\u0631\\u0649.<\\/p><p>\\u0627\\u0644\\u0634\\u064a\\u0621 \\u0627\\u0644\\u062c\\u064a\\u062f \\u0647\\u0646\\u0627 \\u0647\\u0648 \\u0623\\u0646\\u0647 \\u064a\\u0645\\u0643\\u0646\\u0643 \\u0627\\u0644\\u062d\\u0635\\u0648\\u0644 \\u0639\\u0644\\u064a\\u0647\\u0627 \\u062c\\u0645\\u064a\\u0639\\u064b\\u0627 \\u0645\\u0646 \\u062e\\u0644\\u0627\\u0644 \\u0645\\u0646\\u0635\\u0629 \\u0644\\u0648\\u062d\\u0629 SMM \\u0631\\u062e\\u064a\\u0635\\u0629 \\u0648\\u0627\\u062d\\u062f\\u0629. \\u0639\\u0627\\u062f\\u0629\\u064b \\u0645\\u0627 \\u064a\\u0642\\u0648\\u0645 \\u0623\\u0641\\u0636\\u0644 \\u0641\\u0631\\u064a\\u0642 \\u0639\\u0645\\u0644 \\u0644\\u0648\\u062d\\u0629 SMM \\u0628\\u0625\\u0646\\u0634\\u0627\\u0621 \\u0645\\u0644\\u0641\\u0627\\u062a \\u0627\\u0644\\u062a\\u0639\\u0631\\u064a\\u0641 \\u064a\\u062f\\u0648\\u064a\\u064b\\u0627 \\u0628\\u062d\\u064a\\u062b \\u062a\\u0623\\u062a\\u064a \\u0643\\u0644 \\u062d\\u0631\\u0643\\u0629 \\u0627\\u0644\\u0645\\u0631\\u0648\\u0631 \\u0645\\u0646 \\u0645\\u0635\\u0627\\u062f\\u0631 \\u0639\\u0636\\u0648\\u064a\\u0629. \\u0643\\u0645\\u0627 \\u0646\\u0639\\u0644\\u0645 \\u060c \\u0644\\u0627 \\u062a\\u062d\\u0628 Google \\u062d\\u0631\\u0643\\u0629 \\u0645\\u0631\\u0648\\u0631 \\u0627\\u0644\\u0628\\u064a\\u0627\\u0646\\u0627\\u062a \\u0627\\u0644\\u0622\\u0644\\u064a\\u0629. \\u0648\\u0644\\u0643\\u0646 \\u0628\\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u0644\\u0648\\u062d\\u0629 SMM \\u0647\\u0630\\u0647 \\u060c \\u064a\\u062c\\u0628 \\u0623\\u0644\\u0627 \\u062a\\u0642\\u0644\\u0642 \\u0628\\u0634\\u0623\\u0646 \\u0630\\u0644\\u0643.<\\/p>\"}', '2021-03-09 15:22:24', '2021-03-09 15:22:24'),
(159, 62, 9, '{\"title\":\"\\u0645\\u0646\\u0635\\u0627\\u062a \\u0627\\u0644\\u062a\\u0633\\u0648\\u064a\\u0642 \\u0639\\u0628\\u0631 \\u0648\\u0633\\u0627\\u0626\\u0644 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a \\u0644\\u0632\\u064a\\u0627\\u062f\\u0629 \\u0645\\u0628\\u064a\\u0639\\u0627\\u062a\\u0643\",\"description\":\"<p>\\u0646\\u0634\\u0631 \\u0641\\u0631\\u064a\\u0642 \\u0627\\u0644\\u062f\\u0639\\u0645 \\u0645\\u0646\\u0630 8 \\u0623\\u0634\\u0647\\u0631<\\/p><p>\\u062a\\u0639\\u062f \\u0645\\u0646\\u0635\\u0627\\u062a \\u0627\\u0644\\u062a\\u0633\\u0648\\u064a\\u0642 \\u0639\\u0628\\u0631 \\u0648\\u0633\\u0627\\u0626\\u0644 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a \\u0645\\u0647\\u0645\\u0629 \\u062c\\u062f\\u064b\\u0627 \\u062d\\u0642\\u064b\\u0627 \\u0648\\u062a\\u0644\\u0639\\u0628 \\u062f\\u0648\\u0631\\u064b\\u0627 \\u062d\\u064a\\u0648\\u064a\\u064b\\u0627 \\u0641\\u064a \\u0632\\u064a\\u0627\\u062f\\u0629 \\u0627\\u0644\\u0648\\u0639\\u064a \\u0628\\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0629 \\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\u064a\\u0629 \\u0648\\u0627\\u0644\\u0645\\u0628\\u064a\\u0639\\u0627\\u062a \\u0648\\u0627\\u0644\\u062a\\u062d\\u0648\\u064a\\u0644 \\u064a\\u0639\\u062a\\u0645\\u062f \\u0646\\u0645\\u0648 \\u0627\\u0644\\u0623\\u0639\\u0645\\u0627\\u0644 \\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\u064a\\u0629 \\u0639\\u0644\\u0649 \\u062c\\u0647\\u0648\\u062f \\u0627\\u0644\\u062a\\u0633\\u0648\\u064a\\u0642. \\u0644\\u0642\\u062f \\u0648\\u0644\\u062a \\u0627\\u0644\\u0623\\u064a\\u0627\\u0645 \\u0627\\u0644\\u062a\\u064a \\u0643\\u0627\\u0646 \\u0641\\u064a\\u0647\\u0627 \\u0627\\u0644\\u062a\\u0633\\u0648\\u064a\\u0642 \\u0627\\u0644\\u062a\\u0642\\u0644\\u064a\\u062f\\u064a \\u0643\\u0627\\u0641\\u064a\\u0627\\u064b. \\u0641\\u064a \\u0627\\u0644\\u0648\\u0642\\u062a \\u0627\\u0644\\u062d\\u0627\\u0636\\u0631 \\u060c \\u0623\\u0635\\u0628\\u062d \\u0627\\u0644\\u062a\\u0633\\u0648\\u064a\\u0642 \\u0627\\u0644\\u0631\\u0642\\u0645\\u064a \\u0645\\u0647\\u0645\\u064b\\u0627 \\u062c\\u062f\\u064b\\u0627. \\u0646\\u0639\\u0645 \\u060c \\u0645\\u0646 \\u0627\\u0644\\u0636\\u0631\\u0648\\u0631\\u064a \\u062a\\u0639\\u0632\\u064a\\u0632 \\u062a\\u0648\\u0627\\u062c\\u062f\\u0643 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0625\\u0646\\u062a\\u0631\\u0646\\u062a. \\u064a\\u062c\\u0628 \\u0627\\u0644\\u062a\\u0631\\u0648\\u064a\\u062c \\u0644\\u0645\\u0646\\u062a\\u062c\\u0627\\u062a\\u0643 \\u0641\\u064a \\u062c\\u0645\\u064a\\u0639 \\u0623\\u0646\\u062d\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0627\\u0644\\u0645 \\u0648\\u064a\\u0645\\u0643\\u0646\\u0643 \\u0646\\u0642\\u0644 \\u0639\\u0644\\u0627\\u0645\\u062a\\u0643 \\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\u064a\\u0629 \\u0625\\u0644\\u0649 \\u0627\\u0644\\u0645\\u0633\\u062a\\u0648\\u0649 \\u0627\\u0644\\u062a\\u0627\\u0644\\u064a. \\u0644\\u0627 \\u064a\\u0645\\u0643\\u0646 \\u0623\\u0646 \\u064a\\u0643\\u0648\\u0646 \\u0630\\u0644\\u0643 \\u0645\\u0645\\u0643\\u0646\\u064b\\u0627 \\u0625\\u0644\\u0627 \\u0645\\u0646 \\u062e\\u0644\\u0627\\u0644 \\u062a\\u0639\\u064a\\u064a\\u0646 \\u0623\\u0641\\u0636\\u0644 \\u0641\\u0631\\u064a\\u0642 \\u062a\\u0633\\u0648\\u064a\\u0642. \\u0647\\u0646\\u0627\\u0643 \\u0627\\u0644\\u0639\\u062f\\u064a\\u062f \\u0645\\u0646 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0627\\u062a \\u0627\\u0644\\u0645\\u0635\\u0645\\u0645\\u0629 \\u0644\\u0644\\u062a\\u0631\\u0648\\u064a\\u062c \\u0644\\u0639\\u0645\\u0644\\u0643 \\u0648\\u0627\\u0644\\u062a\\u0633\\u0648\\u064a\\u0642 \\u0639\\u0628\\u0631 \\u0648\\u0633\\u0627\\u0626\\u0644 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a \\u0647\\u0648 \\u0623\\u0641\\u0636\\u0644 \\u0637\\u0631\\u064a\\u0642\\u0629 \\u0644\\u0644\\u062a\\u0631\\u0648\\u064a\\u062c \\u0644\\u0639\\u0645\\u0644\\u0643.<\\/p><p><br \\/><\\/p><p>\\u0645\\u0646\\u0635\\u0627\\u062a \\u0627\\u0644\\u062a\\u0633\\u0648\\u064a\\u0642 \\u0639\\u0628\\u0631 \\u0648\\u0633\\u0627\\u0626\\u0644 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a \\u0627\\u0644\\u0645\\u062e\\u062a\\u0644\\u0641\\u0629:<\\/p><p>\\u00a0 \\u0645\\u0648\\u0642\\u0639 YouTube\'<\\/p><p>\\u00a0 \\u00a0\\u0645\\u0648\\u0642\\u0639 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a \\u0627\\u0644\\u0641\\u064a\\u0633\\u0628\\u0648\\u0643<\\/p><p>\\u00a0 \\u00a0\\u062a\\u0648\\u064a\\u062a\\u0631<\\/p><p>\\u00a0 \\u00a0 \\u0627\\u0646\\u0633\\u062a\\u063a\\u0631\\u0627\\u0645<\\/p><p>\\u00a0 \\u00a0\\u064a\\u0646\\u0643\\u062f\\u064a\\u0646<\\/p><p>\\u00a0 \\u00a0\\u0628\\u064a\\u0646\\u062a\\u064a\\u0631\\u064a\\u0633\\u062a<\\/p>\"}', '2021-03-09 15:31:30', '2021-03-09 15:31:30'),
(160, 63, 9, '{\"title\":\"\\u0641\\u0648\\u0627\\u0626\\u062f \\u0627\\u062e\\u062a\\u064a\\u0627\\u0631 \\u0623\\u0641\\u0636\\u0644 \\u0645\\u0648\\u0641\\u0631\\u064a \\u0644\\u0648\\u062d\\u0627\\u062a \\u062e\\u062f\\u0645\\u0629 SMM\",\"description\":\"<p>\\u0646\\u0634\\u0631 \\u0641\\u0631\\u064a\\u0642 \\u0627\\u0644\\u062f\\u0639\\u0645 \\u0645\\u0646\\u0630 8 \\u0623\\u0634\\u0647\\u0631<\\/p><p>\\u0647\\u0644 \\u0644\\u062f\\u064a\\u0643 \\u0639\\u0645\\u0644\\u061f \\u0628\\u0639\\u062f \\u0630\\u0644\\u0643 \\u060c \\u0644\\u062a\\u062d\\u0642\\u064a\\u0642 \\u0646\\u062c\\u0627\\u062d \\u0643\\u0628\\u064a\\u0631 \\u060c \\u062a\\u062d\\u062a\\u0627\\u062c \\u0625\\u0644\\u0649 \\u0627\\u062e\\u062a\\u064a\\u0627\\u0631 \\u0627\\u0644\\u062a\\u0642\\u0646\\u064a\\u0627\\u062a \\u0644\\u0644\\u062a\\u0631\\u0648\\u064a\\u062c \\u0644\\u0647\\u0627 \\u0628\\u0634\\u0643\\u0644 \\u0623\\u0643\\u062b\\u0631 \\u0641\\u0639\\u0627\\u0644\\u064a\\u0629. \\u062a\\u0634\\u064a\\u0631 \\u062e\\u062f\\u0645\\u0627\\u062a \\u0627\\u0644\\u062a\\u0633\\u0648\\u064a\\u0642 \\u0639\\u0628\\u0631 \\u0648\\u0633\\u0627\\u0626\\u0644 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a (SMM) \\u0625\\u0644\\u0649 \\u0623\\u062d\\u062f\\u062b \\u062a\\u0642\\u0646\\u064a\\u0627\\u062a \\u0627\\u0644\\u062a\\u0633\\u0648\\u064a\\u0642 \\u0627\\u0644\\u0631\\u0642\\u0645\\u064a \\u0648\\u0627\\u0644\\u0634\\u0627\\u0626\\u0639\\u0629 \\u0627\\u0644\\u062a\\u064a \\u0633\\u062a\\u0633\\u0627\\u0639\\u062f \\u0639\\u0645\\u0644\\u0643 \\u0639\\u0644\\u0649 \\u0623\\u0646 \\u064a\\u0635\\u0628\\u062d \\u0623\\u0643\\u062b\\u0631 \\u0648\\u0636\\u0648\\u062d\\u064b\\u0627 \\u0644\\u0644\\u0639\\u0645\\u0644\\u0627\\u0621. \\u0625\\u0646\\u0647 \\u062e\\u064a\\u0627\\u0631 \\u0631\\u0627\\u0626\\u0639 \\u0644\\u062a\\u0631\\u0648\\u064a\\u062c \\u0627\\u0644\\u0623\\u0639\\u0645\\u0627\\u0644.<\\/p><p><br \\/><\\/p><p>\\u064a\\u0645\\u0643\\u0646\\u0643 \\u0627\\u0644\\u062d\\u0635\\u0648\\u0644 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0645\\u0632\\u064a\\u062f \\u0645\\u0646 \\u0627\\u0644\\u0639\\u0645\\u0644\\u0627\\u0621 \\u0648\\u0627\\u0644\\u0648\\u0635\\u0648\\u0644 \\u0625\\u0644\\u0649 \\u0627\\u0644\\u062c\\u0645\\u0647\\u0648\\u0631 \\u0627\\u0644\\u0645\\u0633\\u062a\\u0647\\u062f\\u0641 \\u0639\\u0628\\u0631 \\u0642\\u0646\\u0648\\u0627\\u062a \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a. \\u064a\\u0633\\u062a\\u062e\\u062f\\u0645 \\u0645\\u0639\\u0638\\u0645 \\u0627\\u0644\\u0623\\u0634\\u062e\\u0627\\u0635 \\u0645\\u0646 \\u062c\\u0645\\u064a\\u0639 \\u0623\\u0646\\u062d\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0627\\u0644\\u0645 \\u0645\\u0648\\u0627\\u0642\\u0639 \\u0627\\u0644\\u0634\\u0628\\u0643\\u0627\\u062a \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a\\u0629 \\u0647\\u0630\\u0647 \\u0644\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0645\\u0639 \\u0627\\u0644\\u0623\\u0634\\u062e\\u0627\\u0635 \\u0648\\u062a\\u062d\\u062f\\u064a\\u062b \\u0627\\u0644\\u0639\\u062f\\u064a\\u062f \\u0645\\u0646 \\u0627\\u0644\\u0623\\u0634\\u064a\\u0627\\u0621 \\u0627\\u0644\\u062c\\u062f\\u064a\\u062f\\u0629. \\u064a\\u0642\\u0636\\u0648\\u0646 \\u0627\\u0644\\u0643\\u062b\\u064a\\u0631 \\u0645\\u0646 \\u0627\\u0644\\u0648\\u0642\\u062a \\u0645\\u0646 \\u064a\\u0648\\u0645\\u0647\\u0645 \\u0628\\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\u0647\\u0630\\u0647 \\u0627\\u0644\\u0645\\u0648\\u0627\\u0642\\u0639 \\u0648\\u0627\\u0633\\u062a\\u0643\\u0634\\u0627\\u0641 Facebook \\u0648 Instagram \\u0648\\u0627\\u0644\\u0639\\u062f\\u064a\\u062f \\u0645\\u0646 \\u0645\\u0646\\u0635\\u0627\\u062a \\u0627\\u0644\\u0648\\u0633\\u0627\\u0626\\u0637 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a\\u0629 \\u0647\\u0630\\u0647.<\\/p><p><br \\/><\\/p><p>\\u064a\\u0645\\u0643\\u0646\\u0643 \\u0623\\u064a\\u0636\\u064b\\u0627 \\u062a\\u062d\\u0642\\u064a\\u0642 \\u0623\\u0642\\u0635\\u0649 \\u0627\\u0633\\u062a\\u0641\\u0627\\u062f\\u0629 \\u0645\\u0646 \\u0647\\u0630\\u0647 \\u0627\\u0644\\u0623\\u0646\\u0638\\u0645\\u0629 \\u0627\\u0644\\u0623\\u0633\\u0627\\u0633\\u064a\\u0629 \\u0645\\u0646 \\u062e\\u0644\\u0627\\u0644 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0645\\u0639 \\u0627\\u0644\\u0623\\u0634\\u062e\\u0627\\u0635 \\u0648\\u0645\\u0634\\u0627\\u0631\\u0643\\u0629 \\u0627\\u0644\\u0645\\u062d\\u062a\\u0648\\u0649 \\u0627\\u0644\\u062e\\u0627\\u0635 \\u0628\\u0643 \\u0641\\u064a \\u0634\\u0643\\u0644 \\u0641\\u064a\\u062f\\u064a\\u0648 \\u0623\\u0648 \\u0635\\u0648\\u0631\\u0629 \\u0623\\u0648 \\u0646\\u0635 \\u0623\\u0648 \\u0623\\u0643\\u062b\\u0631. \\u0639\\u0646\\u062f\\u0645\\u0627 \\u062a\\u062e\\u062a\\u0627\\u0631 \\u0644\\u0648\\u062d\\u0629 \\u062e\\u062f\\u0645\\u0629 SMM \\u0645\\u0648\\u062b\\u0648\\u0642\\u0629 \\u0648\\u0634\\u0627\\u0626\\u0639\\u0629 \\u060c \\u0633\\u062a\\u0633\\u0627\\u0639\\u062f\\u0643 \\u0639\\u0644\\u0649 \\u062c\\u0630\\u0628 \\u0627\\u0644\\u0645\\u0632\\u064a\\u062f \\u0645\\u0646 \\u0627\\u0644\\u0639\\u0645\\u0644\\u0627\\u0621 \\u0639\\u0628\\u0631 \\u0645\\u0646\\u0635\\u0627\\u062a \\u0627\\u0644\\u0648\\u0633\\u0627\\u0626\\u0637 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a\\u0629 \\u0645\\u062b\\u0644 Facebook \\u0648 Twitter \\u0648 Instagram \\u0648\\u063a\\u064a\\u0631\\u0647\\u0627. \\u064a\\u0639\\u062f \\u0627\\u0644\\u0639\\u062b\\u0648\\u0631 \\u0639\\u0644\\u0649 \\u0623\\u0641\\u0636\\u0644 \\u0644\\u0648\\u062d\\u0629 \\u062e\\u062f\\u0645\\u0629 SMM \\u0645\\u062b\\u0644 Primesmm.com \\u0623\\u0645\\u0631\\u064b\\u0627 \\u0636\\u0631\\u0648\\u0631\\u064a\\u064b\\u0627 \\u0644\\u062a\\u062d\\u0642\\u064a\\u0642 \\u0627\\u0644\\u0646\\u062c\\u0627\\u062d \\u0627\\u0644\\u0645\\u0637\\u0644\\u0648\\u0628.<\\/p>\"}', '2021-03-09 15:34:48', '2021-03-09 15:34:48'),
(161, 23, 9, '{\"title\":\"\\u0645\\u0627 \\u0647\\u064a \\u0627\\u0644\\u062d\\u0627\\u0644\\u0629 \\u0627\\u0644\\u062c\\u0632\\u0626\\u064a\\u0629\\u061f\",\"description\":\"<p>\\u0627\\u0644\\u062d\\u0627\\u0644\\u0629 \\u0627\\u0644\\u062c\\u0632\\u0626\\u064a\\u0629 \\u0647\\u064a \\u0639\\u0646\\u062f\\u0645\\u0627 \\u0646\\u0631\\u062f \\u062c\\u0632\\u0626\\u064a\\u064b\\u0627 \\u0645\\u0627 \\u062a\\u0628\\u0642\\u0649 \\u0645\\u0646 \\u0637\\u0644\\u0628. \\u0641\\u064a \\u0628\\u0639\\u0636 \\u0627\\u0644\\u0623\\u062d\\u064a\\u0627\\u0646 \\u060c \\u0644\\u0628\\u0639\\u0636 \\u0627\\u0644\\u0623\\u0633\\u0628\\u0627\\u0628 \\u060c \\u064a\\u062a\\u0639\\u0630\\u0631 \\u0639\\u0644\\u064a\\u0646\\u0627 \\u062a\\u0633\\u0644\\u064a\\u0645 \\u0637\\u0644\\u0628 \\u0643\\u0627\\u0645\\u0644 \\u060c \\u0644\\u0630\\u0644\\u0643 \\u0646\\u0642\\u0648\\u0645 \\u0628\\u0625\\u0639\\u0627\\u062f\\u0629 \\u0627\\u0644\\u0645\\u0628\\u0644\\u063a \\u0627\\u0644\\u0645\\u062a\\u0628\\u0642\\u064a \\u0627\\u0644\\u0630\\u064a \\u0644\\u0645 \\u064a\\u062a\\u0645 \\u062a\\u0633\\u0644\\u064a\\u0645\\u0647 \\u0625\\u0644\\u064a\\u0643 \\u0645\\u062b\\u0627\\u0644: \\u0644\\u0642\\u062f \\u0627\\u0634\\u062a\\u0631\\u064a\\u062a \\u0637\\u0644\\u0628\\u064b\\u0627 \\u0628\\u0627\\u0644\\u0643\\u0645\\u064a\\u0629 10000 \\u0648\\u062a\\u062d\\u0635\\u064a\\u0644 \\u0631\\u0633\\u0648\\u0645 10 \\u062f\\u0648\\u0644\\u0627\\u0631\\u0627\\u062a \\u060c \\u0641\\u0644\\u0646\\u0641\\u062a\\u0631\\u0636 \\u0623\\u0646\\u0646\\u0627 \\u0633\\u0644\\u0645\\u0646\\u0627 9000 \\u0648\\u0644\\u0645 \\u0646\\u062a\\u0645\\u0643\\u0646 \\u0645\\u0646 \\u062a\\u0633\\u0644\\u064a\\u0645 \\u0627\\u0644\\u0645\\u0628\\u0644\\u063a \\u0627\\u0644\\u0645\\u062a\\u0628\\u0642\\u064a \\u060c \\u062b\\u0645 \\u0633\\u0646\\u0642\\u0648\\u0645 \\\"\\u062c\\u0632\\u0626\\u064a\\u064b\\u0627\\\" \\u0628\\u0631\\u062f \\u0627\\u0644\\u0645\\u0628\\u0644\\u063a \\u0627\\u0644\\u0645\\u062a\\u0628\\u0642\\u064a (1 \\u062f\\u0648\\u0644\\u0627\\u0631) \\u0641\\u064a \\u0647\\u0630\\u0627 \\u0627\\u0644\\u0645\\u062b\\u0627\\u0644).<br \\/><\\/p>\"}', '2021-03-09 15:36:07', '2021-03-09 15:36:07'),
(162, 24, 9, '{\"title\":\"\\u0645\\u0627 \\u0647\\u064a \\u0627\\u0644\\u062a\\u063a\\u0630\\u064a\\u0629 \\u0628\\u0627\\u0644\\u062a\\u0646\\u0642\\u064a\\u0637\\u061f\",\"description\":\"<p>\\u0627\\u0644\\u062a\\u063a\\u0630\\u064a\\u0629 \\u0628\\u0627\\u0644\\u062a\\u0646\\u0642\\u064a\\u0637 \\u0647\\u064a \\u062e\\u062f\\u0645\\u0629 \\u0646\\u0642\\u062f\\u0645\\u0647\\u0627 \\u062d\\u062a\\u0649 \\u062a\\u062a\\u0645\\u0643\\u0646 \\u0645\\u0646 \\u0648\\u0636\\u0639 \\u0646\\u0641\\u0633 \\u0627\\u0644\\u0637\\u0644\\u0628 \\u0639\\u062f\\u0629 \\u0645\\u0631\\u0627\\u062a \\u062a\\u0644\\u0642\\u0627\\u0626\\u064a\\u064b\\u0627. \\u0645\\u062b\\u0627\\u0644: \\u0644\\u0646\\u0641\\u062a\\u0631\\u0636 \\u0623\\u0646\\u0643 \\u062a\\u0631\\u064a\\u062f \\u0627\\u0644\\u062d\\u0635\\u0648\\u0644 \\u0639\\u0644\\u0649 1000 \\u0625\\u0639\\u062c\\u0627\\u0628 \\u0639\\u0644\\u0649 Instagram Post \\u0627\\u0644\\u062e\\u0627\\u0635 \\u0628\\u0643 \\u0648\\u0644\\u0643\\u0646\\u0643 \\u062a\\u0631\\u063a\\u0628 \\u0641\\u064a \\u0627\\u0644\\u062d\\u0635\\u0648\\u0644 \\u0639\\u0644\\u0649 100 \\u0625\\u0639\\u062c\\u0627\\u0628 \\u0643\\u0644 30 \\u062f\\u0642\\u064a\\u0642\\u0629 \\u060c \\u0633\\u062a\\u0636\\u0639 \\u0627\\u0644\\u0631\\u0627\\u0628\\u0637: \\u0631\\u0627\\u0628\\u0637 \\u0627\\u0644\\u0645\\u0646\\u0634\\u0648\\u0631 \\u0627\\u0644\\u062e\\u0627\\u0635 \\u0628\\u0643 \\u0627\\u0644\\u0643\\u0645\\u064a\\u0629: 100 \\u062a\\u0634\\u063a\\u064a\\u0644: 10 (\\u0643\\u0645\\u0627 \\u062a\\u0631\\u064a\\u062f \\u062a\\u0634\\u063a\\u064a\\u0644 \\u0647\\u0630\\u0627 \\u0627\\u0644\\u0637\\u0644\\u0628 10 \\u0645\\u0631\\u0627\\u062a \\u060c \\u0625\\u0630\\u0627 \\u0643\\u0646\\u062a \\u062a\\u0631\\u063a\\u0628 \\u0641\\u064a \\u0627\\u0644\\u062d\\u0635\\u0648\\u0644 \\u0639\\u0644\\u0649 2000 \\u0625\\u0639\\u062c\\u0627\\u0628 \\u060c \\u0641\\u0633\\u0648\\u0641 \\u062a\\u0642\\u0648\\u0645 \\u0628\\u062a\\u0634\\u063a\\u064a\\u0644\\u0647\\u0627 20 \\u0645\\u0631\\u0629 \\u060c \\u0625\\u0644\\u062e ...) \\u0627\\u0644\\u0641\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0632\\u0645\\u0646\\u064a: 30 (\\u0644\\u0623\\u0646\\u0643 \\u062a\\u0631\\u064a\\u062f \\u0627\\u0644\\u062d\\u0635\\u0648\\u0644 \\u0639\\u0644\\u0649 100 \\u0625\\u0639\\u062c\\u0627\\u0628 \\u0639\\u0644\\u0649 \\u0645\\u0646\\u0634\\u0648\\u0631\\u0643 \\u0643\\u0644 30 \\u062f\\u0642\\u064a\\u0642\\u0629 \\u060c \\u0625\\u0630\\u0627 \\u0643\\u0646\\u062a \\u062a\\u0631\\u064a\\u062f \\u0643\\u0644 \\u0633\\u0627\\u0639\\u0629 \\u060c \\u0641\\u0633\\u062a\\u0636\\u0639 60 \\u0644\\u0623\\u0646 \\u0627\\u0644\\u0648\\u0642\\u062a \\u0645\\u0646\\u0627\\u0633\\u0628 \\u0641\\u064a \\u062f\\u0642\\u0627\\u0626\\u0642) \\u0645\\u0644\\u0627\\u062d\\u0638\\u0629: \\u0644\\u0627 \\u062a\\u0637\\u0644\\u0628 \\u0623\\u0628\\u062f\\u064b\\u0627 \\u0643\\u0645\\u064a\\u0629 \\u0623\\u0643\\u0628\\u0631 \\u0645\\u0646 \\u0627\\u0644\\u062d\\u062f \\u0627\\u0644\\u0623\\u0642\\u0635\\u0649 \\u0627\\u0644\\u0645\\u0643\\u062a\\u0648\\u0628 \\u0639\\u0644\\u0649 \\u0627\\u0633\\u0645 \\u0627\\u0644\\u062e\\u062f\\u0645\\u0629 (\\u0627\\u0644\\u0643\\u0645\\u064a\\u0629 \\u00d7 \\u0639\\u0645\\u0644\\u064a\\u0627\\u062a \\u0627\\u0644\\u062a\\u0634\\u063a\\u064a\\u0644) \\u060c \\u0639\\u0644\\u0649 \\u0633\\u0628\\u064a\\u0644 \\u0627\\u0644\\u0645\\u062b\\u0627\\u0644 \\u0625\\u0630\\u0627 \\u0643\\u0627\\u0646 \\u0627\\u0644\\u062d\\u062f \\u0627\\u0644\\u0623\\u0642\\u0635\\u0649 \\u0644\\u0644\\u062e\\u062f\\u0645\\u0629 \\u0647\\u0648 4000 \\u060c \\u0641\\u0644\\u0646 \\u062a\\u0636\\u0639 \\u0627\\u0644\\u0643\\u0645\\u064a\\u0629: 500 \\u0648\\u0627\\u0644\\u062a\\u0634\\u063a\\u064a\\u0644: 10 \\u060c \\u0644\\u0623\\u0646 \\u0627\\u0644\\u0643\\u0645\\u064a\\u0629 \\u0627\\u0644\\u0625\\u062c\\u0645\\u0627\\u0644\\u064a\\u0629 \\u0633\\u0648\\u0641 \\u064a\\u0643\\u0648\\u0646 500 \\u00d7 10 = 5000 \\u0648\\u0647\\u0648 \\u0623\\u0643\\u0628\\u0631 \\u0645\\u0646 \\u0627\\u0644\\u062d\\u062f \\u0627\\u0644\\u0623\\u0642\\u0635\\u0649 \\u0644\\u0644\\u062e\\u062f\\u0645\\u0629 (4000). \\u0644\\u0627 \\u062a\\u0636\\u0639 \\u0627\\u0644\\u0641\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0632\\u0645\\u0646\\u064a \\u0623\\u0628\\u062f\\u064b\\u0627 \\u0623\\u0642\\u0644 \\u0645\\u0646 \\u0648\\u0642\\u062a \\u0627\\u0644\\u0628\\u062f\\u0621 \\u0627\\u0644\\u0641\\u0639\\u0644\\u064a (\\u062a\\u062d\\u062a\\u0627\\u062c \\u0628\\u0639\\u0636 \\u0627\\u0644\\u062e\\u062f\\u0645\\u0627\\u062a \\u0625\\u0644\\u0649 60 \\u062f\\u0642\\u064a\\u0642\\u0629 \\u0644\\u0644\\u0628\\u062f\\u0621 \\u060c \\u0648\\u0644\\u0627 \\u062a\\u0636\\u0639 \\u0627\\u0644\\u0641\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0632\\u0645\\u0646\\u064a \\u0623\\u0642\\u0644 \\u0645\\u0646 \\u0648\\u0642\\u062a \\u0628\\u062f\\u0621 \\u0627\\u0644\\u062e\\u062f\\u0645\\u0629 \\u0648\\u0625\\u0644\\u0627 \\u0641\\u0633\\u0648\\u0641 \\u064a\\u062a\\u0633\\u0628\\u0628 \\u0630\\u0644\\u0643 \\u0641\\u064a \\u0641\\u0634\\u0644 \\u0637\\u0644\\u0628\\u0643).<br \\/><\\/p>\"}', '2021-03-09 15:36:33', '2021-03-09 15:36:33'),
(163, 25, 9, '{\"title\":\"\\u0643\\u064a\\u0641 \\u0623\\u0633\\u062a\\u062e\\u062f\\u0645 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u0634\\u0627\\u0645\\u0644\\u061f\",\"description\":\"<p>\\u062a\\u0636\\u0639 \\u0645\\u0639\\u0631\\u0641 \\u0627\\u0644\\u062e\\u062f\\u0645\\u0629 \\u0645\\u062a\\u0628\\u0648\\u0639\\u064b\\u0627 \\u0628\\u0640 | \\u0645\\u062a\\u0628\\u0648\\u0639\\u064b\\u0627 \\u0628\\u0627\\u0644\\u0631\\u0627\\u0628\\u0637 \\u0645\\u062a\\u0628\\u0648\\u0639\\u064b\\u0627 \\u0628\\u0640 | \\u0645\\u062a\\u0628\\u0648\\u0639\\u064b\\u0627 \\u0628\\u0627\\u0644\\u0643\\u0645\\u064a\\u0629 \\u0641\\u064a \\u0643\\u0644 \\u0633\\u0637\\u0631 \\u0644\\u0644\\u062d\\u0635\\u0648\\u0644 \\u0639\\u0644\\u0649 \\u0645\\u0639\\u0631\\u0641 \\u0627\\u0644\\u062e\\u062f\\u0645\\u0629 \\u0644\\u0644\\u062e\\u062f\\u0645\\u0629 \\u060c \\u064a\\u0631\\u062c\\u0649 \\u0627\\u0644\\u062a\\u062d\\u0642\\u0642 \\u0645\\u0646 \\u0647\\u0646\\u0627: https:\\/\\/justanotherpanel.com\\/services \\u0644\\u0646\\u0641\\u062a\\u0631\\u0636 \\u0623\\u0646\\u0643 \\u062a\\u0631\\u064a\\u062f \\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\u0627\\u0644\\u0637\\u0644\\u0628 \\u0627\\u0644\\u062c\\u0645\\u0627\\u0639\\u064a \\u0644\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0645\\u062a\\u0627\\u0628\\u0639\\u064a\\u0646 Instagram \\u0625\\u0644\\u0649 \\u062d\\u0633\\u0627\\u0628\\u0627\\u062a\\u0643 \\u0627\\u0644\\u062b\\u0644\\u0627\\u062b\\u0629: abcd \\u060c asdf \\u060c qwer \\u0645\\u0646 \\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0644\\u062e\\u062f\\u0645\\u0627\\u062a @ https:\\/\\/justanotherpanel.com\\/services \\u060c \\u0645\\u0639\\u0631\\u0641 \\u0627\\u0644\\u062e\\u062f\\u0645\\u0629 \\u0644\\u0647\\u0630\\u0647 \\u0627\\u0644\\u062e\\u062f\\u0645\\u0629 \\\"\\u0645\\u062a\\u0627\\u0628\\u0639\\u0648 Instagram [15K] [REAL] \\u26a1\\ufe0f\\ud83d\\udca7\\u2b50\\\" \\u0647\\u0648 102 \\u0644\\u0646\\u0641\\u062a\\u0631\\u0636 \\u0623\\u0646\\u0643 \\u062a\\u0631\\u064a\\u062f \\u0625\\u0636\\u0627\\u0641\\u0629 1000 \\u0645\\u062a\\u0627\\u0628\\u0639 \\u0644\\u0643\\u0644 \\u062d\\u0633\\u0627\\u0628 \\u060c \\u0627\\u0644\\u0646\\u0627\\u062a\\u062c \\u0633\\u064a\\u0643\\u0648\\u0646 \\u0645\\u062b\\u0644 \\u0647\\u0630\\u0627: \\u0627\\u0644\\u0645\\u0639\\u0631\\u0641 | \\u0627\\u0644\\u0631\\u0627\\u0628\\u0637 | \\u0627\\u0644\\u0643\\u0645\\u064a\\u0629 \\u0623\\u0648 \\u0641\\u064a \\u0647\\u0630\\u0627 \\u0627\\u0644\\u0645\\u062b\\u0627\\u0644: 102 | abcd | 1000 102 | asdf | 1000102 | qwer | 1000<br \\/><\\/p>\"}', '2021-03-09 15:37:19', '2021-03-09 15:37:19'),
(164, 26, 9, '{\"title\":\"\\u0623\\u0631\\u064a\\u062f \\u0644\\u0648\\u062d\\u0629 \\u0645\\u062b\\u0644 \\u0644\\u0648\\u062d\\u062a\\u0643 \\/ \\u0623\\u0631\\u064a\\u062f \\u0628\\u064a\\u0639 \\u062e\\u062f\\u0645\\u0627\\u062a\\u0643 \\u0643\\u064a\\u0641\\u061f\",\"description\":\"<p>\\u0644\\u0644\\u062d\\u0635\\u0648\\u0644 \\u0639\\u0644\\u0649 \\u0644\\u0648\\u062d\\u0629 \\u0645\\u062b\\u0644 \\u0644\\u0648\\u062d\\u062a\\u0646\\u0627 \\u060c \\u064a\\u0631\\u062c\\u0649 \\u0627\\u0644\\u062a\\u062d\\u0642\\u0642 \\u0645\\u0646 jap \\u0644\\u0627\\u0633\\u062a\\u0626\\u062c\\u0627\\u0631 \\u0644\\u0648\\u062d\\u0629 \\u060c \\u0648\\u0628\\u0639\\u062f \\u0630\\u0644\\u0643 \\u064a\\u0645\\u0643\\u0646\\u0643 \\u0627\\u0644\\u0627\\u062a\\u0635\\u0627\\u0644 \\u0628\\u0646\\u0627 \\u0639\\u0628\\u0631 API \\u0628\\u0633\\u0647\\u0648\\u0644\\u0629!<br \\/><\\/p>\"}', '2021-03-09 15:37:47', '2021-03-09 15:37:47'),
(165, 28, 9, '{\"title\":\"\\u0643\\u064a\\u0641\\u064a\\u0629 \\u0627\\u0644\\u062d\\u0635\\u0648\\u0644 \\u0639\\u0644\\u0649 \\u0631\\u0627\\u0628\\u0637 \\u062a\\u0639\\u0644\\u064a\\u0642 \\u064a\\u0648\\u062a\\u064a\\u0648\\u0628\\u061f\",\"description\":\"<p>\\u0627\\u0628\\u062d\\u062b \\u0639\\u0646 \\u0627\\u0644\\u0637\\u0627\\u0628\\u0639 \\u0627\\u0644\\u0632\\u0645\\u0646\\u064a \\u0627\\u0644\\u0645\\u0648\\u062c\\u0648\\u062f \\u0628\\u062c\\u0648\\u0627\\u0631 \\u0627\\u0633\\u0645 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645 \\u0627\\u0644\\u062e\\u0627\\u0635 \\u0628\\u0643 \\u0623\\u0639\\u0644\\u0649 \\u062a\\u0639\\u0644\\u064a\\u0642\\u0643 (\\u0639\\u0644\\u0649 \\u0633\\u0628\\u064a\\u0644 \\u0627\\u0644\\u0645\\u062b\\u0627\\u0644: \\\"\\u0642\\u0628\\u0644 3 \\u0623\\u064a\\u0627\\u0645\\\") \\u0648\\u0642\\u0645 \\u0628\\u0627\\u0644\\u0645\\u0631\\u0648\\u0631 \\u0641\\u0648\\u0642\\u0647 \\u062b\\u0645 \\u0627\\u0646\\u0642\\u0631 \\u0628\\u0632\\u0631 \\u0627\\u0644\\u0645\\u0627\\u0648\\u0633 \\u0627\\u0644\\u0623\\u064a\\u0645\\u0646 \\u0648 \\\"\\u0646\\u0633\\u062e \\u0639\\u0646\\u0648\\u0627\\u0646 \\u0627\\u0644\\u0631\\u0627\\u0628\\u0637\\\". \\u0633\\u064a\\u0643\\u0648\\u0646 \\u0627\\u0644\\u0631\\u0627\\u0628\\u0637 \\u0645\\u062b\\u0644 \\u0647\\u0630\\u0627: https:\\/\\/www.youtube.com\\/watch\\u061fv=12345&amp;lc=a1b21etc \\u0628\\u062f\\u0644\\u0627\\u064b \\u0645\\u0646 https:\\/\\/www.youtube.com\\/watch\\u061fv=12345 \\u0644\\u0644\\u062a\\u0623\\u0643\\u062f \\u0645\\u0646 \\u062d\\u0635\\u0648\\u0644\\u0643 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0631\\u0627\\u0628\\u0637 \\u0627\\u0644\\u0635\\u062d\\u064a\\u062d \\u060c \\u0627\\u0644\\u0635\\u0642\\u0647 \\u0641\\u064a \\u0634\\u0631\\u064a\\u0637 \\u0639\\u0646\\u0648\\u0627\\u0646 \\u0627\\u0644\\u0645\\u062a\\u0635\\u0641\\u062d \\u0627\\u0644\\u062e\\u0627\\u0635 \\u0628\\u0643 \\u0648\\u0633\\u062a\\u0631\\u0649 \\u0623\\u0646 \\u0627\\u0644\\u062a\\u0639\\u0644\\u064a\\u0642 \\u0647\\u0648 \\u0627\\u0644\\u0622\\u0646 \\u0627\\u0644\\u0623\\u0648\\u0644 \\u0623\\u0633\\u0641\\u0644 \\u0627\\u0644\\u0641\\u064a\\u062f\\u064a\\u0648 \\u0648\\u064a\\u0642\\u0648\\u0644 \\\"\\u062a\\u0639\\u0644\\u064a\\u0642 \\u0645\\u0645\\u064a\\u0632\\\".<br \\/><\\/p>\"}', '2021-03-09 15:38:47', '2021-03-09 15:38:47'),
(166, 30, 9, '{\"title\":\"\\u0645\\u0627 \\u0647\\u0648 \\\"Instagram Saves\\\" \\u0648\\u0645\\u0627\\u0630\\u0627 \\u064a\\u0641\\u0639\\u0644\\u061f\",\"description\":\"<p>Instagram Saves \\u0647\\u0648 \\u0639\\u0646\\u062f\\u0645\\u0627 \\u064a\\u062d\\u0641\\u0638 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645 \\u0645\\u0646\\u0634\\u0648\\u0631\\u064b\\u0627 \\u0641\\u064a \\u0633\\u062c\\u0644\\u0647 \\u0639\\u0644\\u0649 Instagram (\\u0628\\u0627\\u0644\\u0636\\u063a\\u0637 \\u0639\\u0644\\u0649 \\u0632\\u0631 \\u0627\\u0644\\u062d\\u0641\\u0638 \\u0628\\u0627\\u0644\\u0642\\u0631\\u0628 \\u0645\\u0646 \\u0632\\u0631 \\u0627\\u0644\\u0625\\u0639\\u062c\\u0627\\u0628). \\u0627\\u0644\\u0643\\u062b\\u064a\\u0631 \\u0645\\u0646 \\u0639\\u0645\\u0644\\u064a\\u0627\\u062a \\u0627\\u0644\\u062d\\u0641\\u0638 \\u0644\\u0645\\u0646\\u0635\\u0628 \\u0645\\u0627 \\u064a\\u0632\\u064a\\u062f \\u0645\\u0646 \\u0627\\u0646\\u0637\\u0628\\u0627\\u0639\\u0647.<br \\/><\\/p>\"}', '2021-03-09 15:39:55', '2021-03-09 15:39:55'),
(167, 31, 9, '{\"title\":\"\\u064a\\u062c\\u0628 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0627\\u0644\\u0631\\u0627\\u0628\\u0637 \\u0642\\u0628\\u0644 \\u0623\\u0646 \\u064a\\u0628\\u062f\\u0623 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645 \\u0645\\u0628\\u0627\\u0634\\u0631\\u0629 \\u0623\\u0645 \\u0628\\u0639\\u062f\\u0647\\u061f\",\"description\":\"<p>\\u0628\\u0639\\u062f \\u0623\\u0646 \\u064a\\u0628\\u062f\\u0623 \\u0627\\u0644\\u0628\\u062b \\u0627\\u0644\\u0645\\u0628\\u0627\\u0634\\u0631 \\u060c \\u0623\\u0648 \\u0642\\u0628\\u0644 5 \\u062b\\u0648\\u0627\\u0646\\u064d \\u0641\\u0642\\u0637 \\u0645\\u0646 \\u0631\\u062d\\u064a\\u0644\\u0647!<br \\/><\\/p>\"}', '2021-03-09 15:40:35', '2021-03-09 15:40:35'),
(168, 27, 9, '{\"title\":\"\\u0647\\u0644 \\u064a\\u0645\\u0643\\u0646\\u0646\\u064a \\u0627\\u0644\\u062d\\u0635\\u0648\\u0644 \\u0639\\u0644\\u0649 \\u062e\\u0635\\u0645\\u061f\",\"description\":\"<p>\\u0644\\u0627 \\u060c \\u0644\\u0627 \\u0646\\u0642\\u062f\\u0645 \\u0623\\u064a \\u062e\\u0635\\u0645 \\u060c \\u0633\\u0639\\u0631 \\u062e\\u062f\\u0645\\u0627\\u062a\\u0646\\u0627 \\u062b\\u0627\\u0628\\u062a!<br \\/><\\/p>\"}', '2021-03-09 15:43:48', '2021-03-09 15:43:48'),
(169, 37, 9, '{\"title\":\"\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0627\\u0644\\u062f\\u062e\\u0648\\u0644\",\"short_description\":\"<p>\\u0625\\u0646\\u0634\\u0627\\u0621 \\u062d\\u0633\\u0627\\u0628 \\u0647\\u0648 \\u0627\\u0644\\u062e\\u0637\\u0648\\u0629 \\u0627\\u0644\\u0623\\u0648\\u0644\\u0649. \\u0641\\u0623\\u0646\\u062a \\u0628\\u062d\\u0627\\u062c\\u0629 \\u0625\\u0644\\u0649 \\u062a\\u0633\\u062c\\u064a\\u0644 \\u0627\\u0644\\u062f\\u062e\\u0648\\u0644<br \\/><\\/p>\"}', '2021-03-09 15:45:56', '2021-03-09 15:45:56'),
(170, 38, 9, '{\"title\":\"\\u0625\\u0636\\u0627\\u0641\\u0629 \\u062a\\u0645\\u0648\\u064a\\u0644\",\"short_description\":\"<p>\\u0628\\u0639\\u062f \\u0630\\u0644\\u0643 \\u060c \\u0627\\u062e\\u062a\\u0631 \\u0637\\u0631\\u064a\\u0642\\u0629 \\u062f\\u0641\\u0639 \\u0648\\u0623\\u0636\\u0641 \\u0627\\u0644\\u0623\\u0645\\u0648\\u0627\\u0644 \\u0625\\u0644\\u0649 \\u062d\\u0633\\u0627\\u0628\\u0643<br \\/><\\/p>\"}', '2021-03-09 15:46:21', '2021-03-09 15:46:21'),
(171, 39, 9, '{\"title\":\"\\u0627\\u062e\\u062a\\u0631 \\u0627\\u0644\\u062e\\u062f\\u0645\\u0629\",\"short_description\":\"<p>\\u062d\\u062f\\u062f \\u0627\\u0644\\u062e\\u062f\\u0645\\u0627\\u062a \\u0627\\u0644\\u062a\\u064a \\u062a\\u0631\\u064a\\u062f\\u0647\\u0627 \\u0648\\u0627\\u0633\\u062a\\u0639\\u062f \\u0644\\u062a\\u0644\\u0642\\u064a \\u0627\\u0644\\u0645\\u0632\\u064a\\u062f \\u0645\\u0646 \\u0627\\u0644\\u062f\\u0639\\u0627\\u064a\\u0629<br \\/><\\/p>\"}', '2021-03-09 15:46:45', '2021-03-09 15:46:45'),
(172, 40, 9, '{\"title\":\"\\u0627\\u0633\\u062a\\u0645\\u062a\\u0639 \\u0628\\u0627\\u0644\\u0646\\u062a\\u0627\\u0626\\u062c \\u0627\\u0644\\u0641\\u0627\\u0626\\u0642\\u0629\",\"short_description\":\"<p>\\u064a\\u0645\\u0643\\u0646\\u0643 \\u0627\\u0644\\u0627\\u0633\\u062a\\u0645\\u062a\\u0627\\u0639 \\u0628\\u0646\\u062a\\u0627\\u0626\\u062c \\u0645\\u0630\\u0647\\u0644\\u0629 \\u0639\\u0646\\u062f \\u0627\\u0643\\u062a\\u0645\\u0627\\u0644 \\u0637\\u0644\\u0628\\u0643<br \\/><\\/p>\"}', '2021-03-09 15:47:04', '2021-03-09 15:47:04'),
(173, 56, 9, '{\"name\":\"\\u0645\\u0648\\u0642\\u0639 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a \\u0627\\u0644\\u0641\\u064a\\u0633\\u0628\\u0648\\u0643\"}', '2021-03-09 15:47:36', '2021-03-09 15:47:36'),
(174, 58, 9, '{\"name\":\"\\u062a\\u0648\\u064a\\u062a\\u0631\"}', '2021-03-09 15:47:48', '2021-03-09 15:47:48'),
(175, 59, 9, '{\"name\":\"\\u064a\\u0646\\u0643\\u062f\\u064a\\u0646\"}', '2021-03-09 15:48:17', '2021-03-09 15:48:17'),
(176, 60, 9, '{\"name\":\"\\u0627\\u0646\\u0633\\u062a\\u063a\\u0631\\u0627\\u0645\"}', '2021-03-09 15:48:35', '2021-03-09 15:48:35');
INSERT INTO `content_details` (`id`, `content_id`, `language_id`, `description`, `created_at`, `updated_at`) VALUES
(177, 33, 9, '{\"title\":\"\\u0627\\u0644\\u0628\\u0646\\u0648\\u062f \\u0648 \\u0627\\u0644\\u0638\\u0631\\u0648\\u0641\",\"description\":\"<p>\\u0647\\u0646\\u0627\\u0643 \\u062d\\u0642\\u064a\\u0642\\u0629 \\u0645\\u062b\\u0628\\u062a\\u0629 \\u0645\\u0646\\u0630 \\u0632\\u0645\\u0646 \\u0637\\u0648\\u064a\\u0644 \\u0648\\u0647\\u064a \\u0623\\u0646 \\u0627\\u0644\\u0645\\u062d\\u062a\\u0648\\u0649 \\u0627\\u0644\\u0645\\u0642\\u0631\\u0648\\u0621 \\u0644\\u0635\\u0641\\u062d\\u0629 \\u0645\\u0627 \\u0633\\u064a\\u0644\\u0647\\u064a \\u0627\\u0644\\u0642\\u0627\\u0631\\u0626 \\u0639\\u0646 \\u0627\\u0644\\u062a\\u0631\\u0643\\u064a\\u0632 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0634\\u0643\\u0644 \\u0627\\u0644\\u062e\\u0627\\u0631\\u062c\\u064a \\u0644\\u0644\\u0646\\u0635 \\u0623\\u0648 \\u0634\\u0643\\u0644 \\u062a\\u0648\\u0636\\u0639 \\u0627\\u0644\\u0641\\u0642\\u0631\\u0627\\u062a \\u0641\\u064a \\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 \\u0627\\u0644\\u062a\\u064a \\u064a\\u0642\\u0631\\u0623\\u0647\\u0627. \\u0627\\u0644\\u0647\\u062f\\u0641 \\u0645\\u0646 \\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\u0644\\u0648\\u0631\\u064a\\u0645 \\u0625\\u064a\\u0628\\u0633\\u0648\\u0645 \\u0647\\u0648 \\u0623\\u0646\\u0647 \\u064a\\u062d\\u062a\\u0648\\u064a \\u0639\\u0644\\u0649 \\u062a\\u0648\\u0632\\u064a\\u0639 \\u0637\\u0628\\u064a\\u0639\\u064a -\\u0625\\u0644\\u0649 \\u062d\\u062f \\u0645\\u0627- \\u0644\\u0644\\u0623\\u062d\\u0631\\u0641 \\u060c \\u0628\\u062f\\u0644\\u0627\\u064b \\u0645\\u0646 \\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\\"\\u0647\\u0646\\u0627 \\u064a\\u0648\\u062c\\u062f \\u0645\\u062d\\u062a\\u0648\\u0649 \\u0646\\u0635\\u064a \\u060c \\u0647\\u0646\\u0627 \\u064a\\u0648\\u062c\\u062f \\u0645\\u062d\\u062a\\u0648\\u0649 \\u0646\\u0635\\u064a\\\" \\u060c \\u0645\\u0645\\u0627 \\u064a\\u062c\\u0639\\u0644\\u0647\\u0627 \\u062a\\u0628\\u062f\\u0648 \\u0648\\u0643\\u0623\\u0646\\u0647\\u0627 \\u0625\\u0646\\u062c\\u0644\\u064a\\u0632\\u064a\\u0629 \\u0642\\u0627\\u0628\\u0644\\u0629 \\u0644\\u0644\\u0642\\u0631\\u0627\\u0621\\u0629. \\u062a\\u0633\\u062a\\u062e\\u062f\\u0645 \\u0627\\u0644\\u0639\\u062f\\u064a\\u062f \\u0645\\u0646 \\u062d\\u0632\\u0645 \\u0627\\u0644\\u0646\\u0634\\u0631 \\u0627\\u0644\\u0645\\u0643\\u062a\\u0628\\u064a \\u0648\\u0645\\u062d\\u0631\\u0631\\u064a \\u0635\\u0641\\u062d\\u0627\\u062a \\u0627\\u0644\\u0648\\u064a\\u0628 \\u0627\\u0644\\u0622\\u0646 Lorem Ipsum \\u0643\\u0646\\u0635 \\u0646\\u0645\\u0648\\u0630\\u062c \\u0627\\u0641\\u062a\\u0631\\u0627\\u0636\\u064a \\u060c \\u0648\\u0633\\u064a\\u0643\\u0634\\u0641 \\u0627\\u0644\\u0628\\u062d\\u062b \\u0639\\u0646 \\\"lorem ipsum\\\" \\u0639\\u0646 \\u0627\\u0644\\u0639\\u062f\\u064a\\u062f \\u0645\\u0646 \\u0645\\u0648\\u0627\\u0642\\u0639 \\u0627\\u0644\\u0648\\u064a\\u0628 \\u0627\\u0644\\u062a\\u064a \\u0644\\u0627 \\u062a\\u0632\\u0627\\u0644 \\u0641\\u064a \\u0645\\u0647\\u062f\\u0647\\u0627. \\u062a\\u0637\\u0648\\u0631\\u062a \\u0625\\u0635\\u062f\\u0627\\u0631\\u0627\\u062a \\u0645\\u062e\\u062a\\u0644\\u0641\\u0629 \\u0639\\u0644\\u0649 \\u0645\\u0631 \\u0627\\u0644\\u0633\\u0646\\u064a\\u0646 \\u060c \\u0623\\u062d\\u064a\\u0627\\u0646\\u064b\\u0627 \\u0639\\u0646 \\u0637\\u0631\\u064a\\u0642 \\u0627\\u0644\\u0635\\u062f\\u0641\\u0629 \\u060c \\u0648\\u0623\\u062d\\u064a\\u0627\\u0646\\u064b\\u0627 \\u0639\\u0646 \\u0642\\u0635\\u062f (\\u0631\\u0648\\u062d \\u0627\\u0644\\u062f\\u0639\\u0627\\u0628\\u0629 \\u0627\\u0644\\u0645\\u062d\\u0642\\u0648\\u0646\\u0629 \\u0648\\u0645\\u0627 \\u0634\\u0627\\u0628\\u0647 \\u0630\\u0644\\u0643). \\u0647\\u0646\\u0627\\u0643 \\u062d\\u0642\\u064a\\u0642\\u0629 \\u0645\\u062b\\u0628\\u062a\\u0629 \\u0645\\u0646\\u0630 \\u0632\\u0645\\u0646 \\u0637\\u0648\\u064a\\u0644 \\u0648\\u0647\\u064a \\u0623\\u0646 \\u0627\\u0644\\u0645\\u062d\\u062a\\u0648\\u0649 \\u0627\\u0644\\u0645\\u0642\\u0631\\u0648\\u0621 \\u0644\\u0635\\u0641\\u062d\\u0629 \\u0645\\u0627 \\u0633\\u064a\\u0644\\u0647\\u064a \\u0627\\u0644\\u0642\\u0627\\u0631\\u0626 \\u0639\\u0646 \\u0627\\u0644\\u062a\\u0631\\u0643\\u064a\\u0632 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0634\\u0643\\u0644 \\u0627\\u0644\\u062e\\u0627\\u0631\\u062c\\u064a \\u0644\\u0644\\u0646\\u0635 \\u0623\\u0648 \\u0634\\u0643\\u0644 \\u062a\\u0648\\u0636\\u0639 \\u0627\\u0644\\u0641\\u0642\\u0631\\u0627\\u062a \\u0641\\u064a \\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 \\u0627\\u0644\\u062a\\u064a \\u064a\\u0642\\u0631\\u0623\\u0647\\u0627.<\\/p><p><br \\/><\\/p><p><br \\/><\\/p><p><br \\/><\\/p><p>\\u0627\\u0644\\u0647\\u062f\\u0641 \\u0645\\u0646 \\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\u0644\\u0648\\u0631\\u064a\\u0645 \\u0625\\u064a\\u0628\\u0633\\u0648\\u0645 \\u0647\\u0648 \\u0623\\u0646\\u0647 \\u064a\\u062d\\u062a\\u0648\\u064a \\u0639\\u0644\\u0649 \\u062a\\u0648\\u0632\\u064a\\u0639 \\u0637\\u0628\\u064a\\u0639\\u064a -\\u0625\\u0644\\u0649 \\u062d\\u062f \\u0645\\u0627- \\u0644\\u0644\\u0623\\u062d\\u0631\\u0641 \\u060c \\u0628\\u062f\\u0644\\u0627\\u064b \\u0645\\u0646 \\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\\"\\u0647\\u0646\\u0627 \\u064a\\u0648\\u062c\\u062f \\u0645\\u062d\\u062a\\u0648\\u0649 \\u0646\\u0635\\u064a \\u060c \\u0647\\u0646\\u0627 \\u064a\\u0648\\u062c\\u062f \\u0645\\u062d\\u062a\\u0648\\u0649 \\u0646\\u0635\\u064a\\\" \\u060c \\u0645\\u0645\\u0627 \\u064a\\u062c\\u0639\\u0644\\u0647\\u0627 \\u062a\\u0628\\u062f\\u0648 \\u0648\\u0643\\u0623\\u0646\\u0647\\u0627 \\u0625\\u0646\\u062c\\u0644\\u064a\\u0632\\u064a\\u0629 \\u0642\\u0627\\u0628\\u0644\\u0629 \\u0644\\u0644\\u0642\\u0631\\u0627\\u0621\\u0629. \\u062a\\u0633\\u062a\\u062e\\u062f\\u0645 \\u0627\\u0644\\u0639\\u062f\\u064a\\u062f \\u0645\\u0646 \\u062d\\u0632\\u0645 \\u0627\\u0644\\u0646\\u0634\\u0631 \\u0627\\u0644\\u0645\\u0643\\u062a\\u0628\\u064a \\u0648\\u0645\\u062d\\u0631\\u0631\\u064a \\u0635\\u0641\\u062d\\u0627\\u062a \\u0627\\u0644\\u0648\\u064a\\u0628 \\u0627\\u0644\\u0622\\u0646 Lorem Ipsum \\u0643\\u0646\\u0635 \\u0646\\u0645\\u0648\\u0630\\u062c \\u0627\\u0641\\u062a\\u0631\\u0627\\u0636\\u064a \\u060c \\u0648\\u0633\\u064a\\u0643\\u0634\\u0641 \\u0627\\u0644\\u0628\\u062d\\u062b \\u0639\\u0646 \\\"lorem ipsum\\\" \\u0639\\u0646 \\u0627\\u0644\\u0639\\u062f\\u064a\\u062f \\u0645\\u0646 \\u0645\\u0648\\u0627\\u0642\\u0639 \\u0627\\u0644\\u0648\\u064a\\u0628 \\u0627\\u0644\\u062a\\u064a \\u0644\\u0627 \\u062a\\u0632\\u0627\\u0644 \\u0641\\u064a \\u0645\\u0647\\u062f\\u0647\\u0627. \\u062a\\u0637\\u0648\\u0631\\u062a \\u0625\\u0635\\u062f\\u0627\\u0631\\u0627\\u062a \\u0645\\u062e\\u062a\\u0644\\u0641\\u0629 \\u0639\\u0644\\u0649 \\u0645\\u0631 \\u0627\\u0644\\u0633\\u0646\\u064a\\u0646 \\u060c \\u0623\\u062d\\u064a\\u0627\\u0646\\u064b\\u0627 \\u0639\\u0646 \\u0637\\u0631\\u064a\\u0642 \\u0627\\u0644\\u0635\\u062f\\u0641\\u0629 \\u060c \\u0648\\u0623\\u062d\\u064a\\u0627\\u0646\\u064b\\u0627 \\u0639\\u0646 \\u0642\\u0635\\u062f (\\u0631\\u0648\\u062d \\u0627\\u0644\\u062f\\u0639\\u0627\\u0628\\u0629 \\u0627\\u0644\\u0645\\u062d\\u0642\\u0648\\u0646\\u0629 \\u0648\\u0645\\u0627 \\u0634\\u0627\\u0628\\u0647 \\u0630\\u0644\\u0643). \\u0647\\u0646\\u0627\\u0643 \\u062d\\u0642\\u064a\\u0642\\u0629 \\u0645\\u062b\\u0628\\u062a\\u0629 \\u0645\\u0646\\u0630 \\u0632\\u0645\\u0646 \\u0637\\u0648\\u064a\\u0644 \\u0648\\u0647\\u064a \\u0623\\u0646 \\u0627\\u0644\\u0645\\u062d\\u062a\\u0648\\u0649 \\u0627\\u0644\\u0645\\u0642\\u0631\\u0648\\u0621 \\u0644\\u0635\\u0641\\u062d\\u0629 \\u0645\\u0627 \\u0633\\u064a\\u0644\\u0647\\u064a \\u0627\\u0644\\u0642\\u0627\\u0631\\u0626 \\u0639\\u0646 \\u0627\\u0644\\u062a\\u0631\\u0643\\u064a\\u0632 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0634\\u0643\\u0644 \\u0627\\u0644\\u062e\\u0627\\u0631\\u062c\\u064a \\u0644\\u0644\\u0646\\u0635 \\u0623\\u0648 \\u0634\\u0643\\u0644 \\u062a\\u0648\\u0636\\u0639 \\u0627\\u0644\\u0641\\u0642\\u0631\\u0627\\u062a \\u0641\\u064a \\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 \\u0627\\u0644\\u062a\\u064a \\u064a\\u0642\\u0631\\u0623\\u0647\\u0627. \\u0627\\u0644\\u0647\\u062f\\u0641 \\u0645\\u0646 \\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\u0644\\u0648\\u0631\\u064a\\u0645 \\u0625\\u064a\\u0628\\u0633\\u0648\\u0645 \\u0647\\u0648 \\u0623\\u0646\\u0647 \\u064a\\u062d\\u062a\\u0648\\u064a \\u0639\\u0644\\u0649 \\u062a\\u0648\\u0632\\u064a\\u0639 \\u0637\\u0628\\u064a\\u0639\\u064a -\\u0625\\u0644\\u0649 \\u062d\\u062f \\u0645\\u0627- \\u0644\\u0644\\u0623\\u062d\\u0631\\u0641 \\u060c \\u0628\\u062f\\u0644\\u0627\\u064b \\u0645\\u0646 \\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\\"\\u0647\\u0646\\u0627 \\u064a\\u0648\\u062c\\u062f \\u0645\\u062d\\u062a\\u0648\\u0649 \\u0646\\u0635\\u064a \\u060c \\u0647\\u0646\\u0627 \\u064a\\u0648\\u062c\\u062f \\u0645\\u062d\\u062a\\u0648\\u0649 \\u0646\\u0635\\u064a\\\" \\u060c \\u0645\\u0645\\u0627 \\u064a\\u062c\\u0639\\u0644\\u0647\\u0627 \\u062a\\u0628\\u062f\\u0648 \\u0648\\u0643\\u0623\\u0646\\u0647\\u0627 \\u0625\\u0646\\u062c\\u0644\\u064a\\u0632\\u064a\\u0629 \\u0642\\u0627\\u0628\\u0644\\u0629 \\u0644\\u0644\\u0642\\u0631\\u0627\\u0621\\u0629. \\u062a\\u0633\\u062a\\u062e\\u062f\\u0645 \\u0627\\u0644\\u0639\\u062f\\u064a\\u062f \\u0645\\u0646 \\u062d\\u0632\\u0645 \\u0627\\u0644\\u0646\\u0634\\u0631 \\u0627\\u0644\\u0645\\u0643\\u062a\\u0628\\u064a \\u0648\\u0645\\u062d\\u0631\\u0631\\u064a \\u0635\\u0641\\u062d\\u0627\\u062a \\u0627\\u0644\\u0648\\u064a\\u0628 \\u0627\\u0644\\u0622\\u0646 Lorem Ipsum \\u0643\\u0646\\u0635 \\u0646\\u0645\\u0648\\u0630\\u062c \\u0627\\u0641\\u062a\\u0631\\u0627\\u0636\\u064a \\u060c \\u0648\\u0633\\u064a\\u0643\\u0634\\u0641 \\u0627\\u0644\\u0628\\u062d\\u062b \\u0639\\u0646 \\\"lorem ipsum\\\" \\u0639\\u0646 \\u0627\\u0644\\u0639\\u062f\\u064a\\u062f \\u0645\\u0646 \\u0645\\u0648\\u0627\\u0642\\u0639 \\u0627\\u0644\\u0648\\u064a\\u0628 \\u0627\\u0644\\u062a\\u064a \\u0644\\u0627 \\u062a\\u0632\\u0627\\u0644 \\u0641\\u064a \\u0645\\u0647\\u062f\\u0647\\u0627. \\u062a\\u0637\\u0648\\u0631\\u062a \\u0625\\u0635\\u062f\\u0627\\u0631\\u0627\\u062a \\u0645\\u062e\\u062a\\u0644\\u0641\\u0629 \\u0639\\u0644\\u0649 \\u0645\\u0631 \\u0627\\u0644\\u0633\\u0646\\u064a\\u0646 \\u060c \\u0623\\u062d\\u064a\\u0627\\u0646\\u064b\\u0627 \\u0639\\u0646 \\u0637\\u0631\\u064a\\u0642 \\u0627\\u0644\\u0635\\u062f\\u0641\\u0629 \\u060c \\u0648\\u0623\\u062d\\u064a\\u0627\\u0646\\u064b\\u0627 \\u0639\\u0646 \\u0642\\u0635\\u062f (\\u0631\\u0648\\u062d \\u0627\\u0644\\u062f\\u0639\\u0627\\u0628\\u0629 \\u0627\\u0644\\u0645\\u062d\\u0642\\u0648\\u0646\\u0629 \\u0648\\u0645\\u0627 \\u0634\\u0627\\u0628\\u0647 \\u0630\\u0644\\u0643).<\\/p>\"}', '2021-03-09 15:50:21', '2021-03-09 15:50:21'),
(178, 35, 9, '{\"title\":\"\\u0633\\u064a\\u0627\\u0633\\u0629 \\u0627\\u0644\\u0627\\u0633\\u062a\\u0631\\u062c\\u0627\\u0639\",\"description\":\"<p>\\u0647\\u0646\\u0627\\u0643 \\u062d\\u0642\\u064a\\u0642\\u0629 \\u0645\\u062b\\u0628\\u062a\\u0629 \\u0645\\u0646\\u0630 \\u0632\\u0645\\u0646 \\u0637\\u0648\\u064a\\u0644 \\u0648\\u0647\\u064a \\u0623\\u0646 \\u0627\\u0644\\u0645\\u062d\\u062a\\u0648\\u0649 \\u0627\\u0644\\u0645\\u0642\\u0631\\u0648\\u0621 \\u0644\\u0635\\u0641\\u062d\\u0629 \\u0645\\u0627 \\u0633\\u064a\\u0644\\u0647\\u064a \\u0627\\u0644\\u0642\\u0627\\u0631\\u0626 \\u0639\\u0646 \\u0627\\u0644\\u062a\\u0631\\u0643\\u064a\\u0632 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0634\\u0643\\u0644 \\u0627\\u0644\\u062e\\u0627\\u0631\\u062c\\u064a \\u0644\\u0644\\u0646\\u0635 \\u0623\\u0648 \\u0634\\u0643\\u0644 \\u062a\\u0648\\u0636\\u0639 \\u0627\\u0644\\u0641\\u0642\\u0631\\u0627\\u062a \\u0641\\u064a \\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 \\u0627\\u0644\\u062a\\u064a \\u064a\\u0642\\u0631\\u0623\\u0647\\u0627. \\u0627\\u0644\\u0647\\u062f\\u0641 \\u0645\\u0646 \\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\u0644\\u0648\\u0631\\u064a\\u0645 \\u0625\\u064a\\u0628\\u0633\\u0648\\u0645 \\u0647\\u0648 \\u0623\\u0646\\u0647 \\u064a\\u062d\\u062a\\u0648\\u064a \\u0639\\u0644\\u0649 \\u062a\\u0648\\u0632\\u064a\\u0639 \\u0637\\u0628\\u064a\\u0639\\u064a -\\u0625\\u0644\\u0649 \\u062d\\u062f \\u0645\\u0627- \\u0644\\u0644\\u0623\\u062d\\u0631\\u0641 \\u060c \\u0628\\u062f\\u0644\\u0627\\u064b \\u0645\\u0646 \\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\\"\\u0647\\u0646\\u0627 \\u064a\\u0648\\u062c\\u062f \\u0645\\u062d\\u062a\\u0648\\u0649 \\u0646\\u0635\\u064a \\u060c \\u0647\\u0646\\u0627 \\u064a\\u0648\\u062c\\u062f \\u0645\\u062d\\u062a\\u0648\\u0649 \\u0646\\u0635\\u064a\\\" \\u060c \\u0645\\u0645\\u0627 \\u064a\\u062c\\u0639\\u0644\\u0647\\u0627 \\u062a\\u0628\\u062f\\u0648 \\u0648\\u0643\\u0623\\u0646\\u0647\\u0627 \\u0625\\u0646\\u062c\\u0644\\u064a\\u0632\\u064a\\u0629 \\u0642\\u0627\\u0628\\u0644\\u0629 \\u0644\\u0644\\u0642\\u0631\\u0627\\u0621\\u0629. \\u062a\\u0633\\u062a\\u062e\\u062f\\u0645 \\u0627\\u0644\\u0639\\u062f\\u064a\\u062f \\u0645\\u0646 \\u062d\\u0632\\u0645 \\u0627\\u0644\\u0646\\u0634\\u0631 \\u0627\\u0644\\u0645\\u0643\\u062a\\u0628\\u064a \\u0648\\u0645\\u062d\\u0631\\u0631\\u064a \\u0635\\u0641\\u062d\\u0627\\u062a \\u0627\\u0644\\u0648\\u064a\\u0628 \\u0627\\u0644\\u0622\\u0646 Lorem Ipsum \\u0643\\u0646\\u0635 \\u0646\\u0645\\u0648\\u0630\\u062c \\u0627\\u0641\\u062a\\u0631\\u0627\\u0636\\u064a \\u060c \\u0648\\u0633\\u064a\\u0643\\u0634\\u0641 \\u0627\\u0644\\u0628\\u062d\\u062b \\u0639\\u0646 \\\"lorem ipsum\\\" \\u0639\\u0646 \\u0627\\u0644\\u0639\\u062f\\u064a\\u062f \\u0645\\u0646 \\u0645\\u0648\\u0627\\u0642\\u0639 \\u0627\\u0644\\u0648\\u064a\\u0628 \\u0627\\u0644\\u062a\\u064a \\u0644\\u0627 \\u062a\\u0632\\u0627\\u0644 \\u0641\\u064a \\u0645\\u0647\\u062f\\u0647\\u0627. \\u062a\\u0637\\u0648\\u0631\\u062a \\u0625\\u0635\\u062f\\u0627\\u0631\\u0627\\u062a \\u0645\\u062e\\u062a\\u0644\\u0641\\u0629 \\u0639\\u0644\\u0649 \\u0645\\u0631 \\u0627\\u0644\\u0633\\u0646\\u064a\\u0646 \\u060c \\u0623\\u062d\\u064a\\u0627\\u0646\\u064b\\u0627 \\u0639\\u0646 \\u0637\\u0631\\u064a\\u0642 \\u0627\\u0644\\u0635\\u062f\\u0641\\u0629 \\u060c \\u0648\\u0623\\u062d\\u064a\\u0627\\u0646\\u064b\\u0627 \\u0639\\u0646 \\u0642\\u0635\\u062f (\\u0631\\u0648\\u062d \\u0627\\u0644\\u062f\\u0639\\u0627\\u0628\\u0629 \\u0627\\u0644\\u0645\\u062d\\u0642\\u0648\\u0646\\u0629 \\u0648\\u0645\\u0627 \\u0634\\u0627\\u0628\\u0647 \\u0630\\u0644\\u0643). \\u0647\\u0646\\u0627\\u0643 \\u062d\\u0642\\u064a\\u0642\\u0629 \\u0645\\u062b\\u0628\\u062a\\u0629 \\u0645\\u0646\\u0630 \\u0632\\u0645\\u0646 \\u0637\\u0648\\u064a\\u0644 \\u0648\\u0647\\u064a \\u0623\\u0646 \\u0627\\u0644\\u0645\\u062d\\u062a\\u0648\\u0649 \\u0627\\u0644\\u0645\\u0642\\u0631\\u0648\\u0621 \\u0644\\u0635\\u0641\\u062d\\u0629 \\u0645\\u0627 \\u0633\\u064a\\u0644\\u0647\\u064a \\u0627\\u0644\\u0642\\u0627\\u0631\\u0626 \\u0639\\u0646 \\u0627\\u0644\\u062a\\u0631\\u0643\\u064a\\u0632 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0634\\u0643\\u0644 \\u0627\\u0644\\u062e\\u0627\\u0631\\u062c\\u064a \\u0644\\u0644\\u0646\\u0635 \\u0623\\u0648 \\u0634\\u0643\\u0644 \\u062a\\u0648\\u0636\\u0639 \\u0627\\u0644\\u0641\\u0642\\u0631\\u0627\\u062a \\u0641\\u064a \\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 \\u0627\\u0644\\u062a\\u064a \\u064a\\u0642\\u0631\\u0623\\u0647\\u0627.<\\/p><p><br \\/><\\/p><p><br \\/><\\/p><p><br \\/><\\/p><p>\\u0627\\u0644\\u0647\\u062f\\u0641 \\u0645\\u0646 \\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\u0644\\u0648\\u0631\\u064a\\u0645 \\u0625\\u064a\\u0628\\u0633\\u0648\\u0645 \\u0647\\u0648 \\u0623\\u0646\\u0647 \\u064a\\u062d\\u062a\\u0648\\u064a \\u0639\\u0644\\u0649 \\u062a\\u0648\\u0632\\u064a\\u0639 \\u0637\\u0628\\u064a\\u0639\\u064a -\\u0625\\u0644\\u0649 \\u062d\\u062f \\u0645\\u0627- \\u0644\\u0644\\u0623\\u062d\\u0631\\u0641 \\u060c \\u0628\\u062f\\u0644\\u0627\\u064b \\u0645\\u0646 \\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\\"\\u0647\\u0646\\u0627 \\u064a\\u0648\\u062c\\u062f \\u0645\\u062d\\u062a\\u0648\\u0649 \\u0646\\u0635\\u064a \\u060c \\u0647\\u0646\\u0627 \\u064a\\u0648\\u062c\\u062f \\u0645\\u062d\\u062a\\u0648\\u0649 \\u0646\\u0635\\u064a\\\" \\u060c \\u0645\\u0645\\u0627 \\u064a\\u062c\\u0639\\u0644\\u0647\\u0627 \\u062a\\u0628\\u062f\\u0648 \\u0648\\u0643\\u0623\\u0646\\u0647\\u0627 \\u0625\\u0646\\u062c\\u0644\\u064a\\u0632\\u064a\\u0629 \\u0642\\u0627\\u0628\\u0644\\u0629 \\u0644\\u0644\\u0642\\u0631\\u0627\\u0621\\u0629. \\u062a\\u0633\\u062a\\u062e\\u062f\\u0645 \\u0627\\u0644\\u0639\\u062f\\u064a\\u062f \\u0645\\u0646 \\u062d\\u0632\\u0645 \\u0627\\u0644\\u0646\\u0634\\u0631 \\u0627\\u0644\\u0645\\u0643\\u062a\\u0628\\u064a \\u0648\\u0645\\u062d\\u0631\\u0631\\u064a \\u0635\\u0641\\u062d\\u0627\\u062a \\u0627\\u0644\\u0648\\u064a\\u0628 \\u0627\\u0644\\u0622\\u0646 Lorem Ipsum \\u0643\\u0646\\u0635 \\u0646\\u0645\\u0648\\u0630\\u062c \\u0627\\u0641\\u062a\\u0631\\u0627\\u0636\\u064a \\u060c \\u0648\\u0633\\u064a\\u0643\\u0634\\u0641 \\u0627\\u0644\\u0628\\u062d\\u062b \\u0639\\u0646 \\\"lorem ipsum\\\" \\u0639\\u0646 \\u0627\\u0644\\u0639\\u062f\\u064a\\u062f \\u0645\\u0646 \\u0645\\u0648\\u0627\\u0642\\u0639 \\u0627\\u0644\\u0648\\u064a\\u0628 \\u0627\\u0644\\u062a\\u064a \\u0644\\u0627 \\u062a\\u0632\\u0627\\u0644 \\u0641\\u064a \\u0645\\u0647\\u062f\\u0647\\u0627. \\u062a\\u0637\\u0648\\u0631\\u062a \\u0625\\u0635\\u062f\\u0627\\u0631\\u0627\\u062a \\u0645\\u062e\\u062a\\u0644\\u0641\\u0629 \\u0639\\u0644\\u0649 \\u0645\\u0631 \\u0627\\u0644\\u0633\\u0646\\u064a\\u0646 \\u060c \\u0623\\u062d\\u064a\\u0627\\u0646\\u064b\\u0627 \\u0639\\u0646 \\u0637\\u0631\\u064a\\u0642 \\u0627\\u0644\\u0635\\u062f\\u0641\\u0629 \\u060c \\u0648\\u0623\\u062d\\u064a\\u0627\\u0646\\u064b\\u0627 \\u0639\\u0646 \\u0642\\u0635\\u062f (\\u0631\\u0648\\u062d \\u0627\\u0644\\u062f\\u0639\\u0627\\u0628\\u0629 \\u0627\\u0644\\u0645\\u062d\\u0642\\u0648\\u0646\\u0629 \\u0648\\u0645\\u0627 \\u0634\\u0627\\u0628\\u0647 \\u0630\\u0644\\u0643). \\u0647\\u0646\\u0627\\u0643 \\u062d\\u0642\\u064a\\u0642\\u0629 \\u0645\\u062b\\u0628\\u062a\\u0629 \\u0645\\u0646\\u0630 \\u0632\\u0645\\u0646 \\u0637\\u0648\\u064a\\u0644 \\u0648\\u0647\\u064a \\u0623\\u0646 \\u0627\\u0644\\u0645\\u062d\\u062a\\u0648\\u0649 \\u0627\\u0644\\u0645\\u0642\\u0631\\u0648\\u0621 \\u0644\\u0635\\u0641\\u062d\\u0629 \\u0645\\u0627 \\u0633\\u064a\\u0644\\u0647\\u064a \\u0627\\u0644\\u0642\\u0627\\u0631\\u0626 \\u0639\\u0646 \\u0627\\u0644\\u062a\\u0631\\u0643\\u064a\\u0632 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0634\\u0643\\u0644 \\u0627\\u0644\\u062e\\u0627\\u0631\\u062c\\u064a \\u0644\\u0644\\u0646\\u0635 \\u0623\\u0648 \\u0634\\u0643\\u0644 \\u062a\\u0648\\u0636\\u0639 \\u0627\\u0644\\u0641\\u0642\\u0631\\u0627\\u062a \\u0641\\u064a \\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 \\u0627\\u0644\\u062a\\u064a \\u064a\\u0642\\u0631\\u0623\\u0647\\u0627. \\u0627\\u0644\\u0647\\u062f\\u0641 \\u0645\\u0646 \\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\u0644\\u0648\\u0631\\u064a\\u0645 \\u0625\\u064a\\u0628\\u0633\\u0648\\u0645 \\u0647\\u0648 \\u0623\\u0646\\u0647 \\u064a\\u062d\\u062a\\u0648\\u064a \\u0639\\u0644\\u0649 \\u062a\\u0648\\u0632\\u064a\\u0639 \\u0637\\u0628\\u064a\\u0639\\u064a -\\u0625\\u0644\\u0649 \\u062d\\u062f \\u0645\\u0627- \\u0644\\u0644\\u0623\\u062d\\u0631\\u0641 \\u060c \\u0628\\u062f\\u0644\\u0627\\u064b \\u0645\\u0646 \\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\\"\\u0647\\u0646\\u0627 \\u064a\\u0648\\u062c\\u062f \\u0645\\u062d\\u062a\\u0648\\u0649 \\u0646\\u0635\\u064a \\u060c \\u0647\\u0646\\u0627 \\u064a\\u0648\\u062c\\u062f \\u0645\\u062d\\u062a\\u0648\\u0649 \\u0646\\u0635\\u064a\\\" \\u060c \\u0645\\u0645\\u0627 \\u064a\\u062c\\u0639\\u0644\\u0647\\u0627 \\u062a\\u0628\\u062f\\u0648 \\u0648\\u0643\\u0623\\u0646\\u0647\\u0627 \\u0625\\u0646\\u062c\\u0644\\u064a\\u0632\\u064a\\u0629 \\u0642\\u0627\\u0628\\u0644\\u0629 \\u0644\\u0644\\u0642\\u0631\\u0627\\u0621\\u0629. \\u062a\\u0633\\u062a\\u062e\\u062f\\u0645 \\u0627\\u0644\\u0639\\u062f\\u064a\\u062f \\u0645\\u0646 \\u062d\\u0632\\u0645 \\u0627\\u0644\\u0646\\u0634\\u0631 \\u0627\\u0644\\u0645\\u0643\\u062a\\u0628\\u064a \\u0648\\u0645\\u062d\\u0631\\u0631\\u064a \\u0635\\u0641\\u062d\\u0627\\u062a \\u0627\\u0644\\u0648\\u064a\\u0628 \\u0627\\u0644\\u0622\\u0646 Lorem Ipsum \\u0643\\u0646\\u0635 \\u0646\\u0645\\u0648\\u0630\\u062c \\u0627\\u0641\\u062a\\u0631\\u0627\\u0636\\u064a \\u060c \\u0648\\u0633\\u064a\\u0643\\u0634\\u0641 \\u0627\\u0644\\u0628\\u062d\\u062b \\u0639\\u0646 \\\"lorem ipsum\\\" \\u0639\\u0646 \\u0627\\u0644\\u0639\\u062f\\u064a\\u062f \\u0645\\u0646 \\u0645\\u0648\\u0627\\u0642\\u0639 \\u0627\\u0644\\u0648\\u064a\\u0628 \\u0627\\u0644\\u062a\\u064a \\u0644\\u0627 \\u062a\\u0632\\u0627\\u0644 \\u0641\\u064a \\u0645\\u0647\\u062f\\u0647\\u0627. \\u062a\\u0637\\u0648\\u0631\\u062a \\u0625\\u0635\\u062f\\u0627\\u0631\\u0627\\u062a \\u0645\\u062e\\u062a\\u0644\\u0641\\u0629 \\u0639\\u0644\\u0649 \\u0645\\u0631 \\u0627\\u0644\\u0633\\u0646\\u064a\\u0646 \\u060c \\u0623\\u062d\\u064a\\u0627\\u0646\\u064b\\u0627 \\u0639\\u0646 \\u0637\\u0631\\u064a\\u0642 \\u0627\\u0644\\u0635\\u062f\\u0641\\u0629 \\u060c \\u0648\\u0623\\u062d\\u064a\\u0627\\u0646\\u064b\\u0627 \\u0639\\u0646 \\u0642\\u0635\\u062f (\\u0631\\u0648\\u062d \\u0627\\u0644\\u062f\\u0639\\u0627\\u0628\\u0629 \\u0627\\u0644\\u0645\\u062d\\u0642\\u0648\\u0646\\u0629 \\u0648\\u0645\\u0627 \\u0634\\u0627\\u0628\\u0647 \\u0630\\u0644\\u0643).<\\/p>\"}', '2021-03-09 15:50:59', '2021-03-09 15:50:59'),
(179, 34, 9, '{\"title\":\"\\u0633\\u064a\\u0627\\u0633\\u0629 \\u062e\\u0627\\u0635\\u0629\",\"description\":\"<p>\\u0647\\u0646\\u0627\\u0643 \\u062d\\u0642\\u064a\\u0642\\u0629 \\u0645\\u062b\\u0628\\u062a\\u0629 \\u0645\\u0646\\u0630 \\u0632\\u0645\\u0646 \\u0637\\u0648\\u064a\\u0644 \\u0648\\u0647\\u064a \\u0623\\u0646 \\u0627\\u0644\\u0645\\u062d\\u062a\\u0648\\u0649 \\u0627\\u0644\\u0645\\u0642\\u0631\\u0648\\u0621 \\u0644\\u0635\\u0641\\u062d\\u0629 \\u0645\\u0627 \\u0633\\u064a\\u0644\\u0647\\u064a \\u0627\\u0644\\u0642\\u0627\\u0631\\u0626 \\u0639\\u0646 \\u0627\\u0644\\u062a\\u0631\\u0643\\u064a\\u0632 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0634\\u0643\\u0644 \\u0627\\u0644\\u062e\\u0627\\u0631\\u062c\\u064a \\u0644\\u0644\\u0646\\u0635 \\u0623\\u0648 \\u0634\\u0643\\u0644 \\u062a\\u0648\\u0636\\u0639 \\u0627\\u0644\\u0641\\u0642\\u0631\\u0627\\u062a \\u0641\\u064a \\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 \\u0627\\u0644\\u062a\\u064a \\u064a\\u0642\\u0631\\u0623\\u0647\\u0627. \\u0627\\u0644\\u0647\\u062f\\u0641 \\u0645\\u0646 \\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\u0644\\u0648\\u0631\\u064a\\u0645 \\u0625\\u064a\\u0628\\u0633\\u0648\\u0645 \\u0647\\u0648 \\u0623\\u0646\\u0647 \\u064a\\u062d\\u062a\\u0648\\u064a \\u0639\\u0644\\u0649 \\u062a\\u0648\\u0632\\u064a\\u0639 \\u0637\\u0628\\u064a\\u0639\\u064a -\\u0625\\u0644\\u0649 \\u062d\\u062f \\u0645\\u0627- \\u0644\\u0644\\u0623\\u062d\\u0631\\u0641 \\u060c \\u0628\\u062f\\u0644\\u0627\\u064b \\u0645\\u0646 \\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\\"\\u0647\\u0646\\u0627 \\u064a\\u0648\\u062c\\u062f \\u0645\\u062d\\u062a\\u0648\\u0649 \\u0646\\u0635\\u064a \\u060c \\u0647\\u0646\\u0627 \\u064a\\u0648\\u062c\\u062f \\u0645\\u062d\\u062a\\u0648\\u0649 \\u0646\\u0635\\u064a\\\" \\u060c \\u0645\\u0645\\u0627 \\u064a\\u062c\\u0639\\u0644\\u0647\\u0627 \\u062a\\u0628\\u062f\\u0648 \\u0648\\u0643\\u0623\\u0646\\u0647\\u0627 \\u0625\\u0646\\u062c\\u0644\\u064a\\u0632\\u064a\\u0629 \\u0642\\u0627\\u0628\\u0644\\u0629 \\u0644\\u0644\\u0642\\u0631\\u0627\\u0621\\u0629. \\u062a\\u0633\\u062a\\u062e\\u062f\\u0645 \\u0627\\u0644\\u0639\\u062f\\u064a\\u062f \\u0645\\u0646 \\u062d\\u0632\\u0645 \\u0627\\u0644\\u0646\\u0634\\u0631 \\u0627\\u0644\\u0645\\u0643\\u062a\\u0628\\u064a \\u0648\\u0645\\u062d\\u0631\\u0631\\u064a \\u0635\\u0641\\u062d\\u0627\\u062a \\u0627\\u0644\\u0648\\u064a\\u0628 \\u0627\\u0644\\u0622\\u0646 Lorem Ipsum \\u0643\\u0646\\u0635 \\u0646\\u0645\\u0648\\u0630\\u062c \\u0627\\u0641\\u062a\\u0631\\u0627\\u0636\\u064a \\u060c \\u0648\\u0633\\u064a\\u0643\\u0634\\u0641 \\u0627\\u0644\\u0628\\u062d\\u062b \\u0639\\u0646 \\\"lorem ipsum\\\" \\u0639\\u0646 \\u0627\\u0644\\u0639\\u062f\\u064a\\u062f \\u0645\\u0646 \\u0645\\u0648\\u0627\\u0642\\u0639 \\u0627\\u0644\\u0648\\u064a\\u0628 \\u0627\\u0644\\u062a\\u064a \\u0644\\u0627 \\u062a\\u0632\\u0627\\u0644 \\u0641\\u064a \\u0645\\u0647\\u062f\\u0647\\u0627. \\u062a\\u0637\\u0648\\u0631\\u062a \\u0625\\u0635\\u062f\\u0627\\u0631\\u0627\\u062a \\u0645\\u062e\\u062a\\u0644\\u0641\\u0629 \\u0639\\u0644\\u0649 \\u0645\\u0631 \\u0627\\u0644\\u0633\\u0646\\u064a\\u0646 \\u060c \\u0623\\u062d\\u064a\\u0627\\u0646\\u064b\\u0627 \\u0639\\u0646 \\u0637\\u0631\\u064a\\u0642 \\u0627\\u0644\\u0635\\u062f\\u0641\\u0629 \\u060c \\u0648\\u0623\\u062d\\u064a\\u0627\\u0646\\u064b\\u0627 \\u0639\\u0646 \\u0642\\u0635\\u062f (\\u0631\\u0648\\u062d \\u0627\\u0644\\u062f\\u0639\\u0627\\u0628\\u0629 \\u0627\\u0644\\u0645\\u062d\\u0642\\u0648\\u0646\\u0629 \\u0648\\u0645\\u0627 \\u0634\\u0627\\u0628\\u0647 \\u0630\\u0644\\u0643). \\u0647\\u0646\\u0627\\u0643 \\u062d\\u0642\\u064a\\u0642\\u0629 \\u0645\\u062b\\u0628\\u062a\\u0629 \\u0645\\u0646\\u0630 \\u0632\\u0645\\u0646 \\u0637\\u0648\\u064a\\u0644 \\u0648\\u0647\\u064a \\u0623\\u0646 \\u0627\\u0644\\u0645\\u062d\\u062a\\u0648\\u0649 \\u0627\\u0644\\u0645\\u0642\\u0631\\u0648\\u0621 \\u0644\\u0635\\u0641\\u062d\\u0629 \\u0645\\u0627 \\u0633\\u064a\\u0644\\u0647\\u064a \\u0627\\u0644\\u0642\\u0627\\u0631\\u0626 \\u0639\\u0646 \\u0627\\u0644\\u062a\\u0631\\u0643\\u064a\\u0632 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0634\\u0643\\u0644 \\u0627\\u0644\\u062e\\u0627\\u0631\\u062c\\u064a \\u0644\\u0644\\u0646\\u0635 \\u0623\\u0648 \\u0634\\u0643\\u0644 \\u062a\\u0648\\u0636\\u0639 \\u0627\\u0644\\u0641\\u0642\\u0631\\u0627\\u062a \\u0641\\u064a \\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 \\u0627\\u0644\\u062a\\u064a \\u064a\\u0642\\u0631\\u0623\\u0647\\u0627.<\\/p><p><br \\/><\\/p><p><br \\/><\\/p><p><br \\/><\\/p><p>\\u0627\\u0644\\u0647\\u062f\\u0641 \\u0645\\u0646 \\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\u0644\\u0648\\u0631\\u064a\\u0645 \\u0625\\u064a\\u0628\\u0633\\u0648\\u0645 \\u0647\\u0648 \\u0623\\u0646\\u0647 \\u064a\\u062d\\u062a\\u0648\\u064a \\u0639\\u0644\\u0649 \\u062a\\u0648\\u0632\\u064a\\u0639 \\u0637\\u0628\\u064a\\u0639\\u064a -\\u0625\\u0644\\u0649 \\u062d\\u062f \\u0645\\u0627- \\u0644\\u0644\\u0623\\u062d\\u0631\\u0641 \\u060c \\u0628\\u062f\\u0644\\u0627\\u064b \\u0645\\u0646 \\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\\"\\u0647\\u0646\\u0627 \\u064a\\u0648\\u062c\\u062f \\u0645\\u062d\\u062a\\u0648\\u0649 \\u0646\\u0635\\u064a \\u060c \\u0647\\u0646\\u0627 \\u064a\\u0648\\u062c\\u062f \\u0645\\u062d\\u062a\\u0648\\u0649 \\u0646\\u0635\\u064a\\\" \\u060c \\u0645\\u0645\\u0627 \\u064a\\u062c\\u0639\\u0644\\u0647\\u0627 \\u062a\\u0628\\u062f\\u0648 \\u0648\\u0643\\u0623\\u0646\\u0647\\u0627 \\u0625\\u0646\\u062c\\u0644\\u064a\\u0632\\u064a\\u0629 \\u0642\\u0627\\u0628\\u0644\\u0629 \\u0644\\u0644\\u0642\\u0631\\u0627\\u0621\\u0629. \\u062a\\u0633\\u062a\\u062e\\u062f\\u0645 \\u0627\\u0644\\u0639\\u062f\\u064a\\u062f \\u0645\\u0646 \\u062d\\u0632\\u0645 \\u0627\\u0644\\u0646\\u0634\\u0631 \\u0627\\u0644\\u0645\\u0643\\u062a\\u0628\\u064a \\u0648\\u0645\\u062d\\u0631\\u0631\\u064a \\u0635\\u0641\\u062d\\u0627\\u062a \\u0627\\u0644\\u0648\\u064a\\u0628 \\u0627\\u0644\\u0622\\u0646 Lorem Ipsum \\u0643\\u0646\\u0635 \\u0646\\u0645\\u0648\\u0630\\u062c \\u0627\\u0641\\u062a\\u0631\\u0627\\u0636\\u064a \\u060c \\u0648\\u0633\\u064a\\u0643\\u0634\\u0641 \\u0627\\u0644\\u0628\\u062d\\u062b \\u0639\\u0646 \\\"lorem ipsum\\\" \\u0639\\u0646 \\u0627\\u0644\\u0639\\u062f\\u064a\\u062f \\u0645\\u0646 \\u0645\\u0648\\u0627\\u0642\\u0639 \\u0627\\u0644\\u0648\\u064a\\u0628 \\u0627\\u0644\\u062a\\u064a \\u0644\\u0627 \\u062a\\u0632\\u0627\\u0644 \\u0641\\u064a \\u0645\\u0647\\u062f\\u0647\\u0627. \\u062a\\u0637\\u0648\\u0631\\u062a \\u0625\\u0635\\u062f\\u0627\\u0631\\u0627\\u062a \\u0645\\u062e\\u062a\\u0644\\u0641\\u0629 \\u0639\\u0644\\u0649 \\u0645\\u0631 \\u0627\\u0644\\u0633\\u0646\\u064a\\u0646 \\u060c \\u0623\\u062d\\u064a\\u0627\\u0646\\u064b\\u0627 \\u0639\\u0646 \\u0637\\u0631\\u064a\\u0642 \\u0627\\u0644\\u0635\\u062f\\u0641\\u0629 \\u060c \\u0648\\u0623\\u062d\\u064a\\u0627\\u0646\\u064b\\u0627 \\u0639\\u0646 \\u0642\\u0635\\u062f (\\u0631\\u0648\\u062d \\u0627\\u0644\\u062f\\u0639\\u0627\\u0628\\u0629 \\u0627\\u0644\\u0645\\u062d\\u0642\\u0648\\u0646\\u0629 \\u0648\\u0645\\u0627 \\u0634\\u0627\\u0628\\u0647 \\u0630\\u0644\\u0643). \\u0647\\u0646\\u0627\\u0643 \\u062d\\u0642\\u064a\\u0642\\u0629 \\u0645\\u062b\\u0628\\u062a\\u0629 \\u0645\\u0646\\u0630 \\u0632\\u0645\\u0646 \\u0637\\u0648\\u064a\\u0644 \\u0648\\u0647\\u064a \\u0623\\u0646 \\u0627\\u0644\\u0645\\u062d\\u062a\\u0648\\u0649 \\u0627\\u0644\\u0645\\u0642\\u0631\\u0648\\u0621 \\u0644\\u0635\\u0641\\u062d\\u0629 \\u0645\\u0627 \\u0633\\u064a\\u0644\\u0647\\u064a \\u0627\\u0644\\u0642\\u0627\\u0631\\u0626 \\u0639\\u0646 \\u0627\\u0644\\u062a\\u0631\\u0643\\u064a\\u0632 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0634\\u0643\\u0644 \\u0627\\u0644\\u062e\\u0627\\u0631\\u062c\\u064a \\u0644\\u0644\\u0646\\u0635 \\u0623\\u0648 \\u0634\\u0643\\u0644 \\u062a\\u0648\\u0636\\u0639 \\u0627\\u0644\\u0641\\u0642\\u0631\\u0627\\u062a \\u0641\\u064a \\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 \\u0627\\u0644\\u062a\\u064a \\u064a\\u0642\\u0631\\u0623\\u0647\\u0627. \\u0627\\u0644\\u0647\\u062f\\u0641 \\u0645\\u0646 \\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\u0644\\u0648\\u0631\\u064a\\u0645 \\u0625\\u064a\\u0628\\u0633\\u0648\\u0645 \\u0647\\u0648 \\u0623\\u0646\\u0647 \\u064a\\u062d\\u062a\\u0648\\u064a \\u0639\\u0644\\u0649 \\u062a\\u0648\\u0632\\u064a\\u0639 \\u0637\\u0628\\u064a\\u0639\\u064a -\\u0625\\u0644\\u0649 \\u062d\\u062f \\u0645\\u0627- \\u0644\\u0644\\u0623\\u062d\\u0631\\u0641 \\u060c \\u0628\\u062f\\u0644\\u0627\\u064b \\u0645\\u0646 \\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\\"\\u0647\\u0646\\u0627 \\u064a\\u0648\\u062c\\u062f \\u0645\\u062d\\u062a\\u0648\\u0649 \\u0646\\u0635\\u064a \\u060c \\u0647\\u0646\\u0627 \\u064a\\u0648\\u062c\\u062f \\u0645\\u062d\\u062a\\u0648\\u0649 \\u0646\\u0635\\u064a\\\" \\u060c \\u0645\\u0645\\u0627 \\u064a\\u062c\\u0639\\u0644\\u0647\\u0627 \\u062a\\u0628\\u062f\\u0648 \\u0648\\u0643\\u0623\\u0646\\u0647\\u0627 \\u0625\\u0646\\u062c\\u0644\\u064a\\u0632\\u064a\\u0629 \\u0642\\u0627\\u0628\\u0644\\u0629 \\u0644\\u0644\\u0642\\u0631\\u0627\\u0621\\u0629. \\u062a\\u0633\\u062a\\u062e\\u062f\\u0645 \\u0627\\u0644\\u0639\\u062f\\u064a\\u062f \\u0645\\u0646 \\u062d\\u0632\\u0645 \\u0627\\u0644\\u0646\\u0634\\u0631 \\u0627\\u0644\\u0645\\u0643\\u062a\\u0628\\u064a \\u0648\\u0645\\u062d\\u0631\\u0631\\u064a \\u0635\\u0641\\u062d\\u0627\\u062a \\u0627\\u0644\\u0648\\u064a\\u0628 \\u0627\\u0644\\u0622\\u0646 Lorem Ipsum \\u0643\\u0646\\u0635 \\u0646\\u0645\\u0648\\u0630\\u062c \\u0627\\u0641\\u062a\\u0631\\u0627\\u0636\\u064a \\u060c \\u0648\\u0633\\u064a\\u0643\\u0634\\u0641 \\u0627\\u0644\\u0628\\u062d\\u062b \\u0639\\u0646 \\\"lorem ipsum\\\" \\u0639\\u0646 \\u0627\\u0644\\u0639\\u062f\\u064a\\u062f \\u0645\\u0646 \\u0645\\u0648\\u0627\\u0642\\u0639 \\u0627\\u0644\\u0648\\u064a\\u0628 \\u0627\\u0644\\u062a\\u064a \\u0644\\u0627 \\u062a\\u0632\\u0627\\u0644 \\u0641\\u064a \\u0645\\u0647\\u062f\\u0647\\u0627. \\u062a\\u0637\\u0648\\u0631\\u062a \\u0625\\u0635\\u062f\\u0627\\u0631\\u0627\\u062a \\u0645\\u062e\\u062a\\u0644\\u0641\\u0629 \\u0639\\u0644\\u0649 \\u0645\\u0631 \\u0627\\u0644\\u0633\\u0646\\u064a\\u0646 \\u060c \\u0623\\u062d\\u064a\\u0627\\u0646\\u064b\\u0627 \\u0639\\u0646 \\u0637\\u0631\\u064a\\u0642 \\u0627\\u0644\\u0635\\u062f\\u0641\\u0629 \\u060c \\u0648\\u0623\\u062d\\u064a\\u0627\\u0646\\u064b\\u0627 \\u0639\\u0646 \\u0642\\u0635\\u062f (\\u0631\\u0648\\u062d \\u0627\\u0644\\u062f\\u0639\\u0627\\u0628\\u0629 \\u0627\\u0644\\u0645\\u062d\\u0642\\u0648\\u0646\\u0629 \\u0648\\u0645\\u0627 \\u0634\\u0627\\u0628\\u0647 \\u0630\\u0644\\u0643).<\\/p>\"}', '2021-03-09 15:51:02', '2021-03-09 15:51:02'),
(180, 36, 9, '{\"title\":\"\\u0639\\u0627\\u0645\",\"description\":\"<p>\\u0645\\u0646 \\u062e\\u0644\\u0627\\u0644 \\u062a\\u0642\\u062f\\u064a\\u0645 \\u0637\\u0644\\u0628 \\u0628\\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 SMM Panel \\u060c \\u0641\\u0625\\u0646\\u0643 \\u062a\\u0642\\u0628\\u0644 \\u062a\\u0644\\u0642\\u0627\\u0626\\u064a\\u064b\\u0627 \\u062c\\u0645\\u064a\\u0639 \\u0634\\u0631\\u0648\\u0637 \\u0627\\u0644\\u062e\\u062f\\u0645\\u0629 \\u0627\\u0644\\u0645\\u062f\\u0631\\u062c\\u0629 \\u0623\\u062f\\u0646\\u0627\\u0647 \\u0633\\u0648\\u0627\\u0621 \\u0642\\u0631\\u0623\\u062a\\u0647\\u0627 \\u0623\\u0645 \\u0644\\u0627. \\u0646\\u062d\\u0646 \\u0646\\u062d\\u062a\\u0641\\u0638 \\u0628\\u0627\\u0644\\u062d\\u0642 \\u0641\\u064a \\u062a\\u063a\\u064a\\u064a\\u0631 \\u0634\\u0631\\u0648\\u0637 \\u0627\\u0644\\u062e\\u062f\\u0645\\u0629 \\u0647\\u0630\\u0647 \\u062f\\u0648\\u0646 \\u0633\\u0627\\u0628\\u0642 \\u0625\\u0646\\u0630\\u0627\\u0631. \\u0645\\u0646 \\u0627\\u0644\\u0645\\u062a\\u0648\\u0642\\u0639 \\u0623\\u0646 \\u062a\\u0642\\u0631\\u0623 \\u062c\\u0645\\u064a\\u0639 \\u0634\\u0631\\u0648\\u0637 \\u0627\\u0644\\u062e\\u062f\\u0645\\u0629 \\u0642\\u0628\\u0644 \\u062a\\u0642\\u062f\\u064a\\u0645 \\u0623\\u064a \\u0637\\u0644\\u0628 \\u0644\\u0644\\u062a\\u0623\\u0643\\u062f \\u0645\\u0646 \\u0645\\u0648\\u0627\\u0643\\u0628\\u0629 \\u0623\\u064a \\u062a\\u063a\\u064a\\u064a\\u0631\\u0627\\u062a \\u0623\\u0648 \\u0623\\u064a \\u062a\\u063a\\u064a\\u064a\\u0631\\u0627\\u062a \\u0645\\u0633\\u062a\\u0642\\u0628\\u0644\\u064a\\u0629. \\u0644\\u0646 \\u062a\\u0633\\u062a\\u062e\\u062f\\u0645 \\u0645\\u0648\\u0642\\u0639 SMM Panel \\u0627\\u0644\\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a \\u0625\\u0644\\u0627 \\u0628\\u0637\\u0631\\u064a\\u0642\\u0629 \\u062a\\u062a\\u0628\\u0639 \\u062c\\u0645\\u064a\\u0639 \\u0627\\u0644\\u0627\\u062a\\u0641\\u0627\\u0642\\u064a\\u0627\\u062a \\u0627\\u0644\\u0645\\u0628\\u0631\\u0645\\u0629 \\u0645\\u0639 Instagram \\/ Facebook \\/ Twitter \\/ Youtube \\/ \\u0645\\u0648\\u0627\\u0642\\u0639 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a \\u0627\\u0644\\u0623\\u062e\\u0631\\u0649 \\u0639\\u0644\\u0649 \\u0635\\u0641\\u062d\\u0629 \\u0634\\u0631\\u0648\\u0637 \\u0627\\u0644\\u062e\\u062f\\u0645\\u0629 \\u0627\\u0644\\u0641\\u0631\\u062f\\u064a\\u0629 \\u0627\\u0644\\u062e\\u0627\\u0635\\u0629 \\u0628\\u0647\\u0645. \\u062a\\u062e\\u0636\\u0639 \\u0623\\u0633\\u0639\\u0627\\u0631 SMM Panel \\u0644\\u0644\\u062a\\u063a\\u064a\\u064a\\u0631 \\u0641\\u064a \\u0623\\u064a \\u0648\\u0642\\u062a \\u062f\\u0648\\u0646 \\u0625\\u0634\\u0639\\u0627\\u0631 \\u0645\\u0633\\u0628\\u0642. \\u062a\\u0638\\u0644 \\u0633\\u064a\\u0627\\u0633\\u0629 \\u0627\\u0644\\u062f\\u0641\\u0639 \\/ \\u0627\\u0644\\u0627\\u0633\\u062a\\u0631\\u062f\\u0627\\u062f \\u0633\\u0627\\u0631\\u064a\\u0629 \\u0641\\u064a \\u062d\\u0627\\u0644\\u0629 \\u062a\\u063a\\u064a\\u064a\\u0631 \\u0627\\u0644\\u0633\\u0639\\u0631. \\u0644\\u0627 \\u062a\\u0636\\u0645\\u0646 SMM Panel \\u0645\\u0648\\u0639\\u062f \\u062a\\u0633\\u0644\\u064a\\u0645 \\u0623\\u064a \\u062e\\u062f\\u0645\\u0627\\u062a. \\u0646\\u062d\\u0646 \\u0646\\u0642\\u062f\\u0645 \\u0623\\u0641\\u0636\\u0644 \\u062a\\u0642\\u062f\\u064a\\u0631 \\u0644\\u062f\\u064a\\u0646\\u0627 \\u0644\\u0645\\u0648\\u0639\\u062f \\u062a\\u0633\\u0644\\u064a\\u0645 \\u0627\\u0644\\u0637\\u0644\\u0628. \\u0647\\u0630\\u0627 \\u0645\\u062c\\u0631\\u062f \\u062a\\u0642\\u062f\\u064a\\u0631 \\u0648\\u0644\\u0646 \\u062a\\u0642\\u0648\\u0645 SMM Panel \\u0628\\u0631\\u062f \\u0627\\u0644\\u0637\\u0644\\u0628\\u0627\\u062a \\u0627\\u0644\\u062a\\u064a \\u062a\\u062a\\u0645 \\u0645\\u0639\\u0627\\u0644\\u062c\\u062a\\u0647\\u0627 \\u0625\\u0630\\u0627 \\u0634\\u0639\\u0631\\u062a \\u0623\\u0646\\u0647\\u0627 \\u062a\\u0633\\u062a\\u063a\\u0631\\u0642 \\u0648\\u0642\\u062a\\u064b\\u0627 \\u0637\\u0648\\u064a\\u0644\\u0627\\u064b. \\u062a\\u062d\\u0627\\u0648\\u0644 SMM Panel \\u062c\\u0627\\u0647\\u062f\\u0629 \\u062a\\u0642\\u062f\\u064a\\u0645 \\u0645\\u0627 \\u0647\\u0648 \\u0645\\u062a\\u0648\\u0642\\u0639 \\u0645\\u0646\\u0627 \\u0628\\u0627\\u0644\\u0636\\u0628\\u0637 \\u0645\\u0646 \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0628\\u0627\\u0626\\u0639\\u064a\\u0646 \\u0644\\u062f\\u064a\\u0646\\u0627. \\u0641\\u064a \\u0647\\u0630\\u0647 \\u0627\\u0644\\u062d\\u0627\\u0644\\u0629 \\u060c \\u0646\\u062d\\u062a\\u0641\\u0638 \\u0628\\u0627\\u0644\\u062d\\u0642 \\u0641\\u064a \\u062a\\u063a\\u064a\\u064a\\u0631 \\u0646\\u0648\\u0639 \\u0627\\u0644\\u062e\\u062f\\u0645\\u0629 \\u0625\\u0630\\u0627 \\u0631\\u0623\\u064a\\u0646\\u0627 \\u0623\\u0646\\u0647 \\u0645\\u0646 \\u0627\\u0644\\u0636\\u0631\\u0648\\u0631\\u064a \\u0625\\u0643\\u0645\\u0627\\u0644 \\u0627\\u0644\\u0637\\u0644\\u0628.<br \\/><\\/p>\"}', '2021-03-09 15:51:23', '2021-03-09 15:51:23');

-- --------------------------------------------------------

--
-- Table structure for table `content_media`
--

CREATE TABLE `content_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `content_media`
--

INSERT INTO `content_media` (`id`, `content_id`, `description`, `created_at`, `updated_at`) VALUES
(8, 12, '{\"image\":\"6017b6e0c769b1612166880.png\"}', '2021-02-01 02:08:00', '2021-02-01 02:08:00'),
(9, 13, '{\"image\":\"6017b6fdd244c1612166909.png\"}', '2021-02-01 02:08:29', '2021-02-01 02:08:29'),
(10, 14, '{\"image\":\"604740153d54d1615282197.png\"}', '2021-02-01 02:08:58', '2021-03-09 14:29:57'),
(11, 15, '{\"image\":\"6017b7984e39a1612167064.png\",\"button_link\":\"https:\\/\\/bugfinder.net\\/smm-matrix\\/services\"}', '2021-02-01 02:11:04', '2021-10-20 12:00:49'),
(12, 16, '{\"image\":\"6017b7b3451ce1612167091.png\",\"button_link\":\"https:\\/\\/bugfinder.net\\/smm-matrix\\/services\"}', '2021-02-01 02:11:31', '2021-10-20 12:01:55'),
(13, 17, '{\"image\":\"6017b7c0aa29f1612167104.png\",\"button_link\":\"https:\\/\\/bugfinder.net\\/smm-matrix\\/services\"}', '2021-02-01 02:11:44', '2021-10-20 12:02:27'),
(14, 18, '{\"image\":\"60194c5ee5d5d1612270686.jpg\"}', '2021-02-01 02:21:07', '2021-02-02 06:58:06'),
(15, 19, '{\"image\":\"60194ca30642b1612270755.jpg\"}', '2021-02-01 02:29:12', '2021-02-02 06:59:15'),
(16, 20, '{\"image\":\"6017bbf7670361612168183.png\"}', '2021-02-01 02:29:43', '2021-02-01 02:29:43'),
(17, 21, '{\"image\":\"60194cb915ca31612270777.jpg\"}', '2021-02-01 02:30:43', '2021-02-02 06:59:37'),
(18, 22, '{\"image\":\"6017bc60073461612168288.png\"}', '2021-02-01 02:31:28', '2021-02-01 02:31:28'),
(20, 37, '{\"icon\":\"far fa-address-book\"}', '2021-02-02 00:51:56', '2021-02-02 00:51:56'),
(25, 38, '{\"icon\":\"fas fa-hand-holding-usd\"}', '2021-02-02 00:55:30', '2021-02-02 00:55:30'),
(26, 39, '{\"icon\":\"far fa-paper-plane\"}', '2021-02-02 00:57:17', '2021-02-02 00:57:17'),
(27, 40, '{\"icon\":\"fab fa-angellist\"}', '2021-02-02 00:58:40', '2021-02-02 00:58:40'),
(34, 56, '{\"link\":\"https:\\/\\/www.facebook.com\\/\",\"icon\":\"fab fa-facebook-f\"}', '2021-02-03 00:39:22', '2021-02-03 00:42:19'),
(36, 58, '{\"link\":\"https:\\/\\/twitter.com\\/\",\"icon\":\"fab fa-twitter\"}', '2021-02-03 00:44:24', '2021-02-03 00:44:24'),
(37, 59, '{\"link\":\"https:\\/\\/bd.linkedin.com\\/\",\"icon\":\"fab fa-linkedin-in\"}', '2021-02-03 00:45:04', '2021-02-03 00:45:04'),
(38, 60, '{\"link\":\"https:\\/\\/www.instagram.com\\/\",\"icon\":\"fab fa-instagram\"}', '2021-02-03 00:46:09', '2021-02-03 00:46:09'),
(39, 61, '{\"image\":\"601a9cde42df11612356830.jpg\"}', '2021-02-03 06:53:50', '2021-02-03 06:53:50'),
(40, 62, '{\"image\":\"60474e0a88ae71615285770.jpg\"}', '2021-02-03 06:56:25', '2021-03-09 15:29:30'),
(41, 63, '{\"image\":\"601a9dbe79bbb1612357054.jpg\"}', '2021-02-03 06:57:34', '2021-02-03 06:57:34');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_beneficiaries` int(11) DEFAULT NULL,
  `number_of_use` int(11) DEFAULT NULL,
  `is_percent` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `from` datetime DEFAULT NULL,
  `to` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `sale`, `number_of_beneficiaries`, `number_of_use`, `is_percent`, `status`, `from`, `to`, `created_at`, `updated_at`) VALUES
(1, '8ec97d53', '333', 33, 0, 0, 1, '2022-05-27 17:14:00', '2022-05-31 16:52:00', '2022-05-27 10:57:10', '2022-05-27 11:14:49');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` bigint(20) UNSIGNED DEFAULT NULL,
  `template_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `template` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_keys` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_status` tinyint(1) NOT NULL DEFAULT 0,
  `sms_status` tinyint(1) NOT NULL DEFAULT 0,
  `lang_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `language_id`, `template_key`, `email_from`, `name`, `subject`, `template`, `sms_body`, `short_keys`, `mail_status`, `sms_status`, `lang_code`, `created_at`, `updated_at`) VALUES
(1, 1, 'PROFILE_UPDATE', 'support@exmaple.com', 'Profile has been updated', 'Profile has been updated', 'Your first name [[firstname]]\r\n\r\nlast name [[lastname]]\r\n\r\nemail [[email]]\r\n\r\nphone number [[phone]]\r\n', 'Your first name [[firstname]]\r\n\r\nlast name [[lastname]]\r\n\r\nemail [[email]]\r\n\r\nphone number [[phone]]\r\n', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"charge\":\"Gateway Charge\",\"currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\"}', 1, 1, 'en', '2021-01-23 05:20:56', '2021-01-23 05:20:56'),
(2, 1, 'ADMIN_SUPPORT_REPLY', 'support@exmaple.com', 'Support Ticket Reply ', 'Support Ticket Reply', '<p>Ticket ID [[ticket_id]]\r\n</p><p><span><br /></span></p><p><span>Subject [[ticket_subject]]\r\n</span></p><p><span>-----Replied------</span></p><p><span>\r\n[[reply]]</span><br /></p>', 'Ticket ID [[ticket_id]]\r\n\r\n\r\n\r\nSubject [[ticket_subject]]\r\n\r\n-----Replied------\r\n\r\n[[reply]]', '{\"ticket_id\":\"Support Ticket ID\",\"ticket_subject\":\"Subject Of Support Ticket\",\"reply\":\"Reply from Staff\\/Admin\"}', 1, 1, 'en', '2021-01-23 05:24:42', '2021-01-23 05:48:16'),
(3, 1, 'PASSWORD_CHANGED', 'support@exmaple.com', 'PASSWORD CHANGED ', 'Your password changed ', 'Your password changed \r\n\r\nNew password [[password]]\r\n\r\n', 'Your password changed\r\n\r\nNew password [[password]]\r\n\r\n\r\nNews [[test]]', '{\"password\":\"password\"}', 1, 1, 'en', '2021-01-23 05:24:42', '2021-01-23 05:48:16'),
(4, 1, 'ADD_BALANCE', 'support@exmaple.com', 'Balance Add by Admin', 'Your Account has been credited', '[[amount]] [[currency]] credited in your account.\r\n\r\nYour Current Balance [[main_balance]][[currency]]\r\n\r\nTransaction: #[[transaction]]', '[[amount]] [[currency]] credited in your account. \r\n\r\n\r\nYour Current Balance [[main_balance]][[currency]]\r\n\r\nTransaction: #[[transaction]]', '{\"transaction\":\"Transaction Number\",\"amount\":\"Request Amount By Admin\",\"currency\":\"Site Currency\", \"main_balance\":\"Users Balance After this operation\"}', 1, 1, 'en', '2021-01-23 05:24:42', '2021-10-19 02:49:21'),
(6, 1, 'DEDUCTED_BALANCE', 'support@exmaple.com', 'Balance deducted by Admin', 'Your Account has been debited', '[[amount]] [[currency]] debited in your account.\r\n\r\nYour Current Balance [[main_balance]][[currency]]\r\n\r\nTransaction: #[[transaction]]', '[[amount]] [[currency]] debited in your account.\r\n\r\nYour Current Balance [[main_balance]][[currency]]\r\n\r\nTransaction: #[[transaction]]', '{\"transaction\":\"Transaction Number\",\"amount\":\"Request Amount By Admin\",\"currency\":\"Site Currency\", \"main_balance\":\"Users Balance After this operation\"}', 1, 1, 'en', '2021-01-23 05:24:42', '2021-01-23 05:48:16'),
(7, 1, 'ORDER_CONFIRM', 'support@exmaple.com', 'Order Confirmed', 'Your Order Has Been Confirmed', 'Your Order has been confirmed\r\n\r\n\r\nOrder Id [[order_id]] \r\n\r\nOrder At [[order_at]] \r\n\r\nService [[service]]\r\n\r\nStatus [[status]]\r\n\r\nPaid Amount [[paid_amount]] [[currency]]\r\n\r\nYour Current Balance [[remaining_balance]] [[currency]]\r\n\r\nTransaction: # [[transaction]]  ', 'Your Order has been confirmed\r\n\r\n\r\nOrder Id [[order_id]] \r\n\r\nOrder At [[order_at]] \r\n\r\nService [[service]]\r\n\r\nStatus [[status]]\r\n\r\nPaid Amount [[paid_amount]] [[currency]]\r\n\r\nYour Current Balance [[remaining_balance]] [[currency]]\r\n\r\nTransaction: #[[transaction]]', '{\"order_id\":\"order ID\",\"order_at\":\"order At\",\"service\":\"Service\", \"status\":\"status\",\"paid_amount\":\"paid amount\",\"transaction\":\"transaction ID\",\"remaining_balance\":\"Remaining Balance\",\"currency\":\"currency\"}', 1, 1, 'en', '2021-01-23 05:24:42', '2022-05-26 08:25:36'),
(8, 1, 'ORDER_UPDATE', 'support@exmaple.com', 'Order Update', 'Your Order Has Been Updated', 'Your Order has been updated\r\n\r\n\r\nOrder Id [[order_id]] \r\n\r\nStart Counter [[start_counter]] \r\n\r\nLink [[link]]\r\n\r\nRemains[[remains]]\r\n\r\norder status [[order_status]]\r\n', 'Your Order has been updated\r\n\r\n\r\nOrder Id [[order_id]] \r\n\r\nStart Counter [[start_counter]] \r\n\r\nLink [[link]]\r\n\r\nRemains[[remains]]\r\n\r\norder status [[order_status]]\r\n', '{\"order_id\":\"order ID\",\"start_counter\":\"start counter\",\"link\":\"link\", \"remains\":\"remains\",\"order_status\":\"order status\"}', 1, 1, 'en', '2021-01-23 05:24:42', '2021-01-23 05:48:16'),
(9, 1, 'PAYMENT_COMPLETE', 'support@exmaple.com', 'Payment Completed', 'Your Payment Has Been Completed', '[[amount]] [[currency]] Payment Has Been successful via [[gateway_name]]\r\n\r\nCharge[[charge]] [[currency]]\r\n\r\nTranaction [[transaction]]\r\n\r\nYour Main Balance [[remaining_balance]] [[currency]]\r\n\r\n', '[[amount]] [[currency]] Payment Has Been successful via [[gateway_name]]\r\n\r\nCharge[[charge]] [[currency]]\r\n\r\nTranaction [[transaction]]\r\n\r\nYour Main Balance [[remaining_balance]] [[currency]]\r\n\r\n', '{\"gateway_name\":\"gateway name\",\"amount\":\"amount\",\"charge\":\"charge\", \"currency\":\"currency\",\"transaction\":\"transaction\",\"remaining_balance\":\"remaining balance\"}', 1, 1, 'en', '2021-01-23 05:24:42', '2021-01-23 05:48:16'),
(10, 5, 'ADD_BALANCE', 'support@exmaple.com', 'Balance Add by Admin', 'Your Account has been credited', '[[amount]] [[currency]] credited in your account.\r\n\r\nYour Current Balance [[main_balance]][[currency]]\r\n\r\nTransaction: #[[transaction]]', '[[amount]] [[currency]] credited in your account. \n\n\nYour Current Balance [[main_balance]][[currency]]\n\nTransaction: #[[transaction]]', '{\"transaction\":\"Transaction Number\",\"amount\":\"Request Amount By Admin\",\"currency\":\"Site Currency\",\"main_balance\":\"Users Balance After this operation\"}', 1, 1, 'bn', '2021-01-27 00:32:07', '2021-03-09 10:04:34'),
(11, 1, 'PASSWORD_RESET', 'support@exmaple.com', 'Reset Password Notification', 'Reset Password Notification', 'You are receiving this email because we received a password reset request for your account.[[message]]\r\n\r\n\r\nThis password reset link will expire in 60 minutes.\r\n\r\nIf you did not request a password reset, no further action is required.', 'You are receiving this email because we received a password reset request for your account. [[message]]', '{\"message\":\"message\"}', 1, 1, 'en', '2021-01-27 00:32:07', '2021-01-27 00:32:07'),
(12, 1, 'VERIFICATION_CODE', 'support@exmaple.com', 'Verification Code', 'Verify Your Email ', 'Your Email verification Code  [[code]]', 'Your SMS verification Code  [[code]]', '{\"code\":\"code\"}', 1, 1, 'en', '2021-01-27 00:32:07', '2021-01-27 00:32:07'),
(13, 9, 'ADD_BALANCE', 'support@exmaple.com', 'Balance Add by Admin', 'Your Account has been credited', '[[amount]] [[currency]] credited in your account.\r\n\r\nYour Current Balance [[main_balance]][[currency]]\r\n\r\nTransaction: #[[transaction]]', '[[amount]] [[currency]] credited in your account. \r\n\r\n\r\nYour Current Balance [[main_balance]][[currency]]\r\n\r\nTransaction: #[[transaction]]', '{\"transaction\":\"Transaction Number\",\"amount\":\"Request Amount By Admin\",\"currency\":\"Site Currency\",\"main_balance\":\"Users Balance After this operation\"}', 1, 1, 'ar', '2021-03-09 10:04:24', '2021-03-09 10:04:24'),
(14, 9, 'ADMIN_SUPPORT_REPLY', 'support@exmaple.com', 'Support Ticket Reply ', 'Support Ticket Reply', '<p>Ticket ID [[ticket_id]]\r\n</p><p><span><br /></span></p><p><span>Subject [[ticket_subject]]\r\n</span></p><p><span>-----Replied------</span></p><p><span>\r\n[[reply]]</span><br /></p>', 'Ticket ID [[ticket_id]]\r\n\r\n\r\n\r\nSubject [[ticket_subject]]\r\n\r\n-----Replied------\r\n\r\n[[reply]]', '{\"ticket_id\":\"Support Ticket ID\",\"ticket_subject\":\"Subject Of Support Ticket\",\"reply\":\"Reply from Staff\\/Admin\"}', 1, 1, 'ar', '2021-03-09 16:26:18', '2021-03-09 16:26:18'),
(15, 5, 'ADMIN_SUPPORT_REPLY', 'support@exmaple.com', 'Support Ticket Reply ', 'Support Ticket Reply', '<p>Ticket ID [[ticket_id]]\r\n</p><p><span><br /></span></p><p><span>Subject [[ticket_subject]]\r\n</span></p><p><span>-----Replied------</span></p><p><span>\r\n[[reply]]</span><br /></p>', 'Ticket ID [[ticket_id]]\r\n\r\n\r\n\r\nSubject [[ticket_subject]]\r\n\r\n-----Replied------\r\n\r\n[[reply]]', '{\"ticket_id\":\"Support Ticket ID\",\"ticket_subject\":\"Subject Of Support Ticket\",\"reply\":\"Reply from Staff\\/Admin\"}', 1, 1, 'es', '2021-03-09 16:26:18', '2021-03-09 16:26:18'),
(16, 5, 'PAYMENT_COMPLETE', 'support@exmaple.com', 'Payment Completed', 'Your Payment Has Been Completed', '[[amount]] [[currency]] Payment Has Been successful via [[gateway_name]]\r\n\r\nCharge[[charge]] [[currency]]\r\n\r\nTranaction [[transaction]]\r\n\r\nYour Main Balance [[remaining_balance]] [[currency]]\r\n\r\n', '[[amount]] [[currency]] Payment Has Been successful via [[gateway_name]]\r\n\r\nCharge[[charge]] [[currency]]\r\n\r\nTranaction [[transaction]]\r\n\r\nYour Main Balance [[remaining_balance]] [[currency]]\r\n\r\n', '{\"gateway_name\":\"gateway name\",\"amount\":\"amount\",\"charge\":\"charge\",\"currency\":\"currency\",\"transaction\":\"transaction\",\"remaining_balance\":\"remaining balance\"}', 1, 1, 'AF', '2022-05-26 08:20:52', '2022-05-26 08:20:52'),
(17, 9, 'PAYMENT_COMPLETE', 'support@exmaple.com', 'Payment Completed', 'Your Payment Has Been Completed', '[[amount]] [[currency]] Payment Has Been successful via [[gateway_name]]\r\n\r\nCharge[[charge]] [[currency]]\r\n\r\nTranaction [[transaction]]\r\n\r\nYour Main Balance [[remaining_balance]] [[currency]]\r\n\r\n', '[[amount]] [[currency]] Payment Has Been successful via [[gateway_name]]\r\n\r\nCharge[[charge]] [[currency]]\r\n\r\nTranaction [[transaction]]\r\n\r\nYour Main Balance [[remaining_balance]] [[currency]]\r\n\r\n', '{\"gateway_name\":\"gateway name\",\"amount\":\"amount\",\"charge\":\"charge\",\"currency\":\"currency\",\"transaction\":\"transaction\",\"remaining_balance\":\"remaining balance\"}', 1, 1, 'sy', '2022-05-26 08:20:52', '2022-05-26 08:20:52'),
(18, 5, 'ORDER_CONFIRM', 'support@exmaple.com', 'Order Confirmed', 'Your Order Has Been Confirmed', 'Your Order has been confirmed\r\n\r\n\r\nOrder Id [[order_id]] \r\n\r\nOrder At [[order_at]] \r\n\r\nService [[service]]\r\n\r\nStatus [[status]]\r\n\r\nPaid Amount [[paid_amount]] [[currency]]\r\n\r\nYour Current Balance [[remaining_balance]] [[currency]]\r\n\r\nTransaction: #[[transaction]]', 'Your Order has been confirmed\r\n\r\n\r\nOrder Id [[order_id]] \r\n\r\nOrder At [[order_at]] \r\n\r\nService [[service]]\r\n\r\nStatus [[status]]\r\n\r\nPaid Amount [[paid_amount]] [[currency]]\r\n\r\nYour Current Balance [[remaining_balance]] [[currency]]\r\n\r\nTransaction: #[[transaction]]', '{\"order_id\":\"order ID\",\"order_at\":\"order At\",\"service\":\"Service\",\"status\":\"status\",\"paid_amount\":\"paid amount\",\"transaction\":\"transaction ID\",\"remaining_balance\":\"Remaining Balance\",\"currency\":\"currency\"}', 1, 1, 'AF', '2022-05-26 08:22:01', '2022-05-26 08:22:01'),
(19, 9, 'ORDER_CONFIRM', 'support@exmaple.com', 'Order Confirmed', 'Your Order Has Been Confirmed', 'Your Order has been confirmed\r\n\r\n\r\nOrder Id [[order_id]] \r\n\r\nOrder At [[order_at]] \r\n\r\nService [[service]]\r\n\r\nStatus [[status]]\r\n\r\nPaid Amount [[paid_amount]] [[currency]]\r\n\r\nYour Current Balance [[remaining_balance]] [[currency]]\r\n\r\nTransaction: #[[transaction]]', 'Your Order has been confirmed\r\n\r\n\r\nOrder Id [[order_id]] \r\n\r\nOrder At [[order_at]] \r\n\r\nService [[service]]\r\n\r\nStatus [[status]]\r\n\r\nPaid Amount [[paid_amount]] [[currency]]\r\n\r\nYour Current Balance [[remaining_balance]] [[currency]]\r\n\r\nTransaction: #[[transaction]]', '{\"order_id\":\"order ID\",\"order_at\":\"order At\",\"service\":\"Service\",\"status\":\"status\",\"paid_amount\":\"paid amount\",\"transaction\":\"transaction ID\",\"remaining_balance\":\"Remaining Balance\",\"currency\":\"currency\"}', 1, 1, 'sy', '2022-05-26 08:22:01', '2022-05-26 08:22:01');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `funds`
--

CREATE TABLE `funds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `gateway_id` bigint(20) UNSIGNED DEFAULT NULL,
  `gateway_currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `charge` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `rate` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `final_amount` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `btc_amount` decimal(18,8) DEFAULT NULL,
  `btc_wallet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `try` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `funds`
--

INSERT INTO `funds` (`id`, `user_id`, `gateway_id`, `gateway_currency`, `amount`, `charge`, `rate`, `final_amount`, `btc_amount`, `btc_wallet`, `transaction`, `try`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'USD', '200.00000000', '2.50000000', '0.01200000', '2.43000000', '0.00000000', '', '6D9Q6WFBPVC9', 0, 0, '2022-04-24 14:31:51', '2022-04-24 14:31:51'),
(2, 2, 2, 'USD', '43.00000000', '0.50000000', '1.00000000', '43.50000000', '0.00000000', '', '2F36A9CDJWRZ', 0, 0, '2022-04-24 14:32:28', '2022-04-24 14:32:28');

-- --------------------------------------------------------

--
-- Table structure for table `gateways`
--

CREATE TABLE `gateways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_by` int(11) DEFAULT 1,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0: inactive, 1: active',
  `parameters` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currencies` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra_parameters` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_amount` decimal(18,8) NOT NULL,
  `max_amount` decimal(18,8) NOT NULL,
  `percentage_charge` decimal(8,4) NOT NULL DEFAULT 0.0000,
  `fixed_charge` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `convention_rate` decimal(18,8) NOT NULL DEFAULT 1.00000000,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateways`
--

INSERT INTO `gateways` (`id`, `code`, `name`, `sort_by`, `image`, `status`, `parameters`, `currencies`, `extra_parameters`, `currency`, `symbol`, `min_amount`, `max_amount`, `percentage_charge`, `fixed_charge`, `convention_rate`, `created_at`, `updated_at`) VALUES
(1, 'paypal', 'Paypal', 1, '5f637b5622d23.jpg', 1, '{\"cleint_id\":\"AUrvcotEVWZkksiGir6Ih4PyalQcguQgGN-7We5O1wBny3tg1w6srbQzi6GQEO8lP3yJVha2C6lyivK9\", \"secret\":\"EPx-YEgvjKDRFFu3FAsMue_iUMbMH6jHu408rHdn4iGrUCM8M12t7mX8hghUBAWwvWErBOa4Uppfp0Eh\"}', '{\"0\":{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"USD\"}}', NULL, 'USD', 'USD', '1.00000000', '10000.00000000', '1.0000', '0.50000000', '0.01200000', '2020-09-10 09:05:02', '2022-04-24 14:30:12'),
(2, 'stripe', 'Stripe ', 2, '5f645d432b9c0.jpg', 1, '{\"secret_key\":\"sk_test_aat3tzBCCXXBkS4sxY3M8A1B\",\"publishable_key\":\"pk_test_AU3G7doZ1sbdpJLj0NaozPBu\"}', '{\"0\":{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}}', NULL, 'USD', 'USD', '1.00000000', '10000.00000000', '0.0000', '0.50000000', '1.00000000', '2020-09-10 09:05:02', '2022-04-24 14:30:17'),
(3, 'skrill', 'Skrill', 3, '5f637c7fcb9ef.jpg', 0, '{\"pay_to_email\":\"mig33@gmail.com\",\"secret_key\":\"SECRETKEY\"}', '{\"0\":{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JOD\":\"JOD\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"KWD\":\"KWD\",\"MAD\":\"MAD\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"OMR\":\"OMR\",\"PLN\":\"PLN\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"SAR\":\"SAR\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TND\":\"TND\",\"TRY\":\"TRY\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\",\"COP\":\"COP\"}}', NULL, 'USD', 'USD', '1.00000000', '10000.00000000', '0.0000', '0.50000000', '1.00000000', '2020-09-10 09:05:02', '2022-04-24 14:29:04'),
(4, 'perfectmoney', 'Perfect Money', 4, '5f64d522d8bea.jpg', 0, '{\"passphrase\":\"112233445566\",\"payee_account\":\"U26203997\"}', '{\"0\":{\"USD\":\"USD\",\"EUR\":\"EUR\"}}', NULL, 'USD', 'USD', '1.00000000', '10000.00000000', '0.0000', '0.50000000', '1.00000000', '2020-09-10 09:05:02', '2022-04-24 14:29:29'),
(5, 'paytm', 'PayTM', 19, '5f637cbfb4d4c.jpg', 0, '{\"MID\":\"uAOkSk48844590235401\",\"merchant_key\":\"pcB_oEk_R@kbm1c1\",\"WEBSITE\":\"DIYtestingweb\",\"INDUSTRY_TYPE_ID\":\"Retail\",\"CHANNEL_ID\":\"WEB\",\"transaction_url\":\"https:\\/\\/securegw.paytm.in\\/order\\/process\",\"transaction_status_url\":\"https:\\/\\/securegw.paytm.in\\/order\\/status\"}', '{\"0\":{\"AUD\":\"AUD\",\"ARS\":\"ARS\",\"BDT\":\"BDT\",\"BRL\":\"BRL\",\"BGN\":\"BGN\",\"CAD\":\"CAD\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"HRK\":\"HRK\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EGP\":\"EGP\",\"EUR\":\"EUR\",\"GEL\":\"GEL\",\"GHS\":\"GHS\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"KES\":\"KES\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"MAD\":\"MAD\",\"NPR\":\"NPR\",\"NZD\":\"NZD\",\"NGN\":\"NGN\",\"NOK\":\"NOK\",\"PKR\":\"PKR\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"ZAR\":\"ZAR\",\"KRW\":\"KRW\",\"LKR\":\"LKR\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"TRY\":\"TRY\",\"UGX\":\"UGX\",\"UAH\":\"UAH\",\"AED\":\"AED\",\"GBP\":\"GBP\",\"USD\":\"USD\",\"VND\":\"VND\",\"XOF\":\"XOF\"}}', NULL, 'INR', 'INR', '1.00000000', '10000.00000000', '0.0000', '0.50000000', '1.00000000', '2020-09-10 09:05:02', '2021-03-09 09:56:25'),
(6, 'payeer', 'Payeer', 17, '5f64d52d09e13.jpg', 0, '{\"merchant_id\":\"1142293755\",\"secret_key\":\"1122334455\"}', '{\"0\":{\"USD\":\"USD\",\"EUR\":\"EUR\",\"RUB\":\"RUB\"}}', '{\"status\":\"ipn\"}', 'USD', 'USD', '1.00000000', '10000.00000000', '0.0000', '0.50000000', '1.00000000', '2020-09-10 09:05:02', '2021-03-09 09:56:25'),
(7, 'paystack', 'PayStack', 18, '5f637d069177e.jpg', 0, '{\"public_key\":\"pk_test_f922aa1a87101e3fd029e13024006862fdc0b8c7\",\"secret_key\":\"sk_test_b8d571f97c1b41d409ba339eb20b005377751dff\"}', '{\"0\":{\"USD\":\"USD\",\"NGN\":\"NGN\"}}', '{\"callback\":\"ipn\",\"webhook\":\"ipn\"}\r\n', 'NGN', 'NGN', '1.00000000', '10000.00000000', '0.0000', '0.50000000', '1.00000000', '2020-09-10 09:05:02', '2021-03-09 09:56:25'),
(8, 'voguepay', 'VoguePay', 23, '5f637d53da3e7.jpg', 0, '{\"merchant_id\":\"9753-0112994\"}', '{\"0\":{\"NGN\":\"NGN\",\"USD\":\"USD\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"ZAR\":\"ZAR\",\"JPY\":\"JPY\",\"INR\":\"INR\",\"AUD\":\"AUD\",\"CAD\":\"CAD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PLN\":\"PLN\"}}\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n', NULL, 'USD', 'USD', '1.00000000', '10000.00000000', '0.0000', '0.50000000', '1.00000000', '2020-09-10 09:05:02', '2022-04-24 14:28:26'),
(9, 'flutterwave', 'Flutterwave', 12, '5f637d6a0b22d.jpg', 0, '{\"public_key\":\"FLWPUBK_TEST-5d9bb05bba2c13aa6c7a1ec7d7526ba2-X\",\"secret_key\":\"FLWSECK_TEST-2ac7b05b6b9fa8a423eb58241fd7bbb6-X\",\"encryption_key\":\"FLWSECK_TEST32e13665a95a\"}', '{\"0\":{\"KES\":\"KES\",\"GHS\":\"GHS\",\"NGN\":\"NGN\",\"USD\":\"USD\",\"GBP\":\"GBP\",\"EUR\":\"EUR\",\"UGX\":\"UGX\",\"TZS\":\"TZS\"}}', NULL, 'USD', 'USD', '1.00000000', '10000.00000000', '0.0000', '0.50000000', '0.01200000', '2020-09-10 09:05:02', '2021-03-09 09:56:25'),
(10, 'razorpay', 'RazorPay', 21, '5f637d80b68e0.jpg', 0, '{\"key_id\":\"rzp_test_kiOtejPbRZU90E\",\"key_secret\":\"osRDebzEqbsE1kbyQJ4y0re7\"}', '{\"0\": {\"INR\": \"INR\"}}', NULL, 'INR', 'INR', '1.00000000', '10000.00000000', '0.0000', '0.50000000', '1.00000000', '2020-09-10 09:05:02', '2021-03-09 09:56:25'),
(11, 'instamojo', 'instamojo', 13, '5f637da3c44d2.jpg', 0, '{\"api_key\":\"test_2241633c3bc44a3de84a3b33969\",\"auth_token\":\"test_279f083f7bebefd35217feef22d\",\"salt\":\"19d38908eeff4f58b2ddda2c6d86ca25\"}', '{\"0\":{\"INR\":\"INR\"}}', NULL, 'INR', 'INR', '1.00000000', '10000.00000000', '0.0000', '0.50000000', '73.51000000', '2020-09-10 09:05:02', '2021-03-09 09:56:25'),
(12, 'mollie', 'Mollie', 15, '5f637db537958.jpg', 0, '{\"api_key\":\"test_cucfwKTWfft9s337qsVfn5CC4vNkrn\"}', '{\"0\":{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\"}}', NULL, 'USD', 'USD', '1.00000000', '10000.00000000', '0.0000', '0.50000000', '0.01200000', '2020-09-10 09:05:02', '2021-03-09 09:56:25'),
(13, 'twocheckout', '2checkout', 24, '5f637e7eae68b.jpg', 0, '{\"merchant_code\":\"250507228545\",\"secret_key\":\"=+0CNzfvTItqp*ygwiQE\"}', '{\"0\":{\"AFN\":\"AFN\",\"ALL\":\"ALL\",\"DZD\":\"DZD\",\"ARS\":\"ARS\",\"AUD\":\"AUD\",\"AZN\":\"AZN\",\"BSD\":\"BSD\",\"BDT\":\"BDT\",\"BBD\":\"BBD\",\"BZD\":\"BZD\",\"BMD\":\"BMD\",\"BOB\":\"BOB\",\"BWP\":\"BWP\",\"BRL\":\"BRL\",\"GBP\":\"GBP\",\"BND\":\"BND\",\"BGN\":\"BGN\",\"CAD\":\"CAD\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"CRC\":\"CRC\",\"HRK\":\"HRK\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"DOP\":\"DOP\",\"XCD\":\"XCD\",\"EGP\":\"EGP\",\"EUR\":\"EUR\",\"FJD\":\"FJD\",\"GTQ\":\"GTQ\",\"HKD\":\"HKD\",\"HNL\":\"HNL\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"JMD\":\"JMD\",\"JPY\":\"JPY\",\"KZT\":\"KZT\",\"KES\":\"KES\",\"LAK\":\"LAK\",\"MMK\":\"MMK\",\"LBP\":\"LBP\",\"LRD\":\"LRD\",\"MOP\":\"MOP\",\"MYR\":\"MYR\",\"MVR\":\"MVR\",\"MRO\":\"MRO\",\"MUR\":\"MUR\",\"MXN\":\"MXN\",\"MAD\":\"MAD\",\"NPR\":\"NPR\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NIO\":\"NIO\",\"NOK\":\"NOK\",\"PKR\":\"PKR\",\"PGK\":\"PGK\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"WST\":\"WST\",\"SAR\":\"SAR\",\"SCR\":\"SCR\",\"SGD\":\"SGD\",\"SBD\":\"SBD\",\"ZAR\":\"ZAR\",\"KRW\":\"KRW\",\"LKR\":\"LKR\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"SYP\":\"SYP\",\"THB\":\"THB\",\"TOP\":\"TOP\",\"TTD\":\"TTD\",\"TRY\":\"TRY\",\"UAH\":\"UAH\",\"AED\":\"AED\",\"USD\":\"USD\",\"VUV\":\"VUV\",\"VND\":\"VND\",\"XOF\":\"XOF\",\"YER\":\"YER\"}}', '{\"approved_url\":\"ipn\"}', 'USD', 'USD', '1.00000000', '10000.00000000', '0.0000', '0.50000000', '1.00000000', '2020-09-10 09:05:02', '2022-04-24 14:28:17'),
(14, 'authorizenet', 'Authorize.Net', 7, '5f637de6d9fef.jpg', 0, '{\"login_id\":\"35s2ZJWTh2\",\"current_transaction_key\":\"3P425sHVwE8t2CzX\"}', '{\"0\":{\"AUD\":\"AUD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"USD\":\"USD\"}}', NULL, 'USD', 'USD', '1.00000000', '10000.00000000', '0.0000', '0.50000000', '0.01200000', '2020-09-10 09:05:02', '2022-04-24 14:29:17'),
(15, 'securionpay', 'SecurionPay', 22, '5f637e002d11b.jpg', 0, '{\"public_key\":\"pk_test_VZEUdaL8fYjBVbDOSkPFcgE0\",\"secret_key\":\"sk_test_yd5JJnYpsEoKtlaXDBkAFpse\"}', '{\"0\":{\"AFN\":\"AFN\", \"DZD\":\"DZD\", \"ARS\":\"ARS\", \"AUD\":\"AUD\", \"BHD\":\"BHD\", \"BDT\":\"BDT\", \"BYR\":\"BYR\", \"BAM\":\"BAM\", \"BWP\":\"BWP\", \"BRL\":\"BRL\", \"BND\":\"BND\", \"BGN\":\"BGN\", \"CAD\":\"CAD\", \"CLP\":\"CLP\", \"CNY\":\"CNY\", \"COP\":\"COP\", \"KMF\":\"KMF\", \"HRK\":\"HRK\", \"CZK\":\"CZK\", \"DKK\":\"DKK\", \"DJF\":\"DJF\", \"DOP\":\"DOP\", \"EGP\":\"EGP\", \"ETB\":\"ETB\", \"ERN\":\"ERN\", \"EUR\":\"EUR\", \"GEL\":\"GEL\", \"HKD\":\"HKD\", \"HUF\":\"HUF\", \"ISK\":\"ISK\", \"INR\":\"INR\", \"IDR\":\"IDR\", \"IRR\":\"IRR\", \"IQD\":\"IQD\", \"ILS\":\"ILS\", \"JMD\":\"JMD\", \"JPY\":\"JPY\", \"JOD\":\"JOD\", \"KZT\":\"KZT\", \"KES\":\"KES\", \"KWD\":\"KWD\", \"KGS\":\"KGS\", \"LVL\":\"LVL\", \"LBP\":\"LBP\", \"LTL\":\"LTL\", \"MOP\":\"MOP\", \"MKD\":\"MKD\", \"MGA\":\"MGA\", \"MWK\":\"MWK\", \"MYR\":\"MYR\", \"MUR\":\"MUR\", \"MXN\":\"MXN\", \"MDL\":\"MDL\", \"MAD\":\"MAD\", \"MZN\":\"MZN\", \"NAD\":\"NAD\", \"NPR\":\"NPR\", \"ANG\":\"ANG\", \"NZD\":\"NZD\", \"NOK\":\"NOK\", \"OMR\":\"OMR\", \"PKR\":\"PKR\", \"PEN\":\"PEN\", \"PHP\":\"PHP\", \"PLN\":\"PLN\", \"QAR\":\"QAR\", \"RON\":\"RON\", \"RUB\":\"RUB\", \"SAR\":\"SAR\", \"RSD\":\"RSD\", \"SGD\":\"SGD\", \"ZAR\":\"ZAR\", \"KRW\":\"KRW\", \"IKR\":\"IKR\", \"LKR\":\"LKR\", \"SEK\":\"SEK\", \"CHF\":\"CHF\", \"SYP\":\"SYP\", \"TWD\":\"TWD\", \"TZS\":\"TZS\", \"THB\":\"THB\", \"TND\":\"TND\", \"TRY\":\"TRY\", \"UAH\":\"UAH\", \"AED\":\"AED\", \"GBP\":\"GBP\", \"USD\":\"USD\", \"VEB\":\"VEB\", \"VEF\":\"VEF\", \"VND\":\"VND\", \"XOF\":\"XOF\", \"YER\":\"YER\", \"ZMK\":\"ZMK\"}}', NULL, 'USD', 'USD', '1.00000000', '10000.00000000', '0.0000', '0.50000000', '1.00000000', '2020-09-10 09:05:02', '2021-03-09 09:56:25'),
(16, 'payumoney', 'PayUmoney', 20, '5f6390dbaa6ff.jpg', 0, '{\"merchant_key\":\"gtKFFx\",\"salt\":\"eCwWELxi\"}', '{\"0\":{\"INR\":\"INR\"}}', NULL, 'INR', 'INR', '1.00000000', '10000.00000000', '0.0000', '0.50000000', '0.87000000', '2020-09-10 09:05:02', '2021-03-09 09:56:25'),
(17, 'mercadopago', 'Mercado Pago', 14, '5f645d1bc1f24.jpg', 0, '{\"access_token\":\"TEST-705032440135962-041006-ad2e021853f22338fe1a4db9f64d1491-421886156\"}', '{\"0\":{\"ARS\":\"ARS\",\"BOB\":\"BOB\",\"BRL\":\"BRL\",\"CLF\":\"CLF\",\"CLP\":\"CLP\",\"COP\":\"COP\",\"CRC\":\"CRC\",\"CUC\":\"CUC\",\"CUP\":\"CUP\",\"DOP\":\"DOP\",\"EUR\":\"EUR\",\"GTQ\":\"GTQ\",\"HNL\":\"HNL\",\"MXN\":\"MXN\",\"NIO\":\"NIO\",\"PAB\":\"PAB\",\"PEN\":\"PEN\",\"PYG\":\"PYG\",\"USD\":\"USD\",\"UYU\":\"UYU\",\"VEF\":\"VEF\",\"VES\":\"VES\"}}', NULL, 'BRL', 'BRL', '3715.12000000', '371500000.12000000', '0.0000', '0.50000000', '0.06300000', '2020-09-10 09:05:02', '2021-03-09 09:56:25'),
(18, 'coingate', 'Coingate', 11, '5f659e5355859.jpg', 0, '{\"api_key\":\"Ba1VgPx6d437xLXGKCBkmwVCEw5kHzRJ6thbGo-N\"}', '{\"0\":{\"USD\":\"USD\",\"EUR\":\"EUR\"}}', NULL, 'USD', 'USD', '1.00000000', '10000.00000000', '0.0000', '0.50000000', '1.00000000', '2020-09-10 09:05:02', '2021-03-09 09:56:25'),
(19, 'coinbasecommerce', 'Coinbase Commerce', 8, '5f6703145a5ca.jpg', 0, '{\"api_key\":\"c71152b8-ab4e-4712-a421-c5c7ea5165a2\",\"secret\":\"a709d081-e693-46e0-8a34-61fd785b20b3\"}', '{\"0\":{\"AED\":\"AED\",\"AFN\":\"AFN\",\"ALL\":\"ALL\",\"AMD\":\"AMD\",\"ANG\":\"ANG\",\"AOA\":\"AOA\",\"ARS\":\"ARS\",\"AUD\":\"AUD\",\"AWG\":\"AWG\",\"AZN\":\"AZN\",\"BAM\":\"BAM\",\"BBD\":\"BBD\",\"BDT\":\"BDT\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"BIF\":\"BIF\",\"BMD\":\"BMD\",\"BND\":\"BND\",\"BOB\":\"BOB\",\"BRL\":\"BRL\",\"BSD\":\"BSD\",\"BTN\":\"BTN\",\"BWP\":\"BWP\",\"BYN\":\"BYN\",\"BZD\":\"BZD\",\"CAD\":\"CAD\",\"CDF\":\"CDF\",\"CHF\":\"CHF\",\"CLF\":\"CLF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"CRC\":\"CRC\",\"CUC\":\"CUC\",\"CUP\":\"CUP\",\"CVE\":\"CVE\",\"CZK\":\"CZK\",\"DJF\":\"DJF\",\"DKK\":\"DKK\",\"DOP\":\"DOP\",\"DZD\":\"DZD\",\"EGP\":\"EGP\",\"ERN\":\"ERN\",\"ETB\":\"ETB\",\"EUR\":\"EUR\",\"FJD\":\"FJD\",\"FKP\":\"FKP\",\"GBP\":\"GBP\",\"GEL\":\"GEL\",\"GGP\":\"GGP\",\"GHS\":\"GHS\",\"GIP\":\"GIP\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"GTQ\":\"GTQ\",\"GYD\":\"GYD\",\"HKD\":\"HKD\",\"HNL\":\"HNL\",\"HRK\":\"HRK\",\"HTG\":\"HTG\",\"HUF\":\"HUF\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"IMP\":\"IMP\",\"INR\":\"INR\",\"IQD\":\"IQD\",\"IRR\":\"IRR\",\"ISK\":\"ISK\",\"JEP\":\"JEP\",\"JMD\":\"JMD\",\"JOD\":\"JOD\",\"JPY\":\"JPY\",\"KES\":\"KES\",\"KGS\":\"KGS\",\"KHR\":\"KHR\",\"KMF\":\"KMF\",\"KPW\":\"KPW\",\"KRW\":\"KRW\",\"KWD\":\"KWD\",\"KYD\":\"KYD\",\"KZT\":\"KZT\",\"LAK\":\"LAK\",\"LBP\":\"LBP\",\"LKR\":\"LKR\",\"LRD\":\"LRD\",\"LSL\":\"LSL\",\"LYD\":\"LYD\",\"MAD\":\"MAD\",\"MDL\":\"MDL\",\"MGA\":\"MGA\",\"MKD\":\"MKD\",\"MMK\":\"MMK\",\"MNT\":\"MNT\",\"MOP\":\"MOP\",\"MRO\":\"MRO\",\"MUR\":\"MUR\",\"MVR\":\"MVR\",\"MWK\":\"MWK\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"MZN\":\"MZN\",\"NAD\":\"NAD\",\"NGN\":\"NGN\",\"NIO\":\"NIO\",\"NOK\":\"NOK\",\"NPR\":\"NPR\",\"NZD\":\"NZD\",\"OMR\":\"OMR\",\"PAB\":\"PAB\",\"PEN\":\"PEN\",\"PGK\":\"PGK\",\"PHP\":\"PHP\",\"PKR\":\"PKR\",\"PLN\":\"PLN\",\"PYG\":\"PYG\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"RUB\":\"RUB\",\"RWF\":\"RWF\",\"SAR\":\"SAR\",\"SBD\":\"SBD\",\"SCR\":\"SCR\",\"SDG\":\"SDG\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"SHP\":\"SHP\",\"SLL\":\"SLL\",\"SOS\":\"SOS\",\"SRD\":\"SRD\",\"SSP\":\"SSP\",\"STD\":\"STD\",\"SVC\":\"SVC\",\"SYP\":\"SYP\",\"SZL\":\"SZL\",\"THB\":\"THB\",\"TJS\":\"TJS\",\"TMT\":\"TMT\",\"TND\":\"TND\",\"TOP\":\"TOP\",\"TRY\":\"TRY\",\"TTD\":\"TTD\",\"TWD\":\"TWD\",\"TZS\":\"TZS\",\"UAH\":\"UAH\",\"UGX\":\"UGX\",\"USD\":\"USD\",\"UYU\":\"UYU\",\"UZS\":\"UZS\",\"VEF\":\"VEF\",\"VND\":\"VND\",\"VUV\":\"VUV\",\"WST\":\"WST\",\"XAF\":\"XAF\",\"XAG\":\"XAG\",\"XAU\":\"XAU\",\"XCD\":\"XCD\",\"XDR\":\"XDR\",\"XOF\":\"XOF\",\"XPD\":\"XPD\",\"XPF\":\"XPF\",\"XPT\":\"XPT\",\"YER\":\"YER\",\"ZAR\":\"ZAR\",\"ZMW\":\"ZMW\",\"ZWL\":\"ZWL\"}}', NULL, 'USD', 'USD', '1.00000000', '10000.00000000', '0.0000', '0.50000000', '1.00000000', '2020-09-10 09:05:02', '2021-03-09 09:56:25'),
(20, 'monnify', 'Monnify', 16, '5fbca5d05057f.jpg', 0, '{\"api_key\":\"MK_TEST_LB5KJDYD65\",\"secret_key\":\"WM9B4GSW826XRCNABM3NF92K9957CVMU\", \"contract_code\":\"5566252118\"}', '{\"0\":{\"NGN\":\"NGN\"}}', NULL, 'NGN', 'NGN', '1.00000000', '10000.00000000', '0.0000', '0.50000000', '4.52000000', '2020-09-10 09:05:02', '2021-03-09 09:56:25'),
(21, 'blockio', 'Block.io', 5, '5fe038332ad52.jpg', 0, '{\"api_key\":\"1d97-a9af-6521-a330\",\"api_pin\":\"654abc654opp\"}', '{\"1\":{\"BTC\":\"BTC\",\"LTC\":\"LTC\",\"DOGE\":\"DOGE\"}}', '{\"cron\":\"ipn\"}', 'BTC', 'BTC', '10.10004200', '10000.00000000', '0.0000', '0.50000000', '0.00004200', '2020-09-10 09:05:02', '2022-04-24 14:28:58'),
(22, 'coinpayments', 'CoinPayments', 10, '5ffd7d962985e1610448278.jpg', 0, '{\"merchant_id\":\"93a1e014c4ad60a7980b4a7239673cb4\"}', '{\"0\":{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\"},\"1\":{\"BTC\":\"Bitcoin\",\"BTC.LN\":\"Bitcoin (Lightning Network)\",\"LTC\":\"Litecoin\",\"CPS\":\"CPS Coin\",\"VLX\":\"Velas\",\"APL\":\"Apollo\",\"AYA\":\"Aryacoin\",\"BAD\":\"Badcoin\",\"BCD\":\"Bitcoin Diamond\",\"BCH\":\"Bitcoin Cash\",\"BCN\":\"Bytecoin\",\"BEAM\":\"BEAM\",\"BITB\":\"Bean Cash\",\"BLK\":\"BlackCoin\",\"BSV\":\"Bitcoin SV\",\"BTAD\":\"Bitcoin Adult\",\"BTG\":\"Bitcoin Gold\",\"BTT\":\"BitTorrent\",\"CLOAK\":\"CloakCoin\",\"CLUB\":\"ClubCoin\",\"CRW\":\"Crown\",\"CRYP\":\"CrypticCoin\",\"CRYT\":\"CryTrExCoin\",\"CURE\":\"CureCoin\",\"DASH\":\"DASH\",\"DCR\":\"Decred\",\"DEV\":\"DeviantCoin\",\"DGB\":\"DigiByte\",\"DOGE\":\"Dogecoin\",\"EBST\":\"eBoost\",\"EOS\":\"EOS\",\"ETC\":\"Ether Classic\",\"ETH\":\"Ethereum\",\"ETN\":\"Electroneum\",\"EUNO\":\"EUNO\",\"EXP\":\"EXP\",\"Expanse\":\"Expanse\",\"FLASH\":\"FLASH\",\"GAME\":\"GameCredits\",\"GLC\":\"Goldcoin\",\"GRS\":\"Groestlcoin\",\"KMD\":\"Komodo\",\"LOKI\":\"LOKI\",\"LSK\":\"LSK\",\"MAID\":\"MaidSafeCoin\",\"MUE\":\"MonetaryUnit\",\"NAV\":\"NAV Coin\",\"NEO\":\"NEO\",\"NMC\":\"Namecoin\",\"NVST\":\"NVO Token\",\"NXT\":\"NXT\",\"OMNI\":\"OMNI\",\"PINK\":\"PinkCoin\",\"PIVX\":\"PIVX\",\"POT\":\"PotCoin\",\"PPC\":\"Peercoin\",\"PROC\":\"ProCurrency\",\"PURA\":\"PURA\",\"QTUM\":\"QTUM\",\"RES\":\"Resistance\",\"RVN\":\"Ravencoin\",\"RVR\":\"RevolutionVR\",\"SBD\":\"Steem Dollars\",\"SMART\":\"SmartCash\",\"SOXAX\":\"SOXAX\",\"STEEM\":\"STEEM\",\"STRAT\":\"STRAT\",\"SYS\":\"Syscoin\",\"TPAY\":\"TokenPay\",\"TRIGGERS\":\"Triggers\",\"TRX\":\" TRON\",\"UBQ\":\"Ubiq\",\"UNIT\":\"UniversalCurrency\",\"USDT\":\"Tether USD (Omni Layer)\",\"VTC\":\"Vertcoin\",\"WAVES\":\"Waves\",\"XCP\":\"Counterparty\",\"XEM\":\"NEM\",\"XMR\":\"Monero\",\"XSN\":\"Stakenet\",\"XSR\":\"SucreCoin\",\"XVG\":\"VERGE\",\"XZC\":\"ZCoin\",\"ZEC\":\"ZCash\",\"ZEN\":\"Horizen\"}}', NULL, 'BTC', 'BTC', '10.00000000', '99999.00000000', '1.0000', '0.50000000', '0.00000000', '2020-09-10 09:05:02', '2021-03-09 09:56:25'),
(23, 'blockchain', 'Blockchain', 6, '5fe439f477bb7.jpg', 0, '{\"api_key\":\"8df2e5a0-3798-4b74-871d-973615b57e7b\",\"xpub_code\":\"xpub6CXLqfWXj1xgXe79nEQb3pv2E7TGD13pZgHceZKrQAxqXdrC2FaKuQhm5CYVGyNcHLhSdWau4eQvq3EDCyayvbKJvXa11MX9i2cHPugpt3G\"}', '{\"1\":{\"BTC\":\"BTC\"}}', NULL, 'BTC', 'BTC', '100.00000000', '10000.00000000', '0.0000', '0.50000000', '0.00000000', '2020-09-10 09:05:02', '2021-03-09 09:56:25'),
(25, 'cashmaal', 'cashmaal', 9, 'cashmaal.jpg', 0, '{\"web_id\": \"3748\",\"ipn_key\": \"546254628759524554647987\"}\r\n', '{\"0\":{\"PKR\":\"PKR\",\"USD\":\"USD\"}}', '{\"ipn_url\":\"ipn\"}', 'PKR', 'PKR', '100.00000000', '10000.00000000', '0.0000', '0.50000000', '0.85000000', '2020-09-10 09:05:02', '2021-03-09 09:56:25');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_name` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = active, 0 = inactive',
  `rtl` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `short_name`, `flag`, `is_active`, `rtl`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', NULL, 1, 0, '2021-01-21 05:38:01', '2021-01-21 05:38:01'),
(5, 'spanish', 'AF', NULL, 0, 0, '2021-01-26 04:14:25', '2022-04-24 20:22:47'),
(9, 'Arabic', 'sy', NULL, 1, 1, '2021-03-08 18:29:27', '2022-03-03 05:52:36');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_09_19_063525_create_services_table', 1),
(5, '2020_09_19_064324_create_categories_table', 1),
(6, '2020_09_24_055426_create_api_providers_table', 1),
(7, '2020_09_29_074810_create_jobs_table', 1),
(8, '2020_10_03_071622_create_orders_table', 1),
(9, '2020_10_14_113046_create_admins_table', 1),
(10, '2020_11_12_075639_create_transactions_table', 1),
(11, '2020_11_24_064711_create_email_templates_table', 1),
(12, '2020_12_17_075238_create_sms_controls_table', 1),
(13, '2021_01_03_061604_create_tickets_table', 1),
(14, '2021_01_03_061834_create_ticket_messages_table', 1),
(15, '2021_01_03_065607_create_ticket_attachments_table', 1),
(16, '2021_01_07_095019_create_funds_table', 1),
(17, '2021_01_20_055427_create_notices_table', 1),
(18, '2021_01_21_050226_create_languages_table', 1),
(19, '2021_01_26_051716_create_site_notifications_table', 1),
(20, '2021_01_26_075451_create_notify_templates_table', 1),
(21, '2021_01_28_074544_create_contents_table', 1),
(22, '2021_01_28_074705_create_content_details_table', 1),
(23, '2021_01_28_074829_create_content_media_table', 1),
(24, '2021_01_28_074847_create_templates_table', 1),
(25, '2021_01_28_074905_create_template_media_table', 1),
(26, '2021_02_03_100945_create_subscribers_table', 1),
(27, '2021_02_06_051421_create_user_service_rates_table', 1),
(28, '2021_10_19_083249_create_configures_table', 2),
(30, '2021_10_19_160439_create_colors_table', 3),
(31, '2022_05_23_064427_update_services_table', 4),
(32, '2022_05_23_064700_update_users_table', 4),
(33, '2022_05_23_100806_update_categories_table', 5),
(34, '2022_05_23_111854_update_categories_add_special_feild_table', 6),
(35, '2022_05_23_124041_create_service_codes_table', 7),
(36, '2022_05_25_124155_create_balance_coupons_table', 8),
(37, '2022_05_25_181430_update_coupon_balance_table', 9),
(38, '2022_05_26_091122_update_service_table', 10),
(39, '2022_05_26_113831_update_orders_table', 11),
(40, '2022_05_26_212446_create_coupons_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `highlight_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notify_templates`
--

CREATE TABLE `notify_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `template_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_keys` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `notify_for` tinyint(1) NOT NULL DEFAULT 0,
  `lang_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notify_templates`
--

INSERT INTO `notify_templates` (`id`, `language_id`, `name`, `template_key`, `body`, `short_keys`, `status`, `notify_for`, `lang_code`, `created_at`, `updated_at`) VALUES
(1, 1, 'SUPPORT TICKET CREATE', 'SUPPORT_TICKET_CREATE', '[[username]] create a ticket\r\nTicket : [[ticket_id]]\r\n\r\n', '{\"ticket_id\":\"Support Ticket ID\",\"username\":\"username\"}', 1, 1, NULL, '2021-01-26 04:14:36', '2021-01-26 04:14:36'),
(2, 1, 'SUPPORT TICKET REPLIED', 'SUPPORT_TICKET_REPLIED', '[[username]] replied  ticket\r\nTicket : [[ticket_id]]\r\n\r\n', '{\"ticket_id\":\"Support Ticket ID\",\"username\":\"username\"}', 1, 1, NULL, '2021-01-26 04:14:36', '2021-01-26 04:14:36'),
(3, 1, 'ADMIN REPLIED SUPPORT TICKET ', 'ADMIN_REPLIED_TICKET', 'Admin replied  \r\nTicket : [[ticket_id]]', '{\"ticket_id\":\"Support Ticket ID\"}', 1, 0, 'en', '2021-01-26 04:14:36', '2021-01-26 05:37:30'),
(4, 1, 'ADMIN DEPOSIT NOTIFICATION', 'PAYMENT_COMPLETE', '[[username]] deposited [[amount]] [[currency]] via [[gateway]]\r\n', '{\"gateway\":\"gateway\",\"amount\":\"amount\",\"currency\":\"currency\",\"username\":\"username\"}', 1, 1, NULL, '2021-01-26 04:14:36', '2021-01-26 04:14:36'),
(5, 1, 'ADD BALANCE', 'ADD_BALANCE', '[[amount]] [[currency]] credited in your account. \r\n\r\n\r\nYour Current Balance [[main_balance]][[currency]]\r\n\r\nTransaction: #[[transaction]]', '{\"transaction\":\"Transaction Number\",\"amount\":\"Request Amount By Admin\",\"currency\":\"Site Currency\", \"main_balance\":\"Users Balance After this operation\"}', 1, 0, 'en', '2021-01-26 04:14:36', '2021-01-26 05:37:30'),
(6, 1, 'DEDUCTED BALANCE', 'DEDUCTED_BALANCE', '[[amount]] [[currency]] debited in your account.\r\n\r\nYour Current Balance [[main_balance]][[currency]]\r\n\r\nTransaction: #[[transaction]]', '{\"transaction\":\"Transaction Number\",\"amount\":\"Request Amount By Admin\",\"currency\":\"Site Currency\", \"main_balance\":\"Users Balance After this operation\"}', 1, 0, 'en', '2021-01-26 04:14:36', '2021-01-26 05:37:30'),
(7, 1, 'New User Added', 'ADDED_USER', '[[username]] has been joined\r\n\r\n', '{\"username\":\"username\"}', 1, 1, 'en', '2021-01-26 04:14:36', '2021-01-26 05:37:30'),
(8, 1, 'ORDER CREATE', 'ORDER_CREATE', '[[price]]  [[currency]]  order by \r\n\r\n[[username]]\r\n\r\n', '{\"price\":\"Orer Price\",\"currency\":\"currency\",\"username\":\"username\"}', 1, 1, NULL, '2021-01-26 04:14:36', '2021-01-26 04:14:36'),
(9, 1, 'ORDER STATUS', 'ORDER_STATUS_CHANGED', 'Your order [[order_id]] has been [[status]]\r\n', '{\"order_id\":\"Orer ID\",\"status\":\"status\"}', 1, 0, NULL, '2021-01-26 04:14:36', '2021-01-26 04:14:36'),
(10, 9, 'ADD BALANCE', 'ADD_BALANCE', '[[amount]] [[currency]] credited in your account. \r\n\r\n\r\nYour Current Balance [[main_balance]][[currency]]\r\n\r\nTransaction: #[[transaction]]', '{\"transaction\":\"Transaction Number\",\"amount\":\"Request Amount By Admin\",\"currency\":\"Site Currency\",\"main_balance\":\"Users Balance After this operation\"}', 1, 0, 'ar', '2021-03-09 10:05:21', '2021-03-09 10:05:21'),
(11, 5, 'ADD BALANCE', 'ADD_BALANCE', '[[amount]] [[currency]] credited in your account. \r\n\r\n\r\nYour Current Balance [[main_balance]][[currency]]\r\n\r\nTransaction: #[[transaction]]', '{\"transaction\":\"Transaction Number\",\"amount\":\"Request Amount By Admin\",\"currency\":\"Site Currency\",\"main_balance\":\"Users Balance After this operation\"}', 1, 0, 'es', '2021-03-09 10:05:21', '2021-03-09 10:05:21');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `category_id` bigint(20) DEFAULT NULL,
  `service_id` bigint(20) DEFAULT NULL,
  `api_order_id` int(11) DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` bigint(20) DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agree` tinyint(4) DEFAULT NULL,
  `start_counter` bigint(20) DEFAULT NULL,
  `remains` bigint(20) DEFAULT NULL,
  `runs` tinyint(4) DEFAULT NULL,
  `interval` tinyint(4) DEFAULT NULL,
  `drip_feed` tinyint(4) DEFAULT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `category_id`, `service_id`, `api_order_id`, `link`, `quantity`, `price`, `status`, `status_description`, `reason`, `agree`, `start_counter`, `remains`, `runs`, `interval`, `drip_feed`, `added_on`, `created_at`, `updated_at`, `details`) VALUES
(1, 2, 2, 1, NULL, 'http://badaelonline.com/about', 500, 26.00, 'completed', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-22 16:08:18', '2022-04-22 13:07:13', '2022-04-22 13:08:18', NULL),
(2, 2, 3, 3, NULL, '345', 2, 0.04, 'processing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-25 11:07:08', '2022-04-25 08:07:08', '2022-04-25 08:07:08', NULL),
(3, 2, 2, 2, NULL, 'wer', 1, 0.72, 'processing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-26 20:57:35', '2022-04-26 17:57:35', '2022-04-26 17:57:35', NULL),
(4, 2, 2, 1, NULL, '34535', 1, 0.05, 'processing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-26 21:11:36', '2022-04-26 18:11:36', '2022-04-26 18:11:36', NULL),
(5, 2, 2, 1, NULL, '2354', 1, 0.05, 'processing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-26 21:15:35', '2022-04-26 18:15:35', '2022-04-26 18:15:35', NULL),
(6, 2, 2, 2, NULL, '', 1, 0.70, 'completed', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-26 10:31:13', '2022-05-26 07:27:03', '2022-05-26 07:31:13', NULL),
(7, 2, 2, 2, NULL, '', 1, 0.70, 'processing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-26 10:29:20', '2022-05-26 07:29:20', '2022-05-26 07:29:20', NULL),
(8, 2, 2, 2, NULL, '', 1, 0.70, 'processing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-26 10:41:21', '2022-05-26 07:41:21', '2022-05-26 07:41:21', NULL),
(9, 2, 2, 2, NULL, '', 1, 0.70, 'processing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-26 10:41:42', '2022-05-26 07:41:42', '2022-05-26 07:41:42', NULL),
(10, 2, 2, 2, NULL, '', 1, 0.70, 'processing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-26 10:43:36', '2022-05-26 07:43:36', '2022-05-26 07:43:36', NULL),
(11, 2, 4, 4, NULL, '', 500, 20.00, 'processing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-26 10:48:53', '2022-05-26 07:48:53', '2022-05-26 07:48:53', NULL),
(12, 2, 4, 4, NULL, '', 500, 20.00, 'processing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-26 10:49:18', '2022-05-26 07:49:18', '2022-05-26 07:49:18', NULL),
(13, 2, 4, 4, NULL, '', 500, 20.00, 'processing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-26 10:49:35', '2022-05-26 07:49:35', '2022-05-26 07:49:35', NULL),
(14, 2, 4, 4, NULL, '', 500, 20.00, 'processing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-26 10:50:38', '2022-05-26 07:50:38', '2022-05-26 07:50:38', NULL),
(15, 2, 4, 4, NULL, '', 500, 20.00, 'processing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-26 10:50:51', '2022-05-26 07:50:51', '2022-05-26 07:50:51', NULL),
(16, 2, 4, 4, NULL, '', 500, 20.00, 'processing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-26 10:52:04', '2022-05-26 07:52:04', '2022-05-26 07:52:04', NULL),
(17, 2, 4, 4, NULL, '', 500, 20.00, 'processing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-26 10:52:14', '2022-05-26 07:52:14', '2022-05-26 07:52:14', NULL),
(18, 2, 4, 4, NULL, '', 500, 20.00, 'processing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-26 10:52:19', '2022-05-26 07:52:19', '2022-05-26 07:52:19', NULL),
(19, 2, 4, 4, NULL, '', 500, 20.00, 'processing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-26 11:00:03', '2022-05-26 08:00:03', '2022-05-26 08:00:03', NULL),
(20, 2, 4, 4, NULL, '', 500, 20.00, 'processing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-26 11:00:27', '2022-05-26 08:00:27', '2022-05-26 08:00:27', NULL),
(21, 2, 4, 4, NULL, '', 500, 20.00, 'processing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-26 11:25:46', '2022-05-26 08:25:46', '2022-05-26 08:25:46', NULL),
(22, 2, 4, 4, NULL, '', 500, 20.00, 'processing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-26 11:27:46', '2022-05-26 08:27:46', '2022-05-26 08:27:46', NULL),
(23, 2, 4, 4, NULL, '', 500, 20.00, 'processing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-26 11:28:17', '2022-05-26 08:28:17', '2022-05-26 08:28:17', NULL),
(24, 2, 4, 4, NULL, '', 500, 20.00, 'processing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-26 11:29:29', '2022-05-26 08:29:29', '2022-05-26 08:29:29', NULL),
(25, 2, 4, 4, NULL, '', 500, 20.00, 'processing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-26 11:29:58', '2022-05-26 08:29:58', '2022-05-26 08:29:58', NULL),
(32, 2, 4, 4, NULL, '', 500, 20.00, 'processing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-26 11:45:13', '2022-05-26 08:45:13', '2022-05-26 08:45:13', 'Service code is : wgewegwegw, and id is 3'),
(33, 2, 2, 2, NULL, '878787', 2, 1.40, 'processing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-26 11:45:46', '2022-05-26 08:45:46', '2022-05-26 08:45:46', NULL),
(34, 1, 2, 1, NULL, '', 1, 0.04, 'processing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-27 17:25:03', '2022-05-27 14:25:03', '2022-05-27 14:25:03', NULL),
(35, 1, 2, 1, NULL, '', 1, 0.04, 'processing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-27 17:25:30', '2022-05-27 14:25:30', '2022-05-27 14:25:30', NULL),
(36, 1, 2, 1, NULL, '46546', 1, 0.04, 'processing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-27 17:54:50', '2022-05-27 14:54:50', '2022-05-27 14:54:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_amount` bigint(20) DEFAULT NULL,
  `max_amount` bigint(20) DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_status` tinyint(4) DEFAULT NULL,
  `service_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_provider_id` bigint(20) DEFAULT NULL,
  `api_service_id` bigint(20) DEFAULT NULL,
  `api_provider_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `drip_feed` tinyint(4) DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `special_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_title`, `category_id`, `link`, `username`, `min_amount`, `max_amount`, `price`, `service_status`, `service_type`, `api_provider_id`, `api_service_id`, `api_provider_price`, `drip_feed`, `description`, `created_at`, `updated_at`, `special_price`, `is_available`) VALUES
(1, '30000uc', 2, NULL, NULL, 1, 20, '50', 1, NULL, 0, 0, NULL, 0, '', '2022-04-22 12:58:38', '2022-05-26 06:55:56', '40', 1),
(2, '300uc', 2, NULL, NULL, 1, 20, '720', 1, NULL, 0, 0, NULL, 0, '', '2022-04-22 12:58:38', '2022-05-26 07:30:43', '700', 0),
(3, '40uc', 3, NULL, NULL, 1, 5000, '22', 1, NULL, 0, 0, NULL, 1, '', '2022-04-25 08:06:35', '2022-05-26 06:55:42', '22', 1),
(4, 'test', 4, NULL, NULL, 500, 5000, '50', 1, NULL, NULL, 0, NULL, 0, 'test', '2022-05-23 04:05:07', '2022-05-23 04:05:07', '40', 1);

-- --------------------------------------------------------

--
-- Table structure for table `service_codes`
--

CREATE TABLE `service_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_used` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_codes`
--

INSERT INTO `service_codes` (`id`, `created_at`, `updated_at`, `service_id`, `code`, `is_active`, `is_used`) VALUES
(1, NULL, NULL, 1, 'gsfgsdgsdg', 1, 0),
(2, NULL, NULL, 2, 'dsgsdgss', 1, 0),
(3, '2022-05-25 04:45:00', '2022-05-26 08:45:13', 4, 'wgewegwegw', 1, 1),
(4, '2022-05-25 04:47:53', '2022-05-26 08:40:07', 4, 'wgewegwegw', 1, 0),
(5, '2022-05-25 04:48:14', '2022-05-26 08:42:54', 4, 'testttttt', 1, 0),
(6, '2022-05-25 08:02:46', '2022-05-26 08:43:23', 4, 'ttttttttttttt', 1, 0),
(7, '2022-05-25 08:02:46', '2022-05-26 08:43:54', 4, 'yyyyyyyyyyyy', 1, 0),
(8, '2022-05-25 08:02:46', '2022-05-26 08:44:02', 4, 'sssssssssssssssss', 1, 0),
(9, '2022-05-25 08:23:12', '2022-05-25 08:23:12', 2, 'dgfsdgsdg', 1, 0),
(10, '2022-05-25 08:23:12', '2022-05-25 08:23:12', 2, 'dsgsdgsdg', 1, 0),
(11, '2022-05-25 08:23:12', '2022-05-25 08:23:12', 2, 'sdgsdgsdgsdg', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `site_notifications`
--

CREATE TABLE `site_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_notificational_id` bigint(20) NOT NULL,
  `site_notificational_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_notifications`
--

INSERT INTO `site_notifications` (`id`, `site_notificational_id`, `site_notificational_type`, `description`, `created_at`, `updated_at`) VALUES
(2, 1, 'App\\Models\\User', '{\"link\":\"#\",\"icon\":\"fa fa-money-bill-alt text-white\",\"text\":\"123 USD credited in your account. \\r\\n\\r\\n\\r\\nYour Current Balance 123USD\\r\\n\\r\\nTransaction: #4HAFK38V23JH\"}', '2022-03-03 05:58:29', '2022-03-03 05:58:29'),
(3, 1, 'App\\Models\\User', '{\"link\":\"#\",\"icon\":\"fa fa-money-bill-alt text-white\",\"text\":\"123 USD credited in your account. \\r\\n\\r\\n\\r\\nYour Current Balance 246USD\\r\\n\\r\\nTransaction: #ZX2HS1CZQSCB\"}', '2022-03-03 05:59:27', '2022-03-03 05:59:27'),
(4, 1, 'App\\Models\\User', '{\"link\":\"#\",\"icon\":\"fa fa-money-bill-alt text-white\",\"text\":\"123 USD credited in your account. \\r\\n\\r\\n\\r\\nYour Current Balance 369USD\\r\\n\\r\\nTransaction: #SX75KWXWR83U\"}', '2022-03-03 06:00:08', '2022-03-03 06:00:08'),
(5, 1, 'App\\Models\\User', '{\"link\":\"#\",\"icon\":\"fa fa-money-bill-alt text-white\",\"text\":\"123 USD credited in your account. \\r\\n\\r\\n\\r\\nYour Current Balance 492USD\\r\\n\\r\\nTransaction: #WTF2M56P349T\"}', '2022-03-03 06:24:40', '2022-03-03 06:24:40'),
(7, 2, 'App\\Models\\User', '{\"link\":\"#\",\"icon\":\"fa fa-money-bill-alt text-white\",\"text\":\"200 USD credited in your account. \\r\\n\\r\\n\\r\\nYour Current Balance 200USD\\r\\n\\r\\nTransaction: #R9UBGXW3DO8K\"}', '2022-04-22 13:04:01', '2022-04-22 13:04:01');

-- --------------------------------------------------------

--
-- Table structure for table `sms_controls`
--

CREATE TABLE `sms_controls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `actionMethod` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actionUrl` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `headerData` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paramData` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `formData` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_controls`
--

INSERT INTO `sms_controls` (`id`, `actionMethod`, `actionUrl`, `headerData`, `paramData`, `formData`, `created_at`, `updated_at`) VALUES
(1, 'POST', 'https://rest.nexmo.com/sms/json', '{\"Content-Type\":\"application\\/x-www-form-urlencoded\"}', NULL, '{\"from\":\"Rownak\",\"text\":\"[[message]]\",\"to\":\"[[receiver]]\",\"api_key\":\"930cc608\",\"api_secret\":\"2pijsaMOUw5YKOK5\"}', '2020-12-13 01:45:29', '2021-01-24 04:37:45');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` bigint(20) UNSIGNED DEFAULT NULL,
  `section_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `language_id`, `section_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'hero', '{\"title\":\"SYRIA MARKET\",\"short_description\":\"<p>SYRIA MARKET<\\/p>\",\"button_name\":\"Learn\"}', '2021-01-31 03:13:17', '2022-04-24 20:56:48'),
(2, 5, 'hero', '{\"title\":\"Haga crecer su negocio con nuestra soluci\\u00f3n SMM\",\"short_description\":\"SMM Mtarix es simplemente el panel m\\u00e1s grande, m\\u00e1s r\\u00e1pido y m\\u00e1s barato del mundo SMM.\",\"button_name\":\"Aprende m\\u00e1s\"}', '2021-01-31 03:18:54', '2021-10-20 06:54:05'),
(3, 1, 'about-us', '{\"title\":\"About\",\"sub_title\":\"WHO WE ARE\",\"short_title\":\"\",\"short_description\":\"SYRIA MARKET<p><\\/p>\"}', '2021-01-31 03:25:43', '2022-04-24 20:55:18'),
(4, 5, 'about-us', '{\"title\":\"Acerca de\",\"sub_title\":\"QUIENES SOMOS\",\"short_title\":\"Ayudamos a hacer crecer su negocio See Smm.\",\"short_description\":\"<p>SMM Matrix is one of the renowned SMM reseller Panel exist on the internet.<\\/p><p>We have been providing services for 5+ years and provides services for almost every kind of Social Media. Our Social Media Marketing Services include SMM for Facebook, Instagram, Twitter, Youtube, Tiktok, LinkedIn, Shazam and many more.<\\/p> We are providing an Opportunity to make handsome amount of money by reselling our social media services on your own social media marketing or by selling them on Various Marketplace.\"}', '2021-01-31 03:27:13', '2021-10-20 11:57:44'),
(5, 1, 'service', '{\"title\":\"Services\",\"sub_title\":\"WHAT WE DO\",\"short_title\":\"How We\'re Helping\"}', '2021-01-31 03:54:15', '2021-01-31 03:54:15'),
(6, 5, 'service', '{\"title\":\"Servicios\",\"sub_title\":\"Que hacemos\",\"short_title\":\"C\\u00f3mo estamos ayudando\"}', '2021-01-31 03:54:49', '2021-01-31 03:54:49'),
(7, 1, 'call-to-action', '{\"title\":\"SYRIA MARKET\",\"sub_title\":\"SYRIA MARKET\",\"button_name\":\"Learn More\"}', '2021-01-31 03:57:13', '2022-04-24 20:58:38'),
(8, 5, 'call-to-action', '{\"title\":\"Llevaremos a m\\u00e1s clientes a su negocio que cualquier otra fuente en l\\u00ednea.\",\"sub_title\":\"Multiplica 10 veces el tr\\u00e1fico de Facebook de tu empresa\",\"button_name\":\"Aprende m\\u00e1s\",\"button_link\":\"\\/register\"}', '2021-01-31 03:58:25', '2021-01-31 03:58:25'),
(9, 1, 'contact-us', '{\"heading\":\"GET IN TOUCH\",\"sub_heading\":\"Let\'s Ask Your Questions\",\"title\":\"Contact Us\",\"sub_title\":\"SYRIA MARKET\",\"address\":\"22 Baker Street, London\",\"email\":\"hello@website.com\",\"phone\":\"+44-20-4526-2356\",\"footer_short_details\":\"SYRIA MARKET\"}', '2021-01-31 04:14:18', '2022-04-24 20:59:28'),
(10, 5, 'contact-us', '{\"heading\":\"PONERSE EN CONTACTO\",\"sub_heading\":\"Hagamos sus preguntas\",\"title\":\"Contacta con nosotros\",\"sub_title\":\"Ll\\u00e1menos o vis\\u00edtenos en cualquier momento, nos esforzamos por responder a todas las consultas dentro de las 24 horas en d\\u00edas h\\u00e1biles. Estaremos encantados de responder a sus preguntas.\",\"address\":\"22 Baker Street, London\",\"email\":\"email@website.com\",\"phone\":\"+44-20-4526-2356\",\"footer_short_details\":\"We focus on the needs of small to middle market businesses to improve and grow their return.\"}', '2021-01-31 04:15:46', '2021-02-03 00:28:13'),
(11, 1, 'testimonial', '{\"title\":\"Testimonial\",\"sub_title\":\"CLIENTS APPRAISAL\",\"short_title\":\"What Our Client\'s Say.\"}', '2021-01-31 23:54:11', '2021-01-31 23:54:11'),
(12, 5, 'testimonial', '{\"title\":\"Testimonial\",\"sub_title\":\"VALORACI\\u00d3N DE CLIENTES\",\"short_title\":\"Lo que dicen nuestros clientes.\"}', '2021-02-01 00:24:57', '2021-02-01 00:24:57'),
(13, 1, 'login', '{\"title\":\"Proclamations About Us\",\"description\":\"<ul><li>\\n                                        <p><span>Unbelievable prices, lowest in the market.<\\/span><br \\/><\\/p>\\n                                    <\\/li>\\n                                    <li>\\n                                        <p><span>Engineered Dashboard to accomodate fast and simple use of the panel, best in the market.<\\/span><br \\/><\\/p>\\n                                    <\\/li>\\n                                    <li>\\n                                        <p><span>Super fast delivery, fastest in the market.<\\/span><br \\/><\\/p>\\n                                    <\\/li>\\n                                    <li>\\n                                        <p><span>Support available around the clock, nothing like it in the market.<\\/span><\\/p><\\/li><\\/ul>\"}', '2021-02-01 05:28:09', '2021-03-09 10:38:03'),
(14, 5, 'login', '{\"title\":\"Proclamaciones sobre nosotro\",\"description\":\"<p><\\/p><p><\\/p><ul><li>Precios incre\\u00edbles, los m\\u00e1s bajos del mercado.<\\/li><li><span>Tablero dise\\u00f1ado para adaptarse a un uso r\\u00e1pido y simple del panel, el mejor del mercado.<\\/span><br \\/><\\/li><li>Entrega superr\\u00e1pida, la m\\u00e1s r\\u00e1pida del mercado.<\\/li><li>Soporte disponible las 24 horas, nada parecido en el mercado.<\\/li><\\/ul>\"}', '2021-02-01 05:29:45', '2021-03-09 10:43:50'),
(15, 1, 'register', '{\"title\":\"Proclamations About Us\",\"description\":\"<ul><li><span>Unbelievable prices, lowest in the market.<\\/span><br \\/><\\/li><\\/ul><p><\\/p><ul><li>Engineered Dashboard to accomodate fast and simple use of the panel, best in the market.<br \\/><\\/li><\\/ul><p><\\/p><ul><li>Super fast delivery, fastest in the market.<br \\/><\\/li><\\/ul><p><\\/p><ul><li>Support available around the clock, nothing like it in the market.<\\/li><\\/ul>\"}', '2021-02-01 05:32:44', '2021-03-09 10:45:03'),
(16, 5, 'register', '{\"title\":\"Proclamaciones sobre nosotro\",\"description\":\"<ul><li>Precios incre\\u00edbles, los m\\u00e1s bajos del mercado.<\\/li><li>Tablero dise\\u00f1ado para adaptarse a un uso r\\u00e1pido y simple del panel, el mejor del mercado.<br \\/><\\/li><li>Entrega superr\\u00e1pida, la m\\u00e1s r\\u00e1pida del mercado.<\\/li><li>Soporte disponible las 24 horas, nada parecido en el mercado.<\\/li><\\/ul>\"}', '2021-02-01 05:33:22', '2021-03-09 10:45:17'),
(17, 1, 'forget-password', '{\"title\":\"Proclamations About Us\",\"description\":\"<ul><li><p>Unbelievable prices, lowest in the market.<br \\/><\\/p><\\/li><li><p>Engineered Dashboard to accomodate fast and simple use of the panel, best in the market.<br \\/><\\/p><\\/li><li><p>Super fast delivery, fastest in the market.<br \\/><\\/p><\\/li><li><p>Support available around the clock, nothing like it in the market.<\\/p><\\/li><\\/ul>\"}', '2021-02-01 05:33:59', '2021-03-09 10:46:07'),
(18, 5, 'forget-password', '{\"title\":\"Proclamaciones sobre nosotro\",\"description\":\"<ul><li>Precios incre\\u00edbles, los m\\u00e1s bajos del mercado.<\\/li><li>Tablero dise\\u00f1ado para adaptarse a un uso r\\u00e1pido y simple del panel, el mejor del mercado.<br \\/><\\/li><li>Entrega superr\\u00e1pida, la m\\u00e1s r\\u00e1pida del mercado.<\\/li><li>Soporte disponible las 24 horas, nada parecido en el mercado.<\\/li><\\/ul>\"}', '2021-02-01 05:34:31', '2021-03-09 10:46:14'),
(19, 1, 'reset-password', '{\"title\":\"Proclamations About Us\",\"description\":\"<ul>\\r\\n                                    <li>\\r\\n                                        <p>Lorem ipsum dolor sit amet.<\\/p>\\r\\n                                    <\\/li>\\r\\n                                    <li>\\r\\n                                        <p>Adipisicing elit. Beatae, repellendus!<\\/p>\\r\\n                                    <\\/li>\\r\\n                                    <li>\\r\\n                                        <p>Consectetur adipisicing elit. A, eos!<\\/p>\\r\\n                                    <\\/li>\\r\\n                                    <li>\\r\\n                                        <p>Aliquid numquam reiciendis nisi placeat.<\\/p>\\r\\n                                    <\\/li>\\r\\n                                    <li>\\r\\n                                        <p>Voluptas est nesciunt qui necessitatibus<\\/p>\\r\\n                                    <\\/li>\\r\\n                                    <li>\\r\\n                                        <p>Lorem numquam reiciendis nisi placeat.<\\/p>\\r\\n                                    <\\/li><\\/ul>\"}', '2021-02-01 05:35:03', '2021-02-01 05:35:03'),
(20, 5, 'reset-password', '{\"title\":\"Proclamaciones sobre nosotro\",\"description\":\"<ul><li>Lorem ipsum dolor sit amet.\\r\\n\\r\\nUna \\u00e9lite visora. <\\/li><li><span>\\u00a1Beatae, repellendus!\\r\\n\\r\\nConsectetur adipisicing elit. <\\/span><\\/li><li><span>\\u00a1A, eos!\\r\\n\\r\\nAliquid numquam reiciendis nisi placeat.\\r\\n<\\/span><\\/li><li><span>\\r\\nVoluptas est nesciunt qui necessitatibus\\r\\n\\r\\nLorem numquam reiciendis nisi placeat.<\\/span><br \\/><\\/li><\\/ul>\"}', '2021-02-01 05:35:20', '2021-02-01 05:35:20'),
(21, 1, 'how-it-work', '{\"title\":\"WORKS\",\"sub_title\":\"HOW IT WORKS\",\"short_title\":\"How We\'re Helping\"}', '2021-02-01 23:14:54', '2021-02-01 23:14:54'),
(22, 5, 'how-it-work', '{\"title\":\"Trabajos\",\"sub_title\":\"C\\u00d3MO FUNCIONA\",\"short_title\":\"C\\u00f3mo estamos ayudando\"}', '2021-02-01 23:15:39', '2021-02-01 23:15:39'),
(23, 1, 'blog', '{\"title\":\"Blog\",\"sub_title\":\"READ OUR BLOG\",\"short_title\":\"Latest News From Blog\"}', '2021-02-01 23:17:03', '2021-10-21 00:52:09'),
(24, 5, 'blog', '{\"title\":\"BLOG\",\"sub_title\":\"LEER NUESTRO BLOG\",\"short_title\":\"\\u00daltimas noticias del blog\"}', '2021-02-01 23:17:45', '2021-02-01 23:22:58'),
(25, 1, 'faq', '{\"title\":\"Frequently Asked Questions\",\"short_details\":\"SYRIA MARKET\"}', '2021-02-03 05:19:08', '2022-04-24 20:59:06'),
(26, 5, 'faq', '{\"title\":\"Preguntas frecuentes\",\"short_details\":\"Binary SMM le brinda la mejor herramienta de marketing para que pueda derrotar a la competencia.\"}', '2021-02-03 05:19:43', '2021-03-09 10:31:56'),
(27, 6, 'hero', '{\"title\":\"\\u05d4\\u05d2\\u05d3\\u05dc \\u05d0\\u05ea \\u05d4\\u05e2\\u05e1\\u05e7 \\u05e9\\u05dc\\u05da \\u05d1\\u05d0\\u05de\\u05e6\\u05e2\\u05d5\\u05ea \\u05e4\\u05ea\\u05e8\\u05d5\\u05df \\u05d4- SMM \\u05e9\\u05dc\\u05e0\\u05d5\",\"short_description\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. \\u05d0\\u05d7\\u05d3 \\u05d7\\u05d9\\u05d9\\u05d1 \\u05dc\\u05d4\\u05d0\\u05e9\\u05d9\\u05dd \\u05e9\\u05d3\\u05d1\\u05e8 \\u05d6\\u05d4 \\u05d0\\u05d9\\u05e0\\u05d5 \\u05de\\u05d4\\u05d5\\u05d5\\u05d4 \\u05de\\u05db\\u05e9\\u05d5\\u05dc \\u05dc\\u05e6\\u05e8\\u05d5\\u05ea \\u05d4\\u05d6\\u05de\\u05df \\u05d1\\u05d5 \\u05e0\\u05d8\\u05e9\\u05d5 \\u05d0\\u05ea \\u05d4\\u05d7\\u05d5\\u05d1\\u05d5\\u05ea \\u05e9\\u05d4\\u05d5\\u05e0\\u05e4\\u05e7\\u05d5, \\u05d4\\u05d5\\u05d0 \\u05e2\\u05dc\\u05d5\\u05dc \\u05dc\\u05d4\\u05d3\\u05d5\\u05e3 \\u05d0\\u05ea \\u05d4\\u05e0\\u05d1\\u05d7\\u05e8 \\u05dc\\u05d4\\u05ea\\u05e0\\u05e4\\u05d7 \\u05e2\\u05dc\\u05d9\\u05d4\\u05dd.\",\"button_name\":\"\\u05dc\\u05b4\\u05dc\\u05de\\u05d5\\u05b9\\u05d3\"}', '2021-02-04 06:11:10', '2021-02-04 06:11:10'),
(28, 6, 'about-us', '{\"title\":\"\\u05e2\\u05dc \\u05d0\\u05d5\\u05d3\\u05d5\\u05ea\",\"sub_title\":\"\\u05de\\u05d9 \\u05d0\\u05e0\\u05d7\\u05e0\\u05d5\",\"short_title\":\"\\u05d0\\u05e0\\u05d5 \\u05e2\\u05d5\\u05d6\\u05e8\\u05d9\\u05dd \\u05dc\\u05d4\\u05e8\\u05d7\\u05d9\\u05d1 \\u05d0\\u05ea \\u05e2\\u05e1\\u05e7 \\u05d4- SMM \\u05e9\\u05dc\\u05da.\",\"short_description\":\"<p>\\u05d0\\u05e0\\u05d5 \\u05e2\\u05d5\\u05d6\\u05e8\\u05d9\\u05dd \\u05dc\\u05d0\\u05e8\\u05d2\\u05d5\\u05e0\\u05d9\\u05dd \\u05d1\\u05de\\u05d2\\u05d6\\u05e8 \\u05d4\\u05e4\\u05e8\\u05d8\\u05d9, \\u05d4\\u05e6\\u05d9\\u05d1\\u05d5\\u05e8\\u05d9 \\u05d5\\u05d4\\u05d7\\u05d1\\u05e8\\u05ea\\u05d9 \\u05dc\\u05d9\\u05e6\\u05d5\\u05e8 \\u05e9\\u05d9\\u05e0\\u05d5\\u05d9 \\u05e9\\u05d7\\u05e9\\u05d5\\u05d1.<\\/p><p><span>\\u05de\\u05d7\\u05d1\\u05d9\\u05dc\\u05ea C \\u05d5\\u05e2\\u05d3 \\u05e7\\u05d5 \\u05d4\\u05d7\\u05d6\\u05d9\\u05ea, \\u05d0\\u05e0\\u05d5 \\u05de\\u05e9\\u05ea\\u05e4\\u05d9\\u05dd \\u05e4\\u05e2\\u05d5\\u05dc\\u05d4 \\u05e2\\u05dd \\u05dc\\u05e7\\u05d5\\u05d7\\u05d5\\u05ea\\u05d9\\u05e0\\u05d5 \\u05d1\\u05db\\u05d3\\u05d9 \\u05dc\\u05d1\\u05e6\\u05e2 \\u05d0\\u05ea \\u05d4\\u05d0\\u05e8\\u05d2\\u05d5\\u05df \\u05e9\\u05dc\\u05d4\\u05dd \\u05d1\\u05d3\\u05e8\\u05db\\u05d9\\u05dd \\u05d4\\u05d7\\u05e9\\u05d5\\u05d1\\u05d5\\u05ea \\u05d1\\u05d9\\u05d5\\u05ea\\u05e8 \\u05dc\\u05e6\\u05d5\\u05e8\\u05da \\u05d4\\u05d8\\u05de\\u05e2\\u05d4 \\u05d3\\u05d9\\u05d2\\u05d9\\u05d8\\u05dc\\u05d9\\u05ea, \\u05d0\\u05e0\\u05dc\\u05d9\\u05d8\\u05d9\\u05ea. \\u05d9\\u05e9 \\u05dc\\u05e0\\u05d5 \\u05d9\\u05ea\\u05e8\\u05d5\\u05e0\\u05d5\\u05ea \\u05d2\\u05d3\\u05d5\\u05dc\\u05d9\\u05dd \\u05dc\\u05e2\\u05e9\\u05d5\\u05ea \\u05d0\\u05ea \\u05d6\\u05d4 \\u05d4\\u05db\\u05d9 \\u05d7\\u05e9\\u05d5\\u05d1 \\u05dc\\u05e4\\u05d9 \\u05d4\\u05e6\\u05d5\\u05e8\\u05da<\\/span><br \\/><\\/p>\"}', '2021-02-04 06:12:38', '2021-02-07 08:11:17'),
(29, 6, 'how-it-work', '{\"title\":\"\\u05e2\\u05d5\\u05d1\\u05d3\",\"sub_title\":\"\\u05d0\\u05d9\\u05da \\u05d6\\u05d4 \\u05e2\\u05d5\\u05d1\\u05d3\",\"short_title\":\"\\u05d0\\u05d9\\u05da \\u05d0\\u05e0\\u05d7\\u05e0\\u05d5 \\u05e2\\u05d5\\u05d6\\u05e8\\u05d9\\u05dd\"}', '2021-02-04 06:14:04', '2021-02-04 06:14:04'),
(30, 6, 'service', '{\"title\":\"\\u05e9\\u05d9\\u05e8\\u05d5\\u05ea\\u05d9\\u05dd\",\"sub_title\":\"\\u05de\\u05d4 \\u05d0\\u05e0\\u05d7\\u05e0\\u05d5 \\u05e2\\u05d5\\u05e9\\u05d9\\u05dd\",\"short_title\":\"\\u05d0\\u05d9\\u05da \\u05d0\\u05e0\\u05d7\\u05e0\\u05d5 \\u05e2\\u05d5\\u05d6\\u05e8\\u05d9\\u05dd\"}', '2021-02-04 06:14:40', '2021-02-04 06:14:40'),
(31, 6, 'testimonial', '{\"title\":\"\\u05ea\\u05b0\\u05e2\\u05d5\\u05bc\\u05d3\\u05b7\\u05ea \\u05d4\\u05d5\\u05b9\\u05e7\\u05b8\\u05e8\\u05b8\\u05d4\",\"sub_title\":\"\\u05d4\\u05e2\\u05e8\\u05db\\u05ea \\u05dc\\u05e7\\u05d5\\u05d7\\u05d5\\u05ea\",\"short_title\":\"\\u05de\\u05d4 \\u05d0\\u05d5\\u05de\\u05e8 \\u05d4\\u05dc\\u05e7\\u05d5\\u05d7 \\u05e9\\u05dc\\u05e0\\u05d5.\"}', '2021-02-04 06:15:16', '2021-02-04 06:15:16'),
(32, 6, 'call-to-action', '{\"title\":\"\\u05d0\\u05e0\\u05d5 \\u05e0\\u05e1\\u05d9\\u05e2 \\u05d9\\u05d5\\u05ea\\u05e8 \\u05dc\\u05e7\\u05d5\\u05d7\\u05d5\\u05ea \\u05dc\\u05e2\\u05e1\\u05e7 \\u05e9\\u05dc\\u05da \\u05de\\u05db\\u05dc \\u05de\\u05e7\\u05d5\\u05e8 \\u05de\\u05e7\\u05d5\\u05d5\\u05df \\u05d0\\u05d7\\u05e8.\",\"sub_title\":\"\\u05d4\\u05db\\u05e4\\u05dc \\u05d0\\u05ea \\u05d4\\u05ea\\u05e2\\u05d1\\u05d5\\u05e8\\u05d4 \\u05d1\\u05e4\\u05d9\\u05d9\\u05e1\\u05d1\\u05d5\\u05e7 \\u05e9\\u05dc \\u05d4\\u05e2\\u05e1\\u05e7 \\u05e4\\u05d9 10\",\"button_name\":\"\\u05dc\\u05de\\u05d3 \\u05e2\\u05d5\\u05d3\"}', '2021-02-04 06:16:08', '2021-02-04 06:16:08'),
(33, 6, 'blog', '{\"title\":\"\\u05d1\\u05dc\\u05d5\\u05d2\",\"sub_title\":\"\\u05e7\\u05e8\\u05d0 \\u05d0\\u05ea \\u05d4\\u05d1\\u05dc\\u05d5\\u05d2 \\u05e9\\u05dc\\u05e0\\u05d5\",\"short_title\":\"\\u05d4\\u05d7\\u05d3\\u05e9\\u05d5\\u05ea \\u05d4\\u05d0\\u05d7\\u05e8\\u05d5\\u05e0\\u05d5\\u05ea \\u05de\\u05d4\\u05d1\\u05dc\\u05d5\\u05d2\"}', '2021-02-04 06:18:22', '2021-02-04 06:18:22'),
(34, 6, 'faq', '{\"title\":\"\\u05e9\\u05d0\\u05dc\\u05d5\\u05ea \\u05e0\\u05e4\\u05d5\\u05e6\\u05d5\\u05ea\",\"short_details\":\"<p>\\u05dc\\u05d5\\u05e8\\u05dd, ipsum dolor sit amet consectet \\u05d4\\u05e0\\u05d7\\u05d5\\u05ea. \\u05d4\\u05de\\u05ea\\u05e0\\u05d2\\u05e0\\u05d9\\u05dd \\u05dc\\u05d4\\u05d5\\u05e7\\u05d9\\u05e2 \\u05d0\\u05ea \\u05d0\\u05d1\\u05d5\\u05ea\\u05d9\\u05d4\\u05dd \\u05e9\\u05dc \\u05d4\\u05e0\\u05d0\\u05d5\\u05ea? \\u05d4\\u05d0\\u05dd \\u05e7\\u05dc \\u05dc\\u05de\\u05e9\\u05d4\\u05d5, \\u05d0\\u05d5 \\u05dc\\u05e2\\u05d1\\u05d5\\u05d3\\u05d4, \\u05d0\\u05d9\\u05da \\u05dc\\u05e2\\u05e9\\u05d5\\u05ea \\u05db\\u05d3\\u05d9 \\u05dc\\u05d4\\u05d9\\u05d5\\u05ea \\u05de\\u05d5\\u05e9\\u05e4\\u05e2 \\u05de\\u05d4\\u05e8\\u05d0\\u05e9, \\u05dc\\u05d4\\u05d9\\u05e4\\u05d8\\u05e8 \\u05de\\u05d4\\u05e2\\u05d5\\u05dc\\u05dd \\u05d4\\u05d6\\u05d4, \\u05d0\\u05d5 \\u05e9\\u05e0\\u05d5\\u05dc\\u05d3 \\u05d4\\u05d4\\u05d1\\u05d7\\u05e0\\u05d4 \\u05d1\\u05d9\\u05df \\u05d4\\u05de\\u05e6\\u05d1\\u05d9\\u05dd \\u05d5\\u05d4\\u05e2\\u05d1\\u05d5\\u05d3\\u05d5\\u05ea \\u05e9\\u05d4\\u05d5\\u05d0 \\u05e9\\u05d5\\u05e0\\u05d0. \\u05d0\\u05e4\\u05e9\\u05e8\\u05d5\\u05ea \\u05d1\\u05e2\\u05d3\\u05d9\\u05e0\\u05d5\\u05ea? \\u05e0\\u05e6\\u05d9\\u05d2\\u05d9 \\u05d4\\u05e6\\u05d3\\u05d9\\u05e7\\u05d9\\u05dd \\u05dc\\u05e2\\u05d5\\u05dc\\u05dd \\u05dc\\u05d0 \\u05d9\\u05d4\\u05d9\\u05d5, \\u05d6\\u05d4 \\u05dc\\u05d0 \\u05de\\u05ea\\u05de\\u05d5\\u05e1\\u05e1, \\u05d5\\u05d2\\u05dd \\u05dc\\u05d0 \\u05e4\\u05d7\\u05d3\\u05e0\\u05d5\\u05ea \\u05de\\u05d7\\u05e4\\u05d9\\u05e8\\u05d4 \\u05e9\\u05dc \\u05e6\\u05e2\\u05e8\\u05d9\\u05dd \\u05e0\\u05d5\\u05db\\u05d7\\u05d9\\u05d9\\u05dd, \\u05de\\u05d7\\u05d5\\u05d9\\u05d1\\u05ea \\u05dc\\u05d1\\u05d7\\u05d9\\u05e8\\u05ea \\u05d4\\u05d0\\u05d5\\u05e4\\u05e0\\u05d9\\u05dd \\u05dc\\u05d4\\u05e9\\u05d9\\u05d2 \\u05d0\\u05d5\\u05ea\\u05dd \\u05d6\\u05d4 \\u05d4\\u05d9\\u05d4 \\u05e7\\u05d9\\u05d9\\u05dd \\u05d0\\u05e6\\u05dc\\u05d5. \\u05d7\\u05d5\\u05e1\\u05df?<br \\/><\\/p>\"}', '2021-02-04 06:18:46', '2021-02-04 06:18:46'),
(35, 6, 'contact-us', '{\"heading\":\"\\u05e0\\u05d4\\u05d9\\u05d4 \\u05d1\\u05e7\\u05e9\\u05e8\",\"sub_heading\":\"\\u05d1\\u05d5\\u05d0\\u05d5 \\u05e0\\u05e9\\u05d0\\u05dc \\u05d0\\u05ea \\u05e9\\u05d0\\u05dc\\u05d5\\u05ea\\u05d9\\u05db\\u05dd\",\"title\":\"\\u05e6\\u05d5\\u05e8 \\u05e7\\u05e9\\u05e8\",\"sub_title\":\"\\u05d4\\u05ea\\u05e7\\u05e9\\u05e8 \\u05d0\\u05dc\\u05d9\\u05e0\\u05d5 \\u05d0\\u05d5 \\u05d4\\u05d9\\u05db\\u05e0\\u05e1 \\u05dc\\u05d0\\u05ea\\u05e8 \\u05d1\\u05db\\u05dc \\u05e2\\u05ea, \\u05d0\\u05e0\\u05d5 \\u05de\\u05e9\\u05ea\\u05d3\\u05dc\\u05d9\\u05dd \\u05dc\\u05e2\\u05e0\\u05d5\\u05ea \\u05e2\\u05dc \\u05db\\u05dc \\u05d4\\u05e9\\u05d0\\u05dc\\u05d5\\u05ea \\u05ea\\u05d5\\u05da 24 \\u05e9\\u05e2\\u05d5\\u05ea \\u05d1\\u05d9\\u05de\\u05d9 \\u05e2\\u05e1\\u05e7\\u05d9\\u05dd. \\u05e0\\u05e9\\u05de\\u05d7 \\u05dc\\u05e2\\u05e0\\u05d5\\u05ea \\u05e2\\u05dc \\u05e9\\u05d0\\u05dc\\u05d5\\u05ea\\u05d9\\u05db\\u05dd.\",\"address\":\"\\u05e8\\u05d7\\u05d5\\u05d1 \\u05d1\\u05d9\\u05d9\\u05e7\\u05e8 22, \\u05dc\\u05d5\\u05e0\\u05d3\\u05d5\\u05df\",\"email\":\"\\u05e8\\u05d7\\u05d5\\u05d1 \\u05d1\\u05d9\\u05d9\\u05e7\\u05e8 22, \\u05dc\\u05d5\\u05e0\\u05d3\\u05d5\\u05df\",\"phone\":\"+ 44-20-4526-2356\",\"footer_short_details\":\"<p>\\u05d0\\u05e0\\u05d5 \\u05de\\u05ea\\u05de\\u05e7\\u05d3\\u05d9\\u05dd \\u05d1\\u05e6\\u05e8\\u05db\\u05d9\\u05dd \\u05e9\\u05dc \\u05e2\\u05e1\\u05e7\\u05d9\\u05dd \\u05e7\\u05d8\\u05e0\\u05d9\\u05dd \\u05e2\\u05d3 \\u05d1\\u05d9\\u05e0\\u05d5\\u05e0\\u05d9\\u05d9\\u05dd \\u05db\\u05d3\\u05d9 \\u05dc\\u05e9\\u05e4\\u05e8 \\u05d5\\u05dc\\u05d4\\u05d2\\u05d3\\u05d9\\u05dc \\u05d0\\u05ea \\u05ea\\u05e9\\u05d5\\u05d0\\u05ea\\u05dd.<br \\/><\\/p>\"}', '2021-02-04 06:21:03', '2021-02-04 06:21:03'),
(36, 6, 'login', '{\"title\":\"\\u05d4\\u05db\\u05e8\\u05d6\\u05d5\\u05ea \\u05d0\\u05d5\\u05d3\\u05d5\\u05ea\\u05d9\\u05e0\\u05d5\",\"description\":\"<p>\\u05d2\\u05d6\\u05e8 \\u05dc\\u05d5\\u05e8\\u05dd \\u05d0\\u05d9\\u05e4\\u05e1\\u05d5\\u05dd.<\\/p><p><br \\/><\\/p><p>\\u05d4\\u05e0\\u05d7\\u05d5\\u05ea. \\u05de\\u05d1\\u05d5\\u05e8\\u05da, \\u05e0\\u05de\\u05e0\\u05e2!<\\/p><p><br \\/><\\/p><p>\\u05d4\\u05e0\\u05d7\\u05d5\\u05ea \\u05d1\\u05de\\u05d9\\u05e0\\u05d9\\u05d0\\u05e4\\u05d5\\u05dc\\u05d9\\u05e1. \\u05de\\u05d0\\u05dc\\u05d4!<\\/p><p><br \\/><\\/p><p>\\u05d0\\u05e0\\u05d9 \\u05d0\\u05e3 \\u05e4\\u05e2\\u05dd \\u05dc\\u05d0 \\u05d3\\u05d5\\u05d7\\u05d4 \\u05d3\\u05d1\\u05e8 \\u05de\\u05dc\\u05d1\\u05d3 \\u05de\\u05e9\\u05d1\\u05d9\\u05e2 \\u05e8\\u05e6\\u05d5\\u05df.<\\/p><p><br \\/><\\/p><p>\\u05ea\\u05e2\\u05e0\\u05d5\\u05d2 \\u05e9\\u05d0\\u05d9\\u05e0\\u05d5 \\u05e2\\u05d5\\u05e0\\u05d4 \\u05e2\\u05dc \\u05e6\\u05e8\\u05db\\u05d9\\u05d4\\u05dd<\\/p><p><br \\/><\\/p><p>\\u05dc\\u05d5\\u05e8\\u05dd \\u05d3\\u05d5\\u05d7\\u05d4 \\u05d0\\u05d1\\u05dc \\u05d4\\u05dd \\u05d0\\u05e3 \\u05e4\\u05e2\\u05dd \\u05dc\\u05d0 \\u05e2\\u05d5\\u05e9\\u05d9\\u05dd \\u05d6\\u05d0\\u05ea.<\\/p>\"}', '2021-02-04 06:21:34', '2021-02-04 06:21:34'),
(37, 6, 'register', '{\"title\":\"\\u05d4\\u05db\\u05e8\\u05d6\\u05d5\\u05ea \\u05d0\\u05d5\\u05d3\\u05d5\\u05ea\\u05d9\\u05e0\\u05d5\",\"description\":\"<ul>\\r\\n                                    <li>\\r\\n                                        <p> \\u05d2\\u05d6\\u05e8 \\u05dc\\u05d5\\u05e8\\u05dd ipsum. \\r\\n                                    \\r\\n                                    <\\/p><\\/li><li>\\r\\n                                        <p> \\u05d4\\u05e0\\u05d7\\u05d5\\u05ea. \\u05de\\u05d1\\u05d5\\u05e8\\u05da, \\u05e0\\u05de\\u05e0\\u05e2! \\r\\n                                    \\r\\n                                    <\\/p><\\/li><li>\\r\\n                                        <p> \\u05d4\\u05e0\\u05d7\\u05d5\\u05ea \\u05d1\\u05de\\u05d9\\u05e0\\u05d9\\u05d0\\u05e4\\u05d5\\u05dc\\u05d9\\u05e1. \\u05de\\u05d0\\u05dc\\u05d4! \\r\\n                                    \\r\\n                                    <\\/p><\\/li><li>\\r\\n                                        <p> \\u05dc\\u05e2\\u05d5\\u05dc\\u05dd \\u05dc\\u05d0 \\u05d9\\u05d4\\u05d9\\u05d4 \\u05de\\u05e7\\u05d5\\u05d1\\u05dc \\u05d0\\u05dd \\u05d4\\u05d5\\u05d0 \\u05d9\\u05d3\\u05d7\\u05d4. \\r\\n                                    \\r\\n                                    <\\/p><\\/li><li>\\r\\n                                        <p> \\u05d4\\u05ea\\u05e2\\u05e0\\u05d5\\u05d2 \\u05e9\\u05dc\\u05d0 \\u05e2\\u05d5\\u05e0\\u05d4 \\u05e2\\u05dc \\u05e6\\u05e8\\u05db\\u05d9\\u05d4\\u05dd \\r\\n                                    \\r\\n                                    <\\/p><\\/li><li>\\r\\n                                        <p> \\u05dc\\u05d5\\u05e8\\u05dd \\u05d3\\u05d5\\u05d7\\u05d4 \\u05d0\\u05d1\\u05dc \\u05d4\\u05dd \\u05d0\\u05e3 \\u05e4\\u05e2\\u05dd \\u05dc\\u05d0 \\u05e2\\u05d5\\u05e9\\u05d9\\u05dd \\u05d6\\u05d0\\u05ea. \\r\\n                                     <\\/p><\\/li><\\/ul>\"}', '2021-02-04 06:22:26', '2021-02-04 06:22:26'),
(38, 6, 'forget-password', '{\"title\":\"\\u05d4\\u05db\\u05e8\\u05d6\\u05d5\\u05ea \\u05d0\\u05d5\\u05d3\\u05d5\\u05ea\\u05d9\\u05e0\\u05d5\",\"description\":\"<ul><li><p>\\u05d2\\u05d6\\u05e8 \\u05dc\\u05d5\\u05e8\\u05dd ipsum.<\\/p><\\/li><li><p>\\u05d4\\u05e0\\u05d7\\u05d5\\u05ea. \\u05de\\u05d1\\u05d5\\u05e8\\u05da, \\u05e0\\u05de\\u05e0\\u05e2!<\\/p><\\/li><li><p>\\u05d4\\u05e0\\u05d7\\u05d5\\u05ea \\u05d1\\u05de\\u05d9\\u05e0\\u05d9\\u05d0\\u05e4\\u05d5\\u05dc\\u05d9\\u05e1. \\u05de\\u05d0\\u05dc\\u05d4!<\\/p><\\/li><li><p>\\u05dc\\u05e2\\u05d5\\u05dc\\u05dd \\u05dc\\u05d0 \\u05d9\\u05d4\\u05d9\\u05d4 \\u05de\\u05e7\\u05d5\\u05d1\\u05dc \\u05d0\\u05dd \\u05d4\\u05d5\\u05d0 \\u05d9\\u05d3\\u05d7\\u05d4.<\\/p><\\/li><li><p>\\u05d4\\u05ea\\u05e2\\u05e0\\u05d5\\u05d2 \\u05e9\\u05dc\\u05d0 \\u05e2\\u05d5\\u05e0\\u05d4 \\u05e2\\u05dc \\u05e6\\u05e8\\u05db\\u05d9\\u05d4\\u05dd<\\/p><\\/li><li><p>\\u05dc\\u05d5\\u05e8\\u05dd \\u05d3\\u05d5\\u05d7\\u05d4 \\u05d0\\u05d1\\u05dc \\u05d4\\u05dd \\u05d0\\u05e3 \\u05e4\\u05e2\\u05dd \\u05dc\\u05d0 \\u05e2\\u05d5\\u05e9\\u05d9\\u05dd \\u05d6\\u05d0\\u05ea.<\\/p><\\/li><\\/ul>\"}', '2021-02-04 06:25:37', '2021-02-04 06:25:37'),
(39, 9, 'hero', '{\"title\":\"SYRIA MARKET\",\"short_description\":\"<p><br \\/><\\/p>\",\"button_name\":\"\\u064a\\u062a\\u0639\\u0644\\u0645\"}', '2021-03-09 10:14:31', '2022-04-24 20:57:00'),
(40, 9, 'about-us', '{\"title\":\"\\u062d\\u0648\\u0644\",\"sub_title\":\"\\u0645\\u0646 \\u0646\\u062d\\u0646\",\"short_title\":\"SYRIA MARKET\",\"short_description\":\"<p>SYRIA MARKET<br \\/><\\/p>\"}', '2021-03-09 10:20:48', '2022-04-24 20:57:20'),
(41, 9, 'how-it-work', '{\"title\":\"\\u064a\\u0639\\u0645\\u0644\",\"sub_title\":\"\\u0643\\u064a\\u0641 \\u062a\\u0639\\u0645\\u0644\",\"short_title\":\"\\u0643\\u064a\\u0641 \\u0646\\u0633\\u0627\\u0639\\u062f\"}', '2021-03-09 10:22:46', '2021-03-09 10:22:46'),
(42, 9, 'service', '{\"title\":\"\\u062e\\u062f\\u0645\\u0627\\u062a\",\"sub_title\":\"\\u0627\\u0644\\u0630\\u064a \\u0646\\u0641\\u0639\\u0644\\u0647\",\"short_title\":\"\\u0643\\u064a\\u0641 \\u0646\\u0633\\u0627\\u0639\\u062f\"}', '2021-03-09 10:23:50', '2021-03-09 10:23:50'),
(43, 9, 'testimonial', '{\"title\":\"\\u0634\\u0647\\u0627\\u062f\\u0629\",\"sub_title\":\"\\u062a\\u0642\\u064a\\u064a\\u0645 \\u0627\\u0644\\u0639\\u0645\\u0644\\u0627\\u0621\",\"short_title\":\"\\u0645\\u0627\\u0630\\u0627 \\u064a\\u0642\\u0648\\u0644 \\u0639\\u0645\\u0644\\u0627\\u0624\\u0646\\u0627.\"}', '2021-03-09 10:24:29', '2021-03-09 10:24:29'),
(44, 9, 'call-to-action', '{\"title\":\"SYRIA MARKET\",\"sub_title\":\"SYRIA MARKET\",\"button_name\":\"\\u064a\\u062a\\u0639\\u0644\\u0645 \\u0623\\u0643\\u062b\\u0631\"}', '2021-03-09 10:27:26', '2022-04-24 20:58:51'),
(45, 9, 'blog', '{\"title\":\"\\u0645\\u0642\\u0627\\u0644\\u0627\\u062a\",\"sub_title\":\"\\u0627\\u0642\\u0631\\u0623 \\u0645\\u062f\\u0648\\u0646\\u062a\\u0646\\u0627\",\"short_title\":\"\\u0622\\u062e\\u0631 \\u0627\\u0644\\u0623\\u062e\\u0628\\u0627\\u0631 \\u0645\\u0646 \\u0627\\u0644\\u0645\\u062f\\u0648\\u0646\\u0629\"}', '2021-03-09 10:28:49', '2021-03-09 10:28:49'),
(46, 9, 'faq', '{\"title\":\"\\u0623\\u0633\\u0626\\u0644\\u0629 \\u0645\\u0643\\u0631\\u0631\\u0629\",\"short_details\":\"<p>SYRIA MARKET<br \\/><\\/p>\"}', '2021-03-09 10:29:06', '2022-04-24 20:59:10'),
(47, 9, 'contact-us', '{\"heading\":\"\\u0627\\u0628\\u0642\\u0649 \\u0639\\u0644\\u0649 \\u062a\\u0648\\u0627\\u0635\\u0644\",\"sub_heading\":\"\\u062f\\u0639\\u0646\\u0627 \\u0646\\u0633\\u0623\\u0644 \\u0623\\u0633\\u0626\\u0644\\u062a\\u0643\",\"title\":\"\\u0627\\u062a\\u0635\\u0644 \\u0628\\u0646\\u0627\",\"sub_title\":\"\\u0627\\u062a\\u0635\\u0644 \\u0628\\u0646\\u0627 \\u0623\\u0648 \\u0623\\u0637\\u0644\\u0628 \\u0627\\u0644\\u0627\\u062a\\u0635\\u0627\\u0644 \\u0628\\u0646\\u0627 \\u0641\\u064a \\u0623\\u064a \\u0648\\u0642\\u062a \\u060c \\u0648\\u0646\\u0633\\u0639\\u0649 \\u0644\\u0644\\u0631\\u062f \\u0639\\u0644\\u0649 \\u062c\\u0645\\u064a\\u0639 \\u0627\\u0644\\u0627\\u0633\\u062a\\u0641\\u0633\\u0627\\u0631\\u0627\\u062a \\u0641\\u064a \\u063a\\u0636\\u0648\\u0646 24 \\u0633\\u0627\\u0639\\u0629 \\u0641\\u064a \\u0623\\u064a\\u0627\\u0645 \\u0627\\u0644\\u0639\\u0645\\u0644.\",\"address\":\"22 \\u0634\\u0627\\u0631\\u0639 \\u0628\\u064a\\u0643\\u0631 \\u060c \\u0644\\u0646\\u062f\\u0646\",\"email\":\"email@website.com\",\"phone\":\"+44-20-4526-2356\",\"footer_short_details\":\"<p>SYRIA MARKET<br \\/><\\/p>\"}', '2021-03-09 10:34:15', '2022-04-24 20:59:40'),
(48, 9, 'login', '{\"title\":\"\\u0625\\u0639\\u0644\\u0627\\u0646\\u0627\\u062a \\u0639\\u0646\\u0627\",\"description\":\"<ul><li>\\u0623\\u0633\\u0639\\u0627\\u0631 \\u0644\\u0627 \\u062a\\u0635\\u062f\\u0642 \\u060c \\u0627\\u0644\\u0623\\u062f\\u0646\\u0649 \\u0641\\u064a \\u0627\\u0644\\u0633\\u0648\\u0642.<\\/li><li>\\u0644\\u0648\\u062d\\u0629 \\u062a\\u062d\\u0643\\u0645 \\u0645\\u0635\\u0645\\u0645\\u0629 \\u0644\\u062a\\u0644\\u0627\\u0626\\u0645 \\u0627\\u0644\\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\u0627\\u0644\\u0633\\u0631\\u064a\\u0639 \\u0648\\u0627\\u0644\\u0628\\u0633\\u064a\\u0637 \\u0644\\u0644\\u0648\\u062d\\u0629 \\u060c \\u0627\\u0644\\u0623\\u0641\\u0636\\u0644 \\u0641\\u064a \\u0627\\u0644\\u0633\\u0648\\u0642.<\\/li><li>\\u062a\\u0633\\u0644\\u064a\\u0645 \\u0641\\u0627\\u0626\\u0642 \\u0627\\u0644\\u0633\\u0631\\u0639\\u0629 \\u060c \\u0623\\u0633\\u0631\\u0639 \\u0641\\u064a \\u0627\\u0644\\u0633\\u0648\\u0642.<\\/li><li>\\u0627\\u0644\\u062f\\u0639\\u0645 \\u0645\\u062a\\u0627\\u062d \\u0639\\u0644\\u0649 \\u0645\\u062f\\u0627\\u0631 \\u0627\\u0644\\u0633\\u0627\\u0639\\u0629 \\u060c \\u0644\\u0627 \\u0634\\u064a\\u0621 \\u0645\\u062b\\u0644\\u0647 \\u0641\\u064a \\u0627\\u0644\\u0633\\u0648\\u0642.<br \\/><\\/li><\\/ul>\"}', '2021-03-09 10:39:19', '2021-03-09 10:39:19'),
(49, 9, 'register', '{\"title\":\"\\u0625\\u0639\\u0644\\u0627\\u0646\\u0627\\u062a \\u0639\\u0646\\u0627\",\"description\":\"<ul><li>\\u0623\\u0633\\u0639\\u0627\\u0631 \\u0644\\u0627 \\u062a\\u0635\\u062f\\u0642 \\u060c \\u0627\\u0644\\u0623\\u062f\\u0646\\u0649 \\u0641\\u064a \\u0627\\u0644\\u0633\\u0648\\u0642.<\\/li><li>\\u0644\\u0648\\u062d\\u0629 \\u062a\\u062d\\u0643\\u0645 \\u0645\\u0635\\u0645\\u0645\\u0629 \\u0644\\u062a\\u0644\\u0627\\u0626\\u0645 \\u0627\\u0644\\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\u0627\\u0644\\u0633\\u0631\\u064a\\u0639 \\u0648\\u0627\\u0644\\u0628\\u0633\\u064a\\u0637 \\u0644\\u0644\\u0648\\u062d\\u0629 \\u060c \\u0627\\u0644\\u0623\\u0641\\u0636\\u0644 \\u0641\\u064a \\u0627\\u0644\\u0633\\u0648\\u0642.<\\/li><li>\\u062a\\u0633\\u0644\\u064a\\u0645 \\u0641\\u0627\\u0626\\u0642 \\u0627\\u0644\\u0633\\u0631\\u0639\\u0629 \\u060c \\u0623\\u0633\\u0631\\u0639 \\u0641\\u064a \\u0627\\u0644\\u0633\\u0648\\u0642.<\\/li><li>\\u0627\\u0644\\u062f\\u0639\\u0645 \\u0645\\u062a\\u0627\\u062d \\u0639\\u0644\\u0649 \\u0645\\u062f\\u0627\\u0631 \\u0627\\u0644\\u0633\\u0627\\u0639\\u0629 \\u060c \\u0644\\u0627 \\u0634\\u064a\\u0621 \\u0645\\u062b\\u0644\\u0647 \\u0641\\u064a \\u0627\\u0644\\u0633\\u0648\\u0642.<\\/li><\\/ul>\"}', '2021-03-09 10:45:26', '2021-03-09 10:45:26'),
(50, 9, 'forget-password', '{\"title\":\"\\u0625\\u0639\\u0644\\u0627\\u0646\\u0627\\u062a \\u0639\\u0646\\u0627\",\"description\":\"<ul><li>\\u0623\\u0633\\u0639\\u0627\\u0631 \\u0644\\u0627 \\u062a\\u0635\\u062f\\u0642 \\u060c \\u0627\\u0644\\u0623\\u062f\\u0646\\u0649 \\u0641\\u064a \\u0627\\u0644\\u0633\\u0648\\u0642.<\\/li><li>\\u0644\\u0648\\u062d\\u0629 \\u062a\\u062d\\u0643\\u0645 \\u0645\\u0635\\u0645\\u0645\\u0629 \\u0644\\u062a\\u0644\\u0627\\u0626\\u0645 \\u0627\\u0644\\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\u0627\\u0644\\u0633\\u0631\\u064a\\u0639 \\u0648\\u0627\\u0644\\u0628\\u0633\\u064a\\u0637 \\u0644\\u0644\\u0648\\u062d\\u0629 \\u060c \\u0627\\u0644\\u0623\\u0641\\u0636\\u0644 \\u0641\\u064a \\u0627\\u0644\\u0633\\u0648\\u0642.<\\/li><li>\\u062a\\u0633\\u0644\\u064a\\u0645 \\u0641\\u0627\\u0626\\u0642 \\u0627\\u0644\\u0633\\u0631\\u0639\\u0629 \\u060c \\u0623\\u0633\\u0631\\u0639 \\u0641\\u064a \\u0627\\u0644\\u0633\\u0648\\u0642.<\\/li><li>\\u0627\\u0644\\u062f\\u0639\\u0645 \\u0645\\u062a\\u0627\\u062d \\u0639\\u0644\\u0649 \\u0645\\u062f\\u0627\\u0631 \\u0627\\u0644\\u0633\\u0627\\u0639\\u0629 \\u060c \\u0644\\u0627 \\u0634\\u064a\\u0621 \\u0645\\u062b\\u0644\\u0647 \\u0641\\u064a \\u0627\\u0644\\u0633\\u0648\\u0642.<\\/li><\\/ul>\"}', '2021-03-09 10:46:24', '2021-03-09 10:46:24');

-- --------------------------------------------------------

--
-- Table structure for table `template_media`
--

CREATE TABLE `template_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `template_media`
--

INSERT INTO `template_media` (`id`, `section_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'hero', '{\"image\":\"6265e3c08618f1650844608.png\",\"button_link\":\"https:\\/\\/bugfinder.net\\/smm-matrix\\/about\"}', '2021-01-31 03:16:26', '2022-04-24 20:56:48'),
(2, 'about-us', '{\"image\":\"6265e366ab0701650844518.jpeg\",\"youtube_link\":\"\"}', '2021-01-31 03:25:43', '2022-04-24 20:55:19'),
(3, 'call-to-action', '{\"image\":\"6265e42ee15231650844718.png\",\"button_link\":\"https:\\/\\/SyriaMarket.com\"}', '2021-02-02 04:59:07', '2022-04-24 20:58:38');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(91) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: Open, 1: Answered, 2: Replied, 3: Closed	',
  `last_reply` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_attachments`
--

CREATE TABLE `ticket_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_message_id` bigint(20) UNSIGNED DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_messages`
--

CREATE TABLE `ticket_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `trx_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  `charge` decimal(11,2) DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trx_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `trx_type`, `amount`, `charge`, `remarks`, `trx_id`, `created_at`, `updated_at`) VALUES
(1, 1, '+', '123.00', '0.00', 'Add Balance', '4HAFK38V23JH', '2022-03-03 05:58:29', '2022-03-03 05:58:29'),
(2, 1, '+', '123.00', '0.00', 'Add Balance', 'ZX2HS1CZQSCB', '2022-03-03 05:59:27', '2022-03-03 05:59:27'),
(3, 1, '+', '123.00', '0.00', 'Add Balance', 'SX75KWXWR83U', '2022-03-03 06:00:08', '2022-03-03 06:00:08'),
(4, 1, '+', '123.00', '0.00', 'Add Balance', 'WTF2M56P349T', '2022-03-03 06:24:40', '2022-03-03 06:24:40'),
(5, 2, '+', '200.00', '0.00', 'Add Balance', 'R9UBGXW3DO8K', '2022-04-22 13:04:01', '2022-04-22 13:04:01'),
(6, 2, '-', '26.00', '0.00', 'Place order', 'QZFJP49GMKHT', '2022-04-22 13:07:13', '2022-04-22 13:07:13'),
(7, 2, '-', '0.04', '0.00', 'Place order', 'N2YS3F25DVN7', '2022-04-25 08:07:08', '2022-04-25 08:07:08'),
(8, 2, '-', '0.72', '0.00', 'Place order', 'SV2N3C4F99XS', '2022-04-26 17:57:35', '2022-04-26 17:57:35'),
(9, 2, '-', '0.05', '0.00', 'Place order', 'JJ6TX7B4KURY', '2022-04-26 18:11:36', '2022-04-26 18:11:36'),
(10, 2, '-', '0.05', '0.00', 'Place order', 'V9HT98AKC8VG', '2022-04-26 18:15:35', '2022-04-26 18:15:35'),
(11, 2, '-', '0.70', '0.00', 'Place order', 'DQADGVYUEK8Z', '2022-05-26 07:27:03', '2022-05-26 07:27:03'),
(12, 2, '-', '0.70', '0.00', 'Place order', 'XJPD56ZJCC2N', '2022-05-26 07:29:20', '2022-05-26 07:29:20'),
(13, 2, '-', '0.70', '0.00', 'Place order', 'Y93F8P42ZM41', '2022-05-26 07:41:21', '2022-05-26 07:41:21'),
(14, 2, '-', '0.70', '0.00', 'Place order', '9OBWXCYNF554', '2022-05-26 07:41:42', '2022-05-26 07:41:42'),
(15, 2, '-', '0.70', '0.00', 'Place order', '4X1XWVVOES6B', '2022-05-26 07:43:36', '2022-05-26 07:43:36'),
(16, 2, '-', '20.00', '0.00', 'Place order', '9PBHVA6BO841', '2022-05-26 07:48:53', '2022-05-26 07:48:53'),
(17, 2, '-', '20.00', '0.00', 'Place order', '33QRG3TKHTSM', '2022-05-26 07:49:18', '2022-05-26 07:49:18'),
(18, 2, '-', '20.00', '0.00', 'Place order', 'T9JAAVTWFNOE', '2022-05-26 07:49:35', '2022-05-26 07:49:35'),
(19, 2, '-', '20.00', '0.00', 'Place order', 'GB9ZFOYCYERW', '2022-05-26 07:50:38', '2022-05-26 07:50:38'),
(20, 2, '-', '20.00', '0.00', 'Place order', 'TAPHHDVKE6BQ', '2022-05-26 07:50:51', '2022-05-26 07:50:51'),
(21, 2, '-', '20.00', '0.00', 'Place order', 'FA7DRQHDG863', '2022-05-26 07:52:04', '2022-05-26 07:52:04'),
(22, 2, '-', '20.00', '0.00', 'Place order', 'GETRTPKT9B4G', '2022-05-26 07:52:14', '2022-05-26 07:52:14'),
(23, 2, '-', '20.00', '0.00', 'Place order', 'ZDO61J6O8WYK', '2022-05-26 07:52:19', '2022-05-26 07:52:19'),
(24, 2, '-', '20.00', '0.00', 'Place order', 'SE8MG62VON74', '2022-05-26 08:00:03', '2022-05-26 08:00:03'),
(25, 2, '-', '20.00', '0.00', 'Place order', '8799F6FXS75F', '2022-05-26 08:00:27', '2022-05-26 08:00:27'),
(26, 2, '-', '20.00', '0.00', 'Place order', '4OR3Y5358AC4', '2022-05-26 08:25:46', '2022-05-26 08:25:46'),
(27, 2, '-', '20.00', '0.00', 'Place order', 'VVVGG7HA9V18', '2022-05-26 08:27:46', '2022-05-26 08:27:46'),
(28, 2, '-', '20.00', '0.00', 'Place order', '1PNDNNDQF2MH', '2022-05-26 08:28:17', '2022-05-26 08:28:17'),
(29, 2, '-', '20.00', '0.00', 'Place order', 'RX8QSWEA2ZAC', '2022-05-26 08:29:29', '2022-05-26 08:29:29'),
(30, 2, '-', '20.00', '0.00', 'Place order', '5UXC1BGYV39N', '2022-05-26 08:29:58', '2022-05-26 08:29:58'),
(31, 2, '-', '20.00', '0.00', 'Place order', 'G39H7N59Q59Q', '2022-05-26 08:34:48', '2022-05-26 08:34:48'),
(32, 2, '-', '20.00', '0.00', 'Place order', 'O87ABXU4JMPD', '2022-05-26 08:40:07', '2022-05-26 08:40:07'),
(33, 2, '-', '20.00', '0.00', 'Place order', '5PBNBHGDU3EN', '2022-05-26 08:42:54', '2022-05-26 08:42:54'),
(34, 2, '-', '20.00', '0.00', 'Place order', 'MBBQ1CCATNF1', '2022-05-26 08:43:23', '2022-05-26 08:43:23'),
(35, 2, '-', '20.00', '0.00', 'Place order', 'T3BEMDX78V3F', '2022-05-26 08:43:54', '2022-05-26 08:43:54'),
(36, 2, '-', '20.00', '0.00', 'Place order', 'BBFPOYTAOG94', '2022-05-26 08:44:02', '2022-05-26 08:44:02'),
(37, 2, '-', '20.00', '0.00', 'Place order', 'SZJKPTZ476JD', '2022-05-26 08:45:13', '2022-05-26 08:45:13'),
(38, 2, '-', '1.40', '0.00', 'Place order', 'ATRQZQAJPHK5', '2022-05-26 08:45:46', '2022-05-26 08:45:46'),
(39, 1, '-', '0.04', '0.00', 'Place order', 'R61XUHY7F16Y', '2022-05-27 14:25:03', '2022-05-27 14:25:03'),
(40, 1, '-', '0.04', '0.00', 'Place order', '7RBTDOHRUW3K', '2022-05-27 14:25:30', '2022-05-27 14:25:30'),
(41, 1, '-', '0.04', '0.00', 'Place order', '8J7RD2PQS36W', '2022-05-27 14:54:50', '2022-05-27 14:54:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_code` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` decimal(11,2) NOT NULL DEFAULT 0.00,
  `api_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `email_verification` tinyint(1) NOT NULL DEFAULT 0,
  `sms_verification` tinyint(1) NOT NULL DEFAULT 0,
  `verify_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_at` datetime DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_special` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `language_id`, `email`, `phone_code`, `phone`, `balance`, `api_token`, `image`, `address`, `status`, `email_verification`, `sms_verification`, `verify_code`, `sent_at`, `last_login`, `password`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`, `is_special`) VALUES
(1, 'test', 'test', 'test123', 1, 'test@test.com', '+93', '8522847035', '491.88', 'HIT6kp1ngJUd1Gkm1EHR9YCwiAmRF69CPWzFlHQ7E0pnvll7qmBdZjo0hPSg', NULL, '', 1, 1, 1, NULL, NULL, '2022-05-27 14:24:35', '$2y$10$KbPNjKMIYvyE4DwRnfhWPuHXHBu8tu3jM2rbeCQ6nNMIyax/Gtalm', NULL, NULL, '2022-03-03 05:57:20', '2022-05-27 14:54:50', 1),
(2, 'Hammam', 'Zarefa', 'Hammam', 1, 'hammamzarefa@gmail.com', '+93', '+558522847035', '4858.60', 'djGMFMw3Vsi1UxPyHTe5HA5EPTZyHmBJJ7nUgdYQRUMizG9MIBpYjcuGOAGS', '62658b1b923281650821915.jpg', '', 1, 1, 1, NULL, NULL, '2022-05-26 04:42:10', '$2y$10$KbPNjKMIYvyE4DwRnfhWPuHXHBu8tu3jM2rbeCQ6nNMIyax/Gtalm', NULL, NULL, '2022-04-22 13:02:23', '2022-05-26 08:45:46', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_service_rates`
--

CREATE TABLE `user_service_rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` decimal(11,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indexes for table `api_providers`
--
ALTER TABLE `api_providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `balance_coupons`
--
ALTER TABLE `balance_coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configures`
--
ALTER TABLE `configures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_details`
--
ALTER TABLE `content_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_media`
--
ALTER TABLE `content_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `funds`
--
ALTER TABLE `funds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateways`
--
ALTER TABLE `gateways`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gateways_code_unique` (`code`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notify_templates`
--
ALTER TABLE `notify_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_codes`
--
ALTER TABLE `service_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_notifications`
--
ALTER TABLE `site_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_controls`
--
ALTER TABLE `sms_controls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_media`
--
ALTER TABLE `template_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_attachments`
--
ALTER TABLE `ticket_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_messages`
--
ALTER TABLE `ticket_messages`
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
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_service_rates`
--
ALTER TABLE `user_service_rates`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `api_providers`
--
ALTER TABLE `api_providers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `balance_coupons`
--
ALTER TABLE `balance_coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `configures`
--
ALTER TABLE `configures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `content_details`
--
ALTER TABLE `content_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `content_media`
--
ALTER TABLE `content_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `funds`
--
ALTER TABLE `funds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gateways`
--
ALTER TABLE `gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notify_templates`
--
ALTER TABLE `notify_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `service_codes`
--
ALTER TABLE `service_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `site_notifications`
--
ALTER TABLE `site_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sms_controls`
--
ALTER TABLE `sms_controls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `template_media`
--
ALTER TABLE `template_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket_attachments`
--
ALTER TABLE `ticket_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket_messages`
--
ALTER TABLE `ticket_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_service_rates`
--
ALTER TABLE `user_service_rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
