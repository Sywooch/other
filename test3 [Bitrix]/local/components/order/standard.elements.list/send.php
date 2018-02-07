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
use Bitrix\Main\Type\DateTime;



$req = json_decode( file_get_contents('php://input'), true );

//если значение не пустое, то значит, что пустое скрытое поля на форме было заполнено ботом (по умолчанию боты заполняют все текстовые поля).
if($req["id"]!=""){ echo 0; exit; };


$id=$req["id"];
$count=$req["count"];
$mail=$req["mail"];
$name=$req["name"];
$sum=$req["sum"];
$name_product=$req["name_product"];



if($id=="" || $id==NULL || $id==0){ echo 0; exit; };
if($count=="" || $count==NULL || $count<=0){ echo 0; exit; };
if(!preg_match("/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/", $mail)){ echo 0; exit; };
if($name=="" || $name==NULL){ echo 0; exit; };
if($name_product=="" || $name_product==NULL){ echo 0; exit; };
if($sum=="" || $sum==NULL || $sum<=0){ echo 0; exit; };

//создать заказ в админке
$m2=explode("@",$mail);


// создаем ID пользователя для корзины
global $USER;
if ($USER->IsAuthorized()){
	$userId=$USER->GetID();
}else{
	$arIMAGE = CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"]."/images/photo.gif");
	$arIMAGE["MODULE_ID"] = "main";
	
	$user = new CUser;
	$arFields = Array(
	  "NAME"              => $name,
	  "LAST_NAME"         => "",
	  "EMAIL"             => $mail,
	  "LOGIN"             => $m2[0],
	  "LID"               => "ru",
	  "ACTIVE"            => "Y",
	  "GROUP_ID"          => array(10,11),
	  "PASSWORD"          => "123456",
	  "CONFIRM_PASSWORD"  => "123456",
	  "PERSONAL_PHOTO"    => $arIMAGE
	);
	
	$userId = $user->Add($arFields);

}
//echo "==".$userId."==";

//$userId = '#'; // ID пользователя
$FUSER_ID = CSaleUser::GetList(array('USER_ID' => $userId)); // получаем FUSER_ID, если покупатель для данного пользователя существует
if(!$FUSER_ID['ID']) // если покупателя нет - создаем его
{
   $FUSER_ID = CSaleUser::_Add(array("USER_ID" => $userId));
}
$FUSER_ID = $FUSER_ID['ID']; // теперь переменную $FUSER_ID можно использовать для добавления товаров в корзину пользователя с $userId.


$date_delivery = new DateTime();
$date_delivery = $date_delivery->toString();

//echo "==".$sum."==";

$m=explode(" ",$sum);


$sum=$m[0];
$currency=$m[1];



$order_id = CSaleOrder::Add(
	array(
        'LID' => SITE_ID,
        'PERSON_TYPE_ID' => 1,
        'PAYED' => "N",
        'CANCELED' => "N",
        'STATUS_ID' => "N",
        'ALLOW_DELIVERY' => 'N',
        'DATE_ALLOW_DELIVERY' => $date_delivery,
        'DELIVERY_DOC_DATE' => $date_delivery,
        'PRICE' => $sum,
        'CURRENCY' => $currency,
        'USER_ID' => $userId,
        'USER_DESCRIPTION' => 'ЗАКАЗ',
        'ADDITIONAL_INFO' => 'ЗАКАЗ',
          )
 	); 
		
//echo $order_id;	

//добавление товара в корзину			
$arFieldsItem = array(
  'PRODUCT_ID' => $id,
  'PRICE' => $sum/$count,
  'CURRENCY' => $currency,
  'QUANTITY' => $count,
  'LID' => 's1',
  'NAME' => $name_product,
  'ORDER_ID' => $order_id,
  'DETAIL_PAGE_URL' => "",
);
CSaleBasket::Add($arFieldsItem);			
			
//Связываем товары и корзину 			
CSaleBasket::OrderBasket($order_id, $FUSER_ID, 's1');

//Заполняем свойства заказа
/*$arFieldsMAIL = array(
	"ORDER_ID" => $order_id,
    "ORDER_PROPS_ID" => $order_id,
    "NAME" => "Mail",
    "CODE" => "MAIL",
    "VALUE" => $mail
    );
CSaleOrderPropsValue::Add($arFieldsMAIL);  
*/


	
	//отправка письма администратору
	//use Bitrix\Main\Mail\Event;
	Bitrix\Main\Mail\Event::send(array(
    "EVENT_NAME" => "SEND_ORDER",
    "LID" => "s1",
    "C_FIELDS" => array(
        "ID" => $id,
        "COUNT" => $count,
		"NAME_PRODUCT" => $name_product,
		"SUM" => $sum." ".$currency,
		"NAME" => $name,
		"MAIL" => $mail,
		"LINK" => "//".$_SERVER["SERVER_NAME"]."/bitrix/admin/sale_order_view.php?ID=".$order_id,
    ),
	));
	






echo 1;

include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); 

?>