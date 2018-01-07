<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$hideGroups = true;
if (!strlen($arParams["MAX_CATALOG_GROUPS_COUNT"])) { $maxCount = 5; }
elseif ($arParams["MAX_CATALOG_GROUPS_COUNT"]==0) { $hideGroups = false; }
else { $maxCount =  $arParams["MAX_CATALOG_GROUPS_COUNT"]; }
?>



<? if($arParams["DEVICE"]=="DESKTOP"){ ?>


	<div class="b-top-menu__item-drop _catalog">
		<div class="b-top-menu__catalog">

			<div class="b-top-menu__catalog-col">

				#NEED_TO_REPLACE#



			</div>


			<?//$APPLICATION->ShowViewContent('top_menu_content');  ?>

			<?
			//$this->SetViewTarget('top_menu_content');

			//echo "========";

			//$this->EndViewTarget();
			?>




		</div>

	</div>

<? }else{ ?>


	<?foreach( $arResult["SECTIONS"] as $arItems ){?>
		<div class="b-mob-menu__item">
			<a href="<?=$arItems["SECTION_PAGE_URL"]?>" class="b-mob-menu__item-text"><?=$arItems["NAME"]?></a>
		</div>
	<?}?>

<? } ?>


