


<div class="product_content_continer">
                    <div class="row">
                        <div class="col-sm-5">
                                
                               
                                
                                <div class="gallery">
                                    <div class="gallery_big_data">
                                        <div class="catalog_item_meta">
                                            <ul>
                                                {php} if($this->page->collection_sale=="yes"){ {/php}
                                                <li><span class="cim_sell">Распродажа</span></li>
                                                {php} } {/php}
                                                
                                                {php} if($this->page->collection_novice=="yes"){ {/php}
                                                <li><span class="cim_new">Новинка</span></li>
                                                {php} } {/php}
                                                
                                                {php} if($this->page->collection_action=="yes"){ {/php}
                                                <li><span class="cim_action">Акция</span></li>
                                                {php} } {/php}
                                                
                                                
                                            
                                            </ul>
                                        </div>
                                        <a href="{php} echo str_replace('[dir]','original',$this->page->detail_images_list[0]);{/php}" rel="prettyPhoto[gallery2]"><img src="{php} echo str_replace('[dir]','original',$this->page->detail_images_list[0]);{/php}">
                                        </a>
                                    </div>
                                    
                                    
                                    
                                    
                                    
                                    
                                    <div class="gallery_small_data">
                                        {php}
                                        for($i=0;$i<count($this->page->detail_images_list);$i++){
                                        {/php}
                                        
                                        <a href="{php} echo str_replace('[dir]','medium', $this->page->detail_images_list[$i]);{/php}" rel="prettyPhoto[gallery2]"><img src="{php} echo str_replace('[dir]','original', $this->page->detail_images_list[$i]);{/php}"></a>
                                        {php}
                                        }
                                        {/php}
                                        
                                    </div>
                                </div>
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                        </div>
                        <div class="col-sm-7">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="fix_products_info">
                                        <div class="product_short_desc">
                                            <div class="product_short_desc_title">Назначение:</div>
                                            
                                            <div class="product_short_desc_content">
                                            {php} 
                                            
                                            //echo $this->page->purposes_detail2[$this->page->request['id']]; 
                                            $i=0;
                                            foreach($this->page->purposes_detail2[$this->page->request['id']] as $val){
                                              if($val==""){ continue; };
                                              if($i==0){
                                              	echo "".$val;
                                              }else{
                                              	echo ", ".$val;
                                              
                                              }	
                                              $i++;
                                            }
                                            
                                            {/php}
                                            </div>
                                           
                                        </div>
                                        <div class="product_short_desc">
                                            <div class="product_short_desc_title">Материал:</div>
                                            <div class="product_short_desc_content">
                                            {php} //echo $this->page->materials_detail2[$this->page->request['id']]; 
                                            
                                            $i=0;
                                            foreach($this->page->materials_detail2[$this->page->request['id']] as $val){
                                              if($val==""){ continue; };
                                              if($i==0){
                                              	echo "".$val;
                                              }else{
                                              	echo ", ".$val;
                                              
                                              }	
                                              $i++;
                                            }
                                            
                                            
                                            {/php}
                                            
                                            
                                            </div>
                                        </div>
                                        <div class="product_short_desc">
                                            <div class="product_short_desc_title">Базовые размеры:</div>
                                            <div class="product_short_desc_content">
                                            {php} 
                                            $cnt=0;
                                            foreach($this->page->based_sizes_detail as $v){
                                            	if($cnt==0){
                                            		echo "".$v;
                                            	}else{
                                                	 echo ", ".$v; 
                                                }
                                                $cnt++;
                                            }
                                            {/php}</div>
                                        </div>
                                        <div class="product_short_desc">
                                            <a href="#" class="pdf_link">Каталог коллекций</a>
                                        </div>

										

                                        <div class="product_buy_block">
                                            <div class="product_buy_title">Розничная цена</div>
                                            <div class="product_buy_price clearfix"><span>От {php} echo $this->page->current_price; {/php} Р.</span><i></i></div>
                                            
                                            {php}
                                            //echo "<pre>";
                                            //print_r($this->page->basket);
                                            //echo "</pre>";
											
                                            $cart_tmp=0;
                                            
                                            foreach($this->page->basket as $val2){
                                            	if($val2==$this->page->request['id']){ $cart_tmp=1; break; }
                                            }
                                            
                                            
                                           
                                            {/php}
                                            
                                            
                                            {php} if(($cart_tmp=='1') || ($this->page->basket == $this->page->request['id'])){ {/php}
                                            <div class="product_buy_link" style="background-color:transparent; color:#e49b25;">
                                                <strong>Коллекция в корзине</strong>
                                            </div>
                                            {php}
                                            }else{
                                            {/php}
                                            <div class="product_buy_link" onclick="collection_to_basket({php} echo $this->page->request['id']; {/php},'{php} echo session_id(); {/php}')">
                                                <a style="cursor:pointer;">Заказать коллекцию</a>
                                            </div>
                                        	{php}
                                            }
                                            {/php}    
                                       	     
                                            
                                        </div>

                                        <div class="product_complect_block">
                                            <span>Комплектность коллекции</span>
                                            <ul>
                                                
                                                
                                                {php}
                                                
                                        		for($i=0;$i<count($this->page->purposes);$i++){
                                                //echo"=".$this->page->purposes[$i]['title']."=<br>";
                                        		{/php}
                                                {php}
                                                $cnt=0;
                                                
                                                foreach($this->page->list_collections_goods_purposes as $val){
                                                
                                                //echo "<pre>";
                                                //print_r($val);
                                                //echo "</pre>";
                                                	
                                                    foreach($val as $v){
                                                		if($v==$this->page->purposes[$i]['id']){ $cnt++; };
                                                	}
                                                
                                                }
                                                
                                                //echo "<br>";    
                                                if($cnt!=0){
                                                {/php}
                                                <li><a href="#scroll{php} echo $this->page->purposes[$i]['id']; {/php}" 
                                                class="scroll"><span>
                                                {php} echo $this->page->purposes[$i]['title']; 
                                                //echo $this->page->purposes[$i]['id']; {/php}
                                                </span>
                                                {php}
                                                //echo "<pre>";
                                                //print_r($this->page->list_collections_goods_purposes);
                                                //echo "</pre>";
                                                
                                                	echo "<i>".$cnt."</i>";
                                                {/php}
                                                </a></li>
                                                {php}
                                                }
                                                {/php}
                                                {php}
                                                }
                                                {/php}
                                               
                                                
                                                
                                                {php}
                                                $cnt=0;
                                                foreach($this->page->list_collections_goods_purposes as $key => $val){
         											if($this->page->goods_parameters[$key]['recomended']=='1'){ $cnt++; }
                                                    
                                                }
                                                if($cnt!=0){
                                                {/php}
                                                
                                                <li><a href="#scroll_r" class="scroll"><span>Рекомендуемые товары</span>
                                                <i>{php} echo $cnt; {/php}</i></a></li>
         										
                                                {php}
                                                }
                                                {/php}
         
         
                                                <li><a href="#scroll_m" class="scroll"><span>Мерчандайзинг</span><i>
                                                {php}
                                                echo count($this->page->merchandising_docs_detail);
                                                {/php}
                                                </i></a></li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="scrollbar">
                                        <div class="scrollbar_country">
                                            <span class="flag_it" style="background-image:url({php} echo str_replace("[dir]","original",$this->page->current_factory['flag']);{/php}); background-size:30px;">{php}echo $this->page->current_factory['name'];{/php}</span>
                                        </div>
                                        <div class="scrollbar_content">
                                            <div class="scrollbar_content_in scrollbarcontainer scrollable default-skin" tabindex="-1"><div class="scroll-bar vertical" style="height: 380px; display: block;"><div class="thumb" style="top: 0px; height: 61px;"></div></div><div class="viewport" style="height: 380px;"><div class="overview" style="top: 0px;">
                                                <ul>
                                                	 
                                                	{php}
                                        			foreach ($this->page->list_fabric_collections as $v){
                                        			{/php}
                                                    
                                                    <li><a href="/cat/id/{php} echo $v['id']; {/php}">{php} echo $v['title']; {/php}</a></li>
                                                    {php}
                                                    }
                                                    {/php}
                                                    
                                                </ul>
                                            </div></div><div class="scroll-bar horizontal"><div class="thumb"></div></div></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>