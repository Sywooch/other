<?php
/**
 * Страница объявления
 * 
 * Шаблон страницы отдельного объявления
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

//вывод рейтинга объявления
if (!empty($result["rating"]))
{
	echo $this->diafan->_('Рейтинг').": ";
	echo $result["rating"];
	echo '<br><br>';
}

echo '<table class="ads_id"><tr>';

//вывод изображений объявления
if (!empty($result["img"]))
{
	echo '<td valign=top style="min-width: 160px;"><div class="ads_all_img">';
	foreach ($result["img"] as $img)
	{
		switch ($img["type"])
		{
			case 'animation':
				echo '<a href="' . BASE_PATH . $img["link"] . '" rel="prettyPhoto[gallery' . $result["id"] . 'ads]">';
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
	echo '</div></td>';
}

echo '<td valign=top>';

//дата
if (! empty($row["date"]))
{
	echo '<div class="ads_date">'.$row["date"].'</div>';
}

echo '</td><td valign=top>';

//параметры объявления
if (!empty($result["param"]))
{
	$this->get('param', 'ads', array("rows" => $result["param"], "id" => $result["id"]));
}

echo '</td><td valign=top>';

//полное описание объявления
echo '<div class="ads_text">';
$this->htmleditor($result['text']);
echo '</div>';

echo '</td></tr></table>';

//счетчик просмотров
if(! empty($result["counter"]))
{
	echo '<div class="ads_counter">'.$this->diafan->_('Просмотров').': '.$result["counter"].'</div>';
}

//теги объявления
if (!empty($result["tags"]))
{
	echo $result["tags"];
}

//комментарии
if (!empty($result["comments"]))
{
	echo $result["comments"];
}

//ссылки на предыдущее и последующее объявление
if (!empty($result["previous"]) || !empty($result["next"]))
{
	echo '<div class="previous_next_links">';
	if (!empty($result["previous"]))
	{
		echo '<div class="previous_link"><a href="' . BASE_PATH_HREF . $result["previous"]["link"] . '">&larr; ' . $result["previous"]["text"] . '</a></div>';
	}
	if (!empty($result["next"]))
	{
		echo '<div class="next_link"><a href="' . BASE_PATH_HREF . $result["next"]["link"] . '">' . $result["next"]["text"] . ' &rarr;</a></div>';
	}
	echo '</div>';
}

//форма добавления объявления
if (! empty($result["form"]))
{
	$this->get('form', 'ads', $result["form"]);
}