<div class="product_more_container product_recomend_container" id="scroll_r">
                    <div class="row">
                        <div class="col-sm-8">
                            <h2>Рекомендуемые товары</h2>
                        </div>
                        <div class="col-sm-4 text-right color_sort">
                            <a class="sort_link">Сортировать по цвету</a>
                            <div class="dropdown">
                                <div class="filter_container_items">
                                    <div data-toggle="buttons" class="btn-group filter_container_colors">
                                      	{foreach from=$colors item=s}		
                                        <label class="btn btn-primary color_filter_2" data-color="{$s.id}"  
                                        data-purpose="{php} echo $this->page->purposes[$i]['id']; {/php}"
                                        data-collection="{php} echo $this->page->request['id']; {/php}"
                                                  style="background-color:{$s.color}; background-image:none;">
                                            <input type="checkbox" autocomplete="off">
                                        </label>
										{/foreach}  
                                    
                                      
                                      
                                    </div>
                                </div>
                                <button type="button" class="close-sm"></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active">
                            
                            <div class="row row_catalog_front">
                                
                                
                                
                                {php}
                                
                               // echo "<pre>";
                               // print_r($this->page->goods_parameters);
                               // echo "</pre>";
                                
                                $i2=1;
                                foreach($this->page->list_collections_goods_purposes as $key => $val){
                                	if($this->page->goods_parameters[$key]['recomended']=='1'){
                                {/php}
                                
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item" data-id="{php}  echo $this->page->goods_parameters[$key]['id']; {/php}">
                                        <a href="#plitka1_img_zoom" class="fancybox">
                                            <div class="catalog_image">
                                                <img src="{php}  echo str_replace('[dir]','small',$this->page->goods_parameters[$key]['photo']); {/php}">
                                            </div>
                                        </a>

                                        <div class="product_item_articul">Артикул: {php}  echo $this->page->goods_parameters[$key]['art'];  {/php}</div>
                                        
                                        <div class="catalog_item_name"><a href="#">{php}  echo $this->page->goods_parameters[$key]['title']; {/php}</a></div>

                                        <div class="produc_item_dop">
                                            {php}  echo $this->page->goods_parameters[$key]['size']; {/php} /<br> 
                                            
                                            {php} 
                                            $cnt2=0;
                                            foreach($this->page->goods_parameters[$key]['purpose'] as $p){
                                            		if($cnt2==0){
                                                    	echo '<a href="/cat/type/purpose/'.$this->page->goods_parameters[$key]['purpose_id'][$cnt2].'">'.$p.'</a>';
                                                    }else{
                                                    	echo ", ".'<a href="/cat/type/purpose/'.$this->page->goods_parameters[$key]['purpose_id'][$cnt2].'">'.$p.'</a>';
                                                    }
                                                    $cnt2++;
                                            		}; {/php}</a>
                                        </div>
										
                                        
                                        
                                        <div class="catalog_item_price">
                                            <span>От {php}  echo $this->page->goods_parameters[$key]['price']; {/php} Р</span>
                                            <i></i>
                                        </div>

                                        <div class="product_sell">
                                            
                                            
                                            {php}
                                            $cart_tmp=0;
                                            foreach($this->page->basket_goods as $val2){
                                            	if($val2==$this->page->goods_parameters[$key]['id']){ $cart_tmp=1; break; }
                                            }
                                            
                                            if($cart_tmp==1){
                                            {/php}
                                            <span class="blue underline">В корзине</span>
                                            {php}
                                            }else{
                                            
                                            {/php}
                                            <div class="get_order dropdown">
                                                <button type="button" class="close-sm"></button>
                                                <div class="form row">
                                                    <div class="col-xs-8 get_order-num_wrapp"><input type="text" class="get_order-num"></div>
                                                    <div class="col-xs-4 get_order-num_type">шт.</div>
                                                </div>
                                                <a href="#plitka1" class="get_order-btn">Заказать</a>
                                            </div>
                                            {php}
                                            }
                                            {/php}
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                {php}
                                if($i2%4==0){
                                {/php}
                                </div>
                                <div class="row row_catalog_front">
                                {php}
                                }
                                $i2++;
                                }
                                }
                                {/php}
                                
                                
                                
                                
                                
                                
                                
                            </div>


                            <div class="catalog_meta_container">
                                <div class="row">
                                    <div class="col-xs-12 text-left">
                                        <span class="reccomend">На товарах указаны рекомендованные розничные цены</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>