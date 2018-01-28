<?php
/**
 * Первая страница модуля
 *
 * Шаблон первой страницы модуля «Фотогалерея», если в настройках модуля
 * подключен параметр «Использовать альбомы»
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

//вывод альбомов
foreach ($result["categories"] as $cat_id => $cat)
{
	echo '<div class="photo_first_page">';

	//название альбома
	echo '<div class="block_header"><a href="'.BASE_PATH_HREF.$cat["link_all"].'">'.$cat["name"].'</a>';

	//рейтинг альбома
	if (! empty($cat["rating"]))
	{
		echo $cat["rating"];
	}

	echo '</div>';

	//вывод изображений альбома
	if (! empty($cat["img"]))
	{
		echo '<div class="photo_cat_img">';
		foreach ($cat["img"] as $img)
		{
			switch($img["type"])
			{
				case 'animation':
					echo '<a href="'.BASE_PATH.$img["link"].'" rel="prettyPhoto[gallery'.$cat_id.'photo]">';
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

	//краткое описание альбома
	if (! empty($cat["anons"]))
	{
		echo '<div class="photo_cat_anons">';
		$this->htmleditor($cat['anons']);
		echo '</div>';
	}

	//подкатегории
	if (! empty($cat["children"]))
	{
		foreach ($cat["children"] as $child)
		{
			echo '<div class="photo_cat_link">';

			//название и ссылка подкатегории
			echo '<a href="'.BASE_PATH_HREF.$child["link"].'">'.$child["name"].'</a>';

			//краткое описание подкатегории
			if (! empty($child["anons"]))
			{
				echo '<div class="photo_cat_anons">';
				$this->htmleditor($child['anons']);
				echo '</div>';
			}
			//фотографии подкатегории
			if (! empty($child["rows"]))
			{
				foreach ($child["rows"] as $row)
				{
					echo '<div class="photo">';
			
					//вывод рейтинга фотографии
					if (! empty($row["rating"]))
					{
						echo $row["rating"];
					}
			
					//вывод маленького изображения
					if (! empty($row["img"]))
					{
						echo '<div class="photo_img">';
						switch($row["img"]["type"])
						{
							case 'animation':
								echo '<a href="'.BASE_PATH.$row["img"]["link"].'" rel="prettyPhoto[galleryphoto]">';
								break;
							case 'large_image':
								echo '<a href="'.BASE_PATH.$row["img"]["link"].'" rel="large_image" width="'.$row["img"]["link_width"].'" height="'.$row["img"]["link_height"].'">';
								break;
							default:
								echo '<a href="'.BASE_PATH_HREF.$row["img"]["link"].'">';
								break;
						}
						echo '<img src="'.$row["img"]["src"].'" width="'.$row["img"]["width"].'" height="'.$row["img"]["height"]
						.'" alt="'.$row["img"]["alt"].'" title="'.$row["img"]["title"].'">'
						.'</a></div>';
					}
			
					//вывод названия и, если используется, ссылки на отдельную страницу фотографии
					if ($row["name"])
					{
						echo '<div class="photo_name">';
						if ($row["link"])
						{
							echo '<a href="'.BASE_PATH_HREF.$row["link"].'">';
						}
						echo $row["name"];
						if ($row["link"])
						{
							echo '</a>';
						}
						echo '</div>';
					}
			
					//вывод краткого описания фотографии
					if (! empty($row["anons"]))
					{
						echo '<div class="photo_anons">';
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

	//вывод нескольких фотографий из текущей категории (задается в настройках модуля)
	if ($cat["rows"])
	{
		foreach ($cat["rows"] as $row)
		{
			echo '<div class="photo_img">';

			//изображение
			if (! empty($row["img"]))
			{
				echo '<a href="'.BASE_PATH_HREF.$cat["link_all"].'">';
				echo '<img src="'.$row["img"]["src"].'" width="'.$row["img"]["width"].'" height="'.$row["img"]["height"]
				.'" alt="'.$row["img"]["alt"].'" title="'.$row["img"]["title"].'">'
				.'</a>';
			}

			echo '</div>';
		}
	}

	echo '</div>';
}