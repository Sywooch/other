<?php
/**
 * Подтверждение/опровержение платежа
 *
 * Шаблон подтверждения/опровержения платежа
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

$text = $result["text"];
if(! empty($result["redirect"]))
{
	$text .= '<form action="'.$result["redirect"].'" method="get"><span class="button_wrap"><input class="button" type="submit" value="'.$this->diafan->_('Оформить', false).'"></form>';
}
return $text;