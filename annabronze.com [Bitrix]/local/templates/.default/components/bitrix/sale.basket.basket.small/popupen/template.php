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
/*
	$discount = 0;
	$discount2 = 5;
	$summ=(int)$summ;
	$summ2 = 100-$summ;
	if ($summ>500)
	{
		$discount = 20;
		$discount2 = 0;
		$summ2 = 0;	
	}
	else if ($summ>300)
	{
		$discount = 15;
		$discount2 = 20;
		$summ2 = 500-$summ;	
	}
	else if ($summ>200)
	{
		$discount = 10;
		$discount2 = 15;
		$summ2 = 300-$summ;	
	}
	else if ($summ>150)
	{
		$discount = 7;
		$discount2 = 10;
		$summ2 = 200-$summ;		
	}
	else if ($summ>100)
	{
		$discount = 5;
		$discount2 = 7;
		$summ2 = 150-$summ;			
	}
*/

	$discount = 0;
	$discount2 = 10;
	$summ=(int)$summ;
	$summ2 = 100-$summ;
	if ($summ>500)
	{
		$discount = 30;
		$discount2 = 0;
		$summ2 = 0;
	}
	else if ($summ>200)
	{
		$discount = 15;
		$discount2 = 30;
		$summ2 = 500-$summ;	
	}
	else if ($summ>100)
	{
		$discount = 10;
		$discount2 = 15;
		$summ2 = 200-$summ;			
	}

?>

<? if ($discount2>0) {?><p style="color:black">Your discount of <?=$discount?>% to a discount of <?=$discount2?>% remained $<?=$summ2?>.</p><?} else {?><p style="color:black">Your discount of <?=$discount?>%.</p><? } ?>