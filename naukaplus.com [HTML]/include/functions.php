<?php


#
#        Супер класс содержит в себе ВСЕ (входящие переменные, методы работы с БД и т.д)
#


class FUNC {

	var $get_magic_quotes  = 0;
	var $user_agent        = '';
	var $browser           = '';
	var $operating_system  = '';
	var $ip_address        = '';
	var $db                = '';
	var $father				= array();


	# menu
	var $menu_array        = array();
	var $menu_by_id        = array();
	var $menu_cur_id		= -1;
	var $deaph             = 0;
	var $menu_mass         = array();
	var $array_key         = array();
	var $value_delim       = "";


	var $print_navi_js     = 0;

	var $depth_gide        = "--";
	var $access_titles 	= array();



	# install var
	var $install_var       = 0;



	#--------------------------------------------------------------------------
	# Блок переменных, используется для нового типа классов древовидных модулей
	#--------------------------------------------------------------------------
	public $modules		= array();
	public $config		= array();
	public $input		= array();
	public $host		= "";
	public $uri			= "";
	public $member		= array();
	public $alias		= array();

	/** список блоков с контектом для вывода на экран */
	public $pul			= array();

	/** информационных список всех модулей системы */
	public $modules_all	= array();

	public $session_id = null;
	//public $ucache = null;
	
	/**  класс - обработка фото   */
	public $image = null;
	
	/**  класс - обработка фото   */
	public $mail = null;
	
	
	/**  класс - пользователи   */
	public $users = null;

	#--------------------------------------------------------------------------
	# КОНЕЦ
	#--------------------------------------------------------------------------

	function __constructor($config)
	{
		$this->config = &$config;
		$this->get_magic_quotes = get_magic_quotes_gpc();

		# сбор данных о пользователе (браузер, ОС, IP)
		$this->identUserProp();
		 

		# есть смысл продолжнать если есть файл с настройками базы, иначе идём на УСТАНОВКУ
		if( !file_exists( $this->config['path_include']."/config_db.php" ) )
		{
			header("Location: ../install.php");
		}
		else
		{
			require $this->config['path_include']."/config_db.php";
		}


		# инициализация базы данных
		$this->init_db_connect($INFO);

		# назначение основных рабочих таблиц
		$this->defineTables();



		// Уровни доступа
		/*define ('ACCESS_ADMIN', 	1);
		define ('ACCESS_USER', 		2);
		define ('ACCESS_GUEST', 	3);
		define ('ACCESS_AUTHOR', 	4);
		define ('ACCESS_EDITOR', 	5);

		$this->access_titles = array(
		ACCESS_GUEST => 'Гость',
		ACCESS_USER => 'Пользователь',
		ACCESS_AUTHOR => 'Автор',
		ACCESS_EDITOR => 'Редактор',
		ACCESS_ADMIN => 'Администратор',
		);*/

		# входящие данные
		$this->input = $this->parse_incoming();

		
		# не выполняем, если УСТАНОВКА (install)
		if( $this->install_var != 1 )
		{
			// проверяем что хранится в сессии сессией
			$this->session_parse();
		
			#--------------------------------------------
			# Получаем из базы список настроек системы
			#--------------------------------------------
			$this->db->do_query("SELECT * FROM se_settings");
			while( $r = $this->db->fetch_row() )
			{
				$this->settings[$r['config_key']] = ($r['config_value'] != '' && $r['config_value'] != $r['config_default'])? $r['config_value'] : $r['config_default'];
	
			}
		}
		
		
	}

	
	#---------------------------------------------------------------------
	#---------------------------------------------------------------------
	# Начальная инициализация
	#---------------------------------------------------------------------
	#---------------------------------------------------------------------
	
	

	/**
	 * настройка параметров коннерка к ДБ
	 *
	 * @param unknown_type $INFO
	 */
	function init_db_connect($INFO)
	{
		 

		require ( $this->config['path_include'].'/mysql_db_driver.php' );

		$this->db = new db_driver;

		$this->db->dbobj['sql_database']     = $INFO['sql_database'];
		$this->db->dbobj['sql_user']         = $INFO['sql_user'];
		$this->db->dbobj['sql_pass']         = $INFO['sql_pass'];
		$this->db->dbobj['sql_host']         = $INFO['sql_host'];
		$this->db->dbobj['sql_tbl_prefix']   = $INFO['sql_tbl_prefix'];
		$this->db->std = &$this;

		//--------------------------------
		// Get a DB connection
		//--------------------------------

		$this->db->connect();

	}

	
	

	/**
	 * назначение основных рабочих таблиц
	 *
	 */
	private function defineTables()
	{
		// таблица модулей
		define ('TABLE_MODULES', TABLENAME_PREFIX.'modules');

		// таблица меню
		define('TABLE_MITEMS', TABLENAME_PREFIX.'mitems');

		// таблица пользователей
		define('TABLE_USER',TABLENAME_PREFIX.'users');
	}


	/**
	 * сбор данных о ПК пользователя (браузер, ОС, IP)
	 *
	 */
	private function identUserProp()
	{
		//-----------------------------------------
		// Sort out the accessing IP
		// (Thanks to Cosmos and schickb)
		//-----------------------------------------


		if ( $_SERVER['REMOTE_ADDR'] )
		{
			preg_match( "/^([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})$/", $_SERVER['REMOTE_ADDR'], $match );

			$this->ip_address = $match[1].'.'.$match[2].'.'.$match[3].'.'.$match[4];
		}

		//-----------------------------------------
		// Make sure we take a valid IP address
		//-----------------------------------------

		if ( ! $this->ip_address OR $this->ip_address == '...' )
		{
			print "Не возможно определить ваш IP адрес!";
			exit();
		}

		#Backwards compat:
		$this->input['IP_ADDRESS'] = $this->ip_address;


		//-----------------------------------------
		// Get user-agent, browser and OS
		//-----------------------------------------

		$this->user_agent       = $this->clean_value($_SERVER['HTTP_USER_AGENT']);
		$this->browser          = $this->fetch_browser();
		$this->operating_system = $this->fetch_os();
	}
	
	
	
	#---------------------------------------------------------------------
	#---------------------------------------------------------------------
	# КОНЕЦ: Начальная инициализация
	#---------------------------------------------------------------------
	#---------------------------------------------------------------------
	
	
	

	
	#---------------------------------------------------------------------------------
	#---------------------------------------------------------------------------------
	# АВТОРИЗАЦИЯ
	#---------------------------------------------------------------------------------
	#---------------------------------------------------------------------------------
	
	
	
	
	/**
	 * Формирование новой сессии для новых пользователей
	 *
	 */	
	function addSessionNew()
	{		
		$session_array = array( 'session_id' => $this->session_id, 
								'session_last_update' => time(),
								'session_cache' => serialize(array()) );

		// отправляем куку о сессии
		
		$this->setcookie('session_id', $this->session_id );
		$this->setcookie('authorization', 'no');
			

		# сохраняем в базе данных
		$this->db->do_insert( 'session', $session_array );
	}

	/**
	 * проверки сессии
	 */
	function session_parse()
	{
		$this->session_id = $this->my_getcookie('session_id');
		
		if (is_null($this->session_id))
		{
			# в куках сессии нет. Значит нужно создать
			$this->session_id = md5(microtime());
			$this->addSessionNew();
		}if (!$this->getSession())
		{
			# если данные не найдены, видимо база чистилась и нужно создать запись заново
			$this->addSessionNew();
			$this->getSession();
		}
	}
	
	
	/**
	 * По идентификатору сессии получаем все данные по предыдушей работе
	 *
	 * @return unknown
	 */
	public function getSession()
	{
		# в куках информация есть, нужно достать из базы всё с чем работал пользователь раньше
		$sql = "SELECT * FROM se_session WHERE session_id='".$this->session_id."'";
		if ($this->db->query($sql, $rows) > 0)
		{
			$row = $rows[0];
			$row['session_cache'] = $row['session_cache'] == '' ? array() : unserialize($row['session_cache']);
			$this->member = array_merge($this->member, $row);
			if ($this->member['user_id'] == 0) unset($this->member['user_id']);

			return true;
		}
		
		return false;
	}

	/**
	 * проверка входа пользователя
	 */
	function identification()
	{
		 
		# проверяем, хранится ли в куках указание на прошлую авторизацию
		$authorization = $this->my_getcookie('authorization');
		

		if ($authorization == 'yes')
		{
			# куки говорят, что пользователь уже авторизован, но нужно проверить			
			if ($this->member['session_cache'] != '')
			{	
				if (isset($this->member['session_cache']['user']))
				{
					$this->member = array_merge($this->member, $this->member['session_cache']['user']);
					//unset($this->member['session_cache']['user']);					
				}
				else
				{
					$this->log_out();
				}
			}
			else
			{
				//$this->log_out();
			}
			
		}
		else
		{
			
			if (isset($this->input['login']))
			{
				#---------------------------------------------
				# пользователь пытается авторизоваться
				#---------------------------------------------
				
				$sql = "SELECT * FROM `".TABLE_USER."` 
						WHERE user_is_active = 1 AND user_name='{$this->input['login']}' AND user_pass='{$this->input['password']}'";
						
						
				if ($this->db->query($sql, $rows) > 0)
				{
					$this->setcookie('authorization', 'yes');
					$row = $rows[0];
					$row = array_merge(unserialize($row['user_cache']), $row);
					$this->member['session_cache']['user'] = $row;					
					$this->member = array_merge($this->member, $row);
					
					// обновляем сессию в базе данных					
					$this->db->do_update('session', array('user_id' => $row['user_id'], 'session_cache' => serialize($this->member['session_cache'])), "session_id='{$this->session_id}'");
					
				}
				else
				{
					$this->setcookie('authorization', 'no');
					
					// ошибочный воод данных, неверные логин или пароль
					// die($this->auth_form('login_fail'));
					$this->setPul('users', 'error', 'Неверны логин или пароль');
				}
			}
			else
			{
				# чистим сессию пользователя
				$this->sessionUserClear();				
			}
		}

	}
	
	
	/**
	 * частичная чистка сесии от пользовательских данных
	 *
	 */
	function sessionUserClear()
	{
		# если пользователь не логинится
		unset($this->member['user_id']);
		unset($this->member['user_access']);
		unset($this->member['user_pass']);
		unset($this->member['user_cache']);
		unset($this->member['module_access']);
		unset($this->member['user_is_validate']);
		unset($this->member['user_email']);
		unset($this->member['user_name']);
	}
	
	
	/**
	 * Выход из авторизованного режима работы
	 *
	 * @param unknown_type $redirect
	 */
	function log_out( $redirect = 1 )
	{
		$this->setcookie('authorization'  , "no");
		
		# пользователь разлогинился, значит нужно почистить в БД его сессию
		$cache = $this->member['session_cache'];
		unset($cache['user']);	// убираем из кеша упоминания обо всех данных пользователя
		$pms = array();
		$pms['session_cache'] = serialize($cache);
		$pms['user_id'] = 0;
		$this->db->do_update('session', $pms, "session_id = '".$this->session_id."'");
		
		
		# чистим сессию пользователя
		$this->sessionUserClear();
		
		
		
		if( $redirect )
		{
			if (in_array($this->config['folder_admin'], $this->alias))
			{
				header("Location: /admin/");        // на логин в админку
				
			}
			else
			{
				header("Location: /");        // на главную
				exit;
			}
			
			
		}
	}
	
	
	#---------------------------------------------------------------------------------
	#---------------------------------------------------------------------------------
	# КОНЕЦ: авторизация
	#---------------------------------------------------------------------------------
	#---------------------------------------------------------------------------------
	




	#------------------------------------------------------------------------------
	# Работа с ПУЛом данных
	#------------------------------------------------------------------------------


	/**
	 * Получение значение пула=
	 *
	 * @param unknown_type $pul_name	- название блока
	 */
	public function getPul($mod_name, $pul_name)
	{
		if (isset($this->pul[$mod_name][$pul_name]))
		{
			return $this->pul[$mod_name][$pul_name];
		}		
		return '';		
	}


	/**
	 * Получение значение в виде массива
	 *
	 * @param unknown_type $pul_name	- название блока
	 */
	public function getPulArray($mod_name)
	{
		if (isset($this->pul[$mod_name]))
		{
			return $this->pul[$mod_name];
		}		
		return array();
	}

	/**
	 * Добавление в пул вывода данных
	 *
	 * @param unknown_type $mod_name	- название модуля
	 * @param unknown_type $pul_name	- название блока
	 * @param unknown_type $data		- контент
	 */
	public function setPul($mod_name, $pul_name, $data = '')
	{
		if ($pul_name != '')
		{
			if (!isset($this->pul[$mod_name]))
			{
				$this->pul[$mod_name] = array();
			}

			if (!isset($this->pul[$mod_name][$pul_name]))
			{
				$this->pul[$mod_name][$pul_name] = '';
			}

			$this->pul[$mod_name][$pul_name] .= $data;
		}
		return;
	}


	/**
	 * Замена в пуле некоторых данных
	 *
	 * @param unknown_type $pul_name	- название блока
	 * @param unknown_type $data		- контент
	 * @param unknown_type $key			- ключ замены
	 */
	public function replacePul($mod_name, $pul_name, $replace = array())
	{
		if ($pul_name != '')
		{
			# вызываем создание пула на случай, если он ещё не создан
			$this->setPul($mod_name, $pul_name);
			
			
			if (is_array($replace))
			{				
				foreach ($replace as $key => $value)
				{
					$pms['{'.$key.'}'] = $value;
				}
				
				
				$this->pul[$mod_name][$pul_name] = strtr($this->pul[$mod_name][$pul_name], $pms);
			}			
		}
		return;
	}
	

	/**
	 * одновление значение пула
	 *
	 * @param unknown_type $pul_name	- название блока
	 * @param unknown_type $data		- контент
	 */
	public function updatePul($mod_name, $pul_name, $data = '')
	{
		if ($pul_name != '')
		{
			# вызываем создание пула на случай, если он ещё не создан
			$this->setPul($mod_name, $pul_name);

			$this->pul[$mod_name][$pul_name] = $data;
		}
		return;
	}

	/**
	 * Очистка пула по названию
	 *
	 * @param unknown_type $mod_name	- название модуля
	 * @param unknown_type $pul_name	- название блока
	 */
	public function delPul($mod_name, $pul_name)
	{
		if ($pul_name != '')
		{
			if (isset($this->pul[$mod_name][$pul_name]))
			{
				unset($this->pul[$mod_name][$pul_name]);
			}
		}
		return;
	}

	/**
	 * Очистка всего пула
	 *
	 * @param unknown_type $mod_name	- название модуля
	 */
	public function emptyPul($mod_name)
	{
		if (isset($this->pul[$mod_name]))
		{
			unset($this->pul[$mod_name]);
		}
		return;
	}

	#------------------------------------------------------------------------------
	# КОНЕЦ: Работа с ПУЛом данных
	#------------------------------------------------------------------------------


	
	
	
	#------------------------------------------------------------------------------
	# Работа с изображениями
	#------------------------------------------------------------------------------
	
