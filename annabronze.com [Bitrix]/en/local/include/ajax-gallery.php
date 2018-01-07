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
$APPLICATION->IncludeFile($APPLICATION->GetCurDir()."/lang/".LANGUAGE_ID."/ajax-gallery.php", Array(), Array());

$arIBlockElement = GetIBlockElement($_GET["id"]);

function renderCollections($arIBlockElement, $additionalClass = ''){
    ?>
    <div class="b-popup-gallery__collections <?=$additionalClass?>">
        <div class="b-popup-gallery__collections-title"><?=GetMessage("POPUP_COLLECTIONS_TITLE");?>:
        </div>
        <?
        foreach($arIBlockElement["PROPERTIES"]["ASSOCIATED"]["VALUE"] as $productId) {
            $arIBlockProduct = GetIBlockElement($productId);

            $intIBlockID = $arIBlockProduct["IBLOCK_ID"];

            $mxResult = CCatalogSKU::GetInfoByProductIBlock(
                $intIBlockID
            );

            unset($arOffers);
            if(CCatalogSKU::IsExistOffers($productId, $arIBlockProduct["IBLOCK_ID"]))
            {
                $rsOffers_color = CIBlockElement::GetList(array("PRICE"=>"ASC"),array('IBLOCK_ID' => $mxResult['IBLOCK_ID'], 'PROPERTY_'.$mxResult['SKU_PROPERTY_ID'] => $productId));

                while ($arOffer_color = $rsOffers_color->GetNext()){
                    $arOffers[] = $arOffer_color["ID"];
                }
            }
            $randomOffer=mt_rand(0, count($arOffers)-1);
            ?>
            <a href="<?=$arIBlockProduct["DETAIL_PAGE_URL"];?>?offer=<?=$arOffers[$randomOffer];?>"><?=$arIBlockProduct["NAME"];?> <span></span></a>
            <?
        }
        ?>
    </div>
    <?
}
?>





<div class="b-popup" id="gallery_popup" >
    <div class="b-popup__title"><?=$arIBlockElement["NAME"];?></div>

    <div class="b-popup-gallery js-popup-gallery">
        <div class="b-popup-gallery__pager js-popup-gallery-pager">
            <a href="#" class="b-card-gallery__pager-prev js-gallery-pager-prev"></a>
            <a href="#" class="b-card-gallery__pager-next js-gallery-pager-next"></a>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?
                    $isFirst = true;
                    $i=1;
                    foreach($arIBlockElement["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $v) {
                        $img = CFile::GetFileArray($v);
                        $imgBig = $img["SRC"];
                        if($i == 1){ $imgBigDefault = $imgBig; }
                        $img = CFile::ResizeImageGet( $img, array( "width" => 68, "height" => 68 ), BX_RESIZE_IMAGE_EXACT, true, array() );
                        $i++;
                        ?>
                        <div class="swiper-slide">
                            <div class="b-popup-gallery__pager-item <?if($isFirst):?>_current<?endif?> js-pager-index-<?=$i?>" data-pager-index="<?=$i?>"
                                 style="background-image: url(<?=$img["src"];?>)"
                                 data-preview-src="<?=$imgBig;?>"></div>
                        </div>
                        <?
                        $isFirst = false;
                    }
                    ?>
                </div>
            </div>

        </div>
        <div class="b-popup-gallery__pager js-popup-gallery-pager _is-on-small">
            <a href="#" class="b-card-gallery__pager-prev js-gallery-pager-prev"></a>
            <a href="#" class="b-card-gallery__pager-next js-gallery-pager-next"></a>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?
                    $isFirst = true;
                    $i=1;
                    foreach($arIBlockElement["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $v) {
                        $img = CFile::GetFileArray($v);
                        $imgBig = $img["SRC"];
                        if($i == 1){ $imgBigDefault = $imgBig; }
                        $img = CFile::ResizeImageGet( $img, array( "width" => 68, "height" => 68 ), BX_RESIZE_IMAGE_EXACT, true, array() );
                        $i++;
                        ?>
                        <div class="swiper-slide">
                            <div class="b-popup-gallery__pager-item <?if($isFirst):?>_current<?endif?> js-pager-index-<?=$i?>" data-pager-index="<?=$i?>"
                                 style="background-image: url(<?=$img["src"];?>)"
                                 data-preview-src="<?=$imgBig;?>"></div>
                        </div>
                        <?
                        $isFirst = false;
                    }
                    ?>
                </div>
            </div>

        </div>
        <div class="b-popup-gallery__wrapper" data-gallery-id="<?=$_REQUEST["id"]?>">
            <div class="b-popup-gallery__img-wrapper">
                <div class="b-popup-gallery__img <?if(empty($arIBlockElement["PROPERTIES"]["ASSOCIATED"]["VALUE"])):?>_force-full-width<?endif?>"
                     style="background-image: url(<?=$imgBigDefault;?>)">
                    <a href="<?=$imgBigDefault;?>" class="js-open-full-photo b-popup-gallery__zoom" data-current-photo-index="1" data-gallery-url="<?=P_GALLERY_URL?>?url=<? echo $_GET["url"];?>&id=<? echo $_GET["id"];?>">
                        <span></span></a>
                    <?/*<img alt="" src="<?=$imgBigDefault;?>" class="js-popup-gallery-img"/> */?>
                </div>
                <?if(!empty($arIBlockElement["PROPERTIES"]["ASSOCIATED"]["VALUE"])){?>
                    <?renderCollections($arIBlockElement, "_wide-only")?>
                <?}?>
            </div>

        </div>
        <div class="b-popup-gallery__info">
            <?if(!empty($arIBlockElement["PROPERTIES"]["ASSOCIATED"]["VALUE"])){?>
                <?renderCollections($arIBlockElement)?>
            <?}?>
            <div class="b-popup-gallery__description">
                <?=$arIBlockElement["PREVIEW_TEXT"];?>
            </div>
        </div>

    </div>
</div>




<?
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>
