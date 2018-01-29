<div class="bigtitle"><div class="wrap clrfix">
        <h1>Проверка php модулей и доступа к файлам/папкам</h1>
</div></div>	
<div class="main"><div class="wrap clrfix">
        <br />
        <br />
        <h2>Проверка необходимых модулей PHP</h2>
        
        <? $modules = get_loaded_extensions(); ?>
        
        <p>Проверка наличия SimpleXML:
        <?
        if(!in_array('SimpleXML', $modules)){
            ?><span class="notok">Ошибка!</span><?
            $err = true;
        }
        else{
            ?><span class="ok">OK</span><?
        }
        ?>
        </p>
        
        <p>Проверка наличия Curl:
        <?
        if(!in_array('curl', $modules)){
            ?><span class="notok">Ошибка!</span><?
            $err = true;
        }
        else{
            ?><span class="ok">OK</span><?
        }
        ?>
        </p>
        
        <p>Проверка наличия Zlib:
        <?
        if(!in_array('zlib', $modules)){
            ?><span class="notok">Ошибка!</span><?
            $err = true;
        }
        else{
            ?><span class="ok">OK</span><?
        }
        ?>
        </p>
        
        <?if (@$err) {?>
        <br>
        <h2 style="color:red">Обнаружены ошибки, из-за которых Ваш магазин не сможет работать!</h2>
        <p>Для продолжения вы должны исправить указанные выше ошибки и выполнить проверку еще раз</p>
        <br>
        <p><a href="javascript:location.reload()" class="btn-apper fll">Повторить проверку</a></p>
        <br clear="all">
        <?}?>

        <div class="bgr-panel mt20">
            <a href="update.php?action=welcome" class="btn-apper fll">Вернуться назад</a>
            <?if (!@$err) {?>
            <a href="update.php?action=permissions" class="btn flr">Продолжить</a>
            <?}?>
        </div>
