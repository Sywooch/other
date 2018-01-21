-- phpMyAdmin SQL Dump
-- version 
-- http://www.phpmyadmin.net
--
-- Хост: dancelife.mysql
-- Время создания: Сен 19 2015 г., 10:27
-- Версия сервера: 5.1.73-log
-- Версия PHP: 5.6.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `dancelife_db2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `ACCESSRIGHTS_LINK`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `ACCESSRIGHTS_LINK`;
CREATE TABLE IF NOT EXISTS `ACCESSRIGHTS_LINK` (
  `AR_PATH` varchar(255) NOT NULL,
  `AR_OBJECT_ID` varchar(50) NOT NULL,
  `LINK_AR_PATH` varchar(255) NOT NULL,
  `LINK_AR_OBJECT_ID` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `APPSETTINGS`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `APPSETTINGS`;
CREATE TABLE IF NOT EXISTS `APPSETTINGS` (
  `APP_ID` char(2) NOT NULL,
  `SETTINGS` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `CFOLDER`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `CFOLDER`;
CREATE TABLE IF NOT EXISTS `CFOLDER` (
  `CF_ID` varchar(255) NOT NULL,
  `CF_ID_PARENT` varchar(255) DEFAULT NULL,
  `CF_NAME` varchar(255) DEFAULT NULL,
  `CT_ID` char(3) DEFAULT NULL,
  `CF_STATUS` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `COMPANY`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `COMPANY`;
CREATE TABLE IF NOT EXISTS `COMPANY` (
  `COM_NAME` varchar(30) NOT NULL DEFAULT '',
  `COM_ADDRESSSTREET` varchar(50) DEFAULT NULL,
  `COM_ADDRESSCITY` varchar(30) DEFAULT NULL,
  `COM_ADDRESSSTATE` varchar(30) DEFAULT NULL,
  `COM_ADDRESSZIP` varchar(10) NOT NULL DEFAULT '',
  `COM_ADDRESSCOUNTRY` varchar(30) DEFAULT NULL,
  `COM_CONTACTPERSON` varchar(50) DEFAULT NULL,
  `COM_EMAIL` varchar(50) DEFAULT NULL,
  `COM_PHONE` varchar(50) DEFAULT NULL,
  `COM_FAX` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `COMPANY`
--

INSERT INTO `COMPANY` (`COM_NAME`, `COM_ADDRESSSTREET`, `COM_ADDRESSCITY`, `COM_ADDRESSSTATE`, `COM_ADDRESSZIP`, `COM_ADDRESSCOUNTRY`, `COM_CONTACTPERSON`, `COM_EMAIL`, `COM_PHONE`, `COM_FAX`) VALUES
('VD', NULL, NULL, NULL, '', NULL, 'Anton Starkov', 'viped@mail.ru', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `CONTACT`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `CONTACT`;
CREATE TABLE IF NOT EXISTS `CONTACT` (
  `C_ID` int(11) NOT NULL,
  `CT_ID` int(11) NOT NULL DEFAULT '1',
  `CF_ID` varchar(255) DEFAULT NULL,
  `C_CREATEDATETIME` datetime DEFAULT NULL,
  `C_CREATECID` int(11) DEFAULT NULL,
  `C_CREATEAPP_ID` varchar(3) DEFAULT NULL,
  `C_CREATEMETHOD` varchar(20) DEFAULT NULL,
  `C_CREATESOURCE` varchar(255) DEFAULT NULL,
  `C_MODIFYDATETIME` datetime DEFAULT NULL,
  `C_MODIFYCID` int(11) DEFAULT NULL,
  `C_LANGUAGE` varchar(3) DEFAULT NULL,
  `C_SUBSCRIBER` smallint(6) DEFAULT NULL,
  `C_FULLNAME` varchar(255) DEFAULT NULL,
  `C_FIRSTNAME` varchar(50) DEFAULT NULL,
  `C_MIDDLENAME` varchar(50) DEFAULT NULL,
  `C_LASTNAME` varchar(50) DEFAULT NULL,
  `C_TITLE` varchar(50) DEFAULT NULL,
  `C_COMPANY` varchar(255) DEFAULT NULL,
  `C_EMAILADDRESS` varchar(255) NOT NULL DEFAULT '',
  `C_PHOTO` text,
  `C_HOMEPHONE` varchar(50) DEFAULT NULL,
  `C_WORKPHONE` varchar(50) DEFAULT NULL,
  `C_MOBILEPHONE` varchar(50) DEFAULT NULL,
  `C_HOMEFAX` varchar(50) DEFAULT NULL,
  `C_WORKFAX` varchar(50) DEFAULT NULL,
  `C_ICQ` varchar(20) DEFAULT NULL,
  `C_MSN` varchar(50) DEFAULT NULL,
  `C_SKYPE` varchar(50) DEFAULT NULL,
  `C_HOMESTREET` varchar(255) DEFAULT NULL,
  `C_HOMECITY` varchar(50) DEFAULT NULL,
  `C_HOMESTATE` varchar(50) DEFAULT NULL,
  `C_HOMEPOSTALCODE` varchar(50) DEFAULT NULL,
  `C_HOMECOUNTRY` varchar(100) DEFAULT NULL,
  `C_BIRTHDAY` date DEFAULT NULL,
  `C_PERSONALWEBPAGE` varchar(255) DEFAULT NULL,
  `C_WORKSTREET` varchar(255) DEFAULT NULL,
  `C_WORKCITY` varchar(50) DEFAULT NULL,
  `C_WORKSTATE` varchar(50) DEFAULT NULL,
  `C_WORKPOSTALCODE` varchar(50) DEFAULT NULL,
  `C_WORKCOUNTRY` varchar(50) DEFAULT NULL,
  `C_WORKWEBPAGE` varchar(255) DEFAULT NULL,
  `C_OTHERINFO` text
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `CONTACT`
--

INSERT INTO `CONTACT` (`C_ID`, `CT_ID`, `CF_ID`, `C_CREATEDATETIME`, `C_CREATECID`, `C_CREATEAPP_ID`, `C_CREATEMETHOD`, `C_CREATESOURCE`, `C_MODIFYDATETIME`, `C_MODIFYCID`, `C_LANGUAGE`, `C_SUBSCRIBER`, `C_FULLNAME`, `C_FIRSTNAME`, `C_MIDDLENAME`, `C_LASTNAME`, `C_TITLE`, `C_COMPANY`, `C_EMAILADDRESS`, `C_PHOTO`, `C_HOMEPHONE`, `C_WORKPHONE`, `C_MOBILEPHONE`, `C_HOMEFAX`, `C_WORKFAX`, `C_ICQ`, `C_MSN`, `C_SKYPE`, `C_HOMESTREET`, `C_HOMECITY`, `C_HOMESTATE`, `C_HOMEPOSTALCODE`, `C_HOMECOUNTRY`, `C_BIRTHDAY`, `C_PERSONALWEBPAGE`, `C_WORKSTREET`, `C_WORKCITY`, `C_WORKSTATE`, `C_WORKPOSTALCODE`, `C_WORKCOUNTRY`, `C_WORKWEBPAGE`, `C_OTHERINFO`) VALUES
(1, 1, 'PRIVATE1', '2011-06-29 15:24:37', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Anton Starkov', 'Anton', NULL, 'Starkov', NULL, NULL, 'viped@mail.ru', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `CONTACTFIELD`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `CONTACTFIELD`;
CREATE TABLE IF NOT EXISTS `CONTACTFIELD` (
  `CF_ID` int(11) NOT NULL,
  `CF_DBNAME` varchar(50) DEFAULT NULL,
  `CF_TYPE` varchar(50) NOT NULL DEFAULT '',
  `CF_OPTIONS` text,
  `CF_NAME` text,
  `CF_STD` tinyint(1) NOT NULL DEFAULT '0',
  `CF_SECTION` int(11) DEFAULT NULL,
  `CF_SORTING` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `CONTACTFIELD`
--

INSERT INTO `CONTACTFIELD` (`CF_ID`, `CF_DBNAME`, `CF_TYPE`, `CF_OPTIONS`, `CF_NAME`, `CF_STD`, `CF_SECTION`, `CF_SORTING`) VALUES
(1, 'C_FIRSTNAME', 'VARCHAR', '50', 'First name', 2, 8, 1),
(2, 'C_MIDDLENAME', 'VARCHAR', '50', 'Middle name', 2, 8, 2),
(3, 'C_LASTNAME', 'VARCHAR', '50', 'Last name', 2, 8, 3),
(4, 'C_TITLE', 'VARCHAR', '50', 'Title', 2, 8, 4),
(5, 'C_COMPANY', 'VARCHAR', '255', 'Company', 1, 8, 5),
(6, 'C_EMAILADDRESS', 'EMAIL', '255', 'Email', 1, 8, 6),
(7, 'C_PHOTO', 'IMAGE', '96', 'Photo', 1, 8, 7),
(8, NULL, 'SECTION', '{"search":1}', 'Main section', 1, NULL, 1),
(9, 'C_HOMEPHONE', 'VARCHAR', '50', 'Home phone', 0, 14, 1),
(10, 'C_WORKPHONE', 'VARCHAR', '50', 'Work phone', 0, 14, 2),
(11, 'C_MOBILEPHONE', 'MOBILE', '50', 'Mobile phone', 0, 14, 3),
(12, 'C_HOMEFAX', 'VARCHAR', '50', 'Home fax', 0, 14, 4),
(13, 'C_WORKFAX', 'VARCHAR', '50', 'Work fax', 0, 14, 5),
(14, NULL, 'SECTION', '', 'Phone numbers', 0, NULL, 2),
(15, 'C_ICQ', 'VARCHAR', '50', 'ICQ', 0, 18, 1),
(16, 'C_MSN', 'VARCHAR', '50', 'MSN', 0, 18, 2),
(17, 'C_SKYPE', 'VARCHAR', '50', 'Skype', 0, 18, 3),
(18, NULL, 'SECTION', '', 'Instant messengers', 0, NULL, 3),
(19, 'C_HOMESTREET', 'VARCHAR', '255', 'Street address', 0, 24, 1),
(20, 'C_HOMECITY', 'VARCHAR', '50', 'City', 0, 24, 2),
(21, 'C_HOMESTATE', 'VARCHAR', '50', 'State', 0, 24, 3),
(22, 'C_HOMEPOSTALCODE', 'VARCHAR', '50', 'Postal code', 0, 24, 4),
(23, 'C_HOMECOUNTRY', 'VARCHAR', '50', 'Country', 0, 24, 5),
(24, NULL, 'SECTION', '', 'Home address', 0, NULL, 4),
(25, 'C_BIRTHDAY', 'DATE', '', 'Date of birth', 0, 27, 1),
(26, 'C_PERSONALWEBPAGE', 'URL', '255', 'Personal website', 0, 27, 2),
(27, NULL, 'SECTION', '', 'Personal information', 0, NULL, 5),
(28, 'C_WORKSTREET', 'VARCHAR', '255', 'Street address', 0, 34, 1),
(29, 'C_WORKCITY', 'VARCHAR', '50', 'City', 0, 34, 2),
(30, 'C_WORKSTATE', 'VARCHAR', '50', 'State', 0, 34, 3),
(31, 'C_WORKPOSTALCODE', 'VARCHAR', '50', 'Postal code', 0, 34, 4),
(32, 'C_WORKCOUNTRY', 'VARCHAR', '50', 'Country', 0, 34, 5),
(33, 'C_WORKWEBPAGE', 'URL', '255', 'Company website', 0, 34, 6),
(34, NULL, 'SECTION', '', 'Work address', 0, NULL, 6),
(35, 'C_OTHERINFO', 'TEXT', '', 'Other info', 0, 36, 1),
(36, NULL, 'SECTION', '', 'Misc', 0, NULL, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `CONTACTTYPE`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `CONTACTTYPE`;
CREATE TABLE IF NOT EXISTS `CONTACTTYPE` (
  `CT_ID` int(11) NOT NULL,
  `CT_NAME` text NOT NULL,
  `CT_OPTIONS` text NOT NULL,
  `CT_STD` tinyint(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `CONTACTTYPE`
--

INSERT INTO `CONTACTTYPE` (`CT_ID`, `CT_NAME`, `CT_OPTIONS`, `CT_STD`) VALUES
(1, 'Person', '{"fname_required":["1","3"],"fname_format":["!1! !2! !3!"],"fields":[["1"],["2"],["3"],["4"],["5"],["6"],["7"],["9"],["10"],["11"],["12"],["13"],["15"],["16"],["17"],["19"],["20"],["21"],["22"],["23"],["25"],["26"],["28"],["29"],["30"],["31"],["32"],["33"],["35"]]}', 1),
(2, 'Company', '{"fname_required":["5"],"fname_format":["!5!"],"fields":[["5"],["6"],["7"],["10"],["11"],["13"],["15"],["16"],["17"],["28"],["29"],["30"],["31"],["32"],["33"],["35"]]}', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `CURRENCY`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `CURRENCY`;
CREATE TABLE IF NOT EXISTS `CURRENCY` (
  `CUR_ID` char(3) NOT NULL DEFAULT '',
  `CUR_NAME` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `CURRENCY`
--

INSERT INTO `CURRENCY` (`CUR_ID`, `CUR_NAME`) VALUES
('USD', 'US Dollar');

-- --------------------------------------------------------

--
-- Структура таблицы `DISK_USAGE`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `DISK_USAGE`;
CREATE TABLE IF NOT EXISTS `DISK_USAGE` (
  `DU_USER_ID` varchar(20) NOT NULL,
  `DU_APP_ID` char(10) NOT NULL,
  `DU_SIZE` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `EMAIL_CONTACT`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `EMAIL_CONTACT`;
CREATE TABLE IF NOT EXISTS `EMAIL_CONTACT` (
  `EC_ID` int(11) NOT NULL,
  `EC_EMAIL` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `EMAIL_CONTACT`
--

INSERT INTO `EMAIL_CONTACT` (`EC_ID`, `EC_EMAIL`) VALUES
(1, 'viped@mail.ru');

-- --------------------------------------------------------

--
-- Структура таблицы `MMMESSAGE`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `MMMESSAGE`;
CREATE TABLE IF NOT EXISTS `MMMESSAGE` (
  `MMM_ID` int(11) NOT NULL DEFAULT '0',
  `MMF_ID` varchar(255) NOT NULL DEFAULT '0',
  `MMM_STATUS` int(11) NOT NULL DEFAULT '0',
  `MMM_DATETIME` datetime DEFAULT NULL,
  `MMM_PRIORITY` int(11) NOT NULL DEFAULT '0',
  `MMM_FROM` varchar(128) DEFAULT NULL,
  `MMM_REPLY_TO` varchar(128) DEFAULT NULL,
  `MMM_TO` text,
  `MMM_CC` text,
  `MMM_BCC` text,
  `MMM_LISTS` varchar(255) DEFAULT NULL,
  `MMM_SUBJECT` varchar(255) DEFAULT NULL,
  `MMM_LEAD` varchar(255) NOT NULL DEFAULT '',
  `MMM_CONTENT` text,
  `MMM_ATTACHMENT` text,
  `MMM_IMAGES` text,
  `MMM_SIZE` int(11) NOT NULL,
  `MMM_USERID` varchar(20) NOT NULL DEFAULT '',
  `MMM_APP_ID` char(2) NOT NULL DEFAULT 'MM',
  `MMM_HEADER` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `MMMSENTTO`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `MMMSENTTO`;
CREATE TABLE IF NOT EXISTS `MMMSENTTO` (
  `MMM_ID` int(11) NOT NULL DEFAULT '0',
  `MMMST_EMAIL` varchar(100) NOT NULL DEFAULT '',
  `MMMST_STATUS` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `MMSENT`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `MMSENT`;
CREATE TABLE IF NOT EXISTS `MMSENT` (
  `MMS_DATE` date NOT NULL,
  `MMS_COUNT` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `SC_aff_commissions`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_aff_commissions`;
CREATE TABLE IF NOT EXISTS `SC_aff_commissions` (
  `cID` int(11) NOT NULL,
  `Amount` float DEFAULT NULL,
  `CurrencyISO3` varchar(3) DEFAULT NULL,
  `xDateTime` datetime DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `OrderID` int(11) DEFAULT NULL,
  `CustomerID` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `SC_aff_payments`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_aff_payments`;
CREATE TABLE IF NOT EXISTS `SC_aff_payments` (
  `pID` int(11) NOT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `Amount` float DEFAULT NULL,
  `CurrencyISO3` varchar(3) DEFAULT NULL,
  `xDate` date DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `SC_aux_pages`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Сен 11 2015 г., 08:35
--

DROP TABLE IF EXISTS `SC_aux_pages`;
CREATE TABLE IF NOT EXISTS `SC_aux_pages` (
  `aux_page_ID` int(11) NOT NULL,
  `aux_page_text_type` int(11) DEFAULT NULL,
  `aux_page_slug` varchar(64) DEFAULT NULL,
  `aux_page_enabled` smallint(1) unsigned NOT NULL DEFAULT '0',
  `aux_page_priority` int(10) unsigned NOT NULL DEFAULT '0',
  `aux_page_name_ru` varchar(64) DEFAULT NULL,
  `aux_page_text_ru` text,
  `meta_keywords_ru` varchar(255) DEFAULT NULL,
  `meta_description_ru` text
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_aux_pages`
--

INSERT INTO `SC_aux_pages` (`aux_page_ID`, `aux_page_text_type`, `aux_page_slug`, `aux_page_enabled`, `aux_page_priority`, `aux_page_name_ru`, `aux_page_text_ru`, `meta_keywords_ru`, `meta_description_ru`) VALUES
(5, NULL, 'kontakty', 1, 2, 'Контакты', '<h1>Контакты</h1>\r\n<p>Телефон: +7(495) 517-48-11</p>\r\n<p>Email: <a href="mailto:info@dancelife-shop.ru">info@dancelife-shop.ru</a></p>', '', ''),
(3, NULL, 'dostavka-i-oplata', 1, 0, 'Доставка и оплата', '<h1>Доставка и оплата</h1>\r\n<p style="color:#cc0000;"><b>ЗАКАЗ</b></p>\r\n<p>Заказать обувь и аксессуары в нашем интернет-магазине можно круглосуточно через корзину покупателя на сайте или по email: <a href="mailto:info@dancelife-shop.ru">info@dancelife-shop.ru</a>. Также в рабочие дни с 10 до 17 часов Вы можете сделать заказ по телефону +7(495)517-48-11.</p>\r\n<p style="color:#cc0000;"><b>ДОСТАВКА</b></p>\r\n<p>Доставка по Москве — БЕСПЛАТНО!</p>\r\n<p>Доставка осуществляется в день заказа после подтверждения менеджером нашего интернет-магазина по телефону, а также при условии оформления заказа с 10 до 17 часов и наличия товара на складе. При отсутствии данного товара на складе, Вы можете получить дополнительную информацию о доставке, связавшись с нами по телефону +7(495)517-48-11. В случае оформления заказа после 17 часов, доставка осуществляется на следующий день.</p>\r\n<p>Не забудьте указать в заказе точный адрес и согласовать с менеджером удобное для Вас время доставки.</p>\r\n<p style="color:#cc0000;"><b>ОПЛАТА</b></p>\r\n<p>Оплата производится наличными курьеру.</p>\r\n<p style="color:#cc0000;"><b>ПРИМЕЧАНИЯ</b></p>\r\n<p>Накаблучники, щетки и бэйджи, из раздела аксессуары, доставляются исключительно вместе с обувью или другим товаром..</p>\r\n<p>По вопросам доставки в другие регионы, пишите на email: <a href="mailto:info@dancelife-shop.ru">info@dancelife-shop.ru</a>.</p>', '', ''),
(4, NULL, 'o-kompanii', 1, 1, 'О компании', '<h1>О компании</h1>\r\n<div class="blockVideo">\r\n<iframe src="http://player.vimeo.com/video/48771172" width="336" height="227" frameborder="0"></iframe>\r\n</div>\r\n<p>Компания Dancelife является официальным представителем и эксклюзивным дистрибьютором продукции Dancelife HQ (Нидерланды) на территории России, Белоруссии, Украины и Казахстана с 2003 года.</p>\r\n<p>Основными видами продукции компании Dancelife являются  профессиональная обувь и аксессуары для танцев. Мы рады представить на ваш выбор самый широкий ассортимент одного из самых популярных танцевальных брендов в мире!</p>\r\n<p>Растущая в последние годы привлекательность марки Dancelife обусловлена, в первую очередь, высокими стандартами качества, соблюдаемыми при производстве каждой пары обуви.</p>\r\n<p>Особым преимуществом обуви Dancelife, по мнению танцоров, является идеальное сочетание устойчивого каблука и удобной колодки в женских моделях и наимягчайшая перчаточная кожа, используемая в мужских моделях. Безупречный стиль в дополнение к классической форме идеально подходит для исполнителей любого уровня!</p>\r\n<p>Мы искренне желаем вам сделать правильный выбор!</p>', '', ''),
(7, NULL, 'slim-series', 1, 4, 'SLIM SERIES', '<p><img alt="photo from pdf file" height="1600" width="800" src="http://www.dancelife-shop.ru/published/publicdata/DANCELIFEDB2/attachments/SC/images/slimofpdf.jpg" /></p>\r\n<p><span style="font-family: mceinline;"><strong></strong></span></p>\r\n<p><strong>Уже в продаже...</strong></p>\r\n<p> </p>', '', ''),
(6, NULL, 'tablica-razmerov', 1, 3, 'Tаблица размеров', '<div id="info-tbl" style="padding:20px">\r\n<h1>Таблица размеров</h1>\r\n<h3>Мужчины</h3>\r\n<table class="infotable">\r\n<tbody>\r\n<tr>\r\n<th>UK</th>\r\n		<th>EUR</th>\r\n		<th>JAP</th>\r\n		<th>KOR</th>\r\n		<th>RUS</th>\r\n		<th>USA</th>\r\n		\r\n</tr>\r\n<tr>\r\n<td>10.0</td>\r\n<td>44</td>\r\n<td>28.5</td>\r\n<td>276</td>\r\n<td>44</td>\r\n<td>11.0</td>\r\n</tr>\r\n<tr>\r\n<td>10.5</td>\r\n<td>44.5-45</td>\r\n<td>29</td>\r\n<td>279</td>\r\n<td>44.5</td>\r\n<td>11.5</td>\r\n</tr>\r\n<tr>\r\n<td>11.0</td>\r\n<td>45.5</td>\r\n<td>29.5</td>\r\n<td>283</td>\r\n<td>45</td>\r\n<td>12.0</td>\r\n</tr>\r\n<tr>\r\n<td>11.5</td>\r\n<td>46</td>\r\n<td>30</td>\r\n<td>286</td>\r\n<td>45.5</td>\r\n<td>12.5</td>\r\n</tr>\r\n<tr>\r\n<td>12.0</td>\r\n<td>46.5-47</td>\r\n<td>30.5</td>\r\n<td>289</td>\r\n<td>46</td>\r\n<td>13.0</td>\r\n</tr>\r\n<tr>\r\n<td>12.5</td>\r\n<td>47.5</td>\r\n<td>31</td>\r\n<td>292</td>\r\n<td>46.5</td>\r\n<td>13.5</td>\r\n</tr>\r\n<tr>\r\n<td>13.0</td>\r\n<td>48</td>\r\n<td>31.5</td>\r\n<td>295</td>\r\n<td>47</td>\r\n<td>14</td>\r\n</tr>\r\n<tr>\r\n<td>5.0</td>\r\n<td>38</td>\r\n<td>23.5</td>\r\n<td>245</td>\r\n<td>39</td>\r\n<td>6.0</td>\r\n</tr>\r\n<tr>\r\n<td>5.5</td>\r\n<td>38.5</td>\r\n<td>24</td>\r\n<td>248</td>\r\n<td>39.5</td>\r\n<td>6.5</td>\r\n</tr>\r\n<tr>\r\n<td>6.0</td>\r\n<td>39</td>\r\n<td>24.5</td>\r\n<td>251</td>\r\n<td>40</td>\r\n<td>7.0</td>\r\n</tr>\r\n<tr>\r\n<td>6.5</td>\r\n<td>39.5-40</td>\r\n<td>256</td>\r\n<td>254</td>\r\n<td>40.5</td>\r\n<td>7.5</td>\r\n</tr>\r\n<tr>\r\n<td>7.0</td>\r\n<td>41</td>\r\n<td>25.5</td>\r\n<td>257</td>\r\n<td>41</td>\r\n<td>8.0</td>\r\n</tr>\r\n<tr>\r\n<td>7.5</td>\r\n<td>41.5</td>\r\n<td>26</td>\r\n<td>260</td>\r\n<td>41.5</td>\r\n<td>8.5</td>\r\n</tr>\r\n<tr>\r\n<td>8.0</td>\r\n<td>42</td>\r\n<td>26.5</td>\r\n<td>263</td>\r\n<td>42</td>\r\n<td>9.0</td>\r\n</tr>\r\n<tr>\r\n<td>8.5</td>\r\n<td>42.5</td>\r\n<td>27</td>\r\n<td>267</td>\r\n<td>42.5</td>\r\n<td>9.5</td>\r\n</tr>\r\n<tr>\r\n<td>9.0</td>\r\n<td>43</td>\r\n<td>27.5</td>\r\n<td>270</td>\r\n<td>43</td>\r\n<td>10.0</td>\r\n</tr>\r\n<tr>\r\n<td>9.5</td>\r\n<td>43.5</td>\r\n<td>28</td>\r\n<td>273</td>\r\n<td>43.5</td>\r\n<td>10.5</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<h3>Женщины</h3>\r\n<table class="infotable">\r\n<tbody>\r\n<tr>\r\n<th>UK</th>\r\n		<th>EUR</th>\r\n		<th>JAP</th>\r\n		<th>KOR</th>\r\n		<th>RUS</th>\r\n		<th>USA</th>\r\n		\r\n</tr>\r\n<tr>\r\n<td>1.5</td>\r\n<td>34.5</td>\r\n<td>20.5</td>\r\n<td>221</td>\r\n<td>33.5</td>\r\n<td>4.0</td>\r\n</tr>\r\n<tr>\r\n<td>2.0</td>\r\n<td>35</td>\r\n<td>21</td>\r\n<td>225</td>\r\n<td>34</td>\r\n<td>4.5</td>\r\n</tr>\r\n<tr>\r\n<td>2.5</td>\r\n<td>35.5</td>\r\n<td>21.5</td>\r\n<td>228</td>\r\n<td>34.5</td>\r\n<td>5.0</td>\r\n</tr>\r\n<tr>\r\n<td>3.0</td>\r\n<td>36</td>\r\n<td>22</td>\r\n<td>231</td>\r\n<td>35</td>\r\n<td>5.5</td>\r\n</tr>\r\n<tr>\r\n<td>3.5</td>\r\n<td>36.5</td>\r\n<td>22.5</td>\r\n<td>235</td>\r\n<td>35.5</td>\r\n<td>6.0</td>\r\n</tr>\r\n<tr>\r\n<td>4.0</td>\r\n<td>37</td>\r\n<td>23</td>\r\n<td>238</td>\r\n<td>36</td>\r\n<td>6.5</td>\r\n</tr>\r\n<tr>\r\n<td>4.5</td>\r\n<td>37.5</td>\r\n<td>23.5</td>\r\n<td>241</td>\r\n<td>36.5</td>\r\n<td>7.0</td>\r\n</tr>\r\n<tr>\r\n<td>5.0</td>\r\n<td>38</td>\r\n<td>24</td>\r\n<td>245</td>\r\n<td>37</td>\r\n<td>7.5</td>\r\n</tr>\r\n<tr>\r\n<td>5.5</td>\r\n<td>38.5</td>\r\n<td>24.5</td>\r\n<td>248</td>\r\n<td>37.5</td>\r\n<td>8.0</td>\r\n</tr>\r\n<tr>\r\n<td>6.0</td>\r\n<td>39</td>\r\n<td>24.75</td>\r\n<td>251</td>\r\n<td>38</td>\r\n<td>8.5</td>\r\n</tr>\r\n<tr>\r\n<td>6.5</td>\r\n<td>39.5-40</td>\r\n<td>25</td>\r\n<td>254</td>\r\n<td>38.5</td>\r\n<td>9.0</td>\r\n</tr>\r\n<tr>\r\n<td>7.0</td>\r\n<td>41</td>\r\n<td>25.5</td>\r\n<td>257</td>\r\n<td>39</td>\r\n<td>9.5</td>\r\n</tr>\r\n<tr>\r\n<td>7.5</td>\r\n<td>41.5</td>\r\n<td>26</td>\r\n<td>260</td>\r\n<td>39.5</td>\r\n<td>10.0</td>\r\n</tr>\r\n<tr>\r\n<td>8.0</td>\r\n<td>42</td>\r\n<td>26.5</td>\r\n<td>263</td>\r\n<td>40</td>\r\n<td>10.5</td>\r\n</tr>\r\n<tr>\r\n<td>8.5</td>\r\n<td>42.5</td>\r\n<td>27</td>\r\n<td>267</td>\r\n<td>40.5</td>\r\n<td>11.0</td>\r\n</tr>\r\n<tr>\r\n<td>9.0</td>\r\n<td>43</td>\r\n<td>27.5</td>\r\n<td>270</td>\r\n<td>41</td>\r\n<td>11.5</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<h3>Дети</h3>\r\n<table class="infotable">\r\n<tbody>\r\n<tr>\r\n<th>UK</th>\r\n		<th>EUR</th>\r\n		<th>JAP</th>\r\n		<th>KOR</th>\r\n		<th>RUS</th>\r\n		<th>USA</th>\r\n		\r\n</tr>\r\n<tr>\r\n<td>1.0</td>\r\n<td>33</td>\r\n<td>20</td>\r\n<td>218</td>\r\n<td>32</td>\r\n<td>1.5</td>\r\n</tr>\r\n<tr>\r\n<td>1.5</td>\r\n<td>34-34.5</td>\r\n<td>20.5</td>\r\n<td>221</td>\r\n<td>32.5</td>\r\n<td>2.0</td>\r\n</tr>\r\n<tr>\r\n<td>2.0</td>\r\n<td>35</td>\r\n<td>21</td>\r\n<td>225</td>\r\n<td>33</td>\r\n<td>2.5</td>\r\n</tr>\r\n<tr>\r\n<td>2.5</td>\r\n<td>35.5</td>\r\n<td>21.5</td>\r\n<td>228</td>\r\n<td>33.5</td>\r\n<td>3.0</td>\r\n</tr>\r\n<tr>\r\n<td>3.0</td>\r\n<td>36</td>\r\n<td>22</td>\r\n<td>231</td>\r\n<td>34</td>\r\n<td>3.5</td>\r\n</tr>\r\n<tr>\r\n<td>3.5</td>\r\n<td>36.5</td>\r\n<td>22.5</td>\r\n<td>235</td>\r\n<td>34.5</td>\r\n<td>4.0</td>\r\n</tr>\r\n<tr>\r\n<td>4.0</td>\r\n<td>37</td>\r\n<td>23</td>\r\n<td>238</td>\r\n<td>35</td>\r\n<td>4.5</td>\r\n</tr>\r\n<tr>\r\n<td>4.5</td>\r\n<td>37.5</td>\r\n<td>23.5</td>\r\n<td>241</td>\r\n<td>35.5</td>\r\n<td>5.0</td>\r\n</tr>\r\n<tr>\r\n<td>5.0</td>\r\n<td>38</td>\r\n<td>24</td>\r\n<td>245</td>\r\n<td>36</td>\r\n<td>5.5</td>\r\n</tr>\r\n<tr>\r\n<td>C10</td>\r\n<td>28</td>\r\n<td>17</td>\r\n<td>204</td>\r\n<td>28</td>\r\n<td>10.5</td>\r\n</tr>\r\n<tr>\r\n<td>C11</td>\r\n<td>29</td>\r\n<td>18</td>\r\n<td>208</td>\r\n<td>29</td>\r\n<td>11.5</td>\r\n</tr>\r\n<tr>\r\n<td>C12</td>\r\n<td>30.5-31</td>\r\n<td>19</td>\r\n<td>211</td>\r\n<td>30</td>\r\n<td>12.5</td>\r\n</tr>\r\n<tr>\r\n<td>C13</td>\r\n<td>32</td>\r\n<td>19.5</td>\r\n<td>215</td>\r\n<td>31</td>\r\n<td>13.5</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<h3>Унисекс</h3>\r\n<table class="infotable">\r\n<tbody>\r\n<tr>\r\n<th>UK</th>\r\n		<th>EUR</th>\r\n		<th>JAP</th>\r\n		<th>KOR</th>\r\n		<th>RUS</th>\r\n		<th>USA</th>\r\n		\r\n</tr>\r\n<tr>\r\n<td>1.0</td>\r\n<td>33</td>\r\n<td>20</td>\r\n<td>218</td>\r\n<td>32</td>\r\n<td>1.5</td>\r\n</tr>\r\n<tr>\r\n<td>10.0</td>\r\n<td>44</td>\r\n<td>28.5</td>\r\n<td>276</td>\r\n<td>43</td>\r\n<td>11.0</td>\r\n</tr>\r\n<tr>\r\n<td>10.5</td>\r\n<td>44.5-45</td>\r\n<td>29</td>\r\n<td>279</td>\r\n<td>43.5</td>\r\n<td>11.5</td>\r\n</tr>\r\n<tr>\r\n<td>11.0</td>\r\n<td>45.5</td>\r\n<td>29.5</td>\r\n<td>283</td>\r\n<td>44</td>\r\n<td>12.0</td>\r\n</tr>\r\n<tr>\r\n<td>11.5</td>\r\n<td>46</td>\r\n<td>30</td>\r\n<td>286</td>\r\n<td>44.5</td>\r\n<td>12.5</td>\r\n</tr>\r\n<tr>\r\n<td>12.0</td>\r\n<td>46.5-47</td>\r\n<td>30.5</td>\r\n<td>289</td>\r\n<td>45</td>\r\n<td>13.0</td>\r\n</tr>\r\n<tr>\r\n<td>12.5</td>\r\n<td>47.5</td>\r\n<td>31</td>\r\n<td>292</td>\r\n<td>45.5</td>\r\n<td>13.5</td>\r\n</tr>\r\n<tr>\r\n<td>13.0</td>\r\n<td>48</td>\r\n<td>31.5</td>\r\n<td>295</td>\r\n<td>46</td>\r\n<td>14</td>\r\n</tr>\r\n<tr>\r\n<td>1.5</td>\r\n<td>34.5</td>\r\n<td>20.5</td>\r\n<td>221</td>\r\n<td>32.5</td>\r\n<td>4.0</td>\r\n</tr>\r\n<tr>\r\n<td>2.0</td>\r\n<td>35</td>\r\n<td>21</td>\r\n<td>228</td>\r\n<td>33</td>\r\n<td>4.5</td>\r\n</tr>\r\n<tr>\r\n<td>2.5</td>\r\n<td>35.5</td>\r\n<td>22</td>\r\n<td>228</td>\r\n<td>33.5</td>\r\n<td>5.0</td>\r\n</tr>\r\n<tr>\r\n<td>3.0</td>\r\n<td>36</td>\r\n<td>55</td>\r\n<td>231</td>\r\n<td>34.5</td>\r\n<td>5.5</td>\r\n</tr>\r\n<tr>\r\n<td>3.5</td>\r\n<td>36.5</td>\r\n<td>22.5</td>\r\n<td>235</td>\r\n<td>34.5</td>\r\n<td>6.0</td>\r\n</tr>\r\n<tr>\r\n<td>4.0</td>\r\n<td>37</td>\r\n<td>23</td>\r\n<td>238</td>\r\n<td>35</td>\r\n<td>6.5</td>\r\n</tr>\r\n<tr>\r\n<td>4.5</td>\r\n<td>37.5</td>\r\n<td>23.5</td>\r\n<td>241</td>\r\n<td>35.5</td>\r\n<td>7.0</td>\r\n</tr>\r\n<tr>\r\n<td>5.0</td>\r\n<td>38</td>\r\n<td>24</td>\r\n<td>245</td>\r\n<td>36</td>\r\n<td>7.5</td>\r\n</tr>\r\n<tr>\r\n<td>5.5</td>\r\n<td>38.5</td>\r\n<td>24.5</td>\r\n<td>248</td>\r\n<td>36.5</td>\r\n<td>8.0</td>\r\n</tr>\r\n<tr>\r\n<td>6.0</td>\r\n<td>39</td>\r\n<td>24.75</td>\r\n<td>251</td>\r\n<td>37</td>\r\n<td>8.5</td>\r\n</tr>\r\n<tr>\r\n<td>6.5</td>\r\n<td>39.5-40</td>\r\n<td>25</td>\r\n<td>254</td>\r\n<td>27.5</td>\r\n<td>9.0</td>\r\n</tr>\r\n<tr>\r\n<td>7.0</td>\r\n<td>41</td>\r\n<td>25.5</td>\r\n<td>257</td>\r\n<td>38</td>\r\n<td>9.5</td>\r\n</tr>\r\n<tr>\r\n<td>7.5</td>\r\n<td>41.5</td>\r\n<td>26</td>\r\n<td>260</td>\r\n<td>38.5</td>\r\n<td>10.0</td>\r\n</tr>\r\n<tr>\r\n<td>8.0</td>\r\n<td>42</td>\r\n<td>26.5</td>\r\n<td>263</td>\r\n<td>39</td>\r\n<td>10.5</td>\r\n</tr>\r\n<tr>\r\n<td>8.5</td>\r\n<td>42.5</td>\r\n<td>27</td>\r\n<td>267</td>\r\n<td>39.5</td>\r\n<td>11.0</td>\r\n</tr>\r\n<tr>\r\n<td>9.0</td>\r\n<td>43</td>\r\n<td>27.5</td>\r\n<td>270</td>\r\n<td>42</td>\r\n<td>10.0</td>\r\n</tr>\r\n<tr>\r\n<td>9.5</td>\r\n<td>43.5</td>\r\n<td>28</td>\r\n<td>273</td>\r\n<td>42.5</td>\r\n<td>10.5</td>\r\n</tr>\r\n<tr>\r\n<td>C10</td>\r\n<td>28</td>\r\n<td>17</td>\r\n<td>204</td>\r\n<td>28</td>\r\n<td>10.5</td>\r\n</tr>\r\n<tr>\r\n<td>C11</td>\r\n<td>29</td>\r\n<td>18</td>\r\n<td>208</td>\r\n<td>29</td>\r\n<td>11.5</td>\r\n</tr>\r\n<tr>\r\n<td>C12</td>\r\n<td>30.5-31</td>\r\n<td>19</td>\r\n<td>211</td>\r\n<td>30</td>\r\n<td>12.5</td>\r\n</tr>\r\n<tr>\r\n<td>C13</td>\r\n<td>32</td>\r\n<td>19.5</td>\r\n<td>215</td>\r\n<td>31</td>\r\n<td>13.5</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '', ''),
(8, NULL, 'sale', 1, 5, 'Распродажа', '<h1>Добро пожаловать на страницу</h1>\r\n<p style="color:#cc0000;"><strong>РАСПРОДАЖА!!!</strong></p>\r\n<p>\r\n<img width="350" height="350" src="http://dancelife-shop.ru/published/publicdata/DANCELIFEDB2/attachments/SC/products_pictures/watermarked-tracksuit_enl.jpg" /></p>\r\n<p style="color:#cc0000;"><strong>МОДЕЛИ:</strong></p>\r\n<p>Женская латина — <a style="color:red;" href="http://dancelife-shop.ru/product/11502/">11502</a>\r\n- экономия 42%</p>\r\n<p>Женская латина — <a style="color:red;" href="http://dancelife-shop.ru/product/11602/">11602</a>\r\n- экономия 42%</p>\r\n<p>Женская латина — <a style="color:red;" href="http://dancelife-shop.ru/product/13732/">13732</a>\r\n- экономия 42%</p>\r\n<p>Женская латина — <a style="color:red;" href="http://dancelife-shop.ru/product/13733/">13733</a>\r\n- экономия 42%</p>\r\n<p> </p>\r\n<p> </p>\r\n<p style="color:#cc0000;"><strong>Количество обуви, выставленной на распродажу, ограничено!</strong></p>\r\n<p> </p>\r\n<p>\r\n<img width="250" height="250" src="http://dancelife-shop.ru/published/publicdata/DANCELIFEDB2/attachments/SC/products_pictures/13733-1_enl.jpg" /></p>', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `SC_categories`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Сен 19 2015 г., 06:54
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_categories`;
CREATE TABLE IF NOT EXISTS `SC_categories` (
  `categoryID` int(11) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `products_count` int(11) DEFAULT NULL,
  `picture` varchar(30) DEFAULT NULL,
  `products_count_admin` int(11) DEFAULT NULL,
  `sort_order` int(11) DEFAULT '0',
  `viewed_times` int(11) DEFAULT '0',
  `allow_products_comparison` int(11) DEFAULT '0',
  `allow_products_search` int(11) DEFAULT '1',
  `show_subcategories_products` int(11) DEFAULT '1',
  `slug` varchar(255) NOT NULL DEFAULT '',
  `name_ru` varchar(255) DEFAULT NULL,
  `description_ru` text,
  `meta_title_ru` varchar(255) DEFAULT NULL,
  `meta_description_ru` varchar(255) DEFAULT NULL,
  `meta_keywords_ru` varchar(255) DEFAULT NULL,
  `vkontakte_type` int(11) DEFAULT '0',
  `id_1c` varchar(36) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=600 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_categories`
--

INSERT INTO `SC_categories` (`categoryID`, `parent`, `products_count`, `picture`, `products_count_admin`, `sort_order`, `viewed_times`, `allow_products_comparison`, `allow_products_search`, `show_subcategories_products`, `slug`, `name_ru`, `description_ru`, `meta_title_ru`, `meta_description_ru`, `meta_keywords_ru`, `vkontakte_type`, `id_1c`) VALUES
(1, NULL, 52, NULL, 71, 0, 0, 0, 1, 1, '', 'ROOT', NULL, NULL, NULL, NULL, 0, NULL),
(589, 1, 31, '2ia.jpg', 41, 1, 9614, 1, 1, 1, 'zhenskaja-obuv', 'Женская обувь', '', '', '', '', 0, ''),
(590, 589, 21, '', 29, 1, 10964, 1, 1, 1, 'latina-women', 'Латина', '<p>Женская танцевальная обувь DANCELIFE для латиноамериканских танцев</p>', 'Женская танцевальная обувь DANCELIFE для латиноамериканских танцев', 'Женская танцевальная обувь DANCELIFE для латиноамериканских танцев', 'Женская танцевальная обувь DANCELIFE для латиноамериканских танцев', 0, ''),
(591, 589, 5, '', 5, 2, 3625, 1, 1, 1, 'standart-women', 'Стандарт', '<p>Женская танцевальная обувь DANCELIFE для европейских танцев</p>', 'Женская танцевальная обувь DANCELIFE для европейских танцев', 'Женская танцевальная обувь DANCELIFE для европейских танцев', 'Женская танцевальная обувь DANCELIFE для европейских танцев', 0, ''),
(592, 589, 4, '', 7, 3, 3571, 1, 1, 1, 'others-women', 'Другие направления', '<p>Женская танцевальная обувь DANCELIFE другие направления</p>', 'Женская танцевальная обувь DANCELIFE другие направления', 'Женская танцевальная обувь DANCELIFE другие направления', 'Женская танцевальная обувь DANCELIFE другие направления', 0, ''),
(593, 1, 7, '3f5.jpg', 15, 2, 3768, 1, 1, 1, 'muzhskaja-obuv', 'Мужская обувь', '', '', '', '', 0, ''),
(594, 593, 5, '', 8, 1, 3867, 1, 1, 1, 'latina-men', 'Латина', '<p>Мужская танцевальная обувь DANCELIFE для латиноамериканских танцев</p>', 'Мужская танцевальная обувь DANCELIFE для латиноамериканских танцев', 'Мужская танцевальная обувь DANCELIFE для латиноамериканских танцев', 'Мужская танцевальная обувь DANCELIFE для латиноамериканских танцев', 0, ''),
(595, 593, 2, '', 7, 2, 2748, 1, 1, 1, 'standart-men', 'Стандарт', '<p>Мужская танцевальная обувь DANCELIFE для европейских танцев</p>', 'Мужская танцевальная обувь DANCELIFE для европейских танцев', 'Мужская танцевальная обувь DANCELIFE для европейских танцев', 'Мужская танцевальная обувь DANCELIFE для европейских танцев', 0, ''),
(596, 1, 5, '4v2.jpg', 6, 3, 5225, 1, 1, 1, 'detskaja-obuv', 'Детская обувь', '<p>Детская танцевальная обувь DANCELIFE</p>', 'Детская танцевальная обувь DANCELIFE', 'Детская танцевальная обувь DANCELIFE', 'Детская танцевальная обувь DANCELIFE', 0, ''),
(597, 1, 9, '', 9, 4, 4292, 1, 1, 1, 'aksessuary', 'Аксессуары', '<p>Аксессуары и спортивная одежда DANCELIFE</p>', 'Аксессуары и спортивная одежда DANCELIFE', 'Аксессуары и спортивная одежда DANCELIFE', 'Аксессуары и спортивная одежда DANCELIFE', 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `SC_category_product`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_category_product`;
CREATE TABLE IF NOT EXISTS `SC_category_product` (
  `productID` int(11) NOT NULL DEFAULT '0',
  `categoryID` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `SC_category_product_options__variants`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_category_product_options__variants`;
CREATE TABLE IF NOT EXISTS `SC_category_product_options__variants` (
  `optionID` int(11) NOT NULL DEFAULT '0',
  `categoryID` int(11) NOT NULL DEFAULT '0',
  `variantID` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `SC_category__product_options`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_category__product_options`;
CREATE TABLE IF NOT EXISTS `SC_category__product_options` (
  `optionID` int(11) NOT NULL DEFAULT '0',
  `categoryID` int(11) NOT NULL DEFAULT '0',
  `set_arbitrarily` int(11) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_category__product_options`
--

INSERT INTO `SC_category__product_options` (`optionID`, `categoryID`, `set_arbitrarily`) VALUES
(12, 543, 1),
(12, 544, 1),
(12, 545, 1),
(12, 546, 1),
(12, 547, 1),
(12, 548, 1),
(12, 549, 1),
(12, 550, 1),
(12, 551, 1),
(12, 552, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `SC_config_settings`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_config_settings`;
CREATE TABLE IF NOT EXISTS `SC_config_settings` (
  `ModuleConfigID` int(10) unsigned NOT NULL DEFAULT '0',
  `SettingName` varchar(30) DEFAULT NULL,
  `SettingValue` varchar(255) DEFAULT NULL,
  `SettingType` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `SC_countries`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_countries`;
CREATE TABLE IF NOT EXISTS `SC_countries` (
  `countryID` int(11) NOT NULL,
  `country_iso_2` varchar(2) DEFAULT NULL,
  `country_iso_3` varchar(3) DEFAULT NULL,
  `country_name_ru` varchar(64) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=246 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_countries`
--

INSERT INTO `SC_countries` (`countryID`, `country_iso_2`, `country_iso_3`, `country_name_ru`) VALUES
(1, 'AF', 'AFG', 'Афганистан'),
(2, 'AL', 'ALB', 'Албания'),
(3, 'DZ', 'DZA', 'Алжир'),
(4, 'AS', 'ASM', 'Американское Самоа'),
(5, 'AD', 'AND', 'Андорра'),
(6, 'AO', 'AGO', 'Ангола'),
(7, 'AI', 'AIA', 'Ангилья'),
(9, 'AG', 'ATG', 'Антигуа и Барбуда'),
(10, 'AR', 'ARG', 'Аргентина'),
(11, 'AM', 'ARM', 'Армения'),
(12, 'AW', 'ABW', 'Аруба'),
(13, 'AU', 'AUS', 'Австралия'),
(14, 'AT', 'AUT', 'Австрия'),
(15, 'AZ', 'AZE', 'Азербайджан'),
(16, 'BS', 'BHS', 'Багамы'),
(17, 'BH', 'BHR', 'Бахрейн'),
(18, 'BD', 'BGD', 'Бангладеш'),
(19, 'BB', 'BRB', 'Барбадос'),
(20, 'BY', 'BLR', 'Беларусь'),
(21, 'BE', 'BEL', 'Бельгия'),
(22, 'BZ', 'BLZ', 'Белиз'),
(23, 'BJ', 'BEN', 'Бенин'),
(24, 'BM', 'BMU', 'Бермуды'),
(25, 'BT', 'BTN', 'Бутан'),
(26, 'BO', 'BOL', 'Боливия'),
(27, 'BA', 'BIH', 'Босния и Герцеговина'),
(28, 'BW', 'BWA', 'Ботсвана'),
(29, 'BV', 'BVT', 'Остров Буве'),
(30, 'BR', 'BRA', 'Бразилия'),
(32, 'BN', 'BRN', 'Бруней-Даруссалам'),
(33, 'BG', 'BGR', 'Болгария'),
(34, 'BF', 'BFA', 'Буркина-Фасо'),
(35, 'BI', 'BDI', 'Бурунди'),
(36, 'KH', 'KHM', 'Камбоджа'),
(37, 'CM', 'CMR', 'Камерун'),
(38, 'CA', 'CAN', 'Канада'),
(39, 'CV', 'CPV', 'Кабо-Верде'),
(40, 'KY', 'CYM', 'Острова Кайман'),
(41, 'CF', 'CAF', 'Центрально-Африканская Республика'),
(42, 'TD', 'TCD', 'Чад'),
(43, 'CL', 'CHL', 'Чили'),
(44, 'CN', 'CHN', 'Китай'),
(46, 'CC', 'CCK', 'Кокосовые (Килинг) острова'),
(47, 'CO', 'COL', 'Колумбия'),
(48, 'KM', 'COM', 'Коморы'),
(49, 'CG', 'COG', 'Конго'),
(50, 'CK', 'COK', 'Острова Кука'),
(51, 'CR', 'CRI', 'Коста-Рика'),
(52, 'CI', 'CIV', 'Кот д’Ивуар'),
(53, 'HR', 'HRV', 'Хорватия'),
(54, 'CU', 'CUB', 'Куба'),
(55, 'CY', 'CYP', 'Кипр'),
(56, 'CZ', 'CZE', 'Чехия'),
(57, 'DK', 'DNK', 'Дания'),
(58, 'DJ', 'DJI', 'Джибути'),
(59, 'DM', 'DMA', 'Доминика'),
(60, 'DO', 'DOM', 'Доминиканская Республика'),
(61, 'TP', 'TMP', 'Восточный Тимор'),
(62, 'EC', 'ECU', 'Эквадор'),
(63, 'EG', 'EGY', 'Египет'),
(64, 'SV', 'SLV', 'Сальвадор'),
(65, 'GQ', 'GNQ', 'Экваториальная Гвинея'),
(66, 'ER', 'ERI', 'Эритрея'),
(67, 'EE', 'EST', 'Эстония'),
(68, 'ET', 'ETH', 'Эфиопия'),
(69, 'FK', 'FLK', 'Фолклендские острова (Мальвинские)'),
(70, 'FO', 'FRO', 'Фарерские острова'),
(71, 'FJ', 'FJI', 'Фиджи'),
(72, 'FI', 'FIN', 'Финляндия'),
(73, 'FR', 'FRA', 'Франция'),
(75, 'GF', 'GUF', 'Французская Гвиана'),
(76, 'PF', 'PYF', 'Французская Полинезия'),
(78, 'GA', 'GAB', 'Габон'),
(79, 'GM', 'GMB', 'Гамбия'),
(80, 'GE', 'GEO', 'Грузия'),
(81, 'DE', 'DEU', 'Германия'),
(82, 'GH', 'GHA', 'Гана'),
(83, 'GI', 'GIB', 'Гибралтар'),
(84, 'GR', 'GRC', 'Греция'),
(85, 'GL', 'GRL', 'Гренландия'),
(86, 'GD', 'GRD', 'Гренада'),
(87, 'GP', 'GLP', 'Гваделупа'),
(88, 'GU', 'GUM', 'Гуам'),
(89, 'GT', 'GTM', 'Гватемала'),
(90, 'GN', 'GIN', 'Гвинея'),
(91, 'GW', 'GNB', 'Гвинея-Бисау'),
(92, 'GY', 'GUY', 'Гайана'),
(93, 'HT', 'HTI', 'Гаити'),
(94, 'HM', 'HMD', 'Остров Херд и острова Макдональд'),
(95, 'HN', 'HND', 'Гондурас'),
(96, 'HK', 'HKG', 'Гонконг'),
(97, 'HU', 'HUN', 'Венгрия'),
(98, 'IS', 'ISL', 'Исландия'),
(99, 'IN', 'IND', 'Индия'),
(100, 'ID', 'IDN', 'Индонезия'),
(101, 'IR', 'IRN', 'Иран, исламская республика'),
(102, 'IQ', 'IRQ', 'Ирак'),
(103, 'IE', 'IRL', 'Ирландия'),
(104, 'IL', 'ISR', 'Израиль'),
(105, 'IT', 'ITA', 'Италия'),
(106, 'JM', 'JAM', 'Ямайка'),
(107, 'JP', 'JPN', 'Япония'),
(108, 'JO', 'JOR', 'Иордания'),
(109, 'KZ', 'KAZ', 'Казахстан'),
(110, 'KE', 'KEN', 'Кения'),
(111, 'KI', 'KIR', 'Кирибати'),
(112, 'KP', 'PRK', 'Корея, народно-демократическая республика'),
(113, 'KR', 'KOR', 'Корея, республика'),
(114, 'KW', 'KWT', 'Кувейт'),
(115, 'KG', 'KGZ', 'Киргизия'),
(116, 'LA', 'LAO', 'Лаосская Народно-Демократическая Республика'),
(117, 'LV', 'LVA', 'Латвия'),
(118, 'LB', 'LBN', 'Ливан'),
(119, 'LS', 'LSO', 'Лесото'),
(120, 'LR', 'LBR', 'Либерия'),
(121, 'LY', 'LBY', 'Ливийская Арабская Джамахирия'),
(122, 'LI', 'LIE', 'Лихтенштейн'),
(123, 'LT', 'LTU', 'Литва'),
(124, 'LU', 'LUX', 'Люксембург'),
(125, 'MO', 'MAC', 'Макао'),
(126, 'MK', 'MKD', 'Македония, бывшая Югославская Республика'),
(127, 'MG', 'MDG', 'Мадагаскар'),
(128, 'MW', 'MWI', 'Малави'),
(129, 'MY', 'MYS', 'Малайзия'),
(130, 'MV', 'MDV', 'Мальдивы'),
(131, 'ML', 'MLI', 'Мали'),
(132, 'MT', 'MLT', 'Мальта'),
(133, 'MH', 'MHL', 'Маршалловы Острова'),
(134, 'MQ', 'MTQ', 'Мартиника'),
(135, 'MR', 'MRT', 'Мавритания'),
(136, 'MU', 'MUS', 'Маврикий'),
(138, 'MX', 'MEX', 'Мексика'),
(139, 'FM', 'FSM', 'Микронезия, федеративные штаты'),
(140, 'MD', 'MDA', 'Молдавия'),
(141, 'MC', 'MCO', 'Монако'),
(142, 'MN', 'MNG', 'Монголия'),
(143, 'MS', 'MSR', 'Монтсеррат'),
(144, 'MA', 'MAR', 'Марокко'),
(145, 'MZ', 'MOZ', 'Мозамбик'),
(146, 'MM', 'MMR', 'Мьянма'),
(147, 'NA', 'NAM', 'Намибия'),
(148, 'NR', 'NRU', 'Науру'),
(149, 'NP', 'NPL', 'Непал'),
(150, 'NL', 'NLD', 'Нидерланды'),
(151, 'AN', 'ANT', 'Нидерландские Антилы'),
(152, 'NC', 'NCL', 'Новая Каледония'),
(153, 'NZ', 'NZL', 'Новая Зеландия'),
(154, 'NI', 'NIC', 'Никарагуа'),
(155, 'NE', 'NER', 'Нигер'),
(156, 'NG', 'NGA', 'Нигерия'),
(157, 'NU', 'NIU', 'Ниуэ'),
(158, 'NF', 'NFK', 'Остров Норфолк'),
(159, 'MP', 'MNP', 'Северные Марианские острова'),
(160, 'NO', 'NOR', 'Норвегия'),
(161, 'OM', 'OMN', 'Оман'),
(162, 'PK', 'PAK', 'Пакистан'),
(163, 'PW', 'PLW', 'Палау'),
(164, 'PA', 'PAN', 'Панама'),
(165, 'PG', 'PNG', 'Папуа — Новая Гвинея'),
(166, 'PY', 'PRY', 'Парагвай'),
(167, 'PE', 'PER', 'Перу'),
(168, 'PH', 'PHL', 'Филиппины'),
(169, 'PN', 'PCN', 'Питкерн'),
(170, 'PL', 'POL', 'Польша'),
(171, 'PT', 'PRT', 'Португалия'),
(172, 'PR', 'PRI', 'Пуэрто-Рико'),
(173, 'QA', 'QAT', 'Катар'),
(174, 'RE', 'REU', 'Реюньон'),
(175, 'RO', 'ROM', 'Румыния'),
(176, 'RU', 'RUS', 'Россия'),
(177, 'RW', 'RWA', 'Руанда'),
(178, 'KN', 'KNA', 'Сент-Китс и Невис'),
(179, 'LC', 'LCA', 'Сент-Люсия'),
(180, 'VC', 'VCT', 'Сент-Винсент и Гренадины'),
(181, 'WS', 'WSM', 'Самоа'),
(182, 'SM', 'SMR', 'Сан-Марино'),
(183, 'ST', 'STP', 'Сан-Томе и Принсипи'),
(184, 'SA', 'SAU', 'Саудовская Аравия'),
(185, 'SN', 'SEN', 'Сенегал'),
(186, 'SC', 'SYC', 'Сейшелы'),
(187, 'SL', 'SLE', 'Сьерра-Леоне'),
(188, 'SG', 'SGP', 'Сингапур'),
(189, 'SK', 'SVK', 'Словакия'),
(190, 'SI', 'SVN', 'Словения'),
(191, 'SB', 'SLB', 'Соломоновы Острова'),
(192, 'SO', 'SOM', 'Сомали'),
(193, 'ZA', 'ZAF', 'Южная Африка'),
(245, 'CS', 'SCG', 'Сербия и Черногория'),
(195, 'ES', 'ESP', 'Испания'),
(196, 'LK', 'LKA', 'Шри-Ланка'),
(197, 'SH', 'SHN', 'Святая Елена'),
(198, 'PM', 'SPM', 'Сент-Пьер и Микелон'),
(199, 'SD', 'SDN', 'Судан'),
(200, 'SR', 'SUR', 'Суринам'),
(201, 'SJ', 'SJM', 'Шпицберген и Ян Майен'),
(202, 'SZ', 'SWZ', 'Свазиленд'),
(203, 'SE', 'SWE', 'Швеция'),
(204, 'CH', 'CHE', 'Швейцария'),
(205, 'SY', 'SYR', 'Сирийская Арабская Республика'),
(206, 'TW', 'TWN', 'Тайвань'),
(207, 'TJ', 'TJK', 'Таджикистан'),
(208, 'TZ', 'TZA', 'Танзания, объединенная республика'),
(209, 'TH', 'THA', 'Таиланд'),
(210, 'TG', 'TGO', 'Того'),
(211, 'TK', 'TKL', 'Токелау'),
(212, 'TO', 'TON', 'Тонга'),
(213, 'TT', 'TTO', 'Тринидад и Тобаго'),
(214, 'TN', 'TUN', 'Тунис'),
(215, 'TR', 'TUR', 'Турция'),
(216, 'TM', 'TKM', 'Туркмения'),
(217, 'TC', 'TCA', 'Острова Теркс и Кайкос'),
(218, 'TV', 'TUV', 'Тувалу'),
(219, 'UG', 'UGA', 'Уганда'),
(220, 'UA', 'UKR', 'Украина'),
(221, 'AE', 'ARE', 'Объединенные Арабские Эмираты'),
(222, 'GB', 'GBR', 'Соединенное Королевство'),
(223, 'US', 'USA', 'Соединенные Штаты Америки'),
(225, 'UY', 'URY', 'Уругвай'),
(226, 'UZ', 'UZB', 'Узбекистан'),
(227, 'VU', 'VUT', 'Вануату'),
(228, 'VA', 'VAT', 'Ватикан'),
(229, 'VE', 'VEN', 'Венесуэла'),
(230, 'VN', 'VNM', 'Вьетнам'),
(231, 'VG', 'VGB', 'Виргинские острова, Британские'),
(232, 'VI', 'VIR', 'Виргинские острова, США'),
(233, 'WF', 'WLF', 'Острова Уоллис и Футуна'),
(234, 'EH', 'ESH', 'Западная Сахара'),
(235, 'YE', 'YEM', 'Йемен'),
(244, 'PS', 'PSE', 'Палестина'),
(238, 'ZM', 'ZMB', 'Замбия'),
(239, 'ZW', 'ZWE', 'Зимбабве');

-- --------------------------------------------------------

--
-- Структура таблицы `SC_currency_types`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_currency_types`;
CREATE TABLE IF NOT EXISTS `SC_currency_types` (
  `CID` int(11) NOT NULL,
  `code` varchar(7) DEFAULT NULL,
  `currency_value` double DEFAULT NULL,
  `where2show` int(11) DEFAULT NULL,
  `sort_order` int(11) DEFAULT '0',
  `currency_iso_3` varchar(3) DEFAULT NULL,
  `decimal_symbol` char(1) NOT NULL DEFAULT '',
  `decimal_places` int(10) unsigned NOT NULL DEFAULT '0',
  `thousands_delimiter` char(1) NOT NULL DEFAULT '',
  `Name_ru` varchar(30) DEFAULT NULL,
  `display_template_ru` varchar(20) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_currency_types`
--

INSERT INTO `SC_currency_types` (`CID`, `code`, `currency_value`, `where2show`, `sort_order`, `currency_iso_3`, `decimal_symbol`, `decimal_places`, `thousands_delimiter`, `Name_ru`, `display_template_ru`) VALUES
(3, 'руб.', 1, 1, 0, 'RUR', '.', 0, '_', 'Рубли', '{value} руб.');

-- --------------------------------------------------------

--
-- Структура таблицы `SC_custgroups`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_custgroups`;
CREATE TABLE IF NOT EXISTS `SC_custgroups` (
  `custgroupID` int(11) NOT NULL,
  `custgroup_discount` float DEFAULT '0',
  `sort_order` int(11) DEFAULT '0',
  `custgroup_name_ru` varchar(64) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_custgroups`
--

INSERT INTO `SC_custgroups` (`custgroupID`, `custgroup_discount`, `sort_order`, `custgroup_name_ru`) VALUES
(3, 0, 1, 'Розница'),
(4, 10, 2, 'Опт');

-- --------------------------------------------------------

--
-- Структура таблицы `SC_customers`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Авг 24 2015 г., 13:09
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_customers`;
CREATE TABLE IF NOT EXISTS `SC_customers` (
  `customerID` int(11) NOT NULL,
  `Login` varchar(32) NOT NULL,
  `cust_password` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(64) DEFAULT NULL,
  `first_name` varchar(32) DEFAULT NULL,
  `last_name` varchar(32) DEFAULT NULL,
  `subscribed4news` int(11) DEFAULT NULL,
  `custgroupID` int(11) DEFAULT NULL,
  `addressID` int(11) DEFAULT NULL,
  `reg_datetime` datetime DEFAULT NULL,
  `CID` int(11) DEFAULT NULL,
  `affiliateID` int(11) NOT NULL DEFAULT '0',
  `affiliateEmailOrders` int(11) NOT NULL DEFAULT '1',
  `affiliateEmailPayments` int(11) NOT NULL DEFAULT '1',
  `ActivationCode` varchar(16) NOT NULL DEFAULT '',
  `vkontakte_id` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_customers`
--

INSERT INTO `SC_customers` (`customerID`, `Login`, `cust_password`, `Email`, `first_name`, `last_name`, `subscribed4news`, `custgroupID`, `addressID`, `reg_datetime`, `CID`, `affiliateID`, `affiliateEmailOrders`, `affiliateEmailPayments`, `ActivationCode`, `vkontakte_id`) VALUES
(11, '', '', 'stat@dancelife-shop.ru', 'Елена', '---', 0, 3, 20, '2011-09-28 12:38:37', 0, 0, 1, 1, '', 0),
(12, '', '', 'sovazh@yahoo.com', 'Oleg', 'Serzhantov', 0, 3, 0, '2011-09-28 20:40:27', 0, 0, 0, 0, '', 0),
(10, '', '', 'stat@dancelife-shop.ru', 'Ирина', '---', 0, 3, 19, '2011-09-28 12:32:40', 0, 0, 1, 1, '', 0),
(6, '', '', 'starikovap@mail.ru', 'антон', 'стар', 0, 3, 0, '2011-08-12 16:49:45', 0, 0, 0, 0, '', 0),
(8, '', '', 'ekaterina.serzha@mail.ru', 'екатерина', 'сержантова', 1, 3, 0, '2011-08-19 18:20:55', 0, 0, 0, 0, '', 0),
(9, 'dancer729', 'MjM3OTQ3MQ==', 'dancer729@gmail.com', 'Юрий', 'Маркелов', 1, 3, 0, '2011-08-28 09:30:56', 0, 0, 0, 0, '', 0),
(13, '', '', 'guees777@rambler.ru', 'Юрий', 'Петров', 0, 3, 0, '2011-10-25 23:04:30', 0, 0, 0, 0, '', 0),
(14, '', '', 'Mes2006.79@mail.ru', 'Сорокин', 'Евгений', 1, 3, 0, '2011-11-02 14:47:22', 0, 0, 0, 0, '', 0),
(15, '', '', 'guees777@mail.ru', 'Елена', 'Гончарова', 1, 3, 0, '2011-11-16 21:25:30', 0, 0, 0, 0, '', 0),
(16, 'lizashrei', 'MDgwODk2', 'lizashrei@pochta.ru', 'Казакова', 'Елизавета', 1, 3, 0, '2011-12-07 20:46:09', 0, 0, 0, 0, '', 0),
(17, 'alena_alkina@mail.ru', 'cGFwYW1hbWFp', 'alena_alkina@mail.ru', 'Алёна', 'Алькина', 1, 3, 31, '2011-12-08 01:59:37', 3, 0, 1, 1, '', NULL),
(18, 'vlasova12345', 'MDFqYXN0aW4wNjIwMDY=', 'vlasova12345@yandex.ru', 'Наталья', 'Власова', 1, 3, 32, '2012-01-19 18:59:22', 3, 0, 1, 1, '', NULL),
(19, 'oseychuk', 'LHRramRm', 'oseychuk@rambler.ru', 'Сергей', 'Осейчук', 1, 3, 0, '2012-01-29 20:07:48', 0, 0, 0, 0, '', 0),
(20, 'egradova', 'RmFiaXVzMjAxMw==', 'egradova@yandex.ru', 'Elena', 'Gradova', 1, 3, 0, '2012-02-11 16:37:03', 0, 0, 0, 0, '', 0),
(21, '', '', 'martinenko.06@mail.ru', 'Елена', 'Бусыгина', 0, 3, 0, '2012-02-29 14:18:58', 0, 0, 0, 0, '', 0),
(22, '', '', 'filippovsergei@gmail.com', 'Сергей', 'Филиппов', 0, 3, 0, '2012-03-01 17:32:38', 0, 0, 0, 0, '', 0),
(23, 'kea_dba', 'bmhqYndm', 'krivets_ea@mail.ru', 'Евгения', 'Кривец', 0, 3, 0, '2012-03-23 17:51:19', 0, 0, 0, 0, '', 0),
(24, '', '', 'olegss1@mail.ru', 'Татьяна', 'Сизова', 1, 3, 0, '2012-03-30 15:47:52', 0, 0, 0, 0, '', 0),
(25, '', '', 'Shmonin_Alex@rambler.ru', 'Александр', 'Шмонин', 1, 3, 0, '2012-04-03 12:32:21', 0, 0, 0, 0, '', 0),
(26, '', '', 'jolly-5@yandex.ru', 'Ольга', 'Журбенко', 1, 3, 0, '2012-04-25 11:40:02', 0, 0, 0, 0, '', 0),
(27, 'svetlana_k', 'MDIxMjEy', 'svetlana_knyagin@mail.ru', 'Светлана', 'Княгиничева', 1, 3, 0, '2012-06-18 15:50:28', 0, 0, 0, 0, '', 0),
(28, '', '', 'Fairy6@mail.ru', 'Ирина', 'Ирина', 0, 3, 0, '2012-06-25 11:37:20', 0, 0, 0, 0, '', 0),
(29, '', '', 'jolly-5@yandex.ru', 'Ольга', 'Ж', 0, 3, 0, '2012-07-11 10:51:12', 0, 0, 0, 0, '', 0),
(30, '', '', 'Katya_sa@mail.ru', 'Катя', 'К', 1, 3, 0, '2012-07-15 22:04:01', 0, 0, 0, 0, '', 0),
(31, 'Oks.34', 'MDYyNzEw', 'oks.shegol@mail.ru', 'Оксана', 'Щеголеватых', 1, 3, 57, '2012-08-07 19:28:49', 3, 0, 1, 1, '', NULL),
(32, '89242808760', '0JHQvtCxNzc3', 'Inna1978205@rambler.ru', 'Инна', 'Наумёнок', 1, 3, 0, '2012-08-31 15:16:22', 0, 0, 0, 0, '', 0),
(33, '', '', 'galk.anastasija@rambler.ru', 'Анастасия', 'Галко', 1, 3, 0, '2012-09-01 12:53:42', 0, 0, 0, 0, '', 0),
(34, '', '', 'ivp@ctot.ru', 'Игорь', 'Павлычев', 0, 3, 0, '2012-09-30 20:06:02', 0, 0, 0, 0, '', 0),
(35, '', '', 'fetalina@mail.ru', 'Елена', 'Фетисова', 1, 3, 0, '2012-11-08 17:33:18', 0, 0, 0, 0, '', 0),
(36, '', '', 'yanamin@yandex.ru', 'Яна', 'Минаева', 1, 3, 0, '2012-11-19 13:44:19', 0, 0, 0, 0, '', 0),
(37, '', '', 'mr-ostrovsky@yandex.ru', 'Роман', 'Островский', 0, 3, 0, '2012-12-11 14:35:06', 0, 0, 0, 0, '', 0),
(38, 'Svetlana Levantovskaya', 'MTkwOTE5Njg=', 'Svetlana_levantavskaya@mail.ru', 'Svetlana', 'levantovskaya', 1, 3, 70, '2012-12-25 15:14:15', 3, 0, 1, 1, '', NULL),
(39, '', '', 'm.tanaeva@mail.ru', 'Танаева', 'Мария', 1, 3, 0, '2013-01-13 22:28:31', 0, 0, 0, 0, '', 0),
(40, '', '', 'jolly-5@yandex.ru', 'Ольга', 'Жур', 1, 3, 0, '2013-01-14 12:09:45', 0, 0, 0, 0, '', 0),
(41, '', '', 'apelsinka03@list.ru', 'Кристина', 'Эртель ', 0, 3, 0, '2013-01-24 19:07:26', 0, 0, 0, 0, '', 0),
(42, '', '', 'Prowotorowa.galina2010@yandex.ru', 'Галина', 'Провоторова', 1, 3, 0, '2013-02-01 15:36:42', 0, 0, 0, 0, '', 0),
(43, '', '', 'imcentre2@gmail.com', 'Александр', 'Борисов', 0, 3, 0, '2013-03-05 10:20:18', 0, 0, 0, 0, '', 0),
(44, '', '', '12345@mail.ru', '---', '---', 0, 3, 81, '2013-03-31 19:18:15', NULL, 0, 1, 1, '', NULL),
(45, '', '', 'dr.atalis@yandex.ru', 'сергей', 'сергей', 0, 3, 0, '2013-04-19 10:24:31', 0, 0, 0, 0, '', 0),
(46, '', '', 'apechenova@raiffeisen.ru', 'Анна', 'Печенова', 0, 3, 0, '2013-07-05 12:09:04', 0, 0, 0, 0, '', 0),
(47, '', '', 'alena_alkina@mail.ru', 'Алена', 'Алькина', 0, 3, 0, '2013-08-17 15:26:42', 0, 0, 0, 0, '', 0),
(48, '+79269139936', 'YTgzMDkwNA==', 'Batishcheva_natal@mail.ru', 'Наталья', 'Батищева', 1, 3, 0, '2013-08-24 15:25:00', 0, 0, 0, 0, '', 0),
(49, 'oksana', 'b2tzYW5h', 'ok.browkina@yandex.ru', 'Oksana', 'Brovkina', 1, 3, 90, '2013-09-04 10:39:03', 3, 0, 1, 1, '', NULL),
(50, '', '', 'Lenad72@mail.ru', 'Елена', 'Джабарова', 1, 3, 0, '2013-09-19 09:51:22', 0, 0, 0, 0, '', 0),
(51, '', '', 'Sestruccho@gmail.com', 'Анна', 'Асеева', 1, 3, 0, '2013-09-22 09:55:19', 0, 0, 0, 0, '', 0),
(52, '', '', 'dfhdfh@gsdfgsdfg.com', 'fgdh', 'dfghdf', 0, 3, 0, '2013-10-31 21:51:34', 0, 0, 0, 0, '', 0),
(53, '', '', 'Kuznezma@mail.ri', 'Мария', 'Кузнецова', 1, 3, 0, '2013-12-07 23:45:37', 0, 0, 0, 0, '', 0),
(54, '', '', 'petrova.cstc@yandex.ru', 'Елена', 'Петрова', 1, 3, 0, '2014-01-05 16:28:52', 0, 0, 0, 0, '', 0),
(55, '', '', 'imagemaxinfo@gmail.com', 'Евгения', ' касанаве', 1, 3, 0, '2014-01-10 14:13:06', 0, 0, 0, 0, '', 0),
(56, '', '', 'dr.atalis@yandex.ru', 'Сергей', 'Ф', 0, 3, 0, '2014-01-16 10:35:37', 0, 0, 0, 0, '', 0),
(57, 'MrHuman', 'NDg4MzI2NQ==', 'munes-artur@yandex.ru', 'Артур', 'Мунес', 0, 3, 0, '2014-02-04 08:51:18', 0, 0, 0, 0, '', 0),
(58, 'nderevjanko', 'dGFnYW5yb2c=', 'nderevjanko@mail.ru', 'Наталия', 'Деревянко', 0, 3, 0, '2014-02-13 23:58:27', 0, 0, 0, 0, '', 0),
(59, '', '', 'imagemaxinfo@gmail.com', 'Евгения', ' касанаве', 0, 3, 0, '2014-03-04 01:07:10', 0, 0, 0, 0, '', 0),
(60, 'danceolymp', 'RGFuY2U0ZXZlcg==', 'ngmail@ya.ru', 'Наталья', 'Мильчакова', 1, 3, 0, '2014-03-10 17:22:33', 0, 0, 0, 0, '', 0),
(61, '', '', 'Ura-abushinov@yandex.ru', 'Юрий', 'Абушинов', 1, 3, 0, '2014-04-13 01:32:39', 0, 0, 0, 0, '', 0),
(62, 'sharik', 'MTIzNGFzZGY=', 'jew@gmx.de', 'Tester', 'Test', 1, 3, 0, '2014-05-07 15:23:07', 0, 0, 0, 0, '', 0),
(63, '', '', 'olegss1@mail.ru', 'oleg', 'oleg', 1, 3, 0, '2014-07-30 17:13:51', 0, 0, 0, 0, '', 0),
(64, 'ribka_77', 'UG9saW5hMTQxMjIwMDQ=', 'petrova.cstc@yandex.ru', 'Елена', 'Петрова', 1, 3, 0, '2014-08-04 18:30:37', 0, 0, 0, 0, '', 0),
(65, '', '', 'petrova.cstc@yandex.ru', 'Елена', 'Петрова', 1, 3, 0, '2014-09-03 10:05:38', 0, 0, 0, 0, '', 0),
(66, '', '', 'petrova.cstc@yandex.ru', 'Елена', 'Петрова', 0, 3, 0, '2014-10-05 12:02:38', 0, 0, 0, 0, '', 0),
(67, '', '', 'n1604n@yandex.ru', 'Наталия', 'Буденная', 1, 3, 0, '2014-11-27 16:28:39', 0, 0, 0, 0, '', 0),
(68, '', '', 'nune.sogomonyan2012@yandex.ru', 'Нуне', 'Согомонян', 1, 3, 0, '2014-12-03 01:13:31', 0, 0, 0, 0, '', 0),
(69, '', '', 'olga-0412@mail.ru', 'Ольга', 'Афанасьева', 1, 3, 0, '2014-12-05 12:20:21', 0, 0, 0, 0, '', 0),
(70, '', '', 'Vperkova@yandex.ru', 'Вера', 'Перкова', 1, 3, 0, '2014-12-08 19:15:18', 0, 0, 0, 0, '', 0),
(71, '', '', 'kost47@yandex.ru', 'Марина', 'Мерзликина', 1, 3, 0, '2015-02-07 15:56:08', 0, 0, 0, 0, '', 0),
(72, '', '', 'by_sundik@mail.ru', 'Наталья', 'Будько', 0, 3, 0, '2015-02-10 13:22:32', 0, 0, 0, 0, '', 0),
(73, '', '', 'welcome@dancelife-ee.ru', 'Oleg', 'Petrov', 1, 3, 0, '2015-02-11 13:41:59', 0, 0, 0, 0, '', 0),
(74, '', '', 'welcome@dancelife-ee.ru', 'Oleg', 'Petrov', 1, 3, 0, '2015-02-11 14:04:57', 0, 0, 0, 0, '', 0),
(75, '', '', 'sabina.s.kh@gmail.com', 'Сабина ', 'Хачатурян', 1, 3, 0, '2015-02-25 14:32:41', 0, 0, 0, 0, '', 0),
(76, '', '', 'email@email.ru', 'частное ', 'лицо', 0, 3, 143, '2015-02-26 15:57:46', NULL, 0, 1, 1, '', NULL),
(77, '', '', 'Mrznasty1996@mail.ru', 'Александр', 'Поплёвко', 0, 3, 0, '2015-04-10 13:54:42', 0, 0, 0, 0, '', 0),
(78, 'Preciosa', 'RGFuY2VjaGFtcA==', 'apechenova@raiffeisen.ru', 'Анна', 'Печенова', 0, 3, 0, '2015-06-12 19:51:12', 0, 0, 0, 0, '', 0),
(79, '', '', 'Luzin@aerogeologia.ru', 'Алексей', 'Лузин', 1, 3, 0, '2015-08-05 13:38:36', 0, 0, 0, 0, '', 0),
(80, '', '', 'Yanamin@yandex.ru', 'Яна', 'Минаева', 0, 3, 0, '2015-08-24 16:08:59', 0, 0, 0, 0, '', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `SC_customer_addresses`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Авг 24 2015 г., 13:09
--

DROP TABLE IF EXISTS `SC_customer_addresses`;
CREATE TABLE IF NOT EXISTS `SC_customer_addresses` (
  `addressID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL DEFAULT '0',
  `first_name` varchar(64) DEFAULT NULL,
  `last_name` varchar(64) DEFAULT NULL,
  `countryID` int(11) DEFAULT NULL,
  `zoneID` int(11) DEFAULT NULL,
  `zip` varchar(64) DEFAULT NULL,
  `state` varchar(64) DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `address` text
) ENGINE=MyISAM AUTO_INCREMENT=152 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_customer_addresses`
--

INSERT INTO `SC_customer_addresses` (`addressID`, `customerID`, `first_name`, `last_name`, `countryID`, `zoneID`, `zip`, `state`, `city`, `address`) VALUES
(23, 13, '-', '-', 176, 186, '', '', 'Москва', 'Сокольнический вал 27/10. танцевальный зал "Форум", здание НИИСУ'),
(21, 12, '-', '-', 176, 186, '117648', '', 'Moscow', 'Severnoe Chertanovo'),
(22, 12, '-', '-', 176, 186, '117648', '', 'Moscow', 'Severnoe Chertanovo'),
(19, 10, 'Ирина', '---', 176, 186, '', '', 'Москва', 'Новый Арбат 15, стр. 2'),
(11, 6, '-', '-', 176, 186, '', '', 'москва', 'fdfdf11 566'),
(12, 6, '-', '-', 176, 186, '', '', 'москва', 'fdfdf11 566'),
(20, 11, '---', '---', 176, 186, '', '', 'Москва', 'Чечеринский проезд, д. 94, кв. 88'),
(15, 8, '-', '-', 176, 186, '', '', 'Москва', 'Пятницкое шоссе,д.15,кв 118'),
(16, 8, '-', '-', 176, 186, '', '', 'Москва', 'Пятницкое шоссе,д.15,кв 118'),
(17, 9, '-', '-', 176, 186, '', '', 'Москва', 'Большая Декабрьская, 8, кв. 68'),
(18, 9, '-', '-', 176, 186, '', '', 'Москва', 'Большая Декабрьская, 8, кв. 68'),
(24, 13, '-', '-', 176, 186, '', '', 'Москва', 'Сокольнический вал 27/10. танцевальный зал "Форум", здание НИИСУ'),
(25, 14, '-', '-', 176, 186, '', '', 'Москва', 'Улица Паршина, д. 41, кВ.9'),
(26, 14, '-', '-', 176, 186, '', '', 'Москва', 'Улица Паршина, д. 41, кВ.9'),
(27, 15, '-', '-', 176, 186, '', '', 'Москва', 'Крокус Сити, гостиница "Аквариум"'),
(28, 15, '-', '-', 176, 186, '', '', 'Москва', 'Крокус Сити, гостиница "Аквариум"'),
(29, 16, '-', '-', 176, 186, '119334', '', 'Москва', 'Ленинский проспект 37а квартира 204'),
(30, 16, '-', '-', 176, 186, '119334', '', 'Москва', 'Ленинский проспект 37а квартира 204'),
(31, 17, 'Алёна', 'Алькина', 176, 186, '127238', '', 'Москва', '3-ий Нижнелихоборский пр,д11 кв5,этаж 2, домофон 5'),
(32, 18, 'Наталья', 'Власова', 176, 186, '', '', 'москва', 'ул. Погодинская 1,стр.1'),
(33, 19, '-', '-', 176, 257, '625051', '', 'Тюмень', 'Г.Тюмень, ул. Николая Гондатти 5, кв.45, '),
(34, 19, '-', '-', 176, 257, '625051', '', 'Тюмень', 'Г.Тюмень, ул. Николая Гондатти 5, кв.45, '),
(35, 20, '-', '-', 176, 186, '', '', 'Москва', 'Пресненская наб.,12'),
(36, 20, '-', '-', 176, 186, '', '', 'Москва', 'Пресненская наб.,12'),
(37, 21, '-', '-', 176, 186, '', '', 'Москва', 'Гарибальди 28 к1, кв. 259'),
(38, 21, '-', '-', 176, 186, '', '', 'Москва', 'Гарибальди 28 к1, кв. 259'),
(39, 22, '-', '-', 176, 186, '', '', 'Москва', 'ул марксистская д22 офис 107'),
(40, 22, '-', '-', 176, 186, '', '', 'Москва', 'ул марксистская д22 офис 107'),
(41, 23, '-', '-', 176, 186, '', '', 'Москва', 'м. Савеловская. (будни и суббота)\r\nУл Вятская 13, 2-ой подъезд. От метро 10 минут пешком\r\n\r\nм. Римская. (воскресенье)\r\nул. Нижегородская, 32, стр.А. Ориентир - спорт - клуб "Кенгуру". От метро 15-20 минут пешком.'),
(42, 23, '-', '-', 176, 186, '', '', 'Москва', 'м. Савеловская. (будни и суббота)\r\nУл Вятская 13, 2-ой подъезд. От метро 10 минут пешком\r\n\r\nм. Римская. (воскресенье)\r\nул. Нижегородская, 32, стр.А. Ориентир - спорт - клуб "Кенгуру". От метро 15-20 минут пешком.'),
(43, 24, '-', '-', 176, 186, '', '', 'Москва', 'Алтуфьево'),
(44, 24, '-', '-', 176, 186, '', '', 'Москва', 'Алтуфьево'),
(45, 25, '-', '-', 176, 186, '', '', 'Москва', 'Ул.Перекопская д.28 , школа 1115 , СТК "Динамо"'),
(46, 25, '-', '-', 176, 186, '', '', 'Москва', 'Ул.Перекопская д.28 , школа 1115 , СТК "Динамо"'),
(47, 26, '-', '-', 176, 186, '', '', 'Москва', 'Москва, м. Дмитровская, ул. Бутырская д. 76 стр. 1 (бизнес центр)'),
(48, 26, '-', '-', 176, 186, '', '', 'Москва', 'Москва, м. Дмитровская, ул. Бутырская д. 76 стр. 1 (бизнес центр)'),
(49, 27, '-', '-', 176, 212, '614068', '', 'Пермь', 'ул. Петропавловская, 111-97'),
(50, 27, '-', '-', 176, 212, '614068', '', 'Пермь', 'ул. Петропавловская, 111-97'),
(51, 28, '-', '-', 176, 186, '117461', '', 'Москва', 'ул.Перекопская, д.34,корп.1, кв.106'),
(52, 28, '-', '-', 176, 186, '117461', '', 'Москва', 'ул.Перекопская, д.34,корп.1, кв.106'),
(53, 29, '-', '-', 176, 186, '', '', 'Москва', 'Москва, ул. Бутырская д. 76 стр.1'),
(54, 29, '-', '-', 176, 186, '', '', 'Москва', 'Москва, ул. Бутырская д. 76 стр.1'),
(55, 30, '-', '-', 176, 186, '', '', 'Москва', 'Вернадского 94/2, кВ 42'),
(56, 30, '-', '-', 176, 186, '', '', 'Москва', 'Вернадского 94/2, кВ 42'),
(57, 31, 'Оксана', 'Щеголеватых', 176, 222, '400064', '', 'Волгоград', '400064 г. Волгоград\r\nул.Библиотечная д.7 кв.125'),
(58, 32, '-', '-', 176, 250, '693004', '', 'Южно-Сахалинск', 'проспект Мира,д.395,кв.24'),
(59, 32, '-', '-', 176, 250, '693004', '', 'Южно-Сахалинск', 'проспект Мира,д.395,кв.24'),
(60, 33, '-', '-', 176, 186, '', '', 'Москва', 'Самаркандский бульвар,квартал 137а,корпус 9,квартира 199'),
(61, 33, '-', '-', 176, 186, '', '', 'Москва', 'Самаркандский бульвар,квартал 137а,корпус 9,квартира 199'),
(62, 34, '-', '-', 176, 254, '170024', '', 'Тверь', 'ул. М.Конева д.12 корп.1 кв.26'),
(63, 34, '-', '-', 176, 254, '170024', '', 'Тверь', 'ул. М.Конева д.12 корп.1 кв.26'),
(64, 35, '-', '-', 176, 186, '', '', 'Москва', 'ул.Кибальчича, дом 12 корпус 2, квартира 193, 13 этаж'),
(65, 35, '-', '-', 176, 186, '', '', 'Москва', 'ул.Кибальчича, дом 12 корпус 2, квартира 193, 13 этаж'),
(66, 36, '-', '-', 176, 213, '690091', '', 'Владивосток', 'ул. Пологая, д. 50, кв. 12'),
(67, 36, '-', '-', 176, 213, '690091', '', 'Владивосток', 'ул. Пологая, д. 50, кв. 12'),
(68, 37, '-', '-', 176, 186, '', '', 'Москва', 'Сиреневый б-р д.45 кв.34'),
(69, 37, '-', '-', 176, 186, '', '', 'Москва', 'Сиреневый б-р д.45 кв.34'),
(70, 38, 'Svetlana', 'levantovskaya', 176, 186, '121614', '', 'Москва', 'Крылатские холмы,47,43'),
(71, 39, '-', '-', 176, 186, '', '', 'Москва', 'Ул.Новокосинская '),
(72, 39, '-', '-', 176, 186, '', '', 'Москва', 'Ул.Новокосинская '),
(73, 40, '-', '-', 176, 186, '127015', '', 'Москва', 'ул. Бутырская д. 76 стр. 1 Бизнес-центр, вход между Иль Патио и Шоколадницей'),
(74, 40, '-', '-', 176, 186, '127015', '', 'Москва', 'ул. Бутырская д. 76 стр. 1 Бизнес-центр, вход между Иль Патио и Шоколадницей'),
(75, 41, '-', '-', 176, 186, '', '', 'Москва ', 'ул.Варшавское шоссе, д.10 корпус 1, кв.24.'),
(76, 41, '-', '-', 176, 186, '', '', 'Москва ', 'ул.Варшавское шоссе, д.10 корпус 1, кв.24.'),
(77, 42, '-', '-', 176, 186, '', '', 'Москва', 'Дмитровское шоссе 131-2-78. 3 подъезд, 5 этаж.'),
(78, 42, '-', '-', 176, 186, '', '', 'Москва', 'Дмитровское шоссе 131-2-78. 3 подъезд, 5 этаж.'),
(79, 43, '-', '-', 176, 186, '', '', 'Москва', 'Ул.Нарвская д.1А корп.1\r\nКв.113'),
(80, 43, '-', '-', 176, 186, '', '', 'Москва', 'Ул.Нарвская д.1А корп.1\r\nКв.113'),
(81, 44, '---', '---', 176, 186, '', '', 'Москва', 'ул. Снежная д. 16, корп. 3'),
(82, 45, '-', '-', 176, 186, '', '', 'Москва', 'дежнева 15 кор 1 кв 107'),
(83, 45, '-', '-', 176, 186, '', '', 'Москва', 'дежнева 15 кор 1 кв 107'),
(84, 46, '-', '-', 176, 186, '', '', 'Москва', 'Смоленская - Сенная пл., 28 подъезд 1'),
(85, 46, '-', '-', 176, 186, '', '', 'Москва', 'Смоленская - Сенная пл., 28 подъезд 1'),
(86, 47, '-', '-', 176, 186, '', '', 'Москва', 'Ул. Астрадамская д. 9 кор 2, кв.97,4 этаж, домофон 97к5847'),
(87, 47, '-', '-', 176, 186, '', '', 'Москва', 'Ул. Астрадамская д. 9 кор 2, кв.97,4 этаж, домофон 97к5847'),
(88, 48, '-', '-', 176, 186, '', '', 'Москва', 'Ленинградский проспект 33А'),
(89, 48, '-', '-', 176, 186, '', '', 'Москва', 'Ленинградский проспект 33А'),
(90, 49, 'Oksana', 'Brovkina', 176, 186, '143040', '', 'Голицыно', 'М.О,Одинцовский район,г.Голицыно'),
(91, 50, '-', '-', 176, 186, '', '', 'Москва', 'Ул. Гарибальди 7 кв17'),
(92, 50, '-', '-', 176, 186, '', '', 'Москва', 'Ул. Гарибальди 7 кв17'),
(93, 51, '-', '-', 176, 186, '', '', 'Москва', 'Краснопролетарская ул, дом 9, кв, 151'),
(94, 51, '-', '-', 176, 186, '', '', 'Москва', 'Краснопролетарская ул, дом 9, кв, 151'),
(95, 52, '-', '-', 176, 186, '', '', 'sdfggdsfg', 'gsdfgdfg'),
(96, 52, '-', '-', 176, 186, '', '', 'sdfggdsfg', 'gsdfgdfg'),
(97, 53, '-', '-', 176, 186, '', '', 'Москва', 'Ул. Щербаковская, дом 26 , кв . 244'),
(98, 53, '-', '-', 176, 186, '', '', 'Москва', 'Ул. Щербаковская, дом 26 , кв . 244'),
(99, 54, '-', '-', 176, 186, '', '', 'Москва', 'Яна Райниса, д.7/1, кв.48'),
(100, 54, '-', '-', 176, 186, '', '', 'Москва', 'Яна Райниса, д.7/1, кв.48'),
(101, 55, '-', '-', 176, 186, '', '', 'москва', 'Проезд Березовой Рощи, 12, кв.526,5подъезд,22 этаж'),
(102, 55, '-', '-', 176, 186, '', '', 'москва', 'Проезд Березовой Рощи, 12, кв.526,5подъезд,22 этаж'),
(103, 56, '-', '-', 176, 186, '', '', 'Москва', 'Дежнева 15-1-107'),
(104, 56, '-', '-', 176, 186, '', '', 'Москва', 'Дежнева 15-1-107'),
(105, 57, '-', '-', 176, 186, '', '', 'Москва', 'Дубнинская ул., дом 53/2, кв. 84'),
(106, 57, '-', '-', 176, 186, '', '', 'Москва', 'Дубнинская ул., дом 53/2, кв. 84'),
(107, 58, '-', '-', 176, 186, '', '', 'Москва', 'Погонный проезд д.52, кв.8'),
(108, 58, '-', '-', 176, 186, '', '', 'Москва', 'Погонный проезд д.52, кв.8'),
(109, 59, '-', '-', 176, 186, '', '', 'москва', 'Проезд Березовой Рощи, 12, кв.526,5подъезд, 22 этаж'),
(110, 59, '-', '-', 176, 186, '', '', 'москва', 'Проезд Березовой Рощи, 12, кв.526,5подъезд, 22 этаж'),
(111, 60, '-', '-', 176, 186, '117296', ' Московская область', 'Москва', 'Ломоносовский проспект, д. 18, кв. 162'),
(112, 60, '-', '-', 176, 186, '117296', '', 'Москва', 'Ломоносовский проспект, д. 18, кв. 162'),
(113, 61, '-', '-', 176, 186, '', '', 'Москва', 'Ленинградский пр.31а б/ц монарх'),
(114, 61, '-', '-', 176, 186, '', '', 'Москва', 'Ленинградский пр.31а б/ц монарх'),
(115, 62, '-', '-', 176, 186, '155524', '', 'Простоквашино', 'Простоквашино 1'),
(116, 62, '-', '-', 176, 186, '155524', '', 'Простоквашино', 'Простоквашино 1'),
(117, 63, '-', '-', 176, 186, '', '', 'Москва', 'Зюзино'),
(118, 63, '-', '-', 176, 186, '', '', 'Москва', 'Зюзино'),
(119, 64, '-', '-', 176, 186, '125363', '', 'Москва', 'б-р Яна Райниса, д.7/1, кв.48'),
(120, 64, '-', '-', 176, 186, '125363', '', 'Москва', 'б-р Яна Райниса, д.7/1, кв.48'),
(121, 65, '-', '-', 176, 186, '', '', 'Москва', 'Яна Райниса, д.7/1, кв.48'),
(122, 65, '-', '-', 176, 186, '', '', 'Москва', 'Яна Райниса, д.7/1, кв.48'),
(123, 66, '-', '-', 176, 186, '', '', 'Москва', 'б-р Яна Райниса, д.7/1, кв.48'),
(124, 66, '-', '-', 176, 186, '', '', 'Москва', 'б-р Яна Райниса, д.7/1, кв.48'),
(125, 67, '-', '-', 176, 186, '', '', 'Москва', 'бр.Д. Донского 11 кв.247  '),
(126, 67, '-', '-', 176, 186, '', '', 'Москва', 'бр.Д. Донского 11 кв.247  '),
(127, 68, '-', '-', 176, 186, '', '', 'Коломна', 'Московская область, город Коломна, село Пирочи, улица Центральная, дом 7, квартира 4'),
(128, 68, '-', '-', 176, 186, '', '', 'Коломна', 'Московская область, город Коломна, село Пирочи, улица Центральная, дом 7, квартира 4'),
(129, 69, '-', '-', 176, 186, '', '', 'Москва', 'Флотская 5А, оф.509'),
(130, 69, '-', '-', 176, 186, '', '', 'Москва', 'Флотская 5А, оф.509'),
(131, 70, '-', '-', 176, 186, '', '', 'Лобня', 'Лобня Ленина 23, корпус 11, квартира 23. '),
(132, 70, '-', '-', 176, 186, '', '', 'Лобня', 'Лобня Ленина 23, корпус 11, квартира 23. '),
(133, 71, '-', '-', 176, 186, '119454', '', 'Москва', 'ул.Удальцова,д.85.к.4, домофон 134,кв.130'),
(134, 71, '-', '-', 176, 186, '119454', '', 'Москва', 'ул.Удальцова,д.85.к.4, домофон 134,кв.130'),
(135, 72, '-', '-', 176, 186, '121151', '', 'Москва', 'Кутузовский проспект 24-441, 16 подъезд, 9 этаж'),
(136, 72, '-', '-', 176, 186, '121151', '', 'Москва', 'Кутузовский проспект 24-441, 16 подъезд, 9 этаж'),
(137, 73, '-', '-', 176, 186, '', '', 'Москва', 'Ленинградский проспект 7'),
(138, 73, '-', '-', 176, 186, '', '', 'Москва', 'Ленинградский проспект 7'),
(139, 74, '-', '-', 176, 186, '', '', 'Москва', 'Ленинградский проспект 7'),
(140, 74, '-', '-', 176, 186, '', '', 'Москва', 'Ленинградский проспект 7'),
(141, 75, '-', '-', 176, 186, '', '', 'Москва ', 'Большая Полянка, 13/16.\r\nЭто желтый особняк, в нем также находится Альфа Банк. Вход В здание с улицы Б.Полянка, там всего один вход - в черные ворота, Далее единственный подъезд. Нажимаете на звоночек, охраннику Надо сказать, что ко мне.'),
(142, 75, '-', '-', 176, 186, '', '', 'Москва ', 'Большая Полянка, 13/16.\r\nЭто желтый особняк, в нем также находится Альфа Банк. Вход В здание с улицы Б.Полянка, там всего один вход - в черные ворота, Далее единственный подъезд. Нажимаете на звоночек, охраннику Надо сказать, что ко мне.'),
(143, 76, 'частное ', 'лицо', 176, 186, '', '', 'Москва', 'ул. Снежная, д.26'),
(150, 80, '-', '-', 176, 213, '690091', '', 'Владивосток', 'Ул. Пологая, д.50, кВ.12'),
(144, 77, '-', '-', 176, 186, '', '', 'Москва', 'Ярославское шоссе, 26 к13'),
(145, 77, '-', '-', 176, 186, '', '', 'Москва', 'Ярославское шоссе, 26 к13'),
(146, 78, '-', '-', 176, 186, '129000', '', 'Москва', 'Смоленская-Сенная пл., 28 подъезд 1'),
(147, 78, '-', '-', 176, 186, '129000', '', 'Москва', 'Смоленская-Сенная пл., 28 подъезд 1'),
(148, 79, '-', '-', 176, 186, '123182', '', 'Москва', 'Москва, ул. Авиационная, д. 79, кв. 307'),
(149, 79, '-', '-', 176, 186, '123182', '', 'Москва', 'Москва, ул. Авиационная, д. 79, кв. 307'),
(151, 80, '-', '-', 176, 213, '690091', '', 'Владивосток', 'Ул. Пологая, д.50, кВ.12');

-- --------------------------------------------------------

--
-- Структура таблицы `SC_customer_reg_fields`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_customer_reg_fields`;
CREATE TABLE IF NOT EXISTS `SC_customer_reg_fields` (
  `reg_field_ID` int(11) NOT NULL,
  `reg_field_required` tinyint(1) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `reg_field_name_ru` varchar(32) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_customer_reg_fields`
--

INSERT INTO `SC_customer_reg_fields` (`reg_field_ID`, `reg_field_required`, `sort_order`, `reg_field_name_ru`) VALUES
(1, 1, 1, 'Телефон'),
(2, 0, 2, 'Метро (Москва)');

-- --------------------------------------------------------

--
-- Структура таблицы `SC_customer_reg_fields_values`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Авг 24 2015 г., 13:09
--

DROP TABLE IF EXISTS `SC_customer_reg_fields_values`;
CREATE TABLE IF NOT EXISTS `SC_customer_reg_fields_values` (
  `reg_field_ID` int(11) NOT NULL DEFAULT '0',
  `customerID` int(11) NOT NULL DEFAULT '0',
  `reg_field_value` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_customer_reg_fields_values`
--

INSERT INTO `SC_customer_reg_fields_values` (`reg_field_ID`, `customerID`, `reg_field_value`) VALUES
(1, 11, '+7 910 488 05 63'),
(1, 12, '+79267770901'),
(1, 6, '960-90-04'),
(1, 8, '8-916-171-15-15'),
(2, 8, 'Митино'),
(1, 9, '+79162217299'),
(2, 9, 'улица 1905 года'),
(2, 11, ''),
(1, 10, '+7 910 481 02 97'),
(2, 10, ''),
(1, 13, '8-985-725-25-76'),
(2, 13, 'Сокольники'),
(1, 14, '89091500640'),
(2, 14, 'Щукинская'),
(1, 15, '89653131094'),
(1, 16, '89104952965'),
(2, 16, 'Ленинский проспект'),
(1, 17, '89854622902'),
(2, 17, 'Петровская- Разумовская'),
(1, 18, '89161432162'),
(2, 18, 'фрунзенская'),
(1, 19, '89224839085'),
(1, 20, '8 919 768 5714'),
(2, 20, 'выставочная'),
(1, 21, '8-916-801-30-38'),
(2, 21, 'Новые Черемушки'),
(1, 22, '+7916 2933279'),
(2, 22, 'Марксистская'),
(1, 23, '8-903-222-08-77'),
(2, 23, 'м. Савеловская в будни и суб, м. Римская в воскресенье'),
(1, 24, '8 903 577 8566'),
(1, 25, '+79854286525'),
(2, 25, 'Новые Черемушки'),
(1, 26, '+7-916-366-21-88'),
(2, 26, 'Дмитровская'),
(1, 27, '89630117007'),
(1, 28, '89636128483'),
(2, 28, 'Новые Черёмушки'),
(1, 29, '8916-366-21-88'),
(2, 29, 'Дмитровская'),
(1, 30, '89268790004'),
(1, 31, '8(905)434 04 87'),
(1, 32, '89242808760'),
(1, 33, '89165821952'),
(2, 33, 'Выхино'),
(1, 34, '+79106478303'),
(1, 35, '89035261710 / 8(495)6827037'),
(2, 35, 'ВДНХ'),
(1, 36, '+79502950777'),
(1, 37, '89639982948'),
(2, 37, 'Щелковская'),
(1, 38, '89168251004'),
(2, 38, 'Крылатское'),
(1, 39, '8985 7767618'),
(2, 39, 'Новокосино'),
(1, 40, '89163662188'),
(2, 40, 'Дмитровская'),
(1, 41, '+79165149415'),
(2, 41, 'Тульская'),
(1, 42, '89162471968'),
(2, 42, 'Алтуфьево'),
(1, 43, '+79267313175'),
(2, 43, 'Войковская,Водный Стадион'),
(1, 45, '+7 9162933279'),
(2, 45, 'Бабушкинская'),
(1, 46, '+7-916-694-60-72'),
(2, 46, 'Смоленская'),
(1, 47, '89854622902'),
(2, 47, 'Тимирязевская'),
(1, 48, '+79269139936'),
(2, 48, 'Динамо'),
(1, 49, '79036297701'),
(1, 50, '9037928932'),
(2, 50, 'Новые черемушки'),
(1, 51, '89104670654'),
(2, 51, 'Новослободская'),
(1, 52, '12345555'),
(1, 53, '8 9166906748'),
(2, 53, 'Семеновская'),
(1, 54, '8-916-681-78-38'),
(2, 54, 'сходненская'),
(1, 55, ' 89255897915'),
(1, 56, '+7 916 2933279'),
(2, 56, 'бабушкинская'),
(1, 57, '89150675868'),
(2, 57, 'петровско-разумовская'),
(1, 58, '89629347182'),
(2, 58, 'ул. Подбельского'),
(1, 59, ' 89255897915'),
(1, 60, '8(905)5430923'),
(2, 60, 'Университет'),
(1, 61, '89166865874'),
(2, 61, 'Динамо'),
(1, 62, '+49 89 123456789'),
(1, 63, '84955186019'),
(1, 64, '8-916-681-78-38'),
(2, 64, 'Сходненская'),
(1, 65, '916-681-78-38'),
(2, 65, 'Сходненская'),
(1, 66, '8-916-681-78-38'),
(2, 66, 'Сходненская'),
(1, 67, '89161251523'),
(2, 67, 'бр. Д.Донского д.11 кв.247'),
(1, 68, '89680850955'),
(1, 69, '8-985-991-31-23'),
(2, 69, 'Водный стадион'),
(1, 70, '89139152535'),
(1, 71, '+79252219766'),
(2, 71, 'пр.Вернадского'),
(1, 72, '89153167183'),
(2, 72, 'Кутузовская'),
(1, 73, '+74955186019'),
(1, 74, '+74955186019'),
(1, 75, '8-916-686-6640'),
(2, 75, 'Полянка'),
(1, 77, '89162918260'),
(1, 78, '8-916-694-60-72'),
(2, 78, 'Cмоленская'),
(1, 79, '+7 916 9936832'),
(2, 79, 'Щукинская'),
(1, 80, '89502950777');

-- --------------------------------------------------------

--
-- Структура таблицы `SC_customer_reg_fields_values_quickreg`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_customer_reg_fields_values_quickreg`;
CREATE TABLE IF NOT EXISTS `SC_customer_reg_fields_values_quickreg` (
  `reg_field_ID` int(11) NOT NULL DEFAULT '0',
  `orderID` int(11) NOT NULL DEFAULT '0',
  `reg_field_value` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `SC_discount_coupons`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Фев 11 2015 г., 11:08
--

DROP TABLE IF EXISTS `SC_discount_coupons`;
CREATE TABLE IF NOT EXISTS `SC_discount_coupons` (
  `coupon_id` int(11) NOT NULL,
  `coupon_code` char(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `is_active` enum('N','Y') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'N',
  `coupon_type` enum('SU','MX','MN') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'SU',
  `expire_date` int(11) NOT NULL,
  `discount_percent` decimal(12,2) NOT NULL DEFAULT '0.00',
  `discount_absolute` decimal(12,2) NOT NULL DEFAULT '0.00',
  `discount_type` enum('P','A') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'P',
  `comment` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_discount_coupons`
--

INSERT INTO `SC_discount_coupons` (`coupon_id`, `coupon_code`, `is_active`, `coupon_type`, `expire_date`, `discount_percent`, `discount_absolute`, `discount_type`, `comment`) VALUES
(14, '567326725', 'N', 'MN', 1406836799, '25.00', '0.00', 'P', '25'),
(12, '567326715', 'N', 'MN', 1406836799, '15.00', '0.00', 'P', '15'),
(13, '567326720', 'N', 'MN', 1406836799, '20.00', '0.00', 'P', '20'),
(16, '567326730', 'N', 'MN', 1423688399, '30.00', '0.00', 'P', 'GS-2014'),
(11, '567326710', 'N', 'MN', 1406836799, '10.00', '0.00', 'P', '10');

-- --------------------------------------------------------

--
-- Структура таблицы `SC_discussions`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Май 29 2015 г., 02:03
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_discussions`;
CREATE TABLE IF NOT EXISTS `SC_discussions` (
  `DID` int(11) NOT NULL,
  `productID` int(11) DEFAULT NULL,
  `Author` varchar(40) DEFAULT NULL,
  `Body` text,
  `add_time` datetime DEFAULT NULL,
  `Topic` varchar(255) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_discussions`
--

INSERT INTO `SC_discussions` (`DID`, `productID`, `Author`, `Body`, `add_time`, `Topic`) VALUES
(22, 914, 'Willaddib', 'spondylolisthesisProteolytic cleavage of the precursor proopiomelanocortin gives rise to several peptides including adrenocorticotropin and MSH both of which have been associated with erectile responses.Over time symptoms occur with lighter activity or even while at rest.Sustained handgrip  diminishes the intensity of HCM murmur. <a href=http://comprarpropeciaspain.com/#jejxvbl>propecia e disfuncion erectil</a> Hormone replacement therapy is given when entire glands are removed or do not produce enough hormones.eLEECH JAR AND LANCETS  ENGLAND c.Initial treatment is hemodynamic stabilization give fluids to maintain BP.', '2015-05-21 18:36:43', 'faq viagra'),
(23, 868, 'RoberttNow', 'Download Music Private FTP http://0daymusic.org/premium.php \r\n \r\nSOME DETAILS ON PREMIUM ACCOUNT: \r\n* Server''s capacity: 21 TB for NEW, 20 TB for OLD plans. \r\n* Account delivery time: 1 to 24 hours. \r\n* Available genres: All but Live, recent Music Videos and FLAC releases. \r\n* IP restrictions: 3 IP addresses per user at the same time. \r\n* Overal server''s speed: 500 Mbps. \r\n* Easy to use: Most of genres are sorted by days.', '2015-05-29 05:02:46', 'Best Music/FLAC/MP3/WEB');

-- --------------------------------------------------------

--
-- Структура таблицы `SC_divisions`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Апр 10 2015 г., 16:14
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_divisions`;
CREATE TABLE IF NOT EXISTS `SC_divisions` (
  `xID` int(10) unsigned NOT NULL,
  `xName` varchar(255) NOT NULL DEFAULT '',
  `xKey` varchar(255) NOT NULL DEFAULT '',
  `xUnicKey` varchar(255) NOT NULL DEFAULT '',
  `xParentID` int(10) unsigned NOT NULL DEFAULT '0',
  `xEnabled` tinyint(1) NOT NULL DEFAULT '0',
  `xPriority` smallint(5) unsigned NOT NULL DEFAULT '0',
  `xTemplate` varchar(100) NOT NULL DEFAULT '',
  `xLinkDivisionUKey` varchar(30) NOT NULL DEFAULT ''
) ENGINE=MyISAM AUTO_INCREMENT=217 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_divisions`
--

INSERT INTO `SC_divisions` (`xID`, `xName`, `xKey`, `xUnicKey`, `xParentID`, `xEnabled`, `xPriority`, `xTemplate`, `xLinkDivisionUKey`) VALUES
(1, 'pgn_mainpage', '', 'TitlePage', 0, 1, 10, 'frame.html', ''),
(6, 'sub hello', '', '', 2, 0, 0, '', ''),
(8, 'Администрирование', '', 'admin', 0, 1, 0, 'backend/index.html', 'admin_orders_list'),
(9, 'pgn_catalog', '', 'catalog', 8, 1, 14, '', 'categorygoods'),
(10, 'pgn_orders', '', 'admin_orders', 8, 1, 18, '', 'admin_orders_list'),
(11, 'pgn_settings', '', '', 8, 1, 8, '', 'bsettings'),
(12, 'pgn_modules', '', '', 8, 1, 12, '', 'product_widgets'),
(14, 'pgn_products_categories', '', 'categorygoods', 9, 1, 20, '', ''),
(15, 'pgn_import_products', '', '', 9, 1, 16, '', ''),
(16, 'pgn_export_products', '', '', 9, 1, 14, '', ''),
(17, 'Синхронизация баз данных', '', '', 9, 0, 4, '', ''),
(18, 'pgn_product_customparams', '', '', 9, 1, 10, '', ''),
(20, 'pgn_product_reviews', '', '', 9, 1, 18, '', ''),
(21, 'pgn_orders', '', 'admin_orders_list', 10, 1, 8, '', ''),
(22, 'pgn_customers', '', 'admin_users_list', 89, 1, 8, '', ''),
(24, 'pgn_general_settings', '', 'bsettings', 11, 1, 100, '', ''),
(25, 'pgn_shipping_methods', '', '', 11, 1, 80, '', ''),
(26, 'pgn_payment_methods', '', '', 11, 1, 70, '', ''),
(29, 'pgn_mainpage', '', 'home', 1, 1, 76, '', 'TitlePage'),
(30, 'pgn_my_account', '', 'office', 1, 0, 74, '', ''),
(32, 'pgn_feedback', '', 'feedback', 1, 1, 66, '', ''),
(33, 'pgn_linkexchange', '', 'linkexchange', 1, 1, 64, '', ''),
(34, 'pgn_product', '', 'product', 1, 0, 50, '', ''),
(35, 'pgn_news', '', 'news', 1, 1, 56, '', ''),
(36, 'pgn_discuss_product', '', 'discuss_product', 1, 0, 54, '', ''),
(37, 'pgn_cart', '', 'cart', 1, 0, 58, '', ''),
(38, 'pgn_contact_info', '', 'contact_info', 30, 1, 8, '', ''),
(39, 'pgn_address_book', '', 'address_book', 30, 1, 7, '', ''),
(40, 'pgn_order_history', '', 'order_history', 30, 1, 6, '', ''),
(42, 'pgn_affiliate_program', '', 'affiliate_program', 30, 1, 2, '', 'affiliate_balance'),
(43, 'pgn_customer_fields', '', '', 11, 1, 30, '', ''),
(44, 'pgn_add_address', '', 'add_address', 39, 0, 1, '', ''),
(45, 'pgn_edit_address', '', 'address_editor', 39, 0, 2, '', ''),
(46, 'pgn_order_detailed', '', 'order_detailed', 40, 0, 0, '', ''),
(49, 'pgn_affiliate_balance', '', 'affiliate_balance', 42, 1, 0, '', ''),
(50, 'pgn_affpr_payments_history', '', 'affiliate_history', 42, 1, 0, '', ''),
(51, 'pgn_affpr_earn_money', '', 'affiliate_money', 42, 1, 0, '', ''),
(52, 'pgn_affilite_program', '', 'admin_affprogram', 89, 1, 7, '', ''),
(53, 'pgn_affiliate_settings', '', 'affiliate_settings', 42, 1, 0, '', ''),
(54, 'pgn_register', '', 'register', 1, 1, 72, '', ''),
(55, 'pgn_successful_registration', '', 'successful_registration', 1, 0, 46, '', ''),
(59, 'pgn_change_address', '', 'change_address', 1, 0, 0, '', ''),
(67, 'pgn_link_exchange_admin', '', '', 12, 1, 70, '', ''),
(68, 'pgn_news_administration', '', 'manage_news', 12, 1, 90, '', ''),
(69, 'pgn_survey_administration', '', '', 12, 1, 80, '', ''),
(70, 'pgn_transaction_result', '', 'transaction_result', 1, 0, 48, '', ''),
(71, 'Список модулей', '', 'modules_list', 12, 0, 16, '', ''),
(72, 'pgn_export2googlebase', '', '', 9, 1, 12, '', ''),
(73, 'pgn_yandex_market', '', '', 9, 1, 11, '', ''),
(74, 'pgn_currency_types', '', 'currencies', 11, 1, 90, '', ''),
(75, 'pgn_countries', '', '', 11, 1, 60, '', ''),
(76, 'pgn_regions', '', '', 11, 1, 50, '', ''),
(77, 'pgn_taxes', '', '', 11, 1, 40, '', ''),
(79, 'pgn_aux_pages', '', 'aux_pages', 12, 1, 100, '', ''),
(87, 'pgn_order_statuses', '', '', 10, 1, 7, '', ''),
(88, 'pgn_custgroups', '', 'admin_custgroups', 89, 1, 6, '', ''),
(89, 'pgn_customers', '', 'customers', 8, 1, 16, '', 'admin_users_list'),
(90, 'pgn_user_info', '', 'user_info', 22, 0, 0, '', 'admin_contact_info'),
(91, 'pgn_contact_info', '', 'admin_contact_info', 90, 1, 11, '', ''),
(92, 'pgn_address_book', '', '', 90, 1, 10, '', ''),
(93, 'pgn_order_history', '', 'admin_user_order_history', 90, 1, 6, '', ''),
(95, 'affp_title', '', '', 90, 1, 2, '', ''),
(96, 'pgn_order_detailed', '', 'admin_order_detailed', 21, 0, 0, '', ''),
(98, 'pgn_divsettings', '', 'div_settings', 23, 0, 0, '', ''),
(99, 'pgn_newsletter_subscribers', '', '', 89, 1, 2, '', ''),
(100, 'pgn_discounts', '', 'discount_settings', 10, 1, 6, '', ''),
(102, 'pgn_home', '', 'home', 8, 0, 2, '', 'TitlePage'),
(103, 'pgn_reports', '', '', 8, 1, 13, '', 'sales_report'),
(104, 'pgn_categories_reports', '', '', 103, 1, 80, '', ''),
(106, 'pgn_products_reports', '', '', 103, 1, 90, '', ''),
(107, 'pgn_pricelist', '', 'pricelist', 1, 1, 70, '', ''),
(108, 'Настройки категории', '', 'category_settings', 14, 0, 0, '', ''),
(109, 'pgn_addmod_product', '', 'product_settings', 14, 0, 0, '', ''),
(110, 'pgn_addmod_product', '', 'option_value_configurator', 109, 0, 0, 'backend/product_option_configuration.tpl.html', ''),
(111, 'Рекомендуемые товары', '', 'related_products_setup', 109, 0, 0, 'backend/related_products_setup.tpl.html', ''),
(113, 'pgn_print_version', '', 'printable', 1, 0, 24, '', ''),
(114, 'pgn_invoice', '', 'invoice', 1, 0, 0, '', ''),
(116, 'pgn_invoice', '', 'invoice_phys', 1, 0, 28, '', ''),
(117, 'Счет на оплату', '', 'invoice_jur', 1, 0, 2, '', ''),
(118, 'linkpoint', '', 'linkpoint', 1, 0, 42, '', ''),
(119, 'pgn_cart', '', 'cart_popup', 1, 0, 36, '', ''),
(120, 'pgn_authorization', '', 'register_authorization', 1, 0, 38, '', ''),
(121, 'pgn_registration', '', 'quick_register', 1, 0, 20, '', ''),
(122, 'Быстрое оформление заказа', '', '', 1, 0, 4, '', ''),
(123, 'pgn_delivery', '', 'order2_shipping_quick', 122, 0, 0, '', ''),
(124, 'pgn_payment', '', 'order3_billing_quick', 122, 0, 0, '', ''),
(125, 'pgn_order_confirmation', '', 'order4_confirmation_quick', 122, 0, 0, '', ''),
(126, 'pgn_customer_activation', '', 'act_customer', 1, 0, 30, '', ''),
(127, 'Установка модуля', '', 'module_installation', 71, 0, 0, '', ''),
(128, 'Настройка конфига', '', 'config_settings', 71, 0, 0, '', ''),
(131, 'pgn_add_news', '', 'add_news', 68, 0, 0, '', ''),
(134, 'Добавить интерфейс', '', 'add_divinterface', 23, 0, 0, 'backend/noframe.htm', ''),
(135, 'YourPay Connect', '', 'yourpaymentconnect', 1, 0, 6, '', ''),
(136, 'payment', '', 'pmethod_list', 11, 0, 11, '', ''),
(137, 'pmnt_edit_method', '', 'mod_pmethod', 136, 0, 0, '', ''),
(138, 'pmnt_add_method', '', 'add_pmethod', 136, 0, 0, '', ''),
(143, 'pgn_test', '', 'test', 21, 0, 2, '', ''),
(149, 'pgn_languages', '', 'languages', 167, 1, 100, '', ''),
(150, 'pgn_addmod_language', '', 'addmod_language', 149, 0, 0, '', ''),
(151, 'PP Express Checkout - order confirmation', '', 'ppexpresscheckout_orderconfirmation', 1, 0, 12, '', ''),
(152, 'PP Express Checkout - order success', '', 'ppec_order_success', 1, 0, 10, '', ''),
(153, 'Google Checkout handler', '', 'googlecheckout_handler', 0, 0, 0, '', ''),
(154, 'pgn_edit_locals', '', 'locals', 149, 0, 0, '', ''),
(155, 'pgn_find_local', '', 'find_local', 149, 0, 0, '', ''),
(156, 'pgn_add_language', '', 'add_language', 149, 0, 0, '', ''),
(157, 'pgn_change_deflang', '', 'change_default_language', 149, 0, 0, '', ''),
(160, 'pgn_themes_list', '', 'themes_list', 167, 1, 110, '', ''),
(161, 'pgn_theme_edit', '', 'theme_edit', 160, 0, 0, '', ''),
(162, 'pgn_cpt_constructor', '', 'cpt_constructor', 1, 0, 32, '', ''),
(163, 'pgn_theme_preview', '', 'theme_preview', 1, 0, 14, '', ''),
(164, 'pgn_category_tree', '', 'category_tree', 14, 0, 0, 'backend/js_categorytree.html', ''),
(165, 'pgn_sales_report', '', 'sales_report', 103, 1, 100, '', ''),
(166, 'pgn_change_default_currency', '', 'change_default_currency', 74, 0, 0, '', ''),
(167, 'pgn_presentation', '', '', 8, 1, 6, '', 'themes_list'),
(168, 'pgn_checkout', '', 'checkout', 1, 0, 34, '', ''),
(169, 'pgn_images_manager', '', '', 167, 1, 90, '', ''),
(170, 'pgn_cpt_settings', '', 'cpt_settings', 161, 0, 0, '', ''),
(171, 'pgn_remind_password', '', 'remind_password', 1, 0, 18, '', ''),
(175, 'pgn_erase_products', '', '', 9, 1, 2, '', ''),
(176, 'prd_product_comparison', '', 'product_comparison', 1, 0, 8, '', ''),
(177, 'pgn_simple_search', '', 'search', 1, 0, 16, '', ''),
(178, 'pgn_checkout_replacement', '', '', 11, 1, 0, '', ''),
(179, 'pgn_product_widgets', '', 'product_widgets', 12, 1, 110, '', ''),
(180, 'pgn_product_widget', '', 'product_widget', 1, 0, 22, '', ''),
(182, 'pgn_product_lists', '', 'product_lists', 9, 1, 6, '', ''),
(183, 'pgn_login', '', 'auth', 1, 1, 71, '', ''),
(184, 'pgn_logout', '', 'logout', 1, 0, 26, '', ''),
(185, 'err_product_not_found', '', 'product_not_found', 1, 0, 44, '', ''),
(186, 'pgn_googleanalytics', '', 'googleanalytics', 12, 1, 0, '', ''),
(187, 'pgn_category_search', '', 'category_search', 1, 0, 0, '', ''),
(188, 'pgn_sms_notifications', '', 'wasms', 10, 1, 0, '', ''),
(189, 'pgn_discount_coupons', '', 'discount_coupons', 10, 1, 7, '', ''),
(190, 'pgn_order_editor', '', 'order_editor', 21, 0, 0, '', ''),
(191, 'pgn_configuration', '', 'configuration', 24, 0, 0, '', ''),
(192, 'pgn_order_creater', '', 'order_creater', 21, 0, 0, '', ''),
(193, 'pgn_gmapi_key_checker', '', 'gmapi_key_checker', 21, 0, 0, '', ''),
(194, 'Google Checkout handler', '', 'googlecheckout_handler', 0, 0, 0, '', ''),
(196, 'PP Express Checkout - order confirmation', '', 'ppexpresscheckout_orderconfirmation', 1, 0, 0, '', ''),
(197, 'PP Express Checkout - order success', '', 'ppec_order_success', 1, 0, 0, '', ''),
(209, 'pgn_ap_3', '', 'auxpage_dostavka-i-oplata', 1, 0, 0, '', ''),
(200, 'pgn_order_status', '', 'order_status', 1, 1, 0, '', ''),
(201, 'pgn_google_sitemap', '', 'sitemap', 12, 1, 1, '', ''),
(202, 'pgn_printforms', '', 'formmanagment', 12, 1, 0, '', ''),
(203, 'pgn_printforms', '', 'print_form', 1, 0, 0, '', ''),
(204, 'prd_out_of_stock', '', 'product_out_of_stock', 1, 0, 0, '', ''),
(205, 'print_form', '', 'admin_print_form', 21, 0, 0, '', ''),
(206, 'pgn_social_networks', '', 'social_networks', 12, 1, 97, '', ''),
(207, 'pgn_1c', '', '', 12, 1, 95, '', ''),
(208, '1c_exchange', '', '1c_exchange', 1, 0, 0, '', ''),
(210, 'pgn_ap_4', '', 'auxpage_o-kompanii', 1, 0, 0, '', ''),
(211, 'pgn_ap_5', '', 'auxpage_kontakty', 1, 0, 0, '', ''),
(212, 'PP Express Checkout - order confirmation', '', 'ppexpresscheckout_orderconfirmation', 1, 0, 0, '', ''),
(213, 'PP Express Checkout - order success', '', 'ppec_order_success', 1, 0, 0, '', ''),
(214, 'pgn_ap_6', '', 'auxpage_tablica-razmerov', 1, 0, 0, '', ''),
(215, 'pgn_ap_7', '', 'auxpage_slim-series', 1, 0, 0, '', ''),
(216, 'pgn_ap_8', '', 'auxpage_sale', 1, 0, 0, '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `SC_division_access`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_division_access`;
CREATE TABLE IF NOT EXISTS `SC_division_access` (
  `xDivisionID` int(11) NOT NULL DEFAULT '0',
  `xU_ID` varchar(20) NOT NULL DEFAULT '',
  `xID_TYPE` smallint(1) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `SC_division_custom_settings`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_division_custom_settings`;
CREATE TABLE IF NOT EXISTS `SC_division_custom_settings` (
  `xDivisionID` int(10) unsigned NOT NULL DEFAULT '0',
  `xSettingID` int(10) unsigned NOT NULL,
  `xKey` varchar(30) NOT NULL DEFAULT '',
  `xName` varchar(30) NOT NULL DEFAULT '',
  `xValue` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_division_custom_settings`
--

INSERT INTO `SC_division_custom_settings` (`xDivisionID`, `xSettingID`, `xKey`, `xName`, `xValue`) VALUES
(39, 1, 'short_info', 'Интерфейс кратк', 'wrapper->short_address_book'),
(38, 1, 'short_info', 'Интерфейс кратк', 'wrapper->short_contact_info'),
(40, 1, 'short_info', 'Интерфейс кратк', 'wrapper->short_orders_history'),
(41, 1, 'short_info', 'Интерфейс кратк', 'wrapper->short_visits'),
(42, 1, 'short_info', 'Интерфейс кратк', 'affiliate_program->short_affiliate_program'),
(29, 1, 'icon', 'Иконка', 'images/home.gif'),
(30, 1, 'icon', 'Иконка', 'images/register.gif'),
(54, 1, 'icon', 'Иконка', 'images/register.gif'),
(31, 1, 'icon', 'Иконка', 'images/price.gif'),
(63, 1, 'icon', 'Иконка', ''),
(64, 1, 'icon', 'Иконка', 'images/price.gif'),
(65, 1, 'icon', 'Иконка', 'images/price.gif'),
(66, 1, 'icon', 'Иконка', 'images/price.gif'),
(32, 1, 'icon', 'Иконка', 'images/feedback.gif'),
(33, 1, 'icon', 'Иконка', 'images/price.gif'),
(107, 1, 'icon', 'Иконка', 'images/price.gif');

-- --------------------------------------------------------

--
-- Структура таблицы `SC_division_interface`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Апр 10 2015 г., 16:14
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_division_interface`;
CREATE TABLE IF NOT EXISTS `SC_division_interface` (
  `xDivisionID` int(10) unsigned NOT NULL DEFAULT '0',
  `xInterface` varchar(100) NOT NULL DEFAULT '0',
  `xPriority` smallint(5) unsigned NOT NULL DEFAULT '0',
  `xInheritable` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_division_interface`
--

INSERT INTO `SC_division_interface` (`xDivisionID`, `xInterface`, `xPriority`, `xInheritable`) VALUES
(1, '1_categorytree', 29, 1),
(1, '1_fcurrency', 30, 1),
(1, '1_FrontendTitle', 24, 0),
(1, '25_google_analytics', 26, 1),
(1, '25_head', 40, 1),
(14, '1_b_categories_products', 0, 0),
(15, '1_b_import2csv', 0, 0),
(16, '1_b_export_products2csv', 0, 0),
(18, '1_b_product_options', 0, 0),
(20, '1_b_catalog_discuss', 0, 0),
(21, '7_borders_list', 0, 0),
(22, '21_busers_list', 0, 0),
(24, '1_b_settings', 0, 0),
(25, '48_shipping_methods', 0, 0),
(26, '48_payment_methods', 0, 0),
(30, '1_user_account', 0, 0),
(32, '12_', 0, 0),
(32, '12_feedback', 0, 0),
(33, '13_flinkexchange', 0, 0),
(34, '1_categorytree', 0, 0),
(34, '1_fcurrency', 10, 0),
(34, '2_show product', 5, 0),
(34, '5_cart_info', 0, 0),
(35, '1_categorytree', 0, 0),
(35, '1_fcurrency', 0, 0),
(35, '3_news list frontend', 0, 0),
(36, '1_categorytree', 2, 0),
(36, '2_discuss product', 5, 0),
(37, '1_categorytree', 0, 0),
(37, '1_fcurrency', 110, 0),
(37, '25_googlecheckout_checkoutbutton', 0, 0),
(37, '25_ppexpresscheckout', 0, 0),
(37, '25_ppexpresscheckout_button', 0, 0),
(37, '25_vkontaktecheckout_button', 0, 0),
(37, '5_cart', 100, 0),
(37, '5_cart_info', 0, 0),
(38, '1_contact_info', 0, 0),
(39, '1_address_book', 0, 0),
(40, '1_orders_history', 0, 0),
(43, '1_b_regfields', 0, 0),
(44, '1_add_address', 0, 0),
(45, '1_edit_address', 0, 0),
(46, '1_order_detailed', 0, 0),
(48, '1_BDivisionsTree', 0, 0),
(49, '6_fbalance', 0, 0),
(50, '6_fpayments_history', 0, 0),
(51, '6_fattract_guide', 0, 0),
(52, '6_b_custord_affpr', 0, 0),
(53, '6_fsettings', 0, 0),
(54, '1_fregister', 0, 0),
(55, '1_fsuccessful_registration', 0, 0),
(57, '1_fcurrency', 10, 0),
(57, '7_shipping', 0, 0),
(58, '7_billing', 0, 0),
(59, '7_change_address', 0, 0),
(61, '7_bpayment_modules', 0, 0),
(62, '1_fcurrency', 10, 0),
(62, '25_ppexpresscheckout', 0, 0),
(62, '7_confirmation', 0, 0),
(67, '13_blinkexchange', 0, 0),
(68, '3_bnews', 0, 0),
(69, '4_bpoll', 0, 0),
(70, '7_ftransaction_result', 0, 0),
(71, '27_modules_list', 0, 0),
(72, '14_export_page', 0, 0),
(73, '15_export_page', 0, 0),
(74, '1_bcurrency', 0, 0),
(75, '1_bcountries', 0, 0),
(76, '1_bzones', 0, 0),
(77, '1_btaxes', 0, 0),
(79, '16_bauxpage', 0, 0),
(87, '48_order_statuses', 0, 0),
(88, '1_busers_group', 0, 0),
(91, '21_bcontact_info', 0, 0),
(92, '21_baddress_book', 0, 0),
(93, '7_buser_orders', 0, 0),
(95, '6_buser_info', 0, 0),
(96, '7_border_detailed', 0, 0),
(97, '22_bdivisionstree', 0, 0),
(98, '22_divisions', 0, 0),
(99, '3_b_subscribers', 0, 0),
(100, '7_b_discounts', 0, 0),
(101, '23_bsms_order_notify', 0, 0),
(104, '1_b_reports_vcategories', 0, 0),
(106, '1_b_reports_products', 0, 0),
(107, '24_pricelist', 0, 0),
(108, '1_b_category_settings', 0, 0),
(109, '2_b_product_settings', 0, 0),
(110, '2_b_product_option_configuration', 0, 0),
(111, '2_b_related_products_setup', 0, 0),
(112, '15_xml_file_access', 0, 0),
(113, '1_printable', 0, 0),
(114, '7_invoice', 0, 0),
(115, '25_invoice_phys', 0, 0),
(116, '25_invoice_phys', 0, 0),
(117, '25_invoice_jur', 0, 0),
(118, '25_linkpoint', 0, 0),
(119, '25_googlecheckout_checkoutbutton', 0, 0),
(119, '25_ppexpresscheckout', 0, 0),
(119, '5_cart_popup', 0, 0),
(119, '25_ppexpresscheckout_button', 0, 0),
(120, '21_register_authorization', 0, 0),
(121, '7_quick_register', 0, 0),
(123, '7_shipping_quick', 0, 0),
(124, '7_billing_quick', 0, 0),
(125, '25_ppexpresscheckout', 0, 0),
(125, '7_confirmation_quick', 0, 0),
(126, '21_register_activation', 0, 0),
(127, '27_module_installation', 0, 0),
(128, '27_config_settings', 0, 0),
(129, '39_bsms_order_notify', 0, 0),
(130, '40_bsms_order_notify', 0, 0),
(131, '3_add_news', 0, 0),
(132, '41_localizations_list', 0, 0),
(134, '22_baddinterface', 0, 0),
(135, '25_yourpaymentconnect', 0, 0),
(136, '7_admin_paymentmethods', 0, 0),
(137, '7_admin_addmod_pmethod', 0, 0),
(138, '7_admin_addmod_pmethod', 0, 0),
(143, '25_test', 0, 0),
(144, '25_ppexpresscheckout_orderconfirmation', 0, 0),
(145, '25_ppexpresscheckout_orderconfirmation', 0, 0),
(149, '41_languages_list', 0, 0),
(150, '41_addmod_language', 0, 0),
(151, '25_ppexpresscheckout_orderconfirmation', 0, 0),
(152, '25_ppec_order_success', 0, 0),
(153, '25_googlecheckout_handler', 0, 0),
(154, '25_locals', 0, 0),
(155, '25_find_local', 0, 0),
(156, '41_add_language', 0, 0),
(157, '41_change_default_language', 0, 0),
(160, '48_themes_list', 0, 0),
(161, '48_theme_edit', 0, 0),
(162, '48_cpt_constructor', 0, 0),
(163, '48_theme_preview', 0, 0),
(164, '48_category_tree', 0, 0),
(165, '48_sales_report', 0, 0),
(166, '48_change_default_currency', 0, 0),
(168, '25_checkout', 0, 0),
(168, '25_ppexpresscheckout_button', 0, 0),
(169, '48_images_manager', 0, 0),
(170, '48_cpt_settings', 0, 0),
(171, '25_remind_password', 0, 0),
(175, '48_erase_products', 0, 0),
(176, '2_comparison_products', 0, 0),
(177, '1_search_simple', 0, 0),
(178, '48_checkout_replacement', 0, 0),
(179, '48_product_widgets', 0, 0),
(180, '25_product_widget', 0, 0),
(182, '48_product_lists', 0, 0),
(183, '1_auth', 0, 0),
(184, '1_logout', 0, 0),
(185, '25_htmlpage', 0, 0),
(186, '48_googleanalytics', 0, 0),
(187, '1_category_search_result', 0, 0),
(188, '48_sms_wa', 0, 0),
(189, '52_manage_coupons', 0, 0),
(190, '53_edit_order', 0, 0),
(191, '54_req_setting', 0, 0),
(192, '55_create_order', 0, 0),
(193, '54_check_gmapi_key', 0, 0),
(194, '25_googlecheckout_handler', 0, 0),
(196, '25_ppexpresscheckout_orderconfirmation', 0, 0),
(197, '25_ppec_order_success', 0, 0),
(210, '16_auxpage_4', 0, 0),
(209, '16_auxpage_3', 0, 0),
(200, '1_order_status', 0, 0),
(201, '48_google_sitemap', 0, 0),
(202, '48_formmanagment', 0, 0),
(203, '25_print_form', 0, 0),
(204, '25_htmlpage', 0, 0),
(205, '48_admin_print_form', 0, 0),
(206, '48_social_networks', 0, 0),
(207, '56_export_page', 0, 0),
(208, '56_exchange_1c', 0, 0),
(211, '16_auxpage_5', 0, 0),
(37, '25_ppexpresscheckout_button', 0, 0),
(119, '25_ppexpresscheckout_button', 0, 0),
(212, '25_ppexpresscheckout_orderconfirmation', 0, 0),
(213, '25_ppec_order_success', 0, 0),
(214, '16_auxpage_6', 0, 0),
(215, '16_auxpage_7', 0, 0),
(216, '16_auxpage_8', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `SC_htmlcodes`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_htmlcodes`;
CREATE TABLE IF NOT EXISTS `SC_htmlcodes` (
  `key` varchar(20) NOT NULL DEFAULT '',
  `title` varchar(30) NOT NULL DEFAULT '',
  `code` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_htmlcodes`
--

INSERT INTO `SC_htmlcodes` (`key`, `title`, `code`) VALUES
('2309usj8', 'appliance', '<div class="col_header lightbluebg">{lbl_news}</div>'),
('5sck5tch', 'appliance', '<a href="" class="apl_logo"><span class="apl_l1">YOUR</span><span class="apl_l2">COMPANY</span><span class="apl_l3">NAME</span></a>'),
('7055hfy8', 'appliance', '<div class="apl_slogan"><span class="apl_s1">New</span><span class="apl_s2">Appliance</span><span class="apl_s3">Shop</span></div>'),
('eiqt7wv3', 'appliance', '<div class="apl_lang">{lbl_str_language}:</div>'),
('gou00yo7', 'appliance', '<div class="col_header bluebg">{lbl_catalog}</div>'),
('j1zduv0p', 'appliance', '<div class="background1" style="padding: 10px; font-size: 120%; font-weight: bold;">{lbl_browse_by_category}</div>'),
('k5e43nju', 'appliance', '<div class="col_header bluebg">{lbl_poll}</div>'),
('857zn7vi', 'aqua', '<div class="news_header"><h3>{lbl_news}</h3></div>'),
('b5kq0gbj', 'aqua', '<div class="aqu_company"><a href=""><span class="light">Company</span><span class="dark">Name</span></a></div>'),
('hm1eo41h', 'aqua', '<div class="poll_header"><h3>{lbl_poll}</h3></div>'),
('hyh8mor9', 'aqua', '<span class="aqu_tel">(123) 555-1234\r\n</span>'),
('n026s0bl', 'aqua', '<div class="cat_header"><h3>{lbl_catalog}</h3></div>'),
('whofto05', 'aqua', '<h1 class="aqu_browse" class="mdr_main_header">{lbl_browse_by_category}:</h1>'),
('ww71q5hv', 'aqua', '<div class="lang_label">{lbl_str_language}:</div>'),
('1idtjfyd', 'city', '<div class="right_bg_pink"> </div>'),
('2j3zx20a', 'city', '<a href=""><span class="cty_l1">YOUR</span><span class="cty_l2">COMPANY</span><span class="cty_l3">NAME</span></a>'),
('bfe2ltrx', 'city', '<div class="right_bg_red"> </div>'),
('oil2iz4a', 'city', '<div class="left_bg_navy"> </div>'),
('4j8ucbo7', 'classic', '<div class="col_header">{lbl_catalog}</div>'),
('j4qyt14q', 'classic', '<div class="col_header">{lbl_str_language}</div>'),
('t72gcmgp', 'classic', '<h1 style="color: white">My Store</h1>'),
('uhyltsyy', 'classic', '<div class="col_header">{lbl_poll}</div>'),
('wst55wn7', 'classic', '<div class="col_header">{lbl_news}</div>'),
('1vxl4z1u', 'computer', '<div class="col_header">{lbl_poll}</div>'),
('3qlymdjf', 'computer', 'test'),
('4u9yjvxt', 'computer', '<div class="col_header">{lbl_news}</div>'),
('gnz1m6o2', 'computer', '<div class="col_header"></div>'),
('o9lzcmgm', 'computer', '<div class="col_header">&nbsp;</div>'),
('omphg9kb', 'computer', '<div class="col_header">{lbl_catalog}</div>'),
('0b6u45d4', 'default', '<div class="news_header"><h3>{lbl_news}</h3></div>'),
('3hmk7pem', 'default', '<label>{lbl_search}: </label>'),
('7tqa7d2d', 'default', '<div class="poll_header"><h3>{lbl_poll}</h3></div>'),
('8g1gd6h8', 'default', '<h1 class="companyname">My shop</h1>'),
('c7wj287f', 'default', '<div class="cat_header"><h3>{lbl_catalog}</h3></div>'),
('de9hsbax', 'default', '<h1 class="mdr_main_header">{lbl_browse_by_category}</h1>'),
('jymcwcmu', 'default', '<span class="tls_tel">(123) 555-1234\r\n</span>'),
('ncxrvx57', 'default', '<div class="lang_label">{lbl_str_language}:</div>'),
('njr3gga6', 'default', '<h1 class="welcome">{lbl_welcome_to_storefront} "{$smarty.const.CONF_SHOP_NAME}"</h1>\r\n'),
('p5kgoddr', 'default', '<span class="lang_label">{lbl_str_language}:</span>'),
('j65towo9', 'demo', '<div class="col_header pink">{lbl_poll}</div>'),
('rjxn8oml', 'demo', '<div class="col_header green">{lbl_news}</div>'),
('1f4a22e4', 'flowers', '<div class="flw_bl"></div>'),
('2tuzady5', 'flowers', '<div class="flw_br"></div><div class="flw_bl"></div><div class="flw_tl"></div><div class="flw_tr"></div>'),
('otcfncdy', 'flowers', '<div class="flw_company"><a href=""><span class="light">Company</span><span class="dark">Name</span></a></div>'),
('qt8jxz12', 'flowers', '<div class="lang_label">{lbl_str_language}:</div>'),
('r0lm25kj', 'flowers', '<div class="flw_company"><a href=""><span class="light">Company</span><span class="dark">Name</span></a></div>'),
('wbsbuve7', 'flowers', '<div class="flw_tr"></div>'),
('zigtewl3', 'flowers', '<div class="flw_tl"></div>'),
('1g2qude4', 'glamour', '<div class="col_header pink3bg r_header">{lbl_currency}</div>'),
('6ey329o1', 'glamour', '<div class="col_header pinkbg r_header">{lbl_str_language}</div>'),
('ea4wstp3', 'glamour', '<a href=""><span class="glr_l1">YOUR</span><span class="glr_l2">COMPANY</span><span class="glr_l3">NAME</span></a>'),
('fpneb9ck', 'glamour', '<div class="col_header pinkbg">{lbl_search}</div>'),
('jlwqn5pj', 'glamour', '<div class="col_header pink2bg r_header">{lbl_news}</div>'),
('ntj3gaot', 'glamour', '<div class="col_header purpurbg">{lbl_cataloge}</div>'),
('zlpc2hvu', 'glamour', '<div class="darkpinkbg"><div class="whiteborder"><div class="purpurfolder">&nbsp;</div></div></div>'),
('zyp0nrpq', 'glamour', '<div class="purpurbg"><div class="whiteborder"><div class="pinkfolder">&nbsp;</div></div></div>'),
('2vgnavg7', 'green', '<div class="cpt_custom_html"><a href=""><span class="grn_l1">YOUR</span><span class="grn_l2">COMPANY</span><span class="grn_l3">NAME</span></a></div>'),
('iek3eg75', 'green', '<div class="col_header">{lbl_news}</div>'),
('iy000qa3', 'green', '<div class="col_header">{lbl_catalog}</div>'),
('j1gq0b6t', 'green', '<div class="under_searchform"> </div>'),
('o5fwylp5', 'green', '<div class="col_header_dark">{lbl_poll}</div>'),
('uid5yfy7', 'green', '<a href=""><span class="grn_l1">YOUR</span><span class="grn_l2">COMPANY</span><span class="grn_l3">NAME</span></a>'),
('3vm6694u', 'modern', '<div class="col_header green">{lbl_str_search}</div>'),
('gyfor9rz', 'modern', '<a href="/"><span class="mdr_l1">Your</span><span class="mdr_l2">Company</span><span class="mdr_l3">Name</span></a>'),
('lch82oy0', 'modern', '<div class="col_header">{lbl_catalog}</div>'),
('n0oy9wvn', 'modern', '<div class="col_header green">{lbl_poll}</div>'),
('fjuuxwn8', 'ocean', '<div class="ocn_left_wh"><div class="col_header bluebg">{lbl_str_language}</div></div>'),
('ieabmzcx', 'ocean', '<div class="ocn_left_wh"><div class="col_header bluebg">{lbl_catalog}</div>'),
('ixo6s12z', 'ocean', '<div class="ocn_left_wh"><div class="col_header orangebg">{lbl_search}</div></div>'),
('lxbqae3k', 'ocean', '<div class="ocn_right_wh"><div class="ocn_rightrel"><div class="ocn_guy">  </div></div></div>'),
('np1b607u', 'ocean', '<div class="ocn_left_wh"><div class="col_header bluebg">{lbl_currency}</div></div>'),
('qigab725', 'ocean', '<a href="" class="ocn_logo"><span class="ocn_l1">YOUR</span><span class="ocn_l2">COMPANY</span><span class="ocn_l3">NAME</span></a>'),
('tcfisslq', 'ocean', '<div class="ocn_left_wh"><div class="col_header greenbg">{lbl_news}</div></div>'),
('w0c87mi6', 'ocean', '<div class="ocn_left_wh"><div class="col_header bluebg">{lbl_poll}</div></div>'),
('4e9wmn6l', 'photo', '<div class="pht_white"> <div class="pht-h-tl"></div> <div class="pht-h-tr"></div> <div class="pht-mainhead">{lbl_browse_by_category}</div></div>'),
('8fh7g6tl', 'photo', '<div class="col_header">{lbl_news}</div>'),
('dbjgyz5p', 'photo', '<div class="col_header">{lbl_search}</div>'),
('hzl3kfaj', 'photo', '<div class="col_header first">{lbl_catalog}</div>'),
('k9d8aq0c', 'photo', '<div class="col_header">{lbl_poll}</div>'),
('mw2w3xyf', 'photo', '<div class="pht_lang">{lbl_str_language}:</div>'),
('o2tr1rl5', 'photo', '<div class="pht_white"> <div class="pht-h-tl"></div> <div class="pht-h-tr"></div> <div class="pht-mainhead">{lbl_special_offers}</div></div>'),
('q11rslde', 'photo', '<div class="pht_main-pic"><div class="pht_promo_slogan">New <span>Special</span> Offers</div></div>'),
('0m8bt2r7', 'sale', '<span class="sale_tel">(123) 555-1234\r\n</span>'),
('7chazboj', 'sale', '<div class="red_header"><h3>{lbl_news}</h3></div>'),
('9yfp12we', 'sale', '<div class="red_header"><h3>{lbl_poll}</h3></div>'),
('n6fo06i1', 'sale', '<div class="lang_label">{lbl_str_language}:</div>'),
('uq5irul3', 'sale', '<div class="search_header"><label for="searchstring">{lbl_search}: </label></div>'),
('14fuvuhc', 'sci', '<div class="sci_box_right_b"></div>'),
('77i7m2cq', 'sci', '<div class="col_header">{lbl_catalog}</div>'),
('gcrhhlwd', 'sci', '<div class="sci_box_left_b"></div>'),
('kcb6pimm', 'sci', '<div class="col_header">{lbl_search}</div>'),
('s98230gp', 'sci', '<div class="col_header">{lbl_poll}</div>'),
('sgbhydje', 'sci', '<h1>Welcome</h1>'),
('umlp7cha', 'sci', '<a href=""><span class="sci_l1">Your</span><span class="sci_l2">Company</span><span class="sci_l3">Name</span></a>'),
('vubushuf', 'sci', '<div class="col_header">{lbl_news}</div>'),
('0a5i24lc', 'shopping', '<div class="col_header bluebg">{lbl_catalog}</div>'),
('1fkcmhu7', 'shopping', '<div class="col_header bluebg">{lbl_news}</div>'),
('fq5rhkq1', 'shopping', '<div class="col_header middlebluebg">{lbl_poll}</div>'),
('m2uhjlb1', 'shopping', '<div class="col_header pinkbg">{lbl_str_language}</div>'),
('pv7too9w', 'shopping', '<a href="" class="shp_logo"><span class="shp_l1">YOUR</span><span class="shp_l2">COMPANY</span><span class="shp_l3">NAME</span></a>'),
('3u28ilit', 'tableware', '<div class="news_header"><h3>{lbl_news}</h3></div>'),
('9kt3luhk', 'tableware', '<div class="lang_label">{lbl_str_language}:</div>'),
('cw9d10vf', 'tableware', '<div class="poll_header"><h3>{lbl_poll}</h3></div>'),
('htv7izvs', 'tableware', '<div class="cat_header"><h3>{lbl_catalog}</h3></div>'),
('pne5kpsa', 'tableware', '<div class="tbw_company_name"><a href=""><span class="light">Company</span><span class="dark">Name</span></a></div>'),
('wq7w3cb8', 'tableware', '<div class="tbw_company"><a href=""><span class="light">Company</span><span class="dark">Name</span></a></div>'),
('y46y0wg8', 'tableware', '<h2 class="tbw_category">{lbl_browse_by_category}</h2>'),
('blnq0vma', 'time', '<h1>{lbl_special_offers}</h1>'),
('pdhnxqq7', 'time', '<div class="tim_logo">Your Company</div>'),
('22wpr1g4', 'toys', '<h2>{lbl_browse_by_category}</h2>'),
('8ynhvcyo', 'toys', '<h2>{lbl_special_offers}</h2>'),
('bf3vztnb', 'toys', '<div class="tys_lang_label">{lbl_str_language}:</div>'),
('ch251y70', 'toys', '<div class="tys_ltop4"></div>'),
('w4a0p6wf', 'toys', '<div class="col_header tys_ltop2">{lbl_news}</div>'),
('x15293g0', 'toys', '<div class="col_header tys_ltop1">{lbl_catalog}</div>'),
('x7o1m64e', 'toys', '<div class="col_header tys_ltop3">{lbl_poll}</div>');

-- --------------------------------------------------------

--
-- Структура таблицы `SC_interface_interfaces`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_interface_interfaces`;
CREATE TABLE IF NOT EXISTS `SC_interface_interfaces` (
  `xInterfaceCaller` varchar(100) NOT NULL DEFAULT '',
  `xInterfaceCalled` varchar(100) NOT NULL DEFAULT '',
  `xPriority` smallint(5) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_interface_interfaces`
--

INSERT INTO `SC_interface_interfaces` (`xInterfaceCaller`, `xInterfaceCalled`, `xPriority`) VALUES
('7_successful_ordering', '40_successful_ordering_notify', 0),
('7_successful_ordering', '39_successful_ordering_notify', 0),
('51_cpt_connector', '51_custom_html', 0),
('51_cpt_connector', '1_category_tree', 0),
('51_cpt_connector', '1_maincontent', 0),
('51_cpt_connector', '1_shopping_cart_info', 0),
('51_cpt_connector', '3_news_short_list', 0),
('51_cpt_connector', '4_survey', 0),
('51_cpt_connector', '1_logo', 0),
('51_cpt_connector', '1_root_categories', 0),
('51_cpt_connector', '1_product_search', 0),
('51_cpt_connector', '1_currency_selection', 0),
('51_cpt_connector', '1_language_selection', 0),
('51_cpt_connector', '1_product_images', 0),
('51_cpt_connector', '1_product_category_info', 0),
('51_cpt_connector', '1_product_details_request', 0),
('51_cpt_connector', '1_product_related_products', 0),
('51_cpt_connector', '1_product_add2cart_button', 0),
('51_cpt_connector', '1_product_description', 0),
('51_cpt_connector', '1_product_discuss_link', 0),
('51_cpt_connector', '1_product_rate_form', 0),
('51_cpt_connector', '1_product_name', 0),
('51_cpt_connector', '1_product_price', 0),
('51_cpt_connector', '16_auxpages_navigation', 0),
('51_cpt_connector', '1_divisions_navigation', 0),
('51_cpt_connector', '51_product_lists', 0),
('51_cpt_connector', '1_product_params_fixed', 10),
('51_cpt_connector', '1_product_params_selectable', 10),
('51_cpt_connector', '51_tag_cloud', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `SC_language`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_language`;
CREATE TABLE IF NOT EXISTS `SC_language` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `thumbnail` varchar(50) NOT NULL DEFAULT '',
  `iso2` varchar(2) DEFAULT NULL,
  `priority` int(11) unsigned NOT NULL DEFAULT '0',
  `direction` int(1) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_language`
--

INSERT INTO `SC_language` (`id`, `name`, `enabled`, `thumbnail`, `iso2`, `priority`, `direction`) VALUES
(1, 'Русский', 1, '1.gif', 'ru', 2, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `SC_linkexchange_categories`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_linkexchange_categories`;
CREATE TABLE IF NOT EXISTS `SC_linkexchange_categories` (
  `le_cID` int(11) NOT NULL,
  `le_cName` varchar(100) DEFAULT NULL,
  `le_cSortOrder` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `SC_linkexchange_links`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_linkexchange_links`;
CREATE TABLE IF NOT EXISTS `SC_linkexchange_links` (
  `le_lID` int(11) NOT NULL,
  `le_lText` varchar(255) DEFAULT NULL,
  `le_lURL` varchar(255) DEFAULT NULL,
  `le_lCategoryID` int(11) DEFAULT NULL,
  `le_lVerified` datetime DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `SC_local`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Сен 11 2015 г., 08:36
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_local`;
CREATE TABLE IF NOT EXISTS `SC_local` (
  `id` varchar(255) NOT NULL DEFAULT '',
  `lang_id` int(11) unsigned NOT NULL DEFAULT '0',
  `value` text NOT NULL,
  `group` enum('hidden','front','back','general') NOT NULL DEFAULT 'hidden',
  `subgroup` varchar(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_local`
--

INSERT INTO `SC_local` (`id`, `lang_id`, `value`, `group`, `subgroup`) VALUES
('auxp_lbl_enabled', 1, 'Включен', 'back', 'gen'),
('auxp_lbl_priority', 1, 'Приоритет', 'back', 'gen'),
('btn_add', 1, 'Добавить', 'general', 'gen'),
('btn_apply', 1, 'Применить', 'general', 'gen'),
('btn_cancel', 1, 'Отмена', 'general', 'gen'),
('btn_close', 1, 'Закрыть', 'general', 'gen'),
('btn_collapse', 1, 'Свернуть', 'back', 'gen'),
('btn_delete', 1, 'Удалить', 'general', 'gen'),
('btn_down', 1, 'Вниз', 'back', 'gen'),
('btn_edit', 1, 'Редактировать', 'general', 'gen'),
('btn_expand', 1, 'Развернуть', 'back', 'gen'),
('btn_goto_division', 1, 'Перейти в раздел', 'back', 'dvn'),
('btn_hide_tags', 1, 'Спрятать теги', 'back', 'gen'),
('btn_login', 1, 'Вход', 'general', 'gen'),
('btn_ok', 1, 'OK', 'general', 'gen'),
('btn_save', 1, 'Сохранить', 'general', 'gen'),
('btn_show_tags', 1, 'Показать теги', 'back', 'gen'),
('btn_sort_asc', 1, 'Сортировать по возрастающей', 'back', 'gen'),
('btn_sort_desc', 1, 'Сортировать по убывающей', 'back', 'gen'),
('btn_up', 1, 'Наверх', 'back', 'gen'),
('btn_upload', 1, 'Загрузить', 'general', 'gen'),
('cfg_allow_comparison_in_simple_search_description', 1, 'Включите, чтобы разрешить покупателям сравнивать товары при простом поиске (по имени и описанию)', 'back', 'cfg'),
('cfg_allow_comparison_in_simple_search_title', 1, 'Разрешить сравнение продуктов в результатах простого поиска', 'back', 'cfg'),
('cfg_allow_ordering_description', 1, 'Выключите эту опцию, если вы хотите отключить возможность оформления заказов и добавления товаров в корзину', 'back', 'cfg'),
('cfg_allow_ordering_title', 1, 'Возможность добавления товаров в корзину и оформления заказов', 'back', 'cfg'),
('cfg_catpict_size_description', 1, 'При загрузке логотипа категории его размер автоматически уменьшается. Укажите в пикселях размер, к которому нужно приводить загружаемое изображение, если его размер превышает указанный.', 'back', 'cfg'),
('cfg_catpict_size_title', 1, 'Размер изображения (логотипа) категории', 'back', 'cfg'),
('cfg_check_stock_description', 1, 'В случае, если опция выключена, информация о наличии товаров на складе не будет обновляться и проверяться', 'back', 'cfg'),
('cfg_check_stock_title', 1, 'Вести учет товаров на складе', 'back', 'cfg'),
('cfg_columns_per_page_description', 1, 'при просмотре категорий и результатов поиска', 'back', 'cfg'),
('cfg_columns_per_page_title', 1, 'Количество столбцов при показе товаров на странице', 'back', 'cfg'),
('cfg_completed_order_status_description', 1, 'Выберите статус заказа', 'back', 'cfg'),
('cfg_completed_order_status_title', 1, 'Статус завершенного (выполненного) заказа', 'back', 'cfg'),
('cfg_confirmation_code_description', 1, 'При отправке данных через форму в вашем магазине (обратная связь, регистрация, оформление заказов) запрашивать у пользователя ввод случайного числа, изображенного на рисунке. Настоятельно рекомендуем включить, чтобы злоумышленники не могли отправить данные в формы вашего магазина через сторонние скрипты.', 'back', 'cfg'),
('cfg_confirmation_code_title', 1, 'Защита от отправки данных в магазин через сторонние скрипты (captcha)', 'back', 'cfg'),
('cfg_country_description', 1, 'Страна, в которой находится Ваш магазин (необходимо для расчета стоимости доставки)', 'back', 'cfg'),
('cfg_country_title', 1, 'Страна', 'back', 'cfg'),
('cfg_cpt_news_number_description', 1, 'Пожалуйста, укажите, сколько последних новостей показывать в столбце с аннотациями', 'back', 'cfg'),
('cfg_cpt_news_number_title', 1, 'Количество записей в кратком содержании блога', 'back', 'cfg'),
('cfg_customer_actiovation_description', 1, 'Если включить эту опцию, покупателю после регистрации будет отправлен код активации аккаунта, который он должен будет ввести для того, чтобы начать пользоваться аккаунтом в вашем магазине.', 'back', 'cfg'),
('cfg_customer_actiovation_title', 1, 'Требовать активацию аккаунта покупателем после регистрации', 'back', 'cfg'),
('cfg_date_format_description', 1, 'Выберите формат отображения даты', 'back', 'cfg'),
('cfg_date_format_title', 1, 'Формат даты', 'back', 'cfg'),
('cfg_default_currency_description', 1, 'cтрана по умолчанию в форме регистрации покупателя', 'back', 'cfg'),
('cfg_default_currency_title', 1, 'Страна по умолчанию', 'back', 'cfg'),
('cfg_default_customer_group_description', 1, 'группа пользователей, к которой будет автоматически отнесен каждый новый покупатель после регистрации', 'back', 'cfg'),
('cfg_default_customer_group_title', 1, 'Группа по умолчанию', 'back', 'cfg'),
('cfg_default_tax_class_description', 1, 'класс налогов, устанавливаемый по умолчанию для всех товаров, которые вы добавляете в магазин', 'back', 'cfg'),
('cfg_default_tax_class_title', 1, 'Класс налогов по умолчанию', 'back', 'cfg'),
('cfg_default_title_description', 1, 'Текст, который вы введете здесь, будет добавлен в качестве заголовка (TITLE) главной страницы магазина (витрина)', 'back', 'cfg'),
('cfg_default_title_title', 1, 'Заголовок главной страницы магазина', 'back', 'cfg'),
('cfg_exact_product_balance_description', 1, 'Если включена, покупатель увидит точное количество продукта на складе (число). Если выключена, пользователю будет только показано, есть продукт на складе или нет.', 'back', 'cfg'),
('cfg_exact_product_balance_title', 1, 'Показывать пользователю точный остаток товаров на складе', 'back', 'cfg'),
('cfg_first_weekday_description', 1, 'Понедельник или воскресенье', 'back', 'cfg'),
('cfg_first_weekday_title', 1, 'Первый день недели', 'back', 'cfg'),
('cfg_force_smarty_description', 1, 'Настоятельно рекомендуется оставить включенным при изменении дизайна вашего магазина (когда вы изменяете файлы шаблонов); после того, как редизайн будет закончен, выключите эту опцию (это увеличит скорость работы магазина)', 'back', 'cfg'),
('cfg_force_smarty_title', 1, 'Принудительное перекомпиллирование шаблонов Smarty', 'back', 'cfg'),
('cfg_fully_expand_categories_in_admin_description', 1, 'Рекомендуется выключить эту опцию, если количество категорий в вашем магазине превышает 100. Это увеличит скорость загрузки форм (окон) редактора.', 'back', 'cfg'),
('cfg_fully_expand_categories_in_admin_title', 1, 'Полностью "разворачивать" список категорий в окнах редактирования то', 'back', 'cfg'),
('cfg_ga_account_number_description', 1, 'Введите номер профиля в Google Analytics. Например, 123456-1 или UA-123456-1.', 'back', 'cfg'),
('cfg_ga_account_number_title', 1, 'Номер аккаунта', 'back', 'cfg'),
('cfg_ga_enable_description', 1, '&nbsp;', 'back', 'cfg'),
('cfg_ga_enable_title', 1, 'Включить интеграцию с Google Analytics', 'back', 'cfg'),
('cfg_ga_usd_description', 1, 'Суммы заказов, которые передаются в Google Analytics в момент их оформления в долларах США. Укажите валюту вашего интернет-магазина, которая представляет доллары США. Это необходимо для правильного пересчета сумм заказов.', 'back', 'cfg'),
('cfg_ga_usd_title', 1, 'Валюта "Доллары США"', 'back', 'cfg'),
('cfg_general_email_description', 1, 'Этот электронный адрес будет использоваться как обратный адрес (From и Reply-to) в электронных письмах, которые магазин отправляет вашим покупателям (например, уведомления о заказах). На этот адрес будут приходить сообщения, отправляемые покупателями через формы обратной связи.', 'back', 'cfg'),
('cfg_general_email_title', 1, 'Основной email-адрес магазина', 'back', 'cfg'),
('cfg_grp_cart_ordering', 1, 'Корзина и заказы', 'back', 'cfg'),
('cfg_grp_catalog', 1, 'Каталог', 'back', 'cfg'),
('cfg_grp_customers', 1, 'Покупатели', 'back', 'cfg'),
('cfg_grp_general', 1, 'Настройки магазина', 'back', 'cfg'),
('cfg_homepage_metadescription_description', 1, 'Текст, который вы введете здесь, будет добавлен в качестве META Description главной страницы магазина (витрина).', 'back', 'cfg'),
('cfg_homepage_metadescription_title', 1, 'META Description главной страницы', 'back', 'cfg'),
('cfg_homepage_metakeywords_description', 1, 'Текст, который вы введете здесь, будет добавлен в качестве META Keywords главной страницы магазина (витрина).', 'back', 'cfg'),
('cfg_homepage_metakeywords_title', 1, 'META Keywords главной страницы', 'back', 'cfg'),
('cfg_how_toshow_shoppingcart_description', 1, 'Выберите как покупатели вашего магазина будут просматривать страницу корзины с покупками', 'back', 'cfg'),
('cfg_how_toshow_shoppingcart_title', 1, 'Как показывать корзину покупок', 'back', 'cfg'),
('cfg_min_order_amount_description', 1, 'Возможность оформления заказов, сумма которых меньше указанной, будет заблокирована.<br>Укажите 0, чтобы отключить ограничение на минимальный заказ', 'back', 'cfg'),
('cfg_min_order_amount_title', 1, 'Минимальная сумма заказа (в текущей валюте)', 'back', 'cfg'),
('cfg_new_order_status_description', 1, 'Все новые заказы будут автоматически приобретать этот статус', 'back', 'cfg'),
('cfg_new_order_status_title', 1, 'Статус нового заказа', 'back', 'cfg'),
('cfg_orders_email_description', 1, 'Введите электронный адрес, на который вы будете получать уведомления о новых заказах.', 'back', 'cfg'),
('cfg_orders_email_title', 1, 'Email для отправки уведомлений о заказах', 'back', 'cfg'),
('cfg_prdpict_standard_size_description', 1, 'При загрузке изображений продуктов их размер автоматически уменьшается. Укажите в пикселях размер, к которому нужно приводить загружаемые изображения, если их размер превышает указанные.', 'back', 'cfg'),
('pgn_category_search', 1, 'Результаты поиска в категории', 'general', 'gen'),
('cfg_prdpict_standard_size_title', 1, 'Размер стандартного изображения продукта', 'back', 'cfg'),
('cfg_prdpict_thumbnail_size_description', 1, 'При загрузке изображений продуктов их размер автоматически уменьшается. Укажите в пикселях размер, к которому нужно приводить загружаемые изображения, если их размер превышает указанные.', 'back', 'cfg'),
('cfg_prdpict_thumbnail_size_title', 1, 'Размер уменьшенного изображения продукта (preview)', 'back', 'cfg'),
('cfg_products_per_page_description', 1, 'Максимальное число продуктов, которое показывается на одной странице в пользовательской части магазина (в результатах поиска и при просмотре продуктов внутри категории)', 'back', 'cfg'),
('cfg_products_per_page_title', 1, 'Количество продуктов на одной странице', 'back', 'cfg'),
('cfg_product_sort_description', 1, 'Предоставлять пользователям возможность сортировки товарных позиций в одной товарной категории по цене, наименованию, рейтингу', 'back', 'cfg'),
('cfg_product_sort_title', 1, 'Сортировка товаров', 'back', 'cfg'),
('cfg_quick_checkout_description', 1, 'Выключите, если вы хотите, чтобы заказы могли оформлять только пользователи, зарегистрированные в вашем магазине.', 'back', 'cfg'),
('cfg_quick_checkout_title', 1, 'Оформление заказов без регистрации разрешено', 'back', 'cfg'),
('cfg_request_billing_address_description', 1, 'Включите эту опцию, если адрес плательщика может отличаться от адреса доставки заказа, и вы хотите запрашивать у покупателя адрес выставления счета отдельно от адреса доставки заказа', 'back', 'cfg'),
('cfg_request_billing_address_title', 1, 'Запрашивать у покупателя адрес выставления счета (адрес плательщика)', 'back', 'cfg'),
('cfg_secure_checkout_description', 1, 'Включите, если вы хотите, чтобы оформление заказов всегда производилось в защищенном режиме SSL. Если ваш магазин работает по адресу на домене webasyst.net (например, yourcompany.webasyst.net), то рекомендуем включить эту опцию, потому что для этого доменного имени SSL-сертификат уже предустановлен. Если магазин работает на доменном имени второго уровня (например, www.yourcompany.ru), то для того, чтобы заказ происходил в защищенном режиме, вы должны приобрести и установить SSL-сертификат для этого доменного имени. По этому вопросу вы можете обратиться к регистратору доменного имени.', 'back', 'cfg'),
('cfg_secure_checkout_title', 1, 'Оформление заказа производится в защищенном режиме (SSL)', 'back', 'cfg'),
('cfg_shipping_tax_description', 1, 'Если на стоимость доставки необходимо вычислять налог, пожалуйста, укажите класс налогов, по которому будет вычисляться ставка налога.', 'back', 'cfg'),
('cfg_shipping_tax_title', 1, 'Доставка облагается налогом', 'back', 'cfg'),
('cfg_store_name_description', 1, 'Введенное значение будет добавляться в TITLE всех страниц магазина, а также в сообщения покупателям (например, в уведомления о заказах)', 'back', 'cfg'),
('cfg_store_name_title', 1, 'Название магазина', 'back', 'cfg'),
('cfg_store_url_description', 1, 'Укажите полный адрес вашего магазина вместе с http://, без index.php, адрес должен заканчиваться символом /. Например, http://www.yourshop.ru/shop/<br>Если адрес указан неверно, магазин может работать некорректно!', 'back', 'cfg'),
('cfg_store_url_title', 1, 'Полный адрес магазина в Интернет', 'back', 'cfg'),
('cfg_update_gcv_description', 1, 'Рекомендуется выключить эту опцию при количестве товаров более 10000 (десяти тысяч)', 'back', 'cfg'),
('cfg_update_gcv_title', 1, 'Автоматически обновлять количество товаров на складе', 'back', 'cfg'),
('cfg_weight_unit_description', 1, 'Выберите единицу измерения веса, в которой вы указываете вес товаров в магазине.', 'back', 'cfg'),
('cfg_weight_unit_title', 1, 'Единица измерения веса', 'back', 'cfg'),
('cfg_region_description', 1, 'Область, в которой находится Ваш магазин (необходимо для расчета стоимости доставки)', 'back', 'cfg'),
('cfg_region_title', 1, 'Область', 'back', 'cfg'),
('checkout_already_have_account', 1, 'У вас уже есть аккаунт в %SHOPNAME%?', 'front', 'gen'),
('checkout_as_newcustomer', 1, 'Оформление заказа от имени нового покупателя', 'general', 'gen'),
('checkout_email_exists', 1, 'Пользователь с электроадресом <strong>[email]</strong> уже зарегистрирован', 'front', 'gen'),
('checkout_next_step', 1, 'Далее', 'front', 'gen'),
('checkout_permanent_registering', 1, 'Я хочу зарегистрировать постоянный аккаунт в %SHOPNAME%, чтобы повторно не вводить информацию при будущих заказах', 'front', 'gen'),
('checkout_yourinfo_header', 1, 'Ваш адрес', 'front', 'gen'),
('cpts_nosettings', 1, 'У компонента нет настроек', 'back', 'thm'),
('cpts_settings_updated', 1, 'Настройки компонента обновлены.<br /><br />Изменения вступят в силу ТОЛЬКО после того, как вы сохраните весь шаблон и затем обновите страницу пользовательской части магазина в браузере (F5).', 'back', 'thm'),
('cpt_bin', 1, 'Корзина', 'general', 'cpt'),
('cpt_lbl_auxpages_navigation', 1, 'Информационные страницы', 'general', 'cpt'),
('cpt_lbl_divisions_navigation', 1, 'Разделы', 'general', 'cpt'),
('cpt_lbl_horizontal', 1, 'Горизонтальный', 'general', 'cpt'),
('cpt_lbl_product_add2cart_button', 1, 'Кнопка "Добавить в корзину"', 'general', 'cpt'),
('cpt_lbl_product_description', 1, 'Описание продукта', 'general', 'cpt'),
('cpt_lbl_product_details_request', 1, 'Форма запроса дополнительной информации о продукте', 'general', 'cpt'),
('cpt_lbl_product_discuss_link', 1, 'Отзывы', 'general', 'cpt'),
('cpt_lbl_product_images', 1, 'Изображения продукта', 'general', 'cpt'),
('cpt_lbl_product_name', 1, 'Название продукта', 'general', 'cpt'),
('cpt_lbl_product_price', 1, 'Цена', 'general', 'cpt'),
('cpt_lbl_product_rate_form', 1, 'Оценка продукта', 'general', 'cpt'),
('cpt_lbl_product_related_products', 1, 'Связанные продукты', 'general', 'cpt'),
('cpt_lbl_selectauxpages', 1, 'Выберите страницы', 'general', 'cpt'),
('cpt_lbl_selectaux_type_all', 1, 'Все страницы', 'general', 'cpt'),
('cpt_lbl_selectaux_type_selected', 1, 'Выберите страницы', 'general', 'cpt'),
('cpt_lbl_selectdivisions', 1, 'Выберите разделы', 'general', 'cpt'),
('cpt_lbl_vertical', 1, 'Вертикальный', 'general', 'cpt'),
('cpt_lbl_view', 1, 'Выберите вид', 'general', 'cpt'),
('curr_add_currency', 1, 'Добавить валюту', 'back', 'cur'),
('curr_change_default_currency', 1, 'изменить', 'back', 'cur'),
('curr_change_default_curr_important', 1, 'ВАЖНО: При изменении валюты по умолчанию все цены на продукты вашего интернет-магазина будут пересчитаны на новую валюту согласно указанному курсу.', 'back', 'cur'),
('curr_curr_output_example', 1, 'Пример', 'back', 'cur'),
('curr_dec_placed', 1, 'Количество дробных знаков', 'back', 'cur'),
('curr_dec_symbol', 1, 'Разделитель целой и дробной части', 'back', 'cur'),
('curr_default_currency', 1, 'Валюта по умолчанию', 'back', 'cur'),
('curr_enter_positive_rate', 1, 'Введите положительное число', 'back', 'cur'),
('curr_exchange_rate', 1, 'Курс', 'back', 'cur'),
('curr_nothing', 1, 'ничего', 'back', 'cur'),
('curr_other_currencies', 1, 'Остальные валюты', 'back', 'cur'),
('curr_output_format', 1, 'Шаблон', 'back', 'cur'),
('curr_return_to_currencies', 1, 'Вернуться к списку валют', 'back', 'cur'),
('curr_select_new_default_currency', 1, 'Выберите валюту по умолчанию', 'back', 'cur'),
('curr_space', 1, 'пробел', 'back', 'cur'),
('curr_thousands_delimiter', 1, 'Разделитель групп разрядов', 'back', 'cur'),
('deinstall', 1, 'Удалить', 'general', 'gen'),
('disable', 1, 'Отключить', 'general', 'gen'),
('disabled_short', 1, 'Выкл.', 'general', 'gen'),
('div_connected_interfaces', 1, 'Подключенные интерфейсы', 'back', 'dvn'),
('div_cross_key', 1, 'Ключ перекрестного раздела', 'back', 'dvn'),
('div_enable_fld', 1, 'Включен', 'back', 'dvn'),
('div_etxrafld_name', 1, 'Название', 'back', 'dvn'),
('div_extrafld_key', 1, 'Ключ', 'back', 'dvn'),
('div_extra_field', 1, 'Дополнительное поле', 'back', 'dvn'),
('div_id_fld', 1, 'Номер раздела', 'back', 'dvn'),
('div_key_fld', 1, 'Ключ', 'back', 'dvn'),
('div_name_fld', 1, 'Название', 'back', 'dvn'),
('div_pid_fld', 1, 'Номер родительского раздела', 'back', 'dvn'),
('div_priority_fld', 1, 'Приоритет', 'back', 'dvn'),
('div_template_fld', 1, 'Шаблон', 'back', 'dvn'),
('div_ukey_fld', 1, 'Уникальный ключ', 'back', 'dvn'),
('enable', 1, 'Включить', 'general', 'gen'),
('enabled_short', 1, 'вкл.', 'general', 'gen'),
('forbidden_page', 1, 'У вас нет прав для доступа к этому экрану', 'general', 'gen'),
('imm_description', 1, 'В этом разделе вы можете загрузить изображения для вашего интернет-магазина.<br />\r\nПоддерживается возможность загрузки следующих типов изображений: GIF, JPG, BMP, PNG.', 'back', 'imm'),
('imm_image_deleted', 1, 'Изображение удалено', 'back', 'imm'),
('imm_image_uploaded', 1, 'Изображение загружено', 'back', 'imm'),
('imm_img_delete_confirmation', 1, 'Удалить файл с сервера?', 'back', 'imm'),
('imm_notimage', 1, 'Разрешена только загрузка изображений следующих типов: GIF, JPG, BMP, PNG', 'back', 'imm'),
('int_heritable', 1, 'Наследуемый', 'back', 'dvn'),
('int_priority', 1, 'Приоритет', 'back', 'dvn'),
('lang_english', 1, 'Английский', 'back', 'gen'),
('lang_russian', 1, 'Русский', 'back', 'gen'),
('lgr_back', 1, 'Администрирование', 'back', 'gen'),
('lgr_front', 1, 'Витрина', 'back', 'gen'),
('lgr_general', 1, 'Общие', 'back', 'gen'),
('link_exchange', 1, 'Обмен ссылками', 'front', 'gen'),
('loc_add_local', 1, 'Добавить новую строку', 'back', 'loc'),
('loc_btn_addlang', 1, 'Добавить язык', 'back', 'loc'),
('loc_btn_changedeflang', 1, 'Изменить основной язык', 'back', 'loc'),
('loc_couldnt_delete_deflang', 1, 'Вы не можете удалить основной язык.', 'back', 'loc'),
('loc_current_default_language', 1, 'Текущий', 'back', 'loc'),
('loc_default_lang', 1, 'основной', 'back', 'loc'),
('loc_del_confirmation', 1, 'Вы уверены, что хотите удалить запись?', 'back', 'loc'),
('loc_edit_locals', 1, 'Редактировать перевод', 'back', 'loc'),
('loc_empty_loc_defvalue', 1, 'Пожалуйста, введите перевод для основного языка', 'back', 'loc'),
('loc_empty_loc_id', 1, 'Пожалуйста, введите ID локализации.', 'back', 'loc'),
('loc_error_file_upload', 1, 'Произошла ошибка при загрузке файла.', 'back', 'loc'),
('loc_find', 1, 'Найти', 'back', 'loc'),
('loc_flag', 1, 'Флаг', 'back', 'loc'),
('loc_highlight', 1, 'Выделить', 'back', 'loc'),
('loc_highlight_nottranslated', 1, 'Подсветить непереведенные строки', 'back', 'loc'),
('loc_iso2_reserved', 1, 'Этот ISO2 код языка уже используется. Измените код и повторите попытку сохранения', 'back', 'loc'),
('loc_langdel_confirmation', 1, 'Вы уверены, что хотите удалить язык? Действие необратимо.', 'back', 'loc'),
('loc_langicon_upload', 1, 'Загрузить', 'back', 'loc'),
('loc_langiso2_descr', 1, '2 символа', 'back', 'loc'),
('loc_langorder_saved', 1, 'Порядок сортировки был сохранен', 'back', 'loc'),
('loc_language', 1, 'Язык', 'back', 'loc'),
('loc_languages', 1, 'Список языков', 'back', 'loc'),
('loc_languages_added', 1, 'Язык добавлен.', 'back', 'loc'),
('loc_lang_delete', 1, 'Удалить', 'back', 'loc'),
('loc_lang_enable', 1, 'Включить', 'back', 'loc'),
('loc_lang_enabled', 1, 'Включен', 'back', 'loc'),
('loc_lang_icon', 1, 'Иконка (<a href="http://www.famfamfam.com/lab/icons/flags/" target="_blank">загрузить красивые иконки флагов</a>)', 'back', 'loc'),
('loc_lang_id', 1, 'ID', 'back', 'loc'),
('loc_lang_iso2', 1, 'Код', 'back', 'loc'),
('loc_lang_name', 1, 'Название', 'back', 'loc'),
('loc_local_defvalue', 1, 'Основной', 'back', 'loc'),
('loc_local_id', 1, 'ID', 'back', 'loc'),
('loc_local_subgroup', 1, 'Группа', 'back', 'loc'),
('loc_local_value', 1, 'Перевод', 'back', 'loc'),
('loc_local_was_deleted', 1, 'Строка была удалена.', 'back', 'loc'),
('loc_msg_lang_removed', 1, 'Выбранный вами язык был удален.', 'back', 'loc'),
('loc_new_default_language', 1, 'Новый', 'back', 'loc'),
('loc_notsupported_filetype', 1, 'Данный тип файлов не поддерживается.', 'back', 'loc'),
('loc_nottranslated', 1, 'Не переведенные', 'back', 'loc'),
('loc_no_searchresults', 1, 'Строки локализации не найдены.', 'back', 'loc'),
('loc_q_remove_lang', 1, 'Удалить', 'back', 'loc'),
('loc_q_remove_local', 1, 'Удалить строку', 'back', 'loc'),
('loc_required_fields', 1, '* Обязательные поля', 'back', 'loc'),
('loc_reserved_loc_id', 1, 'Строка с указанным ID уже существует. Измените ID и попробуйте еще раз.', 'back', 'loc'),
('loc_return_to_localslist', 1, 'Вернуться к редактированию строк', 'back', 'loc'),
('loc_search_results', 1, 'Результаты поиска', 'back', 'loc'),
('loc_settings', 1, 'Настройки', 'back', 'loc'),
('loc_show_empty_translations', 1, 'Показать остальные языки', 'back', 'loc'),
('lsgr_components', 1, 'Компоненты', 'back', 'gen'),
('lsgr_configuration', 1, 'Настройки', 'back', 'gen'),
('lsgr_currencies', 1, 'Валюты', 'back', 'gen'),
('lsgr_division', 1, 'Раздел', 'back', 'gen'),
('lsgr_general', 1, 'Общие', 'back', 'gen'),
('lsgr_immanager', 1, 'Загрузка изображений', 'back', 'gen'),
('lsgr_localization', 1, 'Локализация', 'back', 'gen'),
('lsgr_modules', 1, 'Модули', 'back', 'gen'),
('lsgr_other', 1, 'Остальные', 'back', 'gen'),
('lsgr_products', 1, 'Продукты', 'back', 'gen'),
('lsgr_reports', 1, 'Отчеты', 'back', 'gen'),
('lsgr_test', 1, 'Тест', 'back', 'gen'),
('lsgr_themes', 1, 'Темы', 'back', 'gen'),
('mdl_enabled', 1, 'Включен', 'back', 'mdl'),
('mdl_selected_configs', 1, 'Отмеченные конфигурации', 'back', 'mdl'),
('msg_dragable', 1, 'Перетащите для сортировки', 'back', 'gen'),
('msg_error_diskusage', 1, 'Недостаточно дискового пространства. Вы можете увеличить допустимое дисковое пространство в контрольной панели аккаунта ВебАсист (если у вас нет доступа к контрольной панели, обратитесь к администратору аккаунта).', 'general', 'gen'),
('msg_error_filecopy', 1, 'Не удалось скопировать файл', 'general', 'gen'),
('msg_error_filemoveupload', 1, 'Не удалось переместить загруженный файл', 'general', 'gen'),
('msg_error_fileremove', 1, 'Не удалось удалить файл', 'general', 'gen'),
('msg_field_required', 1, 'Поле `%s` обязательно для заполнения', 'general', 'gen'),
('msg_fill_required_fields', 1, 'Пожалуйста, заполните обязательные поля.', 'back', 'gen'),
('msg_information_save', 1, 'Информация сохранена!', 'back', 'gen'),
('msg_no_data', 1, 'Нет данных', 'general', 'gen'),
('msg_unsaved_changes', 1, 'Если вы покинете эту страницу, ваши изменения будут утеряны.', 'hidden', 'gen'),
('news', 1, 'Блог / Новости', 'general', 'gen'),
('order_saved', 1, 'Порядок сортировки был сохранен', 'back', 'gen'),
('payment', 1, 'Оплата', 'general', 'gen'),
('pgn_ap_1', 1, 'О магазине', '', ''),
('pgn_addlanguage', 1, 'Добавить язык', 'back', 'gen'),
('pgn_addmod_language', 1, 'Настройки языка', 'back', 'gen'),
('pgn_addmod_product', 1, 'Настройки товара', 'back', 'gen'),
('pgn_address_book', 1, 'Адресная книга', 'general', 'cmr'),
('pgn_add_address', 1, 'Добавить адрес', 'general', 'cmr'),
('pgn_add_language', 1, 'Добавить язык', 'back', 'gen'),
('pgn_add_news', 1, 'Новое сообщение', 'back', 'gen'),
('pgn_affiliate_balance', 1, 'Баланс', 'general', 'gen'),
('pgn_affiliate_program', 1, 'Партнерская программа', 'general', 'gen'),
('pgn_affiliate_settings', 1, 'Настройки', 'general', 'gen'),
('pgn_affilite_program', 1, 'Партнерская программа', 'back', 'gen'),
('pgn_affpr_earn_money', 1, 'Как заработать деньги на партнерской программе', 'general', 'gen'),
('pgn_affpr_payments_history', 1, 'История выплат', 'general', 'gen'),
('pgn_authorization', 1, 'Авторизация', 'general', 'gen'),
('pgn_auxpages', 1, 'Информационные страницы', 'general', 'gen'),
('pgn_auxpages_admin', 1, 'Управление дополнительными страницами', 'general', 'gen'),
('pgn_aux_pages', 1, 'Информационные страницы', 'back', 'gen'),
('pgn_cart', 1, 'Корзина', 'general', 'gen'),
('pgn_catalog', 1, 'Продукты', 'back', 'gen'),
('pgn_categories_reports', 1, 'Отчет по категориям', 'back', 'gen'),
('pgn_category_tree', 1, 'Категории', 'general', 'gen'),
('pgn_change_address', 1, 'Изменить адрес', 'general', 'gen'),
('pgn_change_default_currency', 1, 'Изменить валюту по умолчанию', 'general', 'gen'),
('pgn_change_deflang', 1, 'Выбрать основной язык', 'back', 'gen'),
('pgn_contact_info', 1, 'Контактная информация', 'general', 'gen'),
('pgn_countries', 1, 'Страны', 'back', 'gen'),
('pgn_cpt_constructor', 1, 'Конструктор компонентов', 'general', 'gen'),
('pgn_cpt_settings', 1, 'Настройки компонента', 'back', 'gen'),
('pgn_currency_types', 1, 'Валюты', 'back', 'gen'),
('pgn_custgroups', 1, 'Группы покупателей', 'back', 'gen'),
('pgn_customers', 1, 'Покупатели', 'back', 'gen'),
('pgn_customer_activation', 1, 'Активация пользователя', 'general', 'gen'),
('pgn_customer_fields', 1, 'Форма регистрации и оформления заказов', 'back', 'gen'),
('pgn_delivery', 1, 'Доставка', 'general', 'gen'),
('pgn_discounts', 1, 'Скидки', 'back', 'gen'),
('pgn_discuss_product', 1, 'Обсуждение продукта', 'general', 'gen'),
('pgn_divisions', 1, 'Разделы', 'back', 'gen'),
('pgn_divsettings', 1, 'Настройки раздела', 'back', 'gen'),
('pgn_edit_address', 1, 'Редактирование адреса', 'general', 'gen'),
('pgn_edit_locals', 1, 'Редактирование строк локализации', 'back', 'gen'),
('pgn_export2googlebase', 1, 'Google Base', 'back', 'gen'),
('pgn_export_products', 1, 'Экспорт', 'back', 'gen'),
('pgn_feedback', 1, 'Обратная связь', 'general', 'gen'),
('pgn_find_local', 1, 'Найти строку локализации', 'back', 'gen'),
('pgn_general_settings', 1, 'Настройки', 'back', 'gen'),
('pgn_home', 1, 'Витрина', 'general', 'gen'),
('pgn_images_manager', 1, 'Загрузка изображений', 'back', 'gen'),
('pgn_import_products', 1, 'Импорт', 'back', 'gen'),
('pgn_invoice', 1, 'Инвойс', 'general', 'gen'),
('pgn_languages', 1, 'Языки и перевод', 'back', 'gen'),
('pgn_linkexchange', 1, 'Обмен ссылками', 'general', 'gen'),
('pgn_link_exchange_admin', 1, 'Обмен ссылками', 'back', 'gen'),
('pgn_login_log', 1, 'Журнал авторизации пользователей', 'back', 'gen'),
('pgn_mainpage', 1, 'Главная страница', 'general', 'gen'),
('pgn_modules', 1, 'Инструменты', 'back', 'gen'),
('pgn_my_account', 1, 'Мой счет', 'general', 'gen'),
('pgn_news', 1, 'Блог / Новости', 'general', 'gen'),
('pgn_newsletter_subscribers', 1, 'Подписчики на новости', 'back', 'gen'),
('pgn_news_administration', 1, 'Блог / Новости', 'back', 'gen'),
('pgn_orders', 1, 'Заказы', 'back', 'gen'),
('pgn_order_confirmation', 1, 'Подтверждение заказа', 'general', 'gen'),
('pgn_order_detailed', 1, 'Информация о заказе', 'general', 'gen'),
('pgn_order_history', 1, 'История заказов', 'general', 'cmr'),
('pgn_order_processing', 1, 'Оформление заказа', 'general', 'gen'),
('pgn_order_statuses', 1, 'Статусы заказов', 'back', 'gen'),
('pgn_payment', 1, 'Способ оплаты', 'general', 'gen'),
('pgn_payment_methods', 1, 'Оплата', 'back', 'gen'),
('pgn_payment_modules', 1, 'Модули оплаты', 'back', 'gen'),
('pgn_presentation', 1, 'Дизайн', 'back', 'gen'),
('pgn_pricelist', 1, 'Прайс-лист', 'general', 'gen'),
('pgn_print_version', 1, 'Версия для печати', 'general', 'gen'),
('pgn_product', 1, 'Продукт', 'general', 'gen'),
('pgn_products_categories', 1, 'Продукты и категории', 'back', 'gen'),
('pgn_products_reports', 1, 'Отчёт по продуктам', 'back', 'gen'),
('pgn_product_customparams', 1, 'Доп. характеристики', 'back', 'gen'),
('pgn_product_reviews', 1, 'Отзывы', 'general', 'gen'),
('pgn_register', 1, 'Зарегистрироваться', 'general', 'gen'),
('pgn_registration', 1, 'Регистрация', 'general', 'gen'),
('pgn_remind_password', 1, 'Напомнить пароль', 'general', 'gen'),
('pgn_reports', 1, 'Отчеты', 'back', 'gen'),
('pgn_sales_report', 1, 'Отчет о продажах', 'general', 'gen'),
('pgn_settings', 1, 'Настройки', 'back', 'gen'),
('pgn_shipping_methods', 1, 'Доставка', 'back', 'gen'),
('pgn_shipping_modules', 1, 'Модули доставки', 'back', 'gen'),
('pgn_ap_3', 1, 'Доставка и оплата', 'hidden', 'lsg'),
('pgn_sms_notifications', 1, 'SMS', 'back', 'gen'),
('pgn_successful_registration', 1, 'Успешная регистрация', 'general', 'gen'),
('pgn_survey_administration', 1, 'Голосование', 'back', 'gen'),
('pgn_taxes', 1, 'Налоги', 'back', 'gen'),
('pgn_test', 1, 'Тест', 'general', 'gen'),
('pgn_themes_list', 1, 'Редактор дизайна', 'general', 'gen'),
('pgn_theme_edit', 1, 'Редактирование темы', 'general', 'gen'),
('pgn_transaction_result', 1, 'Результат транзакции', 'general', 'gen'),
('pgn_user_activation', 1, 'Активация пользователя', 'general', 'gen'),
('pgn_visits_log', 1, 'Журнал посещений', 'general', 'gen'),
('pgn_yandex_market', 1, 'Яндекс.Маркет', 'back', 'gen'),
('pgn_regions', 1, 'Области', 'back', 'gen'),
('prdset_btn_delete_pict', 1, 'Удалить', 'back', 'prd'),
('prdset_btn_hide_products', 1, 'Убрать список', 'back', 'prd'),
('prdset_btn_next_products', 1, 'Вперед', 'back', 'prd'),
('prdset_btn_prev_products', 1, 'Назад', 'back', 'prd'),
('prdset_btn_setdefault_pict', 1, 'Сделать основной', 'back', 'prd'),
('prdset_freeshipping_description', 1, 'раз', 'back', 'prd'),
('prdset_lnk_choose_parentcategory', 1, 'Выбрать', 'back', 'prd'),
('prdset_lnk_to_product_list', 1, 'Список продуктов', 'back', 'prd'),
('prdset_lnk_upload', 1, 'Загрузить', 'back', 'prd'),
('prdset_msg_choosen_relatedproduct', 1, 'Добавлен %s', 'back', 'prd'),
('prdset_msg_confirm_pict_delete', 1, 'Удалить изображение продукта?', 'back', 'prd'),
('prdset_msg_fill_productname', 1, 'Введите название продукта', 'back', 'prd'),
('prdset_msg_loading_products', 1, 'Загружаю продукты', 'back', 'prd'),
('prdset_msg_onlyimages', 1, 'Вы можете загружать только изображения', 'back', 'prd'),
('prdset_str_category', 1, 'Категория', 'back', 'prd'),
('prdset_str_extraoptions', 1, 'Параметры', 'back', 'prd'),
('prdset_str_images', 1, 'Изображения', 'back', 'prd'),
('prdset_str_invisible', 1, 'Скрытый', 'back', 'prd'),
('prdset_str_meta', 1, 'Мета', 'back', 'prd'),
('prdset_str_metadescription', 1, 'Описание', 'back', 'prd'),
('prdset_str_metakeywords', 1, 'Ключевые слова', 'back', 'prd'),
('prdset_str_noappendcategories', 1, 'Дополнительные категории не выбраны', 'back', 'prd'),
('prdset_str_ordering_available', 1, 'Можно купить', 'back', 'prd'),
('prdset_str_tags', 1, 'Тэги (разделитель - запятая)', 'back', 'prd'),
('prdset_tab_advanced', 1, 'Дополнительно', 'back', 'prd'),
('prdset_tab_simple', 1, 'Основное', 'back', 'prd'),
('prep_invisible_in_storefront', 1, '(не представлен в пользовательской части)', 'back', 'rep'),
('prep_invisible_products', 1, '[products] продуктов не представлены в пользовательской части интернет-магазина.', 'back', 'rep'),
('prep_notinstock_products', 1, '[products] продуктов с нулевым остатком на складе!', 'back', 'rep'),
('prep_total_products', 1, 'В вашем интернет-магазине [products] продуктов, распределенных по [categories] категориям.', 'back', 'rep'),
('shipping', 1, 'Доставка', 'general', 'gen'),
('srep_allorders', 1, 'Все заказы', 'back', 'rep'),
('srep_compare', 1, 'Сравнить', 'back', 'rep'),
('srep_data_range', 1, 'Выборка данных за', 'back', 'rep'),
('srep_delivered_orders', 1, 'Доставленные заказы', 'back', 'rep'),
('srep_last_month', 1, 'Предыдущий месяц', 'back', 'rep'),
('srep_last_week', 1, 'Предыдущая неделя', 'back', 'rep'),
('srep_last_year', 1, 'Предыдущий год', 'back', 'rep'),
('srep_noorders', 1, 'Нет заказов', 'back', 'rep'),
('srep_outofstock', 1, 'Нет на складе', 'back', 'rep'),
('srep_sreport_alltime', 1, 'Продажи за весь период работы магазина', 'back', 'rep'),
('srep_sreport_thismonth', 1, 'Динамика продаж', 'back', 'rep'),
('srep_this_month', 1, 'Текущий месяц', 'back', 'rep'),
('srep_this_p_month', 1, 'Текущий и предыдущий месяцы', 'back', 'rep'),
('srep_this_p_week', 1, 'Текущая и предыдущая недели', 'back', 'rep'),
('srep_this_p_year', 1, 'Текущий и предыдущий годы', 'back', 'rep'),
('srep_this_week', 1, 'Текущая неделя', 'back', 'rep'),
('srep_this_year', 1, 'Текущий год', 'back', 'rep'),
('stg_fade_layout', 1, 'Затемнять страницу и показывать поверх (рекомендуется)', 'back', 'cfg'),
('stg_new_page_cart', 1, 'Как отдельную страницу магазина', 'back', 'cfg'),
('str_all', 1, 'все', 'general', 'gen'),
('str_show_rows', 1, 'Кол-во записей', 'general', 'gen'),
('thm_advanced_tab', 1, 'Редактировать HTML-код', 'back', 'thm'),
('thm_btn_embed', 1, 'Добавить в шаблон', 'hidden', 'thm'),
('thm_btn_save_tpl', 1, 'Сохранить шаблон', 'general', 'thm'),
('thm_cpt_embed_btn', 1, 'Вставить', 'back', 'thm'),
('thm_css_link', 1, 'Стили (CSS)', 'back', 'thm'),
('thm_designeditor_descr_advanced', 1, 'Редактирование HTML-кода страницы, которую вы видите в простом режиме редактирования дизайна(конструкторе).<br />Используйте панель справа для добавления новых компонент в ваш магазин.<br />Смотрите более подробную информацию в нашем <a href="http://www.webasyst.ru/support/shop/manual.html#Redaktor-dizaina" target="_blank">описании работы редактора дизайна</a> и <a href="http://www.shop-script.ru/demo/design-editor-tutorial.html" target="_blank">описании примера пошагового изменения дизайна</a>.', 'back', 'gen'),
('thm_designeditor_descr_css', 1, 'Редактирование стилей (CSS) вашего магазина. Здесь вы можете изменить используемые шрифты, некоторое цветовое оформление и вид других элементов дизайна.<br />Смотрите <a href="http://www.webasyst.ru/shop/design-editor-guidelines.html" target="_blank">подробное описание работы редактора дизайна</a>.', 'back', 'thm'),
('thm_designeditor_descr_head', 1, 'Редактирование HTML-кода, который помещается между тэгами &lt;head&gt; ... &lt;/head&gt; всех страниц пользовательской части вашего интернет-магазина.', 'back', 'thm'),
('thm_designeditor_descr_simple', 1, '<b>Перетаскивайте компоненты магазина</b>, обозначенные красной пунктирной линией, по странице с помощью мышки. Вы можете перемещать каждый компонент между контейнерами (областями, обозначенными серой пунктирной линией).<br /><b>Двойной клик по компоненту</b> для редактирования его настроек.<br />Используйте колонку справа для того, чтобы добавлять новые компоненты.<br />Смотрите более подробную информацию в нашем <a href="http://www.shop-script.ru/demo/design-editor-tutorial.html" target="_blank">описании примера пошагового изменения дизайна</a>.', 'back', 'gen'),
('thm_exit', 1, 'К списку тем', 'back', 'thm'),
('thm_fill_all_fields', 1, 'Пожалуйста, заполните все поля', 'back', 'thm'),
('thm_generallayout_link', 1, 'Основная разметка', 'back', 'thm'),
('thm_head_link', 1, 'Head', 'back', 'thm'),
('thm_homepage_link', 1, 'Витрина', 'back', 'thm'),
('thm_htmlcode_key_exists', 1, 'Пожалуйста, выберите другой идентификатор для кода', 'back', 'thm'),
('thm_lnk_setforstorefront', 1, 'Сделать текущей', 'back', 'thm'),
('thm_msg_confirm_reset', 1, 'Вы уверены, что хотите сбросить все изменения, произведенные с этой темой? Действие необратимо.', 'back', 'thm'),
('thm_msg_cpt_settings_saved', 1, 'Настройки компонента сохранены', 'back', 'thm'),
('thm_msg_error_upload', 1, 'Ошибка загрузки файла', 'general', 'gen'),
('thm_msg_logo_exists', 1, 'Файл с таким именем уже существует. Пожалуйста, загрузите другой файл.', 'general', 'gen'),
('thm_msg_logo_only_imgs', 1, 'Вы можете загрузить только изображение', 'general', 'gen'),
('thm_msg_successful_reset', 1, 'Тема возвращена к первоначальному состоянию', 'back', 'thm'),
('thm_msg_theme_applied', 1, 'Сохранено', 'back', 'thm'),
('thm_notheme_msg', 1, 'Тема не найдена', 'back', 'thm'),
('thm_preview_link', 1, 'Посмотреть тему', 'back', 'thm'),
('thm_productinfo_link', 1, 'Продукт', 'back', 'thm'),
('thm_reset_link', 1, 'Сбросить все изменения (вернуть к первоначальному виду)', 'back', 'thm'),
('thm_simple_tab', 1, 'Конструктор (WYSIWYG)', 'back', 'thm'),
('thm_str_author', 1, 'Автор', 'back', 'thm'),
('thm_str_current_theme', 1, 'Текущая тема', 'back', 'thm'),
('thm_str_last_customized', 1, 'последний раз изменялась', 'back', 'thm'),
('thm_str_other_themes', 1, 'Другие темы', 'back', 'thm'),
('thm_template_saved_msg', 1, 'Шаблон успешно сохранен', 'hidden', 'thm'),
('survey', 1, 'Голосование', 'front', 'gen'),
('affp_amount_percent', 1, 'Процент от суммы заказа привлеченного клиента:', 'back', 'aff'),
('affp_commissions_calculate', 1, 'Расчет комиссионных вознаграждений', 'back', 'aff'),
('affp_edit_commission', 1, 'Редактирование комиссионного начисления', 'back', 'aff'),
('affp_edit_payment', 1, 'Редактирование выплаты пользователю', 'back', 'aff'),
('affp_enable_program', 1, 'Включить партнерскую программу', 'back', 'aff'),
('affp_msg_error_date_format', 1, 'Неверный формат даты', 'back', 'aff'),
('affp_new_commission', 1, 'Новое вознаграждение', 'back', 'aff'),
('affp_new_payment', 1, 'Новая выплата', 'back', 'aff'),
('affp_submit_new_commission', 1, 'Добавить начисление комиссионных', 'back', 'aff'),
('affp_submit_new_payment', 1, 'Добавить выплату', 'back', 'aff'),
('affp_user_settings_control', 1, 'Управление настройками пользователя', 'back', 'aff'),
('affr_email_new_commission_ctrl', 1, 'Отправлять пользователям уведомления о начислении новых комиссионных по электронной почте', 'back', 'aff'),
('affr_email_new_payment_ctrl', 1, 'Отправлять пользователям уведомления о новых выплатах по электронной почте', 'back', 'aff'),
('blog_emailposttosubscribers', 1, 'Разослать эту новость подписчикам', 'back', 'nws'),
('blog_err_empty_texttoemail', 1, 'Заполните текст для отправки подписчикам', 'back', 'nws'),
('blog_err_empty_titletext', 1, 'Заголовок или текст записи должны быть заполнены', 'back', 'nws'),
('blog_msg_picture_deleted', 1, 'Изображение, прикрепленное к записи, удалено', 'back', 'nws'),
('blog_msg_post_added', 1, 'Сообщение опубликовано', 'back', 'nws'),
('blog_msg_post_deleted', 1, 'Запись удалена', 'back', 'nws'),
('blog_msg_post_emailed_to_subscribers', 1, 'Запись была отправлена подписчикам', 'back', 'nws'),
('blog_post_body', 1, 'Запись', 'back', 'nws'),
('blog_post_list', 1, 'Блог / Новости', 'back', 'nws'),
('blog_post_newsletter_body', 1, 'Текст для отправки подписчикам', 'back', 'nws'),
('blog_post_title', 1, 'Заголовок', 'back', 'nws'),
('blog_postdate', 1, 'Дата', 'back', 'nws'),
('blog_str_html', 1, 'HTML', 'back', 'nws'),
('blog_str_not_html', 1, 'не HTML', 'back', 'nws'),
('blog_writepost', 1, 'Написать сообщение', 'back', 'nws'),
('cntr_all_countries', 1, 'Все страны', 'back', 'cnr'),
('cntr_all_other_countries', 1, 'Все остальные страны', 'back', 'cnr'),
('cntr_countries', 1, 'Страны', 'back', 'cnr'),
('cntr_country_iso2', 1, 'Код страны ISO2', 'back', 'cnr'),
('cntr_country_iso3', 1, 'Код страны ISO3', 'back', 'cnr'),
('rgn_all_other_regions', 1, 'Все остальные области', 'back', 'cnr'),
('rgn_all_regions', 1, 'Все области', 'back', 'cnr'),
('rgn_region_code', 1, 'код', 'back', 'cnr'),
('rgn_region_name', 1, 'Область', 'back', 'cnr'),
('rgn_regions', 1, 'Области', 'back', 'cnr'),
('curr_currency_exchangerate', 1, 'Курс1', 'back', 'cur'),
('curr_currency_id', 1, 'Обозначение в магазине1', 'back', 'cur'),
('curr_currency_name', 1, 'Название валюты', 'back', 'cur'),
('curr_currency_types', 1, 'Валюты1', 'back', 'cur'),
('curr_iso3', 1, 'Код валюты ISO 3', 'back', 'cur'),
('msg_customers_exported_to_file', 1, 'Пользователи успешно экспортированы в файл', 'back', 'cmr'),
('regform_address_configurator', 1, 'Настройка формы ввода адреса', 'back', 'cmr'),
('regform_address_configurator_country_hint', 1, 'В случае, если список стран не пуст (Настройки -> Страны), "Страна" - обязательное поле в форме ввода адреса.<br>Если же список стран пуст, то в форме ввода адреса это поле будет отсутствовать.', 'back', 'cmr'),
('regform_customfields_configurator', 1, 'Произвольные поля в форме регистрации', 'back', 'cmr'),
('regform_not_requested', 1, 'Не запрашивается', 'back', 'cmr'),
('regform_optional_field', 1, 'Необязательно для заполнения', 'back', 'cmr'),
('usr_account_confirm_activate', 1, 'Активировать учетную запись пользователя [email]?', 'back', 'cmr'),
('usr_custinfo_custom_field_name', 1, 'Название поля', 'back', 'cmr'),
('usr_custinfo_custom_field_required', 1, 'Обязательно для заполнения', 'back', 'cmr'),
('usr_custinfo_fields_descr', 1, 'В этом разделе вы можете определить, какую информацию должен вводить пользователь в форме регистрации (например, номер телефона/факса, ИНН, ближайшее метро и пр.), а также определить, какие поля являются обязательными для заполнения, а какие - нет.', 'back', 'cmr'),
('usr_custinfo_group_discount', 1, 'Скидка, %', 'general', 'cmr'),
('usr_custinfo_regtime', 1, 'Время регистрации', 'back', 'cmr'),
('usr_customer_search_back_to_form', 1, 'вернуться к форме поиска покупателей', 'back', 'cmr'),
('usr_customer_search_descr', 1, 'Пожалуйста, введите критерии поиска покупателя.<br> Для того, чтобы просмотреть всех покупателей, оставьте все поля пустыми (незаполненные поля не учитываются).', 'back', 'cmr'),
('usr_export_userlist_to_csv', 1, 'Экспортировать этих пользователей в CSV-файл (MS Excel, OpenOffice)', 'back', 'gen'),
('dscnt_disabled', 1, 'Скидки отключены', 'back', 'dsc'),
('dscnt_method_cust_group', 1, 'Скидка группы пользователя', 'back', 'dsc'),
('dscnt_method_cust_group_plus_order_amount', 1, 'Скидка вычисляется как сумма скидки группы пользователя и скидки от суммы заказа', 'back', 'dsc'),
('dscnt_method_max_of_cust_group_and_order_amount', 1, 'Скидка вычисляется как максимальная из скидки группы пользователя и скидки от суммы заказа', 'back', 'dsc'),
('dscnt_method_order_amount', 1, 'Скидка вычисляется исходя из общей стоимости заказа пользователя (критерий задается ниже)', 'back', 'dsc'),
('dscnt_method_order_amount_criteria', 1, 'Расчет скидки исходя из общей стоимости заказа пользователя:', 'back', 'dsc'),
('dscnt_method_order_amount_criteria_descr', 1, 'В следующей таблице вы можете задать критерий расчета скидки на заказ в зависимости от общей стоимости заказа. Укажите в левой колонке какая скидка будет действовать, если стоимость заказа привысит значение, указанное в правом столбце.', 'back', 'dsc'),
('err_dc_code_exists', 1, 'Сертификат с таким кодом уже существует', 'back', 'dsc'),
('dscnt_order_amount', 1, 'Сумма заказа (в основной валюте)', 'back', 'dsc'),
('dscnt_order_amount_percent_value', 1, 'Действующая скидка, если стоимость заказа выше указанной левее суммы, %', 'back', 'gen'),
('dscnt_select_calculation_method', 1, 'Выберите метод, по которому будут рассчитываться скидки при оформлении заказов:', 'back', 'dsc'),
('err_couldnt_delete_order_status', 1, 'Невозможно удалить статус, так как существуют заказы, находящиеся в этом статусе', 'back', 'err'),
('err_new_and_complete_statuses_match', 1, 'Статус нового заказа не может совпадать со статусом завершенного заказа', 'back', 'err'),
('err_percent_is_out_of_0_100', 1, 'Укажите значение в процентах от 0 до 100', 'back', 'err'),
('err_should_have_atleast_2statuses', 1, 'Необходимо добавить хотя бы два статуса заказов, соответствующих новому и выполненному заказам', 'back', 'err'),
('btn_addcategory', 1, 'Добавить категорию', 'back', 'gen'),
('btn_addproduct', 1, 'Добавить продукт', 'back', 'gen'),
('cfg_config_no_options', 1, 'Нет настроек', 'back', 'gen'),
('cfg_config_option', 1, 'Настройка', 'back', 'gen'),
('cfg_country_undefined', 1, 'Страна не определена', 'back', 'gen'),
('cfg_ordr_status_undefined', 1, 'Статус не определён', 'back', 'gen'),
('msg_days', 1, 'дней', 'general', 'gen'),
('msg_safemode_info_blocked', 1, 'Заблокировано к показу в защищенном режиме', 'back', 'gen'),
('msg_safemode_warning', 1, 'Включен безопасный режим. Действие не выполнено.', 'back', 'gen'),
('msg_select_country_to_see_regions', 1, 'Для добавления областей нужно добавить хотя бы одну страну', 'back', 'gen'),
('msg_update_successful', 1, 'Обновление прошло успешно', 'back', 'gen'),
('pgn_categories_products', 1, 'Категории и продукты', 'back', 'gen'),
('pgn_customer_groups', 1, 'Группы пользователей', 'back', 'gen'),
('pgn_customer_groups_descr', 1, 'В этом разделе вы можете определить группы пользователей вашего магазина и установить скидки индивидуально для каждой группы.<br>Обратите внимание на то, что скидки будут рассчитываться для пользователей, когда вы установите соответствующую опцию в разделе "Скидки".', 'back', 'gen'),
('pgn_customer_search', 1, 'Поиск покупателей', 'back', 'gen'),
('pgn_customers_and_orders', 1, 'Заказы и покупатели', 'back', 'gen'),
('pgn_email_subscribers', 1, 'Подписчики на новости', 'back', 'gen'),
('pgn_export_to_google_base', 1, 'Google Base', 'back', 'gen'),
('pgn_infopages', 1, 'Информационные страницы', 'back', 'gen'),
('pgn_link_exchange', 1, 'Обмен ссылками', 'back', 'gen'),
('pgn_new_orders', 1, 'Справочник заказов', 'back', 'gen'),
('pgn_prdexport_csv', 1, 'Экспорт продуктов в CSV (Excel, 1C)', 'back', 'gen'),
('pgn_prdimport_csv', 1, 'Импорт продуктов из CSV (Excel, 1C)', 'back', 'gen'),
('pgn_product_options', 1, 'Дополнительные характеристики продуктов', 'back', 'gen'),
('pgn_product_reports', 1, 'Отчёт по продуктам', 'back', 'gen'),
('pgn_sms', 1, 'SMS-уведомления', 'back', 'gen'),
('pgn_special_offers', 1, 'Спец-предложения', 'back', 'gen'),
('pgn_synchronize_tools', 1, 'Синхронизация баз данных', 'back', 'gen'),
('pgn_taxes_define_rates', 1, 'Определить ставки для класса налогов', 'back', 'gen'),
('pgn_voting', 1, 'Голосование', 'back', 'gen'),
('prdspecial_add_special_offer', 1, 'Добавить в список спец-предложений', 'back', 'prd'),
('str_addition', 1, 'ДОПОЛНИТЕЛЬНО?', 'back', 'gen'),
('str_admin_gotofrontend', 1, 'Открыть витрину магазина', 'back', 'gen'),
('str_admin_title', 1, 'Администрирование', 'back', 'gen'),
('str_admin_welcome', 1, '<p><font class=big>Добро пожаловать в режим администрирования!</font><p>Используйте меню для доступа к разделам администраторской части.', 'back', 'gen'),
('str_file_is_not_uploaded', 1, 'Файл не загружен', 'back', 'gen'),
('str_file_is_uploaded', 1, 'Файл загружен', 'back', 'gen'),
('str_group', 1, 'Группа', 'back', 'gen'),
('str_image_not_uploaded', 1, 'Изображение не загружено', 'back', 'gen'),
('str_regions_notdefined', 1, 'Не определено ни одной области для этой страны', 'back', 'gen'),
('str_return_to_messages', 1, 'к списку всех сообщений', 'back', 'gen'),
('str_sort_order', 1, 'Сортировка', 'back', 'gen'),
('dbsync_sync_desc', 1, 'В этом разделе вы можете синхронизировать содержимое баз данных между\r\nнесколькими магазинами.<br>\r\nК примеру, экспортировать базу продуктов и категорий из одного магазина, и заменить ей базу другого магазина.', 'back', 'ine'),
('dbsync_sync_header', 1, 'Импортировать базу из SQL-файла<br>(используйте файлы, созданные Shop-Script)<br>\r\n	<b>Все текущее содержимое базы данных продуктов и категорий будет удалено!</b>', 'back', 'ine'),
('gglbase_btn_create_feed', 1, 'Создать файл для Google Base', 'back', 'ine'),
('gglbase_description_hint1', 1, 'Пожалуйста, укажите, какое описание должно экспортироваться в файл для Google Base:', 'back', 'ine'),
('gglbase_description_hint2', 1, 'ВАЖНО: Описания продуктов не должны содержать HTML-тэгов. В противном случае файл не будет принят системой Google Base.', 'back', 'ine'),
('gglbase_err_cant_create_file', 1, 'Ошибка при создании файла для Google Base (temp/froogle.txt)', 'back', 'ine'),
('gglbase_err_select_currency', 1, 'Не указан тип валюты', 'back', 'ine'),
('gglbase_msg_exported_products', 1, 'Продукты были успешно экспортированы в файл для Google Base', 'back', 'ine'),
('gglbase_pricing_description', 1, 'Цены на продукты, которые экспортируются в файл для Google Base, указываются в долларах США (USD).<br>Выберите валюту доллары США в следующем списке (необходимо для правильного экспорта цен на продукты).', 'back', 'ine'),
('gglbase_usd_currency_type', 1, 'Доллары США', 'back', 'ine'),
('prdexport_btn_export_db_to_sql_file', 1, 'Экспортировать базу в SQL-файл', 'back', 'ine'),
('prdexport_csv_btn_export', 1, 'Экспортировать продукты', 'back', 'ine'),
('prdexport_csv_descr', 1, 'В этом разделе вы можете <strong>экспортировать продукты магазина в файл CSV</strong> (Comma Separated Values; файл с разделителями-запятыми).<br>Экспортированный файл может быть загружен для редактирования в Microsoft Excel или <a href="http://ru.openoffice.org/" target="_blank">OpenOffice</a>, а также импортирован в ваш интернет-магазин в разделе "Импорт".<p>Пожалуйста, выберите разделитель в CSV файле, категории, которые вы хотели бы экспортировать, и нажмите кнопку "Экспортировать продукты".<br />\r\nИнструменты экспорта и импорта продуктов удобно использовать, например, для создания резервной копии всех продуктов магазина, или же, для быстрого редактирования продуктов в одной таблице с помощью Microsoft Excel или OpenOffice.', 'back', 'ine'),
('prdexport_csv_msg_successful', 1, 'Выбранные категории и продукты были экспортированы в CSV файл:', 'back', 'ine'),
('prdexport_msg_db_exported_to', 1, 'База успешно экспортирована в файл', 'back', 'ine'),
('prdimport_csv_add_column_as_new_option', 1, ' - добавить эти данные как дополнительную характеристику продукта -', 'back', 'ine'),
('prdimport_csv_browse_for_file', 1, 'Выберите CSV файл, из которого вы хотели бы загрузить данные', 'back', 'ine'),
('prdimport_csv_clear_db', 1, 'Удалить все продукты, категории и настройки продуктов', 'back', 'ine'),
('prdimport_csv_clear_db_desc', 1, 'Полностью очистить базу данных категорий и продуктов (в этом случае можно не указывать путь к файлу CSV).', 'back', 'ine'),
('prdimport_csv_delimeter_semicolon', 1, 'Точка с запятой', 'back', 'ine');
INSERT INTO `SC_local` (`id`, `lang_id`, `value`, `group`, `subgroup`) VALUES
('prdimport_csv_desc1', 1, 'В этом разделе вы можете <strong>импортировать продукты в ваш магазин из файла CSV</strong> (Comma Separated Values; файл с разделителями-запятыми). CSV файлы вы можете создать и редактировать с помощью Microsoft Excel или <a href="http://ru.openoffice.org/" target="_blank">OpenOffice</a>.<br /><br />Например, если вы хотите импортировать продукты в интернет-магазин из вашего прайс-листа в Excel, нужно сохранить прайс-лист в формате CSV (пункт в меню "Сохранить как..." - затем выберите CSV в выборе формата файла).<br />Далее, выберите сохраненный файл в следующей форме, и укажите кодировку файла (наиболее вероятно, это будет кодировка cp1251).<br /><strong>ВАЖНО: Система может производить загрузку данных только из CSV файлов только с определенной организацией (структурой) строк и столбцов.</strong> Это значит, что вам необходимо привести ваш прайс-лист к такой структуре для того, чтобы загрузить файл.<br />Посмотрите <a href="http://www.webasyst.ru/support/shop/manual.html#import-kataloga-tovarov-iz-csv" target="_blank">подробное описание структуры файла</a>.<br /><br />Также в этом разделе вы можете импортировать продукты из <strong>файла со списком номенклатуры, экспортированного из 1С: Предприятие</strong>.<br />Различие только в разделителе файла: в файле Excel - это точка с запятой (по умолчанию), а в списке номенклатуры 1С - табуляция.<br />Файл со списком номенклатуры можно получить в программе 1С: Предприятие в разделе "Список номенклатуры". Файл должен быть сохранен в формате "Текстовый файл (с разделителями-табуляциями)".', 'back', 'gen'),
('prdimport_csv_desc2', 1, 'В закачанном файле обнаружены следующие колонки.<br>Соотнесите каждую из этих колонок с полем в базе данных.<br>В левой колонке указаны названия столбцов.', 'back', 'ine'),
('prdimport_csv_desc3', 1, 'Если продукт есть и в базе, и в файле (ищется совпадение по колонке идентификации), то обновить информацию о нем.<br>Если же продукт найден только в файле, то добавить его в базу данных.<br>Иначе (если продукт есть только в базе данных) оставить его без изменений.', 'back', 'ine'),
('prdimport_csv_ignorecolumn', 1, ' - пропустить этот столбец -', 'back', 'ine'),
('prdimport_csv_update_db', 1, 'Обновить (добавить новые продукты и обновить информацию о существующих)', 'back', 'ine'),
('prdimport_csvl_delimeter', 1, 'Разделитель в импортируемом CSV файле:<br>(задается в настройках Windows;<br>по умолчанию - точка с запятой).<br>В случае списка номенклатуры 1С<br>выберите разделитель "Табуляция".', 'back', 'ine'),
('prdimport_csvl_delimeter_comma', 1, 'Запятая', 'back', 'ine'),
('prdimport_csvl_delimeter_tab', 1, 'Табуляция', 'back', 'ine'),
('prdimport_primary_column', 1, 'Колонка идентификации: ', 'back', 'ine'),
('prdimport_primary_column_desc', 1, '(укажите колонку, значение в которой однозначно идентифицирует продукт)<br><b>Будьте внимательны при ее выборе - неверный выбор может привести к непредсказуемым последствиям!</b>', 'back', 'ine'),
('prdimport_update_gc_value_button', 1, 'Обновить значение количества продуктов для категорий', 'back', 'ine'),
('infpg_addnewpage', 1, 'Добавить страницу', 'back', 'inf'),
('infpg_page_ref', 1, 'HTML-код ссылки, который необходимо поместить в шаблон магазина', 'back', 'inf'),
('infpg_page_text', 1, 'Текст', 'back', 'inf'),
('infpg_page_text_type', 1, 'Тип страницы', 'back', 'inf'),
('infpg_pagename', 1, 'Имя страницы', 'back', 'inf'),
('infpg_pages_description', 1, 'Ниже представлены все информационные страницы вашего интернет-магазина (страницы со статическим содержимым), например, "О магазине", "Доставка", "Оплата" и т.п.<br />\r\nЕсли вы добавите новую страницу, она автоматически появится в пользовательской части вашего интернет-магазина (в случае, если вы не удалили компоненту, которая отображает список всех информационных страниц).<br />\r\nДля изменения порядка сортировки страниц просто перетаскивайте их с помощью мышки.', 'back', 'inf'),
('le_all_categories', 1, 'Все разделы', 'general', 'lke'),
('le_btn_add_new_category', 1, 'Добавить новый раздел', 'back', 'lke'),
('le_btn_approve', 1, 'Отметить как &quot;проверено&quot;', 'back', 'lke'),
('le_btn_decline', 1, 'Отметить как &quot;не проверено&quot;', 'back', 'lke'),
('le_err_link_category_exists', 1, 'Такая категория уже существует!', 'back', 'lke'),
('le_link_not_verified', 1, 'не проверена', 'back', 'lke'),
('le_link_text', 1, 'Текст', 'general', 'lke'),
('le_link_url', 1, 'URL', 'general', 'lke'),
('le_link_verified', 1, 'Дата проверки', 'back', 'lke'),
('le_with_selected', 1, 'С отмеченными:', 'back', 'lke'),
('mdl_actions', 1, 'Действия', 'back', 'mdl'),
('mdl_configure', 1, 'Настроить модуль', 'back', 'mdl'),
('mdl_install', 1, 'Установить модуль', 'back', 'mdl'),
('mdl_installed', 1, 'Установлен', 'back', 'mdl'),
('mdl_name', 1, 'Модуль', 'back', 'mdl'),
('mdl_not_installed', 1, 'Не установлен', 'back', 'mdl'),
('mdl_payment_module_setup', 1, 'Настройка модуля оплаты', 'back', 'mdl'),
('mdl_payment_modules_description', 1, 'Для того, чтобы включить расчет стоимости доставки в реальном времени через какую-либо компанию, предлагающую такие услуги (например, UPS, USPS), вам необходимо зарегистрироваться на сайте этой компании (получить более подробную информацию о регистрации вы можете на веб-сайте этой компании).<br>После того, как вы зарегистрировались, установите модуль для работы с этой компанией (см. ниже) и введите данные о вашей учетной записи в настройках модуля.<br>Далее, перейдите в раздел администрирования "Настройки" -> "Доставка" и подключите установленный модуль к какому-либо способу доставки.', 'back', 'mdl'),
('mdl_payment_types_using_this_module', 1, 'способы оплаты,<br> использующие этот модуль', 'back', 'mdl'),
('mdl_shipping_methods_are_allowed', 1, 'Тип оплаты допустим для следующих способов доставки', 'back', 'mdl'),
('mdl_shipping_module_setup', 1, 'Настройка модуля доставки', 'back', 'mdl'),
('mdl_shipping_types_using_this_module', 1, 'способы доставки,<br> использующие этот модуль', 'back', 'mdl'),
('msg_installed_modules', 1, 'Установленные модули (редактирование конфигураций)', 'back', 'mdl'),
('msg_no_installed_modules', 1, 'Нет ни одного установленного модуля', 'back', 'mdl'),
('ordr_ccinfo_shown_only_in_https', 1, 'Эта информация доступна только при защищенном соединении (SSL). Для доступа к этой информации выйдите из аккаунта, и войдите вновь, используя безопасное SSL соединение (нужно включить соответствующую галочку).', 'back', 'ord'),
('ordr_change_status', 1, 'Произвольный статус...', 'back', 'ord'),
('ordr_custinfo', 1, 'Информация о пользователе', 'back', 'ord'),
('ordr_msg_about_prices', 1, 'Цены указаны на момент оформления заказа.', 'back', 'ord'),
('ordr_order_statuses', 1, 'Статусы заказов', 'back', 'ord'),
('ordr_send_buyer_message', 1, 'Уведомить покупателя об этом изменении по email', 'back', 'ord'),
('pmnt_calctax_for_this_payment_type', 1, 'Раcсчитывать налог для этого способа оплаты', 'back', 'gen'),
('pmnt_email_comments_text', 1, 'Инструкции по оплате и прочие комментарии (отправляется покупателю в email-уведомлении о заказе)', 'back', 'ord'),
('shp_email_comments_text', 1, 'Комментарии о доставке (отправляется покупателю в email-уведомлении о заказе)', 'back', 'ord'),
('prd_msg_could_not_delete', 1, 'Невозможно удалить этот продукт', 'back', 'prd'),
('prd_msg_could_not_delete_these_products', 1, 'Невозможно удалить эти продукты', 'back', 'prd'),
('prd_msg_root_warning', 1, '<font color=red>Все продукты, находящиеся в корне, не видны пользователям!</font>', 'back', 'prd'),
('prd_product_visible_in_storefront', 1, 'Показывается в пользовательской части', 'back', 'prd'),
('prd_productlist', 1, 'Продукты', 'back', 'prd'),
('prdcat_advsearch_customoption_availablevalues', 1, 'Возможные варианты выбора', 'back', 'prd'),
('prdcat_advsearch_in_this_category_allow', 1, 'Разрешить подборку продуктов при просмотре категории', 'back', 'prd'),
('prdcat_advsearch_in_this_category_allow_descr', 1, 'включите этот параметр, если Вы хотите предоставить пользователю возможность подбора продуктов в этой категории не только при расширенном поиске, но и при обычном просмотре этой категории', 'back', 'prd'),
('prdcat_advsearch_prdcustopt_input', 1, 'Задается произвольно', 'back', 'prd'),
('prdcat_advsearch_prdcustopt_select_descr', 1, 'Пожалуйста, выберите параметры, по которым возможен расширенный поиск продуктов в данной категории', 'back', 'prd'),
('prdcat_advsearch_prdcustopt_selectable', 1, 'Выбор из значений', 'back', 'prd'),
('prdcat_allow_products_comparison', 1, 'Предоставлять ли возможность пользователю сравнивать продукты в этой категории или нет', 'back', 'prd'),
('prdcat_category_descr', 1, 'Описание категории', 'back', 'prd'),
('prdcat_category_logo', 1, 'Логотип категории', 'back', 'prd'),
('prdcat_category_move_to', 1, 'Переместить в...', 'back', 'prd'),
('prdcat_category_name', 1, 'Название категории', 'back', 'prd'),
('prdcat_category_new', 1, 'Создать новую категорию', 'back', 'prd'),
('prdcat_category_parent', 1, 'Родительская категория', 'back', 'prd'),
('prdcat_category_root', 1, 'Корень', 'back', 'prd'),
('prdcat_category_title', 1, 'Категории', 'back', 'prd'),
('prdcat_show_products_from_subcategories', 1, 'Показывать пользователю продукты из подкатегорий при просмотре этой категории', 'back', 'prd'),
('prdcustopt_availablevalues', 1, 'Возможные варианты значений для характеристики "%OPTION_NAME%"', 'back', 'prd'),
('prdcustopt_option_has_no_values', 1, 'У этой характеристики нет предустановленных вариантов значений', 'back', 'prd'),
('prdcustopt_optionname', 1, 'Характеристика', 'back', 'prd'),
('prdcustopt_value', 1, 'Значение', 'back', 'prd'),
('prdcustopt_value_add', 1, 'Добавить вариант значения этой характеристики', 'back', 'prd'),
('prdcustopt_value_variants', 1, 'Возможные значения', 'back', 'prd'),
('prdopt_add_new_option', 1, 'Добавить характеристику', 'back', 'prd'),
('prdopt_custom_option_title', 1, 'Название характеристики', 'back', 'prd'),
('prdopt_no_product_options', 1, 'Не определено ни одной дополнительной характеристи продуктов', 'back', 'prd'),
('prdreview_postaddtime', 1, 'Время публикации отзыва', 'back', 'prd'),
('prdreview_reply', 1, 'Ответить', 'back', 'prd'),
('prdset_addproduct', 1, 'Добавить продукт', 'back', 'prd'),
('prdset_choose_selectable_option_values', 1, 'Выбрать варианты выбора', 'back', 'prd'),
('prdset_configurator_title', 1, 'Варианты выбора для ', 'back', 'prd'),
('prdset_custom_value', 1, 'Произвольное значение (текст)', 'back', 'prd'),
('prdset_customoption_configurator', 1, 'Настроить дополнительные характеристики', 'back', 'prd'),
('prdset_date_added', 1, 'Дата добавления', 'back', 'prd'),
('prdset_date_modified', 1, 'Дата изменения', 'back', 'prd'),
('prdset_download_is_available_for', 1, 'Файл доступен ', 'general', 'prd'),
('prdset_download_is_available_for_2', 1, 'Количество дней для скачивания', 'back', 'prd'),
('prdset_download_max_number_allowed', 1, 'Количество загрузок (раз)', 'back', 'prd'),
('prdset_eproduct_filename', 1, 'Файл электронного продукта', 'back', 'prd'),
('prdset_free_shipping', 1, 'Бесплатная доставка', 'back', 'prd'),
('prdset_free_shipping_2', 1, 'Бесплатная доставка', 'back', 'prd'),
('prdset_image_preview', 1, 'Просмотр', 'back', 'prd'),
('prdset_meta_description', 1, 'Тэг META description', 'back', 'prd'),
('prdset_meta_keywords', 1, 'Тэг META keywords', 'back', 'prd'),
('prdset_min_qunatity_to_order', 1, 'Ограничение на минимальный заказ продукта (штук)', 'back', 'prd'),
('prdset_option_value_variants', 1, 'возможных вариантов', 'back', 'prd'),
('prdset_optvalue_price_surplus', 1, 'Наценка к стоимости продукта, если выбрана эта опция', 'back', 'prd'),
('prdset_product_bigpicture', 1, 'Большая фотография', 'back', 'prd'),
('prdset_product_code', 1, 'Артикул', 'general', 'gen'),
('prdset_product_extra_categories', 1, 'Дополнительные родительские категории', 'back', 'prd'),
('prdset_product_filename', 1, 'Файл продукта', 'back', 'prd'),
('prdset_product_is_downloadable', 1, 'Продукт является программой', 'back', 'prd'),
('prdset_product_listprice', 1, 'Старая цена', 'back', 'prd'),
('prdset_product_picture', 1, 'Фотография', 'back', 'prd'),
('prdset_product_pictures', 1, 'Фотографии продуктов', 'back', 'prd'),
('prdset_product_rating', 1, 'Рейтинг', 'back', 'prd'),
('prdset_product_sold', 1, 'Продано', 'back', 'prd'),
('prdset_product_thumbnail', 1, 'Маленькая фотография', 'back', 'prd'),
('prdset_product_votes', 1, 'Голосов', 'back', 'prd'),
('prdset_productpicture_default', 1, 'Изображение по умолчанию', 'back', 'prd'),
('prdset_prompt_option_value_str', 1, 'Предложить выбрать значение этой опции', 'back', 'prd'),
('prdset_prompt_option_value_times', 1, 'раз(а) для этого продукта', 'back', 'prd'),
('prdset_related_products_select', 1, 'Пожалуйста, выберите продукт', 'back', 'prd'),
('prdset_save_photos', 1, 'Сохранить фотографии', 'back', 'prd'),
('prdset_selectable_from_values', 1, 'Выбор из предустановленных значений ', 'back', 'prd'),
('prdset_selected_products', 1, 'Выбранные продукты', 'back', 'prd'),
('prdspecial_no_special_offers', 1, 'Спец-предложения не выбраны', 'back', 'prd'),
('prdspecial_special_offers_desc', 1, 'Спец-предложения показываются на витрине Вашего магазина.<br>\r\nВыбрать товарные позиции, которые будут показаны как спец-предложения<br>\r\nВы можете в подразделе <a href="admin.php?dpt=catalog&sub=products_categories">"Категории и товары"</a>, кликнув по значку <img src="images/special_offer.gif" border=0> в таблице товаров.<br>\r\nВ спец-предложения можно выбрать только товары с фотографией.', 'back', 'prd'),
('rep_best_viewed_categories', 1, 'Самые просматриваемые категории?', 'back', ''),
('rep_views_count', 1, 'Количество просмотров', 'back', ''),
('sms_current_time', 1, '(сейчас &mdash; %s)', 'back', 'sms'),
('sms_disable_module', 1, 'Отключить SMS-уведомления', 'back', 'sms'),
('sms_enable_notifications', 1, 'Включить SMS-уведомления', 'back', 'sms'),
('sms_gateway_module_config', 1, 'Настройки модуля SMS-уведомлений', 'back', 'sms'),
('sms_gateway_modules', 1, 'Модули SMS-уведомлений', 'back', 'sms'),
('sms_mail_choose_sms_sending_module', 1, '<b>Выберите модуль для отправки SMS-уведомлений о заказах:</b>', 'back', 'sms'),
('sms_message_new_order', 1, 'Поступил новый заказ!', 'general', 'sms'),
('sms_modules_description', 1, 'Для того, чтобы включить отправку SMS-уведомлений, вам необходимо зарегистрироваться в какой-либо системе работы с SMS-сообщениями (получить более подробную информацию о регистрации вы можете на веб-сайте каждой из систем).<br>После того, как вы зарегистрировались, установите модуль для работы с этой системой (см. ниже) и введите данные о вашей учетной записи в настройках модуля.<br>Далее, включите галочку "Включить отправку SMS-уведомлений", выберите модуль для отправки SMS и укажите номер(а), на который(ые) необходимо доставлять SMS-уведомления о заказах.', 'back', 'sms'),
('sms_new_phone_number', 1, 'Новый телефонный номер', 'back', 'sms'),
('sms_notify_error_period', 1, 'Неверный формат времени. Пожалуйста, вводите время в формате HH:MM', 'back', 'sms'),
('sms_phone_list_descr', 1, '<b>Список телефонов, на которые будут отправляться уведомления о заказах</b>\r\n	<div class="small">Телефон должен быть указан в международном формате (например: 79161112233): <table border="0">\r\n	<tr class="gridheader">\r\n		<td>Код страны</td>\r\n		<td>Код оператора</td>\r\n		<td>Номер телефона</td>\r\n	</tr>\r\n	<tr class="gridline">\r\n		<td align=center><b>7</b></td>\r\n		<td align=center><b>916</b></td>\r\n		<td align=center><b>1112233</b></td>\r\n	</tr>\r\n	</table>\r\n	Для <b>добавления</b> телефона введите в поле "новый телефон" номер и нажмите кнопку "Сохранить".<br />Если вы хотите <b>удалить</b> номер из списка, оставьте соответствующее ему поле ввода пустым и нажмите кнопку "Сохранить".</div>', 'back', 'sms'),
('sms_sending_allowed_timeframe', 1, '<b>Разрешенное время для отправки сообщений (по времени сервера)</b><div class="small">Во временной промежуток вне этого интервала сообщения отправляться не будут</div>', 'back', 'sms'),
('sbscrbrs_description', 1, 'Здесь вы можете просматривать и удалять подписчиков на новости (блог) вашего интернет-магазина, импортировать новые записи в список и экспортировать их в файл (текстовый файл, в котором каждый электронный адрес указан на отдельной строке).', 'back', 'sbr'),
('sbscrbrs_err_creating_file', 1, 'Ошибка при создании файла', 'back', 'sbr'),
('sbscrbrs_err_empty_file', 1, 'Не найдено ни одной записи в загруженном файле', 'back', 'sbr'),
('sbscrbrs_err_uploading_file', 1, 'Ошибка при загрузке файла на сервер', 'back', 'sbr'),
('sbscrbrs_export_to_file', 1, 'Экспорт списка подписчиков в текстовый файл', 'back', 'sbr'),
('sbscrbrs_import_from_file', 1, 'Импорт подписчиков из текстового файла', 'back', 'sbr'),
('sbscrbrs_msg_deleted_all_records', 1, '{*EMAILS_NUMBER*} записей успешно удалены', 'back', 'sbr'),
('sbscrbrs_msg_email_deleted', 1, 'Адрес {*EMAIL*} был успешно удален из списка', 'back', 'sbr'),
('sbscrbrs_msg_export_successful', 1, 'Список был успешно экспортирован в файл<br /><a href="{*URL*}">Скачать файл</a>', 'back', 'sbr'),
('sbscrbrs_msg_import_successful', 1, '{*EMAILS_NUMBER*} записи(ей) были успешно добавлены из файла.', 'back', 'sbr'),
('survey_answeroptions', 1, 'Варианты ответов (каждый вариант на отдельной строке):', 'back', 'srv'),
('survey_btn_new_survey', 1, 'Начать новое голосование', 'back', 'srv'),
('survey_new_survey_warning', 1, '<strong>ВАЖНО:</strong> Результаты предыдущего голосования будут аннулированы.', 'back', 'srv'),
('survey_question', 1, 'Вопрос голосования', 'back', 'srv'),
('tax_back_to_country_list', 1, 'вернуться к определению налогов по странам', 'back', 'txs'),
('tax_back_to_tax_types', 1, 'вернуться к списку классов налогов', 'back', 'txs'),
('tax_name', 1, 'Название вида налогов', 'back', 'txs'),
('tax_rate', 1, 'Ставка', 'back', 'txs'),
('tax_rate_depends_on_region', 1, 'Ставка зависит от области (ставки определены для {N} областей из {M})', 'back', 'txs'),
('tax_sales_tax_is_based_on_address', 1, 'Адрес, на основании которого рассчитывается ставка налога', 'back', 'txs'),
('tax_set_rates_for_countries', 1, 'Пожалуйста, вводите ставки класса налогов для стран из списка', 'back', 'txs'),
('tax_set_rates_for_regions', 1, 'Пожалуйста, вводите ставки класса налогов для областей из списка', 'back', 'txs'),
('tax_set_rates_for_zip', 1, 'Ставки класса налогов в зависимости от почтовых индексов', 'back', 'txs'),
('tax_set_rates_for_zip_descr', 1, 'Если ставка налога может изменяться внутри какой-то области в зависимости от округа, вы можете указать зависимость ставки от почтового индекса. В следующей таблице вводите шаблоны почтовых индексов в виде комбинации символов индекса (цифр и букв) и "звездочки" *, которая обозначает произвольный символ. К примеру, шаблон 12*** будет обозначать все почтовые индексы, начинающиеся с двух символов 12, и состоящие из 5 символов - например, 12365, 12963, 12AB7 (символами в индексе могут быть как цифры, так и буквы). Среди всех шаблонов, которые описывают индекс, введенный покупателем, будет выбран наиболее подходящий. Например, если в таблице определены шаблоны 92*** и 923**, а покупатель ввел индекс 92301, то для заказа будет взята ставка для записи 923**, а запись 92*** учтена не будет.', 'back', 'txs'),
('tax_set_rates_for_zip_descr2', 1, 'Ставки, определенные в этой таблице, имеют больший приоритет, чем ставки по областям. Если покупатель при оформлении заказа введет почтовый индекс, ставка для которого определена, расчет налога будет производиться по почтовому индексу, а не по области.', 'back', 'txs'),
('tax_single_overall_rate', 1, 'Общая ставка', 'back', 'txs'),
('tax_type', 1, 'Вид налога', 'back', 'txs'),
('tax_types', 1, 'Виды налогов', 'back', 'txs'),
('checkout_another_address', 1, 'Другой адрес', 'front', 'chk'),
('checkout_comment', 1, 'Комментарии к заказу (заполняется по желанию)', 'front', 'chk'),
('checkout_continue_tip', 1, 'Для оформления заказа Вам необходимо зарегистрироваться.', 'front', 'chk'),
('checkout_enter_address', 1, 'Укажите ваш адрес для продолжения оформления заказа', 'front', 'chk'),
('checkout_i_am_new_customer', 1, 'Я новый пользователь', 'front', 'chk'),
('checkout_msg_thank_you_for_ordering', 1, 'В ближайшее время мы свяжемся с вами.', 'front', 'chk'),
('checkout_success_title', 1, 'Спасибо за Ваш заказ!', 'front', 'chk'),
('checkout_no_address_specified', 1, '< адрес не указан >', 'front', 'chk'),
('checkout_no_payment_methods', 1, 'Нет доступных способов для оплаты', 'front', 'chk'),
('checkout_no_shipping_methods', 1, 'Нет доступных способов доставки', 'front', 'chk'),
('checkout_order_ship_to', 1, 'Заказ будет доставлен по адресу', 'front', 'chk'),
('checkout_place_order', 1, 'Оформить заказ', 'front', 'chk'),
('checkout_select_payment_type', 1, 'Выберите способ оплаты', 'front', 'chk'),
('checkout_select_shipping_type', 1, 'Выберите способ доставки заказа', 'front', 'chk'),
('checkout_shipping', 1, 'Доставка', 'front', 'chk'),
('checkout_transaction_result_failure', 1, 'Пожалуйста, повторите попытку позже или свяжитесь с нами для разрешения проблемы. В своем сообщении укажите номер заказа.', 'front', 'chk'),
('checkout_transaction_result_success', 1, 'Спасибо! Ваш платеж принят.', 'front', 'chk'),
('checkout_with_no_registration', 1, 'Быстрое оформление', 'front', 'chk'),
('str_checkout', 1, 'Оформить заказ', 'front', 'chk'),
('affp_attract_guide', 1, '<p><B>Заработать с помощью нашей партнерской программы очень просто!</B><br>Вы получаете вознаграждение за каждый заказ привлеченного Вами пользователя - {aff_percent}% от суммы каждого заказа.<p>Вы можете привлекать покупателей двумя способами:<ol><li>Пользователь считается привлеченным вами, если при регистрации он указывает ваш логин в поле "Кто направил" - <B>{login}</B>.<br><br></li><li>Добавьте на ваш веб-сайт следующую ссылку:<br><br><B>{URL}</B><br><br>Если кто-либо из посетителей, пришедших с вашего веб-сайта, сделает заказ, вы автоматически получите вознаграждение.<br>В этом случае посетителю не нужно будет вводить ваш логин - система сама определит, что он пришел по вашей ссылке.</li></ol>', 'front', 'cmr'),
('usr_account_input_activation_key', 1, 'Для продолжения оформления заказа введите ключ активации, отправленный Вам по электронной почте. Данная мера необходима для проверки введенного Вами электронного адреса', 'front', 'cmr'),
('usr_account_update_successful', 1, 'Данные успешно изменены.<br />Спасибо!', 'front', 'cmr'),
('usr_addresses_added', 1, 'Следующие адреса успешно добавлены в адресную книгу', 'front', 'cmr'),
('usr_cant_find_user_in_db', 1, 'Пользователь с такими данными не зарегистрирован', 'front', 'cmr'),
('usr_custinfo_referrer', 1, 'Кто направил (логин пользователя)<br /><i>оставьте это поле пустым, если сомневаетесь</i>', 'front', 'cmr'),
('usr_forgot_password_descr', 1, 'Введите <strong>логин</strong> или <strong>адрес электронной почты</strong>:', 'front', 'cmr'),
('usr_msg_registration_successful', 1, 'Регистрация прошла успешно.<br />Спасибо!', 'front', 'cmr'),
('usr_password_sent', 1, 'Пароль был отправлен вам по электронной почте', 'front', 'cmr'),
('usr_successful_account_termination', 1, 'Ваша регистрация была успешно отменена. Спасибо за покупки!', 'front', 'cmr'),
('usr_thank_you_for_subscription', 1, 'Спасибо за подписку!', 'front', 'cmr'),
('usrreg_authorization_fields', 1, 'ВХОД В МАГАЗИН', 'front', 'cmr'),
('usrreg_confirm_acc_activation', 1, 'Активация учетной записи', 'front', 'cmr'),
('usrreg_confirm_err_wrong_actcode', 1, 'Неверный ключ активации', 'front', 'cmr'),
('usrreg_confirm_notactivated', 1, 'Ваша учетная запись не активирована', 'front', 'cmr'),
('usrreg_confirm_subject', 1, 'Регистрация', 'front', 'cmr'),
('usrreg_confirm_success', 1, '<p>Ваша учетная запись успешно активирована.</p><p>Перейти в <a href="%ACCOUNT_URL%">раздел управления учетной записью</a>.</p>', 'front', 'cmr'),
('usrreg_confirm_type_code', 1, 'Для активации учетной записи, пожалуйста, введите ключ активации (отправлен вам по email):<br />', 'front', 'cmr'),
('usrreg_confirmation_code', 1, 'Код подтверждения', 'front', 'cmr'),
('usrreg_contact_information', 1, 'КОНТАКТНАЯ ИНФОРМАЦИЯ', 'front', 'cmr'),
('usrreg_customer_confirm_password', 1, 'Подтвердите пароль', 'front', 'cmr'),
('usrreg_required_regform_fields_descr', 1, '<font color=red>*</font> обязательны для заполнения', 'front', 'cmr'),
('usrreg_subscribe_for_blognews', 1, 'Подписаться на новости', 'general', 'cmr'),
('err_access_to_product_downloadable_file_denied', 1, 'Доступ к файлу запрещен (заказ не оплачен)', 'front', 'err'),
('err_input_all_required_fields', 1, 'Пожалуйста, заполните все обязательные поля в форме', 'front', 'err'),
('err_invalid_symbols_in_login_or_password', 1, 'В поле ввода логина и пароля не допустимы символы '', \\, ", <, >', 'front', 'err'),
('err_region_does_not_belong_to_country', 1, 'Выберите область из выпадающего списка', 'general', 'err'),
('err_wrong_ccode', 1, 'Неверно введены цифры, изображенные на рисунке', 'front', 'err'),
('err_wrong_referrer', 1, 'Неправильный логин пользователя в поле "Кто направил".<br>Если вы сомневаетесь, что указывать в этом поле, оставьте его пустым.', 'front', 'err'),
('feedback_description_general', 1, 'Вы можете отправить нам запрос по электронной почте с помощью следующей формы.', 'front', 'fdk'),
('feedback_description_general_2', 1, 'Вы можете задать нам вопрос(ы) с помощью следующей формы.', 'front', 'fdk'),
('feedback_description_productpage', 1, 'Пожалуйста, сформулируйте Ваши вопросы относительно ', 'front', 'fdk'),
('feedback_message_text', 1, 'Сообщение', 'front', 'fdk'),
('feedback_msg_sent_successfully', 1, '<B>Сообщение успешно отправлено.</B><br>Мы ответим Вам в ближайшее время. Спасибо за Ваш запрос!', 'front', 'fdk'),
('feedback_title_productpage', 1, 'Есть вопросы?', 'front', 'fdk'),
('blog_view_all_posts', 1, 'Смотреть все', 'front', 'gen'),
('btn_back_to_shopping', 1, 'Вернуться к покупкам', 'front', 'gen'),
('btn_compare_products', 1, 'Сравнить выбранные продукты', 'front', 'gen'),
('btn_post_message', 1, 'Отправить сообщение', 'front', 'gen'),
('btn_vote', 1, 'Оценить', 'front', 'gen'),
('lnk_administrativemode', 1, '>> АДМИНИСТРИРОВАНИЕ <<', 'front', 'gen'),
('lnk_change_currency', 1, 'Валюта:', 'front', 'gen'),
('lnk_forgot_password', 1, 'Забыли пароль?', 'front', 'gen'),
('lnk_logout', 1, 'Выйти из сеанса...', 'front', 'gen'),
('lnk_my_account', 1, 'Личный кабинет', 'front', 'gen'),
('lnk_myaccount', 1, 'Личный кабинет', 'front', 'gen'),
('lnk_reviewproduct', 1, 'Показать все отзывы (%REVIEWS_NUM%) или написать собственный отзыв', 'front', 'gen'),
('lnk_terminate_account', 1, 'Удалить учетную запись', 'front', 'gen'),
('msg_n_matches_found', 1, 'Найдено {N} записи(-ей)', 'general', 'gen'),
('msg_price_isnot_set', 1, 'Цена не указана', 'front', 'gen'),
('pgn_advanced_search', 1, 'Расширенный поиск', 'general', 'prd'),
('str_add_to_cart_string', 1, 'добавить в корзину', 'front', 'gen'),
('str_authorization', 1, 'Вход для пользователей', 'front', 'gen'),
('str_category', 1, 'Категория', 'front', 'gen'),
('str_choose_products', 1, 'Выберите категории и продукты', 'general', 'gen'),
('str_delivery_address', 1, 'Адрес доставки заказа', 'front', 'gen'),
('str_discount_is_not_less_than', 1, 'скидка не менее', 'front', 'gen'),
('str_enter_ccode', 1, 'Введите число, изображенное на рисунке', 'front', 'gen'),
('str_general_information', 1, 'Общая информация', 'front', 'gen'),
('str_greetings', 1, '<h1>Спасибо за ваш выбор Shop-Script PREMIUM!</h1>', 'front', 'gen'),
('str_i_am_registered_customer', 1, 'Я зарегистрированный пользователь', 'front', 'gen'),
('str_please_select', 1, 'Пожалуйста, выберите', 'general', 'gen'),
('str_posts_for_item_string', 1, 'мнений', 'front', 'gen'),
('str_register', 1, 'Регистрация', 'front', 'gen'),
('str_same_as_shipping_address', 1, 'Совпадает с адресом доставки заказа', 'front', 'gen'),
('str_search_in_subcategories', 1, 'искать в подкатегориях', 'front', 'gen'),
('str_search_products_in_this_category', 1, 'Найти продукт в этой категории', 'general', 'gen'),
('str_show_all_product_in_this_category', 1, 'показать все продукты категории', 'front', 'gen'),
('str_subject', 1, 'Тема', 'general', 'gen'),
('str_your_name', 1, 'Имя', 'general', 'gen'),
('warning_delete_install_php', 1, 'Файл <b>install.php</b> не удален из директории со скриптами. Вам необходимо удалить его вручную.<br>', 'front', 'gen'),
('warning_magic_quotes_gpc', 1, 'В настройках PHP установлено <b>magic_quotes_gpc = Off</b>. Для правильной работы скрипта необходимо включить этот параметр (On).', 'front', 'gen'),
('warning_wrong_chmod', 1, 'Недостаточные права доступа установлены для папок products_files, products_pictures, temp и templates_c (либо какая-то из этих папок не существует).<br>Необходимо установить атрибуты (chmod) на это папки для разрешения (пере)записи файлов в этих папках (как правило, это атрибуты chmod 775).', 'front', 'gen'),
('prd_download_downloads_left', 1, 'осталось', 'front', 'prd'),
('prd_download_number_of_downloads_exceeded', 1, 'Количество загрузок файла превысило допустимое', 'front', 'prd'),
('prd_download_period_expired', 1, 'Допустимое время для загрузки файлов истёк', 'front', 'prd'),
('prd_download_str_downloads', 1, 'скачиваний', 'front', 'prd'),
('prd_final_price', 1, 'Цена с учётом выбранных опций', 'front', 'prd'),
('prd_product_comparison', 1, 'Сравнение продуктов', 'front', 'prd'),
('prd_select_to_comparison', 1, 'Сравнить', 'front', 'prd'),
('prd_sort_main_control_string', 1, 'Сортировать по: наименованию ({ASC_NAME} | {DESC_NAME}), цене ({ASC_PRICE} | {DESC_PRICE}), рейтингу ({ASC_RATING} | {DESC_RATING})', 'front', 'prd'),
('prd_sort_pricelist_control_string', 1, 'Сортировать по: наименованию ({ASC_NAME} | {DESC_NAME}), цене ({ASC_PRICE} | {DESC_PRICE})', 'front', 'prd'),
('prd_str_productpictures', 1, 'Все фотографии', 'front', 'prd'),
('prddiscussion_add_message', 1, 'Написать отзыв', 'front', 'prd'),
('prddiscussion_body', 1, 'Ваш отзыв', 'general', 'prd'),
('prddiscussion_delete_post_link', 1, 'удалить это сообщение', 'front', 'prd'),
('prddiscussion_no_posts_on_item_string', 1, 'Нет отзывов об этом продукте', 'front', 'prd'),
('prddiscussion_title', 1, 'Отзывы о продукте <a href="%PRODUCT_URL%">%PRODUCT_NAME%</a>', 'general', 'prd'),
('prdset_product_is_downloadable_msg_2customer', 1, '<p><strong>Вы сможете скачать этот продукт</strong> с сайта магазина сразу после того, как закажете его и оплатите заказ', 'front', 'prd'),
('prdset_value_is_undefined', 1, '[не определено]', 'front', 'prd'),
('srch_products_within_category', 1, 'Поиск продукта в этой категории', 'front', 'prd'),
('str_enlarge_picture', 1, 'увеличить...', 'front', 'prd'),
('str_more_info_on_product', 1, 'подробнее...', 'front', 'prd'),
('str_related_items', 1, 'Рекомендуем посмотреть', 'general', 'prd'),
('str_you_save', 1, 'Вы экономите', 'front', 'prd'),
('vote_average', 1, 'Средне', 'front', 'prd'),
('vote_excellent', 1, 'Отлично', 'front', 'prd'),
('vote_for_item_title', 1, 'Оцените этот продукт', 'front', 'prd'),
('vote_good', 1, 'Хорошо', 'front', 'prd'),
('vote_numerofvotes', 1, 'Голосов', 'general', 'prd'),
('vote_poor', 1, 'Плохо', 'front', 'prd'),
('vote_puny', 1, 'Очень плохо', 'front', 'prd'),
('cart_cart_is_empty', 1, 'Ваша корзина пуста', 'front', 'crt'),
('cart_clear_cart', 1, 'Очистить корзину', 'front', 'crt'),
('cart_content_empty', 1, '(пусто)', 'front', 'crt'),
('cart_content_not_empty', 1, 'продукт(ов): ', 'front', 'crt'),
('cart_items_left_from_prev_session', 1, 'В вашей корзине обнаружены продукты, добавленные при предыдущем пользовании нашего магазина. Пожалуйста, уточните содержимое заказа перед оформлением.', 'front', 'crt'),
('cart_min_order_amount_not_reached', 1, 'Сумма заказа должна быть не менее ', 'front', 'crt'),
('cart_product_quantity', 1, 'Кол-во', 'general', 'crt'),
('cart_products_total', 1, 'Стоимость за пару', 'front', 'crt'),
('cart_reg_customers_apply_for_discounts', 1, 'Зарегистрированные пользователи магазина получают скидки при заказах. Пожалуйста, свяжитесь с менеджером для получения дополнительной информации', 'front', 'crt'),
('cart_reg_customers_apply_for_discounts_extra', 1, 'Зарегистрированные пользователи интернет-магазина могут получить дополнительные скидки. Свяжитесь с нами для получения дополнительной информации.', 'front', 'crt'),
('cart_title', 1, 'Ваша корзина', 'front', 'crt'),
('affp_commission_description', 1, 'Комиссия за заказ #{ORDERID} сделаный пользователем ''{USERLOGIN}''', 'general', 'aff'),
('affp_commission_payments', 1, 'Комиссионные и выплаты', 'general', 'aff'),
('affp_customer_commissions', 1, 'Начисленные комиссионные', 'general', 'aff'),
('affp_emailorders', 1, 'Я хочу получать email-уведомления, когда привлеченный покупатель делает заказ', 'general', 'aff'),
('affp_emailpayments', 1, 'Получать email-уведомления о новых выплатах', 'general', 'aff'),
('affp_mail_new_commission', 1, 'На Ваш счет в нашем интернет-магазине начислено новое вознаграждение по партнерской программе в размере {MONEY}', 'general', 'aff'),
('affp_mail_new_payment', 1, 'Вам была произведена выплата в размере {MONEY}. Более подробная информация может быть получена в разделе "Мой счет" нашего интернет-магазина.', 'general', 'aff'),
('affp_msg_commission_deleted', 1, 'Запись о начислении комиссии удалена', 'general', 'aff'),
('affp_msg_new_commission_ok', 1, 'Запись о начислении комиссии добавлена', 'general', 'aff'),
('affp_msg_new_pay_ok', 1, 'Запись о выплате успешно добавлена', 'general', 'aff'),
('affp_msg_no_balance', 1, 'У Вас нулевой баланс', 'general', 'aff'),
('affp_msg_no_payments', 1, 'До текущего момента выплаты вам не производились', 'general', 'aff'),
('affp_msg_nocommisisons_found', 1, 'Не найдено ни одного начисления комиссии за указанный период', 'general', 'aff'),
('affp_msg_nopayments_found', 1, 'Не найдено ни одного платежа за указанный период', 'general', 'aff'),
('affp_msg_payment_deleted', 1, 'Запись о выплате удалена', 'general', 'aff'),
('affp_msg_program_disabled', 1, 'Партнерская программа отключена', 'general', 'aff'),
('affp_no_customers_referred', 1, 'Привлеченных покупателей нет', 'general', 'aff'),
('affp_payment_number', 1, 'Номер выплаты', 'general', 'aff'),
('affp_payments_history', 1, 'История выплат', 'general', 'aff'),
('affp_payments_to_customers', 1, 'Выплаты', 'general', 'aff'),
('affp_referred_customers', 1, 'Привлеченные покупатели', 'general', 'aff'),
('affp_remove_user', 1, 'Удалить из списка привлеченных пользователей?', 'general', 'aff'),
('affp_title', 1, 'Партнерская программа', 'general', 'aff'),
('affp_total_earnings', 1, 'Общее вознаграждение', 'general', 'aff'),
('affp_total_payments', 1, 'Выплаты', 'general', 'aff'),
('affp_user_balance', 1, 'Баланс', 'general', 'aff'),
('msg_timeframe_isnot_specified', 1, 'Период не установлен', 'general', 'aff'),
('lnk_auth_history', 1, 'Просмотр журнала посещений', 'general', 'cmr'),
('lnk_manage_address_book', 1, 'Посмотреть/редактировать адресную книгу', 'general', 'cmr'),
('lnk_update_contact_info', 1, 'Посмотреть/редактировать контактную информацию', 'general', 'cmr'),
('lnk_view_order_history', 1, 'Посмотреть историю заказов', 'general', 'cmr'),
('pgn_contact_information', 1, 'Контактная информация', 'general', 'cmr'),
('pgn_customer_auth_log', 1, 'Журнал авторизации пользователей', 'general', 'cmr'),
('pgn_visit_history', 1, 'История посещений', 'general', 'cmr'),
('str_address', 1, 'Адрес', 'general', 'gen'),
('usr_account_activated', 1, 'Активирована', 'general', 'cmr'),
('usr_account_activation_key', 1, 'Ключ активации', 'general', 'cmr'),
('usr_account_notactivated', 1, 'Не активирована', 'general', 'cmr'),
('usr_account_state', 1, 'Статус учетной записи', 'general', 'cmr'),
('usr_custinfo_city', 1, 'Город', 'general', 'cmr'),
('usr_custinfo_country', 1, 'Страна', 'general', 'cmr'),
('usr_custinfo_default_address', 1, 'Адрес по умолчанию', 'general', 'cmr'),
('usr_custinfo_email', 1, 'Email', 'general', 'cmr'),
('usr_custinfo_first_name', 1, 'Имя', 'general', 'cmr'),
('usr_custinfo_last_name', 1, 'Фамилия', 'general', 'cmr'),
('usr_custinfo_login', 1, 'Логин', 'general', 'cmr'),
('usr_custinfo_logintime', 1, 'Время авторизации', 'general', 'cmr'),
('usr_custinfo_password', 1, 'Пароль', 'general', 'cmr'),
('usr_custinfo_state', 1, 'Область', 'general', 'cmr'),
('usr_custinfo_zip', 1, 'Почтовый индекс', 'general', 'cmr'),
('usr_shopping_history', 1, 'История заказов', 'general', 'cmr'),
('usrreg_registration_form', 1, 'Зарегистрироваться', 'general', 'cmr'),
('email_bestregards', 1, 'С наилучшими пожеланиями', 'general', 'eml'),
('email_change_order_status_subject', 1, 'Статус вашего заказа изменен', 'general', 'eml'),
('email_change_order_status_text', 1, 'Статус вашего заказа #{ORDERID} был изменен на <strong>{STATUS}</strong>', 'general', 'eml'),
('email_hello', 1, 'Здравствуйте', 'general', 'eml'),
('email_message_parameters', 1, 'Content-Type: text/plain; charset="utf-8"', 'general', 'eml'),
('email_news_of', 1, 'Новости', 'general', 'eml'),
('email_ordr_ordered_products', 1, 'Заказанные продукты', 'general', 'eml'),
('email_ordr_payment', 1, 'Оплата заказа', 'general', 'eml'),
('email_ordr_payment_comments', 1, 'Информация об оплате', 'general', 'eml'),
('email_ordr_shipping', 1, 'Доставка заказа', 'general', 'eml'),
('email_ordr_shipping_comments', 1, 'Информация по доставке', 'general', 'eml'),
('email_ordr_total_tax', 1, 'Общий налог на заказ', 'general', 'eml'),
('email_regconfirmation', 1, 'Для активации Вашей учетной записи, пожалуйста, при входе в аккаунт введите ключ активации: [code]<br />Или нажмите по следующей ссылке для автоматической активации Вашей учетной записи:<br /><a href="[codeurl]">[codeurl]</a>', 'general', 'eml'),
('email_subject_forgot_password', 1, 'Ваш пароль', 'general', 'eml'),
('email_subject_registration', 1, 'Регистрация', 'general', 'eml'),
('email_thank_you_for_shopping_at', 1, 'Спасибо за ваш выбор', 'general', 'eml'),
('email_we_contact_you_asap', 1, 'Мы свяжемся с вами в ближайшее время.', 'general', 'eml'),
('email_your_registration_info', 1, 'Ваша регистрационная информация:', 'general', 'eml'),
('email_youve_registered_at', 1, 'Вы успешно зарегистрировались в', 'general', 'eml'),
('err_cant_find_required_page', 1, 'Извините, запрашиваемый документ не был найден на сервере', 'general', 'err'),
('err_cant_read_file', 1, 'Не удалось прочитать файл', 'general', 'err'),
('err_csvimport_update_column_is_not_set', 1, 'Не указан столбец идентификации, однозначно определяющий продукт. Невозможно произвести импорт продуктов.', 'general', 'err'),
('err_curlexec', 1, '1001', 'general', 'err'),
('err_curlinit', 1, '1000', 'general', 'err'),
('err_failed_to_upload_file', 1, '<b><font color=red>Не удалось закачать файл(ы) на сервер. Убедитесь,<br>что у Вас есть права на создание файлов на сервере</font></b>', 'general', 'err'),
('err_forbidden', 1, 'У Вас нет прав на просмотр этой страницы.', 'general', 'err'),
('err_input_address', 1, 'Пожалуйста, введите Ваш адрес', 'general', 'err'),
('err_input_city', 1, 'Пожалуйста, введите название города', 'general', 'err'),
('err_input_email', 1, 'Введите правильный электронный адрес', 'general', 'err'),
('err_input_login', 1, 'Пожалуйста, введите логин', 'general', 'err'),
('err_input_message_subject', 1, 'Пожалуйста, введите тему сообщения', 'general', 'err'),
('err_input_name', 1, 'Пожалуйста, введите Ваши ФИО', 'general', 'err'),
('err_input_nickname', 1, 'Пожалуйста, введите Ваш псевдоним', 'general', 'err'),
('err_input_price', 1, 'Цена должна быть положительным числом', 'general', 'err'),
('err_input_state', 1, 'Пожалуйста, введите область', 'general', 'err'),
('err_input_zip', 1, 'Пожалуйста, введите почтовый индекс', 'general', 'err'),
('err_login_should_start_with_latin_symbol', 1, 'Логин должен начинаться с латинского символа', 'general', 'err'),
('err_password_confirm_failed', 1, 'Неверный пароль', 'general', 'err'),
('err_payment_processing', 1, 'Ошибка при оплате', 'general', 'err'),
('err_user_already_exists', 1, 'Пользователь с указанным логином уже зарегистрирован', 'general', 'err'),
('err_wrong_password', 1, 'Неверный логин и/или пароль', 'general', 'err'),
('btn_activate', 1, 'Активировать', 'general', 'gen'),
('btn_change', 1, 'Изменить', 'general', 'gen'),
('btn_change_address', 1, 'Изменить адрес', 'general', 'gen'),
('btn_clear', 1, 'Очистить', 'general', 'gen'),
('btn_continue', 1, 'Продолжить', 'general', 'gen'),
('btn_delete_all', 1, 'Удалить все', 'general', 'gen'),
('btn_download', 1, 'Скачать', 'general', 'gen'),
('btn_find', 1, 'Найти', 'general', 'gen'),
('btn_printable_version', 1, 'Версия для печати', 'general', 'gen'),
('btn_reset', 1, 'Очистить', 'general', 'gen'),
('btn_select', 1, 'Выбрать', 'general', 'gen'),
('btn_show', 1, 'Показать', 'general', 'gen'),
('btn_update', 1, 'Обновить', 'general', 'gen'),
('btn_view', 1, 'Посмотреть', 'general', 'gen'),
('cnfrm_areyousure', 1, 'Вы уверены?', 'general', 'gen'),
('cnfrm_delete', 1, 'Удалить?', 'general', 'gen'),
('cnfrm_delete_picture', 1, 'Удалить изображение?', 'general', 'gen'),
('cnfrm_unsubscribe', 1, 'Вы уверены, что хотите удалить вашу учетную запись в магазине?', 'general', 'gen'),
('infpg_goback_to_aux_pages', 1, '<< назад к списку', 'general', 'gen'),
('lnk_homepage', 1, 'Главная', 'general', 'gen'),
('msg_information_saved', 1, 'Информация сохранена', 'general', 'gen'),
('msg_saved_changes', 1, 'Изменения сохранены', 'general', 'gen'),
('prdcustopt_goback_to_option_list', 1, '<< назад к списку', 'general', 'gen'),
('srch_no_matches_found', 1, 'Ничего не найдено', 'general', 'gen'),
('str_addresses', 1, 'Адреса', 'general', 'gen'),
('str_after', 1, 'после', 'general', 'gen'),
('str_all_products', 1, 'Все продукты', 'general', 'gen'),
('str_answer_no', 1, 'нет', 'general', 'gen'),
('str_answer_yes', 1, 'да', 'general', 'gen'),
('str_any', 1, 'Не имеет значения', 'general', 'gen'),
('str_any_country', 1, 'Не зависит от страны', 'general', 'gen'),
('str_any_region', 1, 'Не зависит от области', 'general', 'gen'),
('str_anyvalue', 1, 'не имеет значения', 'general', 'gen'),
('str_ascending', 1, 'возр', 'general', 'gen'),
('str_before', 1, 'до', 'general', 'gen'),
('str_default', 1, 'По умолчанию', 'general', 'gen'),
('str_default_charset', 1, 'utf-8', 'general', 'gen'),
('str_descending', 1, 'убыв', 'general', 'gen'),
('str_description', 1, 'Описание', 'general', 'gen'),
('str_discount', 1, 'скидка', 'general', 'gen'),
('str_empty_category', 1, 'Нет продуктов', 'general', 'gen'),
('str_empty_list', 1, 'пустой список', 'general', 'gen'),
('str_from', 1, 'от', 'general', 'gen'),
('str_gram', 1, 'Граммы', 'general', 'gen'),
('str_in_stock', 1, 'На складе', 'general', 'gen'),
('str_indicate_period', 1, 'Укажите период:', 'general', 'gen'),
('str_invoice_title', 1, 'ЗАКАЗ', 'general', 'gen'),
('str_items', 1, 'шт.', 'general', 'gen'),
('str_kg', 1, 'Килограммы', 'general', 'gen'),
('str_language', 1, 'Язык', 'general', 'gen'),
('str_lbs', 1, 'Фунты', 'general', 'gen'),
('str_list_price', 1, 'Старая цена', 'general', 'gen'),
('str_month_april', 1, 'Апрель', 'general', 'gen'),
('str_month_august', 1, 'Август', 'general', 'gen'),
('str_month_december', 1, 'Декабрь', 'general', 'gen'),
('str_month_february', 1, 'Февраль', 'general', 'gen'),
('str_month_january', 1, 'Январь', 'general', 'gen'),
('str_month_july', 1, 'Июль', 'general', 'gen'),
('str_month_june', 1, 'Июнь', 'general', 'gen'),
('str_month_march', 1, 'Март', 'general', 'gen'),
('str_month_may', 1, 'Май', 'general', 'gen'),
('str_month_november', 1, 'Ноябрь', 'general', 'gen'),
('str_month_october', 1, 'Октябрь', 'general', 'gen'),
('str_month_september', 1, 'Сентябрь', 'general', 'gen'),
('str_name', 1, 'Название', 'general', 'gen'),
('str_next', 1, 'след', 'general', 'gen'),
('str_no_orders', 1, 'нет заказов', 'general', 'gen'),
('str_not_defined', 1, 'Не определено', 'general', 'gen'),
('str_number', 1, 'числа', 'general', 'gen'),
('str_number_of_orders_in_status', 1, 'заказ(ов) в статусе', 'general', 'gen'),
('str_number_only', 1, 'только число', 'general', 'gen'),
('str_previous', 1, 'пред', 'general', 'gen'),
('str_price', 1, 'Цена', 'general', 'gen'),
('str_priority', 1, 'Приоритет сортировки', 'general', 'gen'),
('str_records', 1, 'запись(ей)', 'general', 'gen'),
('str_search', 1, 'Поиск', 'general', 'gen'),
('str_search_in_results', 1, 'искать в найденном', 'general', 'gen'),
('str_show', 1, 'показывать', 'general', 'gen'),
('str_showall', 1, 'показать все', 'general', 'gen'),
('str_status', 1, 'Статус', 'general', 'gen'),
('str_time', 1, 'Время', 'general', 'gen'),
('str_to', 1, 'По', 'general', 'gen'),
('str_total', 1, 'Итого', 'general', 'gen'),
('str_universal_currency', 1, 'в валюте, выбранной по умолчанию', 'general', 'gen'),
('str_view', 1, 'посмотреть', 'general', 'gen'),
('usr_custinfo_address_list_link', 1, '<< назад к списку', 'general', 'gen'),
('le_add_link', 1, 'Добавить ссылку', 'general', 'lke'),
('le_categories', 1, 'Разделы', 'general', 'lke'),
('le_category', 1, 'Раздел', 'general', 'lke'),
('le_err_choose_category', 1, 'Выберите раздел', 'general', 'lke'),
('le_err_enter_link', 1, 'Пожалуйста введите ссылку!', 'general', 'lke'),
('le_err_enter_text', 1, 'Пожалуйста введите описание для ссылки!', 'general', 'lke'),
('le_err_link_exists', 1, 'Такая ссылка уже есть в каталоге!', 'general', 'lke'),
('le_links', 1, 'Ссылки', 'general', 'lke'),
('le_msg_link_added', 1, 'Спасибо! Ссылка добавлена в каталог и будет опубликована после проверки администратором!', 'general', 'lke'),
('ordr_back_to_order_list', 1, 'вернуться к списку заказов', 'general', 'ord'),
('ordr_billing_address', 1, 'Адрес плательщика', 'general', 'ord'),
('ordr_billing_first_name', 1, 'Имя плательщика', 'general', 'ord'),
('ordr_billing_last_name', 1, 'Фамилия плательщика', 'general', 'ord'),
('ordr_cccvv', 1, 'CVV', 'general', 'ord'),
('ordr_ccexpires', 1, 'Истекает', 'general', 'ord'),
('ordr_ccholdername', 1, 'Держатель карты', 'general', 'ord'),
('ordr_ccinfo', 1, 'Информация о кредитной карте', 'general', 'ord'),
('ordr_ccnumber', 1, 'Номер кредитной карты', 'general', 'ord'),
('ordr_comment', 1, 'Комментарий', 'general', 'ord'),
('ordr_customer', 1, 'Покупатель', 'general', 'ord'),
('ordr_customer_comments', 1, 'Ваши комментарии или пожелания по заказу', 'general', 'ord'),
('ordr_customer_ip', 1, 'IP покупателя', 'general', 'ord'),
('ordr_filter_by_status', 1, 'Заказы по статусам', 'general', 'ord'),
('ordr_id', 1, 'Номер заказа', 'general', 'ord'),
('ordr_itemprice_excluding_tax', 1, 'Стоимость (без налога)', 'general', 'ord'),
('ordr_order', 1, 'Заказ', 'general', 'ord'),
('ordr_order_confirmation', 1, 'Подтверждение', 'general', 'ord'),
('ordr_order_processing_history', 1, 'История работы с заказом', 'general', 'ord'),
('ordr_order_time', 1, 'Время заказа', 'general', 'ord'),
('ordr_order_total', 1, 'Стоимость заказа', 'general', 'ord'),
('ordr_ordered_products', 1, 'Заказанные продукты', 'general', 'ord'),
('ordr_payee', 1, 'Плательщик', 'general', 'ord'),
('ordr_payment_type', 1, 'Оплата', 'general', 'ord'),
('ordr_recipient', 1, 'Получатель', 'general', 'ord'),
('ordr_search_by_id', 1, 'Поиск заказа по номеру', 'general', 'ord'),
('ordr_shipping_address', 1, 'Адрес доставки заказа', 'general', 'ord'),
('ordr_shipping_first_name', 1, 'Имя получателя', 'general', 'ord'),
('ordr_shipping_handling_cost', 1, 'Стоимость доставки', 'general', 'ord'),
('ordr_shipping_last_name', 1, 'Фамилия получателя', 'general', 'ord'),
('ordr_shipping_type', 1, 'Доставка', 'general', 'ord'),
('ordr_status', 1, 'Статус заказа', 'general', 'ord'),
('ordr_status_cancelled', 1, 'Отменен', 'general', 'ord'),
('ordr_subtotal', 1, 'Подытог', 'general', 'ord'),
('ordr_tax', 1, 'Налог', 'general', 'ord'),
('prd_out_of_stock', 1, 'Нет на складе', 'general', 'prd'),
('prdset_description_brief', 1, 'Краткое описание', 'general', 'prd'),
('prdset_handling_charge', 1, 'Стоимость упаковки', 'general', 'prd'),
('prdset_minimal_order_quantity', 1, 'Минимальный заказ', 'general', 'prd'),
('prdset_product_name', 1, 'Наименование', 'general', 'prd'),
('prdset_weight', 1, 'Вес продукта', 'general', 'prd'),
('srch_found', 1, 'Найдено ', 'general', 'prd'),
('srch_price_to', 1, 'до', 'general', 'prd'),
('srch_products_plural', 1, 'продукт(ов)', 'general', 'prd'),
('catset_slug', 1, 'ID страницы (часть URL; используется в ссылках на эту страницу)', 'back', 'prd'),
('prdset_slug', 1, 'ID страницы (часть URL; используется в ссылках на эту страницу)', 'back', 'prd'),
('loc_find_string', 1, 'Найти строку', 'back', 'loc'),
('loc_iso2_should_be', 1, 'Код языка должен состоять из 2 латинских символов (a-z)', 'back', 'loc'),
('lsgr_import_export', 1, 'Импорт / Экспорт', 'back', 'gen'),
('prdine_default_charset', 1, 'cp1251', 'back', 'ine'),
('prdimport_file_charset', 1, 'Кодировка файла', 'back', 'ine'),
('prdcat_erase_confirmation', 1, 'Вы действительно хотите удалить все продукты? Действие необратимо.', 'back', 'prd'),
('prdcat_erase', 1, 'Удалить', 'back', 'prd'),
('prdcat_erase_products_description', 1, 'Здесь вы можете нажатием одной кнопки удалить все продукты, категории продуктов и их характеристики (действие необратимое).<br />Нажатие по кнопке не затронет списки заказов и покупателей вашего магазина, информационные страницы, блог и прочие настройки.', 'back', 'prd'),
('prdcat_products_erased', 1, 'Всe продукты были удалены', 'back', 'prd'),
('pgn_erase_products', 1, 'Удалить все', 'general', 'prd'),
('str_autodetect', 1, 'Автоопределение', 'general', 'gen'),
('msg_occupied_slug', 1, 'Этот ID страницы уже используется. Измените ID и повторите попытку сохранения.', 'back', 'gen'),
('prd_ordering_not_available', 1, 'продукт сейчас нельзя заказать', 'back', 'prd'),
('mdl_edit_module', 1, 'Редактирование модуля', 'back', 'mdl'),
('pmnt_add_method', 1, 'Добавить способ оплаты', 'back', 'ord'),
('pmnt_method_removed', 1, 'Способ оплаты удален', 'back', 'ord'),
('pmnt_to_list', 1, 'Способы оплаты', 'back', 'ord'),
('pmnt_edit_method', 1, 'Редактирование способа оплаты', 'back', 'ord'),
('pmnt_add_payment_method', 1, 'Добавление способа оплаты (шаг %STEP_NUMBER% из 3)', 'back', 'ord'),
('btn_next', 1, 'Дальше >>', 'general', 'gen'),
('pmnt_paymtd_manual_description', 1, '<strong>Ручная обработка платежей</strong><br /> Платежи, которые вы контролируете вручную. Например, оплата наличными, оплата по квитанции, по счету для юридических лиц, наложенным платежем и так далее.', 'back', 'ord'),
('pmnt_paymtd_online_description', 1, '<strong>Через платежную онлайн-систему</strong><br /> Прием платежей в таких платежных системах как WebMoney, Яндекс.Деньги, PayPal и другие.', 'back', 'gen');
INSERT INTO `SC_local` (`id`, `lang_id`, `value`, `group`, `subgroup`) VALUES
('pmnt_paymtd_cc_description', 1, '<strong>По кредитным картам</strong><br /> Прием платежей по кредитным картам через различные платежные системы или ручная обработка платежей по кредитным картам (пользователь вводит информации о карте при оформлении заказа, и затем вы вручную обрабатываете платеж через какую-либо платежную систему).', 'back', 'ord'),
('btn_back', 1, '<< Назад', 'general', 'gen'),
('enabled', 1, 'Включен', 'general', 'gen'),
('mdlc_russianpost_title', 1, 'Почта России', 'back', 'mdl'),
('mdlc_upsshippingmodule_title', 1, '', 'back', 'mdl'),
('mdlc_uspsshippingmodule_title', 1, '', 'back', 'mdl'),
('mdlc_intershippermodule_title', 1, 'Компания-перевозчик', 'back', 'mdl'),
('mdlc_couriershippingmodule_title', 1, 'Курьер', 'back', 'mdl'),
('mdlc_fedexshippingmodule_title', 1, '', 'back', 'mdl'),
('mdlc_dhlshippingmodule_title', 1, '', 'back', 'mdl'),
('mdlc_couriershippingmodule2_title', 1, 'Курьер', 'back', 'mdl'),
('mdlc_clinkpoint_description', 1, '', 'back', 'mdl'),
('mdlc_clinkpoint_title', 1, '', 'back', 'mdl'),
('mdlc_linkpointapicc_description', 1, '', 'back', 'mdl'),
('mdlc_linkpointapicc_title', 1, '', 'back', 'mdl'),
('mdlc_jccredirectlink_description', 1, '', 'back', 'mdl'),
('mdlc_jccredirectlink_title', 1, '', 'back', 'mdl'),
('mdlc_innovativegateway_description', 1, '', 'back', 'mdl'),
('mdlc_innovativegateway_title', 1, '', 'back', 'mdl'),
('mdlc_ideal_basic_description', 1, '', 'back', 'mdl'),
('mdlc_ideal_basic_title', 1, '', 'back', 'mdl'),
('mdlc_hsbc_description', 1, '', 'back', 'mdl'),
('mdlc_hsbc_title', 1, '', 'back', 'mdl'),
('mdlc_gspay_description', 1, '', 'back', 'mdl'),
('mdlc_gspay_title', 1, '', 'back', 'mdl'),
('mdlc_eselectplus_description', 1, '', 'back', 'mdl'),
('mdlc_eselectplus_title', 1, '', 'back', 'mdl'),
('mdlc_ceprocessingnetwork_description', 1, 'Оплата кредитной картой онлайн', 'back', 'mdl'),
('mdlc_ceprocessingnetwork_title', 1, 'Кредитная карта', 'back', 'mdl'),
('mdlc_epdq_description', 1, '', 'back', 'mdl'),
('mdlc_epdq_title', 1, '', 'back', 'mdl'),
('mdlc_cegold_description', 1, 'Оплата через платежную систему <a href="http://www.e-gold.com">E-Gold</a>. У вас должен быть аккаунт в платежной системе E-Gold для того, чтобы произвести оплату.', 'back', 'mdl'),
('mdlc_cegold_title', 1, '', 'back', 'mdl'),
('mdlc_cyberplat_description', 1, 'Оплата кредитной картой онлайн', 'back', 'mdl'),
('mdlc_cyberplat_title', 1, 'Кредитная карта', 'back', 'mdl'),
('mdlc_chronopay_description', 1, 'Оплата кредитной картой онлайн', 'back', 'mdl'),
('mdlc_chronopay_title', 1, 'Кредитная карта', 'back', 'mdl'),
('mdlc_chronopaydirect_description', 1, 'Оплата кредитной картой онлайн', 'back', 'mdl'),
('mdlc_chronopaydirect_title', 1, 'Кредитная карта', 'back', 'mdl'),
('mdlc_paymentech_description', 1, '', 'back', 'mdl'),
('mdlc_paymentech_title', 1, '', 'back', 'mdl'),
('mdlc_ccavenue_description', 1, '', 'back', 'mdl'),
('mdlc_ccavenue_title', 1, '', 'back', 'mdl'),
('mdlc_cauthorizenetsim_description', 1, 'Оплата кредитной картой онлайн', 'back', 'mdl'),
('mdlc_cauthorizenetsim_title', 1, 'Кредитная карта', 'back', 'mdl'),
('mdlc_cauthorizenetaim_description', 1, 'Оплата кредитной картой онлайн', 'back', 'mdl'),
('mdlc_cauthorizenetaim_title', 1, 'Кредитная карта', 'back', 'mdl'),
('mdlc_cassist_description', 1, 'Оплата кредитной картой онлайн', 'back', 'mdl'),
('mdlc_c2checkout_description', 1, 'Оплата кредитной картой онлайн', 'back', 'mdl'),
('mdlc_cassist_title', 1, 'Кредитная карта', 'back', 'mdl'),
('mdlc_c2checkout_title', 1, 'Кредитная карта', 'back', 'mdl'),
('mdlc_cyandexmoney_description', 1, 'Оплата через платежную систему <a href="http://money.yandex.ru">Яндекс.Деньги</a>. У вас должен быть счет в этой системе для того, чтобы произвести оплату.', 'back', 'mdl'),
('mdlc_cyandexmoney_title', 1, 'Яндекс.Деньги', 'back', 'mdl'),
('mdlc_cinvoicephys_description', 1, 'Оплата по квитанции в ближайшем отделении банка. Квитанция на оплату будет оформлена автоматически после оформления заказа.', 'back', 'mdl'),
('mdlc_cinvoicephys_title', 1, 'Оплата по квитанции', 'back', 'mdl'),
('mdlc_cinvoicejur_description', 1, 'Счет на имя вашей организации будет оформлен автоматически после оформления заказа.', 'back', 'mdl'),
('mdlc_cinvoicejur_title', 1, 'Оплата по счету', 'back', 'mdl'),
('mdlc_yandexcpp_description', 1, 'Оплата через платежную систему <a href="http://money.yandex.ru">Яндекс.Деньги</a>. У вас должен быть счет в этой системе для того, чтобы произвести оплату.', 'back', 'mdl'),
('mdlc_yandexcpp_title', 1, 'Яндекс.Деньги', 'back', 'mdl'),
('mdlc_cworldpay_description', 1, 'Оплата кредитной картой онлайн', 'back', 'mdl'),
('mdlc_cworldpay_title', 1, 'Кредитная карта', 'back', 'mdl'),
('mdlc_cwebmoney_description', 1, 'Оплата через платежную систему <a href="http://www.webmoney.ru">WebMoney</a>. У вас должен быть счет в этой системе для того, чтобы произвести оплату.', 'back', 'mdl'),
('mdlc_cwebmoney_title', 1, 'WebMoney', 'back', 'mdl'),
('mdlc_usaepay_description', 1, '', 'back', 'mdl'),
('mdlc_usaepay_title', 1, '', 'back', 'mdl'),
('mdlc_tclink_description', 1, '', 'back', 'mdl'),
('mdlc_tclink_title', 1, '', 'back', 'mdl'),
('mdlc_streamlinedo_description', 1, '', 'back', 'mdl'),
('mdlc_streamlinedo_title', 1, '', 'back', 'mdl'),
('mdlc_skipjackdc_description', 1, '', 'back', 'mdl'),
('mdlc_skipjackdc_title', 1, '', 'back', 'mdl'),
('mdlc_setcomcheckoutbtn_description', 1, '', 'back', 'mdl'),
('mdlc_setcomcheckoutbtn_title', 1, '', 'back', 'mdl'),
('mdlc_csecurepay_description', 1, '', 'back', 'mdl'),
('mdlc_csecurepay_title', 1, '', 'back', 'mdl'),
('mdlc_secpay_description', 1, '', 'back', 'mdl'),
('mdlc_secpay_title', 1, '', 'back', 'mdl'),
('mdlc_crupaypaymentrequest_description', 1, 'Оплата через платежную систему <a href="http://www.rupay.com">RUpay</a>. У вас должен быть счет в этой системе для того, чтобы произвести оплату.', 'back', 'mdl'),
('mdlc_crupaypaymentrequest_title', 1, 'RUpay', 'back', 'mdl'),
('mdlc_crupay_description', 1, 'Оплата через платежную систему <a href="http://www.rupay.com">RUpay</a>. У вас должен быть счет в этой системе для того, чтобы произвести оплату.', 'back', 'mdl'),
('mdlc_crupay_title', 1, 'RUpay', 'back', 'mdl'),
('mdlc_roboxchange_description', 1, '', 'back', 'mdl'),
('mdlc_roboxchange_title', 1, '', 'back', 'mdl'),
('mdlc_cpsigatehtml_description', 1, 'Оплата кредитной картой онлайн', 'back', 'mdl'),
('mdlc_cpsigatehtml_title', 1, 'Кредитная карта', 'back', 'mdl'),
('mdlc_cprotx_description', 1, 'Оплата кредитной картой онлайн', 'back', 'mdl'),
('mdlc_cprotx_title', 1, 'Кредитная карта', 'back', 'mdl'),
('mdlc_cpaypal_description', 1, 'Оплата через платежную систему <a href="http://www.paypal.com">PayPal</a>. У вас должен быть аккаунт в платежной системе PayPal для того, чтобы произвести оплату.', 'back', 'mdl'),
('mdlc_cpaypal_title', 1, '', 'back', 'mdl'),
('mdlc_cpaypaldirect_description', 1, '', 'back', 'mdl'),
('mdlc_cpaypaldirect_title', 1, '', 'back', 'mdl'),
('mdlc_payflowpro_description', 1, '', 'back', 'mdl'),
('mdlc_payflowpro_title', 1, '', 'back', 'mdl'),
('mdlc_cverisignlink_description', 1, 'Оплата кредитной картой онлайн', 'back', 'mdl'),
('mdlc_cverisignlink_title', 1, 'Кредитная карта', 'back', 'mdl'),
('mdlc_cnochex_description', 1, 'Оплата через платежную систему <a href="http://www.nochex.com">NOCHEX</a>. У вас должен быть аккаунт в платежной системе NOCHEX для того, чтобы произвести оплату.', 'back', 'mdl'),
('mdlc_cnochex_title', 1, '', 'back', 'mdl'),
('mdlc_cnetregistry_description', 1, 'Оплата кредитной картой онлайн', 'back', 'mdl'),
('mdlc_cnetregistry_title', 1, 'Кредитная карта', 'back', 'mdl'),
('mdlc_nab_nsips_description', 1, '', 'back', 'mdl'),
('mdlc_nab_nsips_title', 1, '', 'back', 'mdl'),
('mdlc_cmoneybookers_description', 1, 'Оплата через платежную систему <a href="http://www.moneybookers.com">Moneybookers</a>. У вас должен быть аккаунт в платежной системе Moneybookers для того, чтобы произвести оплату.', 'back', 'mdl'),
('mdlc_cmoneybookers_title', 1, '', 'back', 'mdl'),
('mdlc_cmanualccprocessing_description', 1, 'Оплата кредитной картой онлайн', 'back', 'mdl'),
('mdlc_cmanualccprocessing_title', 1, 'Кредитная карта', 'back', 'mdl'),
('mdlc_cmalse_description', 1, 'Оплата кредитной картой онлайн', 'back', 'mdl'),
('mdlc_cmalse_title', 1, 'Кредитная карта', 'back', 'mdl'),
('shp_edit_method', 1, 'Редактирование способа доставки', 'back', 'ord'),
('shp_add_method', 1, 'Добавить способ доставки', 'back', 'ord'),
('shp_to_list', 1, 'К списку способов доставки', 'back', 'ord'),
('shp_add_shipping_method', 1, 'Добавление способа доставки (шаг %STEP_NUMBER% из 2)', 'back', 'ord'),
('shp_empty_name', 1, 'Введите название способа доставки', 'back', 'ord'),
('shp_method_removed', 1, 'Cпособ доставки удален', 'back', 'ord'),
('mdls_customshipping_description', 1, 'Отключить автоматический расчет стоимости для этого способа доставки заказа', 'back', 'mdl'),
('mdls_customshipping_title', 1, 'Без расчета стоимости доставки', 'back', 'mdl'),
('mdls_manualpayment_description', 1, 'Любой способ оплаты, не связанный ни с каким платежным действием (модулем), выполняемым магазином автоматически. Например, оплата наличными, наложенным платежем, или любой другой способ оплаты.', 'back', 'mdl'),
('mdls_manualpayment_title', 1, 'Произвольный способ оплаты', 'back', 'mdl'),
('imm_permalink', 1, 'Постоянная ссылка', 'back', 'imm'),
('imm_view_image', 1, 'Просмотр', 'back', 'imm'),
('imm_folder_prdpicts', 1, 'Картинки продуктов', 'back', 'imm'),
('imm_folder_images', 1, 'Картинки', 'back', 'imm'),
('shp_module_settings', 1, 'Настройки расчета стоимости доставки - %MODULE_NAME%', 'back', 'ord'),
('pmnt_module_settings', 1, 'Настройки модуля оплаты - %MODULE_NAME%', 'back', 'ord'),
('shp_modules_list_title', 1, 'Выберите способ автоматического расчета стоимости доставки', 'back', 'ord'),
('pmnt_mtdtype_title_manual', 1, 'Добавьте способ оплаты, который вы контролируете вручную', 'back', 'ord'),
('pmnt_mtdtype_title_online', 1, 'Выберите платежную систему', 'back', 'ord'),
('pmnt_mtdtype_title_cc', 1, 'Выберите платежную систему для обработки платежей по кредитным картам', 'back', 'ord'),
('pmnt_modules_types_title', 1, 'Я хочу принимать платежи:', 'back', 'ord'),
('cfg_store_domain_description', 1, 'Введите адрес вашего интернет-магазина в произвольной форме. Этот адрес будет добавлен в подпись в электронных сообщениях, которые отправляются покупателям (например, в уведомления о заказах).', 'back', 'cfg'),
('cfg_store_domain_title', 1, 'Адрес вашего интернет-магазина', 'back', 'cfg'),
('pmnt_page_description', 1, 'Добавьте все возможные способы оплаты заказов в вашем интернет-магазине на этой странице.', 'back', 'ord'),
('shp_page_description', 1, 'Добавьте все возможные способы доставки в вашем интернет-магазине на этой странице.', 'back', 'ord'),
('pgn_checkout_replacement', 1, 'Альтернативы оформлению заказа', 'general', 'gen'),
('btn_disable', 1, 'Выключить', 'general', 'gen'),
('btn_enable', 1, 'Включить', 'general', 'gen'),
('search_results', 1, 'Результаты поиска', 'general', 'gen'),
('no_results', 1, 'Ничего не найдено', 'general', 'gen'),
('pgn_product_widgets', 1, 'Виджеты', 'general', 'gen'),
('pwgt_view_product', 1, 'Просмотр %PRODUCT_NAME% в пользовательской части...', 'back', 'prd'),
('pwgt_view_cart_ttl', 1, 'Виджет "Открыть корзину / Оформить заказ"', 'back', 'prd'),
('pwgt_view_cart_note', 1, 'ВАЖНО: Этот код только лишь отобразит кнопку для открытия страницы корзины, но корзина будет пуста, если покупатель не добавил продукты в нее. Необходимо использовать этот виджет совместно с виджетом "Добавить в корзину".', 'back', 'prd'),
('pwgt_view_cart_dscr', 1, 'Этот виджет отображает кнопку "Корзина", по нажатию на которую пользователь сможет посмотреть текущее содержимое корзины, не уходя с вашего веб-сайта или блога, и приступить к оформлению заказа:', 'back', 'prd'),
('pwgt_product_widgets_ttl', 1, 'Виджеты "Информация о продукте" и "Добавить продукт в корзину"', 'back', 'prd'),
('pwgt_product_detailed_info_ttl', 1, 'Информация о продукте', 'back', 'prd'),
('pwgt_product_detailed_info_dscr', 1, 'Этот виджет отобразит краткую информацию об этом продукте вместе с кнопкой "Добавить в корзину".', 'back', 'prd'),
('pwgt_preview', 1, 'Так это будет выглядеть на вашем сайте:', 'back', 'prd'),
('pwgt_find_product', 1, 'Найти продукт', 'back', 'prd'),
('pwgt_edit_product', 1, 'Редактировать %PRODUCT_NAME%...', 'back', 'prd'),
('pwgt_description', 1, 'Здесь вы найдете инструменты, с помощью которых сможете <strong>превратить ваш любой веб-сайт или блог в интернет-магазин</strong> &mdash; будь то веб-сайт со сложной системой управления, веб-сайт на Народ.ру, или же блог ЖЖ, Mail.Ru, Яндекс, Blogger &mdash; это не имеет значения.<br /><br />Виджет (widget) &mdash; это фрагмент HTML-кода, который вы добавляете на страницу вашего веб-сайта, а он реализуют некоторую функцию. Здесь вы можете получить HTML-код виджета, который отобразит информацию о любом продукте вашего интернет-магазина (который вы добавите здесь), или же который дает возможность заказать определенный продукт прямо на вашем веб-сайте или блоге, не покидая его контекст.<br /><br />Для внедрения виджета на ваш веб-сайт просто получите его HTML-код здесь и добавьте на страницу сайта.<br />Все заказы, которые посетители вашего веб-сайта оформят, вы увидите здесь - в администрировании магазина, а также получите уведомления о них по электронной почте.<br /><br />Смотрите наши <a href="http://www.webasyst.ru/support/shop/manual.html#Widgets" target="_blank">примеры использования виджетов</a>.', 'back', 'gen'),
('pwgt_add2cart_ttl', 1, 'Только кнопка "Добавить в корзину"', 'back', 'prd'),
('pwgt_add2cart_dscr', 1, 'Используйте этот виджет, если информация об этом продукте уже опубликована на странице вашего сайта или блога, и вы просто хотите добавить возможность заказать этот продукт. Этот виджет отобразит всего лишь одну кнопку &mdash; "Добавить в корзину". Добавление продукта и его заказ будут происходить так, что пользователь не покинет контекст веб-сайта, куда вы установили виджет.', 'back', 'prd'),
('search_products', 1, 'поиск', 'front', 'gen'),
('ordr_action_source_admin', 1, 'продавцом', 'general', 'ord'),
('ordr_action_source_customer', 1, 'customer', 'general', 'ord'),
('ordr_action_source_robot', 1, 'robot', 'general', 'ord'),
('ordr_comment_delivered', 1, 'Заказ доставлен', 'general', 'ord'),
('ordr_comment_charge', 1, 'Деньги списаны с кредитной карты клиента', 'general', 'ord'),
('ordr_comment_refund', 1, 'Деньги возвращены клиенту', 'general', 'ord'),
('ordr_comment_restore', 1, 'Заказ восстановлен и принят в обработку', 'general', 'ord'),
('ordr_comment_processing_order', 1, 'Принят в обработку', 'general', 'ord'),
('ordr_comment_canceled_by', 1, 'Отменен', 'general', 'ord'),
('ordr_forbidden_order_action', 1, 'Это действие с заказом запрещено', 'general', 'ord'),
('str_italic', 1, 'Курсив', 'general', 'gen'),
('str_bold', 1, 'Жирный', 'general', 'gen'),
('str_color', 1, 'Цвет', 'general', 'gen'),
('ordsts_custom_title', 1, 'Произвольные статусы заказов', 'back', 'ord'),
('ordsts_custom_description', 1, 'В дополнение к предопределенным статусам вы можете добавить любые произвольные статусы, чтобы более точно отразить процесс обработки заказов в вашем интернет-магазине.', 'back', 'ord'),
('ordsts_predefined_description', 1, 'Следующие статусы заказов вашего интернет-магазина - предопределенные. Вы можете редактировать настройки отображения этих статусов.<br />Статусы "Деньги списаны с карты клиента" и "Деньги возвращены" используются только для заказов, которые оплачиваются кредитными картами.', 'back', 'ord'),
('ordr_confirm_refund', 1, 'Подтвердить возврат денег по этому заказу?', 'general', 'ord'),
('ordr_confirm_cancel', 1, 'Отменить этот заказ?', 'general', 'ord'),
('ordr_orderaction_charge', 1, 'Списать деньги с карты клиента', 'general', 'ord'),
('ordr_orderaction_refund', 1, 'Вернуть деньги', 'general', 'ord'),
('ordr_orderaction_deliver', 1, 'Оплачен и доставлен', 'general', 'ord'),
('ordr_orderaction_restore', 1, 'Восстановить', 'general', 'ord'),
('ordr_orderaction_process', 1, 'В обработку', 'general', 'ord'),
('ordr_orderaction_cancel', 1, 'Отменить заказ', 'general', 'ord'),
('ordr_add_comment', 1, 'Добавить заметку в историю обработки заказа', 'back', 'ord'),
('ordr_order_changed', 1, 'Информация о заказе обновлена', 'back', 'ord'),
('pgn_product_lists', 1, 'Списки', 'general', 'gen'),
('prdlist_lbl_products_in_list', 1, '%PRODUCTS_NUM% продукт(ов)', 'back', 'prd'),
('prdlist_add_list_title', 1, 'Создать новый список продуктов', 'back', 'prd'),
('prdlist_products_in_list', 1, 'Продукты в списке', 'back', 'prd'),
('prdlist_id', 1, 'ID', 'back', 'prd'),
('prdlist_wrong_chars_in_id', 1, 'ID должен содержать только латинские символы (a-z) или цифры', 'back', 'prd'),
('prdlist_list_id_reserved', 1, 'Этот ID уже используется. Измените ID и повторите попытку.', 'back', 'prd'),
('prdlist_products_title', 1, 'Для изменения порядка сортировки продуктов просто перетаскивайте их внутри списка с помощью мышки.', 'back', 'prd'),
('prdlist_add_product', 1, 'Добавить продукт в список', 'back', 'prd'),
('prdlist_find_product', 1, 'Найти продукт', 'back', 'prd'),
('prdlist_product_added', 1, 'Продукт добавлен в список', 'back', 'prd'),
('prdlist_no_products_in_list', 1, 'В списке нет продуктов', 'back', 'prd'),
('str_week_monday', 1, 'Понедельник', 'general', 'gen'),
('str_week_tuesday', 1, 'Вторник', 'general', 'gen'),
('str_week_wednesday', 1, 'Среда', 'general', 'gen'),
('str_week_thursday', 1, 'Четверг', 'general', 'gen'),
('str_week_friday', 1, 'Пятница', 'general', 'gen'),
('str_week_saturday', 1, 'Суббота', 'general', 'gen'),
('str_week_sunday', 1, 'Воскресенье', 'general', 'gen'),
('pgn_login', 1, 'Вход с паролем', 'general', 'gen'),
('pgn_logout', 1, 'Выйти', 'general', 'gen'),
('err_product_not_found', 1, 'Продукт не найден', 'general', 'gen'),
('prdlist_description', 1, 'Здесь вы можете объединять различные продукты вашего магазина в списки. <br />Списки используются для наглядного представления продуктов вашим покупателям.<br /><br />С помощью инструментов редактирования дизайна вы сможете отображать любой из списков продуктов в пользовательской части магазина.<br />Примеры списков: специальные предложения, бестселлеры, новые поступления, продукты со скидкой и т.п.', 'back', 'gen'),
('srep_description', 1, 'Ниже представлены графики, отражающие динамику продаж вашего интернет-магазина.<br />Отчет "Динамика продаж" позволяет сопоставить объем доставленных заказов ко всем совершенным заказам.<br />Отчеты "Сравнение" и "Продажи за весь период" показывают данные только о доставленных заказах.', 'back', 'rep'),
('cpt_lbl_category_tree', 1, 'Дерево категорий', 'general', 'cpt'),
('cpt_lbl_currency_selection', 1, 'Выбор валюты', 'general', 'cpt'),
('cpt_lbl_custom_html', 1, 'Произвольный HTML-код', 'general', 'cpt'),
('cpt_lbl_language_selection', 1, 'Выбор языка', 'general', 'cpt'),
('cpt_lbl_logo', 1, 'Логотип', 'general', 'cpt'),
('cpt_lbl_main_content', 1, 'Главное содержание', 'general', 'cpt'),
('cpt_lbl_news_short_list', 1, 'Блог / Новости', 'general', 'cpt'),
('cpt_lbl_product_lists', 1, 'Список продуктов', 'general', 'cpt'),
('cpt_lbl_product_search', 1, 'Поиск продуктов', 'general', 'cpt'),
('cpt_lbl_root_categories', 1, 'Развернутый список категорий', 'general', 'cpt'),
('cpt_lbl_shopping_cart_info', 1, 'Корзина', 'general', 'cpt'),
('cpt_lbl_survey', 1, 'Голосование', 'general', 'cpt'),
('lsgr_taxes', 1, 'Налоги', 'back', 'gen'),
('cpt_drop_for_delete', 1, 'Переместите компонент сюда для удаления', 'general', 'cpt'),
('lsgr_checkout', 1, 'Оформление заказов', 'back', 'gen'),
('lsgr_customers', 1, 'Покупатели', 'back', 'gen'),
('lsgr_email', 1, 'Email-сообщения', 'back', 'gen'),
('lsgr_feedback', 1, 'Обратная связь', 'back', 'gen'),
('lsgr_shopping_cart', 1, 'Корзина', 'back', 'gen'),
('lsgr_affiliate_program', 1, 'Партнерская программа', 'back', 'gen'),
('lsgr_news', 1, 'Блог / Новости', 'back', 'gen'),
('lsgr_countries_regions', 1, 'Страны и области', 'back', 'gen'),
('lsgr_discounts', 1, 'Скидки', 'back', 'gen'),
('lsgr_errors', 1, 'Сообщения об ошибках', 'back', 'gen'),
('lsgr_info_pages', 1, 'Информационные страницы', 'back', 'gen'),
('lsgr_link_exchange', 1, 'Обмен ссылками', 'back', 'gen'),
('lsgr_orders', 1, 'Заказы', 'back', 'gen'),
('lsgr_sms', 1, 'SMS', 'back', 'gen'),
('lsgr_subscribers', 1, 'Подписчики на новости', 'back', 'gen'),
('lsgr_survey', 1, 'Голосование', 'back', 'gen'),
('lgr_hidden', 1, '(скрытый)', 'back', 'gen'),
('prdset_tab_customparams', 1, 'Доп. характеристики', 'back', 'prd'),
('pgn_googleanalytics', 1, 'Google Analytics', 'general', 'gen'),
('prdcat_add_category', 1, 'Новая категория', 'back', 'prd'),
('prdcat_edit_category', 1, 'Редактирование категории: %CATEGORY_NAME%', 'back', 'prd'),
('prdlist_edit_list_title', 1, 'Редактирование списка продуктов: %LIST_NAME%', 'back', 'prd'),
('survey_page_description', 1, 'Здесь вы можете создать голосование (опрос) для посетителей вашего интернет-магазина и просматривать результаты голосования.', 'back', 'srv'),
('ordr_order_list', 1, 'Список заказов', 'back', 'ord'),
('pgn_user_info', 1, 'Покупатель: %CUSTOMER_NAME%', 'general', 'ord'),
('infpg_editpage', 1, 'Редактирование страницы:', 'back', 'inf'),
('blog_edit_post', 1, 'Редактирование сообщения:', 'back', 'nws'),
('shp_shipping_types', 1, 'Способы доставки', 'back', 'ord'),
('btn_recalculate', 1, 'Пересчитать', 'general', 'gen'),
('cart_checkout_alternative', 1, '&mdash; или используйте &mdash;', 'front', 'crt'),
('prdcat_btn_delete_category', 1, 'Удалить категорию', 'back', 'prd'),
('prdcat_btn_edit_category', 1, 'Редактировать категорию', 'back', 'prd'),
('prdcat_with_selected', 1, 'Выбранные продукты', 'back', 'prd'),
('prdcat_btn_update_prices_sort', 1, 'Сохранить цены и сортировку', 'back', 'prd'),
('catset_empty_name', 1, 'Введите название категории', 'back', 'prd'),
('ordr_comment_orderplaced', 1, 'Заказ оформлен покупателем', 'general', 'ord'),
('le_no_links_selected', 1, 'Не выбрано ни одной ссылки', 'back', 'lke'),
('le_page_description', 1, 'Ссылки, которые вы добавите в этом разделе, будут опубликованы в пользовательской части вашего интернет-магазина в отдельном разделе "Обмен ссылками".<br />С помощью этого инструмента вы можете обмениваться ссылками с вашими партнерами. <a href="http://ru.wikipedia.org/wiki/%D0%9E%D0%B1%D0%BC%D0%B5%D0%BD_%D1%81%D1%81%D1%8B%D0%BB%D0%BA%D0%B0%D0%BC%D0%B8" target="_blank">Что дает обмен ссылками?</a>', 'back', 'lke'),
('imm_folder_prdpicts_dscr', 1, 'Все загружаемые изображения помещаются в папку: <strong>[url]</strong>', 'back', 'imm'),
('imm_folder_images_dscr', 1, 'Все загружаемые изображения помещаются в папку: <strong>[url]</strong>', 'back', 'imm'),
('tax_page_description', 1, 'В этом разделе вы можете настроить систему расчета налогов в вашем интернет-магазине для случая, если налог не включен в стоимость продуктов и должен быть прибавлен к общей стоимости при оформлении заказа.', 'back', 'txs'),
('usr_enter_loginemail', 1, 'Введите логин или адрес', 'front', 'cmr'),
('cpt_lbl_product_params_selectable', 1, 'Дополнительные характеристики продукта (выбираемые)', 'general', 'cpt'),
('cpt_lbl_product_params_fixed', 1, 'Дополнительные характеристики продукта (фиксированные)', 'general', 'cpt'),
('thm_component_dnd_or_dblclick', 1, 'Перетащите или двойной клик', 'general', 'thm'),
('msg_error_wrong_email', 1, 'Введите правильный электронный адрес', 'general', 'gen'),
('str_show_other_languages', 1, 'Показать поля для всех языков', 'back', 'gen'),
('btn_viewcart', 1, 'Корзина', 'general', 'gen'),
('btn_add2cart', 1, 'Добавить в корзину', 'general', 'gen'),
('ordr_added_comment', 1, 'Добавлен комментарий', 'general', 'ord'),
('ordr_set_custom_status_comment', 1, 'Заказ помещен в статус %STATUS_NAME%', 'back', 'ord'),
('smshosted_description', 1, 'Введите номера мобильных телефонов, на которые вы хотите получать SMS-уведомления о всех новых заказах.<br />Обращаем ваше внимание на то, что отправка SMS платная. Стоимость одного сообщения может составлять в зависимости от вашего оператора порядка 5-10 центов. Стоимость каждого отправленного SMS-сообщения будет списана с вашего SMS-баланса.', 'back', 'sms'),
('goto_storefront', 1, '&laquo; перейти к витрине магазина', 'front', 'chk'),
('prdopt_page_description', 1, 'Здесь вы можете создать совершенно произвольные характеристики (параметры), которые подходят продуктам вашего интернет-магазина - от цвета и размера, до мощности двигателя и тарифного плана. После добавления характеристики здесь вы можете заполнить ее значение для каждого вашего продукта.', 'back', 'prd'),
('chckrpl_page_description', 1, 'Здесь вы можете разрешить вашим покупателям оформлять заказы в вашем магазине через <a href="http://checkout.google.com/sell?promo=sewebasyst" target="_blank">Google Checkout</a> и <a href="https://www.paypal.com/us/mrb/pal=XREZHZ8R3F4YY" target="_blank">PayPal Express Checkout</a> (как альтернативу к обычному способу оформлению заказа). Все заказы, оформленные таким способом, сохраняются в базу данных вашего интернет-магазина как и любой другой заказ.<br />К сожалению, в настоящее время платежные системы Google Checkout и PayPal Express Checkout работают только для продавцов, зарегистрированных в США и Великобритании.', 'back', 'gen'),
('err_input_country', 1, 'Пожалуйста, введите страну', 'general', 'gen'),
('err_input_password', 1, 'Пожалуйста, введите пароль', 'general', 'gen'),
('email_shippingisincluded', 1, '(включена в общую стоимость заказа, указанную выше)', 'general', 'eml'),
('ordr_source_widgets', 1, 'Виджеты', 'back', 'ord'),
('ordr_source_storefront', 1, 'Витрина', 'back', 'ord'),
('ordr_source', 1, 'Источник', 'back', 'ord'),
('usr_addresses_num', 1, 'и еще %ADRESSES_NUM% адреса(ов)', 'front', 'cmr'),
('usr_orders_num', 1, 'У вас <a href="%ORDERS_LIST_URL%">%ORDERS_NUM% заказов</a>', 'front', 'cmr'),
('usr_custinfo_other_addresses', 1, 'Остальные адреса', 'general', 'cmr'),
('usr_set_default_address', 1, 'Сделать адресом по умолчанию', 'front', 'cmr'),
('cfg_orderid_prefix_title', 1, 'Префикс номеров заказа', 'back', 'cfg'),
('cfg_orderid_prefix_description', 1, 'Ввведите что-нибудь, чтобы дать номерам заказов понятный вид', 'back', 'cfg'),
('featured_products', 1, 'Специальные предложения', 'front', 'gen'),
('browse_by_category', 1, 'Продукты по категориям', 'front', 'gen'),
('cpt_align_right', 1, 'вправо', 'back', 'cpt'),
('cpt_align_center', 1, 'по центру', 'back', 'cpt'),
('cpt_align_left', 1, 'влево', 'back', 'cpt'),
('cpt_ovst_linkColor', 1, 'Цвет ссылок', 'back', 'cpt'),
('cpt_ovst_textAlign', 1, 'Выравнивание текста', 'back', 'cpt'),
('cpt_ovst_fontColor', 1, 'Цвет текста', 'back', 'cpt'),
('cpt_ovst_borderWidth', 1, 'Ширина рамки (px)', 'back', 'cpt'),
('cpt_ovst_borderColor', 1, 'Цвет рамки', 'back', 'cpt'),
('cpt_ovst_backgroundColor', 1, 'Цвет фона', 'back', 'cpt'),
('cpt_ovst_title', 1, 'Переопределить стили', 'back', 'cpt'),
('cpt_ovst_description', 1, 'Если вы включите эту опцию, то сможете перезаписать правила отображения этого компонента, определенные на вкладке "Стили (CSS)".', 'back', 'cpt'),
('imm_noimages', 1, 'В этой папке нет изображений', 'back', 'imm'),
('err_occupied_email', 1, 'Введенный вами электронный адрес занят. Пожалуйста, введите другой.', 'general', 'gen'),
('prdimport_step', 1, 'Шаг', 'general', 'gen'),
('thm_new_comming_soon', 1, 'Новые варианты дизайна будут представлены скоро', 'general', 'gen'),
('cpt_ovst_padding', 1, 'Отступ (px)', 'general', 'gen'),
('cpt_lbl_tag_cloud', 1, 'Облако тегов', 'hidden', 'cpt'),
('cpt_tgcld_tags_num', 1, 'Максимальное количество тегов в облаке', 'hidden', 'cpt'),
('imm_images_deleted', 1, 'Изображения удалены', 'back', 'imm'),
('imm_delall_confirmation', 1, 'Вы действительно хотите удалить отмеченные изображения?', 'back', 'gen'),
('imm_delete_all', 1, 'Удалить все', 'back', 'imm'),
('thm_open_fullscreen', 1, 'На весь экран', 'back', 'thm'),
('thm_close_fullscreen', 1, 'Закрыть', 'back', 'thm'),
('thm_allow_popups', 1, 'Разрешите popup-окна в настройках браузера и нажмите по кнопке "На весь экран" еще раз.', 'back', 'thm'),
('lbl_product_added', 1, 'Добавлено новых продуктов', 'back', 'gen'),
('lbl_product_modify', 1, 'Обновлено продуктов', 'back', 'gen'),
('lbl_category_added', 1, 'Добавлено категорий', 'back', 'gen'),
('lbl_prdimport_report', 1, 'Отчет об импорте продуктов', 'back', 'gen'),
('msg_coupons_disabled', 1, 'Скидки по сертификатам отключены. Включите эту возможность', 'back', 'dsc'),
('lbl_discount_settings', 1, 'в настройках скидок', 'back', 'dsc'),
('lbl_loading', 1, 'Загрузка', 'general', 'gen'),
('pgn_order_creater', 1, 'Создать новый заказ', 'back', 'ord'),
('btn_proceed', 1, 'Продолжить', 'general', 'gen'),
('cfg_voiting_for_products_title', 1, 'Покупатели могут оценивать продукты', 'back', 'cfg'),
('cfg_voiting_for_products_descr', 1, 'Если включить, покупатели могут голосовать за продукты оценкой от 1 до 5 звезд. Для каждого продукта будет показан его суммарный рейтинг.', 'back', 'cfg'),
('lbl_no_products_in_order', 1, 'В этом заказе нет ни одного продукта.', 'general', 'ord'),
('lbl_loading_cinfo', 1, 'Загрузка информации о покупателе', 'general', 'ord'),
('lbl_assign_to_existing_customer', 1, 'Оформить заказ на уже зарегистрированного покупателя', 'back', 'ord'),
('ordr_comment_created_by_admin', 1, 'Заказ создан {0}', 'back', 'ord'),
('ordr_comment_admin_modified', 1, 'Заказ изменен {0}', 'back', 'ord'),
('msg_cant_edit_order', 1, 'Заказы в статусе %0% нельзя редактировать', 'back', 'ord'),
('lbl_edit_discount_descr', 1, 'редактировать описание скидки', 'back', 'ord'),
('lbl_creating_order', 1, 'Создание заказа', 'back', 'ord'),
('pgn_order_editor', 1, 'Редактирование заказа', 'back', 'ord'),
('btn_assign_to_customer', 1, 'Передать заказ другому покупателю', 'back', 'ord'),
('btn_find_products', 1, 'Найти продукты', 'back', 'ord'),
('err_cant_delete_last_product', 1, 'Нельзя удалить все продукты из заказа.', 'back', 'ord'),
('lbl_add_products_to_order', 1, 'Добавить продукты в заказ', 'back', 'ord'),
('hdr_price_for_item', 1, 'Цена за штуку', 'back', 'ord'),
('lbl_edit_cust_info', 1, 'редактировать данные %0%', 'back', 'ord'),
('btn_change_addr', 1, 'Изменить адрес', 'general', 'gen'),
('btn_make_route', 1, 'Проложить маршрут', 'general', 'gen'),
('btn_make_route_short', 1, 'Проложить', 'general', 'gen'),
('btn_print', 1, 'Печать', 'general', 'gen'),
('btn_search_again', 1, 'Повторить поиск', 'general', 'gen'),
('cfg_warehouse_address_descr', 1, 'Рекомендуется, если вы предоставляете курьерскую доставку. Эта функция дает быструю возможность построить маршрут от вашего офиса (склада) до клиента. Работает на основе Google Maps. Пример ввода: Москва, Ленинский проспект, 37', 'general', 'gen'),
('cfg_warehouse_address_name', 1, 'Адрес вашего офиса или склада', 'general', 'gen'),
('gerr_geo_bad_key', 1, 'Ключ Google Maps API введен неверно или не соответствует доменному имени, для которого был создан.', 'general', 'gen'),
('gerr_geo_bad_request', 1, 'Ошибка обработки запроса с данными маршрута.', 'general', 'gen'),
('gerr_geo_missing_query', 1, 'Не задан адрес для поиска.', 'general', 'gen'),
('gerr_geo_server_error', 1, 'Произошла неопознанная ошибка обработки запроса на стороне Google Maps.', 'general', 'gen'),
('gerr_geo_unknown_address', 1, 'Указанный адрес не найден на картах Google. Адрес задан неверно или не зарегистрирован в базе данных Google Maps.', 'general', 'gen'),
('gerr_unknown', 1, 'Произошла неопознанная ошибка.', 'general', 'gen'),
('lbl_address_lookup', 1, 'Найти адрес на карте', 'general', 'gen'),
('lbl_edit_details', 1, 'Редактировать заказ', 'back', 'ord'),
('lbl_error', 1, 'Ошибка', 'general', 'gen'),
('lbl_edit_order', 1, 'Редактирование заказа', 'back', 'ord'),
('lbl_lookup', 1, 'Показать на карте', 'general', 'gen'),
('lbl_not_found', 1, 'Не найдено', 'general', 'gen'),
('lbl_route_from', 1, 'Откуда', 'general', 'gen'),
('lbl_route_to', 1, 'Куда', 'general', 'gen'),
('msg_input_addr_from', 1, 'Введите адрес, откуда вы доставляете заказ', 'general', 'gen'),
('lbl_order_dsc_by_amount', 1, 'По сумме заказа', 'general', 'dsc'),
('lbl_order_dsc_by_coupon', 1, 'По сертификату', 'general', 'dsc'),
('lbl_order_dsc_by_orders', 1, 'Накопительная', 'general', 'dsc'),
('lbl_order_dsc_by_usergroup', 1, 'По группе', 'general', 'dsc'),
('lbl_frnt_discount_coupon', 1, 'Сертификат на скидку (если есть)', 'front', 'dsc'),
('lbl_processing_coupon', 1, 'Проверка', 'front', 'dsc'),
('lbl_wrong_coupon', 1, 'Сертификат не найден', 'front', 'dsc'),
('cfg_calc_dsc_max', 1, 'Максимальная из скидок по группе пользователя, накопительной и по сумме заказа плюс скидка по сертификату (скидка по сертификату всегда прибавляется)', 'back', 'dsc'),
('cfg_calc_dsc_summ', 1, 'Как сумму скидок по всем правилам', 'back', 'dsc'),
('discount_coupons', 1, 'Сертификаты на скидку', 'back', 'dsc'),
('err_dc_invalid_code', 1, 'Недопустимый код сертификата', 'back', 'dsc'),
('err_dc_invalid_date', 1, 'Недопустимая дата', 'back', 'dsc'),
('err_dc_invalid_discount_percent', 1, 'Недопустимое значение скидки в процентах', 'back', 'dsc'),
('err_dc_sql_fail', 1, 'Ошибка выполнения SQL-запроса', 'back', 'dsc'),
('lbl_btn_create_coupon', 1, 'Создать', 'back', 'dsc'),
('lbl_by', 1, 'По', 'back', 'dsc'),
('lbl_coupon_code', 1, 'Код сертификата', 'back', 'dsc'),
('lbl_coupon_comment', 1, 'Описание сертификата', 'back', 'dsc'),
('lbl_coupon_discount', 1, 'Скидка', 'back', 'dsc'),
('lbl_coupon_is_active', 1, 'Действующий', 'back', 'dsc'),
('lbl_coupon_not_used', 1, 'не использовался', 'back', 'dsc'),
('lbl_coupon_type', 1, 'Тип', 'back', 'dsc'),
('lbl_coupon_type_multi_use', 1, 'Многоразовый', 'back', 'dsc'),
('lbl_coupon_type_multi_use_expire', 1, 'Многоразовый, истекает', 'back', 'dsc'),
('lbl_coupon_type_multi_use_no_expire', 1, 'Многоразовый, не истекает', 'back', 'dsc'),
('lbl_coupon_type_single_use', 1, 'Одноразовый', 'back', 'dsc'),
('lbl_register_new_customer', 1, 'Зарегистрировать нового покупателя', 'back', 'ord'),
('lbl_create_discount_coupon', 1, 'Создать сертификат', 'back', 'dsc'),
('lbl_dsc_by_amount', 1, 'По сумме текущего заказа', 'back', 'dsc'),
('lbl_dsc_by_coupons', 1, 'сертификатам на скидку', 'back', 'dsc'),
('lbl_dsc_by_orders', 1, 'Накопительные скидки', 'back', 'dsc'),
('lbl_dsc_by_usergroup', 1, 'группе пользователя', 'back', 'dsc'),
('lbl_dsc_order_percent', 1, 'Скидка, %', 'back', 'dsc'),
('lbl_dsc_order_sum', 1, 'Сумма всех заказов (в основной валюте)', 'back', 'dsc'),
('lbl_enable_discounts', 1, 'Включить скидки в магазине', 'back', 'dsc'),
('lbl_expired', 1, 'Истек', 'back', 'dsc'),
('lbl_tune_discounts', 1, 'Настроить скидки', 'back', 'dsc'),
('lbl_used_times', 1, 'раз(а)', 'back', 'dsc'),
('lbl_valid_to', 1, 'Действует до', 'back', 'dsc'),
('msg_dsc_by_amount', 1, 'Поощрите покупателей делать большие заказы &mdash; предложите скидки, если сумма заказа превышает установленную.', 'back', 'dsc'),
('msg_dsc_by_coupons', 1, 'Покупатель получит скидку, если введёт код сертификата на скидку при оформлении заказа.', 'back', 'dsc'),
('msg_dsc_by_orders', 1, 'Скидки для зарегистрированных покупателей, уже оформлявших заказы в вашем интернет-магазине. Скидка рассчитывается исходя из общей суммы всех уже доставленных этому покупателю заказов.', 'back', 'dsc'),
('msg_dsc_by_usergroup', 1, 'Скидки для покупателей вашего интернет-магазина, прошедших регистрацию. Скидка рассчитывается по группе, к которой вы причислите покупателя.', 'back', 'dsc'),
('msg_no_coupons_defined', 1, 'Нет ни одного сертификата на скидку.', 'back', 'dsc'),
('pgn_discount_coupons', 1, 'Сертификаты на скидку', 'back', 'dsc'),
('qst_del_coupons', 1, 'Удалить выбранные сертификаты?', 'back', 'dsc'),
('qst_how_calc_discount', 1, 'Как считать общую скидку, если одновременно действуют несколько правил, определенных выше?', 'back', 'dsc'),
('lbl_search_customer_simple', 1, 'Поиск покупателя по email, логину, фамилии и имени.', 'back', 'ord'),
('cpt_lbl_category_col_count', 1, 'Количество столбцов при отображении категорий', 'general', 'thm'),
('wrn_too_short_string', 1, 'Слишком короткая строка поиска', 'general', 'gen'),
('msg_no_products_found', 1, 'Не найдено ни одного продукта', 'general', 'gen'),
('lbl_please_wait', 1, 'Пожалуйста, подождите', 'general', 'gen'),
('lbl_or', 1, 'или', 'general', 'gen'),
('lbl_n_a', 1, 'нет', 'general', 'gen'),
('lbl_coupon_used', 1, 'Использовался', 'back', 'dsc'),
('lbl_new_address', 1, 'Новый адрес', 'general', 'cmr'),
('msg_no_customer_login', 1, 'Этот пользователь не ввел логин и пароль во время оформления заказа.', 'general', 'cmr'),
('qst_delete_address', 1, 'Удалить адрес?', 'general', 'cmr'),
('lbl_checking_api_key', 1, 'Проверка ключа Google Maps API', 'back', 'gen'),
('lbl_admin_login', 1, 'Вход для администратора', 'front', 'gen'),
('cfg_google_maps_api_key_name', 1, 'Ключ Google Maps API', 'back', 'gen'),
('lbl_enter_gmapi_key', 1, 'Введите ключ Google Maps API для доменного имени, на котором работает магазин', 'back', 'gen'),
('lbl_redirecting_to_pp', 1, 'Переадресация на сервер PayPal...', 'front', 'gen'),
('lbl_redirecting_to_rupay', 1, 'Переадресация на сервер Rupay...', 'front', 'gen'),
('wrn_invalid_google_maps_api_key', 1, 'Неверный ключ Google Maps API.', 'back', 'gen'),
('wrn_no_google_maps_api_key', 1, 'Введите ключ Google Maps API для доменного имени, на котором установлен ваш магазин, чтобы включить возможность просмотра адресов на карте. Вы можете <a href="http://code.google.com/apis/maps/signup.html" target="_blank">зарегистрировать ключ Google Maps API</a> бесплатно на сайте Google.', 'back', 'gen'),
('cfg_google_maps_api_key_descr', 1, 'Введите ключ Google Maps API, если вы хотите включить возможность просмотра адреса покупателя на карте со странице с информацией о заказе. Вы можете бесплатно <a href="http://code.google.com/apis/maps/signup.html" target="_blank">зарегистрировать ключ Google Maps API</a> на сайте Google.', 'back', 'gen'),
('language', 1, 'Язык', 'general', 'gen'),
('catalog', 1, 'Каталог', 'general', 'gen'),
('cataloge', 1, 'Каталог', 'general', 'gen'),
('special_offers', 1, 'Специальные предложения', 'general', 'gen'),
('poll', 1, 'Голосование', 'general', 'gen'),
('currency', 1, 'Валюта', 'general', 'gen'),
('search', 1, 'Поиск', 'general', 'gen'),
('ordr_add_comment_to_message', 1, 'Добавить комментарий в сообщение', 'back', 'gen'),
('btn_export', 1, 'Экспортировать', 'general', 'gen'),
('export_orderlist_to_csv', 1, 'Экспортировать эти заказы в CSV-файл (MS Excel, OpenOffice)', 'general', 'gen'),
('lbl_order_status_history_url', 1, 'Вы можете <a href="{URL}">посмотреть статус вашего заказа</a> и историю его обработки онлайн.', 'general', 'gen'),
('msg_n_customers_found', 1, 'Найдено покупателей: {N}', 'back', 'gen'),
('msg_n_orders_found', 1, 'Найдено заказов: {N}', 'back', 'gen'),
('msg_orders_exported_to_file', 1, 'Список заказов экспортирован в CSV-файл.', 'general', 'gen'),
('pgn_order_status', 1, 'Статус заказа', 'general', 'gen'),
('srep_alltime_info', 1, 'Всего {N} отгруженых заказов на сумму {M}', 'back', 'rep'),
('rep_add2cart_count', 1, 'Добавлен в корзину', 'back', 'rep'),
('prdset_meta_title', 1, 'Заголовок страницы', 'back', 'gen'),
('prdset_move_selected_to', 1, 'Переместить выбранные продукты в', 'back', 'gen'),
('aux_page_slug', 1, 'ID страницы (часть URL; используется в ссылках на эту страницу)', 'back', 'gen'),
('email_add_order_note_subject', 1, 'Информация по вашему заказу (#{ORDERID})', 'general', 'gen'),
('email_add_order_note_text', 1, 'Информация по вашему заказу #{ORDERID}', 'general', 'gen'),
('ordr_source_backend', 1, 'Администрирование', 'back', 'ord'),
('prdopt_manage_product_options', 1, 'Добавить/удалить доп. характеристики', 'back', 'gen'),
('str_drag_and_drop_to_change_order', 1, 'Перетаскивайте мышью для изменения порядка.', 'general', 'gen'),
('str_first_image_is_main', 1, 'Первое изображение в списке — основное.', 'general', 'gen'),
('subcategories_delimiter', 1, 'Разделитель в списке подкатегорий', 'general', 'gen'),
('subcategories_numberlimit', 1, 'Ограничить количество выводимых подкатегорий (укажите до скольки подкатегорий показывать; 0 — неограничено)', 'general', 'gen'),
('ordr_full_info_description', 1, '<p>Чтобы посмотреть более подробную информацию о заказе, <strong>введите вашу фамилию</strong> (требуется для идентификации): </p>', 'general', 'gen'),
('ordr_check_status', 1, 'Проверить статус', 'general', 'gen'),
('ordr_show_details', 1, 'Показать информацию о заказе', 'general', 'gen'),
('btn_add_note', 1, 'Добавить комментарий...', 'general', 'gen'),
('str_order_not_found', 1, 'Заказ не найден', 'general', 'gen'),
('err_wrong_last_name', 1, 'Неверная фамилия', 'general', 'gen'),
('str_move_to', 1, 'Переместить в', 'general', 'gen'),
('cfg__frontend_time_zone_descr', 1, 'Укажите часовой пояс, согласно которому будет отображаться время в пользовательской части интернет-магазина. Пересчет будет производится относительно часового пояса сервера, который указывается в настройках WebAsyst Installer.<br />Настройка влияет только на пользовательскую часть. В режиме администрирования время отображается согласно часовому поясу, установленному в личных настройках пользователя (администратора).', 'back', 'cfg'),
('cfg__frontend_time_zone_dst_descr', 1, '&nbsp;', 'back', 'cfg'),
('cfg_enable_product_sku_description', 1, 'Артикул, если он введен в свойствах продукта, используется для более удобного поиска и управления продуктами в администрировании. Если вы включите эту опцию, артикул будет также отображаться в пользовательской части вашего интернет-магазина.', 'back', 'cfg'),
('cfg_enable_product_sku_title', 1, 'Показывать артикул продукта в пользовательской части', 'back', 'cfg'),
('cfg_frontend_time_zone', 1, 'Часовой пояс интернет-магазина', 'back', 'cfg'),
('cfg_frontend_time_zone_dst', 1, 'Переход на летнее время', 'back', 'cfg'),
('cfg_ga_js_custom_se', 1, 'Дополнить код Google Analytics', 'back', 'cfg'),
('cfg_ga_js_custom_se_description', 1, 'Здесь вы можете указать произвольный код JavaScript, который будет добавлен в основной код Google Analytics (например, код, <a href="http://www.google.com/support/analytics/bin/answer.py?hl=ru&answer=57046" target="_blank">описывающий дополнительные поисковые системы</a> в отчетах о переходах).', 'back', 'cfg'),
('cfg_picture_resize_quality_description', 1, 'При загрузке изображений продуктов автоматически (с помощью библиотеки GD) создаются их уменьшенные копии и сохраняются в виде JPEG-файлов. Укажите качество изображений: 0 — меньше качество, меньше размер файла; 100 — выше качество, больше размер файла. Рекомендуемое значение — 80.', 'back', 'cfg'),
('cfg_picture_resize_quality_title', 1, 'Качество изображений продуктов после уменьшения размера (0 — хуже, 100 — лучше)', 'back', 'cfg'),
('cpt_lbl_request_product_count', 1, 'Запрашивать количество продуктов для добавления в корзину', 'back', 'cpt'),
('goto_shopping', 1, '&laquo; вернуться к покупкам', 'general', 'gen'),
('lbl_follow_link', 1, 'Перейдите по ссылке:', 'general', 'gen'),
('loc_change_default_description', 1, '<strong><span style="color: red;">ВАЖНО:</span> Убедитесь, что вы перевели все данные на новый основной язык!</strong> Если перевод на новый язык, который вы выберите основным, не полный, то как в администрировании, так и в пользовательской части непереведенная информация (интерфейс, информация о продуктах и т.д.) будет показана некорректно (будут показаны либо пустые поля, либо ID строк).', 'back', 'loc'),
('loc_lang_direction', 1, 'Направление текста', 'back', 'loc'),
('loc_lang_ltr_descr', 1, 'Направление текста: LTR (слева направо) или RTL (справа налево).', 'back', 'gen'),
('loc_lang_ltr_disabled', 1, 'RTL', 'back', 'loc'),
('loc_lang_ltr_enabled', 1, 'LTR', 'back', 'loc'),
('prdimport_csv_use_structure', 1, 'Поиск соответствий продуктов в файле и базе данных осуществлять с учетом категорий (поиск только внутри категории)', 'back', 'imm'),
('prdimport_source_column', 1, 'Колонки в CSV-файле', 'back', 'imm'),
('prdimport_target_column', 1, 'Поля в базе данных', 'back', 'imm'),
('prdimport_found_n_columns', 1, 'В CSV-файле найдено %d колонок', 'back', 'imm'),
('imm_upload_link', 1, 'Загрузить по одному', 'back', 'imm'),
('imm_upload_swf_link', 1, 'Загрузить много изображений', 'back', 'imm'),
('imm_images_count_info', 1, 'Изображения: %d &mdash; %d из %d', 'back', 'imm'),
('imm_view_mode', 1, 'Вид', 'back', 'imm'),
('imm_view_mode_list', 1, 'списком', 'back', 'imm'),
('imm_view_mode_thumbnails', 1, 'эскизами', 'back', 'imm'),
('prdcat_product_n_duplicated', 1, 'Создано %d продуктов-дубликатов', 'back', 'prd'),
('prdcart_products_duplicate_selected', 1, 'Создать дубликаты', 'back', 'prd'),
('cpt_lbl_block_height', 1, 'Высота элемента li, в котором отображается продукт, в пикселях (оставьте пустым для автоматического расчета) ', 'general', 'cfg'),
('welcome_to_storefront', 1, 'Интернет-магазин ', 'general', 'gen'),
('powered_by', 1, 'Работает на основе <a href="http://www.shop-script.ru/" style="font-weight: normal">скрипта интернет-магазина</a> <em>WebAsyst Shop-Script</em>', 'hidden', 'gen'),
('powered_by_text', 1, 'Работает на основе <em>WebAsyst Shop-Script</em>', 'hidden', 'gen'),
('imm_del_confirmation', 1, 'Вы уверены?', 'general', 'gen'),
('lbl_redirecting_to_idealbasic', 1, 'Сейчас Вы будете перенаправлены на сайт IdealBasic...', 'front', 'gen'),
('lsgr_printforms', 1, 'Печатные формы', 'general', 'gen'),
('printforms_full_description', 1, 'Настройка сопроводительных документов к заказам (счета, квитанции и т.п.).', 'general', 'gen'),
('printforms_setup', 1, 'Настройки', 'general', 'gen'),
('printforms_preview', 1, 'Образец', 'general', 'gen'),
('pgn_printforms', 1, 'Печатные формы', 'general', 'gen'),
('print_form', 1, 'Печатная форма', 'general', 'gen'),
('print_forms', 1, 'Печатные формы', 'general', 'gen'),
('print_form_not_found', 1, 'Печатная форма не установлена', 'general', 'gen'),
('btn_open_invoice', 1, 'Версия для печати', 'general', 'gen'),
('prdcat_products_duplicate_selected', 1, 'Создать дубликат(ы)', 'general', 'gen'),
('imm_modify_time', 1, 'Изменен', 'general', 'gen'),
('demoprd_name', 1, 'Демо-продукт', 'general', 'gen'),
('cpt_lbl_authorization', 1, 'Авторизация', 'general', 'gen'),
('cpt_lbl_category_info', 1, 'Информация о категории', 'general', 'gen'),
('ord_bill_to', 1, 'Плательщик', 'general', 'gen'),
('ord_date_paid', 1, 'Оплачено', 'general', 'gen'),
('pmnt_empty_name', 1, 'Введите название способа оплаты', 'back', 'ord'),
('prd_multiply_label', 1, 'Умножить все цены на', 'back', 'prd'),
('prd_price_multiply', 1, 'Умножить', 'back', 'prd'),
('pgn_google_sitemap', 1, 'Sitemaps', 'general', 'gen'),
('sitemap_full_description', 1, '<strong>Sitemaps</strong> — это XML-файл с информацией для поисковых систем (таких как Google, Yahoo, Ask.com, MSN, Яндекс) о страницах веб-сайта, которые подлежат индексации. Sitemaps может помочь поисковикам определить местонахождение страниц сайта, время их последнего обновления, частоту обновления и важность относительно других страниц сайта для того, чтобы поисковая машина смогла более разумно индексировать сайт. Подробнее о Sitemaps — в <a href="http://ru.wikipedia.org/wiki/Sitemaps" target="_blank">статье на Википедии</a> (в статье можно найти информацию о том, как добавить файл Sitemaps в различные поисковые системы).', 'general', 'gen'),
('sitemap_url', 1, 'Адрес основного файла Sitemaps', 'general', 'gen'),
('sitemap_update_title', 1, 'Обновить Sitemaps XML-файл', 'general', 'gen'),
('sitemap_name', 1, 'Основные разделы файла Sitemaps', 'general', 'gen'),
('sitemap_base_url', 1, 'Адрес главной страницы интернет-магазина', 'general', 'gen'),
('sitemap_index_description', 1, 'Основная структура интернет-магазина', 'general', 'gen'),
('sitemap_pagename', 1, 'Информационные страницы', 'general', 'gen'),
('btn_create', 1, 'Создать', 'general', 'gen'),
('sitemap_update_date', 1, 'Обновлен', 'general', 'gen'),
('print_form_edit_title', 1, 'Двойной клик для редактирования', 'general', 'gen'),
('ordsts_predefined_title', 1, 'Предустановленные статусы заказов', 'back', 'ord'),
('ordsts_predefined_description_1', 1, 'Отмененные заказы', 'back', 'ord'),
('ordsts_predefined_description_2', 1, 'Новые заказы', 'back', 'ord'),
('ordsts_predefined_description_3', 1, 'Заказы, принятые в обработку', 'back', 'ord'),
('ordsts_predefined_description_5', 1, 'Успешно выполненные заказы', 'back', 'ord'),
('ordsts_predefined_description_14', 1, 'Заказы, оплата по которым успешно авторизована<br />(только для заказов по кредитным картам)', 'back', 'ord'),
('ordsts_predefined_description_15', 1, 'Заказы, по которым произведен возврат денег', 'back', 'ord'),
('ord_ship_to', 1, 'Получатель', 'general', 'gen'),
('str_logo', 1, 'Адрес (URL) файла логотипа (не обязательно)', 'general', 'gen'),
('cfg_prdpict_enlarged_size_title', 1, 'Уменьшать оригинальное (самое большое) загружаемое изображение продукта', 'back', 'cfg'),
('cfg_prdpict_enlarged_size_description', 1, 'Введите размер в пикселях, к которому будут приведены оригиналы загружаемых изображений (рекомендуемое значение: 600) или оставьте поле пустым, чтобы не изменять оригиналы.', 'back', 'cfg'),
('sr_please_contact_seller', 1, 'Точная стоимость доставки не расчитана', 'general', 'gen'),
('print_form_address_not_found', 1, 'Адрес не найден на карте. Уточните адрес и повторите поиск.', 'general', 'gen'),
('print_form_edit_before_print', 1, 'Корректировка перед печатью', 'general', 'gen'),
('pgn_social_networks', 1, 'Соцсети', 'back', 'gen'),
('social_networks_page_description', 1, 'Shop-Script интегрирован с социальными сетями «Вконтакте» и «Фейсбук». Интеграция заключается в возможности разместить ваш интернет-магазин (продукты) внутри социальной сети и принимать заказы непосредственно из сети сразу в ваш магазин.', 'back', 'gen'),
('social_networks_hint_title', 1, 'Дополнительно', 'back', 'gen'),
('social_networks_hint', 1, 'Предложенные выше методы позволяют интегрировать магазин с соцсетями в направлении «соцсеть &rarr; магазин». В дополнение к такой интеграции рекомендуем «включить» интеграцию в обратном направлении «магазин → соцсеть», разместив в на страницах основной витрины магазина: 1) ссылки на страницы (группы) вашего магазина в соцсетях, 2) кнопки Like, «Мне нравится» и подобные на страницах продуктов. Это можно сделать с помощью редактора дизайна (см. ссылки на инструкции по интеграции с соцсетями выше).', 'back', 'gen'),
('powered_by_external', 1, 'Работает на основе <a href="http://www.shop-script.ru/" style="font-weight: normal" target="_blank">скрипта интернет-магазина</a> <em>WebAsyst Shop-Script</em>', 'hidden', 'gen'),
('prdset_vkontakte_update_date', 1, 'Последний экспорт во «Вконтакт»', 'back', 'prd'),
('prdcat_vkontakte_change', 1, 'Экспорт во «Вконтакт»', 'back', 'prd');
INSERT INTO `SC_local` (`id`, `lang_id`, `value`, `group`, `subgroup`) VALUES
('prdcat_vkontakte_remove', 1, 'Удалить из каталога «Вконтакта»', 'back', 'prd'),
('prdcat_social_networks_export', 1, 'Вконтакте', 'back', 'prd'),
('prdcat_vkontakte_category_type', 1, 'Раздел каталога продуктов «Вконтакта», в который экспортировать продукты этой категории', 'back', 'prd'),
('str_printforms_logo', 1, 'Логотип для печатных форм', 'back', 'gen'),
('prdset_1c_sync', 1, 'CommerceML-идентификатор', 'back', 'gen'),
('str_no_result', 1, 'Отсутствует', 'back', 'gen'),
('pgn_1c', 1, '1C', 'back', 'gen'),
('pmnt_more_modules_available', 1, '<strong>ЕЩЕ МОДУЛИ</strong>: На сайте Shop-Script доступны для загрузки <a href="http://www.shop-script.ru/features/integrations.html">дополнительные модули</a> приема платежей по банковским картам.', 'back', 'gen'),
('demoprd_description', 1, 'Описание продукта будет здесь', 'general', 'prd'),
('demoprd', 1, 'Демо-продукт', 'general', 'prd'),
('pgn_user_contactinfo', 1, 'Контактная информация', 'general', 'gen'),
('pgn_user_addressbook', 1, 'Адресная книга', 'general', 'gen'),
('pgn_user_orders', 1, 'История заказов', 'general', 'gen'),
('pgn_user_affiliate', 1, 'Партнерская программа', 'general', 'gen'),
('cpt_lbl_show_sub_category', 1, 'Показывать подкатегории', 'general', 'thm'),
('pgn_ap_6', 1, 'Tаблица размеров', 'hidden', 'lsg'),
('sizetable', 1, 'таблица размеров', 'general', 'gen'),
('pgn_ap_5', 1, 'Контакты', 'hidden', 'lsg'),
('home_text', 1, '<p>\r\n<p>\r\n<p style="color:#cc0000;"><b>ВНИМАНИЕ &mdash; <a href="http://dancelife-shop.ru/auxpage_sale/" style="color:red;">РАСПРОДАЖА!!!</a> ЭКОНОМИЯ ДО 42%</b></p>\r\n<p>\r\n<p>МЫ ГОТОВЫ К НОВОМУ СЕЗОНУ ВМЕСТЕ С ВАМИ!</p>\r\n<p>С 1 августа по 1 сентября 2014 года, на весь ассортимент продукции, действует специальная, предсезонная 10% скидка, а так же наша постоянная скидка для педагогов. Введите в поле, Сертификат на скиду, кодовое слово  &mdash; <a href="http://www.dancelife-shop.ru/" style="color:red;">DL10</a> и скидка Ваша!</p> \r\n<p>\r\n<p>Уже в продаже &mdash; <a href="http://www.dancelife-shop.ru/category/latina-women/" style="color:red;">SL!M SERIES!</a>\r\n<p>\r\n<p>Костюмы, куртки, поло, халаты смотри в разделе &mdash; <a href="http://www.dancelife-shop.ru/category/aksessuary/" style="color:red;">АКСЕССУАРЫ</a>\r\n<p>\r\n<p>Добро пожаловать в Интернет-магазин DANCELIFE-SHOP!</p> \r\n<p>\r\n\r\n\r\n\r\n\r\n', 'general', 'gen'),
('pgn_ap_4', 1, 'О компании', 'hidden', 'lsg'),
('slogan', 1, 'Профессиональная обувь и аксессуары для танцев', 'general', 'gen'),
('copy', 1, '&copy; 2011 - 2015 DANCELIFE. Разработка Интернет-магазина &mdash; <a href="http://www.vip-design.ru" style="color:white;">VIP DESIGN</a>', 'general', 'gen'),
('banner', 1, '<a href="http://www.dancelife-ee.ru" target="_blank"><img src="/bnnr/ee.jpg" alt="" width="140" height="140" border="0"></a>', 'general', 'gen'),
('pgn_ap_7', 1, 'SLIM SERIES', 'hidden', 'lsg'),
('pgn_ap_2', 1, 'Доставка и оплата', '', ''),
('phone', 1, '<strong><span>(495)</span> 517-48-11</strong><br><a href="/auxpage_dostavka-i-oplata/"><span>Бесплатная</span> доставка по Москве</a>', 'general', 'gen'),
('pgn_ap_8', 1, 'Распродажа', 'hidden', 'lsg');

-- --------------------------------------------------------

--
-- Структура таблицы `SC_localgroup`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_localgroup`;
CREATE TABLE IF NOT EXISTS `SC_localgroup` (
  `key` varchar(3) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT '',
  `hidden` tinyint(1) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_localgroup`
--

INSERT INTO `SC_localgroup` (`key`, `name`, `hidden`) VALUES
('hid', 'hidden', 1),
('fro', 'frontend', 0),
('gen', 'general', 0),
('bac', 'backend', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `SC_modules`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_modules`;
CREATE TABLE IF NOT EXISTS `SC_modules` (
  `ModuleID` int(10) unsigned NOT NULL,
  `ModuleVersion` float NOT NULL DEFAULT '0',
  `ModuleClassName` varchar(30) NOT NULL DEFAULT '',
  `ModuleClassFile` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_modules`
--

INSERT INTO `SC_modules` (`ModuleID`, `ModuleVersion`, `ModuleClassName`, `ModuleClassFile`) VALUES
(1, 1, 'test', '/test/class.test.php'),
(2, 1, 'products', '/products/class.products.php'),
(3, 1, 'news', '/news/class.newsmodule.php'),
(4, 1, 'poll', '/poll/class.poll.php'),
(5, 1, 'cart', '/cart/class.cart.php'),
(6, 1, 'affiliateprogram', '/affiliate_program/class.affiliate_program.php'),
(7, 1, 'ordering', '/ordering/class.ordering.php'),
(8, 1, 'pricelist', '/products/pricelist/class.pricelist.php'),
(9, 1, 'feedback', '/feedback/class.feedback.php'),
(10, 1, 'linkexchange', '/linkexchange/class.linkexchange.php'),
(11, 1, 'export2froogle', '/products/export2froogle/class.export2froogle.php'),
(12, 1, 'yandexmarket', '/products/yandex.market/class.yandexmarket.php'),
(13, 1, 'auxpages', '/auxpages/class.auxpages.php'),
(24, 1, 'smsordernotify', '/ordering/smsmail/class.smsordernotify.php'),
(15, 1, 'users', '/users/class.users.php'),
(16, 1, 'divisionsadministration', '/divisions/administration/class.divisionsadministration.php'),
(17, 1, 'sc_abstract', '/abstract/class.abstract.php'),
(18, 1, 'moduleadmin', '/modules/module_admin/class.moduleadmin.php'),
(25, 1, 'localizationadmin', '/localization/class.localizationadmin.php'),
(26, 1, 'localization', '/localization/class.localization.php'),
(27, 1, 'adminscreens', '//adminscreens//class.adminscreens.php'),
(28, 1, 'wgtmanager', '//wgtmanager//class.wgtmanager.php'),
(29, 1, 'cptmanager', '//cptmanager//class.cptmanager.php'),
(30, 0.1, 'discount_coupons', '/discount_coupons/class.discount_coupons.php'),
(31, 0.1, 'order_editor', '/order_editor/class.order_editor.php'),
(32, 0.1, 'Configuration', '/configuration/class.configuration.php'),
(33, 0.1, 'order_creater', '/order_editor/class.order_creater.php'),
(34, 1, 'ExportTo1c', '/products/exportto1c/class.exportto1c.php');

-- --------------------------------------------------------

--
-- Структура таблицы `SC_module_configs`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_module_configs`;
CREATE TABLE IF NOT EXISTS `SC_module_configs` (
  `ModuleConfigID` int(10) unsigned NOT NULL,
  `ModuleID` int(10) unsigned NOT NULL DEFAULT '0',
  `ConfigKey` varchar(30) NOT NULL DEFAULT '',
  `ConfigTitle` varchar(50) NOT NULL DEFAULT '',
  `ConfigDescr` varchar(100) NOT NULL DEFAULT '',
  `ConfigInit` smallint(5) unsigned NOT NULL DEFAULT '0',
  `ConfigEnabled` tinyint(1) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_module_configs`
--

INSERT INTO `SC_module_configs` (`ModuleConfigID`, `ModuleID`, `ConfigKey`, `ConfigTitle`, `ConfigDescr`, `ConfigInit`, `ConfigEnabled`) VALUES
(1, 1, 'wrapper', '', 'Работа со старыми модулями', 1002, 1),
(2, 2, 'Products', '', 'работа с продуктами', 1002, 1),
(3, 3, 'news', '', '', 1002, 1),
(4, 4, 'poll', '', 'Poll', 1002, 1),
(5, 5, 'Корзина', '', '', 1002, 1),
(6, 6, 'affiliate_program', '', 'Партнерская программа', 1002, 1),
(7, 7, 'Ordering', '', 'Оформление заказа', 1002, 1),
(24, 8, 'Pricelist', '', '', 1002, 1),
(12, 9, 'feedback', '', 'Обратная связь', 1002, 1),
(13, 10, 'linkexchange', '', 'Обмен ссылками', 1002, 1),
(14, 11, 'export2froogle', '', 'Эксопорт списка товаров во Froogle(www.froogle.com)', 1002, 1),
(15, 12, 'yandex_market', '', '', 1002, 1),
(16, 13, 'aux_pages', '', '', 1002, 1),
(22, 16, 'DivisionsAdministration', '', '', 1002, 1),
(21, 15, 'Users', '', '', 1002, 1),
(41, 25, 'localizationadmin', 'Управление локализациями', '', 1002, 1),
(25, 17, 'Abstract', '', '', 1002, 1),
(27, 18, 'ModuleAdmin', '', '', 1002, 1),
(40, 24, 'smsordernotify', 'Информирование о новых зак', '', 1002, 1),
(42, 26, 'localization', 'Локализация', '', 1001, 1),
(48, 27, 'adminscreens', 'Admin screens', '', 1002, 1),
(51, 29, 'cptmanager', 'Component manager', '', 1002, 1),
(52, 30, 'discount_coupons', '', 'Coupons', 1002, 1),
(53, 31, 'order_editor', '', 'Editor', 1002, 1),
(54, 32, 'configuration', '', 'Config', 1002, 1),
(55, 33, 'order_creater', '', 'Creater', 1002, 1),
(56, 34, 'exportto1c', '', '', 1002, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `SC_news_table`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_news_table`;
CREATE TABLE IF NOT EXISTS `SC_news_table` (
  `NID` int(11) NOT NULL,
  `add_date` varchar(30) DEFAULT NULL,
  `title_ru` text,
  `picture` varchar(30) DEFAULT NULL,
  `textToPublication_ru` text,
  `textToMail` text,
  `add_stamp` int(11) DEFAULT NULL,
  `priority` int(10) unsigned NOT NULL DEFAULT '0',
  `emailed` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_news_table`
--

INSERT INTO `SC_news_table` (`NID`, `add_date`, `title_ru`, `picture`, `textToPublication_ru`, `textToMail`, `add_stamp`, `priority`, `emailed`) VALUES
(2, '08.10.2012 19:55:04', '', NULL, '<p>test test test</p>', '', 1349711744, 0, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `SC_ordered_carts`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Авг 24 2015 г., 13:09
--

DROP TABLE IF EXISTS `SC_ordered_carts`;
CREATE TABLE IF NOT EXISTS `SC_ordered_carts` (
  `itemID` int(11) NOT NULL DEFAULT '0',
  `orderID` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `Price` float DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `tax` float DEFAULT NULL,
  `load_counter` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_ordered_carts`
--

INSERT INTO `SC_ordered_carts` (`itemID`, `orderID`, `name`, `Price`, `Quantity`, `tax`, `load_counter`) VALUES
(17, 1, '[12625] 12625 (6.5)', 3850, 1, 0, 0),
(18, 2, '[00202] 00202 (10)', 5500, 2, 0, 0),
(19, 3, '[00202] 00202 Мужская обувь Стандарт (5)', 5500, 3, 0, 0),
(20, 4, '[13632] 13632 Женская обувь Латина (5.5)', 3850, 1, 0, 0),
(21, 5, '[11535] 11535 Женская обувь Латина (2)', 3850, 1, 0, 0),
(22, 6, '[92302] 92302 Мужская обувь Латина (5)', 4950, 1, 0, 0),
(23, 7, '[49000] 49000 Другие направления (8)', 3850, 1, 0, 0),
(24, 8, '[49000] 49000 Другие направления (8)', 3850, 1, 0, 0),
(25, 9, '[90302] 90302 Мужская обувь Латина (6.5)', 5720, 1, 0, 0),
(26, 10, '[1134] 1134 Детская обувь (2.5)', 2500, 1, 0, 0),
(27, 11, '[1133] 1133 Детская обувь (1.5)', 2500, 1, 0, 0),
(28, 11, '[2020] 2020 Детская обувь (1.5)', 2500, 1, 0, 0),
(29, 12, '[16735] 16735 Женская обувь Латина (5)', 4180, 1, 0, 0),
(30, 13, '[27667] 27667 Женская обувь Стандарт (5.5)', 4180, 1, 0, 0),
(31, 13, '[27667] 27667 Женская обувь Стандарт (5)', 4180, 1, 0, 0),
(32, 14, '[shoebrushes_ESBOR] Щетка для обуви ESBOR', 340, 1, 0, 0),
(33, 15, '[27567] 27567 Женская обувь Стандарт (7)', 4180, 2, 0, 0),
(34, 16, '[nak_latina] Накаблучники Латина HPL', 300, 1, 0, 0),
(37, 17, '[13732] 13732 Женская обувь Латина (4.5)', 3850, 1, 0, 0),
(39, 18, '[13635] 13635 Женская обувь Латина (4)', 4180, 1, 0, 0),
(40, 19, '[95302] 95302 Мужская обувь Латина (6.5)', 5720, 1, 0, 0),
(41, 19, '[00202] 00202 Мужская обувь Стандарт (6.5)', 5500, 1, 0, 0),
(42, 20, '[1133] 1133 Детская обувь (2.5)', 2500, 1, 0, 0),
(43, 21, '[2022] 2022 Детская обувь (C12)', 2500, 1, 0, 0),
(44, 21, '[2022] 2022 Детская обувь (C13)', 2500, 1, 0, 0),
(45, 22, '[90302] 90302 Мужская обувь Латина (10.5)', 5720, 1, 0, 0),
(46, 23, '[49500] 49500 Другие направления (6.5)', 3850, 1, 0, 0),
(47, 24, '[16675] 16675 Женская обувь Латина (4.5)', 4180, 1, 0, 0),
(48, 24, '[00202] 00202 Мужская обувь Стандарт (8.5)', 5500, 1, 0, 0),
(49, 24, '[nak_latina] Накаблучники Латина HPL', 300, 1, 0, 0),
(50, 25, '[90302] 90302 Мужская обувь Латина (8)', 5720, 1, 0, 0),
(51, 26, '[25567] 25567 Женская обувь Стандарт (6)', 4000, 1, 0, 0),
(52, 26, '[nak_standart] Накаблучники Стандарт HPB', 300, 1, 0, 0),
(53, 27, '[16735] 16735 Женская обувь Латина (7)', 4300, 1, 0, 0),
(54, 27, '[49000] 49000 Другие направления (7)', 4000, 1, 0, 0),
(55, 28, '[16675] 16675 Женская обувь Латина (7)', 4300, 1, 0, 0),
(56, 28, '[16675] 16675 Женская обувь Латина (7.5)', 4300, 1, 0, 0),
(57, 28, '[16675] 16675 Женская обувь Латина (8)', 4300, 1, 0, 0),
(58, 29, '[25567] 25567 Женская обувь Стандарт (6.5)', 4000, 1, 0, 0),
(59, 30, '[11735] 11735 Женская обувь Латина (6.5)', 4000, 1, 0, 0),
(62, 31, '[nak_standart] Накаблучники Стандарт HPB', 300, 2, 0, 0),
(63, 32, '[11635] 11635 Женская обувь Латина (3.5)', 4000, 1, 0, 0),
(64, 33, '[25667] 25667 Женская обувь Стандарт (5.5)', 4000, 1, 0, 0),
(65, 34, '[00222] 00222 Мужская обувь Стандарт (8)', 5600, 1, 0, 0),
(66, 35, '[00222] 00222 Мужская обувь Стандарт (9.5)', 5600, 1, 0, 0),
(67, 36, '[95302_no_print] 95302 (no print) Мужская Латина (8.5)', 5800, 1, 0, 0),
(71, 37, '[25667] 25667 Женская обувь Стандарт (5)', 4000, 1, 0, 0),
(72, 37, '[11535] 11535 Женская обувь Латина (5)', 4000, 1, 0, 0),
(73, 37, '[13533] 13533 Женская обувь Латина (5)', 4000, 1, 0, 0),
(74, 38, '[92302] 92302 Мужская обувь Латина (7.5)', 5600, 1, 0, 0),
(75, 38, '[00222] 00222 Мужская обувь Стандарт (7.5)', 5600, 1, 0, 0),
(76, 39, '[25567] 25567 Женская обувь Стандарт (6.5)', 4000, 1, 0, 0),
(77, 39, '[nak_standart] Накаблучники Стандарт HPB', 300, 1, 0, 0),
(78, 40, '[63608] 63608 Другие направления (6.5)', 4300, 1, 0, 0),
(79, 40, '[63668] 63668 Другие направления (6.5)', 4000, 1, 0, 0),
(80, 41, '[13632] 13632 Женская обувь Латина (4.5)', 4000, 1, 0, 0),
(81, 41, '[14735s] 14735s Женская обувь Латина (4.5)', 4300, 1, 0, 0),
(82, 42, '[shoebrushes_ESBOR] Щетка для обуви ESBOR', 350, 1, 0, 0),
(83, 43, '[27567] 27567 Женская обувь Стандарт (7)', 4300, 1, 0, 0),
(84, 44, '[95302_no_print] 95302 (no print) Мужская Латина (10.5)', 5800, 1, 0, 0),
(85, 45, '[17739] 17739 Женская обувь Латина (6.5)', 4000, 1, 0, 0),
(86, 45, '[nak_latina] Накаблучники Латина HPL', 300, 1, 0, 0),
(87, 46, '[49000] 49000 Другие направления (4.5)', 4000, 1, 0, 0),
(88, 47, '[11935] 11935 Женская обувь Латина (3.5)', 4000, 1, 0, 0),
(89, 47, '[11605] 11605 Женская обувь Латина (4)', 4300, 1, 0, 0),
(90, 47, '[11735] 11735 Женская обувь Латина (3.5)', 4000, 1, 0, 0),
(93, 48, '[27667] 27667 Женская обувь Стандарт (5.5)', 4300, 2, 0, 0),
(94, 48, '[nak_standart] Накаблучники Стандарт HPB', 300, 1, 0, 0),
(95, 49, '[1135] 1135 Детская обувь (3)', 2600, 1, 0, 0),
(96, 50, '[27567] 27567 Женская обувь Стандарт (6)', 4300, 1, 0, 0),
(97, 51, '[13634s] 13634s Женская обувь Латина (6)', 4300, 1, 0, 0),
(98, 52, '[1133] 1133 Детская обувь (2)', 2600, 1, 0, 0),
(99, 53, '[1135] 1135 Детская обувь (3.5)', 2600, 2, 0, 0),
(100, 54, '[25567] 25567 Женская обувь Стандарт (6)', 4000, 1, 0, 0),
(101, 55, '[98302] 98302 Мужская обувь Латина (10.5)', 5800, 1, 0, 0),
(102, 56, '[00222] 00222 Мужская обувь Стандарт (8.5)', 5600, 1, 0, 0),
(103, 57, '[14605s] 14605s Женская обувь Латина (4)', 4300, 1, 0, 0),
(104, 58, '[25567] 25567 Женская обувь Стандарт (6)', 4000, 2, 0, 0),
(105, 59, '[27667] 27667 Женская обувь Стандарт (6)', 4300, 1, 0, 0),
(106, 59, '[13732] 13732 Женская обувь Латина (6)', 4000, 1, 0, 0),
(107, 60, '[00222] 00222 Мужская обувь Стандарт (8.5)', 5600, 1, 0, 0),
(108, 61, '[12625] 12625 Женская обувь Латина (5)', 4300, 1, 0, 0),
(109, 62, '[00222] 00222 Мужская обувь Стандарт (8.5)', 5600, 1, 0, 0),
(110, 63, '[1135] 1135 Детская обувь (5)', 2600, 1, 0, 0),
(112, 64, '[13633] 13633 Женская обувь Латина (6)', 4000, 1, 0, 0),
(113, 65, '[1135] 1135 Детская обувь (4.5)', 2600, 1, 0, 0),
(114, 66, '[11535] 11535 Женская обувь Латина (4)', 4000, 1, 0, 0),
(115, 66, '[nak_latina] Накаблучники Латина HPL', 300, 1, 0, 0),
(116, 67, '[11502] 11502 Женская обувь Латина (5)', 4000, 1, 0, 0),
(117, 67, '[11502] 11502 Женская обувь Латина (5.5)', 4000, 1, 0, 0),
(118, 67, '[13533] 13533 Женская обувь Латина (5)', 4000, 1, 0, 0),
(119, 67, '[18533s] 18533s Женская обувь Латина (5)', 4300, 1, 0, 0),
(120, 67, '[18833s] 18833s Женская обувь Латина (5.5)', 4300, 1, 0, 0),
(121, 68, '[shoebrushes_ESBOR] Щетка для обуви ESBOR', 350, 1, 0, 0),
(122, 69, '[shoebrushes_ESBOR] Щетка для обуви ESBOR', 350, 2, 0, 0),
(123, 70, '[27667] 27667 Женская обувь Стандарт (5.5)', 6200, 1, 0, 0),
(124, 70, '[nak_standart] Накаблучники Стандарт HPB', 300, 1, 0, 0),
(125, 71, '[13633] 13633 Женская обувь Латина (5.5)', 6800, 2, 0, 0),
(126, 72, '[24667] 24667 Женская обувь Стандарт (5)', 7400, 1, 0, 0),
(127, 73, '[2020] 2020 Детская обувь (4)', 5700, 1, 0, 0),
(128, 74, '[24667] 24667 Женская обувь Стандарт (5)', 7400, 1, 0, 0),
(129, 75, '[13632] 13632 Женская обувь Латина (5.5)', 6800, 1, 0, 0),
(130, 75, '[nak_latina] Накаблучники Латина HPL', 100, 1, 0, 0),
(131, 76, '[27667] 27667 Женская обувь Стандарт (6.5)', 7400, 1, 0, 0),
(132, 76, '[nak_latina] Накаблучники Латина HPL', 300, 1, 0, 0),
(133, 77, '[shoebrushes_ESBOR] Щетка для обуви ESBOR', 350, 1, 0, 0),
(134, 78, '[nak_standart] Накаблучники Стандарт HPB', 300, 1, 0, 0),
(135, 78, '[25667] 25667 Женская обувь Стандарт (7)', 5400, 1, 0, 0),
(136, 79, '[00202] 00202 Мужская обувь Стандарт (8.5)', 7100, 1, 0, 0),
(137, 80, '[27567] 27567 Женская обувь Стандарт (4.5)', 5900, 1, 0, 0),
(138, 80, '[shoebrushes_ESBOR] Щетка для обуви ESBOR', 350, 1, 0, 0),
(139, 80, '[nak_standart] Накаблучники Стандарт HPB', 300, 2, 0, 0),
(140, 81, '[00222] 00222 Мужская обувь Стандарт (9.5)', 7100, 1, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `SC_orders`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Авг 24 2015 г., 13:09
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_orders`;
CREATE TABLE IF NOT EXISTS `SC_orders` (
  `orderID` int(11) NOT NULL,
  `customerID` int(11) DEFAULT NULL,
  `order_time` datetime DEFAULT NULL,
  `customer_ip` varchar(15) DEFAULT NULL,
  `shipping_type` varchar(30) DEFAULT NULL,
  `shipping_module_id` int(10) unsigned NOT NULL DEFAULT '0',
  `payment_type` varchar(30) DEFAULT NULL,
  `payment_module_id` int(10) unsigned NOT NULL DEFAULT '0',
  `customers_comment` text,
  `statusID` int(11) DEFAULT NULL,
  `shipping_cost` double DEFAULT NULL,
  `order_discount` double DEFAULT NULL,
  `discount_description` varchar(255) NOT NULL,
  `order_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `currency_code` varchar(7) DEFAULT NULL,
  `currency_value` double DEFAULT NULL,
  `customer_firstname` varchar(64) DEFAULT NULL,
  `customer_lastname` varchar(64) DEFAULT NULL,
  `customer_email` varchar(50) DEFAULT NULL,
  `shipping_firstname` varchar(64) DEFAULT NULL,
  `shipping_lastname` varchar(64) DEFAULT NULL,
  `shipping_country` varchar(64) DEFAULT NULL,
  `shipping_state` varchar(64) DEFAULT NULL,
  `shipping_zip` varchar(64) DEFAULT NULL,
  `shipping_city` varchar(64) DEFAULT NULL,
  `shipping_address` text,
  `billing_firstname` varchar(64) DEFAULT NULL,
  `billing_lastname` varchar(64) DEFAULT NULL,
  `billing_country` varchar(64) DEFAULT NULL,
  `billing_state` varchar(64) DEFAULT NULL,
  `billing_zip` varchar(64) DEFAULT NULL,
  `billing_city` varchar(64) DEFAULT NULL,
  `billing_address` text,
  `cc_number` varchar(255) DEFAULT NULL,
  `cc_holdername` varchar(255) DEFAULT NULL,
  `cc_expires` varchar(255) DEFAULT NULL,
  `cc_cvv` varchar(255) DEFAULT NULL,
  `affiliateID` int(11) DEFAULT NULL,
  `shippingServiceInfo` varchar(255) DEFAULT NULL,
  `google_order_number` varchar(50) NOT NULL DEFAULT '',
  `source` enum('storefront','widgets','backend') NOT NULL DEFAULT 'storefront'
) ENGINE=MyISAM AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_orders`
--

INSERT INTO `SC_orders` (`orderID`, `customerID`, `order_time`, `customer_ip`, `shipping_type`, `shipping_module_id`, `payment_type`, `payment_module_id`, `customers_comment`, `statusID`, `shipping_cost`, `order_discount`, `discount_description`, `order_amount`, `currency_code`, `currency_value`, `customer_firstname`, `customer_lastname`, `customer_email`, `shipping_firstname`, `shipping_lastname`, `shipping_country`, `shipping_state`, `shipping_zip`, `shipping_city`, `shipping_address`, `billing_firstname`, `billing_lastname`, `billing_country`, `billing_state`, `billing_zip`, `billing_city`, `billing_address`, `cc_number`, `cc_holdername`, `cc_expires`, `cc_cvv`, `affiliateID`, `shippingServiceInfo`, `google_order_number`, `source`) VALUES
(1, NULL, '2011-08-02 14:00:47', '217.118.66.50', 'Самовывоз', 9, 'Наличные', 12, 'привезите', 1, 0, 0, '', '3850.00', 'RUR', 1, 'антон', 'ст', 'st@sdsd.ru', 'антон', 'ст', 'Россия', ' Московская область', '', 'москва', 'митино', 'антон', 'ст', 'Россия', ' Московская область', '', 'москва', 'митино', '', '', '', '', 0, '', '', 'storefront'),
(2, NULL, '2011-08-02 14:02:58', '217.118.66.50', 'Самовывоз', 9, 'Наличные', 12, 'не важно', 1, 0, 0, '', '11000.00', 'RUR', 1, 'антон', 'ст', 'st@sdsd.ru', 'антон', 'ст', 'Россия', ' Московская область', '', 'москва', 'митино', 'антон', 'ст', 'Россия', ' Московская область', '', 'москва', 'митино', '', '', '', '', 0, '', '', 'storefront'),
(3, NULL, '2011-08-11 20:00:18', '85.26.155.49', 'Курьер', 11, 'Наличные', 12, '', 1, 0, 0, '', '16500.00', 'RUR', 1, 'Юрий', 'Нездой', 'Fff@mail.ru', 'Юрий', 'Нездой', 'Россия', ' Московская область', '', 'Солнечногорск', 'Солнечногорск', 'Юрий', 'Нездой', 'Россия', ' Московская область', '', 'Солнечногорск', 'Солнечногорск', '', '', '', '', 0, '', '', 'storefront'),
(4, NULL, '2011-08-11 22:05:57', '178.140.37.123', 'Курьер', 11, 'Наличные', 12, '', 5, 0, 0, '', '3850.00', 'RUR', 1, 'Олег', 'Сержантов', 'sovazh@yahoo.com', 'Олег', 'Сержантов', 'Россия', ' Московская область', '', 'Москва', 'Северное Чертаново', 'Олег', 'Сержантов', 'Россия', ' Московская область', '', 'Москва', 'Северное Чертаново', '', '', '', '', 0, '', '', 'storefront'),
(5, NULL, '2011-08-12 16:00:09', '85.26.155.169', 'Курьер', 11, 'Наличные', 12, 'fsdfsd', 1, 0, 0, '', '3850.00', 'RUR', 1, 'антон', 'стар', 'starikovap@mail.ru', 'антон', 'стар', 'Россия', ' Московская область', '', 'москва', 'fdfdf11', '1', '1', 'Россия', ' Московская область', '', 'москва', 'fdfdf11', '', '', '', '', 0, '', '', 'storefront'),
(6, 6, '2011-08-12 16:49:45', '85.26.155.169', 'Курьер', 11, 'Наличные', 12, 'test', 1, 0, 0, '', '4950.00', 'RUR', 1, 'антон', 'стар', 'starikovap@mail.ru', '-', '-', 'Россия', ' Московская область', '', 'москва', 'fdfdf11 566', '-', '-', 'Россия', ' Московская область', '', 'москва', 'fdfdf11 566', '', '', '', '', 0, '', '', 'storefront'),
(7, NULL, '2011-08-19 18:15:29', '80.255.29.0', 'Курьер', 11, 'Наличные', 12, '', 1, 0, 0, '', '3850.00', 'RUR', 1, 'Oleg', 'Serzhantov', 'sovazh@yahoo.com', '-', '-', 'Россия', ' Московская область', '', 'Moskva', 'Severnoe Chertanovo', '-', '-', 'Россия', ' Московская область', '', 'Moskva', 'Severnoe Chertanovo', '', '', '', '', 0, '', '', 'storefront'),
(8, 8, '2011-08-19 18:20:55', '91.77.147.64', 'Курьер', 11, 'Наличные', 12, '', 5, 0, 0, '', '3850.00', 'RUR', 1, 'екатерина', 'сержантова', 'ekaterina.serzha@mail.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Пятницкое шоссе,д.15,кв 118', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Пятницкое шоссе,д.15,кв 118', '', '', '', '', 0, '', '', 'storefront'),
(9, 9, '2011-08-28 09:30:56', '93.80.234.44', 'Курьер', 11, 'Наличные', 12, '', 21, 0, 0, '', '5720.00', 'RUR', 1, 'Юрий', 'Маркелов', 'dancer729@gmail.com', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Большая Декабрьская, 8, кв. 68', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Большая Декабрьская, 8, кв. 68', '', '', '', '', 0, '', '', 'storefront'),
(10, 10, '2011-09-28 12:32:40', '188.255.54.179', '', 0, '', 0, '', 5, 0, 0, '', '2500.00', 'RUR', 1, 'Ирина', '---', 'stat@dancelife-shop.ru', 'Ирина', '---', 'Россия', ' Московская область', '', 'Москва', 'Новый Арбат 15, стр. 2', 'Ирина', '---', 'Россия', ' Московская область', '', 'Москва', 'Новый Арбат 15, стр. 2', NULL, NULL, NULL, NULL, NULL, NULL, '', 'backend'),
(11, 11, '2011-09-28 12:38:37', '188.255.54.179', '', 0, '', 0, '', 5, 0, 600, 'Ока-Дэнс\r\n', '4400.00', 'RUR', 1, '---', '---', 'stat@dancelife-shop.ru', '---', '---', 'Россия', ' Московская область', '', 'Москва', 'Чечеринский проезд, д. 94, кв. 88', '---', '---', 'Россия', ' Московская область', '', 'Москва', 'Чечеринский проезд, д. 94, кв. 88', NULL, NULL, NULL, NULL, NULL, NULL, '', 'backend'),
(12, 12, '2011-09-28 20:40:27', '188.255.54.179', 'Курьер', 11, 'Оплата по квитанции', 19, '', 1, 0, 0, '', '4180.00', 'RUR', 1, 'Oleg', 'Serzhantov', 'sovazh@yahoo.com', '-', '-', 'Россия', ' Московская область', '117648', 'Moscow', 'Severnoe Chertanovo', '-', '-', 'Россия', ' Московская область', '117648', 'Moscow', 'Severnoe Chertanovo', '', '', '', '', 0, '', '', 'storefront'),
(13, 13, '2011-10-25 23:04:30', '195.191.175.243', 'Курьер', 11, 'Наличные', 12, '', 5, 0, 0, '', '8360.00', 'RUR', 1, 'Юрий', 'Петров', 'guees777@rambler.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Сокольнический вал 27/10. танцевальный зал "Форум", здание НИИСУ', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Сокольнический вал 27/10. танцевальный зал "Форум", здание НИИСУ', '', '', '', '', 0, '', '', 'storefront'),
(14, 14, '2011-11-02 14:47:22', '77.232.15.56', 'Курьер', 11, 'Наличные', 12, '', 1, 0, 0, '', '340.00', 'RUR', 1, 'Сорокин', 'Евгений', 'Mes2006.79@mail.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Улица Паршина, д. 41, кВ.9', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Улица Паршина, д. 41, кВ.9', '', '', '', '', 0, '', '', 'storefront'),
(15, 15, '2011-11-16 21:25:30', '91.214.128.115', 'Курьер', 11, 'Наличные', 12, 'Доставка желательна завтра (17 ноября) после 15.00', 1, 0, 0, '', '8360.00', 'RUR', 1, 'Елена', 'Гончарова', 'guees777@mail.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Крокус Сити, гостиница "Аквариум"', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Крокус Сити, гостиница "Аквариум"', '', '', '', '', 0, '', '', 'storefront'),
(16, 16, '2011-12-07 20:46:08', '46.188.12.2', 'Курьер', 11, 'Наличные', 12, '', 1, 0, 0, '', '300.00', 'RUR', 1, 'Казакова', 'Елизавета', 'lizashrei@pochta.ru', '-', '-', 'Россия', ' Московская область', '119334', 'Москва', 'Ленинский проспект 37а квартира 204', '-', '-', 'Россия', ' Московская область', '119334', 'Москва', 'Ленинский проспект 37а квартира 204', '', '', '', '', 0, '', '', 'storefront'),
(17, 17, '2011-12-08 02:10:18', '176.195.139.201', 'Курьер', 11, 'Наличные', 12, 'использую купон dancelife на 500 рублей', 5, 0, 500, 'DANCELIFE 500', '3350.00', 'RUR', 1, 'Алёна', 'Алькина', 'alena_alkina@mail.ru', 'Алёна', 'Алькина', 'Россия', ' Московская область', '127238', 'Москва', '3-ий Нижнелихоборский пр,д11 кв5,этаж 2, домофон 5', 'Алёна', 'Алькина', 'Россия', ' Московская область', '127238', 'Москва', '3-ий Нижнелихоборский пр,д11 кв5,этаж 2, домофон 5', '', '', '', '', 0, '', '', 'storefront'),
(18, 18, '2012-01-19 19:03:59', '188.123.241.73', 'Курьер', 11, 'Наличные', 12, '', 5, 0, 0, '', '4180.00', 'RUR', 1, 'Наталья', 'Власова', 'vlasova12345@yandex.ru', 'Наталья', 'Власова', 'Россия', ' Московская область', '', 'москва', 'ул. Погодинская 1,стр.1', 'Наталья', 'Власова', 'Россия', ' Московская область', '', 'москва', 'ул. Погодинская 1,стр.1', '', '', '', '', 0, '', '', 'storefront'),
(19, 19, '2012-01-29 20:07:48', '92.240.208.216', 'Курьер', 11, 'Наличные', 12, '', 1, 0, 0, '', '11220.00', 'RUR', 1, 'Сергей', 'Осейчук', 'oseychuk@rambler.ru', '-', '-', 'Россия', 'Тюменская область', '625051', 'Тюмень', 'Г.Тюмень, ул. Николая Гондатти 5, кв.45, ', '-', '-', 'Россия', 'Тюменская область', '625051', 'Тюмень', 'Г.Тюмень, ул. Николая Гондатти 5, кв.45, ', '', '', '', '', 0, '', '', 'storefront'),
(20, 20, '2012-02-11 16:37:03', '176.195.203.213', 'Курьер', 11, 'Наличные', 12, '', 5, 0, 0, '', '2500.00', 'RUR', 1, 'Elena', 'Gradova', 'egradova@yandex.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Пресненская наб.,12', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Пресненская наб.,12', '', '', '', '', 0, '', '', 'storefront'),
(21, 21, '2012-02-29 14:18:58', '188.123.230.245', 'Курьер', 11, 'Наличные', 12, '', 1, 0, 0, '', '5000.00', 'RUR', 1, 'Елена', 'Бусыгина', 'martinenko.06@mail.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Гарибальди 28 к1, кв. 259', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Гарибальди 28 к1, кв. 259', '', '', '', '', 0, '', '', 'storefront'),
(22, 22, '2012-03-01 17:32:38', '95.169.96.221', 'Курьер', 11, 'Наличные', 12, 'можете ли вы привезти сразу 2 пары - 10.5 и 11 размер? нет уверенности какая сейчас подойдет лучше. Спасибо', 5, 0, 0, '', '5720.00', 'RUR', 1, 'Сергей', 'Филиппов', 'filippovsergei@gmail.com', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'ул марксистская д22 офис 107', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'ул марксистская д22 офис 107', '', '', '', '', 0, '', '', 'storefront'),
(23, 23, '2012-03-23 17:51:19', '194.186.91.5', 'Курьер', 11, 'Наличные', 12, '', 5, 0, 0, '', '3850.00', 'RUR', 1, 'Евгения', 'Кривец', 'krivets_ea@mail.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'м. Савеловская. (будни и суббота)\r\nУл Вятская 13, 2-ой подъезд. От метро 10 минут пешком\r\n\r\nм. Римская. (воскресенье)\r\nул. Нижегородская, 32, стр.А. Ориентир - спорт - клуб "Кенгуру". От метро 15-20 минут пешком.', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'м. Савеловская. (будни и суббота)\r\nУл Вятская 13, 2-ой подъезд. От метро 10 минут пешком\r\n\r\nм. Римская. (воскресенье)\r\nул. Нижегородская, 32, стр.А. Ориентир - спорт - клуб "Кенгуру". От метро 15-20 минут пешком.', '', '', '', '', 0, '', '', 'storefront'),
(24, 24, '2012-03-30 15:47:52', '80.255.29.0', 'Курьер', 11, 'Наличные', 12, '', 5, 0, 0, '', '9980.00', 'RUR', 1, 'Татьяна', 'Сизова', 'olegss1@mail.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Алтуфьево', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Алтуфьево', '', '', '', '', 0, '', '', 'storefront'),
(25, 25, '2012-04-03 12:32:21', '95.24.216.240', 'Курьер', 11, 'Наличные', 12, '', 5, 0, 0, '', '5720.00', 'RUR', 1, 'Александр', 'Шмонин', 'Shmonin_Alex@rambler.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Ул.Перекопская д.28 , школа 1115 , СТК "Динамо"', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Ул.Перекопская д.28 , школа 1115 , СТК "Динамо"', '', '', '', '', 0, '', '', 'storefront'),
(26, 26, '2012-04-25 11:40:02', '199.204.11.21', 'Курьер', 11, 'Наличные', 12, 'м. Дмитровская, после стеклянных дверей направо налево налево, далее прямо по ул. Бутырская до бизнес центра, вход между Il Patio и Шоколадницей. Просьба доставить ЗАВТРА с 10 до 18 часов. Спасибо!', 5, 0, 0, '', '4300.00', 'RUR', 1, 'Ольга', 'Журбенко', 'jolly-5@yandex.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Москва, м. Дмитровская, ул. Бутырская д. 76 стр. 1 (бизнес центр)', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Москва, м. Дмитровская, ул. Бутырская д. 76 стр. 1 (бизнес центр)', '', '', '', '', 0, '', '', 'storefront'),
(27, 27, '2012-06-18 15:50:28', '89.148.237.80', 'Курьер', 11, 'Наличные', 12, 'Звонила вам по указанному номеру на сайте, но абонент не отвечает. Хотелось бы узнать полноту обуви (размер 7-ка). Как оплачивать? Предоплата 100% или при получении?', 1, 0, 0, '', '8300.00', 'RUR', 1, 'Светлана', 'Княгиничева', 'svetlana_knyagin@mail.ru', '-', '-', 'Россия', 'Пермский край', '614068', 'Пермь', 'ул. Петропавловская, 111-97', '-', '-', 'Россия', 'Пермский край', '614068', 'Пермь', 'ул. Петропавловская, 111-97', '', '', '', '', 0, '', '', 'storefront'),
(28, 28, '2012-06-25 11:37:20', '37.204.19.121', 'Курьер', 11, 'Наличные', 12, '', 5, 0, 0, '', '12900.00', 'RUR', 1, 'Ирина', 'Ирина', 'Fairy6@mail.ru', '-', '-', 'Россия', ' Московская область', '117461', 'Москва', 'ул.Перекопская, д.34,корп.1, кв.106', '-', '-', 'Россия', ' Московская область', '117461', 'Москва', 'ул.Перекопская, д.34,корп.1, кв.106', '', '', '', '', 0, '', '', 'storefront'),
(29, 29, '2012-07-11 10:51:12', '199.204.11.21', 'Курьер', 11, 'Наличные', 12, 'Большая просьба проверить парность обуви (был прецедент доставки левой и правой туфель с одинаковым размером, но разного оттенка и формы). Спасибо!', 5, 0, 0, '', '4000.00', 'RUR', 1, 'Ольга', 'Ж', 'jolly-5@yandex.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Москва, ул. Бутырская д. 76 стр.1', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Москва, ул. Бутырская д. 76 стр.1', '', '', '', '', 0, '', '', 'storefront'),
(30, 30, '2012-07-15 22:04:01', '77.238.235.29', 'Курьер', 11, 'Наличные', 12, 'Срочно', 5, 0, 0, '', '4000.00', 'RUR', 1, 'Катя', 'К', 'Katya_sa@mail.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Вернадского 94/2, кВ 42', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Вернадского 94/2, кВ 42', '', '', '', '', 0, '', '', 'storefront'),
(31, 32, '2012-08-31 15:16:22', '89.232.129.52', 'Курьер', 11, 'Наличные', 12, '', 1, 0, 0, '', '600.00', 'RUR', 1, 'Инна', 'Наумёнок', 'Inna1978205@rambler.ru', '-', '-', 'Россия', 'Сахалинская область', '693004', 'Южно-Сахалинск', 'проспект Мира,д.395,кв.24', '-', '-', 'Россия', 'Сахалинская область', '693004', 'Южно-Сахалинск', 'проспект Мира,д.395,кв.24', '', '', '', '', 0, '', '', 'storefront'),
(32, 33, '2012-09-01 12:53:42', '188.123.248.63', 'Курьер', 11, 'Наличные', 12, '', 5, 0, 0, '', '4000.00', 'RUR', 1, 'Анастасия', 'Галко', 'galk.anastasija@rambler.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Самаркандский бульвар,квартал 137а,корпус 9,квартира 199', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Самаркандский бульвар,квартал 137а,корпус 9,квартира 199', '', '', '', '', 0, '', '', 'storefront'),
(33, 34, '2012-09-30 20:06:02', '178.159.57.72', 'Курьер', 11, 'Оплата по квитанции', 19, '', 1, 0, 0, '', '4000.00', 'RUR', 1, 'Игорь', 'Павлычев', 'ivp@ctot.ru', '-', '-', 'Россия', 'Тверская область', '170024', 'Тверь', 'ул. М.Конева д.12 корп.1 кв.26', '-', '-', 'Россия', 'Тверская область', '170024', 'Тверь', 'ул. М.Конева д.12 корп.1 кв.26', '', '', '', '', 0, '', '', 'storefront'),
(34, 35, '2012-11-08 17:33:18', '79.139.172.13', 'Курьер', 11, 'Наличные', 12, '', 5, 0, 0, '', '5600.00', 'RUR', 1, 'Елена', 'Фетисова', 'fetalina@mail.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'ул.Кибальчича, дом 12 корпус 2, квартира 193, 13 этаж', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'ул.Кибальчича, дом 12 корпус 2, квартира 193, 13 этаж', '', '', '', '', 0, '', '', 'storefront'),
(35, 36, '2012-11-19 13:44:19', '77.35.247.62', 'Курьер', 11, 'Наличные', 12, '', 5, 0, 0, '', '5600.00', 'RUR', 1, 'Яна', 'Минаева', 'yanamin@yandex.ru', '-', '-', 'Россия', 'Приморский край', '690091', 'Владивосток', 'ул. Пологая, д. 50, кв. 12', '-', '-', 'Россия', 'Приморский край', '690091', 'Владивосток', 'ул. Пологая, д. 50, кв. 12', '', '', '', '', 0, '', '', 'storefront'),
(36, 37, '2012-12-11 14:35:06', '178.176.203.62', 'Курьер', 11, 'Наличные', 12, '', 5, 0, 0, '', '5800.00', 'RUR', 1, 'Роман', 'Островский', 'mr-ostrovsky@yandex.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Сиреневый б-р д.45 кв.34', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Сиреневый б-р д.45 кв.34', '', '', '', '', 0, '', '', 'storefront'),
(37, 38, '2012-12-25 15:18:14', '213.87.134.19', 'Курьер', 11, 'Наличные', 12, '', 5, 0, 0, '', '12000.00', 'RUR', 1, 'Svetlana', 'levantovskaya', 'Svetlana_levantavskaya@mail.ru', 'Svetlana', 'levantovskaya', 'Россия', ' Московская область', '121614', 'Москва', 'Крылатские холмы,47,43', 'Svetlana', 'levantovskaya', 'Россия', ' Московская область', '121614', 'Москва', 'Крылатские холмы,47,43', '', '', '', '', 0, '', '', 'storefront'),
(38, 39, '2013-01-13 22:28:31', '188.123.237.163', 'Курьер', 11, 'Наличные', 12, 'Возможна доставка до метро (Новокосино)', 5, 0, 0, '', '11200.00', 'RUR', 1, 'Танаева', 'Мария', 'm.tanaeva@mail.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Ул.Новокосинская ', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Ул.Новокосинская ', '', '', '', '', 0, '', '', 'storefront'),
(39, 40, '2013-01-14 12:09:45', '199.204.8.21', 'Курьер', 11, 'Наличные', 12, 'Просьба доставить в будние дни с 10 до 18, 12-13 перерыв на обед', 5, 0, 0, '', '4300.00', 'RUR', 1, 'Ольга', 'Жур', 'jolly-5@yandex.ru', '-', '-', 'Россия', ' Московская область', '127015', 'Москва', 'ул. Бутырская д. 76 стр. 1 Бизнес-центр, вход между Иль Патио и Шоколадницей', '-', '-', 'Россия', ' Московская область', '127015', 'Москва', 'ул. Бутырская д. 76 стр. 1 Бизнес-центр, вход между Иль Патио и Шоколадницей', '', '', '', '', 0, '', '', 'storefront'),
(40, 41, '2013-01-24 19:07:26', '95.84.154.186', 'Курьер', 11, 'Наличные', 12, '', 5, 0, 0, '', '8300.00', 'RUR', 1, 'Кристина', 'Эртель ', 'apelsinka03@list.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва ', 'ул.Варшавское шоссе, д.10 корпус 1, кв.24.', '-', '-', 'Россия', ' Московская область', '', 'Москва ', 'ул.Варшавское шоссе, д.10 корпус 1, кв.24.', '', '', '', '', 0, '', '', 'storefront'),
(41, 42, '2013-02-01 15:36:42', '92.243.167.26', 'Курьер', 11, 'Наличные', 12, 'Желательно доставка завтра до 12 часов.', 5, 0, 0, '', '8300.00', 'RUR', 1, 'Галина', 'Провоторова', 'Prowotorowa.galina2010@yandex.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Дмитровское шоссе 131-2-78. 3 подъезд, 5 этаж.', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Дмитровское шоссе 131-2-78. 3 подъезд, 5 этаж.', '', '', '', '', 0, '', '', 'storefront'),
(42, 43, '2013-03-05 10:20:18', '46.39.244.131', 'Курьер', 11, 'Наличные', 12, 'Желательно доставить с 9 до 11 утра,или с 18 до 21 вечера.', 1, 0, 0, '', '350.00', 'RUR', 1, 'Александр', 'Борисов', 'imcentre2@gmail.com', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Ул.Нарвская д.1А корп.1\r\nКв.113', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Ул.Нарвская д.1А корп.1\r\nКв.113', '', '', '', '', 0, '', '', 'storefront'),
(43, 44, '2013-03-31 19:18:15', '5.228.40.81', '', 0, '', 0, '', 1, 0, 0, '', '4300.00', 'RUR', 1, '---', '---', '12345@mail.ru', '---', '---', 'Россия', ' Московская область', '', 'Москва', 'ул. Снежная д. 16, корп. 3', '---', '---', 'Россия', ' Московская область', '', 'Москва', 'ул. Снежная д. 16, корп. 3', NULL, NULL, NULL, NULL, NULL, NULL, '', 'backend'),
(44, 45, '2013-04-19 10:24:31', '95.27.255.199', 'Курьер', 11, 'Наличные', 12, '', 5, 0, 0, '', '5800.00', 'RUR', 1, 'сергей', 'сергей', 'dr.atalis@yandex.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'дежнева 15 кор 1 кв 107', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'дежнева 15 кор 1 кв 107', '', '', '', '', 0, '', '', 'storefront'),
(45, 46, '2013-07-05 12:09:04', '193.28.44.23', 'Курьер', 11, 'Наличные', 12, 'доставка по рабочим дням с 9 до 18 часов', 5, 0, 0, '', '4300.00', 'RUR', 1, 'Анна', 'Печенова', 'apechenova@raiffeisen.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Смоленская - Сенная пл., 28 подъезд 1', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Смоленская - Сенная пл., 28 подъезд 1', '', '', '', '', 0, '', '', 'storefront'),
(46, 47, '2013-08-17 15:26:42', '37.204.152.79', 'Курьер', 11, 'Наличные', 12, '', 5, 0, 0, '', '4000.00', 'RUR', 1, 'Алена', 'Алькина', 'alena_alkina@mail.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Ул. Астрадамская д. 9 кор 2, кв.97,4 этаж, домофон 97к5847', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Ул. Астрадамская д. 9 кор 2, кв.97,4 этаж, домофон 97к5847', '', '', '', '', 0, '', '', 'storefront'),
(47, 48, '2013-08-24 15:25:00', '91.76.18.242', 'Курьер', 11, 'Наличные', 12, 'Хочу купить черные и одни из бежевых , мне нужно поумерить , какой из каблуков мне будет удобен ', 5, 0, 0, '', '12300.00', 'RUR', 1, 'Наталья', 'Батищева', 'Batishcheva_natal@mail.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Ленинградский проспект 33А', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Ленинградский проспект 33А', '', '', '', '', 0, '', '', 'storefront'),
(48, 49, '2013-09-04 10:51:27', '109.188.125.251', 'Курьер', 11, 'Наличные', 12, 'заказ доставить по адресу:Москва,ул.Солнечногорская,дом4 Завод Моссельмаш.На проходной позвонить по тел 89636387335 Алексей.Доставку оформить на пятницу 6 сенября.Есть купон на скидку 10%', 5, 0, 890, 'Купон DANCELIFE на скидку 10%', '8010.00', 'RUR', 1, 'Oksana', 'Brovkina', 'ok.browkina@yandex.ru', 'Oksana', 'Brovkina', 'Россия', ' Московская область', '143040', 'Голицыно', 'М.О,Одинцовский район,г.Голицыно', 'Oksana', 'Brovkina', 'Россия', ' Московская область', '143040', 'Голицыно', 'М.О,Одинцовский район,г.Голицыно', '', '', '', '', 0, '', '', 'storefront'),
(49, 50, '2013-09-19 09:51:22', '46.188.2.147', 'Курьер', 11, 'Наличные', 12, '', 5, 0, 0, '', '2600.00', 'RUR', 1, 'Елена', 'Джабарова', 'Lenad72@mail.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Ул. Гарибальди 7 кв17', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Ул. Гарибальди 7 кв17', '', '', '', '', 0, '', '', 'storefront'),
(50, 51, '2013-09-22 09:55:19', '95.28.191.218', 'Курьер', 11, 'Наличные', 12, '', 5, 0, 0, '', '4300.00', 'RUR', 1, 'Анна', 'Асеева', 'Sestruccho@gmail.com', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Краснопролетарская ул, дом 9, кв, 151', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Краснопролетарская ул, дом 9, кв, 151', '', '', '', '', 0, '', '', 'storefront'),
(51, 52, '2013-10-31 21:51:34', '77.232.159.219', 'Курьер', 11, 'Наличные', 12, 'dsgdgs', 1, 0, 0, '', '4300.00', 'RUR', 1, 'fgdh', 'dfghdf', 'dfhdfh@gsdfgsdfg.com', '-', '-', 'Россия', ' Московская область', '', 'sdfggdsfg', 'gsdfgdfg', '-', '-', 'Россия', ' Московская область', '', 'sdfggdsfg', 'gsdfgdfg', '', '', '', '', 0, '', '', 'storefront'),
(52, 53, '2013-12-07 23:45:37', '95.27.237.133', 'Курьер', 11, 'Наличные', 12, '', 5, 0, 0, '', '2600.00', 'RUR', 1, 'Мария', 'Кузнецова', 'Kuznezma@mail.ri', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Ул. Щербаковская, дом 26 , кв . 244', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Ул. Щербаковская, дом 26 , кв . 244', '', '', '', '', 0, '', '', 'storefront'),
(53, 54, '2014-01-05 16:28:52', '89.189.111.144', 'Курьер', 11, 'Наличные', 12, '', 5, 0, 0, '', '5200.00', 'RUR', 1, 'Елена', 'Петрова', 'petrova.cstc@yandex.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Яна Райниса, д.7/1, кв.48', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Яна Райниса, д.7/1, кв.48', '', '', '', '', 0, '', '', 'storefront'),
(54, 55, '2014-01-10 14:13:06', '83.149.9.75', 'Курьер', 11, 'Наличные', 12, '', 5, 0, 0, '', '4000.00', 'RUR', 1, 'Евгения', ' касанаве', 'imagemaxinfo@gmail.com', '-', '-', 'Россия', ' Московская область', '', 'москва', 'Проезд Березовой Рощи, 12, кв.526,5подъезд,22 этаж', '-', '-', 'Россия', ' Московская область', '', 'москва', 'Проезд Березовой Рощи, 12, кв.526,5подъезд,22 этаж', '', '', '', '', 0, '', '', 'storefront'),
(55, 56, '2014-01-16 10:35:37', '93.80.35.196', 'Курьер', 11, 'Наличные', 12, '', 5, 0, 0, '', '5800.00', 'RUR', 1, 'Сергей', 'Ф', 'dr.atalis@yandex.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Дежнева 15-1-107', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Дежнева 15-1-107', '', '', '', '', 0, '', '', 'storefront'),
(56, 57, '2014-02-04 08:51:18', '79.98.8.31', 'Курьер', 11, 'Наличные', 12, '', 5, 0, 0, '', '5600.00', 'RUR', 1, 'Артур', 'Мунес', 'munes-artur@yandex.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Дубнинская ул., дом 53/2, кв. 84', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Дубнинская ул., дом 53/2, кв. 84', '', '', '', '', 0, '', '', 'storefront'),
(57, 58, '2014-02-13 23:58:27', '95.25.11.32', 'Курьер', 11, 'Наличные', 12, 'Доставка в будние дни после 18.00', 5, 0, 0, '', '4300.00', 'RUR', 1, 'Наталия', 'Деревянко', 'nderevjanko@mail.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Погонный проезд д.52, кв.8', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Погонный проезд д.52, кв.8', '', '', '', '', 0, '', '', 'storefront'),
(58, 59, '2014-03-04 01:07:10', '83.149.8.173', 'Курьер', 11, 'Наличные', 12, 'Есть единоразовая скидка 10 процентов', 5, 0, 0, '', '8000.00', 'RUR', 1, 'Евгения', ' касанаве', 'imagemaxinfo@gmail.com', '-', '-', 'Россия', ' Московская область', '', 'москва', 'Проезд Березовой Рощи, 12, кв.526,5подъезд, 22 этаж', '-', '-', 'Россия', ' Московская область', '', 'москва', 'Проезд Березовой Рощи, 12, кв.526,5подъезд, 22 этаж', '', '', '', '', 0, '', '', 'storefront'),
(59, 60, '2014-03-10 17:22:33', '188.123.231.133', 'Курьер', 11, 'Наличные', 12, '', 5, 0, 0, '', '8300.00', 'RUR', 1, 'Наталья', 'Мильчакова', 'ngmail@ya.ru', '-', '-', 'Россия', ' Московская область', '117296', 'Москва', 'Ломоносовский проспект, д. 18, кв. 162', '-', '-', 'Россия', ' Московская область', '117296', 'Москва', 'Ломоносовский проспект, д. 18, кв. 162', '', '', '', '', 0, '', '', 'storefront'),
(60, 61, '2014-04-13 01:32:39', '89.222.186.13', 'Курьер', 11, 'Наличные', 12, 'Несколько пар с 39-го размера', 5, 0, 0, '', '5600.00', 'RUR', 1, 'Юрий', 'Абушинов', 'Ura-abushinov@yandex.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Ленинградский пр.31а б/ц монарх', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Ленинградский пр.31а б/ц монарх', '', '', '', '', 0, '', '', 'storefront'),
(61, 62, '2014-05-07 15:23:07', '217.84.241.3', 'Курьер', 11, 'Наличные', 12, '', 1, 0, 0, '', '4300.00', 'RUR', 1, 'Tester', 'Test', 'jew@gmx.de', '-', '-', 'Россия', ' Московская область', '155524', 'Простоквашино', 'Простоквашино 1', '-', '-', 'Россия', ' Московская область', '155524', 'Простоквашино', 'Простоквашино 1', '', '', '', '', 0, '', '', 'storefront'),
(62, 63, '2014-07-30 17:13:51', '81.95.46.77', 'Курьер', 11, 'Наличные', 12, '', 1, 0, 0, '', '5600.00', 'RUR', 1, 'oleg', 'oleg', 'olegss1@mail.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Зюзино', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Зюзино', '', '', '', '', 0, '', '', 'storefront'),
(63, 64, '2014-08-04 18:30:37', '89.189.104.248', 'Курьер', 11, 'Наличные', 12, '', 5, 0, 0, '', '2600.00', 'RUR', 1, 'Елена', 'Петрова', 'petrova.cstc@yandex.ru', '-', '-', 'Россия', ' Московская область', '125363', 'Москва', 'б-р Яна Райниса, д.7/1, кв.48', '-', '-', 'Россия', ' Московская область', '125363', 'Москва', 'б-р Яна Райниса, д.7/1, кв.48', '', '', '', '', 0, '', '', 'storefront'),
(64, 60, '2014-08-05 16:28:34', '188.123.231.133', 'Курьер', 11, 'Наличные', 12, 'Предварительно позвонить по тел. 8(905)5430923, Наталья', 5, 0, 400, 'По сертификату: #dl10, 400 руб.', '3600.00', 'RUR', 1, 'Наталья', 'Мильчакова', 'ngmail@ya.ru', '-', '-', 'Россия', ' Московская область', '117296', 'Москва', 'Ломоносовский проспект, д. 18, кв. 162', '-', '-', 'Россия', ' Московская область', '117296', 'Москва', 'Ломоносовский проспект, д. 18, кв. 162', '', '', '', '', 0, '', '', 'storefront'),
(65, 65, '2014-09-03 10:05:38', '89.189.104.84', 'Курьер', 11, 'Наличные', 12, '', 5, 0, 0, '', '2600.00', 'RUR', 1, 'Елена', 'Петрова', 'petrova.cstc@yandex.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Яна Райниса, д.7/1, кв.48', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Яна Райниса, д.7/1, кв.48', '', '', '', '', 0, '', '', 'storefront'),
(66, 66, '2014-10-05 12:02:38', '89.189.104.84', 'Курьер', 11, 'Наличные', 12, '', 5, 0, 0, '', '4300.00', 'RUR', 1, 'Елена', 'Петрова', 'petrova.cstc@yandex.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'б-р Яна Райниса, д.7/1, кв.48', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'б-р Яна Райниса, д.7/1, кв.48', '', '', '', '', 0, '', '', 'storefront'),
(67, 67, '2014-11-27 16:28:39', '78.107.119.119', 'Курьер', 11, 'Наличные', 12, 'предварительно позвонить', 5, 0, 0, '', '20600.00', 'RUR', 1, 'Наталия', 'Буденная', 'n1604n@yandex.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'бр.Д. Донского 11 кв.247  ', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'бр.Д. Донского 11 кв.247  ', '', '', '', '', 0, '', '', 'storefront'),
(68, 68, '2014-12-03 01:13:31', '91.226.166.8', 'Курьер', 11, 'Наличные', 12, 'Заранее спасибо)', 1, 0, 0, '', '350.00', 'RUR', 1, 'Нуне', 'Согомонян', 'nune.sogomonyan2012@yandex.ru', '-', '-', 'Россия', ' Московская область', '', 'Коломна', 'Московская область, город Коломна, село Пирочи, улица Центральная, дом 7, квартира 4', '-', '-', 'Россия', ' Московская область', '', 'Коломна', 'Московская область, город Коломна, село Пирочи, улица Центральная, дом 7, квартира 4', '', '', '', '', 0, '', '', 'storefront'),
(69, 69, '2014-12-05 12:20:20', '91.221.233.14', 'Курьер', 11, 'Наличные', 12, '', 1, 0, 0, '', '700.00', 'RUR', 1, 'Ольга', 'Афанасьева', 'olga-0412@mail.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Флотская 5А, оф.509', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Флотская 5А, оф.509', '', '', '', '', 0, '', '', 'storefront'),
(70, 70, '2014-12-08 19:15:18', '176.111.79.159', 'Курьер', 11, 'Наличные', 12, 'получить обувь надо до 11 декабря', 5, 0, 0, '', '6500.00', 'RUR', 1, 'Вера', 'Перкова', 'Vperkova@yandex.ru', '-', '-', 'Россия', ' Московская область', '', 'Лобня', 'Лобня Ленина 23, корпус 11, квартира 23. ', '-', '-', 'Россия', ' Московская область', '', 'Лобня', 'Лобня Ленина 23, корпус 11, квартира 23. ', '', '', '', '', 0, '', '', 'storefront'),
(71, 71, '2015-02-07 15:56:07', '188.123.230.102', 'Курьер', 11, 'Наличные', 12, '', 5, 0, 0, '', '13600.00', 'RUR', 1, 'Марина', 'Мерзликина', 'kost47@yandex.ru', '-', '-', 'Россия', ' Московская область', '119454', 'Москва', 'ул.Удальцова,д.85.к.4, домофон 134,кв.130', '-', '-', 'Россия', ' Московская область', '119454', 'Москва', 'ул.Удальцова,д.85.к.4, домофон 134,кв.130', '', '', '', '', 0, '', '', 'storefront'),
(72, 72, '2015-02-10 13:22:32', '95.25.183.137', 'Курьер', 11, 'Наличные', 12, 'Добрый день. Имеем купон на скидку 30%. Просьба привезти для сравнения размер 4,5 и 5,5. Перед доставкой предварительный звонок курьера.', 5, 0, 2220, 'Скидка 30% Турнир Golden Step 2014', '5180.00', 'RUR', 1, 'Наталья', 'Будько', 'by_sundik@mail.ru', '-', '-', 'Россия', ' Московская область', '121151', 'Москва', 'Кутузовский проспект 24-441, 16 подъезд, 9 этаж', '-', '-', 'Россия', ' Московская область', '121151', 'Москва', 'Кутузовский проспект 24-441, 16 подъезд, 9 этаж', '', '', '', '', 0, '', '', 'storefront'),
(73, 73, '2015-02-11 13:41:59', '109.188.126.33', 'Курьер', 11, 'Наличные', 12, '', 1, 0, 1710, 'По сертификату: #567326730, 1 710 руб.', '3990.00', 'RUR', 1, 'Oleg', 'Petrov', 'welcome@dancelife-ee.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Ленинградский проспект 7', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Ленинградский проспект 7', '', '', '', '', 0, '', '', 'storefront'),
(74, 74, '2015-02-11 14:04:57', '109.188.126.33', 'Курьер', 11, 'Наличные', 12, '', 1, 0, 2220, 'По сертификату: #567326730, 2 220 руб.', '5180.00', 'RUR', 1, 'Oleg', 'Petrov', 'welcome@dancelife-ee.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Ленинградский проспект 7', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Ленинградский проспект 7', '', '', '', '', 0, '', '', 'storefront'),
(75, 75, '2015-02-25 14:32:41', '195.16.111.8', 'Курьер', 11, 'Наличные', 12, 'Положите к туфлям подходящие накаблучнки (1 пара). Форма подтверждения не предлагает уже вернуться к заказу.', 5, 0, 0, '', '6900.00', 'RUR', 1, 'Сабина ', 'Хачатурян', 'sabina.s.kh@gmail.com', '-', '-', 'Россия', ' Московская область', '', 'Москва ', 'Большая Полянка, 13/16.\r\nЭто желтый особняк, в нем также находится Альфа Банк. Вход В здание с улицы Б.Полянка, там всего один вход - в черные ворота, Далее единственный подъезд. Нажимаете на звоночек, охраннику Надо сказать, что ко мне.', '-', '-', 'Россия', ' Московская область', '', 'Москва ', 'Большая Полянка, 13/16.\r\nЭто желтый особняк, в нем также находится Альфа Банк. Вход В здание с улицы Б.Полянка, там всего один вход - в черные ворота, Далее единственный подъезд. Нажимаете на звоночек, охраннику Надо сказать, что ко мне.', '', '', '', '', 0, '', '', 'storefront'),
(76, 76, '2015-02-26 15:57:46', '109.188.124.3', 'Курьер', 0, 'Наличные', 0, 'тел. +7 968 895 0856', 5, 0, 0, '', '7700.00', 'RUR', 1, 'частное ', 'лицо', 'email@email.ru', 'частное ', 'лицо', 'Россия', ' Московская область', '', 'Люберцы', 'Октябрьский проспект, д. 18, корп. 2, кв. 11', 'частное ', 'лицо', 'Россия', ' Московская область', '', 'Люберцы', 'Октябрьский проспект, д. 18, корп. 2, кв. 11', NULL, NULL, NULL, NULL, NULL, NULL, '', 'backend'),
(77, 77, '2015-04-10 13:54:42', '109.194.72.190', 'Курьер', 11, 'Наличные', 12, '', 1, 0, 0, '', '350.00', 'RUR', 1, 'Александр', 'Поплёвко', 'Mrznasty1996@mail.ru', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Ярославское шоссе, 26 к13', '-', '-', 'Россия', ' Московская область', '', 'Москва', 'Ярославское шоссе, 26 к13', '', '', '', '', 0, '', '', 'storefront'),
(78, 78, '2015-06-12 19:51:12', '95.143.213.115', 'Курьер', 11, 'Наличные', 12, 'доставка с 10 до 17 по рабочим дням', 5, 0, 0, '', '5700.00', 'RUR', 1, 'Анна', 'Печенова', 'apechenova@raiffeisen.ru', '-', '-', 'Россия', ' Московская область', '129000', 'Москва', 'Смоленская-Сенная пл., 28 подъезд 1', '-', '-', 'Россия', ' Московская область', '129000', 'Москва', 'Смоленская-Сенная пл., 28 подъезд 1', '', '', '', '', 0, '', '', 'storefront'),
(79, 79, '2015-08-05 13:38:36', '109.188.125.6', 'Курьер', 11, 'Наличные', 12, 'Накануне доставки созвониться, чтобы согласовать время', 5, 0, 0, '', '7100.00', 'RUR', 1, 'Алексей', 'Лузин', 'Luzin@aerogeologia.ru', '-', '-', 'Россия', ' Московская область', '123182', 'Москва', 'Москва, ул. Авиационная, д. 79, кв. 307', '-', '-', 'Россия', ' Московская область', '123182', 'Москва', 'Москва, ул. Авиационная, д. 79, кв. 307', '', '', '', '', 0, '', '', 'storefront'),
(80, 76, '2015-08-20 21:24:31', '87.229.223.150', '', 0, '', 0, 'тел. 8-915-057-9717', 3, 0, 0, '', '6850.00', 'RUR', 1, 'частное ', 'лицо', 'email@email.ru', 'частное ', 'лицо', 'Россия', ' Московская область', '', 'Москва', 'ул. Снежная, д.26', 'частное ', 'лицо', 'Россия', ' Московская область', '', 'Москва', 'ул. Снежная, д.26', NULL, NULL, NULL, NULL, NULL, NULL, '', 'backend'),
(81, 80, '2015-08-24 16:08:59', '5.143.87.178', 'Курьер', 11, 'Наличные', 12, '', 2, 0, 0, '', '7100.00', 'RUR', 1, 'Яна', 'Минаева', 'Yanamin@yandex.ru', '-', '-', 'Россия', 'Приморский край', '690091', 'Владивосток', 'Ул. Пологая, д.50, кВ.12', '-', '-', 'Россия', 'Приморский край', '690091', 'Владивосток', 'Ул. Пологая, д.50, кВ.12', '', '', '', '', 0, '', '', 'storefront');

-- --------------------------------------------------------

--
-- Структура таблицы `SC_orders_discount_coupons`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Фев 11 2015 г., 11:05
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_orders_discount_coupons`;
CREATE TABLE IF NOT EXISTS `SC_orders_discount_coupons` (
  `order_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_orders_discount_coupons`
--

INSERT INTO `SC_orders_discount_coupons` (`order_id`, `coupon_id`) VALUES
(73, 16),
(74, 16);

-- --------------------------------------------------------

--
-- Структура таблицы `SC_order_price_discount`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_order_price_discount`;
CREATE TABLE IF NOT EXISTS `SC_order_price_discount` (
  `discount_id` int(11) NOT NULL,
  `discount_type` enum('A','O') NOT NULL,
  `price_range` float DEFAULT NULL,
  `percent_discount` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `SC_order_status`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_order_status`;
CREATE TABLE IF NOT EXISTS `SC_order_status` (
  `statusID` int(11) NOT NULL,
  `predefined` smallint(1) unsigned NOT NULL DEFAULT '0',
  `color` varchar(6) NOT NULL DEFAULT '',
  `bold` smallint(1) unsigned NOT NULL DEFAULT '0',
  `italic` smallint(1) unsigned NOT NULL DEFAULT '0',
  `sort_order` int(11) DEFAULT NULL,
  `status_name_ru` varchar(30) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_order_status`
--

INSERT INTO `SC_order_status` (`statusID`, `predefined`, `color`, `bold`, `italic`, `sort_order`, `status_name_ru`) VALUES
(1, 1, '888888', 0, 0, 100, 'Отменен'),
(2, 1, '2B931C', 1, 0, 110, 'Новый'),
(3, 1, '0B630F', 0, 0, 120, 'В обработке'),
(5, 1, 'E68B2C', 0, 0, 140, 'Доставлен и оплачен'),
(15, 1, '800000', 0, 0, 150, 'Деньги возвращены'),
(14, 1, '0B630F', 1, 1, 130, 'Деньги списаны с карты клиента'),
(21, 0, '6600FF', 0, 1, 1, 'Отправлен'),
(22, 0, '330066', 0, 0, 2, 'Отложен');

-- --------------------------------------------------------

--
-- Структура таблицы `SC_order_status_changelog`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Авг 24 2015 г., 13:09
--

DROP TABLE IF EXISTS `SC_order_status_changelog`;
CREATE TABLE IF NOT EXISTS `SC_order_status_changelog` (
  `orderID` int(11) DEFAULT NULL,
  `status_name` varchar(255) DEFAULT NULL,
  `status_change_time` datetime DEFAULT NULL,
  `status_comment` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_order_status_changelog`
--

INSERT INTO `SC_order_status_changelog` (`orderID`, `status_name`, `status_change_time`, `status_comment`) VALUES
(1, 'Новый', '2011-08-02 14:00:47', 'Заказ оформлен покупателем'),
(2, 'Новый', '2011-08-02 14:02:58', 'Заказ оформлен покупателем'),
(1, 'Отменен', '2011-08-02 14:04:29', 'Отменен продавцом'),
(2, 'Отменен', '2011-08-02 14:04:57', 'Отменен продавцом'),
(3, 'Новый', '2011-08-11 20:00:18', 'Заказ оформлен покупателем'),
(3, 'Отменен', '2011-08-11 21:52:45', 'Отменен продавцом'),
(4, 'Новый', '2011-08-11 22:05:58', 'Заказ оформлен покупателем'),
(4, 'В обработке', '2011-08-11 23:13:55', 'Принят в обработку'),
(4, 'Отправлен', '2011-08-11 23:20:20', 'Заказ помещен в статус Отправлен'),
(4, 'Доставлен и оплачен', '2011-08-11 23:22:47', 'Заказ доставлен'),
(5, 'Новый', '2011-08-12 16:00:09', 'Заказ оформлен покупателем'),
(6, 'Новый', '2011-08-12 16:49:45', 'Заказ оформлен покупателем'),
(6, 'Отменен', '2011-08-12 16:50:19', 'Отменен продавцом'),
(5, 'Доставлен и оплачен', '2011-08-12 16:50:25', 'Заказ доставлен'),
(5, 'Отменен', '2011-08-12 16:50:34', 'Отменен продавцом'),
(7, 'Новый', '2011-08-19 18:15:29', 'Заказ оформлен покупателем'),
(8, 'Новый', '2011-08-19 18:20:55', 'Заказ оформлен покупателем'),
(9, 'Новый', '2011-08-28 09:30:56', 'Заказ оформлен покупателем'),
(7, 'Отменен', '2011-08-28 09:52:53', 'Отменен продавцом'),
(9, 'В обработке', '2011-08-28 10:02:39', 'Принят в обработку'),
(9, 'Отправлен', '2011-08-28 10:59:30', 'Заказ помещен в статус Отправлен'),
(8, 'Доставлен и оплачен', '2011-09-22 01:18:21', 'Заказ доставлен'),
(10, NULL, '2011-09-28 12:33:42', 'Заказ создан ADMIN'),
(10, 'В обработке', '2011-09-28 12:37:06', 'Принят в обработку'),
(11, NULL, '2011-09-28 12:40:12', 'Заказ создан ADMIN'),
(11, NULL, '2011-09-28 12:41:54', 'Заказ изменен ADMIN'),
(11, NULL, '2011-09-28 12:42:36', 'Заказ изменен ADMIN'),
(11, 'В обработке', '2011-09-28 12:45:30', 'Принят в обработку'),
(11, 'Доставлен и оплачен', '2011-09-28 20:05:04', 'Заказ доставлен'),
(10, 'Доставлен и оплачен', '2011-09-28 20:05:19', 'Заказ доставлен'),
(12, 'Новый', '2011-09-28 20:40:27', 'Заказ оформлен покупателем'),
(12, 'В обработке', '2011-09-28 20:45:37', 'Принят в обработку'),
(12, 'Отменен', '2011-09-28 20:45:45', 'Отменен продавцом'),
(13, 'Новый', '2011-10-25 23:04:30', 'Заказ оформлен покупателем'),
(13, 'В обработке', '2011-10-26 01:41:11', 'Принят в обработку'),
(14, 'Новый', '2011-11-02 14:47:22', 'Заказ оформлен покупателем'),
(15, 'Новый', '2011-11-16 21:25:31', 'Заказ оформлен покупателем'),
(15, 'Отменен', '2011-11-27 12:19:20', 'Отменен продавцом'),
(13, 'Доставлен и оплачен', '2011-11-27 12:19:40', 'Заказ доставлен'),
(14, 'Отменен', '2011-11-27 12:19:53', 'Отменен продавцом'),
(16, 'Новый', '2011-12-07 20:46:09', 'Заказ оформлен покупателем'),
(17, 'Новый', '2011-12-08 02:10:18', 'Заказ оформлен покупателем'),
(17, 'В обработке', '2011-12-08 11:49:57', 'Принят в обработку'),
(16, 'В обработке', '2011-12-08 11:55:10', 'Принят в обработку'),
(17, NULL, '2011-12-08 11:57:08', 'Заказ изменен ADMIN'),
(17, NULL, '2011-12-08 11:58:06', 'Заказ изменен ADMIN'),
(18, 'Новый', '2012-01-19 19:03:59', 'Заказ оформлен покупателем'),
(19, 'Новый', '2012-01-29 20:07:48', 'Заказ оформлен покупателем'),
(20, 'Новый', '2012-02-11 16:37:03', 'Заказ оформлен покупателем'),
(21, 'Новый', '2012-02-29 14:18:58', 'Заказ оформлен покупателем'),
(22, 'Новый', '2012-03-01 17:32:38', 'Заказ оформлен покупателем'),
(23, 'Новый', '2012-03-23 17:51:20', 'Заказ оформлен покупателем'),
(24, 'Новый', '2012-03-30 15:47:52', 'Заказ оформлен покупателем'),
(25, 'Новый', '2012-04-03 12:32:21', 'Заказ оформлен покупателем'),
(25, 'Доставлен и оплачен', '2012-04-04 19:04:41', 'Заказ доставлен'),
(24, 'Доставлен и оплачен', '2012-04-04 19:04:59', 'Заказ доставлен'),
(16, 'Отменен', '2012-04-04 19:05:38', 'Отменен продавцом'),
(23, 'В обработке', '2012-04-04 19:05:53', 'Принят в обработку'),
(22, 'Доставлен и оплачен', '2012-04-04 19:06:11', 'Заказ доставлен'),
(21, 'Отменен', '2012-04-04 19:06:52', 'Отменен продавцом'),
(20, 'Доставлен и оплачен', '2012-04-04 19:07:23', 'Заказ доставлен'),
(19, 'В обработке', '2012-04-04 19:07:46', 'Принят в обработку'),
(18, 'Доставлен и оплачен', '2012-04-04 19:08:03', 'Заказ доставлен'),
(17, 'Доставлен и оплачен', '2012-04-04 19:08:23', 'Заказ доставлен'),
(26, 'Новый', '2012-04-25 11:40:03', 'Заказ оформлен покупателем'),
(26, 'В обработке', '2012-05-18 16:31:38', 'Принят в обработку'),
(26, 'Доставлен и оплачен', '2012-06-04 13:58:20', 'Заказ доставлен'),
(23, 'Доставлен и оплачен', '2012-06-04 13:58:30', 'Заказ доставлен'),
(27, 'Новый', '2012-06-18 15:50:30', 'Заказ оформлен покупателем'),
(28, 'Новый', '2012-06-25 11:37:21', 'Заказ оформлен покупателем'),
(29, 'Новый', '2012-07-11 10:51:14', 'Заказ оформлен покупателем'),
(30, 'Новый', '2012-07-15 22:04:01', 'Заказ оформлен покупателем'),
(31, 'Новый', '2012-08-31 15:16:22', 'Заказ оформлен покупателем'),
(32, 'Новый', '2012-09-01 12:53:42', 'Заказ оформлен покупателем'),
(33, 'Новый', '2012-09-30 20:06:02', 'Заказ оформлен покупателем'),
(34, 'Новый', '2012-11-08 17:33:19', 'Заказ оформлен покупателем'),
(35, 'Новый', '2012-11-19 13:44:19', 'Заказ оформлен покупателем'),
(36, 'Новый', '2012-12-11 14:35:07', 'Заказ оформлен покупателем'),
(37, 'Новый', '2012-12-25 15:18:14', 'Заказ оформлен покупателем'),
(38, 'Новый', '2013-01-13 22:28:31', 'Заказ оформлен покупателем'),
(39, 'Новый', '2013-01-14 12:09:45', 'Заказ оформлен покупателем'),
(40, 'Новый', '2013-01-24 19:07:26', 'Заказ оформлен покупателем'),
(41, 'Новый', '2013-02-01 15:36:42', 'Заказ оформлен покупателем'),
(42, 'Новый', '2013-03-05 10:20:18', 'Заказ оформлен покупателем'),
(32, 'Доставлен и оплачен', '2013-03-05 13:01:54', 'Заказ доставлен'),
(41, 'Доставлен и оплачен', '2013-03-05 13:02:31', 'Заказ доставлен'),
(40, 'Доставлен и оплачен', '2013-03-05 13:02:43', 'Заказ доставлен'),
(39, 'Доставлен и оплачен', '2013-03-05 13:03:07', 'Заказ доставлен'),
(38, 'Доставлен и оплачен', '2013-03-05 13:03:21', 'Заказ доставлен'),
(27, 'В обработке', '2013-03-05 13:03:54', 'Принят в обработку'),
(33, 'В обработке', '2013-03-05 13:04:11', 'Принят в обработку'),
(28, 'Доставлен и оплачен', '2013-03-05 13:04:29', 'Заказ доставлен'),
(29, 'Доставлен и оплачен', '2013-03-05 13:05:09', 'Заказ доставлен'),
(30, 'Доставлен и оплачен', '2013-03-05 13:05:26', 'Заказ доставлен'),
(31, 'В обработке', '2013-03-05 13:05:38', 'Принят в обработку'),
(34, 'Доставлен и оплачен', '2013-03-05 13:06:08', 'Заказ доставлен'),
(35, 'Доставлен и оплачен', '2013-03-05 13:06:21', 'Заказ доставлен'),
(36, 'Доставлен и оплачен', '2013-03-05 13:06:41', 'Заказ доставлен'),
(37, 'Доставлен и оплачен', '2013-03-05 13:07:01', 'Заказ доставлен'),
(42, 'В обработке', '2013-03-05 13:07:45', 'Принят в обработку'),
(43, NULL, '2013-03-31 19:19:01', 'Заказ создан ADMIN'),
(44, 'Новый', '2013-04-19 10:24:31', 'Заказ оформлен покупателем'),
(45, 'Новый', '2013-07-05 12:09:04', 'Заказ оформлен покупателем'),
(46, 'Новый', '2013-08-17 15:26:42', 'Заказ оформлен покупателем'),
(47, 'Новый', '2013-08-24 15:25:00', 'Заказ оформлен покупателем'),
(48, 'Новый', '2013-09-04 10:51:27', 'Заказ оформлен покупателем'),
(48, NULL, '2013-09-06 12:56:19', 'Заказ изменен ADMIN'),
(49, 'Новый', '2013-09-19 09:51:23', 'Заказ оформлен покупателем'),
(50, 'Новый', '2013-09-22 09:55:19', 'Заказ оформлен покупателем'),
(51, 'Новый', '2013-10-31 21:51:34', 'Заказ оформлен покупателем'),
(52, 'Новый', '2013-12-07 23:45:38', 'Заказ оформлен покупателем'),
(53, 'Новый', '2014-01-05 16:28:52', 'Заказ оформлен покупателем'),
(54, 'Новый', '2014-01-10 14:13:06', 'Заказ оформлен покупателем'),
(55, 'Новый', '2014-01-16 10:35:37', 'Заказ оформлен покупателем'),
(56, 'Новый', '2014-02-04 08:51:19', 'Заказ оформлен покупателем'),
(57, 'Новый', '2014-02-13 23:58:28', 'Заказ оформлен покупателем'),
(58, 'Новый', '2014-03-04 01:07:10', 'Заказ оформлен покупателем'),
(59, 'Новый', '2014-03-10 17:22:33', 'Заказ оформлен покупателем'),
(60, 'Новый', '2014-04-13 01:32:39', 'Заказ оформлен покупателем'),
(61, 'Новый', '2014-05-07 15:23:07', 'Заказ оформлен покупателем'),
(62, 'Новый', '2014-07-30 17:13:52', 'Заказ оформлен покупателем'),
(62, 'Отменен', '2014-08-04 15:21:31', 'Отменен продавцом'),
(61, 'Отменен', '2014-08-04 15:21:51', 'Отменен продавцом'),
(63, 'Новый', '2014-08-04 18:30:38', 'Заказ оформлен покупателем'),
(64, 'Новый', '2014-08-05 16:28:34', 'Заказ оформлен покупателем'),
(65, 'Новый', '2014-09-03 10:05:38', 'Заказ оформлен покупателем'),
(66, 'Новый', '2014-10-05 12:02:38', 'Заказ оформлен покупателем'),
(67, 'Новый', '2014-11-27 16:28:39', 'Заказ оформлен покупателем'),
(68, 'Новый', '2014-12-03 01:13:31', 'Заказ оформлен покупателем'),
(69, 'Новый', '2014-12-05 12:20:21', 'Заказ оформлен покупателем'),
(70, 'Новый', '2014-12-08 19:15:19', 'Заказ оформлен покупателем'),
(71, 'Новый', '2015-02-07 15:56:08', 'Заказ оформлен покупателем'),
(72, 'Новый', '2015-02-10 13:22:33', 'Заказ оформлен покупателем'),
(72, NULL, '2015-02-11 13:25:23', 'Заказ изменен ADMIN'),
(73, 'Новый', '2015-02-11 13:41:59', 'Заказ оформлен покупателем'),
(72, NULL, '2015-02-11 13:50:55', 'Заказ изменен ADMIN'),
(72, 'В обработке', '2015-02-11 13:51:27', 'Принят в обработку \nДобавлен комментарий: Окончательная стоимость заказа: RUR 5180.00 Доставка: 12.02.2014 Время доставки: 19:00-21:00 Размеры: 4,5; 5,0; 5,5.Предварительный звонок'),
(73, 'Отменен', '2015-02-11 13:52:10', 'Отменен продавцом'),
(71, 'Доставлен и оплачен', '2015-02-11 13:52:50', 'Заказ доставлен'),
(70, 'Доставлен и оплачен', '2015-02-11 13:53:25', 'Заказ доставлен'),
(69, 'Отменен', '2015-02-11 13:53:56', 'Отменен продавцом'),
(68, 'Отменен', '2015-02-11 13:54:28', 'Отменен продавцом'),
(67, 'Доставлен и оплачен', '2015-02-11 13:54:59', 'Заказ доставлен'),
(66, 'Доставлен и оплачен', '2015-02-11 13:55:15', 'Заказ доставлен'),
(65, 'Доставлен и оплачен', '2015-02-11 13:55:35', 'Заказ доставлен'),
(64, 'Доставлен и оплачен', '2015-02-11 13:55:56', 'Заказ доставлен'),
(63, 'Доставлен и оплачен', '2015-02-11 13:56:09', 'Заказ доставлен'),
(60, 'Доставлен и оплачен', '2015-02-11 13:56:38', 'Заказ доставлен'),
(59, 'Доставлен и оплачен', '2015-02-11 13:57:02', 'Заказ доставлен'),
(58, 'Доставлен и оплачен', '2015-02-11 13:57:27', 'Заказ доставлен'),
(57, 'Доставлен и оплачен', '2015-02-11 13:57:49', 'Заказ доставлен'),
(56, 'Доставлен и оплачен', '2015-02-11 13:58:10', 'Заказ доставлен'),
(55, 'Доставлен и оплачен', '2015-02-11 13:58:25', 'Заказ доставлен'),
(54, 'Доставлен и оплачен', '2015-02-11 13:58:39', 'Заказ доставлен'),
(74, 'Новый', '2015-02-11 14:04:57', 'Заказ оформлен покупателем'),
(74, 'Отменен', '2015-02-11 14:07:03', 'Отменен продавцом \nДобавлен комментарий: нет в наличии'),
(53, 'Доставлен и оплачен', '2015-02-16 11:40:46', 'Заказ доставлен'),
(52, 'Доставлен и оплачен', '2015-02-16 11:41:07', 'Заказ доставлен'),
(51, 'В обработке', '2015-02-16 11:41:20', 'Принят в обработку'),
(51, 'Отменен', '2015-02-16 11:41:31', 'Отменен продавцом'),
(50, 'Доставлен и оплачен', '2015-02-16 11:41:43', 'Заказ доставлен'),
(49, 'Доставлен и оплачен', '2015-02-16 11:41:59', 'Заказ доставлен'),
(48, 'Доставлен и оплачен', '2015-02-16 11:42:13', 'Заказ доставлен'),
(47, 'Доставлен и оплачен', '2015-02-16 11:42:28', 'Заказ доставлен'),
(46, 'Доставлен и оплачен', '2015-02-16 11:42:36', 'Заказ доставлен'),
(45, 'Доставлен и оплачен', '2015-02-16 11:42:53', 'Заказ доставлен'),
(44, 'Доставлен и оплачен', '2015-02-16 11:43:09', 'Заказ доставлен'),
(72, 'Доставлен и оплачен', '2015-02-16 11:43:22', 'Заказ доставлен'),
(75, 'Новый', '2015-02-25 14:32:41', 'Заказ оформлен покупателем'),
(43, 'Отменен', '2015-02-25 19:50:31', 'Отменен продавцом'),
(75, NULL, '2015-02-25 19:52:06', 'Заказ изменен ADMIN'),
(75, NULL, '2015-02-25 19:52:53', 'Заказ изменен ADMIN'),
(75, NULL, '2015-02-25 19:55:30', 'Заказ изменен ADMIN'),
(75, 'Доставлен и оплачен', '2015-02-26 15:54:08', 'Заказ доставлен'),
(76, NULL, '2015-02-26 15:59:39', 'Заказ создан ADMIN'),
(76, NULL, '2015-02-26 16:01:54', 'Заказ изменен ADMIN'),
(76, 'Доставлен и оплачен', '2015-02-27 12:08:50', 'Заказ доставлен'),
(42, 'Отменен', '2015-02-27 12:09:13', 'Отменен продавцом'),
(33, 'Отменен', '2015-02-27 12:09:29', 'Отменен продавцом'),
(31, 'Отменен', '2015-02-27 12:09:41', 'Отменен продавцом'),
(27, 'Отменен', '2015-02-27 12:10:04', 'Отменен продавцом'),
(19, 'Отменен', '2015-02-27 12:10:20', 'Отменен продавцом'),
(77, 'Новый', '2015-04-10 13:54:42', 'Заказ оформлен покупателем'),
(77, 'Отменен', '2015-04-10 14:23:03', 'Отменен продавцом \nДобавлен комментарий: Добрый день. ПРИМЕЧАНИЯНакаблучники и щетки, из раздела аксессуары, доставляются исключительно вместе с обувью или другим товаром. Приносим наши извинения.'),
(78, 'Новый', '2015-06-12 19:51:12', 'Заказ оформлен покупателем'),
(79, 'Новый', '2015-08-05 13:38:36', 'Заказ оформлен покупателем'),
(80, NULL, '2015-08-20 21:33:17', 'Заказ создан ADMIN'),
(80, 'В обработке', '2015-08-20 21:36:27', 'Принят в обработку'),
(79, 'Доставлен и оплачен', '2015-08-20 21:37:06', 'Заказ доставлен'),
(78, 'Доставлен и оплачен', '2015-08-20 21:37:17', 'Заказ доставлен'),
(81, 'Новый', '2015-08-24 16:09:00', 'Заказ оформлен покупателем');

-- --------------------------------------------------------

--
-- Структура таблицы `SC_payment_types`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_payment_types`;
CREATE TABLE IF NOT EXISTS `SC_payment_types` (
  `PID` int(11) NOT NULL,
  `Enabled` int(11) DEFAULT NULL,
  `calculate_tax` int(11) DEFAULT NULL,
  `sort_order` int(11) DEFAULT '0',
  `module_id` int(11) DEFAULT NULL,
  `Name_ru` varchar(30) DEFAULT NULL,
  `description_ru` varchar(255) DEFAULT NULL,
  `email_comments_text_ru` text,
  `logo` text
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_payment_types`
--

INSERT INTO `SC_payment_types` (`PID`, `Enabled`, `calculate_tax`, `sort_order`, `module_id`, `Name_ru`, `description_ru`, `email_comments_text_ru`, `logo`) VALUES
(7, 1, 1, 1, 12, 'Наличные', 'Оплата товара производится наличными при получении.', 'Оплата наличными при получении.', ''),
(9, 0, 1, 2, 19, 'Оплата по квитанции', 'Оплата по квитанции в ближайшем отделении банка. Квитанция на оплату будет оформлена автоматически после оформления заказа.', '123test', 'http://www.webasyst.net/collections/design/payment-icons/receipt.gif');

-- --------------------------------------------------------

--
-- Структура таблицы `SC_payment_types__shipping_methods`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_payment_types__shipping_methods`;
CREATE TABLE IF NOT EXISTS `SC_payment_types__shipping_methods` (
  `SID` int(11) NOT NULL DEFAULT '0',
  `PID` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_payment_types__shipping_methods`
--

INSERT INTO `SC_payment_types__shipping_methods` (`SID`, `PID`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(5, 5),
(5, 6),
(6, 7),
(6, 9),
(7, 7),
(7, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `SC_products`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Сен 19 2015 г., 03:18
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_products`;
CREATE TABLE IF NOT EXISTS `SC_products` (
  `productID` int(11) NOT NULL,
  `categoryID` int(11) DEFAULT NULL,
  `customers_rating` float DEFAULT '0',
  `Price` float DEFAULT NULL,
  `in_stock` int(11) DEFAULT NULL,
  `customer_votes` int(11) DEFAULT '0',
  `items_sold` int(11) NOT NULL DEFAULT '0',
  `enabled` int(11) DEFAULT NULL,
  `list_price` float DEFAULT NULL,
  `product_code` varchar(25) DEFAULT NULL,
  `sort_order` int(11) DEFAULT '0',
  `default_picture` int(11) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `viewed_times` int(11) DEFAULT '0',
  `add2cart_counter` int(10) unsigned DEFAULT '0',
  `eproduct_filename` varchar(255) DEFAULT NULL,
  `eproduct_available_days` int(11) DEFAULT '5',
  `eproduct_download_times` int(11) DEFAULT '5',
  `weight` float DEFAULT '0',
  `free_shipping` int(11) DEFAULT '0',
  `min_order_amount` int(11) DEFAULT '1',
  `shipping_freight` float DEFAULT '0',
  `classID` int(11) DEFAULT NULL,
  `ordering_available` int(11) NOT NULL DEFAULT '0',
  `slug` varchar(255) NOT NULL DEFAULT '',
  `name_ru` varchar(255) DEFAULT NULL,
  `brief_description_ru` text,
  `description_ru` text,
  `meta_title_ru` varchar(255) DEFAULT NULL,
  `meta_description_ru` varchar(255) DEFAULT NULL,
  `meta_keywords_ru` varchar(255) DEFAULT NULL,
  `vkontakte_update_timestamp` int(11) DEFAULT NULL,
  `id_1c` varchar(74) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=918 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_products`
--

INSERT INTO `SC_products` (`productID`, `categoryID`, `customers_rating`, `Price`, `in_stock`, `customer_votes`, `items_sold`, `enabled`, `list_price`, `product_code`, `sort_order`, `default_picture`, `date_added`, `date_modified`, `viewed_times`, `add2cart_counter`, `eproduct_filename`, `eproduct_available_days`, `eproduct_download_times`, `weight`, `free_shipping`, `min_order_amount`, `shipping_freight`, `classID`, `ordering_available`, `slug`, `name_ru`, `brief_description_ru`, `description_ru`, `meta_title_ru`, `meta_description_ru`, `meta_keywords_ru`, `vkontakte_update_timestamp`, `id_1c`) VALUES
(846, 590, 0, 4300, 0, 0, 2, 1, 7300, '11502', 8, 6813, '2011-08-01 17:00:27', '2015-09-11 11:23:08', 2887, 8, '', 5, 5, 0, 0, 1, 0, 0, 1, '11502', '11502 Женская обувь Латина', '', '<p>Женская обувь Латина DANCELIFE артикул 11502</p>', '', '', '', 0, ''),
(847, 590, 0, 7300, 0, 0, 2, 1, 0, '11535', 9, 6816, '2011-08-01 17:00:27', '2015-03-02 13:08:38', 1311, 8, '', 5, 5, 0, 0, 1, 0, 0, 1, '11535', '11535 Женская обувь Латина', '', '<p>Женская обувь Латина DANCELIFE артикул 11535</p>', '', '', '', 0, ''),
(848, 590, 0, 4300, 0, 0, 0, 1, 7300, '11602', 10, 6819, '2011-08-01 17:00:27', '2015-09-11 11:23:33', 2768, 3, '', 5, 5, 0, 0, 1, 0, 0, 1, '11602', '11602 Женская обувь Латина', '', '<p>Женская обувь Латина DANCELIFE артикул 11602</p>', '', '', '', 0, ''),
(849, 590, 0, 5900, 0, 0, 1, 0, 0, '11605', 11, 6822, '2011-08-01 17:00:27', '2015-03-20 12:08:51', 1028, 2, '', 5, 5, 0, 0, 1, 0, 0, 0, '11605', '11605 Женская обувь Латина', '', '<p>Женская обувь Латина DANCELIFE артикул 11605</p>', '', '', '', 0, ''),
(850, 590, 0, 7300, 0, 0, 1, 1, 0, '11635', 12, 6825, '2011-08-01 17:00:27', '2015-03-02 13:09:50', 1232, 3, '', 5, 5, 0, 0, 1, 0, 0, 1, '11635', '11635 Женская обувь Латина', '', '<p>Женская обувь Латина DANCELIFE артикул 11635</p>', '', '', '', 0, ''),
(851, 590, 0, 7300, 0, 0, 2, 1, 0, '11735', 13, 6828, '2011-08-01 17:00:27', '2015-03-02 13:10:14', 1254, 4, '', 5, 5, 0, 0, 1, 0, 0, 1, '11735', '11735 Женская обувь Латина', '', '<p>Женская обувь Латина DANCELIFE артикул 11735</p>', '', '', '', 0, ''),
(852, 590, 0, 7300, 0, 0, 1, 1, 0, '11935', 14, 6831, '2011-08-01 17:00:27', '2015-03-02 13:11:06', 1314, 4, '', 5, 5, 0, 0, 1, 0, 0, 1, '11935', '11935 Женская обувь Латина', '', '<p>Женская обувь Латина DANCELIFE артикул 11935</p>', '', '', '', 0, ''),
(853, 590, 0, 5900, 0, 0, 0, 0, 0, '12605', 15, 6834, '2011-08-01 17:00:27', '2015-03-20 12:09:37', 1030, 0, '', 5, 5, 0, 0, 1, 0, 0, 0, '12605', '12605 Женская обувь Латина', '', '<p>Женская обувь Латина DANCELIFE артикул 12605</p>', '', '', '', 0, ''),
(854, 590, 0, 5900, 0, 0, 0, 0, 0, '12625', 16, 6837, '2011-08-01 17:00:27', '2015-03-20 12:09:56', 1101, 3, '', 5, 5, 0, 0, 1, 0, 0, 0, '12625', '12625 Женская обувь Латина', '', '<p>Женская обувь Латина DANCELIFE артикул 12625</p>', '', '', '', 0, ''),
(855, 590, 0, 5900, 0, 0, 0, 0, 0, '12635', 17, 6840, '2011-08-01 17:00:27', '2015-03-20 12:10:13', 974, 0, '', 5, 5, 0, 0, 1, 0, 0, 0, '12635', '12635 Женская обувь Латина', '', '<p>Женская обувь Латина DANCELIFE артикул 12635</p>', '', '', '', 0, ''),
(856, 590, 0, 7300, 0, 0, 2, 1, 0, '13533', 18, 6843, '2011-08-01 17:00:27', '2015-03-02 13:14:31', 1398, 6, '', 5, 5, 0, 0, 1, 0, 0, 1, '13533', '13533 Женская обувь Латина', '', '<p>Женская обувь Латина DANCELIFE артикул 13533</p>', '', '', '', 0, ''),
(857, 590, 0, 7300, 0, 0, 3, 1, 0, '13632', 19, 6846, '2011-08-01 17:00:27', '2015-03-02 13:05:39', 1400, 4, '', 5, 5, 0, 0, 1, 0, 0, 1, '13632', '13632 Женская обувь Латина', '', '<p>Женская обувь Латина DANCELIFE артикул 13632</p>', '', '', '', 0, ''),
(858, 590, 0, 7300, 0, 0, 3, 1, 0, '13633', 20, 6849, '2011-08-01 17:00:27', '2015-03-02 13:06:21', 1231, 2, '', 5, 5, 0, 0, 1, 0, 0, 1, '13633', '13633 Женская обувь Латина', '', '<p>Женская обувь Латина DANCELIFE артикул 13633</p>', '', '', '', 0, ''),
(859, 590, 0, 5900, 0, 0, 1, 0, 0, '13635', 21, 6852, '2011-08-01 17:00:27', '2015-03-20 12:10:35', 1040, 3, '', 5, 5, 0, 0, 1, 0, 0, 0, '13635', '13635 Женская обувь Латина', '', '<p>Женская обувь Латина DANCELIFE артикул 13635</p>', '', '', '', 0, ''),
(860, 590, 0, 4300, 0, 0, 2, 1, 7300, '13732', 22, 6855, '2011-08-01 17:00:27', '2015-09-11 11:25:39', 2648, 5, '', 5, 5, 0, 0, 1, 0, 0, 1, '13732', '13732 Женская обувь Латина', '', '<p>Женская обувь Латина DANCELIFE артикул 13732</p>', '', '', '', 0, ''),
(861, 590, 0, 4300, 0, 0, 0, 1, 7300, '13733', 23, 6858, '2011-08-01 17:00:28', '2015-09-11 11:25:52', 2628, 1, '', 5, 5, 0, 0, 1, 0, 0, 1, '13733', '13733 Женская обувь Латина', '', '<p> Женская обувь Латина DANCELIFE артикул 13733</p>', '', '', '', 0, ''),
(862, 590, 0, 8000, 0, 0, 0, 1, 0, '14605', 24, 6861, '2011-08-01 17:00:28', '2012-09-04 02:20:00', 1227, 4, '', 5, 5, 0, 0, 1, 0, 0, 1, '14605', '14605 Женская обувь Латина', '', '<p>Женская обувь Латина DANCELIFE артикул 14605</p>', '', '', '', 0, ''),
(863, 590, 0, 8000, 0, 0, 0, 1, 0, '14735', 25, 6864, '2011-08-01 17:00:28', '2012-09-04 02:20:19', 1229, 0, '', 5, 5, 0, 0, 1, 0, 0, 1, '14735', '14735 Женская обувь Латина', '', '<p>Женская обувь Латина DANCELIFE артикул 14735</p>', '', '', '', 0, ''),
(864, 590, 0, 8000, 0, 0, 4, 1, 0, '16675', 26, 6867, '2011-08-01 17:00:28', '2015-03-02 14:01:42', 1356, 8, '', 5, 5, 0, 0, 1, 0, 0, 1, '16675', '16675 Женская обувь Латина', '', '<p>Женская обувь Латина DANCELIFE артикул 16675</p>', '', '', '', 0, ''),
(865, 590, 0, 8000, 0, 0, 0, 1, 0, '16735', 27, 6870, '2011-08-01 17:00:28', '2015-03-02 14:02:18', 1637, 2, '', 5, 5, 0, 0, 1, 0, 0, 1, '16735', '16735 Женская обувь Латина', '', '<p>Женская обувь Латина DANCELIFE артикул 16735</p>', '', '', '', 0, ''),
(866, 590, 0, 7300, 0, 0, 0, 1, 0, '17639', 28, 6873, '2011-08-01 17:00:28', '2015-03-02 14:02:44', 1165, 4, '', 5, 5, 0, 0, 1, 0, 0, 1, '17639', '17639 Женская обувь Латина', '', '<p>Женская обувь Латина DANCELIFE артикул 17639</p>', '', '', '', 0, ''),
(867, 591, 0, 8000, 0, 0, 1, 1, 0, '24667', 30, 6876, '2011-08-01 17:00:28', '2015-03-02 14:05:12', 1178, 4, '', 5, 5, 0, 0, 1, 0, 0, 1, '24667', '24667 Женская обувь Стандарт', '', '<p>Женская обувь Стандарт DANCELIFE артикул 24667</p>', '', '', '', 0, ''),
(868, 591, 0, 7300, 0, 0, 6, 1, 0, '25567', 31, 6879, '2011-08-01 17:00:28', '2015-03-02 14:05:47', 1116, 8, '', 5, 5, 0, 0, 1, 0, 0, 1, '25567', '25567 Женская обувь Стандарт', '', '<p>Женская обувь Стандарт DANCELIFE артикул 25567</p>', '', '', '', 0, ''),
(869, 591, 0, 7300, 0, 0, 2, 1, 0, '25667', 32, 6882, '2011-08-01 17:00:28', '2015-03-02 14:06:12', 1066, 5, '', 5, 5, 0, 0, 1, 0, 0, 1, '25667', '25667 Женская обувь Стандарт', '', '<p>Женская обувь Стандарт DANCELIFE артикул 25667</p>', '', '', '', 0, ''),
(870, 591, 0, 8000, -2, 0, 1, 1, 0, '27567', 33, 6885, '2011-08-01 17:00:28', '2015-03-02 14:06:56', 1210, 11, '', 5, 5, 0, 0, 1, 0, 0, 1, '27567', '27567 Женская обувь Стандарт', '', '<p>Женская обувь Стандарт DANCELIFE артикул 27567</p>', '', '', '', 0, ''),
(871, 591, 0, 8000, -1, 0, 7, 1, 0, '27667', 34, 6888, '2011-08-01 17:00:28', '2015-03-02 14:07:31', 1632, 8, '', 5, 5, 0, 0, 1, 0, 0, 1, '27667', '27667 Женская обувь Стандарт', '', '<p>Женская обувь Стандарт DANCELIFE артикул 27667</p>', '', '', '', 0, ''),
(872, 592, 0, 7300, 0, 0, 2, 1, 0, '49000', 35, 6891, '2011-08-01 17:00:28', '2015-03-02 14:08:23', 1195, 8, '', 5, 5, 0, 0, 1, 0, 0, 1, '49000', '49000 Другие направления', '', '<p>Женская обувь DANCELIFE артикул 49000</p>', '', '', '', 0, ''),
(873, 592, 0, 6200, 0, 0, 1, 0, 0, '49500', 36, 6894, '2011-08-01 17:00:28', '2015-03-20 12:11:12', 920, 2, '', 5, 5, 0, 0, 1, 0, 0, 0, '49500', '49500 Другие направления', '', '<p>Женская обувь DANCELIFE артикул 49500</p>', '', '', '', 0, ''),
(874, 592, 0, 8000, 0, 0, 0, 1, 0, '62608', 37, 6897, '2011-08-01 17:00:28', '2015-03-02 14:09:56', 1069, 1, '', 5, 5, 0, 0, 1, 0, 0, 1, '62608', '62608 Другие направления', '', '<p>Женская обувь DANCELIFE артикул 62608</p>', '', '', '', 0, ''),
(875, 592, 0, 8000, 0, 0, 1, 1, 0, '63608', 38, 6900, '2011-08-01 17:00:28', '2015-03-02 14:10:35', 1084, 3, '', 5, 5, 0, 0, 1, 0, 0, 1, '63608', '63608 Другие направления', '', '<p>Женская обувь DANCELIFE артикул 63608</p>', '', '', '', 0, ''),
(876, 592, 0, 7300, 0, 0, 1, 1, 0, '63668', 39, 6903, '2011-08-01 17:00:28', '2015-03-20 13:11:36', 1094, 1, '', 5, 5, 0, 0, 1, 0, 0, 1, '63668_lt', '63668 Другие направления', '', '<p>Женская обувь DANCELIFE артикул 63668</p>', '', '', '', 0, ''),
(877, 594, 0, 9900, 0, 0, 2, 1, 0, '90302', 1, 6906, '2011-08-01 17:00:28', '2015-02-16 14:10:54', 1382, 4, '', 5, 5, 0, 0, 1, 0, 0, 1, '90302', '90302 Мужская обувь Латина', '', '<p>Мужская обувь Латина DANCELIFE артикул 90302</p>', '', '', '', 0, ''),
(878, 594, 0, 5500, 0, 0, 1, 0, 7300, '92302', 2, 6909, '2011-08-01 17:00:28', '2015-08-20 21:47:44', 3000, 4, '', 5, 5, 0, 0, 1, 0, 0, 0, '92302', '92302 Мужская обувь Латина', '', '<p>Мужская обувь Латина DANCELIFE артикул 92302</p>', '', '', '', 0, ''),
(879, 594, 0, 5500, 0, 0, 0, 0, 7300, '92392', 3, 6912, '2011-08-01 17:00:28', '2015-08-20 21:47:54', 2557, 1, '', 5, 5, 0, 0, 1, 0, 0, 0, '92392', '92392 Мужская обувь Латина', '', '<p>Мужская обувь Латина DANCELIFE артикул 92392</p>', '', '', '', 0, ''),
(880, 594, 0, 9900, 0, 0, 0, 1, 0, '95302', 4, 6915, '2011-08-01 17:00:28', '2015-02-16 14:14:21', 1394, 10, '', 5, 5, 0, 0, 1, 0, 0, 1, '95302-1', '95302 Мужская обувь Латина', '', '<p>Мужская обувь Латина DANCELIFE артикул 95302</p>', '', '', '', 0, ''),
(881, 594, 0, 9900, 0, 0, 2, 1, 0, '95302_no_print', 5, 6918, '2011-08-01 17:00:28', '2015-02-16 14:12:58', 1769, 8, '', 5, 5, 0, 0, 1, 0, 0, 1, '95302-no-print', '95302 (no print) Мужская Латина', '', '<p>Мужская обувь Латина DANCELIFE артикул 95302 (no print)</p>', '', '', '', 0, ''),
(882, 594, 0, 9900, 0, 0, 0, 1, 0, '97302', 6, 6921, '2011-08-01 17:00:28', '2015-02-16 14:15:11', 1520, 8, '', 5, 5, 0, 0, 1, 0, 0, 1, '97302', '97302 Мужская обувь Латина', '', '<p>Мужская обувь Латина DANCELIFE артикул 97302</p>', '', '', '', 0, ''),
(883, 595, 0, 9100, 0, 0, 2, 1, 0, '00202', 0, 6924, '2011-08-01 17:00:28', '2015-02-16 14:08:15', 1314, 12, '', 5, 5, 0, 0, 1, 0, 0, 1, '00202', '00202 Мужская обувь Стандарт', '', '<p>Мужская обувь Стандарт DANCELIFE артикул 00202</p>', '', '', '', 0, ''),
(884, 595, 0, 9100, 0, 0, 5, 1, 0, '00222', 0, 6927, '2011-08-01 17:00:28', '2015-02-16 14:08:34', 1426, 18, '', 5, 5, 0, 0, 1, 0, 0, 1, '00222', '00222 Мужская обувь Стандарт', '', '<p>Мужская обувь Стандарт DANCELIFE артикул 00222</p>', '', '', '', 0, ''),
(885, 596, 0, 4600, 0, 0, 0, 0, 0, '1039', 6, 6930, '2011-08-01 17:00:28', '2012-10-05 00:43:15', 201, 1, '', 5, 5, 0, 0, 1, 0, 0, 1, '1039', '1039 Детская обувь', '', '<p>Детская обувь DANCELIFE артикул 1039</p>', '', '', '', 0, ''),
(886, 596, 0, 4600, -1, 0, 3, 1, 0, '1133', 1, 6952, '2011-08-01 17:00:28', '2015-03-02 14:14:29', 1466, 8, '', 5, 5, 0, 0, 1, 0, 0, 1, '1133', '1133 Детская обувь', '', '<p>Детская обувь DANCELIFE для девочек. артикул 1133</p>', '', '', '', 0, ''),
(887, 596, 0, 4600, -1, 0, 1, 1, 0, '1134', 2, 6936, '2011-08-01 17:00:28', '2012-10-08 19:39:41', 1276, 3, '', 5, 5, 0, 0, 1, 0, 0, 1, '1134', '1134 Детская обувь', '', '<p>Детская обувь DANCELIFE для девочек. артикул 1134</p>', '', '', '', 0, ''),
(888, 596, 0, 4600, 0, 0, 5, 1, 0, '1135', 3, 6939, '2011-08-01 17:00:28', '2012-10-08 19:39:15', 1201, 8, '', 5, 5, 0, 0, 1, 0, 0, 1, '1135', '1135 Детская обувь', '', '<p>Детская обувь DANCELIFE для девочек. артикул 1135</p>', '', '', '', 0, ''),
(889, 596, 0, 4600, -1, 0, 1, 1, 0, '2020', 4, 6942, '2011-08-01 17:00:28', '2012-10-08 19:40:33', 1190, 3, '', 5, 5, 0, 0, 1, 0, 0, 1, '2020', '2020 Детская обувь', '', '<p>Детская обувь DANCELIFE для мальчиков. артикул 2020</p>', '', '', '', 0, ''),
(890, 596, 0, 4600, 0, 0, 0, 1, 0, '2022', 5, 6945, '2011-08-01 17:00:28', '2012-10-08 19:41:14', 1231, 9, '', 5, 5, 0, 0, 1, 0, 0, 1, '2022', '2022 Детская обувь', '', '<p>Детская обувь DANCELIFE для мальчиков. артикул 2022</p>', '', '', '', 0, ''),
(891, 597, 0, 300, -2, 0, 5, 1, 0, 'nak_latina', 5, 6948, '2011-08-01 17:00:28', '2015-03-20 13:58:58', 1615, 11, '', 5, 5, 0, 0, 1, 0, 0, 1, 'firmennye-nakabluchniki-dancelife-latina-hpl', 'Накаблучники Латина HPL', '', '<p>Фирменные накаблучники Dancelife Латина HPL специально разработаны и произведены для обуви Dancelife. В упаковке три пары. Цена за упаковку.</p>', '', '', '', 0, ''),
(892, 597, 0, 300, -2, 0, 5, 1, 0, 'nak_standart', 6, 6950, '2011-08-01 17:00:28', '2015-03-20 13:59:28', 1209, 9, '', 5, 5, 0, 0, 1, 0, 0, 1, 'firmennye-nakabluchniki-dancelife-standart-hpb', 'Накаблучники Стандарт HPB', '', '<p>Фирменные накаблучники Dancelife Стандарт HPB специально разработаны и произведены для обуви Dancelife. В упаковке три пары. Цена за упаковку.</p>', '', '', '', 0, ''),
(894, 597, 0, 350, -1, 0, 0, 1, 0, 'shoebrushes_ESBOR', 8, 6957, '2011-08-08 15:36:44', '2015-03-20 13:59:46', 1500, 10, '', 5, 5, 0, 0, 1, 0, 0, 1, 'shetka-dlja-obuvi-esbor', 'Щетка для обуви ESBOR', '', '<p><span><span>Фирменная щетка Dancelife ESBOR с интегрированным чехлом, </span></span><span>для ухода за подошвой\r\nпрофессиональной танцевальной обуви </span><span lang="EN-US">DANCELIFE</span><span> – неотъемлемый атрибут экипировки танцора. Поднимает\r\nворс спилока и очищает его от грязи, тем самым восстанавливая основную функцию подошвы\r\nтанцевальной обуви. </span></p>\r\n<p><span><span>Размер: 17,5 х 3,5 х 2,5 см.</span></span></p>', '', '', '', 0, ''),
(895, 590, 0, 7300, 0, 0, 1, 0, 0, '17739', 29, 6954, '2012-04-04 17:18:39', '2015-09-18 23:58:37', 901, 1, '', 5, 5, 0, 0, 1, 0, 0, 0, '17739', '17739 Женская обувь Латина', '', '<p>Женская обувь Латина DANCELIFE артикул 17739</p>', '', '', '', 0, ''),
(896, 594, 0, 9900, 0, 0, 1, 1, 0, '98302', 7, 6967, '2012-04-04 17:35:50', '2015-02-16 14:15:23', 1188, 3, '', 5, 5, 0, 0, 1, 0, 0, 1, '98302', '98302 Мужская обувь Латина', '', '<p>Мужская обувь Латина DANCELIFE артикул 98302</p>', '', '', '', 0, ''),
(897, 597, 0, 1200, 0, 0, 0, 1, 0, 'polo_dancelife', 3, 6971, '2012-09-04 01:11:32', '2012-09-04 02:41:53', 1039, 4, '', 5, 5, 0, 0, 1, 0, 0, 1, 'polo-dancelife', 'Поло DANCELIFE', '', '<p>Футболка поло белая DANCELIFE </p>\r\n<p>Футболка поло черная DANCELIFE\r\n</p>', '', '', '', 0, ''),
(898, 597, 0, 3800, 0, 0, 0, 1, 0, 'tracksuit_dancelife', 1, 6973, '2012-09-04 01:23:15', '2012-10-08 19:02:47', 1235, 2, '', 5, 5, 0, 0, 1, 0, 0, 1, 'kostjum-dancelife', 'Костюм DANCELIFE', '', '<p>Спортивный костюм DANCELIFE</p>', '', '', '', 0, ''),
(899, 597, 0, 2000, 0, 0, 0, 1, 0, 'hoodie_dancelife', 2, 6975, '2012-09-04 01:30:38', '2012-09-04 01:52:40', 945, 0, '', 5, 5, 0, 0, 1, 0, 0, 1, 'kurtka-dancelife', 'Куртка DANCELIFE', '', '<p>Куртка с капюшоном белая DANCELIFE</p>', '', '', '', 0, ''),
(900, 597, 0, 1600, 0, 0, 0, 1, 0, 'kimono_dancelife', 4, 6977, '2012-09-04 01:34:35', '2012-09-04 01:53:20', 1057, 1, '', 5, 5, 0, 0, 1, 0, 0, 1, 'halat-dancelife', 'Халат DANCELIFE', '', '<p><span>Халат-кимоно DANCELIFE</span>\r\n</p>', '', '', '', 0, ''),
(901, 590, 0, 8000, 0, 0, 1, 0, 0, '18833s', 7, 6982, '2012-10-08 17:59:11', '2015-08-20 21:45:27', 1639, 2, '', 5, 5, 0, 0, 1, 0, 0, 0, '18833s-zhenskaja-obuv-latina', '18833s Женская обувь Латина', '', '<p>Женская обувь Латина DANCELIFE артикул 18833s</p>', '', '', '', 0, ''),
(902, 590, 0, 8000, 0, 0, 0, 0, 0, '18633s', 6, 6985, '2012-10-08 18:34:05', '2015-08-20 21:45:16', 955, 0, '', 5, 5, 0, 0, 1, 0, 0, 0, '18633s-zhenskaja-obuv-latina', '18633s Женская обувь Латина', '', '<p>Женская обувь Латина DANCELIFE артикул 18633s</p>', '', '', '', 0, ''),
(903, 590, 0, 8000, 0, 0, 1, 1, 0, '18533s', 5, 6988, '2012-10-08 18:38:54', '2015-03-02 14:03:10', 1113, 1, '', 5, 5, 0, 0, 1, 0, 0, 1, '18533s-zhenskaja-obuv-latina', '18533s Женская обувь Латина', '', '<p>Женская обувь Латина DANCELIFE артикул 18533s\r\n</p>', '', '', '', 0, ''),
(904, 590, 0, 8000, 0, 0, 1, 1, 0, '14735s', 4, 6991, '2012-10-08 18:43:59', '2015-03-02 14:01:19', 1138, 1, '', 5, 5, 0, 0, 1, 0, 0, 1, '14735s-zhenskaja-obuv-latina', '14735s Женская обувь Латина', '', '<p>Женская обувь Латина DANCELIFE артикул 14735s\r\n</p>', '', '', '', 0, ''),
(905, 590, 0, 8000, 0, 0, 1, 1, 0, '14605s', 3, 6992, '2012-10-08 18:49:19', '2015-03-02 13:20:30', 1065, 2, '', 5, 5, 0, 0, 1, 0, 0, 1, '14605s-zhenskaja-obuv-latina', '14605s Женская обувь Латина', '', '<p>Женская обувь Латина DANCELIFE артикул 14605s\r\n</p>', '', '', '', 0, ''),
(906, 590, 0, 8000, 0, 0, 0, 1, 0, '13634s', 1, 6993, '2012-10-08 18:55:03', '2012-10-08 20:08:27', 1515, 8, '', 5, 5, 0, 0, 1, 0, 0, 1, '13634s-zhenskaja-obuv-latina', '13634s Женская обувь Латина', '', '<p>Женская обувь Латина DANCELIFE артикул 13634s\r\n</p>', '', '', '', 0, ''),
(907, 590, 0, 8000, 0, 0, 0, 1, 0, '13734s', 2, 6995, '2012-10-08 19:05:59', '2015-03-02 13:17:54', 1424, 1, '', 5, 5, 0, 0, 1, 0, 0, 1, '13734s-zhenskaja-obuv-latina', '13734s Женская обувь Латина', '', '<p>Женская обувь Латина DANCELIFE артикул 13734s\r\n</p>', '', '', '', 0, ''),
(908, 594, 0, 9900, 0, 0, 0, 0, 0, '95322', 0, 6997, '2015-01-23 14:52:56', '2015-08-20 21:47:22', 143, 0, '', 5, 5, 0, 0, 1, 0, 0, 0, '95322', '95322 МУЖСКАЯ ОБУВЬ ЛАТИНА', '', '<p>Мужская обувь Латина DANCELIFE артикул 95322</p>', '', '', '', 0, ''),
(909, 595, 0, 7100, 0, 0, 0, 0, 0, '07201', 0, 6998, '2015-02-16 14:03:32', '2015-08-20 21:48:22', 143, 1, '', 5, 5, 0, 0, 1, 0, 0, 0, '07201', '007201 Мужская обувь Стандарт', '<p>Мужская обувь Стандарт DANCELIFE артикул 007201</p>', '<p>Мужская обувь Стандарт DANCELIFE артикул 007201</p>', '', '', '', 0, ''),
(910, 595, 0, 7100, 0, 0, 0, 0, 0, '03221', 0, 7001, '2015-02-16 14:24:32', '2015-03-20 12:12:03', 38, 0, '', 5, 5, 0, 0, 1, 0, 0, 0, '03221', '03221 Мужская обувь Стандарт', '<p>Мужская обувь Стандарт DANCELIFE артикул 03221</p>', '<p>Мужская обувь Стандарт DANCELIFE артикул 03221</p>', '', '', '', 0, ''),
(911, 595, 0, 7100, 0, 0, 0, 0, 0, '01222', 0, 7002, '2015-02-16 14:33:25', '2015-03-20 12:11:44', 42, 0, '', 5, 5, 0, 0, 1, 0, 0, 0, '01222', '01222 Мужская обувь Стандарт', '<p>Мужская обувь Стандарт DANCELIFE артикул 01222</p>', '<p>Мужская обувь Стандарт DANCELIFE артикул 01222</p>', '', '', '', 0, ''),
(912, 595, 0, 7100, 0, 0, 0, 0, 0, '53201', 0, 7004, '2015-02-16 14:42:35', '2015-03-20 12:12:24', 29, 0, '', 5, 5, 0, 0, 1, 0, 0, 0, '53201', '53201 Мужская обувь Стандарт', '<p>Мужская обувь Стандарт DANCELIFE артикул 53201</p>', '<p>Мужская обувь Стандарт DANCELIFE артикул 53201</p>', '', '', '', 0, ''),
(913, 595, 0, 7100, 0, 0, 0, 0, 0, '57231', 0, 7005, '2015-02-16 14:49:43', '2015-03-20 12:12:36', 27, 0, '', 5, 5, 0, 0, 1, 0, 0, 0, '57231', '57231 Мужская обувь Стандарт', '<p>Мужская обувь Стандарт DANCELIFE артикул 57231</p>', '<p>Мужская обувь Стандарт DANCELIFE артикул 57231</p>', '', '', '', 0, ''),
(915, 592, 0, 6700, 0, 0, 0, 0, 7000, '810', 40, 7008, '2015-03-20 12:36:23', '2015-08-20 21:46:19', 116, 1, '', 5, 5, 0, 0, 1, 0, 0, 0, '810', '810 Другие направления', '', '<p>Женская обувь DANCELIFE артикул 810</p>', '', '', '', 0, ''),
(914, 597, 0, 300, 0, 0, 0, 1, 0, 'nak_slim', 7, 7007, '2015-03-10 15:43:31', '2015-03-20 13:59:09', 129, 1, '', 5, 5, 0, 0, 1, 0, 0, 1, 'firmennye-nakabluchniki-dancelife-slim-hps', 'Накаблучники Слим HPS', '', '<p>Фирменные накаблучники Dancelife Слим HPS специально разработаны и произведены для обуви Dancelife. В упаковке три пары. Цена за упаковку.</p>', '', '', '', 0, ''),
(916, 592, 0, 6200, 0, 0, 0, 0, 6400, '63668 J', 41, 7009, '2015-03-20 13:06:05', '2015-08-20 21:46:08', 98, 0, '', 5, 5, 0, 0, 1, 0, 0, 0, '63668_j', '63668 J Другие направления', '', '<p> </p>\r\n<div>\r\n<p>Женская обувь DANCELIFE артикул 63668 J</p>\r\n</div>\r\n<p> </p>', '', '', '', 0, ''),
(917, 597, 0, 300, 0, 0, 0, 1, 500, 'badge_DANCELIFE', 9, 7012, '2015-03-20 13:24:02', '2015-04-10 22:07:41', 134, 2, '', 5, 5, 0, 0, 1, 0, 0, 1, 'badge_dancelife', 'Бэйдж DANCELIFE', '', '<p>Фирменный бэйжд DANCELIFE с вышивкой логотипа и названия компании</p>', '', '', '', 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `SC_products_opt_val_variants`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_products_opt_val_variants`;
CREATE TABLE IF NOT EXISTS `SC_products_opt_val_variants` (
  `variantID` int(11) NOT NULL,
  `optionID` int(11) NOT NULL DEFAULT '0',
  `sort_order` int(11) DEFAULT '0',
  `option_value_ru` varchar(255) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=136 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_products_opt_val_variants`
--

INSERT INTO `SC_products_opt_val_variants` (`variantID`, `optionID`, `sort_order`, `option_value_ru`) VALUES
(101, 32, 9, '2'),
(102, 32, 10, '2.5'),
(103, 32, 11, '3'),
(104, 32, 12, '3.5'),
(105, 32, 13, '4'),
(106, 32, 14, '4.5'),
(107, 32, 15, '5'),
(108, 32, 16, '5.5'),
(109, 32, 17, '6'),
(110, 32, 18, '6.5'),
(111, 32, 19, '7'),
(112, 32, 20, '7.5'),
(113, 32, 21, '8'),
(114, 32, 22, '8.5'),
(115, 32, 29, '12'),
(116, 32, 28, '11.5'),
(117, 32, 27, '11'),
(118, 32, 26, '10.5'),
(119, 32, 25, '10'),
(120, 32, 24, '9.5'),
(121, 32, 23, '9'),
(122, 32, 1, 'C8'),
(123, 32, 2, 'C9'),
(124, 32, 3, 'C10'),
(125, 32, 4, 'C11'),
(126, 32, 5, 'C12'),
(127, 32, 8, '1.5'),
(128, 32, 7, '1'),
(129, 32, 6, 'C13'),
(130, 32, 30, 'S'),
(131, 32, 31, 'M'),
(132, 32, 32, 'L'),
(133, 32, 33, 'XL'),
(134, 34, 1, 'Белый'),
(135, 34, 2, 'Черный');

-- --------------------------------------------------------

--
-- Структура таблицы `SC_product_list`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_product_list`;
CREATE TABLE IF NOT EXISTS `SC_product_list` (
  `id` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_product_list`
--

INSERT INTO `SC_product_list` (`id`, `name`) VALUES
('specialoffers', 'Специальные предложения');

-- --------------------------------------------------------

--
-- Структура таблицы `SC_product_list_item`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_product_list_item`;
CREATE TABLE IF NOT EXISTS `SC_product_list_item` (
  `list_id` varchar(20) NOT NULL DEFAULT '',
  `productID` int(10) unsigned NOT NULL DEFAULT '0',
  `priority` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_product_list_item`
--

INSERT INTO `SC_product_list_item` (`list_id`, `productID`, `priority`) VALUES
('specialoffers', 895, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `SC_product_options`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Мар 20 2015 г., 10:55
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_product_options`;
CREATE TABLE IF NOT EXISTS `SC_product_options` (
  `optionID` int(11) NOT NULL,
  `sort_order` int(11) DEFAULT '0',
  `name_ru` varchar(50) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_product_options`
--

INSERT INTO `SC_product_options` (`optionID`, `sort_order`, `name_ru`) VALUES
(31, 0, 'Материал'),
(32, 0, 'Размер'),
(33, 1, 'Каблук'),
(34, 0, 'Цвет'),
(35, 5, 'Условия доставки');

-- --------------------------------------------------------

--
-- Структура таблицы `SC_product_options_set`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Сен 18 2015 г., 21:18
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_product_options_set`;
CREATE TABLE IF NOT EXISTS `SC_product_options_set` (
  `productID` int(11) NOT NULL DEFAULT '0',
  `optionID` int(11) NOT NULL DEFAULT '0',
  `variantID` int(11) NOT NULL DEFAULT '0',
  `price_surplus` float DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_product_options_set`
--

INSERT INTO `SC_product_options_set` (`productID`, `optionID`, `variantID`, `price_surplus`) VALUES
(903, 32, 111, 0),
(846, 32, 105, 0),
(846, 32, 106, 0),
(846, 32, 107, 0),
(846, 32, 108, 0),
(846, 32, 109, 0),
(846, 32, 110, 0),
(846, 32, 111, 0),
(903, 32, 110, 0),
(903, 32, 109, 0),
(903, 32, 108, 0),
(847, 32, 104, 0),
(847, 32, 105, 0),
(847, 32, 106, 0),
(847, 32, 107, 0),
(848, 32, 110, 0),
(847, 32, 109, 0),
(847, 32, 110, 0),
(847, 32, 111, 0),
(903, 32, 107, 0),
(903, 32, 106, 0),
(903, 32, 105, 0),
(848, 32, 104, 0),
(848, 32, 106, 0),
(848, 32, 107, 0),
(848, 32, 108, 0),
(848, 32, 111, 0),
(905, 32, 105, 0),
(849, 32, 107, 0),
(849, 32, 108, 0),
(849, 32, 109, 0),
(849, 32, 110, 0),
(902, 32, 109, 0),
(902, 32, 107, 0),
(850, 32, 104, 0),
(850, 32, 105, 0),
(850, 32, 106, 0),
(850, 32, 107, 0),
(850, 32, 108, 0),
(850, 32, 109, 0),
(850, 32, 110, 0),
(850, 32, 111, 0),
(895, 32, 110, 0),
(895, 32, 108, 0),
(851, 32, 105, 0),
(851, 32, 106, 0),
(851, 32, 107, 0),
(848, 32, 105, 0),
(851, 32, 109, 0),
(851, 32, 110, 0),
(851, 32, 111, 0),
(895, 32, 106, 0),
(902, 32, 105, 0),
(901, 32, 112, 0),
(852, 32, 104, 0),
(852, 32, 105, 0),
(852, 32, 106, 0),
(852, 32, 107, 0),
(852, 32, 108, 0),
(852, 32, 111, 0),
(901, 32, 110, 0),
(901, 32, 109, 0),
(853, 32, 105, 0),
(853, 32, 106, 0),
(853, 32, 107, 0),
(853, 32, 108, 0),
(853, 32, 109, 0),
(853, 32, 110, 0),
(853, 32, 111, 0),
(901, 32, 108, 0),
(901, 32, 107, 0),
(901, 32, 106, 0),
(854, 32, 103, 0),
(854, 32, 105, 0),
(854, 32, 106, 0),
(854, 32, 107, 0),
(854, 32, 108, 0),
(854, 32, 109, 0),
(854, 32, 110, 0),
(855, 32, 105, 0),
(855, 32, 106, 0),
(855, 32, 107, 0),
(855, 32, 108, 0),
(855, 32, 109, 0),
(855, 32, 110, 0),
(855, 32, 111, 0),
(856, 32, 109, 0),
(856, 32, 110, 0),
(856, 32, 111, 0),
(856, 32, 108, 0),
(856, 32, 107, 0),
(856, 32, 105, 0),
(856, 32, 104, 0),
(857, 32, 111, 0),
(857, 32, 110, 0),
(857, 32, 109, 0),
(857, 32, 106, 0),
(857, 32, 105, 0),
(858, 32, 111, 0),
(858, 32, 110, 0),
(858, 32, 109, 0),
(858, 32, 106, 0),
(858, 32, 105, 0),
(859, 32, 105, 0),
(859, 32, 107, 0),
(859, 32, 109, 0),
(860, 32, 104, 0),
(860, 32, 105, 0),
(860, 32, 106, 0),
(860, 32, 107, 0),
(860, 32, 108, 0),
(860, 32, 109, 0),
(860, 32, 110, 0),
(860, 32, 111, 0),
(861, 32, 105, 0),
(861, 32, 106, 0),
(861, 32, 107, 0),
(861, 32, 108, 0),
(861, 32, 109, 0),
(861, 32, 110, 0),
(861, 32, 111, 0),
(907, 32, 104, 0),
(862, 32, 111, 0),
(862, 32, 110, 0),
(862, 32, 109, 0),
(862, 32, 108, 0),
(862, 32, 107, 0),
(862, 32, 106, 0),
(862, 32, 105, 0),
(862, 32, 104, 0),
(862, 32, 103, 0),
(863, 32, 104, 0),
(863, 32, 105, 0),
(863, 32, 106, 0),
(863, 32, 107, 0),
(863, 32, 108, 0),
(863, 32, 109, 0),
(863, 32, 110, 0),
(863, 32, 111, 0),
(864, 32, 104, 0),
(864, 32, 105, 0),
(864, 32, 106, 0),
(864, 32, 107, 0),
(864, 32, 108, 0),
(864, 32, 109, 0),
(864, 32, 110, 0),
(864, 32, 111, 0),
(864, 32, 112, 0),
(865, 32, 112, 0),
(865, 32, 111, 0),
(865, 32, 110, 0),
(865, 32, 109, 0),
(865, 32, 108, 0),
(865, 32, 107, 0),
(865, 32, 106, 0),
(865, 32, 105, 0),
(896, 32, 109, 0),
(896, 32, 108, 0),
(866, 32, 104, 0),
(866, 32, 105, 0),
(866, 32, 106, 0),
(866, 32, 107, 0),
(866, 32, 108, 0),
(866, 32, 109, 0),
(866, 32, 110, 0),
(866, 32, 111, 0),
(896, 32, 107, 0),
(867, 32, 112, 0),
(867, 32, 111, 0),
(867, 32, 110, 0),
(867, 32, 109, 0),
(867, 32, 108, 0),
(867, 32, 107, 0),
(867, 32, 106, 0),
(867, 32, 105, 0),
(868, 32, 105, 0),
(868, 32, 106, 0),
(868, 32, 107, 0),
(868, 32, 109, 0),
(868, 32, 110, 0),
(868, 32, 111, 0),
(869, 32, 112, 0),
(869, 32, 110, 0),
(869, 32, 109, 0),
(869, 32, 108, 0),
(869, 32, 107, 0),
(869, 32, 106, 0),
(869, 32, 105, 0),
(870, 32, 104, 0),
(870, 32, 105, 0),
(870, 32, 106, 0),
(870, 32, 107, 0),
(870, 32, 108, 0),
(870, 32, 109, 0),
(870, 32, 110, 0),
(870, 32, 111, 0),
(871, 32, 112, 0),
(871, 32, 111, 0),
(871, 32, 110, 0),
(871, 32, 109, 0),
(871, 32, 108, 0),
(871, 32, 107, 0),
(871, 32, 106, 0),
(871, 32, 105, 0),
(872, 32, 112, 0),
(872, 32, 111, 0),
(872, 32, 110, 0),
(872, 32, 108, 0),
(872, 32, 107, 0),
(872, 32, 106, 0),
(872, 32, 105, 0),
(872, 32, 104, 0),
(873, 32, 105, 0),
(873, 32, 104, 0),
(874, 32, 113, 0),
(874, 32, 112, 0),
(874, 32, 111, 0),
(874, 32, 110, 0),
(874, 32, 109, 0),
(874, 32, 108, 0),
(874, 32, 107, 0),
(874, 32, 106, 0),
(874, 32, 105, 0),
(874, 32, 104, 0),
(875, 32, 111, 0),
(875, 32, 110, 0),
(875, 32, 109, 0),
(875, 32, 108, 0),
(875, 32, 107, 0),
(875, 32, 106, 0),
(875, 32, 105, 0),
(875, 32, 104, 0),
(915, 32, 110, 0),
(916, 32, 107, 0),
(916, 32, 110, 0),
(876, 32, 111, 0),
(876, 32, 110, 0),
(876, 32, 109, 0),
(876, 32, 108, 0),
(876, 32, 107, 0),
(876, 32, 106, 0),
(876, 32, 105, 0),
(877, 32, 120, 0),
(877, 32, 121, 0),
(877, 32, 114, 0),
(877, 32, 113, 0),
(877, 32, 112, 0),
(877, 32, 111, 0),
(877, 32, 110, 0),
(877, 32, 109, 0),
(909, 32, 119, 0),
(909, 32, 117, 0),
(909, 32, 110, 0),
(909, 32, 109, 0),
(878, 32, 121, 0),
(909, 32, 120, 0),
(878, 32, 110, 0),
(879, 32, 121, 0),
(913, 32, 121, 0),
(879, 32, 111, 0),
(913, 32, 113, 0),
(880, 32, 117, 0),
(880, 32, 118, 0),
(880, 32, 119, 0),
(910, 32, 113, 0),
(910, 32, 111, 0),
(910, 32, 117, 0),
(880, 32, 112, 0),
(911, 32, 112, 0),
(880, 32, 110, 0),
(912, 32, 111, 0),
(912, 32, 113, 0),
(881, 32, 107, 0),
(881, 32, 119, 0),
(881, 32, 120, 0),
(881, 32, 121, 0),
(881, 32, 114, 0),
(881, 32, 113, 0),
(881, 32, 112, 0),
(881, 32, 111, 0),
(881, 32, 110, 0),
(881, 32, 109, 0),
(881, 32, 108, 0),
(882, 32, 107, 0),
(896, 32, 114, 0),
(882, 32, 119, 0),
(882, 32, 120, 0),
(882, 32, 121, 0),
(882, 32, 114, 0),
(882, 32, 113, 0),
(882, 32, 111, 0),
(882, 32, 110, 0),
(882, 32, 109, 0),
(882, 32, 108, 0),
(883, 32, 117, 0),
(883, 32, 118, 0),
(883, 32, 119, 0),
(883, 32, 120, 0),
(883, 32, 121, 0),
(883, 32, 114, 0),
(883, 32, 113, 0),
(883, 32, 112, 0),
(883, 32, 111, 0),
(883, 32, 110, 0),
(883, 32, 109, 0),
(884, 32, 109, 0),
(884, 32, 110, 0),
(884, 32, 111, 0),
(884, 32, 112, 0),
(884, 32, 113, 0),
(884, 32, 116, 0),
(884, 32, 121, 0),
(884, 32, 120, 0),
(884, 32, 119, 0),
(884, 32, 118, 0),
(884, 32, 117, 0),
(885, 32, 122, 0),
(885, 32, 123, 0),
(885, 32, 124, 0),
(885, 32, 125, 0),
(885, 32, 126, 0),
(885, 32, 107, 0),
(885, 32, 106, 0),
(885, 32, 105, 0),
(885, 32, 104, 0),
(885, 32, 103, 0),
(885, 32, 102, 0),
(885, 32, 101, 0),
(885, 32, 127, 0),
(885, 32, 128, 0),
(885, 32, 129, 0),
(886, 32, 128, 0),
(886, 32, 127, 0),
(886, 32, 101, 0),
(915, 32, 109, 0),
(886, 32, 103, 0),
(915, 32, 107, 0),
(915, 32, 106, 0),
(915, 32, 105, 0),
(886, 32, 107, 0),
(887, 32, 107, 0),
(887, 32, 106, 0),
(887, 32, 105, 0),
(887, 32, 104, 0),
(887, 32, 103, 0),
(887, 32, 102, 0),
(887, 32, 101, 0),
(887, 32, 127, 0),
(887, 32, 128, 0),
(888, 32, 107, 0),
(888, 32, 106, 0),
(888, 32, 105, 0),
(888, 32, 104, 0),
(888, 32, 103, 0),
(888, 32, 102, 0),
(888, 32, 101, 0),
(888, 32, 127, 0),
(888, 32, 128, 0),
(889, 32, 107, 0),
(889, 32, 106, 0),
(889, 32, 105, 0),
(889, 32, 104, 0),
(889, 32, 103, 0),
(889, 32, 102, 0),
(889, 32, 101, 0),
(889, 32, 127, 0),
(889, 32, 128, 0),
(890, 32, 128, 0),
(890, 32, 127, 0),
(890, 32, 101, 0),
(890, 32, 102, 0),
(890, 32, 103, 0),
(890, 32, 104, 0),
(890, 32, 106, 0),
(890, 32, 107, 0),
(896, 32, 110, 0),
(896, 32, 111, 0),
(896, 32, 112, 0),
(896, 32, 113, 0),
(896, 32, 117, 0),
(896, 32, 118, 0),
(896, 32, 120, 0),
(896, 32, 121, 0),
(897, 34, 134, 0),
(897, 34, 135, 0),
(897, 32, 130, 0),
(897, 32, 131, 0),
(897, 32, 132, 0),
(898, 32, 130, 0),
(898, 32, 131, 0),
(898, 32, 132, 0),
(899, 32, 130, 0),
(899, 32, 131, 0),
(899, 32, 132, 0),
(900, 32, 130, 0),
(900, 32, 131, 0),
(904, 32, 105, 0),
(904, 32, 106, 0),
(904, 32, 107, 0),
(904, 32, 109, 0),
(904, 32, 110, 0),
(904, 32, 111, 0),
(905, 32, 106, 0),
(905, 32, 107, 0),
(905, 32, 108, 0),
(905, 32, 110, 0),
(906, 32, 105, 0),
(906, 32, 106, 0),
(906, 32, 107, 0),
(906, 32, 108, 0),
(906, 32, 109, 0),
(906, 32, 110, 0),
(906, 32, 111, 0),
(907, 32, 105, 0),
(907, 32, 106, 0),
(907, 32, 107, 0),
(907, 32, 108, 0),
(907, 32, 110, 0),
(907, 32, 111, 0),
(908, 32, 110, 0),
(908, 32, 111, 0),
(908, 32, 119, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `SC_product_options_values`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Сен 18 2015 г., 21:14
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_product_options_values`;
CREATE TABLE IF NOT EXISTS `SC_product_options_values` (
  `optionID` int(11) NOT NULL DEFAULT '0',
  `productID` int(11) NOT NULL DEFAULT '0',
  `option_type` tinyint(1) DEFAULT '0',
  `option_show_times` int(11) DEFAULT '1',
  `variantID` int(11) DEFAULT NULL,
  `option_value_ru` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_product_options_values`
--

INSERT INTO `SC_product_options_values` (`optionID`, `productID`, `option_type`, `option_show_times`, `variantID`, `option_value_ru`) VALUES
(31, 846, 0, 1, NULL, 'САТИН'),
(32, 846, 1, 1, 107, ''),
(33, 846, 0, 1, NULL, '5см / 2"'),
(31, 847, 0, 1, NULL, 'САТИН'),
(32, 847, 1, 1, 107, ''),
(33, 847, 0, 1, NULL, '5см / 2"'),
(31, 848, 0, 1, NULL, 'САТИН'),
(32, 848, 1, 1, 107, ''),
(33, 848, 0, 1, NULL, '7,5см / 2,5"'),
(31, 849, 0, 1, NULL, 'САТИН'),
(32, 849, 1, 1, 107, ''),
(33, 849, 0, 1, NULL, '7,5см / 2,5"'),
(31, 850, 0, 1, NULL, 'САТИН'),
(32, 850, 1, 1, 107, ''),
(33, 850, 0, 1, NULL, '7,5см / 2,5"'),
(31, 851, 0, 1, NULL, 'САТИН'),
(32, 851, 1, 1, 107, ''),
(33, 851, 0, 1, NULL, '8,5см / 3"'),
(31, 852, 0, 1, NULL, 'САТИН'),
(32, 852, 1, 1, 107, ''),
(33, 852, 0, 1, NULL, '9,4см / 3,5"'),
(31, 853, 0, 1, NULL, 'НУБУК/ЗАМША'),
(32, 853, 1, 1, 107, ''),
(33, 853, 0, 1, NULL, '7,5см / 2,5"'),
(31, 854, 0, 1, NULL, 'ЛАК'),
(32, 854, 1, 1, 107, ''),
(33, 854, 0, 1, NULL, '7,5см / 2,5"'),
(31, 855, 0, 1, NULL, 'САТИН'),
(32, 855, 1, 1, 107, ''),
(33, 855, 0, 1, NULL, '7,5см / 2,5"'),
(31, 856, 0, 1, NULL, 'САТИН'),
(32, 856, 1, 1, 107, ''),
(33, 856, 0, 1, NULL, '5см / 2"'),
(31, 857, 0, 1, NULL, 'САТИН'),
(32, 857, 1, 1, 106, ''),
(33, 857, 0, 1, NULL, '7,5см / 2,5"'),
(31, 858, 0, 1, NULL, 'САТИН'),
(32, 858, 1, 1, 106, ''),
(33, 858, 0, 1, NULL, '7,5см / 2,5"'),
(31, 859, 0, 1, NULL, 'САТИН'),
(32, 859, 1, 1, 107, ''),
(33, 859, 0, 1, NULL, '7,5см / 2,5"'),
(31, 860, 0, 1, NULL, 'САТИН'),
(32, 860, 1, 1, 107, ''),
(33, 860, 0, 1, NULL, '8,25см / 3"'),
(31, 861, 0, 1, NULL, 'САТИН'),
(32, 861, 1, 1, 107, ''),
(33, 861, 0, 1, NULL, '8,25см / 3"'),
(31, 862, 0, 1, NULL, 'САТИН'),
(32, 862, 1, 1, 107, ''),
(33, 862, 0, 1, NULL, '7,5см / 2,5"'),
(31, 863, 0, 1, NULL, 'САТИН'),
(32, 863, 1, 1, 107, ''),
(33, 863, 0, 1, NULL, '8,25см / 3"'),
(31, 864, 0, 1, NULL, 'САТИН'),
(32, 864, 1, 1, 107, ''),
(33, 864, 0, 1, NULL, '7,5см / 2,5"'),
(31, 865, 0, 1, NULL, 'САТИН'),
(32, 865, 1, 1, 107, ''),
(33, 865, 0, 1, NULL, '8,25см / 3"'),
(31, 866, 0, 1, NULL, 'САТИН'),
(32, 866, 1, 1, 107, ''),
(33, 866, 1, 1, NULL, '7,5см / 2,5"'),
(31, 867, 0, 1, NULL, 'САТИН'),
(32, 867, 1, 1, 107, ''),
(33, 867, 0, 1, NULL, '7,5см / 2,5"'),
(31, 868, 0, 1, NULL, 'САТИН'),
(32, 868, 1, 1, 107, ''),
(33, 868, 0, 1, NULL, '5см / 2"'),
(31, 869, 0, 1, NULL, 'САТИН'),
(32, 869, 1, 1, 107, ''),
(33, 869, 0, 1, NULL, '7,5см / 2,5"'),
(31, 870, 0, 1, NULL, 'САТИН'),
(32, 870, 1, 1, 107, ''),
(33, 870, 0, 1, NULL, '5см / 2"'),
(31, 871, 0, 1, NULL, 'САТИН'),
(32, 871, 1, 1, 107, ''),
(33, 871, 0, 1, NULL, '7,5см / 2,5"'),
(31, 872, 0, 1, NULL, 'КОЖА'),
(32, 872, 1, 1, 107, ''),
(33, 872, 0, 1, NULL, '3,5см / 1,5"'),
(31, 873, 0, 1, NULL, 'КОЖА'),
(32, 873, 1, 1, 105, ''),
(33, 873, 0, 1, NULL, '5см / 2"'),
(31, 874, 0, 1, NULL, 'КОЖА'),
(32, 874, 1, 1, 107, ''),
(33, 874, 0, 1, NULL, '7,5см / 2,5"'),
(31, 875, 0, 1, NULL, 'КОЖА'),
(32, 875, 1, 1, 105, ''),
(33, 875, 0, 1, NULL, '7,5см / 2,5"'),
(31, 876, 0, 1, NULL, 'САТИН'),
(32, 876, 1, 1, 106, ''),
(33, 876, 0, 1, NULL, '7,5см / 2,5"'),
(31, 877, 0, 1, NULL, 'КОЖА'),
(32, 877, 1, 1, 111, ''),
(33, 877, 0, 1, NULL, '3,5см / 1,5"'),
(31, 878, 0, 1, NULL, 'КОЖА'),
(32, 878, 1, 1, 110, ''),
(33, 878, 0, 1, NULL, '3,5см / 1,5"'),
(31, 879, 0, 1, NULL, 'НУБУК'),
(32, 879, 1, 1, 121, ''),
(33, 879, 0, 1, NULL, '3,5см / 1,5"'),
(31, 880, 0, 1, NULL, 'КОЖА'),
(32, 880, 1, 1, 112, ''),
(33, 880, 0, 1, NULL, '3,5см / 1,5"'),
(31, 881, 0, 1, NULL, 'КОЖА'),
(32, 881, 1, 1, 114, ''),
(33, 881, 0, 1, NULL, '3,5см / 1,5"'),
(31, 882, 0, 1, NULL, 'КОЖА'),
(32, 882, 1, 1, 114, ''),
(33, 882, 0, 1, NULL, '3,5см / 1,5"'),
(31, 883, 0, 1, NULL, 'КОЖА'),
(32, 883, 1, 1, 114, ''),
(33, 883, 0, 1, NULL, '2,5 см / 1"'),
(31, 884, 0, 1, NULL, 'ЛАК'),
(32, 884, 1, 1, 113, ''),
(33, 884, 0, 1, NULL, '2,5 см / 1"'),
(31, 885, 0, 1, NULL, 'Искусственная кожа'),
(32, 885, 1, 1, 122, ''),
(33, 885, 0, 1, NULL, '2см / 0,8"'),
(31, 886, 0, 1, NULL, 'САТИН'),
(32, 886, 1, 1, 101, ''),
(33, 886, 0, 1, NULL, '3см / 1,2"'),
(31, 887, 0, 1, NULL, 'ИСКУССТВЕННАЯ КОЖА'),
(32, 887, 1, 1, 102, ''),
(33, 887, 0, 1, NULL, '3см / 1,2"'),
(31, 888, 0, 1, NULL, 'ИСКУССТВЕННАЯ КОЖА'),
(32, 888, 1, 1, 102, ''),
(33, 888, 0, 1, NULL, '3см / 1,2"'),
(31, 889, 0, 1, NULL, 'Искусственная кожа'),
(32, 889, 1, 1, 102, ''),
(33, 889, 0, 1, NULL, '2см / 1,2"'),
(31, 890, 0, 1, NULL, 'ЛАК/ИСКУССТВЕННЫЙ НУБУК'),
(32, 890, 1, 1, 102, ''),
(33, 890, 0, 1, NULL, '2см / 0,8"'),
(31, 891, 0, 1, NULL, 'СИЛИКОН'),
(31, 892, 0, 1, NULL, 'СИЛИКОН'),
(31, 894, 0, 1, NULL, 'ДЕРЕВО/МЕТАЛЛ'),
(32, 894, 0, 1, NULL, ''),
(33, 894, 0, 1, NULL, ''),
(32, 895, 1, 1, 106, ''),
(31, 895, 0, 1, NULL, 'САТИН'),
(33, 895, 0, 1, NULL, '8,5см / 3"'),
(32, 896, 1, 1, 114, ''),
(31, 896, 0, 1, NULL, 'КОЖА'),
(33, 896, 0, 1, NULL, '3,5см / 1,5"'),
(34, 897, 1, 1, 134, ''),
(32, 897, 1, 1, 130, ''),
(31, 897, 0, 1, NULL, ''),
(33, 897, 0, 1, NULL, ''),
(32, 898, 1, 1, 130, ''),
(31, 898, 0, 1, NULL, ''),
(34, 898, 0, 1, NULL, ''),
(33, 898, 0, 1, NULL, ''),
(32, 899, 1, 1, 130, ''),
(31, 899, 0, 1, NULL, ''),
(34, 899, 0, 1, NULL, ''),
(33, 899, 0, 1, NULL, ''),
(32, 900, 1, 1, 130, ''),
(31, 900, 0, 1, NULL, ''),
(34, 900, 0, 1, NULL, ''),
(33, 900, 0, 1, NULL, ''),
(34, 846, 0, 1, NULL, ''),
(34, 847, 0, 1, NULL, ''),
(34, 848, 0, 1, NULL, ''),
(34, 849, 0, 1, NULL, ''),
(34, 850, 0, 1, NULL, ''),
(34, 851, 0, 1, NULL, ''),
(34, 852, 0, 1, NULL, ''),
(34, 853, 0, 1, NULL, ''),
(34, 854, 0, 1, NULL, ''),
(34, 855, 0, 1, NULL, ''),
(34, 856, 0, 1, NULL, ''),
(34, 857, 0, 1, NULL, ''),
(34, 858, 0, 1, NULL, ''),
(34, 859, 0, 1, NULL, ''),
(34, 860, 0, 1, NULL, ''),
(34, 861, 0, 1, NULL, ''),
(34, 862, 0, 1, NULL, ''),
(34, 863, 0, 1, NULL, ''),
(34, 864, 0, 1, NULL, ''),
(34, 865, 0, 1, NULL, ''),
(34, 866, 0, 1, NULL, ''),
(34, 895, 0, 1, NULL, ''),
(34, 867, 0, 1, NULL, ''),
(34, 868, 0, 1, NULL, ''),
(34, 869, 0, 1, NULL, ''),
(34, 870, 0, 1, NULL, ''),
(34, 871, 0, 1, NULL, ''),
(34, 872, 0, 1, NULL, ''),
(34, 873, 0, 1, NULL, ''),
(34, 874, 0, 1, NULL, ''),
(34, 875, 0, 1, NULL, ''),
(34, 876, 0, 1, NULL, ''),
(34, 877, 0, 1, NULL, 'ЧЕРНЫЙ'),
(34, 878, 0, 1, NULL, 'ЧЕРНЫЙ'),
(34, 879, 0, 1, NULL, 'ЧЕРНЫЙ'),
(34, 881, 0, 1, NULL, 'ЧЕРНЫЙ'),
(34, 880, 0, 1, NULL, 'ЧЕРНЫЙ'),
(34, 882, 0, 1, NULL, 'ЧЕРНЫЙ'),
(34, 896, 0, 1, NULL, 'ЧЕРНЫЙ'),
(34, 883, 0, 1, NULL, 'ЧЕРНЫЙ'),
(34, 884, 0, 1, NULL, 'ЧЕРНЫЙ'),
(34, 885, 0, 1, NULL, ''),
(34, 886, 0, 1, NULL, ''),
(34, 887, 0, 1, NULL, ''),
(34, 888, 0, 1, NULL, ''),
(34, 889, 0, 1, NULL, ''),
(34, 890, 0, 1, NULL, ''),
(32, 901, 1, 1, 107, ''),
(31, 901, 0, 1, NULL, 'САТИН'),
(34, 901, 0, 1, NULL, ''),
(33, 901, 0, 1, NULL, '8,5см / 3"'),
(32, 902, 1, 1, 107, ''),
(31, 902, 0, 1, NULL, 'САТИН'),
(34, 902, 0, 1, NULL, ''),
(33, 902, 0, 1, NULL, '7,5см / 2,5"'),
(32, 903, 1, 1, 107, ''),
(31, 903, 0, 1, NULL, 'САТИН'),
(34, 903, 0, 1, NULL, ''),
(33, 903, 0, 1, NULL, '5см / 2"'),
(32, 904, 1, 1, 107, ''),
(31, 904, 0, 1, NULL, 'САТИН'),
(34, 904, 0, 1, NULL, ''),
(33, 904, 0, 1, NULL, '7,5см / 2,5"'),
(32, 905, 1, 1, 107, ''),
(31, 905, 0, 1, NULL, 'САТИН'),
(34, 905, 0, 1, NULL, ''),
(33, 905, 0, 1, NULL, '7,5см / 2,5"'),
(32, 906, 1, 1, 107, ''),
(31, 906, 0, 1, NULL, 'САТИН'),
(34, 906, 0, 1, NULL, ''),
(33, 906, 0, 1, NULL, '7,5см / 2,5"'),
(32, 907, 1, 1, 107, ''),
(31, 907, 0, 1, NULL, 'САТИН'),
(34, 907, 0, 1, NULL, ''),
(33, 907, 0, 1, NULL, '8,5см / 3"'),
(34, 894, 0, 1, NULL, ''),
(31, 908, 0, 1, NULL, 'ЛАК'),
(32, 908, 1, 1, 119, ''),
(34, 908, 0, 1, NULL, 'ЧЕРНЫЙ'),
(33, 908, 0, 1, NULL, '3,5см / 1,5"'),
(32, 909, 1, 1, 120, ''),
(31, 909, 0, 1, NULL, 'ЛАК'),
(34, 909, 0, 1, NULL, 'ЧЕРНЫЙ'),
(33, 909, 0, 1, NULL, '2,5 см / 1"'),
(31, 910, 0, 1, NULL, 'ЛАК'),
(32, 910, 1, 1, 113, ''),
(34, 910, 0, 1, NULL, 'ЧЕРНЫЙ'),
(33, 910, 0, 1, NULL, '2,5 см / 1"'),
(32, 911, 1, 1, 112, ''),
(31, 911, 0, 1, NULL, 'ЛАК/НУБУК'),
(34, 911, 0, 1, NULL, 'ЧЕРНЫЙ'),
(33, 911, 0, 1, NULL, '2,5 см / 1"'),
(32, 912, 1, 1, 111, ''),
(31, 912, 0, 1, NULL, 'КОЖА'),
(34, 912, 0, 1, NULL, 'ЧЕРНЫЙ'),
(33, 912, 0, 1, NULL, '2,5 см / 1"'),
(32, 913, 1, 1, 113, ''),
(31, 913, 0, 1, NULL, 'КОЖА'),
(34, 913, 0, 1, NULL, 'КОРИЧНЕВЫЙ'),
(33, 913, 0, 1, NULL, '2,5 см / 1"'),
(31, 914, 0, 1, NULL, 'СИЛИКОН'),
(32, 914, 0, 1, NULL, ''),
(34, 914, 0, 1, NULL, ''),
(33, 914, 0, 1, NULL, ''),
(32, 915, 1, 1, 107, ''),
(31, 915, 0, 1, NULL, 'КОЖА'),
(34, 915, 0, 1, NULL, 'ЧЕРНЫЙ'),
(33, 915, 0, 1, NULL, '7,5см / 2,5"'),
(32, 916, 1, 1, 107, ''),
(31, 916, 0, 1, NULL, 'ДЖИНСОВАЯ ТКАНЬ'),
(34, 916, 0, 1, NULL, 'ГОЛУБОЙ'),
(33, 916, 0, 1, NULL, '7,5см / 2,5"'),
(31, 917, 0, 1, NULL, ''),
(32, 917, 0, 1, NULL, '10 см х 4 см'),
(34, 917, 0, 1, NULL, ''),
(33, 917, 0, 1, NULL, ''),
(35, 917, 0, 1, NULL, 'Покупка обуви'),
(32, 891, 0, 1, NULL, ''),
(34, 891, 0, 1, NULL, ''),
(33, 891, 0, 1, NULL, ''),
(35, 891, 0, 1, NULL, 'Покупка обуви'),
(35, 914, 0, 1, NULL, 'Покупка обуви'),
(32, 892, 0, 1, NULL, ''),
(34, 892, 0, 1, NULL, ''),
(33, 892, 0, 1, NULL, ''),
(35, 892, 0, 1, NULL, 'Покупка обуви'),
(35, 894, 0, 1, NULL, 'Покупка обуви'),
(35, 846, 0, 1, NULL, ''),
(35, 848, 0, 1, NULL, ''),
(35, 860, 0, 1, NULL, ''),
(35, 861, 0, 1, NULL, ''),
(35, 878, 0, 1, NULL, ''),
(35, 879, 0, 1, NULL, ''),
(35, 902, 0, 1, NULL, ''),
(35, 901, 0, 1, NULL, ''),
(35, 916, 0, 1, NULL, ''),
(35, 915, 0, 1, NULL, ''),
(35, 908, 0, 1, NULL, ''),
(35, 909, 0, 1, NULL, ''),
(35, 895, 0, 1, NULL, '');

-- --------------------------------------------------------

--
-- Структура таблицы `SC_product_pictures`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Мар 20 2015 г., 10:24
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_product_pictures`;
CREATE TABLE IF NOT EXISTS `SC_product_pictures` (
  `photoID` int(11) NOT NULL,
  `productID` int(11) NOT NULL DEFAULT '0',
  `filename` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `enlarged` varchar(255) DEFAULT NULL,
  `priority` int(10) unsigned DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=7013 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_product_pictures`
--

INSERT INTO `SC_product_pictures` (`photoID`, `productID`, `filename`, `thumbnail`, `enlarged`, `priority`) VALUES
(6813, 846, '11502-1.jpg', '11502-1_thm.jpg', '11502-1_enl.jpg', 0),
(6814, 846, '11502-2.jpg', '11502-2_thm.jpg', '11502-2_enl.jpg', 1),
(6815, 846, '11502-3.jpg', '11502-3_thm.jpg', '11502-3_enl.jpg', 2),
(6816, 847, '11535-1.jpg', '11535-1_thm.jpg', '11535-1_enl.jpg', 0),
(6817, 847, '11535-2.jpg', '11535-2_thm.jpg', '11535-2_enl.jpg', 1),
(6818, 847, '11535-3.jpg', '11535-3_thm.jpg', '11535-3_enl.jpg', 2),
(6819, 848, '11602-1.jpg', '11602-1_thm.jpg', '11602-1_enl.jpg', 0),
(6820, 848, '11602-2.jpg', '11602-2_thm.jpg', '11602-2_enl.jpg', 1),
(6821, 848, '11602-3.jpg', '11602-3_thm.jpg', '11602-3_enl.jpg', 2),
(6822, 849, '11605-1.jpg', '11605-1_thm.jpg', '11605-1_enl.jpg', 0),
(6823, 849, '11605-2.jpg', '11605-2_thm.jpg', '11605-2_enl.jpg', 1),
(6824, 849, '11605-3.jpg', '11605-3_thm.jpg', '11605-3_enl.jpg', 2),
(6825, 850, '11635-1.jpg', '11635-1_thm.jpg', '11635-1_enl.jpg', 0),
(6826, 850, '11635-2.jpg', '11635-2_thm.jpg', '11635-2_enl.jpg', 1),
(6827, 850, '11635-3.jpg', '11635-3_thm.jpg', '11635-3_enl.jpg', 2),
(6828, 851, '11735-1.jpg', '11735-1_thm.jpg', '11735-1_enl.jpg', 0),
(6829, 851, '11735-2.jpg', '11735-2_thm.jpg', '11735-2_enl.jpg', 1),
(6830, 851, '11735-3.jpg', '11735-3_thm.jpg', '11735-3_enl.jpg', 2),
(6831, 852, '11935-1.jpg', '11935-1_thm.jpg', '11935-1_enl.jpg', 0),
(6832, 852, '11935-2.jpg', '11935-2_thm.jpg', '11935-2_enl.jpg', 1),
(6833, 852, '11935-3.jpg', '11935-3_thm.jpg', '11935-3_enl.jpg', 2),
(6834, 853, '12605-1.jpg', '12605-1_thm.jpg', '12605-1_enl.jpg', 0),
(6835, 853, '12605-2.jpg', '12605-2_thm.jpg', '12605-2_enl.jpg', 1),
(6836, 853, '12605-3.jpg', '12605-3_thm.jpg', '12605-3_enl.jpg', 2),
(6837, 854, '12625-1.jpg', '12625-1_thm.jpg', '12625-1_enl.jpg', 0),
(6838, 854, '12625-2.jpg', '12625-2_thm.jpg', '12625-2_enl.jpg', 1),
(6839, 854, '12625-3.jpg', '12625-3_thm.jpg', '12625-3_enl.jpg', 2),
(6840, 855, '12635-1.jpg', '12635-1_thm.jpg', '12635-1_enl.jpg', 0),
(6841, 855, '12635-2.jpg', '12635-2_thm.jpg', '12635-2_enl.jpg', 1),
(6842, 855, '12635-3.jpg', '12635-3_thm.jpg', '12635-3_enl.jpg', 2),
(6843, 856, '13533-1.jpg', '13533-1_thm.jpg', '13533-1_enl.jpg', 0),
(6844, 856, '13533-2.jpg', '13533-2_thm.jpg', '13533-2_enl.jpg', 1),
(6845, 856, '13533-3.jpg', '13533-3_thm.jpg', '13533-3_enl.jpg', 2),
(6846, 857, '13632-1.jpg', '13632-1_thm.jpg', '13632-1_enl.jpg', 0),
(6847, 857, '13632-2.jpg', '13632-2_thm.jpg', '13632-2_enl.jpg', 1),
(6848, 857, '13632-3.jpg', '13632-3_thm.jpg', '13632-3_enl.jpg', 2),
(6849, 858, '13633-1.jpg', '13633-1_thm.jpg', '13633-1_enl.jpg', 0),
(6850, 858, '13633-2.jpg', '13633-2_thm.jpg', '13633-2_enl.jpg', 1),
(6851, 858, '13633-3.jpg', '13633-3_thm.jpg', '13633-3_enl.jpg', 2),
(6852, 859, '13635-1.jpg', '13635-1_thm.jpg', '13635-1_enl.jpg', 0),
(6853, 859, '13635-2.jpg', '13635-2_thm.jpg', '13635-2_enl.jpg', 1),
(6854, 859, '13635-3.jpg', '13635-3_thm.jpg', '13635-3_enl.jpg', 2),
(6855, 860, '13732-1.jpg', '13732-1_thm.jpg', '13732-1_enl.jpg', 0),
(6856, 860, '13732-2.jpg', '13732-2_thm.jpg', '13732-2_enl.jpg', 1),
(6857, 860, '13732-3.jpg', '13732-3_thm.jpg', '13732-3_enl.jpg', 2),
(6858, 861, '13733-1.jpg', '13733-1_thm.jpg', '13733-1_enl.jpg', 0),
(6859, 861, '13733-2.jpg', '13733-2_thm.jpg', '13733-2_enl.jpg', 1),
(6860, 861, '13733-3.jpg', '13733-3_thm.jpg', '13733-3_enl.jpg', 2),
(6861, 862, '14605-1.jpg', '14605-1_thm.jpg', '14605-1_enl.jpg', 0),
(6862, 862, '14605-2.jpg', '14605-2_thm.jpg', '14605-2_enl.jpg', 1),
(6863, 862, '14605-3.jpg', '14605-3_thm.jpg', '14605-3_enl.jpg', 2),
(6864, 863, '14735-1.jpg', '14735-1_thm.jpg', '14735-1_enl.jpg', 0),
(6865, 863, '14735-2.jpg', '14735-2_thm.jpg', '14735-2_enl.jpg', 1),
(6866, 863, '14735-3.jpg', '14735-3_thm.jpg', '14735-3_enl.jpg', 2),
(6867, 864, '16675-1.jpg', '16675-1_thm.jpg', '16675-1_enl.jpg', 0),
(6868, 864, '16675-2.jpg', '16675-2_thm.jpg', '16675-2_enl.jpg', 1),
(6869, 864, '16675-3.jpg', '16675-3_thm.jpg', '16675-3_enl.jpg', 2),
(6870, 865, '16735-1.jpg', '16735-1_thm.jpg', '16735-1_enl.jpg', 0),
(6871, 865, '16735-2.jpg', '16735-2_thm.jpg', '16735-2_enl.jpg', 1),
(6872, 865, '16735-3.jpg', '16735-3_thm.jpg', '16735-3_enl.jpg', 2),
(6873, 866, '17639-1.jpg', '17639-1_thm.jpg', '17639-1_enl.jpg', 0),
(6874, 866, '17639-2.jpg', '17639-2_thm.jpg', '17639-2_enl.jpg', 1),
(6875, 866, '17639-3.jpg', '17639-3_thm.jpg', '17639-3_enl.jpg', 2),
(6876, 867, '24667-1.jpg', '24667-1_thm.jpg', '24667-1_enl.jpg', 0),
(6877, 867, '24667-2.jpg', '24667-2_thm.jpg', '24667-2_enl.jpg', 1),
(6878, 867, '24667-3.jpg', '24667-3_thm.jpg', '24667-3_enl.jpg', 2),
(6879, 868, '25567-1.jpg', '25567-1_thm.jpg', '25567-1_enl.jpg', 0),
(6880, 868, '25567-2.jpg', '25567-2_thm.jpg', '25567-2_enl.jpg', 1),
(6881, 868, '25567-3.jpg', '25567-3_thm.jpg', '25567-3_enl.jpg', 2),
(6882, 869, '25667-1.jpg', '25667-1_thm.jpg', '25667-1_enl.jpg', 0),
(6883, 869, '25667-2.jpg', '25667-2_thm.jpg', '25667-2_enl.jpg', 1),
(6884, 869, '25667-3.jpg', '25667-3_thm.jpg', '25667-3_enl.jpg', 2),
(6885, 870, '27567-1.jpg', '27567-1_thm.jpg', '27567-1_enl.jpg', 0),
(6886, 870, '27567-2.jpg', '27567-2_thm.jpg', '27567-2_enl.jpg', 1),
(6887, 870, '27567-3.jpg', '27567-3_thm.jpg', '27567-3_enl.jpg', 2),
(6888, 871, '27667-1.jpg', '27667-1_thm.jpg', '27667-1_enl.jpg', 0),
(6889, 871, '27667-2.jpg', '27667-2_thm.jpg', '27667-2_enl.jpg', 1),
(6890, 871, '27667-3.jpg', '27667-3_thm.jpg', '27667-3_enl.jpg', 2),
(6891, 872, '49000-1.jpg', '49000-1_thm.jpg', '49000-1_enl.jpg', 0),
(6892, 872, '49000-2.jpg', '49000-2_thm.jpg', '49000-2_enl.jpg', 1),
(6893, 872, '49000-3.jpg', '49000-3_thm.jpg', '49000-3_enl.jpg', 2),
(6894, 873, '49500-1.jpg', '49500-1_thm.jpg', '49500-1_enl.jpg', 0),
(6895, 873, '49500-2.jpg', '49500-2_thm.jpg', '49500-2_enl.jpg', 1),
(6896, 873, '49500-3.jpg', '49500-3_thm.jpg', '49500-3_enl.jpg', 2),
(6897, 874, '62608-1.jpg', '62608-1_thm.jpg', '62608-1_enl.jpg', 0),
(6898, 874, '62608-2.jpg', '62608-2_thm.jpg', '62608-2_enl.jpg', 1),
(6899, 874, '62608-3.jpg', '62608-3_thm.jpg', '62608-3_enl.jpg', 2),
(6900, 875, '63608-1.jpg', '63608-1_thm.jpg', '63608-1_enl.jpg', 0),
(6901, 875, '63608-2.jpg', '63608-2_thm.jpg', '63608-2_enl.jpg', 1),
(6902, 875, '63608-3.jpg', '63608-3_thm.jpg', '63608-3_enl.jpg', 2),
(6903, 876, '63668-1.jpg', '63668-1_thm.jpg', '63668-1_enl.jpg', 0),
(6904, 876, '63668-2.jpg', '63668-2_thm.jpg', '63668-2_enl.jpg', 1),
(6905, 876, '63668-3.jpg', '63668-3_thm.jpg', '63668-3_enl.jpg', 2),
(6906, 877, '90302-1.jpg', '90302-1_thm.jpg', '90302-1_enl.jpg', 0),
(6907, 877, '90302-2.jpg', '90302-2_thm.jpg', '90302-2_enl.jpg', 1),
(6908, 877, '90302-3.jpg', '90302-3_thm.jpg', '90302-3_enl.jpg', 2),
(6909, 878, '92302-1.jpg', '92302-1_thm.jpg', '92302-1_enl.jpg', 0),
(6910, 878, '92302-2.jpg', '92302-2_thm.jpg', '92302-2_enl.jpg', 1),
(6911, 878, '92302-3.jpg', '92302-3_thm.jpg', '92302-3_enl.jpg', 2),
(6912, 879, '92392-1.jpg', '92392-1_thm.jpg', '92392-1_enl.jpg', 0),
(6913, 879, '92392-2.jpg', '92392-2_thm.jpg', '92392-2_enl.jpg', 1),
(6914, 879, '92392-3.jpg', '92392-3_thm.jpg', '92392-3_enl.jpg', 2),
(6915, 880, '95302-1.jpg', '95302-1_thm.jpg', '95302-1_enl.jpg', 0),
(6916, 880, '95302-2.jpg', '95302-2_thm.jpg', '95302-2_enl.jpg', 1),
(6917, 880, '95302-3.jpg', '95302-3_thm.jpg', '95302-3_enl.jpg', 2),
(6918, 881, '95302_no-print-1.jpg', '95302_no-print-1_thm.jpg', '95302_no-print-1_enl.jpg', 0),
(6919, 881, '95302_no-print-2.jpg', '95302_no-print-2_thm.jpg', '95302_no-print-2_enl.jpg', 1),
(6920, 881, '95302_no-print-3.jpg', '95302_no-print-3_thm.jpg', '95302_no-print-3_enl.jpg', 2),
(6921, 882, '97302-1.jpg', '97302-1_thm.jpg', '97302-1_enl.jpg', 0),
(6922, 882, '97302-2.jpg', '97302-2_thm.jpg', '97302-2_enl.jpg', 1),
(6923, 882, '97302-3.jpg', '97302-3_thm.jpg', '97302-3_enl.jpg', 2),
(6924, 883, '00202-1.jpg', '00202-1_thm.jpg', '00202-1_enl.jpg', 0),
(6925, 883, '00202-2.jpg', '00202-2_thm.jpg', '00202-2_enl.jpg', 1),
(6926, 883, '00202-3.jpg', '00202-3_thm.jpg', '00202-3_enl.jpg', 2),
(6927, 884, '00222-1.jpg', '00222-1_thm.jpg', '00222-1_enl.jpg', 0),
(6928, 884, '00222-2.jpg', '00222-2_thm.jpg', '00222-2_enl.jpg', 1),
(6929, 884, '00222-3.jpg', '00222-3_thm.jpg', '00222-3_enl.jpg', 2),
(6930, 885, '1039-1.jpg', '1039-1_thm.jpg', '1039-1_enl.jpg', 0),
(6931, 885, '1039-2.jpg', '1039-2_thm.jpg', '1039-2_enl.jpg', 1),
(6932, 885, '1039-3.jpg', '1039-3_thm.jpg', '1039-3_enl.jpg', 2),
(6934, 886, '1133-2.jpg', '1133-2_thm.jpg', '1133-2_enl.jpg', 1),
(6935, 886, '1133-3.jpg', '1133-3_thm.jpg', '1133-3_enl.jpg', 2),
(6936, 887, '1134-1.jpg', '1134-1_thm.jpg', '1134-1_enl.jpg', 0),
(6937, 887, '1134-2.jpg', '1134-2_thm.jpg', '1134-2_enl.jpg', 1),
(6938, 887, '1134-3.jpg', '1134-3_thm.jpg', '1134-3_enl.jpg', 2),
(6939, 888, '1135-1.jpg', '1135-1_thm.jpg', '1135-1_enl.jpg', 0),
(6940, 888, '1135-2.jpg', '1135-2_thm.jpg', '1135-2_enl.jpg', 1),
(6941, 888, '1135-3.jpg', '1135-3_thm.jpg', '1135-3_enl.jpg', 2),
(6942, 889, '2020-1.jpg', '2020-1_thm.jpg', '2020-1_enl.jpg', 0),
(6943, 889, '2020-2.jpg', '2020-2_thm.jpg', '2020-2_enl.jpg', 1),
(6944, 889, '2020-3.jpg', '2020-3_thm.jpg', '2020-3_enl.jpg', 2),
(6945, 890, '2022-1.jpg', '2022-1_thm.jpg', '2022-1_enl.jpg', 0),
(6946, 890, '2022-2.jpg', '2022-2_thm.jpg', '2022-2_enl.jpg', 1),
(6947, 890, '2022-3.jpg', '2022-3_thm.jpg', '2022-3_enl.jpg', 2),
(6948, 891, 'nakabluch_latina-1.jpg', 'nakabluch_latina-1_thm.jpg', 'nakabluch_latina-1_enl.jpg', 0),
(6949, 891, 'nakabluch_latina-2.jpg', 'nakabluch_latina-2_thm.jpg', 'nakabluch_latina-2_enl.jpg', 1),
(6950, 892, 'nakabluch_standart-1.jpg', 'nakabluch_standart-1_thm.jpg', 'nakabluch_standart-1_enl.jpg', 0),
(6951, 892, 'nakabluch_standart-2.jpg', 'nakabluch_standart-2_thm.jpg', 'nakabluch_standart-2_enl.jpg', 1),
(6952, 886, '1133-1.jpg', '1133-1_thm.jpg', '1133-1_enl.jpg', 0),
(6958, 894, 'ESBOR-2.jpg', 'ESBOR-2_thm.jpg', 'ESBOR-2_enl.jpg', 1),
(6957, 894, 'ESBOR-1.jpg', 'ESBOR-1_thm.jpg', 'ESBOR-1_enl.jpg', 0),
(6954, 895, '17739-1.jpg', '17739-1_thm.jpg', '17739-1_enl.jpg', 0),
(6955, 895, '17739-2.jpg', '17739-2_thm.jpg', '17739-2_enl.jpg', 1),
(6956, 895, '17739-3.jpg', '17739-3_thm.jpg', '17739-3_enl.jpg', 2),
(6967, 896, '98302-1.jpg', '98302-1_thm.jpg', '98302-1_enl.jpg', 0),
(6968, 896, '98302-2.JPG', '98302-2_thm.JPG', '98302-2_enl.JPG', 1),
(6969, 896, '98302-3.JPG', '98302-3_thm.JPG', '98302-3_enl.JPG', 2),
(6970, 897, 'watermarked-polo_black_and_white.jpg', 'watermarked-polo_black_and_white_thm.jpg', 'watermarked-polo_black_and_white_enl.jpg', 1),
(6971, 897, 'watermarked-polo_white.jpg', 'watermarked-polo_white_thm.jpg', 'watermarked-polo_white_enl.jpg', 0),
(6972, 897, 'watermarked-polo_white_back.jpg', 'watermarked-polo_white_back_thm.jpg', 'watermarked-polo_white_back_enl.jpg', 2),
(6973, 898, 'watermarked-tracksuit.jpg', 'watermarked-tracksuit_thm.jpg', 'watermarked-tracksuit_enl.jpg', 0),
(6974, 898, 'watermarked-tracksuit_white_hoodie.jpg', 'watermarked-tracksuit_white_hoodie_thm.jpg', 'watermarked-tracksuit_white_hoodie_enl.jpg', 1),
(6975, 899, 'watermarked-white_hoodie2.jpg', 'watermarked-white_hoodie2_thm.jpg', 'watermarked-white_hoodie2_enl.jpg', 0),
(6976, 899, 'watermarked-white_hoodie.jpg', 'watermarked-white_hoodie_thm.jpg', 'watermarked-white_hoodie_enl.jpg', 1),
(6977, 900, 'watermarked-kimono.jpg', 'watermarked-kimono_thm.jpg', 'watermarked-kimono_enl.jpg', 0),
(6984, 901, '18833S_3.jpg', '18833S_3_thm.jpg', '18833S_3_enl.jpg', 2),
(6983, 901, '18833S_2.jpg', '18833S_2_thm.jpg', '18833S_2_enl.jpg', 1),
(6982, 901, '18833S_1new.jpg', '18833S_1new_thm.jpg', '18833S_1new_enl.jpg', 0),
(6985, 902, '18633S_1new.jpg', '18633S_1new_thm.jpg', '18633S_1new_enl.jpg', 0),
(6986, 902, '18633S_2.jpg', '18633S_2_thm.jpg', '18633S_2_enl.jpg', 1),
(6987, 902, '18633S_3.jpg', '18633S_3_thm.jpg', '18633S_3_enl.jpg', 2),
(6988, 903, '18533S_1new.jpg', '18533S_1new_thm.jpg', '18533S_1new_enl.jpg', 0),
(6989, 903, '18533S_2.jpg', '18533S_2_thm.jpg', '18533S_2_enl.jpg', 1),
(6990, 903, '18533S_3.jpg', '18533S_3_thm.jpg', '18533S_3_enl.jpg', 2),
(6991, 904, '14735s_new.jpg', '14735s_new_thm.jpg', '14735s_new_enl.jpg', 0),
(6992, 905, '14605s_new.jpg', '14605s_new_thm.jpg', '14605s_new_enl.jpg', 0),
(6993, 906, '13634s_1new.jpg', '13634s_1new_thm.jpg', '13634s_1new_enl.jpg', 0),
(6994, 906, '13634S_2.jpg', '13634S_2_thm.jpg', '13634S_2_enl.jpg', 1),
(6995, 907, '13734s_1new.jpg', '13734s_1new_thm.jpg', '13734s_1new_enl.jpg', 0),
(6996, 907, '13734S_2.jpg', '13734S_2_thm.jpg', '13734S_2_enl.jpg', 1),
(6997, 908, 'product_95322.jpg', 'product_95322_thm.jpg', 'product_95322_enl.jpg', 0),
(6998, 909, '07201-1.JPG', '07201-1_thm.JPG', '07201-1_enl.JPG', 0),
(6999, 909, '07201-2.JPG', '07201-2_thm.JPG', '07201-2_enl.JPG', 1),
(7000, 909, '07201-3.JPG', '07201-3_thm.JPG', '07201-3_enl.JPG', 2),
(7001, 910, '03221-1.JPG', '03221-1_thm.JPG', '03221-1_enl.JPG', 0),
(7002, 911, '01222-1.JPG', '01222-1_thm.JPG', '01222-1_enl.JPG', 0),
(7003, 911, '01222-2.JPG', '01222-2_thm.JPG', '01222-2_enl.JPG', 1),
(7004, 912, '53201-1.JPG', '53201-1_thm.JPG', '53201-1_enl.JPG', 0),
(7005, 913, '57231-1.jpg', '57231-1_thm.jpg', '57231-1_enl.jpg', 0),
(7006, 913, '57231-2.jpg', '57231-2_thm.jpg', '57231-2_enl.jpg', 1),
(7007, 914, 'hps.jpg', 'hps_thm.jpg', 'hps_enl.jpg', 0),
(7008, 915, '810.jpg', '810_thm.jpg', '810_enl.jpg', 0),
(7009, 916, '63688-4.JPG', '63688-4_thm.JPG', '63688-4_enl.JPG', 0),
(7010, 916, '63688-5.JPG', '63688-5_thm.JPG', '63688-5_enl.JPG', 1),
(7011, 916, '63688-6.JPG', '63688-6_thm.JPG', '63688-6_enl.JPG', 2),
(7012, 917, 'IMG_0760.JPG', 'IMG_0760_thm.JPG', 'IMG_0760_enl.JPG', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `SC_related_items`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Авг 20 2015 г., 18:46
--

DROP TABLE IF EXISTS `SC_related_items`;
CREATE TABLE IF NOT EXISTS `SC_related_items` (
  `productID` int(11) NOT NULL DEFAULT '0',
  `Owner` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_related_items`
--

INSERT INTO `SC_related_items` (`productID`, `Owner`) VALUES
(864, 917),
(874, 915),
(875, 915),
(880, 917),
(882, 880),
(896, 880),
(898, 906),
(900, 907),
(906, 898);

-- --------------------------------------------------------

--
-- Структура таблицы `SC_rpost_zones`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_rpost_zones`;
CREATE TABLE IF NOT EXISTS `SC_rpost_zones` (
  `module_id` int(10) unsigned NOT NULL DEFAULT '0',
  `countryID` int(11) DEFAULT NULL,
  `zoneID` int(11) DEFAULT NULL,
  `zoneNumber` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `SC_settings`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_settings`;
CREATE TABLE IF NOT EXISTS `SC_settings` (
  `settingsID` int(11) NOT NULL,
  `settings_groupID` int(11) DEFAULT NULL,
  `settings_constant_name` varchar(64) DEFAULT NULL,
  `settings_value` text,
  `settings_title` varchar(128) DEFAULT NULL,
  `settings_description` varchar(255) DEFAULT NULL,
  `settings_html_function` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=488 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_settings`
--

INSERT INTO `SC_settings` (`settingsID`, `settings_groupID`, `settings_constant_name`, `settings_value`, `settings_title`, `settings_description`, `settings_html_function`, `sort_order`) VALUES
(1, NULL, 'CONF_DSC_COUPONS_ENABLED', 'Y', NULL, NULL, NULL, 0),
(2, NULL, 'CONF_DSC_USERGROUP_ENABLED', 'N', NULL, NULL, NULL, 0),
(3, NULL, 'CONF_DSC_AMOUNT_ENABLED', 'N', NULL, NULL, NULL, 0),
(4, NULL, 'CONF_DSC_ORDERS_ENABLED', 'N', NULL, NULL, NULL, 0),
(5, NULL, 'CONF_DSC_CALC', 'as_sum', NULL, NULL, NULL, 0),
(6, 2, 'CONF_GOOGLE_MAPS_API_KEY', '', 'cfg_google_maps_api_key_name', 'cfg_google_maps_api_key_descr', 'setting_TEXT_BOX(0,', 110),
(7, 2, 'CONF_WAREHOUSE_ADDRESS', '', 'cfg_warehouse_address_name', 'cfg_warehouse_address_descr', 'setting_TEXT_BOX(0,', 110),
(8, 4, 'CONF_VOTING_FOR_PRODUCTS', 'False', 'cfg_voiting_for_products_title', 'cfg_voiting_for_products_descr', 'setting_SELECT_BOX(array(array("title"=>"yes", "value"=>"True"), array("title"=>"no", "value"=>"False")),', 0),
(9, NULL, 'CONF_DEFAULT_LANG', '1', NULL, NULL, NULL, 0),
(10, NULL, 'CONF_AUXPAGES_NAVIGATION', '1', NULL, NULL, NULL, 0),
(11, NULL, 'CONF_DIVISIONS_NAVIGATION', '29:54:107:32', NULL, NULL, NULL, 0),
(12, NULL, 'CONF_CURRENT_THEME', 'dancelife', NULL, NULL, NULL, 0),
(13, 0, 'CONF_UPDATE_GCV', '1', 'cfg_update_gcv_title', 'cfg_update_gcv_description', 'setting_CHECK_BOX(', 6),
(14, 0, 'CONF_DEFAULT_CURRENCY', '3', 'cfg_default_currency_title', '', 'settingCONF_DEFAULT_CURRENCY()', 7),
(15, 0, 'CONF_BACKEND_SAFEMODE', '0', 'Безопасный режим', 'Если данная опция включена, возможности администрирования магазина будут ограничены', '', 0),
(16, 2, 'CONF_DATE_FORMAT', 'DD.MM.YYYY', 'cfg_date_format_title', 'cfg_date_format_description', 'setting_DATEFORMAT(', 60),
(17, 2, 'CONF_HOMEPAGE_META_KEYWORDS', 'a:1:{s:2:"ru";s:88:"интернет-магазин, обувь для танцев, DANCELIFE, купить";}', 'cfg_homepage_metakeywords_title', 'cfg_homepage_metakeywords_description', 'setting_TEXT_BOX_ML(0,', 90),
(18, 2, 'CONF_HOMEPAGE_META_DESCRIPTION', 'a:1:{s:2:"ru";s:115:"У нас вы можете купить профессиональную обувь для танцев DANCELIFE.";}', 'cfg_homepage_metadescription_title', 'cfg_homepage_metadescription_description', 'setting_TEXT_BOX_ML(0,', 100),
(19, 2, 'CONF_SHOP_NAME', 'a:1:{s:2:"ru";s:9:"DANCELIFE";}', 'cfg_store_name_title', 'cfg_store_name_description', 'setting_TEXT_BOX_ML(0,', 10),
(94, NULL, 'CONF_ADDRESSFORM_STATE', '1', NULL, NULL, NULL, 0),
(20, 2, 'CONF_DEFAULT_TITLE', 'a:1:{s:2:"ru";s:105:"Интернет-магазин профессиональной обуви для танцев DANCELIFE";}', 'cfg_default_title_title', 'cfg_default_title_description', 'setting_TEXT_BOX_ML(0,', 80),
(21, 2, 'CONF_SHOP_URL', 'www.dancelife-shop.ru', 'cfg_store_domain_title', 'cfg_store_domain_description', 'setting_TEXT_BOX(0,', 20),
(22, 2, 'CONF_GENERAL_EMAIL', 'info@dancelife-shop.ru', 'cfg_general_email_title', 'cfg_general_email_description', 'setting_TEXT_BOX(0,', 30),
(23, 2, 'CONF_ENABLE_CONFIRMATION_CODE', '1', 'cfg_confirmation_code_title', 'cfg_confirmation_code_description', 'setting_CHECK_BOX(', 50),
(24, 2, 'CONF_FIRST_WEEKDAY', '0', 'cfg_first_weekday_title', 'cfg_first_weekday_description', 'setting_SELECT_BOX(getWeekdayName(0).":0,".getWeekdayName(6).":6",', 70),
(25, 2, 'CONF_ORDERS_EMAIL', 'info@dancelife-shop.ru', 'cfg_orders_email_title', 'cfg_orders_email_description', 'setting_TEXT_BOX(0,', 40),
(26, 4, 'CONF_CHECKSTOCK', '0', 'cfg_check_stock_title', 'cfg_check_stock_description', 'setting_CHECK_BOX(', 4),
(27, 4, 'CONF_PRODUCTS_PER_PAGE', '28', 'cfg_products_per_page_title', 'cfg_products_per_page_description', 'setting_TEXT_BOX(2,', 1),
(28, 4, 'CONF_COLUMNS_PER_PAGE', '7', 'cfg_columns_per_page_title', 'cfg_columns_per_page_description', 'setting_TEXT_BOX(2,', 2),
(29, 4, 'CONF_PRODUCT_SORT', '1', 'cfg_product_sort_title', 'cfg_product_sort_description', 'setting_CHECK_BOX(', 8),
(30, 4, 'CONF_DEFAULT_TAX_CLASS', '0', 'cfg_default_tax_class_title', 'cfg_default_tax_class_description', 'settingCONF_DEFAULT_TAX_CLASS()', 0),
(31, 4, 'CONF_PRDPICT_STANDARD_SIZE', '185', 'cfg_prdpict_standard_size_title', 'cfg_prdpict_standard_size_description', 'setting_TEXT_BOX(2,', 110),
(32, 4, 'CONF_PRDPICT_THUMBNAIL_SIZE', '110', 'cfg_prdpict_thumbnail_size_title', 'cfg_prdpict_thumbnail_size_description', 'setting_TEXT_BOX(2,', 100),
(33, 4, 'CONF_CATPICT_SIZE', '230', 'cfg_catpict_size_title', 'cfg_catpict_size_description', 'setting_TEXT_BOX(2,', 120),
(34, 4, 'CONF_WEIGHT_UNIT', 'g', 'cfg_weight_unit_title', 'cfg_weight_unit_description', 'setting_WEIGHT_UNIT(', 0),
(35, 4, 'CONF_ALLOW_COMPARISON_FOR_SIMPLE_SEARCH', '1', 'cfg_allow_comparison_in_simple_search_title', 'cfg_allow_comparison_in_simple_search_description', 'setting_CHECK_BOX(', 9),
(36, 4, 'CONF_EXACT_PRODUCT_BALANCE', '0', 'cfg_exact_product_balance_title', 'cfg_exact_product_balance_description', 'setting_CHECK_BOX(', 7),
(37, 5, 'CONF_DEFAULT_COUNTRY', '176', 'cfg_default_currency_title', 'cfg_default_currency_description', 'settingCONF_DEFAULT_COUNTRY()', 0),
(38, 5, 'CONF_DEFAULT_CUSTOMER_GROUP', '3', 'cfg_default_customer_group_title', 'cfg_default_customer_group_description', 'settingCONF_DEFAULT_CUSTOMER_GROUP()', 0),
(39, 5, 'CONF_ENABLE_REGCONFIRMATION', '0', 'cfg_customer_actiovation_title', 'cfg_customer_actiovation_description', 'setting_CHECK_BOX(', 1),
(40, 6, 'CONF_SHOW_ADD2CART', '1', 'cfg_allow_ordering_title', 'cfg_allow_ordering_description', 'setting_CHECK_BOX(', 0),
(41, 6, 'CONF_COUNTRY', '176', 'cfg_country_title', 'cfg_country_description', 'settingCONF_COUNTRY()', 9),
(42, 6, 'CONF_ZONE', '186', 'cfg_region_title', 'cfg_region_description', 'settingCONF_ZONE()', 10),
(43, 6, 'CONF_ORDERID_PREFIX', '10', 'cfg_orderid_prefix_title', 'cfg_orderid_prefix_description', 'setting_TEXT_BOX(0,', 0),
(44, 6, 'CONF_ORDERING_REQUEST_BILLING_ADDRESS', '0', 'cfg_request_billing_address_title', 'cfg_request_billing_address_description', 'setting_CHECK_BOX(', 0),
(45, 6, 'CONF_CALCULATE_TAX_ON_SHIPPING', '0', 'cfg_shipping_tax_title', 'cfg_shipping_tax_description', 'settingCONF_CALCULATE_TAX_ON_SHIPPING()', 0),
(46, 6, 'CONF_PROTECTED_CONNECTION', '0', 'cfg_secure_checkout_title', 'cfg_secure_checkout_description', 'setting_CHECK_BOX(', 0),
(47, 6, 'CONF_MINIMAL_ORDER_AMOUNT', '0', 'cfg_min_order_amount_title', 'cfg_min_order_amount_description', 'setting_TEXT_BOX(2,', 0),
(48, 6, 'CONF_SHOPPING_CART_VIEW', '2', 'cfg_how_toshow_shoppingcart_title', 'cfg_how_toshow_shoppingcart_description', 'setting_RADIOGROUP(translate(''stg_fade_layout'').'':''.SHCART_VIEW_FADE.'',''.translate(''stg_new_page_cart'').'':''.SHCART_VIEW_PAGE,', 0),
(49, 7, 'GOOGLE_ANALYTICS_ENABLE', '1', 'cfg_ga_enable_title', 'cfg_ga_enable_description', 'setting_CHECK_BOX(', 1),
(50, 7, 'GOOGLE_ANALYTICS_ACCOUNT', 'UA-25103806-1', 'cfg_ga_account_number_title', 'cfg_ga_account_number_description', 'setting_TEXT_BOX(0,', 2),
(51, 7, 'GOOGLE_ANALYTICS_USD_CURRENCY', '0', 'cfg_ga_usd_title', 'cfg_ga_usd_description', 'setting_CURRENCY_SELECT(', 3),
(52, 1, 'CONF_AFFILIATE_EMAIL_NEW_PAYMENT', '0', 'Email customers when new payment is submitted', '', 'setting_CHECK_BOX(', 0),
(53, 1, 'CONF_AFFILIATE_PROGRAM_ENABLED', '1', 'Affiliate program', 'Is enabled or not', 'setting_CHECK_BOX(', 0),
(54, 1, 'CONF_AFFILIATE_AMOUNT_PERCENT', '10', 'Affiliate comission percent', '', 'setting_TEXT_BOX(0,', 0),
(55, 1, 'CONF_AFFILIATE_EMAIL_NEW_COMMISSION', '0', 'Email customers when new commission is submitted', '', 'setting_CHECK_BOX(', 0),
(56, 4, 'CONF_ENABLE_PRODUCT_SKU', '0', 'cfg_enable_product_sku_title', 'cfg_enable_product_sku_description', 'setting_CHECK_BOX(', 5),
(57, 4, 'CONF_PICTRESIZE_QUALITY', '100', 'cfg_picture_resize_quality_title', 'cfg_picture_resize_quality_description', 'setting_TEXT_BOX(2,', 130),
(58, 2, 'CONF_STOREFRONT_TIME_ZONE', '51', 'cfg_frontend_time_zone', 'cfg__frontend_time_zone_descr', 'Time::setting_SELECT_TIME_ZONE(', 61),
(59, 2, 'CONF_STOREFRONT_TIME_ZONE_DST', '0', 'cfg_frontend_time_zone_dst', 'cfg__frontend_time_zone_dst_descr', 'setting_CHECK_BOX(', 62),
(60, 7, 'GOOGLE_ANALYTICS_CUSTOM_SE', '// Google EMEA Image domains\r\npageTracker._addOrganic("images.google.co.uk","q");\r\npageTracker._addOrganic("images.google.es","q");\r\npageTracker._addOrganic("images.google.pt","q");\r\npageTracker._addOrganic("images.google.it","q");\r\npageTracker._addOrganic("images.google.fr","q");\r\npageTracker._addOrganic("images.google.nl","q");\r\npageTracker._addOrganic("images.google.be","q");\r\npageTracker._addOrganic("images.google.de","q");\r\npageTracker._addOrganic("images.google.no","q");\r\npageTracker._addOrganic("images.google.se","q");\r\npageTracker._addOrganic("images.google.dk","q");\r\npageTracker._addOrganic("images.google.fi","q");\r\npageTracker._addOrganic("images.google.ch","q");\r\npageTracker._addOrganic("images.google.at","q");\r\npageTracker._addOrganic("images.google.ie","q");\r\npageTracker._addOrganic("images.google.ru","q");\r\npageTracker._addOrganic("images.google.pl","q");\r\n\r\n// Other Google Image search\r\npageTracker._addOrganic("images.google.com","q");\r\npageTracker._addOrganic("images.google.ca","q");\r\npageTracker._addOrganic("images.google.com.au","q");\r\npageTracker._addOrganic("images.google","q");\r\n\r\n// Blogsearch\r\npageTracker._addOrganic("blogsearch.google","q");\r\n\r\n// Google EMEA Domains\r\npageTracker._addOrganic("google.co.uk","q");\r\npageTracker._addOrganic("google.es","q");\r\npageTracker._addOrganic("google.pt","q");\r\npageTracker._addOrganic("google.it","q");\r\npageTracker._addOrganic("google.fr","q");\r\npageTracker._addOrganic("google.nl","q");\r\npageTracker._addOrganic("google.be","q");\r\npageTracker._addOrganic("google.de","q");\r\npageTracker._addOrganic("google.no","q");\r\npageTracker._addOrganic("google.se","q");\r\npageTracker._addOrganic("google.dk","q");\r\npageTracker._addOrganic("google.fi","q");\r\npageTracker._addOrganic("google.ch","q");\r\npageTracker._addOrganic("google.at","q");\r\npageTracker._addOrganic("google.ie","q");\r\npageTracker._addOrganic("google.ru","q");\r\npageTracker._addOrganic("google.pl","q");\r\n\r\n// Yahoo EMEA Domains\r\npageTracker._addOrganic("uk.yahoo.com","p");\r\npageTracker._addOrganic("es.yahoo.com","p");\r\npageTracker._addOrganic("pt.yahoo.com","p");\r\npageTracker._addOrganic("it.yahoo.com","p");\r\npageTracker._addOrganic("fr.yahoo.com","p");\r\npageTracker._addOrganic("nl.yahoo.com","p");\r\npageTracker._addOrganic("be.yahoo.com","p");\r\npageTracker._addOrganic("de.yahoo.com","p");\r\npageTracker._addOrganic("no.yahoo.com","p");\r\npageTracker._addOrganic("se.yahoo.com","p");\r\npageTracker._addOrganic("dk.yahoo.com","p");\r\npageTracker._addOrganic("fi.yahoo.com","p");\r\npageTracker._addOrganic("ch.yahoo.com","p");\r\npageTracker._addOrganic("at.yahoo.com","p");\r\npageTracker._addOrganic("ie.yahoo.com","p");\r\npageTracker._addOrganic("ru.yahoo.com","p");\r\npageTracker._addOrganic("pl.yahoo.com","p");\r\n\r\n// UK specific\r\npageTracker._addOrganic("hotbot.co.uk","query");\r\npageTracker._addOrganic("excite.co.uk","q");\r\npageTracker._addOrganic("bbc","q");\r\npageTracker._addOrganic("tiscali","query");\r\npageTracker._addOrganic("uk.ask.com","q");\r\npageTracker._addOrganic("blueyonder","q");\r\npageTracker._addOrganic("search.aol.co.uk","query");\r\npageTracker._addOrganic("ntlworld","q");\r\npageTracker._addOrganic("tesco.net","q");\r\npageTracker._addOrganic("orange.co.uk","q");\r\npageTracker._addOrganic("mywebsearch.com","searchfor");\r\npageTracker._addOrganic("uk.myway.com","searchfor");\r\npageTracker._addOrganic("searchy.co.uk","search_term");\r\npageTracker._addOrganic("msn.co.uk","q");\r\npageTracker._addOrganic("uk.altavista.com","q");\r\npageTracker._addOrganic("lycos.co.uk","query");\r\n\r\n// NL specific\r\npageTracker._addOrganic("chello.nl","q1");\r\npageTracker._addOrganic("home.nl","q");\r\npageTracker._addOrganic("planet.nl","googleq=q");\r\npageTracker._addOrganic("search.ilse.nl","search_for");\r\npageTracker._addOrganic("search-dyn.tiscali.nl","key");\r\npageTracker._addOrganic("startgoogle.startpagina.nl","q");\r\npageTracker._addOrganic("vinden.nl","q");\r\npageTracker._addOrganic("vindex.nl","search_for");\r\npageTracker._addOrganic("zoeken.nl","query");\r\npageTracker._addOrganic("zoeken.track.nl","qr");\r\npageTracker._addOrganic("zoeknu.nl","Keywords");\r\n\r\n// Extras\r\npageTracker._addOrganic("alltheweb","q");\r\npageTracker._addOrganic("ananzi","qt");\r\npageTracker._addOrganic("anzwers","search");\r\npageTracker._addOrganic("araby.com","q");\r\npageTracker._addOrganic("dogpile","q");\r\npageTracker._addOrganic("elmundo.es","q");\r\npageTracker._addOrganic("ezilon.com","q");\r\npageTracker._addOrganic("hotbot","query");\r\npageTracker._addOrganic("indiatimes.com","query");\r\npageTracker._addOrganic("iafrica.funnel.co.za","q");\r\npageTracker._addOrganic("mywebsearch.com","searchfor");\r\npageTracker._addOrganic("search.aol.com","encquery");\r\npageTracker._addOrganic("search.indiatimes.com","query");\r\npageTracker._addOrganic("searcheurope.com","query");\r\npageTracker._addOrganic("suche.web.de","su");\r\npageTracker._addOrganic("terra.es","query");\r\npageTracker._addOrganic("voila.fr","kw");\r\n\r\n// Extras RU\r\npageTracker._addOrganic("mail.ru", "q");\r\npageTracker._addOrganic("rambler.ru", "words");\r\npageTracker._addOrganic("nigma.ru", "s");\r\npageTracker._addOrganic("blogs.yandex.ru", "text");\r\npageTracker._addOrganic("yandex.ru", "text");\r\npageTracker._addOrganic("webalta.ru", "q");\r\npageTracker._addOrganic("aport.ru", "r");\r\npageTracker._addOrganic("poisk.ru", "text");\r\npageTracker._addOrganic("km.ru", "sq");\r\npageTracker._addOrganic("liveinternet.ru", "ask");\r\npageTracker._addOrganic("gogo.ru", "q");\r\npageTracker._addOrganic("gde.ru", "keywords");\r\npageTracker._addOrganic("quintura.ru", "request");\r\npageTracker._addOrganic("price.ru", "pnam");\r\npageTracker._addOrganic("torg.mail.ru", "q");\r\n\r\n\r\n// Extras BY\r\npageTracker._addOrganic("akavita.by", "z");\r\npageTracker._addOrganic("tut.by", "query");\r\npageTracker._addOrganic("all.by", "query");\r\n\r\n\r\n// Extras UA\r\npageTracker._addOrganic("meta.ua", "q");\r\npageTracker._addOrganic("bigmir.net", "q");\r\npageTracker._addOrganic("i.ua", "q");\r\npageTracker._addOrganic("online.ua", "q");\r\npageTracker._addOrganic("a.ua", "s");\r\npageTracker._addOrganic("ukr.net", "search_query");\r\npageTracker._addOrganic("search.com.ua", "q");\r\npageTracker._addOrganic("search.ua", "query");', 'cfg_ga_js_custom_se', 'cfg_ga_js_custom_se_description', 'setting_TEXT_AREA(', 4),
(61, 4, 'CONF_PRDPICT_ENLARGED_SIZE', '0', 'cfg_prdpict_enlarged_size_title', 'cfg_prdpict_enlarged_size_description', 'setting_TEXT_BOX(2,', 115),
(62, 2, 'CONF_PRINTFORM_COMPANY_LOGO', '', 'str_printforms_logo', '', 'setting_SINGLE_FILE(DIR_IMG,', 120),
(63, 1, 'CONF_SMSNOTIFY_ENABLED', '1', '', '', '', 1),
(64, 1, 'CONF_SMSNOTIFY_SMSSENDER_CONFIG_ID', '0', '', '', 'setting_SELECT_BOX(SMSNotify_getSMSSenderConfigIDOptions(),', 1),
(65, 1, 'CONF_SMSNOTIFY_SEND_PERIOD', '00:00-23:59', '', '', 'SMSNotify_setting_PERIOD(', 1),
(66, 1, 'CONF_SMSNOTIFY_PHONES', '0', '', '', 'SMSNotify_setting_Phones(', 1),
(67, 1, 'CONF_SMSNOTIFY_ENABLED', '1', '', '', '', 1),
(68, 1, 'CONF_SMSNOTIFY_SMSSENDER_CONFIG_ID', '0', '', '', 'setting_SELECT_BOX(SMSNotify_getSMSSenderConfigIDOptions(),', 1),
(69, 1, 'CONF_SMSNOTIFY_SEND_PERIOD', '00:00-23:59', '', '', 'SMSNotify_setting_PERIOD(', 1),
(70, 1, 'CONF_SMSNOTIFY_PHONES', '0', '', '', 'SMSNotify_setting_Phones(', 1),
(71, 1, 'CONF_SMSMAIL_MODULE_CLICKATELL_API_ID_2', '', 'API_ID', 'API_ID Вы можете узнать в Вашей учетной записи на Clickatell', 'setting_TEXT_BOX(0,', 1),
(72, 1, 'CONF_SMSMAIL_MODULE_CLICKATELL_USER_2', '', 'Clickatell логин', 'Логин от Вашей учетной записи Clickatell', 'setting_TEXT_BOX(0,', 1),
(73, 1, 'CONF_SMSMAIL_MODULE_CLICKATELL_PASSWORD_2', '', 'Clickatell пароль', 'Пароль к Вашей учетной записи Clickatell', 'setting_TEXT_BOX(0,', 1),
(74, 1, 'CONF_SMSMAIL_MODULE_CLICKATELL_ORIGINATOR_2', '', 'Отправитель сообщения, как он будет выглядеть на телефоне получателя', 'Отправитель может состоять из цифр - в этом случае его длина ограничена 15-ю символами, или буквенно-цифровым (например, название вашей компании) - в этом случае длина ограничена 11-ю символами. Русские буквы в имени отправителя не разрешены.', 'setting_TEXT_BOX(0,', 1),
(75, 1, 'CONF_SMSDRIVERCOM_LOGIN_3', '', 'Логин', 'Логин от Вашей учетной записи SMSDriver', 'setting_TEXT_BOX(0,', 1),
(76, 1, 'CONF_SMSDRIVERCOM_PASSWORD_3', '', 'Пароль', 'Пароль к Вашей учетной записи SMSDriver', 'setting_TEXT_BOX(0,', 1),
(77, 1, 'CONF_SMSDRIVERCOM_UNICODE_3', '0', 'Конвертировать сообщение в юникод', 'Если опция включена, максимальная длина сообщения - 70 символов', 'setting_CHECK_BOX(', 1),
(78, 1, 'CONF_SMSDRIVERCOM_ORIGINATOR_3', '', 'Отправитель сообщения, как он будет выглядеть на телефоне получателя', 'Отправитель может состоять из цифр - в этом случае его длина ограничена 15-ю символами, или буквенно-цифровым (например, название вашей компании) - в этом случае длина ограничена 11-ю символами. Русские буквы в имени отправителя не разрешены.', 'setting_TEXT_BOX(0,', 1),
(79, 1, 'CONF_SMSTRAFFICRU_LOGIN_4', '', 'Логин', '', 'setting_TEXT_BOX(0,', 1),
(80, 1, 'CONF_SMSTRAFFICRU_PASSWORD_4', '', 'Пароль', '', 'setting_TEXT_BOX(0,', 1),
(81, 1, 'CONF_SMSTRAFFICRU_RUS_4', '0', 'Передавать ли сообщение по русски(максимальная длина 70 символов)', 'Если нет сообщение будет транслитерировано.', 'setting_CHECK_BOX(', 1),
(82, 1, 'CONF_SMSTRAFFICRU_ORIGINATOR_4', '', 'Отправитель сообщения, как он будет выглядеть на телефоне получателя', 'Отправитель может быть цифровым, в этом случае его длина ограничена 15-ю символами, или буквенно-цифровым (например, название вашей компании), в этом случае длина ограничена 11-ю символами. Русские буквы в имени отправителя не разрешены. По умолчанию став', 'setting_TEXT_BOX(0,', 1),
(83, 1, 'CONF_PAYMENTMODULE_VKONTAKTE_MERCHANT_ID', '', 'Идентификатор интернет-магазина', 'Присваивается вашему магазину «Вконтактом» при регистрации', 'setting_TEXT_BOX(0,', 1),
(84, 1, 'CONF_PAYMENTMODULE_VKONTAKTE_SHARED_SECRET', '', 'Защищенный ключ', 'Ключ из настроек магазина внутри «Вконтакта»', 'setting_TEXT_BOX(0,', 1),
(85, 1, 'CONF_PAYMENTMODULE_VKONTAKTE_MODE', '1', 'Тестовый режим', 'Должен соответствовать одноименной настройке в профиле вашего магазина во «Вконтакте»', 'setting_CHECK_BOX(', 1),
(86, 1, 'CONF_PAYMENTMODULE_VKONTAKTE_PAY', '1', 'Принимать вконтактовские рубли на основной витрине магазина', 'Если включить, кнопка «Оформить заказ через «Вконтакт» будет показываться в корзине на <em>главной</em> витрине вашего магазина', 'setting_CHECK_BOX(', 1),
(87, 1, 'CONF_PAYMENTMODULE_VKONTAKTE_ORDERSTATUS', '-1', 'Статус заказа', 'Этот статус будет автоматически установлен для каждого заказа после <em>успешной</em> оплаты на стороне «Вконтакта»', 'setting_SELECT_BOX(PaymentModule::_getStatuses(),', 1),
(88, 1, 'CONF_PAYMENTMODULE_VKONTAKTE_RUB', '-1', 'Рубли', 'Валюта магазина, соответствующая вконтактовским рублям', 'setting_CURRENCY_SELECT(', 1),
(89, 1, 'CONF_PAYMENTMODULE_VKONTAKTE_HELLO', '', 'Описание', 'Опциональный HTML-код, которой будет выводиться на витрине (главной странице) магазина как приложения для соцсети', 'setting_TEXT_AREA(', 1),
(90, NULL, 'CONF_VKONTAKTE_ENABLED', '0', NULL, NULL, NULL, 0),
(91, 1, 'CONF_FACEBOOK_ENABLED', '0', '', '', '', 0),
(92, 1, 'CONF_FACEBOOK_LIKE_URL', '', 'FACEBOOK_CFG_LIKE_URL_TTL', 'FACEBOOK_CFG_LIKE_URL_DSCR', 'setting_TEXT_BOX(0,', 1),
(93, 1, 'CONF_FACEBOOK_HELLO', '', 'FACEBOOK_CFG_HELLO_TTL', 'FACEBOOK_CFG_HELLO_DSCR', 'setting_TEXT_AREA(', 2),
(95, NULL, 'CONF_ADDRESSFORM_ZIP', '1', NULL, NULL, NULL, 0),
(96, NULL, 'CONF_ADDRESSFORM_CITY', '0', NULL, NULL, NULL, 0),
(97, NULL, 'CONF_ADDRESSFORM_ADDRESS', '0', NULL, NULL, NULL, 0),
(98, 1, 'CONF_PAYMENTMODULE_2CHECKOUT_ID_12', '', '2checkout ID', 'Введите ваш идентификатор в системе 2checkout', 'setting_TEXT_BOX(0,', 1),
(99, 1, 'CONF_PAYMENTMODULE_2CO_USD_CURRENCY_12', '0', 'Доллары США', 'Сумма заказа, передаваемая в 2checkout, указывается в долларах США. Выберите валюту из списка, которая представляет собой доллары США - это необходимо для корректного пересчета суммы заказа в доллары. Если валюта не выбрана, сумма не будет пересчитываться', 'setting_CURRENCY_SELECT(', 1),
(100, 1, 'CONF_PAYMENTMODULE_ASSIST_MERCHANT_ID_12', '', 'Shop_IDP', 'Ваш ID в системе Assist', 'setting_TEXT_BOX(0,', 1),
(101, 1, 'CONF_PAYMENTMODULE_ASSIST_AUTHORIZATION_MODE_12', '0', 'Режим предварительной авторизации', 'Включите эту настройку, если Вы хотите, чтобы Ваш оплата по картам производилась в режиме предварительной авторизации; чтобы работать в нормальном режиме, выключите настройку', 'setting_CHECK_BOX(', 2),
(102, 1, 'CONF_PAYMENTMODULE_ASSIST_TEST_MODE_12', '0', 'Использовать тестовый режим', 'Включите эту настройку, если Вы хотите, чтобы оплата проводилась в тестовом режиме', 'setting_CHECK_BOX(', 3),
(103, 1, 'CONF_PAYMENTMODULE_AUTHNETSIM_LOGIN_12', '', 'Authorize.Net ID', 'Введите ваш идентификатор в системе Authorize.Net', 'setting_TEXT_BOX(0,', 1),
(104, 1, 'CONF_PAYMENTMODULE_AUTHNETSIM_TRAN_KEY_12', '', 'Transaction Key', 'Введите transaction key, который вы можете получить в интерфейсе Authorize.Net', 'setting_TEXT_BOX(0,', 1),
(105, 1, 'CONF_PAYMENTMODULE_AUTHNETSIM_TESTMODE_12', '', 'Тестовый режим', '', 'setting_CHECK_BOX(', 1),
(106, 1, 'CONF_PAYMENTMODULECASH_CURRENCY_12', '', 'Валюта', '', 'setting_CURRENCY_SELECT(', 1),
(107, 1, 'CONF_CCAVENUE_MERCHANT_ID_12', '', 'ID магазина', '', 'setting_TEXT_BOX(0,', 1),
(108, 1, 'CONF_CCAVENUE_WORKING_KEY_12', '', 'Ключ', '', 'setting_TEXT_BOX(0,', 1),
(109, 1, 'CONF_CCAVENUE_INR_CURRENCY_12', '', 'Валюта INR', '', 'setting_CURRENCY_SELECT(', 1),
(110, 1, 'CONF_CHRONOPAY_PRODUCT_ID_12', '', 'Product ID', 'Эта информация может быть получена в Вашем аккаунте Chronopay.', 'setting_TEXT_BOX(0,', 1),
(111, 1, 'CONF_CHRONOPAY_CURCODE_12', '', 'Доллары США', 'Сумма заказа, передаваемая в Chronopay, указывается в долларах США. Выберите валюту из списка, которая представляет собой доллары США - это необходимо для корректного пересчета суммы заказа в доллары. Если валюта не выбрана, сумма не будет пересчитываться', 'setting_CURRENCY_SELECT(', 1),
(112, 1, 'CONF_CHRONOPAY_LANG_12', 'En', 'Язык интерфейса', 'Выберите язык интерфейса на сервере Chronopay, который увидит покупатель при оплате', 'setting_SELECT_BOX(Chronopay::_getLanguages(),', 1),
(113, 1, 'CONF_CHRONOPAY_SHARED_SECRET_12', '', 'Shared Secret', 'Отправлен по e-mail из ChronoPay', 'setting_TEXT_BOX(0,', 1),
(114, 1, 'CONF_CHRONOPAY_ORDERSTATUS_12', '-1', 'Статус заказа после удачного оформления', 'Вы можете выбрать статус заказа, который будет присваиваться всем заказам, оплата по которым была успешно авторизована. Выберите "по умолчанию", если Вы хотите, чтобы заказы приобретали статус новых заказов, который Вы можете настроить в разделе администр', 'setting_SELECT_BOX(PaymentModule::_getStatuses(),', 1),
(115, 1, 'CONF_CYBERPLAT_TRANS_CURRENCY_12', '', 'Валюта, в которой будет проведена транзакция', '', 'setting_CURRENCY_SELECT(', 0),
(116, 1, 'CONF_EPDQ_HOST_12', 'secure2.mde.epdq.co.uk', 'Хост', 'Введите имя хоста ePDQ, на который мы будем отправлять информацию о заказе (это информацию Вы должны получить от ePDQ).<br />Не вводите префикс https:// и путь к файлу.', 'setting_TEXT_BOX(0,', 0),
(117, 1, 'CONF_EPDQ_CLIENT_ID_12', '', 'Client ID', 'Ваш ePDQ Client ID', 'setting_TEXT_BOX(0,', 0),
(118, 1, 'CONF_EPDQ_PASSPHRASE_12', '', 'Pass-Phrase', 'Pass-Phrase устанавливается в ePDQ Configuration Page  (https://secure2.mde.epdq.co.uk/cgi-bin/CcxBarclaysEpdqAdminTool.e). Обратите внимание, что Pass-Phrase отличается от Вашего пароля ePDQ аккаунта!', 'setting_TEXT_BOX(0,', 0),
(119, 1, 'CONF_EPDQ_CHARGETYPE_12', 'Auth', 'Авторизация оплаты по карте', 'Auth - деньги автоматически зачисляются на Ваш счет. PreAuth - деньги на счете клиента резервируются, после чего Вы вручную можете определить, продолжать списание со счета клиента или нет (например, после проверки платежа).', 'setting_SELECT_BOX(ePDQ::_getChargeTypeOptions(),', 0),
(120, 1, 'CONF_EPDQ_TRANSCURRENCY_12', '', 'Валюта транзакций', 'Укажите валюту, в которую должна переводиться сумма заказа перед отправкой на сервер ePDQ.', 'setting_CURRENCY_SELECT(', 0),
(121, 1, 'CONF_EPDQ_TRANSCURRENCYCODE_12', '826', 'Цифровой ISO-код валюты, выбранной выше', 'Посмотрите полный <a href=http://www.iso.org/iso/en/prods-services/popstds/currencycodeslist.html target=_blank>список ISO-кодов валют</a>. Обратитесь в ePDQ для того, чтобы узнать список поддерживаемых валют.', 'setting_TEXT_BOX(0,', 0),
(122, 1, 'CONF_ESELECTPLUS_TESTMODE_12', '', 'Использовать тестовый режим', '', 'setting_CHECK_BOX(', 0),
(123, 1, 'CONF_ESELECTPLUS_PS_STORE_ID_12', '', 'Hosted Paypage ID', 'Provided by Moneris Solutions – Hosted Paypage Configuration Tool. Identifies the configuration for the Hosted Paypage.', 'setting_TEXT_BOX(0,', 0),
(124, 1, 'CONF_ESELECTPLUS_HPP_KEY_12', '', 'Hosted Paypage Key', 'Provided by Moneris Solutions – Hosted Paypage Configuration Tool. This is a security key that corresponds to the ps_store_id. ', 'setting_TEXT_BOX(0,', 0),
(125, 1, 'CONF_ESELECTPLUS_USD_CURRENCY_12', '', 'выберите USD', 'Order amount transferred to eSelect plus web site is denominated in USD. Specify currency type in your shopping cart which is assumed as USD (order amount will be calculated according to USD exchange rate; if not specified exchange rate will be assumed as', 'setting_CURRENCY_SELECT(', 0),
(126, 1, 'CONF_GOOGLECHECKOUT2_ENABLED', '0', 'Включить модуль', '', 'setting_CHECK_BOX(', 0),
(127, 1, 'CONF_GOOGLECHECKOUT2_SANDBOX', '', 'Режим Sandbox', '', 'setting_CHECK_BOX(', 0),
(128, 1, 'CONF_GOOGLECHECKOUT2_CALCULATESHIPTAX', '1', 'Включить расчет стоимости доставки и налога', 'Гугл отправляет запрос на расчет стоимости в ваш интернет-магазин, и в течение 3 секунд этот запрос должен быть обработан. Если в вашем магазине используется модули доставки, которые требует более 3-х секунд на расчет стоимости, не включайте эту опцию.', 'setting_CHECK_BOX(', 0),
(129, 1, 'CONF_GOOGLECHECKOUT2_SENDORDERNOTIFYCATION', '0', 'Отправлять уведомление о заказе', 'Гугл отправляет покупателю уведомление о заказе. Включите эту опцию, что уведомление также отправлялось и из вашего интернет-магазина (таким образом покупатель получит два уведомления).', 'setting_CHECK_BOX(', 0),
(130, 1, 'CONF_GOOGLECHECKOUT2_MERCHANTID', '', 'Merchant ID', 'Вы можете получить эту информацию в вашем аккаунте Гугл в разделе "Settings" -> "Integration"', 'setting_TEXT_BOX(0,', 0),
(131, 1, 'CONF_GOOGLECHECKOUT2_MERCHANTKEY', '', 'Merchant key', 'Вы можете получить эту информацию в вашем аккаунте Гугл в разделе "Settings" -> "Integration"', 'setting_TEXT_BOX(0,', 0),
(132, 1, 'CONF_GOOGLECHECKOUT2_TRANSCURR', '', 'Валюта транзакций', 'Стоимость заказа будет переконвертирована в указанную валюту, и данные будут отправлены в Гугл. Сейчас поддерживается только валюта USD.', 'setting_CURRENCY_SELECT(', 0),
(133, 1, 'CONF_GOOGLECHECKOUT2_CHARGEORDER', '', 'Автоматически изменять статус оплаченных заказов', 'Когда вы выполняете действия с заказов в вашем аккаунте в Гугл, статус заказа в вашем интернет-магазине также будет изменяться.', 'setting_CHECK_BOX(', 0),
(134, 1, 'CONF_GOOGLECHECKOUT2_CHARGEDORDERSTATUS', '-1', 'Статус заказа после оплаты', '', 'setting_SELECT_BOX(PaymentModule::_getStatuses(),', 0),
(135, 1, 'CONF_GOOGLECHECKOUT2_SHIPPEDORDERSTATUS', '-1', 'Статус доставленных заказов', '', 'setting_SELECT_BOX(PaymentModule::_getStatuses(),', 0),
(136, 1, 'CONF_GSPAY_SITE_ID_12', '', 'Site ID', 'Идентификатор в системе GSPay', 'setting_TEXT_BOX(0,', 0),
(137, 1, 'CONF_GSPAY_TRANS_CURRENCY_12', '', 'Доллары США', 'Сумма заказа, передаваемая на сервер платежной системы, указывается в долларах США. Выберите валюту из списка, которая представляет собой доллары США - это необходимо для корректного пересчета суммы заказа в доллары. Если валюта не выбрана, сумма не будет', 'setting_CURRENCY_SELECT(', 0),
(138, 1, 'CONF_PMNT_HSBC_MODE_12', 'T', 'Режим работы модуля', '', 'setting_RADIOGROUP(HSBC_TXT_PMODE.":P,".HSBC_TXT_TMODE.":T",', 1),
(139, 1, 'CONF_PMNT_HSBC_STOREFRONTID_12', '', 'Storefront ID of your CPI service (Client Alias)', 'Эту информацию отправляется Вам HSBC по электронной почте. Пример: UK12345678CUR', 'setting_TEXT_BOX(0,', 1),
(140, 1, 'CONF_PMNT_HSBC_USERID_12', '', 'User ID', 'Эту информацию отправляет Вам HSBC по электронной почте', 'setting_TEXT_BOX(0,', 1),
(141, 1, 'CONF_PMNT_HSBC_SHAREDSECRET_12', '', 'Shared Secret', 'Эту информацию отправляет Вам HSBC по электронной почте', 'setting_TEXT_BOX(0,', 1),
(142, 1, 'CONF_PMNT_HSBC_TRANTYPE_12', 'Auth', 'Тип транзакции', 'Auth - сумма резервируется на счете клиента, но не переводится на Ваш счет автоматически; Sale - сумма автоматически переводится на Ваш счет. Для получения более подробной информации обратитесь в Innovative Gateway.', 'setting_RADIOGROUP(HSBC_TXT_TRANTYPE_AUTH.":Auth,".HSBC_TXT_TRANTYPE_CAPTURE.":Capture",', 1),
(143, 1, 'CONF_PMNT_HSBC_TRANSCURR_12', '', 'Валюта транзакций', 'Сумма заказа будет переведена в выбранную валюту по курсу Вашего магазина, после чего данные будут переданы на сервер платежной системы.<br /><b>В настоящее время HSBC принимает только значения в GBP!</b>', 'setting_CURRENCY_SELECT(', 1),
(144, 1, 'CONF_PMNT_HSBC_CURCODE_12', '826', 'Цифровой ISO-код валюты, выбранной выше', 'В настоящее время HSBC принимает только значения в GBP. Введите 826 в этом поле (это ISO-код фунтов стерлинга).', 'setting_TEXT_BOX(0,', 1),
(145, 1, 'CONF_IDEALBASIC_TEST_12', '1', 'Тестовый режим', '', 'setting_CHECK_BOX(', 0),
(146, 1, 'CONF_IDEALBASIC_SECRET_KEY_12', '', 'Секретный ключ', 'Введите секретный ключ как в вашем аккаунте iDEAL. Учтите, что ключи различаются для тестового и рабочего режимов оплаты', 'setting_TEXT_BOX(0,', 0),
(147, 1, 'CONF_IDEALBASIC_MERCHANT_ID_12', '', 'Merchant ID', 'You iDEAL merchant ID', 'setting_TEXT_BOX(0,', 0),
(148, 1, 'CONF_IDEALBASIC_EUR_CURRENCY_12', '', 'Выберите евро', 'Order amount transferred to GSPay is denominated in EUR. Specify currency type in your shopping cart which is assumed as EUR (order amount will be calculated according to EUR exchange rate; if not specified exchange rate will be assumed as 1)', 'setting_CURRENCY_SELECT(', 0),
(149, 1, 'CONF_IDEALBASIC_BANK_12', 'ing', 'Банк', 'Модулем поддерживается интеграция с ING и Rabobank. Выбор банка влияет на URL, на который будут отправлены данные о заказе для совершения платежа.', 'setting_SELECT_BOX(iDEAL_Basic::listBank(),', 0),
(150, 1, 'CONF_PAYMENTMODULE_JCCRL_URL_12', 'https://test.jccsecure.com/SENTRY/PaymentGateway/Application/RedirectLink.aspx', 'URL отправки транзакции', 'Укажите адрес, по которому будет отправлена информация о заказе в JCC', 'setting_TEXT_BOX(0,', 1),
(151, 1, 'CONF_PAYMENTMODULE_JCCRL_MERID_12', '', 'Merchant ID', '', 'setting_TEXT_BOX(0,', 1),
(152, 1, 'CONF_PAYMENTMODULE_JCCRL_MERPWD_12', '', 'Merchant Checkout Password', 'Ваш пароль', 'setting_TEXT_BOX(0,', 1),
(153, 1, 'CONF_PAYMENTMODULE_JCCRL_ACQID_12', '', 'Acquirer ID', 'Введите значение acquirer ID, предоставленное JCC', 'setting_TEXT_BOX(0,', 1),
(154, 1, 'CONF_PAYMENTMODULE_JCCRL_CAPTURE_12', '', 'Авторизация оплаты по карте', 'Автомат - деньги автоматически зачисляются на Ваш счет. Ручная - деньги на счете клиента резервируются, после чего Вы вручную можете определить, продолжать списание со счета клиента или нет (например, после проверки платежа).', 'setting_RADIOGROUP(JCCRedirectLink::_getCaptureOptions(),', 1),
(155, 1, 'CONF_PAYMENTMODULE_JCCRL_CUR_SHOP_12', '', 'Валюта транзакций', 'Укажите валюту, в которую должна переводиться сумма заказа перед отправкой на сервер JCC. Рекомендуется использовать Кипрские Фунты.', 'setting_CURRENCY_SELECT(', 1),
(156, 1, 'CONF_PAYMENTMODULE_JCCRL_CUR_ISONUM_12', '', 'Цифровой ISO-код валюты, выбранной выше', 'Посмотрите полный <a href=http://www.iso.org/iso/en/prods-services/popstds/currencycodeslist.html target=_blank>список ISO-кодов валют</a>. Введите 196, если Вы используете кипрские фунты. Обратитесь в JCC для того, чтобы узнать список поддерживаемых валю', 'setting_TEXT_BOX(0,', 1),
(157, 1, 'CONF_COURIER_COUNTRY_11', '176', 'Страна', 'Выберите страну, на территории которой возможна доставка курьером и, соответственно, расчет стоимости доставки данным модулем.', 'CourierShippingModule::setting_COUNTRY_SELECT(true,', 20),
(158, 1, 'CONF_COURIER_ZONE_11', '', 'Область', 'Выберите область, на территории которой возможна доставка курьером и, соответственно, расчет стоимости доставки данным модулем.', 'CourierShippingModule::setting_ZONE_SELECT(CONF_COURIER_COUNTRY_11,', 30),
(159, 1, 'CONF_COURIER_RATES_11', '', 'Стоимость доставки', 'В форме справа определите пары [сумма_заказа, стоимость_доставки]. Каждая пара определяет "стоимость_доставки" для заказов, сумма которых ниже чем "сумма_заказа". Для заказов, сумма которых выше максимальной указанной, стоимость доставки считается нулевой', 'CourierShippingModule::_settingRates(11,', 40),
(160, 1, 'CONF_COURIER2_COUNTRY_11', '176', 'Страна', 'Выберите страну, на территории которой возможна доставка курьером и, соответственно, расчет стоимости доставки данным модулем.', 'CourierShippingModule2::setting_COUNTRY_SELECT(true,', 20),
(161, 1, 'CONF_COURIER2_ZONE_11', '', 'Область', 'Выберите область, на территории которой возможна доставка курьером и, соответственно, расчет стоимости доставки данным модулем.', 'CourierShippingModule2::setting_ZONE_SELECT(CONF_COURIER2_COUNTRY_11,', 30),
(162, 1, 'CONF_COURIER2_RATES_11', '', 'Стоимость доставки', 'В форме справа определите пары [вес_заказа, стоимость_доставки]. Каждая пара определяет "стоимость_доставки" для заказов, вес которых ниже чем "вес_заказа". Для заказов, вес которых выше максимального указанного, стоимость доставки считается нулевой', 'CourierShippingModule2::_settingRates(11,', 40),
(163, 1, 'CONF_COURIER_COUNTRY_9', '176', 'Страна', 'Выберите страну, на территории которой возможна доставка курьером и, соответственно, расчет стоимости доставки данным модулем.', 'CourierShippingModule::setting_COUNTRY_SELECT(true,', 20),
(164, 1, 'CONF_COURIER_ZONE_9', '', 'Область', 'Выберите область, на территории которой возможна доставка курьером и, соответственно, расчет стоимости доставки данным модулем.', 'CourierShippingModule::setting_ZONE_SELECT(CONF_COURIER_COUNTRY_9,', 30),
(165, 1, 'CONF_COURIER_RATES_9', '', 'Стоимость доставки', 'В форме справа определите пары [сумма_заказа, стоимость_доставки]. Каждая пара определяет "стоимость_доставки" для заказов, сумма которых ниже чем "сумма_заказа". Для заказов, сумма которых выше максимальной указанной, стоимость доставки считается нулевой', 'CourierShippingModule::_settingRates(9,', 40),
(166, 1, 'CONF_COURIER2_COUNTRY_9', '176', 'Страна', 'Выберите страну, на территории которой возможна доставка курьером и, соответственно, расчет стоимости доставки данным модулем.', 'CourierShippingModule2::setting_COUNTRY_SELECT(true,', 20),
(167, 1, 'CONF_COURIER2_ZONE_9', '', 'Область', 'Выберите область, на территории которой возможна доставка курьером и, соответственно, расчет стоимости доставки данным модулем.', 'CourierShippingModule2::setting_ZONE_SELECT(CONF_COURIER2_COUNTRY_9,', 30),
(168, 1, 'CONF_COURIER2_RATES_9', '', 'Стоимость доставки', 'В форме справа определите пары [вес_заказа, стоимость_доставки]. Каждая пара определяет "стоимость_доставки" для заказов, вес которых ниже чем "вес_заказа". Для заказов, вес которых выше максимального указанного, стоимость доставки считается нулевой', 'CourierShippingModule2::_settingRates(9,', 40),
(169, 1, 'CONF_PPEXPRESSCHECKOUT_ENABLED', '0', 'Включить модуль', 'Если настройка выключена, покупателю не будет предложено оплатить заказ через PayPal на странице корзины покупок', 'setting_CHECK_BOX(', 1),
(170, 1, 'CONF_PPEXPRESSCHECKOUT_USERNAME', '', 'API Username', 'Введите API Username, которое было сгенерировано для Вас при подписке на PayPal Payments Pro', 'setting_TEXT_BOX(0,', 1),
(171, 1, 'CONF_PPEXPRESSCHECKOUT_PASSWORD', '', 'Пароль', 'Введите пароль, который Вы указывали при подписке на PayPal Payments Pro', 'setting_TEXT_BOX(0,', 1),
(172, 1, 'CONF_PPEXPRESSCHECKOUT_CERTPATH', '', 'Сертификат PayPal', 'В аккаунте на PayPal скачайте файл-сертификат (API certificate) и выберите этот файл в этой форме', 'setting_SINGLE_FILE(DIR_TEMP,', 1),
(173, 1, 'CONF_PPEXPRESSCHECKOUT_MODE', 'Sandbox', 'Режим работы', '', 'setting_RADIOGROUP(PPEXPRESSCHECKOUT_TXT_TEST.":Sandbox,".PPEXPRESSCHECKOUT_TXT_LIVE.":Live",', 1),
(174, 1, 'CONF_PPEXPRESSCHECKOUT_PAYMENTACTION', 'Sale', 'Способ авторизации платежа', 'Sale для автоматического списания полной суммы заказа со счета клиента; Authorization и Order - только авторизация карты, уточнение суммы к списанию и само списание производятся вручную в Вашем аккаунте на PayPal', 'setting_RADIOGROUP("Sale:Sale,Order:Order,Authorization:Authorization",', 1),
(175, 1, 'CONF_PPEXPRESSCHECKOUT_TRANSCURRENCY', '', 'Валюта транзакций', 'Вы можете выбрать валюту, в которой будет пересчитываться сумма заказа до отправки данных на сервер PayPal.', 'PPExpressCheckout::_settingCurrencySelect(', 1),
(176, 1, 'CONF_PPEXPRESSCHECKOUT_ORDERSTATUS', '-1', 'Статус заказа после удачного оформления', 'Вы можете выбрать статус заказа, который будет присваиваться всем заказам, оплата по которым была успешно авторизована. Выберите "по умолчанию", если Вы хотите, чтобы заказы приобретали статус новых заказов, который Вы можете настроить в разделе администр', 'setting_SELECT_BOX(PaymentModule::_getStatuses(),', 1),
(177, 1, 'CONF_NAB_NSIPS_URL_12', 'http://203.63.249.148/utci_v1.1.5/utci.nsa', 'URL отправки транзакций', 'Укажите адрес, на который будет отправляться информация о заказе покупателя.<br />Данную информацию Вы можете посмотреть в "Welcome Pack"-электронном письме от National Australia Bank', 'setting_TEXT_BOX(0,', 1),
(178, 1, 'CONF_NAB_NSIPS_MERCHID_12', '', 'Merchant ID', 'Уникальный 64-цифровой merchant ID, предоставленный в "Welcome Pack"-письме от National Australia Bank', 'setting_TEXT_BOX(0,', 1),
(179, 1, 'CONF_NAB_NSIPS_CURCODE_12', '', 'Австралийские доллары (AUD)', 'Сумма заказа, передаваемая в NAB, указывается в австралийских долларах (AUD). Выберите валюту из списка, которая представляет собой AUD - это необходимо для корректного пересчета суммы заказа. Если валюта не выбрана, сумма не будет пересчитываться', 'setting_CURRENCY_SELECT(', 1),
(180, 1, 'CONF_CPAYPALECHECKOUT_USERNAME_12', '', 'API Username', 'Введите API Username, которое было сгенерировано для Вас при подписке на PayPal Payments Pro', 'setting_TEXT_BOX(0,', 1),
(181, 1, 'CONF_CPAYPALECHECKOUT_PASSWORD_12', '', 'Пароль', 'Введите пароль, который Вы указывали при подписке на PayPal Payments Pro', 'setting_TEXT_BOX(0,', 1),
(182, 1, 'CONF_CPAYPALECHECKOUT_CERTPATH_12', '', 'Сертификат PayPal', 'В аккаунте на PayPal скачайте файл-сертификат (API certificate) и выберите этот файл в этой форме', 'setting_SINGLE_FILE(DIR_TEMP,', 1),
(183, 1, 'CONF_CPAYPALECHECKOUT_MODE_12', 'Sandbox', 'Режим работы', '', 'setting_RADIOGROUP(CPAYPALECHECKOUT_TXT_TEST.":Sandbox,".CPAYPALECHECKOUT_TXT_LIVE.":Live",', 1),
(184, 1, 'CONF_CPAYPALECHECKOUT_PAYMENTACTION_12', 'Sale', 'Способ авторизации платежа', 'Sale для автоматического списания полной суммы заказа со счета клиента; Authorization и Order - только авторизация карты, уточнение суммы к списанию и само списание производятся вручную в Вашем аккаунте на PayPal', 'setting_RADIOGROUP("Sale:Sale,Order:Order,Authorization:Authorization",', 1),
(185, 1, 'CONF_CPAYPALECHECKOUT_NOSHIPPING_12', '1', 'Отключить для покупателя возможность выбора адреса доставки на сайте PayPal', '', 'setting_CHECK_BOX(', 1),
(186, 1, 'CONF_CPAYPALECHECKOUT_ORDERSTATUS_12', '-1', 'Статус заказа после удачного оформления', 'Вы можете выбрать статус заказа, который будет присваиваться всем заказам, оплата по которым была успешно авторизована. Выберите "по умолчанию", если Вы хотите, чтобы заказы приобретали статус новых заказов, который Вы можете настроить в разделе администр', 'setting_SELECT_BOX(PaymentModule::_getStatuses(),', 1),
(187, 1, 'CONF_PAYMENT_RBKMONEY_ESHOPID_12', '', 'Номер сайта продавца', 'Номер вашего аккаунта в платежной системе RBK Money, на который будет поступать оплата по заказам.', 'setting_TEXT_BOX(0,', 1),
(188, 1, 'CONF_PAYMENT_RBKMONEY_SECRET_12', '', 'Секретный ключ', 'Ваш секретный ключ в системе RBK Money, известный только вам. Необходим для проверки ответа от платежной системы RUpay.', 'setting_TEXT_BOX(0,', 1),
(189, 1, 'CONF_ROBOXCHANGE_MERCHANTLOGIN_12', '', 'Логин магазина в обменном пункте', 'Информация о вашем аккаунте продавца в платежной системе ROBOXchange', 'setting_TEXT_BOX(0,', 1),
(190, 1, 'CONF_ROBOXCHANGE_MERCHANTPASS1_12', '', 'Пароль №1', 'Вводится в настройках аккаунта на сервере ROBOXchange.', 'setting_TEXT_BOX(0,', 1),
(191, 1, 'CONF_ROBOXCHANGE_MERCHANTPASS2_12', '', 'Пароль №2', 'Вводится в настройках аккаунта на сервере ROBOXchange.', 'setting_TEXT_BOX(0,', 1),
(192, 1, 'CONF_ROBOXCHANGE_TESTMODE_12', '', 'Тестовый режим', '', 'setting_CHECK_BOX(', 1),
(193, 1, 'CONF_ROBOXCHANGE_LANG_12', '', 'Язык интерфейса', 'Выберите язык интерфейса на сервере ROBOXchange, который увидит покупатель при оплате', 'setting_SELECT_BOX(ROBOXchange::_getLanguages(),', 1),
(194, 1, 'CONF_ROBOXCHANGE_ROBOXCURRENCY_12', '', 'Выберите валюту обменного пункта', 'Предлагаемая валюта платежа. Покупатель может изменить ее в процессе оплаты.', 'setting_SELECT_BOX(ROBOXchange::_getRoboxCurrencies(),', 1),
(195, 1, 'CONF_ROBOXCHANGE_SHOPCURRENCY_12', '', 'Выберите валюту магазина', 'Выберите из списка валют вашего интернет-магазина, которой соответствует выбранная вами в настройках аккаунта на сервере ROBOXchange "Валюта Продавца"', 'setting_CURRENCY_SELECT(', 1),
(196, 1, 'CONF_ROBOXCHANGE_ORDERSTATUS_12', '-1', 'Статус заказа после подтверждения оплаты', 'Все оплаченные на сайте ROBOXchange заказы будут автоматически переведены в выбранный статус (по факту получения сообщения от сервера ROBOXchange).', 'setting_SELECT_BOX(PaymentModule::_getStatuses(),', 1),
(197, 1, 'CONF_SECPAY_MERCHANT_12', '', 'Merchant username', 'Имя пользователя в SECPay (обычно это строка из шести букв и двух цифр).<br />Пример: abcdef01', 'setting_TEXT_BOX(0,', 1),
(198, 1, 'CONF_SECPAY_REMOTEPASSWORD_12', '', 'Remote password', 'Пароль SECPay', 'setting_TEXT_BOX(0,', 1),
(199, 1, 'CONF_SECPAY_CURRENCY_12', '', 'Валюта транзакций', 'Сумма заказа будет переведена в выбранную валюту по курсу Вашего магазина, после чего данные будут переданы на сервер платежной системы.', 'setting_CURRENCY_SELECT(', 1),
(200, 1, 'CONF_SETCOMCHECKOUTBTN_MERCHANTID_12', '', 'Merchant Identifier', 'Ваш идентификатор в системе Setcom', 'setting_TEXT_BOX(0,', 0),
(201, 1, 'CONF_SETCOMCHECKOUTBTN_CURRENCY_12', '', 'Валюта транзакции', 'Сумма заказа будет переведена в выбранную валюту по курсу Вашего магазина, после чего данные будут переданы на сервер платежной системы. Допустимые варианты: USD, EUR, GBP, ZAR', 'setting_CURRENCY_SELECT(', 0),
(202, 1, 'CONF_SKIPJACK_URL_12', 'https://developer.skipjackic.com/scripts/evolvcc.dll?Authorize', 'URL', '', 'setting_TEXT_BOX(0,', 1),
(203, 1, 'CONF_SKIPJACK_SERIAL_12', '', 'Serial', '', 'setting_TEXT_BOX(0,', 1),
(204, 1, 'CONF_SKIPJACK_USD_12', '', 'Выберите USD', '', 'setting_CURRENCY_SELECT(', 1),
(205, 1, 'CONF_YANDEXCPP_SHOPID_12', '', 'Shop ID', 'Идентификатор магазина в ЦПП - уникальное значение, присваивается Магазину платежной системой', 'setting_TEXT_BOX(0,', 1),
(206, 1, 'CONF_YANDEXCPP_SCID_12', '', 'scid', 'Номер витрины магазина в ЦПП. Выдается ЦПП.', 'setting_TEXT_BOX(0,', 1),
(207, 1, 'CONF_YANDEXCPP_MODE_12', 'live', 'Режим работы модуля', 'Определяет адрес (URL), куда будут отправлены данные о платеже', 'setting_SELECT_BOX(YandexCPP::_getModes(),', 1),
(208, 1, 'CONF_YANDEXCPP_TRANSCURRENCY_12', '', 'Валюта платежей в Вашем магазине', 'Выберите из списка валют Вашего интернет-магазина валюту, которая соответствует Рублям или Деморублям (валюте системы Яндекс.Деньги). Необходимо для перерасчета стоимости заказа.', 'setting_CURRENCY_SELECT(', 1),
(209, 1, 'CONF_YANDEXCPP_SHOPPASSWORD_12', '', 'Секретный пароль', 'используется при расчете криптографического хэша.', 'setting_TEXT_BOX(0,', 1),
(210, 1, 'CONF_YANDEXCPP_ORDERSTATUS_12', '-1', 'Статус заказа после подтверждения оплаты', 'Все оплаченные на сайте заказы будут автоматически переведены в выбранный статус (по факту получения сообщения от сервера yandexmoney).', 'setting_SELECT_BOX(PaymentModule::_getStatuses(),', 1),
(211, 1, 'CONF_YANDEXCPP_DEV_12', '0', 'Режим отладки', 'Включите этот режим для отладки - все параметры обращения к модулю будут записываться в лог модуля', 'setting_CHECK_BOX(', 2),
(212, 1, 'CONF_PAYMENTMODULE_EGOLD_MERCHANT_ACCOUNT_12', '', 'E-Gold account ID', 'Введите ваш идентификатор в системе E-Gold', 'setting_TEXT_BOX(0,', 1),
(213, 1, 'CONF_PAYMENTMODULE_EGOLD_USD_CURRENCY_12', '0', 'Доллары США', 'Сумма заказа, передаваемая в E-Gold, указывается в долларах США. Выберите валюту из списка, которая представляет собой доллары США - это необходимо для корректного пересчета суммы заказа в доллары. Если валюта не выбрана, сумма не будет пересчитываться', 'setting_CURRENCY_SELECT(', 1),
(214, 1, 'CONF_PAYMENTMODULE_INVOICE_JUR_CURRENCY_12', '0', 'Валюта - рубли', 'Счета на оплату выписываются в рублях. Выберите из списка валют магазина рубль. При формировании счета будет использоваться значение курса рубля. Если валюта не определена, будет использован курс выбранной пользователем валюты', 'setting_CURRENCY_SELECT(', 1),
(215, 1, 'CONF_PAYMENTMODULE_INVOICE_JUR_NDS_12', '0', 'Ставка НДС (%)', 'Укажите ставку НДС в процентах. Если Вы работаете по упрощенной системе налогообложения, укажите 0', 'setting_TEXT_BOX(0,', 1),
(216, 1, 'CONF_PAYMENTMODULE_INVOICE_JUR_NDS_IS_INCLUDED_IN_PRICE_12', '1', 'НДС уже включен в стоимость товаров', 'Включите эту опцию, если налог уже включен в стоимость товаров в Вашем магазине. Если же НДС не включен в стоимость и должен прибавляться дополнительно, выключите эту опцию', 'setting_CHECK_BOX(', 1),
(217, 1, 'CONF_PAYMENTMODULE_INVOICE_JUR_EMAIL_HTML_INVOICE_12', '1', 'Отправлять покупателю HTML-счет', 'Включите эту опцию, если хотите, чтобы покупателю автоматически отправлялся счет в HTML-формате. Если опция выключена, то покупателю будет отправлена ссылка на счет на сайте магазина', 'setting_CHECK_BOX(', 1),
(218, 1, 'CONF_PAYMENTMODULE_INVOICE_JUR_COMPANYNAME_12', '', 'Название компании', 'Укажите название организации, от имени которой выписывается счет', 'setting_TEXT_BOX(0,', 1),
(219, 1, 'CONF_PAYMENTMODULE_INVOICE_JUR_COMPANYADDRESS_12', '', 'Адрес компании', 'Укажите адрес организации, от имени которой выписывается счет', 'setting_TEXT_BOX(0,', 1),
(220, 1, 'CONF_PAYMENTMODULE_INVOICE_JUR_COMPANYPHONE_12', '', 'Телефон компании', 'Укажите телефон организации', 'setting_TEXT_BOX(0,', 1),
(221, 1, 'CONF_PAYMENTMODULE_INVOICE_JUR_BANK_ACCOUNT_NUMBER_12', '', 'Расчетный счет', 'Номер расчетного счета организации', 'setting_TEXT_BOX(0,', 1),
(222, 1, 'CONF_PAYMENTMODULE_INVOICE_JUR_INN_12', '', 'ИНН', 'ИНН организации', 'setting_TEXT_BOX(0,', 1),
(223, 1, 'CONF_PAYMENTMODULE_INVOICE_JUR_KPP_12', '', 'КПП', '', 'setting_TEXT_BOX(0,', 1),
(224, 1, 'CONF_PAYMENTMODULE_INVOICE_JUR_BANKNAME_12', '', 'Наименование банка', '', 'setting_TEXT_BOX(0,', 1),
(225, 1, 'CONF_PAYMENTMODULE_INVOICE_JUR_BANK_KOR_NUMBER_12', '', 'Корреспондентский счет', '', 'setting_TEXT_BOX(0,', 1),
(226, 1, 'CONF_PAYMENTMODULE_INVOICE_JUR_BIK_12', '', 'БИК', '', 'setting_TEXT_BOX(0,', 1),
(227, 1, 'CONF_PAYMENTMODULE_INVOICE_CUST_COMPANY_12', '', 'Компания покупателя', 'Поле "Компания" в форме регистрации. Если не выбрано, покупатель должен будет ввести название компании на последнем шаге оформления заказа.', 'setting_SELECT_BOX(CInvoiceJur::_getCustomerFields(),', 1),
(228, 1, 'CONF_PAYMENTMODULE_INVOICE_CUST_INN_12', '', 'ИНН покупателя', 'Поле "ИНН" в форме регистрации. Если не выбрано, покупатель должен будет ввести ИНН на последнем шаге оформления заказа.', 'setting_SELECT_BOX(CInvoiceJur::_getCustomerFields(),', 1),
(229, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_CURRENCY_12', '0', 'Валюта квитанции', 'Выберите валюту, в которой будет указываться сумма в квитанции. Если тип вылюты не определен, то квитанция будет выписываться в той валюте, которая выбрана пользователем при оформлении заказа', 'setting_CURRENCY_SELECT(', 1),
(230, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_DESCRIPTION_12', 'Оплата заказа №[orderID]', 'Описание покупки', 'Укажите описание платежей. Вы можете использовать строку <i>[orderID]</i> - она автоматически будет заменена на номер заказа', 'setting_TEXT_BOX(0,', 1),
(231, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_EMAIL_HTML_INVOICE_12', '1', 'Отправлять покупателю HTML-квитанцию', 'Включите эту опцию, если хотите, чтобы покупателю автоматически отправлялась квитанция в HTML-формате. Если опция выключена, то покупателю будет отправлена ссылка на квитанцию на сайте магазина', 'setting_CHECK_BOX(', 1),
(232, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_COMPANYNAME_12', '', 'Название компании', 'Укажите название организации, от имени которой выписывается квитанция', 'setting_TEXT_BOX(0,', 1),
(233, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_BANK_ACCOUNT_NUMBER_12', '', 'Расчетный счет', 'Номер расчетного счета организации', 'setting_TEXT_BOX(0,', 1),
(234, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_INN_12', '', 'ИНН', 'ИНН организации', 'setting_TEXT_BOX(0,', 1),
(235, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_KPP_12', '', 'КПП', '', 'setting_TEXT_BOX(0,', 1),
(236, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_BANKNAME_12', '', 'Наименование банка', '', 'setting_TEXT_BOX(0,', 1),
(237, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_BANK_KOR_NUMBER_12', '', 'Корреспондентский счет', '', 'setting_TEXT_BOX(0,', 1),
(238, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_BIK_12', '', 'БИК', '', 'setting_TEXT_BOX(0,', 1);
INSERT INTO `SC_settings` (`settingsID`, `settings_groupID`, `settings_constant_name`, `settings_value`, `settings_title`, `settings_description`, `settings_html_function`, `sort_order`) VALUES
(239, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_SECOND_NAME_12', '', 'Отчество', 'Выберите из списка поле в форме регистрации отвечающее за отчество покупателя — одно из полей, которое можно добавить в разделе Настройки &raquo; Форма регистрации и оформления заказов', 'setting_SELECT_BOX(CInvoicePhys::_getCustomerFields(),', 1),
(240, 1, 'CONF_PAYMENTMODULE_MALSE_USERID_12', '', 'User ID', 'Введите ваш идентификатор в системе Mals e-commerce', 'setting_TEXT_BOX(0,', 1),
(241, 1, 'CONF_PAYMENTMODULE_MALSE_CURR_TYPE_12', '0', 'Доллары США', 'Сумма заказа, передаваемая в mals-e, указывается в долларах США. Выберите валюту из списка, которая представляет собой доллары США - это необходимо для корректного пересчета суммы заказа в доллары. Если валюта не выбрана, сумма не будет пересчитываться', 'setting_CURRENCY_SELECT(', 1),
(242, 1, 'CONF_PAYMENTMODULE_MONEYBOOKERS_MERCHANT_EMAIL_12', '', 'Moneybookers email', 'Введите ваш идентификатор (email) в системе Moneybookers', 'setting_TEXT_BOX(0,', 1),
(243, 1, 'CONF_PAYMENTMODULE_NOCHEX_MERCHANT_EMAIL_12', '', 'NOCHEX email', 'Введите ваш идентификатор (email) в NOCHEX', 'setting_TEXT_BOX(0,', 1),
(244, 1, 'CONF_PAYMENTMODULE_NOCHEX_GBP_EXCHANGE_RATE_12', '1', 'Курс фунтов стерлингов по отношению к основной валюте.`', 'Введите сколько фунтов стерлингов составляют 1 единицу основной валюты в вашем магазине (например, введите 2.13, если 2.13 фунта = 1 ед. основной валюты)', 'setting_TEXT_BOX(0,', 1),
(245, 1, 'CONF_PAYMENTMODULE_PAYPAL_MERCHANT_EMAIL_12', '', 'PayPal email', 'Введите ваш email в системе PayPal', 'setting_TEXT_BOX(0,', 1),
(246, 1, 'CONF_PAYMENTMODULE_PAYPAL_CHECKOUT_MODE_12', 'Live', 'Режим работы', '', 'setting_RADIOGROUP(CPAYPAL_TXT_TEST.":Sandbox,".CPAYPAL_TXT_LIVE.":Live",', 1),
(247, 1, 'CONF_PAYMENTMODULE_PAYPAL_TRANSCURR_12', '', 'Доллары США', 'Сумма заказа, передаваемая в PayPal, указывается в долларах США. Выберите валюту из списка, которая представляет собой доллары США - это необходимо для корректного пересчета суммы заказа в доллары. Если валюта не выбрана, сумма не будет пересчитываться.', 'setting_CURRENCY_SELECT(', 0),
(248, 1, 'CONF_PAYMENTMODULE_PROTX_VENDORNAME_12', '', 'Логин', 'Введите ваш идентификатор в системе Sage Pay', 'setting_TEXT_BOX(0,', 1),
(249, 1, 'CONF_PAYMENTMODULE_PROTX_ENCPASSWORD_12', '', 'Encryption password', 'Введите Sage Pay encryption password', 'setting_TEXT_BOX(0,', 1),
(250, 1, 'CONF_PAYMENTMODULE_PROTX_MODE_12', '1', 'Режим работы', '', 'setting_SELECT_BOX(CProtx::getModeOptions(),', 1),
(251, 1, 'CONF_PAYMENT_RUPAYNEW_ESHOPID_12', '', 'Номер сайта продавца', 'Номер вашего аккаунта в платежной системе RUpay, на который будет поступать оплата по заказам.', 'setting_TEXT_BOX(0,', 1),
(252, 1, 'CONF_PAYMENT_RUPAYNEW_SECRET_12', '', 'Секретный ключ', 'Ваш секретный ключ в системе RUpay, известный только вам. Необходим для проверки ответа от платежной системы RUpay.', 'setting_TEXT_BOX(0,', 1),
(253, 1, 'CONF_PAYMENTMODULE_RUPAY_MERCHANT_EMAIL_12', '', 'Email (идентификатор в системе RUpay)', '', 'setting_TEXT_BOX(0,', 2),
(254, 1, 'CONF_PAYMENTMODULE_RUPAY_PAYMENTS_DESC_12', 'Оплата заказа №[orderID]', 'Назначение платежа', 'Укажите описание платежей. Вы можете использовать строку [orderID] - она автоматически будет заменена на номер заказа', 'setting_TEXT_BOX(0,', 2),
(255, 1, 'CONF_PAYMENTMODULE_RUPAY_USD_CURRENCY_12', '3', 'Валюта \\"Доллары США\\" в Вашем магазине', 'Сумма к оплате, отправляемая на сервер RUpay, указывается в долларах США (USD). Выберите из списка доллары США в Вашем магазине - это необходимо для верного пересчета суммы (по курсу доллара). Если тип вылюты не определен, курс считается равным 1', 'setting_CURRENCY_SELECT(', 3),
(256, 1, 'CONF_CRUPAYPAYMENTREQUEST_PAY_ID_12', '', 'Номер вашего сайта (магазина) в системе RUpay', '', 'setting_TEXT_BOX(0,', 1),
(257, 1, 'CONF_CRUPAYPAYMENTREQUEST_NAME_SERVICE_12', 'Оплата заказа №[orderID]', 'Назначение платежа', 'Укажите описание платежей. Вы можете использовать строку [orderID] - она автоматически будет заменена на номер заказа', 'setting_TEXT_BOX(0,', 1),
(258, 1, 'CONF_CRUPAYPAYMENTREQUEST_USD_CURRENCY_12', '3', 'Валюта "Доллары США" в Вашем магазине', 'Сумма к оплате, отправляемая на сервер RUpay, указывается в долларах США (USD). Выберите из списка доллары США в Вашем магазине - это необходимо для верного пересчета суммы (по курсу доллара). Если тип вылюты не определен, курс считается равным 1', 'setting_CURRENCY_SELECT(', 3),
(259, 1, 'CONF_PAYMENTMODULE_VERISIGNLINK_LOGIN_12', '', 'VeriSign Login', 'Введите ваш идентификатор в системе VeriSign', 'setting_TEXT_BOX(0,', 1),
(260, 1, 'CONF_PAYMENTMODULE_VERISIGNLINK_PARTNER_12', '', 'VeriSign partner', 'Введите идентификатор вашего партнера VeriSign (эта информация предоставляется реселлером VeriSign, через которого вы подключены). Если вы подключлись непосредственно в VeriSign, введите <b>VeriSign</b>', 'setting_TEXT_BOX(0,', 1),
(261, 1, 'CONF_PAYMENTMODULE_VERISIGNLINK_TRANSTYPE_12', 'S', 'Режим работы', '', 'setting_SELECT_BOX(CVeriSignLink::getTranstypeOptions(),', 1),
(262, 1, 'CONF_PAYMENTMODULE_VERISIGNLINK_USD_CURRENCY_12', '0', 'Доллары США', 'Сумма заказа, передаваемая в VeriSign, указывается в долларах США. Выберите валюту из списка, которая представляет собой доллары США - это необходимо для корректного пересчета суммы заказа в доллары. Если валюта не выбрана, сумма не будет пересчитываться', 'setting_CURRENCY_SELECT(', 1),
(263, 1, 'CONF_PAYMENTMODULE_WEBMONEY_MERCHANT_PURSE_12', '', 'Номер кошелька, на который будут приниматься деньги в Вашем магазине', 'Формат - буква и 12 цифр', 'setting_TEXT_BOX(0,', 1),
(264, 1, 'CONF_PAYMENTMODULE_WEBMONEY_MERCHANT_EXCHANGERATE_12', '1', 'Курс у.е. магазина по отношению к валюте Web-Money', '', 'setting_TEXT_BOX(1,', 1),
(265, 1, 'CONF_PAYMENTMODULE_WEBMONEY_TESTMODE_12', '', 'Тестовый режим', 'Используйте тестовый режим для проверки модуля', 'setting_CHECK_BOX(', 1),
(266, 1, 'CONF_PAYMENTMODULE_WEBMONEY_PAYMENTS_DESC_12', 'Оплата заказа #[orderID]', 'Назначение платежей', 'Укажите описание платежей. Вы можете использовать строку [orderID] - она автоматически будет заменена на номер заказа', 'setting_TEXT_BOX(0,', 1),
(267, 1, 'CONF_PAYMENTMODULE_WEBMONEY_SHARED_SECRET_12', '', 'Secret Key', 'Строка символов, добавляемая к реквизитам платежа, высылаемым продавцу вместе с оповещением. Эта строка используется для повышения надежности идентификации высылаемого оповещения. Содержание строки известно только сервису Web Merchant Interface и продавцу', 'setting_TEXT_BOX(0,', 1),
(268, 1, 'CONF_PAYMENTMODULE_WEBMONEY_ORDERSTATUS_12', '-1', 'Статус заказа', 'Статус, который будет автоматически установлен для заказа после успешной оплаты', 'setting_SELECT_BOX(PaymentModule::_getStatuses(),', 1),
(269, 1, 'CONF_PAYMENTMODULE_WORLDPAY_INSTID_12', '', 'WorldPay ID', 'Введите ваш идентификатор в системе WorldPay', 'setting_TEXT_BOX(0,', 1),
(270, 1, 'CONF_PAYMENTMODULE_YANDEXMONEY_MERCHANT_ID_12', '', 'Номер счета в Яндекс.Деньги', 'Указите номер Вашего счета в системе Яндекс.Деньги', 'setting_TEXT_BOX(0,', 1),
(271, 1, 'CONF_PAYMENTMODULE_YANDEXMONEY_MERCHANT_ADDRESS_12', '', 'Адрес продавца / магазина', 'В качестве адреса может быть указан IP, доменный или e-mail адрес (используется для отправки уведомления об оплате)', 'setting_TEXT_BOX(0,', 2),
(272, 1, 'CONF_PAYMENTMODULE_YANDEXMONEY_MERCHANT_EXCHANGERATE_12', '1', 'Курс у.е. магазина по отношению к валюте в системе Яндекс.Деньги', 'Платеж в системе Яндекс.Деньги<br>осуществляется <u>в рублях</u>', 'setting_TEXT_BOX(1,', 3),
(273, 1, 'CONF_PAYMENTMODULE_YANDEXMONEY_PAYMENTS_DESC_12', 'Оплата заказа №[orderID]', 'Назначение платежа', 'Укажите описание платежей. Вы можете использовать строку [orderID] - она автоматически будет заменена на номер заказа', 'setting_TEXT_BOX(0,', 4),
(274, 1, 'CONF_SHIPPING_DHL_TEST_MODE_9', '1', 'Тестовый режим', '', 'setting_CHECK_BOX(', 0),
(275, 1, 'CONF_SHIPPING_DHL_ERROR_LOG_9', '1', 'Включить запись ошибочных ответов сервера DHL', 'В случае ошибки расчета стоимости доставки, сообщение об ошибке записывается в файл temp/dhl_errors.log', 'setting_CHECK_BOX(', 0),
(276, 1, 'CONF_SHIPPING_DHL_LOGIN_ID_9', '', 'API System ID', 'Введите API System ID, предоставленный DHL', 'setting_TEXT_BOX(0,true,', 10),
(277, 1, 'CONF_SHIPPING_DHL_PASSWORD_9', '', 'API Password', 'Введите API Password, предоставленный DHL', 'setting_TEXT_BOX(0,true,', 10),
(278, 1, 'CONF_SHIPPING_DHL_ACCOUNT_NUMBER_9', '', 'Account number', 'Номер учетной записи (аккаунта) в DHL', 'setting_TEXT_BOX(0,true,', 10),
(279, 1, 'CONF_SHIPPING_DHL_SHIPPING_KEY_9', '', 'Domestic Shipping key', 'Введите Shipping Key, предоставленный Вам DHL', 'setting_TEXT_BOX(0,true,', 20),
(280, 1, 'CONF_SHIPPING_DHL_ISHIPPING_KEY_9', '', 'International Shipping key', 'Введите Shipping Key, предоставленный Вам DHL', 'setting_TEXT_BOX(0,true,', 20),
(281, 1, 'CONF_SHIPPING_DHL_DUTIABLE_9', '1', 'Подлежит обложению таможенной пошлиной', 'Только для международной доставки', 'setting_CHECK_BOX(', 0),
(282, 1, 'CONF_SHIPPING_DHL_BILLING_PARTY_9', 'S', 'Плательщик', 'Выбирите кто производит оплату услуг DHL - отправитель (Sender) или получатель (Receiver)', 'setting_SELECT_BOX(DHLShippingModule::_getBillingParties(),', 0),
(283, 1, 'CONF_SHIPPING_DHL_SHIPDATE_9', '', 'Отправление через X дней', 'Введите количество дней, по истечению которых с момента оформления заказа DHL должен забрать посылку', 'setting_TEXT_BOX(0,', 30),
(284, 1, 'CONF_SHIPPING_DHL_SHIPMENT_TYPE_9', 'P', 'Упаковка', 'Выберите способ упавковки посылок', 'setting_SELECT_BOX(DHLShippingModule::_getShipmentType(),', 40),
(285, 1, 'CONF_SHIPPING_DHL_DIMENSIONS_9', '', 'Габариты', 'Если габариты (размер) отправлений в Вашем интернет-магазине фиксированы, введите их значения в дюймах в формате LxWxH, где L, W, H - длина, ширина и высота соответственно.<br>Если размеры не фиксированы, оставьте это поле пустым', 'setting_TEXT_BOX(0,', 50),
(286, 1, 'CONF_SHIPPING_DHL_AP_9', '0', 'Страхование отправления', 'Включите, если Вы хотите, чтобы стоимость доставки расчитывалась с учетом стоимости страховки от ущерба и потери', 'setting_SELECT_BOX(DHLShippingModule::_getAPOptions(),', 0),
(287, 1, 'CONF_SHIPPING_DHL_AP_VALUE_9', '0;0', 'Размер суммы страхования', 'Если Вы выбрали страхование отправления, введите размер суммы страхования', 'DHLShippingModule::_setting_AP_VALUE(9,', 0),
(288, 1, 'CONF_SHIPPING_DHL_COD_9', '-', 'Collect On Delivery', 'Если оплата заказов производится по факту получения (Collect On Delivery - COD), выбирите способ приема оплаты.<br>Если опция COD включена, плательщиком должен быть отправитель.<br>Если Вы используете COD, выбирите n/a.', 'setting_SELECT_BOX(DHLShippingModule::_getCODMethods(),', 0),
(289, 1, 'CONF_SHIPPING_DHL_USD_CURRENCY_9', '', 'Валюта "Доллары США"', 'Стоимость доставки, расчитываемая DHL, указывается в долларах США. Выберите валюту Вашего магазина, которая представляет собой доллары США для корректного пересчета стоимости доставки в другие валюты.', 'setting_CURRENCY_SELECT(', 0),
(290, 1, 'CONF_SHIPPING_DHL_SERVICES_9', '', 'Доступные сервисы', 'Выберите сервисы DHL, которые будут предложены покупателю для выбора при оформлении заказа', 'setting_CHECKBOX_LIST(DHLShippingModule::_getServices(),', 6),
(291, 1, 'CONF_SHIPPING_FEDEX_TESTMODE_9', '1', 'Тестовый режим', '', 'setting_CHECK_BOX(', 10),
(292, 1, 'CONF_SHIPPING_FEDEX_ACCOUNT_NUMBER_9', '', 'Account number', 'Номер учетной записи (аккаунта) в FedEx', 'setting_TEXT_BOX(0,true,', 10),
(293, 1, 'CONF_SHIPPING_FEDEX_METER_NUMBER_9', '', 'Meter number', 'Если у Вас нет Meter number, оставьте это поле пустым. Meter number будет сгенерирован автоматически.', 'setting_TEXT_BOX(0,true,', 20),
(294, 1, 'CONF_SHIPPING_FEDEX_PACKAGING_9', '01', 'Упаковка', 'В случае, если Вы используете ''FedEx Ground'' необходимо выбрать ''Your packaging''', 'setting_SELECT_BOX(fedexShippingModule::_getPackagingTypes(),', 40),
(295, 1, 'CONF_SHIPPING_FEDEX_CARRIER_9', 'FDXE', 'Сервис', 'Выберите сервис FedEx', 'setting_SELECT_BOX(array(array("title"=>"All","value"=>"ALL"),array("title"=>"FedEx Express","value"=>"FDXE"), array("title"=>"FedEx Ground", "value"=>"FDXG")),', 50),
(296, 1, 'CONF_SHIPPING_FEDEX_CURRENCY_9', '', 'Валюта "Доллары США"', 'Стоимость доставки, расчитываемая FedEx, указывается в долларах США. Выберите валюту Вашего магазина, которая представляет собой доллары США для корректного пересчета стоимости доставки в другие валюты.', 'setting_CURRENCY_SELECT(', 55),
(297, 1, 'CONF_SHIPPING_FEDEX_COUNTRY_CODE_9', '176', 'Страна отправитея', 'Укажите страну отправления заказов.', 'setting_COUNTRY_SELECT(true,', 60),
(298, 1, 'CONF_SHIPPING_FEDEX_POSTAL_CODE_9', '', 'Почтовый код (индекс, ZIP-код) отправителя', 'Обязательное поле, если страна отправления США или Канада<br />\r\n	Укажите почтоый индекс места отправления заказов.', 'setting_TEXT_BOX(0,', 70),
(299, 1, 'CONF_SHIPPING_FEDEX_STATE_OR_PROVINCE_CODE_9', '186', 'Штат/провинция отправителя', 'Обязательное поле, если страна отправления США или Канада<br />\r\n	Введите название штата/провинции, из которой Вы отправляете заказы.', 'setting_ZONE_SELECT(CONF_SHIPPING_FEDEX_COUNTRY_CODE_9,', 80),
(300, 1, 'CONF_SHIPPING_FEDEX_CITY_9', '', 'Город', 'Информация необходима для формирования Meter number', 'setting_TEXT_BOX(0,', 90),
(301, 1, 'CONF_SHIPPING_FEDEX_ADDRESS_9', '', 'Адрес', 'Введите Ваш адрес<br />\r\n	Информация необходима для формирования Meter number', 'setting_TEXT_BOX(0,', 100),
(302, 1, 'CONF_SHIPPING_FEDEX_PHONE_NUMBER_9', '', 'Номер телефона', '111-222-3333<br />\r\n	Информация необходима для формирования Meter number', 'setting_TEXT_BOX(0,', 110),
(303, 1, 'CONF_SHIPPING_FEDEX_NAME_9', '', 'Ваше имя', 'Информация необходима для формирования Meter number', 'setting_TEXT_BOX(0,', 120),
(304, 1, 'CONF_SHIPPING_FEDEX_ENABLE_ERROR_LOG_9', '', 'Включить запись ошибочных ответов сервера FedEx', 'В случае ошибки расчета стоимости доставки, сообщение об ошибке записывается в файл temp/fedex_errors.log', 'setting_CHECK_BOX(', 130),
(305, 1, 'CONF_INTERSHIPPER_USERNAME_9', '', 'Имя пользователя в системе InterShipper', 'Введите информацию о Вашей учетной записи в InterShipper', 'setting_TEXT_BOX(0,true,', 0),
(306, 1, 'CONF_INTERSHIPPER_PASSWORD_9', '', 'Пароль для учетной записи  в системе InterShipper', 'Введите информацию о Вашей учетной записи в InterShipper', 'setting_TEXT_BOX(0,true,', 0),
(307, 1, 'CONF_INTERSHIPPER_CARRIERS_9', '', 'Компании-перевозчики', 'Отметьте галочками те компании, услугами которых Вы пользуетесь. Стоимость доставки будет посылки будет расчитываться через каждую из выбранных компаний.', 'InterShipperModule::settingCarriers(9,', 0),
(308, 1, 'CONF_INTERSHIPPER_CLASSES_9', '', 'Типы доставки', 'Отметьте предлагаемые пользователю типы (классы) доставки', 'setting_CHECKBOX_LIST(InterShipperModule::getClasses4List(),', 0),
(309, 1, 'CONF_INTERSHIPPER_SHIPMETHOD_9', 'DRP', 'Как посылка попадет к доставляющей компании', 'Выберите способ доставки отправлений к компании-перевозчику', 'InterShipperModule::settingShipMethod(', 0),
(310, 1, 'CONF_INTERSHIPPER_SHMOPTION_9', '', 'Дополнительная информация к способу получения посылки компанией доставки', 'Укажите дополнительную информацию в зависимости от выбранного способа доставки отправления перевозчику', 'InterShipperModule::settingSHMOption(CONF_INTERSHIPPER_SHIPMETHOD_9,', 0),
(311, 1, 'CONF_INTERSHIPPER_PACKAGING_9', 'BOX', 'Упаковка', 'Выберите способ упаковки отправлений (посылок)', 'setting_SELECT_BOX(InterShipperModule::getPackaging4Select(),', 0),
(312, 1, 'CONF_INTERSHIPPER_CONTENTS_9', 'OTR', 'Содержимое посылок', 'Охарактеризуйте вид отправляемых товаров', 'setting_SELECT_BOX(InterShipperModule::getContents4Select(),', 0),
(313, 1, 'CONF_INTERSHIPPER_INSURANCE_9', '', 'Страховка посылок', 'Введите процент от стоимости заказа (пример: 10%), точную сумму (пример: 15.96) или оставьте поле пустым, если страховка не нужна', 'InterShipperModule::settingInsurance(', 0),
(314, 1, 'CONF_INTERSHIPPER_USD_9', '', 'Валюта "Доллары США"', 'Стоимость доставки, расчитываемая сервером InterShipper, указывается в долларах США. Выберите валюту Вашего магазина, которая представляет собой доллары США для корректного пересчета стоимости доставки в другие валюты.', 'setting_CURRENCY_SELECT(', 0),
(315, 1, 'CONF_INTERSHIPPER_COUNTRY_9', '176', 'Страна отправителя', 'InterShipper расчитывает стоимость доставки только для отправлений с территории США. Выберите США в списке стран', 'setting_COUNTRY_SELECT(true,', 0),
(316, 1, 'CONF_INTERSHIPPER_POSTAL_9', '', 'Почтовый код (индекс, ZIP-код) отправителя', 'Укажите почтовый индекс (zip) места отправления заказов', 'setting_TEXT_BOX(0,', 0),
(317, 1, 'CONF_INTERSHIPPER_STATE_9', '', 'Штат/провинция отправителя', 'Укажите штат/провинцию, из которой отправляются заказы', 'setting_ZONE_SELECT(CONF_INTERSHIPPER_COUNTRY_9, array("mode"=>"notdef"),', 0),
(318, 1, 'CONF_INTERSHIPPER_CITY_9', '', 'Город', 'Введите название города, из которого будут производиться отправления', 'setting_TEXT_BOX(0,', 0),
(319, 1, 'CONF_RUSSIANPOST_CURRENCY_9', '', 'Валюта - Рубли', 'Выберите валюту Вашего магазина, которая представляет собой рубли. Это необходимо для корректного пересчета стоимости доставки в другие валюты.', 'setting_CURRENCY_SELECT(', 10),
(320, 1, 'CONF_RUSSIANPOST_COUNTRY_9', '176', 'Страна - Россия', 'Пожалуйста, выбрите страну, в для которой Вы хотите настроить модуль Почты России. Данный модуль будет работать только для выбранной страны.', 'setting_COUNTRY_SELECT(true,', 20),
(321, 1, 'CONF_RUSSIANPOST_ZONES_9', '', 'Распределите области, определенные в Вашем магазине, по тарифным поясам', '', 'RussianPost::settingZones(9, "CONF_RUSSIANPOST_COUNTRY_9")', 30),
(322, 1, 'CONF_RUSSIANPOST_AIR_9', '93.00', 'Надбавка за отправление ''Авиа''', 'Укажите стоимость в рублях', 'setting_TEXT_BOX(0,', 40),
(323, 1, 'CONF_RUSSIANPOST_CAUTION_9', '', 'Все посылки отправляются с отметкой "Осторожно"', '', 'setting_CHECK_BOX(', 50),
(324, 1, 'CONF_RUSSIANPOST_MAX_WEIGHT_9', '20', 'Максимальный вес отправления', 'Укажите вес в килограммах', 'setting_TEXT_BOX(0,', 60),
(325, 1, 'CONF_RUSSIANPOST_DIFFICULT_WEIGHT_9', '10', 'Вес усложненной тарификации', 'Укажите вес усложненной тарификации в килограммах (вес, начиная с которого к стоимости доставки посылки прибавляется 30%)', 'setting_TEXT_BOX(0,', 70),
(326, 1, 'CONF_RUSSIANPOST_COMMISION_9', '3', 'Плата за сумму объявленной ценности посылки', 'В процентах. Например, укажите 3%, если с каждого рубля взимается 3 копейки.', 'setting_TEXT_BOX(0,', 80),
(327, 1, 'CONF_RUSSIANPOST_HALFCOST_1_9', '53.45', 'Стоимость отправки посылки весом до 0.5 килограмм (включительно)', 'Укажите стоимость в рублях', 'RussianPost::settingHalfCosts(0,', 90),
(328, 1, 'CONF_RUSSIANPOST_HALFCOST_2_9', '58.9', 'Стоимость отправки посылки весом до 0.5 килограмм (включительно)', 'Укажите стоимость в рублях', 'RussianPost::settingHalfCosts(0,', 90),
(329, 1, 'CONF_RUSSIANPOST_HALFCOST_3_9', '77.4', 'Стоимость отправки посылки весом до 0.5 килограмм (включительно)', 'Укажите стоимость в рублях', 'RussianPost::settingHalfCosts(0,', 90),
(330, 1, 'CONF_RUSSIANPOST_HALFCOST_4_9', '103.55', 'Стоимость отправки посылки весом до 0.5 килограмм (включительно)', 'Укажите стоимость в рублях', 'RussianPost::settingHalfCosts(0,', 90),
(331, 1, 'CONF_RUSSIANPOST_HALFCOST_5_9', '116.65', 'Стоимость отправки посылки весом до 0.5 килограмм (включительно)', 'Укажите стоимость в рублях', 'RussianPost::settingHalfCosts(0,', 90),
(332, 1, 'CONF_RUSSIANPOST_OVERHALFCOST_1_9', '4.4', 'Стоимость отправки каждых дополнительных 0.5 килограмм', 'Укажите стоимость в рублях', 'RussianPost::settingHalfCosts(1,', 100),
(333, 1, 'CONF_RUSSIANPOST_OVERHALFCOST_2_9', '4.7', 'Стоимость отправки каждых дополнительных 0.5 килограмм', 'Укажите стоимость в рублях', 'RussianPost::settingHalfCosts(1,', 100),
(334, 1, 'CONF_RUSSIANPOST_OVERHALFCOST_3_9', '5.9', 'Стоимость отправки каждых дополнительных 0.5 килограмм', 'Укажите стоимость в рублях', 'RussianPost::settingHalfCosts(1,', 100),
(335, 1, 'CONF_RUSSIANPOST_OVERHALFCOST_4_9', '7.55', 'Стоимость отправки каждых дополнительных 0.5 килограмм', 'Укажите стоимость в рублях', 'RussianPost::settingHalfCosts(1,', 100),
(336, 1, 'CONF_RUSSIANPOST_OVERHALFCOST_5_9', '8.3', 'Стоимость отправки каждых дополнительных 0.5 килограмм', 'Укажите стоимость в рублях', 'RussianPost::settingHalfCosts(1,', 100),
(337, 1, 'CONF_SHIPPING_UPS_ACCESSLICENSENUMBER_9', '', '', '', '', 0),
(338, 1, 'CONF_SHIPPING_UPS_USERID_9', '', '', '', '', 0),
(339, 1, 'CONF_SHIPPING_UPS_PASSWORD_9', '', '', '', '', 0),
(340, 1, 'CONF_SHIPPING_UPS_SHIPPER_COUNTRY_ID_9', '', '', '', '', 0),
(341, 1, 'CONF_SHIPPING_UPS_SHIPPER_CITY_9', '', '', '', '', 0),
(342, 1, 'CONF_SHIPPING_UPS_SHIPPER_POSTALCODE_9', '', '', '', '', 0),
(343, 1, 'CONF_SHIPPING_UPS_PICKUP_TYPE_9', '', '', '', '', 0),
(344, 1, 'CONF_SHIPPING_UPS_CUSTOMER_CLASSIFICATION_9', '', '', '', '', 0),
(345, 1, 'CONF_SHIPPING_UPS_PACKAGE_TYPE_9', '', '', '', '', 0),
(346, 1, 'CONF_SHIPPING_UPS_ENABLE_ERROR_LOG_9', '', '', '', '', 0),
(347, 1, 'CONF_SHIPPING_UPS_USD_CURRENCY_9', '', '', '', '', 0),
(348, 1, 'CONF_SHIPPING_USPS_USERID_9', '', '', '', '', 0),
(349, 1, 'CONF_SHIPPING_USPS_ZIPORIGINATION_9', '', '', '', '', 0),
(350, 1, 'CONF_SHIPPING_USPS_PACKAGESIZE_9', '', '', '', '', 0),
(351, 1, 'CONF_SHIPPING_USPS_MACHINABLE_9', '', '', '', '', 0),
(352, 1, 'CONF_SHIPPING_USPS_DOMESTIC_SERVS_9', '', '', '', '', 0),
(353, 1, 'CONF_SHIPPING_USPS_INTERNATIONAL_SERVS_9', '', '', '', '', 0),
(354, 1, 'CONF_SHIPPING_USPS_ENABLE_ERROR_LOG_9', '', '', '', '', 0),
(355, 1, 'CONF_SHIPPING_USPS_USD_CURRENCY_9', '', '', '', '', 0),
(356, 1, 'CONF_SHIPPING_MODULE_FIXEDRATE_SHIPPINGRATE_9', '', '', '', '', 0),
(357, 1, 'CONF_SHIPPING_MODULE_FIXEDRATEPLUSPERCENT_FIXEDRATE_9', '', '', '', '', 0),
(358, 1, 'CONF_SHIPPING_MODULE_FIXEDRATEPLUSPERCENT_PERCENT_9', '', '', '', '', 0),
(359, 1, 'CONF_SHIPPING_MODULE_FIXEDRATEXORPERCENT_FIXEDRATE_9', '', '', '', '', 0),
(360, 1, 'CONF_SHIPPING_MODULE_FIXEDRATEXORPERCENT_PERCENT_9', '', '', '', '', 0),
(361, 1, 'CONF_SHIPPING_MODULE_BYCOUNTRYBYZONE_IS_INSTALLED_9', '1', 'Настройка стоимости', '', 'settingCONF_BYCOUNTRY_BYZONE_FORM(9)', 1),
(362, 1, 'CONF_SHIPPING_MODULE_BYCOUNTRYBYZONEPERCENT_IS_INSTALLED_9', '1', 'Настройка стоимости доставки', 'Здесь вы можете указать стоимость доставки как % от суммы заказа отдельно для каждой страны и области', 'settingCONF_BYCOUNTRY_BYZONE_PERCENT_FORM(9)', 1),
(363, 1, 'CONF_SHIPPING_DHL_TEST_MODE_11', '1', 'Тестовый режим', '', 'setting_CHECK_BOX(', 0),
(364, 1, 'CONF_SHIPPING_DHL_ERROR_LOG_11', '1', 'Включить запись ошибочных ответов сервера DHL', 'В случае ошибки расчета стоимости доставки, сообщение об ошибке записывается в файл temp/dhl_errors.log', 'setting_CHECK_BOX(', 0),
(365, 1, 'CONF_SHIPPING_DHL_LOGIN_ID_11', '', 'API System ID', 'Введите API System ID, предоставленный DHL', 'setting_TEXT_BOX(0,true,', 10),
(366, 1, 'CONF_SHIPPING_DHL_PASSWORD_11', '', 'API Password', 'Введите API Password, предоставленный DHL', 'setting_TEXT_BOX(0,true,', 10),
(367, 1, 'CONF_SHIPPING_DHL_ACCOUNT_NUMBER_11', '', 'Account number', 'Номер учетной записи (аккаунта) в DHL', 'setting_TEXT_BOX(0,true,', 10),
(368, 1, 'CONF_SHIPPING_DHL_SHIPPING_KEY_11', '', 'Domestic Shipping key', 'Введите Shipping Key, предоставленный Вам DHL', 'setting_TEXT_BOX(0,true,', 20),
(369, 1, 'CONF_SHIPPING_DHL_ISHIPPING_KEY_11', '', 'International Shipping key', 'Введите Shipping Key, предоставленный Вам DHL', 'setting_TEXT_BOX(0,true,', 20),
(370, 1, 'CONF_SHIPPING_DHL_DUTIABLE_11', '1', 'Подлежит обложению таможенной пошлиной', 'Только для международной доставки', 'setting_CHECK_BOX(', 0),
(371, 1, 'CONF_SHIPPING_DHL_BILLING_PARTY_11', 'S', 'Плательщик', 'Выбирите кто производит оплату услуг DHL - отправитель (Sender) или получатель (Receiver)', 'setting_SELECT_BOX(DHLShippingModule::_getBillingParties(),', 0),
(372, 1, 'CONF_SHIPPING_DHL_SHIPDATE_11', '', 'Отправление через X дней', 'Введите количество дней, по истечению которых с момента оформления заказа DHL должен забрать посылку', 'setting_TEXT_BOX(0,', 30),
(373, 1, 'CONF_SHIPPING_DHL_SHIPMENT_TYPE_11', 'P', 'Упаковка', 'Выберите способ упавковки посылок', 'setting_SELECT_BOX(DHLShippingModule::_getShipmentType(),', 40),
(374, 1, 'CONF_SHIPPING_DHL_DIMENSIONS_11', '', 'Габариты', 'Если габариты (размер) отправлений в Вашем интернет-магазине фиксированы, введите их значения в дюймах в формате LxWxH, где L, W, H - длина, ширина и высота соответственно.<br>Если размеры не фиксированы, оставьте это поле пустым', 'setting_TEXT_BOX(0,', 50),
(375, 1, 'CONF_SHIPPING_DHL_AP_11', '0', 'Страхование отправления', 'Включите, если Вы хотите, чтобы стоимость доставки расчитывалась с учетом стоимости страховки от ущерба и потери', 'setting_SELECT_BOX(DHLShippingModule::_getAPOptions(),', 0),
(376, 1, 'CONF_SHIPPING_DHL_AP_VALUE_11', '0;0', 'Размер суммы страхования', 'Если Вы выбрали страхование отправления, введите размер суммы страхования', 'DHLShippingModule::_setting_AP_VALUE(11,', 0),
(377, 1, 'CONF_SHIPPING_DHL_COD_11', '-', 'Collect On Delivery', 'Если оплата заказов производится по факту получения (Collect On Delivery - COD), выбирите способ приема оплаты.<br>Если опция COD включена, плательщиком должен быть отправитель.<br>Если Вы используете COD, выбирите n/a.', 'setting_SELECT_BOX(DHLShippingModule::_getCODMethods(),', 0),
(378, 1, 'CONF_SHIPPING_DHL_USD_CURRENCY_11', '', 'Валюта "Доллары США"', 'Стоимость доставки, расчитываемая DHL, указывается в долларах США. Выберите валюту Вашего магазина, которая представляет собой доллары США для корректного пересчета стоимости доставки в другие валюты.', 'setting_CURRENCY_SELECT(', 0),
(379, 1, 'CONF_SHIPPING_DHL_SERVICES_11', '', 'Доступные сервисы', 'Выберите сервисы DHL, которые будут предложены покупателю для выбора при оформлении заказа', 'setting_CHECKBOX_LIST(DHLShippingModule::_getServices(),', 6),
(380, 1, 'CONF_SHIPPING_FEDEX_TESTMODE_11', '1', 'Тестовый режим', '', 'setting_CHECK_BOX(', 10),
(381, 1, 'CONF_SHIPPING_FEDEX_ACCOUNT_NUMBER_11', '', 'Account number', 'Номер учетной записи (аккаунта) в FedEx', 'setting_TEXT_BOX(0,true,', 10),
(382, 1, 'CONF_SHIPPING_FEDEX_METER_NUMBER_11', '', 'Meter number', 'Если у Вас нет Meter number, оставьте это поле пустым. Meter number будет сгенерирован автоматически.', 'setting_TEXT_BOX(0,true,', 20),
(383, 1, 'CONF_SHIPPING_FEDEX_PACKAGING_11', '01', 'Упаковка', 'В случае, если Вы используете ''FedEx Ground'' необходимо выбрать ''Your packaging''', 'setting_SELECT_BOX(fedexShippingModule::_getPackagingTypes(),', 40),
(384, 1, 'CONF_SHIPPING_FEDEX_CARRIER_11', 'FDXE', 'Сервис', 'Выберите сервис FedEx', 'setting_SELECT_BOX(array(array("title"=>"All","value"=>"ALL"),array("title"=>"FedEx Express","value"=>"FDXE"), array("title"=>"FedEx Ground", "value"=>"FDXG")),', 50),
(385, 1, 'CONF_SHIPPING_FEDEX_CURRENCY_11', '', 'Валюта "Доллары США"', 'Стоимость доставки, расчитываемая FedEx, указывается в долларах США. Выберите валюту Вашего магазина, которая представляет собой доллары США для корректного пересчета стоимости доставки в другие валюты.', 'setting_CURRENCY_SELECT(', 55),
(386, 1, 'CONF_SHIPPING_FEDEX_COUNTRY_CODE_11', '176', 'Страна отправитея', 'Укажите страну отправления заказов.', 'setting_COUNTRY_SELECT(true,', 60),
(387, 1, 'CONF_SHIPPING_FEDEX_POSTAL_CODE_11', '', 'Почтовый код (индекс, ZIP-код) отправителя', 'Обязательное поле, если страна отправления США или Канада<br />\r\n	Укажите почтоый индекс места отправления заказов.', 'setting_TEXT_BOX(0,', 70),
(388, 1, 'CONF_SHIPPING_FEDEX_STATE_OR_PROVINCE_CODE_11', '186', 'Штат/провинция отправителя', 'Обязательное поле, если страна отправления США или Канада<br />\r\n	Введите название штата/провинции, из которой Вы отправляете заказы.', 'setting_ZONE_SELECT(CONF_SHIPPING_FEDEX_COUNTRY_CODE_11,', 80),
(389, 1, 'CONF_SHIPPING_FEDEX_CITY_11', '', 'Город', 'Информация необходима для формирования Meter number', 'setting_TEXT_BOX(0,', 90),
(390, 1, 'CONF_SHIPPING_FEDEX_ADDRESS_11', '', 'Адрес', 'Введите Ваш адрес<br />\r\n	Информация необходима для формирования Meter number', 'setting_TEXT_BOX(0,', 100),
(391, 1, 'CONF_SHIPPING_FEDEX_PHONE_NUMBER_11', '', 'Номер телефона', '111-222-3333<br />\r\n	Информация необходима для формирования Meter number', 'setting_TEXT_BOX(0,', 110),
(392, 1, 'CONF_SHIPPING_FEDEX_NAME_11', '', 'Ваше имя', 'Информация необходима для формирования Meter number', 'setting_TEXT_BOX(0,', 120),
(393, 1, 'CONF_SHIPPING_FEDEX_ENABLE_ERROR_LOG_11', '', 'Включить запись ошибочных ответов сервера FedEx', 'В случае ошибки расчета стоимости доставки, сообщение об ошибке записывается в файл temp/fedex_errors.log', 'setting_CHECK_BOX(', 130),
(394, 1, 'CONF_INTERSHIPPER_USERNAME_11', '', 'Имя пользователя в системе InterShipper', 'Введите информацию о Вашей учетной записи в InterShipper', 'setting_TEXT_BOX(0,true,', 0),
(395, 1, 'CONF_INTERSHIPPER_PASSWORD_11', '', 'Пароль для учетной записи  в системе InterShipper', 'Введите информацию о Вашей учетной записи в InterShipper', 'setting_TEXT_BOX(0,true,', 0),
(396, 1, 'CONF_INTERSHIPPER_CARRIERS_11', '', 'Компании-перевозчики', 'Отметьте галочками те компании, услугами которых Вы пользуетесь. Стоимость доставки будет посылки будет расчитываться через каждую из выбранных компаний.', 'InterShipperModule::settingCarriers(11,', 0),
(397, 1, 'CONF_INTERSHIPPER_CLASSES_11', '', 'Типы доставки', 'Отметьте предлагаемые пользователю типы (классы) доставки', 'setting_CHECKBOX_LIST(InterShipperModule::getClasses4List(),', 0),
(398, 1, 'CONF_INTERSHIPPER_SHIPMETHOD_11', 'DRP', 'Как посылка попадет к доставляющей компании', 'Выберите способ доставки отправлений к компании-перевозчику', 'InterShipperModule::settingShipMethod(', 0),
(399, 1, 'CONF_INTERSHIPPER_SHMOPTION_11', '', 'Дополнительная информация к способу получения посылки компанией доставки', 'Укажите дополнительную информацию в зависимости от выбранного способа доставки отправления перевозчику', 'InterShipperModule::settingSHMOption(CONF_INTERSHIPPER_SHIPMETHOD_11,', 0),
(400, 1, 'CONF_INTERSHIPPER_PACKAGING_11', 'BOX', 'Упаковка', 'Выберите способ упаковки отправлений (посылок)', 'setting_SELECT_BOX(InterShipperModule::getPackaging4Select(),', 0),
(401, 1, 'CONF_INTERSHIPPER_CONTENTS_11', 'OTR', 'Содержимое посылок', 'Охарактеризуйте вид отправляемых товаров', 'setting_SELECT_BOX(InterShipperModule::getContents4Select(),', 0),
(402, 1, 'CONF_INTERSHIPPER_INSURANCE_11', '', 'Страховка посылок', 'Введите процент от стоимости заказа (пример: 10%), точную сумму (пример: 15.96) или оставьте поле пустым, если страховка не нужна', 'InterShipperModule::settingInsurance(', 0),
(403, 1, 'CONF_INTERSHIPPER_USD_11', '', 'Валюта "Доллары США"', 'Стоимость доставки, расчитываемая сервером InterShipper, указывается в долларах США. Выберите валюту Вашего магазина, которая представляет собой доллары США для корректного пересчета стоимости доставки в другие валюты.', 'setting_CURRENCY_SELECT(', 0),
(404, 1, 'CONF_INTERSHIPPER_COUNTRY_11', '176', 'Страна отправителя', 'InterShipper расчитывает стоимость доставки только для отправлений с территории США. Выберите США в списке стран', 'setting_COUNTRY_SELECT(true,', 0),
(405, 1, 'CONF_INTERSHIPPER_POSTAL_11', '', 'Почтовый код (индекс, ZIP-код) отправителя', 'Укажите почтовый индекс (zip) места отправления заказов', 'setting_TEXT_BOX(0,', 0),
(406, 1, 'CONF_INTERSHIPPER_STATE_11', '', 'Штат/провинция отправителя', 'Укажите штат/провинцию, из которой отправляются заказы', 'setting_ZONE_SELECT(CONF_INTERSHIPPER_COUNTRY_11, array("mode"=>"notdef"),', 0),
(407, 1, 'CONF_INTERSHIPPER_CITY_11', '', 'Город', 'Введите название города, из которого будут производиться отправления', 'setting_TEXT_BOX(0,', 0),
(408, 1, 'CONF_RUSSIANPOST_CURRENCY_11', '', 'Валюта - Рубли', 'Выберите валюту Вашего магазина, которая представляет собой рубли. Это необходимо для корректного пересчета стоимости доставки в другие валюты.', 'setting_CURRENCY_SELECT(', 10),
(409, 1, 'CONF_RUSSIANPOST_COUNTRY_11', '176', 'Страна - Россия', 'Пожалуйста, выбрите страну, в для которой Вы хотите настроить модуль Почты России. Данный модуль будет работать только для выбранной страны.', 'setting_COUNTRY_SELECT(true,', 20),
(410, 1, 'CONF_RUSSIANPOST_ZONES_11', '', 'Распределите области, определенные в Вашем магазине, по тарифным поясам', '', 'RussianPost::settingZones(11, "CONF_RUSSIANPOST_COUNTRY_11")', 30),
(411, 1, 'CONF_RUSSIANPOST_AIR_11', '93.00', 'Надбавка за отправление ''Авиа''', 'Укажите стоимость в рублях', 'setting_TEXT_BOX(0,', 40),
(412, 1, 'CONF_RUSSIANPOST_CAUTION_11', '', 'Все посылки отправляются с отметкой "Осторожно"', '', 'setting_CHECK_BOX(', 50),
(413, 1, 'CONF_RUSSIANPOST_MAX_WEIGHT_11', '20', 'Максимальный вес отправления', 'Укажите вес в килограммах', 'setting_TEXT_BOX(0,', 60),
(414, 1, 'CONF_RUSSIANPOST_DIFFICULT_WEIGHT_11', '10', 'Вес усложненной тарификации', 'Укажите вес усложненной тарификации в килограммах (вес, начиная с которого к стоимости доставки посылки прибавляется 30%)', 'setting_TEXT_BOX(0,', 70),
(415, 1, 'CONF_RUSSIANPOST_COMMISION_11', '3', 'Плата за сумму объявленной ценности посылки', 'В процентах. Например, укажите 3%, если с каждого рубля взимается 3 копейки.', 'setting_TEXT_BOX(0,', 80),
(416, 1, 'CONF_RUSSIANPOST_HALFCOST_1_11', '53.45', 'Стоимость отправки посылки весом до 0.5 килограмм (включительно)', 'Укажите стоимость в рублях', 'RussianPost::settingHalfCosts(0,', 90),
(417, 1, 'CONF_RUSSIANPOST_HALFCOST_2_11', '58.9', 'Стоимость отправки посылки весом до 0.5 килограмм (включительно)', 'Укажите стоимость в рублях', 'RussianPost::settingHalfCosts(0,', 90),
(418, 1, 'CONF_RUSSIANPOST_HALFCOST_3_11', '77.4', 'Стоимость отправки посылки весом до 0.5 килограмм (включительно)', 'Укажите стоимость в рублях', 'RussianPost::settingHalfCosts(0,', 90),
(419, 1, 'CONF_RUSSIANPOST_HALFCOST_4_11', '103.55', 'Стоимость отправки посылки весом до 0.5 килограмм (включительно)', 'Укажите стоимость в рублях', 'RussianPost::settingHalfCosts(0,', 90),
(420, 1, 'CONF_RUSSIANPOST_HALFCOST_5_11', '116.65', 'Стоимость отправки посылки весом до 0.5 килограмм (включительно)', 'Укажите стоимость в рублях', 'RussianPost::settingHalfCosts(0,', 90),
(421, 1, 'CONF_RUSSIANPOST_OVERHALFCOST_1_11', '4.4', 'Стоимость отправки каждых дополнительных 0.5 килограмм', 'Укажите стоимость в рублях', 'RussianPost::settingHalfCosts(1,', 100),
(422, 1, 'CONF_RUSSIANPOST_OVERHALFCOST_2_11', '4.7', 'Стоимость отправки каждых дополнительных 0.5 килограмм', 'Укажите стоимость в рублях', 'RussianPost::settingHalfCosts(1,', 100),
(423, 1, 'CONF_RUSSIANPOST_OVERHALFCOST_3_11', '5.9', 'Стоимость отправки каждых дополнительных 0.5 килограмм', 'Укажите стоимость в рублях', 'RussianPost::settingHalfCosts(1,', 100),
(424, 1, 'CONF_RUSSIANPOST_OVERHALFCOST_4_11', '7.55', 'Стоимость отправки каждых дополнительных 0.5 килограмм', 'Укажите стоимость в рублях', 'RussianPost::settingHalfCosts(1,', 100),
(425, 1, 'CONF_RUSSIANPOST_OVERHALFCOST_5_11', '8.3', 'Стоимость отправки каждых дополнительных 0.5 килограмм', 'Укажите стоимость в рублях', 'RussianPost::settingHalfCosts(1,', 100),
(426, 1, 'CONF_SHIPPING_UPS_ACCESSLICENSENUMBER_11', '', '', '', '', 0),
(427, 1, 'CONF_SHIPPING_UPS_USERID_11', '', '', '', '', 0),
(428, 1, 'CONF_SHIPPING_UPS_PASSWORD_11', '', '', '', '', 0),
(429, 1, 'CONF_SHIPPING_UPS_SHIPPER_COUNTRY_ID_11', '', '', '', '', 0),
(430, 1, 'CONF_SHIPPING_UPS_SHIPPER_CITY_11', '', '', '', '', 0),
(431, 1, 'CONF_SHIPPING_UPS_SHIPPER_POSTALCODE_11', '', '', '', '', 0),
(432, 1, 'CONF_SHIPPING_UPS_PICKUP_TYPE_11', '', '', '', '', 0),
(433, 1, 'CONF_SHIPPING_UPS_CUSTOMER_CLASSIFICATION_11', '', '', '', '', 0),
(434, 1, 'CONF_SHIPPING_UPS_PACKAGE_TYPE_11', '', '', '', '', 0),
(435, 1, 'CONF_SHIPPING_UPS_ENABLE_ERROR_LOG_11', '', '', '', '', 0),
(436, 1, 'CONF_SHIPPING_UPS_USD_CURRENCY_11', '', '', '', '', 0),
(437, 1, 'CONF_SHIPPING_USPS_USERID_11', '', '', '', '', 0),
(438, 1, 'CONF_SHIPPING_USPS_ZIPORIGINATION_11', '', '', '', '', 0),
(439, 1, 'CONF_SHIPPING_USPS_PACKAGESIZE_11', '', '', '', '', 0),
(440, 1, 'CONF_SHIPPING_USPS_MACHINABLE_11', '', '', '', '', 0),
(441, 1, 'CONF_SHIPPING_USPS_DOMESTIC_SERVS_11', '', '', '', '', 0),
(442, 1, 'CONF_SHIPPING_USPS_INTERNATIONAL_SERVS_11', '', '', '', '', 0),
(443, 1, 'CONF_SHIPPING_USPS_ENABLE_ERROR_LOG_11', '', '', '', '', 0),
(444, 1, 'CONF_SHIPPING_USPS_USD_CURRENCY_11', '', '', '', '', 0),
(445, 1, 'CONF_SHIPPING_MODULE_FIXEDRATE_SHIPPINGRATE_11', '', '', '', '', 0),
(446, 1, 'CONF_SHIPPING_MODULE_FIXEDRATEPLUSPERCENT_FIXEDRATE_11', '', '', '', '', 0),
(447, 1, 'CONF_SHIPPING_MODULE_FIXEDRATEPLUSPERCENT_PERCENT_11', '', '', '', '', 0),
(448, 1, 'CONF_SHIPPING_MODULE_FIXEDRATEXORPERCENT_FIXEDRATE_11', '', '', '', '', 0),
(449, 1, 'CONF_SHIPPING_MODULE_FIXEDRATEXORPERCENT_PERCENT_11', '', '', '', '', 0),
(450, 1, 'CONF_SHIPPING_MODULE_BYCOUNTRYBYZONE_IS_INSTALLED_11', '1', 'Настройка стоимости', '', 'settingCONF_BYCOUNTRY_BYZONE_FORM(11)', 1),
(451, 1, 'CONF_SHIPPING_MODULE_BYCOUNTRYBYZONEPERCENT_IS_INSTALLED_11', '1', 'Настройка стоимости доставки', 'Здесь вы можете указать стоимость доставки как % от суммы заказа отдельно для каждой страны и области', 'settingCONF_BYCOUNTRY_BYZONE_PERCENT_FORM(11)', 1),
(452, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_CURRENCY_15', '0', 'Валюта квитанции', 'Выберите валюту, в которой будет указываться сумма в квитанции. Если тип вылюты не определен, то квитанция будет выписываться в той валюте, которая выбрана пользователем при оформлении заказа', 'setting_CURRENCY_SELECT(', 1),
(453, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_DESCRIPTION_15', 'Оплата заказа №[orderID]', 'Описание покупки', 'Укажите описание платежей. Вы можете использовать строку <i>[orderID]</i> - она автоматически будет заменена на номер заказа', 'setting_TEXT_BOX(0,', 1),
(454, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_EMAIL_HTML_INVOICE_15', '1', 'Отправлять покупателю HTML-квитанцию', 'Включите эту опцию, если хотите, чтобы покупателю автоматически отправлялась квитанция в HTML-формате. Если опция выключена, то покупателю будет отправлена ссылка на квитанцию на сайте магазина', 'setting_CHECK_BOX(', 1),
(455, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_COMPANYNAME_15', '', 'Название компании', 'Укажите название организации, от имени которой выписывается квитанция', 'setting_TEXT_BOX(0,', 1),
(456, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_BANK_ACCOUNT_NUMBER_15', '', 'Расчетный счет', 'Номер расчетного счета организации', 'setting_TEXT_BOX(0,', 1),
(457, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_INN_15', '', 'ИНН', 'ИНН организации', 'setting_TEXT_BOX(0,', 1),
(458, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_KPP_15', '', 'КПП', '', 'setting_TEXT_BOX(0,', 1),
(459, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_BANKNAME_15', '', 'Наименование банка', '', 'setting_TEXT_BOX(0,', 1),
(460, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_BANK_KOR_NUMBER_15', '', 'Корреспондентский счет', '', 'setting_TEXT_BOX(0,', 1),
(461, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_BIK_15', '', 'БИК', '', 'setting_TEXT_BOX(0,', 1),
(462, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_SECOND_NAME_15', '', 'Отчество', 'Выберите из списка поле в форме регистрации отвечающее за отчество покупателя — одно из полей, которое можно добавить в разделе Настройки &raquo; Форма регистрации и оформления заказов', 'setting_SELECT_BOX(CInvoicePhys::_getCustomerFields(),', 1),
(466, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_CURRENCY_18', '0', 'Валюта квитанции', 'Выберите валюту, в которой будет указываться сумма в квитанции. Если тип вылюты не определен, то квитанция будет выписываться в той валюте, которая выбрана пользователем при оформлении заказа', 'setting_CURRENCY_SELECT(', 1),
(465, 1, 'CONF_PAYMENTMODULE_PAYPAL_TRANSCURR_16', '3', 'Доллары США', 'Сумма заказа, передаваемая в PayPal, указывается в долларах США. Выберите валюту из списка, которая представляет собой доллары США - это необходимо для корректного пересчета суммы заказа в доллары. Если валюта не выбрана, сумма не будет пересчитываться.', 'setting_CURRENCY_SELECT(', 0),
(467, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_DESCRIPTION_18', 'Оплата заказа №[orderID]', 'Описание покупки', 'Укажите описание платежей. Вы можете использовать строку <i>[orderID]</i> - она автоматически будет заменена на номер заказа', 'setting_TEXT_BOX(0,', 1),
(468, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_EMAIL_HTML_INVOICE_18', '1', 'Отправлять покупателю HTML-квитанцию', 'Включите эту опцию, если хотите, чтобы покупателю автоматически отправлялась квитанция в HTML-формате. Если опция выключена, то покупателю будет отправлена ссылка на квитанцию на сайте магазина', 'setting_CHECK_BOX(', 1),
(469, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_COMPANYNAME_18', '', 'Название компании', 'Укажите название организации, от имени которой выписывается квитанция', 'setting_TEXT_BOX(0,', 1),
(470, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_BANK_ACCOUNT_NUMBER_18', '', 'Расчетный счет', 'Номер расчетного счета организации', 'setting_TEXT_BOX(0,', 1),
(471, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_INN_18', '', 'ИНН', 'ИНН организации', 'setting_TEXT_BOX(0,', 1),
(472, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_KPP_18', '', 'КПП', '', 'setting_TEXT_BOX(0,', 1),
(473, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_BANKNAME_18', '', 'Наименование банка', '', 'setting_TEXT_BOX(0,', 1),
(474, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_BANK_KOR_NUMBER_18', '', 'Корреспондентский счет', '', 'setting_TEXT_BOX(0,', 1),
(475, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_BIK_18', '', 'БИК', '', 'setting_TEXT_BOX(0,', 1),
(476, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_SECOND_NAME_18', '', 'Отчество', 'Выберите из списка поле в форме регистрации отвечающее за отчество покупателя — одно из полей, которое можно добавить в разделе Настройки &raquo; Форма регистрации и оформления заказов', 'setting_SELECT_BOX(CInvoicePhys::_getCustomerFields(),', 1),
(477, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_CURRENCY_19', '3', 'Валюта квитанции', 'Выберите валюту, в которой будет указываться сумма в квитанции. Если тип вылюты не определен, то квитанция будет выписываться в той валюте, которая выбрана пользователем при оформлении заказа', 'setting_CURRENCY_SELECT(', 1),
(478, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_DESCRIPTION_19', 'Оплата заказа №[orderID]', 'Описание покупки', 'Укажите описание платежей. Вы можете использовать строку <i>[orderID]</i> - она автоматически будет заменена на номер заказа', 'setting_TEXT_BOX(0,', 1),
(479, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_EMAIL_HTML_INVOICE_19', '1', 'Отправлять покупателю HTML-квитанцию', 'Включите эту опцию, если хотите, чтобы покупателю автоматически отправлялась квитанция в HTML-формате. Если опция выключена, то покупателю будет отправлена ссылка на квитанцию на сайте магазина', 'setting_CHECK_BOX(', 1),
(480, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_COMPANYNAME_19', '123test', 'Название компании', 'Укажите название организации, от имени которой выписывается квитанция', 'setting_TEXT_BOX(0,', 1),
(481, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_BANK_ACCOUNT_NUMBER_19', '123test', 'Расчетный счет', 'Номер расчетного счета организации', 'setting_TEXT_BOX(0,', 1),
(482, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_INN_19', '123test', 'ИНН', 'ИНН организации', 'setting_TEXT_BOX(0,', 1),
(483, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_KPP_19', '123test', 'КПП', '', 'setting_TEXT_BOX(0,', 1),
(484, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_BANKNAME_19', '123test', 'Наименование банка', '', 'setting_TEXT_BOX(0,', 1),
(485, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_BANK_KOR_NUMBER_19', '123test', 'Корреспондентский счет', '', 'setting_TEXT_BOX(0,', 1),
(486, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_BIK_19', '123test', 'БИК', '', 'setting_TEXT_BOX(0,', 1),
(487, 1, 'CONF_PAYMENTMODULE_INVOICE_PHYS_SECOND_NAME_19', '0', 'Отчество', 'Выберите из списка поле в форме регистрации отвечающее за отчество покупателя — одно из полей, которое можно добавить в разделе Настройки &raquo; Форма регистрации и оформления заказов', 'setting_SELECT_BOX(CInvoicePhys::_getCustomerFields(),', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `SC_settings_groups`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_settings_groups`;
CREATE TABLE IF NOT EXISTS `SC_settings_groups` (
  `settings_groupID` int(11) NOT NULL,
  `settings_group_name` varchar(64) DEFAULT NULL,
  `sort_order` int(11) DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_settings_groups`
--

INSERT INTO `SC_settings_groups` (`settings_groupID`, `settings_group_name`, `sort_order`) VALUES
(1, 'MODULES', 0),
(2, 'cfg_grp_general', 1),
(7, 'Google Analytics', 6),
(4, 'cfg_grp_catalog', 3),
(5, 'cfg_grp_customers', 4),
(6, 'cfg_grp_cart_ordering', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `SC_shipping_methods`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_shipping_methods`;
CREATE TABLE IF NOT EXISTS `SC_shipping_methods` (
  `SID` int(11) NOT NULL,
  `Enabled` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `sort_order` int(11) DEFAULT '0',
  `Name_ru` varchar(30) DEFAULT NULL,
  `description_ru` varchar(255) DEFAULT NULL,
  `email_comments_text_ru` text,
  `logo` text
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_shipping_methods`
--

INSERT INTO `SC_shipping_methods` (`SID`, `Enabled`, `module_id`, `sort_order`, `Name_ru`, `description_ru`, `email_comments_text_ru`, `logo`) VALUES
(6, 0, 9, 1, 'Самовывоз', 'Вы можете забрать товар из нашего офиса.', '', ''),
(7, 1, 11, 0, 'Курьер', 'Доставка осуществляется нашим курьером.', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `SC_shopping_carts`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_shopping_carts`;
CREATE TABLE IF NOT EXISTS `SC_shopping_carts` (
  `customerID` int(11) NOT NULL DEFAULT '0',
  `itemID` int(11) NOT NULL DEFAULT '0',
  `Quantity` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `SC_shopping_cart_items`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Авг 24 2015 г., 13:09
--

DROP TABLE IF EXISTS `SC_shopping_cart_items`;
CREATE TABLE IF NOT EXISTS `SC_shopping_cart_items` (
  `itemID` int(11) NOT NULL,
  `productID` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=141 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_shopping_cart_items`
--

INSERT INTO `SC_shopping_cart_items` (`itemID`, `productID`) VALUES
(1, NULL),
(2, NULL),
(3, NULL),
(4, NULL),
(5, NULL),
(6, NULL),
(7, NULL),
(8, NULL),
(9, NULL),
(10, NULL),
(11, NULL),
(12, NULL),
(13, NULL),
(14, NULL),
(15, NULL),
(16, NULL),
(17, 854),
(18, 883),
(19, 883),
(20, 857),
(21, 847),
(22, 878),
(23, 872),
(24, 872),
(25, 877),
(26, 887),
(27, 886),
(28, 889),
(29, 865),
(30, 871),
(31, 871),
(32, 894),
(33, 870),
(34, 891),
(36, 860),
(37, 860),
(38, 859),
(39, 859),
(40, 880),
(41, 883),
(42, 886),
(43, 890),
(44, 890),
(45, 877),
(46, 873),
(47, 864),
(48, 883),
(49, 891),
(50, 877),
(51, 868),
(52, 892),
(53, 865),
(54, 872),
(55, 864),
(56, 864),
(57, 864),
(58, 868),
(59, 851),
(62, 892),
(63, 850),
(64, 869),
(65, 884),
(66, 884),
(67, 881),
(68, 869),
(69, 847),
(70, 856),
(71, 869),
(72, 847),
(73, 856),
(74, 878),
(75, 884),
(76, 868),
(77, 892),
(78, 875),
(79, 876),
(80, 857),
(81, 904),
(82, 894),
(83, 870),
(84, 881),
(85, 895),
(86, 891),
(87, 872),
(88, 852),
(89, 849),
(90, 851),
(91, 871),
(92, 892),
(93, 871),
(94, 892),
(95, 888),
(96, 870),
(97, 906),
(98, 886),
(99, 888),
(100, 868),
(101, 896),
(102, 884),
(103, 905),
(104, 868),
(105, 871),
(106, 860),
(107, 884),
(108, 854),
(109, 884),
(110, 888),
(111, 858),
(112, 858),
(113, 888),
(114, 847),
(115, 891),
(116, 846),
(117, 846),
(118, 856),
(119, 903),
(120, 901),
(121, 894),
(122, 894),
(123, 871),
(124, 892),
(125, 858),
(126, 867),
(127, 889),
(128, 867),
(129, 857),
(130, 891),
(131, 871),
(132, 891),
(133, 894),
(134, 892),
(135, 869),
(136, 883),
(137, 870),
(138, 894),
(139, 892),
(140, 884);

-- --------------------------------------------------------

--
-- Структура таблицы `SC_shopping_cart_items_content`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_shopping_cart_items_content`;
CREATE TABLE IF NOT EXISTS `SC_shopping_cart_items_content` (
  `itemID` int(11) NOT NULL DEFAULT '0',
  `variantID` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_shopping_cart_items_content`
--

INSERT INTO `SC_shopping_cart_items_content` (`itemID`, `variantID`) VALUES
(36, 106),
(38, 105),
(68, 107),
(69, 107),
(70, 107),
(91, 108),
(111, 109);

-- --------------------------------------------------------

--
-- Структура таблицы `SC_spmodules`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_spmodules`;
CREATE TABLE IF NOT EXISTS `SC_spmodules` (
  `module_id` int(11) NOT NULL,
  `module_type` int(11) DEFAULT NULL,
  `module_name` varchar(255) DEFAULT NULL,
  `ModuleClassName` varchar(255) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_spmodules`
--

INSERT INTO `SC_spmodules` (`module_id`, `module_type`, `module_name`, `ModuleClassName`) VALUES
(1, NULL, 'SMS-Уведомления', 'SMSNotify'),
(2, NULL, 'Clickatell', 'Clickatell'),
(3, NULL, 'SMS Driver', 'SMSDriverCom'),
(4, NULL, 'SMS traffic', 'SMSTrafficRu'),
(5, NULL, 'Вконтакте', 'VKontaktePayment'),
(6, NULL, 'Фейсбук', 'FacebookPayment'),
(7, 2, 'Google Checkout', 'GoogleCheckout2'),
(8, NULL, 'PayPal Website Payments Pro - Express Checkout', 'PPExpressCheckout'),
(9, 4, 'RussianpostLabel113', 'RussianpostLabel113'),
(10, 4, 'ConsignmentNote', 'ConsignmentNote'),
(11, 4, 'Invoice', 'Invoice'),
(12, 4, 'SalesInvoice', 'SalesInvoice'),
(13, 4, 'ShippingSummary', 'ShippingSummary'),
(14, 4, 'RussianpostLabel116', 'RussianpostLabel116'),
(15, NULL, 'Квитанция', 'CInvoicePhys'),
(18, NULL, 'Квитанция', 'CInvoicePhys'),
(19, NULL, 'Квитанция', 'CInvoicePhys');

-- --------------------------------------------------------

--
-- Структура таблицы `SC_spmodules_settings`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_spmodules_settings`;
CREATE TABLE IF NOT EXISTS `SC_spmodules_settings` (
  `module_id` int(11) NOT NULL,
  `field` varchar(255) NOT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_spmodules_settings`
--

INSERT INTO `SC_spmodules_settings` (`module_id`, `field`, `value`) VALUES
(9, 'COMPANY_NAME', 'DANCELIFE'),
(9, 'ADDRESS1', ''),
(9, 'ADDRESS2', ''),
(9, 'POST_CODE', ''),
(9, 'INN', ''),
(9, 'BANK_KOR_NUMBER', ''),
(9, 'BANK_NAME', ''),
(9, 'BANK_ACCOUNT_NUMBER', ''),
(9, 'BIK', ''),
(9, 'COLOR', '1'),
(10, 'CURRENCY', '0'),
(10, 'NDS', '0'),
(10, 'NDS_IS_INCLUDED_IN_PRICE', '1'),
(10, 'COMPANYNAME', ''),
(10, 'COMPANYADDRESS', ''),
(10, 'COMPANYPHONE', ''),
(10, 'CEO_NAME', ''),
(10, 'BUH_NAME', ''),
(10, 'BANK_ACCOUNT_NUMBER', ''),
(10, 'INN', ''),
(10, 'KPP', ''),
(10, 'BANKNAME', ''),
(10, 'BANK_KOR_NUMBER', ''),
(10, 'BIK', ''),
(10, 'CUSTOMER_COMPANY_FIELD', ''),
(10, 'CUSTOMER_PHONE_FIELD', ''),
(11, 'COMPANYNAME', ''),
(11, 'COMPANYADDRESS', ''),
(11, 'COMPANYPHONE', ''),
(11, 'CUSTOMER_COMPANY_FIELD', ''),
(12, 'CURRENCY', '0'),
(12, 'NDS', '0'),
(12, 'NDS_IS_INCLUDED_IN_PRICE', '1'),
(12, 'COMPANYNAME', ''),
(12, 'COMPANYADDRESS', ''),
(12, 'COMPANYPHONE', ''),
(12, 'CEO_NAME', ''),
(12, 'BUH_NAME', ''),
(12, 'IP_NAME', ''),
(12, 'IP_REGISTRATION', ''),
(12, 'BANK_ACCOUNT_NUMBER', ''),
(12, 'INN', ''),
(12, 'KPP', ''),
(12, 'BANKNAME', ''),
(12, 'BANK_KOR_NUMBER', ''),
(12, 'BIK', ''),
(12, 'CUSTOMER_COMPANY_FIELD', ''),
(12, 'CUSTOMER_PHONE_FIELD', ''),
(12, 'CUSTOMER_INN_FIELD', ''),
(12, 'CUSTOMER_KPP_FIELD', ''),
(14, 'COMPANY_NAME', ''),
(14, 'ADDRESS1', ''),
(14, 'ADDRESS2', ''),
(14, 'POST_CODE', '');

-- --------------------------------------------------------

--
-- Структура таблицы `SC_subscribers`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Авг 05 2015 г., 10:39
--

DROP TABLE IF EXISTS `SC_subscribers`;
CREATE TABLE IF NOT EXISTS `SC_subscribers` (
  `MID` int(11) NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `customerID` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_subscribers`
--

INSERT INTO `SC_subscribers` (`MID`, `Email`, `customerID`) VALUES
(2, 'sovazh@yahoo.com', NULL),
(3, 'ekaterina.serzha@mail.ru', NULL),
(4, 'dancer729@gmail.com', NULL),
(5, 'Mes2006.79@mail.ru', NULL),
(6, 'guees777@mail.ru', NULL),
(7, 'lizashrei@pochta.ru', NULL),
(8, 'alena_alkina@mail.ru', 17),
(9, 'vlasova12345@yandex.ru', 18),
(10, 'oseychuk@rambler.ru', NULL),
(11, 'egradova@yandex.ru', NULL),
(12, 'Shmonin_Alex@rambler.ru', NULL),
(13, 'svetlana_knyagin@mail.ru', NULL),
(14, 'Katya_sa@mail.ru', NULL),
(15, 'oks.shegol@mail.ru', 31),
(16, 'Inna1978205@rambler.ru', NULL),
(17, 'galk.anastasija@rambler.ru', NULL),
(18, 'fetalina@mail.ru', NULL),
(19, 'yanamin@yandex.ru', NULL),
(20, 'Svetlana_levantavskaya@mail.ru', 38),
(21, 'm.tanaeva@mail.ru', NULL),
(22, 'jolly-5@yandex.ru', 26),
(23, 'Prowotorowa.galina2010@yandex.ru', NULL),
(24, 'Batishcheva_natal@mail.ru', NULL),
(25, 'ok.browkina@yandex.ru', 49),
(26, 'Lenad72@mail.ru', NULL),
(27, 'Sestruccho@gmail.com', NULL),
(28, 'Kuznezma@mail.ri', NULL),
(29, 'imagemaxinfo@gmail.com', NULL),
(30, 'ngmail@ya.ru', NULL),
(31, 'Ura-abushinov@yandex.ru', NULL),
(32, 'jew@gmx.de', NULL),
(33, 'olegss1@mail.ru', 24),
(34, 'petrova.cstc@yandex.ru', 54),
(35, 'n1604n@yandex.ru', NULL),
(36, 'nune.sogomonyan2012@yandex.ru', NULL),
(37, 'olga-0412@mail.ru', NULL),
(38, 'Vperkova@yandex.ru', NULL),
(39, 'kost47@yandex.ru', NULL),
(40, 'welcome@dancelife-ee.ru', 73),
(41, 'sabina.s.kh@gmail.com', NULL),
(42, 'Luzin@aerogeologia.ru', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `SC_system`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_system`;
CREATE TABLE IF NOT EXISTS `SC_system` (
  `varName` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_system`
--

INSERT INTO `SC_system` (`varName`, `value`) VALUES
('version_number', '2.0'),
('version_name', 'WASC');

-- --------------------------------------------------------

--
-- Структура таблицы `SC_tagged_objects`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_tagged_objects`;
CREATE TABLE IF NOT EXISTS `SC_tagged_objects` (
  `tag_id` int(10) unsigned NOT NULL DEFAULT '0',
  `object_id` int(10) unsigned NOT NULL DEFAULT '0',
  `object_type` enum('product') NOT NULL DEFAULT 'product',
  `language_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `SC_tags`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_tags`;
CREATE TABLE IF NOT EXISTS `SC_tags` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `SC_tax_classes`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_tax_classes`;
CREATE TABLE IF NOT EXISTS `SC_tax_classes` (
  `classID` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `address_type` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `SC_tax_rates`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_tax_rates`;
CREATE TABLE IF NOT EXISTS `SC_tax_rates` (
  `classID` int(11) NOT NULL DEFAULT '0',
  `countryID` int(11) NOT NULL DEFAULT '0',
  `isGrouped` tinyint(1) DEFAULT NULL,
  `value` float DEFAULT NULL,
  `isByZone` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `SC_tax_rates__zones`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_tax_rates__zones`;
CREATE TABLE IF NOT EXISTS `SC_tax_rates__zones` (
  `classID` int(11) NOT NULL DEFAULT '0',
  `zoneID` int(11) NOT NULL DEFAULT '0',
  `value` float DEFAULT NULL,
  `isGrouped` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `SC_tax_zip`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_tax_zip`;
CREATE TABLE IF NOT EXISTS `SC_tax_zip` (
  `tax_zipID` int(11) NOT NULL,
  `classID` int(11) DEFAULT NULL,
  `countryID` int(11) DEFAULT NULL,
  `zip_template` varchar(255) DEFAULT NULL,
  `value` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `SC_zones`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC_zones`;
CREATE TABLE IF NOT EXISTS `SC_zones` (
  `zoneID` int(11) NOT NULL,
  `zone_code` varchar(64) DEFAULT NULL,
  `countryID` int(11) DEFAULT NULL,
  `zone_name_ru` varchar(64) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=300 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC_zones`
--

INSERT INTO `SC_zones` (`zoneID`, `zone_code`, `countryID`, `zone_name_ru`) VALUES
(1, 'AL', 223, ''),
(2, 'AK', 223, ''),
(4, 'AZ', 223, ''),
(5, 'AR', 223, ''),
(12, 'CA', 223, ''),
(13, 'CO', 223, ''),
(14, 'CT', 223, ''),
(15, 'DE', 223, ''),
(16, 'DC', 223, ''),
(18, 'FL', 223, ''),
(19, 'GA', 223, ''),
(21, 'HI', 223, ''),
(22, 'ID', 223, ''),
(23, 'IL', 223, ''),
(24, 'IN', 223, ''),
(25, 'IA', 223, ''),
(26, 'KS', 223, ''),
(27, 'KY', 223, ''),
(28, 'LA', 223, ''),
(29, 'ME', 223, ''),
(186, '50', 176, ' Московская область'),
(31, 'MD', 223, ''),
(32, 'MA', 223, ''),
(33, 'MI', 223, ''),
(34, 'MN', 223, ''),
(35, 'MS', 223, ''),
(36, 'MO', 223, ''),
(37, 'MT', 223, ''),
(38, 'NE', 223, ''),
(39, 'NV', 223, ''),
(40, 'NH', 223, ''),
(41, 'NJ', 223, ''),
(42, 'NM', 223, ''),
(43, 'NY', 223, ''),
(44, 'NC', 223, ''),
(45, 'ND', 223, ''),
(47, 'OH', 223, ''),
(48, 'OK', 223, ''),
(49, 'OR', 223, ''),
(51, 'PA', 223, ''),
(53, 'RI', 223, ''),
(54, 'SC', 223, ''),
(55, 'SD', 223, ''),
(56, 'TN', 223, ''),
(57, 'TX', 223, ''),
(58, 'UT', 223, ''),
(59, 'VT', 223, ''),
(61, 'VA', 223, ''),
(62, 'WA', 223, ''),
(63, 'WV', 223, ''),
(64, 'WI', 223, ''),
(65, 'WY', 223, ''),
(66, 'AB', 38, NULL),
(67, 'BC', 38, NULL),
(68, 'MB', 38, NULL),
(69, 'NF', 38, NULL),
(70, 'NB', 38, NULL),
(71, 'NS', 38, NULL),
(72, 'NT', 38, NULL),
(73, 'NU', 38, NULL),
(74, 'ON', 38, NULL),
(75, 'PE', 38, NULL),
(76, 'QC', 38, NULL),
(77, 'SK', 38, NULL),
(78, 'YT', 38, NULL),
(79, 'NDS', 81, NULL),
(80, 'BAW', 81, NULL),
(81, 'BAY', 81, NULL),
(82, 'BER', 81, NULL),
(83, 'BRG', 81, NULL),
(84, 'BRE', 81, NULL),
(85, 'HAM', 81, NULL),
(86, 'HES', 81, NULL),
(87, 'MEC', 81, NULL),
(88, 'NRW', 81, NULL),
(89, 'RHE', 81, NULL),
(90, 'SAR', 81, NULL),
(91, 'SAS', 81, NULL),
(92, 'SAC', 81, NULL),
(93, 'SCN', 81, NULL),
(94, 'THE', 81, NULL),
(95, 'WI', 14, NULL),
(96, 'NO', 14, NULL),
(97, 'OO', 14, NULL),
(98, 'SB', 14, NULL),
(99, 'KN', 14, NULL),
(100, 'ST', 14, NULL),
(101, 'TI', 14, NULL),
(102, 'BL', 14, NULL),
(103, 'VB', 14, NULL),
(104, 'AG', 204, NULL),
(105, 'AI', 204, NULL),
(106, 'AR', 204, NULL),
(107, 'BE', 204, NULL),
(108, 'BL', 204, NULL),
(109, 'BS', 204, NULL),
(110, 'FR', 204, NULL),
(111, 'GE', 204, NULL),
(112, 'GL', 204, NULL),
(113, 'JU', 204, NULL),
(114, 'JU', 204, NULL),
(115, 'LU', 204, NULL),
(116, 'NE', 204, NULL),
(117, 'NW', 204, NULL),
(118, 'OW', 204, NULL),
(119, 'SG', 204, NULL),
(120, 'SH', 204, NULL),
(121, 'SO', 204, NULL),
(122, 'SZ', 204, NULL),
(123, 'TG', 204, NULL),
(124, 'TI', 204, NULL),
(125, 'UR', 204, NULL),
(126, 'VD', 204, NULL),
(127, 'VS', 204, NULL),
(128, 'ZG', 204, NULL),
(129, 'ZH', 204, NULL),
(130, 'A CoruСЃa', 195, NULL),
(131, 'Alava', 195, NULL),
(132, 'Albacete', 195, NULL),
(133, 'Alicante', 195, NULL),
(134, 'Almeria', 195, NULL),
(135, 'Asturias', 195, NULL),
(136, 'Avila', 195, NULL),
(137, 'Badajoz', 195, NULL),
(138, 'Baleares', 195, NULL),
(139, 'Barcelona', 195, NULL),
(140, 'Burgos', 195, NULL),
(141, 'Caceres', 195, NULL),
(142, 'Cadiz', 195, NULL),
(143, 'Cantabria', 195, NULL),
(144, 'Castellon', 195, NULL),
(145, 'Ceuta', 195, NULL),
(146, 'Ciudad Real', 195, NULL),
(147, 'Cordoba', 195, NULL),
(148, 'Cuenca', 195, NULL),
(149, 'Girona', 195, NULL),
(150, 'Granada', 195, NULL),
(151, 'Guadalajara', 195, NULL),
(152, 'Guipuzcoa', 195, NULL),
(153, 'Huelva', 195, NULL),
(154, 'Huesca', 195, NULL),
(155, 'Jaen', 195, NULL),
(156, 'La Rioja', 195, NULL),
(157, 'Las Palmas', 195, NULL),
(158, 'Leon', 195, NULL),
(159, 'Lleida', 195, NULL),
(160, 'Lugo', 195, NULL),
(161, 'Madrid', 195, NULL),
(162, 'Malaga', 195, NULL),
(163, 'Melilla', 195, NULL),
(164, 'Murcia', 195, NULL),
(165, 'Navarra', 195, NULL),
(166, 'Ourense', 195, NULL),
(167, 'Palencia', 195, NULL),
(168, 'Pontevedra', 195, NULL),
(169, 'Salamanca', 195, NULL),
(170, 'Santa Cruz de Tenerife', 195, NULL),
(171, 'Segovia', 195, NULL),
(172, 'Sevilla', 195, NULL),
(173, 'Soria', 195, NULL),
(174, 'Tarragona', 195, NULL),
(175, 'Teruel', 195, NULL),
(176, 'Toledo', 195, NULL),
(177, 'Valencia', 195, NULL),
(178, 'Valladolid', 195, NULL),
(179, 'Vizcaya', 195, NULL),
(180, 'Zamora', 195, NULL),
(181, 'Zaragoza', 195, NULL),
(188, '2', 176, 'Алтай'),
(187, '1', 176, 'Адыгея'),
(189, '3', 176, 'Башкортостан'),
(190, '4', 176, 'Бурятия'),
(191, '5', 176, 'Дагестан'),
(192, '6', 176, 'Ингушетия'),
(193, '7', 176, 'Кабардино-Балкария'),
(194, '8', 176, 'Калмыкия'),
(195, '9', 176, 'Карачаево-Черкессия'),
(196, '10', 176, 'Карелия'),
(197, '11', 176, 'Коми'),
(198, '12', 176, 'Марий-Эл'),
(199, '13', 176, 'Мордовия'),
(200, '14', 176, 'Саха (Якутия)'),
(201, '15', 176, 'Северная Осетия'),
(202, '16', 176, 'Татарстан'),
(203, '17', 176, 'Тыва (Тува)'),
(204, '18', 176, 'Удмуртия'),
(205, '19', 176, 'Хакасия'),
(206, '20', 176, 'Чечня'),
(207, '21', 176, 'Чувашия'),
(208, '22', 176, 'Алтайский край'),
(209, '41', 176, 'Камчатский край'),
(210, '23', 176, 'Краснодарский край'),
(211, '24', 176, 'Красноярский край'),
(212, '59', 176, 'Пермский край'),
(213, '25', 176, 'Приморский край'),
(214, '26', 176, 'Ставропольский край'),
(215, '27', 176, 'Хабаровский край'),
(216, '28', 176, 'Амурская область'),
(217, '29', 176, 'Архангельская область'),
(218, '30', 176, 'Астраханская область'),
(219, '31', 176, 'Белгородская область'),
(220, '32', 176, 'Брянская область'),
(221, '33', 176, 'Владимирская область'),
(222, '34', 176, 'Волгоградская область'),
(223, '35', 176, 'Вологодская область'),
(224, '36', 176, 'Воронежская область'),
(225, '37', 176, 'Ивановская область'),
(226, '38', 176, 'Иркутская область'),
(227, '39', 176, 'Калининградская область'),
(228, '40', 176, 'Калужская область'),
(229, '42', 176, 'Кемеровская область'),
(230, '43', 176, 'Кировская область'),
(231, '44', 176, 'Костромская область'),
(232, '45', 176, 'Курганская область'),
(233, '46', 176, 'Курская область'),
(234, '47', 176, 'Ленинградская область'),
(235, '48', 176, 'Липецкая область'),
(236, '49', 176, 'Магаданская область'),
(237, '51', 176, 'Мурманская область'),
(238, '52', 176, 'Нижегородская область'),
(239, '53', 176, 'Новгородская область'),
(240, '54', 176, 'Новосибирская область'),
(241, '55', 176, 'Омская область'),
(242, '56', 176, 'Оренбургская область'),
(243, '57', 176, 'Орловская область'),
(244, '58', 176, 'Пензенская область'),
(245, '60', 176, 'Псковская область'),
(246, '61', 176, 'Ростовская область'),
(247, '62', 176, 'Рязанская область'),
(248, '63', 176, 'Самарская область'),
(249, '64', 176, 'Саратовская область'),
(250, '65', 176, 'Сахалинская область'),
(251, '66', 176, 'Свердловская область'),
(252, '67', 176, 'Смоленская область'),
(253, '68', 176, 'Тамбовская область'),
(254, '69', 176, 'Тверская область'),
(255, '70', 176, 'Томская область'),
(256, '71', 176, 'Тульская область'),
(257, '72', 176, 'Тюменская область'),
(258, '73', 176, 'Ульяновская область'),
(259, '74', 176, 'Челябинская область'),
(260, '75', 176, 'Читинская область'),
(261, '76', 176, 'Ярославская область'),
(262, '80', 176, 'Агинский Бурятский АО'),
(263, '83', 176, 'Ненецкий АО'),
(264, '85', 176, 'Усть-Ордынский Бурятский АО'),
(265, '86', 176, 'Ханты-Мансийский АО'),
(266, '87', 176, 'Чукотский АО'),
(267, '89', 176, 'Ямало-Ненецкий АО'),
(268, '79', 176, 'Еврейская АО'),
(269, '', 220, 'АР Крым'),
(270, '', 220, 'Винницкая область'),
(271, '', 220, 'Волынская область'),
(272, '', 220, 'Днепропетровская область'),
(273, '', 220, 'Донецкая область'),
(274, '', 220, 'Житомирская область'),
(275, '', 220, 'Закарпатская область'),
(276, '', 220, 'Запорожская область'),
(277, '', 220, 'Ивано-Франковская область'),
(278, '', 220, 'Киевская область'),
(279, '', 220, 'Кировоградская область'),
(280, '', 220, 'Луганская область'),
(281, '', 220, 'Львовская область'),
(282, '', 220, 'Николаевская область'),
(283, '', 220, 'Одесская область'),
(284, '', 220, 'Полтавская область'),
(285, '', 220, 'Ровенская область'),
(286, '', 220, 'Сумская область'),
(287, '', 220, 'Тернопольская область'),
(288, '', 220, 'Харьковская область'),
(289, '', 220, 'Херсонская область'),
(290, '', 220, 'Хмельницкая область'),
(291, '', 220, 'Черкасская область'),
(292, '', 220, 'Черниговская область'),
(293, '', 220, 'Черновицкая область'),
(294, '', 20, 'Брестская область'),
(295, '', 20, 'Гомельская область'),
(296, '', 20, 'Гродненская область'),
(297, '', 20, 'Могилёвская область'),
(298, '', 20, 'Минская область'),
(299, '', 20, 'Витебская область');

-- --------------------------------------------------------

--
-- Структура таблицы `SC__courier_rates`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC__courier_rates`;
CREATE TABLE IF NOT EXISTS `SC__courier_rates` (
  `module_id` int(10) unsigned NOT NULL DEFAULT '0',
  `orderAmount` float DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `isPercent` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `SC__courier_rates2`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC__courier_rates2`;
CREATE TABLE IF NOT EXISTS `SC__courier_rates2` (
  `module_id` int(10) unsigned NOT NULL DEFAULT '0',
  `orderAmount` float DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `isPercent` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `SC__intershipper_carriers`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC__intershipper_carriers`;
CREATE TABLE IF NOT EXISTS `SC__intershipper_carriers` (
  `module_id` int(10) unsigned NOT NULL DEFAULT '0',
  `carrierID` int(11) DEFAULT NULL,
  `account` varchar(50) DEFAULT NULL,
  `invoiced` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `SC__module_payment_invoice_jur`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC__module_payment_invoice_jur`;
CREATE TABLE IF NOT EXISTS `SC__module_payment_invoice_jur` (
  `module_id` int(10) unsigned DEFAULT NULL,
  `orderID` int(11) DEFAULT NULL,
  `company_name` varchar(64) DEFAULT NULL,
  `company_inn` varchar(64) DEFAULT NULL,
  `nds_included` int(11) DEFAULT '0',
  `nds_rate` float DEFAULT '0',
  `RUR_rate` float DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `SC__module_payment_invoice_phys`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC__module_payment_invoice_phys`;
CREATE TABLE IF NOT EXISTS `SC__module_payment_invoice_phys` (
  `module_id` int(10) unsigned DEFAULT NULL,
  `orderID` int(11) DEFAULT NULL,
  `order_amount_string` varchar(64) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SC__module_payment_invoice_phys`
--

INSERT INTO `SC__module_payment_invoice_phys` (`module_id`, `orderID`, `order_amount_string`) VALUES
(19, 12, '4 180 руб.'),
(19, 33, '4 000 руб.');

-- --------------------------------------------------------

--
-- Структура таблицы `SC__module_shipping_bycountries_byzones_rates`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC__module_shipping_bycountries_byzones_rates`;
CREATE TABLE IF NOT EXISTS `SC__module_shipping_bycountries_byzones_rates` (
  `module_id` int(10) unsigned NOT NULL DEFAULT '0',
  `countryID` int(11) DEFAULT NULL,
  `zoneID` int(11) DEFAULT NULL,
  `shipping_rate` float DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `SC__module_shipping_bycountries_byzones_rates_percent`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SC__module_shipping_bycountries_byzones_rates_percent`;
CREATE TABLE IF NOT EXISTS `SC__module_shipping_bycountries_byzones_rates_percent` (
  `module_id` int(10) unsigned NOT NULL DEFAULT '0',
  `countryID` int(11) DEFAULT NULL,
  `zoneID` int(11) DEFAULT NULL,
  `shipping_rate` float DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `SMS_BALANCE`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SMS_BALANCE`;
CREATE TABLE IF NOT EXISTS `SMS_BALANCE` (
  `SMS_USER_ID` varchar(20) NOT NULL DEFAULT '',
  `SMS_SENT` int(11) NOT NULL DEFAULT '0',
  `SMS_BALANCE` decimal(15,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SMS_BALANCE`
--

INSERT INTO `SMS_BALANCE` (`SMS_USER_ID`, `SMS_SENT`, `SMS_BALANCE`) VALUES
('$SYSTEM', 0, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `SMS_CREDIT_HISTORY`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SMS_CREDIT_HISTORY`;
CREATE TABLE IF NOT EXISTS `SMS_CREDIT_HISTORY` (
  `SMSG_ID` int(11) NOT NULL,
  `SMSG_DATETIME` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SMSG_USER_ID` varchar(20) NOT NULL,
  `SMSG_QTY` decimal(15,2) DEFAULT NULL,
  `SMSG_QS` char(10) NOT NULL,
  `SMSG_SOURCE` varchar(20) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `SMS_CREDIT_HISTORY`
--

INSERT INTO `SMS_CREDIT_HISTORY` (`SMSG_ID`, `SMSG_DATETIME`, `SMSG_USER_ID`, `SMSG_QTY`, `SMSG_QS`, `SMSG_SOURCE`) VALUES
(1, '2011-06-29 15:24:36', '$SYSTEM', NULL, 'SET', 'ONCREATE');

-- --------------------------------------------------------

--
-- Структура таблицы `SMS_HISTORY`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
-- Последняя проверка: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `SMS_HISTORY`;
CREATE TABLE IF NOT EXISTS `SMS_HISTORY` (
  `SMSH_ID` int(11) NOT NULL,
  `SMSH_DATETIME` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SMSH_USER_ID` varchar(20) NOT NULL,
  `SMSH_PHONE` varchar(20) NOT NULL,
  `SMSH_WIDTH` int(11) NOT NULL,
  `SMSH_QTY` int(11) NOT NULL,
  `SMSH_APP` varchar(5) NOT NULL,
  `SMSH_MODULEID` char(30) NOT NULL,
  `SMSH_TEXT` text NOT NULL,
  `SMSH_MSGID` char(50) DEFAULT NULL,
  `SMSH_CHARGE` decimal(15,2) DEFAULT NULL,
  `SMSH_CHARGED` tinyint(4) NOT NULL DEFAULT '0',
  `SMSH_UNLIM` tinyint(4) NOT NULL DEFAULT '0',
  `SMSH_STATUS` varchar(20) DEFAULT NULL,
  `SMSH_STATUS_TEXT` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `UGROUP`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `UGROUP`;
CREATE TABLE IF NOT EXISTS `UGROUP` (
  `UG_ID` int(11) NOT NULL,
  `UG_NAME` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `UGROUP_USER`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `UGROUP_USER`;
CREATE TABLE IF NOT EXISTS `UGROUP_USER` (
  `UG_ID` int(11) NOT NULL,
  `U_ID` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `UG_ACCESSRIGHTS`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `UG_ACCESSRIGHTS`;
CREATE TABLE IF NOT EXISTS `UG_ACCESSRIGHTS` (
  `AR_ID` varchar(20) NOT NULL DEFAULT '',
  `AR_PATH` varchar(255) NOT NULL DEFAULT '',
  `AR_OBJECT_ID` varchar(50) NOT NULL DEFAULT '',
  `AR_VALUE` int(11) NOT NULL DEFAULT '0',
  `AR_AUX` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `UNSUBSCRIBER`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `UNSUBSCRIBER`;
CREATE TABLE IF NOT EXISTS `UNSUBSCRIBER` (
  `ENS_EMAIL` varchar(255) NOT NULL,
  `ENS_DATETIME` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `USER_DISK_QUOTA`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `USER_DISK_QUOTA`;
CREATE TABLE IF NOT EXISTS `USER_DISK_QUOTA` (
  `UDQ_USER_ID` varchar(20) NOT NULL,
  `UDQ_APP_ID` char(10) NOT NULL,
  `UDQ_SIZE` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `USER_SETTINGS`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Сен 18 2015 г., 21:19
--

DROP TABLE IF EXISTS `USER_SETTINGS`;
CREATE TABLE IF NOT EXISTS `USER_SETTINGS` (
  `U_ID` varchar(20) NOT NULL,
  `APP_ID` char(2) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `VALUE` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `USER_SETTINGS`
--

INSERT INTO `USER_SETTINGS` (`U_ID`, `APP_ID`, `NAME`, `VALUE`) VALUES
('ADMIN', '', 'START_PAGE', 'BLANK'),
('ADMIN', '', 'template', 'classic'),
('ADMIN', '', 'language', 'rus'),
('ADMIN', '', 'mailformat', 'html'),
('ADMIN', 'AA', 'LAST_TIME', '1442611121'),
('ADMIN', '', 'LAST_PAGE', 'SC/FM'),
('ADMIN', 'UG', 'LASTPAGE', '0'),
('ADMIN', 'UG', 'LASTGROUP', 'online'),
('ADMIN', 'UG', 'SORTINGgroupsall', 'C_NAME:asc'),
('ADMIN', 'UG', 'SORTINGgroupsonline', 'C_NAME:asc'),
('ADMIN', 'UG', 'SORTINGgroupsinvited', 'C_NAME:asc'),
('ADMIN', 'UG', 'SORTINGgroupsdisabled', 'C_NAME:asc');

-- --------------------------------------------------------

--
-- Структура таблицы `U_ACCESSRIGHTS`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `U_ACCESSRIGHTS`;
CREATE TABLE IF NOT EXISTS `U_ACCESSRIGHTS` (
  `AR_ID` varchar(20) NOT NULL DEFAULT '',
  `AR_PATH` varchar(255) NOT NULL DEFAULT '',
  `AR_OBJECT_ID` varchar(50) NOT NULL DEFAULT '',
  `AR_VALUE` int(11) NOT NULL DEFAULT '0',
  `AR_AUX` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `U_ACCESSRIGHTS`
--

INSERT INTO `U_ACCESSRIGHTS` (`AR_ID`, `AR_PATH`, `AR_OBJECT_ID`, `AR_VALUE`, `AR_AUX`) VALUES
('ADMIN', '/ROOT/MW/SCREENS', 'PF', 1, NULL),
('ADMIN', '/ROOT/MW/FUNCTIONS', 'TAB_CONTACT', 1, NULL),
('ADMIN', '/ROOT/MW/FUNCTIONS', 'TAB_USER', 1, NULL),
('ADMIN', '/ROOT/MW/FUNCTIONS', 'TAB_GROUPS', 1, NULL),
('ADMIN', '/ROOT/MW/FUNCTIONS', 'TAB_ACCESS', 1, NULL),
('ADMIN', '/ROOT/MW/FUNCTIONS', 'TAB_QUOTA', 1, NULL),
('ADMIN', '/ROOT/MW/DA', 'DIRECTACCESS', 1, NULL),
('ADMIN', '/ROOT/UG/SCREENS', 'UNG', 1, NULL),
('ADMIN', '/ROOT/AA/SCREENS', 'CP', 1, NULL),
('ADMIN', '/ROOT/SC/SCREENS', 'FM', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__21', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__87', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__189', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__100', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__188', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__22', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__52', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__88', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__99', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__14', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__20', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__15', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__16', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__72', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__73', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__18', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__182', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__175', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__165', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__106', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__104', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__179', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__79', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__206', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__207', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__68', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__69', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__67', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__201', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__186', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__202', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__24', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__74', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__25', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__26', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__75', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__76', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__77', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__43', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__178', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__160', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__149', 1, NULL),
('ADMIN', '/ROOT/SC/FUNCTIONS', 'SC__169', 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `WBS_USER`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `WBS_USER`;
CREATE TABLE IF NOT EXISTS `WBS_USER` (
  `U_ID` varchar(20) NOT NULL DEFAULT '',
  `C_ID` int(11) DEFAULT NULL,
  `U_PASSWORD` varchar(36) DEFAULT NULL,
  `U_STATUS` smallint(6) DEFAULT '0',
  `U_SETTINGS` text,
  `U_SENDMAIL` smallint(2) DEFAULT '0',
  `U_ACCESSTYPE` char(5) DEFAULT 'IND'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `WBS_USER`
--

INSERT INTO `WBS_USER` (`U_ID`, `C_ID`, `U_PASSWORD`, `U_STATUS`, `U_SETTINGS`, `U_SENDMAIL`, `U_ACCESSTYPE`) VALUES
('ADMIN', 1, 'e225e11c6a3b01e4fcdcb96ba7560502', 0, '', 0, 'SUM');

-- --------------------------------------------------------

--
-- Структура таблицы `WG_PARAM`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `WG_PARAM`;
CREATE TABLE IF NOT EXISTS `WG_PARAM` (
  `WG_ID` int(11) NOT NULL DEFAULT '0',
  `WGP_NAME` varchar(50) NOT NULL DEFAULT '',
  `WGP_VALUE` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `WG_WIDGET`
--
-- Создание: Дек 12 2014 г., 17:43
-- Последнее обновление: Дек 12 2014 г., 17:43
--

DROP TABLE IF EXISTS `WG_WIDGET`;
CREATE TABLE IF NOT EXISTS `WG_WIDGET` (
  `WG_ID` int(11) NOT NULL,
  `WT_ID` varchar(30) NOT NULL DEFAULT '',
  `WST_ID` varchar(30) NOT NULL DEFAULT '',
  `WG_FPRINT` varchar(100) NOT NULL DEFAULT '',
  `WG_DESC` text NOT NULL,
  `WG_USER` varchar(20) NOT NULL DEFAULT '',
  `WG_LANG` varchar(5) NOT NULL DEFAULT 'eng',
  `WG_CREATED_FROM` varchar(25) NOT NULL DEFAULT '',
  `WG_CREATED_BY` varchar(100) NOT NULL DEFAULT '',
  `WG_CREATED_DATETIME` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `WG_MODIFIED_BY` varchar(100) NOT NULL DEFAULT '',
  `WG_MODIFIED_DATETIME` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `ACCESSRIGHTS_LINK`
--
ALTER TABLE `ACCESSRIGHTS_LINK`
  ADD PRIMARY KEY (`AR_PATH`,`AR_OBJECT_ID`), ADD KEY `LINK_AR_PATH` (`LINK_AR_PATH`,`LINK_AR_OBJECT_ID`);

--
-- Индексы таблицы `APPSETTINGS`
--
ALTER TABLE `APPSETTINGS`
  ADD PRIMARY KEY (`APP_ID`);

--
-- Индексы таблицы `CFOLDER`
--
ALTER TABLE `CFOLDER`
  ADD PRIMARY KEY (`CF_ID`);

--
-- Индексы таблицы `COMPANY`
--
ALTER TABLE `COMPANY`
  ADD PRIMARY KEY (`COM_NAME`);

--
-- Индексы таблицы `CONTACT`
--
ALTER TABLE `CONTACT`
  ADD PRIMARY KEY (`C_ID`), ADD KEY `CF_ID` (`CF_ID`), ADD KEY `C_FIRSTNAME` (`C_FIRSTNAME`), ADD KEY `C_LASTNAME` (`C_LASTNAME`), ADD KEY `C_EMAILADDRESS` (`C_EMAILADDRESS`), ADD KEY `C_FULLNAME` (`C_FULLNAME`);

--
-- Индексы таблицы `CONTACTFIELD`
--
ALTER TABLE `CONTACTFIELD`
  ADD PRIMARY KEY (`CF_ID`), ADD UNIQUE KEY `CF_DBNAME` (`CF_DBNAME`);

--
-- Индексы таблицы `CONTACTTYPE`
--
ALTER TABLE `CONTACTTYPE`
  ADD PRIMARY KEY (`CT_ID`);

--
-- Индексы таблицы `CURRENCY`
--
ALTER TABLE `CURRENCY`
  ADD PRIMARY KEY (`CUR_ID`);

--
-- Индексы таблицы `DISK_USAGE`
--
ALTER TABLE `DISK_USAGE`
  ADD PRIMARY KEY (`DU_USER_ID`,`DU_APP_ID`);

--
-- Индексы таблицы `EMAIL_CONTACT`
--
ALTER TABLE `EMAIL_CONTACT`
  ADD PRIMARY KEY (`EC_ID`,`EC_EMAIL`);

--
-- Индексы таблицы `MMMESSAGE`
--
ALTER TABLE `MMMESSAGE`
  ADD PRIMARY KEY (`MMM_ID`);

--
-- Индексы таблицы `MMMSENTTO`
--
ALTER TABLE `MMMSENTTO`
  ADD PRIMARY KEY (`MMM_ID`,`MMMST_EMAIL`);

--
-- Индексы таблицы `MMSENT`
--
ALTER TABLE `MMSENT`
  ADD PRIMARY KEY (`MMS_DATE`);

--
-- Индексы таблицы `SC_aff_commissions`
--
ALTER TABLE `SC_aff_commissions`
  ADD PRIMARY KEY (`cID`), ADD KEY `CUSTOMERID` (`CustomerID`);

--
-- Индексы таблицы `SC_aff_payments`
--
ALTER TABLE `SC_aff_payments`
  ADD PRIMARY KEY (`pID`), ADD KEY `CUSTOMERID` (`CustomerID`);

--
-- Индексы таблицы `SC_aux_pages`
--
ALTER TABLE `SC_aux_pages`
  ADD PRIMARY KEY (`aux_page_ID`);

--
-- Индексы таблицы `SC_categories`
--
ALTER TABLE `SC_categories`
  ADD PRIMARY KEY (`categoryID`), ADD KEY `IDX_CATEGORIES1` (`parent`), ADD KEY `slug` (`slug`), ADD KEY `sort_order` (`sort_order`);

--
-- Индексы таблицы `SC_category_product`
--
ALTER TABLE `SC_category_product`
  ADD PRIMARY KEY (`productID`,`categoryID`), ADD KEY `categoryID` (`categoryID`);

--
-- Индексы таблицы `SC_category_product_options__variants`
--
ALTER TABLE `SC_category_product_options__variants`
  ADD PRIMARY KEY (`optionID`,`categoryID`,`variantID`), ADD KEY `categoryID` (`categoryID`), ADD KEY `variantID` (`variantID`);

--
-- Индексы таблицы `SC_category__product_options`
--
ALTER TABLE `SC_category__product_options`
  ADD PRIMARY KEY (`optionID`,`categoryID`);

--
-- Индексы таблицы `SC_config_settings`
--
ALTER TABLE `SC_config_settings`
  ADD KEY `ModuleConfigID` (`ModuleConfigID`);

--
-- Индексы таблицы `SC_countries`
--
ALTER TABLE `SC_countries`
  ADD PRIMARY KEY (`countryID`);

--
-- Индексы таблицы `SC_currency_types`
--
ALTER TABLE `SC_currency_types`
  ADD PRIMARY KEY (`CID`), ADD KEY `sort_order` (`sort_order`);

--
-- Индексы таблицы `SC_custgroups`
--
ALTER TABLE `SC_custgroups`
  ADD PRIMARY KEY (`custgroupID`);

--
-- Индексы таблицы `SC_customers`
--
ALTER TABLE `SC_customers`
  ADD PRIMARY KEY (`customerID`), ADD KEY `AFFILIATEID` (`affiliateID`);

--
-- Индексы таблицы `SC_customer_addresses`
--
ALTER TABLE `SC_customer_addresses`
  ADD PRIMARY KEY (`addressID`);

--
-- Индексы таблицы `SC_customer_reg_fields`
--
ALTER TABLE `SC_customer_reg_fields`
  ADD PRIMARY KEY (`reg_field_ID`);

--
-- Индексы таблицы `SC_customer_reg_fields_values`
--
ALTER TABLE `SC_customer_reg_fields_values`
  ADD UNIQUE KEY `UNQ_reg_cust` (`reg_field_ID`,`customerID`);

--
-- Индексы таблицы `SC_discount_coupons`
--
ALTER TABLE `SC_discount_coupons`
  ADD PRIMARY KEY (`coupon_id`), ADD UNIQUE KEY `coupon_code` (`coupon_code`);

--
-- Индексы таблицы `SC_discussions`
--
ALTER TABLE `SC_discussions`
  ADD PRIMARY KEY (`DID`), ADD KEY `productID` (`productID`);

--
-- Индексы таблицы `SC_divisions`
--
ALTER TABLE `SC_divisions`
  ADD PRIMARY KEY (`xID`,`xParentID`), ADD KEY `xUnicKey` (`xUnicKey`), ADD KEY `xEnabled` (`xEnabled`), ADD KEY `xPriority` (`xPriority`), ADD KEY `xParentID` (`xParentID`);

--
-- Индексы таблицы `SC_division_access`
--
ALTER TABLE `SC_division_access`
  ADD KEY `xDivisionID` (`xDivisionID`,`xU_ID`), ADD KEY `xID_TYPE` (`xID_TYPE`), ADD KEY `xU_ID` (`xU_ID`);

--
-- Индексы таблицы `SC_division_custom_settings`
--
ALTER TABLE `SC_division_custom_settings`
  ADD KEY `xDivisionID` (`xDivisionID`,`xSettingID`);

--
-- Индексы таблицы `SC_division_interface`
--
ALTER TABLE `SC_division_interface`
  ADD KEY `divisionID` (`xDivisionID`);

--
-- Индексы таблицы `SC_htmlcodes`
--
ALTER TABLE `SC_htmlcodes`
  ADD PRIMARY KEY (`key`);

--
-- Индексы таблицы `SC_interface_interfaces`
--
ALTER TABLE `SC_interface_interfaces`
  ADD KEY `xInterfaceCaller` (`xInterfaceCaller`);

--
-- Индексы таблицы `SC_language`
--
ALTER TABLE `SC_language`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD KEY `enabled` (`enabled`), ADD KEY `iso2` (`iso2`);

--
-- Индексы таблицы `SC_linkexchange_categories`
--
ALTER TABLE `SC_linkexchange_categories`
  ADD PRIMARY KEY (`le_cID`);

--
-- Индексы таблицы `SC_linkexchange_links`
--
ALTER TABLE `SC_linkexchange_links`
  ADD PRIMARY KEY (`le_lID`);

--
-- Индексы таблицы `SC_local`
--
ALTER TABLE `SC_local`
  ADD PRIMARY KEY (`id`,`lang_id`), ADD KEY `lang_id` (`lang_id`), ADD KEY `id` (`id`), ADD KEY `group` (`group`), ADD KEY `subgroup` (`subgroup`);

--
-- Индексы таблицы `SC_localgroup`
--
ALTER TABLE `SC_localgroup`
  ADD PRIMARY KEY (`key`), ADD UNIQUE KEY `key` (`key`);

--
-- Индексы таблицы `SC_modules`
--
ALTER TABLE `SC_modules`
  ADD PRIMARY KEY (`ModuleID`);

--
-- Индексы таблицы `SC_module_configs`
--
ALTER TABLE `SC_module_configs`
  ADD PRIMARY KEY (`ModuleConfigID`), ADD KEY `ModuleID` (`ModuleID`), ADD KEY `ConfigKey` (`ConfigKey`), ADD KEY `ConfigEnabled` (`ConfigEnabled`);

--
-- Индексы таблицы `SC_news_table`
--
ALTER TABLE `SC_news_table`
  ADD PRIMARY KEY (`NID`);

--
-- Индексы таблицы `SC_ordered_carts`
--
ALTER TABLE `SC_ordered_carts`
  ADD PRIMARY KEY (`itemID`,`orderID`);

--
-- Индексы таблицы `SC_orders`
--
ALTER TABLE `SC_orders`
  ADD PRIMARY KEY (`orderID`), ADD KEY `google_order_number` (`google_order_number`), ADD KEY `customerID` (`customerID`);

--
-- Индексы таблицы `SC_orders_discount_coupons`
--
ALTER TABLE `SC_orders_discount_coupons`
  ADD PRIMARY KEY (`order_id`), ADD KEY `coupon_id` (`coupon_id`);

--
-- Индексы таблицы `SC_order_price_discount`
--
ALTER TABLE `SC_order_price_discount`
  ADD PRIMARY KEY (`discount_id`);

--
-- Индексы таблицы `SC_order_status`
--
ALTER TABLE `SC_order_status`
  ADD PRIMARY KEY (`statusID`);

--
-- Индексы таблицы `SC_payment_types`
--
ALTER TABLE `SC_payment_types`
  ADD PRIMARY KEY (`PID`);

--
-- Индексы таблицы `SC_payment_types__shipping_methods`
--
ALTER TABLE `SC_payment_types__shipping_methods`
  ADD PRIMARY KEY (`SID`,`PID`);

--
-- Индексы таблицы `SC_products`
--
ALTER TABLE `SC_products`
  ADD PRIMARY KEY (`productID`), ADD KEY `IDX_PRODUCTS1` (`categoryID`), ADD KEY `enabled` (`enabled`), ADD KEY `Price` (`Price`), ADD KEY `customers_rating` (`customers_rating`), ADD KEY `slug` (`slug`), ADD KEY `sort_order` (`sort_order`), ADD KEY `viewed_times` (`viewed_times`), ADD KEY `product_code` (`product_code`), ADD KEY `customer_votes` (`customer_votes`), ADD KEY `items_sold` (`items_sold`);

--
-- Индексы таблицы `SC_products_opt_val_variants`
--
ALTER TABLE `SC_products_opt_val_variants`
  ADD PRIMARY KEY (`variantID`);

--
-- Индексы таблицы `SC_product_list`
--
ALTER TABLE `SC_product_list`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `SC_product_list_item`
--
ALTER TABLE `SC_product_list_item`
  ADD KEY `list_id` (`list_id`,`productID`);

--
-- Индексы таблицы `SC_product_options`
--
ALTER TABLE `SC_product_options`
  ADD PRIMARY KEY (`optionID`), ADD KEY `sort_order` (`sort_order`);

--
-- Индексы таблицы `SC_product_options_set`
--
ALTER TABLE `SC_product_options_set`
  ADD PRIMARY KEY (`productID`,`optionID`,`variantID`), ADD KEY `productID` (`productID`), ADD KEY `optionID` (`optionID`), ADD KEY `variantID` (`variantID`);

--
-- Индексы таблицы `SC_product_options_values`
--
ALTER TABLE `SC_product_options_values`
  ADD PRIMARY KEY (`optionID`,`productID`), ADD KEY `productID` (`productID`), ADD KEY `optionID` (`optionID`), ADD KEY `variantID` (`variantID`);

--
-- Индексы таблицы `SC_product_pictures`
--
ALTER TABLE `SC_product_pictures`
  ADD PRIMARY KEY (`photoID`), ADD KEY `productID` (`productID`);

--
-- Индексы таблицы `SC_related_items`
--
ALTER TABLE `SC_related_items`
  ADD PRIMARY KEY (`productID`,`Owner`);

--
-- Индексы таблицы `SC_settings`
--
ALTER TABLE `SC_settings`
  ADD PRIMARY KEY (`settingsID`);

--
-- Индексы таблицы `SC_settings_groups`
--
ALTER TABLE `SC_settings_groups`
  ADD PRIMARY KEY (`settings_groupID`);

--
-- Индексы таблицы `SC_shipping_methods`
--
ALTER TABLE `SC_shipping_methods`
  ADD PRIMARY KEY (`SID`);

--
-- Индексы таблицы `SC_shopping_carts`
--
ALTER TABLE `SC_shopping_carts`
  ADD PRIMARY KEY (`customerID`,`itemID`);

--
-- Индексы таблицы `SC_shopping_cart_items`
--
ALTER TABLE `SC_shopping_cart_items`
  ADD PRIMARY KEY (`itemID`);

--
-- Индексы таблицы `SC_spmodules`
--
ALTER TABLE `SC_spmodules`
  ADD PRIMARY KEY (`module_id`);

--
-- Индексы таблицы `SC_spmodules_settings`
--
ALTER TABLE `SC_spmodules_settings`
  ADD PRIMARY KEY (`module_id`,`field`);

--
-- Индексы таблицы `SC_subscribers`
--
ALTER TABLE `SC_subscribers`
  ADD PRIMARY KEY (`MID`);

--
-- Индексы таблицы `SC_tagged_objects`
--
ALTER TABLE `SC_tagged_objects`
  ADD KEY `tag_id` (`tag_id`), ADD KEY `tag_id_2` (`object_id`,`tag_id`), ADD KEY `object_type` (`object_type`,`language_id`,`object_id`), ADD KEY `language_id` (`language_id`), ADD KEY `object_type_2` (`object_type`);

--
-- Индексы таблицы `SC_tags`
--
ALTER TABLE `SC_tags`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `SC_tax_classes`
--
ALTER TABLE `SC_tax_classes`
  ADD PRIMARY KEY (`classID`);

--
-- Индексы таблицы `SC_tax_rates`
--
ALTER TABLE `SC_tax_rates`
  ADD PRIMARY KEY (`classID`,`countryID`);

--
-- Индексы таблицы `SC_tax_rates__zones`
--
ALTER TABLE `SC_tax_rates__zones`
  ADD PRIMARY KEY (`classID`,`zoneID`);

--
-- Индексы таблицы `SC_tax_zip`
--
ALTER TABLE `SC_tax_zip`
  ADD PRIMARY KEY (`tax_zipID`);

--
-- Индексы таблицы `SC_zones`
--
ALTER TABLE `SC_zones`
  ADD PRIMARY KEY (`zoneID`);

--
-- Индексы таблицы `SC__courier_rates`
--
ALTER TABLE `SC__courier_rates`
  ADD KEY `module_id` (`module_id`);

--
-- Индексы таблицы `SC__courier_rates2`
--
ALTER TABLE `SC__courier_rates2`
  ADD KEY `module_id` (`module_id`);

--
-- Индексы таблицы `SC__intershipper_carriers`
--
ALTER TABLE `SC__intershipper_carriers`
  ADD KEY `module_id` (`module_id`,`carrierID`);

--
-- Индексы таблицы `SMS_BALANCE`
--
ALTER TABLE `SMS_BALANCE`
  ADD PRIMARY KEY (`SMS_USER_ID`);

--
-- Индексы таблицы `SMS_CREDIT_HISTORY`
--
ALTER TABLE `SMS_CREDIT_HISTORY`
  ADD PRIMARY KEY (`SMSG_ID`), ADD KEY `DATE` (`SMSG_DATETIME`);

--
-- Индексы таблицы `SMS_HISTORY`
--
ALTER TABLE `SMS_HISTORY`
  ADD PRIMARY KEY (`SMSH_ID`), ADD KEY `DATETIME` (`SMSH_DATETIME`);

--
-- Индексы таблицы `UGROUP`
--
ALTER TABLE `UGROUP`
  ADD PRIMARY KEY (`UG_ID`);

--
-- Индексы таблицы `UGROUP_USER`
--
ALTER TABLE `UGROUP_USER`
  ADD PRIMARY KEY (`UG_ID`,`U_ID`);

--
-- Индексы таблицы `UG_ACCESSRIGHTS`
--
ALTER TABLE `UG_ACCESSRIGHTS`
  ADD PRIMARY KEY (`AR_PATH`,`AR_OBJECT_ID`,`AR_ID`);

--
-- Индексы таблицы `UNSUBSCRIBER`
--
ALTER TABLE `UNSUBSCRIBER`
  ADD PRIMARY KEY (`ENS_EMAIL`);

--
-- Индексы таблицы `USER_DISK_QUOTA`
--
ALTER TABLE `USER_DISK_QUOTA`
  ADD PRIMARY KEY (`UDQ_USER_ID`,`UDQ_APP_ID`);

--
-- Индексы таблицы `USER_SETTINGS`
--
ALTER TABLE `USER_SETTINGS`
  ADD PRIMARY KEY (`U_ID`,`APP_ID`,`NAME`);

--
-- Индексы таблицы `U_ACCESSRIGHTS`
--
ALTER TABLE `U_ACCESSRIGHTS`
  ADD PRIMARY KEY (`AR_PATH`,`AR_OBJECT_ID`,`AR_ID`);

--
-- Индексы таблицы `WBS_USER`
--
ALTER TABLE `WBS_USER`
  ADD PRIMARY KEY (`U_ID`);

--
-- Индексы таблицы `WG_PARAM`
--
ALTER TABLE `WG_PARAM`
  ADD PRIMARY KEY (`WG_ID`,`WGP_NAME`);

--
-- Индексы таблицы `WG_WIDGET`
--
ALTER TABLE `WG_WIDGET`
  ADD PRIMARY KEY (`WG_ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `CONTACT`
--
ALTER TABLE `CONTACT`
  MODIFY `C_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `CONTACTFIELD`
--
ALTER TABLE `CONTACTFIELD`
  MODIFY `CF_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT для таблицы `CONTACTTYPE`
--
ALTER TABLE `CONTACTTYPE`
  MODIFY `CT_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `SC_aff_commissions`
--
ALTER TABLE `SC_aff_commissions`
  MODIFY `cID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `SC_aff_payments`
--
ALTER TABLE `SC_aff_payments`
  MODIFY `pID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `SC_aux_pages`
--
ALTER TABLE `SC_aux_pages`
  MODIFY `aux_page_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `SC_categories`
--
ALTER TABLE `SC_categories`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=600;
--
-- AUTO_INCREMENT для таблицы `SC_countries`
--
ALTER TABLE `SC_countries`
  MODIFY `countryID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=246;
--
-- AUTO_INCREMENT для таблицы `SC_currency_types`
--
ALTER TABLE `SC_currency_types`
  MODIFY `CID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `SC_custgroups`
--
ALTER TABLE `SC_custgroups`
  MODIFY `custgroupID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `SC_customers`
--
ALTER TABLE `SC_customers`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT для таблицы `SC_customer_addresses`
--
ALTER TABLE `SC_customer_addresses`
  MODIFY `addressID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=152;
--
-- AUTO_INCREMENT для таблицы `SC_customer_reg_fields`
--
ALTER TABLE `SC_customer_reg_fields`
  MODIFY `reg_field_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `SC_discount_coupons`
--
ALTER TABLE `SC_discount_coupons`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `SC_discussions`
--
ALTER TABLE `SC_discussions`
  MODIFY `DID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT для таблицы `SC_divisions`
--
ALTER TABLE `SC_divisions`
  MODIFY `xID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=217;
--
-- AUTO_INCREMENT для таблицы `SC_division_custom_settings`
--
ALTER TABLE `SC_division_custom_settings`
  MODIFY `xSettingID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `SC_language`
--
ALTER TABLE `SC_language`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `SC_linkexchange_categories`
--
ALTER TABLE `SC_linkexchange_categories`
  MODIFY `le_cID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `SC_linkexchange_links`
--
ALTER TABLE `SC_linkexchange_links`
  MODIFY `le_lID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `SC_modules`
--
ALTER TABLE `SC_modules`
  MODIFY `ModuleID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT для таблицы `SC_module_configs`
--
ALTER TABLE `SC_module_configs`
  MODIFY `ModuleConfigID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT для таблицы `SC_news_table`
--
ALTER TABLE `SC_news_table`
  MODIFY `NID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `SC_orders`
--
ALTER TABLE `SC_orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT для таблицы `SC_order_price_discount`
--
ALTER TABLE `SC_order_price_discount`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `SC_order_status`
--
ALTER TABLE `SC_order_status`
  MODIFY `statusID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT для таблицы `SC_payment_types`
--
ALTER TABLE `SC_payment_types`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `SC_products`
--
ALTER TABLE `SC_products`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=918;
--
-- AUTO_INCREMENT для таблицы `SC_products_opt_val_variants`
--
ALTER TABLE `SC_products_opt_val_variants`
  MODIFY `variantID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=136;
--
-- AUTO_INCREMENT для таблицы `SC_product_options`
--
ALTER TABLE `SC_product_options`
  MODIFY `optionID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT для таблицы `SC_product_pictures`
--
ALTER TABLE `SC_product_pictures`
  MODIFY `photoID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7013;
--
-- AUTO_INCREMENT для таблицы `SC_settings`
--
ALTER TABLE `SC_settings`
  MODIFY `settingsID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=488;
--
-- AUTO_INCREMENT для таблицы `SC_settings_groups`
--
ALTER TABLE `SC_settings_groups`
  MODIFY `settings_groupID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `SC_shipping_methods`
--
ALTER TABLE `SC_shipping_methods`
  MODIFY `SID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `SC_shopping_cart_items`
--
ALTER TABLE `SC_shopping_cart_items`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=141;
--
-- AUTO_INCREMENT для таблицы `SC_spmodules`
--
ALTER TABLE `SC_spmodules`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT для таблицы `SC_subscribers`
--
ALTER TABLE `SC_subscribers`
  MODIFY `MID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT для таблицы `SC_tags`
--
ALTER TABLE `SC_tags`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `SC_tax_classes`
--
ALTER TABLE `SC_tax_classes`
  MODIFY `classID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `SC_tax_zip`
--
ALTER TABLE `SC_tax_zip`
  MODIFY `tax_zipID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `SC_zones`
--
ALTER TABLE `SC_zones`
  MODIFY `zoneID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=300;
--
-- AUTO_INCREMENT для таблицы `SMS_CREDIT_HISTORY`
--
ALTER TABLE `SMS_CREDIT_HISTORY`
  MODIFY `SMSG_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `SMS_HISTORY`
--
ALTER TABLE `SMS_HISTORY`
  MODIFY `SMSH_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `UGROUP`
--
ALTER TABLE `UGROUP`
  MODIFY `UG_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `WG_WIDGET`
--
ALTER TABLE `WG_WIDGET`
  MODIFY `WG_ID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
