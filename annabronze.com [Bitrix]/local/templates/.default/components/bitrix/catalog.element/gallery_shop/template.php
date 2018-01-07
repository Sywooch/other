<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (($arParams["SHOW_MEASURE"]=="Y")&&($arResult["CATALOG_MEASURE"]))
{ $arMeasure = CCatalogMeasure::getList(array(), array("ID"=>$arResult["CATALOG_MEASURE"]), false, false, array())->GetNext(); }
?>



<!--<div class="shadow-item_info"><img border="0" alt="" src="<?/*=SITE_TEMPLATE_PATH*/?>/images/shadow-item_info.png"></div>-->
<div class="container left shop">
<div class="inner_left">
<div class="item_info">
<div class="item_slider">
    <ul class="slides">
        <?$images = array();
        if( is_array( $arResult["DETAIL_PICTURE"] ) ){
            $images[] = $arResult["DETAIL_PICTURE"];
        }
        foreach( $arResult["MORE_PHOTO"] as $arPhoto ){
            $images[] = $arPhoto;
        }?>
        <?foreach( $images as $key => $arPhoto ){?>
            <li id="photo-<?=$key?>" <?=$key == 0 ? 'class="current"' : ''?>>
                <?$img = CFile::ResizeImageGet( $arPhoto, array( "width" => 800, "height" => 600 ), BX_RESIZE_IMAGE_PROPORTIONAL, true, array() );?>
                <a href="<?=$img["src"]?>" alt="<?=($arPhoto["ALT"] ? $arPhoto["ALT"] : $arResult["NAME"])?>" title="<?=($arPhoto["TITLE"] ? $arPhoto["TITLE"] : $arResult["NAME"])?>" rel="item_slider" class="fancy">
                    <span class="lupa" style="display: none;" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>"></span>
                    <div class="marks">
                        <?if( $arResult["PROPERTIES"]["STOCK"]["VALUE"] ){?>
                            <span class="mark share"></span>
                        <?}?>
                        <?if( $arResult["PROPERTIES"]["HIT"]["VALUE"] ){?>
                            <span class="mark hit"></span>
                        <?}?>
                        <?if( $arResult["PROPERTIES"]["RECOMMEND"]["VALUE"] ){?>
                            <span class="mark like"></span>
                        <?}?>
                        <?if( $arResult["PROPERTIES"]["NEW"]["VALUE"] ){?>
                            <span class="mark new"></span>
                        <?}?>
                    </div>
                    <?$img = CFile::ResizeImageGet( $arPhoto, array( "width" => 280, "height" => 280 ), BX_RESIZE_IMAGE_PROPORTIONAL, true, array() );?>
                    <img border="0" src="<?=$img["src"]?>" alt="<?=($arPhoto["ALT"] ? $arPhoto["ALT"] : $arResult["NAME"])?>" title="<?=($arPhoto["TITLE"] ? $arPhoto["TITLE"] : $arResult["NAME"])?>" />
                </a>
            </li>
        <?}?>
        <?if( count($images) == 0 ){?>
            <li class="current">
                <div class="marks">
                    <?if( $arResult["PROPERTIES"]["STOCK"]["VALUE"] ){?>
                        <span class="mark share"></span>
                    <?}?>
                    <?if( $arResult["PROPERTIES"]["HIT"]["VALUE"] ){?>
                        <span class="mark hit"></span>
                    <?}?>
                    <?if( $arResult["PROPERTIES"]["RECOMMEND"]["VALUE"] ){?>
                        <span class="mark like"></span>
                    <?}?>
                    <?if( $arResult["PROPERTIES"]["NEW"]["VALUE"] ){?>
                        <span class="mark new"></span>
                    <?}?>
                </div>
                <img border="0" src="<?=SITE_TEMPLATE_PATH?>/images/noimagebig.gif" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
            </li>
        <?}?>
    </ul>
    <?if( count($images) > 1 ){?>
        <div class="thumbs">
            <ul id="thumbs">
                <?foreach( $images as $key => $arPhoto ){?>
                    <?$img = CFile::ResizeImageGet( $arPhoto, array( "width" => 80, "height" => 80 ), BX_RESIZE_IMAGE_PROPORTIONAL, true, array() );?>
                    <li <?=$key == 0 ? 'class="current"' : ''?>>
                        <a href="#photo-<?=$key?>">
                            <img border="0" src="<?=$img["src"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
                        </a>
                    </li>
                <?}?>
            </ul>
        </div>
    <?}?>
