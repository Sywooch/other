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
 * News_ajax
 *
 * Обработка Ajax-запросов
 */
class News_ajax extends Ajax
{
	/**
	 * Обрабатывает полученные данные из формы
	 * 
	 * @return boolean
	 */
	public function ajax_request()
	{
		if (! empty($_POST['module']) && $_POST['module'] == 'news')
		{
			if(empty($_POST["action"]) || $_POST["action"] != 'calendar_arrow')
			{
				return false;
			}
			if(empty($_POST["arrow"]) || !in_array($_POST["arrow"], array("prev", "next")) || empty($_POST["site_id"]) || empty($_POST["year"]) || empty($_POST["month"]))
			{
				return false;
			}
			$_POST["year"] = intval($_POST["year"]);
			$_POST["month"] = intval($_POST["month"]);
			if($_POST["year"] < 1970 || $_POST["year"] > 2100 || $_POST["month"] < 0 || $_POST["month"] > 12)
			{
				return false;
			}
			if($_POST["arrow"] == "prev")
			{
				if($_POST["month"] == 1)
				{
					$_POST["year"]--;
					$_POST["month"] = 12;
				}
				else
				{
					$_POST["month"]--;
				}
			}
			else
			{
				if($_POST["month"] == 12)	
				{
					$_POST["year"]++;
					$_POST["month"] = 1;
				}
				else
				{
					$_POST["month"]++;
				}
			}
			$template = preg_replace('/[^0-9a-z_]+/', '', $_POST["template"]);
			Customization::inc('modules/news/news.model.php');
			$model  = new News_model($this->diafan);
			$result = $model->show_calendar("day", intval($_POST["site_id"]), intval($_POST["cat_id"]), $template, $_POST["month"], $_POST["year"]);
			if (! $result)
			{
				return false;
			}

			$text = '';
			if (! $template || ! $text = $this->diafan->_tpl->get('show_calendar_day_'.$template, 'news', $result))
			{
				$text = $this->diafan->_tpl->get('show_calendar_day', 'news', $result);
			}
			echo $text;
			exit;
		}
		return false;
	}
}