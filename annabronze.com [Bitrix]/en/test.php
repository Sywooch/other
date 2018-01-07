<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle(""); ?><?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.form", 
	"ad_shop_auth", 
	array(
		"FORGOT_PASSWORD_URL" => "",
		"PROFILE_URL" => "",
		"REGISTER_URL" => "",
		"SHOW_ERRORS" => "N",
		"COMPONENT_TEMPLATE" => "ad_shop_auth"
	),
	false
);?><br>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>