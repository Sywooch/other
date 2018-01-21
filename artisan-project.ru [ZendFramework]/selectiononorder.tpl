<div class="filter">
    <form action="" method="post">
        <label>Фабрика:
            <select name="factory_id" id="factory" class="select" {if $request.ajax}{literal}onchange="$('#result').html('<div class=\'center\'><img src=\'/public/site/img/loading.gif\' alt=\'Загрузка...\' title=\'Загрузка...\'></div>');$.post(root_url+'requests/selection/type/onorder/ajax/1/',$('#modal :input').serialize(),function(data){$('#modal').html(data);$('#result .plus').show();});"{/literal}{/if}>
                <option value="">выберите фабрику</option>
                {foreach from=$factories item=f}
                    <option value="{$f.id}" {if $smarty.post.factory_id == $f.id}selected="selected"{/if}>
                        {$f.title}
                    </option>
                {/foreach}
            </select>
        </label>
        <label>Серия:
            <select name="collection_id" id="collection" class="select"  {if $request.ajax}{literal}onchange="$('#result').html('<div class=\'center\'><img src=\'/public/site/img/loading.gif\' alt=\'Загрузка...\' title=\'Загрузка...\'></div>');$.post(root_url+'requests/selection/type/onorder/ajax/1/',$('#modal :input').serialize(),function(data){$('#modal').html(data);$('#result .plus').show();});"{/literal}{/if}>
                <option value="">выберите коллекцию</option>
                {foreach from=$collections item=c}
                    <option value="{$c.id}" {if $smarty.post.collection_id == $c.id}selected="selected"{/if}>
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
        <tr>
		<td colspan="13" style="height: 35px;">
		<table style="position: fixed;width: 770px;" class="fdterre"><tr>
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
                                    <div style="width:130px;"><span class="stock">Остаток</span><span class="delimiter">|</span><span class="reserve">Резерв</span></div>
                                </th>
                            {/if}
                        {/foreach}
                    {/if}
                {else}
                    <th>{$gfv.title}</th>
                {/if}
            {/foreach}
			</tr></table>
			</td>
        </tr>
        {math equation="1-x/100" x=$dealer.category_amount_of_discount assign=discount}
        {foreach from=$goods item=g name=sel}
            <tr{if $smarty.foreach.sel.iteration%2==0} style='background-color:#ecf8fb;'{/if}>
                <td>
                    <input type="checkbox" value="{$g.id}" data-art="{$g.art}" data-type="onorder" class="checkbox">
                </td>
                <!-- "Размер", "Вес", "Шт", "М2", "КорПал", "КолЦена2". -->
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
                                        {if $s.delivery_date and $s.delivery_date != '0000-00-00'}<div class="date">({$s.delivery_date|date_format:'%d.%m.%Y'})</div>{/if}
                                    </td>
                                {else}
                                    {assign var=skipped_stores value=$skipped_stores+1}
                                {/if}
                            {/foreach}
                            {section name=skipped_stores start=0 loop=$skipped_stores}
                                <td></td>
                            {/section}
                        {/if}
                    {elseif $gf == 'price1'}
                        <td>{$g.price1*$settings.euro_rub*$discount|number_format:'2':',':''}</td>
                    {elseif $gf == 'price2'}
                        <td>{$g.price2*$settings.euro_rub*$discount|number_format:'2':',':''}</td>
                    {elseif $gf == 'url' and $g.url}
                        <td><a href="{$g.url}" target="_blank">Каталог</a></td>
                    {elseif $gf == 'title'}
                        {if ($g.factory_url || $g.factory_id) && ($g.collection_url && $g.collection_id) && $g.$gf}
                            <td><a target="_blank" href="/cat/{$g.factory_url|default:$g.factory_id}/{$g.collection_url|default:$g.collection_id}/#one_good_{$g.id}" title="{$g.$gf}">{$g.$gf}</a></td>
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
            <input type="text" autocomplete="off" data-type="/type/onorder" class="text" name="s" id="string" data-filter="1" value="{$smarty.post.s|escape}">
        </label>
        <label>Наименование:
            <input type="text" autocomplete="off" data-type="/type/onorder" class="text" name="s1" id="string1" data-filter="1" value="{$smarty.post.s1|escape}">
        </label>
        <button id="filter_selection" data-type="/type/onorder">Поиск</button>
        {*<input type="submit" class="button" id="search_goods" value="Поиск">*}
    </form>
    <p class="red">Если в данном списке не оказалось нужной коллекции, пожалуйста, обратитесь к нашим операторам по телефону (495) 933-50-33 и уточните наличие</p>
</div>
