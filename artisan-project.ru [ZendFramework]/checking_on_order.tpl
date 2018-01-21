<h1>Личный кабинет</h1>
<div style="padding-top: 20px; color: red; text-align: center;">
Уважаемые дилеры!<br>
ВНИМАНИЕ! Требования к заполнению доверенностей  <a href="http://artisan-project.ru/about/news/id/89/">подробнее..</a></div>
<br>
{if $request.type && $requests_ids}
    <div data-confirm="type"></div>
{/if}
{*<div style="padding-top: 20px; color: red; text-align: center;">Переоценка с 14 марта 2014 года  <a href="http://artisan-project.ru/about/news/id/90/">подробнее..</a></div>*}
<div class="inner_cont personal">
    {loadview name=profile/menu}
        <div class="personal_table checking">

        <script type="text/javascript">
        var max_count_in_req = {$settings.max_count_in_req};
        </script>

        {if $flashMessage}
            <div style="padding: 50px 0;">
            {$flashMessage}
            </div>
        {/if}

        {if $request_id}
            {if $request_error}
                <div class="error">{$request_error}</div>
            {elseif  $corr_id}
                <div style="padding: 50px 0;">Корректировка №{$request_id} успешно создана для заявки №{$corr_id}.</div>
            {else}
                <div style="padding: 50px 0;">
                    {if $request.type}
                        Заявка №{$request_id} успешно сохранена.
                    {else}
                        Заявка №{$request_id} успешно отправлена.
                    {/if}
                </div>
            {/if}
        {else}
            {if $good_count > $settings.max_count_in_req}
                <div class="error">Превышено максимальное количество позиций в заказе.</div>
            {/if}
            {form name='order'}
            <table id="request">
                <tr class="padding">
                    <td colspan="8">
					<script src='/public/zf/js/TextChange.js' type='text/javascript'></script>
					<input style="width: 660px;height: 20px;padding: 3px;text-align: left;" id="podbor_tovara" placeholder="Быстрый подбор товара" class="count text" type="text"></td>
					<div id="block-search-result"><ul id="list-search-result"></ul></div></div>
				</tr>
            <tr style="border-bottom:1px solid #142f66;">
                <th>Артикул</th>
                <th>Наименование</th>
                <th>Кол-во</th>
                <th>Упак.</th>
                <th>Пл.</th>
                <th>Цена, руб.</th>
                <th>Стоимость, руб.</th>
                {assign var=tdcount value=8}
                {if !empty($goods)}
	                {if $dealer.show_remains == 'yes'}
	                    {assign var=store_count value=0}
	                    {foreach from=$stores item=s name=stores}
	                        {if $smarty.foreach.stores.iteration <= $max_stores_count}
	                            <th style="width: 170px; text-align: center;">
	                            {math equation=a+1 a=$tdcount assign=tdcount}
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
	                            <span style="white-space: nowrap;">Остаток | Резерв</span>
	                        </th>
	                        {/if}
	                    {/foreach}
	                {elseif !$request.type}
	                    <th>Остатки</th>
	                {/if}
                {/if}
                <th></th>
            </tr>
                {foreach from=$goods item=g name=goods}
                    <tr>
                <td>
                    {if $request.type}
                        <span class="art">{$g.art}</span>
                        <input type="hidden" name="ids[]" value="{$g.id}" class="ids text" autocomplete="off">
                        <input type="hidden" name="art[]" value="{$g.art}" class="art text" autocomplete="off">
                    {else}
                        <input type="text" name="art[]" value="{$g.art}" class="art text" autocomplete="off">
                    {/if}
                </td>
                <td class="title clear">

            {if $g.count > 0 and !empty($g.similar) and !in_array($g.similar[0].art, $arts)}
                <a href="#" class="similar"><img src="/public/site/img/similar.png" alt="Аналогичный товар" title="Аналогичный товар"></a>
                    <div class="similar">
                        {foreach from=$g.similar item=s name=similar}
                            {if $smarty.foreach.similar.first}
                                {$s.ftitle}
                                <input type="hidden" name="similar_art" value="{$s.art}"/>
                                <input type="hidden" name="have" value="{$g.remains[1].stock}"/>
                            {/if}
                        {/foreach}
                    </div>
            {/if}
                    {if $g.non_liquid}
                        {assign var=non_liquid value=1}
                        <img class="noborder" src="/public/site/img/nlqd.png" alt="Товар в распродаже" title="Товар в распродаже">
                    {/if}
                    {if ($g.factory_url || $g.factory_id) && ($g.collection_url && $g.collection_id)}
                        <a target="_blank" href="/cat/{$g.factory_url|default:$g.factory_id}/{$g.collection_url|default:$g.collection_id}/#one_good_{$g.id}" title="{$g.title}">{$g.title}<br/>{$g.packCntByUnit} {$g.unit_title}/кор{if $g.unit_title == 'м2'}<br/>{$g.packCntByCount} шт/кор{/if}</a>
                    {else}
                        {$g.title}<br/>{$g.packCntByUnit} {$g.unit_title}/кор{if $g.unit_title == 'м2'}<br/>{$g.packCntByCount} шт/кор{/if}
                    {/if}
                </td>
                <td width="95">
                    <input type="text"
                           name="count[]"
                           data-type="{$request.type}"
                           data="{$g.unit_title}"
                           value="{$g.count}"
                           class="count text {if !$request.type and $g.count and $dealer.show_remains == 'yes'}{if ($g.remains[1].stock - $g.count) >=0}yes{elseif ($g.total_count - $g.count) >= 0}road{else}no{/if}{/if}"
                           autocomplete="off"
                            >
                    {$g.unit_title}
                </td>
                <td width="95">
                    <input type="text" name="count_pack[]" data="{$g.packCntByUnit}" value="{$g.count_pack}" class="count text" autocomplete="off"/>
                </td>
                <td width="95">
                    <input type="text" name="count_unit[]" data="{$g.packCntByCount}" value="{$g.count_unit}" class="count text" autocomplete="off"/>
                </td>
                <td class="clear">
                    {if is_array($g.prices)}
                        {$g.prices[$dealer.price_id].price}
                    {else}
                        {$g.prices}
                    {/if}
                    {if $request.type}
                        {$g.price}
                    {/if}
                </td>
                <td class="clear">
                    {$g.total}
                </td>
                    {if $dealer.show_remains == 'yes'}
	                    {assign var=td_noskip_count value=$max_stores_count}
                        {foreach from=$stores item=s name=stores}
                            {if ($g.remains[$s.id].stock or $g.remains[$s.id].reserve or $s.id == 1) and $g.count > 0 }
                                <td class="remains clear">
                                    <table>
                                        <tr>
	                                            <td>{$g.remains[$s.id].stock|default:"—"}</td>
	                                            <td>{$g.remains[$s.id].reserve|default:"—"}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">{if $s.delivery_date != '0000-00-00'}({$s.delivery_date|date_format:'%d.%m.%Y'}){/if}</td>
                                        </tr>
                                    </table>
                                </td>
                                {assign var=td_noskip_count value=$td_noskip_count-1}
                            {/if}
	                    {/foreach}

                        {section name=noskipping_td start=0 loop=$td_noskip_count}
                            <td></td>
                        {/section}
                    {elseif !$request.type}
                        <td class="remains clear">
	                        {if $g.count}{if ($g.remains[1].stock - $g.count) >=0}доступно к продаже{else}уточняйте у оператора{/if}{/if}
	                    </td>
                    {/if}
                        <td class="button"><span class="minus">×</span></td>
            </tr>
                {/foreach}
                {if $good_count < $settings.max_count_in_req}
                    <tr>
                <td>

                    {if $request.type}
                        <span class="art"></span>
                        <input type="hidden" name="art[]" class="art text" autocomplete="off">
                        <input type="hidden" name="ids[]" value="" class="ids text" autocomplete="off">
                    {else}
                        <input type="text" name="art[]" class="art text" autocomplete="off">
                    {/if}
                </td>
                <td class="title"></td>
                <td><input type="text" name="count[]" class="count text" autocomplete="off"></td>
                <td><input type="text" name="count_pack[]" class="count text" autocomplete="off"></td>
                <td><input type="text" name="count_unit[]" class="count text" autocomplete="off"></td>
                <td></td>
                <td></td>
                        {foreach from=$stores item=s name=stores}
                            {if $smarty.foreach.stores.iteration <= $max_stores_count}
                                <td class="remains"></td>
                            {/if}
                        {/foreach}
            </tr>
                {/if}

                <tr class="bottom">
                <td colspan="{$tdcount}">
                    <a href="#" class="plus blue">{if !$request.type}Добавить артикул{/if}</a>
                    {if $dealer.show_remains == 'yes' && !$request.type}
	                    <span class="legend">Наличие</span>
	                    <span class="legend"><img src="/public/site/img/is.png" alt="есть">есть</span>
	                    <span class="legend"><img src="/public/site/img/no.png" alt="нет">нет</span>
	                    <span class="legend"><img src="/public/site/img/maybe.png" alt="из прихода">из прихода</span>
                    {/if}
                    {if $request.type}<br/>Цена зависит от количества{/if}
							<div style="float:right"><div class="button_left" rel="">
                                <div class="button_right">
                                    <div class="button_middle">
                                        <a href="{$root_url}requests/selection/" target="_blank" id="selection" data-type="{$request.type}">Подобрать</a>
                                    </div>
                                </div>
                            </div>
					       <input type="submit" data-sameLink="1" name="check" value="{if !$request.type}Проверить{else}Обновить{/if}" id="check_form">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="#" style="color:#47BDD4;" id="reset_link"{if $request.type && $requests_ids} data-sameLink="1"{/if}>Очистить формy</a>
							</div>
							<div style="clear:both;width:100%;"></div>
