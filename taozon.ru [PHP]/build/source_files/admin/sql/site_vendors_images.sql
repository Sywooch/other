CREATE TABLE IF NOT EXISTS `site_vendors_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_id` varchar(255) DEFAULT NULL,
  `vendor_name` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
