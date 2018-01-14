-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Хост: mysql89.1gb.ru
-- Время создания: Сен 12 2015 г., 11:38
-- Версия сервера: 5.5.35-rel33.0-log
-- Версия PHP: 5.3.28

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `gb_shop_d`
--

-- --------------------------------------------------------

--
-- Структура таблицы `administrators`
--

CREATE TABLE IF NOT EXISTS `administrators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `session` varchar(50) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `shopId` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `administrators`
--

INSERT INTO `administrators` (`id`, `login`, `password`, `email`, `session`, `ip`, `shopId`) VALUES
(1, 'admin', 'ecdcadda00320283ffcb9ebe6ca35390', 'info@dancefile.ru', 'sc94pmiqbvaj1b98th3i964a43', '', 0),
(2, 'paash', '5f7bcbb9089770b816cd40e77f11d3c9', '', '8tc5lgfua5h025an6ohmjp4jp3', '46.188.59.122', -1),
(3, 'test', '3049a1f0f1c808cdaa4fbed0e01649b1', '', '', '', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `brand`
--

INSERT INTO `brand` (`id`, `name`) VALUES
(1, 'LaLaChaCha'),
(2, 'MALY');

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2147483647 ;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `parent`, `name`) VALUES
(1, 0, 'Тренировочная Одежда'),
(2, 1, 'Мужская'),
(3, 1, 'Женская'),
(4, 2, 'Рубашки'),
(5, 2, 'Брюки'),
(6, 3, 'Платья'),
(7, 3, 'Блузки'),
(8, 3, 'Юбки'),
(9, 3, 'Брюки');

-- --------------------------------------------------------

--
-- Структура таблицы `color`
--

CREATE TABLE IF NOT EXISTS `color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `color`
--

INSERT INTO `color` (`id`, `name`) VALUES
(1, 'Черный'),
(2, 'Белый'),
(3, 'Серый'),
(4, 'Красный'),
(5, 'Синий'),
(6, 'Коричневый'),
(7, 'Песочный');

-- --------------------------------------------------------

--
-- Структура таблицы `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `country`
--

INSERT INTO `country` (`id`, `name`) VALUES
(1, 'Германия');

-- --------------------------------------------------------

--
-- Структура таблицы `import_id`
--

CREATE TABLE IF NOT EXISTS `import_id` (
  `id` int(11) NOT NULL,
  `import` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `import_id`
--

INSERT INTO `import_id` (`id`, `import`) VALUES
(1, '89745');

-- --------------------------------------------------------

--
-- Структура таблицы `shops`
--

CREATE TABLE IF NOT EXISTS `shops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT 'noname',
  `url` varchar(200) DEFAULT NULL,
  `tel` varchar(100) DEFAULT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `adress` varchar(200) NOT NULL,
  `comm` text,
  `xml` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `shops`
--

INSERT INTO `shops` (`id`, `name`, `url`, `tel`, `mail`, `adress`, `comm`, `xml`) VALUES
(1, 'noname', '/upload_xml/export.xml', NULL, NULL, '', NULL, '');

-- --------------------------------------------------------

--
-- Структура таблицы `size`
--

CREATE TABLE IF NOT EXISTS `size` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `size`
--

INSERT INTO `size` (`id`, `name`) VALUES
(1, 'XS'),
(2, 'M'),
(3, 'L'),
(4, 'XL'),
(5, 'S');

-- --------------------------------------------------------

--
-- Структура таблицы `tovar`
--

CREATE TABLE IF NOT EXISTS `tovar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop` int(11) NOT NULL DEFAULT '1',
  `category` int(11) NOT NULL,
  `price` float DEFAULT NULL,
  `currency` varchar(5) NOT NULL DEFAULT 'EUR',
  `name` varchar(200) DEFAULT NULL,
  `text` text,
  `brand` int(11) NOT NULL,
  `country` int(11) NOT NULL DEFAULT '1',
  `artikul` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Дамп данных таблицы `tovar`
--

