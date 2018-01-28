<?php
/**
 * Первая страница модуля
 *
 * Шаблон первой страницы модуля «Статьи», если в настройках модуля подключен параметр «Использовать категории»
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

if (empty($result["categories"]))
	return false;

//категории
foreach ($result["categories"] as $cat_id => $cat)
{
	echo '<div class="clauses_list">';

	//название категории
	echo '<div class="block_header">'.$cat["name"];

	//рейтинг категории
	if (! empty($cat["rating"]))
	{
		echo $cat["rating"];
	}
	echo '</div>';

	//изображения категории
	if (! empty($cat["img"]))
	{
		echo '<div class="clauses_cat_img">';
		foreach ($cat["img"] as $img)
		{
			switch($img["type"])
			{
				case 'animation':
					echo '<a href="'.BASE_PATH.$img["link"].'" rel="prettyPhoto[gallery'.$cat_id.'clauses]">';
					break;
				case 'large_image':
					echo '<a href="'.BASE_PATH.$img["link"].'" rel="large_image" width="'.$img["link_width"].'" height="'.$img["link_height"].'">';
					break;
				default:
					echo '<a href="'.BASE_PATH_HREF.$img["link"].'">';
					break;
			}
			echo '<img src="'.$img["src"].'" width="'.$img["width"].'" height="'.$img["height"].'" alt="'.$img["alt"].'" title="'.$img["title"].'">'
			.'</a> ';
		}
		echo '</div>';
	}

	//краткое описание категории
	if (! empty($cat["anons"]))
	{
		echo '<div class="clauses_cat_anons">';
		$this->htmleditor($cat['anons']);
		echo '</div>';
	}

	//подкатегории
	if (! empty($cat["children"]))
	{
		foreach ($cat["children"] as $child)
		{
			echo '<div class="clauses_cat_link">';

			//изображения подкатегории
			if (! empty($child["img"]))
			{
				echo '<div class="clauses_cat_img">';
				foreach ($child["img"] as $img)
				{
					switch($img["type"])
					{
						case 'animation':
							echo '<a href="'.BASE_PATH.$img["link"].'" rel="prettyPhoto[gallery'.$child["id"].'clauses]">';
							break;
						case 'large_image':
							echo '<a href="'.BASE_PATH.$img["link"].'" rel="large_image" width="'.$img["link_width"].'" height="'.$img["link_height"].'">';
							break;
						default:
							echo '<a href="'.BASE_PATH_HREF.$img["link"].'">';
							break;
					}
					echo '<img src="'.$img["src"].'" width="'.$img["width"].'" height="'.$img["height"].'" alt="'.$img["alt"].'" title="'.$img["title"].'">'
					.'</a> ';
				}
				echo '</div>';
			}

			//название и ссылка подкатегории
			echo '<a href="'.BASE_PATH_HREF.$child["link"].'">'.$child["name"].'</a>';

			//краткое описание подкатегории
			if (! empty($child["anons"]))
			{
				echo '<div class="clauses_cat_anons">';
				$this->htmleditor($child['anons']);
				echo '</div>';
			}
			//статьи подкатегории
			if (! empty($child["rows"]))
			{
				foreach ($child["rows"] as $row)
				{
					echo '<div class="clauses">';
			
					//изображения статьи
					if (! empty($row["img"]))
					{
						echo '<div class="clauses_img">';
						foreach ($row["img"] as $img)
						{
							switch($img["type"])
							{
								case 'animation':
									echo '<a href="'.BASE_PATH.$img["link"].'" rel="prettyPhoto[gallery'.$row["id"].'clauses]">';
									break;
								case 'large_image':
									echo '<a href="'.BASE_PATH.$img["link"].'" rel="large_image" width="'.$img["link_width"].'" height="'.$img["link_height"].'">';
									break;
								default:
									echo '<a href="'.BASE_PATH_HREF.$img["link"].'">';
									break;
							}
							echo '<img src="'.$img["src"].'" width="'.$img["width"].'" height="'.$img["height"].'" alt="'.$img["alt"].'" title="'.$img["title"].'">'
							.'</a> ';
						}
						echo '</div>';
					}
			
					//дата статьи
					if (! empty($row['date']))
					{
						echo '<div class="clauses_date">'.$row["date"]."</div>";
					}
			
					//название и ссылка статьи
					echo '<div class="clauses_name"><a href="'.BASE_PATH_HREF.$row["link"].'">'.$row["name"].'</a></div>';
			
					//анонс статьи
					if (! empty($row["anons"]))
					{
						echo '<div class="clauses_anons">';
						$this->htmleditor($row['anons']);
						echo '</div>';
					}
			
					//рейтинг статьи
					if (! empty($row["rating"]))
					{
						echo $row["rating"];
					}
			
					//теги статьи
					if (! empty($row["tags"]))
					{
						echo $row["tags"];
					}
					echo '<div class="clear"></div>';
					echo '</div>';
				}
			}
			echo '</div>';
		}
	}

	//статьи в категории
	if ($cat["rows"])
	{
		foreach ($cat["rows"] as $row)
		{
			echo '<div class="clauses">';

			//изображения статьи
			if (! empty($row["img"]))
			{
				echo '<div class="clauses_img">';
				foreach ($row["img"] as $img)
				{
					switch($img["type"])
					{
						case 'animation':
							echo '<a href="'.BASE_PATH.$img["link"].'" rel="prettyPhoto[gallery'.$row["id"].'clauses]">';
							break;
						case 'large_image':
							echo '<a href="'.BASE_PATH.$img["link"].'" rel="large_image" width="'.$img["link_width"].'" height="'.$img["link_height"].'">';
							break;
						default:
							echo '<a href="'.BASE_PATH_HREF.$img["link"].'">';
							break;
					}
					echo '<img src="'.$img["src"].'" width="'.$img["width"].'" height="'.$img["height"].'" alt="'.$img["alt"].'" title="'.$img["title"].'">'
					.'</a> ';
				}
				echo '</div>';
			}

			//дата статьи
			if (! empty($row['date']))
			{
				echo '<div class="clauses_date">'.$row["date"]."</div>";
			}

			//название и ссылка статьи
			echo '<div class="clauses_name"><a href="'.BASE_PATH_HREF.$row["link"].'">'.$row["name"].'</a></div>';

			//анонс статьи
			if (! empty($row["anons"]))
			{
				echo '<div class="clauses_anons">';
				$this->htmleditor($row['anons']);
				echo '</div>';
			}

			//рейтинг статьи
			if (! empty($row["rating"]))
			{
				echo $row["rating"];
			}

			//теги статьи
			if (! empty($row["tags"]))
			{
				echo $row["tags"];
			}
			echo '</div>';
		}
	}

	//ссылка на все статьи в категории
	if ($cat["link_all"])
	{
		echo '<div class="show_all"><a href="'.BASE_PATH_HREF.$cat["link_all"].'">'
		.$this->diafan->_('Посмотреть все статьи в категории «%s»', true, $cat["name"])
		.'</a></div>';
	}
	echo '</div>';
}