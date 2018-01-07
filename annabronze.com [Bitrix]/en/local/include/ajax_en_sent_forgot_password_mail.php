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



$email = $_POST["email"];
//$email = "gsu1234@mail.ru";


/*
//вычисляем логин
$res = Bitrix\Main\UserTable::getList(Array(
    "select" => Array("ID", "NAME", "LAST_NAME", "LOGIN", "EMAIL"),//Array("ID", "NAME", "LAST_NAME", "LOGIN")
    "filter" => Array("EMAIL" => $email),
));

if($arRes = $res->fetch()) {
    echo "<pre>";
    print_r($arRes);
    echo "</pre>";

    $login = '';
}*/


$login = '';


SendForgotPasswordEn::SendPasswordEn($login, $email, SITE_ID);






include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");