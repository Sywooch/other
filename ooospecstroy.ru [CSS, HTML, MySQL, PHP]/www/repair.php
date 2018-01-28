<?php
session_start();
header('Content-type: text/html; charset=utf-8');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Компания предлагает полный цикл услуг в области строительства, реставрации, реконструкции, ремонта и отделочных работ, а также изготовление корпусной мебели по индивидуальным заказам физических и юридических лиц"/>
<meta name="keywords" content="компания спецстрой благовещенск, ремонтно-отделочные работы, новые технологии, ремонт помещений, ремонт любой сложности, текстурное покрытие, отделка поверхностей, терракоат замша, террако, акриловое текстурное покрытие, терракоат сахара, терракоат гранул" />
<meta name="robots" content="all"/>
<meta name="revisit-after" content="1 days"/>
<meta name="document-state" content="Dynamic"/>
<meta name="generator" content="notepad++ :) "/>
<meta name="author" content="retina-studio"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/ ><!--всегда исползовать стандартный режим отображения-->
<link href="/favicon.png" rel="icon" type="image/png"/>

<title>Ремонт/Отделка</title>

<link rel="stylesheet" href="css/global2.css"/>
<link rel="stylesheet" href="css/style.css"/>
<link rel="stylesheet" href="css/style_header.css"/>
<link rel="stylesheet" href="css/style_content.css"/>
<link rel="stylesheet" href="css/style_footer.css"/>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/slides.min.jquery.js"></script>
<!--<script type="text/javascript" src="js/jquery-1.8.2.js"></script>-->
<script type="text/javascript" src="js/jquery.highlight.js"></script>
<!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>-->

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38692430-2']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script type="text/javascript">
		$(function(){
			// Set starting slide to 1
			var startSlide = 1;
			// Get slide number if it exists
			if (window.location.hash) {
		//		startSlide = window.location.hash.replace('#','');
			}
			// Initialize Slides
			$('#slides').slides({
				preload: true,
				preloadImage: 'img/loading.gif',
				generatePagination: true,
				play: 3000,
				pause: 3000,
				hoverPause: true,
				// Get the starting slide
				start: startSlide,
				animationComplete: function(current){
					// Set the slide number as a hash
		//			window.location.hash = '#' + current;
				}
			});
		});
	</script>
<!--[if IE 7]>
<style type="text/css">
.pagination {
	width:280px;
	position:absolute;
	z-index:9000;
	margin-top:-65px;
    margin-left:340px;
	 background-image:url(../img/pagination_fon3.png);
 background-repeat:no-repeat;
 background-position:0px 42px;
padding-left:10px;
 
}

.pagination li {
	float:left;
	 z-index:9000;
	margin-top:47px;
	margin-left:0px;
	list-style:none;
   
}


</style>
<![endif]-->

<style type="text/css">
.style456{
	margin-top:0px;
}

</style>
<!--[if IE 7]>
<style type="text/css">
.style456{
	margin-top:-14px;
}

</style>

<![endif]-->

</head>

<body class="body_style">
<?php include_once("analyticstracking.php") ?>
<!--самый главный блок, по размерам занимает всю страницу--> 
<div align="center" class="main_block">

<!--=======================================================-->
<div class="shtori" align="center">
<div class="shtori_in">
</div>
</div><!--шторы-->


<div align="center" class="main_block_header"><!--главный блок, шапка-->



<div align="left" class="header"><!--шапка-->

<div style="width:1116px; float:left; height:90px; padding-left:50px">
<div class="new_logo"><!--логотип, адрес и т.д.-->

<?php
include("templates/contact_information.php");
?>
		
		
<?php
include("templates/logo.php");
?>


<?php
include("templates/license_information.php");
?>





</div><!--логотип, адрес и т.д.-->
</div>

<div style="width:1116px; float:left; height:50px; padding-left:50px; padding-top:0px; ">
<div align="center" class="new_div"><!--меню и строка поиска-->

<?php
include("templates/menu.php");
?>


</div><!--меню и строка поиска-->
</div>

