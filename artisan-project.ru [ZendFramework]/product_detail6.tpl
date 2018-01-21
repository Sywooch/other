<div class="product_more_container product_march_container" id="scroll_m">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2>Мерчандайзинг</h2>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active">
                            
                            <div class="row row_catalog_front">
                                
                                
                                
                                {php}
                                foreach($this->page->merchandising_docs_detail as $key => $val){
                                
                                {/php}
                                
                                
                                <div class="col-sm-4 col-md-4">
                                    <div class="catalog_item">
                                        <a href="">
                                            <div class="catalog_image">
                                                <img src="{php} echo str_replace('[dir]','original',$val['image']); {/php}">
                                            </div>
                                        </a>

                                        <div class="product_item_articul">Артикул: {php} echo $val['desc'] {/php}</div>
                                        
                                        <div class="catalog_item_name"><a href="{php} echo $val['file'] {/php}">{php} echo $val['title'] {/php}</a></div>

                                        <div class="print_link_meta">
                                            <a href="{php} echo $val['file'] {/php}" class="pdf_link">Cкачать</a>
                                            <span class="print_del"></span>
                                            <a href="#" onclick="var m=window.open('{php} echo $val['file']; {/php}'); m.print(); return false;" class="print_link">Распечатать</a>
                                        </div>

                                    </div>
                                </div>
                                {php}
                                }
                                {/php}
                                
                                
                                
                                
                                <!--
                                <div class="col-sm-4 col-md-4">
                                    <div class="catalog_item">
                                        <a href="/cat/id/1">
                                            <div class="catalog_image">
                                                <img src="/public/site1/images_tmp/march/march2.jpg">
                                            </div>
                                        </a>

                                        <div class="product_item_articul">Артикул: 345683</div>
                                        
                                        <div class="catalog_item_name"><a href="#">Agate Blue Centro Pulido</a></div>

                                        <div class="print_link_meta">
                                            <a href="#" class="pdf_link">Cкачать</a>
                                            <span class="print_del"></span>
                                            <a href="#" class="print_link">Распечатать</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="catalog_item">
                                        <a href="/cat/id/1">
                                            <div class="catalog_image">
                                                <img src="/public/site1/images_tmp/march/march3.jpg">
                                            </div>
                                        </a>

                                        <div class="product_item_articul">Артикул: 345683</div>
                                        
                                        <div class="catalog_item_name"><a href="#">Agate Blue Centro Pulido</a></div>

                                        <div class="print_link_meta">
                                            <a href="#" class="pdf_link">Cкачать</a>
                                            <span class="print_del"></span>
                                            <a href="#" class="print_link">Распечатать</a>
                                        </div>
                                    </div>
                                </div>
                                -->
                            </div>
                        </div>
                    </div>
                </div>