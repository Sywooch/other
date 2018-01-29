CREATE TABLE `site_referrals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `login` varchar(128) NOT NULL,
  `user_id` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `comission` double(15,3) NOT NULL DEFAULT '0.000',
  `balance` double(15,3) NOT NULL DEFAULT '0.000',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;