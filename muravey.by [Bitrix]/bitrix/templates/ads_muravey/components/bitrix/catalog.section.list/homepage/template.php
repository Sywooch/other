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

if (!empty($arResult['SECTIONS'])):
    ?>
    <ul class="order">
    <?
    foreach ($arResult['SECTIONS'] as &$arSection):
        if ($arParams['USER_TYPE_TRANSPORTER'] === true)
            $href = $arSection['SECTION_PAGE_URL'];
        else
            $href = "/ads_add/?id={$arSection['ID']}";
        ?>
        <li><a href="<?=$href?>" class="<?=$arSection['UF_LI_CLASS']?>"><?=$arSection['NAME']?></a></li>
        <?
    endforeach;
    ?>
    </ul>
    <?
endif;
?>
