<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="bx-auth">

	<div class="b-popup__title"><?= GetMessage('AUTH_CHANGE_PASSWORD') ?></div>
	<div class="b-popup__login">
		<div class="b-form">
		</div>
	</div>

<form method="post" action="<?=$arResult["AUTH_FORM"]?>" name="bform">
	<?if (strlen($arResult["BACKURL"]) > 0): ?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
	<? endif ?>
	<input type="hidden" name="AUTH_FORM" value="Y">
	<input type="hidden" name="TYPE" value="CHANGE_PWD">

	<div class="b-form__row ">
		<div class="b-form__row-label"><?=GetMessage("AUTH_LOGIN")?></div>
		<div class="b-form__row-input">
			<input type="text"
				   name="USER_LOGIN"
				   maxlength="50"
				   value="<?=$arResult["LAST_LOGIN"]?>"
				   class="bx-auth-input b-form__input " />
		</div>
	</div>

	<div class="b-form__row ">
		<div class="b-form__row-label"><?=GetMessage("AUTH_CHECKWORD")?></div>
		<div class="b-form__row-input">
			<input type="text"
				   name="USER_CHECKWORD"
				   maxlength="50"
				   value="<?=$arResult["USER_CHECKWORD"]?>"
				   class="bx-auth-input b-form__input" />
		</div>
	</div>

	<div class="b-form__row ">
		<div class="b-form__row-label"><?=GetMessage("AUTH_NEW_PASSWORD_REQ")?></div>
		<div class="b-form__row-input">
			<input type="password"
				   name="USER_PASSWORD"
				   maxlength="50"
				   value="<?=$arResult["USER_PASSWORD"]?>"
				   class="bx-auth-input b-form__input"
				   autocomplete="off" />
		</div>
	</div>

	<div class="b-form__row ">
		<div class="b-form__row-label"><?=GetMessage("AUTH_NEW_PASSWORD_CONFIRM")?></div>
		<div class="b-form__row-input">
			<input type="password"
				   name="USER_CONFIRM_PASSWORD"
				   maxlength="50"
				   value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>"
				   class="bx-auth-input b-form__input"
				   autocomplete="off" />
		</div>
	</div>

	<div class="b-form__row ">
		<div class="b-form__row-label"></div>
		<div class="b-form__row-input">
			<input type="submit" class="btn _full" name="change_pwd" value="<?=GetMessage("AUTH_CHANGE")?>" />
			<br/>
		</div>
	</div>


</form>
</div>