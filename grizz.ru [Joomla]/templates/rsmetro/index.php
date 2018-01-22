<?php
// No direct access.


defined('_JEXEC') or die;
JHtml::_('jquery.framework');

error_reporting(E_ALL);
ini_set('pcre.backtrack_limit', 300000);

$menu = JFactory::getApplication()->getMenu();
$doc = JFactory::getDocument();
$doc->addScriptDeclaration(' jQuery(document).ready(function(){if(0<jQuery("#system-message-container > div").length){var a=jQuery("#system-message-container");a.animate({opacity:0},5E3,function(){a.remove()})}}); ');
$app = JFactory::getApplication();
$sitename = $app->getCfg('sitename');

// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="'. JURI::root() . $this->params->get('logoFile') .'" alt="'. $sitename .'" />';
}
elseif ($this->params->get('sitetitle'))
{
	$logo = '<span class="site-title" title="'. $sitename .'">'. htmlspecialchars($this->params->get('sitetitle')) .'</span>'; } else { $logo = '<span class="site-title" title="'. $sitename .'">'. $sitename .'</span>'; }

if($this->countModules('header_b and header_c') == 0) $header_a = "_full";
if($this->countModules('header_b or header_c') == 1) $header_a = "_middle";
if($this->countModules('header_b and header_c') == 1) $header_a = "_small";

if($this->countModules('top_b and top_c') == 0) $top_a = "_full";
if($this->countModules('top_b or top_c') == 1) $top_a = "_middle";
if($this->countModules('top_b and top_c') == 1) $top_a = "_small";

if($this->countModules('left and right') == 0) $contentwidth = "_full";
if($this->countModules('left or right') == 1) $contentwidth = "_middle";
if($this->countModules('left and right') == 1) $contentwidth = "_small";

if($this->countModules('bottom_b and bottom_c') == 0) $bottom_a = "_full";
if($this->countModules('bottom_b or bottom_c') == 1) $bottom_a = "_middle";
if($this->countModules('bottom_b and bottom_c') == 1) $bottom_a = "_small";

if($this->countModules('footer_b and footer_c') == 0) $footer_a = "_full";
if($this->countModules('footer_b or footer_c') == 1) $footer_a = "_middle";
if($this->countModules('footer_b and footer_c') == 1) $footer_a = "_small";

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<head>
	<jdoc:include type="head" />
	<?php if ($this->params->get('googleFont')) { ?>
		<link href='http://fonts.googleapis.com/css?family=<?php echo $this->params->get('googleFontName');?>' rel='stylesheet' type='text/css' />
		<style type="text/css"> h1,h2,h3,h4,h5,h6,.site-title{ font-family: '<?php echo str_replace('+', ' ', $this->params->get('googleFontName'));?>', sans-serif; } </style>
	<?php } ?>
	<link rel="stylesheet" href="templates/rsmetro/css/ios.css" media="only screen and (max-device-width:1024px)" />
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/rsmetro/css/template.css" type="text/css" />
	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="templates/rsmetro/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="templates/rsmetro/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="templates/rsmetro/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="templates/rsmetro/apple-touch-icon-144x144.png" />
    
    <link href='http://fonts.googleapis.com/css?family=Ubuntu&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
 <script src="/js/jquery-2.1.3.min.js"></script>
    
  <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>-->
<!--  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>-->



<?php
if((JURI::current() == JURI::base())){
?>    
    
<script type="text/javascript">
$(document).ready(function(){


        




$(".div1_1").mouseover(function() {
var block2 = document.getElementById("head1");
block2.style.color = "#ffffff";
var block3 = document.getElementById("text1");
block3.style.color = "#ffffff";
var block4 = document.getElementById("line1");
block4.style.backgroundColor = "#ffffff";

});

$(".div1_1").mouseout(function () {
var block2 = document.getElementById("head1");
block2.style.color = "#23262d";
var block3 = document.getElementById("text1");
block3.style.color = "#23262d";
var block4 = document.getElementById("line1");
block4.style.backgroundColor = "#ce0000";

});




$(".div1_2").mouseover(function() {
var block2 = document.getElementById("head2");
block2.style.color = "#ffffff";
var block3 = document.getElementById("text2");
block3.style.color = "#ffffff";
var block4 = document.getElementById("line2");
block4.style.backgroundColor = "#ffffff";

});

$(".div1_2").mouseout(function () {
var block2 = document.getElementById("head2");
block2.style.color = "#23262d";
var block3 = document.getElementById("text2");
block3.style.color = "#23262d";
var block4 = document.getElementById("line2");
block4.style.backgroundColor = "#ce0000";

});



$(".div1_3").mouseover(function() {
var block2 = document.getElementById("head3");
block2.style.color = "#ffffff";
var block3 = document.getElementById("text3");
block3.style.color = "#ffffff";
var block4 = document.getElementById("line3");
block4.style.backgroundColor = "#ffffff";

});

$(".div1_3").mouseout(function () {
var block2 = document.getElementById("head3");
block2.style.color = "#23262d";
var block3 = document.getElementById("text3");
block3.style.color = "#23262d";
var block4 = document.getElementById("line3");
block4.style.backgroundColor = "#ce0000";

});


$(".div1_4").mouseover(function() {
var block2 = document.getElementById("head4");
block2.style.color = "#ffffff";
var block3 = document.getElementById("text4");
block3.style.color = "#ffffff";
var block4 = document.getElementById("line4");
block4.style.backgroundColor = "#ffffff";

});

$(".div1_4").mouseout(function () {
var block2 = document.getElementById("head4");
block2.style.color = "#23262d";
var block3 = document.getElementById("text4");
block3.style.color = "#23262d";
var block4 = document.getElementById("line4");
block4.style.backgroundColor = "#ce0000";

});



$(".div1_5").mouseover(function() {
var block2 = document.getElementById("head5");
block2.style.color = "#ffffff";
var block3 = document.getElementById("text5");
block3.style.color = "#ffffff";
var block4 = document.getElementById("line5");
block4.style.backgroundColor = "#ffffff";

});

$(".div1_5").mouseout(function () {
var block2 = document.getElementById("head5");
block2.style.color = "#23262d";
var block3 = document.getElementById("text5");
block3.style.color = "#23262d";
var block4 = document.getElementById("line5");
block4.style.backgroundColor = "#ce0000";

});


$(".div1_6").mouseover(function() {
var block2 = document.getElementById("head6");
block2.style.color = "#ffffff";
var block3 = document.getElementById("text6");
block3.style.color = "#ffffff";
var block4 = document.getElementById("line6");
block4.style.backgroundColor = "#ffffff";

});

$(".div1_6").mouseout(function () {
var block2 = document.getElementById("head6");
block2.style.color = "#23262d";
var block3 = document.getElementById("text6");
block3.style.color = "#23262d";
var block4 = document.getElementById("line6");
block4.style.backgroundColor = "#ce0000";

});






});


</script>

<?php
}
?>

<?php
if( (!isset($_GET['send']))||($_GET['send']==NULL) ){
$_GET['send']="";

}
?>

<meta name='yandex-verification' content='7cb70d8956273a98' />

<meta name="mailru-domain" content="xkSagfmgcdu9n3No" />

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter29238385 = new Ya.Metrika({
                    id:29238385,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/29238385" style="position:absolute; left:-9999px;" alt="" /></div></noscript>


<style type="text/css">
.block_form .form4 .submit1{
display:none;	
}


</style>

</head>
<body id="body1"  <?php  if((JURI::current() == JURI::base()."order")||($_GET['send']=="ok")) {echo ' class="form" ';}?> >


<style type="text/css">

#detail_new .dop2,
#detail_new .dop3,
#detail_new .dop4,
#detail_new .dop5,
#detail_new .dop6,
#detail_new .dop7,
#detail_new .dop8,
#detail_new .dop9,
#detail_new .dop10,
#detail_new .dop11,
#detail_new .dop12,
#detail_new .dop13,
#detail_new .dop14,
#detail_new .dop15,
#detail_new .dop16,
#detail_new .dop17,
#detail_new .dop18,
#detail_new .dop19,
#detail_new .dop20,
#detail_new .dop21,
#detail_new .dop22,
#detail_new .dop23{
display:none;
}

</style>


    <div id="container_bg">
		<div class="header_bg">
			<div class="header">
            	<jdoc:include type="modules" name="top1" style="xhtml" />
                <jdoc:include type="modules" name="top2" style="xhtml" />
				<div class="headerlt">
					<jdoc:include type="modules" name="topmenu" style="xhtml" />
				</div>
				<div class="headerrt">
					<jdoc:include type="modules" name="login" style="xhtml" />
				</div>
			</div>	
		</div>	
        
        <div class="header_menu">
        	<div class="menu1">
            <a href="/"><img src="/templates/rsmetro/images/logo.png" class="logo"/></a>
            <jdoc:include type="modules" name="slogan1" style="xhtml" />
            <jdoc:include type="modules" name="menu1" style="xhtml" />
            <ul class="menu">
            	<li><a href="/">Главная</a></li>
            	<li><a href="<?php if((JURI::current() == JURI::base()."order")){ echo"http://grizz.ru/"; }?>#why-we">Почему именно мы?</a></li>
                <li><a href="<?php if((JURI::current() == JURI::base()."order")){ echo"http://grizz.ru/"; }?>#del-pay">Доставка и оплата</a></li>
                <li><a href="<?php if((JURI::current() == JURI::base()."order")){ echo"http://grizz.ru/"; }?>#about">О компании</a></li>
                <li><a href="<?php if((JURI::current() == JURI::base()."order")){ echo"http://grizz.ru/"; }?>#opt">Оптовым клиентам</a></li>
                <li><a href="<?php if((JURI::current() == JURI::base()."order")){ echo"http://grizz.ru/"; }?>#help">Помощь</a></li>
            </ul>
            </div>
        </div>
        
        
        <?php if((JURI::current() == JURI::base())){  ?>
        <div class="fon1">
        	<div class="block1">
            <jdoc:include type="modules" name="block1" style="xhtml" />
            <jdoc:include type="modules" name="block2" style="xhtml" />
            <jdoc:include type="modules" name="block3" style="xhtml" />
            </div>
        </div>
        <a name="why-we"/></a>
        <div class="fon2">
        	<div class="block2">
            <jdoc:include type="modules" name="block4" style="xhtml" />
            </div>
        </div>
        
        <div class="fon3">
        	<div class="block3">
            <jdoc:include type="modules" name="block5" style="xhtml" />
            </div>
        </div>
       <a name="del-pay"/></a>
        <div class="fon4">
        	<div class="block4">
            <jdoc:include type="modules" name="block_big" style="xhtml" />
            
            </div>
        </div>
        <a name="about"/></a>
        <div class="about">
        	<div class="block5">
            <jdoc:include type="modules" name="block_about" style="xhtml" />
            
            </div>
        </div>
        <a name="opt"/></a>
        <div class="opt">
        	<div class="block6">
            <jdoc:include type="modules" name="block_opt" style="xhtml" />
            </div>
        </div>
        <a name="help"></a>
        <div class="blocks">
        	<div class="block7">
            <jdoc:include type="modules" name="blocks" style="xhtml" />
            </div>
        </div>
        <?php } ?>
        
        

<?php
if((!isset($_GET['send']))||($_GET['send']=="NULL")){
$_GET['send']="";
}


if($_GET['send']=="ok"){
?>

<div class="big_block">
	<div class="block_form" style="height:400px; text-align:center; position:relaive;">
		<span style="
  width:825px;
  margin-left:auto;
  margin-right:auto;
  font-size: 30px;
  font-family: 'Ubuntu', sans-serif;
  color: rgb( 53, 54, 55 );
  text-transform: uppercase;
  font-weight: bold;
  text-align: left;
  line-height: 48px;
  display:block;
  margin-top:100px;
  text-align:center;
  
  ">Спасибо, Ваша заявка принята в обработку.<br />Мы свяжемся с Вами в ближайшее время.</span>
	</div>
</div>

<?php
}
?>



<?php
 if (JURI::current() == JURI::base()."order") {
?>

<div class="big_block">
<form  id="Form" action="/action/send.php" enctype="multipart/form-data" method="post" accept-charset="utf-8">
<div class="block_form">

<div class="div1">
	<h1 class="head">Новая форма запроса</h1>
	<span class="text1">Чем больше вы дадите информации, тем более точнее мы подберём для вас нужную деталь</span>
</div>


<div class="form1">
	<span class="head" onclick="block1_show()">Описание техники <span class="red"><img src="/templates/rsmetro/images/upArr.gif" alt="" title=""/></span></span>
    
    <div id="block1_show">
    <div class="block1">
    	<div class="block11">
        	<input type="text" class="input1" name="input11" id="input11" placeholder="Наименование" onBlur="ver1();"/>
    		<span class="text1">Какая у вас техника?</span>
    	
        </div>
        <div class="block12">
        	<input type="text" class="input2" name="input12" id="input12" placeholder="Производитель" onBlur="ver2();"/>
    		<span class="text2">Например: XCMG</span>
    	
        </div>
        <div class="block13">
        	<input type="text" class="input3" name="input13" id="input13" placeholder="Год выпуска" onBlur="ver3();"/>
    		<span class="text3">По ПСМ или ПТС</span>
        </div>
        
        
        
		
    </div>
    
    
    <style type="text/css">
    .block2 .right .mask-wrapper{
	display:none;
	}
	
	.block2 .right .mask-wrapper#mask-wrapper1{
	display:block;
	}
    
    
    </style>
    
    
    <div class="block2">
    	<div class="left">Прикрепить фото:</div>
        <div class="right" id="right">
        	<!--<input type="file" name="file1" id="file1" class="file"/>-->
           <!-- <input type="button" value="Выбрать" class="button"/>-->
            
            <div id="right2">
            
            
            
            <div class="mask-wrapper" id="mask-wrapper1">
   				<div class="mask" id="mask1">
      				<input class="fileInputText" id="fileInputText1" type="text" disabled>
      				<button class="send-file" id="send-file1">Выбрать</button>
   				</div>
   				<input class="custom-file-input custom-file-input1" type="file" id="my_file1" name="file_foto[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper2">
   				<div class="mask" id="mask2">
      				<input class="fileInputText" id="fileInputText2" type="text" disabled>
      				<button class="send-file" id="send-file2">Выбрать</button>
   				</div>
   				<input class="custom-file-input custom-file-input2" type="file" id="my_file2" name="file_foto[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper3">
   				<div class="mask" id="mask3">
      				<input class="fileInputText" id="fileInputText3" type="text" disabled>
      				<button class="send-file" id="send-file3">Выбрать</button>
   				</div>
   				<input class="custom-file-input custom-file-input3" type="file" id="my_file3" name="file_foto[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper4">
   				<div class="mask" id="mask4">
      				<input class="fileInputText" id="fileInputText4" type="text" disabled>
      				<button class="send-file" id="send-file4">Выбрать</button>
   				</div>
   				<input class="custom-file-input custom-file-input4" type="file" id="my_file4" name="file_foto[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper5">
   				<div class="mask" id="mask5">
      				<input class="fileInputText" id="fileInputText5" type="text" disabled>
      				<button class="send-file" id="send-file5">Выбрать</button>
   				</div>
   				<input class="custom-file-input custom-file-input5" type="file" id="my_file5" name="file_foto[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper6">
   				<div class="mask" id="mask6">
      				<input class="fileInputText" id="fileInputText6" type="text" disabled>
      				<button class="send-file" id="send-file6">Выбрать</button>
   				</div>
   				<input class="custom-file-input custom-file-input6" type="file" id="my_file6" name="file_foto[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper7">
   				<div class="mask" id="mask7">
      				<input class="fileInputText" id="fileInputText7" type="text" disabled>
      				<button class="send-file" id="send-file7">Выбрать</button>
   				</div>
   				<input class="custom-file-input custom-file-input7" type="file" id="my_file7" name="file_foto[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper8">
   				<div class="mask" id="mask8">
      				<input class="fileInputText" id="fileInputText8" type="text" disabled>
      				<button class="send-file" id="send-file8">Выбрать</button>
   				</div>
   				<input class="custom-file-input custom-file-input8" type="file" id="my_file8" name="file_foto[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper9">
   				<div class="mask" id="mask9">
      				<input class="fileInputText" id="fileInputText9" type="text" disabled>
      				<button class="send-file" id="send-file9">Выбрать</button>
   				</div>
   				<input class="custom-file-input custom-file-input9" type="file" id="my_file9" name="file_foto[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper10">
   				<div class="mask" id="mask10">
      				<input class="fileInputText" id="fileInputText10" type="text" disabled>
      				<button class="send-file" id="send-file10">Выбрать</button>
   				</div>
   				<input class="custom-file-input custom-file-input10" type="file" id="my_file10" name="file_foto[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper11">
   				<div class="mask" id="mask11">
      				<input class="fileInputText" id="fileInputText11" type="text" disabled>
      				<button class="send-file" id="send-file11">Выбрать</button>
   				</div>
   				<input class="custom-file-input custom-file-input11" type="file" id="my_file11" name="file_foto[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper12">
   				<div class="mask" id="mask12">
      				<input class="fileInputText" id="fileInputText12" type="text" disabled>
      				<button class="send-file" id="send-file12">Выбрать</button>
   				</div>
   				<input class="custom-file-input custom-file-input12" type="file" id="my_file12" name="file_foto[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper13">
   				<div class="mask" id="mask13">
      				<input class="fileInputText" id="fileInputText13" type="text" disabled>
      				<button class="send-file" id="send-file13">Выбрать</button>
   				</div>
   				<input class="custom-file-input custom-file-input13" type="file" id="my_file13" name="file_foto[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper14">
   				<div class="mask" id="mask14">
      				<input class="fileInputText" id="fileInputText14" type="text" disabled>
      				<button class="send-file" id="send-file14">Выбрать</button>
   				</div>
   				<input class="custom-file-input custom-file-input14" type="file" id="my_file14" name="file_foto[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper15">
   				<div class="mask" id="mask15">
      				<input class="fileInputText" id="fileInputText15" type="text" disabled>
      				<button class="send-file" id="send-file15">Выбрать</button>
   				</div>
   				<input class="custom-file-input custom-file-input15" type="file" id="my_file15" name="file_foto[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper16">
   				<div class="mask" id="mask16">
      				<input class="fileInputText" id="fileInputText16" type="text" disabled>
      				<button class="send-file" id="send-file16">Выбрать</button>
   				</div>
   				<input class="custom-file-input custom-file-input16" type="file" id="my_file16" name="file_foto[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper17">
   				<div class="mask" id="mask17">
      				<input class="fileInputText" id="fileInputText17" type="text" disabled>
      				<button class="send-file" id="send-file17">Выбрать</button>
   				</div>
   				<input class="custom-file-input custom-file-input17" type="file" id="my_file17" name="file_foto[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper18">
   				<div class="mask" id="mask18">
      				<input class="fileInputText" id="fileInputText18" type="text" disabled>
      				<button class="send-file" id="send-file18">Выбрать</button>
   				</div>
   				<input class="custom-file-input custom-file-input18" type="file" id="my_file18" name="file_foto[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper19">
   				<div class="mask" id="mask19">
      				<input class="fileInputText" id="fileInputText19" type="text" disabled>
      				<button class="send-file" id="send-file19">Выбрать</button>
   				</div>
   				<input class="custom-file-input custom-file-input19" type="file" id="my_file19" name="file_foto[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper20">
   				<div class="mask" id="mask20">
      				<input class="fileInputText" id="fileInputText20" type="text" disabled>
      				<button class="send-file" id="send-file20">Выбрать</button>
   				</div>
   				<input class="custom-file-input custom-file-input20" type="file" id="my_file20" name="file_foto[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper21">
   				<div class="mask" id="mask21">
      				<input class="fileInputText" id="fileInputText21" type="text" disabled>
      				<button class="send-file" id="send-file21">Выбрать</button>
   				</div>
   				<input class="custom-file-input custom-file-input21" type="file" id="my_file21" name="file_foto[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper22">
   				<div class="mask" id="mask22">
      				<input class="fileInputText" id="fileInputText22" type="text" disabled>
      				<button class="send-file" id="send-file22">Выбрать</button>
   				</div>
   				<input class="custom-file-input custom-file-input22" type="file" id="my_file22" name="file_foto[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper23">
   				<div class="mask" id="mask23">
      				<input class="fileInputText" id="fileInputText23" type="text" disabled>
      				<button class="send-file" id="send-file23">Выбрать</button>
   				</div>
   				<input class="custom-file-input custom-file-input23" type="file" id="my_file23" name="file_foto[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper24">
   				<div class="mask" id="mask24">
      				<input class="fileInputText" id="fileInputText24" type="text" disabled>
      				<button class="send-file" id="send-file24">Выбрать</button>
   				</div>
   				<input class="custom-file-input custom-file-input24" type="file" id="my_file24" name="file_foto[]">
			</div>
            
            
            
			
            </div>
            
            
            <style type="text/css">
            .mask-wrapper {
   				height: 50px;
   				margin-bottom:20px;
				
			}
			.mask-wrapper .send-file {
   				padding: 3px 20px;
   				margin-left: 3px;
   				color: #fff;
   				background-color: #ccc;
			}
			.mask-wrapper .fileInputText {
   				position: relative;
   				width: 133px;
   				top: 3px;
			}
			.custom-file-input {
   				width: 100% !important;
  height: 50px;
   				opacity: 0;
   				filter: alpha(opacity=0);
   				position: relative;
   				top: -52px;
   				left: -16px;
   				z-index: 99999;
   				cursor: pointer;
			}
            </style>
            <input type="button" value="Добавить ещё" class="INeedMore" id="INeedMore"/>
            <span class="note1">Фото шильдика техники (фотографии должны быть чёткими, маркировки должны быть разборчивыми) </span>
        
        
        </div>
        
        
        
    
    </div>
    
    <div class="block3">
    	<span class="note2" onClick="f_show()">Добавить информацию:</span>
	</div>
    
    
    <div id="f" name="f" class="f">
   		<textarea name="textareaf" placeholder="Дополнительная информация"></textarea>
    
	</div>
    
    
    
    </div>
    
    

</div>









<div class="form2">
	<span class="head" onClick="block2_show();">Двигатель <span class="red"><img src="/templates/rsmetro/images/upArr.gif" alt="" title=""/></span></span>
    <div id="block2_show">
    <div class="block1">
    	<div class="block11">
        	<input type="text" class="input1" name="input21" id="input21" placeholder="Производитель" onBlur="ver4();"/>
    		<span class="text1">Например: Yuchai</span>
    	
        </div>
        <div class="block12">
        	<input type="text" class="input2" name="input22" id="input22" placeholder="Модель" onBlur="ver5();"/>
    		<span class="text2">Например: YCD4R11G</span>
    	
        </div>
		
    </div>
    
    
    <div class="block2">
    	<div class="left">Прикрепить фото:</div>
        <div class="right" id="right">
        	<!--<input type="file" name="file1" id="file1" class="file"/>-->
           <!-- <input type="button" value="Выбрать" class="button"/>-->
            
            
            <style type="text/css">
         	.block2 .right #right21 .mask-wrapper#mask-wrapper11dvig{
            display:block;
            }
            </style>
            
            <div id="right21">
            
            
            
            <div class="mask-wrapper" id="mask-wrapper11dvig">
   				<div class="mask" id="mask11dvig">
      				<input class="fileInputText" id="fileInputText11dvig" type="text" disabled>
      				<button class="send-file" id="send-file11dvig">Выбрать</button>
   				</div>
   				<input id="file_dvig" class="custom-file-input custom-file-input11dvig" type="file" name="file_dvig[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper12dvig">
   				<div class="mask" id="mask12dvig">
      				<input class="fileInputText" id="fileInputText12dvig" type="text" disabled>
      				<button class="send-file" id="send-file12dvig">Выбрать</button>
   				</div>
   				<input id="file_dvig" class="custom-file-input custom-file-input12dvig" type="file" name="file_dvig[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper13dvig">
   				<div class="mask" id="mask13dvig">
      				<input class="fileInputText" id="fileInputText13dvig" type="text" disabled>
      				<button class="send-file" id="send-file13dvig">Выбрать</button>
   				</div>
   				<input id="file_dvig" class="custom-file-input custom-file-input13dvig" type="file" name="file_dvig[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper14dvig">
   				<div class="mask" id="mask14dvig">
      				<input class="fileInputText" id="fileInputText14dvig" type="text" disabled>
      				<button class="send-file" id="send-file14dvig">Выбрать</button>
   				</div>
   				<input id="file_dvig" class="custom-file-input custom-file-input14dvig" type="file" name="file_dvig[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper15dvig">
   				<div class="mask" id="mask15dvig">
      				<input class="fileInputText" id="fileInputText15dvig" type="text" disabled>
      				<button class="send-file" id="send-file15dvig">Выбрать</button>
   				</div>
   				<input id="file_dvig" class="custom-file-input custom-file-input15dvig" type="file" name="file_dvig[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper16dvig">
   				<div class="mask" id="mask16dvig">
      				<input class="fileInputText" id="fileInputText16dvig" type="text" disabled>
      				<button class="send-file" id="send-file16dvig">Выбрать</button>
   				</div>
   				<input id="file_dvig" class="custom-file-input custom-file-input16dvig" type="file" name="file_dvig[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper17dvig">
   				<div class="mask" id="mask17dvig">
      				<input class="fileInputText" id="fileInputText17dvig" type="text" disabled>
      				<button class="send-file" id="send-file17dvig">Выбрать</button>
   				</div>
   				<input id="file_dvig" class="custom-file-input custom-file-input17dvig" type="file" name="file_dvig[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper18dvig">
   				<div class="mask" id="mask18dvig">
      				<input class="fileInputText" id="fileInputText18dvig" type="text" disabled>
      				<button class="send-file" id="send-file18dvig">Выбрать</button>
   				</div>
   				<input id="file_dvig" class="custom-file-input custom-file-input18dvig" type="file" name="file_dvig[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper19dvig">
   				<div class="mask" id="mask19dvig">
      				<input class="fileInputText" id="fileInputText19dvig" type="text" disabled>
      				<button class="send-file" id="send-file19dvig">Выбрать</button>
   				</div>
   				<input id="file_dvig" class="custom-file-input custom-file-input19dvig" type="file" name="file_dvig[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper110dvig">
   				<div class="mask" id="mask110dvig">
      				<input class="fileInputText" id="fileInputText110dvig" type="text" disabled>
      				<button class="send-file" id="send-file110dvig">Выбрать</button>
   				</div>
   				<input id="file_dvig" class="custom-file-input custom-file-input110dvig" type="file" name="file_dvig[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper111dvig">
   				<div class="mask" id="mask111dvig">
      				<input class="fileInputText" id="fileInputText111dvig" type="text" disabled>
      				<button class="send-file" id="send-file111dvig">Выбрать</button>
   				</div>
   				<input id="file_dvig" class="custom-file-input custom-file-input111dvig" type="file" name="file_dvig[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper112dvig">
   				<div class="mask" id="mask112dvig">
      				<input class="fileInputText" id="fileInputText112dvig" type="text" disabled>
      				<button class="send-file" id="send-file112dvig">Выбрать</button>
   				</div>
   				<input id="file_dvig" class="custom-file-input custom-file-input112dvig" type="file" name="file_dvig[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper113dvig">
   				<div class="mask" id="mask113dvig">
      				<input class="fileInputText" id="fileInputText113dvig" type="text" disabled>
      				<button class="send-file" id="send-file113dvig">Выбрать</button>
   				</div>
   				<input id="file_dvig" class="custom-file-input custom-file-input113dvig" type="file" name="file_dvig[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper114dvig">
   				<div class="mask" id="mask114dvig">
      				<input class="fileInputText" id="fileInputText114dvig" type="text" disabled>
      				<button class="send-file" id="send-file114dvig">Выбрать</button>
   				</div>
   				<input id="file_dvig" class="custom-file-input custom-file-input114dvig" type="file" name="file_dvig[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper115dvig">
   				<div class="mask" id="mask115dvig">
      				<input class="fileInputText" id="fileInputText115dvig" type="text" disabled>
      				<button class="send-file" id="send-file115dvig">Выбрать</button>
   				</div>
   				<input id="file_dvig" class="custom-file-input custom-file-input115dvig" type="file" name="file_dvig[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper116dvig">
   				<div class="mask" id="mask116dvig">
      				<input class="fileInputText" id="fileInputText116dvig" type="text" disabled>
      				<button class="send-file" id="send-file116dvig">Выбрать</button>
   				</div>
   				<input id="file_dvig" class="custom-file-input custom-file-input116dvig" type="file" name="file_dvig[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper117dvig">
   				<div class="mask" id="mask117dvig">
      				<input class="fileInputText" id="fileInputText117dvig" type="text" disabled>
      				<button class="send-file" id="send-file117dvig">Выбрать</button>
   				</div>
   				<input id="file_dvig" class="custom-file-input custom-file-input117dvig" type="file" name="file_dvig[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper118dvig">
   				<div class="mask" id="mask118dvig">
      				<input class="fileInputText" id="fileInputText118dvig" type="text" disabled>
      				<button class="send-file" id="send-file118dvig">Выбрать</button>
   				</div>
   				<input id="file_dvig" class="custom-file-input custom-file-input118dvig" type="file" name="file_dvig[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper119dvig">
   				<div class="mask" id="mask119dvig">
      				<input class="fileInputText" id="fileInputText119dvig" type="text" disabled>
      				<button class="send-file" id="send-file119dvig">Выбрать</button>
   				</div>
   				<input id="file_dvig" class="custom-file-input custom-file-input119dvig" type="file" name="file_dvig[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper120dvig">
   				<div class="mask" id="mask120dvig">
      				<input class="fileInputText" id="fileInputText120dvig" type="text" disabled>
      				<button class="send-file" id="send-file120dvig">Выбрать</button>
   				</div>
   				<input id="file_dvig" class="custom-file-input custom-file-input120dvig" type="file" name="file_dvig[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper121dvig">
   				<div class="mask" id="mask121dvig">
      				<input class="fileInputText" id="fileInputText121dvig" type="text" disabled>
      				<button class="send-file" id="send-file121dvig">Выбрать</button>
   				</div>
   				<input id="file_dvig" class="custom-file-input custom-file-input121dvig" type="file" name="file_dvig[]">
			</div>
            
            
            
            <div class="mask-wrapper" id="mask-wrapper122dvig">
   				<div class="mask" id="mask122dvig">
      				<input class="fileInputText" id="fileInputText122dvig" type="text" disabled>
      				<button class="send-file" id="send-file122dvig">Выбрать</button>
   				</div>
   				<input id="file_dvig" class="custom-file-input custom-file-input122dvig" type="file" name="file_dvig[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper123dvig">
   				<div class="mask" id="mask123dvig">
      				<input class="fileInputText" id="fileInputText123dvig" type="text" disabled>
      				<button class="send-file" id="send-file123dvig">Выбрать</button>
   				</div>
   				<input id="file_dvig" class="custom-file-input custom-file-input123dvig" type="file" name="file_dvig[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper124dvig">
   				<div class="mask" id="mask124dvig">
      				<input class="fileInputText" id="fileInputText124dvig" type="text" disabled>
      				<button class="send-file" id="send-file124dvig">Выбрать</button>
   				</div>
   				<input id="file_dvig" class="custom-file-input custom-file-input124dvig" type="file" name="file_dvig[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper125dvig">
   				<div class="mask" id="mask125dvig">
      				<input class="fileInputText" id="fileInputText125dvig" type="text" disabled>
      				<button class="send-file" id="send-file125dvig">Выбрать</button>
   				</div>
   				<input id="file_dvig" class="custom-file-input custom-file-input125dvig" type="file" name="file_dvig[]">
			</div>
            
            
			
            </div>
            
            
            <style type="text/css">
            .mask-wrapper {
   				height: 50px;
   				margin-bottom:20px;
				
			}
			.mask-wrapper .send-file {
   				padding: 3px 20px;
   				margin-left: 3px;
   				color: #fff;
   				background-color: #ccc;
			}
			.mask-wrapper .fileInputText {
   				position: relative;
   				width: 133px;
   				top: 3px;
			}
			.custom-file-input {
   				width: 100% !important;
  height: 50px;
   				opacity: 0;
   				filter: alpha(opacity=0);
   				position: relative;
   				top: -52px;
   				left: -16px;
   				z-index: 99999;
   				cursor: pointer;
			}
            </style>
            <input type="button" value="Добавить ещё" class="INeedMore" id="INeedMore1"/>
            <span class="note1">Фото шильдика двигателя (фотографии должны быть чёткими, маркировки должны быть разборчивыми)</span>
        
        
        </div>
        
        
        
    
    </div>
    
    <div class="block3">
    	<span class="note2" onClick="f_show1()">Добавить информацию:</span>
	</div>
    
    
    <div id="f1" name="f1" class="f">
   		<textarea  name="textareaf1" placeholder="Дополнительная информация"></textarea>
    
	</div>
    
    
    </div>
    
    

