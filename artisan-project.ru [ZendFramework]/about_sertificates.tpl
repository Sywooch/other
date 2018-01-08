<!--<div class="about_block__slider">
                        <div class="bx-wrapper" style="max-width: 620px; margin: 0px auto;">
                        <div class="bx-viewport" style="width: 100%; overflow: hidden; position: relative; height: 307px;">
                        <ul class="slider_about" style="width: 615%; position: relative; transition-duration: 0s; transform: translate3d(0px, 0px, 0px);">
                        
                        
     						
                           
                            {foreach from=$about_sertificates item=i}                   
                        <li style="float: left; list-style: none; position: relative; width: 155px;" class="bx-clone">
                                <a rel="group" href="{$i.image}"><img src="{$i.image|replace:'[dir]':'original'}"><span></span></a>
                                <div class="ab_desc">
                                    <span>{$i.title}</span>
                                    {$i.description}
                                </div>
                            </li>
                            {/foreach}
                            
                         </ul>
                       
                       
                       <div class="bx-controls-direction"><a class="bx-prev disabled">Prev</a><a class="bx-next disabled">Next</a></div>
                       </div>
                       </div> 
                    </div>
                    
    --> 
                    
                    


                    <div class="about_block__slider">
                        <ul class="slider_about">
                            
                            {foreach from=$about_sertificates item=i}     
                            <li>
                                <a rel="group" href="{$i.image|replace:'[dir]':'original'}"><img src="{$i.image|replace:'[dir]':'original'}"><span></span></a>
                                <div class="ab_desc">
                                    <span>{$i.title}</span>
                                    {$i.description}
                                </div>
                            </li>
                            
                            {/foreach}
                            
                      
                            
                            
                        </ul>
                    </div>
                  
                    
                    
                    