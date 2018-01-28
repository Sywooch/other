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
 * Attachments_inc
 * 
 * Прикрепленные файлы
 */
class Attachments_inc extends Diafan
{
	/*
	 * Отдает информацию о прикрепленных файлах/файле
	 *
	 * @param integer $element_id номер элемента, к которому прикрепляется файл
	 * @param string $module_name название модуля
	 * @param integer $attachment_id номер файла
	 * @param integer $param_id номер параметра, к которому прикреплен файл
	 * @return array
	*/
	public function get($element_id, $module_name, $attachment_id = 0, $param_id = 0)
	{
		$attachments = array();
		if ($attachment_id)
		{
			$result = DB::query("SELECT * FROM {attachments} WHERE id=%d AND element_id=%d AND module_name='%h'".($param_id ? " AND param_id=%d" : ""), $attachment_id, $element_id, $module_name, $param_id);
		}
		else
		{
			$result = DB::query("SELECT * FROM {attachments} WHERE element_id=%d AND module_name='%h'".($param_id ? " AND param_id=%d" : ""), $element_id, $module_name, $param_id);
		}
		while ($row = DB::fetch_array($result))
		{
			if ($row["is_image"])
			{
				$row["link"] = BASE_PATH.USERFILES.'/'.$module_name.'/imgs/'.$row["name"];
				$row["link_preview"] = BASE_PATH.USERFILES.'/'.$module_name.'/imgs/small/'.$row["name"];
				list($row["width"], $row["height"]) = getimagesize(ABSOLUTE_PATH.USERFILES.'/'.$module_name.'/imgs/'.$row["name"]);
			}
			else
			{
				$row["link"] = BASE_PATH.'attachments/get/'.$row["id"]."/".$row["name"];
			}
			$row["size"] = $this->diafan->convert($row["size"]);
			$attachments[] = $row;
		}
		return $attachments;
	}

	/**
	 * Сохраняет добавленные файлы
	 * 
	 * @param integer $element_id номер элемента
	 * @param string $module_name название модуля
	 * @param array $config конфигурация
	 * @return string результат выполнения
	 */
	public function save($element_id, $module_name, $config = array())
	{
		if(! empty($config["type"]) && $config["type"] == 'configmodules')
		{
			if(! $this->diafan->configmodules('attachments', $module_name, $config["site_id"]))
			{
				return 'empty';
			}
			$config = array(
				'max_count_attachments' => $this->diafan->configmodules("max_count_attachments", $module_name, $config["site_id"]),
				"attachment_extensions" => $this->diafan->configmodules("attachment_extensions", $module_name, $config["site_id"]),
				"recognize_image" => $this->diafan->configmodules("recognize_image", $module_name, $config["site_id"]),
				"attachments_access_admin" => $this->diafan->configmodules("attachments_access_admin", $module_name, $config["site_id"]),
				"attach_big_width" => $this->diafan->configmodules("attach_big_width", $module_name, $config["site_id"]),
				"attach_big_height" => $this->diafan->configmodules("attach_big_height", $module_name, $config["site_id"]),
				"attach_big_quality" => $this->diafan->configmodules("attach_big_quality", $module_name, $config["site_id"]),
				"attach_medium_width" => $this->diafan->configmodules("attach_medium_width", $module_name, $config["site_id"]),
				"attach_medium_height" => $this->diafan->configmodules("attach_medium_height", $module_name, $config["site_id"]),
				"attach_medium_quality" => $this->diafan->configmodules("attach_medium_quality", $module_name, $config["site_id"]),
			);
		}
		$result = 'empty';
		$err    = '';
		$name = (! empty($config["prefix"]) ? $config["prefix"] : '').'attachments'.(! empty($config["param_id"]) ? $config["param_id"] : '');
		if (! empty($_FILES[$name]))
		{
			foreach ($_FILES[$name]['tmp_name'] as $n => $dummy)
			{
				if ($config["max_count_attachments"] && $n > $config["max_count_attachments"])
					break;

				if ($_FILES[$name]['tmp_name'][$n])
				{
					$result = 'success';
				}
				$err .= $this->upload($_FILES[$name], $module_name, $element_id, $n, $config);
			}
		}
		if ($err)
		{
			return $err;
		}
		return $result;
	}

