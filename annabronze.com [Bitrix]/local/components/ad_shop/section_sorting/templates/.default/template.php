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



<div class="b-catalog-section__sort">
	<div class="b-catalog-section__sorting">

		<?
		//$url = selfURL();
		$url = remove_key(array("PAGEN_1"));



		if($arParams["ELEMENT_SORT_FIELD"]=="PROPERTY_MINIMUM_PRICE" && $arParams["ELEMENT_SORT_ORDER"]=="asc") {
			$url=z_add_url_get(array('sort'=>"PRICE", 'order'=>"desc"),$url);
			//$url3=remove_key(array("sort","order"));
			$url3=z_add_url_get(array('sort'=>"ARTICLE", 'order'=>"asc"),$url);

			?>
			<div class="b-catalog-section__sorting-current _price"><?= GetMessage("CATALOG_PRICE_ORDER_LOW_TOP_HIGH") ?></div>
			<div class="b-catalog-section__sorting-dropper">
				<a href="<?=$url;?>"
				   class="b-catalog-section__sorting-link _price"><?= GetMessage("CATALOG_PRICE_ORDER_HIGH_TOP_LOW") ?></a>
				<a href="<?=$url3;?>"
				   class="b-catalog-section__sorting-link"><?= GetMessage("CATALOG_PRICE_ORDER_ATTR") ?></a>
			</div>
			<?
		}else if($arParams["ELEMENT_SORT_FIELD"]=="PROPERTY_MINIMUM_PRICE" && $arParams["ELEMENT_SORT_ORDER"]=="desc"){
			$url=z_add_url_get(array('sort'=>"PRICE", 'order'=>"asc"),$url);
			//$url3=remove_key(array("sort","order"));
			$url3=z_add_url_get(array('sort'=>"ARTICLE", 'order'=>"asc"),$url);

			?>
			<div class="b-catalog-section__sorting-current _price"><?= GetMessage("CATALOG_PRICE_ORDER_HIGH_TOP_LOW") ?></div>
			<div class="b-catalog-section__sorting-dropper">
				<a href="<?=$url;?>"
				   class="b-catalog-section__sorting-link _price"><?= GetMessage("CATALOG_PRICE_ORDER_LOW_TOP_HIGH") ?></a>
				<a href="<?=$url3;?>"
				   class="b-catalog-section__sorting-link"><?= GetMessage("CATALOG_PRICE_ORDER_ATTR") ?></a>
			</div>
			<?
		}else{
			?>
			<div class="b-catalog-section__sorting-current"><?= GetMessage("CATALOG_PRICE_ORDER_ATTR") ?></div>
			<div class="b-catalog-section__sorting-dropper">
				<?
				$url1=z_add_url_get(array('sort'=>"PRICE", 'order'=>"asc"),$url);
				$url2=z_add_url_get(array('sort'=>"PRICE", 'order'=>"desc"),$url);

				//$url3=remove_key(array("sort","order"));


				?>

				<a href="<?=$url1;?>"
				   class="b-catalog-section__sorting-link _price"><?= GetMessage("CATALOG_PRICE_ORDER_LOW_TOP_HIGH") ?></a>
				<a href="<?=$url2;?>"
				   class="b-catalog-section__sorting-link _price"><?= GetMessage("CATALOG_PRICE_ORDER_HIGH_TOP_LOW") ?></a>
			</div>
			<?
		}
		?>
	</div>
</div>


