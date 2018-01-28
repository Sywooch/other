<?php
/**
 * WordPress Cron Implementation for hosts, which do not offer CRON or for which
 * the user has not set up a CRON job pointing to this file.
 *
 * The HTTP request to this file will not slow down the visitor who happens to
 * visit when the cron job is needed to run.
 *
 * @package WordPress
 */

require_once( dirname( __FILE__ ) . '/wp-load.php' );

header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors', 1);


//phpinfo();

require_once 'vendor/autoload.php';

$vk = getjump\Vk\Core::getInstance()->apiVersion('5.5')->setToken(VK_SERVICE_KEY);
// VK_SERVICE_KEY


$blogtime = current_time('mysql'); // вернет: 2005-08-05 10:41:13
list( $year, $month, $day, $hour, $minute, $second ) = preg_split( '([^0-9])', $blogtime );


$arMyFriendsIDs = array();

$friends = new getjump\Vk\Wrapper\Friends($vk);



// устанавливаем свой ключ кэша
$cache_key = 'vk_db_result' . $year . $month . $day;

// Если данных нет в кэше, то делаем запрос получаем данные и записываем их в кэш
if( ! $arMyFriendsIDs = wp_cache_get( $cache_key ) ){


    foreach($friends->get(VK_MY_ACCOUNT_ID__Resident234, array('first_name','last_name'))->batch(300) as $f) //BATCH MEAN $f WILL CONTAIN JUST 100 ELEMENTS, AND REQUEST WILL MADE FOR 100 ELEMENTS
    {
        /**
         * @var $f \getjump\Vk\ApiResponse;
         */

        foreach ($f->response->data->items as $object) {
            $arMyFriendsIDs[] = $object->id;
        }

    }


    wp_cache_set( $cache_key, $arMyFriendsIDs );
}




/*
foreach($vk->request('users.search', ['q' => "Вася" , 'out' => 1])->batch(200) as $data){

        foreach ($data->items as $item) {


            *//*try {
                $vk->request('users.get', ['user_ids' => $item->id , 'fields' => implode(',', $this->fields)])->each(function($i, $v) use ($vkDetails){

                    /**
                    $fullData = array();
                    foreach ($this->fields as $key => $field) {
                    $fullData[$field] = $v->__get($field);
                    }
                     **//*
                    $vkDetails->items[] = $v;
                });
            } catch (Error $e) {
                $this->error(json_encode($e));
                $vkDetails->errors[] = json_encode($e);
            }
            sleep(1);*//*

            sleep(1);
        }


}*/

/*
$vk = getjump\Vk\Core::getInstance()->apiVersion('5.5');

$auth = getjump\Vk\Auth::getInstance();
$auth->setAppId(VK_APP_ID)->setScope('SCOPE')->setSecret(VK_PRIVATE_CODE)->setRedirectUri('http://localhost/test.php'); // SETTING ENV
$token=$auth->startCallback(); // Here we will have token, if everything okay


if($token) {
    $vk->setToken($token);
    $vk->request('users.get', ['user_ids' => range(1, 100)])->each(function($i, $v) {
        if($v->last_name == '') return;
        print $v->last_name . '<br>';
    });
}

foreach($vk->request('users.search', ['count' => 10000])->batch(200) as $data){
    foreach ($data->items as $item) {

        Debug($item);
    }
}

*/




/*

sex - 1 2
birth_day - 01 - 31
birth_month - 01 - 12
birth_year - 1900 - 2017
online - 0 - 1

*/
$arUsersSearchAddedOptionsList = array(
    "sex" => array(1, 2)
);
$ar__birth_day = range(1, 31);
$ar__birth_month = range(1, 12);
$ar__birth_year = range(1900, 2017);

$arUsersSearchAddedOptionsList["birth_day"] = $ar__birth_day;
$arUsersSearchAddedOptionsList["birth_month"] = $ar__birth_month;
$arUsersSearchAddedOptionsList["birth_year"] = $ar__birth_year;
$arUsersSearchAddedOptionsList["online"] = array(0, 1);

$arUsersSearchAddedOptionsListKeys = array_keys($arUsersSearchAddedOptionsList);


$power_setKeys = pc_array_power_set($arUsersSearchAddedOptionsListKeys);
$arUsersSearchAddedOptions = array();//FINAL

