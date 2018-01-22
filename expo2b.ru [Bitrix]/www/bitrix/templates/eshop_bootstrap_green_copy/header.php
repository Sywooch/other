<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");
CJSCore::Init(array("fx"));
$curPage = $APPLICATION->GetCurPage(true);
$theme = COption::GetOptionString("main", "wizard_eshop_bootstrap_theme_id", "blue", SITE_ID);
?>
<!DOCTYPE html>
<html xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
	<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_DIR?>favicon.ico" />
	<?$APPLICATION->ShowHead();?>
	<?
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/colors.css", true);
	$APPLICATION->SetAdditionalCSS("/bitrix/css/main/bootstrap.css");
	$APPLICATION->SetAdditionalCSS("/bitrix/css/main/font-awesome.css");
	?>
	<title><?$APPLICATION->ShowTitle()?></title>
<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic&subset=latin,cyrillic-ext,cyrillic' rel='stylesheet' type='text/css'>


<!--	<link rel="stylesheet" href="/selectize/examples/css/normalize.css">
		<link rel="stylesheet" href="/selectize/examples/css/stylesheet.css">-->
		<script src="/selectize/examples/js/jquery.js"></script>
		<script src="/selectize/dist/js/standalone/selectize.js"></script>
		<script src="/selectize/examples/js/index.js"></script>
	<link rel="stylesheet" href="/selectize/dist/css/selectize.default.css">


</head>
<body class="bx-background-image bx-theme-<?=$theme?>" <?=$APPLICATION->ShowProperty("backgroundImage")?>>
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<!--<?$APPLICATION->IncludeComponent("bitrix:eshop.banner", "", array());?>-->




<div class="bx-wrapper" id="bx_eshop_wrap">

<div class="header_block_1">
<div class="center_container">
	<span class="lng"><span>RU</span> | <span>EN</span></span>
	<span class="reg_login"><span class="reg">Регистрация</span><span class="login">Вход</span></span>
</div>
</div>

	<header class="bx-header">
		<div class="bx-header-section container">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
					<div class="bx-logo">
						<a class="bx-logo-block hidden-xs" href="<?=SITE_DIR?>">
							<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/company_logo.php"), false);?>
						</a>
						<a class="bx-logo-block hidden-lg hidden-md hidden-sm text-center" href="<?=SITE_DIR?>">
							<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/company_logo_mobile.php"), false);?>
						</a>
					</div>
				</div>

				<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
					<div class="block_links">
						<a class="link1" href="/">Выставки в Москве</a>
						<a class="link2" href="/">Выставки в Петербурге</a>
						<a class="link3" href="/">Выставки в Германии</a>
						<a class="link4" href="/">Выставки по городам</a>
						<a class="link5" href="/">Выставки по странам</a>
						<a class="link6" href="/">Выставки по тематикам</a>
					</div>

					<div class="banner_container"></div>

					<div class="phone_container">
						<span class="phone"><span class="blue">+7 (499)</span> 999-12-07</span>
						<span class="link">обратный звонок</span>
					</div>

				</div>

<!--
				<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
					<div class="bx-inc-orginfo">
						<div>
<span class="bx-inc-orginfo-phone"><i class="fa fa-phone"></i> <?//$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/telephone.php"), false);?></span>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
					<div class="bx-worktime">
						<div class="bx-worktime-prop">
<?//$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/schedule.php"), false);?>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 hidden-xs">
<?/*$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "", array(
							"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
							"PATH_TO_PERSONAL" => SITE_DIR."personal/",
							"SHOW_PERSONAL_LINK" => "N",
							"SHOW_NUM_PRODUCTS" => "Y",
							"SHOW_TOTAL_PRICE" => "Y",
							"SHOW_PRODUCTS" => "N",
							"POSITION_FIXED" =>"N",
							"SHOW_AUTHOR" => "Y",
							"PATH_TO_REGISTER" => SITE_DIR."login/",
							"PATH_TO_PROFILE" => SITE_DIR."personal/"
						),
						false,
						array()
);*/?>
				</div>
-->


			</div>
<!--
			<div class="row">
				<div class="col-md-12 hidden-xs">
<? /*$APPLICATION->IncludeComponent("bitrix:menu", "catalog_horizontal", array(
							"ROOT_MENU_TYPE" => "left",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_TIME" => "36000000",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_THEME" => "site",
							"CACHE_SELECTED_ITEMS" => "N",
							"MENU_CACHE_GET_VARS" => array(
							),
							"MAX_LEVEL" => "3",
							"CHILD_MENU_TYPE" => "left",
							"USE_EXT" => "Y",
							"DELAY" => "N",
							"ALLOW_MULTI_SELECT" => "N",
						),
						false
);*/ ?>
				</div>
			</div>
