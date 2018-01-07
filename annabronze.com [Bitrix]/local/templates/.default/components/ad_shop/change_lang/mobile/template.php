<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)	die();
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

/**
 * @var array                    $arParams
 * @var array                    $arResult
 */

?>

<div class="b-mob-menu__item _dark">
    <a href="<?=$arResult['URI']?>" class="b-mob-menu__item-text"><?=Loc::getMessage('LANG')?></a>
</div>