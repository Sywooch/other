<?php
/**
 * Форма опроса
 * 
 * Шаблон
 * шаблонного тега <insert name="show_block" module="votes" [id="номер_опроса"] [count="all|количество"] [template="шаблон"]>:
 * выводит опросы на сайте
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

if (empty($result))
{
	return false;
}         
echo '<div class="votes_block">';

echo '<div class="block_header">'.$this->diafan->_('Голосование').'</div>';
foreach ($result as $row)
{
	echo '
	<div class="votes_question">'.$row["question"].'</div>
	<form method="post" action="" class="votes_form ajax" id="votes'.$row["question_id"].'">
	<div id="votes'.$row["question_id"].'_form">
	'.$row["answers"].'
	</div>
	<div class="errors error"'.($row["error"] ? '>'.$row["error"] : ' style="display:none">').'</div>
	</form>';
}
echo '<script type="text/javascript" src="'.BASE_PATH.'modules/votes/votes.js"></script>';

echo '</div>';