</div>















<div class="form3">

	<!------------->
    
    
   
    <span class="head" onClick="block3_show();">Нужные детали <span class="red"><img src="/templates/rsmetro/images/upArr.gif" alt="" title=""/>
    </span></span>
    <div id="block3_show">
	<div id="detail_new">
     <!----=======================================================================----->
     <div class="dop1">
    
    
    <!---->
    <div class="block1">
    	<div class="block11">
        	<input type="text" class="input1" name="input31dop1" id="input31" placeholder="Название детали" onBlur="ver6();"/>
    		<span class="text1">Например: Стартер</span>
    	
        </div>
        <div class="block12">
        	<input type="text" class="input2" name="input32dop1" id="input32" placeholder="Описание детали" onBlur="ver7();"/>
    		<span class="text2">Краткое описание детали</span>
    	
        </div>
		
    </div>
    
    
    <div class="block2">
    	<div class="left">Прикрепить фото:</div>
        <div class="right" id="right">
        	<!--<input type="file" name="file1" id="file1" class="file"/>-->
           <!-- <input type="button" value="Выбрать" class="button"/>-->
            
            <style type="text/css">
            #right22 #mask-wrapper1detail{
			display:block;
			}            
            </style>
            
            
            <div id="right22">
            
            
            
            <div class="mask-wrapper" id="mask-wrapper1detail">
   				<div class="mask" id="mask1detail">
      				<input class="fileInputText" id="fileInputText1detail" type="text" disabled>
      				<button class="send-file" id="send-file1detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input1detail" type="file" name="file_detaldop1[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper2detail">
   				<div class="mask" id="mask2detail">
      				<input class="fileInputText" id="fileInputText2detail" type="text" disabled>
      				<button class="send-file" id="send-file2detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input2detail" type="file" name="file_detaldop1[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper3detail">
   				<div class="mask" id="mask3detail">
      				<input class="fileInputText" id="fileInputText3detail" type="text" disabled>
      				<button class="send-file" id="send-file3detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input3detail" type="file" name="file_detaldop1[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper4detail">
   				<div class="mask" id="mask4detail">
      				<input class="fileInputText" id="fileInputText4detail" type="text" disabled>
      				<button class="send-file" id="send-file4detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input4detail" type="file" name="file_detaldop1[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper5detail">
   				<div class="mask" id="mask5detail">
      				<input class="fileInputText" id="fileInputText5detail" type="text" disabled>
      				<button class="send-file" id="send-file5detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input5detail" type="file" name="file_detaldop1[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper6detail">
   				<div class="mask" id="mask6detail">
      				<input class="fileInputText" id="fileInputText6detail" type="text" disabled>
      				<button class="send-file" id="send-file6detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input6detail" type="file" name="file_detaldop1[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper7detail">
   				<div class="mask" id="mask7detail">
      				<input class="fileInputText" id="fileInputText7detail" type="text" disabled>
      				<button class="send-file" id="send-file7detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input7detail" type="file" name="file_detaldop1[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper8detail">
   				<div class="mask" id="mask8detail">
      				<input class="fileInputText" id="fileInputText8detail" type="text" disabled>
      				<button class="send-file" id="send-file8detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input8detail" type="file" name="file_detaldop1[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper9detail">
   				<div class="mask" id="mask9detail">
      				<input class="fileInputText" id="fileInputText9detail" type="text" disabled>
      				<button class="send-file" id="send-file9detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input9detail" type="file" name="file_detaldop1[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper10detail">
   				<div class="mask" id="mask10detail">
      				<input class="fileInputText" id="fileInputText10detail" type="text" disabled>
      				<button class="send-file" id="send-file10detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input10detail" type="file" name="file_detaldop1[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper11detail">
   				<div class="mask" id="mask11detail">
      				<input class="fileInputText" id="fileInputText11detail" type="text" disabled>
      				<button class="send-file" id="send-file11detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input11detail" type="file" name="file_detaldop1[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper12detail">
   				<div class="mask" id="mask12detail">
      				<input class="fileInputText" id="fileInputText12detail" type="text" disabled>
      				<button class="send-file" id="send-file12detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input12detail" type="file" name="file_detaldop1[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper13detail">
   				<div class="mask" id="mask13detail">
      				<input class="fileInputText" id="fileInputText13detail" type="text" disabled>
      				<button class="send-file" id="send-file13detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input13detail" type="file" name="file_detaldop1[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper14detail">
   				<div class="mask" id="mask14detail">
      				<input class="fileInputText" id="fileInputText14detail" type="text" disabled>
      				<button class="send-file" id="send-file14detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input14detail" type="file" name="file_detaldop1[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper15detail">
   				<div class="mask" id="mask15detail">
      				<input class="fileInputText" id="fileInputText15detail" type="text" disabled>
      				<button class="send-file" id="send-file15detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input15detail" type="file" name="file_detaldop1[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper16detail">
   				<div class="mask" id="mask16detail">
      				<input class="fileInputText" id="fileInputText16detail" type="text" disabled>
      				<button class="send-file" id="send-file16detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input16detail" type="file" name="file_detaldop1[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper17detail">
   				<div class="mask" id="mask17detail">
      				<input class="fileInputText" id="fileInputText17detail" type="text" disabled>
      				<button class="send-file" id="send-file17detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input17detail" type="file" name="file_detaldop1[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper18detail">
   				<div class="mask" id="mask18detail">
      				<input class="fileInputText" id="fileInputText18detail" type="text" disabled>
      				<button class="send-file" id="send-file18detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input18detail" type="file" name="file_detaldop1[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper19detail">
   				<div class="mask" id="mask19detail">
      				<input class="fileInputText" id="fileInputText19detail" type="text" disabled>
      				<button class="send-file" id="send-file19detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input19detail" type="file" name="file_detaldop1[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper20detail">
   				<div class="mask" id="mask20detail">
      				<input class="fileInputText" id="fileInputText20detail" type="text" disabled>
      				<button class="send-file" id="send-file20detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input20detail" type="file" name="file_detaldop1[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper21detail">
   				<div class="mask" id="mask21detail">
      				<input class="fileInputText" id="fileInputText21detail" type="text" disabled>
      				<button class="send-file" id="send-file21detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input21detail" type="file" name="file_detaldop1[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper22detail">
   				<div class="mask" id="mask22detail">
      				<input class="fileInputText" id="fileInputText22detail" type="text" disabled>
      				<button class="send-file" id="send-file22detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input22detail" type="file" name="file_detaldop1[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper23detail">
   				<div class="mask" id="mask23detail">
      				<input class="fileInputText" id="fileInputText23detail" type="text" disabled>
      				<button class="send-file" id="send-file23detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input23detail" type="file" name="file_detaldop1[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper24detail">
   				<div class="mask" id="mask24detail">
      				<input class="fileInputText" id="fileInputText24detail" type="text" disabled>
      				<button class="send-file" id="send-file24detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input24detail" type="file" name="file_detaldop1[]">
			</div>
            
            
			
            </div>
            
            
            <style type="text/css">
            .mask-wrapper {
   				height: 50px;
   				margin-bottom:20px;
				
			}
			.mask-wrapper .send-file {
   				padding: 3px 20px;
   				margin-left: 3px;
   				color: #fff;
   				background-color: #ccc;
			}
			.mask-wrapper .fileInputText {
   				position: relative;
   				width: 133px;
   				top: 3px;
			}
			.custom-file-input {
   				width: 100% !important;
  height: 50px;
   				opacity: 0;
   				filter: alpha(opacity=0);
   				position: relative;
   				top: -52px;
   				left: -16px;
   				z-index: 99999;
   				cursor: pointer;
			}
            </style>
            <input type="button" value="Добавить ещё" class="INeedMore" id="INeedMore2"/>
            <span class="note1">Фото шильдика детали (фотографии должны быть чёткими, маркировки должны быть разборчивыми) </span>
        
        
        </div>
        
        
        
    
    </div>
    
    <div class="block3">
    	<span class="note2" onClick="f_show2dop1()">Добавить информацию:</span>
	</div>
    
    
    <div id="f2dop1" name="f2" class="f">
   		<textarea name="textareaf2dop1" placeholder="Дополнительная информация"></textarea>
    
	</div>
    
    <div style="margin-bottom:15px; width:100%; height:3px;" class="dotted_line"></div>
    
    
    </div>
    <!----=======================================================================----->
    <div class="dop2">
    <div class="block1">
    	<div class="block11">
        	<input type="text" class="input1" name="input31dop2" id="input31" placeholder="Название детали"/>
    		<span class="text1">Например: Стартер</span>
    	
        </div>
        <div class="block12">
        	<input type="text" class="input2" name="input32dop2" id="input32" placeholder="Описание детали"/>
    		<span class="text2">Краткое описание детали</span>
    	
        </div>
		
    </div>
    
    
    <div class="block2">
    	<div class="left">Прикрепить фото:</div>
        <div class="right" id="right">
        	<!--<input type="file" name="file1" id="file1" class="file"/>-->
           <!-- <input type="button" value="Выбрать" class="button"/>-->
            
            <style type="text/css">
            #right22 #mask-wrapper1detail{
			display:block;
			}            
            </style>
            
            
            <div id="right22">
            
            
            
            <div class="mask-wrapper" id="mask-wrapper1detail">
   				<div class="mask" id="mask1detail">
      				<input class="fileInputText" id="fileInputText1detail" type="text" disabled>
      				<button class="send-file" id="send-file1detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input1detail" type="file" name="file_detaldop2[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper2detail">
   				<div class="mask" id="mask2detail">
      				<input class="fileInputText" id="fileInputText2detail" type="text" disabled>
      				<button class="send-file" id="send-file2detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input2detail" type="file" name="file_detaldop2[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper3detail">
   				<div class="mask" id="mask3detail">
      				<input class="fileInputText" id="fileInputText3detail" type="text" disabled>
      				<button class="send-file" id="send-file3detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input3detail" type="file" name="file_detaldop2[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper4detail">
   				<div class="mask" id="mask4detail">
      				<input class="fileInputText" id="fileInputText4detail" type="text" disabled>
      				<button class="send-file" id="send-file4detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input4detail" type="file" name="file_detaldop2[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper5detail">
   				<div class="mask" id="mask5detail">
      				<input class="fileInputText" id="fileInputText5detail" type="text" disabled>
      				<button class="send-file" id="send-file5detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input5detail" type="file" name="file_detaldop2[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper6detail">
   				<div class="mask" id="mask6detail">
      				<input class="fileInputText" id="fileInputText6detail" type="text" disabled>
      				<button class="send-file" id="send-file6detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input6detail" type="file" name="file_detaldop2[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper7detail">
   				<div class="mask" id="mask7detail">
      				<input class="fileInputText" id="fileInputText7detail" type="text" disabled>
      				<button class="send-file" id="send-file7detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input7detail" type="file" name="file_detaldop2[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper8detail">
   				<div class="mask" id="mask8detail">
      				<input class="fileInputText" id="fileInputText8detail" type="text" disabled>
      				<button class="send-file" id="send-file8detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input8detail" type="file" name="file_detaldop2[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper9detail">
   				<div class="mask" id="mask9detail">
      				<input class="fileInputText" id="fileInputText9detail" type="text" disabled>
      				<button class="send-file" id="send-file9detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input9detail" type="file" name="file_detaldop2[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper10detail">
   				<div class="mask" id="mask10detail">
      				<input class="fileInputText" id="fileInputText10detail" type="text" disabled>
      				<button class="send-file" id="send-file10detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input10detail" type="file" name="file_detaldop2[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper11detail">
   				<div class="mask" id="mask11detail">
      				<input class="fileInputText" id="fileInputText11detail" type="text" disabled>
      				<button class="send-file" id="send-file11detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input11detail" type="file" name="file_detaldop2[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper12detail">
   				<div class="mask" id="mask12detail">
      				<input class="fileInputText" id="fileInputText12detail" type="text" disabled>
      				<button class="send-file" id="send-file12detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input12detail" type="file" name="file_detaldop2[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper13detail">
   				<div class="mask" id="mask13detail">
      				<input class="fileInputText" id="fileInputText13detail" type="text" disabled>
      				<button class="send-file" id="send-file13detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input13detail" type="file" name="file_detaldop2[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper14detail">
   				<div class="mask" id="mask14detail">
      				<input class="fileInputText" id="fileInputText14detail" type="text" disabled>
      				<button class="send-file" id="send-file14detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input14detail" type="file" name="file_detaldop2[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper15detail">
   				<div class="mask" id="mask15detail">
      				<input class="fileInputText" id="fileInputText15detail" type="text" disabled>
      				<button class="send-file" id="send-file15detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input15detail" type="file" name="file_detaldop2[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper16detail">
   				<div class="mask" id="mask16detail">
      				<input class="fileInputText" id="fileInputText16detail" type="text" disabled>
      				<button class="send-file" id="send-file16detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input16detail" type="file" name="file_detaldop2[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper17detail">
   				<div class="mask" id="mask17detail">
      				<input class="fileInputText" id="fileInputText17detail" type="text" disabled>
      				<button class="send-file" id="send-file17detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input17detail" type="file" name="file_detaldop2[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper18detail">
   				<div class="mask" id="mask18detail">
      				<input class="fileInputText" id="fileInputText18detail" type="text" disabled>
      				<button class="send-file" id="send-file18detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input18detail" type="file" name="file_detaldop2[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper19detail">
   				<div class="mask" id="mask19detail">
      				<input class="fileInputText" id="fileInputText19detail" type="text" disabled>
      				<button class="send-file" id="send-file19detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input19detail" type="file" name="file_detaldop2[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper20detail">
   				<div class="mask" id="mask20detail">
      				<input class="fileInputText" id="fileInputText20detail" type="text" disabled>
      				<button class="send-file" id="send-file20detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input20detail" type="file" name="file_detaldop2[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper21detail">
   				<div class="mask" id="mask21detail">
      				<input class="fileInputText" id="fileInputText21detail" type="text" disabled>
      				<button class="send-file" id="send-file21detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input21detail" type="file" name="file_detaldop2[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper22detail">
   				<div class="mask" id="mask22detail">
      				<input class="fileInputText" id="fileInputText22detail" type="text" disabled>
      				<button class="send-file" id="send-file22detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input22detail" type="file" name="file_detaldop2[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper23detail">
   				<div class="mask" id="mask23detail">
      				<input class="fileInputText" id="fileInputText23detail" type="text" disabled>
      				<button class="send-file" id="send-file23detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input23detail" type="file" name="file_detaldop2[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper24detail">
   				<div class="mask" id="mask24detail">
      				<input class="fileInputText" id="fileInputText24detail" type="text" disabled>
      				<button class="send-file" id="send-file24detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input24detail" type="file" name="file_detaldop2[]">
			</div>
            
            
			
            </div>
            
            
            <style type="text/css">
            .mask-wrapper {
   				height: 50px;
   				margin-bottom:20px;
				
			}
			.mask-wrapper .send-file {
   				padding: 3px 20px;
   				margin-left: 3px;
   				color: #fff;
   				background-color: #ccc;
			}
			.mask-wrapper .fileInputText {
   				position: relative;
   				width: 133px;
   				top: 3px;
			}
			.custom-file-input {
   				width: 100% !important;
  height: 50px;
   				opacity: 0;
   				filter: alpha(opacity=0);
   				position: relative;
   				top: -52px;
   				left: -16px;
   				z-index: 99999;
   				cursor: pointer;
			}
            </style>
            <input type="button" value="Добавить ещё" class="INeedMore" id="INeedMore2"/>
            <span class="note1">Фото шильдика детали (фотографии должны быть чёткими, маркировки должны быть разборчивыми) </span>
        
        
        </div>
        
        
        
    
    </div>
    
    <div class="block3">
    	<span class="note2" onClick="f_show2dop2()">Добавить информацию:</span>
	</div>
    
    
    <div id="f2dop2" name="f2" class="f">
   		<textarea name="textareaf2dop2" placeholder="Дополнительная информация"></textarea>
    
	</div>
    
    <div style="margin-bottom:15px; width:100%; height:3px;" class="dotted_line"></div>
    
    
    </div>
    <!----=======================================================================----->
    <div class="dop3">
    <div class="block1">
    	<div class="block11">
        	<input type="text" class="input1" name="input31dop3" id="input31" placeholder="Название детали"/>
    		<span class="text1">Например: Стартер</span>
    	
        </div>
        <div class="block12">
        	<input type="text" class="input2" name="input32dop3" id="input32" placeholder="Описание детали"/>
    		<span class="text2">Краткое описание детали</span>
    	
        </div>
		
    </div>
    
    
    <div class="block2">
    	<div class="left">Прикрепить фото:</div>
        <div class="right" id="right">
        	<!--<input type="file" name="file1" id="file1" class="file"/>-->
           <!-- <input type="button" value="Выбрать" class="button"/>-->
            
            <style type="text/css">
            #right22 #mask-wrapper1detail{
			display:block;
			}            
            </style>
            
            
            <div id="right22">
            
            
            
            <div class="mask-wrapper" id="mask-wrapper1detail">
   				<div class="mask" id="mask1detail">
      				<input class="fileInputText" id="fileInputText1detail" type="text" disabled>
      				<button class="send-file" id="send-file1detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input1detail" type="file" name="file_detaldop3[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper2detail">
   				<div class="mask" id="mask2detail">
      				<input class="fileInputText" id="fileInputText2detail" type="text" disabled>
      				<button class="send-file" id="send-file2detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input2detail" type="file" name="file_detaldop3[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper3detail">
   				<div class="mask" id="mask3detail">
      				<input class="fileInputText" id="fileInputText3detail" type="text" disabled>
      				<button class="send-file" id="send-file3detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input3detail" type="file" name="file_detaldop3[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper4detail">
   				<div class="mask" id="mask4detail">
      				<input class="fileInputText" id="fileInputText4detail" type="text" disabled>
      				<button class="send-file" id="send-file4detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input4detail" type="file" name="file_detaldop3[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper5detail">
   				<div class="mask" id="mask5detail">
      				<input class="fileInputText" id="fileInputText5detail" type="text" disabled>
      				<button class="send-file" id="send-file5detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input5detail" type="file" name="file_detaldop3[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper6detail">
   				<div class="mask" id="mask6detail">
      				<input class="fileInputText" id="fileInputText6detail" type="text" disabled>
      				<button class="send-file" id="send-file6detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input6detail" type="file" name="file_detaldop3[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper7detail">
   				<div class="mask" id="mask7detail">
      				<input class="fileInputText" id="fileInputText7detail" type="text" disabled>
      				<button class="send-file" id="send-file7detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input7detail" type="file" name="file_detaldop3[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper8detail">
   				<div class="mask" id="mask8detail">
      				<input class="fileInputText" id="fileInputText8detail" type="text" disabled>
      				<button class="send-file" id="send-file8detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input8detail" type="file" name="file_detaldop3[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper9detail">
   				<div class="mask" id="mask9detail">
      				<input class="fileInputText" id="fileInputText9detail" type="text" disabled>
      				<button class="send-file" id="send-file9detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input9detail" type="file" name="file_detaldop3[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper10detail">
   				<div class="mask" id="mask10detail">
      				<input class="fileInputText" id="fileInputText10detail" type="text" disabled>
      				<button class="send-file" id="send-file10detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input10detail" type="file" name="file_detaldop3[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper11detail">
   				<div class="mask" id="mask11detail">
      				<input class="fileInputText" id="fileInputText11detail" type="text" disabled>
      				<button class="send-file" id="send-file11detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input11detail" type="file" name="file_detaldop3[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper12detail">
   				<div class="mask" id="mask12detail">
      				<input class="fileInputText" id="fileInputText12detail" type="text" disabled>
      				<button class="send-file" id="send-file12detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input12detail" type="file" name="file_detaldop3[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper13detail">
   				<div class="mask" id="mask13detail">
      				<input class="fileInputText" id="fileInputText13detail" type="text" disabled>
      				<button class="send-file" id="send-file13detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input13detail" type="file" name="file_detaldop3[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper14detail">
   				<div class="mask" id="mask14detail">
      				<input class="fileInputText" id="fileInputText14detail" type="text" disabled>
      				<button class="send-file" id="send-file14detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input14detail" type="file" name="file_detaldop3[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper15detail">
   				<div class="mask" id="mask15detail">
      				<input class="fileInputText" id="fileInputText15detail" type="text" disabled>
      				<button class="send-file" id="send-file15detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input15detail" type="file" name="file_detaldop3[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper16detail">
   				<div class="mask" id="mask16detail">
      				<input class="fileInputText" id="fileInputText16detail" type="text" disabled>
      				<button class="send-file" id="send-file16detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input16detail" type="file" name="file_detaldop3[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper17detail">
   				<div class="mask" id="mask17detail">
      				<input class="fileInputText" id="fileInputText17detail" type="text" disabled>
      				<button class="send-file" id="send-file17detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input17detail" type="file" name="file_detaldop3[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper18detail">
   				<div class="mask" id="mask18detail">
      				<input class="fileInputText" id="fileInputText18detail" type="text" disabled>
      				<button class="send-file" id="send-file18detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input18detail" type="file" name="file_detaldop3[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper19detail">
   				<div class="mask" id="mask19detail">
      				<input class="fileInputText" id="fileInputText19detail" type="text" disabled>
      				<button class="send-file" id="send-file19detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input19detail" type="file" name="file_detaldop3[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper20detail">
   				<div class="mask" id="mask20detail">
      				<input class="fileInputText" id="fileInputText20detail" type="text" disabled>
      				<button class="send-file" id="send-file20detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input20detail" type="file" name="file_detaldop3[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper21detail">
   				<div class="mask" id="mask21detail">
      				<input class="fileInputText" id="fileInputText21detail" type="text" disabled>
      				<button class="send-file" id="send-file21detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input21detail" type="file" name="file_detaldop3[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper22detail">
   				<div class="mask" id="mask22detail">
      				<input class="fileInputText" id="fileInputText22detail" type="text" disabled>
      				<button class="send-file" id="send-file22detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input22detail" type="file" name="file_detaldop3[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper23detail">
   				<div class="mask" id="mask23detail">
      				<input class="fileInputText" id="fileInputText23detail" type="text" disabled>
      				<button class="send-file" id="send-file23detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input23detail" type="file" name="file_detaldop3[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper24detail">
   				<div class="mask" id="mask24detail">
      				<input class="fileInputText" id="fileInputText24detail" type="text" disabled>
      				<button class="send-file" id="send-file24detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input24detail" type="file" name="file_detaldop3[]">
			</div>
            
            
			
            </div>
            
            
            <style type="text/css">
            .mask-wrapper {
   				height: 50px;
   				margin-bottom:20px;
				
			}
			.mask-wrapper .send-file {
   				padding: 3px 20px;
   				margin-left: 3px;
   				color: #fff;
   				background-color: #ccc;
			}
			.mask-wrapper .fileInputText {
   				position: relative;
   				width: 133px;
   				top: 3px;
			}
			.custom-file-input {
   				width: 100% !important;
  height: 50px;
   				opacity: 0;
   				filter: alpha(opacity=0);
   				position: relative;
   				top: -52px;
   				left: -16px;
   				z-index: 99999;
   				cursor: pointer;
			}
            </style>
            <input type="button" value="Добавить ещё" class="INeedMore" id="INeedMore2"/>
            <span class="note1">Фото шильдика детали (фотографии должны быть чёткими, маркировки должны быть разборчивыми) </span>
        
        
        </div>
        
        
        
    
    </div>
    
    <div class="block3">
    	<span class="note2" onClick="f_show2dop3()">Добавить информацию</span>
	</div>
    
    
    <div id="f2dop3" name="f2" class="f">
   		<textarea name="textareaf2dop3" placeholder="Дополнительная информация"></textarea>
    
	</div>
    
    <div style="width:100%; height:3px;  margin-bottom:15px;" class="dotted_line"></div>
    
    
    </div>
    <!----=======================================================================----->
    <div class="dop4">
    <div class="block1">
    	<div class="block11">
        	<input type="text" class="input1" name="input31dop4" id="input31" placeholder="Название детали"/>
    		<span class="text1">Например: Стартер</span>
    	
        </div>
        <div class="block12">
        	<input type="text" class="input2" name="input32dop4" id="input32" placeholder="Описание детали"/>
    		<span class="text2">Краткое описание детали</span>
    	
        </div>
		
    </div>
    
    
    <div class="block2">
    	<div class="left">Прикрепить фото:</div>
        <div class="right" id="right">
        	<!--<input type="file" name="file1" id="file1" class="file"/>-->
           <!-- <input type="button" value="Выбрать" class="button"/>-->
            
            <style type="text/css">
            #right22 #mask-wrapper1detail{
			display:block;
			}            
            </style>
            
            
            <div id="right22">
            
            
            
            <div class="mask-wrapper" id="mask-wrapper1detail">
   				<div class="mask" id="mask1detail">
      				<input class="fileInputText" id="fileInputText1detail" type="text" disabled>
      				<button class="send-file" id="send-file1detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input1detail" type="file" name="file_detaldop4[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper2detail">
   				<div class="mask" id="mask2detail">
      				<input class="fileInputText" id="fileInputText2detail" type="text" disabled>
      				<button class="send-file" id="send-file2detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input2detail" type="file" name="file_detaldop4[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper3detail">
   				<div class="mask" id="mask3detail">
      				<input class="fileInputText" id="fileInputText3detail" type="text" disabled>
      				<button class="send-file" id="send-file3detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input3detail" type="file" name="file_detaldop4[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper4detail">
   				<div class="mask" id="mask4detail">
      				<input class="fileInputText" id="fileInputText4detail" type="text" disabled>
      				<button class="send-file" id="send-file4detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input4detail" type="file" name="file_detaldop4[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper5detail">
   				<div class="mask" id="mask5detail">
      				<input class="fileInputText" id="fileInputText5detail" type="text" disabled>
      				<button class="send-file" id="send-file5detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input5detail" type="file" name="file_detaldop4[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper6detail">
   				<div class="mask" id="mask6detail">
      				<input class="fileInputText" id="fileInputText6detail" type="text" disabled>
      				<button class="send-file" id="send-file6detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input6detail" type="file" name="file_detaldop4[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper7detail">
   				<div class="mask" id="mask7detail">
      				<input class="fileInputText" id="fileInputText7detail" type="text" disabled>
      				<button class="send-file" id="send-file7detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input7detail" type="file" name="file_detaldop4[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper8detail">
   				<div class="mask" id="mask8detail">
      				<input class="fileInputText" id="fileInputText8detail" type="text" disabled>
      				<button class="send-file" id="send-file8detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input8detail" type="file" name="file_detaldop4[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper9detail">
   				<div class="mask" id="mask9detail">
      				<input class="fileInputText" id="fileInputText9detail" type="text" disabled>
      				<button class="send-file" id="send-file9detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input9detail" type="file" name="file_detaldop4[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper10detail">
   				<div class="mask" id="mask10detail">
      				<input class="fileInputText" id="fileInputText10detail" type="text" disabled>
      				<button class="send-file" id="send-file10detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input10detail" type="file" name="file_detaldop4[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper11detail">
   				<div class="mask" id="mask11detail">
      				<input class="fileInputText" id="fileInputText11detail" type="text" disabled>
      				<button class="send-file" id="send-file11detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input11detail" type="file" name="file_detaldop4[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper12detail">
   				<div class="mask" id="mask12detail">
      				<input class="fileInputText" id="fileInputText12detail" type="text" disabled>
      				<button class="send-file" id="send-file12detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input12detail" type="file" name="file_detaldop4[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper13detail">
   				<div class="mask" id="mask13detail">
      				<input class="fileInputText" id="fileInputText13detail" type="text" disabled>
      				<button class="send-file" id="send-file13detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input13detail" type="file" name="file_detaldop4[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper14detail">
   				<div class="mask" id="mask14detail">
      				<input class="fileInputText" id="fileInputText14detail" type="text" disabled>
      				<button class="send-file" id="send-file14detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input14detail" type="file" name="file_detaldop4[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper15detail">
   				<div class="mask" id="mask15detail">
      				<input class="fileInputText" id="fileInputText15detail" type="text" disabled>
      				<button class="send-file" id="send-file15detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input15detail" type="file" name="file_detaldop4[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper16detail">
   				<div class="mask" id="mask16detail">
      				<input class="fileInputText" id="fileInputText16detail" type="text" disabled>
      				<button class="send-file" id="send-file16detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input16detail" type="file" name="file_detaldop4[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper17detail">
   				<div class="mask" id="mask17detail">
      				<input class="fileInputText" id="fileInputText17detail" type="text" disabled>
      				<button class="send-file" id="send-file17detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input17detail" type="file" name="file_detaldop4[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper18detail">
   				<div class="mask" id="mask18detail">
      				<input class="fileInputText" id="fileInputText18detail" type="text" disabled>
      				<button class="send-file" id="send-file18detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input18detail" type="file" name="file_detaldop4[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper19detail">
   				<div class="mask" id="mask19detail">
      				<input class="fileInputText" id="fileInputText19detail" type="text" disabled>
      				<button class="send-file" id="send-file19detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input19detail" type="file" name="file_detaldop4[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper20detail">
   				<div class="mask" id="mask20detail">
      				<input class="fileInputText" id="fileInputText20detail" type="text" disabled>
      				<button class="send-file" id="send-file20detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input20detail" type="file" name="file_detaldop4[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper21detail">
   				<div class="mask" id="mask21detail">
      				<input class="fileInputText" id="fileInputText21detail" type="text" disabled>
      				<button class="send-file" id="send-file21detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input21detail" type="file" name="file_detaldop4[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper22detail">
   				<div class="mask" id="mask22detail">
      				<input class="fileInputText" id="fileInputText22detail" type="text" disabled>
      				<button class="send-file" id="send-file22detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input22detail" type="file" name="file_detaldop4[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper23detail">
   				<div class="mask" id="mask23detail">
      				<input class="fileInputText" id="fileInputText23detail" type="text" disabled>
      				<button class="send-file" id="send-file23detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input23detail" type="file" name="file_detaldop4[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper24detail">
   				<div class="mask" id="mask24detail">
      				<input class="fileInputText" id="fileInputText24detail" type="text" disabled>
      				<button class="send-file" id="send-file24detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input24detail" type="file" name="file_detaldop4[]">
			</div>
            
            
			
            </div>
            
            
            <style type="text/css">
            .mask-wrapper {
   				height: 50px;
   				margin-bottom:20px;
				
			}
			.mask-wrapper .send-file {
   				padding: 3px 20px;
   				margin-left: 3px;
   				color: #fff;
   				background-color: #ccc;
			}
			.mask-wrapper .fileInputText {
   				position: relative;
   				width: 133px;
   				top: 3px;
			}
			.custom-file-input {
   				width: 100% !important;
  height: 50px;
   				opacity: 0;
   				filter: alpha(opacity=0);
   				position: relative;
   				top: -52px;
   				left: -16px;
   				z-index: 99999;
   				cursor: pointer;
			}
            </style>
            <input type="button" value="Добавить ещё" class="INeedMore" id="INeedMore2"/>
            <span class="note1">Фото шильдика детали (фотографии должны быть чёткими, маркировки должны быть разборчивыми) </span>
        
        
        </div>
        
        
        
    
    </div>
    
    <div class="block3">
    	<span class="note2" onClick="f_show2dop4()">Добавить информацию</span>
	</div>
    
    
    <div id="f2dop4" name="f2" class="f">
   		<textarea name="textareaf2dop4" placeholder="Дополнительная информация"></textarea>
    
	</div>
    
    <div style="width:100%; height:3px;  margin-bottom:15px;" class="dotted_line"></div>
    
    
    </div>
    <!----=======================================================================----->
    <div class="dop5">
    <div class="block1">
    	<div class="block11">
        	<input type="text" class="input1" name="input31dop5" id="input31" placeholder="Название детали"/>
    		<span class="text1">Например: Стартер</span>
    	
        </div>
        <div class="block12">
        	<input type="text" class="input2" name="input32dop5" id="input32" placeholder="Описание детали"/>
    		<span class="text2">Краткое описание детали</span>
    	
        </div>
		
    </div>
    
    
    <div class="block2">
    	<div class="left">Прикрепить фото:</div>
        <div class="right" id="right">
        	<!--<input type="file" name="file1" id="file1" class="file"/>-->
           <!-- <input type="button" value="Выбрать" class="button"/>-->
            
            <style type="text/css">
            #right22 #mask-wrapper1detail{
			display:block;
			}            
            </style>
            
            
            <div id="right22">
            
            
            
            <div class="mask-wrapper" id="mask-wrapper1detail">
   				<div class="mask" id="mask1detail">
      				<input class="fileInputText" id="fileInputText1detail" type="text" disabled>
      				<button class="send-file" id="send-file1detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input1detail" type="file" name="file_detaldop5[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper2detail">
   				<div class="mask" id="mask2detail">
      				<input class="fileInputText" id="fileInputText2detail" type="text" disabled>
      				<button class="send-file" id="send-file2detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input2detail" type="file" name="file_detaldop5[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper3detail">
   				<div class="mask" id="mask3detail">
      				<input class="fileInputText" id="fileInputText3detail" type="text" disabled>
      				<button class="send-file" id="send-file3detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input3detail" type="file" name="file_detaldop5[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper4detail">
   				<div class="mask" id="mask4detail">
      				<input class="fileInputText" id="fileInputText4detail" type="text" disabled>
      				<button class="send-file" id="send-file4detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input4detail" type="file" name="file_detaldop5[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper5detail">
   				<div class="mask" id="mask5detail">
      				<input class="fileInputText" id="fileInputText5detail" type="text" disabled>
      				<button class="send-file" id="send-file5detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input5detail" type="file" name="file_detaldop5[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper6detail">
   				<div class="mask" id="mask6detail">
      				<input class="fileInputText" id="fileInputText6detail" type="text" disabled>
      				<button class="send-file" id="send-file6detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input6detail" type="file" name="file_detaldop5[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper7detail">
   				<div class="mask" id="mask7detail">
      				<input class="fileInputText" id="fileInputText7detail" type="text" disabled>
      				<button class="send-file" id="send-file7detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input7detail" type="file" name="file_detaldop5[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper8detail">
   				<div class="mask" id="mask8detail">
      				<input class="fileInputText" id="fileInputText8detail" type="text" disabled>
      				<button class="send-file" id="send-file8detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input8detail" type="file" name="file_detaldop5[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper9detail">
   				<div class="mask" id="mask9detail">
      				<input class="fileInputText" id="fileInputText9detail" type="text" disabled>
      				<button class="send-file" id="send-file9detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input9detail" type="file" name="file_detaldop5[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper10detail">
   				<div class="mask" id="mask10detail">
      				<input class="fileInputText" id="fileInputText10detail" type="text" disabled>
      				<button class="send-file" id="send-file10detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input10detail" type="file" name="file_detaldop5[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper11detail">
   				<div class="mask" id="mask11detail">
      				<input class="fileInputText" id="fileInputText11detail" type="text" disabled>
      				<button class="send-file" id="send-file11detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input11detail" type="file" name="file_detaldop5[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper12detail">
   				<div class="mask" id="mask12detail">
      				<input class="fileInputText" id="fileInputText12detail" type="text" disabled>
      				<button class="send-file" id="send-file12detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input12detail" type="file" name="file_detaldop5[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper13detail">
   				<div class="mask" id="mask13detail">
      				<input class="fileInputText" id="fileInputText13detail" type="text" disabled>
      				<button class="send-file" id="send-file13detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input13detail" type="file" name="file_detaldop5[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper14detail">
   				<div class="mask" id="mask14detail">
      				<input class="fileInputText" id="fileInputText14detail" type="text" disabled>
      				<button class="send-file" id="send-file14detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input14detail" type="file" name="file_detaldop5[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper15detail">
   				<div class="mask" id="mask15detail">
      				<input class="fileInputText" id="fileInputText15detail" type="text" disabled>
      				<button class="send-file" id="send-file15detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input15detail" type="file" name="file_detaldop5[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper16detail">
   				<div class="mask" id="mask16detail">
      				<input class="fileInputText" id="fileInputText16detail" type="text" disabled>
      				<button class="send-file" id="send-file16detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input16detail" type="file" name="file_detaldop5[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper17detail">
   				<div class="mask" id="mask17detail">
      				<input class="fileInputText" id="fileInputText17detail" type="text" disabled>
      				<button class="send-file" id="send-file17detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input17detail" type="file" name="file_detaldop5[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper18detail">
   				<div class="mask" id="mask18detail">
      				<input class="fileInputText" id="fileInputText18detail" type="text" disabled>
      				<button class="send-file" id="send-file18detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input18detail" type="file" name="file_detaldop5[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper19detail">
   				<div class="mask" id="mask19detail">
      				<input class="fileInputText" id="fileInputText19detail" type="text" disabled>
      				<button class="send-file" id="send-file19detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input19detail" type="file" name="file_detaldop5[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper20detail">
   				<div class="mask" id="mask20detail">
      				<input class="fileInputText" id="fileInputText20detail" type="text" disabled>
      				<button class="send-file" id="send-file20detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input20detail" type="file" name="file_detaldop5[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper21detail">
   				<div class="mask" id="mask21detail">
      				<input class="fileInputText" id="fileInputText21detail" type="text" disabled>
      				<button class="send-file" id="send-file21detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input21detail" type="file" name="file_detaldop5[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper22detail">
   				<div class="mask" id="mask22detail">
      				<input class="fileInputText" id="fileInputText22detail" type="text" disabled>
      				<button class="send-file" id="send-file22detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input22detail" type="file" name="file_detaldop5[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper23detail">
   				<div class="mask" id="mask23detail">
      				<input class="fileInputText" id="fileInputText23detail" type="text" disabled>
      				<button class="send-file" id="send-file23detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input23detail" type="file" name="file_detaldop5[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper24detail">
   				<div class="mask" id="mask24detail">
      				<input class="fileInputText" id="fileInputText24detail" type="text" disabled>
      				<button class="send-file" id="send-file24detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input24detail" type="file" name="file_detaldop5[]">
			</div>
            
            
			
            </div>
            
            
            <style type="text/css">
            .mask-wrapper {
   				height: 50px;
   				margin-bottom:20px;
				
			}
			.mask-wrapper .send-file {
   				padding: 3px 20px;
   				margin-left: 3px;
   				color: #fff;
   				background-color: #ccc;
			}
			.mask-wrapper .fileInputText {
   				position: relative;
   				width: 133px;
   				top: 3px;
			}
			.custom-file-input {
   				width: 100% !important;
  height: 50px;
   				opacity: 0;
   				filter: alpha(opacity=0);
   				position: relative;
   				top: -52px;
   				left: -16px;
   				z-index: 99999;
   				cursor: pointer;
			}
            </style>
            <input type="button" value="Добавить ещё" class="INeedMore" id="INeedMore2"/>
            <span class="note1">Фото шильдика детали (фотографии должны быть чёткими, маркировки должны быть разборчивыми) </span>
        
        
        </div>
        
        
        
    
    </div>
    
    <div class="block3">
    	<span class="note2" onClick="f_show2dop5()">Добавить информацию</span>
	</div>
    
    
    <div id="f2dop5" name="f2" class="f">
   		<textarea name="textareaf2dop5" placeholder="Дополнительная информация"></textarea>
    
	</div>
    
    <div style="width:100%; height:3px;  margin-bottom:15px;" class="dotted_line"></div>
    
    
    </div>
    <!----=======================================================================----->
    
    <div class="dop6">
    <div class="block1">
    	<div class="block11">
        	<input type="text" class="input1" name="input31dop6" id="input31" placeholder="Название детали"/>
    		<span class="text1">Например Yuchai</span>
    	
        </div>
        <div class="block12">
        	<input type="text" class="input2" name="input32dop6" id="input32" placeholder="Описание детали"/>
    		<span class="text2">Например YCD4688R</span>
    	
        </div>
		
    </div>
    
    
    <div class="block2">
    	<div class="left">Прикрепить фото:</div>
        <div class="right" id="right">
        	  
            <style type="text/css">
            #right22 #mask-wrapper1detail{
			display:block;
			}            
            </style>
            
            
            <div id="right22">
            
            
            
            <div class="mask-wrapper" id="mask-wrapper1detail">
   				<div class="mask" id="mask1detail">
      				<input class="fileInputText" id="fileInputText1detail" type="text" disabled>
      				<button class="send-file" id="send-file1detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input1detail" type="file" name="file_detaldop6[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper2detail">
   				<div class="mask" id="mask2detail">
      				<input class="fileInputText" id="fileInputText2detail" type="text" disabled>
      				<button class="send-file" id="send-file2detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input2detail" type="file" name="file_detaldop6[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper3detail">
   				<div class="mask" id="mask3detail">
      				<input class="fileInputText" id="fileInputText3detail" type="text" disabled>
      				<button class="send-file" id="send-file3detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input3detail" type="file" name="file_detaldop6[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper4detail">
   				<div class="mask" id="mask4detail">
      				<input class="fileInputText" id="fileInputText4detail" type="text" disabled>
      				<button class="send-file" id="send-file4detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input4detail" type="file" name="file_detaldop6[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper5detail">
   				<div class="mask" id="mask5detail">
      				<input class="fileInputText" id="fileInputText5detail" type="text" disabled>
      				<button class="send-file" id="send-file5detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input5detail" type="file" name="file_detaldop6[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper6detail">
   				<div class="mask" id="mask6detail">
      				<input class="fileInputText" id="fileInputText6detail" type="text" disabled>
      				<button class="send-file" id="send-file6detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input6detail" type="file" name="file_detaldop6[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper7detail">
   				<div class="mask" id="mask7detail">
      				<input class="fileInputText" id="fileInputText7detail" type="text" disabled>
      				<button class="send-file" id="send-file7detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input7detail" type="file" name="file_detaldop6[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper8detail">
   				<div class="mask" id="mask8detail">
      				<input class="fileInputText" id="fileInputText8detail" type="text" disabled>
      				<button class="send-file" id="send-file8detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input8detail" type="file" name="file_detaldop6[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper9detail">
   				<div class="mask" id="mask9detail">
      				<input class="fileInputText" id="fileInputText9detail" type="text" disabled>
      				<button class="send-file" id="send-file9detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input9detail" type="file" name="file_detaldop6[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper10detail">
   				<div class="mask" id="mask10detail">
      				<input class="fileInputText" id="fileInputText10detail" type="text" disabled>
      				<button class="send-file" id="send-file10detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input10detail" type="file" name="file_detaldop6[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper11detail">
   				<div class="mask" id="mask11detail">
      				<input class="fileInputText" id="fileInputText11detail" type="text" disabled>
      				<button class="send-file" id="send-file11detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input11detail" type="file" name="file_detaldop6[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper12detail">
   				<div class="mask" id="mask12detail">
      				<input class="fileInputText" id="fileInputText12detail" type="text" disabled>
      				<button class="send-file" id="send-file12detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input12detail" type="file" name="file_detaldop6[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper13detail">
   				<div class="mask" id="mask13detail">
      				<input class="fileInputText" id="fileInputText13detail" type="text" disabled>
      				<button class="send-file" id="send-file13detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input13detail" type="file" name="file_detaldop6[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper14detail">
   				<div class="mask" id="mask14detail">
      				<input class="fileInputText" id="fileInputText14detail" type="text" disabled>
      				<button class="send-file" id="send-file14detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input14detail" type="file" name="file_detaldop6[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper15detail">
   				<div class="mask" id="mask15detail">
      				<input class="fileInputText" id="fileInputText15detail" type="text" disabled>
      				<button class="send-file" id="send-file15detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input15detail" type="file" name="file_detaldop6[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper16detail">
   				<div class="mask" id="mask16detail">
      				<input class="fileInputText" id="fileInputText16detail" type="text" disabled>
      				<button class="send-file" id="send-file16detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input16detail" type="file" name="file_detaldop6[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper17detail">
   				<div class="mask" id="mask17detail">
      				<input class="fileInputText" id="fileInputText17detail" type="text" disabled>
      				<button class="send-file" id="send-file17detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input17detail" type="file" name="file_detaldop6[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper18detail">
   				<div class="mask" id="mask18detail">
      				<input class="fileInputText" id="fileInputText18detail" type="text" disabled>
      				<button class="send-file" id="send-file18detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input18detail" type="file" name="file_detaldop6[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper19detail">
   				<div class="mask" id="mask19detail">
      				<input class="fileInputText" id="fileInputText19detail" type="text" disabled>
      				<button class="send-file" id="send-file19detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input19detail" type="file" name="file_detaldop6[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper20detail">
   				<div class="mask" id="mask20detail">
      				<input class="fileInputText" id="fileInputText20detail" type="text" disabled>
      				<button class="send-file" id="send-file20detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input20detail" type="file" name="file_detaldop6[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper21detail">
   				<div class="mask" id="mask21detail">
      				<input class="fileInputText" id="fileInputText21detail" type="text" disabled>
      				<button class="send-file" id="send-file21detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input21detail" type="file" name="file_detaldop6[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper22detail">
   				<div class="mask" id="mask22detail">
      				<input class="fileInputText" id="fileInputText22detail" type="text" disabled>
      				<button class="send-file" id="send-file22detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input22detail" type="file" name="file_detaldop6[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper23detail">
   				<div class="mask" id="mask23detail">
      				<input class="fileInputText" id="fileInputText23detail" type="text" disabled>
      				<button class="send-file" id="send-file23detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input23detail" type="file" name="file_detaldop6[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper24detail">
   				<div class="mask" id="mask24detail">
      				<input class="fileInputText" id="fileInputText24detail" type="text" disabled>
      				<button class="send-file" id="send-file24detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input24detail" type="file" name="file_detaldop6[]">
			</div>
            
            
			
            </div>
            
            
            <style type="text/css">
            .mask-wrapper {
   				height: 50px;
   				margin-bottom:20px;
				
			}
			.mask-wrapper .send-file {
   				padding: 3px 20px;
   				margin-left: 3px;
   				color: #fff;
   				background-color: #ccc;
			}
			.mask-wrapper .fileInputText {
   				position: relative;
   				width: 133px;
   				top: 3px;
			}
			.custom-file-input {
   				width: 100% !important;
  height: 50px;
   				opacity: 0;
   				filter: alpha(opacity=0);
   				position: relative;
   				top: -52px;
   				left: -16px;
   				z-index: 99999;
   				cursor: pointer;
			}
            </style>
            <input type="button" value="Добавить ещё" class="INeedMore" id="INeedMore2"/>
            <span class="note1">Фото именной таблички техники (фотографии должны быть чёткими, маркировки должны быть читабельными) </span>
        
        
        </div>
        
        
        
    
    </div>
    
    <div class="block3">
    	<span class="note2" onClick="f_show2dop6()">Добавить информацию</span>
	</div>
    
    
    <div id="f2dop6" name="f2" class="f">
   		<textarea name="textareaf2dop6" placeholder="Дополнительная информация"></textarea>
    
	</div>
    
    <div style="width:100%; height:3px;  margin-bottom:15px;" class="dotted_line"></div>
    
    
    </div>
    
    <!----=======================================================================----->
    <div class="dop7">
    <div class="block1">
    	<div class="block11">
        	<input type="text" class="input1" name="input31dop7" id="input31" placeholder="Название детали"/>
    		<span class="text1">Например Yuchai</span>
    	
        </div>
        <div class="block12">
        	<input type="text" class="input2" name="input32dop7" id="input32" placeholder="Описание детали"/>
    		<span class="text2">Например YCD4688R</span>
    	
        </div>
		
    </div>
    
    
    <div class="block2">
    	<div class="left">Прикрепить фото:</div>
        <div class="right" id="right">
          
            <style type="text/css">
            #right22 #mask-wrapper1detail{
			display:block;
			}            
            </style>
            
            
            <div id="right22">
            
            
            
            <div class="mask-wrapper" id="mask-wrapper1detail">
   				<div class="mask" id="mask1detail">
      				<input class="fileInputText" id="fileInputText1detail" type="text" disabled>
      				<button class="send-file" id="send-file1detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input1detail" type="file" name="file_detaldop7[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper2detail">
   				<div class="mask" id="mask2detail">
      				<input class="fileInputText" id="fileInputText2detail" type="text" disabled>
      				<button class="send-file" id="send-file2detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input2detail" type="file" name="file_detaldop7[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper3detail">
   				<div class="mask" id="mask3detail">
      				<input class="fileInputText" id="fileInputText3detail" type="text" disabled>
      				<button class="send-file" id="send-file3detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input3detail" type="file" name="file_detaldop7[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper4detail">
   				<div class="mask" id="mask4detail">
      				<input class="fileInputText" id="fileInputText4detail" type="text" disabled>
      				<button class="send-file" id="send-file4detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input4detail" type="file" name="file_detaldop7[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper5detail">
   				<div class="mask" id="mask5detail">
      				<input class="fileInputText" id="fileInputText5detail" type="text" disabled>
      				<button class="send-file" id="send-file5detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input5detail" type="file" name="file_detaldop7[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper6detail">
   				<div class="mask" id="mask6detail">
      				<input class="fileInputText" id="fileInputText6detail" type="text" disabled>
      				<button class="send-file" id="send-file6detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input6detail" type="file" name="file_detaldop7[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper7detail">
   				<div class="mask" id="mask7detail">
      				<input class="fileInputText" id="fileInputText7detail" type="text" disabled>
      				<button class="send-file" id="send-file7detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input7detail" type="file" name="file_detaldop7[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper8detail">
   				<div class="mask" id="mask8detail">
      				<input class="fileInputText" id="fileInputText8detail" type="text" disabled>
      				<button class="send-file" id="send-file8detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input8detail" type="file" name="file_detaldop7[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper9detail">
   				<div class="mask" id="mask9detail">
      				<input class="fileInputText" id="fileInputText9detail" type="text" disabled>
      				<button class="send-file" id="send-file9detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input9detail" type="file" name="file_detaldop7[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper10detail">
   				<div class="mask" id="mask10detail">
      				<input class="fileInputText" id="fileInputText10detail" type="text" disabled>
      				<button class="send-file" id="send-file10detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input10detail" type="file" name="file_detaldop7[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper11detail">
   				<div class="mask" id="mask11detail">
      				<input class="fileInputText" id="fileInputText11detail" type="text" disabled>
      				<button class="send-file" id="send-file11detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input11detail" type="file" name="file_detaldop7[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper12detail">
   				<div class="mask" id="mask12detail">
      				<input class="fileInputText" id="fileInputText12detail" type="text" disabled>
      				<button class="send-file" id="send-file12detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input12detail" type="file" name="file_detaldop7[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper13detail">
   				<div class="mask" id="mask13detail">
      				<input class="fileInputText" id="fileInputText13detail" type="text" disabled>
      				<button class="send-file" id="send-file13detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input13detail" type="file" name="file_detaldop7[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper14detail">
   				<div class="mask" id="mask14detail">
      				<input class="fileInputText" id="fileInputText14detail" type="text" disabled>
      				<button class="send-file" id="send-file14detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input14detail" type="file" name="file_detaldop7[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper15detail">
   				<div class="mask" id="mask15detail">
      				<input class="fileInputText" id="fileInputText15detail" type="text" disabled>
      				<button class="send-file" id="send-file15detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input15detail" type="file" name="file_detaldop7[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper16detail">
   				<div class="mask" id="mask16detail">
      				<input class="fileInputText" id="fileInputText16detail" type="text" disabled>
      				<button class="send-file" id="send-file16detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input16detail" type="file" name="file_detaldop7[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper17detail">
   				<div class="mask" id="mask17detail">
      				<input class="fileInputText" id="fileInputText17detail" type="text" disabled>
      				<button class="send-file" id="send-file17detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input17detail" type="file" name="file_detaldop7[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper18detail">
   				<div class="mask" id="mask18detail">
      				<input class="fileInputText" id="fileInputText18detail" type="text" disabled>
      				<button class="send-file" id="send-file18detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input18detail" type="file" name="file_detaldop7[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper19detail">
   				<div class="mask" id="mask19detail">
      				<input class="fileInputText" id="fileInputText19detail" type="text" disabled>
      				<button class="send-file" id="send-file19detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input19detail" type="file" name="file_detaldop7[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper20detail">
   				<div class="mask" id="mask20detail">
      				<input class="fileInputText" id="fileInputText20detail" type="text" disabled>
      				<button class="send-file" id="send-file20detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input20detail" type="file" name="file_detaldop7[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper21detail">
   				<div class="mask" id="mask21detail">
      				<input class="fileInputText" id="fileInputText21detail" type="text" disabled>
      				<button class="send-file" id="send-file21detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input21detail" type="file" name="file_detaldop7[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper22detail">
   				<div class="mask" id="mask22detail">
      				<input class="fileInputText" id="fileInputText22detail" type="text" disabled>
      				<button class="send-file" id="send-file22detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input22detail" type="file" name="file_detaldop7[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper23detail">
   				<div class="mask" id="mask23detail">
      				<input class="fileInputText" id="fileInputText23detail" type="text" disabled>
      				<button class="send-file" id="send-file23detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input23detail" type="file" name="file_detaldop7[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper24detail">
   				<div class="mask" id="mask24detail">
      				<input class="fileInputText" id="fileInputText24detail" type="text" disabled>
      				<button class="send-file" id="send-file24detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input24detail" type="file" name="file_detaldop7[]">
			</div>
            
            
			
            </div>
            
            
            <style type="text/css">
            .mask-wrapper {
   				height: 50px;
   				margin-bottom:20px;
				
			}
			.mask-wrapper .send-file {
   				padding: 3px 20px;
   				margin-left: 3px;
   				color: #fff;
   				background-color: #ccc;
			}
			.mask-wrapper .fileInputText {
   				position: relative;
   				width: 133px;
   				top: 3px;
			}
			.custom-file-input {
   				width: 100% !important;
  height: 50px;
   				opacity: 0;
   				filter: alpha(opacity=0);
   				position: relative;
   				top: -52px;
   				left: -16px;
   				z-index: 99999;
   				cursor: pointer;
			}
            </style>
            <input type="button" value="Добавить ещё" class="INeedMore" id="INeedMore2"/>
            <span class="note1">Фото именной таблички техники (фотографии должны быть чёткими, маркировки должны быть читабельными) </span>
        
        
        </div>
        
        
        
    
    </div>
    
    <div class="block3">
    	<span class="note2" onClick="f_show2dop7()">Добавить информацию</span>
	</div>
    
    
    <div id="f2dop7" name="f2" class="f">
   		<textarea name="textareaf2dop7" placeholder="Дополнительная информация"></textarea>
    
	</div>
    
    <div style="width:100%; height:3px;  margin-bottom:15px;" class="dotted_line"></div>
    
    
    </div>
    
    <!----=======================================================================----->
    
    <div class="dop8">
    <div class="block1">
    	<div class="block11">
        	<input type="text" class="input1" name="input31dop8" id="input31" placeholder="Название детали"/>
    		<span class="text1">Например Yuchai</span>
    	
        </div>
        <div class="block12">
        	<input type="text" class="input2" name="input32dop8" id="input32" placeholder="Описание детали"/>
    		<span class="text2">Например YCD4688R</span>
    	
        </div>
		
    </div>
    
    
    <div class="block2">
    	<div class="left">Прикрепить фото:</div>
        <div class="right" id="right">
        	
            <style type="text/css">
            #right22 #mask-wrapper1detail{
			display:block;
			}            
            </style>
            
            
            <div id="right22">
            
            
            
            <div class="mask-wrapper" id="mask-wrapper1detail">
   				<div class="mask" id="mask1detail">
      				<input class="fileInputText" id="fileInputText1detail" type="text" disabled>
      				<button class="send-file" id="send-file1detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input1detail" type="file" name="file_detaldop8[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper2detail">
   				<div class="mask" id="mask2detail">
      				<input class="fileInputText" id="fileInputText2detail" type="text" disabled>
      				<button class="send-file" id="send-file2detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input2detail" type="file" name="file_detaldop8[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper3detail">
   				<div class="mask" id="mask3detail">
      				<input class="fileInputText" id="fileInputText3detail" type="text" disabled>
      				<button class="send-file" id="send-file3detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input3detail" type="file" name="file_detaldop8[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper4detail">
   				<div class="mask" id="mask4detail">
      				<input class="fileInputText" id="fileInputText4detail" type="text" disabled>
      				<button class="send-file" id="send-file4detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input4detail" type="file" name="file_detaldop8[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper5detail">
   				<div class="mask" id="mask5detail">
      				<input class="fileInputText" id="fileInputText5detail" type="text" disabled>
      				<button class="send-file" id="send-file5detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input5detail" type="file" name="file_detaldop8[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper6detail">
   				<div class="mask" id="mask6detail">
      				<input class="fileInputText" id="fileInputText6detail" type="text" disabled>
      				<button class="send-file" id="send-file6detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input6detail" type="file" name="file_detaldop8[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper7detail">
   				<div class="mask" id="mask7detail">
      				<input class="fileInputText" id="fileInputText7detail" type="text" disabled>
      				<button class="send-file" id="send-file7detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input7detail" type="file" name="file_detaldop8[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper8detail">
   				<div class="mask" id="mask8detail">
      				<input class="fileInputText" id="fileInputText8detail" type="text" disabled>
      				<button class="send-file" id="send-file8detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input8detail" type="file" name="file_detaldop8[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper9detail">
   				<div class="mask" id="mask9detail">
      				<input class="fileInputText" id="fileInputText9detail" type="text" disabled>
      				<button class="send-file" id="send-file9detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input9detail" type="file" name="file_detaldop8[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper10detail">
   				<div class="mask" id="mask10detail">
      				<input class="fileInputText" id="fileInputText10detail" type="text" disabled>
      				<button class="send-file" id="send-file10detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input10detail" type="file" name="file_detaldop8[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper11detail">
   				<div class="mask" id="mask11detail">
      				<input class="fileInputText" id="fileInputText11detail" type="text" disabled>
      				<button class="send-file" id="send-file11detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input11detail" type="file" name="file_detaldop8[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper12detail">
   				<div class="mask" id="mask12detail">
      				<input class="fileInputText" id="fileInputText12detail" type="text" disabled>
      				<button class="send-file" id="send-file12detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input12detail" type="file" name="file_detaldop8[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper13detail">
   				<div class="mask" id="mask13detail">
      				<input class="fileInputText" id="fileInputText13detail" type="text" disabled>
      				<button class="send-file" id="send-file13detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input13detail" type="file" name="file_detaldop8[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper14detail">
   				<div class="mask" id="mask14detail">
      				<input class="fileInputText" id="fileInputText14detail" type="text" disabled>
      				<button class="send-file" id="send-file14detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input14detail" type="file" name="file_detaldop8[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper15detail">
   				<div class="mask" id="mask15detail">
      				<input class="fileInputText" id="fileInputText15detail" type="text" disabled>
      				<button class="send-file" id="send-file15detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input15detail" type="file" name="file_detaldop8[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper16detail">
   				<div class="mask" id="mask16detail">
      				<input class="fileInputText" id="fileInputText16detail" type="text" disabled>
      				<button class="send-file" id="send-file16detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input16detail" type="file" name="file_detaldop8[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper17detail">
   				<div class="mask" id="mask17detail">
      				<input class="fileInputText" id="fileInputText17detail" type="text" disabled>
      				<button class="send-file" id="send-file17detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input17detail" type="file" name="file_detaldop8[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper18detail">
   				<div class="mask" id="mask18detail">
      				<input class="fileInputText" id="fileInputText18detail" type="text" disabled>
      				<button class="send-file" id="send-file18detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input18detail" type="file" name="file_detaldop8[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper19detail">
   				<div class="mask" id="mask19detail">
      				<input class="fileInputText" id="fileInputText19detail" type="text" disabled>
      				<button class="send-file" id="send-file19detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input19detail" type="file" name="file_detaldop8[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper20detail">
   				<div class="mask" id="mask20detail">
      				<input class="fileInputText" id="fileInputText20detail" type="text" disabled>
      				<button class="send-file" id="send-file20detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input20detail" type="file" name="file_detaldop8[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper21detail">
   				<div class="mask" id="mask21detail">
      				<input class="fileInputText" id="fileInputText21detail" type="text" disabled>
      				<button class="send-file" id="send-file21detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input21detail" type="file" name="file_detaldop8[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper22detail">
   				<div class="mask" id="mask22detail">
      				<input class="fileInputText" id="fileInputText22detail" type="text" disabled>
      				<button class="send-file" id="send-file22detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input22detail" type="file" name="file_detaldop8[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper23detail">
   				<div class="mask" id="mask23detail">
      				<input class="fileInputText" id="fileInputText23detail" type="text" disabled>
      				<button class="send-file" id="send-file23detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input23detail" type="file" name="file_detaldop8[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper24detail">
   				<div class="mask" id="mask24detail">
      				<input class="fileInputText" id="fileInputText24detail" type="text" disabled>
      				<button class="send-file" id="send-file24detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input24detail" type="file" name="file_detaldop8[]">
			</div>
            
            
			
            </div>
            
            
            <style type="text/css">
            .mask-wrapper {
   				height: 50px;
   				margin-bottom:20px;
				
			}
			.mask-wrapper .send-file {
   				padding: 3px 20px;
   				margin-left: 3px;
   				color: #fff;
   				background-color: #ccc;
			}
			.mask-wrapper .fileInputText {
   				position: relative;
   				width: 133px;
   				top: 3px;
			}
			.custom-file-input {
   				width: 100% !important;
  height: 50px;
   				opacity: 0;
   				filter: alpha(opacity=0);
   				position: relative;
   				top: -52px;
   				left: -16px;
   				z-index: 99999;
   				cursor: pointer;
			}
            </style>
            <input type="button" value="Добавить ещё" class="INeedMore" id="INeedMore2"/>
            <span class="note1">Фото именной таблички техники (фотографии должны быть чёткими, маркировки должны быть читабельными) </span>
        
        
        </div>
        
        
        
    
    </div>
    
    <div class="block3">
    	<span class="note2" onClick="f_show2dop8()">Добавить информацию</span>
	</div>
    
    
    <div id="f2dop8" name="f2" class="f">
   		<textarea name="textareaf2dop8" placeholder="Дополнительная информация"></textarea>
    
	</div>
    
    <div style="width:100%; height:3px;  margin-bottom:15px;" class="dotted_line"></div>
    
    
    </div>
    <!----=======================================================================----->
    
    <div class="dop9">
    <div class="block1">
    	<div class="block11">
        	<input type="text" class="input1" name="input31dop9" id="input31" placeholder="Название детали"/>
    		<span class="text1">Например Yuchai</span>
    	
        </div>
        <div class="block12">
        	<input type="text" class="input2" name="input32dop9" id="input32" placeholder="Описание детали"/>
    		<span class="text2">Например YCD4688R</span>
    	
        </div>
		
    </div>
    
    
    <div class="block2">
    	<div class="left">Прикрепить фото:</div>
        <div class="right" id="right">
        	
            <style type="text/css">
            #right22 #mask-wrapper1detail{
			display:block;
			}            
            </style>
            
            
            <div id="right22">
            
            
            
            <div class="mask-wrapper" id="mask-wrapper1detail">
   				<div class="mask" id="mask1detail">
      				<input class="fileInputText" id="fileInputText1detail" type="text" disabled>
      				<button class="send-file" id="send-file1detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input1detail" type="file" name="file_detaldop9[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper2detail">
   				<div class="mask" id="mask2detail">
      				<input class="fileInputText" id="fileInputText2detail" type="text" disabled>
      				<button class="send-file" id="send-file2detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input2detail" type="file" name="file_detaldop9[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper3detail">
   				<div class="mask" id="mask3detail">
      				<input class="fileInputText" id="fileInputText3detail" type="text" disabled>
      				<button class="send-file" id="send-file3detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input3detail" type="file" name="file_detaldop9[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper4detail">
   				<div class="mask" id="mask4detail">
      				<input class="fileInputText" id="fileInputText4detail" type="text" disabled>
      				<button class="send-file" id="send-file4detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input4detail" type="file" name="file_detaldop9[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper5detail">
   				<div class="mask" id="mask5detail">
      				<input class="fileInputText" id="fileInputText5detail" type="text" disabled>
      				<button class="send-file" id="send-file5detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input5detail" type="file" name="file_detaldop9[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper6detail">
   				<div class="mask" id="mask6detail">
      				<input class="fileInputText" id="fileInputText6detail" type="text" disabled>
      				<button class="send-file" id="send-file6detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input6detail" type="file" name="file_detaldop9[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper7detail">
   				<div class="mask" id="mask7detail">
      				<input class="fileInputText" id="fileInputText7detail" type="text" disabled>
      				<button class="send-file" id="send-file7detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input7detail" type="file" name="file_detaldop9[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper8detail">
   				<div class="mask" id="mask8detail">
      				<input class="fileInputText" id="fileInputText8detail" type="text" disabled>
      				<button class="send-file" id="send-file8detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input8detail" type="file" name="file_detaldop9[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper9detail">
   				<div class="mask" id="mask9detail">
      				<input class="fileInputText" id="fileInputText9detail" type="text" disabled>
      				<button class="send-file" id="send-file9detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input9detail" type="file" name="file_detaldop9[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper10detail">
   				<div class="mask" id="mask10detail">
      				<input class="fileInputText" id="fileInputText10detail" type="text" disabled>
      				<button class="send-file" id="send-file10detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input10detail" type="file" name="file_detaldop9[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper11detail">
   				<div class="mask" id="mask11detail">
      				<input class="fileInputText" id="fileInputText11detail" type="text" disabled>
      				<button class="send-file" id="send-file11detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input11detail" type="file" name="file_detaldop9[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper12detail">
   				<div class="mask" id="mask12detail">
      				<input class="fileInputText" id="fileInputText12detail" type="text" disabled>
      				<button class="send-file" id="send-file12detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input12detail" type="file" name="file_detaldop9[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper13detail">
   				<div class="mask" id="mask13detail">
      				<input class="fileInputText" id="fileInputText13detail" type="text" disabled>
      				<button class="send-file" id="send-file13detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input13detail" type="file" name="file_detaldop9[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper14detail">
   				<div class="mask" id="mask14detail">
      				<input class="fileInputText" id="fileInputText14detail" type="text" disabled>
      				<button class="send-file" id="send-file14detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input14detail" type="file" name="file_detaldop9[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper15detail">
   				<div class="mask" id="mask15detail">
      				<input class="fileInputText" id="fileInputText15detail" type="text" disabled>
      				<button class="send-file" id="send-file15detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input15detail" type="file" name="file_detaldop9[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper16detail">
   				<div class="mask" id="mask16detail">
      				<input class="fileInputText" id="fileInputText16detail" type="text" disabled>
      				<button class="send-file" id="send-file16detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input16detail" type="file" name="file_detaldop9[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper17detail">
   				<div class="mask" id="mask17detail">
      				<input class="fileInputText" id="fileInputText17detail" type="text" disabled>
      				<button class="send-file" id="send-file17detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input17detail" type="file" name="file_detaldop9[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper18detail">
   				<div class="mask" id="mask18detail">
      				<input class="fileInputText" id="fileInputText18detail" type="text" disabled>
      				<button class="send-file" id="send-file18detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input18detail" type="file" name="file_detaldop9[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper19detail">
   				<div class="mask" id="mask19detail">
      				<input class="fileInputText" id="fileInputText19detail" type="text" disabled>
      				<button class="send-file" id="send-file19detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input19detail" type="file" name="file_detaldop9[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper20detail">
   				<div class="mask" id="mask20detail">
      				<input class="fileInputText" id="fileInputText20detail" type="text" disabled>
      				<button class="send-file" id="send-file20detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input20detail" type="file" name="file_detaldop9[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper21detail">
   				<div class="mask" id="mask21detail">
      				<input class="fileInputText" id="fileInputText21detail" type="text" disabled>
      				<button class="send-file" id="send-file21detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input21detail" type="file" name="file_detaldop9[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper22detail">
   				<div class="mask" id="mask22detail">
      				<input class="fileInputText" id="fileInputText22detail" type="text" disabled>
      				<button class="send-file" id="send-file22detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input22detail" type="file" name="file_detaldop9[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper23detail">
   				<div class="mask" id="mask23detail">
      				<input class="fileInputText" id="fileInputText23detail" type="text" disabled>
      				<button class="send-file" id="send-file23detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input23detail" type="file" name="file_detaldop9[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper24detail">
   				<div class="mask" id="mask24detail">
      				<input class="fileInputText" id="fileInputText24detail" type="text" disabled>
      				<button class="send-file" id="send-file24detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input24detail" type="file" name="file_detaldop9[]">
			</div>
            
            
			
            </div>
            
            
            <style type="text/css">
            .mask-wrapper {
   				height: 50px;
   				margin-bottom:20px;
				
			}
			.mask-wrapper .send-file {
   				padding: 3px 20px;
   				margin-left: 3px;
   				color: #fff;
   				background-color: #ccc;
			}
			.mask-wrapper .fileInputText {
   				position: relative;
   				width: 133px;
   				top: 3px;
			}
			.custom-file-input {
   				width: 100% !important;
  height: 50px;
   				opacity: 0;
   				filter: alpha(opacity=0);
   				position: relative;
   				top: -52px;
   				left: -16px;
   				z-index: 99999;
   				cursor: pointer;
			}
            </style>
            <input type="button" value="Добавить ещё" class="INeedMore" id="INeedMore2"/>
            <span class="note1">Фото именной таблички техники (фотографии должны быть чёткими, маркировки должны быть читабельными) </span>
        
        
        </div>
        
        
        
    
    </div>
    
    <div class="block3">
    	<span class="note2" onClick="f_show2dop9()">Добавить информацию</span>
	</div>
    
    
    <div id="f2dop9" name="f2" class="f">
   		<textarea name="textareaf2dop9" placeholder="Дополнительная информация"></textarea>
    
	</div>
    
    <div style="width:100%; height:3px;  margin-bottom:15px;" class="dotted_line"></div>
    
    
    </div>
    <!---=======================================================================----->
    
    <div class="dop10">
    <div class="block1">
    	<div class="block11">
        	<input type="text" class="input1" name="input31dop10" id="input31" placeholder="Название детали"/>
    		<span class="text1">Например Yuchai</span>
    	
        </div>
        <div class="block12">
        	<input type="text" class="input2" name="input32dop10" id="input32" placeholder="Описание детали"/>
    		<span class="text2">Например YCD4688R</span>
    	
        </div>
		
    </div>
    
    
    <div class="block2">
    	<div class="left">Прикрепить фото:</div>
        <div class="right" id="right">
          
            <style type="text/css">
            #right22 #mask-wrapper1detail{
			display:block;
			}            
            </style>
            
            
            <div id="right22">
            
            
            
            <div class="mask-wrapper" id="mask-wrapper1detail">
   				<div class="mask" id="mask1detail">
      				<input class="fileInputText" id="fileInputText1detail" type="text" disabled>
      				<button class="send-file" id="send-file1detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input1detail" type="file" name="file_detaldop10[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper2detail">
   				<div class="mask" id="mask2detail">
      				<input class="fileInputText" id="fileInputText2detail" type="text" disabled>
      				<button class="send-file" id="send-file2detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input2detail" type="file" name="file_detaldop10[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper3detail">
   				<div class="mask" id="mask3detail">
      				<input class="fileInputText" id="fileInputText3detail" type="text" disabled>
      				<button class="send-file" id="send-file3detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input3detail" type="file" name="file_detaldop10[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper4detail">
   				<div class="mask" id="mask4detail">
      				<input class="fileInputText" id="fileInputText4detail" type="text" disabled>
      				<button class="send-file" id="send-file4detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input4detail" type="file" name="file_detaldop10[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper5detail">
   				<div class="mask" id="mask5detail">
      				<input class="fileInputText" id="fileInputText5detail" type="text" disabled>
      				<button class="send-file" id="send-file5detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input5detail" type="file" name="file_detaldop10[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper6detail">
   				<div class="mask" id="mask6detail">
      				<input class="fileInputText" id="fileInputText6detail" type="text" disabled>
      				<button class="send-file" id="send-file6detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input6detail" type="file" name="file_detaldop10[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper7detail">
   				<div class="mask" id="mask7detail">
      				<input class="fileInputText" id="fileInputText7detail" type="text" disabled>
      				<button class="send-file" id="send-file7detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input7detail" type="file" name="file_detaldop10[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper8detail">
   				<div class="mask" id="mask8detail">
      				<input class="fileInputText" id="fileInputText8detail" type="text" disabled>
      				<button class="send-file" id="send-file8detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input8detail" type="file" name="file_detaldop10[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper9detail">
   				<div class="mask" id="mask9detail">
      				<input class="fileInputText" id="fileInputText9detail" type="text" disabled>
      				<button class="send-file" id="send-file9detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input9detail" type="file" name="file_detaldop10[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper10detail">
   				<div class="mask" id="mask10detail">
      				<input class="fileInputText" id="fileInputText10detail" type="text" disabled>
      				<button class="send-file" id="send-file10detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input10detail" type="file" name="file_detaldop10[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper11detail">
   				<div class="mask" id="mask11detail">
      				<input class="fileInputText" id="fileInputText11detail" type="text" disabled>
      				<button class="send-file" id="send-file11detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input11detail" type="file" name="file_detaldop10[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper12detail">
   				<div class="mask" id="mask12detail">
      				<input class="fileInputText" id="fileInputText12detail" type="text" disabled>
      				<button class="send-file" id="send-file12detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input12detail" type="file" name="file_detaldop10[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper13detail">
   				<div class="mask" id="mask13detail">
      				<input class="fileInputText" id="fileInputText13detail" type="text" disabled>
      				<button class="send-file" id="send-file13detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input13detail" type="file" name="file_detaldop10[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper14detail">
   				<div class="mask" id="mask14detail">
      				<input class="fileInputText" id="fileInputText14detail" type="text" disabled>
      				<button class="send-file" id="send-file14detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input14detail" type="file" name="file_detaldop10[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper15detail">
   				<div class="mask" id="mask15detail">
      				<input class="fileInputText" id="fileInputText15detail" type="text" disabled>
      				<button class="send-file" id="send-file15detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input15detail" type="file" name="file_detaldop10[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper16detail">
   				<div class="mask" id="mask16detail">
      				<input class="fileInputText" id="fileInputText16detail" type="text" disabled>
      				<button class="send-file" id="send-file16detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input16detail" type="file" name="file_detaldop10[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper17detail">
   				<div class="mask" id="mask17detail">
      				<input class="fileInputText" id="fileInputText17detail" type="text" disabled>
      				<button class="send-file" id="send-file17detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input17detail" type="file" name="file_detaldop10[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper18detail">
   				<div class="mask" id="mask18detail">
      				<input class="fileInputText" id="fileInputText18detail" type="text" disabled>
      				<button class="send-file" id="send-file18detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input18detail" type="file" name="file_detaldop10[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper19detail">
   				<div class="mask" id="mask19detail">
      				<input class="fileInputText" id="fileInputText19detail" type="text" disabled>
      				<button class="send-file" id="send-file19detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input19detail" type="file" name="file_detaldop10[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper20detail">
   				<div class="mask" id="mask20detail">
      				<input class="fileInputText" id="fileInputText20detail" type="text" disabled>
      				<button class="send-file" id="send-file20detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input20detail" type="file" name="file_detaldop10[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper21detail">
   				<div class="mask" id="mask21detail">
      				<input class="fileInputText" id="fileInputText21detail" type="text" disabled>
      				<button class="send-file" id="send-file21detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input21detail" type="file" name="file_detaldop10[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper22detail">
   				<div class="mask" id="mask22detail">
      				<input class="fileInputText" id="fileInputText22detail" type="text" disabled>
      				<button class="send-file" id="send-file22detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input22detail" type="file" name="file_detaldop10[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper23detail">
   				<div class="mask" id="mask23detail">
      				<input class="fileInputText" id="fileInputText23detail" type="text" disabled>
      				<button class="send-file" id="send-file23detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input23detail" type="file" name="file_detaldop10[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper24detail">
   				<div class="mask" id="mask24detail">
      				<input class="fileInputText" id="fileInputText24detail" type="text" disabled>
      				<button class="send-file" id="send-file24detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input24detail" type="file" name="file_detaldop10[]">
			</div>
            
            
			
            </div>
            
            
            <style type="text/css">
            .mask-wrapper {
   				height: 50px;
   				margin-bottom:20px;
				
			}
			.mask-wrapper .send-file {
   				padding: 3px 20px;
   				margin-left: 3px;
   				color: #fff;
   				background-color: #ccc;
			}
			.mask-wrapper .fileInputText {
   				position: relative;
   				width: 133px;
   				top: 3px;
			}
			.custom-file-input {
   				width: 100% !important;
  height: 50px;
   				opacity: 0;
   				filter: alpha(opacity=0);
   				position: relative;
   				top: -52px;
   				left: -16px;
   				z-index: 99999;
   				cursor: pointer;
			}
            </style>
            <input type="button" value="Добавить ещё" class="INeedMore" id="INeedMore2"/>
            <span class="note1">Фото именной таблички техники (фотографии должны быть чёткими, маркировки должны быть читабельными) </span>
        
        
        </div>
        
        
        
    
    </div>
    
    <div class="block3">
    	<span class="note2" onClick="f_show2dop10()">Добавить информацию</span>
	</div>
    
    
    <div id="f2dop10" name="f2" class="f">
   		<textarea name="textareaf2dop10" placeholder="Дополнительная информация"></textarea>
    
	</div>
    
    <div style="width:100%; height:3px;  margin-bottom:15px;" class="dotted_line"></div>
    
    
    </div>
    <!----=======================================================================----->
    
    <div class="dop11">
    <div class="block1">
    	<div class="block11">
        	<input type="text" class="input1" name="input31dop11" id="input31" placeholder="Название детали"/>
    		<span class="text1">Например Yuchai</span>
    	
        </div>
        <div class="block12">
        	<input type="text" class="input2" name="input32dop11" id="input32" placeholder="Описание детали"/>
    		<span class="text2">Например YCD4688R</span>
    	
        </div>
		
    </div>
    
    
    <div class="block2">
    	<div class="left">Прикрепить фото:</div>
        <div class="right" id="right">
             
            <style type="text/css">
            #right22 #mask-wrapper1detail{
			display:block;
			}            
            </style>
            
            
            <div id="right22">
            
            
            
            <div class="mask-wrapper" id="mask-wrapper1detail">
   				<div class="mask" id="mask1detail">
      				<input class="fileInputText" id="fileInputText1detail" type="text" disabled>
      				<button class="send-file" id="send-file1detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input1detail" type="file" name="file_detaldop11[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper2detail">
   				<div class="mask" id="mask2detail">
      				<input class="fileInputText" id="fileInputText2detail" type="text" disabled>
      				<button class="send-file" id="send-file2detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input2detail" type="file" name="file_detaldop11[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper3detail">
   				<div class="mask" id="mask3detail">
      				<input class="fileInputText" id="fileInputText3detail" type="text" disabled>
      				<button class="send-file" id="send-file3detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input3detail" type="file" name="file_detaldop11[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper4detail">
   				<div class="mask" id="mask4detail">
      				<input class="fileInputText" id="fileInputText4detail" type="text" disabled>
      				<button class="send-file" id="send-file4detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input4detail" type="file" name="file_detaldop11[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper5detail">
   				<div class="mask" id="mask5detail">
      				<input class="fileInputText" id="fileInputText5detail" type="text" disabled>
      				<button class="send-file" id="send-file5detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input5detail" type="file" name="file_detaldop11[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper6detail">
   				<div class="mask" id="mask6detail">
      				<input class="fileInputText" id="fileInputText6detail" type="text" disabled>
      				<button class="send-file" id="send-file6detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input6detail" type="file" name="file_detaldop11[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper7detail">
   				<div class="mask" id="mask7detail">
      				<input class="fileInputText" id="fileInputText7detail" type="text" disabled>
      				<button class="send-file" id="send-file7detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input7detail" type="file" name="file_detaldop11[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper8detail">
   				<div class="mask" id="mask8detail">
      				<input class="fileInputText" id="fileInputText8detail" type="text" disabled>
      				<button class="send-file" id="send-file8detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input8detail" type="file" name="file_detaldop11[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper9detail">
   				<div class="mask" id="mask9detail">
      				<input class="fileInputText" id="fileInputText9detail" type="text" disabled>
      				<button class="send-file" id="send-file9detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input9detail" type="file" name="file_detaldop11[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper10detail">
   				<div class="mask" id="mask10detail">
      				<input class="fileInputText" id="fileInputText10detail" type="text" disabled>
      				<button class="send-file" id="send-file10detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input10detail" type="file" name="file_detaldop11[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper11detail">
   				<div class="mask" id="mask11detail">
      				<input class="fileInputText" id="fileInputText11detail" type="text" disabled>
      				<button class="send-file" id="send-file11detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input11detail" type="file" name="file_detaldop11[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper12detail">
   				<div class="mask" id="mask12detail">
      				<input class="fileInputText" id="fileInputText12detail" type="text" disabled>
      				<button class="send-file" id="send-file12detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input12detail" type="file" name="file_detaldop11[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper13detail">
   				<div class="mask" id="mask13detail">
      				<input class="fileInputText" id="fileInputText13detail" type="text" disabled>
      				<button class="send-file" id="send-file13detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input13detail" type="file" name="file_detaldop11[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper14detail">
   				<div class="mask" id="mask14detail">
      				<input class="fileInputText" id="fileInputText14detail" type="text" disabled>
      				<button class="send-file" id="send-file14detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input14detail" type="file" name="file_detaldop11[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper15detail">
   				<div class="mask" id="mask15detail">
      				<input class="fileInputText" id="fileInputText15detail" type="text" disabled>
      				<button class="send-file" id="send-file15detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input15detail" type="file" name="file_detaldop11[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper16detail">
   				<div class="mask" id="mask16detail">
      				<input class="fileInputText" id="fileInputText16detail" type="text" disabled>
      				<button class="send-file" id="send-file16detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input16detail" type="file" name="file_detaldop11[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper17detail">
   				<div class="mask" id="mask17detail">
      				<input class="fileInputText" id="fileInputText17detail" type="text" disabled>
      				<button class="send-file" id="send-file17detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input17detail" type="file" name="file_detaldop11[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper18detail">
   				<div class="mask" id="mask18detail">
      				<input class="fileInputText" id="fileInputText18detail" type="text" disabled>
      				<button class="send-file" id="send-file18detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input18detail" type="file" name="file_detaldop11[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper19detail">
   				<div class="mask" id="mask19detail">
      				<input class="fileInputText" id="fileInputText19detail" type="text" disabled>
      				<button class="send-file" id="send-file19detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input19detail" type="file" name="file_detaldop11[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper20detail">
   				<div class="mask" id="mask20detail">
      				<input class="fileInputText" id="fileInputText20detail" type="text" disabled>
      				<button class="send-file" id="send-file20detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input20detail" type="file" name="file_detaldop11[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper21detail">
   				<div class="mask" id="mask21detail">
      				<input class="fileInputText" id="fileInputText21detail" type="text" disabled>
      				<button class="send-file" id="send-file21detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input21detail" type="file" name="file_detaldop11[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper22detail">
   				<div class="mask" id="mask22detail">
      				<input class="fileInputText" id="fileInputText22detail" type="text" disabled>
      				<button class="send-file" id="send-file22detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input22detail" type="file" name="file_detaldop11[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper23detail">
   				<div class="mask" id="mask23detail">
      				<input class="fileInputText" id="fileInputText23detail" type="text" disabled>
      				<button class="send-file" id="send-file23detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input23detail" type="file" name="file_detaldop11[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper24detail">
   				<div class="mask" id="mask24detail">
      				<input class="fileInputText" id="fileInputText24detail" type="text" disabled>
      				<button class="send-file" id="send-file24detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input24detail" type="file" name="file_detaldop11[]">
			</div>
            
            
			
            </div>
            
            
            <style type="text/css">
            .mask-wrapper {
   				height: 50px;
   				margin-bottom:20px;
				
			}
			.mask-wrapper .send-file {
   				padding: 3px 20px;
   				margin-left: 3px;
   				color: #fff;
   				background-color: #ccc;
			}
			.mask-wrapper .fileInputText {
   				position: relative;
   				width: 133px;
   				top: 3px;
			}
			.custom-file-input {
   				width: 100% !important;
  height: 50px;
   				opacity: 0;
   				filter: alpha(opacity=0);
   				position: relative;
   				top: -52px;
   				left: -16px;
   				z-index: 99999;
   				cursor: pointer;
			}
            </style>
            <input type="button" value="Добавить ещё" class="INeedMore" id="INeedMore2"/>
            <span class="note1">Фото именной таблички техники (фотографии должны быть чёткими, маркировки должны быть читабельными) </span>
        
        
        </div>
        
        
        
    
    </div>
    
    <div class="block3">
    	<span class="note2" onClick="f_show2dop11()">Добавить информацию</span>
	</div>
    
    
    <div id="f2dop11" name="f2" class="f">
   		<textarea name="textareaf2dop11" placeholder="Дополнительная информация"></textarea>
    
	</div>
    
    <div style="width:100%; height:3px;  margin-bottom:15px;" class="dotted_line"></div>
    
    
    </div>
    <!----=======================================================================----->
    
    
    <div class="dop12">
    <div class="block1">
    	<div class="block11">
        	<input type="text" class="input1" name="input31dop12" id="input31" placeholder="Название детали"/>
    		<span class="text1">Например Yuchai</span>
    	
        </div>
        <div class="block12">
        	<input type="text" class="input2" name="input32dop12" id="input32" placeholder="Описание детали"/>
    		<span class="text2">Например YCD4688R</span>
    	
        </div>
		
    </div>
    
    
    <div class="block2">
    	<div class="left">Прикрепить фото:</div>
        <div class="right" id="right">
        	 
            <style type="text/css">
            #right22 #mask-wrapper1detail{
			display:block;
			}            
            </style>
            
            
            <div id="right22">
            
            
            
            <div class="mask-wrapper" id="mask-wrapper1detail">
   				<div class="mask" id="mask1detail">
      				<input class="fileInputText" id="fileInputText1detail" type="text" disabled>
      				<button class="send-file" id="send-file1detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input1detail" type="file" name="file_detaldop12[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper2detail">
   				<div class="mask" id="mask2detail">
      				<input class="fileInputText" id="fileInputText2detail" type="text" disabled>
      				<button class="send-file" id="send-file2detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input2detail" type="file" name="file_detaldop12[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper3detail">
   				<div class="mask" id="mask3detail">
      				<input class="fileInputText" id="fileInputText3detail" type="text" disabled>
      				<button class="send-file" id="send-file3detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input3detail" type="file" name="file_detaldop12[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper4detail">
   				<div class="mask" id="mask4detail">
      				<input class="fileInputText" id="fileInputText4detail" type="text" disabled>
      				<button class="send-file" id="send-file4detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input4detail" type="file" name="file_detaldop12[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper5detail">
   				<div class="mask" id="mask5detail">
      				<input class="fileInputText" id="fileInputText5detail" type="text" disabled>
      				<button class="send-file" id="send-file5detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input5detail" type="file" name="file_detaldop12[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper6detail">
   				<div class="mask" id="mask6detail">
      				<input class="fileInputText" id="fileInputText6detail" type="text" disabled>
      				<button class="send-file" id="send-file6detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input6detail" type="file" name="file_detaldop12[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper7detail">
   				<div class="mask" id="mask7detail">
      				<input class="fileInputText" id="fileInputText7detail" type="text" disabled>
      				<button class="send-file" id="send-file7detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input7detail" type="file" name="file_detaldop12[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper8detail">
   				<div class="mask" id="mask8detail">
      				<input class="fileInputText" id="fileInputText8detail" type="text" disabled>
      				<button class="send-file" id="send-file8detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input8detail" type="file" name="file_detaldop12[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper9detail">
   				<div class="mask" id="mask9detail">
      				<input class="fileInputText" id="fileInputText9detail" type="text" disabled>
      				<button class="send-file" id="send-file9detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input9detail" type="file" name="file_detaldop12[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper10detail">
   				<div class="mask" id="mask10detail">
      				<input class="fileInputText" id="fileInputText10detail" type="text" disabled>
      				<button class="send-file" id="send-file10detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input10detail" type="file" name="file_detaldop12[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper11detail">
   				<div class="mask" id="mask11detail">
      				<input class="fileInputText" id="fileInputText11detail" type="text" disabled>
      				<button class="send-file" id="send-file11detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input11detail" type="file" name="file_detaldop12[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper12detail">
   				<div class="mask" id="mask12detail">
      				<input class="fileInputText" id="fileInputText12detail" type="text" disabled>
      				<button class="send-file" id="send-file12detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input12detail" type="file" name="file_detaldop12[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper13detail">
   				<div class="mask" id="mask13detail">
      				<input class="fileInputText" id="fileInputText13detail" type="text" disabled>
      				<button class="send-file" id="send-file13detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input13detail" type="file" name="file_detaldop12[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper14detail">
   				<div class="mask" id="mask14detail">
      				<input class="fileInputText" id="fileInputText14detail" type="text" disabled>
      				<button class="send-file" id="send-file14detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input14detail" type="file" name="file_detaldop12[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper15detail">
   				<div class="mask" id="mask15detail">
      				<input class="fileInputText" id="fileInputText15detail" type="text" disabled>
      				<button class="send-file" id="send-file15detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input15detail" type="file" name="file_detaldop12[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper16detail">
   				<div class="mask" id="mask16detail">
      				<input class="fileInputText" id="fileInputText16detail" type="text" disabled>
      				<button class="send-file" id="send-file16detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input16detail" type="file" name="file_detaldop12[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper17detail">
   				<div class="mask" id="mask17detail">
      				<input class="fileInputText" id="fileInputText17detail" type="text" disabled>
      				<button class="send-file" id="send-file17detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input17detail" type="file" name="file_detaldop12[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper18detail">
   				<div class="mask" id="mask18detail">
      				<input class="fileInputText" id="fileInputText18detail" type="text" disabled>
      				<button class="send-file" id="send-file18detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input18detail" type="file" name="file_detaldop12[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper19detail">
   				<div class="mask" id="mask19detail">
      				<input class="fileInputText" id="fileInputText19detail" type="text" disabled>
      				<button class="send-file" id="send-file19detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input19detail" type="file" name="file_detaldop12[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper20detail">
   				<div class="mask" id="mask20detail">
      				<input class="fileInputText" id="fileInputText20detail" type="text" disabled>
      				<button class="send-file" id="send-file20detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input20detail" type="file" name="file_detaldop12[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper21detail">
   				<div class="mask" id="mask21detail">
      				<input class="fileInputText" id="fileInputText21detail" type="text" disabled>
      				<button class="send-file" id="send-file21detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input21detail" type="file" name="file_detaldop12[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper22detail">
   				<div class="mask" id="mask22detail">
      				<input class="fileInputText" id="fileInputText22detail" type="text" disabled>
      				<button class="send-file" id="send-file22detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input22detail" type="file" name="file_detaldop12[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper23detail">
   				<div class="mask" id="mask23detail">
      				<input class="fileInputText" id="fileInputText23detail" type="text" disabled>
      				<button class="send-file" id="send-file23detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input23detail" type="file" name="file_detaldop12[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper24detail">
   				<div class="mask" id="mask24detail">
      				<input class="fileInputText" id="fileInputText24detail" type="text" disabled>
      				<button class="send-file" id="send-file24detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input24detail" type="file" name="file_detaldop12[]">
			</div>
            
            
			
            </div>
            
            
            <style type="text/css">
            .mask-wrapper {
   				height: 50px;
   				margin-bottom:20px;
				
			}
			.mask-wrapper .send-file {
   				padding: 3px 20px;
   				margin-left: 3px;
   				color: #fff;
   				background-color: #ccc;
			}
			.mask-wrapper .fileInputText {
   				position: relative;
   				width: 133px;
   				top: 3px;
			}
			.custom-file-input {
   				width: 100% !important;
  height: 50px;
   				opacity: 0;
   				filter: alpha(opacity=0);
   				position: relative;
   				top: -52px;
   				left: -16px;
   				z-index: 99999;
   				cursor: pointer;
			}
            </style>
            <input type="button" value="Добавить ещё" class="INeedMore" id="INeedMore2"/>
            <span class="note1">Фото именной таблички техники (фотографии должны быть чёткими, маркировки должны быть читабельными) </span>
        
        
        </div>
        
        
        
    
    </div>
    
    <div class="block3">
    	<span class="note2" onClick="f_show2dop12()">Добавить информацию</span>
	</div>
    
    
    <div id="f2dop12" name="f2" class="f">
   		<textarea name="textareaf2dop12" placeholder="Дополнительная информация"></textarea>
    
	</div>
    
    <div style="width:100%; height:3px;  margin-bottom:15px;" class="dotted_line"></div>
    
    
    </div>
    <!----=======================================================================----->
    
    <div class="dop13">
    <div class="block1">
    	<div class="block11">
        	<input type="text" class="input1" name="input31dop13" id="input31" placeholder="Название детали"/>
    		<span class="text1">Например Yuchai</span>
    	
        </div>
        <div class="block12">
        	<input type="text" class="input2" name="input32dop13" id="input32" placeholder="Описание детали"/>
    		<span class="text2">Например YCD4688R</span>
    	
        </div>
		
    </div>
    
    
    <div class="block2">
    	<div class="left">Прикрепить фото:</div>
        <div class="right" id="right">
            
            <style type="text/css">
            #right22 #mask-wrapper1detail{
			display:block;
			}            
            </style>
            
            
            <div id="right22">
            
            
            
            <div class="mask-wrapper" id="mask-wrapper1detail">
   				<div class="mask" id="mask1detail">
      				<input class="fileInputText" id="fileInputText1detail" type="text" disabled>
      				<button class="send-file" id="send-file1detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input1detail" type="file" name="file_detaldop13[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper2detail">
   				<div class="mask" id="mask2detail">
      				<input class="fileInputText" id="fileInputText2detail" type="text" disabled>
      				<button class="send-file" id="send-file2detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input2detail" type="file" name="file_detaldop13[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper3detail">
   				<div class="mask" id="mask3detail">
      				<input class="fileInputText" id="fileInputText3detail" type="text" disabled>
      				<button class="send-file" id="send-file3detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input3detail" type="file" name="file_detaldop13[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper4detail">
   				<div class="mask" id="mask4detail">
      				<input class="fileInputText" id="fileInputText4detail" type="text" disabled>
      				<button class="send-file" id="send-file4detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input4detail" type="file" name="file_detaldop13[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper5detail">
   				<div class="mask" id="mask5detail">
      				<input class="fileInputText" id="fileInputText5detail" type="text" disabled>
      				<button class="send-file" id="send-file5detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input5detail" type="file" name="file_detaldop13[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper6detail">
   				<div class="mask" id="mask6detail">
      				<input class="fileInputText" id="fileInputText6detail" type="text" disabled>
      				<button class="send-file" id="send-file6detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input6detail" type="file" name="file_detaldop13[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper7detail">
   				<div class="mask" id="mask7detail">
      				<input class="fileInputText" id="fileInputText7detail" type="text" disabled>
      				<button class="send-file" id="send-file7detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input7detail" type="file" name="file_detaldop13[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper8detail">
   				<div class="mask" id="mask8detail">
      				<input class="fileInputText" id="fileInputText8detail" type="text" disabled>
      				<button class="send-file" id="send-file8detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input8detail" type="file" name="file_detaldop13[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper9detail">
   				<div class="mask" id="mask9detail">
      				<input class="fileInputText" id="fileInputText9detail" type="text" disabled>
      				<button class="send-file" id="send-file9detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input9detail" type="file" name="file_detaldop13[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper10detail">
   				<div class="mask" id="mask10detail">
      				<input class="fileInputText" id="fileInputText10detail" type="text" disabled>
      				<button class="send-file" id="send-file10detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input10detail" type="file" name="file_detaldop13[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper11detail">
   				<div class="mask" id="mask11detail">
      				<input class="fileInputText" id="fileInputText11detail" type="text" disabled>
      				<button class="send-file" id="send-file11detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input11detail" type="file" name="file_detaldop13[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper12detail">
   				<div class="mask" id="mask12detail">
      				<input class="fileInputText" id="fileInputText12detail" type="text" disabled>
      				<button class="send-file" id="send-file12detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input12detail" type="file" name="file_detaldop13[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper13detail">
   				<div class="mask" id="mask13detail">
      				<input class="fileInputText" id="fileInputText13detail" type="text" disabled>
      				<button class="send-file" id="send-file13detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input13detail" type="file" name="file_detaldop13[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper14detail">
   				<div class="mask" id="mask14detail">
      				<input class="fileInputText" id="fileInputText14detail" type="text" disabled>
      				<button class="send-file" id="send-file14detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input14detail" type="file" name="file_detaldop13[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper15detail">
   				<div class="mask" id="mask15detail">
      				<input class="fileInputText" id="fileInputText15detail" type="text" disabled>
      				<button class="send-file" id="send-file15detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input15detail" type="file" name="file_detaldop13[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper16detail">
   				<div class="mask" id="mask16detail">
      				<input class="fileInputText" id="fileInputText16detail" type="text" disabled>
      				<button class="send-file" id="send-file16detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input16detail" type="file" name="file_detaldop13[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper17detail">
   				<div class="mask" id="mask17detail">
      				<input class="fileInputText" id="fileInputText17detail" type="text" disabled>
      				<button class="send-file" id="send-file17detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input17detail" type="file" name="file_detaldop13[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper18detail">
   				<div class="mask" id="mask18detail">
      				<input class="fileInputText" id="fileInputText18detail" type="text" disabled>
      				<button class="send-file" id="send-file18detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input18detail" type="file" name="file_detaldop13[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper19detail">
   				<div class="mask" id="mask19detail">
      				<input class="fileInputText" id="fileInputText19detail" type="text" disabled>
      				<button class="send-file" id="send-file19detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input19detail" type="file" name="file_detaldop13[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper20detail">
   				<div class="mask" id="mask20detail">
      				<input class="fileInputText" id="fileInputText20detail" type="text" disabled>
      				<button class="send-file" id="send-file20detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input20detail" type="file" name="file_detaldop13[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper21detail">
   				<div class="mask" id="mask21detail">
      				<input class="fileInputText" id="fileInputText21detail" type="text" disabled>
      				<button class="send-file" id="send-file21detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input21detail" type="file" name="file_detaldop13[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper22detail">
   				<div class="mask" id="mask22detail">
      				<input class="fileInputText" id="fileInputText22detail" type="text" disabled>
      				<button class="send-file" id="send-file22detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input22detail" type="file" name="file_detaldop13[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper23detail">
   				<div class="mask" id="mask23detail">
      				<input class="fileInputText" id="fileInputText23detail" type="text" disabled>
      				<button class="send-file" id="send-file23detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input23detail" type="file" name="file_detaldop13[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper24detail">
   				<div class="mask" id="mask24detail">
      				<input class="fileInputText" id="fileInputText24detail" type="text" disabled>
      				<button class="send-file" id="send-file24detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input24detail" type="file" name="file_detaldop13[]">
			</div>
            
            
			
            </div>
            
            
            <style type="text/css">
            .mask-wrapper {
   				height: 50px;
   				margin-bottom:20px;
				
			}
			.mask-wrapper .send-file {
   				padding: 3px 20px;
   				margin-left: 3px;
   				color: #fff;
   				background-color: #ccc;
			}
			.mask-wrapper .fileInputText {
   				position: relative;
   				width: 133px;
   				top: 3px;
			}
			.custom-file-input {
   				width: 100% !important;
  height: 50px;
   				opacity: 0;
   				filter: alpha(opacity=0);
   				position: relative;
   				top: -52px;
   				left: -16px;
   				z-index: 99999;
   				cursor: pointer;
			}
            </style>
            <input type="button" value="Добавить ещё" class="INeedMore" id="INeedMore2"/>
            <span class="note1">Фото именной таблички техники (фотографии должны быть чёткими, маркировки должны быть читабельными) </span>
        
        
        </div>
        
        
        
    
    </div>
    
    <div class="block3">
    	<span class="note2" onClick="f_show2dop13()">Добавить информацию</span>
	</div>
    
    
    <div id="f2dop13" name="f2" class="f">
   		<textarea name="textareaf2dop13" placeholder="Дополнительная информация"></textarea>
    
	</div>
    
    <div style="width:100%; height:3px;  margin-bottom:15px;" class="dotted_line"></div>
    
    
    </div>
    <!----=======================================================================----->
    
    <div class="dop14">
    <div class="block1">
    	<div class="block11">
        	<input type="text" class="input1" name="input31dop14" id="input31" placeholder="Название детали"/>
    		<span class="text1">Например Yuchai</span>
    	
        </div>
        <div class="block12">
        	<input type="text" class="input2" name="input32dop14" id="input32" placeholder="Описание детали"/>
    		<span class="text2">Например YCD4688R</span>
    	
        </div>
		
    </div>
    
    
    <div class="block2">
    	<div class="left">Прикрепить фото:</div>
        <div class="right" id="right">
           
            <style type="text/css">
            #right22 #mask-wrapper1detail{
			display:block;
			}            
            </style>
            
            
            <div id="right22">
            
            
            
            <div class="mask-wrapper" id="mask-wrapper1detail">
   				<div class="mask" id="mask1detail">
      				<input class="fileInputText" id="fileInputText1detail" type="text" disabled>
      				<button class="send-file" id="send-file1detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input1detail" type="file" name="file_detaldop14[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper2detail">
   				<div class="mask" id="mask2detail">
      				<input class="fileInputText" id="fileInputText2detail" type="text" disabled>
      				<button class="send-file" id="send-file2detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input2detail" type="file" name="file_detaldop14[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper3detail">
   				<div class="mask" id="mask3detail">
      				<input class="fileInputText" id="fileInputText3detail" type="text" disabled>
      				<button class="send-file" id="send-file3detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input3detail" type="file" name="file_detaldop14[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper4detail">
   				<div class="mask" id="mask4detail">
      				<input class="fileInputText" id="fileInputText4detail" type="text" disabled>
      				<button class="send-file" id="send-file4detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input4detail" type="file" name="file_detaldop14[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper5detail">
   				<div class="mask" id="mask5detail">
      				<input class="fileInputText" id="fileInputText5detail" type="text" disabled>
      				<button class="send-file" id="send-file5detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input5detail" type="file" name="file_detaldop14[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper6detail">
   				<div class="mask" id="mask6detail">
      				<input class="fileInputText" id="fileInputText6detail" type="text" disabled>
      				<button class="send-file" id="send-file6detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input6detail" type="file" name="file_detaldop14[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper7detail">
   				<div class="mask" id="mask7detail">
      				<input class="fileInputText" id="fileInputText7detail" type="text" disabled>
      				<button class="send-file" id="send-file7detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input7detail" type="file" name="file_detaldop14[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper8detail">
   				<div class="mask" id="mask8detail">
      				<input class="fileInputText" id="fileInputText8detail" type="text" disabled>
      				<button class="send-file" id="send-file8detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input8detail" type="file" name="file_detaldop14[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper9detail">
   				<div class="mask" id="mask9detail">
      				<input class="fileInputText" id="fileInputText9detail" type="text" disabled>
      				<button class="send-file" id="send-file9detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input9detail" type="file" name="file_detaldop14[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper10detail">
   				<div class="mask" id="mask10detail">
      				<input class="fileInputText" id="fileInputText10detail" type="text" disabled>
      				<button class="send-file" id="send-file10detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input10detail" type="file" name="file_detaldop14[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper11detail">
   				<div class="mask" id="mask11detail">
      				<input class="fileInputText" id="fileInputText11detail" type="text" disabled>
      				<button class="send-file" id="send-file11detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input11detail" type="file" name="file_detaldop14[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper12detail">
   				<div class="mask" id="mask12detail">
      				<input class="fileInputText" id="fileInputText12detail" type="text" disabled>
      				<button class="send-file" id="send-file12detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input12detail" type="file" name="file_detaldop14[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper13detail">
   				<div class="mask" id="mask13detail">
      				<input class="fileInputText" id="fileInputText13detail" type="text" disabled>
      				<button class="send-file" id="send-file13detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input13detail" type="file" name="file_detaldop14[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper14detail">
   				<div class="mask" id="mask14detail">
      				<input class="fileInputText" id="fileInputText14detail" type="text" disabled>
      				<button class="send-file" id="send-file14detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input14detail" type="file" name="file_detaldop14[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper15detail">
   				<div class="mask" id="mask15detail">
      				<input class="fileInputText" id="fileInputText15detail" type="text" disabled>
      				<button class="send-file" id="send-file15detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input15detail" type="file" name="file_detaldop14[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper16detail">
   				<div class="mask" id="mask16detail">
      				<input class="fileInputText" id="fileInputText16detail" type="text" disabled>
      				<button class="send-file" id="send-file16detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input16detail" type="file" name="file_detaldop14[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper17detail">
   				<div class="mask" id="mask17detail">
      				<input class="fileInputText" id="fileInputText17detail" type="text" disabled>
      				<button class="send-file" id="send-file17detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input17detail" type="file" name="file_detaldop14[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper18detail">
   				<div class="mask" id="mask18detail">
      				<input class="fileInputText" id="fileInputText18detail" type="text" disabled>
      				<button class="send-file" id="send-file18detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input18detail" type="file" name="file_detaldop14[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper19detail">
   				<div class="mask" id="mask19detail">
      				<input class="fileInputText" id="fileInputText19detail" type="text" disabled>
      				<button class="send-file" id="send-file19detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input19detail" type="file" name="file_detaldop14[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper20detail">
   				<div class="mask" id="mask20detail">
      				<input class="fileInputText" id="fileInputText20detail" type="text" disabled>
      				<button class="send-file" id="send-file20detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input20detail" type="file" name="file_detaldop14[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper21detail">
   				<div class="mask" id="mask21detail">
      				<input class="fileInputText" id="fileInputText21detail" type="text" disabled>
      				<button class="send-file" id="send-file21detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input21detail" type="file" name="file_detaldop14[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper22detail">
   				<div class="mask" id="mask22detail">
      				<input class="fileInputText" id="fileInputText22detail" type="text" disabled>
      				<button class="send-file" id="send-file22detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input22detail" type="file" name="file_detaldop14[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper23detail">
   				<div class="mask" id="mask23detail">
      				<input class="fileInputText" id="fileInputText23detail" type="text" disabled>
      				<button class="send-file" id="send-file23detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input23detail" type="file" name="file_detaldop14[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper24detail">
   				<div class="mask" id="mask24detail">
      				<input class="fileInputText" id="fileInputText24detail" type="text" disabled>
      				<button class="send-file" id="send-file24detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input24detail" type="file" name="file_detaldop14[]">
			</div>
            
            
			
            </div>
            
            
            <style type="text/css">
            .mask-wrapper {
   				height: 50px;
   				margin-bottom:20px;
				
			}
			.mask-wrapper .send-file {
   				padding: 3px 20px;
   				margin-left: 3px;
   				color: #fff;
   				background-color: #ccc;
			}
			.mask-wrapper .fileInputText {
   				position: relative;
   				width: 133px;
   				top: 3px;
			}
			.custom-file-input {
   				width: 100% !important;
  height: 50px;
   				opacity: 0;
   				filter: alpha(opacity=0);
   				position: relative;
   				top: -52px;
   				left: -16px;
   				z-index: 99999;
   				cursor: pointer;
			}
            </style>
            <input type="button" value="Добавить ещё" class="INeedMore" id="INeedMore2"/>
            <span class="note1">Фото именной таблички техники (фотографии должны быть чёткими, маркировки должны быть читабельными) </span>
        
        
        </div>
        
        
        
    
    </div>
    
    <div class="block3">
    	<span class="note2" onClick="f_show2dop14()">Добавить информацию</span>
	</div>
    
    
    <div id="f2dop14" name="f2" class="f">
   		<textarea name="textareaf2dop14" placeholder="Дополнительная информация"></textarea>
    
	</div>
    
    <div style="width:100%; height:3px;  margin-bottom:15px;" class="dotted_line"></div>
    
    
    </div>
    <!----=======================================================================----->
   
    <div class="dop15">
    <div class="block1">
    	<div class="block11">
        	<input type="text" class="input1" name="input31dop15" id="input31" placeholder="Название детали"/>
    		<span class="text1">Например Yuchai</span>
    	
        </div>
        <div class="block12">
        	<input type="text" class="input2" name="input32dop15" id="input32" placeholder="Описание детали"/>
    		<span class="text2">Например YCD4688R</span>
    	
        </div>
		
    </div>
    
    
    <div class="block2">
    	<div class="left">Прикрепить фото:</div>
        <div class="right" id="right">
       
            
            <style type="text/css">
            #right22 #mask-wrapper1detail{
			display:block;
			}            
            </style>
            
            
            <div id="right22">
            
            
            
            <div class="mask-wrapper" id="mask-wrapper1detail">
   				<div class="mask" id="mask1detail">
      				<input class="fileInputText" id="fileInputText1detail" type="text" disabled>
      				<button class="send-file" id="send-file1detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input1detail" type="file" name="file_detaldop15[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper2detail">
   				<div class="mask" id="mask2detail">
      				<input class="fileInputText" id="fileInputText2detail" type="text" disabled>
      				<button class="send-file" id="send-file2detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input2detail" type="file" name="file_detaldop15[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper3detail">
   				<div class="mask" id="mask3detail">
      				<input class="fileInputText" id="fileInputText3detail" type="text" disabled>
      				<button class="send-file" id="send-file3detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input3detail" type="file" name="file_detaldop15[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper4detail">
   				<div class="mask" id="mask4detail">
      				<input class="fileInputText" id="fileInputText4detail" type="text" disabled>
      				<button class="send-file" id="send-file4detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input4detail" type="file" name="file_detaldop15[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper5detail">
   				<div class="mask" id="mask5detail">
      				<input class="fileInputText" id="fileInputText5detail" type="text" disabled>
      				<button class="send-file" id="send-file5detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input5detail" type="file" name="file_detaldop15[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper6detail">
   				<div class="mask" id="mask6detail">
      				<input class="fileInputText" id="fileInputText6detail" type="text" disabled>
      				<button class="send-file" id="send-file6detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input6detail" type="file" name="file_detaldop15[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper7detail">
   				<div class="mask" id="mask7detail">
      				<input class="fileInputText" id="fileInputText7detail" type="text" disabled>
      				<button class="send-file" id="send-file7detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input7detail" type="file" name="file_detaldop15[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper8detail">
   				<div class="mask" id="mask8detail">
      				<input class="fileInputText" id="fileInputText8detail" type="text" disabled>
      				<button class="send-file" id="send-file8detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input8detail" type="file" name="file_detaldop15[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper9detail">
   				<div class="mask" id="mask9detail">
      				<input class="fileInputText" id="fileInputText9detail" type="text" disabled>
      				<button class="send-file" id="send-file9detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input9detail" type="file" name="file_detaldop15[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper10detail">
   				<div class="mask" id="mask10detail">
      				<input class="fileInputText" id="fileInputText10detail" type="text" disabled>
      				<button class="send-file" id="send-file10detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input10detail" type="file" name="file_detaldop15[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper11detail">
   				<div class="mask" id="mask11detail">
      				<input class="fileInputText" id="fileInputText11detail" type="text" disabled>
      				<button class="send-file" id="send-file11detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input11detail" type="file" name="file_detaldop15[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper12detail">
   				<div class="mask" id="mask12detail">
      				<input class="fileInputText" id="fileInputText12detail" type="text" disabled>
      				<button class="send-file" id="send-file12detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input12detail" type="file" name="file_detaldop15[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper13detail">
   				<div class="mask" id="mask13detail">
      				<input class="fileInputText" id="fileInputText13detail" type="text" disabled>
      				<button class="send-file" id="send-file13detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input13detail" type="file" name="file_detaldop15[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper14detail">
   				<div class="mask" id="mask14detail">
      				<input class="fileInputText" id="fileInputText14detail" type="text" disabled>
      				<button class="send-file" id="send-file14detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input14detail" type="file" name="file_detaldop15[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper15detail">
   				<div class="mask" id="mask15detail">
      				<input class="fileInputText" id="fileInputText15detail" type="text" disabled>
      				<button class="send-file" id="send-file15detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input15detail" type="file" name="file_detaldop15[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper16detail">
   				<div class="mask" id="mask16detail">
      				<input class="fileInputText" id="fileInputText16detail" type="text" disabled>
      				<button class="send-file" id="send-file16detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input16detail" type="file" name="file_detaldop15[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper17detail">
   				<div class="mask" id="mask17detail">
      				<input class="fileInputText" id="fileInputText17detail" type="text" disabled>
      				<button class="send-file" id="send-file17detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input17detail" type="file" name="file_detaldop15[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper18detail">
   				<div class="mask" id="mask18detail">
      				<input class="fileInputText" id="fileInputText18detail" type="text" disabled>
      				<button class="send-file" id="send-file18detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input18detail" type="file" name="file_detaldop15[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper19detail">
   				<div class="mask" id="mask19detail">
      				<input class="fileInputText" id="fileInputText19detail" type="text" disabled>
      				<button class="send-file" id="send-file19detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input19detail" type="file" name="file_detaldop15[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper20detail">
   				<div class="mask" id="mask20detail">
      				<input class="fileInputText" id="fileInputText20detail" type="text" disabled>
      				<button class="send-file" id="send-file20detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input20detail" type="file" name="file_detaldop15[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper21detail">
   				<div class="mask" id="mask21detail">
      				<input class="fileInputText" id="fileInputText21detail" type="text" disabled>
      				<button class="send-file" id="send-file21detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input21detail" type="file" name="file_detaldop15[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper22detail">
   				<div class="mask" id="mask22detail">
      				<input class="fileInputText" id="fileInputText22detail" type="text" disabled>
      				<button class="send-file" id="send-file22detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input22detail" type="file" name="file_detaldop15[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper23detail">
   				<div class="mask" id="mask23detail">
      				<input class="fileInputText" id="fileInputText23detail" type="text" disabled>
      				<button class="send-file" id="send-file23detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input23detail" type="file" name="file_detaldop15[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper24detail">
   				<div class="mask" id="mask24detail">
      				<input class="fileInputText" id="fileInputText24detail" type="text" disabled>
      				<button class="send-file" id="send-file24detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input24detail" type="file" name="file_detaldop15[]">
			</div>
            
            
			
            </div>
            
            
            <style type="text/css">
            .mask-wrapper {
   				height: 50px;
   				margin-bottom:20px;
				
			}
			.mask-wrapper .send-file {
   				padding: 3px 20px;
   				margin-left: 3px;
   				color: #fff;
   				background-color: #ccc;
			}
			.mask-wrapper .fileInputText {
   				position: relative;
   				width: 133px;
   				top: 3px;
			}
			.custom-file-input {
   				width: 100% !important;
  height: 50px;
   				opacity: 0;
   				filter: alpha(opacity=0);
   				position: relative;
   				top: -52px;
   				left: -16px;
   				z-index: 99999;
   				cursor: pointer;
			}
            </style>
            <input type="button" value="Добавить ещё" class="INeedMore" id="INeedMore2"/>
            <span class="note1">Фото именной таблички техники (фотографии должны быть чёткими, маркировки должны быть читабельными) </span>
        
        
        </div>
        
        
        
    
    </div>
    
    <div class="block3">
    	<span class="note2" onClick="f_show2dop15()">Добавить информацию</span>
	</div>
    
    
    <div id="f2dop15" name="f2" class="f">
   		<textarea name="textareaf2dop15" placeholder="Дополнительная информация"></textarea>
    
	</div>
    
    <div style="width:100%; height:3px;  margin-bottom:15px;" class="dotted_line"></div>
    
    
    </div>
    
    
    <!----=======================================================================----->
    <!--
    <div class="dop16">
    <div class="block1">
    	<div class="block11">
        	<input type="text" class="input1" name="input31dop16" id="input31" placeholder="Название детали"/>
    		<span class="text1">Например Yuchai</span>
    	
        </div>
        <div class="block12">
        	<input type="text" class="input2" name="input32dop16" id="input32" placeholder="Описание детали"/>
    		<span class="text2">Например YCD4688R</span>
    	
        </div>
		
    </div>
    
    
    <div class="block2">
    	<div class="left">Прикрепить фото:</div>
        <div class="right" id="right">
          
            <style type="text/css">
            #right22 #mask-wrapper1detail{
			display:block;
			}            
            </style>
            
            
            <div id="right22">
            
            
            
            <div class="mask-wrapper" id="mask-wrapper1detail">
   				<div class="mask" id="mask1detail">
      				<input class="fileInputText" id="fileInputText1detail" type="text" disabled>
      				<button class="send-file" id="send-file1detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input1detail" type="file" name="file_detaldop16[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper2detail">
   				<div class="mask" id="mask2detail">
      				<input class="fileInputText" id="fileInputText2detail" type="text" disabled>
      				<button class="send-file" id="send-file2detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input2detail" type="file" name="file_detaldop16[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper3detail">
   				<div class="mask" id="mask3detail">
      				<input class="fileInputText" id="fileInputText3detail" type="text" disabled>
      				<button class="send-file" id="send-file3detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input3detail" type="file" name="file_detaldop16[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper4detail">
   				<div class="mask" id="mask4detail">
      				<input class="fileInputText" id="fileInputText4detail" type="text" disabled>
      				<button class="send-file" id="send-file4detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input4detail" type="file" name="file_detaldop16[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper5detail">
   				<div class="mask" id="mask5detail">
      				<input class="fileInputText" id="fileInputText5detail" type="text" disabled>
      				<button class="send-file" id="send-file5detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input5detail" type="file" name="file_detaldop16[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper6detail">
   				<div class="mask" id="mask6detail">
      				<input class="fileInputText" id="fileInputText6detail" type="text" disabled>
      				<button class="send-file" id="send-file6detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input6detail" type="file" name="file_detaldop16[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper7detail">
   				<div class="mask" id="mask7detail">
      				<input class="fileInputText" id="fileInputText7detail" type="text" disabled>
      				<button class="send-file" id="send-file7detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input7detail" type="file" name="file_detaldop16[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper8detail">
   				<div class="mask" id="mask8detail">
      				<input class="fileInputText" id="fileInputText8detail" type="text" disabled>
      				<button class="send-file" id="send-file8detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input8detail" type="file" name="file_detaldop16[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper9detail">
   				<div class="mask" id="mask9detail">
      				<input class="fileInputText" id="fileInputText9detail" type="text" disabled>
      				<button class="send-file" id="send-file9detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input9detail" type="file" name="file_detaldop16[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper10detail">
   				<div class="mask" id="mask10detail">
      				<input class="fileInputText" id="fileInputText10detail" type="text" disabled>
      				<button class="send-file" id="send-file10detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input10detail" type="file" name="file_detaldop16[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper11detail">
   				<div class="mask" id="mask11detail">
      				<input class="fileInputText" id="fileInputText11detail" type="text" disabled>
      				<button class="send-file" id="send-file11detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input11detail" type="file" name="file_detaldop16[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper12detail">
   				<div class="mask" id="mask12detail">
      				<input class="fileInputText" id="fileInputText12detail" type="text" disabled>
      				<button class="send-file" id="send-file12detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input12detail" type="file" name="file_detaldop16[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper13detail">
   				<div class="mask" id="mask13detail">
      				<input class="fileInputText" id="fileInputText13detail" type="text" disabled>
      				<button class="send-file" id="send-file13detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input13detail" type="file" name="file_detaldop16[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper14detail">
   				<div class="mask" id="mask14detail">
      				<input class="fileInputText" id="fileInputText14detail" type="text" disabled>
      				<button class="send-file" id="send-file14detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input14detail" type="file" name="file_detaldop16[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper15detail">
   				<div class="mask" id="mask15detail">
      				<input class="fileInputText" id="fileInputText15detail" type="text" disabled>
      				<button class="send-file" id="send-file15detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input15detail" type="file" name="file_detaldop16[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper16detail">
   				<div class="mask" id="mask16detail">
      				<input class="fileInputText" id="fileInputText16detail" type="text" disabled>
      				<button class="send-file" id="send-file16detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input16detail" type="file" name="file_detaldop16[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper17detail">
   				<div class="mask" id="mask17detail">
      				<input class="fileInputText" id="fileInputText17detail" type="text" disabled>
      				<button class="send-file" id="send-file17detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input17detail" type="file" name="file_detaldop16[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper18detail">
   				<div class="mask" id="mask18detail">
      				<input class="fileInputText" id="fileInputText18detail" type="text" disabled>
      				<button class="send-file" id="send-file18detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input18detail" type="file" name="file_detaldop16[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper19detail">
   				<div class="mask" id="mask19detail">
      				<input class="fileInputText" id="fileInputText19detail" type="text" disabled>
      				<button class="send-file" id="send-file19detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input19detail" type="file" name="file_detaldop16[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper20detail">
   				<div class="mask" id="mask20detail">
      				<input class="fileInputText" id="fileInputText20detail" type="text" disabled>
      				<button class="send-file" id="send-file20detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input20detail" type="file" name="file_detaldop16[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper21detail">
   				<div class="mask" id="mask21detail">
      				<input class="fileInputText" id="fileInputText21detail" type="text" disabled>
      				<button class="send-file" id="send-file21detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input21detail" type="file" name="file_detaldop16[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper22detail">
   				<div class="mask" id="mask22detail">
      				<input class="fileInputText" id="fileInputText22detail" type="text" disabled>
      				<button class="send-file" id="send-file22detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input22detail" type="file" name="file_detaldop16[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper23detail">
   				<div class="mask" id="mask23detail">
      				<input class="fileInputText" id="fileInputText23detail" type="text" disabled>
      				<button class="send-file" id="send-file23detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input23detail" type="file" name="file_detaldop16[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper24detail">
   				<div class="mask" id="mask24detail">
      				<input class="fileInputText" id="fileInputText24detail" type="text" disabled>
      				<button class="send-file" id="send-file24detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input24detail" type="file" name="file_detaldop16[]">
			</div>
            
            
			
            </div>
            
            
            <style type="text/css">
            .mask-wrapper {
   				height: 50px;
   				margin-bottom:20px;
				
			}
			.mask-wrapper .send-file {
   				padding: 3px 20px;
   				margin-left: 3px;
   				color: #fff;
   				background-color: #ccc;
			}
			.mask-wrapper .fileInputText {
   				position: relative;
   				width: 133px;
   				top: 3px;
			}
			.custom-file-input {
   				width: 100% !important;
  height: 50px;
   				opacity: 0;
   				filter: alpha(opacity=0);
   				position: relative;
   				top: -52px;
   				left: -16px;
   				z-index: 99999;
   				cursor: pointer;
			}
            </style>
            <input type="button" value="Добавить ещё" class="INeedMore" id="INeedMore2"/>
            <span class="note1">Фото именной таблички техники (фотографии должны быть чёткими, маркировки должны быть читабельными) </span>
        
        
        </div>
        
        
        
    
    </div>
    
    <div class="block3">
    	<span class="note2" onClick="f_show2dop16()">Добавить информацию</span>
	</div>
    
    
    <div id="f2dop16" name="f2" class="f">
   		<textarea name="textareaf2dop16" placeholder="Дополнительная информация"></textarea>
    
	</div>
    
    <div style="width:100%; height:3px;  margin-bottom:15px;" class="dotted_line"></div>
    
    
    </div>-->
    <!----=======================================================================----->
    <!--
    <div class="dop17">
    <div class="block1">
    	<div class="block11">
        	<input type="text" class="input1" name="input31dop17" id="input31" placeholder="Название детали"/>
    		<span class="text1">Например Yuchai</span>
    	
        </div>
        <div class="block12">
        	<input type="text" class="input2" name="input32dop17" id="input32" placeholder="Описание детали"/>
    		<span class="text2">Например YCD4688R</span>
    	
        </div>
		
    </div>
    
    
    <div class="block2">
    	<div class="left">Прикрепить фото:</div>
        <div class="right" id="right">
            
            <style type="text/css">
            #right22 #mask-wrapper1detail{
			display:block;
			}            
            </style>
            
            
            <div id="right22">
            
            
            
            <div class="mask-wrapper" id="mask-wrapper1detail">
   				<div class="mask" id="mask1detail">
      				<input class="fileInputText" id="fileInputText1detail" type="text" disabled>
      				<button class="send-file" id="send-file1detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input1detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper2detail">
   				<div class="mask" id="mask2detail">
      				<input class="fileInputText" id="fileInputText2detail" type="text" disabled>
      				<button class="send-file" id="send-file2detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input2detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper3detail">
   				<div class="mask" id="mask3detail">
      				<input class="fileInputText" id="fileInputText3detail" type="text" disabled>
      				<button class="send-file" id="send-file3detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input3detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper4detail">
   				<div class="mask" id="mask4detail">
      				<input class="fileInputText" id="fileInputText4detail" type="text" disabled>
      				<button class="send-file" id="send-file4detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input4detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper5detail">
   				<div class="mask" id="mask5detail">
      				<input class="fileInputText" id="fileInputText5detail" type="text" disabled>
      				<button class="send-file" id="send-file5detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input5detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper6detail">
   				<div class="mask" id="mask6detail">
      				<input class="fileInputText" id="fileInputText6detail" type="text" disabled>
      				<button class="send-file" id="send-file6detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input6detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper7detail">
   				<div class="mask" id="mask7detail">
      				<input class="fileInputText" id="fileInputText7detail" type="text" disabled>
      				<button class="send-file" id="send-file7detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input7detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper8detail">
   				<div class="mask" id="mask8detail">
      				<input class="fileInputText" id="fileInputText8detail" type="text" disabled>
      				<button class="send-file" id="send-file8detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input8detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper9detail">
   				<div class="mask" id="mask9detail">
      				<input class="fileInputText" id="fileInputText9detail" type="text" disabled>
      				<button class="send-file" id="send-file9detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input9detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper10detail">
   				<div class="mask" id="mask10detail">
      				<input class="fileInputText" id="fileInputText10detail" type="text" disabled>
      				<button class="send-file" id="send-file10detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input10detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper11detail">
   				<div class="mask" id="mask11detail">
      				<input class="fileInputText" id="fileInputText11detail" type="text" disabled>
      				<button class="send-file" id="send-file11detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input11detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper12detail">
   				<div class="mask" id="mask12detail">
      				<input class="fileInputText" id="fileInputText12detail" type="text" disabled>
      				<button class="send-file" id="send-file12detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input12detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper13detail">
   				<div class="mask" id="mask13detail">
      				<input class="fileInputText" id="fileInputText13detail" type="text" disabled>
      				<button class="send-file" id="send-file13detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input13detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper14detail">
   				<div class="mask" id="mask14detail">
      				<input class="fileInputText" id="fileInputText14detail" type="text" disabled>
      				<button class="send-file" id="send-file14detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input14detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper15detail">
   				<div class="mask" id="mask15detail">
      				<input class="fileInputText" id="fileInputText15detail" type="text" disabled>
      				<button class="send-file" id="send-file15detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input15detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper16detail">
   				<div class="mask" id="mask16detail">
      				<input class="fileInputText" id="fileInputText16detail" type="text" disabled>
      				<button class="send-file" id="send-file16detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input16detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper17detail">
   				<div class="mask" id="mask17detail">
      				<input class="fileInputText" id="fileInputText17detail" type="text" disabled>
      				<button class="send-file" id="send-file17detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input17detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper18detail">
   				<div class="mask" id="mask18detail">
      				<input class="fileInputText" id="fileInputText18detail" type="text" disabled>
      				<button class="send-file" id="send-file18detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input18detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper19detail">
   				<div class="mask" id="mask19detail">
      				<input class="fileInputText" id="fileInputText19detail" type="text" disabled>
      				<button class="send-file" id="send-file19detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input19detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper20detail">
   				<div class="mask" id="mask20detail">
      				<input class="fileInputText" id="fileInputText20detail" type="text" disabled>
      				<button class="send-file" id="send-file20detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input20detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper21detail">
   				<div class="mask" id="mask21detail">
      				<input class="fileInputText" id="fileInputText21detail" type="text" disabled>
      				<button class="send-file" id="send-file21detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input21detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper22detail">
   				<div class="mask" id="mask22detail">
      				<input class="fileInputText" id="fileInputText22detail" type="text" disabled>
      				<button class="send-file" id="send-file22detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input22detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper23detail">
   				<div class="mask" id="mask23detail">
      				<input class="fileInputText" id="fileInputText23detail" type="text" disabled>
      				<button class="send-file" id="send-file23detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input23detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper24detail">
   				<div class="mask" id="mask24detail">
      				<input class="fileInputText" id="fileInputText24detail" type="text" disabled>
      				<button class="send-file" id="send-file24detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input24detail" type="file" name="file_detaldop17[]">
			</div>
            
            
			
            </div>
            
            
            <style type="text/css">
            .mask-wrapper {
   				height: 50px;
   				margin-bottom:20px;
				
			}
			.mask-wrapper .send-file {
   				padding: 3px 20px;
   				margin-left: 3px;
   				color: #fff;
   				background-color: #ccc;
			}
			.mask-wrapper .fileInputText {
   				position: relative;
   				width: 133px;
   				top: 3px;
			}
			.custom-file-input {
   				width: 100% !important;
  height: 50px;
   				opacity: 0;
   				filter: alpha(opacity=0);
   				position: relative;
   				top: -52px;
   				left: -16px;
   				z-index: 99999;
   				cursor: pointer;
			}
            </style>
            <input type="button" value="Добавить ещё" class="INeedMore" id="INeedMore2"/>
            <span class="note1">Фото именной таблички техники (фотографии должны быть чёткими, маркировки должны быть читабельными) </span>
        
        
        </div>
        
        
        
    
    </div>
    
    <div class="block3">
    	<span class="note2" onClick="f_show2dop17()">Добавить информацию</span>
	</div>
    
    
    <div id="f2dop17" name="f2" class="f">
   		<textarea name="textareaf2dop17" placeholder="Дополнительная информация"></textarea>
    
	</div>
    
    <div style="width:100%; height:3px;  margin-bottom:15px;" class="dotted_line"></div>
    
    
    </div>-->
    <!----=======================================================================----->
    <!--
    <div class="dop18">
    <div class="block1">
    	<div class="block11">
        	<input type="text" class="input1" name="input31dop17" id="input31" placeholder="Название детали"/>
    		<span class="text1">Например Yuchai</span>
    	
        </div>
        <div class="block12">
        	<input type="text" class="input2" name="input32dop17" id="input32" placeholder="Описание детали"/>
    		<span class="text2">Например YCD4688R</span>
    	
        </div>
		
    </div>
    
    
    <div class="block2">
    	<div class="left">Прикрепить фото:</div>
        <div class="right" id="right">
        	  
            <style type="text/css">
            #right22 #mask-wrapper1detail{
			display:block;
			}            
            </style>
            
            
            <div id="right22">
            
            
            
            <div class="mask-wrapper" id="mask-wrapper1detail">
   				<div class="mask" id="mask1detail">
      				<input class="fileInputText" id="fileInputText1detail" type="text" disabled>
      				<button class="send-file" id="send-file1detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input1detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper2detail">
   				<div class="mask" id="mask2detail">
      				<input class="fileInputText" id="fileInputText2detail" type="text" disabled>
      				<button class="send-file" id="send-file2detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input2detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper3detail">
   				<div class="mask" id="mask3detail">
      				<input class="fileInputText" id="fileInputText3detail" type="text" disabled>
      				<button class="send-file" id="send-file3detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input3detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper4detail">
   				<div class="mask" id="mask4detail">
      				<input class="fileInputText" id="fileInputText4detail" type="text" disabled>
      				<button class="send-file" id="send-file4detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input4detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper5detail">
   				<div class="mask" id="mask5detail">
      				<input class="fileInputText" id="fileInputText5detail" type="text" disabled>
      				<button class="send-file" id="send-file5detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input5detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper6detail">
   				<div class="mask" id="mask6detail">
      				<input class="fileInputText" id="fileInputText6detail" type="text" disabled>
      				<button class="send-file" id="send-file6detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input6detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper7detail">
   				<div class="mask" id="mask7detail">
      				<input class="fileInputText" id="fileInputText7detail" type="text" disabled>
      				<button class="send-file" id="send-file7detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input7detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper8detail">
   				<div class="mask" id="mask8detail">
      				<input class="fileInputText" id="fileInputText8detail" type="text" disabled>
      				<button class="send-file" id="send-file8detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input8detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper9detail">
   				<div class="mask" id="mask9detail">
      				<input class="fileInputText" id="fileInputText9detail" type="text" disabled>
      				<button class="send-file" id="send-file9detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input9detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper10detail">
   				<div class="mask" id="mask10detail">
      				<input class="fileInputText" id="fileInputText10detail" type="text" disabled>
      				<button class="send-file" id="send-file10detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input10detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper11detail">
   				<div class="mask" id="mask11detail">
      				<input class="fileInputText" id="fileInputText11detail" type="text" disabled>
      				<button class="send-file" id="send-file11detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input11detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper12detail">
   				<div class="mask" id="mask12detail">
      				<input class="fileInputText" id="fileInputText12detail" type="text" disabled>
      				<button class="send-file" id="send-file12detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input12detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper13detail">
   				<div class="mask" id="mask13detail">
      				<input class="fileInputText" id="fileInputText13detail" type="text" disabled>
      				<button class="send-file" id="send-file13detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input13detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper14detail">
   				<div class="mask" id="mask14detail">
      				<input class="fileInputText" id="fileInputText14detail" type="text" disabled>
      				<button class="send-file" id="send-file14detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input14detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper15detail">
   				<div class="mask" id="mask15detail">
      				<input class="fileInputText" id="fileInputText15detail" type="text" disabled>
      				<button class="send-file" id="send-file15detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input15detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper16detail">
   				<div class="mask" id="mask16detail">
      				<input class="fileInputText" id="fileInputText16detail" type="text" disabled>
      				<button class="send-file" id="send-file16detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input16detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper17detail">
   				<div class="mask" id="mask17detail">
      				<input class="fileInputText" id="fileInputText17detail" type="text" disabled>
      				<button class="send-file" id="send-file17detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input17detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper18detail">
   				<div class="mask" id="mask18detail">
      				<input class="fileInputText" id="fileInputText18detail" type="text" disabled>
      				<button class="send-file" id="send-file18detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input18detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper19detail">
   				<div class="mask" id="mask19detail">
      				<input class="fileInputText" id="fileInputText19detail" type="text" disabled>
      				<button class="send-file" id="send-file19detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input19detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper20detail">
   				<div class="mask" id="mask20detail">
      				<input class="fileInputText" id="fileInputText20detail" type="text" disabled>
      				<button class="send-file" id="send-file20detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input20detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper21detail">
   				<div class="mask" id="mask21detail">
      				<input class="fileInputText" id="fileInputText21detail" type="text" disabled>
      				<button class="send-file" id="send-file21detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input21detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper22detail">
   				<div class="mask" id="mask22detail">
      				<input class="fileInputText" id="fileInputText22detail" type="text" disabled>
      				<button class="send-file" id="send-file22detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input22detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper23detail">
   				<div class="mask" id="mask23detail">
      				<input class="fileInputText" id="fileInputText23detail" type="text" disabled>
      				<button class="send-file" id="send-file23detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input23detail" type="file" name="file_detaldop17[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper24detail">
   				<div class="mask" id="mask24detail">
      				<input class="fileInputText" id="fileInputText24detail" type="text" disabled>
      				<button class="send-file" id="send-file24detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input24detail" type="file" name="file_detaldop17[]">
			</div>
            
            
			
            </div>
            
            
            <style type="text/css">
            .mask-wrapper {
   				height: 50px;
   				margin-bottom:20px;
				
			}
			.mask-wrapper .send-file {
   				padding: 3px 20px;
   				margin-left: 3px;
   				color: #fff;
   				background-color: #ccc;
			}
			.mask-wrapper .fileInputText {
   				position: relative;
   				width: 133px;
   				top: 3px;
			}
			.custom-file-input {
   				width: 100% !important;
  height: 50px;
   				opacity: 0;
   				filter: alpha(opacity=0);
   				position: relative;
   				top: -52px;
   				left: -16px;
   				z-index: 99999;
   				cursor: pointer;
			}
            </style>
            <input type="button" value="Добавить ещё" class="INeedMore" id="INeedMore2"/>
            <span class="note1">Фото именной таблички техники (фотографии должны быть чёткими, маркировки должны быть читабельными) </span>
        
        
        </div>
        
        
        
    
    </div>
    
    <div class="block3">
    	<span class="note2" onClick="f_show2dop17()">Добавить информацию</span>
	</div>
    
    
    <div id="f2dop17" name="f2" class="f">
   		<textarea name="textareaf2dop17" placeholder="Дополнительная информация"></textarea>
    
	</div>
    
    <div style="width:100%; height:3px;  margin-bottom:15px;" class="dotted_line"></div>
    
    
    </div>-->
    <!----=======================================================================----->
    <!--
    <div class="dop18">
    <div class="block1">
    	<div class="block11">
        	<input type="text" class="input1" name="input31dop18" id="input31" placeholder="Название детали"/>
    		<span class="text1">Например Yuchai</span>
    	
        </div>
        <div class="block12">
        	<input type="text" class="input2" name="input32dop18" id="input32" placeholder="Описание детали"/>
    		<span class="text2">Например YCD4688R</span>
    	
        </div>
		
    </div>
    
    
    <div class="block2">
    	<div class="left">Прикрепить фото:</div>
        <div class="right" id="right">
        	  
            <style type="text/css">
            #right22 #mask-wrapper1detail{
			display:block;
			}            
            </style>
            
            
            <div id="right22">
            
            
            
            <div class="mask-wrapper" id="mask-wrapper1detail">
   				<div class="mask" id="mask1detail">
      				<input class="fileInputText" id="fileInputText1detail" type="text" disabled>
      				<button class="send-file" id="send-file1detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input1detail" type="file" name="file_detaldop18[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper2detail">
   				<div class="mask" id="mask2detail">
      				<input class="fileInputText" id="fileInputText2detail" type="text" disabled>
      				<button class="send-file" id="send-file2detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input2detail" type="file" name="file_detaldop18[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper3detail">
   				<div class="mask" id="mask3detail">
      				<input class="fileInputText" id="fileInputText3detail" type="text" disabled>
      				<button class="send-file" id="send-file3detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input3detail" type="file" name="file_detaldop18[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper4detail">
   				<div class="mask" id="mask4detail">
      				<input class="fileInputText" id="fileInputText4detail" type="text" disabled>
      				<button class="send-file" id="send-file4detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input4detail" type="file" name="file_detaldop18[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper5detail">
   				<div class="mask" id="mask5detail">
      				<input class="fileInputText" id="fileInputText5detail" type="text" disabled>
      				<button class="send-file" id="send-file5detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input5detail" type="file" name="file_detaldop18[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper6detail">
   				<div class="mask" id="mask6detail">
      				<input class="fileInputText" id="fileInputText6detail" type="text" disabled>
      				<button class="send-file" id="send-file6detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input6detail" type="file" name="file_detaldop18[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper7detail">
   				<div class="mask" id="mask7detail">
      				<input class="fileInputText" id="fileInputText7detail" type="text" disabled>
      				<button class="send-file" id="send-file7detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input7detail" type="file" name="file_detaldop18[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper8detail">
   				<div class="mask" id="mask8detail">
      				<input class="fileInputText" id="fileInputText8detail" type="text" disabled>
      				<button class="send-file" id="send-file8detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input8detail" type="file" name="file_detaldop18[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper9detail">
   				<div class="mask" id="mask9detail">
      				<input class="fileInputText" id="fileInputText9detail" type="text" disabled>
      				<button class="send-file" id="send-file9detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input9detail" type="file" name="file_detaldop18[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper10detail">
   				<div class="mask" id="mask10detail">
      				<input class="fileInputText" id="fileInputText10detail" type="text" disabled>
      				<button class="send-file" id="send-file10detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input10detail" type="file" name="file_detaldop18[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper11detail">
   				<div class="mask" id="mask11detail">
      				<input class="fileInputText" id="fileInputText11detail" type="text" disabled>
      				<button class="send-file" id="send-file11detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input11detail" type="file" name="file_detaldop18[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper12detail">
   				<div class="mask" id="mask12detail">
      				<input class="fileInputText" id="fileInputText12detail" type="text" disabled>
      				<button class="send-file" id="send-file12detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input12detail" type="file" name="file_detaldop18[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper13detail">
   				<div class="mask" id="mask13detail">
      				<input class="fileInputText" id="fileInputText13detail" type="text" disabled>
      				<button class="send-file" id="send-file13detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input13detail" type="file" name="file_detaldop18[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper14detail">
   				<div class="mask" id="mask14detail">
      				<input class="fileInputText" id="fileInputText14detail" type="text" disabled>
      				<button class="send-file" id="send-file14detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input14detail" type="file" name="file_detaldop18[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper15detail">
   				<div class="mask" id="mask15detail">
      				<input class="fileInputText" id="fileInputText15detail" type="text" disabled>
      				<button class="send-file" id="send-file15detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input15detail" type="file" name="file_detaldop18[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper16detail">
   				<div class="mask" id="mask16detail">
      				<input class="fileInputText" id="fileInputText16detail" type="text" disabled>
      				<button class="send-file" id="send-file16detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input16detail" type="file" name="file_detaldop18[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper17detail">
   				<div class="mask" id="mask17detail">
      				<input class="fileInputText" id="fileInputText17detail" type="text" disabled>
      				<button class="send-file" id="send-file17detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input17detail" type="file" name="file_detaldop18[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper18detail">
   				<div class="mask" id="mask18detail">
      				<input class="fileInputText" id="fileInputText18detail" type="text" disabled>
      				<button class="send-file" id="send-file18detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input18detail" type="file" name="file_detaldop18[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper19detail">
   				<div class="mask" id="mask19detail">
      				<input class="fileInputText" id="fileInputText19detail" type="text" disabled>
      				<button class="send-file" id="send-file19detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input19detail" type="file" name="file_detaldop18[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper20detail">
   				<div class="mask" id="mask20detail">
      				<input class="fileInputText" id="fileInputText20detail" type="text" disabled>
      				<button class="send-file" id="send-file20detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input20detail" type="file" name="file_detaldop18[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper21detail">
   				<div class="mask" id="mask21detail">
      				<input class="fileInputText" id="fileInputText21detail" type="text" disabled>
      				<button class="send-file" id="send-file21detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input21detail" type="file" name="file_detaldop18[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper22detail">
   				<div class="mask" id="mask22detail">
      				<input class="fileInputText" id="fileInputText22detail" type="text" disabled>
      				<button class="send-file" id="send-file22detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input22detail" type="file" name="file_detaldop18[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper23detail">
   				<div class="mask" id="mask23detail">
      				<input class="fileInputText" id="fileInputText23detail" type="text" disabled>
      				<button class="send-file" id="send-file23detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input23detail" type="file" name="file_detaldop18[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper24detail">
   				<div class="mask" id="mask24detail">
      				<input class="fileInputText" id="fileInputText24detail" type="text" disabled>
      				<button class="send-file" id="send-file24detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input24detail" type="file" name="file_detaldop18[]">
			</div>
            
            
			
            </div>
            
            
            <style type="text/css">
            .mask-wrapper {
   				height: 50px;
   				margin-bottom:20px;
				
			}
			.mask-wrapper .send-file {
   				padding: 3px 20px;
   				margin-left: 3px;
   				color: #fff;
   				background-color: #ccc;
			}
			.mask-wrapper .fileInputText {
   				position: relative;
   				width: 133px;
   				top: 3px;
			}
			.custom-file-input {
   				width: 100% !important;
  height: 50px;
   				opacity: 0;
   				filter: alpha(opacity=0);
   				position: relative;
   				top: -52px;
   				left: -16px;
   				z-index: 99999;
   				cursor: pointer;
			}
            </style>
            <input type="button" value="Добавить ещё" class="INeedMore" id="INeedMore2"/>
            <span class="note1">Фото именной таблички техники (фотографии должны быть чёткими, маркировки должны быть читабельными) </span>
        
        
        </div>
        
        
        
    
    </div>
    
    <div class="block3">
    	<span class="note2" onClick="f_show2dop18()">Добавить информацию</span>
	</div>
    
    
    <div id="f2dop18" name="f2" class="f">
   		<textarea name="textareaf2dop18" placeholder="Дополнительная информация"></textarea>
    
	</div>
    
    <div style="width:100%; height:3px;  margin-bottom:15px;" class="dotted_line"></div>
    
    
    </div>-->
    <!----=======================================================================----->
    
    <!--
    <div class="dop20">
    <div class="block1">
    	<div class="block11">
        	<input type="text" class="input1" name="input31dop20" id="input31" placeholder="Название детали"/>
    		<span class="text1">Например Yuchai</span>
    	
        </div>
        <div class="block12">
        	<input type="text" class="input2" name="input32dop20" id="input32" placeholder="Описание детали"/>
    		<span class="text2">Например YCD4688R</span>
    	
        </div>
		
    </div>
    
    
    <div class="block2">
    	<div class="left">Прикрепить фото:</div>
        <div class="right" id="right">
          
            <style type="text/css">
            #right22 #mask-wrapper1detail{
			display:block;
			}            
            </style>
            
            
            <div id="right22">
            
            
            
            <div class="mask-wrapper" id="mask-wrapper1detail">
   				<div class="mask" id="mask1detail">
      				<input class="fileInputText" id="fileInputText1detail" type="text" disabled>
      				<button class="send-file" id="send-file1detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input1detail" type="file" name="file_detaldop20[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper2detail">
   				<div class="mask" id="mask2detail">
      				<input class="fileInputText" id="fileInputText2detail" type="text" disabled>
      				<button class="send-file" id="send-file2detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input2detail" type="file" name="file_detaldop20[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper3detail">
   				<div class="mask" id="mask3detail">
      				<input class="fileInputText" id="fileInputText3detail" type="text" disabled>
      				<button class="send-file" id="send-file3detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input3detail" type="file" name="file_detaldop20[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper4detail">
   				<div class="mask" id="mask4detail">
      				<input class="fileInputText" id="fileInputText4detail" type="text" disabled>
      				<button class="send-file" id="send-file4detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input4detail" type="file" name="file_detaldop20[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper5detail">
   				<div class="mask" id="mask5detail">
      				<input class="fileInputText" id="fileInputText5detail" type="text" disabled>
      				<button class="send-file" id="send-file5detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input5detail" type="file" name="file_detaldop20[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper6detail">
   				<div class="mask" id="mask6detail">
      				<input class="fileInputText" id="fileInputText6detail" type="text" disabled>
      				<button class="send-file" id="send-file6detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input6detail" type="file" name="file_detaldop20[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper7detail">
   				<div class="mask" id="mask7detail">
      				<input class="fileInputText" id="fileInputText7detail" type="text" disabled>
      				<button class="send-file" id="send-file7detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input7detail" type="file" name="file_detaldop20[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper8detail">
   				<div class="mask" id="mask8detail">
      				<input class="fileInputText" id="fileInputText8detail" type="text" disabled>
      				<button class="send-file" id="send-file8detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input8detail" type="file" name="file_detaldop20[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper9detail">
   				<div class="mask" id="mask9detail">
      				<input class="fileInputText" id="fileInputText9detail" type="text" disabled>
      				<button class="send-file" id="send-file9detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input9detail" type="file" name="file_detaldop20[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper10detail">
   				<div class="mask" id="mask10detail">
      				<input class="fileInputText" id="fileInputText10detail" type="text" disabled>
      				<button class="send-file" id="send-file10detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input10detail" type="file" name="file_detaldop20[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper11detail">
   				<div class="mask" id="mask11detail">
      				<input class="fileInputText" id="fileInputText11detail" type="text" disabled>
      				<button class="send-file" id="send-file11detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input11detail" type="file" name="file_detaldop20[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper12detail">
   				<div class="mask" id="mask12detail">
      				<input class="fileInputText" id="fileInputText12detail" type="text" disabled>
      				<button class="send-file" id="send-file12detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input12detail" type="file" name="file_detaldop20[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper13detail">
   				<div class="mask" id="mask13detail">
      				<input class="fileInputText" id="fileInputText13detail" type="text" disabled>
      				<button class="send-file" id="send-file13detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input13detail" type="file" name="file_detaldop20[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper14detail">
   				<div class="mask" id="mask14detail">
      				<input class="fileInputText" id="fileInputText14detail" type="text" disabled>
      				<button class="send-file" id="send-file14detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input14detail" type="file" name="file_detaldop20[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper15detail">
   				<div class="mask" id="mask15detail">
      				<input class="fileInputText" id="fileInputText15detail" type="text" disabled>
      				<button class="send-file" id="send-file15detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input15detail" type="file" name="file_detaldop20[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper16detail">
   				<div class="mask" id="mask16detail">
      				<input class="fileInputText" id="fileInputText16detail" type="text" disabled>
      				<button class="send-file" id="send-file16detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input16detail" type="file" name="file_detaldop20[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper17detail">
   				<div class="mask" id="mask17detail">
      				<input class="fileInputText" id="fileInputText17detail" type="text" disabled>
      				<button class="send-file" id="send-file17detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input17detail" type="file" name="file_detaldop20[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper18detail">
   				<div class="mask" id="mask18detail">
      				<input class="fileInputText" id="fileInputText18detail" type="text" disabled>
      				<button class="send-file" id="send-file18detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input18detail" type="file" name="file_detaldop20[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper19detail">
   				<div class="mask" id="mask19detail">
      				<input class="fileInputText" id="fileInputText19detail" type="text" disabled>
      				<button class="send-file" id="send-file19detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input19detail" type="file" name="file_detaldop20[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper20detail">
   				<div class="mask" id="mask20detail">
      				<input class="fileInputText" id="fileInputText20detail" type="text" disabled>
      				<button class="send-file" id="send-file20detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input20detail" type="file" name="file_detaldop20[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper21detail">
   				<div class="mask" id="mask21detail">
      				<input class="fileInputText" id="fileInputText21detail" type="text" disabled>
      				<button class="send-file" id="send-file21detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input21detail" type="file" name="file_detaldop20[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper22detail">
   				<div class="mask" id="mask22detail">
      				<input class="fileInputText" id="fileInputText22detail" type="text" disabled>
      				<button class="send-file" id="send-file22detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input22detail" type="file" name="file_detaldop20[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper23detail">
   				<div class="mask" id="mask23detail">
      				<input class="fileInputText" id="fileInputText23detail" type="text" disabled>
      				<button class="send-file" id="send-file23detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input23detail" type="file" name="file_detaldop20[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper24detail">
   				<div class="mask" id="mask24detail">
      				<input class="fileInputText" id="fileInputText24detail" type="text" disabled>
      				<button class="send-file" id="send-file24detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input24detail" type="file" name="file_detaldop20[]">
			</div>
            
            
			
            </div>
            
            
            <style type="text/css">
            .mask-wrapper {
   				height: 50px;
   				margin-bottom:20px;
				
			}
			.mask-wrapper .send-file {
   				padding: 3px 20px;
   				margin-left: 3px;
   				color: #fff;
   				background-color: #ccc;
			}
			.mask-wrapper .fileInputText {
   				position: relative;
   				width: 133px;
   				top: 3px;
			}
			.custom-file-input {
   				width: 100% !important;
  height: 50px;
   				opacity: 0;
   				filter: alpha(opacity=0);
   				position: relative;
   				top: -52px;
   				left: -16px;
   				z-index: 99999;
   				cursor: pointer;
			}
            </style>
            <input type="button" value="Добавить ещё" class="INeedMore" id="INeedMore2"/>
            <span class="note1">Фото именной таблички техники (фотографии должны быть чёткими, маркировки должны быть читабельными) </span>
        
        
        </div>
        
        
        
    
    </div>
    
    <div class="block3">
    	<span class="note2" onClick="f_show2dop20()">Добавить информацию</span>
	</div>
    
    
    <div id="f2dop20" name="f2" class="f">
   		<textarea name="textareaf2dop20" placeholder="Дополнительная информация"></textarea>
    
	</div>
    
    <div style="width:100%; height:3px;  margin-bottom:15px;" class="dotted_line"></div>
    
    
    </div>-->
    <!----=======================================================================----->
    <!--
    <div class="dop21">
    <div class="block1">
    	<div class="block11">
        	<input type="text" class="input1" name="input31dop21" id="input31" placeholder="Название детали"/>
    		<span class="text1">Например Yuchai</span>
    	
        </div>
        <div class="block12">
        	<input type="text" class="input2" name="input32dop21" id="input32" placeholder="Описание детали"/>
    		<span class="text2">Например YCD4688R</span>
    	
        </div>
		
    </div>
    
    
    <div class="block2">
    	<div class="left">Прикрепить фото:</div>
        <div class="right" id="right">
           
            <style type="text/css">
            #right22 #mask-wrapper1detail{
			display:block;
			}            
            </style>
            
            
            <div id="right22">
            
            
            
            <div class="mask-wrapper" id="mask-wrapper1detail">
   				<div class="mask" id="mask1detail">
      				<input class="fileInputText" id="fileInputText1detail" type="text" disabled>
      				<button class="send-file" id="send-file1detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input1detail" type="file" name="file_detaldop21[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper2detail">
   				<div class="mask" id="mask2detail">
      				<input class="fileInputText" id="fileInputText2detail" type="text" disabled>
      				<button class="send-file" id="send-file2detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input2detail" type="file" name="file_detaldop21[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper3detail">
   				<div class="mask" id="mask3detail">
      				<input class="fileInputText" id="fileInputText3detail" type="text" disabled>
      				<button class="send-file" id="send-file3detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input3detail" type="file" name="file_detaldop21[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper4detail">
   				<div class="mask" id="mask4detail">
      				<input class="fileInputText" id="fileInputText4detail" type="text" disabled>
      				<button class="send-file" id="send-file4detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input4detail" type="file" name="file_detaldop21[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper5detail">
   				<div class="mask" id="mask5detail">
      				<input class="fileInputText" id="fileInputText5detail" type="text" disabled>
      				<button class="send-file" id="send-file5detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input5detail" type="file" name="file_detaldop21[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper6detail">
   				<div class="mask" id="mask6detail">
      				<input class="fileInputText" id="fileInputText6detail" type="text" disabled>
      				<button class="send-file" id="send-file6detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input6detail" type="file" name="file_detaldop21[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper7detail">
   				<div class="mask" id="mask7detail">
      				<input class="fileInputText" id="fileInputText7detail" type="text" disabled>
      				<button class="send-file" id="send-file7detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input7detail" type="file" name="file_detaldop21[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper8detail">
   				<div class="mask" id="mask8detail">
      				<input class="fileInputText" id="fileInputText8detail" type="text" disabled>
      				<button class="send-file" id="send-file8detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input8detail" type="file" name="file_detaldop21[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper9detail">
   				<div class="mask" id="mask9detail">
      				<input class="fileInputText" id="fileInputText9detail" type="text" disabled>
      				<button class="send-file" id="send-file9detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input9detail" type="file" name="file_detaldop21[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper10detail">
   				<div class="mask" id="mask10detail">
      				<input class="fileInputText" id="fileInputText10detail" type="text" disabled>
      				<button class="send-file" id="send-file10detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input10detail" type="file" name="file_detaldop21[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper11detail">
   				<div class="mask" id="mask11detail">
      				<input class="fileInputText" id="fileInputText11detail" type="text" disabled>
      				<button class="send-file" id="send-file11detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input11detail" type="file" name="file_detaldop21[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper12detail">
   				<div class="mask" id="mask12detail">
      				<input class="fileInputText" id="fileInputText12detail" type="text" disabled>
      				<button class="send-file" id="send-file12detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input12detail" type="file" name="file_detaldop21[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper13detail">
   				<div class="mask" id="mask13detail">
      				<input class="fileInputText" id="fileInputText13detail" type="text" disabled>
      				<button class="send-file" id="send-file13detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input13detail" type="file" name="file_detaldop21[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper14detail">
   				<div class="mask" id="mask14detail">
      				<input class="fileInputText" id="fileInputText14detail" type="text" disabled>
      				<button class="send-file" id="send-file14detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input14detail" type="file" name="file_detaldop21[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper15detail">
   				<div class="mask" id="mask15detail">
      				<input class="fileInputText" id="fileInputText15detail" type="text" disabled>
      				<button class="send-file" id="send-file15detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input15detail" type="file" name="file_detaldop21[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper16detail">
   				<div class="mask" id="mask16detail">
      				<input class="fileInputText" id="fileInputText16detail" type="text" disabled>
      				<button class="send-file" id="send-file16detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input16detail" type="file" name="file_detaldop21[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper17detail">
   				<div class="mask" id="mask17detail">
      				<input class="fileInputText" id="fileInputText17detail" type="text" disabled>
      				<button class="send-file" id="send-file17detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input17detail" type="file" name="file_detaldop21[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper18detail">
   				<div class="mask" id="mask18detail">
      				<input class="fileInputText" id="fileInputText18detail" type="text" disabled>
      				<button class="send-file" id="send-file18detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input18detail" type="file" name="file_detaldop21[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper19detail">
   				<div class="mask" id="mask19detail">
      				<input class="fileInputText" id="fileInputText19detail" type="text" disabled>
      				<button class="send-file" id="send-file19detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input19detail" type="file" name="file_detaldop21[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper20detail">
   				<div class="mask" id="mask20detail">
      				<input class="fileInputText" id="fileInputText20detail" type="text" disabled>
      				<button class="send-file" id="send-file20detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input20detail" type="file" name="file_detaldop21[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper21detail">
   				<div class="mask" id="mask21detail">
      				<input class="fileInputText" id="fileInputText21detail" type="text" disabled>
      				<button class="send-file" id="send-file21detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input21detail" type="file" name="file_detaldop21[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper22detail">
   				<div class="mask" id="mask22detail">
      				<input class="fileInputText" id="fileInputText22detail" type="text" disabled>
      				<button class="send-file" id="send-file22detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input22detail" type="file" name="file_detaldop21[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper23detail">
   				<div class="mask" id="mask23detail">
      				<input class="fileInputText" id="fileInputText23detail" type="text" disabled>
      				<button class="send-file" id="send-file23detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input23detail" type="file" name="file_detaldop21[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper24detail">
   				<div class="mask" id="mask24detail">
      				<input class="fileInputText" id="fileInputText24detail" type="text" disabled>
      				<button class="send-file" id="send-file24detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input24detail" type="file" name="file_detaldop21[]">
			</div>
            
            
			
            </div>
            
            
            <style type="text/css">
            .mask-wrapper {
   				height: 50px;
   				margin-bottom:20px;
				
			}
			.mask-wrapper .send-file {
   				padding: 3px 20px;
   				margin-left: 3px;
   				color: #fff;
   				background-color: #ccc;
			}
			.mask-wrapper .fileInputText {
   				position: relative;
   				width: 133px;
   				top: 3px;
			}
			.custom-file-input {
   				width: 100% !important;
  height: 50px;
   				opacity: 0;
   				filter: alpha(opacity=0);
   				position: relative;
   				top: -52px;
   				left: -16px;
   				z-index: 99999;
   				cursor: pointer;
			}
            </style>
            <input type="button" value="Добавить ещё" class="INeedMore" id="INeedMore2"/>
            <span class="note1">Фото именной таблички техники (фотографии должны быть чёткими, маркировки должны быть читабельными) </span>
        
        
        </div>
        
        
        
    
    </div>
    
    <div class="block3">
    	<span class="note2" onClick="f_show2dop21()">Добавить информацию</span>
	</div>
    
    
    <div id="f2dop21" name="f2" class="f">
   		<textarea name="textareaf2dop21" placeholder="Дополнительная информация"></textarea>
    
	</div>
    
    <div style="width:100%; height:3px;  margin-bottom:15px;" class="dotted_line"></div>
    
    
    </div>-->
    <!----=======================================================================----->
   <!--
    <div class="dop22">
    <div class="block1">
    	<div class="block11">
        	<input type="text" class="input1" name="input31dop22" id="input31" placeholder="Название детали"/>
    		<span class="text1">Например Yuchai</span>
    	
        </div>
        <div class="block12">
        	<input type="text" class="input2" name="input32dop22" id="input32" placeholder="Описание детали"/>
    		<span class="text2">Например YCD4688R</span>
    	
        </div>
		
    </div>
    
    
    <div class="block2">
    	<div class="left">Прикрепить фото:</div>
        <div class="right" id="right">
           
            <style type="text/css">
            #right22 #mask-wrapper1detail{
			display:block;
			}            
            </style>
            
            
            <div id="right22">
            
            
            
            <div class="mask-wrapper" id="mask-wrapper1detail">
   				<div class="mask" id="mask1detail">
      				<input class="fileInputText" id="fileInputText1detail" type="text" disabled>
      				<button class="send-file" id="send-file1detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input1detail" type="file" name="file_detaldop22[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper2detail">
   				<div class="mask" id="mask2detail">
      				<input class="fileInputText" id="fileInputText2detail" type="text" disabled>
      				<button class="send-file" id="send-file2detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input2detail" type="file" name="file_detaldop22[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper3detail">
   				<div class="mask" id="mask3detail">
      				<input class="fileInputText" id="fileInputText3detail" type="text" disabled>
      				<button class="send-file" id="send-file3detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input3detail" type="file" name="file_detaldop22[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper4detail">
   				<div class="mask" id="mask4detail">
      				<input class="fileInputText" id="fileInputText4detail" type="text" disabled>
      				<button class="send-file" id="send-file4detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input4detail" type="file" name="file_detaldop22[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper5detail">
   				<div class="mask" id="mask5detail">
      				<input class="fileInputText" id="fileInputText5detail" type="text" disabled>
      				<button class="send-file" id="send-file5detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input5detail" type="file" name="file_detaldop22[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper6detail">
   				<div class="mask" id="mask6detail">
      				<input class="fileInputText" id="fileInputText6detail" type="text" disabled>
      				<button class="send-file" id="send-file6detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input6detail" type="file" name="file_detaldop22[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper7detail">
   				<div class="mask" id="mask7detail">
      				<input class="fileInputText" id="fileInputText7detail" type="text" disabled>
      				<button class="send-file" id="send-file7detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input7detail" type="file" name="file_detaldop22[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper8detail">
   				<div class="mask" id="mask8detail">
      				<input class="fileInputText" id="fileInputText8detail" type="text" disabled>
      				<button class="send-file" id="send-file8detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input8detail" type="file" name="file_detaldop22[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper9detail">
   				<div class="mask" id="mask9detail">
      				<input class="fileInputText" id="fileInputText9detail" type="text" disabled>
      				<button class="send-file" id="send-file9detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input9detail" type="file" name="file_detaldop22[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper10detail">
   				<div class="mask" id="mask10detail">
      				<input class="fileInputText" id="fileInputText10detail" type="text" disabled>
      				<button class="send-file" id="send-file10detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input10detail" type="file" name="file_detaldop22[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper11detail">
   				<div class="mask" id="mask11detail">
      				<input class="fileInputText" id="fileInputText11detail" type="text" disabled>
      				<button class="send-file" id="send-file11detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input11detail" type="file" name="file_detaldop22[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper12detail">
   				<div class="mask" id="mask12detail">
      				<input class="fileInputText" id="fileInputText12detail" type="text" disabled>
      				<button class="send-file" id="send-file12detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input12detail" type="file" name="file_detaldop22[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper13detail">
   				<div class="mask" id="mask13detail">
      				<input class="fileInputText" id="fileInputText13detail" type="text" disabled>
      				<button class="send-file" id="send-file13detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input13detail" type="file" name="file_detaldop22[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper14detail">
   				<div class="mask" id="mask14detail">
      				<input class="fileInputText" id="fileInputText14detail" type="text" disabled>
      				<button class="send-file" id="send-file14detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input14detail" type="file" name="file_detaldop22[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper15detail">
   				<div class="mask" id="mask15detail">
      				<input class="fileInputText" id="fileInputText15detail" type="text" disabled>
      				<button class="send-file" id="send-file15detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input15detail" type="file" name="file_detaldop22[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper16detail">
   				<div class="mask" id="mask16detail">
      				<input class="fileInputText" id="fileInputText16detail" type="text" disabled>
      				<button class="send-file" id="send-file16detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input16detail" type="file" name="file_detaldop22[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper17detail">
   				<div class="mask" id="mask17detail">
      				<input class="fileInputText" id="fileInputText17detail" type="text" disabled>
      				<button class="send-file" id="send-file17detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input17detail" type="file" name="file_detaldop22[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper18detail">
   				<div class="mask" id="mask18detail">
      				<input class="fileInputText" id="fileInputText18detail" type="text" disabled>
      				<button class="send-file" id="send-file18detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input18detail" type="file" name="file_detaldop22[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper19detail">
   				<div class="mask" id="mask19detail">
      				<input class="fileInputText" id="fileInputText19detail" type="text" disabled>
      				<button class="send-file" id="send-file19detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input19detail" type="file" name="file_detaldop22[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper20detail">
   				<div class="mask" id="mask20detail">
      				<input class="fileInputText" id="fileInputText20detail" type="text" disabled>
      				<button class="send-file" id="send-file20detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input20detail" type="file" name="file_detaldop22[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper21detail">
   				<div class="mask" id="mask21detail">
      				<input class="fileInputText" id="fileInputText21detail" type="text" disabled>
      				<button class="send-file" id="send-file21detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input21detail" type="file" name="file_detaldop22[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper22detail">
   				<div class="mask" id="mask22detail">
      				<input class="fileInputText" id="fileInputText22detail" type="text" disabled>
      				<button class="send-file" id="send-file22detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input22detail" type="file" name="file_detaldop22[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper23detail">
   				<div class="mask" id="mask23detail">
      				<input class="fileInputText" id="fileInputText23detail" type="text" disabled>
      				<button class="send-file" id="send-file23detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input23detail" type="file" name="file_detaldop22[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper24detail">
   				<div class="mask" id="mask24detail">
      				<input class="fileInputText" id="fileInputText24detail" type="text" disabled>
      				<button class="send-file" id="send-file24detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input24detail" type="file" name="file_detaldop22[]">
			</div>
            
            
			
            </div>
            
            
            <style type="text/css">
            .mask-wrapper {
   				height: 50px;
   				margin-bottom:20px;
				
			}
			.mask-wrapper .send-file {
   				padding: 3px 20px;
   				margin-left: 3px;
   				color: #fff;
   				background-color: #ccc;
			}
			.mask-wrapper .fileInputText {
   				position: relative;
   				width: 133px;
   				top: 3px;
			}
			.custom-file-input {
   				width: 100% !important;
  height: 50px;
   				opacity: 0;
   				filter: alpha(opacity=0);
   				position: relative;
   				top: -52px;
   				left: -16px;
   				z-index: 99999;
   				cursor: pointer;
			}
            </style>
            <input type="button" value="Добавить ещё" class="INeedMore" id="INeedMore2"/>
            <span class="note1">Фото именной таблички техники (фотографии должны быть чёткими, маркировки должны быть читабельными) </span>
        
        
        </div>
        
        
        
    
    </div>
    
    <div class="block3">
    	<span class="note2" onClick="f_show2dop22()">Добавить информацию</span>
	</div>
    
    
    <div id="f2dop22" name="f2" class="f">
   		<textarea name="textareaf2dop22" placeholder="Дополнительная информация"></textarea>
    
	</div>
    
    <div style="width:100%; height:3px;  margin-bottom:15px;" class="dotted_line"></div>
    
    
    </div>-->
    <!----=======================================================================----->
    <!--
    <div class="dop23">
    <div class="block1">
    	<div class="block11">
        	<input type="text" class="input1" name="input31dop23" id="input31" placeholder="Название детали"/>
    		<span class="text1">Например Yuchai</span>
    	
        </div>
        <div class="block12">
        	<input type="text" class="input2" name="input32dop23" id="input32" placeholder="Описание детали"/>
    		<span class="text2">Например YCD4688R</span>
    	
        </div>
		
    </div>
    
    
    <div class="block2">
    	<div class="left">Прикрепить фото:</div>
        <div class="right" id="right">
         
            <style type="text/css">
            #right22 #mask-wrapper1detail{
			display:block;
			}            
            </style>
            
            
            <div id="right22">
            
            
            
            <div class="mask-wrapper" id="mask-wrapper1detail">
   				<div class="mask" id="mask1detail">
      				<input class="fileInputText" id="fileInputText1detail" type="text" disabled>
      				<button class="send-file" id="send-file1detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input1detail" type="file" name="file_detaldop23[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper2detail">
   				<div class="mask" id="mask2detail">
      				<input class="fileInputText" id="fileInputText2detail" type="text" disabled>
      				<button class="send-file" id="send-file2detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input2detail" type="file" name="file_detaldop23[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper3detail">
   				<div class="mask" id="mask3detail">
      				<input class="fileInputText" id="fileInputText3detail" type="text" disabled>
      				<button class="send-file" id="send-file3detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input3detail" type="file" name="file_detaldop23[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper4detail">
   				<div class="mask" id="mask4detail">
      				<input class="fileInputText" id="fileInputText4detail" type="text" disabled>
      				<button class="send-file" id="send-file4detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input4detail" type="file" name="file_detaldop23[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper5detail">
   				<div class="mask" id="mask5detail">
      				<input class="fileInputText" id="fileInputText5detail" type="text" disabled>
      				<button class="send-file" id="send-file5detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input5detail" type="file" name="file_detaldop23[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper6detail">
   				<div class="mask" id="mask6detail">
      				<input class="fileInputText" id="fileInputText6detail" type="text" disabled>
      				<button class="send-file" id="send-file6detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input6detail" type="file" name="file_detaldop23[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper7detail">
   				<div class="mask" id="mask7detail">
      				<input class="fileInputText" id="fileInputText7detail" type="text" disabled>
      				<button class="send-file" id="send-file7detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input7detail" type="file" name="file_detaldop23[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper8detail">
   				<div class="mask" id="mask8detail">
      				<input class="fileInputText" id="fileInputText8detail" type="text" disabled>
      				<button class="send-file" id="send-file8detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input8detail" type="file" name="file_detaldop23[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper9detail">
   				<div class="mask" id="mask9detail">
      				<input class="fileInputText" id="fileInputText9detail" type="text" disabled>
      				<button class="send-file" id="send-file9detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input9detail" type="file" name="file_detaldop23[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper10detail">
   				<div class="mask" id="mask10detail">
      				<input class="fileInputText" id="fileInputText10detail" type="text" disabled>
      				<button class="send-file" id="send-file10detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input10detail" type="file" name="file_detaldop23[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper11detail">
   				<div class="mask" id="mask11detail">
      				<input class="fileInputText" id="fileInputText11detail" type="text" disabled>
      				<button class="send-file" id="send-file11detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input11detail" type="file" name="file_detaldop23[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper12detail">
   				<div class="mask" id="mask12detail">
      				<input class="fileInputText" id="fileInputText12detail" type="text" disabled>
      				<button class="send-file" id="send-file12detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input12detail" type="file" name="file_detaldop23[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper13detail">
   				<div class="mask" id="mask13detail">
      				<input class="fileInputText" id="fileInputText13detail" type="text" disabled>
      				<button class="send-file" id="send-file13detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input13detail" type="file" name="file_detaldop23[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper14detail">
   				<div class="mask" id="mask14detail">
      				<input class="fileInputText" id="fileInputText14detail" type="text" disabled>
      				<button class="send-file" id="send-file14detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input14detail" type="file" name="file_detaldop23[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper15detail">
   				<div class="mask" id="mask15detail">
      				<input class="fileInputText" id="fileInputText15detail" type="text" disabled>
      				<button class="send-file" id="send-file15detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input15detail" type="file" name="file_detaldop23[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper16detail">
   				<div class="mask" id="mask16detail">
      				<input class="fileInputText" id="fileInputText16detail" type="text" disabled>
      				<button class="send-file" id="send-file16detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input16detail" type="file" name="file_detaldop23[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper17detail">
   				<div class="mask" id="mask17detail">
      				<input class="fileInputText" id="fileInputText17detail" type="text" disabled>
      				<button class="send-file" id="send-file17detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input17detail" type="file" name="file_detaldop23[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper18detail">
   				<div class="mask" id="mask18detail">
      				<input class="fileInputText" id="fileInputText18detail" type="text" disabled>
      				<button class="send-file" id="send-file18detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input18detail" type="file" name="file_detaldop23[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper19detail">
   				<div class="mask" id="mask19detail">
      				<input class="fileInputText" id="fileInputText19detail" type="text" disabled>
      				<button class="send-file" id="send-file19detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input19detail" type="file" name="file_detaldop23[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper20detail">
   				<div class="mask" id="mask20detail">
      				<input class="fileInputText" id="fileInputText20detail" type="text" disabled>
      				<button class="send-file" id="send-file20detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input20detail" type="file" name="file_detaldop23[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper21detail">
   				<div class="mask" id="mask21detail">
      				<input class="fileInputText" id="fileInputText21detail" type="text" disabled>
      				<button class="send-file" id="send-file21detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input21detail" type="file" name="file_detaldop23[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper22detail">
   				<div class="mask" id="mask22detail">
      				<input class="fileInputText" id="fileInputText22detail" type="text" disabled>
      				<button class="send-file" id="send-file22detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input22detail" type="file" name="file_detaldop23[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper23detail">
   				<div class="mask" id="mask23detail">
      				<input class="fileInputText" id="fileInputText23detail" type="text" disabled>
      				<button class="send-file" id="send-file23detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input23detail" type="file" name="file_detaldop23[]">
			</div>
            
            <div class="mask-wrapper" id="mask-wrapper24detail">
   				<div class="mask" id="mask24detail">
      				<input class="fileInputText" id="fileInputText24detail" type="text" disabled>
      				<button class="send-file" id="send-file24detail">Выбрать</button>
   				</div>
   				<input id="file_detal" class="custom-file-input custom-file-input24detail" type="file" name="file_detaldop23[]">
			</div>
            
            
			
            </div>
            
            
            <style type="text/css">
            .mask-wrapper {
   				height: 50px;
   				margin-bottom:20px;
				
			}
			.mask-wrapper .send-file {
   				padding: 3px 20px;
   				margin-left: 3px;
   				color: #fff;
   				background-color: #ccc;
			}
			.mask-wrapper .fileInputText {
   				position: relative;
   				width: 133px;
   				top: 3px;
			}
			.custom-file-input {
   				width: 100% !important;
  height: 50px;
   				opacity: 0;
   				filter: alpha(opacity=0);
   				position: relative;
   				top: -52px;
   				left: -16px;
   				z-index: 99999;
   				cursor: pointer;
			}
            </style>
            <input type="button" value="Добавить ещё" class="INeedMore" id="INeedMore2"/>
            <span class="note1">Фото именной таблички техники (фотографии должны быть чёткими, маркировки должны быть читабельными) </span>
        
        
        </div>
        
        
        
    
    </div>
    
    <div class="block3">
    	<span class="note2" onClick="f_show2dop23()">Добавить информацию</span>
	</div>
    
    
    <div id="f2dop23" name="f2" class="f">
   		<textarea name="textareaf2dop23" placeholder="Дополнительная информация"></textarea>
    
	</div>
    
    <div style="width:100%; height:3px;  margin-bottom:15px;" class="dotted_line"></div>
    
    
    </div>-->
    <!----=======================================================================----->
    
    
    
    
    </div>
    
    
    
    
    
    
    
    <!------------->
    
    <div class="new_block">
    	<input type="button" id="detail" class="new_button" value="Добавить ещё одну деталь"/>
    </div>
    
    
    
    </div>

