<?php
/**
 * @package     Ghost_Russia.JoomlaSite
 * @subpackage  Templates.Ghost_Russia.infinitilife
 *
 * @copyright   Copyright (C) 2007 - 2015 Ghost_Russia. All rights reserved.
 */

defined('_JEXEC') or die;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$user            = JFactory::getUser();
$this->language  = $doc->language;
$this->direction = $doc->direction;


// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/jquery-ui.js');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/jquery.cycle2.js');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js//jquery.cycle2.carousel.js');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/jquery.cycle2.tile.js');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/script.js');

// Add Stylesheets
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/fonts/fonts.css');
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/style.css');
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/media-queries.css');

?>


<?php

if( (!isset($_GET['localion'])) || ($_GET['localion']=="") || ($_GET['localion']==NULL) ){
    
    $_GET['localion']="17";
}




?>




<!DOCTYPE html>
<html>
<head>
	<title><?php echo $this->getTitle(); ?></title>
	<meta name="viewport" content="width=1110">
	<jdoc:include type="head" />
    <script type="text/javascript" src="<?php echo $this->baseurl . '/templates/' . $this->template ; ?>/js/jquery.pickmeup.js"></script>
    <link rel="stylesheet" href="<?php echo $this->baseurl . '/templates/' . $this->template; ?>/css/pickmeup.css" type="text/css" />
	<!--[if lt IE 7]>
	<script src="<?php echo $this->baseurl . '/templates/' . $this->template . '/js'; ?>/IE7.js"></script>
	<![endif]-->
	<!--[if lt IE 8]>
	<script src="<?php echo $this->baseurl . '/templates/' . $this->template . '/js'; ?>/IE8.js"></script>
	<![endif]-->
	<!--[if lt IE 9]>
	<script src="<?php echo $this->baseurl . '/templates/' . $this->template . '/js'; ?>/IE9.js"></script>
	<![endif]-->
	<!--[if lt IE 9]>
	<script src="<?php echo $this->baseurl . '/templates/' . $this->template . '/js'; ?>/html5.js"></script>
	<![endif]-->
	<!--[if lt IE 9]>
	<script src="<?php echo $this->baseurl . '/templates/' . $this->template . '/js'; ?>/css3-mediaqueries.js"></script>
	<![endif]-->
    
<!--<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
-->

<script src="/js/jquery.nicescroll.js"></script>

<script type="text/javascript">


var $j2 = jQuery.noConflict();

$j2(document).ready(

  function() { 

    $j2("html").niceScroll();

  }

);

</script>

<script type="text/javascript">
    
var $j2 = jQuery.noConflict();



function show_modal1(){
 
   $j2(".modal_1").css({'display' : 'block'}); 

}

function show_modal2(){


   $j2(".modal2").css({'display' : 'block'}); 

}


function modal_hide(){
    
    $j2(".modal_1").css({'display' : 'none'}); 
}


    
</script>
<!--
<script src="/js/jquery.simplyscroll.min.js" type="text/javascript"></script>
-->


 <link rel="stylesheet" href="/css/fonts.css" type="text/css" />



</head>
<body>
    



<!--
<div class="modal2">    




</div>    
    -->

<div class="list_comments2">
    
    
</div>


<div class="black1">




<a href="#" class="link" download></a>
<div class="share"></div>
<script type="text/javascript">// <![CDATA[
(function() {
  if (window.pluso)if (typeof window.pluso.start == "function") return;
  if (window.ifpluso==undefined) { window.ifpluso = 1;
    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
    s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
    var h=d[g]('body')[0];
    h.appendChild(s);
  }})();
// ]]></script>
<div class="pluso" data-background="transparent" data-options="small,square,line,horizontal,counter,theme=04" 
data-services="vkontakte,odnoklassniki,facebook,twitter,google,moimir,email,print"></div>

<input type="button" class="comments" value="Комментарии"/>

<div class="votes1"></div>




</div>


<div class="gallery_bar">
    
    <div class="gallery_bar2">
    </div>
        
    <div class="bar_prev"></div>
    <div class="bar_next"></div>
    
    <div class="blue_border" style="display:none;"></div>    
    
    
    
