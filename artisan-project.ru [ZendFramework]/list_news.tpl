<div class="inner_content_box">
                    
                    
                    
                    {foreach from=$news item=n}
                    
                    <div class="inner_content_news_list">
                        <h2>{$n.title}</h2>
                        <div class="inner_content_box_date">{$n.date|date_format:'%d'}
                {assign var=month value=$n.date|date_format:'%m'}
                {if $month == 1}
                    января
                {elseif $month == 2}
                    февраля
                {elseif $month == 3}
                    марта
                {elseif $month == 4}
                    апреля
                {elseif $month == 5}
                    мая
                {elseif $month == 6}
                    июня
                {elseif $month == 7}
                    июля
                {elseif $month == 8}
                    августа
                {elseif $month == 9}
                    сентября
                {elseif $month == 10}
                    октября
                {elseif $month == 11}
                    ноября
                {elseif $month == 12}
                    декабря
                {/if}
                {$n.date|date_format:'%Y'}</div>
                        <p>{$n.description}</p>
                        <div class="read_all_news">
                            <a href="/about/news/id/{$n.id}/">Читать далее</a>
                        </div>
                    </div>
                    
                    {/foreach}
                    
                    
                    
                    
                    
                 
					                   
                    
                    

                    <div class="pagination">
                        <ul class="clearfix">
                        
                        	{php}
                            if(strpos($_SERVER['REQUEST_URI'],"about/news/page/all") != false)
							{
                            {/php}
                            <li><a href="/about/news/page/1">Постранично</a></li>
                            {php}
                            }else{
                        	{/php}
                            <li class="prev"><span><a href="{php}  
                            if($this->_tpl_vars['paging']['curr_page']=='1'){ echo '/about/news/page/1'; }
                            else{ echo '/about/news/page/'.($this->_tpl_vars['paging']['curr_page']-1).''; }
                             {/php}">prev</a></span></li>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            {php}
                            if($this->_tpl_vars['paging']['curr_page'] <= 12){
                            {/php}
                            
                            {php}
                            if($this->_tpl_vars['paging']['pages'] >= 12){
                            {/php}
                            
                            <li {php} if($this->_tpl_vars['paging']['curr_page']==1){ echo'class="active"';} {/php}><span><a href="/about/news/page/1">1</a></span></li>
                            <li {php} if($this->_tpl_vars['paging']['curr_page']==2){ echo'class="active"';} {/php}><span><a href="/about/news/page/2">2</a></span></li>
                            <li {php} if($this->_tpl_vars['paging']['curr_page']==3){ echo'class="active"';} {/php}><span><a href="/about/news/page/3">3</a></span></li>
                            <li {php} if($this->_tpl_vars['paging']['curr_page']==4){ echo'class="active"';} {/php}><span><a href="/about/news/page/4">4</a></span></li>
                            <li {php} if($this->_tpl_vars['paging']['curr_page']==5){ echo'class="active"';} {/php}><span><a href="/about/news/page/5">5</a></span></li>
                            <li {php} if($this->_tpl_vars['paging']['curr_page']==6){ echo'class="active"';} {/php}><span><a href="/about/news/page/6">6</a></span></li>
                            <li {php} if($this->_tpl_vars['paging']['curr_page']==7){ echo'class="active"';} {/php}><span><a href="/about/news/page/7">7</a></span></li>
                            <li {php} if($this->_tpl_vars['paging']['curr_page']==8){ echo'class="active"';} {/php}><span><a href="/about/news/page/8">8</a></span></li>
                            <li {php} if($this->_tpl_vars['paging']['curr_page']==9){ echo'class="active"';} {/php}><span><a href="/about/news/page/9">9</a></span></li>
                            <li {php} if($this->_tpl_vars['paging']['curr_page']==10){ echo'class="active"';} {/php}><span><a href="/about/news/page/10">10</a></span></li>
                            <li {php} if($this->_tpl_vars['paging']['curr_page']==11){ echo'class="active"';} {/php}><span><a href="/about/news/page/11">11</a></span></li>
                            <li {php} if($this->_tpl_vars['paging']['curr_page']==12){ echo'class="active"';} {/php}><span><a href="/about/news/page/12">12</a></span></li>
                            
                            {php}
                            }else{
                            {/php}
                            
                            {php}
                            for($i=0;$i<($this->_tpl_vars['paging']['pages']);$i++){
                            	if($this->_tpl_vars['paging']['curr_page']==$i){ 
                                	echo '<li class="active"><span><a href="/about/news/page/'.$i.'">'.$i.'</a></span></li>';
                                }else{
                            		echo '<li><span><a href="/about/news/page/'.$i.'">'.$i.'</a></span></li>';
                            	}
                            }
                            {/php}
                            
                            {php}
                            }
                            {/php}
                            
                            
                            {php}
                            if($this->_tpl_vars['paging']['pages'] > 12){
                            	for($i=12;$i<$this->_tpl_vars['paging']['pages'];$i=$i+12){
                                	if($i==12){ continue; }
                                    if($this->_tpl_vars['paging']['curr_page']==$i){ 
                                    	echo '<li class="active"><span><a href="/about/news/page/'.$i.'">'.$i.'</a></span></li>';
                                    }else{
                                    	echo'<li><span><a href="/about/news/page/'.$i.'">...'.$i.'</a></span></li>';   	
                                	}
                                }                            	
                            }
                            {/php}
                            
                            {php}
                            }else{
                            {/php}
                            	{php}
                            	for($i=12;$i<$this->_tpl_vars['paging']['pages'];$i=$i+12){
                                    if($this->_tpl_vars['paging']['curr_page']==$i){ 
                                    	echo '<li class="active"><span><a href="/about/news/page/'.$i.'">'.$i.'</a></span></li>';
                                    }else{
                                    	echo'<li><span><a href="/about/news/page/'.$i.'">...'.$i.'</a></span></li>';   	
                                	}
                                    if(($this->_tpl_vars['paging']['curr_page']>$i)&&($this->_tpl_vars['paging']['curr_page']<($i+12))){
                                    	echo'<li class="active"><span><a href="/about/news/page/'.$this->_tpl_vars['paging']['curr_page'].'">'.$this->_tpl_vars['paging']['curr_page'].'</a></span></li>';	
                                    }
                                    
                                    
                                } 
                            	{/php}
                                
                                {php}
                                if($this->_tpl_vars['paging']['curr_page']==$this->_tpl_vars['paging']['pages']){ 
                                	//echo '<li class="active"><span><a href="/about/news/page/'.$this->_tpl_vars['paging']['pages'].'">'.$this->_tpl_vars['paging']['pages'].'</a></span></li>';
                                }else{
                                	echo'<li><span><a href="/about/news/page/'.$this->_tpl_vars['paging']['pages'].'">...'.$this->_tpl_vars['paging']['pages'].'</a></span></li>';   	
                                }
                                	
                                {/php}
                                
                                
                                
                            {php}
                            }
                            {/php}
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            {php}
                            {/php}
                            <li class="next"><span><a href="{php}  
                            if($this->_tpl_vars['paging']['curr_page']==$this->_tpl_vars['paging']['pages']){ echo '/about/news/page/'.$this->_tpl_vars['paging']['curr_page'].''; }
                            else{ echo '/about/news/page/'.($this->_tpl_vars['paging']['curr_page']+1).''; }
                             {/php}">next</a></span></li>
                            <li><a href="/about/news/page/all">Показать всё</a></li>
                        	{php}
                            }
                            {/php}
                        
                        </ul>
                    </div>
                </div>