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
	include(dirname(dirname(dirname(__FILE__))).'/includes/404.php');
}

/**
 * Votes
 *
 * Контроллер модуля "Опросы"
 */
class Votes extends Controller
{
	/**
	 * Шаблонная функция: опросы
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_block($attributes)
	{
		if ($this->diafan->configmodules('security_user', 'votes') && ! $this->diafan->_user->id)
			return;

		$attributes = $this->get_attributes($attributes, 'id', 'count', 'template');
		
		$id   = intval($attributes["id"]);
		if($attributes["count"] === "all")
		{
			$count = "all";
		}
		else
		{
			$count   = intval($attributes["count"]);
			if($count < 1)
			{
				$count = 1;
			}
		}

		Customization::inc('modules/votes/votes.model.php');
		$model = new Votes_model($this->diafan);
		$result = $model->show_block($id, $count);
		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_block_'.$attributes["template"], 'votes', $result))
		{
			$this->diafan->_tpl->get('show_block', 'votes', $result);
		}
	}
}