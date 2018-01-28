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
 * Feedback_model
 *
 * Модель модуля "Обратная связь"
 */
class Feedback_model extends Model
{
	/**
	 * Генерирует данные для формы добавления сообщения
	 * 
	 * @param integer $site_id номер страницы
	 * @param boolean $insert_form форма выводится с помощью шаблонного тэга
	 * @return array|boolean false
	 */
	public function form($site_id = 0, $insert_form = false)
	{
		if (! $insert_form)
		{
			$site_id = $this->diafan->cid;
		}
		else
		{
			if (! $site_id)
			{
				$site_id = DB::query_result(
						"SELECT s.id FROM {site} AS s"
						.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=s.id AND a.module_name='site'" : "")
						." WHERE s.module_name='feedback' AND s.trash='0' AND s.block='0'"
						." AND (s.access='0'"
						.($this->diafan->_user->id ? " OR s.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
						.") LIMIT 1"
					);
			}
			else
			{
				if(DB::query_result("SELECT access FROM {site} WHERE id=%d", $site_id))
				{
					if(! $this->access($site_id, 0, "site"))
					{
						return false;
					}
				}
			}
		}
		if (! $site_id)
		{
			return false;
		}
		$this->result["site_id"] = $site_id;

		$this->result["captcha"] = '';
		if ($this->diafan->configmodules('captcha', "feedback", $site_id))
		{
			$this->result["captcha"] = $this->diafan->_captcha->get("feedback".$site_id, $this->get_error("feedback".$site_id, "captcha"));
		}
		$rows_param = $this->get_params(array("module" => "feedback", "where" => "site_id=".$site_id));
		foreach ($rows_param as $row)
		{
			$this->result['error_p'.$row["id"]] = $this->get_error("feedback".$site_id, 'p'.$row["id"]);
		}

		$this->result["error"]  = $this->get_error("feedback".$site_id);
		$this->result["rows"]   = $rows_param;
		return $this->result;
	}
}