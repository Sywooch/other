<?php
session_start();
header('Content-type: text/html; charset=utf-8');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Компания предлагает полный цикл услуг в области строительства, реставрации, реконструкции, ремонта и отделочных работ, а также изготовление корпусной мебели по индивидуальным заказам физических и юридических лиц"/>
<meta name="keywords" content="компания спецстрой благовещенск, высокий профессионализм, лучшая компания в сфере реставрации" />
<meta name="robots" content="all"/>
<meta name="revisit-after" content="1 days"/>
<meta name="document-state" content="Dynamic"/>
<meta name="generator" content="notepad++ :)">
<meta name="author" content="retina-studio">
<meta http-equiv="X-UA-Compatible" content="IE=edge" ><!--всегда исползовать стандартный режим отображения-->
<link href="/favicon.png" rel="icon" type="image/png"/>

<title>Документация</title>

<link rel="stylesheet" href="css/global.css"/>
<link rel="stylesheet" href="css/style.css"/>
<link rel="stylesheet" href="css/style_header.css"/>
<link rel="stylesheet" href="css/style_content.css"/>
<link rel="stylesheet" href="css/style_footer.css"/>
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
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/slides.min.jquery.js"></script>
<!--<script type="text/javascript" src="js/jquery-1.8.2.js"></script>-->
<script type="text/javascript" src="js/jquery.highlight.js"></script>

<script type="text/javascript">
		$(function(){
			// Set starting slide to 1
			var startSlide = 1;
			// Get slide number if it exists
			if (window.location.hash) {
			//	startSlide = window.location.hash.replace('#','');
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
				//	window.location.hash = '#' + current;
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
    margin-left:320px;
	 background-image:url(../img/pagination_fon.png);
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
						<img src="img/slides/index/1.jpg" alt="ремонт помещений"/>
					</div>
					<div class="slide">
						<img src="img/slides/index/2.jpg" alt="ремонт любой сложности"/>
					</div>
					<div class="slide">
						<img src="img/slides/index/3.jpg" alt="текстурное покрытие"/>						
					</div>
					<div class="slide">
						<img src="img/slides/index/4.jpg" alt="отделка поверхностей"/>					
					</div>
					<div class="slide">
						<img src="img/slides/index/5.jpg" alt="терракоат замша"/>						
					</div>
					
				</div>
				</div>
			</div>
			</div>
</div><!--слайдер-->
<div align="right" style="height:87px; width:100px; margin-top:-127px; margin-left:650px; position:relative; z-index:999999">
<img src="images/man.png" alt="террако" style="float:right"/>
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
include("templates/left_menu.php");
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
			include("content/documentation_content.php");
			?>
			
			
			
			</p></td>
		</tr>
	</tbody></table>


</div>
</div><!--центральный блок с контентом-->

<?php
include("templates/news.php");
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

</body>

</html>
