<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main;
use \Bitrix\Main\Localization\Loc as Loc;
use \Bitrix\Main\Mail\Event; 

Loc::loadMessages(__FILE__); 

try
{
	if (!Main\Loader::includeModule('iblock'))
		throw new Main\LoaderException(Loc::getMessage('STANDARD_ELEMENTS_LIST_PARAMETERS_IBLOCK_MODULE_NOT_INSTALLED'));
	
	//if (!Main\Loader::includeModule('mail'))
	//	throw new Main\LoaderException(Loc::getMessage('STANDARD_ELEMENTS_LIST_PARAMETERS_IBLOCK_MODULE_NOT_INSTALLED'));
		
		
	
	
	
	$iblockTypes = \CIBlockParameters::GetIBlockTypes(Array("-" => " "));
	
	$iblocks = array(0 => " ");
	if (isset($arCurrentValues['IBLOCK_TYPE']) && strlen($arCurrentValues['IBLOCK_TYPE']))
	{
	    $filter = array(
	        'TYPE' => $arCurrentValues['IBLOCK_TYPE'],
	        'ACTIVE' => 'Y'
	    );
	    $rsIBlock = \CIBlock::GetList(array('SORT' => 'ASC'), $filter);
	    while ($arIBlock = $rsIBlock -> GetNext())
	    {
	        $iblocks[$arIBlock['ID']] = $arIBlock['NAME'];
	    }
	}
	
	//получить список типов почтовых событий
	//$mailEventsTypes=array(0 => " ");
	
	$filter = array();
	
	$rsMailEventsTypes = \CEventType::GetList(array('NAME' => 'ASC'), $filter);
	while ($arMailEventsTypes = $rsMailEventsTypes -> GetNext())
	{
		if(LANGUAGE_ID==$arMailEventsTypes['LID']){
			//echo $arMailEventsTypes['ID']." -- ".$arMailEventsTypes['LID']." -- ".$arMailEventsTypes['EVENT_NAME']." -- ".$arMailEventsTypes['NAME']."<br>";
	    	$mailEventsTypes[$arMailEventsTypes['EVENT_NAME']] = $arMailEventsTypes['NAME'];
		}
	}	
	
	//echo "<pre>";
	//print_r($rsMailEventsTypes);
	//echo "</pre>";
	//сортировка по значениям
	asort($mailEventsTypes);
	
	//echo "<pre>";
	//print_r($mailEventsTypes);
	//echo "</pre>";
	
	
	$sortFields = array(
		'ID' => Loc::getMessage('STANDARD_ELEMENTS_LIST_PARAMETERS_SORT_ID'),
		'NAME' => Loc::getMessage('STANDARD_ELEMENTS_LIST_PARAMETERS_SORT_NAME'),
		'ACTIVE_FROM' => Loc::getMessage('STANDARD_ELEMENTS_LIST_PARAMETERS_SORT_ACTIVE_FROM'),
		'SORT' => Loc::getMessage('STANDARD_ELEMENTS_LIST_PARAMETERS_SORT_SORT')
	);
	
	$sortDirection = array(
		'ASC' => Loc::getMessage('STANDARD_ELEMENTS_LIST_PARAMETERS_SORT_ASC'),
		'DESC' => Loc::getMessage('STANDARD_ELEMENTS_LIST_PARAMETERS_SORT_DESC')
	);
	
	$arComponentParameters = array(
		'GROUPS' => array(
		),
		'PARAMETERS' => array(
			'IBLOCK_TYPE' => Array(
				'PARENT' => 'BASE',
				//'NAME' => Loc::getMessage('STANDARD_ELEMENTS_LIST_PARAMETERS_IBLOCK_TYPE'),
				'NAME' => "Тип инфоблока с товарами",
				'TYPE' => 'LIST',
				'VALUES' => $iblockTypes,
				'DEFAULT' => '',
				'REFRESH' => 'Y'
			),
			'IBLOCK_ID' => array(
				'PARENT' => 'BASE',
				//'NAME' => Loc::getMessage('STANDARD_ELEMENTS_LIST_PARAMETERS_IBLOCK_ID'),
				'NAME' => "Инфоблок с товарами",
				'TYPE' => 'LIST',
				'VALUES' => $iblocks
			),
			'EVENT_TYPE' => array(
				'PARENT' => 'BASE',
				//'NAME' => Loc::getMessage('STANDARD_ELEMENTS_LIST_PARAMETERS_IBLOCK_ID'),
				'NAME' => "Тип почтового события",
				'TYPE' => 'LIST',
				'VALUES' => $mailEventsTypes
			),		
			/*
			'SHOW_NAV' => array(
				'PARENT' => 'BASE',
				'NAME' => Loc::getMessage('STANDARD_ELEMENTS_LIST_PARAMETERS_SHOW_NAV'),
				'TYPE' => 'CHECKBOX',
				'DEFAULT' => 'N'
			),
			'COUNT' =>  array(
				'PARENT' => 'BASE',
				'NAME' => Loc::getMessage('STANDARD_ELEMENTS_LIST_PARAMETERS_COUNT'),
				'TYPE' => 'STRING',
				'DEFAULT' => '0'
			),
			'SORT_FIELD1' => array(
				'PARENT' => 'BASE',
				'NAME' => Loc::getMessage('STANDARD_ELEMENTS_LIST_PARAMETERS_SORT_FIELD1'),
				'TYPE' => 'LIST',
				'VALUES' => $sortFields
			),
			'SORT_DIRECTION1' => array(
				'PARENT' => 'BASE',
				'NAME' => Loc::getMessage('STANDARD_ELEMENTS_LIST_PARAMETERS_SORT_DIRECTION1'),
				'TYPE' => 'LIST',
				'VALUES' => $sortDirection
			),
			'SORT_FIELD2' => array(
				'PARENT' => 'BASE',
				'NAME' => Loc::getMessage('STANDARD_ELEMENTS_LIST_PARAMETERS_SORT_FIELD2'),
				'TYPE' => 'LIST',
				'VALUES' => $sortFields
			),
			'SORT_DIRECTION2' => array(
				'PARENT' => 'BASE',
				'NAME' => Loc::getMessage('STANDARD_ELEMENTS_LIST_PARAMETERS_SORT_DIRECTION2'),
				'TYPE' => 'LIST',
				'VALUES' => $sortDirection
			),
			*/
			'CACHE_TIME' => array(
				'DEFAULT' => 3600
			)
		)
	);
}
catch (Main\LoaderException $e)
{
	ShowError($e -> getMessage());
}
?>