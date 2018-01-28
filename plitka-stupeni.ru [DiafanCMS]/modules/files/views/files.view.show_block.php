<?php
/**
 * Блок файлов
 * 
 * Шаблон
 * шаблонного тега <insert name="show_block" module="files" [count="количество"]
 * [cat_id="категория"] [site_id="страница_с_прикрепленным_модулем"]
 * [images="количество_изображений"] [images_variation="тег_размера_изображений"]
 * [sort="порядок_вывода"] [template="шаблон"]>:
 * блок файлов
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

if (empty($result["rows"]))
{
	return false;
}
echo '<div class="files_block">';

//заголовок блока
if (! empty($result["name"]))
{
	echo '<div class="block_header">'.$result["name"].'</div>';
}

//фaйлы
foreach ($result["rows"] as $row)
{
	echo '<div class="files">';

	//изображения файла
	if (! empty($row["img"]))
	{
		echo '<div class="files_img">';
		foreach ($row["img"] as $img)
		{
			switch($img["type"])
			{
				case 'animation':
					echo '<a href="'.BASE_PATH.$img["link"].'" rel="prettyPhoto[gallery'.$row["id"].'files]">';
					break;
				case 'large_image':
					echo '<a href="'.BASE_PATH.$img["link"].'" rel="large_image" width="'.$img["link_width"].'" height="'.$img["link_height"].'">';
					break;
				default:
					echo '<a href="'.BASE_PATH_HREF.$img["link"].'">';
					break;
			}
			echo '<img src="'.$img["src"].'" width="'.$img["width"].'" height="'.$img["height"].'" alt="'.$img["alt"].'" title="'.$img["title"].'">'
			.'</a> ';
		}
		echo '</div>';
	}

	//название и ссылка файла
	echo '<div class="files_name"><a href="'.BASE_PATH_HREF.$row["link"].'">'.$row["name"].'</a></div>';

	//краткое описание файла
	if (! empty($row["anons"]))
	{
		echo '<div class="files_anons">';
		$this->htmleditor($row['anons']);
		echo '</div>';
	}
	//ссылка на скачивание файла
	if (! empty($row["link_file"]))
	{
		echo '<div class="files_download">';
		echo '<a href="'.$row["link_file"].'">'.$this->diafan->_('Скачать').'</a>';
		//размер файла
		if (! empty($row["size"])) echo ' ('.$row["size"].')';
		echo '</div>';
	}
	echo '</div>';
}

//ссылка на все файлы
if (! empty($result["link_all"]))
{
	echo '<div class="show_all">';
	echo '<a href="'.BASE_PATH_HREF.$result["link_all"].'">';
	if ($result["category"])
	{
		echo $this->diafan->_('Посмотреть все файлы в категории «%s»', true, $result["name"]);
	}
	else
	{
		echo $this->diafan->_('Все файлы');
	}
	echo '</a>';
	echo '</div>';
}


echo '</div>';