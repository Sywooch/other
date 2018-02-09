<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$arParams['TYPE'] = trim($arParams['TYPE']);
$arParams['COUNT'] = intval($arParams['COUNT']);

if ($arParams['CACHE_TYPE'] == 'Y' || ($arParams['CACHE_TYPE'] == 'A' && COption::GetOptionString('main', 'component_cache_on', 'Y') == 'Y')) {
	$arParams['CACHE_TIME'] = intval($arParams['CACHE_TIME']);
} else {
	$arParams['CACHE_TIME'] = 0;
}

$arResult = Array('BANNERS' => array());

$obCache = new CPHPCache;
$cache_id = SITE_ID.'|advertising.banner|'.serialize($arParams);
$cache_path = '/'.SITE_ID.$this->GetRelativePath();

if ($obCache->StartDataCache($arParams['CACHE_TIME'], $cache_id, $cache_path)) {

	if(!CModule::IncludeModule('advertising')) {
		return;
	}

	$rsAdv = CAdvBanner::GetList($by='rand', $order='asc', array('TYPE_SID' => $arParams['TYPE'], 'LAMP' => 'green', 'SITE' => SITE_ID), $f, 'N');
	if ($arParams['COUNT'] > 0) {
		$rsAdv->NavStart($arParams['COUNT']);
	}
	while ($arBanner = $rsAdv->GetNext()) {
		if ($arParams['FIX_SHOW'] == 'Y') {
			CAdvBanner::FixShow($arBanner);
		}
		if ($arBanner['IMAGE_ID'] > 0) {
			$arBanner['IMAGE'] = CFile::GetFileArray($arBanner['IMAGE_ID']);
		}
        if(strlen(trim($arBanner['CODE'])) > 0) {
            $code = $arBanner['CODE'];
            if ($arBanner['CODE_TYPE']=='text') {
                $code = TxtToHTML($code);
			}
            $code = CAdvBanner::PrepareHTML($code, $arBanner);
            $arBanner['CODE_PREPARE'] = CAdvBanner::ReplaceURL($code, $arBanner);
        }
		if (strlen(trim($arBanner['URL'])) > 0) {
			$url = $arBanner['URL'];
			$url = CAdvBanner::PrepareHTML($url, $arBanner);
			$url = CAdvBanner::GetRedirectURL($url, $arBanner);
			$arBanner['URL_PREPARE'] = $url;
		}
		$arResult['BANNERS'][$arBanner['ID']] = $arBanner;
	}

	$this->IncludeComponentTemplate();
	$templateCachedData = $this->GetTemplateCachedData();
	$obCache->EndDataCache(
		Array(
			'arResult' => $arResult,
			'templateCachedData' => $templateCachedData
		)
	);
} else {
	$arVars = $obCache->GetVars();
	$arResult = $arVars['arResult'];
	$this->SetTemplateCachedData($arVars['templateCachedData']);
}

?>