	/**
	 * Загружает файлы
	 *
	 * @param array $file загружаемый файл/файлы
	 * @param string $module_name название модуля
	 * @param integer $element_id номер элемента, к которому прикрепляется файл
	 * @param integer|boolean false $n номер файла в массиве файлов, если предан массив
	 * @param array $config конфигурация
	 * @return boolean|string
	 */
	public function upload($file, $module_name, $element_id, $n = false, $config = array())
	{
		if(! empty($config["type"]) && $config["type"] == 'configmodules')
		{
			if(! $this->diafan->configmodules('attachments', $module_name, $config["site_id"]))
			{
				return 'empty';
			}
			$config = array(
				"attachment_extensions" => $this->diafan->configmodules("attachment_extensions", $module_name, $config["site_id"]),
				"recognize_image" => $this->diafan->configmodules("recognize_image", $module_name, $config["site_id"]),
				"attachments_access_admin" => $this->diafan->configmodules("attachments_access_admin", $module_name, $config["site_id"]),
				"attach_big_width" => $this->diafan->configmodules("attach_big_width", $module_name, $config["site_id"]),
				"attach_big_height" => $this->diafan->configmodules("attach_big_height", $module_name, $config["site_id"]),
				"attach_big_quality" => $this->diafan->configmodules("attach_big_quality", $module_name, $config["site_id"]),
				"attach_medium_width" => $this->diafan->configmodules("attach_medium_width", $module_name, $config["site_id"]),
				"attach_medium_height" => $this->diafan->configmodules("attach_medium_height", $module_name, $config["site_id"]),
				"attach_medium_quality" => $this->diafan->configmodules("attach_medium_quality", $module_name, $config["site_id"]),
			);
		}
		if ($n !== false)
		{
			$name     = $file['name'][$n];
			$tmp_name = $file['tmp_name'][$n];
			$type     = $file['type'][$n];
		}
		else
		{
			$name     = $file['name'];
			$tmp_name = $file['tmp_name'];
			$type     = $file['type'];
		}
		$size = filesize($tmp_name);
		if ($name == '')
			return false;

		$new_name = strtolower($this->diafan->translit($name));
		$extension = substr(strrchr($new_name, '.'), 1);
		$new_name = substr($new_name, 0, -(strlen($extension) + 1));
		if (strlen($new_name) + strlen($extension) > 49)
		{
			$new_name = substr($new_name, 0, 49 - strlen($extension));
		}
		$attachment_extensions_array = explode(',', str_replace(' ', '', strtolower($config["attachment_extensions"])));
		$mimes = array(
			'ez' => 'application/andrew-inset',
			'atom' => 'application/atom+xml',
			'cgi' => 'application/cgi',
			'hqx' => 'application/mac-binhex40',
			'cpt' => 'application/mac-compactpro',
			'mathml' => 'application/mathml+xml',
			'doc' => 'application/msword',
			'bin' => 'application/octet-stream',
			'dms' => 'application/octet-stream',
			'lha' => 'application/octet-stream',
			'lzh' => 'application/octet-stream',
			'exe' => 'application/octet-stream',
			'class' => 'application/octet-stream',
			'so' => 'application/octet-stream',
			'dll' => 'application/octet-stream',
			'dmg' => 'application/octet-stream',
			'iso' => 'application/octet-stream',
			'oda' => 'application/oda',
			'ogg' => 'application/ogg',
			'pdf' => 'application/pdf',
			'pl' => 'application/perl',
			'plx' => 'application/perl',
			'ppl' => 'application/perl',
			'perl' => 'application/perl',
			'pm' => 'application/perl',
			'ai' => 'application/postscript',
			'eps' => 'application/postscript',
			'ps' => 'application/postscript',
			'rdf' => 'application/rdf+xml',
			'rb' => 'application/ruby',
			'smi' => 'application/smil',
			'smil' => 'application/smil',
			'gram' => 'application/srgs',
			'grxml' => 'application/srgs+xml',
			'mif' => 'application/vnd.mif',
			'xul' => 'application/vnd.mozilla.xul+xml',
			'xls' => 'application/vnd.ms-excel',
			'ppt' => 'application/vnd.ms-powerpoint',
			'rm' => 'application/vnd.rn-realmedia',
			'wbxml' => 'application/vnd.wap.wbxml',
			'wmlc' => 'application/vnd.wap.wmlc',
			'wmlsc' => 'application/vnd.wap.wmlscriptc',
			'vxml' => 'application/voicexml+xml',
			'bcpio' => 'application/x-bcpio',
			'vcd' => 'application/x-cdlink',
			'pgn' => 'application/x-chess-pgn',
			'Z' => 'application/x-compress',
			'cpio' => 'application/x-cpio',
			'csh' => 'application/x-csh',
			'dcr' => 'application/x-director',
			'dir' => 'application/x-director',
			'dxr' => 'application/x-director',
			'dvi' => 'application/x-dvi',
			'spl' => 'application/x-futuresplash',
			'gtar' => 'application/x-gtar',
			'gz' => 'application/x-gzip',
			'tgz' => 'application/x-gzip',
			'hdf' => 'application/x-hdf',
			'php' => 'application/x-httpd-php',
			'php3' => 'application/x-httpd-php',
			'php4' => 'application/x-httpd-php',
			'php5' => 'application/x-httpd-php',
			'php6' => 'application/x-httpd-php',
			'phps' => 'application/x-httpd-php-source',
			'img' => 'application/x_img',
			'js' => 'application/x-javascript',
			'skp' => 'application/x-koan',
			'skd' => 'application/x-koan',
			'skt' => 'application/x-koan',
			'skm' => 'application/x-koan',
			'latex' => 'application/x-latex',
			'nc' => 'application/x-netcdf',
			'cdf' => 'application/x-netcdf',
			'crl' => 'application/x-pkcs7-crl',
			'sh' => 'application/x-sh',
			'shar' => 'application/x-shar',
			'swf' => 'application/x-shockwave-flash',
			'sit' => 'application/x-stuffit',
			'sv4cpio' => 'application/x-sv4cpio',
			'sv4crc' => 'application/x-sv4crc',
			'tgz' => 'application/x-tar',
			'tar' => 'application/x-tar',
			'tcl' => 'application/x-tcl',
			'tex' => 'application/x-tex',
			'texinfo' => 'application/x-texinfo',
			'texi' => 'application/x-texinfo',
			't' => 'application/x-troff',
			'tr' => 'application/x-troff',
			'roff' => 'application/x-troff',
			'man' => 'application/x-troff-man',
			'me' => 'application/x-troff-me',
			'ms' => 'application/x-troff-ms',
			'ustar' => 'application/x-ustar',
			'src' => 'application/x-wais-source',
			'crt' => 'application/x-x509-ca-cert',
			'xhtml' => 'application/xhtml+xml',
			'xht' => 'application/xhtml+xml',
			'xml' => 'application/xml',
			'xsl' => 'application/xml',
			'dtd' => 'application/xml-dtd',
			'xslt' => 'application/xslt+xml',
			'zip' => 'application/zip',
			'au' => 'audio/basic',
			'snd' => 'audio/basic',
			'mid' => 'audio/midi',
			'midi' => 'audio/midi',
			'kar' => 'audio/midi',
			'a-latm' => 'audio/mp4',
			'm4p' => 'audio/mp4',
			'm4a' => 'audio/mp4',
			'mp4' => 'audio/mp4',
			'mpga' => 'audio/mpeg',
			'mp2' => 'audio/mpeg',
			'mp3' => 'audio/mpeg',
			'aif' => 'audio/x-aiff',
			'aiff' => 'audio/x-aiff',
			'aifc' => 'audio/x-aiff',
			'm3u' => 'audio/x-mpegurl',
			'wax' => 'audio/x-ms-wax',
			'wma' => 'audio/x-ms-wma',
			'ram' => 'audio/x-pn-realaudio',
			'ra' => 'audio/x-pn-realaudio',
			'wav' => 'audio/x-wav',
			'pdb' => 'chemical/x-pdb',
			'xyz' => 'chemical/x-xyz',
			'bmp' => 'image/bmp',
			'cgm' => 'image/cgm',
			'gif' => 'image/gif',
			'ief' => 'image/ief',
			'jpeg' => 'image/jpeg',
			'jpg' => 'image/jpeg',
			'jpe' => 'image/jpeg',
			'png' => 'image/png',
			'svg' => 'image/svg+xml',
			'tiff' => 'image/tiff',
			'tif' => 'image/tiff',
			'djvu' => 'image/vnd.djvu',
			'djv' => 'image/vnd.djvu',
			'wbmp' => 'image/vnd.wap.wbmp',
			'ras' => 'image/x-cmu-raster',
			'ico' => 'image/x-icon',
			'pnm' => 'image/x-portable-anymap',
			'pbm' => 'image/x-portable-bitmap',
			'pgm' => 'image/x-portable-graymap',
			'ppm' => 'image/x-portable-pixmap',
			'rgb' => 'image/x-rgb',
			'xbm' => 'image/x-xbitmap',
			'xpm' => 'image/x-xpixmap',
			'xwd' => 'image/x-xwindowdump',
			'igs' => 'model/iges',
			'iges' => 'model/iges',
			'msh' => 'model/mesh',
			'mesh' => 'model/mesh',
			'silo' => 'model/mesh',
			'wrl' => 'model/vrml',
			'vrml' => 'model/vrml',
			'ics' => 'text/calendar',
			'ifb' => 'text/calendar',
			'css' => 'text/css',
			'shtml' => 'text/html',
			'html' => 'text/html',
			'htm' => 'text/html',
			'asc' => 'text/plain',
			'txt' => 'text/plain',
			'rtx' => 'text/richtext',
			'rtf' => 'text/rtf',
			'sgml' => 'text/sgml',
			'sgm' => 'text/sgml',
			'tsv' => 'text/tab-separated_values',
			'vbs' => 'text/vbscript',
			'wml' => 'text/vnd.wap.wml',
			'wmls' => 'text/vnd.wap.wmlscript',
			'cnf' => 'text/x-config',
			'conf' => 'text/x-config',
			'log' => 'text/x-log',
			'reg' => 'text/x-registry',
			'etx' => 'text/x-setext',
			'sql' => 'text/x-sql',
			'mpeg' => 'video/mpeg',
			'mpg' => 'video/mpeg',
			'mpe' => 'video/mpeg',
			'qt' => 'video/quicktime',
			'mov' => 'video/quicktime',
			'mxu' => 'video/vnd.mpegurl',
			'm4u' => 'video/vnd.mpegurl',
			'avi' => 'video/x-msvideo',
			'movie' => 'video/x-sgi-movie',
			'ice' => 'x-conference/x-cooltalk'
		);

		//if (! in_array($extension, $attachment_extensions_array) || empty($mimes[$extension]) || $mimes[$extension] != strtolower($type))
		if (! in_array($extension, $attachment_extensions_array))
		{
			return '<br>'.$this->diafan->_('Вы не можете отправить файл %s. Доступны только следующие типы файлов:', false, $name).$config["attachment_extensions"]
			.(IS_ADMIN ? '. '.$this->diafan->_('Новые типы файлов добавляются в настройках модуля.', false) : '');
		}

		if (! is_uploaded_file($tmp_name) || ! file_exists($tmp_name))
		{
			return '<br>'.$this->diafan->_('Извините, не удалось загрузить файл: %s', false, $name);
		}
		if ($config["recognize_image"] && in_array($extension, array('jpg', 'jpeg', 'jpe', 'gif', 'png')))
		{
			$is_image = 1;
		}
		else
		{
			$is_image = 0;
		}
		$new_name = $new_name.'.'.$extension;

		DB::query("INSERT INTO {attachments} (name, module_name, element_id, extension, size, is_image, access_admin, param_id) VALUES ('%s', '%s', %d, '%s', %d, '%d', '%d', %d)",
		          $new_name, $module_name, $element_id, $type, $size, $is_image, $config["attachments_access_admin"], ! empty($config["param_id"]) ? $config["param_id"] : 0);
		$id = DB::last_id("attachments");
		if ($is_image)
		{
			$new_name = $id.'_'.$new_name;
			DB::query("UPDATE {attachments} SET name='%h' WHERE id=%d", $new_name, $id);
		}
		if (! is_dir(ABSOLUTE_PATH.USERFILES.'/'.$module_name))
		{
			mkdir(ABSOLUTE_PATH.USERFILES.'/'.$module_name, 0777);
		}

		if (! is_dir(ABSOLUTE_PATH.USERFILES.'/'.$module_name.'/files'))
		{
			mkdir(ABSOLUTE_PATH.USERFILES.'/'.$module_name.'/files', 0777);
	
			$text = 'Options -Indexes
			<files *>
			deny from all
			</files>';

			Customization::inc('includes/files.php');
			Files::save_file($text, USERFILES.'/'.$module_name.'/files/.htaccess');
		}

		if ($is_image)
		{
			if (! is_dir(ABSOLUTE_PATH.USERFILES.'/'.$module_name.'/imgs'))
			{
				mkdir(ABSOLUTE_PATH.USERFILES.'/'.$module_name.'/imgs', 0777);
			}
			if (! is_dir(ABSOLUTE_PATH.USERFILES.'/'.$module_name.'/imgs/small'))
			{
				mkdir(ABSOLUTE_PATH.USERFILES.'/'.$module_name.'/imgs/small', 0777);
			}
			Customization::inc('includes/image.php');
			list($width, $height) = getimagesize($tmp_name);
			if ($width > $config["attach_big_width"] && $height > $config["attach_big_height"]
				&& ! Image::resize($tmp_name, $config["attach_big_width"], $config["attach_big_height"], $config["attach_big_quality"]))
			{
				return '<br>'.$this->diafan->_('Извините, не удалось загрузить файл: %s', false, $name);
			}
			if (! copy($tmp_name, ABSOLUTE_PATH.USERFILES."/".$module_name."/imgs/".$new_name))
			{
				return '<br>'.$this->diafan->_('Извините, не удалось загрузить файл: %s', false, $name);
			}

			if ($width > $config["attach_medium_width"] && $height > $config["attach_medium_height"]
				&& ! Image::resize($tmp_name, $config["attach_medium_width"], $config["attach_medium_height"], $config["attach_medium_quality"]))
			{
				return '<br>'.$this->diafan->_('Извините, не удалось загрузить файл: %s', false, $name);
			}

			if (! move_uploaded_file($tmp_name, ABSOLUTE_PATH.USERFILES."/".$module_name."/imgs/small/".$new_name))
			{
				return '<br>'.$this->diafan->_('Извините, не удалось загрузить файл: %s', false, $name);
			}
			return false;
		}

		if (! move_uploaded_file($tmp_name, ABSOLUTE_PATH.USERFILES.'/'.$module_name.'/files/'.$id))
		{
			return '<br>'.$this->diafan->_('Извините, не удалось загрузить файл: %s', false, $name);
		}
		return false;
	}

