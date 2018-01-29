CREATE TABLE `site_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `referral_id` int(11) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `purchase` double(15,3) NOT NULL DEFAULT '0.000',
  `is_send` tinyint(1) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `send_present` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_id` (`order_id`),
  KEY `referral_id` (`referral_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;