<div style="width:800px; float:left; height:400px; padding-left:96px">
<div class="new_slider"><!--слайдер-->
<div class="new_slider_2" style="background-image:url('images/ramka.jpg'); background-repeat:no-repeat; padding-top:20px; padding-left:23px">


<div style="height:400px; width:800px; margin-left:0px; margin-top:0px;"><!--слайдер-->
<div id="container">
		<div id="example">
			<div id="slides">
				<div class="slides_container">
					<div class="slide">
						<img src="img/slides/repair/1.jpg" alt="услуги по реставрации"/>
					</div>
					<div class="slide">
						<img src="img/slides/repair/2.jpg" alt="реконструкция"/>
					</div>
					<div class="slide">
						<img src="img/slides/repair/3.jpg" alt="ремонт"/>						
					</div>
					<div class="slide">
						<img src="img/slides/repair/4.jpg" alt="изготовление корпусной мебели"/>					
					</div>
					
					
				</div>
				</div>
			</div>
			</div>
</div><!--слайдер-->
<div align="right" style="height:87px; width:100px; margin-top:-127px; margin-left:650px; position:relative; z-index:999999">
<img src="images/man.png" alt="реставрация объектов культурного наследия" style="float:right"/>
</div>



</div>
</div><!--слайдер-->
</div>

</div><!--шапка-->



</div><!--главный блок, шапка-->

<!------------------------------------------------------------------------------------------------->
<!--контент-->
<div align="center" style="height:20px; width:100%;  float:left">
<div style="height:20px; width:1166px; margin-top:0px"></div>
</div>

<div align="center" class="new_kontent">
<div style="width:1166px;min-height:450px;background-color:#dbd3be">
<div class="new_kontent_2"><!--основной контент-->
<div class="new_left_menu"><!--левое меню-->
<?php
include("templates/left_menu-repair.php");
?>
</div><!--левое меню-->
<div class="new_center_block"><!--центральный блок с контентом-->
<div class="myriad_pro12 content">

<table  width="602px" align="center" border="0" cellpadding="0" cellspacing="0"  style="position:relative;z-index:9999999; color:#735f50">
		<tbody>
		<tr>
						<td class="style19 content_table_td">
			<p class="style75" align="justify">
			
			<?php
			include("content/repair_content.php");
			?>
			
			
			
			</p></td>
		</tr>
	</tbody></table>


</div>
</div><!--центральный блок с контентом-->

<?php
include("templates/news-repair.php");
?>

</div><!--основной контент-->
</div>
</div><!--контент-->

<!------------------------------------------------------------------------------------------------->

<div align="center" class="new_center_block_2">
<div class="new_center_block_3">
<div style="height:30px; width:300px; text-align:center">
<span style="font-family:Italic; font-size:20pt; color:#735f50">Наши работы</span>
</div>
</div>
</div>


<!------------------------------------------------------------------------------------------------->
<!--первый блок с фотографиями-->
<?php
include("templates/block_foto.php");
?>


<!------------------------------------------------------------------------------------------------->
<!--второй блок с фотографиями-->

<?php
include("templates/block_foto_2.php");
?>



<!------------------------------------------------------------------------------------------------->
<!--подвал-->

<?php
include("templates/footer.php");
?>


<!------------------------------------------------------------------------------------------------->

<!--самый главный блок, по размерам занимает всю страницу-->
</div>





<?php
if(isset($_SESSION['word'])){
$word=$_SESSION['word'];


//разложение строки на подстроки
$mas_word=NULL;
$mas_word=explode(" ",$word); 
$i=0;

while($i<count($mas_word)){
echo"<script>
var searchTerm='".$mas_word[$i]."';
  if(searchTerm){
  $('table').highlight(searchTerm);
  }</script>";
$i++;
}//конец цикла



unset($_SESSION['word']);
}

?>


