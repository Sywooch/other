<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>





<div class="b-gallery">
	<?
	$i = 1;

	//$M=generate_rand_massive(1, 4, count($arResult["SECTIONS"]));
	$M=generate_all_permutation_custom(1, 4, count($arResult["SECTIONS"]), 3);
	?>
<?foreach( $arResult["SECTIONS"] as $arSection ){
	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
	$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
	?>


	<div class="b-gallery__item">
		<a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="b-collections__item _type<? echo $M[$i-1]; $i++; ?> _no-ico _frame-overflow">
			<div class="b-collections__item-frame"></div>
			<div class="b-collections__item-ico"></div>
			<div class="b-collections__item-img" style="background-image: url(<?
			if ($arSection["PICTURE"]["SRC"]):
			$img = CFile::ResizeImageGet( $arSection["PICTURE"], array( "width" => 350, "height" => 350 ),
				BX_RESIZE_IMAGE_PROPORTIONAL, true, array() );
				echo $img["src"];
			else:
				echo BX_DEFAULT_NO_PHOTO_IMAGE;
			endif;

			?>)"></div>
			<div class="b-collections__item-name">
				<span><?=$arSection["NAME"]?><br><i><? echo $arSection["ELEMENT_CNT"] ? $arSection["ELEMENT_CNT"] : '';?></i></span>
			</div>
		</a>
	</div>


<?}?>



</div>




<? /* ?>

<div class="" style="border:none;">
	<?foreach( $arResult["SECTIONS"] as $arSection ){
		$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
		$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
	?>
		<div class="gallerygrid" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
			<a href="<?=$arSection["SECTION_PAGE_URL"]?>">
						<?if ($arSection["PICTURE"]["SRC"]):?>
							<?$img = CFile::ResizeImageGet( $arSection["PICTURE"], array( "width" => 350, "height" => 350 ), BX_RESIZE_IMAGE_PROPORTIONAL, true, array() );?>
							<img border="0" src="<?=$img["src"]?>" alt="<?=($arSection["PICTURE"]["ALT"] ? $arSection["PICTURE"]["ALT"] : $arResult["NAME"])?>" title="<?=($arSection["PICTURE"]["TITLE"] ? $arSection["PICTURE"]["TITLE"] : $arResult["NAME"])?>" />
						<?else:?>
							<img border="0" src="<?=SITE_TEMPLATE_PATH?>/images/noimage40.gif" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" alt="<?=($arSection["PICTURE"]["ALT"] ? $arSection["PICTURE"]["ALT"] : $arResult["NAME"])?>" title="<?=($arSection["PICTURE"]["TITLE"] ? $arSection["PICTURE"]["TITLE"] : $arResult["NAME"])?>" />
						<?endif;?>
			</a>
			<a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="over"><?=$arSection["NAME"]?><? echo $arSection["ELEMENT_CNT"]?'<br/>('.$arSection["ELEMENT_CNT"].')':'';?></a> 
		</div>
	<?}?>
</div>

<? */ ?>