<?php
/**
 * RSS лента статей
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

if (! DB::query_result("SELECT id FROM {modules} WHERE module_name='clauses' LIMIT 1"))
{
	include ABSOLUTE_PATH."includes/404.php";
}
$site_ids = $this->diafan->_route->id_module('clauses');
if(empty($site_ids))
{
	include ABSOLUTE_PATH."includes/404.php";
}

$limit = 15;
$time = mktime(23, 59, 0, date("m"), date("d"), date("Y"));

$result = DB::query("SELECT e.id, e.created, e.[name], e.[anons], e.cat_id, e.site_id FROM {clauses} AS e"
.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='clauses'" : "")
." WHERE e.[act]='1' AND e.trash='0'"
." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
." AND (e.access='0'"
.($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
.")"
." AND e.site_id IN (".implode(",", $site_ids).")"
." ORDER BY e.created DESC, e.id DESC LIMIT ".$limit, $time, $time);

$last  = '';
$items  = '';

while ($row = DB::fetch_array($result))
{
	if (! $this->diafan->configmodules("cat", "clauses", $row["site_id"]))
	{
		$row["cat_id"] = 0;
	}
	$link = $this->diafan->_route->link($row["site_id"], "clauses", $row["cat_id"], $row["id"]);
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
		<title>".$this->diafan->prepare_xml($row['name'])."</title>
		<link>".BASE_PATH_HREF.$link."</link>
		<description>".$this->diafan->prepare_xml($row['anons'])."</description>
		<pubDate>".date("D, d F Y H:i:s T", $row['created'])."</pubDate>"
		.($this->diafan->configmodules("comments", "clauses", $row["site_id"]) ? "
		<comments>".BASE_PATH_HREF.$link."</comments>" : "")."
	</item>";
}

$xml = '<?xml version="1.0"?>
<rss version="2.0">
	<channel>
		<title>'.$this->diafan->_('Статьи', false).'</title>
		<link>'.BASE_PATH_HREF.'</link>
		<description>'.$this->diafan->_('Последние статьи', false).' '.BASE_URL.'.</description>
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