<script>
function showTooltip1_1()
{
var myDiv = document.getElementById('tooltip1_1');
if(myDiv.style.display == 'none')
{
myDiv.style.display = 'block';
document.getElementById('text1_1').innerHTML='(Свернуть)';
} else {
myDiv.style.display = 'none';
document.getElementById('text1_1').innerHTML='(Развернуть)';
}
return false;
}</script>

<script>
function showTooltip1_2()
{
var myDiv = document.getElementById('tooltip1_2');
if(myDiv.style.display == 'none')
{
myDiv.style.display = 'block';
document.getElementById('text1_2').innerHTML='(Свернуть)';
} else {
myDiv.style.display = 'none';
document.getElementById('text1_2').innerHTML='(Развернуть)';
}
return false;
}</script>

<script>
function showTooltip1_3()
{
var myDiv = document.getElementById('tooltip1_3');
if(myDiv.style.display == 'none')
{
myDiv.style.display = 'block';
document.getElementById('text1_3').innerHTML='(Свернуть)';
} else {
myDiv.style.display = 'none';
document.getElementById('text1_3').innerHTML='(Развернуть)';
}
return false;
}</script>

<script>
function showTooltip1_4()
{
var myDiv = document.getElementById('tooltip1_4');
if(myDiv.style.display == 'none')
{
myDiv.style.display = 'block';
document.getElementById('text1_4').innerHTML='(Свернуть)';
} else {
myDiv.style.display = 'none';
document.getElementById('text1_4').innerHTML='(Развернуть)';
}
return false;
}</script>

<script>
function showTooltip1_5()
{
var myDiv = document.getElementById('tooltip1_5');
if(myDiv.style.display == 'none')
{
myDiv.style.display = 'block';
document.getElementById('text1_5').innerHTML='(Свернуть)';
} else {
myDiv.style.display = 'none';
document.getElementById('text1_5').innerHTML='(Развернуть)';
}
return false;
}</script>

<script>
function showTooltip1_6()
{
var myDiv = document.getElementById('tooltip1_6');
if(myDiv.style.display == 'none')
{
myDiv.style.display = 'block';
document.getElementById('text1_6').innerHTML='(Свернуть)';
} else {
myDiv.style.display = 'none';
document.getElementById('text1_6').innerHTML='(Развернуть)';
}
return false;
}</script>

<script>
function showTooltip1_7()
{
var myDiv = document.getElementById('tooltip1_7');
if(myDiv.style.display == 'none')
{
myDiv.style.display = 'block';
document.getElementById('text1_7').innerHTML='(Свернуть)';
} else {
myDiv.style.display = 'none';
document.getElementById('text1_7').innerHTML='(Развернуть)';
}
return false;
}</script>

<script>
function showTooltip1_8()
{
var myDiv = document.getElementById('tooltip1_8');
if(myDiv.style.display == 'none')
{
myDiv.style.display = 'block';
document.getElementById('text1_8').innerHTML='(Свернуть)';
} else {
myDiv.style.display = 'none';
document.getElementById('text1_8').innerHTML='(Развернуть)';
}
return false;
}</script>

<script>
function showTooltip1_9()
{
var myDiv = document.getElementById('tooltip1_9');
if(myDiv.style.display == 'none')
{
myDiv.style.display = 'block';
document.getElementById('text1_9').innerHTML='(Свернуть)';
} else {
myDiv.style.display = 'none';
document.getElementById('text1_9').innerHTML='(Развернуть)';
}
return false;
}</script>

<script>
function showTooltip1_10()
{
var myDiv = document.getElementById('tooltip1_10');
if(myDiv.style.display == 'none')
{
myDiv.style.display = 'block';
document.getElementById('text1_10').innerHTML='(Свернуть)';
} else {
myDiv.style.display = 'none';
document.getElementById('text1_10').innerHTML='(Развернуть)';
}
return false;
}</script>

<script>
function showTooltip1_11()
{
var myDiv = document.getElementById('tooltip1_11');
if(myDiv.style.display == 'none')
{
myDiv.style.display = 'block';
document.getElementById('text1_11').innerHTML='(Свернуть)';
} else {
myDiv.style.display = 'none';
document.getElementById('text1_11').innerHTML='(Развернуть)';
}
return false;
}</script>

