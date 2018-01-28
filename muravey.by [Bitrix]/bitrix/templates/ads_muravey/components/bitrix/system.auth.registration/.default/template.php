<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/*
?>
<div class="bx-auth">
<?
ShowMessage($arParams["~AUTH_RESULT"]);
?>
<?if($arResult["USE_EMAIL_CONFIRMATION"] === "Y" && is_array($arParams["AUTH_RESULT"]) &&  $arParams["AUTH_RESULT"]["TYPE"] === "OK"):?>
<p><?echo GetMessage("AUTH_EMAIL_SENT")?></p>
<?else:?>

<?if($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):?>
    <p><?echo GetMessage("AUTH_EMAIL_WILL_BE_SENT")?></p>
<?endif?>
<noindex>
<form method="post" action="<?=$arResult["AUTH_URL"]?>" name="bform">
<?
if (strlen($arResult["BACKURL"]) > 0)
{
?>
    <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?
}
?>
    <input type="hidden" name="AUTH_FORM" value="Y" />
    <input type="hidden" name="TYPE" value="REGISTRATION" />

<table class="data-table bx-registration-table">
    <thead>
        <tr>
            <td colspan="2"><b><?=GetMessage("AUTH_REGISTER")?></b></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?=GetMessage("AUTH_NAME")?></td>
            <td><input type="text" name="USER_NAME" maxlength="50" value="<?=$arResult["USER_NAME"]?>" class="bx-auth-input" /></td>
        </tr>
        <tr>
            <td><?=GetMessage("AUTH_LAST_NAME")?></td>
            <td><input type="text" name="USER_LAST_NAME" maxlength="50" value="<?=$arResult["USER_LAST_NAME"]?>" class="bx-auth-input" /></td>
        </tr>
        <tr>
            <td><span class="starrequired">*</span><?=GetMessage("AUTH_LOGIN_MIN")?></td>
            <td><input type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["USER_LOGIN"]?>" class="bx-auth-input" /></td>
        </tr>
        <tr>
            <td><span class="starrequired">*</span><?=GetMessage("AUTH_PASSWORD_REQ")?></td>
            <td><input type="password" name="USER_PASSWORD" maxlength="50" value="<?=$arResult["USER_PASSWORD"]?>" class="bx-auth-input" />
<?if($arResult["SECURE_AUTH"]):?>
                <span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
                    <div class="bx-auth-secure-icon"></div>
                </span>
                <noscript>
                <span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
                    <div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
                </span>
                </noscript>
<script type="text/javascript">
document.getElementById('bx_auth_secure').style.display = 'inline-block';
</script>
<?endif?>
            </td>
        </tr>
        <tr>
            <td><span class="starrequired">*</span><?=GetMessage("AUTH_CONFIRM")?></td>
            <td><input type="password" name="USER_CONFIRM_PASSWORD" maxlength="50" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" class="bx-auth-input" /></td>
        </tr>
        <tr>
            <td><span class="starrequired">*</span><?=GetMessage("AUTH_EMAIL")?></td>
            <td><input type="text" name="USER_EMAIL" maxlength="255" value="<?=$arResult["USER_EMAIL"]?>" class="bx-auth-input" /></td>
        </tr>
<?// ********************* User properties ***************************************************?>
<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
    <tr><td colspan="2"><?=strlen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?></td></tr>
    <?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
    <tr><td><?if ($arUserField["MANDATORY"]=="Y"):?><span class="starrequired">*</span><?endif;
        ?><?=$arUserField["EDIT_FORM_LABEL"]?>:</td><td>
            <?$APPLICATION->IncludeComponent(
                "bitrix:system.field.edit",
                $arUserField["USER_TYPE"]["USER_TYPE_ID"],
                array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "bform"), null, array("HIDE_ICONS"=>"Y"));?></td></tr>
    <?endforeach;?>
<?endif;?>
<?// ******************** /User properties ***************************************************

    if ($arResult["USE_CAPTCHA"] == "Y")
    {
        ?>
        <tr>
            <td colspan="2"><b><?=GetMessage("CAPTCHA_REGF_TITLE")?></b></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
                <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
            </td>
        </tr>
        <tr>
            <td><span class="starrequired">*</span><?=GetMessage("CAPTCHA_REGF_PROMT")?>:</td>
            <td><input type="text" name="captcha_word" maxlength="50" value="" /></td>
        </tr>
        <?
    }
    ?>
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <td><input type="submit" name="Register" value="<?=GetMessage("AUTH_REGISTER")?>" /></td>
        </tr>
    </tfoot>
</table>
<p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>
<p><span class="starrequired">*</span><?=GetMessage("AUTH_REQ")?></p>

<p>
<a href="<?=$arResult["AUTH_AUTH_URL"]?>" rel="nofollow"><b><?=GetMessage("AUTH_AUTH")?></b></a>
</p>

</form>
</noindex>
<script type="text/javascript">
document.bform.USER_NAME.focus();
</script>

<?endif?>
</div>
*/
?>