<p class="red" style="display:block;color: #F00;font-weight: bold;line-height: 17px;padding: 10px 0px 0px 1px;margin-bottom: 0px;">ЕСЛИ В ФОРМЕ ПОДБРОРА НЕ ОКАЗАЛОСЬ НУЖНОЙ ВАМ ПЛИТКИ, КОЛЛЕКЦИИ ИЛИ ФАБРИКИ, ПОЖАЛУЙСТА ЗАПОЛНИТЕ СВОБОДНУЮ ФОРМУ НИЖЕ ИЛИ ОБРАТИТЕСЬ К НАМ ПО ТЕЛЕФОНУ (495) 933-50-33, И УТОЧНИТЕ УСЛОВИЯ - МЫ ИМЕЕМ ВОЗМОЖНОСТЬ ПОСТАВИТЬ ПРАКТИЧЕСКИ ВСЕ КЕРАМИЧЕСКИЕ МАТЕРИАЛЫ ИЗ ИТАЛИИ, ИСПАНИИ, ПОРТУГАЛИИ, КИТАЯ И РОССИИ ПО МАКСИМАЛЬНО ПРИВЛЕКАТЕЛЬНЫМ ЦЕНАМ.</p>
						<!--	<center style="margin-top:10px;" class="asdsfgj"><div class="button_left" rel="">
                                <div class="button_right">
                                    <div class="button_middle">
                                        <a href="javascript:void(0);" class="open_fack" id="selection">Оформить заявку</a>
                                    </div>
                                </div>
                            </div>
							</center>-->
