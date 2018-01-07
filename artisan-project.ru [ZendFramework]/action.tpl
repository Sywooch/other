<div class="catalog_full_container catalog_fix_container">
<div class="row row_catalog_front">

						{php} $i=0; {/php}
						{foreach from=$action item=c}
                        <div class="col-sm-6 col-md-4">
                            <div class="catalog_item">
                                <a href="/cat/id/{$c.id}">
                                    <div class="catalog_image">
                                        <img src="{$c.image|replace:'[dir]':'original'}{if $c.image==""} http://мебельплюс.бел/images/stories/virtuemart/product/resized/no_photo_640x480.png{/if}">
                                    </div>
                                    <div class="catalog_item_name">{$c.title} {if $c.title==""} Без названия {/if}</div>
                                </a>

                                <div class="catalog_item_manuf">
                                    <a href="/cat/{$action_factories_link[$c.id]}">{$action_factories[$c.id]}</a> / 
                                    <a href="/cat/country/{$action_countries_link[$c.id]}">{$action_countries[$c.id]}</a>
                                </div>
                                <div class="catalog_item_price">
                                    <span>От {$action_prices[$c.id][0]} Р</span>
                                    <i></i>
                                </div>
                            </div>
                        </div>
                        
                        
						{php} $i++; 
                        if($i%3==0){ {/php} <div style="clear:both;"></div> {php} }
                        {/php}
                       	{/foreach}
                       
                       
                       
                        
                    </div>
                    
                       
                    
                    
                     {php}
                    if(strpos($_SERVER['REQUEST_URI'],"page/all") == false){
                    if(strpos($_SERVER['REQUEST_URI'],"page") != false){
						$m=explode("/",trim($_SERVER['REQUEST_URI'],"/"));
						$m=$m[count($m)-1];
					}else{
						$m=1;
					}
                    $this->_tpl_vars['paging']['curr_page']=$m;
                    }
                    
                    {/php}
                    
                    
                    <div class="row row_catalog_front pagination">  
   {loadview name=cat_paging}      
   </div>
                   
                    
                    
                    </div>