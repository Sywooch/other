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
 * Feedback_admin_count
 *
 * Количество неотвеченных сообщений из формы обратной связи для меню административной панели
 */
class Feedback_admin_count extends Diafan
{
	/**
	 * Возвращает количество неотвеченных сообщений из формы обратной связи для меню административной панели
	 * @param integer $site_id страница сайта, к которой прикреплен модуль
	 * @return integer
	 */
	public function count($site_id)
	{
		$count = DB::query_result("SELECT COUNT(*) FROM {feedback} WHERE text='' AND trash='0'".($site_id ? " AND site_id=".$site_id : ""));
		return $count;
	}
}