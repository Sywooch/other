<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
header('Content-Type: application/json');

$cityId = $_POST["cityId"];

if(!CModule::IncludeModule("iblock"))
    return;

$db_items = CIBlockElement::GetList(
    Array("SORT"=>"ASC"),
    Array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE" => "Y", "ID" => $cityId),
    false,
    false,
    Array("ID", "NAME", "PROPERTY_DEFAULT_CITY")
);

while($obRes = $db_items->GetNextElement())
{
    $arRes = $obRes->GetFields();
    $city = $arRes["NAME"];
}
$result["CITY"] =  $city;
$_SESSION["CITY_ID"] = $city;
echo json_encode($result);

?>