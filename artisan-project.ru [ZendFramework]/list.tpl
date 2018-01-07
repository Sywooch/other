<h1>Отгрузки</h1>
{if $shipment_id}
    <div style="padding: 50px 0;">Заявка на отгрузку №{$shipment_id} успешно отправлена.</div>
{elseif $shipment_error}
        <div class="error">{$shipment_error}</div>
{/if}
    <div class="inner_cont personal">
        {loadview name=profile/menu}
        <div class="personal_table">
            {if !empty($shipments.data)}
            {form name='shipment_form'}
            <table>
                <tr>
                    <th></th>
                    <th>Дата создания</th>
                    <th>Заявка</th>
                    <th>Номер счета</th>
                    <th>Статус</th>
                    <th>Оператор</th>
                    <th>Кол-во</th>
                    <th>Сумма,<br>руб</th>
                    <th>Масса,<br>кг</th>
                    <th>Скидка,<br>%</th>
                    <th>Изменения</th>
                </tr>                                                                               
                {foreach from=$shipments.data item=req name=req}
                {if $req.goods_count == 0} {php} continue; {/php} {/if}
                <tr{if $smarty.foreach.req.iteration%2 == 0} style="background-color:#ecf8fb;"{/if}>
                    <td><input class="req_checkbox" type="checkbox" value="{$req.id}"{if $ship_sel[$req.id]} checked="1"{/if} /></td>
                    <td>
                        {$req.cdate|date_format:"%d.%m.%Y"}<br>
                        {$req.cdate|date_format:"%H:%M"}
                    </td>
                    <td>
                        <a class="open_shipment_goods" href="#">№{$req.id}</a>
                    </td>
                    <td>{$req.account_number}</td>
                    <td>
                        <!--{$shipments.fields.status.values[$req.status]}-->{$req.status_title_dealer}<br>
                        {$req.mdate|date_format:"%d.%m.%Y"}<br>
                        {$req.mdate|date_format:"%H:%M"}
                    </td>
                    <td>{$req.operator_name}</td>
                    <td>{$req.goods_count}</td>
                    <td>{$req.goods_sum|round:2}</td>
                    <td>{$req.goods_weight|round:2}</td>
                    <td>{if $req.discount != 0}{$req.discount}{/if}</td>
                    <td>
                        {foreach from=$req.corrs item=cor key=cor_id name=cors}
                            <a href="{$root_url}{$ctrlName}/show/id/{$cor_id}/" target="_blank" class="modal blue"{if $cor.status == 'processed'} style="color: red;"{/if} title="{$shipments.fields.status.values[$cor.status]}">
                                №{$cor_id}
                            </a>
                            {if !$smarty.foreach.cors.last}→{/if}
                        {/foreach}
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="10">
                    {if !empty($req.goods.data)}
                    <table{if !$ship_sel || !($ship_sel && isset($ship_sel[$req.id]))} style="display:none;"{/if} class="goods_list">
                        <tr>
                            <th></th>
                            <th>Артикул</th>
                            <th>Наименование</th>
                            <th>Кол-во, м<sup>2</sup></th>
                            <th>НеОтгр</th>
                            <th>ТекущОст </th>
                            <th>Масса, кг</th>
                            <th>Цена, руб./шт.</th>
                            <th>Стоимость, руб.</th>
                        </tr>
                        {foreach from=$req.goods.data item=gd name=req}                    
                        <tr{if $smarty.foreach.req.iteration%2 == 0} style="background-color:#ecf8fb;"{/if}>
                            <td>{if $gd.remains > 0 and $gd.good_not_shipped !== 0 and !isset($gd.blocked)}<input type="checkbox" class="good_checkbox" name="reqs[{$req.id}][]" value="{$gd.good_id}"{if isset($ship_sel[$req.id][$gd.good_id])} checked="1"{/if} />{/if}</td>
                            <td class="gd_article">{$gd.good_art}</td>
                            <td>{$gd.good_title}</td>
                            <td class="gd_count">{$gd.good_count|round:4}</td>
                            <td>
                                {if $gd.good_not_shipped === ""}
                                    {$gd.good_count|round:4}
                                {else}
                                    {$gd.good_not_shipped|round:4}
                                {/if}
                            </td>
                            <td class="gd_remains">{$gd.remains|round:4}</td>
                            <td>
                                {math equation=c*w c=$gd.good_count w=$gd.good_weight assign=total_weight}
                                {$total_weight|round:2}
                            </td>
                            <td>{$gd.good_price|round:2}</td>
                            <td>
                                {math equation=p*(100-d)/100 p=$gd.good_price d=$req.discount assign=total_temp_price}
                                {math equation=c*t c=$gd.good_count t=$total_temp_price assign=total_price}
                                {$total_price|round:2}
                            </td>
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
                                    <a target="_blank" href="{$root_url}{$ctrlName}/show/id/{$request.id}/for_print/1/">Распечатать заказ</a>
                                </div>
                            </div>
                        </div>
                        {if empty($archive.data.cid)}
                        <div class="button_left" rel="">
                            <div class="button_right">
                                <div class="button_middle">
                                    <a target="_blank" href="{$root_url}{$ctrlName}/id/{$request.id}/">Корректировать заказ</a>
                                </div>
                            </div>
                        </div>
                        {/if}
                    {/if}
                    {else}
                        Товаров не найдено
                    {/if}
                    </td>                
                </tr>
                {/foreach}
                {if $shipment_id}
                    <tr>
                        <td colspan="11">
                            <div style="padding: 50px 0;">Заявка на отгрузку №{$shipment_id} успешно отправлена.</div>
                        </td>
                    </tr>
                {elseif $shipment_error}
                    <tr>
                        <td colspan="11">
                            <div class="error">{$shipment_error}</div>
                        </td>
                    </tr>
                {/if}
                <tr class="foot">
                    <td colspan="11">
                        <div id="order">
                            <div class="left">
                                <input type="button" value="Оформить отгрузку" class="button" id="shipment-registr">
                            </div>
                            <div id="shipment-f" data-shiptime="{$settings.ship_time}"{if empty($form_errors)} style="display:none;"{/if}>
                                <table>
                                    {foreach from=$forms_elements.shipment_form key=f item=v}
                                    {if $form_errors[$f]}
                                        <tr>
                                            <td colspan="2" class="error"><strong>{$form_errors[$f]}</strong></td>
                                        </tr>
                                    {/if}
                                    <tr>
                                        <td>{label name=$f}</td>
                                        <td>{input name=$f}</td>
                                    </tr>
                                    {/foreach}
                                </table>
                                <div>
                                    <input type="submit" class="button" name="shipment" value="Отправить заявку">
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>        
            </form>
            {loadview name='paging'}
            {else}
            В архиве заявок нет.
            {/if}
        </div>
    </div>