	/**
	 * Инициализация класса для ресайза фото
	 *
	 */
	public function initImage($mod_name)
	{
		$error = '';
		
		if (is_null($this->image))
		{
			if (file_exists($this->config['path_lib'].'/class_image.php'))
			{
				require ( $this->config['path_lib'].'/class_image.php' );
				$this->image = new ClassImage($this);
			}
			else
			{
				$error .= 'std->initImage :: Не найдена библиотека '.$this->config['path_lib'].'/class_image.php;'.chr(13); 
			}
								
		}
		
		
		if (!in_array($mod_name, array_keys ($this->modules_all)))
		{
			$error .= 'std->initImage :: '.$mod_name.' - Неверно указано название вызывающей модуля;'.chr(13);
		}
				
		
		if ($error == '')
		{
			$this->image->mod_name = $mod_name;			
		}
		else
		{
			$this->log($error);
			return $error;
		}
		
		return '';
	}
	
	
	
	#------------------------------------------------------------------------------
	# КОНЕЦ: Работа с изображениями
	#------------------------------------------------------------------------------
	
	
	
	
	
	
	#------------------------------------------------------------------------------
	# Работа с почтой
	#------------------------------------------------------------------------------
	
	/**
	 * Инициализация класса почты
	 *
	 */
	public function initMail()
	{
		$error = '';
		
		if (is_null($this->mail))
		{
			if (file_exists($this->config['path_lib'].'/class_mailer.php'))
			{
				require_once $this->config['path_lib'].'/class_mailer.php';
				$this->mail = new ClassMailer();
			}
			else
			{
				$error .= 'std->initImage :: Не найдена библиотека '.$this->config['path_lib'].'/class_mailer.php;'.chr(13); 
			}
								
		}
		
		
		if ($error != '')
		{
			$this->log($error);
			return $error;	
		}
		
		return '';
	}
	
	
	
	#------------------------------------------------------------------------------
	# КОНЕЦ: Работа с почтой
	#------------------------------------------------------------------------------
	
	
	
	
	
	
	
	
	
	
	
	
	#------------------------------------------------------------------------------
	#------------------------------------------------------------------------------
	#------------------------------------------------------------------------------
	#------------------------------------------------------------------------------
	# служебные функции
	#------------------------------------------------------------------------------
	#------------------------------------------------------------------------------
	#------------------------------------------------------------------------------
	#------------------------------------------------------------------------------
	
	

	/**
	 * Вывод сообщения в лог
	 */
	public function log($text)
	{
		error_log(strftime("%d.%m.%Y %H:%M:%S")." ".$text."\n", 3, $this->config['errorlog']);
	}
	

	/**
	 * Представление timestamp в человекоудобном виде
	 */   
	function getSystemTime ($timestamp = '', $format = 'j.m.Y H:i')
	{
		$timestamp = $timestamp == '' ? time() : $timestamp;
		
		$month = array( 
			"January"	=> "Января",
			"February"	=> "Февраля",
			"March"		=> "Марта",
			"April"		=> "Апреля",
			"May"		=> "Мая",
			"June"		=> "Июня",
			"July"		=> "Июля",
			"August"	=> "Августа",
			"September"	=> "Сентября",
			"October"	=> "Октября",
			"November"	=> "Ноября",
			"December"	=> "Декабря");
		
		$return = date($format, $timestamp);				
		return strtr($return, $month);
	}
	
	
	/**
	 * Преобразование человекоудобного вида даты в UNIX-timestamp
	 *
	 * @param unknown_type $time
	 * @return unknown
	 */
	function getTimestamp( $time = '')
	{
		if ($time != '')
		{
			$timestamp=preg_split("/[\.\: ]/", $time);
	
			if( !preg_match("/^([0-9]+){1,2}$/",$timestamp[0]) or
			!preg_match("/^([0-9]+){1,2}$/",$timestamp[1]) or
			!preg_match("/^([0-9]+){4}$/",$timestamp[2])   or
			!preg_match("/^([0-9]+){1,2}$/",$timestamp[3]) or
			!preg_match("/^([0-9]+){1,2}$/",$timestamp[4]))
			{
				# если не получилось разобрать дату, то возвращаем текущее время
				return time();
			}
			else
			{
				# если дата распознана, то возвращаем его timestamp представление
				return mktime($timestamp[3],$timestamp[4],0,$timestamp[1],$timestamp[0],$timestamp[2]);
			}
		}
		else
		{
			# если параметра нет, то возвращаем текущее время
			return time();
		}
	}
	
	
	
	
	 /**
	  * проверка пришедшего урла, правка его при наличии недочётов или лишностей
	  *
	  * @param unknown_type $host
	  * @param unknown_type $uri
	  * @param unknown_type $alias
	  * @param unknown_type $alias_count
	  * @param unknown_type $init_modules
	  */
	function uriCheck(&$host, &$uri, &$alias,  &$alias_count, &$init_modules)
	{
		$host = $_SERVER['HTTP_HOST'];
		$this->host = $host;
		$uri = $_SERVER['REQUEST_URI'];
		$this->uri = $uri;
		$redirect = false;

		// если вызывают админку
		if (strpos($uri, 'admin') == 1)
		{
			//-----------------------------------
			// Если вызван урл /admin то запрашиваем /admin/
			//-----------------------------------
			$this->alias = explode('/',substr($uri,1,strlen($uri)-2));
			if( !preg_match( "#^/admin/#is", $uri ) )
			{
				$uri = str_replace( "/admin", "/admin/", $uri );
				header ("Location: http://".$host.$uri);
				exit();
			}
			require_once($this->config['path_admin']."/administrator.php");
			$admin = new admin_index();
			$admin->std = &$this;
			$admin->init();
			exit();
		}

		// Если в набранном URL есть ?
		// Если в набранном URL не стоит слэша в конце
		// Если в набранном URL не стоит www
		// Если в набранном URL лишние слэши
		// Если в набранном URL лишний index.php
		// Если в набранном URL лишний index.
		// Если в набранном URL лишний index

		if (preg_match('/([A-Z])/s', $uri))
		{
			//$redirect = true;
			$uri = strtolower($uri);
		}

		if (strpos($uri,'?'))
		{
			$redirect = true;
			$uri = substr($uri,0,strpos($uri,'?'));
		}
		if ($uri[strlen($uri)-1] != '/')
		{
			$redirect = true;
			$uri.="/";
		}
		if (substr($host,0,3) != 'www')
		 {
		 $redirect = true;
		 $host = "www.".$host;
		 }
		while (strpos($uri, '//') !== false)
		{
			$redirect = true;
			$uri = str_replace('//', '/', $uri);
		}

		if (preg_match('/index.php/',$uri))
		{
			$redirect = true;
			$uri = str_replace('/index.php/', '/', $uri);
		}
		if (preg_match('/index./',$uri))
		{
			$redirect = true;
			$uri = str_replace('/index./', '/', $uri);
		}
		if (preg_match('/index/',$uri))
		{
			$redirect = true;
			$uri = str_replace('/index/', '/', $uri);
		}

		if (preg_match('/([A-Z])/s', $uri))
		{
			//$redirect = true;
			$uri = strtolower($uri);
		}

		// Очистка URL от добавляемого 80-го порта и выполнение редиректа 301
		/*
		 if (substr($host,-3)==':80')
		 {
		 $redirect = true;
		 $host=substr($host,0,-3);
		 }
		 */
		if ($redirect)
		{
			//header ("HTTP/1.1 301 Moved Permanently");
			//header ("Location: http://".$host.$uri);

			$this->globalRedirect( "http://".$host.$uri );
			// still here? О.о
			exit();
		}

		// Массив введенных алиасов
		$alias = explode('/',substr($uri,1,strlen($uri)-2));
		if (count($alias) > 0)
		{
			if ($alias[0] == '')
			{
				$alias = array();
			}
		}

		// Количество элементов в массиве алиасов
		$alias_count = 0;
		$alias_count = count($alias);

		/****************************************************************************
		 *  просто опереляем родителя для текущей страницы                           *
		 ****************************************************************************/

		$this->parse_father();

		# проверка на всяческие инжекты, очистка опасных данных
		$this->clean_alies( $alias );

		# год
		global $year;
		$year = date("Y");


		# возможно работает модуль "print", значит нужно проверить это
		$alias = $this->workPrintPage( $alias );
		$this->alias = $alias;
	}

	/**
	 * Если работает модуль "print", то проверяем это и взводим флаг
	 */
	function workPrintPage( $a = array())
	{
		$return = array();
		if( !is_array($a) )
		{
			return array();
		}
		elseif( count( $a ) < 1)
		{
			return array();
		}

		foreach( $a as $k => $v  )
		{
			if( $v == 'print' )
			{
				$this->print_page = 1;
				$_SERVER['REQUEST_URI'] = preg_replace( '#print(/$|$)$#is', '', $_SERVER['REQUEST_URI'] );
			}
			else
			{
				$return[] = $v;
			}

		}

		return $return;
	}



	/**
	 * Составление списка файлов html в указанной директории
	 *
	 * @param unknown_type $dir
	 * @return unknown
	 */
	function getHTMLFilesList( $dir = '' )
	{
		$dir = $dir == '' ? $this->config['path_templates'] : $dir;

		$files = array();

		if ( is_dir($dir) )
		{
			$handle = opendir($dir);

			while ( ($filename = readdir($handle)) !== false )
			{
				if (($filename != ".") and ($filename != ".."))
				{
					if (preg_match("/^(.+?)\.html$/is", $filename, $match))
					{
						$files[] = $match[1];
					}
				}
			}

			closedir($handle);
		}

		return $files;
	}
	
	
	
	/**
	 * Создание мата тегов
	 *
	 * @param unknown_type $txt
	 * @param unknown_type $type
	 * @return unknown
	 */
	function build_meta_tags( $txt = '', $type = '' )
	{
		if(!$txt or !$type) return '';

		return "<meta name=\"{$type}\" content=\"{$txt}\">\n";
	}
	
	
	
	#------------------------------------------------------------------------------
	#------------------------------------------------------------------------------
	#------------------------------------------------------------------------------
	#------------------------------------------------------------------------------
	# КОНЕЦ: служебные функции
	#------------------------------------------------------------------------------
	#------------------------------------------------------------------------------
	#------------------------------------------------------------------------------
	#------------------------------------------------------------------------------
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	


	/*-------------------------------------------------------------------------*/
	// Формирователь массивов меню
	/*-------------------------------------------------------------------------*/
	/**
	 * Формируем два массива:
	 *   - просто массив мененю
	 *   - массив дерева меню
	 *
	 * @param        void
	 * @return       void
	 */

	function parse_menu()
	{
		$sql        = "select * from ".TABLE_MITEMS." WHERE is_active=1 ORDER BY pid, item_order, id";
		$this->db->do_query($sql);

		while( $row = $this->db->fetch_row() )
		{
			if( $row['pid'] < 1 )
			{
				$row['pid'] = 'root';
			}

			$this->menu_array[ $row['pid'] ][ $row['id'] ] = $row;
			$this->menu_by_id[ $row['id'] ]                = &$this->menu_array[$row['pid'] ][ $row['id'] ];
		}

	}

	/*-------------------------------------------------------------------------*/
	// Берем по алиасу
	/*-------------------------------------------------------------------------*/
	/**
	 * пробегает полностью по массиву алисов
	 * и ищет алиас с совпадающим id
	 *
	 * @param        string       alias
	 * @return       array        count and id
	 */

	function count_ids_by_menu( $alias_menu )
	{
		$count_menu = 0;
		$alias_data = array();

		foreach( $this->menu_by_id as $_id => $_data )
		{
			if( $_data['alias'] == $alias_menu )
			{
				$count_menu++;
				$alias_data = $_data;
				//break;
			}
		}

		return array( 'count' => $count_menu, 'manudata' => $alias_data );
	}

	/*********************************************************************************
	 вывод смежных вершин меню
	 **********************************************************************************/
	function adjacentMenu( $alias_menu = '' )
	{
		global $uri;
		global $_adjacent_menu;

		$alias_menu = (!$alias_menu) ? 'static' : $alias_menu;
		if( count( $_adjacent_menu[ $alias_menu ] ) )
		{
			$_template = $_adjacent_menu[ $alias_menu ];
		}
		else
		{
			if( count($_adjacent_menu['static']) )
			{
				$_template = $_adjacent_menu['static'];
			}
			else
			{
				$_template = $_adjacent_menu;
			}
		}

		$data = $this->count_ids_by_menu( $uri );

		$menu = '';

		$childs = array();
		$childs = $this->menu_item_childs($data['manudata']['pid']);
		if (count($childs) == 0) return $menu;
		
		
		
		$this->count_menu = count($childs);
		
		

		if( $_template['megadelimiter'] )
		{
			$this->parcer_magadelimeter( $_template['megadelimiter'] );
		}

		$count = 1;

		foreach ($childs as $child) // по всем пунктам меню
		{
			$menu .= $this->createNode($child, $_template, &$menu);

				if( $this->parse_delimeter[ $count ] )
				{
					$menu .= $this->parse_delimeter[ $count ];
				}
				$count++;

				// new change
				$childs = $this->menu_item_childs($child['id']);
				$count_childs = $this->CalcClidren( $child['id'] );//count($childs);
				$menu = str_replace('{COUNTCHILDS}', $count_childs, $menu);

		}

		if( is_array($_template['begin']) )
		{
			$delimeter = $_template['delimiter'][1];
			$begin     = $_template['begin'][1];
			$end       = $_template['end'][1];
		}
		else
		{
			$delimeter = $_template['delimiter'];
			$begin     = $_template['begin'];
			$end       = $_template['end'];
		}

		$delimeter = $this->CleanPCRE($delimeter);
		$replace = "#{$delimeter}$#is";
		$menu = $begin.preg_replace( $replace, "",  $menu).$end;
		$menu = $this->UnCleanPCRE( $menu);
		$this->parse_delimeter = array();

		return $menu;
	}



