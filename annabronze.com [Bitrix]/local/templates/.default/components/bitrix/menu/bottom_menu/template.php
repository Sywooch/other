<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?foreach( $arResult as $arItem ){?>

		<a href="<?=$arItem["LINK"]?>" class="b-footer__menu-item"><?=$arItem["TEXT"]?></a>


<?}?>