<?
$key = @$_GET['key'] ? $_GET['key'] : 'opendemo';
$cfg_content = 
        str_replace(
            array(
                "define('CFG_SERVICE_INSTANCEKEY', '');",
                "define('DB_HOST', '');",
                "define('DB_USER', '');",
                "define('DB_PASS', '');",
                "define('DB_BASE', '');"
                ),
            array(
                "define('CFG_SERVICE_INSTANCEKEY', '".$key."');",
                "define('DB_HOST', '".$_SESSION['db']['host']."');",
                "define('DB_USER', '".$_SESSION['db']['uid']."');",
                "define('DB_PASS', '".$_SESSION['db']['pwd']."');",
                "define('DB_BASE', '".$_SESSION['db']['database_name']."');"
                ),
            file_get_contents(dirname(dirname(__FILE__)).'/configcustom_template.php')
                )
        ;
?>

<div class="bigtitle"><div class="wrap clrfix">
        <h1 style="color:green"><?=Lang::get('conf_finished')?>!</h1>
</div></div>	
<div class="main"><div class="wrap clrfix">
        <?=Lang::get('congritulations')?>!
        
        <br />
        <br />
        
        <?
        if (!file_exists('../userdata/finish')) 
            $f = file_put_contents(dirname(dirname(__FILE__)).'/configcustom.php', $cfg_content);
        if(!$f){
            ?>
                <?=Lang::get('configcustom_entities')?>:
                <div class="bgr-panel mt20" style="height: auto">
                    <pre>
<?=htmlspecialchars($cfg_content)?>
                    </pre>
                </div>
            <?
        }
        else{
            print Lang::get('configcustom_entities_filled');
            $r = chmod(dirname(dirname(__FILE__)).'/configcustom.php', 0644);
            if(!$r){
                ?>
                <span class="notok"><?=Lang::get('644')?></span>
                <?
            }
        }
        ?>
        
        <br />
        <br />
        <?=Lang::get('delete_install')?>.
        <div class="bgr-panel mt20">
            <a href="../" class="btn flr"><?=Lang::get('goto_shop')?></a>
        </div>
<?

file_put_contents('../userdata/finish', 'yes');

?>