</div>








<div class="form4">

	<span class="head" onClick="block4_show();">Данные получателя <span class="red"><img src="/templates/rsmetro/images/upArr.gif" alt="" title=""/></span></span>
    
    <div id="block4_show">
    <div class="block_tabs">
<span class="vid">Выберите вид</span>
<ul class="tabs">
     <li class="active"><a href="#tab1" class="tab_left">Организация</a></li>
     <li class=""><a href="#tab2" class="tab_right">Частное лицо</a></li>
</ul>
<div class="tab_container">
     <div id="tab1" class="tab_content"> 
     	<!-- Контент -->
     	
        <span class="head1">Сведения о компании *</span>
        <div class="block1">
    	<div class="block11">
        
        	<input type="text" class="input1" name="input11_org" id="input11_org" placeholder="Правовая форма"/>
    		<span class="text1">Например: ООО</span>
    	
        </div>
        <div class="block12">
        	<input type="text" class="input2" name="input12_org" id="input12_org" placeholder="Наименование организации"/>
    		
    	
        </div>
		
    	</div>
        <span class="head2">Контактное лицо *</span>
        <div class="block2">
    	<div class="block21">
        
        	<input type="text" class="input1" name="input21_org" id="input21_org" placeholder="Фамилия"/>
    		<span class="text1">Например: Иванов</span>
    	
        </div>
        <div class="block22">
        	<input type="text" class="input2" name="input22_org" id="input22_org" placeholder="Имя"/>
    		<span class="text2">Например: Иван</span>
    	
        </div>
		<div class="block23">
        	<input type="text" class="input3" name="input23_org" id="input23_org" placeholder="Отчество"/>
    		<span class="text3">Например: Иванович</span>
    	
        </div>
		
    	</div>
        
        
      <div class="block3">
    	<div class="block31">
        
        	<input type="text" class="input1" name="input31_org" id="input31_org" placeholder="Контактный e-mail"/>
    		<span class="text1">Контактный емаил</span>
    	
        </div>
        <div class="block32">
        	<input type="text" class="input2" name="input32_org" id="input32_org" placeholder="Контактный телефон"/>
    		<span class="text2">Контактный телефон</span>
    	
        </div>
		
    	</div>
      <span class="head3">Физический адрес:</span>
      <div class="block4">
     <!-- 
      <style type="text/css">
     
      .block42 option.dis{
	  display:block;
	  visibility:visible;
	  }
	  
	  .block43 option{
	  display:none;
	  visibility:hidden;
	  }
      .block43 option.dis{
	  display:block;
	  visibility:visible;
	  }
      </style>
      -->
      
    	<div class="block41">
       
        <?php
		$database	= & JFactory::getDBO();
		$database->setQuery("SELECT * FROM #__country ORDER BY name");
		$list = $database->loadObjectList();
 		
		
		?>
        
        
        	<select id="region1_org" class="input1" name="region1_org" onchange='select_input1();'>
    		<option selected class="reg3159">Россия</option>
    		<?php //foreach($list as $user) {  ?>
            <!--<option class="reg<?php //echo $user->country_id; ?>" value="<?php //echo $user->name; ?>"><?php //echo $user->name; ?></option>-->
    		<?php //} ?>
            </select>
    	
        </div>
        
        <div class="block42">
        
        <?php
		
		$database->setQuery("SELECT * FROM #__region ORDER BY name");
		$list = $database->loadObjectList();
		
		?>
        
        
        	<select id="region2_org" class="input2" name="region2_org">
    		<option class="dis" selected disabled>Город или район</option>
           
            
    		<?php
			 foreach($list as $user) { 
			 if(($user->country_id)!="3159"){ continue; } 
			?>
    		<option class="reg<?php echo $user->country_id; ?>" id="reg<?php echo $user->region_id; ?>" value="<?php echo $user->name; ?>"><?php echo $user->name; ?></option>
            <?php
			}
			?>           
   			</select>
            
            
    	
        </div>
        
		<div class="block43">
        
        
        <?php
		
		$database->setQuery("SELECT * FROM #__city ORDER BY name");
		$list = $database->loadObjectList();
		
		?>
        
        	<select id="region3_org" class="input3" name="region3_org">
    		<option class="dis" selected disabled>Населённый пункт</option>
             <!--
    		<?php
			// foreach($list as $user) {  
			?>
    		<option class="opt_1 reg<?php  //echo $user->region_id;   ?>" 
            value="<?php   
			//echo $user->name;
			  
			?>">
			<?php     
			// echo $user->name; 
			 ?>
            </option>
    		<?php
			//}
			?>  -->
            <option class="dis" id="other_org" value="Другой">Другой</option>
            </select>
            
            <script type="text/javascript">
			
			
			$(document).ready(function() {
            
			$("#region3_org .opt_1").remove();
			
			arr = new Array();
			arr2 = new Array();
			
			<?php
			$count1=0;
			foreach($list as $user) {  
			?>
			
				arr[<?php  echo $count1;  ?>]="<?php  echo $user->region_id;   ?>";
				arr2[<?php  echo $count1;  ?>]="<?php  echo $user->name;   ?>";
			
			<?php
			$count1++;
			}
			
			?>
			//alert(arr[1]);
			});
            </script>
            
      
            
    	
        </div>
        
        <input type="text" class="input1_other" name="input21_org_other" id="input21_org_other" placeholder="Населённый пункт" style="display:none;"/>
        
        
        
      
        <script type="text/javascript">
        $('#region1_org').change(function(){
			var reg1=$('#region1_org option:selected').attr("class");
			$("#region2_org option").css("display", "none");
			$("#region2_org .dis").css("display", "block");
			$("#region2_org .dis").css("visibility", "visible");
			$("#region2_org ."+reg1+"").css("display", "block");
			$("#region2_org ."+reg1+"").css("visibility", "visible");
			//$("#region2_org .dis2").css("display", "none");
			
			
			document.getElementById('region2_org').options[0].selected = true;
			document.getElementById('region3_org').options[0].selected = true;

		});
		
		$('#region2_org').change(function(){
			var reg1=$('#region2_org option:selected').attr("id");
			//$("#region3_org option").css("display", "none");
			
			//alert("=====");
			
			//$("#region3_org .dis").css("display", "block");
			//$("#region3_org .dis").css("visibility", "visible");
			
			//$("#region3_org ."+reg1+"").css("display", "block");
			//$("#region3_org ."+reg1+"").css("visibility", "visible");
			
			$("#region3_org .opt_1").remove();
			
			for(var i=0; i<arr.length; i++) {
				
				//alert(arr[i]);
				//document.write(arr[i]+" -- "+reg1+"==");
				var tmp1="reg"+arr[i];
				//alert(tmp1);
				if((tmp1)==reg1){ 
				//alert("1212121");
					$("#region3_org").append( $('<option class="opt_1 reg'+arr[i]+'" value="'+arr2[i]+'">'+arr2[i]+'</option>') ); 
				}
			}

			
			
			
			document.getElementById('region3_org').options[0].selected = true;
		});
		
		
		$('#region3_org').change(function(){
			var reg1=$('#region3_org option:selected').attr("id");
			if(reg1=="other_org"){
			
			 $("#input21_org_other").css("display", "block"); 
			 $("#input21_org_other").css("visibility", "visible"); 
			 
			  }
		});
		
        </script>
		
    	</div>
        <div class="line3"></div>

        
         
     </div>
     <div id="tab2" class="tab_content"> 
         <!-- Контент -->
        
        <div class="block2" style="margin-top:45px;">
    	<div class="block21">
        
        	<input type="text" class="input1" name="input21_fiz" id="input21_fiz" placeholder="Фамилия"/>
    		<span class="text1">Например: Иванов</span>
    	
        </div>
        <div class="block22">
        	<input type="text" class="input2" name="input22_fiz" id="input22_fiz" placeholder="Имя"/>
    		<span class="text2">Например: Иван</span>
    	
        </div>
		<div class="block23">
        	<input type="text" class="input3" name="input23_fiz" id="input23_fiz" placeholder="Отчество"/>
    		<span class="text3">Например: Иванович</span>
    	
        </div>
		
    	</div>
        
        
      <div class="block3">
    	<div class="block31">
        
        	<input type="text" class="input1" name="input31_fiz" id="input31_fiz" placeholder="Контактный e-mail"/>
    		<span class="text1">Контактный емаил</span>
    	
        </div>
        <div class="block32">
        	<input type="text" class="input2" name="input32_fiz" id="input32_fiz" placeholder="Контактный телефон"/>
    		<span class="text2">Контактный телефон</span>
    	
        </div>
		
    	</div>
      <span class="head3">Физический адрес:</span>
      <div class="block4">
      <!--
      <style type="text/css">
      .block42 option{
	 /* display:none;*/
	  }
      .block42 option.dis{
	  display:block;
	  visibility:visible;
	  }
	  
	  .block43 option{
	  display:none;
	  
	  visibility:hidden;
	  }
      .block43 option.dis{
	  display:block;
	  visibility:visible;
	  }
      </style>
      -->
    	<div class="block41">
        
        <?php
		$database	= & JFactory::getDBO();
		$database->setQuery("SELECT * FROM #__country ORDER BY name");
		$list = $database->loadObjectList();
 		
		
		?>
		
 			
		
			<select id="region1_fiz" class="input1" name="region1_fiz">
    		<option selected class="reg3159">Россия</option>
            
    		<?php //foreach($list as $user) {  ?>
            <!--<option class="reg<?php //echo $user->country_id; ?>" value="<?php //echo $user->name; ?>"><?php //echo $user->name; ?></option>-->
    		<?php //} ?>	
        
        
        	</select>
            
            <script type="text/javascript">
			
			
			$(document).ready(function() {
            
			$("#region3_fiz .fiz_1").remove();
			
			arr_fiz = new Array();
			arr2_fiz = new Array();
			
			<?php
			$count1=0;
			foreach($list as $user) {  
			?>
			
				arr_fiz[<?php  echo $count1;  ?>]="<?php  echo $user->region_id;   ?>";
				arr2_fiz[<?php  echo $count1;  ?>]="<?php  echo $user->name;   ?>";
			
			<?php
			$count1++;
			}
			
			?>
			//alert(arr[1]);
			});
            </script>
            
      
            
    	
        </div>
        <div class="block42">
        
        
        <?php
		
		$database->setQuery("SELECT * FROM #__region ORDER BY name");
		$list = $database->loadObjectList();
		
		?>
        
        	<select id="region2_fiz" class="input2" name="region2_fiz">
            
    		<option class="dis" selected disabled>Город или район</option>
           
            <?php
			 foreach($list as $user) {  
			 if(($user->country_id)!="3159"){ continue; }
			?>
    		<option class="reg<?php echo $user->country_id; ?>" id="reg<?php echo $user->region_id; ?>" value="<?php echo $user->name; ?>"><?php echo $user->name; ?></option>
            <?php
			}
			?>           
   			</select>
    	
        </div>
		<div class="block43">
        
        <?php
		
		$database->setQuery("SELECT * FROM #__city ORDER BY name");
		$list = $database->loadObjectList();
		
		?>
        
        	<select id="region3_fiz" class="input3" name="region3_fiz">
    		
    		<option class="dis" selected disabled>Населённый пункт</option>
            <!--
            <?php
			// foreach($list as $user) {  
			?>
    		<option class="reg<?php  //echo $user->region_id;   ?>" 
            value="<?php   
			//echo $user->name;
			  
			?>">
			<?php     
			 //echo $user->name; 
			 ?>
            </option>
           
    		<?php
			//}
			?>
            -->  
             <option class="dis" id="other_fiz" value="Другой">Другой</option>
            
            
            </select>
            
            
    	
        </div>
        
        <input type="text" class="input1_other" name="input21_fiz_other" id="input21_fiz_other" placeholder="Населённый пункт" style="display:none;"/>
        
        
        
        <script type="text/javascript">
        $('#region1_fiz').change(function(){
			var reg1=$('#region1_fiz option:selected').attr("class");
			$("#region2_fiz option").css("display", "none");
			$("#region2_fiz .dis").css("display", "block");
			$("#region2_fiz .dis").css("visibility", "visible");
			
			$("#region2_fiz ."+reg1+"").css("display", "block");
			$("#region2_fiz ."+reg1+"").css("visibility", "visible");
			document.getElementById('region2_fiz').options[0].selected = true;
			document.getElementById('region3_fiz').options[0].selected = true;

			
		});
		
		$('#region2_fiz').change(function(){
			var reg1=$('#region2_fiz option:selected').attr("id");
			//$("#region3_fiz option").css("display", "none");
			//$("#region3_fiz .dis").css("display", "block");
			//$("#region3_fiz .dis").css("visibility", "visible");
			//$("#region3_fiz ."+reg1+"").css("display", "block");
			//$("#region3_fiz ."+reg1+"").css("visibility", "visible");
			
			$("#region3_fiz .opt_1").remove();
			
			for(var i=0; i<arr.length; i++) {
				
				//alert(arr[i]);
				//document.write(arr[i]+" -- "+reg1+"==");
				var tmp1="reg"+arr[i];
				//alert(tmp1);
				if((tmp1)==reg1){ 
				//alert("1212121");
					$("#region3_fiz").append( $('<option class="opt_1 reg'+arr[i]+'" value="'+arr2[i]+'">'+arr2[i]+'</option>') ); 
				}
			}

			
			
			document.getElementById('region3_fiz').options[0].selected = true;
		});
		
		$('#region3_fiz').change(function(){
			var reg1=$('#region3_fiz option:selected').attr("id");
			if(reg1=="other_fiz"){ $("#input21_fiz_other").css("display", "block"); 
			$("#input21_fiz_other").css("visibility", "visible"); 
			 }
		});
		
        </script>
        
		
    	</div>
        <div class="line3"></div>
        <!--<div class="submit1">
       
        </div>-->
        
        
        
        
        
     </div>
     <!--</div>-->
     
     
        
        
     