</div>


    
    
    
<div class="header">
	
		<div class="logo"><a href=""></a></div>
		<div class="noresize">
			<div>
				<div class="map">
					<span>
						Амурская обл.
					</span>
					<div class="fullmap">
					    <span class="head">Выберите ваш регион и город:</span>
					    <span class="text">ВЫБРАТЬ ГОРОД ИЗ СПИСКА</span>
					    <img class="block_map" src="/templates/infinitilife/images/map1.png"/>
					    
					    
					    
					    
					    
					    
					    
					    
					    
					    
					</div>
				</div>
                
                <div style="display:none;">
                <img src="/templates/infinitilife/images/social_1.png" alt="" title=""/>
                <img src="/templates/infinitilife/images/social_2.png" alt="" title=""/>
                <img src="/templates/infinitilife/images/social_3.png" alt="" title=""/>
                <img src="/templates/infinitilife/images/social_4.png" alt="" title=""/>
                <img src="/templates/infinitilife/images/social_5.png" alt="" title=""/>
                <img src="/templates/infinitilife/images/social_6.png" alt="" title=""/>
                <img src="/templates/infinitilife/images/social_7.png" alt="" title=""/>
                </div>
                
                <jdoc:include type="modules" name="HeaderNoresize" style="no" />
				<!--<div class="social">
					<a href="" class="ok"></a>
					<a href="" class="instagram"></a>
					<a href="" class="vk"></a>
					<a href="" class="fb"></a>
					<a href="" class="twitter"></a>
					<a href="" class="youtube"></a>
					<a href="" class="google"></a>
				</div>
				<div class="search">
					<form action="">
						<input type="text" placeholder="Поиск">
						<input type="submit" onclick="return false;">
					</form>
				</div>-->
			</div>
		</div>
		<div class="other">
			<div>
				<jdoc:include type="modules" name="HeaderOther" style="no" />

				<div class="mypage">
				    <div class="clicked">
						<table border="0" cellpadding="0" cellspacing="0">
							<tr>
								
								<?php
								$user =& JFactory::getUser();
								 if ($user->guest){
								     
								?>
								
								<td>
								 
								     <div style="float:left;cursor:pointer; float:left;" onclick="show_modal1();" class="popup_auth">Авторизация</div>
								   <!-- 	<div  style="float:left; margin-left:10px; cursor:pointer;" onclick="show_modal2();">Регистрация</div>-->
									
									<jdoc:include type="modules" name="reg_modal" style="no" />

                                    <jdoc:include type="modules" name="reg_modal2" style="no" />    

								     
								     
									
									<!--<div><a href="">Авторизация</a></div>
									<div><a href="/registratsiya">Регистрация</a></div>-->
								</td>
								<td>
									<!--<div class="avatar"><img src="" alt=""></div>-->
								</td>
								
								
								<?php
								 }else{
								
								?>
								
								
								<td>
									<div><a href="/component/users/profile.html">Моя страница</a></div>
									<div><a href="">Найти друзей</a></div>
								</td>
								<td>
									<div class="avatar"><?php $tmp_id=$user->get('id'); 
									
										$database = JFactory::getDbo();
		                                $database->setQuery("SELECT * FROM #__k2_users WHERE userID=".$tmp_id."");
		                                $list = $database->loadObjectList();
                                        $url_avatar="";
		                                foreach($list as $it){
		                               
		                                    $url_avatar=$it->image;
		                                    
		                                }
		
									
									
									?><a href="/component/users/profile.html"><img src="/media/k2/users/<?php echo $url_avatar; ?>" alt=""></a></div>
								</td>
								
								<?php
								 }
								?>
								
							</tr>
						</table>
					</div>
				<!--	<div class="mypagefull">
						<div class="profile">
							<div class="avatar"><img src="" alt=""></div>
							<div class="text">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td>Имя:</td>
										<td>Руслан Живой</td>
									</tr>
									<tr>
										<td>Логин:</td>
										<td>JivoyRusik13</td>
									</tr>
									<tr>
										<td>Город:</td>
										<td>Благовещенск</td>
									</tr>
									<tr>
										<td>СП:</td>
										<td>в активном поиске</td>
									</tr>
								</table>
								<div class="status">“Тут такой крутой статус прям ваапщетакой крутой”</div>
							</div>
						</div>
						<div class="profilebtn">
							<ul>
								<li><a href="">Test 1</a></li>
								<li><a href="">Test 2</a></li>
								<li><a href="">Test 3</a></li>
								<li><a href="">Test 4</a></li>
								<li><a href="">Test 5</a></li>
								<li><a href="">Test 6</a></li>
								<li><a href="">Test 7</a></li>
								<li><a href="">Test 8</a></li>
							</ul>
						</div>
					</div>
				</div>-->
				
				
				
				
				</div>
				
				
				<div class="radio">
					<div class="clicked">
						<div class="img"></div>
						<div class="text">Радио онлайн</div>
					</div>
					<div class="radiochosefull">
						<ul>
							<li><a href="">Item 1</a></li>
							<li><a href="">Item 2</a></li>
							<li><a href="">Item 3</a></li>
							<li><a href="">Item 4</a></li>
							<li><a href="">Item 5</a></li>
						</ul>
					</div>
					<div class="radioplayerfull">
						
					</div>
				</div>
				
				
				
				
				
			</div>
		</div>
        
        
        
		
	</div>
	<div class="center">
		<div class="leftmenu">
            <jdoc:include type="modules" name="leftmenu" style="no" />
		</div>
        <?php if ($this->countModules('rightmenu')) : ?>
            <div class="rightmenu">
                <jdoc:include type="modules" name="rightmenu" style="well" />
            </div>
        <?php endif; ?>
        <div class="fixed"> 
        <jdoc:include type="modules" name="slider-photo" style="no" />
        </div>
        
        
		<div class="content" <?php if ($this->countModules('rightmenu')) echo 'style="padding-right: 75px;"'; ?>>
