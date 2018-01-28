<?php
/**
 * Дополнительные характеристики товара
 *
 * Шаблон вывода дополнительных характеристик товара
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

foreach ($result["rows"] as $param)
{
	echo '<div class="shop_param' . ($param["type"] == 'title' ? '_title' : '') . '">' . $param["name"];
	if ($param["value"])
	{
		echo ': <span class="shop_param_value">';
		if($param["type"] == "attachments")
		{
			foreach($param["value"] as $a)
			{
				if ($a["is_image"])
				{
					if($param["use_animation"])
					{
						echo ' <a href="'.$a["link"].'" rel="prettyPhoto[gallery'.$result["id"].'shop]"><img src="'.$a["link_preview"].'"></a> <a href="'.$a["link"].'" rel="prettyPhoto[gallery'.$result["id"].'shop_link]">'.$a["name"].'</a>';
					}
					else
					{
						echo ' <a href="'.$a["link"].'"><img src="'.$a["link_preview"].'"></a> <a href="'.$a["link"].'">'.$a["name"].'</a>';
					}
				}
				else
				{
					echo ' <a href="'.$a["link"].'">'.$a["name"].'</a>';
				}
			}
		}
		elseif($param["type"] == "images")
		{
			foreach($param["value"] as $img)
			{
				echo '<img src="'.$img["src"].'" width="'.$img["width"].'" height="'.$img["height"].'" alt="'.$img["alt"].'" title="'.$img["title"].'">';
			}
		}
		elseif (!empty($param["link"]))
		{
			echo '<a href="' . BASE_PATH_HREF . $param["link"] . '">' . $param["value"] . '</a>';
		}
		elseif (is_array($param["value"]))
		{
			foreach ($param["value"] as $p)
			{
				if ($param["value"][0] != $p)
				{
					echo ', ';
				}
				if (is_array($p))
				{
					if ($p["link"])
					{
						echo '<a href="' . BASE_PATH_HREF . $p["link"] . '">' . $p["name"] . '</a>';
					}
					else
					{
						echo $p["name"];
					}
				}
				else
				{
					echo $p;
				}
			}
		}
		elseif($param["type"] == "editor")
		{
			$this->htmleditor($param["value"]);
		}
		else
		{
			echo $param["value"];
		}
		//единицы измерения
		if(! empty($param["measure_unit"]) && $param["type"] == 'numtext')
		{
			echo ' '.$param["measure_unit"];
		}
		echo '</span>';
	}
	echo '</div>';
}