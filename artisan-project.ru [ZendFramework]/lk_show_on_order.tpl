111
{assign var=total_count value=0}
{assign var=total_price value=0}
{assign var=total_weight value=0}
{foreach from=$goods.data item=g}
    {math equation=x+1 x=$total_count assign=total_count}
    {math equation=x+y*z x=$total_price y=$g.good_price z=$g.good_count assign=total_price}
    {math equation=x+y*z x=$total_weight y=$g.good_weight z=$g.good_count assign=total_weight}
{/foreach}

<div class="personal_table item">
    <div class="h2">
        Заявка №{$archive.data.id}
        от {$archive.data.cdate|date_format:"%d.%m.%Y %H:%M"},
        счёт №
        {if in_array($archive.data.id, $limited_no_liquid_remains)}
            <span class="min_total_price" title="Заказанных позиций распродажного товара больше, чем остатка распродажного товара. Для получения счета обратитесь к администратору.">
                {$archive.data.account_number}
            </span>
        {else}
            {if $archive.data.goods_sum < $settings.total_price}
                <span class="min_total_price" title="Общая стоимость заказа не превышает {$settings.total_price} руб. Для получения счета обратитесь к администратору.">
                    {$archive.data.account_number}
                </span>
            {else}
                <a href="{$root_url}{$ctrlName}/print/id/{$req.id}/" target="_blank" title="Открыть счёт для печати">{$archive.data.account_number}</a>
            {/if}
        {/if}

    </div>
    {if $has_history > 1}<a class="modal" href="/requests/history/id/{$archive.data.id}/">исходная заявка</a>{/if}
    {if !empty($supplier)}
    <table class="supplier">
        <tr>
            <th>Поставщик</th>
            <td>{$supplier.title|default:' &mdash; '}</td>
        </tr>
        <tr>
            <th>ИНН</th>
            <td>{$supplier.inn|default:' &mdash; '}</td>
        </tr>
        <tr>
            <th>КПП</th>
            <td>{$supplier.kpp|default:' &mdash; '}</td>
        </tr>
        <tr>
            <th>Адрес</th>
            <td>{$supplier.legal_address|default:' &mdash; '}</td>
        </tr>
        <tr>
            <th>Телефон</th>
            <td>{$supplier.phone|default:' &mdash; '}</td>
        </tr>
        <tr>
            <th>БИК</th>
            <td>{$supplier.bik|default:' &mdash; '}</td>
        </tr>
        <tr>
            <th>Р/с</th>
            <td>{$supplier.current_account|default:' &mdash; '}</td>
        </tr>
        <tr>
            <th>Банк</th>
            <td>{$supplier.bank|default:' &mdash; '}</td>
        </tr>
        <tr>
            <th>Кор/счёт</th>
            <td>{$supplier.correspondent_account|default:' &mdash; '}</td>
        </tr>
        <tr>
            <th>Отправитель</th>
            <td>{$dealer.legal_entities[$archive.data.legal_entity_id].legal_entity|default:' &mdash; '}</td>
        </tr>
    </table>
    {/if}

    <table>
        <tr>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <td>{$archive.fields.status.title}</td>
            <td><!--{$archive.fields.status.values[$archive.data.status]}-->{$archive.data.status_title_dealer}</td>
        </tr>
        {if $bills}
        <tr>
            <td>Накладные</td>
            <td>
                {foreach from=$bills item=bill name=bill}
                    <a href="{$bill.link}" >{$bill.title}</a><br/>
                {/foreach}
            </td>
        </tr>
        {/if}
        <tr>
            <td>{$archive.fields.type.title}</td>
            <td>{$archive.fields.type.values[$archive.data.type]}</td>
        </tr>
        <tr>
            <td>{$archive.fields.mdate.title}</td>
            <td>{$archive.data.mdate}</td>
        </tr>
        <tr>
            <td>Количество позиций</td>
            <td>{$total_count}</td>
        </tr>
        <tr>
            <td>Сумма</td>
            <td>{$total_price|round:2} руб.</td>
        </tr>
        <tr>
            <td>Масса</td>
            <td>{$total_weight|round:2} кг</td>
        </tr>
        <tr>
            <td>{$archive.fields.comments.title}</td>
            <td>{$archive.data.comments}</td>
        </tr>
        <tr>
            <td>{$archive.fields.comments_operator.title}</td>
            <td>{$archive.data.comments_operator}</td>
        </tr>
        {if !$request.type}
            <tr>
                <td>{$archive.fields.discount.title}</td>
                <td>{$archive.data.discount} %</td>
            </tr>
        {/if}
        <tr>
            <th></th>
            <th></th>
        </tr>
    </table>
