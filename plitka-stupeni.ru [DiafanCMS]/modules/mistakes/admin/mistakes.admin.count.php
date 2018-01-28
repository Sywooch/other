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
 * Mistakes_admin_count
 *
 * Количество ошибок на сайте
 */
class Mistakes_admin_count extends Diafan
{
	/**
	 * Возвращает количество добавленных через форму ошибок на сайте
	 * @return integer
	 */
	public function count()
	{
		$count = DB::query_result("SELECT COUNT(*) FROM {mistakes}");
		return $count;
	}
}