<script>
function showTooltip2_1()
{
var myDiv = document.getElementById('tooltip2_1');
if(myDiv.style.display == 'none')
{
myDiv.style.display = 'block';
document.getElementById('text2_1').innerHTML='(Свернуть)';
} else {
myDiv.style.display = 'none';
document.getElementById('text2_1').innerHTML='(Развернуть)';
}
return false;
}</script>

<script>
function showTooltip2_2()
{
var myDiv = document.getElementById('tooltip2_2');
if(myDiv.style.display == 'none')
{
myDiv.style.display = 'block';
document.getElementById('text2_2').innerHTML='(Свернуть)';
} else {
myDiv.style.display = 'none';
document.getElementById('text2_2').innerHTML='(Развернуть)';
}
return false;
}</script>

<script>
function showTooltip2_3()
{
var myDiv = document.getElementById('tooltip2_3');
if(myDiv.style.display == 'none')
{
myDiv.style.display = 'block';
document.getElementById('text2_3').innerHTML='(Свернуть)';
} else {
myDiv.style.display = 'none';
document.getElementById('text2_3').innerHTML='(Развернуть)';
}
return false;
}</script>

<script>
function showTooltip2_4()
{
var myDiv = document.getElementById('tooltip2_4');
if(myDiv.style.display == 'none')
{
myDiv.style.display = 'block';
document.getElementById('text2_4').innerHTML='(Свернуть)';
} else {
myDiv.style.display = 'none';
document.getElementById('text2_4').innerHTML='(Развернуть)';
}
return false;
}</script>

<script>
function showTooltip2_5()
{
var myDiv = document.getElementById('tooltip2_5');
if(myDiv.style.display == 'none')
{
myDiv.style.display = 'block';
document.getElementById('text2_5').innerHTML='(Свернуть)';
} else {
myDiv.style.display = 'none';
document.getElementById('text2_5').innerHTML='(Развернуть)';
}
return false;
}</script>

<script>
function showTooltip2_6()
{
var myDiv = document.getElementById('tooltip2_6');
if(myDiv.style.display == 'none')
{
myDiv.style.display = 'block';
document.getElementById('text2_6').innerHTML='(Свернуть)';
} else {
myDiv.style.display = 'none';
document.getElementById('text2_6').innerHTML='(Развернуть)';
}
return false;
}</script>

<script>
function showTooltip2_7()
{
var myDiv = document.getElementById('tooltip2_7');
if(myDiv.style.display == 'none')
{
myDiv.style.display = 'block';
document.getElementById('text2_7').innerHTML='(Свернуть)';
} else {
myDiv.style.display = 'none';
document.getElementById('text2_7').innerHTML='(Развернуть)';
}
return false;
}</script>

<script>
function showTooltip2_8()
{
var myDiv = document.getElementById('tooltip2_8');
if(myDiv.style.display == 'none')
{
myDiv.style.display = 'block';
document.getElementById('text2_8').innerHTML='(Свернуть)';
} else {
myDiv.style.display = 'none';
document.getElementById('text2_8').innerHTML='(Развернуть)';
}
return false;
}</script>

<script>
function showTooltip2_9()
{
var myDiv = document.getElementById('tooltip2_9');
if(myDiv.style.display == 'none')
{
myDiv.style.display = 'block';
document.getElementById('text2_9').innerHTML='(Свернуть)';
} else {
myDiv.style.display = 'none';
document.getElementById('text2_9').innerHTML='(Развернуть)';
}
return false;
}</script>

<script>
function showTooltip2_10()
{
var myDiv = document.getElementById('tooltip2_10');
if(myDiv.style.display == 'none')
{
myDiv.style.display = 'block';
document.getElementById('text2_10').innerHTML='(Свернуть)';
} else {
myDiv.style.display = 'none';
document.getElementById('text2_10').innerHTML='(Развернуть)';
}
return false;
}</script>

</body>

</html>