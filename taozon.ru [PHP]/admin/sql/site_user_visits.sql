CREATE TABLE IF NOT EXISTS `site_user_visits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_ip` varchar(20) NOT NULL,
  `cookie` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `added` datetime NOT NULL,
  `sent` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY idx_sent (`sent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;