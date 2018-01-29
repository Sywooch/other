<style type="text/css">
.a_hover:hover{
background-color:green;

}
</style>
<?php


// No direct access.
defined('_REXEC') or die;
session_start();



$elementid 	= JRequest::getInt( 'elementid', 1, 'get' );
  	$document 	= & JFactory::getDocument();
  	$config 	= & JFactory::getConfig();
  	if ($elementid != '1') {
	if(($document->title)=="Магазин"){$document->title="Главная";};
  	$curtitle = $document->title.' - '.$config->getValue('sitename');
  	$document->setTitle( $curtitle );
  	} else {}


// check modules
$showRightColumn        = ($this->countModules('position-3') or $this->countModules('position-6') or $this->countModules('position-8'));
$showbottom                        = ($this->countModules('position-9') or $this->countModules('position-10') or $this->countModules('position-11'));
$showleft                        = ($this->countModules('position-4') or $this->countModules('position-7') or $this->countModules('position-5'));

if ($showRightColumn==0 and $showleft==0) {
        $showno = 0;
}

JHtml::_('behavior.framework', true);

// get params
$color              = $this->params->get('templatecolor');
$logo               = $this->params->get('logo');
$navposition        = $this->params->get('navposition');
$app                = JFactory::getApplication();
$doc        = JFactory::getDocument();
$templateparams     = $app->getTemplate(true)->params;

$doc->addScript($this->baseurl.'/design1/'.$this->template.'/javascript/md_stylechanger.js', 'text/javascript', true);



// Сервер базы данных 
define ( "DB_SERVER", "localhost" ); 

// База данных 
define ( "DB_BASE", "cms" ); 

// Пользователь, от имени которого производится подключение к базе.
define ( "DB_USER", "root" ); 

//Пароль для доступа к базе.
define ( "DB_PASS", "");

?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
        <head>
                <jdoc:include type="head" />
<!--------------#0-------------->
                <link rel="stylesheet" href="<?php echo $this->baseurl ?>/design1/main/css/main.css" type="text/css" />
                <link rel="stylesheet" href="<?php echo $this->baseurl ?>/design1/<?php echo $this->template; ?>/css/retina2.css" type="text/css" media="screen,projection" />
                <link rel="stylesheet" href="<?php echo $this->baseurl ?>/design1/<?php echo $this->template; ?>/css/retina3.css" type="text/css" media="screen,projection" />
                <link rel="stylesheet" href="<?php echo $this->baseurl ?>/design1/<?php echo $this->template; ?>/css/print.css" type="text/css" media="print" />
<!--------------#1-------------->
<!--для карты 2ГИС-->
<script type="text/javascript" src="http://maps.api.2gis.ru/1.0"></script>
<script type="text/javascript"> 
        // Создаем обработчик загрузки страницы: 
        DG.autoload(function() { 
            // Создаем объект карты, связанный с контейнером: 
            var myMap = new DG.Map('myMapId'); 
            // Устанавливаем центр карты, и коэффициент масштабирования: 
            myMap.setCenter(new DG.GeoPoint(127.52802638052,50.286342124774), 15); 
            // Добавляем элемент управления коэффициентом масштабирования: 
            myMap.controls.add(new DG.Controls.Zoom()); 
 
                        // Создаем балун:
            var myBalloon = new DG.Balloons.Common({
                // Местоположение на которое указывает балун: 
                 geoPoint: new DG.GeoPoint(127.52802638052,50.286342124774),
                 // Устанавливаем текст, который будет отображатся при открытии балуна:
                 contentHtml: '<div style="height:300px; width:280px; text-align:center;"><img style="margin-top:10px;" src="<?php echo $this->baseurl ?>/images/logo.png"/></br></br>Спецтранс, компания по перевозке спецтехники и негабаритных грузов,</br></br>Офис 504, 5 этаж<br></br>(4162)770-870, (4162)50-11-42<br></br><a href="mailto://770870@str28.ru">770870@str28.ru</a><br></br>ПН-ПТ: 9.00-17.00</br></br>СБ-ВС: Выходной</br> </div>'
            });
            // Создаем маркер:
            var myMarker = new DG.Markers.Common({
                 // Местоположение на которое указывает маркер:
                 geoPoint: new DG.GeoPoint(127.52802638052,50.286342124774),
                 // Функция, вызываемая при клике по маркеру
                 clickCallback: function() {
                    if (! myMap.balloons.getDefaultGroup().contains(myBalloon)) {
                        // Если балун еще не был добавлен на карту, добавляем его:
                         myMap.balloons.add(myBalloon);
                     } else {
                         // Показываем уже ранее добавленный на карту балун
                         myBalloon.show();
                     }
                }
            });
            // Добавить маркер на карту:
            myMap.markers.add(myMarker);
        }); 
    </script>
<!--для карты 2ГИС-->	



<style type="text/css">
.validate-email{


}

</style>

<?php
$menu = & JSite::getMenu();
//Получили главное меню
//
//Если мы находимся в главном пункте, 
if ($menu->getActive() == $menu->getDefault()) {
//то переменная fpage будет хранить единицу.
    $fpage="1"; 
}



//определяем - какая страница загружена
$document =& JFactory::getDocument();
$log_news=0;
 $pos=stripos($document->title, "Новости");
if ($pos !== false) {
$log_news=1;//мы на новостях.

}

$log_gallery=0;
$pos=stripos($document->title, "Галерея");
if ($pos !== false) {
$log_gallery=1;//мы в галереи.

}

$log_documentation=0;
$pos=stripos($document->title, "Документация");
if ($pos !== false) {
$log_documentation=1;//мы в документации.

}


?>



<script  type="text/javascript" src="<?php echo $this->baseurl ?>/js/jquery-1.3.2.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/js/jquery.animation.easing.js"></script>
<meta http-equiv="X-UA-Compatible" content="IE=edge" ><!--всегда использовать стандартный режим отображения-->
  
  


<?php
        $files = JHtml::_('stylesheet', 'design1/'.$this->template.'/css/general.css', null, false, true);
        if ($files):
                if (!is_array($files)):
                        $files = array($files);
                endif;
                foreach($files as $file):
?>
<!--------------#2-------------->
                <link rel="stylesheet" href="<?php echo $file;?>" type="text/css" />
				
<?php
                 endforeach;
        endif;
?>
                <link rel="stylesheet" href="<?php echo $this->baseurl ?>/design1/<?php echo $this->template; ?>/css/<?php echo htmlspecialchars($color); ?>.css" type="text/css" />
<!--------------#3-------------->
<?php      if ($this->direction == 'rtl') : ?>
                <link rel="stylesheet" href="<?php echo $this->baseurl ?>/design1/<?php echo $this->template; ?>/css/template_rtl.css" type="text/css" />
<?php        if (file_exists(RPATH_SITE . '/design1/retina_template/css/' . $color . '_rtl.css')) :?>
                <link rel="stylesheet" href="<?php echo $this->baseurl ?>/design1/<?php echo $this->template; ?>/css/<?php echo $color ?>_rtl.css" type="text/css" />
