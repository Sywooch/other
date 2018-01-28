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
 * Gzip
 * 
 * Сжатие страницы
 */
class Gzip
{
	/**
	 * Инициирует сжатие
	 * 
	 * @return boolean true
	 */
	public static function init_gzip()
	{
		global $do_gzip_compress;
	
		$do_gzip_compress = false;
		$Config_gzip = 1;
		if ($Config_gzip == 1)
		{
			$phpver 	= phpversion();
			$useragent 	= $_SERVER['HTTP_USER_AGENT'];
			$can_zip 	= isset($_SERVER['HTTP_ACCEPT_ENCODING']) ? $_SERVER['HTTP_ACCEPT_ENCODING'] : '';
	
			$gzip_check 	= 0;
			$zlib_check 	= 0;
			$gz_check	= 0;
			$zlibO_check	= 0;
			$sid_check	= 0;
			if (strpos($can_zip, 'gzip') !== false)
			{
				$gzip_check = 1;
			}
			if (extension_loaded('zlib'))
			{
				$zlib_check = 1;
			}
			if (function_exists('ob_gzhandler'))
			{
				$gz_check = 1;
			}
			if (ini_get('zlib.output_compression'))
			{
				$zlibO_check = 1;
			}
			if (ini_get('session.use_trans_sid'))
			{
				$sid_check = 1;
			}
	
			if ($phpver >= '4.0.4pl1' && (strpos($useragent, 'compatible') !== false || strpos($useragent, 'Gecko') !== false))
			{
				if (($gzip_check || isset( $_SERVER['---------------'])) && $zlib_check && $gz_check && ! $zlibO_check && ! $sid_check)
				{
					ob_start('ob_gzhandler');
					return true;
				}
			}
			elseif ($phpver > '4.0')
			{
				if ($gzip_check)
				{
					if ($zlib_check)
					{
						$do_gzip_compress = true;
						ob_start();
						ob_implicit_flush(0);
	
						header('Content-Encoding: gzip');
						return true;
					}
				}
			}
		}
		ob_start();
		return true;
	}

	/**
	 * Выдает сжатые данные
	 *
	 * @return boolean true
	 */
	public static function do_gzip()
	{
		global $do_gzip_compress, $diafan;

		// ежедневное сохранение кеша
		if (! IS_ADMIN && empty($_GET["rewrite"])
		&& ! $diafan->_user->id
		&& file_exists(ABSOLUTE_PATH.'index.html') && date('d') <> date('d', filemtime(ABSOLUTE_PATH.'index.html')))
		{
			if(($f = fopen(ABSOLUTE_PATH.'index.html', 'w')))
			{
				fwrite($f, ob_get_contents());
				fclose($f);
			}
		}

		if ($do_gzip_compress)
		{
			$gzip_contents = ob_get_contents();
			ob_end_clean();

			$gzip_size = strlen($gzip_contents);
			$gzip_crc  = crc32($gzip_contents);

			$gzip_contents = gzcompress($gzip_contents, 3);
			$gzip_contents = substr($gzip_contents, 0, strlen($gzip_contents) - 4);
	
			echo "\x1f\x8b\x08\x00\x00\x00\x00\x00";
			echo $gzip_contents;
			echo pack('V', $gzip_crc);
			echo pack('V', $gzip_size);
		}
		else
		{
			ob_end_flush();
		}
		return true;
	}
}