<?php
/**
 * Форма редактирования списка желаний
 *
 * Шаблон вывода формы редактирования списка желаний
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN')) {
    include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}

echo '<script type="text/javascript" src="' . BASE_PATH . 'modules/wishlist/wishlist.js"></script>';

echo '<form action="" method="POST" enctype="multipart/form-data" class="wishlist_table_form">
<input type="hidden" name="module" value="wishlist">
<input type="hidden" name="action" value="recalc">
<input type="hidden" name="ajax" value="">
<div class="errors error"' . ($result["error"] ? '>' . $result["error"] : ' style="display:none">') . '</div>
<div class="wishlist_table">';
echo $this->get('table', 'wishlist', $result); //вывод таблицы с товарами
echo '</div>';
echo '<div class="wishlist_recalc">';
// кнопка пересчитать
echo '<span class="button_wrap"><input type="submit" class="button" value="' . $this->diafan->_('Пересчитать', false) . '"></span>';
echo '</div>';
echo '</form>';