INSERT INTO `tovar` (`id`, `shop`, `category`, `price`, `currency`, `name`, `text`, `brand`, `country`, `artikul`) VALUES
(1, 1, 4, 79, 'EUR', 'LC122101 Модная мужская рубашка', '', 1, 1, 'LC122101'),
(3, 1, 4, 79, 'EUR', 'MF-72201 Рубашка мужская', '', 2, 1, 'MF-72201'),
(4, 1, 4, 79, 'EUR', 'MF-72203 Рубашка мужская', '', 2, 1, 'MF-72203'),
(5, 1, 5, 109, 'EUR', 'MF-62403 Брюки мужские для Стандарта', '', 2, 1, 'MF-62403'),
(6, 1, 5, 119, 'EUR', 'MF-62405 Брюки мужские &quot;Fabio Selmi&quot;', '', 2, 1, 'MF-62405'),
(7, 1, 5, 119, 'EUR', 'MF-62406 Брюки мужские вельвет', '', 2, 1, 'MF-62406'),
(8, 1, 5, 69, 'EUR', 'LC-122401 Модные мужские брюки', '', 1, 1, 'LC-122401'),
(9, 1, 9, 99, 'EUR', 'MF-121401 Брюки размер 36', '94% полиэстер, 6% эластан, возможна машинная стирка 30 °', 2, 1, 'MF-121401'),
(10, 1, 9, 99, 'EUR', 'MF-121401 Брюки размер 38', '94% полиэстер, 6% эластан, возможна машинная стирка 30 °', 2, 1, 'MF-121401'),
(11, 1, 7, 129, 'EUR', 'MF-121301 Пиджак с золотыми молниями', '', 2, 1, 'MF-121301'),
(12, 1, 7, 59, 'EUR', 'MF-121302 Блузка-туника', '', 2, 1, 'MF-121302'),
(13, 1, 7, 79, 'EUR', 'MF-121101 Блузка с отделкой лентами', '94% полиэстер, 6% эластан, 30 ° машинная стирка', 2, 1, 'MF-121101'),
(14, 1, 7, 79, 'EUR', 'MF-141101 Блузка &quot;летучая мышь&quot; ', '', 2, 1, 'MF-141101'),
(15, 1, 7, 79, 'EUR', 'MF-151101 Блузка с отделкой шнурами', '', 2, 1, 'MF-151101'),
(16, 1, 7, 69, 'EUR', 'MF-111102 Блузка с поясом', '', 2, 1, 'MF-111102'),
(17, 1, 7, 69, 'EUR', 'MF-121102 Блузка свободная с поясом', '', 2, 1, 'MF-121102'),
(18, 1, 7, 59, 'EUR', 'MF-131102 Блузка для Латины', '94% полиэстер, 6% эластан, 30 ° машинная стирка', 2, 1, 'MF-131102'),
(19, 1, 7, 69, 'EUR', 'MF-141102 Блузка с большим воротником', '94% полиэстер, 6% эластан, 30 ° машинная стирка', 2, 1, 'MF-141102'),
(20, 1, 7, 69, 'EUR', 'MF-151102 Блузка-футболка с оборками', '94% полиэстер, 6% эластан, 30 ° машинная стирка', 2, 1, 'MF-151102'),
(21, 1, 7, 69, 'EUR', 'MF-111103 Блузка &quot;диагональ&quot;', '', 2, 1, 'MF-111103'),
(22, 1, 7, 79, 'EUR', 'MF-121103 Блузка &quot;черепаший воротник&quot;', '', 2, 1, 'MF-121103'),
(23, 1, 7, 59, 'EUR', 'MF-141103 Блузка с шарфиком', '', 2, 1, 'MF-141103'),
(24, 1, 7, 69, 'EUR', 'MF-151103 Блузка с шалью', '94% полиэстер, 6% эластан, 30 ° машинная стирка', 2, 1, 'MF-151103'),
(25, 1, 7, 79, 'EUR', 'MF-111104 Блузка &quot;двухслойная&quot;', '', 2, 1, 'MF-111104'),
(26, 1, 7, 69, 'EUR', 'MF-121104 Блузка &quot;двухслойная&quot; ', '', 2, 1, 'MF-121104'),
(27, 1, 8, 99, 'EUR', 'MF-111501 Юбка с двумя поясами для Стандарта', '', 2, 1, 'MF-111501'),
(28, 1, 8, 129, 'EUR', 'MF-121501Юбка с отделкой лентами для Стандарта', '94% полиэстер, 6% эластан, возможна машинная стирка 30 °', 2, 1, 'MF-121501'),
(29, 1, 8, 99, 'EUR', 'MF-141501 Юбка для Стандарта ', '94% полиэстер, 6% эластан, возможна машинная стирка 30 °', 2, 1, 'MF-141501'),
(30, 1, 8, 119, 'EUR', 'MF-151501 Юбка для Стандарта удлинённая', '94% полиэстер, 6% эластан, возможна машинная стирка 30 °', 0, 1, 'MF-151501'),
(31, 1, 8, 109, 'EUR', 'MF-121502 Юбка с отделкой лентами для Латины', '', 2, 1, 'MF-121502'),
(32, 1, 8, 89, 'EUR', 'MF-131502 Юбка для Латины', '', 2, 1, 'MF-131502'),
(33, 1, 8, 89, 'EUR', 'MF-141502 Юбка для Латины с драпировкой', '94% полиэстер, 6% эластан, возможна машинная стирка 30 °', 2, 1, 'MF-141502'),
(34, 1, 8, 119, 'EUR', 'MF-111503 Юбка для Стандарта с драпировкой', '', 2, 1, 'MF-111503'),
(35, 1, 8, 119, 'EUR', 'MF-121503 Юбка для Стандарта с золотыми пуговицами', '', 2, 1, 'MF-121503'),
(36, 1, 8, 89, 'EUR', 'MF-131503 Юбка для Латины с молнией', '94% полиэстер, 6% эластан, возможна машинная стирка 30 °', 2, 1, 'MF-131503'),
(37, 1, 8, 99, 'EUR', 'MF-141503 Юбка для Латины с бахромой', '94% полиэстер, 6% эластан, возможна машинная стирка 30 °', 2, 1, 'MF-141503'),
(38, 1, 8, 99, 'EUR', 'MF-111504 Юбка для Латины с драпировкой', '', 2, 1, 'MF-111504'),
(39, 1, 6, 119, 'EUR', 'MF-141601 Платье для Латины с поясом', '94% полиэстер, 6% эластан,  30 ° машинная стирка ', 2, 1, 'MF-141601');

