<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (!$this->__component->__parent || empty($this->__component->__parent->__name) || $this->__component->__parent->__name != "bitrix:blog"):
	$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/blog/templates/.default/style.css');
	$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/blog/templates/.default/themes/blue/style.css');
endif;
?>
<noindex>
<?
if(strlen($arResult["FATAL_ERROR"])>0)
{
	?>
	<span class='errortext'><?=$arResult["FATAL_ERROR"]?></span><br /><br />
	<?
}
else
{
	if(strlen($arResult["ERROR_MESSAGE"])>0)
	{
		?>
		<span class='errortext'><?=$arResult["ERROR_MESSAGE"]?></span><br /><br />
		<?
	}
	
	if($arResult["bEdit"]=="Y")
	{
		?>
		<form method="post" name="form1" action="<?=POST_FORM_ACTION_URI?>" enctype="multipart/form-data">

			<div class="b-form__row ">
				<label class="b-form__row-label"><?=GetMessage("B_B_USER_ALIAS")?></label>
				<div class="b-form__row-input">
					<input type="text" class="b-form__input" size="47" name="ALIAS" value="<?=$arResult["User"]["ALIAS"]?>">
					<div class="b-form__row-error"></div>
				</div>
			</div>

			<div class="b-form__row ">
				<label class="b-form__row-label"><?=GetMessage("B_B_USER_ABOUT")?></label>
				<div class="b-form__row-input">
					<textarea name="DESCRIPTION" class="b-form__textarea" rows="5"><?=$arResult["User"]["DESCRIPTION"]?></textarea>
				</div>
			</div>

			<div class="b-form__row ">
				<label class="b-form__row-label"><?=GetMessage("B_B_USER_SITE")?></label>
				<div class="b-form__row-input">
					<input type=text size="47" name="PERSONAL_WWW" class="b-form__input"
						   value="<?=$arResult["User"]["PERSONAL_WWW"]?>">
				</div>
			</div>


			<div class="b-form__row ">
				<label class="b-form__row-label"><?=GetMessage("B_B_USER_SEX")?></label>

					<select name="PERSONAL_GENDER">
						<?
						foreach($arResult["arSex"] as $k => $v)
						{
							?>
							<option value="<?=$k?>"<?if($k==$arResult["User"]["PERSONAL_GENDER"]) echo " selected";?>><?=$v?></option>
							<?
						}
						?>
					</select>

			</div>





			<div class="b-form__row ">
				<label class="b-form__row-label"><?=GetMessage("B_B_USER_BIRTHDAY")?></label>
				<?
				$APPLICATION->IncludeComponent(
					'bitrix:main.calendar',
					'user_edit',
					array(
						'SHOW_INPUT' => 'Y',
						'FORM_NAME' => 'form1',
						'INPUT_NAME' => 'PERSONAL_BIRTHDAY',
						'INPUT_VALUE' => $arResult["User"]["PERSONAL_BIRTHDAY"],
						'SHOW_TIME' => 'N'
					),
					null,
					array('HIDE_ICONS' => 'Y')
				);?>
			</div>



			<div class="b-form__row ">
				<label class="b-form__row-label"><?=GetMessage("B_B_USER_PHOTO")?></label>
				<input name="PERSONAL_PHOTO" size="30" type="file">
				<label><input name="PERSONAL_PHOTO_del" value="Y" type="checkbox"><?=GetMessage("BU_DELETE_FILE");?></label>
				<?if ($arResult["User"]["PERSONAL_PHOTO_ARRAY"]!==false):?>
					<br /><?=$arResult["User"]["PERSONAL_PHOTO_IMG"]?>
				<?endif?>
			</div>





			<div class="b-form__row ">
				<label class="b-form__row-label"><?=GetMessage("B_B_USER_AVATAR")?></label>
				<input name="AVATAR" size="30" type="file">
				<label><input name="AVATAR_del" value="Y" type="checkbox"><?=GetMessage("BU_DELETE_FILE");?></label>
				<?if ($arResult["User"]["AVATAR_ARRAY"]!==false):?>
					<br /><?=$arResult["User"]["AVATAR_IMG"]?>
				<?endif?>
			</div>


			<div class="b-form__row ">
				<label class="b-form__row-label"><?=GetMessage("B_B_USER_INTERESTS")?></label>
				<div class="b-form__row-input">
					<textarea name="INTERESTS" rows="5"
							  class="b-form__textarea"><?=$arResult["User"]["INTERESTS"]?></textarea>
				</div>
			</div>




		<?// ********************* User properties ***************************************************?>
		<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
			<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
			<tr><th>
				<?if ($arUserField["MANDATORY"]=="Y"):?>
					<span class="required">*</span>
				<?endif;?>
				<?=$arUserField["EDIT_FORM_LABEL"]?>:</th><td>
					<?$APPLICATION->IncludeComponent(
						"bitrix:system.field.edit", 
						$arUserField["USER_TYPE"]["USER_TYPE_ID"], 
						array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField), null, array("HIDE_ICONS"=>"Y"));?></td></tr>
			<?endforeach;?>
		<?endif;?>
		
		<?// ******************** /User properties ***************************************************?>
			<div class="b-form__row ">

			<b><?=GetMessage("B_B_USER_LAST_AUTH")?></b>

			<span><?=$arResult["User"]["LAST_VISIT_FORMATED"]?></span>

			</div>





		<div class="blog-buttons">
			<input type="hidden" name="BLOG_USER_ID" value="<?=$arResult["BlogUser"]["ID"]?>">
			<input type="hidden" name="ID" value="<?=$arParams["ID"]?>">
			<?=bitrix_sessid_post()?>
			<input type="hidden" name="mode" value="edit">


			<input type="submit" name="save" value="<?=GetMessage("B_B_USER_SAVE")?>"
				   class="btn _full _little-font _big-padding _inline">
			<input type="reset" name="cancel" value="<?=GetMessage("B_B_USER_CANCEL")?>"
				   OnClick="window.location='<?=$arResult["urlToCancel"]?>'"
				   class="btn _full _little-font _big-padding _inline">


		</div>
		</form>
		<?
	}
	else
	{
		if(strlen($arResult["urlToEdit"])>0)
		{
			?>
			<?=GetMessage("B_B_USER_TEXT2")?> <a href="<?=$arResult["urlToEdit"]?>"><?=GetMessage("B_B_USER_TEXT3")?></a>.<br /><br />
			<?
		}
		?>

		<div>
			<b><?=GetMessage("B_B_USER_USER")?></b>	<span><?=$arResult["userName"]?></span>
		</div>



		<?if(strlen($arResult["Blog"]["urlToBlog"])>0):?>

		<div>
			<b><?=GetMessage("B_B_USER_BLOG")?></b>	<a href="<?=$arResult["Blog"]["urlToBlog"]?>"><?=$arResult["Blog"]["NAME"]?></a>
		</div>


		<?endif;?>


		<?if(strlen($arResult["User"]["PERSONAL_WWW"])>0):?>

		<div>
			<b><?=GetMessage("B_B_USER_SITE")?></b>	<a target="blank" href="<?=$arResult["User"]["PERSONAL_WWW"]?>"
														  rel="nofollow"><?=$arResult["User"]["PERSONAL_WWW"]?></a>
		</div>


		<?endif;?>
		<?if(strlen($arResult["User"]["PERSONAL_GENDER"])>0):?>
		<div>
			<b><?=GetMessage("B_B_USER_SEX")?></b>	<span><?=$arResult["arSex"][$arResult["User"]["PERSONAL_GENDER"]]?></span>
		</div>
		<?endif;?>
		<?if(strlen($arResult["User"]["PERSONAL_BIRTHDAY"])>0):?>
		<div>
			<b><?=GetMessage("B_B_USER_BIRTHDAY")?></b>	<span><?=$arResult["User"]["PERSONAL_BIRTHDAY"]?></span>
		</div>
		<?endif;?>
		<?if(IntVal($arResult["User"]["PERSONAL_PHOTO"])>0):?>
		<div>
			<b><?=GetMessage("B_B_USER_PHOTO")?></b>	<span><?=$arResult["User"]["PERSONAL_PHOTO_IMG"]?></span>
		</div>
		<?endif;?>
		<?if(IntVal($arResult["User"]["AVATAR"])>0):?>
		<div>
			<b><?=GetMessage("B_B_USER_AVATAR")?></b>	<span><?=$arResult["User"]["AVATAR_IMG"]?></span>
		</div>
		<?endif;?>
		<?if(count($arResult["User"]["Hobby"])>0):?>

		<div>
			<b><?=GetMessage("B_B_USER_INTERESTS")?></b>	<span><?
				foreach($arResult["User"]["Hobby"] as $k => $v)
				{
					if($k!=0)
						echo ", ";
					?><a href="<?=$v["link"]?>" rel="nofollow"><?=$v["name"]?></a><?
				}
				?></span>
		</div>

		<?endif;?>
		<?// ********************* User properties ***************************************************?>
		<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
			<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
			<th nowrap><?=$arUserField["EDIT_FORM_LABEL"]?>:</th><td>
					<?$APPLICATION->IncludeComponent(
						"bitrix:system.field.view", 
						$arUserField["USER_TYPE"]["USER_TYPE_ID"], 
						array("arUserField" => $arUserField), null, array("HIDE_ICONS"=>"Y"));?></td></tr>			
			<?endforeach;?>
		<?endif;?>
		<?// ******************** /User properties ***************************************************?>
		<div>
			<b><?=GetMessage("B_B_USER_LAST_AUTH")?></b>	<span><?=$arResult["BlogUser"]["LAST_VISIT_FORMATED"]?></span>
		</div>



		<div>
			<b><?=GetMessage("B_B_FR_FR_OF")?></b>	<span><?
				if(count($arResult["User"]["friendsOf"])>0)
				{
					foreach($arResult["User"]["friendsOf"] as $k => $v)
					{
						if($k!=0)
							echo ", ";
						?><a href="<?=$v["link"]?>"><?=$v["name"]?></a><?
					}
				}
				else
				{
					?>
					<i><?=GetMessage("B_B_FR_NO")?></i>
					<?
				}
				?></span>
		</div>


		<div>
			<b><?=GetMessage("B_B_FR_FR")?></b>	<span><?
				if(count($arResult["User"]["friends"])>0)
				{
					foreach($arResult["User"]["friends"] as $k => $v)
					{
						if($k!=0)
							echo ", ";
						?><a href="<?=$v["link"]?>"><?=$v["name"]?></a><?
					}
				}
				else
				{
					?>
					<i><?=GetMessage("B_B_FR_NO")?></i>
					<?
				}
				?></span>
		</div>




		<?
	}
}
?>
</noindex>