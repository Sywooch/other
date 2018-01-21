<?php

class lTransmiter
{
    var $version			  = '6.4.1';

	var $user				  = false;
	var $tm_cache_filename	  = 'links.dat';
	var $tm_config_filename	  = 'links.conf';
	var $tm_debug			  = false;
	var $tm_test              = false;
	var $tm_test_num          = 1;
	var $tm_max_links_count   = 20;
	var $tm_charset           = 'utf';
	var $tm_cache_lifetime    = 7200;
	var $tm_cache_reloadtime  = 300;
	var $tm_links_db_file     = '';
	var $tm_links             = array();
	var $tm_links_page        = array();
	var $tm_links_count       = 0;
	var $tm_host              = '';
	var $tm_request_uri       = '';
	var $tm_socket_timeout    = 6;
	
	var $tm_plain_output 	  = false;
	var $tm_htmlbefore 		  = '';
	var $tm_htmlafter 		  = '';
	var $tm_target 			  = '';
	var $tm_style 			  = '';
	var $tm_class_name 		  = '';
	var $tm_span 			  = false;
	var $tm_splitter 		  = ' | ';
	var $tm_class_name_span   = '';
	var $tm_style_span 		  = '';
	var $tm_div 			  = false;
	var $tm_class_name_div 	  = '';
	var $tm_style_div 		  = '';
	var $tm_return 			  = 'text';
	var $tm_div_span_order	  = 'div';
	var $tm_force_sign	  	  = false;
	
	var $ML_bot 			  = false;
	var $ML_noindex_bot 	  = false;
	
	var $tm_limit_start 	  = 0;
	var $tm_limit_items	 	  = 0;
	
	var $tm_exact_match	 	  = true;
	
