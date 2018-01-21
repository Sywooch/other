					<div class="row">
                    
                    
                    	
                    	{foreach from=$about_clients item=i}
                        <div class="col-sm-6 col-md-4">
                            <div class="about_block__clients fix_height" style="height: 207px;">
                                <img src="{$i.image|replace:'[dir]':'original'}">
                                <div>{$i.title}</div>
                                <span>{$i.description}</span>
                            </div>
                        </div>
                        {/foreach} 
                     </div>   