<?php

  defined('_JEXEC') or die('Restricted access');

  require_once (dirname(__FILE__) . DS . 'helper.php');
  require (JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_datsogallery' . DS . 'config.datsogallery.php');

  $menu 	 = &JSite::getMenu();
  $ids	 = $menu->getItems('link', 'index.php?option=com_datsogallery');
  $itemid    = isset($ids[0]) ? '&Itemid='.$ids[0]->id : '';

  $items     = ModDatsoGalleryUltimateHelper::getItems($params);

  require (JModuleHelper::getLayoutPath('mod_datsogallery_ultimate'));