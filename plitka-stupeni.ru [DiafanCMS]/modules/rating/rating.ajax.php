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
 * Rating_ajax
 *
 * Обработка запроса при оценке элемента
 */
class Rating_ajax extends Ajax
{
	/**
	 * @var string название модуля, элемент которого оценивается
	 */
	private $module_name;

	/**
	 * @var integer номер элемента, который оценивается
	 */
	private $element_id;

	/**
	 * Обрабатывает полученные данные из формы
	 * 
	 * @return boolean
	 */
	public function ajax_request()
	{
		if (! empty($_POST['module']) && $_POST['module'] == 'rating' && ! empty($_POST['rating']) && ! empty($_POST['element_id']) && ! empty($_POST['module_name']))
		{
			$this->element_id  = intval($_POST["element_id"]);
			$this->module_name = preg_replace('/[^a-zA-Z0-9-_]+/', '', $_POST['module_name']);

			if ($this->check_element())
				return true;

			if ($this->check_user())
				return true;

			if ($this->check_log())
				return true;

			if (DB::query_result("SELECT id FROM {rating} WHERE element_id='%d' AND module_name='%s' LIMIT 1",
					    $this->element_id, $this->module_name)
			   )
			{ 
				DB::query("UPDATE {rating} SET rating=(rating*count_votes+%d)/(count_votes+1), count_votes=count_votes+1,created='%d'"
					     ." WHERE element_id='%d' AND module_name='%s'",
					     $_POST["rating"],
					     time(),
					     $this->element_id,
					     $this->module_name
					     );
			}
			else
			{			
				DB::query("INSERT INTO {rating} (rating, count_votes, element_id, module_name, created) VALUES ('%d', 1, '%d', '%s', '%d')",
				          $_POST["rating"],
				          $this->element_id,
				          $this->module_name,
				          time()
				         );
			}

			return true;
		}
	}

	/**
	 * Проверяет существует ли оцениваемый элемент
	 * 
	 * @return boolean
	 */
	private function check_element()
	{
		if (! $this->element_id || ! $this->module_name)
		{
			return true;
		}
		if (! DB::query_result("SELECT id FROM {".$this->module_name."} WHERE id=%d LIMIT 1", $this->element_id))
		{
			return true;
		}
	}

	/**
	 * Проверяет доступа пользователя
	 * 
	 * @return boolean
	 */
	private function check_user()
	{
		if ($this->diafan->configmodules('only_user', 'rating') && ! $this->diafan->_user->id)
		{
			$this->result["errors"][0] = $this->diafan->_('Голосование закрыто для незарегистрированных пользователей.', false);
		}

		return $this->send_errors();
	}

	/**
	 * Проверяет попытку голосовать повторно
	 * 
	 * @return boolean
	 */
	private function check_log()
	{
		if (! session_id())
		{
			$this->result["errors"][0] = $this->diafan->_('Вы уже голосовали', false);
		}
		if ($this->diafan->configmodules('security', 'rating') == 3)
		{
			if (DB::query_result("SELECT id FROM {log_note} WHERE session_id='%s' AND element_id='%d' AND module_name='%s' AND include_name='rating' LIMIT 1",
			                    $this->diafan->configmodules('security_user', 'rating') ? $this->diafan->_user->id : session_id(),
			                    $this->element_id, $this->module_name
			                   ))
			{
				$this->result["errors"][0] = $this->diafan->_('Вы уже голосовали', false);
			}
			else
			{
				
				DB::query("INSERT INTO {log_note} (include_name, element_id, note, created, ip, session_id, module_name) "
				          ." VALUES ('rating', '%d', '%d', %d, '%s', '%s', '%s')",
				          $this->element_id,
				          $_POST["ajax_rating"],
				          time(),
				          getenv('REMOTE_ADDR'),
				          $this->diafan->configmodules('security_user', 'rating') ? $this->diafan->_user->id : session_id(),
				          $this->module_name
				         );
			}
		}

		if ($this->diafan->configmodules('security', 'rating') == 4)
		{
			if (! empty($_SESSION["rating"][$this->element_id.$this->module_name]))
			{
				$this->result["errors"][0] = $this->diafan->_('Вы уже голосовали', false);
			}
			else
			{
				$_SESSION["rating"][$this->element_id.$this->module_name] = 1;
			}
		}

		return $this->send_errors();
	}
}