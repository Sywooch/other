<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<h1 class="title"><?$APPLICATION->ShowTitle(false)?></h1>
	<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "content", Array(
		"START_FROM" => "0",
		"PATH" => "",
		"SITE_ID" => "",
		),
		false
	);?>
<div style="width: 100%; padding-bottom: 20px; font-size: 16px"><p>В этом разделе Вы можете познакомиться с работами мастеров, работающих с нашей фурнитурой. В описании каждой работы можно посмотреть фурнитуру, которая использовалась при сборке. Кликнув на артикул в списке, Вы перейдете на его страницу с подробным описанием.</p>
    <br><p>Если Вам понравилась работа и Вы хотели бы приобрести её, нужно связаться непосредственно с автором. На нашем сайте украшения не продаются и выставлены в качестве примера использования нашей фурнитуры. Связаться с автором можно по ссылке, которая есть в описании каждой работы. Приятного просмотра!</p></div>
<div class="shadow-item_info"><img border="0" alt="" src="<?=SITE_TEMPLATE_PATH?>/images/shadow-item_info.png"></div>


	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.section.list",
		"gallery",
		Array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
			"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"]
		),
		$component
	);
	?>
<div class="catalog_description">
<?$APPLICATION->IncludeFile(SITE_DIR."include/catalog_description.php", Array(), Array( "MODE"      => "html", "NAME"      => GetMessage("CATALOG_DESCRIPTION"), 	) );?>
</div>

