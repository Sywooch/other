<?php
     defined("_JEXEC") or die();
     
     $doc = JFactory::getDocument();
     $doc
        ->addStyleSheet(JUri::base(TRUE)."/templates/".$doc->template."/css/style.css")
        ->addStyleSheet(JUri::base(TRUE)."/templates/".$doc->template."/css/font-awesome.css")
        ->addScript(JUri::base(TRUE)."/templates/".$doc->template."/js/share42.js")
        ->addScript(JUri::base(TRUE)."/templates/".$doc->template."/js/share42_1.js")
        ->addScript(JUri::base(TRUE)."/templates/".$doc->template."/js/script.js");
        //->addFavicon("/images/favicon.ico");
        
    require_once("templates/".$doc->template."/js/ipgeobase.php-master/ipgeobase.php");
    $gb = new IPGeoBase();
    $geo_location = $gb->getRecord($_SERVER['REMOTE_ADDR']);
 ?>
<!doctype html>
<html>
<head>
    <jdoc:include type="head"/>
    <link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
</head>
<body>
    <div id="container">
        <div id="main">
            <div id="clr"></div>
            <div id="header">
                <div id="logo">
                    <a href="index.php"></a>
                    <jdoc:include type="modules" name="logo_menu"/>
                </div>
                <div id="info">
                    <div id="top">
                        <div id="region">
                            <p><?php echo($geo_location[region]);?></p>
                        </div>
                        <div id="search"><jdoc:include type="modules" name="search"/></div>
                        <div id="share"><div class="share42init"></div></div>
                    </div>
                    <div id="down">
                        <div id="main_menu"><jdoc:include type="modules" name="main_menu"/></div>
                        <div id="login">
                            <div id="login_banner"><jdoc:include type="modules" name="login"/></div>
                            <div id="login_button">
                                <div id="wrapper">
                                    <div id="cell">
                                        <p>Вход</p><p>Регистрация</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="clr"></div>
            <div id="main_body">
                
                <div class="map_main"></div>
                
                
                <div id="left_bar">
                    <?php if ($this->countModules('slider')) :?>
                    <jdoc:include type="modules" name="slider"/>
                    <div id="clr"></div>
                    <?php endif;?>
                    
                    

                    <?php if ($this->countModules('first_banner')) :?>
                    <jdoc:include type="modules" name="first_banner"/>
                    <div id="clr"></div>
                    <?php endif;?>
                    

                    
                    <?php if ($this->countModules('event_calendar1')) :?>
                    <jdoc:include type="modules" name="event_calendar1"/>
                    
                    
                    
                    
                    
                    
                    <div class="calendar_container tmp323">
	<div class="calendar">
    	<div class="top">
        <div class="top2" id="top2_id">
        	<?php
			$time = date('d');
			
			
$day[0] = "ВС"; 
$day[1] = "ПН"; 
$day[2] = "ВТ"; 
$day[3] = "СР"; 
$day[4] = "ЧТ"; 
$day[5] = "ПТ"; 
$day[6] = "СБ"; 
	