foreach($power_setKeys as $keyLevel1 => $arPower_setKey){
    //Debug($key);
    //Debug($arPower_setKey);

    foreach($arPower_setKey as $keyLevel2 => $power_setKey){
        //Debug($arUsersSearchAddedOptionsList[$power_setKey]);
        $arUsersSearchAddedOptions[$keyLevel1][$power_setKey] = $arUsersSearchAddedOptionsList[$power_setKey];



        foreach($arUsersSearchAddedOptionsList[$power_setKey] as $keyLevel3 => $item){
            //$arUsersSearchAddedOptions[$key][$power_setKey] =
            //echo $keyLevel1 . " = " . $keyLevel2 . " = " . $keyLevel3 . " = " . $power_setKey . " = " . $item . "<br>";
            //$arUsersSearchAddedOptions[$keyLevel1][$keyLevel2][$power_setKey][] = $item;
        }

        //$arUsersSearchAddedOptions[$key] =
    }

    Debug($arUsersSearchAddedOptions[$keyLevel1]);


    /*unset($arTempUsersSearchAddedOptionElement);
    foreach($arUsersSearchAddedOptions[$keyLevel1] as $keyUsersSearchAddedOption => $arUsersSearchAddedOption){

        Debug($arUsersSearchAddedOption);
        $arTempUsersSearchAddedOptionElement[] = array();
        //$arTempUsersSearchAddedOptionElement[$keyUsersSearchAddedOption] = $arUsersSearchAddedOption;


    }*/

    /*for($i = 0; $i < combinationsArrays__counts($arUsersSearchAddedOptions[$keyLevel1]); $i++) {
        $r = combinationsArrays__get($i);
		for($j = 0; $j < count($arUsersSearchAddedOptions[$keyLevel1]); $j++) {
            Debug($arUsersSearchAddedOptions[$keyLevel1][$j][$r[$j]]);
		}

	}*/


    $a = array (
        array ("a", "b", "c"),
        array ("d", "f"),
        array ("g", "k")
    );


    function fill (&$arr, $idx = 0) {
        static $line = array();
        static $keys;
        static $max;
        static $results;
        if ($idx == 0) {
            $keys = array_keys($arr);
            $max = count($arr);
            $results = array();
        }
        if ($idx < $max) {
            $values = $arr[$keys[$idx]];
            foreach ($values as $value) {
                array_push($line, $value);
                fill($arr, $idx+1);
                array_pop($line);
            }
        } else {
            $results[] = $line;
        }
        if ($idx == 0) return $results;
    }

    var_dump(fill($a));
    
    /*while(true)// выполняем бесконечный цикл
    { $next=false;// переключение на следующую линию не требуется
        for ($it=0;$it<$count;$it++)// проходим по всем блокам и составляем комбинацию
        { $c=sizeof($words[$it]);// кол-во комбинаций текущего блока
            if ($next) { $array_index[$it]++; $next=false; }// если требуется переключить следующий блок
            if ($array_index[$it]>=$c) { $array_index[$it]=0; $next=true; }
            $array_text[$index].=$words[$it][$array_index[$it]].' ';// добавляем значение из блока
        }
        $array_text[$index]=trim($array_text[$index]);// убираем на всяк случай пробелы в начале и в конце предложения / фразы / текста
        if ($next) { break; }// если все варианты пройдены, но нужен еще проход по последнему значению / корректировка
        $array_index[0]++;// увеличиваем индекс в первом массиве
        $index++;// увеличиваем индекс общего значения полученных комбинаций
    }
    array_pop($array_text);// убираем последний блок ибо он повторный получается*/


    echo "==========<br>";
}

//Debug($arUsersSearchAddedOptions);

//$arUsersSearchAddedOptionsResultCombimations = array_cartesian($arUsersSearchAddedOptionsList);

//Debug($arUsersSearchAddedOptionsResultCombimations);
//$arUsersSearchAddedOptions[] = array();
//$arUsersSearchAddedOptions[] = array("sex" => 1);


$vk = getjump\Vk\Core::getInstance()->apiVersion('5.5')->setToken(VK_ACCESS_TOKEN);
// VK_SERVICE_KEY

foreach($vk->request('users.search', ['city' => VK_CITY_ID__BLG])->batch(1000) as $data) {

    Debug(count($data->response->items->items));
    foreach ($data->response->items->items as $item) {

        Debug($item->id);

        ///sleep(1);
    }
}


/*
$data = $vk->request('users.search', ['count' => 200]);

$data->each(function($key, $value){

    Debug($value);
    /*$user = $fetchData($value->user_id);
    printf("[%s] %s <br>", $user->getName(), $value->body);
    return;*//*
});*/

/*
$vk->request('users.search', ['count' => 1 , 'online' => 1 , 'q' => "Сергей"])->each(
    function($key, $value) use($that){
        Debug("---");
        //$that->info($value->id.' will triggered ');
        //$that->uid = $value->id;
    }
);*/


/*
 * $vk->request('users.search', ['count' => 1 , 'online' => 1 , 'q' => $name])->each(
                    function($key, $value) use($that){
                        $that->info($value->id.' will triggered ');
                        $that->uid = $value->id;
                    }
                );
 */

/*
//MESSAGES
$data = $vk->request('messages.get', ['count' => 200]);

$userMap = [];
$userCache = [];

$user = new \getjump\Vk\Wrapper\User($vk);

$fetchData = function($id) use($user, &$userMap, &$userCache)
{
    if(!isset($userMap[$id]))
    {
        $userMap[$id] = sizeof($userCache);
        $userCache[] = $user->get($id)->response->get();
    }

    return $userCache[$userMap[$id]];
};

//REQUEST WILL ISSUE JUST HERE! SINCE __get overrided
$data->each(function($key, $value) use($fetchData) {
    $user = $fetchData($value->user_id);
    printf("[%s] %s <br>", $user->getName(), $value->body);
    return;
});
*/

$attachments = array();
$headers = 'From: Персональный сайт <null@'.$_SERVER["SERVER_NAME"].'>' . "\r\n";
$body = "Test";


wp_mail('gsu1234@mail.ru', 'WP', $body, $headers, $attachments);



echo "===";