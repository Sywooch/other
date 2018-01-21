-- phpMyAdmin SQL Dump
-- version 
-- http://www.phpmyadmin.net
--
-- Хост: u305676.mysql.masterhost.ru
-- Время создания: Май 25 2016 г., 15:37
-- Версия сервера: 5.6.28
-- Версия PHP: 5.4.4-14+deb7u14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `u305676_apt`
--

-- --------------------------------------------------------

--
-- Структура таблицы `ad_purposes`
--

CREATE TABLE IF NOT EXISTS `ad_purposes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `detail_title` text NOT NULL,
  `image` tinytext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `ad_purposes`
--

INSERT INTO `ad_purposes` (`id`, `title`, `detail_title`, `image`) VALUES
(12, 'Плитка для ванной', 'Плитка для ванной', 'http://taki.su/ap/images_tmp/materials/naznacheni5.jpg'),
(13, 'Плитка для пола', 'Плитка для пола', 'http://taki.su/ap/images_tmp/materials/naznacheni2.jpg'),
(14, 'Плитка для гостиной', 'Плитка для гостиной', 'http://taki.su/ap/images_tmp/materials/naznacheni2.jpg'),
(15, 'Плитка для куxни', 'Плитка для кухни', 'http://taki.su/ap/images_tmp/materials/naznacheni3.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
