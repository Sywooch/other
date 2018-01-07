<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<div class="body-blog">

	<div class="blog-post-current">
		<div class="grid-row col-1 col-xm-12 col-s-12"></div>
		<div class="b-layout__inner-content grid-row col-10 col-xm-12  col-s-12">
<?/*
$APPLICATION->IncludeComponent(
	"bitrix:blog.menu",
	"",
	Array(
			"BLOG_VAR"				=> $arResult["ALIASES"]["blog"],
			"POST_VAR"				=> $arResult["ALIASES"]["post_id"],
			"USER_VAR"				=> $arResult["ALIASES"]["user_id"],
			"PAGE_VAR"				=> $arResult["ALIASES"]["page"],
			"PATH_TO_BLOG"			=> $arResult["PATH_TO_BLOG"],
			"PATH_TO_USER"			=> $arResult["PATH_TO_USER"],
			"PATH_TO_BLOG_EDIT"		=> $arResult["PATH_TO_BLOG_EDIT"],
			"PATH_TO_BLOG_INDEX"	=> $arResult["PATH_TO_BLOG_INDEX"],
			"PATH_TO_DRAFT"			=> $arResult["PATH_TO_DRAFT"],
			"PATH_TO_POST_EDIT"		=> $arResult["PATH_TO_POST_EDIT"],
			"PATH_TO_USER_FRIENDS"	=> $arResult["PATH_TO_USER_FRIENDS"],
			"PATH_TO_USER_SETTINGS"	=> $arResult["PATH_TO_USER_SETTINGS"],
			"PATH_TO_GROUP_EDIT"	=> $arResult["PATH_TO_GROUP_EDIT"],
			"PATH_TO_CATEGORY_EDIT"	=> $arResult["PATH_TO_CATEGORY_EDIT"],
			"PATH_TO_RSS_ALL"		=> $arResult["PATH_TO_RSS_ALL"],
			"BLOG_URL"				=> $arResult["VARIABLES"]["blog"],
			"SET_NAV_CHAIN"			=> $arResult["SET_NAV_CHAIN"],
			"GROUP_ID" 			=> $arParams["GROUP_ID"],
		),
	$component
);*/
?>
<?
$APPLICATION->IncludeComponent(
	"bitrix:blog.menu",
	"",
	Array(
		"BLOG_VAR"				=> $arResult["ALIASES"]["blog"],
		"POST_VAR"				=> $arResult["ALIASES"]["post_id"],
		"USER_VAR"				=> $arResult["ALIASES"]["user_id"],
		"PAGE_VAR"				=> $arResult["ALIASES"]["page"],
		"PATH_TO_BLOG"			=> $arResult["PATH_TO_BLOG"],
		"PATH_TO_USER"			=> $arResult["PATH_TO_USER"],
		"PATH_TO_BLOG_EDIT"		=> $arResult["PATH_TO_BLOG_EDIT"],
		"PATH_TO_BLOG_INDEX"	=> $arResult["PATH_TO_BLOG_INDEX"],
		"PATH_TO_DRAFT"			=> $arResult["PATH_TO_DRAFT"],
		"PATH_TO_POST_EDIT"		=> $arResult["PATH_TO_POST_EDIT"],
		"PATH_TO_USER_FRIENDS"	=> $arResult["PATH_TO_USER_FRIENDS"],
		"PATH_TO_USER_SETTINGS"	=> $arResult["PATH_TO_USER_SETTINGS"],
		"PATH_TO_GROUP_EDIT"	=> $arResult["PATH_TO_GROUP_EDIT"],
		"PATH_TO_CATEGORY_EDIT"	=> $arResult["PATH_TO_CATEGORY_EDIT"],
		"PATH_TO_RSS_ALL"		=> $arResult["PATH_TO_RSS_ALL"],
		"BLOG_URL"				=> $arResult["VARIABLES"]["blog"],
		"SET_NAV_CHAIN"			=> $arResult["SET_NAV_CHAIN"],
		"GROUP_ID" 			=> $arParams["GROUP_ID"],
	),
	$component
);
?>

		</div>

	</div>
	<div class="clear"></div>

	<?
	$arBigResult["ALIASES"] = $arResult["ALIASES"];
	$arBigResult["PATH_TO_BLOG"] = $arResult["PATH_TO_BLOG"];
	$arBigResult["PATH_TO_POST"] = $arResult["PATH_TO_POST"];
	$arBigResult["PATH_TO_USER"] = $arResult["PATH_TO_USER"];
	$arBigResult["PATH_TO_SMILE"] = $arResult["PATH_TO_SMILE"];
	$arBigResult["VARIABLES"] = $arResult["VARIABLES"];
	$arBigResult["CACHE_TYPE"] = $arResult["CACHE_TYPE"];
	$arBigResult["CACHE_TIME"] = $arResult["CACHE_TIME"];
	$arBigResult["COMMENTS_COUNT"] = $arResult["COMMENTS_COUNT"];

	?>

