<div class="bigtitle"><div class="wrap clrfix">
        <h1>Распаковка архива с обновлениями</h1>
    </div></div>	
<div class="main"><div class="wrap clrfix">
        <br />
        <br />
        <h2>Распаковка архива с обновлениями</h2>
<?php
function ExtractCallBack($p_event, &$p_header)
{
    $info = pathinfo($p_header['filename']);
    @unlink($info['dirname'] .'/'. $info['basename']);
    return 1;
}


require '../admin/lib/pclzip/pclzip.lib.php';
unlink(dirname(dirname(__FILE__)).'/admin/utils/Lang.class.php');
$path = dirname(dirname(__FILE__)).'/updates/opentao.zip';
$archive = new PclZip($path);
chdir(dirname(dirname(__FILE__)).'');
$list = $archive->extract(PCLZIP_CB_PRE_EXTRACT, 'ExtractCallBack');
chdir(dirname(dirname(__FILE__)).'/install');

if(!$list){
    $err = 'Распаковка не удалась. Служебная информация:<br />'."ERROR : ".$archive->errorInfo(true);
}
?>
        
        <? if (@$err) { ?>
            <br>
            <h2 style="color:red"><?=$err?></h2>
            <p>Для продолжения вы должны исправить указанные выше ошибки и выполнить проверку еще раз</p>
            <br>
            <p><a href="javascript:location.reload()" class="btn-apper fll">Повторить проверку</a></p>
            <br clear="all">
        <? }else{
        ?>
            <br>
            Обновление успешно завершено! Удалите папку install из корня сайта.
        <? } ?>

        <div class="bgr-panel mt20">
            <a href="update.php?action=welcome" class="btn-apper fll">Вернуться назад</a>
            <?if (!@$err) {?>
            <a href="../index.php" class="btn flr">Перейти на сайт</a>
            <?}?>
        </div>

<?
    $path = 'http://tools.opentao.net/update_rep/info/info.php';
    $info = simplexml_load_file($path);

    @file_put_contents('../updates/version.xml', $info->asXML());
    file_put_contents('../userdata/finish', 'yes');
?>
