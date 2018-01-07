<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>



	<div class="b-news-list">




<?foreach( $arResult["ITEMS"] as $arItem ){
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

		<div class="b-news-list__item _is-article" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
				<div class="b-news-list__item-img">
					<div class="b-news-list__item-imginner" style="background-image: url(<?
	if( is_array( $arItem["PREVIEW_PICTURE"] ) ):
		$img = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array( "width" => 170 , "height" => 170 ), BX_RESIZE_IMAGE_EXACT);
		echo $img["src"];
	elseif( is_array( $arItem["DETAIL_PICTURE"] ) ):
		$img = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array( "width" => 170 , "height" => 170 ), BX_RESIZE_IMAGE_EXACT);
		echo $img["src"];
	else:
		echo BX_DEFAULT_NO_PHOTO_IMAGE;
	endif;
?>)"></div>
				</div>
			</a>
			<div class="b-news-list__item-wrapper">
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="b-news-list__item-title"><?=$arItem["NAME"]?></a>
				<div class="b-news-list__item-text">
					<?=$arItem["PREVIEW_TEXT"]?>
				</div>
			</div>
		</div>

<?}?>


		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
			<br /><?=$arResult["NAV_STRING"]?>
		<?endif;?>


	</div>
