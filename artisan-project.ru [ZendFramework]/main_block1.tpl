


<div class="front_content_continer">
    <div class="container">
        <div class="row">

            <div class="col-sm-12">

                <div class="tabbable" id="tabs-436008">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab1" data-toggle="tab">Распродажа</a>
                        </li>
                        <li>
                            <a href="#tab2" data-toggle="tab">Новинки</a>
                        </li>
                        <li>
                            <a href="#tab3" data-toggle="tab">Акции</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            
                            
                            
                            
                            
                            
                            
                            <div class="row row_catalog_front tmp0">
                            
                            	
                                {php} $i=1; {/php}
                                {php} 
                                	unset($f_count); 
                                	$f_tmp=explode(",",$this->page->list_factories); 
                                	for($i2=0;$i2<count($f_tmp);$i2++){
                            			$f_tmp2=explode(":",$f_tmp[$i2]);
                             			$f_count[$f_tmp2[0]]=$f_tmp2[1];
                                		//echo $f_tmp2[0]." -- ".$f_tmp2[1]."<br>";
                                        
                                        //$p_count[]=$m_tmp2[1];
                              			//  echo $m_tmp2[1]."--";
                            		}
                                {/php}
                                
                                
                                
                                {php}
                                //echo "<pre>";
                                //print_r($this->page);
                                //echo "</pre>";
                                {/php}
                                
                                
                                
                                {foreach from=$collections_sale item=c}
                            
								
								
							
                                <div class="col-sm-6 col-md-3">
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
                                            <span>От {$collection_price[$c.id]} Р</span>
                                            <i></i>
                                        </div>
                                    </div>
                                </div>
                                
                                {php} if($i % 4 == 0){ {/php}
                                
                                </div>
                            	<div class="row row_catalog_front">

								{php} } $i++; {/php}	                                
                                
                                {php} if($i>8){ break; } {/php}
                                {/foreach}
                                
                                
                                
                             
                                <!--
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="/cat/id/1">
                                            <div class="catalog_item_meta">
                                                <ul>
                                                    <li><span class="cim_sell">Распродажа</span></li>
                                                </ul>
                                            </div>

                                            <div class="catalog_image">
                                                <img src="/public/site1/images_tmp/image2.jpg">
                                            </div>
                                            <div class="catalog_item_name">Aparici</div>
                                        </a>
                                        
                                        <div class="catalog_item_manuf">
                                            <a href="#">Agate</a> / <a href="#">Испания</a>
                                        </div>
                                        <div class="catalog_item_price">
                                            <span>От 4 379 Р</span>
                                            <i>5 150 р</i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="/cat/id/1">
                                            <div class="catalog_item_meta">
                                                <ul>
                                                	<li><span class="cim_sell">Распродажа</span></li>
                                                </ul>
                                            </div>
                                            <div class="catalog_image">
                                                <img src="/public/site1/images_tmp/image3.jpg">
                                            </div>
                                            <div class="catalog_item_name">Aparici</div>
                                        </a>
                                        
                                        <div class="catalog_item_manuf">
                                            <a href="#">Agate</a> / <a href="#">Испания</a>
                                        </div>
                                        <div class="catalog_item_price">
                                            <span>От 4 379 Р</span>
                                            <i>5 150 р</i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="/cat/id/1">
                                            <div class="catalog_item_meta">
                                                <ul>
                                                	<li><span class="cim_sell">Распродажа</span></li>	
                                                    <li><span class="cim_action">Акция</span></li>
                                                </ul>
                                            </div>
                                            <div class="catalog_image">
                                                <img src="/public/site1/images_tmp/image4.jpg">
                                            </div>
                                            <div class="catalog_item_name">Aparici</div>
                                        </a>
                                        
                                        <div class="catalog_item_manuf">
                                            <a href="#">Agate</a> / <a href="#">Испания</a>
                                        </div>
                                        <div class="catalog_item_price">
                                            <span>От 4 379 Р</span>
                                            <i>5 150 р</i>
                                        </div>
                                    </div>
                                </div>-->
                            </div>