<?
$APPLICATION->IncludeComponent(
		"bitrix:blog.post", 
		"shop",
		Array(
				"BLOG_VAR"				=> $arResult["ALIASES"]["blog"],
				"POST_VAR"				=> $arResult["ALIASES"]["post_id"],
				"USER_VAR"				=> $arResult["ALIASES"]["user_id"],
				"PAGE_VAR"				=> $arResult["ALIASES"]["page"],
				"PATH_TO_BLOG"			=> $arResult["PATH_TO_BLOG"],
				"PATH_TO_POST"			=> $arResult["PATH_TO_POST"],				
				"PATH_TO_BLOG_CATEGORY"	=> $arResult["PATH_TO_BLOG_CATEGORY"],
				"PATH_TO_POST_EDIT"		=> $arResult["PATH_TO_POST_EDIT"],
				"PATH_TO_USER"			=> $arResult["PATH_TO_USER"],
				"PATH_TO_SMILE"			=> $arResult["PATH_TO_SMILE"],
				"BLOG_URL"				=> $arResult["VARIABLES"]["blog"],
				"ID"					=> $arResult["VARIABLES"]["post_id"],
				"CACHE_TYPE"			=> $arResult["CACHE_TYPE"],
				"CACHE_TIME"			=> $arResult["CACHE_TIME"],
				"SET_NAV_CHAIN"			=> $arResult["SET_NAV_CHAIN"],
				"SET_TITLE"				=> $arResult["SET_TITLE"],
				"POST_PROPERTY"			=> $arParams["POST_PROPERTY"],
				"DATE_TIME_FORMAT"		=> $arResult["DATE_TIME_FORMAT"],
				"GROUP_ID" 				=> $arParams["GROUP_ID"],
				"SEO_USER"				=> $arParams["SEO_USER"],
				"NAME_TEMPLATE" 		=> $arParams["NAME_TEMPLATE"],
				"SHOW_LOGIN" 			=> $arParams["SHOW_LOGIN"],
				"PATH_TO_CONPANY_DEPARTMENT"	=> $arParams["PATH_TO_CONPANY_DEPARTMENT"],
				"PATH_TO_SONET_USER_PROFILE" 	=> $arParams["PATH_TO_SONET_USER_PROFILE"],
				"PATH_TO_MESSAGES_CHAT" => $arParams["PATH_TO_MESSAGES_CHAT"],
				"PATH_TO_VIDEO_CALL" 	=> $arParams["PATH_TO_VIDEO_CALL"],
				"USE_SHARE" 			=> $arParams["USE_SHARE"],
				"SHARE_HIDE" 			=> $arParams["SHARE_HIDE"],
				"SHARE_TEMPLATE" 		=> $arParams["SHARE_TEMPLATE"],
				"SHARE_HANDLERS" 		=> $arParams["SHARE_HANDLERS"],
				"SHARE_SHORTEN_URL_LOGIN"	=> $arParams["SHARE_SHORTEN_URL_LOGIN"],
				"SHARE_SHORTEN_URL_KEY" 	=> $arParams["SHARE_SHORTEN_URL_KEY"],
				"SHOW_RATING" => $arParams["SHOW_RATING"],
				"RATING_TYPE" => $arParams["RATING_TYPE"],
				"IMAGE_MAX_WIDTH" => $arParams["IMAGE_MAX_WIDTH"],
				"IMAGE_MAX_HEIGHT" => $arParams["IMAGE_MAX_HEIGHT"],
				"ALLOW_POST_CODE" => $arParams["ALLOW_POST_CODE"],
				"SEO_USE" => $arParams["SEO_USE"],
				"BIG_RESULT" => $arBigResult,
				"BIG_PARAMS" => $arParams,
			),
		$component 
	);
	?>


	<?
	$APPLICATION->IncludeComponent(
		"bitrix:blog.post.comment",
		"shop",//shop
		Array(
			"BLOG_VAR"		=> $arResult["ALIASES"]["blog"],
			"USER_VAR"		=> $arResult["ALIASES"]["user_id"],
			"PAGE_VAR"		=> $arResult["ALIASES"]["page"],
			"POST_VAR"			=> $arResult["ALIASES"]["post_id"],
			"PATH_TO_BLOG"	=> $arResult["PATH_TO_BLOG"],
			"PATH_TO_POST"	=> $arResult["PATH_TO_POST"],
			"PATH_TO_USER"	=> $arResult["PATH_TO_USER"],
			"PATH_TO_SMILE"	=> $arResult["PATH_TO_SMILE"],
			"BLOG_URL"		=> $arResult["VARIABLES"]["blog"],
			"ID"			=> $arResult["VARIABLES"]["post_id"],
			"CACHE_TYPE"	=> $arResult["CACHE_TYPE"],
			"CACHE_TIME"	=> $arResult["CACHE_TIME"],
			"COMMENTS_COUNT" => $arResult["COMMENTS_COUNT"],
			"DATE_TIME_FORMAT"	=> "d | m | y",
			"USE_ASC_PAGING"	=> "N",
			"NOT_USE_COMMENT_TITLE"	=> $arParams["NOT_USE_COMMENT_TITLE"],
			"GROUP_ID" 			=> $arParams["GROUP_ID"],
			"SEO_USER"			=> $arParams["SEO_USER"],
			"NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"],
			"SHOW_LOGIN" => $arParams["SHOW_LOGIN"],
			"PATH_TO_CONPANY_DEPARTMENT" => $arParams["PATH_TO_CONPANY_DEPARTMENT"],
			"PATH_TO_SONET_USER_PROFILE" => $arParams["PATH_TO_SONET_USER_PROFILE"],
			"PATH_TO_MESSAGES_CHAT" => $arParams["PATH_TO_MESSAGES_CHAT"],
			"PATH_TO_VIDEO_CALL" => $arParams["PATH_TO_VIDEO_CALL"],
			"SHOW_RATING" => $arParams["SHOW_RATING"],
			"RATING_TYPE" => $arParams["RATING_TYPE"],
			"SMILES_COUNT" => $arParams["SMILES_COUNT"],
			"IMAGE_MAX_WIDTH" => $arParams["IMAGE_MAX_WIDTH"],
			"IMAGE_MAX_HEIGHT" => $arParams["IMAGE_MAX_HEIGHT"],
			"EDITOR_RESIZABLE" => $arParams["COMMENT_EDITOR_RESIZABLE"],
			"EDITOR_DEFAULT_HEIGHT" => $arParams["COMMENT_EDITOR_DEFAULT_HEIGHT"],
			"EDITOR_CODE_DEFAULT" => "Y",//$arParams["COMMENT_EDITOR_CODE_DEFAULT"],
			"ALLOW_VIDEO" => $arParams["COMMENT_ALLOW_VIDEO"],
			"ALLOW_IMAGE_UPLOAD" => $arParams["COMMENT_ALLOW_IMAGE_UPLOAD"],
			"ALLOW_POST_CODE" => $arParams["ALLOW_POST_CODE"],
			"SHOW_SPAM" => $arParams["SHOW_SPAM"],
			"NO_URL_IN_COMMENTS" => $arParams["NO_URL_IN_COMMENTS"],
			"NO_URL_IN_COMMENTS_AUTHORITY" => $arParams["NO_URL_IN_COMMENTS_AUTHORITY"],
			"AJAX_POST" => "Y",//$arParams["AJAX_POST"],
			"COMMENT_PROPERTY" => $arParams["COMMENT_PROPERTY"],
			"USE_CAPTCHA" => "N",
			"ENABLE_IMG_VERIF" => "N"
		),
		$component
	);
	?>

</div>