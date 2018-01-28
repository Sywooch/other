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
 * Администрирование модуля "Голосование"
 */

/**
 * Подключает редактирование списка вопросов или ответов
 */
function inc_file_votes($diafan)
{
	if ($diafan->cat)
	{
		include ABSOLUTE_PATH."modules/votes/admin/votes.admin.element.php";
		return 'Votes_admin_element';
	}
	else
	{
		include ABSOLUTE_PATH."modules/votes/admin/votes.admin.category.php";
		return 'Votes_admin_category';
	}
}