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
 * Rating_inc
 *
 * Подключение модуля "Рейтинг"
 */
class Rating_inc extends Model
{
	/**
	 * Показывает рейтинг для элемента
	 *
	 * @param integer $element_id номер элемента модуля
	 * @param string $module_name название модуля
	 * @param integer $site_id страница сайта, к которой прикреплен элемент
	 * @param boolean $is_category это категория
	 * @return string
	 */
	function get($element_id = 0, $module_name = '', $site_id = 0, $is_category = false)
	{
		$module_name = ! $module_name ? $this->diafan->module : $module_name;
		$site_id = ! $site_id ? $this->diafan->cid : $site_id;
		$element_id = ! $element_id ? ($is_category ? $this->diafan->cat : $this->diafan->show) : $element_id;

		if(! $this->diafan->configmodules("rating".($is_category ? "_cat" : ""), $module_name))
		{
			return false;
		}

		$this->result["module_name"] = $module_name.($is_category ? "_category" : "");
		$this->result["element_id"]  = $element_id;
		
		$this->result["rating"] = round(DB::query_result("SELECT rating FROM {rating} WHERE element_id=%d AND module_name='%s' AND trash='0' LIMIT 1", $element_id, $this->result["module_name"]));

		$this->result["disabled"] = false;

		if ($this->diafan->configmodules('only_user', 'rating') && ! $this->diafan->_user->id)
		{
			$this->result["disabled"] = true;
		}

		if (session_id() && $this->diafan->configmodules('security', 'rating') == 3
		   && DB::query_result("SELECT id FROM {log_note} WHERE session_id='%s'"
				       ." AND element_id=%d AND module_name='%s' AND include_name='rating' LIMIT 1",
				       $this->diafan->configmodules('security_user', 'rating') ? $this->diafan->_user->id : session_id(),
					   $element_id, $this->result["module_name"])
		   )
		{
			$this->result["disabled"] = true;
		}

		if (session_id() && $this->diafan->configmodules('security', 'rating') == 4
		   && ! empty($_SESSION["rating"][$this->result["element_id"].$this->result["module_name"]]))
		{
			$this->result["disabled"] = true;
		}

		return $this->diafan->_tpl->get('get', 'rating', $this->result);
	}
}