<? if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/** @global CMain $APPLICATION */

if(!\Bitrix\Main\Loader::includeModule("catalog"))
    return;

$arResult = [
    'SHOW' => false,
    'LINKS' => [
        'RU' => 'javascript:void(0)',
        'EN' => 'javascript:void(0)'
    ]
];
$storeID = Helper::getStore();
if(SITE_ID == 'en' && !$storeID && !Helper::isCustomerInCIS()) {
    $arResult['SHOW'] = true;
    $rsStores = CCatalogStore::GetList(
        ['SORT'=>'asc', 'ID'=>'asc'],
        ['ACTIVE'=>'Y', '?XML_ID'=>Helper::DEFAULT_STORE_RU_XML_ID.'|'.Helper::DEFAULT_STORE_EN_XML_ID],
        false,
        false,
        ['ID','TITLE','XML_ID']
    );
    while ($arStore=$rsStores->Fetch()) {
        if($arStore['XML_ID'] == Helper::DEFAULT_STORE_RU_XML_ID) {
            $arResult['LINKS']['RU'] = $APPLICATION->GetCurPageParam("store=".$arStore['ID'], array("store"));
        } else if ($arStore['XML_ID'] == Helper::DEFAULT_STORE_EN_XML_ID) {
            $arResult['LINKS']['EN'] = $APPLICATION->GetCurPageParam("store=".$arStore['ID'], array("store"));
        }
    }
}
$this->IncludeComponentTemplate();