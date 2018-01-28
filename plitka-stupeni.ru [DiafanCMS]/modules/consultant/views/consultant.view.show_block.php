<?php
/**
 * On-line консультант
 * 
 * Шаблон
 * шаблонного тега <insert name="show_block" module="consultant">:
 * on-line консультант
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include(dirname(dirname(dirname(__FILE__))).'/includes/404.php');
}

if (empty($result))
{
	return false;
}

echo $result;