<?php if ($this->countModules('content-topleft') && $this->countModules('content-topright') && $this->countModules('content-bottom')) : ?>


			<div class="content-top">
				<div>
                    <jdoc:include type="modules" name="content-topleft" style="no" />
				</div>
				<div>
                    <jdoc:include type="modules" name="content-topright" style="no" />
				</div>
			</div>
			<div class="content-center">
                <jdoc:include type="modules" name="content-center" style="no" />
                
                <?php
				$menu = JSite::getMenu();
				if ($menu->getActive() == $menu->getDefault()) {
				?>
                
                
 <!--         
               <div id="bottom10">
			<script type="text/javascript">
			var $j = jQuery.noConflict();*/
			(function($j) {
				$j(function() {
					$j("#scroller").simplyScroll({
       		 		autoMode: 'loop',
        			width: 3000,
        			startOnLoad: true
        			});
				});
			})(jQuery);
			

			</script>

<div class="simply-scroll simply-scroll-container">
    
    <div class="simply-scroll-clip">
    
    
   <ul id="scroller" class="scroller bannergroup width100 simply-scroll-list" style="width: 2924px;">
 
							<li class="banneritem" style="">
							
																																	<img src="http://hi-news.info/images/scrolllogos/image5.png" alt="logo5" style="opacity: 1; visibility: visible;">
										</li>
							<li class="banneritem" style="">
							
																																	<img src="http://hi-news.info/images/scrolllogos/image6.png" alt="logo6" style="opacity: 1; visibility: visible;">
										</li>
							<li class="banneritem" style="">
							
																																	<img src="http://hi-news.info/images/scrolllogos/image7.png" alt="logo7" style="opacity: 1; visibility: visible;">
										</li>
							<li class="banneritem" style="">
							
																																																		<a href="/component/banners/click/20" target="_blank" title="logo8">
							<img src="http://hi-news.info/images/scrolllogos/image8.png" alt="logo8" style="opacity: 1; visibility: visible;">
						</a>
															</li>
							<li class="banneritem" style="">
							
																																	<img src="http://hi-news.info/images/scrolllogos/image1.png" alt="logo1" style="opacity: 1; visibility: visible;">
										</li>
							<li class="banneritem" style="">
							
																																	<img src="http://hi-news.info/images/scrolllogos/image2.png" alt="logo2" style="opacity: 1; visibility: visible;">
										</li>
							<li class="banneritem" style="">
							
																																	<img src="http://hi-news.info/images/scrolllogos/image3.png" alt="logo3" style="opacity: 1; visibility: visible;">
										</li>
							<li class="banneritem" style="">
							
																																																		<a href="/component/banners/click/16" target="_blank" title="logo4">
							<img src="http://hi-news.info/images/scrolllogos/image4.png" alt="logo4" style="opacity: 1; visibility: visible;">
						</a>
															</li>
							<li class="banneritem" style="">
							
																																	<img src="http://hi-news.info/images/scrolllogos/image9.png" alt="logo9" style="opacity: 1; visibility: visible;">
										</li>
							<li class="banneritem" style="">
							
																																																		<a href="/component/banners/click/22" target="_blank" title="logo10 - rh">
							<img src="http://hi-news.info/images/scrolllogos/rh.png" alt="logo10 - rh" style="opacity: 1; visibility: visible;">
						</a>
															</li>

<li class="banneritem" style="">
							
																																	<img src="http://hi-news.info/images/scrolllogos/image5.png" alt="logo5" style="opacity: 0; visibility: hidden;">
										</li><li class="banneritem" style="">
							
																																	<img src="http://hi-news.info/images/scrolllogos/image6.png" alt="logo6" style="opacity: 0; visibility: hidden;">
										</li><li class="banneritem" style="">
							
																																	<img src="http://hi-news.info/images/scrolllogos/image7.png" alt="logo7" style="opacity: 0; visibility: hidden;">
										</li><li class="banneritem" style="">
							
																																																		<a href="/component/banners/click/20" target="_blank" title="logo8">
							<img src="http://hi-news.info/images/scrolllogos/image8.png" alt="logo8" style="opacity: 0; visibility: hidden;">
						</a>
															</li><li class="banneritem" style="">
							
																																	<img src="http://hi-news.info/images/scrolllogos/image1.png" alt="logo1" style="opacity: 0; visibility: hidden;">
										</li><li class="banneritem" style="">
							
																																	<img src="http://hi-news.info/images/scrolllogos/image2.png" alt="logo2" style="opacity: 0; visibility: hidden;">
										</li><li class="banneritem" style="">
							
																																	<img src="http://hi-news.info/images/scrolllogos/image3.png" alt="logo3" style="opacity: 0; visibility: hidden;">
										</li>
										
										
										</ul>
										
										
										</div>
										
										
										</div>
										
										</div> 
                
           -->
                
                <?php
				}
				
				?>
                
                
                
            </div>
			<div class="content-bottom tmp5">
                <jdoc:include type="modules" name="content-bottom" style="no" />
			</div>
