<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Getting params from template
$params = JFactory::getApplication()->getTemplate(true)->params;

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->getCfg('sitename');

if($task == "edit" || $layout == "form" )
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');
$doc->addScript('templates/' .$this->template. '/js/template.js');

// Add Stylesheets
$doc->addStyleSheet('templates/'.$this->template.'/css/template.css');

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

// Add current user information
$user = JFactory::getUser();

// Adjusting content width
if ($this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span6";
}
elseif ($this->countModules('position-7') && !$this->countModules('position-8'))
{
	$span = "span9";
}
elseif (!$this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span9";
}
else
{
	$span = "span12";
}

// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="'. JUri::root() . $this->params->get('logoFile') .'" alt="'. $sitename .'" />';
}
elseif ($this->params->get('sitetitle'))
{
	$logo = '<span class="site-title" title="'. $sitename .'">'. htmlspecialchars($this->params->get('sitetitle')) .'</span>';
}
else
{
	$logo = '<span class="site-title" title="'. $sitename .'">'. $sitename .'</span>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="ru">

<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<head>
<meta name="robots" content="all">

<meta name="description" content="Детский Центр Досуга и Развития ПРОДЛЕНКА - клуб для детей и родителей, программы развития детей раннего возраста, школа будущих родителей, клуб стильные мамочки и мн. др. г. Благовещенск.">
<meta name="keywords" content="Детский клуб, развивающие занятия, праздники, раннее развитие, клуб теремок,  школа будущих родителей, методики развития детей раннего возраста, детский психолог, логопед, подготовка к школе Благовещенска">
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
<title>Продленка | Центр детского досуга и развития</title>
<link rel="stylesheet" type="text/css" href="index_files/styles00.css">


<link rel="stylesheet" type="text/css" href="index_files/highslid.css">
<!--[if IE 6]>
<link rel='stylesheet' type='text/css' href='/shared/highslide-4.1.13/highslide-ie6.css'/>
<![endif]-->
<!--[if lte IE 7 ]>
<link rel='stylesheet' type='text/css' href='/shared/highslide-4.1.13/style1_ie.css'/>
<![endif]-->

<script type="text/javascript" src="index_files/highslid.js"></script>

<script type="text/javascript" src="index_files/flowplay.js"></script>

<!-- 46b9544ffa2e5e73c3c971fe2ede35a5 -->
<link rel="stylesheet" type="text/css" href="index_files/calendar.css">
<script type="text/javascript" src="index_files/ru000000.js"></script>
<script type="text/javascript" src="index_files/cookie00.js"></script>
<script type="text/javascript" src="index_files/widgets0.js"></script>
<script type="text/javascript" src="index_files/calendar.js"></script>
<script type="text/javascript" src="index_files/feedback.js"></script>




 <link rel="stylesheet" href="/plugins/system/jcemediabox/css/jcemediabox.css?version=116" type="text/css" />
  <link rel="stylesheet" href="/plugins/system/jcemediabox/themes/standard/css/style.css?version=116" type="text/css" />
  <link rel="stylesheet" href="/templates/protostar/css/template.css" type="text/css" />
  <link rel="stylesheet" href="/media/mod_pwebcontact/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="/media/mod_pwebcontact/css/layout.css" type="text/css" />
  <link rel="stylesheet" href="/media/mod_pwebcontact/css/animations.css" type="text/css" />
  <link rel="stylesheet" href="/media/mod_pwebcontact/css/background/white.css" type="text/css" />
  <link rel="stylesheet" href="/media/mod_pwebcontact/css/form/blue.css" type="text/css" />
  <link rel="stylesheet" href="/media/mod_pwebcontact/css/toggler/blue.css" type="text/css" />
  <link rel="stylesheet" href="/cache/mod_pwebcontact/4b8a99dda58154f2d159285bbd2333a9.css" type="text/css" />
  
  <script src="/media/jui/js/jquery.min.js" type="text/javascript"></script>
<!--    <script src="/media/jui/js/jquery-noconflict.js" type="text/javascript"></script>
  <script src="/media/jui/js/jquery-migrate.min.js" type="text/javascript"></script>
  <script src="/media/system/js/tabs-state.js" type="text/javascript"></script>-->
  
  <!--<script src="/media/system/js/caption.js" type="text/javascript"></script>-->
  <!--<script src="/plugins/system/jcemediabox/js/jcemediabox.js?version=116" type="text/javascript"></script>-->
  <script src="/media/jui/js/bootstrap.min.js" type="text/javascript"></script>
  <!--<script src="/templates/protostar/js/template.js" type="text/javascript"></script>-->
  <script src="/media/mod_pwebcontact/js/jquery.ui.effects.min.js" type="text/javascript"></script>
  <script src="/media/mod_pwebcontact/js/jquery.validate.min.js" type="text/javascript"></script>
  <script src="/media/mod_pwebcontact/js/jquery.pwebcontact.min.js" type="text/javascript"></script>
  <script type="text/javascript">
jQuery(window).on('load',  function() {
				new JCaption('img.caption');
			});
JCEMediaBox.init({popup:{width:"",height:"",legacy:0,lightbox:0,shadowbox:0,resize:1,icons:1,overlay:1,overlayopacity:0.8,overlaycolor:"#000000",fadespeed:500,scalespeed:500,hideobjects:0,scrolling:"fixed",close:2,labels:{'close':'Close','next':'Next','previous':'Previous','cancel':'Cancel','numbers':'{$current} of {$total}'}},tooltip:{className:"tooltip",opacity:0.8,speed:150,position:"br",offsets:{x: 16, y: 16}},base:"/",imgpath:"plugins/system/jcemediabox/img",theme:"standard",themecustom:"",themepath:"plugins/system/jcemediabox/themes"});
  </script>
  <script type="text/javascript">
    (function() {
      var strings = {"MOD_PWEBCONTACT_INIT":"\u0418\u043d\u0438\u0446\u0438\u0430\u043b\u0438\u0437\u0430\u0446\u0438\u044f \u043e\u0442\u043f\u0440\u0430\u0432\u043a\u0438 \u0444\u043e\u0440\u043c\u044b...","MOD_PWEBCONTACT_SENDING":"\u0418\u0434\u0435\u0442 \u043e\u0442\u043f\u0440\u0430\u0432\u043a\u0430...","MOD_PWEBCONTACT_SEND_ERR":"\u041f\u043e\u0434\u043e\u0436\u0434\u0438\u0442\u0435 \u043d\u0435\u0441\u043a\u043e\u043b\u044c\u043a\u043e \u0441\u0435\u043a\u0443\u043d\u0434, \u043f\u0440\u0435\u0436\u0434\u0435 \u0447\u0435\u043c \u043e\u0442\u043f\u0440\u0430\u0432\u043b\u044f\u0442\u044c \u0441\u043b\u0435\u0434\u0443\u044e\u0449\u0435\u0435 \u0441\u043e\u043e\u0431\u0449\u0435\u043d\u0438\u0435","MOD_PWEBCONTACT_REQUEST_ERR":"\u041e\u0448\u0438\u0431\u043a\u0430 \u0437\u0430\u043f\u0440\u043e\u0441\u0430: ","MOD_PWEBCONTACT_COOKIES_ERR":"\u0412\u043a\u043b\u044e\u0447\u0438\u0442\u0435 \u043a\u0443\u043a\u0438 (cookies) \u0432 \u0431\u0440\u0430\u0443\u0437\u0435\u0440\u0435 \u0438 \u043e\u0431\u043d\u043e\u0432\u0438\u0442\u0435 \u0441\u0442\u0440\u0430\u043d\u0438\u0446\u0443"};
      if (typeof Joomla == 'undefined') {
        Joomla = {};
        Joomla.JText = strings;
      }
      else {
        Joomla.JText.load(strings);
      }
    })();
  </script>




</head>
<body>
<div id="popup" style="margin-top: -157.5px; margin-left: -215px;">
  <iframe frameborder="0" hspace="0" width="430" height="315" src="/send.php"></iframe>
  <div id="close_popup"></div>
  <script type="text/javascript" src="index_files/jquery-1.js"></script>		<script type="text/javascript" src="index_files/popup000.js"></script>
</div>
<div id="overlay" style="opacity: 0.5;"></div>
<div id="site-wrap">
  <div id="site-wrap-in">
    <div class="site-header">
      <div class="site-logo"><a href="http://prodlenka28.ru/"><img src="index_files/spf.png"></a></div>
     
		<div class="sale1">
		<jdoc:include type="modules" name="sale1" style="xhtml" />
		</div>
	   
          <div class="search">
              <form action="http://prodlenka28.ru/search.php" class="search-form">
                  <input type="text" name="search" class="search-text" onblur="this.value=this.value==''?'поиск по сайту':this.value" onfocus="this.value=this.value=='поиск по сайту'?'':this.value;" value="поиск по сайту">
                  <input type="submit" class="search-button" value>
              </form> 
          </div>
		  
      <ul class="menu-top">
                <li <?php if(($_GET["id"] == 2) || ($_SERVER['REQUEST_URI'] == "/")) {?>id="active" <?php } ?> ><a href="/index.php?option=com_content&view=article&id=2"><span>О нас</span></a></li>
                <li <?php if($_GET["id"] == 4) {?>id="active" <?php } ?>><a href="/index.php?option=com_content&view=article&id=4"><span>Афиша</span></a></li>
				<li <?php if($_GET["id"] == 11){ ?>id="active" <?php } ?>><a href="/index.php?option=com_content&view=article&id=11"><span>Напишите нам</span></a></li>
                <li <?php if($_GET["id"] == 12) {?>id="active" <?php } ?>><a href="/index.php?option=com_content&view=article&id=12"><span>Наш адрес</span></a></li>
                <li><a id="show_popup" href="#"><span><img src="index_files/phone.png" style="position:relative; top:-5px;"><f  style="position:relative; top:-15px;">Записаться на занятие</span></f></a></li>
              </ul> 
    </div>
    <table class="site-content">
      <tr>
        <td class="site-content-left">
                  <div class="left-sidebar">
                                              <div class="lmenu-box">
                <ul class="menu-left"> 
				<li class="level1"><a href="http://ok.ru/profile/565199067520"><span>Наша страница в Одноклассниках</span></a></li>
				<li class="level1"><a href="/index.php?option=com_content&view=article&id=18"><span>Наша команда</span></a></li>
                                                        <li class="level1"><a href="/index.php?option=com_content&view=article&id=13"><span>Наши занятия</span></a></li>
                                                          <li class="level1"><a href="/index.php?option=com_content&view=article&id=10"><span>Расписание занятий</span></a></li>
                                                          <li class="level1"><a href="/index.php?option=com_content&view=article&id=5"><span>Наши цены</span></a></li>
                                                          <li class="level1"><a href="/index.php?option=com_content&view=article&id=14"><span>Для родителей</span></a></li>
                                                          <li class="level1"><a href="/index.php?option=com_content&view=article&id=6"><span>Акции Бонусы Скидки</span></a></li>
                                                          <li class="level1"><a href="/index.php?option=com_content&view=article&id=7"><span>Фотогаллерея</span></a></li>
                                                          <li class="level1"><a href="/index.php?option=com_content&view=article&id=8"><span>Детские праздники</span></a></li>
                      
							  <li class="level1"><a href="/index.php?option=com_content&view=article&id=15"><span>Отзывы</span></a></li>
                                                          <li class="level1"><a href="/index.php?option=com_content&view=article&id=41"><span>Наши товары и сувениры</span></a></li>
							  <li class="level1"><a href="/index.php?option=com_content&view=article&id=16"><span>Наши друзья и партнеры</span></a></li>
							  
                       
                </ul>
                      </div>




                                      
    
                      <div class="block-box">
                       <div class="block-bottom">  
                                     
                          <div class="lblock_title">Информация</div>  
                          <div class="lblock_text">
<p>	<jdoc:include type="modules" name="banner" style="xhtml" /></p>

  
<p style="text-align: left;">&nbsp;</p></div>
                                                     </div>   
                      </div>           
                      
         
                  </div>
				  
<!--блок с рекламой-->
<div class="lblock_advertising" align="center">
<jdoc:include type="modules" name="banner2" style="xhtml" />
<!--<span>
Здесь может быть Ваша реклама
</span>-->
</div>
<!--блок с рекламой-->				  
				  
				  
        </td>
        <td class="site-content-middle">
                  <div class="right-sidebar">
                      <div class="site-path"></div> 
                   
<script>
$(document).ready(function() {
     tsecond_passed();
	 document.getElementById('we4e45').innerHTML = document.getElementById('title').innerHTML;
			 
});
</script>

<?php if(($_GET["id"] == 2) || ($_SERVER['REQUEST_URI'] == "/")) {?>














<div class="testimonials" style="position:absolute; top:495px;  margin-left: -220px;  left:50%; width:620px; background: url('/index_files/comma.jpg') no-repeat;padding:10px 0 0 50px;">
 
<?php 


	$f = fopen("tsitats.txt", "r");

 
	while(!feof($f)) { 
	    $tsitati[] = fgets($f);
	}

	fclose($f);

	?>

<?php $iii=0; foreach ($tsitati as $tsitata) :?>
<div style="<?php if( $iii > 0) echo ' display:none; '; ?>" class="testi_item" id="ts<?php echo $iii; ?>"  >

<span style="align-content: stretch;
align-items: stretch;
align-self: stretch;
box-sizing: border-box;
column-gap: 16px;
display: block;
flex: 0 1 auto;
flex-basis: auto;
flex-direction: row;
flex-flow: row;
flex-grow: 0;
flex-shrink: 1;
flex-wrap: nowrap;
font: italic normal 400 16.1px/22.54px Ubuntu;
height: 46px;
justify-content: flex-start;
list-style: none;
margin: 0px;
order: 0;
color:666;
overflow-wrap: break-word;
padding: 0px;
resize: none;
word-wrap: break-word;">
<?php echo $tsitata; ?>
</span>

</div>

<?php $iii++; endforeach; ?>


<script>
 
var step=0;
function tsecond_passed() {
 $('#ts'+step).hide(500);
 
 var tmp = step + 1;
  $('#ts'+tmp).show(500);
 step ++;
 if (step > 6 )  {step = 0;
   $('#ts6').hide(500);
   $('#ts0').show(500);
 }
setTimeout("tsecond_passed()", 10000); 
}
</script>
</div>




<span style="color: #FF00FF;font-size: 16pt; ">Продленка - это центр для творческих и талантливых детей! В нашем центре мы делаем детей счастливыми!</span>

<br><br><br><br>


 <div class="content-box" >



<?php } else { ?>



				   
				   <?php }  ?>
                
                     
<jdoc:include type="component" />
<?php if($_GET["id"] == 11){ ?>
<center style="width:100%">
<form id="feedback-form" action="http://uralsb.ru/mail/send.php" method="POST">
<p><input name="to" type="hidden" value="prodlenka.28@bk.ru" /> <input name="from" type="hidden" value="perezvonimne@prodlenka28.ru" /> <input name="sbj" type="hidden" value="Заявка с сайта prodlenka28.ru" /> <input name="fields" type="hidden" value="4" /> Ваше имя *:</p>
<p><input name="f1" required="" size="40" type="text" placeholder="Как Вас зовут" /></p>
<p>Ваш телефон *:</p>
<p> <input name="f2" required="" size="40" type="phone" placeholder="Номер телефона" /></p>
<p>Ваш e-mail:</p>
<p> <input name="f3" required="" size="40" type="text" placeholder="ваша почта@mail.ru" /></p>
<p>Ваше сообщение:</p>
<p> <textarea cols="40" name="f4" required="" rows="6" placeholder="Ваше сообщение"></textarea></p>
<p><input type="submit" value="Отправить сообщение" /></p>
</form></center><?php } ?>


<?php if($_GET["id"] == 7){ ?>
<link rel="stylesheet" type="text/css" href="lightbox/css/jquery.lightbox-0.5.css" />
<link rel="stylesheet" type="text/css" href="demo.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="lightbox/js/jquery.lightbox-0.5.pack.js"></script>
<script type="text/javascript" src="script.js"></script>
<div id="gallery">

<?php

$directory = 'gallereya';

$allowed_types=array('jpg','jpeg','gif','png');
$file_parts=array();
$ext='';
$title='';
$i=0;

$dir_handle = @opendir($directory) or die("There is an error with your image directory!");

while ($file = readdir($dir_handle)) 
{
	if($file=='.' || $file == '..') continue;
	
	$file_parts = explode('.',$file);
	$ext = strtolower(array_pop($file_parts));

	$title = implode('.',$file_parts);
	$title = htmlspecialchars($title);
	
	$nomargin='';
	if(in_array($ext,$allowed_types))
	{
		if(($i+1)%2==0) $nomargin='nomargin';
	
		echo '<a class="pic '.$nomargin.'" href="'.$directory.'/'.$file.'" title="'.$title.'" target="_blank">
		<img style="height:230px;" src="http://prodlenka28.ru/'.$directory.'/'.$file.'"><br></a>';
		
		$i++;
	}
}

closedir($dir_handle);

?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div><?php } ?> 




<?php if($_GET["id"] == 15){ ?>
<center><h1> Отзывы: </h1></center> <table width="100%"><?php

	$f = fopen("otzivi.txt", "r");
	while(!feof($f)) { 
	    $tsitati[] = fgets($f);
	}
	fclose($f);
	$iii=0; foreach ($tsitati as $tsitata) :?>
	<?php $ts=explode("/#/", $tsitata); ?>
<tr><td><h4 ><span style="color: #ff0000;">
<?php echo $ts[0]; ?></span>  </h4>	</td><td><?php echo $ts[1]; ?>
 </td></tr>
<?php endforeach; ?></table>


<center>
<h1> Добавить отзыв </h1>
<form id="feedback-form" action="add.php" method="POST">
<p>
 Ваше имя *:
 </p>
<p><input name="f1" required="" size="40" type="text" placeholder="Как Вас зовут" /></p>
<p>Ваш отзыв:</p>
<p> <textarea cols="40" name="f2" required="" rows="6" placeholder="Ваш отзыв"></textarea></p>
<p><input type="submit" value="Оставить отзыв" /></p>
</form></center>

</div>
<?php } ?>

</div>
                  </div>
  			</td>
  		</tr>
  	</table>
      
  </div>
</div>

<div class="site-footer">
		<span style="position:relative;top:380px; left:360px;font-size: 14px">Разработка: Студия web дизайна <a href="http://karavella-media.ru">Karavella Media</a></span>
</div>


</body>
</html>



