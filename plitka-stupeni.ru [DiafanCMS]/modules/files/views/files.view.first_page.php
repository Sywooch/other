<?php
/**
 * Первая страница модуля
 * 
 * Шаблон первой страницы модуля «Файловый архив», если в настройках модуля подключен параметр «Использовать категории»
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

if (empty($result["categories"]))
	return false;

//категории
foreach ($result["categories"] as $cat_id => $cat)
{
	echo '<div class="files_list">';

	//название категории
	echo '<div class="block_header">'.$cat["name"];

	//рейтинг категории
	if (! empty($cat["rating"]))
	{
		echo $cat["rating"];
	}
	echo '</div>';

	//изображения категории
	if (! empty($cat["img"]))
	{
		echo '<div class="files_cat_img">';
		foreach ($cat["img"] as $img)
		{
			switch($img["type"])
			{
				case 'animation':
					echo '<a href="'.BASE_PATH.$img["link"].'" rel="prettyPhoto[gallery'.$cat_id.'files]">';
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

	//краткое описание категории
	if (! empty($cat["anons"]))
	{
		echo '<div class="files_cat_anons">';
		$this->htmleditor($cat['anons']);
		echo '</div>';
	}

	//подкатегории
	if (! empty($cat["children"]))
	{
		foreach ($cat["children"] as $child)
		{
			echo '<div class="files_cat_link">';

			//изображения подкатегории
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
			if (! empty($child["anons"]))
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

	//файлы в категории
	if ($cat["rows"])
	{
		foreach ($cat["rows"] as $row)
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
			echo '<div class="files_name"><a href="'.BASE_PATH_HREF.$row["link"].'">'.$row["name"].'</a>';

			//рейтинг файла
			if (! empty($row["rating"]))
			{
				echo ' '.$row["rating"];
			}
			echo '</div>';

			//краткое описание файла
			if (! empty($row["anons"]))
			{
				echo '<div class="files_anons">';
				$this->htmleditor($row['anons']);
				echo '</div>';
			}

			//теги файла
			if (! empty($row["tags"]))
			{
				echo $row["tags"];
			}
			echo '</div>';
		}
	}

	//ссылка на все файлы в категории
	if ($cat["link_all"])
	{
		echo '<div class="show_all"><a href="'.BASE_PATH_HREF.$cat["link_all"].'">'
		.$this->diafan->_('Посмотреть все файлы в категории «%s»', true, $cat["name"])
		.'</a></div>';
	}
	echo '</div>';
}