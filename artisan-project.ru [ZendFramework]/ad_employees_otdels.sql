-- phpMyAdmin SQL Dump
-- version 
-- http://www.phpmyadmin.net
--
-- Хост: u305676.mysql.masterhost.ru
-- Время создания: Май 25 2016 г., 15:30
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
-- Структура таблицы `ad_employees_otdels`
--

CREATE TABLE IF NOT EXISTS `ad_employees_otdels` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `order` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=142 ;

--
-- Дамп данных таблицы `ad_employees_otdels`
--

INSERT INTO `ad_employees_otdels` (`id`, `title`, `order`) VALUES
(1, 'Отдел по работе со строительными и проектными организациями', '1'),
(2, 'Отдел по работе с дилерами Москвы и Московской области', '2'),
(3, 'Отдел по работе с дилерами из других регионов РФ', '3'),
(4, 'Администраторы дилерского отдела', '4'),
(26, 'Главный', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
