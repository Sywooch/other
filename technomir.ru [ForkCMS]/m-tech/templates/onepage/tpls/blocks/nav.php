<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$menualign = $this->params->get('menualign', 'zenleft');
$app = JFactory::getApplication();
$menu = $app->getMenu();
$lang = JFactory::getLanguage();
$hide_mainbody = (!$this->params->get("ZEN_MAINBODY_DISABLED",true)==false && ($menu->getActive() == $menu->getDefault( $lang->getTag() )));

?>