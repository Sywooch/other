<?
/*
AddEventHandler("sale", "OnBeforeBasketAdd", "MontageBasketAdd");
function MontageBasketAdd(&$arFields)
{
$arFields["CURRENCY"] = "RUB"; 
$arFields["CALLBACK_FUNC"] = ""; 
$arFields["IGNORE_CALLBACK_FUNC"] = "Y"; 
$arFields['PRICE']=100; 

}
*/


AddEventHandler("catalog", "OnGetOptimalPrice", "MyGetOptimalPrice");
   
function MyGetOptimalPrice(
    $intProductID,
    $quantity = 1,
    $arUserGroups = array(),
    $renewal = "N",
    $arPrices = array(),
    $siteID = false,
    $arDiscountCoupons = false
 )   { 
 
CModule::IncludeModule('iblock');
CModule::IncludeModule('catalog');
CModule::IncludeModule("sale");
 
 
//echo "<pre>";
// print_r($arPrices);
//echo "</pre>";
 
$arOptPrices = CCatalogProduct::GetByIDEx($intProductID);
$old_price=$arOptPrices['PRICES'][1]['PRICE']; //старая цена товара

//получить скидку товара и скидку пользователя

$iblock_element_ID=$arOptPrices['PROPERTIES']['CML2_LINK']['VALUE']; //id элемента из инфоблока, соответствующего товару

$arFilter = Array("IBLOCK_ID"=>"2", "ID"=>$iblock_element_ID);
$res = CIBlockElement::GetList(Array(), $arFilter);
if ($ob = $res->GetNextElement()){
    $arProps = $ob->GetProperties();
    $product_sale=$arProps["SALE"]["VALUE"]; //скидка товара
	if($arProps["SALE"]["VALUE"]==""){ $product_sale=0; };
}

global $USER;
if ($USER->IsAuthorized()){
	$user_id=$USER->GetID();
	CModule::IncludeModule('highloadblock');
	
	$hlblock_id = 3; // ID вашего Highload-блока
	$hlblock = Bitrix\Highloadblock\HighloadBlockTable::getById( $hlblock_id )->fetch(); // получаем объект вашего HL блока
	$entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity( $hlblock );  // получаем рабочую сущность
	$entity_data_class = $entity->getDataClass(); // получаем экземпляр класса
	$entity_table_name = $hlblock['TABLE_NAME']; // присваиваем переменной название HL таблицы
	$sTableID = 'tbl_'.$entity_table_name; // добавляем префикс и окончательно формируем название
	
	$arFilter = array("UF_USER_ID" => $user_id); // зададим фильтр по ID пользователя
	$arSelect = array('*'); // выбираем все поля
	
	 
	// 
	$rsData = $entity_data_class::getList(array(
		"select" => $arSelect,
		"filter" => $arFilter,
		"limit" => '1'
	));
	
	 
	// выполняем запрос. 
	$rsData = new CDBResult($rsData, $sTableID); // записываем в переменную объект CDBResult
	 
	//
	while($arRes = $rsData->Fetch()){
		$user_sale=$arRes["UF_USER_SALE"]; // скидка пользователя
		if($arRes["UF_USER_SALE"]==""){ $user_sale=0; }; 
	}		
	
	
}else{
	$user_sale=0;	
}

$full_sale=$product_sale+$user_sale; //общая скидка для товара

if($full_sale>0){
	$result_price=$old_price - (($old_price * $full_sale)/100); 
}else{
	$result_price=$old_price;
}
 
return array(
        'PRICE' => array(
            'PRICE' => $result_price,
            'CURRENCY' => "RUB",
        )
    );  
		  
		  
 }


?>