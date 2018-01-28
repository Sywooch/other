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

$database = JFactory::getDbo();
$database->setQuery("UPDATE #__sh404sef_urls SET `oldurl` = REPLACE(`oldurl`, 'amurskaya-obl/blagoveshchensk/', '')");
if(!$database->query()){
echo __LINE__.$db->stderr();
} 


$database = JFactory::getDbo();
$database->setQuery("UPDATE #__sh404sef_urls SET `oldurl` = REPLACE(`oldurl`, 'amurskaya-obl/', '')");
if(!$database->query()){
echo __LINE__.$db->stderr();
} 


$database->setQuery("DELETE FROM   #__sh404sef_urls WHERE `newurl` = ''");
if(!$database->query()){
echo __LINE__.$db->stderr();
} 


//$database->setQuery("UPDATE #__sh404sef_urls SET `oldurl` = REPLACE(`oldurl`, 'afishi/vse', 'afishi')");
//if(!$database->query()){
//echo __LINE__.$db->stderr();
//} 






?>


<?php

if( (!isset($_GET['localion'])) || ($_GET['localion']=="") || ($_GET['localion']==NULL) ){
    
    $_GET['localion']="17";
}




?>




<!DOCTYPE html>
<html>
<head>
    <meta name='yandex-verification' content='73eebafcb3cb186e' />
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
<!--
<script src="/js/jquery.nicescroll.js"></script>
-->








<!--scroll 2-->




<?php

$currentMenuId = JSite::getMenu()->getActive()->id;
if($currentMenuId == 101){



?>
<?php
}else{

?>

<!--

<link type="text/css" rel="stylesheet" href="/js/jquery.jscrollpane.css"/>
<script type="text/javascript" src="/js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="/js/jquery.jscrollpane.js"></script>


<script type="text/javascript">
var $j4 = jQuery.noConflict();
    $j4(function()
    {
        $j4('body').jScrollPane();
    });
</script>
-->
<?php
}
?>


<!--scroll 2-->


<!--
<script type="text/javascript">


var $j4 = jQuery.noConflict();

$j4(document).ready(

  function() { 

$j4("body").niceScroll();
	
//$j4(".poster_detail .itemBody .list_comments").niceScroll();
  }

);

</script>
-->
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


<script type="text/javascript">
var $j2 = jQuery.noConflict();

function preloadImages()
{
  for(var i = 0; i<arguments.length; i++)
    $j2("<img />").attr("src", arguments[i]);
}

preloadImages("/templates/infinitilife/images/load_social1.png","/templates/infinitilife/images/load_social2.png","/templates/infinitilife/images/load_social3.png","/templates/infinitilife/images/load_social4.png","/templates/infinitilife/images/load_social5.png","/templates/infinitilife/images/load_social6.png");


pic1 = new Image();
pic1.src = "/templates/infinitilife/images/load_social1.png";

pic2 = new Image();
pic2.src = "/templates/infinitilife/images/load_social2.png";

pic3 = new Image();
pic3.src = "/templates/infinitilife/images/load_social3.png";

pic4 = new Image();
pic4.src = "/templates/infinitilife/images/load_social4.png";

pic5 = new Image();
pic5.src = "/templates/infinitilife/images/load_social5.png";

pic6 = new Image();
pic6.src = "/templates/infinitilife/images/load_social6.png";


    $j2(function(){
 $j2('.hidescreen, .load_page').fadeIn(10); //показывает фон и индикатор
 $j2(window).load(function() {
  $j2('.hidescreen,.load_page').fadeOut(600); //скрывает, после загрузки страницы
  $j2('.pace').fadeOut(600);
  

  
  
  
 });
 $j2('.hidescreen').click(function(){ //
  $j2('.hidescreen,.load_page').fadeOut(300); 
  $j2('.pace').fadeOut(300); 
  $j2('.pace').fadeOut(300);
 });
 $j2('.close').click(function(){ //
  $j2('.hidescreen,.load_page').fadeOut(300); 
   $j2('.pace').fadeOut(300); 
   $j2('.pace').fadeOut(300);
 });
});
    
    
</script>


<style type="text/css">
@media (max-width: 1350px)
#nextend-smart-slider-1 .smart-slider-border1 img {
  height: auto !important;
  width: auto !important;
}

</style>


<?php
$menu = JSite::getMenu();
if ($menu->getActive() == $menu->getDefault()) {
 //   echo 'Главная страница';

?>


<style type="text/css">
.center{
overflow-y:hidden;
}

.center>.content{
padding-right:0px !important;	
}





</style>

<?php
}
?>


