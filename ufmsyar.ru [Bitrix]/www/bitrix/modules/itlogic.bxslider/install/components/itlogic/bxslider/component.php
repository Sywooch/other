<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
//echo '<pre>'; print_r($arParams); echo '</pre>';
CModule::IncludeModule('iblock');
if ($this->StartResultCache(3600))
{
	
	//Params
	
	$iblock_id = $arParams['IBLOCK_ID'];
	$jquery = $arParams['jQuery'];
	
	
	//LOGIC
	
	//jQuery
	if($jquery == "Y"){
		$APPLICATION->AddHeadScript('/bitrix/components/itlogic/bxslider/js/jquery-1.11.0.min.js');
	}
	//jQuery
	
	
	$APPLICATION->AddHeadScript('/bitrix/components/itlogic/bxslider/js/jquery.bxslider.min.js');
	$APPLICATION->SetAdditionalCSS('/bitrix/components/itlogic/bxslider/css/jquery.bxslider.css');
	
	$arFilter = array('IBLOCK_ID'=>$iblock_id);
	$db_list = CIBlockElement::GetList(array('SORT'=>'ASC'), $arFilter, false, array("nPageSize" => "50"), array("ID", "NAME", "DETAIL_PICTURE", "PROPERTY_HREF"));
	while($ar_result = $db_list->GetNext()) {
		
		
		$arResult[] = array(
					"ID" => $ar_result['ID'],
					"NAME" => $ar_result['NAME'],
					"DETAIL_PICTURE" => CFile::GetPath($ar_result['DETAIL_PICTURE']),
					"HREF" => $ar_result["PROPERTY_HREF_VALUE"]
				   );
	}
	// echo '<pre>'; print_r($arResult); echo '</pre>';
	$this->IncludeComponentTemplate();
}
?>
<script>
$(document).ready(function(){
		var settings = <?=CUtil::PhpToJSObject($arParams)?>;
        $.getScript('/bitrix/components/itlogic/bxslider/js/script.js', function(){
            slider(settings);
        });                
});
</script>