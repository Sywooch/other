<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				{php}
				$raw_data=$this->page->top_menu;
					$s=1;
                   foreach ($raw_data as $k=>$v) {
						
                        if($v['parent']!=0) continue;
						
                        /*if(count($v['children'])>0){
						echo ' <li class="dropdown"><a class="link_1" href="'.$v['url'].'">'.$v['title'].'</a><a  class="dropdown-toggle" data-toggle="dropdown"><strong class="caret"></strong></a>';
						echo '<ul class="dropdown-menu second_nav">';
							foreach ($v['children'] as $key=>$val) {
								echo '<li><a href="'.$val['url'].'">'.$val['title'].'</a></li>';
							}	
                          echo  '</ul>';
						echo '</li>';
						}else{
						*/	
                        	unset($child);
                            $i=0;
                        	foreach ($raw_data as $k2=>$v2) {
                            	//echo "==".$v2['parent']."-".$v['id']."==";
                            	if($v2['parent']==$v['id']){
                                	$child[$i]['text']=$v2['text'];
                                    $child[$i]['link']=$v2['link'];
                                    $child[$i]['id']=$v2['id'];
                                }
                                $i++;	
                            }
                            //echo "<pre>";
                            //print_r($child);
                            //echo "</pre>";
                        	
							if(count($child)==0){
                            	echo ' <li><a href="'.$v['link'].'">'.$v['text'].'</a></li>';
							}else{
                          		echo ' <li class="dropdown"><a class="link_1 dropdown-toggle" href="#" data-toggle="dropdown">'.$v['text'].'</a><a class="dropdown-toggle" data-toggle="dropdown"><strong class="caret"></strong></a>';
								echo '<ul class="dropdown-menu second_nav">';
                                //href="'.$v['link'].'"
                                $v['text']=str_replace("Каталог","Все коллекции",$v['text']);
                                echo '<li><a href="'.$v['link'].'" id="id_'.$v['id'].'">'.$v['text'].'</a></li>';
								foreach ($child as $key_ch=>$val_ch) {
									echo '<li><a href="'.$val_ch['link'].'" id="id_'.$val_ch['id'].'">'.$val_ch['text'].'</a></li>';
								}	
                          		echo  '</ul>';
								echo '</li>';  
                            }
                    	/*
                    	}
                        */
					}
				{/php}




                   <!--
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Каталог<strong class="caret"></strong></a>
                            <ul class="dropdown-menu second_nav">
                                <li><a href="#">Все коллекции</a></li>
                                <li class="second_nav_item1"><a href="#">Новинки</a></li>
                                <li class="second_nav_item2"><a href="#">Распродажа</a></li>
                                <li class="second_nav_item3"><a href="#">Акции</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Сотрудничество</a>
                        </li>
                        <li class="dropdown">
                             <a href="#" class="dropdown-toggle" data-toggle="dropdown">О компании<strong class="caret"></strong></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#">1</a>
                                </li>
                                <li>
                                    <a href="#">2</a>
                                </li>
                                <li>
                                    <a href="#">3</a>
                                </li>
                                <li>
                                    <a href="#">4</a>
                                </li>
                                <li>
                                    <a href="#">5</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Контакты</a>
                        </li>
                   
--> </ul>

                </div>