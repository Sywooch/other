<?php
/**
 * Блок похожих вопросов и ответов
 * 
 * Шаблон
 * шаблонного тега <insert name="show_block_rel" module="faq" [count="количество"] [template="шаблон"]>:
 * блок похожих вопросов и ответов
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

if (empty($result["rows"]))
{
	return false;
}
echo '<div class="block_header">' . $this->diafan->_('Похожие вопросы') . '</div>';

echo '<div class="faq_block_rel">';

//заголовок блока
if (! empty($result["name"]))
{
	echo '<div class="block_header">'.$result["name"].'</div>';
}

//вопросы
foreach ($result["rows"] as $row)
{
	echo '<div class="faq">';

	//дата вопроса
	if (! empty($row["date"]))
	{
		echo '<div class="faq_date">'.$row["date"].'</div>';
	}
	//вопрос
	echo '<div class="faq_question"><a href="'.BASE_PATH_HREF.$row["link"].'">';
	$this->htmleditor($row['anons']);
	echo '</a></div>';

	//ответ
	echo '<div class="faq_answer">';
	$this->htmleditor($row['text']);
	echo '</div>';

	echo '</div>';
}
echo '</div>';