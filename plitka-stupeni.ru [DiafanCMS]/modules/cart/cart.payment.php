<?php
/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

/**
 * Работа с платежными системами
 */
$rewrite_array = explode('/', $_GET["rewrite"]);

if(file_exists(ABSOLUTE_PATH.'modules/cart/payment/'.$rewrite_array[0].'/cart.payment.'.$rewrite_array[0].'.php'))
{
	include ABSOLUTE_PATH.'modules/cart/payment/'.$rewrite_array[0].'/cart.payment.'.$rewrite_array[0].'.php';
	exit;
}
else
{
	include ABSOLUTE_PATH.'includes/404.php';
}