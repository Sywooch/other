<?php
/**
 * Список фотографий
 *
 * Шаблон вывода списка фотографий в том случае, если в настройках модуля отключен параметр «Использовать альбомы»
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

echo '<div class="photo_list">';

//вывод описания текущей категории
if (! empty($result["text"]))
{
	echo '<div class="photo_cat_text">';
	$this->htmleditor($result['text']);
	echo '</div>';
}

//рейтинг альбома
if (! empty($result["rating"]))
{
	echo $result["rating"];
	echo '<div class="clear"><br></div>';
}

//вывод изображений текущей категории
if (! empty($result["img"]))
{
	echo '<div class="photo_cat_all_img">';
	foreach ($result["img"] as $img)
	{
		switch($img["type"])
		{
			case 'animation':
				echo '<a href="'.BASE_PATH.$img["link"].'" rel="prettyPhoto[gallery'.$result["id"].'photo]">';
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

//вывод подкатегорий
if (! empty($result["children"]))
{
	foreach ($result["children"] as $child)
	{
		echo '<div class="photo_cat_link">';

		//вывод названий и ссылок на подкатегории
		echo '<a href="'.BASE_PATH_HREF.$child["link"].'">'.$child["name"].'</a>';

		//краткое описание подкатегории
		if ($child["anons"])
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

//вывод списка фотографий
if (! empty($result["rows"]))
{
	foreach ($result["rows"] as $row)
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

//вывод комментариев к категориям, если подключены в настройках
if (! empty($result["comments"]))
{
	echo $result["comments"];
}

//вывод постраничной навигации
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

echo '</div>';