$week_day[0]="Воскресенье";
$week_day[1]="Понедельник";
$week_day[2]="Вторник";
$week_day[3]="Среда";
$week_day[4]="Четверг";
$week_day[5]="Пятница";	
$week_day[6]="Суббота";			
			
			$day_1=date("w");
			
			
			if(($day_1==0)||($day_1==6)){
			$class="red";		
			}
			else{
			$class="";
			};
			
			
			
			for($i=90;$i>0;$i--){
				$time = date('d', time()-(86400*$i));
				$day_1=date("w", time()-(86400*$i));
				
				if(($day_1==0)||($day_1==6)){
				$class="red";		
				}
				else{
				$class="";
				};
				
				
				//echo substr($_GET['day'],0,10)." --- ".substr(date("Y-m-d H:i:s", time()+(86400*$i)),0,10);
				if((isset($_GET['day']))&&(substr($_GET['day'],0,10)==substr(date("Y-m-d H:i:s", time()-(86400*$i)),0,10) ) ){
					
					echo '<div  style="width: 100px; border-bottom-width: 0px; background-image: none; "  class="date f '.$class.'" id="date_'.$i.'0'.$i.'" onclick="date('.$i.'0'.$i.', \''.date("Y-m-d H:i:s", time()-(86400*$i)).'\');"><span class="date_num">'.$time.'</span>
				<span class="w_num">'.$day[$day_1]."</span>
				</div>";
				
				}else{
				
				echo '<div class="date tmp1 '.$class.'" id="date_'.$i.'0'.$i.'" onclick="date('.$i.'0'.$i.', \''.date("Y-m-d H:i:s", time()-(86400*$i)).'\');"><span class="date_num">'.$time.'</span>
				<span class="w_num">'.$day[$day_1]."</span>
				</div>";
				
				
				}
				
			}
			
			
			
			
			
			$time = date('d', time());
			
			
            
            echo'
            <style type="text/css">
            #date_0{
			width:100px !important;
			margin-left:-2px !important;	
			}
            
            </style>
            ';
          
			
			echo '<div class="date '.$class.' " id="date_0" onclick="date(0, \''.date("Y-m-d H:i:s").'\');" style="background-color:#f5c536; width:100px !important; color:black !important; "><span class="date_num" style="color:#373636;">'.$time.'</span>
			<span class="w_num" style="color:#373636;">'.$week_day[date("w")].'</span>
			</div>';
			
			
			
			
			
			for($i=1;$i<90;$i++){
				$time = date('d', time()+(86400*$i));
				$day_1=date("w", time()+(86400*$i));
				
				if(($day_1==0)||($day_1==6)){
				$class="red";		
				}
				else{
				$class="";
				};
				
				
				//echo substr($_GET['day'],0,10)." --- ".substr(date("Y-m-d H:i:s", time()+(86400*$i)),0,10);
				if((isset($_GET['day']))&&(substr($_GET['day'],0,10)==substr(date("Y-m-d H:i:s", time()+(86400*$i)),0,10) ) ){
					
					
					echo'
					<style type="text/css">
					#date_0{
					background-color:#373636 !important;
					color:#fff;	
					
					}
					
					#date_0 span{
					color:#fff !important;	
					}
					</style>
					
					
					
					';
					
					
					echo '<div style="background-color:#f5c536; color:#373636; margin-left:-2px;"  class="date f '.$class.'" id="date_'.$i.'" onclick="date('.$i.', \''.date("Y-m-d H:i:s", time()+(86400*$i)).'\');"><span class="date_num" style="color:#373636;">'.$time.'</span>
				<span class="w_num" style="color:#373636;">'.$day[$day_1]."</span>
				</div>";
				
				}else{
				
				echo '<div class="date tmp1 '.$class.'" id="date_'.$i.'" onclick="date('.$i.', \''.date("Y-m-d H:i:s", time()+(86400*$i)).'\');"><span class="date_num">'.$time.'</span>
				<span class="w_num">'.$day[$day_1]."</span>
				</div>";
				
				
				}
				
				
				
				
			}
			
			
			?>
        </div>
        
        
        
        </div>
        

        
        
        
    </div>
    
            <div class="button_right" onclick="c_right();"></div>
    		<div class="button_left" onclick="c_left();"></div>
</div>

<script type="text/javascript">                    
 var temp_width=$j(".poster_img").css("width");

function c_right(){
	var $j = jQuery.noConflict();
	//var len=$j('.calendar_container .top2').css('height');
	
	element = document.getElementById('top2_id');
	len = window.getComputedStyle(element).marginLeft;
	len=len.replace("px","");
	
	len=len-50;
	$j('.calendar_container .top2').css({'margin-left' : ''+len+'px'});

}

function c_left(){
	var $j = jQuery.noConflict();
		
	element = document.getElementById('top2_id');
	len = window.getComputedStyle(element).marginLeft;
	
	len=len.replace("px","");
	
	if(len!='0'){
	    len=eval(len)+eval(50);
	    //alert(len);
	    $j('.calendar_container .top2').css({'margin-left' : ''+len+'px'});
    }
	
}





