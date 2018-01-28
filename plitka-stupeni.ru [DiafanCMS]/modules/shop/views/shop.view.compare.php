<?php
/**
 * Сравнение товаров
 *
 * Шаблон страницы сравнения товаров
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

if (empty($result['rows']))
{
	echo $this->diafan->_('Не выбраны товары для сравнения.');
	return;
}

echo '<script type="text/javascript" src="' . BASE_PATH . 'modules/shop/shop.compare.js"></script>
<script type="text/javascript" src="' . BASE_PATH . 'js/jcarousellite_1.0.1.min.js"></script>';

echo '
<div class="shop_compare_page">
	<div class="shop_compare_left">
		<div class="shop_compare_description">
			<h3>' . $this->diafan->_('Сравнение товаров') . '</h3>
			<div><a href="#" class="compare_all">' . $this->diafan->_('Все параметры') . '</a></div>
			<div><a href="#" class="compare_difference">' . $this->diafan->_('Только отличающиеся') . '</a></div>
		</div>';

if (!empty($result['existed_params']))
{
	echo '<div class="shop_existed_params">';

	foreach ($result['existed_params'] as $param)
	{
		echo '<div class="shop_param_existed param_id_' . $param['id'] . ' '
		. (in_array($param['id'], $result["param_differences"]) ? ' shop_param_difference ' : '')
		. '">' . $param['name'] . '</div>';
	}

	echo '</div>';
}

echo '
		</div>
		<div class="shop_compare_list">
		<div class="carousel default">

			<div class="jCarouselLite">
			<ul>';

foreach ($result["rows"] as $row)
{
	echo '<li class="shop shop_compared_goods_' . $row["id"] . '">
			<div class="shop_basic">
				<div class="shop_name">
				<a href="' . BASE_PATH_HREF . $row["link"] . '">' . $row["name"] . '</a>
				</div>';

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
			echo '<img src="' . $img["src"] . '" width="' . $img["width"] . '" height="' . $img["height"] . '" alt="' . $img["alt"] . '" title="' . $img["title"] . '">'
			. '</a> ';
		}
		echo '</div>';
	}

	if (!empty($row["article"]))
	{
		echo '<div class="shop_article">' . $this->diafan->_('Артикул')
		. ': <span class="shop_article_value">' . $row["article"] . '</span></div>';
	}

	if (!empty($row["discount"]))
	{
		echo '<div class="shop_discount">' . $this->diafan->_('Скидка')
		. ': <span class="shop_discount_value">' . $row["discount"] . ' %'
		. ($row["discount_finish"] ? ' (' . $this->diafan->_('до') . ' ' . $row["discount_finish"] . ')' : '')
		. '</span></div>';
	}

	$this->get('buy_form', 'shop', array("row" => $row, "result" => $result));

	echo '</div>';
	echo '<div class="shop_compare_param">';
		$this->get('compare_param', 'shop', array("params" => $row["param"], "id" => $row["id"], "existed_params" => $result['existed_params'], "param_differences" => $result["param_differences"]));
	echo '</div>';

	echo '</li>';
}

echo '     </ul>
		</div>';
if (count($result['rows']) > 3)
{
	echo '<span class="button_wrap"><button class="prev button">&#171;</button></span><span class="button_wrap"><button class="next button">&#187;</button></span>';
}

echo '<div class="clear"></div>';
echo '</div>
</div>
</div>';


echo '
<form method="POST" action="" class="shop_compare_form ajax">
<input type="hidden" name="ajax" value="">
<input type="hidden" name="module" value="shop">
<input type="hidden" name="action" value="compare_delete_goods">
<span class="button_wrap">
<input type="submit" value="' . $this->diafan->_('Очистить список сравнения', false) . '" class="button">
</span>
</form>';