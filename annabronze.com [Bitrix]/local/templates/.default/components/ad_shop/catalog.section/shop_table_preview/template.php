<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$i = 1;?>


<?
$M=generate_all_permutation(1, 4, 4);
?>
<?foreach( $arResult["ITEMS"] as $arItem ){?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
	?>


	<div class="b-catalog-list__item _type<?= $M[$i - 1];
	 ?> js-product-list-card" style="height: 293px;"
		 id="<?= $this->GetEditAreaId($arItem['ID']); ?>"
		 data-offer-id="<?=$arItem["OFFER_ACTIVE_ID"];?>">
		<a href="<?= $arItem["DETAIL_PAGE_URL"] ?>?offer=<?=$arItem["OFFER_ACTIVE_ID"];?>" class="b-catalog-list__item-link"></a>
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
			<?/*=$arItem["PROPERTIES"]["MINIMUM_PRICE"]["VALUE"]."--".*/ echo $arItem["NAME"] ?>
		</div>
		<div class="b-catalog-list__item-price js-catalog-list__item-price"><?= $arItem["PRICE_PRINT"] ?></div>

		<div class="b-catalog-list__item-colors" style="display: none;">
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
			$url = $arItem["DETAIL_PAGE_URL"]."?offer=".$v["ID"];
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




	<?$i++;?>
	<?
	if($i > 4){ break; }
	?>
<?}?>

