<?
$obEnum = new CUserFieldEnum;

foreach ($arResult['USER_PROPERTIES']['DATA'] as $propCode => &$arProp)
{
    $rsEnum = $obEnum->GetList(array(), array("USER_FIELD_ID" => $arProp['ID']));
    while($arEnum = $rsEnum->GetNext())
    {
        $arProp['PROP_VALUES'][] = $arEnum;
    }
}
?>