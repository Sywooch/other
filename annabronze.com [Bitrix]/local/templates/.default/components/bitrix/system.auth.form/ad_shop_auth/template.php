<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

CJSCore::Init(array("jquery"));
?>
<?if($arParams['LOGOUT']==='Y'):?>
    <form action="<?=$arResult["AUTH_URL"]?>">
        <input type="hidden" name="logout" value="yes" />
        <a href="/personal" class="b-top-auth__link link "><span><?=GetMessage('MY_ACCOUNT')?></span></a>
        <input type="submit" class="b-top-auth__link link logout_butt" name="logout_butt" value="(<?=GetMessage("AUTH_LOGOUT_BUTTON")?>)" />
    </form>
<?elseif ($arResult["FORM_TYPE"] == "login"): ?>
    <div class="b-popup__title"><?= GetMessage('AUTH_LOGIN_BUTTON') ?></div>
    <?if(!$arParams["NO_WRAPPER"]) echo '<div class="b-popup__login">'?>
        <div class="b-form">
            <form name="system_auth_form<?= $arResult["RND"] ?>" method="post" action="<?=$arResult["AUTH_URL"]?>">
                <?= bitrix_sessid_post() ?>
                <input type="hidden" name="firstAuth" value="0"/>
                <?if($arResult["BACKURL"] <> ''):?>
                    <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
                <?endif?>
                <? foreach ($arResult["POST"] as $key => $value): ?>
                    <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"/>
                <? endforeach ?>
                <input type="hidden" name="AUTH_FORM" value="Y"/>
                <input type="hidden" name="AJAX-ACTION" value="AUTH"/>
                <input type="hidden" name="TYPE" value="AUTH"/>
                <?if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'] && $_REQUEST['TYPE'] == 'AUTH'):?>
                    <div class="b-form__row _is-errors">
                        <label class="b-form__row-label"></label>
                        <div class="b-form__row-input">
                            <div class="b-form__row-error"><?=$arResult['ERROR_MESSAGE']['MESSAGE']?></div>
                        </div>
                    </div>
                <?endif?>
                <div class="b-form__row">
                    <label class="b-form__row-label"><?= GetMessage('AUTH_LOGIN') ?>:</label>

                    <div class="b-form__row-input">
                        <input type="text" class="b-form__input" name="USER_LOGIN"/>

                        <div class="b-form__row-error"><?= GetMessage('AUTH_LOGIN_ERROR') ?></div>
                    </div>
                </div>
                <div class="b-form__row ">
                    <label class="b-form__row-label"><?= GetMessage('AUTH_PASSWORD') ?>:</label>
                    <div class="b-form__row-input">
                        <input type="password" class="b-form__input" name="USER_PASSWORD" autocomplete="off"/>
                        <div class="b-form__row-error"><?= GetMessage('AUTH_PASSWORD_ERROR') ?></div>
                    </div>
                </div>
                <div class="b-form__row ">
                    <div class="b-form__row-label"></div>
                    <div class="b-form__row-input">
                        <div class="b-form__row-checker">
                            <input  type="checkbox" class="b-form__checkbox" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y"/>
                        </div>
                        <label for="remcheck" class="b-form__row-checker-text">
                            <?= GetMessage('AUTH_REMEMBER_ME') ?>
                        </label>

                        <div class="b-form__row-error"><?= GetMessage('EMAIL_ERROR') ?></div>
                    </div>
                </div>
                <div class="b-form__row ">
                    <div class="b-form__row-label"></div>
                    <div class="b-form__row-input">
                        <input type="submit" value="<?= GetMessage('AUTH_LOGIN_BUTTON') ?>" placeholder="<?= GetMessage('AUTH_LOGIN_BUTTON') ?>" name="Login" class="btn _full"/>
                        <br/>

                    </div>
                </div>
                <div class="b-form__row ">
                    <div class="b-form__row-label _small-padding"><b>
                            <nobr><?= GetMessage('socserv_as_user_form_1') ?></nobr>
                            <nobr><?= GetMessage('socserv_as_user_form_2') ?>:</nobr>
                        </b></div>
                    <? if ($arResult["AUTH_SERVICES"]): ?>
                        <div class="b-form__row-input">
                            <?$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "ad_shop_icons",
                                array(
                                    "AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
                                    "SUFFIX"=>"form",
                                ),  $component, array("HIDE_ICONS"=>"Y")
                            );
                            ?>
                            <div style="display: none">
                                <?if($arResult["AUTH_SERVICES"]):?>
                                    <?$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "popup",
                                        array(
                                            "AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
                                            "AUTH_URL"=>$arResult["AUTH_URL"],
                                            "POST"=>$arResult["POST"],
                                            "POPUP"=>"Y",
                                            "SUFFIX"=>"form",
                                        ),
                                        $component, array("HIDE_ICONS"=>"Y")
                                    );
                                    ?>
                                <?endif;?>
                            </div>
                        </div>
                    <? endif ?>
                </div>

            </form>

        </div>
    <?if(!$arParams["NO_WRAPPER"]) echo '</div>'?>

    <div class="b-popup__login">
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
    </div>
<?else:?>
    <div class="b-popup__title" style="margin-top: 20px;">
        <?= GetMessage('AUTH_SUCCESS') ?>
    </div>
<?endif;?>