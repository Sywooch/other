<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
        "NAME" => GetMessage("IBLOCK_FILTER_TEMPLATE_NAME"),
        "DESCRIPTION" => GetMessage("IBLOCK_FILTER_TEMPLATE_DESCRIPTION"),
        "ICON" => "/images/icon.gif",
        "CACHE_PATH" => "Y",
        "SORT" => 70,
        "PATH" => array(
                "ID" => "IS-MARKET.RU",
                "CHILD" => array(
                        "ID" => "altasib_photoplayer",
                        "NAME" => GetMessage("T_IBLOCK_DESC_CATALOG"),
                        "SORT" => 30,
                        "CHILD" => array(
                                "ID" => "altasib_photoplayer1mod",
                        ),
                ),
        ),
);
?>
