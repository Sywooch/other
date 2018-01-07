<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
$arSections = array();

foreach( $arResult["SECTIONS"] as $arItem ) {

    if($arItem['UF_HOME']) {

        $hasItems = Helper::sectionHasItems($arItem['ID'], $arItem['IBLOCK_ID']);

        if($hasItems > 0){
            $arSections[$arItem["ID"]] = $arItem;
        }
    }
}

$arResult["SECTIONS"] = $arSections;



$content = ob_get_clean();
$replace = "";

$replace = $replace . "

    <div class=\"b-collections__wrapper js-collection-swiper\" data-swiperid=\"main\" data-loop=\"1\"
         data-time=\"3000\">
        <div class=\"swiper-container\">
            <div class=\"swiper-wrapper\">
                <!-- Slides -->

";
                $i = 1;

                $M=generate_rand_massive(1, 4, count($arResult["SECTIONS"]));
                //$M=generate_all_permutation(1, 4, count($arResult["SECTIONS"]));

                foreach($arResult["SECTIONS"] as $key => $arSection){
                    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
                    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));

                    $PICTURE = "";
                    if( !empty( $arSection["DETAIL_PICTURE"] ) ) {

                        $PICTURE = CFile::GetFileArray($arSection["DETAIL_PICTURE"]);

                        $renderImage = CFile::ResizeImageGet($PICTURE, Array("height" => 255, BX_RESIZE_IMAGE_EXACT));
                        $PICTURE["SRC"] = $renderImage['src'];
                        $PICTURE = $PICTURE["SRC"];

                    }else if( !empty( $arSection["PICTURE"] ) ){

                        $renderImage = CFile::ResizeImageGet($arSection["PICTURE"], Array("width" => 255, "height" => 255), BX_RESIZE_IMAGE_EXACT);
                        $PICTURE = $renderImage["src"];

                    }else{
                        $PICTURE = BX_DEFAULT_NO_PHOTO_IMAGE;
                    }


                    $replace = $replace . "
                    <div class=\"swiper-slide\">
                        <a href=\"".$arSection["SECTION_PAGE_URL"]."\" class=\"b-collections__item _type".$M[$i-1]."\">
                            <div class=\"b-collections__item-ico\"></div>
                            <div class=\"b-collections__item-img\"
                                 style=\"background-image: url(".$PICTURE.")\"></div>
                            <div class=\"b-collections__item-name\">
                                <span>".$arSection["NAME"]."</span>
                            </div>
                        </a>
                    </div>";

                    $i++;
                }



$replace = $replace . "
            </div>
            <div class=\"js-swiper-button-prev b-main-slider__prev _collection\"></div>
            <div class=\"js-swiper-button-next b-main-slider__next _collection\"></div>
        </div>
    </div>

    <!-- Вынуждены задублировать первый 2 для мобилок -->
    <div class=\"b-collections__wrapper _mobile\">
";
        $i = 1;

        $M=generate_rand_massive(1, 4, count($arResult["SECTIONS"]));
        //$M=generate_all_permutation(1, 4, count($arResult["SECTIONS"]));

        foreach($arResult["SECTIONS"] as $key => $arSection){
            $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
            $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));

            $PICTURE = "";
            if( !empty( $arSection["DETAIL_PICTURE"] ) ) {

                $PICTURE = CFile::GetFileArray($arSection["DETAIL_PICTURE"]);

                $renderImage = CFile::ResizeImageGet($PICTURE, Array("height" => 255, BX_RESIZE_IMAGE_EXACT));
                $PICTURE["SRC"] = $renderImage['src'];
                $PICTURE = $PICTURE["SRC"];

            }else if( !empty( $arSection["PICTURE"] ) ){

                $renderImage = CFile::ResizeImageGet($arSection["PICTURE"], Array("width" => 255, "height" => 255), BX_RESIZE_IMAGE_EXACT);
                $PICTURE = $renderImage["src"];

            }else{
                $PICTURE = BX_DEFAULT_NO_PHOTO_IMAGE;
            }

            $replace = $replace . "
            <div class=\"b-collections__mobile-item\">
                <a href=\"".$arSection["SECTION_PAGE_URL"]."\" class=\"b-collections__item _type".$M[$i-1]."\">
                    <div class=\"b-collections__item-ico\"></div>
                    <div class=\"b-collections__item-img\"
                         style=\"background-image: url(".$PICTURE.")\"></div>
                    <div class=\"b-collections__item-name\">
                        <span>".$arSection["NAME"]."</span>
                    </div>
                </a>
            </div>";

            $i++;
        }

$replace = $replace . "</div>";
?>


<?
echo str_replace('#NEED_TO_REPLACE#', $replace, $content);
?>
