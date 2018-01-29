<? include (TPL_DIR . "header.php"); ?>

<?
$perpage = (isset($_GET['ps'])) ? $_GET['ps'] : '10';
$page = (isset($_SESSION['admin_user_page'])) ? $_SESSION['admin_user_page'] : 1;
$page = (isset($_GET['p'])) ? $_GET['p'] : $page;
if ((isset($_GET['p']))) $_SESSION['admin_user_page'] = $_GET['p'];
$count = (int)$users['totalcount'];
$users = $users['content'];

$pages = array(10, 20, 50, 100);
?>

<div id="dialog-form" title="<?=LangAdmin::get('message')?>">
    <span id="info"></span>
</div>


<form action="index.php" method="GET">
    <input type="hidden" name="p" value="1"/>
    <input type="hidden" name="cmd" value="users"/>

    <div class="grid_4">
        <p>
            <label>Username
                <small>Alpha-numeric values</small>
            </label>
            <input type="text" name="login" value="<?=@$_GET['login']?>">
        </p>
    </div>

    <div class="grid_5">
        <p>
            <label>Email Address</label>
            <input type="text" name="email" value="<?=@$_GET['email']?>">
        </p>
    </div>

    <div class="grid_2">
        <p>
            <label>&nbsp;</label>
            <input type="submit" value="<?=LangAdmin::get('apply_filters')?>">
        </p>
    </div>
</form>
<br/><br/>
<!--    <a href="index.php?cmd=users"><?=LangAdmin::get('reset_filters')?></a>-->

<div style="clear:both;">

    <a href="index.php?cmd=users&do=usercreate&sid=<?=$GLOBALS['ssid']?>"><?=LangAdmin::get('create_a_user')?></a>

    <? $from = ($page - 1) * $perpage + 1; ?>
    <? $end = min($from + $perpage - 1, $from + count($users) - 1); ?>

    <strong><?=LangAdmin::get('found')?> <?=$count?> <?=LangAdmin::get('users')?>
        <? if ($count) { ?>
            ; <?=LangAdmin::get('showing')?>: <?=LangAdmin::get('with')?> <?= $from ?> <?=LangAdmin::get('on')?> <?= $end ?>
            <? } ?>
    </strong><br/><br/>
    <? $error = (isset($error)) ? $error . @$_GET['error'] : @$_GET['error']; ?>
    <span id="error" style="color:red;font-weight: bold;">
        <? if (isset($error)) {
        print $error;
    } ?>
    </span>
</div>

<? if (isset($success)): ?>
    <strong style="color:green;"><?=$success;?></strong>
<? endif; ?>

<? if ($count): ?>
<h2><?=LangAdmin::get('members')?></h2>

<div style="float:right;">
    <select name="perpage">
        <? foreach ($pages as $perpagecount) { ?>
        <? $selected = ($perpagecount==$perpage) ? ' selected' : ''; ?>
        <option value="<?=$perpagecount?>" <?=$selected?>><?=$perpagecount?></option>
        <? } ?>
    </select> <br/>
</div>

