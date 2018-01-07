<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>







	<div class="b-main-news__right">


<?foreach( $arResult["ITEMS"] as $arItem ){

	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
		<div class="b-main-news__anounce">
			<div class="b-main-news__anounce-img" style="background-image: url(<?
			$img = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array( "width" => 180, "height" => 180 ),
				BX_RESIZE_IMAGE_PROPORTIONAL );
			echo $img["src"];

				?>)">

			</div>
			<div class="b-main-news__anounce-content">
				<div class="b-main-news__anounce-date"><?=$arItem["DISPLAY_ACTIVE_FROM"];?></div>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="b-main-news__anounce-title"><?=$arItem["NAME"]?></a>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="btn _medium-size"><?=GetMessage('MAIN_RIGHT_BUTTON');?></a>
			</div>
		</div>

	</div>

<?}?>

