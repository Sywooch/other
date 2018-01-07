<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */

$this->setFrameMode(true);



$templateData = array(
	'TEMPLATE_THEME' => $this->GetFolder() . '/themes/' . $arParams['TEMPLATE_THEME'] . '/style.css',
	'TEMPLATE_CLASS' => 'bx_' . $arParams['TEMPLATE_THEME']
);
?>

<div class="b-main-top">
	<div class="b-main-top__pattern"></div>
	<div class="b-title js-content-title _no-marg">
		<div class="b-title__row _title">
			<div class="b-title__title"><? echo GetMessage('SB_TOP_TITLE') ?></div>
		</div>
	</div>
	<ul class="b-main-top__sections" data-moretext="<? echo GetMessage('SB_TOP_SEE_MORE') ?>">
		<?$APPLICATION->IncludeComponent("bitrix:catalog.smart.filter", "top", array(
			"IBLOCK_TYPE" => "catalog",
			"IBLOCK_ID" => "40",
			"SECTION_ID" => "",
			"FILTER_NAME" => "arrFilter",
			"PRICE_CODE" => "",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "36000000",
			"CACHE_NOTES" => "",
			"CACHE_GROUPS" => "Y",
			"SAVE_IN_SESSION" => "N",
			"XML_EXPORT" => "Y",
			"SECTION_TITLE" => "NAME",
			"SECTION_DESCRIPTION" => "DESCRIPTION",
			//"SHOW_HINTS" => $arParams["SHOW_HINTS"],
			//"HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
		),
			false
		);?>
	</ul>
	<div class="b-main-top__list">
		<div class="b-catalog-list">
			<?
			$i=1;
			$M=generate_all_permutation(1, 4, count($arResult["ITEMS"]));

			foreach ($arResult['ITEMS'] as $key => $arItem)
			{
				?>
				<div class="b-catalog-list__item <? if($i >= 4){ echo " hidden-s "; }
				if($i >= 6){ echo " hidden-m "; } ?> _type<?= $M[$i - 1];
				$i++; ?> js-product-list-card" style="height: 293px;"
					 id="<?= $this->GetEditAreaId($arItem['ID']); ?>"  data-offer-id="<?=$arItem["OFFER_ACTIVE_ID"];?>">
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
						<?/*=$arItem["PROPERTIES"]["CML2_ARTICLE2"]["VALUE"]."--".*/ echo $arItem["NAME"]; ?>
					</div>
					<div class="b-catalog-list__item-price js-catalog-list__item-price"><?= $arItem["PRICE_PRINT"] ?></div>
					<div style="display:none;">
						<div class="b-catalog-list__item-colors">
							<div class="b-colors js-product-list-card-colors">
								<?
								foreach ($arItem["OFFERS"] as $k => $v)
								{
									?>
									<div class="b-colors__item _color-<?=$v["COLOR_INDEX"];?> <? if($arItem["OFFER_ACTIVE_INDEX"]==$v["COLOR_INDEX"]){ echo "_current"; } ?>"
										 data-color-index="<?=$v["COLOR_INDEX"];?>" data-id="<?=$k;?>"
										 title="<?=$v["COLOR_NAME"];?>"><i></i></div>
									<?
								}
								?>
							</div>
						</div>
					</div>
					<div class="b-catalog-list__item-details"><?=GetMessage("CATALOG_LIST_ITEM_DETAILS");?></div>
					<?
					if($arItem["IN_BASKET"]=="N")
					{   ?>
						<a href="/basket/" class="b-catalog-list__item-btn link _added added
							disabled"
						   style="display:none"><?=GetMessage("CATALOG_LIST_ITEM_ADDED_TO_CART");?>
						</a>

						<a href="/local/include/ajax-added.php" class="b-catalog-list__item-btn open-ajax link no_added">
							<?=GetMessage("CATALOG_LIST_ITEM_ADD_TO_CART");?>
						</a>
						<?
					} else {
						?>

						<a href="/basket/" class="b-catalog-list__item-btn link _added added
							disabled"
						><?=GetMessage("CATALOG_LIST_ITEM_ADDED_TO_CART");?>
						</a>

						<a href="/local/include/ajax-added.php" class="b-catalog-list__item-btn open-ajax link no_added"
						   style="display:none">
							<?=GetMessage("CATALOG_LIST_ITEM_ADD_TO_CART");?>
						</a>
					<?
					}
					?>
					<?
					foreach ($arItem["OFFERS"] as $k => $v) {

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
							   data-detail-page="<?= $arItem["DETAIL_PAGE_URL"] ?>?offer=<?=$v["ID"];?>"
						/>
						<?

					}
					?>
				</div>
				<?
			}
			?>
		</div>
	</div>
</div>



<script type="text/javascript">
	BX.message({
		MESS_BTN_BUY: '<? echo ('' != $arParams['MESS_BTN_BUY'] ? CUtil::JSEscape($arParams['MESS_BTN_BUY']) : GetMessageJS('SB_TPL_MESS_BTN_BUY')); ?>',
		MESS_BTN_ADD_TO_BASKET: '<? echo ('' != $arParams['MESS_BTN_ADD_TO_BASKET'] ? CUtil::JSEscape($arParams['MESS_BTN_ADD_TO_BASKET']) : GetMessageJS('SB_TPL_MESS_BTN_ADD_TO_BASKET')); ?>',
		MESS_BTN_DETAIL: '<? echo ('' != $arParams['MESS_BTN_DETAIL'] ? CUtil::JSEscape($arParams['MESS_BTN_DETAIL']) : GetMessageJS('SB_TPL_MESS_BTN_DETAIL')); ?>',
		MESS_NOT_AVAILABLE: '<? echo ('' != $arParams['MESS_BTN_DETAIL'] ? CUtil::JSEscape($arParams['MESS_BTN_DETAIL']) : GetMessageJS('SB_TPL_MESS_BTN_DETAIL')); ?>',
		BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('SB_CATALOG_BTN_MESSAGE_BASKET_REDIRECT'); ?>',
		BASKET_URL: '<? echo $arParams["BASKET_URL"]; ?>',
		ADD_TO_BASKET_OK: '<? echo GetMessageJS('SB_ADD_TO_BASKET_OK'); ?>',
		TITLE_ERROR: '<? echo GetMessageJS('SB_CATALOG_TITLE_ERROR') ?>',
		TITLE_BASKET_PROPS: '<? echo GetMessageJS('SB_CATALOG_TITLE_BASKET_PROPS') ?>',
		TITLE_SUCCESSFUL: '<? echo GetMessageJS('SB_ADD_TO_BASKET_OK'); ?>',
		BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('SB_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
		BTN_MESSAGE_SEND_PROPS: '<? echo GetMessageJS('SB_CATALOG_BTN_MESSAGE_SEND_PROPS'); ?>',
		BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('SB_CATALOG_BTN_MESSAGE_CLOSE') ?>'
	});
</script>