<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "���� ������ �� ����������� �������");
$APPLICATION->SetPageProperty("tags", "�������,  ���� ������ �� ����������� �������, ����������� ������������ ������");
$APPLICATION->SetPageProperty("keywords_inner", "�������, ���� ������ �� ����������� �������,  ����������� ������������ ������");
$APPLICATION->SetPageProperty("title", "������� - ���� ������ �� ����������� �������");
$APPLICATION->SetPageProperty("keywords", "�������, ���� ������ �� ����������� �������, ����������� ������������ ������");
$APPLICATION->SetTitle("������� - ���� ������ �� ����������� �������");
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
	"IBLOCK_TYPE" => "news",	// ��� ��������������� ����� (������������ ������ ��� ��������)
	"IBLOCK_ID" => "3",	// ��� ��������������� �����
	"NEWS_COUNT" => "10",	// ���������� �������� �� ��������
	"SORT_BY1" => "ACTIVE_FROM",	// ���� ��� ������ ���������� ��������
	"SORT_ORDER1" => "DESC",	// ����������� ��� ������ ���������� ��������
	"SORT_BY2" => "SORT",	// ���� ��� ������ ���������� ��������
	"SORT_ORDER2" => "ASC",	// ����������� ��� ������ ���������� ��������
	"FILTER_NAME" => "arrFilterMainTheme",	// ������
	"FIELD_CODE" => array(	// ����
		0 => "ID",
		1 => "NAME",
		2 => "PREVIEW_PICTURE",
		3 => "",
	),
	"PROPERTY_CODE" => array(	// ��������
		0 => "",
	),
	"CHECK_DATES" => "Y",	// ���������� ������ �������� �� ������ ������ ��������
	"DETAIL_URL" => "",	// URL �������� ���������� ��������� (�� ��������� - �� �������� ���������)
	"AJAX_MODE" => "N",	// �������� ����� AJAX
	"AJAX_OPTION_SHADOW" => "Y",
	"AJAX_OPTION_JUMP" => "N",	// �������� ��������� � ������ ����������
	"AJAX_OPTION_STYLE" => "Y",	// �������� ��������� ������
	"AJAX_OPTION_HISTORY" => "N",	// �������� �������� ��������� ��������
	"CACHE_TYPE" => "A",	// ��� �����������
	"CACHE_TIME" => "36000000",	// ����� ����������� (���.)
	"CACHE_FILTER" => "Y",	// ���������� ��� ������������� �������
	"CACHE_GROUPS" => "N",	// ��������� ����� �������
	"PREVIEW_TRUNCATE_LEN" => "",	// ������������ ����� ������ ��� ������ (������ ��� ���� �����)
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// ������ ������ ����
	"SET_TITLE" => "N",	// ������������� ��������� ��������
	"SET_STATUS_404" => "N",	// ������������� ������ 404, ���� �� ������� ������� ��� ������
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// �������� �������� � ������� ���������
	"ADD_SECTIONS_CHAIN" => "N",	// �������� ������ � ������� ���������
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// �������� ������, ���� ��� ���������� ��������
	"PARENT_SECTION" => "",	// ID �������
	"PARENT_SECTION_CODE" => "",	// ��� �������
	"DISPLAY_TOP_PAGER" => "N",	// �������� ��� �������
	"DISPLAY_BOTTOM_PAGER" => "N",	// �������� ��� �������
	"PAGER_TITLE" => "�������",	// �������� ���������
	"PAGER_SHOW_ALWAYS" => "N",	// �������� ������
	"PAGER_TEMPLATE" => "",	// ������ ������������ ���������
	"PAGER_DESC_NUMBERING" => "N",	// ������������ �������� ���������
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// ����� ����������� ������� ��� �������� ���������
	"PAGER_SHOW_ALL" => "N",	// ���������� ������ "���"
	"MAIN_THEME" => "������� ����",	// ��������� ����� ������� ����
	"AJAX_OPTION_ADDITIONAL" => "",	// �������������� �������������
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);?>
  <h1>�������</h1>
 <?$APPLICATION->IncludeComponent("bitrix:news.list", "main_news1", Array(
	"IBLOCK_TYPE" => "news",	// ��� ��������������� ����� (������������ ������ ��� ��������)
	"IBLOCK_ID" => "13",	// ��� ��������������� �����
	"NEWS_COUNT" => "20",	// ���������� �������� �� ��������
	"SORT_BY1" => "ACTIVE_FROM",	// ���� ��� ������ ���������� ��������
	"SORT_ORDER1" => "DESC",	// ����������� ��� ������ ���������� ��������
	"SORT_BY2" => "SORT",	// ���� ��� ������ ���������� ��������
	"SORT_ORDER2" => "ASC",	// ����������� ��� ������ ���������� ��������
	"FILTER_NAME" => "arrFilterMain",	// ������
	"FIELD_CODE" => array(	// ����
		0 => "NAME",
		1 => "PREVIEW_TEXT",
		2 => "PREVIEW_PICTURE",
		3 => "DATE_CREATE",
		4 => "",
	),
	"PROPERTY_CODE" => array(	// ��������
		0 => "",
	),
	"CHECK_DATES" => "Y",	// ���������� ������ �������� �� ������ ������ ��������
	"DETAIL_URL" => "",	// URL �������� ���������� ��������� (�� ��������� - �� �������� ���������)
	"AJAX_MODE" => "N",	// �������� ����� AJAX
	"AJAX_OPTION_SHADOW" => "Y",
	"AJAX_OPTION_JUMP" => "N",	// �������� ��������� � ������ ����������
	"AJAX_OPTION_STYLE" => "Y",	// �������� ��������� ������
	"AJAX_OPTION_HISTORY" => "N",	// �������� �������� ��������� ��������
	"CACHE_TYPE" => "A",	// ��� �����������
	"CACHE_TIME" => "36000000",	// ����� ����������� (���.)
	"CACHE_FILTER" => "Y",	// ���������� ��� ������������� �������
	"CACHE_GROUPS" => "N",	// ��������� ����� �������
	"PREVIEW_TRUNCATE_LEN" => "",	// ������������ ����� ������ ��� ������ (������ ��� ���� �����)
	"ACTIVE_DATE_FORMAT" => "j F Y",	// ������ ������ ����
	"SET_TITLE" => "N",	// ������������� ��������� ��������
	"SET_STATUS_404" => "N",	// ������������� ������ 404, ���� �� ������� ������� ��� ������
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// �������� �������� � ������� ���������
	"ADD_SECTIONS_CHAIN" => "N",	// �������� ������ � ������� ���������
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// �������� ������, ���� ��� ���������� ��������
	"PARENT_SECTION" => "",	// ID �������
	"PARENT_SECTION_CODE" => "",	// ��� �������
	"DISPLAY_TOP_PAGER" => "N",	// �������� ��� �������
	"DISPLAY_BOTTOM_PAGER" => "N",	// �������� ��� �������
	"PAGER_TITLE" => "�������",	// �������� ���������
	"PAGER_SHOW_ALWAYS" => "N",	// �������� ������
	"PAGER_TEMPLATE" => "",	// ������ ������������ ���������
	"PAGER_DESC_NUMBERING" => "N",	// ������������ �������� ���������
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// ����� ����������� ������� ��� �������� ���������
	"PAGER_SHOW_ALL" => "N",	// ���������� ������ "���"
	"DISPLAY_DATE" => "Y",	// �������� ���� ��������
	"DISPLAY_NAME" => "Y",	// �������� �������� ��������
	"DISPLAY_PICTURE" => "Y",	// �������� ����������� ��� ������
	"DISPLAY_PREVIEW_TEXT" => "Y",	// �������� ����� ������
	"DISPLAY_IMG_WIDTH" => "136",	// ������ �������� ��� ������
	"DISPLAY_IMG_HEIGHT" => "101",	// ������ �������� ��� ������
	"USE_RSS" => "Y",	// ��������� RSS
	"TITLE_RSS" => "������� ������� ��������������� �������",	// ��������� RSS ������
	"AJAX_OPTION_ADDITIONAL" => "",	// �������������� �������������
	),
	false
);?> 

<div style="width:100%; height:30px; background-color:transparent;" align="right">
<a href="/press-tsentr/" style="text-decoration:none;"><span style="color: #800d0d;
font-style: italic;
font-weight: bold;">������ ������� >></span></a>
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
	"PAGER_TITLE" => "�������",
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
	"TITLE_RSS" => "������� ��������������� �������",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);?> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>