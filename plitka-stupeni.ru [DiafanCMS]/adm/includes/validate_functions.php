<?php

/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}

/**
 * Validate_functions_admin
 *
 * Функции валидации полей
 */
class Validate_functions_admin extends Diafan
{
	/**
	 * Валидация поля "Период действия"
	 *
	 * @return void
	 */
	public function validate_variable_date_start()
	{
		if($this->diafan->is_variable("created"))
		{
			$created = $this->diafan->unixdate($_POST["created"]);
		}
		if(! empty($_POST["date_start"]))
		{
			$date_start = $this->diafan->unixdate($_POST["date_start"]);
			if($this->diafan->variable("date_start") == 'date')
			{
				$mes = Validate::date($_POST["date_start"]);
			}
			else
			{
				$mes = Validate::datetime($_POST["date_start"]);
			}
			if(! empty($mes))
			{
				$this->diafan->set_error("date_start", $mes);
				return;
			}
			if(isset($created) && $created > $date_start)
			{
				$this->diafan->set_error("date_start", "Дата начала показа должна быть больше даты создания");
				return;
			}
		}
		if(! empty($_POST["date_finish"]))
		{
			$date_finish = $this->diafan->unixdate($_POST["date_finish"]);
			if($this->diafan->variable("date_finish") == 'date')
			{
				$mes = Validate::date($_POST["date_finish"]);
			}
			else
			{
				$mes = Validate::datetime($_POST["date_finish"]);
			}
			if(! empty($mes))
			{
				$this->diafan->set_error("date_start", $mes);
				return;
			}
			if(isset($created) && $created > $date_finish)
			{
				$this->diafan->set_error("date_start", "Дата окончания показа должна быть больше даты создания");
				return;
			}
		}
		if(isset($date_start) && isset($date_finish) && $date_start >= $date_finish)
		{
			$this->diafan->set_error("date_start", "Дата окончания показа должна быть больше даты начала показа");
			return;
		}
	}

	/**
	 * Валидация поля "Период действия"
	 *
	 * @return void
	 */
	public function validate_variable_date_finish(){}

	/**
	 * Редактирование поля "Дополнительные параметры"
	 * 
	 * @return void
	 */
	public function validate_variable_param()
	{
		$result = DB::query("SELECT id, type FROM {".$this->diafan->table."_param} WHERE trash='0'");
		while ($row = DB::fetch_array($result))
		{
			if($row["type"] == 'numtext')
			{
				$row["type"] = 'floattext';
			}
			$this->diafan->validate_variable("param".$row["id"], $row["type"]);
		}
	}

	/**
	 * Валидация поля "Псевдоссылка"
	 *
	 * @return void
	 */
	public function validate_variable_rewrite()
	{
		$rewrite_id = 0;
		$redirect_id = 0;
		if(! $this->diafan->addnew)
		{
			if ($this->diafan->config("category"))
			{
				$rewrite_id = DB::query_result("SELECT id FROM {rewrite} WHERE module_name='%s' AND cat_id=%d LIMIT 1", $this->diafan->module, $this->diafan->edit);

				$redirect_id = DB::query_result("SELECT id FROM {redirect} WHERE module_name='%s' AND cat_id=%d AND element_id=0 LIMIT 1", $this->diafan->module, $this->diafan->edit);
			}
			elseif ($this->diafan->module == "site")
			{
				$rewrite_id = DB::query_result("SELECT id FROM {rewrite} WHERE module_name='site' AND site_id=%d LIMIT 1", $this->diafan->edit);

				$redirect_id = DB::query_result("SELECT id FROM {redirect} WHERE module_name='site' AND site_id=%d LIMIT 1", $this->diafan->edit);
			}
			else
			{
				$rewrite_id = DB::query_result("SELECT id FROM {rewrite} WHERE module_name='%s' AND element_id=%d LIMIT 1", $this->diafan->module, $this->diafan->edit);

				$redirect_id = DB::query_result("SELECT id FROM {redirect} WHERE module_name='%s' AND element_id=%d LIMIT 1", $this->diafan->module, $this->diafan->edit);
			}
		}
		if(! empty($_POST["rewrite"]))
		{
			if(DB::query_result("SELECT id FROM {rewrite} WHERE rewrite='%h' AND id<>%d AND trash='0' LIMIT 1", $_POST["rewrite"], $rewrite_id))
			{
				$this->diafan->set_error("rewrite", "Псевдоссылка уже есть в базе");
			}
		}
		if(! empty($_POST["rewrite_redirect"]))
		{
			if(DB::query_result("SELECT id FROM {redirect} WHERE redirect='%s' AND id<>%d AND trash='0' LIMIT 1", $_POST["rewrite_redirect"], $redirect_id))
			{
				$this->diafan->set_error("redirect", "Редирект на этот URL уже есть в базе");
			}
		}
	}

	/**
	 * Валидация поля "Priority"
	 *
	 * @return void
	 */
	public function validate_variable_priority()
	{
		if(!empty($_POST["priority"]) && (preg_match('/[^0-9\\,]+/', intval($_POST["priority"])) || $_POST["priority"] > 1 || intval($_POST["priority"]) < 0))
		{
			$this->diafan->set_error("priority", "Допустимый диапазон значений — от 0,0 до 1,0");
		}
	}
}