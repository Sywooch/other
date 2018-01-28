<?php
/**
 * Список объявлений
 *
 * Шаблон вывода списка объявлений
 * в категории объявлений, в результатах поиска или если группировка не используется
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
	echo '<div class="ads_list">';
}

//вывод описания текущей категории
if (!empty($result["text"]))
{
	echo '<div class="ads_cat_text">';
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
	echo '<div class="ads_cat_all_img">';
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
	echo '</div>';
}

//вывод подкатегории
if (!empty($result["children"]))
{
	foreach ($result["children"] as $child)
	{
		echo '<div class="ads_cat_link">';

		//вывод изображений подкатегории
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
		if ($child["anons"])
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

//вывод списка объявлений
if (!empty($result["rows"]))
{
	//вывод сортировки объявлений
	if(! empty($result["link_sort"]))
	{
		$this->get('sort_block', 'ads', $result);
	}

	foreach ($result["rows"] as $row)
	{
		echo '<table class="ads"><tr>
			<td valign=top width="5%">';
			//дата
			if (! empty($row["date"]))
			{
				echo '<div class="ads_date">'.$row["date"].'</div>';
			}
			
			echo '</td><td valign=top width="30%">';
			
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
	echo '<div class="clear"></div>';
}

//постраничная навигация
if (!empty($result["paginator"]))
{
	echo $result["paginator"];
}

//вывод комментариев ко всей категории объявлений (комментарии к конкретному товару в функции id())
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

	//форма добавления объявления
	if (! empty($result["form"]))
	{
		$this->get('form', 'ads', $result["form"]);
	}
}