<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<div class="grid-row col-1 col-xm-12 col-s-12"></div>




<div class="b-layout__inner-content grid-row col-10 col-xm-12  col-s-12"><!-- new grid classes -->
	<div class="b-layout__info-box"><!-- for content pages - content styles -->


			<div class="b-news-detail">



				<?if ($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"]||$arResult["DETAIL_PICTURE"]):?>

						<?if($arResult["DETAIL_PICTURE"]){?>

							<?$img = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], array( "width" => 301, "height" => 301 ), BX_RESIZE_IMAGE_EXACT, true, array() );?>

							<div class="b-news-detail__pic" style="background-image: url(<?=$img["src"];?>)"></div>

						<?}?>



						<?if($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"]):?>

							<?
							$log = 0;
							foreach( $arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $arPhoto ){
								$log = 1;
								break;
							}

							if($log == 1) {
								?>
								<div class="b-news-detail__gallery">
								<?

								foreach ($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $arPhoto) {

									if (!empty($arPhoto)) {
										$arPhoto = CFile::GetFileArray($arPhoto);


										$img = CFile::ResizeImageGet($arPhoto, array("width" => 400, "height" => 300), BX_RESIZE_IMAGE_PROPORTIONAL, true, array()); ?>

										<div class="b-news-detail__gallery-item">
											<a href="<?= $arPhoto["SRC"]; ?>" class="b-news-detail__gallery-img fancybox"
											   rel="news-gal" style="background-image: url(<?= $img["src"] ?>)"></a>
											<!--<span class="b-news-detail__gallery-notice"><?= $arResult["NAME"] ?></span>-->
										</div>
										<? if ($i % 3 == 0) { ?>  </div><div class="b-news-detail__gallery"> <? }
										$i++; ?>


										<?
									}

								}
								?>
								</div>
								<?
							}
								?>





						<?endif;?>

				<?endif;?>









				<?if($arResult["DETAIL_TEXT"]):?>
					<?


					$arResult["DETAIL_TEXT"] = str_replace("\xc2\xa0", " ", $arResult["DETAIL_TEXT"]);
					$arResult["DETAIL_TEXT"] = str_replace("\r\n", " ", $arResult["DETAIL_TEXT"]);

					$arResult["DETAIL_TEXT"] = str_replace("/> <img",'/><img',$arResult["DETAIL_TEXT"]);
					$arResult["DETAIL_TEXT"] = str_replace("/>&nbsp;<img",'/><img',$arResult["DETAIL_TEXT"]);
					$arResult["DETAIL_TEXT"] = str_replace('/>"&nbsp;"<img','/><img',$arResult["DETAIL_TEXT"]);




					$arResult["DETAIL_TEXT"] = preg_replace("/(<img\s[\w\d\W]+?>){1,}/", '<div class="b-news-detail__gallery">$0</div>', $arResult["DETAIL_TEXT"]);



					preg_match_all('/<img[^>]+>/i',$arResult["DETAIL_TEXT"], $result);

					$img = array();
					foreach( $result[0] as $img_tag)
					{
						preg_match_all('/(alt|src)=("[^"]*")/i',$img_tag, $img[$img_tag]);
					}



					$data = $arResult["DETAIL_TEXT"];
					foreach($result[0] as $key => $item){

						$arTmp = array_keys($img[$item][1], "src");
						$srcKey = $arTmp[0];

						$arTmp = array_keys($img[$item][1], "alt");
						$srcAlt = $arTmp[0];

						$image = $img[$item][2][$srcKey];
						$image = trim($image, "\"");
						$protocol = (CMain::IsHTTPS()) ? "https://" : "http://";

						if( strpos( $image, $protocol) === false){
							$filename2 = $protocol.$_SERVER["HTTP_HOST"].$image;
						}else{
							$filename2 = $image;
						}

						$size2 = getimagesize(trim($filename2,"\""));

						if($size2[0] > 400){

						ResizeImage ($image, $size = 400, $quality = 100, "/upload/medialibrary/", basename($image));


						$dir  = $protocol.$_SERVER["HTTP_HOST"];
						$image = $dir."/upload/medialibrary/".trim(basename($image),"\"");
							
						}




						$data = str_replace($item, "<div class=\"b-news-detail__gallery-item\">"."<a href='".trim($img[$item][2][$srcKey],"\"")."' class=\"b-news-detail__gallery-img fancybox\" rel=\"news-gal\" style=\"background-image: url(".trim($image,"\"").")\"></a>"."<span class=\"b-news-detail__gallery-notice\" style=\"display:none;\">".trim($img[$item][2][$srcAlt], "\"")."</span></div>", $data);
					}


					echo $data;



					?>
				<?elseif($arResult["PREVIEW_TEXT"]&&($arParams["DISPLAY_PREVIEW_TEXT"]=="Y")):?>
					<?=$arResult["PREVIEW_TEXT"];?>
				<?endif;?>





			</div>

	</div>
</div>