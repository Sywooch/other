<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$timeLeft = timeLeft($arResult['DATE_ACTIVE_TO']);
?>
<script type="text/javascript">
$(document).ready(function()
{   
    $('.desc-time-p:eq(0)').html('<?=!empty($arResult['DATE_ACTIVE_TO']) ? $timeLeft : '— (неизвестно)'?>');
});
</script>