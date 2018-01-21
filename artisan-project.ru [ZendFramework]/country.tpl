





					<div class="load_fon" style="display: none; width:calc(100% - 40px);">
						<img src="/public/site1/images/712.gif">
						</div>


{php}

//echo "=".$this->_tpl_vars['paging']['curr_page'];

{/php}


<div class="row row_catalog_front">
						{php} //echo count($this->page->country_collection); {/php}
                        {php} for($i=0;$i<count($this->page->country_collection);$i++){  {/php}
						<div class="col-sm-6 col-md-4">
                            <div class="catalog_item">
                                <a href="/cat/id/{php} echo $this->page->country_collection[$i]['id']; {/php}">
                                    <div class="catalog_image">
                                        <img src="{php} echo str_replace('[dir]','original',$this->page->country_collection[$i]['image']);  if($this->page->country_collection[$i]['image']==''){ echo 'http://мебельплюс.бел/images/stories/virtuemart/product/resized/no_photo_640x480.png'; } {/php}">
                                    </div>
                                    <div class="catalog_item_name">{php} echo $this->page->country_collection[$i]['title'];  if($this->page->country_collection[$i]['title']==""){ echo "Без названия"; }  {/php}</div>
                                </a>

                                <div class="catalog_item_manuf">
                                    <a href="/cat/{php} echo $this->page->country_collection_factory_url[$i]; {/php}">{php} echo $this->page->country_collection_factory_title[$i]; {/php}</a> / 
                                    <a href="#">{php} echo $this->page->country_collection_country_name; {/php}</a>
                                </div>
                                <div class="catalog_item_price">
                                    <span>От {php} echo $this->page->country_collection_prices[$this->page->country_collection[$i]['id']][0]; {/php} Р</span>
                                    <i></i>
                                </div>
                            </div>
                        </div>
						
                        {php} if($i%3-2==0){ {/php}
                        <div style="clear:both;"></div>
                        {php} } {/php}
                        
                        {php}  }  {/php}
                                                
         
         
                     
                    
                        
                        
</div>


 <div class="row row_catalog_front pagination">  
   {loadview name=cat_paging}      
   </div>






<!--




{foreach from=$factories item=f name=factories}
                        <div class="col-sm-6 col-md-4">
                            <div class="catalog_item">
                                <a href="/cat/{$f.url|default:$f.id}/{if $act_filter}{$act_filter}/yes{/if}">
                                    <div class="catalog_image">
                                        <img src="{$f.image|replace:'[dir]':'original'}">
                                    </div>
                                    <div class="catalog_item_name">{$factory.title} {$f.title}</div>
                                </a>

                                
                            </div>
                        </div>
                        {if ($smarty.foreach.factories.iteration-2)%3 == 1}
                        <div style="clear:both;"></div>
                        {/if}
                        
                        {/foreach}









<h1>{$country.mtitle}</h1>
<div class="inner_cont">
    <div id="catalog">
        <table id="collectionstable">
        {foreach from=$factories item=f name=factories}
            {if $smarty.foreach.factories.iteration%3 == 1}
                <tr>
            {/if}
            <td class="fact_{$smarty.foreach.factories.iteration%4}">
                <div class="inner collection">
                    <a href="/cat/{$f.url|default:$f.id}/{if $act_filter}{$act_filter}/yes{/if}" title="{$factory.title} {$f.title}">
                        <img src="{$f.image|replace:'[dir]':'small'}" alt="{$factory.title} {$f.title}">
                    </a>
                </div>
            </td>
            {if $smarty.foreach.factories.iteration%4 == 0}
                </tr>
            {/if}
        {/foreach}
        </table>
    </div>
    <div class="inner factory">
        <p>{$country.descr}</p>
    </div>
</div>-->