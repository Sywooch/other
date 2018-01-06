<?php
/**
* @version      2.7.0 12.11.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined('_JEXEC') or die('Restricted access');
error_reporting(error_reporting() & ~E_NOTICE);

if (!file_exists(JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS.'jshopping.php')){
    JError::raiseError(500,"Please install component \"joomshopping\"");
} 

require_once (JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS."lib".DS."factory.php"); 
require_once (JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS."lib".DS."functions.php");        
JSFactory::loadCssFiles();
JSFactory::loadLanguageFile();
$jshopConfig = JSFactory::getConfig();
    
$lang = JSFactory::getLang();
$name = $lang->get("name");

$count = $params->get('count');
$count = $count > 5 ? 5 : $count;

$db = JFactory::getDBO();
$mm = 'SELECT MAX(hits) as m1, MIN(hits) as m2 FROM `#__jshopping_products`;';
$db->setQuery($mm);
$mm = $db->loadAssoc($mm);
$h = ($mm['m1'] - $mm['m2']) / $count;

$sizes[] = '1';
$sizes[] = '2';
$sizes[] = '3';
$sizes[] = '4';
$sizes[] = '5';
$sizes[] = '6';

$lim = $params->get('lim');

$query = "SELECT prod.`".$lang->get('name')."` as name, prod.product_id, pr_cat.category_id, prod.hits, prod.product_quantity
                  FROM `#__jshopping_products` AS prod
                  INNER JOIN `#__jshopping_products_to_categories` AS pr_cat ON pr_cat.product_id = prod.product_id
                  LEFT JOIN `#__jshopping_categories` AS cat ON pr_cat.category_id = cat.category_id
                  WHERE prod.product_publish = '1' AND cat.category_publish='1' 
                  GROUP BY prod.product_id ORDER BY RAND() LIMIT ".$lim;

$db->setQuery($query);
$product = $db->loadObjectList();

require(JModuleHelper::getLayoutPath('mod_jshopping_tag'));		
?>