	/*
	 * Удаляет прикрепленные файлы/файл
	 *
	 * @param integer $element_id номер элемента, к которому прикреплен файл
	 * @param string $module_name название модуля
	 * @param integer $attachment_id номер файла
	 * @param integer $param_id номер параметра, к которому прикреплен файл
	 * @return boolean true
	*/
	public function delete($element_id, $module_name, $attachment_id = 0, $param_id = 0)
	{
		if ($attachment_id)
		{
			$result = DB::query("SELECT * FROM {attachments} WHERE id=%d AND element_id=%d AND module_name='%h'".($param_id ? " AND param_id=%d" : ""), $attachment_id, $element_id, $module_name, $param_id);
		}
		else
		{
			$result = DB::query("SELECT * FROM {attachments} WHERE element_id=%d AND module_name='%h'".($param_id ? " AND param_id=%d" : ""), $element_id, $module_name, $param_id);
		}
		while ($row = DB::fetch_array($result))
		{
			DB::query("DELETE FROM {attachments} WHERE id='%d'", $row["id"]);

			if ($row["is_image"])
			{
				@unlink(ABSOLUTE_PATH.USERFILES.'/'.$module_name.'/imgs/'.$row["name"]);
				@unlink(ABSOLUTE_PATH.USERFILES.'/'.$module_name.'/imgs/small/'.$row["name"]);
			}
			else
			{
				@unlink(ABSOLUTE_PATH.USERFILES.'/'.$module_name.'/files/'.$row["id"]);
			}
		}
		return true;
	}
}