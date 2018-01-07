<?
$APPLICATION->IncludeFile($APPLICATION->GetCurDir()."/lang/".LANGUAGE_ID."/ajax-added.php", Array(), Array());
?>

<?= GetMessage("POPUP_TEXT_1"); ?> -<br/>
<?
$arDiscounts = Helper::getDiscountsDescription();


foreach($arDiscounts as $k => $v) {
    ?>


    <?= GetMessage("POPUP_TEXT_FROM"); ?> <?=$k?> - <?=$v?><br/>

    <?
}

?>

