<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
?>


<div class="b-catalog-section__color">
			<div class="b-colors _spacing-big">
				<div class="b-colors__title"><?=GetMessage("CATALOG_SECTION_SELECT_COLOR");?>:</div>

				<?
				//$url = selfURL();
				$url = remove_key(array("PAGEN_1"));
				foreach($arResult["FILTER_COLORS"] as $k=>$v){
					$url=z_add_url_get(array('color'=>$k+1),$url);
					?>
					<a href="<?=$url;?>" data-color-id="<?=$v["ID"];?>" id="color_<?=$v["ID"];?>"
					   class="b-colors__item _with-border _color-<?=$k+1;?> <? if(isset($_GET["color"])&&(($k+1)==$_GET["color"])){ echo "_current"; } ?>"
					   title="<?=$v["VALUE"];?>"><i></i></a>
					<?
				}
				?>

</div>
</div>

