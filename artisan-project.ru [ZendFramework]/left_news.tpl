<div class="widget widget_news">
                    <div class="widget_title">НОВОСТИ</div>
                    <div class="widget_container_items clearfix">
						{foreach from=$main_news item=n}
							<div class="widget_item">
							   <a href="/about/news/id/{$n.id}/">{$n.title|strip_tags|trim}</a>
								<span class="widget_date">{assign var=month value=$n.date|date_format:'%m'}
									{if $month == 1}
										января
									{elseif $month == 2}
										февраля
									{elseif $month == 3}
										марта
									{elseif $month == 4}
										апреля
									{elseif $month == 5}
										мая
									{elseif $month == 6}
										июня
									{elseif $month == 7}
										июля
									{elseif $month == 8}
										августа
									{elseif $month == 9}
										сентября
									{elseif $month == 10}
										октября
									{elseif $month == 11}
										ноября
									{elseif $month == 12}
										декабря
									{/if}
									{$n.date|date_format:'%Y'}</span>
								<div class="widget_content">{$n.description|strip_tags|trim}</div>
							</div>
						{/foreach}
						</div>
                    <div class="view_all_widget">
                        <a href="/about/news/" class="button_blue">Читать далее</a>
                    </div>
                </div>