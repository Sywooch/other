<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<script>
    <!--
    function ChangeGenerate(val) {
        if (val) {
            document.getElementById("sof_choose_login").style.display = 'none';
        }
        else {
            document.getElementById("sof_choose_login").style.display = 'block';
            document.getElementById("NEW_GENERATE_N").checked = true;
        }

        try {
            document.order_reg_form.NEW_LOGIN.focus();
        } catch (e) {
        }
    }
    //-->
</script>
<div class="grid-row col-1 col-xm-12 col-s-12"></div>
<div class="b-layout__inner-column grid-row col-10 col-s-12">
    <div class="b-layout__info-box">

        <div class="grid-container">
            <div class="grid-row col-6 col-s-12">
                <?
                if(!empty($arResult["ERROR"]))
                {
                    foreach($arResult["ERROR"] as $v)
                        echo ShowError($v);

                    echo "<br />";
                }
                elseif(!empty($arResult["OK_MESSAGE"]))
                {
                    foreach($arResult["OK_MESSAGE"] as $v)
                        echo ShowNote($v);

                    echo "<br />";
                }
                ?>

                <div class="title inline"><? echo GetMessage("STOF_2REG") ?></div>
                <form method="post" action="" name="order_auth_form">
                    <?= bitrix_sessid_post() ?>
                    <?
                    foreach ($arResult["POST"] as $key => $value) {
                        ?>
                        <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"/>
                        <?
                    }
                    ?>
                    <div class="b-form__row">
                        <label class="b-form__row-label"><? echo GetMessage("STOF_LOGIN") ?> <span
                                class="starrequired">*</span></label>

                        <div class="b-form__row-input">
                            <input type="text" name="USER_LOGIN" maxlength="30" size="30" class="b-form__input"
                                   value="<?= $arResult["AUTH"]["USER_LOGIN"] ?>">

                            <div class="b-form__row-error">Invalid E-mail</div>
                        </div>
                    </div>
                    <div class="b-form__row">
                        <label class="b-form__row-label"><? echo GetMessage("STOF_PASSWORD") ?> <span
                                class="starrequired">*</span></label>

                        <div class="b-form__row-input">
                            <input type="password" name="USER_PASSWORD" maxlength="30" size="30" class="b-form__input">

                            <div class="b-form__row-error">Invalid E-mail</div>
                        </div>
                    </div>

                    <div class="b-form__row">
                        <label class="b-form__row-label"></label>

                        <div class="b-form__row-input">
                            <a
                                href="<?= $arParams["PATH_TO_AUTH"] ?>?forgot_password=yes&back_url=<?= urlencode($APPLICATION->GetCurPageParam()); ?>"><? echo GetMessage("STOF_FORGET_PASSWORD") ?></a>
                        </div>
                    </div>
                    <div class="b-form__row">
                        <label class="b-form__row-label"></label>

                        <div class="b-form__row-input">
                            <button class="btn _full" type="submit" value="<?= GetMessage("STOF_NEXT_STEP") ?>">
                                <span><?= GetMessage("STOF_NEXT_STEP") ?></span></button>
                            <input type="hidden" name="do_authorize" value="Y">
                        </div>
                    </div>
                </form>

            </div>
            <div class="grid-row col-6 col-s-12">
                <div class="title inline"><? echo GetMessage("STOF_2REG") ?></div>

                <? if ($arResult["AUTH"]["new_user_registration"] == "Y"): ?>
                    <form method="post" action="" name="order_reg_form">
                        <?= bitrix_sessid_post() ?>
                        <?
                        foreach ($arResult["POST"] as $key => $value) {
                            ?>
                            <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"/>
                            <?
                        }
                        ?>
                        <div class="b-form__row">
                            <label class="b-form__row-label"><? echo GetMessage("STOF_NAME") ?> <span
                                    class="starrequired">*</span></label>

                            <div class="b-form__row-input">
                                <input type="text" name="NEW_NAME" size="40" class="b-form__input"
                                       value="<?= $arResult["AUTH"]["NEW_NAME"] ?>">&nbsp;&nbsp;

                                <div class="b-form__row-error">Invalid E-mail</div>
                            </div>
                        </div>
                        <div class="b-form__row">
                            <label class="b-form__row-label"><? echo GetMessage("STOF_LASTNAME") ?> <span
                                    class="starrequired">*</span></label>

                            <div class="b-form__row-input">
                                <input type="text" name="NEW_LAST_NAME" size="40" class="b-form__input"
                                       value="<?= $arResult["AUTH"]["NEW_LAST_NAME"] ?>">&nbsp;&nbsp;&nbsp;

                                <div class="b-form__row-error">Invalid E-mail</div>
                            </div>
                        </div>
                        <div class="b-form__row">
                            <label class="b-form__row-label">E-Mail <span
                                    class="starrequired">*</span></label>

                            <div class="b-form__row-input">
                                <input type="text" name="NEW_EMAIL" size="40" class="b-form__input"
                                       value="<?= $arResult["AUTH"]["NEW_EMAIL"] ?>">&nbsp;&nbsp;&nbsp;

                                <div class="b-form__row-error">Invalid E-mail</div>
                            </div>
                        </div>
                        <div style="display: none">
                                <input type="radio" id="NEW_GENERATE_Y" name="NEW_GENERATE" value="Y"
                                       OnClick="ChangeGenerate(true)" checked="checked">
                                <label
                                    for="NEW_GENERATE_Y"><? echo GetMessage("STOF_SYS_PASSWORD") ?></label>
                                <script language="JavaScript">
                                    <!--
                                    ChangeGenerate(<?= (($_POST["NEW_GENERATE"] != "N") ? "true" : "false") ?>);
                                    //-->
                                </script>
                        </div>
                        <div class="b-form__row">
                            <label class="b-form__row-label"></label>

                            <div class="b-form__row-input">
                                <button class="btn _full" type="submit"
                                        value="<?= GetMessage("STOF_NEXT_STEP") ?>">
                                    <span><?= GetMessage("STOF_NEXT_STEP") ?></span></button>
                                <input type="hidden" name="do_register" value="Y">

                                <div class="b-form__row-error">Invalid E-mail</div>
                            </div>
                        </div>
                    </form>
                <? endif; ?>
            </div>
        </div>

    </div>
    <hr/>
    <div class="b-layout__info-box">
        <p><?= GetMessage("STOF_REQUIED_FIELDS_NOTE") ?></p>
        <? if ($arResult["AUTH"]["new_user_registration"] == "Y"): ?>
            <p><?= GetMessage("STOF_EMAIL_NOTE") ?></p>
        <? endif; ?>
        <p><?= GetMessage("STOF_PRIVATE_NOTES") ?></p>
        <br/>
    </div>
</div>


