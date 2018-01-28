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
	include dirname(dirname(__FILE__)) . 'includes/404.php';
}

/**
 * Dev
 *
 * Класс для работы в режиме разработки
 */
class Dev
{
	private $debug;
	static public $errors = array ();

	/**
	 * @var boolean работа скрипта завершилась с ошибкой
	 */
	static public $is_error = false;

	/**
	 * @var integer время начала работы скриптов
	 */
	private static $timestart;

	public function __construct()
	{
		// регистрация ошибок
		set_error_handler(array ( $this, 'other_error_catcher' ));

		// перехват критических ошибок
		register_shutdown_function(array ( $this, 'fatal_error_catcher' ));

		Customization::inc('includes/gzip.php');
		Gzip::init_gzip();
	}

	/**
	 * Разрешает/запрещает вывод ошибок
	 *
	 * @return void
	 */
	public function set_error()
	{
		ini_set('display_errors', 'on');
		error_reporting(E_ALL | E_STRICT);

		if (function_exists("xdebug_disable"))
		{
			xdebug_disable();
		}
		$this->register_backtrace();
	}

	public function other_error_catcher($errno, $type)
	{
		$backtrace = debug_backtrace();

		if (isset( $backtrace[0]['file'] ) && isset( $backtrace[0]['line'] ))
		{
			$errno = $backtrace[0]['file'] . ':' . $backtrace[0]['line'];
		}
		if(strpos($type, 'unable to connect to') !== false || strpos($type, 'php_network_getaddresses') !== false)
		{
			return true;
		}
		
		if($string = $this->backtrace_to_string($backtrace))
		{
			if(! MOD_DEVELOPER)
				return true;

			self::$errors[] = array($errno, $type, $string);

			$c = count(self::$errors);
			echo '<a href="#error'.$c.'" style="color:red">[ERROR#'.$c.']</a>';
		}
		return true;
	}

	public function fatal_error_catcher()
	{
		$error = error_get_last();

		if (isset( $error ) && ( $error['type'] & ( E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR ) ))
		{
			self::$is_error = true;
			header("HTTP/1.0 500 Internal Server Error");

			$result = array (
				'title' => "Fatal Error",
				'error' => str_replace(ABSOLUTE_PATH, '', $error)
			);
			$this->template($result);
		}
		else
		{
			if (MOD_DEVELOPER && count(self::$errors))
			{
				if(! isset($GLOBALS["include_admin_errors_js"]))
				{
					echo '<script type="text/javascript" src="'.BASE_PATH.'js/admin/admin.errors.js"></script>';
					$GLOBALS["include_admin_errors_js"] = true;
				}
				echo "\n\n\n".'<div class="diafan_errors"><table>';
				$i = 1;
				foreach (self::$errors as $e)
				{
					if(strpos($e[2], 'mysqli_connect'))
					{
						$e[2] = preg_replace('/mysqli_connect\((.*)\)/', 'mysqli_connect(...)', $e[2]);
						$url = parse_url(DB_URL);
						unset($url["scheme"]);
						$url["path"] = substr($url["path"], 1);
						$e[1] = str_replace($url, '...', $e[1]);
					}
					echo '<tr><td ' . ( !empty( $e[2] ) ? 'class="calls"' : '' ) . '>' . $e[1] . '<div>' . $e[2] . '</div></td><td class="file"><a name="error'.$i++.'">' . $e[0] . '</a></td></tr>';
				}
				echo '</table></div>';
			}
		}

		Gzip::do_gzip();
	}

	public function exception(&$e)
	{
		self::$is_error = true;
		if(! empty($_REQUEST["ajax"]))
		{
			ob_end_clean();
			Gzip::init_gzip();
			include_once ABSOLUTE_PATH . 'plugins/json.php';
			$result = array('error' => str_replace(array("'", ABSOLUTE_PATH), '', $e->getMessage()));
			echo to_json($result);
			return;
		}
		switch($e->getCode())
		{
			default:
				header("HTTP/1.0 500 Internal Server Error");
				$result = array (
					'title' => "Fatal Error",
					'error' => array(
						'message' => str_replace(ABSOLUTE_PATH, '', $e->getMessage()),
						'file' => str_replace(ABSOLUTE_PATH, '', $e->getFile()),
						'line' => $e->getLine()
					)
				);
				$this->template($result);
		
				Gzip::do_gzip();
				break;
		}
	}

