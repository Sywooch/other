<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>
<h1>Разместить запрос на перевозку грузов</h1>
<?
$userContactInformation = GetUserContactInformation();
if (!empty($arResult["ERRORS"]))
{
    ShowError(implode("<br />", $arResult["ERRORS"]));
}

if (strlen($arResult["MESSAGE"]) > 0)
{
    if ($arResult['MESSAGE'] == 'Элемент успешно добавлен')
//        ShowNote('Ваш заказ принят.');
        LocalRedirect("/catalog/".$_REQUEST['add_id'].".html");
    else
        ShowNote($arResult["MESSAGE"]);
}
?>
<form action="<?=POST_FORM_ACTION_URI?>" name="category-shipping" method="post" enctype="multipart/form-data">
    <?=bitrix_sessid_post()?>
    
    <div class="dostavka-block"><a class="pereezd" href="#">Переезд</a></div>
    <input type="hidden" name="PROPERTY[IBLOCK_SECTION][]" value="<?=$arParams['SECTION_ID']?>">
    <a href="<?=SITE_DIR?>#change" class="change-category">Изменить категорию</a>

    <h2>Что нужно перевезти:</h2>
    
    <input type="text" name="PROPERTY[NAME][0]" value="<?=$arResult['ELEMENT']['NAME']?>" class="title" placeholder="Какой переезд интересует?"/>
    
    <textarea rows="6" cols="104" name="PROPERTY[DETAIL_TEXT][0]" class="description" placeholder="Перечень вещей и мебели для перевозок, этажи спуска/подъёма, наличие лифтов и дополнительные комментарии"><?=$arResult['ELEMENT']['DETAIL_TEXT']?></textarea>
    
    <input type="button" class="load-photo" value="Загрузить фото"/>
    <input id="load-photo" type="file" name="PROPERTY_FILE_PREVIEW_PICTURE_0" value="Загрузить фото" style="display: none;"/>
    <br/>
    
    <input type="text" name="PROPERTY[42][0]" value="<?=$arResult['ELEMENT_PROPERTIES']['42']['0']['VALUE']?>" class="volume" id="volume" placeholder="Объем груза"/>
    <label class="volume-label" for="volume">м3</label>
    
    <input type="text" name="PROPERTY[43][0]" value="<?=$arResult['ELEMENT_PROPERTIES']['43']['0']['VALUE']?>" class="weight" id="weight" placeholder="Вес груза"/>
    <label class="weight-label" for="weight">кг</label>
    <br/><br/>
    
    <img src="<?=SITE_TEMPLATE_PATH?>/img/man.png" alt=""/>
    
    <?
    $arPorters = array(
        '1' => 'Погрузка/разгрузка не требуется',
        '2' => 'Достаточно помощи водителя',
        '3' => 'Необходим 1 грузчик',
        '4' => 'Необходимо 2 грузчика',
        '5' => 'Необходимо 3 грузчика'
    );
    ?>
    <select name="PROPERTY[44][0]" class="porter-count" id="porter-count">
        <?foreach ($arPorters as $porter => $porterText):?>
        <option value="<?=$porter?>" <?if ($arResult['ELEMENT_PROPERTIES']['44']['0']['VALUE'] == $porter):?>selected="selected"<?endif?>><?=$porterText?></option>
        <?endforeach?>
    </select>
    <br/><br/>
    
    <h2>Откуда, куда, когда:</h2>
    <input type="text" class="from" name="PROPERTY[47][0]" value="<?=$arResult['ELEMENT_PROPERTIES']['47']['0']['VALUE']?>" placeholder="Город (откуда) *"/>
    <input type="text" class="from-street" name="PROPERTY[48][0]" value="<?=$arResult['ELEMENT_PROPERTIES']['48']['0']['VALUE']?>" placeholder="Улица, дом"/>
    <a href="#inline1" class="location fancybox"><img src="<?=SITE_TEMPLATE_PATH?>/img/location.png" alt=""/></a>
    <br/>
    
    <input type="text" class="to" name="PROPERTY[49][0]" value="<?=$arResult['ELEMENT_PROPERTIES']['49']['0']['VALUE']?>" placeholder="Город (куда) *"/>
    <input type="text" class="to-street" name="PROPERTY[50][0]" value="<?=$arResult['ELEMENT_PROPERTIES']['50']['0']['VALUE']?>" placeholder="Улица, дом"/>
    <a href="#inline1" class="location fancybox"><img src="<?=SITE_TEMPLATE_PATH?>/img/location.png" alt=""/></a>
    <br/>
    
    <div id="inline1" style="display: none;"></div>
    
    <input type="text" id="date" name="PROPERTY[45][0]" value="<?=$arResult['ELEMENT_PROPERTIES']['45']['0']['VALUE']?>" class="date" placeholder="Дата перевозки"/>
    <input type="text" id="time" name="PROPERTY[46][0]" value="<?=$arResult['ELEMENT_PROPERTIES']['46']['0']['VALUE']?>" class="time" placeholder="Время"/>
    <br/>
    
    <h2>Дополнительные параметры:</h2>
    <textarea rows="6" cols="104" name="PROPERTY[DETAIL_TEXT][0]" placeholder="Способ оплаты и прочие детали перевозки"><?=$arResult['ELEMENT']['DETAIL_TEXT']?></textarea>
    <br/><br/>
    
    <input type="hidden" name="PROPERTY[56][0]" value="<?=$arParams['USER_ID']?>" />
    <input type="hidden" name="PROPERTY[DATE_ACTIVE_FROM][0]" value="<?=ConvertTimeStamp(time()-86600, "SHORT")?>" />
    
    <input type="hidden" id="country_from" name="PROPERTY[60][0]" value="<?=$arResult['ELEMENT_PROPERTIES']['57']['0']['VALUE']?>" />
    <input type="hidden" id="country_to" name="PROPERTY[61][0]" value="<?=$arResult['ELEMENT_PROPERTIES']['57']['0']['VALUE']?>" />
    
    <input type="hidden" id="region_from" name="PROPERTY[62][0]" value="<?=$arResult['ELEMENT_PROPERTIES']['57']['0']['VALUE']?>" />
    <input type="hidden" id="region_to" name="PROPERTY[63][0]" value="<?=$arResult['ELEMENT_PROPERTIES']['57']['0']['VALUE']?>" />
    
    <input type="hidden" id="coords_from" name="PROPERTY[58][0]" value="<?=$arResult['ELEMENT_PROPERTIES']['58']['0']['VALUE']?>" />
    <input type="hidden" id="coords_to" name="PROPERTY[59][0]" value="<?=$arResult['ELEMENT_PROPERTIES']['59']['0']['VALUE']?>" />
    
    <input type="hidden" id="distance" name="PROPERTY[57][0]" value="<?=$arResult['ELEMENT_PROPERTIES']['57']['0']['VALUE']?>" />
    
    <input type="hidden" name="PROPERTY[51][0]" value="<?=$userContactInformation['NAME']?>" />
    <input type="hidden" name="PROPERTY[52][0]" value="<?=$userContactInformation['EMAIL']?>" />
    <input type="hidden" name="PROPERTY[53][0]" value="<?=$userContactInformation['PHONE']?>" />
    
    <input type="submit" name="iblock_submit" class="submit" value="Разместить запрос"/>
