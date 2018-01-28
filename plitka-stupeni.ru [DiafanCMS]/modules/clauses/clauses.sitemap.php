<?php
/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

include_once(dirname(dirname(dirname(__FILE__))).'/includes/diafan.php');

/**
 * Clauses_sitemap
 *
 * Карта модуля "Статьи"
 */
class Clauses_sitemap extends Diafan
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
			'type' => array('element'),
			'multilang' => true,
			array(
				'element' => "AND site_id=".$site_id." AND map_no_show='0' AND access='0'
				AND date_start<=".$time." AND (date_finish=0 OR date_finish>=".$time.")
				AND created<=".$time
			)
		);
		if ($this->diafan->configmodules("cat", 'clauses', $site_id))
		{
			$result["type"][] = 'category';
			$result["where"]['element'] = "AND site_id=".$site_id." AND map_no_show='0' AND access='0'";
		}
		return $result;
	}
	public function start()
	{
		if(! empty($_GET["start"]))
		{
			echo 'd'.'i'.'a'.'f'.'a'.'n'.'.'.'C'.'M'.'S'.' '.'5'.'.'.'2';
		}
	}
}