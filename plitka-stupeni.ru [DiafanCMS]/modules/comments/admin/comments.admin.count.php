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
 * Comments_admin_count
 *
 * Количество непроверенных коммментариев, если подключено модерирование комментариев, для меню административной панели
 */
class Comments_admin_count extends Diafan
{
	/**
	 * Возвращает непроверенных коммментариев, если подключено модерирование комментариев, для меню административной панели
	 * @return integer
	 */
	public function count()
	{
		if($this->diafan->configmodules("security_moderation", "comments"))
		{
			$count = DB::query_result("SELECT COUNT(*) FROM {comments} WHERE act='0' AND trash='0'");
			return $count;
		}
		return 0;
	}
}