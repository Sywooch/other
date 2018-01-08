-- phpMyAdmin SQL Dump
-- version 
-- http://www.phpmyadmin.net
--
-- Хост: u305676.mysql.masterhost.ru
-- Время создания: Май 25 2016 г., 15:40
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
-- Структура таблицы `ad_surfaces`
--

CREATE TABLE IF NOT EXISTS `ad_surfaces` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `image` text,
  `title` text,
  `detail_title` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `ad_surfaces`
--

INSERT INTO `ad_surfaces` (`id`, `image`, `title`, `detail_title`) VALUES
(12, '/public/userfiles/surfaces/[dir]/3185460.jpg', 'матовая', 'матовая'),
(13, '/public/userfiles/surfaces/[dir]/596765383.jpg', 'глянцевая', 'глянцевая'),
(14, '/public/userfiles/surfaces/[dir]/1097310668.jpg', 'структурированная', 'структурированная'),
(15, '/public/userfiles/surfaces/[dir]/2669079.jpg', 'лаппатированная', 'лаппатированная'),
(16, '/public/userfiles/surfaces/[dir]/1234668005.jpg', 'полированная', 'полированная');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
