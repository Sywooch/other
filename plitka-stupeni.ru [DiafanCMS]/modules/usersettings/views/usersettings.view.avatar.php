<?php
/**
 * Аватар
 *
 * Шаблон вывода аватара
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

$text = '<img src="' . BASE_PATH . USERFILES.'/avatar/' . $result["name"] . '.png?' . rand(0, 99) . '" width="' . $result["avatar_width"] . '" height="' . $result["avatar_height"] . '" alt="' . $result["fio"] . ' (' . $result["name"] . ')">
<a href="#" class="registration_avatar_delete">x</a>';

return $text;