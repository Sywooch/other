<?php
/**
 * Список фотографий одного тега
 *
 * Шаблон списка фотографий для модуля «Теги»
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

//название и описание категории
echo '<div class="tags_list">';

//фотографии
if (! empty($result["rows"]))
{
	foreach ($result["rows"] as $row)
	{
		echo '<div class="photo">';

		//изобаражение
		if (! empty($row["img"]))
		{
			echo '<div class="photo_img">';
			switch($row["img"]["type"])
			{
				case 'animation':
					echo '<a href="'.BASE_PATH.$row["img"]["link"].'" rel="prettyPhoto[galleryphototags]">';
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

		//название и ссылка фотографии
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

		//краткое описание фотографии
		if (! empty($row["anons"]))
		{
			echo '<div class="photo_anons">';
			$this->htmleditor($row['anons']);
			echo '</div>';
		}

		//рейтинг фотографии
		if (! empty($row["rating"]))
		{
			echo $row["rating"];
		}

		//теги фотографии
		if (! empty($row["tags"]))
		{
			echo $row["tags"];
		}

		echo '</div>';

		}
	echo '<div class="clear"></div>';
}

echo '</div>';