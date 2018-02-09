<?php

$OrderFirstName=$_POST['OrderFirstName'];
$OrderPhoneMobile=$_POST['OrderPhoneMobile'];
$time_start=$_POST['time_start'];
$time_end=$_POST['time_end'];
$name=$_POST['name'];
$link=$_POST['link'];

define('LANG', 's1');
define('SITE_ID', 's1');
define("NO_KEEP_STATISTIC", true);
 
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('main');
CModule::IncludeModule("iblock");


$message="Имя: ".$OrderFirstName."<br>"."Телефон: ".$OrderPhoneMobile."<br>"."Время: ".$time_start.":00 - ".$time_end.":00";


mail("gsu1234@mail.ru", "Заказ обратного звонка", $message, 
     "From: null@242770.ru \r\n"."Content-type: text/html \r\n" 
    ."X-Mailer: PHP/" . phpversion()); 




?>
