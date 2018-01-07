<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');
CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Страница не найдена");
global $SITE_THEME;
?>


	<div class="grid-container">
		<div class="grid-row col-1 col-xm-12 col-s-12"></div>
		<div class="b-layout__inner-column grid-row col-4 col-s-12">
			<h1 class="b-layout__inner-404">404</h1>

		</div>
		<div class="b-layout__inner-content grid-row col-6 col-xm-9  col-s-12">


			<div class="b-layout__info-box">
				<h1>Ошибка 404</h1>
				<h2>Страница не найдена</h2><br>
				<p>Неправильно набран адрес или такой<br />страницы не существует</p>
				<a href="<?=SITE_DIR?>"><span>Перейти на главную</span></a><br>
				<span>или <a onclick="history.back()"><span>вернутсья назад</span></a></span>

			</div>

			<!---------content----------->




		</div>

	</div>

<!--

<table class="error_404" cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td class="image">
			<h1>404</h1>
		</td>
		<td class="description">
			<div class="t">Ошибка 404</div>
			<div class="st">Страница не найдена</div>
			<p>Неправильно набран адрес или такой<br />страницы не существует</p>
			<span class="item_info"><a href="<?=SITE_DIR?>" class="button add_item"><span>Перейти на главную</span></a><br /></span>
			<span class="choice_text">или <a onclick="history.back()"><span>вернутсья назад</span></a></span>
		</td>
	</tr>
</table>
-->





<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>