function date(d, date){
    


	var $j = jQuery.noConflict();

	//$j('.calendar_container .top2 .date').css({'width' : '48px'});
	//$j('.calendar_container .top2 #date_'+d+'').css({'width' : '100px'});


	
	$j('.calendar_container .top2 .date').css({'border-bottom-width' : '1px'});
	$j('.calendar_container .top2 #date_'+d+'').css({'border-bottom-width' : '0px'});
	
		$j('.calendar_container .top2 .date').css({'background-color' : '#373636'});
	$j('.calendar_container .top2 #date_'+d+'').css({'background-color' : '#f5c536'});
	
	
		$j('.calendar_container .top2 .date span').css({'color' : '#fff'});
	$j('.calendar_container .top2 #date_'+d+' span').css({'color' : '#373636'});
	
	
$j('.calendar_container .top2 .date').removeClass('f');
$j('.calendar_container .top2 #date_'+d+'').addClass('f');

	$j('.calendar_container .top2 .date').css({'margin-left' : '-2px !important'});


//window.location.href = "/sobytiya?day="+date+";
//document.location.href = "/sobytiya?day="+date+"";
  

   $j.ajax({  
                    type: "POST",  
                    url: "/action/event_date.php",  
                    data: "date="+(date),
	  	 		
                    success: function(html){  
						
					    $j("#event_itemListPrimary").html(html);
						
						
					}  
         });

    


}


                    
</script>                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    <div id="clr"></div>
                    <?php endif;?>
                    
                    
                    <?php if ($this->countModules('news_filter')) :?>
                    
                    
                    
                    <jdoc:include type="modules" name="news_filter"/>
                    
                    <span class="left_button tmp1">НОВОСТИ</span>
                    
                    <div class="news_filter">
                        
                     
                         
                        
                        <select class="category" name="cat[]">
                            <option value="0">Выбор категории</option>
                            
                              <?php
                        
                         $database =& JFactory::getDBO();

		                $database->setQuery("SELECT * FROM #__k2_extra_fields WHERE id='3'");
		                $list = $database->loadObjectList();
        				$i_tmp=0;
		                foreach($list as $it) {
							
                        
                        //echo $it->value;
                        $json=json_decode($it->value); 
						$count_json=count($json);
                        
						for($i=0;$i<$count_json;$i++){
							if(($json[$i]->name)==""){ continue; }
							
							
							
							if(isset($_GET['type'])){
							    if($_GET['type']==($json[$i]->value)){
							       echo '<option value="'.$json[$i]->value.'" selected>'.$json[$i]->name.'</option>';
							 
							    }else{
							       echo '<option value="'.$json[$i]->value.'">'.$json[$i]->name.'</option>';
							  
							    }
							    
							        
							}else{
							
							echo '<option value="'.$json[$i]->value.'" >'.$json[$i]->name.'</option>';
							
							}
						}
						
                        
                        
						}
                        
                        
                        ?>
                            
                           
                        
                        
                        </select>
                        
                        <select class="city" name="city[]">
                            <option value="0">Выбор города в области</option>
                              <?php
                        
                         $database =& JFactory::getDBO();

		                $database->setQuery("SELECT * FROM #__k2_extra_fields WHERE id='2'");
		                $list = $database->loadObjectList();
        				$i_tmp=0;
		                foreach($list as $it) {
							
                        
                        //echo $it->value;
                        $json=json_decode($it->value); 
						$count_json=count($json);
                        
						for($i=0;$i<$count_json;$i++){
							if(($json[$i]->name)==""){ continue; }
							
							
							
							
							if(isset($_GET['city'])){
							    if($_GET['city']==($json[$i]->value)){
							       echo '<option value="'.$json[$i]->value.'" selected>'.$json[$i]->name.'</option>';
							 
							    }else{
							       echo '<option value="'.$json[$i]->value.'">'.$json[$i]->name.'</option>';
							  
							    }
							    
							        
							}else{
							
							echo '<option value="'.$json[$i]->value.'" >'.$json[$i]->name.'</option>';
							
							}
							
							
							
							
							
							//echo '<option value="'.$json[$i]->value.'">'.$json[$i]->name.'</option>';
							
							
							
							
							
						}
						
                        
                        
						}
                        
                        
                        ?>
                           
                        </select>
                        
                        
                        <span class="left_button tmp2">НОВОСТИ</span>
                        <a href="/novosti" class="clear">Сбросить фильтр</a>
                        <span class="search" onClick="news_main_filter();">ПРИМЕНИТЬ ФИЛЬТР</span>
                        
                        
                        
                    </div>
                    
                    
                    
                    
                    
                    <div id="clr" class="tmp2"></div>
                    <?php endif;?>
                   
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    <?php if ($this->countModules('news_filter2')) :?>
                    
                    
                    
                    <jdoc:include type="modules" name="news_filter2"/>
                    
                    <span class="left_button tmp1">СОБЫТИЯ</span>
                    <style type="text/css">
                        #event_info_item .region{
                            display:none;
                            
                        }
                        
                        #event_info_item #event_catItemTags{
                              position: absolute;
  top: 18px;
                        }
                        
                        #event_k2Pagination{
                            margin-top:-11px;
                        }
                        
                    </style>
                    
                    <div class="news_filter">
                        
                     
                         
                        
                        <select class="category" name="cat[]">
                            <option value="0">Выбор категории</option>
                            
                              <?php
                        
                         $database =& JFactory::getDBO();

		                $database->setQuery("SELECT * FROM #__k2_extra_fields WHERE id='5'");
		                $list = $database->loadObjectList();
        				$i_tmp=0;
		                foreach($list as $it) {
							
                        
                        //echo $it->value;
                        $json=json_decode($it->value); 
						$count_json=count($json);
                        
						for($i=0;$i<$count_json;$i++){
							if(($json[$i]->name)==""){ continue; }
							
							
							
							if(isset($_GET['type'])){
							    if($_GET['type']==($json[$i]->value)){
							       echo '<option value="'.$json[$i]->value.'" selected>'.$json[$i]->name.'</option>';
							 
							    }else{
							       echo '<option value="'.$json[$i]->value.'">'.$json[$i]->name.'</option>';
							  
							    }
							    
							        
							}else{
							
							echo '<option value="'.$json[$i]->value.'" >'.$json[$i]->name.'</option>';
							
							}
						}
						
                        
                        
						}
                        
                        
                        ?>
                            
                           
                        
                        
                        </select>
                        
                        <select class="city" name="city[]">
                            <option value="0">Выбор города в области</option>
                              <?php
                        
                         $database =& JFactory::getDBO();

		                $database->setQuery("SELECT * FROM #__k2_extra_fields WHERE id='4'");
		                $list = $database->loadObjectList();
        				$i_tmp=0;
		                foreach($list as $it) {
							
                        
                        //echo $it->value;
                        $json=json_decode($it->value); 
						$count_json=count($json);
                        
						for($i=0;$i<$count_json;$i++){
							if(($json[$i]->name)==""){ continue; }
							
							
							
							
							if(isset($_GET['city'])){
							    if($_GET['city']==($json[$i]->value)){
							       echo '<option value="'.$json[$i]->value.'" selected>'.$json[$i]->name.'</option>';
							 
							    }else{
							       echo '<option value="'.$json[$i]->value.'">'.$json[$i]->name.'</option>';
							  
							    }
							    
							        
							}else{
							
							echo '<option value="'.$json[$i]->value.'" >'.$json[$i]->name.'</option>';
							
							}
							
							
							
							
							
							//echo '<option value="'.$json[$i]->value.'">'.$json[$i]->name.'</option>';
							
							
							
							
							
						}
						
                        
                        
						}
                        
                        
                        ?>
                           
                        </select>
                        
                        
                        <span class="left_button tmp2">СОБЫТИЯ</span>
                        <a href="/novosti" class="clear">Сбросить фильтр</a>
                        <span class="search" onClick="news_main_filter();">ПРИМЕНИТЬ ФИЛЬТР</span>
                        
                        
                        
                    </div>
                    
                    
                    
                    
                    
                    <!--<div id="clr" class="tmp3"></div>-->
                    <?php endif;?>
                   
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                     <?php if ($this->countModules('news_filter3')) :?>
                    
                    
                    
                    <jdoc:include type="modules" name="news_filter3"/>
                    
                    <span class="left_button tmp1">ОБЗОРЫ</span>
                    
                    <div class="news_filter">
                        
                     
                         
                        
                        <select class="category" name="cat[]">
                            <option value="0">Выбор категории</option>
                            
                              <?php
                        
                         $database =& JFactory::getDBO();

		                $database->setQuery("SELECT * FROM #__k2_extra_fields WHERE id='3'");
		                $list = $database->loadObjectList();
        				$i_tmp=0;
		                foreach($list as $it) {
							
                        
                        //echo $it->value;
                        $json=json_decode($it->value); 
						$count_json=count($json);
                        
						for($i=0;$i<$count_json;$i++){
							if(($json[$i]->name)==""){ continue; }
							
							
							
							if(isset($_GET['type'])){
							    if($_GET['type']==($json[$i]->value)){
							       echo '<option value="'.$json[$i]->value.'" selected>'.$json[$i]->name.'</option>';
							 
							    }else{
							       echo '<option value="'.$json[$i]->value.'">'.$json[$i]->name.'</option>';
							  
							    }
							    
							        
							}else{
							
							echo '<option value="'.$json[$i]->value.'" >'.$json[$i]->name.'</option>';
							
							}
						}
						
                        
                        
						}
                        
                        
                        ?>
                            
                           
                        
                        
                        </select>
                        
                        <select class="city" name="city[]">
                            <option value="0">Выбор города в области</option>
                              <?php
                        
                         $database =& JFactory::getDBO();

		                $database->setQuery("SELECT * FROM #__k2_extra_fields WHERE id='2'");
		                $list = $database->loadObjectList();
        				$i_tmp=0;
		                foreach($list as $it) {
							
                        
                        //echo $it->value;
                        $json=json_decode($it->value); 
						$count_json=count($json);
                        
						for($i=0;$i<$count_json;$i++){
							if(($json[$i]->name)==""){ continue; }
							
							
							
							
							if(isset($_GET['city'])){
							    if($_GET['city']==($json[$i]->value)){
							       echo '<option value="'.$json[$i]->value.'" selected>'.$json[$i]->name.'</option>';
							 
							    }else{
							       echo '<option value="'.$json[$i]->value.'">'.$json[$i]->name.'</option>';
							  
							    }
							    
							        
							}else{
							
							echo '<option value="'.$json[$i]->value.'" >'.$json[$i]->name.'</option>';
							
							}
							
							
							
							
							
							//echo '<option value="'.$json[$i]->value.'">'.$json[$i]->name.'</option>';
							
							
							
							
							
						}
						
                        
                        
						}
                        
                        
                        ?>
                           
                        </select>
                        
                        
                        <span class="left_button tmp2">ОБЗОРЫ</span>
                        <a href="/novosti" class="clear">Сбросить фильтр</a>
                        <span class="search" onClick="news_main_filter();">ПРИМЕНИТЬ ФИЛЬТР</span>
                        
                        
                        
                    </div>
                    
                    
                    
                    
                    
                    <div id="clr" class="tmp4"></div>
                    <?php endif;?>
                   
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    <?php if ($this->countModules('event_calendar')) :?>
                    <jdoc:include type="modules" name="event_calendar"/>
                    <div id="clr" class="tmp5"></div>
                    <?php endif;?>
                    
                    <?php if ($this->countModules('k2_search')) :?>
                    <jdoc:include type="modules" name="k2_search"/>
                    <div id="clr" class="tmp6"></div>
                    <?php endif;?>
                    
                    <div id="content_container"><jdoc:include type="component" /></div>
                    
                    <?php if ($this->countModules('event_menu')) :?>
                    <div id="main_events">
                        <a class="hover1 hover" href="/sobytiya"></a>
                        <a class="hover2 hover" href="/novosti"></a>
                        <a class="hover3 hover" href="/obzory"></a>
                        <jdoc:include type="modules" name="event_menu"/>
                        <jdoc:include type="modules" name="events"/>
                    </div>
                    <div id="clr" class="tmp7"></div>
                    <?php endif;?>
                    
                    <?php if ($this->countModules('second_banner')) :?>
                    <jdoc:include type="modules" name="second_banner"/>
                    <div id="clr" class="tmp8"></div>
                    <?php endif;?>
                    
                    
                    
                    <jdoc:include type="modules" name="center_banner"/>
                    
                    
                    <?php if ($this->countModules('coupons')) :?>
                    <div id="coupons">
                         
                    </div>
                    <div id="clr" class="tmp9"></div>
                    <?php endif;?>
                    
                    <?php if ($this->countModules('third_banner')) :?>
                    <jdoc:include type="modules" name="third_banner"/>
                    <div id="clr" class="tmp10"></div>
                    <?php endif;?>
                    
                    
                    <?php if ($this->countModules('interactive')) :?>
                    <div class="container_interactive">
                        <div class="image1 image">
                            <a class="hover1 hover" href="/sobytiya"></a>
                        </div>
                        
                        <div class="image2 image">
                            <a class="hover2 hover" href="/sobytiya"></a>
                            
                        </div>
                        <div class="image3 image">
                            <a class="hover3 hover" href="/sobytiya"></a>
                            
                        </div>
                        <jdoc:include type="modules" name="interactive"/>
                    </div>
                    <div id="clr" class="tmp11"></div>
                    <?php endif;?>
                    
                    
                </div>
                <div id="right_bar">
                    <div id="categiry_menu">
                        <jdoc:include type="modules" name="category_list"/>
                        <div id="add_org" class="left_side"><p>добавить организацию</p></div>
                    </div>
                    <div id="clr"></div>
                    
                    <?php if ($this->countModules('video_day')) :?>
                    <div id="right_share">
                        <div class="share42init2" data-icons-file="my-icons.png"></div>
                    </div>
                    <div id="clr"></div>
                    <?php endif;?>
                    
                    <?php if ($this->countModules('video_day')) :?>
                    <jdoc:include type="modules" name="video_day"/>
                    <div id="clr"></div>
                    <?php endif;?>
                    
                    <?php if ($this->countModules('right_menu')) :?>
                    <jdoc:include type="modules" name="right_menu"/>
                    <div id="clr"></div>
                    <?php endif;?>
                    
                    <?php if ($this->countModules('weather')) :?>
                    <jdoc:include type="modules" name="weather"/>
                    <div id="clr"></div>
                    <?php endif;?>
                    
                    <div id="last_forum_post">
                        <span class="head">СВЕЖИЕ КОММЕНТЫ</span>
                        <jdoc:include type="modules" name="last_comment"/>
                        
                        
                    </div>
                    <div id="clr"></div>
                    <div id="last_comment">
                        
                        <jdoc:include type="modules" name="last_material"/>
                    </div>
                </div>
            </div>
            <!--div id="sailing_slader">
                <?php //echo("<script src='/templates/".$doc->template."/js/jquery.cycle2.carousel.js' type='text/javascript'>");?></script>
            </div-->
            <div id="clr"></div>
            
            
            <?php if ($this->countModules('carusel')) :?>
            <div class="carusel">
                <jdoc:include type="modules" name="carusel"/>
                
                
            </div>
            <?php endif;?>
            
            
            
            
            
            <div id="footer">
                <!--?php
                    require_once("templates/".$doc->template."/js/ipgeobase.php-master/ipgeobase.php");
                    $gb = new IPGeoBase();
                    $data = $gb->getRecord($_SERVER['REMOTE_ADDR']);
                    var_dump($data);
                ?-->
                <div id="footer_right_bar">
                    <jdoc:include type="modules" name="footer_main_menu" style="xhtml"/>
                    <!--jdoc:include type="modules" name="add_org"/-->
                    <div id="add_org" style="float: left;"><p>добавить организацию</p></div>
                </div>
                <jdoc:include type="modules" name="footer_publishers_menu" style="xhtml"/>
                <div id="footer_left_bar">
                    <jdoc:include type="modules" name="footer_subscribe"/>
                    <div id="clr"></div>
                    <div id="footer_copyright">
                        <div id="footer_share">
                            <div class="share42init"></div>
                        </div>
                        <div id="grey_line"></div>
                        <div id="copyright">
                            <p>2015  ©  Все права защищены</p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="clr"></div>
        </div>
    </div>
    
    
    
    
    <script type="text/javascript">
        var $j3 = jQuery.noConflict(); 
