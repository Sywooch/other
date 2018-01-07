<?
	$arSections = array();

	foreach( $arResult["SECTIONS"] as $arItem ):
		if( $arItem["DEPTH_LEVEL"] == 1 ):
			$arSections[$arItem["ID"]] = $arItem;
		elseif( $arItem["DEPTH_LEVEL"] == 2 ):
			$arSections[$arItem["IBLOCK_SECTION_ID"]]["SECTIONS"][$arItem["ID"]] = $arItem;
		endif;
	endforeach;

    $arResult["SECTIONS"] = [];
	foreach ($arSections as $key=>$section) {
        $countItems = 0;

        $arFilter = array("SECTION_ID"=>$section['ID'], "IBLOCK_ID"=>$section['IBLOCK_ID'], '>PROPERTY_MINIMUM_PRICE' => 0, 'ACTIVE' => 'Y');
        $rsElements = CIBlockElement::GetList(array(), $arFilter, false, false, ['ID', 'PROPERTY_MINIMUM_PRICE']);
        $countItems = $rsElements->SelectedRowsCount();

        $section['ELEMENT_CNT'] = $countItems;

        if($countItems) {
            $arResult["SECTIONS"][] = $section;
        }
    }

$cp = $this->__component;
$cp->SetResultCacheKeys(array(
	"SECTIONS"
));


?>