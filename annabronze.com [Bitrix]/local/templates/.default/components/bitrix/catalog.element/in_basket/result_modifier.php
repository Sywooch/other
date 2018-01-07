<?
	if(intval($arParams["OFFER_ID"]))
	{
		foreach($arResult["OFFERS"] as $key=>$offer)
		{
			if($offer["ID"]==intval($arParams["OFFER_ID"]))
			{			
				if( !empty($offer["PREVIEW_PICTURE"]) )
				{
					$img_preview = CFile::ResizeImageGet( $offer["PREVIEW_PICTURE"], array( "width" => 170, "height" => 170 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
					foreach ($img_preview as $field_name => $field) { $arResult["PREVIEW_PICTURE"][strtoupper($field_name)] = $field; }
				}
				elseif( !empty($offer["DETAIL_PICTURE"]) )
				{
					$img_preview = CFile::ResizeImageGet( $offer["DETAIL_PICTURE"], array( "width" => 170, "height" => 170 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
					foreach ($img_preview as $field_name => $field) { $arResult["PREVIEW_PICTURE"][strtoupper($field_name)] = $field; }
				}
			
				foreach ($offer["PRICES"] as $key=>$price){ $curPrice=$price["VALUE"]; break; }
				foreach ($offer["PRICES"] as $key=>$price)
				{	
					if ($curPrice>$price["VALUE"]) 	{ $curPrice = $price["VALUE"]; $priceId = $key; }
				}
				unset($arResult["PRICES"]);
				$arResult["PRICES"][] = $offer["PRICES"][$key];				
			}
		}
	}
?>