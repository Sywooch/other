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
	
	$tr = array(
        "�"=>"a","�"=>"b","�"=>"v","�"=>"g",
        "�"=>"d","�"=>"e","�"=>"ye","�"=>"zh","�"=>"z","�"=>"i",
        "�"=>"y","�"=>"k","�"=>"l","�"=>"m","�"=>"n",
        "�"=>"o","�"=>"p","�"=>"r","�"=>"s","�"=>"t",
        "�"=>"u","�"=>"f","�"=>"kh","�"=>"ts","�"=>"ch",
        "�"=>"sh","�"=>"shch","�"=>"","�"=>"y","�"=>"",
        "�"=>"e","�"=>"yu","�"=>"ya","�"=>"a","�"=>"b",
        "�"=>"v","�"=>"g","�"=>"d","�"=>"e","�"=>"ye","�"=>"zh",
        "�"=>"z","�"=>"i","�"=>"y","�"=>"k","�"=>"l",
        "�"=>"m","�"=>"n","�"=>"o","�"=>"p","�"=>"r",
        "�"=>"s","�"=>"t","�"=>"u","�"=>"f","�"=>"kh",
        "�"=>"ts","�"=>"ch","�"=>"sh","�"=>"shch","�"=>"y",
        "�"=>"y","�"=>"","�"=>"e","�"=>"yu","�"=>"ya",","=>"_","."=>"_"," "=>"_",":"=>"_",";"=>"_",
		"-"=>"_","�"=>"","^"=>"","�"=>""
    );

	
	while($ar_result = $db_list->GetNext()) {
		
		
		$rus=$ar_result["NAME"];
		$eng=strtr($rus,$tr);
		
	while(true){
$pos = strpos($eng, "__");
if ($pos === false) {
	break;
}else{
	
}	
		
$eng=str_replace("__", "_", $eng);


}

if(strlen($eng)>101){

$eng=substr($eng,0,100);
}



	//$ar_result["PROPERTY_HREF_VALUE"]
		
		$arResult[] = array(
					"ID" => $ar_result['ID'],
					"NAME" => $ar_result['NAME'],
					"DETAIL_PICTURE" => CFile::GetPath($ar_result['DETAIL_PICTURE']),
					"HREF" => $eng
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