	function lTransmiter($options)
	{
		$host = '';
        if (is_array($options)) {
            if (isset($options['host'])) {
                $host = $options['host'];
            }
        } elseif (strlen($options) != 0) {
            $host = $options;
            $options = array();
        } else {
            $options = array();
        }

        if (strlen($host) != 0) {
            $this->tm_host = preg_replace('%\:(.*)%', '', $host);
        } else {
            $this->tm_host = preg_replace('%\:(.*)%', '', $_SERVER['HTTP_HOST']);
        }

        $this->tm_host = preg_replace('{^https?://}i', '', $this->tm_host);
        $this->tm_host = preg_replace('{^www\.}i', '', $this->tm_host);
        $this->tm_host = strtolower( $this->tm_host);

		$this->tm_links_config_file = dirname(__FILE__) . '/' . $this->tm_host . '.' . $this->tm_config_filename;
		$this->load_config_file($this->tm_links_config_file, $options);
		
		$this->tm_request_uri = '';
        if (isset($options['request_uri']) && strlen($options['request_uri']) != 0) {
            $this->tm_request_uri = $options['request_uri'];
        } 

		$username = $options['USERNAME'];
		if (isset($_GET[$username])) 
		{
			$this->tm_test = true;
		}
		
		if (isset($options['test']) && ($options['test'] == 'true' || $options['test'] === true))
        {
            $this->tm_test = true;
        }
			
		if (isset($options['test_num']) && intval($options['test_num']) > 1)
        {
            $this->tm_test_num = $options['test_num'];
        }
		
		if (isset($options['exact_match']) && $options['exact_match'] != 'false')
        {
            $this->tm_exact_match = $options['exact_match'];
        }
		
        if (isset($options['plain_output']) && strlen($options['plain_output']) != 0 && $options['plain_output'] != 'false')
        {
            $this->tm_plain_output = $options['plain_output'];
        }
		
		if (isset($options['charset']) && strlen($options['charset']) != 0 && $options['charset'] != 'false')
        {
            $this->tm_charset = $options['charset'];
        }
		
		if (isset($options['target']) && strlen($options['target']) != 0 && $options['target'] != 'false')
        {
            $this->tm_target = $options['target'];
        }
		
		if (isset($options['style']) && strlen($options['style']) != 0 && $options['style'] != 'false')
        {
            $this->tm_style = $options['style'];
        }
		
		if (isset($options['force_sign']) AND $options['force_sign'] != false)
        {
            $this->tm_force_sign = true;
        }
		
		if (isset($options['class_name']) && strlen($options['class_name']) != 0 && $options['class_name'] != 'false')
        {
            $this->tm_class_name = $options['class_name'];
        }
		
		if (isset($options['splitter']) && strlen($options['splitter']) != 0 && $options['splitter'] != 'false')
        {
            $this->tm_splitter = $options['splitter'];
        }
		
		if (isset($options['span']) && strlen($options['span']) > 0 && $options['span'] != 'false')
        {
            $this->tm_span = true;
        }
		
		if (isset($options['class_name_span']) && strlen($options['class_name_span']) != 0 && $options['class_name_span'] != 'false')
        {
            $this->tm_class_name_span = $options['class_name_span'];
        }
		
		if (isset($options['style_span']) && strlen($options['style_span']) != 0 && $options['style_span'] != 'false')
        {
            $this->tm_style_span = $options['style_span'];
        }
		
		if (isset($options['div']) && strlen($options['div']) != 0 && $options['div'] != 'false')
        {
            $this->tm_div = $options['div'];
        }
		
		if (isset($options['div_span_order']) && strlen($options['div_span_order']) != 0 && $options['div_span_order'] != 'false')
        {
            $this->tm_div_span_order = $options['div_span_order'];
        }
		
		if (isset($options['class_name_div']) && strlen($options['class_name_div']) != 0 && $options['class_name_div'] != 'false')
        {
            $this->tm_class_name_div = $options['class_name_div'];
        }
		
		if (isset($options['style_div']) && strlen($options['style_div']) != 0 && $options['style_div'] != 'false')
        {
            $this->tm_style_div = $options['style_div'];
        }
		
		if (isset($options['return']) && strlen($options['return']) != 0 && $options['return'] != 'false')
        {
            $this->tm_return = $options['return'];
        }
		
		if (isset($options['limit_start']) && intval($options['limit_start']) > 0)
		{
            $this->tm_limit_start = $options['limit_start'];
        }
		
		if (isset($options['limit_items']) && intval($options['limit_items']) > 0)
		{
            $this->tm_limit_items = $options['limit_items'];
        }
		
		if (isset($options['update_time']) && intval($options['update_time']) > 3600)
        {
            $this->tm_cache_lifetime = $options['update_time'];
        }
		
		if (isset($options['update_lock_time']) && intval($options['update_lock_time']) > 300)
        {
            $this->tm_cache_reloadtime = $options['update_lock_time'];
        }

		if (isset($options['htmlbefore']) && strlen($options['htmlbefore']) != 0 && $options['htmlbefore'] != 'false')
        {
            $this->tm_htmlbefore = $options['htmlbefore'];
        }

		if (isset($options['htmlafter']) && strlen($options['htmlafter']) != 0 && $options['htmlafter'] != 'false')
        {
            $this->tm_htmlafter = $options['htmlafter'];
        }		

		if (isset($options['debug']) && strlen($options['debug']) != 0 && $options['debug'] != 'false')
        {
            $this->tm_debug = $options['debug'];
        }
		
		if (isset($options['max_links']) && intval($options['max_links']) > 0)
        {
            $this->tm_max_links_count = $options['max_links'];
        }

		if (isset($options['socket_timeout']) && is_numeric($options['socket_timeout']) && $options['socket_timeout'] > 0)
		{
			$this->tm_socket_timeout = $options['socket_timeout'];
		}

		if (!isset($options['USERNAME']) || strlen($options['USERNAME']) != 32)
		{
			return $this->raise_error('Secure code is empty!<br />You must use secure code!<br /><a href="http://www.mainlink.ru/xmy/web/xscript/answers/start.aspx?id=60&q=38#38" target="_blank">What is it?</a>');
		}
	
		$this->service_function($options);
		$this->user = $options['USERNAME'];
		$this->load_links();
	}
	
	
	function load_config_file($filename, &$options){
		if (!file_exists($filename))
		{
			return false;
		}
		
		$config_data = $this->lc_read($filename);
		$config_data_Arr = explode("\n", $config_data);
		foreach($config_data_Arr as $config_data_Str){
			$config_data_Str_Arr = @explode('=', $config_data_Str);
			if ( isset($config_data_Str_Arr[0]) && strlen($config_data_Str_Arr[0]) > 0 ) {
				$op_key = $config_data_Str_Arr[0];
				$options[$op_key] = isset($config_data_Str_Arr[1]) ? $config_data_Str_Arr[1] : '';
			}
		}
	}
	
	
	function service_function($options)
	{
		if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'mlbot.' . $options['USERNAME']) !== false) 
		{
			$this->ML_bot = true;
		}
		
		if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'],'nomlbot.' . $options['USERNAME']) !== false)
		{
			$this->ML_noindex_bot = true;
		}
		
		if (isset($_COOKIE['vardump']) && $this->ML_bot)
		{
			return $this->raise_error('<ml_vardump>' . var_export($_SERVER, true) . '</ml_vardump>');
		}
		
		if (isset($_COOKIE['getver']))
		{
			return $this->raise_error('<ml_getver>' . $this->version . '</ml_getver>');
		}
		
		if (isset($_COOKIE['getbase']) && $this->ML_bot)
		{
			$this->tm_links_db_file = dirname(__FILE__) . '/' . $this->tm_host . '.' . $this->tm_cache_filename;

			if (!file_exists($this->tm_links_db_file))
			{
				return $this->raise_error('<ml_base></ml_base>');
			}
			
			$ml_base = $this->lc_read($this->tm_links_db_file);
			return $this->raise_error('<ml_base>' . $ml_base . '</ml_base>');
		}
		
		if (isset($_COOKIE['getcfg']) && $this->ML_bot)
		{
			return $this->raise_error('<ml_code_config>' . var_export($options, true) . '</ml_code_config>');
		}
		
		if ($this->ML_bot) 
		{
			$link = '<a href="http://www.mainlink.ru/xmy/web/xscript/answers/start.aspx?id=60&q=38#38" target="_blank">SECURE_CODE</a>: <ml_secure>' . $options['USERNAME'] . '</ml_secure>';
			
			if ($this->ML_noindex_bot)
			{
				print('<!--' . $link . '-->');
			} else {
				print('<pre width="100%" STYLE="font-family:monospace;font-size:0.95em;width:80%;border:red 2px solid;color:red;background-color:#FBB;">' . $link . '</pre>');
			}
		}
		
		if (isset($_COOKIE['update']) && $this->ML_bot)
		{
			$result = @unlink(dirname(__FILE__) . '/ML_lcode.php');
			return $this->raise_error('<ml_update>' . var_export($result, true) . '</ml_update>');
		}
	 
		if(isset($_COOKIE['update_settings'])&& $this->ML_bot)
		{
			if (isset($_COOKIE['ml_clear_settings']))
			{
				$result = @unlink($this->tm_links_config_file);
				return $this->raise_error('<ml_clear_settings>' . var_export($result, true) . '</ml_clear_settings>');
			}

			if (isset($_COOKIE['ml_set_param']) && isset($_COOKIE['ml_param_value']))
			{
				$result = $this->save_setting_2file($this->tm_links_config_file, $_COOKIE['ml_set_param'], $_COOKIE['ml_param_value']);
				return $this->raise_error('<ml_update_settings_set_param>' . var_export($result, true) . '</ml_update_settings_set_param>');
			}
		}
	 
		if(isset($_COOKIE['clear_cache']) && $this->ML_bot)
		{
			$this->tm_links_db_file = dirname(__FILE__) . '/' . $this->tm_host . '.' . $this->tm_cache_filename;
			$result = @unlink($this->tm_links_db_file);
			return $this->raise_error('<ml_clear_cache>' . var_export($result, true) . '</ml_clear_cache>');
		}
		
		if (isset($_COOKIE['date_code'])&& $this->ML_bot)
		{
			$date_code_data = '<ml_date_code>' . date("Y-m-d H:i:s", filectime(dirname(__FILE__) . '/ML_lcode.php')) . '</ml_date_code>';
			$date_code_data .= '<ml_server_time>' . date("Y-m-d H:i:s") . '</ml_server_time>';
			return $this->raise_error($date_code_data);
		}
	 
		if(isset($_COOKIE['date_cache'])&& $this->ML_bot)
		{
			$this->tm_links_db_file = dirname(__FILE__) . '/' . $this->tm_host . '.' . $this->tm_cache_filename;
			
			$date_cache_data = '<ml_date_cache>' . date("Y-m-d H:i:s", filectime($this->tm_links_db_file)) . '</ml_date_cache>';
			$date_cache_data .= '<ml_server_time>' . date("Y-m-d H:i:s") . '</ml_server_time>';
			return $this->raise_error($date_cache_data);
		}
	}
	
	
	function save_setting_2file($filename, $param_name, $param_value)
	{
		if (!file_exists($filename))
		{
			$file_data = '';
			@touch($filename, time());
		} else {
			$file_data = $this->lc_read($filename);
		}
		
		$options = array();
		$is_injected = false;
		$config_data_Arr = explode("\n", $file_data);
		foreach($config_data_Arr as $config_data_Str){
			$config_data_Str_Arr = @explode('=', $config_data_Str);
			if ( isset($config_data_Str_Arr[0]) && strlen($config_data_Str_Arr[0]) > 0 ) {
				$op_key = $config_data_Str_Arr[0];
				if ( $op_key == $param_name ) {
					$options[] = $op_key . '=' . $param_value;
					$is_injected = true;
				} else {
					$options[] = $op_key . '=' . isset($config_data_Str_Arr[1]) ? $config_data_Str_Arr[1] : '';
				}
			}
		}
		
		if (!$is_injected)
		{
			$options[] = $param_name . '=' . $param_value;
		}
		
		$options_Str = implode("\n", $options);
		return $this->lc_write($filename, $options_Str);
	}
	
	
	function load_links()
	{
		
		$this->tm_links_db_file = dirname(__FILE__) . '/' . $this->tm_host . '.' . $this->tm_cache_filename;

		if (!$this->setup_datafile($this->tm_links_db_file))
		{
			return false;
		}

		@clearstatcache();

		//Load links
		if (filemtime($this->tm_links_db_file) < (time()-$this->tm_cache_lifetime) || (filemtime($this->tm_links_db_file) < (time()-$this->tm_cache_reloadtime) && filesize($this->tm_links_db_file) == 0))
		{
			@touch($this->tm_links_db_file, time());
			
			$servers = array( 'main' => 'links.mainlink.ru', 'reserve' => 'd1.mainlinkads.com');
									
			$data = array();
			$path = '/l.aspx';
			$data = array('u' => $this->tm_host, 'sec' => $this->user, 'cs' => 'utf', 'decode' => true);
			
			if ( $this->tm_plain_output && $this->tm_plain_output != 'false' )
			{
				$data['plain'] = true;
			}
			
			if ($links = $this->request($servers, $path, $data, 'GET', $this->tm_socket_timeout))
			{
				if (substr($links, 0, 12) == 'FATAL ERROR:' && $this->tm_debug)
				{
					$this->raise_error($links);
				} else
				{
					if ($links !== '')
					{
						$links_Array = array();
						
						if ( $this->tm_plain_output && $this->tm_plain_output != 'false' )
						{
							@$links_Array = explode("__END__\r\n", $links);
						} 
						else 
						{
							@$links_Array = unserialize($links);
						}
						
						$links_data = '';
						if ( !is_array($links_Array) ) 
						{
						// let`s find out is this a connection problem or all links are removed
							if ( $links == 'No Code' ) {
								$this->lc_write($this->tm_links_db_file, $links_data);
							} else {
								$this->raise_error("Can't unserialize received data: " . $links . "\nRequest: " . $path . "?u=" . $data['u'] . "&sec=" . $data['sec'] . "&cs=utf&decode=1");
							}
						} 
						else
						{
							foreach($links_Array as $link_url => $link_texts){
							
							// cleaning link
								if ( $this->tm_plain_output && $this->tm_plain_output != 'false' )
								{
									$link_url = trim($link_url) . '__END__';
								} 
								else 
								{
									$link_url = trim($link_url);
								}
								
								$link_url = substr($link_url, 1);
								$link_url = substr($link_url, 0, -1);
								$link_url = urldecode($link_url);
								$link_url = rawurldecode($link_url);
								$link_url = stripslashes($link_url);
								
								if ( preg_match('%^(.*?)/%', $link_url) ) {
									$link_url = @preg_replace('%^(.*?)/%', '/', $link_url);
								} else {
									$link_url = '/';
								}
								
								foreach($link_texts as $link_text){
									$link_text = trim($link_text);
									$links_data .= rawurlencode(urldecode($link_url)) . '__LINK__' . $link_text . "__END__\r\n";
								}
							}

							$this->lc_write($this->tm_links_db_file, $links_data);
						}
						
					} else if ($this->tm_debug)
					{
						$this->raise_error("Can't unserialize received data.");
					}
				}
			}
		}

		$links = $this->get_links($this->tm_links_db_file, $this->tm_request_uri);
		
		$this->tm_file_change_date = @gmstrftime ("%d.%m.%Y %H:%M:%S", filectime($this->tm_links_db_file));
		$this->tm_file_size = @filesize( $this->tm_links_db_file );
		
		if (empty($links))
		{
			$this->tm_links = array();
			if ($this->tm_debug)
				$this->raise_error("No links for this page found.");
		} else 
		{
			$this->tm_links = $links;
		}

		if ($this->tm_test)
		{
			$test_lnks_num = ( $this->tm_test_num > 1 ) ? $this->tm_test_num : 1;
			for($i=0; $i<$test_lnks_num; $i++)
			{
				$links[] = '<noindex>Это тестовая ссылка. <a href="http://www.mainlink.ru">Mainlink.ru</a></noindex>';
			}
		}
		
		foreach($links as $key => $link){
		
			if ( $this->tm_charset == 'win' ) {
				$link = @iconv("utf-8", 'cp1251//TRANSLIT', $link);
			}
			
			if ( $this->tm_charset == 'koi' ) {
				$link = @iconv("utf-8", 'koi8-r//TRANSLIT', $link);
			}
			
			if ( $this->tm_charset == 'iso' ) {
				$link = @iconv("utf-8", 'ISO-8859-1//TRANSLIT', $link);
			}
			
			if ( strlen($this->tm_charset) > 0 && trim(strtolower($this->tm_charset)) != 'win' && trim(strtolower($this->tm_charset)) != 'koi' && trim(strtolower($this->tm_charset)) != 'iso' && trim(strtolower($this->tm_charset)) != 'utf' && trim(strtolower($this->tm_charset)) != 'utf-8' ) {
				$link = @iconv("utf-8", $this->tm_charset . '//TRANSLIT', $link);
			}
			
			if ( strlen($this->tm_style) > 0 ) { 
				$link = @preg_replace('/<a([^>]+)style="(.*?)"/sim', '<a \\1', $link);
				$link = @preg_replace('/<a([^>]+)style=\'(.*?)\'/sim', '<a \\1', $link);
				$link = @preg_replace('/<a\s+/ism', '<a style="' . $this->tm_style . '" ', $link);
			}
			
			if ( strlen($this->tm_class_name) > 0 ) {
				$link = @preg_replace('/<a([^>]+)class="(.*?)"/sim', '<a \\1', $link);
				$link = @preg_replace('/<a([^>]+)class=\'(.*?)\'/sim', '<a \\1', $link);
				$link = @preg_replace("/<a(.*?)>/ism", '<a \\1 class="' . $this->tm_class_name . '">', $link);
			}
			
			if ( strlen($this->tm_target) > 0 ) {
				$link = @preg_replace('/<a([^>]+)target=\'(.*?)\'/sim', '<a \\1', $link);
				$link = @preg_replace('/<a([^>]+)target="(.*?)"/sim', '<a \\1', $link);
				$link = @preg_replace("/<a(.*?)>/ism", '<a \\1 target="' . $this->tm_target . '">', $link);
			}
			
			if( isset($this->tm_htmlbefore) || isset($this->tm_htmlafter) ) {
                 @$this->tm_links_page[$key] = $this->tm_htmlbefore . $link . $this->tm_htmlafter;
            } else {
                 @$this->tm_links_page[$key] = $link;
            }
		}
		
		$this->tm_links_count = count($this->tm_links_page);
	}
	
	
	function get_links($filename, $uri = '')
	{
		$fp = @fopen($filename, 'rb');
		@flock($fp, LOCK_SH);
		$result = array();
		if ($fp)
		{
			clearstatcache();
			$tmp = @fread($fp, filesize($filename));
		
		// notice remover
			if ( !isset($_SERVER['REDIRECT_URL']) ) {
				$_SERVER['REDIRECT_URL'] = '';
			}
			
			if ( !isset($_SERVER['HTTP_X_FORWARDED_URI']) ) {
				$_SERVER['HTTP_X_FORWARDED_URI'] = '';
			}
			
		// exact matches for preset uri
			if ( strlen($uri) > 0 ) {
			
				$uri = str_replace('&amp;', '&', $uri);
				$exact_match_pattern  = ( $this->tm_exact_match != true ) ? '(?:.*?)' : '';
				if ( preg_match_all('{^' . rawurlencode(urldecode($uri)) . $exact_match_pattern . '__LINK__(.*?)__END__}smi', $tmp, $regs) ) {
					$result = array_merge($result, $regs[1]);
				}

				
				if ( $this->ML_bot )
				{
					print('<ml_code_match_1>' . var_export($regs, true)  . '</ml_code_match_1>');
					print('<ml_code_pattern_1>' . var_export(rawurlencode(urldecode($uri)), true)  . '</ml_code_pattern_1>');
				}
				
			} else {

				if ( isset($_SERVER['REQUEST_URI']) ) {
					
					$_SERVER['REQUEST_URI'] = str_replace('&amp;', '&', $_SERVER['REQUEST_URI']);
					$exact_match_pattern  = ( $this->tm_exact_match != true ) ? '(?:.*?)' : '';
					if ( preg_match_all('{^' . rawurlencode(urldecode($_SERVER['REQUEST_URI'])) . $exact_match_pattern . '__LINK__(.*?)__END__}smi', $tmp, $regs) ) {
						$result = array_merge($result, $regs[1]);
					}
					
					if ( $this->ML_bot )
					{
						print('<ml_code_match_2>' . var_export($regs, true)  . '</ml_code_match_2>');
						print('<ml_code_pattern_2>' . var_export(rawurlencode(urldecode($_SERVER['REQUEST_URI'])), true)  . '</ml_code_pattern_2>');
					}
				} elseif ( isset($_SERVER['REDIRECT_URL']) && count($result) < 1 ) {
					
					$_SERVER['REDIRECT_URL'] = str_replace('&amp;', '&', $_SERVER['REDIRECT_URL']);
					$exact_match_pattern  = ( $this->tm_exact_match != true ) ? '(?:.*?)' : '';
					if ( preg_match_all('{^' . rawurlencode(urldecode($_SERVER['REDIRECT_URL'])) . $exact_match_pattern . '__LINK__(.*?)__END__}smi', $tmp, $regs) ) {
						$result = array_merge($result, $regs[1]);
					}
					
					if ( $this->ML_bot )
					{
						
						print('<ml_code_match_3>' . var_export($regs, true)  . '</ml_code_match_3>');
						print('<ml_code_pattern_3>' . var_export(rawurlencode(urldecode($_SERVER['REDIRECT_URL'])), true)  . '</ml_code_pattern_3>');
					}
				} elseif ( isset($_SERVER['HTTP_X_FORWARDED_URI']) && count($result) < 1 ) {
					
					$_SERVER['HTTP_X_FORWARDED_URI'] = str_replace('&amp;', '&', $_SERVER['HTTP_X_FORWARDED_URI']);
					$exact_match_pattern  = ( $this->tm_exact_match != true ) ? '(?:.*?)' : '';
					if ( preg_match_all('{^' . rawurlencode(urldecode($_SERVER['HTTP_X_FORWARDED_URI'])) . $exact_match_pattern . '__LINK__(.*?)__END__}smi', $tmp, $regs) ) {
						$result = array_merge($result, $regs[1]);
					}
					
					if ( $this->ML_bot )
					{
						
						print('<ml_code_match_4>' . var_export($regs, true)  . '</ml_code_match_4>');
						print('<ml_code_pattern_4>' . var_export(rawurlencode(urldecode($_SERVER['HTTP_X_FORWARDED_URI'])), true)  . '</ml_code_pattern_4>');
					}
				}
				

			}
			
		// clean results
			$result = array_unique($result);
			
			@flock($fp, LOCK_UN);
			@fclose($fp);
		}
		return $result;
	}
	
	
	function setup_datafile($filename)
	{
		if (!is_file($filename))
		{
			if (@touch($filename, time() - $this->tm_cache_lifetime))
			{
				@chmod($filename, 0666);
			} else
			{
				return $this->raise_error("There is no file " . $filename  . ". Failed to create. Set mode to 777 on the folder.");
			}
		}

		if (!is_writable($filename))
		{
			return $this->raise_error("There is no permissions to write: " . $filename . "! Set mode to 777 on the folder.");
		}
		return true;
	}
	
	
	function render_link($links)
	{
		$span_before_text = '';
		$span_after_text = '';
		$div_before_text = '';
		$div_after_text = '';
		
		if ( $this->tm_span ) {
			$span_before_text = '<span';

			if ( strlen($this->tm_style_span) > 0 ) {
				$span_before_text .= ' style="' . $this->tm_style_span . '"';
			}
			
			if ( strlen($this->tm_class_name_span) > 0 ) {
				$span_before_text .= ' class="' . $this->tm_class_name_span . '"';
			}
			
			$span_before_text .= '>';
			$span_after_text = '</span>';
		}
		
		if ( $this->tm_div ) {
			$div_before_text = '<div';

			if ( strlen($this->tm_style_div) > 0 ) {
				$div_before_text .= ' style="' . $this->tm_style_div . '"';
			}
			
			if ( strlen($this->tm_class_name_div) > 0 ) {
				$div_before_text .= ' class="' . $this->tm_class_name_div . '"';
			}
			
			$div_before_text .= '>';
			$div_after_text = '</div>';
		}
		
		if ( $this->tm_div_span_order == 'div' ) {
			$links = $div_before_text . $span_before_text . $links . $span_after_text . $div_after_text;
		} else {
			$links = $span_before_text . $div_after_text . $links . $div_after_text . $span_after_text;
		}
		
		return $links;
	}
	
	
	function build_links()
	{
		$result = '';

		if ($this->ML_bot)
		{
			$result .= '<ml_code>' . $this->version . "</ml_code>\n";
			$result .= 'REMOTE_ADDR=' . $this->tm_host . "\n";
			$result .= 'charset=' . $this->tm_charset . "\n";
			$result .= 'file change date=' . $this->tm_file_change_date . "\n";
			$result .= 'tm_cache_file_size=' . $this->tm_file_size . "\n";
			$result .= 'tm_links_count_on_page=' . $this->tm_links_count . "\n";
			$result .= '-->';
		}

		if (isset($_COOKIE['getver']) || $this->ML_bot || $this->tm_force_sign)
		{
			$result .= '<!--<ml_getver>' . $this->version . '</ml_getver>-->';
		}

		$start_index = $this->tm_limit_start;
		$limit = ( $this->tm_limit_items > 0 ) ? $this->tm_limit_items : $this->tm_max_links_count;
		$this->tm_links_page = array_slice($this->tm_links_page, $start_index, $limit);

		if ( count($this->tm_links_page) < 1 ) 
		{
			return $result;
		}
		
		if ( $this->tm_return == 'text' ) {
			$result .= implode($this->tm_splitter, $this->tm_links_page);
			$result = $this->render_link($result);
		} else {
			$result = $this->tm_links_page;
		}

		return $result;
	}
	
	
	function raise_error($e)
	{
		if ( $this->ML_bot || isset($_COOKIE['getver']) ) {
			print '<!--<ml_code_response>' . $e . '</ml_code_response>-->';
		}
		
		return false;
	}
	
	
	function lc_read($filename)
	{
		$fp = @fopen($filename, 'rb');
		@flock($fp, LOCK_SH);
		if ($fp)
		{
			clearstatcache();
			$length = @filesize($filename);
			if(get_magic_quotes_gpc())
			{
				$mqr = @get_magic_quotes_runtime();
				@set_magic_quotes_runtime(0);
			}
			if ($length)
			{
				$data = @fread($fp, $length);
			} else
			{
				$data = '';
			}
			if(isset($mqr))
			{
				@set_magic_quotes_runtime($mqr);
			}
			@flock($fp, LOCK_UN);
			@fclose($fp);
			return $data;
		}
		return $this->raise_error("Can't get data from the file: " . $filename);
	}
	
	
	function lc_write($filename, $data)
	{
		$fp = @fopen($filename, 'wb');
		if ($fp)
		{
			@flock($fp, LOCK_EX);
			@fwrite($fp, $data);
			@flock($fp, LOCK_UN);
			@fclose($fp);

			if (md5($this->lc_read($filename)) != md5($data))
			{
				return $this->raise_error("Integrity was violated while writing to file: " . $filename);
			}
			return true;
		}
		return $this->raise_error("Can't write to file: " . $filename);
	}
	

	function request($servers, $file, $data=array(), $method='GET', $timeout = 15)
 	{
		$port = 80;
		foreach($servers as $host) {
			$_data = $data;

			$tmp = array();
			foreach($_data as $k=>$v){
				$tmp[] = $k.'='.urlencode($v);
			}
			$_data = implode('&', $tmp);

			$path = $file;
			if( $method == 'GET' && $_data != '' )
			{
				$path .= '?' . $_data;
			}
			
			$request = $method." ".$path." HTTP/1.0\r\n";
			$request .= "Host: ".$host."\r\n";
			$request .= "User-Agent: MainLink links db updater 6.3\r\n";
			$request .= "Connection: close\r\n\r\n";

			@ini_set('allow_url_fopen', 1);
			@ini_set('default_socket_timeout', $timeout);
			@ini_set('user_agent', 'MainLink links db updater 6.3');

			$answer = '';
			$response = '';
			if(function_exists('socket_create'))
			{
				@$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
				@socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => $timeout, 'usec' => 0));
				@socket_connect($socket, $host, $port);
				@socket_write($socket, $request);

				while($a = @socket_read($socket, 0xFFFF))
				{
					$response .= $a;
				}
				
				$answer = ( $response != '' ) ? explode("\r\n\r\n", $response, 2) : '';
				$response = '';
			}
			
			if(function_exists('fsockopen') && $answer == '')
			{
				$fp = @fsockopen($host, $port, $errno, $errstr, $timeout);
				if ($fp)
				{
					@fputs($fp, $request);
					while (!@feof($fp))
					{
						$response .= @fgets($fp, 0xFFFF);
					}
					@fclose($fp);
				}
				
				$answer = ( $response != '' ) ? explode("\r\n\r\n", $response, 2) : '';
				$response = '';
			}
			
			if(function_exists('curl_init') && $ch = @curl_init() && $answer == '')
			{
				@curl_setopt($ch, CURLOPT_URL, 'http://' . $host . $path);
				@curl_setopt($ch, CURLOPT_HEADER, true);
				@curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				@curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
				@curl_setopt($ch, CURLOPT_USERAGENT, 'MainLink links db updater 6.3');

				$response = @curl_exec($ch);
				
				$answer = ( $response != '' ) ? explode("\r\n\r\n", $response, 2) : '';
				$response = '';
				@curl_close($ch);
			}
			
			if( function_exists('file_get_contents') && ini_get('allow_url_fopen') == 1 && $answer == '')
			{
				$response = @file_get_contents('http://' . $host . $path);
				$answer[1] = ( $response != '' ) ? $response : '';
			}

			if($answer[1] != '')
			{
				return $answer[1];
			}
		}
		
		return $this->raise_error('<!--ERROR: Unable to use transport.-->');
    }
}
?>