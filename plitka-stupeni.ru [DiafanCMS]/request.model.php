<?php
/**
 * Модель
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.4
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2014 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

/**
 * Example_model
 */
class Example_model extends Model
{
	/**
	 * @return void
	 */
	public function show()
	{
		// данные будем кэшировать
		$cache_meta = array(
		"name" => "list", // метка кэша
		"page" => $this->diafan->page > 1 ? $this->diafan->page : 1,
		);
	
		// если данных нет в кэше занесем их
		if (!$this->result = $this->diafan->_cache->get($cache_meta, 'request'))
		{
			$this->result = array();
	
			////navigation//
			$this->diafan->_paginator->nen = DB::query_result("SELECT COUNT(id) FROM {request} WHERE act='1' AND trash='0'");
			$this->result["paginator"] = $this->diafan->_paginator->get();
			////navigation///
	
			$rows = DB::query_range_fetch_all("SELECT id, created, text FROM {request} WHERE act='1' AND trash='0' ORDER BY created DESC, id DESC",
				$this->diafan->_paginator->polog, $this->diafan->_paginator->nastr);
	
			foreach($rows as $row)
			{
				$row['created'] = $this->format_date($row['created'], 'request');
				$row['link'] = $this->diafan->_route->link($this->diafan->_site->id, $row["id"], 'request');
		
				$this->result['rows'][] = $row;
			}
			//сохранение кэша
			$this->diafan->_cache->save($this->result, $cache_meta, 'request');
		}
	
		$this->result["paginator"] = $this->diafan->_tpl->get('get', 'paginator', $this->result["paginator"]);

		$this->result['view'] = 'show';
	}
}