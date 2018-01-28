<?php
/**
* @package		Joomla & QuickForm
* @Copyright ((c) bigemot.ru
* @license    GNU/GPL
*/

defined('_JEXEC') or die;

require_once(JPATH_ADMINISTRATOR."/components/com_quickform/helpers/form.php");

$contents = new QuickForm((int)$params->get('id'));
echo $contents->getHTML();