</div>


	

<style type="text/css">

ul.tabs {
    margin: 0;
    padding: 0;
    float: left;
    list-style: none;
    
    width: 100%;
}
ul.tabs li {
    float: left;
    margin: 0;
    padding: 0;
  
  
   
    border-left: none;
    margin-bottom: -1px;
 
    overflow: hidden;
    position: relative;
}
ul.tabs li a {
    text-decoration: none;
    color: #565661;
    padding-top:15px;
	padding-bottom:15px;
	padding-left:15px;
	padding-right:15px;
   border: 1px solid #d9dada;
    outline: none;
	font-size: 14.074px;
  font-family: 'Ubuntu', sans-serif;
background-color:#fff;
display:block;
	
	
}
ul.tabs li a:hover {
  
}    
html ul.tabs li.active  {
    /*background: #565661;
    border: 1px solid #d9dada;
	/*border-radius: 10px 0 0 10px;
	-webkit-border-radius:10px 0 0 10px;
	-moz-border-radius:10px 0 0 10px;*/
 /* font-size: 19.074px;
  font-family: 'Ubuntu', sans-serif;
  color: #fff;
*/

}

.tab_container {
   
    border-top: none;
    clear: both;
    float: left; 
    width: 100%;
}
.tab_content {
    padding: 20px;
    font-size: 1.2em;
	padding-left:0px;
	padding-right:0px;
}

