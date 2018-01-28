<?php

$min_price=$_POST['min_price'];
$max_price=$_POST['max_price'];
$categories=$_POST['categories'];

$categories_m=explode(":",$categories);



$properties=$_POST['properties'];
//echo $properties."==";

$properties_m=explode(":",$properties);

//echo "<pre>";
//print_r($properties_m);
//echo "</pre>";

//echo $_SERVER['DOCUMENT_ROOT'];
//$root = $_SERVER['DOCUMENT_ROOT'] = realpath(dirname(__FILE__) . '/../../../../');

define('LANG', 's1');
define('SITE_ID', 's1');
define("NO_KEEP_STATISTIC", true);
 
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('main');

if (CModule::IncludeModule("iblock")){
	
	$my_elements = CIBlockElement::GetList (
	  Array("ID" => "ASC"),
	  Array("IBLOCK_ID" => 6),
	  false,
	  false,
	  Array()
	);
 
 while($ar_fields = $my_elements->GetNext()){
	
	
	
	
//echo "<pre>";
//print_r($ar_fields);
//echo "</pre>";

$obParser = new CTextParser;

   $ar_fields["PREVIEW_TEXT"] = $obParser->html_cut($ar_fields["PREVIEW_TEXT"], 180);
$ar_fields["PREVIEW_TEXT"]=HTMLToTxt($ar_fields["PREVIEW_TEXT"]);

//$arProps = $ar_fields->GetProperties();

//echo "<pre>";
//print_r($arProps);
//echo "</pre>";

	$db_props = CIBlockElement::GetProperty(6, $ar_fields["ID"], "sort", "asc", array());
	$PROPS = array();
	while($ar_props = $db_props->Fetch()){
		$PROPS[$ar_props['CODE']] = $ar_props['VALUE'];
	}



//oeeuo? ii oaia
if($PROPS['PRICE'] < $min_price || $PROPS['PRICE'] > $max_price){

continue;

}


//oeeuo? ii eaoaai?eyi
if(!in_array($ar_fields['IBLOCK_SECTION_ID'],$categories_m) && $categories!=""){
continue;

}








//echo "<pre>";
//print_r($PROPS);
//echo "</pre>";



	echo '
	<div>
    <div class="one_p_cur">

<div class="name"><h2><a href="/ip-kamery/'.$ar_fields['IBLOCK_SECTION_ID'].'/'.$ar_fields['ID'].'/">'.$ar_fields['NAME'].'</a></h2></div>
            <div class="image"><a href="/ip-kamery/'.$ar_fields['IBLOCK_SECTION_ID'].'/'.$ar_fields['ID'].'/">
<img src="'.CFile::GetPath($ar_fields['PREVIEW_PICTURE']).'" title="'.$ar_fields['NAME'].'" alt="'.$ar_fields['NAME'].'"></a></div>

      <div class="description">'.$ar_fields["PREVIEW_TEXT"].'<div class="md-over_br"></div></div>
      <div class="price_add">
            <div class="price">
                '.$PROPS['PRICE'].' ?oa.                      </div>
      <div class="cart">
        <input type="button" value="Eoieou" onclick="" class="button">
      </div>
      </div><!--price_add-->
       </div><!--one_p_cur-->
    </div>
	
	';
 }
 
 
 
	
	
}



?>
