<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
ShowMessage($arParams["~AUTH_RESULT"]);
?>
<?if(empty($_POST)):?>




<div class="b-popup__title"><?= GetMessage('AUTH_FORGOTPASSWORD') ?></div>
<div class="b-popup__descr">  <?=GetMessage('AUTH_FORGOT_PASSWORD_1')?></div>
<div class="b-popup__login">
    <div class="b-form">
        <form name="system_auth_form<?= $arResult["RND"] ?>" method="post" action="<?=$arResult["AUTH_URL"]?>" id="forgotpasswordForm">
            <?= bitrix_sessid_post() ?>
            <div class="b-form__row">
                <label class="b-form__row-label"><?= GetMessage('AUTH_EMAIL') ?>:</label>
                <div class="b-form__row-input">
                    <input type="hidden" name="AUTH_FORM" value="Y">
                    <input type="hidden" name="TYPE" value="SEND_PWD">
                    <input type="text" class="b-form__input" name="USER_EMAIL"/>
                    <div class="b-form__row-error"><?= GetMessage('AUTH_EMAIL_ERROR') ?></div>
                </div>
            </div>
            <div class="b-form__row ">
                <div class="b-form__row-label"></div>
                <div class="b-form__row-input">
                    <input type="submit"
                           value="<?= GetMessage('AUTH_SEND') ?>"
                           placeholder=""
                           name="send_account_info"
                           class="btn _full"
                           style="display: none"
                        />
                    <br/>
                </div>
            </div>

            <div class="b-form__row ">
                <div class="b-form__row-label"></div>
                <div class="b-form__row-input ">

                    <br/><br/>
                    <a id="linkForgotPassword" href="#authForm" class="fancybox" style="text-transform: uppercase;">
                        <?= GetMessage('AUTH_AUTH') ?>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
<?else:?>
    <div class="b-popup__title " style="max-width: 550px; margin-top: 20px;">
        <?= GetMessage('AUTH_CONTROL_STRING_SEND') ?>
    </div>
<?endif?>