</style>

<script type="text/javascript">
$(document).ready(function() {

    //Действия по умолчанию
    $(".tab_content").hide(); //скрыть весь контент
    $("ul.tabs li:first").addClass("active").show(); //Активировать первую вкладку
    $(".tab_content:first").show(); //Показать контент первой вкладки
    
    //Событие по клику
    $("ul.tabs li").click(function() {
        $("ul.tabs li").removeClass("active"); //Удалить "active" класс
        $(this).addClass("active"); //Добавить "active" для выбранной вкладки
        $(".tab_content").hide(); //Скрыть контент вкладки
        var activeTab = $(this).find("a").attr("href"); //Найти значение атрибута, чтобы определить активный таб + контент
        $(activeTab).fadeIn(); //Исчезновение активного контента
        return false;
    });

});

</script>


</div>

     

    
</div>  
    


	<div class="submit1" style="display:none;">
        <input type="submit" class="button1" id="button1" value="отправить форму" onClick="send_cl();"/>
        <span class="text1">Мы принимаем заявки 24 часа. Ответ по заявкам высылаем в самое<br>короткое время. Просьба учитывать разницу во времени (+6 МСК) </span>
        <span class="text2">Вся полученная информация является конфиденциальной и не будет передана третьим лицам.</span>
     </div>


   

