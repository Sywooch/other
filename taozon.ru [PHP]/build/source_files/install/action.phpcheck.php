<div class="bigtitle"><div class="wrap clrfix">
        <h1><?=Lang::get('php_check_title')?></h1>
</div></div>	
<div class="main"><div class="wrap clrfix">
		<h2><?=Lang::get('check_php_libs')?></h2>
        
        <? $modules = get_loaded_extensions(); ?>
                
                
        <p>Версия PHP 5.*:
        <?
        if(!version_compare( phpversion(), '5.0', '>=' )){
            ?><span class="notok"><?=Lang::get('error')?>!</span><?
            $err = true;
        }
        else{
            ?><span class="ok">OK</span><?
        }
        ?>
        </p>
        <p>Поддержка MySQL:
        <?
        if(!extension_loaded( 'mysql' )){
            ?><span class="notok"><?=Lang::get('error')?>!</span><?
            $err = true;
        }
        else{
            ?><span class="ok">OK</span><?
        }
        ?>
        </p>
        
        
        
        
        
        <p><?=Lang::get('check_exist_lib')?> SimpleXML:
        <?
        if(!in_array('SimpleXML', $modules)){
            ?><span class="notok"><?=Lang::get('error')?>!</span><?
            $err = true;
        }
        else{
            ?><span class="ok">OK</span><?
        }
        ?>
        </p>
        
        <p><?=Lang::get('check_exist_lib')?> Curl:
        <?
        if(!in_array('curl', $modules)){
            ?><span class="notok"><?=Lang::get('error')?>!</span><?
            $err = true;
        }
        else{
            ?><span class="ok">OK</span><?
        }
        ?>
        </p>
        <p><?=Lang::get('check_exist_lib')?> PHP GD (gd):
        <?
        if(!in_array('gd', $modules)){
            ?><span class="notok"><?=Lang::get('error')?>!</span><?
            $err = true;
        }
        else{
            ?><span class="ok">OK</span><?
        }
        ?>
        </p>
        
        
        <h2><?=Lang::get('php_check_title')?></h2>
        <p><?=Lang::get('check_dir_exist')?> cache: 
        <?
        if(file_exists('../cache')){
            ?><span class="ok">OK</span><?
        }
        else{
            $res = mkdir('../cache', '0777');
            if($res){
                ?><span class="ok"><?=Lang::get('created_f')?></span><?
            }
            else{
                ?><span class="notok"><?=Lang::get('error')?>!</span><?
                $err = true;
            }
        }
        ?>
        </p>
        
        <p><?=Lang::get('check_dir_write')?> cache:
        <?
        if(!is_writable('../cache')){
            ?><span class="notok"><?=Lang::get('error')?>!</span><?
            $err = true;
        }
        else{
            ?><span class="ok">OK</span><?
        }
        ?>
        </p>
        
        <p><?=Lang::get('check_dir_exist')?> userdata: 
        <?
        if(file_exists('../userdata')){
            ?><span class="ok">OK</span><?
        }
        else{
            $res = mkdir('../userdata', '0777');
            if($res){
                ?><span class="ok"><?=Lang::get('created_f')?></span><?
            }
            else{
                ?><span class="notok"><?=Lang::get('error')?>!</span><?
                $err = true;
            }
        }
        ?>
        </p>
        
        <p><?=Lang::get('check_dir_write')?> userdata:
        <?
        if(!is_writable('../userdata')){
            ?><span class="notok"><?=Lang::get('error')?>!</span><?
            $err = true;
        }
        else{
            ?><span class="ok">OK</span><?
        }
        ?>
        </p>
        <br>
        
        
        <?if (@$err) {?>
        <br>
        <h2 style="color:red"><?=Lang::get('errors_found')?></h2>
        <p><?=Lang::get('to_continue_solve_errors')?></p>
        <br>
        <p><a href="javascript:location.reload()" class="btn-apper fll"><?=Lang::get('repeat_check')?></a></p>
        <br clear="all">
        <?}?>

        <div class="bgr-panel mt20">
            <a href="index.php?action=welcome" class="btn-apper fll"><?=Lang::get('back')?></a>
            <?if (!@$err) {?>
            <a href="index.php?action=db" class="btn flr"><?=Lang::get('continue')?></a>
            <?}?>
        </div>
