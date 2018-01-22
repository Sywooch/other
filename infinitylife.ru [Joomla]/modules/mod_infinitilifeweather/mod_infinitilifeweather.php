<?php
/**
 * @package     Ghost_Russia.JoomlaSite
 * @subpackage  Templates.Ghost_Russia.mod_infinitilifeClock
 *
 * @copyright   Copyright (C) 2007 - 2015 Ghost_Russia. All rights reserved.
 * @author Vladislav Fursov
 */

defined('_JEXEC') or die;

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require_once dirname(__FILE__) . '/helper.php';
$cityData = ModInfinitilifeWeatherHelper::getWeather($params->get("City"), 7);

$weather = new stdClass();

// fact
$weather->temp = $cityData['fact']['weather']['temp'];
$weather->type = $cityData['fact']['weather']['weather_type'];
$weather->image = $cityData['fact']['weather']['image'];
$weather->wind = $cityData['fact']['weather']['wind_speed'];
$weather->day = $cityData['fact']['full_day_of_week'];
$weather->day_num = $cityData['fact']['day'];


for($i = 0; $i <= 6; $i++){
	$weather->$i = new stdClass();
    $weather->$i->temp = $cityData[$i]['weather'][1]['temp_avg'];
    $weather->$i->image = $cityData[$i]['weather'][1]['image'];
    $weather->$i->day = $cityData[$i]['day_of_week'];
    $weather->$i->full_day_of_week=$cityData[$i]['full_day_of_week'];
    $weather->$i->day_num = $cityData[$i]['day'];
    $weather->$i->wind = $cityData[$i]['wind'];
}

require JModuleHelper::getLayoutPath('mod_infinitilifeweather', $params->get('layout', 'default'));
