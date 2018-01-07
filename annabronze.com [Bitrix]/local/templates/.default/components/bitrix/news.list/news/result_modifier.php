<?
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 27.01.2017
 * Time: 19:35
 */

foreach($arResult['ITEMS'] as $cell => $item) {




    $res = CIBlockElement::GetByID($item["ID"]);
    if($ar_res = $res->GetNext()){
        $picture = "";
        if(!empty($ar_res["DETAIL_PICTURE"])){
            $picture = $ar_res["DETAIL_PICTURE"];
        }/*else if(!empty($ar_res["PREVIEW_PICTURE"])){
            $picture = $ar_res["PREVIEW_PICTURE"];
        }else{
            $db_props = CIBlockElement::GetProperty($basketItem["IBLOCK_ID"], $item["ID"], array("sort" => "asc"), Array("CODE"=>"MORE_PHOTO"));
            if($ar_props = $db_props->Fetch()){
                $picture = $ar_props["VALUE"];
            }
        }*/

        if(!empty($picture)){

            $picture=CFile::GetFileArray($picture);
            $picture = CFile::ResizeImageGet($picture, Array("width" => 214, "height" => 214), BX_RESIZE_IMAGE_EXACT);
            $picture = $picture['src'];

        }else{
            $picture = BX_DEFAULT_NO_PHOTO_IMAGE;
        }



        $arResult['ITEMS'][$cell]["PICTURE"] = $picture;


    }



}


?>