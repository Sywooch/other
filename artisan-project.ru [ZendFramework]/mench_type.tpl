=====<div class="innermerch_content_continer">


 <div class="merch_items_nav clearfix">
                    <span class="min_title">Сортировать:</span>
                    <div class="min_cont">
                        <span class="min_label">Тип</span>
                        <select name="min1" class="merch_select">
                          <option selected="selected" value="null">Выберите</option>
                          
                          {foreach from=$purposes item=ee}
                          <option value="{$ee.id}">{$ee.title}</option>
                          {/foreach}
                          
                        </select>
                    </div>
                    <div class="min_cont">
                        <span class="min_label">Фабрика</span>
                        <select name="min2" class="merch_select" style="width:180px;">
                          <option selected="selected" value="null">Выберите</option>
                          {foreach from=$fabrics item=ee}
                          <option value="{$ee.id}">{$ee.title}</option>
                          {/foreach}
                        </select>
                    </div>
                    <div class="min_cont">
                        <span class="min_label">Коллекция</span>
                        <select name="min3" class="merch_select">
                          <option selected="selected" value="null">Выберите</option>
                          {foreach from=$collections item=ee}
                          <option value="{$ee.id}">{$ee.title}</option>
                          {/foreach}
                        </select>
                    </div>
                </div>



				<div>
                <div class="load_fon">
					<img src="/public/site1/images/712.gif">
				</div>
				<div class="ajax_container">
                {php} foreach($this->page->collections_factory as $value){ 
                	///if(count($this->page->elements[$value['id']])==0){ continue; }
                {/php}
                <h2>{php} echo $value['title']; {/php}</h2>
                <div class="merch_items__container">
                    <div class="row">
                        
                        
                        {php} foreach($this->page->elements[$value['id']] as $value2){ {/php}
                        <div class="col-xs-6 col-sm-6 col-md-4">
                            <div class="merch_item__container">
                                <div class="merch_item_image">
                                    <a href="#">
                                        <img src="{php} echo str_replace('[dir]','original',$value2['image']); {/php}" />
                                    </a>
                                </div>
                                <div class="merch_item_1">
                                    <span><b>Тип:</b> {php} 
                                    $cnt=0;
                                    foreach($this->page->elements_types[$value2['id']] as $v){
                                    	if($cnt==0){
                                        	echo $v['detail_title']; 
                                    	}else{
                                        	echo ", ",$v['detail_title'];
                                        }
                                        
                                        $cnt++;
                                    }
                                    {/php}</span>
                                    <div>{php} echo $value2['title']; {/php}</div>
                                </div>
                                <div class="merch_item_2">
                                    {php} echo $value2['desc']; {/php}
                                </div>

                                <div class="merch_item__links clearfix">
                                    <a href="{php} echo $value2['file']; {/php}" class="pdf_link">Cкачать</a>
                                    <a href="#" onclick="var m=window.open('{php} echo $value2['file']; {/php}'); m.print(); return false;" class="print_link">Распечатать</a>
                                </div>
                            </div>
                        </div>
                        {php} } {/php}
                        
                        
                    </div>
                </div>
                {php} } {/php}
              	</div>
                </div>
              
              
 {loadview name=cat_paging}   
 
                
</div>                