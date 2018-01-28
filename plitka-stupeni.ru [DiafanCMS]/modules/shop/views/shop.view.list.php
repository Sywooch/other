<?php
/**
 * Список товаров
 *
 * Шаблон вывода списка товаров 
 * в группе товаров, в результатах поиска или если группировка не используется
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

if(empty($result["ajax"]))
{
	echo '<div class="shop_list">';
}

//вывод описания текущей категории
if (!empty($result["text"]))
{
	echo '<div class="shop_cat_text">';
	$this->htmleditor($result['text']);
	echo '</div>';
}

//рейтинг категории
if (! empty($result["rating"]))
{
	echo $result["rating"];
}

//вывод изображений текущей категории
if (!empty($result["img"]))
{
	echo '<div class="shop_cat_all_img">';
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
		echo '<img src="' . $img["src"] . '" width="' . $img["width"] . '" height="' . $img["height"] . '" alt="' . $img["alt"] . '" title="' . $img["title"] . '">'
		. '</a> ';
	}
	echo '</div>';
}

//вывод подкатегории
if (!empty($result["children"]))
{
	foreach ($result["children"] as $child)
	{
		echo '<div class="shop_cat_link">';

		//вывод изображений подкатегории
		if (!empty($child["img"]))
		{
			echo '<div class="shop_cat_img">';
			foreach ($child["img"] as $img)
			{
				switch ($img["type"])
				{
					case 'animation':
						echo '<a href="' . BASE_PATH . $img["link"] . '" rel="prettyPhoto[gallery' . $child["id"] . 'shop]">';
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

		//название и ссылка подкатегории
		echo '<a href="' . BASE_PATH_HREF . $child["link"] . '">' . $child["name"] . '</a>';

		//краткое описание подкатегории
		if ($child["anons"])
		{
			echo '<div class="shop_cat_anons">';
			$this->htmleditor($child['anons']);
			echo '</div>';
		}
		echo '</div>';

		//вывод списка товаров подкатегории
		if (!empty($child["rows"]))
		{
			//вывод сортировки товаров
			if(! empty($child["link_sort"]))
			{
				$this->get('sort_block', 'shop', $result);
			}
		
			foreach ($child["rows"] as $row)
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
					echo $this->diafan->_('Артикул') . ':';
					echo '<span class="shop_article_value">' . $row["article"] . '</span>';
					echo '</div>';
				}
		
				echo '</td></tr><tr><td valign=top width=5%>';
		
				//вывод изображений товара
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
		
				//вывод параметров товара
				if (!empty($row["param"]))
				{
					$this->get('param', 'shop', array("rows" => $row["param"], "id" => $row["id"]));
				}
		
				//вывод скидки на товар
				if (!empty($row["discount"]))
				{
					echo '<div class="shop_discount">' . $this->diafan->_('Скидка') . ': <span class="shop_discount_value">' . $row["discount"] . ' %' . ($row["discount_finish"] ? ' (' . $this->diafan->_('до') . ' ' . $row["discount_finish"] . ')' : '') . '</span></div>';
				}
		
				//вывод краткого описания товара
				if (!empty($row["anons"]))
				{
					echo '<div class="shop_anons">';
					$this->htmleditor($row['anons']);
					echo '</div>';
				}
		
				//вывод кнопки "Купить"
				$this->get('buy_form', 'shop', array("row" => $row, "result" => $result));
		
				$this->get('compare_form', 'shop', $row);
				echo '</td></tr></table>';
			}
			echo '<div class="clear"></div>';
		}
	}
}

//вывод списка товаров
if (!empty($result["rows"]))
{
	//вывод сортировки товаров
	if(! empty($result["link_sort"]))
	{
		$this->get('sort_block', 'shop', $result);
	}

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
			echo $this->diafan->_('Артикул') . ':';
			echo '<span class="shop_article_value">' . $row["article"] . '</span>';
			echo '</div>';
		}

		echo '</td></tr><tr><td valign=top width=5%>';

		//вывод изображений товара
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

		//вывод параметров товара
		if (!empty($row["param"]))
		{
			$this->get('param', 'shop', array("rows" => $row["param"], "id" => $row["id"]));
		}

		//вывод скидки на товар
		if (!empty($row["discount"]))
		{
			echo '<div class="shop_discount">' . $this->diafan->_('Скидка') . ': <span class="shop_discount_value">' . $row["discount"] . ' %' . ($row["discount_finish"] ? ' (' . $this->diafan->_('до') . ' ' . $row["discount_finish"] . ')' : '') . '</span></div>';
		}

		//вывод краткого описания товара
		if (!empty($row["anons"]))
		{
			echo '<div class="shop_anons">';
			$this->htmleditor($row['anons']);
			echo '</div>';
		}

		//вывод кнопки "Купить"
		$this->get('buy_form', 'shop', array("row" => $row, "result" => $result));

		if(empty($row["hide_compare"]))
		{
		    $this->get('compare_form', 'shop', $row);
		}
		echo '</td></tr></table>';
	}
	echo '<div class="clear"></div>';
}

if (!empty($result["rows"]) && isset($result['shop_link']))
{
	$this->get('compared_goods_list', 'shop', array("site_id" => $this->diafan->cid, "shop_link" => $result['shop_link']));
}

//постраничная навигация
if (!empty($result["paginator"]))
{
	echo $result["paginator"];
}

//вывод комментариев ко всей категории товаров (комментарии к конкретному товару в функции id())
if (!empty($result["comments"]))
{
	echo $result["comments"];
}

//ссылки на предыдущую и последующую категории
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

if(empty($result["ajax"]))
{
	echo '</div>';
}