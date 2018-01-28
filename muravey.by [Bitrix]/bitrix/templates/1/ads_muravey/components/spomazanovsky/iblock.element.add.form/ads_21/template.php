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
    
    <div class="dostavka-block"><a class="mebel" href="#">Мебель</a></div>
    <input type="hidden" name="PROPERTY[IBLOCK_SECTION][]" value="<?=$arParams['SECTION_ID']?>">
    <a href="<?=SITE_DIR?>#change" class="change-category">Изменить категорию</a>

    <h2>Что нужно перевезти:</h2>
    
    <input type="text" name="PROPERTY[NAME][0]" value="<?=$arResult['ELEMENT']['NAME']?>" class="title" placeholder="Что нужно перевезти"/>
    <br/>
    
    <textarea rows="6" cols="104" name="PROPERTY[DETAIL_TEXT][0]" class="description" placeholder="Этажи спуска/подъема, наличие лифтов и прочие детали перевозки"><?=$arResult['ELEMENT']['DETAIL_TEXT']?></textarea>
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

    <?/*if (($_SERVER['HTTP_X_REAL_IP'] == '134.249.138.77' || $_SERVER['REMOTE_ADDR'] == '134.249.138.77')):?>
    <h2>Откуда, куда, когда:</h2>
    <input type="text" class="from" name="PROPERTY[47][0]" value="Днепропетровск" placeholder="Город (откуда) *"/>
    <input type="text" class="from-street" name="PROPERTY[48][0]" value="Шевченко 10" placeholder="Улица, дом"/>
    <a href="#inline1" class="location fancybox"><img src="<?=SITE_TEMPLATE_PATH?>/img/location.png" alt=""/></a>
    <br/>
    
    <input type="text" class="to" name="PROPERTY[49][0]" value="Витебск" placeholder="Город (куда) *"/>
    <input type="text" class="to-street" name="PROPERTY[50][0]" value="Янки Купалы" placeholder="Улица, дом"/>
    <a href="#inline1" class="location fancybox"><img src="<?=SITE_TEMPLATE_PATH?>/img/location.png" alt=""/></a>
    <br/>
    <?else:?>
    <h2>Откуда, куда, когда:</h2>
    <input type="text" class="from" name="PROPERTY[47][0]" value="<?=$arResult['ELEMENT_PROPERTIES']['47']['0']['VALUE']?>" placeholder="Город (откуда) *"/>
    <input type="text" class="from-street" name="PROPERTY[48][0]" value="<?=$arResult['ELEMENT_PROPERTIES']['48']['0']['VALUE']?>" placeholder="Улица, дом"/>
    <a href="#inline1" class="location fancybox"><img src="<?=SITE_TEMPLATE_PATH?>/img/location.png" alt=""/></a>
    <br/>
    
    <input type="text" class="to" name="PROPERTY[49][0]" value="<?=$arResult['ELEMENT_PROPERTIES']['49']['0']['VALUE']?>" placeholder="Город (куда) *"/>
    <input type="text" class="to-street" name="PROPERTY[50][0]" value="<?=$arResult['ELEMENT_PROPERTIES']['50']['0']['VALUE']?>" placeholder="Улица, дом"/>
    <a href="#inline1" class="location fancybox"><img src="<?=SITE_TEMPLATE_PATH?>/img/location.png" alt=""/></a>
    <br/>
    <?endif*/?>
    
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
    
    <?/*<a href="#" class="add-input"><img src="<?=SITE_TEMPLATE_PATH?>/img/add.png" alt=""/>Добавить поле</a><br/>*/?>
    <br/>
    
    <input type="text" id="date" name="PROPERTY[45][0]" value="<?=$arResult['ELEMENT_PROPERTIES']['45']['0']['VALUE']?>" class="date" placeholder="Дата перевозки"/>
    <input type="text" id="time" name="PROPERTY[46][0]" value="<?=$arResult['ELEMENT_PROPERTIES']['46']['0']['VALUE']?>" class="time" placeholder="Время"/>
    <br/>

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