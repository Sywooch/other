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
 * Импорт/экспорт данных в модуле "Магазин"
 */

/**
 * Подключает редактирование списка категорий или полей
 */
function inc_file_shop($diafan)
{
	if ($diafan->cat)
	{
		Customization::inc("modules/shop/admin/shop.admin.importexport.element.php");
		return 'Shop_admin_importexport_element';
	}
	else
	{
		Customization::inc("modules/shop/admin/shop.admin.importexport.category.php");
		return 'Shop_admin_importexport_category';
	}
}