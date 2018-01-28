<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
if (!empty($arResult["ERRORS"]))
{
    foreach ($arResult["ERRORS"] as $key => $error)
    {
        if (!is_numeric($key) && ($key == 'CONFIRM_PASSWORD' || $key == 'LOGIN'))
        {
            unset($arResult["ERRORS"][$key]);
        }
        else
        {
            if (strpos($arResult['ERRORS'][$key], "#FIELD_NAME#") > 0) 
                $arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "«".GetMessage("REGISTER_FIELD_".$key)."»", $error);
        }
    }
}
?>
<div id="btransfer" <?if (empty($arResult["ERRORS"])):?>style="display: none;"<?endif?>>
    <h1 class="reg-new-h">Регистрация нового перевозчика</h1>
    <div style="text-align: center;">
        <?ShowError(implode("<br />", $arResult["ERRORS"]));?>
    </div>
    <form class="registration" method="post" action="<?=$APPLICATION->GetCurPageParam("", array(), false)?>" name="regform" enctype="multipart/form-data">
        <div class="reg-inform">Информация об перевозчике</div>
        <p>
            <label for="email">E-mail:<span>*</span></label>
            <input id="TRANSFER_EMAIL" type="text" name="REGISTER[EMAIL]" value="<?=$_REQUEST['REGISTER']['EMAIL']?>">
            <input id="TRANSFER_LOGIN" type="hidden" name="REGISTER[LOGIN]" value="<?=$_REQUEST['REGISTER']['LOGIN']?>">
        </p>
        <p>
            <label for="email">Ник-нейм:<span>*</span></label>
            <input id="WORK_COMPANY" type="text" name="REGISTER[WORK_COMPANY]" value="<?=$_REQUEST['REGISTER']['WORK_COMPANY']?>">
        </p>
        <p>
            <label for="name">Имя:<span>*</span></label>
            <input id="TRANSFER_NAME" type="text" name="REGISTER[NAME]" class="full" value="<?=$_REQUEST['REGISTER']['NAME']?>">
        </p>
        <p>
            <label for="phone">Телефон:<span>*</span></label>
            <input id="TRANSFER_PERSONAL_PHONE" name="REGISTER[PERSONAL_PHONE]" type="text" value="<?=$_REQUEST['REGISTER']['PERSONAL_PHONE']?>">
        </p>
        <p>
            <label for="password">Пароль:<span>*</span></label>
            <input id="TRANSFER_PASSWORD" name="REGISTER[PASSWORD]" type="password" value="">
            <input id="TRANSFER_CONFIRM_PASSWORD" type="hidden" name="REGISTER[CONFIRM_PASSWORD]" value="" autocomplete="off">
        </p>
        <p>
            <label for="region">Основной регион:<span>*</span></label>
            <select id="region" name="REGISTER[UF_DEFAULT_REGION]">
                <?foreach ($arResult['USER_PROPERTIES']['DATA']['UF_DEFAULT_REGION']['PROP_VALUES'] as $arProp):?>
                <option value="<?=$arProp['ID']?>" <?if ($arProp['ID'] == $_REQUEST['REGISTER']['UF_DEFAULT_REGION']):?>selected="selected"<?endif?>><?=$arProp['VALUE']?></option>
                <?endforeach?>
            </select>
        </p>
        <p>
            <label for="type">Тип перевозчика:<span>*</span></label>
            <select id="type" name="REGISTER[UF_TRANSPORTER_TYPE]">
                <?foreach ($arResult['USER_PROPERTIES']['DATA']['UF_TRANSPORTER_TYPE']['PROP_VALUES'] as $arProp):?>
                <option value="<?=$arProp['ID']?>" <?if ($arProp['ID'] == $_REQUEST['REGISTER']['UF_TRANSPORTER_TYPE']):?>selected="selected"<?endif?>><?=$arProp['VALUE']?></option>
                <?endforeach?>
            </select>
        </p>
        <div class="reg-inform">Информация об автомобиле</div>
        <p>
            <label for="description">Описание:<span>*</span></label>
            <input type="text" id="description" name="REGISTER[UF_TRANSPORT_DESC]" value="<?=$_REQUEST['REGISTER']['UF_TRANSPORT_DESC']?>">
        </p>
        <p>
            <label for="kuzov">Кузов:<span>*</span></label>
            <select id="kuzov" name="REGISTER[UF_TRANSPORT_BODY]">
                <?foreach ($arResult['USER_PROPERTIES']['DATA']['UF_TRANSPORT_BODY']['PROP_VALUES'] as $arProp):?>
                <option value="<?=$arProp['ID']?>" <?if ($arProp['ID'] == $_REQUEST['REGISTER']['UF_TRANSPORT_BODY']):?>selected="selected"<?endif?>><?=$arProp['VALUE']?></option>
                <?endforeach?>
            </select>
        </p>
        <p>
            <label for="massa">Грузоподъемность:<span>*</span></label>
            <select id="massa" name="REGISTER[UF_TRANSPORT_CAPAC]">
                <?foreach ($arResult['USER_PROPERTIES']['DATA']['UF_TRANSPORT_CAPAC']['PROP_VALUES'] as $arProp):?>
                <option value="<?=$arProp['ID']?>" <?if ($arProp['ID'] == $_REQUEST['REGISTER']['UF_TRANSPORT_CAPAC']):?>selected="selected"<?endif?>><?=$arProp['VALUE']?></option>
                <?endforeach?>
            </select>
        </p>
        <p>
            <label for="car_photo">Фото автомобиля:<span></span></label>
            <input type="file" id="car_photo" name="UF_CAR_PHOTO">
        </p>
        <p>
            <label for="documents">Добавить документ:<span></span></label>
            <input type="file" id="documents" name="UF_DOCUMENT[]">
        </p>
        <div class="format">Добавьте документы в формате .png, .jpg или .pdf. Это повысит ваш рейтинг как перевозчика и позволит увеличить ваши шансы на получение заказа.</div>
        <p></p>
        <p class="required">Поля помеченные символом * - обязательные для заполнения</p>
        <p style="text-align: center;">
            <label style="width: 500px; text-align: left;"><input type="checkbox" id="rules_transfer">Я ознакомился и принимаю <a href="/terms.php">соглашение об использовании</a></label>
        </p>
        <p style="text-align: center;">
            <input type="submit" id="submit_transfer" value="Регистрация">
            <input type="submit" style="display: none;" name="register_transfer_submit_button" value="Регистрация">
        </p>
    </form>