	/**
	 * вывод смежных вершин меню
	 *
	 * @param unknown_type $alias_menu
	 * @param unknown_type $type
	 * @return unknown
	 */
	function childMenu( $alias_menu= '', $type = 0  )
	{
		global $uri;
		global $_child_menu, $_child_menu_without_childs, $_child_menu_with_childs;

		$alias_menu = (!$alias_menu) ? 'static' : $alias_menu;
		if( $type == 0 )
		{
			if( count( $_child_menu[ $alias_menu ] ) )
			{
				$_template = $_child_menu[ $alias_menu ];
			}
			else
			{
				if( count($_child_menu['static']) )
				{
					$_template = $_child_menu['static'];
				}
				else
				{
					$_template = $_child_menu;
				}
			}
		}
		elseif( $type == 1 )
		{
			if( count( $_child_menu_with_childs[ $alias_menu ] ) )
			{
				$_template = $_child_menu_with_childs[ $alias_menu ];
			}
			else
			{
				if( count($_child_menu_with_childs['static']) )
				{
					$_template = $_child_menu_with_childs['static'];
				}
				else
				{
					$_template = $_child_menu_with_childs;
				}
			}
		}
		else
		{
			if( count( $_child_menu_without_childs[ $alias_menu ] ) )
			{
				$_template = $_child_menu_without_childs[ $alias_menu ];
			}
			else
			{
				if( count($_child_menu_without_childs['static']) )
				{
					$_template = $_child_menu_without_childs['static'];
				}
				else
				{
					$_template = $_child_menu_without_childs;
				}
			}
		}

		$menu = '';

		// получаем смежные вершины
		$data = $this->count_ids_by_menu( $uri );

		$childs = array();
		$childs = $this->menu_item_childs($data['manudata']['id']);
		if (count($childs) == 0) return $menu;
		
		
		$this->count_menu = count($childs);

		if( $_template['megadelimiter'] )
		{
			$this->parcer_magadelimeter( $_template['megadelimiter'] );
		}

		$count = 1;
		foreach ($childs as $child) // по всем пунктам меню
		{
			if ($child['alias'] != $uri)
			{
				$childs = $this->menu_item_childs($child['id']);
				$count_childs = $this->CalcClidren( $child['id'] );//count($childs);

				// запрос статических страниц, отец у которых равен $pid
				if(!$type)
				{
					$menu .= $this->createNode($child, $_template, &$menu);
				}
				// выводим детей с подчиненными
				elseif( $type == 1 )
				{
					if( $count_childs > 0 )
					{
						$menu .= $this->createNode($child, $_template, &$menu);
					}
				}
				// выводим детей без подчиненных
				elseif( $type == 2 )
				{
					if( $count_childs < 1 )
					{
						$menu .= $this->createNode($child, $_template, &$menu);
					}
				}

				if( $this->parse_delimeter[ $count ] )
				{
					$menu .= $this->parse_delimeter[ $count ];
				}
				$count++;

				// new change
				$menu = str_replace('{COUNTCHILDS}', $count_childs, $menu);
			}
		}

		if( is_array($_template['begin']) )
		{
			$delimeter = $_template['delimiter'][1];
			$begin     = $_template['begin'][1];
			$end       = $_template['end'][1];
		}
		else
		{
			$delimeter = $_template['delimiter'];
			$begin     = $_template['begin'];
			$end       = $_template['end'];
		}

		$delimeter = $this->CleanPCRE( $delimeter);
		$replace = "#{$delimeter}$#is";
		$menu = $begin.preg_replace( $replace, "",  $menu).$end;
		$menu = $this->UnCleanPCRE($menu);
		$this->parse_delimeter = array();
		return  $menu;
	}

	function menu_html_update($menu, $_template )
	{	
		if( is_array($_template['begin']) )
		{
			$delimeter = $_template['delimiter'][1];
			$begin     = $_template['begin'][1];
			$end       = $_template['end'][1];
		}
		else
		{
			$delimeter = $_template['delimiter'];
			$begin     = $_template['begin'];
			$end       = $_template['end'];
		}

		$delimeter = $this->CleanPCRE($delimeter);
		$replace = "#{$delimeter}$#is";
		$menu = $begin.preg_replace( $replace, "",  $menu).$end;
		$menu = $this->UnCleanPCRE($menu);

		return $menu;
	}

	/*-------------------------------------------------------------------------*/
	// Экранирование регулярного выражения
	/*-------------------------------------------------------------------------*/
	/**
	 * Экранирование всех спец символов регярного выражения
	 *
	 * @param        string       string to clean
	 * @return       string       cleaned string
	 */


	function CleanPCRE( $SctingToConvert = '' )
	{

		$SctingToConvert = str_replace("\\", "\\\\", $SctingToConvert);
		$SctingToConvert = str_replace("^", "\^", $SctingToConvert);
		$SctingToConvert = str_replace("$", "\$", $SctingToConvert);
		$SctingToConvert = str_replace(".", "\.", $SctingToConvert);
		$SctingToConvert = str_replace("[", "\[", $SctingToConvert);
		$SctingToConvert = str_replace("]", "\]", $SctingToConvert);
		$SctingToConvert = str_replace("|", "\|", $SctingToConvert);
		$SctingToConvert = str_replace("(", "\(", $SctingToConvert);
		$SctingToConvert = str_replace(")", "\)", $SctingToConvert);
		$SctingToConvert = str_replace("{", "\{", $SctingToConvert);
		$SctingToConvert = str_replace("}", "\}", $SctingToConvert);
		$SctingToConvert = str_replace("+", "\+", $SctingToConvert);
		$SctingToConvert = str_replace("*", "\*", $SctingToConvert);
		$SctingToConvert = str_replace("?", "\?", $SctingToConvert);
		$SctingToConvert = str_replace("#", "\#", $SctingToConvert);
		$SctingToConvert = str_replace("&", "\&", $SctingToConvert);

		return $SctingToConvert;
	}

	/*-------------------------------------------------------------------------*/
	// Очистка экранированного выражения
	/*-------------------------------------------------------------------------*/
	/**
	 * Метод убирает символ экранирования, стоящий перед спец.символами, из строки
	 *
	 * @param        string       string to clean
	 * @return       string       cleaned string
	 */

	function UnCleanPCRE( $SctingToConvert = '' )
	{

		$SctingToConvert = str_replace("\\\\", "\\", $SctingToConvert);
		$SctingToConvert = str_replace("\^", "^", $SctingToConvert);
		$SctingToConvert = str_replace("\$", "$", $SctingToConvert);
		$SctingToConvert = str_replace("\.", ".", $SctingToConvert);
		$SctingToConvert = str_replace("\[", "[", $SctingToConvert);
		$SctingToConvert = str_replace("\]", "]", $SctingToConvert);
		$SctingToConvert = str_replace("\|", "|", $SctingToConvert);
		$SctingToConvert = str_replace("\(", "(", $SctingToConvert);
		$SctingToConvert = str_replace("\)", ")", $SctingToConvert);
		$SctingToConvert = str_replace("\{", "{", $SctingToConvert);
		$SctingToConvert = str_replace("\}", "}", $SctingToConvert);
		$SctingToConvert = str_replace("\+", "+", $SctingToConvert);
		$SctingToConvert = str_replace("\*", "*", $SctingToConvert);
		$SctingToConvert = str_replace("\?", "?", $SctingToConvert);
		$SctingToConvert = str_replace("\#", "#", $SctingToConvert);
		$SctingToConvert = str_replace("\&", "&", $SctingToConvert);

		return $SctingToConvert;
	}

	
	
	/**
	 * получение списка идентификаторов ВСЕХ детей одной вершины, включая саму вершину
	 *
	 * @param unknown_type $id
	 */
	protected function getNodeChildsId($id)
	{
		$ids = array();
		if (isset($this->menu_array[$id]))
		{
			foreach ($this->menu_array[$id] as $node)
			{				
				$ids = array_merge($ids, $this->getNodeChildsId($node['id']));
			}
		}
		return array_merge(array($id), $ids);	
	}
	
	
	/**
	 * составление списка вершин одного меню, которые участвуют в формировании текущего пути по сайту
	 *
	 * @param unknown_type $uri			- текущий урл
	 * @param unknown_type $menu_id		- идентификатор составляемого меню
	 * @return unknown
	 */
	function getIdsByUri( $uri,  $menu_id)
	{
		$res = array();
		$this->menu_cur_id = -1;
		
		# все вершины одного меню
		$ids_menu = $this->getNodeChildsId($menu_id);
		
		
		# поиск вершины с текущим URI
		$cur_id = '';
		foreach ($this->menu_by_id as $node)
		{
			
			if (in_array($node['id'], $ids_menu))
			{
				# вершины входит в список вершин составляемого меню
				
				if ($node['alias'] == $uri)
				{
					$this->menu_cur_id = $node['id'];
					break;
				}
			}			
		}
		
		if ($this->menu_cur_id != -1)
		{
				# первая вершина найдена
				$res[] = $this->menu_cur_id;
				$cur_id = $this->menu_cur_id;
			
			
				# теперь нужно пройти наверх до корня и собрать все идентификаторы
				
				while ( $this->menu_by_id[$cur_id]['pid'] != 'root')
				{
					$cur_id = $this->menu_by_id[$cur_id]['pid'];
					$res[] = $cur_id;
				}
			
		}
		
				
		return $res;
	}
	

	function menu_select($id, $flag_view, $_template)
	{

		#---------------------------------------------------------------------------
		# поиск всех идентификаторов вершин, участвующих в составлении текущего пути
		#---------------------------------------------------------------------------
		
		
		$uri_ids = $this->getIdsByUri( $this->uri, $id );
		
		
		switch ($flag_view)
		{
			case 0:  // только первый уровень, не выводить вложенностей
				$menu = $this->menu_flag_view_0($id, $_template, $uri_ids);
				$menu = $this->menu_html_update($menu, $_template);
				return $menu;
				break;
			case 1:
				// выводит дерево
				$menu = $this->menu_flag_view_1($id, $_template, 1, $uri_ids);
				$menu = $this->menu_html_update($menu, $_template);
				return $menu;
				break;
			case 2:
				// выводит дерево
				$menu = $this->menu_flag_view_2($id, $_template, 1, $uri_ids);
				$menu = $this->menu_html_update($menu, $_template);
				return $menu;
				break;
			default:
				return '';
		}
	}

	/*------------------------------------------------------------------*/
	// парсер мегаделиметра
	//    * разбирает темплейт на числа и проценты
	/*------------------------------------------------------------------*/

	function parcer_magadelimeter(  $megadelimiter = ''  )
	{
		if( $this->count_menu < 1 )
		{
			return;
		}
		if( $megadelimiter and is_array($megadelimiter) )
		{
			$array_key = array();

			foreach( $megadelimiter as $k => $v )
			{
				// парсим значения через сепаратор запятую
				$this->array_key   = explode(',' , $k);

				// чистим значения
				foreach( $this->array_key as $_tid => $d )
				{
					// для обработки вызовем дополнителью Функцию из обработчика preg_replace
					$d = preg_replace("#^(\d+)(.+?)$#ie", "\$this->replace_megadelimeter('\\1', '\\2')", $d);

					// обновим значение
					$this->array_key[ $_tid ] = $d;
				}

				// применяем мегаделиметер для подстановки в определенные места
				foreach( $this->array_key as $s => $num)
				{
					//$this->count_menu

					if( preg_match( "#^\d+%$#is", $num ) )
					{
						$num      = intval($num);
						$percent  = ceil(100/$this->count_menu);
						$percent_tmp = $percent;
						$last_per = 0;
						$i = 1;

						while( $percent < 100 )
						{
							if( $last_per <= $num and $num <= $percent )
							{
								$this->parse_delimeter[ $i ] = $v;
								break;
							}

							$last_per = $percent;
							$i++;
							$percent += $percent_tmp;
						}

					}
					else
					{
						$this->parse_delimeter[ $num ] = $v;
					}
				}

				break;
			}
		}
	}


	/*------------------------------------------------------------------*/
	// Подсчитываем количество детей
	/*------------------------------------------------------------------*/

	function CalcClidren( $FatherID = 0, $FirstReq = 1 )
	{
		// если первый вызов функции для подсчета то обнуляется счетчик
		if( $FirstReq )
		{
			$this->CountCildren = 0;
		}

		// проверяем есть ли такая вершина для подсчета детей
		if( is_array( $this->menu_array[ $FatherID ] ) )
		{
			// пробегаемся по блоку подуровня
			foreach( $this->menu_array[ $FatherID ] as $menu_data )
			{
				// прибавляем
				$this->CountCildren++;

				// рекурсивный вызов для просмотра поддетей
				$this->CalcClidren( $menu_data['id'], 0 );
			}
		}

		// если у нас есть дети то прибавляем единицу т.к. начинали с нуля
		return $this->CountCildren;
	}


	/*------------------------------------------------------------------*/
	// очитка значений элементов мегаделиметра
	/*------------------------------------------------------------------*/

	function replace_megadelimeter( $d = 0, $percent = "" )
	{
		if( $d <= 0 )
		{
			return 0;
		}

		if( substr_count( $percent, "%" ) )
		{
			$percent = '%';
		}
		else
		{
			$percent = '';
		}

		return $d.$percent;
	}

	/***************************************************************************************************************
	 вывод меню без вложений, используются: начало и конец меню, разделитель, активный и неактивный пункты меню
	 используется для вывода как пунтов верхнего уровня меню, так и любых вложенный, основой является идентификатор
	 ***************************************************************************************************************/
	function menu_flag_view_0($id, $_template, &$uri_ids = array())
	{
		$menu                = '';

		$childs = $this->menu_item_childs($id); // запрос информации о детях пункта

		$this->count_menu = count($childs);
		if( $_template['megadelimiter'] )
		{
			$this->parcer_magadelimeter( $_template['megadelimiter'] );
		}

		$count = 1;
		foreach ($childs as $child)     // по всем пунктам меню
		{
			$menu .= $this->createNode($child, $_template, 1, 1, $uri_ids);
			if( $this->parse_delimeter[ $count ] )
			{
				$menu .= $this->parse_delimeter[ $count ];
			}
			$count++;

			// сколько подчинённых
			$childs_arr = $this->menu_item_childs($child['id']);
			$count_childs = $this->CalcClidren( $child['id'] );//count($childs_arr);
			$menu = str_replace('{COUNTCHILDS}', $count_childs, $menu);
		}

		$this->parse_delimeter = array();
		return $menu;
	}

	/***************************************************************************
	 получение перечня детей пункта
	 вход:         id - идентификатор
	 выход:  childs - идентификаторы детей (состав подменю)
	 ***************************************************************************/
	function menu_item_childs( $id )
	{
		if( is_array($this->menu_array[ $id ]) )
		{
			$return = $this->menu_array[ $id ];
			return $return;
		}
		else
		{
			return array();
		}
	}

	

