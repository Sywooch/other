<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 21.03.2017
 * Time: 20:22
 * отправщик писем для тестирования
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



$allBcc = COption::GetOptionString("main", "all_bcc");

$arAllBcc = explode(",", $allBcc);


$arFilter = array(
    "LID"  => array("ru","en"),
    "ACTIVE" => "Y"
);



foreach($arAllBcc as $itemMail){


    Bitrix\Main\Mail\Event::send(array(
        "EVENT_NAME" => "NEW_USER_CONFIRM_ru",
        "LID" => "ru",
        "C_FIELDS" => array(
            "EMAIL" => $itemMail,
            "SERVER_NAME" => $_SERVER['SERVER_NAME']
        ),
    ));



}



/*
$rsET = CEventType::GetList($arFilter);
while ($arET = $rsET->Fetch())
{

    echo "Тип почтового события: ".$arET["EVENT_NAME"].", Язык: ".$arET["LID"]."<br>";

    foreach($arAllBcc as $itemMail){



        Bitrix\Main\Mail\Event::send(array(
            "EVENT_NAME" => $arET["EVENT_NAME"],
            "LID" => $arET["LID"],
            "C_FIELDS" => array(
                "EMAIL" => $itemMail,
                "SERVER_NAME" => $_SERVER['SERVER_NAME']
            ),
        ));

    }

}

*/






include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");