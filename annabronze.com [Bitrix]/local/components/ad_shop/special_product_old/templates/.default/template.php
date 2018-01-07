<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>
<?
use Bitrix\Main\Localization\Loc as Loc;
Loc::loadMessages(__FILE__);
$this->setFrameMode(true);
?>



<div class="grid-row col-9 col-m-8 col-s-12">
    <div class="b-main-collection-top__item">
        <div class="b-main-collection-top__item-img" style="background-image: url(<?=$arResult["ITEM"]["PREVIEW_PICTURE"]["SRC"];?>)">

        </div>
        <div class="b-main-collection-top__item-content">
            <div class="b-main-collection-top__item-title"><?=GetMessage('PRODUCT_SPECIAL_SALE_COLLECTION')?>
            <?=$arResult["ITEM"]["COLLECTION"];?></div>
            <div class="b-main-collection-top__item-text"><?=$arResult["ITEM"]["NAME"];?></div>
            <div class="b-main-collection-top__item-price"><?=$arResult["ITEM"]["PRICE_PRINT"];?></div>
            <div class="b-main-collection-top__item-btn">
                <a href="<?=$arResult["ITEM"]["DETAIL_PAGE_URL"];?>?offer=<?=$arResult["ITEM"]["OFFER_ACTIVE_ID"];?>"
                   class="btn _medium-size _white-bg">
                    <?=GetMessage('PRODUCT_SPECIAL_TEMPLATE_BUTTON')?>
                </a>
            </div>
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
