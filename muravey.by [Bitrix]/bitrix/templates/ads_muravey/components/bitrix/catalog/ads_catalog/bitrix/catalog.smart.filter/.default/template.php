<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

//pred(array($_REQUEST));
//pred(array($arResult));
?>                

<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter" style="display: none;">
    <?foreach($arResult["HIDDEN"] as $arItem):?>
        <input
            type="hidden"
            name="<?echo $arItem["CONTROL_NAME"]?>"
            id="<?echo $arItem["CONTROL_ID"]?>"
            value="<?echo $arItem["HTML_VALUE"]?>"
        />
    <?endforeach;?>
    <div class="filtren">
        <h5><?echo GetMessage("CT_BCSF_FILTER_TITLE")?></h5>
        <ul>
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <?if($arItem["PROPERTY_TYPE"] == "N" || isset($arItem["PRICE"])):?>
            <li class="lvl1"> <a href="#" onclick="BX.toggle(BX('ul_<?echo $arItem["ID"]?>')); return false;" class="showchild"><?=$arItem["NAME"]?></a>
                <ul id="ul_<?echo $arItem["ID"]?>">
                    <?
                        //$arItem["VALUES"]["MIN"]["VALUE"];
                        //$arItem["VALUES"]["MAX"]["VALUE"];
                    ?>
                    <li class="lvl2">
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                    <span class="min-price"><?echo GetMessage("CT_BCSF_FILTER_FROM")?></span>
                                </td>
                                <td>
                                    <span class="max-price"><?echo GetMessage("CT_BCSF_FILTER_TO")?></span>
                                </td>
                            </tr>
                            <tr>
                                <td><input
                                    class="min-price"
                                    type="text"
                                    name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
                                    id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
                                    value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
                                    size="5"
                                    onkeyup="smartFilter.keyup(this)"
                                /></td>
                                <td><input
                                    class="max-price"
                                    type="text"
                                    name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
                                    id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
                                    value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
                                    size="5"
                                    onkeyup="smartFilter.keyup(this)"
                                /></td>
                            </tr>
                        </table>
                    </li>
                </ul>
            </li>
            <?elseif(!empty($arItem["VALUES"])):;?>
            <li class="lvl1"> <a href="#" onclick="BX.toggle(BX('ul_<?echo $arItem["ID"]?>')); return false;" class="showchild"><?=$arItem["NAME"]?></a>
                <ul id="ul_<?echo $arItem["ID"]?>">
                    <?foreach($arItem["VALUES"] as $val => $ar):?>
                    <li class="lvl2<?echo $ar["DISABLED"]? ' lvl2_disabled': ''?>"><input
                        type="checkbox"
                        value="<?echo $ar["HTML_VALUE"]?>"
                        name="<?echo $ar["CONTROL_NAME"]?>"
                        id="<?echo $ar["CONTROL_ID"]?>"
                        <?echo $ar["CHECKED"]? 'checked="checked"': ''?>
                        onclick="smartFilter.click(this)"
                    /><label for="<?echo $ar["CONTROL_ID"]?>"><?echo $ar["VALUE"];?></label></li>
                    <?endforeach;?>
                </ul>
            </li>
            <?endif;?>
        <?endforeach;?>
        </ul>
        <input type="submit" id="set_filter" name="set_filter" value="<?=GetMessage("CT_BCSF_SET_FILTER")?>" />
        <input type="submit" id="del_filter" name="del_filter" value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>" />

        <div class="modef" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?>>
            <?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
            <a href="<?echo $arResult["FILTER_URL"]?>" class="showchild"><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
            <!--<span class="ecke"></span>-->
        </div>
    </div>
