<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<div class="b-form">
<?if($arResult["AUTH_SERVICES"]):?>
	<div class="bx-auth-title"><?echo GetMessage("AUTH_TITLE")?></div>
<?endif?>
	<div class="bx-auth-note" style="line-height: 40px;"><?=GetMessage("AUTH_PLEASE_AUTH")?></div>

	<form name="form_auth" method="post" target="_top" class="ishop" action="<?=$arResult["AUTH_URL"]?>">

		<input type="hidden" name="AUTH_FORM" value="Y" />
		<input type="hidden" name="TYPE" value="AUTH" />
		<?if (strlen($arResult["BACKURL"]) > 0):?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
		<?endif?>
		<?foreach ($arResult["POST"] as $key => $value):?>
		<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
		<?endforeach?>

        <?if($_REQUEST['TYPE'] == 'AUTH'):?>
            <div class="b-form__row _is-errors">
                <label class="b-form__row-label"></label>
                <div class="b-form__row-input">
                    <div class="b-form__row-error"><?=$arParams["~AUTH_RESULT"]['MESSAGE']?></div>
                </div>
            </div>
        <?endif;?>


        <div class="b-form__row">
            <label class="b-form__row-label"><?= GetMessage('AUTH_LOGIN') ?></label>

            <div class="b-form__row-input">
                <input type="text" class="b-form__input" name="USER_LOGIN" value="<?=$arResult["LAST_LOGIN"]?>"/>
            </div>
        </div>
        <div class="b-form__row ">
            <label class="b-form__row-label"><?= GetMessage('AUTH_PASSWORD') ?></label>
            <div class="b-form__row-input">
                <input type="password" class="b-form__input" name="USER_PASSWORD" autocomplete="off"/>
            </div>
        </div>

        <div class="b-form__row ">
            <div class="b-form__row-input">
                <div class="b-form__row-checker">
                    <input  type="checkbox" class="b-form__checkbox" id="USER_REMEMBER" name="USER_REMEMBER" value="Y"/>
                </div>
                <label for="remcheck" class="b-form__row-checker-text">
                    <?= GetMessage('AUTH_REMEMBER_ME') ?>
                </label>
            </div>
        </div>


        <div class="b-form__row ">
            <div class="b-form__row-label"></div>
            <div class="b-form__row-input">
                <input type="submit" value="<?= GetMessage('AUTH_AUTHORIZE') ?>" placeholder="<?= GetMessage('AUTH_AUTHORIZE') ?>" name="Login" class="btn _full"/>
                <br/>
            </div>
        </div>
	</form>
</div>
<div class="b-form">
    <div>
        <div class="b-form__row ">
            <div class="b-form__row-label"></div>
            <div class="b-form__row-input ">
                <?= GetMessage('AUTH_FIRST_TIME_VISITOR') ?><br/>
                <?= GetMessage('AUTH_FILL_THE_REGISTRATION_FORM') ?><br/><br/>
                <a href="#regForm" class="fancybox regFormLink" style="text-transform: uppercase;">
                    <?= GetMessage('AUTH_REGISTER') ?>
                </a>
                <br/><br/>
                <a id="linkForgotPassword" href="#forgotpasswordForm" class="linkForgotPassword" style="text-transform: uppercase;">
                    <?= GetMessage('AUTH_FORGOT_PASSWORD_2') ?>
                </a>
            </div>
        </div>
    </div>
</div>
<br />
<?if($arResult["AUTH_SERVICES"]):?>
<?
$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "",
	array(
		"AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
		"CURRENT_SERVICE" => $arResult["CURRENT_SERVICE"],
		"AUTH_URL" => $arResult["AUTH_URL"],
		"POST" => $arResult["POST"],
		"SHOW_TITLES" => $arResult["FOR_INTRANET"]?'N':'Y',
		"FOR_SPLIT" => $arResult["FOR_INTRANET"]?'Y':'N',
		"AUTH_LINE" => $arResult["FOR_INTRANET"]?'N':'Y',
	),
	$component,
	array("HIDE_ICONS"=>"Y")
);
?>
<?endif?>
<br />