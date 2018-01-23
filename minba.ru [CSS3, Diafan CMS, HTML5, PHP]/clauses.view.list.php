<?php
/**
 * Шаблон списока статей
 * 
 * Шаблон вывода списка статей в том случае, если в настройках модуля отключен параметр «Использовать категории»
 * 
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    5.4
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2015 OOO «Диафан» (http://www.diafan.ru/)
 */

if (! defined('DIAFAN'))
{
	$path = __FILE__; $i = 0;
	while(! file_exists($path.'/includes/404.php'))
	{
		if($i == 10) exit; $i++;
		$path = dirname($path);
	}
	include $path.'/includes/404.php';
}




echo '<div class="clauses_list tmp1">';

//описание текущей категории
if (! empty($result["text"]))
{
	echo '<div class="clauses_cat_text">'.$result['text'].'</div>';
}


//вывод списка новостей
//print_r($result["rows"]);
if (! empty($result["rows"]))
{
	foreach ($result["rows"] as $row)
	{		           
		echo '<div class="article">';

		//вывод изображений новости
		if (! empty($row["img"]))
		{			
			foreach ($row["img"] as $img)
			{
				echo '<div class="left"><img src="'.$img["src"].'" width="'.$img["width"].'" height="'.$img["height"].'" alt="'.$img["alt"].'" title="'.$img["title"].'"></div>';
				
			}			
		}

			

		echo '<div class="right">';
		       
	        //вывод названия и ссылки на новость
			echo '<h2>';
				echo ''.$row["name"].'';		
			echo '</h2>';

			//вывод рейтинга новости за названием, если рейтинг подключен
			if (! empty($row["rating"]))
			{
				echo '<div class="fivestar">' .$row["rating"] . '</div>';
			}

			//вывод анонса новостей
			if (! empty($row["anons"]))
			{
				echo ''.$row['anons'].'';
			}

			//вывод даты новости
			if (! empty($row['date']))
			{
				echo '<div class="links">
							<div class="aleft">
								'.$row["date"].'
							</div>
							<div class="aright">
								<a href="'.BASE_PATH_HREF.$row["link"].'">Читать далее</a>
							</div></div>';
			}		
	

			echo '</div>';

		echo '<div class="clear"></div></div>';
	}
}


echo"</div>";

//вывод постраничная навигация в конце списка новостей
if (! empty($result["paginator"]))
{
	echo $result["paginator"];
}

