<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 02.02.2017
 * Time: 21:53
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


$user_id = $USER->GetID();

if(IntVal($arParams["ID"])>0)
    $arResult["Perm"] = CBlogPost::GetBlogUserCommentPerms($arParams["ID"], $user_id);
else
    $arResult["Perm"] = CBlog::GetBlogUserCommentPerms($arBlog["ID"], $user_id);


//Comments output
if($arResult["Perm"]>=BLOG_PERMS_READ) {
    $arResult["CanUserComment"] = false;
    if ($arResult["Perm"] >= BLOG_PERMS_PREMODERATE)
        $arResult["CanUserComment"] = true;

}


$arParams["BLOG_VAR"] = $arParams["BIG_RESULT"]["ALIASES"]["blog"];
$arParams["USER_VAR"] = $arParams["BIG_RESULT"]["ALIASES"]["user_id"];
$arParams["PAGE_VAR"] = $arParams["BIG_RESULT"]["ALIASES"]["page"];
$arParams["POST_VAR"] = $arParams["BIG_RESULT"]["ALIASES"]["post_id"];
$arParams["PATH_TO_BLOG"] = $arParams["BIG_RESULT"]["PATH_TO_BLOG"];
$arParams["PATH_TO_POST"] = $arParams["BIG_RESULT"]["PATH_TO_POST"];
$arParams["PATH_TO_USER"] = $arParams["BIG_RESULT"]["PATH_TO_USER"];
$arParams["PATH_TO_SMILE"] = $arParams["BIG_RESULT"]["PATH_TO_SMILE"];



$arParams["BLOG_URL"] = $arParams["BIG_RESULT"]["VARIABLES"]["blog"];
$arParams["ID"] = $arParams["BIG_RESULT"]["VARIABLES"]["post_id"];

$arParams["CACHE_TYPE"] = $arParams["BIG_RESULT"]["CACHE_TYPE"];
$arParams["CACHE_TIME"] = $arParams["BIG_RESULT"]["CACHE_TIME"];
$arParams["COMMENTS_COUNT"] = $arParams["BIG_RESULT"]["COMMENTS_COUNT"];
$arParams["DATE_TIME_FORMAT"] = "d | m | y";
$arParams["USE_ASC_PAGING"] = "N";




$arParams["NOT_USE_COMMENT_TITLE"] = $arParams["BIG_PARAMS"]["NOT_USE_COMMENT_TITLE"];
$arParams["GROUP_ID"] = $arParams["BIG_PARAMS"]["GROUP_ID"];
$arParams["SEO_USER"] = $arParams["BIG_PARAMS"]["SEO_USER"];
$arParams["NAME_TEMPLATE"] = $arParams["BIG_PARAMS"]["NAME_TEMPLATE"];
$arParams["SHOW_LOGIN"] = $arParams["BIG_PARAMS"]["SHOW_LOGIN"];
$arParams["PATH_TO_CONPANY_DEPARTMENT"] = $arParams["BIG_PARAMS"]["PATH_TO_CONPANY_DEPARTMENT"];
$arParams["PATH_TO_SONET_USER_PROFILE"] = $arParams["BIG_PARAMS"]["PATH_TO_SONET_USER_PROFILE"];
$arParams["PATH_TO_MESSAGES_CHAT"] = $arParams["BIG_PARAMS"]["PATH_TO_MESSAGES_CHAT"];
$arParams["PATH_TO_VIDEO_CALL"] = $arParams["BIG_PARAMS"]["PATH_TO_VIDEO_CALL"];
$arParams["SHOW_RATING"] = $arParams["BIG_PARAMS"]["SHOW_RATING"];
$arParams["RATING_TYPE"] = $arParams["BIG_PARAMS"]["RATING_TYPE"];
$arParams["SMILES_COUNT"] = $arParams["BIG_PARAMS"]["SMILES_COUNT"];
$arParams["IMAGE_MAX_WIDTH"] = $arParams["BIG_PARAMS"]["IMAGE_MAX_WIDTH"];
$arParams["IMAGE_MAX_HEIGHT"] = $arParams["BIG_PARAMS"]["IMAGE_MAX_HEIGHT"];
$arParams["EDITOR_RESIZABLE"] = $arParams["BIG_PARAMS"]["COMMENT_EDITOR_RESIZABLE"];
$arParams["EDITOR_DEFAULT_HEIGHT"] = $arParams["BIG_PARAMS"]["COMMENT_EDITOR_DEFAULT_HEIGHT"];
$arParams["EDITOR_CODE_DEFAULT"] = "Y";//$arParams["COMMENT_EDITOR_CODE_DEFAULT"],
$arParams["ALLOW_VIDEO"] = $arParams["BIG_PARAMS"]["COMMENT_ALLOW_VIDEO"];
$arParams["ALLOW_IMAGE_UPLOAD"] = $arParams["BIG_PARAMS"]["COMMENT_ALLOW_IMAGE_UPLOAD"];
$arParams["ALLOW_POST_CODE"] = $arParams["BIG_PARAMS"]["ALLOW_POST_CODE"];
$arParams["SHOW_SPAM"] = $arParams["BIG_PARAMS"]["SHOW_SPAM"];
$arParams["NO_URL_IN_COMMENTS"] = $arParams["BIG_PARAMS"]["NO_URL_IN_COMMENTS"];
$arParams["NO_URL_IN_COMMENTS_AUTHORITY"] = $arParams["BIG_PARAMS"]["NO_URL_IN_COMMENTS_AUTHORITY"];
$arParams["AJAX_POST"] = "Y";//$arParams["AJAX_POST"],
//$arParams["COMMENT_PROPERTY"] = $arParams["COMMENT_PROPERTY"];
$arParams["USE_CAPTCHA"] = "N";
$arParams["ENABLE_IMG_VERIF"] = "N";




