<?php
/**
 * Генерирование изображения каптчи
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

if(defined('RECAPTCHA') && RECAPTCHA)
{
	include_once(ABSOLUTE_PATH.'includes/404.php');
}

include_once ABSOLUTE_PATH.'plugins/kcaptcha/kcaptcha.php';

$chaptcha = new KCAPTCHA();

$_SESSION["captcha"][substr($_GET["rewrite"], 0, -4)][substr($_GET["rewrite"], -4)] = $chaptcha->getKeyString();

exit;