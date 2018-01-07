<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>







<div class="section">



<div class="b-order__section _lined">
	<div class="grid-container">
		<div class="grid-row col-1 col-xm-12 col-s-12"></div>
		<div class="grid-row col-10 col-xm-12 col-s-12">
			<div class="b-order__section-title"><?=GetMessage("SOA_TEMPL_INFORMATION_ABOUT_THE_CUSTOMER")?></div>
		</div>
	</div>






	<div class="grid-container tmp1">




        <?

        function PrintPropsForm($arSource=Array(), $locationTemplate = "popup")
        {

           // echo "<pre>";
           // print_r($arSource);
           // echo "</pre>";

            if (!empty($arSource))
            {

        ?>



                <?


                unset($arResultProperties);
                foreach($arSource as $arProperties)
                {
                    if(LANGUAGE_ID==='en'){
                        $orderProp = "ORDER_PROP_39";
                    }else{
                        $orderProp = "ORDER_PROP_1";
                    }
                    if($arProperties["FIELD_NAME"]==$orderProp) {
                        $arResultProperties[0] = $arProperties;
                        continue;
                    }

                    if(LANGUAGE_ID==='en'){
                        $orderProp = "ORDER_PROP_40";
                    }else{
                        $orderProp = "ORDER_PROP_2";
                    }
                    if($arProperties["FIELD_NAME"]==$orderProp) {
                        $arResultProperties[1] = $arProperties;
                        continue;
                    }

                    if(LANGUAGE_ID==='en'){
                        $orderProp = "ORDER_PROP_41";
                    }else{
                        $orderProp = "ORDER_PROP_3";
                    }
                    if($arProperties["FIELD_NAME"]==$orderProp) {
                        $arResultProperties[2] = $arProperties;
                        continue;
                    }

                    if(LANGUAGE_ID==='en'){
                        $orderProp = "61";
                    }else{
                        $orderProp = "60";
                    }
                    if ($arProperties["ID"] == $orderProp){


                        $arResultProperties[3] = $arProperties;
                        continue;
                    }

                    if(LANGUAGE_ID==='en'){
                        $orderProp = "59";
                    }else{
                        $orderProp = "58";
                    }
                    if ($arProperties["ID"] == $orderProp){
                        $arResultProperties[4] = $arProperties;
                        continue;
                    }


                    if(LANGUAGE_ID==='en'){
                        $orderProp = "ORDER_PROP_45";
                    }else{
                        $orderProp = "ORDER_PROP_7";
                    }
                    if($arProperties["FIELD_NAME"] == $orderProp){

                        $arResultProperties[5] = $arProperties;
                        break;
                    }

                }
                ?>



                <div class="grid-row col-1 col-xm-12 col-s-12"></div>
                <div class="grid-row col-4 col-s-12">

                            <?
                                global $USER;
                                if($USER->IsAuthorized()){
                                    $defaultEmail = $USER->GetEmail();
                                    $defaultPhone = $USER->GetParam("PERSONAL_PHONE");
                                    $defaultName = $USER->GetFullName();
                                }


                            ?>

                            <div class="b-form__row">
                                <input placeholder="<?= GetMessage("SOA_TEMPL_ORDER_PROP_1") ?> *" type="text"
                                       class="b-form__input" maxlength="250" size="<?=$arResultProperties[0]["SIZE1"]?>"
                                       value="<?=$arResultProperties[0]["VALUE"]?:$defaultName?>" name="<?=$arResultProperties[0]["FIELD_NAME"]?>"
                                       id="<?=$arResultProperties[0]["FIELD_NAME"]?>">

                            </div>

                            <div class="b-form__row">
                                <input placeholder="<?= GetMessage("SOA_TEMPL_ORDER_PROP_2") ?> *" type="text"
                                       class="b-form__input" maxlength="250" size="<?=$arResultProperties[1]["SIZE1"]?>"
                                       value="<?=$arResultProperties[1]["VALUE"]?:$defaultEmail?>" name="<?=$arResultProperties[1]["FIELD_NAME"]?>"
                                       id="<?=$arResultProperties[1]["FIELD_NAME"]?>">

                            </div>

                            <div class="b-form__row">
                                <input placeholder="<?= GetMessage("SOA_TEMPL_ORDER_PROP_3") ?> *" type="text"
                                       class="b-form__input" maxlength="250" size="<?=$arResultProperties[2]["SIZE1"]?>"
                                       value="<?=$arResultProperties[2]["VALUE"]?:$defaultPhone?>" name="<?=$arResultProperties[2]["FIELD_NAME"]?>"
                                       id="<?=$arResultProperties[2]["FIELD_NAME"]?>">

                            </div>



					<div></div>
                </div>


                <div class="grid-row col-3 col-xm-4  col-s-12">


                <?
                unset($arPropertiesTmp);
                foreach($arSource as $arProperties)
                {
                    $arPropertiesTmp[$arProperties["ID"]] = $arProperties;

                    ?>

                    <? if ($arProperties["TYPE"] == "LOCATION"){ ?>

                        <?
                        $value = 0;
                        if (is_array($arProperties["VARIANTS"]) && count($arProperties["VARIANTS"]) > 0) {
                            foreach ($arProperties["VARIANTS"] as $arVariant) {
                                if ($arVariant["SELECTED"] == "Y") {
                                    $value = $arVariant["ID"];
                                    break;
                                }
                            }
                        }

                        if ($_REQUEST["ORDER_PROP_" . $arProperties["ID"]]) {
                            $value = $_REQUEST["ORDER_PROP_" . $arProperties["ID"]];
                        }

                        $arParams["TEMPLATE_LOCATION"] = "shop";
                        //$arParams["TEMPLATE_LOCATION"] = ".default";


                        /*$GLOBALS["APPLICATION"]->IncludeComponent(
                            "bitrix:sale.ajax.locations",
                            $arParams["TEMPLATE_LOCATION"],
                            array(
                                "AJAX_CALL" => "N",
                                "COUNTRY_INPUT_NAME" => "COUNTRY",
                                "REGION_INPUT_NAME" => "REGION",
                                "CITY_INPUT_NAME" => $arProperties["FIELD_NAME"],
                                "CITY_OUT_LOCATION" => "Y",
                                "LOCATION_VALUE" => $value,
                                "ORDER_PROPS_ID" => $arProperties["ID"],
                                "ONCITYCHANGE" => ($arProperties["IS_LOCATION"] == "Y" || $arProperties["IS_LOCATION4TAX"] == "Y") ? "submitForm()" : "",
                                "SIZE1" => $arProperties["SIZE1"],
                            ),
                            null,
                            array('HIDE_ICONS' => 'Y')
                        );
*/
                        ?>  

                    <?
                    if(LANGUAGE_ID==='en'){
                        $location = "ORDER_PROP_44";
                    }else{
                        $location = "ORDER_PROP_6";
                    }

                    $GLOBALS["APPLICATION"]->IncludeComponent(
                        "bitrix:sale.location.selector.steps",
                        "shop",//""
                        Array(
                            "COMPONENT_TEMPLATE" => ".default",
                            "ID" => "980",
                            "CODE" => "",
                            "INPUT_NAME" => $location,//LOCATION 44
                            "PROVIDE_LINK_BY" => "id",
                            "JSCONTROL_GLOBAL_ID" => "",
                            "JS_CALLBACK" => "",//locationSelector
                            "FILTER_BY_SITE" => "Y",
                            "SHOW_DEFAULT_LOCATIONS" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "36000000",
                            "FILTER_SITE_ID" => SITE_ID,//
                            "PRECACHE_LAST_LEVEL" => "N",
                            "PRESELECT_TREE_TRUNK" => "N",
                            "DISABLE_KEYBOARD_INPUT" => "N",
                            "INITIALIZE_BY_GLOBAL_EVENT" => "",
                            "SUPPRESS_ERRORS" => "N",

                        )
                    );?>

                    <?/*$GLOBALS["APPLICATION"]->IncludeComponent(
                        "bitrix:sale.location.selector.steps",
                        ".default",
                        array(
                        ),
                        false
                    );*/?>






                <? } ?>
                    <?
                    if(LANGUAGE_ID==='en'){
                    ?>
                        <? if ($arProperties["ID"] == "61"){ ?>

                        <input placeholder="<?echo GetMessage('SOA_TEMPL_INDEX')?>" type="text" class="b-form__input ORDER_PROP_INDEX"
                               maxlength="250" size="<?=$arProperties["SIZE1"]?>" value="<?=$arProperties["VALUE"]?>"
                               name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>"
                               style="display:none;">

                        <? } ?>

                    <? }else{ ?>
                        <? if ($arProperties["ID"] == "60"){ ?>

                            <input placeholder="<?echo GetMessage('SOA_TEMPL_INDEX')?>" type="text" class="b-form__input ORDER_PROP_INDEX"
                                   maxlength="250" size="<?=$arProperties["SIZE1"]?>" value="<?=$arProperties["VALUE"]?>"
                                   name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>"
                                   style="display:none;">

                        <? } ?>
                    <? } ?>


                    <?
                }

                ?>




                <?
                if(LANGUAGE_ID==='en') {
                    ?>
                    <input placeholder="<? echo GetMessage('SOA_TEMPL_CITY') ?>" type="text"
                           class="b-form__input ORDER_PROP_CITY"
                           maxlength="250" size="<?= $arPropertiesTmp[59]["SIZE1"] ?>"
                           value="<?= $arPropertiesTmp[59]["VALUE"] ?>"
                           name="<?= $arPropertiesTmp[59]["FIELD_NAME"] ?>"
                           id="<?= $arPropertiesTmp[59]["FIELD_NAME"] ?>"
                           style="display:none;">
                    <?
                }else{
                    ?>
                    <input placeholder="<? echo GetMessage('SOA_TEMPL_CITY') ?>" type="text"
                           class="b-form__input ORDER_PROP_CITY"
                           maxlength="250" size="<?= $arPropertiesTmp[58]["SIZE1"] ?>"
                           value="<?= $arPropertiesTmp[58]["VALUE"] ?>"
                           name="<?= $arPropertiesTmp[58]["FIELD_NAME"] ?>"
                           id="<?= $arPropertiesTmp[58]["FIELD_NAME"] ?>"
                           style="display:none;">

                    <?
                }
                    ?>





                    <div></div>
                </div>



                <div class="grid-row col-3 col-xm-4 col-s-12">

                            <div class="b-form__row">
                                <textarea class="b-form__textarea _big-height"
                                          placeholder="<?=GetMessage("SOA_TEMPL_DELIVERY")?> *"
                                          rows="<?=$arResultProperties[5]["SIZE2"]?>"
                                          cols="<?=$arResultProperties[5]["SIZE1"]?>"
                                          name="<?=$arResultProperties[5]["FIELD_NAME"]?>"
                                          id="<?=$arResultProperties[5]["FIELD_NAME"]?>"><?=$arResultProperties[5]["VALUE"]?></textarea>

                            </div>

                    <div></div>
                </div>




                <?
                return true;
            }
            return false;
        }
        ?>

        <table class="sale_order_table props" id="sale_order_props" <?=($bHideProps && $_POST["showProps"] != "Y")?"style='display:none;'":''?>>

        <?
        $arResultUserProp = array_merge($arResult["ORDER_PROP"]["USER_PROPS_Y"], $arResult["ORDER_PROP"]["USER_PROPS_N"]);

        PrintPropsForm($arResultUserProp, $arParams["TEMPLATE_LOCATION"]);
        //PrintPropsForm($arResult["ORDER_PROP"]["USER_PROPS_N"], $arParams["TEMPLATE_LOCATION"]);
        ?>

        <?
        //PrintPropsForm($arResult["ORDER_PROP"]["USER_PROPS_Y"], $arParams["TEMPLATE_LOCATION"]);
        ?>
        </table>



            </div>



        <?
        $bHideProps = false;
        ?>


