<?php
/**
 * Список вопросов
 *
 * Шаблон списка вопросов и ответов
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

echo '<div class="faq_list">';

//описание текущей категории
if (! empty($result["text"]))
{
	echo '<div class="faq_cat_text">';
	$this->htmleditor($result['text']);
	echo '</div>';
}

//рейтинг категории
if (! empty($result["rating"]))
{
	echo $result["rating"];
}

//подкатегории
if (! empty($result["children"]))
{
	foreach ($result["children"] as $child)
	{
		echo '<div class="faq_cat_link">';

		//название и ссылка подкатегории
		echo '<a href="'.BASE_PATH_HREF.$child["link"].'">'.$child["name"].'</a>';

		//краткое описание подкатегории
		if ($child["anons"])
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

//комментарии к категориям
if (! empty($result["comments"]))
{
	echo $result["comments"];
}

//вопросы
if (! empty($result["rows"]))
{
	foreach ($result["rows"] as $row)
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

//постраничная навигация
if (! empty($result["paginator"]))
{
	echo $result["paginator"];
}

//ссылки на предыдущую и последующую категории
if (! empty($result["previous"]) || ! empty($result["next"]))
{
	echo '<div class="previous_next_links">';
	if (! empty($result["previous"]))
	{
		echo '<div class="previous_link"><a href="'.BASE_PATH_HREF.$result["previous"]["link"].'">&larr; '.$result["previous"]["text"].'</a></div>';
	}
	if (! empty($result["next"]))
	{
		echo '<div class="next_link"><a href="'.BASE_PATH_HREF.$result["next"]["link"].'">'.$result["next"]["text"].' &rarr;</a></div>';
	}
	echo '</div>';
}

//форма добавления вопроса
if (! empty($result["form"]))
{
	$this->get('form', 'faq', $result["form"]);
}

echo '</div>';