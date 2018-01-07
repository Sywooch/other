<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = array(
	"PARAMETERS" => array(
		"CACHE_TIME"  =>  Array("DEFAULT"=>36000000),
		"CACHE_GROUPS" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => GetMessage("CP_BND_CACHE_GROUPS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"VK" => array(
			"PARENT" => "SOCIAL",
			"NAME" => GetMessage("VKONTAKTE"),
			"TYPE" => "STRING",
			"DEFAULT" => "http://vk.com/findings"
		),
		"FACE" => array(
			"PARENT" => "SOCIAL",
			"NAME" => "Facebook",
			"TYPE" => "STRING",
			"DEFAULT" => "https://www.facebook.com/AnnaFindings"
		),
		"TWIT" => array(
			"PARENT" => "SOCIAL",
			"NAME" => "Twitter",
			"TYPE" => "STRING"
		),
        "INST" => array(
            "PARENT" => "SOCIAL",
            "NAME" => "Instagram",
            "TYPE" => "STRING"
        ),
        "PINT" => array(
            "PARENT" => "SOCIAL",
            "NAME" => "Pinterest",
            "TYPE" => "STRING"
        ),
	),
);
?><br>