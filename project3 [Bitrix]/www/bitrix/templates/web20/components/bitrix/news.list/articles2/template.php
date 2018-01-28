<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="news-list">

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>


<?foreach($arResult["ITEMS"] as $arItem):?> <!--foreach-->

<div style="width:100%;"><!--style="width:100%;"-->

<table  cellpadding="0" cellspacing="0" ><!--cellpadding="0" cellspacing="0" -->
<tr>
<td style="width:100px; background-color:transparent; vertical-align:top;">


<div style="width:100px; height:100px; background-color:transparent; 
margin-bottom:20px; background-image:url(/images/persona.png);
background-position:top center; background-repeat:no-repeat;">
<div style="width:100px; height:70px;"></div>
<div align="center" style="width:100px; height:30px;">
	<span style="font-size:8pt; color:black; ">Пользователь</span>
</div>

</div>



</td>
	<td style="width:670px; background-color:transparent; vertical-align:top;"><!--width:670px; background-color:green; vertical-align:top;-->

		<div style="width:100%; height:20px;"></div>


<p class="news-item" ><!-- class="news-item" -->
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
		<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img class="preview_picture" border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"  
			alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["NAME"]?>" <? if($arItem["PREVIEW_PICTURE"]["WIDTH"]>600){ echo' width="600" '; }  ?>  /></a>
		<?endif?>

		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><b><?echo $arItem["NAME"]?></b></a><br />
			<?else:?>
				<b><?echo $arItem["NAME"]?></b><br />
			<?endif;?>
		<?endif;?>
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<?echo $arItem["PREVIEW_TEXT"];?>
		<?endif;?>
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<div style="clear:both"></div>
		<?endif?>
	<hr size="1" style="background:#f68220;"/>

       <div style="height:27px; background-color:transparent;"><!--height:27px; background-color:transparent;-->
		<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
			<br /><span class="news-date-time"  style="color:black;"><img src="<?=$templateFolder?>/images/clocks.gif" width="9" 
			height="9" border="0" alt="">&nbsp;<?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
		<?endif?>

		<?if (isset($arItem["DISPLAY_PROPERTIES"]["FORUM_MESSAGE_CNT"])):?>

        <span class="news-date-time" style="color:black;"><img src="<?=$templateFolder?>/images/comments.gif"  border="0" alt="" 
		style="float:left; "> 
			<table cellpadding="0" cellspacing="0" style="float:left;">
        <tr>
        <td style="vertical-align:middle; height:27px; " align="center">

        <span><?=$arItem["DISPLAY_PROPERTIES"]["FORUM_MESSAGE_CNT"]["VALUE"]?>&nbsp;комментариев</span>

        </td>
        </tr>
        </table></span>
		<?endif?>

		<?if (isset($arItem["DISPLAY_PROPERTIES"]["rating"])):?>
	<span class="news-date-time" style="color:black;"><img src="<?=$templateFolder?>/images/rating.gif"  border="0" alt="" 
	style="float:left;  margin-left:20px;">


		<table cellpadding="0" cellspacing="0" style="float:left;">
        <tr>
        <td style="vertical-align:middle; height:27px; " align="center">

        <span><?=$arItem["DISPLAY_PROPERTIES"]["rating"]["VALUE"]?>
</span>

        </td><!--width:670px; background-color:green; vertical-align:top;-->
        </tr>
        </table>



</span>


		<?endif?>
</div><!--height:27px; background-color:transparent;-->



</p><!-- class="news-item" -->
	
<div style="width:100%; height:20px;"></div>




</td>
</tr>
</table><!--cellpadding="0" cellspacing="0" -->

</div><!--style="width:100%;"-->

<?endforeach;?> <!--foreach-->

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

</div><!--class="news-list"-->
