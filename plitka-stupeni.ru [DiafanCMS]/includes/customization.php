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
	include dirname(dirname(__FILE__)).'/includes/404.php';
}

/**
 * Customization
 *
 * Класс для внедрения пользовательских разработок
 */
class Customization
{
	/**
	 * Подключает пользовательский код
	 *
	 * @return boolean
	 */
	public static function inc($path_to_file)
	{
		$path_to_custom_file = preg_replace('/\.php$/', '.custom.php', $path_to_file);
		if(file_exists(ABSOLUTE_PATH.$path_to_custom_file))
		{
			$cache_name = md5($path_to_file).".php";
			if (MOD_DEVELOPER || ! file_exists(ABSOLUTE_PATH."cache/50a04ed5229b48c39039e72dbedb84fc/".$cache_name))
			{
				if (! is_dir(ABSOLUTE_PATH."cache/50a04ed5229b48c39039e72dbedb84fc"))
				{
					if(! mkdir(ABSOLUTE_PATH."cache/50a04ed5229b48c39039e72dbedb84fc", 0777))
					{
						throw new Exception('Невозможно создать папку '.ABSOLUTE_PATH.'cache/50a04ed5229b48c39039e72dbedb84fc. Установите права на запись (777) для папки '.ABSOLUTE_PATH.'cache.');
					}
				}
				$code = "<?php \n if (!defined('DIAFAN')){include dirname(dirname(__FILE__)).'/includes/404.php';}\n";
				
				$c = self::parse($path_to_file);
				$c_custom = self::parse($path_to_custom_file);
				
				foreach($c as $class => $array)
				{
					$code .= ' '.$array['pre'].'class '.$class.' {';

					// добавляет свойства класса
					foreach($array['vars'] as $name => $var)
					{
						if(! empty($c_custom[$class]['vars'][$name]))
						{
							switch($c_custom[$class]['vars'][$name]['action'])
							{
								case 'replace':
									$var = $c_custom[$class]['vars'][$name];
									break;
							}
						}
						$code .= "\n".$var['pre'].' $'.$name.($var['val'] ? '='.$var['val'] : '').';';
					}
					if(! empty($c_custom[$class]))
					{
						foreach($c_custom[$class]['vars'] as $name => $var)
						{
							if($var['action'] == 'new')
							{
								$code .= "\n".$var['pre'].' $'.$name.($var['val'] ? '='.$var['val'] : '').';';
							}
						}
					}

					// добавляет функции
					foreach($array['functions'] as $name => $function)
					{
						if(! empty($c_custom[$class]['functions'][$name]))
						{
							switch($c_custom[$class]['functions'][$name]['action'])
							{
								case 'replace':
									$function = $c_custom[$class]['functions'][$name];
									break;
								case 'before':
									$function['code'] = $c_custom[$class]['functions'][$name]['code'].$function['code'];
									break;
								case 'after':
									$function['code'] = $function['code'].$c_custom[$class]['functions'][$name]['code'];
									break;
							}
						}
						$code .= "\n".$function['pre'].' function '.$name.'('.$function['args'].'){'.$function['code'].'}';
					}
					if(! empty($c_custom[$class]))
					{
						foreach($c_custom[$class]['functions'] as $name => $function)
						{
							if($function['action'] == 'new')
							{
								$code .= "\n".$function['pre'].' function '.$name.'('.$function['args'].'){'.$function['code'].'}';
							}
						}
					}
					$code .= "} \n";
				}

				if(! $fp = fopen(ABSOLUTE_PATH."cache/50a04ed5229b48c39039e72dbedb84fc/".$cache_name, "w"))
				{
					throw new Exception('Невозможно записать файл '.ABSOLUTE_PATH.'cache/50a04ed5229b48c39039e72dbedb84fc/'.$cache_name.'. Установите права на запись (777) для на папку '.ABSOLUTE_PATH.'cache/50a04ed5229b48c39039e72dbedb84fc и для файла '.ABSOLUTE_PATH.'cache/50a04ed5229b48c39039e72dbedb84fc/'.$cache_name.'.');
				}
				fwrite($fp, $code);
				fclose($fp);
			}
			include_once ABSOLUTE_PATH."cache/50a04ed5229b48c39039e72dbedb84fc/".$cache_name;
		}
		else
		{
			include_once (ABSOLUTE_PATH.$path_to_file);
		}
		return true;
	}
	
