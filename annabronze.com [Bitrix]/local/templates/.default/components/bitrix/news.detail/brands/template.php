<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if( is_array( $arResult["DETAIL_PICTURE"] ) ){?>
	<a class="fancy" rel="stock_gallery" href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>">			
		<img border="0" src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
	</a>
<?}?>
<div class="text">
	<?=$arResult["DETAIL_TEXT"]?>
</div>