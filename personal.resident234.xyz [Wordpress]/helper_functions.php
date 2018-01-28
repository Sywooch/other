<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 25.06.2017
 * Time: 19:05
 */
function in_array_field($needle, $needle_field, $haystack, $strict = false) {
    if ($strict) {
        foreach ($haystack as $item)
            if (isset($item->$needle_field) && $item->$needle_field === $needle)
                return true;
    }
    else {
        foreach ($haystack as $item)
            if (isset($item->$needle_field) && $item->$needle_field == $needle)
                return true;
    }
    return false;
}


function numberof($numberof, $value, $suffix)
{
    // не будем склонять отрицательные числа
    $numberof = abs($numberof);
    $keys = array(2, 0, 1, 1, 1, 2);
    $mod = $numberof % 100;
    $suffix_key = $mod > 4 && $mod < 20 ? 2 : $keys[min($mod%10, 5)];

    return $value . $suffix[$suffix_key];
}


/**
 * Обрезка текста (excerpt). Шоткоды вырезаются. Минимальное значение maxchar может быть 22.
 *
 * @param (строка/массив) $args Параметры.
 *
 * @return HTML
 * ver 2.6.1
 */
function kama_excerpt( $args = '' ){
    global $post;

    $default = array(
        'maxchar'   => 350,   // количество символов.
        'text'      => '',    // какой текст обрезать (по умолчанию post_excerpt, если нет post_content.
        // Если есть тег <!--more-->, то maxchar игнорируется и берется все до <!--more--> вместе с HTML
        'autop'     => true,  // Заменить переносы строк на <p> и <br> или нет
        'save_tags' => '',    // Теги, которые нужно оставить в тексте, например '<strong><b><a>'
        'more_text' => 'Читать дальше...', // текст ссылки читать дальше
    );

    if( is_array($args) ) $_args = $args;
    else                  parse_str( $args, $_args );

    $rg = (object) array_merge( $default, $_args );
    if( ! $rg->text ) $rg->text = $post->post_excerpt ?: $post->post_content;
    $rg = apply_filters('kama_excerpt_args', $rg );

    $text = $rg->text;
    $text = preg_replace ('~\[/?.*?\](?!\()~', '', $text ); // убираем шоткоды, например:[singlepic id=3], markdown +
    $text = trim( $text );

    // <!--more-->
    if( strpos( $text, '<!--more-->') ){
        preg_match('/(.*)<!--more-->/s', $text, $mm );

        $text = trim($mm[1]);

        $text_append = ' <a href="'. get_permalink( $post->ID ) .'#more-'. $post->ID .'">'. $rg->more_text .'</a>';
    }
    // text, excerpt, content
    else {
        $text = trim( strip_tags($text, $rg->save_tags) );

        // Обрезаем
        if( mb_strlen($text) > $rg->maxchar ){
            $text = mb_substr( $text, 0, $rg->maxchar );
            $text = preg_replace('~(.*)\s[^\s]*$~s', '\\1 ...', $text ); // убираем последнее слово, оно 99% неполное
        }
    }

    // Сохраняем переносы строк. Упрощенный аналог wpautop()
    if( $rg->autop ){
        $text = preg_replace(
            array("~\r~", "~\n{2,}~", "~\n~",   '~</p><br ?/>~'),
            array('',     '</p><p>',  '<br />', '</p>'),
            $text
        );
    }

    $text = apply_filters('kama_excerpt', $text, $rg );

    if( isset($text_append) ) $text .= $text_append;

    return ($rg->autop && $text) ? "<p>$text</p>" : $text;
}


function Debug($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}



/**
 * @param string $aInitialImageFilePath - строка, представляющая путь к обрезаемому изображению
 * @param string $aNewImageFilePath - строка, представляющая путь куда нахо сохранить выходное обрезанное изображение
 * @param int $aNewImageWidth - ширина выходного обрезанного изображения
 * @param int $aNewImageHeight - высота выходного обрезанного изображения
 */
function cropImage($aInitialImageFilePath, $aNewImageFilePath, $aNewImageWidth, $aNewImageHeight) {
    if (($aNewImageWidth < 0) || ($aNewImageHeight < 0)) {
        return false;
    }

    $basename = (basename($aNewImageFilePath));

    $aNewImageFilePath = str_replace($basename, "", $aNewImageFilePath) . $aNewImageWidth . "_" . $aNewImageHeight . "_" . $basename;

    if(!file_exists($aNewImageFilePath)) {


        // Массив с поддерживаемыми типами изображений
        $lAllowedExtensions = array(1 => "gif", 2 => "jpeg", 3 => "png");

        // Получаем размеры и тип изображения в виде числа
        list($lInitialImageWidth, $lInitialImageHeight, $lImageExtensionId) = getimagesize($aInitialImageFilePath);

        if (!array_key_exists($lImageExtensionId, $lAllowedExtensions)) {
            return false;
        }
        $lImageExtension = $lAllowedExtensions[$lImageExtensionId];

        // Получаем название функции, соответствующую типу, для создания изображения
        $func = 'imagecreatefrom' . $lImageExtension;
        // Создаём дескриптор исходного изображения
        $lInitialImageDescriptor = $func($aInitialImageFilePath);

        // Определяем отображаемую область
        $lCroppedImageWidth = 0;
        $lCroppedImageHeight = 0;
        $lInitialImageCroppingX = 0;
        $lInitialImageCroppingY = 0;
        if ($aNewImageWidth / $aNewImageHeight > $lInitialImageWidth / $lInitialImageHeight) {
            $lCroppedImageWidth = floor($lInitialImageWidth);
            $lCroppedImageHeight = floor($lInitialImageWidth * $aNewImageHeight / $aNewImageWidth);
            $lInitialImageCroppingY = floor(($lInitialImageHeight - $lCroppedImageHeight) / 2);
        } else {
            $lCroppedImageWidth = floor($lInitialImageHeight * $aNewImageWidth / $aNewImageHeight);
            $lCroppedImageHeight = floor($lInitialImageHeight);
            $lInitialImageCroppingX = floor(($lInitialImageWidth - $lCroppedImageWidth) / 2);
        }

        // Создаём дескриптор для выходного изображения
        $lNewImageDescriptor = imagecreatetruecolor($aNewImageWidth, $aNewImageHeight);
        imagecopyresampled($lNewImageDescriptor, $lInitialImageDescriptor, 0, 0, $lInitialImageCroppingX,
            $lInitialImageCroppingY, $aNewImageWidth, $aNewImageHeight, $lCroppedImageWidth, $lCroppedImageHeight);
        $func = 'image' . $lImageExtension;

        // сохраняем полученное изображение в указанный файл
        //return $func($lNewImageDescriptor, $aNewImageFilePath);
        $func($lNewImageDescriptor, $aNewImageFilePath);


    }
    return str_replace($_SERVER['DOCUMENT_ROOT'], "", $aNewImageFilePath);
}
