<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)	die();
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

/**
 * @var array                    $arParams
 * @var array                    $arResult
 */

?>
<?if($arResult['SHOW']):?>
    <div class="b-geo">
        <?=GetMessage('PANEL_TEXT')?>
        <nobr>
            <a href="<?=$arResult['LINKS']['EN']?>" class="b-geo__link _yes"><?=GetMessage('YES_BTN_TEXT')?></a>
            <a href="<?=$arResult['LINKS']['RU']?>" class="b-geo__link _no"><?=GetMessage('NO_BTN_TEXT')?></a>
        </nobr>
    </div>
<?endif;?>