<!--

                            <div class="row row_catalog_front">
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="/cat/id/1">
                                        	<div class="catalog_item_meta">
                                                <ul>
                                                    <li><span class="cim_sell">Распродажа</span></li>
                                                </ul>
                                            </div>

                                            <div class="catalog_image">
                                                <img src="/public/site1/images_tmp/image5.jpg">
                                            </div>
                                            <div class="catalog_item_name">Aparici</div>
                                        </a>

                                        <div class="catalog_item_manuf">
                                            <a href="#">Agate</a> / <a href="#">Испания</a>
                                        </div>
                                        <div class="catalog_item_price">
                                            <span>От 4 379 Р</span>
                                            <i>5 150 р</i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="/cat/id/1">
                                        	<div class="catalog_item_meta">
                                                <ul>
                                                    <li><span class="cim_sell">Распродажа</span></li>
                                                </ul>
                                            </div>

                                            <div class="catalog_image">
                                                <img src="/public/site1/images_tmp/image6.jpg">
                                            </div>
                                            <div class="catalog_item_name">Aparici</div>
                                        </a>
                                        
                                        <div class="catalog_item_manuf">
                                            <a href="#">Agate</a> / <a href="#">Испания</a>
                                        </div>
                                        <div class="catalog_item_price">
                                            <span>От 4 379 Р</span>
                                            <i>5 150 р</i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="/cat/id/1">
                                        	<div class="catalog_item_meta">
                                                <ul>
                                                    <li><span class="cim_sell">Распродажа</span></li>
                                                </ul>
                                            </div>

                                            <div class="catalog_image">
                                                <img src="/public/site1/images_tmp/image7.jpg">
                                            </div>
                                            <div class="catalog_item_name">Aparici</div>
                                        </a>
                                        
                                        <div class="catalog_item_manuf">
                                            <a href="#">Agate</a> / <a href="#">Испания</a>
                                        </div>
                                        <div class="catalog_item_price">
                                            <span>От 4 379 Р</span>
                                            <i>5 150 р</i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="/cat/id/1">
                                            <div class="catalog_item_meta">
                                                <ul>
                                                    <li><span class="cim_sell">Распродажа</span></li>
                                                    <li><span class="cim_new">Новинка</span></li>
                                                    <li><span class="cim_action">Акция</span></li>
                                                </ul>
                                            </div>
                                            <div class="catalog_image">
                                                <img src="/public/site1/images_tmp/image8.jpg">
                                            </div>
                                            <div class="catalog_item_name">Aparici</div>
                                        </a>
                                        
                                        <div class="catalog_item_manuf">
                                            <a href="#">Agate</a> / <a href="#">Испания</a>
                                        </div>
                                        <div class="catalog_item_price">
                                            <span>От 4 379 Р</span>
                                            <i>5 150 р</i>
                                        </div>
                                    </div>
                                </div>
                            </div>-->

                            <div class="catalog_meta_container">
                                <div class="row">
                                    <div class="col-sm-6 text-left">
                                        <span class="reccomend">На товарах указаны рекомендованные розничные цены</span>
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <div class="view_all_catalog tmp1">
                                            <a href="/cat/sale">Все предложения</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                                
                            
                            
                            
                            
                            
                            
                            <div class="row row_catalog_front tmp0">
                            
                            	
                                {php} $i=1; {/php}
                                {php} 
                                	unset($f_count); 
                                	$f_tmp=explode(",",$this->page->list_factories); 
                                	for($i2=0;$i2<count($f_tmp);$i2++){
                            			$f_tmp2=explode(":",$f_tmp[$i2]);
                             			$f_count[$f_tmp2[0]]=$f_tmp2[1];
                                		//echo $f_tmp2[0]." -- ".$f_tmp2[1]."<br>";
                                        
                                        //$p_count[]=$m_tmp2[1];
                              			//  echo $m_tmp2[1]."--";
                            		}
                                {/php}
                                {foreach from=$collections_new item=c}
                            
								
							
							
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="/cat/id/{$c.id}">
                                        	<div class="catalog_item_meta">
                                                <ul>	
                                                	{if $c.sale=="yes"}
                                                    <li><span class="cim_sell">Распродажа</span></li>
                                                    {/if}
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
                                            <span>От {$collection_price[$c.id]} Р</span>
                                            <i></i>
                                        </div>
                                    </div>
                                </div>
                                
                                {php} if($i % 4 == 0){ {/php}
                                
                                </div>
                            	<div class="row row_catalog_front">

								{php} } $i++; {/php}	                                
                                
                                {php} if($i>8){ break; } {/php}
                                {/foreach}
                                
                                
                                
                             
                                <!--
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="/cat/id/1">
                                            <div class="catalog_item_meta">
                                                <ul>
                                                    <li><span class="cim_sell">Распродажа</span></li>
                                                </ul>
                                            </div>

                                            <div class="catalog_image">
                                                <img src="/public/site1/images_tmp/image2.jpg">
                                            </div>
                                            <div class="catalog_item_name">Aparici</div>
                                        </a>
                                        
                                        <div class="catalog_item_manuf">
                                            <a href="#">Agate</a> / <a href="#">Испания</a>
                                        </div>
                                        <div class="catalog_item_price">
                                            <span>От 4 379 Р</span>
                                            <i>5 150 р</i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="/cat/id/1">
                                            <div class="catalog_item_meta">
                                                <ul>
                                                	<li><span class="cim_sell">Распродажа</span></li>
                                                </ul>
                                            </div>
                                            <div class="catalog_image">
                                                <img src="/public/site1/images_tmp/image3.jpg">
                                            </div>
                                            <div class="catalog_item_name">Aparici</div>
                                        </a>
                                        
                                        <div class="catalog_item_manuf">
                                            <a href="#">Agate</a> / <a href="#">Испания</a>
                                        </div>
                                        <div class="catalog_item_price">
                                            <span>От 4 379 Р</span>
                                            <i>5 150 р</i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="/cat/id/1">
                                            <div class="catalog_item_meta">
                                                <ul>
                                                	<li><span class="cim_sell">Распродажа</span></li>	
                                                    <li><span class="cim_action">Акция</span></li>
                                                </ul>
                                            </div>
                                            <div class="catalog_image">
                                                <img src="/public/site1/images_tmp/image4.jpg">
                                            </div>
                                            <div class="catalog_item_name">Aparici</div>
                                        </a>
                                        
                                        <div class="catalog_item_manuf">
                                            <a href="#">Agate</a> / <a href="#">Испания</a>
                                        </div>
                                        <div class="catalog_item_price">
                                            <span>От 4 379 Р</span>
                                            <i>5 150 р</i>
                                        </div>
                                    </div>
                                </div>-->
                            </div>

                            <div class="catalog_meta_container">
                                <div class="row">
                                    <div class="col-sm-6 text-left">
                                        <span class="reccomend">На товарах указаны рекомендованные розничные цены</span>
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <div class="view_all_catalog tmp1">
                                            <a href="/cat/novice">Все новинки</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="tab-pane" id="tab3">
                            
                            
                            
                            <div class="row row_catalog_front tmp0">
                            
                            	
                                {php} $i=1; {/php}
                                {php} 
                                	unset($f_count); 
                                	$f_tmp=explode(",",$this->page->list_factories); 
                                	for($i2=0;$i2<count($f_tmp);$i2++){
                            			$f_tmp2=explode(":",$f_tmp[$i2]);
                             			$f_count[$f_tmp2[0]]=$f_tmp2[1];
                                		//echo $f_tmp2[0]." -- ".$f_tmp2[1]."<br>";
                                        
                                        //$p_count[]=$m_tmp2[1];
                              			//  echo $m_tmp2[1]."--";
                            		}
                                {/php}
                                {foreach from=$collections_action item=c}
                            
								
							
							
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="/cat/id/{$c.id}">
                                        	<div class="catalog_item_meta">
                                                <ul>	
                                                	{if $c.sale=="yes"}
                                                    <li><span class="cim_sell">Распродажа</span></li>
                                                    {/if}
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
                                            <span>От {$collection_price[$c.id]} Р</span>
                                            <i></i>
                                        </div>
                                    </div>
                                </div>
                                
                                {php} if($i % 4 == 0){ {/php}
                                
                                </div>
                            	<div class="row row_catalog_front">

								{php} } $i++; {/php}	                                
                                
                                {php} if($i>8){ break; } {/php}
                                {/foreach}
                                
                                
                                
                             
                                <!--
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="/cat/id/1">
                                            <div class="catalog_item_meta">
                                                <ul>
                                                    <li><span class="cim_sell">Распродажа</span></li>
                                                </ul>
                                            </div>

                                            <div class="catalog_image">
                                                <img src="/public/site1/images_tmp/image2.jpg">
                                            </div>
                                            <div class="catalog_item_name">Aparici</div>
                                        </a>
                                        
                                        <div class="catalog_item_manuf">
                                            <a href="#">Agate</a> / <a href="#">Испания</a>
                                        </div>
                                        <div class="catalog_item_price">
                                            <span>От 4 379 Р</span>
                                            <i>5 150 р</i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="/cat/id/1">
                                            <div class="catalog_item_meta">
                                                <ul>
                                                	<li><span class="cim_sell">Распродажа</span></li>
                                                </ul>
                                            </div>
                                            <div class="catalog_image">
                                                <img src="/public/site1/images_tmp/image3.jpg">
                                            </div>
                                            <div class="catalog_item_name">Aparici</div>
                                        </a>
                                        
                                        <div class="catalog_item_manuf">
                                            <a href="#">Agate</a> / <a href="#">Испания</a>
                                        </div>
                                        <div class="catalog_item_price">
                                            <span>От 4 379 Р</span>
                                            <i>5 150 р</i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="/cat/id/1">
                                            <div class="catalog_item_meta">
                                                <ul>
                                                	<li><span class="cim_sell">Распродажа</span></li>	
                                                    <li><span class="cim_action">Акция</span></li>
                                                </ul>
                                            </div>
                                            <div class="catalog_image">
                                                <img src="/public/site1/images_tmp/image4.jpg">
                                            </div>
                                            <div class="catalog_item_name">Aparici</div>
                                        </a>
                                        
                                        <div class="catalog_item_manuf">
                                            <a href="#">Agate</a> / <a href="#">Испания</a>
                                        </div>
                                        <div class="catalog_item_price">
                                            <span>От 4 379 Р</span>
                                            <i>5 150 р</i>
                                        </div>
                                    </div>
                                </div>-->
                            </div>
                            <div class="catalog_meta_container">
                                <div class="row">
                                    <div class="col-sm-6 text-left">
                                        <span class="reccomend">На товарах указаны рекомендованные розничные цены</span>
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <div class="view_all_catalog tmp1">
                                            <a href="/cat/action">Все акции</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
