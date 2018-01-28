<?php
/**
 * @package		AdsManager
 * @copyright	Copyright (C) 2010-2012 JoomPROD.com. All rights reserved.
 * @license		GNU/GPL
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.filesystem.file' );

if(!file_exists(JPATH_SITE . "/images/com_adsmanager/")){
	JFolder::create(JPATH_SITE. "/images/com_adsmanager/");
};

if(!file_exists(JPATH_SITE. "/images/com_adsmanager/categories/")){
	JFolder::create(JPATH_SITE. "/images/com_adsmanager/categories/");
};

if(!file_exists(JPATH_SITE. "/images/com_adsmanager/ads/")){
	JFolder::create(JPATH_SITE. "/images/com_adsmanager/ads/");
};

if(!file_exists(JPATH_SITE. "/images/com_adsmanager/ads/tmp")){
	JFolder::create(JPATH_SITE. "/images/com_adsmanager/ads/tmp");
};

if(!file_exists(JPATH_SITE. "/images/com_adsmanager/email/")){
	JFolder::create(JPATH_SITE. "/images/com_adsmanager/email/");
};

if(!file_exists(JPATH_SITE. "/images/com_adsmanager/files/")){
	JFolder::create(JPATH_SITE. "/images/com_adsmanager/files/");
};

if(!file_exists(JPATH_SITE. "/images/com_adsmanager/fields/")){
	JFolder::create(JPATH_SITE. "/images/com_adsmanager/fields/");
};

if(!file_exists(JPATH_SITE. "/images/com_adsmanager/plugins/")){
	JFolder::create(JPATH_SITE. "/images/com_adsmanager/plugins/");
};


if(!file_exists(JPATH_SITE . "/images/com_adsmanager/index.html")){
	JFile::copy(JPATH_SITE."/components/com_adsmanager/index.html",JPATH_SITE. "/images/com_adsmanager/index.html");
};

if(!file_exists(JPATH_SITE. "/images/com_adsmanager/categories/index.html")){
	JFile::copy(JPATH_SITE."/components/com_adsmanager/index.html",JPATH_SITE. "/images/com_adsmanager/categories/index.html");
};

if(!file_exists(JPATH_SITE. "/images/com_adsmanager/ads/index.html")){
	JFile::copy(JPATH_SITE."/components/com_adsmanager/index.html",JPATH_SITE. "/images/com_adsmanager/ads/index.html");
};

if(!file_exists(JPATH_SITE. "/images/com_adsmanager/ads/tmp/index.html")){
	JFile::copy(JPATH_SITE."/components/com_adsmanager/index.html",JPATH_SITE. "/images/com_adsmanager/ads/tmp/index.html");
};

if(!file_exists(JPATH_SITE. "/images/com_adsmanager/email/index.html")){
	JFile::copy(JPATH_SITE."/components/com_adsmanager/index.html",JPATH_SITE. "/images/com_adsmanager/email/index.html");
};

if(!file_exists(JPATH_SITE. "/images/com_adsmanager/files/index.html")){
	JFile::copy(JPATH_SITE."/components/com_adsmanager/index.html",JPATH_SITE. "/images/com_adsmanager/files/index.html");
};

if(!file_exists(JPATH_SITE. "/images/com_adsmanager/fields/index.html")){
	JFile::copy(JPATH_SITE."/components/com_adsmanager/index.html",JPATH_SITE. "/images/com_adsmanager/fields/index.html");
};

if(!file_exists(JPATH_SITE. "/images/com_adsmanager/plugins/index.html")){
	JFile::copy(JPATH_SITE."/components/com_adsmanager/index.html",JPATH_SITE. "/images/com_adsmanager/plugins/index.html");
};

$lang = JFactory::getLanguage();
$lang->load("com_adsmanager");

// Schema modification -- BEGIN

$db = JFactory::getDBO();

   
$db->setQuery("SELECT count(*) FROM `#__adsmanager_fields` WHERE 1");
$total = $db->loadResult();
if ($total == 0)
{
	$sql = " INSERT IGNORE INTO `#__adsmanager_columns` (`id`,`name`,`ordering`,`catsid`,`published`) VALUES "
	     . " (2, 'ADSMANAGER_PRICE', 1, 1,1), "
	     . " (3, 'ADSMANAGER_CITY', 2, 1,1), "
	     . " (5, 'ADSMANAGER_STATE', 1, 0,1);";
	$db->setQuery($sql);
	$result = $db->query();
	
	$sql = " UPDATE #__adsmanager_columns SET catsid = ',-1,'";
	$db->setQuery($sql);
	$result = $db->query();
	
	$sql = " INSERT IGNORE INTO `#__adsmanager_field_values` (`fieldvalueid`,`fieldid`,`fieldtitle`,`fieldvalue`,`ordering`,`sys`) VALUES "
	     . " (1, 8, 'ADSMANAGER_KINDOF2', 1, 1, 0), "
	     . " (2, 8, 'ADSMANAGER_KINDOF1', 2, 2, 0), "
	     . " (3, 9, 'ADSMANAGER_STATE_0', 4, 4, 0),"
	     . " (4, 8, 'ADSMANAGER_KINDOFALL', 0, 0, 0),"
		 . " (5, 9, 'ADSMANAGER_STATE_1', 3, 3, 0),"
		 . " (6, 9, 'ADSMANAGER_STATE_3', 1, 1, 0),"
		 . " (7, 9, 'ADSMANAGER_STATE_2', 2, 2, 0),"
		 . " (8, 9, 'ADSMANAGER_STATE_4', 0, 0, 0);";
	$db->setQuery($sql);
	$result = $db->query();

	$sql = " INSERT IGNORE INTO `#__adsmanager_fields` (`fieldid`, `name`, `title`, `description`, `type`, `maxlength`, `size`, `required`, `ordering`, `cols`, `rows`, `columnid`, `columnorder`, `pos`, `posorder`, `profile`, `cb_field`, `sort`, `sort_direction`, `published`) VALUES "
		 . "(1, 'name', 'ADSMANAGER_FORM_NAME', '', 'text', 50, 35, 1, 0, 0, 0, -1, 5, 5, 1, 1, 41, 0, 'DESC', 1),"
		 . "(2, 'email', 'ADSMANAGER_FORM_EMAIL', '', 'emailaddress', 50, 35, 1, 1, 0, 0, -1, 10, 5, 4, 1, 50, 0, 'DESC', 1),"
		 . "(3, 'ad_city', 'ADSMANAGER_FORM_CITY', '', 'text', 50, 35, 0, 4, 0, 0, 3, 1, 5, 3, 1, 59, 1, 'ASC', 1),"
		 . "(4, 'ad_zip', 'ADSMANAGER_FORM_ZIP', '', 'text', 6, 7, 0, 3, 0, 0, -1, 0, 5, 2, 1, -1, 0, 'ASC', 1),"
		 . "(5, 'ad_headline', 'ADSMANAGER_FORM_AD_HEADLINE', '', 'text', 60, 35, 1, 5, 0, 0, -1, 0, 1, 1, 0, -1, 0, 'DESC', 1),"
		 . "(6, 'ad_text', 'ADSMANAGER_FORM_AD_TEXT', '', 'textarea', 500, 0, 1, 6, 40, 20, -1, 0, 3, 1, 0, -1, 0, 'DESC', 1),"
		 . "(7, 'ad_phone', 'ADSMANAGER_FORM_PHONE1', '', 'number', 50, 35, 0, 2, 0, 0, -1, 0, 5, 1, 1, -1, 0, 'DESC', 1),"
		 . "(8, 'ad_kindof', 'ADSMANAGER_FORM_KINDOF', '', 'select', 0, 0, 1, 7, 0, 0, 5, 0, 2, 1, 0, -1, 0, 'DESC', 1),"
		 . "(9, 'ad_state', 'ADSMANAGER_FORM_STATE', '', 'select', 0, 0, 1, 8, 0, 0, 5, 0, 2, 1, 0, -1, 0, 'DESC', 1),"
		 . "(10, 'ad_price', 'ADSMANAGER_FORM_AD_PRICE', '', 'price', 10, 7, 1, 9, 0, 0, 2, 0, 4, 1, 0, -1, 1, 'DESC', 1);";	
	$db->setQuery($sql);
	$result = $db->query();
	
	$sql = " UPDATE #__adsmanager_fields SET catsid = ',-1,'";
	$db->setQuery($sql);
	$result = $db->query();
	
	$sql = " INSERT IGNORE INTO `#__adsmanager_positions` (`id`,`name`,`title`) VALUES "
		 . " (1, 'top', 'ADSMANAGER_POSITION_TOP'),"	
		 . " (2, 'subtitle', 'ADSMANAGER_POSITION_SUBTITLE'),"
		 . " (3, 'description', 'ADSMANAGER_POSITION_DESCRIPTION'),"
		 . " (4, 'description2', 'ADSMANAGER_POSITION_DESCRIPTION2'),"
		 . " (5, 'contact', 'ADSMANAGER_POSITION_CONTACT');";
	$db->setQuery($sql);
	$result = $db->query();
	
	$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_ads` ADD `name` TEXT DEFAULT NULL;");
	$result = $db->query();
	
	$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_ads` ADD `ad_zip` TEXT DEFAULT NULL;");
	$result = $db->query();
	
	$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_ads` ADD `ad_city` TEXT DEFAULT NULL;");
	$result = $db->query();
	
	$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_ads` ADD `ad_phone` TEXT DEFAULT NULL;");
	$result = $db->query();
	
	$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_ads` ADD `email` TEXT DEFAULT NULL;");	
	$result = $db->query();
	
	$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_ads` ADD `ad_kindof` TEXT DEFAULT NULL;");	
	$result = $db->query();
	
	$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_ads` ADD `ad_headline` TEXT DEFAULT NULL;");	
	$result = $db->query();
	
	$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_ads` ADD `ad_text` TEXT DEFAULT NULL;");	
	$result = $db->query();
	
	$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_ads` CHANGE `ad_state` `ad_state` TEXT DEFAULT NULL;");	
	$result = $db->query();
	
	$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_ads` ADD `ad_price` TEXT DEFAULT NULL;");	
	$result = $db->query(); 
	   
	$db->setQuery("ALTER IGNORE TABLE `#__adsmanager_profile` ADD `name` TEXT DEFAULT NULL;");   
	$result = $db->query();
	
	$db->setQuery("ALTER IGNORE TABLE  `#__adsmanager_profile` ADD `ad_zip` TEXT DEFAULT NULL;");	
	$result = $db->query();
	
	$db->setQuery("ALTER IGNORE TABLE `#__adsmanager_profile` ADD `ad_city` TEXT DEFAULT NULL;");	
	$result = $db->query();
	
	$db->setQuery("ALTER IGNORE TABLE `#__adsmanager_profile` ADD `ad_phone` TEXT NOT NULL;");	
	$result = $db->query();
	
	$sql = " INSERT IGNORE INTO `#__adsmanager_categories` (`id`,`parent`,`name`,`published`) VALUES "
		 . " (1, 0,'Category 1', 1),"	
		 . " (2, 0,'Category 2', 1),"
		 . " (3, 1,'SubCat1', 1),"
		 . " (4, 1,'SubCat2', 1),"
		 . " (5, 1,'SubCat3', 1),"
		 . " (6, 2,'SubCat4', 1),"
		 . " (7, 2,'SubCat5', 1),"
		 . " (8, 2,'SubCat6', 1);";
	$db->setQuery($sql);
	$result = $db->query();
}

$db->setQuery("ALTER IGNORE TABLE `#__adsmanager_fields` CHANGE `catsid` `catsid` TEXT NOT NULL;");	
$result = $db->query();
$db->setQuery("ALTER IGNORE TABLE `#__adsmanager_columns` CHANGE `catsid` `catsid` TEXT NOT NULL;");	
$result = $db->query();
$db->setQuery("ALTER IGNORE TABLE `#__adsmanager_ads` CHANGE `date_created` `date_created` DATETIME NOT NULL;");	
$result = $db->query();

$db->setQuery("ALTER IGNORE TABLE  `#__adsmanager_config` ADD `bannedwords` TEXT DEFAULT NULL;");	
$result = $db->query();
	
$db->setQuery("ALTER IGNORE TABLE  `#__adsmanager_config` ADD `replaceword` TEXT DEFAULT NULL;");	
$result = $db->query();

$db->setQuery("ALTER IGNORE TABLE  `#__adsmanager_config` ADD `after_expiration` TEXT DEFAULT NULL;");	
$result = $db->query();
	
$db->setQuery("ALTER IGNORE TABLE  `#__adsmanager_config` ADD `archive_catid` INT(10) NOT NULL default '1';");	
$result = $db->query();

$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_ads` ADD `metadata_description` TEXT DEFAULT NULL;");	
$result = $db->query();
	
$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_ads` ADD `metadata_keywords` TEXT DEFAULT NULL;");	
$result = $db->query();

$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_categories` ADD `metadata_description` TEXT DEFAULT NULL;");	
$result = $db->query();
	
$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_categories` ADD `metadata_keywords` TEXT DEFAULT NULL;");	
$result = $db->query();

$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_config` ADD `metadata_mode` TEXT DEFAULT NULL;");	
$result = $db->query();

$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_config` ADD `autocomplete` tinyint(1) default '1';");	
$result = $db->query();

$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_config` ADD `jquery` tinyint(1) default '1';");	
$result = $db->query();

$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_config` ADD `jqueryui` tinyint(1) default '1';");	
$result = $db->query();

$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_config` ADD `nb_last_cols` int(10) NOT NULL default '3';");	
$result = $db->query();
$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_config` ADD `nb_last_rows` int(10) NOT NULL default '1';");	
$result = $db->query();

$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_config` ADD `display_general_menu` tinyint(1) default '1';");	
$result = $db->query();
$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_config` ADD `display_list_sort` tinyint(1) default '1';");	
$result = $db->query();
$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_config` ADD `display_list_search` tinyint(1) default '1';");	
$result = $db->query();
$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_config` ADD `display_inner_pathway` tinyint(1) default '1';");	
$result = $db->query();
$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_config` ADD `display_front` tinyint(1) default '1';");	
$result = $db->query();

$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_config` ADD `send_email_on_new_to_user` tinyint(1) default '1';");	
$result = $db->query();
$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_config` ADD `send_email_on_update_to_user` tinyint(1) default '1';");	
$result = $db->query();
$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_config` ADD `send_email_on_validation_to_user` tinyint(1) default '1';");	
$result = $db->query();
$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_config` ADD `send_email_on_expiration_to_user` tinyint(1) default '1';");	
$result = $db->query();

$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_config` ADD `new_text` TEXT DEFAULT NULL;");	
$result = $db->query();
$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_config` ADD `update_text` TEXT DEFAULT NULL;");	
$result = $db->query();
$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_config` ADD `admin_new_text` TEXT DEFAULT NULL;");	
$result = $db->query();
$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_config` ADD `admin_update_text` TEXT DEFAULT NULL;");	
$result = $db->query();

$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_config` ADD `waiting_validation_text` TEXT DEFAULT NULL;");	
$result = $db->query();
$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_config` ADD `validation_text` TEXT DEFAULT NULL;");	
$result = $db->query();
$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_config` ADD `expiration_text` TEXT DEFAULT NULL;");	
$result = $db->query();

$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_config` ADD `new_subject` TEXT DEFAULT NULL;");	
$result = $db->query();
$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_config` ADD `update_subject` TEXT DEFAULT NULL;");	
$result = $db->query();

$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_config` ADD `admin_new_subject` TEXT DEFAULT NULL;");	
$result = $db->query();
$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_config` ADD `admin_update_subject` TEXT DEFAULT NULL;");	
$result = $db->query();

$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_config` ADD `waiting_validation_subject` TEXT DEFAULT NULL;");	
$result = $db->query();
$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_config` ADD `validation_subject` TEXT DEFAULT NULL;");	
$result = $db->query();
$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_config` ADD `expiration_subject` TEXT DEFAULT NULL;");	
$result = $db->query();
$db->setQuery(" ALTER IGNORE TABLE `#__adsmanager_config` ADD `recall_subject` TEXT DEFAULT NULL;");	
$result = $db->query();

$db->setQuery("INSERT IGNORE INTO `#__adsmanager_positions` VALUES (6, 'description3', 'ADSMANAGER_POSITION_DESCRIPTION3');");
$result = $db->query();

$db->setQuery(" CREATE TABLE IF NOT EXISTS `#__adsmanager_pending_ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `date` date NOT NULL,
  `content` text NOT NULL,
  `contentid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");
$result = $db->query();

$db->setQuery(" SELECT new_subject FROM `#__adsmanager_config` WHERE id=1;");
$new_subject = $db->loadResult();
if ($new_subject == null) {
	$queries = array();
	$queries[] = "UPDATE #__adsmanager_config SET new_subject = ".$db->Quote(JText::_('ADSMANAGER_NEW_SUBJECT_EXAMPLE'));
	$queries[] = "UPDATE #__adsmanager_config SET update_subject = ".$db->Quote(JText::_('ADSMANAGER_UPDATE_SUBJECT_EXAMPLE'));
	$queries[] = "UPDATE #__adsmanager_config SET expiration_subject = ".$db->Quote(JText::_('ADSMANAGER_EXPIRATION_SUBJECT_EXAMPLE'));
	$queries[] = "UPDATE #__adsmanager_config SET recall_subject = ".$db->Quote(JText::_('ADSMANAGER_RECALL_SUBJECT_EXAMPLE'));
	$queries[] = "UPDATE #__adsmanager_config SET waiting_validation_subject = ".$db->Quote(JText::_('ADSMANAGER_WAITING_VALIDATION_SUBJECT_EXAMPLE'));
	$queries[] = "UPDATE #__adsmanager_config SET validation_subject = ".$db->Quote(JText::_('ADSMANAGER_VALIDATION_SUBJECT_EXAMPLE'));
	$queries[] = "UPDATE #__adsmanager_config SET admin_new_subject = ".$db->Quote(JText::_('ADSMANAGER_ADMIN_NEW_SUBJECT_EXAMPLE'));
	$queries[] = "UPDATE #__adsmanager_config SET admin_update_subject = ".$db->Quote(JText::_('ADSMANAGER_ADMIN_UPDATE_SUBJECT_EXAMPLE'));
	
	$queries[] = "UPDATE #__adsmanager_config SET new_text = ".$db->Quote(JText::_('ADSMANAGER_NEW_TEXT_EXAMPLE'));
	$queries[] = "UPDATE #__adsmanager_config SET update_text = ".$db->Quote(JText::_('ADSMANAGER_UPDATE_TEXT_EXAMPLE'));
	$queries[] = "UPDATE #__adsmanager_config SET expiration_text = ".$db->Quote(JText::_('ADSMANAGER_EXPIRATION_TEXT_EXAMPLE'));
	$queries[] = "UPDATE #__adsmanager_config SET recall_text = ".$db->Quote(JText::_('ADSMANAGER_RECALL_TEXT_EXAMPLE'));
	$queries[] = "UPDATE #__adsmanager_config SET waiting_validation_text = ".$db->Quote(JText::_('ADSMANAGER_WAITING_VALIDATION_TEXT_EXAMPLE'));
	$queries[] = "UPDATE #__adsmanager_config SET validation_text = ".$db->Quote(JText::_('ADSMANAGER_VALIDATION_TEXT_EXAMPLE'));
	$queries[] = "UPDATE #__adsmanager_config SET admin_new_text = ".$db->Quote(JText::_('ADSMANAGER_ADMIN_NEW_TEXT_EXAMPLE'));
	$queries[] = "UPDATE #__adsmanager_config SET admin_update_text = ".$db->Quote(JText::_('ADSMANAGER_ADMIN_UPDATE_TEXT_EXAMPLE'));
	foreach($queries as $q) {
		$db->setQuery($q);
		$count = $db->query();
	}
}
$db->setQuery("SELECT * FROM #__adsmanager_config LIMIT 1");
$db->query();
$config = $db->loadObject();

$db->setQuery("ALTER IGNORE TABLE `#__adsmanager_ads` ADD `images` TEXT;");
$result = $db->query();

if ($config == null) {
	$db->setQuery(" INSERT IGNORE INTO `#__adsmanager_config` (`id`,`version`,`ads_per_page`,`max_image_size`,`max_width`,`max_height`,`max_width_t`,`max_height_t`,`root_allowed`,`nb_images`,"
			." `show_contact`,`send_email_on_new`,`send_email_on_update`,`auto_publish`,`tag`,`fronttext`,`comprofiler`,`email_display`,`rules_text`,"
			." `display_expand`,`display_last`,`display_fullname`,`expiration`,`ad_duration`,`recall`,`recall_time`,`recall_text`,`image_display`,"
			." `cat_max_width`,`cat_max_height`,`cat_max_width_t`,`cat_max_height_t`,`submission_type`,`nb_ads_by_user`,`allow_attachement`,"
			." `allow_contact_by_pms`, `show_rss` ,`nbcats` ,`show_new`,`nbdays_new`,`show_hot`,`nbhits`,`bannedwords`,`replaceword`,`after_expiration`,`archive_catid`,`metadata_mode`) VALUES "
			." (1, '3', 20, 2048000, 400, 300, 150, 100, 1,2,"
			."  1,1,1,1, 'joomprod.com', '<p align=\"center\"><strong>Welcome to Ads Section.</strong></p><p align=\"left\">The better place to sell or buy</p>',0,0,'Inform the users about the rules here...',"
			."  2,1,0,1,30,1,7,'Add This Text to recall message<br />','default',"
			."  150,150,30,30,0,-1,0,"
			."  0,0,1,1,5,1,100,'','****','delete','0','automatic')");
	$result = $db->query();
} else {
	$continue = true;
	while($continue) {
		$continue = false;
		switch($config->version) {
			case 3:
				break;
			case 2:
				$db->setQuery("ALTER IGNORE TABLE `#__adsmanager_ads` ADD `date_modified` DATETIME;");
				$db->query();
				
				$db->setQuery("UPDATE `#__adsmanager_ads` SET `date_modified` = `date_created`");
				$db->query();
				
				$obj = new stdClass();
				$obj->id = 1;
				$obj->version = 3;
				$db->updateObject('#__adsmanager_config', $obj,'id');
				
				$config->version = 3;
				$continue = true;
				break;
			default:
				$db->setQuery("SELECT id,images FROM `#__adsmanager_ads`");
				$ads = $db->loadObjectList("id");
				
				$imagefiles = scandir(JPATH_SITE."/images/com_adsmanager/ads/");
				$lists = array();
				sort($imagefiles);
				foreach($imagefiles as $imagefile) {
					if (preg_match("/([0-9]*)[a-z ]*_t.jpg/",$imagefile,$matches)) {
						$id = $matches[1];
						if (!isset($lists[$id]))
							$lists[$id] = array();
						$newimg = new stdClass();
						$newimg->index = count($lists[$id])+1;
						$newimg->image = str_replace('_t.jpg','.jpg',$imagefile);
						$newimg->thumbnail = $imagefile;
						$lists[$id][] = $newimg;
					}
				}
				
				foreach($lists as $id => $list) {
					$obj = new stdClass();
					$obj->id = $id;
					$obj->images = json_encode($list);
					$ret = $db->updateObject('#__adsmanager_ads', $obj,'id');
				}
				
				$app = JFactory::getApplication();
				$db->setQuery("SELECT count(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '".$app->getCfg('db')."' AND TABLE_NAME = '".$db->getPrefix()."adsmanager_fieldgmap'");
				$count = $db->loadResult();
				if ($count > 0) {
					$db->setQuery("SELECT fieldid,name FROM #__adsmanager_fields WHERE type='gmap'");
					$fields = $db->loadObjectList("fieldid");
				
					foreach($fields as $field) {
						$query = "ALTER IGNORE TABLE `#__adsmanager_ads` ADD `".$field->name."_lat` TEXT default NULL;";
						$db->setQuery($query);
						$db->query();
				
						$query = "ALTER IGNORE TABLE `#__adsmanager_ads` ADD `".$field->name."_lng` TEXT default NULL;";
						$db->setQuery($query);
						$db->query();
					}
				
					$db->setQuery("SELECT * FROM #__adsmanager_fieldgmap");
					$list = $db->loadObjectList();
					$fields = array();
					if ($list != null) {
						foreach($list as $item) {
							$name = $fields[$item->fieldid];
							$obj = new stdClass();
							$obj->id = $item->contentid;
							$lat = $name."_lat";
							$obj->$lat = $item->lat;
							$lng = $name."_lng";
							$obj->$lng = $item->lng;
							$db->updateObject('#__adsmanager_ads', $obj,'id');
						}
					}
					$db->setQuery("DROP TABLE #__adsmanager_fieldgmap");
					$db->query();
				}
				
				$app = JFactory::getApplication();
				$db->setQuery("SELECT count(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '".$app->getCfg('db')."' AND TABLE_NAME = '".$db->getPrefix()."adsmanager_youtube'");
				$count = $db->loadResult();
				if ($count > 0) {
					$db->setQuery("SELECT fieldid,name FROM #__adsmanager_fields WHERE type='youtube'");
					$fields = $db->loadObjectList("fieldid");
				
					foreach($fields as $field) {
						$query = "ALTER IGNORE TABLE `#__adsmanager_ads` ADD `".$field->name."` TEXT default NULL;";
						$db->setQuery($query);
						$db->query();
					}
				
					$db->setQuery("SELECT * FROM #__adsmanager_youtube");
					$list = $db->loadObjectList();
					if ($list != null) {
						foreach($list as $item) {
							$name = @$fields[$item->fieldid]->name;
							if ($name != null) {
								$obj = new stdClass();
								$obj->id = $item->contentid;
								$obj->$name = $item->key;
								$db->updateObject('#__adsmanager_ads', $obj,'id');
							}
						}
					}
					$db->setQuery("DROP TABLE #__adsmanager_youtube");
					$db->query();
				}
				
				$obj = new stdClass();
				$obj->id = 1;
				$obj->version = 2;
				$db->updateObject('#__adsmanager_config', $obj,'id');
				
				$config->version = 2;
				$continue = true;
		}	
	}
}
?>
<center>
<table width="100%" border="0">
   <tr>
      <td>
      Thank you for using AdsManager (joomprod.com)<br/>
	 <p>
		<em>webmaster@joomprod.com</em>
	 </p>
      </td>
      <td>
         <p>
            <br>
            <br>
            <br>
         </p>
      </td>
   </tr>
</table>
</center>