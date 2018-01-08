

{php}
//print_r($this->page->employees_otdels);

for($i=0; $i<count($this->page->employees_otdels); $i++){

if($this->page->employees_otdels[$i]['id']=='26'){ continue; }
{/php}
<div class="inner_content_box inner_content_box_team" id="scroll{php}  echo $this->page->employees_otdels[$i]['id'];  {/php}">


<div class="row row_team_personal">
                        <div class="col-sm-8">
                            <h2>{php} echo $this->page->employees_otdels[$i]['title']; {/php}</h2>
                        </div>
                        <div class="col-sm-4">
                            <div class="print_link_meta">
                                <a href="#" class="pdf_link">Cкачать</a>
                                <a href="#" class="print_link">Распечатать</a>
                            </div>
                        </div>
                    </div>
                    
                    {php}
                    //$this->page->request['id']
                    
                    
                    //for($i2=0; $i2<count($this->page->otdel_employee[$this->page->employees_otdels[$i]['id']]['fio']); $i2++){ 
                    foreach($this->page->otdel_employee[$this->page->employees_otdels[$i]['id']]['fio'] as $key => $val){
                    
                   
                    {/php}
                    
                    
                    
                    <div class="row row_team_block">
                        <div class="col-sm-2">
                            <div class="team_man">
                                <img src="{php} echo str_replace('[dir]','original',$this->page->otdel_employee[$this->page->employees_otdels[$i]['id']]['image'][$key]); {/php}" alt="" title="">
                            </div>
                        </div>
                        <div class="col-sm-10">
                            <div class="clearfix">
                                <div class="contacts_name"><b>{php} echo $val; {/php}</b>
                                <span>{php} echo $this->page->otdel_employee[$this->page->employees_otdels[$i]['id']]['post'][$key]; {/php}</span></div>
                            </div>
                            
                            <div class="team_desc">

							{php} echo $this->page->otdel_employee[$this->page->employees_otdels[$i]['id']]['intro'][$key]; {/php}
                            
                            </div>

							{php} echo $this->page->otdel_employee[$this->page->employees_otdels[$i]['id']]['content'][$key]; {/php}


<!--
                            <div class="row row_contacts_003">
                                <div class="col-sm-5">
                                    <div class="contacts_info1"><span>Тел/факс:</span><gisphone class="_gis-phone-highlight-wrap js_gis-phone-highlight-wrap-f0fe5f4ed0235a93db67442e78cf9e0b _gis-phone-highlight-phone-wrap" data-ph-parsed="true">+7 (499) 724-28-10</gisphone> </div>
                                    <div class="contacts_info1"><span>Моб. тел.:</span><gisphone class="_gis-phone-highlight-wrap js_gis-phone-highlight-wrap-4015561d022f1b2d0383d7114e4ce4c1 _gis-phone-highlight-phone-wrap" data-ph-parsed="true">+7 (499) 724-28-85</gisphone> </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="contacts_info2"><span>Skype: </span>А.Andrey</div>
                                    <div class="contacts_info2"><span>Icq:</span>111 11 00 88</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="contacts_info1"><a href="mailto:andrei.filiposyants@artisan-project.ru">andrei.filiposyants@artisan-project.ru</a></div>
                                </div>
                            </div>
                            -->
                        </div>
                    </div>
                    {php}
                    
                    }
                    
                    {/php}
                   
                    
                   
</div>



{php}
}
{/php}