</div>

<script type="text/javascript">
$(document).ready(function()
{
    $('#submit_transfer').click(function(e)
    {
        e.preventDefault();
        
        if (!$('#rules_transfer:checked').length)
        {
            alert('Необходимо принять соглашение об использовании');
            return false;
        }
        else
            $(this).closest('p').find('input[name=register_transfer_submit_button]').click();
    });
    
    $('#TRANSFER_EMAIL').on('blur', function()
    {
        curEmail = $('#TRANSFER_EMAIL').val();
        $('#TRANSFER_LOGIN').val(curEmail);
    });
    
    $('#TRANSFER_PASSWORD').on('blur', function()
    {
        curPass = $('#TRANSFER_PASSWORD').val();
        $('#TRANSFER_CONFIRM_PASSWORD').val(curPass);
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
<!-- wrap -->
<div id="wrap">
    <!-- content_container -->
    <div id="content_container">
        <div id="main" class="noside">
            <!-- top nav -->
            <div class="top_nav_just fixed_top">
                <ul>
                    <li><a href="/kabinet/korzina/" class="my_cart"><span class="ico i-cart gray"></span>Моя корзина</a></li>
                    <li><a href="/kabinet/zakazu/">Мои заказы</a></li>
                    <li class="active"><a href="/kabinet/">Аккаунт</a></li>
                    <li><a href="/kabinet/podpiska/">Подписка</a></li>
                </ul>
                <!-- steps -->
                <div class="auth_nav">
                    <ul>
                        <li <?=!empty($_REQUEST['register']) ? 'class="active"' : ''?>><a href="<?=$APPLICATION->GetCurDir()?>?register=yes">Регистрация</a></li>
                        <li <?=empty($_REQUEST['register']) ? 'class="active"' : ''?>><a href="<?=$APPLICATION->GetCurDir()?>" class="auth">Авторизация</a></li>
                    </ul>
                </div>
                <!-- /steps -->
            </div>
            <!-- /top nav -->
            <!-- auth box -->
            <div class="auth_box procedure_step">
                <?ShowError(implode("<br />", $arResult["ERRORS"]));?>
                <form id="form_reg" method="post" action="/kabinet/" name="regform" enctype="multipart/form-data">
                <?if(empty($_REQUEST['whole_sale'])):?>
                    <!-- h box -->
                    <div class="h_box">
                        <div class="order_user">
                            <table class="reg">
                                <tbody>
                                    <tr>
                                        <td><div class="t2">Зарегистрироваться</div></td>
                                        <td>
                                            <div class="user">
                                                <div class="list_box gray w200">
                                                    <span class="ico i-arr-b white"></span>
                                                    <span class="ico i-arr-b"></span>
                                                    <div class="selected">Розничный клиент</div>
                                                    <div class="scroll client_type">
                                                        <ul>
                                                            <li><a href="4">Розничный клиент</a></li>
                                                            <li><a href="5">Оптовый покупатель</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="info2">
                                                    Регистрация оптового клиента происходит только после подтверждения менеджера по продажам компании
                                                </div>
                                            </div>
                                            <input id="UF_CLIENT_TYPE" type="hidden" name="UF_CLIENT_TYPE" value="4">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="162" rowspan="7" class="no-b-b"></td>
                                        <td>
                                            <label for="LAST_NAME">Ф.И.О.:</label>
                                            <input id="LAST_NAME" type="text" name="REGISTER[LAST_NAME]" class="full ob" value="<?=$_REQUEST['REGISTER']['LAST_NAME']?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="LOGIN">Логин:</label>
                                            <input id="LOGIN" type="text" name="REGISTER[LOGIN]" class="ob" value="<?=$_REQUEST['REGISTER']['LOGIN']?>">
                                            <label for="PASSWORD">Пароль:</label>
                                            <input id="PASSWORD" name="REGISTER[PASSWORD]" class="ob" type="password" value="">
                                            <input id="CONFIRM_PASSWORD" type="hidden" name="REGISTER[CONFIRM_PASSWORD]" value="" autocomplete="off">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="EMAIL">E-mail:</label>
                                            <input id="EMAIL" type="text" name="REGISTER[EMAIL]" class="ob" value="<?=$_REQUEST['REGISTER']['EMAIL']?>">
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
                        </div>
                    </div>
                    <!-- /h box -->
                <?else:?>
                    <?
                    CModule::IncludeModule('sale');
                    $arFilter = array("PERSON_TYPE_ID" => 3, "ACTIVE" => "Y", "TYPE" => "LOCATION", "UTIL" => "N");

                    $dbProperties = CSaleOrderProps::GetList(
                        array(
                            "GROUP_SORT" => "ASC",
                            "PROPS_GROUP_ID" => "ASC",
                            "SORT" => "ASC",
                            "NAME" => "ASC"
                        ),
                        $arFilter,
                        false,
                        false,
                        array("ID", "NAME", "TYPE", "REQUIED", "DEFAULT_VALUE", "IS_LOCATION", "PROPS_GROUP_ID", "SIZE1", "SIZE2", "DESCRIPTION", "IS_EMAIL", "IS_PROFILE_NAME", "IS_PAYER", "IS_LOCATION4TAX", "CODE", "GROUP_NAME", "GROUP_SORT", "SORT", "USER_PROPS", "IS_ZIP")
                    );
                    while ($arProperties = $dbProperties->GetNext())
                    {
                        unset($curVal);
                        if(isset($arResult["POST"]["ORDER_PROP_".$arProperties["ID"]]))
                            $curVal = $arResult["POST"]["ORDER_PROP_".$arProperties["ID"]];

                        $arProperties["FIELD_NAME"] = "ORDER_PROP_".$arProperties["ID"];
                        if (IntVal($arProperties["PROPS_GROUP_ID"]) != $propertyGroupID || $propertyUSER_PROPS != $arProperties["USER_PROPS"])
                            $arProperties["SHOW_GROUP_NAME"] = "Y";
                        $propertyGroupID = $arProperties["PROPS_GROUP_ID"];
                        $propertyUSER_PROPS = $arProperties["USER_PROPS"];

                        if ($arProperties["REQUIED"]=="Y" || $arProperties["IS_EMAIL"]=="Y" || $arProperties["IS_PROFILE_NAME"]=="Y" || $arProperties["IS_LOCATION"]=="Y" || $arProperties["IS_LOCATION4TAX"]=="Y" || $arProperties["IS_PAYER"]=="Y" || $arProperties["IS_ZIP"]=="Y")
                            $arProperties["REQUIED_FORMATED"]="Y";

                        if ($arProperties["TYPE"] == "LOCATION")
                        {
                            $arProperties["SIZE1"] = ((IntVal($arProperties["SIZE1"]) > 0) ? $arProperties["SIZE1"] : 1);
                            $dbVariants = CSaleLocation::GetList(
                                    array("SORT" => "ASC", "COUNTRY_NAME_LANG" => "ASC", "CITY_NAME_LANG" => "ASC"),
                                    array("LID" => LANGUAGE_ID),
                                    false,
                                    false,
                                    array("ID", "COUNTRY_NAME", "CITY_NAME", "SORT", "COUNTRY_NAME_LANG", "CITY_NAME_LANG")
                                );
                            while ($arVariants = $dbVariants->GetNext())
                            {
                                if (IntVal($arVariants["ID"]) == IntVal($curVal) || !isset($curVal) && IntVal($arVariants["ID"]) == IntVal($arProperties["DEFAULT_VALUE"]))
                                    $arVariants["SELECTED"] = "Y";
                                $arVariants["NAME"] = $arVariants["COUNTRY_NAME"].((strlen($arVariants["CITY_NAME"]) > 0) ? " - " : "").$arVariants["CITY_NAME"];
                                $arProperties["VARIANTS"][] = $arVariants;
                            }
                        }
                        
                        if($arProperties["USER_PROPS"] == "Y")
                            $arResult["UF_PERSONAL_COUNTRY"] = $arProperties;
                    }
                    ?>
                    <!-- h box -->
                    <input type="hidden" name="whole_sale" value="yes">
                    <div class="h_box">
                        <div class="order_user">
                            <table class="reg">
                                <tbody>
                                    <tr>
                                        <td><div class="t2">Зарегистрироваться</div></td>
                                        <td>
                                            <div class="user">
                                                <div class="list_box gray w200">
                                                    <span class="ico i-arr-b white"></span>
                                                    <span class="ico i-arr-b"></span>
                                                    <div class="selected">Оптовый покупатель</div>
                                                    <div class="scroll client_type">
                                                        <ul>
                                                            <li><a href="4">Розничный клиент</a></li>
                                                            <li><a href="5">Оптовый покупатель</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="info2">
                                                    Регистрация оптового клиента происходит только после подтверждения менеджера по продажам компании
                                                </div>
                                            </div>
                                            <input id="UF_CLIENT_TYPE" type="hidden" name="UF_CLIENT_TYPE" value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="162" rowspan="12" class="no-b-b"></td>
                                        <td>
                                            <label for="LAST_NAME">Ф.И.О.:</label>
                                            <input id="LAST_NAME" type="text" name="REGISTER[LAST_NAME]" class="full ob" value="<?=$_REQUEST['REGISTER']['LAST_NAME']?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="LOGIN">Логин:</label>
                                            <input id="LOGIN" type="text"  class="ob" name="REGISTER[LOGIN]" value="<?=$_REQUEST['REGISTER']['LOGIN']?>">
                                            <label for="PASSWORD">Пароль:</label>
                                            <input id="PASSWORD" name="REGISTER[PASSWORD]" class="ob" type="password" value="">
                                            <input id="CONFIRM_PASSWORD" type="hidden" name="REGISTER[CONFIRM_PASSWORD]" value="" autocomplete="off">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="EMAIL">E-mail:</label>
                                            <input id="EMAIL" type="text" class="ob" name="REGISTER[EMAIL]" value="<?=$_REQUEST['REGISTER']['EMAIL']?>">
                                            <label for="PERSONAL_PHONE">Телефон:</label>
                                            <input id="PERSONAL_PHONE" class="ob" name="REGISTER[PERSONAL_PHONE]" type="text" value="<?=$_REQUEST['REGISTER']['PERSONAL_PHONE']?>">
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
                                                    <?foreach ($arResult["UF_PERSONAL_COUNTRY"]["VARIANTS"] as $key => $value):?>
                                                        <li><a href="<?=$value['ID']?>"><?=$value['NAME']?></a></li>
                                                    <?endforeach?>
                                                    </ul>
                                                    <input id="PERSONAL_COUNTRY" type="hidden" name="UF_PERSONAL_COUNTRY" value="">
                                                </div>
                                            </div>
                                            <!--<input id="PERSONAL_COUNTRY" type="hidden" name="REGISTER[PERSONAL_COUNTRY]" value="Россия">-->
                                            <label for="PERSONAL_ZIP" class="postal_index">Индекс:</label>
                                            <input id="PERSONAL_ZIP" class="postal_index" type="text" name="REGISTER[PERSONAL_ZIP]" value="<?=$_REQUEST['REGISTER']['PERSONAL_ZIP']?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="UF_COMPANY_NAME">Название компании:</label>
                                            <input id="UF_COMPANY_NAME" type="text" name="UF_COMPANY_NAME" placeholder="" class="full ob" value="<?=$_REQUEST['UF_COMPANY_NAME']?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="UF_LEGAL_ADDRESS">Юридический адрес:</label>
                                            <input id="UF_LEGAL_ADDRESS" type="text" name="UF_LEGAL_ADDRESS" placeholder="" class="full ob" value="<?=$_REQUEST['UF_LEGAL_ADDRESS']?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="UF_INN">ИНН:</label>
                                            <input id="UF_INN" type="text" name="UF_INN" placeholder="" class="full ob" value="<?=$_REQUEST['UF_INN']?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="UF_KPP">КПП:</label>
                                            <input id="UF_KPP" type="text" name="UF_KPP" placeholder="" class="full ob" value="<?=$_REQUEST['UF_KPP']?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="UF_PAYMENT_ACCOUNT">Расчетный счет:</label>
                                            <input id="UF_PAYMENT_ACCOUNT" type="text" name="UF_PAYMENT_ACCOUNT" placeholder="" class="full ob" value="<?=$_REQUEST['UF_PAYMENT_ACCOUNT']?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="UF_CONTACT_PERSON">Контактное лицо:</label>
                                            <input id="UF_CONTACT_PERSON" type="text" name="UF_CONTACT_PERSON" placeholder="" class="full ob" value="<?=$_REQUEST['UF_CONTACT_PERSON']?>">
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
                        </div>
                    </div>
                    <!-- /h box -->
                <?endif?>
                <input type="hidden" name="register" value="yes">
                </form>
            </div>
            <!-- /auth box -->
        </div>
    </div>
    <!-- /content container -->
</div>
<!-- /wrap -->
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
        var selVal = $(this).attr('href');
        
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
