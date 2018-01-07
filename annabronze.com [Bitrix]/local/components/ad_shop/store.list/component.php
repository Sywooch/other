<? if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/** @global CMain $APPLICATION */

if(!\Bitrix\Main\Loader::includeModule("catalog"))
    return;

if($_REQUEST['store']) {
    Helper::setStore($_REQUEST['store']);
}

$storeID = Helper::getStore();
$arResult = [];
if(SITE_ID == 'en') {
    $rsStores = CCatalogStore::GetList(
        ['SORT'=>'asc', 'ID'=>'asc'],
        ['ACTIVE'=>'Y'],
        false,
        false,
        ['ID','TITLE','XML_ID']
    );
    $count = 0;
    while ($arStore=$rsStores->Fetch()) {
        if($storeID && $storeID == $arStore['ID']) {
            $arStore['LINK'] = 'javascript:void(0)';
            $arResult['CURRENT'] = $arStore;
        } else {
            $arStore['LINK'] = $APPLICATION->GetCurPageParam("store=".$arStore['ID'], array("store"));
        }
        $arResult['STORES'][] = $arStore;
        $count++;
    }

    if(!$arResult['CURRENT'] && $arResult['STORES']) {
        $arResult['STORES'][0]['LINK'] = 'javascript:void(0)';
        $arResult['CURRENT'] = $arResult['STORES'][0];
    }
}

$this->IncludeComponentTemplate();