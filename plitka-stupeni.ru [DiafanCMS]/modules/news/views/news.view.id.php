<?php
/**
 * Страница новости
 *
 * Шаблон оформления страницы с отдельной новостью
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
?>
	<div class="text">
		<div class="text_zag"><?=$result['name']?><div class="sub_time"><?=$result["date"]?></div></div>
		
		<? 
			if(!empty($result['text']))
			{
				$this->htmleditor($result['text']);
			} else {
				$this->htmleditor($result['anons']);
			}
		?>

		<? if(!empty($result["previous"]) || !empty($result["next"])): ?>
		<div class="pn_links">
			<?
				if(!empty($result["previous"])) echo '<a href="'.BASE_PATH_HREF.$result["previous"]["link"].'" class="perv">← Преыдушая новость</a>';
				if(!empty($result["next"])) echo '<a href="'.BASE_PATH_HREF.$result["next"]["link"].'" class="next">Следующая новость →</a>';
			?>
		</div>
		<? endif; ?>
	</div>