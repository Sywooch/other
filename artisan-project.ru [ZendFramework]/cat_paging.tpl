 <!--paging-->
 {php}
 //echo "==".$this->_tpl_vars['paging']['curr_page'];
$url=preg_replace('/page\/\d+\//i', '', $_SERVER['REQUEST_URI']);
$url2=str_replace('/page/all/', '', $_SERVER['REQUEST_URI']);
$url2=str_replace('/page/all', '', $url2);



if($url[strlen($url)-1]!="/"){
$url=$url."/";
} 

if($url2[strlen($url2)-1]!="/"){
$url2=$url2."/";
} 


 
{/php}
                  <div class="pagination tmp1">
                        <ul class="clearfix">
                        
                        	{php}
                            if(strpos($_SERVER['REQUEST_URI'],"page/all") != false)
							{
                            {/php}
                            <li><a href="{php} echo $url2; {/php}page/1/">Постранично</a></li>
                            {php}
                            }else{
                        	{/php}
                            <li class="prev"><span><a href="{php}  
                            if($this->_tpl_vars['paging']['curr_page']=='1'){ echo ''.$url.'page/1/'; }
                            else{ echo ''.$url.'page/'.($this->_tpl_vars['paging']['curr_page']-1).'/'; }
                             {/php}">prev</a></span></li>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            {php}
                            if($this->_tpl_vars['paging']['curr_page'] <= 12){
                            {/php}
                            
                            {php}
                            
                            if($this->_tpl_vars['paging']['pages'] >= 12){
                            {/php}
                            
                            <li {php} if($this->_tpl_vars['paging']['curr_page']==1){ echo'class="active"';} {/php}><span><a href="{php} echo $url; {/php}page/1/">1</a></span></li>
                            <li {php} if($this->_tpl_vars['paging']['curr_page']==2){ echo'class="active"';} {/php}><span><a href="{php} echo $url; {/php}page/2/">2</a></span></li>
                            <li {php} if($this->_tpl_vars['paging']['curr_page']==3){ echo'class="active"';} {/php}><span><a href="{php} echo $url; {/php}page/3/">3</a></span></li>
                            <li {php} if($this->_tpl_vars['paging']['curr_page']==4){ echo'class="active"';} {/php}><span><a href="{php} echo $url; {/php}page/4/">4</a></span></li>
                            <li {php} if($this->_tpl_vars['paging']['curr_page']==5){ echo'class="active"';} {/php}><span><a href="{php} echo $url; {/php}page/5/">5</a></span></li>
                            <li {php} if($this->_tpl_vars['paging']['curr_page']==6){ echo'class="active"';} {/php}><span><a href="{php} echo $url; {/php}page/6/">6</a></span></li>
                            <li {php} if($this->_tpl_vars['paging']['curr_page']==7){ echo'class="active"';} {/php}><span><a href="{php} echo $url; {/php}page/7/">7</a></span></li>
                            <li {php} if($this->_tpl_vars['paging']['curr_page']==8){ echo'class="active"';} {/php}><span><a href="{php} echo $url; {/php}page/8/">8</a></span></li>
                            <li {php} if($this->_tpl_vars['paging']['curr_page']==9){ echo'class="active"';} {/php}><span><a href="{php} echo $url; {/php}page/9/">9</a></span></li>
                            <li {php} if($this->_tpl_vars['paging']['curr_page']==10){ echo'class="active"';} {/php}><span><a href="{php} echo $url; {/php}page/10/">10</a></span></li>
                            <li {php} if($this->_tpl_vars['paging']['curr_page']==11){ echo'class="active"';} {/php}><span><a href="{php} echo $url; {/php}page/11/">11</a></span></li>
                            <li {php} if($this->_tpl_vars['paging']['curr_page']==12){ echo'class="active"';} {/php}><span><a href="{php} echo $url; {/php}page/12/">12</a></span></li>
                            
                            {php}
                            }else{
                            {/php}
                            
                            {php}
                            for($i=1;$i<=($this->_tpl_vars['paging']['pages']);$i++){
                            	if($this->_tpl_vars['paging']['curr_page']==$i){ 
                                	echo '<li class="active"><span><a href="'.$url.'page/'.$i.'/">'.$i.'</a></span></li>';
                                }else{
                            		echo '<li><span><a href="'.$url.'page/'.$i.'/">'.$i.'</a></span></li>';
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
                                    	echo '<li class="active"><span><a href="'.$url.'page/'.$i.'/">'.$i.'</a></span></li>';
                                    }else{
                                    	echo'<li><span><a href="'.$url.'page/'.$i.'/">...'.$i.'</a></span></li>';   	
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
                                    	echo '<li class="active"><span><a href="'.$url.'page/'.$i.'/">'.$i.'</a></span></li>';
                                    }else{
                                    	echo'<li><span><a href="'.$url.'page/'.$i.'/">...'.$i.'</a></span></li>';   	
                                	}
                                    if(($this->_tpl_vars['paging']['curr_page']>$i)&&($this->_tpl_vars['paging']['curr_page']<($i+12))){
                                    	echo'<li class="active"><span><a href="'.$url.'page/'.$this->_tpl_vars['paging']['curr_page'].'/">'.$this->_tpl_vars['paging']['curr_page'].'</a></span></li>';	
                                    }
                                    
                                    
                                } 
                            	{/php}
                                
                                {php}
                                if($this->_tpl_vars['paging']['curr_page']==$this->_tpl_vars['paging']['pages']){ 
                                	//echo '<li class="active"><span><a href="'.$url.'page/'.$this->_tpl_vars['paging']['pages'].'/">'.$this->_tpl_vars['paging']['pages'].'</a></span></li>';
                                }else{
                                	echo'<li><span><a href="'.$url.'page/'.$this->_tpl_vars['paging']['pages'].'/">...'.$this->_tpl_vars['paging']['pages'].'</a></span></li>';   	
                                }
                                	
                                {/php}
                                
                                
                                
                            {php}
                            }
                            {/php}
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            {php}
                            {/php}
                            <li class="next"><span><a href="{php}  
                            if($this->_tpl_vars['paging']['curr_page']==$this->_tpl_vars['paging']['pages']){ echo ''.$url.'page/'.$this->_tpl_vars['paging']['curr_page'].''; }
                            else{ echo ''.$url.'page/'.($this->_tpl_vars['paging']['curr_page']+1).'/'; }
                             {/php}">next</a></span></li>
                            <li><a href="{php} echo $url; {/php}page/all/">Показать всё</a></li>
                        	{php}
                            }
                            {/php}
                        
                        </ul>
                    </div>
    
    <!--paging-->                   
       