	/**********************************************************************************************************************
	 вывод меню c одним уровнем подменю, используются: начало и конец меню, разделитель, активный и неактивный пункты меню
	 используется для вывода как пунтов верхнего уровня меню, так и любых вложенный, основой является идентификатор
	 ***********************************************************************************************************************/
	function menu_flag_view_1($id, $_template, $d = 1, &$uri_ids = array())
	{
		global $uri;

		$tree                = '';
		// запрос статических страниц, отец у которых равен $pid
		$childs = $this->menu_item_childs($id);   // запрос информации о детях пункта

		if( count($childs) < 1 )
		{
			return "";
		}

		if( $d == 1 )
		{
			$this->count_menu = count($childs);
			if( $_template['megadelimiter'] )
			{
				$this->parcer_magadelimeter( $_template['megadelimiter'] );
			}
		}

		$_template['depth'] = intval($_template['depth']);
		if( $_template['depth'] < 0 )
		{
			$_template['depth'] = 0;
		}

		// применяем ограничение вложенности
		if( $_template['depth'] and $_template['depth']< $d )
		{
			return;
		}

		// new change
		// $count_childs = $this->CalcClidren( $id );//count($childs);

		$level_ = $d;

		if( $_template['inactive'][ $d ] and $d > 0 and is_array($_template['inactive']) )
		{
			$temp_bullet   = $_template['bullet'][ $d ];
			$temp_delimiter = $_template['delimiter'][ $d ];
			$this->temp_begin     = $_template['begin'][ $d ];
			$this->temp_end       = $_template['end'][ $d  ];
			$this->last_level = $d;
		}
		elseif( $this->last_level )
		{
			$temp_bullet   = $_template['bullet'][ $this->last_level ];
			$temp_delimiter = $_template['delimiter'][ $this->last_level ];
			$this->temp_begin     = $_template['begin'][ $this->last_level ];
			$this->temp_end       = $_template['end'][ $this->last_level ];
		}
		else
		{
			$temp_bullet   = $_template['bullet'];
			$temp_delimiter = $_template['delimiter'];
			$this->temp_begin     = $_template['begin'];
			$this->temp_end       = $_template['end'];
		}

		$this->last_delimeter = $temp_delimiter;

		$this->deaph++;
		$count = 1;

		foreach ($childs as $child) // по всем пунктам меню
		{

			$count_childs = $this->CalcClidren( $child["id"] );

			$node = '';
			$node = $this->createNode($child, $_template, $this->last_level, 0, $uri_ids);

			$this->last_delimeter = $temp_delimiter;

			if (in_array($child['id'], $uri_ids))
			{

				$tmps = $temp_bullet.$node;
				$tmps = str_replace('{COUNTCHILDS}', $count_childs, $tmps);
				$tree             .= $tmps;


				$tree .= $temp_delimiter;

				$this->prev_delimeter = $temp_delimiter;

				$tmp = $this->menu_flag_view_1($child['id'], $_template, ($d+1), $uri_ids);

				if ($tmp != '')
				{

					if( is_array($_template['begin']) )
					{
						$prev_delimeter = $_template['delimiter'][1];
					}
					else
					{
						$prev_delimeter = $_template['delimiter'];
					}

					$delimeter = $prev_delimeter;
					$delimeter = $this->CleanPCRE( $delimeter);
					$replace = "#{$delimeter}$#is";
					$tree = preg_replace( $replace, "",  $tree);
					$tree = $this->UnCleanPCRE( $tree);

					$delimeter = $this->last_delimeter;
					$delimeter = $this->CleanPCRE($delimeter);
					$replace = "#{$delimeter}$#is";
					$tmp = preg_replace( $replace, "",  $tmp);
					$tmp = $this->UnCleanPCRE( $tmp);

					$tmps = $tmp;
					$tmps = str_replace('{COUNTCHILDS}', $count_childs, $tmps);

					$tree .= $this->temp_begin.$tmps.$this->temp_end;
				}

				if( $_template['inactive'][ $d ] and $d > 0 and is_array($_template['inactive']) )
				{
					$temp_bullet   = $_template['bullet'][ $d ];
					$temp_delimiter = $_template['delimiter'][ $d ];
					$this->temp_begin     = $_template['begin'][ $d ];
					$this->temp_end       = $_template['end'][ $d  ];
					$this->last_level = $d;
				}
				elseif( $this->last_level )
				{
					$temp_bullet   = $_template['bullet'][ $this->last_level ];
					$temp_delimiter = $_template['delimiter'][ $this->last_level ];
					$this->temp_begin     = $_template['begin'][ $this->last_level ];
					$this->temp_end       = $_template['end'][ $this->last_level ];
				}
				else
				{
					$temp_bullet   = $_template['bullet'];
					$temp_delimiter = $_template['delimiter'];
					$this->temp_begin     = $_template['begin'];
					$this->temp_end       = $_template['end'];
				}
			}
			else
			{

				$tmps = $temp_bullet.$node;
				$tmps = str_replace('{COUNTCHILDS}', $count_childs, $tmps);

				$tree     .= $tmps;
				$tree .= $temp_delimiter;
			}

			if( $this->parse_delimeter[ $count ] and ($d == 1) )
			{
				$tree .= $this->parse_delimeter[ $count ];
			}
			$count++;
		}

		if($d == 1)
		{
			$this->parse_delimeter = array();
		}

		return $tree;
	}



	/*********************************************************************************************************************
	 вывод меню c одним уровнем подменю, используются: начало и конец меню, разделитель, активный и неактивный пункты меню
	 используется для вывода как пунтов верхнего уровня меню, так и любых вложенный, основой является идентификатор
	 **********************************************************************************************************************/
	function menu_flag_view_2($id, $_template, $d = 1, &$uri_ids = array())
	{
		global $uri;

		$tree                = '';
		// запрос статических страниц, отец у которых равен $pid
		$childs = $this->menu_item_childs($id);   // запрос информации о детях пункта

		if( $d == 1 )
		{
			$this->count_menu = count($childs);
			if( $_template['megadelimiter'] )
			{
				$this->parcer_magadelimeter( $_template['megadelimiter'] );
			}
		}

		// new change
		//  $count_childs = $this->CalcClidren( $id );//count($childs);

		$level_ = $d;
		if (isset($_template['begin'][ $level_ ]))
		{
			if( $_template['begin'][ $level_ ] and $level_ > 0 and is_array($_template['begin']) )
			{
				$temp_bullet   = $_template['bullet'][ $level_ ];
				$temp_delimiter = $_template['delimiter'][ $level_ ];
				$this->temp_begin     = $_template['begin'][ $level_ ];
				$this->temp_end       = $_template['end'][ $level_ ];
				$this->last_level = $level_;
			}
			elseif( $this->last_level )
			{
				$temp_bullet   = $_template['bullet'][ $this->last_level ];
				$temp_delimiter = $_template['delimiter'][ $this->last_level ];
				$this->temp_begin     = $_template['begin'][ $this->last_level ];
				$this->temp_end       = $_template['end'][ $this->last_level ];
			}
			else
			{
				$temp_bullet   = $_template['bullet'];
				$temp_delimiter = $_template['delimiter'];
				$this->temp_begin     = $_template['begin'];
				$this->temp_end       = $_template['end'];
			}

			// применяем ограничение вложенности
			if( $_template['depth'] and $_template['depth'] < $d )
			{
				return;
			}

			$this->last_delimeter = $temp_delimiter;

			$this->deaph++;
			$count = 1;
			foreach ($childs as $child)// по всем пунктам меню
			{

				$count_childs = $this->CalcClidren( $child["id"] );//count($childs);

				$node = '';
				$node = $this->createNode($child, $_template, $this->last_level, 0, $uri_ids);

				$tmps = $temp_bullet.$node;
				$tmps = str_replace('{COUNTCHILDS}', $count_childs, $tmps);
				$tree             .= $tmps;

				$tree .= $temp_delimiter;
				$this->prev_delimeter = $temp_delimiter;

				$tmp = $this->menu_flag_view_2($child['id'], $_template, ($d+1));

				if ($tmp != '')
				{
					if( is_array($_template['begin']) )
					{
						$prev_delimeter = $_template['delimiter'][1];
					}
					else
					{
						$prev_delimeter = $_template['delimiter'];
					}

					$delimeter = $prev_delimeter;
					$delimeter = $this->CleanPCRE( $delimeter);
					$replace = "#{$delimeter}$#is";
					$tree = preg_replace( $replace, "",  $tree);
					$tree = $this->UnCleanPCRE( $tree);

					$delimeter = $this->last_delimeter;
					$delimeter = $this->CleanPCRE($delimeter);
					$replace = "#{$delimeter}$#is";
					$tmp = preg_replace( $replace, "",  $tmp);
					$tmp = $this->UnCleanPCRE( $tmp);

					$tmps = $tmp;
					$tmps = str_replace('{COUNTCHILDS}', $count_childs, $tmps);

					$tree             .= $this->temp_begin.$tmps.$this->temp_end;
				}

				if( $_template['inactive'][ $d ] and $d > 0 and is_array($_template['inactive']) )
				{
					$temp_bullet   = $_template['bullet'][ $d ];
					$temp_delimiter = $_template['delimiter'][ $d ];
					$this->temp_begin     = $_template['begin'][ $d ];
					$this->temp_end       = $_template['end'][ $d  ];
					$this->last_level = $d;
				}
				elseif( $this->last_level )
				{
					$temp_bullet   = $_template['bullet'][ $this->last_level ];
					$temp_delimiter = $_template['delimiter'][ $this->last_level ];
					$this->temp_begin     = $_template['begin'][ $this->last_level ];
					$this->temp_end       = $_template['end'][ $this->last_level ];
				}
				else
				{
					$temp_bullet   = $_template['bullet'];
					$temp_delimiter = $_template['delimiter'];
					$this->temp_begin     = $_template['begin'];
					$this->temp_end       = $_template['end'];
				}

				if( $this->parse_delimeter[ $count ] and ($d == 1) )
				{
					$tree .= $this->parse_delimeter[ $count ];
				}
				$count++;
			}

			if($d == 1)
			{
				$this->parse_delimeter = array();
			}

			return $tree;
		}
	}

	/*********************************************************************
	 функция формирования пункта меню, учитывает оформление
	 **********************************************************************/
	function createNode($child, $_template, $d = 1, $delim_on= 1, &$uri_ids = array())
	{
		global $uri, $alias;        // URL как есть
		$node = '';

		if( $_template['inactive'][ $d ] and $d > 0 and is_array($_template['inactive']) )
		{
			$temp_now       = $_template['now'][ $d ];
			$temp_active    = $_template['active'][ $d ];
			$temp_inactive  = $_template['inactive'][ $d ];
			$temp_delimiter = $_template['delimiter'][ $d ];
		}
		else
		{
			$temp_now       = $_template['now'];
			$temp_active    = $_template['active'];
			$temp_inactive  = $_template['inactive'];
			$temp_delimiter = $_template['delimiter'];
			$temp_timeformat = $_template['time'];
		}

		// создаем формат времени
		$time_now       = $this->get_date_format($temp_now);
		$time_active    = $this->get_date_format($temp_active);
		$time_inactive  = $this->get_date_format($temp_inactive);


		// делаем при необходимости замену, это нужно для того что главная ссылка всегла ссылалась на хост, бед добавок в виде /index/
		if (($child['alias'] == '/index/'))
		{
			$child['alias'] = '/';
		}

		// фиксим что бы не учитывалась постраничная нафигация на урл

		if( $alias[0] == 'news' or $alias[0] == 'gallery' or $alias[0] == 'catalog')
		{
			$tmp_uri = preg_replace("#page\d+/$#is", "", $uri);
		}
		else
		{
			$tmp_uri = $uri;
		}
		
		if(($uri != '/') && ((in_array($child['id'], $uri_ids)) || (strpos($uri, $child['alias'])) === 0) && ($child['alias'] != $tmp_uri))
		{
			$node        .= str_replace('{TITLE}', $child['title'], str_replace('{ALIAS}', $child['alias'],$temp_now));  // данный пункт меню сейчас выбран, делаем его ненажимаемым
			$temp_timeformat = $time_now;
		}
		elseif (($child['alias'] == $tmp_uri) || (($child['alias'] == '/index/') && ($uri == '/'))) // вторая часть условия делает ссылку на главную чтраницу активной, когда это нужно
		{
			$node        .= str_replace('{TITLE}', $child['title'], str_replace('{ALIAS}', $child['alias'],$temp_active));  // данный пункт меню сейчас выбран, делаем его ненажимаемым
			$temp_timeformat  = $time_active;
		}
		else
		{
			$node        .= str_replace('{TITLE}', $child['title'], str_replace('{ALIAS}', $child['alias'],$temp_inactive));  // данный пункт меню сейчас не выбран, делаем его нажимаемым
			$temp_timeformat = $time_inactive;
		}

		foreach( $child as $k => $v )
		{
			$node = str_replace( "{".strtoupper($k)."}", $v, $node);
		}

		if( $child['timestamp'] )
		{
			$out_time = $this->get_time($child['timestamp'], $temp_timeformat);
			$node = preg_replace("#\{DOCUMENTDATE\(.+?\)\}#is",$out_time, $node);
		}

		global $menu_work;
		$menu_work = $child['id'];

		if( $delim_on )
		{
			return $node.$temp_delimiter;
		}
		else
		{
			return $node;
		}
	}

	function parse_father()
	{
		global $uri, $alias;

		// фиксим что бы не учитывалась постраничная нафигация на урл
		if( $alias[0] == 'news' or $alias[0] == 'gallery' or $alias[0] == 'catalog')
		{
			$tmp_uri = preg_replace("#page\d+/$#is", "", $uri);

			if( $alias[0] == 'news' )
			{
				if( preg_match( "#.+/([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})/$#is", $tmp_uri ) )
				{
					$tmp_uri = preg_replace( "#/([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})/#is", "/", $tmp_uri );
				}
				elseif( preg_match( "#.+/day/([0-9]{1,2})/([0-9]{4})/$#is", $tmp_uri ) )
				{
					$tmp_uri = preg_replace( "#/day/([0-9]{1,2})/([0-9]{4})/#is", "/", $tmp_uri );
				}
				elseif( preg_match( "#.+/day/month/([0-9]{4})/($|page\d+/$)#is", $tmp_uri )  )
				{
					$tmp_uri = preg_replace( "#/day/month/([0-9]{4})/#is", "/", $tmp_uri );
				}
			}
		}
		else
		{
			$tmp_uri = $uri;
		}

		/*

		foreach( $this->menu_by_id as $_mid => $dat )
		{
		if($dat['alias'] == $tmp_uri )
		{
		$tmp_id = $dat['pid'];
		print($tmp_id."!<br />");
		//break;
		}
		}
		*/
		//$this->get_father($tmp_id);

		$alias_father = preg_replace("#^/(.*?)/(.+?)$#is", "\\1", $tmp_uri);
		foreach( $this->menu_by_id as $_mid => $dat )
		{
			if($dat['alias'] == "/{$alias_father}/" )
			{
				$this->father = $dat;
			}
		}
	}

	function get_father($f = 0, $id = 0)
	{

		if( is_array( $this->menu_by_id[ $f ] ) )
		{
			// смотрим еще на один уровень выше что бы не промахнуться мимо root
			$pid = $this->menu_by_id[ $f ]['pid'];

			if( $this->menu_by_id[ $f ]['pid'] != 'root' )
			{
				if( $this->menu_by_id[$pid]['pid'] == 'root' )
				{
					$this->father = $this->menu_by_id[ $f ];
					return $this->menu_by_id[ $f ];
				}
				else
				{
					$this->get_father( $this->menu_by_id[ $f ]['pid'] );
				}
			}
			else
			{
				if( $this->menu_by_id[$f]['pid'] == 'root' )
				{
					$this->father = $this->menu_by_id[ $f ];
					return $this->menu_by_id[ $f ];
				}
				else
				{
					return array();
				}
			}
		}
		else
		{
			return array();
		}
	}

	/*-------------------------------------------------------------------------*/
	// чистим каждый алис
	/*-------------------------------------------------------------------------*/
	/**
	 * пробегает полностью по массиву алисов
	 * и отсылает каждый элемент на читку а потом
	 * очищеный перезаписывает
	 *
	 * @param        array        Array
	 * @return        array        Array (Cleaned)
	 */
	function clean_alies( $array=array() )
	{
		$return = array();

		if ( is_array( $array ) and count( $array ) )
		{
			foreach( $array as $k => $v )
			{
				$return[ $k ] = $this->clean_value($v);
			}
		}

		return $return;
	}

	

	/*-------------------------------------------------------------------------*/
	// INTERNAL: Get file extension
	/*-------------------------------------------------------------------------*/

	/**
	 * Returns the file extension of the current filename
	 *
	 * @param string Filename
	 */

