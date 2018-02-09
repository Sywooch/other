<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "УФМС России по Ярославской области");
$APPLICATION->SetPageProperty("tags", "Главная,  УФМС России по Ярославской области, Федеральная миграционная служба");
$APPLICATION->SetPageProperty("keywords_inner", "Главная, УФМС России по Ярославской области,  Федеральная миграционная служба");
$APPLICATION->SetPageProperty("title", "Главная - УФМС России по Ярославской области");
$APPLICATION->SetPageProperty("keywords", "Главная, УФМС России по Ярославской области, Федеральная миграционная служба");
$APPLICATION->SetTitle("Главная - УФМС России по Ярославской области");
$GLOBALS["arrFilterMainTheme"] = array("PROPERTY_MAIN_VALUE" => 1);
$GLOBALS["arrFilterMain"] = array("PROPERTY_MAIN_VALUE" => 1);
?><style type="text/css">
h1{

color:#800d0d;
font-weight:bold;
border-bottom:0px;
}
</style>


<div align="center" style="width:580px; height:400px; overflow:hidden; margin-left:0px; margin-right:0px;
padding-left:0px; padding-right:0px; ">
 <?$APPLICATION->IncludeComponent(
	"itlogic:bxslider", 
	"template1", 
	array(
		"IBLOCK_TYPE" => "photos",
		"IBLOCK_ID" => "14",
		"SLIDER_MODE" => "horizontal",
		"SLIDER_WIDTH" => "550",
		"SLIDER_SPEED" => "400",
		"SLIDER_HIDECONTROLONEND" => "Y",
		"SLIDER_AUTO" => "Y",
		"SLIDER_AUTO_CONTROLS" => "N",
		"SLIDER_CAPTIONS" => "Y",
		"SLIDER_RESPONSIVE" => "Y",
		"jQuery" => "Y",
		"HREF_IMG" => "Y",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "3600"
	),
	false
);?><br>
</div>



<?$APPLICATION->IncludeComponent("bitrix:news.list", "main_theme1", Array(
	"IBLOCK_TYPE" => "news",	// Тип информационного блока (используется только для проверки)
	"IBLOCK_ID" => "3",	// Код информационного блока
	"NEWS_COUNT" => "10",	// Количество новостей на странице
	"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
	"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
	"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
	"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
	"FILTER_NAME" => "arrFilterMainTheme",	// Фильтр
	"FIELD_CODE" => array(	// Поля
		0 => "ID",
		1 => "NAME",
		2 => "PREVIEW_PICTURE",
		3 => "",
	),
	"PROPERTY_CODE" => array(	// Свойства
		0 => "",
	),
	"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
	"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
	"AJAX_MODE" => "N",	// Включить режим AJAX
	"AJAX_OPTION_SHADOW" => "Y",
	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
	"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
	"CACHE_FILTER" => "Y",	// Кешировать при установленном фильтре
	"CACHE_GROUPS" => "N",	// Учитывать права доступа
	"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
	"SET_TITLE" => "N",	// Устанавливать заголовок страницы
	"SET_STATUS_404" => "N",	// Устанавливать статус 404, если не найдены элемент или раздел
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
	"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
	"PARENT_SECTION" => "",	// ID раздела
	"PARENT_SECTION_CODE" => "",	// Код раздела
	"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
	"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
	"PAGER_TITLE" => "Новости",	// Название категорий
	"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
	"PAGER_TEMPLATE" => "",	// Шаблон постраничной навигации
	"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
	"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
	"MAIN_THEME" => "Главная тема",	// Заголовок блока главной темы
	"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);?>
  <h1>Новости</h1>
 <?$APPLICATION->IncludeComponent("bitrix:news.list", "main_news1", Array(
	"IBLOCK_TYPE" => "news",	// Тип информационного блока (используется только для проверки)
	"IBLOCK_ID" => "13",	// Код информационного блока
	"NEWS_COUNT" => "20",	// Количество новостей на странице
	"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
	"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
	"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
	"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
	"FILTER_NAME" => "arrFilterMain",	// Фильтр
	"FIELD_CODE" => array(	// Поля
		0 => "NAME",
		1 => "PREVIEW_TEXT",
		2 => "PREVIEW_PICTURE",
		3 => "DATE_CREATE",
		4 => "",
	),
	"PROPERTY_CODE" => array(	// Свойства
		0 => "",
	),
	"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
	"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
	"AJAX_MODE" => "N",	// Включить режим AJAX
	"AJAX_OPTION_SHADOW" => "Y",
	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
	"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
	"CACHE_FILTER" => "Y",	// Кешировать при установленном фильтре
	"CACHE_GROUPS" => "N",	// Учитывать права доступа
	"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
	"ACTIVE_DATE_FORMAT" => "j F Y",	// Формат показа даты
	"SET_TITLE" => "N",	// Устанавливать заголовок страницы
	"SET_STATUS_404" => "N",	// Устанавливать статус 404, если не найдены элемент или раздел
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
	"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
	"PARENT_SECTION" => "",	// ID раздела
	"PARENT_SECTION_CODE" => "",	// Код раздела
	"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
	"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
	"PAGER_TITLE" => "Новости",	// Название категорий
	"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
	"PAGER_TEMPLATE" => "",	// Шаблон постраничной навигации
	"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
	"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
	"DISPLAY_DATE" => "Y",	// Выводить дату элемента
	"DISPLAY_NAME" => "Y",	// Выводить название элемента
	"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
	"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
	"DISPLAY_IMG_WIDTH" => "136",	// Ширина картинки для анонса
	"DISPLAY_IMG_HEIGHT" => "101",	// Высота картинки для анонса
	"USE_RSS" => "Y",	// Разрешить RSS
	"TITLE_RSS" => "Главные новости информационного портала",	// Заголовок RSS канала
	"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
	),
	false
);?> 

<div style="width:100%; height:30px; background-color:transparent;" align="right">
<a href="/press-tsentr/" style="text-decoration:none;"><span style="color: #800d0d;
font-style: italic;
font-weight: bold;">Другие новости >></span></a>
</div>


 <?$APPLICATION->IncludeComponent("bitrix:news.list", "news", array(
	"IBLOCK_TYPE" => "news",
	"IBLOCK_ID" => "2",
	"NEWS_COUNT" => "10",
	"SORT_BY1" => "ACTIVE_FROM",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "arrFilterNews",
	"FIELD_CODE" => array(
		0 => "NAME",
		1 => "PREVIEW_TEXT",
		2 => "PREVIEW_PICTURE",
		3 => "DATE_CREATE",
		4 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "",
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_SHADOW" => "Y",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "Y",
	"CACHE_GROUPS" => "N",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "j F Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => "",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "Новости",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"DISPLAY_DATE" => "Y",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "Y",
	"DISPLAY_PREVIEW_TEXT" => "Y",
	"DISPLAY_IMG_WIDTH" => "80",
	"DISPLAY_IMG_HEIGHT" => "56",
	"USE_RSS" => "Y",
	"TITLE_RSS" => "Новости информационного портала",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);?> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>