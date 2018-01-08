-- phpMyAdmin SQL Dump
-- version 
-- http://www.phpmyadmin.net
--
-- Хост: u305676.mysql.masterhost.ru
-- Время создания: Июн 04 2016 г., 09:11
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
-- Структура таблицы `ad_price_lists`
--

CREATE TABLE IF NOT EXISTS `ad_price_lists` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `title` text,
  `file` tinytext,
  `date_price` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `ad_price_lists`
--

INSERT INTO `ad_price_lists` (`id`, `title`, `file`, `date_price`) VALUES
(1, 'Опт', '/public/userfiles/price_lists/Prays-list_ot_18-05-16.xls', '2016-05-23'),
(2, 'Опт1', '/public/userfiles/price_lists/Prays-list_ot_18-05-16-opt1.xls', '2016-05-23'),
(3, 'Опт2', '/public/userfiles/price_lists/Prays-list_ot_18-05-16-opt2.xls', '2016-05-23'),
(4, 'Опт3', '/public/userfiles/price_lists/Prays-list_ot_18-05-16-opt3.xls', '2016-05-23'),
(5, 'Опт4', '/public/userfiles/price_lists/Prays-list_ot_18-05-16-opt4.xls', '2016-05-23'),
(6, 'Остальные', '/public/userfiles/price_lists/Prays-list_ot_18-05-16-opt4.xls', '2016-05-23');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
