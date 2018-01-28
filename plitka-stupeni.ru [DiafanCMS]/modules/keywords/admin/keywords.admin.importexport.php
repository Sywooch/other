<?php
/**
 * Редактирование импорт ключевых слов
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

class Keywords_admin_importexport extends Frame_admin
{
	/**
	 * Выводит форму загрузки файла импорта
	 * @return void
	 */
	public function show()
	{
		$this->form_upload();
	}

	/**
	 * Выводит форму импорт/экспорт ключевиков
	 * 
	 * @return void
	 */
	private function form_upload()
	{
		$this->upload();
		echo '<div class="block">';
		echo '<p><a href="'.BASE_PATH.'keywords/export/">'.$this->diafan->_('Экспорт').'</a></p>';
		echo '<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="upload" value="1">
		'.$this->diafan->_('Импорт').':<br>
		<input type="checkbox" name="keywords_php" value="1"> '.$this->diafan->_('файл keywords.php (из предыдущих версий)').'<br>
		<input type="checkbox" name="delete_old" value="1"> '.$this->diafan->_('удалить неописанные в файле строки').'<br>
		<input type="file" name="file">
		<input type="submit" class="button" value="'.$this->diafan->_('Загрузить').'">
		</form></div>';
	}

	/**
	 * Загружает файл перевода
	 * 
	 * @return void
	 */
	private function upload()
	{
		if(! empty($_POST["delete_old"]))
		{
			DB::query("TRUNCATE TABLE {keywords}");
		}
		if (! isset($_FILES["file"]) || ! is_array($_FILES["file"]) || $_FILES["file"]['name'] == '')
		{
			return;
		}
		if(! empty($_POST["keywords_php"]))
		{
			$this->upload_keywords_php();
			return;
		}
		$oldkeywords  = array();
		if(empty($_POST["delete_old"]))
		{
			$result = DB::query("SELECT * FROM {keywords} WHERE trash='0'");
			while($row = DB::fetch_array($result))
			{
				$oldkeywords[$row["text"]] = $row["id"];
			}
		}

		$file = file_get_contents($_FILES["file"]['tmp_name']);

		$newkeywords = explode("\n", $file);
		$text = '';
		foreach($newkeywords as $s)
		{
			if(! $text)
			{
				$text = $s;
			}
			else
			{
				if(! empty($oldkeywords[$text]))
				{
					DB::query("UPDATE {keywords} SET `link`='%s' WHERE id=%d", $s, $oldkeywords[$text]);
				}
				else
				{
					DB::query("INSERT INTO {keywords} ([act], `text`, `link`) VALUES ('1', '%s', '%s')", $text, $s);
				}
				$text = '';
			}
		}
		unlink($_FILES["file"]['tmp_name']);

		$this->diafan->redirect(URL.'success1/');
	}

	/**
	 * Загружает файл из предыдущей версии
	 * 
	 * @return void
	 */
	private function upload_keywords_php()
	{
		$oldkeywords  = array();
		if(empty($_POST["delete_old"]))
		{
			$result = DB::query("SELECT * FROM {keywords} WHERE trash='0'");
			while($row = DB::fetch_array($result))
			{
				$oldkeywords[$row["text"]] = $row["id"];
			}
		}
		$tmpname = md5(mt_rand(0, 9999999));

		copy($_FILES["file"]['tmp_name'], ABSOLUTE_PATH.'cache/'.$tmpname.'.php');
		
		include ABSOLUTE_PATH.'cache/'.$tmpname.'.php';
		if(empty($keywords))
		{
			$this->diafan->redirect(URL.'error1/');
		}

		foreach($keywords as $k => $v)
		{
			if(! empty($oldkeywords[$k]))
			{
				DB::query("UPDATE {keywords} SET `link`='%s' WHERE id=%d", $v, $oldkeywords[$k]);
			}
			else
			{
				DB::query("INSERT INTO {keywords} ([act], `text`, `link`) VALUES ('1', '%s', '%s')", $k, $v);
			}
		}
		unlink($_FILES["file"]['tmp_name']);
		unlink(ABSOLUTE_PATH.'cache/'.$tmpname.'.php');

		$this->diafan->redirect(URL.'success1/');
	}

	/**
	 * Выводит системное сообщение
	 *
	 * @return void
	 */
	public function show_error_message()
	{
		if ($this->diafan->error)
		{
			echo '<div class="error">'.$this->diafan->_('Файл не верного формата.').'</div>';
		}

		if ($this->diafan->success)
		{
			echo '<div class="ok">'.$this->diafan->_('Изменения сохранены!').'</div>';
		}
	}
}