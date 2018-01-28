<?php
/**
 * Блок тем
 * 
 * Шаблон
 * шаблонного тега <insert name="show_block" module="forum" [count="количество"]
 * [cat_id="категория"] [template="шаблон"]>:
 * блок последних тем
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

if(! $result["rows"])
	return;

echo '
<div class="block_header">'.$this->diafan->_('Последние темы на форуме').'</div>
<ul class="forum_block">';
foreach ($result["rows"] as $row)
{
	echo '<li><a href="'.BASE_PATH_HREF.$row["link"].'">'.$row["name"].'</a></li>';
}
echo '</ul><br><br>';
