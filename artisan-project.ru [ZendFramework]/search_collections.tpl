
<div class="tabbable">
<div class="tab-content">
<div class="tab-pane active">
<div class="search_container">
<div class="row row_catalog_front tmp0">
{php} $i=1; {/php}
{foreach from=$search_collections item=c}
                            
								<div class="col-sm-6 col-md-3 search_r_{php} echo $i; {/php}" {php} if($i>=33){ echo' style="display:none;" '; } {/php}>
                                    <div class="catalog_item">
                                        <a href="/cat/id/{$c.id}">
                                        	<div class="catalog_item_meta">
                                                <ul>
                                                    <li><span class="cim_sell">Распродажа</span></li>
                                                    {if $c.action=="yes"}
                                                    <li><span class="cim_action">Акция</span></li>
                                                	{/if}
                                                    {if $c.novice=="yes"}
                                                    <li><span class="cim_new">Новинка</span></li>
                                                	{/if}
                                                </ul>
                                            </div>

                                            <div class="catalog_image">
                                                <img src="{$c.image|replace:'[dir]':'medium'}">
                                            </div>
                                            <div class="catalog_item_name">{$c.title}</div>
                                        </a>

                                        <div class="catalog_item_manuf">
                                            <a href="/cat/{$collection_param[$c.id].factory_url}">{$collection_param[$c.id].factory_title}</a> / <a href="/cat/country/{$collection_param[$c.id].country_url}">{$collection_param[$c.id].country_title}</a>
                                        </div>
                                        <div class="catalog_item_price">
                                            <span>От {$c.price} Р</span>
                                            <i></i>
                                        </div>
                                    </div>
                                </div>
                                
                                {php} if($i % 4 == 0){ {/php}
                                
                                </div>
                            	<div class="row row_catalog_front">

								{php} } $i++; {/php}	  								
							
					 
                                
{/foreach}


</div>




</div>



{php}
if($i>=33){
{/php}
<div class="moreBtns">
   <a class="more" href="javascript:void(0)" data-number="{$collection_next_number}" onclick="search_collections_more();">Показать ещё</a>
</div>
{php}
}
{/php}

</div>
</div>
</div>

