<div class="widget widget_team">
                    <div class="widget_title">отделы</div>
                    <div class="widget_container_items clearfix">
                    
                    
         				{foreach from=$employees_otdels item=e}	
                        {if $e.id=='26'} {php} continue; {/php} {/if}           
                        <div class="widget_team_link">
                            <a href="#scroll{$e.id}" class="scroll"><span>{$e.title}</span></a>
                        </div>
                    	{/foreach}  
                    
                    
                    </div>
                </div>