</div>
<div class="right_info">



    <?if ($arResult["PREVIEW_TEXT"]):?>
        <div class="description detail_description"><?=$arResult["PREVIEW_TEXT"];?></div>
    <?endif;?>
    <?if(count($arResult["DISPLAY_PROPERTIES"]["ASSOCIATED"]["LINK_ELEMENT_VALUE"])):?>
        <?if($arResult["PROPERTIES"]["TITLE_ASSOCIATED"]["VALUE"]):?>
            <div class="description"><?=$arResult["PROPERTIES"]["TITLE_ASSOCIATED"]["VALUE"];?></div>
        <?else:?>
            <div class="description">Связанные элементы:</div>
        <?endif?>
        <?foreach($arResult["DISPLAY_PROPERTIES"]["ASSOCIATED"]["LINK_ELEMENT_VALUE"] as $element):?>
            <div class="description main_description"><a href="<?=$element['DETAIL_PAGE_URL']?>"><?=$element['NAME']?></a></div>
        <?endforeach?>
    <?endif;?>

</div>
<div style="clear:both"></div>

<?if( is_array($arResult["OFFERS"]) && !empty($arResult["OFFERS"]) ){?>

    <?if($arParams["SKU_DISPLAY_LOCATION"]=="BOTTOM"):?>
        <?
        $numProps = count($arResult["SKU_ELEMENTS"]);


        foreach ($arResult["SKU_PROPERTIES"] as $key => $arProp)
        {
            $noProp = 0;
            foreach ($arResult["SKU_ELEMENTS"] as $i => $arSKU) { if (empty( $arSKU[$key] )) { $noProp++; } }
            if ($noProp==$numProps) { unset($arResult["SKU_PROPERTIES"][$key]); }

        }
        $showPrices = false;
        foreach ($arResult["SKU_ELEMENTS"] as $key => $arSKU) { if ($arSKU["DISCOUNT_PRICE"] || $arSKU["PRICE"]){$showPrices = true; break;} }
        $showPhotoColumn = false;
        if ($arParams["SKU_SHOW_PICTURES"]=="Y")
        {
            foreach ($arResult["SKU_ELEMENTS"] as $arSKU)
            { if( !empty($arSKU["PREVIEW_PICTURE"]) && !empty($arSKU["PREVIEW_PICTURE"] )) { $showPhotoColumn = true; break; } }
        }
        ?>
        <table class="equipment" cellspacing="0" cellpadding="0">
            <thead>
            <tr>
                <?if ($showPhotoColumn):?><td><?=GetMessage("CATALOG_PHOTO")?></td><?endif;?>
                <?foreach ($arResult["SKU_PROPERTIES"] as $key => $arProp){?><td><?=$arProp["NAME"]?></td><?}?>
                <?if ($showPrices):?><td><?=GetMessage("CATALOG_PRICE")?></td><?endif;?>
                <?if ($arParams["SHOW_QUANTITY_COUNT"]!="N"){?><td class="offer_count"><?=GetMessage("AVAILABLE")?></td><?}?>
                <?if ($arParams["USE_ONE_CLICK_BUY"]!="N"):?><td colspan="2"></td><?else:?><td></td><?endif;?>
            </tr>
            </thead>
            <tbody>
            <?$numProps = count($arResult["SKU_PROPERTIES"]);?>
            <?foreach ($arResult["SKU_ELEMENTS"] as $key => $arSKU){?>
                <?if ($arSKU["ID"]):?>
                    <tr>
                        <?if ($showPhotoColumn):?>
                            <td class="photo">
                                <?if( !empty($arSKU["PREVIEW_PICTURE"]) ){?>
                                    <a href="<?=($arSKU["DETAIL_PICTURE"]["SRC"]?$arSKU["DETAIL_PICTURE"]["SRC"]:$arSKU["PREVIEW_PICTURE"]["SRC"])?>" class="fancy" title="<?=$arSKU["NAME"]?>">
                                        <?$img_preview = CFile::ResizeImageGet( $arSKU["PREVIEW_PICTURE"]["ID"], array( "width" => 50, "height" => 50 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);?>
                                        <img border="0" src="<?=$img_preview["src"]?>" alt="<?=$arSKU["NAME"]?>" />
                                    </a>
                                <?}elseif( !empty($arSKU["DETAIL_PICTURE"]) ){?>
                                    <a href="<?=$arSKU["DETAIL_PICTURE"]["SRC"]?>" class="fancy" title="<?=$arSKU["NAME"]?>">
                                        <?$img_preview = CFile::ResizeImageGet( $arSKU["DETAIL_PICTURE"]["ID"], array( "width" => 50, "height" => 50 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);?>
                                        <img border="0" src="<?=$img_preview["src"]?>" alt="<?=$arSKU["NAME"]?>"  />
                                    </a>
                                <?}else{?>
                                    <img border="0" src="<?=SITE_TEMPLATE_PATH?>/images/noimage40.gif" alt="<?=$arSKU["NAME"]?>" title="<?=$arSKU["NAME"]?>" />
                                <?}?>
                            </td>
                        <?endif;?>
                        <?for( $i = 0; $i < $numProps; $i++ ){?><?=!empty( $arResult["SKU_PROPERTIES"][$i] ) ? '<td class="property">'.$arSKU[$i].'</td>' : ''?><?}?>
                        <?if ($showPrices):?><td class="price">
                            <?if (($arParams["SHOW_MEASURE"]=="Y")&&$arSCUMeasure["SYMBOL_RUS"]):?>
                                <?if( intval($arSKU["DISCOUNT_PRICE"]) > 0 && $arSKU["PRICE"] > 0){?>
                                    <span class="new"><?=str_replace($symb, "", $arSKU["DISCOUNT_PRICE"])."<small>".$symb."/".$arSCUMeasure["SYMBOL_RUS"]."</small>";?></span>
                                    <span class="old"><?=str_replace($symb, "", $arSKU["PRICE"])."<small>".$symb."/".$arSCUMeasure["SYMBOL_RUS"]."</small>";?></span>
                                <?}else{?>
                                    <?=str_replace($symb, "", $arSKU["PRICE"])."<small>".$symb."/".$arSCUMeasure["SYMBOL_RUS"]."</small>";?>
                                <?}?>
                            <?else:?>
                                <?if( intval($arSKU["DISCOUNT_PRICE"]) > 0 && $arSKU["PRICE"] > 0){?>
                                    <span class="new"><?=$arSKU["DISCOUNT_PRICE"]?> </span> <span class="old"><?=$arSKU["PRICE"]?> </span>
                                <?}elseif($arSKU["PRICE"]){?>
                                    <?=$arSKU["PRICE"]?>
                                <?}?>
                            <?endif;?>

                            </td><?endif;?>
                        <?if ($arParams["SHOW_QUANTITY_COUNT"]!="N"){?>
                            <td class="offer_count">
                                <?if($arParams["USE_STORE"] == "Y"):?><a class="show_offers_stores" onclick="return showOffersStores('<?=$arSKU["ID"]?>', '<?=$arParams["MIN_AMOUNT"]?>', '<?=$arParams["USE_MIN_AMOUNT"]?>', '<?=$arParams["USE_STORE_SCHEDULE"]?>', '<?=$arParams["USE_STORE_PHONE"]?>', '<?=$arParams["STORE_PATH"]?>');"><?endif;?>
                                    <?=$arSKU["CATALOG_QUANTITY"]?>
                                    <?if($arParams["USE_STORE"] == "Y"):?></a><?endif;?>
                            </td>
                        <?}?>
                        <!--noindex-->
                        <td class="buy_link">
                            <?if( $arSKU["CAN_BUY"] ){?>
                                <a rel="nofollow" element_id="#<?=$arSKU["ID"];?>" href="<?=$arSKU["ADD_URL"]?>" onclick="return addToCart(this, 'detail', '<?=GetMessage("CATALOG_IN_CART")?>', 'cart', '<?=$arParams["BASKET_URL"]?>', '<?=$arResult["ID"]?>', '<?=$arSKU["ID"]?>');"><?=GetMessage("CATALOG_BUY")?></a>
                            <?} elseif ($arNotify[SITE_ID]['use'] == 'Y'){?>
                                <?if( $USER->IsAuthorized() ){?>
                                    <noindex>
                                        <a rel="nofollow" href="<?=$arSKU["SUBSCRIBE_URL"]?>" onclick="return addToSubscribe(this, '<?=GetMessage("CATALOG_IN_SUBSCRIBE")?>');"><?=GetMessage("CATALOG_SUBSCRIBE")?></a>
                                        <sup class="notavailable"><?=GetMessage("CATALOG_NOT_AVAILABLE2")?></sup>
                                    </noindex>
                                <?}else{?>
                                    <noindex>
                                        <a rel="nofollow" href="#" onclick="showAuthForSubscribe(this, <?=$arSKU["ID"]?>, '<?=$arSKU["SUBSCRIBE_URL"]?>')"><?=GetMessage("CATALOG_SUBSCRIBE")?></a>
                                        <sup class="notavailable"><?=GetMessage("CATALOG_NOT_AVAILABLE2")?></sup>
                                    </noindex>
                                <?}?>
                            <?}?>
                        </td>
                        <?if ($arParams["USE_ONE_CLICK_BUY"]!="N"):?>
                            <td class="buy_link">
                                <?if( $arSKU["CAN_BUY"] ){?>
                                    <a onclick="return oneClickBuy('<?=$arSKU["ID"];?>', '<?=$arResult["IBLOCK_ID"]?>');"><?=GetMessage('ONE_CLICK_BUY')?></a>
                                <?}?>
                            </td>
                        <?endif;?>
                        <?if( $arParams["DISPLAY_COMPARE"] == "Y" ){?>
                            <td>
                                <a rel="nofollow" href="#<?=$arSKU["ID"]?>" class="wish_item"><?=GetMessage("CATALOG_IZB")?></a>
                            </td>
                        <?}?>
                        <!--/noindex-->
                    </tr>
                <?endif;?>
            <?}?>
            </tbody>
        </table>
        <br />
    <?endif;?>
<?}?>
</div>


<?if (($arParams["SHOW_KIT_PARTS"]=="Y") && !empty($arResult["SET_ITEMS"])):?>
    <div class="shadow-item_info"><img border="0" src="<?=SITE_TEMPLATE_PATH?>/images/shadow-item_info_revert.png" alt="" /></div>
    <div class="set_wrapp">
        <h4 class="char"><?=GetMessage("GROUP_PARTS_TITLE")?></h4>
        <div class="display_table">
            <?foreach ($arResult["SET_ITEMS"] as $iii => $arSetItem):?>
                <div class="table_item item_ws <?if( $i % 4 == 0 ):?>last-in-line<?endif;?>">
                    <div class="table_item_inner">
                        <div class="image">
                            <a href="<?=$arSetItem["DETAIL_PAGE_URL"]?>" class="thumb_cat">
                                <?if( !empty($arSetItem["PREVIEW_PICTURE"]) ):?>
                                    <?$img = CFile::ResizeImageGet($arSetItem["PREVIEW_PICTURE"], array( "width" => 140, "height" => 140 ), BX_RESIZE_IMAGE_PROPORTIONAL,true );?>
                                    <img border="0" src="<?=$img["src"]?>" alt="<?=$arSetItem["NAME"];?>" title="<?=$arSetItem["NAME"];?>" />
                                <?else:?>
                                    <img border="0" src="<?=SITE_TEMPLATE_PATH?>/images/noimage170.gif" alt="<?=$arSetItem["NAME"]?>" title="<?=$arSetItem["NAME"]?>" />
                                <?endif;?>
                            </a>
                        </div>
                        <div class="marks">
                            <?if( $arSetItem["PROPERTIES"]["STOCK"]["VALUE"] == true ){?><span class="mark share"></span><?}?>
                            <?if( $arSetItem["PROPERTIES"]["HIT"]["VALUE"] == true ){?><span class="mark hit"></span><?}?>
                            <?if( $arSetItem["PROPERTIES"]["RECOMMEND"]["VALUE"] == true ){?><span class="mark like"></span><?}?>
                            <?if( $arSetItem["PROPERTIES"]["NEW"]["VALUE"] == true ){?><span class="mark new"></span><?}?>
                        </div>
                        <a class="desc_name" href="<?=$arSetItem["DETAIL_PAGE_URL"]?>"><?=$arSetItem["NAME"]?></a>
                        <?if ($arParams["SHOW_KIT_PARTS_PRICES"]=="Y"):?>
                            <div class="price_block">
                                <?
                                $arCountPricesCanAccess = 0;
                                foreach( $arSetItem["PRICES"] as $key => $arPrice ) { if($arPrice["CAN_ACCESS"]){$arCountPricesCanAccess++;} }
                                ?>
                                <?foreach($arSetItem["PRICES"] as $key => $arPrice ){?>
                                    <?if( $arPrice["CAN_ACCESS"] ){?>
                                        <?$price = CPrice::GetByID($arPrice["ID"]); ?>
                                        <?if($arCountPricesCanAccess>1):?><div class="price_name"><?=$price["CATALOG_GROUP_NAME"];?></div><?endif;?>
                                        <div class="price">
                                            <?if( $arPrice["VALUE"] > $arPrice["DISCOUNT_VALUE"] ){?>
                                                <div class="price">
                                                    <?if (($arParams["SHOW_MEASURE"]=="Y")&&$arSetItem["MEASURE"]["SYMBOL_RUS"]):?>
                                                        <?$symb = substr($arPrice["PRINT_VALUE"], strrpos($arPrice["PRINT_VALUE"], ' '));?>
                                                        <span class="new"><?=str_replace($symb, "", $arPrice["PRINT_DISCOUNT_VALUE"])."<small>".$symb."/".$arSetItem["MEASURE"]["SYMBOL_RUS"]."</small>";?></span>
                                                        <span class="old"><?=str_replace($symb, "", $arPrice["PRINT_VALUE"])."<small>".$symb."/".$arSetItem["MEASURE"]["SYMBOL_RUS"]."</small>";?></span>
                                                    <?else:?>
                                                        <span class="new"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
                                                        <span class="old"><?=$arPrice["PRINT_VALUE"]?></span>
                                                    <?endif;?>
                                                </div>
                                            <?}else{?>
                                                <?if (($arParams["SHOW_MEASURE"]=="Y")&&$arSetItem["MEASURE"]["SYMBOL_RUS"]):?>
                                                    <?$symb = substr($arPrice["PRINT_VALUE"], strrpos($arPrice["PRINT_VALUE"], ' '));?>
                                                    <span><?=str_replace($symb, "", $arPrice["PRINT_VALUE"])."<small>".$symb."/".$arSetItem["MEASURE"]["SYMBOL_RUS"]."</small>";?></span>
                                                <?else:?><span><?=$arPrice["PRINT_VALUE"]?></span><?endif;?>
                                            <?}?>
                                        </div>
                                    <?}?>
                                <?}?>
                            </div>
                        <?endif;?>
                    </div>
                    <?if(($iii+1) % 4 != 0 && $arResult["SET_ITEMS"][$iii+1]){?><div class="plus"></div><?}?>
                </div>
                <?if( ($iii+1) % 4 == 0 && ($iii+1) < count($arResult["SET_ITEMS"]) ){?>
                    <div class="long_separator"></div>
                <?}?>
            <?endforeach;?>
        </div>
    </div>
<?endif;?>

<? if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])) {
    if ($arResult['OFFER_GROUP']) { foreach ($arResult['OFFERS'] as $arOffer) { if (!$arOffer['OFFER_GROUP']) continue;
        ?>
        <span id="<? echo $arItemIDs['OFFER_GROUP'].$arOffer['ID']; ?>" style="display: none;">
			<?$APPLICATION->IncludeComponent("bitrix:catalog.set.constructor", "shop",
                array(
                    "IBLOCK_ID" => $arResult["OFFERS_IBLOCK"],
                    "ELEMENT_ID" => $arOffer['ID'],
                    "PRICE_CODE" => $arParams["PRICE_CODE"],
                    "BASKET_URL" => $arParams["BASKET_URL"],
                    "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                    "SHOW_MEASURE" => $arParams["SHOW_MEASURE"],
                ), $component, array("HIDE_ICONS" => "Y")
            );?>
	</span>
    <?}}} else {?>
    <?$APPLICATION->IncludeComponent("bitrix:catalog.set.constructor", "shop",
        array(
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "ELEMENT_ID" => $arResult["ID"],
            "PRICE_CODE" => $arParams["PRICE_CODE"],
            "BASKET_URL" => $arParams["BASKET_URL"],
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => $arParams["CACHE_TIME"],
            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
            "SHOW_MEASURE" => $arParams["SHOW_MEASURE"],
        ), $component, array("HIDE_ICONS" => "Y")
    );?>
<?}?>

