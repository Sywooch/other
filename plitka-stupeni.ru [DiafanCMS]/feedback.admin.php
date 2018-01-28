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
 * Feedback_admin
 *
 * Редактирование сообщений из формы обратной связи
 */
class Feedback_admin extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'feedback';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'created' => array(
				'type' => 'datetime',
				'name' => 'Дата',
				'help' => 'В формате дд.мм.гггг, приходит с сайта',
			),
			'site_id' => array(
				'type' => 'select',
				'name' => 'Раздел сайта',
				'disabled' => true,
			),
			'lang_id' => array(
				'type' => 'select',
				'name' => 'Язык интерфейса',
			),
			'hr1' => 'hr',
			'user_id' => array(
				'type' => 'function',
				'name' => 'Автор',
			),			
			'param' => array(
				'type' => 'function',
				'name' => 'Конструктор формы',
			),
			'sendmail' => 'function',
			'hr2' => 'hr',
			'admin_id' => array(
				'type' => 'function',
				'name' => 'Отвечающий',
			),
			'text' => array(
				'type' => 'editor',
				'name' => 'Ответ',
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'del', // удалить
		'datetime', //показывать дату в списке, сортировать по дате
		'element_site', // делит элементы по разделам (страницы сайта, к которым прикреплен модуль)
		'trash', // использовать корзину
		'only_self', // показывать только материалы редактора, если это задано в правах пользователя
	);

	/**
	 * @var array выводить в списке содержание полей:
	 */
	public $config_other_row = array (
		'id' => 'function',
	);

	/**
	 * @var array текст для ссылки на редактирование в списке
	 */
	public $text_for_base_link = array(
		'text' => 'Редактировать'
	);

	/**
	 * Подготавливает конфигурацию модуля
	 * @return void
	 */
	public function prepare_config()
	{
		if(count($this->diafan->languages) > 2)
		{
			foreach ($this->diafan->languages as $language)
			{
				$this->diafan->select_arr("lang_id", $language["id"], $language["name"]);
			}
		}
		else
		{
			$this->diafan->variable_unset("lang_id");
		}
	}

	/**
	 * Выводит список обращений в обратную связь
	 * @return void
	 */
	public function show()
	{
		$this->diafan->list_row();
		echo "<h1>Запросы количества товара</h1>";
		DB::connect();
		$result = DB::query("SELECT * FROM {requests_count} ORDER BY id DESC");

		echo'<ul class="list">';
		while ($row = DB::fetch_object($result))
		{
    		//echo 'Название: '$row->name.' анонс: '.$row->anons;
			if(($row->status)=="0"){ $status_tmp='<span style="color:red;font-weight: bold;">Новый</span>';
			$status_action='<span onclick="status1('.$row->id.')" style="text-decoration:underline; cursor:pointer;">Пометить как рассмотренный</span>'; }
			else{ $status_tmp='<span style="color:blue;font-weight: bold;">Рассмотрен</span>';
			$status_action="";  }
		echo'
		<li class="level_1" row_id="'.$row->id.'">
			<a name="'.$row->id.'">
		    <div class="table_wrap">
		    <table width="100%" class="rows">
		    <tbody><tr><td class="name"><strong>Товар:</strong> '.$row->product.'</td><td class="status" id="status_'.$row->id.'">'.$status_tmp.'</td><td class="comment"><strong>Телефон:</strong> '.$row->phone.'</td><td class="summ"><strong>Количество:</strong> '.$row->count.'</td><td style="width:200px;" id="action_'.$row->id.'">'.$status_action.'</td></tr>
			</tbody></table></div></a></li>';

			
			
		}
		echo'</ul>';
		echo'
		<script type="text/javascript">
			function status1(n){
				params2 = { n:n };
	
	
				$.ajax({
					type: "POST",
					url: "/status1.php",
					data:params2,
					async: false,
					success: function(data){
						//alert(data);
						$("#action_"+n).html("");
						$("#status_"+n).html(\'<span style="color:blue;font-weight: bold;">Рассмотрен</span>\');
						

				}})

				
				
				
			}
		</script>
		';

		
		
	}

	/**
	 * Выводит дополнительные поля в списке
	 *
	 * @return string
	 */
	public function other_row_id($row)
	{
		$text = '</td><td class="comment" style="width:50% !important;">
			<div>
				<span></span>
				<table><tbody><tr><td>';
		$values = '';

		$result = DB::query("SELECT e.value, e.param_id, p.type, p.[name] FROM {feedback_param_element} AS e"
							." INNER JOIN {feedback_param} AS p ON e.param_id=p.id"
							. " WHERE e.trash='0' AND e.element_id=%d", $row["id"]);
		while ($row = DB::fetch_array($result))
		{
			if ($row["value"])
			{
				switch ($row["type"])
				{
					case 'select':
					case 'multiple':
						$row["value"] = DB::query_result("SELECT [name] FROM {feedback_param_select} WHERE id=%d LIMIT 1", $row["value"]);
						break;

					case 'checkbox':
						$v = DB::query_result("SELECT [name] FROM {feedback_param_select} WHERE param_id=%d AND value=1 LIMIT 1", $row["param_id"]);
						if ($v)
						{
							$row["value"] = $row["name"] . ': ' . $v;
						}
						else
						{
							$row["value"] = $row["name"];
						}
						break;
				}
				$values .= ( $values ? ', ' : '' ) . $row["value"];
			}
		}
		$text .= $values . '</td></tr></tbody></table>
			</div>';
		return $text;
	}

	public function show_table_tr_email($key, $name, $value, $help, $disabled = false)
	{
		echo '
		<tr id="' . $key . '">
			<td class="td_first">' . $name . '</td>
			<td>
				<input type="text" name="' . $key . '" size="40" value="' . ( ! $this->diafan->addnew ? str_replace('"', '&quot;', $value) : '' ) . '"'.($disabled ? ' disabled' : '').'>
				' . $help . '
				<br>
				<input type="checkbox" value="1" name="'.$key.'send"> ' . $this->diafan->_('Отправить ответ') . '
			</td>
		</tr>';
	}

	/**
	 * Редактирование поля "Дополнительные параметры"
	 *
	 * @return void
	 */
	public function edit_variable_param()
	{
		parent::__call('edit_variable_param', array(" AND site_id IN (0, ".$this->diafan->values["site_id"].")"));
	}

	/**
	 * Сохранение поля "Дополнительные параметры"
	 *
	 * @return void
	 */
	public function save_variable_param()
	{
		parent::__call('save_variable_param', array(" AND site_id IN (0, ".$this->diafan->oldrow["site_id"].")"));
	}

	/**
	 * Проверяет заполнен ли email, если отмечена кнопка "Отправить письмо"
	 * @return void
	 */
	public function validate_variable_sendmail()
	{
		$param_id = DB::query_result("SELECT id FROM {feedback_param} WHERE trash='0' AND site_id IN (0, %d) AND type='email' ORDER BY sort ASC LIMIT 1", $_POST["site_id"]);
		if(! $param_id || empty( $_POST['param' . $param_id.'send']))
		{
			return;
		}
		if(empty($_POST['param' . $param_id]))
		{
			$this->diafan->set_error('param'.$param_id, 'Введите e-mail, чтобы отправить письмо');
		}
		if(empty($_POST["text"]))
		{
			$this->diafan->set_error('text', 'Введите текст ответа, чтобы отправить письмо');
		}
		if(! $this->diafan->configmodules('subject', 'feedback', $_POST["site_id"], _LANG)
		|| ! $this->diafan->configmodules('message', 'feedback', $_POST["site_id"], _LANG))
		{
			$this->diafan->set_error('param'.$param_id, 'В конфигурации модуля необходимо указать тему и текст письма');
		}
		if(! EMAIL_CONFIG && (! $this->diafan->configmodules("emailconf", 'feedback', $_POST["site_id"]) || ! $this->diafan->configmodules("email", 'feedback', $_POST["site_id"])))
		{
			$this->diafan->set_error('param'.$param_id, 'В конфигурации модуля или в параметрах сайта необходимо e-mail, указываемый в обратном адресе');
		}
	}

	/**
	 * Отправляет письмо пользователю
	 * @return void
	 */
	public function save_variable_sendmail()
	{
		if (!empty($_POST["text"]))
		{
			$param_id = DB::query_result("SELECT id FROM {feedback_param} WHERE trash='0' AND site_id IN (0, %d) AND type='email' ORDER BY sort ASC LIMIT 1", $this->diafan->oldrow["site_id"]);
			if(empty( $_POST['param' . $param_id.'send']) || empty($_POST['param' . $param_id]))
			{
				return;
			}
			$email = $_POST['param' . $param_id];

			$message = $this->get_message();
			$subject = str_replace(array ( '%title', '%url' ), array ( TITLE, BASE_URL ), $this->diafan->configmodules('subject', 'feedback', $this->diafan->oldrow["site_id"], _LANG));

			$message = str_replace(array ( '%title', '%url', '%message', '%answer' ), array ( TITLE, BASE_URL, $message, $_POST["text"] ), $this->diafan->configmodules('message', 'feedback', $this->diafan->oldrow["site_id"], _LANG));

			include_once ABSOLUTE_PATH . 'includes/mail.php';
			send_mail($email, $subject, $message,
					  ( $this->diafan->configmodules("emailconf", 'feedback', $this->diafan->oldrow["site_id"])
					   && $this->diafan->configmodules("email", 'feedback', $this->diafan->oldrow["site_id"])
					   ? $this->diafan->configmodules("email", 'feedback', $this->diafan->oldrow["site_id"]) : '' ));
			$this->diafan->err = 5;
		}
	}

	/**
	 * Формирует текст письма пользователю
	 * @return string
	 */
	private function get_message()
	{
		$rows_param = array ();
		$result = DB::query("SELECT id, [name], type FROM {feedback_param} WHERE site_id=%d" . " AND trash='0' ORDER BY sort ASC", $this->diafan->oldrow["site_id"]);

		while ($row = DB::fetch_array($result))
		{
			if ($row["type"] == 'select' || $row["type"] == 'multiple')
			{
				$result_select = DB::query("SELECT [name], id FROM {feedback_param_select} WHERE param_id=%d" . " ORDER BY sort ASC", $row["id"]);
				while ($row_select = DB::fetch_array($result_select))
				{
					$row["select_array"][] = $row_select;
				}
			}
			$rows_param[] = $row;
		}

		$message = array ();

		foreach ($rows_param as $row)
		{
			if (empty( $_POST["param" . $row["id"]] ) && $row["type"] != "checkbox")
			{
				continue;
			}

			if ($row["type"] == "text" || $row["type"] == "textarea" || $row["type"] == "email")
			{
				$message[] = $row["name"] . ': ' . nl2br(htmlspecialchars(htmlspecialchars($_POST["param" . $row["id"]])));
			}
			elseif ($row["type"] == "numtext")
			{
				$message[] = $row["name"] . ': ' . (int)$this->diafan->get_param($_POST, "param" . $row["id"], '', 2);
			}
			elseif ($row["type"] == "date")
			{
				if ($_POST["param" . $row["id"]])
				{
					$message[] = $row["name"] . ': ' . date('d.m.Y', $_POST["param" . $row["id"]]);
				}
			}
			elseif ($row["type"] == "checkbox")
			{
				$value = !empty( $_POST["param" . $row["id"]] ) ? 1 : 0;
				$value_sel = DB::query_result("SELECT [name] FROM {feedback_param_select} WHERE value=%d AND param_id=%d LIMIT 1", $value, $row["id"]);
				if (!$value_sel && $value == 1)
				{
					$message[] = $row["name"];
				}
				elseif ($value_sel)
				{
					$message[] = $row["name"] . ': ' . $value_sel;
				}
			}
			elseif ($row["type"] == "select" && !empty( $row["select_array"] ))
			{
				foreach ($row["select_array"] as $select)
				{
					if ($select["id"] == $_POST["param" . $row["id"]])
					{
						$message[] = $row["name"] . ': ' . $select["name"];
					}
				}
			}
			elseif ($row["type"] == "multiple" && !empty( $row["select_array"] ) && !empty( $_POST["param" . $row["id"]] ) && is_array($_POST["param" . $row["id"]]))
			{
				$vals = array ();
				foreach ($row["select_array"] as $select)
				{
					if (in_array($select["id"], $_POST["param" . $row["id"]]))
					{
						$vals[] = $select["name"];
					}
				}
				$message[] = $row["name"] . ': ' . implode(", ", $vals);
			}
		}
		return implode('<br>', $message);
	}

	/**
	 * Сопутствующие действия при удалении элемента модуля
	 * @return void
	 */
	public function delete($del_id, $trash_id)
	{
		$this->diafan->del_or_trash_where("feedback_param_element", "element_id=" . $del_id, $trash_id);
	}
}