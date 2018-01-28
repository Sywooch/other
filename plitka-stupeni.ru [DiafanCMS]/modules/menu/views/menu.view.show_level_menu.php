<?php
/**
 * Первый уровень меню topmenu
 *
 * Шаблон вывода первого уровня меню, вызывается из функции show_block в начале файла
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
    include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}
$may_color=unserialize(@file_get_contents($_SERVER['DOCUMENT_ROOT'].'/modules/menu/admin/colors.t'));
$may_background=unserialize(@file_get_contents($_SERVER['DOCUMENT_ROOT'].'/modules/menu/admin/background.t'));


if (empty($result["rows"][$result["parent_id"]]))
{
	return true;
}
$k = 0;
echo ' ';
// начало уровня меню


foreach ($result["rows"][$result["parent_id"]] as $row)
{
$colors="";$background="";
if(is_array($may_color) && $may_color[$row['id']]!=""){$colors="color:".$may_color[$row['id']].";";}
if(is_array($may_background) && $may_background[$row['id']]!=""){$background="background:".$may_background[$row['id']].";";}
	if ($k)
	{
	echo '';
	}
	$k = 1;

	if ($row["active"])
	{
	// начало пункта меню для текущей страницы
	echo '<li '.(($background!="")?'style="'.$background.'"':'').'>';
	}
	elseif ($row["active_child"])
	{
	// начало пункта меню для активного дочернего пункта
	echo '<li '.(($background!="")?'style="'.$background.'"':'').'>';
	}
	else
	{
	// начало любого другого пункта меню
	echo '<li '.(($background!="")?'style="'.$background.'"':'').'>';
	}

	if (
		// на текущей странице нет ссылки, если не включена настройка "Текущий пункт как ссылка"
		(!$row["active"] || $result["current_link"])

		// влючен пункт "Не отображать ссылку на элемент, если он имеет дочерние пункты"
		&& (!$result["hide_parent_link"] || empty($result["rows"][$row["id"]]))
	)
	{
		if ($row["othurl"])
		{
			echo '<a href="'.$row["othurl"].'" target="_blank"' 
			.(!empty($row["active"]) || !empty($row["active_child"]) ? ' ' : '')
			.' '.(($colors!="" )?'style="'.$colors.'"':'').'>';
		}
		else
		{
			echo '<a href="'.BASE_PATH_HREF.$row["link"].'"'
			.(!empty($row["active"]) || !empty($row["active_child"]) ? ' ' : '')
			.' '.(($colors!="")?'style="'.$colors.'"':'').'>';
		}
	}

	//вывод изображения
	if (! empty($row["img"]))
	{
		echo '<img src="'.$row["img"]["src"].'" width="'.$row["img"]["width"].'" height="'.$row["img"]["height"]
		.'" alt="'.$row["img"]["alt"].'" title="'.$row["img"]["title"].'"> ';
	}

	// название пункта меню
	if (! empty($row["name"]))
	{
	    echo $row["name"];
	}

	if (
		// на текущей странице нет ссылки, если не включена настройка "Текущий пункт как ссылка"
		(!$row["active"] || $result["current_link"])

		// влючен пункт "Не отображать ссылку на элемент, если он имеет дочерние пункты"
		&& (!$result["hide_parent_link"] || empty($result["rows"][$row["id"]]))
	)
	{
		echo '</a>';
	}
	if ($result["show_all_level"] || $row["active_child"] || $row["active"])
	{
	// вывод вложенного уровня меню
	$menu_data = $result;
	$menu_data["parent_id"] = $row["id"];
	$menu_data["level"]++;

	$this->get('show_level_topmenu_2', 'menu', $menu_data);
	}

	if ($row["active"])
	{
	// окончание пункта меню - текущей страницы
	echo '</li>';
	}
	elseif ($row["active_child"])
	{
	// окончание пункта меню для активного дочернего пункта
	echo '</li>';
	}
	else
	{
	// окончание любого другого пункта меню
	echo '</li>';
	}
}
// окончание уровня меню