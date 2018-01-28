<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

if (\Bitrix\Main\Loader::includeModule("iblock"))
{
    $arSections = array();
    $dbSections = CIBlockSection::GetList(
        array(),
        array('IBLOCK_ID' => $arParams['IBLOCK_ID']),
        false,
        array('ID', 'NAME', 'DETAIL_PICTURE', 'SECTION_PAGE_URL'),
        false
    );
    
    while ($arSection = $dbSections->GetNext(true, false))
    {
        $arSection['DETAIL_PICTURE'] = CFile::GetPath($arSection['DETAIL_PICTURE']);
        $arSections[$arSection['ID']] = $arSection;
    }
    
    $arResult['SECTIONS'] = $arSections;
    
    $dbElementRes = CIBlockElement::GetList(
        array(),
        array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ID' => $arResult['ID']),
        false,
        false,
        array('ID', 'IBLOCK_ID', 'SHOW_COUNTER')
    );
    while ($arElement = $dbElementRes->GetNext())
    {
        $arResult['SHOW_COUNTER'] = $arElement['SHOW_COUNTER'];
    }
    
    if (!empty($arResult['DATE_CREATE']))
    {
        $arResult['DATE_CREATE'] = ConvertDateTime($arResult['DATE_CREATE'], 'DD.MM.YYYY - HH:MM');
    }
    
    if (!empty($arResult['DISPLAY_PROPERTIES']['ORDER_DATE_DATE']['VALUE']))
    {
        $arResult['DISPLAY_PROPERTIES']['ORDER_DATE_DATE']['VALUE'] = FormatDate("j F Y", MakeTimeStamp($arResult['DISPLAY_PROPERTIES']['ORDER_DATE_DATE']['VALUE']));
    }
    
    
    if (!empty($arResult['DISPLAY_PROPERTIES']['CLIENT_USER_ID']['VALUE']))
    {
        $dbRes = CIBlockElement::GetList(
            array(),
            array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ACTIVE' => 'Y', 'PROPERTY_CLIENT_USER_ID' => $arResult['DISPLAY_PROPERTIES']['CLIENT_USER_ID']['VALUE']),
            false,
            false,
            array('ID', 'IBLOCK_ID')
        );
        
        $arResult['CLIENT_INFO'] = array(
            'NAME' => $USER->GetFirstName(),
            'ORDERS_ACTIVE' => $dbRes->SelectedRowsCount(),
        );
    }
    
    if (!empty($_REQUEST['show_all']) && $_REQUEST['show_all'] == 'Y')
        unset($arNavStartParams['nTopCount']); 
    
    $arResult['BETS_INFO'] = array();
    $dbBets = CIBlockElement::GetList(
        array(),
        array('IBLOCK_CODE' => 'ads_orders_bets', 'ACTIVE' => 'Y', 'PROPERTY_LINKED_ADS' => $arResult['ID']),
        false,
        $arNavStartParams,
        array('ID', 'IBLOCK_ID', 'CREATED_DATE', 'PROPERTY_BET_SUMM', 'PROPERTY_USER_ID')
    );
    while ($arBet = $dbBets->GetNext())
    {
        $arBet['CREATED_DATE'] = FormatDate('d F Y', MakeTimeStamp($arBet['CREATED_DATE'], 'YYYY.MM.DD'));
        $arResult['BETS_INFO']['BETS'][] = $arBet;
        if (!array_key_exists($arBet['PROPERTY_USER_ID_VALUE'], $arResult['BETS_INFO']['CARRIERS']))
        {
            $dbUser = $USER->GetByID($arBet['PROPERTY_USER_ID_VALUE']);
            $arUser = $dbUser->Fetch();
            $arResult['BETS_INFO']['CARRIERS'][$arBet['PROPERTY_USER_ID_VALUE']] = $arUser;
        }
    }
    
    if (!empty($arResult['BETS_INFO']))
    {
        foreach ($arResult['BETS_INFO']['CARRIERS'] as &$arCarrier)
        {
            $arCarrier['RATING'] = GetCarrierRatingByID($arCarrier['ID']);
        }
    }
    
    pred(array($arResult['BETS_INFO']));
    
    $cp = $this->__component; 
    if (is_object($cp))
    {
        $cp->SetResultCacheKeys(array('SECTIONS'));
    }
}