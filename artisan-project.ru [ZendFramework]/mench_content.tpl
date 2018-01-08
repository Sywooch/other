<div class="tabbable" id="tabs-436008">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab1" data-toggle="tab" aria-expanded="true">По типу</a>
                        </li>
                        <li class="">
                            <a href="#tab2" data-toggle="tab" aria-expanded="false">По фабрикам</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            
                            <div class="row row_catalog_merch">
                            
                            
                            	{foreach from=$merch_types item=m}
                            
                                <div class="col-xs-12 col-xs-4 col-sm-12 col-md-4">
                                    <div class="catalog_item">
                                        <a href="/merchtype/{$m.id}">
                                            <div class="catalog_image">
                                                <img src="{$m.image|replace:'[dir]':'original'}">
                                            </div>
                                            <div class="catalog_item_merch"><span>{$m.title}</span></div>
                                        </a>
                                    </div>
                                </div>
                                
                                {/foreach}
                                
                                
                                
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <div class="row row_catalog_merch">
                            
                            
                            	<div class="tabpane_country merch">
                                <div class="row"  style="margin-right:0px; margin-left:0px;">
                                    
                                    
                                    
                                    
                                    
                                    
                                    {foreach from=$countries1 item=i}
                                   <div class="col-sm-3">

	                                    <div class="tabpane_country_block">
                                        	
                                            <div class="tabpane_country_flag tabpane_country_es" 
                                            style="background-image:url({$i.flag|replace:'[dir]':'original'}); 
                                            background-size:60px;">
                                                <span>{$i.import_title}</span>
                                            </div>
                                            <ul>
                                            
                                    
                                    
                                    
                                    
                                            {php} $i2=0; $i3="";{/php}
                    						{foreach from=$fabrics1 item=ee}
                                    		
                                            
                                            	{if $i.id == $ee.country_id}
                                    
                                                <li><a href="/merchfactory/{$ee.url|default:$ee.id}/{if $act_filter}{$act_filter}/yes{/if}">{$ee.title}</a></li>
                                                
                                    			{/if}        
                                    
                    					
                    						
                    						{php} $i2++; {/php}
                    						{/foreach}
                                    			
                                                
                                            {php}
                                            
                                            {/php}    
                                                
                                                
                                    		</ul>
                                        </div>

                                    </div>
                                    
                                    {/foreach}
                                    
                                    
                                   
                                    
                                    
                                    
                                    
                                </div>
                            	</div>
                            
                            
                            
                            
                            
                            
                            
                            </div>
                            
                        </div>
                        <div class="tab-pane" id="tab3">
                            <div class="row row_catalog_front">
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="/cat/id/1">
                                            <div class="catalog_image">
                                                <img src="/public/site1/images_tmp/image1.jpg">
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
                                                    <li><span class="cim_new">Новинка</span></li>
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
                                </div>
                            </div>


                            <div class="row row_catalog_front">
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="/cat/id/1">
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
                            </div>

                            <div class="catalog_meta_container">
                                <div class="row">
                                    <div class="col-sm-6 text-left">
                                        <span class="reccomend">На товарах указаны рекомендованные розничные цены</span>
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <div class="view_all_catalog">
                                            <a href="#">Все предложения</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>