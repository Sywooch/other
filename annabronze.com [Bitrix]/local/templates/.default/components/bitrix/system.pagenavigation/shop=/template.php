<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arResult["NavPageCount"] > 1 || $arResult["bShowAll"]):?>
	<?
	$count_item = 100; //
	$arResult["nStartPage"] = $arResult["NavPageNomer"] - $count_item;
	$arResult["nStartPage"] = $arResult["nStartPage"] <= 0 ? 1 : $arResult["nStartPage"];

	$arResult["nEndPage"] = $arResult["NavPageNomer"] + $count_item;
	$arResult["nEndPage"] = $arResult["nEndPage"] > $arResult["NavPageCount"] ? $arResult["NavPageCount"] : $arResult["nEndPage"];

	$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
	$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");


	?>


	<div class="pagination b-pager">

		<?if( $arResult["NavPageNomer"] > 1 ):?>
			<!--<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"
			   class="arrow left b-pager__item"><i></i></a>-->
		<?endif;?>
		<?if( $arResult["nStartPage"] > 1 ):
			echo "<span class='b-pager__item _current'><i>1</i></span>";
		endif;
		while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>

			<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
				<span class="_current b-pager__item"><i><?=$arResult["nStartPage"]?></i></span>
			<?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
				<a class="b-pager__item" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><i><?=$arResult["nStartPage"]?></i></a>
			<?else:?>
				<a class="b-pager__item" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><i><?=$arResult["nStartPage"]?></i></a>
			<?endif;
			$arResult["nStartPage"]++;

		endwhile;
		/*if( $arResult["nEndPage"] < $arResult["NavPageCount"] ):
			echo "<span class='b-pager__item _current'><i>1</i></span>";
		endif;*/?>
		<?if( $arResult["NavPageNomer"] < $arResult["NavPageCount"] ):?>
			<!--<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" class="arrow right b-pager__item"><i></i></a>-->
		<?endif;?>
		<?if ($arResult["bShowAll"]):?>
			<noindex>
				<?if ($arResult["NavShowAll"]):?>
					<a class="spall b-pager__item" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=0" rel="nofollow"><i><?=GetMessage("nav_paged")?></i></a>
				<?else:?>
					<a class="spall b-pager__item" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=1" rel="nofollow"><i><?=GetMessage("nav_all")?></i></a>
				<?endif?>
			</noindex>
		<?endif;?>

		<!--
		<span class="b-pager__item _current"><i>1</i></span>
		<a href="#" class="b-pager__item "><i>2</i></a>
		<a href="#" class="b-pager__item "><i>3</i></a>
		<a href="#" class="b-pager__item "><i>4</i></a>
		-->

	</div>

	
	
<?endif;?>