<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новости дополнительного образования");
?><div class="left_page">
	<div class="left_categories">
		<div>
			<div class="head">
			</div>
			<ul>
				<li data-id="5"><span><img src="/upload/iblock/13f/13f359c715e6bab7ca5a90e95a4efbb3.png" alt="Школы" title="Школы"><span>Школы</span></span></li>
				<li data-id="6"><span><img src="/upload/iblock/d21/d21f6e616f26b2ad35ea95752702c914.png" alt="Колледжи" title="Колледжи"><span>Колледжи</span></span></li>
				<li data-id="7"><span><img src="/upload/iblock/951/95129f2267db1585a94601eaa02cb382.png" alt="Университеты" title="Университеты"><span>Университеты</span></span></li>
				<li data-id="8"><span><img src="/upload/iblock/a6b/a6bdbb4fc4b44ff16e83e77b54aa7bed.png" alt="Академии" title="Академии"><span>Академии</span></span></li>
				<li data-id="9"><span><img alt="Языковые курсы" src="/upload/iblock/3b6/3b61a8cac60b543fc17eee430b518bd6.png" title="Языковые курсы"><span>Языковые курсы</span></span></li>
				<li data-id="10"><span><img alt="Дополнительное образование" src="/upload/iblock/97e/97e3c32ef8b504da4fd8a1bfe45fb85a.png" title="Дополнительное образование"><span>Дополнительное образование</span></span></li>
			</ul>
		</div>
	</div>
	<div class="banner_container">
	</div>
</div>
 <!--left page--->
<div class="right_page">

<h1><span>Новости дополнительного образования</span></h1>


<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"template1", 
	array(
		"ACTIVE_DATE_FORMAT" => "j F Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "DATE_CREATE",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "10",
		"IBLOCK_TYPE" => "news",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "arrows",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"COMPONENT_TEMPLATE" => "template1"
	),
	false
);?>



<a href="/news/" class="return"><span>вернуться к списку новостей</span></a>


</div>
 <br>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>