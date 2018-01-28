<?php
/**
 * Первая страница модуля
 * 
 * Шаблон вывода первой страницы модуля, где все категории и несколько объявлений из каждой категории
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

//начало большого цикла, вывод категорий и объявлений в них
foreach ($result["categories"] as $cat_id => $cat)
{
	echo '<div class="ads_list">';

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
		echo '<div class="ads_cat_img">';
		foreach ($cat["img"] as $img)
		{
			switch ($img["type"])
			{
				case 'animation':
					echo '<a href="' . BASE_PATH . $img["link"] . '" rel="prettyPhoto[gallery' . $cat_id . 'ads]">';
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
		echo '<div class="ads_cat_anons">';
		$this->htmleditor($cat['anons']);
		echo '</div>';
	}

	//подкатегории
	if (!empty($cat["children"]))
	{
		foreach ($cat["children"] as $child)
		{
			echo '<div class="ads_cat_link">';

			//изображения подкатегории
			if (!empty($child["img"]))
			{
				echo '<div class="ads_cat_img">';
				foreach ($child["img"] as $img)
				{
					switch ($img["type"])
					{
						case 'animation':
							echo '<a href="' . BASE_PATH . $img["link"] . '" rel="prettyPhoto[gallery' . $child["id"] . 'ads]">';
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
				echo '<div class="ads_cat_anons">';
				$this->htmleditor($child['anons']);
				echo '</div>';
			}

			//вывод списка объявлений подкатегории
			if (!empty($child["rows"]))
			{
				//вывод сортировки объявлений
				if(! empty($child["link_sort"]))
				{
					$this->get('sort_block', 'ads', $result);
				}
			
				foreach ($child["rows"] as $row)
				{
					echo '<table class="ads"><tr><td colspan=2 valign=top>';
			
					//вывод названия и ссылки
					echo '<div class="ads_name">';
					echo '<a href="' . BASE_PATH_HREF . $row["link"] . '">' . $row["name"] . '</a>';
					//рейтинг объявления
					if (!empty($row["rating"]))
					{
						echo ' ' . $row["rating"];
					}
					echo '</div>';
			
					echo '</td></tr><tr><td valign=top width=5%>';
			
					//вывод изображений объявления
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
			
					//вывод параметров объявления
					if (!empty($row["param"]))
					{
						$this->get('param', 'ads', array("rows" => $row["param"], "id" => $row["id"]));
					}
					//вывод краткого описания объявления
					if (!empty($row["anons"]))
					{
						echo '<div class="ads_anons">';
						$this->htmleditor($row['anons']);
						echo '</div>';
					}
					echo '</td></tr></table>';
				}
				echo '<div class="clear"></div>';
			}
			echo '</div>';
		}
	}

	//вывод объявлений в категории
	if (!empty($cat["rows"]))
	{
		foreach ($cat["rows"] as $row)
		{
			echo '<table class="ads"><tr>
			<td valign=top>';
			//дата
			if (! empty($row["date"]))
			{
				echo '<div class="ads_date">'.$row["date"].'</div>';
			}
			
			echo '</td><td valign=top>';
			
			//вывод названия и ссылки
			echo '<div class="ads_name">';
			echo '<a href="' . BASE_PATH_HREF . $row["link"] . '">' . $row["name"] . '</a>';
			//рейтинг объявления
			if (!empty($row["rating"]))
			{
				echo ' ' . $row["rating"];
			}
			echo '</div>';
			if (!empty($row["anons"]))
			{
				echo '<div class="ads_anons">';
				$this->htmleditor($row['anons']);
				echo '</div>';
			}

			echo '</td>';

			//вывод изображений объявления
			if (!empty($row["img"]))
			{
				echo '<td valign=top><div class="ads_img">';
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
				echo '</div></td>';
			}

			echo '</td><td valign=top>';

			//вывод параметров объявления
			if (!empty($row["param"]))
			{
				$this->get('param', 'ads', array("rows" => $row["param"], "id" => $row["id"]));
			}
			
			echo '</td></tr></table>';
		}
	}

	//ссылка на все объявления в категории
	if ($cat["link_all"])
	{
		echo '<div class="show_all"><a href="' . BASE_PATH_HREF . $cat["link_all"] . '">'
		. $this->diafan->_('Посмотреть все объявления в категории «%s»', true, $cat["name"])
		. '</a></div>';
	}
	echo '</div>';
}

//форма добавления объявления
if (! empty($result["form"]))
{
	$this->get('form', 'ads', $result["form"]);
}