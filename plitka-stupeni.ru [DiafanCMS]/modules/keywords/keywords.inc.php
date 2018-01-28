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
 * Keywords_inc
 *
 * Подключение модуля "Перелинковка"
 */
class Keywords_inc extends Model
{
	/**
	 * @var array $cache локальный кэш модуля
	 */
	private $cache;

	/**
	 * Подставляет ключевые слова
	 *
	 * @param string $text исходный текст
	 * @return string
	 */
	function get($text)
	{
		if(! isset($this->cache["check"]))
		{
			$this->cache["check"] = DB::query_result("SELECT id FROM {modules} WHERE name='keywords' LIMIT 1");
		}
		if(! $this->cache["check"])
		{
			return $text;
		}
		if(! isset($this->cache["keywords"]))
		{
			$this->cache["keywords"] = array();
			$result = DB::query("SELECT text, link FROM {keywords} WHERE [act]='1' AND trash='0'");
			while($row = DB::fetch_array($result))
			{
				$this->cache["keywords"][$row["text"]] = $row["link"];
			}
		}
		if(empty($this->cache["count"]))
		{
			$this->cache["count"] = 0;
		}
		$this->cache["links"] = array();
		$this->cache["replace_links"] = array();
		$text = preg_replace_callback('/<a([^\]+>)([^<])<\/a>/', array($this, '_callback_replace_a'), $text);
		foreach($this->cache["keywords"] as $k => $v)
		{
			$max = $this->diafan->configmodules("max", "keywords");
			if($max && $max <= $this->cache["count"])
			{
				break;
			}
			$text = preg_replace_callback('/([^a-zA-Zа-яА-Я])('.$k.')([^a-zA-Zа-яА-Я])/', array($this, '_callback_replace'), $text);
		}
		$text = str_replace($this->cache["replace_links"], $this->cache["links"], $text);
		return $text;
	}
	
	public function _callback_replace($m)
	{
		$this->cache["count"]++;
		$max = $this->diafan->configmodules("max", "keywords");
		if($max && $max < $this->cache["count"])
		{
			return $m[1].$m[2].$m[3];
		}
		
		$this->cache["links"][] = '<a href="'.$this->cache["keywords"][$m[2]].'">'.$m[2].'</a>';
		$replace_link = 'keywords#'.count($this->cache["links"]);
		$this->cache["replace_links"][] = $replace_link;
		return $m[1].$replace_link.$m[3];
	}
	
	public function _callback_replace_a($m)
	{
		$this->cache["links"][] = $m[0];
		$replace_link = 'keywords#'.count($this->cache["links"]);
		$this->cache["replace_links"][] = $replace_link;
		return $replace_link;
	}
}