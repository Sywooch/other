<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<div class="carrier-block">
    <div class="carrier-center">
        <h2>Информация о перевозчике</h2>
        <?
        ShowError($arResult["strProfileError"]);
        if ($arResult['DATA_SAVED'] == 'Y')
            ShowNote(GetMessage('PROFILE_DATA_SAVED'));
        ?>
        <form id="carrier_details" method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
            <?=$arResult["BX_SESSION_CHECK"]?>
            
            <input type="hidden" name="lang" value="<?=LANG?>" />
            <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
            
            <input type="hidden" name="EMAIL" maxlength="50" value="<? echo $arResult["arUser"]["EMAIL"]?>" />
            <input type="hidden" name="LOGIN" maxlength="50" value="<? echo $arResult["arUser"]["LOGIN"]?>" />
                                           
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:system.field.edit",
                $arResult['USER_PROPERTIES']['DATA']['UF_DEFAULT_REGION']['USER_TYPE']['USER_TYPE_ID'],
                array(
                    "bVarsFromForm" => $arResult["bVarsFromForm"], 
                    "arUserField" => $arResult['USER_PROPERTIES']['DATA']['UF_DEFAULT_REGION']
                ), 
                null, 
                array(
                    "HIDE_ICONS" => "Y"
                )
            );
            ?>
            <br/>
            
            <label class="label_check <?if (intval($arResult['arUser']['UF_REGION_LIMIT']) == 1):?>c_on<?endif?>" for="some-region">
            <input type="hidden" value="0" name="UF_REGION_LIMIT" />
            <input name="some-region" id="some-region" name="UF_REGION_LIMIT" value="1" <?if (intval($arResult['arUser']['UF_REGION_LIMIT']) == 1):?>checked="checked"<?endif?> type="checkbox" />Ограничивать список заказов основным регионом
            </label>
            
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:system.field.edit",
                $arResult['USER_PROPERTIES']['DATA']['UF_TRANSPORTER_TYPE']['USER_TYPE']['USER_TYPE_ID'],
                array(
                    "bVarsFromForm" => $arResult["bVarsFromForm"], 
                    "arUserField" => $arResult['USER_PROPERTIES']['DATA']['UF_TRANSPORTER_TYPE']
                ), 
                null, 
                array(
                    "HIDE_ICONS" => "Y"
                )
            );
            ?>
            <br/>
            
            <div class="additional-info">Дополнительная информация:</div>
            <textarea cols="30" rows="5" name="PERSONAL_NOTES"><?=$arResult["arUser"]["PERSONAL_NOTES"]?></textarea>
            <br/>
            <br/>
            
            <a href="#" class="no-contact">Запрещено размещение любой контактной информации в данном поле.</a>
            <br/>
            
            <h2>Категории перевозок</h2>
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:system.field.edit",
                $arResult['USER_PROPERTIES']['DATA']['UF_CARRIER_TYPES']['USER_TYPE']['USER_TYPE_ID'],
                array(
                    "bVarsFromForm" => $arResult["bVarsFromForm"], 
                    "arUserField" => $arResult['USER_PROPERTIES']['DATA']['UF_CARRIER_TYPES']
                ), 
                null, 
                array(
                    "HIDE_ICONS" => "Y"
                )
            );
            ?>
            
            <h2>Информация о транспорте</h2>
            
            <?
            CModule::IncludeModule('iblock');
            
            $dbIblock = CIBlock::GetList(array(), array('CODE' => 'carrier_auto'));
            $arIblock = $dbIblock->GetNext();    
        
            global $USER;
            $dbRes = CIBlockElement::GetList(
                array(),
                array('IBLOCK_ID' => $arIblock['ID'], 'PROPERTY_CARRIER' => $USER->GetID()),
                false,
                false,
                array('ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_PICTURE', 'PROPERTY_TRANSPORT_BODY', 'PROPERTY_TRANSPORT_CAPAC')
            );
            $arUserCars = array();
            while ($arRes = $dbRes->GetNext())
            {         
                $arUserCars[] = array(
                    'NAME' => $arRes['NAME'],
                    'PICTURE' => array(
                        'ORIGINAL' => CFile::GetPath($arRes['PREVIEW_PICTURE']),
                        'RESIZED'  => CFile::ResizeImageGet(
                             $arRes['PREVIEW_PICTURE'], 
                             array(
                                'width' => 114, 
                                'height' => 114
                             ), 
                             BX_RESIZE_IMAGE_PROPORTIONAL, 
                             true, 
                             array()
                        )
                     ),
                     'TRANSPORT_BODY' => $arRes['PROPERTY_TRANSPORT_BODY_VALUE'],
                     'TRANSPORT_CAPACITY' => $arRes['PROPERTY_TRANSPORT_CAPAC_VALUE'],
                );
            }
            ?>
            
            <div class="info-about-cars">
                <table>
                    <tbody>
                        <tr>
                            <th style="border-radius: 6px 0 0 0; width: 104px;">№</th>
                            <th style="width: 158px;">Фото</th>
                            <th style="width: 314px;">Описание</th>
                            <th style=" border-radius: 0 6px 0 0; width: 341px;">Тип кузова и грузоподъемность</th>
                        </tr>
                        <?
                        if (!empty($arUserCars))
                        {
                            foreach ($arUserCars as $id => $arCar)
                            {
                                ?>
                                <tr>
                                    <td><div class="number-car"><?=($id+1)?></div></td>
                                    <td><div class="image-car"><a href="<?=$arCar['PICTURE']['ORIGINAL']?>" class="fancy"><img src="<?=$arCar['PICTURE']['RESIZED']['src']?>" alt="<?=$arCar['NAME']?>"></a></div></td>
                                    <td><div class="description-car"><?=$arCar['NAME']?></div></td>
                                    <td><div class="type-car"><?=$arCar['TRANSPORT_BODY']?> (<?=$arCar['TRANSPORT_CAPACITY']?>)</div></td>
                                </tr>
                                <?
                                $id++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
                
                <?
                $arTransportBodies = array();
                $dbTransportBody = CIBlockPropertyEnum::GetList(array('SORT' => 'ASC'), array('IBLOCK_ID' => $arIblock['ID'], 'CODE' => 'TRANSPORT_BODY'));
                while ($arTransportBody = $dbTransportBody->GetNext())
                {
                    $arTransportBodies[] = $arTransportBody;    
                }
                
                $arTransportCapacities = array();
                $dbTransportCapac = CIBlockPropertyEnum::GetList(array('SORT' => 'ASC'), array('IBLOCK_ID' => $arIblock['ID'], 'CODE' => 'TRANSPORT_CAPAC'));
                while ($arTransportCapac = $dbTransportCapac->GetNext())
                {
                    $arTransportCapacities[] = $arTransportCapac;    
                }
                ?>
                <a class="add-car modalbox" href="#add-car"><img src="<?=SITE_TEMPLATE_PATH?>/img/add.png" alt="">Добавить автомобиль</a>
                
                <h2>Документы</h2>
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:system.field.edit",
                    "file_custom",
                    array(
                        "bVarsFromForm" => $arResult["bVarsFromForm"], 
                        "arUserField" => $arResult['USER_PROPERTIES']['DATA']['UF_DOCUMENT']
                    ), 
                    null, 
                    array(
                        "HIDE_ICONS" => "Y"
                    )
                );
                ?>
                
                <?
                CModule::IncludeModule('iblock');
                
                $dbRes = CIBlockElement::GetList(
                    array(),
                    array('IBLOCK_CODE' => 'carrier_reviews', 'PROPERTY_CARRIER' => $USER->GetID()),
                    false,
                    false,
                    array('ID', 'IBLOCK_ID', 'PREVIEW_TEXT', 'DATE_CREATE', 'PROPERTY_CUSTOMER', 'PROPERTY_CUSTOMER_LOGIN', 'PROPERTY_CUSTOMER_RATE')
                );
                $arReviews = array();
                while ($arRes = $dbRes->GetNext())
                {
                    $arReviews[] = $arRes;
                }
                
//                pred(array($arReviews));
                ?>                
                <h2>Отзывы о перевозчике</h2>
                <table class="review-table">
                    <tbody>
                        <tr>
                            <th style="border-radius: 6px 0 0 0; width: 58px;">№</th>
                            <th style="width: 236px;">Заказчик</th>
                            <th style="width: 112px;">Дата</th>
                            <th style=" border-radius: 0 6px 0 0; width: 513px;">Отзыв</th>
                        </tr>
                        <?
                        if (!empty($arReviews))
                        {
                            foreach($arReviews as $id => $arReview)
                            {
                                ?>
                                <tr>
                                    <td><div class="number-comment"><?=($id + 1)?><div></td>
                                    <td><div class="client"><a href="#"><?=$arReview['PROPERTY_CUSTOMER_LOGIN_VALUE']?></a></div></td>
                                    <td><div class="date-comment"><?=ConvertDateTime($arReview['DATE_CREATE'], 'YYYY-MM-DD')?></div></td>
                                    <td><div class="comment"><?=$arReview['PREVIEW_TEXT']?></div></td>
                                </tr>
                                <?
                            }
                        }            
                        ?>
                    </tbody>
                </table>
            </div>
            
            <br/>
            <p style="text-align:  center;"><input type="submit" name="save" id="submit" value="Сохранить" /></p>
        </form>
    </div>
</div>
</div><!-- .content -->

<div id="add-car" class="add-car-modal">
    <h2>Добавить новый автомобиль</h2>
    <form id="car" name="car-enter" action="<?=$arResult["FORM_TARGET"]?>" method="post" enctype="multipart/form-data">
        <p>
            <label>Фото *: </label>
            <input type="file" name="PREVIEW_PICTURE" />
        </p>
        
        <p style="margin-left: 300px; font-size: 12px; line-height: 12px; color: #77aa3f;">
            Фотографии, содержащие контактную информацию, запрещены.<br /> Пожалуйста проверьте, что на загружаемом фото отсутствуют<br /> номера телефонов, адреса электронной почты, и т.д.
        </p>
        
        <p style="margin-top: 10px;">
            <label>Название *: </label>
            <input type="text" name="NAME" />
        </p>
        
        <div class="kuzov-t">
            <label for="kuzov" style="margin-top: 14px;">Кузов *: </label>
            <select name="TRANSPORT_BODY" class="kuzov" id="kuzov">
                <option>Не выбран</option>
                <?foreach ($arTransportBodies as $arBody):?>
                <option value="<?=$arBody['ID']?>"><?=$arBody['VALUE']?></option>
                <?endforeach?>
            </select>
        </div>
        
        <div class="d-s-v-m">
            <label>Длина, ширина, высота в метрах *: </label>
            <input type="text" name="TRANSPORT_LENGTH" /> &nbsp;&nbsp;x&nbsp;&nbsp; 
            <input type="text" name="TRANSPORT_WIDTH" /> &nbsp;&nbsp;x&nbsp;&nbsp; 
            <input type="text" name="TRANSPORT_HEIGHT" />
        </div>
        
        <div class="capacity-t">
            <label for="capacity" style="margin-top: 14px;">Грузоподъемность *: </label>
            <select name="TRANSPORT_CAPAC" class="capacity" id="capacity">
                <option>Не выбрана</option>
                <?foreach ($arTransportCapacities as $arCapac):?>
                <option value="<?=$arCapac['ID']?>"><?=$arCapac['VALUE']?></option>
                <?endforeach?>
            </select>
        </div>
        
        <p style="text-align: center; margin-top: 10px;">
            <input type="submit" value="Сохранить" id="submit-enter" name="NEW_CAR_FORM_SUBMIT" />
            <a href="" style="margin-left: 20px;">Отмена</a>
        </p>
        
        <input type="hidden" name="NEW_CAR_ADD" value="Y" />
        <input type="hidden" name="USER_ID" value="<?=$USER->GetID()?>" />
    </form>
</div>

<div id="add-document" class="add-car-modal">
    <h2>Добавить новый документ</h2>
    <form id="document" name="document-enter" action="<?=$arResult["FORM_TARGET"]?>" method="post" enctype="multipart/form-data">
        <?=$arResult["BX_SESSION_CHECK"]?>
        <input type="hidden" name="EMAIL" maxlength="50" value="<? echo $arResult["arUser"]["EMAIL"]?>" />
        <input type="hidden" name="LOGIN" maxlength="50" value="<? echo $arResult["arUser"]["LOGIN"]?>" />
        <p>
            <label>Фото: </label>
            <input type="hidden" name="UF_DOCUMENT_old_id[]" value="">
            <input type="file" name="UF_DOCUMENT[]" />
        </p>
        
        <p style="margin-left: 300px; font-size: 12px; line-height: 12px; color: #77aa3f;">
            Фотографии, содержащие контактную информацию, запрещены.<br /> Пожалуйста проверьте, что на загружаемом фото отсутствуют<br /> номера телефонов, адреса электронной почты, и т.д.
        </p>
        
        <p style="text-align: center; margin-top: 10px;">
            <input type="submit" value="Сохранить" id="submit-enter" name="save" />
            <a class="form_cancel" href="" style="margin-left: 20px;">Отмена</a>
        </p>
        
        <input type="hidden" name="USER_ID" value="<?=$USER->GetID()?>" />
    </form>
</div>

<script type="text/javascript">
$(document).ready(function()
{
    $(".modalbox, .fancy").fancybox();
    $(".form_cancel").click(function(e)
    {
        e.preventDefault();
        $.fancybox.close();
        return false; 
    });
    $("#document").prepend($(".documents_old").html());
    /*
    $("#enter").submit(function() { return false; });
    
    $("#submit-enter").on("click", function()
    {
//        $("#submit-enter").replaceWith("<em>отправка...</em>");
        
        $.ajax(
        {
            type: 'POST',
            url: '/ajax/ajax_car_add.php',
            data: $("#enter").serialize() + "&AJAX_CALL=Y",
            success: function(data) 
            {
                if(data == "true") 
                {
                    $("#enter").fadeOut("fast", function()
                    {
                        $(this).before("<p><strong>Успешно! Ваше сообщение отправлено  :)</strong></p>");
                        setTimeout("$.fancybox.close()", 1000);
                    });
                }
            }
        });
    });
    */
     
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