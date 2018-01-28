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
 * Votes_ajax
 *
 * Обработка запроса при голосовании
 */
class Votes_ajax extends Ajax
{
	/**
	 * Обрабатывает полученные данные из формы
	 * 
	 * @return boolean
	 */
	public function ajax_request()
	{
		if (! empty($_POST['module']) && $_POST['module'] == 'votes' && ! empty($_POST['question']))
		{
			if (empty($_POST["result"]))
			{
				if ($this->check_element())
					return true;

				$this->check_security_user();
				$this->check_captcha('votes','votes'.$_POST["question"]);
				$this->check_log();

				if ($this->send_errors())
					return true;
				if($_POST['answer'] != 'userversion')
				{
				    DB::query("UPDATE {votes} SET count_votes=count_votes+1 WHERE id='%d' AND cat_id='%d'", $_POST["answer"], $_POST["question"]);
				}
				else
				{
				    DB::query("INSERT INTO {votes_userversion} (cat_id, text) VALUES (%d, '%s')", $_POST["question"], $_POST['userversion']);
				}
				
			}
			else
			{
				$view_result["result"] = true;
			}

			$view_result["question_id"] = intval($_POST["question"]);
			if (empty($_POST["result"]) || $_POST["result"] == 1)
			{
				$userversion = DB::query_result("SELECT userversion FROM {votes_category} WHERE id=%d", $_POST["question"]);
				$sum_votes = DB::query_result("SELECT SUM(count_votes) FROM {votes} WHERE trash='0' AND cat_id='%d' AND [act]='1'", $_POST["question"]);
				if(!empty($userversion))
				{
				    $userversion_summ = DB::query_result("SELECT COUNT(id) FROM {votes_userversion} WHERE cat_id=%d", $_POST["question"]);
				    $sum_votes = $sum_votes + $userversion_summ;
				}
				$result = DB::query("SELECT count_votes, [name] FROM {votes} WHERE trash='0' AND cat_id='%d' AND [act]='1' ORDER BY id ASC", $_POST["question"]); 
				while ($row = DB::fetch_array($result))
				{
					$row_answer["count"]   = $row["count_votes"];
					$row_answer["persent"] = $sum_votes ? round($row["count_votes"] / $sum_votes * 100) : 0;
					$row_answer["name"] = $row["name"];
					$rows[] = $row_answer;
				}
				if(!empty($userversion))
				{
				    $row_answer["count"] = $userversion_summ;
				    $row_answer["persent"] = $sum_votes ? round($userversion_summ / $sum_votes * 100) : 0;
				    $row_answer["name"] = $this->diafan->_('Свой вариант');
				    $rows[] = $row_answer;
				}
				
				$view_result["answers"]  = $rows;
				$view_result["summ"] = $sum_votes;
				
				$view_result["no_result"] = DB::query_result("SELECT no_result FROM {votes_category} WHERE id=%d", $_POST["question"]);

				$this->result["data"] = $this->diafan->_tpl->get('answers', 'votes', $view_result);
			}
			else
			{
				$result = DB::query("SELECT id, [name] FROM {votes} WHERE trash='0' AND cat_id='%d' AND [act]='1' ORDER BY id ASC", $_POST["question"]); 
				while ($row = DB::fetch_array($result))
				{
					$row_answer = array();
					$row_answer["id"] = $row["id"];
					$row_answer["name"] = $row["name"];
					$view_result["answers"][] = $row_answer;
				}
				$view_result["captcha"] = '';
				if ($this->diafan->configmodules('security', 'votes') == 2)
				{
					$view_result["captcha"] = $this->diafan->_captcha->get("votes".$row["id"], "");
				}
	
				$this->result["data"] = $this->diafan->_tpl->get('form', 'votes', $view_result);	
			}
			$this->result["target"] = '#votes'.$_POST["question"];
		}
		return $this->send_errors("data");
	}

	/**
	 * Проверяет существует ли вопрос и ответ в базе
	 * 
	 * @return boolean
	 */
	private function check_element()
	{
		if (empty($_POST['answer']))
		{
			return true;
		}
		if (! DB::query_result("SELECT id FROM {votes_category} WHERE id=%d LIMIT 1", $_POST["question"]))
		{
			return true;
		}
		if (! DB::query_result("SELECT id FROM {votes} WHERE id=%d AND cat_id=%d LIMIT 1", $_POST['answer'], $_POST["question"]) && $_POST['answer'] != 'userversion')
		{
			return true;
		}
		if($_POST['answer'] == 'userversion' && empty($_POST['userversion']))
		{
			return true;
		}
		return false;
	}

	/**
	 * Проверяет авторизацию, если задан доступ только для пользователей
	 * 
	 * @return boolean true
	 */
	private function check_security_user()
	{
		if ($this->diafan->configmodules('security_user', 'votes') && ! $this->diafan->_user->id)
		{
			$this->result["errors"][0] = $this->diafan->_('Голосование закрыто для незарегистрированных пользователей.', false);
		}
		return true;
	}

	/**
	 * Проверяет повторное голосование
	 * 
	 * @return boolean true
	 */
	private function check_log()
	{
		if ($this->diafan->configmodules('security', 'votes') == 3)
		{
			if (DB::query_result("SELECT id FROM {log_note} WHERE session_id='%s' AND element_id='%d' AND include_name='votes' LIMIT 1",
								$this->diafan->configmodules('security_user', 'votes') ? $this->diafan->_user->id : session_id(), $_POST["question"]))
			{
				$this->result["errors"][0] = $this->diafan->_('Вы уже голосовали', false);
			}
			else
			{
				DB::query("INSERT INTO {log_note} (include_name, element_id, note, created, ip, session_id)"
				          ." VALUES ('votes', '%d', '%d', %d, '%s', '%s')",
				          $_POST["question"],
				          $_POST["answer"],
				          time(),
				          getenv('REMOTE_ADDR'),
				          $this->diafan->configmodules('security_user', 'votes') ? $this->diafan->_user->id : session_id()
				         );
			}
		}
		elseif ($this->diafan->configmodules('security', 'votes') == 4)
		{
			if (! empty($_SESSION["votes"][$_POST["question"]]))
			{
				$this->result["errors"][0] = $this->diafan->_('Вы уже голосовали', false);
			}
			$_SESSION["votes"][$_POST["question"]] = 1;
		}
		return true;
	}
}