<!--
<script src="/assets/nprogress.js"></script>
 
<link rel="stylesheet" type="text/css" href="/assets/nprogress.css" />
-->

<!--индикатор загрузки-->

<script src="/pace/pace.js"></script>
<link href="/pace/pace-theme-barber-shop.css" rel="stylesheet" />



<script type="text/javascript">
var $j2 = jQuery.noConflict();
$j2(window).scroll(function(){
var st = $j2(this).scrollTop();
//alert(st);
});
</script>






<!--video js-->
<link type="text/css" rel="stylesheet" href="/video-js/video-js.css" />
<script src="/video-js/video.js"></script>
<script src="/video-js/youtube.js"></script>
<!--video js-->



<script type="text/javascript">
	window.onload = function(){
		var RegOut = document.getElementById('SPanelRegOut').cloneNode(true);
		document.getElementById('SPanelRegIn2').appendChild(RegOut);
		var RegOut1 = document.getElementById('SPanelRegOut');
		document.getElementById('SPanelRegIn1').appendChild(RegOut1);
		}
</script>
</head>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<body>

<div style="display:none;">
<img src="/templates/infinitilife/images/load_social1.png" alt="" title=""/>
<img src="/templates/infinitilife/images/load_social2.png" alt="" title=""/>
<img src="/templates/infinitilife/images/load_social3.png" alt="" title=""/>
<img src="/templates/infinitilife/images/load_social4.png" alt="" title=""/>
<img src="/templates/infinitilife/images/load_social5.png" alt="" title=""/>
<img src="/templates/infinitilife/images/load_social6.png" alt="" title=""/>
</div>








<div class='hidescreen'></div>

<div class='load_page'>
 <span style="display:block; width:100%; margin-top:5px; font-size:13px;">cтраница загружается...</span>
  <br>

 
 
 <b class='close'>X</b>
  <br>
 <b style="width:100%; height:30px; text-align:center;display:block;">СКУЧНО ЖДАТЬ? ЗАХОДИ:</b>
<a href="http://instagram.com/infinitilife.ru" target="_blank" class="load_social1 load_social"></a>
<a href="http://vk.com/infinitiliferu" target="_blank" class="load_social2 load_social"></a>
<a href="http://www.odnoklassniki.ru/infinitilife" target="_blank" class="load_social3 load_social"></a>
<a href="https://www.facebook.com/groups/inflife/" target="_blank" class="load_social4 load_social"></a>
<a href="http://www.youtube.com/channel/UCfKCdjvxUmMrVzNlOmZnzig" target="_blank" class="load_social5 load_social"></a>
<a href="http://twitter.com/InfinitilifeBlg" target="_blank" class="load_social6 load_social"></a>
</div>











    

<style type="text/css">
    .hidescreen,
.load_page {
 position: fixed;
/* display: none; *//*изначально блоки скрыты*/
}
.hidescreen {
 z-index: 999998; 
 width: 100%;
 height: 100%;
 background: #000000;
 opacity: 0.8;
 filter: alpha(opacity=80);
 left:0;
 top:0;
 

 
 
 
}
.load_page {
 z-index: 99999999; /*значение должно больше чем для .hidescreen*/
 left: 50%;
 top: 50%;
 background: #2d2e30;
 padding: 10px 10px;
 text-align: center;
 font: normal normal 15px Verdana;
 border-radius: 16px;
 margin-left: -150px;
 margin-top:-100px;
 width: 300px;
 border:rgba(185,185,185,0.5) solid 8px;
 
color:#FFF;

}
.close { 
 position: absolute;
 top: 5px;
 right: 5px; 
 border: 0px solid #666; 
 border-radius: 15px; 
 font: normal bold 12px/14px Comic Sans MS; 
 text-align: center; 
 background: #2c3940; 
 color: #FFF; 
 cursor: pointer; 
 height: 30px; 
 width: 30px;
 line-height:30px;
} 
.close:hover { 
 background: #C00; 
 color: #FFF; 
}
    
</style>











<!--
<div class="modal2">    




</div>    
    -->


<div class="gray_block">
</div>


<div class="list_comments2">

</div>

