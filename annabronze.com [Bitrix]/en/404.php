<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');
CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Страница не найдена");
global $SITE_THEME;
?>


<table class="error_404" cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td class="image"><img  class="error_img" src="<?=SITE_TEMPLATE_PATH?>/themes/<?=$SITE_THEME?>/images/404.png" alt="404" title="404" /></td>
		<td class="description">
			<div class="t">Ошибка 404</div>
			<div class="st">Страница не найдена</div>
			<p>Неправильно набран адрес или такой<br />страницы не существует</p>
			<span class="item_info"><a href="<?=SITE_DIR?>" class="button add_item"><span>Перейти на главную</span></a><br /></span>
			<span class="choice_text">или <a onclick="history.back()"><span>вернутсья назад</span></a></span>
		</td>
	</tr>
</table>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>