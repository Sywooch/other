<?php
/**
 * Блок похожих статей
 * 
 * Шаблон
 * шаблонного тега <insert name="show_block_rel" module="clauses" [count="количество"]
 * [images="количество_изображений"] [images_variation="тег_размера_изображений"]
 * [template="шаблон"]>:
 * блок похожих статей
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
echo '<div class="block_header">' . $this->diafan->_('Похожие статьи') . '</div>';

echo '<div class="clauses_block_rel">';

//заголовок блока
if (! empty($result["name"]))
{
	echo '<div class="block_header">'.$result["name"].'</div>';
}

//статьи
foreach ($result["rows"] as $row)
{
	echo '<div class="clauses">';

	//дата статьи
	if (! empty($row["date"]))
	{
		echo '<div class="clauses_date">'.$row["date"].'</div>';
	}

	//название и ссылка статьи
	echo '<div class="clauses_name"><a href="'.BASE_PATH_HREF.$row["link"].'">'.$row['name'].'</a></div>';

	//изображения статьи
	if (! empty($row["img"]))
	{
		echo '<div class="clauses_img">';
		foreach ($row["img"] as $img)
		{
			switch($img["type"])
			{
				case 'animation':
					echo '<a href="'.BASE_PATH.$img["link"].'" rel="prettyPhoto[gallery'.$row["id"].'clauses]">';
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
	echo '<div class="clauses_anons">';
	$this->htmleditor($row['anons']);
	echo '</div>';

	echo '</div>';
}
echo '</div>';
