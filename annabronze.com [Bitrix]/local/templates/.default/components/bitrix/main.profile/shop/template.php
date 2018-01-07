<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="b-form__row-errors">
	<?=ShowError($arResult["strProfileError"]);?>
</div>

<div class="b-form__row-success">
	<?
	if ($arResult['DATA_SAVED'] == 'Y')
		echo "".ShowNote(GetMessage('PROFILE_DATA_SAVED'))."";
	?>
</div>


<form class="ishop personal" method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>?" enctype="multipart/form-data">
	<?=$arResult["BX_SESSION_CHECK"]?>
	<input type="hidden" name="lang" value="<?=LANG?>" />
	<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
	<input type="hidden" name="LOGIN" maxlength="50" value="<? echo $arResult["arUser"]["LOGIN"]?>" />

	<div class="b-form__row ">
		<label class="b-form__row-label"><?=GetMessage('FIRST_NAME')?>:</label>
		<div class="b-form__row-input">
			<input type="text" class="b-form__input" id="NAME" name="NAME" maxlength="50" value="<?=$arResult["arUser"]["NAME"]?>">
			<div class="b-form__row-error"></div>
		</div>
	</div>


	<div class="b-form__row ">
		<label class="b-form__row-label"><?=GetMessage('LAST_NAME')?></label>
		<div class="b-form__row-input">
			<input type="text" class="b-form__input" id="LAST_NAME" name="LAST_NAME" maxlength="50"
				   value="<?=$arResult["arUser"]["LAST_NAME"]?>">
			<div class="b-form__row-error"></div>
		</div>
	</div>

	<div class="b-form__row ">
		<label class="b-form__row-label"><?=GetMessage('PERSONAL_LOGIN')?><span class="starrequired">*</span>:</label>
		<div class="b-form__row-input">
			<input type="text" class="b-form__input" id="LOGIN" name="LOGIN" maxlength="50"
				   value="<?=$arResult["arUser"]["LOGIN"]?>">
			<div class="b-form__row-error"></div>
		</div>
	</div>

	<div class="b-form__row ">
		<label class="b-form__row-label"><?=GetMessage('EMAIL')?><span class="starrequired">*</span>:</label>
		<div class="b-form__row-input">
			<input type="text" class="b-form__input" id="EMAIL" name="EMAIL" maxlength="50"
				   value="<?=$arResult["arUser"]["EMAIL"]?>">
			<div class="b-form__row-error"></div>
		</div>
	</div>

	<div class="b-form__row ">
		<label class="b-form__row-label"><?=GetMessage('USER_PHONE')?></label>
		<div class="b-form__row-input">
			<input type="text" class="b-form__input" id="PERSONAL_PHONE" name="PERSONAL_PHONE" maxlength="255"
				   value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>">
			<div class="b-form__row-error"></div>
		</div>
	</div>


	<div class="b-form__row ">
		<label class="b-form__row-label"><?=GetMessage('USER_BIRTHDAY_DT')?>:</label>
		<div class="b-form__row-input">





			<?$APPLICATION->IncludeComponent(
				'bitrix:main.calendar',
				'shop',
				array(
					'SHOW_INPUT' => 'Y',
					'FORM_NAME' => 'form1',
					'INPUT_NAME' => 'PERSONAL_BIRTHDAY',
					'INPUT_VALUE' => $arResult["arUser"]["PERSONAL_BIRTHDAY"],
					'SHOW_TIME' => 'N'
				),
				null,
				array('HIDE_ICONS' => 'Y')
			);?>

		</div>
	</div>







	<div class="change_password">

		<div class="b-form__row ">
			<label class="b-form__row-label"><?=GetMessage('NEW_PASSWORD')?></label>
			<div class="b-form__row-input">
				<input type="password" class="b-form__input bx-auth-input" id="NEW_PASSWORD" name="NEW_PASSWORD" maxlength="50"
					   autocomplete="off"
					   value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>">
				<div class="b-form__row-error"></div>
			</div>
		</div>

		<div class="b-form__row ">
			<label class="b-form__row-label"><?=GetMessage('NEW_PASSWORD_CONFIRM')?></label>
			<div class="b-form__row-input">
				<input type="password" class="b-form__input bx-auth-input" id="NEW_PASSWORD_CONFIRM" name="NEW_PASSWORD_CONFIRM"
					   maxlength="50"
					   autocomplete="off"
					   value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>">
				<div class="b-form__row-error"></div>
			</div>
		</div>



	</div>
	<br>

	<button type="submit" name="save" value="<?=GetMessage("MAIN_SAVE")?>" class="button b btn _full">
		<span><?=GetMessage('MAIN_SAVE')?></span>
	</button>




</form>

