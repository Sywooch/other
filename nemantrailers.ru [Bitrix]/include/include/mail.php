<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if($_POST['phone']!=""){
    $name = iconv('utf-8','windows-1251',$_POST['name']);
    $phone = iconv('utf-8','windows-1251',$_POST['phone']);
	$type = iconv('utf-8','windows-1251',$_POST['type']);

 CModule::IncludeModule('iblock');
		$el = new CIBlockElement;
		$PROP = array();
		$PROP[5] = $type; 
		$PROP[6] = $phone;        // ������� �������
	
		$arLoadProductArray = Array(
		  "MODIFIED_BY"    => 1, // ������� ������� ������� �������������
		  "IBLOCK_SECTION_ID" => false,          // ������� ����� � ����� �������
		  "IBLOCK_ID"      => 7,
		  "PROPERTY_VALUES"=> $PROP,
		  "NAME"           => $name,
		  "ACTIVE"         => "N",            // �������
		  "PREVIEW_TEXT"   => ''

		  );

		if($PRODUCT_ID = $el->Add($arLoadProductArray)){
			$arEventFields= array(
				
				'NAME'=>$name,
				'PHONE'=>$phone,
				'TYPE'=>$type,
				
				);
		$emlsend =CEvent::Send("nuw_zap", "s1", $arEventFields, "N", 8);
		
	}
			 
	}

?>

 