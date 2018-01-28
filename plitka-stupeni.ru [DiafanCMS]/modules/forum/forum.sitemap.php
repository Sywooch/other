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
 * Forum_sitemap
 *
 * Карта модуля "Форум"
 */
class Forum_sitemap extends Diafan
{
	/**
	 * Генерирует карту модуля
	 * 
	 * @param integer $site_id номер страницы сайта
	 * @param integer $timeedit время редактирования страницы сайта
	 * @param array $lang языки сайта
	 * @param array $rewrites ЧПУ
	 * @return array
	 */
	public function get($site_id, $timeedit, $lang, $rewrites)
	{
		$ids = array();
		$result = DB::query("SELECT id FROM {forum_category} WHERE trash='0' AND parent_id=0 AND act='1' AND del='0'");
		while ($row = DB::fetch_array($result))
		{
			$ids[] = $row["id"];
		}
		if (! $ids)
		{
			return true;
		}
		$cats = array();
		$result = DB::query("SELECT id, message_update FROM {forum_category} WHERE trash='0' AND parent_id IN (".implode(',', $ids).") AND act='1' AND del='0'");
		while ($row = DB::fetch_array($result))
		{
			$count = DB::query_result("SELECT COUNT(*) FROM {forum_category} WHERE parent_id=%d AND act='1' AND del='0' AND trash='0'", $row["id"]);
			$nastr = $this->diafan->configmodules("nastr", "forum", $site_id);
			if(! empty($rewrites["forum"]["cats"][$row["id"]]))
			{
				$link1 = $rewrites["forum"]["cats"][$row["id"]].ROUTE_END;
				$link2 = $rewrites["forum"]["cats"][$row["id"]].'/';
			}
			else
			{
				$link1 = $rewrites["site"][$site_id].'/cat'.$row["id"].'/';
				$link2 = $link1;
			}
			foreach ($lang as $l)
			{
				echo '<url>'
				.'<loc>'. BASE_PATH.$l["name"].$link1.'</loc>'
				.'<lastmod>'.date('Y-m-d', $row["message_update"]).'</lastmod>'
				.'</url>';
				if ($count > $nastr)
				{
					for ($i = 2; $i <= ceil($count/$nastr); $i++)
					{
						echo '<url>'
						.'<loc>'.BASE_PATH.$l["name"].$link2.'page'.$i.'/</loc>'
						.'<lastmod>'.date('Y-m-d', $timeedit).'</lastmod>'
						.'</url>';
					}
				}
			}
			$cats[] = $row["id"];
		}
		if (! $cats)
		{
			return;
		}
		$result = DB::query("SELECT id, message_update FROM {forum_category} WHERE trash='0' AND parent_id IN (".implode(',', $cats).") AND act='1' AND del='0'");
		while ($row = DB::fetch_array($result))
		{
			if(! empty($rewrites["forum"]["cats"][$row["id"]]))
			{
				$link = $rewrites["forum"]["element"][$row["id"]].ROUTE_END;
			}
			else
			{
				$link = $rewrites["site"][$site_id].'/show'.$row["id"].'/';
			}
			foreach ($lang as $l)
			{
				echo '<url>'
				.'<loc>'. BASE_PATH.$l["name"].$link.'</loc>'
				.'<lastmod>'.date('Y-m-d', $row["message_update"]).'</lastmod>'
				.'</url>';
			}
		}
	}
}