<?php
/**
 * Первая страница модуля
 *
 * Шаблон первой страницы модуля «Вопрос-Ответ»
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
	echo '<div class="faq_list">';

	//название категории
	echo '<div class="block_header">'.$cat["name"];

	//рейтинг категории
	if (! empty($cat["rating"]))
	{
		echo $cat["rating"];
	}
	echo '</div>';

	//краткое описание категории
	if (! empty($cat["anons"]))
	{
		echo '<div class="faq_cat_anons">';
		$this->htmleditor($cat['anons']);
		echo '</div>';
	}

	//подкатегории
	if (! empty($cat["children"]))
	{
		foreach ($cat["children"] as $child)
		{
			echo '<div class="faq_cat_link">';

			//название и ссылка подкатегории
			echo '<a href="'.BASE_PATH_HREF.$child["link"].'">'.$child["name"].'</a></div>';

			//краткое описание подкатегории
			if (! empty($child["anons"]))
			{
				echo '<div class="faq_cat_anons">';
				$this->htmleditor($child['anons']);
				echo '</div>';
			}
			//вопросы подкатегории
			if (! empty($child["rows"]))
			{
				foreach ($child["rows"] as $row)
				{
					echo '<div class="faq">';
			
					//дата вопроса
					if (! empty($row['date']))
					{
						echo '<div class="faq_date">'.$row["date"]."</div>";
					}
			
					//вопрос и ссылка на полную версию
					echo '<div class="faq_question">';
						echo '<a href="'.BASE_PATH_HREF.$row["link"].'">';
						$this->htmleditor($row['anons']);
						echo '</a>';
			
						//рейтинг вопроса
						if (! empty($row["rating"])) echo ' ' .$row["rating"];
					echo '</div>';
			
					//ответ
					echo '<div class="faq_answer">';
					$this->htmleditor($row['text']);
					echo '</div>';
			
					echo '</div>';
				}
				echo '<div class="clear"></div>';
			}
			echo '</div>';
		}
	}

	//вопросы в категории
	if ($cat["rows"])
	{
		foreach ($cat["rows"] as $row)
		{
			echo '<div class="faq">';

			//дата вопроса
			if (! empty($row['date']))
			{
				echo '<div class="faq_date">'.$row["date"]."</div>";
			}

			//вопрос и ссылка на полную версию
			echo '<div class="faq_question">';
				echo '<a href="'.BASE_PATH_HREF.$row["link"].'">';
				$this->htmleditor($row['anons']);
				echo '</a>';
	
				//рейтинг вопроса
				if (! empty($row["rating"]))
				{
					echo $row["rating"];
				}
			echo '</div>';

			//ответ
			echo '<div class="faq_answer">';
			$this->htmleditor($row['text']);
			echo '</div>';

			echo '</div>';
		}
	}
	//ссылка на все вопросы в категории
	if ($cat["link_all"])
	{
		echo '<div class="show_all"><a href="'.BASE_PATH_HREF.$cat["link_all"].'">'
		.$this->diafan->_('Посмотреть все вопросы в категории «%s»', true, $cat["name"])
		.'</a></div>';
	}
	echo '</div>';
}

//форма добавления вопроса
if (! empty($result["form"]))
{
	$this->get('form', 'faq', $result["form"]);
}
