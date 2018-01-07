<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 27.12.2016
 * Time: 18:09
 */

$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
set_time_limit(0);
//define("LANG", "ru");
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

global $APPLICATION;
CModule::IncludeModule('iblock');
CModule::IncludeModule('main');
CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");


if(CCatalogDiscountCoupon::IsExistCoupon($_POST["coupon"])){
    echo "Y";
}else{
    echo "N";
}




include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");