$arParams["ID"] = trim($arParams["ID"]);
$bIDbyCode = false;
if(!is_numeric($arParams["ID"]) || strlen(IntVal($arParams["ID"])) != strlen($arParams["ID"]))
{
    $arParams["ID"] = preg_replace("/[^a-zA-Z0-9_-]/is", "", Trim($arParams["~ID"]));
    $bIDbyCode = true;
}
else
    $arParams["ID"] = IntVal($arParams["ID"]);

$arParams["BLOG_URL"] = preg_replace("/[^a-zA-Z0-9_-]/is", "", Trim($arParams["BLOG_URL"]));
if(!is_array($arParams["GROUP_ID"]))
    $arParams["GROUP_ID"] = array($arParams["GROUP_ID"]);
foreach($arParams["GROUP_ID"] as $k=>$v)
    if(IntVal($v) <= 0)
        unset($arParams["GROUP_ID"][$k]);

if ($arParams["CACHE_TYPE"] == "Y" || ($arParams["CACHE_TYPE"] == "A" && COption::GetOptionString("main", "component_cache_on", "Y") == "Y"))
    $arParams["CACHE_TIME"] = intval($arParams["CACHE_TIME"]);
else
    $arParams["CACHE_TIME"] = 0;

if(strLen($arParams["BLOG_VAR"])<=0)
    $arParams["BLOG_VAR"] = "blog";
if(strLen($arParams["PAGE_VAR"])<=0)
    $arParams["PAGE_VAR"] = "page";
if(strLen($arParams["USER_VAR"])<=0)
    $arParams["USER_VAR"] = "id";
if(strLen($arParams["POST_VAR"])<=0)
    $arParams["POST_VAR"] = "id";
if(strLen($arParams["NAV_PAGE_VAR"])<=0)
    $arParams["NAV_PAGE_VAR"] = "pagen";
if(strLen($arParams["COMMENT_ID_VAR"])<=0)
    $arParams["COMMENT_ID_VAR"] = "commentId";
if(IntVal($_GET[$arParams["NAV_PAGE_VAR"]])>0)
    $pagen = IntVal($_REQUEST[$arParams["NAV_PAGE_VAR"]]);
else
    $pagen = 1;

if(IntVal($arParams["COMMENTS_COUNT"])<=0)
    $arParams["COMMENTS_COUNT"] = 25;

if($arParams["USE_ASC_PAGING"] != "Y")
    $arParams["USE_DESC_PAGING"] = "Y";

$arParams["PATH_TO_BLOG"] = trim($arParams["PATH_TO_BLOG"]);
if(strlen($arParams["PATH_TO_BLOG"])<=0)
    $arParams["PATH_TO_BLOG"] = htmlspecialcharsbx($APPLICATION->GetCurPage()."?".$arParams["PAGE_VAR"]."=blog&".$arParams["BLOG_VAR"]."=#blog#");

$arParams["PATH_TO_USER"] = trim($arParams["PATH_TO_USER"]);
if(strlen($arParams["PATH_TO_USER"])<=0)
    $arParams["PATH_TO_USER"] = htmlspecialcharsbx($APPLICATION->GetCurPage()."?".$arParams["PAGE_VAR"]."=user&".$arParams["USER_VAR"]."=#user_id#");