<div class="border_main">


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
                                    	<div style="position:fixed; top:0px; left:0px; display:none;">
											<jdoc:include type="modules" name="SPanel_reg" style="no" />
										</div>
								</td>
								
								
								<?php
								 }else{
									//Презагружаем юзера чтобы подгрузить возможно только что добавленный статус или СП
									$idi = JFactory::getSession()->get('user');
									$user= JFactory::getUser($idi->id);
									if($user->status==null)$user->status='Статус отсутствует';
									$Rxml=simplexml_load_string(file_get_contents('libraries/joomla/user/family_status.xml'));
									foreach($Rxml as $key=>$val){
										if($key==='sp'.$user->family_status){
											$user->family_status=$val;
											break;
										}
									};
									
									$db = & JFactory::getDbo();
		                            $db->setQuery("SELECT * FROM #__k2_users WHERE userID=".$user->id);
		                            $userK2 = $db->loadObject();
									/*if($user->username==='waxjey'){
									$db =& JFactory::getDBO();
									$db->setQuery("SELECT * FROM #__k2_users WHERE `userID`=812");
									$sl=$db->loadObject();
									$RomaOut = json_encode($sl);										
									$myFile = fopen(JPATH_SITE.'/roma_out.txt','w+');
									fwrite($myFile,$RomaOut);
									fclose($myFile);
									}*/
									
								?>
								
								<td>
								<!--	<div style="margin-left:-5px"><span style="font-size:10px;">Моя страница</span></div>
									<div style="margin-left:-5px"><span style="font-size:10px;">Найти друзей</span></div>-->
									<span><?php  echo $user->get('name');  ?></span>
									
								</td>
								<td>
									<div class="avatar">
                                    	<span><img src="/media/k2/users/<?= ($userK2->image!==null)?$userK2->image : '' ?>" alt=""></span>
                                    </div>
								</td>
								
								<?php
								 }
								?>
								
							</tr>
						</table>
                   
					</div>
                     <?php if(!$user->guest){?>
					<div class="mypagefull">
						<div class="profile">
							<div class="avatar">
                            	<img src="/media/k2/users/<?= ($userK2->image!==null)?$userK2->image : '' ?>" alt="<?=$user->name?>">
                            </div>
							<div class="text">
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td>Имя:</td>
										<td><?=$user->name?></td>
									</tr>
									<tr>
										<td>Логин:</td>
										<td><?=$user->username?></td>
									</tr>
									<tr>
										<td>Город:</td>
										<td>Благовещенск</td>
									</tr>
									<tr>
										<td>СП:</td>
										<td><?=$user->family_status?></td>
									</tr>
								</table>
								<div class="status">“<?=$user->status?>”</div>
							</div>
						</div>
						<div class="profilebtn">
							<ul>
								<li><a class="unactive" href=""><img src="templates/infinitilife/images/user_icon1.png"><p>Мои друзья</p></a></li>
								<li><a class="unactive" href=""><img src="templates/infinitilife/images/user_icon8.png"><p>Войти в чат</p></a></li>
								<li><a class="unactive" href=""><img src="templates/infinitilife/images/user_icon2.png"><p>Мои сообщения</p></a></li>
								<li><a class="unactive" href=""><img src="templates/infinitilife/images/user_icon7.png"><p>Меню по интересу</p></a></li>
								<li><a class="unactive" href=""><img src="templates/infinitilife/images/user_icon3.png"><p>Мой кабинет</p></a></li>
								<li><a class="unactive" href=""><img src="templates/infinitilife/images/user_icon6.png"><p>Я на фото</p></a></li>
								<li><a class="unactive" href=""><img src="templates/infinitilife/images/user_icon4.png"><p>Добавить соц.сеть</p></a></li>
								<li><a onClick="document.getElementById('exit_rom').click()"><img src="templates/infinitilife/images/user_icon5.png"><p>Выход</p></a></li>
							</ul>
						</div>
					</div>
                    <!--Если что тут был див х_х </div>-->
				
				
				
				
                <?php }?>
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
    <jdoc:include type="modules" name="banner_video" style="no" />
    
    
		<div class="leftmenu">
            <jdoc:include type="modules" name="leftmenu" style="no" />
		</div>
        <?php if ($this->countModules('rightmenu')) : ?>
            <div class="rightmenu">
                <jdoc:include type="modules" name="rightmenu" style="well" />
            </div>
        <?php endif; ?>
                
        <?php if(isset($_COOKIE['slider_main_photo'])&&($_COOKIE['slider_main_photo']=="NO")){ ?>
        
        <?php }else{ ?>
        <div class="fixed"> 
        <jdoc:include type="modules" name="slider-photo" style="no" />
        </div>
        <?php } ?>
        

        
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
                
 
                
                <?php
				}
				
				?>
                
                
                
            </div>
			<div class="content-bottom tmp5">
                <jdoc:include type="modules" name="content-bottom" style="no" />
			</div>
<?php else : ?>




<?php
//афиши
$uri = &JFactory::getURI();
$url = $uri->toString(array('path', 'query', 'fragment'));

