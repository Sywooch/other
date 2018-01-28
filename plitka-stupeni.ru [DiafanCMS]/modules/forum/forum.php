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
 * Forum
 *
 * Контроллер модуля "Форум"
 */
class Forum extends Controller
{
	/**
	 * Инициализация модуля
	 * 
	 * @return void
	 */
	public function init()
	{
		$this->rewrite_variable_names = array('add', 'show', 'cat', 'edit', 'page');

		$model = new Forum_model($this->diafan);

		if ($this->diafan->add)
		{
			$this->result = $model->add();	
		}
		elseif ($this->diafan->show)
		{
			$this->result = $model->id();	
		}
		elseif ($this->diafan->edit)
		{
			$this->result = $model->edit();	
		}
		elseif (! empty($_GET["block_id"]) || ! empty($_GET["unblock_id"]))
		{
			return $model->block_id();	
		}
		elseif (! empty($_GET["prior_id"]))
		{
			return $model->prior_id();	
		}
		elseif (! empty($_GET["close_id"]))
		{
			return $model->close_id();	
		}
		elseif (! empty($_GET["searchword"]))
		{
			$this->result = $model->list_search();	
		}
		elseif (! empty($_GET["new"]) && $this->diafan->_user->id)
		{
			$this->result = $model->list_new();	
		}
		elseif ($this->diafan->cat)
		{
			$this->result = $model->list_category();	
		}
		else
		{
			$this->result = $model->first_page();	
		}
	}

	/**
	 * Выводит контент модуля
	 * 
	 * @return void
	 */
	public function show_module()
	{
		if ($this->diafan->add || $this->diafan->edit)
		{
			$this->diafan->_tpl->get('edit', 'forum', $this->result);
		}
		elseif ($this->diafan->show)
		{
			$this->diafan->_tpl->get('id', 'forum', $this->result);
		}
		elseif (! empty($_GET["new"]) && $this->diafan->_user->id)
		{
			$this->diafan->_tpl->get('list_new', 'forum', $this->result);
		}
		elseif (! empty($_GET["searchword"]))
		{
			$this->diafan->_tpl->get('list_search', 'forum', $this->result);
		}
		elseif ($this->diafan->cat)
		{
			$this->diafan->_tpl->get('list_category', 'forum', $this->result);
		}
		else
		{
			$this->diafan->_tpl->get('first_page', 'forum', $this->result);
		}
	}

	/**
	 * Шаблонная функция: блок тем
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_block($attributes)
	{
		$attributes = $this->get_attributes($attributes, 'count', 'template', 'cat_id');

		$count  = $attributes["count"] ? intval($attributes["count"]) : 3;
		$cat_id = intval($attributes["cat_id"]);

		Customization::inc('modules/forum/forum.model.php');
		$model = new Forum_model($this->diafan);
		$result = $model->show_block($count, $cat_id);
		if(! $result)
			return;

		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_block_'.$attributes["template"], 'forum', $result))
		{
			$this->diafan->_tpl->get('show_block', 'forum', $result);
		}
	}

	/**
	 * Шаблонная функция: блок похожих тем
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_block_rel($attributes)
	{
		$attributes = $this->get_attributes($attributes, 'count', 'template', 'cat_id');

		$count  = $attributes["count"] ? intval($attributes["count"]) : 3;
		$cat_id = $attributes["cat_id"] == "all" ? "all" : "current";

		if ($this->diafan->module != "forum" || ! $this->diafan->show)
			return;

		Customization::inc('modules/forum/forum.model.php');
		$model = new Forum_model($this->diafan);
		$result = $model->show_block_rel($count, $cat_id);
		if(! $result)
			return;

		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_block_rel_'.$attributes["template"], 'forum', $result))
		{
			$this->diafan->_tpl->get('show_block_rel', 'forum', $result);
		}
	}
}