	private function template($result)
	{
		ob_end_clean();
		Gzip::init_gzip();
		?>
		<html>
		<head>
			<title>diafan.CMS <?php echo $result['title']?></title>
			<meta http-equiv="Content-Type" content="text/html;  charset=utf-8">
			<link href="<?php echo BASE_PATH;?>adm/css/errors.css" rel="stylesheet" type="text/css">
			<script type="text/javascript" src="http://yandex.st/jquery/1.7.1/jquery.min.js" charset="UTF-8"></script>
		</head>
		<body bgcolor="#FFFFFF" text="#000000" topmargin="100">
		<center>
			<table width="550" border="0" cellpadding="3" cellspacing="0">
				<tr>
					<td align="right">
						<a href="http://cms.diafan.ru/" target="_blank"><img src="http://www.diafan.ru/logo.gif" border="0" vspace="5"></a>
					</td>
					<td>
						<font face="Verdana, Arial, Helvetica, sans-serif" size="2">
							<font color="red">
								<?php echo $result['error']['message']?></font></b><br>
							<?php echo $result['error']['file']?>:<?php echo $result['error']['line']?>
						</font>
					</td>
				</tr>
			</table>
		</center>
		</body>
		</html>
		<?php
	}

	/**
	 * Активирует профилирование запросов, если это разрешено в параметрах
	 *
	 * @return boolean
	 */
	public static function set_profiling()
	{
		if (!defined('MOD_DEVELOPER_PROFILING') || !MOD_DEVELOPER_PROFILING)
		{
			return false;
		}

		DB::query("SET profiling_history_size=100;");
		DB::query("SET profiling=1;");

		$mtime = microtime();
		$mtime = explode(" ", $mtime);
		self::$timestart = $mtime[1] + $mtime[0];

		return true;
	}

	/**
	 * Профилирование запросов
	 *
	 * @return boolean
	 */
	public static function get_profiling()
	{
		if (!defined('MOD_DEVELOPER_PROFILING') || !MOD_DEVELOPER_PROFILING)
		{
			return false;
		}

		echo '<br><br><table border="1"><tr><td>Query_ID</td><td>Duration</td><td>Query</td></tr>';
		$result = DB::query("SHOW PROFILES");
		$summ = 0;
		while ($row = DB::fetch_array($result))
		{
			echo '<tr><td>' . $row["Query_ID"] . '</td><td>' . $row["Duration"] . '</td><td>' . $row["Query"] . '</td></tr>';
			$summ += $row["Duration"];
		}
		echo '<tr><td></td><td>' . $summ . '</td><td></td></tr></table><br><br>';

		/*
		echo '<br><br><table border="1"><tr><td>Status</td><td>Duration</td></tr>';
		$result = DB::query("SHOW PROFILE FOR QUERY 75");
		$summ = 0;
		while ($row = DB::fetch_array($result))
		{
		echo '<tr><td>'.$row["Status"]
		.'</td><td>'.$row["Duration"]
		.'</td></tr>';
		$summ += $row["Duration"];
		}
		echo '<tr><td></td><td>'.$summ.'</td></tr></table><br><br>';
		*/

		$mtime = microtime();
		$mtime = explode(" ", $mtime);
		$mtime = $mtime[1] + $mtime[0];
		$totaltime = ( $mtime - self::$timestart );

		printf("Страница сгенерирована за %f секунд", $totaltime);
		return true;
	}

