-- phpMyAdmin SQL Dump
-- version 
-- http://www.phpmyadmin.net
--
-- Хост: u305676.mysql.masterhost.ru
-- Время создания: Май 25 2016 г., 15:42
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
-- Структура таблицы `ad_transport_companies`
--

CREATE TABLE IF NOT EXISTS `ad_transport_companies` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(30) DEFAULT NULL,
  `adress` varchar(70) DEFAULT NULL,
  `days` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `ad_transport_companies`
--

INSERT INTO `ad_transport_companies` (`id`, `title`, `adress`, `days`) VALUES
(1, 'ТК &quot;ЭкспрессЛайн&quot;', 'ул. Вавилова д. 9А', ' 1 2 4 5 6'),
(2, 'ТК &quot;ПЭК&quot;', 'Востряковский проезд 10Б', ' 2 4'),
(3, 'ТК &quot;ТЭС&quot;', 'ул. Шумкина д.18', ' 3 4'),
(4, 'ТК &quot;Фаворит56&quot;', 'п. Саларьево, Коммунальная зона вл.5', ' 3'),
(5, 'ТК &quot;Восточный транзит&quo', 'ул. Раменки д.43', ' 3'),
(6, 'ТК &quot;Гарант Транс&quot;', 'ул. Адмирала Макарова д.2', ' 5'),
(7, 'ТК &quot;Рейл Континент&quot;', 'Петровское шоссе 45; Южнопортовый проезд д.10', ' 5'),
(8, 'ТК &quot;СЗТК&quot;', 'Перовское шоссе 25; Спартаковская площадь д.1А стр.2', ' 6'),
(9, 'ТК &quot;ТрансЭкспресс54&quot;', 'Карачаровское шоссе 5', ' 6');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