<?php else : ?>


<jdoc:include type="modules" name="afisha-slider-left" style="no" />
<jdoc:include type="modules" name="afisha-slider-right" style="no" />

<jdoc:include type="modules" name="afisha-calendar" style="no" />


<?php
$currentMenuId = JSite::getMenu()->getActive()->id;
if($currentMenuId == 121){
	setlocale(LC_ALL, 'rus');
?>
<div class="calendar_container">
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
			
			
			$day_1=date("w");
			
			
			if(($day_1==0)||($day_1==6)){
			$class="red";		
			}
			else{
			$class="";
			};
			
			echo '<div class="date '.$class.' " id="date_0" onclick="date(0, \''.date("Y-m-d H:i:s").'\');" style="width:100px !important; color:black !important; /* background-image: none; border-bottom-width:0px;*/"><span class="date_num">'.$time.'</span>
			<span class="w_num">Сегодня</span>
			</div>';
			for($i=1;$i<30;$i++){
				$time = date('d', time()+(86400*$i));
				$day_1=date("w", time()+(86400*$i));
				
				if(($day_1==0)||($day_1==6)){
				$class="red";		
				}
				else{
				$class="";
				};
				
				echo '<div class="date '.$class.'" id="date_'.$i.'" onclick="date('.$i.', \''.date("Y-m-d H:i:s", time()+(86400*$i)).'\');"><span class="date_num">'.$time.'</span>
				<span class="w_num">'.$day[$day_1]."</span>
				</div>";
			}
			
			
			?>
        </div>
        
        
        
        </div>
        
        <div class="bottom">
<span class="date datepick tmp1"><a>Выбрать дату</a><input type="hidden" class="datepickhidden" value=""></span>
        
        
        <?php
		//вывод подкатегорий
		$database2 = JFactory::getDbo();
		$database2->setQuery("SELECT * FROM #__k2_categories WHERE parent=5");
		$list2 = $database2->loadObjectList();
 
		foreach($list2 as $it) { 
		
		if( (isset($_GET['subcategory'])) && ($_GET['subcategory']==($it->id)) ){
		    
		echo'<span class="cat_name tmp0" style="text-decoration:underline;"><a href="/afisha.html?subcategory='.$it->id.'&localion='.$_GET['localion'].'&location_name='.$_GET['location_name'].'">'.$it->name.'</a></span>';
		
		}else{
		
		echo'<span class="cat_name tmp0"><a href="/afisha.html?subcategory='.$it->id.'&localion='.$_GET['localion'].'&location_name='.$_GET['location_name'].'">'.$it->name.'</a></span>';
		
		}
		
		
		}
		
		?>
        
        
        </div>
        
        
        
        
    </div>
    
            <div class="button_right" onclick="c_right();"></div>
    		<div class="button_left" onclick="c_left();"></div>
</div>

<div class="poster_items">

<?php
$database = JFactory::getDbo();

if( (isset($_GET['subcategory'])) ){
		    
    $database->setQuery("SELECT * FROM #__k2_items WHERE catid=".$_GET['subcategory']." AND published=1 AND trash=0");
	
}else{
		
    $database->setQuery("SELECT * FROM #__k2_items WHERE catid=5 AND published=1 AND trash=0");
		
}

$list = $database->loadObjectList();
 
foreach($list as $it) { 
   
   
   $hash = md5('Image'.$it->id);
	//echo $hash;
?>


<?php

//echo $it->publish_up;
//echo"<br>";
//echo $it->publish_down;
//echo"<br>";


if( (isset($_GET['day'])) ){
    
$today=$_GET['day'];
//echo $today;
}
else{
$today=date("Y-m-d H:i:s");
}//echo $today;

$result=(($it->publish_up)<$today);
$result2=($today<($it->publish_down));

for($i_1=0;$i_1<30;$i_1++){
//$tmp_date=("Y-m-d H:i:s", time()+(86400*$i_1));
$day_7=date("Y-m-d H:i:s", time()+(86400*$i_1));


$result=(($it->publish_up)<$today);
$result2=($today<($it->publish_down));

if(($result==true)&&($result2==true)){ break; };
}






if(($result==true)&&($result2==true)){
	

?>



<div class="poster_img tmp33" >
<div class="poster_img2" style="background-image:url(/media/k2/items/src/<?php echo $hash;?>.jpg);">
<a href="/component/k2/item/<?php echo $it->id;  ?>-<?php echo $it->alias; ?>" style="width:100%; height:100%; display:block;"></a>
</div>
</div>



































<script type="text/javascript">
var $j2 = jQuery.noConflict();
    var temp_width=$j2(".poster_img").css("width");
    //alert(temp_width);
    //var temp_height=temp_width*2;
    
     $j2(".poster_img").css({"height" : "calc("+temp_width+" * 1)"});
    
    
</script>




<?php
}
?>



<?php	
	
	
}

?>




<!-- поиск по подкатегориям --->


<?php


if( (isset($_GET['subcategory'])) ){
    

}else{

// получение идентификаторов дочерних категорий категории Афиши
$database->setQuery("SELECT * FROM #__k2_categories WHERE parent=5 AND published=1 AND trash=0");
$list = $database->loadObjectList();
 
foreach($list as $it) { 

$sub_cat_id=$it->id;


    $database2 = JFactory::getDbo();
     $database2->setQuery("SELECT * FROM #__k2_items WHERE catid=".$sub_cat_id." AND published=1 AND trash=0");
     
    $list2 = $database2->loadObjectList();
    
    foreach($list2 as $it2) {
    
       $hash2 = md5('Image'.$it2->id);
    
    
    
    ?>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
  
<?php

//echo $it->publish_up;
//echo"<br>";
//echo $it->publish_down;
//echo"<br>";


if( (isset($_GET['day'])) ){
    
$today=$_GET['day'];
//echo $today;
}
else{
$today=date("Y-m-d H:i:s");
}//echo $today;

$result=(($it2->publish_up)<$today);
$result2=($today<($it2->publish_down));

for($i_1=0;$i_1<30;$i_1++){
//$tmp_date=("Y-m-d H:i:s", time()+(86400*$i_1));
$day_7=date("Y-m-d H:i:s", time()+(86400*$i_1));


$result=(($it2->publish_up)<$today);
$result2=($today<($it2->publish_down));

if(($result==true)&&($result2==true)){ break; };
}






if(($result==true)&&($result2==true)){
	

?>



<div class="poster_img tmp35" >
    
<a href="/component/k2/item/<?php echo $it2->id;  ?>-<?php echo $it2->alias; ?>" style="width:100%; height:100%; display:block;">
<img class="poster_img2" src="/media/k2/items/src/<?php echo $hash2;?>.jpg"/>
</a>

</div>



















<script type="text/javascript">
var $j2 = jQuery.noConflict();
    var temp_width=$j2(".poster_img").css("width");
    //alert(temp_width);
    //var temp_height=temp_width*2;
    
     $j2(".poster_img").css({"height" : "calc("+temp_width+" * 1)"});
    
    
</script>




<?php
}
?>


  
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <?php
    
    
    
    
    
    }
    
    
}






}


?>



















</div>








<div class="main_afisha_banners">

<?php
    $database =& JFactory::getDBO();

		
		$database->setQuery("SELECT * FROM #__banners WHERE catid='17'");
		$list = $database->loadObjectList();
 
		foreach($list as $it) {
		    
		    $url=$it->params;
		    $m=explode('":"',$url);
		    $url=$m[1];
		    $m=explode('","',$url);
		    $url=$m[0];
		    $url=str_replace("\\","",$url);
		    
		    $width=$it->params;
		    $m=explode(',"',$width);
		    $width=$m[1];
		    $m=explode('":',$width);
		    $width=$m[1];
		    
		    $height=$it->params;
		    $m=explode(',"',$height);
		    $height=$m[2];
		    
		    $m=explode('":',$height);
		    $height=$m[1];
		   
		    
 ?>

  <?php
  if($it->clickurl==""){
	  
	  ?>
	<img src="<?php echo $url; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="" title=""/>  
    <?php
  }else{
	?>  
   <a href="<?php echo $it->clickurl; ?>"><img src="<?php echo $url; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="" title=""/></a>    
  
  <?php
  
  }
  
  ?>
 
 <?php
 	  	 
        
		}
        ?>
        
        




</div>






<script type="text/javascript">
 var temp_width=$j(".poster_img").css("width");

function c_right(){
	var $j = jQuery.noConflict();
	//var len=$j('.calendar_container .top2').css('height');
	
	element = document.getElementById('top2_id');
	len = window.getComputedStyle(element).marginLeft;
	len=len.replace("px","");
	
	len=len-47;
	$j('.calendar_container .top2').css({'margin-left' : ''+len+'px'});

}

function c_left(){
	var $j = jQuery.noConflict();
		
	element = document.getElementById('top2_id');
	len = window.getComputedStyle(element).marginLeft;
	
	len=len.replace("px","");
	
	if(len!='0'){
	    len=eval(len)+eval(47);
	    //alert(len);
	    $j('.calendar_container .top2').css({'margin-left' : ''+len+'px'});
    }
	
}


function date(d, date){

	var $j = jQuery.noConflict();

	$j('.calendar_container .top2 .date').css({'width' : '48px'});
	$j('.calendar_container .top2 #date_'+d+'').css({'width' : '100px'});

	$j('.calendar_container .top2 .date').css({'background-image' : 'url(/templates/infinitilife/images/date_item_fon.png)'});
	$j('.calendar_container .top2 #date_'+d+'').css({'background-image' : 'none'});

	$j('.calendar_container .top2 .date').css({'border-bottom-width' : '1px'});
	$j('.calendar_container .top2 #date_'+d+'').css({'border-bottom-width' : '0px'});

$j('.calendar_container .top2 .date').removeClass('f');
$j('.calendar_container .top2 #date_'+d+'').addClass('f');





   $j.ajax({  
                    type: "POST",  
                    url: "/action/poster_date.php",  
                    data: "date="+(date),
	  	 		
                    success: function(html){  
			
					    $j(".poster_items").html(html);
					    $j(".poster_img").css({"height" : "calc("+temp_width+" * 1)"});	
                    }  
         });


//    alert(temp_width);
    //var temp_height=temp_width*2;
    
  
    
    


}



</script>


<jdoc:include type="modules" name="afisha-posters" style="no" />




<?php
}
?>


    <jdoc:include type="message" />
    <jdoc:include type="component" />
