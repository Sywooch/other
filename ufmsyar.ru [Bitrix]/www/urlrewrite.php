<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/information/links/([a-zA-Z0-9_]+)/\\?{0,1}(.*)\$#",
		"RULE" => "/information/links/index.php?SECTION_CODE=\\1&\\2",
		"ID" => "",
		"PATH" => "",
	),
	array(
		"CONDITION" => "#^/board/([a-zA-Z0-9_]+)/\\?{0,1}(.*)\$#",
		"RULE" => "/board/index.php?SECTION_CODE=\\1&\\2",
		"ID" => "",
		"PATH" => "",
	),
	array(
		"CONDITION" => "#^/nationalnews/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/nationalnews/index.php",
	),
	array(
		"CONDITION" => "#^/press-tsentr/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/press-tsentr/index.php",
	),
	array(
		"CONDITION" => "#^/job/vacancy/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/job/vacancy/index.php",
	),
	array(
		"CONDITION" => "#^/job/resume/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/job/resume/index.php",
	),
	array(
		"CONDITION" => "#^/themes/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/themes/index.php",
	),
	array(
		"CONDITION" => "#^/blogs/#",
		"RULE" => "",
		"ID" => "bitrix:blog",
		"PATH" => "/blogs/index.php",
	),
	array(
		"CONDITION" => "#^/forum/#",
		"RULE" => "",
		"ID" => "bitrix:forum",
		"PATH" => "/forum/index.php",
	),
	array(
		"CONDITION" => "#^/photo/#",
		"RULE" => "",
		"ID" => "bitrix:photogallery_user",
		"PATH" => "/photo/index.php",
	),
	array(
		"CONDITION" => "#^/news/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/news/index.php",
	),
);

?>