<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 09.01.2017
 * Time: 16:36
 */

if(LANGUAGE_ID==='en'){
    $type = BX_CATALOG_SMART_FILTER_TYPES_EN;

}else{
    $type = BX_CATALOG_SMART_FILTER_TYPES;
}

$arFilterResult = array();


if(LANGUAGE_ID==='ru') {
    $arTypesRu = unserialize(BX_IBLOCK_CATALOG_TYPES_ARRAY_RU);
    //резервируем позиции доп первоприоритетные типы
    foreach($arTypesRu as $key => $typeItem){
        $arFilterResult[] = $typeItem;

    }
}



foreach($arResult["ITEMS"] as $key => $arItem){

    $arrTmp = array_msort($arItem["VALUES"], array('VALUE' => SORT_ASC));

    $arItem["VALUES"] = $arrTmp;
    $arResult["ITEMS"][$key]["VALUES"] = $arItem["VALUES"];


    if($arItem["CODE"] == $type){
    ?>
    <?foreach($arItem["VALUES"] as $val => $ar):?>
        <?
        $arFilter = Array(
            "IBLOCK_ID"=>$arItem['IBLOCK_ID'],
            "ACTIVE"=>"Y",
            '>PROPERTY_MINIMUM_PRICE' => 0,
            'PROPERTY_'.$type => $val
        );
        $rsItems = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, Array("ID"));
        $countItems = $rsItems->SelectedRowsCount();
        if($countItems > 0):

            if(LANGUAGE_ID==='ru') {
                if(in_array($ar["URL_ID"], $arFilterResult)){
                    $key = array_search($ar["URL_ID"], $arFilterResult);
                    $arFilterResult[$key] = $ar;
                }else{
                    $arFilterResult[] = $ar;
                }
            }else{
                $arFilterResult[] = $ar;
            }
            ?>

        <?endif;?>
    <?endforeach;?>
    <?
    }


}



$arResult["FILTER_RESULT"] = $arFilterResult;



?>


