<?php
/**
 * Блок объявлений
 * 
 * Шаблон
 * шаблонного тега <insert name="show_block" module="ads" [count="количество"]
 * [cat_id="категория"] [site_id="страница_с_прикрепленным_модулем"]
 * [images="количество_изображений"] [images_variation="тег_размера_изображений"]
 * [sort="порядок_вывода"] [param="дополнительные_условия"]
 * [only_ads="выводить_только_на_странице_модуля"] [template="шаблон"]>:
 * блок объявлений
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

if (empty($result["rows"]))
	return false;

echo '<div class="ads_block">';

//заголовок блока
if (!empty($result["name"]))
{
	echo '<div class="block_header">' . $result["name"] . '</div>';
}

//объявления
if (!empty($result["rows"]))
{
	foreach ($result["rows"] as $row)
	{
		echo '<div class="ads">';

		//дата
		if (! empty($row["date"]))
		{
			echo '<div class="ads_date">'.$row["date"].'</div>';
		}
		
		//название и ссылка
		echo '<div class="ads_name"><a href="' . BASE_PATH_HREF . $row["link"] . '">' . $row["name"] . '</a></div>';

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

		// параметры товара
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
		echo '</div>';
	}
}

//ссылка на все объявления
if (!empty($result["link_all"]))
{
	echo '<div class="show_all"><a href="' . BASE_PATH_HREF . $result["link_all"] . '">';
	if ($result["category"])
	{
		echo $this->diafan->_('Посмотреть все объявления в категории «%s»', true, $result["name"]);
	}
	else
	{
		echo $this->diafan->_('Все объявления');
	}
	echo '</a></div>';
}

echo '</div>';