$j3('#main_events .item-312 img').hover(function(){

$j3("#main_events .hover.hover1").css({'display' : 'block'});

},function(){

$j3("#main_events .hover.hover1").css({'display' : 'block'});

}); 
        

$j3('#main_events .item-313 img').hover(function(){

$j3("#main_events .hover.hover2").css({'display' : 'block'});

},function(){

$j3("#main_events .hover.hover2").css({'display' : 'block'});

}); 


$j3('#main_events .item-314 img').hover(function(){

$j3("#main_events .hover.hover3").css({'display' : 'block'});

},function(){

$j3("#main_events .hover.hover3").css({'display' : 'block'});

}); 




$j3("#main_events .hover.hover1").mouseout(function(){

$j3("#main_events .hover.hover1").css({'display' : 'none'});

}); 

$j3("#main_events .hover.hover2").mouseout(function(){

$j3("#main_events .hover.hover2").css({'display' : 'none'});

});

$j3("#main_events .hover.hover3").mouseout(function(){

$j3("#main_events .hover.hover3").css({'display' : 'none'});

});



    </script>
    
    <script type="text/javascript">
        var $j3 = jQuery.noConflict();     
  /*  $j3('.container_interactive .image1').hover(function(){
        $j3(".container_interactive .hover1").css({'display' : 'block'});
    });
    
    $j3('.container_interactive .image2').hover(function(){
        $j3(".container_interactive .hover2").css({'display' : 'block'});
    });
    
    $j3('.container_interactive .image3').hover(function(){
        $j3(".container_interactive .hover3").css({'display' : 'block'});
    });
    
    
    $j3(".container_interactive .hover1").mouseout(function(){
        $j3(".container_interactive .image .hover1").css({'display' : 'none'});
    });
    
    $j3(".container_interactive .hover2").mouseout(function(){
        $j3(".container_interactive .image .hover2").css({'display' : 'none'});
    });
    
    $j3(".container_interactive .hover3").mouseout(function(){
        $j3(".container_interactive .image .hover3").css({'display' : 'none'});
    });*/
    </script>
    
