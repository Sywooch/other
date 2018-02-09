<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");

global $USER;

CModule::AddAutoloadClasses(
    'softeffect.iblockcopy',
    array(
        'CXlsProfile' => 'classes/mysql/CXlsProfile.php',
        'CupblockHelper' => 'classes/general/CupblockHelper.php',
        )
);

IncludeModuleLangFile(__FILE__);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");

set_time_limit(0);

/**
 * Обработка запросов от Профиля
 */

/**
 * Определяем текущий Шаг
 */
if ($_REQUEST['backButton2']) {
	$XLS_STEP = 1;
	
	
}
else {
	if (isset($_REQUEST['XLS_STEP'])) {
		
		$XLS_STEP = (int)$_REQUEST['XLS_STEP'];
		
		if (isset($_REQUEST['backButton'])) {
			$XLS_STEP -= 2; 
		}
		
		$USER->SetParam('XLS_STEP', $XLS_STEP);
	}
	else {
		
		
		if (!$XLS_STEP) {
			$XLS_STEP = 1;
		}
	}
}








if ($XLS_STEP > 1) {
	if (!$upblock_tip_is) {
		$strError .= GetMessage("IBLOCK_COPY_ERROR_UPBLOCK");
		$XLS_STEP = 1;
	}
	}
if ($XLS_STEP > 1) {
	if (!$upblock_block_is) {
		$strError .= GetMessage("IBLOCK_COPY_ERROR1_UPBLOCK");
		$XLS_STEP = 1;
	}
	}
if ($XLS_STEP > 1) {
	if (!$upblock_tip_in) {
		$strError .= GetMessage("IBLOCK_COPY_ERROR2_UPBLOCK");
		$XLS_STEP = 1;
	}
	}
/*if ($XLS_STEP >= 1) {
	if (!$upblock_block_in) {
		$strError .= "\nНе выбран инфоблок в который копировать";
		$XLS_STEP = 1;
	}	
	}*/
	





$APPLICATION->SetTitle(GetMessage("IBLOCK_ADM_IMP_PAGE_TITLE").$XLS_STEP);

?>
<style>
table.xls_table_property tr td, table.xls_table_property th{
	border-right:1px solid #cacaca;
	border-bottom:1px solid #cacaca;
}
table.xls_table_property th{
	font-size:14px;
	padding:3px;
	width:250px;
}

table.xls_table_property tr:hover td {
	background-color:rgb(254, 255, 202);
}
table.xls_table_property tr td {
	padding-top:3px;
	padding-bottom:3px;
}
</style>
<?

CAdminMessage::ShowMessage($strError);

?>
<form method="POST" action="<?echo $sDocPath?>?lang=<?echo LANG ?>" ENCTYPE="multipart/form-data" name="dataload" id="dataload">

<?
$aTabs = array(
	array("DIV" => "edit1", "TAB" => GetMessage("IBLOCK_ADM_IMP_TAB1"), "ICON" => "iblock", "TITLE" => GetMessage("IBLOCK_ADM_IMP_TAB1_ALT")),
	array("DIV" => "edit2", "TAB" => GetMessage("IBLOCK_ADM_IMP_TAB2"), "ICON" => "iblock", "TITLE" => GetMessage("IBLOCK_ADM_IMP_TAB2_ALT")),
	
);

$tabControl = new CAdminTabControl("tabControl", $aTabs, false);
$tabControl->Begin();

$tabControl->BeginNextTab();
if ($XLS_STEP == 1) {
	require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/softeffect.iblockcopy/admin/upblock_step_1.php');
}
$tabControl->EndTab();


$tabControl->BeginNextTab();
if ($XLS_STEP == 2) {
	require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/softeffect.iblockcopy/admin/upblock_step_2.php');
}
$tabControl->EndTab();




$tabControl->Buttons();
?>

<?if ($XLS_STEP < 2):?>
	<input type="hidden" name="XLS_STEP" value="<?=$XLS_STEP + 1;?>">
	<?=bitrix_sessid_post()?>

	<?if ($XLS_STEP > 1):?>
		<input type="submit" name="backButton2" value="<?echo GetMessage("UPLOAD_ELSE") ?>">	
		<input type="submit" name="backButton" value="&lt;&lt; <?echo GetMessage("IBLOCK_ADM_IMP_BACK") ?>">
	<?endif?>
	
	<input type="submit" value="<?echo ($XLS_STEP==4)?GetMessage("IBLOCK_ADM_IMP_NEXT_STEP_F"):GetMessage("IBLOCK_ADM_IMP_NEXT_STEP") ?> &gt;&gt;" name="submit_btn">

<?else:?>
	<input type="submit" name="backButton2" value="<?echo GetMessage("UPLOAD_ELSE") ?>">
	<!--<input type="submit" name="intoIblock" value="<?//echo GetMessage("INTO_IBLOCK") ?>">-->
<?endif;?>

<?
$tabControl->End();
?>

</form>

<script language="JavaScript">
<!--
<?if ($XLS_STEP < 2):?>
	tabControl.SelectTab("edit1");
	tabControl.DisableTab("edit2");

<?elseif ($XLS_STEP == 2):?>
	tabControl.SelectTab("edit2");
	tabControl.DisableTab("edit1");
	
<?endif;?>
//-->
</script>

<?
require($DOCUMENT_ROOT."/bitrix/modules/main/include/epilog_admin.php");
?>
