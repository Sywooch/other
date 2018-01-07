<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords_inner", "handmade findings, bronze findings, jewelry findings, brass findings");
$APPLICATION->SetPageProperty("keywords", "handmade findings, bronze findings, jewelry findings, brass findings");
$APPLICATION->SetPageProperty("description", "Anna Bronze");
$APPLICATION->SetTitle("Anna Bronze handmade findings. Bronze, brass and silver plated findings for jewelry, beading and another handcrafted works.");
?>

<? $APPLICATION->IncludeComponent(
    "ad_shop:main_slider",
    ".default",
    array(
        "CACHE_TIME" => "3600",
        "CACHE_TYPE" => "A",
        "COUNT" => "0",
        "IBLOCK_ID" => "71",
        "IBLOCK_TYPE" => "sliders_en",
        "SORT_DIRECTION1" => "ASC",
        "SORT_DIRECTION2" => "ASC",
        "SORT_FIELD1" => "ID",
        "SORT_FIELD2" => "ID",
        "COMPONENT_TEMPLATE" => ".default"
    ),
    false
); ?>

<? ob_start(); ?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"shop_slider",
	Array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "21",
		"DISPLAY_PANEL" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "250000",
		"CACHE_GROUPS" => "N",
		"COUNT_ELEMENTS" => "N",
		"SECTION_URL" => "",
		"ADD_SECTIONS_CHAIN" => "N",
		"TOP_DEPTH" => "1",
        "SECTION_USER_FIELDS" => array('UF_HOME')
	),
	false
);
?>
    <div class="b-main-collection-top">
        <div class="grid-container">
            <!-- ====================== -->
            <? $APPLICATION->IncludeComponent(
                "ad_shop:special_product",
                ".default",
                array(
                    "CACHE_TIME" => "3600",
                    "CACHE_TYPE" => "A",
                    "IBLOCK_ID" => "73",
                    "IBLOCK_TYPE" => "content",
                    "COMPONENT_TEMPLATE" => ".default",
                    "COUNT" => "0",
                    "SORT_FIELD1" => "ID",
                    "SORT_DIRECTION1" => "ASC",
                    "SORT_FIELD2" => "ID",
                    "SORT_DIRECTION2" => "ASC"
                ),
                false
            ); ?>

            <div class="grid-row col-3 col-m-4  col-s-12">
                <div class="b-subscribe _on-main">
                    <? $APPLICATION->IncludeComponent(
                        "ad_shop:subscribe.form",
                        ".default",
                        array(
                            "CACHE_TIME" => "3600",
                            "CACHE_TYPE" => "A",
                            "RUB_ID" => "1",
                            "COMPONENT_TEMPLATE" => ".default"
                        ),
                        false
                    ); ?>
                </div>
            </div>
        </div>
    </div>

