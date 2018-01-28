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
 * Администрирование модуля "Форум"
 */

/**
 * Подключает редактирование списка категорий или сообщений
 */
function inc_file_forum($diafan)
{
	if ($diafan->cat)
	{
		Customization::inc("modules/forum/admin/forum.admin.element.php");
		return 'Forum_admin_element';
	}
	else
	{
		Customization::inc("modules/forum/admin/forum.admin.category.php");
		return 'Forum_admin_category';
	}
}