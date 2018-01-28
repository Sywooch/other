<?php
/**
 * Обрабатывает полученные данные из формы
 * 
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

class Mistakes_ajax extends Ajax
{
	/**
	 * Обрабатывает полученные данные из формы
	 * 
	 * @return boolean
	 */
	public function ajax_request()
	{
		if (! empty($_POST['module']) && $_POST['module'] === 'mistakes' && ! empty($_POST["url"]))
		{
			DB::query("INSERT INTO {mistakes} (created, `url`, selected_text, `comment`) VALUES (%d, '%h', '%h', '%h')", time(), $_POST['url'], $_POST['selected_text'], $_POST['comment']);
			$this->result["success"] = true;
			$this->result["form"] = $this->diafan->_('Спасибо! В ближайшее время мы обработаем ваш запрос.', false);
			return $this->send_errors();
		}
		return false;
	}
}