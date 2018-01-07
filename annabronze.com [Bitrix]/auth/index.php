<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"); ?>
<? GlOBAL $USER; ?>
<? if (!$USER->IsAuthorized()): ?>
    <div class="b-main">
        <br><br><br>

        <div style="margin-left:100px">
            <? if (!empty($_REQUEST['change_password']) && $_REQUEST['change_password'] === 'yes'): ?>

                <? global $errorMessage ?>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:system.auth.form",
                    "show_errors",
                    Array(
                        "SHOW_ERRORS" => "Y"
                    )
                );
                ?>
                <?
                if ($_REQUEST['TYPE'] == 'CHANGE_PWD') {
                    ShowMessage($errorMessage);
                }

                if (!($_REQUEST['TYPE'] == 'CHANGE_PWD' && $errorMessage['TYPE'] == 'OK')):?>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:system.auth.changepasswd",
                        "ad_change_password",
                        Array()
                    ); ?>
                <? endif; ?>
            <? else: ?>
                <div class="grid-container">
                    <div class="grid-row col-1 col-xm-12 col-s-12"></div>
                    <div class="b-layout__inner-column grid-row col-10 col-s-12">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:system.auth.form",
                            "ad_shop_auth",
                            Array(
                                "NO_WRAPPER" => true,
                                "COMPONENT_TEMPLATE" => "ad_shop_auth",
                                "FORGOT_PASSWORD_URL" => "",
                                "PROFILE_URL" => "",
                                "REGISTER_URL" => "",
                                "SHOW_ERRORS" => "Y",
                                "MENU_CACHE_TYPE" => "N",
                                "MENU_CACHE_TIME" => "0",
                                "AJAX_MODE" => 'Y'
                            )
                        ); ?>

                        <?/*<div class="b-popup__login">
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
                                            <a id="linkForgotPassword" href="#forgotpasswordForm" class="linkForgotPassword"
                                               style="text-transform: uppercase;">
                                                <?= GetMessage('AUTH_FORGOT_PASSWORD_2') ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> */?>
                    </div>
                </div>


            <? endif ?>


        </div>
        <br><br><br>
    </div>
<? else: ?>
    <?
    ShowMessage(array("TYPE" => "OK", "MESSAGE" => "Вы зарегистрированы и успешно авторизовались."));
    LocalRedirect("/personal/"."333");
    ?>
<? endif ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>