</form>
<div class="clear"></div>

<script type="text/javascript">
/*
var myPlacemarkFrom, myPlacemarkTo;
var coordsFrom, coordsTo;
var distance;
var country, region, city, address;
var route;

$(document).ready(function()
{
    $('#date').datepicker();
    $('#time').timepicker({timeFormat: "hh:mm", altFieldTimeOnly: true, amPmText: ['', '']});
    
    $('.load-photo').click(function(e)
    {
        e.preventDefault();
        
        $('#load-photo').click();
    
        return false; 
    });
    
    $('#load-photo').change(function()
    {
        text = $.trim($('#load-photo').val());
        slashIndex = text.lastIndexOf('\\') + 1;
        text = text.substr(slashIndex);
        
        $('.load-photo').val('Выбранное фото: ' + text);
    });
    
    $('.from, .from-street').click(function() { if (!myPlacemarkFrom) { $('.fancybox').click(); } });
    $('.to, .to-street').click(function() { if (!myPlacemarkTo) { $('.fancybox').click(); } });
    
    ymaps.ready(function () 
    {         
        // Устанавливаем ширину/высоту контейнера карты
        $('#inline1').css({width: $(window).width() - 400, height: $(window).height() - 200});
        $('.fancybox').fancybox(
        {
            afterShow: function ()
            {
                // Если карту не создали ранее
                if (!window.myMap)
                {
                    // Создаём её
                    window.myMap = new ymaps.Map("inline1", 
                    {
                        center: [ymaps.geolocation.latitude, ymaps.geolocation.longitude],
                        zoom: 10,
                        behaviors: ["scrollZoom", "drag"]
                    });
                    
                    // Добавляем на карту контролы
                    window.myMap.controls.add('zoomControl').add('miniMap').add('typeSelector').add('mapTools').add('searchControl');
                    
                    // Добавляем слушателя кликов по карте
                    window.myMap.events.add('click', function (e) 
                    {
                        // Если метка «От» ещё не создана – создаём
                        if (!myPlacemarkFrom) 
                        {
                            coordsFrom = e.get('coords');
                            myPlacemarkFrom = createPlacemark(coordsFrom, "A");
                            window.myMap.geoObjects.add(myPlacemarkFrom);
                            
                            // Добавляем слушателя передвижения метки «От»
                            myPlacemarkFrom.events.add('dragend', function () 
                            {    
                                coordsFrom = myPlacemarkFrom.geometry.getCoordinates();
                                
                                // Если обе метки установлены - считаем и актуализируем расстояние
                                if (myPlacemarkTo)       
                                {
                                    ymaps.route([[coordsFrom], [coordsTo]], {}).then(function (router) 
                                    {
                                        route = router;
                                        distance = route.getLength() * 0.001;
                                        $('#distance').val(Math.floor(distance));    
                                    });
                                }
                                
                                // Устанавливаем на форме адрес метки «От»
                                getAddress('from', coordsFrom);
                            });
                            
                            getAddress('from', coordsFrom);
                        }
                        // Если метка «До» ещё не создана – создаём
                        else if (!myPlacemarkTo)
                        {
                            coordsTo = e.get('coords');
                            myPlacemarkTo = createPlacemark(coordsTo, "B");
                            window.myMap.geoObjects.add(myPlacemarkTo);
                            
                            // Добавляем слушателя передвижения метки «До»
                            myPlacemarkTo.events.add('dragend', function () 
                            {
                                coordsTo = myPlacemarkTo.geometry.getCoordinates();
                                
                                // Если обе метки установлены - считаем и актуализируем расстояние
                                if (myPlacemarkFrom)
                                {
                                    ymaps.route([[coordsFrom], [coordsTo]], {}).then(function (router) 
                                    {
                                        route = router;
                                        distance = route.getLength() * 0.001;
                                        $('#distance').val(Math.floor(distance));    
                                    });
                                }
                                
                                // Устанавливаем на форме адрес метки «До»
                                getAddress('to', coordsTo);
                            });
                            
                            // Устанавливаем на форме адрес метки «От»
                            getAddress('to', coordsTo);
                        }
                        
                        // Если установлены обе метки -вычисляем и записываем расстояние
                        if (coordsFrom && coordsTo)
                        {
                            ymaps.route([[coordsFrom], [coordsTo]], {}).then(function (router) 
                            {
                                route = router;
                                distance = route.getLength() * 0.001;
                                $('#distance').val(Math.floor(distance));    
                            });
                        }
                    });

                    // Функция создания метки
                    function createPlacemark(coords, icon_content) 
                    {
                        return new ymaps.Placemark(coords, 
                        {
                            iconContent: icon_content
                        }, 
                        {
                            draggable: true
                        });
                    }

                    // Фукнкция определения адреса по координатам (обратное геокодирование)
                    function getAddress(placemark, coords) 
                    {     
                        ymaps.geocode(coords).then(function (res) 
                        {
                            arr = [];
                            
                            id = 0;
                            res.geoObjects.each(function (obj) 
                            {
                                value = obj.properties.get('name');
                                
                                if (id == 0)
                                {
                                    $('#country_' + placemark).val(value);
                                }
                                
                                if (value.toLowerCase().indexOf("область") >= 0 || value.toLowerCase().indexOf("москва") >= 0)
                                {
                                    $('#region_' + placemark).val(value);
                                }
                                
                                arr.push(value);
                            });
                        });
                          
                        ymaps.geocode(coords, {json: false, kind: "locality", results: 1}).then(function (res) 
                        {
                            res.geoObjects.each(function (obj) 
                            {                                           
                                city = obj.properties.get('name');
                            });
                            
                            ymaps.geocode(coords, {json: false, kind: "house", results: 1}).then(function (res) 
                            {
                                res.geoObjects.each(function (obj) 
                                {
                                    address = obj.properties.get('name');
                                });
                                
                                if (placemark == 'from')
                                {
                                    $('input.from').val(city);
                                    $('input.from-street').val(address);
                                }
                                else if (placemark == 'to')
                                {
                                    $('input.to').val(city);
                                    $('input.to-street').val(address);
                                }
                            });
                        });
                        
                        $('#coords_' + placemark).val(coords);
                    }
                }
            },
            afterClose: function () 
            {
//                window.myMap.destroy();
//                window.myMap = null;
//                myPlacemarkFrom = null;
//                myPlacemarkTo = null;
            }
        });
    });
});
*/
</script>

