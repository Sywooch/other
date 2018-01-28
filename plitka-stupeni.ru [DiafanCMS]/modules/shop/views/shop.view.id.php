<?php
/**
 * Страница товара
 *
 * Шаблон страницы отдельного товара
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
    include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}

echo '<table class="shop_id"><tr><td valign=top style="min-width: 160px;">';

//вывод артикула
if (!empty($result["article"]))
{
	echo '<div class="shop_article">' . $this->diafan->_('Артикул') . ': <span class="shop_article_value">' . $result["article"] . '</span></div>';
}

//вывод изображений товара
if (!empty($result["img"]))
{
	echo '<div class="shop_all_img">';
	foreach ($result["img"] as $img)
	{
		switch ($img["type"])
		{
			case 'animation':
				echo '<a href="' . BASE_PATH . $img["link"] . '" rel="prettyPhoto[gallery' . $result["id"] . 'shop]">';
				break;
			case 'large_image':
				echo '<a href="' . BASE_PATH . $img["link"] . '" rel="large_image" width="' . $img["link_width"] . '" height="' . $img["link_height"] . '">';
				break;
			default:
				echo '<a href="' . BASE_PATH_HREF . $img["link"] . '">';
				break;
		}
		echo '<img src="' . $img["src"] . '" width="' . $img["width"] . '" height="' . $img["height"] . '" alt="' . $img["alt"] . '" title="' . $img["title"] . '" image_id="'.$img["id"].'">'
		. '</a> ';
	}
	echo '</div>';
}

//вывод рейтинга товара
if (!empty($result["rating"]))
{
	echo $this->diafan->_('Рейтинг').": ";
	echo $result["rating"];
	echo '<br><br>';
}

echo '</td><td valign=top width="90%">';

//скидка на товар
if (!empty($result["discount"]))
{
	echo '<div class="shop_discount">' . $this->diafan->_('Скидка') . ': <span class="shop_discount_value">' . $result["discount"] . ' %' . ($result["discount_finish"] ? ' (' . $this->diafan->_('до') . ' ' . $result["discount_finish"] . ')' : '') . '</span></div>';
}
//кнопка "Купить"
$this->get('buy_form', 'shop', array("row" => $result, "result" => $result));

if (!empty($result['hit']))
{
	echo '<div class="shop_hit">' . $this->diafan->_('Хит!') . '</div>';
}
if (!empty($result['action']))
{
	echo '<div class="shop_action">' . $this->diafan->_('Акция!') . '</div>';
}
if (!empty($result['new']))
{
	echo '<div class="shop_new">' . $this->diafan->_('Новинка!') . '</div>';
}

//параметры товара
if (!empty($result["param"]))
{
	$this->get('param', 'shop', array("rows" => $result["param"], "id" => $result["id"]));
}

//краткое описание товара
if ($result['anons'])
{
	echo '<div class="shop_anons">';
	$this->htmleditor($result['anons']);
	echo '</div>';
}

//полное описание товара
echo '<div class="shop_text">';
$this->htmleditor($result['text']);
echo '</div>';

//счетчик просмотров
if(! empty($result["counter"]))
{
	echo '<div class="shop_counter">'.$this->diafan->_('Просмотров').': '.$result["counter"].'</div>';
}

//теги товара
if (!empty($result["tags"]))
{
	echo $result["tags"];
}

echo '</td></tr></table>';

//комментарии к товару
if (!empty($result["comments"]))
{
	echo $result["comments"];
}

//ссылки на предыдущий и последующий товар
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