<?php
/**
 * Список комментариев
 *
 * Шаблон вывода комментариев
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

$text = '';
foreach ($result as $row)
{
	$text .= $this->get('id', 'comments', $row);
}
return $text;