</div>








</div>



</form>
</div>


<?php
} 
?>


        
        <div class="block_footer">
        	<div class="block8">
            <jdoc:include type="modules" name="block_footer" style="xhtml" />
            </div>
        </div>
        
        	
		<div class="container">			
			<div class="jr_module head">
            	<?php if($this->countModules('header_b')) : ?>
            	<div class="jr_mod_b">
                	<jdoc:include type="modules" name="header_b" style="xhtml" />
            	</div>
            	<?php endif; ?>
            	<div class="jr_mod<?php echo $header_a; ?>">
                	<jdoc:include type="modules" name="header_a" style="xhtml" />
            	</div>
            	<?php if($this->countModules('header_c')) : ?>
            	<div class="jr_mod_c">
                	<jdoc:include type="modules" name="header_c" style="xhtml" />
            	</div>
            	<?php endif; ?>
				<div class="clr"></div>
        	</div>
			<div class="header_rt">	
				<a class="logo" href="<?php echo $this->baseurl; ?>">
					<?php echo $logo;?> <?php if ($this->params->get('sitedescription')) { echo '<div class="site-description">'. htmlspecialchars($this->params->get('sitedescription')) .'</div>'; } ?>
				</a>
				<jdoc:include type="modules" name="social" style="xhtml" />
				<jdoc:include type="modules" name="seargh" style="xhtml" />
            </div>
			<div class="main_menu">
				<jdoc:include type="modules" name="mainmenu" style="xhtml" />
            </div>		
		</div>
				<div class="clr"></div>
			<div class="rs_slider">
				<jdoc:include type="modules" name="slider" style="xhtml" />
				<div class="clr"></div>
            </div>			
		<div class="jr_module top">
            <?php if($this->countModules('top_b')) : ?>
            <div class="jr_mod_b">
                <jdoc:include type="modules" name="top_b" style="xhtml" />
            </div>
            <?php endif; ?>
            <div class="jr_mod<?php echo $top_a; ?>">
                <jdoc:include type="modules" name="top_a" style="xhtml" />
            </div>
            <?php if($this->countModules('top_c')) : ?>
            <div class="jr_mod_c">
                <jdoc:include type="modules" name="top_c" style="xhtml" />
            </div>
            <?php endif; ?>
			<div class="clr"></div>
        </div>			
		<div class="jr_component">
            <?php if($this->countModules('left')) : ?>
            <div class="jr_left">
                <jdoc:include type="modules" name="left" style="xhtml" />
            </div>
            <?php endif; ?>
            <div class="jr<?php echo $contentwidth; ?>">
                <jdoc:include type="modules" name="breadcrumb" style="xhtml" />	        
                <jdoc:include type="component" />
            </div>
            <?php if($this->countModules('right')) : ?>
            <div class="jr_right">
                <jdoc:include type="modules" name="right" style="xhtml" />
            </div>
            <?php endif; ?>
			<div class="clr"></div>
        </div>			
		<div class="jr_module bott">
            <?php if($this->countModules('bottom_b')) : ?>
            <div class="jr_mod_b">
                <jdoc:include type="modules" name="bottom_b" style="xhtml" />
            </div>
            <?php endif; ?>
            <div class="jr_mod<?php echo $bottom_a; ?>">
                <jdoc:include type="modules" name="bottom_a" style="xhtml" />
            </div>
            <?php if($this->countModules('bottom_c')) : ?>
            <div class="jr_mod_c">
                <jdoc:include type="modules" name="bottom_c" style="xhtml" />
            </div>
            <?php endif; ?>
			<div class="clr"></div>
        </div>			
	</div>
	<div id="footer">
			
		
	</div>
    <jdoc:include type="modules" name="debug" />
