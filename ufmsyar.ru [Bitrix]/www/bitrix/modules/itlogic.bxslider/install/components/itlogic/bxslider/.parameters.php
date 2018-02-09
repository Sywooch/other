<? if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
if(!CModule::IncludeModule("iblock"))
	return;
	
	
	
$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock=array();
$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch())
{
	$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}


$arSliderMode = array();
$arSliderMode = array(
	'vertical' => GetMessage("ITLOGIC_BXSLIDER_VERTIKALQNYY"),
	'horizontal' => GetMessage("ITLOGIC_BXSLIDER_GORIZONTALQNYY"),
	'fade' => GetMessage("ITLOGIC_BXSLIDER_POAVLENIE")
	);

// 'PARENT' => 'BASE'  -  Основные парамеры
$arComponentParameters = array(
	'GROUPS' => array(
		"EDIT" => array(
			'NAME' => GetMessage("ITLOGIC_BXSLIDER_NASTROYKI_SLAYDERA"),
			'SORT' => "400",
		),
	),
	'PARAMETERS' => array(
		"IBLOCK_TYPE" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("ITLOGIC_BXSLIDER_TIP_INFOBLOKA"),
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlockType,
			"REFRESH" => "Y",
			"DEFAULT" => "itlogicbxslider",
		),
		"IBLOCK_ID" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("ITLOGIC_BXSLIDER_INFOBLOK"),
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
			"DEFAULT" => COption::GetOptionString("itlogic.bxslider","IBLOCK_ID"),
		),
		"SLIDER_MODE" => array(
			"PARENT" => "EDIT",
			"NAME" => GetMessage("ITLOGIC_BXSLIDER_TIP_PEREHODA_MEJDU_S"),
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "N",
			"VALUES" => $arSliderMode,
			"DEFAULT" => "horizontal"
		),
		"SLIDER_WIDTH" => array(
			"PARENT" => "EDIT",
			"NAME" => GetMessage("ITLOGIC_BXSLIDER_SIRINA_SLAYDERA"),
			"TYPE" => "TEXT",
			"DEFAULT" => "0",
		),

		'SLIDER_SPEED' => array(
			'NAME' => GetMessage("ITLOGIC_BXSLIDER_SKOROSTQ_PEREHODA_SL"),
			'TYPE' => 'TEXT',
			'DEFAULT' => '500',
			'PARENT' => 'EDIT',
			),
		'SLIDER_HIDECONTROLONEND' => array(
			'NAME' => GetMessage("ITLOGIC_BXSLIDER_SPRATATQ_STRELKU_NA"),
			'TYPE' => 'CHECKBOX',
			'PARENT' => 'EDIT',
			'DEFAULT' => 'Y',
			'REFRESH' => 'Y',
			),
		'SLIDER_AUTO' => array(
			'NAME' => GetMessage("ITLOGIC_BXSLIDER_AVTOMATICESKOE_PEREK"),
			'TYPE' => 'CHECKBOX',
			'PARENT' => 'EDIT',
			'DEFAULT' => 'Y',
			),
		'SLIDER_AUTO_CONTROLS' => array(
			'NAME' => GetMessage("ITLOGIC_BXSLIDER_DOBAVLAET_KNOPKI"),
			'TYPE' => 'CHECKBOX',
			'PARENT' => 'EDIT',
			'DEFAULT' => 'Y',
			),
		'SLIDER_CAPTIONS' => array(
			'NAME' => GetMessage("ITLOGIC_BXSLIDER_PODPISQ_NA_SLAYD"),
			'TYPE' => 'CHECKBOX',
			'PARENT' => 'EDIT',
			'DEFAULT' => 'Y',
			),
		'SLIDER_RESPONSIVE' => array(
			'NAME' => GetMessage("ITLOGIC_BXSLIDER_ADAPTIVNOSTQ"),
			'TYPE' => 'CHECKBOX',
			'PARENT' => 'EDIT',
			'DEFAULT' => 'Y',
			),
		'jQuery' => array(
			'NAME' => GetMessage("ITLOGIC_BXSLIDER_PODKLUCITQ"),
			'TYPE' => 'CHECKBOX',
			'PARENT' => 'EDIT',
			),
		"HREF_IMG" => array(
			'NAME' => GetMessage("ITLOGIC_BXSLIDER_SYLKI_NA_IZOBRAJENI"),
			'TYPE' => 'CHECKBOX',
			'PARENT' => 'EDIT',
			'DEFAULT' => 'Y',
			),
		'CACHE_TIME'  =>  array('DEFAULT'=>3600),

	),
);
?>
