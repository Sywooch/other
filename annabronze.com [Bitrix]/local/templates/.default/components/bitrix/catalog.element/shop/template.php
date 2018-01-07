<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
	if (($arParams["SHOW_MEASURE"]=="Y")&&($arResult["CATALOG_MEASURE"]))
	{ $arMeasure = CCatalogMeasure::getList(array(), array("ID"=>$arResult["CATALOG_MEASURE"]), false, false, array())->GetNext(); }	
?>


<?


$this->SetViewTarget('social');
/*
if (!empty($arResult["IMAGE"])):
	$previewPicture = $arResult["IMAGE"];
else:
	$previewPicture = "http://" . $_SERVER["HTTP_HOST"] . $arResult["PREVIEW_PICTURE"]["src"];
endif;
*/
//ob_start();

$previewPictureSocial = "";


if(!empty($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PREVIEW_PICTURE"])) {
	$PREVIEW_PICTURE=CFile::GetFileArray($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PREVIEW_PICTURE"]["ID"]);
	$previewPictureSocial = $PREVIEW_PICTURE['SRC'];

}else if(!empty($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["DETAIL_PICTURE"])) {
	$PREVIEW_PICTURE=CFile::GetFileArray($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["DETAIL_PICTURE"]["ID"]);
	$previewPictureSocial = $PREVIEW_PICTURE['SRC'];

}else if(!empty($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PROPERTIES"]["MORE_PHOTO"]["VALUE"][0])) {
	$PREVIEW_PICTURE=CFile::GetFileArray($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PROPERTIES"]["MORE_PHOTO"]["VALUE"][0]);
	$previewPictureSocial = $PREVIEW_PICTURE['SRC'];

}

$protocol = (CMain::IsHTTPS()) ? "https://" : "http://";
if(!empty($previewPictureSocial)){

	$previewPictureSocial=$protocol.$_SERVER["HTTP_HOST"].$previewPictureSocial;
}


if (!empty($arResult["DETAIL_TEXT"])):
	$previewTextSocial = $arResult["DETAIL_TEXT"];
else:
	$previewTextSocial = $arResult["PREVIEW_TEXT"];
endif;


$previewTextSocial=TruncateText($previewTextSocial);
$previewTextSocial=strip_tags($previewTextSocial);
$previewTextSocial = preg_replace("/(\r\n)+/i", "\r\n", $previewTextSocial);
$previewTextSocial = str_replace(array("\r","\n"),"",$previewTextSocial);
//echo $previewTextSocial."==";

echo '
<meta property="og:type" content="article"/>
<meta property="og:title" content="'.$arResult['NAME'].'"/>
<meta property="og:url" content="https://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"].'"/>
<meta property="og:description"
     content="    '.TruncateText($previewTextSocial).'"/>
<meta property="og:image" content="'.$previewPictureSocial.'"/>

<meta itemprop="name" content="'.$arResult['NAME'].'"/>
<meta itemprop="description"
     content="'.TruncateText($previewTextSocial).'"/>
<meta itemprop="image" content="'.$previewPictureSocial.'"/>

<meta name="twitter:card" content="summary"/>  <!-- Тип окна -->
<meta name="twitter:site" content=""/>
<meta name="twitter:title" content="'.$arResult['NAME'].'">
<meta name="twitter:description"
     content="    '.TruncateText($previewTextSocial).'"/>
<meta name="twitter:image:src" content="'.$previewPictureSocial.'"/>
<meta name="twitter:domain" content="'.$_SERVER["HTTP_HOST"].'"/>
';

//$out1 = ob_get_contents();
//ob_end_clean();

$this->EndViewTarget();


if(!isset($_GET["offer"]) || (empty($_GET["offer"]))){


	$mxResult = CCatalogSKU::GetInfoByProductIBlock(
		$arResult["IBLOCK_ID"]
	);

	if(CCatalogSKU::IsExistOffers($arResult["ID"], $arResult["IBLOCK_ID"]))
	{
		$rsOffers = CIBlockElement::GetList(array("CATALOG_PRICE_1"=>"ASC"),
			array('ACTIVE' => "Y", 'IBLOCK_ID' => $mxResult['IBLOCK_ID'], 'PROPERTY_'.$mxResult['SKU_PROPERTY_ID'] => $arResult["ID"]));
		unset($arTmpOffers);
		while ($arOffer = $rsOffers->GetNext()) {
			$arTmpOffers[] = $arOffer["ID"];
		}

		$arResult["ACTIVE_OFFER_NUMBER"]=mt_rand(0, count($arTmpOffers)-1);

		//$arResult["ACTIVE_OFFER_NUMBER"] = $arTmpOffers[$randomOffer];

	}
}

?>

<div class="b-product-card">
	<div class="b-product-card__wrapper">

		<?
		$inBasket = Helper::isProductBasket($_GET["offer"]);
		?>

		<div class="b-product-card__left js-product-card__left">

			<!-- block for mobile screen -->
			<div class="b-product-card__mobile-title">
				<?=$arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["NAME"];?>
			</div>
			<div class="b-product-card__mobile-article">
				<?=GetMessage("ARTICLE");?> <?
				if(!empty($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PROPERTIES"]["CML2_ARTICLE"]["VALUE"])) {
					//достаём артикул из торгового предложения
					echo $arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PROPERTIES"]["CML2_ARTICLE"]["VALUE"];

				}else if(!empty($arResult["PROPERTIES"]["CML2_ARTICLE"]["VALUE"])){
					//достаём из товара
					echo $arResult["PROPERTIES"]["CML2_ARTICLE"]["VALUE"];
				}else{
					echo $arResult["PROPERTIES"]["CML2_ARTICLE2"]["VALUE"];
				}?>

			</div>

			<!-- end block for mobile screen -->
			<?
				$isMorePhoto = false;
				foreach($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $more){
					if($more) $isMorePhoto = true;
				}

			?>
			<?if(!empty($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PREVIEW_PICTURE"]) ||
			!empty($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["DETAIL_PICTURE"]) ||
				$isMorePhoto
			):?>
			
				<div class="b-card-mob-gallery js-swiper-full" data-loop="1" data-time="3000">
					<div class="swiper-container">
						<div class="swiper-wrapper b-main-slider__wrapper">
	
							<?
	
							if(!empty($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PREVIEW_PICTURE"])) {
							$PREVIEW_PICTURE=CFile::GetFileArray($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PREVIEW_PICTURE"]["ID"]);
							$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 250, "height" => 250), BX_RESIZE_IMAGE_EXACT);
	
							?>
								<div class="swiper-slide tmp6">
									<div class="b-card-mob-gallery__item" style="background-image: url(<?=$renderImage['src'];?>)"></div>
								</div>
							<?
							}else if(!empty($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["DETAIL_PICTURE"])) {
	
	
							$PREVIEW_PICTURE=CFile::GetFileArray($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["DETAIL_PICTURE"]["ID"]);
							$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 250, "height" => 250), BX_RESIZE_IMAGE_EXACT);
	
							?>
								<div class="swiper-slide tmp7">
									<div class="b-card-mob-gallery__item" style="background-image: url(<?=$renderImage['src'];?>)"></div>
								</div>
							<?
							}
							?>
	
							<?
							for($i=0; $i<count($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PROPERTIES"]["MORE_PHOTO"]["VALUE"]); $i++) {
							$PREVIEW_PICTURE=CFile::GetFileArray($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PROPERTIES"]["MORE_PHOTO"]["VALUE"][$i]);
							$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 250, "height" => 250), BX_RESIZE_IMAGE_EXACT);
	
							?>
							<div class="swiper-slide tmp8">
								<div class="b-card-mob-gallery__item" style="background-image: url(<?=$renderImage['src'];?>)"></div>
							</div>
							<?
							}
							?>
	
						</div>
	
						<div class="js-swiper-button-prev b-main-slider__prev _only-middle"></div>
						<div class="js-swiper-button-next b-main-slider__next _only-middle"></div>
					</div>
	
				</div>
			<?endif?>

			<div class="b-card-gallery js-card-gallery">
				<!-- боковой блок -->
				<?

				$PREVIEW_PICTURE="";
				if(!empty($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PREVIEW_PICTURE"])) {
					$PREVIEW_PICTURE=CFile::GetFileArray($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PREVIEW_PICTURE"]["ID"]);
					$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 70, "height" => 70), BX_RESIZE_IMAGE_EXACT);
					$renderImagePreview = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 467, "height" => 454), BX_RESIZE_IMAGE_EXACT);


				}else if(!empty($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["DETAIL_PICTURE"])) {

					$PREVIEW_PICTURE=CFile::GetFileArray($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["DETAIL_PICTURE"]["ID"]);

					$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 70, "height" => 70), BX_RESIZE_IMAGE_EXACT);
					$renderImagePreview = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 467, "height" => 454), BX_RESIZE_IMAGE_EXACT);


				}else if(!empty($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PROPERTIES"]["MORE_PHOTO"]["VALUE"][0])){
					$PREVIEW_PICTURE=CFile::GetFileArray($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PROPERTIES"]["MORE_PHOTO"]["VALUE"][0]);
					$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 70, "height" => 70), BX_RESIZE_IMAGE_EXACT);
					$renderImagePreview = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 467, "height" => 454), BX_RESIZE_IMAGE_EXACT);

				}

				if(!empty($PREVIEW_PICTURE)) {
					?>

					<div class="b-card-gallery__pager js-gallery-pager-swiper">
						<!-- Обращу внимание, тут создается 3 копии разных размеров для каждой картинки. Мини - для превью в левой колонке
                            preview-src - превью для блока справа
                            full-src - полный размер
                         -->
						<a href="#" class="b-card-gallery__pager-prev js-gallery-pager-prev"></a>
						<a href="#" class="b-card-gallery__pager-next js-gallery-pager-next"></a>
						<div class="swiper-container">
							<div class="swiper-wrapper tmp2">


								<?
								if (!empty($PREVIEW_PICTURE)) {
									?>
									<div class="swiper-slide tmp1">
										<div class="b-card-gallery__pager-item _current"
											 style="background-image: url(<?= $renderImage['src']; ?>)"
											 data-preview-src="<?= $renderImagePreview['src']; ?>"
											 data-full-src="<?= $PREVIEW_PICTURE["SRC"]; ?>"></div>
									</div>
									<?
								}
								?>


								<?
								for ($i = 0; $i < count($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PROPERTIES"]["MORE_PHOTO"]["VALUE"]); $i++) {

									$PREVIEW_PICTURE = CFile::GetFileArray($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PROPERTIES"]["MORE_PHOTO"]["VALUE"][$i]);
									$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 70, "height" => 70), BX_RESIZE_IMAGE_EXACT);
									$renderImagePreview = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 467, "height" => 454), BX_RESIZE_IMAGE_EXACT);
									if(!empty($renderImage['src'])){
									?>
									<div class="swiper-slide tmp9">
										<div class="b-card-gallery__pager-item "
											 style="background-image: url(<?= $renderImage['src']; ?>)"
											 data-preview-src="<?= $renderImagePreview['src']; ?>"
											 data-full-src="<?= $PREVIEW_PICTURE["SRC"]; ?>"></div>
									</div>
									<?
									}
								}
								?>
							</div>
						</div>
					</div>

					<?
				}
				?>

				<!-- боковой блок -->
				<?
				if(!empty($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PREVIEW_PICTURE"])) {
					$PREVIEW_PICTURE=CFile::GetFileArray($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PREVIEW_PICTURE"]["ID"]);
					$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 467, "height" => 454), BX_RESIZE_IMAGE_EXACT);

				}else if(!empty($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["DETAIL_PICTURE"])) {
					$PREVIEW_PICTURE=CFile::GetFileArray($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["DETAIL_PICTURE"]["ID"]);
					$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 467, "height" => 454), BX_RESIZE_IMAGE_EXACT);
				}else{
					$PREVIEW_PICTURE=CFile::GetFileArray($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PROPERTIES"]["MORE_PHOTO"]["VALUE"][0]);
					$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 467, "height" => 454), BX_RESIZE_IMAGE_EXACT);
				}
				$tmpStyle = "";
				if(empty($PREVIEW_PICTURE)){
					//ставим заглушку, если картинок нет вообще
					$PREVIEW_PICTURE["SRC"] = BX_DEFAULT_NO_PHOTO_IMAGE;
					$renderImage["src"] = BX_DEFAULT_NO_PHOTO_IMAGE;
					//$tmpStyle = "float:left;";
					echo "<style>
					.b-product-card__wrapper .b-card-gallery__img:after{display:none !important;}
					</style>";
				}
				?>

				<div class="b-card-gallery__img js-gallery-img" 
					 style="<? /*echo $tmpStyle;*/ ?> background-image: url(<?=$renderImage['src'];?>)">

				<a href="<?=$PREVIEW_PICTURE["SRC"];?>" class="b-card-gallery__img-link js-gallery-img-link js-gallery-fancybox"
				   rel="product-gallery"></a>

					<?
					if(!empty($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PREVIEW_PICTURE"])) {
						$PREVIEW_PICTURE=CFile::GetFileArray($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["DETAIL_PICTURE"]["ID"]);
						$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 467, "height" => 454), BX_RESIZE_IMAGE_EXACT);

						?>

						<a href="<?=$PREVIEW_PICTURE['SRC'];?>"
						   class="b-card-gallery__img-hidden js-gallery-fancybox" rel="product-gallery"></a>
						<?
					}else if(!empty($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["DETAIL_PICTURE"])) {

						$PREVIEW_PICTURE=CFile::GetFileArray($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["DETAIL_PICTURE"]["ID"]);
						$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 467, "height" => 454), BX_RESIZE_IMAGE_EXACT);
						?>

						<a href="<?=$PREVIEW_PICTURE['SRC'];?>"
						   class="b-card-gallery__img-hidden js-gallery-fancybox" rel="product-gallery"></a>
						<?
					}else{
						$PREVIEW_PICTURE=CFile::GetFileArray($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PROPERTIES"]["MORE_PHOTO"]["VALUE"][0]);
						$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 467, "height" => 454), BX_RESIZE_IMAGE_EXACT);

						if(empty($PREVIEW_PICTURE)){
							//ставим заглушку, если картинок нет вообще
							$PREVIEW_PICTURE["SRC"] = BX_DEFAULT_NO_PHOTO_IMAGE;
							$renderImage["src"] = BX_DEFAULT_NO_PHOTO_IMAGE;

						}

						?>
						<a href="<?=$PREVIEW_PICTURE['SRC'];?>"
						   class="b-card-gallery__img-hidden js-gallery-fancybox" rel="product-gallery"></a>
						<?
					}
					?>

					<?
					for($i=0; $i<count($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PROPERTIES"]["MORE_PHOTO"]["VALUE"]); $i++) {
						$PREVIEW_PICTURE=CFile::GetFileArray($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PROPERTIES"]["MORE_PHOTO"]["VALUE"][$i]);
						$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 467, "height" => 454), BX_RESIZE_IMAGE_EXACT);
						?>
						<a href="<?=$PREVIEW_PICTURE['SRC'];?>" class="b-card-gallery__img-hidden js-gallery-fancybox"
						   rel="product-gallery"></a>
						<?
					}
					?>
				</div>

			</div>

		</div>


		<!------------ offers images -------------->
		<div style="display:none; width:50%;">
		<?
		foreach ($arResult["OFFERS"] as $k => $v) {
		?>



		<div class="b-product-card__left" id="offer-images_<?=$v['ID'];?>"
			style="display:block;">

			<!-- block for mobile screen -->
			<div class="b-product-card__mobile-title">
				<?=$v["NAME"];?>
			</div>
			<div class="b-product-card__mobile-article">
				<?=GetMessage("ARTICLE");?> <?
				if(!empty($v["PROPERTIES"]["CML2_ARTICLE"]["VALUE"])) {
					//достаём артикул из торгового предложения
					echo $v["PROPERTIES"]["CML2_ARTICLE"]["VALUE"];

				}else if(!empty($arResult["PROPERTIES"]["CML2_ARTICLE"]["VALUE"])){
					//достаём из товара
					echo $arResult["PROPERTIES"]["CML2_ARTICLE"]["VALUE"];
				}else{
					echo $arResult["PROPERTIES"]["CML2_ARTICLE2"]["VALUE"];
				}?>

			</div>



			<!-- end block for mobile screen -->
			<div class="b-card-mob-gallery js-swiper-full" data-loop="1" data-time="3000">
				<div class="swiper-container">
					<div class="swiper-wrapper b-main-slider__wrapper">

						<?
						if(!empty($v["PREVIEW_PICTURE"])) {
							$PREVIEW_PICTURE=CFile::GetFileArray($v["PREVIEW_PICTURE"]["ID"]);
							$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 250, "height" => 250), BX_RESIZE_IMAGE_EXACT);

							?>
							<div class="swiper-slide ">
								<div class="b-card-mob-gallery__item"
									 style="background-image: url()"
										data-image="<?=$renderImage['src'];?>"></div>
							</div>
							<?
						}else if(!empty($v["DETAIL_PICTURE"])) {
							$PREVIEW_PICTURE=CFile::GetFileArray($v["DETAIL_PICTURE"]["ID"]);
							$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 250, "height" => 250), BX_RESIZE_IMAGE_EXACT);

							?>
							<div class="swiper-slide ">
								<div class="b-card-mob-gallery__item"
									 style="background-image: url()"
									 data-image="<?=$renderImage['src'];?>"></div>
							</div>
							<?
						}
						?>


						<?
						for($i=0; $i<count($v["PROPERTIES"]["MORE_PHOTO"]["VALUE"]); $i++) {
							$PREVIEW_PICTURE=CFile::GetFileArray($v["PROPERTIES"]["MORE_PHOTO"]["VALUE"][$i]);
							$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 250, "height" => 250), BX_RESIZE_IMAGE_EXACT);

							?>
							<div class="swiper-slide ">
								<div class="b-card-mob-gallery__item" style="background-image: url()"
									 data-image="<?=$renderImage['src'];?>"></div>
							</div>
							<?
						}
						?>

					</div>

					<div class="js-swiper-button-prev b-main-slider__prev _only-middle"></div>
					<div class="js-swiper-button-next b-main-slider__next _only-middle"></div>
				</div>

			</div>

			<div class="b-card-gallery js-card-gallery">



				<?
				$PREVIEW_PICTURE = "";
				if(!empty($v["PREVIEW_PICTURE"])) {
					$PREVIEW_PICTURE=CFile::GetFileArray($v["PREVIEW_PICTURE"]["ID"]);
					$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 70, "height" => 70), BX_RESIZE_IMAGE_EXACT);
					$renderImagePreview = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 467, "height" => 454), BX_RESIZE_IMAGE_EXACT);

				}else if(!empty($v["DETAIL_PICTURE"])) {
					$PREVIEW_PICTURE=CFile::GetFileArray($v["DETAIL_PICTURE"]["ID"]);
					$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 70, "height" => 70), BX_RESIZE_IMAGE_EXACT);
					$renderImagePreview = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 467, "height" => 454), BX_RESIZE_IMAGE_EXACT);

				}else if(!empty($v["PROPERTIES"]["MORE_PHOTO"]["VALUE"][0])){
					$PREVIEW_PICTURE=CFile::GetFileArray($v["PROPERTIES"]["MORE_PHOTO"]["VALUE"][0]);
					$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 70, "height" => 70), BX_RESIZE_IMAGE_EXACT);
					$renderImagePreview = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 467, "height" => 454), BX_RESIZE_IMAGE_EXACT);



				}

				if(!empty($PREVIEW_PICTURE)) {


					?>


					<div class="b-card-gallery__pager js-gallery-pager-swiper">
						<!-- Обращу внимание, тут создается 3 копии разных размеров для каждой картинки. Мини - для превью в левой колонке
                            preview-src - превью для блока справа
                            full-src - полный размер
                         -->
						<a href="#" class="b-card-gallery__pager-prev js-gallery-pager-prev"></a>
						<a href="#" class="b-card-gallery__pager-next js-gallery-pager-next"></a>
						<div class="swiper-container">
							<div class="swiper-wrapper tmp1">


								<?
								if (!empty($PREVIEW_PICTURE)) {
									?>
									<div class="swiper-slide tmp4">
										<div class="b-card-gallery__pager-item _current"
											 style="background-image: url()"
											 data-preview-src="<?= $renderImagePreview['src']; ?>"
											 data-full-src="<?= $PREVIEW_PICTURE["SRC"]; ?>"
											 data-image="<?= $renderImage['src']; ?>"></div>
									</div>
									<?
								}
								?>

								<?
								for ($i = 0; $i < count($v["PROPERTIES"]["MORE_PHOTO"]["VALUE"]); $i++) {
									$PREVIEW_PICTURE = CFile::GetFileArray($v["PROPERTIES"]["MORE_PHOTO"]["VALUE"][$i]);
									$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 70, "height" => 70), BX_RESIZE_IMAGE_EXACT);
									$renderImagePreview = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 467, "height" => 454), BX_RESIZE_IMAGE_EXACT);
									if(!empty($renderImage['src'])){
									?>
									<div class="swiper-slide tmp5">
										<div class="b-card-gallery__pager-item " style="background-image: url()"
											 data-preview-src="<?= $renderImagePreview['src']; ?>"
											 data-full-src="<?= $PREVIEW_PICTURE["SRC"]; ?>"
											 data-image="<?= $renderImage['src']; ?>"></div>
									</div>
									<?
									}
								}
								?>


							</div>
						</div>


					</div>


					<?
				}
				?>






				<?
				if(!empty($v["PREVIEW_PICTURE"])) {
					$PREVIEW_PICTURE=CFile::GetFileArray($v["PREVIEW_PICTURE"]["ID"]);
					$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 467, "height" => 454), BX_RESIZE_IMAGE_EXACT);

				}else if(!empty($v["DETAIL_PICTURE"])) {
					$PREVIEW_PICTURE=CFile::GetFileArray($v["DETAIL_PICTURE"]["ID"]);
					$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 467, "height" => 454), BX_RESIZE_IMAGE_EXACT);
				}else if(!empty($v["PROPERTIES"]["MORE_PHOTO"]["VALUE"][0])){
					$PREVIEW_PICTURE=CFile::GetFileArray($v["PROPERTIES"]["MORE_PHOTO"]["VALUE"][0]);
					$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 467, "height" => 454), BX_RESIZE_IMAGE_EXACT);



				}

				$tmpStyle = "";
				if(empty($PREVIEW_PICTURE)){

					//ставим заглушку, если картинок нет вообще
					$PREVIEW_PICTURE["SRC"] = BX_DEFAULT_NO_PHOTO_IMAGE;
					$renderImage["src"] = BX_DEFAULT_NO_PHOTO_IMAGE;
					//$tmpStyle = "float:left;";
					echo "<style>
					#offer-images_".$v['ID']." .b-card-gallery__img:after{display:none !important;}
					.gallery-img_".$v['ID'].":after{display:none !important;}

					</style>";


				}
				?>


				<div class="b-card-gallery__img js-gallery-img gallery-img_<?=$v['ID'];?>"
					 style="<?  /*echo $tmpStyle;*/ ?> background-image: url()"
					 data-image="<?=$renderImage['src'];?>"
						>



					<a href="<?=$PREVIEW_PICTURE["SRC"];?>" class="b-card-gallery__img-link js-gallery-img-link js-gallery-fancybox"
					   rel="product-gallery"></a>



					<?
					if(!empty($v["PREVIEW_PICTURE"])) {
						$PREVIEW_PICTURE=CFile::GetFileArray($v["PREVIEW_PICTURE"]["ID"]);
						$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 467, "height" => 454), BX_RESIZE_IMAGE_EXACT);

						?>

						<a href="<?=$PREVIEW_PICTURE['SRC'];?>"
						   class="b-card-gallery__img-hidden js-gallery-fancybox" rel="product-gallery"></a>
						<?
					}else if(!empty($v["DETAIL_PICTURE"])) {

						$PREVIEW_PICTURE=CFile::GetFileArray($v["DETAIL_PICTURE"]["ID"]);
						$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 467, "height" => 454), BX_RESIZE_IMAGE_EXACT);
						?>

						<a href="<?=$PREVIEW_PICTURE['SRC'];?>"
						   class="b-card-gallery__img-hidden js-gallery-fancybox" rel="product-gallery"></a>
						<?
					}else{
						$PREVIEW_PICTURE=CFile::GetFileArray($v["PROPERTIES"]["MORE_PHOTO"]["VALUE"][0]);
						$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 467, "height" => 454), BX_RESIZE_IMAGE_EXACT);

						if(empty($PREVIEW_PICTURE)){
							//ставим заглушку, если картинок нет вообще
							$PREVIEW_PICTURE["SRC"] = BX_DEFAULT_NO_PHOTO_IMAGE;
							$renderImage["src"] = BX_DEFAULT_NO_PHOTO_IMAGE;
						}

						?>
						<a href="<?=$PREVIEW_PICTURE['SRC'];?>"
						   class="b-card-gallery__img-hidden js-gallery-fancybox" rel="product-gallery"></a>
						<?
					}
					?>




					<?
					for($i=0; $i<count($v["PROPERTIES"]["MORE_PHOTO"]["VALUE"]); $i++) {
						$PREVIEW_PICTURE=CFile::GetFileArray($v["PROPERTIES"]["MORE_PHOTO"]["VALUE"][$i]);
						$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 467, "height" => 454), BX_RESIZE_IMAGE_EXACT);
						?>
						<a href="<?=$PREVIEW_PICTURE['SRC'];?>" class="b-card-gallery__img-hidden js-gallery-fancybox"
						   rel="product-gallery"></a>
						<?
					}
					?>



				</div>

			</div>

		</div>
		<?
		}
		?>
		</div>
		<!------------ offers images -------------->



		<div class="b-product-card__right">
			<div class="b-product-card__title js-product-card__title">
				<?=$arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["NAME"];?>
			</div>
			<div class="b-product-card__article js-product-card__article">
				<?=GetMessage("ARTICLE");?> <span><?
				if(!empty($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PROPERTIES"]["CML2_ARTICLE"]["VALUE"])) {
					//достаём артикул из торгового предложения
					echo $arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PROPERTIES"]["CML2_ARTICLE"]["VALUE"];

				}else if(!empty($arResult["PROPERTIES"]["CML2_ARTICLE"]["VALUE"])){
				//достаём из товара
					echo $arResult["PROPERTIES"]["CML2_ARTICLE"]["VALUE"];
				}else{
					echo $arResult["PROPERTIES"]["CML2_ARTICLE2"]["VALUE"];
				}

				?></span>
			</div>
			<div class="b-product-card__right-inner">
				<div class="b-product-card__prices _small-margin">
					<div class="b-product-card__prices-inner" style="display: inline-flex">
						<div class="b-product-card__prices-price js-product-card__prices-price">
							<?=$arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PRICES"]["BASE"]["PRINT_VALUE"];?>
						</div>
						<div class="b-product-card__prices-counter">
							<div class="b-counter  js-product-counter"
								 data-maxcount="<?=$arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["CATALOG_QUANTITY"];?>"
								 element_id="#<?=$arResult["ID"];?>">
								<div class="b-counter__plus <? if($inBasket == "Y"){ echo 'disabled'; }; ?>">+</div>
								<div class="b-counter__minus <? if($inBasket == "Y"){ echo 'disabled'; }; ?>">-</div>
								<input class="b-counter__input" value="<?
								if($inBasket == "Y"){
									echo (int)Helper::productQuantityBasket($_GET["offer"]);
								}else{
									echo "1";
								} ?>" name="count_items"
									   <?
									   if($inBasket == "Y"){ echo 'disabled="disabled"'; };
									   ?>
									   >
							</div>



						</div>
					</div>
				</div>

				<div class="b-product-card__terms">
					<a href="<?=BX_LINK_HELP_DELIVERY;?>"><?=GetMessage("TERMS");?></a>
				</div>




				<div class="b-colors js-product-list-card-colors b-product-card__colors _small-margin">

					<div class="b-colors__title"><?=GetMessage("POPUP_SELECT_COLOR");?>:</div>
					<div class="b-colors__container js-colors__container">
						<div class="b-colors js-product-list-card-colors">

							<?

							
							foreach ($arResult["OFFERS"] as $k => $v){

								?>
								<div class="b-colors__item _color-<?=$v["COLOR_INDEX"];?> <? if($arResult["ACTIVE_OFFER_NUMBER"]==$k){ echo "_current"; } ?>"
									 data-color-index="<?=$v["COLOR_INDEX"];?>" data-id="<?=$k;?>"
									 title="<?=$v["COLOR_NAME"];?>"><i></i></div>
								<?
							}
							?>

						</div>
					</div>

				</div>

				<?
				foreach ($arResult["OFFERS"] as $k => $v) {
					?>


					<input type="hidden" class="js-offer" id="offer_<?=$v["ID"];?>"
						   data-id="<?=$k;?>"
						   data-name="<?=$v["NAME"];?>"
						   data-price-print="<?=$v["PRICES"]["BASE"]["PRINT_VALUE"];?>"

						   data-quantity="<?=$v["CATALOG_QUANTITY"];?> <?=$v["CATALOG_MEASURE_NAME"];?>"
						   data-offer-id="<?=$v["ID"];?>"
						   data-in-basket="<?
						   echo Helper::isProductBasket($v["ID"]);
						   ?>"
						   data-quantity-in-basket="<?
						   echo Helper::productQuantityBasket($v["ID"]);
						   ?>"


						   data-article="<?
						   if(!empty($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PROPERTIES"]["CML2_ARTICLE"]["VALUE"])) {
							   //достаём артикул из торгового предложения
							   echo $arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PROPERTIES"]["CML2_ARTICLE"]["VALUE"];

						   }else if(!empty($arResult["PROPERTIES"]["CML2_ARTICLE"]["VALUE"])){
							   //достаём из товара
							   echo $arResult["PROPERTIES"]["CML2_ARTICLE"]["VALUE"];
						   }else{
							   echo $arResult["PROPERTIES"]["CML2_ARTICLE2"]["VALUE"];
						   }

						   ?>"

					/>



					<div class="hidden-product-card-params"
						 id="offer-params_<?=$v["ID"];?>" style="display:none;">
						<?
						$count=count($v["PROPERTIES"]["CML2_ATTRIBUTES"]);
						for($i=0; $i<$count; $i++){
							?>

							<b><?=$v["PROPERTIES"]["CML2_ATTRIBUTES"][$i]["DESCRIPTION"];?>:</b> 
							<?=$v["PROPERTIES"]["CML2_ATTRIBUTES"][$i]["VALUE"];?><br>


							<?
						}
						?>
					</div>

					<?
				}
				?>



				<div class="b-product-card__stock js-product-card__stock">
					<?=GetMessage("POPUP_IN_STOCK");?>: <b>

						<?=$arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["CATALOG_QUANTITY"];?> <?=$arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["CATALOG_MEASURE_NAME"];?></b>

					<br>
					<div class="b-product-card__stock-message js-product-card__stock-message" style="display:<?
					if($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["CATALOG_QUANTITY"] < 1){ echo "block"; }
					else{ echo "none"; }
					?>">
						<?=GetMessage("POPUP_IN_STOCK_MESSAGE");?>
					</div>
				</div>

				<input type="hidden" id="offer_id" data-id="<?=$_GET['offer'];?>"/>
				<div class="b-product-card__btn">
					<? if($inBasket == "N"){ ?>
					<a href="#" class="btn _full js-add-ro-cart add"><?=GetMessage("POPUP_ADD_TO_CART");?> </a>
					<a href="<? if(LANGUAGE_ID==='en'){ echo "/en"; } ?>/basket/" style="display:none;"
					   class="btn _full disabled buttonAdded"><?=GetMessage("POPUP_ADDED_TO_CART");?> </a>
						<!-- added -->
					<? }else{ ?>
					<a href="#" class="btn _full js-add-ro-cart add" style="display:none;"><?=GetMessage("POPUP_ADD_TO_CART");?> </a>
					<a href="<? if(LANGUAGE_ID==='en'){ echo "/en"; } ?>/basket/"
					   class="btn _full disabled buttonAdded"><?=GetMessage("POPUP_ADDED_TO_CART");?> </a>
						<!-- added -->
					<? }; ?>
				</div>




			</div>
			<div class="b-product-card__params">



				<?

				$count=count($arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PROPERTIES"]["CML2_ATTRIBUTES"]);


				for($i=0; $i<$count; $i++){
				?>

				<b><?=$arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PROPERTIES"]["CML2_ATTRIBUTES"][$i]["DESCRIPTION"];?>:</b>
					<?=$arResult["OFFERS"][$arResult["ACTIVE_OFFER_NUMBER"]]["PROPERTIES"]["CML2_ATTRIBUTES"][$i]["VALUE"];?><br>


				<?
				}
				?>





			</div>

			<div class="b-product-card__preview">
				<?=$arResult["PREVIEW_TEXT"];?>
			</div>
		</div>
	</div>

	<div class="b-product-card__description grid-container b-layout__info-box">
		<div class="grid-row col-1 col-s-12"></div>
		<div class="grid-row col-10 col-s-12">
			<p><?=$arResult["DETAIL_TEXT"];?></p>

			<p>
				<?
				$rsStock = CIBlockElement::GetList(array(), array("ACTIVE" => "Y", "IBLOCK_ID" => $arParams["IBLOCK_STOCK_ID"], "PROPERTY_LINK" => $arResult["ID"]));

				if (count($arResult["LINKED_ELEMENTS"])>0):?>
					<?=GetMessage("THIS_ELEMENT_USED_HERE");?><br>

				<?if(count($arResult["LINKED_ELEMENTS"])>0):?>

				<?foreach($arResult["LINKED_ELEMENTS"] as $arElement):?>
							<?
							$res = CIBlockSection::GetByID($arElement["IBLOCK_SECTION_ID"]);
							if($ar_res = $res->GetNext()){
								$SECTION_PAGE_URL = $ar_res["SECTION_PAGE_URL"];
							}
							?>


					<a href="<?=$SECTION_PAGE_URL;?>?gallery=<?=$arElement["ID"]?>"><?=$arElement["NAME"]?></a><br>
				<?endforeach;?>
				<?endif?>

				<?endif;?>
			</p>

			<div class="b-product-card__share">
				<div class="b-product-card__share-title"><?=GetMessage("SOCIAL_SHARE");?></div>
				<div class="b-product-card__share-br"></div>

				<? $APPLICATION->IncludeComponent(
					"ad_shop:sharebuttons",
					".default",
					Array(
						"URL_TO_LIKE" => "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"],
						"TITLE" => $arResult["NAME"],
						"DESCRIPTION" => $previewTextSocial,
						"IMAGE" => $previewPictureSocial,
						"FB_USE" => "Y",
						"TW_USE" => "Y",
						"GP_USE" => "N",
						"VK_USE" => "Y",
						"PI_USE" => "Y",
						"OK_USE" => "N",
						"MAILRU_USE" => "N",
						"LJ_USE" => "N",
						"OFFERS" => $arResult["OFFERS"],
                        "COMPONENT_TEMPLATE" => ".default",
                        "COMPOSITE_FRAME_MODE" => "A",
                        "COMPOSITE_FRAME_TYPE" => "AUTO"
					),
                    false
				); ?>
			</div>
		</div>
	</div>

	<?if ($arParams["USE_REVIEW"]=="Y"):?>

			<?$APPLICATION->IncludeComponent(
				"bitrix:forum.topic.reviews",
				"custom1",//element_reviews  .default
				Array(
					"CACHE_TYPE" => "N",
					"CACHE_TIME" => $arParams["CACHE_TIME"],
					"MESSAGES_PER_PAGE" => $arParams["MESSAGES_PER_PAGE"],
					"USE_CAPTCHA" => $arParams["USE_CAPTCHA"],
					"FORUM_ID" => $arParams["FORUM_ID"],
					"ELEMENT_ID" => $arResult["ID"],
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],
					"AJAX_POST" => "Y",
					//'AJAX_MODE' => 'Y',
					"SHOW_RATING" => "N",
					"SHOW_MINIMIZED" => "Y",
					"SECTION_REVIEW" => "Y",
					"POST_FIRST_MESSAGE" => "Y",
					"MINIMIZED_MINIMIZE_TEXT" => GetMessage("HIDE_FORM"),
					"MINIMIZED_EXPAND_TEXT" => GetMessage("ADD_REVIEW"),
					"SHOW_AVATAR" => "N",
					"SHOW_LINK_TO_FORUM" => "N",
					"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
				),	false
			);?>
	<?endif;?>
<?if( !empty($arResult["PROPERTIES"]["ASSOCIATED"]["VALUE"]) ){?>
<div class="b-product-card__recommends">
	<div class="b-title js-content-title _no-marg">
		<div class="b-title__row _title">
			<div class="b-title__title"><?=GetMessage("YOU_MAY_ALSO");?></div>
		</div>
	</div>

	<div class="b-catalog-list">
			<?$GLOBALS['arrFilterAssociated'] = array( "ID" => $arResult["PROPERTIES"]["ASSOCIATED"]["VALUE"] );
			$APPLICATION->IncludeComponent(
				"ad_shop:catalog.section",//"bitrix:catalog.section",
				"shop_table_preview",
				Array(
					"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],
					"SECTION_ID" => 0,
					"SECTION_CODE" => "",
					"ELEMENT_SORT_FIELD" => "sort",
					"ELEMENT_SORT_ORDER" => "asc",
					"FILTER_NAME" => "arrFilterAssociated",
					"INCLUDE_SUBSECTIONS" => "Y",
					"SHOW_ALL_WO_SECTION" => "Y",
					"PAGE_ELEMENT_COUNT" => "99999",
					"LINE_ELEMENT_COUNT" => 4,
					"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
					"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
					"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
					"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
					"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
					"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
					"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
					"BASKET_URL" => $arParams["BASKET_URL"],
					"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
					"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
					"PRODUCT_QUANTITY_VARIABLE" => "quantity",
					"PRODUCT_PROPS_VARIABLE" => "prop",
					"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
					"AJAX_MODE" => $arParams["AJAX_MODE"],
					"AJAX_OPTION_JUMP" => $arParams["AJAX_OPTION_JUMP"],
					"AJAX_OPTION_STYLE" => $arParams["AJAX_OPTION_STYLE"],
					"AJAX_OPTION_HISTORY" => $arParams["AJAX_OPTION_HISTORY"],
					"CACHE_TYPE" =>$arParams["CACHE_TYPE"],
					"CACHE_TIME" => $arParams["CACHE_TIME"],
					"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
					"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
					"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
					"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
					"ADD_SECTIONS_CHAIN" => "N",
					"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
					"SET_TITLE" => $arParams["SET_TITLE"],
					"SET_STATUS_404" => $arParams["SET_STATUS_404"],
					"CACHE_FILTER" => $arParams["CACHE_FILTER"],
					"PRICE_CODE" => $arParams["PRICE_CODE"],
					"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
					"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
					"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
					"USE_PRODUCT_QUANTITY" => $arParams["SET_STATUS_404"],
					"OFFERS_CART_PROPERTIES" => array(),
					"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
					"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
					"PAGER_TITLE" => $arParams["PAGER_TITLE"],
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
					"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
					"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
					"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
					"AJAX_OPTION_ADDITIONAL" => "",
					"ADD_CHAIN_ITEM" => "N",
					"CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
					"CURRENCY_ID" => $arParams["CURRENCY_ID"],
					"SHOW_MEASURE" => $arParams["SHOW_MEASURE"],
				),
				$component
			);?>

	</div>
</div>
<?}?>
</div>

<div style="width:100%; height:70px;"></div>