<jdoc:include type="message" />


<script type="text/javascript">

/*$(window).bind('scroll', function() {
   if ($(window).scrollTop() > 50) {
      $('.header_menu').addClass('fixed1');
$('.header_bg').addClass('fixed2');
   }
   else
   {
      $('.header_menu').removeClass('fixed1');
 $('.header_bg').removeClass('fixed2');
   }
});
*/
</script>




<?php
if((JURI::current() == JURI::base()."order")){
?>
<script type="text/javascript">

$(document).ready(function() {
var number=2;
//var MaxInputs       = 8; //максимальное количство для добавления
var Wrap   = $("#detail_new"); //родительский элемент полей
var AddButton       = $("#detail"); //Кнопка добавить поле
var x = Wrap.length; //подсчет количества полей
var FieldCount=1; //добавляем каждому полю + 1



$(AddButton).click(function (e)  //функция добавления нового поля
{



for(i1=2;i1<24;i1++){
	$display1=$(".dop"+i1+"").css("display");
	if($display1=="none"){ $(".dop"+i1+"").css("display","block"); break; }
}



    
    	



number++;
//        if(x <= MaxInputs) //проверяем на максимальное кол-во
//        {
//            FieldCount++; 
            //добавляем поле
//            $(Wrap).append('<div><input type="text" name="mytext[]" id="field_'+ FieldCount +'" value="Text '+ FieldCount +'"/><a href="#" class="removeclass">&times;</a></div>');
//            x++; //приращение текстового поля
//        }
//return false;
});



});

</script>
<?php
}
?>


