<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
//pred(array($arResult));
if (!empty($arResult["ERRORS"]))
{
    foreach ($arResult["ERRORS"] as $key => $error)
    {
        if ($key == 'CONFIRM_PASSWORD' || $key == 'LOGIN')
        {
            unset($arResult["ERRORS"][$key]);
        }
        else
        {
            if (intval($key) == 0 && $key !== 0) 
                $arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "«".GetMessage("REGISTER_FIELD_".$key)."»", $error);
        }
    }
}
?>
<div id="bclient" <?if (empty($arResult["ERRORS"])):?>style="display: none;"<?endif?>>
    <h1 class="reg-new-h">Регистрация нового заказчика</h1>
    <div style="text-align: center;">
        <?ShowError(implode("<br />", $arResult["ERRORS"]));?>
    </div>
    <form class="registration" method="post" action="<?=$APPLICATION->GetCurPageParam("", array(), false)?>" name="regform">
        <div class="reg-inform">Информация о заказчике</div>
        <p>
            <label for="email">E-mail:<span>*</span></label>
            <input id="EMAIL" type="text" name="REGISTER[EMAIL]" value="<?=$_REQUEST['REGISTER']['EMAIL']?>">
            <input id="LOGIN" type="hidden" name="REGISTER[LOGIN]" value="<?=$_REQUEST['REGISTER']['LOGIN']?>">
        </p>
        <p>
            <label for="nickname">Ник-нейм:<span>*</span></label>
            <input id="nickname" type="text" name="REGISTER[WORK_COMPANY]" class="full" value="<?=$_REQUEST['REGISTER']['WORK_COMPANY']?>">
        </p>
        <p>
            <label for="NAME">Имя:<span>*</span></label>
            <input id="NAME" type="text" name="REGISTER[NAME]" class="full" value="<?=$_REQUEST['REGISTER']['NAME']?>">
        </p>
        <p>
            <label for="phone">Телефон:<span>*</span></label>
            <input id="PERSONAL_PHONE" name="REGISTER[PERSONAL_PHONE]" type="text" value="<?=$_REQUEST['REGISTER']['PERSONAL_PHONE']?>">
        </p>
        <p>
            <label for="PASSWORD">Пароль:<span>*</span></label>
            <input id="PASSWORD" name="REGISTER[PASSWORD]" type="password" value="">
            <input id="CONFIRM_PASSWORD" type="hidden" name="REGISTER[CONFIRM_PASSWORD]" value="" autocomplete="off">
        </p>
        <p class="required">
            Поля помеченные символом * - обязательные для заполнения
        </p>
        <p style="text-align: center;">
            <label style="width: 500px; text-align: left;"><input type="checkbox" id="rules_client">Я ознакомился и принимаю <a href="/terms.php">соглашение об использовании</a></label>
        </p>
        <p style="text-align: center;">
            <input type="submit" id="submit_client" value="Регистрация">
            <input type="submit" style="display: none;" name="register_submit_button" value="Регистрация">
        </p>
        <input type="hidden" name="register" value="yes">
    </form>
</div>

