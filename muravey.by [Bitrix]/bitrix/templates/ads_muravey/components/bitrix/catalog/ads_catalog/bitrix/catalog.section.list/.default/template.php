<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>

<p>
    <select class="select-category">
        <option value="/catalog/">Категория объявлений</option>
        <?	
        foreach ($arResult['SECTIONS'] as &$arSection)
        {
	        ?>
            <option value="<?=$arSection['SECTION_PAGE_URL']?>" <?if (!empty($arResult['SECTION']) && $arResult['SECTION']['ID'] == $arSection['ID']):?>selected="selected"<?endif?>>
                <?=$arSection['NAME']?>
            </option>
            <?
        }
        unset($arSection);
        ?>
    </select>
</p>