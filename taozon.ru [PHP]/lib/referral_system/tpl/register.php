<?
	$user = base64_decode($refId);
	$userData = explode('|', $user);
?>
<div class="form-row">
    <label for="parent"><?=Lang::get('login_of_friend')?><br/><small><?=Lang::get('no_matter')?></small></label>
    <input id="parent" type="text" name="parent" class="form-field" value="<?=$userData[0]?>"/><br/>
    <small><?=Lang::get('referal_register_desc')?></small>
    <input id="parent_id" type="hidden" name="parent_id" value="<?=$userData[1];?>"/>
</div>