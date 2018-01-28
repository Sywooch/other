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
            $dbUser = CUser::GetByID($arItem['DISPLAY_PROPERTIES']['CARRIER_USER_ID']['VALUE']);
            $arUser = $dbUser->GetNext();
            
            $arItem['DISPLAY_PROPERTIES']['CARRIER_USER_ID']['CLIENT_INFO'] = $arUser;
        }
    }
    
    $cp = $this->__component; 
    if (is_object($cp))
        $cp->SetResultCacheKeys(array('SECTIONS'));
}
?>