<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

if(!empty($arResult["FILTER_RESULT"])){
    foreach($arResult["FILTER_RESULT"] as $ar){
        if(is_array($ar)){
    ?>
                    <li class="b-main-top__sections-item">
                        <a href="<? if(LANGUAGE_ID==='en'){ echo "/en"; }?>/catalog/types/?<?=$ar["CONTROL_ID"];?>=Y&set_filter=Показать"
                           class="link _invert">
                            <span><?=$ar["VALUE"];?></span>
                        </a>
                    </li>
    <?
        }
    }
}
?>