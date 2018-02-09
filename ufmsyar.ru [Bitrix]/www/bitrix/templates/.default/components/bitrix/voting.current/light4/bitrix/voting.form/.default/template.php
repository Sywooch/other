<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<div style="width:100%; height:20px;"></div>
<div class="hr-title" style="background-color:transparent; border:0px !important;">
<h2  style="font-weight:bold; color:#800d0d;">Опрос <!--<?=$arParams["TITLE_BLOCK"];?>--></h2></div>
<?
if (!empty($arResult["ERROR_MESSAGE"])): 
?>
<div class="vote-note-box vote-note-error">
	<div class="vote-note-box-text"><?=ShowError($arResult["ERROR_MESSAGE"])?></div>
</div>
<?
endif;

if (!empty($arResult["OK_MESSAGE"])): 
?>
<div class="vote-note-box vote-note-note">
	<div class="vote-note-box-text"><?=ShowNote($arResult["OK_MESSAGE"])?></div>
</div>
<?
endif;

if (empty($arResult["VOTE"])):
	return false;
elseif (empty($arResult["QUESTIONS"])):
	return true;
endif;

?>
<div align="left" class="voting-form-box" style="background-color:transparent; padding-left:5px; padding-right:5px;">
<form action="<?=POST_FORM_ACTION_URI?>" method="post" class="vote-form">
	<?=bitrix_sessid_post()?>
	<input type="hidden" name="vote" value="Y"/>
	<input type="hidden" name="PUBLIC_VOTE_ID" value="<?=$arResult["VOTE"]["ID"]?>"/>
	<input type="hidden" name="VOTE_ID" value="<?=$arResult["VOTE"]["ID"]?>"/>
	
<div class="vote-question-item">
<?
	$iCount = 0;
	foreach ($arResult["QUESTIONS"] as $arQuestion):
		$iCount++;

?>

<div style="width:100%; height:25px;"></div>
		<div class="vote-item-title" ><h2 style="font-size:10pt; font-style:italic; color:#800d0d;"><?=$arQuestion["QUESTION"]?></h2></div>
		
		<div class="vote-answers-list" style="margin-right:0px !important; 
margin-left:0px; color:#800d0d;">
		<table class="vote-answers-list" cellspacing="0" cellpadding="0" border="0" >
<?
		$iCountAnswers = 0;
		foreach ($arQuestion["ANSWERS"] as $arAnswer):
			$iCountAnswers++;

?>
			

				
			<tr><td class="vote-answer-name" style="border:0 !important;">
<?
			switch ($arAnswer["FIELD_TYPE"]):
					case 0://radio
?>

<?	if($iCountAnswers=='4'){echo'
    <div style="width:100%; height:0px; background-color:transparent;"></div>
	<h2  style="font-size:10pt; font-style:italic; ">Для иностранных граждан:</h2>';};  ?>



						<span class="vote-answer-item vote-answer-item-radio" style="font-size:10pt; font-style:italic;" >
							<input type="radio" name="vote_radio_<?=$arAnswer["QUESTION_ID"]?>" <?
								?>id="vote_radio_<?=$arAnswer["QUESTION_ID"]?>_<?=$arAnswer["ID"]?>" <?
								?>value="<?=$arAnswer["ID"]?>" <?=$arAnswer["FIELD_PARAM"]?> />
							<label for="vote_radio_<?=$arAnswer["QUESTION_ID"]?>_<?=$arAnswer["ID"]?>"><?=$arAnswer["MESSAGE"]?></label>
						</span>
<?
					break;
					case 1://checkbox?>
						<span class="vote-answer-item vote-answer-item-checkbox">
							<input type="checkbox" name="vote_checkbox_<?=$arAnswer["QUESTION_ID"]?>[]" value="<?=$arAnswer["ID"]?>" <?
								?> id="vote_checkbox_<?=$arAnswer["QUESTION_ID"]?>_<?=$arAnswer["ID"]?>" <?=$arAnswer["FIELD_PARAM"]?> />
							<label for="vote_checkbox_<?=$arAnswer["QUESTION_ID"]?>_<?=$arAnswer["ID"]?>"><?=$arAnswer["MESSAGE"]?></label>
						</span>
					<?break?>

					<?case 2://dropdown?>
						<span class="vote-answer-item vote-answer-item-dropdown">
							<select name="vote_dropdown_<?=$arAnswer["QUESTION_ID"]?>" <?=$arAnswer["FIELD_PARAM"]?>>
							<?foreach ($arAnswer["DROPDOWN"] as $arDropDown):?>
								<option value="<?=$arDropDown["ID"]?>"><?=$arDropDown["MESSAGE"]?></option>
							<?endforeach?>
							</select>
						</span>
					<?break?>

					<?case 3://multiselect?>
						<span class="vote-answer-item vote-answer-item-multiselect">
							<select name="vote_multiselect_<?=$arAnswer["QUESTION_ID"]?>[]" <?=$arAnswer["FIELD_PARAM"]?> multiple="multiple">
							<?foreach ($arAnswer["MULTISELECT"] as $arMultiSelect):?>
								<option value="<?=$arMultiSelect["ID"]?>"><?=$arMultiSelect["MESSAGE"]?></option>
							<?endforeach?>
							</select>
						</span>
					<?break?>

					<?case 4://text field?>
						<span class="vote-answer-item vote-answer-item-textfield">
							<label for="vote_field_<?=$arAnswer["ID"]?>"><?=$arAnswer["MESSAGE"]?></label>
							<input type="text" name="vote_field_<?=$arAnswer["ID"]?>" id="vote_field_<?=$arAnswer["ID"]?>" <?
								?>value="" size="<?=$arAnswer["FIELD_WIDTH"]?>" <?=$arAnswer["FIELD_PARAM"]?> /></span>
					<?break?>

					<?case 5://memo?>
						<span class="vote-answer-item vote-answer-item-memo">
							<label for="vote_memo_<?=$arAnswer["ID"]?>"><?=$arAnswer["MESSAGE"]?></label>
							<textarea name="vote_memo_<?=$arAnswer["ID"]?>" id="vote_memo_<?=$arAnswer["ID"]?>" <?
								?><?=$arAnswer["FIELD_PARAM"]?> cols="<?=$arAnswer["FIELD_WIDTH"]?>" <?
								?>rows="<?=$arAnswer["FIELD_HEIGHT"]?>"></textarea>
						</span>
					<?break;
				endswitch;
?>
			</td></tr>
<?
			endforeach;
?>
			<tr>
			<td class="vote-answer-name" style="border:0;"></td></tr>
		</table>
		</div>
</div>
<?
		endforeach;
?>
<div align="center" class="vote-form-box-buttons vote-vote-footer" style="background-color:transparent; margin-left:0px;">
	<span class="vote-form-box-button vote-form-box-button-first">
	<input type="submit" name="vote" value="Проголосовать" 
	style="width:146px; height:31px; border:0 !important; background-color:transparent; color:white; font-weight:bold; 
	font-size:12pt;" 
	class="opros_button"/></span>
	<!--<span class="vote-form-box-button vote-form-box-button-last"><input type="button" name="" onclick="window.location='<?
			?><?=CUtil::JSEscape($APPLICATION->GetCurPageParam("view_result=Y", array("VOTE_ID","VOTING_OK","VOTE_SUCCESSFULL", "view_result")))?>';" <?
			?>value="<?=GetMessage("VOTE_RESULTS")?>"/></span>-->
</div>
</form>

</div>