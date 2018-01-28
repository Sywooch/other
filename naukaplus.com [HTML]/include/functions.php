<?php


#
#        ����� ����� �������� � ���� ��� (�������� ����������, ������ ������ � �� � �.�)
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
	# ���� ����������, ������������ ��� ������ ���� ������� ����������� �������
	#--------------------------------------------------------------------------
	public $modules		= array();
	public $config		= array();
	public $input		= array();
	public $host		= "";
	public $uri			= "";
	public $member		= array();
	public $alias		= array();

	/** ������ ������ � ��������� ��� ������ �� ����� */
	public $pul			= array();

	/** �������������� ������ ���� ������� ������� */
	public $modules_all	= array();

	public $session_id = null;
	//public $ucache = null;
	
	/**  ����� - ��������� ����   */
	public $image = null;
	
	/**  ����� - ��������� ����   */
	public $mail = null;
	
	
	/**  ����� - ������������   */
	public $users = null;

	#--------------------------------------------------------------------------
	# �����
	#--------------------------------------------------------------------------

	function __constructor($config)
	{
		$this->config = &$config;
		$this->get_magic_quotes = get_magic_quotes_gpc();

		# ���� ������ � ������������ (�������, ��, IP)
		$this->identUserProp();
		 

		# ���� ����� ����������� ���� ���� ���� � ����������� ����, ����� ��� �� ���������
		if( !file_exists( $this->config['path_include']."/config_db.php" ) )
		{
			header("Location: ../install.php");
		}
		else
		{
			require $this->config['path_include']."/config_db.php";
		}


		# ������������� ���� ������
		$this->init_db_connect($INFO);

		# ���������� �������� ������� ������
		$this->defineTables();



		// ������ �������
		/*define ('ACCESS_ADMIN', 	1);
		define ('ACCESS_USER', 		2);
		define ('ACCESS_GUEST', 	3);
		define ('ACCESS_AUTHOR', 	4);
		define ('ACCESS_EDITOR', 	5);

		$this->access_titles = array(
		ACCESS_GUEST => '�����',
		ACCESS_USER => '������������',
		ACCESS_AUTHOR => '�����',
		ACCESS_EDITOR => '��������',
		ACCESS_ADMIN => '�������������',
		);*/

		# �������� ������
		$this->input = $this->parse_incoming();

		
		# �� ���������, ���� ��������� (install)
		if( $this->install_var != 1 )
		{
			// ��������� ��� �������� � ������ �������
			$this->session_parse();
		
			#--------------------------------------------
			# �������� �� ���� ������ �������� �������
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
	# ��������� �������������
	#---------------------------------------------------------------------
	#---------------------------------------------------------------------
	
	

	/**
	 * ��������� ���������� �������� � ��
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
	 * ���������� �������� ������� ������
	 *
	 */
	private function defineTables()
	{
		// ������� �������
		define ('TABLE_MODULES', TABLENAME_PREFIX.'modules');

		// ������� ����
		define('TABLE_MITEMS', TABLENAME_PREFIX.'mitems');

		// ������� �������������
		define('TABLE_USER',TABLENAME_PREFIX.'users');
	}


	/**
	 * ���� ������ � �� ������������ (�������, ��, IP)
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
			print "�� �������� ���������� ��� IP �����!";
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
	# �����: ��������� �������������
	#---------------------------------------------------------------------
	#---------------------------------------------------------------------
	
	
	

	
	#---------------------------------------------------------------------------------
	#---------------------------------------------------------------------------------
	# �����������
	#---------------------------------------------------------------------------------
	#---------------------------------------------------------------------------------
	
	
	
	
	/**
	 * ������������ ����� ������ ��� ����� �������������
	 *
	 */	
	function addSessionNew()
	{		
		$session_array = array( 'session_id' => $this->session_id, 
								'session_last_update' => time(),
								'session_cache' => serialize(array()) );

		// ���������� ���� � ������
		
		$this->setcookie('session_id', $this->session_id );
		$this->setcookie('authorization', 'no');
			

		# ��������� � ���� ������
		$this->db->do_insert( 'session', $session_array );
	}

	/**
	 * �������� ������
	 */
	function session_parse()
	{
		$this->session_id = $this->my_getcookie('session_id');
		
		if (is_null($this->session_id))
		{
			# � ����� ������ ���. ������ ����� �������
			$this->session_id = md5(microtime());
			$this->addSessionNew();
		}if (!$this->getSession())
		{
			# ���� ������ �� �������, ������ ���� ��������� � ����� ������� ������ ������
			$this->addSessionNew();
			$this->getSession();
		}
	}
	
	
	/**
	 * �� �������������� ������ �������� ��� ������ �� ���������� ������
	 *
	 * @return unknown
	 */
	public function getSession()
	{
		# � ����� ���������� ����, ����� ������� �� ���� �� � ��� ������� ������������ ������
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
	 * �������� ����� ������������
	 */
	function identification()
	{
		 
		# ���������, �������� �� � ����� �������� �� ������� �����������
		$authorization = $this->my_getcookie('authorization');
		

		if ($authorization == 'yes')
		{
			# ���� �������, ��� ������������ ��� �����������, �� ����� ���������			
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
				# ������������ �������� ��������������
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
					
					// ��������� ������ � ���� ������					
					$this->db->do_update('session', array('user_id' => $row['user_id'], 'session_cache' => serialize($this->member['session_cache'])), "session_id='{$this->session_id}'");
					
				}
				else
				{
					$this->setcookie('authorization', 'no');
					
					// ��������� ���� ������, �������� ����� ��� ������
					// die($this->auth_form('login_fail'));
					$this->setPul('users', 'error', '������� ����� ��� ������');
				}
			}
			else
			{
				# ������ ������ ������������
				$this->sessionUserClear();				
			}
		}

	}
	
	
	/**
	 * ��������� ������ ����� �� ���������������� ������
	 *
	 */
	function sessionUserClear()
	{
		# ���� ������������ �� ���������
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
	 * ����� �� ��������������� ������ ������
	 *
	 * @param unknown_type $redirect
	 */
	function log_out( $redirect = 1 )
	{
		$this->setcookie('authorization'  , "no");
		
		# ������������ ������������, ������ ����� ��������� � �� ��� ������
		$cache = $this->member['session_cache'];
		unset($cache['user']);	// ������� �� ���� ���������� ��� ���� ������ ������������
		$pms = array();
		$pms['session_cache'] = serialize($cache);
		$pms['user_id'] = 0;
		$this->db->do_update('session', $pms, "session_id = '".$this->session_id."'");
		
		
		# ������ ������ ������������
		$this->sessionUserClear();
		
		
		
		if( $redirect )
		{
			if (in_array($this->config['folder_admin'], $this->alias))
			{
				header("Location: /admin/");        // �� ����� � �������
				
			}
			else
			{
				header("Location: /");        // �� �������
				exit;
			}
			
			
		}
	}
	
	
	#---------------------------------------------------------------------------------
	#---------------------------------------------------------------------------------
	# �����: �����������
	#---------------------------------------------------------------------------------
	#---------------------------------------------------------------------------------
	




	#------------------------------------------------------------------------------
	# ������ � ����� ������
	#------------------------------------------------------------------------------


	/**
	 * ��������� �������� ����=
	 *
	 * @param unknown_type $pul_name	- �������� �����
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
	 * ��������� �������� � ���� �������
	 *
	 * @param unknown_type $pul_name	- �������� �����
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
	 * ���������� � ��� ������ ������
	 *
	 * @param unknown_type $mod_name	- �������� ������
	 * @param unknown_type $pul_name	- �������� �����
	 * @param unknown_type $data		- �������
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
	 * ������ � ���� ��������� ������
	 *
	 * @param unknown_type $pul_name	- �������� �����
	 * @param unknown_type $data		- �������
	 * @param unknown_type $key			- ���� ������
	 */
	public function replacePul($mod_name, $pul_name, $replace = array())
	{
		if ($pul_name != '')
		{
			# �������� �������� ���� �� ������, ���� �� ��� �� ������
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
	 * ���������� �������� ����
	 *
	 * @param unknown_type $pul_name	- �������� �����
	 * @param unknown_type $data		- �������
	 */
	public function updatePul($mod_name, $pul_name, $data = '')
	{
		if ($pul_name != '')
		{
			# �������� �������� ���� �� ������, ���� �� ��� �� ������
			$this->setPul($mod_name, $pul_name);

			$this->pul[$mod_name][$pul_name] = $data;
		}
		return;
	}

	/**
	 * ������� ���� �� ��������
	 *
	 * @param unknown_type $mod_name	- �������� ������
	 * @param unknown_type $pul_name	- �������� �����
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
	 * ������� ����� ����
	 *
	 * @param unknown_type $mod_name	- �������� ������
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
	# �����: ������ � ����� ������
	#------------------------------------------------------------------------------


	
	
	
	#------------------------------------------------------------------------------
	# ������ � �������������
	#------------------------------------------------------------------------------
	
	/**
	 * ������������� ������ ��� ������� ����
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
				$error .= 'std->initImage :: �� ������� ���������� '.$this->config['path_lib'].'/class_image.php;'.chr(13); 
			}
								
		}
		
		
		if (!in_array($mod_name, array_keys ($this->modules_all)))
		{
			$error .= 'std->initImage :: '.$mod_name.' - ������� ������� �������� ���������� ������;'.chr(13);
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
	# �����: ������ � �������������
	#------------------------------------------------------------------------------
	
	
	
	
	
	
	#------------------------------------------------------------------------------
	# ������ � ������
	#------------------------------------------------------------------------------
	
	/**
	 * ������������� ������ �����
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
				$error .= 'std->initImage :: �� ������� ���������� '.$this->config['path_lib'].'/class_mailer.php;'.chr(13); 
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
	# �����: ������ � ������
	#------------------------------------------------------------------------------
	
	
	
	
	
	
	
	
	
	
	
	
	#------------------------------------------------------------------------------
	#------------------------------------------------------------------------------
	#------------------------------------------------------------------------------
	#------------------------------------------------------------------------------
	# ��������� �������
	#------------------------------------------------------------------------------
	#------------------------------------------------------------------------------
	#------------------------------------------------------------------------------
	#------------------------------------------------------------------------------
	
	

	/**
	 * ����� ��������� � ���
	 */
	public function log($text)
	{
		error_log(strftime("%d.%m.%Y %H:%M:%S")." ".$text."\n", 3, $this->config['errorlog']);
	}
	

	/**
	 * ������������� timestamp � ��������������� ����
	 */   
	function getSystemTime ($timestamp = '', $format = 'j.m.Y H:i')
	{
		$timestamp = $timestamp == '' ? time() : $timestamp;
		
		$month = array( 
			"January"	=> "������",
			"February"	=> "�������",
			"March"		=> "�����",
			"April"		=> "������",
			"May"		=> "���",
			"June"		=> "����",
			"July"		=> "����",
			"August"	=> "�������",
			"September"	=> "��������",
			"October"	=> "�������",
			"November"	=> "������",
			"December"	=> "�������");
		
		$return = date($format, $timestamp);				
		return strtr($return, $month);
	}
	
	
	/**
	 * �������������� ���������������� ���� ���� � UNIX-timestamp
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
				# ���� �� ���������� ��������� ����, �� ���������� ������� �����
				return time();
			}
			else
			{
				# ���� ���� ����������, �� ���������� ��� timestamp �������������
				return mktime($timestamp[3],$timestamp[4],0,$timestamp[1],$timestamp[0],$timestamp[2]);
			}
		}
		else
		{
			# ���� ��������� ���, �� ���������� ������� �����
			return time();
		}
	}
	
	
	
	
	 /**
	  * �������� ���������� ����, ������ ��� ��� ������� ��������� ��� ���������
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

		// ���� �������� �������
		if (strpos($uri, 'admin') == 1)
		{
			//-----------------------------------
			// ���� ������ ��� /admin �� ����������� /admin/
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

		// ���� � ��������� URL ���� ?
		// ���� � ��������� URL �� ����� ����� � �����
		// ���� � ��������� URL �� ����� www
		// ���� � ��������� URL ������ �����
		// ���� � ��������� URL ������ index.php
		// ���� � ��������� URL ������ index.
		// ���� � ��������� URL ������ index

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

		// ������� URL �� ������������ 80-�� ����� � ���������� ��������� 301
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
			// still here? �.�
			exit();
		}

		// ������ ��������� �������
		$alias = explode('/',substr($uri,1,strlen($uri)-2));
		if (count($alias) > 0)
		{
			if ($alias[0] == '')
			{
				$alias = array();
			}
		}

		// ���������� ��������� � ������� �������
		$alias_count = 0;
		$alias_count = count($alias);

		/****************************************************************************
		 *  ������ ��������� �������� ��� ������� ��������                           *
		 ****************************************************************************/

		$this->parse_father();

		# �������� �� ��������� �������, ������� ������� ������
		$this->clean_alies( $alias );

		# ���
		global $year;
		$year = date("Y");


		# �������� �������� ������ "print", ������ ����� ��������� ���
		$alias = $this->workPrintPage( $alias );
		$this->alias = $alias;
	}

	/**
	 * ���� �������� ������ "print", �� ��������� ��� � ������� ����
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
	 * ����������� ������ ������ html � ��������� ����������
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
	 * �������� ���� �����
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
	# �����: ��������� �������
	#------------------------------------------------------------------------------
	#------------------------------------------------------------------------------
	#------------------------------------------------------------------------------
	#------------------------------------------------------------------------------
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	


	/*-------------------------------------------------------------------------*/
	// ������������� �������� ����
	/*-------------------------------------------------------------------------*/
	/**
	 * ��������� ��� �������:
	 *   - ������ ������ ������
	 *   - ������ ������ ����
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
	// ����� �� ������
	/*-------------------------------------------------------------------------*/
	/**
	 * ��������� ��������� �� ������� ������
	 * � ���� ����� � ����������� id
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
	 ����� ������� ������ ����
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

		foreach ($childs as $child) // �� ���� ������� ����
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
	 * ����� ������� ������ ����
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

		// �������� ������� �������
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
		foreach ($childs as $child) // �� ���� ������� ����
		{
			if ($child['alias'] != $uri)
			{
				$childs = $this->menu_item_childs($child['id']);
				$count_childs = $this->CalcClidren( $child['id'] );//count($childs);

				// ������ ����������� �������, ���� � ������� ����� $pid
				if(!$type)
				{
					$menu .= $this->createNode($child, $_template, &$menu);
				}
				// ������� ����� � ������������
				elseif( $type == 1 )
				{
					if( $count_childs > 0 )
					{
						$menu .= $this->createNode($child, $_template, &$menu);
					}
				}
				// ������� ����� ��� �����������
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
	// ������������� ����������� ���������
	/*-------------------------------------------------------------------------*/
	/**
	 * ������������� ���� ���� �������� ��������� ���������
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
	// ������� ��������������� ���������
	/*-------------------------------------------------------------------------*/
	/**
	 * ����� ������� ������ �������������, ������� ����� ����.���������, �� ������
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
	 * ��������� ������ ��������������� ���� ����� ����� �������, ������� ���� �������
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
	 * ����������� ������ ������ ������ ����, ������� ��������� � ������������ �������� ���� �� �����
	 *
	 * @param unknown_type $uri			- ������� ���
	 * @param unknown_type $menu_id		- ������������� ������������� ����
	 * @return unknown
	 */
	function getIdsByUri( $uri,  $menu_id)
	{
		$res = array();
		$this->menu_cur_id = -1;
		
		# ��� ������� ������ ����
		$ids_menu = $this->getNodeChildsId($menu_id);
		
		
		# ����� ������� � ������� URI
		$cur_id = '';
		foreach ($this->menu_by_id as $node)
		{
			
			if (in_array($node['id'], $ids_menu))
			{
				# ������� ������ � ������ ������ ������������� ����
				
				if ($node['alias'] == $uri)
				{
					$this->menu_cur_id = $node['id'];
					break;
				}
			}			
		}
		
		if ($this->menu_cur_id != -1)
		{
				# ������ ������� �������
				$res[] = $this->menu_cur_id;
				$cur_id = $this->menu_cur_id;
			
			
				# ������ ����� ������ ������ �� ����� � ������� ��� ��������������
				
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
		# ����� ���� ��������������� ������, ����������� � ����������� �������� ����
		#---------------------------------------------------------------------------
		
		
		$uri_ids = $this->getIdsByUri( $this->uri, $id );
		
		
		switch ($flag_view)
		{
			case 0:  // ������ ������ �������, �� �������� ������������
				$menu = $this->menu_flag_view_0($id, $_template, $uri_ids);
				$menu = $this->menu_html_update($menu, $_template);
				return $menu;
				break;
			case 1:
				// ������� ������
				$menu = $this->menu_flag_view_1($id, $_template, 1, $uri_ids);
				$menu = $this->menu_html_update($menu, $_template);
				return $menu;
				break;
			case 2:
				// ������� ������
				$menu = $this->menu_flag_view_2($id, $_template, 1, $uri_ids);
				$menu = $this->menu_html_update($menu, $_template);
				return $menu;
				break;
			default:
				return '';
		}
	}

	/*------------------------------------------------------------------*/
	// ������ �������������
	//    * ��������� �������� �� ����� � ��������
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
				// ������ �������� ����� ��������� �������
				$this->array_key   = explode(',' , $k);

				// ������ ��������
				foreach( $this->array_key as $_tid => $d )
				{
					// ��� ��������� ������� ������������ ������� �� ����������� preg_replace
					$d = preg_replace("#^(\d+)(.+?)$#ie", "\$this->replace_megadelimeter('\\1', '\\2')", $d);

					// ������� ��������
					$this->array_key[ $_tid ] = $d;
				}

				// ��������� ������������� ��� ����������� � ������������ �����
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
	// ������������ ���������� �����
	/*------------------------------------------------------------------*/

	function CalcClidren( $FatherID = 0, $FirstReq = 1 )
	{
		// ���� ������ ����� ������� ��� �������� �� ���������� �������
		if( $FirstReq )
		{
			$this->CountCildren = 0;
		}

		// ��������� ���� �� ����� ������� ��� �������� �����
		if( is_array( $this->menu_array[ $FatherID ] ) )
		{
			// ����������� �� ����� ���������
			foreach( $this->menu_array[ $FatherID ] as $menu_data )
			{
				// ����������
				$this->CountCildren++;

				// ����������� ����� ��� ��������� ��������
				$this->CalcClidren( $menu_data['id'], 0 );
			}
		}

		// ���� � ��� ���� ���� �� ���������� ������� �.�. �������� � ����
		return $this->CountCildren;
	}


	/*------------------------------------------------------------------*/
	// ������ �������� ��������� �������������
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
	 ����� ���� ��� ��������, ������������: ������ � ����� ����, �����������, �������� � ���������� ������ ����
	 ������������ ��� ������ ��� ������ �������� ������ ����, ��� � ����� ���������, ������� �������� �������������
	 ***************************************************************************************************************/
	function menu_flag_view_0($id, $_template, &$uri_ids = array())
	{
		$menu                = '';

		$childs = $this->menu_item_childs($id); // ������ ���������� � ����� ������

		$this->count_menu = count($childs);
		if( $_template['megadelimiter'] )
		{
			$this->parcer_magadelimeter( $_template['megadelimiter'] );
		}

		$count = 1;
		foreach ($childs as $child)     // �� ���� ������� ����
		{
			$menu .= $this->createNode($child, $_template, 1, 1, $uri_ids);
			if( $this->parse_delimeter[ $count ] )
			{
				$menu .= $this->parse_delimeter[ $count ];
			}
			$count++;

			// ������� ����������
			$childs_arr = $this->menu_item_childs($child['id']);
			$count_childs = $this->CalcClidren( $child['id'] );//count($childs_arr);
			$menu = str_replace('{COUNTCHILDS}', $count_childs, $menu);
		}

		$this->parse_delimeter = array();
		return $menu;
	}

	/***************************************************************************
	 ��������� ������� ����� ������
	 ����:         id - �������������
	 �����:  childs - �������������� ����� (������ �������)
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
	 ����� ���� c ����� ������� �������, ������������: ������ � ����� ����, �����������, �������� � ���������� ������ ����
	 ������������ ��� ������ ��� ������ �������� ������ ����, ��� � ����� ���������, ������� �������� �������������
	 ***********************************************************************************************************************/
	function menu_flag_view_1($id, $_template, $d = 1, &$uri_ids = array())
	{
		global $uri;

		$tree                = '';
		// ������ ����������� �������, ���� � ������� ����� $pid
		$childs = $this->menu_item_childs($id);   // ������ ���������� � ����� ������

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

		// ��������� ����������� �����������
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

		foreach ($childs as $child) // �� ���� ������� ����
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
	 ����� ���� c ����� ������� �������, ������������: ������ � ����� ����, �����������, �������� � ���������� ������ ����
	 ������������ ��� ������ ��� ������ �������� ������ ����, ��� � ����� ���������, ������� �������� �������������
	 **********************************************************************************************************************/
	function menu_flag_view_2($id, $_template, $d = 1, &$uri_ids = array())
	{
		global $uri;

		$tree                = '';
		// ������ ����������� �������, ���� � ������� ����� $pid
		$childs = $this->menu_item_childs($id);   // ������ ���������� � ����� ������

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

			// ��������� ����������� �����������
			if( $_template['depth'] and $_template['depth'] < $d )
			{
				return;
			}

			$this->last_delimeter = $temp_delimiter;

			$this->deaph++;
			$count = 1;
			foreach ($childs as $child)// �� ���� ������� ����
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
	 ������� ������������ ������ ����, ��������� ����������
	 **********************************************************************/
	function createNode($child, $_template, $d = 1, $delim_on= 1, &$uri_ids = array())
	{
		global $uri, $alias;        // URL ��� ����
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

		// ������� ������ �������
		$time_now       = $this->get_date_format($temp_now);
		$time_active    = $this->get_date_format($temp_active);
		$time_inactive  = $this->get_date_format($temp_inactive);


		// ������ ��� ������������� ������, ��� ����� ��� ���� ��� ������� ������ ������ ��������� �� ����, ��� ������� � ���� /index/
		if (($child['alias'] == '/index/'))
		{
			$child['alias'] = '/';
		}

		// ������ ��� �� �� ����������� ������������ ��������� �� ���

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
			$node        .= str_replace('{TITLE}', $child['title'], str_replace('{ALIAS}', $child['alias'],$temp_now));  // ������ ����� ���� ������ ������, ������ ��� ������������
			$temp_timeformat = $time_now;
		}
		elseif (($child['alias'] == $tmp_uri) || (($child['alias'] == '/index/') && ($uri == '/'))) // ������ ����� ������� ������ ������ �� ������� �������� ��������, ����� ��� �����
		{
			$node        .= str_replace('{TITLE}', $child['title'], str_replace('{ALIAS}', $child['alias'],$temp_active));  // ������ ����� ���� ������ ������, ������ ��� ������������
			$temp_timeformat  = $time_active;
		}
		else
		{
			$node        .= str_replace('{TITLE}', $child['title'], str_replace('{ALIAS}', $child['alias'],$temp_inactive));  // ������ ����� ���� ������ �� ������, ������ ��� ����������
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

		// ������ ��� �� �� ����������� ������������ ��������� �� ���
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
			// ������� ��� �� ���� ������� ���� ��� �� �� ������������ ���� root
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
	// ������ ������ ����
	/*-------------------------------------------------------------------------*/
	/**
	 * ��������� ��������� �� ������� ������
	 * � �������� ������ ������� �� ����� � �����
	 * �������� ��������������
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
	 * �������������� �����
	 *
	 * @param unknown_type $name - �������� ������ � �����
	 * @param unknown_type $value - ��������
	 * @param unknown_type $sticky - ��������� �� ���?
	 */
	function setcookie($name, $value = "")
	{
		$period = 2592000; // ���� ����� ��� 30 ����		
		setcookie($name, $value, time() + $period, '/');
	}

	/**
	 * ������ �����
	 *
	 * @param unknown_type $name - �������� ������ � �����
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
	 * ��������� ������ ��������
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
	// ������� ������
	/*-------------------------------------------------------------------------*/

	/**
	 * Fetches the user's browser from their user-agent
	 *
	 * @param text
	 */

	function clean_alias( $text = '', $temp = 0/*����������-��������*/ )
	{
		$text = strtolower($text);


		if( preg_replace("#^[\/0-9a-z_]+$#is", "", $text) and $text)
		{
			return '<li>����� ������ �����������</li>';
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

		if( !$table ) return '<li>������ �� ������ ���� ������</li>';

		// �������� ��� ������ ���������� ������ �����
		$this->db->do_query("SELECT count(*) as count FROM se_{$table} WHERE alias='{$alias}' and pid={$pid}");
		$max = $this->db->fetch_row();

		if( $max['count'] > $count_alias )
		{
			return '<li>����� ����� ����������� � �������, ������� ���������� �����</li>';
		}
		else
		{
			return '';
		}
	}

	/*-------------------------------------------------------------------------*/
	// ������� ��������� � ����� ���������� ���� menu, description...
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
			return "<li>�������� �� ������� �����������</li>";
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
		$st = str_replace( "�", "yo", $st );
		$st = str_replace( "�", "yo", $st );

		$st = preg_replace('/��(?=\s)/s', 'y', $st);

		$st = strtr(
		$st,
                                "����������������������������������������������",
                                "abvgdegziyklmnoprstufieabvgdegziyklmnoprstufie"
                                );

                                $st = strtr($st, array(
                                       '�' => "h",
                                       '�' => "ts",
                                       '�' => "ch",
                                       '�' => "sh",
                                       '�' => "shch",
                                       '�' => '',
                                       '�' => '',
                                       '�' => "yu",
                                       '�' => "ya",
                                       '�' => "h",
                                       '�' => "ts",
                                       '�' => "ch",
                                       '�' => "sh",
                                       '�' => "shch",
                                       '�' => '',
                                       '�' => '',
                                       '�' => "yu",
                                       '�' => "ya",
                                ));

                                $st = strtolower( $st );
                                $st = preg_replace('/[^a-z0-9_]+/i', '_', $st);
                                $st = trim($st);
                                return $st;
	}


	/*-------------------------------------------------------------------------*/
	// JavaSript �������� �� ���������
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
				msg = \"����������, ������� ����� ��������(�� 1 �� \" + pages + \") �� ������� �� ������ �������\";
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
			$outnavi .= "<a title='������� � ��������' href=\"javascript:multi_page_jump('$ub',$tp,$pp, '$type')\">��������:</a>";
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
		// ��������� ���������������� ������������ ���������
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
							$work['st_dots'] = "&nbsp;<a href='{$data['BASE_URL']}{$link_end}0' title='��������: 1'>&laquo; ������</a>&nbsp;...";
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
							$work['st_dots'] = "&nbsp;<a href='{$data['BASE_URL']}{$link_end}0' title='��������: 1'>&laquo; ������</a>&nbsp;...";
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
							$work['end_dots'] = "...&nbsp;<a href='{$data['BASE_URL']}{$link_end}".($work['pages']-1) * $data['PER_PAGE']."' title='�������� {$work['pages']}'>��������� &raquo;</a>";
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
							$work['end_dots'] = "...&nbsp;<a href='{$data['BASE_URL']}{$link_end}".($work['pages']-1) * $data['PER_PAGE']."' title='�������� {$work['pages']}'>��������� &raquo;</a>";
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
	// ����� ������ ����
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
	// �������� ������ � ������ � ���� ��� ��������
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
					// ���� ���� �� �������� ������� �� ������������ ������
					// � ���� �������� ����� ���������� � ����������� �����,
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
	// ������� ������
	//   - ���������� ��� ���� ��� �������
	/*-------------------------------------------------------------------------*/

	function email_validate($email = "")
	{
		$email = trim($email);


		$email = preg_replace( "# #is", "", $email );


		//-----------------------------------------
		// ��������� ���� � ���� 2 ��� ������ ������ ������
		//-----------------------------------------

		if ( substr_count( $email, '@' ) > 1 )
		{
			return '';
		}

		// ������������ ��� ���� ������
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
	// ������ ����������������, ������������ � ������� (������)
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
			// ������ ��������������
			$output  .= "<td align=center>";
			if ($row['item_order'] != 1)
			{
				$output .= "<a href='/admin/?action={$act}&act=up&id=".$id."&itemid=".$row['id']."&order=".$row['item_order']."'><img src='/".$this->config['path_admin']."/image/img_up.png' title='�� ������� �����'  border=0></a>";
			}

			if ($row_count-1 != $i)
			{
				$output .= "<a href='/admin/?action={$act}&act=down&id=".$id."&itemid=".$row['id']."&order=".$row['item_order']."'><img src='/".$this->config['path_admin']."/image/img_down.png' title='�� ������� ����' border=0></a>";
			}
			$output .= "</td>";
		}

		return $output;
	}


	/**
	 * ������� ������ ������� ���������� ������
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

			// �������� ������ �������
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

		// ���� ��������� ����� ����������, �� $sort_ids ������ ���� �� ����
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

		// ������� ��������� ����
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
	// ������� ��������� ����������� ������ ���������
	/*---------------------------------------------------------------------------------------------------*/

	function get_list_pages( $row = array(), $root_title = '�������' )
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
	 * ���������� ������ ������������� ������, ����������� ����� �������
	 *
	 * @param unknown_type $id - ������������� �������-����
	 */
	function getChildsOfNodeById($id, $dbTable)
	{
		// ��� ���������� ������� ������� ������ ����������, pid = $id
		$sql = "SELECT * FROM {$dbTable} WHERE pid = '{$id}' ORDER BY item_order";
		if ($this->db->query($sql, $rows) > 0)
		{
			return $rows;        // ���� ����������
		}

		return array();        // ��� ����������
	}


	/*---------------------------------------------------------------------------------------------------*/
	// P���������� ������� ������� ���������
	/*---------------------------------------------------------------------------------------------------*/

	function get_parent_list( $root_id, $out_array = array(), $row = array(), $depth_gide = '' )
	{
		if( is_array( $row[ $root_id ] ) )
		{
			// ����������� �� ����� ���������
			foreach( $row[ $root_id ] as $_ids => $data )
			{
				// ���������� �� ��������� ���� ������ �������� �������������(������������)
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
	 * ������� ��� ������������ ���������� ������������ ������ � ����
	 */
	function _addTreeToMenu( $table = '', $id = '', $is_sheet = 0 )
	{
		if( !$table ) return;

		// ������� ���� � ������� ���� �����, � �������� ������� ��� � �����-� "����������� �������"
		$sql = "select id, table_idnode,timestamp, title, alias from ".TABLE_MITEMS." where table_name = '{$table}' and item_simple = '0'";
		
		$this->db->query($sql, $rows);

		foreach($rows as $row)
		{
			// ����� ������� ��� ������ ���������� ������� ������
			menu_item_del($row['id'], 1  /* ������� ���� ��������� ������� */);
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

				// ���������� ��������� ������ ��� � ������������ ���������
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
		# ������ �������� ���������� � ��������, ������� �� ���� ������� �����������
		#------------------------------------------------------------------------------
		
		if ($id != '')
		{
			# ��� ������� � ����, ������� ���� ������� �� ������� ������
			$sql = "SELECT id FROM ".TABLE_MITEMS." WHERE table_name = '{$table}' AND item_simple = '1' AND table_idnode = '$id'";
			$this->db->query($sql, $rows);
			
			# ���� � ��������� �������
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
	 * ������� ��� �������� ��������� ������ � ��������� ����, ������� � ��������� �������
	 *
	 * @param unknown_type $id                - ������������� ������� � �������
	 * @param unknown_type $pid                - ������������� ���� � ������� ����
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
		
		# ������ ������ ������ ������
		$sql = "select id from se_{$table} where is_active = 1 {$q} and pid='".$id."' order by item_order";

		$this->db->do_query($sql);
		while( $rows = $this->db->fetch_row() )
		{
			$all_[] = $rows;
		}

		foreach( $all_ as $id => $row )
		{
			$this->_MoveToMenuRecurc($row['id'], $pid, $table, $is_sheet);  // ��������� ������������ �����
		}
	}

	/**
	 * ������� ����������� ������ ������ ������ �� ���������� ��������������,
	 * �������� ����� �� ������ �� ����� � �������� ���������� ������ �����
	 *
	 * @param unknown_type $id                - ID �������
	 * @param unknown_type $alias        - ��������� - ����
	 */
	function _getPagePathById($id, &$alias, $table)
	{
		$sql        = "select pid, alias from `se_{$table}` where id='".$id."'";
		$this->db->do_query($sql);

		if ($rows = $this->db->fetch_row()){  // ��������� ������ � ��������� ��������� ���������� �����

			if ($rows['pid'] != '-1')
			{
				$this->_getPagePathById($rows['pid'], $alias, $table);
			}
			$alias        .= $rows['alias']."/";

		}
	}


	/**
	 * ���������� �� moveCatalogToMenu
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

		// ���������� � �������
		if( $table != 'static' )
		{
			$alias = "/{$table}/";
		}
		else
		{
			$alias = "/";
		}

		$this->_getPagePathById($id, $alias, $table);   // ������ ����

		$sql        = "select * from se_{$table} where is_active = 1 {$q} and id='".$id."'";
		$menu        = '';        // �������� ������������� ��� ����

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
			// ��������� ����� ������� � ����
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


		// �������� ������������� ��������� ������ � �������
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

		// �������� ������ �����������
		$sql = "select id from se_{$table} where is_active = 1 {$q} and pid='".$id."' order by item_order";
		$this->db->query($sql, $r);

		foreach($r as $row)
		{
			$this->_MoveToMenuRecurc($row['id'], $pid, $table, $is_sheet);  // ��������� ������������ �����
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
	 * ������� ������ � ������������ �����
	 *
	 */
	function StringToFloat($source)
	{
		// �������� ������� �� �����, ���� �� ���� ������ ������
		$res = str_replace(",", ".", $source);

		// ������� ��� ����� �� ����������� ������, ������ ��� �������
		$res = preg_replace("#[^\.,\d]#", "", $res);

		$res = floatval($res);        // � ����������� �� �������������� ��������� ��� ����� ��� �������

		return $res;
	}

	/*------------------------------------------------------------------*/
	// ������ � �������
	/*------------------------------------------------------------------*/
	/**
	 * ��������� � ��� ������ ������
	 *
	 * @param int      $id
	 * @param string   $type
	 * @param array    $value
	 */
	/*------------------------------------------------------------------*/
	function updateSession( $id = '', $type = 'update', $value = array())
	{
		//-----------------------------------
		// ����� id ������ ������ ���� 32 �������
		//-----------------------------------
		if(!$id or strlen($id) != 32)
		{
			return;
		}

		//-----------------------------------
		// ��� �������� ������ ���� ����� �����������
		//-----------------------------------
		$type = $type == 'update' ? $type : 'delete';

		//-----------------------------------
		// ��������� ������ �� ���������� ������ ���� �� ����
		//-----------------------------------
		if( !count($value) or count($value) < 1 or !is_array($value))
		{
			return;
		}

		//-----------------------------------
		// ���� ������� ������ �� ����������� �� ������������� ��
		//-----------------------------------
		if( !is_array($this->member['session_cache']))
		{
			$this->member['session_cache'] = unserialize($this->member['session_cache']);
		}

		//-----------------------------------
		// ��� ������ ���� ��������
		//-----------------------------------
		if( !is_array($this->member['session_cache']))
		{
			$this->member['session_cache'] = array();
		}

		//-----------------------------------
		// ��������� ������ � ������� ������
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
		// ��������� ������ � ����
		//-----------------------------------
		$this->db->do_update('session', array('session_cache' => serialize($this->member['session_cache'])), "session_id='{$id}'");
	}

	/*------------------------------------------------------------------*/
	// �������� ��������� ������ �� �����
	/*------------------------------------------------------------------*/
	/**
	 * �������� �������� �� ���� ������
	 *
	 * @param int $key
	 * @return mixed
	 */
	/*------------------------------------------------------------------*/
	function getValueSession($key = '')
	{
		$res = array();
		
		//-----------------------------------
		// ���� ���� ���� �� ���������� �������
		//-----------------------------------
		$key = trim($key);
		if( !$key )
		{
			return;
		}

		//-----------------------------------
		// �������, ����� session_cache ��� ��������
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
	 * ���������� ������ ����� � Kb
	 *
	 * @param unknown_type $source - ���� � �����
	 * @return - ������ ����� � Kb
	 */
	function getFileSize($source)
	{
		$res = 0;        // ���������, �������������� ������� ����

		$source = strstr($source, ".") == $source ?  $source : ".".$source;        // ��� ����������� ������� � ����� ����� ������������� ����
		if (file_exists($source))
		{
			$res = filesize($source);
		}

		return round($res / 1024);                // ��������� � ������ ����� 1024 � �������� ���������
	}


	/**
	 * ���������� ������, ������ � ������ ��������� ��������
	 *
	 * @param unknown_type $source        - ���� � ��������
	 * @return unknown                                - ������, ������ � ������ ���������
	 */
	function getWithHeightImage($source)
	{
		$res = array();        // ���������, ������� ������ ������ ������

		$source = strstr($source, ".") == $source ?  $source : ".".$source;        // ��� ����������� ������� � ����� ����� ������������� ����
		if (file_exists($source))
		{
			$res = getimagesize($source);
		}


		return $res;
	}


	/**
	 * ��������� �� ������ ������ �����, ��������� ��� ����������� �����
	 */
	function StringToInt( $value )
	{
		return preg_replace( "#[^\d]*#", "", $value );
	}


	/**
	 * ��������� ������ �����
	 *
	 * @param unknown_type $value	- ��������
	 * @param unknown_type $intval	- ������ �����! ��� ������ � ����� ����� �������� ������
	 */
	function MixedToInt( $value, $intval = false )
	{
		# ��������
		$znak = $value < 0 ? -1 : 1;
		$value = preg_replace( "#^d*#", "", $value ) * $znak;
		$value = (int)$value * $znak;

		if ($intval)
		{
			# �������� ������ ������������� ��������
			$value = intval($value);
		}

		return $value;
	}


	/*------------------------------------------------------------------*/
	// �������� �� ������������ URL
	/*------------------------------------------------------------------*/

	function globalRedirect($url = '', $need_redirect_screen = 0, $need_exit = 1, $seconds = 5)
	{
		if( !$url )
		{
			return;
		}

		//---------------------------------
		// ���������� ����� �� ��� ��� ��������
		//---------------------------------
		header ('HTTP/1.1 301 OK');

		//---------------------------------
		// ��� �� ������� ���� ������� ��������
		//---------------------------------
		header("Location: {$url}");

		if( $need_exit )
		{
			exit();
		}
	}

	function findRootId( $tblname, $parentfield, $curid )
	/** ���� ������, ��� parentfield <= 0
	 * $tblname - ��� ������� ��� ������
	 * $parentfield - ����, ������������ pid
	 * $curid - ������� ������
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
	 * ���������� ����� ������� � �������������
	 *
	 */
	function getmicrotime()
	{
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}
		


	/**
	 * ������ $f1 �� �������� ������ �������, ������ $f2			 *
	 */
	function array_trim ($f1, $f2) {
		$return = array_values(array_diff($f1, explode(" ",$f2)));
		return $return;
	}

		
	/**
	 * �������� ����� � ����� �������� ������
	 *
	 * @param unknown_type $Source			- ��������
	 * @param unknown_type $FileName		- ��� ����� ������ ���������
	 * @param unknown_type $ModuleName		- �������� ������ - � ����� �� ����� ������
	 * @param unknown_type $error			- ����� ������ �������� ��� ����������
	 *
	 * @return unknown - ���� �����, �� ���� �� ���������, ����� ������������ ���������� ����� (� ������ ��������) � ������
	 */
	function uploadFile( $Source, $FileName, $ModuleName, &$error, &$ext = '')
	{
		$error        = "";	// ��������� ������
		 
		$dir		= $this->config['path_files']."/".$ModuleName; // �������, � ������� ����� ��������� ��������
		
		if (!file_exists($dir))
		{		// �������� ��� ���, �� ����� �������
			if (@mkdir($dir))
			{		// ������� �������
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
		
			
		// ���� ����� ����  � �������� ��� ������, �� ���������� ����
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
				$error .= "�� ���������� ��������� ����.";
			}
		}
		else
		{
			$error .= "���������� ������� ������� ��� �������� �����.";
		}
		 
		 
		// ���� ���� ������ ��� ���� �� ����������
		if ($error != "")
		{
			@unlink( $dir .'/'. $filename );
			@unlink( $Source["tmp_name"] );
		}
		 
		return $img;
	}
		
	/**
	 * �������� ���� � ����� �� �����
	 *
	 * @param unknown_type $Source		- ������
	 * @param unknown_type $FileName 	- ��� �����
	 * @param unknown_type $ModuleName	- � ����� �������
	 * @param unknown_type $delAfter	- ������� �������� ���� ����� �������� �����������
	 * @param unknown_type $error		- ��������� �� ������
	 * @return unknown
	 */
	function moveFile($source, $newFileName, $dir, $delAfterCopy = 1, &$error)
	{
		$error        = "";	// ��������� ������
		 
		$dir		= $dir; // �������, � ������� ����� ����������� ����
		if (!file_exists($dir))
		{		// �������� ��� ���, �� ����� �������
			if (@mkdir($dir))
			{		// ������� �������
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
		

		# ���� ������� ��������, �� ��������
		if (file_exists($dir) && is_writable($dir))
		{
				
			if (!@copy( $source, $dir .'/'. $newFileName))
			{
				$error .= "�� ���������� ��������� ����.";
			}
		}
		else
		{
			$error .= "���������� ������� ������� ��� �������� �����.";
		}
		 
		 
		// ���� ���� ������ ��� ���� �� ����������
		if (($error == "") && ($delAfterCopy))
		{
			@unlink( $source );
		}
	}
		
		
	/**
	 *  ���������� ����� � ��������� �����
	 *  $dir   - ���� �������������
	 *  $file  - ����, ������� �������������
	 */
	function UnPackZip($dir, $file){
		include_once($this->config['path_lib'].'/pclzip.lib.php');   // �������� ������ ������ � ��������
			
		$zip = new PclZip($file);  // ������������� ������ PclZip(������ � ��������)
			
		if ($zip->extract($dir, 0755))
		{
			// �� ������, ����� ��������� � �������� ��������, ����� ����������
			// �������� ��������� ������
			unlink($file);
			// ����������� ������
			unset($zip);
			return true;
		}else{
			unset($zip);
			return false;
		}
	}
		
		
	/**
	 * �������� �������� ����� � ����������� ����� �� �������
	 * ���������� 0, ���� ������ ���
	 */
	function uploadModule( $tmpfilename, $filename, $dir, &$error, &$msg, $check_dir = 1) {
		$error        = 0;
		$msg        = '';
		$file = $dir.'/'.$filename;  // ������ ��� ������������ �����
			
		
		
		if(((!file_exists($dir)) && ($check_dir == 1)) || ($check_dir == 0)){  // ���� �������� � ����� ��������� ���
			if ((@mkdir($dir)) || ($check_dir == 0)){  // ������� ��������?
				if (is_writable( $dir )) {        // ����� �� ������ � �������?
					// �������� ���� � �������������� �����
					if (!@move_uploaded_file( $tmpfilename, $dir .'/'. $filename )) {
						$msg = '�� ���� ����������� ��������� ���� � ������� /'.$dir."<br /><font style='color:red'>�������� ����������� ����� �� �������.</font>";
						$error = 4;
					}
				} else {
					$msg = '�������� �������, ��� ��� ������� /'.$dir.' ���������� ��� ������.';
					$error = 3;
				}
			}else{  // ���� �� �� ������� ������� ����� ��� ������
				$msg = "�� ������� ������� ����� ��� ���������������� ������. ��������� ����� ������� � ����� �������.";
				$error = 2;
			}
		}else{  //  ���� ����� � ������� ��� ����������
			$msg = "����� ������ ��� ���������� � �������";
			$error = 1;
		}
			
		if( !@filesize( $dir .'/'. $filename ) and !$error )
		{
			@unlink( $dir .'/'. $filename );
			$msg = "��������� ������� ���� �� �������, ��������, ����������� �����.";
			$error = 1;
		}
			
		return $error;
	}

	/**
	 * ����� ���� ����� � ������
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
	 * ������������� ������ � XML ������
	 *
	 * @param unknown_type $file - ������ ���� � �����, �� ���� ����� ����� ����� ����������
	 * @param unknown_type $xml - ������, � ������� ����� ������� XML
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
	
	#�������� �� �������� 
	
	########################################################################################################################
	########################################################################################################################
	
	
	
	
	/*-------------------------------------------------------------------------*/
	// ������ ���������� ���������� � ����� ��� ����� ����������
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
	 *  ���� ������� dd.mm.yyyy hh:mm �� ���� UNIX-������� $f    (������ ����� getSystemTime)                 *
	 ****************************************************************************/

	function getNormalTime ($f, $format = 'j.m.Y H:i')
	{
		$return = date($format,$f);
		return $return;
	}


	
	/*---------------------------------------------------------*/
	// ��������� ����� (������ ����� getSystemTime)
	/*---------------------------------------------------------*/
	function get_time($timestamp = 0, $format = '')
	{
		if(!$format)  return;
		if(!$timestamp) return;

		$month_lang        = array( 0  => "������",
		1  => "�������",
		2  => "�����",
		3  => "������",
		4  => "���",
		5  => "����",
		6  => "����",
		7  => "�������",
		8  => "��������",
		9 => "�������",
		10 => "������",
		11 => "�������",);

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
# ���������� �������
#--------------------------------------------------------------------------
#--------------------------------------------------------------------------
#--------------------------------------------------------------------------


function pul($mod_name, $pul_name)
{
	global $std;
	return $std->getPul($mod_name, $pul_name);
}

?>