<?
/*
if (!empty($arResult["ERRORS"])):?>
	<?=ShowError(implode("<br />", $arResult["ERRORS"]))?>
<?endif;
if (strlen($arResult["MESSAGE"]) > 0):?>
	<?=ShowNote($arResult["MESSAGE"])?>
<?endif?>
<form name="iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
	<?=bitrix_sessid_post()?>
	<?if ($arParams["MAX_FILE_SIZE"] > 0):?><input type="hidden" name="MAX_FILE_SIZE" value="<?=$arParams["MAX_FILE_SIZE"]?>" /><?endif?>
	<table class="data-table">
		<thead>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
		</thead>
		<?if (is_array($arResult["PROPERTY_LIST"]) && !empty($arResult["PROPERTY_LIST"])):?>
		<tbody>
			<?foreach ($arResult["PROPERTY_LIST"] as $propertyID):?>
				<tr>
					<td><?if (intval($propertyID) > 0):?><?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]?><?else:?><?=!empty($arParams["CUSTOM_TITLE_".$propertyID]) ? $arParams["CUSTOM_TITLE_".$propertyID] : GetMessage("IBLOCK_FIELD_".$propertyID)?><?endif?><?if(in_array($propertyID, $arResult["PROPERTY_REQUIRED"])):?><span class="starrequired">*</span><?endif?></td>
					<td>
						<?
						if (intval($propertyID) > 0)
						{
							if (
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "T"
								&&
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] == "1"
							)
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "S";
							elseif (
								(
									$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "S"
									||
									$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "N"
								)
								&&
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] > "1"
							)
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "T";
						}
						elseif (($propertyID == "TAGS") && CModule::IncludeModule('search'))
							$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "TAGS";

						if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y")
						{
							$inputNum = ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) ? count($arResult["ELEMENT_PROPERTIES"][$propertyID]) : 0;
							$inputNum += $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE_CNT"];
						}
						else
						{
							$inputNum = 1;
						}

						if($arResult["PROPERTY_LIST_FULL"][$propertyID]["GetPublicEditHTML"])
							$INPUT_TYPE = "USER_TYPE";
						else
							$INPUT_TYPE = $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"];

						switch ($INPUT_TYPE):
							case "USER_TYPE":
								for ($i = 0; $i<$inputNum; $i++)
								{
									if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
									{
										$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["~VALUE"] : $arResult["ELEMENT"][$propertyID];
										$description = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["DESCRIPTION"] : "";
									}
									elseif ($i == 0)
									{
										$value = intval($propertyID) <= 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];
										$description = "";
									}
									else
									{
										$value = "";
										$description = "";
									}
									echo call_user_func_array($arResult["PROPERTY_LIST_FULL"][$propertyID]["GetPublicEditHTML"],
										array(
											$arResult["PROPERTY_LIST_FULL"][$propertyID],
											array(
												"VALUE" => $value,
												"DESCRIPTION" => $description,
											),
											array(
												"VALUE" => "PROPERTY[".$propertyID."][".$i."][VALUE]",
												"DESCRIPTION" => "PROPERTY[".$propertyID."][".$i."][DESCRIPTION]",
												"FORM_NAME"=>"iblock_add",
											),
										));
								?><br /><?
								}
							break;
							case "TAGS":
								$APPLICATION->IncludeComponent(
									"bitrix:search.tags.input",
									"",
									array(
										"VALUE" => $arResult["ELEMENT"][$propertyID],
										"NAME" => "PROPERTY[".$propertyID."][0]",
										"TEXT" => 'size="'.$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"].'"',
									), null, array("HIDE_ICONS"=>"Y")
								);
								break;
							case "HTML":
								$LHE = new CLightHTMLEditor;
								$LHE->Show(array(
									'id' => preg_replace("/[^a-z0-9]/i", '', "PROPERTY[".$propertyID."][0]"),
									'width' => '100%',
									'height' => '200px',
									'inputName' => "PROPERTY[".$propertyID."][0]",
									'content' => $arResult["ELEMENT"][$propertyID],
									'bUseFileDialogs' => false,
									'bFloatingToolbar' => false,
									'bArisingToolbar' => false,
									'toolbarConfig' => array(
										'Bold', 'Italic', 'Underline', 'RemoveFormat',
										'CreateLink', 'DeleteLink', 'Image', 'Video',
										'BackColor', 'ForeColor',
										'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyFull',
										'InsertOrderedList', 'InsertUnorderedList', 'Outdent', 'Indent',
										'StyleList', 'HeaderList',
										'FontList', 'FontSizeList',
									),
								));
								break;
							case "T":
								for ($i = 0; $i<$inputNum; $i++)
								{

									if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
									{
										$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
									}
									elseif ($i == 0)
									{
										$value = intval($propertyID) > 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];
									}
									else
									{
										$value = "";
									}
								?>
						<textarea cols="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]?>" rows="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"]?>" name="PROPERTY[<?=$propertyID?>][<?=$i?>]"><?=$value?></textarea>
								<?
								}
							break;

							case "S":
							case "N":
								for ($i = 0; $i<$inputNum; $i++)
								{
									if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
									{
										$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
									}
									elseif ($i == 0)
									{
										$value = intval($propertyID) <= 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];

									}
									else
									{
										$value = "";
									}
								?>
								<input type="text" name="PROPERTY[<?=$propertyID?>][<?=$i?>]" size="25" value="<?=$value?>" /><br /><?
								if($arResult["PROPERTY_LIST_FULL"][$propertyID]["USER_TYPE"] == "DateTime"):?><?
									$APPLICATION->IncludeComponent(
										'bitrix:main.calendar',
										'',
										array(
											'FORM_NAME' => 'iblock_add',
											'INPUT_NAME' => "PROPERTY[".$propertyID."][".$i."]",
											'INPUT_VALUE' => $value,
										),
										null,
										array('HIDE_ICONS' => 'Y')
									);
									?><br /><small><?=GetMessage("IBLOCK_FORM_DATE_FORMAT")?><?=FORMAT_DATETIME?></small><?
								endif
								?><br /><?
								}
							break;

							case "F":
								for ($i = 0; $i<$inputNum; $i++)
								{
									$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
									?>
						<input type="hidden" name="PROPERTY[<?=$propertyID?>][<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>]" value="<?=$value?>" />
						<input type="file" size="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]?>"  name="PROPERTY_FILE_<?=$propertyID?>_<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>" /><br />
									<?

									if (!empty($value) && is_array($arResult["ELEMENT_FILES"][$value]))
									{
										?>
					<input type="checkbox" name="DELETE_FILE[<?=$propertyID?>][<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>]" id="file_delete_<?=$propertyID?>_<?=$i?>" value="Y" /><label for="file_delete_<?=$propertyID?>_<?=$i?>"><?=GetMessage("IBLOCK_FORM_FILE_DELETE")?></label><br />
										<?

										if ($arResult["ELEMENT_FILES"][$value]["IS_IMAGE"])
										{
											?>
					<img src="<?=$arResult["ELEMENT_FILES"][$value]["SRC"]?>" height="<?=$arResult["ELEMENT_FILES"][$value]["HEIGHT"]?>" width="<?=$arResult["ELEMENT_FILES"][$value]["WIDTH"]?>" border="0" /><br />
											<?
										}
										else
										{
											?>
					<?=GetMessage("IBLOCK_FORM_FILE_NAME")?>: <?=$arResult["ELEMENT_FILES"][$value]["ORIGINAL_NAME"]?><br />
					<?=GetMessage("IBLOCK_FORM_FILE_SIZE")?>: <?=$arResult["ELEMENT_FILES"][$value]["FILE_SIZE"]?> b<br />
					[<a href="<?=$arResult["ELEMENT_FILES"][$value]["SRC"]?>"><?=GetMessage("IBLOCK_FORM_FILE_DOWNLOAD")?></a>]<br />
											<?
										}
									}
								}

							break;
							case "L":

								if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["LIST_TYPE"] == "C")
									$type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "checkbox" : "radio";
								else
									$type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "multiselect" : "dropdown";

								switch ($type):
									case "checkbox":
									case "radio":
										foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												if (is_array($arResult["ELEMENT_PROPERTIES"][$propertyID]))
												{
													foreach ($arResult["ELEMENT_PROPERTIES"][$propertyID] as $arElEnum)
													{
														if ($arElEnum["VALUE"] == $key)
														{
															$checked = true;
															break;
														}
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}

											?>
							<input type="<?=$type?>" name="PROPERTY[<?=$propertyID?>]<?=$type == "checkbox" ? "[".$key."]" : ""?>" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label><br />
											<?
										}
									break;

									case "dropdown":
									case "multiselect":
									?>
							<select name="PROPERTY[<?=$propertyID?>]<?=$type=="multiselect" ? "[]\" size=\"".$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"]."\" multiple=\"multiple" : ""?>">
								<option value=""><?echo GetMessage("CT_BIEAF_PROPERTY_VALUE_NA")?></option>
									<?
										if (intval($propertyID) > 0) $sKey = "ELEMENT_PROPERTIES";
										else $sKey = "ELEMENT";

										foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												foreach ($arResult[$sKey][$propertyID] as $elKey => $arElEnum)
												{
													if ($key == $arElEnum["VALUE"])
													{
														$checked = true;
														break;
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}
											?>
								<option value="<?=$key?>" <?=$checked ? " selected=\"selected\"" : ""?>><?=$arEnum["VALUE"]?></option>
											<?
										}
									?>
							</select>
									<?
									break;

								endswitch;
							break;
						endswitch;?>
					</td>
				</tr>
			<?endforeach;?>
			<?if($arParams["USE_CAPTCHA"] == "Y" && $arParams["ID"] <= 0):?>
				<tr>
					<td><?=GetMessage("IBLOCK_FORM_CAPTCHA_TITLE")?></td>
					<td>
						<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
						<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
					</td>
				</tr>
				<tr>
					<td><?=GetMessage("IBLOCK_FORM_CAPTCHA_PROMPT")?><span class="starrequired">*</span>:</td>
					<td><input type="text" name="captcha_word" maxlength="50" value=""></td>
				</tr>
			<?endif?>
		</tbody>
		<?endif?>
		<tfoot>
			<tr>
				<td colspan="2">
					<input type="submit" name="iblock_submit" value="<?=GetMessage("IBLOCK_FORM_SUBMIT")?>" />
					<?if (strlen($arParams["LIST_URL"]) > 0):?>
						<input type="submit" name="iblock_apply" value="<?=GetMessage("IBLOCK_FORM_APPLY")?>" />
						<input
							type="button"
							name="iblock_cancel"
							value="<? echo GetMessage('IBLOCK_FORM_CANCEL'); ?>"
							onclick="location.href='<? echo CUtil::JSEscape($arParams["LIST_URL"])?>';"
						>
					<?endif?>
				</td>
			</tr>
		</tfoot>
	</table>
</form>
*/?>