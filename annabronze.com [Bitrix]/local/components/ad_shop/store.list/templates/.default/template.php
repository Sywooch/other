<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)	die();

/**
 * @var array                    $arParams
 * @var array                    $arResult
 */

?>
<?if($arResult['STORES']):?>
<div class="b-place">
    <div class="b-place__current"><?=$arResult['CURRENT']['XML_ID']?></div>
    <div class="b-place__list">
        <?foreach ($arResult['STORES'] as $store):?>
            <div class="b-place__list-item"><a href="<?=$store['LINK']?>" class="link"><span><?=$store['XML_ID']?></span></a></div>
        <?endforeach;?>
    </div>
</div>
<?endif;?>