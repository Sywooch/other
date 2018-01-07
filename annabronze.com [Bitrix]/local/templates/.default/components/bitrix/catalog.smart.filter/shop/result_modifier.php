<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 09.01.2017
 * Time: 16:36
 */



foreach($arResult["ITEMS"] as $key => $item){

    $arrTmp = array_msort($item["VALUES"], array('VALUE' => SORT_ASC));

    $item["VALUES"] = $arrTmp;
    $arResult["ITEMS"][$key]["VALUES"] = $item["VALUES"];

}