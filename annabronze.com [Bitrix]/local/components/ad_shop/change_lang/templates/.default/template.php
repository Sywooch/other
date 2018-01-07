<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)	die();
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

/**
 * @var array                    $arParams
 * @var array                    $arResult
 */

?>

<a href="<?=$arResult['URI']?>" class="b-header__lang-current link <?=SITE_ID?>"><span><?=Loc::getMessage('LANG')?></span></a>