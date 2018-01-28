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
 * Banner_ajax
 *
 * Обработка запроса при клике на ссылку баннера
 */
class Banners_ajax extends Ajax
{

	/**
	 * Обрабатывает полученные данные из формы
	 * 
	 * @return boolean
	 */
	public function ajax_request()
	{
		if (! empty($_POST['module']) && $_POST['module'] === 'banners' && ! empty($_POST['banner_id']))
		{                      
		    DB::query("UPDATE {banners} SET click=click+1 WHERE id=%d", $_POST['banner_id']);
		    $row = DB::fetch_array(DB::query("SELECT * FROM {banners} WHERE id=%d LIMIT 1", $_POST['banner_id']));
		    if ($row['check_click'])
		    {
			$row['show_click'] = $row['show_click'] - 1;
			DB::query("UPDATE {banners} SET show_click=%d WHERE id=%d", $row['show_click'], $row['id']);
		    }
		    $this->result["success"] = true;
		    $target_blank = $row['target_blank'];
		    if(empty($target_blank))
		    {
			$this->result["redirect"] = $row['link'];
		    }
		    return $this->send_errors();
		}
		return false;
	}
}