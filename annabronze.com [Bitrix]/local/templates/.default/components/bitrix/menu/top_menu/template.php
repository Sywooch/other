<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if( !empty( $arResult ) ){?>
	<!---mobile--->
	<div class="b-mob-menu js-mob-menu">
		<div class="b-mob-menu__opener js-mob-menu-opener "><span
				class="b-mob-menu__opener-rotator"></span><span></span></div>
		<div class="b-mob-menu__wrapper">
			<div class="b-mob-menu__top">
                <?$APPLICATION->IncludeComponent(
                    "ad_shop:store.list",
                    "mobile",
                    array(),
                    false
                );?>

                <?$APPLICATION->IncludeComponent(
                    "ad_shop:change_lang",
                    "mobile",
                    array(),
                    false
                );?>
			</div>

			<?foreach( $arResult as $key => $arItem ){?>


				<? if($arItem["LINK"] == $arParams["IBLOCK_CATALOG_DIR"]){ ?>

					<div class="b-mob-menu__item _has-drop <?if( $arItem["SELECTED"] ):?>_dark<?endif?>">
						<span class="b-mob-menu__item-text <?if( $arItem["SELECTED"] ):?>_dark<?endif?>"><?=$arItem["TEXT"]?></span>
						<div class="b-mob-menu__item-drop">

							<div class="b-mob-menu__item <?if( $arItem["SELECTED"] ):?>_dark<?endif?>">
								<a href="<?=$arItem["LINK"]?>" class="b-mob-menu__item-text <?if( $arItem["SELECTED"] ):?>_dark<?endif?>">
									<?=$arItem["TEXT"]?>
								</a>
							</div>

							<?
							ob_start();
							$APPLICATION->IncludeComponent(
								"bitrix:catalog.section.list",
								"top_menu",
								Array(
									"IBLOCK_TYPE" => $arParams["IBLOCK_CATALOG_TYPE"],
									"IBLOCK_ID" => $arParams["IBLOCK_CATALOG_ID"],
									"SECTION_ID" => "",
									"SECTION_CODE" => "",
									"COUNT_ELEMENTS" => "N",
									"TOP_DEPTH" => "2",
									"SECTION_FIELDS" => array(0=>"",1=>"",),
									"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
									"SECTION_URL" => "",
									"CACHE_TYPE" => "A",
									"CACHE_TIME" => "3600",
									"CACHE_GROUPS" => "Y",
									"ADD_SECTIONS_CHAIN" => "N",
									"MAX_CATALOG_GROUPS_COUNT" => $arParams["MAX_CATALOG_GROUPS_COUNT"],
									"DEVICE" => "MOBILE"
								)
							);?>

						</div>
					</div>

				<? }else if($arItem["IS_PARENT"] == 1){?>
					<? $tmpMenuItem = ""; ?>

					<div class="b-mob-menu__item _has-drop <?if( $arItem["SELECTED"] ):?>_dark<?endif?>">
						<span class="b-mob-menu__item-text tmp1 <?if( $arItem["SELECTED"] ):?>_dark<?endif?>">
							<?=$arItem["TEXT"]?>
						</span>
						<div class="b-mob-menu__item-drop">
							<div class="b-mob-menu__item <?if( $arItem["SELECTED"] ):?>_dark<?endif?>">
								<a href="<?=$arItem["LINK"]; $tmpMenuItem = $arItem["LINK"]; ?>" class="b-mob-menu__item-text tmp2 <?if( $arItem["SELECTED"] ):?>_dark<?endif?>">
									<?=$arItem["TEXT"]?>
								</a>
							</div>

							<?foreach( $arItem["ITEMS"] as $arSubItem ){?>
								<?
								if($tmpMenuItem == $arSubItem["LINK"]){ continue; }
								$tmpMenuItem = $arSubItem["LINK"];
								?>
								<div class="b-mob-menu__item <?if( $arItem["SELECTED"] ):?>_dark<?endif?>">
									<a href="<?=$arSubItem["LINK"]?>" class="b-mob-menu__item-text tmp3 <?if( $arItem["SELECTED"] ):?>_dark<?endif?>">
										<?=$arSubItem["TEXT"]?>
									</a>
								</div>
							<?}?>
						</div>
					</div>

				<? }else{ ?>
					<? //if(strstr($arItem["LINK"],"/search/")){ ?>
                        <div class="b-mob-menu__item <?if( $arItem["SELECTED"] ):?>_dark<?endif?>">
                            <a href="<?=$arItem["LINK"]?>" class="b-mob-menu__item-text tmp4 <?if( $arItem["SELECTED"] ):?>_dark<?endif?>">
                                <?=$arItem["TEXT"]?>
                            </a>
                        </div>
 					<? //} ?>



				<?}?>
			<?}?>
		</div>
	</div>
	<!---mobile--->
	<!---desktop--->
	<nav class="b-top-menu">
		<div class="b-layout__line"></div>
		<div class="b-top-menu__wrapper">
			<?foreach( $arResult as $key => $arItem ){?>
				<? if(strstr($arItem["LINK"],"/search/")){ ?>
                    <div class="b-top-menu__item js-search-line _is-search-item hidden-xs hidden-sm">
                        <a href="#" class="b-top-menu__item-text js-search-line-open"><?=GetMessage('SEARCH')?></a>
                        <div class="b-top-menu__item-drop _search js-search-line-dropper">
                            <div class="b-search-line">
                                <form class="b-search-line__form" action="<?=SITE_DIR?>search/" method="get">
                                    <input class="b-search-line__input" name="q" type="text"
                                           placeholder="<?=GetMessage('SEARCH_TEXT_EXAMPLE')?>"/>
                                    <button class="b-search-line__submit"></button>
                                </form>
                                <a class="b-search-line__close js-search-line-close"></a>
                            </div>

                        </div>
                    </div>
				<? continue; } ?>

				<? if($arItem["LINK"] == $arParams["IBLOCK_CATALOG_DIR"]){ ?>
					<div class="b-top-menu__item _is-catalog">
						<a href="<?=$arItem["LINK"]?>" class="b-top-menu__item-text <?if( $arItem["SELECTED"] ):?>_current<?endif?>">
							<?=$arItem["TEXT"]?>
						</a>
						<? ob_start();
						$APPLICATION->IncludeComponent(
							"bitrix:catalog.section.list",
							"top_menu",
							Array(
								"IBLOCK_TYPE" => $arParams["IBLOCK_CATALOG_TYPE"],
								"IBLOCK_ID" => $arParams["IBLOCK_CATALOG_ID"],
								"SECTION_ID" => "",
								"SECTION_CODE" => "",
								"COUNT_ELEMENTS" => "N",
								"TOP_DEPTH" => "2",
								"SECTION_FIELDS" => array(0=>"",1=>"",),
								"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
								"SECTION_URL" => "",
								"CACHE_TYPE" => "A",
								"CACHE_TIME" => "3600",
								"CACHE_GROUPS" => "Y",
								"ADD_SECTIONS_CHAIN" => "N",
								"MAX_CATALOG_GROUPS_COUNT" => $arParams["MAX_CATALOG_GROUPS_COUNT"],
								"DEVICE" => "DESKTOP"
							)
						);
						?>
					</div>

				<? }else if($arItem["IS_PARENT"] == 1){?>
					<div class="b-top-menu__item _is-catalog _is-parent">
						<a href="<?=$arItem["LINK"]?>" class="b-top-menu__item-text <?if( $arItem["SELECTED"] ):?>_current<?endif?>">
							<?=$arItem["TEXT"]?>
						</a>
						<div class="b-top-menu__item-drop _catalog">
							<div class="b-top-menu__catalog">
								<div class="b-top-menu__catalog-col">
									<?
										$M=generate_rand_massive(1,6,count($arItem["ITEMS"]));
										$i=0;
									?>
									<?foreach( $arItem["ITEMS"] as $arSubItem ) {?>
                                        <a href="<?=$arSubItem["LINK"]?>" class="b-top-menu__catalog-link link _ico<? echo $M[$i]; $i++; ?>">
                                            <span><?=$arSubItem["TEXT"]?></span>
                                        </a>
									<?}?>
								</div>
							</div>
                        </div>
						<!--<div class="child submenu">
							<?/*foreach( $arItem["ITEMS"] as $arSubItem ){*/?>
								<a href="<?/*=$arSubItem["LINK"]*/?>"><?/*=$arSubItem["TEXT"]*/?></a>
							<?/*}*/?>
						</div>-->
					</div>
                <? }else{ ?>
					<div class="b-top-menu__item">
						<a href="<?=$arItem["LINK"]?>" class="b-top-menu__item-text <?if( $arItem["SELECTED"] ):?>_current<?endif?>">
							<?=$arItem["TEXT"]?>
						</a>
					</div>
				<?}?>
			<?}?>
		</div>
		<div class="b-layout__line _hide-on-main"></div>
	</nav>
	<!---desktop--->
	<script>
		$(".menu > li > a:not(.current)").click(function()
		{
			$(this).parents(".menu").find("li > a").removeClass("current");
			$(this).addClass("current");
		});
	</script>
<?}?>