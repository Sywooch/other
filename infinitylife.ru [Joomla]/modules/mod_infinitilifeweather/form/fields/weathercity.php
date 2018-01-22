<?php
/**
 * @package     Ghost_Russia.JoomlaSite
 * @subpackage  Templates.Ghost_Russia.FieldWeatherCity
 *
 * @copyright   Copyright (C) 2007 - 2015 Ghost_Russia. All rights reserved.
 * @author Vladislav Fursov
*/

defined('_JEXEC') or die( 'Restricted access' );

class JFormFieldWeatherCity extends JFormField
{
	protected $type = 'WeatherCity';
	
	
	protected function getInput()
	{
        $selectedCountry = $this->form->getData()->jsonSerialize()->params->Country;
        $selectedCity = $this->form->getData()->jsonSerialize()->params->City;
		$html = '';
		$data_file = 'http://weather.yandex.ru/static/cities.xml';
		$xml = simplexml_load_file($data_file);
        $html .= '<select id="city">';
        if($selectedCountry == ""){
            $html .= '<option value="0">--Выберите город--</option>';
        } else {
            $country_id = $selectedCountry;
            $html .= '<option value="0">--Выберите город--</option>'  ;
            foreach ($xml->country as $key => $value) {
                if ($value["name"] == $country_id) {
                    foreach ($value->city as $key1 => $value1) {
                        $add = "";
                        if(trim($value1["id"]) == trim($selectedCity)) $add = "selected";
                        $part = $value1['part'] == "" ? "" : $value1['part'] . ", ";
                        $html .= '<option value="'.$value1["id"].'" '. $add .'>' . $part . $value1 . '</option>'  ;
                    }
                    break ;

                }

            }
        }

        $html .= '</select>';

		return $html;
	}

	protected function getLabel()
	{
		return JText::_('MOD_INFINITILIFEWEATHER_CITY');
	}
}