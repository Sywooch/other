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
 * Photo_sitemap
 *
 * Карта модуля "Фотогалерея"
 */
class Photo_sitemap extends Diafan
{
	/**
	 * Возвращает настройки для генерирования карты модуля
	 * 
	 * @param integer $site_id номер страницы сайта
	 * @return array
	 */
	public function config($site_id)
	{
		$time = mktime(23, 59, 0, date("m"), date("d"), date("Y"));
		$result = array(
			'type' => array(),
			'multilang' => true,
			'where' => array()
		);
		if ($this->diafan->configmodules("page_show", 'photo', $site_id))
		{
			$result["type"][] = 'element';
			$result["where"]['element'] = "AND site_id=".$site_id." AND map_no_show='0' AND access='0'
			AND date_start<=".$time." AND (date_finish=0 OR date_finish>=".$time.")";
		}
		if ($this->diafan->configmodules("cat", 'photo', $site_id))
		{
			$result["type"][] = 'category';
			$result["where"]['element'] = "AND site_id=".$site_id." AND map_no_show='0' AND access='0'";
		}
		return $result;
	}
}