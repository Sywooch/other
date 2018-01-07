{assign var=total_count value=0}
{assign var=total_price value=0}
{assign var=total_weight value=0}
{foreach from=$goods.data item=g}
    {math equation=x+1 x=$total_count assign=total_count}
    {math equation=x+y*z x=$total_price y=$g.good_price z=$g.good_count assign=total_price}
    {math equation=x+y*z x=$total_weight y=$g.good_weight z=$g.good_count assign=total_weight}
{/foreach}
            <div class="wrap">
                            <h1>Заявка №{$archive.data.id}
        {if $archive.data.status_title_dealer != "В обработке"}от {$archive.data.cdate|date_format:"%d.%m.%Y %H:%M"},
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
        {/if}{/if}</h1>
                            <table class="firstTable">
                                <tr>
                                    <td>{$archive.fields.status.title}</td>
                                    <td class="reserveType">{$archive.data.status_title_dealer}</td>
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
                                {if $archive.data.status_title_dealer != "В обработке"}
                                <tr>
                                    <td>Дата обработки</td>
                                    <td>{$archive.data.mdate}</td>
                                </tr>
                                {/if}
                                <tr>
                                    <td>Количество позиций</td>
                                    <td>{$total_count}</td>
                                </tr>
                                <tr>
                                    <td>Общая стоимость</td>
                                    <td>{php} echo number_format(round($this->page->total_price,2), 2, '.', ' ' ); {/php} руб.</td>
                                    {php}
                                    $total_price2=$this->page->total_price;
                                    
                                    {/php}
                                </tr>
                                <tr>
                                    <td>Общий вес</td>
                                    <td>{$total_weight|round:2} кг</td>
                                </tr>
                                {if !$request.type}
									{if $archive.data.discount != 0}
                                    <!--<tr>
										<td>{$archive.fields.discount.title}</td>
										<td>{$archive.data.discount} %</td>
									</tr>-->
                                    {/if}
								{/if}
                            </table>
                            {if $archive.data.comments != ""}
                            <div class="comment">
                                <p>Комментарий:</p>
                                <p class="commentText">
                                    {$archive.data.comments}
                                </p>
                            </div>
                            {/if}
                            
                            {if $archive.data.comments_operator != "" and $archive.data.status_title_dealer != "В обработке"}
                            <div class="adminComment">
                                <p>Комментарий администратора:</p>
                                <p class="commentText">
                                    {$archive.data.comments_operator}
                                </p>
                            </div>
                            {/if}
                            
                            
							{if !empty($archive.data)}
                            <div class="tableWrap">
                                <table>
                                <tr>
                                    <td></td>
                                    <td>Кол-во</td>
                                    {if $archive.data.status_title_dealer != "В обработке"}<td>Неотгружено</td>{/if}
                                    <td>Цена</td>
                                    <td>Стоимость</td>
                                </tr>
								 {foreach from=$goods.data item=gd name=req}
                                <tr>
                                    <td>
                                        <p class="claimInfo">
                                            <span class="name">{$gd.good_title}</span>
                                            {$gd.good_art}
                                        </p>
                                    </td>
                                    <td>
                                        <p>{$gd.good_count|round:4} шт</p>
                                    </td>
                                    {if $archive.data.status_title_dealer != "В обработке"}
                                    <td>
                                        <p>{$gd.good_not_shipped|round:4} шт</p>
                                    </td>
                                    {/if}
                                    <td>
                                        <p>{php}
                                        echo number_format(round($this->_tpl_vars['goods']['data'][$this->_tpl_vars['gd']['good_id']]['good_price'],2), 2, '.', ' ' );
                                        {/php} руб/шт</p>
                                    </td>
                                    <td>
                                        <p> {math equation=c*p c=$gd.good_count p=$gd.good_price assign=total_price}
                {php}  echo number_format(round($this->_tpl_vars['total_price'],2), 2, '.', ' ' ); {/php} руб</p>
                                    </td>
                                </tr>
                                {/foreach}
                                
                            </table>
                            <p style="text-align:right; width:100%; font-size:16px; margin-top:-30px;">Общая стоимость: <strong>{php} echo number_format(round($total_price2,2), 2, '.', ' ' ); {/php}</strong> руб.</p>
                            </div>
                        </div>
						    {if $request.ajax}
										<a target="_blank" class="change" href="/requests/print/id/{$request.id}/">Распечатать заявку</a>

							{if empty($archive.data.cid)}

								<!--		<a target="_blank" class="change" href="{$root_url}{$ctrlName}/id/{$request.id}/{if $request.type}type/onorder/{/if}">Редактировать</a>
-->
							{/if}
						{/if}

                        <a href="javascript:void(0)" class="closeButton"></a>
						{else}
						Заявка не найдена
					{/if}