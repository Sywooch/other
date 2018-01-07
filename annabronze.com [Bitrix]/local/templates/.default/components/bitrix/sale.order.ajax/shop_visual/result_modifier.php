<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();





foreach($arResult["BASKET_ITEMS"] as $key => $arBasketItems){

	$productId = $arBasketItems["PRODUCT_ID"];
	$iblockId = CIBlockElement::GetIBlockByID($productId);

	//детальная картинка
	if(empty($arBasketItems["DETAIL_PICTURE_SRC"]) && empty($arBasketItems["PREVIEW_PICTURE_SRC"])){



		$db_props = CIBlockElement::GetProperty($iblockId, $productId, array("sort" => "asc"), Array("CODE"=>"MORE_PHOTO"));


		if($ar_props = $db_props->Fetch()){

			$MORE_PHOTO = $ar_props["VALUE"];
		}

		if(empty($MORE_PHOTO)){
			$arResult["BASKET_ITEMS"][$key]["DETAIL_PICTURE_SRC"] = BX_DEFAULT_NO_PHOTO_IMAGE;
		}


	}



	//ссылка на детальную страницу
	//$arResult["BASKET_ITEMS"][$key]["DETAIL_PAGE_URL"] = $arBasketItems["DETAIL_PAGE_URL"]."/?offer=".$productId;


};


?>