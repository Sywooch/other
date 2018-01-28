<?php
/**
 * @package    Diafan.CMS
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
 * Site
 *
 * Контроллер модуля "Страницы сайта"
 */
class Site extends Controller
{
	/**
	 * Шаблонный тег <insert name="show_block" module="site" id="номер_страницы" [template="шаблон"]>:
	 * выводит блок на сайте
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_block($attributes)
	{
		$attributes = $this->get_attributes($attributes, 'id', 'template');

		$attributes["id"] = intval($attributes["id"]);

		Customization::inc('modules/site/site.model.php');
		$model = new Site_model($this->diafan);
		$result = $model->show_block($attributes["id"]);
		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_block_'.$attributes["template"], 'site', $result))
		{
			$this->diafan->_tpl->get('show_block', 'site', $result);
		}
	}
	


	/**
	 * Шаблонный тег <insert name="show_links" module="site" [template="шаблон"]>:
	 * выводит ссылки на страницы нижнего уровня, принадлежащие текущей странице
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_links($attributes)
	{
		$attributes = $this->get_attributes($attributes, 'template');

		Customization::inc('modules/site/site.model.php');
		$model = new Site_model($this->diafan);
		$result = $model->show_links();
		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_links_'.$attributes["template"], 'site', $result))
		{
			$this->diafan->_tpl->get('show_links', 'site', $result);
		}
	}

	/**
	 * Шаблонный тег <insert name="show_previous_next" module="site" [template="шаблон"]>:
	 * выводит ссылки на предыдующую и следующую страницы
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_previous_next($attributes)
	{
		$attributes = $this->get_attributes($attributes, 'template');

		Customization::inc('modules/site/site.model.php');
		$model = new Site_model($this->diafan);
		$result = $model->show_previous_next();
		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_previous_next_'.$attributes["template"], 'site', $result))
		{
			$this->diafan->_tpl->get('show_previous_next', 'site', $result);
		}
	}

	/**
	 * Шаблонный тег <insert name="show_images" module="site" [template="шаблон"]>:
	 * выводит изображения, прикрепленные к странице сайта
	 * (если в конфигурации модуля «Страницы сайта» включен параметры «Использовать изображения»)
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_images($attributes)
	{
		if (! $this->diafan->configmodules('images', 'site'))
		{
			return;
		}
		$attributes = $this->get_attributes($attributes, 'template');

		Customization::inc('modules/site/site.model.php');
		$model = new Site_model($this->diafan);
		$result = $model->show_images();
		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_images_'.$attributes["template"], 'site', $result))
		{
			$this->diafan->_tpl->get('show_images', 'site', $result);
		}
	}

	/**
	 * Шаблонный тег <insert name="show_comments" module="site" [template="шаблон"]>:
	 * выводит комментарии, прикрепленные к странице сайта
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_comments($attributes)
	{
		if ($this->diafan->module)
		{
			return;
		}
		$attributes = $this->get_attributes($attributes, 'template');

		$result = $this->diafan->_comments->get($this->diafan->cid, 'site');
		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_comments_'.$attributes["template"], 'site', $result))
		{
			$this->diafan->_tpl->get('show_comments', 'site', $result);
		}
	}

	/**
	 * Шаблонный тег <insert name="show_tags" module="site" [template="шаблон"]>:
	 * выводит теги (слова-якори), прикрепленные к странице сайта (если в конфигурации модуля «Страницы сайты» подключены теги)
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_tags($attributes)
	{
		$attributes = $this->get_attributes($attributes, 'template');

		$result = $this->diafan->_tags->get($this->diafan->cid, "site");
		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_tags_'.$attributes["template"], 'site', $result))
		{
			$this->diafan->_tpl->get('show_tags', 'site', $result);
		}
	}
}