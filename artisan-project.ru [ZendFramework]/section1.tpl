<section class="innercat_content_continer tab_fix">
    <div class="container">
        <div class="row">

            <div class="col-sm-12">
                <div class="tabbable" id="tabs-436008">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tabc1" data-toggle="tab" aria-expanded="true">По назначению</a>
                        </li>
                        <li class="">
                            <a href="#tabc2" data-toggle="tab" aria-expanded="false">По материалу</a>
                        </li>
                        <li class="">
                            <a href="#tabc3" data-toggle="tab" aria-expanded="false">По странам</a>
                        </li>
                        <li>
                            <a href="#tabc4" data-toggle="tab" aria-expanded="false">Фильтр</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane tmp1" id="tabc1">
							<div class="row row_materials_front">
                        
                            {php} 
                            $m_tmp=explode(",",$this->page->purposes_count); 
                            for($i=0;$i<count($m_tmp);$i++){
                            	$m_tmp2=explode(":",$m_tmp[$i]);
                             	//$p_count[$m_tmp2[0]]=$m_tmp2[1];
                                $p_count[]=$m_tmp2[1];
                                
                            }		
                            {/php}
								
							{php} $i=1; {/php}
							{foreach from=$purposes item=ee}
								<div class="col-sm-6 col-md-3">
                                    <div class="catalog_item catalog_material">
                                        <a href="/cat/type/purpose/{$ee.id}">
                                        	
                                            <div class="catalog_image">
                                            	
                                                <img src="{$purposes_image[$ee.id]|replace:'[dir]':'original'}">
                                            </div>
                                        </a>
                                        <div class="border_container">
                                            <div class="catalog_material_item_name">
                                                <a href="/cat/type/purpose/{$ee.id}">{$ee.detail_title}</a>
                                            </div>
                                            <div class="catalog_material_item_more">
                                                <a href="/cat/type/purpose/{$ee.id}"><span>Все товары</span>{php} echo $p_count[$i] {/php}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                          
							{php} if ($i % 4 == 0) { {/php}
                            </div>
                            <div class="row row_materials_front">
                            {php} } $i++; {/php}
							  
							{/foreach}
                            
                      
							</div>
                           
                            

                        </div>
                        <div class="tab-pane" id="tabc2">
							<div class="row row_materials_front">
                        
                            {php}
                            unset($p_count); 
                            $m_tmp=explode(",",$this->page->materials_count); 
                            for($i=0;$i<count($m_tmp);$i++){
                            	$m_tmp2=explode(":",$m_tmp[$i]);
                             	//$p_count[$m_tmp2[0]]=$m_tmp2[1];
                                $p_count[]=$m_tmp2[1];
                              //  echo $m_tmp2[1]."--";
                            }		
                            {/php}
								
							{php} $i=1; {/php}
							{foreach from=$materials item=ee}
								<div class="col-sm-6 col-md-3">
                                    <div class="catalog_item catalog_material">
                                        <a href="/cat/type/material/{$ee.id}">
                                            <div class="catalog_image">
                                            	
                                                <img src="{$materials_image[$ee.id]|replace:'[dir]':'original'}">
                                            </div>
                                        </a>
                                        <div class="border_container">
                                            <div class="catalog_material_item_name">
                                                <a href="/cat/type/material/{$ee.id}">{$ee.detail_title}</a>
                                            </div>
                                            <div class="catalog_material_item_more">
                                                <a href="/cat/type/material/{$ee.id}"><span>Все товары</span>{php} echo $p_count[$i] {/php}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                          
							{php} if ($i % 4 == 0) { {/php}
                            </div>
                            <div class="row row_materials_front">
                            {php} } $i++; {/php}
							  
							{/foreach}
                            
                      
							</div>
                           
                            
                        </div>
                        <div class="tab-pane" id="tabc3"> 
                            <div class="tabpane_country">
                                <div class="row">
                                
                             		



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
                                    
                                                <li><a href="/cat/{$ee.url|default:$ee.id}/{if $act_filter}{$act_filter}/yes{/if}">{$ee.title}</a></li>
                                                
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
                        
                        <div class="tab-pane active visible" id="tabc4">  

                            <div class="tabpane_filtr"> 
                        	<div class="row">
                        		<div class="col-sm-3">
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
                                                        <div id="slider-range" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"><div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 3.06122%; width: 45.9184%;"></div><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 3.06122%;"></span><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 48.9796%;"></span></div>
                                                    </div>


                                                    <div class="filter_country_container" id="countries_container">
                                                        <div class="filter_link">
                                                            <a href="#">Страна и производитель</a>
                                                        </div>
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        {php} $count=1; {/php}
                                                        <div class="dropdown">
                                                            <div class="row">
                                                                
                                                                
                                                                
                                                                <div class="col-md-5">
                                                                  
                                                                    {foreach from=$countries1 item=i}
                                                                    {php} //echo $count." -- ".(count($this->page->countries1)/2); {/php}
                                                                    <div class="btn-group filter_container_types" data-toggle="buttons">
                                                                      <label class="btn btn-primary types_filter">
                                                                        <input type="checkbox" autocomplete="off">
                                                                        <strong>{$i.import_title}</strong>
                                                                        <img src="{$i.flag|replace:'[dir]':'original'}" class="filter_country_container-country_img" alt="Es">
                                                                      </label>
                                                                      
                                                                      
                                                                      
                                                                      {foreach from=$fabrics1 item=ee}
                                                                      
                                                                      	{if $i.id == $ee.country_id}
                                                						<label class="btn btn-primary types_filter" data-id="{$ee.id}">
                                                                        	<input type="checkbox" autocomplete="off" 
                                                                            id="fabric_{$ee.id}">
                                                                        	<span>{$ee.title}</span>
                                                                      	</label>
                                                						{/if}
                                                                      	
                                                                      {/foreach}
                                                                      
                                                                      
                                                                      
                                                                      
                                                                      
                                                                    </div>
                                                                    
                                                                    <div class="filter_container_types_sepp"></div>
                                                                    
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
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                    <!--   
                                                        
                                                        
													{foreach from=$fabrics1 item=f}
													<span class="tag label label-info">
                                                          <span>{$f.title}</span>
														  <span class="factory_id" style="display:none;">{$f.id}</span>
                                                          <a href="#"><i class="remove glyphicon glyphicon-remove-sign glyphicon-white"></i></a> 
                                                     </span>														
                                                     {/foreach}
                                                     -->   
                                                        
                                                        
                                                    </div>
                                                    <div class="filter_country_container" id="sizes_container">
                                                        <div class="filter_link">
                                                            <a href="#">Размер</a>
                                                        </div>
														
                                                        {php} $cnt=1; {/php}
                                                        <div class="dropdown active" style="width:400%; height:600px; ">
                                                        	<div class="scroll_block" 
                                                            style="width:100%; height:100%; overflow:auto; padding-top:20px;">
                                                        	<div style="float:left; width:130px;">
                                                            <div class="btn-group filter_container_types" data-toggle="buttons">
																
                                                              
                                                              {foreach from=$based_sizes item=s}  
                                                              <label class="btn btn-primary types_filter" data-id="{$s.id}">
                                                                <input type="checkbox" autocomplete="off" id="size_{$s.id}">
                                                                <span>{$s.title}</span>
                                                              </label>
                                                              {php}
                                                              if(($cnt % 20)==0){
                                                              {/php}
                                                              </div>
                                                              </div>
                                                              <div style="float:left; width:130px;">
                                                              <div class="btn-group filter_container_types" data-toggle="buttons">
															  {php}
                                                              }
                                                              {/php}
                                                              
                                                              {php} $cnt++; {/php}
                                                              {/foreach}
															  
                                                            </div>
                                                            </div>
                                                            <div style="clear:both;"></div>
                                                            <div class="product_sell">
                                                                <a>Применить</a>
                                                            </div>
                                                            </div>
                                                            
                                                            <button type="button" class="close-sm"></button>
                                                        </div>
                                                        
                                                        
                                                        
                                                        <!--
                                                        
                                                        {foreach from=$based_sizes item=s}
                                                        <span class="tag label label-info">
                                                          <span>{$s.title}</span>
                                                          <span class="based_size_id" style="display:none;">{$s.id}</span>
                                                          <a href="#"><i class="remove glyphicon glyphicon-remove-sign glyphicon-white"></i></a> 
                                                        </span>
                                                        {/foreach} 
                                                       
														-->
                                                        
                                                        
                                                        
                                                    </div>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                        
                        	
                            
                             
                                    <div class="col-sm-3">


                                        <div class="filter_container">
                                            <a class="filter_container_button collapsed" role="button" data-toggle="collapse" href="#collapseFunctions" aria-expanded="false">По назначению<span></span></a>
                                            <div class="collapse" id="collapseFunctions">
                                              <div class="filter_container_items">

                                                <div class="btn-group filter_container_types" data-toggle="buttons">
												  {php} $i=1; {/php}
												  {foreach from=$purposes item=ee}	
                                                  <label class="btn btn-primary types_filter">
                                                    <input type="checkbox" autocomplete="off" data-id="{$ee.id}" 
                                                    class="purposes_checkbox">
                                                    <span>{$ee.detail_title}<i>{php} echo $p_count[$i] {/php}</i></span>
                                                  </label>
                                                  {php} $i++; {/php}
                                                  {/foreach}
                                                  
                                                  

                                                </div>

                                              </div>
                                            </div>
                                        </div>



                                    </div>
                                    <div class="col-sm-3">


                                        <div class="filter_container">
                                            <a class="filter_container_button collapsed" role="button" data-toggle="collapse" href="#collapseMaterias" aria-expanded="false">По материалу<span></span></a>
                                            <div class="collapse" id="collapseMaterias">
                                              <div class="filter_container_items">

                                                <div class="btn-group filter_container_types" data-toggle="buttons">

                                                  
                                                  {php} $i=1; {/php}
												  {foreach from=$materials item=ee}
                                                  <label class="btn btn-primary types_filter">
                                                    <input type="checkbox" autocomplete="off" data-id="{$ee.id}" 
                                                    class="materials_checkbox">
                                                    <span>{$ee.detail_title}<i>{php} echo $p_count[$i] {/php}</i></span>
                                                  </label>
                                                  {php} $i++; {/php}
                                                  {/foreach}
                                                  
                                                 
                                                </div>

                                              </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-sm-3">

                                        <div class="filter_container">
                                            <a class="filter_container_button collapsed" role="button" data-toggle="collapse" href="#collapseType" aria-expanded="false">Тип поверхности<span></span><i></i></a>
                                            <div class="collapse" id="collapseType">
                                              <div class="filter_container_items">

                                                <div class="btn-group filter_container_colors" data-toggle="buttons">
												
                                                {foreach from=$surfaces item=s}													
                                                  <label class="btn btn-primary color_filter_1 ch_surface" data-surface="{$s.id}"
                                                  style="background-image:url({$s.image|replace:'[dir]':'original'});">
                                                    <input type="checkbox" autocomplete="off" 
                                                    >
                                                    <span class="name_container">
                                                    	<span class="name">{$s.detail_title}</span>
                                                    </span>    
                                                    <div class="fon_active"></div>
                                                    <div class="fon_label"></div>
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
                                                    <input type="checkbox" autocomplete="off"
                                                    >
                                                    <span class="name_container">
                                                    	<span class="name">{$s.detail_title}</span>
                                                    </span>
                                                    <div class="fon_active"></div>
                                                    <div class="fon_label"></div>
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
                                                    <input type="checkbox" autocomplete="off">
                                                    <span class="name_container">
                                                    	<span class="name">{$s.detail_title}</span>
                                                    </span>
                                                    <div class="fon_active"></div>
                                                    <div class="fon_label"></div>
                                                    
                                                  </label>
												{/foreach}

                                                </div>

                                              </div>
                                            </div>
                                        </div>

                                        

                                    </div>
                                

                            
                            
                        
                        
                        
                        
                        
                        
                        
                        	</div>
                        	<div class="filter_system_links">
                              <a href="#" class="filter_system_links_clear">Очистить</a>
                              <a href="#" data-href="" class="filter_system_links_do">Применить</a>
                            </div>
                        
                        
                       		</div>

                        </div> 
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

