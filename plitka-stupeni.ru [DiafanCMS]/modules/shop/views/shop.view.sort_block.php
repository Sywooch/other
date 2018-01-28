<?php
/**
 * Ссылки на направление сортировки
 *
 * Шаблон вывода блока «Сортировать» с ссылками на направление сортировки
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
       
$link_sort   = $result["link_sort"];
$sort_config = $result['sort_config'];

echo '<div class="shop_sort">' . $this->diafan->_('Сортировать') . ': ';

$symbol = '▲';
for ($i = 1; $i <= count($sort_config['sort_directions']); $i++)
{
	echo empty($sort_config['sort_fields_names'][$i]) ? '' : $sort_config['sort_fields_names'][$i];
	if ($link_sort[$i])
	{
		echo ' <a href="' . BASE_PATH_HREF . $link_sort[$i] . '" rel="nofollow">'.$symbol.'</a> ';
	}
	else
	{
		echo ' <span class="active">'.$symbol.'</span> ';
	}

	$symbol =  $symbol == '▲' ?  '▼' :'▲';
}

echo '</div>';