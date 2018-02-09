<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

if (!CModule::IncludeModule('advertising')) {
	return;
}

$arTypeFields = Array('-' =>GetMessage('ADV_SELECT_DEFAULT'));
$res = CAdvType::GetList($by, $order, Array('ACTIVE' => 'Y'), $is_filtered, 'Y');
while ($ar = $res->GetNext()) {
	$arTypeFields[$ar['SID']] = '['.$ar['SID'].'] '.$ar['NAME'];
}

$arComponentParameters = array(
	'PARAMETERS' => array(
		'TYPE' => Array(
			'NAME'=>GetMessage('ADV_TYPE'),
			'PARENT' => 'BASE',
			'TYPE'=>'LIST',
			'DEFAULT' => '',
			'VALUES'=>$arTypeFields,
			'ADDITIONAL_VALUES'=>'N'
		),
		'COUNT' => Array(
			'NAME'=>GetMessage('ADV_COUNT'),
			'PARENT' => 'BASE',
			'TYPE'=>'STRING',
			'DEFAULT' => '',
			'COLS' => 5
		),
		'FIX_SHOW' => Array(
			'NAME'=>GetMessage('ADV_FIX_SHOW'),
			'PARENT' => 'BASE',
			'TYPE'=>'CHECKBOX',
			'DEFAULT' => '',
		),
		'CACHE_TIME' => Array('DEFAULT'=>'0'),
	)
);
?>
