<?php
/**
 * Список новостей
 *
 * Вывод списка новостей в том случае, 
 * если в настройках модуля отключен (по-умолчанию) параметр «Использовать категории». 
 * Если параметр «Использовать категории» включен,
 * список новостей формируется с группировкой по категориям шаблоном news.view.first_page.php.
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
		<div class="text_zag">Новости</div>
		<?
			if(!empty($result['rows'])){
				foreach($result['rows'] as $val)
				{
					echo '<div class="text_t">';
					echo '<div class="sub_name">'.$val['name'].'<div class="sub_time">'.$val['date'].'</div></div>';
					$this->htmleditor($val['anons']);
					if(!empty($val["link"])) echo '... <a href="'.BASE_PATH_HREF.$val["link"].'" class="sub_read_more">Читать дальше</a>';
					echo '</div>';
				}
			}
			//вывод постраничная навигация в конце списка новостей
			if (! empty($result["paginator"]))
			{
				echo $result["paginator"];
			}
		?>
	</div>