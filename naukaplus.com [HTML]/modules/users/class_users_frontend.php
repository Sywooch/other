<?php

#
# Общий родительский класс древовидных модулей
#


require_once 'class_abstract.php';  // абстрактный класс

class class_users_frontend extends class_abstract 
{

	
	/** шаблон, который должен быть использован при выводе страницы  */
	public $template = '';
		
	/** массив с полным перечнем данных пользователя */
	public $node = array();


	/**
	 * конструктор класса, инициализация
	 *
	 * @param unknown_type $mod_name	- навзание модуля
	 * @param unknown_type $std			- ссылка на общих класс функций
	 * @return class_parent
	 */
	function __construct( $mod_name, $std )
	{		
		$this->mod_name		= $mod_name;
		$this->std			= $std;
		$this->db			= &$std->db;
		$this->table		= $this->db->dbobj['sql_tbl_prefix'].$mod_name;
		$this->filepath	= $this->std->config['path_files'].'/'.$this->mod_name;
				
	}


	/**
	 * Центральная функция класса - вызывает все необходимые обработчики, определяет логику модуля
	 * ПЕРЕОПРЕДЕЛЕНИЕ
	 */
	public function main()
	{
	
		# подключение файла с шаблонами оформления данных
		if (file_exists( $this->std->config['path_templates'].'/'.$this->mod_name.'_t_config.php' ))
		{
			require_once $this->std->config['path_templates'].'/'.$this->mod_name.'_t_config.php';
			$this->skin = &$skin;
		}
		
		
		# форма авторизации нужна на каждой странице сайта
		$this->setPul($this->mod_name.'_login', $this->getUsersBlock());
		
		
		
		
		# инициализация прошла успешно, теперь проверяем, нужно ли запустить основной комплекс модуля
		if ($this->std->alias[0] != $this->mod_name)
		{
			# если вызывает другой модуль, то выход
			return;
		}
		
		
		
		
		
		# Выбор обработчика запрашиваемой операции
		$this->selectAction();

	}	
	
	
	



	/**
	 * Выбор обработчика запрашиваемой операции
	 *
	 */
	public function selectAction()
	{
		# заданы некие опреции, нужно выбрать запрашиваемую
		if (isset($this->std->alias[1]))
		{
			global $body, $h1, $title;
			
			switch ($this->std->alias[1])
			{
				case 'reg':
					$body = $this->regForm();
					$h1 = $title = 'Регистрация пользователя';
					$this->template = 'static';
					break;
				case 'doreg':
					$body = $this->regProfile();
					$h1 = $title = 'Регистрация пользователя';
					$this->template = 'static';
					break;
				case 'approve':
					$body = $this->approveUser();
					$h1 = $title = 'Регистрация пользователя';
					$this->template = 'static';
					break;
					
				case 'edit':
					$body = $this->editForm();
					$h1 = $title = 'Редактирование профиля';
					$this->template = 'static';					
					break;
				case 'doedit':
					$body = $this->editProfile();
					$h1 = $title = 'Редактирование профиля';
					$this->template = 'static';						
					break;
					
				case 'restore':
					$body = $this->restoreForm();
					$h1 = $title = 'Восстановление пароля';
					$this->template = 'static';
					break;
				case 'dorestore':
					$body = $this->restoreProfile();
					$h1 = $title = 'Восстановление пароля';
					$this->template = 'static';
					break;
					
				case 'mail':
					$body = $this->mailForm();
					$h1 = $title = 'Связь с администрацией сайта';
					$this->template = 'static';
					break;
				case 'domail':
					$this->mailProfile();
					break;
					
				case 'captcha':
					$this->getCaptcha();
					break;
				
				case 'logout':
					$this->logoutProfile();
					break;
				
				default:
					
			}
		}
		else
		{			
			$this->template = 'error';
		}
	}	
	
	
	/**
	 * Вывод формы для авторизации или вывод блока с информацией об авторизованном пользователе
	 * Проверка авторизации пользователя
	 * 
	 * @return unknown
	 */
	public function getUsersBlock()
	{
		$this->std->identification();
		
		if (isset($this->std->member["user_id"]))
		{
			$this->skin['user_block'] = $this->strtr_mod($this->skin['user_block'], $this->std->member);
			return $this->endRender($this->skin['user_block']);
		}
		else
		{
			$this->skin['login_form'] = str_replace('{error}', $this->getPul('error'), $this->skin['login_form']);
			
			return $this->endRender($this->skin['login_form']);
		}
	}
	
	
	/**
	 * Вывод формы восстановления пароля
	 *
	 */
	public function restoreForm()
	{
		return $this->endRender($this->skin['restore_form']);
	}
	
	
	
