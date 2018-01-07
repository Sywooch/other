<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


	<div class="b-catalog-section__meta">

		<!------color filter------>

		<?$APPLICATION->IncludeComponent("ad_shop:color_filter", ".default", array(
			"IBLOCK_ID" => $arResult["IBLOCK_ID"],
			"IBLOCK_SECTION_ID" => $arResult["IBLOCK_SECTION_ID"]
		),
			false
		);?>

		<!------color filter------>

		<?$APPLICATION->IncludeComponent("ad_shop:section_sorting", ".default", array(
			"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
			"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"]
		),
			false
		);?>

	</div>

	<div class="b-catalog-section__list">
		<div class="b-catalog-list _with-end-line">

			<? $i=1;
			//$M=generate_rand_massive(1, 4, count($arResult["ITEMS"]));
			$M=generate_all_permutation(1, 4, count($arResult["ITEMS"]));
			?>
			<?foreach( $arResult["ITEMS"] as $arItem ){
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
				?>

				<div class="b-catalog-list__item _type<?= $M[$i - 1];
				$i++; ?> js-product-list-card" style="height: 293px;"
					 id="<?= $this->GetEditAreaId($arItem['ID']); ?>"  data-offer-id="<?=$arItem["OFFER_ACTIVE_ID"];?>">

					<?
					if(substr($arItem["DETAIL_PAGE_URL"], -1) == "/"){
						$url = $arItem["DETAIL_PAGE_URL"]."?offer=".$arItem["OFFER_ACTIVE_ID"];
					}else{
						$url = $arItem["DETAIL_PAGE_URL"]."/?offer=".$arItem["OFFER_ACTIVE_ID"];
					}
					?>
					<a href="<?=$url;?>" class="b-catalog-list__item-link"></a>

					<div class="b-catalog-list__item-ico"></div>
					<div class="b-catalog-list__item-img js-product-list-card-img"
						 style="background-image: url(<?
						 if (!empty($arItem["PREVIEW_PICTURE"])) {
							 echo $arItem["PREVIEW_PICTURE"]["SRC"];
						 } else {
							 echo BX_DEFAULT_NO_PHOTO_IMAGE;
						 } ?>)"
						 data-current-color-index="1" data-color-img-index-1="images/cat1.jpg"
						 data-color-img-index-2="images/cat1-1.jpg"></div>
					<input type="hidden" id="offer_id" data-id="<?=$arItem["OFFER_ACTIVE_ID"];?>"/>
					<input type="hidden" id="detail_page_url" data-id="<?=$arItem["DETAIL_PAGE_URL"];?>"/>

					<div class="b-catalog-list__item-title js-catalog-list__item-title">
						<?/*=$arItem["PROPERTIES"]["CML2_ARTICLE2"]["VALUE"]."--".*/ echo $arItem["NAME"]; ?>
					</div>
					<div class="b-catalog-list__item-price js-catalog-list__item-price"><?= $arItem["PRICE_PRINT"] ?></div>

					<div class="b-catalog-list__item-colors">
						<div class="b-colors js-product-list-card-colors">

							<?
							foreach ($arItem["OFFERS"] as $k => $v){

								?>
								<div class="b-colors__item _color-<?=$v["COLOR_INDEX"];?> <? if($arItem["OFFER_ACTIVE_INDEX"]==$v["COLOR_INDEX"]){ echo "_current"; } ?>"
									 data-color-index="<?=$v["COLOR_INDEX"];?>" data-id="<?=$k;?>"
									 title="<?=$v["COLOR_NAME"];?>"><i></i></div>
								<?
							}
							?>

						</div>
					</div>

					<div class="b-catalog-list__item-details"><?=GetMessage("CATALOG_LIST_ITEM_DETAILS");?></div>

					<?
					if($arItem["IN_BASKET"]=="N"){
						?>
						<a href="<? if(LANGUAGE_ID==='en'){ echo "/en"; } ?>/basket/" class="b-catalog-list__item-btn link _added added
							disabled"
						   style="display:none"><?=GetMessage("CATALOG_LIST_ITEM_ADDED_TO_CART");?>
						</a>

						<a href="<? if(LANGUAGE_ID==='en'){ echo "/en"; } ?>/local/include/ajax-added.php" class="b-catalog-list__item-btn open-ajax link no_added">
							<?=GetMessage("CATALOG_LIST_ITEM_ADD_TO_CART");?>
						</a>
						<?
					}else{
						?>

						<a href="<? if(LANGUAGE_ID==='en'){ echo "/en"; } ?>/basket/" class="b-catalog-list__item-btn link _added added
							disabled"
						><?=GetMessage("CATALOG_LIST_ITEM_ADDED_TO_CART");?>
						</a>


						<a href="<? if(LANGUAGE_ID==='en'){ echo "/en"; } ?>/local/include/ajax-added.php" class="b-catalog-list__item-btn open-ajax link no_added"
						   style="display:none">
							<?=GetMessage("CATALOG_LIST_ITEM_ADD_TO_CART");?>
						</a>

						<?
					}
					?>
					<?


					foreach ($arItem["OFFERS"] as $k => $v) {
						?>

						<?
						if(substr($arItem["DETAIL_PAGE_URL"], -1) == "/"){
							$url = $arItem["DETAIL_PAGE_URL"]."?offer=".$v["ID"];
						}else{
							$url = $arItem["DETAIL_PAGE_URL"]."/?offer=".$v["ID"];
						}
						?>

						<input type="hidden" class="js-offer" id="offer_<?=$v["ID"];?>"
							   data-id="<?=$k;?>"
							   data-name="<?=$v["NAME"];?>"
							   data-price-print="<?=$v["PRICE_PRINT"];?>"
							   data-picture="<?=$v["PICTURE"];?>"
							   data-picture-popup="<?=$v["PICTURE_POPUP"];?>"
							   data-quantity="<?=$v["QUANTITY"];?>"
							   data-offer-id="<?=$v["ID"];?>"
							   data-in-basket="<? if($v["IN_BASKET"]=="Y"){ echo 'Y'; }else{ echo 'N'; }; ?>"
							   data-quantity-in-basket="<?=$v["QUANTITY_IN_BASKET"];?>"
							   data-detail-page="<?= $url;?>"
						/>
						<?
					}
					?>
				</div>
			<?}?>
        </div>
	</div>
<?if( $arParams["DISPLAY_BOTTOM_PAGER"] == "Y" ){?>
	<?=$arResult["NAV_STRING"]?>
<?}?>
<?//=$arResult["NAV_STRING"]?>

<? if(isset($arResult["navResult"])){ ?>
	<?$APPLICATION->IncludeComponent('bitrix:system.pagenavigation', 'shop', array(
		'NAV_RESULT' => $arResult["navResult"],
	));?>
<? } ?>

	<div class="b-catalog-section__seo">
		<?//=$arResult['DESCRIPTION'];?>
	</div>

	</div><!--b-catalog-section-->


<?
$APPLICATION->SetTitle($arResult['NAME']);

$this->SetViewTarget('section-description');
echo $arResult['DESCRIPTION'];
$this->EndViewTarget();
?>