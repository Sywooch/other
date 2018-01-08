-- phpMyAdmin SQL Dump
-- version 
-- http://www.phpmyadmin.net
--
-- Хост: u305676.mysql.masterhost.ru
-- Время создания: Май 25 2016 г., 15:34
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
-- Структура таблицы `ad_materials`
--

CREATE TABLE IF NOT EXISTS `ad_materials` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `detail_title` text NOT NULL,
  `image` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Дамп данных таблицы `ad_materials`
--

INSERT INTO `ad_materials` (`id`, `title`, `detail_title`, `image`) VALUES
(12, 'Керамическая плитка', 'Керамическая плитка', 'http://taki.su/ap/images_tmp/materials/material1.jpg'),
(13, 'Керамогранит', 'Керамогранит', 'http://taki.su/ap/images_tmp/materials/material2.jpg'),
(14, 'Стекло', 'Стекло', 'http://taki.su/ap/images_tmp/materials/material7.jpg'),
(16, 'Мозаика', 'Мозаика', 'http://taki.su/ap/images_tmp/materials/material5.jpg'),
(17, 'Натуральный камень', 'Натуральный камень', 'http://taki.su/ap/images_tmp/materials/material6.jpg'),
(18, 'Профиль латунный', 'Профиль латунный', '/public/userfiles/materials/[dir]/775433198.jpg'),
(19, 'Сопутствующие товары', 'Сопутствующие товары', '/public/userfiles/materials/[dir]/769709975.jpg'),
(20, 'Профиль алюминиевый', 'Профиль алюминиевый', '/public/userfiles/materials/[dir]/1016109761.jpg'),
(21, 'Профиль стальной', 'Профиль стальной', '/public/userfiles/materials/[dir]/667552607.jpg'),
(22, 'Клинкер', 'Клинкер', 'http://taki.su/ap/images_tmp/materials/material3.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
