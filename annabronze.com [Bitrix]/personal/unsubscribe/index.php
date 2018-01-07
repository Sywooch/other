<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Anna Bronze. Авторская фурнитура Анны Черных");
$APPLICATION->SetTitle("Отписаться от новостной рассылки Anna Bronze");
?>
<?$APPLICATION->IncludeComponent(
    "ad_shop:subscribe.unsubscribe",
    "",
    Array()
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>