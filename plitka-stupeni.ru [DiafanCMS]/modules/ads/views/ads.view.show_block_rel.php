<?php
/**
 * Блок похожих объявлений
 * 
 * Шаблон
 * шаблонного тега <insert name="show_block_rel" module="ads" [count="количество"]
 * [images="количество_изображений"] [images_variation="тег_размера_изображений"]
 * [template="шаблон"]>:
 * блок похожих объявлений
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
    include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}

if (!empty($result["rows"]))
{
	echo '<div class="block_header">' . $this->diafan->_('Похожие объявления') . '</div>
	<div class="ads_block_rel">';
	foreach ($result["rows"] as $row)
	{
		echo '<table class="ads"><tr><td colspan=2 valign=top>';

		//вывод названия и ссылки
		echo '<div class="ads_name">';
		echo '<a href="' . BASE_PATH_HREF . $row["link"] . '">' . $row["name"] . '</a>';

		//рейтинг
		if (!empty($row["rating"]))
		{
			echo ' ' . $row["rating"];
		}
		echo '</div>';

		echo '</td></tr><tr><td valign=top>';

		//изображения
		if (!empty($row["img"]))
		{
			echo '<div class="ads_img">';
			foreach ($row["img"] as $img)
			{
				switch ($img["type"])
				{
					case 'animation':
						echo '<a href="' . BASE_PATH . $img["link"] . '" rel="prettyPhoto[gallery' . $row["id"] . 'ads]">';
						break;
					case 'large_image':
						echo '<a href="' . BASE_PATH . $img["link"] . '" rel="large_image" width="' . $img["link_width"] . '" height="' . $img["link_height"] . '">';
						break;
					default:
						echo '<a href="' . BASE_PATH_HREF . $img["link"] . '">';
						break;
				}
				echo '<img src="' . $img["src"] . '" width="' . $img["width"] . '" height="' . $img["height"] . '" alt="' . $img["alt"] . '" title="' . $img["title"] . '">'
				. '</a> ';
			}
			echo '</div>';
		}

		echo '</td>';
		echo '<td valign=top>';

		//дата
		if (! empty($row["date"]))
		{
			echo '<div class="ads_date">'.$row["date"].'</div>';
		}

		// параметры
		if (!empty($row["param"]))
		{
			$this->get('param', 'ads', array("rows" => $row["param"], "id" => $row["id"]));
		}

		//краткое описание
		if (!empty($row["anons"]))
		{
			echo '<div class="ads_anons">';
			$this->htmleditor($row['anons']);
			echo '</div>';
		}
		echo '</td></tr></table>';
	}
	echo '</div>';
}