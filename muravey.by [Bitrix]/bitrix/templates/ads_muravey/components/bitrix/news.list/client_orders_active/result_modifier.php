<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

if (\Bitrix\Main\Loader::includeModule("iblock"))
{
    $arSections = array();
    $dbSections = CIBlockSection::GetList(
        array(),
        array('IBLOCK_ID' => $arParams['IBLOCK_ID']),
        false,
        array('ID', 'NAME', 'PICTURE', 'SECTION_PAGE_URL'),
        false
    );
    
    while ($arSection = $dbSections->GetNext(true, false))
    {
        $arSection['PICTURE'] = CFile::GetPath($arSection['PICTURE']);
        $arSections[$arSection['ID']] = $arSection;
    }
    
    $arResult['SECTIONS'] = $arSections;
    
    if (!empty($arResult['ITEMS']))
    {
        foreach ($arResult['ITEMS'] as &$arItem)
        {
            $arItem['DISPLAY_PROPERTIES']['ORDER_DATE_DATE']['VALUE'] = ConvertDateTime($arItem['DISPLAY_PROPERTIES']['ORDER_DATE_DATE']['VALUE'], "DD.MM");
            if ($arItem['DISPLAY_PROPERTIES']['IS_HAVE_BET']['VALUE'] == 'Да')
            {
                $dbBets = CIBlockElement::GetList(
                    array('PROPERTY_BET_SUMM' => 'desc'),
                    array('IBLOCK_CODE' => 'ads_orders_bets', 'ACTIVE' => 'Y', 'PROPERTY_LINKED_ADS' => $arItem['ID']),
                    false,
                    array('nTopCount' => 1),
                    array('ID', 'IBLOCK_ID', 'CREATED_DATE', 'PROPERTY_BET_SUMM', 'PROPERTY_USER_ID')
                );
                if ($arBet = $dbBets->GetNext())
                {
                    $arResult['BETS_INFO'][$arItem['ID']] = array('MIN_BET_SUMM' => $arBet['PROPERTY_BET_SUMM_VALUE']);
                }
            }
        }
    }
    
    $cp = $this->__component; 
    if (is_object($cp))
        $cp->SetResultCacheKeys(array('SECTIONS'));
}
?>