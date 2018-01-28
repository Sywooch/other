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
 * Comments_ajax
 *
 * Обработка запроса при добавления комментария
 */
class Comments_ajax extends Ajax
{
	/*
	 * Скрыть форму ответа на добавленный комментарий
	 */
	private $hide_form;

	/**
	 * Обрабатывает полученные данные из формы
	 *
	 * @return boolean
	 */
	public function ajax_request()
	{
		if (empty($_POST['module']) || $_POST['module'] != 'comments')
		{
			return false;
		}
		if ($this->diafan->configmodules('only_user', 'comments') && ! $this->diafan->_user->id)
		{
			return false;
		}
		$id = $this->diafan->module
			? ($this->diafan->show ? $this->diafan->show : $this->diafan->cat)
			: $this->diafan->cid;

		$module_name = $this->diafan->module
			? $this->diafan->module.(! $this->diafan->show ? "_category" : '')
			: 'site';

		$where_form = "(module_name='".$module_name."' OR module_name='') AND show_in_"
					  .($this->diafan->_user->id ? "form_auth" : "form_no_auth")."='1'";
		$params = $this->get_params(array("module" => "comments", "where" => $where_form));

		$parent_id = $this->diafan->get_param($_POST, "parent_id", 0, 2);
		$this->module = "comments";
		$this->tag = "comments".$parent_id;

		$this->check_captcha();
		$this->empty_required_field(array("params" => $params));
		$this->valid_text();

		if ($this->send_errors())
			return true;

		if ($this->check_max_count($id, $module_name))
			return true;

		if ($this->check_parent_id($id, $module_name))
			return true;

		if ($this->error_insert($id, $module_name))
			return true;

		if($this->diafan->configmodules('use_bbcode', 'comments'))
		{
			$comment = $this->diafan->_bbcode->replace($_POST["comment"]);
		}
		else
		{
			$comment = nl2br(htmlspecialchars($_POST["comment"]));
		}
		if (! DB::query(
				"INSERT INTO {comments} (created, module_name,element_id, user_id, text, act, parent_id)"
				." VALUES (%d, '%h', %d, %d, '%s', '%d', %d)",
				time(), $module_name, $id, $this->diafan->_user->id,
				$comment,
				$this->diafan->configmodules('security_moderation', 'comments') && ! $this->diafan->_user->roles('edit', 'comments') ? 0 : 1,
				$parent_id
		))
		{
			$this->result["errors"][0] = 'ERROR';
			return $this->send_errors();
		}
		$save = DB::last_id("comments");
		if ($parent_id)
		{
			$parents = $this->diafan->get_parents($parent_id, "comments");
			$parents[] = $parent_id;
			foreach ($parents as $p_id)
			{
				DB::query("INSERT INTO {comments_parents} (element_id, parent_id) VALUES (%d, %d)", $save, $p_id);
				DB::query("UPDATE {comments} SET count_children=count_children+1 WHERE id=%d", $p_id);
			}
		}

		$this->insert_values(array("id" => $save, "table" => "comments", "params" => $params));

		if ($this->send_errors())
			return true;

		$this->message_admin_param = ($this->message_admin_param ? $this->message_admin_param.'<br>' : '').$comment;
		$this->send_mail();
		$this->send_sms();

		//модерация сообщений
		if ($this->diafan->configmodules('security_moderation', 'comments') && ! $this->diafan->_user->roles('edit', 'comments'))
		{
			$mes = $this->diafan->configmodules('add_message', 'comments');
			$this->result["errors"][0] = $mes ? $mes : ' ';
			$this->result["success"] = true;

			return $this->send_errors();
		}

		if (! empty($_POST["ajax"]))
		{
			//выводит добавленное сообщение
			$row = array();
			$row["id"] = $save;
			$row['date'] = $this->format_date(time(), "comments");
			$row["text"] = $comment;
			if ($this->diafan->configmodules('user_name', 'comments') && $this->diafan->_user->id)
			{
				$row["name"] = $this->get_author($this->diafan->_user->id);
			}
			$row["children"] = false;

			$where_list = "(module_name='".$module_name."' OR module_name='') AND show_in_list='1'";
			$params_list = $this->get_params(array("module" => "comments", "where" => $where_list));
			$row["params"] = $this->diafan->_comments->get_param_values($save, $params_list);

			$row["form"] = $this->hide_form ? false : $this->diafan->_comments->get_form($params, 0, $save);
			$this->result["add"] = $this->diafan->_tpl->get('id', 'comments', $row);			
		}
		else
		{
			$mes = $this->diafan->configmodules('add_message', 'comments');
			$this->result["errors"][0] = $mes ? $mes : ' ';
		}
		$this->result["form_hide"] = true;
		$this->result["target_hide"] = ".comments".$parent_id."_block_form";
		$this->result["success"] = true;

		return $this->send_errors();
    }