<?php endif; ?>
		</div>
	</div>
	<div class="footer">
		<div class="top">
			<div class="spoil">Инструменты, нажмите чтобы развернуть</div>
			<div class="message">Новое сообщение в чате</div>
		</div>
		<div class="bottom" style="position:relative;">
		    <jdoc:include type="modules" name="footer-menu" style="no" />
		    
		    <ul class="right_menu">
		        <li class="li1" style="border-color:#777778; " onclick="form1();">Обратная связь</li>
		        <li class="li2" onclick="form2();" style="background-image:none;">Подписка на события</li>
		        <!--<li class="li3" onclick="form3();" style="background-image:none;">Общение в чате</li>
		        -->
		    </ul>
		    
		    <div class="form1 form"><jdoc:include type="modules" name="footer-form1" style="no" /></div>
		    <div class="form2 form"><jdoc:include type="modules" name="footer-form2" style="no" /></div>
		    <div class="form3 form"><jdoc:include type="modules" name="footer-form3" style="no" /></div>
		    
		    
		</div>
	</div>
    


<script type="text/javascript">
var $j = jQuery.noConflict();
function form1(){
    $j(".form1").css({'display' : 'block'});
    $j(".form2").css({'display' : 'none'});
    $j(".form3").css({'display' : 'none'});
    
    $j(".li1").css({'border-color' : '#777778'});
   $j(".li1").css({'background-image' : 'url(/templates/infinitilife/images/bottom_fon.png)'});
   
    
    $j(".li2").css({'border-color' : 'transparent'});
    $j(".li3").css({'border-color' : 'transparent'});
     $j(".li2").css({'background-image' : 'none'});
    $j(".li3").css({'background-image' : 'none'});
    
    
}

