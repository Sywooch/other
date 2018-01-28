<?php
/**
 * Форма поиска по товарам
 *
 * Шаблон
 * шаблонного тега <insert name="show_search" module="shop" [ajax="подгружать_результаты"]
 * [cat_id="категория"] [site_id="страница_с_прикрепленным_модулем"]
 * [only_shop="выводить_только_на_странице_модуля"] [template="шаблон"]>:
 * форма поиска по товарам
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

echo '<div class="shop_search">';
echo '<div class="block_header">'.$this->diafan->_('Поиск по товарам').'</div>';
echo '<form method="GET" action="'.BASE_PATH_HREF.$result["path"].'"'.(! empty($result["send_ajax"]) ? ' class="shop_search_ajax"' : '').'>';
echo '<input type="hidden" value="search" name="action">';
if(! empty($result["send_ajax"]))
{
    echo '<input name="module_ajax" type="hidden" value="">';
}

if (count($result["site_ids"]) > 1)
{
	echo '<div class="shop_search_site_ids">
	<span class="infofield">'.$this->diafan->_('Раздел').':</span>
	<select>';
	foreach($result["site_ids"] as $row)
	{
		echo '<option value="'.$row["id"].'" path="'.BASE_PATH_HREF.$row["path"].'"';
		if($result["site_id"] == $row["id"])
		{
			echo ' selected';
		}
		echo '>'.$row["name"].'</option>';
	}
	echo '</select>';
	echo '</div>';
}

if (count($result["cat_ids"]) > 1)
{
	echo '<div class="shop_search_cat_ids">
	<span class="infofield">'.$this->diafan->_('Категория').':</span>
	<select name="cat_id">';
	foreach($result["cat_ids"] as $row)
	{
		echo '<option value="'.$row["id"].'" site_id="'.$row["site_id"].'"';
		if($result["cat_id"] == $row["id"])
		{
			echo ' selected';
		}
		echo '>';
		if($row["level"])
		{
			echo str_repeat('- ', $row["level"]);
		}
		echo $row["name"].'</option>';
	}
	echo '</select>';
	echo '</div>';
}
else
{
    echo '<input name="cat_id" type="hidden" value="'.$result["cat_id"].'">';
}

if (!empty($result["name"]))
{
	echo '<div class="shop_search_name">
		<span class="infofield">'.$this->diafan->_('Название').':</span>
		<input type="text" name="n" size="20" value="'.$result["name"]["value"].'" class="inptext">
	</div>';
}

if (!empty($result["article"]))
{
	echo '<div class="shop_search_article">
		<span class="infofield">'.$this->diafan->_('Артикул').':</span>
		<input type="text" name="a" size="20" value="'.$result["article"]["value"].'" class="inptext">
	</div>';
}

if (!empty($result["text"]))
{
	echo '<div class="shop_search_description">
		<span class="infofield">'.$this->diafan->_('Описание').':</span>
		<input type="text" name="d" size="20" value="'.$result["text"]["value"].'" class="inptext">
	</div>';
}

if (!empty($result["price"]))
{
	echo '<div class="shop_search_price">
		<span class="infofield">'.$this->diafan->_('Цена').':</span> 
		'.$this->diafan->_('от').' <input type="text" name="pr1" size="5" value="'.$result["price"]["value1"].'" class="inpnum"> '
	. $this->diafan->_('до').' <input type="text" name="pr2" size="5" value="'.$result["price"]["value2"].'" class="inpnum">
	</div>';
}

if (!empty($result["action"]))
{
	echo '<div class="shop_search_action">
		<span class="infofield">'.$this->diafan->_('Товар по акции').':</span>
		<input type="checkbox" name="ac" value="1"'.($result["action"]["value"] ? ' checked' : '').'>
	</div>';
}

if (!empty($result["new"]))
{
	echo '<div class="shop_search_new">
		<span class="infofield">'.$this->diafan->_('Новинка').':</span>
		<input type="checkbox" name="ne" value="1"'.($result["new"]["value"] ? ' checked' : '').'>
	</div>';
}

if (!empty($result["hit"]))
{
	echo '<div class="shop_search_hit">
		<span class="infofield">'.$this->diafan->_('Хит').':</span>
		<input type="checkbox" name="hi" value="1"'.($result["hit"]["value"] ? ' checked' : '').'>
	</div>';
}

if (!empty($result["rows"]))
{
	foreach ($result["rows"] as $row)
	{
		echo '<div class="shop_search_param shop_search_param'.$row["id"].'" cat_ids="'.$row["cat_ids"].'">';
		switch ($row["type"])
		{
			case 'text':
			case 'textarea':
			case 'editor':
				echo '<span class="infofield">'.$row["name"].':</span>
				<input type="text" name="p'.$row["id"].'" size="20" value="'.$row["value"].'" class="inptext">';
				break;
			case 'title':
				echo '<span class="infoform">'.$row["name"].'</span>';
				break;
			case 'date':
				echo '
				<span class="infofield">'.$row["name"].':</span>
				'.$this->diafan->_('от').'

				<input type="text" name="p'.$row["id"].'_1" size="5" value="'.$row["value1"].'" class="inptext timecalendar" showTime="false">

				'.$this->diafan->_('до').'

				<input type="text" name="p'.$row["id"].'_2" size="5" value="'.$row["value2"].'" class="inptext timecalendar" showTime="false">';
				break;
			case 'datetime':
				echo '
				<span class="infofield">'.$row["name"].':</span>
				'.$this->diafan->_('от').'

				<input type="text" name="p'.$row["id"].'_1" size="5" value="'.$row["value1"].'" class="inptext timecalendar" showTime="true">

				'.$this->diafan->_('до').'

				<input type="text" name="p'.$row["id"].'_2" size="5" value="'.$row["value2"].'" class="inptext timecalendar" showTime="true">';
				break;
			case 'numtext':
				echo '
				<span class="infofield">'.$row["name"].':</span>
				'.$this->diafan->_('от').' <input type="text" name="p'.$row["id"].'_1" size="5" value="'
				. $row["value1"].'" class="inpnum"> 

				'.$this->diafan->_('до').' <input type="text" name="p'.$row["id"].'_2" size="5" value="'
				. $row["value2"].'" class="inpnum">';
				break;
			case 'checkbox':
				echo '
				<span class="infofield">'.$row["name"].':</span>
				<input type="checkbox" name="p'.$row["id"].'" value="1"'.($row["value"] ? " checked" : '').' class="inpcheckbox">';
				break;
			case 'select':
			case 'multiple':
				echo '
				<span class="infofield">'.$row["name"].':</span>';
				foreach ($row["select_array"] as $key => $value)
				{
					echo '<input type="checkbox" name="p'.$row["id"].'[]" value="'.$key.'"'.(in_array($key, $row["value"]) ? " checked" : '').' class="inpcheckbox"> '.$value.'<br>';
				}
		}
		echo '
		</div>';
	}
}
echo '
	<span class="button_wrap"><input type="submit" value="'.$this->diafan->_('Поиск', false).'" class="button"></span>
	</form>
</div>';

if(empty($GLOBALS["include_shop_show_search_js"]))
{
	$GLOBALS["include_shop_show_search_js"] = true;
	echo '<script type="text/javascript" src="'.BASE_PATH.'modules/shop/shop.show_search.js"></script>';
}