<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$this->setFrameMode(true);

	require '/home/user1167996/www/muravey.by/bitrix/templates/ads_muravey/core/db.php';
	$sql__11a = $db->prepare("
									SELECT
											*
									FROM
											`b_iblock_section_element`
									WHERE
											`b_iblock_section_element`.`IBLOCK_ELEMENT_ID` = :__id_element
									ORDER BY
											`b_iblock_section_element`.`IBLOCK_ELEMENT_ID`
									ASC
							");
	$__id_element = $arResult['ID'];
	$sql__11a->bindParam(':__id_element', $__id_element, PDO::PARAM_STR);
	$sql__11a->setFetchMode(PDO::FETCH_ASSOC);
	$sql__11a->execute();
	$row__11a = $sql__11a->fetch();
?>
<h1>Поиск заказа</h1>
<div class="search-customer-right">
    <?/*<ul class="filter-s">
        <li class="active"><a href="#">Все</a></li>
        <li><a href="#">Горящие</a></li>
        <li class="active" style="float: right;"><a href="#">Показать на карте</a></li>
    </ul>
    */?>
    <table>
    <tr>
        <th style="border-radius: 6px 0 0 0; width: 310px;">Заголовок</th>
        <th style="width: 170px;">Откуда</th>
        <th style="width: 35px;">км</th>
        <th style="width: 170px;">Куда</th>
        <th style="width: 90px;">Дата</th>
        <th style=" border-radius: 0 6px 0 0;">Ставки</th>
    </tr>
    <?if (!empty($arResult['ITEMS'])):?>
    <?foreach($arResult['ITEMS'] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <tr id="<?=$this->GetEditAreaId($arItem['ID'])?>">
            <td>
                <div class="number-logo-s">
                    <div class="number-s"><?=$arItem['ID']?></div>
                    <div class="logo-s"><img src="<?=$arResult['SECTIONS'][$row__11a['IBLOCK_SECTION_ID']]['PICTURE']?>" alt=""/></div>
                </div>
                <div class="title-category-s">
                    <div class="title-s"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a></div>
                    <div class="category-s"><?=$arResult['SECTIONS'][$row__11a['IBLOCK_SECTION_ID']]['NAME']?></div>
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
    <?endforeach?>
    <?elseif (!empty($_REQUEST['set_filter'])):?>
        <tr>
            <td colspan="6" class="empty">По данному запросу заказов не найдено...</td>
        </tr>
    <?else:?>
        <tr>
            <td colspan="6" class="empty">В данной категории объявлений нет актуальных заказов...</td>
        </tr>
    <?endif?>
    </table>
    
    <?if ($arParams['DISPLAY_BOTTOM_PAGER'] == 'Y'):?>
        <?=$arResult["NAV_STRING"]?>
    <?endif?>
    
    <div class="counter">
        <?
        $arElementsOnPage = array(10, 20, 50, 100);
        $currentPage = $arParams['PAGE_ELEMENT_COUNT'];
        ?>
        <ul>
            <li>Выводить по</li>
            <?foreach ($arElementsOnPage as $page):?>
            <li <?if ($page == $currentPage):?>class="active"<?endif?>><a href="<?=$APPLICATION->GetCurPageParam("elements=$page", array("elements"), false)?>"><?=$page?></a></li>
            <?endforeach?>
        </ul>
    </div>
</div>
<div class="clear"></div>