-- --------------------------------------------------------

--
-- Структура таблицы `tovar_color`
--

CREATE TABLE IF NOT EXISTS `tovar_color` (
  `tovar` int(11) NOT NULL,
  `color` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tovar_color`
--

INSERT INTO `tovar_color` (`tovar`, `color`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(5, 1),
(6, 3),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(16, 3),
(17, 1),
(17, 7),
(18, 1),
(18, 4),
(18, 5),
(19, 1),
(19, 4),
(19, 5),
(20, 1),
(20, 4),
(21, 1),
(22, 1),
(22, 6),
(23, 4),
(24, 1),
(24, 4),
(25, 3),
(26, 1),
(27, 6),
(28, 1),
(28, 4),
(29, 1),
(29, 4),
(30, 1),
(30, 5),
(31, 1),
(31, 6),
(32, 1),
(32, 4),
(33, 1),
(33, 4),
(34, 1),
(34, 6),
(35, 1),
(36, 1),
(36, 4),
(37, 1),
(38, 1),
(38, 6),
(39, 4),
(3, 3),
(12, 5),
(12, 4),
(13, 4),
(14, 4),
(39, 1),
(39, 5),
(13, 5),
(20, 5),
(24, 5),
(28, 5),
(36, 5),
(29, 5),
(33, 5),
(30, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `tovar_option`
--

CREATE TABLE IF NOT EXISTS `tovar_option` (
  `tovar` int(11) NOT NULL,
  `color` int(11) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `count` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tovar_option`
--

INSERT INTO `tovar_option` (`tovar`, `color`, `size`, `count`) VALUES
(1, 1, 2, 1),
(1, 2, 5, 1),
(3, 1, 1, 1),
(4, 1, 3, 1),
(5, 1, 2, 1),
(6, 3, 3, 1),
(7, 1, 3, 1),
(8, 1, 3, 1),
(9, 1, 2, 1),
(11, 1, 2, 1),
(12, 1, 2, 1),
(12, 5, 5, 1),
(12, 4, 5, 1),
(13, 1, 2, 1),
(13, 4, 2, 1),
(14, 4, 5, 1),
(16, 3, 2, 1),
(17, 7, 2, 1),
(18, 1, 5, 1),
(19, 1, 2, 1),
(19, 4, 2, 1),
(20, 1, 2, 1),
(20, 4, 2, 1),
(22, 6, 2, 1),
(24, 1, 5, 1),
(24, 4, 5, 1),
(25, 3, 2, 1),
(26, 1, 5, 1),
(27, 6, 5, 1),
(28, 4, 2, 1),
(28, 1, 2, 1),
(29, 1, 5, 1),
(29, 5, 2, 1),
(30, 1, 2, 1),
(30, 4, 2, 1),
(31, 6, 2, 1),
(31, 1, 5, 1),
(33, 4, 2, 1),
(34, 1, 5, 1),
(34, 6, 2, 1),
(35, 1, 2, 1),
(36, 4, 2, 1),
(37, 1, 5, 1),
(38, 1, 2, 1),
(38, 6, 2, 1),
(3, 1, 3, 1),
(1, 1, 5, 1),
(13, 1, 5, 1),
(13, 4, 5, 1),
(17, 1, 2, 1),
(17, 7, 5, 1),
(18, 1, 2, 1),
(29, 1, 2, 1),
(31, 6, 5, 1),
(31, 6, 1, 1),
(33, 4, 5, 1),
(38, 1, 5, 1),
(38, 6, 5, 1),
(38, 1, 1, 1),
(38, 6, 1, 1),
(3, 2, 4, 1),
(14, 4, 3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tovar_order`
--

CREATE TABLE IF NOT EXISTS `tovar_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` int(11) NOT NULL,
  `tovarid` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `price` float NOT NULL,
  `color` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `tovar_order`
--

INSERT INTO `tovar_order` (`id`, `orderid`, `tovarid`, `count`, `price`, `color`, `size`) VALUES
(3, 412, 1, 1, 4345, 0, 0),
(4, 1426, 1, 1, 4345, 2, 1),
(5, 1427, 1, 1, 4345, 2, 1),
(6, 1428, 1, 1, 4345, 2, 1),
(7, 1429, 1, 1, 4345, 2, 1),
(8, 1430, 1, 1, 4345, 2, 1),
(9, 1431, 1, 1, 4345, 2, 1),
(10, 1432, 1, 1, 4345, 2, 1),
(11, 1433, 1, 1, 4345, 2, 1),
(12, 1434, 1, 1, 4345, 2, 1),
(13, 1435, 1, 1, 4345, 2, 1),
(14, 1436, 1, 1, 4345, 2, 1),
(15, 1437, 1, 1, 4345, 2, 1),
(16, 1438, 1, 1, 4345, 2, 1),
(17, 1439, 1, 1, 4345, 2, 1),
(18, 1440, 1, 1, 4345, 2, 1),
(19, 1441, 1, 1, 4345, 2, 1),
(20, 1442, 1, 1, 4345, 2, 1),
(21, 443, 1, 1, 4345, 2, 1),
(22, 444, 1, 1, 4345, 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tovar_size`
--

CREATE TABLE IF NOT EXISTS `tovar_size` (
  `tovar` int(11) NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tovar_size`
--

INSERT INTO `tovar_size` (`tovar`, `size`) VALUES
(1, 1),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(4, 3),
(5, 2),
(6, 2),
(7, 3),
(8, 3),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 3),
(16, 2),
(17, 1),
(17, 2),
(17, 5),
(18, 2),
(18, 5),
(19, 2),
(21, 2),
(22, 2),
(23, 5),
(24, 5),
(25, 2),
(27, 5),
(28, 2),
(29, 2),
(29, 5),
(30, 2),
(31, 1),
(31, 2),
(31, 5),
(32, 2),
(33, 2),
(33, 5),
(34, 2),
(34, 5),
(35, 2),
(36, 2),
(36, 5),
(37, 5),
(38, 1),
(38, 2),
(38, 5),
(39, 5),
(1, 2),
(1, 5),
(3, 5),
(6, 3),
(12, 5),
(13, 5),
(14, 5),
(26, 5),
(39, 3),
(39, 1),
(13, 1),
(13, 3),
(13, 4),
(18, 1),
(18, 3),
(19, 3),
(19, 5),
(19, 1),
(19, 4),
(20, 1),
(20, 3),
(20, 5),
(24, 1),
(24, 2),
(24, 3),
(24, 4),
(28, 1),
(28, 5),
(28, 3),
(36, 1),
(36, 3),
(29, 3),
(29, 1),
(33, 3),
(33, 1),
(30, 5),
(30, 3),
(30, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
