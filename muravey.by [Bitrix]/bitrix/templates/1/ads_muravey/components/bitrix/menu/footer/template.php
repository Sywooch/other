<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<div class="menu-footer">
    <div class="wrapper">
        <ul>
        <?
        foreach($arResult as $arItem):
            if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
                continue;
            ?>
            <li><a href="<?=$arItem["LINK"]?>" class="<?=$arItem["PARAMS"]["CLASS"]?>"><?=$arItem["TEXT"]?></a></li>
        <?endforeach?>
        </ul>
    </div>
</div>
<?endif?>