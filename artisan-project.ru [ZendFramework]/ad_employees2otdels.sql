-- phpMyAdmin SQL Dump
-- version 
-- http://www.phpmyadmin.net
--
-- Хост: u305676.mysql.masterhost.ru
-- Время создания: Май 25 2016 г., 15:29
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
-- Структура таблицы `ad_employees2otdels`
--

CREATE TABLE IF NOT EXISTS `ad_employees2otdels` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_otdel` int(10) NOT NULL,
  `id_employee` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_employee` (`id_employee`),
  KEY `id_otdel` (`id_otdel`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=142 ;

--
-- Дамп данных таблицы `ad_employees2otdels`
--

INSERT INTO `ad_employees2otdels` (`id`, `id_otdel`, `id_employee`) VALUES
(1, 1, 1),
(2, 0, 0),
(3, 0, 0),
(4, 0, 0),
(5, 0, 0),
(6, 0, 0),
(7, 0, 0),
(8, 0, 0),
(9, 0, 0),
(10, 0, 0),
(11, 0, 0),
(12, 0, 0),
(133, 3, 8),
(129, 1, 7),
(141, 4, 17),
(130, 2, 13),
(132, 3, 3),
(124, 1, 9),
(131, 2, 15),
(74, 5, 10),
(140, 4, 18),
(139, 4, 19),
(77, 11, 16),
(138, 4, 12),
(137, 4, 11),
(136, 3, 22),
(128, 1, 6);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
