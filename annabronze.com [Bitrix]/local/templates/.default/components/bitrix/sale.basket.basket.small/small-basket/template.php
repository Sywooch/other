<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
	$count = 0;
	$countWithQuantity=0;
	$summ = 0;
	$currency = '';
	$itemsCount = 0;
	$delayCount = 0;


//echo "<pre>";
//print_r($arResult);
//echo "</pre>";



	foreach( $arResult["ITEMS"] as $arItem )
	{
		if( $arItem["DELAY"] == 'N' )
		{
			$count++;
			$countWithQuantity += $arItem["QUANTITY"];
			$summ += $arItem["PRICE"]*$arItem["QUANTITY"];
			$currency = $arItem["CURRENCY"];
			$itemsCount++;
		}
		else
		{
			$delayCount++;
		}
	}




?>
<div class="b-top-cart <? if($countWithQuantity > 0){ echo '_added'; } ?>">

<a href="<?=$arParams["PATH_TO_BASKET"]?>" class="b-top-cart__link link">
	<span><?=GetMessage('CART')?>: <b><i class="js-cart-price"><?=SaleFormatCurrency($summ, $currency);?></i>
			<i class="js-cart-count">(<?=$countWithQuantity;//count($arResult["ITEMS"]);?>)</i></b></span>
</a>


<!--
<div class="basket-large">
	<?if ($delayCount && ($arParams["SHOW_DELAY"]=="Y")):?>
		<div class="delay">
			<a href="<?=$arParams["PATH_TO_BASKET"]?>?section=delay"><i class="icon"></i></a>
			<div class="counter">
				<a href="<?=$arParams["PATH_TO_BASKET"]?>?section=delay"><?=GetMessage("DELAY")?>: +<?=$delayCount;?></a>
			</div>
			<div class="counter_mini"><a href="<?=$arParams["PATH_TO_BASKET"]?>?section=delay">+<?=$delayCount;?></a></div>
		</div>
		
	<?endif;?>	
	<form action="<?=$arParams["PATH_TO_ORDER"]?>" method="post" name="basket_form">
		<a href="<?=$arParams["PATH_TO_BASKET"]?>"><i class="icon"></i></a>
		<div class="counter">
			<div>
				<!--noindex-->
					<!--<a rel="nofollow" id="popup_basket" class="popup_basket" href="<?=$arParams["PATH_TO_BASKET"]?>">
						<?if ($itemsCount):?><?=GetMessage("BASKET");?>: +<?=$count?>
						<?else:?><?=GetMessage("BASKET");?><?endif;?>
					</a>
				<!--/noindex-->
			<!--</div>
			<div>
				<?if ($itemsCount):?><?=GetMessage('SUMM')?> <?=SaleFormatCurrency($summ, $currency);?>
				<?else:?><?=GetMessage("BASKET_EMPTY");?><?endif;?>
			</div>
		</div>
		<div class="counter_mini"><a href="<?=$arParams["PATH_TO_BASKET"]?>">+<?=$count;?></a></div>
		<?if (($arParams["SHOW_DELAY"]!="Y")||!$delayCount):?>
			<!--noindex-->
				<!--<a rel="nofollow" href="<?=$arParams["PATH_TO_BASKET"]?>" class="button" type="submit" id="basketOrderButton2"><span><?=GetMessage("BASKET_LINK");?></span></a>
			<!--/noindex-->
		<?endif;?>
	<!--</form>
</div>
-->

</div>