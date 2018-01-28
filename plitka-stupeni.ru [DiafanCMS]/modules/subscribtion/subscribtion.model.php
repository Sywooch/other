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
 * Subscribtion_model
 *
 * Модель модуля "Рассылки"
 */
class Subscribtion_model extends Model
{
	/**
	 * Отписывает e-mail от рассылки
	 * 
	 * @return array
	 */
	public function edit()
	{
		if(empty($_GET["mail"]))
		{
			include ABSOLUTE_PATH.'includes/404.php';
		}

		$row = DB::fetch_array(DB::query("SELECT * FROM {subscribtion_emails} WHERE mail='%s' AND trash='0' LIMIT 1", $_GET['mail']));
		$this->result['mail'] = $_GET["mail"];
		if($row["id"])
		{
			$this->result = $row;
			if($_GET["code"] != $row['code'])
			{
				$this->result["action"] = "error";
				return $this->result;
			}
			if($row["act"])
			{
				$this->result['link'] = BASE_PATH_HREF.$this->diafan->_route->module("subscribtion", true).'?action=del&mail='.urlencode($row['mail']).'&code='.urlencode($row["code"]);
			}
		}
		else
		{
			$row["act"] = 0;
			$row["code"] = '';
		}
		$this->result["action"] = 'edit';

		if($this->diafan->configmodules("cat", "subscribtion"))
		{
			$this->result["cats"] = array();
			$this->result["cats_unrel"] = array();
			if($row["id"])
			{
				$cat_unrel_result = DB::query("SELECT cat_id FROM {subscribtion_emails_cat_unrel} WHERE element_id=%d AND trash='0'", $row['id']);
				while($cat_id = DB::fetch_array($cat_unrel_result))
				{
				    $this->result["cats_unrel"][] = $cat_id['cat_id'];
				}
			}
			$array = array();
			$this->parent_id_subscribtion(0, 0, $array);
		}
	    
		return $this->result;
	}
    
	/**
	 * Отписывает e-mail от рассылки
	 * 
	 * @return array
	 */
	public function del()
	{
		if(empty($_GET["code"]) || empty($_GET["mail"]))
		{
			include ABSOLUTE_PATH.'includes/404.php';
		}

		$row = DB::fetch_array(DB::query("SELECT * FROM {subscribtion_emails} WHERE mail='%s' AND trash='0' LIMIT 1", $_GET['mail']));
		if(! $row["id"])
		{
			$this->diafan->redirect(BASE_PATH_HREF.$this->diafan->_route->module("subscribtion", true)."?mail=".urlencode($_GET['mail']));
		}

		if($_GET["code"] != $row['code'])
		{
			$this->result["action"] = "error";
			return $this->result;
		}
		if($row["act"])
		{
			DB::query("UPDATE {subscribtion_emails} SET act='0' WHERE id=%d LIMIT 1", $row['id']);
			DB::query("DELETE FROM {subscribtion_emails_cat_unrel} WHERE element_id=%d", $row['id']);
		}
		$this->diafan->redirect(BASE_PATH_HREF.$this->diafan->_route->module("subscribtion", true)."?mail=".urlencode($row["mail"])."&code=".urlencode($row["code"]));
	}
	
	
	/**
	 * Формирует список рассылок
	 * @return array
	 */
	private function parent_id_subscribtion($parent_id, $level, &$array)
	{
		$result = DB::query("SELECT [name], id FROM {subscribtion_category} WHERE parent_id=%d AND trash='0'", $parent_id);
		while ($row    = DB::fetch_array($result))
		{
			$row["level"] = $level;
			$this->result["cats"][] = $row;
			if (in_array($row["id"], $array))
			{
				return $array;
			}
			$array[] = $row["id"];
			$this->parent_id_subscribtion($row["id"], $level+1, $array);
		}
	}
	
	public function form()
	{
		$this->result["error"] = $this->get_error("subscribtion");
		$this->result["error_name"] = $this->get_error("subscribtion", 'name');
		return $this->result;
	}
}