<?
CModule::IncludeModule('iblock');

if (empty($arResult['SECTIONS']))
{
    $dbSections = CIBlockSection::GetList(
        array(),
        array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ACTIVE' => 'Y'),
        false,
        array('ID', 'IBLOCK_ID', 'NAME', 'SECTION_PAGE_URL'),
        false
    );

    while ($arSection = $dbSections->GetNext())
    {
        $arResult['SECTIONS'][] = $arSection;
    }
}
?>