<div class="form_oform_zayav" >
	<textarea name='svobod_text' placeholder="Впишите наименование или артикулы необходимой плитки, либо название коллекции или фабрики и необходимые объемы поставки." style="margin-top:10px;width:98%;height:60px;padding:5px;border: 1px solid #CCC;"></textarea>
</div>



			   </td>
            </tr>
            <tr class="foot">
                <td colspan="{$tdcount}">
                    <div id="order">
                        <div class="lft">
                            

                     

                            <div id="order-form" {if empty($smarty.post.order)}class="forhide"{/if}>
                                {*{if !$request.type}*}
                                    <b>Общая стоимость заказа{if $settings.discount != 0}
                                        без скидки:{/if}</b> {$total|default:0}
                                    <br>
                                    {if $settings.discount or $extra_discount}
                                        <span{if $settings.discount > 0} class="error"{/if}>
                                            <b>Скидка:</b> {if $extra_discount}{$settings.extra_discount}{else}{$settings.discount}{/if}%<br>
                                        </span>
                                        <b>Общая стоимость заказа со скидкой:</b> {$discount_total|default:0}<br>
                                    {/if}
                                    {if $discount_total < $settings.total_price}
                                        Общая стоимость не превышает {$settings.total_price} руб.
                                    {/if}
                                    {if $non_liquid}
                                        <br><br>
                                        В вашем заказе имеется товар, который в распродаже.<br>
                                        На количество из складского остатка гарантирована указанная цена.<br>
                                        При поставке на заказ — цена расчетная, уточняйте у Вашего менеджера.<br>
                                    {/if}
                                    <br>
                                    <br>
                                    <b>Общий вес заказа:</b> {$total_weight|default:0}<br>
                                    {if $reqErrors}
                                        {foreach from=$reqErrors item=reqError}
                                            <span class="error">{$reqError}</span><br/>
                                        {/foreach}
                                    {/if}
                                    {foreach from=$forms_elements.order key=f item=v}
                                        {if !in_array($f, array('payment_method_id', 'doc_number', 'doc_date'))}
                                            {label name=$f}
                                            {input name=$f class='text' cols="90" rows="7"}
                                        {elseif $dealer.category_id == 5}
                                            {if $f=='payment_method_id'}
                                                <div id="opt_mag_fields">
                                                {if !empty($smarty.post.order) and empty($smarty.post.payment_method_id)}
                                                    <div class="error">Поле {$v.title} не может быть пустым.</div>
                                                {/if}
                                            {/if}
                                            {label name=$f}
                                            {input name=$f class='text' cols="90" rows="7"}
                                            {if $f=='doc_date'}</div>{/if}
                                        {/if}
                                    {/foreach}
                                    <br><br>
                                    <input type="submit" data-sameLink="1" class="button" name="order" value="Отправить заявку">
                                {*{/if}*}
                            </div>
                        </div>
                        <div class="rght">
                            <!--<input type="submit" value="Сохранить" class="button" name="save_order" />-->
                            <input type="button" value="Оформить заказ" class="button" id="order-show" />
                            <br clear="all" />
                        </div>
                    </div>
                </td>
            </tr>
            <tr class="padding">
                <td></td>
            </tr>
        </table>
            </form>
        {/if}
    </div>
</div>
