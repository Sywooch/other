<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("LONDON_SMARTBANNER_MESTO_DLA_BANNERA"),
	"DESCRIPTION" => GetMessage("LONDON_SMARTBANNER_VYVOD_BANNERA_ZADANN"),
	"ICON" => "/images/icon.gif",
	"SORT" => 12,
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "london", // for example "my_project"
		/*"CHILD" => array(
			"ID" => "", // for example "my_project:services"
			"NAME" => "",  // for example "Services"
		),*/
	),
	"COMPLEX" => "N",
);
?>