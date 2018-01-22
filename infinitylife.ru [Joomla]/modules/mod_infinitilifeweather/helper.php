<?php

class ModInfinitilifeWeatherHelper
{
    public static  function get_web_page( $url )
    {
        $uagent = "Opera/9.80 (Windows NT 6.1; WOW64) Presto/2.12.388 Version/12.14";

        $ch = curl_init(str_replace(" ","%20",$url));;

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   // возвращает веб-страницу
        curl_setopt($ch, CURLOPT_HEADER, 0);           // не возвращает заголовки
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);   // переходит по редиректам
        curl_setopt($ch, CURLOPT_ENCODING, "");        // обрабатывает все кодировки
        curl_setopt($ch, CURLOPT_USERAGENT, $uagent);  // useragent
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120); // таймаут соединения
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);        // таймаут ответа
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);       // останавливаться после 10-ого редиректа

        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;
        return $header;
    }


    public static function getWeather($city, $col = 10, $day_of_the_week_array = array(1 => 'Пн', 2 => 'Вт', 3 => 'Ср', 4 => 'Чт', 5 => 'Пт', 6 => 'Сб', 7 => 'Вс'), $full_day_of_the_week_array = array(1 => 'Понедельник', 2 => 'Вторник', 3 => 'Среда', 4 => 'Четверг', 5 => 'Пятница', 6 => 'Суббота', 7 => 'Воскресенье'), $time_of_day = array(0 => 'утро', 1 => 'день', 2 => 'вечер', 3 => 'ночь'))
    {
        $data_file = 'http://export.yandex.ru/weather-ng/forecasts/' . $city . '.xml';   // Загружаем файл прогноза погоды для выбранного города

        $filename = dirname(__FILE__) . '/weather' . $city . '.xml';

        $time = 0;
        if(file_exists($filename)){
            $time = time() - filemtime($filename);
        }

        if($time > 60*60 || !file_exists($filename)){
            set_time_limit(0);

            $result = ModInfinitilifeWeatherHelper::get_web_page($data_file);
            if (($result['errno'] != 0 )||($result['http_code'] != 200)){

            } else{
                $fp = fopen ($filename, 'w+');//This is the file where we save the    information
                $page = $result['content'];
                fwrite($fp, $page);
                fclose($fp);
            }


        }

        $xml = simplexml_load_file($filename); // загружаем xml файл через simple_xml


        $out = array(); // Массив вывода прогноза
        $counter = 0; // Счетчик количества дней, для которых доступен прогноз

        $get_temp = $xml->fact->temperature;
        if ($get_temp > 0) {
            $get_temp = '+' . $get_temp;
        }
        $uptime = explode("T", $xml->fact->uptime);
        $get_date = explode("-", $uptime[0]);
        $day_of_week = date("N", mktime(0, 0, 0, $get_date[1], $get_date[2], $get_date[0]));
        $out['fact']['day'] = $get_date[2];
        $out['fact']['month'] = $get_date[1];
        $out['fact']['year'] = $get_date[0];
        $out['fact']['full_day_of_week'] = $full_day_of_the_week_array[$day_of_week];
        $out['fact']['day_of_week'] = $day_of_the_week_array[$day_of_week];
        $out['fact']['weather']['weather_type'] = $xml->fact->weather_type;
        $out['fact']['weather']['temp'] = $get_temp;
        $out['fact']['weather']['image'] = $xml->fact->{'image-v3'};
        $out['fact']['weather']['wind_speed'] = $xml->fact->wind_speed;

        foreach ($xml->day as $day) {

            if ($counter == $col) {
                break;
            }

            $get_date = explode("-", $day['date']);
            $day_of_week = date("N", mktime(0, 0, 0, $get_date[1], $get_date[2], $get_date[0]));

            $out[$counter]['day'] = $get_date[2];
            $out[$counter]['month'] = $get_date[1];
            $out[$counter]['year'] = $get_date[0];
            $out[$counter]['day_of_week'] = $day_of_the_week_array[$day_of_week];
            $out[$counter]['full_day_of_week'] = $full_day_of_the_week_array[$day_of_week];
           
            
            for ($i = 0; $i <= 3; $i++) {


                if ($day->day_part[$i]->temperature == '') {

                    $get_temp_from = $day->day_part[$i]->temperature_from;

                    $get_temp_avg = $day->day_part[$i]->{'temperature-data'}->avg;
                    $get_temp_to = $day->day_part[$i]->temperature_to;

                } else {

                    $get_temp_from = (integer)$get_temp - 1;
                    $get_temp_avg = (integer)$get_temp;
                    $get_temp_to = (integer)$get_temp + 1;

                }

                if ($get_temp_from > 0) {
                    $get_temp_from = '+' . $get_temp_from;
                }

                if ($get_temp_avg > 0) {
                    $get_temp_avg = '+' . $get_temp_avg;
                }

                if ($get_temp_to > 0) {
                    $get_temp_to = '+' . $get_temp_to;
                }
                $out[$counter]['weather'][$i]['temp_from'] = $get_temp_from;
                $out[$counter]['weather'][$i]['temp_avg'] = $get_temp_avg;
                $out[$counter]['weather'][$i]['temp_to'] = $get_temp_to;
                $out[$counter]['weather'][$i]['image'] = $day->day_part[$i]->{'image-v3'};
                $out[$counter]['weather'][$i]['time_of_day'] = $time_of_day[$i];
                $out[$counter]['weather'][$i]['wind_speed'] = $day->day_part[$i]->wind_speed;


            }
            $counter++;
            
            
            
             $out[$counter]['wind'] = $day->day_part[0]->wind_speed;
        }


        return $out;

    }
}