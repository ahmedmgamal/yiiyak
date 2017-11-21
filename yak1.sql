-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 30, 2016 at 02:05 PM
-- Server version: 5.7.16
-- PHP Version: 7.0.12-1+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `yiiyaktestuser1`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_data`
--

CREATE TABLE IF NOT EXISTS `audit_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entry_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `data` blob,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_audit_data_entry_id` (`entry_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `audit_entry`
--

CREATE TABLE IF NOT EXISTS `audit_entry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `user_id` int(11) DEFAULT '0',
  `duration` float DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `request_method` varchar(16) DEFAULT NULL,
  `ajax` int(1) NOT NULL DEFAULT '0',
  `route` varchar(255) DEFAULT NULL,
  `memory_max` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_route` (`route`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14315 ;

-- --------------------------------------------------------

--
-- Table structure for table `audit_error`
--

CREATE TABLE IF NOT EXISTS `audit_error` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entry_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `message` text NOT NULL,
  `code` int(11) DEFAULT '0',
  `file` varchar(512) DEFAULT NULL,
  `line` int(11) DEFAULT NULL,
  `trace` blob,
  `hash` varchar(32) DEFAULT NULL,
  `emailed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_audit_error_entry_id` (`entry_id`),
  KEY `idx_file` (`file`(180)),
  KEY `idx_emailed` (`emailed`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `audit_javascript`
--

CREATE TABLE IF NOT EXISTS `audit_javascript` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entry_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `type` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `origin` varchar(512) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`),
  KEY `fk_audit_javascript_entry_id` (`entry_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `audit_mail`
--

CREATE TABLE IF NOT EXISTS `audit_mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entry_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `successful` int(11) NOT NULL,
  `from` varchar(255) DEFAULT NULL,
  `to` varchar(255) DEFAULT NULL,
  `reply` varchar(255) DEFAULT NULL,
  `cc` varchar(255) DEFAULT NULL,
  `bcc` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `text` blob,
  `html` blob,
  `data` blob,
  PRIMARY KEY (`id`),
  KEY `fk_audit_mail_entry_id` (`entry_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `audit_trail`
--

CREATE TABLE IF NOT EXISTS `audit_trail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entry_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `model_id` varchar(255) NOT NULL,
  `field` varchar(255) DEFAULT NULL,
  `old_value` text,
  `new_value` text,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_audit_trail_entry_id` (`entry_id`),
  KEY `idx_audit_user_id` (`user_id`),
  KEY `idx_audit_trail_field` (`model`,`model_id`,`field`),
  KEY `idx_audit_trail_action` (`action`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '19', 1472924680),
('admin', '2', 1475243233),
('admin', '21', 1472927226),
('admin', '24', 1472927644),
('admin', '25', 1472927884),
('admin', '3', 1472665770),
('admin', '33', 1473062635);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/*', 2, NULL, NULL, NULL, 1472572564, 1472572564),
('/admin/*', 2, NULL, NULL, NULL, 1472572563, 1472572563),
('/admin/assignment/*', 2, NULL, NULL, NULL, 1472572561, 1472572561),
('/admin/assignment/assign', 2, NULL, NULL, NULL, 1472572561, 1472572561),
('/admin/assignment/index', 2, NULL, NULL, NULL, 1472572561, 1472572561),
('/admin/assignment/revoke', 2, NULL, NULL, NULL, 1472572561, 1472572561),
('/admin/assignment/view', 2, NULL, NULL, NULL, 1472572561, 1472572561),
('/admin/default/*', 2, NULL, NULL, NULL, 1472572562, 1472572562),
('/admin/default/index', 2, NULL, NULL, NULL, 1472572561, 1472572561),
('/admin/menu/*', 2, NULL, NULL, NULL, 1472572562, 1472572562),
('/admin/menu/create', 2, NULL, NULL, NULL, 1472572562, 1472572562),
('/admin/menu/delete', 2, NULL, NULL, NULL, 1472572562, 1472572562),
('/admin/menu/index', 2, NULL, NULL, NULL, 1472572562, 1472572562),
('/admin/menu/update', 2, NULL, NULL, NULL, 1472572562, 1472572562),
('/admin/menu/view', 2, NULL, NULL, NULL, 1472572562, 1472572562),
('/admin/permission/*', 2, NULL, NULL, NULL, 1472572562, 1472572562),
('/admin/permission/assign', 2, NULL, NULL, NULL, 1472572562, 1472572562),
('/admin/permission/create', 2, NULL, NULL, NULL, 1472572562, 1472572562),
('/admin/permission/delete', 2, NULL, NULL, NULL, 1472572562, 1472572562),
('/admin/permission/index', 2, NULL, NULL, NULL, 1472572562, 1472572562),
('/admin/permission/remove', 2, NULL, NULL, NULL, 1472572562, 1472572562),
('/admin/permission/update', 2, NULL, NULL, NULL, 1472572562, 1472572562),
('/admin/permission/view', 2, NULL, NULL, NULL, 1472572562, 1472572562),
('/admin/role/*', 2, NULL, NULL, NULL, 1472572562, 1472572562),
('/admin/role/assign', 2, NULL, NULL, NULL, 1472572562, 1472572562),
('/admin/role/create', 2, NULL, NULL, NULL, 1472572562, 1472572562),
('/admin/role/delete', 2, NULL, NULL, NULL, 1472572562, 1472572562),
('/admin/role/index', 2, NULL, NULL, NULL, 1472572562, 1472572562),
('/admin/role/remove', 2, NULL, NULL, NULL, 1472572562, 1472572562),
('/admin/role/update', 2, NULL, NULL, NULL, 1472572562, 1472572562),
('/admin/role/view', 2, NULL, NULL, NULL, 1472572562, 1472572562),
('/admin/route/*', 2, NULL, NULL, NULL, 1472572562, 1472572562),
('/admin/route/assign', 2, NULL, NULL, NULL, 1472572562, 1472572562),
('/admin/route/create', 2, NULL, NULL, NULL, 1472572562, 1472572562),
('/admin/route/index', 2, NULL, NULL, NULL, 1472572562, 1472572562),
('/admin/route/refresh', 2, NULL, NULL, NULL, 1472572562, 1472572562),
('/admin/route/remove', 2, NULL, NULL, NULL, 1472572562, 1472572562),
('/admin/rule/*', 2, NULL, NULL, NULL, 1472572563, 1472572563),
('/admin/rule/create', 2, NULL, NULL, NULL, 1472572563, 1472572563),
('/admin/rule/delete', 2, NULL, NULL, NULL, 1472572563, 1472572563),
('/admin/rule/index', 2, NULL, NULL, NULL, 1472572562, 1472572562),
('/admin/rule/update', 2, NULL, NULL, NULL, 1472572563, 1472572563),
('/admin/rule/view', 2, NULL, NULL, NULL, 1472572563, 1472572563),
('/admin/user/*', 2, NULL, NULL, NULL, 1472572563, 1472572563),
('/admin/user/activate', 2, NULL, NULL, NULL, 1472572563, 1472572563),
('/admin/user/change-password', 2, NULL, NULL, NULL, 1472572563, 1472572563),
('/admin/user/delete', 2, NULL, NULL, NULL, 1472572563, 1472572563),
('/admin/user/index', 2, NULL, NULL, NULL, 1472572563, 1472572563),
('/admin/user/login', 2, NULL, NULL, NULL, 1472572563, 1472572563),
('/admin/user/logout', 2, NULL, NULL, NULL, 1472572563, 1472572563),
('/admin/user/request-password-reset', 2, NULL, NULL, NULL, 1472572563, 1472572563),
('/admin/user/reset-password', 2, NULL, NULL, NULL, 1472572563, 1472572563),
('/admin/user/signup', 2, NULL, NULL, NULL, 1472572563, 1472572563),
('/admin/user/view', 2, NULL, NULL, NULL, 1472572563, 1472572563),
('/crud/*', 2, NULL, NULL, NULL, 1472572561, 1472572561),
('/crud/api/company/*', 2, NULL, NULL, NULL, 1472572545, 1472572545),
('/crud/api/company/create', 2, NULL, NULL, NULL, 1472572544, 1472572544),
('/crud/api/company/delete', 2, NULL, NULL, NULL, 1472572545, 1472572545),
('/crud/api/company/index', 2, NULL, NULL, NULL, 1472572544, 1472572544),
('/crud/api/company/options', 2, NULL, NULL, NULL, 1472572545, 1472572545),
('/crud/api/company/update', 2, NULL, NULL, NULL, 1472572544, 1472572544),
('/crud/api/company/view', 2, NULL, NULL, NULL, 1472572544, 1472572544),
('/crud/api/drug-prescription/*', 2, NULL, NULL, NULL, 1472572545, 1472572545),
('/crud/api/drug-prescription/create', 2, NULL, NULL, NULL, 1472572545, 1472572545),
('/crud/api/drug-prescription/delete', 2, NULL, NULL, NULL, 1472572545, 1472572545),
('/crud/api/drug-prescription/index', 2, NULL, NULL, NULL, 1472572545, 1472572545),
('/crud/api/drug-prescription/options', 2, NULL, NULL, NULL, 1472572545, 1472572545),
('/crud/api/drug-prescription/update', 2, NULL, NULL, NULL, 1472572545, 1472572545),
('/crud/api/drug-prescription/view', 2, NULL, NULL, NULL, 1472572545, 1472572545),
('/crud/api/drug/*', 2, NULL, NULL, NULL, 1472572545, 1472572545),
('/crud/api/drug/create', 2, NULL, NULL, NULL, 1472572545, 1472572545),
('/crud/api/drug/delete', 2, NULL, NULL, NULL, 1472572545, 1472572545),
('/crud/api/drug/index', 2, NULL, NULL, NULL, 1472572545, 1472572545),
('/crud/api/drug/options', 2, NULL, NULL, NULL, 1472572545, 1472572545),
('/crud/api/drug/update', 2, NULL, NULL, NULL, 1472572545, 1472572545),
('/crud/api/drug/view', 2, NULL, NULL, NULL, 1472572545, 1472572545),
('/crud/api/icsr-concomitant-drug/*', 2, NULL, NULL, NULL, 1472572545, 1472572545),
('/crud/api/icsr-concomitant-drug/create', 2, NULL, NULL, NULL, 1472572545, 1472572545),
('/crud/api/icsr-concomitant-drug/delete', 2, NULL, NULL, NULL, 1472572545, 1472572545),
('/crud/api/icsr-concomitant-drug/index', 2, NULL, NULL, NULL, 1472572545, 1472572545),
('/crud/api/icsr-concomitant-drug/options', 2, NULL, NULL, NULL, 1472572545, 1472572545),
('/crud/api/icsr-concomitant-drug/update', 2, NULL, NULL, NULL, 1472572545, 1472572545),
('/crud/api/icsr-concomitant-drug/view', 2, NULL, NULL, NULL, 1472572545, 1472572545),
('/crud/api/icsr-event/*', 2, NULL, NULL, NULL, 1472572546, 1472572546),
('/crud/api/icsr-event/create', 2, NULL, NULL, NULL, 1472572546, 1472572546),
('/crud/api/icsr-event/delete', 2, NULL, NULL, NULL, 1472572546, 1472572546),
('/crud/api/icsr-event/index', 2, NULL, NULL, NULL, 1472572546, 1472572546),
('/crud/api/icsr-event/options', 2, NULL, NULL, NULL, 1472572546, 1472572546),
('/crud/api/icsr-event/update', 2, NULL, NULL, NULL, 1472572546, 1472572546),
('/crud/api/icsr-event/view', 2, NULL, NULL, NULL, 1472572546, 1472572546),
('/crud/api/icsr-outcome/*', 2, NULL, NULL, NULL, 1472572546, 1472572546),
('/crud/api/icsr-outcome/create', 2, NULL, NULL, NULL, 1472572546, 1472572546),
('/crud/api/icsr-outcome/delete', 2, NULL, NULL, NULL, 1472572546, 1472572546),
('/crud/api/icsr-outcome/index', 2, NULL, NULL, NULL, 1472572546, 1472572546),
('/crud/api/icsr-outcome/options', 2, NULL, NULL, NULL, 1472572546, 1472572546),
('/crud/api/icsr-outcome/update', 2, NULL, NULL, NULL, 1472572546, 1472572546),
('/crud/api/icsr-outcome/view', 2, NULL, NULL, NULL, 1472572546, 1472572546),
('/crud/api/icsr-reporter/*', 2, NULL, NULL, NULL, 1472572546, 1472572546),
('/crud/api/icsr-reporter/create', 2, NULL, NULL, NULL, 1472572546, 1472572546),
('/crud/api/icsr-reporter/delete', 2, NULL, NULL, NULL, 1472572546, 1472572546),
('/crud/api/icsr-reporter/index', 2, NULL, NULL, NULL, 1472572546, 1472572546),
('/crud/api/icsr-reporter/options', 2, NULL, NULL, NULL, 1472572546, 1472572546),
('/crud/api/icsr-reporter/update', 2, NULL, NULL, NULL, 1472572546, 1472572546),
('/crud/api/icsr-reporter/view', 2, NULL, NULL, NULL, 1472572546, 1472572546),
('/crud/api/icsr-test/*', 2, NULL, NULL, NULL, 1472572547, 1472572547),
('/crud/api/icsr-test/create', 2, NULL, NULL, NULL, 1472572546, 1472572546),
('/crud/api/icsr-test/delete', 2, NULL, NULL, NULL, 1472572547, 1472572547),
('/crud/api/icsr-test/index', 2, NULL, NULL, NULL, 1472572546, 1472572546),
('/crud/api/icsr-test/options', 2, NULL, NULL, NULL, 1472572547, 1472572547),
('/crud/api/icsr-test/update', 2, NULL, NULL, NULL, 1472572546, 1472572546),
('/crud/api/icsr-test/view', 2, NULL, NULL, NULL, 1472572546, 1472572546),
('/crud/api/icsr-type/*', 2, NULL, NULL, NULL, 1472572547, 1472572547),
('/crud/api/icsr-type/create', 2, NULL, NULL, NULL, 1472572547, 1472572547),
('/crud/api/icsr-type/delete', 2, NULL, NULL, NULL, 1472572547, 1472572547),
('/crud/api/icsr-type/index', 2, NULL, NULL, NULL, 1472572547, 1472572547),
('/crud/api/icsr-type/options', 2, NULL, NULL, NULL, 1472572547, 1472572547),
('/crud/api/icsr-type/update', 2, NULL, NULL, NULL, 1472572547, 1472572547),
('/crud/api/icsr-type/view', 2, NULL, NULL, NULL, 1472572547, 1472572547),
('/crud/api/icsr/*', 2, NULL, NULL, NULL, 1472572546, 1472572546),
('/crud/api/icsr/create', 2, NULL, NULL, NULL, 1472572546, 1472572546),
('/crud/api/icsr/delete', 2, NULL, NULL, NULL, 1472572546, 1472572546),
('/crud/api/icsr/index', 2, NULL, NULL, NULL, 1472572545, 1472572545),
('/crud/api/icsr/options', 2, NULL, NULL, NULL, 1472572546, 1472572546),
('/crud/api/icsr/update', 2, NULL, NULL, NULL, 1472572546, 1472572546),
('/crud/api/icsr/view', 2, NULL, NULL, NULL, 1472572545, 1472572545),
('/crud/api/lkp-country/*', 2, NULL, NULL, NULL, 1472572547, 1472572547),
('/crud/api/lkp-country/create', 2, NULL, NULL, NULL, 1472572547, 1472572547),
('/crud/api/lkp-country/delete', 2, NULL, NULL, NULL, 1472572547, 1472572547),
('/crud/api/lkp-country/index', 2, NULL, NULL, NULL, 1472572547, 1472572547),
('/crud/api/lkp-country/options', 2, NULL, NULL, NULL, 1472572547, 1472572547),
('/crud/api/lkp-country/update', 2, NULL, NULL, NULL, 1472572547, 1472572547),
('/crud/api/lkp-country/view', 2, NULL, NULL, NULL, 1472572547, 1472572547),
('/crud/api/lkp-dose-unit/*', 2, NULL, NULL, NULL, 1472572547, 1472572547),
('/crud/api/lkp-dose-unit/create', 2, NULL, NULL, NULL, 1472572547, 1472572547),
('/crud/api/lkp-dose-unit/delete', 2, NULL, NULL, NULL, 1472572547, 1472572547),
('/crud/api/lkp-dose-unit/index', 2, NULL, NULL, NULL, 1472572547, 1472572547),
('/crud/api/lkp-dose-unit/options', 2, NULL, NULL, NULL, 1472572547, 1472572547),
('/crud/api/lkp-dose-unit/update', 2, NULL, NULL, NULL, 1472572547, 1472572547),
('/crud/api/lkp-dose-unit/view', 2, NULL, NULL, NULL, 1472572547, 1472572547),
('/crud/api/lkp-drug-action/*', 2, NULL, NULL, NULL, 1472572548, 1472572548),
('/crud/api/lkp-drug-action/create', 2, NULL, NULL, NULL, 1472572547, 1472572547),
('/crud/api/lkp-drug-action/delete', 2, NULL, NULL, NULL, 1472572547, 1472572547),
('/crud/api/lkp-drug-action/index', 2, NULL, NULL, NULL, 1472572547, 1472572547),
('/crud/api/lkp-drug-action/options', 2, NULL, NULL, NULL, 1472572547, 1472572547),
('/crud/api/lkp-drug-action/update', 2, NULL, NULL, NULL, 1472572547, 1472572547),
('/crud/api/lkp-drug-action/view', 2, NULL, NULL, NULL, 1472572547, 1472572547),
('/crud/api/lkp-drug-role/*', 2, NULL, NULL, NULL, 1472572548, 1472572548),
('/crud/api/lkp-drug-role/create', 2, NULL, NULL, NULL, 1472572548, 1472572548),
('/crud/api/lkp-drug-role/delete', 2, NULL, NULL, NULL, 1472572548, 1472572548),
('/crud/api/lkp-drug-role/index', 2, NULL, NULL, NULL, 1472572548, 1472572548),
('/crud/api/lkp-drug-role/options', 2, NULL, NULL, NULL, 1472572548, 1472572548),
('/crud/api/lkp-drug-role/update', 2, NULL, NULL, NULL, 1472572548, 1472572548),
('/crud/api/lkp-drug-role/view', 2, NULL, NULL, NULL, 1472572548, 1472572548),
('/crud/api/lkp-frequency/*', 2, NULL, NULL, NULL, 1472572548, 1472572548),
('/crud/api/lkp-frequency/create', 2, NULL, NULL, NULL, 1472572548, 1472572548),
('/crud/api/lkp-frequency/delete', 2, NULL, NULL, NULL, 1472572548, 1472572548),
('/crud/api/lkp-frequency/index', 2, NULL, NULL, NULL, 1472572548, 1472572548),
('/crud/api/lkp-frequency/options', 2, NULL, NULL, NULL, 1472572548, 1472572548),
('/crud/api/lkp-frequency/update', 2, NULL, NULL, NULL, 1472572548, 1472572548),
('/crud/api/lkp-frequency/view', 2, NULL, NULL, NULL, 1472572548, 1472572548),
('/crud/api/lkp-icsr-outcome/*', 2, NULL, NULL, NULL, 1472572548, 1472572548),
('/crud/api/lkp-icsr-outcome/create', 2, NULL, NULL, NULL, 1472572548, 1472572548),
('/crud/api/lkp-icsr-outcome/delete', 2, NULL, NULL, NULL, 1472572548, 1472572548),
('/crud/api/lkp-icsr-outcome/index', 2, NULL, NULL, NULL, 1472572548, 1472572548),
('/crud/api/lkp-icsr-outcome/options', 2, NULL, NULL, NULL, 1472572548, 1472572548),
('/crud/api/lkp-icsr-outcome/update', 2, NULL, NULL, NULL, 1472572548, 1472572548),
('/crud/api/lkp-icsr-outcome/view', 2, NULL, NULL, NULL, 1472572548, 1472572548),
('/crud/api/lkp-icsr-type/*', 2, NULL, NULL, NULL, 1472572549, 1472572549),
('/crud/api/lkp-icsr-type/create', 2, NULL, NULL, NULL, 1472572549, 1472572549),
('/crud/api/lkp-icsr-type/delete', 2, NULL, NULL, NULL, 1472572549, 1472572549),
('/crud/api/lkp-icsr-type/index', 2, NULL, NULL, NULL, 1472572548, 1472572548),
('/crud/api/lkp-icsr-type/options', 2, NULL, NULL, NULL, 1472572549, 1472572549),
('/crud/api/lkp-icsr-type/update', 2, NULL, NULL, NULL, 1472572549, 1472572549),
('/crud/api/lkp-icsr-type/view', 2, NULL, NULL, NULL, 1472572549, 1472572549),
('/crud/api/lkp-meddra-hlgt/*', 2, NULL, NULL, NULL, 1472572549, 1472572549),
('/crud/api/lkp-meddra-hlgt/create', 2, NULL, NULL, NULL, 1472572549, 1472572549),
('/crud/api/lkp-meddra-hlgt/delete', 2, NULL, NULL, NULL, 1472572549, 1472572549),
('/crud/api/lkp-meddra-hlgt/index', 2, NULL, NULL, NULL, 1472572549, 1472572549),
('/crud/api/lkp-meddra-hlgt/options', 2, NULL, NULL, NULL, 1472572549, 1472572549),
('/crud/api/lkp-meddra-hlgt/update', 2, NULL, NULL, NULL, 1472572549, 1472572549),
('/crud/api/lkp-meddra-hlgt/view', 2, NULL, NULL, NULL, 1472572549, 1472572549),
('/crud/api/lkp-meddra-llt/*', 2, NULL, NULL, NULL, 1472572549, 1472572549),
('/crud/api/lkp-meddra-llt/create', 2, NULL, NULL, NULL, 1472572549, 1472572549),
('/crud/api/lkp-meddra-llt/delete', 2, NULL, NULL, NULL, 1472572549, 1472572549),
('/crud/api/lkp-meddra-llt/index', 2, NULL, NULL, NULL, 1472572549, 1472572549),
('/crud/api/lkp-meddra-llt/options', 2, NULL, NULL, NULL, 1472572549, 1472572549),
('/crud/api/lkp-meddra-llt/update', 2, NULL, NULL, NULL, 1472572549, 1472572549),
('/crud/api/lkp-meddra-llt/view', 2, NULL, NULL, NULL, 1472572549, 1472572549),
('/crud/api/lkp-meddra-pt/*', 2, NULL, NULL, NULL, 1472572549, 1472572549),
('/crud/api/lkp-meddra-pt/create', 2, NULL, NULL, NULL, 1472572549, 1472572549),
('/crud/api/lkp-meddra-pt/delete', 2, NULL, NULL, NULL, 1472572549, 1472572549),
('/crud/api/lkp-meddra-pt/index', 2, NULL, NULL, NULL, 1472572549, 1472572549),
('/crud/api/lkp-meddra-pt/options', 2, NULL, NULL, NULL, 1472572549, 1472572549),
('/crud/api/lkp-meddra-pt/update', 2, NULL, NULL, NULL, 1472572549, 1472572549),
('/crud/api/lkp-meddra-pt/view', 2, NULL, NULL, NULL, 1472572549, 1472572549),
('/crud/api/lkp-occupation/*', 2, NULL, NULL, NULL, 1472572550, 1472572550),
('/crud/api/lkp-occupation/create', 2, NULL, NULL, NULL, 1472572549, 1472572549),
('/crud/api/lkp-occupation/delete', 2, NULL, NULL, NULL, 1472572550, 1472572550),
('/crud/api/lkp-occupation/index', 2, NULL, NULL, NULL, 1472572549, 1472572549),
('/crud/api/lkp-occupation/options', 2, NULL, NULL, NULL, 1472572550, 1472572550),
('/crud/api/lkp-occupation/update', 2, NULL, NULL, NULL, 1472572550, 1472572550),
('/crud/api/lkp-occupation/view', 2, NULL, NULL, NULL, 1472572549, 1472572549),
('/crud/api/lkp-plan/create', 2, NULL, NULL, NULL, 1476034810, 1476034810),
('/crud/api/lkp-reaction-outcome/*', 2, NULL, NULL, NULL, 1472572550, 1472572550),
('/crud/api/lkp-reaction-outcome/create', 2, NULL, NULL, NULL, 1472572550, 1472572550),
('/crud/api/lkp-reaction-outcome/delete', 2, NULL, NULL, NULL, 1472572550, 1472572550),
('/crud/api/lkp-reaction-outcome/index', 2, NULL, NULL, NULL, 1472572550, 1472572550),
('/crud/api/lkp-reaction-outcome/options', 2, NULL, NULL, NULL, 1472572550, 1472572550),
('/crud/api/lkp-reaction-outcome/update', 2, NULL, NULL, NULL, 1472572550, 1472572550),
('/crud/api/lkp-reaction-outcome/view', 2, NULL, NULL, NULL, 1472572550, 1472572550),
('/crud/api/lkp-route/*', 2, NULL, NULL, NULL, 1472572550, 1472572550),
('/crud/api/lkp-route/create', 2, NULL, NULL, NULL, 1472572550, 1472572550),
('/crud/api/lkp-route/delete', 2, NULL, NULL, NULL, 1472572550, 1472572550),
('/crud/api/lkp-route/index', 2, NULL, NULL, NULL, 1472572550, 1472572550),
('/crud/api/lkp-route/options', 2, NULL, NULL, NULL, 1472572550, 1472572550),
('/crud/api/lkp-route/update', 2, NULL, NULL, NULL, 1472572550, 1472572550),
('/crud/api/lkp-route/view', 2, NULL, NULL, NULL, 1472572550, 1472572550),
('/crud/api/lkp-test/*', 2, NULL, NULL, NULL, 1472572551, 1472572551),
('/crud/api/lkp-test/create', 2, NULL, NULL, NULL, 1472572550, 1472572550),
('/crud/api/lkp-test/delete', 2, NULL, NULL, NULL, 1472572551, 1472572551),
('/crud/api/lkp-test/index', 2, NULL, NULL, NULL, 1472572550, 1472572550),
('/crud/api/lkp-test/options', 2, NULL, NULL, NULL, 1472572551, 1472572551),
('/crud/api/lkp-test/update', 2, NULL, NULL, NULL, 1472572551, 1472572551),
('/crud/api/lkp-test/view', 2, NULL, NULL, NULL, 1472572550, 1472572550),
('/crud/api/lkp-time-unit/*', 2, NULL, NULL, NULL, 1472572551, 1472572551),
('/crud/api/lkp-time-unit/create', 2, NULL, NULL, NULL, 1472572551, 1472572551),
('/crud/api/lkp-time-unit/delete', 2, NULL, NULL, NULL, 1472572551, 1472572551),
('/crud/api/lkp-time-unit/index', 2, NULL, NULL, NULL, 1472572551, 1472572551),
('/crud/api/lkp-time-unit/options', 2, NULL, NULL, NULL, 1472572551, 1472572551),
('/crud/api/lkp-time-unit/update', 2, NULL, NULL, NULL, 1472572551, 1472572551),
('/crud/api/lkp-time-unit/view', 2, NULL, NULL, NULL, 1472572551, 1472572551),
('/crud/api/lkp-weight-unit/*', 2, NULL, NULL, NULL, 1472572552, 1472572552),
('/crud/api/lkp-weight-unit/create', 2, NULL, NULL, NULL, 1472572551, 1472572551),
('/crud/api/lkp-weight-unit/delete', 2, NULL, NULL, NULL, 1472572551, 1472572551),
('/crud/api/lkp-weight-unit/index', 2, NULL, NULL, NULL, 1472572551, 1472572551),
('/crud/api/lkp-weight-unit/options', 2, NULL, NULL, NULL, 1472572552, 1472572552),
('/crud/api/lkp-weight-unit/update', 2, NULL, NULL, NULL, 1472572551, 1472572551),
('/crud/api/lkp-weight-unit/view', 2, NULL, NULL, NULL, 1472572551, 1472572551),
('/crud/api/migration/*', 2, NULL, NULL, NULL, 1472572552, 1472572552),
('/crud/api/migration/create', 2, NULL, NULL, NULL, 1472572552, 1472572552),
('/crud/api/migration/delete', 2, NULL, NULL, NULL, 1472572552, 1472572552),
('/crud/api/migration/index', 2, NULL, NULL, NULL, 1472572552, 1472572552),
('/crud/api/migration/options', 2, NULL, NULL, NULL, 1472572552, 1472572552),
('/crud/api/migration/update', 2, NULL, NULL, NULL, 1472572552, 1472572552),
('/crud/api/migration/view', 2, NULL, NULL, NULL, 1472572552, 1472572552),
('/crud/api/user-company/*', 2, NULL, NULL, NULL, 1472572552, 1472572552),
('/crud/api/user-company/create', 2, NULL, NULL, NULL, 1472572552, 1472572552),
('/crud/api/user-company/delete', 2, NULL, NULL, NULL, 1472572552, 1472572552),
('/crud/api/user-company/index', 2, NULL, NULL, NULL, 1472572552, 1472572552),
('/crud/api/user-company/options', 2, NULL, NULL, NULL, 1472572552, 1472572552),
('/crud/api/user-company/update', 2, NULL, NULL, NULL, 1472572552, 1472572552),
('/crud/api/user-company/view', 2, NULL, NULL, NULL, 1472572552, 1472572552),
('/crud/api/user/*', 2, NULL, NULL, NULL, 1472572553, 1472572553),
('/crud/api/user/create', 2, NULL, NULL, NULL, 1472572553, 1472572553),
('/crud/api/user/delete', 2, NULL, NULL, NULL, 1472572553, 1472572553),
('/crud/api/user/index', 2, NULL, NULL, NULL, 1472572553, 1472572553),
('/crud/api/user/options', 2, NULL, NULL, NULL, 1472572553, 1472572553),
('/crud/api/user/update', 2, NULL, NULL, NULL, 1472572553, 1472572553),
('/crud/api/user/view', 2, NULL, NULL, NULL, 1472572553, 1472572553),
('/crud/base/company/*', 2, NULL, NULL, NULL, 1472572553, 1472572553),
('/crud/base/company/create', 2, NULL, NULL, NULL, 1472572553, 1472572553),
('/crud/base/company/delete', 2, NULL, NULL, NULL, 1472572553, 1472572553),
('/crud/base/company/index', 2, NULL, NULL, NULL, 1472572553, 1472572553),
('/crud/base/company/update', 2, NULL, NULL, NULL, 1472572553, 1472572553),
('/crud/base/company/view', 2, NULL, NULL, NULL, 1472572553, 1472572553),
('/crud/base/drug-prescription/*', 2, NULL, NULL, NULL, 1472572554, 1472572554),
('/crud/base/drug-prescription/create', 2, NULL, NULL, NULL, 1472572554, 1472572554),
('/crud/base/drug-prescription/delete', 2, NULL, NULL, NULL, 1472572554, 1472572554),
('/crud/base/drug-prescription/index', 2, NULL, NULL, NULL, 1472572554, 1472572554),
('/crud/base/drug-prescription/update', 2, NULL, NULL, NULL, 1472572554, 1472572554),
('/crud/base/drug-prescription/view', 2, NULL, NULL, NULL, 1472572554, 1472572554),
('/crud/base/drug/*', 2, NULL, NULL, NULL, 1472572554, 1472572554),
('/crud/base/drug/create', 2, NULL, NULL, NULL, 1472572554, 1472572554),
('/crud/base/drug/delete', 2, NULL, NULL, NULL, 1472572554, 1472572554),
('/crud/base/drug/index', 2, NULL, NULL, NULL, 1472572553, 1472572553),
('/crud/base/drug/update', 2, NULL, NULL, NULL, 1472572554, 1472572554),
('/crud/base/drug/view', 2, NULL, NULL, NULL, 1472572553, 1472572553),
('/crud/base/icsr-concomitant-drug/*', 2, NULL, NULL, NULL, 1472572555, 1472572555),
('/crud/base/icsr-concomitant-drug/create', 2, NULL, NULL, NULL, 1472572554, 1472572554),
('/crud/base/icsr-concomitant-drug/delete', 2, NULL, NULL, NULL, 1472572554, 1472572554),
('/crud/base/icsr-concomitant-drug/index', 2, NULL, NULL, NULL, 1472572554, 1472572554),
('/crud/base/icsr-concomitant-drug/update', 2, NULL, NULL, NULL, 1472572554, 1472572554),
('/crud/base/icsr-concomitant-drug/view', 2, NULL, NULL, NULL, 1472572554, 1472572554),
('/crud/base/icsr-event/*', 2, NULL, NULL, NULL, 1472572555, 1472572555),
('/crud/base/icsr-event/create', 2, NULL, NULL, NULL, 1472572555, 1472572555),
('/crud/base/icsr-event/delete', 2, NULL, NULL, NULL, 1472572555, 1472572555),
('/crud/base/icsr-event/index', 2, NULL, NULL, NULL, 1472572555, 1472572555),
('/crud/base/icsr-event/update', 2, NULL, NULL, NULL, 1472572555, 1472572555),
('/crud/base/icsr-event/view', 2, NULL, NULL, NULL, 1472572555, 1472572555),
('/crud/base/icsr-outcome/*', 2, NULL, NULL, NULL, 1472572555, 1472572555),
('/crud/base/icsr-outcome/create', 2, NULL, NULL, NULL, 1472572555, 1472572555),
('/crud/base/icsr-outcome/delete', 2, NULL, NULL, NULL, 1472572555, 1472572555),
('/crud/base/icsr-outcome/index', 2, NULL, NULL, NULL, 1472572555, 1472572555),
('/crud/base/icsr-outcome/update', 2, NULL, NULL, NULL, 1472572555, 1472572555),
('/crud/base/icsr-outcome/view', 2, NULL, NULL, NULL, 1472572555, 1472572555),
('/crud/base/icsr-reporter/*', 2, NULL, NULL, NULL, 1472572556, 1472572556),
('/crud/base/icsr-reporter/create', 2, NULL, NULL, NULL, 1472572556, 1472572556),
('/crud/base/icsr-reporter/delete', 2, NULL, NULL, NULL, 1472572556, 1472572556),
('/crud/base/icsr-reporter/index', 2, NULL, NULL, NULL, 1472572556, 1472572556),
('/crud/base/icsr-reporter/update', 2, NULL, NULL, NULL, 1472572556, 1472572556),
('/crud/base/icsr-reporter/view', 2, NULL, NULL, NULL, 1472572556, 1472572556),
('/crud/base/icsr-test/*', 2, NULL, NULL, NULL, 1472572556, 1472572556),
('/crud/base/icsr-test/create', 2, NULL, NULL, NULL, 1472572556, 1472572556),
('/crud/base/icsr-test/delete', 2, NULL, NULL, NULL, 1472572556, 1472572556),
('/crud/base/icsr-test/index', 2, NULL, NULL, NULL, 1472572556, 1472572556),
('/crud/base/icsr-test/update', 2, NULL, NULL, NULL, 1472572556, 1472572556),
('/crud/base/icsr-test/view', 2, NULL, NULL, NULL, 1472572556, 1472572556),
('/crud/base/icsr-type/*', 2, NULL, NULL, NULL, 1472572556, 1472572556),
('/crud/base/icsr-type/create', 2, NULL, NULL, NULL, 1472572556, 1472572556),
('/crud/base/icsr-type/delete', 2, NULL, NULL, NULL, 1472572556, 1472572556),
('/crud/base/icsr-type/index', 2, NULL, NULL, NULL, 1472572556, 1472572556),
('/crud/base/icsr-type/update', 2, NULL, NULL, NULL, 1472572556, 1472572556),
('/crud/base/icsr-type/view', 2, NULL, NULL, NULL, 1472572556, 1472572556),
('/crud/base/icsr/*', 2, NULL, NULL, NULL, 1472572555, 1472572555),
('/crud/base/icsr/create', 2, NULL, NULL, NULL, 1472572555, 1472572555),
('/crud/base/icsr/delete', 2, NULL, NULL, NULL, 1472572555, 1472572555),
('/crud/base/icsr/index', 2, NULL, NULL, NULL, 1472572555, 1472572555),
('/crud/base/icsr/update', 2, NULL, NULL, NULL, 1472572555, 1472572555),
('/crud/base/icsr/view', 2, NULL, NULL, NULL, 1472572555, 1472572555),
('/crud/base/lkp-country/*', 2, NULL, NULL, NULL, 1472572557, 1472572557),
('/crud/base/lkp-country/create', 2, NULL, NULL, NULL, 1472572556, 1472572556),
('/crud/base/lkp-country/delete', 2, NULL, NULL, NULL, 1472572557, 1472572557),
('/crud/base/lkp-country/index', 2, NULL, NULL, NULL, 1472572556, 1472572556),
('/crud/base/lkp-country/update', 2, NULL, NULL, NULL, 1472572557, 1472572557),
('/crud/base/lkp-country/view', 2, NULL, NULL, NULL, 1472572556, 1472572556),
('/crud/base/lkp-dose-unit/*', 2, NULL, NULL, NULL, 1472572557, 1472572557),
('/crud/base/lkp-dose-unit/create', 2, NULL, NULL, NULL, 1472572557, 1472572557),
('/crud/base/lkp-dose-unit/delete', 2, NULL, NULL, NULL, 1472572557, 1472572557),
('/crud/base/lkp-dose-unit/index', 2, NULL, NULL, NULL, 1472572557, 1472572557),
('/crud/base/lkp-dose-unit/update', 2, NULL, NULL, NULL, 1472572557, 1472572557),
('/crud/base/lkp-dose-unit/view', 2, NULL, NULL, NULL, 1472572557, 1472572557),
('/crud/base/lkp-drug-action/*', 2, NULL, NULL, NULL, 1472572557, 1472572557),
('/crud/base/lkp-drug-action/create', 2, NULL, NULL, NULL, 1472572557, 1472572557),
('/crud/base/lkp-drug-action/delete', 2, NULL, NULL, NULL, 1472572557, 1472572557),
('/crud/base/lkp-drug-action/index', 2, NULL, NULL, NULL, 1472572557, 1472572557),
('/crud/base/lkp-drug-action/update', 2, NULL, NULL, NULL, 1472572557, 1472572557),
('/crud/base/lkp-drug-action/view', 2, NULL, NULL, NULL, 1472572557, 1472572557),
('/crud/base/lkp-drug-role/*', 2, NULL, NULL, NULL, 1472572557, 1472572557),
('/crud/base/lkp-drug-role/create', 2, NULL, NULL, NULL, 1472572557, 1472572557),
('/crud/base/lkp-drug-role/delete', 2, NULL, NULL, NULL, 1472572557, 1472572557),
('/crud/base/lkp-drug-role/index', 2, NULL, NULL, NULL, 1472572557, 1472572557),
('/crud/base/lkp-drug-role/update', 2, NULL, NULL, NULL, 1472572557, 1472572557),
('/crud/base/lkp-drug-role/view', 2, NULL, NULL, NULL, 1472572557, 1472572557),
('/crud/base/lkp-frequency/*', 2, NULL, NULL, NULL, 1472572558, 1472572558),
('/crud/base/lkp-frequency/create', 2, NULL, NULL, NULL, 1472572558, 1472572558),
('/crud/base/lkp-frequency/delete', 2, NULL, NULL, NULL, 1472572558, 1472572558),
('/crud/base/lkp-frequency/index', 2, NULL, NULL, NULL, 1472572557, 1472572557),
('/crud/base/lkp-frequency/update', 2, NULL, NULL, NULL, 1472572558, 1472572558),
('/crud/base/lkp-frequency/view', 2, NULL, NULL, NULL, 1472572558, 1472572558),
('/crud/base/lkp-icsr-outcome/*', 2, NULL, NULL, NULL, 1472572558, 1472572558),
('/crud/base/lkp-icsr-outcome/create', 2, NULL, NULL, NULL, 1472572558, 1472572558),
('/crud/base/lkp-icsr-outcome/delete', 2, NULL, NULL, NULL, 1472572558, 1472572558),
('/crud/base/lkp-icsr-outcome/index', 2, NULL, NULL, NULL, 1472572558, 1472572558),
('/crud/base/lkp-icsr-outcome/update', 2, NULL, NULL, NULL, 1472572558, 1472572558),
('/crud/base/lkp-icsr-outcome/view', 2, NULL, NULL, NULL, 1472572558, 1472572558),
('/crud/base/lkp-icsr-type/*', 2, NULL, NULL, NULL, 1472572558, 1472572558),
('/crud/base/lkp-icsr-type/create', 2, NULL, NULL, NULL, 1472572558, 1472572558),
('/crud/base/lkp-icsr-type/delete', 2, NULL, NULL, NULL, 1472572558, 1472572558),
('/crud/base/lkp-icsr-type/index', 2, NULL, NULL, NULL, 1472572558, 1472572558),
('/crud/base/lkp-icsr-type/update', 2, NULL, NULL, NULL, 1472572558, 1472572558),
('/crud/base/lkp-icsr-type/view', 2, NULL, NULL, NULL, 1472572558, 1472572558),
('/crud/base/lkp-meddra-hlgt/*', 2, NULL, NULL, NULL, 1472572558, 1472572558),
('/crud/base/lkp-meddra-hlgt/create', 2, NULL, NULL, NULL, 1472572558, 1472572558),
('/crud/base/lkp-meddra-hlgt/delete', 2, NULL, NULL, NULL, 1472572558, 1472572558),
('/crud/base/lkp-meddra-hlgt/index', 2, NULL, NULL, NULL, 1472572558, 1472572558),
('/crud/base/lkp-meddra-hlgt/update', 2, NULL, NULL, NULL, 1472572558, 1472572558),
('/crud/base/lkp-meddra-hlgt/view', 2, NULL, NULL, NULL, 1472572558, 1472572558),
('/crud/base/lkp-meddra-llt/*', 2, NULL, NULL, NULL, 1472572558, 1472572558),
('/crud/base/lkp-meddra-llt/create', 2, NULL, NULL, NULL, 1472572558, 1472572558),
('/crud/base/lkp-meddra-llt/delete', 2, NULL, NULL, NULL, 1472572558, 1472572558),
('/crud/base/lkp-meddra-llt/index', 2, NULL, NULL, NULL, 1472572558, 1472572558),
('/crud/base/lkp-meddra-llt/update', 2, NULL, NULL, NULL, 1472572558, 1472572558),
('/crud/base/lkp-meddra-llt/view', 2, NULL, NULL, NULL, 1472572558, 1472572558),
('/crud/base/lkp-meddra-pt/*', 2, NULL, NULL, NULL, 1472572559, 1472572559),
('/crud/base/lkp-meddra-pt/create', 2, NULL, NULL, NULL, 1472572559, 1472572559),
('/crud/base/lkp-meddra-pt/delete', 2, NULL, NULL, NULL, 1472572559, 1472572559),
('/crud/base/lkp-meddra-pt/index', 2, NULL, NULL, NULL, 1472572559, 1472572559),
('/crud/base/lkp-meddra-pt/update', 2, NULL, NULL, NULL, 1472572559, 1472572559),
('/crud/base/lkp-meddra-pt/view', 2, NULL, NULL, NULL, 1472572559, 1472572559),
('/crud/base/lkp-occupation/*', 2, NULL, NULL, NULL, 1472572559, 1472572559),
('/crud/base/lkp-occupation/create', 2, NULL, NULL, NULL, 1472572559, 1472572559),
('/crud/base/lkp-occupation/delete', 2, NULL, NULL, NULL, 1472572559, 1472572559),
('/crud/base/lkp-occupation/index', 2, NULL, NULL, NULL, 1472572559, 1472572559),
('/crud/base/lkp-occupation/update', 2, NULL, NULL, NULL, 1472572559, 1472572559),
('/crud/base/lkp-occupation/view', 2, NULL, NULL, NULL, 1472572559, 1472572559),
('/crud/base/lkp-plan/create', 2, NULL, NULL, NULL, 1476034541, 1476034541),
('/crud/base/lkp-reaction-outcome/*', 2, NULL, NULL, NULL, 1472572559, 1472572559),
('/crud/base/lkp-reaction-outcome/create', 2, NULL, NULL, NULL, 1472572559, 1472572559),
('/crud/base/lkp-reaction-outcome/delete', 2, NULL, NULL, NULL, 1472572559, 1472572559),
('/crud/base/lkp-reaction-outcome/index', 2, NULL, NULL, NULL, 1472572559, 1472572559),
('/crud/base/lkp-reaction-outcome/update', 2, NULL, NULL, NULL, 1472572559, 1472572559),
('/crud/base/lkp-reaction-outcome/view', 2, NULL, NULL, NULL, 1472572559, 1472572559),
('/crud/base/lkp-route/*', 2, NULL, NULL, NULL, 1472572559, 1472572559),
('/crud/base/lkp-route/create', 2, NULL, NULL, NULL, 1472572559, 1472572559),
('/crud/base/lkp-route/delete', 2, NULL, NULL, NULL, 1472572559, 1472572559),
('/crud/base/lkp-route/index', 2, NULL, NULL, NULL, 1472572559, 1472572559),
('/crud/base/lkp-route/update', 2, NULL, NULL, NULL, 1472572559, 1472572559),
('/crud/base/lkp-route/view', 2, NULL, NULL, NULL, 1472572559, 1472572559),
('/crud/base/lkp-test/*', 2, NULL, NULL, NULL, 1472572559, 1472572559),
('/crud/base/lkp-test/create', 2, NULL, NULL, NULL, 1472572559, 1472572559),
('/crud/base/lkp-test/delete', 2, NULL, NULL, NULL, 1472572559, 1472572559),
('/crud/base/lkp-test/index', 2, NULL, NULL, NULL, 1472572559, 1472572559),
('/crud/base/lkp-test/update', 2, NULL, NULL, NULL, 1472572559, 1472572559),
('/crud/base/lkp-test/view', 2, NULL, NULL, NULL, 1472572559, 1472572559),
('/crud/base/lkp-time-unit/*', 2, NULL, NULL, NULL, 1472572560, 1472572560),
('/crud/base/lkp-time-unit/create', 2, NULL, NULL, NULL, 1472572560, 1472572560),
('/crud/base/lkp-time-unit/delete', 2, NULL, NULL, NULL, 1472572560, 1472572560),
('/crud/base/lkp-time-unit/index', 2, NULL, NULL, NULL, 1472572560, 1472572560),
('/crud/base/lkp-time-unit/update', 2, NULL, NULL, NULL, 1472572560, 1472572560),
('/crud/base/lkp-time-unit/view', 2, NULL, NULL, NULL, 1472572560, 1472572560),
('/crud/base/lkp-weight-unit/*', 2, NULL, NULL, NULL, 1472572560, 1472572560),
('/crud/base/lkp-weight-unit/create', 2, NULL, NULL, NULL, 1472572560, 1472572560),
('/crud/base/lkp-weight-unit/delete', 2, NULL, NULL, NULL, 1472572560, 1472572560),
('/crud/base/lkp-weight-unit/index', 2, NULL, NULL, NULL, 1472572560, 1472572560),
('/crud/base/lkp-weight-unit/update', 2, NULL, NULL, NULL, 1472572560, 1472572560),
('/crud/base/lkp-weight-unit/view', 2, NULL, NULL, NULL, 1472572560, 1472572560),
('/crud/base/migration/*', 2, NULL, NULL, NULL, 1472572560, 1472572560),
('/crud/base/migration/create', 2, NULL, NULL, NULL, 1472572560, 1472572560),
('/crud/base/migration/delete', 2, NULL, NULL, NULL, 1472572560, 1472572560),
('/crud/base/migration/index', 2, NULL, NULL, NULL, 1472572560, 1472572560),
('/crud/base/migration/update', 2, NULL, NULL, NULL, 1472572560, 1472572560),
('/crud/base/migration/view', 2, NULL, NULL, NULL, 1472572560, 1472572560),
('/crud/base/psmf-section/export-html-psmf', 2, NULL, NULL, NULL, 1476618130, 1476618130),
('/crud/base/user-company/*', 2, NULL, NULL, NULL, 1472572561, 1472572561),
('/crud/base/user-company/create', 2, NULL, NULL, NULL, 1472572561, 1472572561),
('/crud/base/user-company/delete', 2, NULL, NULL, NULL, 1472572561, 1472572561),
('/crud/base/user-company/index', 2, NULL, NULL, NULL, 1472572561, 1472572561),
('/crud/base/user-company/update', 2, NULL, NULL, NULL, 1472572561, 1472572561),
('/crud/base/user-company/view', 2, NULL, NULL, NULL, 1472572561, 1472572561),
('/crud/base/user/*', 2, NULL, NULL, NULL, 1472572561, 1472572561),
('/crud/base/user/create', 2, NULL, NULL, NULL, 1472572561, 1472572561),
('/crud/base/user/delete', 2, NULL, NULL, NULL, 1472572561, 1472572561),
('/crud/base/user/index', 2, NULL, NULL, NULL, 1472572561, 1472572561),
('/crud/base/user/update', 2, NULL, NULL, NULL, 1472572561, 1472572561),
('/crud/base/user/view', 2, NULL, NULL, NULL, 1472572561, 1472572561),
('/crud/company/*', 2, NULL, NULL, NULL, 1472572538, 1472572538),
('/crud/company/create', 2, NULL, NULL, NULL, 1472572538, 1472572538),
('/crud/company/delete', 2, NULL, NULL, NULL, 1472572538, 1472572538),
('/crud/company/index', 2, NULL, NULL, NULL, 1472572538, 1472572538),
('/crud/company/update', 2, NULL, NULL, NULL, 1472572538, 1472572538),
('/crud/company/view', 2, NULL, NULL, NULL, 1472572538, 1472572538),
('/crud/default/*', 2, NULL, NULL, NULL, 1472572538, 1472572538),
('/crud/default/index', 2, NULL, NULL, NULL, 1472572538, 1472572538),
('/crud/drug-prescription/*', 2, NULL, NULL, NULL, 1472572539, 1472572539),
('/crud/drug-prescription/create', 2, NULL, NULL, NULL, 1472572539, 1472572539),
('/crud/drug-prescription/delete', 2, NULL, NULL, NULL, 1472572539, 1472572539),
('/crud/drug-prescription/index', 2, NULL, NULL, NULL, 1472572539, 1472572539),
('/crud/drug-prescription/update', 2, NULL, NULL, NULL, 1472572539, 1472572539),
('/crud/drug-prescription/view', 2, NULL, NULL, NULL, 1472572539, 1472572539),
('/crud/drug/*', 2, NULL, NULL, NULL, 1472572539, 1472572539),
('/crud/drug/create', 2, NULL, NULL, NULL, 1472572538, 1472572538),
('/crud/drug/delete', 2, NULL, NULL, NULL, 1472572539, 1472572539),
('/crud/drug/history', 2, NULL, NULL, NULL, 1474368957, 1474368957),
('/crud/drug/index', 2, 'this is an index permission', NULL, NULL, 1472572166, 1472572166),
('/crud/drug/update', 2, NULL, NULL, NULL, 1472572539, 1472572539),
('/crud/drug/view', 2, NULL, NULL, NULL, 1472572538, 1472572538),
('/crud/icsr-concomitant-drug/*', 2, NULL, NULL, NULL, 1472572539, 1472572539),
('/crud/icsr-concomitant-drug/create', 2, NULL, NULL, NULL, 1472572539, 1472572539),
('/crud/icsr-concomitant-drug/delete', 2, NULL, NULL, NULL, 1472572539, 1472572539),
('/crud/icsr-concomitant-drug/index', 2, NULL, NULL, NULL, 1472572539, 1472572539),
('/crud/icsr-concomitant-drug/update', 2, NULL, NULL, NULL, 1472572539, 1472572539),
('/crud/icsr-concomitant-drug/view', 2, NULL, NULL, NULL, 1472572539, 1472572539),
('/crud/icsr-event/*', 2, NULL, NULL, NULL, 1472572539, 1472572539),
('/crud/icsr-event/create', 2, NULL, NULL, NULL, 1472572539, 1472572539),
('/crud/icsr-event/delete', 2, NULL, NULL, NULL, 1472572539, 1472572539),
('/crud/icsr-event/index', 2, NULL, NULL, NULL, 1472572539, 1472572539),
('/crud/icsr-event/update', 2, NULL, NULL, NULL, 1472572539, 1472572539),
('/crud/icsr-event/view', 2, NULL, NULL, NULL, 1472572539, 1472572539),
('/crud/icsr-narritive/create', 2, NULL, NULL, NULL, 1477306750, 1477306750),
('/crud/icsr-narritive/update', 2, NULL, NULL, NULL, 1477306750, 1477306750),
('/crud/icsr-narritive/view', 2, NULL, NULL, NULL, 1477306750, 1477306750),
('/crud/icsr-outcome/*', 2, NULL, NULL, NULL, 1472572540, 1472572540),
('/crud/icsr-outcome/create', 2, NULL, NULL, NULL, 1472572540, 1472572540),
('/crud/icsr-outcome/delete', 2, NULL, NULL, NULL, 1472572540, 1472572540),
('/crud/icsr-outcome/index', 2, NULL, NULL, NULL, 1472572539, 1472572539),
('/crud/icsr-outcome/update', 2, NULL, NULL, NULL, 1472572540, 1472572540),
('/crud/icsr-outcome/view', 2, NULL, NULL, NULL, 1472572539, 1472572539),
('/crud/icsr-reporter/*', 2, NULL, NULL, NULL, 1472572540, 1472572540),
('/crud/icsr-reporter/create', 2, NULL, NULL, NULL, 1472572540, 1472572540),
('/crud/icsr-reporter/delete', 2, NULL, NULL, NULL, 1472572540, 1472572540),
('/crud/icsr-reporter/index', 2, NULL, NULL, NULL, 1472572540, 1472572540),
('/crud/icsr-reporter/update', 2, NULL, NULL, NULL, 1472572540, 1472572540),
('/crud/icsr-reporter/view', 2, NULL, NULL, NULL, 1472572540, 1472572540),
('/crud/icsr-test/*', 2, NULL, NULL, NULL, 1472572540, 1472572540),
('/crud/icsr-test/create', 2, NULL, NULL, NULL, 1472572540, 1472572540),
('/crud/icsr-test/delete', 2, NULL, NULL, NULL, 1472572540, 1472572540),
('/crud/icsr-test/index', 2, NULL, NULL, NULL, 1472572540, 1472572540),
('/crud/icsr-test/update', 2, NULL, NULL, NULL, 1472572540, 1472572540),
('/crud/icsr-test/view', 2, NULL, NULL, NULL, 1472572540, 1472572540),
('/crud/icsr-type/*', 2, NULL, NULL, NULL, 1472572540, 1472572540),
('/crud/icsr-type/create', 2, NULL, NULL, NULL, 1472572540, 1472572540),
('/crud/icsr-type/delete', 2, NULL, NULL, NULL, 1472572540, 1472572540),
('/crud/icsr-type/index', 2, NULL, NULL, NULL, 1472572540, 1472572540),
('/crud/icsr-type/update', 2, NULL, NULL, NULL, 1472572540, 1472572540),
('/crud/icsr-type/view', 2, NULL, NULL, NULL, 1472572540, 1472572540),
('/crud/icsr-version-response/create', 2, NULL, NULL, NULL, 1475954841, 1475954841),
('/crud/icsr/*', 2, NULL, NULL, NULL, 1472572539, 1472572539),
('/crud/icsr/check-duplicate-icsr', 2, NULL, NULL, NULL, 1475131072, 1475131072),
('/crud/icsr/create', 2, NULL, NULL, NULL, 1472572539, 1472572539),
('/crud/icsr/delete', 2, NULL, NULL, NULL, 1472572539, 1472572539),
('/crud/icsr/drug-prescription-history', 2, NULL, NULL, NULL, 1474368957, 1474368957),
('/crud/icsr/export', 2, NULL, NULL, NULL, 1472572539, 1472572539),
('/crud/icsr/export-null-case', 2, NULL, NULL, NULL, 1475587827, 1475587827),
('/crud/icsr/history', 2, NULL, NULL, NULL, 1474368952, 1474368952),
('/crud/icsr/icsr-event-history', 2, NULL, NULL, NULL, 1474368957, 1474368957),
('/crud/icsr/icsr-test-history', 2, NULL, NULL, NULL, 1474368957, 1474368957),
('/crud/icsr/index', 2, NULL, NULL, NULL, 1472572539, 1472572539),
('/crud/icsr/null-case-reason', 2, NULL, NULL, NULL, 1475514374, 1475514374),
('/crud/icsr/reporter-history', 2, NULL, NULL, NULL, 1474368957, 1474368957),
('/crud/icsr/update', 2, NULL, NULL, NULL, 1472572539, 1472572539),
('/crud/icsr/view', 2, NULL, NULL, NULL, 1472572539, 1472572539),
('/crud/lkp-country/*', 2, NULL, NULL, NULL, 1472572540, 1472572540),
('/crud/lkp-country/create', 2, NULL, NULL, NULL, 1472572540, 1472572540),
('/crud/lkp-country/delete', 2, NULL, NULL, NULL, 1472572540, 1472572540),
('/crud/lkp-country/index', 2, NULL, NULL, NULL, 1472572540, 1472572540),
('/crud/lkp-country/update', 2, NULL, NULL, NULL, 1472572540, 1472572540),
('/crud/lkp-country/view', 2, NULL, NULL, NULL, 1472572540, 1472572540),
('/crud/lkp-dose-unit/*', 2, NULL, NULL, NULL, 1472572541, 1472572541),
('/crud/lkp-dose-unit/create', 2, NULL, NULL, NULL, 1472572541, 1472572541),
('/crud/lkp-dose-unit/delete', 2, NULL, NULL, NULL, 1472572541, 1472572541),
('/crud/lkp-dose-unit/index', 2, NULL, NULL, NULL, 1472572540, 1472572540),
('/crud/lkp-dose-unit/update', 2, NULL, NULL, NULL, 1472572541, 1472572541),
('/crud/lkp-dose-unit/view', 2, NULL, NULL, NULL, 1472572540, 1472572540),
('/crud/lkp-drug-action/*', 2, NULL, NULL, NULL, 1472572541, 1472572541),
('/crud/lkp-drug-action/create', 2, NULL, NULL, NULL, 1472572541, 1472572541),
('/crud/lkp-drug-action/delete', 2, NULL, NULL, NULL, 1472572541, 1472572541),
('/crud/lkp-drug-action/index', 2, NULL, NULL, NULL, 1472572541, 1472572541),
('/crud/lkp-drug-action/update', 2, NULL, NULL, NULL, 1472572541, 1472572541),
('/crud/lkp-drug-action/view', 2, NULL, NULL, NULL, 1472572541, 1472572541),
('/crud/lkp-drug-role/*', 2, NULL, NULL, NULL, 1472572541, 1472572541),
('/crud/lkp-drug-role/create', 2, NULL, NULL, NULL, 1472572541, 1472572541),
('/crud/lkp-drug-role/delete', 2, NULL, NULL, NULL, 1472572541, 1472572541),
('/crud/lkp-drug-role/index', 2, NULL, NULL, NULL, 1472572541, 1472572541),
('/crud/lkp-drug-role/update', 2, NULL, NULL, NULL, 1472572541, 1472572541),
('/crud/lkp-drug-role/view', 2, NULL, NULL, NULL, 1472572541, 1472572541),
('/crud/lkp-frequency/*', 2, NULL, NULL, NULL, 1472572541, 1472572541),
('/crud/lkp-frequency/create', 2, NULL, NULL, NULL, 1472572541, 1472572541),
('/crud/lkp-frequency/delete', 2, NULL, NULL, NULL, 1472572541, 1472572541),
('/crud/lkp-frequency/index', 2, NULL, NULL, NULL, 1472572541, 1472572541),
('/crud/lkp-frequency/update', 2, NULL, NULL, NULL, 1472572541, 1472572541),
('/crud/lkp-frequency/view', 2, NULL, NULL, NULL, 1472572541, 1472572541),
('/crud/lkp-icsr-eventoutcome/*', 2, NULL, NULL, NULL, 1472572542, 1472572542),
('/crud/lkp-icsr-eventoutcome/create', 2, NULL, NULL, NULL, 1472572541, 1472572541),
('/crud/lkp-icsr-eventoutcome/delete', 2, NULL, NULL, NULL, 1472572541, 1472572541),
('/crud/lkp-icsr-eventoutcome/index', 2, NULL, NULL, NULL, 1472572541, 1472572541),
('/crud/lkp-icsr-eventoutcome/update', 2, NULL, NULL, NULL, 1472572541, 1472572541),
('/crud/lkp-icsr-eventoutcome/view', 2, NULL, NULL, NULL, 1472572541, 1472572541),
('/crud/lkp-icsr-outcome/*', 2, NULL, NULL, NULL, 1472572542, 1472572542),
('/crud/lkp-icsr-outcome/create', 2, NULL, NULL, NULL, 1472572542, 1472572542),
('/crud/lkp-icsr-outcome/delete', 2, NULL, NULL, NULL, 1472572542, 1472572542),
('/crud/lkp-icsr-outcome/index', 2, NULL, NULL, NULL, 1472572542, 1472572542),
('/crud/lkp-icsr-outcome/update', 2, NULL, NULL, NULL, 1472572542, 1472572542),
('/crud/lkp-icsr-outcome/view', 2, NULL, NULL, NULL, 1472572542, 1472572542),
('/crud/lkp-icsr-type/*', 2, NULL, NULL, NULL, 1472572542, 1472572542),
('/crud/lkp-icsr-type/create', 2, NULL, NULL, NULL, 1472572542, 1472572542),
('/crud/lkp-icsr-type/delete', 2, NULL, NULL, NULL, 1472572542, 1472572542),
('/crud/lkp-icsr-type/index', 2, NULL, NULL, NULL, 1472572542, 1472572542),
('/crud/lkp-icsr-type/update', 2, NULL, NULL, NULL, 1472572542, 1472572542),
('/crud/lkp-icsr-type/view', 2, NULL, NULL, NULL, 1472572542, 1472572542),
('/crud/lkp-meddra-hlgt/*', 2, NULL, NULL, NULL, 1472572542, 1472572542),
('/crud/lkp-meddra-hlgt/create', 2, NULL, NULL, NULL, 1472572542, 1472572542),
('/crud/lkp-meddra-hlgt/delete', 2, NULL, NULL, NULL, 1472572542, 1472572542),
('/crud/lkp-meddra-hlgt/index', 2, NULL, NULL, NULL, 1472572542, 1472572542),
('/crud/lkp-meddra-hlgt/update', 2, NULL, NULL, NULL, 1472572542, 1472572542),
('/crud/lkp-meddra-hlgt/view', 2, NULL, NULL, NULL, 1472572542, 1472572542),
('/crud/lkp-meddra-llt/*', 2, NULL, NULL, NULL, 1472572542, 1472572542),
('/crud/lkp-meddra-llt/create', 2, NULL, NULL, NULL, 1472572542, 1472572542),
('/crud/lkp-meddra-llt/delete', 2, NULL, NULL, NULL, 1472572542, 1472572542),
('/crud/lkp-meddra-llt/index', 2, NULL, NULL, NULL, 1472572542, 1472572542),
('/crud/lkp-meddra-llt/update', 2, NULL, NULL, NULL, 1472572542, 1472572542),
('/crud/lkp-meddra-llt/view', 2, NULL, NULL, NULL, 1472572542, 1472572542),
('/crud/lkp-meddra-pt/*', 2, NULL, NULL, NULL, 1472572543, 1472572543),
('/crud/lkp-meddra-pt/create', 2, NULL, NULL, NULL, 1472572542, 1472572542),
('/crud/lkp-meddra-pt/delete', 2, NULL, NULL, NULL, 1472572542, 1472572542),
('/crud/lkp-meddra-pt/index', 2, NULL, NULL, NULL, 1472572542, 1472572542),
('/crud/lkp-meddra-pt/update', 2, NULL, NULL, NULL, 1472572542, 1472572542),
('/crud/lkp-meddra-pt/view', 2, NULL, NULL, NULL, 1472572542, 1472572542),
('/crud/lkp-occupation/*', 2, NULL, NULL, NULL, 1472572543, 1472572543),
('/crud/lkp-occupation/create', 2, NULL, NULL, NULL, 1472572543, 1472572543),
('/crud/lkp-occupation/delete', 2, NULL, NULL, NULL, 1472572543, 1472572543),
('/crud/lkp-occupation/index', 2, NULL, NULL, NULL, 1472572543, 1472572543),
('/crud/lkp-occupation/update', 2, NULL, NULL, NULL, 1472572543, 1472572543),
('/crud/lkp-occupation/view', 2, NULL, NULL, NULL, 1472572543, 1472572543),
('/crud/lkp-plan/*', 2, NULL, NULL, NULL, 1474477507, 1474477507),
('/crud/lkp-plan/create', 2, NULL, NULL, NULL, 1474477507, 1474477507),
('/crud/lkp-plan/delete', 2, NULL, NULL, NULL, 1474477507, 1474477507),
('/crud/lkp-plan/index', 2, NULL, NULL, NULL, 1474477507, 1474477507),
('/crud/lkp-plan/update', 2, NULL, NULL, NULL, 1474477507, 1474477507),
('/crud/lkp-plan/view', 2, NULL, NULL, NULL, 1474477507, 1474477507),
('/crud/lkp-reaction-outcome/*', 2, NULL, NULL, NULL, 1472572543, 1472572543),
('/crud/lkp-reaction-outcome/create', 2, NULL, NULL, NULL, 1472572543, 1472572543),
('/crud/lkp-reaction-outcome/delete', 2, NULL, NULL, NULL, 1472572543, 1472572543),
('/crud/lkp-reaction-outcome/index', 2, NULL, NULL, NULL, 1472572543, 1472572543),
('/crud/lkp-reaction-outcome/update', 2, NULL, NULL, NULL, 1472572543, 1472572543),
('/crud/lkp-reaction-outcome/view', 2, NULL, NULL, NULL, 1472572543, 1472572543),
('/crud/lkp-route/*', 2, NULL, NULL, NULL, 1472572543, 1472572543),
('/crud/lkp-route/create', 2, NULL, NULL, NULL, 1472572543, 1472572543),
('/crud/lkp-route/delete', 2, NULL, NULL, NULL, 1472572543, 1472572543),
('/crud/lkp-route/index', 2, NULL, NULL, NULL, 1472572543, 1472572543),
('/crud/lkp-route/update', 2, NULL, NULL, NULL, 1472572543, 1472572543),
('/crud/lkp-route/view', 2, NULL, NULL, NULL, 1472572543, 1472572543),
('/crud/lkp-test/*', 2, NULL, NULL, NULL, 1472572543, 1472572543),
('/crud/lkp-test/create', 2, NULL, NULL, NULL, 1472572543, 1472572543),
('/crud/lkp-test/delete', 2, NULL, NULL, NULL, 1472572543, 1472572543),
('/crud/lkp-test/index', 2, NULL, NULL, NULL, 1472572543, 1472572543),
('/crud/lkp-test/update', 2, NULL, NULL, NULL, 1472572543, 1472572543),
('/crud/lkp-test/view', 2, NULL, NULL, NULL, 1472572543, 1472572543),
('/crud/lkp-time-unit/*', 2, NULL, NULL, NULL, 1472572544, 1472572544),
('/crud/lkp-time-unit/create', 2, NULL, NULL, NULL, 1472572543, 1472572543),
('/crud/lkp-time-unit/delete', 2, NULL, NULL, NULL, 1472572543, 1472572543),
('/crud/lkp-time-unit/index', 2, NULL, NULL, NULL, 1472572543, 1472572543),
('/crud/lkp-time-unit/update', 2, NULL, NULL, NULL, 1472572543, 1472572543),
('/crud/lkp-time-unit/view', 2, NULL, NULL, NULL, 1472572543, 1472572543),
('/crud/lkp-weight-unit/*', 2, NULL, NULL, NULL, 1472572544, 1472572544),
('/crud/lkp-weight-unit/create', 2, NULL, NULL, NULL, 1472572544, 1472572544),
('/crud/lkp-weight-unit/delete', 2, NULL, NULL, NULL, 1472572544, 1472572544),
('/crud/lkp-weight-unit/index', 2, NULL, NULL, NULL, 1472572544, 1472572544),
('/crud/lkp-weight-unit/update', 2, NULL, NULL, NULL, 1472572544, 1472572544),
('/crud/lkp-weight-unit/view', 2, NULL, NULL, NULL, 1472572544, 1472572544),
('/crud/meddra/create', 2, NULL, NULL, NULL, 1477554310, 1477554310),
('/crud/migration/*', 2, NULL, NULL, NULL, 1472572544, 1472572544),
('/crud/migration/create', 2, NULL, NULL, NULL, 1472572544, 1472572544),
('/crud/migration/delete', 2, NULL, NULL, NULL, 1472572544, 1472572544),
('/crud/migration/index', 2, NULL, NULL, NULL, 1472572544, 1472572544),
('/crud/migration/update', 2, NULL, NULL, NULL, 1472572544, 1472572544),
('/crud/migration/view', 2, NULL, NULL, NULL, 1472572544, 1472572544),
('/crud/psmf-section/create', 2, NULL, NULL, NULL, 1476391310, 1476391310),
('/crud/psmf-section/delete', 2, NULL, NULL, NULL, 1476391310, 1476391310),
('/crud/psmf-section/export-html-psmf', 2, NULL, NULL, NULL, 1476618256, 1476618256),
('/crud/psmf-section/index', 2, NULL, NULL, NULL, 1476391310, 1476391310),
('/crud/psmf-section/update', 2, NULL, NULL, NULL, 1476391310, 1476391310),
('/crud/psmf-section/view', 2, NULL, NULL, NULL, 1476391310, 1476391310),
('/crud/psmf/create', 2, NULL, NULL, NULL, 1476699257, 1476699257),
('/crud/psmf/download', 2, NULL, NULL, NULL, 1476699257, 1476699257),
('/crud/psmf/index', 2, NULL, NULL, NULL, 1476699257, 1476699257),
('/crud/user-company/*', 2, NULL, NULL, NULL, 1472572544, 1472572544),
('/crud/user-company/create', 2, NULL, NULL, NULL, 1472572544, 1472572544),
('/crud/user-company/delete', 2, NULL, NULL, NULL, 1472572544, 1472572544),
('/crud/user-company/index', 2, NULL, NULL, NULL, 1472572544, 1472572544),
('/crud/user-company/update', 2, NULL, NULL, NULL, 1472572544, 1472572544),
('/crud/user-company/view', 2, NULL, NULL, NULL, 1472572544, 1472572544),
('/crud/user/*', 2, NULL, NULL, NULL, 1472572544, 1472572544),
('/crud/user/create', 2, NULL, NULL, NULL, 1472572544, 1472572544),
('/crud/user/delete', 2, NULL, NULL, NULL, 1472572544, 1472572544),
('/crud/user/index', 2, NULL, NULL, NULL, 1472572544, 1472572544),
('/crud/user/update', 2, NULL, NULL, NULL, 1472572544, 1472572544),
('/crud/user/view', 2, NULL, NULL, NULL, 1472572544, 1472572544),
('/debug/*', 2, NULL, NULL, NULL, 1472572563, 1472572563),
('/debug/default/*', 2, NULL, NULL, NULL, 1472572563, 1472572563),
('/debug/default/db-explain', 2, NULL, NULL, NULL, 1472572563, 1472572563),
('/debug/default/download-mail', 2, NULL, NULL, NULL, 1472572563, 1472572563),
('/debug/default/index', 2, NULL, NULL, NULL, 1472572563, 1472572563),
('/debug/default/toolbar', 2, NULL, NULL, NULL, 1472572563, 1472572563),
('/debug/default/view', 2, NULL, NULL, NULL, 1472572563, 1472572563),
('/gii/*', 2, NULL, NULL, NULL, 1472572564, 1472572564),
('/gii/default/*', 2, NULL, NULL, NULL, 1472572563, 1472572563),
('/gii/default/action', 2, NULL, NULL, NULL, 1472572563, 1472572563),
('/gii/default/diff', 2, NULL, NULL, NULL, 1472572563, 1472572563),
('/gii/default/index', 2, NULL, NULL, NULL, 1472572563, 1472572563),
('/gii/default/preview', 2, NULL, NULL, NULL, 1472572563, 1472572563),
('/gii/default/view', 2, NULL, NULL, NULL, 1472572563, 1472572563),
('/site/*', 2, NULL, NULL, NULL, 1472572564, 1472572564),
('/site/error', 2, NULL, NULL, NULL, 1472572564, 1472572564),
('/site/index', 2, NULL, NULL, NULL, 1472572564, 1472572564),
('/site/landing', 2, NULL, NULL, NULL, 1472572564, 1472572564),
('/site/login', 2, NULL, NULL, NULL, 1472572564, 1472572564),
('/site/logout', 2, NULL, NULL, NULL, 1472572564, 1472572564);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/site/send-mail', 2, NULL, NULL, NULL, 1472572564, 1472572564),
('admin', 1, 'this is admin', NULL, NULL, 1472665688, 1472665688),
('normalUser', 1, 'this is for normal users', NULL, NULL, 1472573726, 1472573726);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', '/admin/*'),
('admin', '/admin/assignment/*'),
('admin', '/admin/assignment/assign'),
('normalUser', '/admin/assignment/assign'),
('admin', '/admin/assignment/index'),
('normalUser', '/admin/assignment/index'),
('admin', '/admin/assignment/revoke'),
('normalUser', '/admin/assignment/revoke'),
('admin', '/admin/assignment/view'),
('normalUser', '/admin/assignment/view'),
('admin', '/admin/default/*'),
('admin', '/admin/default/index'),
('admin', '/admin/menu/*'),
('admin', '/admin/menu/create'),
('normalUser', '/admin/menu/create'),
('admin', '/admin/menu/delete'),
('normalUser', '/admin/menu/delete'),
('admin', '/admin/menu/index'),
('normalUser', '/admin/menu/index'),
('admin', '/admin/menu/update'),
('normalUser', '/admin/menu/update'),
('admin', '/admin/menu/view'),
('normalUser', '/admin/menu/view'),
('admin', '/admin/permission/*'),
('admin', '/admin/permission/assign'),
('normalUser', '/admin/permission/assign'),
('admin', '/admin/permission/create'),
('normalUser', '/admin/permission/create'),
('admin', '/admin/permission/delete'),
('normalUser', '/admin/permission/delete'),
('admin', '/admin/permission/index'),
('normalUser', '/admin/permission/index'),
('admin', '/admin/permission/remove'),
('normalUser', '/admin/permission/remove'),
('admin', '/admin/permission/update'),
('normalUser', '/admin/permission/update'),
('admin', '/admin/permission/view'),
('normalUser', '/admin/permission/view'),
('admin', '/admin/role/*'),
('admin', '/admin/role/assign'),
('normalUser', '/admin/role/assign'),
('admin', '/admin/role/create'),
('normalUser', '/admin/role/create'),
('admin', '/admin/role/delete'),
('normalUser', '/admin/role/delete'),
('admin', '/admin/role/index'),
('normalUser', '/admin/role/index'),
('admin', '/admin/role/remove'),
('normalUser', '/admin/role/remove'),
('admin', '/admin/role/update'),
('normalUser', '/admin/role/update'),
('admin', '/admin/role/view'),
('normalUser', '/admin/role/view'),
('admin', '/admin/route/*'),
('admin', '/admin/route/assign'),
('normalUser', '/admin/route/assign'),
('admin', '/admin/route/create'),
('normalUser', '/admin/route/create'),
('admin', '/admin/route/index'),
('normalUser', '/admin/route/index'),
('admin', '/admin/route/refresh'),
('normalUser', '/admin/route/refresh'),
('admin', '/admin/route/remove'),
('normalUser', '/admin/route/remove'),
('admin', '/admin/rule/*'),
('admin', '/admin/rule/create'),
('normalUser', '/admin/rule/create'),
('admin', '/admin/rule/delete'),
('normalUser', '/admin/rule/delete'),
('admin', '/admin/rule/index'),
('normalUser', '/admin/rule/index'),
('admin', '/admin/rule/update'),
('normalUser', '/admin/rule/update'),
('admin', '/admin/rule/view'),
('normalUser', '/admin/rule/view'),
('admin', '/admin/user/*'),
('admin', '/admin/user/activate'),
('normalUser', '/admin/user/activate'),
('admin', '/admin/user/change-password'),
('normalUser', '/admin/user/change-password'),
('admin', '/admin/user/delete'),
('normalUser', '/admin/user/delete'),
('admin', '/admin/user/index'),
('normalUser', '/admin/user/index'),
('admin', '/admin/user/login'),
('normalUser', '/admin/user/login'),
('admin', '/admin/user/logout'),
('normalUser', '/admin/user/logout'),
('admin', '/admin/user/request-password-reset'),
('normalUser', '/admin/user/request-password-reset'),
('admin', '/admin/user/reset-password'),
('normalUser', '/admin/user/reset-password'),
('admin', '/admin/user/signup'),
('normalUser', '/admin/user/signup'),
('admin', '/admin/user/view'),
('normalUser', '/admin/user/view'),
('admin', '/crud/api/company/*'),
('admin', '/crud/api/company/create'),
('admin', '/crud/api/company/delete'),
('admin', '/crud/api/company/index'),
('admin', '/crud/api/company/options'),
('admin', '/crud/api/company/update'),
('admin', '/crud/api/company/view'),
('admin', '/crud/api/drug-prescription/*'),
('admin', '/crud/api/drug-prescription/create'),
('admin', '/crud/api/drug-prescription/delete'),
('admin', '/crud/api/drug-prescription/index'),
('admin', '/crud/api/drug-prescription/options'),
('admin', '/crud/api/drug-prescription/update'),
('admin', '/crud/api/drug-prescription/view'),
('admin', '/crud/api/drug/create'),
('admin', '/crud/api/drug/delete'),
('admin', '/crud/api/drug/options'),
('admin', '/crud/api/drug/update'),
('admin', '/crud/api/drug/view'),
('admin', '/crud/api/icsr-concomitant-drug/*'),
('admin', '/crud/api/icsr-concomitant-drug/create'),
('admin', '/crud/api/icsr-concomitant-drug/delete'),
('admin', '/crud/api/icsr-concomitant-drug/index'),
('admin', '/crud/api/icsr-concomitant-drug/options'),
('admin', '/crud/api/icsr-concomitant-drug/update'),
('admin', '/crud/api/icsr-concomitant-drug/view'),
('admin', '/crud/api/icsr-event/*'),
('admin', '/crud/api/icsr-event/create'),
('admin', '/crud/api/icsr-event/delete'),
('admin', '/crud/api/icsr-event/options'),
('admin', '/crud/api/icsr-event/update'),
('admin', '/crud/api/icsr-event/view'),
('admin', '/crud/api/icsr-outcome/*'),
('admin', '/crud/api/icsr-outcome/create'),
('admin', '/crud/api/icsr-outcome/delete'),
('admin', '/crud/api/icsr-outcome/index'),
('admin', '/crud/api/icsr-outcome/options'),
('admin', '/crud/api/icsr-outcome/update'),
('admin', '/crud/api/icsr-outcome/view'),
('admin', '/crud/api/icsr-reporter/*'),
('admin', '/crud/api/icsr-reporter/create'),
('admin', '/crud/api/icsr-reporter/delete'),
('admin', '/crud/api/icsr-reporter/index'),
('admin', '/crud/api/icsr-reporter/options'),
('admin', '/crud/api/icsr-reporter/update'),
('admin', '/crud/api/icsr-reporter/view'),
('admin', '/crud/api/icsr-test/*'),
('admin', '/crud/api/icsr-test/create'),
('admin', '/crud/api/icsr-test/delete'),
('admin', '/crud/api/icsr-test/index'),
('admin', '/crud/api/icsr-test/options'),
('admin', '/crud/api/icsr-test/update'),
('admin', '/crud/api/icsr-test/view'),
('admin', '/crud/api/icsr-type/*'),
('admin', '/crud/api/icsr-type/create'),
('admin', '/crud/api/icsr-type/delete'),
('admin', '/crud/api/icsr-type/index'),
('admin', '/crud/api/icsr-type/options'),
('admin', '/crud/api/icsr-type/update'),
('admin', '/crud/api/icsr-type/view'),
('admin', '/crud/api/icsr/*'),
('admin', '/crud/api/icsr/create'),
('admin', '/crud/api/icsr/delete'),
('admin', '/crud/api/icsr/index'),
('admin', '/crud/api/icsr/options'),
('admin', '/crud/api/icsr/update'),
('admin', '/crud/api/icsr/view'),
('admin', '/crud/api/lkp-country/*'),
('admin', '/crud/api/lkp-country/create'),
('admin', '/crud/api/lkp-country/delete'),
('admin', '/crud/api/lkp-country/index'),
('admin', '/crud/api/lkp-country/options'),
('admin', '/crud/api/lkp-country/update'),
('admin', '/crud/api/lkp-country/view'),
('admin', '/crud/api/lkp-dose-unit/*'),
('admin', '/crud/api/lkp-dose-unit/create'),
('admin', '/crud/api/lkp-dose-unit/delete'),
('admin', '/crud/api/lkp-dose-unit/index'),
('admin', '/crud/api/lkp-dose-unit/options'),
('admin', '/crud/api/lkp-dose-unit/update'),
('admin', '/crud/api/lkp-dose-unit/view'),
('admin', '/crud/api/lkp-drug-action/*'),
('admin', '/crud/api/lkp-drug-action/create'),
('admin', '/crud/api/lkp-drug-action/delete'),
('admin', '/crud/api/lkp-drug-action/index'),
('admin', '/crud/api/lkp-drug-action/options'),
('admin', '/crud/api/lkp-drug-action/update'),
('admin', '/crud/api/lkp-drug-action/view'),
('admin', '/crud/api/lkp-drug-role/*'),
('admin', '/crud/api/lkp-drug-role/create'),
('admin', '/crud/api/lkp-drug-role/delete'),
('admin', '/crud/api/lkp-drug-role/index'),
('admin', '/crud/api/lkp-drug-role/options'),
('admin', '/crud/api/lkp-drug-role/update'),
('admin', '/crud/api/lkp-drug-role/view'),
('admin', '/crud/api/lkp-frequency/*'),
('admin', '/crud/api/lkp-frequency/create'),
('admin', '/crud/api/lkp-frequency/delete'),
('admin', '/crud/api/lkp-frequency/index'),
('admin', '/crud/api/lkp-frequency/options'),
('admin', '/crud/api/lkp-frequency/update'),
('admin', '/crud/api/lkp-frequency/view'),
('admin', '/crud/api/lkp-icsr-outcome/*'),
('admin', '/crud/api/lkp-icsr-outcome/create'),
('admin', '/crud/api/lkp-icsr-outcome/delete'),
('admin', '/crud/api/lkp-icsr-outcome/index'),
('admin', '/crud/api/lkp-icsr-outcome/options'),
('admin', '/crud/api/lkp-icsr-outcome/update'),
('admin', '/crud/api/lkp-icsr-outcome/view'),
('admin', '/crud/api/lkp-icsr-type/*'),
('admin', '/crud/api/lkp-icsr-type/create'),
('admin', '/crud/api/lkp-icsr-type/delete'),
('admin', '/crud/api/lkp-icsr-type/index'),
('admin', '/crud/api/lkp-icsr-type/options'),
('admin', '/crud/api/lkp-icsr-type/update'),
('admin', '/crud/api/lkp-icsr-type/view'),
('admin', '/crud/api/lkp-meddra-hlgt/*'),
('admin', '/crud/api/lkp-meddra-hlgt/create'),
('admin', '/crud/api/lkp-meddra-hlgt/delete'),
('admin', '/crud/api/lkp-meddra-hlgt/index'),
('admin', '/crud/api/lkp-meddra-hlgt/options'),
('admin', '/crud/api/lkp-meddra-hlgt/update'),
('admin', '/crud/api/lkp-meddra-hlgt/view'),
('admin', '/crud/api/lkp-meddra-llt/*'),
('admin', '/crud/api/lkp-meddra-llt/create'),
('admin', '/crud/api/lkp-meddra-llt/delete'),
('admin', '/crud/api/lkp-meddra-llt/index'),
('admin', '/crud/api/lkp-meddra-llt/options'),
('admin', '/crud/api/lkp-meddra-llt/update'),
('admin', '/crud/api/lkp-meddra-llt/view'),
('admin', '/crud/api/lkp-meddra-pt/*'),
('admin', '/crud/api/lkp-meddra-pt/create'),
('admin', '/crud/api/lkp-meddra-pt/delete'),
('admin', '/crud/api/lkp-meddra-pt/index'),
('admin', '/crud/api/lkp-meddra-pt/options'),
('admin', '/crud/api/lkp-meddra-pt/update'),
('admin', '/crud/api/lkp-meddra-pt/view'),
('admin', '/crud/api/lkp-occupation/*'),
('admin', '/crud/api/lkp-occupation/create'),
('admin', '/crud/api/lkp-occupation/delete'),
('admin', '/crud/api/lkp-occupation/index'),
('admin', '/crud/api/lkp-occupation/options'),
('admin', '/crud/api/lkp-occupation/update'),
('admin', '/crud/api/lkp-occupation/view'),
('admin', '/crud/api/lkp-reaction-outcome/*'),
('admin', '/crud/api/lkp-reaction-outcome/create'),
('admin', '/crud/api/lkp-reaction-outcome/delete'),
('admin', '/crud/api/lkp-reaction-outcome/index'),
('admin', '/crud/api/lkp-reaction-outcome/options'),
('admin', '/crud/api/lkp-reaction-outcome/update'),
('admin', '/crud/api/lkp-reaction-outcome/view'),
('admin', '/crud/api/lkp-route/*'),
('admin', '/crud/api/lkp-route/create'),
('admin', '/crud/api/lkp-route/delete'),
('admin', '/crud/api/lkp-route/index'),
('admin', '/crud/api/lkp-route/options'),
('admin', '/crud/api/lkp-route/update'),
('admin', '/crud/api/lkp-route/view'),
('admin', '/crud/api/lkp-test/*'),
('admin', '/crud/api/lkp-test/create'),
('admin', '/crud/api/lkp-test/delete'),
('admin', '/crud/api/lkp-test/index'),
('admin', '/crud/api/lkp-test/options'),
('admin', '/crud/api/lkp-test/update'),
('admin', '/crud/api/lkp-test/view'),
('admin', '/crud/api/lkp-time-unit/*'),
('admin', '/crud/api/lkp-time-unit/create'),
('admin', '/crud/api/lkp-time-unit/delete'),
('admin', '/crud/api/lkp-time-unit/index'),
('admin', '/crud/api/lkp-time-unit/options'),
('admin', '/crud/api/lkp-time-unit/update'),
('admin', '/crud/api/lkp-time-unit/view'),
('admin', '/crud/api/lkp-weight-unit/*'),
('admin', '/crud/api/lkp-weight-unit/create'),
('admin', '/crud/api/lkp-weight-unit/delete'),
('admin', '/crud/api/lkp-weight-unit/index'),
('admin', '/crud/api/lkp-weight-unit/options'),
('admin', '/crud/api/lkp-weight-unit/update'),
('admin', '/crud/api/lkp-weight-unit/view'),
('admin', '/crud/api/migration/*'),
('admin', '/crud/api/migration/create'),
('admin', '/crud/api/migration/delete'),
('admin', '/crud/api/migration/index'),
('admin', '/crud/api/migration/options'),
('admin', '/crud/api/migration/update'),
('admin', '/crud/api/migration/view'),
('admin', '/crud/api/user-company/*'),
('admin', '/crud/api/user-company/create'),
('admin', '/crud/api/user-company/delete'),
('admin', '/crud/api/user-company/index'),
('admin', '/crud/api/user-company/options'),
('admin', '/crud/api/user-company/update'),
('admin', '/crud/api/user-company/view'),
('admin', '/crud/api/user/*'),
('admin', '/crud/api/user/create'),
('admin', '/crud/api/user/delete'),
('admin', '/crud/api/user/index'),
('admin', '/crud/api/user/options'),
('admin', '/crud/api/user/update'),
('admin', '/crud/api/user/view'),
('admin', '/crud/base/company/*'),
('admin', '/crud/base/company/create'),
('admin', '/crud/base/company/delete'),
('admin', '/crud/base/company/index'),
('admin', '/crud/base/company/update'),
('admin', '/crud/base/company/view'),
('admin', '/crud/base/drug-prescription/*'),
('admin', '/crud/base/drug-prescription/create'),
('admin', '/crud/base/drug-prescription/delete'),
('admin', '/crud/base/drug-prescription/index'),
('admin', '/crud/base/drug-prescription/update'),
('admin', '/crud/base/drug-prescription/view'),
('admin', '/crud/base/drug/create'),
('admin', '/crud/base/drug/delete'),
('admin', '/crud/base/drug/index'),
('admin', '/crud/base/drug/update'),
('admin', '/crud/base/drug/view'),
('admin', '/crud/base/icsr-concomitant-drug/*'),
('admin', '/crud/base/icsr-concomitant-drug/create'),
('admin', '/crud/base/icsr-concomitant-drug/delete'),
('admin', '/crud/base/icsr-concomitant-drug/index'),
('admin', '/crud/base/icsr-concomitant-drug/update'),
('admin', '/crud/base/icsr-concomitant-drug/view'),
('admin', '/crud/base/icsr-event/*'),
('admin', '/crud/base/icsr-event/create'),
('admin', '/crud/base/icsr-event/delete'),
('admin', '/crud/base/icsr-event/update'),
('admin', '/crud/base/icsr-event/view'),
('admin', '/crud/base/icsr-outcome/*'),
('admin', '/crud/base/icsr-outcome/create'),
('admin', '/crud/base/icsr-outcome/delete'),
('admin', '/crud/base/icsr-outcome/index'),
('admin', '/crud/base/icsr-outcome/update'),
('admin', '/crud/base/icsr-outcome/view'),
('admin', '/crud/base/icsr-reporter/*'),
('admin', '/crud/base/icsr-reporter/create'),
('admin', '/crud/base/icsr-reporter/delete'),
('admin', '/crud/base/icsr-reporter/index'),
('admin', '/crud/base/icsr-reporter/update'),
('admin', '/crud/base/icsr-reporter/view'),
('admin', '/crud/base/icsr-test/*'),
('admin', '/crud/base/icsr-test/create'),
('admin', '/crud/base/icsr-test/delete'),
('admin', '/crud/base/icsr-test/index'),
('admin', '/crud/base/icsr-test/update'),
('admin', '/crud/base/icsr-test/view'),
('admin', '/crud/base/icsr-type/*'),
('admin', '/crud/base/icsr-type/create'),
('admin', '/crud/base/icsr-type/delete'),
('admin', '/crud/base/icsr-type/index'),
('admin', '/crud/base/icsr-type/update'),
('admin', '/crud/base/icsr-type/view'),
('admin', '/crud/base/icsr/*'),
('admin', '/crud/base/icsr/create'),
('admin', '/crud/base/icsr/delete'),
('admin', '/crud/base/icsr/index'),
('admin', '/crud/base/icsr/update'),
('admin', '/crud/base/icsr/view'),
('admin', '/crud/base/lkp-country/*'),
('admin', '/crud/base/lkp-country/create'),
('admin', '/crud/base/lkp-country/delete'),
('admin', '/crud/base/lkp-country/index'),
('admin', '/crud/base/lkp-country/update'),
('admin', '/crud/base/lkp-country/view'),
('admin', '/crud/base/lkp-dose-unit/*'),
('admin', '/crud/base/lkp-dose-unit/create'),
('admin', '/crud/base/lkp-dose-unit/delete'),
('admin', '/crud/base/lkp-dose-unit/index'),
('admin', '/crud/base/lkp-dose-unit/update'),
('admin', '/crud/base/lkp-dose-unit/view'),
('admin', '/crud/base/lkp-drug-action/*'),
('admin', '/crud/base/lkp-drug-action/create'),
('admin', '/crud/base/lkp-drug-action/delete'),
('admin', '/crud/base/lkp-drug-action/index'),
('admin', '/crud/base/lkp-drug-action/update'),
('admin', '/crud/base/lkp-drug-action/view'),
('admin', '/crud/base/lkp-drug-role/*'),
('admin', '/crud/base/lkp-drug-role/create'),
('admin', '/crud/base/lkp-drug-role/delete'),
('admin', '/crud/base/lkp-drug-role/index'),
('admin', '/crud/base/lkp-drug-role/update'),
('admin', '/crud/base/lkp-drug-role/view'),
('admin', '/crud/base/lkp-frequency/*'),
('admin', '/crud/base/lkp-frequency/create'),
('admin', '/crud/base/lkp-frequency/delete'),
('admin', '/crud/base/lkp-frequency/index'),
('admin', '/crud/base/lkp-frequency/update'),
('admin', '/crud/base/lkp-frequency/view'),
('admin', '/crud/base/lkp-icsr-outcome/*'),
('admin', '/crud/base/lkp-icsr-outcome/create'),
('admin', '/crud/base/lkp-icsr-outcome/delete'),
('admin', '/crud/base/lkp-icsr-outcome/index'),
('admin', '/crud/base/lkp-icsr-outcome/update'),
('admin', '/crud/base/lkp-icsr-outcome/view'),
('admin', '/crud/base/lkp-icsr-type/*'),
('admin', '/crud/base/lkp-icsr-type/create'),
('admin', '/crud/base/lkp-icsr-type/delete'),
('admin', '/crud/base/lkp-icsr-type/index'),
('admin', '/crud/base/lkp-icsr-type/update'),
('admin', '/crud/base/lkp-icsr-type/view'),
('admin', '/crud/base/lkp-meddra-hlgt/*'),
('admin', '/crud/base/lkp-meddra-hlgt/create'),
('admin', '/crud/base/lkp-meddra-hlgt/delete'),
('admin', '/crud/base/lkp-meddra-hlgt/index'),
('admin', '/crud/base/lkp-meddra-hlgt/update'),
('admin', '/crud/base/lkp-meddra-hlgt/view'),
('admin', '/crud/base/lkp-meddra-llt/*'),
('admin', '/crud/base/lkp-meddra-llt/create'),
('admin', '/crud/base/lkp-meddra-llt/delete'),
('admin', '/crud/base/lkp-meddra-llt/index'),
('admin', '/crud/base/lkp-meddra-llt/update'),
('admin', '/crud/base/lkp-meddra-llt/view'),
('admin', '/crud/base/lkp-meddra-pt/*'),
('admin', '/crud/base/lkp-meddra-pt/create'),
('admin', '/crud/base/lkp-meddra-pt/delete'),
('admin', '/crud/base/lkp-meddra-pt/index'),
('admin', '/crud/base/lkp-meddra-pt/update'),
('admin', '/crud/base/lkp-meddra-pt/view'),
('admin', '/crud/base/lkp-occupation/*'),
('admin', '/crud/base/lkp-occupation/create'),
('admin', '/crud/base/lkp-occupation/delete'),
('admin', '/crud/base/lkp-occupation/index'),
('admin', '/crud/base/lkp-occupation/update'),
('admin', '/crud/base/lkp-occupation/view'),
('admin', '/crud/base/lkp-reaction-outcome/*'),
('admin', '/crud/base/lkp-reaction-outcome/create'),
('admin', '/crud/base/lkp-reaction-outcome/delete'),
('admin', '/crud/base/lkp-reaction-outcome/index'),
('admin', '/crud/base/lkp-reaction-outcome/update'),
('admin', '/crud/base/lkp-reaction-outcome/view'),
('admin', '/crud/base/lkp-route/*'),
('admin', '/crud/base/lkp-route/create'),
('admin', '/crud/base/lkp-route/delete'),
('admin', '/crud/base/lkp-route/index'),
('admin', '/crud/base/lkp-route/update'),
('admin', '/crud/base/lkp-route/view'),
('admin', '/crud/base/lkp-test/*'),
('admin', '/crud/base/lkp-test/create'),
('admin', '/crud/base/lkp-test/delete'),
('admin', '/crud/base/lkp-test/index'),
('admin', '/crud/base/lkp-test/update'),
('admin', '/crud/base/lkp-test/view'),
('admin', '/crud/base/lkp-time-unit/*'),
('admin', '/crud/base/lkp-time-unit/create'),
('admin', '/crud/base/lkp-time-unit/delete'),
('admin', '/crud/base/lkp-time-unit/index'),
('admin', '/crud/base/lkp-time-unit/update'),
('admin', '/crud/base/lkp-time-unit/view'),
('admin', '/crud/base/lkp-weight-unit/*'),
('admin', '/crud/base/lkp-weight-unit/create'),
('admin', '/crud/base/lkp-weight-unit/delete'),
('admin', '/crud/base/lkp-weight-unit/index'),
('admin', '/crud/base/lkp-weight-unit/update'),
('admin', '/crud/base/lkp-weight-unit/view'),
('admin', '/crud/base/migration/*'),
('admin', '/crud/base/migration/create'),
('admin', '/crud/base/migration/delete'),
('admin', '/crud/base/migration/index'),
('admin', '/crud/base/migration/update'),
('admin', '/crud/base/migration/view'),
('normalUser', '/crud/base/psmf-section/export-html-psmf'),
('admin', '/crud/base/user-company/*'),
('admin', '/crud/base/user-company/create'),
('admin', '/crud/base/user-company/delete'),
('admin', '/crud/base/user-company/index'),
('admin', '/crud/base/user-company/update'),
('admin', '/crud/base/user-company/view'),
('admin', '/crud/base/user/*'),
('admin', '/crud/base/user/create'),
('admin', '/crud/base/user/delete'),
('admin', '/crud/base/user/index'),
('admin', '/crud/base/user/update'),
('admin', '/crud/base/user/view'),
('admin', '/crud/company/*'),
('admin', '/crud/company/create'),
('admin', '/crud/company/delete'),
('admin', '/crud/company/index'),
('admin', '/crud/company/update'),
('admin', '/crud/company/view'),
('admin', '/crud/default/*'),
('admin', '/crud/default/index'),
('admin', '/crud/drug-prescription/*'),
('admin', '/crud/drug-prescription/create'),
('normalUser', '/crud/drug-prescription/create'),
('admin', '/crud/drug-prescription/delete'),
('normalUser', '/crud/drug-prescription/delete'),
('admin', '/crud/drug-prescription/index'),
('admin', '/crud/drug-prescription/update'),
('normalUser', '/crud/drug-prescription/update'),
('admin', '/crud/drug-prescription/view'),
('normalUser', '/crud/drug-prescription/view'),
('admin', '/crud/drug/create'),
('normalUser', '/crud/drug/create'),
('admin', '/crud/drug/delete'),
('normalUser', '/crud/drug/delete'),
('normalUser', '/crud/drug/history'),
('normalUser', '/crud/drug/index'),
('admin', '/crud/drug/update'),
('normalUser', '/crud/drug/update'),
('admin', '/crud/drug/view'),
('normalUser', '/crud/drug/view'),
('admin', '/crud/icsr-concomitant-drug/*'),
('admin', '/crud/icsr-concomitant-drug/create'),
('admin', '/crud/icsr-concomitant-drug/delete'),
('admin', '/crud/icsr-concomitant-drug/index'),
('admin', '/crud/icsr-concomitant-drug/update'),
('admin', '/crud/icsr-concomitant-drug/view'),
('admin', '/crud/icsr-event/create'),
('normalUser', '/crud/icsr-event/create'),
('admin', '/crud/icsr-event/delete'),
('normalUser', '/crud/icsr-event/delete'),
('admin', '/crud/icsr-event/update'),
('normalUser', '/crud/icsr-event/update'),
('admin', '/crud/icsr-event/view'),
('normalUser', '/crud/icsr-event/view'),
('normalUser', '/crud/icsr-narritive/create'),
('normalUser', '/crud/icsr-narritive/update'),
('normalUser', '/crud/icsr-narritive/view'),
('admin', '/crud/icsr-outcome/*'),
('admin', '/crud/icsr-outcome/create'),
('admin', '/crud/icsr-outcome/delete'),
('admin', '/crud/icsr-outcome/index'),
('admin', '/crud/icsr-outcome/update'),
('admin', '/crud/icsr-outcome/view'),
('admin', '/crud/icsr-reporter/*'),
('admin', '/crud/icsr-reporter/create'),
('normalUser', '/crud/icsr-reporter/create'),
('admin', '/crud/icsr-reporter/delete'),
('normalUser', '/crud/icsr-reporter/delete'),
('admin', '/crud/icsr-reporter/index'),
('admin', '/crud/icsr-reporter/update'),
('normalUser', '/crud/icsr-reporter/update'),
('admin', '/crud/icsr-reporter/view'),
('normalUser', '/crud/icsr-reporter/view'),
('admin', '/crud/icsr-test/*'),
('admin', '/crud/icsr-test/create'),
('normalUser', '/crud/icsr-test/create'),
('admin', '/crud/icsr-test/delete'),
('normalUser', '/crud/icsr-test/delete'),
('admin', '/crud/icsr-test/index'),
('admin', '/crud/icsr-test/update'),
('normalUser', '/crud/icsr-test/update'),
('admin', '/crud/icsr-test/view'),
('normalUser', '/crud/icsr-test/view'),
('admin', '/crud/icsr-type/*'),
('admin', '/crud/icsr-type/create'),
('admin', '/crud/icsr-type/delete'),
('admin', '/crud/icsr-type/index'),
('admin', '/crud/icsr-type/update'),
('admin', '/crud/icsr-type/view'),
('normalUser', '/crud/icsr-version-response/create'),
('admin', '/crud/icsr/*'),
('normalUser', '/crud/icsr/check-duplicate-icsr'),
('admin', '/crud/icsr/create'),
('normalUser', '/crud/icsr/create'),
('admin', '/crud/icsr/delete'),
('normalUser', '/crud/icsr/delete'),
('normalUser', '/crud/icsr/drug-prescription-history'),
('admin', '/crud/icsr/export'),
('normalUser', '/crud/icsr/export'),
('normalUser', '/crud/icsr/export-null-case'),
('normalUser', '/crud/icsr/history'),
('normalUser', '/crud/icsr/icsr-event-history'),
('normalUser', '/crud/icsr/icsr-test-history'),
('admin', '/crud/icsr/index'),
('normalUser', '/crud/icsr/null-case-reason'),
('normalUser', '/crud/icsr/reporter-history'),
('admin', '/crud/icsr/update'),
('normalUser', '/crud/icsr/update'),
('admin', '/crud/icsr/view'),
('normalUser', '/crud/icsr/view'),
('admin', '/crud/lkp-country/*'),
('admin', '/crud/lkp-country/create'),
('admin', '/crud/lkp-country/delete'),
('admin', '/crud/lkp-country/index'),
('admin', '/crud/lkp-country/update'),
('admin', '/crud/lkp-country/view'),
('admin', '/crud/lkp-dose-unit/*'),
('admin', '/crud/lkp-dose-unit/create'),
('admin', '/crud/lkp-dose-unit/delete'),
('admin', '/crud/lkp-dose-unit/index'),
('admin', '/crud/lkp-dose-unit/update'),
('admin', '/crud/lkp-dose-unit/view'),
('admin', '/crud/lkp-drug-action/*'),
('admin', '/crud/lkp-drug-action/create'),
('admin', '/crud/lkp-drug-action/delete'),
('admin', '/crud/lkp-drug-action/index'),
('admin', '/crud/lkp-drug-action/update'),
('admin', '/crud/lkp-drug-action/view'),
('admin', '/crud/lkp-drug-role/*'),
('admin', '/crud/lkp-drug-role/create'),
('admin', '/crud/lkp-drug-role/delete'),
('admin', '/crud/lkp-drug-role/index'),
('admin', '/crud/lkp-drug-role/update'),
('admin', '/crud/lkp-drug-role/view'),
('admin', '/crud/lkp-frequency/*'),
('admin', '/crud/lkp-frequency/create'),
('admin', '/crud/lkp-frequency/delete'),
('admin', '/crud/lkp-frequency/index'),
('admin', '/crud/lkp-frequency/update'),
('admin', '/crud/lkp-frequency/view'),
('admin', '/crud/lkp-icsr-eventoutcome/*'),
('admin', '/crud/lkp-icsr-eventoutcome/create'),
('admin', '/crud/lkp-icsr-eventoutcome/delete'),
('admin', '/crud/lkp-icsr-eventoutcome/index'),
('admin', '/crud/lkp-icsr-eventoutcome/update'),
('admin', '/crud/lkp-icsr-eventoutcome/view'),
('admin', '/crud/lkp-icsr-outcome/*'),
('admin', '/crud/lkp-icsr-outcome/create'),
('admin', '/crud/lkp-icsr-outcome/delete'),
('admin', '/crud/lkp-icsr-outcome/index'),
('admin', '/crud/lkp-icsr-outcome/update'),
('admin', '/crud/lkp-icsr-outcome/view'),
('admin', '/crud/lkp-icsr-type/*'),
('admin', '/crud/lkp-icsr-type/create'),
('admin', '/crud/lkp-icsr-type/delete'),
('admin', '/crud/lkp-icsr-type/index'),
('admin', '/crud/lkp-icsr-type/update'),
('admin', '/crud/lkp-icsr-type/view'),
('admin', '/crud/lkp-meddra-hlgt/*'),
('admin', '/crud/lkp-meddra-hlgt/create'),
('admin', '/crud/lkp-meddra-hlgt/delete'),
('admin', '/crud/lkp-meddra-hlgt/index'),
('admin', '/crud/lkp-meddra-hlgt/update'),
('admin', '/crud/lkp-meddra-hlgt/view'),
('admin', '/crud/lkp-meddra-llt/*'),
('admin', '/crud/lkp-meddra-llt/create'),
('admin', '/crud/lkp-meddra-llt/delete'),
('admin', '/crud/lkp-meddra-llt/index'),
('admin', '/crud/lkp-meddra-llt/update'),
('admin', '/crud/lkp-meddra-llt/view'),
('admin', '/crud/lkp-meddra-pt/*'),
('admin', '/crud/lkp-meddra-pt/create'),
('admin', '/crud/lkp-meddra-pt/delete'),
('admin', '/crud/lkp-meddra-pt/index'),
('admin', '/crud/lkp-meddra-pt/update'),
('admin', '/crud/lkp-meddra-pt/view'),
('admin', '/crud/lkp-occupation/*'),
('admin', '/crud/lkp-occupation/create'),
('admin', '/crud/lkp-occupation/delete'),
('admin', '/crud/lkp-occupation/index'),
('admin', '/crud/lkp-occupation/update'),
('admin', '/crud/lkp-occupation/view'),
('admin', '/crud/lkp-plan/create'),
('admin', '/crud/lkp-plan/index'),
('admin', '/crud/lkp-reaction-outcome/*'),
('admin', '/crud/lkp-reaction-outcome/create'),
('admin', '/crud/lkp-reaction-outcome/delete'),
('admin', '/crud/lkp-reaction-outcome/index'),
('admin', '/crud/lkp-reaction-outcome/update'),
('admin', '/crud/lkp-reaction-outcome/view'),
('admin', '/crud/lkp-route/*'),
('admin', '/crud/lkp-route/create'),
('admin', '/crud/lkp-route/delete'),
('admin', '/crud/lkp-route/index'),
('admin', '/crud/lkp-route/update'),
('admin', '/crud/lkp-route/view'),
('admin', '/crud/lkp-test/*'),
('admin', '/crud/lkp-test/create'),
('admin', '/crud/lkp-test/delete'),
('admin', '/crud/lkp-test/index'),
('admin', '/crud/lkp-test/update'),
('admin', '/crud/lkp-test/view'),
('admin', '/crud/lkp-time-unit/*'),
('admin', '/crud/lkp-time-unit/create'),
('admin', '/crud/lkp-time-unit/delete'),
('admin', '/crud/lkp-time-unit/index'),
('admin', '/crud/lkp-time-unit/update'),
('admin', '/crud/lkp-time-unit/view'),
('admin', '/crud/lkp-weight-unit/*'),
('admin', '/crud/lkp-weight-unit/create'),
('admin', '/crud/lkp-weight-unit/delete'),
('admin', '/crud/lkp-weight-unit/index'),
('admin', '/crud/lkp-weight-unit/update'),
('admin', '/crud/lkp-weight-unit/view'),
('normalUser', '/crud/meddra/create'),
('admin', '/crud/migration/*'),
('admin', '/crud/migration/create'),
('admin', '/crud/migration/delete'),
('admin', '/crud/migration/index'),
('admin', '/crud/migration/update'),
('admin', '/crud/migration/view'),
('normalUser', '/crud/psmf-section/create'),
('normalUser', '/crud/psmf-section/export-html-psmf'),
('normalUser', '/crud/psmf-section/index'),
('normalUser', '/crud/psmf-section/update'),
('normalUser', '/crud/psmf-section/view'),
('normalUser', '/crud/psmf/create'),
('normalUser', '/crud/psmf/download'),
('normalUser', '/crud/psmf/index'),
('admin', '/crud/user-company/*'),
('admin', '/crud/user-company/create'),
('admin', '/crud/user-company/delete'),
('admin', '/crud/user-company/index'),
('admin', '/crud/user-company/update'),
('admin', '/crud/user-company/view'),
('admin', '/crud/user/*'),
('admin', '/crud/user/create'),
('admin', '/crud/user/delete'),
('admin', '/crud/user/index'),
('admin', '/crud/user/update'),
('admin', '/crud/user/view'),
('admin', '/debug/*'),
('admin', '/debug/default/*'),
('admin', '/debug/default/db-explain'),
('admin', '/debug/default/download-mail'),
('admin', '/debug/default/index'),
('admin', '/debug/default/toolbar'),
('admin', '/debug/default/view'),
('admin', '/gii/*'),
('admin', '/gii/default/*'),
('admin', '/gii/default/action'),
('admin', '/gii/default/diff'),
('admin', '/gii/default/index'),
('admin', '/gii/default/preview'),
('admin', '/gii/default/view'),
('admin', '/site/*'),
('admin', '/site/error'),
('admin', '/site/index'),
('normalUser', '/site/index'),
('admin', '/site/landing'),
('normalUser', '/site/landing'),
('admin', '/site/login'),
('normalUser', '/site/login'),
('admin', '/site/logout'),
('normalUser', '/site/logout'),
('admin', '/site/send-mail');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `adderess` varchar(45) DEFAULT NULL,
  `license_no` varchar(45) DEFAULT NULL,
  `license_image_url` varchar(45) DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `plan_id` int(11) NOT NULL DEFAULT '1',
  `short_name` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-lkp_plan_company` (`plan_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=76 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `adderess`, `license_no`, `license_image_url`, `end_date`, `plan_id`, `short_name`) VALUES
(75, 'Admin', '12 st el morgany', '1237123', 'www.yahoo.com', '2023-03-31', 1, 'ADM');

-- --------------------------------------------------------

--
-- Table structure for table `drug`
--

CREATE TABLE IF NOT EXISTS `drug` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `generic_name` varchar(45) DEFAULT NULL,
  `trade_name` varchar(45) DEFAULT NULL,
  `composition` varchar(45) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `manufacturer` varchar(45) DEFAULT NULL,
  `strength` varchar(45) DEFAULT NULL,
  `route_lkp_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_drug_company1_idx` (`company_id`),
  KEY `fk_drug_route_lkp1_idx` (`route_lkp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

-- --------------------------------------------------------

--
-- Table structure for table `drug_prescription`
--

CREATE TABLE IF NOT EXISTS `drug_prescription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `drug_id` int(11) DEFAULT NULL,
  `icsr_id` int(11) NOT NULL,
  `dose` varchar(45) DEFAULT NULL COMMENT '	B.4.k.6 Dosage text (e.g., 2 mg three times a day for five days)\n',
  `frequency_lkp_id` int(11) DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `lot_no` varchar(45) DEFAULT NULL COMMENT '	B.4.k.3 Batch/lot number\n',
  `use_date_start` date DEFAULT NULL COMMENT 'B.4.k.12 Date of start of drug',
  `use_date_end` date DEFAULT NULL COMMENT '	B.4.k.14 Date of last administration\n',
  `duration_of_use` decimal(10,0) DEFAULT NULL COMMENT '	B.4.k.15 Duration of drug administration\n',
  `duration_of_use_unit` int(11) DEFAULT NULL COMMENT '	B.4.k.15 Duration of drug administration\n',
  `reason_of_use` varchar(60) DEFAULT NULL COMMENT '	B.4.k.11 Indication for use in the case\n',
  `problem_went_after_stop` bit(1) DEFAULT NULL,
  `problem_returned_after_reuse` bit(1) DEFAULT NULL COMMENT '	B.4.k.17 Effect of rechallenge\n',
  `active_substance_names` varchar(450) DEFAULT NULL COMMENT 'B.4.k.2.2 Active substance name(s)\n\n',
  `drug_role` int(11) DEFAULT NULL COMMENT 'B.4.k.1 Characterization of drug role (Suspect/Concomitant/Interacting)',
  `drug_addtional_info` varchar(450) DEFAULT NULL COMMENT 'B.4.k.19 Additional information on drug\n',
  `drug_action_drug_withdrawn` bit(1) DEFAULT NULL COMMENT 'B.4.k.16 Action(s) taken with drug',
  `drug_action_dose_reduced` bit(1) DEFAULT NULL COMMENT 'B.4.k.16 Action(s) taken with drug',
  `drug_action_dose_increased` bit(1) DEFAULT NULL COMMENT 'B.4.k.16 Action(s) taken with drug',
  `drug_action_dose_not_changed` bit(1) DEFAULT NULL COMMENT 'B.4.k.16 Action(s) taken with drug',
  `drug_action_unknown` bit(1) DEFAULT NULL COMMENT 'B.4.k.16 Action(s) taken with drug',
  `lkp_drug_action_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_drug_details_drug1_idx` (`drug_id`),
  KEY `fk_drug_details_icsr1_idx` (`icsr_id`),
  KEY `fk_drug_prescription_frequency_lkp1_idx` (`frequency_lkp_id`),
  KEY `fk-drug-prescription-drug_action` (`lkp_drug_action_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `icsr`
--

CREATE TABLE IF NOT EXISTS `icsr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `drug_id` int(11) NOT NULL,
  `patient_identifier` varchar(45) DEFAULT NULL,
  `patient_age` decimal(10,2) DEFAULT NULL,
  `patient_age_unit` int(11) DEFAULT NULL,
  `patient_birth_date` date DEFAULT NULL,
  `patient_weight` decimal(10,2) DEFAULT NULL,
  `patient_weight_unit` int(11) DEFAULT NULL,
  `extra_history` varchar(45) DEFAULT NULL,
  `report_type` int(11) DEFAULT NULL,
  `is_serious` bit(1) DEFAULT NULL,
  `results_in_death` bit(1) DEFAULT NULL,
  `life_threatening` bit(1) DEFAULT NULL,
  `requires_hospitalization` bit(1) DEFAULT NULL,
  `results_in_disability` bit(1) DEFAULT NULL,
  `is_congenital_anomaly` bit(1) DEFAULT NULL,
  `others_significant` bit(1) DEFAULT NULL,
  `reaction_country_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_icsr_drug1_idx` (`drug_id`),
  KEY `fk_icsr_country` (`reaction_country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=194 ;

-- --------------------------------------------------------

--
-- Table structure for table `icsr_concomitant_drugs`
--

CREATE TABLE IF NOT EXISTS `icsr_concomitant_drugs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icsr_id` int(11) NOT NULL,
  `drug_name` varchar(45) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `stop_date` date DEFAULT NULL,
  `duration_of_use` varchar(45) DEFAULT NULL,
  `dose` varchar(45) DEFAULT NULL,
  `frequency_lkp_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_icsr_concomitant_drugs_frequency_lkp1_idx` (`frequency_lkp_id`),
  KEY `fk_icsr_concomitant_drugs_icsr1_idx` (`icsr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `icsr_event`
--

CREATE TABLE IF NOT EXISTS `icsr_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icsr_id` int(11) NOT NULL,
  `event_description` varchar(512) DEFAULT NULL COMMENT '    B.2.i.0 Reaction or event as reported by the primary source\n',
  `meddra_llt_id` int(11) DEFAULT NULL COMMENT 'B.2.i.1 Reaction or event in MedDRA terminology (Lowest Level Term)\n',
  `meddra_pt_id` int(11) DEFAULT NULL COMMENT 'B.2.i.2 Reaction or event in MedDRA terminology (Preferred Term)',
  `event_date` date DEFAULT NULL COMMENT 'B.2.i.4 Date of start of reaction or event',
  `event_end_date` date DEFAULT NULL COMMENT 'B.2.i.5 Date of end of reaction or event',
  `meddra_llt_text` varchar(45) DEFAULT NULL COMMENT 'B.2.i.1 Reaction or event in MedDRA terminology (Lowest Level Term)',
  `meddra_pt_text` varchar(45) DEFAULT NULL COMMENT 'B.2.i.2 Reaction or event in MedDRA terminology (Preferred Term)',
  `lkp_icsr_eventoutcome_id` int(11) NOT NULL DEFAULT '1',
  `event_outcome` enum('Recovered/resolved','Recovering/resolving','Not recovered/not resolved','Recovered/resolved with sequelae','Fatal','Unknown') DEFAULT NULL COMMENT 'B.2.i.8 Outcome of reaction or event at the time of last observation',
  PRIMARY KEY (`id`,`icsr_id`),
  KEY `fk_icsr_event_icsr1_idx` (`icsr_id`),
  KEY `fk_icsr_event_meddra_llt1_idx` (`meddra_llt_id`),
  KEY `fk_icsr_event_meddra_pt1_idx` (`meddra_pt_id`),
  KEY `fk-icsr-event-lkp_icsr_eventoutcome_id` (`lkp_icsr_eventoutcome_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `icsr_narritive`
--

CREATE TABLE IF NOT EXISTS `icsr_narritive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icsr_id` int(11) NOT NULL,
  `narritive` varchar(20000) DEFAULT NULL,
  `reporter_comment` varchar(500) DEFAULT NULL,
  `sender_comment` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-icsr_narritive-icsr_id` (`icsr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `icsr_outcome`
--

CREATE TABLE IF NOT EXISTS `icsr_outcome` (
  `icsr_id` int(11) NOT NULL,
  `icsr_outcome_lkp_id` int(11) NOT NULL,
  `icsr_outcome_date` date DEFAULT NULL,
  PRIMARY KEY (`icsr_id`,`icsr_outcome_lkp_id`),
  KEY `fk_icsr_has_icsr_outcome_lkp_icsr_outcome_lkp1_idx` (`icsr_outcome_lkp_id`),
  KEY `fk_icsr_has_icsr_outcome_lkp_icsr1_idx` (`icsr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `icsr_reporter`
--

CREATE TABLE IF NOT EXISTS `icsr_reporter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icsr_id` int(11) NOT NULL,
  `country_lkp_id` int(11) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `address_line_1` varchar(45) DEFAULT NULL,
  `address_line_2` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `zip_code` varchar(45) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `occupation_lkp_id` int(11) NOT NULL,
  `health_professional` enum('yes','no') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_icsr_reporter_icsr1_idx` (`icsr_id`),
  KEY `fk_icsr_reporter_country_lkp1_idx` (`country_lkp_id`),
  KEY `fk_icsr_reporter_occupation_lkp1_idx` (`occupation_lkp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `icsr_test`
--

CREATE TABLE IF NOT EXISTS `icsr_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icsr_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `result` varchar(512) DEFAULT NULL,
  `result_unit` varchar(45) DEFAULT NULL,
  `normal_low_range` varchar(45) DEFAULT NULL,
  `normal_high_range` varchar(45) DEFAULT NULL,
  `more_info` varchar(45) DEFAULT NULL,
  `test_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_icsr_test_icsr1_idx` (`icsr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `icsr_type`
--

CREATE TABLE IF NOT EXISTS `icsr_type` (
  `icsr_id` int(11) NOT NULL,
  `icsr_type_lkp_id` int(11) NOT NULL,
  PRIMARY KEY (`icsr_id`,`icsr_type_lkp_id`),
  KEY `fk_icsr_has_icsr_type_lkp_icsr_type_lkp1_idx` (`icsr_type_lkp_id`),
  KEY `fk_icsr_has_icsr_type_lkp_icsr1_idx` (`icsr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `icsr_version`
--

CREATE TABLE IF NOT EXISTS `icsr_version` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icsr_id` int(11) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_url` varchar(255) DEFAULT NULL,
  `export_date` datetime DEFAULT NULL,
  `version_no` int(11) DEFAULT NULL,
  `exported_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-icsr_version-icsr_id` (`icsr_id`),
  KEY `fk_icsr_version_user` (`exported_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=110 ;

-- --------------------------------------------------------

--
-- Table structure for table `icsr_version_response`
--

CREATE TABLE IF NOT EXISTS `icsr_version_response` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icsr_version_id` int(11) NOT NULL,
  `response` varchar(255) DEFAULT NULL,
  `response_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-icsr_version_response-icsr_version_id` (`icsr_version_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lkp_age_unit`
--

CREATE TABLE IF NOT EXISTS `lkp_age_unit` (
  `id` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lkp_age_unit`
--

INSERT INTO `lkp_age_unit` (`id`, `name`) VALUES
(803, 'Day'),
(802, 'Month'),
(801, 'year');

-- --------------------------------------------------------

--
-- Table structure for table `lkp_city`
--

CREATE TABLE IF NOT EXISTS `lkp_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `lkp_city`
--

INSERT INTO `lkp_city` (`id`, `name`) VALUES
(1, 'Alexandria'),
(2, 'Cairo'),
(3, 'Sohag'),
(4, 'Mansoura'),
(5, 'Tanta'),
(6, 'Ismalia'),
(7, 'El Shrkya');

-- --------------------------------------------------------

--
-- Table structure for table `lkp_country`
--

CREATE TABLE IF NOT EXISTS `lkp_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `lkp_country`
--

INSERT INTO `lkp_country` (`id`, `name`, `code`) VALUES
(1, 'Egypt', 'EG'),
(2, 'US', 'us');

-- --------------------------------------------------------

--
-- Table structure for table `lkp_dose_unit`
--

CREATE TABLE IF NOT EXISTS `lkp_dose_unit` (
  `id` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lkp_drug_action`
--

CREATE TABLE IF NOT EXISTS `lkp_drug_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `lkp_drug_action`
--

INSERT INTO `lkp_drug_action` (`id`, `name`) VALUES
(1, 'Drug withdrawn'),
(2, 'Dose reduced'),
(3, 'Dose increased'),
(4, 'Dose not changed'),
(5, 'Unknown'),
(6, 'Not applicable');

-- --------------------------------------------------------

--
-- Table structure for table `lkp_drug_role`
--

CREATE TABLE IF NOT EXISTS `lkp_drug_role` (
  `id` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lkp_drug_role`
--

INSERT INTO `lkp_drug_role` (`id`, `name`) VALUES
(2, 'Concomitant'),
(3, 'Interacting'),
(1, 'Suspect');

-- --------------------------------------------------------

--
-- Table structure for table `lkp_frequency`
--

CREATE TABLE IF NOT EXISTS `lkp_frequency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL COMMENT 'QD\nBID\nTID\nQID\nQHS/bedtime\nPRN/as needed\nOther',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `lkp_frequency`
--

INSERT INTO `lkp_frequency` (`id`, `description`) VALUES
(1, 'QD'),
(2, 'BID'),
(3, 'TID'),
(4, 'QID'),
(5, 'QHS/bedtime'),
(6, 'PRN/as needed'),
(7, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `lkp_icsr_eventoutcome`
--

CREATE TABLE IF NOT EXISTS `lkp_icsr_eventoutcome` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `lkp_icsr_eventoutcome`
--

INSERT INTO `lkp_icsr_eventoutcome` (`id`, `name`) VALUES
(1, 'recovered/resolved'),
(2, 'recovering/resolving'),
(3, 'not recovered/not resolved'),
(4, 'recovered/resolved with sequelae'),
(5, 'fatal'),
(6, 'unknown3 ');

-- --------------------------------------------------------

--
-- Table structure for table `lkp_icsr_outcome`
--

CREATE TABLE IF NOT EXISTS `lkp_icsr_outcome` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(512) DEFAULT NULL COMMENT ' Death (include date) \n Life-Threatening \n Hospitalization (Initial or Prolonged) \n Disability or Permanent Damage\n Congenital Anomaly/Birth Defect \n Required Intervention to Prevent Permanent Impairment/Damage (Devices) \n Other Serious (Important Medical Events) ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `lkp_icsr_outcome`
--

INSERT INTO `lkp_icsr_outcome` (`id`, `description`) VALUES
(1, 'fatal'),
(2, 'Life-Threatening '),
(3, 'Hospitalization (Initial or Prolonged) '),
(4, 'Disability or Permanent Damage'),
(5, 'Congenital Anomaly/Birth Defect '),
(6, 'Required Intervention to Prevent Permanent Impairment/Damage (Devices) '),
(7, 'Other Serious (Important Medical Events) ');

-- --------------------------------------------------------

--
-- Table structure for table `lkp_icsr_type`
--

CREATE TABLE IF NOT EXISTS `lkp_icsr_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(128) DEFAULT NULL COMMENT 'Adverse Event\n Product Use Error\n Product Problem (Example: Defects/Malfunctions) \n Problem with Different Manufacturer of the Same Medicine',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `lkp_icsr_type`
--

INSERT INTO `lkp_icsr_type` (`id`, `description`) VALUES
(1, 'Spontaneous'),
(2, 'Report from study'),
(3, 'Other'),
(4, 'Not available to sender (unknown)');

-- --------------------------------------------------------

--
-- Table structure for table `lkp_limits`
--

CREATE TABLE IF NOT EXISTS `lkp_limits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `lkp_limits`
--

INSERT INTO `lkp_limits` (`id`, `name`) VALUES
(1, 'drug'),
(3, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `lkp_meddra_hlgt`
--

CREATE TABLE IF NOT EXISTS `lkp_meddra_hlgt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `lkp_meddra_hlgt`
--

INSERT INTO `lkp_meddra_hlgt` (`id`, `code`, `description`) VALUES
(1, 'Hlgt1', 'Hlgt1 Descrption'),
(2, 'Hlgt2', 'Hlgt Hlgt'),
(3, 'Hlgt3', 'Hlgt text');

-- --------------------------------------------------------

--
-- Table structure for table `lkp_meddra_llt`
--

CREATE TABLE IF NOT EXISTS `lkp_meddra_llt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `meddra_pt_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_meddra_llt_meddra_pt1_idx` (`meddra_pt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `lkp_meddra_llt`
--

INSERT INTO `lkp_meddra_llt` (`id`, `code`, `description`, `meddra_pt_id`) VALUES
(1, 'LkpMeddraLlt 11111', 'LkpMeddraLlt 11111', 1),
(2, 'LkpMeddraLlt 2222', 'LkpMeddraLlt 2222', 2);

-- --------------------------------------------------------

--
-- Table structure for table `lkp_meddra_pt`
--

CREATE TABLE IF NOT EXISTS `lkp_meddra_pt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `meddra_hlgt_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_meddra_pt_meddra_hlgt1_idx` (`meddra_hlgt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `lkp_meddra_pt`
--

INSERT INTO `lkp_meddra_pt` (`id`, `code`, `description`, `meddra_hlgt_id`) VALUES
(1, 'LkpMeddraPt1-1', 'LkpMeddraPt11', 1),
(2, 'LkpMeddraPt1-2', 'LkpMeddraPt1-2', 1),
(3, 'LkpMeddraPt2-1', 'LkpMeddraPt2-1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `lkp_occupation`
--

CREATE TABLE IF NOT EXISTS `lkp_occupation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL COMMENT 'Consumer or Non-Health Professional\nOther Health Professional\nLawyer\nMedical Doctor (Physician)\nPharmacists\nNurse\nSales Force',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `lkp_occupation`
--

INSERT INTO `lkp_occupation` (`id`, `description`) VALUES
(1, 'Consumer or Non-Health Professional'),
(2, 'Other Health Professional'),
(3, 'Lawyer'),
(4, 'Medical Doctor (Physician)'),
(5, 'Pharmacists'),
(6, 'Nurse');

-- --------------------------------------------------------

--
-- Table structure for table `lkp_plan`
--

CREATE TABLE IF NOT EXISTS `lkp_plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `lkp_plan`
--

INSERT INTO `lkp_plan` (`id`, `name`) VALUES
(1, 'gold'),
(2, 'silver'),
(3, 'platinum');

-- --------------------------------------------------------

--
-- Table structure for table `lkp_reaction_outcome`
--

CREATE TABLE IF NOT EXISTS `lkp_reaction_outcome` (
  `id` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lkp_reaction_outcome`
--

INSERT INTO `lkp_reaction_outcome` (`id`, `name`) VALUES
(1, 'recovered/resolved');

-- --------------------------------------------------------

--
-- Table structure for table `lkp_route`
--

CREATE TABLE IF NOT EXISTS `lkp_route` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL COMMENT 'Auricular (otic) \nEpidural   \nIntramuscular\nIntravenous\nOphthalmic\nOral\nRectal\nRespiratory\nSubcutaneous\nTopical\nTransdermal\nVaginal\nSublingual\nOther',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `lkp_route`
--

INSERT INTO `lkp_route` (`id`, `description`) VALUES
(1, 'Auricular (otic) '),
(2, 'Epidural   '),
(3, 'Intramuscular'),
(4, 'Intravenous'),
(5, 'Ophthalmic'),
(6, 'Oral'),
(7, 'Rectal'),
(8, 'Respiratory'),
(9, 'Subcutaneous'),
(10, 'Topical'),
(11, 'Transdermal'),
(12, 'Vaginal'),
(13, 'Sublingual'),
(14, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `lkp_test`
--

CREATE TABLE IF NOT EXISTS `lkp_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `lkp_test`
--

INSERT INTO `lkp_test` (`id`, `name`, `description`) VALUES
(1, 'blood presure', 'testing level '),
(2, 'blood toxcicity  ', 'blood toxcicity  '),
(3, 'hameoglobin test ', 'haemo');

-- --------------------------------------------------------

--
-- Table structure for table `lkp_time_unit`
--

CREATE TABLE IF NOT EXISTS `lkp_time_unit` (
  `id` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lkp_time_unit`
--

INSERT INTO `lkp_time_unit` (`id`, `name`) VALUES
(803, 'Day'),
(802, 'Month'),
(801, 'Year');

-- --------------------------------------------------------

--
-- Table structure for table `lkp_weight_unit`
--

CREATE TABLE IF NOT EXISTS `lkp_weight_unit` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lkp_weight_unit`
--

INSERT INTO `lkp_weight_unit` (`id`, `name`) VALUES
(1, 'Kg'),
(2, 'gram');

-- --------------------------------------------------------

--
-- Table structure for table `meddra_hlgt`
--

CREATE TABLE IF NOT EXISTS `meddra_hlgt` (
  `id` bigint(20) unsigned DEFAULT NULL,
  `term` varchar(100) NOT NULL,
  `who_art_code` varchar(7) DEFAULT NULL,
  `harts_code` bigint(20) DEFAULT NULL,
  `costart_sym` varchar(21) DEFAULT NULL,
  `icd9` varchar(8) DEFAULT NULL,
  `icd9_cm` varchar(8) DEFAULT NULL,
  `icd10` varchar(8) DEFAULT NULL,
  `jart_code` varchar(6) DEFAULT NULL,
  KEY `ix1_hlgt01` (`id`),
  KEY `ix1_hlgt02` (`term`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meddra_hlt`
--

CREATE TABLE IF NOT EXISTS `meddra_hlt` (
  `id` bigint(20) unsigned DEFAULT NULL,
  `term` varchar(100) NOT NULL,
  `who_art_code` varchar(7) DEFAULT NULL,
  `harts_code` bigint(20) DEFAULT NULL,
  `costart_sym` varchar(21) DEFAULT NULL,
  `icd9` varchar(8) DEFAULT NULL,
  `icd9_cm` varchar(8) DEFAULT NULL,
  `icd10` varchar(8) DEFAULT NULL,
  `jart_code` varchar(6) DEFAULT NULL,
  KEY `ix1_hlt01` (`id`),
  KEY `ix1_hlt02` (`term`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meddra_hlt_pt`
--

CREATE TABLE IF NOT EXISTS `meddra_hlt_pt` (
  `hlt_id` bigint(20) unsigned NOT NULL,
  `pt_id` bigint(20) unsigned NOT NULL,
  KEY `ix1_hlt_pt01` (`hlt_id`),
  KEY `ix1_hlt_pt02` (`pt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meddra_intl_ord`
--

CREATE TABLE IF NOT EXISTS `meddra_intl_ord` (
  `intl_ord_id` bigint(20) unsigned NOT NULL,
  `soc_id` bigint(20) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meddra_llt`
--

CREATE TABLE IF NOT EXISTS `meddra_llt` (
  `id` bigint(20) unsigned DEFAULT NULL,
  `term` varchar(100) NOT NULL,
  `pt_id` bigint(20) unsigned DEFAULT NULL,
  `who_art_code` varchar(7) DEFAULT NULL,
  `harts_code` bigint(20) unsigned DEFAULT NULL,
  `costart_sym` varchar(21) DEFAULT NULL,
  `icd9` varchar(8) DEFAULT NULL,
  `icd9_cm` varchar(8) DEFAULT NULL,
  `icd10` varchar(8) DEFAULT NULL,
  `currenct` varchar(1) DEFAULT NULL,
  `jart_code` varchar(6) DEFAULT NULL,
  KEY `ix1_pt_llt01` (`id`),
  KEY `ix1_pt_llt02` (`term`),
  KEY `ix1_pt_llt03` (`pt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meddra_mdhier`
--

CREATE TABLE IF NOT EXISTS `meddra_mdhier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pt_id` bigint(20) unsigned NOT NULL,
  `hlt_id` bigint(20) unsigned NOT NULL,
  `hlgt_id` bigint(20) unsigned NOT NULL,
  `soc_id` bigint(20) unsigned NOT NULL,
  `pt_term` varchar(100) NOT NULL,
  `hlt_term` varchar(100) NOT NULL,
  `hlgt_term` varchar(100) NOT NULL,
  `soc_term` varchar(100) NOT NULL,
  `soc_abbrev` varchar(5) NOT NULL,
  `null_field` varchar(1) DEFAULT NULL,
  `pt_soc_id` bigint(20) unsigned DEFAULT NULL,
  `primary_soc_fg` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix1_md_hier01` (`pt_id`),
  KEY `ix1_md_hier02` (`hlt_id`),
  KEY `ix1_md_hier03` (`hlgt_id`),
  KEY `ix1_md_hier04` (`soc_id`),
  KEY `ix1_md_hier05` (`pt_soc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `meddra_pt`
--

CREATE TABLE IF NOT EXISTS `meddra_pt` (
  `id` bigint(20) unsigned DEFAULT NULL,
  `term` varchar(100) NOT NULL,
  `null_field` varchar(1) DEFAULT NULL,
  `soc_id` bigint(20) unsigned DEFAULT NULL,
  `who_art_code` varchar(7) DEFAULT NULL,
  `harts_code` bigint(20) DEFAULT NULL,
  `costart_sym` varchar(21) DEFAULT NULL,
  `icd9` varchar(8) DEFAULT NULL,
  `icd9_cm` varchar(8) DEFAULT NULL,
  `icd10` varchar(8) DEFAULT NULL,
  `jart_code` varchar(6) DEFAULT NULL,
  KEY `ix1_pt_llt01` (`id`),
  KEY `ix1_pt_llt02` (`term`),
  KEY `ix1_pt_llt03` (`soc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meddra_smq_content`
--

CREATE TABLE IF NOT EXISTS `meddra_smq_content` (
  `smq_id` bigint(20) NOT NULL,
  `code` bigint(20) NOT NULL,
  `level` bigint(20) NOT NULL,
  `scope` bigint(20) NOT NULL,
  `category` varchar(1) NOT NULL,
  `weight` bigint(20) NOT NULL,
  `status` varchar(1) NOT NULL,
  `addition_ver` varchar(5) NOT NULL,
  `last_modified_ver` varchar(5) NOT NULL,
  KEY `ix1_smq_content01` (`smq_id`),
  KEY `ix1_smq_content02` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meddra_smq_list`
--

CREATE TABLE IF NOT EXISTS `meddra_smq_list` (
  `id` bigint(20) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `level` bigint(20) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `source` varchar(2000) DEFAULT NULL,
  `note` varchar(2000) DEFAULT NULL,
  `meddra_version` varchar(5) NOT NULL,
  `status` varchar(1) NOT NULL,
  `algorithm` varchar(1000) NOT NULL,
  KEY `ix1_smq_list01` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meddra_soc`
--

CREATE TABLE IF NOT EXISTS `meddra_soc` (
  `id` bigint(20) unsigned DEFAULT NULL,
  `term` varchar(100) NOT NULL,
  `abbrev` varchar(5) NOT NULL,
  `who_art_code` varchar(7) DEFAULT NULL,
  `harts_code` bigint(20) DEFAULT NULL,
  `costart_sym` varchar(21) DEFAULT NULL,
  `icd9` varchar(8) DEFAULT NULL,
  `icd9_cm` varchar(8) DEFAULT NULL,
  `icd10` varchar(8) DEFAULT NULL,
  `jart_code` varchar(6) DEFAULT NULL,
  KEY `ix1_soc01` (`id`),
  KEY `ix1_soc02` (`term`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meddra_soc_hlgt`
--

CREATE TABLE IF NOT EXISTS `meddra_soc_hlgt` (
  `soc_id` bigint(20) unsigned NOT NULL,
  `hlgt_id` bigint(20) unsigned NOT NULL,
  KEY `ix1_soc_hlgt01` (`soc_id`),
  KEY `ix1_soc_hlgt02` (`hlgt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `parent`, `route`, `order`, `data`) VALUES
(1, 'companies', NULL, '/crud/company/index', 1, NULL),
(2, 'users', NULL, '/crud/user/index', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m140506_102106_rbac_init', 1472340590),
('m150517_175717_audit_trail_entry_table', 1474139677),
('m150626_000001_create_audit_entry', 1474141404),
('m150626_000002_create_audit_data', 1474141404),
('m150626_000003_create_audit_error', 1474141406),
('m150626_000004_create_audit_trail', 1474141407),
('m150626_000005_create_audit_javascript', 1474141408),
('m150626_000006_create_audit_mail', 1474141409),
('m150714_000001_alter_audit_data', 1474141410),
('m160820_180144_drop_lkp_drug_action_table', 1471882689),
('m160820_180344_create_lkp_drug_action_table', 1471882689),
('m160820_180914_add_drug_action_column_to_drug_prescription', 1471882691),
('m160822_164941_create_lkp_icsr_eventoutcome_table', 1471885108),
('m160822_165209_add_lkp_icsr_eventoutcome_id_column_to_icsr_event_table', 1472057880),
('m160824_171832_drop_event_outcome_column_from_icsr_event', 1472059239),
('m160827_155437_create_role_table', 1472313309),
('m160827_155617_create_user_role_table', 1472313676),
('m160904_123949_add_subscribtion_end_date_column_to_company_table', 1472992807),
('m160904_124018_add_plan_column_to_company_table', 1472992838),
('m160906_134729_drop_reg_no_column_from_company_table', 1473169672),
('m160906_174946_create_lkp_city_table', 1473184346),
('m160906_175801_drop_reaction_country_id_column_from_icsr_table', 1473184924),
('m160906_180326_add_lkp_city_id_column_to_icsr_table', 1473186340),
('m160908_153940_drop_product_avilable_column_from_drug_prescription__table', 1473349363),
('m160908_160637_drop_test_lkp_id_column_from_icsr_test_table', 1473350911),
('m160908_161008_add_test_name_column_to_icsr_test_table', 1473351023),
('m160920_131924_create_lkp_plan_table', 1474377693),
('m160920_132227_create_lkp_limits_table', 1474377805),
('m160920_132706_create_plan_limits_table', 1474378478),
('m160920_134726_drop_plan_column_from_company_table', 1474379269),
('m160920_135103_add_plan_id_column_to_company_table', 1474379683),
('m160923_121121_drop_lkp_city_id_from_icsr_table', 1474632776),
('m160923_121355_add_reaction_country_id_to_icsr_table', 1474632967),
('m160928_202737_drop_and_add_foreign_key_plans_for_company_table', 1475094542),
('m161002_211232_create_icsr_versions_table', 1475443135),
('m161004_120407_add_addiitonal_columns_to_icsr_version_table', 1475582868),
('m161004_121853_add_foreign_key_to_icsr_version_table', 1475583931),
('m161008_183419_create_icsr_version_response_table', 1476089771),
('m161013_203024_create_psmf_company_table', 1476390677),
('m161013_203425_create_psmf_section_table', 1476390906),
('m161016_113734_add_file_url_column_to_psmf_company_table', 1476617863),
('m161017_070304_create_psmf_table', 1476688798),
('m161024_102937_create_icsr_narritive_table', 1477305104),
('m161024_135235_add_short_name_column_to_company_table', 1477317178),
('m161027_054246_create_meddra_llt_table', 1477552262),
('m161027_055834_create_meddra_pt_table', 1477552263),
('m161027_060204_create_meddra_hlt_table', 1477552264),
('m161027_060813_create_meddra_hlt_pt_table', 1477552264),
('m161027_061051_create_meddra_hlgt_table', 1477552265),
('m161027_062040_create_meddra_soc_table', 1477552266),
('m161027_062526_create_meddra_soc_hlgt_table', 1477552267),
('m161027_063701_create_mdhier_table', 1477552268),
('m161027_064512_create_meddra_intl_ord_table', 1477552268),
('m161027_065830_create_meddra_smq_list_table', 1477552269),
('m161027_070444_create_meddra_smq_content_table', 1477552269);

-- --------------------------------------------------------

--
-- Table structure for table `plan_limits`
--

CREATE TABLE IF NOT EXISTS `plan_limits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_id` int(11) NOT NULL,
  `limit_id` int(11) NOT NULL,
  `limit` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-lkp_plan_plan-limits` (`plan_id`),
  KEY `fk-lkp_limit_plan-limits` (`limit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `plan_limits`
--

INSERT INTO `plan_limits` (`id`, `plan_id`, `limit_id`, `limit`) VALUES
(1, 1, 1, 1000),
(2, 1, 3, 1000),
(3, 2, 1, 500),
(4, 2, 3, 500),
(5, 3, 1, 250),
(6, 3, 3, 250);

-- --------------------------------------------------------

--
-- Table structure for table `psmf`
--

CREATE TABLE IF NOT EXISTS `psmf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text,
  `version` int(11) DEFAULT NULL,
  `file_url` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-psmf-company_id` (`company_id`),
  KEY `idx-psmf-user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `psmf_company`
--

CREATE TABLE IF NOT EXISTS `psmf_company` (
  `psmf_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `version` int(11) DEFAULT NULL,
  `file_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`psmf_id`),
  KEY `idx-psmf_company-company_id` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `psmf_section`
--

CREATE TABLE IF NOT EXISTS `psmf_section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `psmf_id` int(11) NOT NULL,
  `section_name` varchar(255) DEFAULT NULL,
  `section_content` text,
  PRIMARY KEY (`id`),
  KEY `idx-psmf_section-psmf_id` (`psmf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `title`) VALUES
(1, 'admin\r\n'),
(2, 'moderator');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=50 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `company_id`) VALUES
(33, 'admin', 'nvz4RAj3LC6w3skuF3Rx82c7eHJzDOTC', '$2y$13$jka7LcHq42AeGtS5.S8A/.BiN.oikf5plY0HHXLjpzas0dkhHFpBC', 'GwOLDtMVLQVOolFP1cIanEtZ19gq66QE_1473062577', 'admin@yahoo.com', 10, 1473062577, 1474737782, 75);

-- --------------------------------------------------------

--
-- Table structure for table `user_company`
--

CREATE TABLE IF NOT EXISTS `user_company` (
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`company_id`,`user_id`),
  KEY `fk_company_has_user_user1_idx` (`user_id`),
  KEY `fk_company_has_user_company1_idx` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  KEY `fk-user_role-role_id` (`role_id`),
  KEY `fk-user_role-user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit_data`
--
ALTER TABLE `audit_data`
  ADD CONSTRAINT `fk_audit_data_entry_id` FOREIGN KEY (`entry_id`) REFERENCES `audit_entry` (`id`);

--
-- Constraints for table `audit_error`
--
ALTER TABLE `audit_error`
  ADD CONSTRAINT `fk_audit_error_entry_id` FOREIGN KEY (`entry_id`) REFERENCES `audit_entry` (`id`);

--
-- Constraints for table `audit_javascript`
--
ALTER TABLE `audit_javascript`
  ADD CONSTRAINT `fk_audit_javascript_entry_id` FOREIGN KEY (`entry_id`) REFERENCES `audit_entry` (`id`);

--
-- Constraints for table `audit_mail`
--
ALTER TABLE `audit_mail`
  ADD CONSTRAINT `fk_audit_mail_entry_id` FOREIGN KEY (`entry_id`) REFERENCES `audit_entry` (`id`);

--
-- Constraints for table `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD CONSTRAINT `fk_audit_trail_entry_id` FOREIGN KEY (`entry_id`) REFERENCES `audit_entry` (`id`);

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `fk-lkp_plan_company` FOREIGN KEY (`plan_id`) REFERENCES `lkp_plan` (`id`);

--
-- Constraints for table `drug`
--
ALTER TABLE `drug`
  ADD CONSTRAINT `fk_drug_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_drug_route_lkp1` FOREIGN KEY (`route_lkp_id`) REFERENCES `lkp_route` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `drug_prescription`
--
ALTER TABLE `drug_prescription`
  ADD CONSTRAINT `fk-drug-prescription-drug_action` FOREIGN KEY (`lkp_drug_action_id`) REFERENCES `lkp_drug_action` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_drug_details_drug1` FOREIGN KEY (`drug_id`) REFERENCES `drug` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_drug_details_icsr1` FOREIGN KEY (`icsr_id`) REFERENCES `icsr` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_drug_prescription_frequency_lkp1` FOREIGN KEY (`frequency_lkp_id`) REFERENCES `lkp_frequency` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `icsr`
--
ALTER TABLE `icsr`
  ADD CONSTRAINT `fk_icsr_country` FOREIGN KEY (`reaction_country_id`) REFERENCES `lkp_country` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_icsr_drug1` FOREIGN KEY (`drug_id`) REFERENCES `drug` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `icsr_concomitant_drugs`
--
ALTER TABLE `icsr_concomitant_drugs`
  ADD CONSTRAINT `fk_icsr_concomitant_drugs_frequency_lkp1` FOREIGN KEY (`frequency_lkp_id`) REFERENCES `lkp_frequency` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_icsr_concomitant_drugs_icsr1` FOREIGN KEY (`icsr_id`) REFERENCES `icsr` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `icsr_event`
--
ALTER TABLE `icsr_event`
  ADD CONSTRAINT `fk-icsr-event-lkp_icsr_eventoutcome_id` FOREIGN KEY (`lkp_icsr_eventoutcome_id`) REFERENCES `lkp_icsr_eventoutcome` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_icsr_event_icsr1` FOREIGN KEY (`icsr_id`) REFERENCES `icsr` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_icsr_event_meddra_llt1` FOREIGN KEY (`meddra_llt_id`) REFERENCES `lkp_meddra_llt` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_icsr_event_meddra_pt1` FOREIGN KEY (`meddra_pt_id`) REFERENCES `lkp_meddra_pt` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `icsr_narritive`
--
ALTER TABLE `icsr_narritive`
  ADD CONSTRAINT `fk-icsr_narritive-icsr_id` FOREIGN KEY (`icsr_id`) REFERENCES `icsr` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `icsr_outcome`
--
ALTER TABLE `icsr_outcome`
  ADD CONSTRAINT `fk_icsr_has_icsr_outcome_lkp_icsr1` FOREIGN KEY (`icsr_id`) REFERENCES `icsr` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_icsr_has_icsr_outcome_lkp_icsr_outcome_lkp1` FOREIGN KEY (`icsr_outcome_lkp_id`) REFERENCES `lkp_icsr_outcome` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `icsr_reporter`
--
ALTER TABLE `icsr_reporter`
  ADD CONSTRAINT `fk_icsr_reporter_country_lkp1` FOREIGN KEY (`country_lkp_id`) REFERENCES `lkp_country` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_icsr_reporter_icsr1` FOREIGN KEY (`icsr_id`) REFERENCES `icsr` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_icsr_reporter_occupation_lkp1` FOREIGN KEY (`occupation_lkp_id`) REFERENCES `lkp_occupation` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `icsr_test`
--
ALTER TABLE `icsr_test`
  ADD CONSTRAINT `fk_icsr_test_icsr1` FOREIGN KEY (`icsr_id`) REFERENCES `icsr` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `icsr_type`
--
ALTER TABLE `icsr_type`
  ADD CONSTRAINT `fk_icsr_has_icsr_type_lkp_icsr1` FOREIGN KEY (`icsr_id`) REFERENCES `icsr` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_icsr_has_icsr_type_lkp_icsr_type_lkp1` FOREIGN KEY (`icsr_type_lkp_id`) REFERENCES `lkp_icsr_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `icsr_version`
--
ALTER TABLE `icsr_version`
  ADD CONSTRAINT `fk-icsr_version-icsr_id` FOREIGN KEY (`icsr_id`) REFERENCES `icsr` (`id`),
  ADD CONSTRAINT `fk_icsr_version_user` FOREIGN KEY (`exported_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `icsr_version_response`
--
ALTER TABLE `icsr_version_response`
  ADD CONSTRAINT `fk-icsr_version_response-icsr_version_id` FOREIGN KEY (`icsr_version_id`) REFERENCES `icsr_version` (`id`);

--
-- Constraints for table `lkp_meddra_llt`
--
ALTER TABLE `lkp_meddra_llt`
  ADD CONSTRAINT `fk_meddra_llt_meddra_pt1` FOREIGN KEY (`meddra_pt_id`) REFERENCES `lkp_meddra_pt` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `lkp_meddra_pt`
--
ALTER TABLE `lkp_meddra_pt`
  ADD CONSTRAINT `fk_meddra_pt_meddra_hlgt1` FOREIGN KEY (`meddra_hlgt_id`) REFERENCES `lkp_meddra_hlgt` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `plan_limits`
--
ALTER TABLE `plan_limits`
  ADD CONSTRAINT `fk-lkp_limit_plan-limits` FOREIGN KEY (`limit_id`) REFERENCES `lkp_limits` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-lkp_plan_plan-limits` FOREIGN KEY (`plan_id`) REFERENCES `lkp_plan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `psmf`
--
ALTER TABLE `psmf`
  ADD CONSTRAINT `fk-psmf-company_id` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-psmf-user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `psmf_company`
--
ALTER TABLE `psmf_company`
  ADD CONSTRAINT `fk-psmf_company-company_id` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `psmf_section`
--
ALTER TABLE `psmf_section`
  ADD CONSTRAINT `fk-psmf_section-psmf_id` FOREIGN KEY (`psmf_id`) REFERENCES `psmf_company` (`psmf_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_company`
--
ALTER TABLE `user_company`
  ADD CONSTRAINT `fk_company_has_user_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_company_has_user_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `fk-user_role-role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-user_role-user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