function form2(){
    $j(".form1").css({'display' : 'none'});
    $j(".form2").css({'display' : 'block'});
    $j(".form3").css({'display' : 'none'});
        
    $j(".li1").css({'border-color' : 'transparent'});
    $j(".li1").css({'background-image' : 'none'});
    
    $j(".li2").css({'border-color' : '#777778'});
    $j(".li2").css({'background-image' : 'url(/templates/infinitilife/images/bottom_fon.png)'});
   
    
    $j(".li3").css({'border-color' : 'transparent'});
    $j(".li3").css({'background-image' : 'none'});
}

function form3(){
    $j(".form1").css({'display' : 'none'});
    $j(".form2").css({'display' : 'none'});
    $j(".form3").css({'display' : 'block'});
        
    $j(".li1").css({'border-color' : 'transparent'});
    $j(".li2").css({'border-color' : 'transparent'});
    $j(".li1").css({'background-image' : 'none'});
    $j(".li2").css({'background-image' : 'none'});
    
    $j(".li3").css({'border-color' : '#777778'});
    $j(".li3").css({'background-image' : 'url(/templates/infinitilife/images/bottom_fon.png)'});
    
}

</script>


<script type="text/javascript">


var $j = jQuery.noConflict();

 $j(document).ready(function(){

if ($("a.sigProLink.fancybox-button")){	 
	 
var title = $j('a.sigProLink.fancybox-button').attr('title');
//alert(title);

var txt1=$j(".rating_author").html();
//alert(txt1);

title=title.replace('<div class="rating_author2"></div>','<div class="rating_author2">'+txt1+'</div>');

$j('a.sigProLink.fancybox-button').attr('title',title);
//alert(title);


}

 });


