<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
CModule::IncludeModule('subscribe');
$rub = CRubric::GetList(array(), array("ACTIVE"=>"Y"));
$arrRub=array();
while($res=$rub->Fetch()){
    $arrRub[$res['ID']]=$res['NAME'];
}
$arComponentParameters = array(
    "GROUPS" => array(),
    "PARAMETERS" => array(
        'RUB_ID' => array(
            "PARENT" => "",
            "NAME" => GetMessage("MS_RUBLICK_LIST"),
            "TYPE" => "LIST",
            "VALUES" => $arrRub,
            "DEFAULT"=>'Новости магазина',
            "MULTIPLE" => "N",
        ),
        "CACHE_TIME" => array("DEFAULT" => 3600),
    ),
);
?>
