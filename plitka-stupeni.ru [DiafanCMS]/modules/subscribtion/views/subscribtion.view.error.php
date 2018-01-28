<?php
/**
 * Информационное сообщение
 *
 * Шаблон страницы с информационным сообщением в модуле "Рассылки"
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

echo '<p>'.$this->diafan->_('Не верный код доступа.').'</p>';