-- phpMyAdmin SQL Dump
-- version 
-- http://www.phpmyadmin.net
--
-- Хост: u305676.mysql.masterhost.ru
-- Время создания: Май 25 2016 г., 15:10
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
-- Структура таблицы `ad_documents`
--

CREATE TABLE IF NOT EXISTS `ad_documents` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cdate` datetime NOT NULL,
  `mdate` datetime NOT NULL,
  `title` tinytext NOT NULL,
  `lk_num` tinytext,
  `lk` enum('yes','no') NOT NULL DEFAULT 'no',
  `description` text,
  `file` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=314 ;

--
-- Дамп данных таблицы `ad_documents`
--

INSERT INTO `ad_documents` (`id`, `cdate`, `mdate`, `title`, `lk_num`, `lk`, `description`, `file`) VALUES
(86, '2012-03-30 12:28:55', '2016-04-29 16:52:36', 'Общие условия работы', NULL, 'no', '<br class="innova" />\r\n\r\n ', '/public/userfiles/documents/informatsiya_po_obschim_usloviyam_raboti_ot_10_maya_2011_goda.doc'),
(85, '2012-03-30 12:26:32', '2016-04-29 16:52:48', 'Приложение  транспортные услуги', NULL, 'no', '<br class="innova" />\r\n\r\n ', '/public/userfiles/documents/Prilogenie_3_transportnie_uslugi_copy(1333095992_1020332403).doc'),
(261, '2014-03-07 12:53:20', '2016-04-29 16:47:11', 'Требования к заполнению доверенности от 04.03.2014', NULL, 'no', '<br class="innova" />\r\n\r\n\r\n  ', '/public/userfiles/documents/Trebovanie_k_zapolneniyu_doverennosti_04.03.2014.doc'),
(265, '2014-03-26 11:33:06', '2016-04-29 16:44:59', 'Образец заполнения доверенности юридическим лицом', NULL, 'no', '<br class="innova" />\r\n\r\n\r\n  ', '/public/userfiles/documents/Obrazec_1_Zapjlneniya_doverennosti_yurid.licom.xls'),
(290, '2015-08-03 13:24:27', '2016-04-29 16:40:30', 'Прайс-лист', NULL, 'no', '<br class="innova" />\r\n\r\n ', '/public/userfiles/documents/Price2.xls'),
(204, '2013-03-07 12:42:56', '2016-04-29 16:49:24', 'Правила подачи Претензии по Товару', NULL, 'no', '<br class="innova" />\r\n\r\n ', '/public/userfiles/documents/Pravila_podachi_Pretenzii_po_Tovaru_(2013).doc'),
(291, '2015-08-03 13:24:47', '2016-04-29 16:40:07', 'Прайс-лист', NULL, 'no', '<br class="innova" />\r\n\r\n ', '/public/userfiles/documents/Price3.xls'),
(292, '2015-08-03 13:25:12', '2016-04-29 16:39:42', 'Прайс-лист', NULL, 'no', '<br class="innova" />\r\n\r\n ', '/public/userfiles/documents/Price4.xls'),
(293, '2015-08-03 13:25:31', '2016-04-29 16:38:33', 'Прайс-лист', NULL, 'no', '<br class="innova" />\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n       ', '/public/userfiles/documents/PriceM2.xls'),
(267, '2014-09-19 11:32:21', '2016-04-29 16:43:33', 'Образец нового договора с учетом текста счетов', NULL, 'no', '<br class="innova" />\r\n\r\n ', '/public/userfiles/documents/Obrazets_novogo_dogovora_s_uchetom_teksta_schetov.doc'),
(89, '2012-03-31 11:34:06', '2016-04-29 16:52:22', 'Общие условия работы', NULL, 'no', '<br class="innova" />\r\n\r\n\r\n\r\n   ', '/public/userfiles/documents/informatsiya_po_obschim_usloviyam_raboti_ot_10_maya_2011_goda_copy(1333179246_745923581).doc'),
(91, '2012-04-09 16:02:25', '2016-04-29 16:51:44', 'Общие условия работы', NULL, 'no', '<br class="innova" />\r\n\r\n ', '/public/userfiles/documents/informatsiya_po_obschim_usloviyam_raboti_ot_10_maya_2011_goda_copy(1333972945_244020015).doc'),
(93, '2012-04-09 16:03:35', '2016-04-29 16:51:07', 'Приложение транспортные услуги', NULL, 'no', '<br class="innova" />\r\n\r\n\r\n  ', '/public/userfiles/documents/Prilogenie_3_transportnie_uslugi_copy(1333095992_1020332403)_copy(1333973015_583317176).doc'),
(262, '2014-03-13 18:12:01', '2016-04-29 16:46:21', 'ООО &quot;Артисан-Дизайн&quot; отказ по счёту и возврат денежных средств 2014', NULL, 'no', '<br class="innova" />\r\n\r\n ', '/public/userfiles/documents/OOO_Artisan-Dizain_otkaz_po_schetu_i_vozvrat_denejnyh_sredstv__2014.docx'),
(263, '2014-03-13 18:13:13', '2016-04-29 16:45:59', 'ООО &quot;Артисан-Проект&quot; отказ по счёту и возврат денежных средств 2014', NULL, 'no', '<br class="innova" />\r\n\r\n ', '/public/userfiles/documents/OOO_Artisan-Proekt_otkaz_po_schetu_i_vozvrat_denejnyh_sredstv__2014.docx'),
(96, '2012-04-09 16:05:11', '2016-04-29 16:50:38', 'Схема проезда', NULL, 'no', '<br class="innova" />\r\n\r\n ', '/public/userfiles/documents/Shema_copy(1333973111_1306704916).pdf'),
(264, '2014-03-26 11:28:13', '2016-04-29 16:45:27', 'Доверенность на получение ТМЦ', NULL, 'no', '<br class="innova" />\r\n\r\n ', '/public/userfiles/documents/Obrazec_doverennosti_na_poluchenie_TMC.xls'),
(168, '2012-10-31 17:54:14', '2016-04-29 16:50:09', 'Дополнительное соглашение по интернет-магазинам от 20 сентября 2012 года', NULL, 'no', '<br class="innova" />\r\n\r\n ', '/public/userfiles/documents/Dopsoglashenie_internet_magazinov_ot_20-09-2012.doc'),
(203, '2013-03-07 12:32:38', '2016-05-25 14:19:59', 'Правила обмена/возврата Товара', '', 'yes', '<br class="innova" />\r\n\r\n\r\n  ', '/public/userfiles/documents/Pravila_obmena_i_vozvrata_Tovara_(2014).doc'),
(308, '2015-12-30 18:05:52', '2016-05-13 15:39:00', 'Образец доверенности для получения товара - транспортной компанией на 2016 год', NULL, 'no', '<br class="innova" />\r\n\r\n\r\n\r\n   ', '/public/userfiles/documents/Obrazets_general-noy_doverennosti_Transportnoy_Kompanii_na_2016_god.doc'),
(231, '2013-04-02 17:22:07', '2016-04-29 16:49:05', 'Заявление на обмен товара', NULL, 'no', '<br class="innova" />\r\n\r\n ', '/public/userfiles/documents/Zayavlenie_na_obmen_tovara.doc'),
(232, '2013-04-02 17:22:55', '2016-04-29 16:48:01', 'Заявление на возврат товара', NULL, 'no', '<br class="innova" />\r\n\r\n ', '/public/userfiles/documents/Zayavlenie_na_vozvrat_tovara.doc'),
(294, '2015-08-04 18:58:56', '2016-04-29 16:38:06', 'PORCELANOSA GRUPO Информация по коммерческой политике', NULL, 'no', '<br class="innova" />\r\n', '/public/userfiles/documents/PORCELANOSA_GRUPO_Informatsiya_po_kommercheskoy_politike.doc'),
(288, '2015-08-03 13:22:59', '2016-04-29 16:41:15', 'Прайс-лист', NULL, 'no', '<br class="innova" />\r\n\r\n ', '/public/userfiles/documents/Price.xls'),
(289, '2015-08-03 13:24:00', '2016-04-29 16:40:52', 'Прайс-лист', NULL, 'no', '<br class="innova" />\r\n\r\n ', '/public/userfiles/documents/Price1.xls'),
(259, '2013-12-20 14:09:20', '2016-04-29 16:47:37', 'Доверенность на транспортную компанию', NULL, 'no', '<br class="innova" />\r\n\r\n ', '/public/userfiles/documents/Doverennost_na_transportnuyu_nakladnuyu.doc'),
(266, '2014-09-10 11:41:41', '2016-04-29 16:44:02', 'Заявление о зачете', NULL, 'no', '<br class="innova" />\r\n\r\n ', '/public/userfiles/documents/Zayavlenie_o_zachete.doc'),
(272, '2015-03-12 13:07:00', '2016-04-29 16:42:16', 'Схема проезда на склад «АРТИСАН»', NULL, 'no', '<br class="innova" />\r\n\r\n ', '/public/userfiles/documents/Shema.pdf'),
(271, '2015-03-11 16:11:32', '2016-04-29 16:43:11', 'Транспортные услуги с 11 марта 2015 года', NULL, 'no', '<br class="innova" />\r\n\r\n\r\n  ', '/public/userfiles/documents/Transportnie_uslugi_s_11_03_2015_goda.doc'),
(295, '2015-08-14 14:05:17', '2016-04-29 16:37:42', 'Инструкция по работе в личном кабинете  11.08.2015', NULL, 'no', '<br class="innova" />\r\n', '/public/userfiles/documents/Instruktsiya_po_rabote_v_lichnom_kabinete__11.08.2015.doc'),
(301, '2015-12-11 15:10:42', '2016-05-13 16:02:57', 'PORCELANOSA &amp; VENIS минимальные розничные цены с 11 декабря 2015 года', NULL, 'no', '<br class="innova" />\r\n\r\n\r\n\r\n\r\n    ', '/public/userfiles/documents/Minimal-nie_roznichnie_tseni_po_produktsii_fabrik__Porcelanosa&Venis_s_11.12.2015.xls'),
(278, '2015-05-29 14:12:22', '2016-05-13 09:41:27', 'Информация о грузополучателях', NULL, 'no', '<br class="innova" />\r\n\r\n\r\n  ', '/public/userfiles/documents/Informaciya_o_gruzopoluchatelyah.doc'),
(296, '2015-08-14 16:58:58', '2016-05-13 16:03:01', 'Прайс-лист с 14 октября 2015 года', NULL, 'no', '<br class="innova" />\r\n\r\n\r\n\r\n   ', '/public/userfiles/documents/Rorcelanosa&Venis_rekomendovannie_roznichnie_tseni_s_14.10.2015.xls'),
(304, '2015-12-25 16:00:42', '2016-05-13 16:02:34', 'Образец письма на возврат денежных средств', NULL, 'no', '<br class="innova" />\r\n\r\n\r\n\r\n   ', '/public/userfiles/documents/Obrazets_pis-ma_na_vozvrat_denegnih_sredstv.doc'),
(305, '2015-12-30 16:26:02', '2016-05-13 16:02:07', 'Прайс-лист (МРЦ) Porcelanosa Grupo с 26.01.2016 (Актуальный)!', NULL, 'no', '<br class="innova" />\r\n\r\n\r\n\r\n   ', '/public/userfiles/documents/Price_(MRTs)_PORCELANOSA_GRUPO_c_26.01.2016.xls'),
(306, '2015-12-30 16:27:35', '2016-05-25 14:17:27', 'Правила продажи продукции Porcelanosa Grupo с 01.01.2016!', '2', 'no', '<br class="innova" />\r\n\r\n\r\n\r\n   ', '/public/userfiles/documents/Porcelanosa_Grupo_2016.pdf'),
(307, '2015-12-30 16:46:17', '2016-05-13 15:39:24', 'Переоценка фабрик c 26 января 2016 года!', NULL, 'no', '<br class="innova" />\r\n\r\n\r\n  ', '/public/userfiles/documents/Pereocenka_s_26.01.2016.xls'),
(310, '2016-05-13 15:37:27', '2016-05-25 14:14:56', 'Переоценка с 01 мая 2016 года по фабрикам, новый курс евро!', '1', 'no', '<br class="innova" />\r\n\r\n\r\n  ', '/public/userfiles/documents/Pereocenka_Fabrik_new_kurs_euro_s_01.05.2016.xls'),
(311, '2016-05-24 12:08:17', '0000-00-00 00:00:00', 'Договор сотрудничества 2016г.', NULL, 'no', '<br class="innova" />\r\n', '/public/userfiles/documents/Dilerskiy_dogovor_s_01.01.2016.doc'),
(313, '2016-05-25 14:16:44', '2016-05-25 14:28:25', 'Схема проезда на склад Артисан', '', 'yes', '<br class="innova" />\r\n\r\n ', '/public/userfiles/documents/Shema_copy(1464175705_1606523959).pdf');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
