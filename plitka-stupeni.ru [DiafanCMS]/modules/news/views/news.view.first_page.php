<?php
/**
 * Первая страница модуля
 *
 * Шаблон первой страницы модуля «Новости», если подключен параметр «Использовать категории».
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

if (!empty($result["categories"]))
{
	//вывод категории
	foreach ($result["categories"] as $cat_id => $cat)
	{
		echo '<div class="news_list">';

		//вывод названия категории новостей
		echo '<div class="block_header"><a href="'.BASE_PATH_HREF.$cat["link_all"].'">'.$cat["name"].'</a>';

		//рейтинг категории
		if (! empty($cat["rating"]))
		{
			echo $cat["rating"];
		}
		echo '</div>';

		//вывод изображений категории
		if (! empty($cat["img"]))
		{
			echo '<div class="news_cat_img">';
			foreach ($cat["img"] as $img)
			{
				switch($img["type"])
				{
					case 'animation':
						echo '<a href="'.BASE_PATH.$img["link"].'" rel="prettyPhoto[gallery'.$cat_id.'news]">';
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

		//вывод краткого описания категории
		if (! empty($cat["anons"]))
		{
			echo '<div class="news_cat_anons">';
			$this->htmleditor($cat['anons']);
			echo '</div>';
		}

		//вывод подкатегории
		if (! empty($cat["children"]))
		{
			foreach ($cat["children"] as $child)
			{
				echo '<div class="news_cat_link">';

				//изображения подкатегории
				if (! empty($child["img"]))
				{
					echo '<div class="news_cat_img">';
					foreach ($child["img"] as $img)
					{
						switch($img["type"])
						{
							case 'animation':
								echo '<a href="'.BASE_PATH.$img["link"].'" rel="prettyPhoto[gallery'.$child["id"].'news]">';
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
					echo '<div class="news_cat_anons">';
					$this->htmleditor($child['anons']);
					echo '</div>';
				}
				//новости подкатегории
				if (! empty($child["rows"]))
				{
					foreach ($child["rows"] as $row)
					{
						echo '<div class="news">';
				
						//вывод даты новости
						if (! empty($row['date']))
						{
							echo '<div class="news_date">'.$row["date"]."</div>";
						}
				
						//вывод названия и ссылки на новость
						echo '<div class="news_name">';
						echo '<a href="'.BASE_PATH_HREF.$row["link"].'">'.$row["name"].'</a>';
							//вывод рейтинга новости за названием, если рейтинг подключен
							if (! empty($row["rating"])) echo ' ' .$row["rating"];
						echo '</div>';
				
						//вывод изображений новости
						if (! empty($row["img"]))
						{
							echo '<div class="news_img">';
							foreach ($row["img"] as $img)
							{
								switch($img["type"])
								{
									case 'animation':
										echo '<a href="'.BASE_PATH.$img["link"].'" rel="prettyPhoto[gallery'.$row["id"].'news]">';
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
				
						//вывод анонса новостей
						if (! empty($row["anons"]))
						{
							echo '<div class="news_anons">';
							$this->htmleditor($row['anons']);
							echo '</div>';
						}
				
				
						//вывод прикрепленных тегов к новости
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

		//вывод нескольких новостей из категории
		if ($cat["rows"])
		{
			foreach ($cat["rows"] as $row)
			{
				echo '<div class="news">';

				//вывод даты новости
				if (! empty($row['date']))
				{
					echo '<div class="news_date">'.$row["date"]."</div>";
				}

				//вывод названия и ссылки на новость
				echo '<div class="news_name">';
				echo '<a href="'.BASE_PATH_HREF.$row["link"].'">'.$row["name"].'</a>';
					//вывод рейтинга новости за названием, если рейтинг подключен
					if (! empty($row["rating"])) echo ' ' .$row["rating"];
				echo '</div>';

				//вывод изображений новости
				if (! empty($row["img"]))
				{
					echo '<div class="news_img">';
					foreach ($row["img"] as $img)
					{
						switch($img["type"])
						{
							case 'animation':
								echo '<a href="'.BASE_PATH.$img["link"].'" rel="prettyPhoto[gallery'.$row["id"].'news]">';
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

				//вывод анонса новости
				if (! empty($row["anons"]))
				{
					echo '<div class="news_anons">';
					$this->htmleditor($row['anons']);
					echo '</div>';
				}					

				//теги новости
				if (! empty($row["tags"]))
				{
					echo $row["tags"];
				}

				echo '</div>';
			}
		}
		//ссылка на все новости в категории
		if ($cat["link_all"])
		{
			echo  '<div class="show_all"><a href="'.BASE_PATH_HREF.$cat["link_all"].'">'
			.$this->diafan->_('Посмотреть все новости в категории «%s»', true, $cat["name"])
			.'</a></div>';
		}
		echo '</div>';
	}
}

//вывод новостей, которые не принадлежат никаким категориям
if (! empty($result["rows"]))
{
	echo '<br></br>';
	foreach ($result["rows"] as $row)
	{
		echo '<div class="news">';

		//дата новости
		if (! empty($row['date']))
		{
			echo '<div class="news_date">'.$row["date"]."</div>";
		}

		//вывод названия и ссылки на новость
		echo '<div class="news_name">';
		echo '<a href="'.BASE_PATH_HREF.$row["link"].'">'.$row["name"].'</a>';
			//вывод рейтинга новости за названием, если рейтинг подключен
			if (! empty($row["show_rating"])) echo ' ' .$row["show_rating"];
		echo '</div>';

		//изображения новости
		if (! empty($row["img"]))
		{
			echo '<div class="news_img">';
			foreach ($row["img"] as $img)
			{
				switch($img["type"])
				{
					case 'animation':
						echo '<a href="'.BASE_PATH.$img["link"].'" rel="prettyPhoto[gallery'.$row["id"].'news]">';
						break;
					case 'big_image':
						echo '<a href="'.BASE_PATH.$img["link"].'" rel="big_image" width="'.$img["link_width"].'" height="'.$img["link_height"].'">';
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

		//анонс новости
		if (! empty($row["anons"]))
		{
			echo '<div class="news_anons">';
			$this->htmleditor($row['anons']);
			echo '</div>';
		}

		//теги новости
		if (! empty($row["tags"]))
		{
			echo $row["tags"];
		}

		echo '</div>';
	}
	echo '<div class="clear"></div>';
}

//постраничная навигация
if (! empty($result["paginator"]))
{
	echo $result["paginator"];
}