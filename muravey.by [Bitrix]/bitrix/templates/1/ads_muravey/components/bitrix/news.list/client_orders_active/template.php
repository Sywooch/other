<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<h2>Активные заказы</h2>

<table class="clickable_row">
    <tr>
        <th style="border-radius: 6px 0 0 0; width: 310px;">Заголовок</th>
        <th style="width: 170px;">Откуда</th>
        <th style="width: 35px;">км</th>
        <th style="width: 170px;">Куда</th>
        <th style="width: 90px;">Дата</th>
        <th style=" border-radius: 0 6px 0 0;">Ставки</th>
    </tr>
    <?
    if (!empty($arResult['ITEMS']))
    {
        foreach ($arResult['ITEMS'] as $arItem)
        {
            ?>
            <tr>
                <td>
                    <div class="number-logo-s">
                        <div class="number-s"><?=$arItem['ID']?></div>
                        <div class="logo-s"><img src="<?=$arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['PICTURE']?>" alt=""/></div>
                    </div>
                    <div class="title-category-s">
                        <div class="title-s"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a></div>
                        <div class="category-s"><?=$arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['NAME']?></div>
                    </div>
                </td>
                <td>
                    <div class="from-from-obl-s">
                        <div class="from-s"><?=$arItem['DISPLAY_PROPERTIES']['FROM_CITY']['VALUE']?></div>
                        <?if (!empty($arItem['DISPLAY_PROPERTIES']['FROM_REGION']['VALUE'])):?>
                        <div class="from-obl-s">(<?=$arItem['DISPLAY_PROPERTIES']['FROM_REGION']['VALUE']?>)</div>
                        <?endif?>
                    </div>
                </td>
                <td><div class="km-s"><?=!empty($arItem['DISPLAY_PROPERTIES']['DISTANCE']['VALUE']) ? $arItem['DISPLAY_PROPERTIES']['DISTANCE']['VALUE'] : "—"?> км</div></td>
                <td>
                    <div class="to-to-obl-s">
                        <div class="to-s"><?=$arItem['DISPLAY_PROPERTIES']['TO_CITY']['VALUE']?></div>
                        <?if (!empty($arItem['DISPLAY_PROPERTIES']['TO_REGION']['VALUE'])):?>
                        <div class="to-obl-s">(<?=$arItem['DISPLAY_PROPERTIES']['TO_REGION']['VALUE']?>)</div>
                        <?endif?>
                    </div>
                </td>
                <td><div class="date-s"><?=$arItem['DISPLAY_PROPERTIES']['ORDER_DATE_DATE']['VALUE']?></div></td>
                <td>
                    <div class="rates-s <?/*hot-s*/?>">
                    <?
//                    pred(array($arItem));
                    if (
                        $arItem['DISPLAY_PROPERTIES']['IS_HAVE_BET']['VALUE'] == 'Нет' 
                        || empty($arItem['DISPLAY_PROPERTIES']['IS_HAVE_BET']['VALUE'])
                        || empty($arResult['BETS_INFO'][$arItem['ID']]['MIN_BET_SUMM'])
                    ):
                    ?>
                    Будь первым
                    <?else:?>
                    От <?=number_format($arResult['BETS_INFO'][$arItem['ID']]['MIN_BET_SUMM'], 0, ".", " ")?> р.
                    </div>
                    <?endif?>
                </td>
            </tr>
            <?
        }
    }
    else
    {
        ?>
        <tr>
            <td colspan="6">На сайте нет активных заявок, принадлежащих вам...</td>
        </tr>
        <?
    }
    ?>
</table>