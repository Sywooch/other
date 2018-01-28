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
    include(dirname(dirname(dirname(__FILE__))).'/includes/404.php');
}

/**
 * Users
 *
 * Модуль "Пользователи"
 */
class Users extends Controller
{
	/**
	 * Статистика пользователей на сайте
	 * 
	 * Шаблонный тег <insert name="show_block" module="users">:
	 * выводит статистику пользователей на сайте
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_block($attributes)
	{
		$attributes = $this->get_attributes($attributes, 'template');

		Customization::inc('modules/users/users.model.php');
		$model = new Users_model($this->diafan);
		$result = $model->show_block();
		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_block_'.$attributes["template"], 'users', $result))
		{
			$this->diafan->_tpl->get('show_block', 'users', $result);
		}
	}
}
