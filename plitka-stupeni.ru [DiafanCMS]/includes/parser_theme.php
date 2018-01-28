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
	include dirname(dirname(__FILE__)).'/includes/404.php';
}

/**
 * Parser_theme
 * 
 * Парсер шаблонных функций
 */
class Parser_theme extends Diafan
{
	/**
	 * @var object подключенный к текущей страницы модуль
	 */
	public $module;

	/**
	 * @var string текущий модуль, для котого вызвана шаблонная функция
	 */
	public $current_module;

	/**
	 * @var object объект с общими шаблонными функциями
	 */
	private $functions;

	/**
	 * Подключает шаблон
	 * 
	 * @return boolean true
	 */
	public function show_theme(&$module)
	{
		$this->functions = new Theme_functions($this);
		$this->module = &$module;

		if (! file_exists(ABSOLUTE_PATH.'themes/'.$this->diafan->theme))
		{
			$this->diafan->theme = 'site.php';
		}
		$site_theme = file_get_contents(ABSOLUTE_PATH.'themes/'.$this->diafan->theme);
		$this->get_function_in_theme($site_theme);
		return true;
	}

	/**
	 * Парсит шаблон
	 * 
	 * @return boolean true
	 */
	public function get_function_in_theme($text)
	{
		$text = preg_replace("/\<\?php([^?]+)\?\>/m", '', $text);

		$text = preg_replace(
			array(
				'/<p>([^<]+)<insert/',
				'/<\/insert>([^<]*)<\/p>/',
				'/<\/insert>/'
			),
			array(
				'<insert',
				'</insert>',
				''
			),
			$text
		);

		$regexp = '/(<insert ([^>]*)>)/im';
		$tokens = preg_split($regexp, $text, -1, PREG_SPLIT_DELIM_CAPTURE);
		$cnt = count($tokens);
		echo $tokens[0];
		$i = 1;
		while ($i < $cnt)
		{
			$i++;
			$att_string 	= $tokens[$i++];
			$data 		= $tokens[$i++];
			$attributes 	= $this->parse_attributes($att_string);
			$this->start_element($attributes);
			echo $data;
		}
		return true;
	}

	/**
	 * Парсит атрибуты шаблонного тэга
	 * 
	 * @return array
	 */
	private function parse_attributes($string)
	{
		$this->diafan->current_insert_tag = '<insert '.$string.'>';
		$entities = array(
			'&lt;' 		=> '<',
			'&gt;' 		=> '>',
			'[' 		=> '<',
			']' 		=> '>',
			'&amp;' 	=> '&',
			'&quot;' 	=> '"',
			'`' 		=> '"'
		);
		
		$attributes = array();
		$match = array();
		preg_match_all('/([a-zA-Z_0-9]+)="((?:\\\.|[^"\\\])*)"/U', $string, $match);
		for ($i = 0; $i < count($match[1]); $i++)
		{
			$attributes[strtolower($match[1][$i])] = strtr((string)$match[2][$i], $entities);
		}
		return $attributes;
	}

	/**
	 * Выполняет действие, заданное в шаблонном тэге: выводит информацию или подключает шаблонную функцию
	 *
	 * @param array атрибуты шаблонного тэга
	 * @return boolean true
	 */
	private function start_element($attributes)
	{
		if (empty($attributes['name']))
		{
			if (! empty($attributes['value'._LANG]))
			{
				echo $attributes['value'._LANG];
			}
			elseif (! empty($attributes['value']))
			{
				echo $attributes['value'];
			}
		}
		else
		{
			$attributes['name'] = preg_replace('/[^a-zA-Z0-9_]/', '', $attributes['name']);
		
			switch($attributes['name'])
			{
				case "path":
					echo BASE_PATH;
				break;
			
				case "path_url":
					echo BASE_PATH_HREF;
				break;
			
				case "language":
					echo _LANG;
				break;
			
				case "title":
					echo TITLE;
				break;
			
				case "module":
					echo $this->diafan->module;
				break;
		
				default:
					$current_module = $this->diafan->current_module;
					if (! empty($attributes['module']))
					{
						$attributes['module'] = preg_replace('/[^a-zA-Z0-9_]/', '', $attributes['module']);
						$mod = ucfirst($attributes['module']);
						
						$this->diafan->current_module = $attributes['module'];

						if ($attributes['module'] == $this->diafan->module)
						{
							if (is_callable(array($this->module, $attributes['name'])))
							{
							    call_user_func_array (array(&$this->module, $attributes['name']), array($attributes));
							}
						}
						else
						{
							if(in_array($attributes['module'], $this->diafan->installed_modules))
							{
								if (file_exists(ABSOLUTE_PATH.'modules/'.$attributes['module'].'/'.$attributes['module'].'.php'))
								{
									Customization::inc('modules/'.$attributes['module'].'/'.$attributes['module'].'.php');
									$module = new $mod($this->diafan, $attributes['module']);
	
									if (is_callable(array($module, $attributes['name'])))
									{
										call_user_func_array (array(&$module, $attributes['name']), array($attributes));
									}
								}
							}
						}
					}
					else
					{
						if (is_callable(array($this->functions, $attributes['name'])))
						{
							$this->diafan->current_module = 'site';
							call_user_func_array (array(&$this->functions, $attributes['name']), array($attributes));
						}
					}
					$this->diafan->current_module = $current_module;
			}
		}
		return true;
	}

	/**
	 * Задает неопределенным атрибутам шаблонного тэга значение по умолчанию
	 * 
	 * @param array $attributes массив определенных атрибутов
	 * @return array
	 */
	public function get_attributes($attributes)
	{
		$a = func_get_args();
		for ($i = 1; $i < count($a); $i++)
		{
			if (is_array($a[$i]))
			{
				$name = $a[$i][0];
				$value = $a[$i][1];
			}
			else
			{
				$name = $a[$i];
				$value = '';
			}
			if (empty($attributes[$name]))
			{
				$attributes[$name] = $value;
			}
		}
		return $attributes;
	}
}