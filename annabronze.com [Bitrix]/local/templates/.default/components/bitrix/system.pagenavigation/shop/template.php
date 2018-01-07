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

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>


<div class="b-pager">

<?if ($arResult["NavPageNomer"] > 1):?>

    <?if($arResult["bSavePage"]):?>
        <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"
           class="b-pager__item "><i>1</i></a>
        |
        <span class="b-pager__item _current"><i>...</i></span>
        |
    <?else:?>
        <? if($arResult["NavPageNomer"] > 3 && $arResult["nStartPage"] != 1){ ?>
            <a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" class="b-pager__item "><i>1</i></a>
        <? } ?>
        |
        <?if ($arResult["NavPageNomer"] > 4 && $arResult["nStartPage"] > 2):?>
            <span class="b-pager__item _current"><i>...</i></span>
        <?endif?>
        |
    <?endif?>

<?else:?>
    1&nbsp;|&nbsp;<!--<span class="b-pager__item _current"><i>...7</i></span>-->&nbsp;|
<?endif?>

<?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>

    <?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
        <span class="b-pager__item _current"><i><?=$arResult["nStartPage"]?></i></span>
    <?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
        <a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" class="b-pager__item ">
            <i><?=$arResult["nStartPage"]?></i>
        </a>
    <?else:?>
        <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"
           class="b-pager__item ">
            <i><?=$arResult["nStartPage"]?></i>
        </a>
    <?endif?>
    <?$arResult["nStartPage"]++?>
<?endwhile?>
|

<?if($arResult["NavPageNomer"] < $arResult["NavPageCount"] - 2):?>
    <? if($arResult["nEndPage"] < $arResult["NavPageCount"] - 1){ ?>
        <span class="b-pager__item _current"><i>...</i></span>
    <? } ?>
    <? if($arResult["nEndPage"] < $arResult["NavPageCount"]){ ?>
        &nbsp;|
        <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"
           class="b-pager__item ">
            <i><?=$arResult["NavPageCount"]?></i>
        </a>
    <? } ?>
<?else:?>
    <? if($arResult["NavPageNomer"] < $arResult["NavPageCount"] - 2){ ?>
    <span class="b-pager__item _current"><i>...</i></span>&nbsp;|&nbsp;<?=$arResult["NavPageCount"]?>
    <? } ?>
<?endif?>


<?if ($arResult["bShowAll"]):?>
<noindex>
	<?if ($arResult["NavShowAll"]):?>
		|&nbsp;<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=0"
				  class="b-pager__item "
				  rel="nofollow"><i><?=GetMessage("nav_paged")?></i></a>
	<?else:?>
		|&nbsp;<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=1"
				  class="b-pager__item "
				  rel="nofollow"><i><?=GetMessage("nav_all")?></i></a>
	<?endif?>
</noindex>
<?endif?>

</div>