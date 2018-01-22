<?php
/**
 * @package     Ghost_Russia.JoomlaSite
 * @subpackage  Templates.Ghost_Russia.FieldWeatherCountry
 *
 * @copyright   Copyright (C) 2007 - 2015 Ghost_Russia. All rights reserved.
 * @author Vladislav Fursov
*/

defined('_JEXEC') or die( 'Restricted access' );

$doc = JFactory::getDocument();
$doc->addScript(JURI::base() . '../modules/mod_infinitilifeWeather/js/script.js');

class JFormFieldWeatherCountry extends JFormField
{
	protected $type = 'WeatherCountry';
	
	
	protected function getInput()
	{
        $selected = $this->form->getData()->jsonSerialize()->params->Country;
		$html = "";
		$data_file = 'http://weather.yandex.ru/static/cities.xml';
		$xml = simplexml_load_file($data_file);
		$html .= '<select id="country"><option value="0">--Выберите страну--</option>';
				foreach ( $xml->country  as $country )  {
                    $add = "";
                    if($country['name'] == $selected) $add = "selected";
					$html .= '<option value="'. $country['name']. '" '. $add .'>'. $country['name'].'</option>';
				}
		$html .= '</select>';
		return $html;
	}

	protected function getLabel()
	{
		return JText::_('MOD_INFINITILIFEWEATHER_COUNTRY');
	}
}