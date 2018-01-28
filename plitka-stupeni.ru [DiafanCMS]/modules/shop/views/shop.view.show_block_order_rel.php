<?php
/**
 * Блок товаров, которые обычно покупают с текущим товаром
 *
 * Шаблон
 * шаблонного тега <insert name="show_block" module="shop" [count="количество"]
 * [images="количество_изображений"] [images_variation="тег_размера_изображений"]
 * [template="шаблон"]>:
 * блок товаров, которые обычно покупают с текущим товаром
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
	echo '<div class="block_header">' . $this->diafan->_('С этим товаром обычно покупают') . '</div>
	<div class="shop_rel">';
	foreach ($result["rows"] as $row)
	{
		echo '<table class="shop"><tr><td colspan=2 valign=top>';

		//вывод названия и ссылки на товара
		echo '<div class="shop_name">';
		echo '<a href="' . BASE_PATH_HREF . $row["link"] . '">' . $row["name"] . '</a>';
		//рейтинг товара
		if (!empty($row["rating"]))
			echo ' ' . $row["rating"];
		echo '</div>';

		//вывод артикула
		if (!empty($row["article"]))
		{
			echo '<div class="shop_article">';
			echo $this->diafan->_('Артикул') . ':'; //вывод слова "Артикул" из языковой переменной
			echo '<span class="shop_article_value">' . $row["article"] . '</span>';
			echo '</div>';
		}

		echo '</td></tr><tr><td valign=top>';

		//изображения товара
		if (!empty($row["img"]))
		{
			echo '<div class="shop_img">';
			foreach ($row["img"] as $img)
			{
				switch ($img["type"])
				{
					case 'animation':
						echo '<a href="' . BASE_PATH . $img["link"] . '" rel="prettyPhoto[gallery' . $row["id"] . 'shop]">';
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

		echo '</td>';
		echo '<td valign=top>';

		if (!empty($row['hit']))
		{
			echo '<div class="shop_hit">' . $this->diafan->_('Хит!') . '</div>';
		}
		if (!empty($row['action']))
		{
			echo '<div class="shop_action">' . $this->diafan->_('Акция!') . '</div>';
		}
		if (!empty($row['new']))
		{
			echo '<div class="shop_new">' . $this->diafan->_('Новинка!') . '</div>';
		}

		// параметры товара
		if (!empty($row["param"]))
		{
			$this->get('param', 'shop', array("rows" => $row["param"], "id" => $row["id"]));
		}

		//скидка на товар
		if (!empty($row["discount"]) && !empty($result['discount']))
		{
			echo '<div class="shop_discount">' . $this->diafan->_('Скидка') . ': <span class="shop_discount_value">' . $result["discount"] . ' %' . ($result["discount_finish"] ? ' (' . $this->diafan->_('до') . ' ' . $result["discount_finish"] . ')' : '') . '</span></div>';
		}

		//краткое описание товара
		if (!empty($row["anons"]))
		{
			echo '<div class="shop_anons">';
			$this->htmleditor($row['anons']);
			echo '</div>';
		}

		//кнопка "Купить"
		$this->get('buy_form', 'shop', array("row" => $row, "result" => $result));

		echo '</td></tr></table>';
	}
	echo '</div>';
}