<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
global $USER;
?>
<?if($USER->IsAuthorized()):?>
    <div class="b-popup__title" style="margin-top: 20px;">
        <?= GetMessage('REG_SUCCESS') ?>
    </div>
<?else:?>
    <div class="b-popup__title"><?= GetMessage('AUTH_REGISTER') ?></div>

    <div class="b-popup__login">
        <div class="b-form">

            <form id="regForm_form" method="post" action="<?= POST_FORM_ACTION_URI ?>" name="regform" enctype="multipart/form-data">
                <?=bitrix_sessid_post()?>
                <?if(!empty($arResult['ERRORS'])):?>
                    <?
                    $lines=array();
                    $lines = explode('<br>', $arResult['ERRORS'][0]);
                    $len=count($lines);
                    if(strlen( $lines[$len-1])<2){
                        unset($lines[$len-1]);
                        $len-=1;
                    }
                    if($len>1){
                        unset($lines[$len-1]);
                    }
                    ?>
                    <?foreach($lines as $arMessage):?>
                        <div class="b-form__row _is-errors">
                            <label class="b-form__row-label"></label>
                            <div class="b-form__row-input">
                                <div class="b-form__row-error">
                                    <?=str_replace(GetMessage('REGISTER_LOGIN'), GetMessage('REGISTER_FIELD_EMAIL'), $arMessage)?>
                                </div>
                            </div>
                        </div>
                     <?endforeach?>
                <?endif?>
                <div class="b-form__row ">
                    <label class="b-form__row-label"><?= GetMessage('REGISTER_FIELD_NAME') ?>:</label>

                    <div class="b-form__row-input">
                        <input name="REGISTER[NAME]" type="text" class="b-form__input" autocomplete="on"/>

                        <div class="b-form__row-error"><?= GetMessage('REGISTER_LOGIN_ERROR') ?></div>
                    </div>
                </div>
                <div class="b-form__row _is-required
                    <?if(!check_email($arResult['VALUES']['LOGIN']) && !empty($arResult['VALUES']['LOGIN'])):?>
                    _is-errors
                    <?endif?>
                    ">
                    <label class="b-form__row-label"><?= GetMessage('REGISTER_FIELD_EMAIL') ?>:</label>

                    <div class="b-form__row-input">
                        <input name="REGISTER[LOGIN]" type="text" placeholder="mail@mail.com" autocomplete="on"
                               value="<?= $arResult["VALUES"]['LOGIN'] ?>"
                               class="b-form__input"/>

                        <div class="b-form__row-error"><?= GetMessage('REGISTER_EMAIL_ERROR') ?></div>
                    </div>
                </div>
                <div class="b-form__row _is-required
                 <?if((count($arResult['ERRORS'])>0 && empty($arResult['VALUES']['PASSWORD']))||
                        ($arResult['VALUES']['PASSWORD']!==$arResult['VALUES']['CONFIRM_PASSWORD'])):?>
                        _is-errors
                 <?endif?>
                ">
                    <label class="b-form__row-label"><?= GetMessage('REGISTER_FIELD_PASSWORD') ?>:</label>

                    <div class="b-form__row-input">
                        <input type="password"
                               name="REGISTER[PASSWORD]"
                               value="<?= $arResult["VALUES"]['PASSWORD'] ?>"
                               autocomplete="off"
                               placeholder="<?= GetMessage('REGISTER_PASSWORD_LENGTH') ?>"
                               class="b-form__input"/>

                        <div class="b-form__row-error"><?= GetMessage('REGISTER_PASSWORD_ERROR') ?></div>
                    </div>
                </div>

                <div class="b-form__row _is-required
                             <?if((count($arResult['ERRORS'])>0 && empty($arResult['VALUES']['PASSWORD']))||
                                    ($arResult['VALUES']['PASSWORD']!==$arResult['VALUES']['CONFIRM_PASSWORD'])):?>
                                    _is-errors
                            <?endif?>
                ">
                    <label class="b-form__row-label"><?= GetMessage('REGISTER_FIELD_CONFIRM_PASSWORD') ?>:</label>

                    <div class="b-form__row-input">
                        <input type="password"
                               name="REGISTER[CONFIRM_PASSWORD]"
                               value="<?= $arResult["VALUES"]['CONFIRM_PASSWORD'] ?>"
                               autocomplete="off"
                               placeholder="<?= GetMessage('REGISTER_PASSWORD_LENGTH') ?>"
                               class="b-form__input"/>

                        <div class="b-form__row-error"><?= GetMessage('REGISTER_PASSWORD_ERROR') ?></div>
                    </div>
                </div>

                <div class="b-form__row ">
                    <div class="b-form__row-input">
                        <div class="b-form__row-checker">
                            <input id="subcheck" type="checkbox" class="b-form__checkbox" name="subscribe"
                                   checked="checked"/>
                        </div>
                        <label for="subcheck" class="b-form__row-checker-text">
                            <?=GetMessage('REGISTER_SUBSCRIBE');?>
                        </label>

                        <div class="b-form__row-error"><?= GetMessage('EMAIL_ERROR') ?></div>
                    </div>
                </div>
                <div class="b-form__row ">
                    <div class="b-form__row-input">
                        <input type="submit"  name="register_submit_button"  value="<?=GetMessage('REGISTER_BTN');?>" class="btn _full"/>
                        <br/>
                    </div>
                </div>
                <div class="b-form__row ">
                    <div class="b-form__row-input " style="font-size:15px">
                        <span style="color:#bb3025">*</span> <?= GetMessage('REGISTER_REQUIRED_FIELDS') ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?endif;?>