</form>
<div class="search-customer-left">
    <div class="criterii">
        <h2>Поиск</h2>
        <ul>
            <li><a href="" class="active" id="region-a">по региону</a></li>
            <li><a href="" id="way-a">по маршруту</a></li>
            <li><a href="" id="number-a">по номеру</a></li>
        </ul>
    </div>
    <div id="region-s">
        <!-- форма поиска по региону -->
        <form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
            <?/*foreach($arResult["HIDDEN"] as $arItem):?>
                <input
                    type="hidden"
                    name="<?echo $arItem["CONTROL_NAME"]?>"
                    id="<?echo $arItem["CONTROL_ID"]?>"
                    value="<?echo $arItem["HTML_VALUE"]?>"
                />
            <?endforeach;*/?>
            
            <h2>Категория объявлений</h2>
            <?=html_entity_decode($arParams['SECTIONS'])?>
            
            <h2>Область поиска</h2>
            <p>
                <select class="select-city">
                    <option>Страна...</option>
                    <?
                    $id = 0;
                    foreach ($arResult['ITEMS']['60']['VALUES'] as $valName => $arVal):
                        ?>
                        <option value="<?=$arVal['HTML_VALUE_ALT']?>" 
                                <?
                                if (
                                    $arVal['CHECKED'] || 
//                                    (empty($_REQUEST[$arVal['CONTROL_NAME_ALT']]) && $id == 0) || 
                                    $_REQUEST[$arVal['CONTROL_NAME_ALT']] == $arVal['HTML_VALUE_ALT']
                                ):?>
                                selected="selected"
                                <?endif?>
                        ><?=$valName?></option>
                        <?
                    $id++;
                    endforeach?>
                </select>
                
                <?
                $id = 0;
                foreach ($arResult['ITEMS']['60']['VALUES'] as $valName => $arVal):
                    ?>
                    <input type="checkbox" value="<?=$arVal['HTML_VALUE_ALT']?>" name="<?=$arVal['CONTROL_NAME_ALT']?>" style="display: none;" 
                    <?if ($arVal['CHECKED'] || /*(empty($_REQUEST[$arVal['CONTROL_NAME_ALT']]) && $id == 0) || */ $_REQUEST[$arVal['CONTROL_NAME_ALT']] == $arVal['HTML_VALUE_ALT']):?>checked="checked"<?endif?> />
                    <?
                $id++;
                endforeach?>
            </p>
            
            <p>
                <select class="select-city">
                    <option>Область...</option>
                    <?
                    $id = 0;
                    foreach ($arResult['ITEMS']['62']['VALUES'] as $valName => $arVal):
                        ?>
                        <option value="<?=$arVal['HTML_VALUE_ALT']?>" 
                                <?
                                if (
                                    $arVal['CHECKED'] || 
//                                    (empty($_REQUEST[$arVal['CONTROL_NAME_ALT']]) && $id == 0) || 
                                    $_REQUEST[$arVal['CONTROL_NAME_ALT']] == $arVal['HTML_VALUE_ALT']
                                ):?>
                                selected="selected"
                                <?endif?>
                        ><?=$valName?></option>
                        <?
                    $id++;
                    endforeach?>
                </select>
                
                <?
                $id = 0;
                foreach ($arResult['ITEMS']['62']['VALUES'] as $valName => $arVal):
                    ?>
                    <input type="checkbox" value="<?=$arVal['HTML_VALUE_ALT']?>" name="<?=$arVal['CONTROL_NAME_ALT']?>" style="display: none;" 
                    <?if ($arVal['CHECKED'] || /*(empty($_REQUEST[$arVal['CONTROL_NAME_ALT']]) && $id == 0) || */ $_REQUEST[$arVal['CONTROL_NAME_ALT']] == $arVal['HTML_VALUE_ALT']):?>checked="checked"<?endif?> />
                    <?
                $id++;
                endforeach?>
            </p>
            
            <p>
                <select class="select-city">
                    <option>Город...</option>
                    <?
                    $id = 0;
                    foreach ($arResult['ITEMS']['47']['VALUES'] as $valName => $arVal):
                        ?>
                        <option value="<?=$arVal['HTML_VALUE_ALT']?>" 
                                <?
                                if (
                                    $arVal['CHECKED'] || 
//                                    (empty($_REQUEST[$arVal['CONTROL_NAME_ALT']]) && $id == 0) || 
                                    $_REQUEST[$arVal['CONTROL_NAME_ALT']] == $arVal['HTML_VALUE_ALT']
                                ):?>
                                selected="selected"
                                <?endif?>
                        ><?=$valName?></option>
                        <?
                    $id++;
                    endforeach?>
                </select>
                
                <?
                $id = 0;
                foreach ($arResult['ITEMS']['47']['VALUES'] as $valName => $arVal):
                    ?>
                    <input type="checkbox" value="<?=$arVal['HTML_VALUE_ALT']?>" name="<?=$arVal['CONTROL_NAME_ALT']?>" style="display: none;" 
                    <?if ($arVal['CHECKED'] || /*(empty($_REQUEST[$arVal['CONTROL_NAME_ALT']]) && $id == 0) || */ $_REQUEST[$arVal['CONTROL_NAME_ALT']] == $arVal['HTML_VALUE_ALT']):?>checked="checked"<?endif?> />
                    <?
                $id++;
                endforeach?>
            </p>
            
            <?
            /*<h2>Расстояние</h2>
            <p>
                <span>от</span><input type="text"/> км
            </p>
            <p>
                <span>до</span><input type="text"/> км
            </p>
            */?>
            
            <h2>Расстояние</h2>
            <p>
                <span>от</span>
                <input type="text" name="arrFilter_57_MIN" value="<?=$arResult['ITEMS']['57']['VALUES']['MIN']['HTML_VALUE']?>" /> км
            </p>
            <p>
                <span>до</span>
                <input type="text" name="arrFilter_57_MAX" value="<?=$arResult['ITEMS']['57']['VALUES']['MAX']['HTML_VALUE']?>" /> км
            </p>
            
            <h2>Вес</h2>
            <p>
                <span>от</span>
                <input type="text" name="arrFilter_43_MIN" value="<?=$arResult['ITEMS']['43']['VALUES']['MIN']['HTML_VALUE']?>" /> кг
            </p>
            <p>
                <span>до</span>
                <input type="text" name="arrFilter_43_MAX" value="<?=$arResult['ITEMS']['43']['VALUES']['MAX']['HTML_VALUE']?>" /> кг
            </p>
            
            <h2>Дата перевозок</h2>
            <p>
                <span>с</span>
                <input type="text" id="arrFilter_45_MIN" name="arrFilter_45_MIN" value="<?=$arResult['ITEMS']['45']['VALUES']['MIN']['HTML_VALUE']?>" />
            </p>
            <p>
                <span>по</span>
                <input type="text" id="arrFilter_45_MAX" name="arrFilter_45_MAX" value="<?=$arResult['ITEMS']['45']['VALUES']['MAX']['HTML_VALUE']?>" />
            </p>
            
            <p><input type="checkbox" value="Y" name="arrFilter_55_2944839123" <?if ($arResult['ITEMS']['55']['VALUES']['18']['CHECKED'] || $_REQUEST['arrFilter_55_2944839123'] == 'Y'):?>checked="checked"<?endif?>> Ставок нет</p>
            
            <?/*<p style="margin-top: 25px;">Фильтр категорий</p>
            <p style="text-align: center;">
                <input type="button" id="category-b-s" value="Категории"/>
            </p>
            */?>
            <p style="text-align: center;">
                <input type="submit" id="search-b-s" name="set_filter" value="Найти">
            </p>
            
            <input type="hidden" name="tab" value="region-" />
        </form>
    </div>
    <div id="way-s">
        <!-- форма поиска по маршруту -->
        <form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
            <?/*foreach($arResult["HIDDEN"] as $arItem):?>
                <input
                    type="hidden"
                    name="<?echo $arItem["CONTROL_NAME"]?>"
                    id="<?echo $arItem["CONTROL_ID"]?>"
                    value="<?echo $arItem["HTML_VALUE"]?>"
                />
            <?endforeach;*/?>
            
            <h2>Откуда</h2>
            <p>
                <select class="select-city">
                    <option>Страна...</option>
                    <?
                    $id = 0;
                    foreach ($arResult['ITEMS']['60']['VALUES'] as $valName => $arVal):
                        ?>
                        <option value="<?=$arVal['HTML_VALUE_ALT']?>" 
                                <?
                                if (
                                    $arVal['CHECKED'] || 
//                                    (empty($_REQUEST[$arVal['CONTROL_NAME_ALT']]) && $id == 0) || 
                                    $_REQUEST[$arVal['CONTROL_NAME_ALT']] == $arVal['HTML_VALUE_ALT']
                                ):?>
                                selected="selected"
                                <?endif?>
                        ><?=$valName?></option>
                        <?
                    $id++;
                    endforeach?>
                </select>
                
                <?
                $id = 0;
                foreach ($arResult['ITEMS']['60']['VALUES'] as $valName => $arVal):
                    ?>
                    <input type="checkbox" value="<?=$arVal['HTML_VALUE_ALT']?>" name="<?=$arVal['CONTROL_NAME_ALT']?>" style="display: none;" 
                    <?if ($arVal['CHECKED'] || /*(empty($_REQUEST[$arVal['CONTROL_NAME_ALT']]) && $id == 0) || */ $_REQUEST[$arVal['CONTROL_NAME_ALT']] == $arVal['HTML_VALUE_ALT']):?>checked="checked"<?endif?> />
                    <?
                $id++;
                endforeach?>
            </p>
            <p>
                <select class="select-city">
                    <option>Область...</option>
                    <?
                    $id = 0;
                    foreach ($arResult['ITEMS']['62']['VALUES'] as $valName => $arVal):
                        ?>
                        <option value="<?=$arVal['HTML_VALUE_ALT']?>" 
                                <?
                                if (
                                    $arVal['CHECKED'] || 
//                                    (empty($_REQUEST[$arVal['CONTROL_NAME_ALT']]) && $id == 0) || 
                                    $_REQUEST[$arVal['CONTROL_NAME_ALT']] == $arVal['HTML_VALUE_ALT']
                                ):?>
                                selected="selected"
                                <?endif?>
                        ><?=$valName?></option>
                        <?
                    $id++;
                    endforeach?>
                </select>
                
                <?
                $id = 0;
                foreach ($arResult['ITEMS']['62']['VALUES'] as $valName => $arVal):
                    ?>
                    <input type="checkbox" value="<?=$arVal['HTML_VALUE_ALT']?>" name="<?=$arVal['CONTROL_NAME_ALT']?>" style="display: none;" 
                    <?if ($arVal['CHECKED'] || /*(empty($_REQUEST[$arVal['CONTROL_NAME_ALT']]) && $id == 0) || */ $_REQUEST[$arVal['CONTROL_NAME_ALT']] == $arVal['HTML_VALUE_ALT']):?>checked="checked"<?endif?> />
                    <?
                $id++;
                endforeach?>
            </p>
            <p>
                <select class="select-city">
                    <option>Город...</option>
                    <?
                    $id = 0;
                    foreach ($arResult['ITEMS']['47']['VALUES'] as $valName => $arVal):
                        ?>
                        <option value="<?=$arVal['HTML_VALUE_ALT']?>" 
                                <?
                                if (
                                    $arVal['CHECKED'] || 
//                                    (empty($_REQUEST[$arVal['CONTROL_NAME_ALT']]) && $id == 0) || 
                                    $_REQUEST[$arVal['CONTROL_NAME_ALT']] == $arVal['HTML_VALUE_ALT']
                                ):?>
                                selected="selected"
                                <?endif?>
                        ><?=$valName?></option>
                        <?
                    $id++;
                    endforeach?>
                </select>
                
                <?
                $id = 0;
                foreach ($arResult['ITEMS']['47']['VALUES'] as $valName => $arVal):
                    ?>
                    <input type="checkbox" value="<?=$arVal['HTML_VALUE_ALT']?>" name="<?=$arVal['CONTROL_NAME_ALT']?>" style="display: none;" 
                    <?if ($arVal['CHECKED'] || /*(empty($_REQUEST[$arVal['CONTROL_NAME_ALT']]) && $id == 0) || */ $_REQUEST[$arVal['CONTROL_NAME_ALT']] == $arVal['HTML_VALUE_ALT']):?>checked="checked"<?endif?> />
                    <?
                $id++;
                endforeach?>
            </p>
            
            <h2>Куда</h2>
            <p>
                <select class="select-city">
                    <option>Страна...</option>
                    <?
                    $id = 0;
                    foreach ($arResult['ITEMS']['61']['VALUES'] as $valName => $arVal):
                        ?>
                        <option value="<?=$arVal['HTML_VALUE_ALT']?>" 
                                <?
                                if (
                                    $arVal['CHECKED'] || 
//                                    (empty($_REQUEST[$arVal['CONTROL_NAME_ALT']]) && $id == 0) || 
                                    $_REQUEST[$arVal['CONTROL_NAME_ALT']] == $arVal['HTML_VALUE_ALT']
                                ):?>
                                selected="selected"
                                <?endif?>
                        ><?=$valName?></option>
                        <?
                    $id++;
                    endforeach?>
                </select>
                
                <?
                $id = 0;
                foreach ($arResult['ITEMS']['61']['VALUES'] as $valName => $arVal):
                    ?>
                    <input type="checkbox" value="<?=$arVal['HTML_VALUE_ALT']?>" name="<?=$arVal['CONTROL_NAME_ALT']?>" style="display: none;" 
                    <?if ($arVal['CHECKED'] || /*(empty($_REQUEST[$arVal['CONTROL_NAME_ALT']]) && $id == 0) || */ $_REQUEST[$arVal['CONTROL_NAME_ALT']] == $arVal['HTML_VALUE_ALT']):?>checked="checked"<?endif?> />
                    <?
                $id++;
                endforeach?>
            </p>
            <p>
                <select class="select-city">
                    <option>Область...</option>
                    <?
                    $id = 0;
                    foreach ($arResult['ITEMS']['63']['VALUES'] as $valName => $arVal):
                        ?>
                        <option value="<?=$arVal['HTML_VALUE_ALT']?>" 
                                <?
                                if (
                                    $arVal['CHECKED'] || 
//                                    (empty($_REQUEST[$arVal['CONTROL_NAME_ALT']]) && $id == 0) || 
                                    $_REQUEST[$arVal['CONTROL_NAME_ALT']] == $arVal['HTML_VALUE_ALT']
                                ):?>
                                selected="selected"
                                <?endif?>
                        ><?=$valName?></option>
                        <?
                    $id++;
                    endforeach?>
                </select>
                
                <?
                $id = 0;
                foreach ($arResult['ITEMS']['63']['VALUES'] as $valName => $arVal):
                    ?>
                    <input type="checkbox" value="<?=$arVal['HTML_VALUE_ALT']?>" name="<?=$arVal['CONTROL_NAME_ALT']?>" style="display: none;" 
                    <?if ($arVal['CHECKED'] || /*(empty($_REQUEST[$arVal['CONTROL_NAME_ALT']]) && $id == 0) || */ $_REQUEST[$arVal['CONTROL_NAME_ALT']] == $arVal['HTML_VALUE_ALT']):?>checked="checked"<?endif?> />
                    <?
                $id++;
                endforeach?>
            </p>
            <p>
                <select class="select-city">
                    <option>Город...</option>
                    <?
                    $id = 0;
                    foreach ($arResult['ITEMS']['49']['VALUES'] as $valName => $arVal):
                        ?>
                        <option value="<?=$arVal['HTML_VALUE_ALT']?>" 
                                <?
                                if (
                                    $arVal['CHECKED'] || 
//                                    (empty($_REQUEST[$arVal['CONTROL_NAME_ALT']]) && $id == 0) || 
                                    $_REQUEST[$arVal['CONTROL_NAME_ALT']] == $arVal['HTML_VALUE_ALT']
                                ):?>
                                selected="selected"
                                <?endif?>
                        ><?=$valName?></option>
                        <?
                    $id++;
                    endforeach?>
                </select>
                
                <?
                $id = 0;
                foreach ($arResult['ITEMS']['49']['VALUES'] as $valName => $arVal):
                    ?>
                    <input type="checkbox" value="<?=$arVal['HTML_VALUE_ALT']?>" name="<?=$arVal['CONTROL_NAME_ALT']?>" style="display: none;" 
                    <?if ($arVal['CHECKED'] || /*(empty($_REQUEST[$arVal['CONTROL_NAME_ALT']]) && $id == 0) || */ $_REQUEST[$arVal['CONTROL_NAME_ALT']] == $arVal['HTML_VALUE_ALT']):?>checked="checked"<?endif?> />
                    <?
                $id++;
                endforeach?>
            </p>
            
            <?
            /*
            <h2>Откуда</h2>
            <p>
                <select class="select-city">
                    <?
                    $id = 0;
                    foreach ($arResult['ITEMS']['47']['VALUES'] as $valName => $arVal):
                        ?>
                        <option value="<?=$arVal['HTML_VALUE_ALT']?>" 
                                <?
                                if (
                                    $arVal['CHECKED'] || 
                                    (empty($_REQUEST[$arVal['CONTROL_NAME_ALT']]) && $id == 0) || 
                                    $_REQUEST[$arVal['CONTROL_NAME_ALT']] == $arVal['HTML_VALUE_ALT']
                                ):?>
                                selected="selected"
                                <?endif?>
                        ><?=$valName?></option>
                        <?
                    $id++;
                    endforeach?>
                </select>
                
                <?
                $id = 0;
                foreach ($arResult['ITEMS']['47']['VALUES'] as $valName => $arVal):
                    ?>
                    <input type="checkbox" value="<?=$arVal['HTML_VALUE_ALT']?>" name="<?=$arVal['CONTROL_NAME_ALT']?>" style="display: none;" <?if ($arVal['CHECKED'] || (empty($_REQUEST[$arVal['CONTROL_NAME_ALT']]) && $id == 0) || $_REQUEST[$arVal['CONTROL_NAME_ALT']] == $arVal['HTML_VALUE_ALT']):?>checked="checked"<?endif?> />
                    <?
                $id++;
                endforeach?>
            </p>
            <h2>Куда</h2>
            <p>
                <select class="select-city">
                    <?
                    $id = 0;
                    foreach ($arResult['ITEMS']['49']['VALUES'] as $valName => $arVal):
                        ?>
                        <option value="<?=$arVal['HTML_VALUE_ALT']?>" 
                                <?
                                if (
                                    $arVal['CHECKED'] || 
                                    (empty($_REQUEST[$arVal['CONTROL_NAME_ALT']]) && $id == 0) || 
                                    $_REQUEST[$arVal['CONTROL_NAME_ALT']] == $arVal['HTML_VALUE_ALT']
                                ):?>
                                selected="selected"
                                <?endif?>
                        ><?=$valName?></option>
                        <?
                    $id++;
                    endforeach?>
                </select>
                
                <?
                $id = 0;
                foreach ($arResult['ITEMS']['49']['VALUES'] as $valName => $arVal):
                    ?>
                    <input type="checkbox" value="<?=$arVal['HTML_VALUE_ALT']?>" name="<?=$arVal['CONTROL_NAME_ALT']?>" style="display: none;" <?if ($arVal['CHECKED'] || (empty($_REQUEST[$arVal['CONTROL_NAME_ALT']]) && $id == 0) || $_REQUEST[$arVal['CONTROL_NAME_ALT']] == $arVal['HTML_VALUE_ALT']):?>checked="checked"<?endif?> />
                    <?
                $id++;
                endforeach?>
            </p>
            */
            ?>
            
            <h2>Расстояние</h2>
            <p>
                <span>от</span>
                <input type="text" name="arrFilter_57_MIN" value="<?=$arResult['ITEMS']['57']['VALUES']['MIN']['HTML_VALUE']?>" /> км
            </p>
            <p>
                <span>до</span>
                <input type="text" name="arrFilter_57_MAX" value="<?=$arResult['ITEMS']['57']['VALUES']['MAX']['HTML_VALUE']?>" /> км
            </p>
            
            <h2>Вес</h2>
            <p>
                <span>от</span>
                <input type="text" name="arrFilter_43_MIN" value="<?=$arResult['ITEMS']['43']['VALUES']['MIN']['HTML_VALUE']?>" /> кг
            </p>
            <p>
                <span>до</span>
                <input type="text" name="arrFilter_43_MAX" value="<?=$arResult['ITEMS']['43']['VALUES']['MAX']['HTML_VALUE']?>" /> кг
            </p>
            
            <p><input type="checkbox" value="Y" name="arrFilter_55_2944839123" <?if ($arResult['ITEMS']['55']['VALUES']['18']['CHECKED'] || $_REQUEST['arrFilter_55_2944839123'] == 'Y'):?>checked="checked"<?endif?>> Ставок нет</p>
            
            <?/*
            <p style="margin-top: 25px;">Фильтр категорий</p>
            <p style="text-align: center;">
                <input type="button" id="category-b-s" value="Категории"/>
            </p>
            */?>
            
            <p style="text-align: center;">
                <input type="submit" id="search-b-s" name="set_filter" value="Найти">
            </p>
            
            <input type="hidden" name="tab" value="way-" />
        </form>
    </div>
    <div id="number-s">
        <!-- форма поиска по номеру -->
        <form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
            <?/*foreach($arResult["HIDDEN"] as $arItem):?>
                <input
                    type="hidden"
                    name="<?echo $arItem["CONTROL_NAME"]?>"
                    id="<?echo $arItem["CONTROL_ID"]?>"
                    value="<?echo $arItem["HTML_VALUE"]?>"
                />
            <?endforeach;*/?>
            <h2>Номер</h2>
            <p>
                <input style="width: 100%;" name="arrFilter[ID]" value="<?=$_REQUEST[$arParams['FILTER_NAME']]['ID']?>" type="text"/>
            </p>
            <p style="text-align: center;">
                <input type="submit" id="search-b-s" name="set_filter" value="Найти">
            </p>
            
            <input type="hidden" name="tab" value="number-" />
        </form>
    </div>