<?php        endif; ?>
<?php      endif; ?>
<!--------------#4-------------->
                <!--[if lte IE 6]>
                <link href="<?php echo $this->baseurl ?>/design1/<?php echo $this->template; ?>/css/ieonly.css" rel="stylesheet" type="text/css"/>
<!--------------#5-------------->
                <?php if ($color=="retina1") : ?>
                <style type="text/css">
                #line
                {      width:98% ;
                }
                .logoheader
                {
                        height:200px;

                }
                #header ul.menu
                {
                display:block !important;
                      width:98.2% ;


                }
                 </style>
 <!--------------#6-------------->
               <?php endif;  ?>
                <![endif]-->
                <!--[if IE 7]>
                        <link href="<?php echo $this->baseurl ?>/design1/<?php echo $this->template; ?>/css/ie7only.css" rel="stylesheet" type="text/css" />
                <![endif]-->
                <script type="text/javascript" src="<?php echo $this->baseurl ?>/design1/<?php echo $this->template; ?>/javascript/hide.js"></script>

                <script type="text/javascript">
                        var big ='<?php echo (int)$this->params->get('wrapperLarge');?>%';
                        var small='<?php echo (int)$this->params->get('wrapperSmall'); ?>%';
                        var altopen='<?php echo RText::_('TPL_BEEZ2_ALTOPEN', true); ?>';
                        var altclose='<?php echo RText::_('TPL_BEEZ2_ALTCLOSE', true); ?>';
                        var bildauf='<?php echo $this->baseurl ?>/design1/<?php echo $this->template; ?>/images/plus.png';
                        var bildzu='<?php echo $this->baseurl ?>/design1/<?php echo $this->template; ?>/images/minus.png';
                        var rightopen='<?php echo RText::_('TPL_BEEZ2_TEXTRIGHTOPEN', true); ?>';
                        var rightclose='<?php echo RText::_('TPL_BEEZ2_TEXTRIGHTCLOSE'); ?>';
                     
                        var bigger='<?php echo RText::_('TPL_BEEZ2_BIGGER'); ?>';
                        var reset='<?php echo RText::_('TPL_BEEZ2_RESET'); ?>';
                        var smaller='<?php echo RText::_('TPL_BEEZ2_SMALLER'); ?>';
                        var biggerTitle='<?php echo RText::_('TPL_BEEZ2_INCREASE_SIZE'); ?>';
                        var resetTitle='<?php echo RText::_('TPL_BEEZ2_REVERT_STYLES_TO_DEFAULT'); ?>';
                        var smallerTitle='<?php echo RText::_('TPL_BEEZ2_DECREASE_SIZE'); ?>';
                </script>




<!--------------#7-------------->


<script type="text/javascript" src="<?php echo $this->baseurl ?>/js2/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/js2/jquery-contained-sticky-scroll.js"></script>
<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('#sidebar').containedStickyScroll();
		});
</script>

<style type="text/css">
   a {
    outline: none !important; /* Убираем границу вокруг ссылок  */
	text-decoration:none !important;
	border-bottom: 0px black solid !important;
   }
  </style>



<!------------------------------------->
<!--плавающее окно-->
<style type="text/css">
.ie{
background-color:transparent;
float:left; width:260px; height:71px; padding:0px;
display:block; 
margin-left:-270px;
margin-right:0px; 
position:absolute !important;
border:0px yellow solid; 
left:100%;  top:0; 
margin-top:0px; z-index:999999999999999;
background-repeat:no-repeat;

}

.ie:hover{
 text-decoration:none !important;

}
</style>





<!--[if IE]>
<style type="text/css">
.ie{
background-color:transparent;
float:left; width:260px; height:71px; padding:0px;
display:block; 
margin-left:-270px;
margin-right:0px; 
position:absolute !important;
border:0px yellow solid; 
left:100%;  top:0; 
margin-top:0px; z-index:999999999999999;
background-repeat:no-repeat;

}
.ie:hover{
 text-decoration:none !important;

}

</style>
<![endif]-->
<!--плавающее окно-->
<!------------------------------------->


<!--mobilyslider-->
<!--<link href="<?php //echo $this->baseurl ?>/mobilyslider/css/default.css" rel="stylesheet" type="text/css" />-->
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>-->
<!--	<script src="<?php //echo $this->baseurl ?>/mobilyslider/js/mobilyslider.js" type="text/javascript"></script>
	<script src="<?php //echo $this->baseurl ?>/mobilyslider/js/init.js" type="text/javascript"></script>-->
<!--mobilyslider-->

<style type="text/css">

.mail1:hover{

text-decoration:none !important;
}

</style>

<!--gallery-->
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/gallery/css/timer.css" media="screen"/>
<!--<script type="text/javascript" src="http://cms/gallery/js/jquery-1.4.2.min.js"></script>-->
<script type="text/javascript" src="<?php echo $this->baseurl ?>/gallery/js/easing.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/gallery/js/jquery.vec.GalleryAjaxed.js"></script>
<script type="text/javascript">
$(document).ready (function(){
	$('#viewer').timerGallery({ easing : 'easeInOutCubic'});
});
</script>
<!--gallery-->

<!--moving slider-->
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/moving_slider/css/style.css" type="text/css" media="screen" charset="utf-8">
<!--<script src="<?php //echo $this->baseurl ?>/moving_slider/js/jquery-1.3.1.min.js" type="text/javascript" charset="utf-8"></script>-->
	<script src="<?php echo $this->baseurl ?>/moving_slider/js/slider.js" type="text/javascript" charset="utf-8"></script>
<!--moving slider-->



<style type="text/css">
.st1{

display: none; position: fixed; left: 0px; top: 0px; 
border: solid black 0px; padding: 0px; background-color: transparent; 
text-align: justify; font-size: 12px; width: 100%; height:100%; z-index:999999000000000000099990000000000000999;
}
.st2{

position:fixed; width:657px; height:591px; background-color:transparent; border:0px black solid; top:50%; 
left:50%; margin-top:-295px; margin-left:-329px; z-index:9999999999000000000000000000000009909; overflow:hidden; color:white; font-weight:bold;
}



</style>

<!--[if IE 9]>
<style type="text/css">
.st1{

display: none; position: absolute; left:50%; top:50%;
margin-left:-300px; margin-top:-200px;
border: solid black 0px; padding: 0px; background-color: yellow; 
text-align: justify; font-size: 12px; width:600px; height:400px; z-index:999999000000000000099990000000000000999;
}
.st2{

width:600px; height:400px; background-color:#2a8cb9; border:3px black solid;
position:absolute;
 overflow:hidden; color:white; font-weight:bold;

}



</style>				
				
<![endif]-->

        </head>






        <body align="center"  style=" background-color:#fcfcfc !important; 
		background-position:center bottom !important; 
		background-repeat:repeat-x !important;
		
		">



<!--background-image:url('<?php //echo $this->baseurl ?>/images/fon4.jpg') !important;-->
<!--окно с формой обратной связи-->
<div id='PopUp' class="st1">

<div align="center" class="st2">

<!--
<jdoc:include type="modules" name="main_slider"/>-->




<?php
   //генерация случайных чисел для антибот системы
   $x1=rand(0,9);
   $x2=rand(0,9);
   $x3=rand(0,9);
   $x4=rand(0,9);
