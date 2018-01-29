CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(128) NOT NULL,
  `life_time` text NOT NULL,
  `value` longtext NOT NULL,
  `added_time` text NOT NULL,
  KEY `key` (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;