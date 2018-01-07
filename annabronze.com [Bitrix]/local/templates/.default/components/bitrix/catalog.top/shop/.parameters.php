<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"FILTER_NAME" => Array(
		"NAME" => GetMessage("FILTER_NAME"),
		"TYPE" => "STRING",
		"DEFAULT" => "arrTopFilter",
	),
	"SHOW_MEASURE" => Array(
			"NAME" => GetMessage("SHOW_MEASURE"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
	),
);
?>
