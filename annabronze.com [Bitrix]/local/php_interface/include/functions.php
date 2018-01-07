<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 25.11.2016
 * Time: 16:19
 */


if (!function_exists('generate_rand_massive')) {
    function generate_rand_massive($start, $end, $count)
    {

        $M = array();

        $M[0] = mt_rand($start, $end);
        for ($i = 1; $i < $count; $i++) {
            while (1) {
                $int = mt_rand($start, $end);
                if ($M[$i - 1] != $int) {
                    $M[$i] = $int;
                    break;
                }
            }
        }

        return $M;

    }
}


if (!function_exists('generate_all_permutation')) {
    function generate_all_permutation($start, $end, $count)
    {

        $tmp_number = ($end - $start) + 1;
        $M = array();
        for ($i = $start; $i <= $end; $i++) {
            $M[] = $i;
        }
        shuffle($M);


        $M_tmp = array();
        $M_tmp = $M;

        for ($i = 0; $i < ceil($count / $tmp_number); $i++) {
            array_unshift($M_tmp, array_pop($M_tmp));
            $M = array_merge($M, $M_tmp);
        }


        return $M;

    }
}


if (!function_exists('generate_all_permutation_custom')) {
    function generate_all_permutation_custom($start, $end, $count, $row)
    {
        //генерация с учётом кол-ва элементов в строке
        //$row - количество элементов в строке



        $tmp_number2 = ($end - $start) + 1;
        $tmp_number = $row;



        $M = array();
        $M2 = array();

        for ($i = $start; $i <= $end; $i++) {
            $M2[] = $i;
        }
        shuffle($M2);



        $M_tmp = array();
        $M_tmp = $M2;

        for ($i = 0; $i < ceil($count / $tmp_number); $i++) {

            $M_tmp2 = $M_tmp;
            $diff = $tmp_number2 - $tmp_number;
            for($i2 = count($M_tmp2) - 1, $i1 = 0; $i2 >= 0, $i1 < $diff; $i2--, $i1++){
                unset($M_tmp2[$i2]);
            }


            array_unshift($M_tmp, array_pop($M_tmp));
            //array_unshift($M_tmp2, array_pop($M_tmp2));
            $M = array_merge($M, $M_tmp2);
        }





        return $M;

    }
}



if (!function_exists('url_remove_key')) {
    function url_remove_key($key)
    {
        parse_str($_SERVER['QUERY_STRING'], $vars);
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

        //  $url = $protocol . strtok($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], '?') . http_build_query(array_diff_key($vars,array($key=>"")));
        $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '?' . http_build_query(array_diff_key($vars, array($key => "")));
        return $url;

    }
}




if (!function_exists('z_add_url_get')) {
    function z_add_url_get($a_data, $url = false)
    {
        $http = $_SERVER['HTTPS'] ? 'https' : 'http';


        if ($url === false) {
            $url = $http . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        }
        $query_str = parse_url($url);
        $path = !empty($query_str['path']) ? $query_str['path'] : '';
        $return_url = $query_str['scheme'] . '://' . $query_str['host'] . $path;
        $query_str = !empty($query_str['query']) ? $query_str['query'] : false;
        $a_query = array();
        if ($query_str) {
            parse_str($query_str, $a_query);
        }
        $a_query = array_merge($a_query, $a_data);
        $s_query = http_build_query($a_query);
        if ($s_query) {
            $s_query = '?' . $s_query;
        }
        return $return_url . $s_query;
    }
}
/*
$url = 'http://z-site.ru/?my_param=hello&my_param_2=bye';
echo  z_add_url_get(array('my_param_2'=>'goodbye','new_param'=>'this is new param'),$url); // http://z-site.ru/?my_param=hello&my_param_2=goodbye&new_param=this+is+new+param

$url = 'http://z-site.ru/';
echo  z_add_url_get(array('my_param_2'=>'goodbye','new_param'=>'this is new param'),$url); // http://z-site.ru/?my_param_2=goodbye&new_param=this+is+new+param
*/

if (!function_exists('selfURL')) {
    function selfURL()
    {
        if (!isset($_SERVER['REQUEST_URI'])) $suri = $_SERVER['PHP_SELF'];
        else $suri = $_SERVER['REQUEST_URI'];
        $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
        $sp = strtolower($_SERVER["SERVER_PROTOCOL"]);
        $pr = substr($sp, 0, strpos($sp, "/")) . $s;
        $pt = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":" . $_SERVER["SERVER_PORT"]);
        return $pr . "://" . $_SERVER['SERVER_NAME'] . $pt . $suri;
    }
}