<div id="overlay"></div>
<div class="grid_16">
    <table>
        <thead>
        <tr>
            <th><?=LangAdmin::get('user_name')?></th>
            <th><?=LangAdmin::get('account_number')?></th>
            <th><?=LangAdmin::get('additional_information')?></th>
            <th colspan="4" width="15%"></th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="6" class="pagination">
                <? $curpage = $page; ?>
                <? $maxpage = ceil($count / $perpage); ?>

                <? for ($i = 1; $i <= $maxpage; $i++) { ?>
                <? if ($curpage == $i) { ?>
                    <span class="active curved"><?=$i?></span>
                    <? } else { ?>
                    <a class="curved" href="<?=$pageurl?>&p=<?=$i?>"><?=$i?></a>
                    <? } ?>
                <? } ?>
            </td>
        </tr>
        </tfoot>
        <tbody>
        <? $count_users = 1; ?>
        <? $counter = 0; ?>
        <? for ($i = $from; $i <= $from + $perpage; $i++): ?>
            <? $counter++; ?>
            <? if ($count_users > $perpage) break; ?>
            <? if (!isset($users[$counter - 1])) continue; ?>
            <? $user = $users[$counter - 1]; ?>
            <tr id="user<?=$user['id']?>">
                <td><a
                    href="index.php?sid=<?=$GLOBALS['ssid'];?>&cmd=users&do=userinfo&id=<?=$user['id']?>"><?=$user['login']?></a></td>
                <td><?=(defined('CFG_PREFIX_REPLACE_USR')?str_replace('USR', CFG_PREFIX_REPLACE_USR, (string)$user['personalaccountid']):(string)$user['personalaccountid'])?></td>
                <td><?=$user['email']?></td>
                <td>
                    <a href="#" value="<?=$user['login']?>" class="auth"><?=LangAdmin::get('auth_user')?></a>
                </td>
                <td>
                    <a href="index.php?cmd=users&do=useredit&sid=<?=$GLOBALS['ssid']?>&id=<?=$user['id']?>" class="edit"><?=LangAdmin::get('edit')?></a>
                </td>

                <td id="lock">
                <? if (((string)$user['isactive'] == 'true')): ?>
                    <a href="#" onClick="lock_user('<?=$user['id']?>')"><?=LangAdmin::get('ban')?></a>
                <? else: ?>
                    <a href="#" onClick="unlock_user('<?=$user['id']?>')"><?=LangAdmin::get('unban')?></a>
                <? endif; ?>
                </td>

                <td><a href="#" class="delete" onClick="confirm_delete_user('<?=$user['id']?>')"><?=LangAdmin::get('remove')?></a></td>
            </tr>
        <? endfor; ?>
        </tbody>
    </table>
</div>



<? if (false): ?>
<table class="notepad">
    <thead>
    <tr>
        <td>ФИО пользователя</td>
        <td>Номер счета</td>
        <!-- <td>Тип пользователя</td> -->
        <td>Дополнительная информация</td>
        <td>Возможные действия</td>
    </tr>
    </thead>

    <tbody>
        <? $count_users = 1; ?>
        <? for ($i = $from; $i <= $from + $perpage; $i++) { ?>
        <? if ($count_users > $perpage) break; ?>
        <? if (!isset($users[$i - 1])) continue; ?>
        <? $user = $users[$i - 1]; ?>
    <tr id="user<?=$user['id']?>">
        <td><a
            href="index.php?sid=<?=$GLOBALS['ssid'];?>&cmd=users&do=userinfo&id=<?=$user['id']?>"><?=$user['login']?></a>
        </td>
        <td></td>
        <td>email: <?=$user['email']?></td>
        <td>
            <span style="cursor:pointer;" onClick="confirm_delete_user('<?=$user['id']?>')"><?=LangAdmin::get('remove')?></span><br/>

            <div id="lock">
                <? if (((string)$user['isactive'] == 'true')) { ?>
                <span style="cursor:pointer;" onClick="lock_user('<?=$user['id']?>')"><?=LangAdmin::get('ban')?></span><br/>
                <? } else { ?>
                <span style="cursor:pointer;" onClick="unlock_user('<?=$user['id']?>')"><?=LangAdmin::get('unban')?></span><br/>
                <? } ?>
            </div>
            <a href="index.php?cmd=users&do=useredit&sid=<?=$GLOBALS['ssid']?>&id=<?=$user['id']?>"><?=LangAdmin::get('edit')?></a>
        </td>
    </tr>
        <? $count_users++; ?>
        <? }  ?>
    </tbody>
</table>
<br/><br/>


<div class="paging">
    <? $curpage = $page; ?>
    <? $maxpage = ceil($count / $perpage); ?>

    <ul class="flin">
        <? for ($i = 1; $i <= $maxpage; $i++) { ?>
        <? if ($curpage == $i) { ?>
            <li class="active"><a href="<?=$pageurl?>&p=<?=$curpage?>"><?=$i?></a></li>
            <? } else { ?>
            <li><a href="<?=$pageurl?>&p=<?=$i?>"><?=$i?></a></li>
            <? } ?>
        <? } ?>
    </ul>
</div>

<? endif; ?>

<? endif; ?>

