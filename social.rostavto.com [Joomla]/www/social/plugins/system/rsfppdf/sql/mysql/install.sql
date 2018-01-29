INSERT IGNORE INTO `#__rsform_config` (`SettingName`, `SettingValue`) VALUES ('pdf.font', 'times'), ('pdf.orientation', 'portrait'), ('pdf.paper', 'a4');

CREATE TABLE IF NOT EXISTS `#__rsform_pdfs` (
  `form_id` int(11) NOT NULL,
  `useremail_send` tinyint(1) NOT NULL,
  `useremail_filename` varchar(255) NOT NULL,
  `useremail_php` text NOT NULL,
  `useremail_layout` text NOT NULL,
  `adminemail_send` tinyint(1) NOT NULL,
  `adminemail_filename` varchar(255) NOT NULL,
  `adminemail_php` text NOT NULL,
  `adminemail_layout` text NOT NULL,
  PRIMARY KEY (`form_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;