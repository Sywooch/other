<? include (TPL_DIR . "header.php"); ?>

<br/><br/>
<a href="index.php?cmd=users&sid=<?=$GLOBALS['ssid']?>"> <
    <<?=LangAdmin::get('to_the_list_of_users')?>
</a><br/>
<? if ($user) { ?>
<? //var_dump($user); ?>
<h2><?=LangAdmin::get('user_information')?></h2>

<table class="notepad">
    <thead>
    <tr>
        <td><?=LangAdmin::get('user_name')?></td>
        <td><?=LangAdmin::get('account_number')?></td>
        <td><?=LangAdmin::get('additional_information')?></td>
        <td></td>
    </tr>
    </thead>
    <tbody>
    <tr id="user<?=$user['id']?>">
        <td><a
            href="index.php?sid=<?=$GLOBALS['ssid'];?>&cmd=users&do=userinfo&id=<?=$user['id']?>"><?=$user['login']?></a>
        </td>
        <td></td>
        <td>email: <?=$user['email']?></td>
        <td>
        </td>
    </tr>
    </tbody>
</table>

<h2><?=LangAdmin::get('general_information')?></h2>    <? //var_dump($user);?>
<form action="<?=BASE_DIR;?>index.php?sid=<?=$GLOBALS['ssid'];?>&amp;do=saveuser&amp;cmd=users" method="post">
    <table class="userinfo">
        <tr>
            <td><strong><?=LangAdmin::get('login')?>:</strong></td>
            <td><input type="text" name="Login" value="<?=$user['login']?>"/></td>
        </tr>
        <tr>
            <td><strong>Email:</strong></td>
            <td><input type="text" name="Email" value="<?=$user['email']?>"/></td>
        </tr>
        <tr>
            <td><strong><?=LangAdmin::get('active')?> (<?=LangAdmin::get('not_banned')?>)</strong></td>
            <td>
                <? if ((string)$user['isactive'] == 'false') {
                print LangAdmin::get('banned');
            }
            else {
                print LangAdmin::get('not_banned');
            } ?>
            </td>
        </tr>
        <tr>
            <td><strong><?=LangAdmin::get('paul')?>:</strong></td>
            <td><select name="Sex">
                <option value="Male" <? if ((string)$user['sex'] == 'Male') print 'selected'; ?>><?=LangAdmin::get('male')?></option>
                <option value="Female" <? if ((string)$user['sex'] == 'Female') print 'selected'; ?>><?=LangAdmin::get('female')?></option>
            </select>
            </td>
        </tr>

        <tr>
            <td><strong><?=LangAdmin::get('last_name')?>:</strong></td>
            <td><input type="text" name="LastName" value="<?=$user['lastname'];?>"/></td>
        </tr>
        <tr>
            <td><strong><?=LangAdmin::get('user_name')?>:</strong></td>
            <td><input type="text" name="FirstName" value="<?=$user['firstname'];?>"/></td>
        </tr>
        <tr>
            <td><strong><?=LangAdmin::get('middle_name_by')?>:</strong></td>
            <td><input type="text" name="MiddleName" value="<?=$user['middlename'];?>"/></td>
        </tr>

        <tr>
            <td><strong><?=LangAdmin::get('country')?>:</strong></td>
            <td><input type="text" name="Country" value="<?=$user['country']?>"/></td>
        </tr>
        <tr>
            <td><strong><?=LangAdmin::get('city')?>:</strong></td>
            <td><input type="text" name="City" value="<?=$user['city']?>"/></td>
        </tr>
        <tr>
            <td><strong><?=LangAdmin::get('address')?>:</strong></td>
            <td><input type="text" name="Address" value="<?=$user['address']?>"/></td>
        </tr>
        <tr>
            <td><strong><?=LangAdmin::get('phone')?>:</strong></td>
            <td><input type="text" name="Phone" value="<?=$user['phone']?>"/></td>
        </tr>
        <tr>
            <td><strong><?=LangAdmin::get('region')?>:</strong></td>
            <td><input type="text" name="Region" value="<?=$user['region']?>"/></td>
        </tr>
        <tr>
            <td><strong><?=LangAdmin::get('zip_code')?>:</strong></td>
            <td><input type="text" name="PostalCode" value="<?=(string)$user['postalcode']?>"/></td>
        </tr>
        <tr>
            <td><strong><?=LangAdmin::get('name_of_recipient')?>:</strong></td>
            <td><input type="text" name="RecipientLastName" value="<?=$user['recipientlastname']?>"/></td>
        </tr>
        <tr>
            <td><strong><?=LangAdmin::get('name_of_recipient')?>:</strong></td>
            <td><input type="text" name="RecipientFirstName" value="<?=$user['recipientfirstname']?>"/></td>
        </tr>
        <tr>
            <td><strong><?=LangAdmin::get('recipient_middle_name')?>:</strong></td>
            <td><input type="text" name="RecipientMiddleName" value="<?=$user['recipientmiddlename']?>"/></td>
        </tr>
        <?=Plugins::invokeEvent('onRenderUserEditForm', array('user' => $user))?>
    </table>

    <input type="hidden" name="Id" value="<?=$user['id']?>"/>

    <div class="fbut clrfix">
        <input type="submit" class="ui-button ui-widget ui-state-default ui-corner-all" value="<?=LangAdmin::get('save')?>"/>
    </div>
</form>

<? } ?>

<? include (TPL_DIR . "footer.php"); ?>