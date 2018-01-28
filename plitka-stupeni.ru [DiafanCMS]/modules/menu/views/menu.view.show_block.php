<?php
/**
 * Меню, оформленное шаблоном
 *
 * Шаблонный тег: вывод меню
 * Выполняется в том случае, если передан параметр template=default при вызове тега
 * <insert name="show_block" module="menu" id="1" template="default">
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

if (empty($result["rows"]))
{
	return false;
}
if (!empty($result["name"]))
{
	echo '<div class="block_header">'.$result["name"].'</div>';
}

echo '<ul class="left_menu_level_1">';
$this->get('show_level', 'menu', $result);
echo '</ul>';