<?php
if((JURI::current() == JURI::base()."order")){
?>
<script type="text/javascript">

$(document).ready(function() {
var number=2;
//var MaxInputs       = 8; //максимальное количство для добавления
var Wrap   = $("#right2"); //родительский элемент полей
var AddButton       = $("#INeedMore"); //Кнопка добавить поле
var x = Wrap.length; //подсчет количества полей
var FieldCount=1; //добавляем каждому полю + 1



$(AddButton).click(function (e)  //функция добавления нового поля
{

for(i1=2;i1<25;i1++){
	$display1=$("#right2 .mask-wrapper#mask-wrapper"+i1+"").css("display");
	if($display1=="none"){ $("#right2 .mask-wrapper#mask-wrapper"+i1+"").css("display","block"); break; }
}


number++;
});



});

</script>
<?php
}
?>




<?php
if((JURI::current() == JURI::base()."order")){
?>
<script type="text/javascript">

$(document).ready(function() {
var number=2;
//var MaxInputs       = 8; //максимальное количство для добавления
var Wrap   = $("#right21"); //родительский элемент полей
var AddButton       = $("#INeedMore1"); //Кнопка добавить поле
var x = Wrap.length; //подсчет количества полей
var FieldCount=1; //добавляем каждому полю + 1



$(AddButton).click(function (e)  //функция добавления нового поля
{

for(i1=2;i1<25;i1++){
	$display1=$("#right21 .mask-wrapper#mask-wrapper1"+i1+"dvig").css("display");
	if($display1=="none"){ $("#right21 .mask-wrapper#mask-wrapper1"+i1+"dvig").css("display","block"); break; }
}





number++;
//        if(x <= MaxInputs) //проверяем на максимальное кол-во
//        {
//            FieldCount++; 
            //добавляем поле
//            $(Wrap).append('<div><input type="text" name="mytext[]" id="field_'+ FieldCount +'" value="Text '+ FieldCount +'"/><a href="#" class="removeclass">&times;</a></div>');
//            x++; //приращение текстового поля
//        }
//return false;
});



});

</script>

<?php
}
?>



<?php
if((JURI::current() == JURI::base()."order")){
?>

<?php
for($i2=1;$i2<24;$i2++){
?>

<script type="text/javascript">

$(document).ready(function() {
var number=2;
//var MaxInputs       = 8; //максимальное количство для добавления
var Wrap   = $(".dop<?php echo $i2; ?> #right22"); //родительский элемент полей
var AddButton       = $(".dop<?php echo $i2; ?> #INeedMore2"); //Кнопка добавить поле
var x = Wrap.length; //подсчет количества полей
var FieldCount=1; //добавляем каждому полю + 1



$(AddButton).click(function (e)  //функция добавления нового поля
{


for(i1=2;i1<25;i1++){
	$display1=$(".dop<?php echo $i2; ?> #right22 .mask-wrapper#mask-wrapper"+i1+"detail").css("display");
	if($display1=="none"){ $(".dop<?php echo $i2; ?> #right22 .mask-wrapper#mask-wrapper"+i1+"detail").css("display","block"); break; }
}


number++;

});



});

</script>
<?php
}
?>

<?php
}
?>






<?php
if((JURI::current() == JURI::base()."order")){
?>

<script type="text/javascript">
$(function (){
	
    $('#Form').submit(function (){      
    
		
	
		var text1_f=$("#input22_fiz").val();	
		var text2_f=$("#input31_fiz").val();	
		var text3_f=$("#input32_fiz").val();	
	
	
	
	   	var text1=$("#input22_org").val();	
		
		if((text1=="")&&(text1_f=="")){
			 alert("Поле 'Имя' необходимо заполнить"); return false;	
		}
		
		
		
		//if(text1==""){ alert("Поле 'Имя' необходимо заполнить"); return false; }
		
		var text2=$("#input31_org").val();
		
		if(text1!=""){
		if(text2!=""){
			var re = /^[\w-\.]+@[\w-]+\.[a-z]{2,4}$/i;
			var valid = re.test(text2);
			if (!valid){ alert("E-mail введён неправильно"); return false; }
		}
		}
		
		if(text1_f!=""){
		if(text2_f!=""){
			var re = /^[\w-\.]+@[\w-]+\.[a-z]{2,4}$/i;
			var valid = re.test(text2_f);
			if (!valid){ alert("E-mail введён неправильно"); return false; }
		}
		}
		
		
		var text3=$("#input32_org").val();
		
		
		if(text1!=""){
		if(text3!=""){
		
		 	var re = /^\d[\d\(\)\ -]{4,14}\d$/;
    		var valid = re.test(text3);
    		if (!valid){ alert("Номер телефона введён неправильно"); return false; }
		
		}
		}
		
		if(text1_f!=""){
		if(text3_f!=""){
		
		 	var re = /^\d[\d\(\)\ -]{4,14}\d$/;
    		var valid = re.test(text3_f);
    		if (!valid){ alert("Номер телефона введён неправильно"); return false; }
		
		}
		}
		
		
		
		if(text1!=""){
		if((text2=="")&&(text3=="")){ alert("Необходимо заполнить хотя бы одно из данных полей: 'E-mail' или 'Телефон' "); return false;  }
		}
		if(text1_f!=""){
		if((text2_f=="")&&(text3_f=="")){ alert("Необходимо заполнить хотя бы одно из данных полей: 'E-mail' или 'Телефон' "); return false;  }
		}
		
		
        
    });
});


//function send_cl(){
//var text1=$("#input22_org").val();	
//alert("123");
//return false;
//}
</script>

<script type="text/javascript">
 $(document).ready(function(){
 
 
 
////////////////////////////////////////////////////////////////////////
 $('.custom-file-input1').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input1").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask1').find('#fileInputText1').val(file1);
      }
 
 });
 
////////////////////////////////////////////////////////////////////////
 
 $('.custom-file-input2').on('change', function() {


 var file1=$(".custom-file-input2").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask2').find('#fileInputText2').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////

 $('.custom-file-input3').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input3").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask3').find('#fileInputText3').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input4').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input4").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask4').find('#fileInputText4').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input5').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input5").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask5').find('#fileInputText5').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input6').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input6").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask6').find('#fileInputText6').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input7').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input7").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask7').find('#fileInputText7').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input8').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input8").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask8').find('#fileInputText8').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input9').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input9").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask9').find('#fileInputText9').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input10').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input10").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask10').find('#fileInputText10').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input11').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input11").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask11').find('#fileInputText11').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input12').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input12").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask12').find('#fileInputText12').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input13').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input13").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask13').find('#fileInputText13').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input14').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input14").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask14').find('#fileInputText14').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input15').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input15").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask15').find('#fileInputText15').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input16').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input16").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask16').find('#fileInputText16').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input17').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input17").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask17').find('#fileInputText17').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input18').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input18").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask18').find('#fileInputText18').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input19').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input19").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask19').find('#fileInputText19').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input20').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input20").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask20').find('#fileInputText20').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input21').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input21").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask21').find('#fileInputText21').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input22').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input22").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask22').find('#fileInputText22').val(file1);
      }
 
 });
 
 
 });
 </script>
 
<?php
}
?>
 
 
 
<?php
if((JURI::current() == JURI::base()."order")){
?>
 
 
<script type="text/javascript">
 $(document).ready(function(){
 
 
 
////////////////////////////////////////////////////////////////////////
 $('.custom-file-input11dvig').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input11dvig").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask11dvig').find('#fileInputText11dvig').val(file1);
      }
 
 });
 
////////////////////////////////////////////////////////////////////////
 
 $('.custom-file-input12dvig').on('change', function() {


 var file1=$(".custom-file-input12dvig").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask12dvig').find('#fileInputText12dvig').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////

 $('.custom-file-input13dvig').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input13dvig").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask13dvig').find('#fileInputText13dvig').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input14dvig').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input14dvig").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask14dvig').find('#fileInputText14dvig').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input15dvig').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input15dvig").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask15dvig').find('#fileInputText15dvig').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input16dvig').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input16dvig").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask16dvig').find('#fileInputText16dvig').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input17dvig').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input17dvig").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask17dvig').find('#fileInputText17dvig').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input18dvig').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input18dvig").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask18dvig').find('#fileInputText18dvig').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input19dvig').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input19dvig").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask19dvig').find('#fileInputText19dvig').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input110dvig').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input110dvig").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask110dvig').find('#fileInputText110dvig').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input111dvig').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input111dvig").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask111dvig').find('#fileInputText111dvig').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input112dvig').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input112dvig").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask112dvig').find('#fileInputText112dvig').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input113dvig').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input113dvig").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask113dvig').find('#fileInputText113dvig').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input114dvig').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input114dvig").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask114dvig').find('#fileInputText114dvig').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input115dvig').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input115dvig").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask115dvig').find('#fileInputText115dvig').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input116dvig').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input116dvig").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask116dvig').find('#fileInputText116dvig').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input117dvig').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input117dvig").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask117dvig').find('#fileInputText117dvig').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input118dvig').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input118dvig").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask118dvig').find('#fileInputText118dvig').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input119dvig').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input119dvig").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask119dvig').find('#fileInputText119dvig').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input120dvig').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input120dvig").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask120dvig').find('#fileInputText120dvig').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input121dvig').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input121dvig").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask121dvig').find('#fileInputText121dvig').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input122dvig').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input122dvig").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask122dvig').find('#fileInputText122dvig').val(file1);
      }
 
 });
  ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input123dvig').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input123dvig").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask123dvig').find('#fileInputText123dvig').val(file1);
      }
 
 });
  ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input124dvig').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input124dvig").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask124dvig').find('#fileInputText124dvig').val(file1);
      }
 
 });
  ////////////////////////////////////////////////////////////////////////
 $('.custom-file-input124dvig').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".custom-file-input124dvig").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask124dvig').find('#fileInputText124dvig').val(file1);
      }
 
 });
 
 
 });
 </script>
 
 
<?php
}
?> 
 


<?php
if((JURI::current() == JURI::base()."order")){
?>


 <?php
 for($i2=1;$i2<24;$i2++){
 ?>
 
  
<script type="text/javascript">
 $(document).ready(function(){
 
 
 
////////////////////////////////////////////////////////////////////////
 $('.dop<?php echo $i2; ?> .custom-file-input1detail').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".dop<?php echo $i2; ?> .custom-file-input1detail").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask1detail').find('#fileInputText1detail').val(file1);
      }
 
 });
 
////////////////////////////////////////////////////////////////////////
 
 $('.dop<?php echo $i2; ?> .custom-file-input2detail').on('change', function() {


 var file1=$(".dop<?php echo $i2; ?> .custom-file-input2detail").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask2detail').find('#fileInputText2detail').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////

 $('.dop<?php echo $i2; ?> .custom-file-input3detail').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".dop<?php echo $i2; ?> .custom-file-input3detail").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask3detail').find('#fileInputText3detail').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.dop<?php echo $i2; ?> .custom-file-input4detail').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".dop<?php echo $i2; ?> .custom-file-input4detail").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask4detail').find('#fileInputText4detail').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.dop<?php echo $i2; ?> .custom-file-input5detail').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".dop<?php echo $i2; ?> .custom-file-input5detail").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask5detail').find('#fileInputText5detail').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.dop<?php echo $i2; ?> .custom-file-input6detail').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".dop<?php echo $i2; ?> .custom-file-input6detail").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask6detail').find('#fileInputText6detail').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.dop<?php echo $i2; ?> .custom-file-input7detail').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".dop<?php echo $i2; ?> .custom-file-input7detail").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask7detail').find('#fileInputText7detail').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.dop<?php echo $i2; ?> .custom-file-input8detail').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".dop<?php echo $i2; ?> .custom-file-input8detail").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask8detail').find('#fileInputText8detail').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.dop<?php echo $i2; ?> .custom-file-input9detail').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".dop<?php echo $i2; ?> .custom-file-input9detail").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask9detail').find('#fileInputText9detail').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.dop<?php echo $i2; ?> .custom-file-input10detail').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".dop<?php echo $i2; ?> .custom-file-input10detail").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask10detail').find('#fileInputText10detail').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.dop<?php echo $i2; ?> .custom-file-input11detail').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".dop<?php echo $i2; ?> .custom-file-input11detail").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask11detail').find('#fileInputText11detail').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.dop<?php echo $i2; ?> .custom-file-input12detail').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".dop<?php echo $i2; ?> .custom-file-input12detail").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask12detail').find('#fileInputText12detail').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.dop<?php echo $i2; ?> .custom-file-input13detail').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".dop<?php echo $i2; ?> .custom-file-input13detail").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask13detail').find('#fileInputText13detail').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.dop<?php echo $i2; ?> .custom-file-input14detail').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".dop<?php echo $i2; ?> .custom-file-input14detail").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask14detail').find('#fileInputText14detail').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.dop<?php echo $i2; ?> .custom-file-input15detail').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".dop<?php echo $i2; ?> .custom-file-input15detail").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask15detail').find('#fileInputText15detail').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.dop<?php echo $i2; ?> .custom-file-input16detail').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".dop<?php echo $i2; ?> .custom-file-input16detail").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask16detail').find('#fileInputText16detail').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.dop<?php echo $i2; ?> .custom-file-input17detail').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".dop<?php echo $i2; ?> .custom-file-input17detail").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask17detail').find('#fileInputText17detail').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.dop<?php echo $i2; ?> .custom-file-input18detail').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".dop<?php echo $i2; ?> .custom-file-input18detail").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask18detail').find('#fileInputText18detail').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.dop<?php echo $i2; ?> .custom-file-input19detail').on('change', function() {

 //alert(jQuery.fn.jquery);

 var file1=$(".dop<?php echo $i2; ?> .custom-file-input19detail").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask19detail').find('#fileInputText19detail').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.dop<?php echo $i2; ?> .custom-file-input20detail').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".dop<?php echo $i2; ?> .custom-file-input20detail").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask20detail').find('#fileInputText20detail').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.dop<?php echo $i2; ?> .custom-file-input21detail').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".dop<?php echo $i2; ?> .custom-file-input21detail").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask21detail').find('#fileInputText21detail').val(file1);
      }
 
 });
 ////////////////////////////////////////////////////////////////////////
 $('.dop<?php echo $i2; ?> .custom-file-input22detail').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".dop<?php echo $i2; ?> .custom-file-input22detail").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask22detail').find('#fileInputText22detail').val(file1);
      }
 
 });
  ////////////////////////////////////////////////////////////////////////
 $('.dop<?php echo $i2; ?> .custom-file-input23detail').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".dop<?php echo $i2; ?> .custom-file-input23detail").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask23detail').find('#fileInputText23detail').val(file1);
      }
 
 });
  ////////////////////////////////////////////////////////////////////////
 $('.dop<?php echo $i2; ?> .custom-file-input24detail').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".dop<?php echo $i2; ?> .custom-file-input24detail").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask24detail').find('#fileInputText24detail').val(file1);
      }
 
 });
  ////////////////////////////////////////////////////////////////////////
 $('.dop<?php echo $i2; ?> .custom-file-input25detail').on('change', function() {

 //alert(jQuery.fn.jquery);
 var file1=$(".dop<?php echo $i2; ?> .custom-file-input25detail").val();
					

 lastIndex = file1.lastIndexOf('\\') + 1;

 
      if(lastIndex !== -1) {
         file1 = file1.substr(lastIndex);
		 
         $(this).prev('#mask25detail').find('#fileInputText25detail').val(file1);
      }
 
 });
 
 
 });
 </script>
 


<?php
}
?>

<?php
}
?>




 
<?php
if((JURI::current() == JURI::base()."order")){
?>

<script type="text/javascript">

function f_show(){
	
	if($("#f").css("display")=="block"){
	$("#f").hide(1000);
	}else{
	$("#f").show(1000);	
	}	
	
	
}

</script>
 
 <script type="text/javascript">
function f_show1(){
	
	if($("#f1").css("display")=="block"){
	$("#f1").hide(1000);
	}else{
	$("#f1").show(1000);	
	}	
	

}

</script>

<script type="text/javascript"> 
$(document).ready(function(){     
	//document.getElementById('button1').disabled = true;
	
})


</script>


<script type="text/javascript">        
function ver1(){
var ver=$('#input11').val();
if(ver==""){ $("#input11").css("borderColor","red");  }
else{
$("#input11").css("borderColor","#b7b7b7");  
}
}

function ver2(){
var ver=$('#input12').val();
if(ver==""){ $("#input12").css("borderColor","red");  }
else{
$("#input12").css("borderColor","#b7b7b7");  
}			
}

function ver3(){
var ver=$('#input13').val();
if(ver==""){ $("#input13").css("borderColor","red");  }
else{
$("#input13").css("borderColor","#b7b7b7");  
}			
}

function ver4(){
var ver=$('#input21').val();
if(ver==""){ $("#input21").css("borderColor","red");  }
else{
$("#input21").css("borderColor","#b7b7b7");  
}			
}

function ver5(){
var ver=$('#input22').val();
if(ver==""){ $("#input22").css("borderColor","red");  }
else{
$("#input22").css("borderColor","#b7b7b7");  
}			
}

function ver6(){
var ver=$('#input31').val();
if(ver==""){ $("#input31").css("borderColor","red");  }
else{
$("#input31").css("borderColor","#b7b7b7");  
}			
}

function ver7(){
var ver=$('#input32').val();
if(ver==""){ $("#input32").css("borderColor","red");  }
else{
$("#input32").css("borderColor","#b7b7b7");  
}			
}







$('#input11_org').on('blur', function() {
var ver=$('#input11_org').val();
if(ver==""){ $("#input11_org").css("borderColor","red");  }
else{
$("#input11_org").css("borderColor","#b7b7b7");  
}
});

$('#input12_org').on('blur', function() {
var ver=$('#input12_org').val();
if(ver==""){ $("#input12_org").css("borderColor","red");  }
else{
$("#input12_org").css("borderColor","#b7b7b7");  
}
});

$('#input21_org').on('blur', function() {
var ver=$('#input21_org').val();
if(ver==""){ $("#input21_org").css("borderColor","red");  }
else{
$("#input21_org").css("borderColor","#b7b7b7");  
}
});

$('#input22_org').on('blur', function() {
var ver=$('#input22_org').val();
if(ver==""){ $("#input22_org").css("borderColor","red");  }
else{
$("#input22_org").css("borderColor","#b7b7b7");  
}
});

$('#input31_org').on('blur', function() {
var ver=$('#input31_org').val();
if(ver==""){ $("#input31_org").css("borderColor","red");  }
else{
$("#input31_org").css("borderColor","#b7b7b7");  
}
});

$('#input32_org').on('blur', function() {
var ver=$('#input32_org').val();
if(ver==""){ $("#input32_org").css("borderColor","red");  }
else{
$("#input32_org").css("borderColor","#b7b7b7");  
}
});

$('#input21_fiz').on('blur', function() {
var ver=$('#input21_fiz').val();
if(ver==""){ $("#input21_fiz").css("borderColor","red");  }
else{
$("#input21_fiz").css("borderColor","#b7b7b7");  
}
});

$('#input22_fiz').on('blur', function() {
var ver=$('#input22_fiz').val();
if(ver==""){ $("#input22_fiz").css("borderColor","red");  }
else{
$("#input22_fiz").css("borderColor","#b7b7b7");  
}
});

$('#input31_fiz').on('blur', function() {
var ver=$('#input31_fiz').val();
if(ver==""){ $("#input31_fiz").css("borderColor","red");  }
else{
$("#input31_fiz").css("borderColor","#b7b7b7");  
}
});

$('#input32_fiz').on('blur', function() {
var ver=$('#input32_fiz').val();
if(ver==""){ $("#input32_fiz").css("borderColor","red");  }
else{
$("#input32_fiz").css("borderColor","#b7b7b7");  
}
});
 
 
 
 
</script>
<?php
}
?>



<?php
if((JURI::current() == JURI::base()."order")){
?>
 <script type="text/javascript">
<?php
for($i2=1;$i2<24;$i2++){
echo'
function f_show2dop'.$i2.'(){
	
	if($("#f2dop'.$i2.'").css("display")=="block"){
	$("#f2dop'.$i2.'").hide(1000);
	}else{
	$("#f2dop'.$i2.'").show(1000);
	}	
	


}
';
}
?>
</script>

<?php
}
?>





<script type="text/javascript">
function block1_show(){
	
	if($("#block1_show").css("display")=="block"){
	$("#block1_show").hide(1000);
	}else{
	$("#block1_show").show(1000);
	}

}
function block2_show(){

	if($("#block2_show").css("display")=="block"){
	$("#block2_show").hide(1000);
	}else{
	$("#block2_show").show(1000);	
	}
}
function block3_show(){

	if($("#block3_show").css("display")=="block"){
	$("#block3_show").hide(1000);
	}else{
	$("#block3_show").show(1000);	
	}
	

}
function block4_show(){
	if($("#block4_show").css("display")=="block"){
	$("#block4_show").hide(1000);
	}else{
	$("#block4_show").show(1000);	
	}


}
</script>

<style type="text/css">
#block1_show, #block2_show, #block3_show, #block4_show{
	display:none;
	
}

.head{
cursor:pointer;
}
</style>


<script language="jscript">
$(document).ready(function(){
	
$(".block_form .form4 .submit1").css("display", "block");

});
</script>


<script type="text/javascript">
// $(document).ready(function(){
// alert(jQuery.fn.jquery);
// });
 </script>


</body>
</html>