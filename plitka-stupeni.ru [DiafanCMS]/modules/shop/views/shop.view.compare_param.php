<?php
/**
 * Дополнительные характеристики товара на странице сравнения
 *
 * Шаблон вывода дополнительных характеристик товара на странице сравнения
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

foreach ($result["existed_params"] as $r)
{
	$param = ! empty($result["params"][$r["id"]]) ? $result["params"][$r["id"]] : '';
	echo '
<div class="shop_param param_id_' . $r['id']
			. ' ' . (in_array($r['id'], $result["param_differences"]) ? ' shop_param_difference ' : '')
			. ' ">
			';
	echo '<span class="shop_param_value">';

	if (! empty($param["value"]))
	{
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
		else
		{
			echo $param["value"];
		}
	}
	else
	{
		echo '-';
	}
	echo '</span>';
	echo '</div>';
}