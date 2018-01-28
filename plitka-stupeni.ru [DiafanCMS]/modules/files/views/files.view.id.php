<?php
/**
 * Страница файла
 *
 * Шаблон оформления страницы с отдельным файлом
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

echo '<div class="files_id">';

//краткое описание файла
if ($result['anons'])
{
	echo '<div class="files_anons">';
	$this->htmleditor($result['anons']);
	echo '</div>';
}

//описание файла
echo '<div class="files_text">';
$this->htmleditor($result['text']);
echo '</div>';

//изображения файла
if (! empty($result["img"]))
{
	echo '<div class="files_all_img">';
	foreach ($result["img"] as $img)
	{
		switch($img["type"])
		{
			case 'animation':
				echo '<a href="'.BASE_PATH.$img["link"].'" rel="prettyPhoto[gallery'.$result["id"].'files]">';
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

//счетчик просмотров
if(! empty($result["counter"]))
{
	echo '<div class="files_counter">'.$this->diafan->_('Просмотров').': '.$result["counter"].'</div>';
}

//теги файла
if (! empty($result["tags"]))
{
	echo $result["tags"];
}

//ссылка на скачивание файла
if (! empty($result["link"]))
{
	echo '<div class="files_download">';
	echo '<a href="'.$result["link"].'">'.$this->diafan->_('Скачать').'</a>';
		//размер файла
		if (! empty($result["size"])) echo ' ('.$result["size"].')';
	echo '</div>';
}

//рейтинг файла
if (! empty($result["rating"]))
{
	echo $result["rating"];
}

//комментарии к файлу
if (! empty($result["comments"]))
{
	echo $result["comments"];
}

//ссылки на предыдущий и последующий файл
if (! empty($result["previous"]) || ! empty($result["next"]))
{
	echo '<div class="previous_next_links">';
	if (! empty($result["previous"]))
	{
		echo '<div class="previous_link"><a href="'.BASE_PATH_HREF.$result["previous"]["link"].'">&larr; '.$result["previous"]["text"].'</a></div>';
	}
	if (! empty($result["next"]))
	{
		echo '<div class="next_link"><a href="'.BASE_PATH_HREF.$result["next"]["link"].'">'.$result["next"]["text"].' &rarr;</a></div>';
	}
	echo '</div>';
}

echo '</div>';