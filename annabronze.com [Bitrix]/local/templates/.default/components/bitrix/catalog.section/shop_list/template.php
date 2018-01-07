<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?

$iblock_id = LIST_CITIES_IBLOCK_ID;
$catalog_id = CATALOG_IBLOCK_ID;

if(LANGUAGE_ID == 'en') {
    $iblock_id = LIST_CITIES_IBLOCK_ID_EN;
    $catalog_id = CATALOG_IBLOCK_ID_EN;
}

$def_store = array(); //the list of storehouses in the city of the user
$res = CIBlockElement::GetList(
    Array(),
    Array("IBLOCK_ID"=>$iblock_id, "ACTIVE"=>"Y"),
    false,
    false,
    Array("ID", "IBLOCK_ID", "PROPERTY_STOREHOUSES", "NAME")
);

while($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
    if($arFields["NAME"] == $_SESSION["CITY_ID"])
    {
        $def_store[] = $arFields["PROPERTY_STOREHOUSES_VALUE"];
    }
}
foreach($arResult["ITEMS"] as $arItems)
{
    $list_id[] = IntVal($arItems["ID"]);//the list of products on this page
}

if (!CModule::IncludeModule("catalog"))
    return;
$db_store = CCatalogStoreProduct::GetList(
    Array(),
    Array("PRODUCT_ID"=>$list_id, "ACTIVE"=>"Y", ">AMOUNT" => 0, "STORE_ID" => $def_store),
    false,
    false,
    Array("PRODUCT_ID", "ID", "AMOUNT", "STORE_ID", "STORE_NAME", "STORE_ADDR")
);
while($arStore = $db_store->Fetch())
{
    foreach($arResult["ITEMS"] as &$arItems)
    {
        if($arItems["ID"] == $arStore["PRODUCT_ID"])
        {
            if(!empty($arResult["AMOUNTS"][$arItems["ID"]])) {
                $arResult["AMOUNTS"][$arItems["ID"]]["AMOUNT"] = $arItems["AMOUNTS"][$arItems["ID"]]["AMOUNT"] + $arStore["AMOUNT"];
            }
            else $arResult["AMOUNTS"][$arItems["ID"]]["AMOUNT"] = $arStore["AMOUNT"];
        }
    }
}?>

