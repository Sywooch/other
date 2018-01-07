<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
	$count = 0;
	$summ = 0;
	$currency = '';
	$itemsCount = 0;
	$delayCount = 0;
	foreach( $arResult["ITEMS"] as $arItem )
	{
		if( $arItem["DELAY"] == 'N' && $arItem["CAN_BUY"] == 'Y' )
		{
			$count++;
			$summ += $arItem["PRICE"]*$arItem["QUANTITY"];
			$currency = $arItem["CURRENCY"];
			$itemsCount++;
		}
		elseif ($arItem["DELAY"] == 'Y')
		{
			$delayCount++;
		}
	}
	$discount = 0;
	$discount2 = 5;
	$summ=(int)$summ;
	$summ2 = 2000-$summ;
	if ($summ>7000)
	{
		$discount = 15;
		$discount2 = 0;
		$summ2 = 0;	
	}
	else if ($summ>5000)
	{
		$discount = 10;
		$discount2 = 15;
		$summ2 = 7000-$summ;	
	}
	else if ($summ>3000)
	{
		$discount = 7;
		$discount2 = 10;
		$summ2 = 5000-$summ;		
	}
	else if ($summ>2000)
	{
		$discount = 5;
		$discount2 = 7;
		$summ2 = 3000-$summ;			
	}
?>

<? if ($discount2>0) {?><p style="color:black">Ваша скидка <?=$discount?>% до скидки <?=$discount2?>% осталось <?=$summ2?> руб.</p><?} else {?><p style="color:black">Ваша скидка <?=$discount?>%.</p><? } ?>
