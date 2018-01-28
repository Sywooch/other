<?php
/**
 * Блок похожих новостей
 * 
 * Шаблон
 * шаблонного тега <insert name="show_block_rel" module="news" [count="количество"]
 * [images="количество_изображений"] [images_variation="тег_размера_изображений"]
 * [template="шаблон"]>:
 * блок похожих новостей
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
echo '<div class="block_header">' . $this->diafan->_('Похожие новости') . '</div>';

echo '<div class="news_block_rel">';

//заголовок блока
if (! empty($result["name"]))
{
	echo '<div class="block_header">'.$result["name"].'</div>';
}

//новости
foreach ($result["rows"] as $row)
{
	echo '
	<div class="news">';

	//дата новости
	if (! empty($row["date"]))
	{
		echo '<div class="news_date">'.$row["date"].'</div>';
	}

	//название и ссылка новости
	echo '<div class="news_name"><a href="'.BASE_PATH_HREF.$row["link"].'">'.$row['name'].'</a></div>';

	//изображения новости
	if (! empty($row["img"]))
	{
		echo '<div class="news_img">';
		foreach ($row["img"] as $img)
		{
			switch($img["type"])
			{
				case 'animation':
					echo '<a href="'.BASE_PATH.$img["link"].'" rel="prettyPhoto[gallery'.$row["id"].'news]">';
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

	//анонс новости
	echo '<div class="news_anons">';
	$this->htmleditor($row['anons']);
	echo '</div>';

	echo '</div>';
}

echo '</div>';