	/**
	 * Восстановление пароля
	 *
	 */
	public function restoreProfile()
	{
		if ($this->std->input['request_method'] == 'post')
		{
		
			# запрашиваем информацию о пользователе
			$sql = "SELECT * FROM {$this->table}
					WHERE user_email='".strtolower($this->std->input['user_email'])."'";

			if ($this->db->query($sql, $rows) > 0)
			{
				$user = $rows[0];
				$user['host'] = $this->std->host;
				
				$email = $user['user_email'];
				$title = $this->std->settings[$this->mod_name.'_restore_title'];
				$message = $this->strtr_mod($this->std->settings[$this->mod_name.'_restore'], $user);
				$this->mail($email, $title, $message);
				
				return $this->skin['restore_success'];
			}		
		}
		
		
		return $this->skin['restore_form'];
	}
	
	
	
	
	/**
	 * Вывод формы регистрации
	 *
	 */
	public function regForm()
	{
		$this->skin['reg_form'] = str_replace('{extend}', $this->skin['reg_form_extend'], $this->skin['reg_form']);
		return $this->endRender($this->skin['reg_form']);
	}
	
	
	
	/**
	 * Регистрация пользователя
	 *
	 */
	public function regProfile()
	{
		if ($this->std->input['request_method'] == 'post')
		{
			#------------------------------------------
			# нужно проверить входные данные
			#------------------------------------------
			
			
			$this->std->input['error'] = $this->validRegForm();
			
			if ($this->std->input['error'] == '')
			{
				$pms = array();
				$pms['user_name'] = $this->std->input['user_name'];
				$pms['user_pass'] = $this->std->input['user_pass'];
				$pms['user_email'] = $this->std->input['user_email'];				
				$pms['user_rectime'] = time();
				$pms['user_lastmod'] = time();
				$pms['user_access'] = 2;	// простой пользователь
				$pms['user_is_active'] = 1;
				$pms['user_is_ban'] = 0;
				$pms['user_is_valid'] = 0;				
				
				
				# дополнитиельные данные нужно упаковать в сериализованный массив
				$cache = array();
				foreach ($this->skin['reg_form_extend_necessary'] as $key => $value)
				{
					if (isset($this->std->input[$key]))
					{
						$cache[$key] = $this->std->input[$key];
					}
				}
				$pms['user_cache'] = serialize($cache);
				
				
				
				
				# создание нового пользователя
				$this->db->do_insert($this->mod_name, $pms);
				
				$pms['host'] = $this->std->host;
				$pms['user_id'] = $this->db->get_insert_id();
				
				$email = $pms['user_email'];
				$title = $this->std->settings[$this->mod_name.'_reg_title'];
				$message = $this->strtr_mod($this->std->settings[$this->mod_name.'_reg'], $pms);
				$this->mail($email, $title, $message);
				
				return $this->skin['reg_success'];
				
			}
			else
			{
				$this->skin['reg_form'] = str_replace('{extend}', $this->skin['reg_form_extend'], $this->skin['reg_form']);
				$this->skin['reg_form'] = $this->strtr_mod($this->skin['reg_form'], $this->std->input);
				return $this->skin['reg_form'];
			}
			  
		}
		else
		{
			return $this->endRender($this->skin['reg_form']);
		}
	}
	
	
	/**
	 * Вывод формы редактирования профиля
	 *
	 */
	public function editForm()
	{
		if (!isset($this->std->member['user_id']))
		{
			header('Location: /');
			exit;
		}
		
		
		# запрашиваем информацию о пользователе
		$sql = "SELECT * FROM {$this->table}
				WHERE user_id={$this->std->member['user_id']}";

		if ($this->db->query($sql, $rows) > 0)
		{
			$user = $rows[0];
			$user = array_merge(unserialize($user['user_cache']), $user);			
			
			
			$this->skin['edit_form'] = str_replace('{extend}', $this->skin['reg_form_extend'], $this->skin['edit_form']);
			$this->skin['edit_form'] = $this->strtr_mod($this->skin['edit_form'], $user);
			return $this->endRender($this->skin['edit_form']);
		}	
	}
	
	
	
	/**
	 * Редактирования профиля
	 *
	 */
	public function editProfile()
	{
		if ($this->std->input['request_method'] == 'post')
		{
			#------------------------------------------
			# нужно проверить входные данные
			#------------------------------------------
			
			
			$this->std->input['error'] = $this->validRegForm();
			
			if ($this->std->input['error'] == '')
			{
				$pms = array();
				$pms['user_pass'] = $this->std->input['user_pass'];
				$pms['user_email'] = $this->std->input['user_email'];				
				$pms['user_lastmod'] = time();
				$pms['user_is_modif'] = 1;				
				$pms['user_about'] = '';
				
				
				
				# дополнитиельные данные нужно упаковать в сериализованный массив
				$cache = array();
				foreach ($this->skin['reg_form_extend_necessary'] as $key => $value)
				{
					if (isset($this->std->input[$key]))
					{
						$cache[$key] = $this->std->input[$key];
					}
				}
				$pms['user_cache'] = serialize($cache);
				
				
				
				
				$this->db->do_update($this->mod_name, $pms, 'user_id='.$this->std->member['user_id']);
				
				$pms['host'] = $this->std->host;
				$pms['user_name'] = $this->std->member['user_name'];				
				
				$email = $pms['user_email'];
				$title = $this->std->settings[$this->mod_name.'_edit_title'];
				$message = $this->strtr_mod($this->std->settings[$this->mod_name.'_edit'], $pms);
				$this->mail($email, $title, $message);
				
				return $this->skin['edit_success'];
				
			}
			else
			{
				$this->std->input['user_name'] = $this->std->member['user_name'];
				$this->skin['edit_form'] = str_replace('{extend}', $this->skin['reg_form_extend'], $this->skin['edit_form']);
				$this->skin['edit_form'] = $this->strtr_mod($this->skin['edit_form'], $this->std->input);
				return $this->skin['edit_form'];
			}
			  
		}
		else
		{
			return $this->endRender($this->skin['edit_form']);
		}
	}
	
	
	