$sum=$x1."".$x2."".$x3."".$x4;
$sum=md5($sum);


//на какой мы странице?????
//определяем - какая страница загружена
$document =& JFactory::getDocument();
$str=1;
 $pos=stripos($document->title, "Главная");
if ($pos !== false) {
$str=1;//главная.
}

 $pos=stripos($document->title, "Новости");
if ($pos !== false) {
$str=2;//новости.
}

 $pos=stripos($document->title, "О компании");
if ($pos !== false) {
$str=3;//
}

 $pos=stripos($document->title, "Галерея");
if ($pos !== false) {
$str=4;//
}

 $pos=stripos($document->title, "Документация");
if ($pos !== false) {
$str=5;//
}

 $pos=stripos($document->title, "Контакты");
if ($pos !== false) {
$str=6;//
}



?>
<style type="text/css">
input:focus {
    border: none;
    outline: none
}
textarea:focus {
    border: none;
    outline: none
}
</style>

<div id="f" name="f" style="width:657px; height:591px;  border-style:solid; border-width:0px; 
			border-color:white;padding:0px; margin-top:0px; background-color:transparent;
			background-image:url('<?php echo $this->baseurl ?>/images/feedback_main.png') !important;
			background-repeat:no-repeat !important;">
		
		<div align="center" style="width:657px; height:60px; background-color:transparent;
		 padding-top:20px;">
			<p style="font-size:15pt">ФОРМА ОБРАТНОЙ СВЯЗИ</p></div>
		

		<div align="center" style="width:657px; height:400px; background-color:transparent;">
		
			 <form id="responsesForm" action="<?php echo $this->baseurl ?>/action/action_responses.php?sum=<?php echo $sum; ?>&str=<?php echo $str; ?> "
			 enctype="multipart/form-data" method="post" accept-charset="utf-8" 
			 style="border:0px !important;">
					
                        <table border="0">
                            <tr style="background-color:transparent !important; border:0px !important;
							height:24px;">
							</tr>
							<tr style="background-color:transparent !important; border:0px !important; 
							"><!--тема-->
                                <td style="height: 25px; width: 130px;border-style:solid; border-width:0px; border-color:white;
								padding-top:10px;">
								<span style="margin-left:40px; color:black; font-weight:normal; font-size:10pt !important;">Тема:</span>
								</td> 
								
                                <td style="height: 30px; width:360px;border-style:solid; border-width:0px; border-color:white; 
								background-color:transparent !important; padding-top:5px;">
								 <input type="text" name="theme" maxlength="150" 
								 style="width: 300px; height:38px; background-color:transparent;margin-left:3px; 
								 border:0px !important; padding-left:5px; font-size:12pt;  border-width:0;"/>
								</td>
                            </tr><!--тема -->
							
							<tr style="background-color:transparent !important; border:0px !important;
							height:16px;">
							</tr>
							
							
						  <tr style="background-color:transparent !important; border:0px !important;"><!--mail-->
                               <td style="height: 25px; width: 130px;border-style:solid; border-width:0px; border-color:white;
							   padding-top:10px;">
								<span style="margin-left:40px; color:black; font-weight:normal; font-size:10pt !important;">Ваш e-mail:</span>
								</td> 
								
                                <td style="height: 30px; width:360px;border-style:solid; border-width:0px; border-color:white;
								background-color:transparent !important; padding-top:5px;">
								 <input type="text" name="title" maxlength="130" 
								 style="width: 300px;background-color:transparent;margin-left:3px; 
								 padding-left:5px; font-size:12pt;  border-width:0 !important; height:38px;"/>
								</td>
                            </tr><!--mail-->
							
							<tr style="background-color:transparent !important; border:0px !important;
							height:22px;">
							</tr>
							
                           <tr style="background-color:transparent !important; border:0px !important;"><!--текст-->
                             <td style="height: 85px; width:130px; border-style:solid; border-width:0px; border-color:white;
							 background-color:transparent !important; padding-top:5px;">
								<span style="margin-left:40px; color:black; font-weight:normal; font-size:10pt !important;">Текст:</span>
								</td> 
								
                                <td style="height:85px; width:360px; border-style:solid; border-width:0px; border-color:white">
								<textarea name="comment" maxlength="500" style="margin-left:3px; height:104px; 
								width:305px;background-color:transparent;
								max-height:104px; max-width:305px; padding-left:5px;
								border:0px !important; padding-top:5px; padding-bottom:1px;"></textarea>
								</td>
                            </tr><!--текст-->
		
<tr style="background-color:transparent !important; border:0px !important;
							height:22px;">
							</tr>




                   <tr style="background-color:transparent !important; border:0px !important;"><!--текст-->
   
   <?php

   

   
      

				echo'				<td style="height: 40px; width:130px; border-style:solid; border-width:0px; 
								border-color:white; padding-top:0px;
								padding-bottom:0px; padding-left:0px; padding-right:0px; text-align:left; background-color:transparent;">
								<div style="margin-left:40px; width:80px; height:40px; background-color:transparent;">
								<span style="color:black; font-weight:normal; 
								  font-size:10pt !important;">Введите </br>число с картинки:</span>
								</div>
								</td> 
								<td style="height:40px; width:360px; border-style:solid; 
								border-width:0px; border-color:transparent; padding-top:0px;
								padding-bottom:0px">
								<div style="height:20px; width:360px">
								 <input type="text" name="bot" id="bot" maxlength="30" 
								 style="width: 115px;background-color:transparent;margin-left:3px; float:left;
								 padding-left:5px; border:0px; font-size:13pt;"/>
								
								
								<div style="height:18px; width:130px; margin-left:90px; margin-top:3px; float:left">';
			
                          echo"
								<div style=\"float:left; height:18px; width:13px;background-image:url(".$this->baseurl."/images/antibot/".$x1.".jpg); \"></div>
								<div style=\"float:left; height:18px; width:13px;background-image:url(".$this->baseurl."/images/antibot/".$x2.".jpg); \"></div>
								<div style=\"float:left; height:18px; width:13px;background-image:url(".$this->baseurl."/images/antibot/".$x3.".jpg); \"></div>
								<div style=\"float:left; height:18px; width:13px;background-image:url(".$this->baseurl."/images/antibot/".$x4.".jpg); \"></div>
								</div>";
								
								
						echo'		</div>
								
								</td>';  
         ?>                    
                        </tr><!--текст-->
                       </table> 
					<div align="left" style="width:500px; height:40px; background-color:transparent; margin-top:35px;">   
                       <input type="submit" name="submit" value="Отправить" 
						style="width: 119px; height: 38px; margin-top:0px; 
						margin-left:148px; border:0px !important; background-color:transparent !important; 
						cursor:pointer !important; color:white !important;  font-weight:bold !important;
						"/>
						
                        <input type="reset" value="Сброс" 
						style="width: 119px; height: 38px; margin-top:0px; margin-left:42px;  
						border:0px !important; background-color:transparent !important; 
						cursor:pointer !important; color:white !important;  font-weight:bold !important;" />
					</div>
  
                        
						

                    </form>
					
					
		</div>	




