<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
//pred($arResult);
?>
<div class="carrier-block">
    <div class="carrier-center">
        <?
        /*
        <div style="text-align: center;">
            <div class="notify-green">
                <p>
                    Доступно
                </p>
                <p style="font-size: 18px;">
                    4 SMS
                </p>
            </div>
        </div>
        
        <p style="text-align: center;"><a class="notify-buy" href="#">Купить</a></p>
        */
        ?>
        
        <form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
            <?=$arResult["BX_SESSION_CHECK"]?>
            
            <input type="hidden" name="lang" value="<?=LANG?>" />
            <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
            
            <input type="hidden" name="EMAIL" maxlength="50" value="<? echo $arResult["arUser"]["EMAIL"]?>" />
            <input type="hidden" name="LOGIN" maxlength="50" value="<? echo $arResult["arUser"]["LOGIN"]?>" />
            
            <h1>Настройки уведомлений о новых заказах</h1>
            
            <?
//            pred(array(intval($arResult['arUser']['UF_SEND_NOTIFY'])));
            ShowError($arResult["strProfileError"]);
            if ($arResult['DATA_SAVED'] == 'Y')
            {
                ShowNote(GetMessage('PROFILE_DATA_SAVED'));
                echo "<br/>";
            }
            ?>
            
            <?
            /*
            <p>Для того чтобы включить SMS уведомления необходимо подтвердить мобильный телефон</p>
            */
            ?>
            
            <p>
            <label class="label_check <?if (intval($arResult['arUser']['UF_SEND_NOTIFY']) == 1):?>c_on<?endif?>" for="UF_SEND_NOTIFY">
            <input type="hidden" value="0" name="UF_SEND_NOTIFY" />
            <input id="UF_SEND_NOTIFY" name="UF_SEND_NOTIFY" value="1" <?if (intval($arResult['arUser']['UF_SEND_NOTIFY']) == 1):?>checked="checked"<?endif?> type="checkbox" />Уведомлять меня по e-mail о новых заказах
            </label>
            </p>
            
            <p>
            <label class="label_check <?if (intval($arResult['arUser']['UF_ADDITIONAL_NOTIFY']) == 1):?>c_on<?endif?>" for="UF_ADDITIONAL_NOTIFY">
            <input type="hidden" value="0" name="UF_ADDITIONAL_NOTIFY" />
            <input id="UF_ADDITIONAL_NOTIFY" name="UF_ADDITIONAL_NOTIFY" value="1" <?if (intval($arResult['arUser']['UF_ADDITIONAL_NOTIFY']) == 1):?>checked="checked"<?endif?> type="checkbox" />Получать дополнительные уведомления о заказах без ставок
            </label>
            </p>
            
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:system.field.edit",
                $arResult['USER_PROPERTIES']['DATA']['UF_PERIODICAL']['USER_TYPE']['USER_TYPE_ID'],
                array(
                    "bVarsFromForm" => $arResult["bVarsFromForm"], 
                    "arUserField" => $arResult['USER_PROPERTIES']['DATA']['UF_PERIODICAL']
                ), 
                null, 
                array(
                    "HIDE_ICONS" => "Y"
                )
            );
            ?>
            
            <h1>Уведомления о победе</h1>
            <p>
            <label class="label_check <?if (intval($arResult['arUser']['UF_WIN_NOTIFY_EMAIL']) == 1):?>c_on<?endif?>" for="UF_WIN_NOTIFY_EMAIL">
            <input type="hidden" value="0" name="UF_WIN_NOTIFY_EMAIL" />
            <input id="UF_WIN_NOTIFY_EMAIL" name="UF_WIN_NOTIFY_EMAIL" value="1" <?if (intval($arResult['arUser']['UF_WIN_NOTIFY_EMAIL']) == 1):?>checked="checked"<?endif?> type="checkbox" />по E-Mail
            </label>
            </p>
            <p>
            <label class="label_check <?if (intval($arResult['arUser']['UF_WIN_NOTIFY_SMS']) == 1):?>c_on<?endif?>" for="UF_WIN_NOTIFY_SMS">
            <input type="hidden" value="0" name="UF_WIN_NOTIFY_SMS" />
            <input id="UF_WIN_NOTIFY_SMS" name="UF_WIN_NOTIFY_SMS" value="1" <?if (intval($arResult['arUser']['UF_WIN_NOTIFY_SMS']) == 1):?>checked="checked"<?endif?> type="checkbox" />по SMS (бесплатно) - требуется подтверждение телефона
            </label>
            </p>
            
            <h1>Уведомления о новых комментариях заказчиков</h1>
            <p>
            <label class="label_check <?if (intval($arResult['arUser']['UF_COMMENT_EMAIL']) == 1):?>c_on<?endif?>" for="UF_COMMENT_EMAIL">
            <input type="hidden" value="0" name="UF_COMMENT_EMAIL" />
            <input id="UF_COMMENT_EMAIL" name="UF_COMMENT_EMAIL" value="1" <?if (intval($arResult['arUser']['UF_COMMENT_EMAIL']) == 1):?>checked="checked"<?endif?> type="checkbox" />по E-Mail
            </label>
            </p>
            <p>
            <label class="label_check <?if (intval($arResult['arUser']['UF_COMMENT_SMS']) == 1):?>c_on<?endif?>" for="UF_COMMENT_SMS">
            <input type="hidden" value="0" name="UF_COMMENT_SMS" />
            <input id="UF_COMMENT_SMS" name="UF_COMMENT_SMS" value="1" <?if (intval($arResult['arUser']['UF_COMMENT_SMS']) == 1):?>checked="checked"<?endif?> type="checkbox" />по SMS (бесплатно) - требуется подтверждение телефона
            </label>
            </p>
            
            <h1>Дополнительные уведомления</h1>
            <p>
            <label class="label_check <?if (intval($arResult['arUser']['UF_ADD_END_NOTIFY']) == 1):?>c_on<?endif?>" for="UF_ADD_END_NOTIFY">
            <input type="hidden" value="0" name="UF_ADD_END_NOTIFY" />
            <input id="UF_ADD_END_NOTIFY" name="UF_ADD_END_NOTIFY" value="1" <?if (intval($arResult['arUser']['UF_ADD_END_NOTIFY']) == 1):?>checked="checked"<?endif?> type="checkbox" />Уведомлять меня о завершенных торгах с моим участием
            </label>
            </p>
            <p>
            <label class="label_check <?if (intval($arResult['arUser']['UF_EMAIL_SUBSCRIBE']) == 1):?>c_on<?endif?>" for="UF_EMAIL_SUBSCRIBE">
            <input type="hidden" value="0" name="UF_EMAIL_SUBSCRIBE" />
            <input id="UF_EMAIL_SUBSCRIBE" name="UF_EMAIL_SUBSCRIBE" value="1" <?if (intval($arResult['arUser']['UF_EMAIL_SUBSCRIBE']) == 1):?>checked="checked"<?endif?> type="checkbox" />Получать новостные e-mail рассылки от MURAVEY.BY
            </label>
            </p>
            
            <p style="text-align: center;">
                <input type="submit" name="save" class="submit" id="submit" value="Сохранить настройки"/>
            </p>
        </form>
    </div>
</div>
<!-- .content -->
<script type="text/javascript">
$(document).ready(function()
{
    $('.label_check').click(function(e)
    {
        e.preventDefault();
    
        if ($(this).hasClass('c_on'))
        {
            $(this).removeClass('c_on');
            $(this).find('input[type=checkbox]').attr('checked', false).change();
        }
        else
        {
            $(this).addClass('c_on');
            $(this).find('input[type=checkbox]').attr('checked', true).change();
        }
        
        return false; 
    });
});
</script>