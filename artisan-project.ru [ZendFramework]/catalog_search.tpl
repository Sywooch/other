<div class="filter">
<form action="" method="post">
<select name="factory_id" id="factory" class="select" {if $request.ajax}{literal}onchange="$('#result').html('<div class=\'center\'><img src=\'/public/site/img/loading.gif\' alt=\'Загрузка...\' title=\'Загрузка...\'></div>');$.post(root_url+'cat/search_good/ajax/1/',$('#modal :input').serialize(),function(data){$('#modal').html(data);$('#result .plus').show();});"{/literal}{/if}>
	<option value="">выберите фабрику</option>
{foreach from=$factories item=f}
	<option value="{$f.id}" {if $smarty.post.factory_id == $f.id}selected="selected"{/if}>
	{$f.title}
	</option>
{/foreach}
</select>
<select name="collection_id" id="collection" class="select"  {if $request.ajax}{literal}onchange="$('#result').html('<div class=\'center\'><img src=\'/public/site/img/loading.gif\' alt=\'Загрузка...\' title=\'Загрузка...\'></div>');$.post(root_url+'cat/search_good/ajax/1/',$('#modal :input').serialize(),function(data){$('#modal').html(data);$('#result .plus').show();});"{/literal}{/if}>
	<option value="">выберите коллекцию</option>
{foreach from=$collections item=c}
	<option value="{$c.id}" {if $smarty.post.collection_id == $c.id}selected="selected"{/if}>
	{$c.title}
	</option>
{/foreach}
</select>
<input type="text" autocomplete="off" class="text" name="s" id="string" value="{$smarty.post.s|escape}">
<input type="submit" class="button" id="search_goods" value="Поиск">
</form>
</div>
<table id="result">
	<tr style="border-bottom:1px solid #142f66;">
		<th></th>
{foreach from=$good_fields key=gf item=gfv}
	{if $gf != 'id'}
		<th>{$gfv.title}</th>
	{/if}
{/foreach}
	</tr>
{foreach from=$goods item=g name=sel}
	<tr{if $smarty.foreach.sel.iteration%2==0} style='background-color:#f0f0f0;'{/if}>
	<td>
		<input type="checkbox" value="{$g.id}" class="addGood" name="id" {if in_array($g.id, $cart_ids)}checked="checked"{/if}>
		<input type="hidden" value="{$g.title}" name="title">
		<input type="hidden" value="{$g.price}" name="price">
	</td>
	{foreach from=$good_fields key=gf item=gfv}
		{if $gf != 'id'}
		<td>{$g.$gf|default:'—'}</td>
		{/if}
	{/foreach}
	</tr>
{/foreach}
</table>