<script>
    $('a.auth').live('click', function (ev) {
        showOverlay();
        ev.preventDefault();
        
        var login = $(this).attr('value');
        var server_url = 'index.php?cmd=users&sid=<?=$GLOBALS['ssid']?>&do=auth&login=' + login;

        $.get(server_url, function (data) {
             if (data == 'RELOGIN') location.href = 'index.php?expired';
             if (data == 'Ok') {
                 window.open('http://<?=$_SERVER['SERVER_NAME']?>','_blank');
             } else {
                $('#error').html('<?=LangAdmin::get('there_was_an_error')?> ' + data);
             }
             hideOverlay();

        }).error(function (jqXHR, textStatus, errorThrown) {
            hideOverlay();
            $('#error').html('Error');
        });
    });
    
    $('select[name=perpage]').change(function() {
        var count = $('select[name=perpage] option:selected').val();
        //alert(count);
        location.href = 'index.php?cmd=users&ps=' + count + '&sid=';
    });
    function sh(id) {
        if (document.getElementById(id).style.display != 'block') {
            document.getElementById(id).style.display = 'block';
        } else {
            document.getElementById(id).style.display = 'none';
        }
    }
    function edit(elm, field, id) {
        //
        if (document.getElementById('ed_' + field + id)) return;
        elm.id = 'sh_' + field + id;
        var value = elm.innerHTML;
        elm.innerHTML = '<input class="editor" id="ed_' + field + id + '" value="' + value + '"><input class="editorb" type="button" value=">>" onclick="save(this, \'' + field + '\', \'' + id + '\')">';
        document.getElementById('ed_' + field + id).focus();
    }

    function save(elm, field, id) {
        //
        //alert(document.getElementById('ed_'+field+id).value);
        var server_url = 'index.php?cmd=orders&sid=<?=$GLOBALS['ssid']?>&do=setvalue&id=' + id + '&field=' + field + '&value=' + document.getElementById('ed_' + field + id).value;
        $.ajax({
            url:server_url,
            success:function (data) {
                if (data == 'RELOGIN') location.href = 'index.php?expired';
                document.getElementById('sh_' + field + id).innerHTML = data;
            },
            error:function () {
                
            }
        });

    }

    var user_id = '';

    function confirm_delete_user(id) {
        $("#dialog-form").dialog("open");
        $('#info').html('<?=LangAdmin::get('users_will_be_removed')?>. Продолжить?');
        user_id = id;
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
        var server_url = 'index.php?cmd=users&sid=<?=$GLOBALS['ssid']?>&do=delete&id=' + id;

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

    function lock_user(id) {
        var server_url = 'index.php?cmd=users&sid=<?=$GLOBALS['ssid']?>&do=userlock&id=' + id;
        location.href = server_url;
        return;

        $.ajax({
            url:server_url,
            success:function (data) {
                if (data == 'RELOGIN') location.href = 'index.php?expired';

                if (data == 'Ok') {
                    $('#lock').html('<a href="#" onClick="unlock_user(' + id + ')"><?=LangAdmin::get('unban')?></a>');
                    clear_error();
                } else {
                    $('#error').html('<?=LangAdmin::get('there_was_an_error')?>');
                }
            },
            error:function (data) {
                alert(data);
                $('#error').html('<?=LangAdmin::get('there_was_an_error')?> ');
            }
        });
    }

    function unlock_user(id) {
        var server_url = 'index.php?cmd=users&sid=<?=$GLOBALS['ssid']?>&do=userunlock&id=' + id;

        $.ajax({
            url:server_url,
            success:function (data) {
                if (data == 'RELOGIN') location.href = 'index.php?expired';

                if (data == 'Ok') {
                    $('#lock').html('<a href="#" onClick="lock_user(' + id + ')"><?=LangAdmin::get('ban')?></a>');
                    clear_error();
                } else {
                    $('#error').html('<?=LangAdmin::get('there_was_an_error')?>');
                }
            },
            error:function () {
                $('#error').html('<?=LangAdmin::get('there_was_an_error')?> ');
            }
        });
    }

    function clear_error() {
        $('#error').html('');
    }

</script>

<?
include (TPL_DIR . "footer.php");
?>	