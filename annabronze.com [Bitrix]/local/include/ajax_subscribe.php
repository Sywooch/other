<?php
define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

if(!CModule::IncludeModule('iblock')) die();

$APPLICATION->IncludeComponent( "ad_shop:subscribe.form", "", Array());
?>
