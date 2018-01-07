<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)	die();

/**
 * @var array                    $arParams
 * @var array                    $arResult
 */

?>
<?if($arResult['STORES']):?>
    <div class="b-mob-menu__item _dark _has-drop">
        <span class="b-mob-menu__item-text"><?=$arResult['CURRENT']['TITLE']?></span>
        <div class="b-mob-menu__item-drop">
            <?foreach ($arResult['STORES'] as $store):?>
                <div class="b-mob-menu__item">
                    <a href="<?=$store['LINK']?>" class="b-mob-menu__item-text"><?=$store['TITLE']?></a>
                </div>
            <?endforeach;?>
        </div>
    </div>
<?endif;?>