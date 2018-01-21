<div id="catalog" class="searchres">
	<h2>Результаты поиска</h2>
	<table id="collectionstable">
	{foreach from=$collection item=coll name=collections}
		{if $smarty.foreach.collections.iteration%3 == 1}
			<tr>
		{/if}
		<td class="coll_{$smarty.foreach.collections.iteration%3}">
			<div class="inner collection">
				<a href="/cat/{$coll.factory_url|default:$factory.url|default:$factory.id}/{$coll.factory_url|default:$factory.url|default:$factory.id}-{$coll.url|default:$coll.id}/"><img src="{$coll.image|replace:'[dir]':'small'}"></a>
				<span class="descr">
					<a href="/cat/{$coll.factory_url|default:$coll.factory_id}/{$coll.url|default:$coll.id}/" class="fac">{$coll.factory_title}</a><br>
					<a href="/cat/{$coll.factory_url|default:$factory.url|default:$factory.id}/{$coll.factory_url|default:$factory.url|default:$factory.id}-{$coll.url|default:$coll.id}/">{$coll.title}</a>
				</span>
			</div>
		</td>
		{if $smarty.foreach.collections.iteration%3 == 0}
			</tr>
		{/if}
	{/foreach}
	</table>
</div>