<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поиск");
?>
<?$APPLICATION->IncludeComponent("bitrix:search.page", "shop", Array(
	"RESTART" => "N",	// Искать без учета морфологии (при отсутствии результата поиска)
	"NO_WORD_LOGIC" => "N",	// Отключить обработку слов как логических операторов
	"CHECK_DATES" => "N",	// Искать только в активных по дате документах
	"USE_TITLE_RANK" => "N",	// При ранжировании результата учитывать заголовки
	"DEFAULT_SORT" => "rank",	// Сортировка по умолчанию
	"FILTER_NAME" => "",	// Дополнительный фильтр
    "arrFILTER" => array(
        0 => "iblock_aspro_ishop_catalog",
        1 => "iblock_aspro_ishop_content",
        2 => "blog",
    ),
	"arrFILTER_iblock_aspro_ishop_catalog" => array(	// Искать в информационных блоках типа "iblock_aspro_ishop_catalog"
		0 => "40",
	),
	"arrFILTER_iblock_aspro_ishop_content" => array(	// Искать в информационных блоках типа "iblock_aspro_ishop_content"
		0 => "6",
		1 => "7",
		2 => "41",
		3 => "47",
	),
    "arrFILTER_blog" => array(
        0 => "4",
        1 => "5",
        2 => "6",
        3 => "7",
        4 => "8",
    ),
	"SHOW_WHERE" => "N",	// Показывать выпадающий список "Где искать"
	"SHOW_WHEN" => "N",	// Показывать фильтр по датам
	"PAGE_RESULT_COUNT" => "20",	// Количество результатов на странице
	"AJAX_MODE" => "N",	// Включить режим AJAX
	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
	"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
	"DISPLAY_TOP_PAGER" => "N",	// Выводить над результатами
	"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под результатами
	"PAGER_TITLE" => "Результаты поиска",	// Название результатов поиска
	"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
	"PAGER_TEMPLATE" => "shop",	// Название шаблона
	"USE_LANGUAGE_GUESS" => "Y",	// Включить автоопределение раскладки клавиатуры
	"STRUCTURE_FILTER" => "structure",	// Имя фильтра страницы структуры компании
	"USE_SUGGEST" => "N",	// Показывать подсказку с поисковыми фразами
	"NAME_TEMPLATE" => "",	// Отображение имени
	"SHOW_LOGIN" => "Y",	// Показывать логин, если не задано имя
	"PATH_TO_SONET_MESSAGES_CHAT" => "/company/personal/messages/chat/#USER_ID#/",	// Страница отправки личного сообщения соцсети
	"SHOW_RATING" => "",	// Включить рейтинг
	"RATING_TYPE" => "",	// Вид кнопок рейтинга
	"PATH_TO_USER_PROFILE" => "",	// Шаблон пути к профилю пользователя
	"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>