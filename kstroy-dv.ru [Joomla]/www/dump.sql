-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 05, 2014 at 06:27 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `virtuemart_theme538`
--

-- --------------------------------------------------------

--
-- Table structure for table `jos_assets`
--

DROP TABLE IF EXISTS `jos_assets`;
CREATE TABLE `jos_assets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set parent.',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `level` int(10) unsigned NOT NULL COMMENT 'The cached level in the nested tree.',
  `name` varchar(50) NOT NULL COMMENT 'The unique name for the asset.\n',
  `title` varchar(100) NOT NULL COMMENT 'The descriptive title for the asset.',
  `rules` varchar(5120) NOT NULL COMMENT 'JSON encoded access control.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_asset_name` (`name`),
  KEY `idx_lft_rgt` (`lft`,`rgt`),
  KEY `idx_parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=185 ;

--
-- Dumping data for table `jos_assets`
--

INSERT INTO `jos_assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES
(1, 0, 1, 436, 0, 'root.1', 'Root Asset', '{"core.login.site":{"6":1,"2":1},"core.login.admin":{"6":1},"core.login.offline":[],"core.admin":{"8":1},"core.manage":{"7":1},"core.create":{"6":1,"3":1},"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1},"core.edit.own":{"6":1,"3":1}}'),
(2, 1, 2, 3, 1, 'com_admin', 'com_admin', '{}'),
(3, 1, 4, 11, 1, 'com_banners', 'com_banners', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(4, 1, 12, 13, 1, 'com_cache', 'com_cache', '{"core.admin":{"7":1},"core.manage":{"7":1}}'),
(5, 1, 14, 15, 1, 'com_checkin', 'com_checkin', '{"core.admin":{"7":1},"core.manage":{"7":1}}'),
(6, 1, 16, 17, 1, 'com_config', 'com_config', '{}'),
(7, 1, 18, 87, 1, 'com_contact', 'com_contact', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(8, 1, 88, 307, 1, 'com_content', 'com_content', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(9, 1, 308, 309, 1, 'com_cpanel', 'com_cpanel', '{}'),
(10, 1, 310, 311, 1, 'com_installer', 'com_installer', '{"core.admin":[],"core.manage":{"7":0},"core.delete":{"7":0},"core.edit.state":{"7":0}}'),
(11, 1, 312, 313, 1, 'com_languages', 'com_languages', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(12, 1, 314, 315, 1, 'com_login', 'com_login', '{}'),
(13, 1, 316, 317, 1, 'com_mailto', 'com_mailto', '{}'),
(14, 1, 318, 319, 1, 'com_massmail', 'com_massmail', '{}'),
(15, 1, 320, 321, 1, 'com_media', 'com_media', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":{"5":1},"core.edit":[],"core.edit.state":[]}'),
(16, 1, 322, 323, 1, 'com_menus', 'com_menus', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(17, 1, 37, 38, 1, 'com_messages', 'com_messages', '{"core.admin":{"7":1},"core.manage":{"7":1}}'),
(18, 1, 326, 327, 1, 'com_modules', 'com_modules', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(19, 1, 328, 335, 1, 'com_newsfeeds', 'com_newsfeeds', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(20, 1, 336, 337, 1, 'com_plugins', 'com_plugins', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(21, 1, 338, 339, 1, 'com_redirect', 'com_redirect', '{"core.admin":{"7":1},"core.manage":[]}'),
(22, 1, 340, 341, 1, 'com_search', 'com_search', '{"core.admin":{"7":1},"core.manage":{"6":1}}'),
(23, 1, 342, 343, 1, 'com_templates', 'com_templates', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(24, 1, 344, 347, 1, 'com_users', 'com_users', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(25, 1, 348, 365, 1, 'com_weblinks', 'com_weblinks', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1,"10":0,"12":0},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1}}'),
(26, 1, 366, 367, 1, 'com_wrapper', 'com_wrapper', '{}'),
(33, 1, 428, 429, 1, 'com_finder', 'com_finder', '{"core.admin":{"7":1},"core.manage":{"6":1}}'),
(34, 8, 105, 116, 2, 'com_content.category.9', 'Uncategorised', '{"core.create":{"10":0,"12":0},"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(35, 3, 7, 8, 2, 'com_banners.category.10', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(36, 7, 23, 24, 2, 'com_contact.category.11', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(37, 19, 331, 332, 2, 'com_newsfeeds.category.12', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(38, 25, 355, 356, 2, 'com_weblinks.category.13', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(39, 8, 117, 306, 2, 'com_content.category.14', 'Sample Data-Articles', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(40, 3, 9, 10, 2, 'com_banners.category.15', 'Sample Data-Banners', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(41, 7, 25, 86, 2, 'com_contact.category.16', 'Sample Data-Contact', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(42, 19, 333, 334, 2, 'com_newsfeeds.category.17', 'Sample Data-Newsfeeds', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(43, 25, 357, 364, 2, 'com_weblinks.category.18', 'Sample Data-Weblinks', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(44, 39, 118, 255, 3, 'com_content.category.19', 'Joomla!', '{"core.create":{"10":0,"12":0},"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(45, 44, 119, 232, 4, 'com_content.category.20', 'Extensions', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(46, 45, 120, 135, 5, 'com_content.category.21', 'Components', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(47, 45, 136, 197, 5, 'com_content.category.22', 'Modules', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(48, 45, 198, 209, 5, 'com_content.category.23', 'Templates', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(49, 45, 210, 211, 5, 'com_content.category.24', 'Languages', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(50, 45, 212, 231, 5, 'com_content.category.25', 'Plugins', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(51, 39, 256, 287, 3, 'com_content.category.26', 'Park Site', '{"core.create":{"10":0,"12":0},"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(52, 51, 257, 262, 4, 'com_content.category.27', 'Park Blog', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(53, 51, 263, 284, 4, 'com_content.category.28', 'Photo Gallery', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(54, 39, 288, 301, 3, 'com_content.category.29', 'Fruit Shop Site', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(55, 54, 289, 294, 4, 'com_content.category.30', 'Growers', '{"core.create":{"12":0},"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":{"10":1}}'),
(56, 43, 358, 359, 3, 'com_weblinks.category.31', 'Park Links', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(57, 43, 360, 363, 3, 'com_weblinks.category.32', 'Joomla! Specific Links', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(58, 57, 361, 362, 4, 'com_weblinks.category.33', 'Other Resources', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(59, 41, 26, 27, 3, 'com_contact.category.34', 'Park Site', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(60, 41, 28, 85, 3, 'com_contact.category.35', 'Shop Site', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(61, 60, 29, 30, 4, 'com_contact.category.36', 'Staff', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(62, 60, 31, 84, 4, 'com_contact.category.37', 'Fruit Encyclopedia', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(63, 62, 32, 33, 5, 'com_contact.category.38', 'A', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(64, 62, 34, 35, 5, 'com_contact.category.39', 'B', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(65, 62, 36, 37, 5, 'com_contact.category.40', 'C', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(66, 62, 38, 39, 5, 'com_contact.category.41', 'D', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(67, 62, 40, 41, 5, 'com_contact.category.42', 'E', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(68, 62, 42, 43, 5, 'com_contact.category.43', 'F', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(69, 62, 44, 45, 5, 'com_contact.category.44', 'G', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(70, 62, 46, 47, 5, 'com_contact.category.45', 'H', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(71, 62, 48, 49, 5, 'com_contact.category.46', 'I', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(72, 62, 50, 51, 5, 'com_contact.category.47', 'J', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(73, 62, 52, 53, 5, 'com_contact.category.48', 'K', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(74, 62, 54, 55, 5, 'com_contact.category.49', 'L', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(75, 62, 56, 57, 5, 'com_contact.category.50', 'M', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(76, 62, 58, 59, 5, 'com_contact.category.51', 'N', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(77, 62, 60, 61, 5, 'com_contact.category.52', 'O', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(78, 62, 62, 63, 5, 'com_contact.category.53', 'P', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(79, 62, 64, 65, 5, 'com_contact.category.54', 'Q', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(80, 62, 66, 67, 5, 'com_contact.category.55', 'R', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(81, 62, 68, 69, 5, 'com_contact.category.56', 'S', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(82, 62, 70, 71, 5, 'com_contact.category.57', 'T', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(83, 62, 72, 73, 5, 'com_contact.category.58', 'U', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(84, 62, 74, 75, 5, 'com_contact.category.59', 'V', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(85, 62, 76, 77, 5, 'com_contact.category.60', 'W', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(86, 62, 78, 79, 5, 'com_contact.category.61', 'X', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(87, 62, 80, 81, 5, 'com_contact.category.62', 'Y', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(88, 62, 82, 83, 5, 'com_contact.category.63', 'Z', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(89, 46, 121, 122, 6, 'com_content.article.1', 'Administrator Components', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(90, 93, 138, 139, 7, 'com_content.article.2', 'Archive Module', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(91, 93, 140, 141, 7, 'com_content.article.3', 'Article Categories Module', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(92, 93, 142, 143, 7, 'com_content.article.4', 'Articles Category Module', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(93, 47, 137, 152, 6, 'com_content.category.64', 'Content Modules', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(94, 47, 153, 160, 6, 'com_content.category.65', 'User Modules', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(95, 47, 161, 174, 6, 'com_content.category.66', 'Display Modules', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(96, 47, 175, 188, 6, 'com_content.category.67', 'Utility Modules', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(97, 48, 199, 200, 6, 'com_content.category.68', 'Atomic', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(98, 48, 201, 202, 6, 'com_content.category.69', 'Beez 20', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(99, 48, 203, 204, 6, 'com_content.category.70', 'Beez5', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(100, 48, 205, 206, 6, 'com_content.category.71', 'Milky Way', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(101, 50, 213, 214, 6, 'com_content.article.5', 'Authentication', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(102, 51, 285, 286, 4, 'com_content.article.6', 'Australian Parks ', '{"core.delete":[],"core.edit":{"2":1},"core.edit.state":[]}'),
(103, 95, 162, 163, 7, 'com_content.article.7', 'Banner Module', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(104, 44, 233, 234, 4, 'com_content.article.8', 'Beginners', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(105, 46, 123, 124, 6, 'com_content.article.9', 'Contact', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(106, 46, 125, 126, 6, 'com_content.article.10', 'Content', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(107, 109, 275, 276, 6, 'com_content.article.11', 'Cradle Mountain', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(108, 53, 264, 273, 5, 'com_content.category.72', 'Animals', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(109, 53, 274, 283, 5, 'com_content.category.73', 'Scenery', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(110, 95, 164, 165, 7, 'com_content.article.12', 'Custom HTML Module', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(111, 54, 295, 296, 4, 'com_content.article.13', 'Directions', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(112, 50, 215, 216, 6, 'com_content.article.14', 'Editors', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(113, 50, 217, 218, 6, 'com_content.article.15', 'Editors-xtd', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(114, 95, 166, 167, 7, 'com_content.article.16', 'Feed Display', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(115, 52, 258, 259, 5, 'com_content.article.17', 'First Blog Post', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(116, 52, 260, 261, 5, 'com_content.article.18', 'Second Blog Post', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(117, 95, 168, 169, 7, 'com_content.article.19', 'Footer Module', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(118, 54, 297, 298, 4, 'com_content.article.20', 'Fruit Shop', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(119, 44, 235, 236, 4, 'com_content.article.21', 'Getting Help', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(120, 44, 237, 238, 4, 'com_content.article.22', 'Getting Started', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(121, 55, 290, 291, 5, 'com_content.article.23', 'Happy Orange Orchard', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(122, 44, 239, 240, 4, 'com_content.article.24', 'Joomla!', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(123, 108, 265, 266, 6, 'com_content.article.25', 'Koala', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(124, 96, 176, 177, 7, 'com_content.article.26', 'Language Switcher', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(125, 93, 144, 145, 7, 'com_content.article.27', 'Latest Articles Module', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(126, 94, 154, 155, 7, 'com_content.article.28', 'Login Module', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(127, 166, 192, 193, 7, 'com_content.article.29', 'Menu Module', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(128, 93, 146, 147, 7, 'com_content.article.30', 'Most Read Content', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(129, 93, 148, 149, 7, 'com_content.article.31', 'News Flash', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(130, 44, 241, 242, 4, 'com_content.article.32', 'Parameters', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(131, 108, 267, 268, 6, 'com_content.article.33', 'Phyllopteryx', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(132, 109, 277, 278, 6, 'com_content.article.34', 'Pinnacles', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(133, 44, 243, 244, 4, 'com_content.article.35', 'Professionals', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(134, 95, 170, 171, 7, 'com_content.article.36', 'Random Image Module', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(135, 93, 150, 151, 7, 'com_content.article.37', 'Related Items Module', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(136, 44, 245, 246, 4, 'com_content.article.38', 'Sample Sites', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(137, 46, 127, 128, 6, 'com_content.article.39', 'Search', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(138, 96, 178, 179, 7, 'com_content.article.40', 'Search Module', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(139, 50, 219, 220, 6, 'com_content.article.41', 'Search ', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(140, 39, 302, 303, 3, 'com_content.article.42', 'Site Map', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(141, 108, 269, 270, 6, 'com_content.article.43', 'Spotted Quoll', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(142, 96, 180, 181, 7, 'com_content.article.44', 'Statistics Module', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(143, 96, 182, 183, 7, 'com_content.article.45', 'Syndicate Module', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(144, 50, 221, 222, 6, 'com_content.article.46', 'System', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(145, 44, 247, 248, 4, 'com_content.article.47', 'The Joomla! Community', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(146, 44, 249, 250, 4, 'com_content.article.48', 'The Joomla! Project', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(147, 48, 207, 208, 6, 'com_content.article.49', 'Typography', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(148, 44, 251, 252, 4, 'com_content.article.50', 'Upgraders', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(149, 50, 223, 224, 6, 'com_content.article.51', 'User', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(150, 46, 129, 130, 6, 'com_content.article.52', 'Users', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(151, 44, 253, 254, 4, 'com_content.article.53', 'Using Joomla!', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(152, 46, 131, 132, 6, 'com_content.article.54', 'Weblinks', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(153, 95, 172, 173, 7, 'com_content.article.55', 'Weblinks Module', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(154, 94, 156, 157, 7, 'com_content.article.56', 'Who''s Online', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(155, 108, 271, 272, 6, 'com_content.article.57', 'Wobbegone', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(156, 55, 292, 293, 5, 'com_content.article.58', 'Wonderful Watermelon', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(157, 96, 184, 185, 7, 'com_content.article.59', 'Wrapper Module', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(158, 46, 133, 134, 6, 'com_content.article.60', 'News Feeds', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(159, 166, 194, 195, 7, 'com_content.article.61', 'Breadcrumbs Module', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(160, 50, 225, 226, 6, 'com_content.article.62', 'Content', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(162, 109, 279, 280, 6, 'com_content.article.64', 'Blue Mountain Rain Forest', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(163, 109, 281, 282, 6, 'com_content.article.65', 'Ormiston Pound', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(165, 94, 158, 159, 7, 'com_content.article.66', 'Latest Users Module', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(166, 47, 191, 196, 6, 'com_content.category.75', 'Navigation Modules', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(167, 54, 299, 300, 4, 'com_content.category.76', 'Recipes', '{"core.create":{"12":1,"10":1},"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":{"12":1,"10":1}}'),
(168, 34, 106, 107, 3, 'com_content.article.67', 'What''s New in 1.5?', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(169, 24, 345, 346, 2, 'com_users.notes.category.77', 'Uncategorised', ''),
(170, 50, 227, 228, 6, 'com_content.article.68', 'Captcha', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(171, 50, 229, 230, 6, 'com_content.article.69', 'Quick Icons', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(172, 96, 186, 187, 7, 'com_content.article.70', 'Smart Search', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(173, 1, 430, 431, 1, 'com_joomlaupdate', 'com_joomlaupdate', '{"core.admin":[],"core.manage":[],"core.delete":[],"core.edit.state":[]}'),
(176, 34, 108, 109, 3, 'com_content.article.71', 'About Us', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(177, 34, 110, 111, 3, 'com_content.article.72', 'Delivery', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(178, 34, 112, 113, 3, 'com_content.article.73', 'FAQS', '{"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(182, 34, 114, 115, 3, 'com_content.article.74', 'Template Settings', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(183, 1, 432, 433, 1, 'com_virtuemart', 'virtuemart', '{}'),
(184, 1, 434, 435, 1, 'com_virtuemart_allinone', 'virtuemart_allinone', '{}');

-- --------------------------------------------------------

--
-- Table structure for table `jos_associations`
--

DROP TABLE IF EXISTS `jos_associations`;
CREATE TABLE `jos_associations` (
  `id` varchar(50) NOT NULL COMMENT 'A reference to the associated item.',
  `context` varchar(50) NOT NULL COMMENT 'The context of the associated item.',
  `key` char(32) NOT NULL COMMENT 'The key for the association computed from an md5 on associated ids.',
  PRIMARY KEY (`context`,`id`),
  KEY `idx_key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jos_banners`
--

DROP TABLE IF EXISTS `jos_banners`;
CREATE TABLE `jos_banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `imptotal` int(11) NOT NULL DEFAULT '0',
  `impmade` int(11) NOT NULL DEFAULT '0',
  `clicks` int(11) NOT NULL DEFAULT '0',
  `clickurl` varchar(200) NOT NULL DEFAULT '',
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `custombannercode` varchar(2048) NOT NULL,
  `sticky` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `params` text NOT NULL,
  `own_prefix` tinyint(1) NOT NULL DEFAULT '0',
  `metakey_prefix` varchar(255) NOT NULL DEFAULT '',
  `purchase_type` tinyint(4) NOT NULL DEFAULT '-1',
  `track_clicks` tinyint(4) NOT NULL DEFAULT '-1',
  `track_impressions` tinyint(4) NOT NULL DEFAULT '-1',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reset` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `language` char(7) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_state` (`state`),
  KEY `idx_own_prefix` (`own_prefix`),
  KEY `idx_metakey_prefix` (`metakey_prefix`),
  KEY `idx_banner_catid` (`catid`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `jos_banners`
--

INSERT INTO `jos_banners` (`id`, `cid`, `type`, `name`, `alias`, `imptotal`, `impmade`, `clicks`, `clickurl`, `state`, `catid`, `description`, `custombannercode`, `sticky`, `ordering`, `metakey`, `params`, `own_prefix`, `metakey_prefix`, `purchase_type`, `track_clicks`, `track_impressions`, `checked_out`, `checked_out_time`, `publish_up`, `publish_down`, `reset`, `created`, `language`) VALUES
(2, 0, 0, 'Shop 1', 'shop-1', 0, 108, 0, 'http://www.demolink.org/', 1, 15, '', '<span class="title">Bacardi</span>\r\n<span class="desc">Lorem ipsum dolor sit amet conse ctetur adipisicing elit</span> ', 1, 1, '', '{"imageurl":"images\\/banners\\/banner1.jpg","width":241,"height":144,"alt":""}', 0, '', -1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2011-01-01 00:00:01', 'en-GB'),
(5, 0, 0, 'Shop 2', 'shop-2', 0, 107, 1, 'http://www.demolink.org/', 1, 15, '', '<span class="title">Glenfiddich</span>\r\n<span class="desc">Lorem ipsum dolor sit amet conse ctetur adipisicing elit </span> ', 1, 2, '', '{"imageurl":"images\\/banners\\/banner2.jpg","width":241,"height":144,"alt":""}', 0, '', -1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2011-01-01 00:00:01', 'en-GB'),
(6, 0, 0, 'Shop 3', 'shop-3', 0, 107, 0, 'http://www.demolink.org/', 1, 15, '', '<span class="title">jack daniels</span>\r\n<span class="desc">Lorem ipsum dolor sit amet conse ctetur adipisicing elit </span> ', 1, 3, '', '{"imageurl":"images\\/banners\\/banner3.jpg","width":241,"height":144,"alt":""}', 0, '', -1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2011-01-01 00:00:01', 'en-GB'),
(7, 0, 0, 'Shop 4', 'shop-4', 0, 75, 0, 'http://www.demolink.org/', 1, 15, '', '<span class="title">Chivas Regal</span>\r\n<span class="desc">Lorem ipsum dolor sit amet conse ctetur adipisicing elit </span> ', 1, 4, '', '{"imageurl":"images\\/banners\\/banner4.jpg","width":241,"height":144,"alt":""}', 0, '', -1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2011-01-01 00:00:01', 'en-GB'),
(8, 0, 0, 'Shop 5', 'shop-5', 0, 252, 0, 'http://www.demolink.org/', 1, 10, '', '', 1, 5, '', '{"imageurl":"images\\/banners\\/banner5.jpg","width":328,"height":74,"alt":""}', 0, '', -1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2011-01-01 00:00:01', 'en-GB'),
(9, 0, 0, 'Shop 6', 'shop-6', 0, 252, 0, 'http://www.demolink.org/', 1, 10, '', '', 1, 6, '', '{"imageurl":"images\\/banners\\/banner6.jpg","width":328,"height":74,"alt":""}', 0, '', -1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2011-01-01 00:00:01', 'en-GB'),
(10, 0, 0, 'Shop 7', 'shop-7', 0, 220, 0, 'http://www.demolink.org/', 1, 10, '', '', 1, 7, '', '{"imageurl":"images\\/banners\\/banner7.jpg","width":328,"height":74,"alt":""}', 0, '', -1, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2011-01-01 00:00:01', 'en-GB');

-- --------------------------------------------------------

--
-- Table structure for table `jos_banner_clients`
--

DROP TABLE IF EXISTS `jos_banner_clients`;
CREATE TABLE `jos_banner_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `contact` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `extrainfo` text NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `metakey` text NOT NULL,
  `own_prefix` tinyint(4) NOT NULL DEFAULT '0',
  `metakey_prefix` varchar(255) NOT NULL DEFAULT '',
  `purchase_type` tinyint(4) NOT NULL DEFAULT '-1',
  `track_clicks` tinyint(4) NOT NULL DEFAULT '-1',
  `track_impressions` tinyint(4) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`),
  KEY `idx_own_prefix` (`own_prefix`),
  KEY `idx_metakey_prefix` (`metakey_prefix`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `jos_banner_clients`
--

INSERT INTO `jos_banner_clients` (`id`, `name`, `contact`, `email`, `extrainfo`, `state`, `checked_out`, `checked_out_time`, `metakey`, `own_prefix`, `metakey_prefix`, `purchase_type`, `track_clicks`, `track_impressions`) VALUES
(1, 'Joomla!', 'Administrator', 'email@email.com', '', 1, 0, '0000-00-00 00:00:00', '', 0, '', -1, -1, -1),
(2, 'Shop', 'Example', 'example@example.com', '', 1, 0, '0000-00-00 00:00:00', '', 0, '', -1, 0, 0),
(3, 'Bookstore', 'Bookstore Example', 'example@example.com', '', 1, 0, '0000-00-00 00:00:00', '', 0, '', -1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_banner_tracks`
--

DROP TABLE IF EXISTS `jos_banner_tracks`;
CREATE TABLE `jos_banner_tracks` (
  `track_date` datetime NOT NULL,
  `track_type` int(10) unsigned NOT NULL,
  `banner_id` int(10) unsigned NOT NULL,
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`track_date`,`track_type`,`banner_id`),
  KEY `idx_track_date` (`track_date`),
  KEY `idx_track_type` (`track_type`),
  KEY `idx_banner_id` (`banner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jos_categories`
--

DROP TABLE IF EXISTS `jos_categories`;
CREATE TABLE `jos_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to the #__assets table.',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `lft` int(11) NOT NULL DEFAULT '0',
  `rgt` int(11) NOT NULL DEFAULT '0',
  `level` int(10) unsigned NOT NULL DEFAULT '0',
  `path` varchar(255) NOT NULL DEFAULT '',
  `extension` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `note` varchar(255) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `metadesc` varchar(1024) NOT NULL COMMENT 'The meta description for the page.',
  `metakey` varchar(1024) NOT NULL COMMENT 'The meta keywords for the page.',
  `metadata` varchar(2048) NOT NULL COMMENT 'JSON encoded metadata properties.',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_idx` (`extension`,`published`,`access`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_path` (`path`),
  KEY `idx_left_right` (`lft`,`rgt`),
  KEY `idx_alias` (`alias`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=78 ;

--
-- Dumping data for table `jos_categories`
--

INSERT INTO `jos_categories` (`id`, `asset_id`, `parent_id`, `lft`, `rgt`, `level`, `path`, `extension`, `title`, `alias`, `note`, `description`, `published`, `checked_out`, `checked_out_time`, `access`, `params`, `metadesc`, `metakey`, `metadata`, `created_user_id`, `created_time`, `modified_user_id`, `modified_time`, `hits`, `language`) VALUES
(0, 67, 37, 78, 79, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/e', 'com_contact', 'E', 'e', '', '', 0, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(1, 0, 0, 0, 135, 0, '', 'system', 'ROOT', 'root', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{}', '', '', '', 212, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(9, 34, 1, 131, 132, 1, 'uncategorised', 'com_content', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(10, 35, 1, 129, 130, 1, 'uncategorised', 'com_banners', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":"","foobar":""}', '', '', '{"page_title":"","author":"","robots":""}', 212, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(11, 36, 1, 125, 126, 1, 'uncategorised', 'com_contact', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(12, 37, 1, 61, 62, 1, 'uncategorised', 'com_newsfeeds', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(13, 38, 1, 57, 58, 1, 'uncategorised', 'com_weblinks', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(14, 39, 1, 9, 56, 1, 'sample-data-articles', 'com_content', 'Sample Data-Articles', 'sample-data-articles', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(15, 40, 1, 127, 128, 1, 'sample-data-banners', 'com_banners', 'Sample Data-Banners', 'sample-data-banners', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":"","foobar":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(16, 41, 1, 63, 124, 1, 'sample-data-contact', 'com_contact', 'Sample Data-Contact', 'sample-data-contact', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(17, 42, 1, 59, 60, 1, 'sample-data-newsfeeds', 'com_newsfeeds', 'Sample Data-Newsfeeds', 'sample-data-newsfeeds', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(18, 43, 1, 1, 8, 1, 'sample-data-weblinks', 'com_weblinks', 'Sample Data-Weblinks', 'sample-data-weblinks', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(19, 44, 14, 10, 39, 2, 'sample-data-articles/joomla', 'com_content', 'Joomla!', 'joomla', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(20, 45, 19, 11, 38, 3, 'sample-data-articles/joomla/extensions', 'com_content', 'Extensions', 'extensions', '', '<p>The Joomla! content management system lets you create webpages of various types using extensions. There are 5 basic types of extensions: components, modules, templates, languages, and plugins. Your website includes the extensions you need to create a basic website in English, but thousands of additional extensions of all types are available. The <a href="http://extensions.joomla.org" style="color: #1b57b1; text-decoration: none; font-weight: normal;">Joomla! Extensions Directory</a> is the largest directory of Joomla extensions.</p>', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-12-27 11:57:22', 0, '*'),
(21, 46, 20, 12, 13, 4, 'sample-data-articles/joomla/extensions/components', 'com_content', 'Components', 'components', '', '<p><img class="image-left" src="administrator/templates/bluestork/images/header/icon-48-component.png" border="0" alt="Component Image" />Components are larger extensions that produce the major content for your site. Each component has one or more "views" that control how content is displayed. In the Joomla administrator there are additional extensions such as Menus, Redirection, and the extension managers.</p>', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-12-27 11:58:12', 0, '*'),
(22, 47, 20, 14, 25, 4, 'sample-data-articles/joomla/extensions/modules', 'com_content', 'Modules', 'modules', '', '<p><img class="image-left" src="administrator/templates/bluestork/images/header/icon-48-module.png" border="0" alt="Media Image" />Modules are small blocks of content that can be displayed in positions on a web page. The menus on this site are displayed in modules. The core of Joomla! includes 24 separate modules ranging from login to search to random images. Each module has a name that starts mod_ but when it displays it has a title. In the descriptions in this section, the titles are the same as the names.</p>', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-12-27 11:59:44', 0, '*'),
(23, 48, 20, 26, 33, 4, 'sample-data-articles/joomla/extensions/templates', 'com_content', 'Templates', 'templates', '', '<p><img src="administrator/templates/bluestork/images/header/icon-48-themes.png" border="0" alt="Media Image" align="left" />Templates give your site its look and feel. They determine layout, colours, typefaces, graphics and other aspects of design that make your site unique. Your installation of Joomla comes prepackaged with three front end templates and two backend templates. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Extensions_Template_Manager_Templates">Help</a></p>', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-12-27 12:04:51', 0, '*'),
(24, 49, 20, 34, 35, 4, 'sample-data-articles/joomla/extensions/languages', 'com_content', 'Languages', 'languages', '', '<p><img src="administrator/templates/bluestork/images/header/icon-48-language.png" border="0" alt="Languages Image" align="left" />Joomla! installs in English, but translations of the interfaces, sample data and help screens are available in dozens of languages. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Extensions_Language_Manager_Installed">Help</a></p>\r\n<p><a href="http://community.joomla.org/translations.html">Translation information</a></p>\r\n<p>If there is no language pack available for your language, instructions are available for creating your own translation, which you can also contribute to the community by starting a translation team to create an accredited translation. </p>\r\n<p>Translations of the interfaces are installed using the extensions manager in the site administrator and then managed using the language manager.</p>\r\n<p>If you have two or more languages installed you may enable the language switcher plugin and module. They should always be used together. If you create multilingual content and mark your content, menu items or modules as being in specific languages and follow <a href="http://docs.joomla.org/Language_Switcher_Tutorial_for_Joomla_1.6">the complete instructions</a> your users will be able to select a specific content language using the module. By default both the plugin and module are disabled.</p>\r\n<p>Joomla 2.5 installs with a language override manager that allows you to change the specific words (such as Edit or Search) used in the Joomla application.</p>\r\n<p>There are a number of extensions that can help you manage translations of content available in the<a href="http://extensions.joomla.org"> Joomla! Extensions Directory</a>.</p>', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2012-01-17 16:18:40', 0, '*'),
(25, 50, 20, 36, 37, 4, 'sample-data-articles/joomla/extensions/plugins', 'com_content', 'Plugins', 'plugins', '', '<p><img src="administrator/templates/bluestork/images/header/icon-48-plugin.png" border="0" alt="Plugin Image" align="left" />Plugins are small task oriented extensions that enhance the Joomla! framework. Some are associated with particular extensions and others, such as editors, are used across all of Joomla. Most beginning users do not need to change any of the plugins that install with Joomla. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Extensions_Plugin_Manager_Edit">Help</a></p>', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-12-27 12:11:56', 0, '*'),
(26, 51, 14, 40, 49, 2, 'sample-data-articles/park-site', 'com_content', 'Park Site', 'park-site', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, 'en-GB'),
(27, 52, 26, 41, 42, 3, 'sample-data-articles/park-site/park-blog', 'com_content', 'Park Blog', 'park-blog', '', '<p><span style="font-size: 12px;">Here is where I will blog all about the parks of Australia.</span></p>\r\n<p><em>You can make a blog on your website by creating a category to write your blog posts in (this one is called Park Blog). Each blog post will be an article in that category. If you make a category blog menu link with 1 column it will look like this page, if you display the category description then this part is displayed. </em></p>\r\n<p><em>To enhance your blog you may want to add extensions for <a href="http://extensions.joomla.org/extensions/contacts-and-feedback/articles-comments" style="color: #1b57b1; text-decoration: none; font-weight: normal;">comments</a>,<a href="http://extensions.joomla.org/extensions/social-web" style="color: #1b57b1; text-decoration: none; font-weight: normal;"> interacting with social network sites</a>, <a href="http://extensions.joomla.org/extensions/content-sharing" style="color: #1b57b1; text-decoration: none; font-weight: normal;">tagging</a>, and <a href="http://extensions.joomla.org/extensions/content-sharing" style="color: #1b57b1; text-decoration: none; font-weight: normal;">keeping in contact with your readers</a>. You can also enable the syndication that is included in Joomla (in the Integration Options set Show Feed Link to Show and make sure to display the syndication module on the page).</em></p>', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":"images\\/sampledata\\/parks\\/banner_cradle.jpg"}', '', '', '{"author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-12-27 12:15:40', 0, 'en-GB'),
(28, 53, 26, 43, 48, 3, 'sample-data-articles/park-site/photo-gallery', 'com_content', 'Photo Gallery', 'photo-gallery', '', '<p><img src="images/sampledata/parks/banner_cradle.jpg" border="0" /></p>\r\n<p>These are my photos from parks I have visited (I didn''t take them, they are all from <a href="http://commons.wikimedia.org/wiki/Main_Page">Wikimedia Commons</a>).</p>\r\n<p><em>This shows you how to make a simple image gallery using articles in com_content. </em></p>\r\n<p><em>In each article put a thumbnail image before a "readmore" and the full size image after it. Set the article to Show Intro Text: Hide. </em></p>', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, 'en-GB'),
(29, 54, 14, 50, 55, 2, 'sample-data-articles/fruit-shop-site', 'com_content', 'Fruit Shop Site', 'fruit-shop-site', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(30, 55, 29, 51, 52, 3, 'sample-data-articles/fruit-shop-site/growers', 'com_content', 'Growers', 'growers', '', '<p>We search the whole countryside for the best fruit growers.</p>\r\n<p><em>You can let each supplier have a page that he or she can edit. To see this in action you will need to create a user who is in the suppliers group.  </em></p>\r\n<p><em>Create one page in the growers category for that user and make that supplier the author of the page. That user will be able to edit his or her page. </em></p>\r\n<p><em>This illustrates the use of the Edit Own permission. </em></p>', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-12-27 12:17:40', 0, '*'),
(31, 56, 18, 2, 3, 2, 'sample-data-weblinks/park-links', 'com_weblinks', 'Park Links', 'park-links', '', '<p>Here are links to some of my favorite parks.</p>\r\n<p><em>The weblinks component provides an easy way to make links to external sites that are consistently formatted and categorised. You can create weblinks from the front end of your site.</em></p>', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":"images\\/sampledata\\/parks\\/banner_cradle.jpg"}', '', '', '{"author":"","robots":""}', 212, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, 'en-GB'),
(32, 57, 18, 4, 7, 2, 'sample-data-weblinks/joomla-specific-links', 'com_weblinks', 'Joomla! Specific Links', 'joomla-specific-links', '', '<p>A selection of links that are all related to the Joomla Project.</p>', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 212, '2011-01-01 00:00:01', 0, '2011-12-27 12:32:00', 0, '*'),
(33, 58, 32, 5, 6, 3, 'sample-data-weblinks/joomla-specific-links/other-resources', 'com_weblinks', 'Other Resources', 'other-resources', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(34, 59, 16, 64, 65, 2, 'sample-data-contact/park-site', 'com_contact', 'Park Site', 'park-site', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, 'en-GB'),
(35, 60, 16, 66, 123, 2, 'sample-data-contact/shop-site', 'com_contact', 'Shop Site', 'shop-site', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(36, 61, 35, 67, 68, 3, 'sample-data-contact/shop-site/staff', 'com_contact', 'Staff', 'staff', '', '<p>Please feel free to contact our staff at any time should you need assistance.</p>', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(37, 62, 35, 69, 122, 3, 'sample-data-contact/shop-site/fruit-encyclopedia', 'com_contact', 'Fruit Encyclopedia', 'fruit-encyclopedia', '', '<p> </p><p>Our directory of information about different kinds of fruit.</p><p>We love fruit and want the world to know more about all of its many varieties.</p><p>Although it is small now, we work on it whenever we have a chance.</p><p>All of the images can be found in <a href="http://commons.wikimedia.org/wiki/Main_Page">Wikimedia Commons</a>.</p><p><img src="images/sampledata/fruitshop/apple.jpg" border="0" alt="Apples" title="Apples" /></p><p><em>This encyclopedia is implemented using the contact component, each fruit a separate contact and a category for each letter. A CSS style is used to create the horizontal layout of the alphabet headings. </em></p><p><em>If you wanted to, you could allow some users (such as your growers) to have access to just this category in the contact component and let them help you to create new content for the encyclopedia.</em></p><p> </p>', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(38, 63, 37, 70, 71, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/a', 'com_contact', 'A', 'a', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(39, 64, 37, 72, 73, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/b', 'com_contact', 'B', 'b', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(40, 65, 37, 74, 75, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/c', 'com_contact', 'C', 'c', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(41, 66, 37, 76, 77, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/d', 'com_contact', 'D', 'd', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(43, 68, 37, 80, 81, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/f', 'com_contact', 'F', 'f', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(44, 69, 37, 82, 83, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/g', 'com_contact', 'G', 'g', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(45, 70, 37, 84, 85, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/h', 'com_contact', 'H', 'h', '', '', 0, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(46, 71, 37, 86, 87, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/i', 'com_contact', 'I', 'i', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(47, 72, 37, 88, 89, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/j', 'com_contact', 'J', 'j', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(48, 73, 37, 90, 91, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/k', 'com_contact', 'K', 'k', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(49, 74, 37, 92, 93, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/l', 'com_contact', 'L', 'l', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(50, 75, 37, 94, 95, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/m', 'com_contact', 'M', 'm', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(51, 76, 37, 96, 97, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/n', 'com_contact', 'N', 'n', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(52, 77, 37, 98, 99, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/o', 'com_contact', 'O', 'o', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(53, 78, 37, 100, 101, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/p', 'com_contact', 'P', 'p', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(54, 79, 37, 102, 103, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/q', 'com_contact', 'Q', 'q', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(55, 80, 37, 104, 105, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/r', 'com_contact', 'R', 'r', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(56, 81, 37, 106, 107, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/s', 'com_contact', 'S', 's', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(57, 82, 37, 108, 109, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/t', 'com_contact', 'T', 't', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(58, 83, 37, 110, 111, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/u', 'com_contact', 'U', 'u', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(59, 84, 37, 112, 113, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/v', 'com_contact', 'V', 'v', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(60, 85, 37, 114, 115, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/w', 'com_contact', 'W', 'w', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(61, 86, 37, 116, 117, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/x', 'com_contact', 'X', 'x', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(62, 87, 37, 118, 119, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/y', 'com_contact', 'Y', 'y', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(63, 88, 37, 120, 121, 4, 'sample-data-contact/shop-site/fruit-encyclopedia/z', 'com_contact', 'Z', 'z', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(64, 93, 22, 15, 16, 5, 'sample-data-articles/joomla/extensions/modules/articles-modules', 'com_content', 'Content Modules', 'articles-modules', '', '<p>Content modules display article and other information from the content component.</p>', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(65, 94, 22, 17, 18, 5, 'sample-data-articles/joomla/extensions/modules/user-modules', 'com_content', 'User Modules', 'user-modules', '', '<p>User modules interact with the user system, allowing users to login, show who is logged-in, and showing the most recently registered users.</p>', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 0, '2011-01-01 00:00:01', 0, '2011-12-27 12:00:50', 0, '*'),
(66, 95, 22, 19, 20, 5, 'sample-data-articles/joomla/extensions/modules/display-modules', 'com_content', 'Display Modules', 'display-modules', '', '<p>These modules display information from components other than content and user. These include weblinks, news feeds and the media manager.</p>', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 212, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(67, 96, 22, 21, 22, 5, 'sample-data-articles/joomla/extensions/modules/utility-modules', 'com_content', 'Utility Modules', 'utility-modules', '', '<p>Utility modules provide useful functionality such as search, syndication and statistics.</p>', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 212, '2011-01-01 00:00:01', 0, '2011-12-27 12:01:34', 0, '*'),
(68, 97, 23, 31, 32, 5, 'sample-data-articles/joomla/extensions/templates/atomic', 'com_content', 'Atomic', 'atomic', '', '<p><img src="templates/atomic/template_thumbnail.png" border="0" alt="The Atomic Template" style="border: 0; float: right;" /></p>\r\n<p>Atomic is a minimal template designed to be a skeleton for making your own template and to learn about Joomla! templating.</p>\r\n<ul>\r\n<li><a href="index.php?Itemid=285">Home Page</a></li>\r\n<li><a href="index.php?Itemid=316">Typography</a></li>\r\n</ul>', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 212, '2011-01-01 00:00:01', 0, '2011-12-27 12:08:16', 0, '*'),
(69, 98, 23, 27, 28, 5, 'sample-data-articles/joomla/extensions/templates/beez-20', 'com_content', 'Beez 20', 'beez-20', '', '<p><img src="templates/beez_20/template_thumbnail.png" border="0" alt="Beez_20 thumbnail" align="right" style="float: right;" /></p>\r\n<p>Beez 2.0 is a versatile, easy to customise template that works for a variety of sites. It meets major accessibility standards and demonstrates a range of css and javascript techniques. It is the default template that installs with Joomla!</p>\r\n<ul>\r\n<li><a href="index.php?Itemid=424">Home Page</a></li>\r\n<li><a href="index.php?Itemid=423">Typography</a></li>\r\n</ul>', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 212, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(70, 99, 23, 29, 30, 5, 'sample-data-articles/joomla/extensions/templates/beez-5', 'com_content', 'Beez 5', 'beez-5', '', '<p><img src="templates/beez5/template_thumbnail.png" border="0" alt="Beez5 Thumbnail" align="right" style="float: right;" /></p>\r\n<p>Beez 5 is an html5 implementation of a Joomla! template. It uses a number of html5 techniques to enhance the presentation of a site. It is used as the template for the Fruit Shop sample site.</p>\r\n<ul>\r\n<li><a href="index.php?Itemid=458">Home Page</a></li>\r\n<li><a href="index.php?Itemid=457">Typography</a></li>\r\n</ul>', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 212, '2011-01-01 00:00:01', 0, '2011-12-27 12:06:57', 0, '*'),
(72, 108, 28, 44, 45, 4, 'sample-data-articles/park-site/photo-gallery/animals', 'com_content', 'Animals', 'animals', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 212, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, 'en-GB'),
(73, 109, 28, 46, 47, 4, 'sample-data-articles/park-site/photo-gallery/scenery', 'com_content', 'Scenery', 'scenery', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 212, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, 'en-GB'),
(75, 166, 22, 23, 24, 5, 'sample-data-articles/joomla/extensions/modules/navigation-modules', 'com_content', 'Navigation Modules', 'navigation-modules', '', '<p>Navigation modules help your visitors move through your site and find what they need.</p>\r\n<p>Menus provide your site with structure and help your visitors navigate your site.  Although they are all based on the same menu module, the variety of ways menus are used in the sample data show how flexible this module is.</p>\r\n<p>A menu can range from extremely simple (for example the top menu or the menu for the Australian Parks sample site) to extremely complex (for example the About Joomla! menu with its many levels). They can also be used for other types of presentation such as the site map linked from the "This Site" menu.</p>\r\n<p>Breadcrumbs provide users with information about where they are in a site.</p>', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 212, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*'),
(76, 167, 29, 53, 54, 3, 'sample-data-articles/fruit-shop-site/recipes', 'com_content', 'Recipes', 'recipes', '', '<p>Customers and suppliers can post their favorite recipes for fruit here.</p>\r\n<p>A good idea is to promote the use of metadata keywords to make finding other recipes for the same fruit easier.</p>\r\n<p><em>To see this in action, create a user assigned to the customer group and a user assigned to the suppliers group. These users will be able to create their own recipe pages and edit those pages. They will not be able to edit other users'' pages.</em><br /><br /></p>', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 212, '2011-01-01 00:00:01', 0, '2011-12-27 12:18:25', 0, '*'),
(77, 169, 1, 133, 134, 1, 'uncategorised', 'com_users.notes', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 212, '2011-01-01 00:00:01', 0, '2011-01-01 00:00:01', 0, '*');

-- --------------------------------------------------------

--
-- Table structure for table `jos_contact_details`
--

DROP TABLE IF EXISTS `jos_contact_details`;
CREATE TABLE `jos_contact_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `con_position` varchar(255) DEFAULT NULL,
  `address` text,
  `suburb` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `postcode` varchar(100) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `misc` mediumtext,
  `image` varchar(255) DEFAULT NULL,
  `imagepos` varchar(20) DEFAULT NULL,
  `email_to` varchar(255) DEFAULT NULL,
  `default_con` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `catid` int(11) NOT NULL DEFAULT '0',
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `mobile` varchar(255) NOT NULL DEFAULT '',
  `webpage` varchar(255) NOT NULL DEFAULT '',
  `sortname1` varchar(255) NOT NULL,
  `sortname2` varchar(255) NOT NULL,
  `sortname3` varchar(255) NOT NULL,
  `language` char(7) NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Set if article is featured.',
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`published`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`catid`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `jos_contact_details`
--

INSERT INTO `jos_contact_details` (`id`, `name`, `alias`, `con_position`, `address`, `suburb`, `state`, `country`, `postcode`, `telephone`, `fax`, `misc`, `image`, `imagepos`, `email_to`, `default_con`, `published`, `checked_out`, `checked_out_time`, `ordering`, `params`, `user_id`, `catid`, `access`, `mobile`, `webpage`, `sortname1`, `sortname2`, `sortname3`, `language`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `metakey`, `metadesc`, `metadata`, `featured`, `xreference`, `publish_up`, `publish_down`) VALUES
(1, 'Contact Name Here', 'name', 'Position', 'Street Address', 'Suburb', 'State', 'Country', 'Zip Code', 'Telephone', 'Fax', '<p>Information about or by the contact.</p>', 'images/powered_by.png', 'top', 'email@example.com', 1, 1, 0, '0000-00-00 00:00:00', 1, '{"show_contact_category":"","show_contact_list":"","presentation_style":"","show_name":"","show_position":"","show_email":"","show_street_address":"","show_suburb":"","show_state":"","show_postcode":"","show_country":"","show_telephone":"","show_mobile":"","show_fax":"","show_webpage":"","show_misc":"","show_image":"","allow_vcard":"","show_articles":"","show_profile":"","show_links":"0","linka_name":"Twitter","linka":"http:\\/\\/twitter.com\\/joomla","linkb_name":"YouTube","linkb":"http:\\/\\/www.youtube.com\\/user\\/joomla","linkc_name":"Facebook","linkc":"http:\\/\\/www.facebook.com\\/joomla","linkd_name":"FriendFeed","linkd":"http:\\/\\/friendfeed.com\\/joomla","linke_name":"Scribed","linke":"http:\\/\\/www.scribd.com\\/people\\/view\\/504592-joomla","contact_layout":"","show_email_form":"","show_email_copy":"","banned_email":"","banned_subject":"","banned_text":"","validate_session":"","custom_reply":"","redirect":""}', 0, 16, 1, '', '', 'last', 'first', 'middle', 'en-GB', '2011-01-01 00:00:01', 212, '', '2012-08-07 08:13:55', 212, '', '', '{"robots":"","rights":""}', 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Webmaster', 'webmaster', '', '', '', '', '', '', '', '', '', '', NULL, 'webmaster@example.com', 0, 1, 0, '0000-00-00 00:00:00', 1, '{"show_contact_category":"","show_contact_list":"","presentation_style":"","show_name":"","show_position":"","show_email":"","show_street_address":"","show_suburb":"","show_state":"","show_postcode":"","show_country":"","show_telephone":"","show_mobile":"","show_fax":"","show_webpage":"","show_misc":"","show_image":"","allow_vcard":"","show_articles":"","show_profile":"","show_links":"","linka_name":"","linka":"","linkb_name":"","linkb":"","linkc_name":"","linkc":"","linkd_name":"","linkd":"","linke_name":"","linke":"","show_email_form":"1","show_email_copy":"1","banned_email":"","banned_subject":"","banned_text":"","validate_session":"1","custom_reply":"","redirect":""}', 0, 34, 1, '', '', '', '', '', 'en-GB', '2011-01-01 00:00:01', 212, '', '2011-01-01 00:00:01', 0, '', '', '{"robots":"","rights":""}', 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Owner', 'owner', '', '', '', '', '', '', '', '', '<p>I''m the owner of this store.</p>', '', NULL, '', 0, 1, 0, '0000-00-00 00:00:00', 2, '{"show_contact_category":"","show_contact_list":"","presentation_style":"","show_name":"","show_position":"","show_email":"","show_street_address":"","show_suburb":"","show_state":"","show_postcode":"","show_country":"","show_telephone":"","show_mobile":"","show_fax":"","show_webpage":"","show_misc":"","show_image":"","allow_vcard":"","show_articles":"","show_profile":"","show_links":"","linka_name":"","linka":"","linkb_name":"","linkb":"","linkc_name":"","linkc":"","linkd_name":"","linkd":"","linke_name":"","linke":"","show_email_form":"","show_email_copy":"","banned_email":"","banned_subject":"","banned_text":"","validate_session":"","custom_reply":"","redirect":""}', 0, 36, 1, '', '', '', '', '', '*', '2011-01-01 00:00:01', 212, '', '2011-01-01 00:00:01', 0, '', '', '{"robots":"","rights":""}', 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Buyer', 'buyer', '', '', '', '', '', '', '', '', '<p>I am in charge of buying fruit. If you sell good fruit, contact me.</p>', '', NULL, '', 0, 1, 0, '0000-00-00 00:00:00', 1, '{"show_contact_category":"","show_contact_list":"","presentation_style":"","show_name":"","show_position":"","show_email":"","show_street_address":"","show_suburb":"","show_state":"","show_postcode":"","show_country":"","show_telephone":"","show_mobile":"","show_fax":"","show_webpage":"","show_misc":"","show_image":"","allow_vcard":"","show_articles":"","show_profile":"","show_links":"0","linka_name":"","linka":"","linkb_name":"","linkb":"","linkc_name":"","linkc":"","linkd_name":"","linkd":"","linke_name":"","linke":"","show_email_form":"","show_email_copy":"","banned_email":"","banned_subject":"","banned_text":"","validate_session":"","custom_reply":"","redirect":""}', 0, 36, 1, '', '', '', '', '', '*', '2011-01-01 00:00:01', 212, '', '2011-01-01 00:00:01', 0, '', '', '{"robots":"","rights":""}', 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Bananas', 'bananas', 'Scientific Name: Musa', 'Image Credit: Enzik\r\nRights: Creative Commons Share Alike Unported 3.0\r\nSource: http://commons.wikimedia.org/wiki/File:Bananas_-_Morocco.jpg', '', 'Type: Herbaceous', 'Large Producers: India, China, Brasil', '', '', '', '<p>Bananas are a great source of potassium.</p>\r\n<p> </p>', 'images/sampledata/fruitshop/bananas_2.jpg', NULL, '', 0, 1, 0, '0000-00-00 00:00:00', 1, '{"show_contact_category":"show_with_link","show_contact_list":"","presentation_style":"plain","show_name":"","show_position":"1","show_email":"","show_street_address":"","show_suburb":"","show_state":"1","show_postcode":"","show_country":"1","show_telephone":"","show_mobile":"","show_fax":"","show_webpage":"","show_misc":"","show_image":"","allow_vcard":"","show_articles":"","show_profile":"","show_links":"1","linka_name":"Wikipedia: Banana English","linka":"http:\\/\\/en.wikipedia.org\\/wiki\\/Banana","linkb_name":"Wikipedia:  \\u0939\\u093f\\u0928\\u094d\\u0926\\u0940 \\u0915\\u0947\\u0932\\u093e","linkb":"http:\\/\\/hi.wikipedia.org\\/wiki\\/%E0%A4%95%E0%A5%87%E0%A4%B2%E0%A4%BE","linkc_name":"Wikipedia:Banana Portugu\\u00eas","linkc":"http:\\/\\/pt.wikipedia.org\\/wiki\\/Banana","linkd_name":"Wikipedia: \\u0411\\u0430\\u043d\\u0430\\u043d  \\u0420\\u0443\\u0441\\u0441\\u043a\\u0438\\u0439","linkd":"http:\\/\\/ru.wikipedia.org\\/\\u0411\\u0430\\u043d\\u0430\\u043d","linke_name":"","linke":"","contact_layout":"beez5:encyclopedia"}', 0, 39, 1, '', '', '', '', '', '*', '2011-01-01 00:00:01', 212, '', '2011-01-01 00:00:01', 0, '', '', '{"robots":"","rights":""}', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Apples', 'apples', 'Scientific Name: Malus domestica', 'Image Credit: Fievet\r\nRights: Public Domain\r\nSource: http://commons.wikimedia.org/wiki/File:Pommes_vertes.JPG', '', 'Family: Rosaceae', 'Large: Producers: China, United States', '', '', '', '<p>Apples are a versatile fruit, used for eating, cooking, and preserving.</p>\r\n<p>There are more that 7500 different kinds of apples grown around the world.</p>', 'images/sampledata/fruitshop/apple.jpg', NULL, '', 0, 1, 0, '0000-00-00 00:00:00', 1, '{"show_contact_category":"","show_contact_list":"","presentation_style":"plain","show_name":"","show_position":"","show_email":"","show_street_address":"","show_suburb":"","show_state":"","show_postcode":"","show_country":"","show_telephone":"","show_mobile":"","show_fax":"","show_webpage":"","show_misc":"","show_image":"","allow_vcard":"","show_articles":"","show_profile":"","show_links":"1","linka_name":"Wikipedia: Apples English","linka":"http:\\/\\/en.wikipedia.org\\/wiki\\/Apple","linkb_name":"Wikipedia: Manzana Espa\\u00f1ol ","linkb":"http:\\/\\/es.wikipedia.org\\/wiki\\/Manzana","linkc_name":"Wikipedia: \\u82f9\\u679c \\u4e2d\\u6587","linkc":"http:\\/\\/zh.wikipedia.org\\/zh\\/\\u82f9\\u679c","linkd_name":"Wikipedia: Tofaa Kiswahili","linkd":"http:\\/\\/sw.wikipedia.org\\/wiki\\/Tofaa","linke_name":"","linke":"","contact_layout":"beez5:encyclopedia"}', 0, 38, 1, '', '', '', '', '', '*', '2011-01-01 00:00:01', 212, '', '2011-01-01 00:00:01', 0, '', '', '{"robots":"","rights":""}', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Tamarind', 'tamarind', 'Scientific Name: Tamarindus indica', 'Image Credit: Franz Eugen Köhler, Köhler''s Medizinal-Pflanzen \r\nRights: Public Domain\r\nSource:http://commons.wikimedia.org/wiki/File:Koeh-134.jpg', '', 'Family: Fabaceae', 'Large Producers: India, United States', '', '', '', '<p>Tamarinds are a versatile fruit used around the world. In its young form it is used in hot sauces; ripened it is the basis for many refreshing drinks.</p>\r\n<p> </p>', 'images/sampledata/fruitshop/tamarind.jpg', NULL, '', 0, 1, 0, '0000-00-00 00:00:00', 1, '{"show_contact_category":"","show_contact_list":"","presentation_style":"plain","show_name":"","show_position":"","show_email":"","show_street_address":"","show_suburb":"","show_state":"","show_postcode":"","show_country":"","show_telephone":"","show_mobile":"","show_fax":"","show_webpage":"","show_misc":"","show_image":"","allow_vcard":"","show_articles":"","show_profile":"","show_links":"1","linka_name":"Wikipedia: Tamarind English","linka":"http:\\/\\/en.wikipedia.org\\/wiki\\/Tamarind","linkb_name":"Wikipedia: \\u09a4\\u09c7\\u0981\\u09a4\\u09c1\\u09b2  \\u09ac\\u09be\\u0982\\u09b2\\u09be  ","linkb":"http:\\/\\/bn.wikipedia.org\\/wiki\\/\\u09a4\\u09c7\\u0981\\u09a4\\u09c1\\u09b2 ","linkc_name":"Wikipedia: Tamarinier Fran\\u00e7ais","linkc":"http:\\/\\/fr.wikipedia.org\\/wiki\\/Tamarinier","linkd_name":"Wikipedia:Tamaline lea faka-Tonga","linkd":"http:\\/\\/to.wikipedia.org\\/wiki\\/Tamaline","linke_name":"","linke":"","contact_layout":"beez5:encyclopedia"}', 0, 57, 1, '', '', '', '', '', '*', '2011-01-01 00:00:01', 212, '', '2011-01-01 00:00:01', 0, '', '', '{"robots":"","rights":""}', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Shop Address', 'shop-address', '', '', 'Our City', 'Our Province', 'Our Country', '', '555-555-5555', '', '<p>Here are directions for how to get to our shop.</p>', '', NULL, '', 0, 1, 0, '0000-00-00 00:00:00', 1, '{"show_contact_category":"","show_contact_list":"","presentation_style":"","show_name":"","show_position":"","show_email":"","show_street_address":"","show_suburb":"","show_state":"","show_postcode":"","show_country":"","show_telephone":"","show_mobile":"","show_fax":"","show_webpage":"","show_misc":"","show_image":"","allow_vcard":"","show_articles":"","show_profile":"","show_links":"","linka_name":"","linka":"","linkb_name":"","linkb":"","linkc_name":"","linkc":"","linkd_name":"","linkd":"","linke_name":"","linke":"","show_email_form":"","show_email_copy":"","banned_email":"","banned_subject":"","banned_text":"","validate_session":"","custom_reply":"","redirect":""}', 0, 35, 1, '', '', '', '', '', '*', '2011-01-01 00:00:01', 212, '', '2011-01-01 00:00:01', 0, '', '', '{"robots":"","rights":""}', 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `jos_content`
--

DROP TABLE IF EXISTS `jos_content`;
CREATE TABLE `jos_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to the #__assets table.',
  `title` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `title_alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT 'Deprecated in Joomla! 3.0',
  `introtext` mediumtext NOT NULL,
  `fulltext` mediumtext NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `sectionid` int(10) unsigned NOT NULL DEFAULT '0',
  `mask` int(10) unsigned NOT NULL DEFAULT '0',
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `images` text NOT NULL,
  `urls` text NOT NULL,
  `attribs` varchar(5120) NOT NULL,
  `version` int(10) unsigned NOT NULL DEFAULT '1',
  `parentid` int(10) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `metadata` text NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Set if article is featured.',
  `language` char(7) NOT NULL COMMENT 'The language code for the article.',
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`catid`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=75 ;

--
-- Dumping data for table `jos_content`
--

INSERT INTO `jos_content` (`id`, `asset_id`, `title`, `alias`, `title_alias`, `introtext`, `fulltext`, `state`, `sectionid`, `mask`, `catid`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `checked_out`, `checked_out_time`, `publish_up`, `publish_down`, `images`, `urls`, `attribs`, `version`, `parentid`, `ordering`, `metakey`, `metadesc`, `access`, `hits`, `metadata`, `featured`, `language`, `xreference`) VALUES
(1, 89, 'Administrator Components', 'administrator-components', '', '<p>All components are also used in the administrator area of your website. In addition to the ones listed here, there are components in the administrator that do not have direct front end displays, but do help shape your site. The most important ones for most users are</p>\r\n<ul>\r\n<li>Media Manager</li>\r\n<li>Extensions Manager</li>\r\n<li>Menu Manager</li>\r\n<li>Global Configuration</li>\r\n<li>Banners</li>\r\n<li>Redirect</li>\r\n</ul>\r\n<hr title="Media Manager" alt="Media Manager" class="system-pagebreak" style="color: gray; border: 1px dashed gray;" />\r\n<p> </p>\r\n<h3>Media Manager</h3>\r\n<p>The media manager component lets you upload and insert images into content throughout your site. Optionally, you can enable the flash uploader which will allow you to to upload multiple images. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Content_Media_Manager">Help</a></p>\r\n<hr title="Extensions Manager" alt="Extensions Manager" class="system-pagebreak" style="color: gray; border: 1px dashed gray;" />\r\n<h3>Extensions Manager</h3>\r\n<p>The extensions manager lets you install, update, uninstall and manage all of your extensions. The extensions manager has been extensively redesigned, although the core install and uninstall functionality remains the same as in Joomla! 1.5. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Extensions_Extension_Manager_Install">Help</a></p>\r\n<hr title="Menu Manager" alt="Menu Manager" class="system-pagebreak" style="color: gray; border: 1px dashed gray;" />\r\n<h3>Menu Manager</h3>\r\n<p>The menu manager lets you create the menus you see displayed on your site. It also allows you to assign modules and template styles to specific menu links. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Menus_Menu_Manager">Help</a></p>\r\n<hr title="Global Configuration" alt="Global Configuration" class="system-pagebreak" style="color: gray; border: 1px dashed gray;" />\r\n<h3>Global Configuration</h3>\r\n<p>The global configuration is where the site administrator configures things such as whether search engine friendly urls are enabled, the site meta data (descriptive text used by search engines and indexers) and other functions. For many beginning users simply leaving the settings on default is a good way to begin, although when your site is ready for the public you will want to change the meta data to match its content. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Site_Global_Configuration">Help</a></p>\r\n<hr title="Banners" alt="Banners" class="system-pagebreak" style="color: gray; border: 1px dashed gray;" />\r\n<h3>Banners</h3>\r\n<p>The banners component provides a simple way to display a rotating image in a module and, if you wish to have advertising, a way to track the number of times an image is viewed and clicked. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Components_Banners_Banners_Edit">Help</a></p>\r\n<hr title="Redirect" class="system-pagebreak" />\r\n<h3><br />Redirect</h3>\r\n<p>The redirect component is used to manage broken links that produce Page Not Found (404) errors. If enabled it will allow you to redirect broken links to specific pages. It can also be used to manage migration related URL changes. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Components_Redirect_Manager">Help</a></p>', '', 1, 0, 0, 21, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-12-27 11:03:19', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 9, 0, 7, '', '', 1, 2, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(2, 90, 'Archive Module', 'archive-module', '', '<p>This module shows a list of the calendar months containing archived articles. After you have changed the status of an article to archived, this list will be automatically generated. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Extensions_Module_Manager_Articles_Archive" title="Archive Module">Help</a></p>\r\n<div class="sample-module">{loadmodule articles_archive,Archived Articles}</div>', '', 1, 0, 0, 64, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-09-17 22:18:05', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","page_title":"","alternative_readmore":"","layout":""}', 5, 0, 5, 'modules, content', '', 1, 5, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(3, 91, 'Article Categories Module', 'article-categories-module', '', '<p>This module displays a list of categories from one parent category. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Extensions_Module_Manager_Articles_Categories" title="Categories Module">Help</a></p>\r\n<div class="sample-module">{loadmodule articles_categories,Articles Categories}</div>\r\n<p> </p>', '', 1, 0, 0, 64, '2011-01-01 00:00:01', 212, '', '2011-09-17 22:13:31', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","page_title":"","alternative_readmore":"","layout":""}', 5, 0, 6, 'modules, content', '', 1, 6, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(4, 92, 'Articles Category Module', 'articles-category-module', '', '<p>This module allows you to display the articles in a specific category. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Extensions_Module_Manager_Articles_Category">Help</a></p>\r\n<div class="sample-module">{loadmodule articles_category,Articles Category}</div>', '', 1, 0, 0, 64, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-09-17 22:18:26', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","page_title":"","alternative_readmore":"","layout":""}', 8, 0, 7, '', 'articles,content', 1, 10, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(5, 101, 'Authentication', 'authentication', '', '<p>The authentication plugins operate when users login to your site or administrator. The Joomla! authentication plugin is in operation by default but you can enable Gmail or LDAP or install a plugin for a different system. An example is included that may be used to create a new authentication plugin.</p>\r\n<p>Default on:</p>\r\n<ul>\r\n<li>Joomla <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit#Authentication_-_GMail">Help</a></li>\r\n</ul>\r\n<p>Default off:</p>\r\n<ul>\r\n<li>Gmail <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit#Authentication_-_GMail">Help</a></li>\r\n<li>LDAP <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit#Authentication_-_LDAP">Help</a></li>\r\n</ul>', '', 1, 0, 0, 25, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-12-27 11:04:13', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 4, 0, 3, '', '', 1, 1, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(6, 102, 'Australian Parks ', 'australian-parks', '', '<p><img src="images/sampledata/parks/banner_cradle.jpg" border="0" alt="Cradle Park Banner" /></p>\r\n<p>Welcome!</p>\r\n<p>This is a basic site about the beautiful and fascinating parks of Australia.</p>\r\n<p>On this site you can read all about my travels to different parks, see photos, and find links to park websites.</p>\r\n<p><em>This sample site is an example of using the core of Joomla! to create a basic website, whether a "brochure site,"  a personal blog, or as a way to present information on a topic you are interested in.</em></p>\r\n<p><em> Read more about the site in the About Parks module.</em></p>\r\n<p> </p>', '', 1, 0, 0, 26, '2011-01-01 00:00:01', 212, 'Parks Webmaster', '2011-09-06 06:20:19', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":""}', 2, 0, 1, '', '', 1, 19, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(7, 103, 'Banner Module', 'banner-module', '', '<p>The banner module is used to display the banners that are managed by the banners component in the site administrator. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Extensions_Module_Manager_Banners">Help</a>.</p>\r\n<div class="sample-module">{loadmodule banners,Banners}</div>', '', 1, 0, 0, 66, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-09-17 22:32:58', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_readmore":"","show_print_icon":"","show_email_icon":"","show_hits":"","page_title":"","alternative_readmore":"","layout":""}', 4, 0, 6, '', '', 1, 4, '', 0, '*', ''),
(8, 104, 'Beginners', 'beginners', '', '<p>If this is your first Joomla! site or your first web site, you have come to the right place. Joomla will help you get your website up and running quickly and easily.</p>\r\n<p>Start off using your site by logging in using the administrator account you created when you installed Joomla.</p>\r\n', '\r\n<p>Explore the articles and other resources right here on your site data to learn more about how Joomla works. (When you''re done reading, you can delete or archive all of this.) You will also probably want to visit the Beginners'' Areas of the <a href="http://docs.joomla.org/Beginners">Joomla documentation</a> and <a href="http://forum.joomla.org">support forums</a>.</p>\r\n<p>You''ll also want to sign up for the Joomla Security Mailing list and the Announcements mailing list. For inspiration visit the <a href="http://community.joomla.org/showcase/">Joomla! Site Showcase</a> to see an amazing array of ways people use Joomla to tell their stories on the web.</p>\r\n<p>The basic Joomla installation will let you get a great site up and running, but when you are ready for more features the power of Joomla is in the creative ways that developers have extended it to do all kinds of things. Visit the <a href="http://extensions.joomla.org/">Joomla! Extensions Directory</a> to see thousands of extensions that can do almost anything you could want on a website. Can''t find what you need? You may want to find a Joomla professional in the <a href="http://resources.joomla.org/">Joomla! Resource Directory</a>.</p>\r\n<p>Want to learn more? Consider attending a <a href="http://community.joomla.org/events.html">Joomla! Day</a> or other event or joining a local <a href="http://community.joomla.org/user-groups.html">Joomla! Users Group</a>. Can''t find one near you? Start one yourself.</p>', 1, 0, 0, 19, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-12-27 11:10:49', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 4, 0, 4, '', '', 1, 2, '{"robots":"","author":"","rights":"","xreference":""}', 1, '*', ''),
(9, 105, 'Contacts', 'contact', '', '<p>The contact component provides a way to provide contact forms and information for your site or to create a complex directory that can be used for many different purposes. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Components_Contacts_Contacts">Help</a></p>', '', 1, 0, 0, 21, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-01-10 04:15:37', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":""}', 2, 0, 2, '', '', 1, 3, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(10, 106, 'Content', 'content', '', '<p>The content component (com_content) is what you use to write articles. It is extremely flexible and has the largest number of built in views. Articles can be created and edited from the front end, making content the easiest component to use to create your site content. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Content_Article_Manager">Help</a></p>', '', 1, 0, 0, 21, '2011-01-01 00:00:01', 212, '', '2011-01-10 04:28:12', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":""}', 2, 0, 1, '', '', 1, 5, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(11, 107, 'Cradle Mountain', 'cradle-mountain', '', '<p> </p>\r\n', '\r\n<p> </p>', 1, 0, 0, 73, '2011-01-01 00:00:01', 212, 'Parks Webmaster', '2012-01-17 04:00:36', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"images\\/sampledata\\/parks\\/landscape\\/250px_cradle_mountain_seen_from_barn_bluff.jpg","float_intro":"","image_intro_alt":"Cradle Mountain","image_intro_caption":"","image_fulltext":"images\\/sampledata\\/parks\\/landscape\\/800px_cradle_mountain_seen_from_barn_bluff.jpg","float_fulltext":"none","image_fulltext_alt":"Cradle Mountain","image_fulltext_caption":"Source: http:\\/\\/commons.wikimedia.org\\/wiki\\/File:Rainforest,bluemountainsNSW.jpg Author: Alan J.W.C. License: GNU Free Documentation License v . 1.2 or later"}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 4, 0, 1, '', '', 1, 1, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(12, 110, 'Custom HTML Module', 'custom-html-module', '', '<p>This module allows you to create your own HTML Module using a WYSIWYG editor. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Extensions_Module_Manager_Custom_HTML" title="Custom HTML Module">Help</a></p>\r\n<div class="sample-module">{loadmodule custom,Custom HTML}</div>', '', 1, 0, 0, 66, '2011-01-01 00:00:01', 212, '', '2011-12-27 11:12:46', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 13, 0, 1, '', '', 1, 13, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(13, 111, 'Directions', 'directions', '', '<p>Here''s how to find our shop.</p><p>By car</p><p>Drive along Main Street to the intersection with First Avenue.  Look for our sign.</p><p>By foot</p><p>From the center of town, walk north on Main Street until you see our sign.</p><p>By bus</p><p>Take the #73 Bus to the last stop. We are on the north east corner.</p>', '', 1, 0, 0, 29, '2011-01-01 00:00:01', 212, 'Fruit Shop Webmaster', '2011-01-01 00:00:01', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_readmore":"","show_print_icon":"","show_email_icon":"","show_hits":"","page_title":"","alternative_readmore":"","layout":""}', 1, 0, 2, '', '', 1, 0, '', 0, '*', ''),
(14, 112, 'Editors', 'editors', '', '<p>Editors are used thoughout Joomla! where content is created. TinyMCE is the default choice in most locations although CodeMirror is used in the template manager. No Editor provides a text box for html content.</p>\r\n<p>Default on:</p>\r\n<ul>\r\n<li>CodeMirror <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit#Editor_-_CodeMirror">Help</a></li>\r\n<li>TinyMCE<a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit#Editor_-_TinyMCE"> Help</a></li>\r\n<li>No Editor <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit#Editor_-_None">Help</a></li>\r\n</ul>\r\n<p>Default off:</p>\r\n<ul>\r\n<li>None</li>\r\n</ul>', '', 1, 0, 0, 25, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-09-06 05:45:40', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_readmore":"","show_print_icon":"","show_email_icon":"","show_hits":"","page_title":"","alternative_readmore":"","layout":""}', 2, 0, 5, '', '', 1, 0, '', 0, '*', ''),
(15, 113, 'Editors-xtd', 'editors-xtd', '', '<p>These plugins are the buttons found beneath your editor. They only run when an editor plugin runs.</p>\r\n<p>Default on:</p>\r\n<ul>\r\n<li>Editor Button: Image<a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit#Button_-_Image"> Help</a></li>\r\n<li>Editor Button: Readmore <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit#Button_-_Readmore">Help</a></li>\r\n<li>Editor Button: Page Break <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit#Button_-_Pagebreak">Help</a></li>\r\n<li>Editor Button: Article <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit#Button_-_Article">Help</a></li>\r\n</ul>\r\n<p>Default off:</p>\r\n<ul>\r\n<li>None</li>\r\n</ul>', '', 1, 0, 0, 25, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-12-27 11:14:12', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 4, 0, 6, '', '', 1, 1, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(16, 114, 'Feed Display', 'feed-display', '', '<p>This module allows the displaying of a syndicated feed. <a href="http://docs.joomla.org/Help15:Screen.modulessite.edit.15#Feed_Display" title="Feed Display Module">Help</a></p>\r\n<div class="sample-module">{loadmodule feed,Feed Display}</div>', '', 1, 0, 0, 66, '2011-01-01 00:00:01', 212, '', '2011-09-17 22:22:08', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_readmore":"","show_print_icon":"","show_email_icon":"","show_hits":"","page_title":"","alternative_readmore":"","layout":""}', 3, 0, 2, '', '', 1, 3, '', 0, '*', ''),
(17, 115, 'First Blog Post', 'first-blog-post', '', '<p><em>Lorem Ipsum is filler text that is commonly used by designers before the content for a new site is ready.</em></p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed faucibus purus vitae diam posuere nec eleifend elit dictum. Aenean sit amet erat purus, id fermentum lorem. Integer elementum tristique lectus, non posuere quam pretium sed. Quisque scelerisque erat at urna condimentum euismod. Fusce vestibulum facilisis est, a accumsan massa aliquam in. In auctor interdum mauris a luctus. Morbi euismod tempor dapibus. Duis dapibus posuere quam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In eu est nec erat sollicitudin hendrerit. Pellentesque sed turpis nunc, sit amet laoreet velit. Praesent vulputate semper nulla nec varius. Aenean aliquam, justo at blandit sodales, mauris leo viverra orci, sed sodales mauris orci vitae magna.</p>', '<p>Quisque a massa sed libero tristique suscipit. Morbi tristique molestie metus, vel vehicula nisl ultrices pretium. Sed sit amet est et sapien condimentum viverra. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Phasellus viverra tortor porta orci convallis ac cursus erat sagittis. Vivamus aliquam, purus non luctus adipiscing, orci urna imperdiet eros, sed tincidunt neque sapien et leo. Cras fermentum, dolor id tempor vestibulum, neque lectus luctus mauris, nec congue tellus arcu nec augue. Nulla quis mi arcu, in bibendum quam. Sed placerat laoreet fermentum. In varius lobortis consequat. Proin vulputate felis ac arcu lacinia adipiscing. Morbi molestie, massa id sagittis luctus, sem sapien sollicitudin quam, in vehicula quam lectus quis augue. Integer orci lectus, bibendum in fringilla sit amet, rutrum eget enim. Curabitur at libero vitae lectus gravida luctus. Nam mattis, ligula sit amet vestibulum feugiat, eros sem sodales mi, nec dignissim ante elit quis nisi. Nulla nec magna ut leo convallis sagittis ac non erat. Etiam in augue nulla, sed tristique orci. Vestibulum quis eleifend sapien.</p><p>Nam ut orci vel felis feugiat posuere ut eu lorem. In risus tellus, sodales eu eleifend sed, imperdiet id nulla. Nunc at enim lacus. Etiam dignissim, arcu quis accumsan varius, dui dui faucibus erat, in molestie mauris diam ac lacus. Sed sit amet egestas nunc. Nam sollicitudin lacinia sapien, non gravida eros convallis vitae. Integer vehicula dui a elit placerat venenatis. Nullam tincidunt ligula aliquet dui interdum feugiat. Maecenas ultricies, lacus quis facilisis vehicula, lectus diam consequat nunc, euismod eleifend metus felis eu mauris. Aliquam dapibus, ipsum a dapibus commodo, dolor arcu accumsan neque, et tempor metus arcu ut massa. Curabitur non risus vitae nisl ornare pellentesque. Pellentesque nec ipsum eu dolor sodales aliquet. Vestibulum egestas scelerisque tincidunt. Integer adipiscing ultrices erat vel rhoncus.</p><p>Integer ac lectus ligula. Nam ornare nisl id magna tincidunt ultrices. Phasellus est nisi, condimentum at sollicitudin vel, consequat eu ipsum. In venenatis ipsum in ligula tincidunt bibendum id et leo. Vivamus quis purus massa. Ut enim magna, pharetra ut condimentum malesuada, auctor ut ligula. Proin mollis, urna a aliquam rutrum, risus erat cursus odio, a convallis enim lectus ut lorem. Nullam semper egestas quam non mattis. Vestibulum venenatis aliquet arcu, consectetur pretium erat pulvinar vel. Vestibulum in aliquet arcu. Ut dolor sem, pellentesque sit amet vestibulum nec, tristique in orci. Sed lacinia metus vel purus pretium sit amet commodo neque condimentum.</p><p>Aenean laoreet aliquet ullamcorper. Nunc tincidunt luctus tellus, eu lobortis sapien tincidunt sed. Donec luctus accumsan sem, at porttitor arcu vestibulum in. Sed suscipit malesuada arcu, ac porttitor orci volutpat in. Vestibulum consectetur vulputate eros ut porttitor. Aenean dictum urna quis erat rutrum nec malesuada tellus elementum. Quisque faucibus, turpis nec consectetur vulputate, mi enim semper mi, nec porttitor libero magna ut lacus. Quisque sodales, leo ut fermentum ullamcorper, tellus augue gravida magna, eget ultricies felis dolor vitae justo. Vestibulum blandit placerat neque, imperdiet ornare ipsum malesuada sed. Quisque bibendum quam porta diam molestie luctus. Sed metus lectus, ornare eu vulputate vel, eleifend facilisis augue. Maecenas eget urna velit, ac volutpat velit. Nam id bibendum ligula. Donec pellentesque, velit eu convallis sodales, nisi dui egestas nunc, et scelerisque lectus quam ut ipsum.</p>', 1, 0, 0, 27, '2011-01-01 00:00:01', 212, '', '2011-01-01 00:00:01', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_readmore":"","show_print_icon":"","show_email_icon":"","show_hits":"","page_title":"","alternative_readmore":"","layout":""}', 1, 0, 2, '', '', 1, 0, '', 0, '*', ''),
(18, 116, 'Second Blog Post', 'second-blog-post', '', '<p><em>Lorem Ipsum is text that is traditionally used by designers when working on a site before the content is ready.</em></p><p>Pellentesque bibendum metus ut dolor fermentum ut pulvinar tortor hendrerit. Nam vel odio vel diam tempus iaculis in non urna. Curabitur scelerisque, nunc id interdum vestibulum, felis elit luctus dui, ac dapibus tellus mauris tempus augue. Duis congue facilisis lobortis. Phasellus neque erat, tincidunt non lacinia sit amet, rutrum vitae nunc. Sed placerat lacinia fermentum. Integer justo sem, cursus id tristique eget, accumsan vel sapien. Curabitur ipsum neque, elementum vel vestibulum ut, lobortis a nisl. Fusce malesuada mollis purus consectetur auctor. Morbi tellus nunc, dapibus sit amet rutrum vel, laoreet quis mauris. Aenean nec sem nec purus bibendum venenatis. Mauris auctor commodo libero, in adipiscing dui adipiscing eu. Praesent eget orci ac nunc sodales varius.</p>', '<p>Nam eget venenatis lorem. Vestibulum a interdum sapien. Suspendisse potenti. Quisque auctor purus nec sapien venenatis vehicula malesuada velit vehicula. Fusce vel diam dolor, quis facilisis tortor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque libero nisi, pellentesque quis cursus sit amet, vehicula vitae nisl. Curabitur nec nunc ac sem tincidunt auctor. Phasellus in mattis magna. Donec consequat orci eget tortor ultricies rutrum. Mauris luctus vulputate molestie. Proin tincidunt vehicula euismod. Nam congue leo non erat cursus a adipiscing ipsum congue. Nulla iaculis purus sit amet turpis aliquam sit amet dapibus odio tincidunt. Ut augue diam, congue ut commodo pellentesque, fermentum mattis leo. Sed iaculis urna id enim dignissim sodales at a ipsum. Quisque varius lobortis mollis. Nunc purus magna, pellentesque pellentesque convallis sed, varius id ipsum. Etiam commodo mi mollis erat scelerisque fringilla. Nullam bibendum massa sagittis diam ornare rutrum.</p><p>Praesent convallis metus ut elit faucibus tempus in quis dui. Donec fringilla imperdiet nibh, sit amet fringilla velit congue et. Quisque commodo luctus ligula, vitae porttitor eros venenatis in. Praesent aliquet commodo orci id varius. Nulla nulla nibh, varius id volutpat nec, sagittis nec eros. Cras et dui justo. Curabitur malesuada facilisis neque, sed tempus massa tincidunt ut. Sed suscipit odio in lacus auctor vehicula non ut lacus. In hac habitasse platea dictumst. Sed nulla nisi, lacinia in viverra at, blandit vel tellus. Nulla metus erat, ultrices non pretium vel, varius nec sem. Morbi sollicitudin mattis lacus quis pharetra. Donec tincidunt mollis pretium. Proin non libero justo, vitae mattis diam. Integer vel elit in enim varius posuere sed vitae magna. Duis blandit tempor elementum. Vestibulum molestie dui nisi.</p><p>Curabitur volutpat interdum lorem sed tempus. Sed placerat quam non ligula lacinia sodales. Cras ultrices justo at nisi luctus hendrerit. Quisque sit amet placerat justo. In id sapien eu neque varius pharetra sed in sapien. Etiam nisl nunc, suscipit sed gravida sed, scelerisque ut nisl. Mauris quis massa nisl, aliquet posuere ligula. Etiam eget tortor mauris. Sed pellentesque vestibulum commodo. Mauris vitae est a libero dapibus dictum fringilla vitae magna.</p><p>Nulla facilisi. Praesent eget elit et mauris gravida lobortis ac nec risus. Ut vulputate ullamcorper est, volutpat feugiat lacus convallis non. Maecenas quis sem odio, et aliquam libero. Integer vel tortor eget orci tincidunt pulvinar interdum at erat. Integer ullamcorper consequat eros a pellentesque. Cras sagittis interdum enim in malesuada. Etiam non nunc neque. Fusce non ligula at tellus porta venenatis. Praesent tortor orci, fermentum sed tincidunt vel, varius vel dui. Duis pulvinar luctus odio, eget porta justo vulputate ac. Nulla varius feugiat lorem sed tempor. Phasellus pulvinar dapibus magna eget egestas. In malesuada lectus at justo pellentesque vitae rhoncus nulla ultrices. Proin ut sem sem. Donec eu suscipit ipsum. Cras eu arcu porttitor massa feugiat aliquet at quis nisl.</p>', 1, 0, 0, 27, '2011-01-01 00:00:01', 212, '', '2011-01-01 00:00:01', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_readmore":"","show_print_icon":"","show_email_icon":"","show_hits":"","page_title":"","alternative_readmore":"","layout":""}', 1, 0, 1, '', '', 1, 0, '', 0, '*', ''),
(19, 117, 'Footer Module', 'footer-module', '', '<p>This module shows the Joomla! copyright information. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Extensions_Module_Manager_Footer" title="Footer Module">Help</a></p>\r\n<div class="sample-module">{loadmodule footer,Footer}</div>', '', 1, 0, 0, 66, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-09-17 22:22:47', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_readmore":"","show_print_icon":"","show_email_icon":"","show_hits":"","page_title":"","alternative_readmore":"","layout":""}', 4, 0, 3, '', '', 1, 4, '', 0, '*', ''),
(20, 118, 'Fruit Shop', 'fruit-shop', '', '<h2>Welcome to the Fruit Shop</h2>\r\n<p>We sell fruits from around the world. Please use our website to learn more about our business. We hope you will come to our shop and buy some fruit.</p>\r\n<p><em>This mini site will show you how you might want to set up a site for a business, in this example one selling fruit. It shows how to use access controls to manage your site content. If you were building a real site, you might want to extend it with e-commerce, a catalog, mailing lists or other enhancements, many of which are available through the</em><a href="http://extensions.joomla.org"><em> Joomla! Extensions Directory</em></a>.</p>\r\n<p><em>To understand this site you will probably want to make one user with group set to customer and one with group set to grower. By logging in with different privileges you can see how access control works.</em></p>', '', 1, 0, 0, 29, '2011-01-01 00:00:01', 212, 'Fruit Shop Webmaster', '2011-12-27 11:17:59', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 2, 0, 1, '', '', 1, 0, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(21, 119, 'Getting Help', 'getting-help', '', '<p><img class="image-left" src="administrator/templates/hathor/images/header/icon-48-help_header.png" border="0" /> There are lots of places you can get help with Joomla!. In many places in your site administrator you will see the help icon. Click on this for more information about the options and functions of items on your screen. Other places to get help are:</p>\r\n<ul>\r\n<li><a href="http://forum.joomla.org">Support Forums</a></li>\r\n<li><a href="http://docs.joomla.org">Documentation</a></li>\r\n<li><a href="http://resources.joomla.org">Professionals</a></li>\r\n<li><a href="http://shop.joomla.org/amazoncom-bookstores.html">Books</a></li>\r\n</ul>', '', 1, 0, 0, 19, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-01-10 15:32:54', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_readmore":"","show_print_icon":"","show_email_icon":"","show_hits":"","page_title":"","alternative_readmore":"","layout":""}', 10, 0, 8, '', '', 1, 17, '', 0, '*', ''),
(22, 120, 'Getting Started', 'getting-started', '', '<p>It''s easy to get started creating your website. Knowing some of the basics will help.</p>\r\n<h3>What is a Content Management System?</h3>\r\n<p>A content management system is software that allows you to create and manage webpages easily by separating the creation of your content from the mechanics required to present it on the web.</p>\r\n<p>In this site, the content is stored in a <em>database</em>. The look and feel are created by a <em>template</em>. The Joomla! software brings together the template and the content to create web pages.</p>\r\n<h3>Site and Administrator</h3>\r\n<p>Your site actually has two separate sites. The site (also called the front end) is what visitors to your site will see. The administrator (also called the back end) is only used by people managing your site. You can access the administrator by clicking the "Site Administrator" link on the "This Site" menu or by adding /administrator to the end of you domain name.</p>\r\n<p>Log in to the administrator using the username and password created during the installation of Joomla.</p>\r\n<h3>Logging in</h3>\r\n<p>To login to the front end of your site use the login form or the login menu link on the "This Site" menu. Use the user name and password that were created as part of the installation process. Once logged-in you will be able to create and edit articles.</p>\r\n<p>In managing your site, you will be able to create content that only logged-in users are able to see.</p>\r\n<h3>Creating an article</h3>\r\n<p>Once you are logged-in, a new menu will be visible. To create a new article, click on the "submit article" link on that menu.</p>\r\n<p>The new article interface gives you a lot of options, but all you need to do is add a title and put something in the content area. To make it easy to find, set the state to published and put it in the Joomla category.</p>\r\n<div>You can edit an existing article by clicking on the edit icon (this only displays to users who have the right to edit).</div>\r\n<h3>Learn more</h3>\r\n<p>There is much more to learn about how to use Joomla! to create the web site you envision. You can learn much more at the <a href="http://docs.joomla.org">Joomla! documentation site</a> and on the<a href="http://forum.joomla.org"> Joomla! forums</a>.</p>', '', 1, 0, 0, 19, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-12-27 11:21:44', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 2, 0, 9, '', '', 1, 3, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(23, 121, 'Happy Orange Orchard', 'happy-orange-orchard', '', '<p>At our orchard we grow the world''s best oranges as well as other citrus fruit such as lemons and grapefruit. Our family has been tending this orchard for generations.</p>', '', 1, 0, 0, 30, '2011-01-01 00:00:01', 212, 'Fruit Shop Webmaster', '2011-01-01 00:00:01', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_readmore":"","show_print_icon":"","show_email_icon":"","show_hits":"","page_title":"","alternative_readmore":"","layout":""}', 1, 0, 2, '', '', 1, 0, '', 0, '*', ''),
(24, 122, 'Joomla!', 'joomla', '', '<p>Congratulations! You have a Joomla site! Joomla makes it easy to build a website just the way you want it and keep it simple to update and maintain.</p>\r\n<p>Joomla is a flexible and powerful platform, whether you are building a small site for yourself or a huge site with hundreds of thousands of visitors. Joomla is open source, which means you can make it work just the way you want it to.</p>', '', 1, 0, 0, 19, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-12-27 11:22:23', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 2, 0, 2, '', '', 1, 5, '{"robots":"","author":"","rights":"","xreference":""}', 1, '*', ''),
(25, 123, 'Koala', 'koala', '', '<p> </p>\r\n<p> </p>\r\n<p> </p>\r\n<p> </p>\r\n<p> </p>\r\n', '\r\n<p> </p>', 1, 0, 0, 72, '2011-01-01 00:00:01', 212, 'Parks Webmaster', '2012-01-17 05:15:00', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"images\\/sampledata\\/parks\\/animals\\/180px_koala_ag1.jpg","float_intro":"","image_intro_alt":"Koala  Thumbnail","image_intro_caption":"","image_fulltext":"images\\/sampledata\\/parks\\/animals\\/800px_koala_ag1.jpg","float_fulltext":"","image_fulltext_alt":"Koala Climbing Tree","image_fulltext_caption":"Source: http:\\/\\/commons.wikimedia.org\\/wiki\\/File:Koala-ag1.jpg Author: Arnaud Gaillard License: Creative Commons Share Alike Attribution Generic 1.0"}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 9, 0, 2, '', '', 1, 2, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(26, 124, 'Language Switcher', 'language-switcher', '', '<p>The language switcher module allows you to take advantage of the language tags that are available when content, modules and menu links are created.</p>\r\n<p>This module displays a list of available Content Languages for switching between them.</p>\r\n<p>When switching languages, it redirects to the Home page, or associated menu item, defined for the chosen language. Thereafter, the navigation will be the one defined for that language.</p>\r\n<p><strong>The language filter plugin must be enabled for this module to work properly.</strong></p>\r\n<p><strong></strong> <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Extensions_Module_Manager_Language_Switcher" title="Language Switcher Module">Help</a></p>\r\n<p>To view an example of the language switch moduler module, go to the site administrator and enable the language filter plugin and the language switcher module labelled "language switcher" and visit the fruit shop or park sample sites. Then follow<a href="http://docs.joomla.org/Language_Switcher_Tutorial_for_Joomla_1.6"> the instructions in this tutorial</a>.</p>', '', 1, 0, 0, 67, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-12-27 11:25:00', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 3, 0, 3, '', '', 1, 3, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', '');
INSERT INTO `jos_content` (`id`, `asset_id`, `title`, `alias`, `title_alias`, `introtext`, `fulltext`, `state`, `sectionid`, `mask`, `catid`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `checked_out`, `checked_out_time`, `publish_up`, `publish_down`, `images`, `urls`, `attribs`, `version`, `parentid`, `ordering`, `metakey`, `metadesc`, `access`, `hits`, `metadata`, `featured`, `language`, `xreference`) VALUES
(27, 125, 'Latest Articles Module', 'latest-articles-module', '', '<p>This module shows a list of the most recently published and current Articles. Some that are shown may have expired even though they are the most recent. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Extensions_Module_Manager_Latest_News" title="Latest Articles">Help</a></p>\r\n<div class="sample-module">{loadmodule articles_latest,Latest News}</div>', '', 1, 0, 0, 64, '2011-01-01 00:00:01', 212, '', '2011-12-27 11:25:41', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 9, 0, 1, 'modules, content', '', 1, 15, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(28, 126, 'Login Module', 'login-module', '', '<p>This module displays a username and password login form. It also displays a link to retrieve a forgotten password. If user registration is enabled (in the Global Configuration settings), another link will be shown to enable self-registration for users. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Extensions_Module_Manager_Login" title="Login">Help</a></p>\r\n<div class="sample-module">{loadmodule login,login}</div>', '', 1, 0, 0, 65, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-09-17 22:20:35', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_readmore":"","show_print_icon":"","show_email_icon":"","show_hits":"","page_title":"","alternative_readmore":"","layout":""}', 4, 0, 2, '', '', 1, 5, '', 0, '*', ''),
(29, 127, 'Menu Module', 'menu-module', '', '<p>This module displays a menu on the site (frontend).  Menus can be displayed in a wide variety of ways by using the menu options and css menu styles. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Extensions_Module_Manager_Menu">Help</a></p>\r\n<div class="sample-module">{loadmodule mod_menu,Menu Example}</div>', '', 1, 0, 0, 75, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-09-17 22:18:45', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_readmore":"","show_print_icon":"","show_email_icon":"","show_hits":"","page_title":"","alternative_readmore":"","layout":""}', 8, 0, 1, '', '', 1, 12, '', 0, '*', ''),
(30, 128, 'Most Read Content', 'most-read-content', '', '<p>This module shows a list of the currently published Articles which have the highest number of page views. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Extensions_Module_Manager_Most_Read" title="Most Read Content">Help</a></p>\r\n<div class="sample-module">{loadmodule articles_popular,Articles Most Read}</div>', '', 1, 0, 0, 64, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-12-27 11:26:41', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 6, 0, 2, 'modules, content', '', 1, 10, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(31, 129, 'News Flash', 'news-flash', '', '<p>Displays a set number of articles from a category based on date or random selection. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Extensions_Module_Manager_Articles_Newsflash" title="News Flash Module">Help</a></p>\r\n<div class="sample-module">{loadmodule articles_news,News Flash}</div>', '', 1, 0, 0, 64, '2011-01-01 00:00:01', 212, '', '2011-09-17 22:16:46', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","page_title":"","alternative_readmore":"","layout":""}', 4, 0, 3, 'modules, content', '', 1, 10, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(32, 130, 'Options', 'options', '', '<p>As you make your Joomla! site you will control the details of the display using <em>options</em> also referred to as <em>parameter</em><strong>s</strong>. Options control everything from whether the author''s name is displayed to who can view what to the number of items shown on a list.</p>\r\n<p>Default options for each component are changed using the Options button on the component toolbar.</p>\r\n<p>Options can also be set on an individual item, such as an article or contact and in menu links.</p>\r\n<p>If you are happy with how your site looks, it is fine to leave all of the options set to the defaults that were created when your site was installed. As you become more experienced with Joomla you will use options more.</p>\r\n<p> </p>', '', 1, 0, 0, 19, '2011-01-01 00:00:01', 212, 'Joomla!', '2012-01-17 16:21:24', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 4, 0, 10, '', '', 1, 3, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(33, 131, 'Phyllopteryx', 'phyllopteryx', '', '<p> </p>\r\n', '\r\n<p> </p>', 1, 0, 0, 72, '2011-01-01 00:00:01', 212, 'Parks Webmaster', '2012-01-17 04:57:58', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"images\\/sampledata\\/parks\\/animals\\/200px_phyllopteryx_taeniolatus1.jpg","float_intro":"","image_intro_alt":"Phyllopteryx","image_intro_caption":"","image_fulltext":"images\\/sampledata\\/parks\\/animals\\/800px_phyllopteryx_taeniolatus1.jpg","float_fulltext":"","image_fulltext_alt":"Phyllopteryx","image_fulltext_caption":"Source: http:\\/\\/en.wikipedia.org\\/wiki\\/File:Phyllopteryx_taeniolatus1.jpg Author: Richard Ling License: GNU Free Documentation License v 1.2 or later"}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 2, 0, 3, '', '', 1, 0, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(34, 132, 'Pinnacles', 'pinnacles', '', '<p> </p>\r\n', '\r\n<p> </p>', 1, 0, 0, 73, '2011-01-01 00:00:01', 212, 'Parks Webmaster', '2012-01-17 04:41:30', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"images\\/sampledata\\/parks\\/landscape\\/120px_pinnacles_western_australia.jpg","float_intro":"","image_intro_alt":"Kings Canyon","image_intro_caption":"","image_fulltext":"images\\/sampledata\\/parks\\/landscape\\/800px_pinnacles_western_australia.jpg","float_fulltext":"","image_fulltext_alt":"Kings Canyon","image_fulltext_caption":"Source: http:\\/\\/commons.wikimedia.org\\/wiki\\/File:Pinnacles_Western_Australia.jpg  Author: Martin Gloss  License: GNU Free Documentation license v 1.2 or later."}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 3, 0, 4, '', '', 1, 3, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(35, 133, 'Professionals', 'professionals', '', '<p>Joomla! 2.5 continues development of the Joomla Framework and CMS as a powerful and flexible way to bring your vision of the web to reality. With the administrator now fully MVC, the ability to control its look and the management of extensions is now complete.</p>\r\n', '\r\n<p>Working with multiple template styles and overrides for the same views, creating the design you want is easier than it has ever been. Limiting support to PHP 5.2.4 and above makes Joomla lighter and faster than ever. Languages files can now be overridden without having your changes lost during an upgrade.  With the proper xml your users update extensions with a single click.</p>\r\n<p>Access control lists are now incorporated using a new system developed for Joomla. The ACL system is designed with developers in mind, so it is easy to incorporate into your extensions. The new nested sets libraries allow you to incorporate infinitely deep categories but also to use nested sets in a variety of other ways.</p>\r\n<p>A new forms library makes creating all kinds of user interaction simple. MooTools 1.3 provides a highly flexible javascript framework that is a major advance over MooTools 1.0.</p>\r\n<p>New events throughout the core make integration of your plugins where you want them a snap.</p>\r\n<p>The separation of the Joomla! Platform project from the Joomla! CMS project makes continuous development of new, powerful APIs  and continuous improvement of existing APIs possible while maintaining the stability of the CMS that millions of webmasters and professionals rely upon.</p>\r\n<p>Learn about:</p>\r\n<ul>\r\n<li><a href="http://docs.joomla.org/What''s_new_in_Joomla_1.6">Changes since 1.5</a></li>\r\n<li><a href="http://docs.joomla.org/ACL_Tutorial_for_Joomla_1.6">Working with ACL</a></li>\r\n<li><a href="http://docs.joomla.org/API16:JCategories">Working with nested categories</a></li>\r\n<li><a href="http://docs.joomla.org/API16:JForm">Forms library</a></li>\r\n<li><a href="http://docs.joomla.org/Working_with_Mootools_1.3">Working with Mootools 1.3</a></li>\r\n<li><a href="http://docs.joomla.org/Layout_Overrides_in_Joomla_1.6">Using new features of the override system</a></li>\r\n<li><a href="http://api.joomla.org">Joomla! API</a></li>\r\n<li><a href="http://docs.joomla.org/API16:JDatabaseQuery">Using JDatabaseQuery</a></li>\r\n<li><a href="http://docs.joomla.org/What''s_new_in_Joomla_1.6#Events">New and updated events</a></li>\r\n<li><a href="http://docs.joomla.org/Xml-rpc_changes_in_Joomla!_1.6">Xmlrpc</a></li>\r\n<li><a href="http://docs.joomla.org/What''s_new_in_Joomla_1.6#Extension_management">Installing and updating extensions</a></li>\r\n<li><a href="http://docs.joomla.org/Setting_up_your_workstation_for_Joomla!_development">Setting up your development environment</a></li>\r\n<li><a href="github.com/joomla">The Joomla! Platform Repository</a> </li>\r\n</ul>', 1, 0, 0, 19, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-12-27 11:36:13', 0, 0, '0000-00-00 00:00:00', '2011-01-09 16:41:13', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 16, 0, 5, '', '', 1, 10, '{"robots":"","author":"","rights":"","xreference":""}', 1, '*', ''),
(36, 134, 'Random Image Module', 'random-image-module', '', '<p>This module displays a random image from your chosen image directory. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Extensions_Module_Manager_Random_Image" title="Random Image Module">Help</a></p>\r\n<div class="sample-module">{loadmodule random_image,Random Image}</div>', '', 1, 0, 0, 66, '2011-01-01 00:00:01', 212, '', '2012-01-17 16:11:13', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 6, 0, 4, '', '', 1, 6, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(37, 135, 'Related Items Module', 'related-items-module', '', '<p>This module displays other Articles that are related to the one currently being viewed. These relations are established by the Meta Keywords.  All the keywords of the current Article are searched against all the keywords of all other published articles. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Extensions_Module_Manager_Articles_Related" title="Related Items Module">Help</a></p>\r\n<div class="sample-module">{loadmodule related_items,Articles Related Items}</div>', '', 1, 0, 0, 64, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-12-27 11:37:34', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 5, 0, 4, 'modules, content', '', 1, 5, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(38, 136, 'Sample Sites', 'sample-sites', '', '<p>Your installation includes sample data, designed to show you some of the options you have for building your website. In addition to information about Joomla! there are two sample "sites within a site" designed to help you get started with building your own site.</p>\r\n<p>The first site is a simple site about <a href="index.php?Itemid=243">Australian Parks</a>. It shows how you can quickly and easily build a personal site with just the building blocks that are part of Joomla. It includes a personal blog, weblinks, and a very simple image gallery.</p>\r\n<p>The second site is slightly more complex and represents what you might do if you are building a site for a small business, in this case a <a href="index.php/welcome.html"></a><a href="index.php?Itemid=429">Fruit Shop</a>.</p>\r\n<p>In building either style site, or something completely different, you will probably want to add <a href="http://extensions.joomla.org">extensions</a> and either create or purchase your own template. Many Joomla users start by modifying the <a href="http://docs.joomla.org/How_do_you_modify_a_template%3F">templates</a> that come with the core distribution so that they include special images and other design elements that relate to their site''s focus.</p>', '', 1, 0, 0, 19, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-12-27 11:39:07', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 2, 0, 11, '', '', 1, 5, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(39, 137, 'Search', 'search-component', '', '<p>Joomla! 2.5 offers two search options.</p>\r\n<p>The Basic Search component provides basic search functionality for the information contained in your core components. Many extensions can also be searched by the search component. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Components_Search">Help</a></p>\r\n<p>The Smart Search component offers searching similar to that found in major search engines. Smart Search is disabled by default. If you choose to enable it you will need to take several steps. First, enable the Smart Search Plugin in the plugin manager. Then, if you are using the Basic Search Module replace it with the Smart Search Module. Finally, if you have already created content, go to the Smart Search component in your site administrator and click the Index icon. Once indexing of your content is complete, Smart Search will be ready to use. Help.</p>', '', 1, 0, 0, 21, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-12-27 11:41:48', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 4, 0, 3, '', '', 1, 3, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(40, 138, 'Search Module', 'search-module', '', '<p>This module will display a search box. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Extensions_Module_Manager_Search" title="Search">Help</a></p>\r\n<div class="sample-module">{loadmodule search,Search}</div>', '', 1, 0, 0, 67, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-09-17 22:35:56', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_readmore":"","show_print_icon":"","show_email_icon":"","show_hits":"","page_title":"","alternative_readmore":"","layout":""}', 4, 0, 4, '', '', 1, 6, '', 0, '*', ''),
(41, 139, 'Search ', 'search-plugin', '', '<p>The search component uses plugins to control which parts of your Joomla! site are searched. You may choose to turn off some areas to improve performance or for other reasons. Many third party Joomla! extensions have search plugins that extend where search takes place.</p>\r\n<p>Default On:</p>\r\n<ul>\r\n<li>Content <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit#Search_-_Content">Help</a></li>\r\n<li>Contacts <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit#Search_-_Contacts">Help</a></li>\r\n<li>Weblinks <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit#Search_-_Weblinks">Help</a></li>\r\n<li>News Feeds <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit#Search_-_Newsfeeds">Help</a></li>\r\n<li>Categories <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit#Search_-_Categories">Help</a></li>\r\n</ul>', '', 1, 0, 0, 25, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-09-06 06:13:18', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_readmore":"","show_print_icon":"","show_email_icon":"","show_hits":"","page_title":"","alternative_readmore":"","layout":""}', 3, 0, 1, '', '', 1, 0, '', 0, '*', ''),
(42, 140, 'Site Map', 'site-map', '', '<p>{loadposition sitemapload}</p><p><em>By putting all of your content into nested categories you can give users and search engines access to everything using a menu.</em></p>', '', 1, 0, 0, 14, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-01-01 00:00:01', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_readmore":"","show_print_icon":"","show_email_icon":"","show_hits":"","page_title":"","alternative_readmore":"","layout":""}', 1, 0, 1, '', '', 1, 0, '', 0, '*', ''),
(43, 141, 'Spotted Quoll', 'spotted-quoll', '', '<p> </p>\r\n<p> </p>\r\n', '\r\n<p> </p>', 1, 0, 0, 72, '2011-01-01 00:00:01', 212, 'Parks Webmaster', '2012-01-17 05:02:58', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"images\\/sampledata\\/parks\\/animals\\/220px_spottedquoll_2005_seanmcclean.jpg","float_intro":"","image_intro_alt":"Spotted Quoll","image_intro_caption":"","image_fulltext":"images\\/sampledata\\/parks\\/animals\\/789px_spottedquoll_2005_seanmcclean.jpg","float_fulltext":"","image_fulltext_alt":"Spotted Quoll","image_fulltext_caption":"Source: http:\\/\\/en.wikipedia.org\\/wiki\\/File:SpottedQuoll_2005_SeanMcClean.jpg Author: Sean McClean License: GNU Free Documentation License v 1.2 or later"}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 4, 0, 4, '', '', 1, 0, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(44, 142, 'Statistics Module', 'statistics', '', '<p>This module shows information about your server installation together with statistics on the Web site users, number of Articles in your database and the number of Web links you provide.</p>\r\n<div class="sample-module">{loadmodule mod_stats,Statistics}</div>', '', 1, 0, 0, 67, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-12-27 11:43:25', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 6, 0, 5, '', '', 1, 5, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(45, 143, 'Syndicate Module', 'syndicate-module', '', '<p>The syndicate module will display a link that allows users to take a feed from your site. It will only display on pages for which feeds are possible. That means it will not display on single article, contact or weblinks pages, such as this one. <a href="http://docs.joomla.org/Help15:Screen.modulessite.edit.15#Syndicate" title="Synicate Module">Help</a></p>\r\n<div class="sample-module">{loadposition syndicate,Syndicate}</div>', '', 1, 0, 0, 67, '2011-01-01 00:00:01', 212, '', '2011-12-27 11:44:16', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 3, 0, 6, '', '', 1, 2, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(46, 144, 'System', 'system', '', '<p>System plugins operate every time a page on your site loads. They control such things as your URLS, whether users can check a "remember me" box on the login module, and whether caching is enabled. New is the redirect plugin that together with the redirect component will assist you in managing changes in URLs.</p>\r\n<p>Default on:</p>\r\n<ul>\r\n<li>Remember me <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit#System_-_Remember_Me">Help</a></li>\r\n<li>SEF <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit#System_-_SEF">Help</a></li>\r\n<li>Debug <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit#System_-_Debug">Help</a></li>\r\n</ul>\r\n<p>Default off:</p>\r\n<ul>\r\n<li>Cache <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit#System_-_Cache">Help</a></li>\r\n<li>Log <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit#System_-_Log">Help</a></li>\r\n<li>Redirect <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit#System_-_Redirect">Help</a></li>\r\n</ul>', '', 1, 0, 0, 25, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-12-27 11:45:54', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 5, 0, 2, '', '', 1, 1, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(47, 145, 'The Joomla! Community', 'the-joomla-community', '', '<p>Joomla means All Together, and it is a community of people all working and having fun together that makes Joomla possible. Thousands of people each year participate in the Joomla community, and we hope you will be one of them.</p>\r\n<p>People with all kinds of skills, of all skill levels and from around the world are welcome to join in. Participate in the <a href="http://joomla.org">Joomla.org</a> family of websites (the<a href="http://forum.joomla.org"> forum </a>is a great place to start). Come to a <a href="http://community.joomla.org/events.html">Joomla! event</a>. Join or start a <a href="http://community.joomla.org/user-groups.html">Joomla! Users Group</a>. Whether you are a developer, site administrator, designer, end user or fan, there are ways for you to participate and contribute.</p>', '', 1, 0, 0, 19, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-12-27 11:47:56', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 3, 0, 3, '', '', 1, 0, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(48, 146, 'The Joomla! Project', 'the-joomla-project', '', '<p>The Joomla Project consists of all of the people who make and support the Joomla Web Platform and Content Management System.</p>\r\n<p>Our mission is to provide a flexible platform for digital publishing and collaboration.</p>\r\n<p>The core values are:</p>\r\n<ul>\r\n<li>Freedom</li>\r\n<li>Equality</li>\r\n<li>Trust</li>\r\n<li>Community</li>\r\n<li>Collaboration</li>\r\n<li>Usability</li>\r\n</ul>\r\n<p>In our vision, we see:</p>\r\n<ul>\r\n<li>People publishing and collaborating in their communities and around the world</li>\r\n<li>Software that is free, secure, and high-quality</li>\r\n<li>A community that is enjoyable and rewarding to participate in</li>\r\n<li>People around the world using their preferred languages</li>\r\n<li>A project that acts autonomously</li>\r\n<li>A project that is socially responsible</li>\r\n<li>A project dedicated to maintaining the trust of its users</li>\r\n</ul>\r\n<p>There are millions of users around the world and thousands of people who contribute to the Joomla Project. They work in three main groups: the Production Working Group, responsible for everything that goes into software and documentation; the Community Working Group, responsible for creating a nurturing the community; and Open Source Matters, the non profit organization responsible for managing legal, financial and organizational issues.</p>\r\n<p>Joomla is a free and open source project, which uses the GNU General Public License version 2 or later.</p>', '', 1, 0, 0, 19, '2011-01-01 00:00:01', 212, '', '2011-12-27 11:47:48', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 2, 0, 1, '', '', 1, 1, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(49, 147, 'Typography', 'typography', '', '<h1>H1 ABCDEFGHIJKLMNOPQRSTUVWXYZ abcdefghijklmonpqrstuvwzyz</h1><h2>H2 ABCDEFGHIJKLMNOPQRSTUVWXYZ abcdefghijklmonpqrstuvwzyz</h2><h3>H3 ABCDEFGHIJKLMNOPQRSTUVWXYZ abcdefghijklmonpqrstuvwzyz</h3><h4>H4 ABCDEFGHIJKLMNOPQRSTUVWXYZ abcdefghijklmonpqrstuvwzyz</h4><h5>H5 ABCDEFGHIJKLMNOPQRSTUVWXYZ abcdefghijklmonpqrstuvwzyz</h5><h6>H6 ABCDEFGHIJKLMNOPQRSTUVWXYZ abcdefghijklmonpqrstuvwzyz</h6><p>P The quick brown fox ran over the lazy dog. THE QUICK BROWN FOX RAN OVER THE LAZY DOG.</p><ul><li>Item</li><li>Item</li><li>Item<br /> <ul><li>Item</li><li>Item</li><li>Item<br /> <ul><li>Item</li><li>Item</li><li>Item</li></ul></li></ul></li></ul><ol><li>tem</li><li>Item</li><li>Item<br /> <ol><li>Item</li><li>Item</li><li>Item<br /><ol><li>Item</li><li>Item</li><li>Item</li></ol></li></ol> </li></ol>', '', 1, 0, 0, 23, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-01-01 00:00:01', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_readmore":"","show_print_icon":"","show_email_icon":"","show_hits":"","page_title":"","alternative_readmore":"","layout":""}', 1, 0, 1, '', '', 1, 0, '', 0, '*', ''),
(50, 148, 'Upgraders', 'upgraders', '', '<p>If you are an experienced Joomla! 1.5 user, this Joomla site will seem very familiar. There are new templates and improved user interfaces, but most functionality is the same. The biggest changes are improved access control (ACL) and nested categories. This release of Joomla has strong continuity with Joomla! 1.7 while adding enhancements.</p>\r\n', '\r\n<p>The new user manager will let you manage who has access to what in your site. You can leave access groups exactly the way you had them in Joomla 1.5 or make them as complicated as you want. You can learn more about<a href="http://docs.joomla.org/ACL_Tutorial_for_Joomla_1.6"> how access control works</a> in on the <a href="http://docs.joomla.org">Joomla! Documentation site</a></p>\r\n<p>In Joomla 1.5 and 1.0 content was organized into sections and categories. From 1.6 forward sections are gone, and you can create categories within categories, going as deep as you want. The sample data provides many examples of the use of nested categories.</p>\r\n<p>All layouts have been redesigned to improve accessibility and flexibility. </p>\r\n<p>Updating your site and extensions when needed is easier than ever thanks to installer improvements.</p>\r\n<p> </p>', 1, 0, 0, 19, '2011-01-01 00:00:01', 212, '', '2012-01-17 04:28:10', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 5, 0, 6, '', '', 1, 3, '{"robots":"","author":"","rights":"","xreference":""}', 1, '*', ''),
(51, 149, 'User', 'user-plugins', '', '<p>Default on:</p>\r\n<ul>\r\n<li>Joomla <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit#User_-_Joomla.21">Help</a></li>\r\n</ul>\r\n<p>Default off:</p>\r\n<p>Two new plugins are available but are disabled by default.</p>\r\n<ul>\r\n<li>Contact Creator <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit#User_-_Contact_Creator">Help</a><br />Creates a new linked contact record for each new user created.</li>\r\n<li>Profile <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit#User_-_Profile">Help</a><br />This example profile plugin allows you to insert additional fields into user registration and profile display. This is intended as an example of the types of extensions to the profile you might want to create.</li>\r\n</ul>', '', 1, 0, 0, 25, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-12-27 11:51:25', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 3, 0, 4, '', '', 1, 0, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(52, 150, 'Users', 'users-component', '', '<p>The users extension lets your site visitors register, login and logout, change their passwords and other information, and recover lost passwords. In the administrator it allows you to create, block and manage users and create user groups and access levels. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Users_User_Manager">Help</a></p>\r\n<p>Please note that some of the user views will not display if you are not logged-in to the site.</p>', '', 1, 0, 0, 21, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-01-10 04:52:55', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":""}', 2, 0, 5, '', '', 1, 1, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(53, 151, 'Using Joomla!', 'using-joomla', '', '<p>With Joomla you can create anything from a simple personal website to a complex ecommerce or social site with millions of visitors.</p>\r\n<p>This section of the sample data provides you with a brief introduction to Joomla concepts and reference material to help you understand how Joomla works.</p>\r\n<p><em>When you no longer need the sample data, you can can simply unpublish the sample data category found within each extension in the site administrator or you may completely delete each item and all of the categories. </em></p>', '', 1, 0, 0, 19, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-12-27 11:52:45', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 2, 0, 7, '', '', 1, 9, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(54, 152, 'Weblinks', 'weblinks', '', '<p>Weblinks (com_weblinks) is a component that provides a structured way to organize external links and present them in a visually attractive, consistent and informative way. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Components_Weblinks_Links">Help</a></p>', '', 1, 0, 0, 21, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-01-10 04:20:10', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":""}', 2, 0, 6, '', '', 1, 3, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(55, 153, 'Weblinks Module', 'weblinks-module', '', '<p>This module displays the list of weblinks in a category. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Extensions_Module_Manager_Weblinks" title="Weblinks Module">Help</a></p>\r\n<div class="sample-module">{loadmodule weblinks,Weblinks}</div>', '', 1, 0, 0, 66, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-09-17 22:32:10', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_readmore":"","show_print_icon":"","show_email_icon":"","show_hits":"","page_title":"","alternative_readmore":"","layout":""}', 7, 0, 5, '', '', 1, 23, '', 0, '*', ''),
(56, 154, 'Who''s Online', 'whos-online', '', '<p>The Who''s Online Module displays the number of Anonymous Users (e.g. Guests) and Registered Users (ones logged-in) that are currently accessing the Web site. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Extensions_Module_Manager_Who_Online" title="Who''s Online">Help</a></p>\r\n<div class="sample-module">{loadmodule whosonline,Who''s Online}</div>', '', 1, 0, 0, 65, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-09-17 22:19:45', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_readmore":"","show_print_icon":"","show_email_icon":"","show_hits":"","page_title":"","alternative_readmore":"","layout":""}', 4, 0, 1, '', '', 1, 5, '', 0, '*', '');
INSERT INTO `jos_content` (`id`, `asset_id`, `title`, `alias`, `title_alias`, `introtext`, `fulltext`, `state`, `sectionid`, `mask`, `catid`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `checked_out`, `checked_out_time`, `publish_up`, `publish_down`, `images`, `urls`, `attribs`, `version`, `parentid`, `ordering`, `metakey`, `metadesc`, `access`, `hits`, `metadata`, `featured`, `language`, `xreference`) VALUES
(57, 155, 'Wobbegone', 'wobbegone', '', '<p> </p>\r\n', '\r\n<p> </p>', 1, 0, 0, 72, '2011-01-01 00:00:01', 212, 'Parks Webmaster', '2012-01-17 05:01:59', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"images\\/sampledata\\/parks\\/animals\\/180px_wobbegong.jpg","float_intro":"","image_intro_alt":"Wobbegon","image_intro_caption":"","image_fulltext":"images\\/sampledata\\/parks\\/animals\\/800px_wobbegong.jpg","float_fulltext":"","image_fulltext_alt":"Wobbegon","image_fulltext_caption":"Source: http:\\/\\/en.wikipedia.org\\/wiki\\/File:Wobbegong.jpg Author: Richard Ling Rights: GNU Free Documentation License v 1.2 or later"}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 2, 0, 1, '', '', 1, 0, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(58, 156, 'Wonderful Watermelon', 'wonderful-watermelon', '', '<p>Watermelon is a wonderful and healthy treat. We grow the world''s sweetest watermelon. We have the largest watermelon patch in our country.</p>', '', 1, 0, 0, 30, '2011-01-01 00:00:01', 212, 'Fruit Shop Webmaster', '2011-01-01 00:00:01', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_readmore":"","show_print_icon":"","show_email_icon":"","show_hits":"","page_title":"","alternative_readmore":"","layout":""}', 1, 0, 1, '', '', 1, 0, '', 0, '*', ''),
(59, 157, 'Wrapper Module', 'wrapper-module', '', '<p>This module shows an iFrame window to specified location. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Extensions_Module_Manager_Wrapper" title="Wrapper Module">Help</a></p>\r\n<div class="sample-module">{loadmodule wrapper,Wrapper}</div>', '', 1, 0, 0, 67, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-09-17 22:35:00', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_readmore":"","show_print_icon":"","show_email_icon":"","show_hits":"","page_title":"","alternative_readmore":"","layout":""}', 8, 0, 1, '', '', 1, 15, '', 0, '*', ''),
(60, 158, 'News Feeds', 'news-feeds', '', '<p>News Feeds (com_newsfeeds) provides a way to organize and present news feeds. News feeds are a way that you present information from another site on your site. For example, the joomla.org website has numerous feeds that you can incorporate on your site. You an use menus to present a single feed, a list of feeds in a category, or a list of all feed categories. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Components_Newsfeeds_Feeds">Help</a></p>', '', 1, 0, 0, 21, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-12-27 11:27:31', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 3, 0, 4, '', '', 1, 2, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(61, 159, 'Breadcrumbs Module', 'breadcrumbs-module', '', '<p>Breadcrumbs provide a pathway for users to navigate through the site. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Extensions_Module_Manager_Breadcrumbs" title="Breacrumbs Module">Help</a></p>\r\n<div class="sample-module">{loadmodule breadcrumbs,breadcrumbs}</div>', '', 1, 0, 0, 75, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-09-17 22:10:19', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":""}', 5, 0, 2, '', '', 1, 9, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(62, 160, 'Content', 'content-plugins', '', '<p>Content plugins run when specific kinds of pages are loaded. They do things ranging from protecting email addresses from harvesters to creating page breaks.</p>\r\n<p>Default on:</p>\r\n<ul>\r\n<li>Email Cloaking <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit#Content_-_Email_Cloaking">Help</a></li>\r\n<li>Load Module <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit#Content_-_Load_Modules">Help</a></li>\r\n<li>Page Break <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit#Content_-_Pagebreak">Help</a></li>\r\n<li>Page Navigation<a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit#Content_-_Page_Navigation"> Help</a></li>\r\n<li>Vote <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit#Content_-_Vote">Help</a></li>\r\n</ul>\r\n<p>Default off:</p>\r\n<ul>\r\n<li>Code Highlighter (GeSHi) <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit#Content_-_Code_Highlighter_.28GeSHi.29">Help</a></li>\r\n</ul>', '', 1, 0, 0, 25, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-09-06 06:11:50', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_readmore":"","show_print_icon":"","show_email_icon":"","show_hits":"","page_title":"","alternative_readmore":"","layout":""}', 2, 0, 7, '', '', 1, 1, '', 0, '*', ''),
(64, 162, 'Blue Mountain Rain Forest', 'blue-mountain-rain-forest', '', '<p> </p>\r\n', '\r\n<p> </p>', 1, 0, 0, 73, '2011-01-01 00:00:01', 212, 'Parks Webmaster', '2012-01-17 04:36:30', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"images\\/sampledata\\/parks\\/landscape\\/120px_rainforest_bluemountainsnsw.jpg","float_intro":"none","image_intro_alt":"Rain Forest Blue Mountains","image_intro_caption":"","image_fulltext":"images\\/sampledata\\/parks\\/landscape\\/727px_rainforest_bluemountainsnsw.jpg","float_fulltext":"","image_fulltext_alt":"Rain Forest Blue Mountains","image_fulltext_caption":"Source: http:\\/\\/commons.wikimedia.org\\/wiki\\/File:Rainforest,bluemountainsNSW.jpg Author: Adam J.W.C. License: GNU Free Documentation License"}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 4, 0, 2, '', '', 1, 3, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(65, 163, 'Ormiston Pound', 'ormiston-pound', '', '<p> </p>\r\n', '\r\n<p> </p>', 1, 0, 0, 73, '2011-01-01 00:00:01', 212, 'Parks Webmaster', '2012-01-17 04:51:33', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '{"image_intro":"images\\/sampledata\\/parks\\/landscape\\/180px_ormiston_pound.jpg","float_intro":"none","image_intro_alt":"Ormiston Pound","image_intro_caption":"","image_fulltext":"images\\/sampledata\\/parks\\/landscape\\/800px_ormiston_pound.jpg","float_fulltext":"","image_fulltext_alt":"Ormiston Pound","image_fulltext_caption":"Source: http:\\/\\/commons.wikimedia.org\\/wiki\\/File:Ormiston_Pound.JPG Author: License: GNU Free Public Documentation License"}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 5, 0, 3, '', '', 1, 1, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(66, 165, 'Latest Users Module', 'latest-users-module', '', '<p>This module displays the latest registered users. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help16:Extensions_Module_Manager_Latest_Users">Help</a></p>\r\n<div class="sample-module">{loadmodule users_latest,Users Latest}</div>', '', 1, 0, 0, 65, '2011-01-01 00:00:01', 212, 'Joomla!', '2011-09-17 22:21:05', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"1","link_titles":"","show_intro":"","show_category":"1","link_category":"1","show_parent_category":"","link_parent_category":"","show_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_readmore":"","show_print_icon":"","show_email_icon":"","show_hits":"","page_title":"","alternative_readmore":"","layout":""}', 4, 0, 3, '', '', 1, 6, '', 0, '*', ''),
(67, 168, 'What''s New in 1.5?', 'whats-new-in-15', '', '<p>This article deliberately archived as an example.</p><p>As with previous releases, Joomla! provides a unified and easy-to-use framework for delivering content for Web sites of all kinds. To support the changing nature of the Internet and emerging Web technologies, Joomla! required substantial restructuring of its core functionality and we also used this effort to simplify many challenges within the current user interface. Joomla! 1.5 has many new features.</p>\r\n<p style="margin-bottom: 0in;">In Joomla! 1.5, you''''ll notice:</p>\r\n<ul>\r\n<li>Substantially improved usability, manageability, and scalability far beyond the original Mambo foundations</li>\r\n<li>Expanded accessibility to support internationalisation, double-byte characters and right-to-left support for Arabic, Farsi, and Hebrew languages among others</li>\r\n<li>Extended integration of external applications through Web services</li>\r\n<li>Enhanced content delivery, template and presentation capabilities to support accessibility standards and content delivery to any destination</li>\r\n<li>A more sustainable and flexible framework for Component and Extension developers</li>\r\n<li>Backward compatibility with previous releases of Components, Templates, Modules, and other Extensions</li>\r\n</ul>', '', 2, 0, 0, 9, '2011-01-01 00:00:01', 212, 'Joomla! 1.5', '2011-01-01 00:00:01', 0, 0, '0000-00-00 00:00:00', '2011-01-01 00:00:01', '0000-00-00 00:00:00', '', '', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_readmore":"","show_print_icon":"","show_email_icon":"","show_hits":"","page_title":"","alternative_readmore":"","layout":""}', 1, 0, 4, '', '', 1, 0, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(68, 170, 'Captcha', 'captcha', '', '<p>The Captcha plugins are used to prevent spam submissions on your forms such as registration, contact and login. You basic installation of Joomla includes one Captcha plugin which leverages the ReCaptcha® service but you may install other plugins connecting to different Captcha systems.</p>\r\n<p>Default on:</p>\r\n<ul>\r\n<li>ReCaptcha <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit">help</a></li>\r\n</ul>\r\n<p>Note: ReCaptcha is a the trademark of Google Inc. and is an independent product not associated with or endorsed by the Joomla Project. You will need to register and agree to the Terms of Service at Recaptcha.net to use this plugin. Complete instructions are available if you edit the ReCaptcha plugin in the Plugin Manager.</p>', '', 1, 0, 0, 25, '2012-01-17 03:20:45', 212, 'Joomla!', '2012-01-17 03:35:46', 0, 0, '0000-00-00 00:00:00', '2012-01-17 03:20:45', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 2, 0, 1, '', '', 1, 0, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(69, 171, 'Quick Icons', 'quick-icons', '', '<p> The Quick Icon plugin group is used to provide notification that updates to Joomla! or installed extensions are available and should be applied. These notifications display on your administrator control panel, which is the page you see when you first log in to your site administrator.</p>\r\n<p>Default on:</p>\r\n<ul>\r\n<li>Quick icon - Joomla! extensions updates notification <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit">Help</a>.</li>\r\n<li>Quick icon - Joomla! update notification <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help17:Extensions_Plugin_Manager_Edit">Help</a></li>\r\n</ul>', '', 1, 0, 0, 25, '2012-01-17 03:27:39', 212, 'Joomla!', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2012-01-17 03:27:39', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 1, 0, 0, '', '', 1, 0, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(70, 170, 'Smart Search', 'smart-search', '', '<p>This module provides search using the Smart Search component. You should only use it if you have indexed your content and either have enabled the Smart Search content plugin or are keeping the index of your site updated manually. <a href="http://help.joomla.org/proxy/index.php?option=com_help&amp;amp;keyref=Help25:Extensions_Module_Manager_Smart_Search">Help</a>.</p>\r\n<div class="sample-module">{loadmodule finder,Smart Search}</div>', '', 1, 0, 0, 67, '2012-01-17 03:42:36', 212, '', '2012-01-17 16:15:48', 0, 0, '0000-00-00 00:00:00', '2012-01-17 03:42:36', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":"","urlatext":"","targeta":"","urlb":"","urlbtext":"","targetb":"","urlc":"","urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 10, 0, 0, '', '', 1, 13, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(71, 176, 'About Us', 'about', '', '<div class="about">\r\n		<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</h2> \r\n		\r\n		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n		\r\n		\r\n		<p class="p1-top">Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n		\r\n		<ul>\r\n		<li><strong>Lorem ipsum dolor sit amet, consectetur</strong> adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in.</li>\r\n		\r\n		\r\n		<li><strong>Dolor sit amet, consectetur</strong> adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in.</li>\r\n		\r\n		</ul>	\r\n		\r\n		<p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui.</p>\r\n</div>', '', 1, 0, 0, 9, '2012-08-07 07:56:27', 212, 'Fruit Shop Webmaster', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2012-08-07 07:56:27', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":null,"urlatext":"","targeta":"","urlb":null,"urlbtext":"","targetb":"","urlc":null,"urlctext":"","targetc":""}', '{"show_title":"1","link_titles":"0","show_intro":"0","show_category":"0","link_category":"0","show_parent_category":"0","link_parent_category":"0","show_author":"0","link_author":"0","show_create_date":"0","show_modify_date":"0","show_publish_date":"0","show_item_navigation":"0","show_icons":"0","show_print_icon":"0","show_email_icon":"0","show_vote":"0","show_hits":"0","show_noauth":"0","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 1, 0, 3, '', '', 1, 69, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(72, 177, 'Delivery', 'delivery', '', '<div class="delivery">\r\n		<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt </h2> \r\n		\r\n		<ul>\r\n		<li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in.</li>\r\n		\r\n		\r\n		<li>Adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in.</li>\r\n\r\n\r\n               <li>Eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in.</li>\r\n		\r\n		</ul>	\r\n		\r\n\r\n                 <h2>Consectetur adipisicing elit, sed do eiusmod tempor incididunt </h2> \r\n		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in.</p>\r\n</div>', '', 1, 0, 0, 9, '2012-08-07 07:56:27', 212, 'Fruit Shop Webmaster', '2012-08-07 07:58:39', 0, 0, '0000-00-00 00:00:00', '2012-08-07 07:56:27', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":null,"urlatext":"","targeta":"","urlb":null,"urlbtext":"","targetb":"","urlc":null,"urlctext":"","targetc":""}', '{"show_title":"1","link_titles":"0","show_intro":"0","show_category":"0","link_category":"0","show_parent_category":"0","link_parent_category":"0","show_author":"0","link_author":"0","show_create_date":"0","show_modify_date":"0","show_publish_date":"0","show_item_navigation":"0","show_icons":"0","show_print_icon":"0","show_email_icon":"0","show_vote":"0","show_hits":"0","show_noauth":"0","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 2, 0, 2, '', '', 1, 38, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(73, 178, 'FAQS', 'frequently-asked-questions', '', '<div class="FAQS">\r\n<h2>frequently asked questions </h2>\r\n<dl id="accordion">\r\n					  <dt><span><div class="bg"><div class="wrapper">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo?</span></div></div></dt>\r\n					  <dd>\r\n						 <div class="indent">\r\n                                                     \r\n							\r\n							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in.</p>\r\n						\r\n						 </div>\r\n					  </dd>\r\n					<dt><span><div class="bg"><div class="wrapper">Consectetur adipisicing elit, sed do eiusmod tempo?</span></div></div></dt>\r\n					  <dd>\r\n						 <div class="indent">\r\n							\r\n							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in.</p>\r\n							\r\n						 </div>\r\n					  </dd>\r\n					  <dt><span><div class="bg"><div class="wrapper">Dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo?</span></div></div></dt>\r\n						  <dd>\r\n							 <div class="indent">\r\n								\r\n								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in.</p>\r\n								\r\n							 </div>\r\n						  </dd>\r\n						  <dt><span><div class="bg"><div class="wrapper">Deltricies pharetra magna. Donec accumsan malesuada orc ater ports eren mate?</span></div></div></dt>\r\n						  <dd>\r\n							 <div class="indent">\r\n								\r\n								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in.</p>\r\n								\r\n							 </div>\r\n						  </dd>\r\n						  <dt><span><div class="bg"><div class="wrapper">set magna  dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo?</span></div></div></dt>\r\n						  <dd>\r\n							 <div class="indent">\r\n								\r\n								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in.</p>\r\n								\r\n							 </div>\r\n						  </dd>\r\n						  <dt><span><div class="bg"><div class="wrapper">Set onsectetur adipisicing elit, sed do eiusmod tempo?</span></div></div></dt>\r\n						  <dd>\r\n							 <div class="indent">\r\n								\r\n								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in.</p>\r\n							 </div>\r\n						  </dd>\r\n				</dl>\r\n</div>', '', 1, 0, 0, 9, '2012-08-07 07:56:27', 0, 'Fruit Shop Webmaster', '2012-08-07 08:00:34', 0, 0, '0000-00-00 00:00:00', '2012-08-07 07:56:27', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":null,"urlatext":"","targeta":"","urlb":null,"urlbtext":"","targetb":"","urlc":null,"urlctext":"","targetc":""}', '{"show_title":"1","link_titles":"0","show_intro":"0","show_category":"0","link_category":"0","show_parent_category":"0","link_parent_category":"0","show_author":"0","link_author":"0","show_create_date":"0","show_modify_date":"0","show_publish_date":"0","show_item_navigation":"0","show_icons":"0","show_print_icon":"0","show_email_icon":"0","show_vote":"0","show_hits":"0","show_noauth":"0","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 2, 0, 1, '', '', 1, 44, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(74, 182, 'Template Settings', 'template-settings', '', '<div class="template_settings">\r\n<table id="mod_table">\r\n<tr class="modules row-fluid">\r\n			<td class="span3"><b>Name Modules</b></td>\r\n	\r\n			<td class="span4">\r\n				<b>Modules settings</b>\r\n			</td>\r\n			<td class="span5">\r\n				<b>Info</b>\r\n			</td>\r\n		</tr>\r\n	<tr class="modules row-fluid">\r\n		<td class="span3"><b>1</b> - Currencies:</td>\r\n\r\n		<td class="span4">\r\n			<ul>\r\n				<li><b>Type:</b> mod_virtuemart_currencies</li>\r\n				<li><b>Position:</b> user5</li>\r\n				<li><b>Class Suffix:</b> </li>\r\n				<li><b>Show Title:</b> yes</li>\r\n				<li><b>Order:</b> 1</li>				\r\n			</ul>\r\n		</td>\r\n		<td class="span5">\r\n			<ul>\r\n				<li><b>Pages:</b> All</li>\r\n				<li><b>Additional info:</b><br /> &nbsp;</li>\r\n			</ul>\r\n		</td>\r\n	</tr>\r\n	<tr class="modules row-fluid">\r\n		<td class="span3"><b>2</b> - Footer</td>\r\n\r\n		<td class="span4">\r\n			<ul>\r\n				<li><b>Type:</b> mod_footer</li>\r\n				<li><b>Position:</b> footer</li>\r\n				<li><b>Class Suffix:</b> </li>\r\n				<li><b>Show Title:</b> no</li>\r\n				<li><b>Order:</b> 2</li>				\r\n			</ul>\r\n		</td>\r\n		<td class="span5">\r\n			<ul>\r\n				<li><b>Pages:</b> All</li>\r\n				<li><b>Additional info:</b><br /> &nbsp;</li>\r\n			</ul>\r\n		</td>\r\n	</tr>\r\n	<tr class="modules row-fluid">\r\n		<td class="span3"><b>3</b> - Breadcrumbs Advanced</td>\r\n\r\n		<td class="span4">\r\n			<ul>\r\n				<li><b>Type:</b> mod_breadcrumbs_advanced</li>\r\n				<li><b>Position:</b> syndicate</li>\r\n				<li><b>Class Suffix:</b> _Breadcrumbs</li>\r\n				<li><b>Show Title:</b> no</li>\r\n				<li><b>Order:</b> 1</li>				\r\n			</ul>\r\n		</td>\r\n		<td class="span5">\r\n			<ul>\r\n				<li><b>Pages:</b> Online Store<br />Home<br />Manufacturer Default Layout<br />List Orders<br />User Edit Address<br />Display Vendor contact<br />Category Layout</li>\r\n				<li><b>Additional info:</b><br /> sources/packages/mod_breadcrumbs_advanced_j17.zip</li>\r\n			</ul>\r\n		</td>\r\n	</tr>\r\n	<tr class="modules row-fluid">\r\n		<td class="span3"><b>4</b> - Google Map </td>\r\n\r\n		<td class="span4">\r\n			<ul>\r\n				<li><b>Type:</b> mod_JGMap</li>\r\n				<li><b>Position:</b> right</li>\r\n				<li><b>Class Suffix:</b> _map</li>\r\n				<li><b>Show Title:</b> yes</li>\r\n				<li><b>Order:</b> 1</li>				\r\n			</ul>\r\n		</td>\r\n		<td class="span5">\r\n			<ul>\r\n				<li><b>Pages:</b> Contacts</li>\r\n				<li><b>Additional info:</b><br /> sources/packages/mod_JGMap(1.6)-0.15.5.zip</li>\r\n			</ul>\r\n		</td>\r\n	</tr>\r\n	<tr class="modules row-fluid">\r\n		<td class="span3"><b>5</b> - The Company Name</td>\r\n\r\n		<td class="span4">\r\n			<ul>\r\n				<li><b>Type:</b> mod_custom</li>\r\n				<li><b>Position:</b> left</li>\r\n				<li><b>Class Suffix:</b> _address</li>\r\n				<li><b>Show Title:</b> yes</li>\r\n				<li><b>Order:</b> 3</li>				\r\n			</ul>\r\n		</td>\r\n		<td class="span5">\r\n			<ul>\r\n				<li><b>Pages:</b> Contacts</li>\r\n				<li><b>Additional info:</b><br /> sources/The Company Name.html</li>\r\n			</ul>\r\n		</td>\r\n	</tr>\r\n	<tr class="modules row-fluid">\r\n		<td class="span3"><b>6</b> - Slideshow CK</td>\r\n\r\n		<td class="span4">\r\n			<ul>\r\n				<li><b>Type:</b> mod_slideshowck</li>\r\n				<li><b>Position:</b> user8</li>\r\n				<li><b>Class Suffix:</b> _slider</li>\r\n				<li><b>Show Title:</b> no</li>\r\n				<li><b>Order:</b> 1</li>				\r\n			</ul>\r\n		</td>\r\n		<td class="span5">\r\n			<ul>\r\n				<li><b>Pages:</b> Home<br />Home</li>\r\n				<li><b>Additional info:</b><br /> sources/packages/mod_slideshowck.zip</li>\r\n			</ul>\r\n		</td>\r\n	</tr>\r\n	<tr class="modules row-fluid">\r\n		<td class="span3"><b>7</b> - VirtueMart Ajax Search</td>\r\n\r\n		<td class="span4">\r\n			<ul>\r\n				<li><b>Type:</b> mod_vm_ajax_search</li>\r\n				<li><b>Position:</b> user4</li>\r\n				<li><b>Class Suffix:</b> _ajax_search</li>\r\n				<li><b>Show Title:</b> no</li>\r\n				<li><b>Order:</b> 1</li>				\r\n			</ul>\r\n		</td>\r\n		<td class="span5">\r\n			<ul>\r\n				<li><b>Pages:</b> All</li>\r\n				<li><b>Additional info:</b><br /> sources/packages/mod_vm_ajax_search_for_vm2.zip</li>\r\n			</ul>\r\n		</td>\r\n	</tr>\r\n	<tr class="modules row-fluid">\r\n		<td class="span3"><b>8</b> - Top_menu</td>\r\n\r\n		<td class="span4">\r\n			<ul>\r\n				<li><b>Type:</b> mod_superfish_menu</li>\r\n				<li><b>Position:</b> user3</li>\r\n				<li><b>Class Suffix:</b> </li>\r\n				<li><b>Show Title:</b> no</li>\r\n				<li><b>Order:</b> 2</li>				\r\n			</ul>\r\n		</td>\r\n		<td class="span5">\r\n			<ul>\r\n				<li><b>Pages:</b> All</li>\r\n				<li><b>Additional info:</b><br /> sources/packages/mod_superfish_menu_v2.1.zip</li>\r\n			</ul>\r\n		</td>\r\n	</tr>\r\n	<tr class="modules row-fluid">\r\n		<td class="span3"><b>9</b> - Shopping  cart:</td>\r\n\r\n		<td class="span4">\r\n			<ul>\r\n				<li><b>Type:</b> mod_virtuemart_cart_tm</li>\r\n				<li><b>Position:</b> user6</li>\r\n				<li><b>Class Suffix:</b> }</li>\r\n				<li><b>Show Title:</b> no</li>\r\n				<li><b>Order:</b> 1</li>				\r\n			</ul>\r\n		</td>\r\n		<td class="span5">\r\n			<ul>\r\n				<li><b>Pages:</b> All</li>\r\n				<li><b>Additional info:</b><br /> sources/mod_virtuemart_cart_tm.zip</li>\r\n			</ul>\r\n		</td>\r\n	</tr>\r\n	<tr class="modules row-fluid">\r\n		<td class="span3"><b>10</b> - Featured products</td>\r\n\r\n		<td class="span4">\r\n			<ul>\r\n				<li><b>Type:</b> mod_virtuemart_product</li>\r\n				<li><b>Position:</b> user2</li>\r\n				<li><b>Class Suffix:</b> new</li>\r\n				<li><b>Show Title:</b> yes</li>\r\n				<li><b>Order:</b> 1</li>				\r\n			</ul>\r\n		</td>\r\n		<td class="span5">\r\n			<ul>\r\n				<li><b>Pages:</b> Home<br />Home</li>\r\n				<li><b>Additional info:</b><br /> sources/mod_virtuemart_product.zip</li>\r\n			</ul>\r\n		</td>\r\n	</tr>\r\n	<tr class="modules row-fluid">\r\n		<td class="span3"><b>11</b> - Categories</td>\r\n\r\n		<td class="span4">\r\n			<ul>\r\n				<li><b>Type:</b> mod_virtuemart_category</li>\r\n				<li><b>Position:</b> left</li>\r\n				<li><b>Class Suffix:</b>  categories</li>\r\n				<li><b>Show Title:</b> no</li>\r\n				<li><b>Order:</b> 1</li>				\r\n			</ul>\r\n		</td>\r\n		<td class="span5">\r\n			<ul>\r\n				<li><b>Pages:</b> All</li>\r\n				<li><b>Additional info:</b><br /> </li>\r\n			</ul>\r\n		</td>\r\n	</tr>\r\n	<tr class="modules row-fluid">\r\n		<td class="span3"><b>12</b> - brands</td>\r\n\r\n		<td class="span4">\r\n			<ul>\r\n				<li><b>Type:</b> mod_virtuemart_manufacturer</li>\r\n				<li><b>Position:</b> left</li>\r\n				<li><b>Class Suffix:</b>  manufacturers</li>\r\n				<li><b>Show Title:</b> yes</li>\r\n				<li><b>Order:</b> 1</li>				\r\n			</ul>\r\n		</td>\r\n		<td class="span5">\r\n			<ul>\r\n				<li><b>Pages:</b> About Us<br />Online Store<br />Delivery<br />FAQs<br />Manufacturer Default Layout<br />List Orders<br />User Edit Address<br />Display Vendor contact<br />Category Layout<br />About joomla!<br />Wrappers<br />Reviews<br />News<br />Create an Account<br />Advanced Search<br />Order History<br />Shipping & Returns<br />Group Sales<br />Search pages<br />Template Settings</li>\r\n				<li><b>Additional info:</b><br /> sources/packages/mod_virtuemart_manufacturer.zip</li>\r\n			</ul>\r\n		</td>\r\n	</tr>\r\n	<tr class="modules row-fluid">\r\n		<td class="span3"><b>13</b> - System menu</td>\r\n\r\n		<td class="span4">\r\n			<ul>\r\n				<li><b>Type:</b> mod_menu</li>\r\n				<li><b>Position:</b> settings</li>\r\n				<li><b>Class Suffix:</b> settings</li>\r\n				<li><b>Show Title:</b> no</li>\r\n				<li><b>Order:</b> 1</li>				\r\n			</ul>\r\n		</td>\r\n		<td class="span5">\r\n			<ul>\r\n				<li><b>Pages:</b> All</li>\r\n				<li><b>Additional info:</b><br /> &nbsp;</li>\r\n			</ul>\r\n		</td>\r\n	</tr>\r\n	<tr class="modules row-fluid">\r\n		<td class="span3"><b>14</b> - Banner</td>\r\n\r\n		<td class="span4">\r\n			<ul>\r\n				<li><b>Type:</b> mod_bannersblock</li>\r\n				<li><b>Position:</b> new</li>\r\n				<li><b>Class Suffix:</b> banner_bot}</li>\r\n				<li><b>Show Title:</b> no</li>\r\n				<li><b>Order:</b> 1</li>				\r\n			</ul>\r\n		</td>\r\n		<td class="span5">\r\n			<ul>\r\n				<li><b>Pages:</b> Home<br />Home</li>\r\n				<li><b>Additional info:</b><br /> sources/mod_bannersblock.zip</li>\r\n			</ul>\r\n		</td>\r\n	</tr>\r\n	<tr class="modules row-fluid">\r\n		<td class="span3"><b>15</b> - Banner bot</td>\r\n\r\n		<td class="span4">\r\n			<ul>\r\n				<li><b>Type:</b> mod_bannersblock</li>\r\n				<li><b>Position:</b> new_bot</li>\r\n				<li><b>Class Suffix:</b> banner_bot2}</li>\r\n				<li><b>Show Title:</b> no</li>\r\n				<li><b>Order:</b> 1</li>				\r\n			</ul>\r\n		</td>\r\n		<td class="span5">\r\n			<ul>\r\n				<li><b>Pages:</b> Home<br />Home</li>\r\n				<li><b>Additional info:</b><br /> sources/mod_bannersblock.zip</li>\r\n			</ul>\r\n		</td>\r\n	</tr>\r\n	<tr class="modules row-fluid">\r\n		<td class="span3"><b>16</b> - Custom HTML</td>\r\n\r\n		<td class="span4">\r\n			<ul>\r\n				<li><b>Type:</b> mod_custom</li>\r\n				<li><b>Position:</b> user9</li>\r\n				<li><b>Class Suffix:</b> Custom</li>\r\n				<li><b>Show Title:</b> no</li>\r\n				<li><b>Order:</b> 1</li>				\r\n			</ul>\r\n		</td>\r\n		<td class="span5">\r\n			<ul>\r\n				<li><b>Pages:</b> Home<br />Home</li>\r\n				<li><b>Additional info:</b><br /> sources/Custom HTML.html</li>\r\n			</ul>\r\n		</td>\r\n	</tr></table>\r\n</div>', '', 1, 0, 0, 9, '2013-11-08 12:10:08', 382, '', '2014-08-04 12:51:10', 42, 0, '0000-00-00 00:00:00', '2013-11-08 12:10:08', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"0","show_intro":"","show_category":"0","link_category":"0","show_parent_category":"0","link_parent_category":"0","show_author":"0","link_author":"0","show_create_date":"0","show_modify_date":"0","show_publish_date":"0","show_item_navigation":"0","show_icons":"0","show_print_icon":"0","show_email_icon":"0","show_vote":"0","show_hits":"0","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 24, 0, 0, '', '', 1, 42, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', '');

-- --------------------------------------------------------

--
-- Table structure for table `jos_content_frontpage`
--

DROP TABLE IF EXISTS `jos_content_frontpage`;
CREATE TABLE `jos_content_frontpage` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_content_frontpage`
--

INSERT INTO `jos_content_frontpage` (`content_id`, `ordering`) VALUES
(8, 2),
(24, 1),
(35, 4),
(50, 3);

-- --------------------------------------------------------

--
-- Table structure for table `jos_content_rating`
--

DROP TABLE IF EXISTS `jos_content_rating`;
CREATE TABLE `jos_content_rating` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `rating_sum` int(10) unsigned NOT NULL DEFAULT '0',
  `rating_count` int(10) unsigned NOT NULL DEFAULT '0',
  `lastip` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jos_core_log_searches`
--

DROP TABLE IF EXISTS `jos_core_log_searches`;
CREATE TABLE `jos_core_log_searches` (
  `search_term` varchar(128) NOT NULL DEFAULT '',
  `hits` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jos_extensions`
--

DROP TABLE IF EXISTS `jos_extensions`;
CREATE TABLE `jos_extensions` (
  `extension_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `element` varchar(100) NOT NULL,
  `folder` varchar(100) NOT NULL,
  `client_id` tinyint(3) NOT NULL,
  `enabled` tinyint(3) NOT NULL DEFAULT '1',
  `access` int(10) unsigned NOT NULL DEFAULT '1',
  `protected` tinyint(3) NOT NULL DEFAULT '0',
  `manifest_cache` text NOT NULL,
  `params` text NOT NULL,
  `custom_data` text NOT NULL,
  `system_data` text NOT NULL,
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) DEFAULT '0',
  `state` int(11) DEFAULT '0',
  PRIMARY KEY (`extension_id`),
  KEY `element_clientid` (`element`,`client_id`),
  KEY `element_folder_clientid` (`element`,`folder`,`client_id`),
  KEY `extension` (`type`,`element`,`folder`,`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10109 ;

--
-- Dumping data for table `jos_extensions`
--

INSERT INTO `jos_extensions` (`extension_id`, `name`, `type`, `element`, `folder`, `client_id`, `enabled`, `access`, `protected`, `manifest_cache`, `params`, `custom_data`, `system_data`, `checked_out`, `checked_out_time`, `ordering`, `state`) VALUES
(1, 'com_mailto', 'component', 'com_mailto', '', 0, 1, 1, 1, '{"legacy":false,"name":"com_mailto","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_MAILTO_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(2, 'com_wrapper', 'component', 'com_wrapper', '', 0, 1, 1, 1, '{"legacy":false,"name":"com_wrapper","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_WRAPPER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(3, 'com_admin', 'component', 'com_admin', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_admin","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_ADMIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(4, 'com_banners', 'component', 'com_banners', '', 1, 1, 1, 0, '{"legacy":false,"name":"com_banners","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_BANNERS_XML_DESCRIPTION","group":""}', '{"purchase_type":"3","track_impressions":"0","track_clicks":"0","metakey_prefix":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(5, 'com_cache', 'component', 'com_cache', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_cache","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_CACHE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(6, 'com_categories', 'component', 'com_categories', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_categories","type":"component","creationDate":"December 2007","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_CATEGORIES_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(7, 'com_checkin', 'component', 'com_checkin', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_checkin","type":"component","creationDate":"Unknown","author":"Joomla! Project","copyright":"(C) 2005 - 2008 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_CHECKIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(8, 'com_contact', 'component', 'com_contact', '', 1, 1, 1, 0, '{"legacy":false,"name":"com_contact","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_CONTACT_XML_DESCRIPTION","group":""}', '{"show_contact_category":"hide","show_contact_list":"0","presentation_style":"sliders","show_name":"1","show_position":"1","show_email":"0","show_street_address":"1","show_suburb":"1","show_state":"1","show_postcode":"1","show_country":"1","show_telephone":"1","show_mobile":"1","show_fax":"1","show_webpage":"1","show_misc":"1","show_image":"1","image":"","allow_vcard":"0","show_articles":"0","show_profile":"0","show_links":"0","linka_name":"","linkb_name":"","linkc_name":"","linkd_name":"","linke_name":"","contact_icons":"0","icon_address":"","icon_email":"","icon_telephone":"","icon_mobile":"","icon_fax":"","icon_misc":"","show_headings":"1","show_position_headings":"1","show_email_headings":"0","show_telephone_headings":"1","show_mobile_headings":"0","show_fax_headings":"0","allow_vcard_headings":"0","show_suburb_headings":"1","show_state_headings":"1","show_country_headings":"1","show_email_form":"1","show_email_copy":"1","banned_email":"","banned_subject":"","banned_text":"","validate_session":"1","custom_reply":"0","redirect":"","show_category_crumb":"0","metakey":"","metadesc":"","robots":"","author":"","rights":"","xreference":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(9, 'com_cpanel', 'component', 'com_cpanel', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_cpanel","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_CPANEL_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10, 'com_installer', 'component', 'com_installer', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_installer","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_INSTALLER_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(11, 'com_languages', 'component', 'com_languages', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_languages","type":"component","creationDate":"2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_LANGUAGES_XML_DESCRIPTION","group":""}', '{"administrator":"en-GB","site":"en-GB"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(12, 'com_login', 'component', 'com_login', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_login","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_LOGIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(13, 'com_media', 'component', 'com_media', '', 1, 1, 0, 1, '{"legacy":false,"name":"com_media","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_MEDIA_XML_DESCRIPTION","group":""}', '{"upload_extensions":"bmp,csv,doc,gif,ico,jpg,jpeg,odg,odp,ods,odt,pdf,png,ppt,swf,txt,xcf,xls,BMP,CSV,DOC,GIF,ICO,JPG,JPEG,ODG,ODP,ODS,ODT,PDF,PNG,PPT,SWF,TXT,XCF,XLS","upload_maxsize":"10","file_path":"images","image_path":"images","restrict_uploads":"1","allowed_media_usergroup":"3","check_mime":"1","image_extensions":"bmp,gif,jpg,png","ignore_extensions":"","upload_mime":"image\\/jpeg,image\\/gif,image\\/png,image\\/bmp,application\\/x-shockwave-flash,application\\/msword,application\\/excel,application\\/pdf,application\\/powerpoint,text\\/plain,application\\/x-zip","upload_mime_illegal":"text\\/html","enable_flash":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(14, 'com_menus', 'component', 'com_menus', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_menus","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_MENUS_XML_DESCRIPTION","group":""}', '{"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(15, 'com_messages', 'component', 'com_messages', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_messages","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_MESSAGES_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(16, 'com_modules', 'component', 'com_modules', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_modules","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_MODULES_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(17, 'com_newsfeeds', 'component', 'com_newsfeeds', '', 1, 1, 1, 0, '{"legacy":false,"name":"com_newsfeeds","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_NEWSFEEDS_XML_DESCRIPTION","group":""}', '{"show_feed_image":"1","show_feed_description":"1","show_item_description":"1","feed_word_count":"0","show_headings":"1","show_name":"1","show_articles":"0","show_link":"1","show_description":"1","show_description_image":"1","display_num":"","show_pagination_limit":"1","show_pagination":"1","show_pagination_results":"1","show_cat_items":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(18, 'com_plugins', 'component', 'com_plugins', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_plugins","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_PLUGINS_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(19, 'com_search', 'component', 'com_search', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_search","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_SEARCH_XML_DESCRIPTION","group":""}', '{"enabled":"0","show_date":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(20, 'com_templates', 'component', 'com_templates', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_templates","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_TEMPLATES_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(21, 'com_weblinks', 'component', 'com_weblinks', '', 1, 1, 1, 0, '{"legacy":false,"name":"com_weblinks","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_WEBLINKS_XML_DESCRIPTION","group":""}', '{"show_comp_description":"1","comp_description":"","show_link_hits":"1","show_link_description":"1","show_other_cats":"0","show_headings":"0","show_numbers":"0","show_report":"1","count_clicks":"1","target":"0","link_icons":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(22, 'com_content', 'component', 'com_content', '', 1, 1, 0, 1, '{"legacy":false,"name":"com_content","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_CONTENT_XML_DESCRIPTION","group":""}', '{"article_layout":"_:default","show_title":"1","link_titles":"1","show_intro":"1","show_category":"1","link_category":"1","show_parent_category":"0","link_parent_category":"0","show_author":"1","link_author":"0","show_create_date":"0","show_modify_date":"0","show_publish_date":"1","show_item_navigation":"1","show_vote":"0","show_readmore":"1","show_readmore_title":"1","readmore_limit":"100","show_icons":"1","show_print_icon":"1","show_email_icon":"1","show_hits":"1","show_noauth":"0","show_publishing_options":"1","show_article_options":"1","show_urls_images_frontend":"0","show_urls_images_backend":"1","targeta":0,"targetb":0,"targetc":0,"float_intro":"left","float_fulltext":"left","category_layout":"_:blog","show_category_title":"0","show_description":"0","show_description_image":"0","maxLevel":"1","show_empty_categories":"0","show_no_articles":"1","show_subcat_desc":"1","show_cat_num_articles":"0","show_base_description":"1","maxLevelcat":"-1","show_empty_categories_cat":"0","show_subcat_desc_cat":"1","show_cat_num_articles_cat":"1","num_leading_articles":"1","num_intro_articles":"4","num_columns":"2","num_links":"4","multi_column_order":"0","show_subcategory_content":"0","show_pagination_limit":"1","filter_field":"hide","show_headings":"1","list_show_date":"0","date_format":"","list_show_hits":"1","list_show_author":"1","orderby_pri":"order","orderby_sec":"rdate","order_date":"published","show_pagination":"2","show_pagination_results":"1","show_feed_link":"1","feed_summary":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(23, 'com_config', 'component', 'com_config', '', 1, 1, 0, 1, '{"legacy":false,"name":"com_config","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_CONFIG_XML_DESCRIPTION","group":""}', '{"filters":{"1":{"filter_type":"NH","filter_tags":"","filter_attributes":""},"6":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"7":{"filter_type":"NONE","filter_tags":"","filter_attributes":""},"2":{"filter_type":"NH","filter_tags":"","filter_attributes":""},"3":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"4":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"5":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"8":{"filter_type":"NONE","filter_tags":"","filter_attributes":""}}}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(24, 'com_redirect', 'component', 'com_redirect', '', 1, 1, 0, 1, '{"legacy":false,"name":"com_redirect","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_REDIRECT_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(25, 'com_users', 'component', 'com_users', '', 1, 1, 0, 1, '{"legacy":false,"name":"com_users","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_USERS_XML_DESCRIPTION","group":""}', '{"allowUserRegistration":"1","new_usertype":"2","useractivation":"1","frontend_userparams":"1","mailSubjectPrefix":"","mailBodySuffix":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(27, 'com_finder', 'component', 'com_finder', '', 1, 1, 0, 0, '{"legacy":false,"name":"com_finder","type":"component","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2012 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_FINDER_XML_DESCRIPTION","group":""}', '{"show_description":"1","description_length":255,"allow_empty_query":"0","show_url":"1","show_advanced":"1","expand_advanced":"0","show_date_filters":"0","highlight_terms":"1","opensearch_name":"","opensearch_description":"","batch_size":"50","memory_table_limit":30000,"title_multiplier":"1.7","text_multiplier":"0.7","meta_multiplier":"1.2","path_multiplier":"2.0","misc_multiplier":"0.3","stemmer":"snowball"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(28, 'com_joomlaupdate', 'component', 'com_joomlaupdate', '', 1, 1, 0, 1, '{"legacy":false,"name":"com_joomlaupdate","type":"component","creationDate":"February 2012","author":"Joomla! Project","copyright":"(C) 2005 - 2012 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_JOOMLAUPDATE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(100, 'PHPMailer', 'library', 'phpmailer', '', 0, 1, 1, 1, '{"legacy":false,"name":"PHPMailer","type":"library","creationDate":"2001","author":"PHPMailer","copyright":"(c) 2001-2003, Brent R. Matzelle, (c) 2004-2009, Andy Prevost. All Rights Reserved., (c) 2010-2011, Jim Jagielski. All Rights Reserved.","authorEmail":"jimjag@gmail.com","authorUrl":"https:\\/\\/code.google.com\\/a\\/apache-extras.org\\/p\\/phpmailer\\/","version":"5.2","description":"LIB_PHPMAILER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(101, 'SimplePie', 'library', 'simplepie', '', 0, 1, 1, 1, '{"legacy":false,"name":"SimplePie","type":"library","creationDate":"2004","author":"SimplePie","copyright":"Copyright (c) 2004-2009, Ryan Parman and Geoffrey Sneddon","authorEmail":"","authorUrl":"http:\\/\\/simplepie.org\\/","version":"1.2","description":"LIB_SIMPLEPIE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(102, 'phputf8', 'library', 'phputf8', '', 0, 1, 1, 1, '{"legacy":false,"name":"phputf8","type":"library","creationDate":"2006","author":"Harry Fuecks","copyright":"Copyright various authors","authorEmail":"hfuecks@gmail.com","authorUrl":"http:\\/\\/sourceforge.net\\/projects\\/phputf8","version":"0.5","description":"LIB_PHPUTF8_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(103, 'Joomla! Platform', 'library', 'joomla', '', 0, 1, 1, 1, '{"legacy":false,"name":"Joomla! Platform","type":"library","creationDate":"2008","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"http:\\/\\/www.joomla.org","version":"11.4","description":"LIB_JOOMLA_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(200, 'mod_articles_archive', 'module', 'mod_articles_archive', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_articles_archive","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters.\\n\\t\\tAll rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_ARTICLES_ARCHIVE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(201, 'mod_articles_latest', 'module', 'mod_articles_latest', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_articles_latest","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_LATEST_NEWS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(202, 'mod_articles_popular', 'module', 'mod_articles_popular', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_articles_popular","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_POPULAR_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(203, 'mod_banners', 'module', 'mod_banners', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_banners","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_BANNERS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(204, 'mod_breadcrumbs', 'module', 'mod_breadcrumbs', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_breadcrumbs","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_BREADCRUMBS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(205, 'mod_custom', 'module', 'mod_custom', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_custom","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_CUSTOM_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(206, 'mod_feed', 'module', 'mod_feed', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_feed","type":"module","creationDate":"July 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_FEED_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(207, 'mod_footer', 'module', 'mod_footer', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_footer","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_FOOTER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(208, 'mod_login', 'module', 'mod_login', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_login","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_LOGIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(209, 'mod_menu', 'module', 'mod_menu', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_menu","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_MENU_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(210, 'mod_articles_news', 'module', 'mod_articles_news', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_articles_news","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_ARTICLES_NEWS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(211, 'mod_random_image', 'module', 'mod_random_image', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_random_image","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_RANDOM_IMAGE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(212, 'mod_related_items', 'module', 'mod_related_items', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_related_items","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_RELATED_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(213, 'mod_search', 'module', 'mod_search', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_search","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_SEARCH_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(214, 'mod_stats', 'module', 'mod_stats', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_stats","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_STATS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(215, 'mod_syndicate', 'module', 'mod_syndicate', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_syndicate","type":"module","creationDate":"May 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_SYNDICATE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(216, 'mod_users_latest', 'module', 'mod_users_latest', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_users_latest","type":"module","creationDate":"December 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_USERS_LATEST_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(217, 'mod_weblinks', 'module', 'mod_weblinks', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_weblinks","type":"module","creationDate":"July 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_WEBLINKS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(218, 'mod_whosonline', 'module', 'mod_whosonline', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_whosonline","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_WHOSONLINE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(219, 'mod_wrapper', 'module', 'mod_wrapper', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_wrapper","type":"module","creationDate":"October 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_WRAPPER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(220, 'mod_articles_category', 'module', 'mod_articles_category', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_articles_category","type":"module","creationDate":"February 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_ARTICLES_CATEGORY_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(221, 'mod_articles_categories', 'module', 'mod_articles_categories', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_articles_categories","type":"module","creationDate":"February 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_ARTICLES_CATEGORIES_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(222, 'mod_languages', 'module', 'mod_languages', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_languages","type":"module","creationDate":"February 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_LANGUAGES_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(223, 'mod_finder', 'module', 'mod_finder', '', 0, 1, 0, 0, '{"legacy":false,"name":"mod_finder","type":"module","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2012 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_FINDER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(300, 'mod_custom', 'module', 'mod_custom', '', 1, 1, 1, 1, '{"legacy":false,"name":"mod_custom","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_CUSTOM_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(301, 'mod_feed', 'module', 'mod_feed', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_feed","type":"module","creationDate":"July 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_FEED_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(302, 'mod_latest', 'module', 'mod_latest', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_latest","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_LATEST_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(303, 'mod_logged', 'module', 'mod_logged', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_logged","type":"module","creationDate":"January 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_LOGGED_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(304, 'mod_login', 'module', 'mod_login', '', 1, 1, 1, 1, '{"legacy":false,"name":"mod_login","type":"module","creationDate":"March 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_LOGIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(305, 'mod_menu', 'module', 'mod_menu', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_menu","type":"module","creationDate":"March 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_MENU_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(307, 'mod_popular', 'module', 'mod_popular', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_popular","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_POPULAR_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(308, 'mod_quickicon', 'module', 'mod_quickicon', '', 1, 1, 1, 1, '{"legacy":false,"name":"mod_quickicon","type":"module","creationDate":"Nov 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_QUICKICON_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(309, 'mod_status', 'module', 'mod_status', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_status","type":"module","creationDate":"Feb 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_STATUS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(310, 'mod_submenu', 'module', 'mod_submenu', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_submenu","type":"module","creationDate":"Feb 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_SUBMENU_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(311, 'mod_title', 'module', 'mod_title', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_title","type":"module","creationDate":"Nov 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_TITLE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(312, 'mod_toolbar', 'module', 'mod_toolbar', '', 1, 1, 1, 1, '{"legacy":false,"name":"mod_toolbar","type":"module","creationDate":"Nov 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_TOOLBAR_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(313, 'mod_multilangstatus', 'module', 'mod_multilangstatus', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_multilangstatus","type":"module","creationDate":"September 2011","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_MULTILANGSTATUS_XML_DESCRIPTION","group":""}', '{"cache":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(314, 'mod_version', 'module', 'mod_version', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_version","type":"module","creationDate":"January 2012","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2012 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_VERSION_XML_DESCRIPTION","group":""}', '{"format":"short","product":"1","cache":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(400, 'plg_authentication_gmail', 'plugin', 'gmail', 'authentication', 0, 0, 1, 0, '{"legacy":false,"name":"plg_authentication_gmail","type":"plugin","creationDate":"February 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_GMAIL_XML_DESCRIPTION","group":""}', '{"applysuffix":"0","suffix":"","verifypeer":"1","user_blacklist":""}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(401, 'plg_authentication_joomla', 'plugin', 'joomla', 'authentication', 0, 1, 1, 1, '{"legacy":false,"name":"plg_authentication_joomla","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_AUTH_JOOMLA_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(402, 'plg_authentication_ldap', 'plugin', 'ldap', 'authentication', 0, 0, 1, 0, '{"legacy":false,"name":"plg_authentication_ldap","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_LDAP_XML_DESCRIPTION","group":""}', '{"host":"","port":"389","use_ldapV3":"0","negotiate_tls":"0","no_referrals":"0","auth_method":"bind","base_dn":"","search_string":"","users_dn":"","username":"admin","password":"bobby7","ldap_fullname":"fullName","ldap_email":"mail","ldap_uid":"uid"}', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(404, 'plg_content_emailcloak', 'plugin', 'emailcloak', 'content', 0, 1, 1, 0, '{"legacy":false,"name":"plg_content_emailcloak","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_CONTENT_EMAILCLOAK_XML_DESCRIPTION","group":""}', '{"mode":"1"}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(405, 'plg_content_geshi', 'plugin', 'geshi', 'content', 0, 0, 1, 0, '{"legacy":false,"name":"plg_content_geshi","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"","authorUrl":"qbnz.com\\/highlighter","version":"2.5.0","description":"PLG_CONTENT_GESHI_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(406, 'plg_content_loadmodule', 'plugin', 'loadmodule', 'content', 0, 1, 1, 0, '{"legacy":false,"name":"plg_content_loadmodule","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_LOADMODULE_XML_DESCRIPTION","group":""}', '{"style":"xhtml"}', '', '', 0, '2011-09-18 15:22:50', 0, 0),
(407, 'plg_content_pagebreak', 'plugin', 'pagebreak', 'content', 0, 1, 1, 1, '{"legacy":false,"name":"plg_content_pagebreak","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_CONTENT_PAGEBREAK_XML_DESCRIPTION","group":""}', '{"title":"1","multipage_toc":"1","showall":"1"}', '', '', 0, '0000-00-00 00:00:00', 4, 0),
(408, 'plg_content_pagenavigation', 'plugin', 'pagenavigation', 'content', 0, 1, 1, 1, '{"legacy":false,"name":"plg_content_pagenavigation","type":"plugin","creationDate":"January 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_PAGENAVIGATION_XML_DESCRIPTION","group":""}', '{"position":"1"}', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(409, 'plg_content_vote', 'plugin', 'vote', 'content', 0, 1, 1, 1, '{"legacy":false,"name":"plg_content_vote","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_VOTE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 6, 0),
(410, 'plg_editors_codemirror', 'plugin', 'codemirror', 'editors', 0, 1, 1, 1, '{"legacy":false,"name":"plg_editors_codemirror","type":"plugin","creationDate":"28 March 2011","author":"Marijn Haverbeke","copyright":"","authorEmail":"N\\/A","authorUrl":"","version":"1.0","description":"PLG_CODEMIRROR_XML_DESCRIPTION","group":""}', '{"linenumbers":"0","tabmode":"indent"}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(411, 'plg_editors_none', 'plugin', 'none', 'editors', 0, 1, 1, 1, '{"legacy":false,"name":"plg_editors_none","type":"plugin","creationDate":"August 2004","author":"Unknown","copyright":"","authorEmail":"N\\/A","authorUrl":"","version":"2.5.0","description":"PLG_NONE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(412, 'plg_editors_tinymce', 'plugin', 'tinymce', 'editors', 0, 1, 1, 1, '{"legacy":false,"name":"plg_editors_tinymce","type":"plugin","creationDate":"2005-2013","author":"Moxiecode Systems AB","copyright":"Moxiecode Systems AB","authorEmail":"N\\/A","authorUrl":"tinymce.moxiecode.com\\/","version":"3.5.4.1","description":"PLG_TINY_XML_DESCRIPTION","group":""}', '{"mode":"1","skin":"0","entity_encoding":"raw","lang_mode":"0","lang_code":"en","text_direction":"ltr","content_css":"1","content_css_custom":"","relative_urls":"1","newlines":"0","invalid_elements":"script,applet,iframe","extended_elements":"","toolbar":"top","toolbar_align":"left","html_height":"550","html_width":"750","resizing":"true","resize_horizontal":"false","element_path":"1","fonts":"1","paste":"1","searchreplace":"1","insertdate":"1","format_date":"%Y-%m-%d","inserttime":"1","format_time":"%H:%M:%S","colors":"1","table":"1","smilies":"1","media":"1","hr":"1","directionality":"1","fullscreen":"1","style":"1","layer":"1","xhtmlxtras":"1","visualchars":"1","nonbreaking":"1","template":"1","blockquote":"1","wordcount":"1","advimage":"1","advlink":"1","advlist":"1","autosave":"1","contextmenu":"1","inlinepopups":"1","custom_plugin":"","custom_button":""}', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(413, 'plg_editors-xtd_article', 'plugin', 'article', 'editors-xtd', 0, 1, 1, 1, '{"legacy":false,"name":"plg_editors-xtd_article","type":"plugin","creationDate":"October 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_ARTICLE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(414, 'plg_editors-xtd_image', 'plugin', 'image', 'editors-xtd', 0, 1, 1, 0, '{"legacy":false,"name":"plg_editors-xtd_image","type":"plugin","creationDate":"August 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_IMAGE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(415, 'plg_editors-xtd_pagebreak', 'plugin', 'pagebreak', 'editors-xtd', 0, 1, 1, 0, '{"legacy":false,"name":"plg_editors-xtd_pagebreak","type":"plugin","creationDate":"August 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_EDITORSXTD_PAGEBREAK_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(416, 'plg_editors-xtd_readmore', 'plugin', 'readmore', 'editors-xtd', 0, 1, 1, 0, '{"legacy":false,"name":"plg_editors-xtd_readmore","type":"plugin","creationDate":"March 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_READMORE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 4, 0),
(417, 'plg_search_categories', 'plugin', 'categories', 'search', 0, 1, 1, 0, '{"legacy":false,"name":"plg_search_categories","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_SEARCH_CATEGORIES_XML_DESCRIPTION","group":""}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(418, 'plg_search_contacts', 'plugin', 'contacts', 'search', 0, 1, 1, 0, '{"legacy":false,"name":"plg_search_contacts","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_SEARCH_CONTACTS_XML_DESCRIPTION","group":""}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(419, 'plg_search_content', 'plugin', 'content', 'search', 0, 1, 1, 0, '{"legacy":false,"name":"plg_search_content","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_SEARCH_CONTENT_XML_DESCRIPTION","group":""}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(420, 'plg_search_newsfeeds', 'plugin', 'newsfeeds', 'search', 0, 1, 1, 0, '{"legacy":false,"name":"plg_search_newsfeeds","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_SEARCH_NEWSFEEDS_XML_DESCRIPTION","group":""}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(421, 'plg_search_weblinks', 'plugin', 'weblinks', 'search', 0, 1, 1, 0, '{"legacy":false,"name":"plg_search_weblinks","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_SEARCH_WEBLINKS_XML_DESCRIPTION","group":""}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(422, 'plg_system_languagefilter', 'plugin', 'languagefilter', 'system', 0, 0, 1, 1, '{"legacy":false,"name":"plg_system_languagefilter","type":"plugin","creationDate":"July 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_SYSTEM_LANGUAGEFILTER_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(423, 'plg_system_p3p', 'plugin', 'p3p', 'system', 0, 1, 1, 1, '{"legacy":false,"name":"plg_system_p3p","type":"plugin","creationDate":"September 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_P3P_XML_DESCRIPTION","group":""}', '{"headers":"NOI ADM DEV PSAi COM NAV OUR OTRo STP IND DEM"}', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(424, 'plg_system_cache', 'plugin', 'cache', 'system', 0, 0, 1, 1, '{"legacy":false,"name":"plg_system_cache","type":"plugin","creationDate":"February 2007","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_CACHE_XML_DESCRIPTION","group":""}', '{"browsercache":"0","cachetime":"15"}', '', '', 0, '0000-00-00 00:00:00', 12, 0),
(425, 'plg_system_debug', 'plugin', 'debug', 'system', 0, 1, 1, 0, '{"legacy":false,"name":"plg_system_debug","type":"plugin","creationDate":"December 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_DEBUG_XML_DESCRIPTION","group":""}', '{"profile":"1","queries":"1","memory":"1","language_files":"1","language_strings":"1","strip-first":"1","strip-prefix":"","strip-suffix":""}', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(426, 'plg_system_log', 'plugin', 'log', 'system', 0, 1, 1, 1, '{"legacy":false,"name":"plg_system_log","type":"plugin","creationDate":"April 2007","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_LOG_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 6, 0),
(427, 'plg_system_redirect', 'plugin', 'redirect', 'system', 0, 1, 1, 1, '{"legacy":false,"name":"plg_system_redirect","type":"plugin","creationDate":"April 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_REDIRECT_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 7, 0);
INSERT INTO `jos_extensions` (`extension_id`, `name`, `type`, `element`, `folder`, `client_id`, `enabled`, `access`, `protected`, `manifest_cache`, `params`, `custom_data`, `system_data`, `checked_out`, `checked_out_time`, `ordering`, `state`) VALUES
(428, 'plg_system_remember', 'plugin', 'remember', 'system', 0, 1, 1, 1, '{"legacy":false,"name":"plg_system_remember","type":"plugin","creationDate":"April 2007","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_REMEMBER_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 9, 0),
(429, 'plg_system_sef', 'plugin', 'sef', 'system', 0, 1, 1, 0, '{"legacy":false,"name":"plg_system_sef","type":"plugin","creationDate":"December 2007","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_SEF_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 10, 0),
(430, 'plg_system_logout', 'plugin', 'logout', 'system', 0, 1, 1, 1, '{"legacy":false,"name":"plg_system_logout","type":"plugin","creationDate":"April 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_SYSTEM_LOGOUT_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 4, 0),
(431, 'plg_user_contactcreator', 'plugin', 'contactcreator', 'user', 0, 0, 1, 1, '{"legacy":false,"name":"plg_user_contactcreator","type":"plugin","creationDate":"August 2009","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_CONTACTCREATOR_XML_DESCRIPTION","group":""}', '{"autowebpage":"","category":"34","autopublish":"0"}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(432, 'plg_user_joomla', 'plugin', 'joomla', 'user', 0, 1, 1, 0, '{"legacy":false,"name":"plg_user_joomla","type":"plugin","creationDate":"December 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2009 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_USER_JOOMLA_XML_DESCRIPTION","group":""}', '{"autoregister":"1"}', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(433, 'plg_user_profile', 'plugin', 'profile', 'user', 0, 0, 1, 1, '{"legacy":false,"name":"plg_user_profile","type":"plugin","creationDate":"January 2008","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_USER_PROFILE_XML_DESCRIPTION","group":""}', '{"register-require_address1":"1","register-require_address2":"1","register-require_city":"1","register-require_region":"1","register-require_country":"1","register-require_postal_code":"1","register-require_phone":"1","register-require_website":"1","register-require_favoritebook":"1","register-require_aboutme":"1","register-require_tos":"1","register-require_dob":"1","profile-require_address1":"1","profile-require_address2":"1","profile-require_city":"1","profile-require_region":"1","profile-require_country":"1","profile-require_postal_code":"1","profile-require_phone":"1","profile-require_website":"1","profile-require_favoritebook":"1","profile-require_aboutme":"1","profile-require_tos":"1","profile-require_dob":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(434, 'plg_extension_joomla', 'plugin', 'joomla', 'extension', 0, 1, 1, 1, '{"legacy":false,"name":"plg_extension_joomla","type":"plugin","creationDate":"May 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_EXTENSION_JOOMLA_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(435, 'plg_content_joomla', 'plugin', 'joomla', 'content', 0, 1, 1, 0, '{"legacy":false,"name":"plg_content_joomla","type":"plugin","creationDate":"November 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_CONTENT_JOOMLA_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(436, 'plg_system_languagecode', 'plugin', 'languagecode', 'system', 0, 0, 1, 0, '{"legacy":false,"name":"plg_system_languagecode","type":"plugin","creationDate":"November 2011","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_SYSTEM_LANGUAGECODE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 13, 0),
(437, 'plg_quickicon_joomlaupdate', 'plugin', 'joomlaupdate', 'quickicon', 0, 1, 1, 1, '{"legacy":false,"name":"plg_quickicon_joomlaupdate","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_QUICKICON_JOOMLAUPDATE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(438, 'plg_quickicon_extensionupdate', 'plugin', 'extensionupdate', 'quickicon', 0, 1, 1, 1, '{"legacy":false,"name":"plg_quickicon_extensionupdate","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_QUICKICON_EXTENSIONUPDATE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(439, 'plg_captcha_recaptcha', 'plugin', 'recaptcha', 'captcha', 0, 1, 1, 0, '{"legacy":false,"name":"plg_captcha_recaptcha","type":"plugin","creationDate":"December 2011","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_CAPTCHA_RECAPTCHA_XML_DESCRIPTION","group":""}', '{"public_key":"","private_key":"","theme":"clean"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(440, 'plg_system_highlight', 'plugin', 'highlight', 'system', 0, 1, 1, 0, '{"legacy":false,"name":"plg_system_highlight","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2012 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_SYSTEM_HIGHLIGHT_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 8, 0),
(441, 'plg_content_finder', 'plugin', 'finder', 'content', 0, 0, 1, 0, '{"legacy":false,"name":"plg_content_finder","type":"plugin","creationDate":"December 2011","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2012 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_CONTENT_FINDER_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(442, 'plg_finder_categories', 'plugin', 'categories', 'finder', 0, 1, 1, 0, '{"legacy":false,"name":"plg_finder_categories","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2012 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_FINDER_CATEGORIES_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(443, 'plg_finder_contacts', 'plugin', 'contacts', 'finder', 0, 1, 1, 0, '{"legacy":false,"name":"plg_finder_contacts","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2012 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_FINDER_CONTACTS_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(444, 'plg_finder_content', 'plugin', 'content', 'finder', 0, 1, 1, 0, '{"legacy":false,"name":"plg_finder_content","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2012 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_FINDER_CONTENT_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(445, 'plg_finder_newsfeeds', 'plugin', 'newsfeeds', 'finder', 0, 1, 1, 0, '{"legacy":false,"name":"plg_finder_newsfeeds","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2012 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_FINDER_NEWSFEEDS_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 4, 0),
(446, 'plg_finder_weblinks', 'plugin', 'weblinks', 'finder', 0, 1, 1, 0, '{"legacy":false,"name":"plg_finder_weblinks","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2012 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_FINDER_WEBLINKS_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(500, 'atomic', 'template', 'atomic', '', 0, 1, 1, 0, '{"legacy":false,"name":"atomic","type":"template","creationDate":"10\\/10\\/09","author":"Ron Severdia","copyright":"Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.","authorEmail":"contact@kontentdesign.com","authorUrl":"http:\\/\\/www.kontentdesign.com","version":"2.5.0","description":"TPL_ATOMIC_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(502, 'bluestork', 'template', 'bluestork', '', 1, 1, 1, 0, '{"legacy":false,"name":"bluestork","type":"template","creationDate":"07\\/02\\/09","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"TPL_BLUESTORK_XML_DESCRIPTION","group":""}', '{"useRoundedCorners":"1","showSiteName":"0","textBig":"0","highContrast":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(503, 'beez_20', 'template', 'beez_20', '', 0, 1, 1, 0, '{"legacy":false,"name":"beez_20","type":"template","creationDate":"25 November 2009","author":"Angie Radtke","copyright":"Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.","authorEmail":"a.radtke@derauftritt.de","authorUrl":"http:\\/\\/www.der-auftritt.de","version":"2.5.0","description":"TPL_BEEZ2_XML_DESCRIPTION","group":""}', '{"wrapperSmall":"53","wrapperLarge":"72","sitetitle":"","sitedescription":"","navposition":"center","templatecolor":"nature"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(504, 'hathor', 'template', 'hathor', '', 1, 1, 1, 0, '{"legacy":false,"name":"hathor","type":"template","creationDate":"May 2010","author":"Andrea Tarr","copyright":"Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.","authorEmail":"hathor@tarrconsulting.com","authorUrl":"http:\\/\\/www.tarrconsulting.com","version":"2.5.0","description":"TPL_HATHOR_XML_DESCRIPTION","group":""}', '{"showSiteName":"0","colourChoice":"0","boldText":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(505, 'beez5', 'template', 'beez5', '', 0, 1, 1, 0, '{"legacy":false,"name":"beez5","type":"template","creationDate":"21 May 2010","author":"Angie Radtke","copyright":"Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.","authorEmail":"a.radtke@derauftritt.de","authorUrl":"http:\\/\\/www.der-auftritt.de","version":"2.5.0","description":"TPL_BEEZ5_XML_DESCRIPTION","group":""}', '{"wrapperSmall":"53","wrapperLarge":"72","sitetitle":"","sitedescription":"","navposition":"center","html5":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(600, 'English (United Kingdom)', 'language', 'en-GB', '', 0, 1, 1, 1, '{"legacy":false,"name":"English (United Kingdom)","type":"language","creationDate":"2008-03-15","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.10","description":"en-GB site language","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(601, 'English (United Kingdom)', 'language', 'en-GB', '', 1, 1, 1, 1, '{"legacy":false,"name":"English (United Kingdom)","type":"language","creationDate":"2008-03-15","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.10","description":"en-GB administrator language","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(700, 'files_joomla', 'file', 'joomla', '', 0, 1, 1, 1, '{"legacy":false,"name":"files_joomla","type":"file","creationDate":"December 2013","author":"Joomla! Project","copyright":"(C) 2005 - 2013 Open Source Matters. All rights reserved","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.17","description":"FILES_JOOMLA_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(800, 'PKG_JOOMLA', 'package', 'pkg_joomla', '', 0, 1, 1, 1, '{"legacy":false,"name":"PKG_JOOMLA","type":"package","creationDate":"2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"http:\\/\\/www.joomla.org","version":"2.5.0","description":"PKG_JOOMLA_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10002, 'VM - Payment, Standard', 'plugin', 'standard', 'vmpayment', 0, 1, 1, 0, '{"legacy":true,"name":"VMPAYMENT_STANDARD","type":"plugin","creationDate":"July 16 2012","author":"The VirtueMart Development Team","copyright":"Copyright (C) 2004-2012 Virtuemart Team. All rights reserved.","authorEmail":"","authorUrl":"http:\\/\\/www.virtuemart.net","version":"2.0.8e","description":"Standard payment plugin","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(10003, 'VM - Payment, Payzen', 'plugin', 'payzen', 'vmpayment', 0, 1, 1, 0, '{"legacy":true,"name":"VM - Payment, PayZen","type":"plugin","creationDate":"July 04 2012","author":"Lyra Network","copyright":"Copyright Lyra Network.","authorEmail":"support@payzen.eu","authorUrl":"http:\\/\\/www.lyra-network.com","version":"2.0.8c","description":"\\n    \\t<a href=\\"http:\\/\\/www.lyra-network.com\\" target=\\"_blank\\">PayZen<\\/a> is a multi bank payment provider. \\n    ","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 100, 0),
(10004, 'VM - Payment, SystemPay', 'plugin', 'systempay', 'vmpayment', 0, 1, 1, 0, '{"legacy":true,"name":"VM - Payment, Systempay","type":"plugin","creationDate":"July 04 2012","author":"Lyra Network","copyright":"Copyright Lyra Network.","authorEmail":"supportvad@lyra-network.com","authorUrl":"http:\\/\\/www.lyra-network.com","version":"2.0.8c","description":"\\n    \\t<a href=\\"http:\\/\\/www.lyra-network.com\\" target=\\"_blank\\">Systempay<\\/a> is a multi bank payment provider. \\n    ","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 100, 0),
(10005, 'VM - Payment, Moneybookers Credit Cards', 'plugin', 'moneybookers_acc', 'vmpayment', 0, 1, 1, 0, '{"legacy":true,"name":"VMPAYMENT_MONEYBOOKERS","type":"plugin","creationDate":"April 2012","author":"Skrill Holdings Limited","copyright":"Copyright (C) 2012 Skrill.","authorEmail":"","authorUrl":"http:\\/\\/www.skrill.com","version":"2.0.6","description":"<a href=\\"http:\\/\\/www.skrill.com\\" target=\\"_blank\\">Moneybookers<\\/a> is a popular\\n\\tpayment provider authorised by the Financial Services Authority of the United Kingdom (FSA). \\n    ","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(10006, 'VM - Payment, Moneybookers Lastschrift', 'plugin', 'moneybookers_did', 'vmpayment', 0, 1, 1, 0, '{"legacy":true,"name":"VMPAYMENT_MONEYBOOKERS","type":"plugin","creationDate":"April 2012","author":"Skrill Holdings Limited","copyright":"Copyright (C) 2012 Skrill.","authorEmail":"","authorUrl":"http:\\/\\/www.skrill.com","version":"2.0.6","description":"<a href=\\"http:\\/\\/www.skrill.com\\" target=\\"_blank\\">Moneybookers<\\/a> is a popular\\n\\tpayment provider authorised by the Financial Services Authority of the United Kingdom (FSA). \\n    ","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(10007, 'VM - Payment, Moneybookers iDeal', 'plugin', 'moneybookers_idl', 'vmpayment', 0, 1, 1, 0, '{"legacy":true,"name":"VMPAYMENT_MONEYBOOKERS","type":"plugin","creationDate":"April 2012","author":"Skrill Holdings Limited","copyright":"Copyright (C) 2012 Skrill.","authorEmail":"","authorUrl":"http:\\/\\/www.skrill.com","version":"2.0.6","description":"<a href=\\"http:\\/\\/www.skrill.com\\" target=\\"_blank\\">Moneybookers<\\/a> is a popular\\n\\tpayment provider authorised by the Financial Services Authority of the United Kingdom (FSA). \\n    ","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(10008, 'VM - Payment, Moneybookers Giropay', 'plugin', 'moneybookers_gir', 'vmpayment', 0, 1, 1, 0, '{"legacy":true,"name":"VMPAYMENT_MONEYBOOKERS","type":"plugin","creationDate":"April 2012","author":"Skrill Holdings Limited","copyright":"Copyright (C) 2012 Skrill.","authorEmail":"","authorUrl":"http:\\/\\/www.skrill.com","version":"2.0.6","description":"<a href=\\"http:\\/\\/www.skrill.com\\" target=\\"_blank\\">Moneybookers<\\/a> is a popular\\n\\tpayment provider authorised by the Financial Services Authority of the United Kingdom (FSA). \\n    ","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(10009, 'VM - Payment, Moneybookers Sofortüberweisung', 'plugin', 'moneybookers_sft', 'vmpayment', 0, 1, 1, 0, '{"legacy":true,"name":"VMPAYMENT_MONEYBOOKERS","type":"plugin","creationDate":"April 2012","author":"Skrill Holdings Limited","copyright":"Copyright (C) 2012 Skrill.","authorEmail":"","authorUrl":"http:\\/\\/www.skrill.com","version":"2.0.6","description":"<a href=\\"http:\\/\\/www.skrill.com\\" target=\\"_blank\\">Moneybookers<\\/a> is a popular\\n\\tpayment provider authorised by the Financial Services Authority of the United Kingdom (FSA). \\n    ","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(10010, 'VM - Payment, Moneybookers Przelewy24', 'plugin', 'moneybookers_pwy', 'vmpayment', 0, 1, 1, 0, '{"legacy":true,"name":"VMPAYMENT_MONEYBOOKERS","type":"plugin","creationDate":"April 2012","author":"Skrill Holdings Limited","copyright":"Copyright (C) 2012 Skrill.","authorEmail":"","authorUrl":"http:\\/\\/www.skrill.com","version":"2.0.6","description":"<a href=\\"http:\\/\\/www.skrill.com\\" target=\\"_blank\\">Moneybookers<\\/a> is a popular\\n\\tpayment provider authorised by the Financial Services Authority of the United Kingdom (FSA). \\n    ","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(10011, 'VM - Payment, Moneybookers Online Bank Transfer', 'plugin', 'moneybookers_obt', 'vmpayment', 0, 1, 1, 0, '{"legacy":true,"name":"VMPAYMENT_MONEYBOOKERS","type":"plugin","creationDate":"April 2012","author":"Skrill Holdings Limited","copyright":"Copyright (C) 2012 Skrill.","authorEmail":"","authorUrl":"http:\\/\\/www.skrill.com","version":"2.0.6","description":"<a href=\\"http:\\/\\/www.skrill.com\\" target=\\"_blank\\">Moneybookers<\\/a> is a popular\\n\\tpayment provider authorised by the Financial Services Authority of the United Kingdom (FSA). \\n    ","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(10012, 'VM - Payment, Moneybookers Skrill Digital Wallet', 'plugin', 'moneybookers_wlt', 'vmpayment', 0, 1, 1, 0, '{"legacy":true,"name":"VMPAYMENT_MONEYBOOKERS","type":"plugin","creationDate":"April 2012","author":"Skrill Holdings Limited","copyright":"Copyright (C) 2012 Skrill.","authorEmail":"","authorUrl":"http:\\/\\/www.skrill.com","version":"2.0.6","description":"<a href=\\"http:\\/\\/www.skrill.com\\" target=\\"_blank\\">Moneybookers<\\/a> is a popular\\n\\tpayment provider authorised by the Financial Services Authority of the United Kingdom (FSA). \\n    ","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(10013, 'VM - Payment, Authorize.net', 'plugin', 'authorizenet', 'vmpayment', 0, 1, 1, 0, '{"legacy":true,"name":"VM Payment - authorize.net AIM","type":"plugin","creationDate":"July 16 2012","author":"The VirtueMart Development Team","copyright":"Copyright (C) 2004-2011 Virtuemart Team. All rights reserved.","authorEmail":"","authorUrl":"http:\\/\\/www.virtuemart.net","version":"2.0.8e","description":"","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(10014, 'VM - Payment, Paypal', 'plugin', 'paypal', 'vmpayment', 0, 1, 1, 0, '{"legacy":true,"name":"VMPAYMENT_PAYPAL","type":"plugin","creationDate":"July 16 2012","author":"The VirtueMart Development Team","copyright":"Copyright (C) 2004-2012 Virtuemart Team. All rights reserved.","authorEmail":"","authorUrl":"http:\\/\\/www.virtuemart.net","version":"2.0.8e","description":"<a href=\\"http:\\/\\/paypal.com\\" target=\\"_blank\\">PayPal<\\/a> is a popular\\n\\tpayment provider and available in many countries. \\n    ","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(10015, 'VM - Shipment, By weight, ZIP and countries', 'plugin', 'weight_countries', 'vmshipment', 0, 1, 1, 0, '{"legacy":true,"name":"VMSHIPMENT_WEIGHT_COUNTRIES","type":"plugin","creationDate":"July 16 2012","author":"The VirtueMart Development Team","copyright":"Copyright (C) 2004-2012 Virtuemart Team. All rights reserved.","authorEmail":"","authorUrl":"http:\\/\\/www.virtuemart.net","version":"2.0.8e","description":"VMSHIPMENT_WEIGHT_COUNTRIES_PLUGIN_DESC","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10016, 'VM - Custom, customer text input', 'plugin', 'textinput', 'vmcustom', 0, 1, 1, 0, '{"legacy":true,"name":"VMCustom - textinput","type":"plugin","creationDate":"July 16 2012","author":"The VirtueMart Development Team","copyright":"Copyright (C) 2004-2012 Virtuemart Team. All rights reserved.","authorEmail":"","authorUrl":"http:\\/\\/www.virtuemart.net","version":"2.0.8e","description":"text input plugin for product","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10017, 'VM - Custom, product specification', 'plugin', 'specification', 'vmcustom', 0, 1, 1, 0, '{"legacy":true,"name":"VMCustom - specification","type":"plugin","creationDate":"July 16 2012","author":"The VirtueMart Development Team","copyright":"Copyright (C) 2004-2012 Virtuemart Team. All rights reserved.","authorEmail":"","authorUrl":"http:\\/\\/www.virtuemart.net","version":"2.0.8e","description":"text input plugin for product","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10018, 'VM - Custom, stockable variants', 'plugin', 'stockable', 'vmcustom', 0, 1, 1, 0, '{"legacy":true,"name":"VMCUSTOM_STOCKABLE","type":"plugin","creationDate":"July 16 2012","author":"The VirtueMart Development Team","copyright":"Copyright (C) 2004-2012 Virtuemart Team. All rights reserved.","authorEmail":"","authorUrl":"http:\\/\\/www.virtuemart.net","version":"2.0.8e","description":"VMCUSTOM_STOCKABLE_DESC","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10019, 'VM - Search, Virtuemart Product', 'plugin', 'virtuemart', 'search', 0, 1, 1, 0, '{"legacy":false,"name":"plg_search_virtuemart","type":"plugin","creationDate":"July 16 2012","author":"The VirtueMart Development Team","copyright":"Copyright (C) 2004-2012 Virtuemart Team. All rights reserved.","authorEmail":"","authorUrl":"http:\\/\\/www.virtuemart.net","version":"2.0.8e","description":"Allows Searching of VirtueMart Component","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10020, 'mod_virtuemart_currencies', 'module', 'mod_virtuemart_currencies', '', 0, 1, 1, 0, '{"legacy":true,"name":"mod_virtuemart_currencies","type":"module","creationDate":"July 16 2012","author":"The VirtueMart Development Team","copyright":"Copyright (C) 2004-2012 Virtuemart Team. All rights reserved.","authorEmail":"","authorUrl":"http:\\/\\/www.virtuemart.net","version":"2.0.8e","description":"MOD_VIRTUEMART_CURRENCIES_DESC","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 4, 0),
(10021, 'mod_virtuemart_product', 'module', 'mod_virtuemart_product', '', 0, 1, 1, 0, '{"legacy":true,"name":"mod_virtuemart_product","type":"module","creationDate":"February 2011","author":"The VirtueMart Development Team","copyright":"Copyright (C) 2004-2011 Virtuemart Team. All rights reserved.","authorEmail":"","authorUrl":"http:\\/\\/www.virtuemart.net","version":"2.0.0RC3","description":"Displays: Featured, Best Sales, Random, or Latests products. (VirtueMart 2+ compatible)","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(10022, 'mod_virtuemart_search', 'module', 'mod_virtuemart_search', '', 0, 1, 1, 0, '{"legacy":true,"name":"mod_virtuemart_search","type":"module","creationDate":"July 16 2012","author":"The VirtueMart Development Team","copyright":"Copyright (C) 2004-2012 Virtuemart Team. All rights reserved.","authorEmail":"","authorUrl":"http:\\/\\/www.virtuemart.net","version":"2.0.8e","description":"MOD_VIRTUEMART_SEARCH_DESC","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(10023, 'mod_virtuemart_manufacturer', 'module', 'mod_virtuemart_manufacturer', '', 0, 1, 1, 0, '{"legacy":true,"name":"mod_virtuemart_manufacturer","type":"module","creationDate":"February 2011","author":"The VirtueMart Development Team","copyright":"Copyright (C) 2004-2011 Virtuemart Team. All rights reserved.","authorEmail":"","authorUrl":"http:\\/\\/www.virtuemart.net","version":"2.0.0RC3","description":"Displays manufacturers from VirtueMart.(VirtueMart 2+ compatible)","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(10024, 'VirtueMart Shopping Cart', 'module', 'mod_virtuemart_cart', '', 0, 1, 1, 0, '{"legacy":true,"name":"VirtueMart Shopping Cart","type":"module","creationDate":"February 2011","author":"The VirtueMart Development Team","copyright":"Copyright (C) 2004-2011 Virtuemart Team. All rights reserved.","authorEmail":"","authorUrl":"http:\\/\\/www.virtuemart.net","version":"2.0.0RC3","description":"Mod Virtuemart Cart","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10025, 'mod_virtuemart_category', 'module', 'mod_virtuemart_category', '', 0, 1, 1, 0, '{"legacy":true,"name":"mod_virtuemart_category","type":"module","creationDate":"July 16 2012","author":"The VirtueMart Development Team","copyright":"Copyright (C) 2004-2012 Virtuemart Team. All rights reserved.","authorEmail":"","authorUrl":"http:\\/\\/www.virtuemart.net","version":"2.0.8e","description":"MOD_VIRTUEMART_CATEGORY_DESC","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 6, 0),
(10031, 'Breadcrumbs Advanced', 'module', 'mod_breadcrumbs_advanced', '', 0, 1, 0, 0, '{"legacy":false,"name":"Breadcrumbs Advanced","type":"module","creationDate":"July 2011","author":"UWiX","copyright":"Copyright (C) 2011 UWiX. All rights reserved.","authorEmail":"meerinfo@uwix.nl","authorUrl":"www.uwix.nl","version":"1.7.0","description":"This module displays the breadcrumbs but has more advanced options than the original module from Joomla! 1.6. ","group":""}', '{"showHere":"1","showHome":"1","clickHome":"0","homeText":"Home","homepath":"","showLast":"1","cutLast":"0","cutAt":"20","cutChar":"...","separator":"","cache":"1","cache_time":"900","cachemode":"itemid"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10033, 'JGMap - Google Map ', 'module', 'mod_JGMap', '', 0, 1, 0, 0, '{"legacy":false,"name":"JGMap - Google Map ","type":"module","creationDate":"June 13, 2010","author":"Kermode Bear Software - James Hansen","copyright":"Copyright 2011 Notice","authorEmail":"kermode@kermodesoftware.com","authorUrl":"www.kermodesoftware.com","version":"0.15.5","description":"Displays a Google map in a module position.","group":""}', '{"width":"200","height":"150","mapName":"map","smallmap":"1","static":"0","lat":"48.5747","lng":"-123","zoom":"3","marker_title":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10034, 'VM - Payment, Klarna', 'plugin', 'klarna', 'vmpayment', 0, 1, 1, 0, '{"legacy":true,"name":"VM - Payment, Klarna","type":"plugin","creationDate":"August 22 2012","author":"The VirtueMart Development Team","copyright":"Copyright (C) 2004-2012 Virtuemart Team. All rights reserved.","authorEmail":"","authorUrl":"http:\\/\\/www.virtuemart.net","version":"2.0.10","description":"VMPAYMENT_KLARNA_CONF_PLUGIN_DESC","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(10055, 'Slideshow CK', 'module', 'mod_slideshowck', '', 0, 1, 0, 0, '{"legacy":false,"name":"Slideshow CK","type":"module","creationDate":"Avril 2012","author":"C\\u00e9dric KEIFLIN","copyright":"C\\u00e9dric KEIFLIN","authorEmail":"ced1870@gmail.com","authorUrl":"http:\\/\\/www.joomlack.fr","version":"1.3.8","description":"MOD_SLIDESHOWCK_XML_DESCRIPTION","group":""}', '{"slides":"[{|qq|imgname|qq|:|qq|modules\\\\\\/mod_slideshowck\\\\\\/images\\\\\\/slides\\\\\\/bridge.jpg|qq|,|qq|imgcaption|qq|:|qq|This is a bridge|qq|,|qq|imgthumb|qq|:|qq|..\\\\\\/modules\\\\\\/mod_slideshowck\\\\\\/images\\\\\\/slides\\\\\\/bridge.jpg|qq|,|qq|imglink|qq|:|qq||qq|,|qq|imgtarget|qq|:|qq|_parent|qq|,|qq|imgalignment|qq|:|qq|default|qq|,|qq|imgvideo|qq|:|qq||qq|,|qq|slideselect|qq|:|qq|image|qq|},{|qq|imgname|qq|:|qq|modules\\\\\\/mod_slideshowck\\\\\\/images\\\\\\/slides\\\\\\/road.jpg|qq|,|qq|imgcaption|qq|:|qq|This slideshow uses the JQuery script from <a href=|dq|http:\\\\\\/\\\\\\/www.pixedelic.com\\\\\\/plugins\\\\\\/camera\\\\\\/|dq|>Pixedelic<\\\\\\/a>|qq|,|qq|imgthumb|qq|:|qq|..\\\\\\/modules\\\\\\/mod_slideshowck\\\\\\/images\\\\\\/slides\\\\\\/road.jpg|qq|,|qq|imglink|qq|:|qq||qq|,|qq|imgtarget|qq|:|qq|_parent|qq|,|qq|imgalignment|qq|:|qq|default|qq|,|qq|imgvideo|qq|:|qq||qq|,|qq|slideselect|qq|:|qq|image|qq|},{|qq|imgname|qq|:|qq|modules\\\\\\/mod_slideshowck\\\\\\/images\\\\\\/slides\\\\\\/big_bunny_fake.jpg|qq|,|qq|imgcaption|qq|:|qq|This is a Video slide|qq|,|qq|imgthumb|qq|:|qq|..\\\\\\/modules\\\\\\/mod_slideshowck\\\\\\/images\\\\\\/slides\\\\\\/big_bunny_fake.jpg|qq|,|qq|imglink|qq|:|qq||qq|,|qq|imgtarget|qq|:|qq|_parent|qq|,|qq|imgalignment|qq|:|qq|default|qq|,|qq|imgvideo|qq|:|qq|http:\\\\\\/\\\\\\/player.vimeo.com\\\\\\/video\\\\\\/2203727|qq|,|qq|slideselect|qq|:|qq|video|qq|}]","skin":"camera_amber_skin","alignment":"center","loader":"pie","width":"auto","height":"400","navigation":"2","thumbnails":"1","thumbnailwidth":"100","thumbnailheight":"75","pagination":"1","effect":"random","transition":"linear","time":"7000","transperiod":"1500","captioneffect":"random","portrait":"0","autoAdvance":"1","hover":"1","displayorder":"normal","loadjquery":"1","loadjqueryeasing":"1","loadjquerymobile":"1","cache":"1","cache_time":"900","cachemode":"itemid"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10056, 'YJ Pop Login', 'module', 'mod_yj_pop_login', '', 0, 1, 0, 0, '{"legacy":false,"name":"YJ Pop Login","type":"module","creationDate":"12-19-2011","author":"Youjoomla","copyright":"Youjoomla LLC.","authorEmail":"youjoomla@gmail.com","authorUrl":"www.youjoomla.com","version":"1.0.1","description":"\\n\\t\\t<style type=\\"text\\/css\\" media=\\"all\\">#wrap1 {padding:0px 0px 4px 0px;}h1 {clear:both;font-family: Arial Narrow,sans-serif;font-size:18px;margin:0px 0px 12px 0px;padding:0px 0px 1px 10px;color:#C64934;}.wrap2 {background:#F7F7F7;display:block;overflow:hidden;padding:15px;}<\\/style><div id=\\"holdthem\\"><h1>YJ Pop Login Module for Joomla 1.6x and UP<\\/h1><br \\/><div class=\\"wrap2\\"><a title=\\"Visit the official website!\\" href=\\"http:\\/\\/www.youjoomla.com\\"> <img style=\\"float:left;border:1px solid #CFCFCF;margin:0px 15px 4px 22px;\\" src=\\"..\\/modules\\/mod_yj_pop_login\\/images\\/yj_extensions.jpg\\" border=\\"0\\" alt=\\"Logo\\" \\/><\\/a>\\n\\t","group":""}', '{"cache":"1","@spacer":"","moduleclass_sfx":"","pretext":"Welcome,Guest <br \\/> <br \\/><span> Please login or register<\\/span>","login":"","logout":"","greeting":"1","name":"0","usesecure":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10060, 'RuposTel VirtueMart Ajax Search', 'module', 'mod_vm_ajax_search', '', 0, 1, 0, 0, '{"legacy":true,"name":"RuposTel VirtueMart Ajax Search","type":"module","creationDate":"20110107","author":"www.rupostel.com","copyright":"(C) rupostel.com Original extension: GJCWebdesign.com","authorEmail":"info@rupostel.com","authorUrl":"http:\\/\\/www.rupostel.com","version":"2.0.2","description":"\\nVirtuemart Ajax Search Module created by <a href=\\"http:\\/\\/www.rupostel.com\\/\\">rupostel.com<\\/a> team. \\n\\t\\n\\t","group":""}', '{"cache":"0","internal_caching":"0","moduleclass_sfx":" ajax_srch","pretext":"","search_page":"index.php?option=com_virtuemart&page=shop.search","@spacer":"","include_advsearch":"1","include_but":"1","offset_top_search_result":"20","text_box_width":"100","min_height":"50","results_width":"200","offset_left_search_result":"0","number_of_products":"5","css_position":"relative"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10063, 'mod_superfish_menu', 'module', 'mod_superfish_menu', '', 0, 1, 0, 0, '{"legacy":false,"name":"mod_superfish_menu","type":"module","creationDate":"Unknown","author":"Unknown","copyright":"","authorEmail":"","authorUrl":"","version":"2.5.0","description":"MOD_SUPERFISH_MENU_XML_DESCRIPTION","group":""}', '{"startLevel":"1","endLevel":"0","showAllChildren":"1","cache":"1","cache_time":"900","cachemode":"itemid","sf-delay":"500","sf-animation":"opacity:''show''","sf-speed":"normal","easing":"swing"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10066, 'Heidelpay', 'plugin', 'heidelpay', 'vmpayment', 0, 1, 1, 0, '{"legacy":false,"name":"VMPAYMENT_HEIDELPAY","type":"plugin","creationDate":"12-Sep-2012","author":"Heidelberger Payment GmbH","copyright":"Copyright Heidelberger Payment GmbH","authorEmail":"info@heidelpay.de","authorUrl":"http:\\/\\/www.heidelpay.de","version":"12.09","description":"<h2>Virtuemart Plugin von:<\\/h2><p><a href=\\"http:\\/\\/www.Heidelpay.de\\" target=\\"_blank\\"><img src=\\"http:\\/\\/www.heidelpay.de\\/gfx\\/logo.gif\\" style=\\"margin-right:20px;\\"\\/><\\/a><\\/p> ","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(10068, 'plg_system_vm2_cart', 'plugin', 'vm2_cart', 'system', 0, 1, 1, 0, '{"legacy":false,"name":"plg_system_vm2_cart","type":"plugin","creationDate":"March 2012","author":"xxx","copyright":"","authorEmail":"","authorUrl":"","version":"1.1","description":"Plg System VM2Cart","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(10075, 'VM - Calculation Avalara Tax', 'plugin', 'avalara', 'vmcalculation', 0, 0, 1, 0, '{"legacy":true,"name":"VM - Calculation Avalara Tax","type":"plugin","creationDate":"April 2012","author":"Max Milbers","copyright":"Copyright (C) 2012 iStraxx UG. All rights reserved","authorEmail":"","authorUrl":"http:\\/\\/virtuemart.net","version":"2.0.10","description":"On demand tax calculation for whole U.S.A.","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10076, 'VMPAYMENT_MONEYBOOKERS', 'plugin', 'moneybookers', 'vmpayment', 0, 0, 1, 0, '{"legacy":true,"name":"VMPAYMENT_MONEYBOOKERS","type":"plugin","creationDate":"April 2012","author":"Skrill Holdings Limited","copyright":"Copyright (C) 2012 Skrill.","authorEmail":"","authorUrl":"http:\\/\\/www.skrill.com","version":"2.0.6","description":"<a href=\\"http:\\/\\/www.skrill.com\\" target=\\"_blank\\">Moneybookers<\\/a> is a popular\\n\\tpayment provider authorised by the Financial Services Authority of the United Kingdom (FSA). \\n    ","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(10077, 'VirtueMart Shopping Cart', 'module', 'mod_virtuemart_cart_tm', '', 0, 1, 0, 0, '{"legacy":true,"name":"VirtueMart Shopping Cart","type":"module","creationDate":"February 2011","author":"The VirtueMart Development Team","copyright":"Copyright (C) 2004-2011 Virtuemart Team. All rights reserved.","authorEmail":"","authorUrl":"http:\\/\\/www.virtuemart.net","version":"2.0.0RC3","description":"Mod Virtuemart Cart","group":""}', '{"moduleclass_sfx":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10079, 'com_virtuemart - en-GB', 'file', 'com_virtuemart-en-GB', '', 0, 1, 0, 0, '{"legacy":false,"name":"com_virtuemart - en-GB","type":"file","creationDate":"09.08.2013","author":"VirtueMart language team","copyright":"\\u00a9 2008-2013 - compojoom-com. All rights reserved!","authorEmail":"max@virtuemart.net","authorUrl":"https:\\/\\/virtuemart.net","version":"2013-08-09-06-56-33","description":"\\n        This package was auto generated with CTransifex(https:\\/\\/compojoom.com). We''ve grabbed the latest language files for our extension from transifex.com.\\n        Special thanks to our translation team at (https:\\/\\/www.transifex.com\\/projects\\/p\\/virtuemart\\/) for helping with this VirtueMart translation!\\n    ","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10081, 'Sofort Banking', 'plugin', 'sofort', 'vmpayment', 0, 1, 1, 0, '{"legacy":true,"name":"VMPAYMENT_SOFORT","type":"plugin","creationDate":"September 08 2013","author":"The VirtueMart Development Team","copyright":"Copyright (C) 2004-2013 Virtuemart Team. All rights reserved.","authorEmail":"","authorUrl":"http:\\/\\/www.virtuemart.net","version":"2.0.22d","description":"<a href=\\"http:\\/www.sofort.com\\" target=\\"_blank\\">Sofort<\\/a> is a popular\\n\\tpayment provider and available in many countries. \\n    ","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(10082, 'bundle', 'package', 'pkg_bundle', '', 0, 1, 1, 0, '{"legacy":false,"name":"bundle","type":"package","creationDate":"Unknown","author":"Unknown","copyright":"","authorEmail":"","authorUrl":"","version":"29.01.2013","description":"\\n\\t\\t\\n\\t\\t\\t<p>This package installs the following Joomla extensions:<\\/p>\\n\\t\\t\\t<ul>\\n\\t\\t\\t\\t<li>Module Breadcrumbs<\\/li>\\n\\t\\t\\t\\t<li>Module JGMap<\\/li>\\n\\t\\t\\t\\t<li>Slideshowck Slider<\\/li>\\n\\t\\t\\t\\t\\n\\t\\t\\t\\t<li>Superfish Menu<\\/li>\\n\\t\\t\\t\\t<li>Module Virtuemart Manufacturer<\\/li>\\n\\t\\t\\t\\t\\n\\t\\t\\t\\t\\n\\t\\t\\t\\t<li>Module Aax Search<\\/li>\\n\\t\\t\\t\\t<li>Module YJ Pop Login<\\/li>\\n\\t\\t\\t<\\/ul>\\n\\t\\t\\n\\t","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10083, 'Sofort iDeal', 'plugin', 'sofort_ideal', 'vmpayment', 0, 1, 1, 0, '{"legacy":true,"name":"VMPAYMENT_SOFORT","type":"plugin","creationDate":"October 01 2013","author":"The VirtueMart Development Team","copyright":"Copyright (C) 2004-2013 Virtuemart Team. All rights reserved.","authorEmail":"","authorUrl":"http:\\/\\/www.virtuemart.net","version":"2.0.24","description":"<a href=\\"http:\\/www.sofort.com\\" target=\\"_blank\\">Sofort<\\/a> is a popular\\n\\tpayment provider and available in many countries. \\n    ","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(10087, 'Module BannersBlock', 'module', 'mod_bannersblock', '', 0, 1, 0, 0, '{"legacy":false,"name":"Module BannersBlock","type":"module","creationDate":"11\\/11\\/2013","author":"Olejenya","copyright":"Copyright (C) 2012 Open Source Matters. All rights reserved.Olejenya","authorEmail":"olejenya@olejenya.com","authorUrl":"","version":"0.1","description":"Best BannersBlock Module is a Joomla! 2.5 Module which displays modules as a tab from joomla module manager.","group":""}', '{"mod_total_image":"20","bannerlink1":"","bannertitle1":"","bannerheight1":"","bannerwidth1":"","mod_1_image":"","mod_image_1_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink2":"","bannertitle2":"","bannerheight2":"","bannerwidth2":"","mod_2_image":"","mod_image_2_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink3":"","bannertitle3":"","bannerheight3":"","bannerwidth3":"","mod_3_image":"","mod_image_3_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink4":"","bannertitle4":"","bannerheight4":"","bannerwidth4":"","mod_4_image":"","mod_image_4_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink5":"","bannertitle5":"","bannerheight5":"","bannerwidth5":"","mod_5_image":"","mod_image_5_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink6":"","bannertitle6":"","bannerheight6":"","bannerwidth6":"","mod_6_image":"","mod_image_6_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink7":"","bannertitle7":"","bannerheight7":"","bannerwidth7":"","mod_7_image":"","mod_image_7_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink8":"","bannertitle8":"","bannerheight8":"","bannerwidth8":"","mod_8_image":"","mod_image_8_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink9":"","bannertitle9":"","bannerheight9":"","bannerwidth9":"","mod_9_image":"","mod_image_9_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink10":"","bannertitle10":"","bannerheight10":"","bannerwidth10":"","mod_10_image":"","mod_image_10_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink11":"","bannertitle11":"","bannerheight11":"","bannerwidth11":"","mod_11_image":"","mod_image_11_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink12":"","bannertitle12":"","bannerheight12":"","bannerwidth12":"","mod_12_image":"","mod_image_12_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink13":"","bannertitle13":"","bannerheight13":"","bannerwidth13":"","mod_13_image":"","mod_image_13_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink14":"","bannertitle14":"","bannerheight14":"","bannerwidth14":"","mod_14_image":"","mod_image_14_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink15":"","bannertitle15":"","bannerheight15":"","bannerwidth15":"","mod_15_image":"","mod_image_15_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink16":"","bannertitle16":"","bannerheight16":"","bannerwidth16":"","mod_16_image":"","mod_image_16_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink17":"","bannertitle17":"","bannerheight17":"","bannerwidth17":"","mod_17_image":"","mod_image_17_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink18":"","bannertitle18":"","bannerheight18":"","bannerwidth18":"","mod_18_image":"","mod_image_18_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink19":"","bannertitle19":"","bannerheight19":"","bannerwidth19":"","mod_19_image":"","mod_image_19_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink20":"","bannertitle20":"","bannerheight20":"","bannerwidth20":"","mod_20_image":"","mod_image_20_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","moduleclass_sfx":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10088, 'KlarnaCheckout', 'plugin', 'klarnacheckout', 'vmpayment', 0, 0, 1, 0, '{"legacy":true,"name":"Klarna Checkout","type":"plugin","creationDate":"January 09 2014","author":"The VirtueMart Development Team","copyright":"Copyright (C) 2004-2014 Virtuemart Team. All rights reserved.","authorEmail":"","authorUrl":"http:\\/\\/www.virtuemart.net","version":"2.0.26c","description":"","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(10089, 'virtuemart', 'component', 'com_virtuemart', '', 1, 1, 0, 0, '{"legacy":true,"name":"VIRTUEMART","type":"component","creationDate":"January 10 2014","author":"The VirtueMart Development Team","copyright":"Copyright (C) 2004-2013 Virtuemart Team. All rights reserved.","authorEmail":"max|at|virtuemart.net","authorUrl":"http:\\/\\/www.virtuemart.net","version":"2.0.26d","description":"","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10090, 'virtuemart_allinone', 'component', 'com_virtuemart_allinone', '', 1, 1, 0, 0, '{"legacy":true,"name":"VirtueMart_allinone","type":"component","creationDate":"January 10 2014","author":"The VirtueMart Development Team","copyright":"Copyright (C) 2004-2013 Virtuemart Team. All rights reserved.","authorEmail":"","authorUrl":"http:\\/\\/www.virtuemart.net","version":"2.0.26d","description":"","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10108, 'theme538', 'template', 'theme538', '', 0, 1, 1, 0, '{"legacy":false,"name":"theme538","type":"template","creationDate":"04.08.2014","author":"Mercury","copyright":"Copyright  2003-2011 template-help.com. All Rights Reserved.","authorEmail":"info@template-help.com","authorUrl":"http:\\/\\/www.template-help.com","version":"2.5.17","description":"this template for Joomla 2.5 is made by template-help.com","group":""}', '{"sitetitle":"","sitedescription":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_finder_filters`
--

DROP TABLE IF EXISTS `jos_finder_filters`;
CREATE TABLE `jos_finder_filters` (
  `filter_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL,
  `created_by_alias` varchar(255) NOT NULL,
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `map_count` int(10) unsigned NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  `params` mediumtext,
  PRIMARY KEY (`filter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jos_finder_links`
--

DROP TABLE IF EXISTS `jos_finder_links`;
CREATE TABLE `jos_finder_links` (
  `link_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `route` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `indexdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `md5sum` varchar(32) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `state` int(5) DEFAULT '1',
  `access` int(5) DEFAULT '0',
  `language` varchar(8) NOT NULL,
  `publish_start_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_end_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `start_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `list_price` double unsigned NOT NULL DEFAULT '0',
  `sale_price` double unsigned NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL,
  `object` mediumblob NOT NULL,
  PRIMARY KEY (`link_id`),
  KEY `idx_type` (`type_id`),
  KEY `idx_title` (`title`),
  KEY `idx_md5` (`md5sum`),
  KEY `idx_url` (`url`(75)),
  KEY `idx_published_list` (`published`,`state`,`access`,`publish_start_date`,`publish_end_date`,`list_price`),
  KEY `idx_published_sale` (`published`,`state`,`access`,`publish_start_date`,`publish_end_date`,`sale_price`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jos_finder_links_terms0`
--

DROP TABLE IF EXISTS `jos_finder_links_terms0`;
CREATE TABLE `jos_finder_links_terms0` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jos_finder_links_terms1`
--

DROP TABLE IF EXISTS `jos_finder_links_terms1`;
CREATE TABLE `jos_finder_links_terms1` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jos_finder_links_terms2`
--

DROP TABLE IF EXISTS `jos_finder_links_terms2`;
CREATE TABLE `jos_finder_links_terms2` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jos_finder_links_terms3`
--

DROP TABLE IF EXISTS `jos_finder_links_terms3`;
CREATE TABLE `jos_finder_links_terms3` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jos_finder_links_terms4`
--

DROP TABLE IF EXISTS `jos_finder_links_terms4`;
CREATE TABLE `jos_finder_links_terms4` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jos_finder_links_terms5`
--

DROP TABLE IF EXISTS `jos_finder_links_terms5`;
CREATE TABLE `jos_finder_links_terms5` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jos_finder_links_terms6`
--

DROP TABLE IF EXISTS `jos_finder_links_terms6`;
CREATE TABLE `jos_finder_links_terms6` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jos_finder_links_terms7`
--

DROP TABLE IF EXISTS `jos_finder_links_terms7`;
CREATE TABLE `jos_finder_links_terms7` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jos_finder_links_terms8`
--

DROP TABLE IF EXISTS `jos_finder_links_terms8`;
CREATE TABLE `jos_finder_links_terms8` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jos_finder_links_terms9`
--

DROP TABLE IF EXISTS `jos_finder_links_terms9`;
CREATE TABLE `jos_finder_links_terms9` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jos_finder_links_termsa`
--

DROP TABLE IF EXISTS `jos_finder_links_termsa`;
CREATE TABLE `jos_finder_links_termsa` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jos_finder_links_termsb`
--

DROP TABLE IF EXISTS `jos_finder_links_termsb`;
CREATE TABLE `jos_finder_links_termsb` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jos_finder_links_termsc`
--

DROP TABLE IF EXISTS `jos_finder_links_termsc`;
CREATE TABLE `jos_finder_links_termsc` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jos_finder_links_termsd`
--

DROP TABLE IF EXISTS `jos_finder_links_termsd`;
CREATE TABLE `jos_finder_links_termsd` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jos_finder_links_termse`
--

DROP TABLE IF EXISTS `jos_finder_links_termse`;
CREATE TABLE `jos_finder_links_termse` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jos_finder_links_termsf`
--

DROP TABLE IF EXISTS `jos_finder_links_termsf`;
CREATE TABLE `jos_finder_links_termsf` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jos_finder_taxonomy`
--

DROP TABLE IF EXISTS `jos_finder_taxonomy`;
CREATE TABLE `jos_finder_taxonomy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `state` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `access` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ordering` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `state` (`state`),
  KEY `ordering` (`ordering`),
  KEY `access` (`access`),
  KEY `idx_parent_published` (`parent_id`,`state`,`access`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jos_finder_taxonomy`
--

INSERT INTO `jos_finder_taxonomy` (`id`, `parent_id`, `title`, `state`, `access`, `ordering`) VALUES
(1, 0, 'ROOT', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_finder_taxonomy_map`
--

DROP TABLE IF EXISTS `jos_finder_taxonomy_map`;
CREATE TABLE `jos_finder_taxonomy_map` (
  `link_id` int(10) unsigned NOT NULL,
  `node_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`node_id`),
  KEY `link_id` (`link_id`),
  KEY `node_id` (`node_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jos_finder_terms`
--

DROP TABLE IF EXISTS `jos_finder_terms`;
CREATE TABLE `jos_finder_terms` (
  `term_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `term` varchar(75) NOT NULL,
  `stem` varchar(75) NOT NULL,
  `common` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `phrase` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `weight` float unsigned NOT NULL DEFAULT '0',
  `soundex` varchar(75) NOT NULL,
  `links` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_id`),
  UNIQUE KEY `idx_term` (`term`),
  KEY `idx_term_phrase` (`term`,`phrase`),
  KEY `idx_stem_phrase` (`stem`,`phrase`),
  KEY `idx_soundex_phrase` (`soundex`,`phrase`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jos_finder_terms_common`
--

DROP TABLE IF EXISTS `jos_finder_terms_common`;
CREATE TABLE `jos_finder_terms_common` (
  `term` varchar(75) NOT NULL,
  `language` varchar(3) NOT NULL,
  KEY `idx_word_lang` (`term`,`language`),
  KEY `idx_lang` (`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_finder_terms_common`
--

INSERT INTO `jos_finder_terms_common` (`term`, `language`) VALUES
('a', 'en'),
('about', 'en'),
('after', 'en'),
('ago', 'en'),
('all', 'en'),
('am', 'en'),
('an', 'en'),
('and', 'en'),
('ani', 'en'),
('any', 'en'),
('are', 'en'),
('aren''t', 'en'),
('as', 'en'),
('at', 'en'),
('be', 'en'),
('but', 'en'),
('by', 'en'),
('for', 'en'),
('from', 'en'),
('get', 'en'),
('go', 'en'),
('how', 'en'),
('if', 'en'),
('in', 'en'),
('into', 'en'),
('is', 'en'),
('isn''t', 'en'),
('it', 'en'),
('its', 'en'),
('me', 'en'),
('more', 'en'),
('most', 'en'),
('must', 'en'),
('my', 'en'),
('new', 'en'),
('no', 'en'),
('none', 'en'),
('not', 'en'),
('noth', 'en'),
('nothing', 'en'),
('of', 'en'),
('off', 'en'),
('often', 'en'),
('old', 'en'),
('on', 'en'),
('onc', 'en'),
('once', 'en'),
('onli', 'en'),
('only', 'en'),
('or', 'en'),
('other', 'en'),
('our', 'en'),
('ours', 'en'),
('out', 'en'),
('over', 'en'),
('page', 'en'),
('she', 'en'),
('should', 'en'),
('small', 'en'),
('so', 'en'),
('some', 'en'),
('than', 'en'),
('thank', 'en'),
('that', 'en'),
('the', 'en'),
('their', 'en'),
('theirs', 'en'),
('them', 'en'),
('then', 'en'),
('there', 'en'),
('these', 'en'),
('they', 'en'),
('this', 'en'),
('those', 'en'),
('thus', 'en'),
('time', 'en'),
('times', 'en'),
('to', 'en'),
('too', 'en'),
('true', 'en'),
('under', 'en'),
('until', 'en'),
('up', 'en'),
('upon', 'en'),
('use', 'en'),
('user', 'en'),
('users', 'en'),
('veri', 'en'),
('version', 'en'),
('very', 'en'),
('via', 'en'),
('want', 'en'),
('was', 'en'),
('way', 'en'),
('were', 'en'),
('what', 'en'),
('when', 'en'),
('where', 'en'),
('whi', 'en'),
('which', 'en'),
('who', 'en'),
('whom', 'en'),
('whose', 'en'),
('why', 'en'),
('wide', 'en'),
('will', 'en'),
('with', 'en'),
('within', 'en'),
('without', 'en'),
('would', 'en'),
('yes', 'en'),
('yet', 'en'),
('you', 'en'),
('your', 'en'),
('yours', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `jos_finder_tokens`
--

DROP TABLE IF EXISTS `jos_finder_tokens`;
CREATE TABLE `jos_finder_tokens` (
  `term` varchar(75) NOT NULL,
  `stem` varchar(75) NOT NULL,
  `common` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `phrase` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `weight` float unsigned NOT NULL DEFAULT '1',
  `context` tinyint(1) unsigned NOT NULL DEFAULT '2',
  KEY `idx_word` (`term`),
  KEY `idx_context` (`context`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jos_finder_tokens_aggregate`
--

DROP TABLE IF EXISTS `jos_finder_tokens_aggregate`;
CREATE TABLE `jos_finder_tokens_aggregate` (
  `term_id` int(10) unsigned NOT NULL,
  `map_suffix` char(1) NOT NULL,
  `term` varchar(75) NOT NULL,
  `stem` varchar(75) NOT NULL,
  `common` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `phrase` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `term_weight` float unsigned NOT NULL,
  `context` tinyint(1) unsigned NOT NULL DEFAULT '2',
  `context_weight` float unsigned NOT NULL,
  `total_weight` float unsigned NOT NULL,
  KEY `token` (`term`),
  KEY `keyword_id` (`term_id`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jos_finder_types`
--

DROP TABLE IF EXISTS `jos_finder_types`;
CREATE TABLE `jos_finder_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `mime` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jos_languages`
--

DROP TABLE IF EXISTS `jos_languages`;
CREATE TABLE `jos_languages` (
  `lang_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lang_code` char(7) NOT NULL,
  `title` varchar(50) NOT NULL,
  `title_native` varchar(50) NOT NULL,
  `sef` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `description` varchar(512) NOT NULL,
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `sitename` varchar(1024) NOT NULL DEFAULT '',
  `published` int(11) NOT NULL DEFAULT '0',
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`lang_id`),
  UNIQUE KEY `idx_sef` (`sef`),
  UNIQUE KEY `idx_image` (`image`),
  UNIQUE KEY `idx_langcode` (`lang_code`),
  KEY `idx_access` (`access`),
  KEY `idx_ordering` (`ordering`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jos_languages`
--

INSERT INTO `jos_languages` (`lang_id`, `lang_code`, `title`, `title_native`, `sef`, `image`, `description`, `metakey`, `metadesc`, `sitename`, `published`, `access`, `ordering`) VALUES
(1, 'en-GB', 'English (UK)', 'English (UK)', 'en', 'en', '', '', '', '', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jos_loginradius_users`
--

DROP TABLE IF EXISTS `jos_loginradius_users`;
CREATE TABLE `jos_loginradius_users` (
  `id` int(11) DEFAULT NULL,
  `LoginRadius_id` varchar(255) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `lr_picture` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jos_menu`
--

DROP TABLE IF EXISTS `jos_menu`;
CREATE TABLE `jos_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menutype` varchar(24) NOT NULL COMMENT 'The type of menu this item belongs to. FK to #__menu_types.menutype',
  `title` varchar(255) NOT NULL COMMENT 'The display title of the menu item.',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'The SEF alias of the menu item.',
  `note` varchar(255) NOT NULL DEFAULT '',
  `path` varchar(1024) NOT NULL COMMENT 'The computed path of the menu item based on the alias field.',
  `link` varchar(1024) NOT NULL COMMENT 'The actually link the menu item refers to.',
  `type` varchar(16) NOT NULL COMMENT 'The type of link: Component, URL, Alias, Separator',
  `published` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'The published state of the menu link.',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'The parent menu item in the menu tree.',
  `level` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The relative level in the tree.',
  `component_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to #__extensions.id',
  `ordering` int(11) NOT NULL DEFAULT '0' COMMENT 'The relative ordering of the menu item in the tree.',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to #__users.id',
  `checked_out_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'The time the menu item was checked out.',
  `browserNav` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'The click behaviour of the link.',
  `access` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The access level required to view the menu item.',
  `img` varchar(255) NOT NULL COMMENT 'The image of the menu item.',
  `template_style_id` int(10) unsigned NOT NULL DEFAULT '0',
  `params` text NOT NULL COMMENT 'JSON encoded data for the menu item.',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `home` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Indicates if this menu item is the home or default page.',
  `language` char(7) NOT NULL DEFAULT '',
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_client_id_parent_id_alias_language` (`client_id`,`parent_id`,`alias`,`language`),
  KEY `idx_componentid` (`component_id`,`menutype`,`published`,`access`),
  KEY `idx_menutype` (`menutype`),
  KEY `idx_left_right` (`lft`,`rgt`),
  KEY `idx_alias` (`alias`),
  KEY `idx_path` (`path`(255)),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=537 ;

--
-- Dumping data for table `jos_menu`
--

INSERT INTO `jos_menu` (`id`, `menutype`, `title`, `alias`, `note`, `path`, `link`, `type`, `published`, `parent_id`, `level`, `component_id`, `ordering`, `checked_out`, `checked_out_time`, `browserNav`, `access`, `img`, `template_style_id`, `params`, `lft`, `rgt`, `home`, `language`, `client_id`) VALUES
(1, '', 'Menu_Item_Root', 'root', '', '', '', '', 1, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 0, '', 0, '', 0, 93, 0, '*', 0),
(2, 'menu', 'com_banners', 'Banners', '', 'Banners', 'index.php?option=com_banners', 'component', 0, 1, 1, 4, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners', 0, '', 25, 34, 0, '*', 1),
(3, 'menu', 'com_banners', 'Banners', '', 'Banners/Banners', 'index.php?option=com_banners', 'component', 0, 2, 2, 4, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners', 0, '', 26, 27, 0, '*', 1),
(4, 'menu', 'com_banners_categories', 'Categories', '', 'Banners/Categories', 'index.php?option=com_categories&extension=com_banners', 'component', 0, 2, 2, 6, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners-cat', 0, '', 28, 29, 0, '*', 1),
(5, 'menu', 'com_banners_clients', 'Clients', '', 'Banners/Clients', 'index.php?option=com_banners&view=clients', 'component', 0, 2, 2, 4, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners-clients', 0, '', 30, 31, 0, '*', 1),
(6, 'menu', 'com_banners_tracks', 'Tracks', '', 'Banners/Tracks', 'index.php?option=com_banners&view=tracks', 'component', 0, 2, 2, 4, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners-tracks', 0, '', 32, 33, 0, '*', 1),
(7, 'menu', 'com_contact', 'Contacts', '', 'Contacts', 'index.php?option=com_contact', 'component', 0, 1, 1, 8, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:contact', 0, '', 35, 40, 0, '*', 1),
(8, 'menu', 'com_contact', 'Contacts', '', 'Contacts/Contacts', 'index.php?option=com_contact', 'component', 0, 7, 2, 8, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:contact', 0, '', 36, 37, 0, '*', 1),
(9, 'menu', 'com_contact_categories', 'Categories', '', 'Contacts/Categories', 'index.php?option=com_categories&extension=com_contact', 'component', 0, 7, 2, 6, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:contact-cat', 0, '', 38, 39, 0, '*', 1),
(10, 'menu', 'com_messages', 'Messaging', '', 'Messaging', 'index.php?option=com_messages', 'component', 0, 1, 1, 15, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:messages', 0, '', 41, 46, 0, '*', 1),
(11, 'menu', 'com_messages_add', 'New Private Message', '', 'Messaging/New Private Message', 'index.php?option=com_messages&task=message.add', 'component', 0, 10, 2, 15, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:messages-add', 0, '', 42, 43, 0, '*', 1),
(12, 'menu', 'com_messages_read', 'Read Private Message', '', 'Messaging/Read Private Message', 'index.php?option=com_messages', 'component', 0, 10, 2, 15, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:messages-read', 0, '', 44, 45, 0, '*', 1),
(13, 'menu', 'com_newsfeeds', 'News Feeds', '', 'News Feeds', 'index.php?option=com_newsfeeds', 'component', 0, 1, 1, 17, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:newsfeeds', 0, '', 47, 52, 0, '*', 1),
(14, 'menu', 'com_newsfeeds_feeds', 'Feeds', '', 'News Feeds/Feeds', 'index.php?option=com_newsfeeds', 'component', 0, 13, 2, 17, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:newsfeeds', 0, '', 48, 49, 0, '*', 1),
(15, 'menu', 'com_newsfeeds_categories', 'Categories', '', 'News Feeds/Categories', 'index.php?option=com_categories&extension=com_newsfeeds', 'component', 0, 13, 2, 6, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:newsfeeds-cat', 0, '', 50, 51, 0, '*', 1),
(16, 'menu', 'com_redirect', 'Redirect', '', 'Redirect', 'index.php?option=com_redirect', 'component', 0, 1, 1, 24, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:redirect', 0, '', 65, 66, 0, '*', 1),
(17, 'menu', 'com_search', 'Basic Search', '', 'Basic Search', 'index.php?option=com_search', 'component', 0, 1, 1, 19, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:search', 0, '', 57, 58, 0, '*', 1),
(18, 'menu', 'com_weblinks', 'Weblinks', '', 'Weblinks', 'index.php?option=com_weblinks', 'component', 0, 1, 1, 21, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:weblinks', 0, '', 59, 64, 0, '*', 1),
(19, 'menu', 'com_weblinks_links', 'Links', '', 'Weblinks/Links', 'index.php?option=com_weblinks', 'component', 0, 18, 2, 21, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:weblinks', 0, '', 60, 61, 0, '*', 1),
(20, 'menu', 'com_weblinks_categories', 'Categories', '', 'Weblinks/Categories', 'index.php?option=com_categories&extension=com_weblinks', 'component', 0, 18, 2, 6, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:weblinks-cat', 0, '', 62, 63, 0, '*', 1),
(21, 'menu', 'com_finder', 'Smart Search', '', 'Smart Search', 'index.php?option=com_finder', 'component', 0, 1, 1, 27, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:finder', 0, '', 53, 54, 0, '*', 1),
(22, 'menu', 'com_joomlaupdate', 'Joomla! Update', '', 'Joomla! Update', 'index.php?option=com_joomlaupdate', 'component', 0, 1, 1, 28, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:joomlaupdate', 0, '', 55, 56, 0, '*', 1),
(207, 'top', 'About Us', 'about-us', '', 'about-us', 'index.php?option=com_content&view=article&id=71', 'component', 1, 1, 1, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"0","show_intro":"0","show_category":"0","link_category":"0","show_parent_category":"0","link_parent_category":"0","show_author":"0","link_author":"0","show_create_date":"0","show_modify_date":"0","show_publish_date":"0","show_item_navigation":"0","show_vote":"0","show_icons":"0","show_print_icon":"0","show_email_icon":"0","show_hits":"0","show_noauth":"0","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"About Us","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 15, 16, 0, '*', 0),
(435, 'mainmenu', 'Home', 'homepage', '', 'homepage', 'index.php?option=com_content&view=featured', 'component', 1, 1, 1, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"featured_categories":[""],"layout_type":"blog","num_leading_articles":"0","num_intro_articles":"0","num_columns":"0","num_links":"0","multi_column_order":"1","orderby_pri":"","orderby_sec":"front","order_date":"","show_pagination":"0","show_pagination_results":"0","show_title":"1","link_titles":"","show_intro":"","show_category":"0","link_category":"0","show_parent_category":"0","link_parent_category":"0","show_author":"0","link_author":"0","show_create_date":"0","show_modify_date":"0","show_publish_date":"0","show_item_navigation":"0","show_vote":"","show_readmore":"1","show_readmore_title":"","show_icons":"0","show_print_icon":"0","show_email_icon":"0","show_hits":"0","show_noauth":"","show_feed_link":"1","feed_summary":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 23, 24, 1, '*', 0),
(444, 'top', 'Online Store', 'online-store', '', 'online-store', 'index.php?option=com_virtuemart&view=virtuemart', 'component', 1, 1, 1, 10089, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"Online Store","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 3, 14, 0, '*', 0),
(464, 'top', 'Home', 'home', '', 'home', 'index.php?Itemid=', 'alias', 0, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"aliasoptions":"435","menu-anchor_title":"","menu-anchor_css":"","menu_image":""}', 1, 2, 0, '*', 0),
(470, 'top', 'Contacts', 'contact', '', 'contact', 'index.php?option=com_contact&view=contact&id=1', 'component', 1, 1, 1, 8, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"presentation_style":"plain","show_contact_category":"hide","show_contact_list":"0","show_name":"0","show_position":"0","show_email":"0","show_street_address":"0","show_suburb":"0","show_state":"0","show_postcode":"0","show_country":"0","show_telephone":"0","show_mobile":"0","show_fax":"0","show_webpage":"0","show_misc":"0","show_image":"0","allow_vcard":"0","show_articles":"0","show_links":"0","linka_name":"","linkb_name":"","linkc_name":"","linkd_name":"","linke_name":"","show_email_form":"","show_email_copy":"0","banned_email":"","banned_subject":"","banned_text":"","validate_session":"","custom_reply":"","redirect":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"Contacts","show_page_heading":0,"page_heading":"","pageclass_sfx":"contacts","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 21, 22, 0, '*', 0),
(471, 'top', 'Delivery', 'delivery', '', 'delivery', 'index.php?option=com_content&view=article&id=72', 'component', 1, 1, 1, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"0","show_intro":"0","show_category":"0","link_category":"0","show_parent_category":"0","link_parent_category":"0","show_author":"0","link_author":"0","show_create_date":"0","show_modify_date":"0","show_publish_date":"0","show_item_navigation":"0","show_vote":"0","show_icons":"0","show_print_icon":"0","show_email_icon":"0","show_hits":"0","show_noauth":"0","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"Delivery","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 17, 18, 0, '*', 0),
(472, 'top', 'FAQs', 'faqs', '', 'faqs', 'index.php?option=com_content&view=article&id=73', 'component', 1, 1, 1, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"0","show_intro":"0","show_category":"0","link_category":"0","show_parent_category":"0","link_parent_category":"0","show_author":"0","link_author":"0","show_create_date":"0","show_modify_date":"0","show_publish_date":"0","show_item_navigation":"0","show_vote":"0","show_icons":"0","show_print_icon":"0","show_email_icon":"0","show_hits":"0","show_noauth":"0","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"FAQs","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 19, 20, 0, '*', 0),
(476, 'top', 'Manufacturer Default Layout', 'manufacturer-default-layout', 'Manufacturer Default Layout', 'online-store/manufacturer-default-layout', 'index.php?option=com_virtuemart&view=manufacturer', 'component', 1, 444, 2, 10089, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"Manufacturer Default Layout","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 4, 5, 0, '*', 0),
(478, 'top', 'List Orders', 'list-orders', 'List Orders', 'online-store/list-orders', 'index.php?option=com_virtuemart&view=orders&layout=list', 'component', 1, 444, 2, 10089, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"List Orders","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 8, 9, 0, '*', 0),
(481, 'top', 'User Edit Address', 'user-edit-address', 'User Edit Address', 'online-store/user-edit-address', 'index.php?option=com_virtuemart&view=user&layout=editaddress', 'component', 1, 444, 2, 10089, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"User Edit Address","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 10, 11, 0, '*', 0),
(482, 'top', 'Display Vendor contact', 'display-vendor-contact', 'Display Vendor contact', 'online-store/display-vendor-contact', 'index.php?option=com_virtuemart&view=vendor&layout=contact&virtuemart_vendor_id=1', 'component', 1, 444, 2, 10089, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"Display Vendor contact","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 6, 7, 0, '*', 0),
(486, 'top', 'Category Layout', 'categoty-layout', '', 'online-store/categoty-layout', 'index.php?option=com_virtuemart&view=category&virtuemart_category_id=0&categorylayout=default', 'component', 1, 444, 2, 10089, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"Categoty Layout","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 12, 13, 0, '*', 0),
(489, 'foot-menu2', 'About joomla!', 'about-joomla', 'About joomla!', 'about-joomla', 'index.php?option=com_content&view=article&id=24', 'component', 1, 1, 1, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"1","link_titles":"0","show_intro":"0","show_category":"0","link_category":"0","show_parent_category":"0","link_parent_category":"0","show_author":"0","link_author":"0","show_create_date":"0","show_modify_date":"0","show_publish_date":"0","show_item_navigation":"0","show_vote":"0","show_icons":"0","show_print_icon":"0","show_email_icon":"0","show_hits":"0","show_noauth":"0","urls_position":"0","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"About joomla!","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 67, 68, 0, '*', 0),
(490, 'foot-menu2', 'Wrappers', '2012-08-14-08-26-20', 'Wrappers', '2012-08-14-08-26-20', '#', 'url', 1, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1}', 69, 70, 0, '*', 0),
(491, 'foot-menu2', 'Reviews', '2012-08-14-08-27-04', 'Reviews', '2012-08-14-08-27-04', '#', 'url', 1, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1}', 71, 72, 0, '*', 0),
(492, 'foot-menu2', 'News', '2012-08-14-08-28-01', 'News', '2012-08-14-08-28-01', '#', 'url', 1, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1}', 73, 74, 0, '*', 0),
(493, 'foot-menu3', 'Create an Account', 'create-an-account', 'Create an Account', 'create-an-account', 'index.php?option=com_virtuemart&view=user&layout=editaddress', 'component', 1, 1, 1, 10000, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"Account","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 75, 76, 0, '*', 0),
(494, 'foot-menu3', 'Advanced Search', 'advanced-search', 'Advanced Search', 'advanced-search', 'index.php?option=com_search&view=search&searchword=', 'component', 1, 1, 1, 19, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"search_areas":"","show_date":"","searchphrase":"0","ordering":"newest","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"Advanced Search","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 77, 78, 0, '*', 0),
(495, 'foot-menu3', 'Order History', 'order-history', 'Order History', 'order-history', 'index.php?option=com_virtuemart&view=orders&layout=list', 'component', 1, 1, 1, 10000, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"Order History","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 79, 80, 0, '*', 0),
(496, 'foot-menu4', 'Shipping & Returns', '2012-08-14-08-36-55', 'Shipping & Returns', '2012-08-14-08-36-55', '#', 'url', 1, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1}', 81, 82, 0, '*', 0),
(497, 'foot-menu4', 'Group Sales', 'contact-us', 'Group Sales', 'contact-us', '#', 'url', 1, 1, 1, 8, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1}', 83, 84, 0, '*', 0),
(524, 'mainmenu', 'Search pages', 'search-pages', 'Search pages', 'search-pages', 'index.php?option=com_virtuemart&view=category&virtuemart_category_id=0', 'component', 1, 1, 1, 10064, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"Search pages","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 85, 86, 0, '*', 0),
(534, 'main', 'COM_VIRTUEMART', 'com-virtuemart', '', 'com-virtuemart', 'index.php?option=com_virtuemart', 'component', 0, 1, 1, 10089, 0, 0, '0000-00-00 00:00:00', 0, 1, '../components/com_virtuemart/assets/images/vmgeneral/menu_icon.png', 0, '', 87, 88, 0, '', 1),
(535, 'main', 'VirtueMart AIO', 'virtuemart-aio', '', 'virtuemart-aio', 'index.php?option=com_virtuemart_allinone', 'component', 0, 1, 1, 10090, 0, 0, '0000-00-00 00:00:00', 0, 1, 'class:component', 0, '', 89, 90, 0, '', 1),
(536, 'system-menu', 'Template Settings', 'template-settings', '', 'template-settings', 'index.php?option=com_content&view=article&id=74', 'component', 1, 1, 1, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":0,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 91, 92, 0, '*', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_menu_types`
--

DROP TABLE IF EXISTS `jos_menu_types`;
CREATE TABLE `jos_menu_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menutype` varchar(24) NOT NULL,
  `title` varchar(48) NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_menutype` (`menutype`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `jos_menu_types`
--

INSERT INTO `jos_menu_types` (`id`, `menutype`, `title`, `description`) VALUES
(3, 'top', 'Top', 'Links for major types of users'),
(6, 'mainmenu', 'Main Menu', 'Simple Home Menu'),
(9, 'foot-menu2', 'foot-menu 2', 'foot-menu2'),
(10, 'foot-menu3', 'foot-menu 3', 'foot-menu3'),
(11, 'foot-menu4', 'foot-menu 4', 'foot-menu4'),
(12, 'system-menu', 'System menu', '');

-- --------------------------------------------------------

--
-- Table structure for table `jos_messages`
--

DROP TABLE IF EXISTS `jos_messages`;
CREATE TABLE `jos_messages` (
  `message_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id_from` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id_to` int(10) unsigned NOT NULL DEFAULT '0',
  `folder_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `priority` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `useridto_state` (`user_id_to`,`state`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jos_messages_cfg`
--

DROP TABLE IF EXISTS `jos_messages_cfg`;
CREATE TABLE `jos_messages_cfg` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `cfg_name` varchar(100) NOT NULL DEFAULT '',
  `cfg_value` varchar(255) NOT NULL DEFAULT '',
  UNIQUE KEY `idx_user_var_name` (`user_id`,`cfg_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jos_modules`
--

DROP TABLE IF EXISTS `jos_modules`;
CREATE TABLE `jos_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `note` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `position` varchar(50) NOT NULL DEFAULT '',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `module` varchar(50) DEFAULT NULL,
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `showtitle` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `published` (`published`,`access`),
  KEY `newsfeeds` (`module`,`published`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=187 ;

--
-- Dumping data for table `jos_modules`
--

INSERT INTO `jos_modules` (`id`, `title`, `note`, `content`, `ordering`, `position`, `checked_out`, `checked_out_time`, `publish_up`, `publish_down`, `published`, `module`, `access`, `showtitle`, `params`, `client_id`, `language`) VALUES
(2, 'Login', '', '', 1, 'login', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_login', 1, 1, '', 1, '*'),
(3, 'Popular Articles', '', '', 3, 'cpanel', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_popular', 3, 1, '{"count":"5","catid":"","user_id":"0","layout":"_:default","moduleclass_sfx":"","cache":"0","automatic_title":"1"}', 1, '*'),
(4, 'Recently Added Articles', '', '', 4, 'cpanel', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_latest', 3, 1, '{"count":"5","ordering":"c_dsc","catid":"","user_id":"0","layout":"_:default","moduleclass_sfx":"","cache":"0","automatic_title":"1"}', 1, '*'),
(8, 'Toolbar', '', '', 1, 'toolbar', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_toolbar', 3, 1, '', 1, '*'),
(9, 'Quick Icons', '', '', 1, 'icon', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_quickicon', 3, 1, '', 1, '*'),
(10, 'Logged-in Users', '', '', 2, 'cpanel', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_logged', 3, 1, '{"count":"5","name":"1","layout":"_:default","moduleclass_sfx":"","cache":"0","automatic_title":"1"}', 1, '*'),
(12, 'Admin Menu', '', '', 1, 'menu', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_menu', 3, 1, '{"layout":"","moduleclass_sfx":"","shownew":"1","showhelp":"1","cache":"0"}', 1, '*'),
(13, 'Admin Submenu', '', '', 1, 'submenu', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_submenu', 3, 1, '', 1, '*'),
(14, 'User Status', '', '', 2, 'status', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_status', 3, 1, '', 1, '*'),
(15, 'Title', '', '', 1, 'title', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_title', 3, 1, '', 1, '*'),
(79, 'Multilanguage status', '', '', 1, 'status', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_multilangstatus', 3, 1, '{"layout":"_:default","moduleclass_sfx":"","cache":"0"}', 1, '*'),
(86, 'Joomla Version', '', '', 1, 'footer', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_version', 3, 1, '{"format":"short","product":"1","layout":"_:default","moduleclass_sfx":"","cache":"0"}', 1, '*'),
(95, 'Currencies:', '', '', 1, 'user5', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_virtuemart_currencies', 1, 1, '{"text_before":"","product_currency":"","cache":"0","moduleclass_sfx":"","class_sfx":""}', 0, '*'),
(107, 'Footer', '', '', 2, 'footer', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_footer', 1, 0, '{"layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(115, 'Breadcrumbs Advanced', '', '', 1, 'syndicate', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_breadcrumbs_advanced', 1, 0, '{"showHere":"0","showHome":"1","clickHome":"1","homeText":"Home","homepath":"","showLast":"1","cutLast":"1","cutAt":"15","cutChar":"...","separator":">","layout":"_:default","moduleclass_sfx":"_Breadcrumbs","cache":"1","cache_time":"900","cachemode":"itemid"}', 0, '*'),
(117, 'Google Map ', '', '', 1, 'right', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_JGMap', 1, 1, '{"width":"294","height":"350","mapName":"map","mapType":"ROADMAP","smallmap":"1","navControls":"1","static":"0","moduleclass_sfx":"_map","lat":"40.64974019634333","lng":"-73.94954252243042","zoom":"14","marker":"1","marker_lat":"40.64974019634333","marker_lng":"-73.94954252243042","marker_title":"TM"}', 0, '*'),
(118, 'The Company Name', '', '                               <dl>\r\n                                   <dt>8901 Marmora Road,<br />Glasgow, D04 89GR.</dt>\r\n                                   <dd><span>Freephone:</span>+1 800 559 6580</dd> \r\n                                   <dd><span>Telephone:</span>+1 959 603 6035</dd>\r\n                                   <dd class="dd-bot"><span>FAX:</span>+1 504 889 9898</dd>\r\n                                   <dd>E-mail:<a href="#">mail@demolink.org</a></dd>\r\n                               </dl>\r\n                               <dl>\r\n                                   <dt>9863 - 9867 Mill Road,<br />Cambridge, MG09 99HT</dt>\r\n                                   <dd><span>Freephone:</span>+1 800 559 6580</dd> \r\n                                   <dd><span>Telephone:</span>+1 959 603 6035</dd>\r\n                                   <dd class="dd-bot"><span>FAX:</span>+1 504 889 9898</dd>\r\n                                   <dd>E-mail:<a href="#">mail@demolink.org</a></dd>\r\n                               </dl>\r\n                                ', 3, 'left', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"1","backgroundimage":"","layout":"_:default","moduleclass_sfx":"_address","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(130, 'Slideshow CK', '', '', 1, 'user8', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_slideshowck', 1, 0, '{"slides":"[{|qq|imgname|qq|:|qq|images\\/gallery\\/slide1.jpg|qq|,|qq|imgcaption|qq|:|qq|Extreme  mountain bike  enthusiasts|qq|,|qq|imgthumb|qq|:|qq|http:\\/\\/localhost\\/vm2\\/theme538\\/images\\/gallery\\/slide1.jpg|qq|,|qq|imglink|qq|:|qq|index.php\\/online-store\\/product-1-detail|qq|,|qq|imgtarget|qq|:|qq|_parent|qq|,|qq|imgalignment|qq|:|qq|default|qq|,|qq|imgvideo|qq|:|qq||qq|,|qq|slideselect|qq|:|qq|image|qq|,|qq|slidearticleid|qq|:|qq||qq|,|qq|imgtime|qq|:|qq||qq|},{|qq|imgname|qq|:|qq|images\\/gallery\\/slide2.jpg|qq|,|qq|imgcaption|qq|:|qq|Make your  bike jump|qq|,|qq|imgthumb|qq|:|qq|http:\\/\\/localhost\\/vm2\\/theme538\\/images\\/gallery\\/slide2.jpg|qq|,|qq|imglink|qq|:|qq|index.php\\/online-store\\/product-2-detail|qq|,|qq|imgtarget|qq|:|qq|_parent|qq|,|qq|imgalignment|qq|:|qq|default|qq|,|qq|imgvideo|qq|:|qq||qq|,|qq|slideselect|qq|:|qq|image|qq|,|qq|slidearticleid|qq|:|qq||qq|,|qq|imgtime|qq|:|qq||qq|},{|qq|imgname|qq|:|qq|images\\/gallery\\/slide3.jpg|qq|,|qq|imgcaption|qq|:|qq|Downhill, dirt  and free ride|qq|,|qq|imgthumb|qq|:|qq|http:\\/\\/localhost\\/vm2\\/theme538\\/images\\/gallery\\/slide3.jpg|qq|,|qq|imglink|qq|:|qq|index.php\\/online-store\\/product-3-detail|qq|,|qq|imgtarget|qq|:|qq|_parent|qq|,|qq|imgalignment|qq|:|qq|default|qq|,|qq|imgvideo|qq|:|qq|http:\\/\\/player.vimeo.com\\/video\\/2203727|qq|,|qq|slideselect|qq|:|qq|image|qq|,|qq|slidearticleid|qq|:|qq||qq|,|qq|imgtime|qq|:|qq||qq|}]","theme":"default","skin":"camera_amber_skin","alignment":"center","loader":"none","width":"870","height":"485","navigation":"0","thumbnails":"0","thumbnailwidth":"100","thumbnailheight":"75","pagination":"1","effect":["simpleFade"],"time":"7000","transperiod":"1000","captioneffect":"fadeIn","portrait":"0","autoAdvance":"1","hover":"1","displayorder":"normal","limitslides":"","fullpage":"0","imagetarget":"_parent","usemobileimage":"0","mobileimageresolution":"640","loadjquery":"0","loadjqueryeasing":"1","loadjquerymobile":"0","layout":"_:default","moduleclass_sfx":"_slider","cache":"1","cache_time":"900","cachemode":"itemid","articlelength":"150","articlelink":"readmore","articletitle":"h3","showarticletitle":"1","captionstylesusefont":"0","captionstylestextgfont":"0","captionstylesfontsize":"12px","captionstylesfontcolor":"","captionstylesfontweight":"normal","captionstylesdescfontsize":"10px","captionstylesdescfontcolor":"","captionstylesusemargin":"0","captionstylesmargintop":"0","captionstylesmarginright":"0","captionstylesmarginbottom":"0","captionstylesmarginleft":"0","captionstylespaddingtop":"0","captionstylespaddingright":"0","captionstylespaddingbottom":"0","captionstylespaddingleft":"0","captionstylesusebackground":"0","captionstylesbgcolor1":"","captionstylesbgimage":"","captionstylesbgpositionx":"left","captionstylesbgpositiony":"top","captionstylesbgimagerepeat":"repeat","captionstylesusegradient":"0","captionstylesbgcolor2":"","captionstylesuseroundedcorners":"0","captionstylesroundedcornerstl":"5","captionstylesroundedcornerstr":"5","captionstylesroundedcornersbr":"5","captionstylesroundedcornersbl":"5","captionstylesuseshadow":"0","captionstylesshadowcolor":"","captionstylesshadowblur":"3","captionstylesshadowspread":"0","captionstylesshadowoffsetx":"0","captionstylesshadowoffsety":"0","captionstylesshadowinset":"0","captionstylesuseborders":"0","captionstylesbordercolor":"","captionstylesborderwidth":"1"}', 0, '*'),
(135, 'VirtueMart Ajax Search', '', '', 1, 'user4', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_vm_ajax_search', 1, 0, '{"cache":"0","internal_caching":"0","moduleclass_sfx":"_ajax_search","pretext":"","posttext":"","search_page":"index.php?option=com_virtuemart&page=shop.search","include_advsearch":"0","include_but":"1","offset_top_search_result":"-10","text_box_width":"210","min_height":"20","results_width":"262","offset_left_search_result":"0","number_of_products":"5","css_position":"relative"}', 0, '*'),
(137, 'Top_menu', '', '', 2, 'user3', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_superfish_menu', 1, 0, '{"menutype":"top","startLevel":"1","endLevel":"0","showAllChildren":"1","tag_id":"","class_sfx":"","window_open":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"itemid","sf-delay":"500","sf-animation":"opacity:''show''","sf-speed":"normal","easing":"swing"}', 0, '*'),
(144, 'Shopping  cart:', '', '', 1, 'user6', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_virtuemart_cart_tm', 1, 0, '{"moduleclass_sfx":""}', 0, '*'),
(155, 'Featured products', '', '', 1, 'user2', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_virtuemart_product', 1, 1, '{"layout":"default","product_group":"featured","max_items":"6","products_per_row":"3","display_style":"div","effect":"linear","autoPlay":"true","animSpeed":"500","pauseTime":"3000","controlNav":"1","arrows":"1","pauseOnHover":"1","show_img":"1","show_category":"0","show_title":"1","show_ratings":"0","show_desc":"0","row_desc":"30","show_det":"0","show_price":"1","show_addtocart":"1","headerText":"","footerText":"","filter_category":"0","virtuemart_category_id":"0","cache":"1","moduleclass_sfx":"new","class_sfx":""}', 0, '*'),
(159, 'Login top', '', '', 1, 'user10', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_yj_pop_login', 1, 0, '{"cache":"0","moduleclass_sfx":"_LoginForm","pretext":"","posttext":"","login":"","logout":"","greeting":"1","name":"0","usesecure":"0"}', 0, '*'),
(160, 'Categories', '', '', 1, 'left', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_virtuemart_category', 1, 0, '{"Parent_Category_id":"0","layout":"default","cache":"1","moduleclass_sfx":" categories","class_sfx":""}', 0, '*'),
(167, 'brands', '', '', 1, 'left', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', -2, 'mod_virtuemart_manufacturer', 1, 1, '{"show":"text","display_style":"list","manufacturers_per_row":"","headerText":"","footerText":"","cache":"1","moduleclass_sfx":" manufacturers","class_sfx":""}', 0, '*'),
(171, 'Foot-menu 4', '', '', 4, 'footer-menu', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', -2, 'mod_menu', 1, 0, '{"menutype":"foot-menu4","startLevel":"1","endLevel":"0","showAllChildren":"0","tag_id":"","class_sfx":"","window_open":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"itemid"}', 0, '*'),
(172, 'Foot-menu 3', '', '', 3, 'footer-menu', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', -2, 'mod_menu', 1, 0, '{"menutype":"foot-menu3","startLevel":"1","endLevel":"0","showAllChildren":"0","tag_id":"","class_sfx":"","window_open":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"itemid"}', 0, '*'),
(173, 'Foot-menu2', '', '', 2, 'footer-menu', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', -2, 'mod_menu', 1, 0, '{"menutype":"foot-menu2","startLevel":"1","endLevel":"0","showAllChildren":"0","tag_id":"","class_sfx":"","window_open":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"itemid"}', 0, '*'),
(178, 'System menu', '', '', 1, 'settings', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_menu', 1, 0, '{"menutype":"system-menu","startLevel":"1","endLevel":"0","showAllChildren":"1","tag_id":"","class_sfx":"settings","window_open":"","layout":"_:default","moduleclass_sfx":"settings","cache":"1","cache_time":"900","cachemode":"itemid"}', 0, '*'),
(179, 'Navigation', '', '', 1, 'footer-menu', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', -2, 'mod_menu', 1, 0, '{"menutype":"top","startLevel":"1","endLevel":"1","showAllChildren":"0","tag_id":"","class_sfx":"","window_open":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"itemid"}', 0, '*'),
(182, 'Banner', '', '', 1, 'user8', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_bannersblock', 1, 0, '{"mod_total_image":"4","bannerlink1":"index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=1","bannertitle1":"","bannerheight1":"224px","bannerwidth1":"420px","mod_1_image":"images\\/banners\\/banner1.jpg","mod_image_1_para":"<div class=\\"txt1\\">Bikes\\r\\n<span>& Frames<\\/span><\\/div>\\r\\n","bannerlink2":"index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=2","bannertitle2":"","bannerheight2":"224px","bannerwidth2":"420px","mod_2_image":"images\\/banners\\/banner2.jpg","mod_image_2_para":"<div class=\\"txt1\\">Bike Parts \\r\\n<span>& components<\\/span><\\/div>\\r\\n","bannerlink3":"index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=3","bannertitle3":"","bannerheight3":"224px","bannerwidth3":"420px","mod_3_image":"images\\/banners\\/banner3.jpg","mod_image_3_para":"<div class=\\"txt1\\">Cycling\\r\\n<span>Clothing<\\/span><\\/div>\\r\\n","bannerlink4":"index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=4","bannertitle4":"","bannerheight4":"224px","bannerwidth4":"420px","mod_4_image":"images\\/banners\\/banner4.jpg","mod_image_4_para":"<div class=\\"txt1\\">Helmets \\r\\n<span>& Sunglasses<\\/span><\\/div>\\r\\n","bannerlink5":"index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=5","bannertitle5":"","bannerheight5":"264px","bannerwidth5":"264px","mod_5_image":"images\\/banners\\/banner5.jpg","mod_image_5_para":"<div class=\\"txt1\\">Party\\r\\nDecorations<\\/div>","bannerlink6":"index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=6","bannertitle6":"","bannerheight6":"264px","bannerwidth6":"264px","mod_6_image":"images\\/banners\\/banner6.jpg","mod_image_6_para":"<div class=\\"txt1\\">Party Favors<\\/div>","bannerlink7":"index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=7","bannertitle7":"","bannerheight7":"264px","bannerwidth7":"264px","mod_7_image":"images\\/banners\\/banner7.jpg","mod_image_7_para":"<div class=\\"txt1\\">Party\\r\\nTableware<\\/div>","bannerlink8":"index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=8","bannertitle8":"","bannerheight8":"264px","bannerwidth8":"264px","mod_8_image":"images\\/banners\\/banner8.jpg","mod_image_8_para":"<div class=\\"txt1\\">Personalized\\r\\nParty Supplies<\\/div>","bannerlink9":"","bannertitle9":"","bannerheight9":"","bannerwidth9":"","mod_9_image":"","mod_image_9_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink10":"","bannertitle10":"","bannerheight10":"","bannerwidth10":"","mod_10_image":"","mod_image_10_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink11":"","bannertitle11":"","bannerheight11":"","bannerwidth11":"","mod_11_image":"","mod_image_11_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink12":"","bannertitle12":"","bannerheight12":"","bannerwidth12":"","mod_12_image":"","mod_image_12_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink13":"","bannertitle13":"","bannerheight13":"","bannerwidth13":"","mod_13_image":"","mod_image_13_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink14":"","bannertitle14":"","bannerheight14":"","bannerwidth14":"","mod_14_image":"","mod_image_14_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink15":"","bannertitle15":"","bannerheight15":"","bannerwidth15":"","mod_15_image":"","mod_image_15_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink16":"","bannertitle16":"","bannerheight16":"","bannerwidth16":"","mod_16_image":"","mod_image_16_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink17":"","bannertitle17":"","bannerheight17":"","bannerwidth17":"","mod_17_image":"","mod_image_17_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink18":"","bannertitle18":"","bannerheight18":"","bannerwidth18":"","mod_18_image":"","mod_image_18_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink19":"","bannertitle19":"","bannerheight19":"","bannerwidth19":"","mod_19_image":"","mod_image_19_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink20":"","bannertitle20":"","bannerheight20":"","bannerwidth20":"","mod_20_image":"","mod_image_20_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","moduleclass_sfx":"banner_bot"}', 0, '*'),
(183, 'Phone', '', '<span>Call us:</span>(800) 2345-6789', 1, 'user6', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 0, '{"prepare_content":"0","backgroundimage":"","layout":"_:default","moduleclass_sfx":" phone","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(184, 'foot custom', '', '<div class="line4"><a href="https://www.facebook.com/" class="icon-facebook"> </a><a href="https://twitter.com/" class="icon-twitter"> </a></div>', 4, 'user5', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', -2, 'mod_custom', 1, 0, '{"prepare_content":"0","backgroundimage":"","layout":"_:default","moduleclass_sfx":" foot-custom","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(185, 'Banner bot', '', '', 1, 'left', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_bannersblock', 1, 0, '{"mod_total_image":"3","bannerlink1":"index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=1","bannertitle1":"","bannerheight1":"75px","bannerwidth1":"270px","mod_1_image":"images\\/banners\\/facebook.jpg","mod_image_1_para":"","bannerlink2":"index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=2","bannertitle2":"","bannerheight2":"75px","bannerwidth2":"270px","mod_2_image":"images\\/banners\\/twitter.jpg","mod_image_2_para":"","bannerlink3":"index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=3","bannertitle3":"","bannerheight3":"365px","bannerwidth3":"270px","mod_3_image":"images\\/banners\\/banner5.jpg","mod_image_3_para":"<div class=\\"txt1\\"><i>Free<\\/i> \\r\\nShipping<span>on orders over<\\/span><b>$99<\\/b><\\/div>\\r\\n<div class=\\"txt2\\">This offer is valid on all our store items.<\\/div>","bannerlink4":"index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=4","bannertitle4":"","bannerheight4":"264px","bannerwidth4":"264px","mod_4_image":"images\\/banners\\/banner4.jpg","mod_image_4_para":"<div class=\\"txt1\\">Invitations\\r\\n& Stationery<\\/div>\\r\\n","bannerlink5":"index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=5","bannertitle5":"","bannerheight5":"264px","bannerwidth5":"264px","mod_5_image":"images\\/banners\\/banner5.jpg","mod_image_5_para":"<div class=\\"txt1\\">Party\\r\\nDecorations<\\/div>","bannerlink6":"index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=6","bannertitle6":"","bannerheight6":"264px","bannerwidth6":"264px","mod_6_image":"images\\/banners\\/banner6.jpg","mod_image_6_para":"<div class=\\"txt1\\">Party Favors<\\/div>","bannerlink7":"index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=7","bannertitle7":"","bannerheight7":"264px","bannerwidth7":"264px","mod_7_image":"images\\/banners\\/banner7.jpg","mod_image_7_para":"<div class=\\"txt1\\">Party\\r\\nTableware<\\/div>","bannerlink8":"index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=8","bannertitle8":"","bannerheight8":"264px","bannerwidth8":"264px","mod_8_image":"images\\/banners\\/banner8.jpg","mod_image_8_para":"<div class=\\"txt1\\">Personalized\\r\\nParty Supplies<\\/div>","bannerlink9":"","bannertitle9":"","bannerheight9":"","bannerwidth9":"","mod_9_image":"","mod_image_9_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink10":"","bannertitle10":"","bannerheight10":"","bannerwidth10":"","mod_10_image":"","mod_image_10_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink11":"","bannertitle11":"","bannerheight11":"","bannerwidth11":"","mod_11_image":"","mod_image_11_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink12":"","bannertitle12":"","bannerheight12":"","bannerwidth12":"","mod_12_image":"","mod_image_12_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink13":"","bannertitle13":"","bannerheight13":"","bannerwidth13":"","mod_13_image":"","mod_image_13_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink14":"","bannertitle14":"","bannerheight14":"","bannerwidth14":"","mod_14_image":"","mod_image_14_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink15":"","bannertitle15":"","bannerheight15":"","bannerwidth15":"","mod_15_image":"","mod_image_15_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink16":"","bannertitle16":"","bannerheight16":"","bannerwidth16":"","mod_16_image":"","mod_image_16_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink17":"","bannertitle17":"","bannerheight17":"","bannerwidth17":"","mod_17_image":"","mod_image_17_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink18":"","bannertitle18":"","bannerheight18":"","bannerwidth18":"","mod_18_image":"","mod_image_18_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink19":"","bannertitle19":"","bannerheight19":"","bannerwidth19":"","mod_19_image":"","mod_image_19_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","bannerlink20":"","bannertitle20":"","bannerheight20":"","bannerwidth20":"","mod_20_image":"","mod_image_20_para":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in dolor quam. Morbi urna turpis, interdum eu aliquam sit amet, adipiscing non lectus.","moduleclass_sfx":"banner_bot2"}', 0, '*'),
(186, 'Custom HTML', '', 'Free Shipping\r\n<span>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea</span>', 1, 'user9', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', -2, 'mod_custom', 1, 0, '{"prepare_content":"0","backgroundimage":"","layout":"_:default","moduleclass_sfx":"Custom","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*');

-- --------------------------------------------------------

--
-- Table structure for table `jos_modules_menu`
--

DROP TABLE IF EXISTS `jos_modules_menu`;
CREATE TABLE `jos_modules_menu` (
  `moduleid` int(11) NOT NULL DEFAULT '0',
  `menuid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`moduleid`,`menuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_modules_menu`
--

INSERT INTO `jos_modules_menu` (`moduleid`, `menuid`) VALUES
(2, 0),
(3, 0),
(4, 0),
(6, 0),
(7, 0),
(8, 0),
(9, 0),
(10, 0),
(12, 0),
(13, 0),
(14, 0),
(15, 0),
(32, 309),
(79, 0),
(86, 0),
(95, 0),
(107, 0),
(115, 444),
(115, 464),
(115, 474),
(115, 475),
(115, 476),
(115, 478),
(115, 479),
(115, 481),
(115, 482),
(115, 486),
(117, 470),
(118, 470),
(130, 435),
(130, 464),
(135, 0),
(137, 0),
(144, 0),
(155, 435),
(155, 464),
(159, 0),
(160, 0),
(163, 0),
(167, 207),
(167, 444),
(167, 471),
(167, 472),
(167, 476),
(167, 478),
(167, 481),
(167, 482),
(167, 486),
(167, 489),
(167, 490),
(167, 491),
(167, 492),
(167, 493),
(167, 494),
(167, 495),
(167, 496),
(167, 497),
(167, 524),
(167, 536),
(171, 207),
(171, 444),
(171, 470),
(171, 471),
(171, 472),
(171, 476),
(171, 478),
(171, 481),
(171, 482),
(171, 486),
(171, 489),
(171, 490),
(171, 491),
(171, 492),
(171, 493),
(171, 494),
(171, 495),
(171, 496),
(171, 497),
(171, 524),
(171, 536),
(172, 207),
(172, 444),
(172, 470),
(172, 471),
(172, 472),
(172, 476),
(172, 478),
(172, 481),
(172, 482),
(172, 486),
(172, 489),
(172, 490),
(172, 491),
(172, 492),
(172, 493),
(172, 494),
(172, 495),
(172, 496),
(172, 497),
(172, 524),
(172, 536),
(173, 207),
(173, 444),
(173, 470),
(173, 471),
(173, 472),
(173, 476),
(173, 478),
(173, 481),
(173, 482),
(173, 486),
(173, 489),
(173, 490),
(173, 491),
(173, 492),
(173, 493),
(173, 494),
(173, 495),
(173, 496),
(173, 497),
(173, 524),
(173, 536),
(178, 0),
(179, 207),
(179, 444),
(179, 470),
(179, 471),
(179, 472),
(179, 476),
(179, 478),
(179, 481),
(179, 482),
(179, 486),
(179, 489),
(179, 490),
(179, 491),
(179, 492),
(179, 493),
(179, 494),
(179, 495),
(179, 496),
(179, 497),
(179, 524),
(179, 536),
(182, 435),
(182, 464),
(183, 0),
(184, 0),
(185, 435),
(185, 464),
(186, 435),
(186, 464);

-- --------------------------------------------------------

--
-- Table structure for table `jos_newsfeeds`
--

DROP TABLE IF EXISTS `jos_newsfeeds`;
CREATE TABLE `jos_newsfeeds` (
  `catid` int(11) NOT NULL DEFAULT '0',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `link` varchar(200) NOT NULL DEFAULT '',
  `filename` varchar(200) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `numarticles` int(10) unsigned NOT NULL DEFAULT '1',
  `cache_time` int(10) unsigned NOT NULL DEFAULT '3600',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rtl` tinyint(4) NOT NULL DEFAULT '0',
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`published`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `jos_newsfeeds`
--

INSERT INTO `jos_newsfeeds` (`catid`, `id`, `name`, `alias`, `link`, `filename`, `published`, `numarticles`, `cache_time`, `checked_out`, `checked_out_time`, `ordering`, `rtl`, `access`, `language`, `params`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `metakey`, `metadesc`, `metadata`, `xreference`, `publish_up`, `publish_down`) VALUES
(17, 1, 'Joomla! Announcements', 'joomla-announcements', 'http://www.joomla.org/announcements.feed?type=rss', NULL, 1, 5, 3600, 0, '0000-00-00 00:00:00', 1, 1, 1, 'en-GB', '{"show_feed_image":"","show_feed_description":"","show_item_description":"","feed_character_count":"0","newsfeed_layout":"","feed_display_order":""}', '2011-01-01 00:00:01', 0, '', '2011-12-27 12:25:05', 0, '', '', '{"robots":"","rights":""}', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 2, 'New Joomla! Extensions', 'new-joomla-extensions', 'http://feeds.joomla.org/JoomlaExtensions', NULL, 1, 5, 3600, 0, '0000-00-00 00:00:00', 4, 1, 1, 'en-GB', '{"show_feed_image":"","show_feed_description":"","show_item_description":"","feed_character_count":"0","newsfeed_layout":"","feed_display_order":""}', '2011-01-01 00:00:01', 0, '', '2011-12-27 12:25:36', 0, '', '', '{"robots":"","rights":""}', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 3, 'Joomla! Security News', 'joomla-security-news', 'http://feeds.joomla.org/JoomlaSecurityNews', NULL, 1, 5, 3600, 0, '0000-00-00 00:00:00', 2, 1, 1, 'en-GB', '{"show_feed_image":"","show_feed_description":"","show_item_description":"","feed_character_count":"0","newsfeed_layout":"","feed_display_order":""}', '2011-01-01 00:00:01', 0, '', '2011-12-27 12:24:55', 0, '', '', '{"robots":"","rights":""}', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 4, 'Joomla! Connect', 'joomla-connect', 'http://feeds.joomla.org/JoomlaConnect', NULL, 1, 5, 3600, 0, '0000-00-00 00:00:00', 3, 1, 1, 'en-GB', '{"show_feed_image":"","show_feed_description":"","show_item_description":"","feed_character_count":"0","newsfeed_layout":"","feed_display_order":""}', '2011-01-01 00:00:01', 0, '', '2011-12-27 12:25:10', 0, '', '', '{"robots":"","rights":""}', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `jos_overrider`
--

DROP TABLE IF EXISTS `jos_overrider`;
CREATE TABLE `jos_overrider` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `constant` varchar(255) NOT NULL,
  `string` text NOT NULL,
  `file` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jos_redirect_links`
--

DROP TABLE IF EXISTS `jos_redirect_links`;
CREATE TABLE `jos_redirect_links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `old_url` varchar(255) NOT NULL,
  `new_url` varchar(255) NOT NULL,
  `referer` varchar(150) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_link_old` (`old_url`),
  KEY `idx_link_modifed` (`modified_date`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jos_redirect_links`
--

INSERT INTO `jos_redirect_links` (`id`, `old_url`, `new_url`, `referer`, `comment`, `hits`, `published`, `created_date`, `modified_date`) VALUES
(1, 'http://192.168.9.37/Virtuemart/theme472/index.php/administrator', '', '', '', 1, 0, '2014-02-10 09:13:08', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `jos_schemas`
--

DROP TABLE IF EXISTS `jos_schemas`;
CREATE TABLE `jos_schemas` (
  `extension_id` int(11) NOT NULL,
  `version_id` varchar(20) NOT NULL,
  PRIMARY KEY (`extension_id`,`version_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_schemas`
--

INSERT INTO `jos_schemas` (`extension_id`, `version_id`) VALUES
(700, '2.5.17');

-- --------------------------------------------------------

--
-- Table structure for table `jos_template_styles`
--

DROP TABLE IF EXISTS `jos_template_styles`;
CREATE TABLE `jos_template_styles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `template` varchar(50) NOT NULL DEFAULT '',
  `client_id` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `home` char(7) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_template` (`template`),
  KEY `idx_home` (`home`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=136 ;

--
-- Dumping data for table `jos_template_styles`
--

INSERT INTO `jos_template_styles` (`id`, `template`, `client_id`, `home`, `title`, `params`) VALUES
(2, 'bluestork', 1, '1', 'Bluestork - Default', '{"useRoundedCorners":"1","showSiteName":"0"}'),
(3, 'atomic', 0, '0', 'Atomic - Default', '{}'),
(4, 'beez_20', 0, '0', 'Beez2 - Default', '{"wrapperSmall":53,"wrapperLarge":72,"logo":"images\\/joomla_black.gif","sitetitle":"Joomla!","sitedescription":"Open Source Content Management","navposition":"left","templatecolor":"personal"}'),
(5, 'hathor', 1, '0', 'Hathor - Default', '{"showSiteName":"0","colourChoice":"","boldText":"0"}'),
(6, 'beez5', 0, '0', 'Beez5 - Default', '{"wrapperSmall":53,"wrapperLarge":72,"logo":"images\\/stories\\/virtuemart\\/vendor\\/washupito.gif","sitetitle":"Tiendita","sitedescription":"Open Source VM2","navposition":"left","html5":1}'),
(114, 'beez_20', 0, '0', 'Beez2 - Parks Site', '{"wrapperSmall":53,"wrapperLarge":72,"logo":"","sitetitle":"Australian Parks","sitedescription":"Parks Sample Site","navposition":"center","templatecolor":"nature"}'),
(131, 'theme514', 0, '0', 'theme514 - Default', '{"logo":"images\\/stories\\/logo.png","sitetitle":"","sitedescription":""}'),
(135, 'theme538', 0, '1', 'theme538 - Default', '{"logo":"images\\/stories\\/logo.png","sitetitle":"","sitedescription":""}');

-- --------------------------------------------------------

--
-- Table structure for table `jos_updates`
--

DROP TABLE IF EXISTS `jos_updates`;
CREATE TABLE `jos_updates` (
  `update_id` int(11) NOT NULL AUTO_INCREMENT,
  `update_site_id` int(11) DEFAULT '0',
  `extension_id` int(11) DEFAULT '0',
  `categoryid` int(11) DEFAULT '0',
  `name` varchar(100) DEFAULT '',
  `description` text NOT NULL,
  `element` varchar(100) DEFAULT '',
  `type` varchar(20) DEFAULT '',
  `folder` varchar(20) DEFAULT '',
  `client_id` tinyint(3) DEFAULT '0',
  `version` varchar(10) DEFAULT '',
  `data` text NOT NULL,
  `detailsurl` text NOT NULL,
  `infourl` text NOT NULL,
  PRIMARY KEY (`update_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Available Updates' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `jos_updates`
--

INSERT INTO `jos_updates` (`update_id`, `update_site_id`, `extension_id`, `categoryid`, `name`, `description`, `element`, `type`, `folder`, `client_id`, `version`, `data`, `detailsurl`, `infourl`) VALUES
(1, 2, 700, 0, 'Joomla', '', 'joomla', 'file', '', 0, '2.5.18', '', 'http://update.joomla.org/core/extension.xml', ''),
(2, 2, 0, 0, 'Joomla', '', 'joomla', 'file', '', 0, '2.5.19', '', 'http://update.joomla.org/core/extension.xml', ''),
(3, 2, 0, 0, 'Joomla', '', 'joomla', 'file', '', 0, '2.5.19', '', 'http://update.joomla.org/core/extension.xml', '');

-- --------------------------------------------------------

--
-- Table structure for table `jos_update_categories`
--

DROP TABLE IF EXISTS `jos_update_categories`;
CREATE TABLE `jos_update_categories` (
  `categoryid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT '',
  `description` text NOT NULL,
  `parent` int(11) DEFAULT '0',
  `updatesite` int(11) DEFAULT '0',
  PRIMARY KEY (`categoryid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Update Categories' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jos_update_sites`
--

DROP TABLE IF EXISTS `jos_update_sites`;
CREATE TABLE `jos_update_sites` (
  `update_site_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT '',
  `type` varchar(20) DEFAULT '',
  `location` text NOT NULL,
  `enabled` int(11) DEFAULT '0',
  `last_check_timestamp` bigint(20) DEFAULT '0',
  PRIMARY KEY (`update_site_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Update Sites' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `jos_update_sites`
--

INSERT INTO `jos_update_sites` (`update_site_id`, `name`, `type`, `location`, `enabled`, `last_check_timestamp`) VALUES
(1, 'Slideshow CK Update', 'extension', 'http://update.joomlack.fr/mod_slideshowck_update.xml', 0, 1392390486),
(2, '', 'collection', 'http://update.joomla.org/core/list.xml', 0, 1394389942),
(3, '', 'collection', 'http://update.joomla.org/jed/list.xml', 0, 1394389942);

-- --------------------------------------------------------

--
-- Table structure for table `jos_update_sites_extensions`
--

DROP TABLE IF EXISTS `jos_update_sites_extensions`;
CREATE TABLE `jos_update_sites_extensions` (
  `update_site_id` int(11) NOT NULL DEFAULT '0',
  `extension_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`update_site_id`,`extension_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Links extensions to update sites';

--
-- Dumping data for table `jos_update_sites_extensions`
--

INSERT INTO `jos_update_sites_extensions` (`update_site_id`, `extension_id`) VALUES
(1, 700),
(1, 10055),
(2, 700),
(3, 700),
(4, 10055);

-- --------------------------------------------------------

--
-- Table structure for table `jos_viewlevels`
--

DROP TABLE IF EXISTS `jos_viewlevels`;
CREATE TABLE `jos_viewlevels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `title` varchar(100) NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rules` varchar(5120) NOT NULL COMMENT 'JSON encoded access control.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_assetgroup_title_lookup` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `jos_viewlevels`
--

INSERT INTO `jos_viewlevels` (`id`, `title`, `ordering`, `rules`) VALUES
(1, 'Public', 0, '[1]'),
(2, 'Registered', 1, '[6,2,8]'),
(3, 'Special', 2, '[6,3,8]'),
(4, 'Customer Access Level (Example)', 3, '[6,3,12]');

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_adminmenuentries`
--

DROP TABLE IF EXISTS `jos_virtuemart_adminmenuentries`;
CREATE TABLE `jos_virtuemart_adminmenuentries` (
  `id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `module_id` tinyint(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The ID of the VM Module, this Item is assigned to',
  `parent_id` tinyint(11) unsigned NOT NULL DEFAULT '0',
  `name` char(64) NOT NULL DEFAULT '0',
  `link` char(64) NOT NULL DEFAULT '0',
  `depends` char(64) NOT NULL DEFAULT '' COMMENT 'Names of the Parameters, this Item depends on',
  `icon_class` char(96) DEFAULT NULL,
  `ordering` int(2) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `tooltip` char(128) DEFAULT NULL,
  `view` char(32) DEFAULT NULL,
  `task` char(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module_id` (`module_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Administration Menu Items' AUTO_INCREMENT=29 ;

--
-- Dumping data for table `jos_virtuemart_adminmenuentries`
--

INSERT INTO `jos_virtuemart_adminmenuentries` (`id`, `module_id`, `parent_id`, `name`, `link`, `depends`, `icon_class`, `ordering`, `published`, `tooltip`, `view`, `task`) VALUES
(1, 1, 0, 'COM_VIRTUEMART_CATEGORY_S', '', '', 'vmicon vmicon-16-folder_camera', 1, 1, '', 'category', ''),
(2, 1, 0, 'COM_VIRTUEMART_PRODUCT_S', '', '', 'vmicon vmicon-16-camera', 2, 1, '', 'product', ''),
(3, 1, 0, 'COM_VIRTUEMART_PRODUCT_CUSTOM_FIELD_S', '', '', 'vmicon vmicon-16-document_move', 5, 1, '', 'custom', ''),
(4, 1, 0, 'COM_VIRTUEMART_PRODUCT_INVENTORY', '', '', 'vmicon vmicon-16-price_watch', 7, 1, '', 'inventory', ''),
(5, 1, 0, 'COM_VIRTUEMART_CALC_S', '', '', 'vmicon vmicon-16-calculator', 8, 1, '', 'calc', ''),
(6, 1, 0, 'COM_VIRTUEMART_REVIEW_RATE_S', '', '', 'vmicon vmicon-16-comments', 9, 1, '', 'ratings', ''),
(7, 2, 0, 'COM_VIRTUEMART_ORDER_S', '', '', 'vmicon vmicon-16-page_white_stack', 1, 1, '', 'orders', ''),
(8, 2, 0, 'COM_VIRTUEMART_COUPON_S', '', '', 'vmicon vmicon-16-shopping', 10, 1, '', 'coupon', ''),
(9, 2, 0, 'COM_VIRTUEMART_REPORT', '', '', 'vmicon vmicon-16-to_do_list_cheked_1', 3, 1, '', 'report', ''),
(10, 2, 0, 'COM_VIRTUEMART_USER_S', '', '', 'vmicon vmicon-16-user', 4, 1, '', 'user', ''),
(11, 2, 0, 'COM_VIRTUEMART_SHOPPERGROUP_S', '', '', 'vmicon vmicon-16-user-group', 5, 1, '', 'shoppergroup', ''),
(12, 3, 0, 'COM_VIRTUEMART_MANUFACTURER_S', '', '', 'vmicon vmicon-16-wrench_orange', 1, 1, '', 'manufacturer', ''),
(13, 3, 0, 'COM_VIRTUEMART_MANUFACTURER_CATEGORY_S', '', '', 'vmicon vmicon-16-folder_wrench', 2, 1, '', 'manufacturercategories', ''),
(14, 4, 0, 'COM_VIRTUEMART_STORE', '', '', 'vmicon vmicon-16-reseller_account_template', 1, 1, '', 'user', 'editshop'),
(15, 4, 0, 'COM_VIRTUEMART_MEDIA_S', '', '', 'vmicon vmicon-16-pictures', 2, 1, '', 'media', ''),
(16, 4, 0, 'COM_VIRTUEMART_SHIPMENTMETHOD_S', '', '', 'vmicon vmicon-16-lorry', 3, 1, '', 'shipmentmethod', ''),
(17, 4, 0, 'COM_VIRTUEMART_PAYMENTMETHOD_S', '', '', 'vmicon vmicon-16-creditcards', 4, 1, '', 'paymentmethod', ''),
(18, 5, 0, 'COM_VIRTUEMART_CONFIGURATION', '', '', 'vmicon vmicon-16-config', 1, 1, '', 'config', ''),
(19, 5, 0, 'COM_VIRTUEMART_USERFIELD_S', '', '', 'vmicon vmicon-16-participation_rate', 2, 1, '', 'userfields', ''),
(20, 5, 0, 'COM_VIRTUEMART_ORDERSTATUS_S', '', '', 'vmicon vmicon-16-orderstatus', 3, 1, '', 'orderstatus', ''),
(21, 5, 0, 'COM_VIRTUEMART_CURRENCY_S', '', '', 'vmicon vmicon-16-coins', 5, 1, '', 'currency', ''),
(22, 5, 0, 'COM_VIRTUEMART_COUNTRY_S', '', '', 'vmicon vmicon-16-globe', 6, 1, '', 'country', ''),
(23, 11, 0, 'COM_VIRTUEMART_MIGRATION_UPDATE', '', '', 'vmicon vmicon-16-installer_box', 1, 1, '', 'updatesmigration', ''),
(24, 11, 0, 'COM_VIRTUEMART_ABOUT', '', '', 'vmicon vmicon-16-info', 2, 1, '', 'about', ''),
(25, 11, 0, 'COM_VIRTUEMART_HELP_TOPICS', 'http://virtuemart.net/', '', 'vmicon vmicon-16-help', 4, 1, '', '', ''),
(26, 11, 0, 'COM_VIRTUEMART_COMMUNITY_FORUM', 'http://forum.virtuemart.net/', '', 'vmicon vmicon-16-reseller_programm', 6, 1, '', '', ''),
(27, 11, 0, 'COM_VIRTUEMART_STATISTIC_SUMMARY', '', '', 'vmicon vmicon-16-info', 1, 1, '', 'virtuemart', ''),
(28, 77, 0, 'COM_VIRTUEMART_USER_GROUP_S', '', '', 'vmicon vmicon-16-user', 2, 1, '', 'usergroups', '');

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_calcs`
--

DROP TABLE IF EXISTS `jos_virtuemart_calcs`;
CREATE TABLE `jos_virtuemart_calcs` (
  `virtuemart_calc_id` smallint(1) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_vendor_id` smallint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Belongs to vendor',
  `calc_jplugin_id` int(11) NOT NULL DEFAULT '0',
  `calc_name` char(64) NOT NULL DEFAULT '' COMMENT 'Name of the rule',
  `calc_descr` char(128) NOT NULL DEFAULT '' COMMENT 'Description',
  `calc_kind` char(16) NOT NULL DEFAULT '' COMMENT 'Discount/Tax/Margin/Commission',
  `calc_value_mathop` char(8) NOT NULL DEFAULT '' COMMENT 'the mathematical operation like (+,-,+%,-%)',
  `calc_value` decimal(10,4) NOT NULL DEFAULT '0.0000' COMMENT 'The Amount',
  `calc_currency` smallint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Currency of the Rule',
  `calc_shopper_published` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Visible for Shoppers',
  `calc_vendor_published` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Visible for Vendors',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Startdate if nothing is set = permanent',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Enddate if nothing is set = permanent',
  `for_override` tinyint(1) NOT NULL DEFAULT '0',
  `calc_params` varchar(18000) DEFAULT NULL,
  `ordering` int(2) NOT NULL DEFAULT '0',
  `shared` tinyint(1) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`virtuemart_calc_id`),
  KEY `i_virtuemart_vendor_id` (`virtuemart_vendor_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `jos_virtuemart_calcs`
--

INSERT INTO `jos_virtuemart_calcs` (`virtuemart_calc_id`, `virtuemart_vendor_id`, `calc_jplugin_id`, `calc_name`, `calc_descr`, `calc_kind`, `calc_value_mathop`, `calc_value`, `calc_currency`, `calc_shopper_published`, `calc_vendor_published`, `publish_up`, `publish_down`, `for_override`, `calc_params`, `ordering`, `shared`, `published`, `created_on`, `created_by`, `modified_on`, `modified_by`, `locked_on`, `locked_by`) VALUES
(1, 1, 0, 'Tax 21%', 'A simple tax for all products regardless the category', 'VatTax', '+%', '21.0000', 47, 1, 1, '2010-02-21 00:00:00', '0000-00-00 00:00:00', 0, NULL, 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(2, 1, 0, 'Discount for all Hand Tools', 'Discount for all Hand Tools 2 euro', 'DATax', '-', '2.0000', 47, 1, 1, '2010-02-21 00:00:00', '0000-00-00 00:00:00', 0, NULL, 1, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(3, 1, 0, 'Duty for Powertools', 'Ah tax that only effects a certain category, Power Tools, and Shoppergroup', 'Tax', '+%', '20.0000', 144, 0, 0, '2012-02-09 00:00:00', '2013-08-23 00:00:00', 0, '', 0, 0, 1, '0000-00-00 00:00:00', 0, '2013-08-12 08:41:15', 79, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_calc_categories`
--

DROP TABLE IF EXISTS `jos_virtuemart_calc_categories`;
CREATE TABLE `jos_virtuemart_calc_categories` (
  `id` mediumint(1) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_calc_id` smallint(1) unsigned NOT NULL DEFAULT '0',
  `virtuemart_category_id` smallint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `i_virtuemart_calc_id` (`virtuemart_calc_id`,`virtuemart_category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `jos_virtuemart_calc_categories`
--

INSERT INTO `jos_virtuemart_calc_categories` (`id`, `virtuemart_calc_id`, `virtuemart_category_id`) VALUES
(1, 3, 2),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_calc_countries`
--

DROP TABLE IF EXISTS `jos_virtuemart_calc_countries`;
CREATE TABLE `jos_virtuemart_calc_countries` (
  `id` mediumint(1) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_calc_id` smallint(1) unsigned NOT NULL DEFAULT '0',
  `virtuemart_country_id` smallint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `i_virtuemart_calc_id` (`virtuemart_calc_id`,`virtuemart_country_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_calc_manufacturers`
--

DROP TABLE IF EXISTS `jos_virtuemart_calc_manufacturers`;
CREATE TABLE `jos_virtuemart_calc_manufacturers` (
  `id` mediumint(1) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_calc_id` smallint(1) unsigned NOT NULL DEFAULT '0',
  `virtuemart_manufacturer_id` smallint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `i_virtuemart_calc_id` (`virtuemart_calc_id`,`virtuemart_manufacturer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_calc_shoppergroups`
--

DROP TABLE IF EXISTS `jos_virtuemart_calc_shoppergroups`;
CREATE TABLE `jos_virtuemart_calc_shoppergroups` (
  `id` mediumint(1) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_calc_id` smallint(1) unsigned NOT NULL DEFAULT '0',
  `virtuemart_shoppergroup_id` smallint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `i_virtuemart_calc_id` (`virtuemart_calc_id`,`virtuemart_shoppergroup_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jos_virtuemart_calc_shoppergroups`
--

INSERT INTO `jos_virtuemart_calc_shoppergroups` (`id`, `virtuemart_calc_id`, `virtuemart_shoppergroup_id`) VALUES
(1, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_calc_states`
--

DROP TABLE IF EXISTS `jos_virtuemart_calc_states`;
CREATE TABLE `jos_virtuemart_calc_states` (
  `id` mediumint(1) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_calc_id` smallint(1) unsigned NOT NULL DEFAULT '0',
  `virtuemart_state_id` smallint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `i_virtuemart_calc_id` (`virtuemart_calc_id`,`virtuemart_state_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_categories`
--

DROP TABLE IF EXISTS `jos_virtuemart_categories`;
CREATE TABLE `jos_virtuemart_categories` (
  `virtuemart_category_id` smallint(1) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_vendor_id` smallint(1) unsigned NOT NULL DEFAULT '0',
  `category_template` char(128) DEFAULT NULL,
  `category_layout` char(64) DEFAULT NULL,
  `category_product_layout` char(64) DEFAULT NULL,
  `products_per_row` tinyint(2) DEFAULT NULL,
  `limit_list_start` smallint(1) unsigned DEFAULT NULL,
  `limit_list_step` char(32) DEFAULT NULL,
  `limit_list_max` smallint(1) unsigned DEFAULT NULL,
  `limit_list_initial` smallint(1) unsigned DEFAULT NULL,
  `hits` int(1) unsigned NOT NULL DEFAULT '0',
  `metarobot` char(40) NOT NULL DEFAULT '',
  `metaauthor` char(64) NOT NULL DEFAULT '',
  `ordering` int(2) NOT NULL DEFAULT '0',
  `shared` tinyint(1) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`virtuemart_category_id`),
  KEY `idx_category_virtuemart_vendor_id` (`virtuemart_vendor_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Product Categories are stored here' AUTO_INCREMENT=15 ;

--
-- Dumping data for table `jos_virtuemart_categories`
--

INSERT INTO `jos_virtuemart_categories` (`virtuemart_category_id`, `virtuemart_vendor_id`, `category_template`, `category_layout`, `category_product_layout`, `products_per_row`, `limit_list_start`, `limit_list_step`, `limit_list_max`, `limit_list_initial`, `hits`, `metarobot`, `metaauthor`, `ordering`, `shared`, `published`, `created_on`, `created_by`, `modified_on`, `modified_by`, `locked_on`, `locked_by`) VALUES
(1, 1, '0', '0', '0', 0, 0, '0', 0, 0, 0, '', '', 1, 0, 1, '0000-00-00 00:00:00', 0, '2014-09-04 11:21:56', 42, '0000-00-00 00:00:00', 0),
(2, 1, '0', '0', '0', 0, 0, '0', 0, 0, 0, '', '', 2, 0, 1, '2012-01-11 10:32:33', 0, '2014-09-04 11:22:07', 42, '0000-00-00 00:00:00', 0),
(3, 1, '0', '0', '0', 0, 0, '0', 0, 0, 0, '', '', 3, 0, 1, '2012-01-11 10:32:11', 0, '2014-09-04 11:22:21', 42, '0000-00-00 00:00:00', 0),
(4, 1, '0', '0', '0', 0, 0, '0', 0, 0, 0, '', '', 4, 0, 1, '2012-01-11 10:32:02', 0, '2014-09-04 11:22:32', 42, '0000-00-00 00:00:00', 0),
(5, 1, '0', '0', '0', 0, 0, '0', 0, 0, 0, '', '', 5, 0, 1, '2012-01-11 10:31:36', 0, '2014-09-04 11:22:43', 42, '0000-00-00 00:00:00', 0),
(6, 1, '0', '0', '0', 0, 0, '0', 0, 0, 0, '', '', 6, 0, 1, '2012-01-11 10:33:42', 0, '2014-09-04 11:22:53', 42, '0000-00-00 00:00:00', 0),
(7, 1, '0', '0', '0', 0, 0, '0', 0, 0, 0, '', '', 3, 0, 1, '2012-01-11 10:34:00', 0, '2014-09-04 11:23:01', 42, '0000-00-00 00:00:00', 0),
(8, 1, '0', '0', '0', 0, 0, '0', 0, 0, 0, '', '', 8, 0, 1, '2012-01-11 10:36:26', 0, '2014-09-04 11:23:10', 42, '0000-00-00 00:00:00', 0),
(9, 1, '0', '0', '0', 0, 0, '0', 0, 0, 0, '', '', 9, 0, 1, '2012-01-11 10:34:29', 0, '2014-09-04 11:23:19', 42, '0000-00-00 00:00:00', 0),
(10, 1, '0', '0', '0', 0, 0, '0', 0, 0, 0, '', '', 10, 0, 1, '2012-01-11 10:34:45', 0, '2014-09-04 11:23:30', 42, '0000-00-00 00:00:00', 0),
(11, 1, '0', '0', '0', 0, 0, '0', 0, 0, 0, '', '', 11, 0, 1, '2012-01-11 10:35:00', 0, '2014-08-04 08:11:09', 42, '0000-00-00 00:00:00', 0),
(12, 1, '0', '0', '0', 0, 0, '0', 0, 0, 0, '', '', 12, 0, 1, '2012-01-11 12:41:46', 0, '2014-08-04 08:12:08', 42, '0000-00-00 00:00:00', 0),
(13, 1, '0', '0', '0', 0, 0, '0', 0, 0, 0, '', '', 13, 0, 1, '2012-01-11 12:41:10', 0, '2014-08-04 08:12:20', 42, '0000-00-00 00:00:00', 0),
(14, 1, '0', '0', '0', 0, 0, '0', 0, 0, 0, '', '', 14, 0, 1, '2012-01-11 12:41:35', 0, '2014-08-04 08:12:30', 42, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_categories_en_gb`
--

DROP TABLE IF EXISTS `jos_virtuemart_categories_en_gb`;
CREATE TABLE `jos_virtuemart_categories_en_gb` (
  `virtuemart_category_id` int(1) unsigned NOT NULL,
  `category_name` char(180) NOT NULL DEFAULT '',
  `category_description` varchar(19000) NOT NULL DEFAULT '',
  `metadesc` varchar(400) NOT NULL DEFAULT '',
  `metakey` varchar(400) NOT NULL DEFAULT '',
  `customtitle` char(255) NOT NULL DEFAULT '',
  `slug` char(192) NOT NULL DEFAULT '',
  PRIMARY KEY (`virtuemart_category_id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_virtuemart_categories_en_gb`
--

INSERT INTO `jos_virtuemart_categories_en_gb` (`virtuemart_category_id`, `category_name`, `category_description`, `metadesc`, `metakey`, `customtitle`, `slug`) VALUES
(1, 'BIKES & FRAMES', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc suscipit, tortor quis aliquam luctus, eros lorem ornare lectus, vitae tincidunt est leo ac lectus.</p>', '', '', '', 'bikes-frames'),
(2, 'BIKE PARTS', '<p>Vivamus ante lorem, eleifend nec interdum non, ullamcorper et arcu. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>', '', '', '', 'bike-parts'),
(3, 'TIRES, TUBES & WHEELS', 'Praesent erat magna, suscipit a iaculis eu, pretium eu ipsum. Sed diam risus, ultricies eget dapibus sed, imperdiet id felis. Nulla dapibus, orci ut.</p>', '', '', '', 'tires-tubes-wheels'),
(4, 'CYCLING CLOTHING', '<p>Donec ultricies tincidunt nisi eget tempor. Fusce condimentum ullamcorper nisl et condimentum. Quisque nec lectus ipsum.</p>', '', '', '', 'cycling-clothing'),
(5, 'SHOES & PEDALS', '<p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium.</p>', '', '', '', 'shoes-pedals'),
(6, 'HELMETS & SUNGLASSES', '<p>Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed. Fusce id neque eu tellus luctus adipiscing.</p>', '', '', '', 'helmets-sunglasses'),
(7, 'NUTRITION', '<p>Proin lobortis eleifend elit, at lacinia libero suscipit sed. Aliquam fringilla euismod risus ac bibendum. Sed sit amet sem varius ante feugiat lacinia.</p>', '', '', '', 'nutrition'),
(8, 'LIGHTS & ACCESSORIES', '<p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa.</p>', '', '', '', 'lights-accessories'),
(9, 'BIKE TOOLS', '<p>Ut mi erat, consectetur in scelerisque vitae, sollicitudin eu augue. Vivamus molestie ornare neque a placerat.</p>', '', '', '', 'bike-tools-s'),
(10, 'BICYCLE TRAINERS', '<p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget.</p>', '', '', '', 'bicycle-trainers'),
(11, 'Elit sed do', '<p>Proin viverra, urna nec auctor pulvinar, turpis dui sagittis nulla, non commodo lacus est vitae nunc. Quisque ullamcorper sapien quis ipsum eleifend.</p>', '', '', '', 'elit-sed-do'),
(12, 'Proin hendrerit nisl', '<p>Proin hendrerit nisl quis nulla aliquet a iaculis justo venenatis. Integer congue lacus vitae diam accumsan at semper lacus feugiat.</p>', '', '', '', 'proin-hendrerit-nisl'),
(13, 'Aliquam nunc mi', '<p>Aliquam nunc mi, faucibus et aliquam eu, mollis ac mi. Maecenas turpis purus, varius id sagittis eu, venenatis quis arcu.</p>', '', '', '', 'aliquam-nunc-mi'),
(14, 'Curabitur rhoncus', '<p>Curabitur rhoncus dignissim lorem, in placerat sem aliquam in. Vestibulum quis metus non nunc aliquet fermentum non et sapien. </p>', '', '', '', 'curabitur-rhoncus');

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_category_categories`
--

DROP TABLE IF EXISTS `jos_virtuemart_category_categories`;
CREATE TABLE `jos_virtuemart_category_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_parent_id` int(1) unsigned NOT NULL DEFAULT '0',
  `category_child_id` int(1) unsigned NOT NULL DEFAULT '0',
  `ordering` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `i_category_parent_id` (`category_parent_id`,`category_child_id`),
  KEY `category_child_id` (`category_child_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Category child-parent relation list' AUTO_INCREMENT=15 ;

--
-- Dumping data for table `jos_virtuemart_category_categories`
--

INSERT INTO `jos_virtuemart_category_categories` (`id`, `category_parent_id`, `category_child_id`, `ordering`) VALUES
(1, 0, 1, 1),
(2, 0, 2, 2),
(3, 0, 3, 3),
(4, 0, 4, 4),
(5, 0, 5, 5),
(6, 0, 6, 6),
(7, 0, 7, 3),
(8, 0, 8, 8),
(9, 0, 9, 9),
(10, 0, 10, 10),
(11, 13, 11, 11),
(12, 3, 12, 12),
(13, 3, 13, 13),
(14, 3, 14, 14);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_category_medias`
--

DROP TABLE IF EXISTS `jos_virtuemart_category_medias`;
CREATE TABLE `jos_virtuemart_category_medias` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_category_id` smallint(1) unsigned NOT NULL DEFAULT '0',
  `virtuemart_media_id` int(1) unsigned NOT NULL DEFAULT '0',
  `ordering` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `i_virtuemart_category_id` (`virtuemart_category_id`,`virtuemart_media_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `jos_virtuemart_category_medias`
--

INSERT INTO `jos_virtuemart_category_medias` (`id`, `virtuemart_category_id`, `virtuemart_media_id`, `ordering`) VALUES
(1, 1, 2000, 1),
(2, 2, 2001, 1),
(3, 3, 2002, 1),
(4, 4, 2003, 1),
(5, 5, 2004, 1),
(6, 6, 2005, 1),
(7, 7, 2006, 1),
(8, 8, 2007, 1),
(9, 9, 2008, 1),
(10, 10, 2009, 1),
(11, 11, 2010, 1),
(12, 12, 2011, 1),
(13, 13, 2012, 1),
(14, 14, 2013, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_configs`
--

DROP TABLE IF EXISTS `jos_virtuemart_configs`;
CREATE TABLE `jos_virtuemart_configs` (
  `virtuemart_config_id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `config` text,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`virtuemart_config_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Holds configuration settings' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jos_virtuemart_configs`
--

INSERT INTO `jos_virtuemart_configs` (`virtuemart_config_id`, `config`, `created_on`, `created_by`, `modified_on`, `modified_by`, `locked_on`, `locked_by`) VALUES
(1, 'shop_is_offline=s:1:"0";|offline_message=czo3MzoiT3VyIFNob3AgaXMgY3VycmVudGx5IGRvd24gZm9yIG1haW50ZW5hbmNlLiBQbGVhc2UgY2hlY2sgYmFjayBhZ2FpbiBzb29uLiI7|use_as_catalog=s:1:"0";|currency_converter_module=s:14:"convertECB.php";|order_mail_html=s:1:"1";|useSSL=s:1:"0";|dangeroustools=s:1:"0";|debug_enable=s:4:"none";|google_jquery=s:1:"0";|multix=s:4:"none";|pdf_button_enable=s:1:"1";|show_emailfriend=s:1:"1";|show_printicon=s:1:"0";|show_out_of_stock_products=s:1:"1";|coupons_enable=s:1:"1";|show_uncat_child_products=s:1:"0";|coupons_default_expire=s:3:"1,D";|weight_unit_default=s:2:"KG";|lwh_unit_default=s:1:"M";|showReviewFor=s:3:"all";|reviewMode=s:10:"registered";|showRatingFor=s:3:"all";|ratingMode=s:10:"registered";|reviews_autopublish=s:1:"1";|reviews_minimum_comment_length=s:3:"100";|reviews_maximum_comment_length=s:4:"2000";|showCategory=s:1:"1";|categorylayout=s:7:"default";|categories_per_row=s:1:"5";|productlayout=s:7:"default";|products_per_row=s:1:"3";|vmlayout=s:7:"default";|show_featured=s:1:"1";|featured_products_per_row=s:1:"3";|show_topTen=s:1:"1";|topten_products_per_row=s:1:"3";|show_recent=s:1:"1";|show_latest=s:1:"1";|assets_general_path=s:33:"components/com_virtuemart/assets/";|media_category_path=s:35:"images/stories/virtuemart/category/";|media_product_path=s:34:"images/stories/virtuemart/product/";|media_manufacturer_path=s:39:"images/stories/virtuemart/manufacturer/";|media_vendor_path=s:33:"images/stories/virtuemart/vendor/";|forSale_path_thumb=s:42:"images/stories/virtuemart/forSale/resized/";|img_resize_enable=s:1:"1";|img_width=s:3:"220";|img_height=s:3:"220";|no_image_set=s:11:"noimage.gif";|no_image_found=s:11:"warning.png";|browse_orderby_field=s:25:"`p`.virtuemart_product_id";|browse_orderby_fields=a:5:{i:0;s:12:"product_name";i:1;s:15:"`p`.product_sku";i:2;s:7:"mf_name";i:3;s:13:"product_sales";i:4;s:25:"`p`.virtuemart_product_id";}|browse_search_fields=a:6:{i:0;s:12:"product_name";i:1;s:15:"`p`.product_sku";i:2;s:14:"product_s_desc";i:3;s:20:"category_description";i:4;s:13:"product_sales";i:5;s:25:"`p`.virtuemart_product_id";}|show_prices=s:1:"1";|price_show_packaging_pricelabel=s:1:"0";|show_tax=s:1:"1";|basePrice=s:1:"1";|basePriceText=s:1:"1";|basePriceRounding=s:2:"-1";|variantModification=s:1:"0";|variantModificationText=s:1:"0";|variantModificationRounding=s:2:"-1";|basePriceVariant=s:1:"1";|basePriceVariantText=s:1:"0";|basePriceVariantRounding=s:2:"-1";|basePriceWithTax=s:1:"1";|basePriceWithTaxText=s:1:"1";|basePriceWithTaxRounding=s:2:"-1";|discountedPriceWithoutTax=s:1:"0";|discountedPriceWithoutTaxText=s:1:"0";|discountedPriceWithoutTaxRounding=s:2:"-1";|salesPriceWithDiscount=s:1:"0";|salesPriceWithDiscountText=s:1:"0";|salesPriceWithDiscountRounding=s:2:"-1";|salesPrice=s:1:"1";|salesPriceText=s:1:"1";|salesPriceRounding=s:2:"-1";|priceWithoutTax=s:1:"1";|priceWithoutTaxText=s:1:"1";|priceWithoutTaxRounding=s:2:"-1";|discountAmount=s:1:"1";|discountAmountText=s:1:"1";|discountAmountRounding=s:2:"-1";|taxAmount=s:1:"1";|taxAmountText=s:1:"1";|taxAmountRounding=s:2:"-1";|addtocart_popup=s:1:"1";|check_stock=s:1:"0";|automatic_payment=s:1:"1";|automatic_shipment=s:1:"1";|agree_to_tos_onorder=s:1:"0";|oncheckout_show_legal_info=s:1:"1";|oncheckout_show_register=s:1:"1";|oncheckout_show_steps=s:1:"0";|oncheckout_show_register_text=s:47:"COM_VIRTUEMART_ONCHECKOUT_DEFAULT_TEXT_REGISTER";|seo_disabled=s:1:"0";|seo_translate=s:1:"0";|seo_use_id=s:1:"0";|sctime=d:1409831644.9300830364227294921875;|vmlang=s:5:"en_gb";|virtuemart_config_id=i:1;|enable_content_plugin=s:1:"1";|enableEnglish=s:1:"1";|pdf_icon=s:1:"0";|ask_question=s:1:"1";|asks_minimum_comment_length=s:2:"50";|asks_maximum_comment_length=s:4:"2000";|product_navigation=s:1:"1";|recommend_unauth=s:1:"1";|display_stock=s:1:"1";|latest_products_days=s:4:"7000";|latest_products_orderBy=s:10:"created_on";|lstockmail=s:1:"1";|stockhandle=s:10:"disableadd";|rised_availability=s:8:"1-4w.gif";|image=s:8:"1-4w.gif";|show_manufacturers=s:1:"1";|manufacturer_per_row=s:1:"3";|forSale_path=s:76:"D:\\wamp\\www\\vm2\\test2.0.26c\\administrator\\components\\com_virtuemart\\vmfiles\\";|show_store_desc=s:1:"1";|show_categories=s:1:"0";|homepage_categories_per_row=s:1:"5";|homepage_products_per_row=s:1:"3";|featured_products_rows=s:1:"1";|topTen_products_rows=s:1:"2";|recent_products_rows=s:1:"1";|latest_products_rows=s:1:"1";|css=s:1:"0";|jquery=s:1:"0";|jprice=s:1:"1";|jsite=s:1:"1";|askprice=s:1:"1";|rappenrundung=s:1:"1";|roundindig=s:1:"0";|cVarswT=s:1:"1";|unitPrice=s:1:"0";|unitPriceText=s:1:"0";|unitPriceRounding=s:1:"2";|vmlang_js=s:1:"1";|oncheckout_only_registered=s:1:"1";|oncheckout_show_images=s:1:"1";|browse_cat_orderby_field=s:10:"c.ordering";|seo_sufix=s:7:"-detail";|task=s:5:"apply";|option=s:14:"com_virtuemart";|view=s:6:"config";|f42857fc45f9e15d48381894cb3c8b6f=s:1:"1";|active_languages=a:1:{i:0;s:5:"en-GB";}|6d7e163018d38d931b2bc32a4d49dbad=s:1:"1";|424efd945140af29cdd4d9c13ddc52e2=s:1:"1";|69b44b8f47782f301d0c87ec2a17eb14=s:1:"1";|useVendorEmail=s:1:"0";|feed_cat_published=s:1:"0";|feed_cat_show_images=s:1:"0";|feed_cat_show_prices=s:1:"0";|feed_cat_show_description=s:1:"0";|feed_cat_description_type=s:14:"product_s_desc";|feed_cat_max_text_length=s:3:"500";|feed_latest_published=s:1:"0";|feed_latest_nb=s:1:"5";|feed_topten_published=s:1:"0";|feed_topten_nb=s:1:"5";|feed_featured_published=s:1:"0";|feed_featured_nb=s:1:"5";|feed_home_show_images=s:1:"0";|feed_home_show_prices=s:1:"0";|feed_home_show_description=s:1:"0";|feed_home_description_type=s:14:"product_s_desc";|feed_home_max_text_length=s:3:"500";|7286ce45cf3e915f3089c69c82e0afb9=s:1:"1";|8723afb2d73690f1b587885579797efd=s:1:"1";|62a8ff902f414716a16548c871ce51ca=s:1:"1";|4f9b78b7c5d959b1b8d0e010811d9e50=s:1:"1";|bdc49911dd12f27c310d4f998532afd4=s:1:"1";|e83cbe3b63318e38cfc102a90a3c8863=s:1:"1";|e19f0fa3655cb2688db3936172efc27a=s:1:"1";|llimit_init_BE=s:1:"6";|llimit_init_FE=s:14:"6,12,18,24,100";|pagseq=s:14:"6,12,18,24,100";|pagseq_1=s:14:"6,12,18,24,100";|pagseq_2=s:14:"6,12,18,24,100";|pagseq_3=s:14:"6,12,18,24,100";|pagseq_4=s:14:"6,12,18,24,100";|pagseq_5=s:14:"6,12,18,24,100";|mediaLimit=s:2:"20";|usefancy=s:1:"0";|jchosen=s:1:"0";|popup_rel=s:1:"0";|inv_os=a:1:{i:0;s:1:"C";}|email_os_s=a:5:{i:0;s:1:"U";i:1;s:1:"C";i:2;s:1:"X";i:3;s:1:"R";i:4;s:1:"S";}|email_os_v=a:4:{i:0;s:1:"U";i:1;s:1:"C";i:2;s:1:"X";i:3;s:1:"R";}|7752881b4e67662c793e23c9985bc6ab=s:1:"1";|cbbd07127883f525caafba8d22651a2a=s:1:"1";|bdb958a001dd7eecd620c4fede9d3964=s:1:"1";|0509e3f0efd23889aca65a92ce4f6ee2=s:1:"1";|vmtemplate=s:7:"default";|categorytemplate=s:7:"default";|3d54eac5a56f8f11988080cabcb81031=s:1:"1";|oncheckout_opc=s:1:"0";|prd_brws_orderby_dir=s:3:"ASC";|cat_brws_orderby_dir=s:3:"ASC";|be25b83782771a06a004f8e7aee33378=s:1:"1";|handle_404=s:1:"1";|cp_rm=a:1:{i:0;s:1:"C";}|rr_os=a:1:{i:0;s:1:"C";}|oncheckout_change_shopper=s:1:"0";|del_date_type=s:1:"m";|e46f51ebdb432a3f982699c2ac08b5ed=s:1:"1";|dffb8cb4e37cc69a428396d248393280=s:1:"1";|fa78431c443c4a72ae7d828c9652e7c8=s:1:"1";|8386a88cb8128236178bb4746d7d6731=s:1:"1";|22afccce1e1e187e5a0d70b2085941e6=s:1:"1";|50c7ffd2a8ee55919de1984dd0985b0b=s:1:"1";|3853ab2328cdae7906ebcac5d289b4b7=s:1:"1";|115f2428b06ad72274b569d9690f8d70=s:1:"1";|bd3fd54f5726f125df3df8dfaf999c70=s:1:"1";|0b887fb70bedb294faf248427445c032=s:1:"1";|7530c8c8ef97a05cc5873bcea0c96f1f=s:1:"1";|934062238c25f526ac0bac7ede308fa6=s:1:"1";|3cdcdcd2fbd2dc75fba208582428f42c=s:1:"1";|9ea322fc6a289aa2687e0ac61c635fb8=s:1:"1";|07db7ade21e90c1d2bd164f03d7e7ead=s:1:"1";|ca0caca1c4dadeb481630244576a30b7=s:1:"1";|06a69983598cf32ec37b418a98f10f54=s:1:"1";|778365718d9cb5762baa9917321b67cd=s:1:"1";|25f63264765765c08990c9b481a7d960=s:1:"1";|a1335a8dc58c525485475e65244832dd=s:1:"1";|f38b912a3da8aeb91b6a799cb2088a4c=s:1:"1";|1a90756e4c7fb326641369a7a3b1650f=s:1:"1";|5d13c65cd9733c9e2822d6d0cc271037=s:1:"1";', '0000-00-00 00:00:00', 0, '2014-09-04 11:54:04', 42, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_countries`
--

DROP TABLE IF EXISTS `jos_virtuemart_countries`;
CREATE TABLE `jos_virtuemart_countries` (
  `virtuemart_country_id` smallint(1) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_worldzone_id` tinyint(11) NOT NULL DEFAULT '1',
  `country_name` char(64) DEFAULT NULL,
  `country_3_code` char(3) DEFAULT NULL,
  `country_2_code` char(2) DEFAULT NULL,
  `ordering` int(2) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`virtuemart_country_id`),
  KEY `idx_country_3_code` (`country_3_code`),
  KEY `idx_country_2_code` (`country_2_code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Country records' AUTO_INCREMENT=249 ;

--
-- Dumping data for table `jos_virtuemart_countries`
--

INSERT INTO `jos_virtuemart_countries` (`virtuemart_country_id`, `virtuemart_worldzone_id`, `country_name`, `country_3_code`, `country_2_code`, `ordering`, `published`, `created_on`, `created_by`, `modified_on`, `modified_by`, `locked_on`, `locked_by`) VALUES
(1, 1, 'Afghanistan', 'AFG', 'AF', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(2, 1, 'Albania', 'ALB', 'AL', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(3, 1, 'Algeria', 'DZA', 'DZ', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(4, 1, 'American Samoa', 'ASM', 'AS', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(5, 1, 'Andorra', 'AND', 'AD', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(6, 1, 'Angola', 'AGO', 'AO', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(7, 1, 'Anguilla', 'AIA', 'AI', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(8, 1, 'Antarctica', 'ATA', 'AQ', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(9, 1, 'Antigua and Barbuda', 'ATG', 'AG', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(10, 1, 'Argentina', 'ARG', 'AR', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(11, 1, 'Armenia', 'ARM', 'AM', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(12, 1, 'Aruba', 'ABW', 'AW', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(13, 1, 'Australia', 'AUS', 'AU', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(14, 1, 'Austria', 'AUT', 'AT', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(15, 1, 'Azerbaijan', 'AZE', 'AZ', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(16, 1, 'Bahamas', 'BHS', 'BS', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(17, 1, 'Bahrain', 'BHR', 'BH', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(18, 1, 'Bangladesh', 'BGD', 'BD', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(19, 1, 'Barbados', 'BRB', 'BB', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(20, 1, 'Belarus', 'BLR', 'BY', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(21, 1, 'Belgium', 'BEL', 'BE', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(22, 1, 'Belize', 'BLZ', 'BZ', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(23, 1, 'Benin', 'BEN', 'BJ', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(24, 1, 'Bermuda', 'BMU', 'BM', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(25, 1, 'Bhutan', 'BTN', 'BT', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(26, 1, 'Bolivia', 'BOL', 'BO', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(27, 1, 'Bosnia and Herzegowina', 'BIH', 'BA', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(28, 1, 'Botswana', 'BWA', 'BW', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(29, 1, 'Bouvet Island', 'BVT', 'BV', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(30, 1, 'Brazil', 'BRA', 'BR', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(31, 1, 'British Indian Ocean Territory', 'IOT', 'IO', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(32, 1, 'Brunei Darussalam', 'BRN', 'BN', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(33, 1, 'Bulgaria', 'BGR', 'BG', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(34, 1, 'Burkina Faso', 'BFA', 'BF', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(35, 1, 'Burundi', 'BDI', 'BI', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(36, 1, 'Cambodia', 'KHM', 'KH', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(37, 1, 'Cameroon', 'CMR', 'CM', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(38, 1, 'Canada', 'CAN', 'CA', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(39, 1, 'Cape Verde', 'CPV', 'CV', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(40, 1, 'Cayman Islands', 'CYM', 'KY', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(41, 1, 'Central African Republic', 'CAF', 'CF', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(42, 1, 'Chad', 'TCD', 'TD', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(43, 1, 'Chile', 'CHL', 'CL', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(44, 1, 'China', 'CHN', 'CN', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(45, 1, 'Christmas Island', 'CXR', 'CX', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(46, 1, 'Cocos (Keeling) Islands', 'CCK', 'CC', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(47, 1, 'Colombia', 'COL', 'CO', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(48, 1, 'Comoros', 'COM', 'KM', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(49, 1, 'Congo', 'COG', 'CG', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(50, 1, 'Cook Islands', 'COK', 'CK', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(51, 1, 'Costa Rica', 'CRI', 'CR', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(52, 1, 'Cote D''Ivoire', 'CIV', 'CI', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(53, 1, 'Croatia', 'HRV', 'HR', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(54, 1, 'Cuba', 'CUB', 'CU', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(55, 1, 'Cyprus', 'CYP', 'CY', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(56, 1, 'Czech Republic', 'CZE', 'CZ', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(57, 1, 'Denmark', 'DNK', 'DK', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(58, 1, 'Djibouti', 'DJI', 'DJ', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(59, 1, 'Dominica', 'DMA', 'DM', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(60, 1, 'Dominican Republic', 'DOM', 'DO', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(61, 1, 'East Timor', 'TMP', 'TP', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(62, 1, 'Ecuador', 'ECU', 'EC', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(63, 1, 'Egypt', 'EGY', 'EG', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(64, 1, 'El Salvador', 'SLV', 'SV', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(65, 1, 'Equatorial Guinea', 'GNQ', 'GQ', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(66, 1, 'Eritrea', 'ERI', 'ER', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(67, 1, 'Estonia', 'EST', 'EE', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(68, 1, 'Ethiopia', 'ETH', 'ET', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(69, 1, 'Falkland Islands (Malvinas)', 'FLK', 'FK', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(70, 1, 'Faroe Islands', 'FRO', 'FO', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(71, 1, 'Fiji', 'FJI', 'FJ', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(72, 1, 'Finland', 'FIN', 'FI', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(73, 1, 'France', 'FRA', 'FR', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(75, 1, 'French Guiana', 'GUF', 'GF', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(76, 1, 'French Polynesia', 'PYF', 'PF', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(77, 1, 'French Southern Territories', 'ATF', 'TF', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(78, 1, 'Gabon', 'GAB', 'GA', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(79, 1, 'Gambia', 'GMB', 'GM', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(80, 1, 'Georgia', 'GEO', 'GE', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(81, 1, 'Germany', 'DEU', 'DE', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(82, 1, 'Ghana', 'GHA', 'GH', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(83, 1, 'Gibraltar', 'GIB', 'GI', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(84, 1, 'Greece', 'GRC', 'GR', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(85, 1, 'Greenland', 'GRL', 'GL', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(86, 1, 'Grenada', 'GRD', 'GD', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(87, 1, 'Guadeloupe', 'GLP', 'GP', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(88, 1, 'Guam', 'GUM', 'GU', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(89, 1, 'Guatemala', 'GTM', 'GT', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(90, 1, 'Guinea', 'GIN', 'GN', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(91, 1, 'Guinea-bissau', 'GNB', 'GW', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(92, 1, 'Guyana', 'GUY', 'GY', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(93, 1, 'Haiti', 'HTI', 'HT', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(94, 1, 'Heard and Mc Donald Islands', 'HMD', 'HM', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(95, 1, 'Honduras', 'HND', 'HN', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(96, 1, 'Hong Kong', 'HKG', 'HK', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(97, 1, 'Hungary', 'HUN', 'HU', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(98, 1, 'Iceland', 'ISL', 'IS', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(99, 1, 'India', 'IND', 'IN', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(100, 1, 'Indonesia', 'IDN', 'ID', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(101, 1, 'Iran (Islamic Republic of)', 'IRN', 'IR', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(102, 1, 'Iraq', 'IRQ', 'IQ', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(103, 1, 'Ireland', 'IRL', 'IE', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(104, 1, 'Israel', 'ISR', 'IL', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(105, 1, 'Italy', 'ITA', 'IT', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(106, 1, 'Jamaica', 'JAM', 'JM', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(107, 1, 'Japan', 'JPN', 'JP', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(108, 1, 'Jordan', 'JOR', 'JO', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(109, 1, 'Kazakhstan', 'KAZ', 'KZ', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(110, 1, 'Kenya', 'KEN', 'KE', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(111, 1, 'Kiribati', 'KIR', 'KI', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(112, 1, 'Korea, Democratic People''s Republic of', 'PRK', 'KP', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(113, 1, 'Korea, Republic of', 'KOR', 'KR', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(114, 1, 'Kuwait', 'KWT', 'KW', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(115, 1, 'Kyrgyzstan', 'KGZ', 'KG', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(116, 1, 'Lao People''s Democratic Republic', 'LAO', 'LA', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(117, 1, 'Latvia', 'LVA', 'LV', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(118, 1, 'Lebanon', 'LBN', 'LB', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(119, 1, 'Lesotho', 'LSO', 'LS', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(120, 1, 'Liberia', 'LBR', 'LR', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(121, 1, 'Libyan Arab Jamahiriya', 'LBY', 'LY', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(122, 1, 'Liechtenstein', 'LIE', 'LI', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(123, 1, 'Lithuania', 'LTU', 'LT', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(124, 1, 'Luxembourg', 'LUX', 'LU', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(125, 1, 'Macau', 'MAC', 'MO', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(126, 1, 'Macedonia, The Former Yugoslav Republic of', 'MKD', 'MK', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(127, 1, 'Madagascar', 'MDG', 'MG', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(128, 1, 'Malawi', 'MWI', 'MW', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(129, 1, 'Malaysia', 'MYS', 'MY', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(130, 1, 'Maldives', 'MDV', 'MV', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(131, 1, 'Mali', 'MLI', 'ML', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(132, 1, 'Malta', 'MLT', 'MT', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(133, 1, 'Marshall Islands', 'MHL', 'MH', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(134, 1, 'Martinique', 'MTQ', 'MQ', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(135, 1, 'Mauritania', 'MRT', 'MR', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(136, 1, 'Mauritius', 'MUS', 'MU', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(137, 1, 'Mayotte', 'MYT', 'YT', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(138, 1, 'Mexico', 'MEX', 'MX', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(139, 1, 'Micronesia, Federated States of', 'FSM', 'FM', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(140, 1, 'Moldova, Republic of', 'MDA', 'MD', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(141, 1, 'Monaco', 'MCO', 'MC', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(142, 1, 'Mongolia', 'MNG', 'MN', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(143, 1, 'Montserrat', 'MSR', 'MS', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(144, 1, 'Morocco', 'MAR', 'MA', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(145, 1, 'Mozambique', 'MOZ', 'MZ', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(146, 1, 'Myanmar', 'MMR', 'MM', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(147, 1, 'Namibia', 'NAM', 'NA', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(148, 1, 'Nauru', 'NRU', 'NR', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(149, 1, 'Nepal', 'NPL', 'NP', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(150, 1, 'Netherlands', 'NLD', 'NL', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(151, 1, 'Netherlands Antilles', 'ANT', 'AN', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(152, 1, 'New Caledonia', 'NCL', 'NC', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(153, 1, 'New Zealand', 'NZL', 'NZ', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(154, 1, 'Nicaragua', 'NIC', 'NI', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(155, 1, 'Niger', 'NER', 'NE', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(156, 1, 'Nigeria', 'NGA', 'NG', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(157, 1, 'Niue', 'NIU', 'NU', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(158, 1, 'Norfolk Island', 'NFK', 'NF', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(159, 1, 'Northern Mariana Islands', 'MNP', 'MP', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(160, 1, 'Norway', 'NOR', 'NO', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(161, 1, 'Oman', 'OMN', 'OM', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(162, 1, 'Pakistan', 'PAK', 'PK', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(163, 1, 'Palau', 'PLW', 'PW', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(164, 1, 'Panama', 'PAN', 'PA', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(165, 1, 'Papua New Guinea', 'PNG', 'PG', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(166, 1, 'Paraguay', 'PRY', 'PY', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(167, 1, 'Peru', 'PER', 'PE', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(168, 1, 'Philippines', 'PHL', 'PH', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(169, 1, 'Pitcairn', 'PCN', 'PN', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(170, 1, 'Poland', 'POL', 'PL', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(171, 1, 'Portugal', 'PRT', 'PT', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(172, 1, 'Puerto Rico', 'PRI', 'PR', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(173, 1, 'Qatar', 'QAT', 'QA', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(174, 1, 'Reunion', 'REU', 'RE', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(175, 1, 'Romania', 'ROM', 'RO', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(176, 1, 'Russian Federation', 'RUS', 'RU', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(177, 1, 'Rwanda', 'RWA', 'RW', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(178, 1, 'Saint Kitts and Nevis', 'KNA', 'KN', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(179, 1, 'Saint Lucia', 'LCA', 'LC', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(180, 1, 'Saint Vincent and the Grenadines', 'VCT', 'VC', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(181, 1, 'Samoa', 'WSM', 'WS', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(182, 1, 'San Marino', 'SMR', 'SM', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(183, 1, 'Sao Tome and Principe', 'STP', 'ST', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(184, 1, 'Saudi Arabia', 'SAU', 'SA', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(185, 1, 'Senegal', 'SEN', 'SN', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(186, 1, 'Seychelles', 'SYC', 'SC', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(187, 1, 'Sierra Leone', 'SLE', 'SL', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(188, 1, 'Singapore', 'SGP', 'SG', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(189, 1, 'Slovakia', 'SVK', 'SK', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(190, 1, 'Slovenia', 'SVN', 'SI', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(191, 1, 'Solomon Islands', 'SLB', 'SB', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(192, 1, 'Somalia', 'SOM', 'SO', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(193, 1, 'South Africa', 'ZAF', 'ZA', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(194, 1, 'South Georgia and the South Sandwich Islands', 'SGS', 'GS', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(195, 1, 'Spain', 'ESP', 'ES', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(196, 1, 'Sri Lanka', 'LKA', 'LK', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(197, 1, 'St. Helena', 'SHN', 'SH', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(198, 1, 'St. Pierre and Miquelon', 'SPM', 'PM', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(199, 1, 'Sudan', 'SDN', 'SD', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(200, 1, 'Suriname', 'SUR', 'SR', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(201, 1, 'Svalbard and Jan Mayen Islands', 'SJM', 'SJ', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(202, 1, 'Swaziland', 'SWZ', 'SZ', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(203, 1, 'Sweden', 'SWE', 'SE', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(204, 1, 'Switzerland', 'CHE', 'CH', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(205, 1, 'Syrian Arab Republic', 'SYR', 'SY', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(206, 1, 'Taiwan', 'TWN', 'TW', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(207, 1, 'Tajikistan', 'TJK', 'TJ', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(208, 1, 'Tanzania, United Republic of', 'TZA', 'TZ', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(209, 1, 'Thailand', 'THA', 'TH', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(210, 1, 'Togo', 'TGO', 'TG', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(211, 1, 'Tokelau', 'TKL', 'TK', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(212, 1, 'Tonga', 'TON', 'TO', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(213, 1, 'Trinidad and Tobago', 'TTO', 'TT', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(214, 1, 'Tunisia', 'TUN', 'TN', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(215, 1, 'Turkey', 'TUR', 'TR', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(216, 1, 'Turkmenistan', 'TKM', 'TM', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(217, 1, 'Turks and Caicos Islands', 'TCA', 'TC', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(218, 1, 'Tuvalu', 'TUV', 'TV', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(219, 1, 'Uganda', 'UGA', 'UG', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(220, 1, 'Ukraine', 'UKR', 'UA', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(221, 1, 'United Arab Emirates', 'ARE', 'AE', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(222, 1, 'United Kingdom', 'GBR', 'GB', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(223, 1, 'United States', 'USA', 'US', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(224, 1, 'United States Minor Outlying Islands', 'UMI', 'UM', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(225, 1, 'Uruguay', 'URY', 'UY', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(226, 1, 'Uzbekistan', 'UZB', 'UZ', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(227, 1, 'Vanuatu', 'VUT', 'VU', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(228, 1, 'Vatican City State (Holy See)', 'VAT', 'VA', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(229, 1, 'Venezuela', 'VEN', 'VE', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(230, 1, 'Viet Nam', 'VNM', 'VN', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(231, 1, 'Virgin Islands (British)', 'VGB', 'VG', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(232, 1, 'Virgin Islands (U.S.)', 'VIR', 'VI', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(233, 1, 'Wallis and Futuna Islands', 'WLF', 'WF', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(234, 1, 'Western Sahara', 'ESH', 'EH', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(235, 1, 'Yemen', 'YEM', 'YE', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(237, 1, 'The Democratic Republic of Congo', 'DRC', 'DC', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(238, 1, 'Zambia', 'ZMB', 'ZM', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(239, 1, 'Zimbabwe', 'ZWE', 'ZW', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(240, 1, 'East Timor', 'XET', 'XE', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(241, 1, 'Jersey', 'JEY', 'JE', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(242, 1, 'St. Barthelemy', 'XSB', 'XB', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(243, 1, 'St. Eustatius', 'XSE', 'XU', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(244, 1, 'Canary Islands', 'XCA', 'XC', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(245, 1, 'Serbia', 'SRB', 'RS', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(246, 1, 'Sint Maarten (French Antilles)', 'MAF', 'MF', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(247, 1, 'Sint Maarten (Netherlands Antilles)', 'SXM', 'SX', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(248, 1, 'Palestinian Territory, occupied', 'PSE', 'PS', 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_coupons`
--

DROP TABLE IF EXISTS `jos_virtuemart_coupons`;
CREATE TABLE `jos_virtuemart_coupons` (
  `coupon_used` varchar(200) NOT NULL DEFAULT '',
  `virtuemart_coupon_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `coupon_code` char(32) NOT NULL DEFAULT '',
  `percent_or_total` enum('percent','total') NOT NULL DEFAULT 'percent',
  `coupon_type` enum('gift','permanent') NOT NULL DEFAULT 'gift',
  `coupon_value` decimal(15,5) NOT NULL DEFAULT '0.00000',
  `coupon_start_date` datetime DEFAULT NULL,
  `coupon_expiry_date` datetime DEFAULT NULL,
  `coupon_value_valid` decimal(15,5) NOT NULL DEFAULT '0.00000',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`virtuemart_coupon_id`),
  KEY `idx_coupon_code` (`coupon_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Used to store coupon codes' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_currencies`
--

DROP TABLE IF EXISTS `jos_virtuemart_currencies`;
CREATE TABLE `jos_virtuemart_currencies` (
  `virtuemart_currency_id` smallint(1) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_vendor_id` smallint(1) unsigned NOT NULL DEFAULT '1',
  `currency_name` char(64) DEFAULT NULL,
  `currency_code_2` char(2) DEFAULT NULL,
  `currency_code_3` char(3) DEFAULT NULL,
  `currency_numeric_code` int(4) DEFAULT NULL,
  `currency_exchange_rate` decimal(10,5) DEFAULT NULL,
  `currency_symbol` char(4) DEFAULT NULL,
  `currency_decimal_place` char(4) DEFAULT NULL,
  `currency_decimal_symbol` char(4) DEFAULT NULL,
  `currency_thousands` char(4) DEFAULT NULL,
  `currency_positive_style` char(64) DEFAULT NULL,
  `currency_negative_style` char(64) DEFAULT NULL,
  `ordering` int(2) NOT NULL DEFAULT '0',
  `shared` tinyint(1) NOT NULL DEFAULT '1',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`virtuemart_currency_id`),
  KEY `virtuemart_vendor_id` (`virtuemart_vendor_id`),
  KEY `idx_currency_code_3` (`currency_code_3`),
  KEY `idx_currency_numeric_code` (`currency_numeric_code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Used to store currencies' AUTO_INCREMENT=202 ;

--
-- Dumping data for table `jos_virtuemart_currencies`
--

INSERT INTO `jos_virtuemart_currencies` (`virtuemart_currency_id`, `virtuemart_vendor_id`, `currency_name`, `currency_code_2`, `currency_code_3`, `currency_numeric_code`, `currency_exchange_rate`, `currency_symbol`, `currency_decimal_place`, `currency_decimal_symbol`, `currency_thousands`, `currency_positive_style`, `currency_negative_style`, `ordering`, `shared`, `published`, `created_on`, `created_by`, `modified_on`, `modified_by`, `locked_on`, `locked_by`) VALUES
(2, 1, 'United Arab Emirates dirham', '', 'AED', 784, '0.00000', 'د.إ', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(4, 1, 'Albanian lek', '', 'ALL', 8, '0.00000', 'Lek', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(5, 1, 'Netherlands Antillean gulden', '', 'ANG', 532, '0.00000', 'ƒ', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(7, 1, 'Argentine peso', '', 'ARS', 32, '0.00000', '$', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(9, 1, 'Australian dollar', '', 'AUD', 36, '0.00000', '$', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(10, 1, 'Aruban florin', '', 'AWG', 533, '0.00000', 'ƒ', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(11, 1, 'Barbadian dollar', '', 'BBD', 52, '0.00000', '$', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(12, 1, 'Bangladeshi taka', '', 'BDT', 50, '0.00000', '৳', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(15, 1, 'Bahraini dinar', '', 'BHD', 48, '0.00000', 'ب.د', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(16, 1, 'Burundian franc', '', 'BIF', 108, '0.00000', 'Fr', '0', '', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(17, 1, 'Bermudian dollar', '', 'BMD', 60, '0.00000', '$', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(18, 1, 'Brunei dollar', '', 'BND', 96, '0.00000', '$', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(19, 1, 'Bolivian boliviano', '', 'BOB', 68, '0.00000', '$b', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(20, 1, 'Brazilian real', '', 'BRL', 986, '0.00000', 'R$', '2', '.', ',', '{symbol} {number}', '{symbol} {sign}{number}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(21, 1, 'Bahamian dollar', '', 'BSD', 44, '0.00000', '$', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(22, 1, 'Bhutanese ngultrum', '', 'BTN', 64, '0.00000', 'BTN', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(24, 1, 'Botswana pula', '', 'BWP', 72, '0.00000', 'P', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(25, 1, 'Belize dollar', '', 'BZD', 84, '0.00000', 'BZ$', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(26, 1, 'Canadian dollar', '', 'CAD', 124, '0.00000', '$', '2', '.', ',', '{symbol}{number}', '{symbol}{sign}{number}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(27, 1, 'Swiss franc', '', 'CHF', 756, '0.00000', 'CHF', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(28, 1, 'Unidad de Fomento', '', 'CLF', 990, '0.00000', 'CLF', '0', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(29, 1, 'Chilean peso', '', 'CLP', 152, '0.00000', '$', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(30, 1, 'Chinese renminbi yuan', '', 'CNY', 156, '0.00000', '元', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(31, 1, 'Colombian peso', '', 'COP', 170, '0.00000', '$', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(32, 1, 'Costa Rican colón', '', 'CRC', 188, '0.00000', '₡', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(33, 1, 'Czech koruna', '', 'CZK', 203, '0.00000', 'Kč', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(34, 1, 'Cuban peso', '', 'CUP', 192, '0.00000', '₱', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(35, 1, 'Cape Verdean escudo', '', 'CVE', 132, '0.00000', '$', '0', '', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(40, 1, 'Danish krone', '', 'DKK', 208, '0.00000', 'kr', '2', '.', ',', '{symbol}{number}', '{symbol}{sign}{number}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(41, 1, 'Dominican peso', '', 'DOP', 214, '0.00000', 'RD$', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(42, 1, 'Algerian dinar', '', 'DZD', 12, '0.00000', 'د.ج', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(44, 1, 'Egyptian pound', '', 'EGP', 818, '0.00000', '£', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(46, 1, 'Ethiopian birr', '', 'ETB', 230, '0.00000', 'ETB', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(47, 1, 'Euro', '', 'EUR', 978, '0.00000', '€', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(49, 1, 'Fijian dollar', '', 'FJD', 242, '0.00000', '$', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(50, 1, 'Falkland pound', '', 'FKP', 238, '0.00000', '£', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(52, 1, 'British pound', '', 'GBP', 826, '0.00000', '£', '2', '.', ',', '{symbol}{number}', '{symbol}{sign}{number}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(54, 1, 'Gibraltar pound', '', 'GIP', 292, '0.00000', '£', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(55, 1, 'Gambian dalasi', '', 'GMD', 270, '0.00000', 'D', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(56, 1, 'Guinean franc', '', 'GNF', 324, '0.00000', 'Fr', '0', '', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(58, 1, 'Guatemalan quetzal', '', 'GTQ', 320, '0.00000', 'Q', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(60, 1, 'Guyanese dollar', '', 'GYD', 328, '0.00000', '$', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(61, 1, 'Hong Kong dollar', '', 'HKD', 344, '0.00000', '元', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(62, 1, 'Honduran lempira', '', 'HNL', 340, '0.00000', 'L', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(63, 1, 'Haitian gourde', '', 'HTG', 332, '0.00000', 'G', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(64, 1, 'Hungarian forint', '', 'HUF', 348, '0.00000', 'Ft', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(65, 1, 'Indonesian rupiah', '', 'IDR', 360, '0.00000', 'Rp', '0', '', '', '{symbol}{number}', '{symbol}{sign}{number}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(67, 1, 'Israeli new sheqel', '', 'ILS', 376, '0.00000', '₪', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(68, 1, 'Indian rupee', '', 'INR', 356, '0.00000', '₨', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(69, 1, 'Iraqi dinar', '', 'IQD', 368, '0.00000', 'ع.د', '0', '', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(70, 1, 'Iranian rial', '', 'IRR', 364, '0.00000', '﷼', '2', ',', '', '{number} {symbol}', '{sign}{number}{symb0l}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(73, 1, 'Jamaican dollar', '', 'JMD', 388, '0.00000', 'J$', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(74, 1, 'Jordanian dinar', '', 'JOD', 400, '0.00000', 'د.ا', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(75, 1, 'Japanese yen', '', 'JPY', 392, '0.00000', '¥', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(76, 1, 'Kenyan shilling', '', 'KES', 404, '0.00000', 'Sh', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(77, 1, 'Cambodian riel', '', 'KHR', 116, '0.00000', '៛', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(78, 1, 'Comorian franc', '', 'KMF', 174, '0.00000', 'Fr', '0', '', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(79, 1, 'North Korean won', '', 'KPW', 408, '0.00000', '₩', '0', '', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(80, 1, 'South Korean won', '', 'KRW', 410, '0.00000', '₩', '0', '', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(81, 1, 'Kuwaiti dinar', '', 'KWD', 414, '0.00000', 'د.ك', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(82, 1, 'Cayman Islands dollar', '', 'KYD', 136, '0.00000', '$', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(83, 1, 'Lao kip', '', 'LAK', 418, '0.00000', '₭', '0', '', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(84, 1, 'Lebanese pound', '', 'LBP', 422, '0.00000', '£', '0', '', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(85, 1, 'Sri Lankan rupee', '', 'LKR', 144, '0.00000', '₨', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(86, 1, 'Liberian dollar', '', 'LRD', 430, '0.00000', '$', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(87, 1, 'Lesotho loti', '', 'LSL', 426, '0.00000', 'L', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(89, 1, 'Libyan dinar', '', 'LYD', 434, '0.00000', 'ل.د', '3', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(90, 1, 'Moroccan dirham', '', 'MAD', 504, '0.00000', 'د.م.', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(92, 1, 'Mongolian tögrög', '', 'MNT', 496, '0.00000', '₮', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(93, 1, 'Macanese pataca', '', 'MOP', 446, '0.00000', 'P', '1', ',', '', '{symbol}{number}', '{symbol}{sign}{number}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(94, 1, 'Mauritanian ouguiya', '', 'MRO', 478, '0.00000', 'UM', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(96, 1, 'Mauritian rupee', '', 'MUR', 480, '0.00000', '₨', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(97, 1, 'Maldivian rufiyaa', '', 'MVR', 462, '0.00000', 'ރ.', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(98, 1, 'Malawian kwacha', '', 'MWK', 454, '0.00000', 'MK', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(100, 1, 'Malaysian ringgit', '', 'MYR', 458, '0.00000', 'RM', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(102, 1, 'Nigerian naira', '', 'NGN', 566, '0.00000', '₦', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(105, 1, 'Norwegian krone', '', 'NOK', 578, '0.00000', 'kr', '2', ',', '', '{symbol}{number}', '{symbol}{sign}{number}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(106, 1, 'Nepalese rupee', '', 'NPR', 524, '0.00000', '₨', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(107, 1, 'New Zealand dollar', '', 'NZD', 554, '0.00000', '$', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(108, 1, 'Omani rial', '', 'OMR', 512, '0.00000', '﷼', '3', '.', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(109, 1, 'Panamanian balboa', '', 'PAB', 590, '0.00000', 'B/.', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(110, 1, 'Peruvian nuevo sol', '', 'PEN', 604, '0.00000', 'S/.', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(111, 1, 'Papua New Guinean kina', '', 'PGK', 598, '0.00000', 'K', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(112, 1, 'Philippine peso', '', 'PHP', 608, '0.00000', '₱', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(113, 1, 'Pakistani rupee', '', 'PKR', 586, '0.00000', '₨', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(114, 1, 'Polish Złoty', '', 'PLN', 985, '0.00000', 'zł', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(116, 1, 'Paraguayan guaraní', '', 'PYG', 600, '0.00000', '₲', '0', '', '.', '{symbol} {number}', '{symbol} {sign}{number}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(117, 1, 'Qatari riyal', '', 'QAR', 634, '0.00000', '﷼', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(118, 1, 'Romanian leu', '', 'RON', 946, '0.00000', 'lei', '2', ',', '.', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(119, 1, 'Rwandan franc', '', 'RWF', 646, '0.00000', 'Fr', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(120, 1, 'Saudi riyal', '', 'SAR', 682, '0.00000', '﷼', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(121, 1, 'Solomon Islands dollar', '', 'SBD', 90, '0.00000', '$', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(122, 1, 'Seychellois rupee', '', 'SCR', 690, '0.00000', '₨', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(124, 1, 'Swedish krona', '', 'SEK', 752, '0.00000', 'kr', '2', ',', '.', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(125, 1, 'Singapore dollar', '', 'SGD', 702, '0.00000', '$', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(126, 1, 'Saint Helenian pound', '', 'SHP', 654, '0.00000', '£', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(127, 1, 'Sierra Leonean leone', '', 'SLL', 694, '0.00000', 'Le', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(128, 1, 'Somali shilling', '', 'SOS', 706, '0.00000', 'S', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(130, 1, 'São Tomé and Príncipe dobra', '', 'STD', 678, '0.00000', 'Db', '0', '', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(131, 1, 'Russian ruble', '', 'RUB', 643, '0.00000', 'руб', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(132, 1, 'Salvadoran colón', '', 'SVC', 222, '0.00000', '$', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(133, 1, 'Syrian pound', '', 'SYP', 760, '0.00000', '£', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(134, 1, 'Swazi lilangeni', '', 'SZL', 748, '0.00000', 'L', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(135, 1, 'Thai baht', '', 'THB', 764, '0.00000', '฿', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(136, 1, 'Tunisian dinar', '', 'TND', 788, '0.00000', 'د.ت', '3', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(137, 1, 'Tongan paʻanga', '', 'TOP', 776, '0.00000', 'T$', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(139, 1, 'Turkish new lira', '', 'TRY', 949, '0.00000', 'YTL', '2', ',', '.', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(140, 1, 'Trinidad and Tobago dollar', '', 'TTD', 780, '0.00000', 'TT$', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(141, 1, 'New Taiwan dollar', '', 'TWD', 901, '0.00000', 'NT$', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(142, 1, 'Tanzanian shilling', '', 'TZS', 834, '0.00000', 'Sh', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(144, 1, 'US dollar', '', 'USD', 840, '0.00000', '$', '2', '.', ',', '{symbol}{number}', '{symbol}{sign}{number}', 0, 0, 1, '0000-00-00 00:00:00', 0, '2013-01-03 12:25:22', 576, '0000-00-00 00:00:00', 0),
(147, 1, 'Vietnamese Dong', '', 'VND', 704, '0.00000', '₫', '0', '', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(148, 1, 'Vanuatu vatu', '', 'VUV', 548, '0.00000', 'Vt', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(149, 1, 'Samoan tala', '', 'WST', 882, '0.00000', 'T', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(151, 1, 'Yemeni rial', '', 'YER', 886, '0.00000', '﷼', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(152, 1, 'Serbian dinar', '', 'RSD', 941, '0.00000', 'Дин.', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(153, 1, 'South African rand', '', 'ZAR', 710, '0.00000', 'R', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(154, 1, 'Zambian kwacha', '', 'ZMK', 894, '0.00000', 'ZK', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(156, 1, 'Zimbabwean dollar', '', 'ZWD', 932, '0.00000', 'Z$', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(158, 1, 'Armenian dram', '', 'AMD', 51, '0.00000', 'դր.', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(159, 1, 'Myanmar kyat', '', 'MMK', 104, '0.00000', 'K', '2', ',', '', '{number} {symbol}', '{symbol} {sign}{number}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(160, 1, 'Croatian kuna', '', 'HRK', 191, '0.00000', 'kn', '2', ',', '.', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(161, 1, 'Eritrean nakfa', '', 'ERN', 232, '0.00000', 'Nfk', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(162, 1, 'Djiboutian franc', '', 'DJF', 262, '0.00000', 'Fr', '0', '', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(163, 1, 'Icelandic króna', '', 'ISK', 352, '0.00000', 'kr', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(164, 1, 'Kazakhstani tenge', '', 'KZT', 398, '0.00000', 'лв', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(165, 1, 'Kyrgyzstani som', '', 'KGS', 417, '0.00000', 'лв', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(166, 1, 'Latvian lats', '', 'LVL', 428, '0.00000', 'Ls', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(167, 1, 'Lithuanian litas', '', 'LTL', 440, '0.00000', 'Lt', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(168, 1, 'Mexican peso', '', 'MXN', 484, '0.00000', '$', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(169, 1, 'Moldovan leu', '', 'MDL', 498, '0.00000', 'L', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(170, 1, 'Namibian dollar', '', 'NAD', 516, '0.00000', '$', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(171, 1, 'Nicaraguan córdoba', '', 'NIO', 558, '0.00000', 'C$', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(172, 1, 'Ugandan shilling', '', 'UGX', 800, '0.00000', 'Sh', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(173, 1, 'Macedonian denar', '', 'MKD', 807, '0.00000', 'ден', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(174, 1, 'Uruguayan peso', '', 'UYU', 858, '0.00000', '$', '0', '', '', '{symbol}number}', '{symbol}{sign}{number}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(175, 1, 'Uzbekistani som', '', 'UZS', 860, '0.00000', 'лв', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(176, 1, 'Azerbaijani manat', '', 'AZN', 934, '0.00000', 'ман', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(177, 1, 'Ghanaian cedi', '', 'GHS', 936, '0.00000', '₵', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(178, 1, 'Venezuelan bolívar', '', 'VEF', 937, '0.00000', 'Bs', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(179, 1, 'Sudanese pound', '', 'SDG', 938, '0.00000', '£', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(180, 1, 'Uruguay Peso', '', 'UYI', 940, '0.00000', 'UYI', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(181, 1, 'Mozambican metical', '', 'MZN', 943, '0.00000', 'MT', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(182, 1, 'WIR Euro', '', 'CHE', 947, '0.00000', '€', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(183, 1, 'WIR Franc', '', 'CHW', 948, '0.00000', 'CHW', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(184, 1, 'Central African CFA franc', '', 'XAF', 950, '0.00000', 'Fr', '0', '', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(185, 1, 'East Caribbean dollar', '', 'XCD', 951, '0.00000', '$', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(186, 1, 'West African CFA franc', '', 'XOF', 952, '0.00000', 'Fr', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(187, 1, 'CFP franc', '', 'XPF', 953, '0.00000', 'Fr', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(188, 1, 'Surinamese dollar', '', 'SRD', 968, '0.00000', '$', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(189, 1, 'Malagasy ariary', '', 'MGA', 969, '0.00000', 'MGA', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(190, 1, 'Unidad de Valor Real', '', 'COU', 970, '0.00000', 'COU', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(191, 1, 'Afghan afghani', '', 'AFN', 971, '0.00000', '؋', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(192, 1, 'Tajikistani somoni', '', 'TJS', 972, '0.00000', 'ЅМ', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(193, 1, 'Angolan kwanza', '', 'AOA', 973, '0.00000', 'Kz', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(194, 1, 'Belarusian ruble', '', 'BYR', 974, '0.00000', 'p.', '0', '', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(195, 1, 'Bulgarian lev', '', 'BGN', 975, '0.00000', 'лв', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(196, 1, 'Congolese franc', '', 'CDF', 976, '0.00000', 'Fr', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(197, 1, 'Bosnia and Herzegovina convert', '', 'BAM', 977, '0.00000', 'KM', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(198, 1, 'Mexican Unid', '', 'MXV', 979, '0.00000', 'MXV', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(199, 1, 'Ukrainian hryvnia', '', 'UAH', 980, '0.00000', '₴', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(200, 1, 'Georgian lari', '', 'GEL', 981, '0.00000', 'ლ', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(201, 1, 'Mvdol', '', 'BOV', 984, '0.00000', 'BOV', '2', ',', '', '{number} {symbol}', '{sign}{number} {symbol}', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_customs`
--

DROP TABLE IF EXISTS `jos_virtuemart_customs`;
CREATE TABLE `jos_virtuemart_customs` (
  `show_title` tinyint(1) NOT NULL DEFAULT '1',
  `virtuemart_custom_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `custom_parent_id` int(1) unsigned NOT NULL DEFAULT '0',
  `virtuemart_vendor_id` smallint(11) NOT NULL DEFAULT '1',
  `custom_jplugin_id` int(11) NOT NULL DEFAULT '0',
  `custom_element` char(50) NOT NULL DEFAULT '',
  `admin_only` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1:Display in admin only',
  `custom_title` char(255) NOT NULL DEFAULT '' COMMENT 'field title',
  `custom_tip` char(255) NOT NULL DEFAULT '' COMMENT 'tip',
  `custom_value` char(255) DEFAULT NULL COMMENT 'defaut value',
  `custom_field_desc` char(255) DEFAULT NULL COMMENT 'description or unit',
  `field_type` char(1) NOT NULL DEFAULT '0' COMMENT 'S:string,I:int,P:parent, B:bool,D:date,T:time,H:hidden',
  `is_list` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'list of values',
  `is_hidden` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1:hidden',
  `is_cart_attribute` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Add attributes to cart',
  `layout_pos` char(24) DEFAULT NULL COMMENT 'Layout Position',
  `custom_params` text,
  `shared` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'valide for all vendors?',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `ordering` int(2) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`virtuemart_custom_id`),
  KEY `idx_custom_plugin_virtuemart_vendor_id` (`virtuemart_vendor_id`),
  KEY `idx_custom_plugin_element` (`custom_element`),
  KEY `idx_custom_plugin_ordering` (`ordering`),
  KEY `idx_custom_parent_id` (`custom_parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='custom fields definition' AUTO_INCREMENT=46 ;

--
-- Dumping data for table `jos_virtuemart_customs`
--

INSERT INTO `jos_virtuemart_customs` (`show_title`, `virtuemart_custom_id`, `custom_parent_id`, `virtuemart_vendor_id`, `custom_jplugin_id`, `custom_element`, `admin_only`, `custom_title`, `custom_tip`, `custom_value`, `custom_field_desc`, `field_type`, `is_list`, `is_hidden`, `is_cart_attribute`, `layout_pos`, `custom_params`, `shared`, `published`, `created_on`, `created_by`, `ordering`, `modified_on`, `modified_by`, `locked_on`, `locked_by`) VALUES
(1, 1, 0, 1, 0, '', 0, 'COM_VIRTUEMART_RELATED_PRODUCTS', 'COM_VIRTUEMART_RELATED_PRODUCTS_TIP', '', 'COM_VIRTUEMART_RELATED_PRODUCTS_DESC', 'R', 0, 0, 0, NULL, NULL, 0, 1, '2011-05-25 21:52:43', 0, 0, '2011-05-25 21:52:43', 0, '0000-00-00 00:00:00', 0),
(1, 2, 0, 1, 0, '', 0, 'COM_VIRTUEMART_RELATED_CATEGORIES', 'COM_VIRTUEMART_RELATED_CATEGORIES_TIP', NULL, 'COM_VIRTUEMART_RELATED_CATEGORIES_DESC', 'Z', 0, 0, 0, NULL, NULL, 0, 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(1, 33, 30, 1, 0, '0', 0, 'Height:', '', '20', 'cm', 'I', 0, 0, 0, 'specification', '0', 0, 1, '0000-00-00 00:00:00', 0, 0, '2013-04-12 11:10:59', 0, '0000-00-00 00:00:00', 0),
(1, 32, 30, 1, 0, '0', 0, 'Weight:', '', '20', 'cm', 'I', 0, 0, 0, 'specification', '0', 0, 1, '0000-00-00 00:00:00', 0, 0, '2013-04-12 11:11:08', 0, '0000-00-00 00:00:00', 0),
(1, 28, 0, 1, 0, '0', 0, 'Video about us', '', '', 'This video is available for viewing, for those who have taken an interest in this product.', 'Y', 0, 0, 0, 'video', '0', 0, 1, '0000-00-00 00:00:00', 0, 0, '2013-04-12 13:57:07', 0, '0000-00-00 00:00:00', 0),
(1, 9, 0, 1, 0, '0', 0, 'Chain size:', 'Select the chain size', '30', '', 'V', 0, 0, 1, '', '0', 0, 1, '0000-00-00 00:00:00', 0, 0, '2013-04-18 12:59:51', 0, '0000-00-00 00:00:00', 0),
(1, 31, 30, 1, 0, '0', 0, 'String:', '', 'ya xz chto napisat', '', 'S', 0, 0, 0, 'specification', '0', 0, 1, '0000-00-00 00:00:00', 0, 0, '2013-04-12 11:11:40', 0, '0000-00-00 00:00:00', 0),
(1, 25, 0, 1, 0, '0', 0, 'Custom', '', '', '', 'X', 0, 0, 0, 'custom', '0', 0, 1, '0000-00-00 00:00:00', 0, 0, '2013-04-12 09:59:15', 0, '0000-00-00 00:00:00', 0),
(1, 24, 0, 1, 10018, 'stockable', 0, 'Stock children', '', 'stockable', 'Chosee children', 'E', 0, 0, 1, '', 'selectname1="Size"|selectname2="color"|selectname3=""|selectname4=""|selectoptions1="Small 10\\r\\nmedium 20\\r\\nlarge 30\\r\\n"|selectoptions2="red\\r\\nblue\\r\\ngreen"|selectoptions3=""|selectoptions4=""|', 0, 1, '2013-04-09 07:43:11', 0, 0, '2014-01-10 10:24:15', 42, '0000-00-00 00:00:00', 0),
(1, 22, 23, 1, 0, '0', 0, 'postavka childov', 'postavka childov', 'postavka childov', 'postavka childov', 'A', 0, 0, 0, '', '0', 0, 1, '0000-00-00 00:00:00', 0, 0, '2013-04-09 07:30:56', 0, '0000-00-00 00:00:00', 0),
(1, 23, 0, 1, 0, '0', 0, 'Postavka', 'Postavka', 'Postavka', 'Postavka', 'P', 0, 0, 0, '', '0', 0, 1, '2013-04-09 07:30:26', 576, 0, '2013-04-09 07:30:26', 0, '0000-00-00 00:00:00', 0),
(1, 30, 0, 1, 0, '0', 0, 'Specification Product', '', '', '', 'P', 0, 0, 0, 'specification', '0', 0, 1, '2013-04-11 14:16:26', 576, 0, '2013-04-11 14:16:26', 0, '0000-00-00 00:00:00', 0),
(1, 34, 30, 1, 0, '0', 0, 'Bolean:', '', 'Bolean', '', 'B', 0, 0, 0, 'specification', '0', 0, 1, '0000-00-00 00:00:00', 0, 0, '2013-04-12 11:11:28', 0, '0000-00-00 00:00:00', 0),
(1, 41, 0, 1, 0, '0', 0, 'Radio button:', 'Radio button', '', 'Radio button', 'Y', 0, 0, 1, '', '0', 0, 1, '2013-04-18 13:17:06', 576, 0, '2013-04-18 13:17:06', 0, '0000-00-00 00:00:00', 0),
(1, 42, 0, 1, 10016, 'textinput', 0, 'Input Test', '', '+', 'Place a ''+'' if you need it to complete', 'E', 0, 0, 1, '', 'custom_size="5"|custom_price_by_letter="0"|', 0, 1, '0000-00-00 00:00:00', 0, 0, '2013-04-18 13:42:40', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_invoices`
--

DROP TABLE IF EXISTS `jos_virtuemart_invoices`;
CREATE TABLE `jos_virtuemart_invoices` (
  `virtuemart_invoice_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_vendor_id` smallint(1) unsigned NOT NULL DEFAULT '1',
  `virtuemart_order_id` int(1) unsigned DEFAULT NULL,
  `invoice_number` char(64) DEFAULT NULL,
  `order_status` char(2) DEFAULT NULL,
  `xhtml` text,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`virtuemart_invoice_id`),
  UNIQUE KEY `idx_invoice_number` (`invoice_number`,`virtuemart_vendor_id`),
  KEY `idx_virtuemart_order_id` (`virtuemart_order_id`),
  KEY `idx_virtuemart_vendor_id` (`virtuemart_vendor_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='custom fields definition' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_manufacturercategories`
--

DROP TABLE IF EXISTS `jos_virtuemart_manufacturercategories`;
CREATE TABLE `jos_virtuemart_manufacturercategories` (
  `virtuemart_manufacturercategories_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`virtuemart_manufacturercategories_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Manufacturers are assigned to these categories' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jos_virtuemart_manufacturercategories`
--

INSERT INTO `jos_virtuemart_manufacturercategories` (`virtuemart_manufacturercategories_id`, `published`, `created_on`, `created_by`, `modified_on`, `modified_by`, `locked_on`, `locked_by`) VALUES
(1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_manufacturercategories_en_gb`
--

DROP TABLE IF EXISTS `jos_virtuemart_manufacturercategories_en_gb`;
CREATE TABLE `jos_virtuemart_manufacturercategories_en_gb` (
  `virtuemart_manufacturercategories_id` int(1) unsigned NOT NULL,
  `mf_category_name` char(180) NOT NULL DEFAULT '',
  `mf_category_desc` varchar(19000) NOT NULL DEFAULT '',
  `slug` char(192) NOT NULL DEFAULT '',
  PRIMARY KEY (`virtuemart_manufacturercategories_id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_virtuemart_manufacturercategories_en_gb`
--

INSERT INTO `jos_virtuemart_manufacturercategories_en_gb` (`virtuemart_manufacturercategories_id`, `mf_category_name`, `mf_category_desc`, `slug`) VALUES
(1, '-default-', 'This is the default manufacturer category', '-default-');

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_manufacturers`
--

DROP TABLE IF EXISTS `jos_virtuemart_manufacturers`;
CREATE TABLE `jos_virtuemart_manufacturers` (
  `virtuemart_manufacturer_id` smallint(1) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_manufacturercategories_id` int(11) DEFAULT NULL,
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`virtuemart_manufacturer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Manufacturers are those who deliver products' AUTO_INCREMENT=9 ;

--
-- Dumping data for table `jos_virtuemart_manufacturers`
--

INSERT INTO `jos_virtuemart_manufacturers` (`virtuemart_manufacturer_id`, `virtuemart_manufacturercategories_id`, `hits`, `published`, `created_on`, `created_by`, `modified_on`, `modified_by`, `locked_on`, `locked_by`) VALUES
(1, 1, 0, 1, '0000-00-00 00:00:00', 0, '2014-06-09 12:13:00', 42, '0000-00-00 00:00:00', 0),
(2, 1, 0, 1, '0000-00-00 00:00:00', 0, '2014-06-09 12:09:51', 42, '0000-00-00 00:00:00', 0),
(3, 1, 0, 1, '0000-00-00 00:00:00', 0, '2014-06-09 12:10:01', 42, '0000-00-00 00:00:00', 0),
(4, 1, 0, 1, '0000-00-00 00:00:00', 0, '2014-06-09 12:10:11', 42, '0000-00-00 00:00:00', 0),
(5, 1, 0, 1, '0000-00-00 00:00:00', 0, '2014-06-09 12:10:25', 42, '0000-00-00 00:00:00', 0),
(6, 1, 0, 1, '2014-06-09 12:12:14', 42, '2014-06-09 13:05:29', 42, '0000-00-00 00:00:00', 0),
(7, 1, 0, 1, '2014-06-09 12:12:43', 42, '2014-06-09 13:04:48', 42, '0000-00-00 00:00:00', 0),
(8, 1, 0, 1, '2014-06-09 12:13:29', 42, '2014-06-09 13:04:28', 42, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_manufacturers_en_gb`
--

DROP TABLE IF EXISTS `jos_virtuemart_manufacturers_en_gb`;
CREATE TABLE `jos_virtuemart_manufacturers_en_gb` (
  `virtuemart_manufacturer_id` int(1) unsigned NOT NULL,
  `mf_name` char(180) NOT NULL DEFAULT '',
  `mf_email` char(255) NOT NULL DEFAULT '',
  `mf_desc` varchar(19000) NOT NULL DEFAULT '',
  `mf_url` char(255) NOT NULL DEFAULT '',
  `slug` char(192) NOT NULL DEFAULT '',
  PRIMARY KEY (`virtuemart_manufacturer_id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_virtuemart_manufacturers_en_gb`
--

INSERT INTO `jos_virtuemart_manufacturers_en_gb` (`virtuemart_manufacturer_id`, `mf_name`, `mf_email`, `mf_desc`, `mf_url`, `slug`) VALUES
(1, 'Ctetuer adipiscing', ' Manufacturer-1@example.org', 'An example for a manufacturer-1', 'http://www.example.org', 'ctetuer-adipiscing'),
(2, 'Praesent vestibul', ' Manufacturer-2@example.org', 'An example for a manufacturer-2', 'http://www.brand-example.org', 'praesent-vestibul'),
(3, 'Um molestie lacus', ' Manufacturer-3@example.org', 'An example for a manufacturer-3', 'http://www.lorem.org', 'um-molestie-lacus'),
(4, 'Aenean nonummy hendrerit', ' Manufacturer-4@example.org', 'An example for a manufacturer-4', 'http://www.ipsum.org', 'aenean-nonummy-hendrerit'),
(5, 'Mauris', ' Manufacturer-5@example.org', 'An example for a manufacturer-5', 'http://www.dolorem.org', 'mauris'),
(6, 'Phasellus porta', ' Manufacturer-1@example.org', 'An example for a manufacturer-1', 'http://www.example.org', 'phasellus-porta'),
(7, 'Fusce suscipit varius mi', ' Manufacturer-1@example.org', 'An example for a manufacturer-1', 'http://www.example.org', 'fusce-suscipit-varius-mi'),
(8, 'Cum sociis natoqigul', ' Manufacturer-1@example.org', 'An example for a manufacturer-1', 'http://www.example.org', 'cum-sociis-natoqigul');

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_manufacturer_medias`
--

DROP TABLE IF EXISTS `jos_virtuemart_manufacturer_medias`;
CREATE TABLE `jos_virtuemart_manufacturer_medias` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_manufacturer_id` smallint(1) unsigned NOT NULL DEFAULT '0',
  `virtuemart_media_id` int(1) unsigned NOT NULL DEFAULT '0',
  `ordering` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `i_virtuemart_manufacturer_id` (`virtuemart_manufacturer_id`,`virtuemart_media_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `jos_virtuemart_manufacturer_medias`
--

INSERT INTO `jos_virtuemart_manufacturer_medias` (`id`, `virtuemart_manufacturer_id`, `virtuemart_media_id`, `ordering`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 1),
(3, 3, 3, 1),
(4, 4, 4, 1),
(5, 5, 5, 1),
(6, 8, 1, 1),
(7, 7, 2, 1),
(8, 6, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_medias`
--

DROP TABLE IF EXISTS `jos_virtuemart_medias`;
CREATE TABLE `jos_virtuemart_medias` (
  `file_lang` varchar(500) NOT NULL,
  `virtuemart_media_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_vendor_id` smallint(11) NOT NULL DEFAULT '1',
  `file_title` char(126) NOT NULL DEFAULT '',
  `file_description` char(254) NOT NULL DEFAULT '',
  `file_meta` char(254) NOT NULL DEFAULT '',
  `file_mimetype` char(64) NOT NULL DEFAULT '',
  `file_type` char(32) NOT NULL DEFAULT '',
  `file_url` varchar(900) NOT NULL DEFAULT '',
  `file_url_thumb` varchar(900) NOT NULL DEFAULT '',
  `file_is_product_image` tinyint(1) NOT NULL DEFAULT '0',
  `file_is_downloadable` tinyint(1) NOT NULL DEFAULT '0',
  `file_is_forSale` tinyint(1) NOT NULL DEFAULT '0',
  `file_params` varchar(17500) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `shared` tinyint(1) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`virtuemart_media_id`),
  KEY `i_virtuemart_vendor_id` (`virtuemart_vendor_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Additional Images and Files which are assigned to products' AUTO_INCREMENT=2027 ;

--
-- Dumping data for table `jos_virtuemart_medias`
--

INSERT INTO `jos_virtuemart_medias` (`file_lang`, `virtuemart_media_id`, `virtuemart_vendor_id`, `file_title`, `file_description`, `file_meta`, `file_mimetype`, `file_type`, `file_url`, `file_url_thumb`, `file_is_product_image`, `file_is_downloadable`, `file_is_forSale`, `file_params`, `ordering`, `shared`, `published`, `created_on`, `created_by`, `modified_on`, `modified_by`, `locked_on`, `locked_by`) VALUES
('', 1, 1, 'brand01.png', 'brand01', '', 'image/png', 'manufacturer', 'images/stories/virtuemart/manufacturer/brand01.png', 'images/stories/virtuemart/manufacturer/resized/brand01_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2014-06-09 12:13:00', 42, '0000-00-00 00:00:00', 0),
('', 2, 1, 'brand02.png', 'brand02', '', 'image/png', 'manufacturer', 'images/stories/virtuemart/manufacturer/brand02.png', 'images/stories/virtuemart/manufacturer/resized/brand02_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2014-06-09 12:09:51', 42, '0000-00-00 00:00:00', 0),
('', 3, 1, 'brand03.png', 'brand03', '', 'image/png', 'manufacturer', 'images/stories/virtuemart/manufacturer/brand03.png', 'images/stories/virtuemart/manufacturer/resized/brand03_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2014-06-09 12:10:01', 42, '0000-00-00 00:00:00', 0),
('', 4, 1, 'brand04.png', 'brand04', '', 'image/png', 'manufacturer', 'images/stories/virtuemart/manufacturer/brand04.png', 'images/stories/virtuemart/manufacturer/resized/brand04_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2014-06-09 12:10:11', 42, '0000-00-00 00:00:00', 0),
('', 5, 1, 'brand05.png', 'brand05', '', 'image/png', 'manufacturer', 'images/stories/virtuemart/manufacturer/brand05.png', 'images/stories/virtuemart/manufacturer/resized/brand05_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2014-06-09 12:10:25', 42, '0000-00-00 00:00:00', 0),
('', 99, 1, 'vendor.gif', '', '', 'image/gif', 'vendor', 'images/stories/virtuemart/vendor/vendor.gif', 'images/stories/virtuemart/vendor/resized/vendor_resized.gif', 0, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2014-03-13 13:55:52', 42, '0000-00-00 00:00:00', 0),
('', 100, 1, 'product01.png', 'product01', '', 'image/png', 'product', 'images/stories/virtuemart/product/product01.png', 'images/stories/virtuemart/product/resized/product01_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2014-03-13 13:46:09', 42, '0000-00-00 00:00:00', 0),
('', 101, 1, 'product02.png', 'product02', '', 'image/png', 'product', 'images/stories/virtuemart/product/product02.png', 'images/stories/virtuemart/product/resized/product02_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2014-01-10 12:08:19', 42, '0000-00-00 00:00:00', 0),
('', 102, 1, 'product03.png', 'product03', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product03.png', 'images/stories/virtuemart/product/resized/product03_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 103, 1, 'product04.png', 'product04', '', 'image/png', 'product', 'images/stories/virtuemart/product/product04.png', 'images/stories/virtuemart/product/resized/product04_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2014-03-13 13:46:54', 42, '0000-00-00 00:00:00', 0),
('', 104, 1, 'product05.png', 'product05', '', 'image/png', 'product', 'images/stories/virtuemart/product/product05.png', 'images/stories/virtuemart/product/resized/product05_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2014-03-13 13:50:58', 42, '0000-00-00 00:00:00', 0),
('', 105, 1, 'product06.png', 'product06', '', 'image/png', 'product', 'images/stories/virtuemart/product/product06.png', 'images/stories/virtuemart/product/resized/product06_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2014-03-13 13:47:44', 42, '0000-00-00 00:00:00', 0),
('', 106, 1, 'product07.png', 'product07', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product07.png', 'images/stories/virtuemart/product/resized/product07_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 107, 1, 'product08.png', 'product08', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product08.png', 'images/stories/virtuemart/product/resized/product08_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 108, 1, 'product09.png', 'product09', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product09.png', 'images/stories/virtuemart/product/resized/product09_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 109, 1, 'product10.png', 'product10', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product10.png', 'images/stories/virtuemart/product/resized/product10_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 110, 1, 'product11.png', 'product11', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product11.png', 'images/stories/virtuemart/product/resized/product11_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 111, 1, 'product12.png', 'product12', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product12.png', 'images/stories/virtuemart/product/resized/product12_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 112, 1, 'product13.png', 'product13', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product13.png', 'images/stories/virtuemart/product/resized/product13_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 113, 1, 'product14.png', 'product14', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product14.png', 'images/stories/virtuemart/product/resized/product14_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 114, 1, 'product15.png', 'product15', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product15.png', 'images/stories/virtuemart/product/resized/product15_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 115, 1, 'product16.png', 'product16', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product16.png', 'images/stories/virtuemart/product/resized/product16_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 116, 1, 'product17.png', 'product17', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product17.png', 'images/stories/virtuemart/product/resized/product17_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 117, 1, 'product18.png', 'product18', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product18.png', 'images/stories/virtuemart/product/resized/product18_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 118, 1, 'product19.png', 'product19', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product19.png', 'images/stories/virtuemart/product/resized/product19_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 119, 1, 'product20.png', 'product20', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product20.png', 'images/stories/virtuemart/product/resized/product20_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 120, 1, 'product21.png', 'product21', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product21.png', 'images/stories/virtuemart/product/resized/product21_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 121, 1, 'product22.png', 'product22', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product22.png', 'images/stories/virtuemart/product/resized/product22_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 122, 1, 'product23.png', 'product23', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product23.png', 'images/stories/virtuemart/product/resized/product23_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 123, 1, 'product24.png', 'product24', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product24.png', 'images/stories/virtuemart/product/resized/product24_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 124, 1, 'product25.png', 'product25', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product25.png', 'images/stories/virtuemart/product/resized/product25_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 125, 1, 'product26.png', 'product26', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product26.png', 'images/stories/virtuemart/product/resized/product26_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 126, 1, 'product27.png', 'product27', '', 'image/png', 'product', 'images/stories/virtuemart/product/product27.png', 'images/stories/virtuemart/product/resized/product27_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2014-04-29 13:40:48', 42, '0000-00-00 00:00:00', 0),
('', 127, 1, 'product28.png', 'product28', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product28.png', 'images/stories/virtuemart/product/resized/product28_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 128, 1, 'product29.png', 'product29', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product29.png', 'images/stories/virtuemart/product/resized/product29_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 129, 1, 'product30.png', 'product30', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product30.png', 'images/stories/virtuemart/product/resized/product30_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 130, 1, 'product31.png', 'product31', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product31.png', 'images/stories/virtuemart/product/resized/product31_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 131, 1, 'product32.png', 'product32', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product32.png', 'images/stories/virtuemart/product/resized/product32_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 132, 1, 'product33.png', 'product33', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product33.png', 'images/stories/virtuemart/product/resized/product33_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 133, 1, 'product34.png', 'product34', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product34.png', 'images/stories/virtuemart/product/resized/product34_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 134, 1, 'product35.png', 'product35', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product35.png', 'images/stories/virtuemart/product/resized/product35_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 135, 1, 'product36.png', 'product36', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product36.png', 'images/stories/virtuemart/product/resized/product36_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 136, 1, 'product37.png', 'product37', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product37.png', 'images/stories/virtuemart/product/resized/product37_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 137, 1, 'product38.png', 'product38', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product38.png', 'images/stories/virtuemart/product/resized/product38_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 138, 1, 'product39.png', 'product39', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product39.png', 'images/stories/virtuemart/product/resized/product39_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 139, 1, 'product40.png', 'product40', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product40.png', 'images/stories/virtuemart/product/resized/product40_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 140, 1, 'product41.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product41.png', 'images/stories/virtuemart/product/resized/product41_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 141, 1, 'product42.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product42.png', 'images/stories/virtuemart/product/resized/product42_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 142, 1, 'product43.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product43.png', 'images/stories/virtuemart/product/resized/product43_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 143, 1, 'product44.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product44.png', 'images/stories/virtuemart/product/resized/product44_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 144, 1, 'product45.png', '', '', 'image/png', 'product', 'images/stories/virtuemart/product/product45.png', 'images/stories/virtuemart/product/resized/product45_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2014-03-13 13:48:26', 42, '0000-00-00 00:00:00', 0),
('', 145, 1, 'product46.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product46.png', 'images/stories/virtuemart/product/resized/product46_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 146, 1, 'product47.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product47.png', 'images/stories/virtuemart/product/resized/product47_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 147, 1, 'product48.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product48.png', 'images/stories/virtuemart/product/resized/product48_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 148, 1, 'product49.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product49.png', 'images/stories/virtuemart/product/resized/product49_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 149, 1, 'product50.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product50.png', 'images/stories/virtuemart/product/resized/product50_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 150, 1, 'product51.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product51.png', 'images/stories/virtuemart/product/resized/product51_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 151, 1, 'product52.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product52.png', 'images/stories/virtuemart/product/resized/product52_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 152, 1, 'product53.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product53.png', 'images/stories/virtuemart/product/resized/product53_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 153, 1, 'product54.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product54.png', 'images/stories/virtuemart/product/resized/product54_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 154, 1, 'product55.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product55.png', 'images/stories/virtuemart/product/resized/product55_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 155, 1, 'product56.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product56.png', 'images/stories/virtuemart/product/resized/product56_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 156, 1, 'product57.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product57.png', 'images/stories/virtuemart/product/resized/product57_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 157, 1, 'product58.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product58.png', 'images/stories/virtuemart/product/resized/product58_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 158, 1, 'product59.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product59.png', 'images/stories/virtuemart/product/resized/product59_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 159, 1, 'product60.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product60.png', 'images/stories/virtuemart/product/resized/product60_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 160, 1, 'product61.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product61.png', 'images/stories/virtuemart/product/resized/product61_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 161, 1, 'product62.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product62.png', 'images/stories/virtuemart/product/resized/product62_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 162, 1, 'product63.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product63.png', 'images/stories/virtuemart/product/resized/product63_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 163, 1, 'product64.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product64.png', 'images/stories/virtuemart/product/resized/product64_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 164, 1, 'product65.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product65.png', 'images/stories/virtuemart/product/resized/product65_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 165, 1, 'product66.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product66.png', 'images/stories/virtuemart/product/resized/product66_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 166, 1, 'product67.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product67.png', 'images/stories/virtuemart/product/resized/product67_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 167, 1, 'product68.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product68.png', 'images/stories/virtuemart/product/resized/product68_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 168, 1, 'product69.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product69.png', 'images/stories/virtuemart/product/resized/product69_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 169, 1, 'product70.png', '', '', 'image/png', 'product', 'images/stories/virtuemart/product/product70.png', 'images/stories/virtuemart/product/resized/product70_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2014-04-29 13:40:51', 42, '0000-00-00 00:00:00', 0),
('', 170, 1, 'product71.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product71.png', 'images/stories/virtuemart/product/resized/product71_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 171, 1, 'product72.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product72.png', 'images/stories/virtuemart/product/resized/product72_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 172, 1, 'product73.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product73.png', 'images/stories/virtuemart/product/resized/product73_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-03-31 11:12:34', 0, '2012-03-31 11:12:34', 0, '0000-00-00 00:00:00', 0),
('', 173, 1, 'product74.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product74.png', 'images/stories/virtuemart/product/resized/product74_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-03-31 11:12:53', 0, '2012-03-31 11:12:53', 0, '0000-00-00 00:00:00', 0),
('', 174, 1, 'product75.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product75.png', 'images/stories/virtuemart/product/resized/product75_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-03-31 11:13:35', 0, '2012-03-31 11:13:35', 0, '0000-00-00 00:00:00', 0),
('', 175, 1, 'product76.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/product76.png', 'images/stories/virtuemart/product/resized/product76_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-03-31 11:13:06', 0, '2012-03-31 11:13:06', 0, '0000-00-00 00:00:00', 0),
('', 176, 1, 'product77.png', '', '', 'image/png', 'product', 'images/stories/virtuemart/product/product77.png', 'images/stories/virtuemart/product/resized/product77_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-03-31 11:12:59', 0, '2014-06-25 11:27:13', 42, '0000-00-00 00:00:00', 0),
('', 177, 1, 'product78.png', '', '', 'image/png', 'product', 'images/stories/virtuemart/product/product78.png', 'images/stories/virtuemart/product/resized/product78_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-03-31 11:15:33', 0, '2014-06-25 11:26:35', 42, '0000-00-00 00:00:00', 0),
('', 178, 1, 'product79.png', '', '', 'image/png', 'product', 'images/stories/virtuemart/product/product79.png', 'images/stories/virtuemart/product/resized/product79_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-03-31 11:13:18', 0, '2014-06-25 11:26:09', 42, '0000-00-00 00:00:00', 0),
('', 179, 1, 'product80.png', '', '', 'image/png', 'product', 'images/stories/virtuemart/product/product80.png', 'images/stories/virtuemart/product/resized/product80_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-03-31 11:13:12', 0, '2014-06-25 11:26:19', 42, '0000-00-00 00:00:00', 0),
('', 1000, 1, 'product02_thumb01.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_01/product02_thumb01.png', 'images/stories/virtuemart/product/resized/thumb_01/product02_thumb01_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1001, 1, 'product02_thumb02.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_02/product02_thumb02.png', 'images/stories/virtuemart/product/resized/thumb_02/product02_thumb02_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1002, 1, 'product03_thumb01.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_01/product03_thumb01.png', 'images/stories/virtuemart/product/resized/thumb_01/product03_thumb01_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1003, 1, 'product03_thumb02.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_02/product03_thumb02.png', 'images/stories/virtuemart/product/resized/thumb_02/product03_thumb02_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1004, 1, 'product04_thumb01.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_01/product04_thumb01.png', 'images/stories/virtuemart/product/resized/thumb_01/product04_thumb01_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1005, 1, 'product04_thumb02.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_02/product04_thumb02.png', 'images/stories/virtuemart/product/resized/thumb_02/product04_thumb02_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1006, 1, 'product05_thumb01.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_01/product05_thumb01.png', 'images/stories/virtuemart/product/resized/thumb_01/product05_thumb01_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1007, 1, 'product05_thumb02.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_02/product05_thumb02.png', 'images/stories/virtuemart/product/resized/thumb_02/product05_thumb02_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1008, 1, 'product06_thumb01.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_01/product06_thumb01.png', 'images/stories/virtuemart/product/resized/thumb_01/product06_thumb01_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1009, 1, 'product06_thumb02.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_02/product06_thumb02.png', 'images/stories/virtuemart/product/resized/thumb_02/product06_thumb02_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1010, 1, 'product07_thumb01.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_01/product07_thumb01.png', 'images/stories/virtuemart/product/resized/thumb_01/product07_thumb01_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1011, 1, 'product07_thumb02.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_02/product07_thumb02.png', 'images/stories/virtuemart/product/resized/thumb_02/product07_thumb02_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1012, 1, 'product08_thumb01.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_01/product08_thumb01.png', 'images/stories/virtuemart/product/resized/thumb_01/product08_thumb01_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1013, 1, 'product08_thumb02.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_02/product08_thumb02.png', 'images/stories/virtuemart/product/resized/thumb_02/product08_thumb02_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1014, 1, 'product09_thumb01.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_01/product09_thumb01.png', 'images/stories/virtuemart/product/resized/thumb_01/product09_thumb01_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1015, 1, 'product09_thumb02.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_02/product09_thumb02.png', 'images/stories/virtuemart/product/resized/thumb_02/product09_thumb02_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1016, 1, 'product10_thumb01.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_01/product10_thumb01.png', 'images/stories/virtuemart/product/resized/thumb_01/product10_thumb01_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1017, 1, 'product10_thumb02.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_02/product10_thumb02.png', 'images/stories/virtuemart/product/resized/thumb_02/product10_thumb02_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1018, 1, 'product11_thumb01.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_01/product11_thumb01.png', 'images/stories/virtuemart/product/resized/thumb_01/product11_thumb01_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1019, 1, 'product11_thumb02.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_02/product11_thumb02.png', 'images/stories/virtuemart/product/resized/thumb_02/product11_thumb02_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1020, 1, 'product12_thumb01.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_01/product12_thumb01.png', 'images/stories/virtuemart/product/resized/thumb_01/product12_thumb01_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1021, 1, 'product12_thumb02.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_02/product12_thumb02.png', 'images/stories/virtuemart/product/resized/thumb_02/product12_thumb02_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1022, 1, 'product13_thumb01.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_01/product13_thumb01.png', 'images/stories/virtuemart/product/resized/thumb_01/product13_thumb01_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1023, 1, 'product13_thumb02.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_02/product13_thumb02.png', 'images/stories/virtuemart/product/resized/thumb_02/product13_thumb02_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1024, 1, 'product14_thumb01.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_01/product14_thumb01.png', 'images/stories/virtuemart/product/resized/thumb_01/product14_thumb01_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1025, 1, 'product14_thumb02.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_02/product14_thumb02.png', 'images/stories/virtuemart/product/resized/thumb_02/product14_thumb02_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1026, 1, 'product15_thumb01.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_01/product15_thumb01.png', 'images/stories/virtuemart/product/resized/thumb_01/product15_thumb01_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1027, 1, 'product15_thumb02.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_02/product15_thumb02.png', 'images/stories/virtuemart/product/resized/thumb_02/product15_thumb02_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1028, 1, 'product16_thumb01.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_01/product16_thumb01.png', 'images/stories/virtuemart/product/resized/thumb_01/product16_thumb01_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1029, 1, 'product16_thumb02.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_02/product16_thumb02.png', 'images/stories/virtuemart/product/resized/thumb_02/product16_thumb02_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1030, 1, 'product17_thumb01.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_01/product17_thumb01.png', 'images/stories/virtuemart/product/resized/thumb_01/product17_thumb01_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1031, 1, 'product17_thumb02.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_02/product17_thumb02.png', 'images/stories/virtuemart/product/resized/thumb_02/product17_thumb02_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1032, 1, 'product18_thumb01.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_01/product18_thumb01.png', 'images/stories/virtuemart/product/resized/thumb_01/product18_thumb01_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1033, 1, 'product18_thumb02.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_02/product18_thumb02.png', 'images/stories/virtuemart/product/resized/thumb_02/product18_thumb02_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1034, 1, 'product19_thumb01.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_01/product19_thumb01.png', 'images/stories/virtuemart/product/resized/thumb_01/product19_thumb01_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1035, 1, 'product19_thumb02.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_02/product19_thumb02.png', 'images/stories/virtuemart/product/resized/thumb_02/product19_thumb02_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1036, 1, 'product20_thumb01.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_01/product20_thumb01.png', 'images/stories/virtuemart/product/resized/thumb_01/product20_thumb01_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1037, 1, 'product20_thumb02.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_02/product20_thumb02.png', 'images/stories/virtuemart/product/resized/thumb_02/product20_thumb02_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1038, 1, 'product21_thumb01.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_01/product21_thumb01.png', 'images/stories/virtuemart/product/resized/thumb_01/product21_thumb01_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1039, 1, 'product21_thumb02.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_02/product21_thumb02.png', 'images/stories/virtuemart/product/resized/thumb_02/product21_thumb02_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1040, 1, 'product22_thumb01.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_01/product22_thumb01.png', 'images/stories/virtuemart/product/resized/thumb_01/product22_thumb01_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1041, 1, 'product22_thumb02.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_02/product22_thumb02.png', 'images/stories/virtuemart/product/resized/thumb_02/product22_thumb02_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1042, 1, 'product23_thumb01.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_01/product23_thumb01.png', 'images/stories/virtuemart/product/resized/thumb_01/product23_thumb01_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1043, 1, 'product23_thumb02.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_02/product23_thumb02.png', 'images/stories/virtuemart/product/resized/thumb_02/product23_thumb02_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1044, 1, 'product24_thumb01.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_01/product24_thumb01.png', 'images/stories/virtuemart/product/resized/thumb_01/product24_thumb01_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1045, 1, 'product24_thumb02.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_02/product24_thumb02.png', 'images/stories/virtuemart/product/resized/thumb_02/product24_thumb02_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1046, 1, 'product25_thumb01.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_01/product25_thumb01.png', 'images/stories/virtuemart/product/resized/thumb_01/product25_thumb01_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1047, 1, 'product25_thumb02.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_02/product25_thumb02.png', 'images/stories/virtuemart/product/resized/thumb_02/product25_thumb02_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1048, 1, 'product26_thumb01.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_01/product26_thumb01.png', 'images/stories/virtuemart/product/resized/thumb_01/product26_thumb01_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1049, 1, 'product26_thumb02.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_02/product26_thumb02.png', 'images/stories/virtuemart/product/resized/thumb_02/product26_thumb02_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1050, 1, 'product27_thumb01.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_01/product27_thumb01.png', 'images/stories/virtuemart/product/resized/thumb_01/product27_thumb01_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1051, 1, 'product27_thumb02.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_02/product27_thumb02.png', 'images/stories/virtuemart/product/resized/thumb_02/product27_thumb02_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1052, 1, 'product28_thumb01.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_01/product28_thumb01.png', 'images/stories/virtuemart/product/resized/thumb_01/product28_thumb01_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 1053, 1, 'product28_thumb02.png', '', '', 'image/jpg', 'product', 'images/stories/virtuemart/product/thumb_02/product28_thumb02.png', 'images/stories/virtuemart/product/resized/thumb_02/product28_thumb02_resized.png', 1, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2012-01-10 15:32:01', 0, '0000-00-00 00:00:00', 0),
('', 2000, 1, 'category01.png', '', '', 'image/png', 'category', 'images/stories/virtuemart/category/cat01.png', 'images/stories/virtuemart/category/resized/cat01_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2014-09-04 11:21:56', 42, '0000-00-00 00:00:00', 0),
('', 2001, 1, 'category02.png', '', '', 'image/png', 'category', 'images/stories/virtuemart/category/cat02.png', 'images/stories/virtuemart/category/resized/cat02_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2014-09-04 11:22:07', 42, '0000-00-00 00:00:00', 0),
('', 2002, 1, 'category03.png', '', '', 'image/png', 'category', 'images/stories/virtuemart/category/cat03.png', 'images/stories/virtuemart/category/resized/cat03_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2014-09-04 11:22:21', 42, '0000-00-00 00:00:00', 0),
('', 2003, 1, 'category04.png', '', '', 'image/png', 'category', 'images/stories/virtuemart/category/cat04.png', 'images/stories/virtuemart/category/resized/cat04_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2014-09-04 11:22:32', 42, '0000-00-00 00:00:00', 0),
('', 2004, 1, 'category05.png', '', '', 'image/png', 'category', 'images/stories/virtuemart/category/cat05.png', 'images/stories/virtuemart/category/resized/cat05_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2014-09-04 11:22:43', 42, '0000-00-00 00:00:00', 0),
('', 2005, 1, 'category06.png', '', '', 'image/png', 'category', 'images/stories/virtuemart/category/cat06.png', 'images/stories/virtuemart/category/resized/cat06_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2014-09-04 11:22:53', 42, '0000-00-00 00:00:00', 0),
('', 2006, 1, 'category07.png', '', '', 'image/png', 'category', 'images/stories/virtuemart/category/cat07.png', 'images/stories/virtuemart/category/resized/cat07_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2014-09-04 11:23:01', 42, '0000-00-00 00:00:00', 0),
('', 2007, 1, 'categoryt08.png', '', '', 'image/png', 'category', 'images/stories/virtuemart/category/cat08.png', 'images/stories/virtuemart/category/resized/cat08_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2014-09-04 11:23:10', 42, '0000-00-00 00:00:00', 0),
('', 2008, 1, 'category09.png', '', '', 'image/png', 'category', 'images/stories/virtuemart/category/cat09.png', 'images/stories/virtuemart/category/resized/cat09_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2014-09-04 11:23:19', 42, '0000-00-00 00:00:00', 0),
('', 2009, 1, 'category10.png', '', '', 'image/png', 'category', 'images/stories/virtuemart/category/cat10.png', 'images/stories/virtuemart/category/resized/cat10_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2014-09-04 11:23:30', 42, '0000-00-00 00:00:00', 0),
('', 2010, 1, 'category11.png', '', '', 'image/png', 'category', 'images/stories/virtuemart/category/cat11.png', 'images/stories/virtuemart/category/resized/cat11_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2014-08-04 08:11:09', 42, '0000-00-00 00:00:00', 0),
('', 2011, 1, 'category12.png', '', '', 'image/png', 'category', 'images/stories/virtuemart/category/cat12.png', 'images/stories/virtuemart/category/resized/cat12_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2014-08-04 08:12:08', 42, '0000-00-00 00:00:00', 0),
('', 2012, 1, 'category13.png', '', '', 'image/png', 'category', 'images/stories/virtuemart/category/cat13.png', 'images/stories/virtuemart/category/resized/cat13_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2014-08-04 08:12:20', 42, '0000-00-00 00:00:00', 0),
('', 2013, 1, 'category14.png', '', '', 'image/png', 'category', 'images/stories/virtuemart/category/cat14.png', 'images/stories/virtuemart/category/resized/cat14_resized.png', 0, 0, 0, '', 0, 0, 1, '2012-01-10 15:32:01', 0, '2014-08-04 08:12:30', 42, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_migration_oldtonew_ids`
--

DROP TABLE IF EXISTS `jos_virtuemart_migration_oldtonew_ids`;
CREATE TABLE `jos_virtuemart_migration_oldtonew_ids` (
  `attributes` longblob,
  `relatedproducts` longblob,
  `id` smallint(1) unsigned NOT NULL AUTO_INCREMENT,
  `cats` longblob,
  `catsxref` blob,
  `manus` longblob,
  `mfcats` blob,
  `shoppergroups` longblob,
  `products` longblob,
  `products_start` int(1) DEFAULT NULL,
  `orderstates` blob,
  `orders` longblob,
  `orders_start` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='xref table for vm1 ids to vm2 ids' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jos_virtuemart_migration_oldtonew_ids`
--

INSERT INTO `jos_virtuemart_migration_oldtonew_ids` (`attributes`, `relatedproducts`, `id`, `cats`, `catsxref`, `manus`, `mfcats`, `shoppergroups`, `products`, `products_start`, `orderstates`, `orders`, `orders_start`) VALUES
(NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_modules`
--

DROP TABLE IF EXISTS `jos_virtuemart_modules`;
CREATE TABLE `jos_virtuemart_modules` (
  `module_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `module_name` char(255) DEFAULT NULL,
  `module_description` varchar(21000) DEFAULT NULL,
  `module_perms` char(255) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `is_admin` enum('0','1') NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`module_id`),
  KEY `idx_module_name` (`module_name`),
  KEY `idx_module_ordering` (`ordering`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='VirtueMart Core Modules, not: Joomla modules' AUTO_INCREMENT=14 ;

--
-- Dumping data for table `jos_virtuemart_modules`
--

INSERT INTO `jos_virtuemart_modules` (`module_id`, `module_name`, `module_description`, `module_perms`, `published`, `is_admin`, `ordering`) VALUES
(1, 'product', 'Here you can administer your online catalog of products.  Categories , Products (view=product), Attributes  ,Product Types      Product Files (view=media), Inventory  , Calculation Rules ,Customer Reviews  ', 'storeadmin,admin', 1, '1', 1),
(2, 'order', 'View Order and Update Order Status:    Orders , Coupons , Revenue Report ,Shopper , Shopper Groups ', 'admin,storeadmin', 1, '1', 2),
(3, 'manufacturer', 'Manage the manufacturers of products in your store.', 'storeadmin,admin', 1, '1', 3),
(4, 'store', 'Store Configuration: Store Information, Payment Methods , Shipment, Shipment Rates', 'storeadmin,admin', 1, '1', 4),
(5, 'configuration', 'Configuration: shop configuration , currencies (view=currency), Credit Card List, Countries, userfields, order status  ', 'admin,storeadmin', 1, '1', 5),
(6, 'msgs', 'This module is unprotected an used for displaying system messages to users.  We need to have an area that does not require authorization when things go wrong.', 'none', 0, '0', 99),
(7, 'shop', 'This is the Washupito store module.  This is the demo store included with the VirtueMart distribution.', 'none', 1, '0', 99),
(8, 'store', 'Store Configuration: Store Information, Payment Methods , Shipment, Shipment Rates', 'storeadmin,admin', 1, '1', 4),
(9, 'account', 'This module allows shoppers to update their account information and view previously placed orders.', 'shopper,storeadmin,admin,demo', 1, '0', 99),
(10, 'checkout', '', 'none', 0, '0', 99),
(11, 'tools', 'Tools', 'admin', 1, '1', 8),
(13, 'zone', 'This is the zone-shipment module. Here you can manage your shipment costs according to Zones.', 'admin,storeadmin', 0, '1', 11);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_paymentmethods`
--

DROP TABLE IF EXISTS `jos_virtuemart_paymentmethods`;
CREATE TABLE `jos_virtuemart_paymentmethods` (
  `virtuemart_paymentmethod_id` mediumint(1) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_vendor_id` smallint(11) NOT NULL DEFAULT '1',
  `payment_jplugin_id` int(11) NOT NULL DEFAULT '0',
  `slug` char(255) NOT NULL DEFAULT '',
  `payment_element` char(50) NOT NULL DEFAULT '',
  `payment_params` varchar(19000) DEFAULT NULL,
  `shared` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'valide for all vendors?',
  `ordering` int(2) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`virtuemart_paymentmethod_id`),
  KEY `idx_payment_jplugin_id` (`payment_jplugin_id`),
  KEY `idx_payment_method_ordering` (`ordering`),
  KEY `idx_payment_element` (`payment_element`,`virtuemart_vendor_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='The payment methods of your store' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `jos_virtuemart_paymentmethods`
--

INSERT INTO `jos_virtuemart_paymentmethods` (`virtuemart_paymentmethod_id`, `virtuemart_vendor_id`, `payment_jplugin_id`, `slug`, `payment_element`, `payment_params`, `shared`, `ordering`, `published`, `created_on`, `created_by`, `modified_on`, `modified_by`, `locked_on`, `locked_by`) VALUES
(1, 1, 10002, '', 'standard', 'payment_logos=["payzen.jpg"]|countries=""|payment_currency="0"|status_pending="U"|send_invoice_on_order_null="1"|min_amount=""|max_amount=""|cost_per_transaction=""|cost_percent_total="5"|tax_id="1"|payment_info="Payment Name Standart"|', 0, 1, 1, '0000-00-00 00:00:00', 0, '2013-08-12 08:18:45', 79, '0000-00-00 00:00:00', 0),
(2, 1, 10003, '', 'payzen', 'developed_by=""|contact_email=""|contrib_version=""|gateway_version=""|cms_version=""|documentation=""|payment_logos=""|cost_per_transaction=""|cost_percent_total=""|tax_id="-1"|site_id="56790135"|key_test="9827035662780440"|key_prod="2222222222222222"|ctx_mode="TEST"|platform_url="https:\\/\\/secure.payzen.eu\\/vads-payment\\/"|language="fr"|available_languages=[""]|capture_delay=""|validation_mode=""|payment_cards=[""]|threeds_min_amount=""|min_amount=""|max_amount=""|redirect_enabled="0"|redirect_success_timeout="5"|redirect_success_message="Votre paiement a bien \\u00e9t\\u00e9 pris en compte, vous allez \\u00eatre redirig\\u00e9 dans quelques instants."|redirect_error_timeout="5"|redirect_error_message="Une erreur est survenue, vous allez \\u00eatre redirig\\u00e9 dans quelques instants."|return_mode="GET"|silent_url=""|order_success_status="C"|order_failure_status="X"|debug="0"|', 0, 2, 0, '2013-11-08 09:21:54', 382, '2013-11-08 09:22:16', 382, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_paymentmethods_en_gb`
--

DROP TABLE IF EXISTS `jos_virtuemart_paymentmethods_en_gb`;
CREATE TABLE `jos_virtuemart_paymentmethods_en_gb` (
  `virtuemart_paymentmethod_id` int(1) unsigned NOT NULL,
  `payment_name` char(180) NOT NULL DEFAULT '',
  `payment_desc` varchar(19000) NOT NULL DEFAULT '',
  `slug` char(192) NOT NULL DEFAULT '',
  PRIMARY KEY (`virtuemart_paymentmethod_id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_virtuemart_paymentmethods_en_gb`
--

INSERT INTO `jos_virtuemart_paymentmethods_en_gb` (`virtuemart_paymentmethod_id`, `payment_name`, `payment_desc`, `slug`) VALUES
(1, 'Payment Name Standart', 'Payment Name Standart', 'payment-name-standart'),
(2, 'Payment Name', 'Payment Description', 'payment-name');

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_paymentmethod_shoppergroups`
--

DROP TABLE IF EXISTS `jos_virtuemart_paymentmethod_shoppergroups`;
CREATE TABLE `jos_virtuemart_paymentmethod_shoppergroups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_paymentmethod_id` mediumint(1) unsigned NOT NULL DEFAULT '0',
  `virtuemart_shoppergroup_id` smallint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `i_virtuemart_paymentmethod_id` (`virtuemart_paymentmethod_id`,`virtuemart_shoppergroup_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='xref table for paymentmethods to shoppergroup' AUTO_INCREMENT=9 ;

--
-- Dumping data for table `jos_virtuemart_paymentmethod_shoppergroups`
--

INSERT INTO `jos_virtuemart_paymentmethod_shoppergroups` (`id`, `virtuemart_paymentmethod_id`, `virtuemart_shoppergroup_id`) VALUES
(1, 1, 2),
(2, 1, 1),
(3, 1, 3),
(4, 1, 4),
(5, 2, 1),
(6, 2, 2),
(7, 2, 3),
(8, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_payment_plg_payzen`
--

DROP TABLE IF EXISTS `jos_virtuemart_payment_plg_payzen`;
CREATE TABLE `jos_virtuemart_payment_plg_payzen` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_order_id` int(1) unsigned DEFAULT NULL,
  `order_number` char(64) DEFAULT NULL,
  `virtuemart_paymentmethod_id` mediumint(1) unsigned DEFAULT NULL,
  `payment_name` varchar(5000) DEFAULT NULL,
  `payment_order_total` decimal(15,5) NOT NULL DEFAULT '0.00000',
  `payment_currency` char(3) DEFAULT NULL,
  `cost_per_transaction` decimal(10,2) DEFAULT NULL,
  `cost_percent_total` decimal(10,2) DEFAULT NULL,
  `tax_id` smallint(1) DEFAULT NULL,
  `payzen_custom` varchar(255) DEFAULT NULL,
  `payzen_response_payment_amount` char(15) DEFAULT NULL,
  `payzen_response_auth_number` char(10) DEFAULT NULL,
  `payzen_response_payment_currency` char(3) DEFAULT NULL,
  `payzen_response_payment_mean` char(255) DEFAULT NULL,
  `payzen_response_payment_date` char(20) DEFAULT NULL,
  `payzen_response_payment_status` char(3) DEFAULT NULL,
  `payzen_response_payment_message` char(255) DEFAULT NULL,
  `payzen_response_card_number` char(50) DEFAULT NULL,
  `payzen_response_trans_id` char(6) DEFAULT NULL,
  `payzen_response_expiry_month` char(2) DEFAULT NULL,
  `payzen_response_expiry_year` char(4) DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Payment payzen Table' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_payment_plg_standard`
--

DROP TABLE IF EXISTS `jos_virtuemart_payment_plg_standard`;
CREATE TABLE `jos_virtuemart_payment_plg_standard` (
  `email_currency` char(3) DEFAULT NULL,
  `id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_order_id` int(1) unsigned DEFAULT NULL,
  `order_number` char(64) DEFAULT NULL,
  `virtuemart_paymentmethod_id` mediumint(1) unsigned DEFAULT NULL,
  `payment_name` varchar(5000) DEFAULT NULL,
  `payment_order_total` decimal(15,5) NOT NULL DEFAULT '0.00000',
  `payment_currency` char(3) DEFAULT NULL,
  `cost_per_transaction` decimal(10,2) DEFAULT NULL,
  `cost_percent_total` decimal(10,2) DEFAULT NULL,
  `tax_id` smallint(1) DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Payment Standard Table' AUTO_INCREMENT=20 ;

--
-- Dumping data for table `jos_virtuemart_payment_plg_standard`
--

INSERT INTO `jos_virtuemart_payment_plg_standard` (`email_currency`, `id`, `virtuemart_order_id`, `order_number`, `virtuemart_paymentmethod_id`, `payment_name`, `payment_order_total`, `payment_currency`, `cost_per_transaction`, `cost_percent_total`, `tax_id`, `created_on`, `created_by`, `modified_on`, `modified_by`, `locked_on`, `locked_by`) VALUES
(NULL, 1, 1, '4daf03', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://localhost/vm2/test2.0.16_a/images/stories/virtuemart/payment/payzen.jpg"  alt="payzen" /></span>  <span class="vmpayment_name">Payment Name Standart</span><span class="vmpayment_description">Payment Name Standart</span><br />Payment Name Standart', '242.92000', 'USD', '0.00', '5.00', 1, '2013-01-03 12:53:21', 0, '2013-01-03 12:53:21', 0, '0000-00-00 00:00:00', 0),
(NULL, 5, 1, 'f2ff03', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://localhost/vm2/theme_svn/images/stories/virtuemart/payment/payzen.jpg"  alt="payzen" /></span>  <span class="vmpayment_name">Payment Name Standart</span><span class="vmpayment_description">Payment Name Standart</span><br />Payment Name Standart', '736.23000', 'USD', '0.00', '5.00', 1, '2013-08-17 10:23:37', 703, '2013-08-17 10:23:37', 703, '0000-00-00 00:00:00', 0),
('144', 6, 2, '355203', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.37/Virtuemart/theme472/images/stories/virtuemart/payment/payzen.jpg"  alt="payzen" /></span>  <span class="vmpayment_name">Payment Name Standart</span><span class="vmpayment_description">Payment Name Standart</span><br />Payment Name Standart', '101.05000', 'USD', '0.00', '5.00', 1, '2014-02-10 14:52:06', 42, '2014-02-10 14:52:06', 42, '0000-00-00 00:00:00', 0),
('144', 7, 3, 'e5d504', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.37/Virtuemart/theme472/images/stories/virtuemart/payment/payzen.jpg"  alt="payzen" /></span>  <span class="vmpayment_name">Payment Name Standart</span><span class="vmpayment_description">Payment Name Standart</span><br />Payment Name Standart', '107.49000', 'USD', '0.00', '5.00', 1, '2014-02-10 15:00:29', 42, '2014-02-10 15:00:29', 42, '0000-00-00 00:00:00', 0),
('144', 8, 4, 'cef005', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.37/Virtuemart/theme472/images/stories/virtuemart/payment/payzen.jpg"  alt="payzen" /></span>  <span class="vmpayment_name">Payment Name Standart</span><span class="vmpayment_description">Payment Name Standart</span><br />Payment Name Standart', '236.19000', 'USD', '0.00', '5.00', 1, '2014-02-10 15:32:28', 42, '2014-02-10 15:32:28', 42, '0000-00-00 00:00:00', 0),
('144', 9, 8, '5c2409', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.37/Virtuemart/theme472/images/stories/virtuemart/payment/payzen.jpg"  alt="payzen" /></span>  <span class="vmpayment_name">Payment Name Standart</span><span class="vmpayment_description">Payment Name Standart</span><br />Payment Name Standart', '135.14000', 'USD', '0.00', '5.00', 1, '2014-02-10 15:48:58', 42, '2014-02-10 15:48:58', 42, '0000-00-00 00:00:00', 0),
('144', 10, 12, 'd8ea013', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.37/Virtuemart/theme472/images/stories/virtuemart/payment/payzen.jpg"  alt="payzen" /></span>  <span class="vmpayment_name">Payment Name Standart</span><span class="vmpayment_description">Payment Name Standart</span><br />Payment Name Standart', '118.12000', 'USD', '0.00', '5.00', 1, '2014-02-10 16:02:53', 42, '2014-02-10 16:02:53', 42, '0000-00-00 00:00:00', 0),
('144', 11, 13, '4f7e014', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.37/Virtuemart/theme472/images/stories/virtuemart/payment/payzen.jpg"  alt="payzen" /></span>  <span class="vmpayment_name">Payment Name Standart</span><span class="vmpayment_description">Payment Name Standart</span><br />Payment Name Standart', '118.12000', 'USD', '0.00', '5.00', 1, '2014-02-10 16:07:48', 42, '2014-02-10 16:07:48', 42, '0000-00-00 00:00:00', 0),
('144', 12, 14, 'f39a015', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.37/Virtuemart/theme472/images/stories/virtuemart/payment/payzen.jpg"  alt="payzen" /></span>  <span class="vmpayment_name">Payment Name Standart</span><span class="vmpayment_description">Payment Name Standart</span><br />Payment Name Standart', '107.49000', 'USD', '0.00', '5.00', 1, '2014-02-10 16:13:29', 42, '2014-02-10 16:13:29', 42, '0000-00-00 00:00:00', 0),
('144', 13, 15, '24dd016', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.37/Virtuemart/theme472/images/stories/virtuemart/payment/payzen.jpg"  alt="payzen" /></span>  <span class="vmpayment_name">Payment Name Standart</span><span class="vmpayment_description">Payment Name Standart</span><br />Payment Name Standart', '135.14000', 'USD', '0.00', '5.00', 1, '2014-02-10 16:56:18', 42, '2014-02-10 16:56:18', 42, '0000-00-00 00:00:00', 0),
('144', 14, 16, '0fff017', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.37/Virtuemart/theme472/images/stories/virtuemart/payment/payzen.jpg"  alt="payzen" /></span>  <span class="vmpayment_name">Payment Name Standart</span><span class="vmpayment_description">Payment Name Standart</span><br />Payment Name Standart', '223.32000', 'USD', '0.00', '5.00', 1, '2014-02-11 07:46:15', 42, '2014-02-11 07:46:15', 42, '0000-00-00 00:00:00', 0),
('144', 15, 17, 'e9f3018', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.37/Virtuemart/theme472/images/stories/virtuemart/payment/payzen.jpg"  alt="payzen" /></span>  <span class="vmpayment_name">Payment Name Standart</span><span class="vmpayment_description">Payment Name Standart</span><br />Payment Name Standart', '107.49000', 'USD', '0.00', '5.00', 1, '2014-02-11 10:49:27', 42, '2014-02-11 10:49:27', 42, '0000-00-00 00:00:00', 0),
('144', 16, 2, 'f88603', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://localhost/Virtuemart/theme474/images/stories/virtuemart/payment/payzen.jpg"  alt="payzen" /></span>  <span class="vmpayment_name">Payment Name Standart</span><span class="vmpayment_description">Payment Name Standart</span><br />Payment Name Standart', '324.37000', 'USD', '0.00', '5.00', 1, '2014-02-14 17:06:33', 42, '2014-02-14 17:06:33', 42, '0000-00-00 00:00:00', 0),
('144', 17, 3, 'c3eb04', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://localhost/VIRTUEMART/theme476/images/stories/virtuemart/payment/payzen.jpg"  alt="payzen" /></span>  <span class="vmpayment_name">Payment Name Standart</span><span class="vmpayment_description">Payment Name Standart</span><br />Payment Name Standart', '107.49000', 'USD', '0.00', '5.00', 1, '2014-02-24 23:30:08', 42, '2014-02-24 23:30:08', 42, '0000-00-00 00:00:00', 0),
('144', 18, 2, 'e10003', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://localhost/VIRTUEMART/theme478/images/stories/virtuemart/payment/payzen.jpg"  alt="payzen" /></span>  <span class="vmpayment_name">Payment Name Standart</span><span class="vmpayment_description">Payment Name Standart</span><br />Payment Name Standart', '190.39000', 'USD', '0.00', '5.00', 1, '2014-03-08 14:33:11', 42, '2014-03-08 14:33:11', 42, '0000-00-00 00:00:00', 0),
('144', 19, 2, 'b92503', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.37/VIRTUEMART/theme480/images/stories/virtuemart/payment/payzen.jpg"  alt="payzen" /></span>  <span class="vmpayment_name">Payment Name Standart</span><span class="vmpayment_description">Payment Name Standart</span><br />Payment Name Standart', '107.49000', 'USD', '0.00', '5.00', 1, '2014-03-13 14:21:28', 42, '2014-03-13 14:21:28', 42, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_permgroups`
--

DROP TABLE IF EXISTS `jos_virtuemart_permgroups`;
CREATE TABLE `jos_virtuemart_permgroups` (
  `virtuemart_permgroup_id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_vendor_id` smallint(1) unsigned NOT NULL DEFAULT '1',
  `group_name` char(128) DEFAULT NULL,
  `group_level` int(11) DEFAULT NULL,
  `ordering` int(2) NOT NULL DEFAULT '0',
  `shared` tinyint(1) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`virtuemart_permgroup_id`),
  KEY `i_virtuemart_vendor_id` (`virtuemart_vendor_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Holds all the user groups' AUTO_INCREMENT=5 ;

--
-- Dumping data for table `jos_virtuemart_permgroups`
--

INSERT INTO `jos_virtuemart_permgroups` (`virtuemart_permgroup_id`, `virtuemart_vendor_id`, `group_name`, `group_level`, `ordering`, `shared`, `published`, `created_on`, `created_by`, `modified_on`, `modified_by`, `locked_on`, `locked_by`) VALUES
(1, 1, 'admin', 0, 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(2, 1, 'storeadmin', 250, 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(3, 1, 'shopper', 500, 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(4, 1, 'demo', 750, 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_products`
--

DROP TABLE IF EXISTS `jos_virtuemart_products`;
CREATE TABLE `jos_virtuemart_products` (
  `pordering` mediumint(2) unsigned NOT NULL DEFAULT '0',
  `virtuemart_product_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_vendor_id` smallint(1) unsigned NOT NULL DEFAULT '1',
  `product_parent_id` int(1) unsigned NOT NULL DEFAULT '0',
  `product_sku` char(64) DEFAULT NULL,
  `product_weight` decimal(10,4) DEFAULT NULL,
  `product_weight_uom` char(7) DEFAULT NULL,
  `product_length` decimal(10,4) DEFAULT NULL,
  `product_width` decimal(10,4) DEFAULT NULL,
  `product_height` decimal(10,4) DEFAULT NULL,
  `product_lwh_uom` char(7) DEFAULT NULL,
  `product_url` char(255) DEFAULT NULL,
  `product_in_stock` int(1) NOT NULL DEFAULT '0',
  `product_ordered` int(1) NOT NULL DEFAULT '0',
  `low_stock_notification` int(1) unsigned NOT NULL DEFAULT '0',
  `product_available_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `product_availability` char(32) DEFAULT NULL,
  `product_special` tinyint(1) DEFAULT NULL,
  `product_sales` int(1) unsigned NOT NULL DEFAULT '0',
  `product_unit` varchar(8) DEFAULT NULL,
  `product_packaging` decimal(8,4) unsigned DEFAULT NULL,
  `product_params` varchar(2000) DEFAULT NULL,
  `hits` int(11) unsigned DEFAULT NULL,
  `intnotes` varchar(18000) DEFAULT NULL,
  `metarobot` varchar(400) DEFAULT NULL,
  `metaauthor` varchar(400) DEFAULT NULL,
  `layout` char(16) DEFAULT NULL,
  `published` tinyint(1) DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`virtuemart_product_id`),
  KEY `idx_product_virtuemart_vendor_id` (`virtuemart_vendor_id`),
  KEY `idx_product_product_parent_id` (`product_parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='All products are stored here.' AUTO_INCREMENT=95 ;

--
-- Dumping data for table `jos_virtuemart_products`
--

INSERT INTO `jos_virtuemart_products` (`pordering`, `virtuemart_product_id`, `virtuemart_vendor_id`, `product_parent_id`, `product_sku`, `product_weight`, `product_weight_uom`, `product_length`, `product_width`, `product_height`, `product_lwh_uom`, `product_url`, `product_in_stock`, `product_ordered`, `low_stock_notification`, `product_available_date`, `product_availability`, `product_special`, `product_sales`, `product_unit`, `product_packaging`, `product_params`, `hits`, `intnotes`, `metarobot`, `metaauthor`, `layout`, `published`, `created_on`, `created_by`, `modified_on`, `modified_by`, `locked_on`, `locked_by`) VALUES
(0, 1, 1, 0, 'PS01', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 0, 0, 5, '2012-01-11 00:00:00', '14d.gif', 0, 0, 'KG', '0.0000', 'min_order_level=""|max_order_level=""|step_order_level=""|product_box=""|', 0, '', '', '', '0', 1, '2012-01-11 10:49:44', 0, '2014-03-13 13:46:09', 42, '0000-00-00 00:00:00', 0),
(0, 2, 1, 0, 'PS02', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 40, 11, 1, '2012-01-11 00:00:00', '1-4w.gif', 0, 0, 'KG', '0.0000', 'min_order_level=""|max_order_level=""|step_order_level=""|product_box=""|', 0, '', '', '', '0', 1, '2012-01-11 10:49:44', 0, '2014-01-10 12:08:19', 42, '0000-00-00 00:00:00', 0),
(0, 3, 1, 0, 'PS03', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '1-2m.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 11:48:49', 0, '0000-00-00 00:00:00', 0),
(0, 4, 1, 0, 'PS04', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '1-4w.gif', 1, 0, 'KG', '0.0000', 'min_order_level=""|max_order_level=""|step_order_level=""|product_box=""|', 0, '', '', '', '0', 1, '2012-01-11 10:49:44', 0, '2014-03-13 13:46:54', 42, '0000-00-00 00:00:00', 0),
(0, 5, 1, 0, 'PS05', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-2m.gif', 1, 0, 'KG', '0.0000', 'min_order_level=""|max_order_level=""|step_order_level=""|product_box=""|', 0, '', '', '', '0', 1, '2012-01-11 10:49:44', 0, '2014-03-13 13:50:58', 42, '0000-00-00 00:00:00', 0),
(0, 6, 1, 0, 'PS06', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 1, 5, '2012-01-11 00:00:00', '14d.gif', 1, 0, 'KG', '0.0000', 'min_order_level=""|max_order_level=""|step_order_level=""|product_box=""|', 0, '', '', '', '0', 1, '2012-01-11 10:49:44', 0, '2014-03-13 13:47:44', 42, '0000-00-00 00:00:00', 0),
(0, 7, 1, 0, 'PS07', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-2m.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 10:53:25', 0, '0000-00-00 00:00:00', 0),
(0, 8, 1, 0, 'PS08', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '1-2m.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 11:50:39', 0, '0000-00-00 00:00:00', 0),
(0, 9, 1, 0, 'PS09', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-2m.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 11:51:17', 0, '0000-00-00 00:00:00', 0),
(0, 10, 1, 0, 'PS10', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '14d.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 11:51:58', 0, '0000-00-00 00:00:00', 0),
(0, 11, 1, 0, 'PS11', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-2m.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 11:53:10', 0, '0000-00-00 00:00:00', 0),
(0, 12, 1, 0, 'PS12', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '1-4w.gif', 1, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 11:53:36', 0, '0000-00-00 00:00:00', 0),
(0, 13, 1, 0, 'PS13', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '1-2m.gif', 1, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 11:53:59', 0, '0000-00-00 00:00:00', 0),
(0, 14, 1, 0, 'PS14', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-4w.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 11:54:59', 0, '0000-00-00 00:00:00', 0),
(0, 15, 1, 0, 'PS15', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '14d.gif', 0, 9, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 11:58:40', 0, '0000-00-00 00:00:00', 0),
(0, 16, 1, 0, 'PS16', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '14d.gif', 1, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 11:56:21', 0, '0000-00-00 00:00:00', 0),
(0, 17, 1, 0, 'PS17', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-2m.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 11:56:47', 0, '0000-00-00 00:00:00', 0),
(0, 18, 1, 0, 'PS18', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '1-4w.gif', 0, 9, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 11:57:20', 0, '0000-00-00 00:00:00', 0),
(0, 19, 1, 0, 'PS19', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-2m.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 11:57:43', 0, '0000-00-00 00:00:00', 0),
(0, 20, 1, 0, 'PS20', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '1-4w.gif', 0, 8, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 11:58:09', 0, '0000-00-00 00:00:00', 0),
(0, 21, 1, 0, 'PS21', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 0, 0, 0, '2012-01-10 00:00:00', '', 0, 0, '', '1.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '0', 1, '2012-01-10 15:35:06', 0, '2012-01-10 15:35:06', 0, '0000-00-00 00:00:00', 0),
(0, 22, 1, 0, 'PS22', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '1-2m.gif', 0, 8, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 11:59:33', 0, '0000-00-00 00:00:00', 0),
(0, 23, 1, 0, 'PS23', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-4w.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 11:59:57', 0, '0000-00-00 00:00:00', 0),
(0, 24, 1, 0, 'PS24', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '1-2m.gif', 0, 8, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:00:31', 0, '0000-00-00 00:00:00', 0),
(0, 25, 1, 0, 'PS25', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-4w.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:00:54', 0, '0000-00-00 00:00:00', 0),
(0, 26, 1, 0, 'PS26', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '14d.gif', 0, 7, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:01:34', 0, '0000-00-00 00:00:00', 0),
(0, 27, 1, 0, 'PS27', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-2m.gif', 0, 0, 'KG', '0.0000', 'min_order_level=""|max_order_level=""|step_order_level=""|product_box=""|', 0, '', '', '', '0', 1, '2012-01-11 10:49:44', 0, '2014-04-29 13:40:48', 42, '0000-00-00 00:00:00', 0),
(0, 28, 1, 0, 'PS28', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-4w.gif', 0, 6, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:18:08', 0, '0000-00-00 00:00:00', 0),
(0, 29, 1, 0, 'PS29', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-2m.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:18:21', 0, '0000-00-00 00:00:00', 0),
(0, 30, 1, 0, 'PS30', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '1-4w.gif', 0, 5, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:18:34', 0, '0000-00-00 00:00:00', 0),
(0, 31, 1, 0, 'PS31', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '14d.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:18:47', 0, '0000-00-00 00:00:00', 0),
(0, 32, 1, 0, 'PS32', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '1-2m.gif', 0, 4, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:04:56', 0, '0000-00-00 00:00:00', 0),
(0, 33, 1, 0, 'PS33', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-4w.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:05:25', 0, '0000-00-00 00:00:00', 0),
(0, 34, 1, 0, 'PS34', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-2m.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:05:59', 0, '0000-00-00 00:00:00', 0),
(0, 35, 1, 0, 'PS35', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '1-4w.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:06:27', 0, '0000-00-00 00:00:00', 0),
(0, 36, 1, 0, 'PS36', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '14d.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:06:50', 0, '0000-00-00 00:00:00', 0),
(0, 37, 1, 0, 'PS37', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '14d.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:08:00', 0, '0000-00-00 00:00:00', 0),
(0, 38, 1, 0, 'PS38', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '1-2m.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:10:46', 0, '0000-00-00 00:00:00', 0),
(0, 39, 1, 0, 'PS39', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-4w.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:11:10', 0, '0000-00-00 00:00:00', 0),
(0, 40, 1, 0, 'PS40', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-2m.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:11:38', 0, '0000-00-00 00:00:00', 0),
(0, 41, 1, 0, 'PS41', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '14d.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:18:47', 0, '0000-00-00 00:00:00', 0),
(0, 42, 1, 0, 'PS42', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '1-2m.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:04:56', 0, '0000-00-00 00:00:00', 0),
(0, 43, 1, 0, 'PS43', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-4w.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:05:25', 0, '0000-00-00 00:00:00', 0),
(0, 44, 1, 0, 'PS44', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-2m.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:05:59', 0, '0000-00-00 00:00:00', 0),
(0, 45, 1, 0, 'PS45', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '1-4w.gif', 0, 0, 'KG', '0.0000', 'min_order_level=""|max_order_level=""|step_order_level=""|product_box=""|', 0, '', '', '', '0', 1, '2012-01-11 10:49:44', 0, '2014-03-13 13:48:26', 42, '0000-00-00 00:00:00', 0),
(0, 46, 1, 0, 'PS46', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '14d.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:06:50', 0, '0000-00-00 00:00:00', 0),
(0, 47, 1, 0, 'PS47', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '14d.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:08:00', 0, '0000-00-00 00:00:00', 0),
(0, 48, 1, 0, 'PS48', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '1-2m.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:10:46', 0, '0000-00-00 00:00:00', 0),
(0, 49, 1, 0, 'PS49', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-4w.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:11:10', 0, '0000-00-00 00:00:00', 0),
(0, 50, 1, 0, 'PS50', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-2m.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:11:38', 0, '0000-00-00 00:00:00', 0),
(0, 51, 1, 0, 'PS51', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '14d.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:18:47', 0, '0000-00-00 00:00:00', 0),
(0, 52, 1, 0, 'PS52', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '1-2m.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:04:56', 0, '0000-00-00 00:00:00', 0),
(0, 53, 1, 0, 'PS53', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-4w.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:05:25', 0, '0000-00-00 00:00:00', 0),
(0, 54, 1, 0, 'PS54', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-2m.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:05:59', 0, '0000-00-00 00:00:00', 0),
(0, 55, 1, 0, 'PS55', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '1-4w.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:06:27', 0, '0000-00-00 00:00:00', 0),
(0, 56, 1, 0, 'PS56', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '14d.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:06:50', 0, '0000-00-00 00:00:00', 0),
(0, 57, 1, 0, 'PS57', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '14d.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:08:00', 0, '0000-00-00 00:00:00', 0),
(0, 58, 1, 0, 'PS58', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '1-2m.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:10:46', 0, '0000-00-00 00:00:00', 0),
(0, 59, 1, 0, 'PS59', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-4w.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:11:10', 0, '0000-00-00 00:00:00', 0),
(0, 60, 1, 0, 'PS60', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-2m.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:11:38', 0, '0000-00-00 00:00:00', 0),
(0, 61, 1, 0, 'PS61', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '14d.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:18:47', 0, '0000-00-00 00:00:00', 0),
(0, 62, 1, 0, 'PS62', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '1-2m.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:04:56', 0, '0000-00-00 00:00:00', 0),
(0, 63, 1, 0, 'PS63', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-4w.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:05:25', 0, '0000-00-00 00:00:00', 0),
(0, 64, 1, 0, 'PS64', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-2m.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:05:59', 0, '0000-00-00 00:00:00', 0),
(0, 65, 1, 0, 'PS65', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '1-4w.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:06:27', 0, '0000-00-00 00:00:00', 0),
(0, 66, 1, 0, 'PS66', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '14d.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:06:50', 0, '0000-00-00 00:00:00', 0),
(0, 67, 1, 0, 'PS67', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '14d.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:08:00', 0, '0000-00-00 00:00:00', 0),
(0, 68, 1, 0, 'PS68', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '1-2m.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:10:46', 0, '0000-00-00 00:00:00', 0),
(0, 69, 1, 0, 'PS69', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-4w.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-01-11 10:49:44', 0, '2012-01-11 12:11:10', 0, '0000-00-00 00:00:00', 0),
(0, 70, 1, 0, 'PS70', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-2m.gif', 0, 0, 'KG', '0.0000', 'min_order_level=""|max_order_level=""|step_order_level=""|product_box=""|', 0, '', '', '', '0', 1, '2012-01-11 10:49:44', 0, '2014-04-29 13:40:51', 42, '0000-00-00 00:00:00', 0),
(0, 71, 1, 0, 'PS71', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '14d.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-04-11 10:49:44', 0, '2012-04-11 12:18:47', 0, '0000-00-00 00:00:00', 0),
(0, 72, 1, 0, 'PS72', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '1-2m.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-05-11 10:49:44', 0, '2012-05-11 12:04:56', 0, '0000-00-00 00:00:00', 0),
(0, 73, 1, 0, 'PS73', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-4w.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-05-11 10:49:44', 0, '2012-05-11 12:05:25', 0, '0000-00-00 00:00:00', 0),
(0, 74, 1, 0, 'PS74', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-2m.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-05-11 10:49:44', 0, '2012-05-11 12:05:59', 0, '0000-00-00 00:00:00', 0),
(0, 75, 1, 0, 'PS75', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '1-4w.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-05-11 10:49:44', 0, '2012-05-11 12:06:27', 0, '0000-00-00 00:00:00', 0),
(0, 76, 1, 0, 'PS76', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '14d.gif', 0, 0, '', '0.0000', 'min_order_level=""|max_order_level=""|product_box=""|', 0, '', '', '', '', 1, '2012-05-11 10:49:44', 0, '2012-05-11 12:06:50', 0, '0000-00-00 00:00:00', 0),
(0, 77, 1, 0, 'PS77', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '14d.gif', 0, 0, 'KG', '0.0000', 'min_order_level=""|max_order_level=""|step_order_level=""|product_box=""|', 0, '', '', '', '0', 1, '2012-05-11 10:49:44', 0, '2014-06-25 11:27:13', 42, '0000-00-00 00:00:00', 0),
(0, 78, 1, 0, 'PS78', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 5, '2012-01-11 00:00:00', '1-2m.gif', 0, 0, 'KG', '0.0000', 'min_order_level=""|max_order_level=""|step_order_level=""|product_box=""|', 0, '', '', '', '0', 1, '2012-05-11 10:49:44', 0, '2014-06-25 11:26:35', 42, '0000-00-00 00:00:00', 0),
(0, 79, 1, 0, 'PS79', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-4w.gif', 0, 0, 'KG', '0.0000', 'min_order_level=""|max_order_level=""|step_order_level=""|product_box=""|', 0, '', '', '', '0', 1, '2012-05-11 10:49:44', 0, '2014-06-25 11:26:09', 42, '0000-00-00 00:00:00', 0),
(0, 80, 1, 0, 'PS80', '10.0000', 'KG', '10.0000', '0.0000', '0.0000', 'M', '', 20, 0, 1, '2012-01-11 00:00:00', '1-2m.gif', 0, 0, 'KG', '0.0000', 'min_order_level=""|max_order_level=""|step_order_level=""|product_box=""|', 0, '', '', '', '0', 1, '2012-05-11 10:49:44', 0, '2014-06-25 11:26:19', 42, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_products_en_gb`
--

DROP TABLE IF EXISTS `jos_virtuemart_products_en_gb`;
CREATE TABLE `jos_virtuemart_products_en_gb` (
  `virtuemart_product_id` int(1) unsigned NOT NULL,
  `product_s_desc` varchar(2000) NOT NULL DEFAULT '',
  `product_desc` varchar(18400) NOT NULL DEFAULT '',
  `product_name` char(180) NOT NULL DEFAULT '',
  `metadesc` varchar(400) NOT NULL DEFAULT '',
  `metakey` varchar(400) NOT NULL DEFAULT '',
  `customtitle` char(255) NOT NULL DEFAULT '',
  `slug` char(192) NOT NULL DEFAULT '',
  PRIMARY KEY (`virtuemart_product_id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_virtuemart_products_en_gb`
--

INSERT INTO `jos_virtuemart_products_en_gb` (`virtuemart_product_id`, `product_s_desc`, `product_desc`, `product_name`, `metadesc`, `metakey`, `customtitle`, `slug`) VALUES
(1, '<p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed.</p>', '<div class="text"><p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed. Fusce id neque eu tellus luctus adipiscing. Integer rhoncus ante non dui blandit dapibus. Proin lobortis eleifend elit, at lacinia libero suscipit sed.</p><p> Aliquam fringilla euismod risus ac bibendum. Sed sit amet sem varius ante feugiat lacinia. Nunc ipsum nulla, vulputate ut venenatis vitae, malesuada ut mi. Quisque iaculis, dui congue placerat pretium, augue erat accumsan lacus, eget euismod mi purus et magna. Integer molestie velit quis justo sodales pharetra.</p></div>', 'Lum mleie kertase miase lacnean', '', '', '', 'product-1'),
(2, '<p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo.</p>', '<div class="text"><p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo. Integer viverra, nibh eget pharetra lacinia, augue nunc mollis tortor, sit amet pulvinar ligula arcu eu ante. Etiam nunc enim, molestie ac dictum at, consectetur quis elit. Quisque quis eros consectetur sapien auctor pulvinar. </p><p>Etiam rhoncus leo vitae purus laoreet viverra. Ut mi erat, consectetur in scelerisque vitae, sollicitudin eu augue. Vivamus molestie ornare neque a placerat. Etiam tellus arcu, tincidunt in rhoncus quis, vestibulum vitae ipsum. Suspendisse sit amet nisl leo, et viverra ante. Sed mi lorem, cursus sit amet pellentesque laoreet, rutrum eget leo. Cras at quam ut velit elementum tincidunt et id nulla. Vivamus malesuada felis eu mauris auctor venenatis.</p></div>', 'Lorem ipsum dolor sit amet, consect etuer', '', '', '', 'product-2'),
(3, '<p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere.</p>', '<div class="text"><p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere. Proin viverra, urna nec auctor pulvinar, turpis dui sagittis nulla, non commodo lacus est vitae nunc. Quisque ullamcorper sapien quis ipsum eleifend pharetra. Proin hendrerit nisl quis nulla aliquet a iaculis justo venenatis.</p><p> Integer congue lacus vitae diam accumsan at semper lacus feugiat. Nunc sodales viverra tortor, non suscipit erat ornare eget. Aliquam nunc mi, faucibus et aliquam eu, mollis ac mi. Maecenas turpis purus, varius id sagittis eu, venenatis quis arcu. Curabitur rhoncus dignissim lorem, in placerat sem aliquam in. Vestibulum quis metus non nunc aliquet fermentum non et sapien.</p></div>', 'Ut us dolor apibusgetele mentumvel', '', '', '', 'product-3'),
(4, '<p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan.</p>', '<div class="text"><p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan. Sed dapibus dictum massa, id bibendum neque luctus eget. Proin hendrerit interdum viverra. Suspendisse orci mi, vehicula ac dapibus vestibulum, varius suscipit lacus. In non mauris dui.</p><p> Integer nisi mauris, vulputate et suscipit id, varius pretium nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pellentesque tristique sollicitudin. Donec lacinia dui turpis, a pulvinar ligula. Praesent sapien erat, posuere a blandit vitae, interdum eu neque. Ut commodo massa quis nibh accumsan commodo ullamcorper id velit.</p> </div>', 'Lorem ipsum dolor sit amet conse ctetur adipisicing', '', '', '', 'product-4'),
(5, '<p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed.</p>', '<div class="text"><p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed. Fusce id neque eu tellus luctus adipiscing. Integer rhoncus ante non dui blandit dapibus. Proin lobortis eleifend elit, at lacinia libero suscipit sed.</p><p> Aliquam fringilla euismod risus ac bibendum. Sed sit amet sem varius ante feugiat lacinia. Nunc ipsum nulla, vulputate ut venenatis vitae, malesuada ut mi. Quisque iaculis, dui congue placerat pretium, augue erat accumsan lacus, eget euismod mi purus et magna. Integer molestie velit quis justo sodales pharetra.</p></div>', 'Ipsum dolor sit amet conse ctetur', '', '', '', 'product-5'),
(6, '<p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo.</p>', '<div class="text"><p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo. Integer viverra, nibh eget pharetra lacinia, augue nunc mollis tortor, sit amet pulvinar ligula arcu eu ante. Etiam nunc enim, molestie ac dictum at, consectetur quis elit. Quisque quis eros consectetur sapien auctor pulvinar. </p><p>Etiam rhoncus leo vitae purus laoreet viverra. Ut mi erat, consectetur in scelerisque vitae, sollicitudin eu augue. Vivamus molestie ornare neque a placerat. Etiam tellus arcu, tincidunt in rhoncus quis, vestibulum vitae ipsum. Suspendisse sit amet nisl leo, et viverra ante. Sed mi lorem, cursus sit amet pellentesque laoreet, rutrum eget leo. Cras at quam ut velit elementum tincidunt et id nulla. Vivamus malesuada felis eu mauris auctor venenatis.</p></div>', 'Dolor sit amet', '', '', '', 'product-6'),
(7, '<p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere.</p>', '<div class="text"><p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere. Proin viverra, urna nec auctor pulvinar, turpis dui sagittis nulla, non commodo lacus est vitae nunc. Quisque ullamcorper sapien quis ipsum eleifend pharetra. Proin hendrerit nisl quis nulla aliquet a iaculis justo venenatis.</p><p> Integer congue lacus vitae diam accumsan at semper lacus feugiat. Nunc sodales viverra tortor, non suscipit erat ornare eget. Aliquam nunc mi, faucibus et aliquam eu, mollis ac mi. Maecenas turpis purus, varius id sagittis eu, venenatis quis arcu. Curabitur rhoncus dignissim lorem, in placerat sem aliquam in. Vestibulum quis metus non nunc aliquet fermentum non et sapien.</p></div>', 'Lorem ipsum dolor sit amet', '', '', '', 'product-7'),
(8, '<p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan.</p>', '<div class="text"><p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan. Sed dapibus dictum massa, id bibendum neque luctus eget. Proin hendrerit interdum viverra. Suspendisse orci mi, vehicula ac dapibus vestibulum, varius suscipit lacus. In non mauris dui.</p><p> Integer nisi mauris, vulputate et suscipit id, varius pretium nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pellentesque tristique sollicitudin. Donec lacinia dui turpis, a pulvinar ligula. Praesent sapien erat, posuere a blandit vitae, interdum eu neque. Ut commodo massa quis nibh accumsan commodo ullamcorper id velit.</p> </div>', 'Ipsum dolor sit amet conse ctetur', '', '', '', 'product-8'),
(9, '<p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed.</p>', '<div class="text"><p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed. Fusce id neque eu tellus luctus adipiscing. Integer rhoncus ante non dui blandit dapibus. Proin lobortis eleifend elit, at lacinia libero suscipit sed.</p><p> Aliquam fringilla euismod risus ac bibendum. Sed sit amet sem varius ante feugiat lacinia. Nunc ipsum nulla, vulputate ut venenatis vitae, malesuada ut mi. Quisque iaculis, dui congue placerat pretium, augue erat accumsan lacus, eget euismod mi purus et magna. Integer molestie velit quis justo sodales pharetra.</p></div>', 'Lorem ipsum dolor sit amet conse', '', '', '', 'product-9'),
(10, '<p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo.</p>', '<div class="text"><p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo. Integer viverra, nibh eget pharetra lacinia, augue nunc mollis tortor, sit amet pulvinar ligula arcu eu ante. Etiam nunc enim, molestie ac dictum at, consectetur quis elit. Quisque quis eros consectetur sapien auctor pulvinar. </p><p>Etiam rhoncus leo vitae purus laoreet viverra. Ut mi erat, consectetur in scelerisque vitae, sollicitudin eu augue. Vivamus molestie ornare neque a placerat. Etiam tellus arcu, tincidunt in rhoncus quis, vestibulum vitae ipsum. Suspendisse sit amet nisl leo, et viverra ante. Sed mi lorem, cursus sit amet pellentesque laoreet, rutrum eget leo. Cras at quam ut velit elementum tincidunt et id nulla. Vivamus malesuada felis eu mauris auctor venenatis.</p></div>', 'Lorem ipsum dolor sit amet, consect etuer', '', '', '', 'product-10'),
(11, '<p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed.</p>', '<div class="text"><p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed. Fusce id neque eu tellus luctus adipiscing. Integer rhoncus ante non dui blandit dapibus. Proin lobortis eleifend elit, at lacinia libero suscipit sed.</p><p> Aliquam fringilla euismod risus ac bibendum. Sed sit amet sem varius ante feugiat lacinia. Nunc ipsum nulla, vulputate ut venenatis vitae, malesuada ut mi. Quisque iaculis, dui congue placerat pretium, augue erat accumsan lacus, eget euismod mi purus et magna. Integer molestie velit quis justo sodales pharetra.</p></div>', 'Lum mleie kertase miase lacnean', '', '', '', 'product-11'),
(12, '<p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo.</p>', '<div class="text"><p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo. Integer viverra, nibh eget pharetra lacinia, augue nunc mollis tortor, sit amet pulvinar ligula arcu eu ante. Etiam nunc enim, molestie ac dictum at, consectetur quis elit. Quisque quis eros consectetur sapien auctor pulvinar. </p><p>Etiam rhoncus leo vitae purus laoreet viverra. Ut mi erat, consectetur in scelerisque vitae, sollicitudin eu augue. Vivamus molestie ornare neque a placerat. Etiam tellus arcu, tincidunt in rhoncus quis, vestibulum vitae ipsum. Suspendisse sit amet nisl leo, et viverra ante. Sed mi lorem, cursus sit amet pellentesque laoreet, rutrum eget leo. Cras at quam ut velit elementum tincidunt et id nulla. Vivamus malesuada felis eu mauris auctor venenatis.</p></div>', 'Lorem ipsum dolor sit amet, consect etuer', '', '', '', 'product-12'),
(13, '<p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere.</p>', '<div class="text"><p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere. Proin viverra, urna nec auctor pulvinar, turpis dui sagittis nulla, non commodo lacus est vitae nunc. Quisque ullamcorper sapien quis ipsum eleifend pharetra. Proin hendrerit nisl quis nulla aliquet a iaculis justo venenatis.</p><p> Integer congue lacus vitae diam accumsan at semper lacus feugiat. Nunc sodales viverra tortor, non suscipit erat ornare eget. Aliquam nunc mi, faucibus et aliquam eu, mollis ac mi. Maecenas turpis purus, varius id sagittis eu, venenatis quis arcu. Curabitur rhoncus dignissim lorem, in placerat sem aliquam in. Vestibulum quis metus non nunc aliquet fermentum non et sapien.</p></div>', 'Ut us dolor apibusgetele mentumvel', '', '', '', 'product-13'),
(14, '<p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan.</p>', '<div class="text"><p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan. Sed dapibus dictum massa, id bibendum neque luctus eget. Proin hendrerit interdum viverra. Suspendisse orci mi, vehicula ac dapibus vestibulum, varius suscipit lacus. In non mauris dui.</p><p> Integer nisi mauris, vulputate et suscipit id, varius pretium nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pellentesque tristique sollicitudin. Donec lacinia dui turpis, a pulvinar ligula. Praesent sapien erat, posuere a blandit vitae, interdum eu neque. Ut commodo massa quis nibh accumsan commodo ullamcorper id velit.</p> </div>', 'Lorem ipsum dolor sit amet conse ctetur adipisicing', '', '', '', 'product-14'),
(15, '<p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed.</p>', '<div class="text"><p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed. Fusce id neque eu tellus luctus adipiscing. Integer rhoncus ante non dui blandit dapibus. Proin lobortis eleifend elit, at lacinia libero suscipit sed.</p><p> Aliquam fringilla euismod risus ac bibendum. Sed sit amet sem varius ante feugiat lacinia. Nunc ipsum nulla, vulputate ut venenatis vitae, malesuada ut mi. Quisque iaculis, dui congue placerat pretium, augue erat accumsan lacus, eget euismod mi purus et magna. Integer molestie velit quis justo sodales pharetra.</p></div>', 'Ipsum dolor sit amet conse ctetur', '', '', '', 'product-15'),
(16, '<p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo.</p>', '<div class="text"><p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo. Integer viverra, nibh eget pharetra lacinia, augue nunc mollis tortor, sit amet pulvinar ligula arcu eu ante. Etiam nunc enim, molestie ac dictum at, consectetur quis elit. Quisque quis eros consectetur sapien auctor pulvinar. </p><p>Etiam rhoncus leo vitae purus laoreet viverra. Ut mi erat, consectetur in scelerisque vitae, sollicitudin eu augue. Vivamus molestie ornare neque a placerat. Etiam tellus arcu, tincidunt in rhoncus quis, vestibulum vitae ipsum. Suspendisse sit amet nisl leo, et viverra ante. Sed mi lorem, cursus sit amet pellentesque laoreet, rutrum eget leo. Cras at quam ut velit elementum tincidunt et id nulla. Vivamus malesuada felis eu mauris auctor venenatis.</p></div>', 'Dolor sit amet', '', '', '', 'product-16'),
(17, '<p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere.</p>', '<div class="text"><p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere. Proin viverra, urna nec auctor pulvinar, turpis dui sagittis nulla, non commodo lacus est vitae nunc. Quisque ullamcorper sapien quis ipsum eleifend pharetra. Proin hendrerit nisl quis nulla aliquet a iaculis justo venenatis.</p><p> Integer congue lacus vitae diam accumsan at semper lacus feugiat. Nunc sodales viverra tortor, non suscipit erat ornare eget. Aliquam nunc mi, faucibus et aliquam eu, mollis ac mi. Maecenas turpis purus, varius id sagittis eu, venenatis quis arcu. Curabitur rhoncus dignissim lorem, in placerat sem aliquam in. Vestibulum quis metus non nunc aliquet fermentum non et sapien.</p></div>', 'Lorem ipsum dolor sit amet', '', '', '', 'product-17'),
(18, '<p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan.</p>', '<div class="text"><p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan. Sed dapibus dictum massa, id bibendum neque luctus eget. Proin hendrerit interdum viverra. Suspendisse orci mi, vehicula ac dapibus vestibulum, varius suscipit lacus. In non mauris dui.</p><p> Integer nisi mauris, vulputate et suscipit id, varius pretium nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pellentesque tristique sollicitudin. Donec lacinia dui turpis, a pulvinar ligula. Praesent sapien erat, posuere a blandit vitae, interdum eu neque. Ut commodo massa quis nibh accumsan commodo ullamcorper id velit.</p> </div>', 'Ipsum dolor sit amet conse ctetur', '', '', '', 'product-18'),
(19, '<p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed.</p>', '<div class="text"><p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed. Fusce id neque eu tellus luctus adipiscing. Integer rhoncus ante non dui blandit dapibus. Proin lobortis eleifend elit, at lacinia libero suscipit sed.</p><p> Aliquam fringilla euismod risus ac bibendum. Sed sit amet sem varius ante feugiat lacinia. Nunc ipsum nulla, vulputate ut venenatis vitae, malesuada ut mi. Quisque iaculis, dui congue placerat pretium, augue erat accumsan lacus, eget euismod mi purus et magna. Integer molestie velit quis justo sodales pharetra.</p></div>', 'Lorem ipsum dolor sit amet conse', '', '', '', 'product-19'),
(20, '<p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo.</p>', '<div class="text"><p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo. Integer viverra, nibh eget pharetra lacinia, augue nunc mollis tortor, sit amet pulvinar ligula arcu eu ante. Etiam nunc enim, molestie ac dictum at, consectetur quis elit. Quisque quis eros consectetur sapien auctor pulvinar. </p><p>Etiam rhoncus leo vitae purus laoreet viverra. Ut mi erat, consectetur in scelerisque vitae, sollicitudin eu augue. Vivamus molestie ornare neque a placerat. Etiam tellus arcu, tincidunt in rhoncus quis, vestibulum vitae ipsum. Suspendisse sit amet nisl leo, et viverra ante. Sed mi lorem, cursus sit amet pellentesque laoreet, rutrum eget leo. Cras at quam ut velit elementum tincidunt et id nulla. Vivamus malesuada felis eu mauris auctor venenatis.</p></div>', 'Lorem ipsum dolor sit amet, consect etuer', '', '', '', 'product-20'),
(21, '<p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed.</p>', '<div class="text"><p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed. Fusce id neque eu tellus luctus adipiscing. Integer rhoncus ante non dui blandit dapibus. Proin lobortis eleifend elit, at lacinia libero suscipit sed.</p><p> Aliquam fringilla euismod risus ac bibendum. Sed sit amet sem varius ante feugiat lacinia. Nunc ipsum nulla, vulputate ut venenatis vitae, malesuada ut mi. Quisque iaculis, dui congue placerat pretium, augue erat accumsan lacus, eget euismod mi purus et magna. Integer molestie velit quis justo sodales pharetra.</p></div>', 'Lum mleie kertase miase lacnean', '', '', '', 'product-21'),
(22, '<p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo.</p>', '<div class="text"><p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo. Integer viverra, nibh eget pharetra lacinia, augue nunc mollis tortor, sit amet pulvinar ligula arcu eu ante. Etiam nunc enim, molestie ac dictum at, consectetur quis elit. Quisque quis eros consectetur sapien auctor pulvinar. </p><p>Etiam rhoncus leo vitae purus laoreet viverra. Ut mi erat, consectetur in scelerisque vitae, sollicitudin eu augue. Vivamus molestie ornare neque a placerat. Etiam tellus arcu, tincidunt in rhoncus quis, vestibulum vitae ipsum. Suspendisse sit amet nisl leo, et viverra ante. Sed mi lorem, cursus sit amet pellentesque laoreet, rutrum eget leo. Cras at quam ut velit elementum tincidunt et id nulla. Vivamus malesuada felis eu mauris auctor venenatis.</p></div>', 'Lorem ipsum dolor sit amet, consect etuer', '', '', '', 'product-22'),
(23, '<p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere.</p>', '<div class="text"><p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere. Proin viverra, urna nec auctor pulvinar, turpis dui sagittis nulla, non commodo lacus est vitae nunc. Quisque ullamcorper sapien quis ipsum eleifend pharetra. Proin hendrerit nisl quis nulla aliquet a iaculis justo venenatis.</p><p> Integer congue lacus vitae diam accumsan at semper lacus feugiat. Nunc sodales viverra tortor, non suscipit erat ornare eget. Aliquam nunc mi, faucibus et aliquam eu, mollis ac mi. Maecenas turpis purus, varius id sagittis eu, venenatis quis arcu. Curabitur rhoncus dignissim lorem, in placerat sem aliquam in. Vestibulum quis metus non nunc aliquet fermentum non et sapien.</p></div>', 'Ut us dolor apibusgetele mentumvel', '', '', '', 'product-23'),
(24, '<p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan.</p>', '<div class="text"><p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan. Sed dapibus dictum massa, id bibendum neque luctus eget. Proin hendrerit interdum viverra. Suspendisse orci mi, vehicula ac dapibus vestibulum, varius suscipit lacus. In non mauris dui.</p><p> Integer nisi mauris, vulputate et suscipit id, varius pretium nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pellentesque tristique sollicitudin. Donec lacinia dui turpis, a pulvinar ligula. Praesent sapien erat, posuere a blandit vitae, interdum eu neque. Ut commodo massa quis nibh accumsan commodo ullamcorper id velit.</p> </div>', 'Lorem ipsum dolor sit amet conse ctetur adipisicing', '', '', '', 'product-24'),
(25, '<p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed.</p>', '<div class="text"><p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed. Fusce id neque eu tellus luctus adipiscing. Integer rhoncus ante non dui blandit dapibus. Proin lobortis eleifend elit, at lacinia libero suscipit sed.</p><p> Aliquam fringilla euismod risus ac bibendum. Sed sit amet sem varius ante feugiat lacinia. Nunc ipsum nulla, vulputate ut venenatis vitae, malesuada ut mi. Quisque iaculis, dui congue placerat pretium, augue erat accumsan lacus, eget euismod mi purus et magna. Integer molestie velit quis justo sodales pharetra.</p></div>', 'Ipsum dolor sit amet conse ctetur', '', '', '', 'product-25'),
(26, '<p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo.</p>', '<div class="text"><p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo. Integer viverra, nibh eget pharetra lacinia, augue nunc mollis tortor, sit amet pulvinar ligula arcu eu ante. Etiam nunc enim, molestie ac dictum at, consectetur quis elit. Quisque quis eros consectetur sapien auctor pulvinar. </p><p>Etiam rhoncus leo vitae purus laoreet viverra. Ut mi erat, consectetur in scelerisque vitae, sollicitudin eu augue. Vivamus molestie ornare neque a placerat. Etiam tellus arcu, tincidunt in rhoncus quis, vestibulum vitae ipsum. Suspendisse sit amet nisl leo, et viverra ante. Sed mi lorem, cursus sit amet pellentesque laoreet, rutrum eget leo. Cras at quam ut velit elementum tincidunt et id nulla. Vivamus malesuada felis eu mauris auctor venenatis.</p></div>', 'Dolor sit amet', '', '', '', 'product-26'),
(27, '<p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere.</p>', '<div class="text"><p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere. Proin viverra, urna nec auctor pulvinar, turpis dui sagittis nulla, non commodo lacus est vitae nunc. Quisque ullamcorper sapien quis ipsum eleifend pharetra. Proin hendrerit nisl quis nulla aliquet a iaculis justo venenatis.</p><p> Integer congue lacus vitae diam accumsan at semper lacus feugiat. Nunc sodales viverra tortor, non suscipit erat ornare eget. Aliquam nunc mi, faucibus et aliquam eu, mollis ac mi. Maecenas turpis purus, varius id sagittis eu, venenatis quis arcu. Curabitur rhoncus dignissim lorem, in placerat sem aliquam in. Vestibulum quis metus non nunc aliquet fermentum non et sapien.</p></div>', 'Lorem ipsum dolor sit amet', '', '', '', 'product-27'),
(28, '<p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan.</p>', '<div class="text"><p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan. Sed dapibus dictum massa, id bibendum neque luctus eget. Proin hendrerit interdum viverra. Suspendisse orci mi, vehicula ac dapibus vestibulum, varius suscipit lacus. In non mauris dui.</p><p> Integer nisi mauris, vulputate et suscipit id, varius pretium nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pellentesque tristique sollicitudin. Donec lacinia dui turpis, a pulvinar ligula. Praesent sapien erat, posuere a blandit vitae, interdum eu neque. Ut commodo massa quis nibh accumsan commodo ullamcorper id velit.</p> </div>', 'Ipsum dolor sit amet conse ctetur', '', '', '', 'product-28'),
(29, '<p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed.</p>', '<div class="text"><p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed. Fusce id neque eu tellus luctus adipiscing. Integer rhoncus ante non dui blandit dapibus. Proin lobortis eleifend elit, at lacinia libero suscipit sed.</p><p> Aliquam fringilla euismod risus ac bibendum. Sed sit amet sem varius ante feugiat lacinia. Nunc ipsum nulla, vulputate ut venenatis vitae, malesuada ut mi. Quisque iaculis, dui congue placerat pretium, augue erat accumsan lacus, eget euismod mi purus et magna. Integer molestie velit quis justo sodales pharetra.</p></div>', 'Lorem ipsum dolor sit amet conse', '', '', '', 'product-29'),
(30, '<p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo.</p>', '<div class="text"><p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo. Integer viverra, nibh eget pharetra lacinia, augue nunc mollis tortor, sit amet pulvinar ligula arcu eu ante. Etiam nunc enim, molestie ac dictum at, consectetur quis elit. Quisque quis eros consectetur sapien auctor pulvinar. </p><p>Etiam rhoncus leo vitae purus laoreet viverra. Ut mi erat, consectetur in scelerisque vitae, sollicitudin eu augue. Vivamus molestie ornare neque a placerat. Etiam tellus arcu, tincidunt in rhoncus quis, vestibulum vitae ipsum. Suspendisse sit amet nisl leo, et viverra ante. Sed mi lorem, cursus sit amet pellentesque laoreet, rutrum eget leo. Cras at quam ut velit elementum tincidunt et id nulla. Vivamus malesuada felis eu mauris auctor venenatis.</p></div>', 'Lorem ipsum dolor sit amet, consect etuer', '', '', '', 'product-30'),
(31, '<p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed.</p>', '<div class="text"><p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed. Fusce id neque eu tellus luctus adipiscing. Integer rhoncus ante non dui blandit dapibus. Proin lobortis eleifend elit, at lacinia libero suscipit sed.</p><p> Aliquam fringilla euismod risus ac bibendum. Sed sit amet sem varius ante feugiat lacinia. Nunc ipsum nulla, vulputate ut venenatis vitae, malesuada ut mi. Quisque iaculis, dui congue placerat pretium, augue erat accumsan lacus, eget euismod mi purus et magna. Integer molestie velit quis justo sodales pharetra.</p></div>', 'Lum mleie kertase miase lacnean', '', '', '', 'product-31'),
(32, '<p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo.</p>', '<div class="text"><p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo. Integer viverra, nibh eget pharetra lacinia, augue nunc mollis tortor, sit amet pulvinar ligula arcu eu ante. Etiam nunc enim, molestie ac dictum at, consectetur quis elit. Quisque quis eros consectetur sapien auctor pulvinar. </p><p>Etiam rhoncus leo vitae purus laoreet viverra. Ut mi erat, consectetur in scelerisque vitae, sollicitudin eu augue. Vivamus molestie ornare neque a placerat. Etiam tellus arcu, tincidunt in rhoncus quis, vestibulum vitae ipsum. Suspendisse sit amet nisl leo, et viverra ante. Sed mi lorem, cursus sit amet pellentesque laoreet, rutrum eget leo. Cras at quam ut velit elementum tincidunt et id nulla. Vivamus malesuada felis eu mauris auctor venenatis.</p></div>', 'Lorem ipsum dolor sit amet, consect etuer', '', '', '', 'product-32'),
(33, '<p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere.</p>', '<div class="text"><p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere. Proin viverra, urna nec auctor pulvinar, turpis dui sagittis nulla, non commodo lacus est vitae nunc. Quisque ullamcorper sapien quis ipsum eleifend pharetra. Proin hendrerit nisl quis nulla aliquet a iaculis justo venenatis.</p><p> Integer congue lacus vitae diam accumsan at semper lacus feugiat. Nunc sodales viverra tortor, non suscipit erat ornare eget. Aliquam nunc mi, faucibus et aliquam eu, mollis ac mi. Maecenas turpis purus, varius id sagittis eu, venenatis quis arcu. Curabitur rhoncus dignissim lorem, in placerat sem aliquam in. Vestibulum quis metus non nunc aliquet fermentum non et sapien.</p></div>', 'Ut us dolor apibusgetele mentumvel', '', '', '', 'product-33'),
(34, '<p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan.</p>', '<div class="text"><p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan. Sed dapibus dictum massa, id bibendum neque luctus eget. Proin hendrerit interdum viverra. Suspendisse orci mi, vehicula ac dapibus vestibulum, varius suscipit lacus. In non mauris dui.</p><p> Integer nisi mauris, vulputate et suscipit id, varius pretium nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pellentesque tristique sollicitudin. Donec lacinia dui turpis, a pulvinar ligula. Praesent sapien erat, posuere a blandit vitae, interdum eu neque. Ut commodo massa quis nibh accumsan commodo ullamcorper id velit.</p> </div>', 'Lorem ipsum dolor sit amet conse ctetur adipisicing', '', '', '', 'product-34'),
(35, '<p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed.</p>', '<div class="text"><p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed. Fusce id neque eu tellus luctus adipiscing. Integer rhoncus ante non dui blandit dapibus. Proin lobortis eleifend elit, at lacinia libero suscipit sed.</p><p> Aliquam fringilla euismod risus ac bibendum. Sed sit amet sem varius ante feugiat lacinia. Nunc ipsum nulla, vulputate ut venenatis vitae, malesuada ut mi. Quisque iaculis, dui congue placerat pretium, augue erat accumsan lacus, eget euismod mi purus et magna. Integer molestie velit quis justo sodales pharetra.</p></div>', 'Ipsum dolor sit amet conse ctetur', '', '', '', 'product-35'),
(36, '<p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo.</p>', '<div class="text"><p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo. Integer viverra, nibh eget pharetra lacinia, augue nunc mollis tortor, sit amet pulvinar ligula arcu eu ante. Etiam nunc enim, molestie ac dictum at, consectetur quis elit. Quisque quis eros consectetur sapien auctor pulvinar. </p><p>Etiam rhoncus leo vitae purus laoreet viverra. Ut mi erat, consectetur in scelerisque vitae, sollicitudin eu augue. Vivamus molestie ornare neque a placerat. Etiam tellus arcu, tincidunt in rhoncus quis, vestibulum vitae ipsum. Suspendisse sit amet nisl leo, et viverra ante. Sed mi lorem, cursus sit amet pellentesque laoreet, rutrum eget leo. Cras at quam ut velit elementum tincidunt et id nulla. Vivamus malesuada felis eu mauris auctor venenatis.</p></div>', 'Dolor sit amet', '', '', '', 'product-36'),
(37, '<p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere.</p>', '<div class="text"><p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere. Proin viverra, urna nec auctor pulvinar, turpis dui sagittis nulla, non commodo lacus est vitae nunc. Quisque ullamcorper sapien quis ipsum eleifend pharetra. Proin hendrerit nisl quis nulla aliquet a iaculis justo venenatis.</p><p> Integer congue lacus vitae diam accumsan at semper lacus feugiat. Nunc sodales viverra tortor, non suscipit erat ornare eget. Aliquam nunc mi, faucibus et aliquam eu, mollis ac mi. Maecenas turpis purus, varius id sagittis eu, venenatis quis arcu. Curabitur rhoncus dignissim lorem, in placerat sem aliquam in. Vestibulum quis metus non nunc aliquet fermentum non et sapien.</p></div>', 'Lorem ipsum dolor sit amet', '', '', '', 'product-37'),
(38, '<p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan.</p>', '<div class="text"><p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan. Sed dapibus dictum massa, id bibendum neque luctus eget. Proin hendrerit interdum viverra. Suspendisse orci mi, vehicula ac dapibus vestibulum, varius suscipit lacus. In non mauris dui.</p><p> Integer nisi mauris, vulputate et suscipit id, varius pretium nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pellentesque tristique sollicitudin. Donec lacinia dui turpis, a pulvinar ligula. Praesent sapien erat, posuere a blandit vitae, interdum eu neque. Ut commodo massa quis nibh accumsan commodo ullamcorper id velit.</p> </div>', 'Ipsum dolor sit amet conse ctetur', '', '', '', 'product-38'),
(39, '<p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed.</p>', '<div class="text"><p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed. Fusce id neque eu tellus luctus adipiscing. Integer rhoncus ante non dui blandit dapibus. Proin lobortis eleifend elit, at lacinia libero suscipit sed.</p><p> Aliquam fringilla euismod risus ac bibendum. Sed sit amet sem varius ante feugiat lacinia. Nunc ipsum nulla, vulputate ut venenatis vitae, malesuada ut mi. Quisque iaculis, dui congue placerat pretium, augue erat accumsan lacus, eget euismod mi purus et magna. Integer molestie velit quis justo sodales pharetra.</p></div>', 'Lorem ipsum dolor sit amet conse', '', '', '', 'product-39'),
(40, '<p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo.</p>', '<div class="text"><p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo. Integer viverra, nibh eget pharetra lacinia, augue nunc mollis tortor, sit amet pulvinar ligula arcu eu ante. Etiam nunc enim, molestie ac dictum at, consectetur quis elit. Quisque quis eros consectetur sapien auctor pulvinar. </p><p>Etiam rhoncus leo vitae purus laoreet viverra. Ut mi erat, consectetur in scelerisque vitae, sollicitudin eu augue. Vivamus molestie ornare neque a placerat. Etiam tellus arcu, tincidunt in rhoncus quis, vestibulum vitae ipsum. Suspendisse sit amet nisl leo, et viverra ante. Sed mi lorem, cursus sit amet pellentesque laoreet, rutrum eget leo. Cras at quam ut velit elementum tincidunt et id nulla. Vivamus malesuada felis eu mauris auctor venenatis.</p></div>', 'Lorem ipsum dolor sit amet, consect etuer', '', '', '', 'product-40'),
(41, '<p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed.</p>', '<div class="text"><p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed. Fusce id neque eu tellus luctus adipiscing. Integer rhoncus ante non dui blandit dapibus. Proin lobortis eleifend elit, at lacinia libero suscipit sed.</p><p> Aliquam fringilla euismod risus ac bibendum. Sed sit amet sem varius ante feugiat lacinia. Nunc ipsum nulla, vulputate ut venenatis vitae, malesuada ut mi. Quisque iaculis, dui congue placerat pretium, augue erat accumsan lacus, eget euismod mi purus et magna. Integer molestie velit quis justo sodales pharetra.</p></div>', 'Lum mleie kertase miase lacnean', '', '', '', 'product-41'),
(42, '<p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo.</p>', '<div class="text"><p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo. Integer viverra, nibh eget pharetra lacinia, augue nunc mollis tortor, sit amet pulvinar ligula arcu eu ante. Etiam nunc enim, molestie ac dictum at, consectetur quis elit. Quisque quis eros consectetur sapien auctor pulvinar. </p><p>Etiam rhoncus leo vitae purus laoreet viverra. Ut mi erat, consectetur in scelerisque vitae, sollicitudin eu augue. Vivamus molestie ornare neque a placerat. Etiam tellus arcu, tincidunt in rhoncus quis, vestibulum vitae ipsum. Suspendisse sit amet nisl leo, et viverra ante. Sed mi lorem, cursus sit amet pellentesque laoreet, rutrum eget leo. Cras at quam ut velit elementum tincidunt et id nulla. Vivamus malesuada felis eu mauris auctor venenatis.</p></div>', 'Lorem ipsum dolor sit amet, consect etuer', '', '', '', 'product-42'),
(43, '<p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere.</p>', '<div class="text"><p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere. Proin viverra, urna nec auctor pulvinar, turpis dui sagittis nulla, non commodo lacus est vitae nunc. Quisque ullamcorper sapien quis ipsum eleifend pharetra. Proin hendrerit nisl quis nulla aliquet a iaculis justo venenatis.</p><p> Integer congue lacus vitae diam accumsan at semper lacus feugiat. Nunc sodales viverra tortor, non suscipit erat ornare eget. Aliquam nunc mi, faucibus et aliquam eu, mollis ac mi. Maecenas turpis purus, varius id sagittis eu, venenatis quis arcu. Curabitur rhoncus dignissim lorem, in placerat sem aliquam in. Vestibulum quis metus non nunc aliquet fermentum non et sapien.</p></div>', 'Ut us dolor apibusgetele mentumvel', '', '', '', 'product-43'),
(44, '<p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan.</p>', '<div class="text"><p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan. Sed dapibus dictum massa, id bibendum neque luctus eget. Proin hendrerit interdum viverra. Suspendisse orci mi, vehicula ac dapibus vestibulum, varius suscipit lacus. In non mauris dui.</p><p> Integer nisi mauris, vulputate et suscipit id, varius pretium nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pellentesque tristique sollicitudin. Donec lacinia dui turpis, a pulvinar ligula. Praesent sapien erat, posuere a blandit vitae, interdum eu neque. Ut commodo massa quis nibh accumsan commodo ullamcorper id velit.</p> </div>', 'Lorem ipsum dolor sit amet conse ctetur adipisicing', '', '', '', 'product-44'),
(45, '<p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed.</p>', '<div class="text"><p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed. Fusce id neque eu tellus luctus adipiscing. Integer rhoncus ante non dui blandit dapibus. Proin lobortis eleifend elit, at lacinia libero suscipit sed.</p><p> Aliquam fringilla euismod risus ac bibendum. Sed sit amet sem varius ante feugiat lacinia. Nunc ipsum nulla, vulputate ut venenatis vitae, malesuada ut mi. Quisque iaculis, dui congue placerat pretium, augue erat accumsan lacus, eget euismod mi purus et magna. Integer molestie velit quis justo sodales pharetra.</p></div>', 'Ipsum dolor sit amet conse ctetur', '', '', '', 'product-45'),
(46, '<p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo.</p>', '<div class="text"><p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo. Integer viverra, nibh eget pharetra lacinia, augue nunc mollis tortor, sit amet pulvinar ligula arcu eu ante. Etiam nunc enim, molestie ac dictum at, consectetur quis elit. Quisque quis eros consectetur sapien auctor pulvinar. </p><p>Etiam rhoncus leo vitae purus laoreet viverra. Ut mi erat, consectetur in scelerisque vitae, sollicitudin eu augue. Vivamus molestie ornare neque a placerat. Etiam tellus arcu, tincidunt in rhoncus quis, vestibulum vitae ipsum. Suspendisse sit amet nisl leo, et viverra ante. Sed mi lorem, cursus sit amet pellentesque laoreet, rutrum eget leo. Cras at quam ut velit elementum tincidunt et id nulla. Vivamus malesuada felis eu mauris auctor venenatis.</p></div>', 'Dolor sit amet', '', '', '', 'product-46'),
(47, '<p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere.</p>', '<div class="text"><p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere. Proin viverra, urna nec auctor pulvinar, turpis dui sagittis nulla, non commodo lacus est vitae nunc. Quisque ullamcorper sapien quis ipsum eleifend pharetra. Proin hendrerit nisl quis nulla aliquet a iaculis justo venenatis.</p><p> Integer congue lacus vitae diam accumsan at semper lacus feugiat. Nunc sodales viverra tortor, non suscipit erat ornare eget. Aliquam nunc mi, faucibus et aliquam eu, mollis ac mi. Maecenas turpis purus, varius id sagittis eu, venenatis quis arcu. Curabitur rhoncus dignissim lorem, in placerat sem aliquam in. Vestibulum quis metus non nunc aliquet fermentum non et sapien.</p></div>', 'Lorem ipsum dolor sit amet', '', '', '', 'product-47');
INSERT INTO `jos_virtuemart_products_en_gb` (`virtuemart_product_id`, `product_s_desc`, `product_desc`, `product_name`, `metadesc`, `metakey`, `customtitle`, `slug`) VALUES
(48, '<p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan.</p>', '<div class="text"><p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan. Sed dapibus dictum massa, id bibendum neque luctus eget. Proin hendrerit interdum viverra. Suspendisse orci mi, vehicula ac dapibus vestibulum, varius suscipit lacus. In non mauris dui.</p><p> Integer nisi mauris, vulputate et suscipit id, varius pretium nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pellentesque tristique sollicitudin. Donec lacinia dui turpis, a pulvinar ligula. Praesent sapien erat, posuere a blandit vitae, interdum eu neque. Ut commodo massa quis nibh accumsan commodo ullamcorper id velit.</p> </div>', 'Ipsum dolor sit amet conse ctetur', '', '', '', 'product-48'),
(49, '<p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed.</p>', '<div class="text"><p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed. Fusce id neque eu tellus luctus adipiscing. Integer rhoncus ante non dui blandit dapibus. Proin lobortis eleifend elit, at lacinia libero suscipit sed.</p><p> Aliquam fringilla euismod risus ac bibendum. Sed sit amet sem varius ante feugiat lacinia. Nunc ipsum nulla, vulputate ut venenatis vitae, malesuada ut mi. Quisque iaculis, dui congue placerat pretium, augue erat accumsan lacus, eget euismod mi purus et magna. Integer molestie velit quis justo sodales pharetra.</p></div>', 'Lorem ipsum dolor sit amet conse', '', '', '', 'product-49'),
(50, '<p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo.</p>', '<div class="text"><p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo. Integer viverra, nibh eget pharetra lacinia, augue nunc mollis tortor, sit amet pulvinar ligula arcu eu ante. Etiam nunc enim, molestie ac dictum at, consectetur quis elit. Quisque quis eros consectetur sapien auctor pulvinar. </p><p>Etiam rhoncus leo vitae purus laoreet viverra. Ut mi erat, consectetur in scelerisque vitae, sollicitudin eu augue. Vivamus molestie ornare neque a placerat. Etiam tellus arcu, tincidunt in rhoncus quis, vestibulum vitae ipsum. Suspendisse sit amet nisl leo, et viverra ante. Sed mi lorem, cursus sit amet pellentesque laoreet, rutrum eget leo. Cras at quam ut velit elementum tincidunt et id nulla. Vivamus malesuada felis eu mauris auctor venenatis.</p></div>', 'Lorem ipsum dolor sit amet, consect etuer', '', '', '', 'product-50'),
(51, '<p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed.</p>', '<div class="text"><p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed. Fusce id neque eu tellus luctus adipiscing. Integer rhoncus ante non dui blandit dapibus. Proin lobortis eleifend elit, at lacinia libero suscipit sed.</p><p> Aliquam fringilla euismod risus ac bibendum. Sed sit amet sem varius ante feugiat lacinia. Nunc ipsum nulla, vulputate ut venenatis vitae, malesuada ut mi. Quisque iaculis, dui congue placerat pretium, augue erat accumsan lacus, eget euismod mi purus et magna. Integer molestie velit quis justo sodales pharetra.</p></div>', 'Lum mleie kertase miase lacnean', '', '', '', 'product-51'),
(52, '<p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo.</p>', '<div class="text"><p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo. Integer viverra, nibh eget pharetra lacinia, augue nunc mollis tortor, sit amet pulvinar ligula arcu eu ante. Etiam nunc enim, molestie ac dictum at, consectetur quis elit. Quisque quis eros consectetur sapien auctor pulvinar. </p><p>Etiam rhoncus leo vitae purus laoreet viverra. Ut mi erat, consectetur in scelerisque vitae, sollicitudin eu augue. Vivamus molestie ornare neque a placerat. Etiam tellus arcu, tincidunt in rhoncus quis, vestibulum vitae ipsum. Suspendisse sit amet nisl leo, et viverra ante. Sed mi lorem, cursus sit amet pellentesque laoreet, rutrum eget leo. Cras at quam ut velit elementum tincidunt et id nulla. Vivamus malesuada felis eu mauris auctor venenatis.</p></div>', 'Lorem ipsum dolor sit amet, consect etuer', '', '', '', 'product-52'),
(53, '<p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere.</p>', '<div class="text"><p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere. Proin viverra, urna nec auctor pulvinar, turpis dui sagittis nulla, non commodo lacus est vitae nunc. Quisque ullamcorper sapien quis ipsum eleifend pharetra. Proin hendrerit nisl quis nulla aliquet a iaculis justo venenatis.</p><p> Integer congue lacus vitae diam accumsan at semper lacus feugiat. Nunc sodales viverra tortor, non suscipit erat ornare eget. Aliquam nunc mi, faucibus et aliquam eu, mollis ac mi. Maecenas turpis purus, varius id sagittis eu, venenatis quis arcu. Curabitur rhoncus dignissim lorem, in placerat sem aliquam in. Vestibulum quis metus non nunc aliquet fermentum non et sapien.</p></div>', 'Ut us dolor apibusgetele mentumvel', '', '', '', 'product-53'),
(54, '<p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan.</p>', '<div class="text"><p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan. Sed dapibus dictum massa, id bibendum neque luctus eget. Proin hendrerit interdum viverra. Suspendisse orci mi, vehicula ac dapibus vestibulum, varius suscipit lacus. In non mauris dui.</p><p> Integer nisi mauris, vulputate et suscipit id, varius pretium nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pellentesque tristique sollicitudin. Donec lacinia dui turpis, a pulvinar ligula. Praesent sapien erat, posuere a blandit vitae, interdum eu neque. Ut commodo massa quis nibh accumsan commodo ullamcorper id velit.</p> </div>', 'Lorem ipsum dolor sit amet conse ctetur adipisicing', '', '', '', 'product-54'),
(55, '<p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed.</p>', '<div class="text"><p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed. Fusce id neque eu tellus luctus adipiscing. Integer rhoncus ante non dui blandit dapibus. Proin lobortis eleifend elit, at lacinia libero suscipit sed.</p><p> Aliquam fringilla euismod risus ac bibendum. Sed sit amet sem varius ante feugiat lacinia. Nunc ipsum nulla, vulputate ut venenatis vitae, malesuada ut mi. Quisque iaculis, dui congue placerat pretium, augue erat accumsan lacus, eget euismod mi purus et magna. Integer molestie velit quis justo sodales pharetra.</p></div>', 'Ipsum dolor sit amet conse ctetur', '', '', '', 'product-55'),
(56, '<p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo.</p>', '<div class="text"><p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo. Integer viverra, nibh eget pharetra lacinia, augue nunc mollis tortor, sit amet pulvinar ligula arcu eu ante. Etiam nunc enim, molestie ac dictum at, consectetur quis elit. Quisque quis eros consectetur sapien auctor pulvinar. </p><p>Etiam rhoncus leo vitae purus laoreet viverra. Ut mi erat, consectetur in scelerisque vitae, sollicitudin eu augue. Vivamus molestie ornare neque a placerat. Etiam tellus arcu, tincidunt in rhoncus quis, vestibulum vitae ipsum. Suspendisse sit amet nisl leo, et viverra ante. Sed mi lorem, cursus sit amet pellentesque laoreet, rutrum eget leo. Cras at quam ut velit elementum tincidunt et id nulla. Vivamus malesuada felis eu mauris auctor venenatis.</p></div>', 'Dolor sit amet', '', '', '', 'product-56'),
(57, '<p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere.</p>', '<div class="text"><p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere. Proin viverra, urna nec auctor pulvinar, turpis dui sagittis nulla, non commodo lacus est vitae nunc. Quisque ullamcorper sapien quis ipsum eleifend pharetra. Proin hendrerit nisl quis nulla aliquet a iaculis justo venenatis.</p><p> Integer congue lacus vitae diam accumsan at semper lacus feugiat. Nunc sodales viverra tortor, non suscipit erat ornare eget. Aliquam nunc mi, faucibus et aliquam eu, mollis ac mi. Maecenas turpis purus, varius id sagittis eu, venenatis quis arcu. Curabitur rhoncus dignissim lorem, in placerat sem aliquam in. Vestibulum quis metus non nunc aliquet fermentum non et sapien.</p></div>', 'Lorem ipsum dolor sit amet', '', '', '', 'product-57'),
(58, '<p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan.</p>', '<div class="text"><p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan. Sed dapibus dictum massa, id bibendum neque luctus eget. Proin hendrerit interdum viverra. Suspendisse orci mi, vehicula ac dapibus vestibulum, varius suscipit lacus. In non mauris dui.</p><p> Integer nisi mauris, vulputate et suscipit id, varius pretium nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pellentesque tristique sollicitudin. Donec lacinia dui turpis, a pulvinar ligula. Praesent sapien erat, posuere a blandit vitae, interdum eu neque. Ut commodo massa quis nibh accumsan commodo ullamcorper id velit.</p> </div>', 'Ipsum dolor sit amet conse ctetur', '', '', '', 'product-58'),
(59, '<p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed.</p>', '<div class="text"><p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed. Fusce id neque eu tellus luctus adipiscing. Integer rhoncus ante non dui blandit dapibus. Proin lobortis eleifend elit, at lacinia libero suscipit sed.</p><p> Aliquam fringilla euismod risus ac bibendum. Sed sit amet sem varius ante feugiat lacinia. Nunc ipsum nulla, vulputate ut venenatis vitae, malesuada ut mi. Quisque iaculis, dui congue placerat pretium, augue erat accumsan lacus, eget euismod mi purus et magna. Integer molestie velit quis justo sodales pharetra.</p></div>', 'Lorem ipsum dolor sit amet conse', '', '', '', 'product-59'),
(60, '<p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo.</p>', '<div class="text"><p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo. Integer viverra, nibh eget pharetra lacinia, augue nunc mollis tortor, sit amet pulvinar ligula arcu eu ante. Etiam nunc enim, molestie ac dictum at, consectetur quis elit. Quisque quis eros consectetur sapien auctor pulvinar. </p><p>Etiam rhoncus leo vitae purus laoreet viverra. Ut mi erat, consectetur in scelerisque vitae, sollicitudin eu augue. Vivamus molestie ornare neque a placerat. Etiam tellus arcu, tincidunt in rhoncus quis, vestibulum vitae ipsum. Suspendisse sit amet nisl leo, et viverra ante. Sed mi lorem, cursus sit amet pellentesque laoreet, rutrum eget leo. Cras at quam ut velit elementum tincidunt et id nulla. Vivamus malesuada felis eu mauris auctor venenatis.</p></div>', 'Lorem ipsum dolor sit amet, consect etuer', '', '', '', 'product-60'),
(61, '<p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed.</p>', '<div class="text"><p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed. Fusce id neque eu tellus luctus adipiscing. Integer rhoncus ante non dui blandit dapibus. Proin lobortis eleifend elit, at lacinia libero suscipit sed.</p><p> Aliquam fringilla euismod risus ac bibendum. Sed sit amet sem varius ante feugiat lacinia. Nunc ipsum nulla, vulputate ut venenatis vitae, malesuada ut mi. Quisque iaculis, dui congue placerat pretium, augue erat accumsan lacus, eget euismod mi purus et magna. Integer molestie velit quis justo sodales pharetra.</p></div>', 'Lum mleie kertase miase lacnean', '', '', '', 'product-61'),
(62, '<p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo.</p>', '<div class="text"><p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo. Integer viverra, nibh eget pharetra lacinia, augue nunc mollis tortor, sit amet pulvinar ligula arcu eu ante. Etiam nunc enim, molestie ac dictum at, consectetur quis elit. Quisque quis eros consectetur sapien auctor pulvinar. </p><p>Etiam rhoncus leo vitae purus laoreet viverra. Ut mi erat, consectetur in scelerisque vitae, sollicitudin eu augue. Vivamus molestie ornare neque a placerat. Etiam tellus arcu, tincidunt in rhoncus quis, vestibulum vitae ipsum. Suspendisse sit amet nisl leo, et viverra ante. Sed mi lorem, cursus sit amet pellentesque laoreet, rutrum eget leo. Cras at quam ut velit elementum tincidunt et id nulla. Vivamus malesuada felis eu mauris auctor venenatis.</p></div>', 'Lorem ipsum dolor sit amet, consect etuer', '', '', '', 'product-62'),
(63, '<p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere.</p>', '<div class="text"><p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere. Proin viverra, urna nec auctor pulvinar, turpis dui sagittis nulla, non commodo lacus est vitae nunc. Quisque ullamcorper sapien quis ipsum eleifend pharetra. Proin hendrerit nisl quis nulla aliquet a iaculis justo venenatis.</p><p> Integer congue lacus vitae diam accumsan at semper lacus feugiat. Nunc sodales viverra tortor, non suscipit erat ornare eget. Aliquam nunc mi, faucibus et aliquam eu, mollis ac mi. Maecenas turpis purus, varius id sagittis eu, venenatis quis arcu. Curabitur rhoncus dignissim lorem, in placerat sem aliquam in. Vestibulum quis metus non nunc aliquet fermentum non et sapien.</p></div>', 'Ut us dolor apibusgetele mentumvel', '', '', '', 'product-63'),
(64, '<p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan.</p>', '<div class="text"><p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan. Sed dapibus dictum massa, id bibendum neque luctus eget. Proin hendrerit interdum viverra. Suspendisse orci mi, vehicula ac dapibus vestibulum, varius suscipit lacus. In non mauris dui.</p><p> Integer nisi mauris, vulputate et suscipit id, varius pretium nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pellentesque tristique sollicitudin. Donec lacinia dui turpis, a pulvinar ligula. Praesent sapien erat, posuere a blandit vitae, interdum eu neque. Ut commodo massa quis nibh accumsan commodo ullamcorper id velit.</p> </div>', 'Lorem ipsum dolor sit amet conse ctetur adipisicing', '', '', '', 'product-64'),
(65, '<p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed.</p>', '<div class="text"><p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed. Fusce id neque eu tellus luctus adipiscing. Integer rhoncus ante non dui blandit dapibus. Proin lobortis eleifend elit, at lacinia libero suscipit sed.</p><p> Aliquam fringilla euismod risus ac bibendum. Sed sit amet sem varius ante feugiat lacinia. Nunc ipsum nulla, vulputate ut venenatis vitae, malesuada ut mi. Quisque iaculis, dui congue placerat pretium, augue erat accumsan lacus, eget euismod mi purus et magna. Integer molestie velit quis justo sodales pharetra.</p></div>', 'Ipsum dolor sit amet conse ctetur', '', '', '', 'product-65'),
(66, '<p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo.</p>', '<div class="text"><p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo. Integer viverra, nibh eget pharetra lacinia, augue nunc mollis tortor, sit amet pulvinar ligula arcu eu ante. Etiam nunc enim, molestie ac dictum at, consectetur quis elit. Quisque quis eros consectetur sapien auctor pulvinar. </p><p>Etiam rhoncus leo vitae purus laoreet viverra. Ut mi erat, consectetur in scelerisque vitae, sollicitudin eu augue. Vivamus molestie ornare neque a placerat. Etiam tellus arcu, tincidunt in rhoncus quis, vestibulum vitae ipsum. Suspendisse sit amet nisl leo, et viverra ante. Sed mi lorem, cursus sit amet pellentesque laoreet, rutrum eget leo. Cras at quam ut velit elementum tincidunt et id nulla. Vivamus malesuada felis eu mauris auctor venenatis.</p></div>', 'Dolor sit amet', '', '', '', 'product-66'),
(67, '<p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere.</p>', '<div class="text"><p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere. Proin viverra, urna nec auctor pulvinar, turpis dui sagittis nulla, non commodo lacus est vitae nunc. Quisque ullamcorper sapien quis ipsum eleifend pharetra. Proin hendrerit nisl quis nulla aliquet a iaculis justo venenatis.</p><p> Integer congue lacus vitae diam accumsan at semper lacus feugiat. Nunc sodales viverra tortor, non suscipit erat ornare eget. Aliquam nunc mi, faucibus et aliquam eu, mollis ac mi. Maecenas turpis purus, varius id sagittis eu, venenatis quis arcu. Curabitur rhoncus dignissim lorem, in placerat sem aliquam in. Vestibulum quis metus non nunc aliquet fermentum non et sapien.</p></div>', 'Lorem ipsum dolor sit amet', '', '', '', 'product-67'),
(68, '<p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan.</p>', '<div class="text"><p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan. Sed dapibus dictum massa, id bibendum neque luctus eget. Proin hendrerit interdum viverra. Suspendisse orci mi, vehicula ac dapibus vestibulum, varius suscipit lacus. In non mauris dui.</p><p> Integer nisi mauris, vulputate et suscipit id, varius pretium nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pellentesque tristique sollicitudin. Donec lacinia dui turpis, a pulvinar ligula. Praesent sapien erat, posuere a blandit vitae, interdum eu neque. Ut commodo massa quis nibh accumsan commodo ullamcorper id velit.</p> </div>', 'Ipsum dolor sit amet conse ctetur', '', '', '', 'product-68'),
(69, '<p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed.</p>', '<div class="text"><p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed. Fusce id neque eu tellus luctus adipiscing. Integer rhoncus ante non dui blandit dapibus. Proin lobortis eleifend elit, at lacinia libero suscipit sed.</p><p> Aliquam fringilla euismod risus ac bibendum. Sed sit amet sem varius ante feugiat lacinia. Nunc ipsum nulla, vulputate ut venenatis vitae, malesuada ut mi. Quisque iaculis, dui congue placerat pretium, augue erat accumsan lacus, eget euismod mi purus et magna. Integer molestie velit quis justo sodales pharetra.</p></div>', 'Lorem ipsum dolor sit amet conse', '', '', '', 'product-69'),
(70, '<p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo.</p>', '<div class="text"><p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo. Integer viverra, nibh eget pharetra lacinia, augue nunc mollis tortor, sit amet pulvinar ligula arcu eu ante. Etiam nunc enim, molestie ac dictum at, consectetur quis elit. Quisque quis eros consectetur sapien auctor pulvinar. </p><p>Etiam rhoncus leo vitae purus laoreet viverra. Ut mi erat, consectetur in scelerisque vitae, sollicitudin eu augue. Vivamus molestie ornare neque a placerat. Etiam tellus arcu, tincidunt in rhoncus quis, vestibulum vitae ipsum. Suspendisse sit amet nisl leo, et viverra ante. Sed mi lorem, cursus sit amet pellentesque laoreet, rutrum eget leo. Cras at quam ut velit elementum tincidunt et id nulla. Vivamus malesuada felis eu mauris auctor venenatis.</p></div>', 'Lorem ipsum dolor sit amet, consect etuer', '', '', '', 'product-70'),
(71, '<p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed.</p>', '<div class="text"><p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed. Fusce id neque eu tellus luctus adipiscing. Integer rhoncus ante non dui blandit dapibus. Proin lobortis eleifend elit, at lacinia libero suscipit sed.</p><p> Aliquam fringilla euismod risus ac bibendum. Sed sit amet sem varius ante feugiat lacinia. Nunc ipsum nulla, vulputate ut venenatis vitae, malesuada ut mi. Quisque iaculis, dui congue placerat pretium, augue erat accumsan lacus, eget euismod mi purus et magna. Integer molestie velit quis justo sodales pharetra.</p></div>', 'Lum mleie kertase miase lacnean', '', '', '', 'product-71'),
(72, '<p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo.</p>', '<div class="text"><p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo. Integer viverra, nibh eget pharetra lacinia, augue nunc mollis tortor, sit amet pulvinar ligula arcu eu ante. Etiam nunc enim, molestie ac dictum at, consectetur quis elit. Quisque quis eros consectetur sapien auctor pulvinar. </p><p>Etiam rhoncus leo vitae purus laoreet viverra. Ut mi erat, consectetur in scelerisque vitae, sollicitudin eu augue. Vivamus molestie ornare neque a placerat. Etiam tellus arcu, tincidunt in rhoncus quis, vestibulum vitae ipsum. Suspendisse sit amet nisl leo, et viverra ante. Sed mi lorem, cursus sit amet pellentesque laoreet, rutrum eget leo. Cras at quam ut velit elementum tincidunt et id nulla. Vivamus malesuada felis eu mauris auctor venenatis.</p></div>', 'Lorem ipsum dolor sit amet, consect etuer', '', '', '', 'product-72'),
(73, '<p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere.</p>', '<div class="text"><p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere. Proin viverra, urna nec auctor pulvinar, turpis dui sagittis nulla, non commodo lacus est vitae nunc. Quisque ullamcorper sapien quis ipsum eleifend pharetra. Proin hendrerit nisl quis nulla aliquet a iaculis justo venenatis.</p><p> Integer congue lacus vitae diam accumsan at semper lacus feugiat. Nunc sodales viverra tortor, non suscipit erat ornare eget. Aliquam nunc mi, faucibus et aliquam eu, mollis ac mi. Maecenas turpis purus, varius id sagittis eu, venenatis quis arcu. Curabitur rhoncus dignissim lorem, in placerat sem aliquam in. Vestibulum quis metus non nunc aliquet fermentum non et sapien.</p></div>', 'Ut us dolor apibusgetele mentumvel', '', '', '', 'product-73'),
(74, '<p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan.</p>', '<div class="text"><p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan. Sed dapibus dictum massa, id bibendum neque luctus eget. Proin hendrerit interdum viverra. Suspendisse orci mi, vehicula ac dapibus vestibulum, varius suscipit lacus. In non mauris dui.</p><p> Integer nisi mauris, vulputate et suscipit id, varius pretium nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pellentesque tristique sollicitudin. Donec lacinia dui turpis, a pulvinar ligula. Praesent sapien erat, posuere a blandit vitae, interdum eu neque. Ut commodo massa quis nibh accumsan commodo ullamcorper id velit.</p> </div>', 'Lorem ipsum dolor sit amet conse ctetur adipisicing', '', '', '', 'product-74'),
(75, '<p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed.</p>', '<div class="text"><p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed. Fusce id neque eu tellus luctus adipiscing. Integer rhoncus ante non dui blandit dapibus. Proin lobortis eleifend elit, at lacinia libero suscipit sed.</p><p> Aliquam fringilla euismod risus ac bibendum. Sed sit amet sem varius ante feugiat lacinia. Nunc ipsum nulla, vulputate ut venenatis vitae, malesuada ut mi. Quisque iaculis, dui congue placerat pretium, augue erat accumsan lacus, eget euismod mi purus et magna. Integer molestie velit quis justo sodales pharetra.</p></div>', 'Ipsum dolor sit amet conse ctetur', '', '', '', 'product-75'),
(76, '<p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo.</p>', '<div class="text"><p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo. Integer viverra, nibh eget pharetra lacinia, augue nunc mollis tortor, sit amet pulvinar ligula arcu eu ante. Etiam nunc enim, molestie ac dictum at, consectetur quis elit. Quisque quis eros consectetur sapien auctor pulvinar. </p><p>Etiam rhoncus leo vitae purus laoreet viverra. Ut mi erat, consectetur in scelerisque vitae, sollicitudin eu augue. Vivamus molestie ornare neque a placerat. Etiam tellus arcu, tincidunt in rhoncus quis, vestibulum vitae ipsum. Suspendisse sit amet nisl leo, et viverra ante. Sed mi lorem, cursus sit amet pellentesque laoreet, rutrum eget leo. Cras at quam ut velit elementum tincidunt et id nulla. Vivamus malesuada felis eu mauris auctor venenatis.</p></div>', 'Dolor sit amet', '', '', '', 'product-76'),
(77, '<p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere.</p>', '<div class="text"><p>Sed in dui et mauris ullamcorper sagittis. Morbi tristique tellus eget turpis blandit bibendum. Aliquam ultricies neque quis eros congue eget pharetra magna posuere. Proin viverra, urna nec auctor pulvinar, turpis dui sagittis nulla, non commodo lacus est vitae nunc. Quisque ullamcorper sapien quis ipsum eleifend pharetra. Proin hendrerit nisl quis nulla aliquet a iaculis justo venenatis.</p><p> Integer congue lacus vitae diam accumsan at semper lacus feugiat. Nunc sodales viverra tortor, non suscipit erat ornare eget. Aliquam nunc mi, faucibus et aliquam eu, mollis ac mi. Maecenas turpis purus, varius id sagittis eu, venenatis quis arcu. Curabitur rhoncus dignissim lorem, in placerat sem aliquam in. Vestibulum quis metus non nunc aliquet fermentum non et sapien.</p></div>', 'Reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatu', '', '', '', 'product-77'),
(78, '<p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan.</p>', '<div class="text"><p>Proin fermentum ultrices venenatis. Praesent molestie nibh et felis interdum aliquet porttitor ac arcu. Integer ac pulvinar sem. Morbi laoreet tellus sed ipsum imperdiet id bibendum libero accumsan. Sed dapibus dictum massa, id bibendum neque luctus eget. Proin hendrerit interdum viverra. Suspendisse orci mi, vehicula ac dapibus vestibulum, varius suscipit lacus. In non mauris dui.</p><p> Integer nisi mauris, vulputate et suscipit id, varius pretium nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pellentesque tristique sollicitudin. Donec lacinia dui turpis, a pulvinar ligula. Praesent sapien erat, posuere a blandit vitae, interdum eu neque. Ut commodo massa quis nibh accumsan commodo ullamcorper id velit.</p> </div>', 'Dolor sit amet conse ctetur adipisicing elitsed do eiusmod', '', '', '', 'product-78'),
(79, '<p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed.</p>', '<div class="text"><p>Sed sapien sapien, vulputate ac varius vitae, rutrum ultrices odio. Morbi vel tortor enim. Praesent lobortis gravida pretium. Vestibulum faucibus pellentesque metus, nec convallis mauris congue sed. Fusce id neque eu tellus luctus adipiscing. Integer rhoncus ante non dui blandit dapibus. Proin lobortis eleifend elit, at lacinia libero suscipit sed.</p><p> Aliquam fringilla euismod risus ac bibendum. Sed sit amet sem varius ante feugiat lacinia. Nunc ipsum nulla, vulputate ut venenatis vitae, malesuada ut mi. Quisque iaculis, dui congue placerat pretium, augue erat accumsan lacus, eget euismod mi purus et magna. Integer molestie velit quis justo sodales pharetra.</p></div>', 'Lorem ipsum dolor sit amet conse ctetur adipisicing elitsed do eiusmod', '', '', '', 'product-79'),
(80, '<p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo.</p>', '<div class="text"><p>Ut vitae neque vel lacus volutpat pulvinar. Cras quis odio vitae tellus blandit fringilla. Fusce mattis diam massa. Aenean a adipiscing justo. Integer viverra, nibh eget pharetra lacinia, augue nunc mollis tortor, sit amet pulvinar ligula arcu eu ante. Etiam nunc enim, molestie ac dictum at, consectetur quis elit. Quisque quis eros consectetur sapien auctor pulvinar. </p><p>Etiam rhoncus leo vitae purus laoreet viverra. Ut mi erat, consectetur in scelerisque vitae, sollicitudin eu augue. Vivamus molestie ornare neque a placerat. Etiam tellus arcu, tincidunt in rhoncus quis, vestibulum vitae ipsum. Suspendisse sit amet nisl leo, et viverra ante. Sed mi lorem, cursus sit amet pellentesque laoreet, rutrum eget leo. Cras at quam ut velit elementum tincidunt et id nulla. Vivamus malesuada felis eu mauris auctor venenatis.</p></div>', 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui', '', '', '', 'product-80');

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_product_categories`
--

DROP TABLE IF EXISTS `jos_virtuemart_product_categories`;
CREATE TABLE `jos_virtuemart_product_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_product_id` int(1) unsigned NOT NULL DEFAULT '0',
  `virtuemart_category_id` smallint(1) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `i_virtuemart_product_id` (`virtuemart_product_id`,`virtuemart_category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Maps Products to Categories' AUTO_INCREMENT=81 ;

--
-- Dumping data for table `jos_virtuemart_product_categories`
--

INSERT INTO `jos_virtuemart_product_categories` (`id`, `virtuemart_product_id`, `virtuemart_category_id`, `ordering`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 3, 1, 1),
(4, 4, 1, 1),
(5, 5, 1, 1),
(6, 6, 1, 1),
(7, 7, 2, 1),
(8, 8, 2, 1),
(9, 9, 2, 1),
(10, 10, 2, 1),
(11, 11, 2, 1),
(12, 12, 2, 1),
(13, 13, 4, 1),
(14, 14, 4, 1),
(15, 15, 4, 1),
(16, 16, 4, 1),
(17, 17, 4, 1),
(18, 18, 4, 1),
(19, 19, 5, 1),
(20, 20, 5, 1),
(21, 21, 5, 1),
(22, 22, 5, 1),
(23, 23, 5, 1),
(24, 24, 5, 1),
(25, 25, 6, 1),
(26, 26, 6, 1),
(27, 27, 6, 1),
(28, 28, 6, 1),
(29, 29, 6, 1),
(30, 30, 6, 1),
(31, 31, 7, 1),
(32, 32, 7, 1),
(33, 33, 7, 1),
(34, 34, 7, 1),
(35, 35, 7, 1),
(36, 36, 7, 1),
(37, 37, 8, 1),
(38, 38, 8, 1),
(39, 39, 8, 1),
(40, 40, 8, 1),
(41, 41, 8, 1),
(42, 42, 8, 1),
(43, 43, 3, 1),
(44, 44, 3, 1),
(45, 45, 3, 1),
(46, 46, 3, 1),
(47, 47, 3, 1),
(48, 48, 3, 1),
(49, 49, 9, 1),
(50, 50, 9, 1),
(51, 51, 9, 1),
(52, 52, 9, 1),
(53, 53, 9, 1),
(54, 54, 9, 1),
(55, 55, 10, 1),
(56, 56, 10, 1),
(57, 57, 10, 1),
(58, 58, 10, 1),
(59, 59, 10, 1),
(60, 60, 10, 1),
(61, 61, 11, 1),
(62, 62, 11, 1),
(63, 63, 11, 1),
(64, 64, 11, 1),
(65, 65, 11, 1),
(66, 66, 11, 1),
(67, 67, 12, 1),
(68, 68, 12, 1),
(69, 69, 12, 1),
(70, 70, 12, 1),
(71, 71, 12, 1),
(72, 72, 12, 1),
(73, 73, 13, 1),
(74, 74, 13, 1),
(75, 75, 13, 1),
(76, 76, 13, 1),
(77, 77, 14, 1),
(78, 78, 14, 1),
(79, 79, 14, 1),
(80, 80, 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_product_customfields`
--

DROP TABLE IF EXISTS `jos_virtuemart_product_customfields`;
CREATE TABLE `jos_virtuemart_product_customfields` (
  `virtuemart_customfield_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'field id',
  `virtuemart_product_id` int(11) NOT NULL DEFAULT '0',
  `virtuemart_custom_id` int(11) NOT NULL DEFAULT '1' COMMENT 'custom group id',
  `custom_value` varchar(8000) DEFAULT NULL COMMENT 'field value',
  `custom_price` decimal(15,5) DEFAULT NULL COMMENT 'price',
  `custom_param` varchar(12800) DEFAULT NULL COMMENT 'Param for Plugins',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(1) unsigned NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(1) unsigned NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(1) unsigned NOT NULL DEFAULT '0',
  `ordering` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`virtuemart_customfield_id`),
  KEY `idx_virtuemart_product_id` (`virtuemart_product_id`),
  KEY `idx_virtuemart_custom_id` (`virtuemart_custom_id`),
  KEY `idx_custom_value` (`custom_value`(333))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='custom fields' AUTO_INCREMENT=180 ;

--
-- Dumping data for table `jos_virtuemart_product_customfields`
--

INSERT INTO `jos_virtuemart_product_customfields` (`virtuemart_customfield_id`, `virtuemart_product_id`, `virtuemart_custom_id`, `custom_value`, `custom_price`, `custom_param`, `published`, `created_on`, `created_by`, `modified_on`, `modified_by`, `locked_on`, `locked_by`, `ordering`) VALUES
(24, 5, 2, '5', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:50:58', 42, '0000-00-00 00:00:00', 0, 0),
(22, 5, 1, '7', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:50:58', 42, '0000-00-00 00:00:00', 0, 0),
(23, 5, 2, '2', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:50:58', 42, '0000-00-00 00:00:00', 0, 1),
(137, 4, 30, '', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:46:54', 42, '0000-00-00 00:00:00', 0, 4),
(136, 4, 9, '50', '6.00000', '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:46:54', 42, '0000-00-00 00:00:00', 0, 3),
(57, 26, 25, '<p><img src="images/stories/banner_cradle.jpg" border="0" alt="banner cradle" width="650" height="180" style="vertical-align: bottom; border: 0;" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin scelerisque lacinia nisi, ac gravida mi suscipit vitae. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin tortor justo, sagittis ac ultricies sed, tincidunt eu magna. Sed laoreet vehicula lectus non sollicitudin. Donec dictum interdum mauris, at rhoncus lorem blandit a. Phasellus convallis justo a orci congue sollicitudin. Mauris lacus turpis, porttitor at placerat blandit, feugiat et augue. Nullam eu urna nunc, vel posuere magna. Vivamus varius lorem id elit convallis id ultricies neque tempus.</p>\r\n<p>Morbi eros dolor, dignissim quis tristique ut, aliquet at urna. Phasellus eu nibh erat, et ultricies augue. Donec vitae orci blandit enim viverra condimentum. Donec luctus nisi eget orci gravida auctor. Vivamus vestibulum rhoncus libero, id venenatis tortor lacinia vel. Pellentesque felis dolor, imperdiet vel pharetra vel, rhoncus ac purus. Nunc euismod lacus vel augue congue vel iaculis sapien tristique. Maecenas in nisl est, sit amet pretium quam. Nullam elit mauris, suscipit ac vehicula ac, sodales sit amet augue. Morbi tellus dui, imperdiet eu sagittis sed, mollis non magna.</p>', NULL, '', 0, '0000-00-00 00:00:00', 0, '2013-04-12 11:27:24', 0, '0000-00-00 00:00:00', 0, 0),
(135, 4, 9, '45', '4.00000', '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:46:54', 42, '0000-00-00 00:00:00', 0, 2),
(132, 3, 9, '40', '4.00000', '', 0, '0000-00-00 00:00:00', 0, '2013-04-18 14:16:58', 0, '0000-00-00 00:00:00', 0, 1),
(133, 3, 9, '50', '8.00000', '', 0, '0000-00-00 00:00:00', 0, '2013-04-18 14:16:58', 0, '0000-00-00 00:00:00', 0, 2),
(134, 4, 9, '40', '2.00000', '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:46:54', 42, '0000-00-00 00:00:00', 0, 1),
(60, 26, 28, '<iframe width="560" height="315" src="http://www.youtube.com/embed/JitvT29fybE" frameborder="0" allowfullscreen></iframe>', NULL, '', 0, '0000-00-00 00:00:00', 0, '2013-04-12 11:27:24', 0, '0000-00-00 00:00:00', 0, 1),
(87, 26, 34, '0', NULL, '', 0, '0000-00-00 00:00:00', 0, '2013-04-12 11:27:24', 0, '0000-00-00 00:00:00', 0, 15),
(86, 26, 31, 'ya xz chto napisat', NULL, '', 0, '0000-00-00 00:00:00', 0, '2013-04-12 11:27:24', 0, '0000-00-00 00:00:00', 0, 14),
(85, 26, 32, '20', NULL, '', 0, '0000-00-00 00:00:00', 0, '2013-04-12 11:27:24', 0, '0000-00-00 00:00:00', 0, 13),
(84, 26, 33, '20', NULL, '', 0, '0000-00-00 00:00:00', 0, '2013-04-12 11:27:24', 0, '0000-00-00 00:00:00', 0, 12),
(83, 26, 30, '', NULL, '', 0, '0000-00-00 00:00:00', 0, '2013-04-12 11:27:24', 0, '0000-00-00 00:00:00', 0, 11),
(169, 1, 1, '16', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:46:09', 42, '0000-00-00 00:00:00', 0, 0),
(168, 1, 1, '15', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:46:09', 42, '0000-00-00 00:00:00', 0, 1),
(167, 1, 1, '10', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:46:09', 42, '0000-00-00 00:00:00', 0, 2),
(99, 1, 25, '<p><img src="images/stories/banner_cradle.jpg" border="0" alt="banner cradle" width="650" height="180" style="vertical-align: bottom; border: 0;" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin scelerisque lacinia nisi, ac gravida mi suscipit vitae. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin tortor justo, sagittis ac ultricies sed, tincidunt eu magna. Sed laoreet vehicula lectus non sollicitudin. Donec dictum interdum mauris, at rhoncus lorem blandit a. Phasellus convallis justo a orci congue sollicitudin. Mauris lacus turpis, porttitor at placerat blandit, feugiat et augue. Nullam eu urna nunc, vel posuere magna. Vivamus varius lorem id elit convallis id ultricies neque tempus.</p>\r\n<p>Morbi eros dolor, dignissim quis tristique ut, aliquet at urna. Phasellus eu nibh erat, et ultricies augue. Donec vitae orci blandit enim viverra condimentum. Donec luctus nisi eget orci gravida auctor. Vivamus vestibulum rhoncus libero, id venenatis tortor lacinia vel. Pellentesque felis dolor, imperdiet vel pharetra vel, rhoncus ac purus. Nunc euismod lacus vel augue congue vel iaculis sapien tristique. Maecenas in nisl est, sit amet pretium quam. Nullam elit mauris, suscipit ac vehicula ac, sodales sit amet augue. Morbi tellus dui, imperdiet eu sagittis sed, mollis non magna.</p>', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:46:09', 42, '0000-00-00 00:00:00', 0, 0),
(100, 1, 28, '<iframe width="560" height="315" src="http://www.youtube.com/embed/JitvT29fybE" frameborder="0" allowfullscreen></iframe>', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:46:09', 42, '0000-00-00 00:00:00', 0, 1),
(101, 2, 25, '<p><img src="images/stories/banner_cradle.jpg" border="0" alt="banner cradle" width="650" height="180" style="vertical-align: bottom; border: 0;" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin scelerisque lacinia nisi, ac gravida mi suscipit vitae. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin tortor justo, sagittis ac ultricies sed, tincidunt eu magna. Sed laoreet vehicula lectus non sollicitudin. Donec dictum interdum mauris, at rhoncus lorem blandit a. Phasellus convallis justo a orci congue sollicitudin. Mauris lacus turpis, porttitor at placerat blandit, feugiat et augue. Nullam eu urna nunc, vel posuere magna. Vivamus varius lorem id elit convallis id ultricies neque tempus.</p>\r\n<p>Morbi eros dolor, dignissim quis tristique ut, aliquet at urna. Phasellus eu nibh erat, et ultricies augue. Donec vitae orci blandit enim viverra condimentum. Donec luctus nisi eget orci gravida auctor. Vivamus vestibulum rhoncus libero, id venenatis tortor lacinia vel. Pellentesque felis dolor, imperdiet vel pharetra vel, rhoncus ac purus. Nunc euismod lacus vel augue congue vel iaculis sapien tristique. Maecenas in nisl est, sit amet pretium quam. Nullam elit mauris, suscipit ac vehicula ac, sodales sit amet augue. Morbi tellus dui, imperdiet eu sagittis sed, mollis non magna.</p>', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-01-10 12:08:19', 42, '0000-00-00 00:00:00', 0, 0),
(102, 4, 25, '<p><img src="images/stories/banner_cradle.jpg" border="0" alt="banner cradle" width="650" height="180" style="vertical-align: bottom; border: 0;" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin scelerisque lacinia nisi, ac gravida mi suscipit vitae. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin tortor justo, sagittis ac ultricies sed, tincidunt eu magna. Sed laoreet vehicula lectus non sollicitudin. Donec dictum interdum mauris, at rhoncus lorem blandit a. Phasellus convallis justo a orci congue sollicitudin. Mauris lacus turpis, porttitor at placerat blandit, feugiat et augue. Nullam eu urna nunc, vel posuere magna. Vivamus varius lorem id elit convallis id ultricies neque tempus.</p>\r\n<p>Morbi eros dolor, dignissim quis tristique ut, aliquet at urna. Phasellus eu nibh erat, et ultricies augue. Donec vitae orci blandit enim viverra condimentum. Donec luctus nisi eget orci gravida auctor. Vivamus vestibulum rhoncus libero, id venenatis tortor lacinia vel. Pellentesque felis dolor, imperdiet vel pharetra vel, rhoncus ac purus. Nunc euismod lacus vel augue congue vel iaculis sapien tristique. Maecenas in nisl est, sit amet pretium quam. Nullam elit mauris, suscipit ac vehicula ac, sodales sit amet augue. Morbi tellus dui, imperdiet eu sagittis sed, mollis non magna.</p>', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:46:54', 42, '0000-00-00 00:00:00', 0, 0),
(103, 6, 25, '<p><img src="images/stories/banner_cradle.jpg" border="0" alt="banner cradle" width="650" height="180" style="vertical-align: bottom; border: 0;" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin scelerisque lacinia nisi, ac gravida mi suscipit vitae. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin tortor justo, sagittis ac ultricies sed, tincidunt eu magna. Sed laoreet vehicula lectus non sollicitudin. Donec dictum interdum mauris, at rhoncus lorem blandit a. Phasellus convallis justo a orci congue sollicitudin. Mauris lacus turpis, porttitor at placerat blandit, feugiat et augue. Nullam eu urna nunc, vel posuere magna. Vivamus varius lorem id elit convallis id ultricies neque tempus.</p>\r\n<p>Morbi eros dolor, dignissim quis tristique ut, aliquet at urna. Phasellus eu nibh erat, et ultricies augue. Donec vitae orci blandit enim viverra condimentum. Donec luctus nisi eget orci gravida auctor. Vivamus vestibulum rhoncus libero, id venenatis tortor lacinia vel. Pellentesque felis dolor, imperdiet vel pharetra vel, rhoncus ac purus. Nunc euismod lacus vel augue congue vel iaculis sapien tristique. Maecenas in nisl est, sit amet pretium quam. Nullam elit mauris, suscipit ac vehicula ac, sodales sit amet augue. Morbi tellus dui, imperdiet eu sagittis sed, mollis non magna.</p>', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:47:44', 42, '0000-00-00 00:00:00', 0, 0),
(104, 8, 28, '<iframe width="560" height="315" src="http://www.youtube.com/embed/JitvT29fybE" frameborder="0" allowfullscreen></iframe>', NULL, '', 0, '0000-00-00 00:00:00', 0, '2013-04-18 13:14:01', 0, '0000-00-00 00:00:00', 0, 0),
(105, 28, 28, '<iframe width="560" height="315" src="http://www.youtube.com/embed/JitvT29fybE" frameborder="0" allowfullscreen></iframe>', NULL, '', 0, '0000-00-00 00:00:00', 0, '2013-04-12 11:28:23', 0, '0000-00-00 00:00:00', 0, 0),
(106, 29, 28, '<iframe width="560" height="315" src="http://www.youtube.com/embed/JitvT29fybE" frameborder="0" allowfullscreen></iframe>', NULL, '', 0, '0000-00-00 00:00:00', 0, '2013-04-12 11:28:50', 0, '0000-00-00 00:00:00', 0, 0),
(107, 3, 28, '<iframe width="560" height="315" src="http://www.youtube.com/embed/JitvT29fybE" frameborder="0" allowfullscreen></iframe>', NULL, '', 0, '0000-00-00 00:00:00', 0, '2013-04-18 14:16:58', 0, '0000-00-00 00:00:00', 0, 0),
(108, 5, 28, '<iframe width="560" height="315" src="http://www.youtube.com/embed/JitvT29fybE" frameborder="0" allowfullscreen></iframe>', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:50:58', 42, '0000-00-00 00:00:00', 0, 0),
(109, 2, 30, '', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-01-10 12:08:19', 42, '0000-00-00 00:00:00', 0, 1),
(110, 2, 33, '15', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-01-10 12:08:19', 42, '0000-00-00 00:00:00', 0, 2),
(111, 2, 32, '15', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-01-10 12:08:19', 42, '0000-00-00 00:00:00', 0, 3),
(112, 2, 31, 'test', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-01-10 12:08:19', 42, '0000-00-00 00:00:00', 0, 4),
(113, 2, 34, '1', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-01-10 12:08:19', 42, '0000-00-00 00:00:00', 0, 5),
(114, 5, 30, '', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:50:58', 42, '0000-00-00 00:00:00', 0, 1),
(115, 5, 33, '10', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:50:58', 42, '0000-00-00 00:00:00', 0, 2),
(116, 5, 32, '10', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:50:58', 42, '0000-00-00 00:00:00', 0, 3),
(117, 5, 31, 'test', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:50:58', 42, '0000-00-00 00:00:00', 0, 4),
(118, 5, 34, '0', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:50:58', 42, '0000-00-00 00:00:00', 0, 5),
(119, 8, 30, '', NULL, '', 0, '0000-00-00 00:00:00', 0, '2013-04-18 13:14:01', 0, '0000-00-00 00:00:00', 0, 1),
(120, 8, 33, '25', NULL, '', 0, '0000-00-00 00:00:00', 0, '2013-04-18 13:14:01', 0, '0000-00-00 00:00:00', 0, 2),
(121, 8, 32, '25', NULL, '', 0, '0000-00-00 00:00:00', 0, '2013-04-18 13:14:01', 0, '0000-00-00 00:00:00', 0, 3),
(122, 8, 31, 'test test', NULL, '', 0, '0000-00-00 00:00:00', 0, '2013-04-18 13:14:01', 0, '0000-00-00 00:00:00', 0, 4),
(123, 8, 34, '1', NULL, '', 0, '0000-00-00 00:00:00', 0, '2013-04-18 13:14:01', 0, '0000-00-00 00:00:00', 0, 5),
(138, 4, 33, '25', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:46:54', 42, '0000-00-00 00:00:00', 0, 5),
(139, 4, 32, '25', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:46:54', 42, '0000-00-00 00:00:00', 0, 6),
(140, 4, 31, 'test', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:46:54', 42, '0000-00-00 00:00:00', 0, 7),
(141, 4, 34, '1', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:46:54', 42, '0000-00-00 00:00:00', 0, 8),
(142, 5, 2, '1', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:50:58', 42, '0000-00-00 00:00:00', 0, 2),
(143, 5, 2, '3', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:50:58', 42, '0000-00-00 00:00:00', 0, 3),
(144, 5, 1, '8', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:50:58', 42, '0000-00-00 00:00:00', 0, 1),
(145, 5, 1, '22', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:50:58', 42, '0000-00-00 00:00:00', 0, 2),
(146, 5, 1, '4', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:50:58', 42, '0000-00-00 00:00:00', 0, 3),
(147, 6, 30, '', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:47:44', 42, '0000-00-00 00:00:00', 0, 1),
(148, 6, 33, '30', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:47:44', 42, '0000-00-00 00:00:00', 0, 2),
(149, 6, 32, '25', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:47:44', 42, '0000-00-00 00:00:00', 0, 3),
(150, 6, 31, 'test 2', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:47:44', 42, '0000-00-00 00:00:00', 0, 4),
(151, 6, 34, '1', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:47:44', 42, '0000-00-00 00:00:00', 0, 5),
(152, 5, 9, '30', '10.00000', '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:50:58', 42, '0000-00-00 00:00:00', 0, 6),
(153, 5, 9, '35', '11.00000', '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:50:58', 42, '0000-00-00 00:00:00', 0, 7),
(154, 5, 9, '40', '12.00000', '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:50:58', 42, '0000-00-00 00:00:00', 0, 8),
(155, 5, 9, '45', '14.00000', '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:50:58', 42, '0000-00-00 00:00:00', 0, 9),
(156, 5, 2, '10', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:50:58', 42, '0000-00-00 00:00:00', 0, 4),
(157, 5, 1, '34', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:50:58', 42, '0000-00-00 00:00:00', 0, 4),
(159, 5, 25, '<p><img src="images/stories/banner_cradle.jpg" border="0" alt="banner cradle" width="658" height="180" style="vertical-align: bottom; border: 0;" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin scelerisque lacinia nisi, ac gravida mi suscipit vitae. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin tortor justo, sagittis ac ultricies sed, tincidunt eu magna. Sed laoreet vehicula lectus non sollicitudin. Donec dictum interdum mauris, at rhoncus lorem blandit a. Phasellus convallis justo a orci congue sollicitudin. Mauris lacus turpis, porttitor at placerat blandit, feugiat et augue. Nullam eu urna nunc, vel posuere magna. Vivamus varius lorem id elit convallis id ultricies neque tempus.</p>\r\n<p>Morbi eros dolor, dignissim quis tristique ut, aliquet at urna. Phasellus eu nibh erat, et ultricies augue. Donec vitae orci blandit enim viverra condimentum. Donec luctus nisi eget orci gravida auctor. Vivamus vestibulum rhoncus libero, id venenatis tortor lacinia vel. Pellentesque felis dolor, imperdiet vel pharetra vel, rhoncus ac purus. Nunc euismod lacus vel augue congue vel iaculis sapien tristique. Maecenas in nisl est, sit amet pretium quam. Nullam elit mauris, suscipit ac vehicula ac, sodales sit amet augue. Morbi tellus dui, imperdiet eu sagittis sed, mollis non magna.</p>', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:50:58', 42, '0000-00-00 00:00:00', 0, 10),
(160, 5, 41, 'test1', '10.00000', '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:50:58', 42, '0000-00-00 00:00:00', 0, 11),
(161, 5, 41, 'test2', '15.00000', '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:50:58', 42, '0000-00-00 00:00:00', 0, 12),
(162, 5, 41, 'test3', '20.00000', '', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:50:58', 42, '0000-00-00 00:00:00', 0, 13),
(165, 5, 42, '+', '2.00000', '{"custom_size":"5"}', 0, '0000-00-00 00:00:00', 0, '2014-03-13 13:50:58', 42, '0000-00-00 00:00:00', 0, 14),
(170, 2, 1, '10', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-01-10 12:08:19', 42, '0000-00-00 00:00:00', 0, 0),
(171, 2, 2, '10', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-01-10 12:08:19', 42, '0000-00-00 00:00:00', 0, 0),
(172, 2, 2, '9', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-01-10 12:08:19', 42, '0000-00-00 00:00:00', 0, 1),
(173, 2, 1, '15', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-01-10 12:08:19', 42, '0000-00-00 00:00:00', 0, 1),
(174, 2, 1, '13', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-01-10 12:08:19', 42, '0000-00-00 00:00:00', 0, 2),
(175, 2, 1, '16', NULL, '', 0, '0000-00-00 00:00:00', 0, '2014-01-10 12:08:19', 42, '0000-00-00 00:00:00', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_product_custom_plg_specification`
--

DROP TABLE IF EXISTS `jos_virtuemart_product_custom_plg_specification`;
CREATE TABLE `jos_virtuemart_product_custom_plg_specification` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_product_id` int(11) unsigned DEFAULT NULL,
  `virtuemart_custom_id` int(11) unsigned DEFAULT NULL,
  `custom_specification_default1` varchar(1024) NOT NULL DEFAULT '',
  `custom_specification_default2` varchar(1024) NOT NULL DEFAULT '',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Product Specification Table' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `jos_virtuemart_product_custom_plg_specification`
--

INSERT INTO `jos_virtuemart_product_custom_plg_specification` (`id`, `virtuemart_product_id`, `virtuemart_custom_id`, `custom_specification_default1`, `custom_specification_default2`, `created_on`, `created_by`, `modified_on`, `modified_by`, `locked_on`, `locked_by`) VALUES
(1, 26, 29, 'info 1', 'Label 2', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(2, 26, 38, '2', '3', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(3, 81, 38, 'info 1', 'info 2', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_product_manufacturers`
--

DROP TABLE IF EXISTS `jos_virtuemart_product_manufacturers`;
CREATE TABLE `jos_virtuemart_product_manufacturers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_product_id` int(11) DEFAULT NULL,
  `virtuemart_manufacturer_id` smallint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `i_virtuemart_product_id` (`virtuemart_product_id`,`virtuemart_manufacturer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Maps a product to a manufacturer' AUTO_INCREMENT=26 ;

--
-- Dumping data for table `jos_virtuemart_product_manufacturers`
--

INSERT INTO `jos_virtuemart_product_manufacturers` (`id`, `virtuemart_product_id`, `virtuemart_manufacturer_id`) VALUES
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(6, 6, 2),
(7, 7, 2),
(8, 8, 2),
(9, 9, 3),
(10, 10, 3),
(11, 11, 3),
(12, 12, 4),
(13, 13, 4),
(14, 14, 5),
(15, 15, 5),
(16, 16, 5),
(17, 17, 6),
(18, 18, 6),
(19, 19, 6),
(20, 20, 7),
(21, 21, 7),
(22, 22, 7),
(23, 23, 8),
(24, 24, 8),
(25, 25, 8);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_product_medias`
--

DROP TABLE IF EXISTS `jos_virtuemart_product_medias`;
CREATE TABLE `jos_virtuemart_product_medias` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_product_id` int(1) unsigned NOT NULL DEFAULT '0',
  `virtuemart_media_id` int(1) unsigned NOT NULL DEFAULT '0',
  `ordering` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `i_virtuemart_product_id` (`virtuemart_product_id`,`virtuemart_media_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=135 ;

--
-- Dumping data for table `jos_virtuemart_product_medias`
--

INSERT INTO `jos_virtuemart_product_medias` (`id`, `virtuemart_product_id`, `virtuemart_media_id`, `ordering`) VALUES
(1, 1, 100, 1),
(2, 2, 101, 1),
(3, 3, 102, 1),
(4, 4, 103, 1),
(5, 5, 104, 1),
(6, 6, 105, 1),
(7, 7, 106, 1),
(8, 8, 107, 1),
(9, 9, 108, 1),
(10, 10, 109, 1),
(11, 11, 110, 1),
(12, 12, 111, 1),
(13, 13, 112, 1),
(14, 14, 113, 1),
(15, 15, 114, 1),
(16, 16, 115, 1),
(17, 17, 116, 1),
(18, 18, 117, 1),
(19, 19, 118, 1),
(20, 20, 119, 1),
(21, 21, 120, 1),
(22, 22, 121, 1),
(23, 23, 122, 1),
(24, 24, 123, 1),
(25, 25, 124, 1),
(26, 26, 125, 1),
(27, 27, 126, 1),
(28, 28, 127, 1),
(29, 29, 128, 1),
(30, 30, 129, 1),
(31, 31, 130, 1),
(32, 32, 131, 1),
(33, 33, 132, 1),
(34, 34, 133, 1),
(35, 35, 134, 1),
(36, 36, 135, 1),
(37, 37, 136, 1),
(38, 38, 137, 1),
(39, 39, 138, 1),
(40, 40, 139, 1),
(41, 41, 140, 1),
(42, 42, 141, 1),
(43, 43, 142, 1),
(44, 44, 143, 1),
(45, 45, 144, 1),
(46, 46, 145, 1),
(47, 47, 146, 1),
(48, 48, 147, 1),
(49, 49, 148, 1),
(50, 50, 149, 1),
(51, 51, 150, 1),
(52, 52, 151, 1),
(53, 53, 152, 1),
(54, 54, 153, 1),
(55, 55, 154, 1),
(56, 56, 155, 1),
(57, 57, 156, 1),
(58, 58, 157, 1),
(59, 59, 158, 1),
(60, 60, 159, 1),
(61, 61, 160, 1),
(62, 62, 161, 1),
(63, 63, 162, 1),
(64, 64, 163, 1),
(65, 65, 164, 1),
(66, 66, 165, 1),
(67, 67, 166, 1),
(68, 68, 167, 1),
(69, 69, 168, 1),
(70, 70, 169, 1),
(71, 71, 170, 1),
(72, 72, 171, 1),
(73, 73, 172, 1),
(74, 74, 173, 1),
(75, 75, 174, 1),
(76, 76, 175, 1),
(77, 77, 176, 1),
(78, 78, 177, 1),
(79, 79, 178, 1),
(80, 80, 179, 1),
(81, 2, 1000, 2),
(82, 2, 1001, 3),
(83, 3, 1002, 2),
(84, 3, 1003, 3),
(85, 4, 1004, 2),
(86, 4, 1005, 3),
(87, 5, 1006, 2),
(88, 5, 1007, 3),
(89, 6, 1008, 2),
(90, 6, 1009, 3),
(91, 7, 1010, 2),
(92, 7, 1011, 3),
(93, 8, 1012, 2),
(94, 8, 1013, 3),
(95, 9, 1014, 2),
(96, 9, 1015, 3),
(97, 10, 1016, 2),
(98, 10, 1017, 3),
(99, 11, 1018, 2),
(100, 11, 1019, 3),
(101, 12, 1020, 2),
(102, 12, 1021, 3),
(103, 13, 1022, 2),
(104, 13, 1023, 3),
(105, 14, 1024, 2),
(106, 14, 1025, 3),
(107, 15, 1026, 2),
(108, 15, 1027, 3),
(109, 16, 1028, 2),
(110, 16, 1029, 3),
(111, 17, 1030, 2),
(112, 17, 1031, 3),
(113, 18, 1032, 2),
(114, 18, 1033, 3),
(115, 19, 1034, 2),
(116, 19, 1035, 3),
(117, 20, 1036, 2),
(118, 20, 1037, 3),
(119, 21, 1038, 2),
(120, 21, 1039, 3),
(121, 22, 1040, 2),
(122, 22, 1041, 3),
(123, 23, 1042, 2),
(124, 23, 1043, 3),
(125, 24, 1044, 2),
(126, 24, 1045, 3),
(127, 25, 1046, 2),
(128, 25, 1047, 3),
(129, 26, 1048, 2),
(130, 26, 1049, 3),
(131, 27, 1050, 2),
(132, 27, 1051, 3),
(133, 28, 1052, 2),
(134, 28, 1053, 3);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_product_prices`
--

DROP TABLE IF EXISTS `jos_virtuemart_product_prices`;
CREATE TABLE `jos_virtuemart_product_prices` (
  `virtuemart_product_price_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_product_id` int(1) unsigned NOT NULL DEFAULT '0',
  `virtuemart_shoppergroup_id` int(11) DEFAULT NULL,
  `product_price` decimal(15,5) DEFAULT NULL,
  `override` tinyint(1) DEFAULT NULL,
  `product_override_price` decimal(15,5) DEFAULT NULL,
  `product_tax_id` int(11) DEFAULT NULL,
  `product_discount_id` int(11) DEFAULT NULL,
  `product_currency` smallint(1) DEFAULT NULL,
  `product_price_publish_up` datetime DEFAULT NULL,
  `product_price_publish_down` datetime DEFAULT NULL,
  `price_quantity_start` int(11) unsigned DEFAULT NULL,
  `price_quantity_end` int(11) unsigned DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`virtuemart_product_price_id`),
  KEY `idx_product_price_product_id` (`virtuemart_product_id`),
  KEY `idx_product_price_virtuemart_shoppergroup_id` (`virtuemart_shoppergroup_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Holds price records for a product' AUTO_INCREMENT=81 ;

--
-- Dumping data for table `jos_virtuemart_product_prices`
--

INSERT INTO `jos_virtuemart_product_prices` (`virtuemart_product_price_id`, `virtuemart_product_id`, `virtuemart_shoppergroup_id`, `product_price`, `override`, `product_override_price`, `product_tax_id`, `product_discount_id`, `product_currency`, `product_price_publish_up`, `product_price_publish_down`, `price_quantity_start`, `price_quantity_end`, `created_on`, `created_by`, `modified_on`, `modified_by`, `locked_on`, `locked_by`) VALUES
(1, 1, 0, '100.00000', 1, '90.00000', 0, 0, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '2013-11-11 12:48:16', 382, '2014-03-13 13:46:09', 42, '0000-00-00 00:00:00', 0),
(2, 2, 0, '120.00000', 1, '95.00000', 0, 0, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '2013-11-11 13:12:15', 382, '2014-01-10 12:08:19', 42, '0000-00-00 00:00:00', 0),
(3, 3, NULL, '110.00000', 1, '105.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(4, 4, 0, '130.00000', 1, '120.00000', 0, 0, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '2014-03-13 13:46:54', 42, '2014-03-13 13:46:54', 42, '0000-00-00 00:00:00', 0),
(5, 5, 0, '90.00000', 1, '85.00000', 0, 0, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '2014-03-13 13:50:58', 42, '2014-03-13 13:50:58', 42, '0000-00-00 00:00:00', 0),
(6, 6, 0, '100.00000', 1, '95.00000', 0, 0, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '2014-03-13 13:47:44', 42, '2014-03-13 13:47:44', 42, '0000-00-00 00:00:00', 0),
(7, 7, NULL, '120.00000', 1, '95.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(8, 8, NULL, '110.00000', 1, '105.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(9, 9, NULL, '130.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(10, 10, NULL, '90.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(11, 11, NULL, '100.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(12, 12, NULL, '120.00000', 1, '95.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(13, 13, NULL, '110.00000', 1, '105.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(14, 14, NULL, '130.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(15, 15, NULL, '90.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(16, 16, NULL, '100.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(17, 17, NULL, '120.00000', 1, '95.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(18, 18, NULL, '110.00000', 1, '105.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(19, 19, NULL, '130.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(20, 20, NULL, '90.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(21, 21, NULL, '100.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(22, 22, NULL, '120.00000', 1, '95.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(23, 23, NULL, '110.00000', 1, '105.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(24, 24, NULL, '130.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(25, 25, NULL, '90.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(26, 26, NULL, '100.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(27, 27, 0, '120.00000', 1, '95.00000', 0, 0, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '2014-04-29 13:40:48', 42, '2014-04-29 13:40:48', 42, '0000-00-00 00:00:00', 0),
(28, 28, NULL, '110.00000', 1, '105.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(29, 29, NULL, '130.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(30, 30, NULL, '90.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(31, 31, NULL, '100.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(32, 32, NULL, '120.00000', 1, '95.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(33, 33, NULL, '110.00000', 1, '105.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(34, 34, NULL, '130.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(35, 35, NULL, '90.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(36, 36, NULL, '100.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(37, 37, NULL, '120.00000', 1, '95.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(38, 38, NULL, '110.00000', 1, '105.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(39, 39, NULL, '130.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(40, 40, NULL, '90.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(41, 41, NULL, '100.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(42, 42, NULL, '120.00000', 1, '95.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(43, 43, NULL, '110.00000', 1, '105.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(44, 44, NULL, '130.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(45, 45, 0, '90.00000', 1, '85.00000', 0, 0, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '2014-03-13 13:48:00', 42, '2014-03-13 13:48:26', 42, '0000-00-00 00:00:00', 0),
(46, 46, NULL, '100.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(47, 47, NULL, '120.00000', 1, '95.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(48, 48, NULL, '110.00000', 1, '105.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(49, 49, NULL, '130.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(50, 50, NULL, '90.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(51, 51, NULL, '100.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(52, 52, NULL, '120.00000', 1, '95.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(53, 53, NULL, '110.00000', 1, '105.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(54, 54, NULL, '130.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(55, 55, NULL, '90.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(56, 56, NULL, '100.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(57, 57, NULL, '120.00000', 1, '95.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(58, 58, NULL, '110.00000', 1, '105.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(59, 59, NULL, '130.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(60, 60, NULL, '90.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(61, 61, NULL, '100.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(62, 62, NULL, '120.00000', 1, '95.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(63, 63, NULL, '110.00000', 1, '105.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(64, 64, NULL, '130.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(65, 65, NULL, '90.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(66, 66, NULL, '100.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(67, 67, NULL, '120.00000', 1, '95.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(68, 68, NULL, '110.00000', 1, '105.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(69, 69, NULL, '130.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(70, 70, 0, '90.00000', 0, '0.00000', 0, 0, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '2014-04-29 13:40:51', 42, '2014-04-29 13:40:51', 42, '0000-00-00 00:00:00', 0),
(71, 71, NULL, '100.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(72, 72, NULL, '120.00000', 1, '95.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(73, 73, NULL, '110.00000', 1, '105.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(74, 74, NULL, '130.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(75, 75, NULL, '90.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(76, 76, NULL, '100.00000', 0, '0.00000', NULL, NULL, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(77, 77, 0, '120.00000', 1, '95.00000', 0, 0, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '2014-06-25 11:27:13', 42, '2014-06-25 11:27:13', 42, '0000-00-00 00:00:00', 0),
(78, 78, 0, '110.00000', 1, '105.00000', 0, 0, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '2014-06-25 11:26:35', 42, '2014-06-25 11:26:35', 42, '0000-00-00 00:00:00', 0),
(79, 79, 0, '130.00000', 0, '0.00000', 0, 0, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '2014-06-25 11:26:09', 42, '2014-06-25 11:26:09', 42, '0000-00-00 00:00:00', 0),
(80, 80, 0, '90.00000', 0, '0.00000', 0, 0, 144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '2014-06-25 11:26:19', 42, '2014-06-25 11:26:19', 42, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_product_relations`
--

DROP TABLE IF EXISTS `jos_virtuemart_product_relations`;
CREATE TABLE `jos_virtuemart_product_relations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_product_id` int(1) unsigned NOT NULL DEFAULT '0',
  `related_products` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `i_virtuemart_product_id` (`virtuemart_product_id`,`related_products`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_product_shoppergroups`
--

DROP TABLE IF EXISTS `jos_virtuemart_product_shoppergroups`;
CREATE TABLE `jos_virtuemart_product_shoppergroups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_product_id` int(1) unsigned NOT NULL DEFAULT '0',
  `virtuemart_shoppergroup_id` smallint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `i_virtuemart_product_id` (`virtuemart_product_id`,`virtuemart_shoppergroup_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Maps Products to Categories' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_ratings`
--

DROP TABLE IF EXISTS `jos_virtuemart_ratings`;
CREATE TABLE `jos_virtuemart_ratings` (
  `virtuemart_rating_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_product_id` int(1) unsigned NOT NULL DEFAULT '0',
  `rates` int(11) NOT NULL DEFAULT '0',
  `ratingcount` int(1) unsigned NOT NULL DEFAULT '0',
  `rating` decimal(10,1) NOT NULL DEFAULT '0.0',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`virtuemart_rating_id`),
  UNIQUE KEY `i_virtuemart_product_id` (`virtuemart_product_id`,`virtuemart_rating_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Stores all ratings for a product' AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_rating_reviews`
--

DROP TABLE IF EXISTS `jos_virtuemart_rating_reviews`;
CREATE TABLE `jos_virtuemart_rating_reviews` (
  `virtuemart_rating_review_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_product_id` int(1) unsigned NOT NULL DEFAULT '0',
  `comment` varchar(18000) DEFAULT NULL,
  `review_ok` tinyint(1) NOT NULL DEFAULT '0',
  `review_rates` int(1) unsigned NOT NULL DEFAULT '0',
  `review_ratingcount` int(1) unsigned NOT NULL DEFAULT '0',
  `review_rating` decimal(10,2) NOT NULL DEFAULT '0.00',
  `review_editable` tinyint(1) NOT NULL DEFAULT '1',
  `lastip` char(50) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`virtuemart_rating_review_id`),
  UNIQUE KEY `i_virtuemart_product_id` (`virtuemart_product_id`,`created_by`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_rating_votes`
--

DROP TABLE IF EXISTS `jos_virtuemart_rating_votes`;
CREATE TABLE `jos_virtuemart_rating_votes` (
  `virtuemart_rating_vote_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_product_id` int(1) unsigned NOT NULL DEFAULT '0',
  `vote` int(11) NOT NULL DEFAULT '0',
  `lastip` char(50) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`virtuemart_rating_vote_id`),
  UNIQUE KEY `i_virtuemart_product_id` (`virtuemart_product_id`,`created_by`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Stores all ratings for a product' AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_shipmentmethods`
--

DROP TABLE IF EXISTS `jos_virtuemart_shipmentmethods`;
CREATE TABLE `jos_virtuemart_shipmentmethods` (
  `virtuemart_shipmentmethod_id` mediumint(1) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_vendor_id` smallint(11) NOT NULL DEFAULT '1',
  `shipment_jplugin_id` int(11) NOT NULL DEFAULT '0',
  `slug` char(255) NOT NULL DEFAULT '',
  `shipment_element` char(50) NOT NULL DEFAULT '',
  `shipment_params` varchar(19000) DEFAULT NULL,
  `ordering` int(2) NOT NULL DEFAULT '0',
  `shared` tinyint(1) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`virtuemart_shipmentmethod_id`),
  KEY `idx_shipment_jplugin_id` (`shipment_jplugin_id`),
  KEY `idx_shipment_method_ordering` (`ordering`),
  KEY `idx_shipment_element` (`shipment_element`,`virtuemart_vendor_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Shipment created from the shipment plugins' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `jos_virtuemart_shipmentmethods`
--

INSERT INTO `jos_virtuemart_shipmentmethods` (`virtuemart_shipmentmethod_id`, `virtuemart_vendor_id`, `shipment_jplugin_id`, `slug`, `shipment_element`, `shipment_params`, `ordering`, `shared`, `published`, `created_on`, `created_by`, `modified_on`, `modified_by`, `locked_on`, `locked_by`) VALUES
(1, 1, 10015, '', 'weight_countries', 'shipment_logos=["systempay.jpg"]|countries=""|zip_start=""|zip_stop=""|weight_start=""|weight_stop=""|weight_unit="KG"|nbproducts_start=0|nbproducts_stop=0|orderamount_start=""|orderamount_stop=""|cost="5"|package_fee=""|tax_id="1"|free_shipment=""|', 1, 0, 1, '0000-00-00 00:00:00', 0, '2013-08-12 08:18:35', 0, '0000-00-00 00:00:00', 0),
(2, 1, 10015, '', 'weight_countries', 'shipment_logos=["systempay.jpg"]|countries=""|zip_start=""|zip_stop=""|weight_start=""|weight_stop=""|weight_unit="KG"|nbproducts_start=0|nbproducts_stop=0|orderamount_start=""|orderamount_stop=""|cost="5"|package_fee=""|tax_id="1"|free_shipment="5"|', 2, 0, 0, '2013-08-12 08:23:34', 0, '2013-08-12 08:23:58', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_shipmentmethods_en_gb`
--

DROP TABLE IF EXISTS `jos_virtuemart_shipmentmethods_en_gb`;
CREATE TABLE `jos_virtuemart_shipmentmethods_en_gb` (
  `virtuemart_shipmentmethod_id` int(1) unsigned NOT NULL,
  `shipment_name` char(180) NOT NULL DEFAULT '',
  `shipment_desc` varchar(19000) NOT NULL DEFAULT '',
  `slug` char(192) NOT NULL DEFAULT '',
  PRIMARY KEY (`virtuemart_shipmentmethod_id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_virtuemart_shipmentmethods_en_gb`
--

INSERT INTO `jos_virtuemart_shipmentmethods_en_gb` (`virtuemart_shipmentmethod_id`, `shipment_name`, `shipment_desc`, `slug`) VALUES
(1, 'Shipment Name 1', 'Shipment Name 1', 'shipment-name-1'),
(2, 'Shipment Name 2', 'Shipment Name 2', 'shipment-name-2');

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_shipmentmethod_shoppergroups`
--

DROP TABLE IF EXISTS `jos_virtuemart_shipmentmethod_shoppergroups`;
CREATE TABLE `jos_virtuemart_shipmentmethod_shoppergroups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_shipmentmethod_id` mediumint(1) unsigned DEFAULT NULL,
  `virtuemart_shoppergroup_id` smallint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `i_virtuemart_shipmentmethod_id` (`virtuemart_shipmentmethod_id`,`virtuemart_shoppergroup_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='xref table for shipment to shoppergroup' AUTO_INCREMENT=9 ;

--
-- Dumping data for table `jos_virtuemart_shipmentmethod_shoppergroups`
--

INSERT INTO `jos_virtuemart_shipmentmethod_shoppergroups` (`id`, `virtuemart_shipmentmethod_id`, `virtuemart_shoppergroup_id`) VALUES
(1, 1, 2),
(2, 1, 1),
(3, 1, 3),
(4, 1, 4),
(5, 2, 1),
(6, 2, 2),
(7, 2, 3),
(8, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_shipment_plg_weight_countries`
--

DROP TABLE IF EXISTS `jos_virtuemart_shipment_plg_weight_countries`;
CREATE TABLE `jos_virtuemart_shipment_plg_weight_countries` (
  `id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_order_id` int(11) unsigned DEFAULT NULL,
  `order_number` char(32) DEFAULT NULL,
  `virtuemart_shipmentmethod_id` mediumint(1) unsigned DEFAULT NULL,
  `shipment_name` varchar(5000) DEFAULT NULL,
  `order_weight` decimal(10,4) DEFAULT NULL,
  `shipment_weight_unit` char(3) DEFAULT 'KG',
  `shipment_cost` decimal(10,2) DEFAULT NULL,
  `shipment_package_fee` decimal(10,2) DEFAULT NULL,
  `tax_id` smallint(1) DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Shipment Weight Countries Table' AUTO_INCREMENT=33 ;

--
-- Dumping data for table `jos_virtuemart_shipment_plg_weight_countries`
--

INSERT INTO `jos_virtuemart_shipment_plg_weight_countries` (`id`, `virtuemart_order_id`, `order_number`, `virtuemart_shipmentmethod_id`, `shipment_name`, `order_weight`, `shipment_weight_unit`, `shipment_cost`, `shipment_package_fee`, `tax_id`, `created_on`, `created_by`, `modified_on`, `modified_by`, `locked_on`, `locked_by`) VALUES
(1, 1, '4daf03', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://localhost/vm2/test2.0.16_a/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 1</span><span class="vmshipment_description">Shipment Name 1</span>', '20.0000', 'KG', '5.00', '0.00', 1, '2013-01-03 12:53:21', 576, '2013-01-03 12:53:21', 576, '0000-00-00 00:00:00', 0),
(2, 2, '91c104', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.31/vm2/test2.0.16_d/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 1</span><span class="vmshipment_description">Shipment Name 1</span>', '40.0000', 'KG', '5.00', '0.00', 1, '2013-04-12 15:44:23', 576, '2013-04-12 15:44:23', 576, '0000-00-00 00:00:00', 0),
(3, 3, '8b8b05', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://localhost/vm2/test2.0.16_d/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 1</span><span class="vmshipment_description">Shipment Name 1</span>', '20.0000', 'KG', '5.00', '0.00', 1, '2013-04-18 09:27:15', 576, '2013-04-18 09:27:15', 576, '0000-00-00 00:00:00', 0),
(4, 4, 'cf8a06', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://localhost/vm2/test2.0.16_d/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 1</span><span class="vmshipment_description">Shipment Name 1</span>', '20.0000', 'KG', '5.00', '0.00', 1, '2013-04-18 13:45:52', 576, '2013-04-18 13:45:52', 576, '0000-00-00 00:00:00', 0),
(5, 1, 'f2ff03', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://localhost/vm2/theme_svn/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 1</span><span class="vmshipment_description">Shipment Name 1</span>', '50.0000', 'KG', '5.00', '0.00', 1, '2013-08-17 10:23:37', 703, '2013-08-17 10:23:37', 703, '0000-00-00 00:00:00', 0),
(6, 2, '355203', 2, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.37/Virtuemart/theme472/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 2</span><span class="vmshipment_description">Shipment Name 2</span>', '10.0000', 'KG', '5.00', '0.00', 1, '2014-02-10 14:52:06', 42, '2014-02-10 14:52:06', 42, '0000-00-00 00:00:00', 0),
(7, 3, 'e5d504', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.37/Virtuemart/theme472/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 1</span><span class="vmshipment_description">Shipment Name 1</span>', '10.0000', 'KG', '5.00', '0.00', 1, '2014-02-10 15:00:29', 42, '2014-02-10 15:00:29', 42, '0000-00-00 00:00:00', 0),
(8, 4, 'cef005', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.37/Virtuemart/theme472/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 1</span><span class="vmshipment_description">Shipment Name 1</span>', '20.0000', 'KG', '5.00', '0.00', 1, '2014-02-10 15:32:28', 42, '2014-02-10 15:32:28', 42, '0000-00-00 00:00:00', 0),
(9, 5, '57e406', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.37/Virtuemart/theme472/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 1</span><span class="vmshipment_description">Shipment Name 1</span>', '10.0000', 'KG', '5.00', '0.00', 1, '2014-02-10 15:39:45', 42, '2014-02-10 15:39:45', 42, '0000-00-00 00:00:00', 0),
(10, 6, 'b0fe07', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.37/Virtuemart/theme472/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 1</span><span class="vmshipment_description">Shipment Name 1</span>', '10.0000', 'KG', '5.00', '0.00', 1, '2014-02-10 15:44:19', 42, '2014-02-10 15:44:19', 42, '0000-00-00 00:00:00', 0),
(11, 7, '9f1f08', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.37/Virtuemart/theme472/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 1</span><span class="vmshipment_description">Shipment Name 1</span>', '10.0000', 'KG', '5.00', '0.00', 1, '2014-02-10 15:44:33', 42, '2014-02-10 15:44:33', 42, '0000-00-00 00:00:00', 0),
(12, 8, '5c2409', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.37/Virtuemart/theme472/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 1</span><span class="vmshipment_description">Shipment Name 1</span>', '10.0000', 'KG', '5.00', '0.00', 1, '2014-02-10 15:48:58', 42, '2014-02-10 15:48:58', 42, '0000-00-00 00:00:00', 0),
(13, 9, '7aa9010', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.37/Virtuemart/theme472/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 1</span><span class="vmshipment_description">Shipment Name 1</span>', '10.0000', 'KG', '5.00', '0.00', 1, '2014-02-10 16:01:05', 42, '2014-02-10 16:01:05', 42, '0000-00-00 00:00:00', 0),
(14, 10, '3167011', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.37/Virtuemart/theme472/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 1</span><span class="vmshipment_description">Shipment Name 1</span>', '10.0000', 'KG', '5.00', '0.00', 1, '2014-02-10 16:01:33', 42, '2014-02-10 16:01:33', 42, '0000-00-00 00:00:00', 0),
(15, 11, '6ba7012', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.37/Virtuemart/theme472/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 1</span><span class="vmshipment_description">Shipment Name 1</span>', '10.0000', 'KG', '5.00', '0.00', 1, '2014-02-10 16:01:47', 42, '2014-02-10 16:01:47', 42, '0000-00-00 00:00:00', 0),
(16, 12, 'd8ea013', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.37/Virtuemart/theme472/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 1</span><span class="vmshipment_description">Shipment Name 1</span>', '10.0000', 'KG', '5.00', '0.00', 1, '2014-02-10 16:02:53', 42, '2014-02-10 16:02:53', 42, '0000-00-00 00:00:00', 0),
(17, 13, '4f7e014', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.37/Virtuemart/theme472/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 1</span><span class="vmshipment_description">Shipment Name 1</span>', '10.0000', 'KG', '5.00', '0.00', 1, '2014-02-10 16:07:48', 42, '2014-02-10 16:07:48', 42, '0000-00-00 00:00:00', 0),
(18, 14, 'f39a015', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.37/Virtuemart/theme472/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 1</span><span class="vmshipment_description">Shipment Name 1</span>', '10.0000', 'KG', '5.00', '0.00', 1, '2014-02-10 16:13:29', 42, '2014-02-10 16:13:29', 42, '0000-00-00 00:00:00', 0),
(19, 15, '24dd016', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.37/Virtuemart/theme472/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 1</span><span class="vmshipment_description">Shipment Name 1</span>', '10.0000', 'KG', '5.00', '0.00', 1, '2014-02-10 16:56:18', 42, '2014-02-10 16:56:18', 42, '0000-00-00 00:00:00', 0),
(20, 16, '0fff017', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.37/Virtuemart/theme472/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 1</span><span class="vmshipment_description">Shipment Name 1</span>', '20.0000', 'KG', '5.00', '0.00', 1, '2014-02-11 07:46:15', 42, '2014-02-11 07:46:15', 42, '0000-00-00 00:00:00', 0),
(21, 17, 'e9f3018', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.37/Virtuemart/theme472/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 1</span><span class="vmshipment_description">Shipment Name 1</span>', '10.0000', 'KG', '5.00', '0.00', 1, '2014-02-11 10:49:27', 42, '2014-02-11 10:49:27', 42, '0000-00-00 00:00:00', 0),
(22, 2, 'f88603', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://localhost/Virtuemart/theme474/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 1</span><span class="vmshipment_description">Shipment Name 1</span>', '30.0000', 'KG', '5.00', '0.00', 1, '2014-02-14 17:06:33', 42, '2014-02-14 17:06:33', 42, '0000-00-00 00:00:00', 0),
(23, 2, 'b69003', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://localhost/VIRTUEMART/theme476/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 1</span><span class="vmshipment_description">Shipment Name 1</span>', '10.0000', 'KG', '5.00', '0.00', 1, '2014-02-24 23:22:27', 42, '2014-02-24 23:22:27', 42, '0000-00-00 00:00:00', 0),
(24, 3, 'c3eb04', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://localhost/VIRTUEMART/theme476/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 1</span><span class="vmshipment_description">Shipment Name 1</span>', '10.0000', 'KG', '5.00', '0.00', 1, '2014-02-24 23:30:08', 42, '2014-02-24 23:30:08', 42, '0000-00-00 00:00:00', 0),
(25, 2, 'e10003', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://localhost/VIRTUEMART/theme478/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 1</span><span class="vmshipment_description">Shipment Name 1</span>', '10.0000', 'KG', '5.00', '0.00', 1, '2014-03-08 14:33:11', 42, '2014-03-08 14:33:11', 42, '0000-00-00 00:00:00', 0),
(26, 2, 'b92503', 1, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.37/VIRTUEMART/theme480/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 1</span><span class="vmshipment_description">Shipment Name 1</span>', '10.0000', 'KG', '5.00', '0.00', 1, '2014-03-13 14:21:28', 42, '2014-03-13 14:21:28', 42, '0000-00-00 00:00:00', 0),
(27, 2, '1c2a03', 2, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.31/vm2/theme507/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 2</span><span class="vmshipment_description">Shipment Name 2</span>', '10.0000', 'KG', '5.00', '0.00', 1, '2014-06-05 12:06:03', 42, '2014-06-05 12:06:03', 42, '0000-00-00 00:00:00', 0),
(28, 3, '4b6304', 2, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.31/vm2/theme507/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 2</span><span class="vmshipment_description">Shipment Name 2</span>', '20.0000', 'KG', '5.00', '0.00', 1, '2014-06-05 12:07:29', 42, '2014-06-05 12:07:29', 42, '0000-00-00 00:00:00', 0),
(29, 4, '2a6b05', 2, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.31/vm2/theme507/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 2</span><span class="vmshipment_description">Shipment Name 2</span>', '20.0000', 'KG', '5.00', '0.00', 1, '2014-06-05 12:08:02', 42, '2014-06-05 12:08:02', 42, '0000-00-00 00:00:00', 0),
(30, 5, '676706', 2, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.31/vm2/theme507/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 2</span><span class="vmshipment_description">Shipment Name 2</span>', '20.0000', 'KG', '5.00', '0.00', 1, '2014-06-05 12:08:43', 42, '2014-06-05 12:08:43', 42, '0000-00-00 00:00:00', 0),
(31, 6, '3c2c07', 2, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.31/vm2/theme507/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 2</span><span class="vmshipment_description">Shipment Name 2</span>', '20.0000', 'KG', '5.00', '0.00', 1, '2014-06-05 12:09:12', 42, '2014-06-05 12:09:12', 42, '0000-00-00 00:00:00', 0),
(32, 7, '74b108', 2, '<span class="vmCartPaymentLogo" ><img align="middle" src="http://192.168.9.31/vm2/theme507/images/stories/virtuemart/shipment/systempay.jpg"  alt="systempay" /></span>  <span class="vmshipment_name">Shipment Name 2</span><span class="vmshipment_description">Shipment Name 2</span>', '20.0000', 'KG', '5.00', '0.00', 1, '2014-06-05 12:09:58', 42, '2014-06-05 12:09:58', 42, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_shoppergroups`
--

DROP TABLE IF EXISTS `jos_virtuemart_shoppergroups`;
CREATE TABLE `jos_virtuemart_shoppergroups` (
  `virtuemart_shoppergroup_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_vendor_id` smallint(11) NOT NULL DEFAULT '1',
  `shopper_group_name` char(32) DEFAULT NULL,
  `shopper_group_desc` char(128) DEFAULT NULL,
  `custom_price_display` tinyint(1) NOT NULL DEFAULT '0',
  `price_display` blob,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` int(2) NOT NULL DEFAULT '0',
  `shared` tinyint(1) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`virtuemart_shoppergroup_id`),
  KEY `idx_shopper_group_virtuemart_vendor_id` (`virtuemart_vendor_id`),
  KEY `idx_shopper_group_name` (`shopper_group_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Shopper Groups that users can be assigned to' AUTO_INCREMENT=5 ;

--
-- Dumping data for table `jos_virtuemart_shoppergroups`
--

INSERT INTO `jos_virtuemart_shoppergroups` (`virtuemart_shoppergroup_id`, `virtuemart_vendor_id`, `shopper_group_name`, `shopper_group_desc`, `custom_price_display`, `price_display`, `default`, `ordering`, `shared`, `published`, `created_on`, `created_by`, `modified_on`, `modified_by`, `locked_on`, `locked_by`) VALUES
(2, 1, '-default-', 'This is the default shopper group.', 0, NULL, 0, 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(1, 1, '-anonymous-', 'Shopper group for anonymous shoppers', 0, NULL, 2, 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(3, 1, 'Gold Level', 'Gold Level Shoppers.', 0, NULL, 0, 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(4, 1, 'Wholesale', 'Shoppers that can buy at wholesale.', 0, NULL, 1, 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_states`
--

DROP TABLE IF EXISTS `jos_virtuemart_states`;
CREATE TABLE `jos_virtuemart_states` (
  `virtuemart_state_id` smallint(1) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_vendor_id` smallint(1) unsigned NOT NULL DEFAULT '1',
  `virtuemart_country_id` smallint(1) unsigned NOT NULL DEFAULT '1',
  `virtuemart_worldzone_id` smallint(1) unsigned NOT NULL DEFAULT '0',
  `state_name` char(64) DEFAULT NULL,
  `state_3_code` char(3) DEFAULT NULL,
  `state_2_code` char(2) DEFAULT NULL,
  `ordering` int(2) NOT NULL DEFAULT '0',
  `shared` tinyint(1) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`virtuemart_state_id`),
  UNIQUE KEY `idx_state_3_code` (`virtuemart_country_id`,`state_3_code`),
  UNIQUE KEY `idx_state_2_code` (`virtuemart_country_id`,`state_2_code`),
  KEY `i_virtuemart_vendor_id` (`virtuemart_vendor_id`),
  KEY `i_virtuemart_country_id` (`virtuemart_country_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='States that are assigned to a country' AUTO_INCREMENT=730 ;

--
-- Dumping data for table `jos_virtuemart_states`
--

INSERT INTO `jos_virtuemart_states` (`virtuemart_state_id`, `virtuemart_vendor_id`, `virtuemart_country_id`, `virtuemart_worldzone_id`, `state_name`, `state_3_code`, `state_2_code`, `ordering`, `shared`, `published`, `created_on`, `created_by`, `modified_on`, `modified_by`, `locked_on`, `locked_by`) VALUES
(1, 1, 223, 0, 'Alabama', 'ALA', 'AL', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(2, 1, 223, 0, 'Alaska', 'ALK', 'AK', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(3, 1, 223, 0, 'Arizona', 'ARZ', 'AZ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(4, 1, 223, 0, 'Arkansas', 'ARK', 'AR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(5, 1, 223, 0, 'California', 'CAL', 'CA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(6, 1, 223, 0, 'Colorado', 'COL', 'CO', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(7, 1, 223, 0, 'Connecticut', 'CCT', 'CT', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(8, 1, 223, 0, 'Delaware', 'DEL', 'DE', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(9, 1, 223, 0, 'District Of Columbia', 'DOC', 'DC', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(10, 1, 223, 0, 'Florida', 'FLO', 'FL', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(11, 1, 223, 0, 'Georgia', 'GEA', 'GA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(12, 1, 223, 0, 'Hawaii', 'HWI', 'HI', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(13, 1, 223, 0, 'Idaho', 'IDA', 'ID', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(14, 1, 223, 0, 'Illinois', 'ILL', 'IL', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(15, 1, 223, 0, 'Indiana', 'IND', 'IN', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(16, 1, 223, 0, 'Iowa', 'IOA', 'IA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(17, 1, 223, 0, 'Kansas', 'KAS', 'KS', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(18, 1, 223, 0, 'Kentucky', 'KTY', 'KY', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(19, 1, 223, 0, 'Louisiana', 'LOA', 'LA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(20, 1, 223, 0, 'Maine', 'MAI', 'ME', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(21, 1, 223, 0, 'Maryland', 'MLD', 'MD', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(22, 1, 223, 0, 'Massachusetts', 'MSA', 'MA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(23, 1, 223, 0, 'Michigan', 'MIC', 'MI', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(24, 1, 223, 0, 'Minnesota', 'MIN', 'MN', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(25, 1, 223, 0, 'Mississippi', 'MIS', 'MS', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(26, 1, 223, 0, 'Missouri', 'MIO', 'MO', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(27, 1, 223, 0, 'Montana', 'MOT', 'MT', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(28, 1, 223, 0, 'Nebraska', 'NEB', 'NE', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(29, 1, 223, 0, 'Nevada', 'NEV', 'NV', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(30, 1, 223, 0, 'New Hampshire', 'NEH', 'NH', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(31, 1, 223, 0, 'New Jersey', 'NEJ', 'NJ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(32, 1, 223, 0, 'New Mexico', 'NEM', 'NM', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(33, 1, 223, 0, 'New York', 'NEY', 'NY', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(34, 1, 223, 0, 'North Carolina', 'NOC', 'NC', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(35, 1, 223, 0, 'North Dakota', 'NOD', 'ND', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(36, 1, 223, 0, 'Ohio', 'OHI', 'OH', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(37, 1, 223, 0, 'Oklahoma', 'OKL', 'OK', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(38, 1, 223, 0, 'Oregon', 'ORN', 'OR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(39, 1, 223, 0, 'Pennsylvania', 'PEA', 'PA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(40, 1, 223, 0, 'Rhode Island', 'RHI', 'RI', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(41, 1, 223, 0, 'South Carolina', 'SOC', 'SC', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(42, 1, 223, 0, 'South Dakota', 'SOD', 'SD', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(43, 1, 223, 0, 'Tennessee', 'TEN', 'TN', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(44, 1, 223, 0, 'Texas', 'TXS', 'TX', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(45, 1, 223, 0, 'Utah', 'UTA', 'UT', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(46, 1, 223, 0, 'Vermont', 'VMT', 'VT', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(47, 1, 223, 0, 'Virginia', 'VIA', 'VA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(48, 1, 223, 0, 'Washington', 'WAS', 'WA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(49, 1, 223, 0, 'West Virginia', 'WEV', 'WV', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(50, 1, 223, 0, 'Wisconsin', 'WIS', 'WI', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(51, 1, 223, 0, 'Wyoming', 'WYO', 'WY', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(52, 1, 38, 0, 'Alberta', 'ALB', 'AB', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(53, 1, 38, 0, 'British Columbia', 'BRC', 'BC', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(54, 1, 38, 0, 'Manitoba', 'MAB', 'MB', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(55, 1, 38, 0, 'New Brunswick', 'NEB', 'NB', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(56, 1, 38, 0, 'Newfoundland and Labrador', 'NFL', 'NL', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(57, 1, 38, 0, 'Northwest Territories', 'NWT', 'NT', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(58, 1, 38, 0, 'Nova Scotia', 'NOS', 'NS', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(59, 1, 38, 0, 'Nunavut', 'NUT', 'NU', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(60, 1, 38, 0, 'Ontario', 'ONT', 'ON', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(61, 1, 38, 0, 'Prince Edward Island', 'PEI', 'PE', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(62, 1, 38, 0, 'Quebec', 'QEC', 'QC', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(63, 1, 38, 0, 'Saskatchewan', 'SAK', 'SK', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(64, 1, 38, 0, 'Yukon', 'YUT', 'YT', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(65, 1, 222, 0, 'England', 'ENG', 'EN', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(66, 1, 222, 0, 'Northern Ireland', 'NOI', 'NI', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(67, 1, 222, 0, 'Scotland', 'SCO', 'SD', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(68, 1, 222, 0, 'Wales', 'WLS', 'WS', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(69, 1, 13, 0, 'Australian Capital Territory', 'ACT', 'AC', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(70, 1, 13, 0, 'New South Wales', 'NSW', 'NS', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(71, 1, 13, 0, 'Northern Territory', 'NOT', 'NT', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(72, 1, 13, 0, 'Queensland', 'QLD', 'QL', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(73, 1, 13, 0, 'South Australia', 'SOA', 'SA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(74, 1, 13, 0, 'Tasmania', 'TAS', 'TS', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(75, 1, 13, 0, 'Victoria', 'VIC', 'VI', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(76, 1, 13, 0, 'Western Australia', 'WEA', 'WA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(77, 1, 138, 0, 'Aguascalientes', 'AGS', 'AG', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(78, 1, 138, 0, 'Baja California Norte', 'BCN', 'BN', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(79, 1, 138, 0, 'Baja California Sur', 'BCS', 'BS', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(80, 1, 138, 0, 'Campeche', 'CAM', 'CA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(81, 1, 138, 0, 'Chiapas', 'CHI', 'CS', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(82, 1, 138, 0, 'Chihuahua', 'CHA', 'CH', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(83, 1, 138, 0, 'Coahuila', 'COA', 'CO', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(84, 1, 138, 0, 'Colima', 'COL', 'CM', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(85, 1, 138, 0, 'Distrito Federal', 'DFM', 'DF', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(86, 1, 138, 0, 'Durango', 'DGO', 'DO', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(87, 1, 138, 0, 'Guanajuato', 'GTO', 'GO', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(88, 1, 138, 0, 'Guerrero', 'GRO', 'GU', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(89, 1, 138, 0, 'Hidalgo', 'HGO', 'HI', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(90, 1, 138, 0, 'Jalisco', 'JAL', 'JA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(91, 1, 138, 0, 'M', 'EDM', 'EM', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(92, 1, 138, 0, 'Michoac', 'MCN', 'MI', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(93, 1, 138, 0, 'Morelos', 'MOR', 'MO', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(94, 1, 138, 0, 'Nayarit', 'NAY', 'NY', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(95, 1, 138, 0, 'Nuevo Le', 'NUL', 'NL', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(96, 1, 138, 0, 'Oaxaca', 'OAX', 'OA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(97, 1, 138, 0, 'Puebla', 'PUE', 'PU', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(98, 1, 138, 0, 'Quer', 'QRO', 'QU', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(99, 1, 138, 0, 'Quintana Roo', 'QUR', 'QR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(100, 1, 138, 0, 'San Luis Potos', 'SLP', 'SP', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(101, 1, 138, 0, 'Sinaloa', 'SIN', 'SI', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(102, 1, 138, 0, 'Sonora', 'SON', 'SO', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(103, 1, 138, 0, 'Tabasco', 'TAB', 'TA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(104, 1, 138, 0, 'Tamaulipas', 'TAM', 'TM', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(105, 1, 138, 0, 'Tlaxcala', 'TLX', 'TX', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(106, 1, 138, 0, 'Veracruz', 'VER', 'VZ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(107, 1, 138, 0, 'Yucat', 'YUC', 'YU', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(108, 1, 138, 0, 'Zacatecas', 'ZAC', 'ZA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(109, 1, 30, 0, 'Acre', 'ACR', 'AC', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(110, 1, 30, 0, 'Alagoas', 'ALG', 'AL', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(111, 1, 30, 0, 'Amapá', 'AMP', 'AP', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(112, 1, 30, 0, 'Amazonas', 'AMZ', 'AM', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(113, 1, 30, 0, 'Bahía', 'BAH', 'BA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(114, 1, 30, 0, 'Ceará', 'CEA', 'CE', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(115, 1, 30, 0, 'Distrito Federal', 'DFB', 'DF', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(116, 1, 30, 0, 'Espírito Santo', 'ESS', 'ES', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(117, 1, 30, 0, 'Goiás', 'GOI', 'GO', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(118, 1, 30, 0, 'Maranhão', 'MAR', 'MA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(119, 1, 30, 0, 'Mato Grosso', 'MAT', 'MT', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(120, 1, 30, 0, 'Mato Grosso do Sul', 'MGS', 'MS', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(121, 1, 30, 0, 'Minas Gerais', 'MIG', 'MG', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(122, 1, 30, 0, 'Paraná', 'PAR', 'PR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(123, 1, 30, 0, 'Paraíba', 'PRB', 'PB', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(124, 1, 30, 0, 'Pará', 'PAB', 'PA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(125, 1, 30, 0, 'Pernambuco', 'PER', 'PE', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(126, 1, 30, 0, 'Piauí', 'PIA', 'PI', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(127, 1, 30, 0, 'Rio Grande do Norte', 'RGN', 'RN', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(128, 1, 30, 0, 'Rio Grande do Sul', 'RGS', 'RS', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(129, 1, 30, 0, 'Rio de Janeiro', 'RDJ', 'RJ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(130, 1, 30, 0, 'Rondônia', 'RON', 'RO', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(131, 1, 30, 0, 'Roraima', 'ROR', 'RR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(132, 1, 30, 0, 'Santa Catarina', 'SAC', 'SC', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(133, 1, 30, 0, 'Sergipe', 'SER', 'SE', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(134, 1, 30, 0, 'São Paulo', 'SAP', 'SP', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(135, 1, 30, 0, 'Tocantins', 'TOC', 'TO', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(136, 1, 44, 0, 'Anhui', 'ANH', '34', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(137, 1, 44, 0, 'Beijing', 'BEI', '11', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(138, 1, 44, 0, 'Chongqing', 'CHO', '50', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(139, 1, 44, 0, 'Fujian', 'FUJ', '35', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(140, 1, 44, 0, 'Gansu', 'GAN', '62', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(141, 1, 44, 0, 'Guangdong', 'GUA', '44', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(142, 1, 44, 0, 'Guangxi Zhuang', 'GUZ', '45', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(143, 1, 44, 0, 'Guizhou', 'GUI', '52', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(144, 1, 44, 0, 'Hainan', 'HAI', '46', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(145, 1, 44, 0, 'Hebei', 'HEB', '13', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(146, 1, 44, 0, 'Heilongjiang', 'HEI', '23', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(147, 1, 44, 0, 'Henan', 'HEN', '41', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(148, 1, 44, 0, 'Hubei', 'HUB', '42', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(149, 1, 44, 0, 'Hunan', 'HUN', '43', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(150, 1, 44, 0, 'Jiangsu', 'JIA', '32', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(151, 1, 44, 0, 'Jiangxi', 'JIX', '36', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(152, 1, 44, 0, 'Jilin', 'JIL', '22', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(153, 1, 44, 0, 'Liaoning', 'LIA', '21', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(154, 1, 44, 0, 'Nei Mongol', 'NML', '15', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(155, 1, 44, 0, 'Ningxia Hui', 'NIH', '64', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(156, 1, 44, 0, 'Qinghai', 'QIN', '63', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(157, 1, 44, 0, 'Shandong', 'SNG', '37', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(158, 1, 44, 0, 'Shanghai', 'SHH', '31', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(159, 1, 44, 0, 'Shaanxi', 'SHX', '61', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(160, 1, 44, 0, 'Sichuan', 'SIC', '51', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(161, 1, 44, 0, 'Tianjin', 'TIA', '12', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(162, 1, 44, 0, 'Xinjiang Uygur', 'XIU', '65', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(163, 1, 44, 0, 'Xizang', 'XIZ', '54', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(164, 1, 44, 0, 'Yunnan', 'YUN', '53', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(165, 1, 44, 0, 'Zhejiang', 'ZHE', '33', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(166, 1, 104, 0, 'Israel', 'ISL', 'IL', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(167, 1, 104, 0, 'Gaza Strip', 'GZS', 'GZ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(168, 1, 104, 0, 'West Bank', 'WBK', 'WB', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(169, 1, 151, 0, 'St. Maarten', 'STM', 'SM', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(170, 1, 151, 0, 'Bonaire', 'BNR', 'BN', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(171, 1, 151, 0, 'Curacao', 'CUR', 'CR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(172, 1, 175, 0, 'Alba', 'ABA', 'AB', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(173, 1, 175, 0, 'Arad', 'ARD', 'AR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(174, 1, 175, 0, 'Arges', 'ARG', 'AG', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(175, 1, 175, 0, 'Bacau', 'BAC', 'BC', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(176, 1, 175, 0, 'Bihor', 'BIH', 'BH', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(177, 1, 175, 0, 'Bistrita-Nasaud', 'BIS', 'BN', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(178, 1, 175, 0, 'Botosani', 'BOT', 'BT', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(179, 1, 175, 0, 'Braila', 'BRL', 'BR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(180, 1, 175, 0, 'Brasov', 'BRA', 'BV', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(181, 1, 175, 0, 'Bucuresti', 'BUC', 'B', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(182, 1, 175, 0, 'Buzau', 'BUZ', 'BZ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(183, 1, 175, 0, 'Calarasi', 'CAL', 'CL', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(184, 1, 175, 0, 'Caras Severin', 'CRS', 'CS', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(185, 1, 175, 0, 'Cluj', 'CLJ', 'CJ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(186, 1, 175, 0, 'Constanta', 'CST', 'CT', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(187, 1, 175, 0, 'Covasna', 'COV', 'CV', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(188, 1, 175, 0, 'Dambovita', 'DAM', 'DB', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(189, 1, 175, 0, 'Dolj', 'DLJ', 'DJ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(190, 1, 175, 0, 'Galati', 'GAL', 'GL', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(191, 1, 175, 0, 'Giurgiu', 'GIU', 'GR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(192, 1, 175, 0, 'Gorj', 'GOR', 'GJ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(193, 1, 175, 0, 'Hargita', 'HRG', 'HR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(194, 1, 175, 0, 'Hunedoara', 'HUN', 'HD', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(195, 1, 175, 0, 'Ialomita', 'IAL', 'IL', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(196, 1, 175, 0, 'Iasi', 'IAS', 'IS', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(197, 1, 175, 0, 'Ilfov', 'ILF', 'IF', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(198, 1, 175, 0, 'Maramures', 'MAR', 'MM', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(199, 1, 175, 0, 'Mehedinti', 'MEH', 'MH', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(200, 1, 175, 0, 'Mures', 'MUR', 'MS', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(201, 1, 175, 0, 'Neamt', 'NEM', 'NT', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(202, 1, 175, 0, 'Olt', 'OLT', 'OT', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(203, 1, 175, 0, 'Prahova', 'PRA', 'PH', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(204, 1, 175, 0, 'Salaj', 'SAL', 'SJ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(205, 1, 175, 0, 'Satu Mare', 'SAT', 'SM', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(206, 1, 175, 0, 'Sibiu', 'SIB', 'SB', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(207, 1, 175, 0, 'Suceava', 'SUC', 'SV', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(208, 1, 175, 0, 'Teleorman', 'TEL', 'TR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(209, 1, 175, 0, 'Timis', 'TIM', 'TM', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(210, 1, 175, 0, 'Tulcea', 'TUL', 'TL', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(211, 1, 175, 0, 'Valcea', 'VAL', 'VL', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(212, 1, 175, 0, 'Vaslui', 'VAS', 'VS', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(213, 1, 175, 0, 'Vrancea', 'VRA', 'VN', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(214, 1, 105, 0, 'Agrigento', 'AGR', 'AG', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(215, 1, 105, 0, 'Alessandria', 'ALE', 'AL', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(216, 1, 105, 0, 'Ancona', 'ANC', 'AN', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(217, 1, 105, 0, 'Aosta', 'AOS', 'AO', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(218, 1, 105, 0, 'Arezzo', 'ARE', 'AR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(219, 1, 105, 0, 'Ascoli Piceno', 'API', 'AP', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(220, 1, 105, 0, 'Asti', 'AST', 'AT', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(221, 1, 105, 0, 'Avellino', 'AVE', 'AV', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(222, 1, 105, 0, 'Bari', 'BAR', 'BA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(223, 1, 105, 0, 'Belluno', 'BEL', 'BL', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(224, 1, 105, 0, 'Benevento', 'BEN', 'BN', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(225, 1, 105, 0, 'Bergamo', 'BEG', 'BG', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(226, 1, 105, 0, 'Biella', 'BIE', 'BI', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(227, 1, 105, 0, 'Bologna', 'BOL', 'BO', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(228, 1, 105, 0, 'Bolzano', 'BOZ', 'BZ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(229, 1, 105, 0, 'Brescia', 'BRE', 'BS', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(230, 1, 105, 0, 'Brindisi', 'BRI', 'BR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(231, 1, 105, 0, 'Cagliari', 'CAG', 'CA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(232, 1, 105, 0, 'Caltanissetta', 'CAL', 'CL', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(233, 1, 105, 0, 'Campobasso', 'CBO', 'CB', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(234, 1, 105, 0, 'Carbonia-Iglesias', 'CAR', 'CI', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(235, 1, 105, 0, 'Caserta', 'CAS', 'CE', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(236, 1, 105, 0, 'Catania', 'CAT', 'CT', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(237, 1, 105, 0, 'Catanzaro', 'CTZ', 'CZ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(238, 1, 105, 0, 'Chieti', 'CHI', 'CH', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(239, 1, 105, 0, 'Como', 'COM', 'CO', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(240, 1, 105, 0, 'Cosenza', 'COS', 'CS', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(241, 1, 105, 0, 'Cremona', 'CRE', 'CR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(242, 1, 105, 0, 'Crotone', 'CRO', 'KR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(243, 1, 105, 0, 'Cuneo', 'CUN', 'CN', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(244, 1, 105, 0, 'Enna', 'ENN', 'EN', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(245, 1, 105, 0, 'Ferrara', 'FER', 'FE', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(246, 1, 105, 0, 'Firenze', 'FIR', 'FI', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(247, 1, 105, 0, 'Foggia', 'FOG', 'FG', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(248, 1, 105, 0, 'Forli-Cesena', 'FOC', 'FC', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(249, 1, 105, 0, 'Frosinone', 'FRO', 'FR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(250, 1, 105, 0, 'Genova', 'GEN', 'GE', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(251, 1, 105, 0, 'Gorizia', 'GOR', 'GO', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(252, 1, 105, 0, 'Grosseto', 'GRO', 'GR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(253, 1, 105, 0, 'Imperia', 'IMP', 'IM', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(254, 1, 105, 0, 'Isernia', 'ISE', 'IS', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(255, 1, 105, 0, 'L''Aquila', 'AQU', 'AQ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(256, 1, 105, 0, 'La Spezia', 'LAS', 'SP', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(257, 1, 105, 0, 'Latina', 'LAT', 'LT', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(258, 1, 105, 0, 'Lecce', 'LEC', 'LE', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(259, 1, 105, 0, 'Lecco', 'LCC', 'LC', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(260, 1, 105, 0, 'Livorno', 'LIV', 'LI', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(261, 1, 105, 0, 'Lodi', 'LOD', 'LO', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(262, 1, 105, 0, 'Lucca', 'LUC', 'LU', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(263, 1, 105, 0, 'Macerata', 'MAC', 'MC', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(264, 1, 105, 0, 'Mantova', 'MAN', 'MN', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(265, 1, 105, 0, 'Massa-Carrara', 'MAS', 'MS', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(266, 1, 105, 0, 'Matera', 'MAA', 'MT', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(267, 1, 105, 0, 'Medio Campidano', 'MED', 'VS', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(268, 1, 105, 0, 'Messina', 'MES', 'ME', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(269, 1, 105, 0, 'Milano', 'MIL', 'MI', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(270, 1, 105, 0, 'Modena', 'MOD', 'MO', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(271, 1, 105, 0, 'Napoli', 'NAP', 'NA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(272, 1, 105, 0, 'Novara', 'NOV', 'NO', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(273, 1, 105, 0, 'Nuoro', 'NUR', 'NU', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(274, 1, 105, 0, 'Ogliastra', 'OGL', 'OG', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(275, 1, 105, 0, 'Olbia-Tempio', 'OLB', 'OT', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(276, 1, 105, 0, 'Oristano', 'ORI', 'OR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(277, 1, 105, 0, 'Padova', 'PDA', 'PD', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(278, 1, 105, 0, 'Palermo', 'PAL', 'PA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(279, 1, 105, 0, 'Parma', 'PAA', 'PR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(280, 1, 105, 0, 'Pavia', 'PAV', 'PV', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(281, 1, 105, 0, 'Perugia', 'PER', 'PG', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(282, 1, 105, 0, 'Pesaro e Urbino', 'PES', 'PU', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(283, 1, 105, 0, 'Pescara', 'PSC', 'PE', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(284, 1, 105, 0, 'Piacenza', 'PIA', 'PC', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(285, 1, 105, 0, 'Pisa', 'PIS', 'PI', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(286, 1, 105, 0, 'Pistoia', 'PIT', 'PT', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(287, 1, 105, 0, 'Pordenone', 'POR', 'PN', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(288, 1, 105, 0, 'Potenza', 'PTZ', 'PZ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(289, 1, 105, 0, 'Prato', 'PRA', 'PO', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(290, 1, 105, 0, 'Ragusa', 'RAG', 'RG', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(291, 1, 105, 0, 'Ravenna', 'RAV', 'RA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(292, 1, 105, 0, 'Reggio Calabria', 'REG', 'RC', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(293, 1, 105, 0, 'Reggio Emilia', 'REE', 'RE', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(294, 1, 105, 0, 'Rieti', 'RIE', 'RI', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(295, 1, 105, 0, 'Rimini', 'RIM', 'RN', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(296, 1, 105, 0, 'Roma', 'ROM', 'RM', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(297, 1, 105, 0, 'Rovigo', 'ROV', 'RO', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(298, 1, 105, 0, 'Salerno', 'SAL', 'SA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(299, 1, 105, 0, 'Sassari', 'SAS', 'SS', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(300, 1, 105, 0, 'Savona', 'SAV', 'SV', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(301, 1, 105, 0, 'Siena', 'SIE', 'SI', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(302, 1, 105, 0, 'Siracusa', 'SIR', 'SR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(303, 1, 105, 0, 'Sondrio', 'SOO', 'SO', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(304, 1, 105, 0, 'Taranto', 'TAR', 'TA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(305, 1, 105, 0, 'Teramo', 'TER', 'TE', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(306, 1, 105, 0, 'Terni', 'TRN', 'TR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(307, 1, 105, 0, 'Torino', 'TOR', 'TO', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(308, 1, 105, 0, 'Trapani', 'TRA', 'TP', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(309, 1, 105, 0, 'Trento', 'TRE', 'TN', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(310, 1, 105, 0, 'Treviso', 'TRV', 'TV', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(311, 1, 105, 0, 'Trieste', 'TRI', 'TS', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(312, 1, 105, 0, 'Udine', 'UDI', 'UD', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(313, 1, 105, 0, 'Varese', 'VAR', 'VA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(314, 1, 105, 0, 'Venezia', 'VEN', 'VE', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(315, 1, 105, 0, 'Verbano Cusio Ossola', 'VCO', 'VB', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(316, 1, 105, 0, 'Vercelli', 'VER', 'VC', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(317, 1, 105, 0, 'Verona', 'VRN', 'VR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(318, 1, 105, 0, 'Vibo Valenzia', 'VIV', 'VV', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(319, 1, 105, 0, 'Vicenza', 'VII', 'VI', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(320, 1, 105, 0, 'Viterbo', 'VIT', 'VT', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(321, 1, 195, 0, 'A Coru', 'ACO', '15', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(322, 1, 195, 0, 'Alava', 'ALA', '01', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(323, 1, 195, 0, 'Albacete', 'ALB', '02', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(324, 1, 195, 0, 'Alicante', 'ALI', '03', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(325, 1, 195, 0, 'Almeria', 'ALM', '04', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(326, 1, 195, 0, 'Asturias', 'AST', '33', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(327, 1, 195, 0, 'Avila', 'AVI', '05', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(328, 1, 195, 0, 'Badajoz', 'BAD', '06', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(329, 1, 195, 0, 'Baleares', 'BAL', '07', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(330, 1, 195, 0, 'Barcelona', 'BAR', '08', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(331, 1, 195, 0, 'Burgos', 'BUR', '09', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(332, 1, 195, 0, 'Caceres', 'CAC', '10', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(333, 1, 195, 0, 'Cadiz', 'CAD', '11', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(334, 1, 195, 0, 'Cantabria', 'CAN', '39', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(335, 1, 195, 0, 'Castellon', 'CAS', '12', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(336, 1, 195, 0, 'Ceuta', 'CEU', '51', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(337, 1, 195, 0, 'Ciudad Real', 'CIU', '13', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(338, 1, 195, 0, 'Cordoba', 'COR', '14', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(339, 1, 195, 0, 'Cuenca', 'CUE', '16', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(340, 1, 195, 0, 'Girona', 'GIR', '17', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(341, 1, 195, 0, 'Granada', 'GRA', '18', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(342, 1, 195, 0, 'Guadalajara', 'GUA', '19', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(343, 1, 195, 0, 'Guipuzcoa', 'GUI', '20', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(344, 1, 195, 0, 'Huelva', 'HUL', '21', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(345, 1, 195, 0, 'Huesca', 'HUS', '22', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(346, 1, 195, 0, 'Jaen', 'JAE', '23', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(347, 1, 195, 0, 'La Rioja', 'LRI', '26', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(348, 1, 195, 0, 'Las Palmas', 'LPA', '35', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(349, 1, 195, 0, 'Leon', 'LEO', '24', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(350, 1, 195, 0, 'Lleida', 'LLE', '25', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(351, 1, 195, 0, 'Lugo', 'LUG', '27', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(352, 1, 195, 0, 'Madrid', 'MAD', '28', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(353, 1, 195, 0, 'Malaga', 'MAL', '29', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(354, 1, 195, 0, 'Melilla', 'MEL', '52', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(355, 1, 195, 0, 'Murcia', 'MUR', '30', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(356, 1, 195, 0, 'Navarra', 'NAV', '31', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(357, 1, 195, 0, 'Ourense', 'OUR', '32', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(358, 1, 195, 0, 'Palencia', 'PAL', '34', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(359, 1, 195, 0, 'Pontevedra', 'PON', '36', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(360, 1, 195, 0, 'Salamanca', 'SAL', '37', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(361, 1, 195, 0, 'Santa Cruz de Tenerife', 'SCT', '38', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(362, 1, 195, 0, 'Segovia', 'SEG', '40', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(363, 1, 195, 0, 'Sevilla', 'SEV', '41', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(364, 1, 195, 0, 'Soria', 'SOR', '42', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(365, 1, 195, 0, 'Tarragona', 'TAR', '43', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(366, 1, 195, 0, 'Teruel', 'TER', '44', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(367, 1, 195, 0, 'Toledo', 'TOL', '45', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(368, 1, 195, 0, 'Valencia', 'VAL', '46', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(369, 1, 195, 0, 'Valladolid', 'VLL', '47', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(370, 1, 195, 0, 'Vizcaya', 'VIZ', '48', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(371, 1, 195, 0, 'Zamora', 'ZAM', '49', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(372, 1, 195, 0, 'Zaragoza', 'ZAR', '50', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(373, 1, 10, 0, 'Buenos Aires', 'BAS', 'BA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(374, 1, 10, 0, 'Ciudad Autonoma De Buenos Aires', 'CBA', 'CB', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(375, 1, 10, 0, 'Catamarca', 'CAT', 'CA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(376, 1, 10, 0, 'Chaco', 'CHO', 'CH', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(377, 1, 10, 0, 'Chubut', 'CTT', 'CT', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(378, 1, 10, 0, 'Cordoba', 'COD', 'CO', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(379, 1, 10, 0, 'Corrientes', 'CRI', 'CR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(380, 1, 10, 0, 'Entre Rios', 'ERS', 'ER', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(381, 1, 10, 0, 'Formosa', 'FRM', 'FR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(382, 1, 10, 0, 'Jujuy', 'JUJ', 'JU', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(383, 1, 10, 0, 'La Pampa', 'LPM', 'LP', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(384, 1, 10, 0, 'La Rioja', 'LRI', 'LR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(385, 1, 10, 0, 'Mendoza', 'MED', 'ME', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(386, 1, 10, 0, 'Misiones', 'MIS', 'MI', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(387, 1, 10, 0, 'Neuquen', 'NQU', 'NQ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(388, 1, 10, 0, 'Rio Negro', 'RNG', 'RN', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(389, 1, 10, 0, 'Salta', 'SAL', 'SA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);
INSERT INTO `jos_virtuemart_states` (`virtuemart_state_id`, `virtuemart_vendor_id`, `virtuemart_country_id`, `virtuemart_worldzone_id`, `state_name`, `state_3_code`, `state_2_code`, `ordering`, `shared`, `published`, `created_on`, `created_by`, `modified_on`, `modified_by`, `locked_on`, `locked_by`) VALUES
(390, 1, 10, 0, 'San Juan', 'SJN', 'SJ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(391, 1, 10, 0, 'San Luis', 'SLU', 'SL', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(392, 1, 10, 0, 'Santa Cruz', 'SCZ', 'SC', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(393, 1, 10, 0, 'Santa Fe', 'SFE', 'SF', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(394, 1, 10, 0, 'Santiago Del Estero', 'SEN', 'SE', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(395, 1, 10, 0, 'Tierra Del Fuego', 'TFE', 'TF', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(396, 1, 10, 0, 'Tucuman', 'TUC', 'TU', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(397, 1, 11, 0, 'Aragatsotn', 'ARG', 'AG', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(398, 1, 11, 0, 'Ararat', 'ARR', 'AR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(399, 1, 11, 0, 'Armavir', 'ARM', 'AV', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(400, 1, 11, 0, 'Gegharkunik', 'GEG', 'GR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(401, 1, 11, 0, 'Kotayk', 'KOT', 'KT', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(402, 1, 11, 0, 'Lori', 'LOR', 'LO', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(403, 1, 11, 0, 'Shirak', 'SHI', 'SH', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(404, 1, 11, 0, 'Syunik', 'SYU', 'SU', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(405, 1, 11, 0, 'Tavush', 'TAV', 'TV', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(406, 1, 11, 0, 'Vayots-Dzor', 'VAD', 'VD', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(407, 1, 11, 0, 'Yerevan', 'YER', 'ER', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(408, 1, 99, 0, 'Andaman & Nicobar Islands', 'ANI', 'AI', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(409, 1, 99, 0, 'Andhra Pradesh', 'AND', 'AN', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(410, 1, 99, 0, 'Arunachal Pradesh', 'ARU', 'AR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(411, 1, 99, 0, 'Assam', 'ASS', 'AS', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(412, 1, 99, 0, 'Bihar', 'BIH', 'BI', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(413, 1, 99, 0, 'Chandigarh', 'CHA', 'CA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(414, 1, 99, 0, 'Chhatisgarh', 'CHH', 'CH', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(415, 1, 99, 0, 'Dadra & Nagar Haveli', 'DAD', 'DD', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(416, 1, 99, 0, 'Daman & Diu', 'DAM', 'DA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(417, 1, 99, 0, 'Delhi', 'DEL', 'DE', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(418, 1, 99, 0, 'Goa', 'GOA', 'GO', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(419, 1, 99, 0, 'Gujarat', 'GUJ', 'GU', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(420, 1, 99, 0, 'Haryana', 'HAR', 'HA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(421, 1, 99, 0, 'Himachal Pradesh', 'HIM', 'HI', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(422, 1, 99, 0, 'Jammu & Kashmir', 'JAM', 'JA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(423, 1, 99, 0, 'Jharkhand', 'JHA', 'JH', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(424, 1, 99, 0, 'Karnataka', 'KAR', 'KA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(425, 1, 99, 0, 'Kerala', 'KER', 'KE', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(426, 1, 99, 0, 'Lakshadweep', 'LAK', 'LA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(427, 1, 99, 0, 'Madhya Pradesh', 'MAD', 'MD', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(428, 1, 99, 0, 'Maharashtra', 'MAH', 'MH', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(429, 1, 99, 0, 'Manipur', 'MAN', 'MN', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(430, 1, 99, 0, 'Meghalaya', 'MEG', 'ME', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(431, 1, 99, 0, 'Mizoram', 'MIZ', 'MI', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(432, 1, 99, 0, 'Nagaland', 'NAG', 'NA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(433, 1, 99, 0, 'Orissa', 'ORI', 'OR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(434, 1, 99, 0, 'Pondicherry', 'PON', 'PO', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(435, 1, 99, 0, 'Punjab', 'PUN', 'PU', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(436, 1, 99, 0, 'Rajasthan', 'RAJ', 'RA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(437, 1, 99, 0, 'Sikkim', 'SIK', 'SI', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(438, 1, 99, 0, 'Tamil Nadu', 'TAM', 'TA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(439, 1, 99, 0, 'Tripura', 'TRI', 'TR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(440, 1, 99, 0, 'Uttaranchal', 'UAR', 'UA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(441, 1, 99, 0, 'Uttar Pradesh', 'UTT', 'UT', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(442, 1, 99, 0, 'West Bengal', 'WES', 'WE', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(443, 1, 101, 0, 'Ahmadi va Kohkiluyeh', 'BOK', 'BO', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(444, 1, 101, 0, 'Ardabil', 'ARD', 'AR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(445, 1, 101, 0, 'Azarbayjan-e Gharbi', 'AZG', 'AG', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(446, 1, 101, 0, 'Azarbayjan-e Sharqi', 'AZS', 'AS', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(447, 1, 101, 0, 'Bushehr', 'BUS', 'BU', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(448, 1, 101, 0, 'Chaharmahal va Bakhtiari', 'CMB', 'CM', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(449, 1, 101, 0, 'Esfahan', 'ESF', 'ES', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(450, 1, 101, 0, 'Fars', 'FAR', 'FA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(451, 1, 101, 0, 'Gilan', 'GIL', 'GI', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(452, 1, 101, 0, 'Gorgan', 'GOR', 'GO', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(453, 1, 101, 0, 'Hamadan', 'HAM', 'HA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(454, 1, 101, 0, 'Hormozgan', 'HOR', 'HO', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(455, 1, 101, 0, 'Ilam', 'ILA', 'IL', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(456, 1, 101, 0, 'Kerman', 'KER', 'KE', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(457, 1, 101, 0, 'Kermanshah', 'BAK', 'BA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(458, 1, 101, 0, 'Khorasan-e Junoubi', 'KHJ', 'KJ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(459, 1, 101, 0, 'Khorasan-e Razavi', 'KHR', 'KR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(460, 1, 101, 0, 'Khorasan-e Shomali', 'KHS', 'KS', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(461, 1, 101, 0, 'Khuzestan', 'KHU', 'KH', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(462, 1, 101, 0, 'Kordestan', 'KOR', 'KO', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(463, 1, 101, 0, 'Lorestan', 'LOR', 'LO', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(464, 1, 101, 0, 'Markazi', 'MAR', 'MR', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(465, 1, 101, 0, 'Mazandaran', 'MAZ', 'MZ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(466, 1, 101, 0, 'Qazvin', 'QAS', 'QA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(467, 1, 101, 0, 'Qom', 'QOM', 'QO', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(468, 1, 101, 0, 'Semnan', 'SEM', 'SE', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(469, 1, 101, 0, 'Sistan va Baluchestan', 'SBA', 'SB', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(470, 1, 101, 0, 'Tehran', 'TEH', 'TE', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(471, 1, 101, 0, 'Yazd', 'YAZ', 'YA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(472, 1, 101, 0, 'Zanjan', 'ZAN', 'ZA', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(535, 1, 84, 0, 'ΛΕΥΚΑΔΑΣ', 'ΛΕΥ', 'ΛΕ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(532, 1, 84, 0, 'ΛΑΡΙΣΑΣ', 'ΛΑΡ', 'ΛΡ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(504, 1, 84, 0, 'ΑΡΚΑΔΙΑΣ', 'ΑΡΚ', 'ΑΚ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(503, 1, 84, 0, 'ΑΡΓΟΛΙΔΑΣ', 'ΑΡΓ', 'ΑΡ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(533, 1, 84, 0, 'ΛΑΣΙΘΙΟΥ', 'ΛΑΣ', 'ΛΑ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(534, 1, 84, 0, 'ΛΕΣΒΟΥ', 'ΛΕΣ', 'ΛΣ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(530, 1, 84, 0, 'ΚΥΚΛΑΔΩΝ', 'ΚΥΚ', 'ΚΥ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(553, 1, 84, 0, 'ΑΙΤΩΛΟΑΚΑΡΝΑΝΙΑΣ', 'ΑΙΤ', 'ΑΙ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(529, 1, 84, 0, 'ΚΟΡΙΝΘΙΑΣ', 'ΚΟΡ', 'ΚΟ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(531, 1, 84, 0, 'ΛΑΚΩΝΙΑΣ', 'ΛΑΚ', 'ΛK', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(517, 1, 84, 0, 'ΗΜΑΘΙΑΣ', 'ΗΜΑ', 'ΗΜ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(518, 1, 84, 0, 'ΗΡΑΚΛΕΙΟΥ', 'ΗΡΑ', 'ΗΡ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(519, 1, 84, 0, 'ΘΕΣΠΡΩΤΙΑΣ', 'ΘΕΠ', 'ΘΠ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(520, 1, 84, 0, 'ΘΕΣΣΑΛΟΝΙΚΗΣ', 'ΘΕΣ', 'ΘΕ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(521, 1, 84, 0, 'ΙΩΑΝΝΙΝΩΝ', 'ΙΩΑ', 'ΙΩ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(522, 1, 84, 0, 'ΚΑΒΑΛΑΣ', 'ΚΑΒ', 'ΚΒ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(523, 1, 84, 0, 'ΚΑΡΔΙΤΣΑΣ', 'ΚΑΡ', 'ΚΡ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(524, 1, 84, 0, 'ΚΑΣΤΟΡΙΑΣ', 'ΚΑΣ', 'ΚΣ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(525, 1, 84, 0, 'ΚΕΡΚΥΡΑΣ', 'ΚΕΡ', 'ΚΕ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(526, 1, 84, 0, 'ΚΕΦΑΛΛΗΝΙΑΣ', 'ΚΕΦ', 'ΚΦ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(527, 1, 84, 0, 'ΚΙΛΚΙΣ', 'ΚΙΛ', 'ΚΙ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(528, 1, 84, 0, 'ΚΟΖΑΝΗΣ', 'ΚΟΖ', 'ΚZ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(507, 1, 84, 0, 'ΑΧΑΪΑΣ', 'ΑΧΑ', 'ΑΧ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(508, 1, 84, 0, 'ΒΟΙΩΤΙΑΣ', 'ΒΟΙ', 'ΒΟ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(509, 1, 84, 0, 'ΓΡΕΒΕΝΩΝ', 'ΓΡΕ', 'ΓΡ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(510, 1, 84, 0, 'ΔΡΑΜΑΣ', 'ΔΡΑ', 'ΔΡ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(511, 1, 84, 0, 'ΔΩΔΕΚΑΝΗΣΟΥ', 'ΔΩΔ', 'ΔΩ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(512, 1, 84, 0, 'ΕΒΡΟΥ', 'ΕΒΡ', 'ΕΒ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(513, 1, 84, 0, 'ΕΥΒΟΙΑΣ', 'ΕΥΒ', 'ΕΥ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(514, 1, 84, 0, 'ΕΥΡΥΤΑΝΙΑΣ', 'ΕΥΡ', 'ΕΡ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(515, 1, 84, 0, 'ΖΑΚΥΝΘΟΥ', 'ΖΑΚ', 'ΖΑ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(516, 1, 84, 0, 'ΗΛΕΙΑΣ', 'ΗΛΕ', 'ΗΛ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(505, 1, 84, 0, 'ΑΡΤΑΣ', 'ΑΡΤ', 'ΑΑ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(506, 1, 84, 0, 'ΑΤΤΙΚΗΣ', 'ΑΤΤ', 'ΑΤ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(536, 1, 84, 0, 'ΜΑΓΝΗΣΙΑΣ', 'ΜΑΓ', 'ΜΑ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(537, 1, 84, 0, 'ΜΕΣΣΗΝΙΑΣ', 'ΜΕΣ', 'ΜΕ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(538, 1, 84, 0, 'ΞΑΝΘΗΣ', 'ΞΑΝ', 'ΞΑ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(539, 1, 84, 0, 'ΠΕΛΛΗΣ', 'ΠΕΛ', 'ΠΕ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(540, 1, 84, 0, 'ΠΙΕΡΙΑΣ', 'ΠΙΕ', 'ΠΙ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(541, 1, 84, 0, 'ΠΡΕΒΕΖΑΣ', 'ΠΡΕ', 'ΠΡ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(542, 1, 84, 0, 'ΡΕΘΥΜΝΗΣ', 'ΡΕΘ', 'ΡΕ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(543, 1, 84, 0, 'ΡΟΔΟΠΗΣ', 'ΡΟΔ', 'ΡΟ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(544, 1, 84, 0, 'ΣΑΜΟΥ', 'ΣΑΜ', 'ΣΑ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(545, 1, 84, 0, 'ΣΕΡΡΩΝ', 'ΣΕΡ', 'ΣΕ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(546, 1, 84, 0, 'ΤΡΙΚΑΛΩΝ', 'ΤΡΙ', 'ΤΡ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(547, 1, 84, 0, 'ΦΘΙΩΤΙΔΑΣ', 'ΦΘΙ', 'ΦΘ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(548, 1, 84, 0, 'ΦΛΩΡΙΝΑΣ', 'ΦΛΩ', 'ΦΛ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(549, 1, 84, 0, 'ΦΩΚΙΔΑΣ', 'ΦΩΚ', 'ΦΩ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(550, 1, 84, 0, 'ΧΑΛΚΙΔΙΚΗΣ', 'ΧΑΛ', 'ΧΑ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(551, 1, 84, 0, 'ΧΑΝΙΩΝ', 'ΧΑΝ', 'ΧΝ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(552, 1, 84, 0, 'ΧΙΟΥ', 'ΧΙΟ', 'ΧΙ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(569, 1, 81, 0, 'Schleswig-Holstein', 'SHO', 'SH', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(554, 1, 81, 0, 'Freie und Hansestadt Hamburg', 'HAM', 'HH', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(555, 1, 81, 0, 'Niedersachsen', 'NIS', 'NI', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(556, 1, 81, 0, 'Freie Hansestadt Bremen', 'HBR', 'HB', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(557, 1, 81, 0, 'Nordrhein-Westfalen', 'NRW', 'NW', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(558, 1, 81, 0, 'Hessen', 'HES', 'HE', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(559, 1, 81, 0, 'Rheinland-Pfalz', 'RLP', 'RP', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(560, 1, 81, 0, 'Baden-Württemberg', 'BWÜ', 'BW', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(561, 1, 81, 0, 'Freistaat Bayern', 'BAV', 'BY', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(562, 1, 81, 0, 'Saarland', 'SLA', 'SL', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(563, 1, 81, 0, 'Berlin', 'BER', 'BE', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(564, 1, 81, 0, 'Brandenburg', 'BRB', 'BB', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(565, 1, 81, 0, 'Mecklenburg-Vorpommern', 'MVO', 'MV', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(566, 1, 81, 0, 'Freistaat Sachsen', 'SAC', 'SN', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(567, 1, 81, 0, 'Sachsen-Anhalt', 'SAA', 'ST', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(568, 1, 81, 0, 'Freistaat Thüringen', 'THÜ', 'TH', 0, 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(570, 1, 176, 0, 'Адыгея Республика', 'AD', '01', 1, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(571, 1, 176, 0, 'Алтай Республика', 'AL', '04', 2, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(572, 1, 176, 0, 'Алтайский край', 'ALT', '22', 3, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(573, 1, 176, 0, 'Амурская область', 'AMU', '28', 4, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(574, 1, 176, 0, 'Архангельская область', 'ARK', '29', 5, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(575, 1, 176, 0, 'Астраханская область', 'AST', '30', 6, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(576, 1, 176, 0, 'Башкортостан Республика', 'BA', '02', 7, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(577, 1, 176, 0, 'Белгородская область', 'BEL', '31', 8, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(578, 1, 176, 0, 'Брянская область', 'BRY', '32', 9, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(579, 1, 176, 0, 'Бурятия Республика', 'BU', '03', 10, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(580, 1, 176, 0, 'Владимирская область', 'VLA', '33', 11, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(581, 1, 176, 0, 'Волгоградская область', 'VGG', '34', 12, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(582, 1, 176, 0, 'Вологодская область', 'VLG', '35', 13, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(583, 1, 176, 0, 'Воронежская область', 'VOR', '36', 14, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(584, 1, 176, 0, 'Дагестан Республика', 'DA', '05', 15, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(585, 1, 176, 0, 'Еврейская автономная область', 'YEV', '79', 16, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(586, 1, 176, 0, 'Забайкальский край', 'ZAB', '75', 17, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(587, 1, 176, 0, 'Ивановская область', 'IVA', '37', 18, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(588, 1, 176, 0, 'Ингушетия Республика', 'IN', '06', 19, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(589, 1, 176, 0, 'Иркутская область', 'IRK', '38', 20, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(590, 1, 176, 0, 'Кабардино-Балкарская Республика', 'KB', '07', 21, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(591, 1, 176, 0, 'Калининградская область', 'KGD', '39', 22, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(592, 1, 176, 0, 'Калмыкия Республика', 'KL', '08', 23, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(593, 1, 176, 0, 'Калужская область', 'KLU', '40', 24, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(594, 1, 176, 0, 'Камчатский край', 'KAM', '41', 25, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(595, 1, 176, 0, 'Карачаево-Черкесская Республика', 'KC', '09', 26, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(596, 1, 176, 0, 'Карелия Республика', 'KR', '10', 27, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(597, 1, 176, 0, 'Кемеровская область', 'KEM', '42', 28, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(598, 1, 176, 0, 'Кировская область', 'KIR', '43', 29, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(599, 1, 176, 0, 'Коми Республика', 'KO', '11', 30, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(600, 1, 176, 0, 'Костромская область', 'KOS', '44', 31, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(601, 1, 176, 0, 'Краснодарский край', 'KDA', '23', 32, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(602, 1, 176, 0, 'Красноярский край', 'KIA', '24', 33, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(603, 1, 176, 0, 'Курганская область', 'KGN', '45', 34, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(604, 1, 176, 0, 'Курская область', 'KRS', '46', 35, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(605, 1, 176, 0, 'Ленинградская область', 'LEN', '47', 36, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(606, 1, 176, 0, 'Липецкая область', 'LIP', '48', 37, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(607, 1, 176, 0, 'Магаданская область', 'MAG', '49', 38, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(608, 1, 176, 0, 'Марий Эл Республика', 'ME', '12', 39, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(609, 1, 176, 0, 'Мордовия Республика', 'MO', '13', 40, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(610, 1, 176, 0, 'Москва', 'MOW', '77', 41, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(611, 1, 176, 0, 'Московская область', 'MOS', '50', 42, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(612, 1, 176, 0, 'Мурманская область', 'MUR', '51', 43, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(613, 1, 176, 0, 'Ненецкий автономный округ', 'NEN', '83', 44, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(614, 1, 176, 0, 'Нижегородская область', 'NIZ', '52', 45, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(615, 1, 176, 0, 'Новгородская область', 'NGR', '53', 46, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(616, 1, 176, 0, 'Новосибирская область', 'NVS', '54', 47, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(617, 1, 176, 0, 'Омская область', 'OMS', '55', 48, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(618, 1, 176, 0, 'Оренбургская область', 'ORE', '56', 49, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(619, 1, 176, 0, 'Орловская область', 'ORL', '57', 50, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(620, 1, 176, 0, 'Пензенская область', 'PNZ', '58', 51, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(621, 1, 176, 0, 'Пермский край', 'PER', '59', 52, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(622, 1, 176, 0, 'Приморский край', 'PRI', '25', 53, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(623, 1, 176, 0, 'Псковская область', 'PSK', '60', 54, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(624, 1, 176, 0, 'Ростовская область', 'ROS', '61', 55, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(625, 1, 176, 0, 'Рязанская область', 'RYA', '62', 56, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(626, 1, 176, 0, 'Самарская область', 'SAM', '63', 57, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(627, 1, 176, 0, 'Санкт-Петербург', 'SPE', '78', 58, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(628, 1, 176, 0, 'Саратовская область', 'SAR', '64', 59, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(629, 1, 176, 0, 'Саха (Якутия) Республика', 'SA', '14', 60, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(630, 1, 176, 0, 'Сахалинская область', 'SAK', '65', 61, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(631, 1, 176, 0, 'Свердловская область', 'SVE', '66', 62, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(632, 1, 176, 0, 'Северная Осетия-Алания Республика', 'SE', '15', 63, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(633, 1, 176, 0, 'Смоленская область', 'SMO', '67', 64, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(634, 1, 176, 0, 'Ставропольский край', 'STA', '26', 65, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(635, 1, 176, 0, 'Тамбовская область', 'TAM', '68', 66, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(636, 1, 176, 0, 'Татарстан Республика', 'TA', '16', 67, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(637, 1, 176, 0, 'Тверская область', 'TVE', '69', 68, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(638, 1, 176, 0, 'Томская область', 'TOM', '70', 69, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(639, 1, 176, 0, 'Тульская область', 'TUL', '71', 70, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(640, 1, 176, 0, 'Тыва Республика', 'TY', '17', 71, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(641, 1, 176, 0, 'Тюменская область', 'TYU', '72', 72, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(642, 1, 176, 0, 'Удмуртская Республика', 'UD', '18', 73, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(643, 1, 176, 0, 'Ульяновская область', 'ULY', '73', 74, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(644, 1, 176, 0, 'Хакасия Республика', 'KK', '19', 75, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(645, 1, 176, 0, 'Челябинская область', 'CHE', '74', 76, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(646, 1, 176, 0, 'Чеченская Республика', 'CE', '20', 77, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(647, 1, 176, 0, 'Чувашская Республика', 'CU', '21', 78, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(648, 1, 176, 0, 'Чукотский автономный округ', 'CHU', '87', 79, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(649, 1, 176, 0, 'Хабаровский край', 'KHA', '27', 80, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(650, 1, 176, 0, 'Ханты-Мансийский автономный округ', 'KHM', '86', 81, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(651, 1, 176, 0, 'Ямало-Ненецкий автономный округ', 'YAN', '89', 82, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(652, 1, 176, 0, 'Ярославская область', 'YAR', '76', 83, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(653, 1, 209, 0, 'กระบี่', 'กบ', 'กบ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(654, 1, 209, 0, 'กรุงเทพมหานคร', 'กทม', 'กท', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(655, 1, 209, 0, 'กาญจนบุรี', 'กจ', 'กจ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(656, 1, 209, 0, 'กาฬสินธุ์', 'กส', 'กส', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(657, 1, 209, 0, 'กำแพงเพชร', 'กพ', 'กพ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(658, 1, 209, 0, 'ขอนแก่น', 'ขก', 'ขก', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(659, 1, 209, 0, 'จันทบุรี', 'จบ', 'จบ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(660, 1, 209, 0, 'ฉะเชิงเทรา', 'ฉช', 'ฉช', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(661, 1, 209, 0, 'ชลบุรี', 'ชบ', 'ชบ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(662, 1, 209, 0, 'ชัยนาท', 'ชน', 'ชน', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(663, 1, 209, 0, 'ชัยภูมิ', 'ชย', 'ชย', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(664, 1, 209, 0, 'ชุมพร', 'ชพ', 'ชพ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(665, 1, 209, 0, 'เชียงราย', 'ชร', 'ชร', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(666, 1, 209, 0, 'เชียงใหม่', 'ชม', 'ชม', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(667, 1, 209, 0, 'ตรัง', 'ตง', 'ตง', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(668, 1, 209, 0, 'ตราด', 'ตร', 'ตร', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(669, 1, 209, 0, 'ตาก', 'ตก', 'ตก', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(670, 1, 209, 0, 'นครนายก', 'นย', 'นย', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(671, 1, 209, 0, 'นครปฐม', 'นฐ', 'นฐ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(672, 1, 209, 0, 'นครพนม', 'นพ', 'นพ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(673, 1, 209, 0, 'นครราชสีมา', 'นม', 'นม', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(674, 1, 209, 0, 'นครศรีธรรมราช', 'นศ', 'นศ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(675, 1, 209, 0, 'นครสวรรค์', 'นว', 'นว', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(676, 1, 209, 0, 'นนทบุรี', 'นบ', 'นบ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(677, 1, 209, 0, 'นราธิวาส', 'นธ', 'นธ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(678, 1, 209, 0, 'น่าน', 'นน', 'นน', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(679, 1, 209, 0, 'บุรีรัมย์', 'บร', 'บร', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(680, 1, 209, 0, 'บึงกาฬ', 'บก', 'บก', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(681, 1, 209, 0, 'ปทุมธานี', 'ปท', 'ปท', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(682, 1, 209, 0, 'ประจวบคีรีขันธ์', 'ปข', 'ปข', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(683, 1, 209, 0, 'ปราจีนบุรี', 'ปจ', 'ปจ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(684, 1, 209, 0, 'ปัตตานี', 'ปน', 'ปน', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(685, 1, 209, 0, 'พระนครศรีอยุธยา', 'อย', 'อย', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(686, 1, 209, 0, 'พังงา', 'พง', 'พง', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(687, 1, 209, 0, 'พัทลุง', 'พท', 'พท', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(688, 1, 209, 0, 'พิจิตร', 'พจ', 'พจ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(689, 1, 209, 0, 'พิษณุโลก', 'พล', 'พล', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(690, 1, 209, 0, 'เพชรบุรี', 'พบ', 'พบ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(691, 1, 209, 0, 'เพชรบูรณ์', 'พช', 'พช', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(692, 1, 209, 0, 'แพร่', 'พร', 'พร', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(693, 1, 209, 0, 'พะเยา', 'พย', 'พย', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(694, 1, 209, 0, 'ภูเก็ต', 'ภก', 'ภก', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(695, 1, 209, 0, 'มหาสารคาม', 'มค', 'มค', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(696, 1, 209, 0, 'แม่ฮ่องสอน', 'มส', 'มส', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(697, 1, 209, 0, 'มุกดาหาร', 'มห', 'มห', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(698, 1, 209, 0, 'ยะลา', 'ยล', 'ยล', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(699, 1, 209, 0, 'ยโสธร', 'ยส', 'ยส', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(700, 1, 209, 0, 'ร้อยเอ็ด', 'รอ', 'รอ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(701, 1, 209, 0, 'ระนอง', 'รน', 'รน', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(702, 1, 209, 0, 'ระยอง', 'รย', 'รย', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(703, 1, 209, 0, 'ราชบุรี', 'รบ', 'รบ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(704, 1, 209, 0, 'ลพบุรี', 'ลบ', 'ลบ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(705, 1, 209, 0, 'ลำปาง', 'ลป', 'ลป', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(706, 1, 209, 0, 'ลำพูน', 'ลพ', 'ลพ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(707, 1, 209, 0, 'เลย', 'ลย', 'ลย', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(708, 1, 209, 0, 'ศรีสะเกษ', 'ศก', 'ศก', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(709, 1, 209, 0, 'สกลนคร', 'สน', 'สน', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(710, 1, 209, 0, 'สงขลา', 'สข', 'สข', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(711, 1, 209, 0, 'สตูล', 'สต', 'สต', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(712, 1, 209, 0, 'สมุทรปราการ', 'สป', 'สป', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(713, 1, 209, 0, 'สมุทรสงคราม', 'สส', 'สส', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(714, 1, 209, 0, 'สมุทรสาคร', 'สค', 'สค', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(715, 1, 209, 0, 'สระบุรี', 'สบ', 'สบ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(716, 1, 209, 0, 'สระแก้ว', 'สก', 'สก', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(717, 1, 209, 0, 'สิงห์บุรี', 'สห', 'สห', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(718, 1, 209, 0, 'สุโขทัย', 'สท', 'สท', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(719, 1, 209, 0, 'สุพรรณบุรี', 'สพ', 'สพ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(720, 1, 209, 0, 'สุราษฎร์ธานี', 'สฎ', 'สฎ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(721, 1, 209, 0, 'สุรินทร์', 'สร', 'สร', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(722, 1, 209, 0, 'หนองคาย', 'นค', 'นค', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(723, 1, 209, 0, 'หนองบัวลำภู', 'นภ', 'นภ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(724, 1, 209, 0, 'อ่างทอง', 'อท', 'อท', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(725, 1, 209, 0, 'อุดรธานี', 'อด', 'อด', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(726, 1, 209, 0, 'อุตรดิตถ์', 'อต', 'อต', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(727, 1, 209, 0, 'อุทัยธานี', 'อน', 'อน', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(728, 1, 209, 0, 'อุบลราชธานี', 'อบ', 'อบ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(729, 1, 209, 0, 'อำนาจเจริญ', 'อจ', 'อจ', 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_vendors`
--

DROP TABLE IF EXISTS `jos_virtuemart_vendors`;
CREATE TABLE `jos_virtuemart_vendors` (
  `metarobot` char(20) DEFAULT NULL,
  `metaauthor` char(64) DEFAULT NULL,
  `virtuemart_vendor_id` smallint(1) unsigned NOT NULL AUTO_INCREMENT,
  `vendor_name` char(64) DEFAULT NULL,
  `vendor_currency` int(11) DEFAULT NULL,
  `vendor_accepted_currencies` varchar(1536) NOT NULL DEFAULT '',
  `vendor_params` varchar(17000) DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`virtuemart_vendor_id`),
  KEY `idx_vendor_name` (`vendor_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Vendors manage their products in your store' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jos_virtuemart_vendors`
--

INSERT INTO `jos_virtuemart_vendors` (`metarobot`, `metaauthor`, `virtuemart_vendor_id`, `vendor_name`, `vendor_currency`, `vendor_accepted_currencies`, `vendor_params`, `created_on`, `created_by`, `modified_on`, `modified_by`, `locked_on`, `locked_by`) VALUES
('', '', 1, 'Washupito', 144, '47,144', 'vendor_min_pov="0"|vendor_min_poq=1|vendor_freeshipment=0|vendor_address_format=""|vendor_date_format=""|vendor_letter_format="A4"|vendor_letter_orientation="P"|vendor_letter_margin_top="45"|vendor_letter_margin_left="25"|vendor_letter_margin_right="25"|vendor_letter_margin_bottom="25"|vendor_letter_margin_header="12"|vendor_letter_margin_footer="20"|vendor_letter_font="helvetica"|vendor_letter_font_size="8"|vendor_letter_header_font_size="7"|vendor_letter_footer_font_size="6"|vendor_letter_header="1"|vendor_letter_header_line="1"|vendor_letter_header_line_color="#000000"|vendor_letter_header_image="1"|vendor_letter_header_imagesize="60"|vendor_letter_header_cell_height_ratio="1"|vendor_letter_footer="1"|vendor_letter_footer_line="1"|vendor_letter_footer_line_color="#000000"|vendor_letter_footer_cell_height_ratio="1"|vendor_letter_add_tos="0"|vendor_letter_add_tos_newpage="1"|', '2012-02-13 09:39:25', 0, '2014-03-13 13:55:52', 42, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_vendors_en_gb`
--

DROP TABLE IF EXISTS `jos_virtuemart_vendors_en_gb`;
CREATE TABLE `jos_virtuemart_vendors_en_gb` (
  `virtuemart_vendor_id` int(1) unsigned NOT NULL,
  `vendor_store_desc` text NOT NULL,
  `vendor_terms_of_service` text NOT NULL,
  `vendor_legal_info` text NOT NULL,
  `vendor_letter_css` text NOT NULL,
  `vendor_letter_header_html` varchar(8000) NOT NULL DEFAULT '<h1>{vm:vendorname}</h1><p>{vm:vendoraddress}</p>',
  `vendor_letter_footer_html` varchar(8000) NOT NULL DEFAULT '<p>{vm:vendorlegalinfo}<br />Page {vm:pagenum}/{vm:pagecount}</p>',
  `metadesc` varchar(400) NOT NULL DEFAULT '',
  `metakey` varchar(400) NOT NULL DEFAULT '',
  `customtitle` char(255) NOT NULL DEFAULT '',
  `vendor_store_name` char(180) NOT NULL DEFAULT '',
  `vendor_phone` char(26) NOT NULL DEFAULT '',
  `vendor_url` char(255) NOT NULL DEFAULT '',
  `slug` char(192) NOT NULL DEFAULT '',
  PRIMARY KEY (`virtuemart_vendor_id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_virtuemart_vendors_en_gb`
--

INSERT INTO `jos_virtuemart_vendors_en_gb` (`virtuemart_vendor_id`, `vendor_store_desc`, `vendor_terms_of_service`, `vendor_legal_info`, `vendor_letter_css`, `vendor_letter_header_html`, `vendor_letter_footer_html`, `metadesc`, `metakey`, `customtitle`, `vendor_store_name`, `vendor_phone`, `vendor_url`, `slug`) VALUES
(1, '<p>We have the best tools for do-it-yourselfers.  Check us out! </p> <p>We were established in 1969 in a time when getting good tools was expensive, but the quality was good.  Now that only a select few of those authentic tools survive, we have dedicated this store to bringing the experience alive for collectors and master mechanics everywhere.</p> 		<p>You can easily find products selecting the category you would like to browse above.</p>', '<h5>You haven''t configured any terms of service yet to change this text.</h5>', 'VAT-ID: XYZ-DEMO<br />Reg.Nr: DEMONUMBER', '', '<h1>{vm:vendorname}</h1><p>{vm:vendoraddress}</p>', '<p>{vm:vendorlegalinfo}<br />Page {vm:pagenum}/{vm:pagecount}</p>', '', '', '', 'Washupito''s Tiendita', '555-555-1212', '', 'washupito-s-tiendita');

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_vendor_medias`
--

DROP TABLE IF EXISTS `jos_virtuemart_vendor_medias`;
CREATE TABLE `jos_virtuemart_vendor_medias` (
  `id` smallint(1) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_vendor_id` smallint(1) unsigned NOT NULL DEFAULT '0',
  `virtuemart_media_id` int(1) unsigned NOT NULL DEFAULT '0',
  `ordering` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `i_virtuemart_vendor_id` (`virtuemart_vendor_id`,`virtuemart_media_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jos_virtuemart_vendor_medias`
--

INSERT INTO `jos_virtuemart_vendor_medias` (`id`, `virtuemart_vendor_id`, `virtuemart_media_id`, `ordering`) VALUES
(1, 1, 99, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jos_virtuemart_worldzones`
--

DROP TABLE IF EXISTS `jos_virtuemart_worldzones`;
CREATE TABLE `jos_virtuemart_worldzones` (
  `virtuemart_worldzone_id` smallint(1) unsigned NOT NULL AUTO_INCREMENT,
  `virtuemart_vendor_id` smallint(1) DEFAULT NULL,
  `zone_name` char(255) DEFAULT NULL,
  `zone_cost` decimal(10,2) DEFAULT NULL,
  `zone_limit` decimal(10,2) DEFAULT NULL,
  `zone_description` varchar(18000) DEFAULT NULL,
  `zone_tax_rate` int(1) unsigned NOT NULL DEFAULT '0',
  `ordering` int(2) NOT NULL DEFAULT '0',
  `shared` tinyint(1) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`virtuemart_worldzone_id`),
  KEY `i_virtuemart_vendor_id` (`virtuemart_vendor_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='The Zones managed by the Zone Shipment Module' AUTO_INCREMENT=5 ;

--
-- Dumping data for table `jos_virtuemart_worldzones`
--

INSERT INTO `jos_virtuemart_worldzones` (`virtuemart_worldzone_id`, `virtuemart_vendor_id`, `zone_name`, `zone_cost`, `zone_limit`, `zone_description`, `zone_tax_rate`, `ordering`, `shared`, `published`, `created_on`, `created_by`, `modified_on`, `modified_by`, `locked_on`, `locked_by`) VALUES
(1, NULL, 'Default', '6.00', '35.00', 'This is the default Shipment Zone. This is the zone information that all countries will use until you assign each individual country to a Zone.', 2, 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(2, NULL, 'Zone 1', '1000.00', '10000.00', 'This is a zone example', 2, 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(3, NULL, 'Zone 2', '2.00', '22.00', 'This is the second zone. You can use this for notes about this zone', 2, 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(4, NULL, 'Zone 3', '11.00', '64.00', 'Another useful thing might be details about this zone or special instructions.', 2, 0, 0, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_weblinks`
--

DROP TABLE IF EXISTS `jos_weblinks`;
CREATE TABLE `jos_weblinks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(250) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `url` varchar(250) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(11) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `archived` tinyint(1) NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '1',
  `access` int(11) NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  `language` char(7) NOT NULL DEFAULT '',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Set if link is featured.',
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`catid`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `jos_weblinks`
--

INSERT INTO `jos_weblinks` (`id`, `catid`, `sid`, `title`, `alias`, `url`, `description`, `date`, `hits`, `state`, `checked_out`, `checked_out_time`, `ordering`, `archived`, `approved`, `access`, `params`, `language`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `metakey`, `metadesc`, `metadata`, `featured`, `xreference`, `publish_up`, `publish_down`) VALUES
(1, 32, 0, 'Joomla!', 'joomla', 'http://www.joomla.org', '<p>Home of Joomla!</p>', '0000-00-00 00:00:00', 3, 1, 0, '0000-00-00 00:00:00', 1, 0, 1, 1, '{"target":"0","count_clicks":""}', 'en-GB', '2011-01-01 00:00:01', 576, '', '2011-01-01 00:00:01', 0, '', '', '{"robots":"","author":"","rights":""}', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 33, 0, 'php.net', 'php', 'http://www.php.net', '<p>The language that Joomla! is developed in</p>', '0000-00-00 00:00:00', 6, 1, 0, '0000-00-00 00:00:00', 1, 0, 1, 1, '{"target":"","count_clicks":""}', 'en-GB', '2011-01-01 00:00:01', 576, '', '2011-01-01 00:00:01', 0, '', '', '{"robots":"","author":"","rights":""}', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 33, 0, 'MySQL', 'mysql', 'http://www.mysql.com', '<p>The most commonly used database for Joomla!.</p>', '0000-00-00 00:00:00', 1, 1, 0, '0000-00-00 00:00:00', 2, 0, 1, 1, '{"target":"","width":"","height":"","count_clicks":""}', 'en-GB', '2011-01-01 00:00:01', 576, '', '2012-01-17 16:19:43', 0, '', '', '{"robots":"","rights":""}', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 32, 0, 'OpenSourceMatters', 'opensourcematters', 'http://www.opensourcematters.org', '<p>Home of OSM</p>', '0000-00-00 00:00:00', 11, 1, 0, '0000-00-00 00:00:00', 3, 0, 1, 1, '{"target":"0","count_clicks":""}', 'en-GB', '2011-01-01 00:00:01', 576, '', '2011-01-01 00:00:01', 0, '', '', '{"robots":"","author":"","rights":""}', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 32, 0, 'Joomla! - Forums', 'joomla-forums', 'http://forum.joomla.org', '<p>Joomla! Forums</p>', '0000-00-00 00:00:00', 4, 1, 0, '0000-00-00 00:00:00', 2, 0, 1, 1, '{"target":"0","count_clicks":""}', 'en-GB', '2011-01-01 00:00:01', 576, '', '2011-01-01 00:00:01', 0, '', '', '{"robots":"","author":"","rights":""}', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 33, 0, 'Ohloh Tracking of Joomla!', 'ohloh-tracking-of-joomla', 'http://www.ohloh.net/projects/20', '<p>Objective reports from Ohloh about Joomla''s development activity. Joomla! has some star developers with serious kudos.</p>', '0000-00-00 00:00:00', 1, 1, 0, '0000-00-00 00:00:00', 3, 0, 1, 1, '{"target":"0","count_clicks":""}', 'en-GB', '2011-01-01 00:00:01', 576, '', '2011-01-01 00:00:01', 0, '', '', '{"robots":"","author":"","rights":""}', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 31, 0, 'Baw Baw National Park', 'baw-baw-national-park', 'http://www.parkweb.vic.gov.au/1park_display.cfm?park=44', '<p>Park of the Austalian Alps National Parks system, Baw Baw  features sub alpine vegetation, beautiful views, and opportunities for hiking, skiing and other outdoor activities.</p>', '0000-00-00 00:00:00', 0, 1, 0, '0000-00-00 00:00:00', 1, 0, 1, 1, '{"target":"0","count_clicks":""}', 'en-GB', '2011-01-01 00:00:01', 576, '', '2011-01-01 00:00:01', 0, '', '', '{"robots":"","author":"","rights":""}', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 31, 0, 'Kakadu', 'kakadu', 'http://www.environment.gov.au/parks/kakadu/index.html', '<p>Kakadu is known for both its cultural heritage and its natural features. It is one of a small number of places listed as World Heritage Places for both reasons. Extensive rock art is found there.</p>', '0000-00-00 00:00:00', 0, 1, 0, '0000-00-00 00:00:00', 2, 0, 1, 1, '{"target":"0","count_clicks":""}', 'en-GB', '2011-01-01 00:00:01', 576, '', '2011-01-01 00:00:01', 0, '', '', '{"robots":"","author":"","rights":""}', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 31, 0, 'Pulu Keeling', 'pulu-keeling', 'http://www.environment.gov.au/parks/cocos/index.html', '<p>Located on an atoll 2000 kilometers north of Perth, Pulu Keeling is Australia''s smallest national park.</p>', '0000-00-00 00:00:00', 0, 1, 0, '0000-00-00 00:00:00', 3, 0, 1, 1, '{"target":"0","count_clicks":""}', 'en-GB', '2011-01-01 00:00:01', 576, '', '2011-01-01 00:00:01', 0, '', '', '{"robots":"","author":"","rights":""}', 0, '', '2010-07-10 23:44:03', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
