
<div class="slider_vertical__container">
                        <div class="slider_vertical__main">
                            <div class="slider_vertical__item">
                            	{php} $i=0; {/php}
                            	{foreach from=$about_slider1 item=i}
                                {php} $i=1; {/php}
                                <img src="{$i.image|replace:'[dir]':'original'}">
                                {php} if($i==1){ break; } {/php}
                                {/foreach}
                            </div>
                        </div>
                        <div class="slider_vertical__nav">
                            <a class="sv-top"></a>
                            <a class="sv-bottom"></a>
                            <ul>
                            {foreach from=$about_slider1 item=i}
                            	<li><a><img src="{$i.image|replace:'[dir]':'original'}"></a></li>
                                
                            {/foreach}
                            </ul>
                        </div>
                    </div>