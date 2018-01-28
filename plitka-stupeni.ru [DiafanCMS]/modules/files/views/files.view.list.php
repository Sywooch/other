<?php
/**
 * Список файлов
 *
 * Шаблон вывода списка файлов в том случае, если в настройках модуля отключен параметр «Использовать категории»
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

echo '<div class="files_list">';

//описание текущей категории
if (! empty($result["text"]))
{
	echo '<div class="files_cat_text">';
	$this->htmleditor($result['text']);
	echo '</div>';
}

//рейтинг категории
if (! empty($result["rating"]))
{
	echo $result["rating"];
}

//изображения текущей категории
if (! empty($result["img"]))
{
	echo '<div class="files_cat_all_img">';
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

//подкатегории
if (! empty($result["children"]))
{
	foreach ($result["children"] as $child)
	{
		echo '<div class="files_cat_link">';

		//изображение подкатегории
		if (! empty($child["img"]))
		{
			echo '<div class="files_cat_img">';
			foreach ($child["img"] as $img)
			{
				switch($img["type"])
				{
					case 'animation':
						echo '<a href="'.BASE_PATH.$img["link"].'" rel="prettyPhoto[gallery'.$child["id"].'files]">';
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

		//название и ссылка подкатегории
		echo '<a href="'.BASE_PATH_HREF.$child["link"].'">'.$child["name"].'</a>';

		//краткое описание подкатегории
		if ($child["anons"])
		{
			echo '<div class="files_cat_anons">';
			$this->htmleditor($child['anons']);
			echo '</div>';
		}
		//файлы подкатегории
		if (! empty($child["rows"]))
		{
			foreach ($child["rows"] as $row)
			{
				echo '<div class="files">';
		
				//название и ссылка файла
				echo '<div class="files_name"><a href="'.BASE_PATH_HREF.$row["link"].'">'.$row["name"].'</a>';
				//рейтинг файла
				if (! empty($row["rating"]))
				{
					echo ' '.$row["rating"];
				}
				echo '</div>';
		
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
		
				//краткое описание файла
				if (! empty($row["anons"]))
				{
					echo '<div class="files_anons">';
					$this->htmleditor($row['anons']);
					echo '</div>';
				}
		
				echo '</div>';
			}
			echo '<div class="clear"></div>';
		}
		echo '</div>';
	}
}

//файлы
if (! empty($result["rows"]))
{
	foreach ($result["rows"] as $row)
	{
		echo '<div class="files">';

		//название и ссылка файла
		echo '<div class="files_name"><a href="'.BASE_PATH_HREF.$row["link"].'">'.$row["name"].'</a>';
		//рейтинг файла
		if (! empty($row["rating"]))
		{
			echo ' '.$row["rating"];
		}
		echo '</div>';

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
	echo '<div class="clear"></div>';
}

//постраничная навигация
if (! empty($result["paginator"]))
{
	echo $result["paginator"];
}

//ссылки на предыдущую и последующую категории
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

//комментарии к категориям
if (! empty($result["comments"]))
{
	echo $result["comments"];
}
echo '</div>';