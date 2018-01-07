<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>
<?
use Bitrix\Main\Localization\Loc as Loc;
Loc::loadMessages(__FILE__);
$this->setFrameMode(true);
?>





    <div class="b-main-top">
        <div class="b-main-top__pattern"></div>
        <div class="b-title js-content-title _no-marg">
            <div class="b-title__row _title">
                <div class="b-title__title"><? echo GetMessage('SB_TOP_TITLE') ?></div>
            </div>
        </div>

        <ul class="b-main-top__sections" data-moretext="<? echo GetMessage('SB_TOP_SEE_MORE') ?>">

            <?if(LANGUAGE_ID==='en'):?>
                <?$APPLICATION->IncludeComponent("bitrix:catalog.smart.filter", "top", array(
                    "IBLOCK_TYPE" => "catalog",
                    "IBLOCK_ID" => CATALOG_IBLOCK_ID_EN,
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
            <?else:?>

                 <?$APPLICATION->IncludeComponent("bitrix:catalog.smart.filter", "top", array(
                "IBLOCK_TYPE" => "aspro_ishop_catalog",
                "IBLOCK_ID" => CATALOG_IBLOCK_ID,
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
            <?endif?>
        </ul>
        <div class="b-main-top__list">
            <div class="b-catalog-list">


                <?//$APPLICATION->ShowViewContent('main_top');  ?>



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
                        <?
                        $url = $arItem["DETAIL_PAGE_URL"]."?offer=".$arItem["OFFER_ACTIVE_ID"];
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

                        <div class="b-catalog-list__item-title js-catalog-list__item-title"
                            >
                            <?/*=$arItem["PROPERTIES"]["CML2_ARTICLE2"]["VALUE"]."--".*/ echo $arItem["NAME"]; ?>
                        </div>
                        <div class="b-catalog-list__item-price js-catalog-list__item-price"><?= $arItem["PRICE_PRINT"] ?></div>


                        <div style="display:none;">
                            <div class="b-catalog-list__item-colors">
                                <div class="b-colors js-product-list-card-colors">

                                    <?
                                    print_r($arItem["OFFERS"]);
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
                        </div>

                        <div class="b-catalog-list__item-details"><?=GetMessage("CATALOG_LIST_ITEM_DETAILS");?></div>




                        <?
                        if($arItem["IN_BASKET"]=="N"){
                            ?>
                            <a href="/basket/" class="b-catalog-list__item-btn link _added added
							disabled"
                               style="display:none"><?=GetMessage("CATALOG_LIST_ITEM_ADDED_TO_CART");?>
                            </a>

                            <a href="/local/include/ajax-added.php" class="b-catalog-list__item-btn open-ajax link no_added">
                                <?=GetMessage("CATALOG_LIST_ITEM_ADD_TO_CART");?>
                            </a>
                            <?
                        }else{
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



<?
/*
?>


<div class="b-main-slider js-swiper-full" data-swiperid="main" data-loop="1" data-time="3000">
    <div class="swiper-container">
        <div class="swiper-wrapper b-main-slider__wrapper">

            <?
            foreach($arResult['ITEMS'] as $k => $v){
            ?>
            <div class="swiper-slide ">
                <div class="b-main-slider__item" style="background-image: url(<?=$v["PICTURE"];?>);">
                    <div class="b-main-slider__text <? if( ($k % 2) == 0 ){ echo '_left'; }else{ echo '_right'; }; ?>">
                        <div class="b-main-slider__text-title">
                           <?=$v["NAME"];?>
                        </div>
                        <div class="b-main-slider__text-content">
                            <?=$v["PREVIEW_TEXT"];?>
                        </div>
                        <div class="b-main-slider__text-link">
                            <a href="<?=$v["LINK"];?>"><?=GetMessage('MAIN_SLIDER_TEMPLATE_BUTTON')?></a>
                        </div>
                    </div>
                </div>
            </div>
            <?
                }
            ?>


        </div>


        <div class="js-swiper-button-prev b-main-slider__prev"></div>
        <div class="js-swiper-button-next b-main-slider__next"></div>
    </div>

</div>


<?
*/
?>