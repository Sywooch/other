<?
if (!empty($arParams['arUserField']['USER_TYPE']['FIELDS']))
{
    foreach ($arParams['arUserField']['USER_TYPE']['FIELDS'] as $sectionID => $sectionName)
    {
        if ($sectionID > 0)
        {
            $dbSection = CIBlockSection::GetList(array(), array('IBLOCK_ID' => '4', 'ID' => $sectionID), false, array('UF_LI_CLASS'), array());
            $arSection = $dbSection->GetNext();
            $arParams['arUserField']['USER_TYPE']['FIELDS_FORMATTED'][$sectionID] = array(
                'NAME' => $arSection['NAME'], 
                'CSS_CLASS' => $arSection['UF_LI_CLASS'],
                'URL' => $arSection['LIST_PAGE_URL']
            );
        }
    }
}
?>