<div align="left" style="width:657px; height:70px; background-color:transparent;">
<div align="left" style="width:120px; height:40px; background-color:transparent; margin-left:460px; padding-top:30px;">
<a onmouseover='this.style.cursor="pointer" '
		onfocus='this.blur();' 
		onclick="document.getElementById('PopUp').style.display='none'; document.getElementById('block').style.display='block';
		document.getElementById('block2').style.display='block';">
		<span style="color:red; font-size:11pt;">Закрыть</span></a></div>

</div>
		
				
	
			
			</div><!--f-->







</div>




</div>
<!--окно с формой обратной связи-->



	
<!------------------------------------------------------------------------------------------------------------->	
	<div id="sidebar" class="ie" style="background-color:transparent;  
	background-image:url('<?php echo $this->baseurl ?>/images/feedback.png'); ">
		
		<div align="center" style="width:200px; height:29px; background-color:transparent; float:left;
		padding-top:22px; padding-bottom:20px;">
		
		<span><a onmouseover='this.style.cursor="pointer" '
		onfocus='this.blur();' onclick="document.getElementById('PopUp').style.display='block'; document.getElementById('block').style.display='none';
		document.getElementById('block2').style.display='none';" >
		<span style="color:white; font-size:12pt;"><strong>Связаться с нами</strong></span></a></span>
	
		</div>
		<div style="width:60px; height:71px; float:left; background-color:transparent;">
		
		<a onmouseover='this.style.cursor="pointer" '
		onfocus='this.blur();' onclick="document.getElementById('PopUp').style.display='block'; 
		document.getElementById('block').style.display='none';
		document.getElementById('block2').style.display='none';">
		<img src="<?php echo $this->baseurl ?>/images/feedback_transparent.png" alt="" style="border:0px !transparent"/>
		</a>
		
		</div>
		
		
		
		
		
		
		</div>	
<!------------------------------------------------------------------------------------------------------------->	
	
<div style="width:100%; height:660px; position:absolute; background-color:transparent; 
 background-repeat:no-repeat; 
 background-position:center top !important;
 z-index:-11111">
<div style="width:50%; height:660px; float:left; background-image:url('<?php echo $this->baseurl ?>/images/fon2_left.jpg');
background-repeat:repeat-x;"></div>
<div style="width:50%; height:660px; float:left; background-image:url('<?php echo $this->baseurl ?>/images/fon2_right.jpg');
background-repeat:repeat-x;"></div>


 </div>



<!--====================================================-->
<div id="headerwrap" style="background-color: transparent !important; 
border:0px black solid !important; height:0px; "><!--headerwrap-->
	
</div><!--headerwrap-->
	
<div align="center" style="height:130px; width:100%; position:absolute;"><!--название и телефон-->


<div style="width:1200px; height:130px; ">
<div style="height:130px; width:300px;">
<div align="left" style="height:71px; width:300px; padding-top:10px; ">
<a href="/" > <img src="<?php echo $this->baseurl ?>/images/logo.png" alt="" style="margin-left:15px; border:0px !important;"/></a>
</div>

<div align="left" style="height:20px; width:300px; margin-top:30px; padding-left:0px;">
<div align="left" style="height:20px; width:200px; margin-left:55px; ">
<span style="font-size:12pt; color:#0d678c; font-weight:bold;">Тел.: +7(4162) 770-870</span>
</div>



<div align="left" style="height:20px; width:140px; margin-left:75px; background-color:transparent;">
<a class="mail1"  href="mailto:770870@str28.ru">
<span class="mail1" style="font-size:12pt; color:#0d678c; font-weight:bold;">770870@str28.ru</span></a>
</div>

</div>



</div>
</div>
</div><!--название и телефон-->	
	
	
	

	

<div align="center" style="width:100%; background-color: transparent;
background-position:center bottom; background-repeat:repeat-x !important; border:0px black solid;
 background-image:url('<?php echo $this->baseurl ?>/images/fon3.jpg');
