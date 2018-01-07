<?

foreach($arResult['BASKET'] as $cell => $basketItem){
    $PRODUCT_ID = $basketItem["PRODUCT_ID"];

    $res = CIBlockElement::GetByID($PRODUCT_ID);
    if($ar_res = $res->GetNext()){
        $picture = "";
        if(!empty($ar_res["PREVIEW_PICTURE"])){
            $picture = $ar_res["PREVIEW_PICTURE"];
        }else if(!empty($ar_res["DETAIL_PICTURE"])){
            $picture = $ar_res["DETAIL_PICTURE"];
        }else{
            $db_props = CIBlockElement::GetProperty($basketItem["IBLOCK_ID"], $PRODUCT_ID, array("sort" => "asc"), Array("CODE"=>"MORE_PHOTO"));
            if($ar_props = $db_props->Fetch()){
                $picture = $ar_props["VALUE"];
            }
        }

        if(!empty($picture)){

            $picture=CFile::GetFileArray($picture);
            $picture = CFile::ResizeImageGet($picture, Array("width" => 67, "height" => 67), BX_RESIZE_IMAGE_EXACT);
            $picture = $picture['src'];

        }else{
            $picture = BX_DEFAULT_NO_PHOTO_IMAGE;
        }

        $arResult['BASKET'][$cell]["PICTURE"] = $picture;


    }



    $arResult["BASKET"][$cell]["DETAIL_PAGE_URL"] = $arResult["BASKET"][$cell]["DETAIL_PAGE_URL"]."?offer=".$PRODUCT_ID;


}

?>