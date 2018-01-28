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
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

/**
 * Update_admin_importexport
 *
 * Импорт/экспорт базы данных
 */
class Update_admin_importexport extends Frame_admin
{
	/**
	 * Выводит контент модуля
	 * @return void
	 */
	public function show()
	{
		$this->diafan->import();
		if($this->diafan->success)
		{
			echo '<div class="ok">'.$this->diafan->_('Импорт успешно выполнен').'</div>';
		}

		echo '<div class="block"><div class="block_header">'.$this->diafan->_('Экспорт').'</div>
		<a href="'.BASE_PATH.'update/export/">'.$this->diafan->_('Скачать файл').'</a></div>
		
		<div class="block">
		<div class="block_header">'.$this->diafan->_('Импорт').'</div>
		<form action="'.URL.'" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="check_hash_user" value="'.$this->diafan->_user->get_hash().'">
		<input type="hidden" name="action" value="import">
		<input type="file" name="file" value="" size=40>
		<input type="submit" value="'.$this->diafan->_('Импортировать').'" class="button">
		</form></div>';
	}

	/**
	 * Импорт БД
	 * @return void
	 */
	public function import()
	{
		if(empty($_POST["action"]) || $_POST["action"] != "import")
		{
			return;
		}
		// Прошел ли пользователь проверку идентификационного хэша
		if (! $this->diafan->_user->checked)
		{
			$this->diafan->redirect(URL);
			return;
		}
		
		if ($_FILES['file'] && $_FILES['file']['name'])
		{
			$filename = $_FILES['file']['tmp_name'];
			if (! $this->import_query($filename))
			{
			   return;
			}
			else
			{
				$this->diafan->redirect(URL.'success1/');
			}
		}
		else
		{
			echo '<div class="error">'.$this->diafan->_("Проверьте файл").'</div>';
			return;
		}
		$this->diafan->redirect(URL);
	}
	
	private function import_query($filename)
	{
		$sql = '';
		$ochar = '';
		$is_cmt = '';
		$insql = '';
		while ( $str = $this->get_next_chunk($insql, $filename) )
		{
			$opos = -strlen($ochar);
			$cur_pos = 0;
			$i = strlen($str);
			while ($i--)
			{
				if ($ochar)
				{
					list($clchar, $clpos) = $this->get_close_char($str, $opos+strlen($ochar), $ochar);
					if ( $clchar )
					{
						if ($ochar == '--' || $ochar == '#' || $is_cmt )
						{
							$sql .= substr($str, $cur_pos, $opos - $cur_pos );
						}
						else
						{
							$sql .= substr($str, $cur_pos, $clpos + strlen($clchar) - $cur_pos );
						}
						$cur_pos = $clpos + strlen($clchar);
						$ochar = '';
						$opos = 0;
					}
					else
					{
						$sql .= substr($str, $cur_pos);
						break;
					}
				}
				else
				{
					list($ochar, $opos) = $this->get_open_char($str, $cur_pos);
					if ($ochar == ';')
					{
						$sql .= substr($str, $cur_pos, $opos - $cur_pos + 1);
						if(! $this->query($sql))
							return false;
						$sql = '';
						$cur_pos = $opos + strlen($ochar);
						$ochar = '';
						$opos = 0;
					}
					elseif(! $ochar)
					{
						$sql .= substr($str, $cur_pos);
						break;
					}
					else
					{
						$is_cmt = 0;
						if ($ochar == '/*' && substr($str, $opos, 3) != '/*!')
						{
							$is_cmt = 1;
						}
					}
				}
			}
		}

		if ($sql)
		{
			return $this->query($sql);
		}
		return true;
	}
	
	private function query($sql)
	{
		if(! trim($sql))
		{
			return true;
		}
		DB::$backend->query($sql);
		$error = DB::$backend->error();
		if($error)
		{
			echo '<div class="error"><b>'.htmlspecialchars($error).'</b><br><br>query: '.htmlspecialchars($sql).'</div>';
			return false;
		}
		return true;
	}
	
	private function get_next_chunk($insql, $fname)
	{
		global $LFILE, $insql_done;
		if ($insql)
		{
			if ($insql_done)
			{
				return '';
			}
			else
			{
				$insql_done = 1;
				return $insql;
			}
		}
		if (!$fname)
			return '';
		if (!$LFILE)
		{
			$LFILE = fopen($fname, "r+b") or die("Can't open [$fname] file $!");
		}
		return fread($LFILE, 64 * 1024);
	}

	function get_open_char($str, $pos)
	{
		$ochar = '';
		$opos = '';
		if ( preg_match("/(\/\*|^--|(?<=\s)--|#|'|\"|;)/", $str, $m, PREG_OFFSET_CAPTURE, $pos) )
		{
			$ochar = $m[1][0];
			$opos = $m[1][1];
		}
		return array($ochar, $opos);
	}

	private function get_close_char($str, $pos, $ochar)
	{
		$clchar = '';
		$clpos = '';
		$aCLOSE = array(
				'\'' => '(?<!\\\\)\'|(\\\\+)\'',
				'"' => '(?<!\\\\)"',
				'/*' => '\*\/',
				'#' => '[\r\n]+',
				'--' => '[\r\n]+',
			);
		if ( $aCLOSE[$ochar] && preg_match("/(".$aCLOSE[$ochar].")/", $str, $m, PREG_OFFSET_CAPTURE, $pos ) )
		{
			$clchar = $m[1][0];
			$clpos = $m[1][1];
			$sl = !empty($m[2][0]) && strlen($m[2][0]);
			if ($ochar == "'" && $sl)
			{
				if ($sl % 2)
				{
					list($clchar, $clpos) = $this->get_close_char($str, $clpos + strlen($clchar), $ochar);
				}
				else
				{
					$clpos += strlen($clchar) - 1;
					$clchar = "'";
				}
			}
		}
		return array($clchar, $clpos);
	}
}