<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!$arResult["NavShowAlways"])
{
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
        return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");

// to show always first and last pages
$arResult["nStartPage"] = 1;
$arResult["nEndPage"] = $arResult["NavPageCount"];

$sPrevHref = '';
if ($arResult["NavPageNomer"] > 1)
{
    $bPrevDisabled = false;
    
    if ($arResult["bSavePage"] || $arResult["NavPageNomer"] > 2)
    {
        $sPrevHref = $arResult["sUrlPath"].'?'.$strNavQueryString.'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]-1);
    }
    else
    {
        $sPrevHref = $arResult["sUrlPath"].$strNavQueryStringFull;
    }
}
else
{
    $bPrevDisabled = true;
}

$sNextHref = '';
if ($arResult["NavPageNomer"] < $arResult["NavPageCount"])
{
    $bNextDisabled = false;
    $sNextHref = $arResult["sUrlPath"].'?'.$strNavQueryString.'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]+1);
}
else
{
    $bNextDisabled = true;
}
?>

<div class="pager">
    <ul>
    <?
    $bFirst = true;
    $bPoints = false;
    
    if ($arResult["NavPageNomer"] > 1):
//    if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):
        ?>
        <li class="prev"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">&nbsp;</a></li>
        <?
    endif;
    
    do
    {
        if ($arResult["nStartPage"] <= 2 || $arResult["nEndPage"]-$arResult["nStartPage"] <= 1 || abs($arResult['nStartPage']-$arResult["NavPageNomer"])<=2)
        {

            if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
                ?>
                <li class="active"><a><?=$arResult["nStartPage"]?></a></li>
                <?
            else:
                ?>
                <li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a></li>
                <?
            endif;
            
            $bFirst = false;
            $bPoints = true;
        }
        else
        {
            if ($bPoints)
            {
                ?>
                <li><a>...</a></li>
                <?
                $bPoints = false;
            }
        }
        
        $arResult["nStartPage"]++;
    } 
    while($arResult["nStartPage"] <= $arResult["nEndPage"]);
    
    if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):
        ?>
        <li class="next"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>">&nbsp;</a></li>
        <?
    endif;
    ?>
    
    </ul>
</div>