</script>



<script type="text/javascript">
   
var $j2 = jQuery.noConflict();
/*
$j2('.sigProImg').click(function(){
  
  
  //if($j2("div").is(".gallery_bar")){
    //  alert('1');
  //}else{
    //  alert('2');
  //}
  
  $j2(".gallery_bar").css({"display" : "block"});
  
}); 


$j2('.fancybox-overlay-fixed').click(function(){
  alert('1234');
  
  
  
  $j2('.gallery_bar').css({'display' : 'none'});
  
}); 

 if($j2("div").is(".fancybox-overlay-fixed")){
   alert('1');
 }else{
   alert('2');
 }
  */
  




	/*
jQuery.noConflict();
		jQuery(function($) {
			$("a.fancybox-button").fancybox({
			    alert('1234');
				//padding: 0,
				//fitToView	: true,
				helpers		: {
					title	: { type : 'inside' }, // options: over, inside, outside, float
					buttons	: {}
				},
				afterLoad : function() {
					//this.title = '<b class="fancyboxCounter">Image ' + (this.index + 1) + ' of ' + this.group.length + '</b>' + (this.title ? this.title : '');
				}
			});
		});
    */
    
    
    
</script>


<div class="modal1 modal_1" onclick="modal_hide();">
</div>

<div class="modal12 modal_1" style="background-color:transparent;   opacity: 1;">
    
    <jdoc:include type="modules" name="auth_modal" style="no" />
        