$arParams["PATH_TO_POST"] = trim($arParams["PATH_TO_POST"]);
if(strlen($arParams["PATH_TO_POST"])<=0)
    $arParams["PATH_TO_POST"] = htmlspecialcharsbx($APPLICATION->GetCurPage()."?".$arParams["PAGE_VAR"]."=post&".$arParams["BLOG_VAR"]."=#blog#"."&".$arParams["POST_VAR"]."=#post_id#");

$arParams["PATH_TO_SMILE"] = strlen(trim($arParams["PATH_TO_SMILE"]))<=0 ? false : trim($arParams["PATH_TO_SMILE"]);

if (!array_key_exists("PATH_TO_CONPANY_DEPARTMENT", $arParams))
    $arParams["PATH_TO_CONPANY_DEPARTMENT"] = "/company/structure.php?set_filter_structure=Y&structure_UF_DEPARTMENT=#ID#";
if (!array_key_exists("PATH_TO_MESSAGES_CHAT", $arParams))
    $arParams["PATH_TO_MESSAGES_CHAT"] = "/company/personal/messages/chat/#user_id#/";
if (!array_key_exists("PATH_TO_VIDEO_CALL", $arParams))
    $arParams["PATH_TO_VIDEO_CALL"] = "/company/personal/video/#user_id#/";

if (strlen(trim($arParams["NAME_TEMPLATE"])) <= 0)
    $arParams["NAME_TEMPLATE"] = CSite::GetNameFormat();
$arParams['SHOW_LOGIN'] = $arParams['SHOW_LOGIN'] != "N" ? "Y" : "N";
$arParams["IMAGE_MAX_WIDTH"] = IntVal($arParams["IMAGE_MAX_WIDTH"]);
$arParams["IMAGE_MAX_HEIGHT"] = IntVal($arParams["IMAGE_MAX_HEIGHT"]);
$arParams["ALLOW_POST_CODE"] = $arParams["ALLOW_POST_CODE"] !== "N";

if($arParams["SIMPLE_COMMENT"] == "Y")
    $simpleComment = true;
else
    $simpleComment = false;

$bUseTitle = true;
$arParams["NOT_USE_COMMENT_TITLE"] = ($arParams["NOT_USE_COMMENT_TITLE"] != "Y") ? "N" : "Y";
if($arParams["NOT_USE_COMMENT_TITLE"] == "Y")
    $bUseTitle = false;

$arParams["SMILES_COUNT"] = IntVal($arParams["SMILES_COUNT"]);
if(IntVal($arParams["SMILES_COUNT"])<=0)
    $arParams["SMILES_COUNT"] = 4;

$arParams["SMILES_COLS"] = IntVal($arParams["SMILES_COLS"]);
if(IntVal($arParams["SMILES_COLS"]) <= 0)
    $arParams["SMILES_COLS"] = 0;

$commentUrlID = IntVal($_REQUEST[$arParams["COMMENT_ID_VAR"]]);

$arParams["DATE_TIME_FORMAT"] = trim(empty($arParams["DATE_TIME_FORMAT"]) ? $DB->DateFormatToPHP(CSite::GetDateFormat("FULL")) : $arParams["DATE_TIME_FORMAT"]);
// activation rating
CRatingsComponentsMain::GetShowRating($arParams);

$arParams["EDITOR_RESIZABLE"] = $arParams["EDITOR_RESIZABLE"] !== "N";
$arParams["EDITOR_CODE_DEFAULT"] = $arParams["EDITOR_CODE_DEFAULT"] === "Y";
$arParams["EDITOR_DEFAULT_HEIGHT"] = intVal($arParams["EDITOR_DEFAULT_HEIGHT"]);
if(IntVal($arParams["EDITOR_DEFAULT_HEIGHT"]) <= 0)
    $arParams["EDITOR_DEFAULT_HEIGHT"] = 200;
$arParams["ALLOW_VIDEO"] = ($arParams["ALLOW_VIDEO"] == "Y" ? "Y" : "N");
if(COption::GetOptionString("blog","allow_video", "Y") == "Y" && $arParams["ALLOW_VIDEO"] == "Y")
    $arResult["allowVideo"] = true;

if($arParams["ALLOW_IMAGE_UPLOAD"] == "A" || ($arParams["ALLOW_IMAGE_UPLOAD"] == "R" && $USER->IsAuthorized()))
    $arResult["allowImageUpload"] = true;
