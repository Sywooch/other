<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/news/news_education/([a-zA-Z0-9_-]+)/#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "",
		"PATH" => "/news/news_education/detail.php",
	),
	array(
		"CONDITION" => "#^/services/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/services/index.php",
	),
	array(
		"CONDITION" => "#^/products/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/products/index.php",
	),
	array(
		"CONDITION" => "#^/news/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/news/index.php",
	),
);

?>