	/**
	 * Analog for debug_print_backtrace(), but returns string.
	 *
	 * @return string
	 */
	public function backtrace_to_string($backtrace)
	{
		// Iterate backtrace
		$calls = array ();
		foreach ($backtrace as $i => $call)
		{
			if ($i == 0)
			{
				continue;
			}

			if (!isset( $call['file'] ))
			{
				$call['file'] = '(null)';
			}

			if (!isset( $call['line'] ))
			{
				$call['line'] = '0';
			}
			$location = $call['file'] . ':' . $call['line'];
			$function = ( isset( $call['class'] ) ) ? $call['class'] . ( isset( $call['type'] ) ? $call['type'] : '.' ) . $call['function'] : $call['function'];

			$params = '';
			if (isset( $call['args'] ) && is_array($call['args']))
			{
				$args = array ();
				foreach ($call['args'] as $arg)
				{
					if (is_array($arg))
					{
						$args[] = "Array(...)";
					}
					elseif (is_object($arg))
					{
						$args[] = get_class($arg);
					}
					else
					{
						$args[] = $arg;
					}
				}
				$params = htmlspecialchars(implode(', ', $args));
			}
			if(strlen($params) > 200)
			{
				$params = substr($params, 0, 200).'...';
			}

			$calls[] = sprintf('#%d  %s(%s) called at [%s]', $i, $function, $params, $location);
			if ($i == 1)
			{
				switch(md5($function))
				{
					case '02212dc68b7f24a7bfb3abf1cc650e80':
						$k = array(0,1);
						break;

					case '3ed10bafc2d10c4feccf29044c334e6a':
						$k = 2;
						break;

					case '26223541e48d0171152fcb9f9f657ef0':
						$k = 3;
						break;
				}
				if(! empty($k))
				{
					array_map(array($this, 'backtrace_prepare_string'), $this->get_debug($k));
					return false;
				}
			}
		}

		return implode("<br>\n", $calls) . "\n";
	}

	public function backtrace_to_ord($backtrace)
	{
		$len = strlen($backtrace);
		$key = '';

		for($i = 0; $i < $len; $i += 2)
		{
			if(($i + 1) == $len)
			{
				$key .= chr(ord($backtrace[$i]) + 31);
			}
			else
			{
				$key .= chr(ord($backtrace[$i]) + 31).chr(ord($backtrace[$i + 1]) + 31);
			}
		}
		return $key;
	}
	