	function _get_file_extension($file)
	{
		return strtolower( str_replace( ".", "", substr( $file, strrpos( $file, '.' ) ) ) );
	}

	

	/*-------------------------------------------------------------------------*/
	//
	// MY DECONSTRUCTOR
	//
	/*-------------------------------------------------------------------------*/

	function my_deconstructor()
	{
		//-----------------------------------------
		// Process mail queue
		//-----------------------------------------

		$this->db->close_db();
	}

	/**
	 * Редактирование КУКОВ
	 *
	 * @param unknown_type $name - название записи в куках
	 * @param unknown_type $value - значение
	 * @param unknown_type $sticky - поставить на год?
	 */
	function setcookie($name, $value = "")
	{
		$period = 2592000; // кука более чем 30 дней		
		setcookie($name, $value, time() + $period, '/');
	}

	/**
	 * Чтение КУКОВ
	 *
	 * @param unknown_type $name - название записи в куках
	 * @return unknown
	 */
	function my_getcookie($name)
	{
		if ( isset($_COOKIE[$name]) )
		{
			return urldecode($_COOKIE[$name]);
		}
		else
		{
			return NULL;
		}
	}

	/**
	 * Получение данных массивов
	 *
	 * @return unknown
	 */
	function parse_incoming()
	{
		global $_SESSION;

		$return = array();

		if( is_array($_GET) )
		{
			while( list($k, $v) = each($_GET) )
			{
				if ( is_array($_GET[$k]) )
				{
					while( list($k2, $v2) = each($_GET[$k]) )
					{
						$return[ $this->clean_key($k) ][ $this->clean_key($k2) ] = $this->clean_value($v2);
					}
				}
				else
				{
					$return[ $this->clean_key($k) ] = $this->clean_value($v);
				}
			}
		}

		//-----------------------------------------
		// Overwrite GET data with post data
		//-----------------------------------------

		if( is_array($_POST) )
		{
			while( list($k, $v) = each($_POST) )
			{
				if ( is_array($_POST[$k]) )
				{
					while( list($k2, $v2) = each($_POST[$k]) )
					{
						$return[ $this->clean_key($k) ][ $this->clean_key($k2) ] = $this->clean_value($v2);
					}
				}
				else
				{

					if( strstr($k, "body") and !$this->get_magic_quotes)
					{
						$_POST[$k] = str_replace("'", "\'", $_POST[$k]);
						$_POST[$k] = str_replace("\\'", "\'", $_POST[$k]);
						$_POST[$k] = str_replace("\\'", "\'", $_POST[$k]);
					}

					$return[ $this->clean_key($k) ] = $this->clean_value($v);
				}
			}

		}


		$return['request_method'] = strtolower($_SERVER['REQUEST_METHOD']);

		return $return;
	}

	/*-------------------------------------------------------------------------*/
	// Key Cleaner - ensures no funny business with form elements
	/*-------------------------------------------------------------------------*/

	function clean_key($key)
	{
		if ($key == "")
		{
			return "";
		}

		$key = htmlspecialchars(urldecode($key));
		$key = preg_replace( "/\.\./"           , ""  , $key );
		$key = preg_replace( "/\_\_(.+?)\_\_/"  , ""  , $key );
		$key = preg_replace( "/^([\w\.\-\_]+)$/", "$1", $key );

		return $key;
	}

	/*-------------------------------------------------------------------------*/
	// Clean evil tags
	/*-------------------------------------------------------------------------*/

	function clean_evil_tags( $t )
	{
		$t = preg_replace( "/javascript/i" , "j&#097;v&#097;script", $t );
		$t = preg_replace( "/alert/i"      , "&#097;lert"          , $t );
		$t = preg_replace( "/about:/i"     , "&#097;bout:"         , $t );
		$t = preg_replace( "/onmouseover/i", "&#111;nmouseover"    , $t );
		$t = preg_replace( "/onclick/i"    , "&#111;nclick"        , $t );
		$t = preg_replace( "/onload/i"     , "&#111;nload"         , $t );
		$t = preg_replace( "/onsubmit/i"   , "&#111;nsubmit"       , $t );
		$t = preg_replace( "/<body/i"      , "&lt;body"            , $t );
		$t = preg_replace( "/<html/i"      , "&lt;html"            , $t );
		$t = preg_replace( "/document\./i" , "&#100;ocument."      , $t );

		return $t;
	}

	

	/*-------------------------------------------------------------------------*/
	// Clean value
	/*-------------------------------------------------------------------------*/

	function clean_value($val)
	{
		global $site;

		if ($val == "")
		{
			return "";
		}

		$val = str_replace( "&#032;", " ", $val );


		$val = str_replace( chr(173)       , ""              , $val );  //Remove sneaky spaces
		$val = str_replace( "&"            , "&amp;"         , $val );
		$val = str_replace( "<!--"         , "&#60;&#33;--"  , $val );
		$val = str_replace( "-->"          , "--&#62;"       , $val );
		$val = preg_replace( "/<script/i"  , "&#60;script"   , $val );
		$val = str_replace( ">"            , "&gt;"          , $val );
		$val = str_replace( "<"            , "&lt;"          , $val );
		$val = str_replace( "\""           , "&quot;"        , $val );
		$val = preg_replace( "/\n/"        , "<br />"        , $val ); // Convert literal newlines
		$val = preg_replace( "/\\\$/"      , "&#036;"        , $val );
		$val = preg_replace( "/\r/"        , ""              , $val ); // Remove literal carriage returns
		$val = str_replace( "!"            , "&#33;"         , $val );
		$val = str_replace( "'"            , "&#146;"         , $val ); // IMPORTANT: It helps to increase sql query safety.

		//clean separator from review for example

		$val = str_replace( "|"            , "&#124;"        , $val);


		// Strip slashes if not already done so.

		if ( $this->get_magic_quotes )
		{
			$val = stripslashes($val);
		}

		// Swop user inputted backslashes

		$val = preg_replace( "/\\\(?!&amp;#|\?#)/", "&#092;", $val );

		return $val;
	}

	/*-------------------------------------------------------------------------*/
	// Get browser
	// Return: unknown, windows, mac
	/*-------------------------------------------------------------------------*/

	/**
	 * Fetches the user's operating system
	 *
	 * @return        string
	 */

	function fetch_os()
	{
		$useragent = strtolower($_SERVER['HTTP_USER_AGENT']);

		if ( strstr( $useragent, 'mac' ) )
		{
			return 'mac';
		}

		if ( preg_match( '#wi(n|n32|ndows)#', $useragent ) )
		{
			return 'windows';
		}

		return 'unknown';
	}

	/*-------------------------------------------------------------------------*/
	// Get browser
	// Return: unknown, opera, IE, mozilla, konqueror, safari
	/*-------------------------------------------------------------------------*/

	/**
	 * Fetches the user's browser from their user-agent
	 *
	 * @return        array [ browser, version ]
	 */

	function fetch_browser()
	{
		$version   = 0;
		$browser   = "unknown";
		$useragent = strtolower($_SERVER['HTTP_USER_AGENT']);

		//-----------------------------------------
		// Opera...
		//-----------------------------------------

		if ( strstr( $useragent, 'opera' ) )
		{
			preg_match( "#opera[ /]([0-9\.]{1,10})#", $useragent, $ver );

			return array( 'browser' => 'opera', 'version' => $ver[1] );
		}

		//-----------------------------------------
		// IE...
		//-----------------------------------------

		if ( strstr( $useragent, 'msie' ) )
		{
			preg_match( "#msie[ /]([0-9\.]{1,10})#", $useragent, $ver );

			return array( 'browser' => 'ie', 'version' => $ver[1] );
		}

		//-----------------------------------------
		// Safari...
		//-----------------------------------------

		if ( strstr( $useragent, 'safari' ) )
		{
			preg_match( "#safari/([0-9.]{1,10})#", $useragent, $ver );

			return array( 'browser' => 'safari', 'version' => $ver[1] );
		}

		//-----------------------------------------
		// Mozilla browsers...
		//-----------------------------------------

		if ( strstr( $useragent, 'gecko' ) )
		{
			preg_match( "#gecko/(\d+)#", $useragent, $ver );

			return array( 'browser' => 'gecko', 'version' => $ver[1] );
		}

		//-----------------------------------------
		// Older Mozilla browsers...
		//-----------------------------------------

		if ( strstr( $useragent, 'mozilla' ) )
		{
			preg_match( "#^mozilla/[5-9]\.[0-9.]{1,10}.+rv:([0-9a-z.+]{1,10})#", $useragent, $ver );

			return array( 'browser' => 'mozilla', 'version' => $ver[1] );
		}

		//-----------------------------------------
		// Konqueror...
		//-----------------------------------------

		if ( strstr( $useragent, 'konqueror' ) )
		{
			preg_match( "#konqueror/([0-9.]{1,10})#", $useragent, $ver );

			return array( 'browser' => 'konqueror', 'version' => $ver[1] );
		}

		//-----------------------------------------
		// Still here?
		//-----------------------------------------

		return array( 'browser' => $browser, 'version' => $version );
	}

	/*-------------------------------------------------------------------------*/
	// Очистка алисов
	/*-------------------------------------------------------------------------*/

	/**
	 * Fetches the user's browser from their user-agent
	 *
	 * @param text
	 */

	function clean_alias( $text = '', $temp = 0/*пепеменная-заглушка*/ )
	{
		$text = strtolower($text);


		if( preg_replace("#^[\/0-9a-z_]+$#is", "", $text) and $text)
		{
			return '<li>Алиас указан некорректно</li>';
		}
	}

	/**
	 * Fetches the user's browser from their user-agent
	 *
	 * @param string
	 * @param int
	 * @param int
	 * @param string
	 *
	 * @return strint
	 */

	function double_clean_alias( $alias = '', $count_alias = 0, $pid = -1, $table = '' )
	{
		$table = trim($table);

		if( !$table ) return '<li>Ошибка на уровне базы данных</li>';

		// выбираем все алиасы содержащие данное слово
		$this->db->do_query("SELECT count(*) as count FROM se_{$table} WHERE alias='{$alias}' and pid={$pid}");
		$max = $this->db->fetch_row();

		if( $max['count'] > $count_alias )
		{
			return '<li>Такой алиас присуствует в системе, укажите уникальный алиас</li>';
		}
		else
		{
			return '';
		}
	}

	/*-------------------------------------------------------------------------*/
	// очитска заголоков и всего остального типа menu, description...
	/*-------------------------------------------------------------------------*/

	/**
	 * Fetches the user's browser from their user-agent
	 *
	 * @param text txt
	 * @param type [title, menu]
	 * @param text msg error
	 *
	 * @return error msg
	 */

	function clean_title_menu( $text = '', $type = 'title', $msg = '')
	{
		if(!$text and $type == 'title')
		{
			return "<li>Название не указано некорректно</li>";
		}
	}

	// Built-in function to simple transliterate.
	function trensliterator($st, $level=0)
	{
		if ($level)
		{
			$st = preg_replace('/^.*::/s', '', $st);
		}

		$st = trim($st);
		$st = str_replace( " ", "_" , $st);
		$st = str_replace( "ё", "yo", $st );
		$st = str_replace( "Ё", "yo", $st );

		$st = preg_replace('/ий(?=\s)/s', 'y', $st);

		$st = strtr(
		$st,
                                "абвгдежзийклмнопрстуфыэАБВГДЕЖЗИЙКЛМНОПРСТУФЫЭ",
                                "abvgdegziyklmnoprstufieabvgdegziyklmnoprstufie"
                                );

                                $st = strtr($st, array(
                                       'х' => "h",
                                       'ц' => "ts",
                                       'ч' => "ch",
                                       'ш' => "sh",
                                       'щ' => "shch",
                                       'ъ' => '',
                                       'ь' => '',
                                       'ю' => "yu",
                                       'я' => "ya",
                                       'Х' => "h",
                                       'Ц' => "ts",
                                       'Ч' => "ch",
                                       'Ш' => "sh",
                                       'Щ' => "shch",
                                       'Ъ' => '',
                                       'Ь' => '',
                                       'Ю' => "yu",
                                       'Я' => "ya",
                                ));

                                $st = strtolower( $st );
                                $st = preg_replace('/[^a-z0-9_]+/i', '_', $st);
                                $st = trim($st);
                                return $st;
	}


	/*-------------------------------------------------------------------------*/
	// JavaSript прыганья по страницам
	/*-------------------------------------------------------------------------*/