<? /*Product Description */ ?>
<?		$rsStock = CIBlockElement::GetList(array(), array("ACTIVE" => "Y", "IBLOCK_ID" => $arParams["IBLOCK_STOCK_ID"], "PROPERTY_LINK" => $arResult["ID"]));
$stockShadowShown = false;
if($rsStock->SelectedRowsCount()>0):?>
    <div class="shadow-item_info"><img border="0" src="<?=SITE_TEMPLATE_PATH?>/images/shadow-item_info_revert.png" alt="" /></div>
    <?	$stockShadowShown = true;
    $rsStock->SetUrlTemplates($arParams["SEF_MODE_STOCK_SECTIONS"].$arParams["SEF_MODE_STOCK_ELEMENT"]);
    $stockNumber = 1;
    while( $arStock = $rsStock->GetNext() ){?>
        <div class="stock_board<?=($stockNumber==1?" first": "")?>"><?$stockNumber++;?>
            <div class="name"><?=GetMessage("CATALOG_STOCK_TITLE")?> <a class="read_more" href="<?=$arStock["DETAIL_PAGE_URL"]?>"><?=GetMessage("CATALOG_STOCK_VIEW")?></a> <i></i> </div>
            <div class="txt"><?=$arStock["PREVIEW_TEXT"]?></div>
        </div>
    <?}?>
