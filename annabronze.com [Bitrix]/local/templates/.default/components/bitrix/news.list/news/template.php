<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>




	<div class="b-news-list">


<?foreach( $arResult["ITEMS"] as $arItem ){
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>



		<div class="b-news-list__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
				<div class="b-news-list__item-img" style="background-image: url(<?
				echo $arItem["PICTURE"];
				?>)"></div>
			</a>
			<div class="b-news-list__item-wrapper">
				<div class="b-news-list__item-date"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></div>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="b-news-list__item-title"><?=$arItem["NAME"]?></a>
				<div class="b-news-list__item-text">
					<?=$arItem["PREVIEW_TEXT"]?>
				</div>
			</div>
		</div>

<?}?>


	</div>


<?=$arResult["NAV_STRING"]?>

