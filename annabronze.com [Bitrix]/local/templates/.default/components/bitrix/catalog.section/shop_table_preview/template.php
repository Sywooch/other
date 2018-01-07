<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$i = 1;?>

<?
//echo "<pre>";
//print_r($arResult);
//echo "</pre>";
?>

<?foreach( $arResult["ITEMS"] as $arItem ){?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
	?>

	<pre>
		<?
		//print_r($arItem);
		?>
	</pre>



	<div class="b-catalog-list__item _type2">
		<a href="#" class="b-catalog-list__item-link"></a>
		<div class="b-catalog-list__item-ico"></div>


		<?
		if(!empty($arItem["PREVIEW_PICTURE"])) {
			$PREVIEW_PICTURE=CFile::GetFileArray($arItem["PREVIEW_PICTURE"]);
			$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 310, "height" => 185));

		}else if(!empty($arItem["DETAIL_PICTURE"])) {
			$PREVIEW_PICTURE=CFile::GetFileArray($arItem["DETAIL_PICTURE"]);
			$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 310, "height" => 185));
		}else{
			$PREVIEW_PICTURE=CFile::GetFileArray($arItem["PROPERTIES"]["MORE_PHOTO"]["VALUE"][0]);
			$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 310, "height" => 185));
		}

		?>
		<div class="b-catalog-list__item-img" style="background-image: url(<?=$renderImage['src'];?>)"></div>
		<div class="b-catalog-list__item-title">Bead cap set, 10 pcs. s0101</div>
		<div class="b-catalog-list__item-price">$ 3.60</div>
		<div class="b-catalog-list__item-details">details</div>
		<a href="" class="b-catalog-list__item-btn _added">
			in cart
		</a>
	</div>

	<?$i++;?>
	<?
	if($i > 4){ break; }
	?>
<?}?>

