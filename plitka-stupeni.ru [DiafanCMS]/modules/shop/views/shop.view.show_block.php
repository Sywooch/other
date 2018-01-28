<?php
/**
 * Блок товаров
 *
 * Шаблон
 * шаблонного тега <insert name="show_block" module="shop" [count="количество"]
 * [cat_id="категория"] [site_id="страница_с_прикрепленным_модулем"]
 * [images="количество_изображений"] [images_variation="тег_размера_изображений"]
 * [sort="порядок_вывода"] [param="дополнительные_условия"]
 * [hits_only="только_хиты"] [action_only="только акции"] [new_only="только_новинки"]
 * [only_shop="выводить_только_на_странице_модуля"] [template="шаблон"]>:
 * блок товаров
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
{
	return false;
}

echo '<div class="shop_block">';

//заголовок блока
if (!empty($result["name"]))
{
	echo '<div class="block_header">' . $result["name"] . '</div>';
}

//товары в разделе
if (!empty($result["rows"]))
{
	foreach ($result["rows"] as $row)
	{
		echo '<div class="shop">';

		//название и ссылка товара
		echo '<div class="shop_name"><a href="' . BASE_PATH_HREF . $row["link"] . '">' . $row["name"] . '</a></div>';

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

		//артикул
		if (!empty($row["article"]))
		{
			echo '<div class="shop_article">' . $this->diafan->_('Артикул') . ': <span class="shop_article_value">' . $row["article"] . '</span></div>';
		}

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

		//краткое описание товара
		if (!empty($row["anons"]))
		{
			echo '<div class="shop_anons">';
			$this->htmleditor($row['anons']);
			echo '</div>';
		}

		//скидка на товар
		if (!empty($row["discount"]))
		{
			echo '<div class="shop_discount">' . $this->diafan->_('Скидка') . ': <span class="shop_discount_value">' . $row["discount"] . ' %' . ($row["discount_finish"] ? ' (' . $this->diafan->_('до') . ' ' . $row["discount_finish"] . ')' : '') . '</span></div>';
		}

		//кнопка "Купить"
		$this->get('buy_form', 'shop', array("row" => $row, "result" => $result));
		echo '</div>';
	}
}

//ссылка на все товары
if (!empty($result["link_all"]))
{
	echo '<div class="show_all"><a href="' . BASE_PATH_HREF . $result["link_all"] . '">';
	if ($result["category"])
	{
		echo $this->diafan->_('Посмотреть все товары в категории «%s»', true, $result["name"]);
	}
	else
	{
		echo $this->diafan->_('Все товары');
	}
	echo '</a></div>';
}

echo '</div>';