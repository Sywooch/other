<?php
/**
 * Автор сообщения
 * 
 * Шаблон вывода информации о пользователе
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(dirname(__FILE__)))).'/includes/404.php';
}

if (! is_array($result))
{
	$text = $result;
	return $text;
}
$text = '';
if (! empty($result["avatar"]))
{
	$text .= '<img src="'.$result["avatar"].'" width="'.$result["avatar_width"].'" height="'.$result["avatar_height"].'" alt="'.$result["fio"].' ('.$result["name"].')" class="avatar"> ';
}
$name=$result["fio"].($result["name"] ? ' ('.$result["name"].')' : '');
if(!empty($result['user_page']))
	$name='<a href="'.$result['user_page'].'">'.$name.'</a>';
$text .= $name;

return $text;