	/**
	 * проверка правильности введённых данных в форму регистрации 
	 *
	 */
	public function validRegForm()
	{
		$res = '';
		require_once( $this->std->config['path_lib'].'/captcha_lib.php' );
		$this->captcha_lib = new captcha_lib();
		$this->captcha_lib->std             = &$this->std;
		
		
		if (!isset($this->std->member['user_id']) && ($this->std->input['user_name'] == ''))
		{
			$res .= 'Вы не заполнили поле "Логин"<br>';
		}
		
		if ($this->std->input['user_email'] == '')
		{
			$res .= 'Вы не заполнили поле "E-mail"<br>';
		}
		elseif ($this->std->email_validate( $this->std->input['user_email']) == '')
		{
			$res .= 'Вы неверно заполнили поле "E-mail"<br>';
		}
		
		if ($this->std->input['user_pass'] != $this->std->input['user_pass2'])
		{
			$res .= 'Пароль и его повтор должны быть одинаковыми<br>';
		}
		
		
		
		# проверка заполненности необходимых полей
		foreach ($this->skin['reg_form_extend_necessary'] as $key => $value)
		{
			if (isset($this->std->input[$key]) && ($this->skin['reg_form_extend_necessary'][$key] != ''))
			{
				$res .= $this->std->input[$key] == '' ? $value : '';
			}
		}
		
		
		# проверка правильности введения
		if( !isset($this->std->member['user_id']) && (!$this->captcha_lib->captcha_validate( $this->std->input['captcha']) ))
		{			
			$res .=  'Некорректно введен регистрационный код<br>';
		}
		
		# проверяем, не зарегистрирован ли уже пользователь с таким логином
		if (!isset($this->std->member['user_id']))
		{
			$sql = "SELECT * FROM {$this->table} WHERE user_name = '{$this->std->input['user_name']}'";
			if ($this->db->query($sql, $rows) > 0)
			{
				$res .=  'Пользователь с логином "'.$this->std->input['user_name'].'" уже зарегистрирован<br>';
			}
		}
		
		# проверяем, не зарегистрирован ли уже пользователь с таким email-ом
		$sql = "SELECT * FROM {$this->table} WHERE user_email = '{$this->std->input['user_email']}'";
		if (isset($this->std->member['user_id']))
		{
			$sql = "SELECT * FROM {$this->table} WHERE user_id <> {$this->std->member['user_id']} AND user_email = '{$this->std->input['user_email']}'";
		}
		if ($this->db->query($sql, $rows) > 0)
		{
			$res .=  'Пользователь с почтовым адресом "'.$this->std->input['user_email'].'" уже зарегистрирован<br>';
		}
		
		
		return $res;
	}
	
	
	/**
	 * подтверждение регистрации пользователя
	 *
	 */
	public function approveUser()
	{
		if (isset($this->std->alias[2]))
		{
			$user_id = $this->std->StringToInt($this->std->alias[2]);
			
			$pms = array('user_is_valid' => 1);
			$this->db->do_update($this->mod_name, $pms, "user_id = '{$user_id}'");
			
			return $this->skin['approve_success']; 
		}
		else
		{
			return $this->skin['approve_error']; 
		}
	}
	
	
	
	
	/**
	 * Отправка уведомлений
	 *
	 * @param unknown_type $email
	 * @param unknown_type $title
	 * @param unknown_type $message
	 */
	function mail($email, $title, $message)
	{
		require_once( $this->std->config['path_lib'].'/class_mailer.php');
		$mailer = new ClassMailer();

        # отправка продавцу
		$mailer->to       = $email;
		$mailer->from = $this->std->settings['site_email'];
		$mailer->fullname     = $this->std->settings['site_title'];
		$mailer->subject  = $title;
		$mailer->message  = $message;
		$mailer->setHtml();				
		$mailer->send_mail();
	}
	
	
	
	
	/**
	 * Показ изображения капчи
	 *
	 * @return unknown
	 */
	function getCaptcha()
	{
		require_once( $this->std->config['path_lib'].'/captcha_lib.php' );
		$this->captcha_lib                  = new captcha_lib();
		$this->captcha_lib->std             = &$this->std;
		$this->captcha_lib->path_background = $this->std->config['path_modules'].'/users/backgrounds';

		return $this->captcha_lib->captcha_show( );
	}
	
	
	/**
	 * выход из профиля
	 *
	 */
	function logoutProfile()
	{
		$this->std->log_out();
	}

}


?>