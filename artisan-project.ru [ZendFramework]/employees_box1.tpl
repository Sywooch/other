
{foreach from=$employees_main item=e}

<div class="row row_team_first">



                        <div class="col-sm-3">
                            <div class="team_man">
                                <img src="{$e.image|replace:'[dir]':'original'}" alt="" title="">
                            </div>
                        </div>
                        
                        
                        
                        
                        
                        
                        
                        <div class="col-sm-9">
                            <div class="clearfix">
                                <div class="contacts_name"><b>{$e.fio}</b><span>{$e.post}</span></div>

                                <div class="print_link_meta">
                                    <a href="#" class="pdf_link">Cкачать</a>
                                    <a href="#" class="print_link">Распечатать</a>
                                </div>
                            </div>

                            <div class="team_desc">
                            {$e.intro}  
                            </div>
							{$e.content}
                            
                            
                            <!--
                            <div class="contacts_info1"><span>Моб. тел.:</span>+7 (964) 511-76-65</gisphone> </div>
                            <div class="contacts_info1">
                                <a href="mailto:roman.gabrielyan@artisan-project.ru">roman.gabrielyan@artisan-project.ru</a>
                            </div>
							-->
                        </div>
                    </div>
                    
                    
{/foreach}                 
                    
                    
                    