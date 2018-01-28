<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<div class="image-load-left"></div>
<div class="image-load-right"></div>
<div class="image-load-bg"></div>

<div class="web-blue-tabs-menu" id="web-blue-tabs-menu">

	<ul style="height:70px;">
<?foreach($arResult as $arItem):?>

	<?if ($arItem["PERMISSION"] > "D"):?>
		<li align="center" style="width:62px; height:70px; 
       " <?if ($arItem["SELECTED"]):?> class="selected"<?endif?>>
        <a href="<?=$arItem["LINK"]?>" style="width:62px;">
        <table cellpadding="0" cellspacing="0">
        <tr>
		<td align="center" style="width:62px; height:70px; vertical-align:middle;">
        <a href="<?=$arItem["LINK"]?>"><nobr><?=$arItem["TEXT"]?></nobr></a>
		</td>
		</tr>
		</table>
	    </a>
     </li>
	<?endif?>

<?endforeach?>

	</ul>
</div>
<div class="menu-clear-left"></div>
<?endif?>