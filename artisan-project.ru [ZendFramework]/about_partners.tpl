<div class="row">
                        
                        
                        {foreach from=$about_partners item=i}
                        
                        <div class="col-sm-6 col-md-4">
                            <div class="about_block__partner">
                                <img src="{$i.image|replace:'[dir]':'original'}">
                                <div>{$i.title}</div>
                                <span>{$i.description}</span>
                            </div>
                        </div>
                        {/foreach}
                        
                        
                    </div>