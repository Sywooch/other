


{php}


/*         
echo "<pre>";         
print_r($_SESSION);         
echo "</pre>";         
echo session_id();     
echo "<br>";                                           
echo $_COOKIE['PHPSESSID'];
*/

for($i=0;$i<count($this->page->purposes);$i++){
                                                
{/php}


{php}
$cnt=0;
                                                
foreach($this->page->list_collections_goods_purposes as $val){

	
    foreach($val as $v){
    	if($v==$this->page->purposes[$i]['id']){ $cnt++; };
    }
	
    //if($val==$this->page->purposes[$i]['id']){ $cnt++; };

}
                                                    
if($cnt!=0){




{/php}
<span class="session_id" style="display:none;">{php} echo session_id(); {/php}</span>
<div class="product_more_container" id="scroll{php} echo $this->page->purposes[$i]['id']; {/php}">
                    <div class="row">
                        <div class="col-sm-8">

                            <h2>{php} echo $this->page->purposes[$i]['title']; {/php}</h2>
                        </div>
                        <div class="col-sm-4 text-right color_sort">
                            <a class="sort_link">Сортировать по цвету</a>
                            <div class="dropdown">
                                <div class="filter_container_items">
                                    <div data-toggle="buttons" class="btn-group filter_container_colors">
                                     
                                   		{foreach from=$colors item=s}		
                                        <label class="btn btn-primary color_filter_1" data-color="{$s.id}"  
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
                        
                            
                            
                            $i2=1; 
                            foreach($this->page->list_collections_goods_purposes as $key => $val){
                            
                            foreach($val as $v){
    						if($v==$this->page->purposes[$i]['id']){
                            
							//if($val==$this->page->purposes[$i]['id']){ 
                            {/php}
                            
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item" data-id="{php}  echo $this->page->goods_parameters[$key]['id']; {/php}">
                                        <a href="#plitka1_img_zoom" class="fancybox">
                                            <div class="catalog_image">
                                               <img src="{php}  echo str_replace('[dir]','small',$this->page->goods_parameters[$key]['photo']); {/php}">
                                            </div>
                                        </a>

                                        <div class="product_item_articul">Артикул: {php}  echo $this->page->goods_parameters[$key]['art']; {/php}</div>
                                        
                                        <div class="catalog_item_name"><a href="#">{php}  echo $this->page->goods_parameters[$key]['title']; {/php}</a></div>

                                        <div class="produc_item_dop tmp2">
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
                                            }; {/php}
                                            
                                            
                                            <!--
                                            <a href="/cat/type/purpose/{php} echo $this->page->purposes[$i]['id']; {/php}">
                                            {php}  echo $this->page->purposes[$i]['detail_title']; {/php}</a>
                                        	-->
                                        
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
                
 
 {php}
 }
 
 }
 {/php}
      
                

    <div id="plitka1" class="popup plitka_container" style="display:none;">
        <div class="row">
            <div class="col-sm-6">
                <div class="plitka_image">
                    <img src="images_tmp/plitka11.jpg" alt="" title="" >
                </div>
            </div>
            <div class="col-sm-6">
                <h2>Agate Rosso Centro Pulido</h2>
                <div class="plitka_row">
                    <span>Артикул:</span>345683
                </div>
                <div class="plitka_row">
                    <span>Тип поверхности:</span>Мрамар
                </div>
                <div class="plitka_row">
                    <span>Цвет:</span>Белый
                </div>
                <div class="plitka_row">
                    <span>Стиль:</span>Испания
                </div>
                <div class="plitka_row">
                    <span>Вес (коробка):</span>350 г.
                </div>
                <div class="plitka_row">
                    <span>Штук (в коробке):</span>бордюр керамический
                </div>
                <div class="plitka_price">
                    <span>От 4 379 Р</span>
                    <i>5 150 р</i>
                </div>
                <div class="plitka_buy clearfix">
                    <input type="text" id="count" value="255">
                    <span class="do">Шт</span>

                    <a class="buy_link">Заказать</a>

                    <a class="print_link">Распечатать</a>
                </div>
            </div>
        </div>
    </div>



    <div id="plitka1_img_zoom" class="popup plitka_container" data-popup-id="" style="display:none;">
        <h2>Agate Rosso Centro Pulido, 345683, 60x60</h2>
        <div class="plitka_image">
            <img src="images_tmp/plitka11.jpg" alt="" title="" >
        </div>
        <div class="product_sell clearfix">
            <input type="text" id="count" value="255">
            <span class="do">Шт</span>
            <a>Заказать</a>
        </div>
    </div>

                