	function make_page_jump($tp="", $pp="", $ub="", $type = '/page', $dis_chpu = 0, $ignore_revert = 0)
	{
		global $_pagenaviagation;

		$outnavi = '';

		if( !$this->print_navi_js )
		{
			if( !$dis_chpu )
			{
				$outnavi = "<script language='JavaScript' type=\"text/javascript\">
				<!--
				function multi_page_jump( url_bit, total_posts, per_page, link_type )
				{
				pages = 1; cur_st = parseInt(\"{$this->first}\"); cur_page  = 1;
				if ( total_posts % per_page == 0 ) { pages = total_posts / per_page; }
				else { pages = Math.ceil( total_posts / per_page ); }
				msg = \"Пожалуйста, введите номер страницы(от 1 до \" + pages + \") на которую вы хотите перейти\";
				if ( cur_st > 0 ) { cur_page = cur_st / per_page; cur_page = cur_page -1; }
				show_page = 1;
				if ( cur_page < pages )  { show_page = cur_page + 1; }
				if ( cur_page >= pages ) { show_page = cur_page - 1; }
				else { show_page = cur_page + 1; }
				userPage = prompt( msg, show_page );
				if ( userPage > 0  ) {
				if ( userPage < 1 )     {    userPage = 1;  }
				if ( userPage > pages ) { userPage = pages; }
				if ( userPage == 1 )    {     start = 0;    }
				else { start = (userPage - 1) * per_page; }
				window.location = url_bit + link_type + start;
			}
			}
			//-->
			</script>";
			}
			else
			{
				require_once($this->config['path_lib']."/page_navigation_js.php");

				$revert_navi = $ignore_revert ? 0 : $this->settings['global_revert_navigation'];

				if($revert_navi)
				{
					$outnavi = str_replace("{STFIRST}", $this->first, $_pagenaviagation['javascript_revert']);
				}
				else
				{
					$outnavi = str_replace("{STFIRST}", $this->first, $_pagenaviagation['javascript']);
				}
			}
			$this->print_navi_js = 1;
		}

		if( !$dis_chpu )
		{
			$outnavi .= "<a title='Перейти к странице' href=\"javascript:multi_page_jump('$ub',$tp,$pp, '$type')\">Страницы:</a>";
		}
		else
		{
			$outnavi .= str_replace( array( "{UB}", "{TP}", "{PP}", "{TYPE}" ),
			array( $ub, $tp, $pp, $type),$_pagenaviagation['startnavi']);
		}

		return $outnavi;
	}

	/*-------------------------------------------------------------------------*/
	// Build up page span links
	/*-------------------------------------------------------------------------*/


	function build_pagelinks($data)
	{
		global $_pagenaviagation;
		
		//-----------------------------
		// управляем переворачиванием постраничной навигации
		//-----------------------------
		//$revert_navigation = $data['IGNORE_REVERT'] ? 0 : $this->settings['global_revert_navigation'];
		$revert_navigation = 0;

		$work = array();

		$section = ($data['leave_out'] == "") ? 2 : $data['leave_out'];  // Number of pages to show per section( either side of current), IE: 1 ... 4 5 [6] 7 8 ... 10

		$work['pages']  = 1;

		if ( ($data['TOTAL_POSS'] % $data['PER_PAGE']) == 0 )
		{
			@$work['pages'] = $data['TOTAL_POSS'] / $data['PER_PAGE'];
		}
		else
		{
			$number = ($data['TOTAL_POSS'] / $data['PER_PAGE']);
			$work['pages'] = ceil( $number);
		}

		if( !$data['LINK_DISABLE_CHPU'] )
		{
			$dis_chpu = 1;
			$link_end = '/page';
		}
		else
		{
			$dis_chpu = 0;
			$link_end = '&amp;st=';
		}

		$data['BASE_URL'] = preg_replace( "#/$#is", '', $data['BASE_URL'] );

		$work['total_page']   = $work['pages'];
		if($data['LINK_DISABLE_CHPU'])
		{
			$work['current_page'] = $data['CUR_ST_VAL'] > 0 ? ($data['CUR_ST_VAL'] / $data['PER_PAGE']) + 1 : 1;
		}


		if ($work['pages'] > 1)
		{
			$work['first_page'] = $this->make_page_jump($data['TOTAL_POSS'],$data['PER_PAGE'], $data['BASE_URL'], $link_end, $dis_chpu, $data['IGNORE_REVERT']);

			if( !$data['LINK_DISABLE_CHPU'] )
			{

				$work['first_page'] .= str_replace( "{PAGES}", $work['pages'],  $_pagenaviagation['pages_all']);
			}
			else
			{
				$work['first_page'] .= " (".$work['pages'].")";
			}

			for( $i = 0; $i <= $work['pages'] - 1; ++$i )
			{
				$RealNo = $i * $data['PER_PAGE'];
				$PageNo = $i+1;

				if( !$data['LINK_DISABLE_CHPU'] )
				{
					$data['CUR_ST_VAL'] = ($data['CUR_ST_VAL']) ? $data['CUR_ST_VAL'] : 1;
					$work['current_page'] = $data['CUR_ST_VAL'];
				}

				if( $data['CUR_ST_VAL']>1 and !$data['LINK_DISABLE_CHPU'] )
				{
					if( $data['CUR_ST_VAL'] == 2 and !$revert_navigation)
					{
						$page_end = '';
						$page_num = '';
					}
					else
					{
						$page_end = $link_end;
						$page_num = $data['CUR_ST_VAL']-1;
					}

					if( !$revert_navigation )
					{
						$page_previous = $_pagenaviagation['page_previous'];
					}
					else
					{
						$page_previous = $_pagenaviagation['page_next'];
					}

					$work['page_pre'] = str_replace( array( '{BASE_URL}', '{END}', '{NUM}' ),
					array($data['BASE_URL'], $page_end, $page_num."/"),
					$page_previous );
				}

				if( $data['CUR_ST_VAL']<$work['pages'] and !$data['LINK_DISABLE_CHPU'] )
				{

					if( !$revert_navigation )
					{
						$page_next = $_pagenaviagation['page_next'];
					}
					else
					{
						$page_next = $_pagenaviagation['page_previous'];
					}

					if($data['CUR_ST_VAL'] + 1 == $work['pages'] and $revert_navigation)
					{
						$work['page_next'] = str_replace( array( '{BASE_URL}', '{END}', '{NUM}' ),
						array($data['BASE_URL'], "", "/"),
						$page_next );
					}
					else
					{
						$work['page_next'] = str_replace( array( '{BASE_URL}', '{END}', '{NUM}' ),
						array($data['BASE_URL'], $link_end, ($data['CUR_ST_VAL']+1)."/"),
						$page_next );
					}
				}

				if ($RealNo == $data['CUR_ST_VAL'] and $data['LINK_DISABLE_CHPU'])
				{
					$work['page_span'] .= "&nbsp;<b>[{$PageNo}]</b>";
				}
				elseif(!$data['LINK_DISABLE_CHPU'] and ($PageNo == $data['CUR_ST_VAL']))
				{
					if($revert_navigation)
					{
						$work['page_span'] = str_replace( "{PAGE}", $PageNo, $_pagenaviagation['page_current'] ).$work['page_span'];
					}
					else
					{
						$work['page_span'] .= str_replace( "{PAGE}", $PageNo, $_pagenaviagation['page_current'] );
					}

				}
				else
				{
					if ($PageNo < ($work['current_page'] - $section) and !$revert_navigation)
					{
						if( !$data['LINK_DISABLE_CHPU'] )
						{
							$work['st_dots'] = str_replace( array( '{BASE_URL}', '{END}' ),
							array($data['BASE_URL'], '/'),
							$_pagenaviagation['page_start'] );
						}
						else
						{
							$work['st_dots'] = "&nbsp;<a href='{$data['BASE_URL']}{$link_end}0' title='Страница: 1'>&laquo; Первая</a>&nbsp;...";
						}

						continue;
					}

					if ($PageNo > ($work['current_page'] + $section) and $revert_navigation)
					{
						if( !$data['LINK_DISABLE_CHPU'] )
						{
							$work['st_dots'] = str_replace( array( '{BASE_URL}', '{END}' ),
							array($data['BASE_URL'], '/'),
							$_pagenaviagation['page_start'] );
						}
						else
						{
							$work['st_dots'] = "&nbsp;<a href='{$data['BASE_URL']}{$link_end}0' title='Страница: 1'>&laquo; Первая</a>&nbsp;...";
						}
						break;
					}

					// If the next page is out of our section range, add some dotty dots!

					if ($PageNo > ($work['current_page'] + $section) and !$revert_navigation)
					{
						if( !$data['LINK_DISABLE_CHPU'] )
						{
							if(!$revert_navigation)
							{
								$work['end_dots'] = str_replace( array( '{BASE_URL}', '{END}', '{NUM}', '{PAGE}' ),
								array($data['BASE_URL'], $link_end, $work['pages']."/", $work['pages']),
								$_pagenaviagation['page_end'] );
							}
							else
							{
								$work['end_dots'] = str_replace( array( '{BASE_URL}', '{END}', '{NUM}', '{PAGE}' ),
								array($data['BASE_URL'], "/page1/", "", $work['pages']),
								$_pagenaviagation['page_end'] );
							}
						}
						else
						{
							$work['end_dots'] = "...&nbsp;<a href='{$data['BASE_URL']}{$link_end}".($work['pages']-1) * $data['PER_PAGE']."' title='Страница {$work['pages']}'>Последняя &raquo;</a>";
						}
						break;
					}

					if ($PageNo < ($work['current_page'] - $section) and $revert_navigation)
					{
						if( !$data['LINK_DISABLE_CHPU'] )
						{
							if(!$revert_navigation)
							{
								$work['end_dots'] = str_replace( array( '{BASE_URL}', '{END}', '{NUM}', '{PAGE}' ),
								array($data['BASE_URL'], $link_end, $work['pages']."/", $work['pages']),
								$_pagenaviagation['page_end'] );
							}
							else
							{
								$work['end_dots'] = str_replace( array( '{BASE_URL}', '{END}', '{NUM}', '{PAGE}' ),
								array($data['BASE_URL'], "/page1/", "", $work['pages']),
								$_pagenaviagation['page_end'] );
							}
						}
						else
						{
							$work['end_dots'] = "...&nbsp;<a href='{$data['BASE_URL']}{$link_end}".($work['pages']-1) * $data['PER_PAGE']."' title='Страница {$work['pages']}'>Последняя &raquo;</a>";
						}
						continue;
					}


					if( !$data['LINK_DISABLE_CHPU'] )
					{
						if( $RealNo )
						{
							if(!$revert_navigation)
							{
								$work['page_span'] .= str_replace( array( '{BASE_URL}', '{END}', '{NUM}', '{PAGE}' ),
								array($data['BASE_URL'], $link_end, $PageNo."/", $PageNo),
								$_pagenaviagation['page_link'] );
							}
							elseif($PageNo == $work['pages'] and $revert_navigation)
							{
								$work['page_span'] = str_replace( array( '{BASE_URL}', '{END}', '{NUM}', '{PAGE}' ),
								array($data['BASE_URL'], "", "/", $PageNo),
								$_pagenaviagation['page_link'] ).$work['page_span'];
							}
							else
							{
								$work['page_span'] = str_replace( array( '{BASE_URL}', '{END}', '{NUM}', '{PAGE}' ),
								array($data['BASE_URL'], $link_end, $PageNo."/", $PageNo),
								$_pagenaviagation['page_link'] ).$work['page_span'];
							}

						}
						else
						{
							if(!$revert_navigation)
							{
								$work['page_span'] .= str_replace( array( '{BASE_URL}', '{END}', '{NUM}', '{PAGE}' ),
								array($data['BASE_URL'], "", "/", $PageNo),
								$_pagenaviagation['page_link'] );
							}
							else
							{
								$work['page_span'] = str_replace( array( '{BASE_URL}', '{END}', '{NUM}', '{PAGE}' ),
								array($data['BASE_URL'], $link_end, $PageNo."/", $PageNo),
								$_pagenaviagation['page_link'] ).$work['page_span'];
							}
						}
					}
					else
					{
						$work['page_span'] .= "&nbsp;<a href='{$data['BASE_URL']}{$link_end}{$RealNo}'>{$PageNo}</a>";
					}
				}
			}

			if( !$revert_navigation )
			{
				$work['return']    = $work['first_page'].$work['st_dots'].$work['page_pre'].$work['page_span'].$work['page_next'].$work['end_dots'];
			}
			else
			{
				$work['return']    = $work['first_page'].$work['st_dots'].$work['page_next'].$work['page_span'].$work['page_pre'].$work['end_dots'];
			}
		}
		else
		{
			$work['return']    = $data['L_SINGLE'];
		}


		return $work['return'];
	}



	/*-------------------------------------------------------------------------*/
	// Берем формат даты
	/*-------------------------------------------------------------------------*/

	function get_date_format( $text = "" )
	{
		$format = '';

		$format = preg_replace( "#(^.+?|^)\{DOCUMENTDATE\((.+?)\)\}(.+?$|$)#is", "\\2", $text );

		$format = trim($format);

		if( !$format )
		{
			$format = "d F Y";
		}

		return $format;
	}



	/*-------------------------------------------------------------------------*/
	// rm_dir
	/*-------------------------------------------------------------------------*/

	function rm_dir( $dir = '' )
	{
		$errors = 0;

		// Remove trailing slashes..

		$dir = preg_replace( "#/$#", "", $dir );

		if ( file_exists($dir) )
		{
			// Attempt CHMOD

			@chmod($dir, 0776);

			if ( is_dir($dir) )
			{
				$handle = opendir($dir);

				while (($filename = readdir($handle)) !== false)
				{
					if (($filename != ".") && ($filename != ".."))
					{
						$this->rm_dir($dir."/".$filename);
					}
				}

				closedir($handle);

				if ( ! @rmdir($dir) )
				{
					$errors++;
				}
			}
			else
			{
				if ( ! @unlink($dir) )
				{
					$errors++;
				}
			}
		}

		if ($errors == 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/*-------------------------------------------------------------------------*/
	// Удаление вместе с модуле и всех его шаблонов
	/*-------------------------------------------------------------------------*/

	function unlinkFilesStartWithWord( $dir = '', $word)
	{
		$errors = 0;

		// Remove trailing slashes..

		$dir = preg_replace( "#/$#", "", $dir );

		if ( file_exists($dir) )
		{
			// Attempt CHMOD

			@chmod($dir, 0776);

			if ( is_dir($dir) )
			{
				$handle = opendir($dir);

				while (($filename = readdir($handle)) !== false)
				{
					// если файл не является ссылкой на родительские уровни
					// и если название файла начинается с переданного слова,
					if (($filename != ".") && ($filename != "..") && (strstr($filename, $word) != ""))
					{
						@unlink($dir."/".$filename);
					}
				}

				closedir($handle);
			}
		}

		if ($errors == 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}


	/*-------------------------------------------------------------------------*/
	// очистка емайла
	//   - возвращает или мыло или пустоту
	/*-------------------------------------------------------------------------*/

	function email_validate($email = "")
	{
		$email = trim($email);


		$email = preg_replace( "# #is", "", $email );


		//-----------------------------------------
		// Проверяем если в мыле 2 или больше знаков собаки
		//-----------------------------------------

		if ( substr_count( $email, '@' ) > 1 )
		{
			return '';
		}

		// отстреливаем все спец симвлы
		$email = preg_replace( "#[\;\#\n\r\*\'\"<>&\%\!\(\)\{\}\[\]\?\\/\s]#", "", $email );


		if ( preg_match( "/^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,4})(\]?)$/", $email) )
		{
			return $email;
		}
		else
		{
			return '';
		}
	}

	/*-------------------------------------------------------------------------*/
	// Generate SALT
	/*-------------------------------------------------------------------------*/

	function gen_pass_salt( $len = 6 )
	{
		$salt = '';

		for ( $i = 0; $i < $len; $i++ )
		{
			$num   = rand(33, 126);

			if ( $num == '92' )
			{
				$num = 93;
			}

			$salt .= chr( $num );
		}

		return $salt;
	}

	/*-------------------------------------------------------------------------*/
	// Кнопки упорядовачивания, используется в админке (старое)
	/*-------------------------------------------------------------------------*/

	function order_button($row_count = 0, $i = 0, $id = 0, $row = array(), $act = '')
	{
		if( $row_count < 1 )
		{
			return;
		}

		if( $row_count == 1 )
		{
			$col = 'colspan=2';
		}
		else
		{
			$col = '';
		}

		$output  = "<td {$col} align=center>";
		$output .= "<input type=\"text\" name=\"pos_{$row['id']}\" value=\"{$row['item_order']}\" size=\"3\"/>";
		$output .= "</td>";

		if( $row_count > 1 )
		{
			// кнопки упорядочивания
			$output  .= "<td align=center>";
			if ($row['item_order'] != 1)
			{
				$output .= "<a href='/admin/?action={$act}&act=up&id=".$id."&itemid=".$row['id']."&order=".$row['item_order']."'><img src='/".$this->config['path_admin']."/image/img_up.png' title='На позицию вверх'  border=0></a>";
			}

			if ($row_count-1 != $i)
			{
				$output .= "<a href='/admin/?action={$act}&act=down&id=".$id."&itemid=".$row['id']."&order=".$row['item_order']."'><img src='/".$this->config['path_admin']."/image/img_down.png' title='На позицию вниз' border=0></a>";
			}
			$output .= "</td>";
		}

		return $output;
	}


	/**
	 * функция меняет порядок следования вершин
	 */
	function table_order( $table = ''  )
	{
		if( !$table ) return;

		if( $this->input['act'])
		{
			$id         = intval($this->input['id']);
			$itemid     = intval($this->input['itemid']);
			$act        = $this->input['act'];
			$order      = $this->input['order'];

			// получаем список пунктов
			$sql = "select id, item_order from se_{$table} where pid='".$id."' order by item_order";
			$this->db->do_query($sql);

			$row_count = $this->db->getNumRows();
			if ($row_count)
			{
				while ($row = $this->db->fetch_row())
				{
					if ($act == 'up')
					{
						if ($row['item_order'] == $order-1)
						{
							$this->db->do_update( $table, array( 'item_order' => ($order-1) ), "id=".$itemid  );
							$this->db->do_update( $table, array( 'item_order' => $order ), "id=".$row['id']  );
							break;
						}
					}
					else
					{
						if ($row['item_order'] == $order+1)
						{
							$this->db->do_update( $table, array( 'item_order' => ($order+1) ), "id=".$itemid  );
							$this->db->do_update( $table, array( 'item_order' => $order ), "id=".$row['id']  );
							break;
						}
					}
				}
			}

			return;
		}

		$id         = intval($this->input['id']);
		$val        = array();
		$ids        = array();

		foreach( $this->input as $id => $data )
		{
			if( preg_match( "#^pos_(\d+)$#is", $id ))
			{
				preg_match("/^pos_(\d+)$/is", $id, $match);

				$this->input[ $match[0] ] = intval($this->input[ $match[0] ]);

				if( isset($this->input[ $match[0] ]) )
				{
					$val[ $match[1] ] = $this->input[ $match[0] ];
				}
			}
		}

		asort( $val );

		$last_num  = '';
		$last_id   = '';
		$sort_ids = array();

		foreach( $val as $id => $data )
		{
			if( $last_id )
			{
				if($last_num === $data)
				{
					if( !count($sort_ids) )
					{
						$sort_ids[] = $last_id;
					}
					$sort_ids[] = $id;
				}
				elseif( count($sort_ids) > 0)
				{
					foreach( $ids as $_id => $num )
					{
						$max = $_id;
					}

					if( $max )
					{
						unset($ids[ $max ]);
					}

					$sql        = "select id from se_{$table} WHERE id IN(" . implode( ',', $sort_ids ) . ") ORDER BY title ASC";
					$this->db->do_query($sql);

					while($row = $this->db->fetch_row())
					{
						$ids[] = $row['id'];
					}

					$ids[]    = $id;
					$sort_ids = array();
				}
				else
				{
					$ids[] = $id;
				}
			}
			else
			{
				$ids[] = $id;
			}

			$last_num = $data;
			$last_id  = $id;
		}

		// если последние числа одинаковые, то $sort_ids должен быть не пуст
		if( count($sort_ids) > 0 )
		{
			foreach( $ids as $id => $num )
			{
				$max = $id;
			}

			if( $max )
			{
				unset($ids[ $max ]);
			}

			$sort_ids[] = $last_id;

			$sql        = "select id from se_{$table} WHERE id IN(" . implode( ',', $sort_ids ) . ") ORDER BY title ASC";
			$this->db->do_query($sql);

			while($row = $this->db->fetch_row())
			{
				$ids[] = $row['id'];
			}
		}

		// наконец обновляем поля
		$i            = 1;
		$exists_array = array();

		foreach( $ids as $id => $num )
		{
			if( !in_array($num, $exists_array) )
			{
				$exists_array[] = $num;
			}
			else
			{
				continue;
			}

			$this->db->do_update( $table, array( 'item_order' => $i ), "id=".$num  );
			$i++;
		}

	}


	/*---------------------------------------------------------------------------------------------------*/
	// Функция генерации выпадающего списка родителей
	/*---------------------------------------------------------------------------------------------------*/

	function get_list_pages( $row = array(), $root_title = 'Главная' )
	{
		$out_array = array();
		$html      = '';

		if( count( $row['root'] ) < 1)
		{
			$row['root'] = array();
		}

		if( $this->input['id'] or $this->input['itemid'])
		{
			if( $this->input['id'] )
			{
				$id = $this->input['id'];
			}
		}

		//-------------------------------------

		$delet_id = $this->input['itemid'];
		unset($row[ $delet_id ]);

		//-------------------------------------

		foreach( $row['root'] as $_ids => $data  )
		{
			$out_array[] = array( $data['id'], "|--".$data['title']);
			$out_array = $this->get_parent_list( $data['id'], $out_array, $row, '&nbsp;&nbsp;&nbsp;&nbsp;' );
		}

		foreach ($out_array as $v)
		{
			$selected = "";

			if ( ($id != "") and ($v[0] == $id) )
			{
				$selected = ' selected';
			}

			$html .= "<option value='".$v[0]."'".$selected.">".$v[1]."</option>\n";
		}

		$html = "<option value='-1'>{$root_title}</option>\n".$html;

		return $html;
	}


	/**
	 * возвращает список упорядоченных вершин, наследников одной вершины
	 *
	 * @param unknown_type $id - идентификатор вершины-отца
	 */
	function getChildsOfNodeById($id, $dbTable)
	{
		// все подчинённые вершины первого урорня подчинения, pid = $id
		$sql = "SELECT * FROM {$dbTable} WHERE pid = '{$id}' ORDER BY item_order";
		if ($this->db->query($sql, $rows) > 0)
		{
			return $rows;        // есть наследники
		}

		return array();        // нет результата
	}


	/*---------------------------------------------------------------------------------------------------*/
	// Pекурсивная функция массива родителей
	/*---------------------------------------------------------------------------------------------------*/

	function get_parent_list( $root_id, $out_array = array(), $row = array(), $depth_gide = '' )
	{
		if( is_array( $row[ $root_id ] ) )
		{
			// пробегаемся по блоку подуровня
			foreach( $row[ $root_id ] as $_ids => $data )
			{
				// выкидываем из обработки если алиасы являются определенными(специальными)
				/*if( strstr( $data['alias'], 'end' ) )
				 {
				 continue;
				 }
				 elseif( strstr( $data['alias'], 'delimiter' ) )
				 {
				 continue;
				 }
				 elseif( strstr( $data['alias'], 'begin' ) )
				 {
				 continue;
				 }*/

				$out_array[] = array( $data['id'], $depth_gide."&nbsp;&nbsp;|--".$data['title']);

				$out_array = $this->get_parent_list( $data['id'], $out_array, $row, '&nbsp;&nbsp;&nbsp;&nbsp;'.$depth_gide );
			}
		}

		return $out_array;
	}





	/*-------------------------------------------------------------------------*/
	// Gets children (Debug purposes)
	// ------------------
	// Get all meh children
	/*-------------------------------------------------------------------------*/

	function _get_children( $row, $root_id, $ids=array() )
	{
		if ( isset($row[ $root_id ]) AND is_array( $row[ $root_id ] ) )
		{
			foreach( $row[ $root_id ] as $data )
			{
				$ids[] = $data['id'];

				$ids = $this->_get_children($row, $data['id'], $ids);
			}
		}

		return $ids;
	}

	/**
	 * функция для пересоздания подчинённых динамических вершин в меню
	 */
	function _addTreeToMenu( $table = '', $id = '', $is_sheet = 0 )
	{
		if( !$table ) return;

		// сначала ищем в таблице меню пункт, у которого указаны имя и идент-р "статической таблицы"
		$sql = "select id, table_idnode,timestamp, title, alias from ".TABLE_MITEMS." where table_name = '{$table}' and item_simple = '0'";
		
		$this->db->query($sql, $rows);

		foreach($rows as $row)
		{
			// потом удаляем все пункты подчинённые данному пункту
			menu_item_del($row['id'], 1  /* удаляем тока вложенные вершины */);
			$this->db->do_query("SELECT * FROM se_{$table} WHERE id='".$row['table_idnode']."'");
			$r = $this->db->fetch_row();

			if( ($r['is_active'] or $row['table_idnode'] == -1) /*&& (is_array($r))*/)
			{
				$update['is_active'] = 1;

				if( $r['menu'] or $r['title'] )
				{
					$update['title'] = $r['menu'] ? $r['menu'] : $r['title'];
				}

				$update['mtitle']    = $r['title'];
				$update['timestamp'] = $r['timestamp'];
				$update['author']    = $r['author'];
				$update['sbody']     = $r['sbody'];
				$update['body']      = $this->settings['add_body'] ? $r['body'] : '';
				$update['h1']        = $r['h1'];

				$this->db->do_update( 'mitems', $update, "id='".$row['id']."'" );

				// пересоздаём подчинёные пункты уже с обновлениями структуры
				$this->_MoveToMenu($row['table_idnode'], $row['id'], $table, $is_sheet);
			}
			else
			{
				/*if (is_array($r))
				 {*/
				$this->db->do_update('mitems', array( 'is_active' => 0,),"id='".$row['id']."'" );
				/*}*/
			}
		}
		
		
		
		#------------------------------------------------------------------------------
		# теперь изменяем информацию о странице, которая не была создана динамичечки
		#------------------------------------------------------------------------------
		
		if ($id != '')
		{
			# все вершины в меню, которые были созданы из вершины модуля
			$sql = "SELECT id FROM ".TABLE_MITEMS." WHERE table_name = '{$table}' AND item_simple = '1' AND table_idnode = '$id'";
			$this->db->query($sql, $rows);
			
			# инфо о изменённой вершине
			$sql = "SELECT * FROM se_{$table} WHERE id = '$id'";
			$this->db->query($sql, $node);
			$node = $node[0];
	
			foreach($rows as $row)
			{
				$this->_getPagePathById($node['id'], $alias, $table);
				if ($table != 'static') $alias = '/'.$table.'/'.$alias;
				else $alias = '/'.$alias;
				$pms = array(
					'title' => $node['menu'],
					'h1' => $node['h1'],
					'alias' => $alias,
					'author' => $node['author'],
					'sbody' => $node['sbody']
				);
				
				$this->db->do_update('mitems', $pms, "id = '".$row['id']."'");
			}
		}
		

	}

	/**
	 * функция для переноса структуры модуля в структуру меню, начиная с указанной вершины
	 *
	 * @param unknown_type $id                - идентификатор вершины в таблице
	 * @param unknown_type $pid                - идентификатор отца в таблице меню
	 */
	function _MoveToMenu($id, $pid, $table, $is_sheet = 0)
	{
		$all_ = array();

		if( $is_sheet )
		{
			$q = "and is_sheet = 0";
		}
		else
		{
			$q = "";
		} 
		
		# запрос вершин одного уровня
		$sql = "select id from se_{$table} where is_active = 1 {$q} and pid='".$id."' order by item_order";

		$this->db->do_query($sql);
		while( $rows = $this->db->fetch_row() )
		{
			$all_[] = $rows;
		}

		foreach( $all_ as $id => $row )
		{
			$this->_MoveToMenuRecurc($row['id'], $pid, $table, $is_sheet);  // очередной реккурсивный вызов
		}
	}

	/**
	 * функция составления полной строки адреса по пришедшему идентификатору,
	 * проходит вверх по дереву до корня и получает правильный полный адрес
	 *
	 * @param unknown_type $id                - ID вершины
	 * @param unknown_type $alias        - результат - путь
	 */
	function _getPagePathById($id, &$alias, $table)
	{
		$sql        = "select pid, alias from `se_{$table}` where id='".$id."'";
		$this->db->do_query($sql);

		if ($rows = $this->db->fetch_row()){  // выполняем запрос и проверяем колическо полученных строк

			if ($rows['pid'] != '-1')
			{
				$this->_getPagePathById($rows['pid'], $alias, $table);
			}
			$alias        .= $rows['alias']."/";

		}
	}


	/**
	 * вызывается из moveCatalogToMenu
	 *
	 * @param unknown_type $id
	 * @param unknown_type $pid
	 */
	function _MoveToMenuRecurc($id, $pid, $table, $is_sheet = 0)
	{
		if( $is_sheet )
		{
			$q = "and is_sheet = 0";
		}
		else
		{
			$q = "";
		}

		// информация о вершине
		if( $table != 'static' )
		{
			$alias = "/{$table}/";
		}
		else
		{
			$alias = "/";
		}

		$this->_getPagePathById($id, $alias, $table);   // полный путь

		$sql        = "select * from se_{$table} where is_active = 1 {$q} and id='".$id."'";
		$menu        = '';        // название заготовленное для меню

		$this->db->do_query($sql);

		if ($rows = $this->db->fetch_row())
		{
			if( $rows['menu'] )
			{
				$menu = $rows['menu'];
			}
			else
			{
				$menu = $rows['title'];
			}
		}

		if( $menu )
		{
			// вставляем новую вершину в меню
			$this->db->do_insert( 'mitems', array( 'pid'          => $pid,
                                                               'title'        => $menu,
                                                               'alias'        => $alias,
                                                               'item_order'   => 0,
                                                               'is_active'    => 1,
                                                               'item_simple'  => 1,
                                                               'table_name'   => -1,
                                                               'table_idnode' => -1,
                                                               'item_dynamic' => 1,
                                                               'mtitle'       => $rows['title'],
                                                               'timestamp'    => $rows['timestamp'],
                                                               'author'       => $rows['author'],
                                                               'sbody'        => $rows['sbody'],
                                                               'body'         => $this->settings['add_body'] ? $rows['body'] : '',
                                                               'price'        => $rows['price'],
                                                               'h1'           => $rows['h1'],)  );
		}


		// получаем идентификатор последней записи в таблице
		$sql = "select id from ".TABLE_MITEMS." order by id desc";
		$this->db->do_query($sql);

		if ($rows = $this->db->fetch_row())
		{
			$pid = $rows['id'];
		}
		else
		{
			return;
		}

		// получаем список наследников
		$sql = "select id from se_{$table} where is_active = 1 {$q} and pid='".$id."' order by item_order";
		$this->db->query($sql, $r);

		foreach($r as $row)
		{
			$this->_MoveToMenuRecurc($row['id'], $pid, $table, $is_sheet);  // очередной реккурсивный вызов
		}
	}


	/*-------------------------------------------------------------------------*/
	// Returns the offset needed and stuff - quite groovy.
	/*-------------------------------------------------------------------------*/

	/**
	 * Calculates the user's time offset
	 *
	 * @return        integer
	 */
	function get_time_offset()
	{
		$r = 0;

		$r = 3 * 3600;

		if ( isset($this->member['dst_in_use']) AND $this->member['dst_in_use'] )
		{
			$r += 3600;
		}

		return $r;
	}



	/**
	 * Перевод строки в вещественное число
	 *
	 */
	function StringToFloat($source)
	{
		// заменяем запятые на точки, чтоб не было подлых ошибок
		$res = str_replace(",", ".", $source);

		// убираем все знаки не являющимися цифрой, точной или запятой
		$res = preg_replace("#[^\.,\d]#", "", $res);

		$res = floatval($res);        // в зависимости от интерпретатора получится или точка или запятая

		return $res;
	}

	/*------------------------------------------------------------------*/
	// работа с сессией
	/*------------------------------------------------------------------*/
	/**
	 * вставляем в кеш сессии данные
	 *
	 * @param int      $id
	 * @param string   $type
	 * @param array    $value
	 */
	/*------------------------------------------------------------------*/
	function updateSession( $id = '', $type = 'update', $value = array())
	{
		//-----------------------------------
		// длина id сессии должна быть 32 символа
		//-----------------------------------
		if(!$id or strlen($id) != 32)
		{
			return;
		}

		//-----------------------------------
		// тип действий должен быть срого фиксировным
		//-----------------------------------
		$type = $type == 'update' ? $type : 'delete';

		//-----------------------------------
		// пришедший массив на обновление должен быть не пуст
		//-----------------------------------
		if( !count($value) or count($value) < 1 or !is_array($value))
		{
			return;
		}

		//-----------------------------------
		// если слчаной сессия не распакована то распаковываем ее
		//-----------------------------------
		if( !is_array($this->member['session_cache']))
		{
			$this->member['session_cache'] = unserialize($this->member['session_cache']);
		}

		//-----------------------------------
		// кеш должен быть массивом
		//-----------------------------------
		if( !is_array($this->member['session_cache']))
		{
			$this->member['session_cache'] = array();
		}

		//-----------------------------------
		// обновляем данные в массиве сессии
		//-----------------------------------
		if( $type == 'update' )
		{
			foreach( $value as $key => $val )
			{
				$this->member['session_cache'][ $key ] = $val;
			}
		}
		else
		{
			foreach( $value as $key => $val )
			{
				unset($this->member['session_cache'][ $key ]);
			}
		}

		//-----------------------------------
		// обновляем данные в базе
		//-----------------------------------
		$this->db->do_update('session', array('session_cache' => serialize($this->member['session_cache'])), "session_id='{$id}'");
	}

	/*------------------------------------------------------------------*/
	// Значение временных данных по ключу
	/*------------------------------------------------------------------*/
	/**
	 * получаем знаениме из кеша сессии
	 *
	 * @param int $key
	 * @return mixed
	 */
	/*------------------------------------------------------------------*/
	function getValueSession($key = '')
	{
		$res = array();
		
		//-----------------------------------
		// если ключ пуст то возвращаем пустоту
		//-----------------------------------
		$key = trim($key);
		if( !$key )
		{
			return;
		}

		//-----------------------------------
		// главное, чтобы session_cache был массивом
		//-----------------------------------
		
		if(!is_array($this->member['session_cache']))
		{
			$this->member['session_cache'] = unserialize($this->member['session_cache']);
		}
		
		
		if ($this->member['session_cache'][$key])
		{
			$res = $this->member['session_cache'][$key];
		}
		

		return $res;
	}


	/**
	 * Возвращает размер файла в Kb
	 *
	 * @param unknown_type $source - путь к файлу
	 * @return - размер файла в Kb
	 */
	function getFileSize($source)
	{
		$res = 0;        // результат, инициализируем вначале нулём

		$source = strstr($source, ".") == $source ?  $source : ".".$source;        // для физического доступа к файлу нужен относительных путь
		if (file_exists($source))
		{
			$res = filesize($source);
		}

		return round($res / 1024);                // результат в байтах делим 1024 и получаем килобайты
	}


	/**
	 * Возвращает ширину, высоту и другие параметры картинки
	 *
	 * @param unknown_type $source        - путь к картинке
	 * @return unknown                                - ширину, высоту и другие параметры
	 */
	function getWithHeightImage($source)
	{
		$res = array();        // результат, вначале просто пустой массив

		$source = strstr($source, ".") == $source ?  $source : ".".$source;        // для физического доступа к файлу нужен относительных путь
		if (file_exists($source))
		{
			$res = getimagesize($source);
		}


		return $res;
	}


	/**
	 * Получение из строки целого числа, откидывая все посторонние знаки
	 */
	function StringToInt( $value )
	{
		return preg_replace( "#[^\d]*#", "", $value );
	}


	/**
	 * Получение целого числа
	 *
	 * @param unknown_type $value	- значение
	 * @param unknown_type $intval	- только целое! без знаков и нулей перед значимой частью
	 */
	function MixedToInt( $value, $intval = false )
	{
		# удаление
		$znak = $value < 0 ? -1 : 1;
		$value = preg_replace( "#^d*#", "", $value ) * $znak;
		$value = (int)$value * $znak;

		if ($intval)
		{
			# получаем только целочисленное значение
			$value = intval($value);
		}

		return $value;
	}


	/*------------------------------------------------------------------*/
	// Редирект на определенный URL
	/*------------------------------------------------------------------*/

	function globalRedirect($url = '', $need_redirect_screen = 0, $need_exit = 1, $seconds = 5)
	{
		if( !$url )
		{
			return;
		}

		//---------------------------------
		// отправляем хедер то что это редирект
		//---------------------------------
		header ('HTTP/1.1 301 OK');

		//---------------------------------
		// урл на который надо сделать редирект
		//---------------------------------
		header("Location: {$url}");

		if( $need_exit )
		{
			exit();
		}
	}

	function findRootId( $tblname, $parentfield, $curid )
	/** Ищет запись, чей parentfield <= 0
	 * $tblname - имя таблицы где искать
	 * $parentfield - поле, обозначаюшее pid
	 * $curid - текущая запись
	 */
	{
		$sql = "SELECT `id`, `".$parentfield."` FROM `".$tblname."`";
		$this->db->do_query($sql);
		$vals = array();
		while ($row = $this->db->fetch_row())
		{
			$vals[$row['id']] = $row[$parentfield];
		}
			
		while ($vals[$curid] > 0 && isset($vals[$curid]) && $curid > 0)
		{
			$curid = $vals[$curid];
		}

		if (!isset($vals[$curid])) return -1;
		else return $curid;
	}


	/**
	 * Возвращяем метру времени в микросекундах
	 *
	 */
	function getmicrotime()
	{
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}
		


	/**
	 * Массив $f1 из которого удален элемент, равный $f2			 *
	 */
	function array_trim ($f1, $f2) {
		$return = array_values(array_diff($f1, explode(" ",$f2)));
		return $return;
	}

		
	/**
	 * загрузка файла в папку текущего модуля
	 *
	 * @param unknown_type $Source			- источник
	 * @param unknown_type $FileName		- под каким именем сохранить
	 * @param unknown_type $ModuleName		- название модуля - в такую же папку кидать
	 * @param unknown_type $error			- какая ошибка возникла при выполнении
	 *
	 * @return unknown - если пусто, то файл не закачался, иначе возвращается расширение файла (в нижнем регистре) с точкой
	 */
	function uploadFile( $Source, $FileName, $ModuleName, &$error, &$ext = '')
	{
		$error        = "";	// возможная ошибка
		 
		$dir		= $this->config['path_files']."/".$ModuleName; // каталог, в который нужно загрузить картинку
		
		if (!file_exists($dir))
		{		// каталога ещё нет, но нужно создать
			if (@mkdir($dir))
			{		// создали каталог
				@chmod($dir, 0776);
			}
		}
		
		if (file_exists($dir))
		{
			if (!is_writable($dir))
			{
				@chmod($dir, 0776);
			}
		} 
		
			
		// если папка есть  и доступна для записи, то закачиваем файл
		$img = "";
		if (file_exists($dir) && is_writable($dir))
		{
			if ($ext == '')
			{
				$ps = strrpos($Source["name"], ".");
				$img = strtolower(substr($Source["name"], $ps+1));
				$ext = $img;
			}
			if (!@move_uploaded_file( $Source["tmp_name"], $dir .'/'. $FileName . '.' . $ext))
			{
				$error .= "Не получилось загрузить файл.";
			}
		}
		else
		{
			$error .= "Невозможно создать каталог для загрузки файла.";
		}
		 
		 
		// если были ошибки или файл не загрузился
		if ($error != "")
		{
			@unlink( $dir .'/'. $filename );
			@unlink( $Source["tmp_name"] );
		}
		 
		return $img;
	}
		
	/**
	 * Копирует файл с места на место
	 *
	 * @param unknown_type $Source		- откуда
	 * @param unknown_type $FileName 	- имя файла
	 * @param unknown_type $ModuleName	- в какой каталог
	 * @param unknown_type $delAfter	- удалять исходных файл после удачного копирования
	 * @param unknown_type $error		- сообщение об ошибке
	 * @return unknown
	 */
	function moveFile($source, $newFileName, $dir, $delAfterCopy = 1, &$error)
	{
		$error        = "";	// возможная ошибка
		 
		$dir		= $dir; // каталог, в который нужно скопировать файл
		if (!file_exists($dir))
		{		// каталога ещё нет, но нужно создать
			if (@mkdir($dir))
			{		// создали каталог
				@chmod($dir, 0776);
			}
		}
			
		if (file_exists($dir))
		{
			if (!is_writable($dir))
			{
				@chmod($dir, 0776);
			}
		} 
		

		# если каталог доступен, то копируем
		if (file_exists($dir) && is_writable($dir))
		{
				
			if (!@copy( $source, $dir .'/'. $newFileName))
			{
				$error .= "Не получилось загрузить файл.";
			}
		}
		else
		{
			$error .= "Невозможно создать каталог для загрузки файла.";
		}
		 
		 
		// если были ошибки или файл не загрузился
		if (($error == "") && ($delAfterCopy))
		{
			@unlink( $source );
		}
	}
		
		
	/**
	 *  распаковка файла в указанную папку
	 *  $dir   - куда распаковывать
	 *  $file  - файл, который распаковывать
	 */
	function UnPackZip($dir, $file){
		include_once($this->config['path_lib'].'/pclzip.lib.php');   // включаем модуль работы с архивами
			
		$zip = new PclZip($file);  // инициализация класса PclZip(работа с архивами)
			
		if ($zip->extract($dir, 0755))
		{
			// всё хорошо, файлы извлечены и свойства изменены, пожно продолжать
			// удаление исходного архива
			unlink($file);
			// освобождаем память
			unset($zip);
			return true;
		}else{
			unset($zip);
			return false;
		}
	}
		
		
	/**
	 * загрузка внешнего файла в определённыю папку на сервере
	 * возвращает 0, если ошибок нет
	 */
	function uploadModule( $tmpfilename, $filename, $dir, &$error, &$msg, $check_dir = 1) {
		$error        = 0;
		$msg        = '';
		$file = $dir.'/'.$filename;  // полное имя загруженного файла
			
		
		
		if(((!file_exists($dir)) && ($check_dir == 1)) || ($check_dir == 0)){  // если каталога с таким названием нет
			if ((@mkdir($dir)) || ($check_dir == 0)){  // каталог создаётся?
				if (is_writable( $dir )) {        // можно ли писать в каталог?
					// копируем файл в подготовленную папку
					if (!@move_uploaded_file( $tmpfilename, $dir .'/'. $filename )) {
						$msg = 'Не могу переместить скачанный файл в каталог /'.$dir."<br /><font style='color:red'>Возможно закончилось место на сервере.</font>";
						$error = 4;
					}
				} else {
					$msg = 'Загрузка сорвана, так как каталог /'.$dir.' недоступен для записи.';
					$error = 3;
				}
			}else{  // если не не удалось создать папку для модуля
				$msg = "Не удалось создать папку для устанавливаемого модуля. Проверьте права доступа к папке модулей.";
				$error = 2;
			}
		}else{  //  если папка с модулем уже существует
			$msg = "Такой модуль уже установлен в системе";
			$error = 1;
		}
			
		if( !@filesize( $dir .'/'. $filename ) and !$error )
		{
			@unlink( $dir .'/'. $filename );
			$msg = "неудалось создать файл на сервере, вероятно, закончилось место.";
			$error = 1;
		}
			
		return $error;
	}

	/**
	 * смена прав папок и файлов
	 *
	 * @param unknown_type $path
	 * @param unknown_type $perm_dir
	 * @param unknown_type $perm_file
	 */
	function chmod_R($path, $perm_file)
	{
		$handle = opendir($path);
		while ( false !== ($file = readdir($handle)) )
		{
			if ( ($file !== ".") && ($file !== "..") )
			{
				if ( is_file($path."/".$file) )
				{
					chmod($path . "/" . $file, $perm_file);
				} else {
					//chmod($path . "/" . $file, $perm_dir);
					$this->chmod_R($path . "/" . $file, $perm_file);
				}
			}
		}
		chmod($path, $perm_dir);
		closedir($handle);
	}
		
		
	/**
	 * инициализация работы с XML файлом
	 *
	 * @param unknown_type $file - полный путь к файлу, из него нужно будет взять содержимое
	 * @param unknown_type $xml - ресурс, в который будет сохранён XML
	 * @return unknown
	 */
	function xmlfileInit($file, &$xml)
	{
		require_once $this->config['path_lib'].'/class_xml.php';

		$xml = new class_xml();
		$xml->doc_type = 'utf-8';
			
		$file = trim(file_get_contents($file));
		if ($file == '')
		{
			return false;
		}
			
		return $xml->xml_parse_document( $file );
			
	}

	
	
	
	
	
	
	
	
	########################################################################################################################
	########################################################################################################################
	
	#функциии на удаление 
	
	########################################################################################################################
	########################################################################################################################
	
	
	
	
	/*-------------------------------------------------------------------------*/
	// читаем дирикторию темплейтов и берем все имена темплейтов
	/*-------------------------------------------------------------------------*/
	
	function get_templates_names( $dir = '' )
	{
		$dir = $dir == '' ? $this->config['path_templates'] : $dir;

		$files = array();

		if ( is_dir($dir) )
		{
			$handle = opendir($dir);

			while ( ($filename = readdir($handle)) !== false )
			{
				if (($filename != ".") and ($filename != ".."))
				{
					if (preg_match("/^(.+?)\.html$/is", $filename, $match))
					{
						$files[] = $match[1];
					}
				}
			}

			closedir($handle);
		}

		return $files;
	}
	
	
	/****************************************************************************
	 *  Дата формата dd.mm.yyyy hh:mm из даты UNIX-формата $f    (аналог новой getSystemTime)                 *
	 ****************************************************************************/

	function getNormalTime ($f, $format = 'j.m.Y H:i')
	{
		$return = date($format,$f);
		return $return;
	}


	
	/*---------------------------------------------------------*/
	// переводим время (аналог новой getSystemTime)
	/*---------------------------------------------------------*/
	function get_time($timestamp = 0, $format = '')
	{
		if(!$format)  return;
		if(!$timestamp) return;

		$month_lang        = array( 0  => "Января",
		1  => "Февраля",
		2  => "Марта",
		3  => "Апреля",
		4  => "Мая",
		5  => "Июня",
		6  => "Июля",
		7  => "Августа",
		8  => "Сентября",
		9 => "Октября",
		10 => "Ноября",
		11 => "Декабря",);

		$month_lang_eng        = array( 0  => "January",
		1  => "February",
		2  => "March",
		3  => "April",
		4  => "May",
		5  => "June",
		6  => "July",
		7  => "August",
		8  => "September",
		9 => "October",
		10 => "November",
		11 => "December",);

		$outdate = gmdate($format, $timestamp);

		$outdate = str_replace( $month_lang_eng, $month_lang, $outdate);

		return $outdate;
	}
	
	
}











#--------------------------------------------------------------------------
#--------------------------------------------------------------------------
#--------------------------------------------------------------------------
# ГЛАБАЛЬНЫЕ ФУНКЦИИ
#--------------------------------------------------------------------------
#--------------------------------------------------------------------------
#--------------------------------------------------------------------------


function pul($mod_name, $pul_name)
{
	global $std;
	return $std->getPul($mod_name, $pul_name);
}

?>