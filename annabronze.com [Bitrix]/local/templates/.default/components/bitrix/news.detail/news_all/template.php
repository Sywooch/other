<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="news_all">
	<?if ($arParams["DISPLAY_NAME"]=="Y"):?><div class="name"><?=$arResult["NAME"]?></div><?endif;?>
	<?if ($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"]||$arResult["DETAIL_PICTURE"]):?>
		<div class="img">
			<?if($arResult["DETAIL_PICTURE"]):?>
				<?$img = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], array( "width" => 275, "height" => 600 ), BX_RESIZE_IMAGE_PROPORTIONAL, true, array() );?>
				<a class="fancy" href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>">
					<img border="0" src="<?=$img["src"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
				</a>
			<?endif;?>
			<?if($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"]):?>
				<div class="gallery">
					<?foreach( $arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $arPhoto ){
						$arPhoto = CFile::GetFileArray($arPhoto);
						$img = CFile::ResizeImageGet($arPhoto, array( "width" => 800, "height" => 600 ), BX_RESIZE_IMAGE_PROPORTIONAL, true, array() );?>
						<a class="fancy" rel="article_gallery" href="<?=$img["src"]?>">
							<?$img = CFile::ResizeImageGet($arPhoto, array( "width" => 85, "height" => 85 ), BX_RESIZE_IMAGE_PROPORTIONAL, true, array() );?>
							<img border="0" src="<?=$img["src"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
						</a>
					<?}?>
				</div>
			<?endif;?>
		</div>
	<?endif;?>
	<div class="text<?if(!$arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"]&&!$arResult["DETAIL_PICTURE"]):?> no-image<?endif;?>">
		<?if(($arParams["DISPLAY_DATE"]=="Y")&&($arResult["DISPLAY_ACTIVE_FROM"])):?>
			<div class="date"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></div>
		<?endif;?>
		<?if($arResult["DETAIL_TEXT"]):?>
			<div><?=$arResult["DETAIL_TEXT"];?></div>
		<?elseif($arResult["PREVIEW_TEXT"]&&($arParams["DISPLAY_PREVIEW_TEXT"]=="Y")):?>
			<div><?=$arResult["PREVIEW_TEXT"];?></div>
		<?endif;?>
	</div>
	<div style="clear: both;"></div>
</div>