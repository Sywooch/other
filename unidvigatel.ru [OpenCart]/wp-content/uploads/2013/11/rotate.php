<?php

/*

        AUTOMATIC IMAGE ROTATOR
        Version 2.2 - December 4, 2003
        Copyright © 2002-2003 Dan P. Benjamin, Automatic, Ltd.
        All Rights Reserved.

        http://www.hiveware.com/imagerotator.php
        
        http://www.automaticlabs.com/
*/




/* ------------------------- CONFIGURATION -----------------------


        Пропишите в $folder полный путь к директории с изображениями.
        Пример: $folder = '/user/me/example.com/images/';
        Если у вас rotate.php лежит в одной папке с изображениями, то
        настраивать ничего не нужно. Оставьте $folder = '.';

*/

        $folder = '.';

/*      

        Большинству пользователей эти настройки можно проигнорировать.

    Если вы хотите добавить новые типы изображений, отличных от
        gif, jpg, и png, то просто скопируйте строку типа изображения
        и добавьте ниже остальных строк со своим mime-типом.
        
        Пример:
        
        PDF файлы:

                $extList['pdf'] = 'application/pdf';
        
    CSS файлы:

        $extList['css'] = 'text/css';

    Вы даже можете использовать случайные HTML файлы:

            $extList['html'] = 'text/html';
            $extList['htm'] = 'text/html';

    Главное, чтобы mime-тип был правильным!

*/

    $extList = array();
        $extList['gif'] = 'image/gif';
        $extList['jpg'] = 'image/jpeg';
        $extList['jpeg'] = 'image/jpeg';
        $extList['png'] = 'image/png';
        

// Ниже редактировать ничего не нужно.


// --------------------- END CONFIGURATION -----------------------

$img = null;

if (substr($folder,-1) != '/') {
        $folder = $folder.'/';
}

if (isset($_GET['img'])) {
        $imageInfo = pathinfo($_GET['img']);
        if (
            isset( $extList[ strtolower( $imageInfo['extension'] ) ] ) &&
        file_exists( $folder.$imageInfo['basename'] )
    ) {
                $img = $folder.$imageInfo['basename'];
        }
} else {
        $fileList = array();
        $handle = opendir($folder);
        while ( false !== ( $file = readdir($handle) ) ) {
                $file_info = pathinfo($file);
                if (
                    isset( $extList[ strtolower( $file_info['extension'] ) ] )
                ) {
                        $fileList[] = $file;
                }
        }
        closedir($handle);

        if (count($fileList) > 0) {
                $imageNumber = time() % count($fileList);
                $img = $folder.$fileList[$imageNumber];
        }
}

if ($img!=null) {
        $imageInfo = pathinfo($img);
        $contentType = 'Content-type: '.$extList[ $imageInfo['extension'] ];
        header ($contentType);
        readfile($img);
} else {
        if ( function_exists('imagecreate') ) {
                header ("Content-type: image/png");
                $im = @imagecreate (100, 100)
                    or die ("Cannot initialize new GD image stream");
                $background_color = imagecolorallocate ($im, 255, 255, 255);
                $text_color = imagecolorallocate ($im, 0,0,0);
                imagestring ($im, 2, 5, 5,  "IMAGE ERROR", $text_color);
                imagepng ($im);
                imagedestroy($im);
        }
}

?>