<br>
    {if !empty($archive.data)}
    <table class="goods_list">
        <tr>
            {if $archive.data.issue}
                <th></th>
            {/if}
            <th>Артикул</th>
            <th>Наименование</th>
            <th>Кол-во, м<sup>2</sup></th>
            {if !$request.type}
                <th>НеОтгр</th>
                <th>ТекущОст </th>
            {/if}
            <th>Масса, кг</th>
            <th>Цена, руб./шт.</th>
            <th>Стоимость, руб.</th>
            <th>Наличие</th>
            <th>Дата производства</th>
            <th>Количество товара после импорта</th>
            
        </tr>
        {foreach from=$goods.data item=gd name=req}
        <tr{if $smarty.foreach.req.iteration%2 == 0} style="background-color:#ecf8fb;"{/if}>
            {if $archive.data.issue}
                <td>{if in_array($gd.status, array(1, 2))}<input type="checkbox" data-issuecheck="1" name="issue[]" value="{$gd.good_id}">{/if}</td>
            {/if}
            <td>{$gd.good_art}</td>
            <td>{$gd.good_title}</td>
            <td>
                <div class="{if $gd.status == 3 || $gd.status == 0}no{elseif $gd.status == 1}yes{elseif $gd.status == 2}road{/if}">
                    {$gd.good_count|round:4}
                </div>
            </td>
            {if !$request.type}
                <td>{$gd.good_not_shipped|round:4}</td>
                <td>{$gd.remains_act|round:4}</td>
            {/if}
            <td>
                {math equation=c*w c=$gd.good_count w=$gd.good_weight assign=total_weight}
                {$total_weight|round:2}</td>
            <td>{$gd.good_price|round:2}</td>
            <td>
                {math equation=c*p c=$gd.good_count p=$gd.good_price assign=total_price}
                {$total_price|round:2}
            </td>
            <td>
                {if $gd.status == 0}
                    Не известно
                {elseif $gd.status == 1}
                    Есть в наличии
                {elseif $gd.status == 2}
                    В производстве
                {elseif $gd.status == 3}
                    Нет в наличии
                {/if}
            </td>
            <td>
                {if $gd.date_ready != '0000-00-00 00:00:00'}
                    {$gd.date_ready|date_format:"%d.%m.%Y"}<br>
                    {$gd.date_ready|date_format:"%H:%M"}
                {/if}
            </td>
            <td>{if $gd.good_count_new != 0}{$gd.good_count_new}{/if}</td>
        </tr>
        {/foreach}
    </table>
    <div class="comments">
        <br>
        {if $archive.data.comments}<strong>Коммментарий:</strong> {$archive.data.comments}<br><br>{/if}
        {if $archive.data.comments_operator}<strong>Коммментарий оператора:</strong> {$archive.data.comments_operator}{/if}
    </div>
    {if $request.ajax}
    <br>
        <div class="button_left" rel="">
            <div class="button_right">
                <div class="button_middle">
                    <a target="_blank" href="{$root_url}{$ctrlName}/show{if $request.type}/type/onorder{/if}/id/{$request.id}/for_print/1/">Распечатать заказ</a>
                </div>
            </div>
        </div>
        {if empty($archive.data.cid)}
        <div class="button_left" rel="">
            <div class="button_right">
                <div class="button_middle">
                    <a target="_blank" href="{$root_url}{$ctrlName}/id/{$request.id}/{if $request.type}type/onorder/{/if}">Корректировать заказ</a>
                </div>
            </div>
        </div>
        {/if}
        {if $archive.data.issue}
            <div class="button_left" rel="">
                <div class="button_right">
                    <div class="button_middle">
                        <a data-issue="1" data-id="{$request.id}" href="{$root_url}{$ctrlName}/issue/id/{$request.id}/">Оформить счёт</a>
                    </div>
                </div>
            </div>
        {/if}
        {if $archive.data.saved == 'yes'}
            <div class="button_left" rel="">
                <div class="button_right">
                    <div class="button_middle">
                        <a target="_blank" href="{$root_url}{$ctrlName}/id/{$request.id}/{if $request.type}type/onorder/{/if}">Отправить</a>
                    </div>
                </div>
            </div>
        {/if}
    {/if}
    {else}
        Заявка не найдена
    {/if}
</div>