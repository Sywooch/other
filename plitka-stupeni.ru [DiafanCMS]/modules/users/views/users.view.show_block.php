<?php
/**
 * Статистика пользователей на сайте
 * 
 * Шаблон
 * шаблонного тега <insert name="show_block" module="users">:
 * выводит статистику пользователей на сайте
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

if (! $result)
{
	return;
}
echo '<div class="show_users">'.$this->diafan->_('Сейчас на сайте: %s гостей, %s пользователей.', true, $result["count_user"], $result["count_user_auth"]).'</div>';
