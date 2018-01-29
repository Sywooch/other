<div class="bigtitle"><div class="wrap clrfix">
        <h1>Проверка php модулей и доступа к файлам/папкам</h1>
</div></div>	
<div class="main"><div class="wrap clrfix">
        <br />
        <br />
        <h2>Проверка доступа к файлам и папкам</h2>

<?php
require '../admin/lib/pclzip/pclzip.lib.php';
$path = dirname(dirname(__FILE__)).'/updates/opentao.zip';
$archive = new PclZip($path);

$list = $archive->listContent();

foreach( $list as $item ){
    if($item['folder']){
        $r_slashes = substr_count($item['filename'], '/');        
        $l_slashes = substr_count($item['filename'], '\\');
        $dirname = trim($item['filename'], '/\\');
        
        if( $r_slashes+$l_slashes == 1 ){
            ?>
                <?
                if(file_exists('../'.$dirname)){
                    if(!is_writable('../'.$dirname)){
                        ?><span class="notok">Установите права 777 на директорию <?=$dirname?></span><?
                        $err = true;
                    }
                }
                else{
                    if(!is_writable(dirname(dirname(__FILE__)))){
                        ?><span class="notok">Создайте дирректорию <?=$dirname?> в корне сайта с правами 777</span><?
                        $err = true;
                    }
                }
                ?>
                </p>
            <?
        }
    }
    else{
        ?>
            <?
            if(file_exists('../'.$item['filename'])){
                if(!is_writable($path)){
                    ?><span class="notok">Установите права 777 на файл <?=$item['filename']?></span><?
                    $err = true;
                }
            }
            elseif(file_exists(dirname('../'.$item['filename'])) && !is_writable(dirname('../'.$item['filename']))){
                if(dirname(dirname($item['filename'])) == '.'){
                    ?><span class="notok">Установите права 777 на корневую директорию (не забудьте потом вернуть исходные права!)</span><?
                }
                else{
                    ?><span class="notok">Установите права 777 на директорию <?=dirname(dirname($item['filename']))?></span><?
                }
                $err = true;
            }
            ?>
            </p>
        <?
    }
}

?>
        
        
        <?if (@$err) {?>
        <br>
        <h2 style="color:red">Обнаружены ошибки, из-за которых Ваш магазин не сможет работать!</h2>
        <p>Для продолжения вы должны исправить указанные выше ошибки и выполнить проверку еще раз</p>
        <br>
        <p><a href="javascript:location.reload()" class="btn-apper fll">Повторить проверку</a></p>
        <br clear="all">
        <?} else {?>
        <p>Файловая система готова к обновлению магазина</p>
        <? } ?>

        <div class="bgr-panel mt20">
            <a href="update.php?action=phpcheck" class="btn-apper fll">Вернуться назад</a>
            <?if (!@$err) {?>
            <a href="update.php?action=extract" class="btn flr">Продолжить</a>
            <?}?>
        </div>