<h1 class="reg-h">Вы хотите зарегистрироваться как?</h1>
<ul id="registration">
    <li><a href="" class="bclient" id="bclient-a">Заказчик</a></li>
    <li class="graph"></li>
    <li><a href="" class="btransfer" id="btransfer-a">Перевозчик</a></li>
</ul>
<?
$APPLICATION->IncludeComponent("bitrix:main.register", "client", Array(
    "USER_PROPERTY_NAME" => "",    // Название блока пользовательских свойств
    "SHOW_FIELDS" => array(    // Поля, которые показывать в форме
        0 => "NAME",
        1 => "PERSONAL_PHONE",
        2 => "WORK_COMPANY",
    ),
    "REQUIRED_FIELDS" => array( // Поля, обязательные для заполнения
        0 => "NAME",
        1 => "PERSONAL_PHONE",
        2 => "WORK_COMPANY",
        3 => "",
    ),    
    "AUTH" => "Y",    // Автоматически авторизовать пользователей
    "USE_BACKURL" => "Y",    // Отправлять пользователя по обратной ссылке, если она есть
    "SUCCESS_PAGE" => "/personal/",    // Страница окончания регистрации
    "SET_TITLE" => "Y",    // Устанавливать заголовок страницы
    "USER_PROPERTY" => array(    // Показывать доп. свойства
    )
), false);
?>
<?$APPLICATION->IncludeComponent("spomazanovsky:main.register", "transfer", Array(
    "USER_PROPERTY_NAME" => "",    // Название блока пользовательских свойств
    "SHOW_FIELDS" => array(    // Поля, которые показывать в форме
        0 => "NAME",
        1 => "PERSONAL_PHONE",
        2 => "WORK_COMPANY",
        3 => "UF_DEFAULT_REGION",
        4 => "UF_TRANSPORTER_TYPE",
        5 => "UF_TRANSPORT_DESC",
        6 => "UF_TRANSPORT_BODY",
        7 => "UF_TRANSPORT_CAPAC",
        8 => "UF_DOCUMENT",
        9 => "UF_CAR_PHOTO",
    ),
    "REQUIRED_FIELDS" => array( // Поля, обязательные для заполнения
        0 => "NAME",
        1 => "PERSONAL_PHONE",
        2 => "WORK_COMPANY",
        3 => "UF_DEFAULT_REGION",
        4 => "UF_TRANSPORTER_TYPE",
        5 => "UF_TRANSPORT_DESC",
        6 => "UF_TRANSPORT_BODY",
        7 => "UF_TRANSPORT_CAPAC",
        8 => "",
    ),
    "AUTH" => "Y",    // Автоматически авторизовать пользователей
    "USE_BACKURL" => "Y",    // Отправлять пользователя по обратной ссылке, если она есть
    "SUCCESS_PAGE" => "/personal/",    // Страница окончания регистрации
    "SET_TITLE" => "Y",    // Устанавливать заголовок страницы
    "USER_PROPERTY" => array(    // Показывать доп. свойства
        0 => "UF_DEFAULT_REGION",
        1 => "UF_TRANSPORTER_TYPE",
        2 => "UF_TRANSPORT_DESC",
        3 => "UF_TRANSPORT_BODY",
        4 => "UF_TRANSPORT_CAPAC",
        5 => "UF_DOCUMENT",
        6 => "UF_CAR_PHOTO",
    )
    ),
    false
);?>
