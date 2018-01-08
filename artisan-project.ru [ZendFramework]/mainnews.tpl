<div class="col-md-5">
                <div class="news_block">
                    <h3>Новости</h3>
						{php} $i=0; {/php}
                   		{foreach from=$main_news item=n}




			 <div class="news_block_item">
                        <a href="/about/news/id/{$n.id}/">{$n.title|strip_tags|trim}</a>
                        <div class="nbi_time">{$n.date|date_format:'%d'}
                {assign var=month value=$n.date|date_format:'%m'}
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
                {$n.date|date_format:'%Y'}</div>
                		
                        <div class="nbi_desc">
                        {php}
                        $desc=strip_tags($this->page->main_news[$i]['description']);
                        $desc=trim($desc);
                        echo $desc;                        
                        {/php}
                        </div>
                    </div>
				{php} $i++; {/php}				
  
    {/foreach}

                    <div class="text-center view_all_news">
                        <a href="/about/news/">Читать далее</a>
                    </div>
                </div>

            </div>
	