$arResult["Images"] = Array();

if($arResult["allowImageUpload"])
{
    if(!is_array($arParams["COMMENT_PROPERTY"]))
        $arParams["COMMENT_PROPERTY"] = Array("UF_BLOG_COMMENT_DOC");
    else
        $arParams["COMMENT_PROPERTY"][] = "UF_BLOG_COMMENT_DOC";
}

$arResult["userID"] = $user_id = $USER->GetID();
$arResult["canModerate"] = false;
$arParams["AJAX_POST"] = ($arParams["AJAX_POST"] == "Y" ? "Y" : "N");

$arResult["ajax_comment"] = 0;

$blogModulePermissions = $GLOBALS["APPLICATION"]->GetGroupRight("blog");
$arParams["SHOW_SPAM"] = ($arParams["SHOW_SPAM"] == "Y" && $blogModulePermissions >= "W" ? "Y" : "N");

if($arParams["NO_URL_IN_COMMENTS"] == "L")
{
    $arResult["NoCommentUrl"] = true;
    $arResult["NoCommentReason"] = GetMessage("B_B_PC_MES_NOCOMMENTREASON_L");
}
if(!$USER->IsAuthorized() && $arParams["NO_URL_IN_COMMENTS"] == "A")
{
    $arResult["NoCommentUrl"] = true;
    $arResult["NoCommentReason"] = GetMessage("B_B_PC_MES_NOCOMMENTREASON_A");
}

if(is_numeric($arParams["NO_URL_IN_COMMENTS_AUTHORITY"]))
{
    $arParams["NO_URL_IN_COMMENTS_AUTHORITY"] = floatVal($arParams["NO_URL_IN_COMMENTS_AUTHORITY"]);
    $arParams["NO_URL_IN_COMMENTS_AUTHORITY_CHECK"] = "Y";
    if($USER->IsAuthorized())
    {
        $authorityRatingId = CRatings::GetAuthorityRating();
        $arRatingResult = CRatings::GetRatingResult($authorityRatingId, $user_id);
        if($arRatingResult["CURRENT_VALUE"] < $arParams["NO_URL_IN_COMMENTS_AUTHORITY"])
        {
            $arResult["NoCommentUrl"] = true;
            $arResult["NoCommentReason"] = GetMessage("B_B_PC_MES_NOCOMMENTREASON_R");
        }
    }
}

$arBlog = CBlog::GetByUrl($arParams["BLOG_URL"], $arParams["GROUP_ID"]);
$arBlog = CBlogTools::htmlspecialcharsExArray($arBlog);

$arGroup = CBlogGroup::GetByID($arBlog["GROUP_ID"]);
$arResult["Blog"] = $arBlog;

if($bIDbyCode)
    $arParams["ID"] = CBlogPost::GetID($arParams["ID"], $arBlog["ID"]);


$arPost = CBlogPost::GetByID($arParams["ID"]);



if(empty($arPost) && !$bIDbyCode)
{
    $arParams["ID"] = CBlogPost::GetID($arParams["ID"], $arBlog["ID"]);
    $arPost = CBlogPost::GetByID($arParams["ID"]);
}
if(IntVal($arParams["ID"])>0)
    $arResult["Perm"] = CBlogPost::GetBlogUserCommentPerms($arParams["ID"], $user_id);
else
    $arResult["Perm"] = CBlog::GetBlogUserCommentPerms($arBlog["ID"], $user_id);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_REQUEST['mfi_mode']) && ($_REQUEST['mfi_mode'] == "upload"))
{
    CBlogImage::AddImageResizeHandler(array("width" => 400, "height" => 400));
}


if(((!empty($arPost) && $arPost["PUBLISH_STATUS"] == BLOG_PUBLISH_STATUS_PUBLISH && $arPost["ENABLE_COMMENTS"] == "Y") || $simpleComment) && (($arBlog["ACTIVE"] == "Y" && $arGroup["SITE_ID"] == SITE_ID) || $simpleComment) ) {
    $arPost = CBlogTools::htmlspecialcharsExArray($arPost);
    //$arResult["Post"] = $arPost;

    if ($arPost["BLOG_ID"] == $arBlog["ID"] || $simpleComment) {
        $arResult["CanUserComment"] = true;

    }else{
        $arResult["CanUserComment"] = false;
    }

}else{
    $arResult["CanUserComment"] = false;
}
/*
*/

?>