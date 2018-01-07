<?
$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
set_time_limit(0);
//define("LANG", "ru");
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

global $APPLICATION;
CModule::IncludeModule('iblock');
CModule::IncludeModule('main');
CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");
$APPLICATION->IncludeFile($APPLICATION->GetCurDir()."/lang/".LANGUAGE_ID."/ajax-added.php", Array(), Array());
?>

<div class="b-popup-card" id="popCard">
    <div class="b-popup__title"><?=GetMessage("POPUP_TITLE");?></div>

    <div class="b-popup-card__wrapper js-product-list-card">
        <div class="b-popup-card__left">
            <div class="b-popup-card__img js-product-list-card-img"
                 style="background-image: url(images/cat1.jpg)"
                 data-current-color-index="1"
                 data-color-img-index-1="images/cat1.jpg"
                 data-color-img-index-2="images/cat1-1.jpg"
            >

            </div>
            <a href="#" class="b-popup-card__continue" onclick="$.fancybox.close()"><?=GetMessage("POPUP_CONTINUE_SHOPPING");?></a>

        </div>
        <div class="b-popup-card__right">
            <div class="b-popup-card__title js-popup-card__title">

            </div>
            <div class="b-product-card__prices">
                <div class="b-product-card__prices-inner">
                    <div class="b-product-card__prices-price js-product-card__prices-price _small"></div>
                    <div class="b-product-card__prices-counter">
                        <div class="b-counter _small js-product-counter" data-maxcount="9">
                            <div class="b-counter__plus">+</div>
                            <div class="b-counter__minus">-</div>
                            <input class="b-counter__input" value="1"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="b-product-card__stock js-product-card__stock _gray">

                <?=GetMessage("POPUP_IN_STOCK");?>: <b></b><br>
                <div class="b-product-card__stock-message js-product-card__stock-message"
                     style="display:none"><?=GetMessage("POPUP_IN_STOCK_MESSAGE");?></div>


            </div>

            <div class="b-product-card__colors">
                <div class="b-colors js-product-list-card-colors">

                    <div class="b-colors__title"><?=GetMessage("POPUP_SELECT_COLOR");?>:</div>
                    <div class="b-colors__container js-colors__container">
                        <div class="b-colors__item _color-1 _current" data-color-index="1"><i></i></div>
                        <div class="b-colors__item _color-2" data-color-index="2"><i></i></div>
                    </div>

                </div>
            </div>

            <input type="hidden" id="offer_id" data-id=""/>
            <div class="b-product-card__btn">
                <a href="#" class="btn _full js-add-ro-cart add"><?=GetMessage("POPUP_ADD_TO_CART");?></a>

                <a href="<? if(LANGUAGE_ID==='en'){ echo "/en"; } ?>/basket/" style="display:none;" class="btn _full disabled added"><?=GetMessage("POPUP_ADDED_TO_CART");?> </a>

            </div>

        </div>

    </div>

    <div class="b-popup-card__notice js-popup-card__notice">
        <?=GetMessage("POPUP_DISCOUNT_1");?> <span class="js-discount-active"></span>.

        <span class="js-hide-next-discount"><?=GetMessage("POPUP_DISCOUNT_2");?> <span class="js-discount-next"></span> <?=GetMessage("POPUP_DISCOUNT_3");?> <span class="js-summ"></span></span><br/>

        <br/>

        <? $APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file",
            "PATH" => "/include_areas/discount_info.php","EDIT_TEMPLATE" => ""));?>





    </div>

</div>
<?
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>
