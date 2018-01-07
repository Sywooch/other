<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Subscribe Anna Bronze");
?> 
<div>
  <br />
</div>
 <?$APPLICATION->IncludeComponent(
	"bitrix:subscribe.form",
	"template1",
	Array(
		"USE_PERSONALIZATION" => "Y",
		"SHOW_HIDDEN" => "N",
		"PAGE" => "#SITE_DIR#personal/subscribe/subscr_edit.php",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>