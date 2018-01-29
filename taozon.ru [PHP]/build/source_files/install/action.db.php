<script type="text/javascript">
$(function(){
    $('#checkConnection').click(function(){
        $('#next').hide();
        
        $('#serverConnectMessage').css('background-color', '#ED1C24').hide();
        $.post('connection.servertest.php', $('#serverConnect').serializeArray(), function(data){
            if(data == 'OK'){
                $.post('connection.databasetest.php', $('#serverConnect').serializeArray(), function(data){
                    if(data == 'ConnectionError'){
                        $('#serverConnectMessage').html('<?=Lang::get('db_connect_fail')?>').show();
                    }
                    else if(data == 'NotExists'){
                        $('#serverConnectMessage').html('<?=Lang::get('db_not_exist')?>').show();
                    }
                    else if(data == 'OK'){
                        $('#serverConnectMessage').html('<?=Lang::get('connection_done')?>').css('background-color', 'green').show();
                        $('#next').show();
                    }
                });
            }
            else{
                $('#serverConnectMessage').html('<?=Lang::get('db_connect_fail')?>').show();
            }
        });
        
        return false;
    });
});
</script>

<div class="bigtitle"><div class="wrap clrfix">
        <h1><?=Lang::get('db_check')?></h1>
</div></div>	
<div class="main"><div class="wrap clrfix">
        <p>
            <strong><?=Lang::get('enter_db_conf')?>:</strong><br /><br />
            
            <form id="serverConnect">
                <label for=""><?=Lang::get('db_host')?>:</label> <input type="text" name="host" value="<?=(@$_SESSION['db']['host'] ? $_SESSION['db']['host'] : 'localhost')?>" /> <div class="h10"> </div>
                <label for=""><?=Lang::get('username')?>:</label> <input type="text" name="uid" value="<?=@$_SESSION['db']['uid']?>" /> <div class="h10"> </div>
                <label for=""><?=Lang::get('password')?>:</label> <input type="password" name="pwd" value="<?=@$_SESSION['db']['pwd']?>" /> <div class="h10"> </div>
                <label for=""><?=Lang::get('db_name')?>:</label> <input type="text" name="database_name" value="<?=@$_SESSION['db']['database_name']?>" /> <div class="h10"> </div>
                <a href="#" id="checkConnection" class="btn fll"><?=Lang::get('check_connection')?></a>
                <br clear="all">
            </form>
        </p>
        
        <p id="serverConnectMessage"></p>
        
        <div class="bgr-panel mt20">
            <a href="index.php?action=phpcheck" class="btn-apper fll"><?=Lang::get('back')?></a>
            <a href="index.php?action=key" id="next" class="btn flr"><?=Lang::get('continue')?></a>
        </div>
