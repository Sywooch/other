<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 19.12.2016
 * Time: 18:32
 */

if(count($arResult['CITY_LIST']) > 3000 ){
//die();
    $arResult['CITY_LIST'] = array_slice($arResult['CITY_LIST'],0,2999);
}
