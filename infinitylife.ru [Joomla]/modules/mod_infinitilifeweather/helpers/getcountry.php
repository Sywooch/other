<?php header("Content-Type: text/html; charset=utf-8");

$country_id = $_POST["country_id"] ;
$city = '<option value="0">--Выберите город--</option>'  ;

 if ($country_id != '0') {

 $data_file = 'http://weather.yandex.ru/static/cities.xml';
 $xml = simplexml_load_file($data_file);

foreach ($xml->country as $key => $value) {

   if ($value["name"] == $country_id) {
          foreach ($value->city as $key1 => $value1) {
                $city .= '<option value="'.$value1["id"].'">' .$value1['part']." ". $value1 . '</option>'  ;
          }
          break ;

   }

}
}

  echo $city;