-->
			<?if ($curPage != SITE_DIR."index.php"):?>
			<div class="row">
				<div class="col-lg-12">
					<?$APPLICATION->IncludeComponent("bitrix:search.title", "visual", array(
							"NUM_CATEGORIES" => "1",
							"TOP_COUNT" => "5",
							"CHECK_DATES" => "N",
							"SHOW_OTHERS" => "N",
							"PAGE" => SITE_DIR."catalog/",
							"CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS") ,
							"CATEGORY_0" => array(
								0 => "iblock_catalog",
							),
							"CATEGORY_0_iblock_catalog" => array(
								0 => "all",
							),
							"CATEGORY_OTHERS_TITLE" => GetMessage("SEARCH_OTHER"),
							"SHOW_INPUT" => "Y",
							"INPUT_ID" => "title-search-input",
							"CONTAINER_ID" => "search",
							"PRICE_CODE" => array(
								0 => "BASE",
							),
							"SHOW_PREVIEW" => "Y",
							"PREVIEW_WIDTH" => "75",
							"PREVIEW_HEIGHT" => "75",
							"CONVERT_CURRENCY" => "Y"
						),
						false
					);?>
				</div>
			</div>
			<?endif?>

			<?if ($curPage != SITE_DIR."index.php"):?>
			<div class="row">
				<div class="col-lg-12" id="navigation">
					<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array(
							"START_FROM" => "0",
							"PATH" => "",
							"SITE_ID" => "-"
						),
						false,
						Array('HIDE_ICONS' => 'Y')
					);?>
				</div>
			</div>
			<h1 class="bx-title dbg_title" id="pagetitle"><?=$APPLICATION->ShowTitle(false);?></h1>
			<?endif?>
		</div>
	</header>

	<div class="workarea header2">
		<div class="container bx-content-seection">
			<div class="left_block">
				<p>События</p>
				<p>Места</p>
				<p>Участники</p>
			</div>


			<div class="right_block">
				<p>Поиск событий</p>
				<input type="text" value="" placeholder="Введите название события" class="input_1"/>
				<select>
					<option>Россия</option>
					<option>Россия1</option>
					<option>Россия2</option>
					<option>Россия3</option>
				</select>
				<input type="button" value="Найти"/>
			</div>



		</div>
	</div>


<? if ($APPLICATION->GetCurPage(false) === '/'): ?> 
	<div class="workarea block1">
		<div class="container bx-content-seection">

			<div class="block_1">
				<ul><li>О нас</li><li>Партнёры</li><li>Реклама</li><li>Контакты</li></ul>
				<div><p class="head">Наши услуги</p><p>Переводчики</p><p>Заочное посещение</p><p>Участие в выставках</p></div>
			</div>

			<div class="block_2">
				<div><p class="head">Выставки</p>
					<p>Металлургия, металлообработка, материаловедение <span>(10)</span></p>
<p>Бизнес, инвестициии, финансы <span>(10)</span></p>
<p>Строительство <span>(10)</span></p>
<p>Маркетинг, реклама, PR <span>(10)</span></p>
<p>Промышленность <span>(10)</span></p>
<p>Продукты. Пищевая индустрия <span>(10)</span></p>
					<a href="/">Все тематики</a>
</div>

</div>

			<div class="block_3">
				<div><p class="head">Конференции</p>
					<p>ИТ: Интернет-маркетинг <span>(10)</span></p>
<p>ИТ: Интернет-технологии <span>(10)</span></p>
<p>Металлургия, металлообработка <span>(10)</span></p>
<p>Металлургия, металлообработка <span>(10)</span></p>
<p>Металлургия, металлообработка <span>(10)</span></p>
<p>Металлургия, металлообработка <span>(10)</span></p>
<a href="/">Все тематики</a>
</div>

		</div>

		</div>
	</div>




	<div class="workarea block2">
		<div class="container bx-content-seection">
			<div class="block_1">
				<p class="head">Новости</p>

				<div>
					<a href="/">Заголовок новости</a>
					<p class="date">12.12.2016</p>
					<span>Тескт новости текст новости текст новости текст новости текст новости текст новости </span>
				</div>

				<div>
					<a href="/">Заголовок новости</a>
					<p class="date">12.12.2016</p>
					<span>Тескт новости текст новости текст новости текст новости текст новости текст новости </span>
				</div>

				<a href="/" class="all">Все новости</a>

			</div>



			<div class="block_2">
				<div></div>

			</div>
		</div>
	</div>



	<div class="workarea block3">
		<div class="container bx-content-seection">
			<p class="head">Наши партнёры</p>
			<div class="line"></div>

		</div>
	</div>



<? endif; ?> 


<!--
	<div class="workarea">



		<div class="container bx-content-seection">
			<div class="row">
<?//$needSidebar = preg_match("~^".SITE_DIR."(catalog|personal\/cart|personal\/order)/~", $curPage);?>
<div class="bx-content <?//=($needSidebar ? "col-xs-12" : "col-md-9 col-sm-8")?>">