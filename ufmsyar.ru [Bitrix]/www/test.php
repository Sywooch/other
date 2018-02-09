<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
?><?$APPLICATION->IncludeComponent("bitrix:photogallery", "", array(
	"USE_LIGHT_VIEW" => "Y",
	"IBLOCK_TYPE" => "photos",
	"IBLOCK_ID" => "14",
	"SECTION_SORT_BY" => "ID",
	"SECTION_SORT_ORD" => "ASC",
	"ELEMENT_SORT_FIELD" => "",
	"ELEMENT_SORT_ORDER" => "asc",
	"PATH_TO_USER" => "",
	"DRAG_SORT" => "Y",
	"USE_COMMENTS" => "N",
	"SEF_MODE" => "N",
	"VARIABLE_ALIASES" => array(
		"SECTION_ID" => "SECTION_ID",
		"ELEMENT_ID" => "ELEMENT_ID",
		"PAGE_NAME" => "PAGE_NAME",
		"ACTION" => "ACTION",
	),
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"DATE_TIME_FORMAT_DETAIL" => "",
	"DATE_TIME_FORMAT_SECTION" => "",
	"SET_TITLE" => "Y",
	"SHOW_LINK_ON_MAIN_PAGE" => "",
	"SECTION_PAGE_ELEMENTS" => "15",
	"ELEMENTS_PAGE_ELEMENTS" => "50",
	"PAGE_NAVIGATION_TEMPLATE" => "",
	"ALBUM_PHOTO_SIZE" => "120",
	"THUMBNAIL_SIZE" => "100",
	"JPEG_QUALITY1" => "100",
	"ORIGINAL_SIZE" => "1000",
	"JPEG_QUALITY" => "100",
	"ADDITIONAL_SIGHTS" => "",
	"PHOTO_LIST_MODE" => "N",
	"SHOWN_ITEMS_COUNT" => "6",
	"SHOW_NAVIGATION" => "N",
	"USE_RATING" => "N",
	"SHOW_TAGS" => "N",
	"UPLOADER_TYPE" => "flash",
	"APPLET_LAYOUT" => "extended",
	"UPLOAD_MAX_FILE_SIZE" => "32",
	"USE_WATERMARK" => "N",
	"WATERMARK_RULES" => "USER",
	"PATH_TO_FONT" => "default.ttf",
	"WATERMARK_MIN_PICTURE_SIZE" => "800"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>