	/**
	 * Проверяет существует ли сообщение-родитель
	 *
	 * @param integer $element_id номер элемента, к которому добавляется комментарий
	 * @param string $module_name модуль, к которому добавляется комментарий
	 * @return boolean
	 */
	private function check_parent_id($element_id, $module_name)
	{
		if (! empty($_POST["parent_id"]))
		{
			$parent_id = DB::query_result(
					"SELECT id FROM {comments} WHERE id=%d AND trash='0'"
					." AND act='1' AND element_id=%d AND module_name='%h' LIMIT 1",
					$_POST["parent_id"], $element_id, $module_name
				);
			if(! $parent_id)
			{
				$this->result["errors"][0] = 'ERROR';
				return $this->send_errors();
			}
			if($this->diafan->configmodules("count_level", "comments"))
			{
				if($parent_id)
				{
					$count = count($this->diafan->get_parents($parent_id, "comments"));
					$this->hide_form = $count + 4 > $this->diafan->configmodules("count_level", "comments");
					if($count + 3 > $this->diafan->configmodules("count_level", "comments"))
					{
						$this->result["errors"][0] = 'ERROR';
						return $this->send_errors();
					}
				}
				else
				{
					$this->hide_form = $this->diafan->configmodules("count_level", "comments") == 1;
				}
			}
		}
		return false;
	}

	/**
	 * Проверяет превышение максимального количества комментариев на странице
	 *
	 * @param integer $element_id номер элемента, к которому добавляется комментарий
	 * @param string $module_name модуль, к которому добавляется комментарий
	 * @return boolean
	 */
	private function check_max_count($element_id, $module_name)
	{
		if ($this->diafan->configmodules("max_count", "comments"))
		{
			$count = DB::query_result(
					"SELECT COUNT(*) FROM {comments} WHERE trash='0'"
					." AND act='1' AND element_id=%d AND module_name='%h'",
					$element_id, $module_name
				);
			if($this->diafan->configmodules("max_count", "comments") <= $count)
			{
				$this->result["form_hide"] = true;
				$this->result["target_hide"] = ".comments_show_form, .comments_block_form";
				$this->result["errors"][0] = $this->diafan->_('Максимально допустимое количество комментариев превышено', false);
				return $this->send_errors();
			}
			if($this->diafan->configmodules("max_count", "comments") == $count + 1)
			{
				$this->hide_form = true;
			}
		}
		return false;
	}

	/**
	 * Проверяет валидность комментария
	 *
	 * @return boolean true
	 */
	private function valid_text()
	{
		if (! $_POST["comment"])
		{
			$mes = 'Вы забыли ввести текст комментария';
		}
		else
		{
			Customization::inc('includes/validate.php');
			$mes = Validate::text($_POST["comment"]);
		}
		if ($mes)
		{
			$this->result["errors"][0] = $this->diafan->_($mes);
		}

		return true;
	}

	/**
	 * Проверяет попытку отправить сообщение повторно
	 *
	 * @param integer $element_id номер элемента, к которому добавляется комментарий
	 * @param string $module_name модуль, к которому добавляется комментарий
	 * @return boolean
	 */
	private function error_insert($element_id, $module_name)
	{
		$mes = '';
		$num = DB::query_result(
				"SELECT COUNT(id) FROM {comments} WHERE element_id=%d"
				." AND module_name='%h' AND user_id='%d'"
				." AND text='%h' AND trash='0'",
				$element_id, $module_name, $this->diafan->_user->id, $_POST["comment"]
			  );
		if ($num > 0)
		{
			$mes = $this->diafan->configmodules('error_insert_message', 'comments');
			$this->result["errors"][0] = $mes ? $mes : ' ';
		}
		return $this->send_errors();
	}

	/**
	 * Уведомление администратора по e-mail
	 *
	 * @return boolean
	 */
	private function send_mail()
	{
		if (! $this->diafan->configmodules("sendmailadmin", 'comments'))
			return false;

		$subject = str_replace(
			array('%title', '%url'),
			array(TITLE, BASE_URL),
			$this->diafan->configmodules("subject_admin", 'comments')
		);

		$message = str_replace(
			array('%title', '%urlpage', '%url', '%message'),
			array(
				TITLE,
				BASE_PATH_HREF.$this->diafan->_route->current_link(),
				BASE_URL,
				$this->message_admin_param
			),
			$this->diafan->configmodules("message_admin", 'comments')
		);

		$to   = $this->diafan->configmodules("emailconfadmin", 'comments')
		        ? $this->diafan->configmodules("email_admin", 'comments')
		        : EMAIL_CONFIG;

		include_once ABSOLUTE_PATH.'includes/mail.php';
		send_mail($to, $subject, $message);


		return true;
	}

	/**
	 * Уведомляет администратора по SMS
	 * 
	 * @return void
	 */
	private function send_sms()
	{
		if (! $this->diafan->configmodules("sendsmsadmin", 'comments', $this->site_id))
			return false;
			
		$message = $this->diafan->configmodules("sms_message_admin", 'comments', $this->site_id);

		$to   = $this->diafan->configmodules("sms_admin", 'comments', $this->site_id);

		include_once ABSOLUTE_PATH.'includes/sms.php';
		Sms::send($message, $to);
	}
}