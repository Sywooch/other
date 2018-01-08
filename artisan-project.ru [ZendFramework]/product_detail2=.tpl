


{php}
                                                
for($i=0;$i<count($this->page->purposes);$i++){
                                                
{/php}


{php}
$cnt=0;
                                                
foreach($this->page->list_collections_goods_purposes[$this->page->request['id']] as $val){
	if($val==$this->page->purposes[$i]['id']){ $cnt++; };
}
                                                    
if($cnt!=0){




{/php}
<div class="product_more_container" id="scroll1">
                    <div class="row">
                        <div class="col-sm-8">

                            <h2>{php} echo $this->page->purposes[$i]['title']; {/php}</h2>
                        </div>
                        <div class="col-sm-4 text-right">
                            <a href="#" class="sort_link">Сортировать по цвету</a>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active">
                            {php}
                            //echo "<pre>";
                            //print_r($this->page->list_collections_goods_purposes[$this->page->request['id']]);
                            //echo "</pre>";
                            
                            foreach($this->page->list_collections_goods_purposes[$this->page->request['id']] as $key => $val){
							if($val==$this->page->purposes[$i]['id']){ 
                            {/php}
                            <div class="row row_catalog_front">
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="">
                                            <div class="catalog_image">
                                               <img src="{php}  echo str_replace('[dir]','small',$this->page->goods_parameters[$key]['photo']); {/php}">
                                            </div>
                                        </a>

                                        <div class="product_item_articul">Артикул: {php}  echo $this->page->goods_parameters[$key]['art']; {/php}</div>
                                        
                                        <div class="catalog_item_name"><a href="#">{php}  echo $this->page->goods_parameters[$key]['title']; {/php}</a></div>

                                        <div class="produc_item_dop">
                                            {php}  echo $this->page->goods_parameters[$key]['size']; {/php} /<br> 
                                            <a href="#">{php} echo $this->page->purposes[$i]['title']; {/php}</a>
                                        </div>

                                        <div class="catalog_item_price">
                                            <span>От {php}  echo $this->page->goods_parameters[$key]['price']; {/php} Р</span>
                                            <!--<i>5 150 р</i>-->
                                        </div>

                                        <div class="product_sell">
                                            <a href="#plitka1" class="fancybox">Заказать</a>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                            </div>
                            {php}
							}
                            }
                            {/php}
                            
							<!--
                            <div class="row row_catalog_front">
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="/cat/id/1">
                                            <div class="catalog_image">
                                                <img src="/public/site1/images_tmp/products/plitka5.jpg">
                                            </div>
                                        </a>

                                        <div class="product_item_articul">Артикул: 345683</div>
                                        
                                        <div class="catalog_item_name"><a href="#">Aparici</a></div>

                                        <div class="produc_item_dop">
                                            44,63x44,63 /<br> <a href="#">Керамическая плитка</a>
                                        </div>

                                        <div class="catalog_item_price">
                                            <span>От 4 379 Р</span>
                                            <i>5 150 р</i>
                                        </div>

                                        <div class="product_sell">
                                            <a href="#">Заказать</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="/cat/id/1">
                                            <div class="catalog_image">
                                                <img src="/public/site1/images_tmp/products/plitka6.jpg">
                                            </div>
                                        </a>

                                        <div class="product_item_articul">Артикул: 345683</div>
                                        
                                        <div class="catalog_item_name"><a href="#">Aparici</a></div>

                                        <div class="produc_item_dop">
                                            44,63x44,63 /<br> <a href="#">Керамическая плитка</a>
                                        </div>
                                        
                                        <div class="catalog_item_price">
                                            <span>От 4 379 Р</span>
                                            <i>5 150 р</i>
                                        </div>

                                        <div class="product_sell">
                                            <a href="#">Заказать</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="/cat/id/1">
                                            <div class="catalog_image">
                                                <img src="/public/site1/images_tmp/products/plitka7.jpg">
                                            </div>
                                        </a>

                                        <div class="product_item_articul">Артикул: 345683</div>
                                        
                                        <div class="catalog_item_name"><a href="#">Aparici</a></div>

                                        <div class="produc_item_dop">
                                            44,63x44,63 /<br> <a href="#">Керамическая плитка</a>
                                        </div>
                                        
                                        <div class="catalog_item_price">
                                            <span>От 4 379 Р</span>
                                            <i>5 150 р</i>
                                        </div>

                                        <div class="product_sell">
                                            <a href="#">Заказать</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="/cat/id/1">
                                            <div class="catalog_image">
                                                <img src="/public/site1/images_tmp/products/plitka1.jpg">
                                            </div>
                                        </a>

                                        <div class="product_item_articul">Артикул: 345683</div>
                                        
                                        <div class="catalog_item_name"><a href="#">Aparici</a></div>

                                        <div class="produc_item_dop">
                                            44,63x44,63 /<br> <a href="#">Керамическая плитка</a>
                                        </div>
                                        
                                        <div class="catalog_item_price">
                                            <span>От 4 379 Р</span>
                                            <i>5 150 р</i>
                                        </div>

                                        <div class="product_sell">
                                            <a href="#">Заказать</a>
                                        </div>
                                    </div>
                                </div>
                            </div>-->

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
               
<!--                
<div class="product_more_container" id="scroll2">
                    <div class="row">
                        <div class="col-sm-8">

                            <h2>Декоры</h2>
                        </div>
                        <div class="col-sm-4 text-right">
                            <a href="#" class="sort_link">Сортировать по цвету</a>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active">
                            
                            <div class="row row_catalog_front">
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="/cat/id/1">
                                            <div class="catalog_image">
                                                <img src="/public/site1/images_tmp/products/plitka1.jpg">
                                            </div>
                                        </a>

                                        <div class="product_item_articul">Артикул: 345683</div>
                                        
                                        <div class="catalog_item_name"><a href="#">Aparici</a></div>

                                        <div class="produc_item_dop">
                                            44,63x44,63 /<br> <a href="#">Керамическая плитка</a>
                                        </div>

                                        <div class="catalog_item_price">
                                            <span>От 4 379 Р</span>
                                            <i>5 150 р</i>
                                        </div>

                                        <div class="product_sell">
                                            <a href="#">Заказать</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="/cat/id/1">
                                            <div class="catalog_image">
                                                <img src="/public/site1/images_tmp/products/plitka2.jpg">
                                            </div>
                                        </a>

                                        <div class="product_item_articul">Артикул: 345683</div>
                                        
                                        <div class="catalog_item_name"><a href="#">Aparici</a></div>

                                        <div class="produc_item_dop">
                                            44,63x44,63 /<br> <a href="#">Керамическая плитка</a>
                                        </div>
                                        
                                        <div class="catalog_item_price">
                                            <span>От 4 379 Р</span>
                                            <i>5 150 р</i>
                                        </div>

                                        <div class="product_sell">
                                            <a href="#">Заказать</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="/cat/id/1">
                                            <div class="catalog_image">
                                                <img src="/public/site1/images_tmp/products/plitka3.jpg">
                                            </div>
                                        </a>

                                        <div class="product_item_articul">Артикул: 345683</div>
                                        
                                        <div class="catalog_item_name"><a href="#">Aparici</a></div>

                                        <div class="produc_item_dop">
                                            44,63x44,63 /<br> <a href="#">Керамическая плитка</a>
                                        </div>
                                        
                                        <div class="catalog_item_price">
                                            <span>От 4 379 Р</span>
                                            <i>5 150 р</i>
                                        </div>

                                        <div class="product_sell">
                                            <a href="#">Заказать</a>
                                        </div>
                                    </div>
                                </div>
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
                
                
                
                
                
<div class="product_more_container" id="scroll3">
                    <div class="row">
                        <div class="col-sm-8">
                            <h2>Настенная плитка </h2>
                        </div>
                        <div class="col-sm-4 text-right">
                            <a href="#" class="sort_link">Сортировать по цвету</a>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active">
                            
                            <div class="row row_catalog_front">
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="/cat/id/1">
                                            <div class="catalog_image">
                                                <img src="/public/site1/images_tmp/products/plitka1.jpg">
                                            </div>
                                        </a>

                                        <div class="product_item_articul">Артикул: 345683</div>
                                        
                                        <div class="catalog_item_name"><a href="#">Aparici</a></div>

                                        <div class="produc_item_dop">
                                            44,63x44,63 /<br> <a href="#">Керамическая плитка</a>
                                        </div>

                                        <div class="catalog_item_price">
                                            <span>От 4 379 Р</span>
                                            <i>5 150 р</i>
                                        </div>

                                        <div class="product_sell">
                                            <a href="#">Заказать</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="/cat/id/1">
                                            <div class="catalog_image">
                                                <img src="/public/site1/images_tmp/products/plitka2.jpg">
                                            </div>
                                        </a>

                                        <div class="product_item_articul">Артикул: 345683</div>
                                        
                                        <div class="catalog_item_name"><a href="#">Aparici</a></div>

                                        <div class="produc_item_dop">
                                            44,63x44,63 /<br> <a href="#">Керамическая плитка</a>
                                        </div>
                                        
                                        <div class="catalog_item_price">
                                            <span>От 4 379 Р</span>
                                            <i>5 150 р</i>
                                        </div>

                                        <div class="product_sell">
                                            <a href="#">Заказать</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="/cat/id/1">
                                            <div class="catalog_image">
                                                <img src="/public/site1/images_tmp/products/plitka3.jpg">
                                            </div>
                                        </a>

                                        <div class="product_item_articul">Артикул: 345683</div>
                                        
                                        <div class="catalog_item_name"><a href="#">Aparici</a></div>

                                        <div class="produc_item_dop">
                                            44,63x44,63 /<br> <a href="#">Керамическая плитка</a>
                                        </div>
                                        
                                        <div class="catalog_item_price">
                                            <span>От 4 379 Р</span>
                                            <i>5 150 р</i>
                                        </div>

                                        <div class="product_sell">
                                            <a href="#">Заказать</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="/cat/id/1">
                                            <div class="catalog_image">
                                                <img src="/public/site1/images_tmp/products/plitka4.jpg">
                                            </div>
                                        </a>

                                        <div class="product_item_articul">Артикул: 345683</div>
                                        
                                        <div class="catalog_item_name"><a href="#">Aparici</a></div>

                                        <div class="produc_item_dop">
                                            44,63x44,63 /<br> <a href="#">Керамическая плитка</a>
                                        </div>
                                        
                                        <div class="catalog_item_price">
                                            <span>От 4 379 Р</span>
                                            <i>5 150 р</i>
                                        </div>

                                        <div class="product_sell">
                                            <a href="#">Заказать</a>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row row_catalog_front">
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="/cat/id/1">
                                            <div class="catalog_image">
                                                <img src="/public/site1/images_tmp/products/plitka5.jpg">
                                            </div>
                                        </a>

                                        <div class="product_item_articul">Артикул: 345683</div>
                                        
                                        <div class="catalog_item_name"><a href="#">Aparici</a></div>

                                        <div class="produc_item_dop">
                                            44,63x44,63 /<br> <a href="#">Керамическая плитка</a>
                                        </div>

                                        <div class="catalog_item_price">
                                            <span>От 4 379 Р</span>
                                            <i>5 150 р</i>
                                        </div>

                                        <div class="product_sell">
                                            <a href="#">Заказать</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="/cat/id/1">
                                            <div class="catalog_image">
                                                <img src="/public/site1/images_tmp/products/plitka6.jpg">
                                            </div>
                                        </a>

                                        <div class="product_item_articul">Артикул: 345683</div>
                                        
                                        <div class="catalog_item_name"><a href="#">Aparici</a></div>

                                        <div class="produc_item_dop">
                                            44,63x44,63 /<br> <a href="#">Керамическая плитка</a>
                                        </div>
                                        
                                        <div class="catalog_item_price">
                                            <span>От 4 379 Р</span>
                                            <i>5 150 р</i>
                                        </div>

                                        <div class="product_sell">
                                            <a href="#">Заказать</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="catalog_item">
                                        <a href="/cat/id/1">
                                            <div class="catalog_image">
                                                <img src="/public/site1/images_tmp/products/plitka7.jpg">
                                            </div>
                                        </a>

                                        <div class="product_item_articul">Артикул: 345683</div>
                                        
                                        <div class="catalog_item_name"><a href="#">Aparici</a></div>

                                        <div class="produc_item_dop">
                                            44,63x44,63 /<br> <a href="#">Керамическая плитка</a>
                                        </div>
                                        
                                        <div class="catalog_item_price">
                                            <span>От 4 379 Р</span>
                                            <i>5 150 р</i>
                                        </div>

                                        <div class="product_sell">
                                            <a href="#">Заказать</a>
                                        </div>
                                    </div>
                                </div>
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
 -->               
                
                
                