</div>

<script type="text/javascript">
//js для выбора формы критерия поиска
currentTab = '#<?=$_REQUEST['tab']?>';

$(document).ready(function () 
{
    $('#region-s').show();
    $('#way-s').hide();
    $('#number-s').hide();

    $('#region-a').click(function (event) 
    {
        event.preventDefault();
        $('#way-s').hide();
        $('#number-s').hide();
        $('#region-s').show();
        $('#way-a').removeClass("active");
        $('#number-a').removeClass("active");
        $('#region-a').addClass("active");
        
        $('.wrapper').css('min-height', $('#region-s').outerHeight() + 140);
    });

    $('#number-a').click(function (event) {
        event.preventDefault();
        $('#way-s').hide();
        $('#region-s').hide();
        $('#number-s').show();
        $('#way-a').removeClass("active");
        $('#region-a').removeClass("active");
        $('#number-a').addClass("active");
        
        $('.wrapper').css('min-height', $('#number-s').outerHeight() + 140);
    });

    $('#way-a').click(function (event) {
        event.preventDefault();
        $('#region-s').hide();
        $('#number-s').hide();
        $('#way-s').show();
        $('#region-a').removeClass("active");
        $('#number-a').removeClass("active");
        $('#way-a').addClass("active");
        
        $('.wrapper').css('min-height', $('#way-s').outerHeight() + 140);
    });
    
    if (!$('.search-customer-right tbody tr[id]').length)
        $('.content .wrapper').css('min-height', $('#region-s').outerHeight() + 140);
    
    $('.select-city').change(function(e)
    {
        e.preventDefault();
        
        curName = $(this).val();
        
        console.log(curName);
            
        $(this).closest('p').find('input[type=checkbox]').removeAttr('checked');
        $(this).closest('p').find('input[type=checkbox][value="'+ curName +'"]').attr('checked', 'checked');
            
        return false; 
    });
    
    if (currentTab.length > 1)
    {
        $('.criterii ul li a').removeClass('active');
        $(currentTab + 'a').toggleClass('active');
        
        $('.search-customer-left div[id]').hide();
        $(currentTab + 's').show();
        
        $(currentTab).show();
    }
    
    $('.select-category').change(function(e)
    {
        e.preventDefault();
        
        location.assign($(this).val());
        
        return false; 
    });
});
</script>