<? /* ?>
	<div class="display_table">
	<?if( CSite::InDir(SITE_DIR.'sale/') ):?>
		<h4 class="block_title"><?=GetMessage("STOCK_PRODUCTS")?></h4>
	<?elseif( CSite::InDir(SITE_DIR.'info/brand') && $arParams["BRAND_NAME"] ):?>
		<h4 class="block_title"><?=GetMessage("BRAND_PRODUCTS", array("#BRAND#"=>$arParams["BRAND_NAME"]))?></h4>
	<?endif;?>
	<?$i = 1;?>
	<?foreach( $arResult["ITEMS"] as $arItem ){?>
	<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
	?>
		<?			
			if (($arParams["SHOW_MEASURE"]=="Y")&&($arItem["CATALOG_MEASURE"]))
			{ $arMeasure = CCatalogMeasure::getList(array(), array("ID"=>$arItem["CATALOG_MEASURE"]), false, false, array())->GetNext(); }
		?>
		<div class="table_item item_ws <?if( $i % $arParams["LINE_ELEMENT_COUNT"] == 0 ):?>last-in-line<?endif;?>">
			<div class="table_item_inner">
				<div class="image">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="thumb_cat">
						<?if( !empty($arItem["PREVIEW_PICTURE"]) ):?>
							<img border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=($arItem["PREVIEW_PICTURE"]["ALT"] ? $arItem["PREVIEW_PICTURE"]["ALT"] : $arItem["NAME"])?>" title="<?=($arItem["PREVIEW_PICTURE"]["TITLE"] ? $arItem["PREVIEW_PICTURE"]["TITLE"] : $arItem["NAME"])?>" />
						<?else:?>
							<img border="0" src="<?=SITE_TEMPLATE_PATH?>/images/noimage170.gif" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
						<?endif;?>
					</a>
					<div class="marks">
						<?if( $arItem["PROPERTIES"]["STOCK"]["VALUE"] == true ){?><span class="mark share"></span><?}?>
						<?if( $arItem["PROPERTIES"]["HIT"]["VALUE"] == true ){?><span class="mark hit"></span><?}?>
						<?if( $arItem["PROPERTIES"]["RECOMMEND"]["VALUE"] == true ){?><span class="mark like"></span><?}?>
						<?if( $arItem["PROPERTIES"]["NEW"]["VALUE"] == true ){?><span class="mark new"></span><?}?>
					</div>
				</div>
				<a class="desc_name" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
				
				
				<?if( !empty( $arItem["OFFERS"]) && $arItem["MIN_PRODUCT_OFFER_PRICE_PRINT"] ) {?>
						<div class="price_block">
							<div class="price">
								<?if (($arParams["SHOW_MEASURE"]=="Y")&&$arMeasure["SYMBOL_RUS"]):?>
									<?$symb = substr($arItem["MIN_PRODUCT_OFFER_PRICE_PRINT"], strrpos($arItem["MIN_PRODUCT_OFFER_PRICE_PRINT"], ' '));?>
									<span><?=GetMessage("CATALOG_FROM");?> <?=str_replace($symb, "", $arItem["MIN_PRODUCT_OFFER_PRICE_PRINT"])."<small>".$symb."/".$arMeasure["SYMBOL_RUS"]."</small>";?></span>
								<?else:?><span><?=GetMessage("CATALOG_FROM");?> <?=$arItem["MIN_PRODUCT_OFFER_PRICE_PRINT"]?></span><?endif;?>
							</div>
						</div>
				<?}else{?>
					<div class="price_block">
						<?
							$arCountPricesCanAccess = 0;
							foreach( $arItem["PRICES"] as $key => $arPrice ) { if($arPrice["CAN_ACCESS"]){$arCountPricesCanAccess++;} }
						?>
						<?foreach( $arItem["PRICES"] as $key => $arPrice ){?>
							<?if($arPrice["CAN_ACCESS"]){?>
								<?$price = CPrice::GetByID($arPrice["ID"]); ?>
								<?if($arCountPricesCanAccess>1):?><div class="price_name"><?=$price["CATALOG_GROUP_NAME"];?></div><?endif;?>									
								<div class="price">
									<?if( $arPrice["VALUE"] > $arPrice["DISCOUNT_VALUE"] ){?>
										<div class="price">
											<?if (($arParams["SHOW_MEASURE"]=="Y")&&$arMeasure["SYMBOL_RUS"]):?>
												<?$symb = substr($arPrice["PRINT_VALUE"], strrpos($arPrice["PRINT_VALUE"], ' '));?>
												<span class="new"><?=str_replace($symb, "", $arPrice["PRINT_DISCOUNT_VALUE"])."<small>".$symb."/".$arMeasure["SYMBOL_RUS"]."</small>";?></span>
												<span class="old"><?=str_replace($symb, "", $arPrice["PRINT_VALUE"])."<small>".$symb."/".$arMeasure["SYMBOL_RUS"]."</small>";?></span>
											<?else:?>
												<span class="new"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
												<span class="old"><?=$arPrice["PRINT_VALUE"]?></span>
											<?endif;?>
										</div>
									<?}else{?>
										<?if (($arParams["SHOW_MEASURE"]=="Y")&&$arMeasure["SYMBOL_RUS"]):?>
											<?$symb = substr($arPrice["PRINT_VALUE"], strrpos($arPrice["PRINT_VALUE"], ' '));?>
											<span><?=str_replace($symb, "", $arPrice["PRINT_VALUE"])."<small>".$symb."/".$arMeasure["SYMBOL_RUS"]."</small>";?></span>
										<?else:?><span><?=$arPrice["PRINT_VALUE"]?></span><?endif;?>
									<?}?>
								</div>
							<?}?>
						<?}?>
					</div>
				<?}?>
				
				<div class="button_block">				
					<?if( $arItem["CAN_BUY"] || count($arItem["OFFERS"])){?>
						<!--noindex-->
							<?if (!count($arItem["OFFERS"]) && $arItem["CAN_BUY"]):?>
								<a rel="nofollow" element_id="#<?=$arItem["ID"]?>" href="<?=$arItem["ADD_URL"]?>" onclick="return addToCart(this, 'detail', '<?=GetMessage("CATALOG_IN_CART")?>', 'cart', '<?=$arParams["BASKET_URL"]?>', '<?=$arItem["ID"]?>');" class="button add_item" alt="<?=$arItem["NAME"]?>"><span><?=GetMessage('CATALOG_ADD_TO_BASKET')?></span></a>	
							<?else:?>
								<a rel="nofollow" href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="button add_item" alt="<?=$arItem["NAME"]?>"><span><?=GetMessage('CATALOG_MORE')?></span></a>
							<?endif;?>
						<!--/noindex-->
					<?}?>
				</div>
				
				<?if( empty($arItem["OFFERS"]) && $arItem["CAN_BUY"] ){?>
					<div class="likes_icons">
						<!--noindex-->
							<a rel="nofollow" href="#<?=$arItem["ID"]?>" class="wish_item"></a>
							<div class="tooltip-wrapp">
								<div class="tooltip wish_item_tooltip"><?=GetMessage('CATALOG_IZB')?></div>
							</div>
							<?if($arParams["DISPLAY_COMPARE"]){?>
								<a element_id="#<?=$arItem["ID"]?>" rel="nofollow" href="<?=$arItem["COMPARE_URL"]?>" onclick="return addToCompare(this, 'detail', '<?=$arItem["COMPARE_URL"]?>');" class="compare_item"></a>
								<div class="tooltip-wrapp"><div class="tooltip compare_item_tooltip"><?=GetMessage('CATALOG_COMPARE')?></div></div>
							<?}?>
						<!--/noindex-->
					</div>
					
					<div style="clear: both"></div>
				<?}?>
			</div>
		</div>
		<?if( $i % $arParams["LINE_ELEMENT_COUNT"] == 0 && $i < count($arResult["ITEMS"]) ){?>
			<div class="long_separator"></div>
		<?}?>
		<?$i++;?>
	<?}?>
</div>

<?if( $arParams["DISPLAY_BOTTOM_PAGER"] == "Y" ){?>
	<?=$arResult["NAV_STRING"]?>
<?}?>

 <? */ ?>