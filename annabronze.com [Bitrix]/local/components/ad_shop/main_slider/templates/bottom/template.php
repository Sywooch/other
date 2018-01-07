<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>
<?
use Bitrix\Main\Localization\Loc as Loc;
Loc::loadMessages(__FILE__);
$this->setFrameMode(true);
?>






<div class="b-main-slider js-swiper-full _bottom-slider" data-swiperid="main" data-loop="1" data-time="3000">
    <div class="swiper-container">
        <div class="swiper-wrapper b-main-slider__wrapper">



            <?
            foreach($arResult['ITEMS'] as $key => $value){

                //echo "<pre>";
                //print_r($value);
                //echo "</pre>";
            ?>
            <div class="swiper-slide ">
                <div class="b-main-slider__item" style="background-image: url(<?=$value["PICTURE"];?>);">
                    <div class="b-main-slider__promo ">
                        <div class="b-main-slider__promo-title">
                            <? echo html_entity_decode($value["NAME"]);?>
                        </div>
                        <div class="b-main-slider__promo-link">
                            <a href="<?=$value["LINK"];?>" class="btn _white-bg _medium-size">
                                <?=GetMessage('MAIN_SLIDER_TEMPLATE_BUTTON')?>
                            </a>
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