<?php if ($fpage=="1") {  echo'background-image:url( '.$this->baseurl.'/images/fon3_lite.png); 
background-repeat:repeat-x !important; background-color:#f9f9f8;';}; ?>
<?php if ($log_news==1) {  echo'background-image:url( '.$this->baseurl.'/images/fon3_lite_news.png); 
background-repeat:repeat-x !important;';}; ?>
<?php if ($log_gallery==1) {  echo'background-image:url( '.$this->baseurl.'/images/fon3_lite_gallery.png); 
background-repeat:repeat-x !important;';}; ?>
<?php if ($log_documentation==1) {  echo'background-image:url( '.$this->baseurl.'/images/fon3.jpg); 
background-repeat:repeat-x !important;';}; ?>
">

<div align="center" style="width:100%; 
background-position:center top;  background-repeat:no-repeat;
background-image:url('<?php echo $this->baseurl ?>/images/header_fon.png');
">
<!---->  

<div style="width:1200px; background-color:transparent; background-image:url('<?php echo $this->baseurl ?>/images/header_fon.png');
background-position:center top; background-repeat:no-repeat;">
<div  id="all" style="background-color:transparent !important; ">
        <div id="back" align="center" style="background-color:transparent !important; text-decoration:none !important;
		">
		<jdoc:include type="modules" name="header"/>

		
		<jdoc:include type="modules" name="menu"/>
	
		
	<div style="height:480px; width:1000px;float:left; background-color:transparent; border:0px black solid;">
	<div style="height:103px; width:1000px; border:0px black solid; margin-top:320px; background-color:transparent;">
	<div style="height:103px; width:121px; border:0px black solid; margin-left:70px; float:left; 
	"></div>
	<div style="height:103px; width:140px;  float:left; margin-left:20px;"></div>
	
	<div style="height:103px; width:119px; border:0px black solid; margin-left:24px; float:left;
	 "></div>
	<div style="height:103px; width:140px;  float:left; margin-left:20px;"></div>
	
	<div style="height:103px; width:121px; border:0px black solid; margin-left:25px; float:left;
	 "></div>
	<div style="height:103px; width:140px; float:left; margin-left:20px;"></div>
 </div>
	
	
	</div>
		<jdoc:include type="modules" name="slider"/>
		<jdoc:include type="modules" name="search"/>
		
		           <div id="header" style="background-color:transparent !important; width:936px !important; padding:0 !important; 
				   border:0px black solid !important; height:0px !important">
				   
				           
                        </div><!-- end header -->
                        <div align="left" style="width:980px !important;margin:0 !important;
						border:0px !important; border-right:0px #bebebe solid !important; background-color:transparent !important;
						padding-left:0px !important; " 
						id="<?php echo $showRightColumn ? 'contentarea2' : 'contentarea'; ?>" 
						><!--background-color:yellow !important;-->
						
					
						<div align="center" style="width:925px; margin:0;
						 
						<?php 
						if ($log_gallery==1){
						 echo" height:490px; "; };
						
						?>
						
						
						background-repeat:repeat-x !important;
						background-position:center bottom;
						padding-left:8px; 
						padding-right:8px;margin-left:25px;                                     
						padding-bottom:0px !important;
						background-color:#f8f8f8 !important;
						background-image:url('<?php echo $this->baseurl ?>/images/border_line.jpg');
						border:0px black solid;
						">
						<!---->
						
                                        <?php if ($navposition=='left' and $showleft) : ?>


                                                        <div style="margin:0 !important;
														width:260px !important; padding-left:0px !important;
														border:0 !important; border-left:0px #bebebe solid !important;	
															" 
														class="left1 <?php if ($showRightColumn==NULL){ echo 'leftbigger';} ?>" id="nav">
                                                   <jdoc:include type="modules" name="position-7" style="beezDivision" headerLevel="3" />
												  <div style="width:261px; height:1px; float:left"></div>
												   
                                                 

                                                        </div><!-- end navi -->
               <?php endif; ?>

                                        <div style="background-color:white !important; width:927px !important; 
										padding-left:0px !important; 
										padding-right:0px !important;
										margin-left:0px !important;
										margin:0 !important;
										padding:0 !important;
										margin-top:0px !important;
										border-bottom:0px white solid !important;
										border-right:0px #bebebe solid !important;
					
					<?php if($fpage=="1"){ echo"width:926px !important;"; };  ?>
												
												<?php if($log_news==1){ echo"width:926px !important;"; };  ?>
												
												<?php if($log_gallery==1){ echo"width:926px !important;"; };  ?>
												
													<?php if($log_documentation==1){ echo"width:927px !important;"; };  ?>
										
										
										
										"  
										id="<?php echo $showRightColumn ? 'wrapper' : 'wrapper2'; ?>" <?php if (isset($showno)){echo 'class="shownocolumns"';}?>>
  
  

  
  
                                               <div id="main" style="background-color:transparent !important; border:0px #f8f8f8 solid;
												width:890px !important; 	border-top:0px #f8f8f8 solid;
												<?php if($fpage=="1"){ echo"padding:0 !important; width:926px !important;
												background-color:#d7d6db !important;"; };  ?>
												
												<?php if($log_news==1){ echo"padding:0 !important; width:926px !important;
												background-color:transparent !important;min-height:400px !important;"; };  ?>
												
												<?php if($log_gallery==1){ echo"padding:0 !important; width:926px !important;
												background-color:transparent !important;"; };  ?>
												
													<?php if($log_documentation==1){ echo"padding:0 !important; width:926px !important;
												background-color:transparent !important;"; };  ?>
												
												">

                                                <?php if ($this->countModules('position-12')): ?>
                                                        <div id="top">
														
                                                        </div>
                                                <?php endif; ?>

                                                       
													 
													   <!---------------------------------------------------------------------------->










													 <?php
													
															if ($fpage=="1") {//главная
													echo"<div style=\"width:927px; height:358px; background-color:transparent;
													margin-left:-1px;\">";
	
	

	

	
	
	echo'
	<!--moving-slider-->	


											
<div id="wrapper" style="background-color:transparent; ">
	

    
   <div id="slider">    

   	

	 	  	<div style="overflow: hidden; background-color:transparent;" class="scroll">
	

	
			<div class="scrollContainer" style="background-color:transparent !important;">
		
	
		
	                <div class="panel" id="panel_1" style="border:0 !important;">
						<div class="inside">
							<img src="moving_slider/images/content/1.jpg" alt="picture" />
						
						</div>
					</div>

	                <div class="panel" id="panel_2" style="border:0 !important;">
						<div class="inside">
							<img src="moving_slider/images/content/2.jpg" alt="picture" />
						
						</div>
					</div>
				
	                <div class="panel" id="panel_3" style="border:0 !important;">
						<div class="inside">
							<img src="moving_slider/images/content/3.jpg" alt="picture" />
							
						</div>
					</div>
					
					<div class="panel" id="panel_4" style="border:0 !important;">
						<div class="inside">
							<img src="moving_slider/images/content/4.jpg" alt="picture" />
							
						</div>
					</div>
					
					<div class="panel" id="panel_5" style="border:0 !important;">
						<div class="inside" >
							<img src="moving_slider/images/content/5.jpg" alt="picture" />
							
						</div>
					</div>
				
<div class="panel" id="panel_6" style="border:0 !important;">
						<div class="inside" >
							<img src="moving_slider/images/content/6.jpg" alt="picture" />
							
						</div>
					</div>

<div class="panel" id="panel_7" style="border:0 !important;">
						<div class="inside" >
							<img src="moving_slider/images/content/7.jpg" alt="picture" />
							
						</div>
					</div>

<div class="panel" id="panel_8" style="border:0 !important;">
						<div class="inside" >
							<img src="moving_slider/images/content/8.jpg" alt="picture" />
							
						</div>
					</div>

<div class="panel" id="panel_9" style="border:0 !important;">
						<div class="inside" >
							<img src="moving_slider/images/content/9.jpg" alt="picture" />
							
						</div>
					</div>


<div class="panel" id="panel_10" style="border:0 !important;">
						<div class="inside" >
							<img src="moving_slider/images/content/10.jpg" alt="picture" />
							
						</div>
					</div>

<div class="panel" id="panel_11" style="border:0 !important;">
						<div class="inside" >
							<img src="moving_slider/images/content/11.jpg" alt="picture" />
							
						</div>
					</div>			
	

                </div>

				<div id="left-shadow" style=" width:145px; height:357px; background-color:black; opacity: 0.6;  filter: alpha(Opacity=70);">
				<img class="scrollButtons left" style="margin:0 !important; width:145px; height:360px;" src="moving_slider/images/leftarrow.png">
				</div>
				<div id="right-shadow" style=" width:145px; height:357px; background-color:black; opacity: 0.6;  filter: alpha(Opacity=70);">
				<img class="scrollButtons right" style="margin:0 !important; width:145px; height:360px;" src="moving_slider/images/rightarrow.png"></div>


	<!---->




            </div>

	

        </div>
        
		
		
		
    </div>
	

	
	<!--moving-slider-->';												
													
													
													
													
													
											echo"		</div>";
													
													
													
													
													
													
													
													}else if($log_news==1){//новости
														echo"</br><h1>Новости</h1>";				
														echo'<div align="left" style=" width:907px; background-color:transparent;
														overflow:auto; padding-left:10px; padding-right:10px; 
														padding-top:10px; padding-bottom:10px;">';
													   // echo' <jdoc:include type="component" />';
													  // echo' <jdoc:include type="modules" name="news1"/>';
												
													$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");

$query="SELECT * FROM cms_retinanews ORDER BY date DESC";
$res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }
					
$count=0;//число записей в новостях
$query_count="SELECT COUNT(*) FROM cms_retinanews";
$res_count=mysql_query($query_count);
					if($res_count==false){
	    			echo"Ошибка выполнения запроса (error_count).</br>";
					echo mysql_error();
					exit; }	
	$row_count=mysql_fetch_array($res_count);				
$count=$row_count[0];
				
$count_str=0;//число страниц, на которые уместятся все новости
$count_str=$count/5;
$count_str=ceil($count_str);	//округление в большую сторону
			



if(($_GET['str']==NULL)||($_GET['str']=='')||(!isset($_GET['str']))){
//текущая страница
$_GET['str']=1;

};

//echo"".$_GET['str']."</br>";


	
					
//перевод на русский язык названий дней недели.
		$week_rus=array("Понедельник","Вторник","Среда","Четверг","Пятница","Суббота","Воскресенье");		
		$week_eng=array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
	


$min=0;//номер первой новости
$max=0;//номер последней новости

$max=5*($_GET['str']);

$min=$max-4;	
	
//echo"min ".$min."</br>";
//echo"max ".$max."</br>";
	
$i_tmp=1;		
		
	while($row=mysql_fetch_array($res)){

//if($i_tmp==5){break; };

if($i_tmp<$min){ $i_tmp++; continue;};

if($i_tmp>$max){$i_tmp++; break; };


$i_tmp++;


$row['date'] = str_replace( $week_eng, $week_rus, $row['date'] );


echo'


<fieldset style="padding:10px; border:1px black solid; width:860px; margin-top:0px;" >
<legend>'.$row['date'].'</legend>





<div align="left" style="margin-left:0px; float:left; width:860px;">
<!--image-->

<div style="width:50px; height:50px; overflow:hidden; background-image:url('.$this->baseurl.'/images/not_image.jpg); 
float:left; margin-right:10px; margin-bottom:10px;">';
if($row['image']!=""){
echo'<img src="'.$this->baseurl.'/'.$row['image'].'" alt="" style="float:left; margin:0px; margin-top:0px; 
margin-left:0px;" />';
};
echo'
<!--image-->
</div>
<span>'.$row['text'].'</span></div>




</fieldset>

<div style="width:630px; height:10px; "></div>
';






//echo'<div style="background-color:green; width:300px; height:130px;">
//<p>'.$row['date'].'</p>
//<p>'.$row['text'].'</p>
//echo'<p><img src="'.$this->baseurl.'/'.$row['image'].'" alt="" /></p>';
//</div>';





}			
										
												
														echo"</div>";
//str - текущая страница

//кнопки "вперёд", "назад" и т.д.
echo'<div align="center" style="width:927px; height:40px; background-color:transparent;">
<div align="center" style="width:400px; height:20px; padding-top:10px; padding-bottom:10px; background-color:transparent;">';


if($_GET['str']!=1){//если мы не на первой странице
echo'
<a href="index.php/news/?str=1"><span style="color:black">Начало</span></a> ';
};



if($_GET['str']!=1){//если мы не на первой странице

//предыдущая страница
$prev=$_GET['str']-1;
echo'
<a href="index.php/news/?str='.$prev.'"><span style="color:black">Назад</span></a> ';
};

///////////////////////

if($_GET['str']==1){

echo'
<a href="index.php/news/?str=1"><span style="color:red">1</span></a> ';
};


//////////////////////
if($count_str==3){
if($_GET['str']!=2){
echo'
<a href="index.php/news/?str=2"><span style="color:black">2</span></a> ';
}else if($_GET['str']==2){
echo'
<a href="index.php/news/?str=2"><span style="color:red">2</span></a> ';
};

};




///////////////////////

if($count_str==4){
if($_GET['str']!=2){
echo'
<a href="index.php/news/?str=2"><span style="color:black">2</span></a> ';
}else if($_GET['str']==2){
echo'
<a href="index.php/news/?str=2"><span style="color:red">2</span></a> ';
};

if($_GET['str']!=3){
echo'
<a href="index.php/news/?str=3"><span style="color:black">3</span></a> ';
}else if($_GET['str']==3){
echo'
<a href="index.php/news/?str=3"><span style="color:red">3</span></a> ';
};

};
///////////////////////


if($count_str>4){//$count_str>4



if($_GET['str']!=2){
echo'
<a href="index.php/news/?str=2"><span style="color:black">2</span></a> ';
}else if($_GET['str']==2){
echo'
<a href="index.php/news/?str=2"><span style="color:red">2</span></a> ';
};

if($_GET['str']!=3){
echo'
<a href="index.php/news/?str=3"><span style="color:black">3</span></a> ';
}else if($_GET['str']==3){
echo'
<a href="index.php/news/?str=3"><span style="color:red">3</span></a> ';
};


echo'<span style="color:black"> ... </span>';


//если мы не на первой, не на второй, не на третьей и не на последней странице, то...
if(($_GET['str']!=1)&&($_GET['str']!=2)&&($_GET['str']!=3)&&($_GET['str']!=$count_str)&&($_GET['str']!=($count_str-1))){

echo'
<a href="index.php/news/?str='.$_GET['str'].'"><span style="color:red">'.$_GET['str'].'</span></a> ';
echo'<span style="color:black"> ... </span>';

};




if($_GET['str']!=($count_str-1)){
echo'<a href="index.php/news/?str='.($count_str-1).'"><span style="color:black">'.($count_str-1).'</span></a>';}
else if($_GET['str']==($count_str-1)){
echo'<a href="index.php/news/?str='.($count_str-1).'"><span style="color:red">'.($count_str-1).'</span></a>';
};


};//$count_str>4
/////////////////////////////////////////////


if($_GET['str']==$count_str){//если мы на последней странице
echo'
<a href="index.php/news/?str='.$count_str.'"><span style="color:red">'.$count_str.'</span></a> ';

};



/////////////////////////////////////////////
if($_GET['str']!=$count_str){//если мы не на последней странице

//следующая страница
$next=$_GET['str']+1;
echo'
<a href="index.php/news/?str='.$next.'"><span style="color:black">Вперёд</span></a> ';
};


if($_GET['str']!=$count_str){//если мы не на последней странице
echo'
<a href="index.php/news/?str='.$count_str.'"><span style="color:black">Конец</span></a> ';
};


echo'
</div>

</div>';










//новости
														}else if($log_gallery==1){//галерея
													
														echo"<!--gallery-->";
														
												echo'		<div id="wrapper" >



  <div id="viewer">

   	 


 <div class="large_image_wrap">

       	      <div style="width:24px; height:57px; background-color:transparent; position:absolute; left:20px !important;
			  margin-top:170px;">
			  <a href="javascript:void(0);" class="prev_img" >
	 <img src="/gallery/images/prev.png"  alt="previous image" /></a> </div>
		 
		 <div style="width:24px; height:57px;background-color:transparent; position:absolute; left:880px !important;
		 margin-top:170px; ">
		  <a href="javascript:void(0);" class="next_img" >
		  <img src="/gallery/images/next.png" alt="next_image" /></a></div>
		 
 
            <div class="large_image_holder loading"> </div>
      </div>
        <!--end  large image --> 
      
 
  
     <div  id="thumb_wrapper">
     <a href="javascript:void(0);" class="previous"><img src="/gallery/images/prev2.png" alt="backward" /></a>
     <div class="thumb_holder">
	 
	 
        <ul class="thumbs">
        <li class="section">
          <ul class="sub_section" style="padding:0 !important; width:800px !important;">
            <li class="first"><a href="gallery/images_content/auto/1.jpg" rel="" class="one current"><img src="gallery/images_content/auto/mini/1.jpg" alt="" /></a></li>
            <li><a href="gallery/images_content/auto/2.jpg" rel=""><img src="gallery/images_content/auto/mini/2.jpg" alt="" /></a></li>
            <li><a href="gallery/images_content/auto/3.jpg" rel=""><img src="gallery/images_content/auto/mini/3.jpg" alt="" /></a></li>
            <li><a href="gallery/images_content/auto/4.jpg" rel=""><img src="gallery/images_content/auto/mini/4.jpg" alt="" /></a></li>
            <li><a href="gallery/images_content/auto/5.jpg" rel=""><img src="gallery/images_content/auto/mini/5.jpg" alt="" /></a></li>
            <li><a href="gallery/images_content/auto/6.jpg" rel=""><img src="gallery/images_content/auto/mini/6.jpg" alt="" /></a></li>
            <li><a href="gallery/images_content/auto/7.jpg" rel=""><img src="gallery/images_content/auto/mini/7.jpg" alt="" /></a></li>
            <li><a href="gallery/images_content/auto/8.jpg" rel=""><img src="gallery/images_content/auto/mini/8.jpg" alt="" /></a></li>
          </ul>
        </li>
        <li class="section">
          <ul class="sub_section">
            <li><a href="gallery/images_content/auto/9.jpg" rel=""><img src="gallery/images_content/auto/mini/9.jpg" alt="" /></a></li>
            <li><a href="gallery/images_content/gruz/1.jpg" rel=""><img src="gallery/images_content/gruz/mini/1.jpg" alt="" /></a></li>
            <li><a href="gallery/images_content/gruz/2.jpg" rel=""><img src="gallery/images_content/gruz/mini/2.jpg" alt="" /></a></li>
            <li><a href="gallery/images_content/gruz/3.jpg" rel=""><img src="gallery/images_content/gruz/mini/3.jpg" alt="" /></a></li>
            <li><a href="gallery/images_content/gruz/4.jpg" rel=""><img src="gallery/images_content/gruz/mini/4.jpg" alt="" /></a></li>
            <li><a href="gallery/images_content/gruz/5.jpg" rel=""><img src="gallery/images_content/gruz/mini/5.jpg" alt="" /></a></li>
            <li><a href="gallery/images_content/gruz/6.jpg" rel=""><img src="gallery/images_content/gruz/mini/6.jpg" alt="" /></a></li>
            <li><a href="gallery/images_content/gruz/7.jpg" rel=""><img src="gallery/images_content/gruz/mini/7.jpg" alt="" /></a></li>
          </ul>
        </li>
		<li class="section">
          <ul class="sub_section">
            <li><a href="gallery/images_content/jd/1.jpg" rel=""><img src="gallery/images_content/jd/mini/1.jpg" alt="" /></a></li>
            <li><a href="gallery/images_content/jd/2.jpg" rel=""><img src="gallery/images_content/jd/mini/2.jpg" alt="" /></a></li>
            <li><a href="gallery/images_content/jd/3.jpg" rel=""><img src="gallery/images_content/jd/mini/3.jpg" alt="" /></a></li>
            <li><a href="gallery/images_content/jd/4.jpg" rel=""><img src="gallery/images_content/jd/mini/4.jpg" alt="" /></a></li>
            <li><a href="gallery/images_content/jd/5.jpg" rel=""><img src="gallery/images_content/jd/mini/5.jpg" alt="" /></a></li>
            <li><a href="gallery/images_content/jd/6.jpg" rel=""><img src="gallery/images_content/jd/mini/6.jpg" alt="" /></a></li>
            <li><a href="gallery/images_content/jd/7.jpg" rel=""><img src="gallery/images_content/jd/mini/7.jpg" alt="" /></a></li>
            <li><a href="gallery/images_content/jd/8.jpg" rel=""><img src="gallery/images_content/jd/mini/8.jpg" alt="" /></a></li>
          </ul>
        </li>
		<li class="section">
          <ul class="sub_section">
            <li><a href="gallery/images_content/jd/9.jpg" rel=""><img src="gallery/images_content/jd/mini/9.jpg" alt="" /></a></li>
            <li><a href="gallery/images_content/jd/10.jpg" rel=""><img src="gallery/images_content/jd/mini/10.jpg" alt="" /></a></li>
            <li><a href="gallery/images_content/jd/11.jpg" rel=""><img src="gallery/images_content/jd/mini/11.jpg" alt="" /></a></li>
            <li><a href="gallery/images_content/jd/12.jpg" rel=""><img src="gallery/images_content/jd/mini/12.jpg" alt="" /></a></li>
            <li><a href="gallery/images_content/jd/13.jpg" rel=""><img src="gallery/images_content/jd/mini/13.jpg" alt="" /></a></li>
            <li><a href="gallery/images_content/jd/14.jpg" rel=""><img src="gallery/images_content/jd/mini/14.jpg" alt="" /></a></li>
            <li><a href="gallery/images_content/jd/15.jpg" rel=""><img src="gallery/images_content/jd/mini/15.jpg" alt="" /></a></li>
            <li><a href="gallery/images_content/jd/16.jpg" rel=""><img src="gallery/images_content/jd/mini/16.jpg" alt="" /></a></li>
          </ul>
        </li>
        <li class="section">
          <ul class="sub_section">
          	<li><a href="gallery/images_content/jd/17.jpg" rel=""><img src="gallery/images_content/jd/mini/17.jpg" alt="" /></a></li>
            <li><a href="gallery/images_content/jd/18.jpg" rel=""><img src="gallery/images_content/jd/mini/18.jpg" alt="" /></a></li>
            <li class="last"><a href="gallery/images_content/jd/19.jpg" rel=""><img src="gallery/images_content/jd/mini/19.jpg" alt="" /></a></li>
          </ul>
          </li>
      </ul>
    </div>
   <a href="javascript:void(0);" class="next"><img src="/gallery/images/next2.png" alt="foreward" /></a> 
    </div>
    </div>
    <!--end thumbs-->
 </div>
</div>';

														
														
														echo"<!--gallery-->";
														
														
														}else if($log_documentation==1){//документация
														
														echo"</br><h1>Документация</h1>";
														
														echo'<div align="left" style="height:300px; width:907px; background-color:transparent;
														overflow:auto; padding-left:10px; padding-right:10px; 
														padding-top:10px; padding-bottom:10px; overflow:hidden !important;">
														
														<div align="center" style="float:left; width:290px; 
														height:300px; margin-left:1px; background-color:transparent">
														<div align="center" style="width:290px; height:150px; 
														background-color:transparent; margin-top:30px;">
														<a href=""><img src="'.$this->baseurl.'/images/documentation/file.png" border="0"
														alt="" title="" style="cursor:pointer"/>
														</a>
														</div>
														<div align="center" style="width:290px; height:30px;">
														<a href=""><span style="font-size:14pt; color:#333;">Заказ</span></a>
														</div>
														
														</div>
														
														<div align="center"  style="float:left; width:290px; height:300px; 
														margin-left:1px; background-color:transparent">
														<div align="center" style="width:290px; height:150px; 
														background-color:transparent; margin-top:30px;">
														<a href=""><img src="'.$this->baseurl.'/images/documentation/feature.png" border="0"
														alt="" title="" style="cursor:pointer"/>
														</a>
														</div>
														<div align="center" style="width:290px; height:30px;">
														<a href=""><span style="font-size:14pt; color:#333;">Договор</span></a>
														</div>
														
														</div>
														
														<div align="center"  style="float:left; width:290px; height:300px; 
														margin-left:1px; background-color:transparent">
														<div align="center" style="width:290px; height:150px; 
														background-color:transparent; margin-top:30px;">
														<a href=""><img src="'.$this->baseurl.'/images/documentation/events.png"  border="0"
														alt="" title="" style="cursor:pointer"/>
														</a>
														</div>
														<div align="center" style="width:290px; height:30px;">
														<a href=""><span style="font-size:14pt; color:#333;">Акт приёма/передачи</span></a>
														</div>
														
														</div>
														
														</div>';
														
														
														}
														
														else{//прочие страницы
														
														echo' <jdoc:include type="component" />';
													   echo' <jdoc:include type="modules" name="news1"/>';
														
														}
															
														?>
													
	
														 <!---------------------------------------------------------------------------->
                                             </div><!-- end main -->

                                       </div><!-- end wrapper -->

                                <?php if ($showRightColumn) : ?>
                                        <h2 class="unseen">
                                                <?php echo RText::_('TPL_BEEZ2_ADDITIONAL_INFORMATION'); ?>
                                        </h2>
                                        <!--<div id="close">
                                                <a href="#" onclick="auf('right')">
                                                        <span id="bild">
                                                                <?php //echo RText::_('TPL_BEEZ2_TEXTRIGHTCLOSE'); ?></span></a>
                                        </div>-->


                                        <!--<div id="right" >
                                                <a id="additional"></a>
                                               <!-- <jdoc:include type="modules" name="position-6" style="beezDivision" headerLevel="3"/>
                                                <jdoc:include type="modules" name="position-8" style="beezDivision" headerLevel="3"  />
                                                <jdoc:include type="modules" name="position-3" style="beezDivision" headerLevel="3"  />-->
                                       <!-- </div><!-- end right -->
                                        <?php endif; ?>

                        <?php if ($navposition=='center' and $showleft) : ?>

                                        <div class="left <?php if ($showRightColumn==NULL){ echo 'leftbigger';} ?>" id="nav" >

                                                <jdoc:include type="modules" name="position-7"  style="beezDivision" headerLevel="3" />
                                                <jdoc:include type="modules" name="position-4" style="beezHide" headerLevel="3" state="0 " />
                                                <jdoc:include type="modules" name="position-5" style="beezTabs" headerLevel="2"  id="3" />


                                        </div><!-- end navi -->
                   <?php endif; ?>

                               <div class="wrap"></div>


								</div>
								<!--background-color:yellow !important;-->
                                </div> <!-- end contentarea -->

                        </div><!-- back -->

                </div><!-- all -->
	  
</div>
</div>
</div>

	
	
	
	<!---------------------------------------------------------------->		
	
	<!---------------------------------------------------------------->
	
	
	<!--</div>-->
	
	
	<!--<div id="footerwrap" style="background-color:blue;
	margin-top: 40px; padding: 40px 0px; color: #eee; border-top: 8px double #fff;
	height:40px; width:100%">-->
	
	

                <div id="footer-outer">
                        <?php if ($showbottom) : ?>
                        <div id="footer-inner" style="border:0px black solid !important; padding:0 !important;
						background-color:#e0dedf !important; width:939px !important" align="center">
				
				
										
				
                                <div id="bottom" align="center" style="background-color:white !important; border:0 !important; 
								padding:0 !important; margin:0 !important; 
								width:939px !important; height:338px !important;" >
                                     <!--    <div class="box box1"> --> 
									
										
										
									   <jdoc:include type="modules" name="slider-1" />
									  
									  
									   
									   <!--</div>-->
                                     <!--  <div class="box box2"> <jdoc:include type="modules" name="position-10" style="beezDivision" headerlevel="3" /></div>
                                        <div class="box box3"> <jdoc:include type="modules" name="position-11" style="beezDivision" headerlevel="3" /></div>-->
                                </div>
								
 <div style="width:100%; height:20px; "></div>
 <jdoc:include type="modules" name="position-9" style="beezDivision" headerlevel="3" />
                        </div>
                                <?php endif ; ?>



                        <div id="footer-sub" 
						style="height:158px !important; background-color:white !important;
					
						background-repeat:no-repeat !important;
					    background-color:transparent !important;
						background-position:center top !important;
						background-image:url('<?php echo $this->baseurl ?>/images/footer_fon_100_2.jpg');
					<?php if ($fpage=="1") {
					echo' margin-top:-50px; ';};  ?>   

					<?php if ($log_news==1) {
					echo' margin-top:-50px; ';}; ?>   
					
					<?php if ($log_gallery==1) {
					echo' margin-top:-50px; ';}; ?> 	

 " align="center"><!--footer-sub-->
							<!-- -->
							
	<div style="height:158px; width:100%; background-color:transparent; 
	background-image:url('<?php echo $this->baseurl ?>/images/footer.png');
					background-position:center top; background-repeat:no-repeat; 
					
					
					" align="center">					
						
				<div id="footer-sub2" style="height:158px; width:1200px; padding:0; margin:0; 
					background-image:url('<?php echo $this->baseurl ?>/images/footer.png');
					background-position:center top; background-repeat:no-repeat; background-color:transparent !important;
				"><!--Footer-sub-2-->

<!--	-->

<!---->


                                <div id="footer" 
								style="width:960px !important;padding:0 !important; margin:0 !important; padding-top:0px !important;
								"
								 align="center">

                                      <!--  <jdoc:include type="modules" name="position-14" />-->
                                  
								<div style="width:960px; height:158px; border:0px black solid;  
								">
								 <div align="left" style="width:370px; height:158px; border:0px black solid; float:left;">
								 <div align="left" style="width:200px; height:40px; margin-top:95px;
								 margin-left:130px;">
								 <span style="color:#d4b5b3; font-size:8pt;">&copy; 2013 &laquo;Спецтранс&raquo; </br> 
									Амурская область, г.Благовещенск</span>
								 </div>
								 </div>
								 
								<div align="center" style="width:220px; height:158px; border:0px black solid; float:left;"><!--логотип в футере-->
								<a href="/"><div style="width:193px; height:55px;  
								background-image:url('<?php echo $this->baseurl ?>/images/logo_footer.png');
								background-repeat:no-repeat;
								margin-left:15px; margin-top:80px; border:0px;"></div></a>
								</div><!--логотип в футере-->
								
								<div align="left" style="width:300px; height:158px; border:0px black solid; float:left;">
								<div align="right" style="width:200px; height:40px; margin-top:95px;
								 margin-left:30px;">
								 <a href="http://www.retina-studio.ru">
								 <span style="color:#d4b5b3; font-size:8pt;font-weight:bold;">designed by retina</span>
								 </a>
								 </div>
								</div>
								</div>
								
                                </div><!-- end footer -->
				</div><!--Footer-sub-2-->
				
		</div>		
                        </div><!--footer-sub-->

                </div>
       <!-- <jdoc:include type="modules" name="debug" />-->
   
	
	
	
	
	
	<!--</div>-->

<!--====================================================-->

													
												
													
        </body>
</html>
	
<script type="text/javascript">

function sec() {
  $(".right").click();
}
setInterval(sec, 5000) 


</script>
