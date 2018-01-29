<br/>
<div id="dialog-form" title="<?=LangAdmin::get('message')?>">
	<span id="info"></span>
</div>
<div class="windialog" id="dialog-form-subscribe" title="<?=LangAdmin::get('sub_new')?>">
	<p class="validateTips"></p>
	<b><?=LangAdmin::get('user_name')?>:</b><br/>
	<input size="40" type="text" name="UserName" value="" /><br/>
	<b>Email:</b><br/>
	<input size="40" type="text" name="Email" value="" /><br/>
</div>

	<table style="width:100%;margin-bottom:0;">
		<tr>
			<td>
				<form id="quittance_config" action="<?=BASE_DIR;?>index.php?cmd=newsletter&active_tab=2" method="post" enctype="multipart/form-data" >
					<p style="margin-bottom:10px;">
					<label style="width: 150px; display: inline-block"><?=LangAdmin::get('sub_filter_name')?></label>
					<input name="filter_name"type="text" value="<?=@$_SESSION['arSubFilter']['name']?>">
					</p>
					<p>
					<label style="width: 150px; display: inline-block"><?=LangAdmin::get('sub_filter_email')?></label>
					<input name="filter_email"type="text" value="<?=@$_SESSION['arSubFilter']['email']?>">
					</p>
					<input id="ImportSubscribe" name="filter" class="ui-button ui-widget ui-state-default ui-corner-all" type="submit" value="<?=LangAdmin::get('apply_filters')?>">
					<input id="ImportSubscribe" name="clearFilter" class="ui-button ui-widget ui-state-default ui-corner-all" type="submit" value="<?=LangAdmin::get('reset_filters')?>">
				</form>
			</td>
			<td style="text-align:right;vertical-align:bottom;">
				<a id="AddSubscribe" href="index.php?cmd=newsletter&do=add"><?=LangAdmin::get('sub_add')?> </a>
				<a target="blank" href="index.php?cmd=newsletter&do=export"><?=LangAdmin::get('exports')?> </a>
				<a href="index.php?cmd=newsletter&do=importForm"><?=LangAdmin::get('imports')?> </a>
			</td>
		</tr>
	</table>
<table class="notepad">
    <thead>
        <tr>
            <th><?=LangAdmin::get('user_name')?></th>
            <th>Email</th>
            <th><?=LangAdmin::get('actions')?></th>
        </tr>
    </thead>

    <tbody>
        <? $count_users = 1; ?>
        <? foreach ($subscribers as $subscriber): ?>
            <tr id="user<?=$subscriber['email']?>">
                <td>
                    <?=!empty($subscriber['id'])?'('.$subscriber['id'].') ':''?>
                    <?=$this->escape($subscriber['name'])?>
                </td>
                <td><?=$subscriber['email']?></td>
                <td>
                    <span style="cursor:pointer;" onClick="confirm_delete_user('<?=$subscriber['email']?>')"><?=LangAdmin::get('remove')?></span><br/>
                </td>
            </tr>
        <?endforeach?>
    </tbody>
</table>
<br/><br/>

<div class="pagination">
	<? $curpage = $page; ?>
	<? $maxpage = ceil($count / $perpage); ?>
		<?if ($curpage<5) $start=1; else $start=$curpage-3;?>
		<?if ($maxpage<=$curpage+3 || $maxpage<8) $end = $maxpage; else $end = $curpage+3;?>
		<?if ($start!=1):?>
			<a class="curved" href="<?=$pageurl?>&active_tab=2&p=1">1</a><?=$start>2?'...':''?>
		<?endif;?>
		<? for ($i = $start; $i <= $end; $i++) { ?>
		<? if ($curpage == $i) { ?>
			<span class="active curved"><?=$i?></span>
			<? } else { ?>
			<a class="curved" href="<?=$pageurl?>&active_tab=2&p=<?=$i?>"><?=$i?></a>
			<? } ?>
		<? } ?>
	<?if ($end!=$maxpage):?>
	<?=$maxpage>$end+1?'...':''?><a class="curved" href="<?=$pageurl?>&active_tab=2&p=<?=$maxpage?>"><?=$maxpage?></a>
	<?endif;?>
</div>

<script>

	function confirm_delete_user(email) {
		$("#dialog-form").dialog("open");
		$('#info').html('<?=LangAdmin::get('confirm_delete_subscriber')?>');
		user_id = email;
	}

	$(function () {
		$("#dialog-form:ui-dialog").dialog("destroy");

		$("#dialog-form").dialog({
			autoOpen:false,
			modal:true,
			buttons:{
				"<?=LangAdmin::get('yes')?>":function () {
					delete_user(user_id);
					$("#dialog-form").dialog("close");
				},
				"<?=LangAdmin::get('no')?>":function () {
					$("#dialog-form").dialog("close");
				}
			}
		});

	});

	function delete_user(id) {
		var server_url = 'index.php?cmd=newsletter&sid=<?=$GLOBALS['ssid']?>&do=deleteSub&email=' + id;

		$.ajax({
			url:server_url,
			success:function (data) {
				if (data == 'RELOGIN') location.href = 'index.php?expired';

				if (data == 'Ok') {
					$('#user' + id).hide();
					clear_error();
				} else {
					$('#error').html('<?=LangAdmin::get('there_was_an_error')?> ' + data);
				}
			},
			error:function () {
				$('#error').html('<?=LangAdmin::get('there_was_an_error')?>');
			}
		});
	}

	function clear_error() {
		$('#error').html('');
	}

	$('#AddSubscribe').click(function(){
		$( "#dialog-form-subscribe" ).dialog('open');
		return false;
	});
	$( "#dialog-form-subscribe" ).dialog({
		autoOpen: false,
		height: 250,
		width: 350,
		modal: true,
		buttons: {
			"<?=LangAdmin::get('save')?>": function() {
				$('.validateTips').html('<?=LangAdmin::get('saving')?>');
				$.post('index.php',{
					'cmd'   : 'newsletter',
					'do'    : 'saveSub',
					'name'    : $('[name="UserName"]').val(),
					'email' : $('[name="Email"]').val()
				}, function(data){
					$('.validateTips').html(data);
					location.href=location.href+'&active_tab=2';
					setTimeout('location.reload(true);', 1000);
				});
			},
			'<?=LangAdmin::get('close')?>': function() {
				$( this ).dialog( "close" );
			}
		},
		close: function() {
		}
	});
</script>