<script type="text/javascript">
$(document).ready(function()
{
    $('#submit_client').click(function(e)
    {
        e.preventDefault();
        
        if (!$('#rules_client:checked').length)
        {
            alert('Необходимо принять соглашение об использовании');
            return false;
        }
        else
            $(this).closest('p').find('input[name=register_submit_button]').click();
    });
    
    $('#EMAIL').on('blur', function()
    {
        curEmail = $('#EMAIL').val();
        $('#LOGIN').val(curEmail);
    });
    
    $('#PASSWORD').on('blur', function()
    {
        curPass = $('#PASSWORD').val();
        $('#CONFIRM_PASSWORD').val(curPass);
    });
});
</script>
<?
/*
if (count($arResult["ERRORS"]) > 0)
{
    foreach ($arResult["ERRORS"] as $key => $error)
    {
        if ($key == 'CONFIRM_PASSWORD')
        {
            unset($arResult["ERRORS"][$key]);
        }
        else
        {
            if (intval($key) == 0 && $key !== 0) 
                $arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "«".GetMessage("REGISTER_FIELD_".$key)."»", $error);
        }
    }
    
    if ($_REQUEST['whole_sale'] == 'yes')
    {
        if (empty($_REQUEST['UF_COMPANY_NAME']))
        {
            $arResult["ERRORS"]['UF_COMPANY_NAME'] = "Поле «Название компании» обязательно для заполнения";    
        }
        if (empty($_REQUEST['UF_LEGAL_ADDRESS']))
        {
            $arResult["ERRORS"]['UF_LEGAL_ADDRESS'] = "Поле «Юридический адрес» обязательно для заполнения";    
        }
        if (empty($_REQUEST['UF_INN']))
        {
            $arResult["ERRORS"]['UF_INN'] = "Поле «ИНН» обязательно для заполнения";    
        }
        if (empty($_REQUEST['UF_KPP']))
        {
            $arResult["ERRORS"]['UF_KPP'] = "Поле «КПП» обязательно для заполнения";    
        }
        if (empty($_REQUEST['UF_PAYMENT_ACCOUNT']))
        {
            $arResult["ERRORS"]['UF_PAYMENT_ACCOUNT'] = "Поле «Расчётный счёт» обязательно для заполнения";    
        }
        if (empty($_REQUEST['UF_CONTACT_PERSON']))
        {
            $arResult["ERRORS"]['UF_CONTACT_PERSON'] = "Поле «Контактное лицо» обязательно для заполнения";    
        }
    }
}    
?>

<br/>
<?ShowError(implode("<br />", $arResult["ERRORS"]));?>
<form id="form_reg" method="post" action="/kabinet/korzina/zakaz/" name="regform" enctype="multipart/form-data">
    <table class="reg">
        <tbody>
            <tr>
                <td width="162" rowspan="7" class="no-b-b"></td>
                <td>
                    <label for="LAST_NAME">Ф.И.О.:</label>
                    <input id="LAST_NAME" type="text" name="REGISTER[LAST_NAME]" class="full" value="<?=$_REQUEST['REGISTER']['LAST_NAME']?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="LOGIN">Логин:</label>
                    <input id="LOGIN" type="text" name="REGISTER[LOGIN]" value="<?=$_REQUEST['REGISTER']['LOGIN']?>">
                    <label for="PASSWORD">Пароль:</label>
                    <input id="PASSWORD" name="REGISTER[PASSWORD]" type="password" value="">
                    <input id="CONFIRM_PASSWORD" type="hidden" name="REGISTER[CONFIRM_PASSWORD]" value="" autocomplete="off">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="EMAIL">E-mail:</label>
                    <input id="EMAIL" type="text" name="REGISTER[EMAIL]" value="<?=$_REQUEST['REGISTER']['EMAIL']?>">
                    <label for="PERSONAL_PHONE">Телефон:</label>
                    <input id="PERSONAL_PHONE" name="REGISTER[PERSONAL_PHONE]" type="text" value="<?=$_REQUEST['REGISTER']['PERSONAL_PHONE']?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="PERSONAL_COUNTRY">Страна:</label>
                    <div class="list_box gray w200 country">
                        <span class="ico i-arr-b white"></span>
                        <span class="ico i-arr-b"></span>
                        <div class="selected">Страна</div>
                        <div class="scroll country">
                            <ul>
                            <?foreach ($arResult["COUNTRIES"]["reference_id"] as $key => $value):?>
                                <li><a href="<?=$value?>"><?=$arResult["COUNTRIES"]["reference"][$key]?></a></li>
                            <?endforeach?>                                    
                            </ul>
                            <input id="PERSONAL_COUNTRY" type="hidden" name="REGISTER[PERSONAL_COUNTRY]" value="">
                        </div>
                    </div>
                    <!--<input id="PERSONAL_COUNTRY" type="hidden" name="REGISTER[PERSONAL_COUNTRY]" value="Россия">-->
                    <label for="PERSONAL_ZIP" class="postal_index">Индекс:</label>
                    <input id="PERSONAL_ZIP" class="postal_index" type="text" name="REGISTER[PERSONAL_ZIP]" value="<?=$_REQUEST['REGISTER']['PERSONAL_ZIP']?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="PERSONAL_STREET">Адрес:</label>
                    <input id="PERSONAL_STREET" type="text" name="REGISTER[PERSONAL_STREET]" class="full" value="<?=$_REQUEST['REGISTER']['PERSONAL_STREET']?>">
                </td>
            </tr>
            <tr>
                <td class="info4">Все поля обязательны для заполнения ! <span>Пожалуйста заполните поля помеченные красным!</span></td>
            </tr>
            <tr>
                <td class="right no-b-b"><button class="w200" name="register_submit_button" type="submit" value="Y">Зарегистрироваться</button></td>
            </tr>
        </tbody>
    </table>
    <input type="hidden" name="register" value="yes">
</form>
<script type="text/javascript">
$(document).ready(function()
{
    $('#auth_submit').click(function(e)
    {
        e.preventDefault();
        
        $('#form_auth').submit();
        
        return false; 
    });
    
    $('#forgot_password_button').click(function(e)
    {
        e.preventDefault();
        
        location.href = $(this).attr('rel');
    
        return false; 
    });
    
    // Выбор типа покупателя
    $('.list_box .scroll.client_type ul li a').live('click', function () 
    {
        var selText = $(this).text();
        var selVal = $(this).attr('href');
        
        $(this).parents('.list_box').children('.selected').text(selText);
        $(this).parents('.list_box').addClass('active').children('.scroll').fadeOut(200);
        
        $('#UF_CLIENT_TYPE').val(selVal);
        
        $(this).closest('.list_box').removeClass('opened');
        
        if (selVal == 5)
            location.href = '<?=$APPLICATION->GetCurDir()?>?register=yes&whole_sale=yes';
        else if (selVal == 4)
            location.href = '<?=$APPLICATION->GetCurDir()?>?register=yes';
            
        
        return false;
    });
    
    // Выбор страны
    $('.list_box .scroll.country ul li a').live('click', function () 
    {
        var selText = $(this).text();
        var selVal = $(this).text();
        
        $(this).parents('.list_box').children('.selected').text(selText);
        $(this).parents('.list_box').addClass('active').children('.scroll').fadeOut(200);
        
        $('#PERSONAL_COUNTRY').val(selVal);
        
        $(this).closest('.list_box').removeClass('opened');
        
        return false;
    });
    
    $('#PASSWORD').on('blur', function()
    {
        curPass = $('#PASSWORD').val();
        $('#CONFIRM_PASSWORD').val(curPass);
    })
});
</script>
*/?>