	/**
	 * Парсит PHP-файл
	 *
	 * @param string $path_to_file путь до файла
	 * @return array массив классов и фунций, описанных в файле
	 */
	private static function parse($path_to_file)
	{
		$code = file_get_contents(ABSOLUTE_PATH.$path_to_file);
		$code_array = self::parse_class($code);
		return $code_array;
	}
	
	/**
	 * Парсит исходный PHP-code, получает классы и функции
	 *
	 * @param string $code исходный PHP-код
	 * @return array
	 */
	private static function parse_class($code)
	{
		$code_array = array();
		$funcs = array();
		if(preg_match('/(abstract )*class ([^\{]+)\{([.\s\S]*?)\}([^\}])*class ([^\{]+)\{([.\s\S]+)/', $code, $matche))
		{
			$code_array = self::parse_class($matche[4].'class '.$matche[5].'{'.$matche[6]);

			$vars = self::parse_var($matche[3]);
			list($code_function, $funcs) = self::parse_function($matche[3]);
			$code_array[trim($matche[2])] = array('pre' => $matche[1], 'functions' => $funcs, 'vars' => $vars);
		}
		elseif(preg_match('/(abstract )*class ([^\{]+)\{([.\s\S]+)\}/', $code, $matche))
		{
			$vars = self::parse_var($matche[3]);
			list($code_function, $funcs) = self::parse_function($matche[3]);
			$code_array[trim($matche[2])] = array('pre' => $matche[1], 'functions' => $funcs, 'vars' => $vars);
		}
		return $code_array;
	}
	
	/**
	 * Парсит исходный PHP-code, получает свойства класса
	 *
	 * @param string $code исходный PHP-код
	 * @return array
	 */
	private static function parse_var($code)
	{
		$vars = array();
		$code = self::find_function($code);
		if(preg_match_all('/(replace|new)*( )*(public|private|protected|var)*( )*(static)*( )*\$([^;=]+)(=)*([^;]+)*;/m', $code, $matche))
		{
			foreach($matche[1] as $i => $m)
			{
				$name = $matche[7][$i];
				$value = $matche[9][$i];
				if(strpos($name, '=') !== false && ! $value)
				{
					list($name, $value) = explode('=', $name);
				}
				$vars[$name] = array(
					'action' => $matche[1][$i],
					'pre' => $matche[3][$i].$matche[4][$i].$matche[5][$i],
					'name' => trim($name),
					'val' => trim($value)
					);
			}
		}
		return $vars;
	
	}
	
	static private function find_function($code)
	{
		if(preg_match('/parse_var_new_class([.\s\S]*?)function([.\s\S]*)$/m', 'parse_var_new_class'.$code, $matche))
		{
			if(substr($matche[1], -1) == "'")
			{
				$code = $matche[1].'function'.self::find_function($matche[2]);
			}
			else
			{
				$code = $matche[1];
			}
		}
		return $code;
	}
	
	/**
	 * Парсит исходный PHP-code, получает функции
	 *
	 * @param string $code исходный PHP-код
	 * @return array
	 */
	private static function parse_function($code)
	{
		$funcs = array();
		if(preg_match('/(replace|before|after|new)*( )*(public|private|protected)*( )*(static)*( )*function ([a-zA-Z0-9\_ ]+)\(([^\(]*)\)([^\{]*)\{([.\s\S]+)*/', $code, $matche))
		{
			list($code_function, $funcs) = self::parse_function($matche[10]);
			if(preg_match('/^([.\s\S]+)\}/', $code_function, $m))
			{
				$code_function = $m[1];
			}
			$funcs[trim($matche[7])] = array(
				'action' => $matche[1],
				'pre' => $matche[3].$matche[4].$matche[5],
				'args' => trim($matche[8]),
				'code' => $code_function
				);
			$other_code = str_replace($matche[0], '', $code);
			return array($other_code, $funcs);
		}
		else
		{
			return array($code, $funcs);
		}
	}
}