</div>

<script type="text/javascript">
var $j3 = jQuery.noConflict();  
//
//$j3('.gallery_bar').click(function(){     
//   
//   alert("1234");
//   
//  
function select_img(k){
   // alert(k);
    $j3.fancybox.jumpto(k);
    
    
}


</script>


<script type="text/javascript">
var $j2 = jQuery.noConflict();

$j2('.bar_prev').click(function(){ 
   
    var width_1= $j2(".fancybox-skin").width();
   
    var width_img=width_1/7;
    
    var margin1=$j2(".gallery_bar .gallery_bar2").css("margin-left");
    //margin1=margin1.replace("-","");
    margin1=margin1.replace("px",""); 
    //alert(parseInt(margin1));
    if((parseInt(margin1)=="0")||(parseInt(margin1)=="-0")){
    
    
    }else{
    
    margin1=eval(margin1)+eval(width_img);
    
    //alert(margin1);
    $j2(".gallery_bar .gallery_bar2").css({"margin-left" : ""+margin1+"px"});
        
        
    }
    
});

$j2('.bar_next').click(function(){ 
    
    //var width_img= $j2(".gallery_bar .img").css("width");
    var width_1= $j2(".fancybox-skin").width();
   
    var width_img=width_1/7;
    
    //width_img=width_img.replace("px","");
    //alert(width_img);
    var margin1=$j2(".gallery_bar .gallery_bar2").css("margin-left");
    //margin1=margin1.replace("-","");
    margin1=margin1.replace("px","");
    
    
    var l_img=$j2("img.img").length;
    var r=width_img*l_img;
    
    var mod=parseInt(margin1);
    mod=Math.abs(mod);
    
    mod = parseInt(mod);
    //alert(mod);
    //alert( (parseInt(mod)+width_1)+" = "+parseInt(r) );
    //
    if((parseInt(mod)+width_1+parseInt(width_img))>parseInt(r)){
    
    }else{
    
    
    margin1=eval(margin1)-eval(width_img);
    //alert(margin1);
    $j2(".gallery_bar .gallery_bar2").css({"margin-left" : ""+margin1+"px"});
    
    
    
    }
    
    
  
    
    
    
});
</script>


<?php

$currentMenuId = JSite::getMenu()->getActive()->id;
if($currentMenuId == 101){



?>
<style type="text/css">
    .nicescroll-rails{
    display:none;    
    
    }
    
    
</style>

<?php
}

?>


<script type="text/javascript">
var $j2 = jQuery.noConflict();
$j2(document).ready(function(){




var slider_width=$j2(".border_slider").width();
$j2('#slider125').css({'left' : '-'+slider_width+'px'});

var slider_width2=slider_width;

slider_width2=slider_width2+3;

setTimeout(function() { $j2('#slider125').css({'left' : '-'+slider_width2+'px'});  }, 1000);


});


</script>

<script type="text/javascript">
var $j2 = jQuery.noConflict();
$j2('.photocontent-bottom ul.container>li.thumb a').hover(
    
         function(){  $j2('#itemListLeading a .title').css({'display' : 'block'});   
         $j2('#itemListLeading a .date').css({'display' : 'block'});
        $j2('#itemListLeading a .category').css({'display' : 'block'});     
         },
       function(){  $j2('#itemListLeading a .title').css({'display' : 'none'}); 
           $j2('#itemListLeading a .date').css({'display' : 'none'});
           $j2('#itemListLeading a .category').css({'display' : 'none'});
           
       }
);

</script>
<script type="text/javascript">
var $j2 = jQuery.noConflict();
$j2('.poster_items .poster_img').hover(
       function(){  $j2('.poster_img2').css({'z-index' : '999999999999999999999999'});  
         },
       function(){  $j2('.poster_img2').css({'z-index' : '500'});
           
       }
    
);

</script>


</body>
</html>