<script type="text/javascript">
var $j3 = jQuery.noConflict();      
  
$j3(".map_main").click(function(){  
    
   $j3(".map_main").slideUp();
    
}); 

$j3("#region p").click(function(){ 
    
var visible1=$j3(".map_main").css('display');
if(visible1=="none"){
$j3(".map_main").slideDown();
}else{
$j3(".map_main").slideUp();
}    
    
}); 
   
</script>

<script type="text/javascript">
var $j3 = jQuery.noConflict(); 
function news_main_filter(){
	var type=$j3(".category").val();
	var type_text=$j3(".category option:selected").text();
	
	var city=$j3(".city").val();
	var city_text=$j3(".city option:selected").text();
	if((type=="0")&&(city="0")){
	alert("Не выбран ни один критерий фильтрации.");	
	}else{
	    if(type=="0"){ type="all"; type_text="all"; }
	    if(city=="0"){ city="all"; city_text="all"; }
	    
		window.location.href = "/novosti?type="+type+"&type_text="+type_text+"&city="+city+"&city_text="+city_text+"";
	}
	
}
</script>

<!--
<script type="text/javascript">
var $j = jQuery.noConflict(); 
$j(".slider-thumb-preview-navigation-main div:nth-child(2)").css({'color' : 'transparent'});

</script>
-->
</body>
</html>