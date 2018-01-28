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
	include(dirname(dirname(dirname(__FILE__))).'/includes/404.php');
}

/**
 * Votes_model
 *
 * Модель модуля "Опросы"
 */
class Votes_model extends Model
{
	/**
	 * Генерирует данные для шаблонной функции: опросы
	 *
	 * @param integer $id идентификатор опроса
	 * @param integer $count количество опросов
	 * @return array
	 */
	public function show_block($id, $count)
	{
		$this->result["rows"] = array();
		if (! empty($id))
		{
			$result = DB::query(
				"SELECT c.id, c.[name], c.no_result, c.userversion FROM {votes_category} as c"
				." INNER JOIN {votes_category_site_rel} AS r ON r.element_id=c.id AND (r.site_id=%d OR r.site_id=0)"
				." WHERE c.[act]='1' AND c.trash='0'"
				." AND c.id=%d GROUP BY c.id", $this->diafan->cid, $id
			);
			$this->result["rows"] = $this->get_elements($result);
		}
		else
		{
			$result = DB::query(
				"SELECT c.id, c.[name], c.no_result, c.userversion FROM {votes_category} as c"
				." INNER JOIN {votes_category_site_rel} AS r ON r.element_id=c.id AND (r.site_id=%d OR r.site_id=0)"
				." WHERE c.[act]='1' AND c.trash='0'"
				." GROUP BY c.id", $this->diafan->cid
			);

			$rows = $this->get_elements($result);
			$max_count = count($rows);

			if($count === "all" || $count >= $max_count)
			{
				$this->result["rows"] = $rows;
			}
			else
			{
				if (! empty($rows))
				{
					$rands = array();
					while($count)
					{
						$rand = mt_rand(0, $max_count - 1);
						if(! in_array($rand, $rands))
						{
							$rands[] = $rand;
							$this->result["rows"][] = $rows[$rand];
							$count--;
						}
					}
				}
			}
		}

		return $this->result["rows"];
	}

	/**
	 * Форматирует данные о запросе
	 *
	 * @param resource $result результат выполнения SQL-запроса
	 * @return array
	 */
	private function get_elements($result_question)
	{
		$rows = array();
		while ($row = DB::fetch_array($result_question))
		{
			$result = array();
			$result["question_id"] = $row["id"];
			$result["answers"] = array();
			$result["no_result"] = $row["no_result"];
			$result["userversion"] = $row["userversion"];
			if ($this->check_log($row["id"]))
			{				
				$result_answer = DB::query("SELECT id, [name] FROM {votes} WHERE trash='0' AND cat_id='%d' AND [act]='1' ORDER BY sort ASC", $row["id"]);
				while ($row_answers = DB::fetch_array($result_answer))
				{
					$row_answer = array();
					$row_answer["id"] = $row_answers["id"];
					$row_answer["name"] = $this->diafan->_useradmin->get($row_answers["name"], 'name', $row_answers["id"], 'votes', _LANG);
					$result["answers"][] = $row_answer;
				}
				$result["captcha"] = '';
				if ($this->diafan->configmodules('security', 'votes') == 2)
				{
					$result["captcha"] = $this->diafan->_captcha->get("votes".$row["id"], $this->get_error("votes".$row["id"], "captcha"));
				}
				$result["answers"] = $this->diafan->_tpl->get('form', 'votes', $result);
			}
			else
			{
				$userversion = DB::query_result("SELECT userversion FROM {votes_category} WHERE id=%d", $row["id"]);
				$sum_votes = DB::query_result("SELECT SUM(count_votes) FROM {votes} WHERE trash='0' AND cat_id='%d' AND [act]='1'", $row["id"]);
				
				if(!empty($userversion))
				{
				    $userversion_summ = DB::query_result("SELECT COUNT(id) FROM {votes_userversion} WHERE cat_id=%d", $row["id"]);
				    $sum_votes = $sum_votes + $userversion_summ;
				}

				$result_answer = DB::query("SELECT [name], count_votes FROM {votes} WHERE trash='0' AND cat_id='%d' AND [act]='1' ORDER BY sort ASC", $row["id"]);
				while ($row_answer = DB::fetch_array($result_answer))
				{
					$ra["count"]   = $row_answer["count_votes"];
					$ra["persent"] = $sum_votes ? round($row_answer["count_votes"] / $sum_votes * 100) : 0;
					$ra["name"]    = $row_answer["name"];
					$result["answers"][] = $ra;
				}
				
				if(!empty($userversion))
				{
				    $ra["count"] = $userversion_summ;
				    $ra["persent"] = $sum_votes ? round($userversion_summ / $sum_votes * 100) : 0;
				    $ra["name"] = $this->diafan->_('Свой вариант');
				    $result["answers"][] = $ra;
				}
	
				$result["summ"] = $sum_votes;
				$result["answers"] = $this->diafan->_tpl->get('answers', 'votes', $result);
			}			
			$result["question"] = $this->diafan->_useradmin->get($row["name"], 'name', $row["id"], 'votes_category', _LANG);
			$result["error"] = $this->get_error("votes".$row["id"]);
			$rows[] = $result;
		}
		return $rows;
	}

	/**
	 * Проверяет доступ к голосованию
	 * 
	 * @return boolean
	 */
	private function check_log($id)
	{
		if ($this->diafan->configmodules('security_user', 'votes') && ! $this->diafan->_user->id)
		{
			return false;
		}
		if ($this->diafan->configmodules('security','votes') == 3)
		{
			if (DB::query_result("SELECT id FROM {log_note} WHERE session_id='%s' AND element_id='%d' AND include_name='votes' LIMIT 1",
			                    $this->diafan->configmodules('security_user', 'votes') ? $this->diafan->_user->id : session_id(), $id))
			{
				return false;
			}
		}
		elseif ($this->diafan->configmodules('security', 'votes') == 4)
		{
			if (! empty($_SESSION["votes"][$id]))
			{
				return false;
			}
		}
		return true;
	}
}