

					<div class="load_fon" style="display: none; width:calc(100% - 40px);">
						<img src="/public/site1/images/712.gif">
						</div>

                    <div class="row row_catalog_front">
                 		
                    	{foreach from=$collections item=coll name=collections}
                        <div class="col-sm-6 col-md-4">
                            <div class="catalog_item">
                                <a href="/cat/id/{$coll.id}">
                                	<div class="catalog_item_meta">
                                      <ul>
                                	{if $coll.action == 'yes'}
										<li><span class="cim_action">Акция</span></li>
									{/if}
									{if $coll.sale == 'yes'}
										<li><span class="cim_sell">Распродажа</span></li>
									{elseif $coll.novice == 'yes'}
										<li><span class="cim_new">Новинка</span></li>
									{/if}
                                    
                                    
                                    		
                                      </ul>
                                    </div>
                                    
                                    
                                    <div class="catalog_image">
                                        <img src="{$coll.image|replace:'[dir]':'original'}">
                                    </div>
                                    <div class="catalog_item_name">{$coll.title}</div>
                                </a>

                                <div class="catalog_item_manuf">
                                    <a href="#">{$factory.title}</a> / <a href="/cat/country/{$country.url}">{$country.title}</a>
                                </div>
                                <div class="catalog_item_price tmp3">
                                    <span>От {$coll.price} Р</span>
                                    <i></i>
                                </div>
                            </div>
                        </div>
                        {if $smarty.foreach.collections.iteration%3 == 0} <div style="clear:both;"></div> {/if}
                        {/foreach}
                        
                        
                        
                        
                    </div>
                    
                    
                    

                    <div class="catalog_meta_container">
                        <span class="reccomend">На товарах указаны рекомендованные розничные цены</span>
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
                   


       













