<h2 class="pdf_title">Каталог фабрик — PDF</h2>
<div class="catalog_full_container catalog_fix_container">

                    <div class="tabpane_country">
                            <div class="row">
                                <div class="col-sm-4">


									{php} $i=0; $i2="";{/php}
									{foreach from=$merchandising_factories item=m}
                                    {php} $i2=mb_substr($title, 0, 1, 'UTF-8'); if($i==0){ {/php}
                                    <div class="tabpane_country_block">
                                        <div class="tabpane_alfa">
                                            <span>А</span>
                                        </div>
                                        <ul>
                                     {php} } {/php}   
                                     
                                     		{php} 
                                            $title=$this->page->merchandising_factories[$i]['title']; 
                                            if((mb_substr($title, 0, 1, 'UTF-8')!=$i2) && (mb_substr($title, 0, 1, 'UTF-8')!="A")){
                                            
                                            {/php}
                                            </ul>
                                    		</div>
                                            
                                            
                                            {php}
                                            
                                            if((mb_substr($title, 0, 1, 'UTF-8')=="G")||(mb_substr($title, 0, 1, 'UTF-8')=="N")){
                                            {/php}
                                            </div>
                                            
                                            <div class="col-sm-4">
                                            {php}
                                            }
                                            {/php}
                                            <div class="tabpane_country_block">
                                        	<div class="tabpane_alfa">
                                            	<span>{php} echo mb_substr($title, 0, 1, 'UTF-8'); {/php}</span>
                                        	</div>
                                        	<ul>
                                            {php}
                                            
                                            
                                            }
                                            {/php}
                                            <li><a href="/merchfactory/{$m.url}">{$m.title}</a></li>
                                           
                                    {php} $i++; {/php}    
                                    {/foreach}
                                    </ul>
                                    </div>
                             
                                </div>
                                
                         
                            </div>
                    </div>


                </div>
                
                