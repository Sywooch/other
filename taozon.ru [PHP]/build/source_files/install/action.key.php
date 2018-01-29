<script type="text/javascript">
$(function(){
    $('#checkConnection').click(function(){
        $('#serverConnectMessage').css('background-color', '#ED1C24').hide();
        $.post('callservice.php', $('#ckeckKey').serializeArray(), function(data){
            if(data == 'IncorrectKey'){
                $('#serverConnectMessage').html('<?=Lang::get('key_incorrect')?>').show();
            }
            else //if(!data)
            {
                $('#serverConnectMessage').html('<?=Lang::get('key_correct')?>!').css('background-color', 'green').show();
                $('#finish').attr('href', 'index.php?action=finish&key='+$('#key').val()).html('<?=Lang::get('complete_setup')?>');
            }
        });
        return false;
    });
});
</script>

<div class="bigtitle"><div class="wrap clrfix">
        <h1><?=Lang::get('check_instance')?></h1>
</div></div>	
<div class="main"><div class="wrap clrfix">
        <br />
        <br />
        
        <p>
            <strong><?=Lang::get('enter_your_instance')?></strong> (<?=Lang::get('you_can_skip_instance_enter')?>))<br /><br />
            
            <form id="ckeckKey">
                <label for=""><?=Lang::get('key')?>:</label> <input type="text" name="key" value="" id="key" /> <div class="h10"> </div>
                <a href="#" id="checkConnection" class="btn fll"><?=Lang::get('check_key')?></a>
                <br clear="all">
            </form>
        </p>
        
        <p id="serverConnectMessage"></p>
        
        <div class="bgr-panel mt20">
            <a href="index.php?action=db" class="btn-apper fll"><?=Lang::get('back')?></a>
            <a href="index.php?action=finish" id="finish" class="btn flr"><?=Lang::get('skip')?></a>
        </div>
