<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?IncludeTemplateLangFile(__FILE__); global $APPLICATION; CJSCore::Init(array("fx"));

if (!$USER->IsAuthorized()) {
	CJSCore::Init(array('ajax', 'json', 'ls', 'session', 'jquery', 'popup', 'pull'));
}

$path = $APPLICATION->GetCurUri();

if(strpos($path, "/basket/") !== false){
	$GLOBALS["IS_BASKET_PAGE"] = true;
}else{
	$GLOBALS["IS_BASKET_PAGE"] = false;
}


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?$APPLICATION->ShowTitle()?></title>

	<script type="text/javascript">
		window.languageId = "<?=LANGUAGE_ID;?>";
	</script>

	<?$APPLICATION->ShowMeta("viewport");?>
	<!------head------>

	<?$APPLICATION->ShowHead();?>

	<?
	use Bitrix\Main\Page\Asset;

	Asset::getInstance()->addJs(BX_DEFAULT_TEMPLATE_PATH . "/js/_vendor.js");
	Asset::getInstance()->addJs(BX_DEFAULT_TEMPLATE_PATH . "/js/_main.js");
	Asset::getInstance()->addCss(BX_DEFAULT_TEMPLATE_PATH . "/css/style.css");
	Asset::getInstance()->addString('<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">', true);
	?>
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<![endif]-->
	<!------head------>
	<?$APPLICATION->ShowViewContent('social');  ?>

	<link rel="apple-touch-icon" sizes="180x180" href="<?=BX_DEFAULT_TEMPLATE_PATH?>/favicons/apple-touch-icon.png">
	<link rel="icon" type="image/png" href="<?=BX_DEFAULT_TEMPLATE_PATH?>/favicons/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="<?=BX_DEFAULT_TEMPLATE_PATH?>/favicons/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="<?=BX_DEFAULT_TEMPLATE_PATH?>/favicons/manifest.json">
	<link rel="mask-icon" href="<?=BX_DEFAULT_TEMPLATE_PATH?>/favicons/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="theme-color" content="#d3a67a">

    <meta name="yandex-verification" content="74e4b798a9ec10fe" />
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-72484928-1', 'auto');
        ga('send', 'pageview');
    </script>

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter34710825 = new Ya.Metrika({ id:34710825, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/34710825" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
</head>
<body  class="<? if(CSite::InDir('/index.php') || CSite::InDir('/en/index.php')){ echo '_is-main-page'; };?> <?=LANGUAGE_ID;?>">


<div class="b-form__preload-container js-form__preload-container is-loading">

</div>



<?$en = (SITE_ID == "en")? "/en" : ""?>
	<div id="panel"><?$APPLICATION->ShowPanel();?></div>
	<?$APPLICATION->IncludeComponent(
		"ad_shop:customer_panel",
		".default",
		array(),
		false
	);?>

	<div class="b-layout">
		<header class="b-header">
			<div class="b-header__logo">
				<a href="/" class="b-header__logo-link">
					<div class="b-header__logo-types"></div>
					<div class="b-header__logo-logo">
						<?if(LANG == 'en'):?>
							<img alt="" style="width:240px;" src="<?=BX_DEFAULT_TEMPLATE_PATH;?>/img/Logo_eng.svg" />
						<?else:?>
							<img alt="" style="width:240px;" src="<?=BX_DEFAULT_TEMPLATE_PATH;?>/img/Logo_rus.svg" />
						<?endif?>
					</div>
					<div class="b-header__logo-logo _small">
						<?if(LANG == 'en'):?>
							<img alt="" style="width:184px;" src="<?=BX_DEFAULT_TEMPLATE_PATH;?>/img/Logo_eng.svg" srcset="<?=BX_DEFAULT_TEMPLATE_PATH;?>/images/logo-small@2x.png" />
						<?else:?>
							<img alt="" style="width:184px;"  src="<?=BX_DEFAULT_TEMPLATE_PATH;?>/img/Logo_rus.svg" />
						<?endif?>

					</div>
				</a>
			</div>
			<div class="b-header__lang">
                <?$APPLICATION->IncludeComponent(
                    "ad_shop:store.list",
                    ".default",
                    array(),
                    false
                );?>

				<?$APPLICATION->IncludeComponent(
				    "ad_shop:change_lang",
                    ".default",
                    array(),
                    false
                );?>

			</div>
			<div class="b-header__auth">
                <?GLOBAL $USER;?>
                <?if($USER->IsAuthorized()):?>
                    <div class="b-top-auth _logged">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:system.auth.form",
                            "ad_shop_auth",
                            Array(
                                'AUTH_URL'=>'/',
                                'LOGOUT'=>'Y'
                            )
                        );?>
                    </div>
                <?else:?>
                    <div class="b-top-auth">
                        <a id="authFormLink" href="#authForm" class="b-top-auth__link link fancybox"><span><?=GetMessage('LETS_AUTH_OR_REGISTER')?></span></a>
                    </div>
                <?endif;?>
			</div>
			<div class="b-header__phone">
				<?=GetMessage('HEADER_PHONE')?>
			</div>
			<div class="b-header__cart">


					<?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.small", "small-basket", array(
						"PATH_TO_BASKET" => $en."/basket/",
						"PATH_TO_ORDER" => $en."/order/"
					), false
					);?>




			</div>
		</header>

	<!----=======================================------>

	<?
	$APPLICATION->IncludeComponent("bitrix:menu", "top_menu", array(
		"ROOT_MENU_TYPE" => "top",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "36000",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "2",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"IBLOCK_CATALOG_TYPE" => "aspro_ishop_catalog",
		"IBLOCK_CATALOG_ID" => ((SITE_ID == "en")?"21":"40"),
		"IBLOCK_CATALOG_DIR" => SITE_DIR."catalog/",
		"MAX_CATALOG_GROUPS_COUNT" => "5"
	),
		false
	);?>

	<!----=======================================------>

	<div class="b-popup" id="authForm" style="display: none; overflow: hidden;">
		<?$APPLICATION->IncludeComponent(
			"bitrix:system.auth.form",
			"ad_shop_auth",
			Array(
				"COMPONENT_TEMPLATE" => "ad_shop_auth",
				"FORGOT_PASSWORD_URL" => "",
				"PROFILE_URL" => "",
				"REGISTER_URL" => "",
				"SHOW_ERRORS" => "Y",
				"MENU_CACHE_TYPE" => "N",
				"MENU_CACHE_TIME" => "0",
                "AJAX_MODE" => 'Y'
			)
		);?>
	</div>
	<div class="b-popup" id="regForm"  style="display: none">
		<?
		//global $IS_BASKET_PAGE;
	
		?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.register",
			"ad_registration",
			array(
				"AUTH" => "Y",
				"REQUIRED_FIELDS" => array(
					0 => "LOGIN",
				),
				"SHOW_ERRORS" => "Y",
				"SET_TITLE" => "N",
				"SHOW_FIELDS" => array(
					0 => "NAME"
				),
				//"SUCCESS_PAGE" => $GLOBALS["IS_BASKET_PAGE"]?SITE_DIR."order/":"/personal/",
				"USER_PROPERTY" => array(
				),
				"USER_PROPERTY_NAME" => "",
				"USE_BACKURL" => "Y",
				"COMPONENT_TEMPLATE" => "ad_registration",
                "AJAX_MODE" => 'Y'
			),
			false
		);?>
	</div>
	<div class="b-popup" id="forgotpasswordForm"  style="display: none">
		<?$APPLICATION->IncludeComponent(
			"bitrix:system.auth.forgotpasswd",
			"ad_shop_forgotpasswd",
			Array(
                "AJAX_MODE" => 'Y'
			),
			false);
		?>
	</div>

	<div class="b-layout__main">