<? $APPLICATION->IncludeComponent(
    "ad_shop:main_top",
    ".default",
    array(
        "CACHE_TIME" => "3600",
        "CACHE_TYPE" => "A",
        "COUNT" => "8",
        "IBLOCK_ID" => "21",
        "IBLOCK_TYPE" => "catalog",
        "COMPONENT_TEMPLATE" => ".default"
    ),
    false
); ?>

    <div class="b-main-about">
        <div class="b-title js-content-title _no-marg _no-bg">
            <div class="b-title__row _title">
                <div class="b-title__title">ABOUT US</div>
            </div>
        </div>

        <div class="b-main-about__text">
            <?$APPLICATION->IncludeFile(SITE_DIR."/include/about_text.php", Array(), Array(
                "MODE"      => "html",
                "NAME"      => "About us",
            ));
            ?>
        </div>
        <div class="b-main-about__author">
            <div class="b-main-about__author-img">
                <img alt="" src="<?= SITE_TEMPLATE_PATH; ?>/images/author.png"/>
            </div>
            <div class="b-main-about__author-name">
                Anna Chernykh
            </div>
            <div class="b-main-about__author-pattern"></div>
        </div>
    </div>
    <div class="b-main-news">
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "main_left",
            array(
                "ACTIVE_DATE_FORMAT" => "j F",
                "ADD_SECTIONS_CHAIN" => "N",
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
                    0 => "ID",
                    1 => "CODE",
                    2 => "XML_ID",
                    3 => "NAME",
                    4 => "TAGS",
                    5 => "SORT",
                    6 => "PREVIEW_TEXT",
                    7 => "PREVIEW_PICTURE",
                    8 => "DETAIL_TEXT",
                    9 => "DETAIL_PICTURE",
                    10 => "DATE_ACTIVE_FROM",
                    11 => "ACTIVE_FROM",
                    12 => "DATE_ACTIVE_TO",
                    13 => "ACTIVE_TO",
                    14 => "SHOW_COUNTER",
                    15 => "SHOW_COUNTER_START",
                    16 => "IBLOCK_TYPE_ID",
                    17 => "IBLOCK_ID",
                    18 => "IBLOCK_CODE",
                    19 => "IBLOCK_NAME",
                    20 => "IBLOCK_EXTERNAL_ID",
                    21 => "DATE_CREATE",
                    22 => "CREATED_BY",
                    23 => "CREATED_USER_NAME",
                    24 => "TIMESTAMP_X",
                    25 => "MODIFIED_BY",
                    26 => "USER_NAME",
                    27 => "",
                ),
                "FILTER_NAME" => "",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => "34",
                "IBLOCK_TYPE" => "content",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "INCLUDE_SUBSECTIONS" => "Y",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "2",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Новости",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "PROPERTY_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "SET_BROWSER_TITLE" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_BY2" => "SORT",
                "SORT_ORDER1" => "DESC",
                "SORT_ORDER2" => "ASC",
                "COMPONENT_TEMPLATE" => "main_left"
            ),
            false
        ); ?>

        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "main_right",
            array(
                "ACTIVE_DATE_FORMAT" => "j F",
                "ADD_SECTIONS_CHAIN" => "N",
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
                "DETAIL_URL" => "#SITE_DIR#/info/master-klass/#ELEMENT_CODE#/",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "FIELD_CODE" => array(
                    0 => "ID",
                    1 => "CODE",
                    2 => "XML_ID",
                    3 => "NAME",
                    4 => "TAGS",
                    5 => "SORT",
                    6 => "PREVIEW_TEXT",
                    7 => "PREVIEW_PICTURE",
                    8 => "DETAIL_TEXT",
                    9 => "DETAIL_PICTURE",
                    10 => "DATE_ACTIVE_FROM",
                    11 => "ACTIVE_FROM",
                    12 => "DATE_ACTIVE_TO",
                    13 => "ACTIVE_TO",
                    14 => "SHOW_COUNTER",
                    15 => "SHOW_COUNTER_START",
                    16 => "IBLOCK_TYPE_ID",
                    17 => "IBLOCK_ID",
                    18 => "IBLOCK_CODE",
                    19 => "IBLOCK_NAME",
                    20 => "IBLOCK_EXTERNAL_ID",
                    21 => "DATE_CREATE",
                    22 => "CREATED_BY",
                    23 => "CREATED_USER_NAME",
                    24 => "TIMESTAMP_X",
                    25 => "MODIFIED_BY",
                    26 => "USER_NAME",
                    27 => "",
                ),
                "FILTER_NAME" => "",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => "48",
                "IBLOCK_TYPE" => "content",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "INCLUDE_SUBSECTIONS" => "Y",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "1",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Новости",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "PROPERTY_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "SET_BROWSER_TITLE" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_BY2" => "SORT",
                "SORT_ORDER1" => "DESC",
                "SORT_ORDER2" => "ASC",
                "COMPONENT_TEMPLATE" => "main_right"
            ),
            false
        ); ?>

    </div>

<? $APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
    "AREA_FILE_SHOW" => "file",
    "PATH" => "/include_areas/main_social_buttons.php",
    "EDIT_TEMPLATE" => ""
)); ?>

<? $APPLICATION->IncludeComponent(
    "ad_shop:main_slider",
    "bottom",
    array(
        "CACHE_TIME" => "3600",
        "CACHE_TYPE" => "A",
        "COUNT" => "0",
        "IBLOCK_ID" => "72",
        "IBLOCK_TYPE" => "sliders_en",
        "SORT_DIRECTION1" => "ASC",
        "SORT_DIRECTION2" => "ASC",
        "SORT_FIELD1" => "ID",
        "SORT_FIELD2" => "ID",
        "COMPONENT_TEMPLATE" => "bottom"
    ),
    false
); ?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>