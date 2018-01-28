<?php
/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
    include(dirname(dirname(dirname(__FILE__))) . '/includes/404.php');
}

/**
 * Users_model
 *
 * Модель модуля "Пользователи"
 */
class Users_model extends Model
{
	/**
	 * Генерирует данные для
	 * шаблонного тега <insert name="show_block" module="users">:
	 * выводит статистику пользователей на сайте
	 * 
	 * @return array
	 */
	public function show_block()
	{
		$timestamp = time() - 900;
		$result["count_user"]      = DB::query_result("SELECT COUNT(session_id) FROM {sessions} WHERE user_id = 0 AND timestamp >= %d", $timestamp);
		$result["count_user_auth"] = DB::query_result("SELECT COUNT(session_id) FROM {sessions} WHERE user_id > 0 AND timestamp >= %d", $timestamp);
		return $result;
	}
}