<?if( count($arResult["ITEMS"]) <= 0 ){?>
	<div class="empty_items">
		<?$APPLICATION->IncludeFile(SITE_DIR."/include/shop_zero_items.php", Array(), Array(
			"MODE"      => "html",
			"NAME"      => GetMessage('CT_NAME_NOT_FOUND'),
			));
		?>
	</div>
<?}else{?>
	<div class="display_list">
		<?foreach( $arResult["ITEMS"] as $arItem ){
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
		?>
			<?			
				if (($arParams["SHOW_MEASURE"]=="Y")&&($arItem["CATALOG_MEASURE"]))
				{ $arMeasure = CCatalogMeasure::getList(array(), array("ID"=>$arItem["CATALOG_MEASURE"]), false, false, array())->GetNext(); }
			?>
			<div class="list_item item_ws" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<div class="image">
					<div class="marks">
						<?if( $arItem["PROPERTIES"]["STOCK"]["VALUE"] ){?><span class="mark share"></span><?}?>
						<?if( $arItem["PROPERTIES"]["HIT"]["VALUE"] ){?><span class="mark hit"></span><?}?>
						<?if( $arItem["PROPERTIES"]["RECOMMEND"]["VALUE"] ){?><span class="mark like"></span><?}?>
						<?if( $arItem["PROPERTIES"]["NEW"]["VALUE"] ){?><span class="mark new"></span><?}?>
					</div>
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="thumb">
						<?if( !empty($arItem["PREVIEW_PICTURE"]) ){?>
							<img border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=($arItem["PREVIEW_PICTURE"]["ALT"] ? $arItem["PREVIEW_PICTURE"]["ALT"] : $arItem["NAME"])?>" title="<?=($arItem["PREVIEW_PICTURE"]["TITLE"] ? $arItem["PREVIEW_PICTURE"]["TITLE"] : $arItem["NAME"])?>" />
						<?}else{?>
							<img border="0" src="<?=SITE_TEMPLATE_PATH?>/images/noimage170.gif" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
						<?}?>
					</a>
				</div>
				
				<div class="description">
					<div class="desc_name">
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
					</div>
					<?if ($arItem["PREVIEW_TEXT"]):?>
						<div class="preview_text"><?=$arItem["PREVIEW_TEXT"]?></div>
					<?endif;?>
					<?if ($arItem["DISPLAY_PROPERTIES"]):?>
						<div class="show_props">
							<a><span><?=GetMessage('PROPERTIES')?></span></a>
						</div>
						<div class="props-list-wrapp">
							<table class="props-list">
								<?foreach( $arItem["DISPLAY_PROPERTIES"] as $arProp ){?>
									<?if( !empty( $arProp["VALUE"] ) ){?>
										<tr>
											<td><?=$arProp["NAME"]?>:</td>
											<td>
												<?
													if(count($arProp["DISPLAY_VALUE"])>1) 
														{ foreach($arProp["DISPLAY_VALUE"] as $key => $value) { if ($arProp["DISPLAY_VALUE"][$key+1]) {echo $value.", ";} else {echo $value;} }} 
													else 
														{ echo $arProp["DISPLAY_VALUE"]; }
												?>
											</td>
										</tr>
									<?}?>
								<?}?>
								
							</table>
						</div>
					<?endif;?>
					
				</div>
				<div class="information">
					<div class="desc_name">
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
					</div>

                    <?if(empty($arResult["AMOUNTS"][$arItem["ID"]])){?>
                        <div class="noavailable_block">
                            <?=GetMessage('CATALOG_NOT_AVAILABLE')?>
                        </div>
                    <?}else{?>
                        <div class="available_block">
                            <?=GetMessage('CT_IS_AVAILABLE')?> ( <?=$arResult["AMOUNTS"][$arItem["ID"]]["AMOUNT"];?> )
                        </div>
                    <?}?>
				
					<?if( count( $arItem["OFFERS"] ) > 0 && $arItem["MIN_PRODUCT_OFFER_PRICE_PRINT"]){?>
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
											<?if (($arParams["SHOW_MEASURE"]=="Y")&&$arMeasure["SYMBOL_RUS"]):?>
												<?$symb = substr($arPrice["PRINT_VALUE"], strrpos($arPrice["PRINT_VALUE"], ' '));?>
												<span class="new"><?=str_replace($symb, "", $arPrice["PRINT_DISCOUNT_VALUE"])."<small>".$symb."/".$arMeasure["SYMBOL_RUS"]."</small>";?></span>
												<span class="old"><?=str_replace($symb, "", $arPrice["PRINT_VALUE"])."<small>".$symb."/".$arMeasure["SYMBOL_RUS"]."</small>";?></span>
											<?else:?>
												<span class="new"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
												<span class="old"><?=$arPrice["PRINT_VALUE"]?></span>
											<?endif;?>
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
					
					<div class="likes_icons">
						<!--noindex-->
							<?if(  $arItem["CAN_BUY"] ){?>
								<?if (empty($arItem["OFFERS"])):?>
									<a rel="nofollow" href="#<?=$arItem["ID"]?>" class="wish_item large"></a>
								<?endif;?>
							<?}?>
							<?if($arParams["DISPLAY_COMPARE"]){?>								
								<a rel="nofollow" element_id="#<?=$arItem["ID"]?>" href="<?=$arItem["COMPARE_URL"]?>" onclick="return addToCompare(this, 'detail', '/catalog/<?=str_replace( "#ACTION_CODE#", "DELETE_FROM_COMPARE_RESULT&ID=".$arItem["ID"], $arParams["SEF_URL_TEMPLATES"]['compare'])?>');" class="compare_item large"></a>
							<?}?>
						<!--/noindex-->
					</div>
					<div style="clear: right;"></div>
					
				</div>
				<div class="clearboth"></div>
			</div>
		<?}?>
	</div>
	<div class="shadow-item_info"><img border="0" alt="" src="/bitrix/templates/ishop/images/shadow-item_info.png"></div>
	<?if( $arParams["DISPLAY_BOTTOM_PAGER"] == "Y" ){?>
		<?=$arResult["NAV_STRING"]?>
	<?}?>
	
	<?
		$show=$arParams["PAGE_ELEMENT_COUNT"];
		if (array_key_exists("show", $_REQUEST))
		{
			if ( intVal($_REQUEST["show"]) && in_array(intVal($_REQUEST["show"]), array(20, 40, 60, 80, 100)) ) {$show=intVal($_REQUEST["show"]); $_SESSION["show"] = $show;}
			elseif ($_SESSION["show"]) {$show=intVal($_SESSION["show"]);}
		}
	?>
	
	<div class="drop_number">
		<?=GetMessage("CATALOG_DROP_TO")?>
		<a rel="nofollow" class="number" href="#"><span><?=$show?></span></a>
		<div class="number_list">
			<a rel="nofollow" class="number" href="#"><span><?=$show?></span></a>
			<?for( $i = 20; $i <= 100; $i+=20 ){
				if( $i == $show ) continue;?>
				<a rel="nofollow" href="<?=$APPLICATION->GetCurPageParam('show='.$i, array('show', 'mode'))?>"><?=$i?></a>
			<?}?>
		</div>
	</div>
	<div style="clear:both"></div>
<?}?>


<?if($arResult["~DESCRIPTION"]):?>
	<div class="group_description"><?=$arResult["~DESCRIPTION"]?></div>
<?endif;?>


<script>
	$(".display_list .description .show_props a").click(function()
	{
		$(this).toggleClass('open').parents(".description").find(".props-list-wrapp").slideToggle(333);
	});
</script>