<?endif;?>
<?if ($arResult["DETAIL_TEXT"]):?>
    <?if (!$stockShadowShown):?><div class="shadow-item_info"><img border="0" src="<?=SITE_TEMPLATE_PATH?>/images/shadow-item_info_revert.png" alt="" /></div><?endif;?>
    <!--<div class="detail_text"><?/*=$arResult["DETAIL_TEXT"]*/?></div>-->
<?endif;?>




<? /*Product tabs */ ?>



<!--noindex-->
<?/*if(!$arResult["CATALOG_QUANTITY"]){?>
			<?if( $USER->IsAuthorized() ){?>
				<a rel="nofollow" href="<?=$arResult["SUBSCRIBE_URL"]?>" class="button add_order" onclick="return addToSubscribe(this, '<?=GetMessage("CATALOG_IN_SUBSCRIBE")?>');" class="bt2" id="catalog_add2cart_link"><span><?=GetMessage('CATALOG_ORDER_NAME')?></span></a>
			<?}else{?>
				<a rel="nofollow" href="#" class="button add_order" onclick="showAuthForSubscribe(this, <?=$arResult["ID"]?>, '<?=$arResult["SUBSCRIBE_URL"]?>')" class="bt2"><span><?=GetMessage('CATALOG_ORDER_NAME')?></span></a>
			<?}?><br/><br/>
		<?}*/?>
<!--/noindex-->
<?
$showProps = false;
foreach( $arResult["DISPLAY_PROPERTIES"] as $arProp )
{
    if (($arProp["CODE"]!="HIT")&&($arProp["CODE"]!="RECOMMEND")&&($arProp["CODE"]!="NEW")&&($arProp["CODE"]!="STOCK")&&trim($arProp["VALUE"])){$showProps=true;}
}
?>






