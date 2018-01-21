-- phpMyAdmin SQL Dump
-- version 
-- http://www.phpmyadmin.net
--
-- Хост: u305676.mysql.masterhost.ru
-- Время создания: Май 25 2016 г., 15:38
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
-- Структура таблицы `ad_rekvisites`
--

CREATE TABLE IF NOT EXISTS `ad_rekvisites` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` text,
  `text` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `ad_rekvisites`
--

INSERT INTO `ad_rekvisites` (`id`, `title`, `text`) VALUES
(1, 'ФИО Генерального директора', 'Белых Александр Петрович'),
(2, 'ФИО Главного бухгалтера', 'Мороз Маргарита Геннадиевна'),
(3, 'ОГРН', '5077746723346'),
(4, 'ОКПО', '80818743'),
(5, 'ИНН', '7727612376'),
(6, 'КПП', '772701001'),
(7, 'ОКВЭД', '51.40'),
(8, 'ОКТМО', '45908000'),
(9, 'ОКФС', '16'),
(10, 'ОКОПФ', '65'),
(11, 'Юридический, почтовый адрес', '117418, г.Москва, Нахимовский пр-т, д.35'),
(12, 'Фактический, почтовый адрес', '117418, г.Москва, Нахимовский пр-т, д.35'),
(13, 'Телефон', '(499) 724-28-10'),
(14, 'Факс', '(495) 779-65-59'),
(15, 'Электронный адрес', 'dealers@artisan-project.ru'),
(16, 'Реквизит1', 'Текст реквизита1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
