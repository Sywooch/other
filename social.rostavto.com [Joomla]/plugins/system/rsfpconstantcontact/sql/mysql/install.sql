INSERT IGNORE INTO `#__rsform_config` (`SettingName`, `SettingValue`) VALUES('cc.username', '');
INSERT IGNORE INTO `#__rsform_config` (`SettingName`, `SettingValue`) VALUES('cc.password', '');
INSERT IGNORE INTO `#__rsform_config` (`SettingName`, `SettingValue`) VALUES('cc.key', '');

CREATE TABLE IF NOT EXISTS `#__rsform_constantcontact` (
  `form_id` int(11) NOT NULL,
  `cc_list_id` varchar(255) NOT NULL,
  `cc_action` tinyint(1) NOT NULL,
  `cc_action_field` varchar(255) NOT NULL,
  `cc_merge_vars` text NOT NULL,
  `cc_email_type` varchar(32) NOT NULL,
  `cc_email_type_field` varchar(255) NOT NULL,
  `cc_delete_member` tinyint(1) NOT NULL,
  `cc_published` tinyint(1) NOT NULL,
  PRIMARY KEY (`form_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;