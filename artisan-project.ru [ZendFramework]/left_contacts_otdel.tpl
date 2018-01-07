<div class="widget widget_team">
                    <div class="widget_title">отделы</div>
                    <div class="widget_container_items clearfix">
                    
                    	
                        
          				{foreach from=$contacts item=c}              
                        <div class="widget_team_link">
                            <a href="#scroll{$c.id}" class="scroll"><span>{$c.title}</span></a>
                        </div>
                        {/foreach}
                        
                        
                        
                    </div>
                </div>