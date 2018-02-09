#!/usr/bin/php 
<?php 

$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"]; 
define("NO_KEEP_STATISTIC", true); 
define("NOT_CHECK_PERMISSIONS", true); 
 set_time_limit(0);
//define("LANG", "ru"); 
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"); 


global $APPLICATION;
CModule::IncludeModule('iblock');
CModule::IncludeModule('main');
CModule::IncludeModule("sale");
  
//получить список зарегистрированных пользователей
$filter = array();
$rsUsers = CUser::GetList(($by="ID"), ($order="desc"), $filter);
while ($arUser = $rsUsers->Fetch()) 
{
	if($arUser['ACTIVE']=="N" || $arUser['EMAIL']=="N"){ continue; };
		
 	$ID=$arUser['ID'];
	$LOGIN=$arUser['LOGIN'];
	$NAME=$arUser['NAME'];
	$LAST_NAME=$arUser['LAST_NAME'];
	$EMAIL=$arUser['EMAIL'];
	
	if($LAST_NAME=="" && $NAME==""){
		$user_name=$LOGIN;	
	}else{
		$user_name=$LAST_NAME." ".$NAME;		
	}
	
	//получить список отложенных товаров пользователя
	$arBasketItems = array();
    $dbBasketItems = CSaleBasket::GetList(
                  array("NAME" => "ASC","ID" => "ASC"),
                  array("FUSER_ID" => $ID, "LID" => SITE_ID, "ORDER_ID" => "NULL", "DELAY" => "Y"),
                  false,
                  false,
                  array("ID","MODULE","PRODUCT_ID","QUANTITY","CAN_BUY","PRICE"));
    unset($products);
	$today= date("d.m.Y h:i:s");
	$M_today=strtotime($today);
	
	while ($arItems=$dbBasketItems->Fetch())
    {
		$arItems=CSaleBasket::GetByID($arItems["ID"]);
		
		$DATE_INSERT=$arItems["DATE_INSERT"];
		$M_DATE_INSERT=strtotime($DATE_INSERT);
		$PRODUCT_ID=$arItems["PRODUCT_ID"];
	
		//получить список заказаных товаров пользователя 
		$arFilter = array("USER_ID" => $ID);// 
		
		$db_sales = CSaleOrder::GetList(array(), $arFilter);
		$log=0;
		//список заказов
		while ($ar_sales = $db_sales->Fetch()) {
			

			$DATE_INSERT2=$ar_sales['DATE_INSERT'];
			$M_DATE_INSERT2=strtotime($DATE_INSERT2);
			
			//заказ старше 30 дней не рассматриваем
			if(($M_today - $M_DATE_INSERT2) > (30*24*60*60)){ continue; };

				
			# получить список товаров определенного заказа
			$dbBasketItems2 = CSaleBasket::GetList(array(), array("ORDER_ID" => $ar_sales["ID"]), false, false, array());
			while ($arItems2 = $dbBasketItems2->Fetch()) {
				
				if($arItems2['PRODUCT_ID']==$PRODUCT_ID){
					$log=1;	
					break;	
				}
			 
				
			}
		
		
		
		
			
		}
		

		if((($M_today - $M_DATE_INSERT) <= (30*24*60*60)) && ($log==0)){
			//если добавление товара в отложенные произошло не раньше 30 дней назад, а так-же товар отсутствует 
			//в списке заказанных того-же пользователя, то товар добавляется в список.
		
      		$text=$arItems["NAME"]." - ".(float)$arItems["PRICE"]." - ".(float)$arItems["QUANTITY"];
			//echo $text."<br>";
			$products[]=$text;
		}
		
    }
	
	
	if(count($products)==0){ continue; };
	
	$send_list="";
	foreach($products as $v){
		$send_list=$send_list.$v."<br>";
		
	}
	
	
	
	//отправка письма пользователю
	//use Bitrix\Main\Mail\Event;
	Bitrix\Main\Mail\Event::send(array(
    "EVENT_NAME" => "SEND_TO_USER",
    "LID" => "s1",
    "C_FIELDS" => array(
        "EMAIL" => $EMAIL,
        "USER_ID" => $ID,
		"USER_NAME" => $user_name,
		"SEND_LIST" => $send_list
    ),
	));
	
	
	
	

}




include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); 
?> 