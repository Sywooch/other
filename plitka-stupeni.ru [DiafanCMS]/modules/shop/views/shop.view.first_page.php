<?php
/**
 * Первая страница модуля
 * 
 * Функция вывода первой страницы магазина, где все категории и несколько товаров из каждой категории
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

if (empty($result["categories"]))
	return false;

//начало большого цикла, вывод категорий и товаров в них
foreach ($result["categories"] as $cat_id => $cat)
{
	echo '<div class="shop_list">';

	//вывод названия категории
	echo '<div class="block_header">' . $cat["name"];

	//рейтинг категории
	if (! empty($cat["rating"]))
	{
		echo $cat["rating"];
	}
	echo '</div>';

	//вывод изображений категории
	if (!empty($cat["img"]))
	{
		echo '<div class="shop_cat_img">';
		foreach ($cat["img"] as $img)
		{
			switch ($img["type"])
			{
				case 'animation':
					echo '<a href="' . BASE_PATH . $img["link"] . '" rel="prettyPhoto[gallery' . $cat_id . 'shop]">';
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

	//краткое описание категории
	if (!empty($cat["anons"]))
	{
		echo '<div class="shop_cat_anons">';
		$this->htmleditor($cat['anons']);
		echo '</div>';
	}

	//подкатегории
	if (!empty($cat["children"]))
	{
		foreach ($cat["children"] as $child)
		{
			echo '<div class="shop_cat_link">';

			//изображения подкатегории
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
			if (!empty($child["anons"]))
			{
				echo '<div class="shop_cat_anons">';
				$this->htmleditor($child['anons']);
				echo '</div>';
			}

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
			echo '</div>';
		}
	}

	//вывод товаров в категории
	if (!empty($cat["rows"]))
	{
		foreach ($cat["rows"] as $row)
		{
			echo '<table class="shop"><tr><td colspan=2 valign=top>';

			//вывод названия и ссылки на товар
			echo '<div class="shop_name">';
			echo '<a href="' . BASE_PATH_HREF . $row["link"] . '">' . $row["name"] . '</a>';
			//рейтинг товара
			if (!empty($row["rating"]))
				echo ' ' . $row["rating"];
			echo '</div>';

			//вывод артикула товара
			if (!empty($row["article"]))
			{
				echo '<div class="shop_article">';
				echo $this->diafan->_('Артикул') . ':'; //вывод слова "Артикул" из языковой переменной
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
					echo '<img src="' . $img["src"] . '" width="' . $img["width"] . '" height="' . $img["height"] . '" alt="' . $img["alt"] . '" title="' . $img["title"] . '">'
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

			echo '</td></tr></table>';
		}
	}

	//ссылка на все товары в категории
	if ($cat["link_all"])
	{
		echo '<div class="show_all"><a href="' . BASE_PATH_HREF . $cat["link_all"] . '">'
		. $this->diafan->_('Посмотреть все товары в категории «%s»', true, $cat["name"])
		. '</a></div>';
	}
	echo '</div>';
}