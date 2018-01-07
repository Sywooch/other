<? if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/*use Bitrix\Main\Application;
use Bitrix\Main\Web\Uri;*/

$currentSiteVersion = Helper::getSiteVersion();
if(!$currentSiteVersion) {
    $currentSiteVersion = Helper::RU_VERSION;
}

$newSiteVersion = Helper::EN_VERSION;
if($currentSiteVersion == $newSiteVersion) {
    $newSiteVersion = Helper::RU_VERSION;
}

//на будущее
/*$request = Application::getInstance()->getContext()->getRequest();
$uriString = $request->getRequestUri();
$uri = new Uri($uriString);
$uri->addParams(array("lang" => $newSiteVersion));
$arResult['URI'] = $uri->getUri();*/
global $APPLICATION;
$arResult['URI'] = $APPLICATION->GetCurPageParam("lang=".$newSiteVersion, array("lang"));

$this->IncludeComponentTemplate();