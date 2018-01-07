<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(!CModule::IncludeModule("iblock")) return;
?>
<?
global $DB;
$format_short = CSite::GetDateFormat("SHORT");
?>
<div class="grid-row col-1 col-xm-12 col-s-12"></div>
<div class="b-layout__inner-content grid-row col-10 col-xm-12  col-s-12">
    <div class="b-layout__info-box"><!-- for content pages - content styles -->
        <div class="b-search">
            <div class="b-search__form">
                <form action="" method="get">
                    <div class="b-search__form-input">
                        <input placeholder="<?=GetMessage('CT_BSP_PLACEHOLDER');?>" type="text" class="b-search__input" name="q" value="<?=$arResult["REQUEST"]["QUERY"]?>"/>
                    </div>
                    <div class="b-search__form-btn">
                        <input type="submit" class="btn _full" value="<?=GetMessage('CT_BSP_GO');?>"/>
                    </div>
                </form>
            </div>
            <div class="b-search__notice">
                <?if(is_object($arResult["NAV_RESULT"])):?>
                    <?echo GetMessage("CT_BSP_FOUND")?>: <span><?echo $arResult["NAV_RESULT"]->SelectedRowsCount()?></span>
                <?endif;?>
            </div>
            <div class="b-search__list">
                <?if(count($arResult["SEARCH"])>0):?>
                    <?foreach($arResult["SEARCH"] as $arItem):?>
                        <div class="b-search__item">
                            <?
                            $srcImg = BX_DEFAULT_NO_PHOTO_IMAGE;
                            if ($arItem["MODULE_ID"]=="iblock")
                            {
                                if(preg_match('/S\d+/i', $arItem["ITEM_ID"])) { //значит это раздел
                                    $rsElem = CIBlockSection::GetByID(str_replace('S', '', $arItem["ITEM_ID"]));
                                    if($arElem = $rsElem->Fetch())
                                    {
                                        if ($arElem['PICTURE']) {
                                            $img = CFile::ResizeImageGet($arElem['PICTURE'], Array("width" => 159, "height" => 159), BX_RESIZE_IMAGE_EXACT);
                                            $srcImg = $img['src'];
                                        } elseif($arElem['DETAIL_PICTURE']) {
                                            $img = CFile::ResizeImageGet($arElem['DETAIL_PICTURE'], Array("width" => 159, "height" => 159), BX_RESIZE_IMAGE_EXACT);
                                            $srcImg = $img['src'];
                                        }
                                    }
                                } else {
                                    $rsElem = CIBlockElement::GetByID($arItem["ITEM_ID"]);
                                    if($arElem = $rsElem->Fetch())
                                    {
                                        $offersExist = CCatalogSKU::getExistOffers(array($arElem['ID']));

                                        if($offersExist[$arElem['ID']]) {
                                            $catalogSKU = CCatalogSKU::GetInfoByProductIBlock(
                                                $arElem["IBLOCK_ID"]
                                            );

                                            $rsOffer = CIBlockElement::GetList(
                                                array("rand"=>"ASC"),
                                                array(
                                                    'ACTIVE' => "Y",
                                                    'IBLOCK_ID' => $catalogSKU['IBLOCK_ID'],
                                                    'PROPERTY_'.$catalogSKU['SKU_PROPERTY_ID'] => $arElem["ID"],
                                                    array(
                                                        "LOGIC" => "OR",
                                                        array('!DETAIL_PICTURE' => false),
                                                        array('!PREVIEW_PICTURE' => false),
                                                    ),
                                                ),
                                                false,
                                                array('nTopCount'=>1),
                                                array('PREVIEW_PICTURE', 'DETAIL_PICTURE')
                                            );

                                            if ($arOffer = $rsOffer->Fetch()) {
                                                if ($arOffer['PREVIEW_PICTURE']) {
                                                    $img = CFile::ResizeImageGet($arOffer['PREVIEW_PICTURE'], Array("width" => 159, "height" => 159), BX_RESIZE_IMAGE_EXACT);
                                                    $srcImg = $img['src'];
                                                } elseif($arOffer['DETAIL_PICTURE']) {
                                                    $img = CFile::ResizeImageGet($arOffer['DETAIL_PICTURE'], Array("width" => 159, "height" => 159), BX_RESIZE_IMAGE_EXACT);
                                                    $srcImg = $img['src'];
                                                }
                                            }
                                        } else {
                                            if ($arElem['PREVIEW_PICTURE']) {
                                                $img = CFile::ResizeImageGet($arElem['PREVIEW_PICTURE'], Array("width" => 159, "height" => 159), BX_RESIZE_IMAGE_EXACT);
                                                $srcImg = $img['src'];
                                            } elseif($arElem['DETAIL_PICTURE']) {
                                                $img = CFile::ResizeImageGet($arElem['DETAIL_PICTURE'], Array("width" => 159, "height" => 159), BX_RESIZE_IMAGE_EXACT);
                                                $srcImg = $img['src'];
                                            }
                                        }
                                    }
                                }
                            }
                            ?>
                            <div class="b-main-news__anounce-img" style="background-image: url(<?=$srcImg?>)"></div>
                            <div class="b-search__item-wrapper">
                                <a href="<?echo $arItem["URL"]?>" class="b-search__item-title"><?echo $arItem["TITLE_FORMATED"]?></a>
                                <div class="b-search__item-text">
                                    <?echo $arItem["BODY_FORMATED"]?>
                                </div>
                                <div class="b-search__item-meta">
                                    <div class="b-search__item-tags">
                                        <?$countTags = count($arItem['TAGS']);?>
                                        <?if($countTags):?>
                                            <?=GetMessage('CT_BSP_TAGS');?>:
                                            <?foreach ($arItem['TAGS'] as $key=>$TAG):?>
                                                <a href="<?=$TAG['URL']?>"><?=$TAG['TAG_NAME']?></a><?if($key != $countTags-1):?>,<?endif;?>
                                            <?endforeach;?>
                                        <?endif;?>
                                    </div>
                                    <div class="b-search__item-date">
                                        <?
                                        if($arItem["DATE_CHANGE"]) {
                                            $dateFormatted = $DB->FormatDate($arItem['DATE_CHANGE'], $format_short, 'DD.MM.YYYY');
                                            $date = DateTime::createFromFormat('d.m.Y', $dateFormatted);
                                            echo $date->format('d').' I '.$date->format('m').' I '.$date->format('y');
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?endforeach;?>
                <?endif;?>
                <? echo $arResult["NAV_STRING"];?>
            </div>
        </div>
    </div>
</div>