if(substr_count($url,"/")==3){
	
}else{


?>


<?php if($GLOBALS['photo']=="YES"){
	
}else{
?>

<jdoc:include type="modules" name="afisha-slider-left" style="no" />
<jdoc:include type="modules" name="afisha-slider-right" style="no" />

<?php 
}
?>





<?php
}

?>








<jdoc:include type="modules" name="afisha-calendar" style="no" />




    <jdoc:include type="message" />
    



    <jdoc:include type="component" />
    
    
    

<jdoc:include type="modules" name="afisha-main" style="no" />


 
  
<?php endif; ?>





		</div>
	</div>
	<div class="footer">
		<div class="top">
			<div class="spoil">Контакты, нажмите чтобы развернуть</div>
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
   
    var height_1= $j2(".fancybox-skin").height();
   
    var height_img=height_1/7;
    
    var margin1=$j2(".gallery_bar .gallery_bar2").css("margin-top");
    //margin1=margin1.replace("-","");
    margin1=margin1.replace("px",""); 
    //alert(parseInt(margin1));
    if((parseInt(margin1)=="0")||(parseInt(margin1)=="-0")){
    
    
    }else{
    
    margin1=eval(margin1)+eval(height_img);
    
    //alert(margin1);
    $j2(".gallery_bar .gallery_bar2").css({"margin-top" : ""+margin1+"px"});
        
        
    }
    
});

$j2('.bar_next').click(function(){ 
    
    //var width_img= $j2(".gallery_bar .img").css("width");
    var height_1= $j2(".fancybox-skin").height();
   
    var height_img=height_1/7;
    
    //width_img=width_img.replace("px","");
    //alert(width_img);
    var margin1=$j2(".gallery_bar .gallery_bar2").css("margin-top");
    //margin1=margin1.replace("-","");
    margin1=margin1.replace("px","");
    
    //alert(margin1);
    var l_img=$j2("img.img").length;
    var r=height_img*l_img;
    
    var mod=parseInt(margin1);
    mod=Math.abs(mod);
    
    mod = parseInt(mod);
    //alert(mod);
    //alert( (parseInt(mod)+width_1)+" = "+parseInt(r) );
    //
    if((parseInt(mod)+height_1+parseInt(height_img))>parseInt(r)){
    
    }else{
    
    
    margin1=eval(margin1)-eval(height_img);
    //alert(margin1);
    $j2(".gallery_bar .gallery_bar2").css({"margin-top" : ""+margin1+"px"});
    
    
    
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








<!--
<script type="text/javascript">
var $j2 = jQuery.noConflict();
 $j2('body').show();
 $j2('.version').text(NProgress.version);
 NProgress.start();
 setTimeout(function() { NProgress.done(); $j2('.fade').removeClass('out'); }, 1000);
 </script>
-->
<!--
<script type="text/javascript">

<?php
$uri = & JFactory::getURI();
$url = $uri->toString(array('path', 'query', 'fragment'));
$url=str_replace(".html","",$url)
?>
//alert("<?php echo $url; ?>");
    window.history.replaceState('','', '<?php echo $url; ?>'); 
    
</script>-->



<script type="text/javascript">
<?php
$uri = &JFactory::getURI();
$url = $uri->toString(array('path', 'query', 'fragment'));
$url_mas=explode("?",$url);


?>

//window.history.replaceState("","","<?php  echo $url_mas[0]; ?>")

</script>
<script type="text/javascript">
var $j3 = jQuery.noConflict();

// $j3(document).ready(function(){
// alert(jQuery.fn.jquery);
// });
 </script>


<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter31179771 = new Ya.Metrika({
                    id:31179771,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true,
                    trackHash:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/31179771" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->


<script type="text/javascript">
var $j3 = jQuery.noConflict();    

$j3('.black_shadow_1').hover(function(){

//$j3(this).css({'display' : 'none'});

    
},function(){

//$j3(this).css({'display' : 'block'});

    
    
    
});  
    
</script>

<script type="text/javascript">
var $j3 = jQuery.noConflict();  

$j3('.sigProImg').click(function(){

$j3('.load_page').fadeIn(10);
$j3('.pace').fadeIn(10);

    
});  

</script>

<script type="text/javascript">
var $j3 = jQuery.noConflict(); 
//var h1=$j3('.jspContainer').css('height');
var h1=$j3(window).height();

//alert(h1);
$j3('.fullmap .block_map').css({'height' : 'calc('+h1+'px - 80px)'});

</script>

<meta name='yandex-verification' content='73eebafcb3cb186e' />




</body>
</html>