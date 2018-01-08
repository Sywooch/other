	
<div class="widget widget_filters">
                    <div class="filter_container">
                        <a class="filter_container_button" role="button" data-toggle="collapse" href="#collapsePrice" aria-expanded="true">Цена<span></span></a>
                        <div class="collapse in" id="collapsePrice" aria-expanded="true">
                          <div class="filter_container_items">
                                <div class="price_container clearfix">
                                    <span class="ot">От</span>
                                    <input type="text" id="price1" data-value="{$collections_min_price}">
                                    <span class="do">До</span>
                                    <input type="text" id="price2" data-value="{$collections_max_price}">
                                </div>
                                 
                                <div class="price_container clearfix">
                                    <div id="slider-range"></div>
                                </div>
									

                                <div class="filter_country_container" id="countries">
                                    <div class="filter_link">
                                        <a href="#">Страна и производитель</a>
                                    </div>
                                    
									{php} if(isset($this->page->factory['id'])){ {/php}
                                    
                                    
                                    
                                    
                                    {php} $count=1; {/php}
                                    
                                    
                                    
                                    <div class="dropdown" style="top:40px;">
                                    
                                    	        
                                    	<div class="row">
                                         
                                        	<div class="col-md-5">
                                            
                                            	
                                                	
                                                    
                                                    {foreach from=$countries1 item=i}
                                                    <div class="btn-group filter_container_types" data-toggle="buttons">
                                                 		 
                                                         <label class="btn btn-primary types_filter 
                                                         country_button">
                                                         <input type="checkbox" autocomplete="off">
                                                         <strong>{$i.import_title}</strong>
                                                         <img src="{$i.flag|replace:'[dir]':'original'}"
                                                          class="filter_country_container-country_img" alt="Es">
                                                         </label>
                                                    
                                                    
                                                    
                                                    {foreach from=$fabrics2 item=f}
                                                    {if $i.id == $f.country_id}
                                                    <label class="btn btn-primary types_filter 
                                                    {if $factory.id==$f.id} active {/if} " data-id="{$f.id}">
                                                    	<input type="checkbox" autocomplete="off">
                                                    	<span>{$f.title}</span>
                                                  	</label>
                                                    {/if}
                                                    {/foreach}
                                      
                                       				</div>
                                                    
                                                    
                                                                    
                                                    {php} if(($count+2)==(count($this->page->countries1)/2)){ {/php}
                                                    </div>
                                                    <div class="filter_container_types_sepp visible-xs visible-sm"></div>
                                                    
                                                    <div class="col-md-7">
                                                    {php} } {/php}
                                                    {php} $count++; {/php}
                                                    
                                                    
                                                    
                                                    {/foreach}
                                                   
                                                
                                                
                                            </div>
                                        
                                        </div> 
                                        
                                        <div class="product_sell">
                                          <a>Применить</a>
                                        </div>
                                        <button type="button" class="close-sm"></button>
                                        
                                        
                                    </div> 
                                    
                                    {php} }else if(strpos($_SERVER['REQUEST_URI'], "cat/type")!=false){ {/php}
                                 
                                    
                                    {php} $count=1; {/php}
                                    
                                    <div class="dropdown" style="top:40px;">
                                    
                                    	        
                                    	<div class="row">
                                         
                                        	<div class="col-md-5">
                                            
                                            	
                                                	
                                                    
                                                    {foreach from=$countries1 item=i}
                                                    <div class="btn-group filter_container_types" data-toggle="buttons">
                                                 
                                                         <label class="btn btn-primary types_filter  country_button">
                                                         <input type="checkbox" autocomplete="off">
                                                         <strong>{$i.import_title}</strong>
                                                         <img src="{$i.flag|replace:'[dir]':'original'}"
                                                          class="filter_country_container-country_img" alt="Es">
                                                         </label>
                                                    
                                                    
                                                    
                                                    {foreach from=$fabrics1 item=f}
                                                    {if $i.id == $f.country_id}
                                                    <label class="btn btn-primary types_filter " data-id="{$f.id}">
                                                    	<input type="checkbox" autocomplete="off">
                                                    	<span>{$f.title}</span>
                                                  	</label>
                                                    {/if}
                                                    {/foreach}
                                      
                                       				</div>
                                                    
                                                    
                                                                    
                                                    {php} if(($count+2)==(count($this->page->countries1)/2)){ {/php}
                                                    </div>
                                                    <div class="filter_container_types_sepp visible-xs visible-sm"></div>
                                                    
                                                    <div class="col-md-7">
                                                    {php} } {/php}
                                                    {php} $count++; {/php}
                                                    
                                                    
                                                    
                                                    {/foreach}
                                                   
                                                
                                                
                                            </div>
                                        
                                        </div> 
                                        
                                        <div class="product_sell">
                                          <a>Применить</a>
                                        </div>
                                        <button type="button" class="close-sm"></button>
                                        
                                        
                                    </div> 
                                   
                                    
                                    {php} }else{ {/php}
                                 
                                    
                                    {php} $count=1; {/php}
                                    
                                    
                                    
                                    <div class="dropdown" style="top:40px;">
                                    
                                    	        
                                    	<div class="row">
                                         
                                        	<div class="col-md-5">
                                            
                                            	
                                                	
                                                    
                                                    {foreach from=$countries1 item=i}
                                                    <div class="btn-group filter_container_types" data-toggle="buttons">
                                                 		 
                                                         <label class="btn btn-primary types_filter 
                                                         {if $country.id==$i.id} active {/if} country_button">
                                                         <input type="checkbox" autocomplete="off">
                                                         <strong>{$i.import_title}</strong>
                                                         <img src="{$i.flag|replace:'[dir]':'original'}"
                                                          class="filter_country_container-country_img" alt="Es">
                                                         </label>
                                                    
                                                    
                                                    
                                                    {foreach from=$fabrics2 item=f}
                                                    {if $i.id == $f.country_id}
                                                    <label class="btn btn-primary types_filter 
                                                    {if $country.id==$i.id} active {/if} " data-id="{$f.id}">
                                                    	<input type="checkbox" autocomplete="off">
                                                    	<span>{$f.title}</span>
                                                  	</label>
                                                    {/if}
                                                    {/foreach}
                                      
                                       				</div>
                                                    
                                                    
                                                                    
                                                    {php} if(($count+2)==(count($this->page->countries1)/2)){ {/php}
                                                    </div>
                                                    <div class="filter_container_types_sepp visible-xs visible-sm"></div>
                                                    
                                                    <div class="col-md-7">
                                                    {php} } {/php}
                                                    {php} $count++; {/php}
                                                    
                                                    
                                                    
                                                    {/foreach}
                                                   
                                                
                                                
                                            </div>
                                        
                                        </div> 
                                        
                                        <div class="product_sell">
                                          <a>Применить</a>
                                        </div>
                                        <button type="button" class="close-sm"></button>
                                        
                                        
                                    </div> 
                                    
                                    
                                    
                                    
                                    {php} } {/php}
                                    
                                </div>
                                <div class="filter_country_container" id="sizes" style="padding-top:0px;">
                                    <div class="filter_link">
                                        <a href="#">Размер</a>
                                    </div>


									<div class="dropdown active" style="width:200%; top:30px; height:500px;">
                                    	<div class="scroll_block" style="overflow:auto; width:100%; height:100%;">
                                        <div class="col-md-6">
                                        <div class="btn-group filter_container_types" data-toggle="buttons">
										  {php} $cnt=1; {/php}
                                         
                                          {foreach from=$based_sizes item=s}
                                          <label class="btn btn-primary types_filter" data-id="{$s.id}">
                                            <input type="checkbox" autocomplete="off">
                                            <span>{$s.title}</span>
                                          </label>
                                          
                                          {php}
                                         // echo $cnt." - ".(count($this->page->based_sizes)/2);
                                          if( $cnt == round(count($this->page->based_sizes)/2) ){                                           
                                          {/php}
                                          </div>
                                          </div>
                                          
                                          <div class="col-md-6">
                                          <div class="btn-group filter_container_types" data-toggle="buttons">
                                          
                                          {php}
                                          }
                                          {/php}
                                          {php} $cnt++; {/php}
                                          
                                          {/foreach}

                                        </div>
                                        </div>


                                        <div class="product_sell" style="clear:both;">
                                            <a>Применить</a>
                                        </div>
                                        </div>
                                        <button type="button" class="close-sm" ></button>
                                    </div>

									
                                    
                                    
                                    
                                    
                                   
                                </div>
                          </div>
                        </div>
                    </div>
                    
                    {php}
                    //echo "<pre>";
                   // print_r($this);
                   // echo "</pre>";
                    {/php}
                    
                    
                    <div class="filter_container">
                        <a class="filter_container_button collapsed" role="button" data-toggle="collapse" href="#collapseFunctions" aria-expanded="false">По назначению<span></span></a>
                        <div class="collapse" id="collapseFunctions">
                          <div class="filter_container_items">

                            <div class="btn-group filter_container_types" data-toggle="buttons">
							{php} 
                            //if(strpos($_SERVER['REQUEST_URI'], "cat/type")!=false){
                            //    	$url_m=explode("/",trim($_SERVER['REQUEST_URI'], "/"));
							//		$purpose_id= $url_m[count($url_m)-3]; 
            				//}
            				{/php}                    
                            
                            
                            
                            {php} $i=1; {/php}
							{foreach from=$purposes item=ee}	
                              <label class="btn btn-primary types_filter {php} if(strpos($_SERVER['REQUEST_URI'], 'cat/type/purpose')!=false){ {/php} {if $purpose_id==$ee.id} active {/if} {php} } {/php} ">
                                
                                <input type="checkbox" autocomplete="off" data-id="{$ee.id}" 
                                                    class="purposes_checkbox"
                                					
                                					{php} if(strpos($_SERVER['REQUEST_URI'], 'cat/type/purpose')!=false){ {/php} {if $purpose_id==$ee.id} checked {/if} {php} } {/php}
                                                    >
                                <span>{$ee.detail_title}<i>{php} echo $p_count[$i]; {/php}</i></span>
                              </label>
                             {php} $i++; {/php}
                             {/foreach} 
                              
                            

                            </div>

                          </div>
                        </div>
                    </div>
                    <div class="filter_container">
                        <a class="filter_container_button collapsed" role="button" data-toggle="collapse" href="#collapseMaterias" aria-expanded="false">По материалу<span></span></a>
                        <div class="collapse" id="collapseMaterias">
                          <div class="filter_container_items">

                            <div class="btn-group filter_container_types" data-toggle="buttons">



							{php} $i=1; {/php}
                        
							{foreach from=$materials item=ee}
                              <label class="btn btn-primary types_filter {php} if(strpos($_SERVER['REQUEST_URI'], 'cat/type/material')!=false){ {/php}{if $purpose_id==$ee.id} active {/if} {php} } {/php}">
                                <input type="checkbox" autocomplete="off" data-id="{$ee.id}" 
                                                    class="materials_checkbox"
                                                    {php} if(strpos($_SERVER['REQUEST_URI'], 'cat/type/material')!=false){ {/php}{if $purpose_id==$ee.id} checked {/if} {php} } {/php}
                                                    >
                                <span>{$ee.detail_title}<i>{php} echo $p_count[$i] {/php}</i></span>
                              </label>
                            {php} $i++; {/php}
                             {/foreach}
                            
                            </div>

                          </div>
                        </div>
                    </div>
                    <div class="filter_container">
                        <a class="filter_container_button collapsed" role="button" data-toggle="collapse" href="#collapseType" aria-expanded="false">Тип поверхности<span></span><i></i></a>
                        <div class="collapse" id="collapseType">
                          <div class="filter_container_items">

                            <div class="btn-group filter_container_colors" data-toggle="buttons">


							{foreach from=$surfaces item=s}	
                              <label class="btn btn-primary color_filter_1 ch_surface" data-surface="{$s.id}"
                                                  style="background-image:url({$s.image|replace:'[dir]':'original'});">
                                <input type="checkbox" autocomplete="off">{$s.detail_title}
                              </label>
							{/foreach}	
						

                            </div>

                          </div>
                        </div>
                    </div>

                    <div class="filter_container">
                        <a class="filter_container_button collapsed" role="button" data-toggle="collapse" href="#collapseStyle" aria-expanded="false">Стиль (рисунок)<span></span><i></i></a>
                        <div class="collapse" id="collapseStyle">
                          <div class="filter_container_items">

                            <div class="btn-group filter_container_colors" data-toggle="buttons">


								{foreach from=$styles item=s}	
                              <label class="btn btn-primary color_filter_1 ch_style" data-style="{$s.id}"
                                                  style="background-image:url({$s.image|replace:'[dir]':'original'});">
                                <input type="checkbox" autocomplete="off">{$s.detail_title}
                              </label>
								{/foreach}
                                
                                
                                

                            </div>

                          </div>
                        </div>
                    </div>

                    <div class="filter_container">
                        <a class="filter_container_button collapsed" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false">Цвет<span></span></a>
                        <div class="collapse" id="collapseExample">
                          <div class="filter_container_items">

                            <div class="btn-group filter_container_colors" data-toggle="buttons">


							{foreach from=$colors item=s}
                              <label class="btn btn-primary color_filter_1 ch_color" data-color="{$s.id}" 
                                                  style="background-color:{$s.color}; background-image:none;">
                                <input type="checkbox" autocomplete="off">{$s.title}
                              </label>
							{/foreach}
                            
                            

                            </div>

                          </div>
                        </div>
                    </div>
                    <div class="filter_system_links">
                        <a href="#" class="filter_system_links_clear">Очистить</a>
                    </div>

                </div>
                
                