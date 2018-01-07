<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>
<?
use Bitrix\Main\Localization\Loc as Loc;
Loc::loadMessages(__FILE__);
$this->setFrameMode(true);
?>



<div class="grid-row col-9 col-m-8 col-s-12">
    <div class="b-main-collection-top__item">
        <div class="b-main-collection-top__item-img" style="background-image: url(<?=$arResult["ITEM"]["IMAGE"];?>)">

        </div>
        <div class="b-main-collection-top__item-content">
            <div class="b-main-collection-top__item-title">

            <?=$arResult["ITEM"]["NAME"];?></div>
            <div class="b-main-collection-top__item-text"><?=$arResult["ITEM"]["DESCRIPTION"];?></div>
            <div class="b-main-collection-top__item-price"><?=$arResult["ITEM"]["PRICE"];?></div>
            <? if($arResult["ITEM"]["LINK"] && $arResult["ITEM"]["LINK"] != "/"){ ?>
            <div class="b-main-collection-top__item-btn">
                <a href="<?=$arResult["ITEM"]["LINK"];?>"
                   class="btn _medium-size _white-bg">
                    <?=GetMessage('PRODUCT_SPECIAL_TEMPLATE_BUTTON')?>
                </a>
            </div>
            <? } ?>
        </div>
    </div>
</div>