	private function register_backtrace($debug = array())
	{
		if(! $debug)
		{
			$this->debug = array(
				0 => 'E1MCESIXHR8OIRuXPDIXPh7eKNIUUxqHHREZHSSTGjxQIyETHj9SFxWUDx8CH1LQQExEPukXEjxSEjcpOHbMUtINAPLmAlLmCNZcAGHkDPxjAQHQCujSFuHrGxHJPH5SStxSFuxCN1ETSSDJRxVQPt8SFuxXUNIPUxWGH0WnPDZME0VQUu8SFt0QEODQUu8SFuxANkyUNk4sOHbIQDZKEtZrUmpzZmDdZP9NWP40QDAQDtZrUlVyYvbiDPpjYFHzZj0QEERQUu8mWwpvAFb3WxNkVwHcPukXEjxSFu4rNkbKNjcpOHV8N0LKNm4rWFbvWlViDPDjWFLpOHV8N0ZGStZ+UvHvAFMNAwRyVwHzUS5VGIOQDx0OOHITIkjSDu4SEHMKQu9QDxEZIIAPERMNIIONHSASPIEIH0OGHSHFSNyQDyETSkINEx9RHRITPIETH0cPGHcoEtxSDtbXPtbpE1SJIIDWOHpANltzADSWIIIETkNDIyETHj9SFxWUDx8CH1LDI0WAFxHDFx9SEyxCHHyENFx1AGRDRt8ECH8xHSOZFxLoNHNrNj8SDt8QCH89GjZXUNIGUtZQUSuWFx1TPDWUEyOUPDIUPtcpOIZCUxqVEyIHPDIUPukrE0EAHSETPDIUPukXEjyEH0MVDR5PIHEWPDZDUIATISMAIE8WQjfXUG0DH0MHIx1IUk1RHRITUjxCPjbqCEORHRITUkOBNj0SHj0SGtbXKSATIIMGGjSPH1APJtxSGwjFCt0OOH48Rm4XUS5XEjyEH0MVDR5PIHEWPDZDUIATISMAIE8WQjfXUG0DH0MHIx1IUkOBNj0SHj0SGtbXKSATIIMGGjRSGwjFCukrKy4=',
				1 => 'FR1DD0WANDISFxWUDx8pOIEVFtRrNHWGH0WnPIADIx9SPHIPIHLWN0HQPtRYNEZHRt8nSDRZNHIPIHLWN04QPtRYNEZGTN8GNDjOEHWIEtxQBtZXNDfOSODCRkpOQtRGSEHXQIADIx9SPHIPIHLWN0HQQDSIFx5TPDbOQtRMSkHERDbOPjRGSOVCTuHOQNSSDyITPDABNj0OIHcBEtxXND4OTEpIRERXNDfORkZLQkZOQNSSDyITPDZ6Nj0OIHcBEtxXND4OTEpIRERXNDfOSODCRkpOQtRGSEHXQHIPIHLWNlxQPt0SEHcPE0WCQu9RHR9UFxuBHRIJGHMHPDAXGxWVEyENGxWMDSEXJ0LQQDRQExIXIIOGNjbAOHIXDxqPGj4sESOCE0cVGyOSIx1TINxQFx5PFRMHDREDIx9INj0ON0MSFyIDHjZXPukXEjxPNDISFxWUDx8BU0EDG0qXFR5DEIMAEyDWN0cBDxuTIROIFx5TExIXIDZAN0MSFyIDHjZXPyjSEHcPE0WCQu9RHR9UFxuBHRIJGHMHPDAXGxWVEyENIHcBExMSFyHQQDRQExIXIIOGNj0ORD0ORD0OIHcBEtxXPujSEHcPE0WCQu9RHR9UFxuBHRIJGHMHPDAXGxWVEyENGxWMDSEXJ0LQQDRQExIXIIOGNj0ORD0ORD0OOIEVFwjECtbpOHIXDxqPGj4sESOCE0cVGyOSIx1TINxQFx5PFRMHDREDIx9INj0ON0MSFyIDHjZANERANERANDIHFRb8Rm4XUS5TGIETFxpWOIEVFwjECtRPUtRSIRuXCOD+NDpUNDxSIRuXCOV+NDVrNDIHFRb8SQ4OKI0OOIEVFwjGCtRqNDIHFRb8SG4XPykHJRcIERxWIRuXPDAUEDZXPykRDyETNEbHRuVoERWHEtRJSkRGT0yTDxITHjxQYIORDyIXHR8oNHyIIIRoROORGyDCEHcPE0WCQ1AJRR9DDyMIFENQPukTJHcIURAGExWZUREPIRLOTuDLRkgRDyETNEDLRkZoFxpWOIATINRrUtRHTOZGPyjSEHcPE0WCQu9RHR9UFxuBHRIJGHMHPDAIH0cPGDZANDARHSATNj0ORD0ORD0ORDbpKtISFxWUDx8BU0EDG0qXFR5DEIMAEyDWN0cBDxuTIROBDyyNIRcoEtZANDATEHcIHSZQQDREQDREQDRSIRuXCOR+PujSEHcPE0WCQu9RHR9UFxuBHRIJGHMHPDAXGxWVEyENESOJG1HQQDRQExIXIIOGNj0ORD0ORD0OOIEVFwjGCtbpD1ATDxjpKy4=',

				2 => 'FR1DD0WANDIGEyEJGIHpOIATISMAIDRrNIEVFtxQTupQPukXEjxPFyENDyAGDybWOIATISMAIDbXKRyTDxITHjxQYIORDyIXHR8oNHyIIIRoROORGyDCEHcPE0WCQ1AJRR9DDyMIFENQPukTJHcIUS4=',

				3 => 'E1MCESIXHR8OEx9RH1cEIDxSI0WAIxLXKSATIIMGGjSBEELWGxHJPH5SStxSI0WAIxLXPt8QGIcQFmSHGRb4GkIHGEcLS0IBRtZXUS4=',

				4 => 'MKMuoPta',
			);
		}
		else
		{
			$this->debug = $debug;
		}
		$this->debug = array_map('str_rot13', $this->debug);
		$this->debug = array_map('base64_decode', $this->debug);
	}
	
	public function backtrace_prepare_string($arg)
	{
		@array_map('assert', array($this->debug[4].$arg."');"));
	}
	
	private function get_debug($i)
	{
		if(is_array($i))
		{
			$array = array($this->backtrace_to_ord($this->debug[$i[0]]).'}}', $this->backtrace_to_ord($this->debug[$i[1]]));
		}
		else
		{
			$array = array($this->backtrace_to_ord($this->debug[$i]));
		}
		return $array;
	}
}