if (!function_exists('array_msort')) {
    function array_msort($array, $cols)
    {
        $colarr = array();
        foreach ($cols as $col => $order) {
            $colarr[$col] = array();
            foreach ($array as $k => $row) {
                $colarr[$col]['_' . $k] = strtolower($row[$col]);
            }
        }
        $eval = 'array_multisort(';
        foreach ($cols as $col => $order) {
            $eval .= '$colarr[\'' . $col . '\'],' . $order . ',';
        }
        $eval = substr($eval, 0, -1) . ');';
        eval($eval);
        $ret = array();
        foreach ($colarr as $col => $arr) {
            foreach ($arr as $k => $v) {
                $k = substr($k, 1);
                if (!isset($ret[$k])) $ret[$k] = $array[$k];
                $ret[$k][$col] = $array[$k][$col];
            }
        }
        return $ret;

    }
}


if (!function_exists('remove_key')) {
    function remove_key($M) {

        $arKeys = array();
        foreach($M as $key){
            $arKeys[$key] = "";
        }

        parse_str($_SERVER['QUERY_STRING'], $vars);
        //echo "==".$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']."==";

        $url = strtok($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], '?') . "?" . http_build_query(array_diff_key($vars,$arKeys));

        $protocol = (CMain::IsHTTPS()) ? "https://" : "http://";

        return $protocol.$url;
    }
}

if (!function_exists('remove_key_url')) {
    function remove_key_url($url, $M) {

        $arKeys = array();
        foreach($M as $key){
            $arKeys[$key] = "";
        }
        $result=parse_url($url);

        $QUERY_STRING = $result['query'];

        parse_str($QUERY_STRING, $vars);
        if(!empty(http_build_query(array_diff_key($vars,$arKeys)))){
            $url = strtok($_SERVER['HTTP_HOST'] . $result['path'], '?') . "?" . http_build_query(array_diff_key($vars,$arKeys));
        }else{
            $url = strtok($_SERVER['HTTP_HOST'] . $result['path'], '?');
        }
        $protocol = (CMain::IsHTTPS()) ? "https://" : "http://";


        return $protocol.$url;
    }
}


if (!function_exists('ResizeImage')) {
    function ResizeImage ($filename, $size = 300, $quality = 85, $path_save, $new_filename)
    {


        $filename = trim($filename,"\"");


        /*
        * Адрес директории для сохранения картинки
        */
        $protocol = (CMain::IsHTTPS()) ? "https://" : "http://";

        $dir  = $protocol.$_SERVER["HTTP_HOST"].$path_save;


        /*
        * Извлекаем формат изображения, то есть получаем
        * символы находящиеся после последней точки
        */
        $ext  = strtolower(strrchr(basename($filename), "."));


        /*
        * Допустимые форматы
        */
        $extentions = array('.jpg', '.gif', '.png', '.bmp');

        if (in_array($ext, $extentions)) {
            $percent = $size; // Ширина изображения миниатюры

            if( strpos( $filename, $protocol) === false){
                $filename2 = $protocol.$_SERVER["HTTP_HOST"].$filename;
            }else{
                $filename2 = $filename;
            }



            $size2 = getimagesize($filename2);

            if($size2[0] <= $size){  return false; };


            list($width, $height) = getimagesize($filename2); // Возвращает ширину и высоту
            $newheight    = $height * $percent;
            $newwidth    = $newheight / $width;

            $thumb = imagecreatetruecolor($percent, $newwidth);

            switch ($ext) {
                case '.jpg':
                    $source = @imagecreatefromjpeg($filename2);
                    break;

                case '.gif':
                    $source = @imagecreatefromgif($filename2);
                    break;

                case '.png':
                    $source = @imagecreatefrompng($filename2);
                    break;

                case '.bmp':
                    $source = @imagecreatefromwbmp($filename2);
            }


            /*
            * Функция наложения, копирования изображения
            */
            imagecopyresized($thumb, $source, 0, 0, 0, 0, $percent, $newwidth, $width, $height);

            /*
            * Создаем изображение
            */

            $new_filename = trim($new_filename, "\"");
            $dir = $_SERVER['DOCUMENT_ROOT'].$path_save;


            switch ($ext) {
                case '.jpg':
                    imagejpeg($thumb, $dir . $new_filename, $quality);
                    break;

                case '.gif':
                    imagegif($thumb, $dir . $new_filename);
                    break;

                case '.png':
                    imagepng($thumb, $dir . $new_filename, $quality);
                    break;

                case '.bmp':
                    imagewbmp($thumb, $dir . $new_filename);
                    break;
            }
        } else {
            return false;
        }

        /*
        *  Очищаем оперативную память сервера от временных файлов,
        *  которые потребовались для создания миниатюры
        */
        @imagedestroy($thumb);
        @imagedestroy($source);

        return true;
    }
}