<!--
        <table class="sale_order_table props" id="sale_order_props" <?=($bHideProps && $_POST["showProps"] != "Y")?"style='display:none;'":''?>>
        <?
        //PrintPropsForm($arResult["ORDER_PROP"]["USER_PROPS_N"], $arParams["TEMPLATE_LOCATION"]);
        //PrintPropsForm($arResult["ORDER_PROP"]["USER_PROPS_Y"], $arParams["TEMPLATE_LOCATION"]);
        ?>
        </table>-->

        <script type="text/javascript">
            function fGetBuyerProps(el)
            {
                var show = '<?=GetMessageJS('SOA_TEMPL_BUYER_SHOW')?>';
                var hide = '<?=GetMessageJS('SOA_TEMPL_BUYER_HIDE')?>';
                var status = BX('sale_order_props').style.display;
                var startVal = 0;
                var startHeight = 0;
                var endVal = 0;
                var endHeight = 0;
                var pFormCont = BX('sale_order_props');
                pFormCont.style.display = "block";
                pFormCont.style.overflow = "hidden";
                pFormCont.style.height = 0;
                var display = "";

                if (status == 'none')
                {
                    el.text = '<?=GetMessageJS('SOA_TEMPL_BUYER_HIDE');?>';

                    startVal = 0;
                    startHeight = 0;
                    endVal = 100;
                    endHeight = pFormCont.scrollHeight;
                    display = 'block';
                    BX('showProps').value = "Y";
                    el.innerHTML = hide;
                }
                else
                {
                    el.text = '<?=GetMessageJS('SOA_TEMPL_BUYER_SHOW');?>';

                    startVal = 100;
                    startHeight = pFormCont.scrollHeight;
                    endVal = 0;
                    endHeight = 0;
                    display = 'none';
                    BX('showProps').value = "N";
                    pFormCont.style.height = startHeight+'px';
                    el.innerHTML = show;
                }

                (new BX.easing({
                    duration : 700,
                    start : { opacity : startVal, height : startHeight},
                    finish : { opacity: endVal, height : endHeight},
                    transition : BX.easing.makeEaseOut(BX.easing.transitions.quart),
                    step : function(state){
                        pFormCont.style.height = state.height + "px";
                        pFormCont.style.opacity = state.opacity / 100;
                    },
                    complete : function(){
                            BX('sale_order_props').style.display = display;
                            BX('sale_order_props').style.height = '';
                    }
                })).animate();
            }
        </script>




        </div>

        </div>


        <?

        ?>



        <div style="display:none;">
            <?/*
            $APPLICATION->IncludeComponent(
                "bitrix:sale.ajax.locations",
                $arParams["TEMPLATE_LOCATION"],
                array(
                    "AJAX_CALL" => "N",
                    "COUNTRY_INPUT_NAME" => "COUNTRY_tmp",
                    "REGION_INPUT_NAME" => "REGION_tmp",
                    "CITY_INPUT_NAME" => "tmp",
                    "CITY_OUT_LOCATION" => "Y",
                    "LOCATION_VALUE" => "",
                    "ONCITYCHANGE" => "submitForm()",
                ),
                null,
                array('HIDE_ICONS' => 'Y')
            );*/
            ?>
        </div>







