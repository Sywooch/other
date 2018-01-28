<?php
/**
 * Блок фотографий
 * 
 * Шаблон
 * шаблонного тега <insert name="show_block" module="photo" [count="количество"]
 * [cat_id="категория"] [site_id="страница_с_прикрепленным_модулем"]
 * [images="количество_изображений"] [images_variation="тег_размера_изображений"]
 * [sort="порядок_вывода"] [template="шаблон"]>:
 * блок фотографий
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

echo '<div class="photo_block">';

//заголовок блока
if (! empty($result["name"]))
{
	echo '<div class="block_header">'.$result["name"].'</div>';
}

//фотографии
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
				echo '<a href="'.BASE_PATH.$row["img"]["link"].'" rel="prettyPhoto[galleryphotoblock]">';
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
	echo '</div>';
}

//ссылка на все фотографии
if (! empty($result["link_all"]))
{
	echo '<div class="show_all"><a href="'.BASE_PATH_HREF.$result["link_all"].'">';
	if ($result["category"])
	{
		echo $this->diafan->_('Посмотреть все фотографии в категории «%s»', true, $result["name"]);
	}
	else
	{
		echo $this->diafan->_('Все фотографии');
	}
	echo '</a></div>';
}

echo '</div>';