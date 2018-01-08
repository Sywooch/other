


{php} $i=0; {/php}
{php}
foreach($this->page->contacts as $c){
{/php}

<div class="inner_content_box inner_content_box_contacts" id="scroll{php} echo $c['id']; {/php}">


					<div class="row row_contacts_000 tmp000">
                        <div class="col-sm-9" {php} if($c['no_emp']=='yes'){ echo 'style="border-bottom:0px;"';}; {/php} >
                            <h2>{php} echo $c['title']; {/php}</h2>
                        
                            {php} echo $c['content']; {/php}
                            
                        </div>
                        <div class="col-sm-3">
                            <div class="map_contacts" {php} if($c['no_emp']=='yes'){ echo 'style="margin-top:20px;"';}; {/php}>
                                <img src="{php} echo str_replace('[dir]','original',$c['map']); {/php}" alt="" title="" 
                                data-map='{php} echo $c["id"]; {/php}'>
                            </div>
                        </div>
                        
                    </div>
                    
        
                    <div class="modal modal_map" id="modal_map_{php} echo $c['id']; {/php}" 
                    tabindex="-1" role="dialog" style="display:none;">
  					<div class="modal-dialog" role="document">
    				<div class="modal-content">
      				<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        			<h4 class="modal-title"></h4>
      				</div>
      				<div class="modal-body">
                    {php} echo $c["map_code"]; {/php}
      				</div>
    				</div>
  					</div>
					</div> 
                    
                    
                    
                    
                    <div class="row row_contacts_001" {php} if($c['no_emp']=='yes'){ echo 'style="border-bottom:0px; padding-bottom:0px;"';}; {/php}>
                        <div class="col-sm-7">
                            <div class="print_link_contacts">
                                <a href="mailto:{php} echo $c['mail']; {/php}">{php} echo $c['mail']; {/php}</a>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="print_link_meta">
                                <a href="http://artisan-project.ru/public/userfiles/upload/files/Shema.pdf" class="pdf_link">Cкачать</a>
                                <a href="#" onclick="var m=window.open('http://artisan-project.ru/public/userfiles/upload/files/Shema.pdf'); m.print(); return false;" class="print_link">Распечатать</a>
                            </div>
                        </div>
                    </div>
                    
                    
                   
                    <div class="row row_contacts_002" {php} if($c['no_emp']=='yes'){ echo 'style="display:none;"';  };    {/php}>
                        <div class="col-sm-12">
                            <a class="alert-link panel-title collapsed" data-toggle="collapse" data-parent="#panel_top" href="#team{php} echo $c['id']; {/php}" aria-expanded="false">
                                <div class="contacts_sotr">
                                    <span>Cотрудники отдела</span>
                                    <div class="sotrudnin_small_img">
                                    	
                                        {php}
                                        
                                        //for($i2=0; $i2<count($this->page->otdel_employee[$this->page->contacts[$i]['id_otdel']]); $i2++){
                                        foreach($this->page->otdel_employee[$c['id']]['image'] as $val){ 
                                       
                                        {/php}
                                        <img src="{php} 
                                        
                                        echo str_replace('[dir]','original',$val); 
                                        
                                        {/php}" alt="" title="">
                                        {php}
                                        }
                                        {/php}
                                    
                                    
                                    </div>
                                </div>
                                <span class="contacts_app">Развернуть</span>
                            </a>

                        </div>
                    </div>
                    
                    <div id="team{php} echo $c['id']; {/php}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                        
                        
                        {php}            
                        //for($i2=0; $i2<count($this->page->otdel_employee_image[$this->page->contacts[$i]['id_otdel']]); $i2++){ 
                        foreach($this->page->otdel_employee[$c['id']]['image'] as $key2 => $val2){ 
                                            
                        {/php}
                        
                        
                        
                        <div class="row row_contacts_block">
                            <div class="col-sm-2">
                                <div class="contacts_team_photo"><img src="{php} 
                                        
                                        echo str_replace('[dir]','original',$val2); 
                                        
                                        {/php}" alt="" title=""></div>
                            </div>
                            <div class="col-sm-10">
                                <div class="contacts_name">{php} echo $this->page->otdel_employee[$c['id']]['fio'][$key2];  {/php}<span>{php} echo $this->page->otdel_employee[$c['id']]['post'][$key2];  {/php}</span></div>
                                
                                
                                {php}  echo $this->page->otdel_employee[$c['id']]['content'][$key2]; {/php} 
                              
                            </div>
                        </div>
                        
                        {php}
                        }
                        {/php}
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                    </div>
                    
                    
        
</div>
{php} $i++; 

}
{/php}
