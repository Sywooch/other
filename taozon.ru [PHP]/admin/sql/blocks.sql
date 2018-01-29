CREATE TABLE `blocks` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `page_id` int(11) NOT NULL,
 `position` int(11) NOT NULL DEFAULT '0',
 `text` longtext NOT NULL,
 PRIMARY KEY (`id`),
 KEY `page_id` (`page_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
