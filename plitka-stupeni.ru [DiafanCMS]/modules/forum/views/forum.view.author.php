<?php
/**
 * Информация об авторе
 *
 * Шаблон вывода информации о пользователе
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
    include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

if (is_array($result))
{
	$text = $result["fio"].($result["name"] ? ' ('.$result["name"].')' : '');
	if (!empty($result["user_page"]))
	{
		$text = '<a href="'.$result["user_page"].'">'.$text.'</a>';
	}
}
else
{
	$text = $result;
}
return $text;