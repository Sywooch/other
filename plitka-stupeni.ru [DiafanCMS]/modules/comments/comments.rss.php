<?php
/**
 * RSS лента комментариев
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

if (! DB::query_result("SELECT id FROM {modules} WHERE module_name='comments' LIMIT 1"))
{
	include ABSOLUTE_PATH."includes/404.php";
}

global $sites, $cats, $elements;

/**
 * Проверяет есть ли доступ к старнице сайта
 * @param integer $site_id номер страницы сайта
 * @return boolean
 */
function check_access_site($site_id)
{
	global $sites, $diafan;
	if(! isset($sites[$site_id]))
	{
		$sites[$site_id] = DB::fetch_array(DB::query("SELECT e.id, e.[name] FROM {site} as e"
		.($diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='site'" : "")
		." WHERE e.id=%d AND e.[act]='1' AND e.block='0' AND e.trash='0'"
		." AND (e.access='0'"
		.($diafan->_user->id ? " OR e.access='1' AND a.role_id=".$diafan->_user->role_id : '')
		.") LIMIT 1", $site_id));
	}
	if(empty($sites[$site_id]))
	{
		return false;
	}
	return true;
}

/**
 * Проверяет есть ли доступ к категории
 * @param integer $cat_id номер категории
 * @param string $module_name модуль
 * @return boolean
 */
function check_access_cat($cat_id, $module_name)
{
	global $cats, $diafan;
	if(! isset($cats[$module_name][$cat_id]))
	{
		$cats[$module_name][$cat_id] = DB::fetch_array(DB::query("SELECT e.id, e.site_id, e.[name] FROM {%s_category} as e"
		.($diafan->_user->id ? " LEFT JOIN {access} AS a ON a.cat_id=e.id AND a.module_name='%s'" : "")
		." WHERE e.id=%d AND e.[act]='1' AND e.trash='0'"
		." AND (e.access='0'"
		.($diafan->_user->id ? " OR e.access='1' AND a.role_id=".$diafan->_user->role_id : '')
		.") LIMIT 1", $module_name, $module_name, $cat_id));
		if(! empty($cats[$module_name][$cat_id]["site_id"]))
		{
			if(! check_access_site($cats[$module_name][$cat_id]["site_id"]))
			{
				$cats[$module_name][$cat_id] = '';
				return false;
			}
		}
	}
	if(empty($cats[$module_name][$cat_id]))
	{
		return false;
	}
	return true;
}

/**
 * Проверяет есть ли доступ к элементу модуля
 * @param integer $element_id номер категории
 * @param string $module_name модуль
 * @return boolean
 */
function check_access_element($element_id, $module_name)
{
	global $elements, $diafan;
	if(! isset($elements[$element_id]))
	{
		$elements[$element_id] = DB::fetch_array(DB::query("SELECT e.id, e.site_id, e.cat_id, e.[name] FROM {%s} as e"
		.($diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='%s'" : "")
		." WHERE e.id=%d AND e.[act]='1' AND e.trash='0'"
		." AND (e.access='0'"
		.($diafan->_user->id ? " OR e.access='1' AND a.role_id=".$diafan->_user->role_id : '')
		.") LIMIT 1", $module_name, $module_name, $element_id));
		if(! empty($elements[$element_id]["site_id"]))
		{
			if(! check_access_site($elements[$element_id]["site_id"]))
			{
				$elements[$element_id] = '';
				return false;
			}
		}
		if(! empty($elements[$element_id]["cat_id"]))
		{
			if (! $diafan->configmodules("cat", $module_name, $elements[$element_id]["site_id"]))
			{
				$elements[$element_id]["cat_id"] = 0;
			}
			elseif(! check_access_cat($elements[$element_id]["cat_id"], $module_name))
			{
				$elements[$element_id] = '';
				return false;
			}
		}
	}
	if(empty($elements[$element_id]))
	{
		return false;
	}
	return true;
}

$limit = 15;
$time = mktime(23, 59, 0, date("m"), date("d"), date("Y"));

$result = DB::query("SELECT created, user_id, text, id, parent_id, module_name, element_id FROM {comments}"
." WHERE act='1' AND trash='0' ORDER BY created DESC LIMIT 100");

$last  = '';
$items  = '';
$count = 0;
while ($row = DB::fetch_array($result))
{
	if(strpos($row["module_name"], '_category') !== false)
	{
		$cat_id = $row["element_id"];
		$element_id = 0;
	}
	else
	{
		$element_id = $row["element_id"];
		$cat_id = 0;
	}
	if($row["module_name"] == 'site')
	{
		if (! $this->diafan->configmodules("comments", "site", $row["element_id"]))
		{
			continue;
		}
		if(! check_access_site($row["element_id"]))
		{
			continue;
		}
		$link = $this->diafan->_route->link($row["element_id"]);
		$name = $sites[$row["element_id"]]["name"];
	}
	else
	{
		if($cat_id)
		{
			$module_name = str_replace('_category', '', $row["module_name"]);
			if(! check_access_cat($cat_id, $module_name))
			{
				continue;
			}
			if (! $this->diafan->configmodules("comments_cat", $module_name, $cats[$cat_id]["site_id"]))
			{
				continue;
			}
			$link = $this->diafan->_route->link($cats[$cat_id]["site_id"], $module_name, $cat_id);
			$name = $cats[$cat_id]["name"];
		}
		else
		{
			if(! check_access_element($element_id, $row["module_name"]))
			{
				continue;
			}
			if (! $this->diafan->configmodules("comments", $row["module_name"], $elements[$element_id]["site_id"]))
			{
				continue;
			}
			$link = $this->diafan->_route->link($elements[$element_id]["site_id"], $row["module_name"], $elements[$element_id]["cat_id"], $element_id);
			$name = $elements[$element_id]["name"];
		}
	}
	if(! $link)
	{
		continue;
	}
	if (empty($last))
	{
		$last = date("D, d F Y H:i:s T", $row['created']);
	}
	$items .= "
	<item>
		<title>".$name."</title>
		<link>".BASE_PATH_HREF.$link."</link>
		<description>".$this->diafan->prepare_xml($row['text'])."</description>
		<pubDate>".date("D, d F Y H:i:s T", $row['created'])."</pubDate>
	</item>";
	$count++;
	if($count == $limit)
	{
		break;
	}
}

$xml = '<?xml version="1.0"?>
<rss version="2.0">
	<channel>
		<title>'.$this->diafan->_('Комментарии', false).'</title>
		<link>'.BASE_PATH_HREF.'</link>
		<description>'.$this->diafan->_('Последние комментарии', false).' '.BASE_URL.'.</description>
		<language>ru-ru</language>
		<lastBuildDate>'.$last.'</lastBuildDate>
		<generator>diafan.CMS version '.VERSION_CMS.'</generator>
		'.$items.'
	</channel>
</rss>';

header('Content-type: application/xml; charset=utf-8'); 
header('Connection: close');
//header('Content-Length: '. utf::strlen($xml));
header('Date: '.date('r'));
echo $xml;
exit;