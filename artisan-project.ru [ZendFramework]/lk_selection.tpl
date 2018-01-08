<div class="filter">
    <form action="" method="post" data-type="{$type}">
        <label>Фабрика:
            <select name="factory_id" id="factory" class="select"
                    {if $request.ajax}{literal}onchange="$('#result').html('<div class=\'center\'><img src=\'/public/site/img/loading.gif\' alt=\'Загрузка...\' title=\'Загрузка...\'></div>');$.post(root_url+'requests/selection{/literal}{$type}{literal}/ajax/1/',$('#modal :input').serialize(),function(data){$('#modal').html(data);$('#result .plus').show();});"{/literal}{/if}>
                <option value="">выберите фабрику</option>
                {foreach from=$factories item=f}
                    <option value="{$f.id}"
                            {if $smarty.post.factory_id == $f.id}selected="selected"{/if}>
                        {$f.title}
                    </option>
                {/foreach}
            </select>
        </label>
        <label>Серия:
            <select name="collection_id" id="collection" class="select"
                    {if $request.ajax}{literal}onchange="$('#result').html('<div class=\'center\'><img src=\'/public/site/img/loading.gif\' alt=\'Загрузка...\' title=\'Загрузка...\'></div>');$.post(root_url+'requests/selection{/literal}{$type}{literal}/ajax/1/',$('#modal :input').serialize(),function(data){$('#modal').html(data);$('#result .plus').show();});"{/literal}{/if}>
                <option value="">выберите коллекцию</option>
                {foreach from=$collections item=c}
                    <option value="{$c.id}"
                            {if $smarty.post.collection_id == $c.id}selected="selected"{/if}>
                        {$c.title}
                    </option>
                {/foreach}
            </select>
        </label>
        {*<input type="submit" class="button" id="search_goods" value="Поиск">*}
    </form>
</div>
<div class="result-table">
    <table id="result">
        <tr >
	<!--	<td colspan="13" style="height: 35px;">
		<table style="position: fixed;width: 770px;"><tr>
		-->
            <th></th>
            {foreach from=$good_fields key=gf item=gfv}
                {if $gf == 'id' or $gf == 'url'}
                {elseif $gf == 'remains'}
                    {if $settings.show_remains == 'yes' and $dealer.show_remains == 'yes'}
                        {assign var=store_count value=0}
                        {foreach from=$stores item=s name=stores}
                            {if $smarty.foreach.stores.iteration <= $max_stores_count}
                                <th width="127">
                                    <div class="st_title">
                                        {if $s.status == 'main'}
                                            Склад
                                        {else}
                                            {if $store_count++ == 0}
                                                Ближ.поставка
                                            {else}
                                                След.поставка
                                            {/if}
                                        {/if}
                                    </div>
                                    <div style="width:130px;"><span
                                                class="stock">Остаток</span><span
                                                class="delimiter">|</span><span
                                                class="reserve">Резерв</span>
                                    </div>
                                </th>
                            {/if}
                        {/foreach}
                    {/if}
                {else}
                    <th>{$gfv.title}</th>
                {/if}
            {/foreach}
		<!--	</tr></table>
			</td>-->
			
        </tr>
        {foreach from=$goods item=g name=sel}
            <tr{if $smarty.foreach.sel.iteration%2==0} style='background-color:#ecf8fb;'{/if}>
                <td>
                    <input type="checkbox"
                           value="{if $type}{$g.id}{else}{$g.art}{/if}"{if $type} data-art="{$g.art}"{/if}
                           data-type="{$type}"{if $type && $requests_ids} data-to_order="1"{/if}
                           class="checkbox">
                </td>
                {foreach from=$good_fields key=gf item=gfv}
                    {if $gf == 'id' or $gf == 'url'}
                    {elseif $gf == 'remains'}
                        {if $settings.show_remains == 'yes' and $dealer.show_remains == 'yes'}
                            {assign var=skipped_stores value=0}
                            {foreach from=$stores item=s}
                                {if is_array($g.remains[$s.id])}
                                    <td class="remains">
                                        <span class="stock">{$g.remains[$s.id].stock|default:"—"}</span>
                                        <span class="reserve">{$g.remains[$s.id].reserve|default:"—"}</span>
                                        {if $s.delivery_date and $s.delivery_date != '0000-00-00'}
                                            <div class="date">
                                            ({$s.delivery_date|date_format:'%d.%m.%Y'}
                                            )</div>{/if}
                                    </td>
                                {else}
                                    {assign var=skipped_stores value=$skipped_stores+1}
                                {/if}
                            {/foreach}
                            {section name=skipped_stores start=0 loop=$skipped_stores}
                                <td></td>
                            {/section}
                        {/if}
                    {elseif $gf == 'prices'}
                        <td>{$g.prices[$dealer.price_id].price|default:'—'}</td>
                    {elseif $gf == 'price1'}
                        <td>
                            {if $g.max_sk == 100}
                                {math equation=c/100 c=$dealer.category_amount_of_discount assign=category_amount_of_discount}
                            {else}
                                {math equation=c/100 c=$g.max_sk assign=category_amount_of_discount}
                            {/if}

                            {if $category_amount_of_discount}
                                {math equation=c-(c*w) c=$g.price1 w=$category_amount_of_discount assign=price1}
                                {$price1}
                            {else}
                                {$g.price1}
                            {/if}
                        </td>
                    {elseif $gf == 'price2'}
                        <td>
                            {if $g.max_sk == 100}
                                {math equation=c/100 c=$dealer.category_amount_of_discount assign=category_amount_of_discount}
                            {else}
                                {math equation=c/100 c=$g.max_sk assign=category_amount_of_discount}
                            {/if}

                            {if $category_amount_of_discount}
                                {math equation=c-(c*w) c=$g.price2 w=$category_amount_of_discount assign=price2}
                                {$price2}
                            {else}
                                {$g.price2}
                            {/if}
                        </td>
                    {elseif $gf == 'url' and $g.url}
                        <td><a href="{$g.url}" target="_blank">Каталог</a></td>
                    {elseif $gf == 'title'}
                        {if ($g.factory_url || $g.factory_id) && ($g.collection_url && $g.collection_id) && $g.$gf}
                            <td><a target="_blank"
                                   href="/cat/{$g.factory_url|default:$g.factory_id}/{$g.collection_url|default:$g.collection_id}/#one_good_{$g.id}"
                                   title="{$g.$gf}">{$g.$gf}</a></td>
                        {else}
                            <td>{$g.$gf|default:'—'}</td>
                        {/if}
                    {else}
                        <td>{$g.$gf|default:'—'}</td>
                    {/if}
                {/foreach}
            </tr>
        {/foreach}
    </table>
</div>
<div class="filter bottom">
    <form action="" method="post">
        <label>Артикул:
            <input type="text" autocomplete="off" data-type="" class="text" name="s" id="string" data-filter="1" value="{$smarty.post.s|escape}">
        </label>
        <label>Наименование:
            <input type="text" autocomplete="off" data-type="" class="text" name="s1" id="string1" data-filter="1" value="{$smarty.post.s1|escape}">
        </label>
        <button id="filter_selection" data-type="/type/onorder">Поиск</button>
        {*<input type="submit" class="button" id="search_goods" value="Поиск">*}
    </form>
    <p class="red">Если в данном списке не оказалось нужной коллекции, пожалуйста, обратитесь к нашим операторам по телефону (495) 933-50-33 и уточните наличие</p>
</div>
